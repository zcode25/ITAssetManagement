@extends('layouts/main')
@section('container')
@php
use App\Models\User;
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
            <h1>Asset Movement</h1>
          </div>
          <div class="col-sm-6">
            <div class="float-sm-right">
              {{-- @if($menuData['assetModelCreate']['index']) --}}
              {{-- <a href="/assetProcurement/create" class="btn btn-primary">Create New</a> --}}
              {{-- @endif --}}
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
          <h3 class="card-title">Asset Movement List</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <table id="example2" class="table table-hover">
            <thead>
            <tr>
              <th>Procurement Number</th>
              <th>Procurement Date</th>
              <th>User</th>
              <th>Manager</th>
              <th>Location</th>
              <th>Status</th>
              {{-- @if($menuData['assetModelEdit']['index'] || $menuData['assetModelDelete']['index']) --}}
              <th>Action</th>
              {{-- @endif --}}
            </tr>
            </thead>
            <tbody>
            @foreach ($assetProcurements as $assetProcurement)
            <tr>
              <td>{{ $assetProcurement->assetProcurementNumber }}</td>
              <td>{{ $assetProcurement->assetProcurementDate }}</td>
              <td>{{ $assetProcurement->user->employeeName }}</td>
              <td>{{ $assetProcurement->manager->employeeName }}</td>
              <td>{{ $assetProcurement->location->company->companyName }} - {{ $assetProcurement->location->locationName }}</td>
              <td>{{ $assetProcurement->assetProcurementStatus }}</td>
              {{-- @if($menuData['assetModelEdit']['index'] || $menuData['assetModelDelete']['index']) --}}
              <td class="py-0 align-middle">
                <div class="btn-group btn-group-sm">
                  {{-- @if($menuData['assetModelEdit']['index']) --}}
                  @if($assetProcurement->assetProcurementStatus == 'Approved by IT Manager')
                    <a href="/assetMovement/movement/{{ $assetProcurement->assetProcurementId }}" class="btn btn-success">Movement</a>
                  @endif
                  @if($assetProcurement->assetProcurementStatus == 'Asset Movement')
                    <a href="/assetMovement/device/{{ $assetProcurement->assetProcurementId }}" class="btn btn-success">Device</a>
                  @endif
                  
                  <a href="/assetMovement/detail/{{ $assetProcurement->assetProcurementId }}" class="btn btn-primary">Detail</a>
                  {{-- @endif --}}
                  {{-- @if($menuData['assetModelDelete']['index']) --}}
                  {{-- <a href="/assetModel/destroy/{{ $assetProcurement->assetProcurementId }}" class="btn btn-danger" data-confirm-delete="true">Delete</a> --}}
                  {{-- @endif --}}
                </div>
              </td>
              {{-- @endif --}}
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