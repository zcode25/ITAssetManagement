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
              <form action="/assetDeploymentPre/manage/store/{{ $assetDeployment->assetDeploymentId }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
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
                    <label for="assetModelImage" class="form-label">Image <span class="text-danger">*</span></label>
                    <div class="mb-3">
                        <img src="{{ asset('storage/' .  $assetDeployment->assetModel->assetModelImage ) }}" alt="{{ $assetDeployment->assetModel->assetModelName }}" class="img-responsive" style="max-height: 300px; width: auto;">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="assetDeploymentImage" class="form-label">Deployment Image <span class="text-danger">*</span></label>
                    <input type="file" class="form-control @error('assetDeploymentImage') is-invalid @enderror" id="assetDeploymentImage" name="assetDeploymentImage" value="{{ old('assetDeploymentImage') }}">
                    @error('assetDeploymentImage') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="assetSerialNumber" class="form-label">Serial Number <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('assetSerialNumber') is-invalid @enderror" id="assetSerialNumber" name="assetSerialNumber" value="{{ old('assetSerialNumber') }}">
                    @error('assetSerialNumber') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="/preDeployment" class="btn btn-default">Cancel</a>
                  <button type="submit" name="assetDeploymentStatus" value="Deployment Ready" class="btn btn-success float-right mr-2">Ready to Deploy</button>
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