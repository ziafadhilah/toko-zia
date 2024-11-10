<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ThumbnailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index']);

// Product
Route::prefix('/product')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/show/{id}', [ProductController::class, 'show']);
    Route::get('/create', [ProductController::class, 'create']);
    Route::get('/edit/{id}', [ProductController::class, 'edit']);
    Route::post('/', [ProductController::class, 'store']);
    Route::patch('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});

// Category
Route::prefix('/category')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/create', [CategoryController::class, 'create']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::get('/edit/{id}', [CategoryController::class, 'edit']);
    Route::patch('/{id}', [CategoryController::class, 'update']);
    Route::delete('/{id}', [CategoryController::class, 'destroy']);
});

// Thumbnail
Route::prefix('/thumbnail')->group(function () {
    Route::get('/', [ThumbnailController::class, 'index']);
    Route::get('/create', [ThumbnailController::class, 'create']);
    Route::post('/', [ThumbnailController::class, 'store']);
    Route::get('/edit/{id}', [ThumbnailController::class, 'edit']);
    Route::patch('/{id}', [ThumbnailController::class, 'update']);
    Route::delete('/{id}', [ThumbnailController::class, 'destroy']);
});

// Price
Route::prefix('/price')->group(function () {
    Route::get('/', [PriceController::class, 'index']);
    Route::get('/create', [PriceController::class, 'create']);
    Route::post('/', [PriceController::class, 'store']);
    Route::get('/edit/{id}', [PriceController::class, 'edit']);
    Route::patch('/{id}', [PriceController::class, 'update']);
    Route::delete('/{id}', [PriceController::class, 'destroy']);
});
