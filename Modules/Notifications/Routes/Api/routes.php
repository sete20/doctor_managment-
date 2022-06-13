<?php

use Illuminate\Support\Facades\Route;
Route::group(['prefix' => 'notifications'], function () {

    Route::get('/', 'NotificationsController@index');
    Route::post('read', 'NotificationsController@read');
    Route::post('delete', 'NotificationsController@delete');

});