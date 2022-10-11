<?php
use App\Helpers\ApiH;
use Carbon\Carbon;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Content\PostDetailController;
use App\Http\Controllers\Content\CategoryController as UserCategory;
use App\Http\Controllers\Profile\UsersController;

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
    Route::get('/{category_name}/c/{title}/{cid}/{id}', 'detail')->name('post-detail');
});

Route::controller(UsersController::class)->group(function () {
    Route::get('/profile/{username}/{fullname}', 'author_profile')->name('user-profile');
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
        Route::get('/post/edit/attach', 'indexAttachList')->name('adm.post-edit-index-attach');
        Route::post('/post/create/save', 'create_update')->name('adm.post-save');
        Route::post('/post/save/tmp', 'tmpattachsave')->name('adm.post-tmp-save');
        Route::post('/post/attach/del', 'attachdelete')->name('adm.post-attach-del');
    });
    
});

Route::group(['prefix' => 'sitemap'], function () {
    Route::get('index', function () {
        $content = View::make('sitemap.index',[
            'carbon' => Carbon::class,
        ]);
        return Response::make($content, '200')->header('Content-Type', 'text/xml');
    });
    Route::get('sitemap', function () {
        $res = ApiH::apiGetVar('/st/sitemap');
        $content = View::make('sitemap.sitemap',[
            'res' => $res,
            'carbon' => Carbon::class,
        ]);
        return Response::make($content, '200')->header('Content-Type', 'text/xml');
    });
    Route::get('posts', function () {
        $res = ApiH::apiGetVar('/st/posts');
        $content = View::make('sitemap.posts',[
            'res' => $res,
            'carbon' => Carbon::class,
        ]);
        return Response::make($content, '200')->header('Content-Type', 'text/xml');
    });
});