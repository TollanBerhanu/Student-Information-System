<?php

namespace App\Http\Controllers\ID;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\Syncable\Student;
use App\Model\Syncable\Photo;
use App\Model\Syncable\Program;
use App\Model\Syncable\Department;
use App\Model\Syncable\Faculty;
use App\Model\Syncable\College;
use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;
use PDF;
use Milon\Barcode\DNS1D;
use \Gumlet\ImageResize;

class GenerateIDController extends Controller
{
    public function index()
    {   
        $page_title = 'Generate Student ID';
        $page_description = '';
        $user = Auth::user();
        $students = [];
        $colleges = College::all();

        return view('pages.id.generateID', compact('page_title', 'page_description', 'user', 'students', 'colleges'));
    }

    public function searchStudents(Request $request){
        
        $page_title = 'Generate Student ID';
        $page_description = '';
        $user = Auth::user();

        $allStudents = Student::all();
        $colleges = College::all();

        $students = [];


        foreach($allStudents as $stud)
            if($stud->program->department->faculty->college->id == $request->college)
                array_push($students, $stud);

        // return back()->with(compact('page_title', 'page_description', 'user', 'students', 'colleges'));
        return view('pages.id.generateID', compact('page_title', 'page_description', 'user', 'students', 'colleges'));
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
        $selectedIDsStr = $request->selectedIDs;
        $selectedIDs = explode(",", $selectedIDsStr); // Split string by ','
        $selectedStudents = [];
        foreach($selectedIDs as $id){
            $student = Student::where('id', $id)->get();
            array_push($selectedStudents, $student); // Create an array of selected students
        }
        // dd($selectedStudents);
        $pdf = PDF::loadView('pages.id.tempPdf', compact('selectedStudents'));
    
        return view('pages.id.tempPdf', compact('selectedStudents'));    // return as blade view
        // return $pdf->download('invoice.pdf');   // download as PDF file
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
        
        $img = Image::make(public_path('images/ID Templates/id_red.jpg'));    

         // Use callback to define details
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

        //Resize image and save it to local path
        $base64img = Photo::where('id', 2)->get();  // $base64img = 'iVBORw0KGgoAAAANSUhEUgAAAOAAAADh ...';
        $image =ImageResize::createFromString(base64_decode($base64img[0]->photo));
        $image->resize(320, 340, $allow_enlarge = True);
        $image->save('images/Photos/image.jpg');
        
        //Insert Barcode
        $img->insert('data:image/png;base64,'.DNS1D::getBarcodePNG($studentID, 'C39+',3,100,array(0,0,0), true), 'top-left' ,80, 550);  
        // insert photo at top-left corner with specified offset
        $img->insert('images/Photos/image.jpg', 'top-left' ,930, 235);  
        //Save image to local path
        $img->save(public_path('images/Permanent IDs/'.str_replace("/","-", $studentID).'.png')); 

         // create Image from file
        /*  $img = Image::canvas(10, 10, '#fff'); */
         // draw transparent text
         /* $img->text('foo', 0, 0, function($font) {
             $font->color(array(255, 255, 255, 0.5));
         });
          */
     }

}
