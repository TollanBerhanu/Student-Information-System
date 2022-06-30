<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'id'], function (){

    Route::get('', 'ID\IDPagesController@index')->middleware(['auth','privilege:id_dashboard'])->name('ID_Dashboard');
    // Route::get('/temporary', 'ID\TemporaryIDController@index')->middleware(['auth','privilege:id_temporary'])->name('ID_Temporary');
    Route::get('/generate', 'ID\GenerateIDController@index')->middleware(['auth','privilege:id_generate'])->name('ID_Generate');
    
    Route::post('/generatePermanentId', 'ID\GenerateIDController@generatePermanentId')->middleware(['auth','privilege:id_generate'])->name('ID_PermanentGenerate');
    Route::post('/generateTemporaryId', 'ID\GenerateIDController@generateTemporaryId')->middleware(['auth','privilege:id_generate'])->name('ID_TemporaryGenerate');
    

});
