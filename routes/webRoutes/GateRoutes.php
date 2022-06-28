<?php


use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'gate'], function (){

    Route::get('', 'GatePagesController@index')->middleware(['auth','privilege:gate_dashboard'])->name('gateDashboard');

});
