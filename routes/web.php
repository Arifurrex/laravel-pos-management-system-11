<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';


Route::view('/index', 'index');


Route::resource('/authentication',AuthenticationController::class);
Route::resource('/order',OrderController::class);
Route::resource('/products',ProductController::class);
Route::resource('/suppliers',SupplierController::class);
Route::resource('/order',CompanyController::class);
Route::resource('/order',OrderDetailsController::class);
Route::resource('/order',TransactionController::class);


// user route
Route::get('/authentication/signIn', [AuthenticationController::class,'signIn'])->name('authentication.signIn');
Route::get('/authentication/signUp', [AuthenticationController::class,'signUp'])->name('authentication.signUp');
Route::post('/authentication/store', [AuthenticationController::class,'store'])->name('authentication.store');
Route::get('/authentication/edit/{id}', [AuthenticationController::class,'edit'])->name('authentication.edit');
Route::post('/authentication/update/{id}', [AuthenticationController::class,'update'])->name('authentication.update');
Route::get('/authentication/detete/{id}', [AuthenticationController::class,'delete'])->name('authentication.delete');

