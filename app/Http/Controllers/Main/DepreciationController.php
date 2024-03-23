<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Depreciation;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;

class DepreciationController extends Controller
{
    public function index() {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('depreciation.index', [
            'depreciations' => Depreciation::all(),
        ]);
    }

    public function create() {
        return view('depreciation.create', [
            'categories' => Category::all(),
        ]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'depreciationName' => 'required|max:200',
            'categoryId' => 'required',
            'depreciationUseful' => 'required',
            'depreciationResidual' => 'required',
        ]);

        $validatedData['depreciationId'] = IdGenerator::generate(['table' => 'depreciations', 'field' => 'depreciationId', 'length' => 8, 'prefix' => 'DPC']);

        Depreciation::create($validatedData);

        return redirect('/depreciation')->with('success', 'Data saved successfully');
    }

    public function edit(Depreciation $depreciation) {
        return view('depreciation.edit', [
            'depreciation' => $depreciation,
            'categories' => Category::all(),
        ]);
    }

    public function update(Depreciation $depreciation, Request $request) {
        $validatedData = $request->validate([
            'depreciationName' => 'required|max:200',
            'categoryId' => 'required',
            'depreciationUseful' => 'required',
            'depreciationResidual' => 'required',
        ]);

        Depreciation::where('depreciationId', $depreciation->depreciationId)->update($validatedData);

        return redirect('/depreciation')->with('success', 'Data updated successfully');
    }

    public function destroy(Depreciation $depreciation) {
        try{
            Depreciation::where('depreciationId', $depreciation->depreciationId)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return redirect('/depreciation')->with('success', 'Data deleted successfully');
    }
}
