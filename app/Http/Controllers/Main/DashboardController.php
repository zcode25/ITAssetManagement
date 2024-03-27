<?php

namespace App\Http\Controllers\Main;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AssetDeployment;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {


        $assetCount = AssetDeployment::whereHas('assetModel.category', function ($query) {
            $query->where('categoryType', 'Asset');
        })->count();

        $licenseCount = AssetDeployment::whereHas('assetModel.category', function ($query) {
            $query->where('categoryType', 'License');
        })->count();

        $accessoryCount = AssetDeployment::whereHas('assetModel.category', function ($query) {
            $query->where('categoryType', 'Accessory');
        })->count();

        $consumableCount = AssetDeployment::whereHas('assetModel.category', function ($query) {
            $query->where('categoryType', 'Consumable');
        })->count();

        $componentCount = AssetDeployment::whereHas('assetModel.category', function ($query) {
            $query->where('categoryType', 'Component');
        })->count();

        $userCount = User::count();

        $status = AssetDeployment::select( 'assetDeploymentStatus', DB::raw('count(*) as total'))->groupBy('assetDeploymentStatus')->orderBy('assetDeploymentStatus', 'asc')->get();
        
        $label = [];
        $total = [];
        foreach($status as $st) {
            $label[] = $st->assetDeploymentStatus;
            $total[] = $st->total;
        };
        
        return view('dashboard.index', [
            'assetCount' => $assetCount,
            'licenseCount' => $licenseCount,
            'accessoryCount' => $accessoryCount,
            'consumableCount' => $consumableCount,
            'componentCount' => $componentCount,
            'userCount' => $userCount,
            'label' => $label,
            'total' => $total,
        ]);
    }
}
