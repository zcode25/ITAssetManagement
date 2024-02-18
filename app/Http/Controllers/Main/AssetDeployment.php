<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AssetProcurementDetail;
use App\Models\AssetProcurementDevice;
use App\Models\AssetDeployment as ModelsAssetDeployment;
use App\Models\AssetProcurement;

class AssetDeployment extends Controller
{
    public function all() {
        return view('assetDeployment.all', [
            'assetDeployments' => ModelsAssetDeployment::all(),
        ]);
    }

    public function manage(ModelsAssetDeployment $assetDeployment) {
        return view('assetDeployment.manage', [
            'assetDeployment' => ModelsAssetDeployment::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->first()
        ]);
    }
}
