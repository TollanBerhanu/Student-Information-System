<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Role;
use App\Model\Syncable\College;
use App\Model\System;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function list()
    {
        $employees = User::all();
        $page_title = 'Employee List';
        $page_description = 'List of registered employees';
        $user = Auth::user();

        return view('pages.admin.employee_list',
            compact('page_title', 'page_description', 'user', 'employees'));
    }

    public function newPage()
    {
        $colleges = College::all();
        $systems = System::all()->sortBy('name');
        $page_title = 'Register Employee';
        $page_description = 'Register a new employee';
        $user = Auth::user();

        return view('pages.admin.employee_new',
            compact('page_title', 'page_description', 'user', 'colleges', 'systems'));
    }

    public function newHandle(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required'],
            'phone_number' => ['required'],
            'sex' => ['required'],
            'role_id' => ['required'],
            'college_id' => ['required'],
            'password' => ['required'],
            'profile' => 'required|mimes:png,jpg,jpeg|max:2048',
        ]);

        $role = Role::find($data['role_id']);

        if (!$role) {
            $data['role_id'] = null;
        }
        $college = College::find($data['college_id']);
        if (!$college) {
            $data['college_id'] = null;
        }

        if (User::where('email', $data['email'])->count() > 0) {
            return back()->withErrors([
                'email' => 'Email already registered.',
            ])->withInput($data);

        }
        if (User::where('phone_number', $data['phone_number'])->count() > 0) {
            return back()->withErrors([
                'phone_number' => 'Phone Number already registered.',
            ])->withInput($data);
        }
        $data['password'] = Hash::make($data['password']);


        if ($request->hasFile('profile') && $request->file('profile')->isValid()) {
            $path = $request->file('profile')->store('system/profile');
            $data['profile'] = $path;
        } else {
            $data['profile'] = "media/users/100_3.jpg";
        }

        $user = User::create($data);

        return back()->with(['notification' => "Success", 'alert_type' => "success", 'message' => 'Employee registered successfully!']);
    }

    // This is for handle page
    public function editPage(Request $request, $id)
    {
        if ($id == null) {
            return redirect()->route('employeeList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Action!']);
        }
        $_user = User::find($id);
        if($_user == null){
            return redirect()->route('employeeList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Employee ID!']);
        }
        $colleges = College::all();
        $systems = System::all()->sortBy('name');
        $page_title = 'Edit Employee';
        $page_description = 'Update employee information';
        $user = Auth::user();


        return view('pages.admin.employee_update',
            compact('page_title', 'page_description', 'user', '_user', 'colleges', 'systems'));
    }

    public function editHandle(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'id' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required'],
            'phone_number' => ['required'],
            'sex' => ['required'],
            'role_id' => ['required'],
            'college_id' => ['required'],
            'status' => ['required'],
            'profile' => 'mimes:png,jpg,jpeg|max:2048',
        ]);

        $user = User::find($data['id']);
        if (!$user) {
            return back()->withErrors([
                'user' => 'Unable to find employee in our records.',
            ])->withInput($data);
        }

        $user['first_name'] = $data['first_name'];
        $user['last_name'] = $data['last_name'];
        $user['sex'] = $data['sex'];


        if($data['role_id'] == -1){
            $user['role_id'] = null;
        }
        else if($user['role_id'] != $data['role_id']){
            $role = Role::find($data['role_id']);
            if (!$role) {
                $data['role_id'] = null;
            }
            else{
                $user['role_id'] = $role->id;
            }
        }

        if($data['college_id'] == -1){
            $user['college_id'] = null;
        }
        else if($user['college_id'] != $data['college_id']){
            $college = College::find($data['college_id']);
            if (!$college) {
                $data['college_id'] = null;
            }
            else{
                $user['college_id'] = $college->id;
            }
        }

        if ($user['email'] != $data['email']) {
            if (User::where('email', $data['email'])->count() > 0) {
                return back()->withErrors([
                    'email' => 'Email already registered.',
                ])->withInput($data);
            }
            else{
                $user['email'] = $data['email'];
            }
        }

        if ($user['phone_number'] != $data['phone_number'] ){
            if(User::where('phone_number', $data['phone_number'])->count() > 0) {
                return back()->withErrors([
                    'phone_number' => 'Phone Number already registered.',
                ])->withInput($data);
            }
            else{
                $user['phone_number'] = $data['phone_number'];
            }
        }

        if ($request->hasFile('profile') && $request->file('profile')->isValid()) {
            $user->profile = $request->file('profile')->store('system/profile');
        }


        error_log("=================New Role===========");
        error_log($data['status']);
        error_log("=================New Role===========");
        $user['status'] = $data['status'];
        $user->save();
        return redirect()->route('employeeList')->with(['notification' => "Success", 'alert_type' => "success", 'message' => 'Employee updated successfully!']);
    }


}
