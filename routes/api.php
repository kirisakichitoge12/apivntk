<?php

use App\Http\Controllers\Api\BannerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\ContentManagementController;
use App\Http\Controllers\Api\PromotionBannerController;
use App\Http\Controllers\AuthController;
use Tymon\JWTAuth\Facades\JWTAuth;

Route::post('/bookings', [BookingController::class, 'store']);


Route::middleware('jwt.auth')->group(function () {
    Route::get('/me', function () {
        return response()->json(JWTAuth::user());
    });
    Route::get('/banners/{page}', [BannerController::class, 'getByPage']);
    // phần token này chỉ có token của admin mới xem được
});


Route::post('/banners', [BannerController::class, 'store']);
Route::get('/promotion-banners/{page}', [PromotionBannerController::class, 'getByPage']);
Route::post('/promotion-banners', [PromotionBannerController::class, 'store']);


//authentication 

Route::post('/register', [AuthController::class, 'register']);
Route::get('/verify-email', [AuthController::class, 'verifyEmail']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/homecontentmanagement', [ContentManagementController::class, 'ApiHomeManagement']);
Route::get('/khuyenmai', [ContentManagementController::class, 'ApiKhuyenmaiManagement']);
Route::get('/tintuc', [ContentManagementController::class, 'ApiTintucManagement']);
Route::get('/vemaybaynoidia', [ContentManagementController::class, 'ApiVemaybaynoidiaManagement']);
Route::get('/vemaybayquocte', [ContentManagementController::class, 'ApiVemaybayquocteManagement']);
