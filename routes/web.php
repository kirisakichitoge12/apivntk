<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\PromotionBannerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeImageController;
use App\Http\Controllers\KhuyenmaiImageController;
use App\Http\Controllers\TintucImageController;
use App\Http\Controllers\VemaybaynoidiaImageController;
use App\Http\Controllers\VemaybayquocteImageController;
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
//banner home
Route::get('/banners-home', [HomeImageController::class, 'index'])->name('banners.index');
Route::post('/banners-home', [HomeImageController::class, 'store'])->name('banners.store');
Route::delete('/banners-home/{id}', [HomeImageController::class, 'destroy'])->name('banners.destroy');

// background home
Route::get('/background-home', [HomeImageController::class, 'backgroundIndex'])->name('background.index');
Route::post('/background-home', [HomeImageController::class, 'backgroundStore'])->name('background.store');
Route::delete('/background-home/{id}', [HomeImageController::class, 'backgroundDestroy'])->name('background.destroy');


//vé máy bay nội địa

// Banners
Route::get('banners-trang-ve-may-bay-noi-dia', [VemaybaynoidiaImageController::class, 'index'])->name('vemaybaynoidia.banners.index');
Route::post('banners-trang-ve-may-bay-noi-dia', [VemaybaynoidiaImageController::class, 'store'])->name('vemaybaynoidia.banners.store');
Route::delete('banners-trang-ve-may-bay-noi-dia/{id}', [VemaybaynoidiaImageController::class, 'destroy'])->name('vemaybaynoidia.banners.destroy');

// Background
Route::get('background-trang-ve-may-bay-noi-dia', [VemaybaynoidiaImageController::class, 'backgroundIndex'])->name('vemaybaynoidia.background.index');
Route::post('background-trang-ve-may-bay-noi-dia', [VemaybaynoidiaImageController::class, 'backgroundStore'])->name('vemaybaynoidia.background.store');
Route::delete('background-trang-ve-may-bay-noi-dia/{id}', [VemaybaynoidiaImageController::class, 'backgroundDestroy'])->name('vemaybaynoidia.background.destroy');



// Banners
Route::get('banners-trang-ve-may-bay-quoc-te', [VemaybayquocteImageController::class, 'index'])->name('vemaybayquocte.banners.index');
Route::post('banners-trang-ve-may-bay-quoc-te', [VemaybayquocteImageController::class, 'store'])->name('vemaybayquocte.banners.store');
Route::delete('banners-trang-ve-may-bay-quoc-te/{id}', [VemaybayquocteImageController::class, 'destroy'])->name('vemaybayquocte.banners.destroy');

// Background
Route::get('background-trang-ve-may-bay-quoc-te', [VemaybayquocteImageController::class, 'backgroundIndex'])->name('vemaybayquocte.background.index');
Route::post('background-trang-ve-may-bay-quoc-te', [VemaybayquocteImageController::class, 'backgroundStore'])->name('vemaybayquocte.background.store');
Route::delete('background-trang-ve-may-bay-quoc-te/{id}', [VemaybayquocteImageController::class, 'backgroundDestroy'])->name('vemaybayquocte.background.destroy');




// Banners
Route::get('banners-trang-tin-tuc', [TintucImageController::class, 'index'])->name('tintuc.banners.index');
Route::post('banners-trang-tin-tuc', [TintucImageController::class, 'store'])->name('tintuc.banners.store');
Route::delete('banners-trang-tin-tuc/{id}', [TintucImageController::class, 'destroy'])->name('tintuc.banners.destroy');

// Background
Route::get('background-trang-tin-tuc', [TintucImageController::class, 'backgroundIndex'])->name('tintuc.background.index');
Route::post('background-trang-tin-tuc', [TintucImageController::class, 'backgroundStore'])->name('tintuc.background.store');
Route::delete('background-trang-tin-tuc/{id}', [TintucImageController::class, 'backgroundDestroy'])->name('tintuc.background.destroy');




// Banners
Route::get('banners-trang-khuyen-mai', [KhuyenmaiImageController::class, 'index'])->name('khuyenmai.banners.index');
Route::post('banners-trang-khuyen-mai', [KhuyenmaiImageController::class, 'store'])->name('khuyenmai.banners.store');
Route::delete('banners-trang-khuyen-mai/{id}', [KhuyenmaiImageController::class, 'destroy'])->name('khuyenmai.banners.destroy');

// Background
Route::get('background-trang-khuyen-mai', [KhuyenmaiImageController::class, 'backgroundIndex'])->name('khuyenmai.background.index');
Route::post('background-trang-khuyen-mai', [KhuyenmaiImageController::class, 'backgroundStore'])->name('khuyenmai.background.store');
Route::delete('background-trang-khuyen-mai/{id}', [KhuyenmaiImageController::class, 'backgroundDestroy'])->name('khuyenmai.background.destroy');


 
Route::middleware(['jwt.auth', 'admin'])->group(function () {
   
});

// Chỉ User
Route::middleware(['jwt.auth', 'user'])->group(function () {
   
});