<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'clinic'], function (){

    Route::get('', 'ClinicPagesController@index')->middleware(['auth','privilege:clinic_dashboard'])->name('clinicDashboard');


    Route::group(['prefix' => '/clinic'], function () {
        Route::get('', 'Clinic\ClinicController@list')->middleware(['auth', 'privilege:clinic_list'])->name('clinicList');
        Route::get('/register', 'Clinic\ClinicController@newPage')->middleware(['auth', 'privilege:clinic_register'])->name('clinicRegisterPage');
        Route::post('/register', 'Clinic\ClinicController@newHandle')->middleware(['auth', 'privilege:clinic_register'])->name('clinicRegisterHandle');
        Route::get('/update/{id}', 'Clinic\ClinicController@editPage')->middleware(['auth', 'privilege:clinic_update'])->name('clinicUpdatePage');
        Route::post('/update', 'Clinic\ClinicController@editHandle')->middleware(['auth', 'privilege:clinic_update'])->name('clinicUpdateHandle');
    });


    Route::group(['prefix' => '/room'], function () {
        Route::get('', 'Clinic\RoomController@list')->middleware(['auth', 'privilege:room_list'])->name('roomList');
        Route::get('/register', 'Clinic\RoomController@newPage')->middleware(['auth', 'privilege:room_register'])->name('roomRegisterPage');
        Route::post('/register', 'Clinic\RoomController@newHandle')->middleware(['auth', 'privilege:room_register'])->name('roomRegisterHandle');
        Route::get('/update/{id}', 'Clinic\RoomController@editPage')->middleware(['auth', 'privilege:room_update'])->name('roomUpdatePage');
        Route::post('/update', 'Clinic\RoomController@editHandle')->middleware(['auth', 'privilege:room_update'])->name('roomUpdateHandle');
        Route::get('/assign/{id}', 'Clinic\RoomController@assignPage')->middleware(['auth', 'privilege:room_assign'])->name('roomAssignPage');
        Route::post('/assign', 'Clinic\RoomController@assignHandle')->middleware(['auth', 'privilege:room_assign'])->name('roomAssignHandle');
    });

    Route::group(['prefix' => '/symptom'], function () {
        Route::get('', 'Clinic\SymptomController@list')->middleware(['auth', 'privilege:symptom_list'])->name('symptomList');
        Route::get('/register', 'Clinic\SymptomController@newPage')->middleware(['auth', 'privilege:symptom_register'])->name('symptomRegisterPage');
        Route::post('/register', 'Clinic\SymptomController@newHandle')->middleware(['auth', 'privilege:symptom_register'])->name('symptomRegisterHandle');
        Route::get('/update/{id}', 'Clinic\SymptomController@editPage')->middleware(['auth', 'privilege:symptom_update'])->name('symptomUpdatePage');
        Route::post('/update', 'Clinic\SymptomController@editHandle')->middleware(['auth', 'privilege:symptom_update'])->name('symptomUpdateHandle');
    });

    Route::group(['prefix' => '/disease'], function () {
        Route::get('', 'Clinic\DiseaseController@list')->middleware(['auth', 'privilege:disease_list'])->name('diseaseList');
        Route::get('/register', 'Clinic\DiseaseController@newPage')->middleware(['auth', 'privilege:disease_register'])->name('diseaseRegisterPage');
        Route::post('/register', 'Clinic\DiseaseController@newHandle')->middleware(['auth', 'privilege:disease_register'])->name('diseaseRegisterHandle');
        Route::get('/update/{id}', 'Clinic\DiseaseController@editPage')->middleware(['auth', 'privilege:disease_update'])->name('diseaseUpdatePage');
        Route::post('/update', 'Clinic\DiseaseController@editHandle')->middleware(['auth', 'privilege:disease_update'])->name('diseaseUpdateHandle');
    });

    Route::group(['prefix' => '/reception'], function () {
        Route::get('/search', 'Clinic\ReceptionController@search')->middleware(['auth', 'privilege:reception_student_list'])->name('reception_StudentList');
        Route::get('/accept/{id}', 'Clinic\ReceptionController@acceptPage')->middleware(['auth', 'privilege:reception_accept_student'])->name('receptionAcceptPage');
        Route::post('/accept', 'Clinic\ReceptionController@acceptHandle')->middleware(['auth', 'privilege:reception_accept_student'])->name('receptionAcceptHandle');
    });


    Route::group(['prefix' => '/diagnosis'], function () {
        Route::get('/list/new', 'Clinic\DiagnosisController@newList')->middleware(['auth', 'privilege:diagnosis_new_list'])->name('diagnosis_NewList');
        Route::get('/accept/{id}', 'Clinic\DiagnosisController@acceptPage')->middleware(['auth', 'privilege:diagnosis_accept_request'])->name('diagnosisAcceptPage');
        Route::get('/diagnose/{id}', 'Clinic\DiagnosisController@diagnosePage')->middleware(['auth', 'privilege:diagnosis_diagnose_request'])->name('diagnosisDiagnosePage');

        Route::post('/forward', 'Clinic\DiagnosisController@forwardHandle')->middleware(['auth', 'privilege:diagnosis_forward_request'])->name('diagnosisForwardHandle');
        Route::post('/complete', 'Clinic\DiagnosisController@completeHandle')->middleware(['auth', 'privilege:diagnosis_complete_request'])->name('diagnosisCompleteHandle');
    });

    Route::group(['prefix' => '/service'], function () {
        Route::get('/list/new', 'Clinic\ServiceController@newList')->middleware(['auth', 'privilege:service_new_list'])->name('service_NewList');
        Route::get('/accept/{id}', 'Clinic\ServiceController@acceptPage')->middleware(['auth', 'privilege:service_accept_request'])->name('serviceAcceptPage');
        Route::get('/serve/{id}', 'Clinic\ServiceController@diagnosePage')->middleware(['auth', 'privilege:service_diagnose_request'])->name('serviceServePage');

        Route::post('/complete', 'Clinic\ServiceController@completeHandle')->middleware(['auth', 'privilege:service_complete_request'])->name('serviceCompleteHandle');
    });
});
// privilege list

// admin_dashboard
// employee_list
// employee_register
// employee_update

// disease_list
// disease_register
// disease_update

// symptom_list
// symptom_register
// symptom_update

// room_list
// room_register
// room_update
// room_assign

// clinic_list
// clinic_register
// clinic_update


// reception_student_list
// reception_accept_student

// diagnosis_new_list
// diagnosis_accept_request
// diagnosis_diagnose_request
// diagnosis_forward_request
// diagnosis_complete_request

// service_new_list
// service_accept_request
// service_serve_request
// service_complete_request
