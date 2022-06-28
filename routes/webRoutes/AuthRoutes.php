<?php

use Illuminate\Support\Facades\Route;

// Authentication
Route::get('/login', 'PagesController@login')->name("login");
Route::post('/login', 'PagesController@loginValidate')->name("loginValidate");
Route::get('/logout', 'PagesController@logout')->name('logout');
