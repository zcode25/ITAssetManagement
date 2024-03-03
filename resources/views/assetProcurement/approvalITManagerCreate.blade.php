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
            <h1>Asset Procurement</h1>
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
                <h3 class="card-title">Form Procurement</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/assetProcurementApprovalITManager/approval/store/{{ $assetProcurement->assetProcurementId }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
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
                        $manager = User::where('userId', $assetProcurement->managerId)->first()
                      @endphp
                      <p>{{ $manager->employeeName }}</p>
                    @else
                      <p></p>                  
                    @endif
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="assetProcurementDate" class="form-label">Procurement Date <span class="text-danger">*</span></label>
                    <p>{{ $assetProcurement->assetProcurementDate }}</p>
                  </div>
                  <div class="form-group">
                    <label for="assetProcurementNote" class="form-label">Procurement Note <span class="text-danger">*</span></label>
                    <p>{{ $assetProcurement->assetProcurementNote }}</p>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="assetProcurementType" class="form-label">Procurement Type <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4" id="assetProcurementType" name="assetProcurementType" data-placeholder="Select a Procurement Type">
                      <option value=""></option>
                      @foreach ($types as $type)
                          @if (old('assetProcurementType') == $type['type'])
                              <option value="{{ $type['type'] }}" selected>{{ $type['type'] }}</option>
                              @else
                              <option value="{{ $type['type'] }}">{{ $type['type'] }}</option>
                          @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="assetProcurementDetailNote" class="form-label">Note <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('assetProcurementDetailNote') is-invalid @enderror"s="3" id="assetProcurementDetailNote" name="assetProcurementDetailNote">{{ old('assetProcurementDetailNote') }}</textarea>
                    @error('assetProcurementDetailNote') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="/assetProcurement" class="btn btn-default">Cancel</a>
                  <button type="submit" name="assetProcurementStatus" value="Approved by IT Manager" class="btn btn-success float-right">Approve</button>
                  <button type="submit" name="assetProcurementStatus" value="Rejected by IT Manager" class="btn btn-danger float-right mr-2">Reject</button>
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