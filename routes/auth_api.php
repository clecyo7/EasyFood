<?php

use App\Http\Controllers\Api\Auth\OrderTenantController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->namespace('Api')->group(function () {
    Route::get('/my-orders', [OrderTenantController::class, 'index'])->middleware('auth');
    Route::patch('/my-orders', [OrderTenantController::class, 'update'])->middleware('auth');
});
