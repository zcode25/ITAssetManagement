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
                <h3 class="card-title">Form Disposal</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/assetDisposal/store" method="POST" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                <div class="card-body">
                  <input type="hidden" id="userId" name="userId" value="{{ $user->userId }}">
                  <div class="form-group">
                    <label for="employeeName" class="form-label">Name</label>
                    <p>{{ $user->employeeName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="locationId" class="form-label">Location</label>
                    <p>{{ $user->location->company->companyName }} - {{ $user->location->locationName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="departementId" class="form-label">Departement</label>
                    <p>{{ $user->departement->departementName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="positionId" class="form-label">Position</label>
                    <p>{{ $user->position->positionName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="managerId" class="form-label">Manager</label>
                    @if ($user->managerId)
                      @php
                        $manager = User::where('userId', $user->managerId)->first()
                      @endphp
                      <p>{{ $manager->employeeName }}</p>
                    @else
                      <p></p>                  
                    @endif
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="assetDisposalDate" class="form-label">Disposal Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('assetDisposalDate') is-invalid @enderror" id="assetDisposalDate" name="assetDisposalDate" value="{{ old('assetDisposalDate') }}">
                    @error('assetDisposalDate') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="locationId" class="form-label">Location <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4" id="locationId" name="locationId">
                      @foreach ($locations as $location)
                          @if (old('locationId') == $location->locationId)
                              <option value="{{ $location->locationId }}" selected>{{ $location->company->companyName }} - {{ $location->locationName }}</option>
                              @else
                              <option value="{{ $location->locationId }}">{{ $location->company->companyName }} - {{ $location->locationName }}</option>
                          @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="assetDisposalNote" class="form-label">Disposal Note <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('assetDisposalNote') is-invalid @enderror"s="3" id="assetDisposalNote" name="assetDisposalNote">{{ old('assetDisposalNote') }}</textarea>
                    @error('assetDisposalNote') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="/assetDisposal" class="btn btn-default">Cancel</a>
                  <button type="submit" id="submit" name="submit" class="btn btn-primary float-right">Save</button>
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

@endsection