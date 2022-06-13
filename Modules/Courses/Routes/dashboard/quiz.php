<?php

use Illuminate\Support\Facades\Route;

Route::name('dashboard.')->group( function () {
Route::resource('quiz' , 'QuizController')->only('create','update','edit','store','show')->names('quiz');
});
