<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\Main\AccessoryModelController;
use App\Http\Controllers\Main\AssetArchiveController;
use App\Http\Controllers\Main\AssetBrokenController;
use App\Http\Controllers\Main\AssetController;
use App\Http\Controllers\Main\AssetDeploymentController;
use App\Http\Controllers\Main\AssetDepreciationController;
use App\Http\Controllers\Main\AssetDisposalController;
use App\Http\Controllers\Main\AssetModelController;
use App\Http\Controllers\Main\AssetMovementController;
use App\Http\Controllers\Main\AssetProcurementController;
use App\Http\Controllers\Main\AssetPurchaseController as MainAssetPurchaseController;
use App\Http\Controllers\Main\AssetRepairController;
use App\Http\Controllers\Main\CategoryController;
use App\Http\Controllers\Main\CompanyController as MainCompanyController;
use App\Http\Controllers\Main\ComponentModelController;
use App\Http\Controllers\Main\ConsumableModelController;
use App\Http\Controllers\Main\DashboardController as MainDashboardController;
use App\Http\Controllers\Main\DepartementController;
use App\Http\Controllers\Main\DepreciationController;
use App\Http\Controllers\Main\LicenseModelController;
use App\Http\Controllers\Main\LocationController as MainLocationController;
use App\Http\Controllers\Main\ManufactureController;
use App\Http\Controllers\Main\PositionController;
use App\Http\Controllers\Main\SupplierController;
use App\Http\Controllers\Main\UserController;
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
    Route::get('/category', 'index')->name('category.index')->middleware('auth', 'check.menu.access:categoryIndex');
    Route::get('/category/create', 'create')->name('category.create')->middleware('auth', 'check.menu.access:categoryCreate');
    Route::post('/category/store', 'store')->name('category.store')->middleware('auth', 'check.menu.access:categoryCreate');
    Route::get('/category/edit/{category:categoryId}', 'edit')->name('category.edit')->middleware('auth', 'check.menu.access:categoryEdit');
    Route::post('/category/update/{category:categoryId}', 'update')->name('category.update')->middleware('auth', 'check.menu.access:categoryEdit');
    Route::delete('/category/destroy/{category:categoryId}', 'destroy')->name('category.destroy')->middleware('auth', 'check.menu.access:categoryDelete');
});

Route::controller(AssetModelController::class)->group(function() {
    Route::get('/assetModel', 'index')->name('assetModel.index')->middleware('auth', 'check.menu.access:assetModelIndex');
    Route::get('/assetModel/create', 'create')->name('assetModel.create')->middleware('auth', 'check.menu.access:assetModelCreate');
    Route::post('/assetModel/store', 'store')->name('assetModel.store')->middleware('auth', 'check.menu.access:assetModelCreate');
    Route::get('/assetModel/edit/{assetModel:assetModelId}', 'edit')->name('assetModel.edit')->middleware('auth', 'check.menu.access:assetModelUpdate');
    Route::post('/assetModel/update/{assetModel:assetModelId}', 'update')->name('assetModel.update')->middleware('auth', 'check.menu.access:assetModelUpdate');
    Route::delete('/assetModel/destroy/{assetModel:assetModelId}', 'destroy')->name('assetModel.destroy')->middleware('auth', 'check.menu.access:assetModelDelete');
});

