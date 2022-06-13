<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/' , 'middleware' => []], function() {

    Route::get('/' , 'DashboardController@index')->name('dashboard.home');

});