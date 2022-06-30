<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminPagesController;

Route::group(['prefix' => '/admin'], function (){

    Route::get('', 'Admin\AdminPagesController@index')->middleware(['auth','privilege:admin_dashboard'])->name('adminDashboard');
});
