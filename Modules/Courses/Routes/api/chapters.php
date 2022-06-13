<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'chapters' , 'middleware' => ['auth:api-client']], function () {

    Route::get('/', 'ChapterController@index');
});
