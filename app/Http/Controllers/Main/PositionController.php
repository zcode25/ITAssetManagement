<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index() {
        return view('position.index');
    }

    public function create() {
        return view('position.create');
    }
}
