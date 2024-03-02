<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\CartController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// static pages
Route::get('/', [HomeController::class, 'home'] )->name('homePage');
Route::get('/product-details/{slug}', [HomeController::class, 'productDetails'] )->name('productDetails');

// Auth pages
// Route::get('/user-login', [HomeController::class, 'userLogin'] )->name('user-login');

// Review
Route::post('/store/review', [ReviewController::class, 'storeReview'] )->name('store.review');

// Wishlist
Route::get('/add/wishlist/{id}', [WishlistController::class, 'addWishlist'] )->name('add.wishlist');

// CartList
Route::group(['prefix' => '/cart'], function (){
    Route::get('/', [CartController::class, 'index'] )->name('cart.manage');
    Route::post('/store', [CartController::class, 'store'] )->name('cart.store');
    Route::get('/update/{id}', [CartController::class, 'update'] )->name('cart.update');
    Route::get('/destroy/{id}', [CartController::class, 'destroy'] )->name('cart.destroy');
    Route::get('/destroy/{id}', [CartController::class, 'destroy'] )->name('cart.destroy');
    Route::post('/coupon/apply', [CartController::class, 'applyCoupon'] )->name('cart.coupon.apply');
});


