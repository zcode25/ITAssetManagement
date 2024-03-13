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
              <form action="/assetArchive/manage/store/{{ $assetDeployment->assetDeploymentId }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
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
                        <img src="{{ asset('storage/' .  $assetDeployment->assetDeploymentImage ) }}" alt="{{ $assetDeployment->assetDeploymentNumber }}" class="img-responsive" style="max-height: 300px; width: auto;">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="assetDeploymentQR" class="form-label">Asset Deployment QR</label>
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
                    <label for="assetRepairCostDate" class="form-label">Completion Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('assetRepairCompletionDate') is-invalid @enderror" id="assetRepairCompletionDate" name="assetRepairCompletionDate" value="{{ old('assetRepairCompletionDate') }}">
                    @error('assetRepairCompletionDate') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="selfRepairCheckbox">
                    <label class="form-check-label" for="selfRepairCheckbox">Self-repair</label>
                  </div>
                  <div class="form-group" id="supplierIdGroup">
                    <label for="supplierId" class="form-label">Supplier <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4" id="supplierId" name="supplierId" data-placeholder="Select a supplier">
                      <option value=""></option>
                      @foreach ($suppliers as $supplier)
                          @if (old('supplierId') == $supplier->supplierId)
                              <option value="{{ $supplier->supplierId }}" selected>{{ $supplier->supplierName }}</option>
                              @else
                              <option value="{{ $supplier->supplierId }}">{{ $supplier->supplierName }}</option>
                          @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="assetRepairCost" class="form-label">Cost  <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('assetRepairCost') is-invalid @enderror" id="assetRepairCost" name="assetRepairCost" value="{{ old('assetRepairCost') }}">
                    @error('assetRepairCost') 
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
        
      </div>
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script>
    document.addEventListener('DOMContentLoaded', function () {
        var selfRepairCheckbox = document.getElementById('selfRepairCheckbox');
        var supplierIdGroup = document.getElementById('supplierIdGroup');
    
        function toggleSupplierId() {
            // Check if the selfRepair checkbox is checked
            if (selfRepairCheckbox.checked) {
                supplierIdGroup.style.display = 'none'; // Hide
            } else {
                supplierIdGroup.style.display = 'block'; // Show
            }
        }
    
        // Listen for changes on the selfRepair checkbox
        selfRepairCheckbox.addEventListener('change', toggleSupplierId);
    
        // Initial check in case of pre-filled forms
        toggleSupplierId();
    });
  </script>

@endsection