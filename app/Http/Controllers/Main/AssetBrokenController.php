<?php

namespace App\Http\Controllers\Main;

use App\Models\User;
use App\Models\AssetRepair;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AssetDeployment;
use App\Http\Controllers\Controller;
use App\Models\AssetDeploymentDetail;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class AssetBrokenController extends Controller
{
    public function index() {
        return view('assetBroken.index', [
            'assetDeployments' => AssetDeployment::where('assetDeploymentStatus', 'Broken')->get(),
        ]);
    }

    public function detail(AssetDeployment $assetDeployment) {
        return view('assetBroken.detail', [
            'repairs' => AssetRepair::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->get(),
            'items' => AssetDeployment::where('assetId', $assetDeployment->assetDeploymentId)->where('assetDeploymentStatus', 'Checkout')->get(),
            'assetDeployment' => AssetDeployment::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->first(),
            'users'  => User::where('locationId', $assetDeployment->locationId)->get(),
            'assetDeploymentDetails' => AssetDeploymentDetail::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function manage(AssetDeployment $assetDeployment) {
        $types = [
            [
                "type" => "Archive"
            ],
            [
                "type" => "Repair"
            ],
        ];

        return view('assetBroken.manage', [
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

        return redirect('/assetBroken')->with('success', 'Data updated successfully');
    }
}
