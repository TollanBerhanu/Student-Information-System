<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Clinic\ClinicPagesController;
Route::group(['prefix' => 'clinic'], function (){

    Route::get('', 'Clinic\ClinicPagesController@index')->middleware(['auth','privilege:clinic_dashboard'])->name('clinicDashboard');

});
