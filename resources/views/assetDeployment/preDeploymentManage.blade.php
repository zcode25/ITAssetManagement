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
                    <label for="assetModelImage" class="form-label">Image</label>
                    <div class="mb-3">
                        <img src="{{ asset('storage/' .  $assetDeployment->assetModel->assetModelImage ) }}" alt="{{ $assetDeployment->assetModel->assetModelName }}" class="img-responsive" style="max-height: 300px; width: auto;">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="assetDeploymentDetailDate" class="form-label">Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('assetDeploymentDetailDate') is-invalid @enderror" id="assetDeploymentDetailDate" name="assetDeploymentDetailDate" value="{{ old('assetDeploymentDetailDate') }}">
                    @error('assetDeploymentDetailDate') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="assetDeploymentImage" class="form-label">Deployment Image <span class="text-danger">*</span></label>
                    <input type="file" class="form-control @error('assetDeploymentImage') is-invalid @enderror" id="assetDeploymentImage" name="assetDeploymentImage" value="{{ old('assetDeploymentImage') }}">
                    @error('assetDeploymentImage') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  @if ($assetDeployment->assetModel->category->categoryType == 'License')
                  <div class="form-group">
                    <label for="assetProductKey" class="form-label">Product Key</label>
                    <input type="text" class="form-control @error('assetProductKey') is-invalid @enderror" id="assetProductKey" name="assetProductKey" value="{{ old('assetProductKey') }}">
                    @error('assetProductKey') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="lifetimeCheckbox">
                    <label class="form-check-label" for="lifetimeCheckbox">Lifetime</label>
                  </div>
                  <div class="form-group" id="expirationDateGroup">
                    <label for="assetExpirationDate" class="form-label">Expiration Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('assetExpirationDate') is-invalid @enderror" id="assetExpirationDate" name="assetExpirationDate" value="{{ old('assetExpirationDate') }}">
                    @error('assetExpirationDate') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  @else
                  <div class="form-group">
                    <label for="assetSerialNumber" class="form-label">Serial Number</label>
                    <input type="text" class="form-control @error('assetSerialNumber') is-invalid @enderror" id="assetSerialNumber" name="assetSerialNumber" value="{{ old('assetSerialNumber') }}">
                    @error('assetSerialNumber') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  @endif
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
        
      </div>
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script>
    document.addEventListener('DOMContentLoaded', function () {
        var lifetimeCheckbox = document.getElementById('lifetimeCheckbox');
        var expirationDateGroup = document.getElementById('expirationDateGroup');
    
        function toggleExpirationDate() {
            // Check if the lifetime checkbox is checked
            if (lifetimeCheckbox.checked) {
                expirationDateGroup.style.display = 'none'; // Hide
            } else {
                expirationDateGroup.style.display = 'block'; // Show
            }
        }
    
        // Listen for changes on the lifetime checkbox
        lifetimeCheckbox.addEventListener('change', toggleExpirationDate);
    
        // Initial check in case of pre-filled forms
        toggleExpirationDate();
    });
  </script>

@endsection