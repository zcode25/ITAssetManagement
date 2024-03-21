@extends('layouts/main')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Manufacture</h1>
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
                <h3 class="card-title">Form Update Manufacture</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/manufacture/update/{{ $manufacture->manufactureId }}" method="POST" class="form-horizontal">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="manufactureName" class="form-label">Manufacture Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('manufactureName') is-invalid @enderror" id="manufactureName" name="manufactureName" value="{{ old('manufactureName', $manufacture->manufactureName) }}">
                    @error('manufactureName') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="manufacturePhone" class="form-label">Phone <span class="text-danger">*</span></label>
                    <input type="tel" class="form-control @error('manufacturePhone') is-invalid @enderror" id="manufacturePhone" name="manufacturePhone" value="{{ old('manufacturePhone', $manufacture->manufacturePhone) }}">
                    @error('manufacturePhone') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="manufactureEmail" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('manufactureEmail') is-invalid @enderror" id="manufactureEmail" name="manufactureEmail" value="{{ old('manufactureEmail', $manufacture->manufactureEmail) }}">
                    @error('manufactureEmail') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="/manufacture" class="btn btn-default">Cancel</a>
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