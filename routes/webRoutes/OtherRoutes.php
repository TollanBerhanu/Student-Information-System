<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PagesController@index')->middleware(['auth'])->name('dashboard');

// Other
Route::get('/about', 'OtherPagesController@about')->name("About");
Route::get('/team', 'OtherPagesController@team')->name("Team");
Route::get('/contact', 'OtherPagesController@contact')->name('Contact');
