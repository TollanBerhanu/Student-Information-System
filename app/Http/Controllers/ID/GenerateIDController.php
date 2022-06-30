<?php

namespace App\Http\Controllers\ID;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\Syncable\Student;
use App\Model\Syncable\Program;
use App\Model\Syncable\Department;
use App\Model\Syncable\Faculty;
use App\Model\Syncable\College;
use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;
use PDF;

class GenerateIDController extends Controller
{
    public function index()
    {   
        $page_title = 'Generate Student ID';
        $page_description = '';
        $user = Auth::user();
        $students = Student::all();

        /* foreach($students as $stud){
            dd($stud->program->department->name);
            $program = Program::select('id', 'name')->where('id', $stud->program)->get();
            dd($program);
            // $department = Department::select('name')->where('id', $program->program)->get();
        } */

        return view('pages.id.generateID', compact('page_title', 'page_description', 'user', 'students'));
    }

    public function generateTemporaryId(Request $request){
        $page_title = 'Generate Temporary ID';
        $page_description = '';
        $user = Auth::user();
        $selectedIDsStr = $request->selectedIDs;

        $selectedIDs = explode(",", $selectedIDsStr);
        $selectedStudents = [];
        foreach($selectedIDs as $id){
            $student = Student::where('id', $id)->get();
            array_push($selectedStudents, $student);
        }
        // return View::make('pages.id.temporary')->with('data', $selectedStudents);
        
        return view('pages.id.temporary', compact('page_title', 'page_description', 'user', 'selectedStudents', 'selectedIDsStr'));
    }

    public function printTemporaryId(Request $request){
        $page_title = 'Generate Temporary ID';
        $page_description = '';
        $user = Auth::user();
        $selectedIDsStr = $request->selectedIDs;

        $selectedIDs = explode(",", $selectedIDsStr);
        $selectedStudents = [];
        foreach($selectedIDs as $id){
            $student = Student::where('id', $id)->get();
            array_push($selectedStudents, $student);
        }

        $pdf = PDF::loadView('pages.id.tempPdf', compact('page_title', 'page_description', 'user', 'selectedStudents'));
        return $pdf->download('invoice.pdf');
    }
    
    public function generatePermanentId(Request $request){
        $selectedIDs = explode(",", $request->selectedIDs);
        foreach($selectedIDs as $id){
            $student = Student::where('id', $id)->get();
            GenerateIDController::addWatermark(
                $student[0]->first_name." ".$student[0]->middle_name." ".$student[0]->last_name,
                $student[0]->program->department->name,
                $student[0]->program->name,
                $student[0]->student_id
            );
        }

        return back()->with(['notification' => "Success", 'alert_type' => "success", 'message' => 'Permanent IDs Generated Successfully!']);
    }


   /*  public function makeimage()  
    {  
       $img = Image::make(public_path('images/hardik.jpg'));  
       $img->text('This is a example ', 120, 100);  
       $img->save(public_path('images/hardik3.jpg'));  
    }   */

    public function addWatermark($studentName, $studentDepartment, $studentProgram, $studentID){
        // dd('Watermark created successfully.');
        $img = Image::make(public_path('images/ID Templates/id_red.jpg'));
         // add text from database 
       /*  $img->text('add data what you want.', 120, 100);
     
        $img->save(public_path('images/demo-new.png')); 
        
        dd('Watermark created successfully.'); */
        
        // create Image from file
        /*  $img = Image::canvas(10, 10, '#fff'); */
         
         // write text
         /* $img->text('The quick brown fox jumps over the lazy dog.');
         $img->save(public_path('images/demo-new1.png'));  */
     
         // write text at position
         /* $img->text('The quick brown fox jumps over the lazy dog.', 120, 100); */
     

         // use callback to define details
         $img->text($studentName, 200, 300, function($font) {
             $font->file(public_path('font/calibril.ttf'));
             $font->size(50);
             $font->color('#000');
             $font->align('left');
             $font->valign('top');
             $font->angle(0);
         });

         $img->text($studentDepartment, 260, 380, function($font) {
            $font->file(public_path('font/calibril.ttf'));
            $font->size(50);
            $font->color('#000');
            $font->align('left');
            $font->valign('top');
            $font->angle(0);
        });

        $img->text($studentID, 200, 455, function($font) {
            $font->file(public_path('font/calibril.ttf'));
            $font->size(50);
            $font->color('#000');
            $font->align('left');
            $font->valign('top');
            $font->angle(0);
        });
        
        // insert watermark at bottom-right corner with 10px offset
        $img->insert('images/Photos/img_avatar3.png', 'top-left' ,900, 230);  

         $img->save(public_path('images/Permanent IDs/'.str_replace("/","-", $studentID).'.png')); 

        //  dd('Watermark created successfully.');
         // draw transparent text
         /* $img->text('foo', 0, 0, function($font) {
             $font->color(array(255, 255, 255, 0.5));
         });
         
         $img->save(public_path('images/demo-new3.png')); 
         dd('Watermark created successfully.'); */
     }

}
