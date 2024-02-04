<?php

namespace App\Http\Controllers\Main;

use App\Models\Category;
use App\Models\Manufacture;
use Illuminate\Http\Request;
use App\Models\AccessoryModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class AccessoryModelController extends Controller
{
    public function index() {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        
        return view('accessoryModel.index', [
            'accessoryModels' => AccessoryModel::all()
        ]);
    }

    public function create() {
        return view('accessoryModel.create', [
            'categories' => Category::where('categoryType', 'Accessory')->get(),
            'manufactures' => Manufacture::all()
        ]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'accessoryModelName' => 'required|max:100',
            'categoryId' => 'required',
            'manufactureId' => 'required',
            'accessoryModelNumber' => 'required|max:100',
            'accessoryModelImage' => 'required|mimes:png,jpg|max:2048',
        ]);

        if($request->file('accessoryModelImage')) {
            $validatedData['accessoryModelImage'] = $request->file('accessoryModelImage')->store('accessoryModelImage');
        }

        $validatedData['accessoryModelId'] = IdGenerator::generate(['table' => 'accessory_models', 'field' => 'accessoryModelId', 'length' => 8, 'prefix' => 'ACM']);

        AccessoryModel::create($validatedData);

        return redirect('/accessoryModel')->with('success', 'Data saved successfully');
    }

    public function edit(AccessoryModel $accessoryModel) {
        return view('accessoryModel.edit', [
            'accessoryModel' => $accessoryModel,
            'categories' => Category::where('categoryType', 'Accessory')->get(),
            'manufactures' => Manufacture::all()
        ]);
    }

    public function update(Request $request, AccessoryModel $accessoryModel) {
        $validatedData = $request->validate([
            'accessoryModelName' => 'required|max:100',
            'categoryId' => 'required',
            'manufactureId' => 'required',
            'accessoryModelNumber' => 'required|max:100',
            'accessoryModelImage' => 'mimes:png,jpg|max:2048',
        ]);

        $accessoryModelImage = AccessoryModel::where('accessoryModelId', $accessoryModel->accessoryModelId)->first();
        
        if ($request->accessoryModelImage == null) {
            $validatedData['accessoryModelImage'] = $accessoryModelImage->accessoryModelImage;
        } else {
            Storage::delete($accessoryModelImage->accessoryModelImage);
            $validatedData['accessoryModelImage'] = $request->file('accessoryModelImage')->store('accessoryModelImage');
        }

        AccessoryModel::where('accessoryModelId', $accessoryModel->accessoryModelId)->update($validatedData);

        return redirect('/accessoryModel')->with('success', 'Data updated successfully');
    }
    
    public function destroy(AccessoryModel $accessoryModel) {
        $accessoryModelImage = AccessoryModel::where('accessoryModelId', $accessoryModel->accessoryModelId)->first();
        try{
            Storage::delete($accessoryModelImage->accessoryModelImage);
            AccessoryModel::where('accessoryModelId', $accessoryModel->accessoryModelId)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return redirect('/accessoryModel')->with('success', 'Data deleted successfully');
    }
}
