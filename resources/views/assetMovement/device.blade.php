@extends('layouts/main')
@section('container')
@php
    use App\Models\User;
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
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xl-6">
            <!-- Horizontal Form -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Form Asset Movement</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {{-- <form action="/assetMovement/movement/store/{{ $assetProcurement->assetProcurementId }}" method="POST" enctype="multipart/form-data" class="form-horizontal"> --}}
                @csrf
                <div class="card-body">
                  {{-- <input type="hidden" id="userId" name="userId" value="{{ $user->userId }}"> --}}
                  <div class="form-group">
                    <label for="assetProcurementNumber" class="form-label">Procurement Number</label>
                    <p>{{ $assetProcurement->assetProcurementNumber }}</p>
                  </div>
                  <div class="form-group">
                    <label for="assetProcurementDate" class="form-label">Procurement Date</label>
                    <p>{{ $assetProcurement->assetProcurementDate }}</p>
                  </div>
                  <div class="form-group">
                    <label for="employeeName" class="form-label">Name</label>
                    <p>{{ $assetProcurement->user->employeeName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="locationId" class="form-label">Location</label>
                    <p>{{ $assetProcurement->location->company->companyName }} - {{ $assetProcurement->location->locationName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="departementId" class="form-label">Departement</label>
                    <p>{{ $assetProcurement->user->departement->departementName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="positionId" class="form-label">Position</label>
                    <p>{{ $assetProcurement->user->position->positionName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="managerId" class="form-label">Manager</label>
                    <p>{{ $assetProcurement->manager->employeeName }}</p>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="assetMovementNumber" class="form-label">Movement Number</label>
                    <p>{{ $assetMovement->assetMovementNumber }}</p>
                  </div>
                  <div class="form-group">
                    <label for="assetMovementDate" class="form-label">Movement Date</label>
                    <p>{{ $assetMovement->assetMovementDate }}</p>
                  </div>
                  <div class="form-group">
                    <label for="locationId" class="form-label">Location</label>
                    <p>{{ $assetMovement->location->company->companyName }} - {{ $assetMovement->location->locationName }}</p>
                  </div>
                </div>
              {{-- </form> --}}
            </div>
            <!-- /.card -->
        </div>
        <div class="col-xl-6">
          <!-- Horizontal Form -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Form Asset Device</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <!-- form start -->
            @if (count($assetProcurementDevices) > 0)
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Device</th>
                  <th>Device Image</th>
                  <th>Quantity</th>
                </tr>
              </thead>
              <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($assetProcurementDevices as $assetProcurementDevice)
                <tr>
                  <td>{{ $i++ }}</td>
                  <td>{{ $assetProcurementDevice->assetModel->assetModelName }}</td>
                  <td><img src="{{ asset('storage/' .  $assetProcurementDevice->assetModel->assetModelImage ) }}" alt="{{ $assetProcurementDevice->assetModel->assetModelName }}" class="img-responsive" style="max-height: 30px; width: auto;"></td>
                  <td>{{ $assetProcurementDevice->assetProcurementDeviceQuantity }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @else
              <p class="text-center">No data available in table</p>
            @endif
            </div>
          </div>
          <!-- /.card -->
          <!-- Horizontal Form -->
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Form Asset Device</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/assetMovement/device/store/{{ $assetProcurement->assetProcurementId }}" method="POST" class="form-horizontal">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="assetDeploymentId" class="form-label">Asset Deployment Ready <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4" id="assetDeploymentId" name="assetDeploymentId" data-placeholder="Select a Asset Deployment">
                        <option value=""></option>
                        @foreach ($assetDeployments as $assetDeployment)
                            @if (old('assetDeploymentId') == $assetDeployment->assetDeploymentId)
                                <option value="{{ $assetDeployment->assetDeploymentId }}" selected>({{ $assetDeployment->assetDeploymentNumber }}) - {{ $assetDeployment->assetModel->assetModelName }}</option>
                                @else
                                <option value="{{ $assetDeployment->assetDeploymentId }}">({{ $assetDeployment->assetDeploymentNumber }}) - {{ $assetDeployment->assetModel->assetModelName }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Add</button>
                </div>
                <hr>
                {{-- @php
                    dd(count($assetProcurementDevices))
                @endphp --}}
                @if (count($assetMovementDevices) > 0)
                <table class="table table-sm">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Deployment Number</th>
                    <th>Device</th>
                    <th>SN</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($assetMovementDevices as $assetMovementDevice)
                    <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $assetMovementDevice->assetDeployment->assetDeploymentNumber }}</td>
                    <td>{{ $assetMovementDevice->assetDeployment->assetModel->assetModelName }}</td>
                    <td>{{ $assetMovementDevice->assetDeployment->assetSerialNumber }}</td>
                    <td>
                        <a href="/assetMovement/device/destroy/{{ $assetMovementDevice->assetMovementDeviceId }}" class="btn btn-outline-danger btn-sm" data-confirm-delete="true">Delete</a>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
                @else
                <p class="text-center">No data available in table</p>
                @endif
                
            </div>
            </form>
            <!-- /.card-body -->
            <div class="card-footer">
              <a href="/assetMovement/device/save/{{ $assetMovement->assetMovementId }}" class="btn btn-success float-right">Save</a>
            </div>
            <!-- /.card-footer -->
        </div>
        </div>
      </div>
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection