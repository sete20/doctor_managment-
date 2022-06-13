<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'contents'], function () {

    Route::get('/' ,'ContentController@index')
        ->name('dashboard.contents.index');

    Route::get('datatable'	,'ContentController@datatable')
        ->name('dashboard.contents.datatable');

    Route::delete('{id}'	,'ContentController@destroy')
        ->name('dashboard.contents.destroy');

    Route::get('deletes'	,'ContentController@deletes')
        ->name('dashboard.contents.deletes');

    Route::get('{id}','ContentController@show')
        ->name('dashboard.contents.show');

});
