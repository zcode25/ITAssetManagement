<?php

namespace App\Http\Controllers\Main;

use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AssetProcurement;
use App\Http\Controllers\Controller;
use App\Models\AssetDeployment;
use App\Models\AssetProcurementDetail;
use App\Models\AssetProcurementDevice;
use App\Models\AssetPurchase as ModelsAssetPurchase;

class AssetPurchase extends Controller
{
    public function index() {
        return view('assetPurchase.index', [
            'assetProcurements' => AssetProcurement::where('assetProcurementType', 'Asset Purchase')
                                                        ->whereNot('assetProcurementStatus', 'Rejected by IT Manager')
                                                        ->get(),
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
        // dd($request);
        $validatedData = $request->validate([
            'assetPurchaseDate' => 'required',
            'assetPurchaseNumber' => 'required',
            'supplierId' => 'required',
        ]);

        $validatedData['assetPurchaseId'] =  Str::uuid();
        $validatedData['assetProcurementId'] =  $assetProcurement->assetProcurementId;
        
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'assetProcurementDeviceId-') === 0) {
                // Dapatkan nomor index dari key
                $index = str_replace('assetProcurementDeviceId-', '', $key);

                
                // Dapatkan ID device
                $deviceId = $value;
                // Dapatkan harga device berdasarkan index yang sama
                $devicePrice = $request->input('assetProcurementDevicePrice-' . $index);
                
                $device = AssetProcurementDevice::where('assetProcurementDeviceId', $deviceId)->first();
                $deviceTotal = $devicePrice * $device->assetProcurementDeviceQuantity;

                AssetProcurementDevice::where('assetProcurementDeviceId', $deviceId)->update([
                    'assetProcurementDevicePrice' => $devicePrice,
                    'assetProcurementDeviceTotal' => $deviceTotal,
                ]);
            }
        }

        ModelsAssetPurchase::Create($validatedData);

        AssetProcurement::where('assetProcurementId', $assetProcurement->assetProcurementId)->update([
            'assetProcurementStatus' => 'Asset Purchase',
        ]);

        $assetProcurementDetail['assetProcurementDetailId'] =  Str::uuid();
        $assetProcurementDetail['assetProcurementId'] =  $assetProcurement->assetProcurementId;
        $assetProcurementDetail['assetProcurementDetailDate'] = date('Y-m-d');
        $assetProcurementDetail['assetProcurementDetailStatus'] = 'Asset Purchase';
        
        AssetProcurementDetail::Create($assetProcurementDetail);

        return redirect('/assetPurchase')->with('success', 'Data updated successfully');
    }

    public function deployment(AssetProcurement $assetProcurement) {
        return view('assetPurchase.deployment', [
            'assetProcurement' => AssetProcurement::where('assetProcurementId', $assetProcurement->assetProcurementId)->first(),
            'assetProcurementDevices' => AssetProcurementDevice::where('assetProcurementId', $assetProcurement->assetProcurementId)->get(),
            'assetPurchase' => ModelsAssetPurchase::where('assetProcurementId', $assetProcurement->assetProcurementId)->first(),
            'suppliers' => Supplier::all() 
        ]);
    }

    public function deploymentStore(AssetProcurement $assetProcurement, Request $request) {
        $validatedData = $request->validate([
            'assetProcurementStatus' => 'required',
        ]);

        $devices = AssetProcurementDevice::where('assetProcurementId', $assetProcurement->assetProcurementId)->get();
        
        foreach($devices as $device) {
            $qty = $device->assetProcurementDeviceQuantity;
            for ($i=0; $i < $qty; $i++) { 
                $assetDeployment['assetDeploymentId'] =  Str::uuid();
                $assetDeployment['assetProcurementId'] =  $device->assetProcurementId;
                $assetDeployment['assetModelId'] =  $device->assetModelId;
                $assetDeployment['assetSerialNumber'] =  '-';
                AssetDeployment::Create($assetDeployment);

            }
        }

        


        // AssetProcurement::where('assetProcurementId', $assetProcurement->assetProcurementId)->update([
        //     'assetProcurementStatus' => $validatedData['assetProcurementStatus'],
        // ]);

        // $assetProcurementDetail['assetProcurementDetailId'] =  Str::uuid();
        // $assetProcurementDetail['assetProcurementId'] =  $assetProcurement->assetProcurementId;
        // $assetProcurementDetail['assetProcurementDetailDate'] = date('Y-m-d');
        // $assetProcurementDetail['assetProcurementDetailStatus'] = $validatedData['assetProcurementStatus'];
        
        // AssetProcurementDetail::Create($assetProcurementDetail);

        // foreach ($request->all() as $key => $value) {
        //     if (strpos($key, 'assetModelId-') === 0) {
        //         $index = str_replace('assetModelId-', '', $key);
        //         $deviceId = $value;
                
        //         $device = AssetProcurementDevice::where('assetProcurementDeviceId', $deviceId)->first();
        //         $deviceQuantity = $device->assetProcurementDeviceQuantity;
                
        //         dd($deviceQuantity);

        //         $assetDeployment['assetDeploymentId'] =  Str::uuid();
        //         $assetDeployment['assetProcurementId'] =  $assetProcurement->assetProcurementId;
        //         $assetDeployment['assetProcurementId'] =  $assetProcurement->assetProcurementId;
        //     }
        // }
        
        

        return redirect('/assetPurchase')->with('success', 'Data updated successfully');
    
    }
}
