<?php

namespace App\Http\Controllers\Main;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AssetDeploymentDetail;
use App\Models\AssetDeployment as ModelsAssetDeployment;
use App\Models\AssetRepair;
use App\Models\Category;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Contracts\Support\ValidatedData;

class AssetDeploymentController extends Controller
{
    public function all(Request $request) {
        return view('assetDeployment.all', [
            'assetDeployments' => ModelsAssetDeployment::all(),
        ]);
    }

    public function preDeployment() {
        return view('assetDeployment.preDeployment', [
            'assetDeployments' => ModelsAssetDeployment::where('assetDeploymentStatus', 'Pre Deployment')->get(),
        ]);
    }

    public function preDeploymentManage(ModelsAssetDeployment $assetDeployment) {
        return view('assetDeployment.preDeploymentManage', [
            'assetDeployment' => ModelsAssetDeployment::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->first()
        ]);
    }

    public function preDeploymentManageStore(ModelsAssetDeployment $assetDeployment, Request $request) {
        // dd($request);

        if($assetDeployment->assetModel->category->categoryType != 'License') {
            $validatedData = $request->validate([
                'assetSerialNumber' => 'max:50',
                'assetDeploymentStatus' => 'required',
                'assetDeploymentDetailDate' => 'required',
                'assetDeploymentImage' => 'required|mimes:png,jpg|max:2048',
            ]);
        } else {
            $validatedData = $request->validate([
                'assetProductKey' => 'required|max:50',
                'assetExpirationDate' => 'max:50',
                'assetDeploymentStatus' => 'required',
                'assetDeploymentDetailDate' => 'required',
                'assetDeploymentImage' => 'required|mimes:png,jpg|max:2048',
            ]);
        }
        

        if($request->file('assetDeploymentImage')) {
            $validatedData['assetDeploymentImage'] = $request->file('assetDeploymentImage')->store('assetDeploymentImage');
        }

        if($assetDeployment->assetModel->category->categoryType != 'License') {
            ModelsAssetDeployment::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->update([
                'assetSerialNumber' => $validatedData['assetSerialNumber'],
                'assetDeploymentStatus' => $validatedData['assetDeploymentStatus'],
                'assetDeploymentImage' => $validatedData['assetDeploymentImage'],
            ]);
        } else {
            ModelsAssetDeployment::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->update([
                'assetProductKey' => $validatedData['assetProductKey'],
                'assetExpirationDate' => $validatedData['assetExpirationDate'],
                'assetDeploymentStatus' => $validatedData['assetDeploymentStatus'],
                'assetDeploymentImage' => $validatedData['assetDeploymentImage'],
            ]);
        }


        $assetDeploymentDetail['assetDeploymentDetailId'] = Str::uuid();
        $assetDeploymentDetail['assetDeploymentId'] = $assetDeployment['assetDeploymentId'];
        $assetDeploymentDetail['locationId'] = $assetDeployment['locationId'];
        $assetDeploymentDetail['assetDeploymentDetailDate'] = $validatedData['assetDeploymentDetailDate'];
        $assetDeploymentDetail['assetDeploymentDetailStatus'] = $validatedData['assetDeploymentStatus'];
        AssetDeploymentDetail::Create($assetDeploymentDetail);

        return redirect('/assetDeploymentPre')->with('success', 'Data updated successfully');
    }

    public function deploymentReady() {
        return view('assetDeployment.deploymentReady', [
            'assetDeployments' => ModelsAssetDeployment::where('assetDeploymentStatus', 'Deployment Ready')->get(),
            'categories' => Category::all(),
        ]);
    }

    public function deploymentReadyCheckout(ModelsAssetDeployment $assetDeployment) {
        return view('assetDeployment.deploymentReadyCheckout', [
            'assetDeployment' => ModelsAssetDeployment::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->first(),
            'assetDeployments' => ModelsAssetDeployment::whereNot('assetDeploymentStatus', 'Pre Deployment')->where('locationId', $assetDeployment->locationId)->get(),
            'users'  => User::where('locationId', $assetDeployment->locationId)->get()
        ]);
    }

