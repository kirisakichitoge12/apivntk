<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\PromotionBannerController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

 Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
 Route::get('/banners-demo', [BannerController::class, 'getBanner']);
 Route::get('/promotion-banners', [PromotionBannerController::class, 'index']);
 Route::delete('/promotion-banners/{id}', [PromotionBannerController::class, 'destroy']);
