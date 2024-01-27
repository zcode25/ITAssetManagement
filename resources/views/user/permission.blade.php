@extends('layouts/main')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Permission User</h1>
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
                <h3 class="card-title">Form Permission User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/company/store" method="POST" class="form-horizontal">
                @csrf
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                          <tr>
                            <th>Company</th>
                            <th>Grant</th>
                            <th>Deny</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>View</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="company.index1" name="company.index" value="true">
                                    <label for="company.index1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="company.index2" name="company.index" value="false">
                                    <label for="company.index2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Create</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="company.create1" name="company.create" value="true">
                                    <label for="company.create1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="company.create2" name="company.create" value="false">
                                    <label for="company.create2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Edit</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="company.edit1" name="company.edit" value="true">
                                    <label for="company.edit1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="company.edit2" name="company.edit" value="false">
                                    <label for="company.edit2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Delete</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="company.delete1" name="company.delete" value="true">
                                    <label for="company.delete1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="company.delete2" name="company.delete" value="false">
                                    <label for="company.delete2"></label>
                                </div>
                            </td>
                          </tr>
                          
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="/company" class="btn btn-default">Cancel</a>
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