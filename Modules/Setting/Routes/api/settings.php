<?php

Route::group(['prefix' => 'settings'], function () {

    Route::get('/terms', 'SettingController@terms')->name('api.settings.terms');
    Route::get('/{type}', 'SettingController@settings')->name('api.settings.index');
});
