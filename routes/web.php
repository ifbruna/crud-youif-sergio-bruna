<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use App\Http\Middleware\CheckIsAdmin;

Route::middleware([CheckIsLogged::class])->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('home_page');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
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

    Route::controller(MediaController::class)->group(function (){

        Route::get('/media={id}', 'viewMedia')->name('view_media');
        Route::get('/media={id}/like', 'likeMedia')->name('like_media');
        Route::get('/media/new', 'newMedia')->name('new_media');
        Route::post('/media/new_submit', 'submitNewMedia')->name('submit_new_media');

        Route::get('/admin/delete/media={id}', 'adminDelete')->name('admin_delete_media');
        Route::get('/admin/restore/media={id}', 'adminRestore')->name('admin_restore_media');
        Route::get('/admin/force_delete/media={id}', 'adminForceDelete')->name('admin_force_delete_media');
        Route::get('/admin/edit/media={id}', 'adminEdit')->name('admin_edit_media');

        Route::post('/admin/edit_submit/media={id}', 'adminEditSubmit')->name('admin_edit_media_submit');
    });
    
    Route::controller(UserController::class)->group(function (){
        Route::get('/admin/delete/user={id}', 'adminDelete')->name('admin_delete_user');
        Route::get('/admin/restore/user={id}','adminRestore')->name('admin_restore_user');
        Route::get('/admin/force_delete/user={id}','adminForceDelete')->name('admin_force_delete_user');
        Route::get('/admin/edit/user={id}','adminEdit')->name('admin_edit_user');

        Route::post('/admin/edit_submit/user={id}', 'adminEditSubmit')->name('admin_edit_user_submit');
    });

});