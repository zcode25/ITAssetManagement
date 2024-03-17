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
              <form action="/assetDisposal/disposal/store/{{ $assetDisposal->assetDisposalId }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
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
                  <div class="form-group">
                    <label for="assetDisposalDisposedDate" class="form-label">Disposed Date</label>
                    <p>{{ $assetDisposal->assetDisposalDisposedDate }}</p>
                  </div>
                  <div class="form-group">
                    <label for="assetDisposalType" class="form-label">Disposal Type</label>
                    <p>{{ $assetDisposal->assetDisposalType }}</p>
                  </div>
                  @if ($assetDisposal->supplierId != null)
                  <div class="form-group">
                    <label for="supplierId" class="form-label">Supplier</label>
                    <p>{{ $assetDisposal->supplier->supplierName }}</p>
                  </div>
                  @endif
                  @if ($assetDisposal->assetDisposalAmount != null)
                  <div class="form-group">
                    <label for="assetDisposalAmount" class="form-label">Disposal Amount</label>
                    <p>{{ $assetDisposal->assetDisposalAmount }}</p>
                  </div>
                  @endif
                </div>
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
                @if (count($assetDisposalDevices) > 0)
                <table class="table table-sm">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Deployment Number</th>
                    <th>Device</th>
                    <th>SN</th>
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
                    </tr>
                    @endforeach
                </tbody>
                </table>
                @else
                <p class="text-center">No data available in table</p>
                @endif
            </div>
            <!-- /.card-body -->
        </div>
        </div>
      </div>
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@endsection