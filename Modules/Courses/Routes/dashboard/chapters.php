<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'chapters'], function () {

    Route::get('/' ,'ChapterController@index')
        ->name('dashboard.chapters.index');

    Route::get('datatable'	,'ChapterController@datatable')
        ->name('dashboard.chapters.datatable');

    Route::delete('delete/{client}/resources/{collection}/{media}', 'ChapterController@deleteAttachment')
        ->name('dashboard.chapters.resources.delete');

    Route::get('create'		,'ChapterController@create')
        ->name('dashboard.chapters.create');

    Route::post('/'			,'ChapterController@store')
        ->name('dashboard.chapters.store');

    Route::get('{id}/edit'	,'ChapterController@edit')
        ->name('dashboard.chapters.edit');

    Route::put('{id}'		,'ChapterController@update')
        ->name('dashboard.chapters.update');

    Route::delete('{id}'	,'ChapterController@destroy')
        ->name('dashboard.chapters.destroy');

    Route::get('deletes'	,'ChapterController@deletes')
        ->name('dashboard.chapters.deletes');

    Route::get('{id}','ChapterController@show')
        ->name('dashboard.chapters.show');

});
