<?php

namespace App\Http\Controllers\Main;

use App\Models\Location;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AssetMovement;
use App\Models\AssetProcurement;
use App\Http\Controllers\Controller;
use App\Models\AssetDeployment;
use App\Models\AssetModel;
use App\Models\AssetProcurementDetail;
use App\Models\AssetProcurementDevice;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class AssetMovementController extends Controller
{
    public function index() {
        return view('assetMovement.index', [
            'assetProcurements' => AssetProcurement::where('assetProcurementType', 'Asset Movement')
                                                        ->whereNot('assetProcurementStatus', 'Rejected by IT Manager')
                                                        ->get(),
        ]);
    }

    public function movement(AssetProcurement $assetProcurement) {
        return view('assetMovement.movement', [
            'assetProcurement' => AssetProcurement::where('assetProcurementId', $assetProcurement->assetProcurementId)->first(),
            'assetProcurementDevices' => AssetProcurementDevice::where('assetProcurementId', $assetProcurement->assetProcurementId)->get(),
            'locations' => Location::whereNot('locationId', $assetProcurement->user->locationId)->get(),
        ]);
    }

    public function movementStore(AssetProcurement $assetProcurement, Request $request) {
        $validatedData = $request->validate([
            'assetMovementDate' => 'required',
            'locationId' => 'required',
        ]);

        $validatedData['assetMovementId'] =  Str::uuid();
        $validatedData['assetMovementNumber'] = IdGenerator::generate(['table' => 'asset_movements', 'field' => 'assetMovementNumber', 'length' => 20, 'prefix' => 'IT/MV/'. date('d/m/y', strtotime($validatedData['assetMovementDate'])) . '/']);
        $validatedData['assetProcurementId'] =  $assetProcurement->assetProcurementId;

        AssetMovement::Create($validatedData);

        AssetProcurement::where('assetProcurementId', $assetProcurement->assetProcurementId)->update([
            'assetProcurementStatus' => 'Asset Movement',
        ]);

        $assetProcurementDetail['assetProcurementDetailId'] =  Str::uuid();
        $assetProcurementDetail['assetProcurementId'] =  $assetProcurement->assetProcurementId;
        $assetProcurementDetail['assetProcurementDetailDate'] = date('Y-m-d');
        $assetProcurementDetail['assetProcurementDetailStatus'] = 'Asset Movement';
        
        AssetProcurementDetail::Create($assetProcurementDetail);

        return redirect('/assetMovement')->with('success', 'Data updated successfully');
    }
    
    public function device(AssetProcurement $assetProcurement) {

        $assetMovement = AssetMovement::where('assetProcurementId', $assetProcurement->assetProcurementId)->first();
        // dd($assetMovement);

        return view('assetMovement.device', [
            'assetDeployments' => AssetDeployment::where('locationId', $assetMovement->locationId)->get(),
            'assetProcurement' => AssetProcurement::where('assetProcurementId', $assetProcurement->assetProcurementId)->first(),
            'assetMovement' => AssetMovement::where('assetProcurementId', $assetProcurement->assetProcurementId)->first(),
            'assetProcurementDevices' => AssetProcurementDevice::where('assetProcurementId', $assetProcurement->assetProcurementId)->get(),
            'locations' => Location::whereNot('locationId', $assetProcurement->user->locationId)->get(),
        ]);
    }
}
