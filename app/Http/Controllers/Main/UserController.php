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
        // $jsonData = auth()->user()->permission;
        // $menuData = json_decode($jsonData, true);

        // dd($menuData);

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

        $validatedData['permission'] = '{
            "dashboardIndex":{"index":true}, 
            "companyIndex":{"index":false}, 
            "companyCreate":{"index":false},
            "companyEdit":{"index":false},
            "companyDelete":{"index":false},
            "locationIndex":{"index":false}, 
            "locationCreate":{"index":false},
            "locationEdit":{"index":false},
            "locationDelete":{"index":false},
            "departementIndex":{"index":false}, 
            "departementCreate":{"index":false},
            "departementEdit":{"index":false},
            "departementDelete":{"index":false},
            "positionIndex":{"index":false}, 
            "positionCreate":{"index":false},
            "positionEdit":{"index":false},
            "positionDelete":{"index":false},
            "userIndex":{"index":false}, 
            "userCreate":{"index":false},
            "userPermission":{"index":false},
            "userEdit":{"index":false},
            "userDelete":{"index":false}
        }';

        User::create($validatedData);

        return redirect('/user')->with('success', 'Data saved successfully');
    }

    public function permission(User $user) {
        return view('user.permission', [
            'user' => $user
        ]);
    }

    public function permissionCreate(Request $request, User $user) {

        // dd($request);

        $permission = '{
            "dashboardIndex":{"index":'. $request->dashboardIndex .'}, 
            "companyIndex":{"index":'. $request->companyIndex .'}, 
            "companyCreate":{"index":'. $request->companyCreate .'},
            "companyEdit":{"index":'. $request->companyEdit .'},
            "companyDelete":{"index":'. $request->companyDelete .'},
            "locationIndex":{"index":'. $request->locationIndex .'}, 
            "locationCreate":{"index":'. $request->locationCreate .'},
            "locationEdit":{"index":'. $request->locationEdit .'},
            "locationDelete":{"index":'. $request->locationDelete .'},
            "departementIndex":{"index":'. $request->departementIndex .'}, 
            "departementCreate":{"index":'. $request->departementCreate .'},
            "departementEdit":{"index":'. $request->departementEdit .'},
            "departementDelete":{"index":'. $request->departementDelete .'},
            "positionIndex":{"index":'. $request->positionIndex .'}, 
            "positionCreate":{"index":'. $request->positionCreate .'},
            "positionEdit":{"index":'. $request->positionEdit .'},
            "positionDelete":{"index":'. $request->positionDelete .'},
            "userIndex":{"index":'. $request->userIndex .'}, 
            "userCreate":{"index":'. $request->userCreate .'},
            "userPermission":{"index":'. $request->userPermission .'},
            "userEdit":{"index":'. $request->userEdit .'},
            "userDelete":{"index":'. $request->userDelete .'}
        }';

        User::where('userId', $user->userId)->update(['permission' => $permission]);

        return redirect('/user')->with('success', 'User permissions have been saved');

    }
}
