<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CompanyController as ControllersCompanyController;
use App\Http\Controllers\DashboardController as ControllersDashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Main\CategoryController;
use App\Http\Controllers\Main\CompanyController as MainCompanyController;
use App\Http\Controllers\Main\DashboardController as MainDashboardController;
use App\Http\Controllers\Main\DepartementController;
use App\Http\Controllers\Main\LocationController as MainLocationController;
use App\Http\Controllers\Main\ManufactureController;
use App\Http\Controllers\Main\PositionController;
use App\Http\Controllers\Main\SupplierController;
use App\Http\Controllers\Main\UserController;
use App\Models\User;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::controller(LoginController::class)->group(function() {
    Route::get('/', 'index')->name('login.index')->middleware('guest');
    Route::post('/login/authenticate', 'authenticate')->name('login.authenticate');
    Route::get('/logout', 'logout')->name('logout')->middleware('auth');
});

Route::controller(MainDashboardController::class)->group(function() {
    Route::get('/dashboard', 'index')->name('dashboard')->middleware('auth', 'check.menu.access:dashboardIndex');
});

Route::controller(MainCompanyController::class)->group(function() {
    Route::get('/company', 'index')->name('company.index')->middleware('auth', 'check.menu.access:companyIndex');
    Route::get('/company/create', 'create')->name('company.create')->middleware('auth', 'check.menu.access:companyCreate');
    Route::post('/company/store', 'store')->name('company.store')->middleware('auth', 'check.menu.access:companyCreate');
    Route::get('/company/edit/{company:companyId}', 'edit')->name('company.edit')->middleware('auth', 'check.menu.access:companyEdit');
    Route::post('/company/update/{company:companyId}', 'update')->name('company.update')->middleware('auth', 'check.menu.access:companyEdit');
    Route::delete('/company/destroy/{company:companyId}', 'destroy')->name('company.destroy')->middleware('auth', 'check.menu.access:companyDelete');
});

Route::controller(MainLocationController::class)->group(function() {
    Route::get('/location', 'index')->name('location.index')->middleware('auth', 'check.menu.access:locationIndex');
    Route::get('/location/create', 'create')->name('location.create')->middleware('auth', 'check.menu.access:locationCreate');
    Route::post('/location/store', 'store')->name('location.store')->middleware('auth', 'check.menu.access:locationCreate');
    Route::get('/location/edit/{location:locationId}', 'edit')->name('location.edit')->middleware('auth', 'check.menu.access:locationEdit');
    Route::post('/location/update/{location:locationId}', 'update')->name('location.update')->middleware('auth', 'check.menu.access:locationEdit');
    Route::delete('/location/destroy/{location:locationId}', 'destroy')->name('location.destroy')->middleware('auth', 'check.menu.access:locationDelete');
});

Route::controller(DepartementController::class)->group(function() {
    Route::get('/departement', 'index')->name('departement.index')->middleware('auth', 'check.menu.access:departementIndex');
    Route::get('/departement/create', 'create')->name('departement.create')->middleware('auth', 'check.menu.access:departementCreate');
    Route::post('/departement/store', 'store')->name('departement.store')->middleware('auth', 'check.menu.access:departementCreate');
    Route::get('/departement/edit/{departement:departementId}', 'edit')->name('departement.edit')->middleware('auth', 'check.menu.access:departementEdit');
    Route::post('/departement/update/{departement:departementId}', 'update')->name('departement.update')->middleware('auth', 'check.menu.access:departementEdit');
    Route::delete('/departement/destroy/{departement:departementId}', 'destroy')->name('departement.destroy')->middleware('auth', 'check.menu.access:departementDelete');
});

Route::controller(PositionController::class)->group(function() {
    Route::get('/position', 'index')->name('position.index')->middleware('auth', 'check.menu.access:positionIndex');
    Route::get('/position/create', 'create')->name('position.create')->middleware('auth', 'check.menu.access:positionCreate');
    Route::post('/position/store', 'store')->name('position.store')->middleware('auth', 'check.menu.access:positionCreate');
    Route::get('/position/edit/{position:positionId}', 'edit')->name('position.edit')->middleware('auth', 'check.menu.access:positionEdit');
    Route::post('/position/update/{position:positionId}', 'update')->name('position.update')->middleware('auth', 'check.menu.access:positionEdit');
    Route::delete('/position/destroy/{position:positionId}', 'destroy')->name('position.destroy')->middleware('auth', 'check.menu.access:positionDelete');
});

