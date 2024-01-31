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
            <h1>User</h1>
          </div>
          <div class="col-sm-6">
            <div class="float-sm-right">
              @if($menuData['userCreate']['index'])
              <a href="/user/create" class="btn btn-primary">Create New</a>
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
          <h3 class="card-title">User List</h3>

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
              <th>Name</th>
              <th>Company</th>
              <th>Location</th>
              <th>Departement</th>
              <th>Position</th>
              @if($menuData['userEdit']['index'] || $menuData['userPermission']['index'] || $menuData['userDelete']['index'])
              <th>Action</th>
              @endif
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
            <tr>
              <td>{{ $user->employeeName }}</td>
              <td>{{ $user->location->company->companyName }}</td>
              <td>{{ $user->location->locationName }}</td>
              <td>{{ $user->departement->departementName }}</td>
              <td>{{ $user->position->positionName }}</td>
              <td class="py-0 align-middle">
                <div class="btn-group btn-group-sm">
                  @if($menuData['userEdit']['index'])
                  <a href="/user/edit/{{ $user->userId }}" class="btn btn-primary">Edit</a>
                  @endif
                  @if($menuData['userPermission']['index'])
                  <a href="/user/permission/{{ $user->userId }}" class="btn btn-warning">Permission</a>
                  @endif
                  @if($menuData['userDelete']['index'])
                  <a href="/user/destroy/{{ $user->userId }}" class="btn btn-danger" data-confirm-delete="true">Delete</a>
                  @endif
                </div>
              </td>
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