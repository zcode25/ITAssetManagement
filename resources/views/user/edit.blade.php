@extends('layouts/main')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit User</h1>
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
                <h3 class="card-title">Form Edit User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/user/update/{{ $user->userId }}" method="POST" class="form-horizontal">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="employeeNumber" class="form-label">Employee Number <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('employeeNumber') is-invalid @enderror" id="employeeNumber" name="employeeNumber" value="{{ old('employeeNumber', $user->employeeNumber) }}" readonly>
                    @error('employeeNumber') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="employeeName" class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('employeeName') is-invalid @enderror" id="employeeName" name="employeeName" value="{{ old('employeeName', $user->employeeName) }}">
                    @error('employeeName') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="locationId" class="form-label">Location <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4" id="locationId" name="locationId">
                      @foreach($locations as $location)
                          @if ($location['locationId'] == $user->locationId)
                              <option value="{{ $location['locationId'] }}" selected = "selected">{{ $location->company->companyName }} - {{ $location['locationName'] }}</option>
                          @else
                              <option value="{{ $location['locationId'] }}">{{ $location->company->companyName }} - {{ $location['locationName'] }}</option>
                          @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="departementId" class="form-label">Departement <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4" id="departementId" name="departementId">
                      @foreach($departements as $departement)
                          @if ($departement['departementId'] == $user->departementId)
                              <option value="{{ $departement['departementId'] }}" selected = "selected">{{ $departement['departementName'] }}</option>
                          @else
                              <option value="{{ $departement['departementId'] }}">{{ $departement['departementName'] }}</option>
                          @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="positionId" class="form-label">Position <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4" id="positionId" name="positionId">
                      @foreach($positions as $position)
                          @if ($position['positionId'] == $user->positionId)
                              <option value="{{ $position['positionId'] }}" selected = "selected">{{ $position['positionName'] }}</option>
                          @else
                              <option value="{{ $position['positionId'] }}">{{ $position['positionName'] }}</option>
                          @endif
                      @endforeach
                    </select>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="employeePhone" class="form-label">Phone <span class="text-danger">*</span></label>
                    <input type="tel" class="form-control @error('employeePhone') is-invalid @enderror" id="employeePhone" name="employeePhone" value="{{ old('employeePhone', $user->employeePhone) }}">
                    @error('employeePhone') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="employeeEmail" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('employeeEmail') is-invalid @enderror" id="employeeEmail" name="employeeEmail" value="{{ old('employeeEmail', $user->employeeEmail) }}">
                    @error('employeeEmail') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="employeeAddress" class="form-label">Address <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('employeeAddress') is-invalid @enderror"s="3" id="employeeAddress" name="employeeAddress">{{ old('employeeAddress', $user->employeeAddress) }}</textarea>
                    @error('employeeAddress') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="employeeCity" class="form-label">City <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('employeeCity') is-invalid @enderror" id="employeeCity" name="employeeCity" value="{{ old('employeeCity', $user->employeeCity) }}">
                    @error('employeeCity') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="employeeProvince" class="form-label">Province <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('employeeProvince') is-invalid @enderror" id="employeeProvince" name="employeeProvince" value="{{ old('employeeProvince', $user->employeeProvince) }}">
                    @error('employeeProvince') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="/user" class="btn btn-default">Cancel</a>
                  <button type="submit" name="submit" class="btn btn-primary float-right">Save</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->
        </div>
        <div class="col-xl-6">
          <!-- Horizontal Form -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Form Reset Password</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/user/resetPassword/{{ $user->userId }}" method="POST" class="form-horizontal">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}">
                  @error('password') 
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <a href="/user" class="btn btn-default">Cancel</a>
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