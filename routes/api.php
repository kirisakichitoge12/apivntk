<?php

use App\Http\Controllers\Api\BannerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\PromotionBannerController;

Route::post('/bookings', [BookingController::class, 'store']);


Route::get('/banners/{page}', [BannerController::class, 'getByPage']);
Route::post('/banners', [BannerController::class, 'store']);
Route::get('/promotion-banners/{page}', [PromotionBannerController::class, 'getByPage']);
Route::post('/promotion-banners', [PromotionBannerController::class, 'store']);

