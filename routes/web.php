<?php

use App\Http\Controllers\AnswerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/quizzes', [QuizController::class, 'index']);
Route::get('/quizzes/{quiz}', [QuizController::class, 'show']);
Route::post('/quizzes/{quiz}', [QuizController::class, 'update'])->name('quizzes.updateQuestions');
Route::put('/questions/{id}', [QuestionController::class, 'update'])->name('questions.update');

Route::get('/questions/{question}/answers', [QuestionController::class, 'getAnswers']);
Route::delete('/questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');
Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');

Route::post('/answers', [AnswerController::class, 'store'])->name('answers.store');
Route::delete('/answers/{answer}', [AnswerController::class, 'destroy'])->name('answers.destroy');
Route::put('/answers/{answer}', [AnswerController::class, 'update'])->name('answers.update');




