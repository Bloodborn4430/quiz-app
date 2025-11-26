<?php

use App\Http\Controllers\AdminQuizController;
use App\Http\Controllers\AdminQuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('mainpage');
})->name('home');

Route::get('/quizes', [QuizController::class, 'index'])->name('quizzes.index');
Route::get('/quizes/{id}', [QuizController::class, 'show'])->name('quiz.show');
Route::post('/quiz/{id}/answer', [QuizController::class, 'answer'])->name('quiz.answer');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('quizzes', AdminQuizController::class);
    Route::resource('questions', AdminQuestionController::class);
});
