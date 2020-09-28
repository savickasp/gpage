<?php

use App\Http\Controllers\Admin\ManufacturerController;
use App\Http\Controllers\Admin\ProductLineController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ModificationController;
use App\Http\Controllers\Admin\UnitValueController;
use App\Http\Controllers\Admin\DashboardController;
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

Route::domain(env('APP_URL'))
    ->group(function () {
        Auth::routes();
    });

Route::domain('admin.'.env('APP_URL'))
    ->name('admin.')
    ->group(function () {

        Route::name('dashboard.')
            ->group(function () {
                Route::get('/', [DashboardController::class, 'index'])->name('index');
                Route::get('/katalogas', [DashboardController::class, 'catalog'])->name('catalog');
            });

        Route::prefix('katalogas')
            ->group(function () {

                Route::prefix('gamintojai')
                    ->name('manufacturer.')
                    ->group(function () {
                        Route::get('/', [ManufacturerController::class, 'index'])->name('index');
                        Route::post('/', [ManufacturerController::class, 'store'])->name('store');
                        Route::get('naujas/', [ManufacturerController::class, 'create'])->name('create');
                        Route::get('{manufacturer}/', [ManufacturerController::class, 'show'])->name('show');
                        Route::patch('{manufacturer}/', [ManufacturerController::class, 'update'])->name('update');
                        Route::delete('{manufacturer}/', [ManufacturerController::class, 'destroy'])->name('destroy');
                        Route::get('{manufacturer}/redaguoti', [ManufacturerController::class, 'edit'])->name('edit');
                    });

                Route::prefix('produkto-linijos')
                    ->name('productline.')
                    ->group(function () {
                        Route::get('/', [ProductLineController::class, 'index'])->name('index');
                        Route::post('/', [ProductLineController::class, 'store'])->name('store');
                        Route::get('naujas/', [ProductLineController::class, 'create'])->name('create');
                        Route::get('{manufacturer}/', [ProductLineController::class, 'show'])->name('show');
                        Route::patch('{manufacturer}/', [ProductLineController::class, 'update'])->name('update');
                        Route::delete('{manufacturer}/', [ProductLineController::class, 'destroy'])->name('destroy');
                        Route::get('{manufacturer}/redaguoti', [ProductLineController::class, 'edit'])->name('edit');
                    });

                Route::prefix('produktai')
                    ->name('product.')
                    ->group(function () {
                        Route::get('/', [ProductController::class, 'index'])->name('index');
                        Route::post('/', [ProductController::class, 'store'])->name('store');
                        Route::get('naujas/', [ProductController::class, 'create'])->name('create');
                        Route::get('{manufacturer}/', [ProductController::class, 'show'])->name('show');
                        Route::patch('{manufacturer}/', [ProductController::class, 'update'])->name('update');
                        Route::delete('{manufacturer}/', [ProductController::class, 'destroy'])->name('destroy');
                        Route::get('{manufacturer}/redaguoti', [ProductController::class, 'edit'])->name('edit');
                    });

                Route::prefix('modifikacijos')
                    ->name('modification.')
                    ->group(function () {
                        Route::get('/', [ModificationController::class, 'index'])->name('index');
                        Route::post('/', [ModificationController::class, 'store'])->name('store');
                        Route::get('naujas/', [ModificationController::class, 'create'])->name('create');
                        Route::get('{manufacturer}/', [ModificationController::class, 'show'])->name('show');
                        Route::patch('{manufacturer}/', [ModificationController::class, 'update'])->name('update');
                        Route::delete('{manufacturer}/', [ModificationController::class, 'destroy'])->name('destroy');
                        Route::get('{manufacturer}/redaguoti', [ModificationController::class, 'edit'])->name('edit');
                    });

                Route::prefix('mato-vienetas')
                    ->name('unitvalue.')
                    ->group(function () {
                        Route::get('/', [UnitValueController::class, 'index'])->name('index');
                        Route::post('/', [UnitValueController::class, 'store'])->name('store');
                        Route::get('naujas/', [UnitValueController::class, 'create'])->name('create');
                        Route::get('{manufacturer}/', [UnitValueController::class, 'show'])->name('show');
                        Route::patch('{manufacturer}/', [UnitValueController::class, 'update'])->name('update');
                        Route::delete('{manufacturer}/', [UnitValueController::class, 'destroy'])->name('destroy');
                        Route::get('{manufacturer}/redaguoti', [UnitValueController::class, 'edit'])->name('edit');
                    });
            });
    });
