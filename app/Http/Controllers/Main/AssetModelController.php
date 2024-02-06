<?php

namespace App\Http\Controllers\Main;

use App\Models\Category;
use App\Models\AssetModel;
use App\Models\Manufacture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class AssetModelController extends Controller
{
    public function index() {
        return view('assetModel.index', [
            'assetModels' => AssetModel::all()
        ]);
    }

    public function create() {
        return view('assetModel.create', [
            'categories' => Category::where('categoryType', 'Asset')->get(),
            'manufactures' => Manufacture::all()
        ]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'assetModelName' => 'required|max:100',
            'categoryId' => 'required',
            'manufactureId' => 'required',
            'assetModelNumber' => 'required|max:100',
            'assetModelImage' => 'required|mimes:png,jpg|max:2048',
        ]);

        if($request->file('assetModelImage')) {
            $validatedData['assetModelImage'] = $request->file('assetModelImage')->store('assetModelImage');
        }

        $validatedData['assetModelId'] = IdGenerator::generate(['table' => 'asset_models', 'field' => 'assetModelId', 'length' => 8, 'prefix' => 'ACM']);

        AssetModel::create($validatedData);

        return redirect('/assetModel')->with('success', 'Data saved successfully');
    }

    public function edit(AssetModel $assetModel) {
        return view('assetModel.edit', [
            'assetModel' => $assetModel,
            'categories' => Category::where('categoryType', 'Asset')->get(),
            'manufactures' => Manufacture::all()
        ]);
    }
}
