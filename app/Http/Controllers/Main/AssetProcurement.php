<?php

namespace App\Http\Controllers\Main;

use App\Models\Category;
use App\Models\Manufacture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssetProcurement extends Controller
{
    public function index() {
        return view('assetProcurement.index');
    }

    public function create() {
        return view('assetModel.create', [
            'categories' => Category::where('categoryType', 'Asset')->get(),
            'manufactures' => Manufacture::all()
        ]);
    }
}
