<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'clinic'], function (){

    Route::get('', 'ClinicPagesController@index')->middleware(['auth','privilege:clinic_dashboard'])->name('clinicDashboard');

});
