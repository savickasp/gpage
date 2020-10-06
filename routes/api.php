<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ManufacturerController;
use App\Http\Controllers\Admin\ProductLineController;
use App\Http\Controllers\Admin\ModificationController;
use App\Http\Controllers\Admin\UnitValueController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::domain(env('APP_URL'))
    ->group(function () {
    });

Route::domain('admin.'.env('APP_URL'))->name('admin.')->group(function () {
    Route::get('/unitvalues', [UnitValueController::class, 'getAllUnitValues']);
    Route::post('/manufacturer/{manufacturer}/product-lines/filter', [ManufacturerController::class, 'getFilteredProductLines']);
    Route::post('/manufacturer/{manufacturer}/product-lines/associate', [ManufacturerController::class, 'associateProductLine']);
    Route::post('/manufacturer/{manufacturer}/product-lines/disassociate', [ManufacturerController::class, 'disassociateProductLine']);
    Route::post('/manufacturer/{manufacturer}/products/filter', [ManufacturerController::class, 'getFilteredProducts']);
    Route::post('/manufacturer/{manufacturer}/products/associate', [ManufacturerController::class, 'associateProduct']);
    Route::post('/manufacturer/{manufacturer}/products/disassociate', [ManufacturerController::class, 'disassociateProduct']);
    Route::post('/product-line/{productline}/products/filter', [ProductLineController::class, 'getFilteredProducts']);
    Route::post('/product-line/{productline}/products/associate', [ProductLineController::class, 'associateProduct']);
    Route::post('/product-line/{productline}/products/disassociate', [ProductLineController::class, 'disassociateProduct']);
    Route::get('/modification/{modification}/unitvalue/{unitvalue}/associate', [ModificationController::class, 'associateUnitValue']);
    Route::get('/modification/{modification}/unitvalue/{unitvalue}/disassociate', [ModificationController::class, 'disassociateUnitValue']);
});
