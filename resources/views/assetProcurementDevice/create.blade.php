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
            <h1>Create Procurement</h1>
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
                <h3 class="card-title">Form Create Procurement</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/assetProcurement/store" method="POST" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                <div class="card-body">
                  <input type="hidden" id="userId" name="userId" value="{{ $user->userId }}">
                  <div class="form-group">
                    <label for="employeeName" class="form-label">Name <span class="text-danger">*</span></label>
                    <p>{{ $user->employeeName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="locationId" class="form-label">Location <span class="text-danger">*</span></label>
                    <p>{{ $user->location->company->companyName }} - {{ $user->location->locationName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="departementId" class="form-label">Departement <span class="text-danger">*</span></label>
                    <p>{{ $user->departement->departementName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="positionId" class="form-label">Position <span class="text-danger">*</span></label>
                    <p>{{ $user->position->positionName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="managerId" class="form-label">Manager <span class="text-danger">*</span></label>
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
                    <label for="assetProcurementDate" class="form-label">Procurement Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('assetProcurementDate') is-invalid @enderror" id="assetProcurementDate" name="assetProcurementDate" value="{{ old('assetProcurementDate') }}">
                    @error('assetProcurementDate') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="assetProcurementNote" class="form-label">Procurement Note <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('assetProcurementNote') is-invalid @enderror"s="3" id="assetProcurementNote" name="assetProcurementNote">{{ old('assetProcurementNote') }}</textarea>
                    @error('assetProcurementNote') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="/assetModel" class="btn btn-default">Cancel</a>
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