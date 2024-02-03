<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccessoryModelController extends Controller
{
    public function index() {
        return view('accessorModels.index');
    }
}
