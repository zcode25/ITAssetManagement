<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class CompanyController extends Controller
{
    public function index() {
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('company.index', [
            'companies' => Company::all()
        ]);
    }

    public function create() {
        return view('company.create');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'companyName' => 'required|max:50',
        ]);

        $validatedData['companyId'] = IdGenerator::generate(['table' => 'companies', 'field' => 'companyId', 'length' => 8, 'prefix' => 'CPN']);

        Company::create($validatedData);

        return redirect('/company')->with('success', 'Data saved successfully');
    }

    public function edit(Company $company) {
        return view('company.edit', [
            'company' => $company,
        ]);
    }

    public function update(Request $request, Company $company) {
        $validatedData = $request->validate([
            'companyName' => 'required|max:50',
        ]);

        Company::where('companyId', $company->companyId)->update($validatedData);

        return redirect('/company')->with('success', 'Data updated successfully');
    }

    public function destroy(Company $company) {
        try{
            Company::where('companyId', $company->companyId)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return redirect('/company')->with('success', 'Data deleted successfully');
    }
}
