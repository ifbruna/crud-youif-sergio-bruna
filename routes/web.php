<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;


//checkislogged
Route::get('/', [MainController::class, 'index'])->name('home_page');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//checkisnotlogged

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login-submit', [AuthController::class, 'loginSubmit'])->name('login_submit');
