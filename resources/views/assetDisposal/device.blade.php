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
            <h1>Asset Disposal</h1>
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
                <h3 class="card-title">Form Asset Disposal</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {{-- <form action="/assetMovement/movement/store/{{ $assetProcurement->assetProcurementId }}" method="POST" enctype="multipart/form-data" class="form-horizontal"> --}}
                @csrf
                <div class="card-body">
                  {{-- <input type="hidden" id="userId" name="userId" value="{{ $user->userId }}"> --}}
                  <div class="form-group">
                    <label for="assetDisposalNumber" class="form-label">Disposal Number</label>
                    <p>{{ $assetDisposal->assetDisposalNumber }}</p>
                  </div>
                  <div class="form-group">
                    <label for="assetDisposalDate" class="form-label">Disposal Date</label>
                    <p>{{ $assetDisposal->assetDisposalDate }}</p>
                  </div>
                  <div class="form-group">
                    <label for="employeeName" class="form-label">Name</label>
                    <p>{{ $assetDisposal->user->employeeName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="locationId" class="form-label">Location</label>
                    <p>{{ $assetDisposal->location->company->companyName }} - {{ $assetDisposal->location->locationName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="departementId" class="form-label">Departement</label>
                    <p>{{ $assetDisposal->user->departement->departementName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="positionId" class="form-label">Position</label>
                    <p>{{ $assetDisposal->user->position->positionName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="managerId" class="form-label">Manager</label>
                    <p>{{ $assetDisposal->manager->employeeName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="locationId" class="form-label">Disposal Location</label>
                    <p>{{ $assetDisposal->location->company->companyName }} - {{ $assetDisposal->location->locationName }}</p>
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
            <!-- form start -->
            <form action="/assetDisposal/device/store/{{ $assetDisposal->assetDisposalId }}" method="POST" class="form-horizontal">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="assetDeploymentId" class="form-label">Asset Deployment <span class="text-danger">*</span></label>
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
                @if (count($assetDisposalDevices) > 0)
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
                    @foreach ($assetDisposalDevices as $assetDisposalDevice)
                    <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $assetDisposalDevice->assetDeployment->assetDeploymentNumber }}</td>
                    <td>{{ $assetDisposalDevice->assetDeployment->assetModel->assetModelName }}</td>
                    <td>{{ $assetDisposalDevice->assetDeployment->assetSerialNumber }}</td>
                    <td>
                        <a href="/assetDisposal/device/destroy/{{ $assetDisposalDevice->assetDisposalDeviceId }}" class="btn btn-outline-danger btn-sm" data-confirm-delete="true">Delete</a>
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
              <a href="/assetDisposal" class="btn btn-default">Cancel</a>
              <a href="/assetDisposal/device/save/{{ $assetDisposal->assetDisposalId }}" class="btn btn-success float-right">Save</a>
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