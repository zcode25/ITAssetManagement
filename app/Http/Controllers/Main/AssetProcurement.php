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

class AssetProcurement extends Controller
{
    public function index() {
        return view('assetProcurement.index');
    }

    public function create() {
        return view('assetProcurement.create', [
            'user' => User::where('userId', auth()->user()->userId)->first(),
            'departements' => Departement::all(),
            'locations' => Location::all(),
            'positions' => Position::all(),
            'assetModels' => AssetModel::all(),
            'categories' => Category::where('categoryType', 'Asset')->get(),
            'manufactures' => Manufacture::all()
        ]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'userId' => 'required',
            'assetProcurementDate' => 'required',
            'assetProcurementNote' => 'required',
        ]);


        $validatedData['assetProcurementId'] = Str::uuid();
        $validatedData['assetProcurementNumber'] = IdGenerator::generate(['table' => 'asset_procurements', 'field' => 'assetProcurementId', 'length' => 20, 'prefix' => 'IT/PO/' . date('d/m/y/')]);
        $validatedData['assetProcurementStatus'] = 'Need Approval';

        ModelsAssetProcurement::create($validatedData);

        return redirect('/assetProcurement/device'. '/' . $validatedData['assetProcurementId'])->with('success', 'Data saved successfully');
    }

    public function device(ModelsAssetProcurement $assetProcurement) {
        return view('assetProcurement.device', [
            'assetProcurement' => ModelsAssetProcurement::where('assetProcurementId', $assetProcurement->assetProcurementId)->first(),
        ]);
    }
}
