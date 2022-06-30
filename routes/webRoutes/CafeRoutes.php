<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/cafe'], function (){

    Route::get('', 'Cafe\CafePagesController@index')->middleware(['auth','privilege:cafe_dashboard'])->name('cafeDashboard');
});
