<?php

namespace App\Http\Controllers\Cost\StudentCostController;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\Syncable\Student;
use App\Model\Syncable\Photo;
use App\Model\Syncable\Program;
use App\Model\Syncable\Department;
use App\Model\Syncable\Faculty;
use App\Model\Syncable\College;
use Illuminate\Http\Request;
use App\Model\User;
use Intervention\Image\Facades\Image;
use PDF;
use Milon\Barcode\DNS1D;
use \Gumlet\ImageResize;

class StudentCostShare extends Controller
{
    public function student_list(Request $request)
    {
        $query = $request->query('query');
        if ($query != null) {
            $students = Student::whereHas('program', function ($query) {
                return $query->whereHas('department', function ($query) {
                    return $query->whereHas('faculty', function ($query) {
                        return $query->whereHas('college', function ($query) {
                            return $query->where('id', '=', Auth::user()['college_id']);
                        });
                    });
                });
               
            })->where('first_name', "like", "%" . $query . "%")->
            orWhere('last_name', "like", "%" . $query . "%")->
            orWhere('student_id', "like", "%" . $query . "%")->get();
            
        } else { 
           
            $students = Student::whereHas('program', function ($query) {
                return $query->whereHas('department', function ($query) {
                    return $query->whereHas('faculty', function ($query) {
                        return $query->whereHas('college', function ($query) {
                            return $query->where('id', '=', Auth::user()['college_id']);
                         
                        });
                    
                    });
            });
          
            })->get();
            $department = Department::all();
        }
        $page_title = 'Student List for Cost Share Report';
        $page_description = 'Student list';
        $user = Auth::user();
        return view('pages.cost.costStudentList.StudentList',
            compact('page_title', 'page_description', 'user', 'students','department'));
    }
    public function searchStudents(Request $request){
        
        $page_title = 'Student Cost Share List';
        $page_description = '';
        $user = Auth::user();
        $students = [];
        $allStudents = Student::all();
       
        $department = department::all();
        $students = [];
        foreach($allStudents as $stud)
            if($stud->program->department->id == $request->department)
                array_push($students, $stud);
        return view('pages.cost.costStudentList.studentList', compact('page_title', 'page_description', 'user', 'students', 'department'));
    }
    public function generateReport(Request $request){
      
        $page_title = 'Student Cost Share List';
        $user = Auth::user();
        $page_description='';
        $selectedIDsStr = $request->selectedIDs;
        $selectedIDs = explode(",", $selectedIDsStr); // Split string by ','
        $selectedStudents = [];
        foreach($selectedIDs as $id){
            $student = Student::where('id', $id)->get();
            array_push($selectedStudents, $student); // Create an array of selected students
        }
        return view('pages.cost.costStudentList.Report', compact('page_title', 'page_description', 'user', 'selectedStudents', 'selectedIDsStr'));
          // return $pdf->download('invoice.pdf');   // download as PDF file
    }
    
    public function printCostShareReport(Request $request){
        $selectedIDsStr = $request->selectedIDs;
        $selectedIDs = explode(",", $selectedIDsStr); // Split string by ','
        $selectedStudents = [];
        foreach($selectedIDs as $id){
            $student = Student::where('id', $id)->get();
            array_push($selectedStudents, $student); // Create an array of selected students
        }
        $pdf = PDF::loadView('pages.cost.costStudentList.generatePdf', compact('selectedStudents'));
        return view('pages.cost.costStudentList.generatePdf', compact('selectedStudents'));    // return as blade view
    }
    
};