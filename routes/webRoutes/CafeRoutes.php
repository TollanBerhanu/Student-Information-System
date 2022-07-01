<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/cafe'], function (){

    Route::get('', 'Cafe\CafePagesController@index')->middleware(['auth'])->name('cafePage');
    Route::get('cafeAdminDashboard','Cafe\CafePagesController@cafeDashboard')->middleware(['auth','privilege:cafe_admin_dashboard'])->name("cafeDashboard");
});

Route::group(['prefix' => '/cafe/Opration'], function (){

    Route::get('cafe_register_update_page', 'Cafe\CafePagesController@cafe_register')->middleware(['auth','privilege:cafe_register_update']);
});