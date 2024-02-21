<?php

namespace App\Http\Controllers\Main;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AssetDeploymentDetail;
use App\Models\AssetDeployment as ModelsAssetDeployment;

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
            'assetSerialNumber' => 'required',
            'assetDeploymentStatus' => 'required',
            'assetDeploymentImage' => 'required|mimes:png,jpg|max:2048',
        ]);

        if($request->file('assetDeploymentImage')) {
            $validatedData['assetDeploymentImage'] = $request->file('assetDeploymentImage')->store('assetDeploymentImage');
        }

        ModelsAssetDeployment::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->update($validatedData);

        $assetDeploymentDetail['assetDeploymentDetailId'] = Str::uuid();
        $assetDeploymentDetail['assetDeploymentId'] = $assetDeployment['assetDeploymentId'];
        $assetDeploymentDetail['assetDeploymentDetailDate'] = date('Y-m-d');
        $assetDeploymentDetail['assetDeploymentDetailStatus'] = $validatedData['assetDeploymentStatus'];
        AssetDeploymentDetail::Create($assetDeploymentDetail);

        return redirect('/assetDeploymentPre')->with('success', 'Data updated successfully');
    }
}
