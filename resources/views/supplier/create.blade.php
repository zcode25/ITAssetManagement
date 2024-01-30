@extends('layouts/main')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Supplier</h1>
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
                <h3 class="card-title">Form Create Supplier</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/supplier/store" method="POST" class="form-horizontal">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="supplierName" class="form-label">Supplier Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('supplierName') is-invalid @enderror" id="supplierName" name="supplierName" value="{{ old('supplierName') }}">
                    @error('supplierName') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="supplierPhone" class="form-label">Phone <span class="text-danger">*</span></label>
                    <input type="tel" class="form-control @error('supplierPhone') is-invalid @enderror" id="supplierPhone" name="supplierPhone" value="{{ old('supplierPhone') }}">
                    @error('supplierPhone') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="supplierEmail" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('supplierEmail') is-invalid @enderror" id="supplierEmail" name="supplierEmail" value="{{ old('supplierEmail') }}">
                    @error('supplierEmail') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="supplierAddress" class="form-label">Address <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('supplierAddress') is-invalid @enderror" rows="3" id="supplierAddress" name="supplierAddress">{{ old('supplierAddress') }}</textarea>
                    @error('supplierAddress') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="supplierCity" class="form-label">City <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('supplierCity') is-invalid @enderror" id="supplierCity" name="supplierCity" value="{{ old('supplierCity') }}">
                    @error('supplierCity') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="supplierProvince" class="form-label">Province <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('supplierProvince') is-invalid @enderror" id="supplierProvince" name="supplierProvince" value="{{ old('supplierProvince') }}">
                    @error('supplierProvince') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="/supplier" class="btn btn-default">Cancel</a>
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