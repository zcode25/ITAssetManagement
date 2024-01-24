@extends('layouts/main')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Location</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xl-8">
            <!-- Horizontal Form -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Form Update Location</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/location/update/{{ $location->locationId }}" method="POST" class="form-horizontal">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label for="companyId" class="col-xl-3 col-form-label">Company <span class="text-danger">*</span></label>
                    <div class="col-xl-9">
                      <select class="form-control select2bs4" id="companyId" name="companyId">
                        @foreach($companies as $company)
                            @if ($company['companyId'] == $location->companyId)
                                <option value="{{ $company['companyId'] }}" selected = "selected">{{ $company['companyName'] }}</option>
                            @else
                                <option value="{{ $company['companyId'] }}">{{ $company['companyName'] }}</option>
                            @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="locationName" class="col-xl-3 col-form-label">Location Name <span class="text-danger">*</span></label>
                    <div class="col-xl-9">
                      <input type="text" class="form-control @error('locationName') is-invalid @enderror" id="locationName" name="locationName" value="{{ old('locationName', $location->locationName) }}">
                      @error('locationName') 
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="locationPhone" class="col-xl-3 col-form-label">Phone <span class="text-danger">*</span></label>
                    <div class="col-xl-9">
                      <input type="tel" class="form-control @error('locationPhone') is-invalid @enderror" id="locationPhone" name="locationPhone" value="{{ old('locationPhone', $location->locationPhone) }}">
                      @error('locationPhone') 
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="locationEmail" class="col-xl-3 col-form-label">Email <span class="text-danger">*</span></label>
                    <div class="col-xl-9">
                      <input type="email" class="form-control @error('locationEmail') is-invalid @enderror" id="locationEmail" name="locationEmail" value="{{ old('locationEmail', $location->locationEmail) }}">
                      @error('locationEmail') 
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="locationAddress" class="col-xl-3 col-form-label">Address <span class="text-danger">*</span></label>
                    <div class="col-xl-9">
                      <textarea class="form-control @error('locationAddress') is-invalid @enderror" rows="3" id="locationAddress" name="locationAddress">{{ old('locationAddress', $location->locationAddress) }}</textarea>
                      @error('locationAddress') 
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="locationCity" class="col-xl-3 col-form-label">City <span class="text-danger">*</span></label>
                    <div class="col-xl-9">
                      <input type="text" class="form-control @error('locationCity') is-invalid @enderror" id="locationCity" name="locationCity" value="{{ old('locationCity', $location->locationCity) }}">
                      @error('locationCity') 
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="locationProvince" class="col-xl-3 col-form-label">Province <span class="text-danger">*</span></label>
                    <div class="col-xl-9">
                      <input type="text" class="form-control @error('locationProvince') is-invalid @enderror" id="locationProvince" name="locationProvince" value="{{ old('locationProvince', $location->locationProvince) }}">
                      @error('locationProvince') 
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="/location" class="btn btn-default">Cancel</a>
                  <button type="submit" name="submit" class="btn btn-primary float-right">Save</button>
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