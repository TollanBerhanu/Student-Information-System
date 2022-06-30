<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Gate\Gate;
use App\Model\Syncable\Student;
use App\Model\Gate\Block_Gate;
use App\Model\User;
use App\Model\Syncable\Role;
use App\Model\Syncable\Program;
use App\Model\Syncable\Faculty;
use App\Model\Syncable\College;
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
    $employees = User::where('role_id',$user->role->id)->get();
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
     // dd($gate_college);     //  this is the employees college id
    
     if($block==null){
            return view ('Pages\gate\permitedStudent', compact('searchStud','user'));
           }
           $ab = Student::where('student_id','LIKE','%'.$search_text.'%')->exists();
             if (!$ab || $block){
               $block_gate = Block_Gate::where('student_id',$stud->id)->get();
              
                return view ('pages\gate\blockgate', compact('block_gate','user'));
            }

        }
        else{
        dd('text search');
    } 
    }

}
