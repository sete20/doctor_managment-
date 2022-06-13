<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'contents'], function () {

    Route::get('/' ,'ContentController@index')
        ->name('doctor.contents.index');

    Route::get('datatable'	,'ContentController@datatable')
        ->name('doctor.contents.datatable');

    Route::delete('{id}'	,'ContentController@destroy')
        ->name('doctor.contents.destroy');

    Route::get('deletes'	,'ContentController@deletes')
        ->name('doctor.contents.deletes');

    Route::get('{id}','ContentController@show')
        ->name('doctor.contents.show');

});
