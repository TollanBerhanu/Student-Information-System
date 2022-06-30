<?php


use Illuminate\Support\Facades\Route;
use app\Http\Controllers\Gate\GatePagesController;

Route::group(['prefix' => 'gate'], function (){

    Route::get('/', 'Gate\GatePagesController@index')->middleware(['auth','privilege:gate_dashboard'])->name('gateDashboard');
  
    Route::get('/block_stud_List','Gate\GatePagesController@studList')->middleware(['auth','privilege:cost_dashboard'])->name('getStuentList');
   
    Route::get('/PermitedStudent','Gate\GatePagesController@search_Permited_Student')
    ->middleware(['auth','privilege:gate_dashboard'])->name('permited');


});
