<?php

namespace App\Http\Controllers\Main;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AssetDeployment;
use App\Http\Controllers\Controller;
use App\Models\AssetDeploymentDetail;
use App\Models\Supplier;

class AssetRepairController extends Controller
{
    public function index() {
        return view('assetRepair.index', [
            'assetDeployments' => AssetDeployment::where('assetDeploymentStatus', 'Repair')->get(),
        ]);
    }

    public function detail(AssetDeployment $assetDeployment) {
        return view('assetRepair.detail', [
            'items' => AssetDeployment::where('assetId', $assetDeployment->assetDeploymentId)->where('assetDeploymentStatus', 'Checkout')->get(),
            'assetDeployment' => AssetDeployment::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->first(),
            'users'  => User::where('locationId', $assetDeployment->locationId)->get(),
            'assetDeploymentDetails' => AssetDeploymentDetail::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function manage(AssetDeployment $assetDeployment) {
        $types = [
            [
                "type" => "Deployment Ready"
            ],
            [
                "type" => "Repair"
            ],
            [
                "type" => "Broken"
            ],
        ];

        return view('assetRepair.manage', [
            'assetDeployment' => AssetDeployment::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->first(),
            'suppliers' => Supplier::all(),
            'users'  => User::where('locationId', $assetDeployment->locationId)->get(),
            'types' => $types
        ]); 
    }
}
