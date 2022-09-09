<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Content\PostDetailController;

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});

Route::controller(PostDetailController::class)->group(function () {
    Route::get('/category/id/judul', 'index')->name('post_detail');
});

Route::group(['prefix' => 'admin'], function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'index')->name('adm.login');
        Route::post('/login/process', 'go')->name('adm.login-submit');
    });
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('adm.dashboard');
    });
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index')->name('adm.category');
    });
});