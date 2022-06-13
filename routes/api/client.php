<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', 'AuthController@login');
Route::post('send-pin-code', 'AuthController@sendPinCode');
Route::post('register', 'AuthController@register');
Route::post('active-account', 'AuthController@activeAccount');


Route::group(['middleware' => ['client-active']], function () {

    Route::post('reset-password', 'AuthController@resetPassword');

    Route::group(['middleware' => ['auth:api-client']], function () {

        /// api auth routes in auth
        Route::get('screen-shot-report', 'AuthController@screenShotReport');
        Route::get('show-profile', 'AuthController@showProfile');
        Route::post('update-profile', 'AuthController@updateProfile');
        Route::post('logout', 'AuthController@logout');

        ////////////////////////////////////////

    });
});