<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'courses'], function () {

    Route::get('/' ,'CourseController@index')
        ->name('dashboard.courses.index');

    Route::get('datatable'	,'CourseController@datatable')
        ->name('dashboard.courses.datatable');

    Route::get('create'		,'CourseController@create')
        ->name('dashboard.courses.create');

    Route::post('/'			,'CourseController@store')
        ->name('dashboard.courses.store');

    Route::get('{id}/edit'	,'CourseController@edit')
        ->name('dashboard.courses.edit');

    Route::put('{id}'		,'CourseController@update')
        ->name('dashboard.courses.update');

    Route::delete('{id}'	,'CourseController@destroy')
        ->name('dashboard.courses.destroy');

    Route::get('deletes'	,'CourseController@deletes')
        ->name('dashboard.courses.deletes');

    Route::get('{id}','CourseController@show')
        ->name('dashboard.courses.show');

});
