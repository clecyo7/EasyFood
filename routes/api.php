<?php

use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\TableApiController;
use App\Http\Controllers\Api\TenantApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function () {
    Route::get('products/{flag}', [ProductApiController::class, 'show']);
    Route::get('products', [ProductApiController::class, 'productsByTenant']);

    Route::get('tables/{identify}', [TableApiController::class, 'show']);
    Route::get('tables', [TableApiController::class, 'tablesByTenant']);

    Route::get('tenants', [TenantApiController::class, 'index']);
    Route::get('tenants/{uuid}', [TenantApiController::class, 'show']);

    Route::get('categories', [CategoryApiController::class, 'gategoriesByTenant']);
    Route::get('categories/{uuid}', [CategoryApiController::class, 'show']);
});



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
