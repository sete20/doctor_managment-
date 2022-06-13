<?php
use Illuminate\Support\Facades\Route;


Route::name('dashboard.')->group( function () {

    Route::post('chunk.upload' , 'VideoController@chunkUpload')->name('chunk.upload');
    Route::post('store-customized' , 'VideoController@storeCustomized')->name('videos.store-customized');
    Route::resource('videos' , 'VideoController')->only('create','update','edit','store','show')->names('videos');
});
