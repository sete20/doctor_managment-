<?php
use Illuminate\Support\Facades\Route;


Route::name('doctor.')->group( function () {
    Route::resource('videos' , 'VideoController')->only('create','update','edit','store','show')->names('videos');
});
