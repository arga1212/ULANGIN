<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// --- IMPOR SEMUA CONTROLLER YANG KITA BUTUHKAN ---
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfilePageController; // Controller tampilan profil
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController; // <-- TAMBAHKAN INI
use App\Http\Controllers\Admin\VoucherController as AdminVoucherController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ===================================================================
// 1. ROUTE PUBLIK
// ===================================================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{product}', [ShopController::class, 'show'])->name('shop.show');


// ===================================================================
// 2. ROUTE UNTUK USER YANG SUDAH LOGIN
// ===================================================================
Route::middleware('auth')->group(function () {
    
    // === RUTE PROFIL (YANG SUDAH DIRAPIKAN) ===
    // Menampilkan halaman profil (desain baru Anda)
    Route::get('/profile', [ProfilePageController::class, 'show'])->name('profile.show');
    // Menampilkan form edit profil (bawaan Breeze)
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    // Memproses update profil
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Menghapus profil
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute Pesanan Saya
    Route::get('/my-orders', [OrderController::class, 'index'])->name('my-orders.index');

    // Rute Keranjang Belanja
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::get('cart/remove/{variantId}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('cart/update-and-checkout', [CartController::class, 'updateAndCheckout'])->name('cart.updateAndCheckout');
    
    // Rute Proses Checkout dan Voucher
    Route::get('checkout', [CheckoutController::class, 'create'])->name('checkout.create');
    Route::post('checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::post('checkout/now', [CheckoutController::class, 'buyNow'])->name('checkout.buyNow');
    Route::post('voucher/apply', [CheckoutController::class, 'applyVoucher'])->name('voucher.apply');
    Route::post('voucher/remove', [CheckoutController::class, 'removeVoucher'])->name('voucher.remove');
    // Pastikan routenya seperti ini:
Route::post('/cart/update-checkout', [CartController::class, 'updateAndCheckout'])->name('cart.updateAndCheckout');
Route::get('/cart/remove/{variantId}', [CartController::class, 'remove'])->name('cart.remove');


});


// ===================================================================
// 3. ROUTE KHUSUS UNTUK ADMIN
// ===================================================================
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');    Route::resource('products', ProductController::class);
    Route::resource('orders', AdminOrderController::class)->only(['index', 'show', 'update']);
    Route::resource('vouchers', AdminVoucherController::class);
});


// ===================================================================
// 4. ROUTE AUTENTIKASI (BAWAAN)
// ===================================================================
require __DIR__.'/auth.php';