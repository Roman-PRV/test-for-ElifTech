<?php

use App\Http\Controllers\AnswerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CompletionController;

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
    //ToDo login

    return redirect()->route('quizzes.index');
});

Route::resource('quizzes', QuizController::class)->names([
    'index' => 'quizzes.index',
    'create' => 'quizzes.create',
    'store' => 'quizzes.store',
    'show' => 'quizzes.show',
    'edit' => 'quizzes.edit',
    'update' => 'quizzes.update',
    'destroy' => 'quizzes.destroy',
]);;


Route::resource('questions', QuestionController::class)->names([
    'update' => 'questions.update',
    'store' => 'questions.store',
    'destroy' => 'questions.destroy',
]);;


Route::resource('answers', AnswerController::class)->names([
    'update' => 'answers.update',
    'store' => 'answers.store',
    'destroy' => 'answers.destroy',
]);;


Route::resource('completions', CompletionController::class)->names([
    'update' => 'completion.update',
]);;



