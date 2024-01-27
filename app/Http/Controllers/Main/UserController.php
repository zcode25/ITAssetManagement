<?php

namespace App\Http\Controllers\Main;

use App\Models\User;
use App\Models\Location;
use App\Models\Position;
use App\Models\Departement;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        return view('user.index', [
            'users' => User::all()
        ]);
    }

    public function create() {
        return view('user.create', [
            'locations' => Location::all(),
            'departements' => Departement::all(),
            'positions' => Position::all(),
        ]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'employeeNumber' => 'required|unique:users',
            'employeeName' => 'required|max:100',
            'password' => 'required|min:8|max:50',
            'locationId' => 'required',
            'departementId' => 'required',
            'positionId' => 'required',
            'employeeName' => 'required|max:100',
            'employeePhone' => 'required|max:15',
            'employeeEmail' => 'required|max:100',
            'employeeAddress' => 'required|max:200',
            'employeeCity' => 'required|max:100',
            'employeeProvince' => 'required|max:100',
        ]);

        $validatedData['userId'] = Str::uuid();
        $validatedData['password'] = Hash::make($request["password"]);

        User::create($validatedData);

        return redirect('/user')->with('success', 'Data saved successfully');
    }

    public function permission() {
        return view('user.permission');
    }
}
