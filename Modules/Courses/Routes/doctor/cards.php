<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'cards'], function () {

    Route::get('create'		,'CardController@create')
        ->name('doctor.cards.create');

    Route::post('/'			,'CardController@store')
        ->name('doctor.cards.store');

    Route::get('{id}/edit'	,'CardController@edit')
        ->name('doctor.cards.edit');

    Route::put('{id}'		,'CardController@update')
        ->name('doctor.cards.update');
});
