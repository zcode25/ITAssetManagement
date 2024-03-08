<?php

namespace App\Http\Controllers\Main;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AssetDeploymentDetail;
use App\Models\AssetDeployment as ModelsAssetDeployment;
use App\Models\User;

class AssetDeploymentController extends Controller
{
    public function all() {
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
        $validatedData = $request->validate([
            'assetSerialNumber' => 'required|unique:asset_deployments',
            'assetDeploymentStatus' => 'required',
            'assetDeploymentImage' => 'required|mimes:png,jpg|max:2048',
        ]);

        if($request->file('assetDeploymentImage')) {
            $validatedData['assetDeploymentImage'] = $request->file('assetDeploymentImage')->store('assetDeploymentImage');
        }

        ModelsAssetDeployment::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->update($validatedData);

        $assetDeploymentDetail['assetDeploymentDetailId'] = Str::uuid();
        $assetDeploymentDetail['assetDeploymentId'] = $assetDeployment['assetDeploymentId'];
        $assetDeploymentDetail['locationId'] = $assetDeployment['locationId'];
        $assetDeploymentDetail['assetDeploymentDetailDate'] = date('Y-m-d');
        $assetDeploymentDetail['assetDeploymentDetailStatus'] = $validatedData['assetDeploymentStatus'];
        AssetDeploymentDetail::Create($assetDeploymentDetail);

        return redirect('/assetDeploymentPre')->with('success', 'Data updated successfully');
    }

    public function deploymentReady() {
        return view('assetDeployment.deploymentReady', [
            'assetDeployments' => ModelsAssetDeployment::where('assetDeploymentStatus', 'Deployment Ready')->where('locationId', auth()->user()->locationId)->get(),
        ]);
    }

    public function deploymentReadyCheckout(ModelsAssetDeployment $assetDeployment) {
        return view('assetDeployment.deploymentReadyCheckout', [
            'assetDeployment' => ModelsAssetDeployment::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->first(),
            'users'  => User::where('locationId', $assetDeployment->locationId)->get()
        ]);
    }

    public function deploymentReadyCheckoutStore(ModelsAssetDeployment $assetDeployment, Request $request) {
        $validatedData = $request->validate([
            'assetDeploymentDetailDate' => 'required',
            'userId' => 'required',
            'assetDeploymentStatus' => 'required',
            'assetDeploymentDetailNote' => 'required',
        ]);

        ModelsAssetDeployment::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->update([
            'userId' => $validatedData['userId'],
            'assetDeploymentStatus' => $validatedData['assetDeploymentStatus'],
        ]);

        $assetDeploymentDetail['assetDeploymentDetailId'] = Str::uuid();
        $assetDeploymentDetail['assetDeploymentId'] = $assetDeployment['assetDeploymentId'];
        $assetDeploymentDetail['userId'] = $validatedData['userId'];
        $assetDeploymentDetail['locationId'] = $assetDeployment['locationId'];
        $assetDeploymentDetail['assetDeploymentDetailDate'] = $validatedData['assetDeploymentDetailDate'];
        $assetDeploymentDetail['assetDeploymentDetailNote'] = $validatedData['assetDeploymentDetailNote'];
        $assetDeploymentDetail['assetDeploymentDetailStatus'] = $validatedData['assetDeploymentStatus'];
        AssetDeploymentDetail::Create($assetDeploymentDetail);

        return redirect('/assetDeploymentReady')->with('success', 'Data updated successfully');
    }

    public function detail(ModelsAssetDeployment $assetDeployment) {
        return view('assetDeployment.detail', [
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

        ModelsAssetDeployment::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->update([
            'userId' => null,
            'assetDeploymentStatus' => $validatedData['assetDeploymentStatus'],
        ]);

        $assetDeploymentDetail['assetDeploymentDetailId'] = Str::uuid();
        $assetDeploymentDetail['assetDeploymentId'] = $assetDeployment['assetDeploymentId'];
        $assetDeploymentDetail['userId'] = null;
        $assetDeploymentDetail['locationId'] = $assetDeployment['locationId'];
        $assetDeploymentDetail['assetDeploymentDetailDate'] = $validatedData['assetDeploymentDetailDate'];
        $assetDeploymentDetail['assetDeploymentDetailNote'] = $validatedData['assetDeploymentDetailNote'];
        $assetDeploymentDetail['assetDeploymentDetailStatus'] = $validatedData['assetDeploymentStatus'];
        AssetDeploymentDetail::Create($assetDeploymentDetail);

        return redirect('/assetDeploymentCheckout')->with('success', 'Data updated successfully');
    }
}
