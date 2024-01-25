<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PositionController extends Controller
{
    public function index() {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('position.index', [
            'positions' => Position::all()
        ]);
    }

    public function create() {
        return view('position.create');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'positionName' => 'required|max:100',
        ]);

        $validatedData['positionId'] = IdGenerator::generate(['table' => 'positions', 'field' => 'positionId', 'length' => 8, 'prefix' => 'PST']);

        Position::create($validatedData);

        return redirect('/position')->with('success', 'Data saved successfully');
    }

    public function edit(Position $position) {
        return view('position.edit', [
            'position' => $position,
        ]);
    }

    public function update(Request $request, Position $position) {
        $validatedData = $request->validate([
            'positionName' => 'required|max:50',
        ]);

        Position::where('positionId', $position->positionId)->update($validatedData);

        return redirect('/position')->with('success', 'Data updated successfully');
    }

    public function destroy(Position $position) {
        try{
            Position::where('positionId', $position->positionId)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return redirect('/position')->with('success', 'Data deleted successfully');
    }
}
