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
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        
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

    public function update(Request $request, Departement $departement) {
        $validatedData = $request->validate([
            'locationId' => 'required',
            'departementName' => 'required|max:100',
        ]);

        Departement::where('departementId', $departement->departementId)->update($validatedData);

        return redirect('/departement')->with('success', 'Data updated successfully');
    }

    public function destroy(Departement $departement) {
        try{
            Departement::where('departementId', $departement->departementId)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return redirect('/departement')->with('success', 'Data deleted successfully');
    }
}