Route::controller(AssetProcurementController::class)->group(function () {
    Route::get('/assetProcurementAll', 'all')->name('assetProcurementAll.all')->middleware('auth', 'check.menu.access:assetProcurementAllIndex');
    Route::get('/assetProcurementAll/detail/{assetProcurement:assetProcurementId}', 'detail')->name('assetProcurementAllDetail.detail')->middleware('auth', 'check.menu.access:assetProcurementAllIndex');
    Route::get('/assetProcurement', 'index')->name('assetProcurement.index')->middleware('auth', 'check.menu.access:assetProcurementIndex');
    Route::get('/assetProcurement/detail/{assetProcurement:assetProcurementId}', 'detail')->name('assetProcurementDetail.detail')->middleware('auth', 'check.menu.access:assetProcurementIndex');
    Route::get('/assetProcurement/create', 'create')->name('assetProcurement.create')->middleware('auth', 'check.menu.access:assetProcurementIndex');
    Route::post('/assetProcurement/store', 'store')->name('assetProcurement.store')->middleware('auth', 'check.menu.access:assetProcurementIndex');
    Route::get('/assetProcurement/device/{assetProcurement:assetProcurementId}', 'device')->name('assetProcurement.device')->middleware('auth', 'check.menu.access:assetProcurementIndex');
    Route::post('/assetProcurement/device/store/{assetProcurement:assetProcurementId}', 'deviceStore')->name('assetProcurement.deviceStore')->middleware('auth', 'check.menu.access:assetProcurementIndex');
    Route::delete('/assetProcurement/device/destroy/{assetProcurementDevice:assetProcurementDeviceId}', 'deviceDestroy')->name('assetProcurement.deviceDestroy')->middleware('auth', 'check.menu.access:assetProcurementIndex');
    Route::get('/assetProcurement/save/{assetProcurement:assetProcurementId}', 'deviceSave')->name('assetProcurement.save')->middleware('auth', 'check.menu.access:assetProcurementIndex');;
    Route::get('/assetProcurementApprovalManager', 'approvalManager')->name('assetProcurementApprovalManager.index')->middleware('auth', 'check.menu.access:assetProcurementApprovalManager');
    Route::get('/assetProcurementApprovalManager/approval/{assetProcurement:assetProcurementId}', 'approvalManagerCreate')->name('assetProcurementApprovalManager.create')->middleware('auth', 'check.menu.access:assetProcurementApprovalManager');
    Route::post('/assetProcurementApprovalManager/approval/store/{assetProcurement:assetProcurementId}', 'approvalManagerStore')->name('assetProcurement.approvalManagerStore')->middleware('auth', 'check.menu.access:assetProcurementApprovalManager');
    Route::get('/assetProcurementApprovalManager/detail/{assetProcurement:assetProcurementId}', 'detail')->name('assetProcurementDetail.detail')->middleware('auth', 'check.menu.access:assetProcurementApprovalManager');
    Route::get('/assetProcurementApprovalITManager', 'approvalITManager')->name('/assetProcurementApprovalITManager.index')->middleware('auth', 'check.menu.access:assetProcurementApprovalITManager');
    Route::get('/assetProcurementApprovalITManager/approval/{assetProcurement:assetProcurementId}', 'approvalITManagerCreate')->name('assetProcurementApprovalITManager.create')->middleware('auth', 'check.menu.access:assetProcurementApprovalITManager');
    Route::post('/assetProcurementApprovalITManager/approval/store/{assetProcurement:assetProcurementId}', 'approvalITManagerStore')->name('assetProcurement.approvalITManagerStore')->middleware('auth', 'check.menu.access:assetProcurementApprovalITManager');
    Route::get('/assetProcurementApprovalITManager/detail/{assetProcurement:assetProcurementId}', 'detail')->name('assetProcurementDetail.detail')->middleware('auth', 'check.menu.access:assetProcurementApprovalITManager');
});

Route::controller(MainAssetPurchaseController::class)->group(function() {
    Route::get('/assetPurchase', 'index')->name('assetPurchase.index')->middleware('auth', 'check.menu.access:assetPurchaseIndex');
    Route::get('/assetPurchase/detail/{assetProcurement:assetProcurementId}', 'detail')->name('assetPurchase.detail')->middleware('auth', 'check.menu.access:assetPurchaseIndex');
    Route::get('/assetPurchase/purchase/{assetProcurement:assetProcurementId}', 'purchase')->name('assetPurchase.purchase')->middleware('auth', 'check.menu.access:assetPurchaseIndex');
    Route::post('/assetPurchase/purchase/store/{assetProcurement:assetProcurementId}', 'purchaseStore')->name('assetPurchase.purchaseStore')->middleware('auth', 'check.menu.access:assetPurchaseIndex');
    Route::get('/assetPurchase/deployment/{assetProcurement:assetProcurementId}', 'deployment')->name('assetPurchase.deployment')->middleware('auth', 'check.menu.access:assetPurchaseIndex');
    Route::post('/assetPurchase/deployment/store/{assetProcurement:assetProcurementId}', 'deploymentStore')->name('assetPurchase.deploymentStore')->middleware('auth', 'check.menu.access:assetPurchaseIndex');
});

Route::controller(AssetMovementController::class)->group(function() {
    Route::get('/assetMovement', 'index')->name('assetMovement.index')->middleware('auth');
    Route::get('/assetMovement/movement/{assetProcurement:assetProcurementId}', 'movement')->name('assetMovement.movement')->middleware('auth');
    Route::get('/assetMovement/detail/{assetProcurement:assetProcurementId}', 'detail')->name('assetMovement.detail')->middleware('auth');
    Route::post('/assetMovement/movement/store/{assetProcurement:assetProcurementId}', 'movementStore')->name('assetMovement.movementStore')->middleware('auth');
    Route::get('/assetMovement/device/{assetProcurement:assetProcurementId}', 'device')->name('assetMovement.device')->middleware('auth');
    Route::post('/assetMovement/device/store/{assetProcurement:assetProcurementId}', 'deviceStore')->name('assetMovement.deviceStore')->middleware('auth');
    Route::delete('/assetMovement/device/destroy/{assetMovementDevice:assetMovementDeviceId}', 'deviceDestroy')->name('assetMovement.deviceDestroy')->middleware('auth');
    Route::post('/assetMovement/device/save/{assetMovement:assetMovementId}', 'deviceSave')->name('assetMovement.deviceSave')->middleware('auth');
});

