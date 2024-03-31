<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CustomerController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\TicketController;
use App\Http\Controllers\Payment\SslCommerzPaymentController;

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

//__static pages__//
Route::get('/', [HomeController::class, 'home'] )->name('homePage');
Route::get('/blog', [HomeController::class, 'blogPage'] )->name('blogPage');
Route::get('/contact', [HomeController::class, 'contactPage'] )->name('contactPage');
Route::post('/contact/store', [HomeController::class, 'contactStore'] )->name('contact.store');

//__product details page__//
Route::get('/product-details/{slug}', [HomeController::class, 'productDetails'] )->name('productDetails');

// Auth pages__//
Route::get('/forgot-password', [DashboardController::class, 'forgotPassword'] )->name('forgot.password');

//__Review for product details pages__//
Route::post('/store/review', [ReviewController::class, 'storeReview'] )->name('store.review');

//__review for frontend customer dashboard pages__// 
Route::post('/write/review', [ReviewController::class, 'writeReview'] )->name('write.review');

//__Newsletter for frontend customer__//
Route::post('/store/newsletter', [HomeController::class, 'newsLetter'] )->name('store.newsletter');

//__Wishlist__//
Route::get('/wishlist', [WishlistController::class, 'wishlist'] )->name('wishlist');
Route::get('/add/wishlist/{id}', [WishlistController::class, 'addWishlist'] )->name('add.wishlist');
Route::get('/clear/wishlist', [WishlistController::class, 'clearWishlist'] )->name('clear.wishlist');
Route::get('/wishlist/destroy/{id}', [WishlistController::class, 'destroy'] )->name('wishlist.destroy');

//__Category wise product__//
Route::get('/shop-page', [HomeController::class, 'shopPage'] )->name('shopPage');
Route::get('/category/product/{id}', [HomeController::class, 'categoryWiseProduct'] )->name('categoryWise.product');
Route::get('/subCategory/product/{id}', [HomeController::class, 'subCategoryWiseProduct'] )->name('subCategoryWise.product');
Route::get('/childCategory/product/{id}', [HomeController::class, 'childCategoryWise'] )->name('childCategoryWise.product');
Route::get('/brand/product/{id}', [HomeController::class, 'brandWiseProduct'] )->name('brandwise.product');

//__Customer profile__//
Route::get('/customer-profile', [CustomerController::class, 'customerProfile'] )->middleware(['auth', 'verified'])->name('customer.profile');
Route::get('/customer-dashboard', [CustomerController::class, 'customerDashboard'] )->middleware(['auth', 'verified'])->name('customer.dashboard');
Route::post('/user-info/{id}', [CustomerController::class, 'userInfo'] )->name('user.info');
Route::post('/user-shippingInfo/{id}', [CustomerController::class, 'userShippingInfo'] )->name('user.shippingInfo');
Route::get('/customer-invoice/{transaction_id}', [CustomerController::class, 'customerInvoice'] )->name('customer.invoice');
Route::post('/store/ticket', [CustomerController::class, 'storeTicket'] )->name('store.ticket');
Route::post('/show/ticket/{id}', [CustomerController::class, 'showTicket'] )->name('show.ticket');

//__CartList__//
Route::group(['prefix' => '/cart'], function (){
    Route::get('/', [CartController::class, 'index'] )->name('cart.manage');
    Route::post('/store', [CartController::class, 'store'] )->name('cart.store');
    Route::get('/update/{id}', [CartController::class, 'update'] )->name('cart.update');
    Route::get('/destroy/{id}', [CartController::class, 'destroy'] )->name('cart.destroy');
    Route::post('/coupon/apply', [CartController::class, 'applyCoupon'] )->name('cart.coupon.apply');
    Route::get('/coupon/remove', [CartController::class, 'removeCoupon'] )->name('coupon.remove');
    // Route::post('/order/place', [CartController::class, 'orderPlace'] )->name('order.place');
});

//__Checkout__// 
// Route::get('/checkout', [CheckoutController::class, 'checkoutPage'] )->name('checkout.page');

//__support ticket__//
// Route::get('/open/ticket', [TicketController::class, 'openTicket'] )->name('checkout.page');
// Route::get('/new/ticket', [TicketController::class, 'newTicket'] )->name('checkout.page');


//__Checkout page routes__//
Route::get('/checkout', [SslCommerzPaymentController::class, 'checkoutPage'])->name('checkout.page');
Route::post('/pay', [SslCommerzPaymentController::class, 'index'])->name('make.payment');

Route::post('/success', [SslCommerzPaymentController::class, 'success'])->name('order.success');
Route::post('/fail', [SslCommerzPaymentController::class, 'fail'])->name('order.failed');
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel'])->name('order.canceled');
Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);

//__campaigns__//
Route::get('/campaign/products/{campaign_id}', [HomeController::class, 'campaignProducts'])->name('campaign.products');
Route::get('/campaign/products-details/{slug}', [HomeController::class, 'campaignProductsDetails'])->name('campaign.product.details');




