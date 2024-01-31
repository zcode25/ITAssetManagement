<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Manufacture;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ManufactureController extends Controller
{
    public function index() {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        
        return view('manufacture.index', [
            'manufactures' => Manufacture::all()
        ]);
    }

    public function create() {
        return view('manufacture.create');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'manufactureName' => 'required|max:100',
            'manufacturePhone' => 'required|max:15',
            'manufactureEmail' => 'required|max:100',
        ]);

        $validatedData['manufactureId'] = IdGenerator::generate(['table' => 'manufactures', 'field' => 'manufactureId', 'length' => 8, 'prefix' => 'MNC']);

        Manufacture::create($validatedData);

        return redirect('/manufacture')->with('success', 'Data saved successfully');
    }

    public function edit(Manufacture $manufacture) {
        return view('manufacture.edit', [
            'manufacture' => $manufacture
        ]);
    }

    public function update(Request $request, Manufacture $manufacture) {
        $validatedData = $request->validate([
            'manufactureName' => 'required|max:100',
            'manufacturePhone' => 'required|max:15',
            'manufactureEmail' => 'required|max:100',
        ]);

        Manufacture::where('manufactureId', $manufacture->manufactureId)->update($validatedData);

        return redirect('/manufacture')->with('success', 'Data updated successfully');
    }

    public function destroy(Manufacture $manufacture) {
        try{
            Manufacture::where('manufactureId', $manufacture->manufactureId)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return redirect('/manufacture')->with('success', 'Data deleted successfully');
    }
}
