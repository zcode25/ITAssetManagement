<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\AssetDeployment;
use Illuminate\Http\Request;

class AssetDepreciationController extends Controller
{
    public function index() {
        return view('assetDepreciation.index', [
            'assetDeployments' => AssetDeployment::all(),
        ]);
    }
}
