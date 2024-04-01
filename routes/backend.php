<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminPageController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\WarehouseController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\PickupController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CampaignController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\DivisionController;
use App\Http\Controllers\Backend\DistrictController;
// use Laravel\Socialite\Facades\Socialite;
 
// Route::get('/auth/redirect', function () {
//     return Socialite::driver('github')->redirect();
// });

// Route::get('/auth/callback', function () {
//    $user = Socialite::driver('github')->user();

//    // $user->token
// });


/*
|--------------------------------------------------------------------------
| Global API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/get-child-category/{id}', [CategoryController::class, 'getChildCategory']);


/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['middleware' => ['auth', 'IsAdmin'], 'prefix' => '/admin'], function () {
   Route::get('/dashboard', [AdminPageController::class, 'index'])->name('admin.dashboard');
    
   // Category
   Route::group(['prefix' => '/category'], function () {
      Route::get('/manage', [CategoryController::class, 'manage'])->name('category.manage');
      Route::get('/trash-manage', [CategoryController::class, 'trashManage'])->name('category.trash-manage');
      Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
      Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
      Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
      Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
      Route::get('/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
      Route::get('/trash-destroy/{id}', [CategoryController::class, 'trashDestroy'])->name('category.trash-destroy');
   });


   // SubCategory
   Route::group(['prefix' => '/subCategory'], function () {
      Route::get('/manage', [SubCategoryController::class, 'manage'])->name('subCategory.manage');
      Route::get('/trash-manage', [SubCategoryController::class, 'trashManage'])->name('subCategory.trash-manage');
      Route::get('/create', [SubCategoryController::class, 'create'])->name('subCategory.create');
      Route::post('/store', [SubCategoryController::class, 'store'])->name('subCategory.store');
      Route::get('/edit/{id}', [SubCategoryController::class, 'edit'])->name('subCategory.edit');
      Route::post('/update/{id}', [SubCategoryController::class, 'update'])->name('subCategory.update');
      Route::get('/destroy/{id}', [SubCategoryController::class, 'destroy'])->name('subCategory.destroy');
      Route::get('/trash-destroy/{id}', [SubCategoryController::class, 'trashDestroy'])->name('subCategory.trash-destroy');
   });


   // ChildCategory
   Route::group(['prefix' => '/childCategory'], function () {
      Route::get('/manage', [ChildCategoryController::class, 'manage'])->name('childCategory.manage');
      Route::get('/trash-manage', [ChildCategoryController::class, 'trashManage'])->name('childCategory.trash-manage');
      Route::get('/create', [ChildCategoryController::class, 'create'])->name('childCategory.create');
      Route::post('/store', [ChildCategoryController::class, 'store'])->name('childCategory.store');
      Route::get('/edit/{id}', [ChildCategoryController::class, 'edit'])->name('childCategory.edit');
      Route::post('/update/{id}', [ChildCategoryController::class, 'update'])->name('childCategory.update');
      Route::get('/destroy/{id}', [ChildCategoryController::class, 'destroy'])->name('childCategory.destroy');
      Route::get('/trash-destroy/{id}', [ChildCategoryController::class, 'trashDestroy'])->name('childCategory.trash-destroy');
   });


   // Brand
   Route::group(['prefix' => '/brand'], function () {
      Route::get('/manage', [BrandController::class, 'manage'])->name('brand.manage');
      Route::get('/trash-manage', [BrandController::class, 'trashManage'])->name('brand.trash-manage');
      Route::get('/create', [BrandController::class, 'create'])->name('brand.create');
      Route::post('/store', [BrandController::class, 'store'])->name('brand.store');
      Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
      Route::post('/update/{id}', [BrandController::class, 'update'])->name('brand.update');
      Route::get('/destroy/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');
      Route::get('/trash-destroy/{id}', [BrandController::class, 'trashDestroy'])->name('brand.trash-destroy');
   });

   // Customer
   Route::group(['prefix' => '/customer'], function () {
      Route::get('/manage', [CustomerController::class, 'manage'])->name('customer.manage');
   });


   // Products
   Route::group(['prefix' => '/product'], function () {
      Route::get('/manage', [ProductController::class, 'manage'])->name('product.manage');
      Route::get('/trash-manage', [ProductController::class, 'trashManage'])->name('product.trash-manage');
      Route::get('/create', [ProductController::class, 'create'])->name('product.create');
      Route::post('/store', [ProductController::class, 'store'])->name('product.store');
      Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
      Route::post('/update/{id}', [ProductController::class, 'update'])->name('product.update');
      Route::post('/imageUpdate/{id}', [ProductController::class, 'imageUpdate'])->name('product.imageUpdate');
      Route::get('/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
      Route::get('/trash-destroy/{id}', [ProductController::class, 'trashDestroy'])->name('product.trash-destroy');
   });


   // Warehouse
   Route::group(['prefix' => '/warehouse'], function () {
      Route::get('/manage', [WarehouseController::class, 'manage'])->name('warehouse.manage');
      Route::get('/trash-manage', [WarehouseController::class, 'trashManage'])->name('warehouse.trash-manage');
      Route::get('/create', [WarehouseController::class, 'create'])->name('warehouse.create');
      Route::post('/store', [WarehouseController::class, 'store'])->name('warehouse.store');
      Route::get('/edit/{id}', [WarehouseController::class, 'edit'])->name('warehouse.edit');
      Route::post('/update/{id}', [WarehouseController::class, 'update'])->name('warehouse.update');
      Route::get('/destroy/{id}', [WarehouseController::class, 'destroy'])->name('warehouse.destroy');
      Route::get('/trash-destroy/{id}', [WarehouseController::class, 'trashDestroy'])->name('warehouse.trash-destroy');
   });


   // Coupons
   Route::group(['prefix' => '/coupon'], function () {
      Route::get('/manage', [CouponController::class, 'manage'])->name('coupon.manage');
      Route::get('/trash-manage', [CouponController::class, 'trashManage'])->name('coupon.trash-manage');
      Route::get('/create', [CouponController::class, 'create'])->name('coupon.create');
      Route::post('/store', [CouponController::class, 'store'])->name('coupon.store');
      Route::get('/edit/{id}', [CouponController::class, 'edit'])->name('coupon.edit');
      Route::post('/update/{id}', [CouponController::class, 'update'])->name('coupon.update');
      Route::get('/destroy/{id}', [CouponController::class, 'destroy'])->name('coupon.destroy');
      Route::get('/trash-destroy/{id}', [CouponController::class, 'trashDestroy'])->name('coupon.trash-destroy');
   });

   // Blogs
   Route::group(['prefix' => '/blog'], function () {
      Route::get('/manage', [BlogController::class, 'manage'])->name('blog.manage');
      Route::get('/create', [BlogController::class, 'create'])->name('blog.create');
      Route::post('/store', [BlogController::class, 'store'])->name('blog.store');
      Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
      Route::post('/update/{id}', [BlogController::class, 'update'])->name('blog.update');
      Route::get('/destroy/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');
   });


   // Campaigns
   Route::group(['prefix' => '/campaign'], function () {
      Route::get('/manage', [CampaignController::class, 'manage'])->name('campaign.manage');
      Route::get('/trash-manage', [CampaignController::class, 'trashManage'])->name('campaign.trash-manage');
      Route::get('/create', [CampaignController::class, 'create'])->name('campaign.create');
      Route::post('/store', [CampaignController::class, 'store'])->name('campaign.store');
      Route::get('/edit/{id}', [CampaignController::class, 'edit'])->name('campaign.edit');
      Route::post('/update/{id}', [CampaignController::class, 'update'])->name('campaign.update');
      Route::get('/destroy/{id}', [CampaignController::class, 'destroy'])->name('campaign.destroy');
      Route::get('/trash-destroy/{id}', [CampaignController::class, 'trashDestroy'])->name('campaign.trash-destroy');
   });


   // Campaigns Products
   Route::group(['prefix' => '/campaign-product'], function () {
      Route::get('/{campaign_id}', [CampaignController::class, 'campaignProduct'])->name('campaign.product');
      Route::get('/add/{id}/{campaign_id}', [CampaignController::class, 'productAddToCampaign'])->name('add.product.to.campaign');
      Route::get('/list/{campaign_id}', [CampaignController::class, 'campaignProductList'])->name('campaign.product.list');
      Route::get('/remove/{id}', [CampaignController::class, 'destroyCampaignProduct'])->name('destroy.campaign.product');
   });


   // Order
   Route::group(['prefix' => '/order'], function () {
      Route::get('/manage', [OrderController::class, 'manage'])->name('order.manage');
      Route::get('/edit/{id}', [OrderController::class, 'edit'])->name('order.edit');
      Route::post('/update/{id}', [OrderController::class, 'update'])->name('order.update');
   });


   // Pickup Point
   Route::group(['prefix' => '/pickup'], function () {
      Route::get('/manage', [PickupController::class, 'manage'])->name('pickup.manage');
      Route::get('/trash-manage', [PickupController::class, 'trashManage'])->name('pickup.trash-manage');
      Route::get('/create', [PickupController::class, 'create'])->name('pickup.create');
      Route::post('/store', [PickupController::class, 'store'])->name('pickup.store');
      Route::get('/edit/{id}', [PickupController::class, 'edit'])->name('pickup.edit');
      Route::post('/update/{id}', [PickupController::class, 'update'])->name('pickup.update');
      Route::get('/destroy/{id}', [PickupController::class, 'destroy'])->name('pickup.destroy');
      Route::get('/trash-destroy/{id}', [PickupController::class, 'trashDestroy'])->name('pickup.trash-destroy');
   });

   // Country
   Route::group(['prefix' => '/country'], function () {
      Route::get('/manage', [CountryController::class, 'manage'])->name('country.manage');
      Route::get('/create', [CountryController::class, 'create'])->name('country.create');
      Route::post('/store', [CountryController::class, 'store'])->name('country.store');
      Route::get('/edit/{id}', [CountryController::class, 'edit'])->name('country.edit');
      Route::post('/update/{id}', [CountryController::class, 'update'])->name('country.update');
      Route::get('/destroy/{id}', [CountryController::class, 'destroy'])->name('country.destroy');
   });

   // Division
   Route::group(['prefix' => '/division'], function () {
      Route::get('/manage', [DivisionController::class, 'manage'])->name('division.manage');
      Route::get('/trash-manage', [DivisionController::class, 'trashManage'])->name('division.trash-manage');
      Route::get('/create', [DivisionController::class, 'create'])->name('division.create');
      Route::post('/store', [DivisionController::class, 'store'])->name('division.store');
      Route::get('/edit/{id}', [DivisionController::class, 'edit'])->name('division.edit');
      Route::post('/update/{id}', [DivisionController::class, 'update'])->name('division.update');
      Route::get('/destroy/{id}', [DivisionController::class, 'destroy'])->name('division.destroy');
      Route::get('/trash-destroy/{id}', [DivisionController::class, 'trashDestroy'])->name('division.trash-destroy');
   });

   // District
   Route::group(['prefix' => '/district'], function () {
      Route::get('/manage', [DistrictController::class, 'manage'])->name('district.manage');
      Route::get('/trash-manage', [DistrictController::class, 'trashManage'])->name('district.trash-manage');
      Route::get('/create', [DistrictController::class, 'create'])->name('district.create');
      Route::post('/store', [DistrictController::class, 'store'])->name('district.store');
      Route::get('/edit/{id}', [DistrictController::class, 'edit'])->name('district.edit');
      Route::post('/update/{id}', [DistrictController::class, 'update'])->name('district.update');
      Route::get('/destroy/{id}', [DistrictController::class, 'destroy'])->name('district.destroy');
      Route::get('/trash-destroy/{id}', [DistrictController::class, 'trashDestroy'])->name('district.trash-destroy');
   });


   // Setting
   Route::group(['prefix' => '/setting'], function () {
         // SEO setting
         Route::group(['prefix' => '/seo'], function () {
            Route::get('/', [SettingController::class, 'seo_setting'])->name('seo.setting');
            Route::post('/update/{id}', [SettingController::class, 'seo_update'])->name('seo.update');
         });

         // SMTP setting
         Route::group(['prefix' => '/smtp'], function () {
            Route::get('/', [SettingController::class, 'smtp_setting'])->name('smtp.setting');
            Route::post('/update/{id}', [SettingController::class, 'smtp_update'])->name('smtp.update');
         });

         // Website setting
         Route::group(['prefix' => '/website'], function () {
            Route::get('/', [SettingController::class, 'website_setting'])->name('website.setting');
            Route::post('/update/{id}', [SettingController::class, 'website_update'])->name('website.update');
         });

         // Pages setting
         Route::group(['prefix' => '/page'], function () {
            Route::get('/manage', [PageController::class, 'manage'])->name('page.manage');
            Route::get('/create', [PageController::class, 'create'])->name('page.create');
            Route::post('/store', [PageController::class, 'store'])->name('page.store');
            Route::get('/edit/{id}', [PageController::class, 'edit'])->name('page.edit');
            Route::post('/update/{id}', [PageController::class, 'update'])->name('page.update');
            Route::get('/destroy/{id}', [PageController::class, 'destroy'])->name('page.destroy');
         });

         // Payment Gateway setting
         Route::group(['prefix' => '/payment-gateway'], function () {
            Route::get('/', [SettingController::class, 'paymentGateway'])->name('payment.gateway');
            Route::post('/aamerpay', [SettingController::class, 'aamerpayStore'])->name('store.aamerpay');
            Route::post('/aamerpay-update/{id}', [SettingController::class, 'aamerpayUpdate'])->name('update.aamerpay');
            Route::post('/surjopay', [SettingController::class, 'surjopayUpdate'])->name('update.surjopay');
         });
   });
   
});

