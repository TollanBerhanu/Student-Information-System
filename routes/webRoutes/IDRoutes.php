<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'id'], function (){

    Route::get('', 'IDPagesController@index')->middleware(['auth','privilege:id_dashboard'])->name('ID_Dashboard');

});
