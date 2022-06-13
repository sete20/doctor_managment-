<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'login'], function () {

    // Show Login Form
    Route::get('/', 'LoginController@showLogin')
        ->name('doctor.login')
        ->middleware('guest');

    // Submit Login
    Route::post('/', 'LoginController@postLogin')
        ->name('doctor.login');

});

Route::group(['prefix' => 'logout', 'middleware' => 'auth:doctor'], function () {

    // Logout
    Route::any('/', 'LoginController@logout')
        ->name('doctor.logout');

});
