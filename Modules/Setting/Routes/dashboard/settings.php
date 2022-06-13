<?php

Route::group(['prefix' => 'setting'], function () {

    // Show Settings Form
    Route::get('/', 'SettingController@index')
    ->name('dashboard.setting.index');

    // Update Settings
    Route::post('/', 'SettingController@update')
    ->name('dashboard.setting.update');

});
