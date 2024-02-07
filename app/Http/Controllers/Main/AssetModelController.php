<?php

namespace App\Http\Controllers\Main;

use App\Models\Category;
use App\Models\AssetModel;
use App\Models\Manufacture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class AssetModelController extends Controller
{
    public function index() {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        
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

        $validatedData['assetModelId'] = IdGenerator::generate(['table' => 'asset_models', 'field' => 'assetModelId', 'length' => 8, 'prefix' => 'ASM']);

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

    public function update(Request $request, AssetModel $assetModel) {
        $validatedData = $request->validate([
            'assetModelName' => 'required|max:100',
            'categoryId' => 'required',
            'manufactureId' => 'required',
            'assetModelNumber' => 'required|max:100',
            'assetModelImage' => 'mimes:png,jpg|max:2048',
        ]);

        $assetModelImage = AssetModel::where('assetModelId', $assetModel->assetModelId)->first();
        
        if ($request->assetModelImage == null) {
            $validatedData['assetModelImage'] = $assetModelImage->assetModelImage;
        } else {
            Storage::delete($assetModelImage->assetModelImage);
            $validatedData['assetModelImage'] = $request->file('assetModelImage')->store('assetModelImage');
        }

        assetModel::where('assetModelId', $assetModel->assetModelId)->update($validatedData);

        return redirect('/assetModel')->with('success', 'Data updated successfully');
    }

    public function destroy(AssetModel $assetModel) {
        $assetModelImage = AssetModel::where('assetModelId', $assetModel->assetModelId)->first();
        try{
            Storage::delete($assetModelImage->assetModelImage);
            AssetModel::where('assetModelId', $assetModel->assetModelId)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return redirect('/assetModel')->with('success', 'Data deleted successfully');
    }
}
