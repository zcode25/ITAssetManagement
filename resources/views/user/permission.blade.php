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
              @php
                  $jsonData = auth()->user()->permission;
                  $menuData = json_decode($jsonData, true);
              @endphp
              <form action="/user/permission/create/{{ $user->userId }}" method="POST" class="form-horizontal">
                @csrf
                <div class="card-body">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Dashboard</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <table class="table table-sm">
                        <thead>
                          <tr>
                            <th style="width: 40%">Permission</th>
                            <th>Grant</th>
                            <th>Deny</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>View</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="dashboardIndex1" name="dashboardIndex" value="true" @if ($menuData['dashboardIndex']['index'] == true) checked @endif>
                                    <label for="dashboardIndex1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="dashboardIndex2" name="dashboardIndex" value="false" @if ($menuData['dashboardIndex']['index'] == false) checked @endif>
                                    <label for="dashboardIndex2"></label>
                                </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Company</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <table class="table table-sm">
                        <thead>
                          <tr>
                            <th style="width: 40%">Permission</th>
                            <th>Grant</th>
                            <th>Deny</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>View</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="companyIndex1" name="companyIndex" value="true" @if ($menuData['companyIndex']['index'] == true) checked @endif>
                                    <label for="companyIndex1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="companyIndex2" name="companyIndex" value="false" @if ($menuData['companyIndex']['index'] == false) checked @endif>
                                    <label for="companyIndex2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Create</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="companyCreate1" name="companyCreate" value="true" @if ($menuData['companyCreate']['index'] == true) checked @endif>
                                    <label for="companyCreate1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="companyCreate2" name="companyCreate" value="false" @if ($menuData['companyCreate']['index'] == false) checked @endif>
                                    <label for="companyCreate2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Edit</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="companyEdit1" name="companyEdit" value="true" @if ($menuData['companyEdit']['index'] == true) checked @endif>
                                    <label for="companyEdit1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="companyEdit2" name="companyEdit" value="false" @if ($menuData['companyEdit']['index'] == false) checked @endif> 
                                    <label for="companyEdit2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Delete</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="companyDelete1" name="companyDelete" value="true" @if ($menuData['companyDelete']['index'] == true) checked @endif>
                                    <label for="companyDelete1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="companyDelete2" name="companyDelete" value="false" @if ($menuData['companyDelete']['index'] == false) checked @endif>
                                    <label for="companyDelete2"></label>
                                </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Location</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <table class="table table-sm">
                        <thead>
                          <tr>
                            <th style="width: 40%">Permission</th>
                            <th>Grant</th>
                            <th>Deny</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>View</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="locationIndex1" name="locationIndex" value="true" @if ($menuData['locationIndex']['index'] == true) checked @endif>
                                    <label for="locationIndex1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="locationIndex2" name="locationIndex" value="false" @if ($menuData['locationIndex']['index'] == false) checked @endif>
                                    <label for="locationIndex2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Create</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="locationCreate1" name="locationCreate" value="true" @if ($menuData['locationCreate']['index'] == true) checked @endif>
                                    <label for="locationCreate1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="locationCreate2" name="locationCreate" value="false" @if ($menuData['locationCreate']['index'] == false) checked @endif>
                                    <label for="locationCreate2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Edit</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="locationEdit1" name="locationEdit" value="true" @if ($menuData['locationEdit']['index'] == true) checked @endif>
                                    <label for="locationEdit1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="locationEdit2" name="locationEdit" value="false" @if ($menuData['locationEdit']['index'] == false) checked @endif> 
                                    <label for="locationEdit2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Delete</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="locationDelete1" name="locationDelete" value="true" @if ($menuData['locationDelete']['index'] == true) checked @endif>
                                    <label for="locationDelete1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="locationDelete2" name="locationDelete" value="false" @if ($menuData['locationDelete']['index'] == false) checked @endif>
                                    <label for="locationDelete2"></label>
                                </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Departement</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <table class="table table-sm">
                        <thead>
                          <tr>
                            <th style="width: 40%">Permission</th>
                            <th>Grant</th>
                            <th>Deny</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>View</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="departementIndex1" name="departementIndex" value="true" @if ($menuData['departementIndex']['index'] == true) checked @endif>
                                    <label for="departementIndex1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="departementIndex2" name="departementIndex" value="false" @if ($menuData['departementIndex']['index'] == false) checked @endif>
                                    <label for="departementIndex2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Create</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="departementCreate1" name="departementCreate" value="true" @if ($menuData['departementCreate']['index'] == true) checked @endif>
                                    <label for="departementCreate1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="departementCreate2" name="departementCreate" value="false" @if ($menuData['departementCreate']['index'] == false) checked @endif>
                                    <label for="departementCreate2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Edit</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="departementEdit1" name="departementEdit" value="true" @if ($menuData['departementEdit']['index'] == true) checked @endif>
                                    <label for="departementEdit1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="departementEdit2" name="departementEdit" value="false" @if ($menuData['departementEdit']['index'] == false) checked @endif> 
                                    <label for="departementEdit2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Delete</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="departementDelete1" name="departementDelete" value="true" @if ($menuData['departementDelete']['index'] == true) checked @endif>
                                    <label for="departementDelete1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="departementDelete2" name="departementDelete" value="false" @if ($menuData['departementDelete']['index'] == false) checked @endif>
                                    <label for="departementDelete2"></label>
                                </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Position</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <table class="table table-sm">
                        <thead>
                          <tr>
                            <th style="width: 40%">Permission</th>
                            <th>Grant</th>
                            <th>Deny</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>View</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="positionIndex1" name="positionIndex" value="true" @if ($menuData['positionIndex']['index'] == true) checked @endif>
                                    <label for="positionIndex1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="positionIndex2" name="positionIndex" value="false" @if ($menuData['positionIndex']['index'] == false) checked @endif>
                                    <label for="positionIndex2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Create</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="positionCreate1" name="positionCreate" value="true" @if ($menuData['positionCreate']['index'] == true) checked @endif>
                                    <label for="positionCreate1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="positionCreate2" name="positionCreate" value="false" @if ($menuData['positionCreate']['index'] == false) checked @endif>
                                    <label for="positionCreate2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Edit</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="positionEdit1" name="positionEdit" value="true" @if ($menuData['positionEdit']['index'] == true) checked @endif>
                                    <label for="positionEdit1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="positionEdit2" name="positionEdit" value="false" @if ($menuData['positionEdit']['index'] == false) checked @endif> 
                                    <label for="positionEdit2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Delete</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="positionDelete1" name="positionDelete" value="true" @if ($menuData['positionDelete']['index'] == true) checked @endif>
                                    <label for="positionDelete1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="positionDelete2" name="positionDelete" value="false" @if ($menuData['positionDelete']['index'] == false) checked @endif>
                                    <label for="positionDelete2"></label>
                                </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">User</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <table class="table table-sm">
                        <thead>
                          <tr>
                            <th style="width: 40%">Permission</th>
                            <th>Grant</th>
                            <th>Deny</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>View</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="userIndex1" name="userIndex" value="true" @if ($menuData['userIndex']['index'] == true) checked @endif>
                                    <label for="userIndex1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="userIndex2" name="userIndex" value="false" @if ($menuData['userIndex']['index'] == false) checked @endif>
                                    <label for="userIndex2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Create</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="userCreate1" name="userCreate" value="true" @if ($menuData['userCreate']['index'] == true) checked @endif>
                                    <label for="userCreate1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="userCreate2" name="userCreate" value="false" @if ($menuData['userCreate']['index'] == false) checked @endif>
                                    <label for="userCreate2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Permission</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="userPermission1" name="userPermission" value="true" @if ($menuData['userPermission']['index'] == true) checked @endif>
                                    <label for="userPermission1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="userPermission2" name="userPermission" value="false" @if ($menuData['userPermission']['index'] == false) checked @endif>
                                    <label for="userPermission2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Edit</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="userEdit1" name="userEdit" value="true" @if ($menuData['userEdit']['index'] == true) checked @endif>
                                    <label for="userEdit1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="userEdit2" name="userEdit" value="false" @if ($menuData['userEdit']['index'] == false) checked @endif> 
                                    <label for="userEdit2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Delete</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="userDelete1" name="userDelete" value="true" @if ($menuData['userDelete']['index'] == true) checked @endif>
                                    <label for="userDelete1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="userDelete2" name="userDelete" value="false" @if ($menuData['userDelete']['index'] == false) checked @endif>
                                    <label for="userDelete2"></label>
                                </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
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