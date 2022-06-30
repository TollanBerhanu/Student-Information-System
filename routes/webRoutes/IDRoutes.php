<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ID\IDPagesController;

Route::group(['prefix' => 'id'], function (){

    Route::get('', 'ID\IDPagesController@index')->middleware(['auth','privilege:id_dashboard'])->name('ID_Dashboard');

});
