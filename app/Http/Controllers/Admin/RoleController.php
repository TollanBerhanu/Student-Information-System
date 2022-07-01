<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Privilege;
use App\Model\Role;
use App\Model\RolePrivilege;
use App\Model\Syncable\College;
use App\Model\System;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RoleController extends Controller
{
    public function list()
    {

        $roles = Role::all();
        foreach($roles as $role){
            $count = 0;
            foreach ($role['role_privilege'] as $rl){
                if($rl['status']){
                 $count++;
                }
            }
            $role['active_privilege'] = $count;
        }
        $page_title = 'Role List';
        $page_description = 'List of registered roles';
        $user = Auth::user();

        return view('pages.admin.role_list',
            compact('page_title', 'page_description', 'user', 'roles'));
    }

    public function newPage()
    {
        $systems = System::all()->sortBy('name');
        $page_title = 'Register Role';
        $page_description = 'Register a new role';
        $user = Auth::user();

        return view('pages.admin.role_new',
            compact('page_title', 'page_description', 'user', 'systems'));
    }

    public function newHandle(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'system_id' => ['required'],
        ]);

        if (Role::where('name', $data['name'])->count() > 0) {
            return back()->withErrors([
                'name' => 'Name already registered.',
            ])->withInput($data);
        }

        $system = System::find($data['system_id']);
        if (!$system) {
            return back()->withErrors([
                'system_id' => 'System cannot be None.',
            ])->withInput($data);
        }

        Role::create($data);
        return back()->with(['notification' => "Success", 'alert_type' => "success", 'message' => 'Role created successfully!']);
    }

    public function editPage(Request $request, $id)
    {
        if ($id == null) {
            return redirect()->route('roleList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Action!']);
        }
        $role = Role::find($id);
        if($role == null){
            return redirect()->route('roleList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Role ID!']);
        }
        $systems = System::all()->sortBy('name');
        $page_title = 'Edit Role';
        $page_description = 'Update role information';
        $user = Auth::user();


        return view('pages.admin.role_update',
            compact('page_title', 'page_description', 'user', 'role', 'systems'));
    }

    public function editHandle(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'id' => ['required'],
            'name' => ['required'],
            'description' => ['required'],
            'system_id' => ['required'],
        ]);

        $role = Role::find($data['id']);
        if (!$role) {
            return back()->withErrors([
                'role' => 'Unable to find role in our records.',
            ])->withInput($data);
        }
        $role['description'] = $data['description'];

        if($data['system_id'] == -1){
            return back()->withErrors([
                'system_id' => 'System cannot be None.',
            ])->withInput($data);
        }
        else if($role['system_id'] != $data['system_id']){
            $system = System::find($data['system_id']);
            if (!$system) {
                return back()->withErrors([
                    'system_id' => 'Invalid System ID',
                ])->withInput($data);
            }
            else{
                $role['system_id'] = $system->id;
                RolePrivilege::where('role_id', $role['id'])->each(function ($role_pr, $key) {
                    $role_pr->delete();
                });
            }
        }

        if ($role['name'] != $data['name']) {
            if (Role::where('name', $data['name'])->where([['id', 'not', $role['id']]])->count() > 0) {
                return back()->withErrors([
                    'name' => 'Name already registered.',
                ])->withInput($data);
            }
            else{
                $role['name'] = $data['name'];
            }
        }
        $role->save();
        return redirect()->route('roleList')->with(['notification' => "Success", 'alert_type' => "success", 'message' => 'Role updated successfully!']);
    }

    public function privilegePage(Request $request, $id)
    {
        if ($id == null) {
            return redirect()->route('roleList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Action!']);
        }
        $role = Role::find($id);
        if($role == null){
            return redirect()->route('roleList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Role ID!']);
        }
        $active_privileges = collect([]);;
        foreach ($role['role_privilege'] as $rl){
            if($rl['status']){
                $active_privileges->push($rl['privilege_id']);
            }
        }
        $role['active_privilege'] = $active_privileges;
        $privileges = Privilege::where('system_id', $role['system_id'])->get()->sortBy('name');
        $page_title = 'Manage Role Privilege';
        $page_description = 'assign or resign privileges to/from a role';
        $user = Auth::user();


        return view('pages.admin.role_privilege',
            compact('page_title', 'page_description', 'user', 'role', 'privileges'));
    }

    public function privilegeHandle(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'id' => ['required'],
            'data' => ['required'],
        ]);

        $role = Role::find($data['id']);
        if (!$role) {
            return back()->withErrors([
                'role' => 'Unable to find role in our records.',
            ])->withInput($data);
        }


//        error_log(json_encode($data));
        $_data = collect(\GuzzleHttp\json_decode($data['data']));
        RolePrivilege::where([['role_id', '=', $role['id']]])->delete();
        $_data_ = collect();
        foreach($_data as $item){
            $data_ = array('role_id' => $role['id'], 'privilege_id' => $item, 'status' => 1);
            $_data_->push($data_);
        }
        RolePrivilege::insert($_data_->toArray());
        return redirect()->route('roleList')->with(['notification' => "Success", 'alert_type' => "success", 'message' => 'Role privileges updated successfully!']);
    }




}
