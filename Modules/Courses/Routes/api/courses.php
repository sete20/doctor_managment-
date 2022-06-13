<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'courses'], function () {

    Route::get('/', 'CourseController@index');

    Route::group(['middleware' => 'auth:api-client'], function () {

        Route::post('/', 'CourseController@requestCourse');
        Route::get('my-courses', 'CourseController@myCourses');
        Route::get('last-viewed-cource', 'CourseController@LastViewedCource');

    });
});