Route::controller(AssetDeploymentController::class)->group(function() {
    Route::get('/assetDeploymentAll', 'all')->name('assetDeploymentAll.all')->middleware('auth', 'check.menu.access:assetDeploymentAllIndex');
    Route::get('/assetDeploymentAll/detail/{assetDeployment:assetDeploymentId}', 'detail')->name('assetDeploymentAll.detail')->middleware('auth', 'check.menu.access:assetDeploymentAllIndex');
    Route::get('/assetDeploymentPre', 'preDeployment')->name('assetDeployment.preDeployment')->middleware('auth', 'check.menu.access:assetDeploymentIndex');
    Route::get('/assetDeploymentPre/manage/{assetDeployment:assetDeploymentId}', 'preDeploymentManage')->name('assetDeployment.preDeploymentManage')->middleware('auth', 'check.menu.access:assetPreDeploymentIndex');
    Route::post('/assetDeploymentPre/manage/store/{assetDeployment:assetDeploymentId}', 'preDeploymentManageStore')->name('assetDeployment.preDeploymentManageStore')->middleware('auth', 'check.menu.access:assetPreDeploymentAllIndex');
    Route::get('/assetDeploymentPre/detail/{assetDeployment:assetDeploymentId}', 'detail')->name('assetDeploymentPre.detail')->middleware('auth', 'check.menu.access:assetPreDeploymentIndex');
    Route::get('/assetDeploymentReady', 'deploymentReady')->name('assetDeployment.deploymentReady')->middleware('auth', 'check.menu.access:assetDeploymentReadyIndex');
    Route::get('/assetDeploymentReady/checkout/{assetDeployment:assetDeploymentId}', 'deploymentReadyCheckout')->name('assetDeployment.deploymentReadyCheckout')->middleware('auth', 'check.menu.access:assetDeploymentReadyIndex');
    Route::get('/assetDeploymentReady/detail/{assetDeployment:assetDeploymentId}', 'detail')->name('assetDeploymentReady.detail')->middleware('auth', 'check.menu.access:assetDeploymentReadyIndex');
    Route::post('/assetDeploymentReady/checkout/store/{assetDeployment:assetDeploymentId}', 'deploymentReadyCheckoutStore')->name('assetDeployment.deploymentReadyCheckoutStore')->middleware('auth', 'check.menu.access:assetDeploymentReadyIndex');
    Route::get('/assetDeploymentCheckout', 'deploymentCheckout')->name('assetDeployment.deploymentCheckout')->middleware('auth', 'check.menu.access:assetDeploymentCheckoutIndex');
    Route::get('/assetDeploymentCheckout/detail/{assetDeployment:assetDeploymentId}', 'detail')->name('assetDeploymentCheckout.detail')->middleware('auth', 'check.menu.access:assetDeploymentCheckoutIndex');
    Route::get('/assetDeploymentCheckout/checkin/{assetDeployment:assetDeploymentId}', 'deploymentCheckoutCheckin')->name('assetDeploymentCheckout.checkin')->middleware('auth', 'check.menu.access:assetDeploymentCheckoutIndex');
    Route::post('/assetDeploymentCheckout/checkin/store/{assetDeployment:assetDeploymentId}', 'deploymentCheckoutCheckinStore')->name('assetDeploymentCheckout.checkinStore')->middleware('auth', 'check.menu.access:assetDeploymentCheckoutIndex');
});

Route::controller(AssetController::class)->group(function() {
    Route::get('/asset', 'index')->name('asset.index')->middleware('auth', 'check.menu.access:assetIndex');
    Route::get('/asset/detail/{assetDeployment:assetDeploymentId}', 'detail')->name('asset.detail')->middleware('auth', 'check.menu.access:assetIndex');
});

Route::controller(AssetArchiveController::class)->group(function() {
    Route::get('/assetArchive', 'index')->name('assetArchive.index')->middleware('auth', 'check.menu.access:assetArchiveIndex');
    Route::get('/assetArchive/detail/{assetDeployment:assetDeploymentId}', 'detail')->name('assetArchive.detail')->middleware('auth', 'check.menu.access:assetArchiveIndex');
    Route::get('/assetArchive/manage/{assetDeployment:assetDeploymentId}', 'manage')->name('assetArchive.manage')->middleware('auth', 'check.menu.access:assetArchiveIndex');
    Route::post('/assetArchive/manage/store/{assetDeployment:assetDeploymentId}', 'manageStore')->name('assetArchive.manageStore')->middleware('auth', 'check.menu.access:assetArchiveIndex');
});

