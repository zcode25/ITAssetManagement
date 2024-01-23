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
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('location.index', [
            'locations' => Location::all()
        ]);
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
            'locationProvince' => 'required|max:100',
        ]);

        $validatedData['locationId'] = IdGenerator::generate(['table' => 'locations', 'field' => 'locationId', 'length' => 8, 'prefix' => 'LCT']);

        Location::create($validatedData);

        return redirect('/location')->with('success', 'Data saved successfully');
    }

    public function edit(Location $location) {
        return view('location.edit', [
            'companies' => Company::all(),
            'location' => $location
        ]);
    }

    public function update(Request $request, Location $location) {
        $validatedData = $request->validate([
            'companyId' => 'required',
            'locationName' => 'required|max:100',
            'locationPhone' => 'required|max:15',
            'locationEmail' => 'required|max:100',
            'locationAddress' => 'required|max:200',
            'locationCity' => 'required|max:100',
            'locationProvince' => 'required|max:100',
        ]);

        Location::where('locationId', $location->locationId)->update($validatedData);

        return redirect('/location')->with('success', 'Data updated successfully');
    }

    public function destroy(Location $location) {
        try{
            Location::where('locationId', $location->locationId)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return redirect('/location')->with('success', 'Data deleted successfully');
    }
}
