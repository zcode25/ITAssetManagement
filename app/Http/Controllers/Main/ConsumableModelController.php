<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ConsumableModel;
use App\Models\Manufacture;
use Illuminate\Http\Request;

class ConsumableModelController extends Controller
{
    public function index() {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        
        return view('consumableModel.index', [
            'consumableModels' => ConsumableModel::all()
        ]);
    }

    public function create() {
        return view('consumableModel.create', [
            'categories' => Category::where('categoryType', 'Consumable')->get(),
            'manufactures' => Manufacture::all()
        ]);
    }

}
