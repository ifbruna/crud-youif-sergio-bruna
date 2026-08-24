<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;

//checkislogged

Route::middleware([CheckIsLogged::class])->group(function () {
Route::get('/', [MainController::class, 'index'])->name('home_page');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
//checkisnotlogged

Route::middleware([CheckIsNotLogged::class])->group(function () {
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login-submit', [AuthController::class, 'loginSubmit'])->name('login_submit');
Route::get('/create', [AuthController::class, 'create'])->name('create');
Route::post('/create-submit', [AuthController::class, 'createSubmit'])->name('create_submit');
});