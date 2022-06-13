<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'lessons' , 'middleware' => ['auth:api-client','available-course']], function () {

    Route::get('/', 'LessonController@index');
    Route::get('/questions', 'QuizController@index');
    Route::post('/questions', 'QuizController@quizAnswer');
    Route::post('/complete-video', 'LessonController@completeVideo');
});
