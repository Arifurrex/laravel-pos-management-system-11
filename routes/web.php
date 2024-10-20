<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;

Route::view('/', 'welcome');
Route::view('/index', 'index');

Route::get('/authentication/signIn', [AuthenticationController::class,'signIn'])->name('authentication.signIn');
Route::get('/authentication/signUp', [AuthenticationController::class,'signUp'])->name('authentication.signUp');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
