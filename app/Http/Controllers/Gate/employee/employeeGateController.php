<?php

namespace App\Http\Controllers\Gate\employee;
use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\Gate\Gate;
use App\Model\Gate\Pc;
use App\Model\Gate\Gate_Emp_Record;
use App\Model\Syncable\Student;
use App\Model\Gate\Block_Gate;
use App\Model\Role;
use App\Model\Syncable\Program;
use App\Model\Syncable\Faculty;
use App\Model\System;
use App\Model\Syncable\College;
use App\Model\Syncable\Department;


class employeeGateController extends Controller
{
    public function employeeList()
    {
        $user = Auth::user();
        $employees = User::where('role_id',$user->role->id )->get();
        $page_title = 'Employee List';
        $page_description = 'List of employees at Gate';
        return view('pages.gate.emp_gate',
        compact('page_title', 'page_description', 'user', 'employees'));
    }
    

    public function gate_attendance($id)
    {
        if ($id == null) {
            return redirect()->route('employeeList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Action!']);
        }
      
        $_user = User::find($id);
        if($_user == null){
            dd($_user);
            return redirect()->route('gate/attendance')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Employee ID!']);
        }
        $gates = Gate::all();
        $page_title = 'Gate Control Employee Attendance';
        $page_description = 'Employee Attendance information';
        $user = Auth::user();
    
        return view('pages.gate.gate_employee_attendance',
            compact('page_title', 'page_description', 'user', '_user', 'gates'));
    }
    public function attendanceHandle(Request $request): \Illuminate\Http\RedirectResponse
{

    $flight = new Gate_Emp_Record;

    $flight->gate_id = $request->gate_id;
    $flight->user_id = $request->user_id;
    $flight->shift = $request->shift;
    $flight->date = '2022-04-28';
    $flight->save();

    return redirect('gate/attendance')->with(['notification' => "Success", 'alert_type' => "success", 'message' => 'Employee Added successfully!']);


}
public function get_employee_List()
{
    $user = Auth::user();
    $emp_gate = Gate_Emp_Record::all();


return view('pages.gate.employee.employeeHistory',compact('user','emp_gate'));
}
}
