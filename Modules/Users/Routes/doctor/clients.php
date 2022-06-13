<?php
use Illuminate\Support\Facades\Route;

Route::name('doctor.')->group( function () {

    Route::get('clients/datatable'	,'ClientController@datatable')
        ->name('clients.datatable');

    Route::get('clients/switch/{id}/{action}', 'ClientController@switcher')->name('clients.switch');

    Route::resource('clients','ClientController')->only('index')->names('clients');
});
