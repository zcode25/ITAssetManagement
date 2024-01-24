<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use App\Models\Location;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class DepartementController extends Controller
{
    public function index() {
        return view('departement.index', [
            'departements' => Departement::all()
        ]);
    }

    public function create() {
        return view('departement.create', [
            'locations' => Location::all()
        ]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'locationId' => 'required',
            'departementName' => 'required|max:100',
        ]);

        $validatedData['departementId'] = IdGenerator::generate(['table' => 'departements', 'field' => 'departementId', 'length' => 8, 'prefix' => 'DPT']);

        Departement::create($validatedData);

        return redirect('/departement')->with('success', 'Data saved successfully');
        
    }

    public function edit(Departement $departement) {
        return view('departement.edit', [
            'locations' => Location::all(),
            'departement' => $departement
        ]);
    }
}
