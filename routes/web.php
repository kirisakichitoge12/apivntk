<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\PromotionBannerController;
use App\Http\Controllers\AuthController;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

 Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/demohoadon', [AdminController::class, 'viewhoadon']);

 Route::get('/chinh-sua-background', [PromotionBannerController::class, 'index']);
 Route::delete('/promotion-banners/{id}', [PromotionBannerController::class, 'destroy']);
//  Route::get('/send-test-mail', function () {
//     Mail::to('hotruongthinhkv147@gmail.com')->send(new TestMail());
//     return 'Email sent!';
//  });
 Route::get('/verify-email', [AuthController::class, 'verifyEmail']);


Route::get('/bookings', [BookingController::class, 'index'])->name('admin.bookings.index');
Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('admin.bookings.show');


//DEMO

Route::middleware(['jwt.auth', 'admin'])->group(function () {
    Route::get('/banner-khuyen-mai', [BannerController::class, 'getBanner']);
});

// Chỉ User
Route::middleware(['jwt.auth', 'user'])->group(function () {
   
});