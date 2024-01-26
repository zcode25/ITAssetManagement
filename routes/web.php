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
    Route::get('/', 'index')->name('login.index')->middleware('guest');
    Route::post('/login/authenticate', 'authenticate')->name('login.authenticate');
    Route::get('/logout', 'logout')->name('logout')->middleware('auth');
});

Route::controller(MainDashboardController::class)->group(function() {
    Route::get('/dashboard', 'index')->name('dashboard')->middleware('auth');
});

Route::controller(MainCompanyController::class)->group(function() {
    Route::get('/company', 'index')->name('company.index')->middleware('auth');
    Route::get('/company/create', 'create')->name('company.create')->middleware('auth');
    Route::post('/company/store', 'store')->name('company.store')->middleware('auth');
    Route::get('/company/edit/{company:companyId}', 'edit')->name('company.edit')->middleware('auth');
    Route::post('/company/update/{company:companyId}', 'update')->name('company.update')->middleware('auth');
    Route::delete('/company/destroy/{company:companyId}', 'destroy')->name('company.destroy')->middleware('auth');
});

Route::controller(MainLocationController::class)->group(function() {
    Route::get('/location', 'index')->name('location.index')->middleware('auth');
    Route::get('/location/create', 'create')->name('location.create')->middleware('auth');
    Route::post('/location/store', 'store')->name('location.store')->middleware('auth');
    Route::get('/location/edit/{location:locationId}', 'edit')->name('location.edit')->middleware('auth');
    Route::post('/location/update/{location:locationId}', 'update')->name('location.update')->middleware('auth');
    Route::delete('/location/destroy/{location:locationId}', 'destroy')->name('location.destroy')->middleware('auth');
});

Route::controller(DepartementController::class)->group(function() {
    Route::get('/departement', 'index')->name('departement.index')->middleware('auth');
    Route::get('/departement/create', 'create')->name('departement.create')->middleware('auth');
    Route::post('/departement/store', 'store')->name('departement.store')->middleware('auth');
    Route::get('/departement/edit/{departement:departementId}', 'edit')->name('departement.edit')->middleware('auth');
    Route::post('/departement/update/{departement:departementId}', 'update')->name('departement.update')->middleware('auth');
    Route::delete('/departement/destroy/{departement:departementId}', 'destroy')->name('departement.destroy')->middleware('auth');
});

Route::controller(PositionController::class)->group(function() {
    Route::get('/position', 'index')->name('position.index')->middleware('auth');
    Route::get('/position/create', 'create')->name('position.create')->middleware('auth');
    Route::post('/position/store', 'store')->name('position.store')->middleware('auth');
    Route::get('/position/edit/{position:positionId}', 'edit')->name('position.edit')->middleware('auth');
    Route::post('/position/update/{position:positionId}', 'update')->name('position.update')->middleware('auth');
    Route::delete('/position/destroy/{position:positionId}', 'destroy')->name('position.destroy')->middleware('auth');
});

Route::controller(UserController::class)->group(function() {
    Route::get('/user', 'index')->name('user.index')->middleware('auth');
    Route::get('/user/create', 'create')->name('user.create')->middleware('auth');
    Route::post('/user/store', 'store')->name('user.store')->middleware('auth');
});