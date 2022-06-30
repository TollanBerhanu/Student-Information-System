<?php

namespace App\Http\Controllers\ID;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\Syncable\Student;

use Intervention\Image\Facades\Image;

class PermanentIDController extends Controller
{
    public function index()
    {
        $page_title = 'Generate Permanent ID';
        $page_description = '';
        $user = Auth::user();
        $students = Student::all();

        return view('pages.id.permanent', compact('page_title', 'page_description', 'user', 'students'));
    }

   /*  public function makeimage()  
    {  
       $img = Image::make(public_path('images/hardik.jpg'));  
       $img->text('This is a example ', 120, 100);  
       $img->save(public_path('images/hardik3.jpg'));  
    }   */

    public function addWatermark(){
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
         $img->text('Your Name Here', 200, 300, function($font) {
             $font->file(public_path('font/calibril.ttf'));
             $font->size(50);
             $font->color('#000');
             $font->align('left');
             $font->valign('top');
             $font->angle(0);
         });

         $img->text('Software Engineering', 260, 380, function($font) {
            $font->file(public_path('font/calibril.ttf'));
            $font->size(50);
            $font->color('#000');
            $font->align('left');
            $font->valign('top');
            $font->angle(0);
        });

        $img->text('RU1234/11', 200, 455, function($font) {
            $font->file(public_path('font/calibril.ttf'));
            $font->size(50);
            $font->color('#000');
            $font->align('left');
            $font->valign('top');
            $font->angle(0);
        });
        
        // insert watermark at bottom-right corner with 10px offset
        $img->insert('images/Photos/img_avatar3.png', 'top-left' ,900, 230);  

         $img->save(public_path('images/Permanent IDs/id.png')); 

         dd('Watermark created successfully.');
         // draw transparent text
         /* $img->text('foo', 0, 0, function($font) {
             $font->color(array(255, 255, 255, 0.5));
         });
         
         $img->save(public_path('images/demo-new3.png')); 
         dd('Watermark created successfully.'); */
     }
}
