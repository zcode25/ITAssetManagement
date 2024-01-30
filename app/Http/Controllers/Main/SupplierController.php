<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class SupplierController extends Controller
{
    public function index() {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        
        return view('supplier.index', [
            'suppliers' => Supplier::all()
        ]);
    }

    public function create() {
        return view('supplier.create');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'supplierName' => 'required|max:100',
            'supplierPhone' => 'required|max:15',
            'supplierEmail' => 'required|max:100',
            'supplierAddress' => 'required|max:200',
            'supplierCity' => 'required|max:100',
            'supplierProvince' => 'required|max:100',
        ]);

        $validatedData['supplierId'] = IdGenerator::generate(['table' => 'suppliers', 'field' => 'supplierId', 'length' => 8, 'prefix' => 'SPL']);

        Supplier::create($validatedData);

        return redirect('/supplier')->with('success', 'Data saved successfully');
    }

    public function edit(Supplier $supplier) {

        return view('supplier.edit', [
            'supplier' => $supplier
        ]);

    }

    public function update(Request $request, Supplier $supplier) {
        $validatedData = $request->validate([
            'supplierName' => 'required|max:100',
            'supplierPhone' => 'required|max:15',
            'supplierEmail' => 'required|max:100',
            'supplierAddress' => 'required|max:200',
            'supplierCity' => 'required|max:100',
            'supplierProvince' => 'required|max:100',
        ]);

        Supplier::where('supplierId', $supplier->supplierId)->update($validatedData);

        return redirect('/supplier')->with('success', 'Data updated successfully');
    }

    public function destroy(Supplier $supplier) {
        try{
            Supplier::where('supplierId', $supplier->supplierId)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return redirect('/supplier')->with('success', 'Data deleted successfully');
    }
}