Route::controller(AssetRepairController::class)->group(function() {
    Route::get('/assetRepair', 'index')->name('assetRepair.index')->middleware('auth', 'check.menu.access:assetRepairIndex');
    Route::get('/assetRepair/detail/{assetDeployment:assetDeploymentId}', 'detail')->name('assetRepair.detail')->middleware('auth', 'check.menu.access:assetRepairIndex');
    Route::get('/assetRepair/manage/{assetDeployment:assetDeploymentId}', 'manage')->name('assetRepair.manage')->middleware('auth', 'check.menu.access:assetRepairIndex');
    Route::post('/assetRepair/manage/store/{assetDeployment:assetDeploymentId}', 'manageStore')->name('assetRepair.manageStore')->middleware('auth', 'check.menu.access:assetRepairIndex');
});

Route::controller(AssetBrokenController::class)->group(function() {
    Route::get('/assetBroken', 'index')->name('assetBroken.index')->middleware('auth', 'check.menu.access:assetBrokenIndex');
    Route::get('/assetBroken/detail/{assetDeployment:assetDeploymentId}', 'detail')->name('assetBroken.detail')->middleware('auth', 'check.menu.access:assetBrokenIndex');
    Route::get('/assetBroken/manage/{assetDeployment:assetDeploymentId}', 'manage')->name('assetBroken.manage')->middleware('auth', 'check.menu.access:assetBrokenIndex');
    Route::post('/assetBroken/manage/store/{assetDeployment:assetDeploymentId}', 'manageStore')->name('assetBroken.manageStore')->middleware('auth', 'check.menu.access:assetBrokenIndex');
});

Route::controller(AssetDisposalController::class)->group(function() {
    Route::get('/assetDisposal', 'index')->name('assetDisposal.index')->middleware('auth', 'check.menu.access:assetDisposalIndex');
    Route::get('/assetDisposal/create', 'create')->name('assetDisposal.create')->middleware('auth', 'check.menu.access:assetDisposalIndex');
    Route::post('/assetDisposal/store', 'store')->name('assetDisposal.store')->middleware('auth', 'check.menu.access:assetDisposalIndex');
    Route::get('/assetDisposal/device/{assetDisposal:assetDisposalId}', 'device')->name('assetDisposal.device')->middleware('auth', 'check.menu.access:assetDisposalIndex');
    Route::post('/assetDisposal/device/store/{assetDisposal:assetDisposalId}', 'deviceStore')->name('assetDisposal.deviceStore')->middleware('auth', 'check.menu.access:assetDisposalIndex');
    Route::delete('/assetDisposal/device/destroy/{assetDisposalDevice:assetDisposalDeviceId}', 'deviceDestroy')->name('assetDisposal.deviceDestroy')->middleware('auth', 'check.menu.access:assetDisposalIndex');
    Route::get('/assetDisposal/device/save/{assetDisposal:assetDisposalId}', 'deviceSave')->name('assetDisposal.deviceSave')->middleware('auth', 'check.menu.access:assetDisposalIndex');
    Route::get('/assetDisposal/disposal/{assetDisposal:assetDisposalId}', 'disposal')->name('assetDisposal.disposal')->middleware('auth', 'check.menu.access:assetDisposalIndex');
    Route::post('/assetDisposal/disposal/store/{assetDisposal:assetDisposalId}', 'disposalStore')->name('assetDisposal.disposalStore')->middleware('auth', 'check.menu.access:assetDisposalIndex');
    Route::get('/assetDisposal/detail/{assetDisposal:assetDisposalId}', 'detail')->name('assetDisposal.detail')->middleware('auth', 'check.menu.access:assetDisposalIndex');
});

Route::controller(DepreciationController::class)->group(function() {
    Route::get('/depreciation', 'index')->name('depreciation.index')->middleware('auth', 'check.menu.access:depreciationIndex');
    Route::get('/depreciation/create', 'create')->name('depreciation.create')->middleware('auth', 'check.menu.access:depreciationCreate');
    Route::post('/depreciation/store', 'store')->name('depreciation.store')->middleware('auth', 'check.menu.access:depreciationCreate');
    Route::get('/depreciation/edit/{depreciation:depreciationId}', 'edit')->name('depreciation.edit')->middleware('auth', 'check.menu.access:depreciationEdit');
    Route::post('/depreciation/update/{depreciation:depreciationId}', 'update')->name('depreciation.update')->middleware('auth', 'check.menu.access:depreciationEdit');
    Route::delete('/depreciation/destroy/{depreciation:depreciationId}', 'destroy')->name('depreciation.destroy')->middleware('auth', 'check.menu.access:depreciationDelete');
});

Route::controller(AssetDepreciationController::class)->group(function() {
    Route::get('/assetDepreciation', 'index')->name('assetDepreciation.index')->middleware('auth', 'check.menu.access:assetDepreciationIndex');
});