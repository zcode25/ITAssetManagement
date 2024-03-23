<?php

namespace App\Http\Controllers\Main;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AssetDisposal;
use App\Http\Controllers\Controller;
use App\Models\AssetDeployment;
use App\Models\AssetDeploymentDetail;
use App\Models\AssetDisposalDevice;
use App\Models\AssetProcurement;
use App\Models\Location;
use App\Models\Supplier;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class AssetDisposalController extends Controller
{
    public function index() {
        return view('assetDisposal.index', [
            'assetDisposals' => AssetDisposal::all(),
        ]);
    }

    public function create() {
        $types = [
            [
                "type" => "Asset Discard"
            ],
            [
                "type" => "Assets Auction"
            ],
        ];

        return view('assetDisposal.create', [
            'user' => User::where('userId', auth()->user()->userId)->first(),
            'locations' => Location::all(),
        ]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'userId' => 'required',
            'locationId' => 'required',
            'assetDisposalDate' => 'required',
            'assetDisposalNote' => 'required',
        ]);

        $user = User::where('userId', $request->userId)->first();
        $manager = User::where('userId', $user->managerId)->first();
        $validatedData['managerId'] = $manager->userId;
        $validatedData['locationId'] = $validatedData['locationId'];
        $validatedData['assetDisposalId'] = Str::uuid();
        $validatedData['assetDisposalNumber'] = IdGenerator::generate(['table' => 'asset_disposals', 'field' => 'assetDisposalNumber', 'length' => 20, 'prefix' => 'IT/DP/'. date('d/m/y', strtotime($validatedData['assetDisposalDate'])) . '/']);
        $validatedData['assetDisposalStatus'] = 'Pre Disposal';

        AssetDisposal::create($validatedData);

        return redirect('/assetDisposal')->with('success', 'Data updated successfully');
    }

    public function detail(AssetDisposal $assetDisposal) {
        return view('assetDisposal.detail', [
            'assetDeployments' => AssetDeployment::where('locationId', $assetDisposal->locationId)->where('assetDeploymentStatus', 'Broken')->get(),
            'assetDisposal' => $assetDisposal,
            'assetDisposalDevices' => AssetDisposalDevice::where('assetDisposalId', $assetDisposal->assetDisposalId)->get(),
        ]);
    }

    public function device(AssetDisposal $assetDisposal) {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('assetDisposal.device', [
            'assetDeployments' => AssetDeployment::where('locationId', $assetDisposal->locationId)->where('assetDeploymentStatus', 'Broken')->get(),
            'assetDisposal' => $assetDisposal,
            'assetDisposalDevices' => AssetDisposalDevice::where('assetDisposalId', $assetDisposal->assetDisposalId)->get(),
            // 'locations' => Location::whereNot('locationId', $assetProcurement->user->locationId)->get(),
        ]);
    }

    public function deviceStore(AssetDisposal $assetDisposal, Request $request) {
        $validatedData = $request->validate([
            'assetDeploymentId' => 'required',
        ]);
        
        $assetDisposalDevices = AssetDisposalDevice::where('assetDisposalId', $assetDisposal->assetDisposalId)->get();
        foreach($assetDisposalDevices as $assetDisposalDevice) {
            if($assetDisposalDevice->assetDeploymentId == $validatedData['assetDeploymentId']) {
                return back()->with([
                    'error' => 'The asset deployment has already been taken',
                ]);
            }
        }

        $assetDisposal = AssetDisposal::where('assetDisposalId', $assetDisposal->assetDisposalId)->first();
        $validatedData['assetDisposalId'] =  $assetDisposal->assetDisposalId;
        $validatedData['assetDisposalDeviceId'] =  Str::uuid();

        AssetDisposalDevice::Create($validatedData);

        return back();
    }

    public function deviceDestroy(AssetDisposalDevice $assetDisposalDevice) {
        try{
            AssetDisposalDevice::where('assetDisposalDeviceId', $assetDisposalDevice->assetDisposalDeviceId)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }
        
        return back();
    }

    public function deviceSave(AssetDisposal $assetDisposal) {

        $assetDisposalDevices = AssetDisposalDevice::where('assetDisposalId', $assetDisposal->assetDisposalId)->get();

        if(count($assetDisposalDevices) == 0) {
            return back()->with([
                'error' => 'No data available in table',
            ]);
        }

        
        foreach ($assetDisposalDevices as $assetDisposalDevice) {
            $assetDeployments = AssetDeployment::where('assetId', $assetDisposalDevice->assetDeploymentId)->get();
            foreach($assetDeployments as $assetDeployment) {
                AssetDeployment::where('assetDeploymentId', $assetDeployment->assetDeploymentId)->update([
                    'locationId' => null,
                    'assetDeploymentStatus' => 'Asset Disposal',
                ]);
    
                $assetDeploymentDetail['assetDeploymentDetailId'] = Str::uuid();
                $assetDeploymentDetail['assetDeploymentId'] = $assetDeployment->assetDeploymentId;
                $assetDeploymentDetail['userId'] = null;
                $assetDeploymentDetail['locationId'] = null;
                $assetDeploymentDetail['assetDeploymentDetailDate'] =  $assetDisposal->assetDisposalDate;
                $assetDeploymentDetail['assetDeploymentDetailNote'] = 'Disposal';
                $assetDeploymentDetail['assetDeploymentDetailStatus'] = 'Asset Disposal';
                AssetDeploymentDetail::Create($assetDeploymentDetail);
            }
            

            AssetDeployment::where('assetDeploymentId', $assetDisposalDevice->assetDeploymentId)->update([
                'userId' => null,
                'locationId' => null,
                'assetDeploymentStatus' => 'Asset Disposal',
            ]);

            $assetDeploymentDetail['assetDeploymentDetailId'] = Str::uuid();
            $assetDeploymentDetail['assetDeploymentId'] = $assetDisposalDevice->assetDeploymentId;
            $assetDeploymentDetail['userId'] = null;
            $assetDeploymentDetail['locationId'] = null;
            $assetDeploymentDetail['assetDeploymentDetailDate'] = $assetDisposal->assetDisposalDate;
            $assetDeploymentDetail['assetDeploymentDetailNote'] = 'Disposal';
            $assetDeploymentDetail['assetDeploymentDetailStatus'] = 'Asset Disposal';
            AssetDeploymentDetail::Create($assetDeploymentDetail);
        }

        AssetDisposal::where('assetDisposalId', $assetDisposal->assetDisposalId)->update([
            'assetDisposalStatus' => 'Asset for Disposal',
        ]);

        return redirect('/assetDisposal')->with('success', 'Data saved successfully');
    }

    public function disposal(AssetDisposal $assetDisposal) {

        $types = [
            [
                "type" => "Asset Discard"
            ],
            [
                "type" => "Asset Auction"
            ],
        ];

        return view('assetDisposal.disposal', [
            'assetDeployments' => AssetDeployment::where('locationId', $assetDisposal->locationId)->where('assetDeploymentStatus', 'Broken')->get(),
            'assetDisposal' => $assetDisposal,
            'assetDisposalDevices' => AssetDisposalDevice::where('assetDisposalId', $assetDisposal->assetDisposalId)->get(),
            'suppliers' => Supplier::all(),
            'types' => $types,
        ]);
    }

    public function disposalStore(AssetDisposal $assetDisposal, Request $request) {
        if($request->assetDisposalType == "Asset Discard") {
            $validatedData = $request->validate([
                'assetDisposalDisposedDate' => 'required',
                'assetDisposalType' => 'required',
            ]);
        } else {
            $validatedData = $request->validate([
                'assetDisposalDisposedDate' => 'required',
                'assetDisposalType' => 'required',
                'supplierId' => 'required',
                'assetDisposalAmount' => 'required',
            ]);
        }

        $validatedData['assetDisposalStatus'] = "Asset Disposed";

        AssetDisposal::where('assetDisposalId', $assetDisposal->assetDisposalId)->update($validatedData);
        return redirect('/assetDisposal')->with('success', 'Data saved successfully');
    }
}
