<?php

use App\Http\Controllers\PlanController;
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

Route::get('/admin/plans', function () {
    return view('welcome');
});


Route::resource('plan', 'PhotoController');


Route::get('/admin/plans',[PlanController::class,'index'])->name('plans.index');