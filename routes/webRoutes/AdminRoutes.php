<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/admin'], function (){

    Route::get('', 'AdminsPagesController@index')->middleware(['auth','privilege:admin_dashboard'])->name('adminDashboard');
});
