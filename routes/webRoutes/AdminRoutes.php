<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminPagesController;

Route::group(['prefix' => '/admin'], function () {

    Route::get('', 'Admin\AdminPagesController@index')->middleware(['auth', 'privilege:admin_dashboard'])->name('adminDashboard');

    Route::group(['prefix' => '/employee'], function () {
        Route::get('', 'Admin\EmployeeController@list')->middleware(['auth', 'privilege:employee_list'])->name('employeeList');
        Route::get('/register', 'Admin\EmployeeController@newPage')->middleware(['auth', 'privilege:employee_register'])->name('employeeRegisterPage');
        Route::post('/register', 'Admin\EmployeeController@newHandle')->middleware(['auth', 'privilege:employee_register'])->name('employeeRegisterHandle');
        Route::get('/update/{id}', 'Admin\EmployeeController@editPage')->middleware(['auth', 'privilege:employee_update'])->name('employeeUpdatePage');
        Route::post('/update', 'Admin\EmployeeController@editHandle')->middleware(['auth', 'privilege:employee_update'])->name('employeeUpdateHandle');
    });

    Route::group(['prefix' => '/role'], function () {
        Route::get('', 'Admin\RoleController@list')->middleware(['auth', 'privilege:role_list'])->name('roleList');
        Route::get('/register', 'Admin\RoleController@newPage')->middleware(['auth', 'privilege:role_register'])->name('roleRegisterPage');
        Route::post('/register', 'Admin\RoleController@newHandle')->middleware(['auth', 'privilege:role_register'])->name('roleRegisterHandle');
        Route::get('/update/{id}', 'Admin\RoleController@editPage')->middleware(['auth', 'privilege:role_update'])->name('roleUpdatePage');
        Route::post('/update', 'Admin\RoleController@editHandle')->middleware(['auth', 'privilege:role_update'])->name('roleUpdateHandle');
        Route::get('/privilege/{id}', 'Admin\RoleController@privilegePage')->middleware(['auth', 'privilege:role_privilege'])->name('role_privilegePage');
        Route::post('/privilege', 'Admin\RoleController@privilegeHandle')->middleware(['auth', 'privilege:role_privilege'])->name('role_privilegeHandle');
    });

    Route::group(['prefix' => '/privilege'], function () {
        Route::get('', 'Admin\PrivilegeController@list')->middleware(['auth', 'privilege:privilege_list'])->name('privilegeList');
        Route::get('/register', 'Admin\PrivilegeController@newPage')->middleware(['auth', 'privilege:privilege_register'])->name('privilegeRegisterPage');
        Route::post('/register', 'Admin\PrivilegeController@newHandle')->middleware(['auth', 'privilege:privilege_register'])->name('privilegeRegisterHandle');
        Route::get('/update/{id}', 'Admin\PrivilegeController@editPage')->middleware(['auth', 'privilege:privilege_update'])->name('privilegeUpdatePage');
        Route::post('/update', 'Admin\PrivilegeController@editHandle')->middleware(['auth', 'privilege:privilege_update'])->name('privilegeUpdateHandle');

    });

});