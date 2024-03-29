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
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        
        return view('user.index', [
            'users' => User::all()
        ]);
    }

    public function create() {
        return view('user.create', [
            'locations' => Location::all(),
            'departements' => Departement::all(),
            'positions' => Position::all(),
            'managers' => User::where('positionId', 'PST00001')->get(),
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
            'managerId' => 'required|max:100',
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
            "userDelete":{"index":false},
            "supplierIndex":{"index":false}, 
            "supplierCreate":{"index":false},
            "supplierEdit":{"index":false},
            "supplierDelete":{"index":false},
            "manufactureIndex":{"index":false}, 
            "manufactureCreate":{"index":false},
            "manufactureEdit":{"index":false},
            "manufactureDelete":{"index":false},
            "categoryIndex":{"index":false}, 
            "categoryCreate":{"index":false},
            "categoryEdit":{"index":false},
            "categoryDelete":{"index":false},
            "depreciationIndex":{"index":false}, 
            "depreciationCreate":{"index":false},
            "depreciationEdit":{"index":false},
            "depreciationDelete":{"index":false},
            "assetyModelIndex":{"index":false}, 
            "assetyModelCreate":{"index":false},
            "assetyModelEdit":{"index":false},
            "assetyModelDelete":{"index":false},
            "assetIndex":{"index":false},
            "assetProcurementAllIndex":{"index":false},
            "assetProcurementIndex":{"index":false},
            "assetProcurementApprovalManager":{"index":false},
            "assetProcurementApprovalITManager":{"index":false},
            "assetPurchaseIndex":{"index":false},
            "assetDeploymentAllIndex":{"index":false},
            "assetPreDeploymentIndex":{"index":false},
            "assetDeploymentReadyIndex":{"index":false},
            "assetDeploymentCheckoutIndex":{"index":false},
            "assetArchiveIndex":{"index":false},
            "assetRepairIndex":{"index":false},
            "assetBrokenIndex":{"index":false},
            "assetDisposalIndex":{"index":false},
            "assetDepreciationIndex":{"index":false}
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

        // dd($request->dashboardIndex);

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
            "userDelete":{"index":'. $request->userDelete .'},
            "supplierIndex":{"index":'. $request->supplierIndex .'}, 
            "supplierCreate":{"index":'. $request->supplierCreate .'},
            "supplierEdit":{"index":'. $request->supplierEdit .'},
            "supplierDelete":{"index":'. $request->supplierDelete .'},
            "manufactureIndex":{"index":'. $request->manufactureIndex .'}, 
            "manufactureCreate":{"index":'. $request->manufactureCreate .'},
            "manufactureEdit":{"index":'. $request->manufactureEdit .'},
            "manufactureDelete":{"index":'. $request->manufactureDelete .'},
            "categoryIndex":{"index":'. $request->categoryIndex .'}, 
            "categoryCreate":{"index":'. $request->categoryCreate .'},
            "categoryEdit":{"index":'. $request->categoryEdit .'},
            "categoryDelete":{"index":'. $request->categoryDelete .'},
            "depreciationIndex":{"index":'. $request->depreciationIndex .'}, 
            "depreciationCreate":{"index":'. $request->depreciationCreate .'},
            "depreciationEdit":{"index":'. $request->depreciationEdit .'},
            "depreciationDelete":{"index":'. $request->depreciationDelete .'},
            "assetModelIndex":{"index":'. $request->assetModelIndex .'}, 
            "assetModelCreate":{"index":'. $request->assetModelCreate .'},
            "assetModelEdit":{"index":'. $request->assetModelEdit .'},
            "assetModelDelete":{"index":'. $request->assetModelDelete .'},
            "assetIndex":{"index":'. $request->assetIndex .'},
            "assetProcurementAllIndex":{"index":'. $request->assetProcurementAllIndex .'},
            "assetProcurementIndex":{"index":'. $request->assetProcurementIndex .'},
            "assetProcurementApprovalManager":{"index":'. $request->assetProcurementApprovalManager .'},
            "assetProcurementApprovalITManager":{"index":'. $request->assetProcurementApprovalITManager .'},
            "assetPurchaseIndex":{"index":'. $request->assetPurchaseIndex .'},
            "assetDeploymentAllIndex":{"index":'. $request->assetDeploymentAllIndex .'},
            "assetPreDeploymentIndex":{"index":'. $request->assetPreDeploymentIndex .'},
            "assetDeploymentReadyIndex":{"index":'. $request->assetDeploymentReadyIndex .'},
            "assetDeploymentCheckoutIndex":{"index":'. $request->assetDeploymentCheckoutIndex .'},
            "assetArchiveIndex":{"index":'. $request->assetArchiveIndex .'},
            "assetRepairIndex":{"index":'. $request->assetRepairIndex .'},
            "assetBrokenIndex":{"index":'. $request->assetBrokenIndex .'},
            "assetDisposalIndex":{"index":'. $request->assetDisposalIndex .'},
            "assetDepreciationIndex":{"index":'. $request->assetDepreciationIndex .'}
        }';

        User::where('userId', $user->userId)->update(['permission' => $permission]);

        return redirect('/user')->with('success', 'User permissions have been saved');

    }

    public function edit(User $user) {
        return view('user.edit', [
            'user' => $user,
            'locations' => Location::all(),
            'departements' => Departement::all(),
            'positions' => Position::all(),
            'managers' => User::where('positionId', 'PST00001')->get(),
        ]);
    }

    public function update(Request $request, User $user) {
        $validatedData = $request->validate([
            'employeeNumber' => 'required',
            'employeeName' => 'required|max:100',
            'locationId' => 'required',
            'departementId' => 'required',
            'positionId' => 'required',
            'managerId' => 'required|max:100',
            'employeeName' => 'required|max:100',
            'employeePhone' => 'required|max:15',
            'employeeEmail' => 'required|max:100',
            'employeeAddress' => 'required|max:200',
            'employeeCity' => 'required|max:100',
            'employeeProvince' => 'required|max:100',
        ]);

        $user = user::where('userId', $user->userId)->first();

        if ($request->employeeNumber == $user->employeeNumber) {
            $validatedData['employeeNumber'] = $request->employeeNumber;
        }

        try{
            User::where('userId', $user->userId)->update($validatedData);
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'The employee number has already been taken.',
            ]);
        }

        return redirect('/user')->with('success', 'Data updated successfully');
    }

    public function resetPassword(Request $request, User $user) {
        $validatedData = $request->validate([
            'password' => 'required|min:8|max:50',
        ]);

        $validatedData['password'] = Hash::make($request["password"]);

        User::where('userId', $user->userId)->update($validatedData);

        return redirect('/user')->with('success', 'Data updated successfully');
        
    }

    public function destroy(User $user) {
        try{
            User::where('userId', $user->userId)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return redirect('/user')->with('success', 'Data deleted successfully');
    }
}
