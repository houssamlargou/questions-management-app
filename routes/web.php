<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\FavoriteController;
use App\Http\controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/questions', [QuestionController::class, 'index'])->middleware('auth')->name('questions.index');
Route::get('/questions/create', [QuestionController::class, 'create'])->middleware('auth')->name('questions.create');
Route::post('/questions',[QuestionController::class, 'store'])->middleware('auth')->name('question.store');
Route::get('/questions/{id}', [QuestionController::class, 'show'])->name('questions.show');
Route::post('/questions/{question}/answer', [AnswerController::class,'store'])->middleware('auth')->name('answers.store');
Route::post('/questions/{question}/favorite', [FavoriteController::class, 'store'])->middleware('auth')->name('favorites.store');
Route::delete('/questions/{question}/favorite', [FavoriteController::class, 'destroy'])->middleware('auth')->name('favorites.destroy');
Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth')->name('profile.index');
Route::get('/login',[AuthController::class, 'showLogin'])->middleware('guest')->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->middleware('guest')->name('register');
Route::post('/register',[AuthController::class, 'register'])->middleware('guest');
Route::post('/login',[AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');