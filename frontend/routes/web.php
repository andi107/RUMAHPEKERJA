<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Content\PostDetailController;
use App\Http\Controllers\Content\CategoryController as UserCategory;

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/r/{id}', 'shrt_link')->name('redir');
    Route::get('/imgview/{folder}/{ext}/{fileName}', 'image_view')->name('image-view');    
});

Route::controller(UserCategory::class)->group(function () {
    Route::get('/c/{cid}/{category_name}', 'listbycategory')->name('list-by-category');
});

Route::controller(PostDetailController::class)->group(function () {
    Route::get('/c/{cid}/{id}/{title}', 'detail')->name('post-detail');
    // Route::get('/c/{category_name}/p/{title}', 'index')->name('post_detail');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', function() {
        return redirect()->route('adm.dashboard');
    });
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'index')->name('adm.login');
        Route::post('/login/process', 'go')->name('adm.login-submit');
    });
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('adm.dashboard');
        Route::get('/logout', 'go_logout')->name('adm.logout');
    });
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index')->name('adm.category');
        Route::post('/category/create', 'create')->name('adm.category-create');
        Route::put('/category/update/{id}', 'update')->name('adm.category-update');
    });
    Route::controller(PostController::class)->group(function () {
        Route::get('/post', 'indexList')->name('adm.post-list-index');
        Route::get('/post/create', 'index')->name('adm.post-create-index');
        Route::get('/post/edit', 'index')->name('adm.post-edit-index');
        Route::post('/post/create/save', 'create_update')->name('adm.post-save');
        Route::post('/post/save/tmp', 'tmpattachsave')->name('adm.post-tmp-save');
    });
});