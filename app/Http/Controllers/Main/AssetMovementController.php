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
use App\Models\AssetDeploymentDetail;
use App\Models\AssetModel;
use App\Models\AssetMovementDevice;
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

    public function detail(AssetProcurement $assetProcurement) {
        return view('assetMovement.detail', [
            'assetProcurement' => AssetProcurement::where('assetProcurementId', $assetProcurement->assetProcurementId)->first(),
            'assetProcurementDevices' => AssetProcurementDevice::where('assetProcurementId', $assetProcurement->assetProcurementId)->get(),
            'assetProcurementDetails' => AssetProcurementDetail::where('assetProcurementId', $assetProcurement->assetProcurementId)->orderBy('created_at', 'desc')->get(),
            'assetMovement' => AssetMovement::where('assetProcurementId', $assetProcurement->assetProcurementId)->first(),
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
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $assetMovement = AssetMovement::where('assetProcurementId', $assetProcurement->assetProcurementId)->first();
        // dd($assetMovement);

        return view('assetMovement.device', [
            'assetDeployments' => AssetDeployment::where('locationId', $assetMovement->locationId)->where('assetDeploymentStatus', 'Archive')->get(),
            'assetProcurement' => AssetProcurement::where('assetProcurementId', $assetProcurement->assetProcurementId)->first(),
            'assetMovement' => AssetMovement::where('assetProcurementId', $assetProcurement->assetProcurementId)->first(),
            'assetMovementDevices' => AssetMovementDevice::where('assetMovementId', $assetMovement->assetMovementId)->get(),
            'assetProcurementDevices' => AssetProcurementDevice::where('assetProcurementId', $assetProcurement->assetProcurementId)->get(),
            'locations' => Location::whereNot('locationId', $assetProcurement->user->locationId)->get(),
        ]);
    }

    public function deviceStore(AssetProcurement $assetProcurement, Request $request) {
        $validatedData = $request->validate([
            'assetDeploymentId' => 'required',
        ]);
        
        $assetMovement = AssetMovement::where('assetProcurementId', $assetProcurement->assetProcurementId)->first();
        $assetMovementDevices = AssetMovementDevice::where('assetMovementId', $assetMovement->assetMovementId)->get();
        
        foreach($assetMovementDevices as $assetMovementDevice) {
            if($assetMovementDevice->assetDeploymentId == $validatedData['assetDeploymentId']) {
                return back()->with([
                    'error' => 'The asset deployment has already been taken',
                ]);
            }
        }
        
        $validatedData['assetMovementId'] =  $assetMovement->assetMovementId;
        $validatedData['assetMovementDeviceId'] =  Str::uuid();

        AssetMovementDevice::Create($validatedData);

        return back();
    }

    public function deviceDestroy(AssetMovementDevice $assetMovementDevice) {
        try{
            AssetMovementDevice::where('assetMovementDeviceId', $assetMovementDevice->assetMovementDeviceId)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }
        
        return back();
    }

    public function deviceSave(AssetMovement $assetMovement, Request $request) {

        $validatedData = $request->validate([
            'assetDeploymentDate' => 'required',
        ]);

        $assetMovementDevices = AssetMovementDevice::where('assetMovementId', $assetMovement->assetMovementId)->get();
        $assetProcurement = AssetProcurement::where('assetProcurementId', $assetMovement->assetProcurementId)->first();

        
        if(count($assetMovementDevices) == 0) {
            return back()->with([
                'error' => 'No data available in table',
            ]);
        }

        foreach ($assetMovementDevices as $assetMovementDevice) {
            AssetDeployment::where('assetDeploymentId', $assetMovementDevice->assetDeploymentId)->update([
                'userId' => null,
                'locationId' => $assetProcurement->locationId,
                'assetDeploymentStatus' => 'Asset Movement',
            ]);

            $assetDeploymentDetail['assetDeploymentDetailId'] = Str::uuid();
            $assetDeploymentDetail['assetDeploymentId'] = $assetMovementDevice->assetDeploymentId;
            $assetDeploymentDetail['userId'] = null;
            $assetDeploymentDetail['locationId'] = $assetProcurement->locationId;
            $assetDeploymentDetail['assetDeploymentDetailDate'] = $validatedData['assetDeploymentDate'];
            $assetDeploymentDetail['assetDeploymentDetailNote'] = 'Movement';
            $assetDeploymentDetail['assetDeploymentDetailStatus'] = 'Asset Movement';
            AssetDeploymentDetail::Create($assetDeploymentDetail);

            sleep(1);

            AssetDeployment::where('assetDeploymentId', $assetMovementDevice->assetDeploymentId)->update([
                'userId' => null,
                'locationId' => $assetProcurement->locationId,
                'assetDeploymentStatus' => 'Deployment Ready',
            ]);

            $assetDeploymentDetail['assetDeploymentDetailId'] = Str::uuid();
            $assetDeploymentDetail['assetDeploymentId'] = $assetMovementDevice->assetDeploymentId;
            $assetDeploymentDetail['userId'] = null;
            $assetDeploymentDetail['locationId'] = $assetProcurement->locationId;
            $assetDeploymentDetail['assetDeploymentDetailDate'] = $validatedData['assetDeploymentDate'];
            $assetDeploymentDetail['assetDeploymentDetailNote'] = 'Deployment Ready';
            $assetDeploymentDetail['assetDeploymentDetailStatus'] = 'Deployment Ready';
            AssetDeploymentDetail::Create($assetDeploymentDetail);
        }

        AssetProcurement::where('assetProcurementId', $assetMovement->assetProcurementId)->update([
            'assetProcurementStatus' => 'Asset Deployment',
        ]);

        $assetProcurementDetail['assetProcurementDetailId'] =  Str::uuid();
        $assetProcurementDetail['assetProcurementId'] =  $assetProcurement->assetProcurementId;
        $assetProcurementDetail['assetProcurementDetailDate'] = $validatedData['assetDeploymentDate'];
        $assetProcurementDetail['assetProcurementDetailStatus'] = 'Asset Deployment';
        
        AssetProcurementDetail::Create($assetProcurementDetail);

        return redirect('/assetMovement')->with('success', 'Data saved successfully');
    }
}
