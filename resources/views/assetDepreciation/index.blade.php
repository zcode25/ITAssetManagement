@extends('layouts/main')
@section('container')
@php
use App\Models\AssetDeployment;
use App\Models\AssetProcurementDevice;
use App\Models\Depreciation;
$jsonData = auth()->user()->permission;
$menuData = json_decode($jsonData, true);
@endphp

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Asset Deployment</h1>
          </div>
          <div class="col-sm-6">
            <div class="float-sm-right">
              {{-- @if($menuData['assetModelCreate']['index']) --}}
              {{-- <a href="/assetProcurement/create" class="btn btn-primary">Create New</a> --}}
              {{-- @endif --}}
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Asset Deployment List</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">

          <table id="example2" class="table table-hover">
            <thead>
            <tr>
              <th>Deployment Number</th>
              <th>Date</th>
              <th>Image</th>
              <th>Device</th>
              <th>Category</th>
              <th>Type</th>
              <th>Checked Out To</th>
              <th>Location</th>
              <th>Status</th>
              <th>Purchase Cost</th>
              <th>Yearly Depreciation</th>
              <th>Current Value</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($assetDeployments as $assetDeployment)
            <tr>
              <td>{{ $assetDeployment->assetDeploymentNumber }}</td>
              <td>{{ $assetDeployment->assetDeploymentDate }}</td>
              <td><img src="{{ asset('storage/' .  $assetDeployment->assetModel->assetModelImage ) }}" alt="{{ $assetDeployment->assetModel->assetModelName }}" class="img-responsive" style="max-height: 30px; width: auto;"></td>
              <td>{{ $assetDeployment->assetModel->assetModelName }}</td>
              <td>{{ $assetDeployment->assetModel->category->categoryName }}</td>
              <td>{{ $assetDeployment->assetModel->category->categoryType }}</td>
              @if($assetDeployment->assetId != null)
                @php
                  $asset = assetDeployment::where('assetDeploymentId', $assetDeployment->assetId)->first();
                @endphp
                <td><i class="fa-solid fa-barcode mr-2"></i> {{ $asset->assetDeploymentNumber }}</td>
                <td>-</td>
              @else
                @if ($assetDeployment->userId != null)
                <td><i class="fa-regular fa-user mr-2"></i> {{ $assetDeployment->user->employeeName }}</td>
                @else
                <td>-</td>
                @endif
                @if ($assetDeployment->locationId != null)
                <td>{{ $assetDeployment->location->company->companyName }} - {{ $assetDeployment->location->locationName }}</td>
                @else
                <td>-</td>
                @endif
              @endif
              <td>{{ $assetDeployment->assetDeploymentStatus }}</td>
              @php
                $cost = AssetProcurementDevice::where('assetProcurementId', $assetDeployment->assetProcurementId)
                                  ->where('assetModelId', $assetDeployment->assetModelId)
                                  ->first();

                if ($cost) {
                    $costAmount = $cost->assetProcurementDevicePrice; // Nilai biaya aset
                    $deploymentDate = new DateTime($assetDeployment->assetDeploymentDate);
                    $costYear = $deploymentDate->format('Y'); // Tahun penyebaran
                } else {
                    $costAmount = 0;
                    $costYear = date("Y");
                }

                $test = Depreciation::where('categoryId', $assetDeployment->assetModel->categoryId)->first();

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

                    // echo "Nilai buku aset untuk tahun $tahunSaatIni adalah $nilaiBukuSaatIni";
                }
              @endphp
              <td>{{ "Rp " . number_format($cost->assetProcurementDevicePrice, 0, ',', '.') }}</td>
              <td>{{ "Rp " . number_format($biaya_penyusutan, 0, ',', '.') }}</td>
              <td>{{ "Rp " . number_format($nilaiBukuSaatIni, 0, ',', '.') }}</td>
              {{-- @endif --}}
            </tr>    
            @endforeach
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection