<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'doctors'], function () {

    Route::get('/' ,'DoctorController@index');
});
