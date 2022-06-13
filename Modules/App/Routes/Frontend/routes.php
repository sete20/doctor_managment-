<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'home'], function () {

    Route::get('/', 'HomeController@index');
});