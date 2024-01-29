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
            <h1>Company</h1>
          </div>
          <div class="col-sm-6">
            <div class="float-sm-right">
              @if($menuData['companyCreate']['index'])
              <a href="/company/create" class="btn btn-primary">Create New</a>
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
          <h3 class="card-title">Company List</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <table id="example1" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>Company Name</th>
              @if($menuData['companyEdit']['index'] || $menuData['companyDelete']['index'])
              <th>Action</th>
              @endif
            </tr>
            </thead>
            <tbody>
            @foreach ($companies as $company)
            <tr>
              <td>{{ $company->companyName }}</td>
              @if($menuData['companyEdit']['index'] || $menuData['companyDelete']['index'])
              <td class="py-0 align-middle">
                <div class="btn-group btn-group-sm">
                  @if($menuData['companyEdit']['index'])
                  <a href="/company/edit/{{ $company->companyId }}" class="btn btn-primary">Edit</a>
                  @endif
                  @if($menuData['companyDelete']['index'])
                  <a href="/company/destroy/{{ $company->companyId }}" class="btn btn-danger" data-confirm-delete="true">Delete</a>
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