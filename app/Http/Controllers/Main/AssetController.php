<?php

namespace App\Http\Controllers\Main;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AssetDeployment;
use App\Http\Controllers\Controller;
use App\Models\AssetDeploymentDetail;

class AssetController extends Controller
{
    public function index() {
        return view('asset.index', [
            'assetDeployments' => AssetDeployment::where('userId', auth()->user()->userId)->get(),
        ]);
    }

    public function detail(AssetDeployment $assetDeployment) {
        return view('asset.detail', [
            'assetDeployment' => AssetDeployment::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->first(),
            'users'  => User::where('locationId', $assetDeployment->locationId)->get(),
            'assetDeploymentDetails' => AssetDeploymentDetail::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->orderBy('created_at', 'desc')->get(),
        ]);
    }
}
