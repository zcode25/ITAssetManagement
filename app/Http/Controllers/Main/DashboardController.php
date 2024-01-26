<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        // $user = User::where('userId', auth()->user()->userId)->first();
        // $jsonData = $user->permission;
        // $dashboardData = json_decode($jsonData, true);
        // $dashboardIndex = $dashboardData['dashboard.index']['index'];

        return view('dashboard.index');
    }
}
