<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'login'], function () {

    // Show Login Form
    Route::get('/', 'LoginController@showLogin')
        ->name('dashboard.login')
        ->middleware('guest');

    // Submit Login
    Route::post('/', 'LoginController@postLogin')
        ->name('dashboard.login');

});

Route::group(['prefix' => 'logout', 'middleware' => 'auth:admin'], function () {

    // Logout
    Route::any('/', 'LoginController@logout')
        ->name('dashboard.logout');

});
