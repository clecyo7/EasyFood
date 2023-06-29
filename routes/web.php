<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DetailPlanController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PermissionProfileController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PlanProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;

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

Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {

        /**
         * Routes Details Plans
         */
        Route::get('/plans/{url}/details', [DetailPlanController::class, 'index'])->name('details.plan.index');
        Route::get('/plans/{url}/details/create', [DetailPlanController::class, 'create'])->name('details.plan.create');
        Route::post('/plans/{url}/details', [DetailPlanController::class, 'store'])->name('details.plan.store');
        Route::get('/plans/{url}/details/{idDetail}/edit', [DetailPlanController::class, 'edit'])->name('details.plan.edit');
        Route::put('/plans/{url}/details/{idDetail}', [DetailPlanController::class, 'update'])->name('details.plan.update');
        Route::delete('/plans/{url}/details/{idDetail}', [DetailPlanController::class, 'destroy'])->name('details.plan.destroy');
        Route::get('/plans/{url}/details/{idDetail}', [DetailPlanController::class, 'show'])->name('details.plan.show');
        /**
         * Routes Plans
         */
        Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');
        Route::get('/plans/create', [PlanController::class, 'create'])->name('plans.create');
        Route::post('/plans', [PlanController::class, 'store'])->name('plans.store');
        Route::get('/plans/{url}', [PlanController::class, 'show'])->name('plans.show');
        Route::get('/plans/{url}/edit', [PlanController::class, 'edit'])->name('plans.edit');
        Route::put('/plans/{url}', [PlanController::class, 'update'])->name('plans.update');
        Route::delete('/plans/{url}', [PlanController::class, 'destroy'])->name('plans.destroy');
        Route::any('plans/search', [PlanController::class, 'search'])->name('plans.search');

        /**
         * Home Dashboard
         */

        Route::get('/', [PlanController::class, 'index'])->name('admin.index');

        /**
         *Routes Users
         */
        Route::any('users/search', [UserController::class, 'search'])->name('users.search');
        Route::resource('users', UserController::class);

        /**
         *Routes Profile
         */
        Route::any('profiles/search', [ProfileController::class, 'search'])->name('profiles.search');
        Route::resource('profiles', ProfileController::class);

        /**
         *Routes Permission
         */
        Route::any('permissions/search', [PermissionController::class, 'search'])->name('permissions.search');
        Route::resource('permissions', PermissionController::class);


        /**
         *Routes Permission x Profile
         */
        Route::get('profiles/{id}/permission/{idPermission}/detach', [PermissionProfileController::class, 'detachPermissionProfile'])->name('profiles.permission.detach');
        Route::post('profiles/{id}/permissions', [PermissionProfileController::class, 'attchPermissionsProfile'])->name('profiles.permissions.attch');
        Route::any('profiles/{id}/permissions/create', [PermissionProfileController::class, 'permissionsAvailable'])->name('profiles.permissions.available');
        Route::get('profiles/{id}/permissions', [PermissionProfileController::class, 'permissions'])->name('profiles.permissions');
        Route::get('permissions/{id}/profile', [PermissionProfileController::class, 'profiles'])->name('permissions.profiles');


        /**
         *Routes Plans x Profile
         */
        Route::get('plans/{id}/profile/{idPermission}/detach', [PlanProfileController::class, 'detachPlanProfile'])->name('plans.profiles.detach');
        Route::post('plans/{id}/profiles', [PlanProfileController::class, 'attchPlansProfile'])->name('plans.profiles.attch');
        Route::any('plans/{id}/profiles/create', [PlanProfileController::class, 'profilesAvailable'])->name('plans.profiles.available');
        Route::get('plans/{id}/profiles', [PlanProfileController::class, 'profiles'])->name('plans.profiles');
        Route::get('profiles/{id}/plans', [PlanProfileController::class, 'plans'])->name('profiles.plans');
    });

    /**
    *Routes Sites
    */
    Route::get('/plan/{url}', [SiteController::class, 'plan'])->name('plan.subscription');
    Route::get('/', [SiteController::class, 'index'])->name('site.home');

require __DIR__ . '/auth.php';
