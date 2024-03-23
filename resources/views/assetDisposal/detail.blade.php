@extends('layouts/main')
@section('container')
@php
    use App\Models\User;
    use App\Models\AssetProcurementDevice;
    use App\Models\Depreciation;
    $totalNilaiBuku = 0;
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
                  @if ($assetDisposal->assetDisposalDisposedDate != null)
                  <div class="form-group">
                    <label for="assetDisposalDisposedDate" class="form-label">Disposed Date</label>
                    <p>{{ $assetDisposal->assetDisposalDisposedDate }}</p>
                  </div>
                  @endif
                  @if ($assetDisposal->assetDisposalType != null)
                  <div class="form-group">
                    <label for="assetDisposalType" class="form-label">Disposal Type</label>
                    <p>{{ $assetDisposal->assetDisposalType }}</p>
                  </div>
                  @endif
                  @if ($assetDisposal->supplierId != null)
                  <div class="form-group">
                    <label for="supplierId" class="form-label">Supplier</label>
                    <p>{{ $assetDisposal->supplier->supplierName }}</p>
                  </div>
                  @endif
                  @if ($assetDisposal->assetDisposalAmount != null)
                  <div class="form-group">
                    <label for="assetDisposalAmount" class="form-label">Disposal Amount</label>
                    <p>{{ "Rp " . number_format($assetDisposal->assetDisposalAmount, 0, ',', '.') }}</p>
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
                    <th>Current Value</th>
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
                      @php
                        $cost = AssetProcurementDevice::where('assetProcurementId', $assetDisposalDevice->assetDeployment->assetProcurementId)
                                          ->where('assetModelId', $assetDisposalDevice->assetDeployment->assetModelId)
                                          ->first();

                        if ($cost) {
                            $costAmount = $cost->assetProcurementDevicePrice; // Nilai biaya aset
                            $deploymentDate = new DateTime($assetDisposalDevice->assetDeployment->assetDeploymentDate);
                            $costYear = $deploymentDate->format('Y'); // Tahun penyebaran
                        } else {
                            $costAmount = 0;
                            $costYear = date("Y");
                        }

                        $test = Depreciation::where('categoryId', $assetDisposalDevice->assetDeployment->assetModel->categoryId)->first();

                        if ($test) {
                            $useful = $test->depreciationUseful;
                            $residual = $test->depreciationResidual;
                            $biaya_penyusutan = ($costAmount - $residual) / $useful;
                          } else {
                            $useful = 0; // Pastikan ini diatur ke nilai non-nol jika tidak ada data
                            $residual = 0;
                            $biaya_penyusutan = 0;
                        }

                        // Tambahkan pengecekan untuk menghindari division by zero
                        if ($useful <= 0) {
                          $nilaiBukuSaatIni = $cost->assetProcurementDevicePrice;
                        } else {
                            $tahunSaatIni = date("Y");
                            $lamaPenyusutan = $tahunSaatIni - $costYear;
                            
                            if ($lamaPenyusutan > $useful) {
                                $lamaPenyusutan = $useful;
                            }

                            $totalDepresiasi = (($costAmount - $residual) / $useful) * $lamaPenyusutan; // Depresiasi total hingga tahun saat ini.
                            $nilaiBukuSaatIni = $costAmount - $totalDepresiasi; // Nilai buku berdasarkan depresiasi yang terakumulasi.

                        }

                        $totalNilaiBuku += $nilaiBukuSaatIni; 

                      @endphp
                      <td>{{ "Rp " . number_format($nilaiBukuSaatIni, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                    <tr>
                      <td colspan="4" style="text-align: center;"><strong>Total</strong></td>
                      <td><strong>{{ "Rp " . number_format($totalNilaiBuku, 0, ',', '.') }}</strong></td>
                    </tr>
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