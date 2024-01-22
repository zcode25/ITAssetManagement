<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Location;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class LocationController extends Controller
{
    public function index() {
        return view('location.index');
    }

    public function create() {
        return view('location.create', [
            'companies' => Company::all()
        ]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'companyId' => 'required|max:50',
            'locationName' => 'required|max:100',
            'locationPhone' => 'required|max:15',
            'locationEmail' => 'required|max:100',
            'locationAddress' => 'required|max:200',
            'locationCity' => 'required|max:100',
            'locationState' => 'required|max:100',
        ]);

        $validatedData['locationId'] = IdGenerator::generate(['table' => 'locations', 'field' => 'locationId', 'length' => 8, 'prefix' => 'LCT']);

        Location::create($validatedData);

        return redirect('/location')->with('success', 'Data saved successfully');
    }
}
