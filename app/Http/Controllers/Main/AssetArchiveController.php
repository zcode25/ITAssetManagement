<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssetDeployment;

class AssetArchiveController extends Controller
{
    public function index() {
        return view('assetArchive.index', [
            'assetDeployments' => AssetDeployment::where('assetDeploymentStatus', 'Archive')->get(),
        ]);
    }
}
