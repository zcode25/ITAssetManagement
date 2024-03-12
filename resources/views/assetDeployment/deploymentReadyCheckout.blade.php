@extends('layouts/main')
@section('container')
@php
    use App\Models\AssetDeployment;
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
                      $asset = AssetDeployment::where('assetDeploymentId', $assetDeployment->assetId)->first();
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
                            @if ($assetDeployment->assetSerialNumber != null)
                            <p>SN: {{ $assetDeployment->assetSerialNumber }}</p>
                            @endif
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="assetDeploymentDetailDate" class="form-label">Checkout Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('assetDeploymentDetailDate') is-invalid @enderror" id="assetDeploymentDetailDate" name="assetDeploymentDetailDate" value="{{ old('assetDeploymentDetailDate') }}">
                    @error('assetDeploymentDetailDate') 
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  @if ($assetDeployment->assetModel->category->categoryType == 'License' || $assetDeployment->assetModel->category->categoryType == 'Component')
                  <div class="form-group">
                    <label for="" class="form-label">Checkout to <span class="text-danger">*</span></label>
                    <div>
                      <div class="btn-group" role="group" aria-label="Input Selection">
                        <button type="button" id="btnUserId" class="btn btn-primary btn-sm" onclick="showInput('user')">User ID</button>
                        <button type="button" id="btnAssetId" class="btn btn-outline-primary btn-sm" onclick="showInput('asset')">Asset ID</button>
                      </div>
                    </div>
                  </div>
                  <div class="form-group" id="assetInput" style="display: none;">
                    <label for="assetId" class="form-label">Asset <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4" id="assetId" name="assetId" data-placeholder="Select a Asset" required>
                      <option value=""></option>
                      @foreach ($assetDeployments as $assetDeployment)
                        @if ($assetDeployment->assetModel->category->categoryType == 'Asset')
                          @if (old('assetDeploymentId') == $assetDeployment->assetDeploymentId)
                              <option value="{{ $assetDeployment->assetDeploymentId }}" selected>({{ $assetDeployment->assetDeploymentNumber }}) - {{ $assetDeployment->assetModel->assetModelName }}</option>
                              @else
                              <option value="{{ $assetDeployment->assetDeploymentId }}">({{ $assetDeployment->assetDeploymentNumber }}) - {{ $assetDeployment->assetModel->assetModelName }}</option>
                          @endif
                        @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group" id="userInput">
                    <label for="userId" class="form-label">User <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4" id="userId" name="userId" data-placeholder="Select a User" required>
                      <option value=""></option>
                      @foreach ($users as $user)
                          @if (old('userId') == $user->userId)
                              <option value="{{ $user->userId }}" selected>{{ $user->employeeName }} - {{ $user->departement->departementName }}</option>
                              @else
                              <option value="{{ $user->userId }}">{{ $user->employeeName }} - {{ $user->departement->departementName }}</option>
                          @endif
                      @endforeach
                    </select>
                  </div>
                  @else
                  <div class="form-group">
                    <label for="userId" class="form-label">User <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4" id="userId" name="userId" data-placeholder="Select a User">
                      <option value=""></option>
                      @foreach ($users as $user)
                          @if (old('userId') == $user->userId)
                              <option value="{{ $user->userId }}" selected>{{ $user->employeeName }} - {{ $user->departement->departementName }}</option>
                              @else
                              <option value="{{ $user->userId }}">{{ $user->employeeName }} - {{ $user->departement->departementName }}</option>
                          @endif
                      @endforeach
                    </select>
                  </div>
                  @endif
                  
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
                  <button type="submit" name="assetDeploymentStatus" value="Checkout" class="btn btn-success float-right mr-2">Checkout</button>
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
    function showInput(inputType) {
      // Mendapatkan referensi ke input
      var userInput = document.getElementById('userInput');
      var assetInput = document.getElementById('assetInput');
      var userIdInput = document.getElementById('userId');
      var assetIdInput = document.getElementById('assetId');
    
      // Sembunyikan kedua input dan nonaktifkan
      userInput.style.display = 'none';
      assetInput.style.display = 'none';
      userIdInput.disabled = true; // Menonaktifkan input
      assetIdInput.disabled = true; // Menonaktifkan input
    
      // Set kembali kelas untuk kedua tombol ke default (inactive)
      var btnUserId = document.getElementById('btnUserId');
      var btnAssetId = document.getElementById('btnAssetId');
      btnUserId.classList.remove('btn-primary');
      btnUserId.classList.add('btn-outline-primary');
      btnAssetId.classList.remove('btn-primary');
      btnAssetId.classList.add('btn-outline-primary');
    
      // Tampilkan input yang sesuai, aktifkan, dan ubah kelas tombolnya
      if (inputType === 'user') {
        userInput.style.display = 'block';
        userIdInput.disabled = false; // Mengaktifkan input
        btnUserId.classList.add('btn-primary');
        btnUserId.classList.remove('btn-outline-primary');
      } else if (inputType === 'asset') {
        assetInput.style.display = 'block';
        assetIdInput.disabled = false; // Mengaktifkan input
        btnAssetId.classList.add('btn-primary');
        btnAssetId.classList.remove('btn-outline-primary');
      }
    }
    </script>
    
    

@endsection