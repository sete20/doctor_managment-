<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'courses'], function () {

    Route::get('/' ,'CourseController@index')
        ->name('doctor.courses.index');

    Route::get('datatable'	,'CourseController@datatable')
        ->name('doctor.courses.datatable');

    Route::get('create'		,'CourseController@create')
        ->name('doctor.courses.create');

    Route::post('/'			,'CourseController@store')
        ->name('doctor.courses.store');

    Route::get('{id}/edit'	,'CourseController@edit')
        ->name('doctor.courses.edit');

    Route::put('{id}'		,'CourseController@update')
        ->name('doctor.courses.update');

    Route::delete('{id}'	,'CourseController@destroy')
        ->name('doctor.courses.destroy');

    Route::get('deletes'	,'CourseController@deletes')
        ->name('doctor.courses.deletes');

    Route::get('{id}','CourseController@show')
        ->name('doctor.courses.show');

});
