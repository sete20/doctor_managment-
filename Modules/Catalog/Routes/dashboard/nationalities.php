<?php
use Illuminate\Support\Facades\Route;

Route::name('dashboard.')->group( function () {

    Route::get('nationalities/datatable'	,'NationalityController@datatable')
        ->name('nationalities.datatable');

    Route::get('nationalities/deletes'	,'NationalityController@deletes')
        ->name('nationalities.deletes');

    Route::resource('nationalities','NationalityController')->names('nationalities');
});