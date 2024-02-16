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
            <h1>Create Asset Purchase</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xl-8">
            <!-- Horizontal Form -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Form Asset Purchase</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/assetPurchase/deployment/store/{{ $assetProcurement->assetProcurementId }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                <div class="card-body">
                  {{-- <input type="hidden" id="userId" name="userId" value="{{ $user->userId }}"> --}}
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
                    <label for="assetPurchaseDate" class="form-label">Purchase Date <span class="text-danger">*</span></label>
                    <p>{{ $assetPurchase->assetPurchaseDate }}</p>
                  </div>
                  <div class="form-group">
                    <label for="assetPurchaseNumber" class="form-label">Purchase Number <span class="text-danger">*</span></label>
                    <p>{{ $assetPurchase->assetPurchaseNumber }}</p>
                  </div>
                  <div class="form-group">
                    <label for="supplierId" class="form-label">Supplier <span class="text-danger">*</span></label>
                    <p>{{ $assetPurchase->supplier->supplierName }}</p>
                  </div>
                  <hr>
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Form Create Procurement</h3>
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
                          <th>Image</th>
                          <th>Quantity</th>
                          <th>Price / Unit</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($assetProcurementDevices as $assetProcurementDevice)
                        <tr>
                          <td>{{ $i }}</td>
                          <td>{{ $assetProcurementDevice->assetModel->assetModelName }}</td>
                          <td><img src="{{ asset('storage/' .  $assetProcurementDevice->assetModel->assetModelImage ) }}" alt="{{ $assetProcurementDevice->assetModel->assetModelName }}" class="img-responsive" style="max-height: 30px; width: auto;"></td>
                          <td>{{ $assetProcurementDevice->assetProcurementDeviceQuantity }}</td>
                          <td>{{ $assetProcurementDevice->assetProcurementDevicePrice }}</td>
                          <td>{{ $assetProcurementDevice->assetProcurementDeviceTotal }}</td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                        @endforeach
                      </tbody>
                    </table>
                    @else
                      <p class="text-center">No data available in table</p>
                    @endif
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="/assetPurchase" class="btn btn-default">Cancel</a>
                  <button type="submit" name="assetProcurementStatus" value="Asset Deployment" class="btn btn-success float-right">Asset Deployment</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->
        </div>
        {{-- <div class="col-xl-6">
          <!-- Horizontal Form -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Form Create Procurement</h3>
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
        </div> --}}
      </div>
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection