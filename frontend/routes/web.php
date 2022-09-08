<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Content\PostDetailController;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});

Route::controller(PostDetailController::class)->group(function () {
    Route::get('/{category}/{id}/{judul}', 'index')->name('post_detail');
});
// https://www.tribunnews.com/regional/2022/09/07/fakta-siswi-smp-dirudapaksa-dan-dibunuh-tetangga-di-lampung-motif-pelaku-ingin-miliki-hp-korban