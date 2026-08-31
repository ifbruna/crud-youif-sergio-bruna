<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use App\Http\Middleware\CheckIsAdmin;

Route::middleware([CheckIsLogged::class])->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('home_page');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/media={id}', [MainController::class, 'viewMedia'])->name('view_media');
    Route::get('/history', [MainController::class, 'history'])->name('history');
});

Route::middleware([CheckIsNotLogged::class])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login_submit', [AuthController::class, 'loginSubmit'])->name('login_submit');
    Route::get('/create', [AuthController::class, 'create'])->name('create');
    Route::post('/create_submit', [AuthController::class, 'createSubmit'])->name('create_submit');
});


Route::middleware([CheckIsLogged::class, CheckIsAdmin::class])->group(function () {
    Route::get('/admin', [MainController::class, 'adminDashboard'])->name('admin_dashboard');
    Route::get('/admin/delete_user/{id}', [MainController::class, 'adminDeleteUser'])->name('admin_delete_user');
    Route::get('/admin/restore_user/{id}',[MainController::class, 'adminRestoreUser'])->name('admin_restore_user');
    Route::get('/admin/delete_media/{id}',[MainController::class, 'adminDeleteMedia'])->name('admin_delete_media');
    Route::get('/admin/restore_media/{id}',[MainController::class, 'adminRestoreMedia'])->name('admin_restore_media');
    Route::get('/admin/force-delete-user/{id}',[MainController::class, 'adminForceDeleteUser'])->name('admin_force_delete_user');
    Route::get('/admin/force-delete-media/{id}',[MainController::class, 'adminForceDeleteMedia'])->name('admin_force_delete_media');
    Route::get('/admin/edit-user/{id}',[MainController::class, 'adminEditUser'])->name('admin_edit_user');
    Route::get('/admin/edit-media/{id}',[MainController::class, 'adminEditMedia'])->name('admin_edit_media');
    Route::post('/admin/edit-user/{id}',[MainController::class, 'adminEditUserSubmit'])->name('admin_edit_user_submit');
    Route::post('/admin/edit-media/{id}',[MainController::class, 'adminEditMediaSubmit'])->name('admin_edit_media_submit');
    
    Route::get('/media/new', [MainController::class, 'newMedia'])->name('new_media');
    Route::post('/media/new_submit', [MainController::class, 'submitNewMedia'])->name('submit_new_media');

});