    public function deploymentReadyCheckoutStore(ModelsAssetDeployment $assetDeployment, Request $request) {

        if($request->userId != null) {
            $validatedData = $request->validate([
                'assetDeploymentDetailDate' => 'required',
                'userId' => 'required',
                'assetDeploymentStatus' => 'required',
                'assetDeploymentDetailNote' => 'required',
            ]);
        } else {
            $validatedData = $request->validate([
                'assetDeploymentDetailDate' => 'required',
                'assetId' => 'required',
                'assetDeploymentStatus' => 'required',
                'assetDeploymentDetailNote' => 'required',
            ]);
        }

        if(isset($validatedData['userId'])) {
            $validatedData['assetId'] = null;
        } else {
            $validatedData['userId'] = null;
        }

        if(isset($validatedData['userId'])) {
            ModelsAssetDeployment::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->update([
                'userId' => $validatedData['userId'],
                'assetDeploymentStatus' => $validatedData['assetDeploymentStatus'],
            ]);
        } else {
            ModelsAssetDeployment::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->update([
                'assetId' => $validatedData['assetId'],
                'locationId' => null,
                'assetDeploymentStatus' => $validatedData['assetDeploymentStatus'],
            ]);
        }

        $assetDeploymentDetail['assetDeploymentDetailId'] = Str::uuid();
        $assetDeploymentDetail['assetDeploymentId'] = $assetDeployment['assetDeploymentId'];
        if(isset($validatedData['userId'])) {
            $assetDeploymentDetail['userId'] = $validatedData['userId'];
            $assetDeploymentDetail['locationId'] = $assetDeployment['locationId'];
        } else {
            $assetDeploymentDetail['assetId'] = $validatedData['assetId'];
        }
        $assetDeploymentDetail['assetDeploymentDetailDate'] = $validatedData['assetDeploymentDetailDate'];
        $assetDeploymentDetail['assetDeploymentDetailNote'] = $validatedData['assetDeploymentDetailNote'];
        $assetDeploymentDetail['assetDeploymentDetailStatus'] = $validatedData['assetDeploymentStatus'];
        AssetDeploymentDetail::Create($assetDeploymentDetail);

        return redirect('/assetDeploymentReady')->with('success', 'Data updated successfully');
    }

    public function detail(ModelsAssetDeployment $assetDeployment) {
        return view('assetDeployment.detail', [
            'repairs' => AssetRepair::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->get(),
            'items' => ModelsAssetDeployment::where('assetId', $assetDeployment->assetDeploymentId)->where('assetDeploymentStatus', 'Checkout')->get(),
            'assetDeployment' => ModelsAssetDeployment::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->first(),
            'users'  => User::where('locationId', $assetDeployment->locationId)->get(),
            'assetDeploymentDetails' => AssetDeploymentDetail::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function deploymentCheckout() {
        return view('assetDeployment.deploymentCheckout', [
            'assetDeployments' => ModelsAssetDeployment::where('assetDeploymentStatus', 'Checkout')->get(),
        ]);
    }

    public function deploymentCheckoutCheckin(ModelsAssetDeployment $assetDeployment) {
        $types = [
            [
                "type" => "Archive"
            ],
            [
                "type" => "Repair"
            ],
        ];

        return view('assetDeployment.deploymentCheckoutCheckin', [
            'assetDeployment' => ModelsAssetDeployment::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->first(),
            'users'  => User::where('locationId', $assetDeployment->locationId)->get(),
            'types' => $types
        ]); 
    }

    public function deploymentCheckoutCheckinStore(ModelsAssetDeployment $assetDeployment, Request $request) {
        $validatedData = $request->validate([
            'assetDeploymentDetailDate' => 'required',
            'assetDeploymentStatus' => 'required',
            'assetDeploymentDetailNote' => 'required',
        ]);

        $asset = ModelsAssetDeployment::where('assetDeploymentId', $assetDeployment->assetId)->first();

        if($asset == null) {
            ModelsAssetDeployment::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->update([
                'userId' => null,
                'assetDeploymentStatus' => $validatedData['assetDeploymentStatus'],
            ]);
        } else {
            ModelsAssetDeployment::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->update([
                'assetId' => null,
                'locationId' => $asset->locationId,
                'assetDeploymentStatus' => $validatedData['assetDeploymentStatus'],
            ]);
        }

        $assetDeploymentDetail['assetDeploymentDetailId'] = Str::uuid();
        $assetDeploymentDetail['assetDeploymentId'] = $assetDeployment['assetDeploymentId'];
        if($asset == null) { 
            $assetDeploymentDetail['userId'] = null;
            $assetDeploymentDetail['locationId'] = $assetDeployment['locationId'];
        } else {
            $assetDeploymentDetail['assetId'] = null;
            $assetDeploymentDetail['locationId'] = $asset->locationId;
        }
        $assetDeploymentDetail['assetDeploymentDetailDate'] = $validatedData['assetDeploymentDetailDate'];
        $assetDeploymentDetail['assetDeploymentDetailNote'] = $validatedData['assetDeploymentDetailNote'];
        $assetDeploymentDetail['assetDeploymentDetailStatus'] = $validatedData['assetDeploymentStatus'];
        AssetDeploymentDetail::Create($assetDeploymentDetail);
        
        if($validatedData['assetDeploymentStatus'] == 'Repair') {
            $assetRepair['assetRepairId'] = Str::uuid();
            $assetRepair['assetRepairNumber'] = IdGenerator::generate(['table' => 'asset_repairs', 'field' => 'assetRepairNumber', 'length' => 20, 'prefix' => 'IT/RP/'. date('d/m/y', strtotime($validatedData['assetDeploymentDetailDate'])) . '/']);
            $assetRepair['assetDeploymentId'] = $assetDeployment['assetDeploymentId'];
            $assetRepair['assetRepairNote'] = $validatedData['assetDeploymentDetailNote'];
            $assetRepair['assetRepairDate'] = $validatedData['assetDeploymentDetailDate'];
            AssetRepair::create($assetRepair);
        }


        return redirect('/assetDeploymentCheckout')->with('success', 'Data updated successfully');
    }
}
