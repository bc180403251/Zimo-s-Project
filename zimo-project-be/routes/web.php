<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CompanyController;
use \App\Http\Controllers\EmployeeController;

use \App\Http\Middleware\CheckUserType;
use \App\Http\Controllers\authController;

//Route::get('/dashboard', function () {
//    return view('dashboard.welcome');
//})->name('dashboard')->middleware(CheckUserType::class);
Route::middleware(CheckUserType::class)->group(function (){
    Route::get('/dashboard',[EmployeeController::class, 'showDashboard'])->name('dashboard');
    Route::get('employee-stats',[EmployeeController::class, 'showDashboard'])->name('employee.stats');
});
//Route::get('/dashboard',[EmployeeController::class ,'showDashboard'])->name('api.employee-stats')->middleware(CheckUserType::class);

Route::get('createCompany',[CompanyController::class, 'create'])->name('create')->middleware(CheckUserType::class);
Route::post('createCompany',[CompanyController::class , 'store'])->name('storeCompany')->middleware(CheckUserType::class);
Route::get('ListOfCompaines', [CompanyController::class ,'index'])->middleware(CheckUserType::class)->name('List');


//Employees Routes

Route::get('createEmployee', [EmployeeController::class ,'create'])->middleware(CheckUserType::class)->name('createEmployee');
Route::post('createEmployee',[EmployeeController::class, 'store'])->name('createEmployee')->middleware(CheckUserType::class);
//Route::get('listOfEmployees', [EmployeeController::class, 'index'])->name('employeelist')->middleware(CheckUserType::class);
Route::get('employes/datatables',[EmployeeController::class, 'datatables'])->name('employees.datatable')->middleware(CheckUserType::class);
Route::delete('destroyEmployee/{id}', [EmployeeController::class, 'destroy'])->name('delete')->middleware(CheckUserType::class);
Route::get('updateEmployee/{id}',[EmployeeController::class ,'edit'])->name('update')->middleware(CheckUserType::class);
Route::put('updateEmployee/{id}',[EmployeeController::class, 'update'])->name('update')->middleware(CheckUserType::class);
Route::get('viewEmployee/{id}', [EmployeeController::class, 'show'])->name('view')->middleware(CheckUserType::class);
Route::middleware(CheckUserType::class)->group(function (){
    Route::get('/listOfEmployees',[EmployeeController::class, 'index'])->name('employeelist');
    Route::get('employee-data',[EmployeeController::class, 'getEmployee'])->name('employee.data');
});



// Auth Routes
Route::get('login',[authController::class, 'login']);

Route::post('loginPost', [authController::class, 'loginPost'])->name('login.post');
