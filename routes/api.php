<?php

use App\Http\Controllers\CreateOrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::apiResource('products', ProductController::class)->only('show', 'index');
    Route::post('order', CreateOrderController::class);
})->middleware('auth:sanctum');
