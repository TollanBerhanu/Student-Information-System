<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Gate\GatePagesController;
use App\Http\Controllers\Gate\studentController;

Route::resource('/studentList', Gate\studentController::class)->middleware(['auth','privilege:studentDetail']);

Route::group(['prefix' => 'gate'], function (){

    Route::get('/', 'Gate\GatePagesController@index')->middleware(['auth','privilege:gate_dashboard'])->name('gateDashboard');
    //Employees student list
    Route::get('/attendance','Gate\GatePagesController@employeeList')->middleware(['auth','privilege:employee_list'])->name('GetEmloyeeList');
    
    Route::get('/update/{id}', 'Gate\GatePagesController@gate_attendance')->middleware(['auth', 'privilege:employee_update'])->name('employeeListAttendance');
    Route::get('/employeeAttendance', 'Gate\GatePagesController@attendanceHandle')->middleware(['auth', 'privilege:employee_update'])->name('employeeAttendanceHandler');
    
    // Route for Student List
    Route::get('/admin/blocked_StudentList','Gate\block_Gate_StudentController@student_list')->middleware(['auth','privilege:blocked_studentList'])->name('blockedStudentList');
    
    Route::group(['prefix' => '/student'], function () {
        
        Route::get('/block_stud_List','Gate\GatePagesController@studList')->middleware(['auth','privilege:block_stud_List'])->name('getStuentList');
       
        
        // Route::get('/permitedStudent','Gate\GatePagesController@search_Permited_Student')->middleware(['auth','privilege:Control_Student_Gate'])->name('Control Gate');
        
        Route::get('/student_pass','Gate\GatePagesController@pass_menu')->middleware(['auth','privilege:Control_Student_Gate'])->name('passGatePage');
        Route::get('/permitedStudent','Gate\GatePagesController@search_Permited_Student')->middleware(['auth','privilege:Control_Student_Gate'])->name('PermitedStudentPage');
      
       
    });
    Route::group(['pefix'=>'/employees'],function()
    {
       
  
    });
});

