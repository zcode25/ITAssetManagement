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
            <h1>Asset Disposal</h1>
          </div>
          <div class="col-sm-6">
            <div class="float-sm-right">
              {{-- @if($menuData['assetModelCreate']['index']) --}}
              <a href="/assetDisposal/create" class="btn btn-primary">Create New</a>
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
          <h3 class="card-title">Asset Disposal List</h3>

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
              <th>Disposal Number</th>
              <th>Disposal Date</th>
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
            @foreach ($assetDisposals as $assetDisposal)
            <tr>
              <td>{{ $assetDisposal->assetDisposalNumber }}</td>
              <td>{{ $assetDisposal->assetDisposalDate }}</td>
              <td>{{ $assetDisposal->user->employeeName }}</td>
              <td>{{ $assetDisposal->manager->employeeName }}</td>
              <td>{{ $assetDisposal->location->company->companyName }} - {{ $assetDisposal->location->locationName }}</td>
              <td>{{ $assetDisposal->assetDisposalStatus }}</td>
              <td class="py-0 align-middle">
                <div class="btn-group btn-group-sm">
                  @if($assetDisposal->assetDisposalStatus == 'Pre Disposal')
                    <a href="/assetDisposal/device/{{ $assetDisposal->assetDisposalId }}" class="btn btn-success">Device</a>
                  @endif
                  @if($assetDisposal->assetDisposalStatus == 'Asset for Disposal')
                    <a href="/assetDisposal/disposal/{{ $assetDisposal->assetDisposalId }}" class="btn btn-success">Disposal</a>
                  @endif
                  <a href="/assetDisposal/detail/{{ $assetDisposal->assetDisposalId }}" class="btn btn-primary">Detail</a>
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