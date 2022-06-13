<?php

Route::group(['prefix' => 'categories'], function () {

    Route::get('/'  , 'CategoryController@categories');

});
