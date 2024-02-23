@extends('layouts/main')
@section('container')
@php
$jsonData = auth()->user()->permission;
$menuData = json_decode($jsonData, true);
@endphp

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Supplier</h1>
          </div>
          <div class="col-sm-6">
            <div class="float-sm-right">
              @if($menuData['supplierCreate']['index'])
              <a href="/supplier/create" class="btn btn-primary">Create New</a>
              @endif
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Supplier List</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <table id="example1" class="table table-hover">
            <thead>
            <tr>
              <th>Supplier</th>
              <th>Phone</th>
              <th>Email</th>
              <th>Address</th>
              <th>City</th>
              <th>Province</th>
              @if($menuData['supplierEdit']['index'] || $menuData['supplierDelete']['index'])
              <th>Action</th>
              @endif
            </tr>
            </thead>
            <tbody>
            @foreach ($suppliers as $supplier)
            <tr>
              <td>{{ $supplier->supplierName }}</td>
              <td>{{ $supplier->supplierPhone }}</td>
              <td>{{ $supplier->supplierEmail }}</td>
              <td>{{ $supplier->supplierAddress }}</td>
              <td>{{ $supplier->supplierCity }}</td>
              <td>{{ $supplier->supplierProvince }}</td>
              @if($menuData['supplierEdit']['index'] || $menuData['supplierDelete']['index'])
              <td class="py-0 align-middle">
                <div class="btn-group btn-group-sm">
                  @if($menuData['supplierEdit']['index'])
                  <a href="/supplier/edit/{{ $supplier->supplierId }}" class="btn btn-primary">Edit</a>
                  @endif
                  @if($menuData['supplierDelete']['index'])
                  <a href="/supplier/destroy/{{ $supplier->supplierId }}" class="btn btn-danger" data-confirm-delete="true">Delete</a>
                  @endif
                </div>
              </td>
              @endif
            </tr>    
            @endforeach
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection