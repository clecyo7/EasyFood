<?php

use App\Http\Controllers\Api\Auth\AuthClientController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\TableApiController;
use App\Http\Controllers\Api\TenantApiController;
use App\Models\Client;
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

// Route::get('teste', function() {
//     $client = Client::first();

//    $token =  $client->createToken('token-teste');
//    dd($token->plainTextToken);
// });

Route::post('/sanctum/token', [AuthClientController::class, 'auth']);

Route::group([
    'middleware' => ['auth:sanctum']
], function () {
    Route::get('/auth/me', [AuthClientController::class, 'me']);
    Route::post('/auth/logout', [AuthClientController::class, 'logout']);

    Route::post('/auth/v1/orders',[OrderApiController::class , 'store']);
    Route::get('auth/v1/my-orders',[OrderApiController::class , 'myOrders']);
});


Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function () {

    Route::post('/orders',[OrderApiController::class , 'store']);
    Route::get('/orders/{identify}',[OrderApiController::class , 'show']);


    Route::post('client', [RegisterController::class, 'store']);
    Route::get('client/{idClient}', [RegisterController::class, 'show']);
    Route::get('client', [RegisterController::class, 'index']);


    Route::get('products/{identify}', [ProductApiController::class, 'show']);
    Route::get('products', [ProductApiController::class, 'productsByTenant']);

    Route::get('tables/{identify}', [TableApiController::class, 'show']);
    Route::get('tables', [TableApiController::class, 'tablesByTenant']);

    Route::get('tenants', [TenantApiController::class, 'index']);
    Route::get('tenants/{uuid}', [TenantApiController::class, 'show']);

    Route::get('categories', [CategoryApiController::class, 'gategoriesByTenant']);
    Route::get('categories/{identify}', [CategoryApiController::class, 'show']);
});



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
