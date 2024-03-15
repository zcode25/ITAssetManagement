<?php

namespace App\Http\Controllers\Main;

use App\Models\User;
use App\Models\Supplier;
use App\Models\AssetRepair;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AssetDeployment;
use App\Http\Controllers\Controller;
use App\Models\AssetDeploymentDetail;

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
                "type" => "Archive"
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

    public function manageStore(AssetDeployment $assetDeployment, Request $request) {
        if($request->supplierId != null) {
            $validatedData = $request->validate([
                'assetRepairCompletionDate' => 'required',
                'supplierId' => 'required',
                'assetRepairCost' => 'required',
                'assetDeploymentStatus' => 'required',
                'assetDeploymentDetailNote' => 'required',
            ]);
        } else {
            $validatedData = $request->validate([
                'assetRepairCompletionDate' => 'required',
                'assetRepairCost' => 'required',
                'assetDeploymentStatus' => 'required',
                'assetDeploymentDetailNote' => 'required',
            ]);
        }

        if($request->supplierId != null) {
            AssetRepair::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->update([
                'assetRepairCompletionDate' => $validatedData['assetRepairCompletionDate'],
                'supplierId' => $validatedData['supplierId'],
                'assetRepairCost' => $validatedData['assetRepairCost'],
            ]);
        } else {
            AssetRepair::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->update([
                'assetRepairCompletionDate' => $validatedData['assetRepairCompletionDate'],
                'assetRepairCost' => $validatedData['assetRepairCost'],
            ]);
        }

        AssetDeployment::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->update([
            'assetDeploymentStatus' => $validatedData['assetDeploymentStatus'],
        ]);

        $assetDeploymentDetail['assetDeploymentDetailId'] = Str::uuid();
        $assetDeploymentDetail['assetDeploymentId'] = $assetDeployment->assetDeploymentId;
        $assetDeploymentDetail['userId'] = null;
        $assetDeploymentDetail['locationId'] = $assetDeployment->locationId;
        $assetDeploymentDetail['assetDeploymentDetailDate'] = $validatedData['assetRepairCompletionDate'];
        $assetDeploymentDetail['assetDeploymentDetailNote'] = $validatedData['assetDeploymentDetailNote'];
        $assetDeploymentDetail['assetDeploymentDetailStatus'] = $validatedData['assetDeploymentStatus'];
        AssetDeploymentDetail::Create($assetDeploymentDetail);

        return redirect('/assetRepair')->with('success', 'Data updated successfully');
    }
}
