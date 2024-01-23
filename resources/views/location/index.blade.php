@extends('layouts/main')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Location</h1>
          </div>
          <div class="col-sm-6">
            <div class="float-sm-right">
              <a href="/location/create" class="btn btn-primary">Create New</a>
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
          <h3 class="card-title">Location List</h3>

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
              <th>Location Name</th>
              <th>Company Name</th>
              <th>Phone</th>
              <th>Email</th>
              <th>Address</th>
              <th>City</th>
              <th>Province</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($locations as $location)
            <tr>
              {{-- @php
                  var_dump($location->company);
              @endphp --}}
              <td>{{ $location->locationName }}</td>
              <td>{{ $location->company->companyName }}</td>
              <td>{{ $location->locationPhone }}</td>
              <td>{{ $location->locationEmail }}</td>
              <td>{{ $location->locationAddress }}</td>
              <td>{{ $location->locationCity }}</td>
              <td>{{ $location->locationProvince }}</td>
              <td class="py-0 align-middle">
                <form action="/location/delete/{{ $location->locationId }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <div class="btn-group btn-group-sm">
                    <a href="#" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                  </div>
                </form>
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