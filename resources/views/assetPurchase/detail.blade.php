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
                  <div class="form-group">
                    <label for="assetProcurementNote" class="form-label">Procurement Note</label>
                    <p>{{ $assetProcurement->assetProcurementNote }}</p>
                  </div>
                  @if ($assetPurchase->assetPurchaseNumber != null)
                  <div class="form-group">
                    <label for="assetPurchaseNumber" class="form-label">Purchase Number</label>
                    <p>{{ $assetPurchase->assetPurchaseNumber }}</p>
                  </div>
                  @endif
                  @if ($assetPurchase->assetPurchaseDate != null)
                  <div class="form-group">
                    <label for="assetPurchaseDate" class="form-label">Purchase Date</label>
                    <p>{{ $assetPurchase->assetPurchaseDate }}</p>
                  </div>
                  @endif
                </div>
                <!-- /.card-body -->
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

          <!-- Horizontal Form -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Procurement History</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="timeline">
                @foreach($assetProcurementDetails as $assetProcurementDetail)
                <!-- timeline item -->
                <div>
                  @if ($loop->first)
                    <i class="fas fa-circle bg-success"></i> <!-- Untuk item pertama -->
                  @else
                    <i class="fas fa-circle bg-secondary"></i> <!-- Untuk item terakhir -->
                  @endif
                  <div class="timeline-item">
                    <span class="time">{{ $assetProcurementDetail->assetProcurementDetailDate }}</span>
                    <h3 class="timeline-header"><span class="text-bold">{{ $assetProcurement->assetProcurementNumber }}</span> - {{ $assetProcurementDetail->assetProcurementDetailStatus }}</h3>
                    @if($assetProcurementDetail->assetProcurementDetailNote)
                      <div class="timeline-body">{{ $assetProcurementDetail->assetProcurementDetailNote }}</div>
                    @endif
                  </div>
                </div>
                <!-- END timeline item -->
                @endforeach
                <div>
                  <i class="fas fa-circle bg-secondary"></i>
                </div>
              </div>
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