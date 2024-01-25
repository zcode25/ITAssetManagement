<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CompanyController as ControllersCompanyController;
use App\Http\Controllers\DashboardController as ControllersDashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Main\CompanyController as MainCompanyController;
use App\Http\Controllers\Main\DashboardController as MainDashboardController;
use App\Http\Controllers\Main\DepartementController;
use App\Http\Controllers\Main\LocationController as MainLocationController;
use App\Http\Controllers\Main\PositionController;
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
    Route::get('/', 'index')->name('login.index');
    Route::post('/login/authenticate', 'authenticate')->name('login.authenticate');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(MainDashboardController::class)->group(function() {
    Route::get('/dashboard', 'index')->name('dashboard');
});

Route::controller(MainCompanyController::class)->group(function() {
    Route::get('/company', 'index')->name('company.index');
    Route::get('/company/create', 'create')->name('company.create');
    Route::post('/company/store', 'store')->name('company.store');
    Route::get('/company/edit/{company:companyId}', 'edit')->name('company.edit');
    Route::post('/company/update/{company:companyId}', 'update')->name('company.update');
    Route::delete('/company/destroy/{company:companyId}', 'destroy')->name('company.destroy');
});

Route::controller(MainLocationController::class)->group(function() {
    Route::get('/location', 'index')->name('location.index');
    Route::get('/location/create', 'create')->name('location.create');
    Route::post('/location/store', 'store')->name('location.store');
    Route::get('/location/edit/{location:locationId}', 'edit')->name('location.edit');
    Route::post('/location/update/{location:locationId}', 'update')->name('location.update');
    Route::delete('/location/destroy/{location:locationId}', 'destroy')->name('location.destroy');
});

Route::controller(DepartementController::class)->group(function() {
    Route::get('/departement', 'index')->name('departement.index');
    Route::get('/departement/create', 'create')->name('departement.create');
    Route::post('/departement/store', 'store')->name('departement.store');
    Route::get('/departement/edit/{departement:departementId}', 'edit')->name('departement.edit');
    Route::post('/departement/update/{departement:departementId}', 'update')->name('departement.update');
    Route::delete('/departement/destroy/{departement:departementId}', 'destroy')->name('departement.destroy');
});

Route::controller(PositionController::class)->group(function() {
    Route::get('/position', 'index')->name('position.index');
    Route::get('/position/create', 'create')->name('position.create');
    Route::post('/position/store', 'store')->name('position.store');
    Route::get('/position/edit/{position:positionId}', 'edit')->name('position.edit');
    Route::post('/position/update/{position:positionId}', 'update')->name('position.update');
    Route::delete('/position/destroy/{position:positionId}', 'destroy')->name('position.destroy');
});

Route::controller(UserController::class)->group(function() {
    Route::get('/user', 'index')->name('user.index');
    Route::get('/user/create', 'create')->name('user.create');
    Route::post('/user/store', 'store')->name('user.store');
});