Route::controller(UserController::class)->group(function() {
    Route::get('/user', 'index')->name('user.index')->middleware('auth', 'check.menu.access:userIndex');
    Route::get('/user/create', 'create')->name('user.create')->middleware('auth', 'check.menu.access:userCreate');
    Route::post('/user/store', 'store')->name('user.store')->middleware('auth', 'check.menu.access:userCreate');
    Route::get('/user/permission/{user:userId}', 'permission')->name('user.permission')->middleware('auth', 'check.menu.access:userPermission');
    Route::post('/user/permission/create/{user:userId}', 'permissionCreate')->name('user.permission.create')->middleware('auth', 'check.menu.access:userPermission');
    Route::get('/user/edit/{user:userId}', 'edit')->name('user.edit')->middleware('auth', 'check.menu.access:userEdit');
    Route::post('/user/update/{user:userId}', 'update')->name('user.update')->middleware('auth', 'check.menu.access:userEdit');
    Route::post('/user/resetPassword/{user:userId}', 'resetPassword')->name('user.resetPassword')->middleware('auth', 'check.menu.access:userEdit');
    Route::delete('/user/destroy/{user:userId}', 'destroy')->name('user.destroy')->middleware('auth', 'check.menu.access:userDelete');
});

Route::controller(SupplierController::class)->group(function() {
    Route::get('/supplier', 'index')->name('supplier.index')->middleware('auth', 'check.menu.access:supplierIndex');
    Route::get('/supplier/create', 'create')->name('supplier.create')->middleware('auth', 'check.menu.access:supplierCreate');
    Route::post('/supplier/store', 'store')->name('supplier.store')->middleware('auth', 'check.menu.access:supplierCreate');
    Route::get('/supplier/edit/{supplier:supplierId}', 'edit')->name('supplier.edit')->middleware('auth', 'check.menu.access:supplierEdit');
    Route::post('/supplier/update/{supplier:supplierId}', 'update')->name('supplier.update')->middleware('auth', 'check.menu.access:supplierEdit');
    Route::delete('/supplier/destroy/{supplier:supplierId}', 'destroy')->name('supplier.destroy')->middleware('auth', 'check.menu.access:supplierDelete');
});

Route::controller(ManufactureController::class)->group(function() {
    Route::get('/manufacture', 'index')->name('manufacture.index')->middleware('auth', 'check.menu.access:manufactureIndex');
    Route::get('/manufacture/create', 'create')->name('manufacture.create')->middleware('auth', 'check.menu.access:manufactureCreate');
    Route::post('/manufacture/store', 'store')->name('manufacture.store')->middleware('auth', 'check.menu.access:manufactureCreate');
    Route::get('/manufacture/edit/{manufacture:manufactureId}', 'edit')->name('manufacture.edit')->middleware('auth', 'check.menu.access:manufactureEdit');
    Route::post('/manufacture/update/{manufacture:manufactureId}', 'update')->name('manufacture.update')->middleware('auth', 'check.menu.access:manufactureEdit');
    Route::delete('/manufacture/destroy/{manufacture:manufactureId}', 'destroy')->name('manufacture.destroy')->middleware('auth', 'check.menu.access:manufactureDelete');
});

Route::controller(CategoryController::class)->group(function() {
    Route::get('/category', 'index')->name('category.index');
    Route::get('/category/create', 'create')->name('category.create');
    Route::post('/category/store', 'store')->name('category.store');
    Route::get('/category/edit/{category:categoryId}', 'edit')->name('category.edit');
    Route::post('/category/update/{category:categoryId}', 'update')->name('category.update');
    Route::delete('/category/destroy/{category:categoryId}', 'destroy')->name('category.destroy');
});