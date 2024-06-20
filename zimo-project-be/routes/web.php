<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Middleware\CheckUserType;
use \App\Http\Controllers\authController;

Route::get('/dashboard', function () {
    return view('dashboard.welcome');
})->name('dashboard')->middleware(CheckUserType::class);

Route::get('login',[authController::class, 'login']);

Route::post('loginPost', [authController::class, 'loginPost'])->name('login.post');
