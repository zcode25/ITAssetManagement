@extends('layouts/main')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Departement</h1>
          </div>
          <div class="col-sm-6">
            <div class="float-sm-right">
              <a href="/departement/create" class="btn btn-primary">Create New</a>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Departement List</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <table id="example1" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>Departement</th>
              <th>Company</th>
              <th>Location</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($departements as $departement)
            <tr>
              <td>{{ $departement->departementName }}</td>
              <td>{{ $departement->location->company->companyName }} </td>
              <td>{{ $departement->location->locationName }}</td>
              <td class="py-0 align-middle">
                <div class="btn-group btn-group-sm">
                  <a href="/departement/edit/{{ $departement->departementId }}" class="btn btn-primary">Edit</a>
                  <a href="/departement/destroy/{{ $departement->departementId }}" class="btn btn-danger" data-confirm-delete="true">Delete</a>
                </div>
              </td>
            </tr>    
            @endforeach
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection