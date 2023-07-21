<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DetailPlanController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PermissionProfileController;
use App\Http\Controllers\PermissionRoleController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PlanProfileController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoleUserController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\TenantController;
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

        // Route::get('test', function () {
        //     dd(auth()->user()->hasPermissionRole());
        // });

        /**
         * Permission x Role
         */

         Route::get('roles/{id}/permission/{idRole}/detach', [PermissionRoleController::class, 'detachPermissionRole'])->name('roles.permission.detach');
         Route::post('roles/{id}/permissions', [PermissionRoleController::class, 'attachPermissionsRole'])->name('roles.permissions.attach');
         Route::any('roles/{id}/permissions/create', [PermissionRoleController::class, 'permissionsAvailable'])->name('roles.permissions.available');
         Route::get('roles/{id}/permissions', [PermissionRoleController::class, 'permissions'])->name('roles.permissions');
         Route::get('permissions/{id}/role', [PermissionRoleController::class, 'roles'])->name('permissions.roles');


        // Route::get('roles/{id}/permission/{idPermission}/detach', [PermissionRoleController::class, 'detachPermissionRole'])->name('roles.permission.detach');
        // Route::get('roles/{id}/permissions', [PermissionRoleController::class, 'attachPermissionsRole'])->name('roles.permissions.attach');
        // Route::any('roles/{id}/permissions/create', [PermissionRoleController::class, 'permissionsAvailable'])->name('roles.permissions.available');
        // Route::get('roles/{id}/permissions', [PermissionRoleController::class, 'permissions'])->name('roles.permissions');
        // Route::get('permissions/{id}/role', [PermissionRoleController::class, 'roles'])->name('permissions.roles');

        /**
         *roles Plans x users
         */
        Route::get('users/{id}/role/{idRole}/detach', [RoleUserController::class, 'detachRoleUser'])->name('users.role.detach');
        Route::post('users/{id}/roles', [RoleUserController::class, 'attachRolesUser'])->name('users.roles.attch');
        Route::any('users/{id}/roles/create', [RoleUserController::class, 'rolesAvailable'])->name('users.roles.available');
        Route::get('users/{id}/roles', [RoleUserController::class, 'roles'])->name('users.roles');
        Route::get('roles/{id}/users', [RoleUserController::class, 'users'])->name('roles.users');


        /**
         *Routes Role
         */
        Route::any('roles/search', [RoleController::class, 'search'])->name('roles.search');
        Route::resource('roles', RoleController::class);

        /**
         *Routes Tenant
         */
        Route::any('tenants/search', [TenantController::class, 'search'])->name('tenants.search');
        Route::resource('tenants', TenantController::class);


        /**
         *Routes Table
         */

        Route::get('tables/qrcode/{identify}', [TableController::class, 'qrcode'])->name('tables.qrcode');
        Route::any('tables/search', [TableController::class, 'search'])->name('tables.search');
        Route::resource('tables', TableController::class);

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

        Route::get('/', [DashboardController::class, 'home'])->name('admin.index');

        /**
         *Routes Users
         */
        Route::any('users/search', [UserController::class, 'search'])->name('users.search');
        Route::resource('users', UserController::class);

        /**
         *Routes Categories
         */
        Route::any('categories/search', [CategoryController::class, 'search'])->name('categories.search');
        Route::resource('categories', CategoryController::class);

        /**
         *Routes Profile
         */
        Route::any('profiles/search', [ProfileController::class, 'search'])->name('profiles.search');
        Route::resource('profiles', ProfileController::class);

        /**
         *Routes Products
         */
        Route::any('products/search', [ProductsController::class, 'search'])->name('products.search');
        Route::resource('products', ProductsController::class);

        /**
         *Routes Category x Product
         */
        Route::get('products/{id}/category/{idCategory}/detach', [CategoryProductController::class, 'detachCategoryProduct'])->name('products.category.detach');
        Route::post('products/{id}/categories', [CategoryProductController::class, 'attchCategoriesProduct'])->name('products.categories.attch');
        Route::any('products/{id}/categories/create', [CategoryProductController::class, 'categoriesAvailable'])->name('products.categories.available');
        Route::get('products/{id}/categories', [CategoryProductController::class, 'categories'])->name('products.categories');
        Route::get('categories/{id}/products', [CategoryProductController::class, 'products'])->name('categories.products');

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
        Route::get('plans/{id}/profile/{idPermission}/detach', [PlanProfileController::class, 'detachProfilePlan'])->name('plans.profile.detach');
        Route::post('plans/{id}/profiles', [PlanProfileController::class, 'attachProfilesPlan'])->name('plans.profiles.attch');
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
