<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'cost'], function (){

    Route::get('', 'Cost\CostPagesController@index')->middleware(['auth','privilege:cost_dashboard'])->name('costDashboard');
    Route::group(['prefix' => '/departmentCostShare'], function () {

    });
    });
