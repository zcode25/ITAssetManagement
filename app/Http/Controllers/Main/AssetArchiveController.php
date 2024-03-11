<?php

namespace App\Http\Controllers\Main;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AssetDeployment;
use App\Http\Controllers\Controller;
use App\Models\AssetDeploymentDetail;

class AssetArchiveController extends Controller
{
    public function index() {
        return view('assetArchive.index', [
            'assetDeployments' => AssetDeployment::where('assetDeploymentStatus', 'Archive')->get(),
        ]);
    }

    public function detail(AssetDeployment $assetDeployment) {
        return view('assetArchive.detail', [
            'licenses' => AssetDeployment::where('assetId', $assetDeployment->assetDeploymentId)->get(),
            'components' => AssetDeployment::where('assetId', $assetDeployment->assetDeploymentId)->get(),
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
        ];

        return view('assetArchive.manage', [
            'assetDeployment' => AssetDeployment::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->first(),
            'users'  => User::where('locationId', $assetDeployment->locationId)->get(),
            'types' => $types
        ]); 
    }

    public function manageStore(AssetDeployment $assetDeployment, Request $request) {
        $validatedData = $request->validate([
            'assetDeploymentDetailDate' => 'required',
            'assetDeploymentStatus' => 'required',
            'assetDeploymentDetailNote' => 'required',
        ]);

        AssetDeployment::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->update([
            'userId' => null,
            'assetDeploymentStatus' => $validatedData['assetDeploymentStatus'],
        ]);

        $assetDeploymentDetail['assetDeploymentDetailId'] = Str::uuid();
        $assetDeploymentDetail['assetDeploymentId'] = $assetDeployment['assetDeploymentId'];
        $assetDeploymentDetail['userId'] = null;
        $assetDeploymentDetail['locationId'] = $assetDeployment['locationId'];
        $assetDeploymentDetail['assetDeploymentDetailDate'] = $validatedData['assetDeploymentDetailDate'];
        $assetDeploymentDetail['assetDeploymentDetailStatus'] = $validatedData['assetDeploymentStatus'];
        AssetDeploymentDetail::Create($assetDeploymentDetail);

        return redirect('/assetArchive')->with('success', 'Data updated successfully');
    }
}
