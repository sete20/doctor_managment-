<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'chapters'], function () {

    Route::get('/' ,'ChapterController@index')
        ->name('doctor.chapters.index');

    Route::get('datatable'	,'ChapterController@datatable')
        ->name('doctor.chapters.datatable');

    Route::delete('delete/{client}/resources/{collection}/{media}', 'ChapterController@deleteAttachment')
        ->name('doctor.chapters.resources.delete');

    Route::get('create'		,'ChapterController@create')
        ->name('doctor.chapters.create');

    Route::post('/'			,'ChapterController@store')
        ->name('doctor.chapters.store');

    Route::get('{id}/edit'	,'ChapterController@edit')
        ->name('doctor.chapters.edit');

    Route::put('{id}'		,'ChapterController@update')
        ->name('doctor.chapters.update');

    Route::delete('{id}'	,'ChapterController@destroy')
        ->name('doctor.chapters.destroy');

    Route::get('deletes'	,'ChapterController@deletes')
        ->name('doctor.chapters.deletes');

    Route::get('{id}','ChapterController@show')
        ->name('doctor.chapters.show');

});
