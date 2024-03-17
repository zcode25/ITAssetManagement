@extends('layouts/main')
@section('container')
@php
    use App\Models\AssetDeployment;
    use App\Models\AssetDeploymentDetail;
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
              <form action="/assetDeploymentReady/checkout/store/{{ $assetDeployment->assetDeploymentId }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="assetProcurementId" class="form-label">Procurement Number</label>
                    <p>{{ $assetDeployment->assetProcurement->assetProcurementNumber }}</p>
                  </div>
                  <div class="form-group">
                    <label for="assetDeployNumber" class="form-label">Deployment Number</label>
                    <p>{{ $assetDeployment->assetDeploymentNumber }}</p>
                  </div>
                  <div class="form-group">
                    <label for="assetDeploymentDate" class="form-label">Deployment Date</label>
                    <p>{{ $assetDeployment->assetDeploymentDate }}</p>
                  </div>
                  @if ($assetDeployment->assetLocation != null)
                  <div class="form-group">
                    <label for="locationId" class="form-label">Location</label>
                    <p>{{ $assetDeployment->location->company->companyName }} - {{ $assetDeployment->location->locationName }}</p>
                  </div>
                  @endif
                  <div class="form-group">
                    <label for="assetModelName" class="form-label">Device</label>
                    <p>{{ $assetDeployment->assetModel->assetModelName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="categoryId" class="form-label">Category</label>
                    <p>{{ $assetDeployment->assetModel->category->categoryName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="manufactureId" class="form-label">Manufacture</label>
                    <p>{{ $assetDeployment->assetModel->manufacture->manufactureName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="assetModelNumber" class="form-label">Model No</label>
                    <p>{{ $assetDeployment->assetModel->assetModelNumber }}</p>
                  </div>
                  @if ($assetDeployment->assetSerialNumber != null)
                  <div class="form-group">
                    <label for="assetSerialNumber" class="form-label">Serial Number</label>
                    <p>{{ $assetDeployment->assetSerialNumber }}</p>
                  </div>
                  @endif
                  @if ($assetDeployment->assetId != null)
                  <div class="form-group">
                    <label for="assetId" class="form-label">Checked Out To</label>
                    @php
                      $asset = assetDeployment::where('assetDeploymentId', $assetDeployment->assetId)->first();
                    @endphp
                    <p><i class="fa-solid fa-barcode mr-2"></i> {{ $asset->assetDeploymentNumber }}</p>
                  </div>
                  @endif
                  @if ($assetDeployment->userId != null)
                  <div class="form-group">
                    <label for="userId" class="form-label">Checked Out To</label>
                    <p><i class="fa-regular fa-user mr-2"></i> {{ $assetDeployment->user->employeeName }}</p>
                  </div>
                  @endif
                  @if ($assetDeployment->locationId != null)
                  <div class="form-group">
                    <label for="locationId" class="form-label">Location</label>
                    <p>{{ $assetDeployment->location->company->companyName }} - {{ $assetDeployment->location->locationName }}</p>
                  </div>
                  @endif
                  @if ($assetDeployment->assetProductKey != null)
                  <div class="form-group">
                    <label for="assetProductKey" class="form-label">Product Key</label>
                    <p>{{ $assetDeployment->assetProductKey }}</p>
                  </div>
                  @endif
                  @if ($assetDeployment->assetExpirationDate != null)
                  <div class="form-group">
                    <label for="assetExpirationDate" class="form-label">Expiration Date</label>
                    <p>{{ $assetDeployment->assetExpirationDate }}</p>
                  </div>
                  @elseIf($assetDeployment->assetModel->category->categoryType == 'License')
                  <div class="form-group">
                    <label for="assetExpirationDate" class="form-label">Expiration Date</label>
                    <p>Lifetime</p>
                  </div>
                  @endif
                  <div class="form-group">
                    <label for="assetDeploymentlImage" class="form-label">Image</label>
                    <div class="mb-3">
                      @if ($assetDeployment->assetDeploymentImage == null)
                        <img src="{{ asset('storage/' .  $assetDeployment->assetModel->assetModelImage ) }}" alt="{{ $assetDeployment->assetModel->assetModelName }}" class="img-responsive" style="max-height: 300px; width: auto;">
                      @else
                        <img src="{{ asset('storage/' .  $assetDeployment->assetDeploymentImage ) }}" alt="{{ $assetDeployment->assetDeploymentNumber }}" class="img-responsive" style="max-height: 300px; width: auto;">
                      @endif
                    </div>
                  </div>
                  @if ( $assetDeployment->assetDeploymentStatus != 'Pre Deployment' )
                  <hr>
                  <div class="form-group">
                    <label for="assetDeploymentQR" class="form-label">Asset Deployment QR </label>
                    <div class="mb-3">
                      <table class="table table-bordered">
                        <tr>
                          <td style="width:20%">
                            <img src="https://chart.googleapis.com/chart?chs=500x500&cht=qr&chl={{ $assetDeployment->assetDeploymentNumber }}" alt="{{ $assetDeployment->assetDeploymentNumber }}" class="img-responsive" style="max-height: 100px; width: auto;">
                          </td>
                          <td>
                            <p class="text-bold mb-1">{{ $assetDeployment->assetDeploymentNumber }}</p>
                            <p>{{ $assetDeployment->assetModel->assetModelName }}</p>
                            @if ($assetDeployment->assetSerialNumber != null)
                            <p>SN: {{ $assetDeployment->assetSerialNumber }}</p>
                            @endif
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  @endif
                </div>
                <!-- /.card-body -->
              </form>
            </div>
            <!-- /.card -->
        </div>
        <div class="col-xl-6">
          @if (count($items) > 0)
            <!-- Horizontal Form -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">License List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- form start -->
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th>Deployment Number</th>
                    <th>License</th>
                    <th>Product Key</th>
                    <th>Expiration Date</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($items as $item)
                  @if ($item->assetModel->category->categoryType == 'License')
                  <tr>
                    <td>{{ $item->assetDeploymentNumber }}</td>
                    <td>{{ $item->assetModel->assetModelName }}</td>
                    <td>{{ $item->assetProductKey }}</td>
                    @if ($item->assetExpirationDate == null)
                      <td>Lifetime</td>
                    @else
                      <td>{{ $item->assetExpirationDate }}</td>
                    @endif
                  </tr>
                  @endif
                  @endforeach
                </tbody>
              </table>
              </div>
            </div>
            <!-- /.card -->
          @endif
          @if (count($items) > 0)
            <!-- Horizontal Form -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Component List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- form start -->
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th>Deployment Number</th>
                    <th>Device</th>
                    <th>Serial Number</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($items as $item)
                  @if ($item->assetModel->category->categoryType == 'Component')
                  <tr>
                    <td>{{ $item->assetDeploymentNumber }}</td>
                    <td>{{ $item->assetModel->assetModelName }}</td>
                    @if ($item->assetSerialNumber == null)
                      <td>-</td>
                    @else
                      <td>{{ $item->assetSerialNumber }}</td>
                    @endif
                  </tr>
                  @endif
                  @endforeach
                </tbody>
              </table>
              </div>
            </div>
            <!-- /.card -->
          @endif
          @if (count($repairs) > 0)
            <!-- Horizontal Form -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Repair List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- form start -->
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Note</th>
                    <th>Repair</th>
                    <th>Cost</th>
                    <th>Completion</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($repairs as $repair)
                  <tr>
                    <td>{{ $repair->assetRepairDate }}</td>
                    <td>{{ $repair->assetRepairNote }}</td>
                    @if ($repair->supplierID != null)
                      <td>{{ $repair->supplierID }}</td>
                    @else
                      <td>Self-repair</td>      
                    @endif
                    <td>{{ "Rp " . number_format($repair->assetRepairCost, 0, ',', '.') }}</td>
                    <td>{{ $repair->assetRepairCompletionDate }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              </div>
            </div>
            <!-- /.card -->
          @endif

            <!-- Horizontal Form -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Deployment History</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
                  <div class="timeline">
                    @foreach($assetDeploymentDetails as $assetDeploymentDetail)
                    <!-- timeline item -->
                    <div>
                      @if ($loop->first)
                        <i class="fas fa-circle bg-success"></i> <!-- Untuk item pertama -->
                      @else
                        <i class="fas fa-circle bg-secondary"></i> <!-- Untuk item terakhir -->
                      @endif
                      <div class="timeline-item">
                        <span class="time">{{ $assetDeploymentDetail->assetDeploymentDetailDate }}</span>
                        <h3 class="timeline-header"><span class="text-bold">{{ $assetDeployment->assetDeploymentNumber }}</span> - {{ $assetDeploymentDetail->assetDeploymentDetailStatus }}</h3>
                        <div class="timeline-body">
                          <div class="row">
                            @if ($assetDeploymentDetail->locationId != null)
                              <div class="col-md-6">
                                <p class="text-bold mb-2">Location</p>
                                <p class="mb-2"><i class="fa-regular fa-building mr-2"></i> {{ $assetDeploymentDetail->location->company->companyName }}</p>
                                <p><i class="fa-solid fa-location-dot mr-2"></i> {{ $assetDeploymentDetail->location->locationName }}</p>
                              </div>
                            @endif
                            @if ($assetDeploymentDetail->userId != null)
                              <div class="col-md-6">
                                <p class="text-bold mb-2">User</p>
                                <p><i class="fa-regular fa-user mr-2"></i> {{ $assetDeploymentDetail->user->employeeName }}</p>
                              </div>
                            @endif
                            @if ($assetDeploymentDetail->assetId != null)
                              <div class="col-md-6">
                                <p class="text-bold mb-2">Asset</p>
                                @php
                                  $asset = assetDeployment::where('assetDeploymentId', $assetDeploymentDetail->assetId)->first();
                                @endphp
                                <p class="mb-2"><i class="fa-solid fa-barcode mr-2"></i> {{ $asset->assetDeploymentNumber }}</p>
                                <p><i class="fa-solid fa-computer mr-2"></i> {{ $asset->assetModel->assetModelName }}</p>
                              </div>
                            @endif
                            </div>
                            <div class="row">
                            @if($assetDeploymentDetail->assetDeploymentDetailNote)
                            <div class="col">
                              <p class="text-bold mb-2">Note</p>
                              <div class="timeline-body">{{ $assetDeploymentDetail->assetDeploymentDetailNote }}</div>
                            </div>
                            @endif
                          </div>
                          
                          
                        </div>
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