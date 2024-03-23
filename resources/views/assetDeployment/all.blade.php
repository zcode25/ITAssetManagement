@extends('layouts/main')
@section('container')
@php
use App\Models\AssetDeployment;
use App\Models\AssetProcurementDevice;
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
            <h1>Asset Deployment</h1>
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
          <h3 class="card-title">Asset Deployment List</h3>

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
              <th>Deployment Number</th>
              <th>Date</th>
              <th>Image</th>
              <th>Device</th>
              <th>Category</th>
              <th>Type</th>
              <th>Checked Out To</th>
              <th>Location</th>
              <th>Status</th>
              {{-- @if($menuData['assetModelEdit']['index'] || $menuData['assetModelDelete']['index']) --}}
              <th>Action</th>
              {{-- @endif --}}
            </tr>
            </thead>
            <tbody>
            @foreach ($assetDeployments as $assetDeployment)
            <tr>
              <td>{{ $assetDeployment->assetDeploymentNumber }}</td>
              <td>{{ $assetDeployment->assetDeploymentDate }}</td>
              <td><img src="{{ asset('storage/' .  $assetDeployment->assetModel->assetModelImage ) }}" alt="{{ $assetDeployment->assetModel->assetModelName }}" class="img-responsive" style="max-height: 30px; width: auto;"></td>
              <td>{{ $assetDeployment->assetModel->assetModelName }}</td>
              <td>{{ $assetDeployment->assetModel->category->categoryName }}</td>
              <td>{{ $assetDeployment->assetModel->category->categoryType }}</td>
              @if($assetDeployment->assetId != null)
                @php
                  $asset = assetDeployment::where('assetDeploymentId', $assetDeployment->assetId)->first();
                @endphp
                <td><i class="fa-solid fa-barcode mr-2"></i> {{ $asset->assetDeploymentNumber }}</td>
                <td>-</td>
              @else
                @if ($assetDeployment->userId != null)
                <td><i class="fa-regular fa-user mr-2"></i> {{ $assetDeployment->user->employeeName }}</td>
                @else
                <td>-</td>
                @endif
                @if ($assetDeployment->locationId != null)
                <td>{{ $assetDeployment->location->company->companyName }} - {{ $assetDeployment->location->locationName }}</td>
                @else
                <td>-</td>
                @endif
              @endif
              <td>{{ $assetDeployment->assetDeploymentStatus }}</td>
              <td class="py-0 align-middle">
                  <div class="btn-group btn-group-sm">
                    <a href="/assetDeploymentAll/detail/{{ $assetDeployment->assetDeploymentId }}" class="btn btn-primary">Detail</a>
                  </div>
                {{-- @endif --}}
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