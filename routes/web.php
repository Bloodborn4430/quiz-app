<?php

use App\Http\Controllers\AdminQuizController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('mainpage');
});

Route::get('/quizes', [QuizController::class, 'index']);
Route::get('/quizes/{id}', [QuizController::class, 'show']);
Route::post('/quiz/{id}/answer', [QuizController::class, 'answer']);

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::resource('quizzes', AdminQuizController::class);
    Route::resource('questions', AdminQuestionController::class);
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('quizzes', AdminQuizController::class);
});
