<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Models\AssetDeployment;
use App\Http\Controllers\Controller;

class AssetRepairController extends Controller
{
    public function index() {
        return view('assetRepair.index', [
            'assetDeployments' => AssetDeployment::where('assetDeploymentStatus', 'Repair')->get(),
        ]);
    }
}
