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
            <h1>Deployment</h1>
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
                <h3 class="card-title">Form Deployment</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/assetDeploymentCheckout/checkin/store/{{ $assetDeployment->assetDeploymentId }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="assetDeployNumber" class="form-label">Deployment Number <span class="text-danger">*</span></label>
                    <p>{{ $assetDeployment->assetDeploymentNumber }}</p>
                  </div>
                  <div class="form-group">
                    <label for="assetDeploymentDate" class="form-label">Deployment Date <span class="text-danger">*</span></label>
                    <p>{{ $assetDeployment->assetDeploymentDate }}</p>
                  </div>
                  <div class="form-group">
                    <label for="locationId" class="form-label">Location <span class="text-danger">*</span></label>
                    <p>{{ $assetDeployment->location->company->companyName }} - {{ $assetDeployment->location->locationName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="assetModelName" class="form-label">Device <span class="text-danger">*</span></label>
                    <p>{{ $assetDeployment->assetModel->assetModelName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="categoryId" class="form-label">Category <span class="text-danger">*</span></label>
                    <p>{{ $assetDeployment->assetModel->category->categoryName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="manufactureId" class="form-label">Manufacture <span class="text-danger">*</span></label>
                    <p>{{ $assetDeployment->assetModel->manufacture->manufactureName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="assetModelNumber" class="form-label">Model No <span class="text-danger">*</span></label>
                    <p>{{ $assetDeployment->assetModel->assetModelNumber }}</p>
                  </div>
                  <div class="form-group">
                    <label for="assetSerialNumber" class="form-label">Serial Number <span class="text-danger">*</span></label>
                    <p>{{ $assetDeployment->assetSerialNumber }}</p>
                  </div>
                  <div class="form-group">
                    <label for="assetDeploymentlImage" class="form-label">Image <span class="text-danger">*</span></label>
                    <div class="mb-3">
                        <img src="{{ asset('storage/' .  $assetDeployment->assetDeploymentImage ) }}" alt="{{ $assetDeployment->assetDeploymentNumber }}" class="img-responsive" style="max-height: 300px; width: auto;">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="assetDeploymentQR" class="form-label">Asset Deployment QR <span class="text-danger">*</span></label>
                    <div class="mb-3">
                      <table class="table table-bordered">
                        <tr>
                          <td style="width:20%">
                            <img src="https://chart.googleapis.com/chart?chs=500x500&cht=qr&chl={{ $assetDeployment->assetDeploymentNumber }}" alt="{{ $assetDeployment->assetDeploymentNumber }}" class="img-responsive" style="max-height: 100px; width: auto;">
                          </td>
                          <td>
                            <p class="text-bold mb-1">{{ $assetDeployment->assetDeploymentNumber }}</p>
                            <p>{{ $assetDeployment->assetModel->assetModelName }}</p>
                            <p>SN: {{ $assetDeployment->assetSerialNumber }}</p>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="assetDeploymentDetailDate" class="form-label">Checkin Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('assetDeploymentDetailDate') is-invalid @enderror" id="assetDeploymentDetailDate" name="assetDeploymentDetailDate" value="{{ old('assetDeploymentDetailDate') }}">
                    @error('assetDeploymentDetailDate') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="assetDeploymentStatus" class="form-label">Status <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4" id="assetDeploymentStatus" name="assetDeploymentStatus" data-placeholder="Select a Type">
                      <option value=""></option>
                      @foreach ($types as $type)
                          @if (old('assetDeploymentStatus') == $type['type'])
                              <option value="{{ $type['type'] }}" selected>{{ $type['type'] }}</option>
                              @else
                              <option value="{{ $type['type'] }}">{{ $type['type'] }}</option>
                          @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="assetDeploymentDetailNote" class="form-label">Note <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('assetDeploymentDetailNote') is-invalid @enderror"s="3" id="assetDeploymentDetailNote" name="assetDeploymentDetailNote">{{ old('assetDeploymentDetailNote') }}</textarea>
                    @error('assetDeploymentDetailNote') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="/preDeployment" class="btn btn-default">Cancel</a>
                  <button type="submit" name="submit" class="btn btn-success float-right mr-2">Checkin</button>
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
                <h3 class="card-title">Form Procurement</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/assetProcurementApprovalITManager/approval/store/{{ $assetDeployment->assetDeploymentId }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                <div class="card-body">
                  {{-- <input type="hidden" id="userId" name="userId" value="{{ $user->userId }}"> --}}
                  <div class="form-group">
                    <label for="assetProcurementNumber" class="form-label">Procurement Number <span class="text-danger">*</span></label>
                    <p>{{ $assetDeployment->assetprocurement->assetProcurementNumber }}</p>
                  </div>
                  <div class="form-group">
                    <label for="employeeName" class="form-label">Name <span class="text-danger">*</span></label>
                    <p>{{ $assetDeployment->assetProcurement->user->employeeName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="locationId" class="form-label">Location <span class="text-danger">*</span></label>
                    <p>{{ $assetDeployment->assetProcurement->user->location->company->companyName }} - {{ $assetDeployment->assetProcurement->user->location->locationName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="departementId" class="form-label">Departement <span class="text-danger">*</span></label>
                    <p>{{ $assetDeployment->assetProcurement->user->departement->departementName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="positionId" class="form-label">Position <span class="text-danger">*</span></label>
                    <p>{{ $assetDeployment->assetProcurement->user->position->positionName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="managerId" class="form-label">Manager <span class="text-danger">*</span></label>
                    @if ($assetDeployment->assetProcurement->user->managerId)
                      @php
                        $manager = User::where('userId', $assetDeployment->assetProcurement->managerId)->first()
                      @endphp
                      <p>{{ $manager->employeeName }}</p>
                    @else
                      <p></p>                  
                    @endif
                  </div>
                </div>
                <!-- /.card-body -->
                
              </form>
            </div>
            <!-- /.card -->
        </div>
      </div>
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection