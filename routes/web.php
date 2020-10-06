<?php

use App\Http\Controllers\Admin\ManufacturerController;
use App\Http\Controllers\Admin\ProductLineController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ModificationController;
use App\Http\Controllers\Admin\UnitValueController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Front\FrontController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::domain(env('APP_URL'))->name('front.')->group(function () {
        Route::get('/', [FrontController::class, 'home'])->name('home');
    });

Route::domain('admin.'.env('APP_URL'))->name('admin.')->group(function () {

    Route::name('dashboard.')->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::get('/katalogas', [DashboardController::class, 'catalog'])->name('catalog');
    });

    Route::prefix('katalogas')->group(function () {

        Route::prefix('gamintojai')->name('manufacturer.')->group(function () {

            Route::get('/', [ManufacturerController::class, 'index'])->name('index');
            Route::post('/', [ManufacturerController::class, 'store'])->name('store');
            Route::get('naujas/', [ManufacturerController::class, 'create'])->name('create');
            Route::get('{manufacturer}/', [ManufacturerController::class, 'show'])->name('show');
            Route::patch('{manufacturer}/', [ManufacturerController::class, 'update'])->name('update');
            Route::delete('{manufacturer}/', [ManufacturerController::class, 'destroy'])->name('destroy');
            Route::get('{manufacturer}/istrinti', [ManufacturerController::class, 'delete'])->name('delete');
            Route::get('{manufacturer}/redaguoti', [ManufacturerController::class, 'edit'])->name('edit');
            Route::get('{manufacturer}/produktai/', [ManufacturerController::class, 'products'])->name('products');
            Route::get('{manufacturer}/produkto-linijos/', [ManufacturerController::class, 'productlines'])->name('productLines');
        });

        Route::prefix('produkto-linijos')->name('productline.')->group(function () {

            Route::get('/', [ProductLineController::class, 'index'])->name('index');
            Route::post('/', [ProductLineController::class, 'store'])->name('store');
            Route::get('naujas/', [ProductLineController::class, 'create'])->name('create');
            Route::get('{productline}/', [ProductLineController::class, 'show'])->name('show');
            Route::patch('{productline}/', [ProductLineController::class, 'update'])->name('update');
            Route::delete('{productline}/', [ProductLineController::class, 'destroy'])->name('destroy');
            Route::get('{productline}/istrinti', [ProductLineController::class, 'delete'])->name('delete');
            Route::get('{productline}/redaguoti', [ProductLineController::class, 'edit'])->name('edit');
            Route::get('{productline}/gamintojas', [ProductLineController::class, 'manufacturer'])->name('manufacturer');
            Route::get('{productline}/produktai', [ProductLineController::class, 'products'])->name('products');
        });

        Route::prefix('produktai')->name('product.')->group(function () {

            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::post('/', [ProductController::class, 'store'])->name('store');
            Route::get('naujas/', [ProductController::class, 'create'])->name('create');
            Route::get('{product}/', [ProductController::class, 'show'])->name('show');
            Route::patch('{product}/', [ProductController::class, 'update'])->name('update');
            Route::delete('{product}/', [ProductController::class, 'destroy'])->name('destroy');
            Route::get('{product}/istrinti', [ProductController::class, 'delete'])->name('delete');
            Route::get('{product}/redaguoti', [ProductController::class, 'edit'])->name('edit');
            Route::get('{product}/gamintojas', [ProductController::class, 'manufacturer'])->name('manufacturer');
            Route::get('{product}/produktu-linija', [ProductController::class, 'productline'])->name('productline');
        });

        Route::prefix('produktai/{product}/')->name('modification.')->group(function () {

            Route::post('/modifikacijos/', [ModificationController::class, 'store'])->name('store');
            Route::get('/modifikacijos/naujas', [ModificationController::class, 'create'])->name('create');
            Route::get('/modifikacijos/{modification}', [ModificationController::class, 'show'])->name('show');
            Route::patch('/modifikacijos/{modification}', [ProductController::class, 'update'])->name('update');
            Route::delete('/modifikacijos/{modification}', [ProductController::class, 'destroy'])->name('destroy');
            Route::get('/modifikacijos/{modification}/redaguoti', [ModificationController::class, 'edit'])->name('edit');
            Route::get('/modifikacijos/{modification}/istrinti', [ProductController::class, 'delete'])->name('delete');
        });

        Route::prefix('mato-vienetas')->name('unitvalue.')->group(function () {

            Route::get('/', [UnitValueController::class, 'index'])->name('index');
            Route::post('/', [UnitValueController::class, 'store'])->name('store');
            Route::get('naujas/', [UnitValueController::class, 'create'])->name('create');
            Route::get('{unitvalue}/', [UnitValueController::class, 'show'])->name('show');
            Route::patch('{unitvalue}/', [UnitValueController::class, 'update'])->name('update');
            Route::delete('{unitvalue}/', [ProductController::class, 'destroy'])->name('destroy');
            Route::get('{unitvalue}/istrinti', [UnitValueController::class, 'delete'])->name('delete');
            Route::get('{unitvalue}/redaguoti', [UnitValueController::class, 'edit'])->name('edit');
        });

        Route::prefix('kategorijos')->name('category.')->group(function () {

            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::post('/', [CategoryController::class, 'store'])->name('store');
            Route::get('/nauja', [CategoryController::class, 'create'])->name('create');
            Route::get('/{category}', [CategoryController::class, 'show'])->name('show');
            Route::patch('/{category}', [CategoryController::class, 'update'])->name('update');
            Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
            Route::get('/{category}/istrinti', [CategoryController::class, 'delete'])->name('delete');
            Route::get('/{category}/redaguoti', [CategoryController::class, 'edit'])->name('edit');
        });
    });
});
