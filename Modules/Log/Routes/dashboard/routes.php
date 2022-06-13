<?php
use Illuminate\Support\Facades\Route;

Route::name('dashboard.')->group( function () {

    Route::get('logs/datatable'	,'LogController@datatable')
        ->name('logs.datatable');

    Route::get('logs/deletes'	,'LogController@deletes')
        ->name('logs.deletes');

    Route::resource('logs','LogController')->names('logs')->only('index','destroy');
});