<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cost\StudentCostController\StudentCostShare;
Route::group(['prefix' => 'cost'], function (){

    Route::get('', 'Cost\CostPagesController@index')->middleware(['auth','privilege:cost_dashboard'])->name('costDashboard');
 Route::group(['prefix' => '/collegeCost'], function () {
  
   Route::get('/studentList', 'Cost\StudentCostController\StudentCostShare@student_list')->middleware(['auth','privilege:cost_dashboard'])->name('studentCostShareList');
   Route::post('/StudentbyDept', 'Cost\StudentCostController\StudentCostShare@searchStudents')->middleware(['auth','privilege:id_generate'])->name('searchStudentwitDepartment');
   Route::post('/generateReport', 'Cost\StudentCostController\StudentCostShare@generateReport')->middleware(['auth','privilege:costshare_report_generate'])->name('generateReport');
   Route::post('/printReport', 'Cost\StudentCostController\StudentCostShare@printCostShareReport')->middleware(['auth','privilege:costshare_report_generate'])->name('printReport');
    
    });
    });
