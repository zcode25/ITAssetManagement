<?php

namespace App\Http\Controllers\Main;

use App\Models\User;
use App\Models\Category;
use App\Models\Location;
use App\Models\Position;
use App\Models\AssetModel;
use App\Models\Departement;
use App\Models\Manufacture;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\AssetProcurement as ModelsAssetProcurement;
use App\Models\AssetProcurementDetail;
use App\Models\AssetProcurementDevice;

class AssetProcurementController extends Controller
{
    
    public function all() {
        return view('assetProcurement.all', [
            'assetProcurements' => ModelsAssetProcurement::all(),
        ]);
    }

    public function index() {
        return view('assetProcurement.index', [
            'assetProcurements' => ModelsAssetProcurement::where('userId', auth()->user()->userId)->get(),
        ]);
    }

    public function detail(ModelsAssetProcurement $assetProcurement) {
        return view('assetProcurement.detail', [
            'assetProcurement' => ModelsAssetProcurement::where('assetProcurementId', $assetProcurement->assetProcurementId)->first(),
            'assetProcurementDevices' => AssetProcurementDevice::where('assetProcurementId', $assetProcurement->assetProcurementId)->get(),
            'assetProcurementDetails' => AssetProcurementDetail::where('assetProcurementId', $assetProcurement->assetProcurementId)->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function create() {
        return view('assetProcurement.create', [
            'user' => User::where('userId', auth()->user()->userId)->first(),
        ]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'userId' => 'required',
            'assetProcurementDate' => 'required',
            'assetProcurementNote' => 'required',
        ]);

        $user = User::where('userId', $request->userId)->first();
        $manager = User::where('userId', $user->managerId)->first();
        $validatedData['managerId'] = $manager->userId;
        $validatedData['locationId'] = $user->locationId;
        $validatedData['assetProcurementId'] = Str::uuid();
        $validatedData['assetProcurementNumber'] = IdGenerator::generate(['table' => 'asset_procurements', 'field' => 'assetProcurementNumber', 'length' => 20, 'prefix' => 'IT/PO/'. date('d/m/y', strtotime($validatedData['assetProcurementDate'])) . '/']);
        $validatedData['assetProcurementStatus'] = 'Approval Required';
        
        ModelsAssetProcurement::create($validatedData);

        $assetProcurementDetail['assetProcurementDetailId'] =  Str::uuid();
        $assetProcurementDetail['assetProcurementId'] =  $validatedData['assetProcurementId'];
        $assetProcurementDetail['assetProcurementDetailNote'] = $validatedData['assetProcurementNote'];
        $assetProcurementDetail['assetProcurementDetailDate'] = $validatedData['assetProcurementDate'];
        $assetProcurementDetail['assetProcurementDetailStatus'] = $validatedData['assetProcurementStatus'];
        
        AssetProcurementDetail::Create($assetProcurementDetail);

        return redirect('/assetProcurement/device'. '/' . $validatedData['assetProcurementId']);
    }

    public function device(ModelsAssetProcurement $assetProcurement) {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('assetProcurement.device', [
            'assetModels' => AssetModel::all(),
            'assetProcurement' => ModelsAssetProcurement::where('assetProcurementId', $assetProcurement->assetProcurementId)->first(),
            'assetProcurementDevices' => AssetProcurementDevice::where('assetProcurementId', $assetProcurement->assetProcurementId)->get()
        ]);
    }

    public function deviceStore(ModelsAssetProcurement  $assetProcurement, Request $request) {
        $validatedData = $request->validate([
            'assetModelId' => 'required',
            'assetProcurementDeviceQuantity' => 'required',
        ]);

        $assetProcurementDevices = AssetProcurementDevice::where('assetProcurementId', $assetProcurement->assetProcurementId)->get();
        foreach($assetProcurementDevices as $assetProcurementDevice) {
            if($assetProcurementDevice->assetModelId == $validatedData['assetModelId']) {
                return back()->with([
                    'error' => 'The asset model has already been taken',
                ]);
            }
        }

        $validatedData['assetProcurementDeviceId'] = Str::uuid();
        $validatedData['assetProcurementId'] = $assetProcurement->assetProcurementId;

        AssetProcurementDevice::create($validatedData);

        return back();
    }
    
    public function deviceDestroy(AssetProcurementDevice $assetProcurementDevice) {
        try{
            AssetProcurementDevice::where('assetProcurementDeviceId', $assetProcurementDevice->assetProcurementDeviceId)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }
        
        return back();
    }

    public function deviceSave(ModelsAssetProcurement  $assetProcurement) {

        $assetProcurementDevices = AssetProcurementDevice::where('assetProcurementId', $assetProcurement->assetProcurementId)->get();

        if(count($assetProcurementDevices) == 0) {
            return back()->with([
                'error' => 'No data available in table',
            ]);
        }

        return redirect('/assetProcurement')->with('success', 'Data saved successfully');
    }

    public function approvalManager() {
        return view('assetProcurement.approvalManager', [
            'assetProcurements' => ModelsAssetProcurement::where('managerId', auth()->user()->userId)->get(),
        ]);
    }

    public function approvalManagerCreate(ModelsAssetProcurement $assetProcurement) {
        return view('assetProcurement.approvalManagerCreate', [
            'assetProcurement' => ModelsAssetProcurement::where('assetProcurementId', $assetProcurement->assetProcurementId)->first(),
            'assetProcurementDevices' => AssetProcurementDevice::where('assetProcurementId', $assetProcurement->assetProcurementId)->get(),
        ]);
    }

    public function approvalManagerStore(ModelsAssetProcurement $assetProcurement, Request $request) {
        $validatedData = $request->validate([
            'assetProcurementStatus' => 'required',
            'assetProcurementDetailNote' => 'required',
        ]);

        $assetProcurementDevices = AssetProcurementDevice::where('assetProcurementId', $assetProcurement->assetProcurementId)->get();

        if(count($assetProcurementDevices) == 0) {
            return back()->with([
                'error' => 'No data available in table',
            ]);
        }

        ModelsAssetProcurement::where('assetProcurementId', $assetProcurement->assetProcurementId)->update([
            'assetProcurementStatus' => $validatedData['assetProcurementStatus'],
        ]);

        $assetProcurementDetail['assetProcurementDetailId'] =  Str::uuid();
        $assetProcurementDetail['assetProcurementId'] =  $assetProcurement->assetProcurementId;
        $assetProcurementDetail['assetProcurementDetailNote'] = $validatedData['assetProcurementDetailNote'];
        $assetProcurementDetail['assetProcurementDetailDate'] = date('Y-m-d');
        $assetProcurementDetail['assetProcurementDetailStatus'] = $validatedData['assetProcurementStatus'];
        
        AssetProcurementDetail::Create($assetProcurementDetail);

        return redirect('/assetProcurementApprovalManager')->with('success', 'Data updated successfully');
    }

    public function approvalITManager() {
        return view('assetProcurement.approvalITManager', [
            'assetProcurements' => ModelsAssetProcurement::whereNot('assetProcurementStatus', 'Approval Required')->get(),
        ]);
    }

    public function approvalITManagerCreate(ModelsAssetProcurement $assetProcurement) {
        $types = [
            [
                "type" => "Asset Purchase"
            ],
            [
                "type" => "Asset Movement"
            ],
        ];
        return view('assetProcurement.approvalITManagerCreate', [
            'assetProcurement' => ModelsAssetProcurement::where('assetProcurementId', $assetProcurement->assetProcurementId)->first(),
            'assetProcurementDevices' => AssetProcurementDevice::where('assetProcurementId', $assetProcurement->assetProcurementId)->get(),
            'types' => $types
        ]);
    }

    public function approvalITManagerStore(ModelsAssetProcurement $assetProcurement, Request $request) {
        // dd($request);
        $validatedData = $request->validate([
            'assetProcurementType' => 'required',
            'assetProcurementDetailNote' => 'required',
            'assetProcurementStatus' => 'required',
        ]);


        ModelsAssetProcurement::where('assetProcurementId', $assetProcurement->assetProcurementId)->update([
            'assetProcurementStatus' => $validatedData['assetProcurementStatus'],
            'assetProcurementType' => $validatedData['assetProcurementType'],
        ]);

        $assetProcurementDetail['assetProcurementDetailId'] =  Str::uuid();
        $assetProcurementDetail['assetProcurementId'] =  $assetProcurement->assetProcurementId;
        $assetProcurementDetail['assetProcurementDetailNote'] = $validatedData['assetProcurementDetailNote'];
        $assetProcurementDetail['assetProcurementDetailDate'] = date('Y-m-d');
        $assetProcurementDetail['assetProcurementDetailStatus'] = $validatedData['assetProcurementStatus'];
        
        AssetProcurementDetail::Create($assetProcurementDetail);

        return redirect('/assetProcurementApprovalITManager')->with('success', 'Data updated successfully');
    }
}
