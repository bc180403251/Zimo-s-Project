<?php

use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;


Route::Post('users/create',[UserController::class ,'store']);
Route::get('users/find/{id}', [UserController::class, 'show']);
Route::get('users/findAll',[UserController::class, 'index']);
Route::delete('users/delete/{id}',[UserController::class, 'destroy']);
Route::post('users/authenticate',[UserController::class, 'userAuthentication']);




Route::post('testmail',[\App\Http\Controllers\EmployeeController::class, 'testmail']);
