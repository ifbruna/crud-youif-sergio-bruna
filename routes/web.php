<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use App\Http\Middleware\CheckIsAdmin;

Route::middleware([CheckIsLogged::class])->group(function () {
    
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::controller(MainController::class)->group(function () {
        Route::get('/','index')->name('home_page');
        Route::get('/user/history', 'history')->name('history');
        Route::get('/user/profile', 'perfilUsuario')->name('perfil_usuario'); 
    });

    Route::controller(MediaController::class)->group(function (){
        Route::get('/media={id}', 'viewMedia')->name('view_media');
        Route::get('/media={id}/like', 'likeMedia')->name('like_media');
    });
});

Route::middleware([CheckIsNotLogged::class])->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login_submit', 'loginSubmit')->name('login_submit');

        Route::get('/create', 'create')->name('create');
        Route::post('/create_submit', 'createSubmit')->name('create_submit');
    });
});


Route::middleware([CheckIsLogged::class, CheckIsAdmin::class])->group(function () {

    Route::get('/admin', [MainController::class, 'adminDashboard'])->name('admin_dashboard');
    Route::get('/admin/logs', [MainController::class, 'activityLogs'])->name('admin_logs');
    Route::get('/admin/logs/download', [MainController::class, 'downloadLogs'])->name('download_logs');
    Route::get('/admin/logs/pdf', [MainController::class, 'viewPdf']);

    Route::controller(MediaController::class)->group(function (){

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
        Route::get('/admin/edit/user={id}','adminEditUser')->name('admin_edit_user');

        Route::post('/admin/edit_submit/user={id}', 'adminEditUserSubmit')->name('admin_edit_user_submit');
    });

    Route::controller(SubjectController::class)->group(function (){
        Route::get('/subject/new', 'newSubject')->name('new_subject');
        Route::post('/subject/new_submit', 'submitNewSubject')->name('submit_new_subject');

        Route::get('/admin/delete/subject={id}', 'adminDelete')->name('admin_delete_subject');
        Route::get('/admin/restore/subject={id}', 'adminRestore')->name('admin_restore_subject');
        Route::get('/admin/force_delete/subject={id}', 'adminForceDelete')->name('admin_force_delete_subject');
        Route::get('/admin/edit/subject={id}', 'adminEdit')->name('admin_edit_subject');

        Route::post('/admin/edit_submit/subject={id}', 'adminEditSubmit')->name('admin_edit_subject_submit');
    });

});