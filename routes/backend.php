<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminPageController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
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
    
   // category
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


   // subCategory
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
   
});

