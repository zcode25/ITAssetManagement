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
              <form action="/assetMovement/movement/store/{{ $assetProcurement->assetProcurementId }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                <div class="card-body">
                  {{-- <input type="hidden" id="userId" name="userId" value="{{ $user->userId }}"> --}}
                  <div class="form-group">
                    <label for="assetProcurementNumber" class="form-label">Procurement Number <span class="text-danger">*</span></label>
                    <p>{{ $assetProcurement->assetProcurementNumber }}</p>
                  </div>
                  <div class="form-group">
                    <label for="employeeName" class="form-label">Name <span class="text-danger">*</span></label>
                    <p>{{ $assetProcurement->user->employeeName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="locationId" class="form-label">Location <span class="text-danger">*</span></label>
                    <p>{{ $assetProcurement->user->location->company->companyName }} - {{ $assetProcurement->user->location->locationName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="departementId" class="form-label">Departement <span class="text-danger">*</span></label>
                    <p>{{ $assetProcurement->user->departement->departementName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="positionId" class="form-label">Position <span class="text-danger">*</span></label>
                    <p>{{ $assetProcurement->user->position->positionName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="managerId" class="form-label">Manager <span class="text-danger">*</span></label>
                    @if ($assetProcurement->user->managerId)
                      @php
                        $manager = User::where('userId', $assetProcurement->user->managerId)->first()
                      @endphp
                      <p>{{ $manager->employeeName }}</p>
                    @else
                      <p></p>                  
                    @endif
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="assetMovementDate" class="form-label">Movement Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('assetMovementDate') is-invalid @enderror" id="assetMovementDate" name="assetMovementDate" value="{{ old('assetMovementDate') }}">
                    @error('assetMovementDate') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="locationId" class="form-label">Location <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4" id="locationId" name="locationId">
                      @foreach ($locations as $location)
                          @if (old('locationId') == $location->locationId)
                              <option value="{{ $location->locationId }}" selected>{{ $location->company->companyName }} - {{ $location->locationName }}</option>
                              @else
                              <option value="{{ $location->locationId }}">{{ $location->company->companyName }} - {{ $location->locationName }}</option>
                          @endif
                      @endforeach
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="/assetPurchase" class="btn btn-default">Cancel</a>
                  <button type="submit" name="submit" class="btn btn-primary float-right">Save</button>
                </div>
                <!-- /.card-footer -->
              </form>
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
        </div>
      </div>
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection