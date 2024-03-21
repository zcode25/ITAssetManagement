@extends('layouts/main')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Departement</h1>
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
                <h3 class="card-title">Form Update Departement</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/departement/update/{{ $departement->departementId }}" method="POST" class="form-horizontal">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="departementName" class="form-label">Departement Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('departementName') is-invalid @enderror" id="departementName" name="departementName" value="{{ old('departementName', $departement->departementName) }}">
                    @error('departementName') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="/departement" class="btn btn-default">Cancel</a>
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