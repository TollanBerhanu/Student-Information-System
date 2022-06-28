<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/cafe'], function (){

    Route::get('', 'CafePagesController@index')->middleware(['auth','privilege:cafe_dashboard_2'])->name('cafeDashboard');
});
