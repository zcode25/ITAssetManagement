<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class CategoryController extends Controller
{
    public function index() {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        
        return view('category.index', [
            'categories' => Category::all()
        ]);
    }

    public function create() {
        $types = [
            [
                "type" => "Accessory"
            ],
            [
                "type" => "Asset"
            ],
            [
                "type" => "Consumable"
            ],
            [
                "type" => "Component"
            ],
            [
                "type" => "License"
            ],
        ];
        
        return view('category.create', [
            'types' => $types
        ]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'categoryName' => 'required|max:100',
            'categoryType' => 'required',
        ]);

        $validatedData['categoryId'] = IdGenerator::generate(['table' => 'categories', 'field' => 'categoryId', 'length' => 8, 'prefix' => 'CTY']);

        Category::create($validatedData);

        return redirect('/category')->with('success', 'Data saved successfully');
    }

    public function edit(Category $category) {
        $types = [
            [
                "type" => "Accessory"
            ],
            [
                "type" => "Asset"
            ],
            [
                "type" => "Consumable"
            ],
            [
                "type" => "Component"
            ],
            [
                "type" => "License"
            ],
        ];
        
        return view('category.edit', [
            'types' => $types,
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category) {
        $validatedData = $request->validate([
            'categoryName' => 'required|max:100',
            'categoryType' => 'required',
        ]);

        Category::where('categoryId', $category->categoryId)->update($validatedData);

        return redirect('/category')->with('success', 'Data updated successfully');
    }

    public function destroy(Category $category) {
        try{
            Category::where('categoryId', $category->categoryId)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return redirect('/category')->with('success', 'Data deleted successfully');
    }
}
