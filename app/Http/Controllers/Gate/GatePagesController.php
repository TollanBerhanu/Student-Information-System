<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Gate\Gate;
use App\Model\Syncable\Student;
use App\Model\Gate\Block_Gate;

class GatePagesController extends Controller
{
    public function index()
    {
        $page_title = 'Gate Dashboard';
        $page_description = 'Some description for the page';
        $user = Auth::user();

        return view('pages.gate.dashboard', compact('page_title', 'page_description', 'user'));
    }
    public function studList()
    {
        $page_title = 'Gate Dashboard';
        $page_description = 'Some description for the page';
        $user = Auth::user();
        $gate = Gate::all();
      
        return view('pages.gate.blocked_stud_list',compact('gate','user'));
    }

    //search Student from the gate table if exist
    public function search_Permited_Student(Request $request)
    {
        $gate = Block_Gate::with('student')->get();
        $students = Student::with('gate')->get();
       
        if(asset($_GET['query'])){
         
            $search_text= $request->input('query');
            $stud=DB::table('students')->select('id')->where('student_id',$search_text)->first();
            $searchStud = Student::where('student_id','LIKE','%'.$search_text.'%')->get();
            if($stud!=null){
           $block = Block_Gate::where('student_id',$stud->id)->exists();
            }
            else {
                return view('pages\gate\Invalid_Id');
                exit();
            }
           if($block==null){
            return view ('Pages\gate\permitedStudent', compact('searchStud'));
           }
           $ab = Student::where('student_id','LIKE','%'.$search_text.'%')->exists();
             if (!$ab || $block){
               $block_gate = Block_Gate::where('student_id',$stud->id)->get();
              
                return view ('Gate and Cost Sharing\Gate\student\blockgate', compact('block_gate'));
            }

        }
        else{
        dd('text search');
    } 
    }

}
