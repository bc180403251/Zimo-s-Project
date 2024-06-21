<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CompanyController;

use \App\Http\Middleware\CheckUserType;
use \App\Http\Controllers\authController;

Route::get('/dashboard', function () {
    return view('dashboard.welcome');
})->name('dashboard')->middleware(CheckUserType::class);

Route::get('createCompany',[CompanyController::class, 'create'])->name('create')->middleware(CheckUserType::class);
Route::post('createCompany',[CompanyController::class , 'store'])->name('storeCompany')->middleware(CheckUserType::class);
Route::get('ListOfCompaines', [CompanyController::class ,'index'])->middleware(CheckUserType::class)->name('List');

Route::get('login',[authController::class, 'login']);

Route::post('loginPost', [authController::class, 'loginPost'])->name('login.post');
