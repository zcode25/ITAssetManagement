<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Models\AssetProcurement;
use App\Http\Controllers\Controller;
use App\Models\AssetProcurementDetail;
use App\Models\AssetProcurementDevice;
use App\Models\Supplier;

class AssetPurchase extends Controller
{
    public function index() {
        return view('assetPurchase.index', [
            'assetProcurements' => AssetProcurement::where('assetProcurementType', 'Asset Purchase')->get(),
        ]);
    }

    public function detail(AssetProcurement $assetProcurement) {
        return view('assetProcurement.detail', [
            'assetProcurement' => AssetProcurement::where('assetProcurementId', $assetProcurement->assetProcurementId)->first(),
            'assetProcurementDevices' => AssetProcurementDevice::where('assetProcurementId', $assetProcurement->assetProcurementId)->get(),
            'assetProcurementDetails' => AssetProcurementDetail::where('assetProcurementId', $assetProcurement->assetProcurementId)->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function purchase(AssetProcurement $assetProcurement) {
        return view('assetPurchase.purchase', [
            'assetProcurement' => AssetProcurement::where('assetProcurementId', $assetProcurement->assetProcurementId)->first(),
            'assetProcurementDevices' => AssetProcurementDevice::where('assetProcurementId', $assetProcurement->assetProcurementId)->get(),
            'suppliers' => Supplier::all() 
        ]);
    }

    public function purchaseStore(AssetProcurement $assetProcurement, Request $request) {
        dd($request);
    }
}
