<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'doctors'], function () {

    Route::get('/' ,'DoctorController@index')
        ->name('dashboard.doctors.index');
//        ->middleware(['permission:show_doctors']);

    Route::get('datatable'	,'DoctorController@datatable')
        ->name('dashboard.doctors.datatable');
//        ->middleware(['permission:show_doctors']);

    Route::get('create'		,'DoctorController@create')
        ->name('dashboard.doctors.create');
//        ->middleware(['permission:add_doctors']);

    Route::post('/'			,'DoctorController@store')
        ->name('dashboard.doctors.store');
//        ->middleware(['permission:add_doctors']);

    Route::get('{id}/edit'	,'DoctorController@edit')
        ->name('dashboard.doctors.edit');
//        ->middleware(['permission:edit_doctors']);

    Route::put('{id}'		,'DoctorController@update')
        ->name('dashboard.doctors.update');
//        ->middleware(['permission:edit_doctors']);

    Route::delete('{id}'	,'DoctorController@destroy')
        ->name('dashboard.doctors.destroy');
//        ->middleware(['permission:delete_doctors']);

    Route::get('deletes'	,'DoctorController@deletes')
        ->name('dashboard.doctors.deletes');
//        ->middleware(['permission:delete_doctors']);

    Route::get('{id}','DoctorController@show')
        ->name('dashboard.doctors.show');
//        ->middleware(['permission:show_doctors']);

});