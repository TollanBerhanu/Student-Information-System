<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Gate\Gate;
use App\Model\Gate\Gate_Emp_Record;
use App\Model\Syncable\Student;
use App\Model\Gate\Block_Gate;
use App\Model\User;
use App\Model\Role;
use App\Model\Syncable\Program;
use App\Model\Syncable\Faculty;
use App\Model\System;
use App\Model\Syncable\College;
use App\Model\Syncable\Department;

class GatePagesController extends Controller
{
    public function index()
    {
        $page_title = 'Gate Dashboard';
        $page_description = 'Some description for the page';
        $user = Auth::user();

        return view('pages.gate.dashboard', compact('page_title', 'page_description', 'user'));
    }
// Attendance of the employees at the gate

public function employeeList()
{
    $user = Auth::user();
    $employees = User::where('role_id',$user->role->id )->get();
    $page_title = 'Employee List';
    $page_description = 'List of employees at Gate';
    return view('pages.gate.emp_gate',
    compact('page_title', 'page_description', 'user', 'employees'));
}


    public function studList()
    {
        $page_title = 'Gate Dashboard';
        $page_description = 'Some description for the page';
        $user = Auth::user();
        $gate = Gate::all();
      
        return view('pages.gate.blocked_stud_list',compact('gate','user'));
    }

    public function pass_menu()
    {
        $user = Auth::user();
        return view ('pages/gate/pass_menu',compact('user'));
    }

    //search Student from the gate table if exist
    public function search_Permited_Student(Request $request)
    {
        $gate = Block_Gate::with('student')->get();
        $students = Student::with('gate')->get();
        $student =Student::all();
        $program = Program::with('student')->get();
      
        $user = Auth::user();
      
        if(asset($_GET['query'])){
        
            $search_text= $request->input('query');
            $stud=DB::table('students')->select('id')->where('student_id',$search_text)->first();
            
            $searchStud = Student::where('student_id','LIKE','%'.$search_text.'%')->get();
            if($stud!=null){
           $block = Block_Gate::where('student_id',$stud->id)->exists();
            }
            else {
                return view('pages\gate\Invalid_Id', compact('user'));
                exit();
            }
            $gate_college=DB::table('users')->select('college_id')->where('college_id',$user->college->id)->first();
            $student_program = DB::table('students')->select('program_id')->where('student_id',$search_text)->first();
           
            $student_department =DB::table('programs')->select('department_id')->where('id',$student_program->program_id)->first();
           
            $student_faculty = DB::table('departments')->select('faculty_id')->where('id',$student_department->department_id)->first();
         
            $student_college =DB::table('faculties')->select('college_id')->where('id',$student_faculty->faculty_id)->first();

           //$target_id = DB::table('colleges')->select('id')->where('faculty_id',$student_college->college_id)->first();
            $found = $student_college->college_id;
            $user_college = $gate_college->college_id;
           $permited_college = $found==$user_college;

           $block_gate = Block_Gate::where('student_id',$stud->id)->get();
           $ab = Student::where('student_id',$search_text)->exists();

            if($block==null && $permited_college){
            return view ('Pages\gate\permitedStudent', compact('searchStud','user'));
           }
           else if(!$permited_college && $ab)
           {
            return view ('pages\gate\blockgate', compact('block_gate','user','permited_college'));
           }
          
             else if (!$ab || $block){
               
              
                return view ('pages\gate\blockgate', compact('block_gate','user'));
            }

        }
        else{
        dd('text search');
    } 
    }

// This function is used to check attendance of users on the gate


public function gate_attendance(Request $request, $id)
{
    if ($id == null) {
        return redirect()->route('employeeList')->with(['notification' => "Error",
            'alert_type' => "warning",
            'message' => 'Invalid Action!']);
    }
    $_user = User::find($id);
    if($_user == null){
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


// This is handle attendance route

public function attendanceHandle(Request $request): \Illuminate\Http\RedirectResponse
{
    
    $flight = new Gate_Emp_Record;

    $flight->gate_id = $request->gate_id;
    $flight->user_id = $request->user_id;
    $flight->shift = $request->shift;
    $flight->date = '2022-04-28';
    $flight->save();

    return back()->with(['notification' => "Success", 'alert_type' => "success", 'message' => 'Employee Added successfully!']);

  
}
}
