<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Privilege;
use App\Model\Role;
use App\Model\RolePrivilege;
use App\Model\System;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrivilegeController extends Controller
{
    public function list()
    {

        $privileges = Privilege::all();
        foreach($privileges as $privilege){
            $count = 0;
            foreach ($privilege['rolePrivilege'] as $rl){
                if($rl['status']){
                    $count++;
                }
            }
            $privilege['active_role'] = $count;
        }
        $page_title = 'Privilege List';
        $page_description = 'List of registered privileges';
        $user = Auth::user();

        return view('pages.admin.privilege_list',
            compact('page_title', 'page_description', 'user', 'privileges'));
    }


    public function newPage()
    {
        $systems = System::all()->sortBy('name');
        $page_title = 'Register Privilege';
        $page_description = 'Register a new privilege';
        $user = Auth::user();

        return view('pages.admin.privilege_new',
            compact('page_title', 'page_description', 'user', 'systems'));
    }

    public function newHandle(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'system_id' => ['required'],
        ]);

        if (Privilege::where('name', $data['name'])->count() > 0) {
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

        Privilege::create($data);
        return back()->with(['notification' => "Success", 'alert_type' => "success", 'message' => 'Privilege created successfully!']);
    }

    public function editPage(Request $request, $id)
    {
        if ($id == null) {
            return redirect()->route('privilegeList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Action!']);
        }
        $privilege = Privilege::find($id);
        if($privilege == null){
            return redirect()->route('privilegeList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Privilege ID!']);
        }
        $systems = System::all()->sortBy('name');
        $page_title = 'Edit Role';
        $page_description = 'Update privilege information';
        $user = Auth::user();


        return view('pages.admin.privilege_update',
            compact('page_title', 'page_description', 'user', 'privilege', 'systems'));
    }

    public function editHandle(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'id' => ['required'],
            'name' => ['required'],
            'description' => ['required'],
            'system_id' => ['required'],
        ]);

        $privilege = Privilege::find($data['id']);
        if (!$privilege) {
            return back()->withErrors([
                'privilege' => 'Unable to find privilege in our records.',
            ])->withInput($data);
        }
        $privilege['description'] = $data['description'];

        if($data['system_id'] == -1){
            return back()->withErrors([
                'system_id' => 'System cannot be None.',
            ])->withInput($data);
        }
        else if($privilege['system_id'] != $data['system_id']){
            $system = System::find($data['system_id']);
            if (!$system) {
                return back()->withErrors([
                    'system_id' => 'Invalid System ID',
                ])->withInput($data);
            }
            else{
                $privilege['system_id'] = $system->id;
                RolePrivilege::where('privilege_id', $privilege['id'])->each(function ($role_pr, $key) {
                    $role_pr->delete();
                });
            }
        }

        if ($privilege['name'] != $data['name']) {
            if (Privilege::where('name', $data['name'])->count() > 0) {
                return back()->withErrors([
                    'name' => 'Name already registered.',
                ])->withInput($data);
            }
            else{
                $privilege['name'] = $data['name'];
            }
        }
        $privilege->save();
        return redirect()->route('privilegeList')->with(['notification' => "Success", 'alert_type' => "success", 'message' => 'Privilege updated successfully!']);
    }
}
