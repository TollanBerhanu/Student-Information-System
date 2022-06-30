<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'id'], function (){

    Route::get('', 'ID\IDPagesController@index')->middleware(['auth','privilege:id_dashboard'])->name('ID_Dashboard');
    Route::get('/temporary', 'ID\TemporaryIDController@index')->middleware(['auth','privilege:id_temporary'])->name('ID_Temporary');
    Route::get('/permanent', 'ID\PermanentIDController@index')->middleware(['auth','privilege:id_permanent'])->name('ID_Permanent');
    
    Route::get('/test', 'ID\PermanentIDController@addWatermark')->name('ID_Test');

});
