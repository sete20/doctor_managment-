<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'cards'], function () {

    Route::get('create'		,'CardController@create')
        ->name('dashboard.cards.create');

    Route::post('/'			,'CardController@store')
        ->name('dashboard.cards.store');

    Route::get('{id}/edit'	,'CardController@edit')
        ->name('dashboard.cards.edit');

    Route::put('{id}'		,'CardController@update')
        ->name('dashboard.cards.update');
});
