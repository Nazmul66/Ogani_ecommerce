<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminPageController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\PageController;

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

         // Pages setting
         Route::group(['prefix' => '/page'], function () {
            Route::get('/', [PageController::class, 'manage'])->name('page.manage');
            // Route::post('/update/{id}', [SettingController::class, 'smtp_update'])->name('smtp.update');
         });
   });
   
});

