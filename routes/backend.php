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
Route::group(['middleware' => ['auth','isAdmin'], 'prefix' => '/admin'], function () {
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
   });
   
});

