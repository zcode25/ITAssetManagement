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
            <h1>Accessory Model</h1>
          </div>
          <div class="col-sm-6">
            <div class="float-sm-right">
              @if($menuData['accessoryModelCreate']['index'])
              <a href="/accessoryModel/create" class="btn btn-primary">Create New</a>
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
          <h3 class="card-title">Accessory Model List</h3>

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
              <th>Image</th>
              <th>Model No.</th>
              <th>Category</th>
              <th>Manufacture</th>
              @if($menuData['accessoryModelEdit']['index'] || $menuData['accessoryModelDelete']['index'])
              <th>Action</th>
              @endif
            </tr>
            </thead>
            <tbody>
            @foreach ($accessoryModels as $accessoryModel)
            <tr>
              <td>{{ $accessoryModel->accessoryModelName }}</td>
              <td><img src="{{ asset('storage/' .  $accessoryModel->accessoryModelImage ) }}" alt="{{ $accessoryModel->accessoryModelName }}" class="img-responsive" style="max-height: 30px; width: auto;"></td>
              <td>{{ $accessoryModel->accessoryModelNumber }}</td>
              <td>{{ $accessoryModel->category->categoryName }}</td>
              <td>{{ $accessoryModel->manufacture->manufactureName }}</td>
              @if($menuData['accessoryModelEdit']['index'] || $menuData['accessoryModelDelete']['index'])
              <td class="py-0 align-middle">
                <div class="btn-group btn-group-sm">
                  @if($menuData['accessoryModelEdit']['index'])
                  <a href="/accessoryModel/edit/{{ $accessoryModel->accessoryModelId }}" class="btn btn-primary">Edit</a>
                  @endif
                  @if($menuData['accessoryModelDelete']['index'])
                  <a href="/accessoryModel/destroy/{{ $accessoryModel->accessoryModelId }}" class="btn btn-danger" data-confirm-delete="true">Delete</a>
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