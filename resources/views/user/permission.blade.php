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
                  $jsonData = $user->permission;
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
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Supplier</h3>
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
                                    <input type="radio" id="supplierIndex1" name="supplierIndex" value="true" @if ($menuData['supplierIndex']['index'] == true) checked @endif>
                                    <label for="supplierIndex1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="supplierIndex2" name="supplierIndex" value="false" @if ($menuData['supplierIndex']['index'] == false) checked @endif>
                                    <label for="supplierIndex2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Create</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="supplierCreate1" name="supplierCreate" value="true" @if ($menuData['supplierCreate']['index'] == true) checked @endif>
                                    <label for="supplierCreate1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="supplierCreate2" name="supplierCreate" value="false" @if ($menuData['supplierCreate']['index'] == false) checked @endif>
                                    <label for="supplierCreate2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Edit</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="supplierEdit1" name="supplierEdit" value="true" @if ($menuData['supplierEdit']['index'] == true) checked @endif>
                                    <label for="supplierEdit1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="supplierEdit2" name="supplierEdit" value="false" @if ($menuData['supplierEdit']['index'] == false) checked @endif> 
                                    <label for="supplierEdit2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Delete</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="supplierDelete1" name="supplierDelete" value="true" @if ($menuData['supplierDelete']['index'] == true) checked @endif>
                                    <label for="supplierDelete1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="supplierDelete2" name="supplierDelete" value="false" @if ($menuData['supplierDelete']['index'] == false) checked @endif>
                                    <label for="supplierDelete2"></label>
                                </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Manufacture</h3>
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
                                    <input type="radio" id="manufactureIndex1" name="manufactureIndex" value="true" @if ($menuData['manufactureIndex']['index'] == true) checked @endif>
                                    <label for="manufactureIndex1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="manufactureIndex2" name="manufactureIndex" value="false" @if ($menuData['manufactureIndex']['index'] == false) checked @endif>
                                    <label for="manufactureIndex2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Create</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="manufactureCreate1" name="manufactureCreate" value="true" @if ($menuData['manufactureCreate']['index'] == true) checked @endif>
                                    <label for="manufactureCreate1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="manufactureCreate2" name="manufactureCreate" value="false" @if ($menuData['manufactureCreate']['index'] == false) checked @endif>
                                    <label for="manufactureCreate2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Edit</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="manufactureEdit1" name="manufactureEdit" value="true" @if ($menuData['manufactureEdit']['index'] == true) checked @endif>
                                    <label for="manufactureEdit1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="manufactureEdit2" name="manufactureEdit" value="false" @if ($menuData['manufactureEdit']['index'] == false) checked @endif> 
                                    <label for="manufactureEdit2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Delete</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="manufactureDelete1" name="manufactureDelete" value="true" @if ($menuData['manufactureDelete']['index'] == true) checked @endif>
                                    <label for="manufactureDelete1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="manufactureDelete2" name="manufactureDelete" value="false" @if ($menuData['manufactureDelete']['index'] == false) checked @endif>
                                    <label for="manufactureDelete2"></label>
                                </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Category</h3>
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
                                    <input type="radio" id="categoryIndex1" name="categoryIndex" value="true" @if ($menuData['categoryIndex']['index'] == true) checked @endif>
                                    <label for="categoryIndex1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="categoryIndex2" name="categoryIndex" value="false" @if ($menuData['categoryIndex']['index'] == false) checked @endif>
                                    <label for="categoryIndex2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Create</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="categoryCreate1" name="categoryCreate" value="true" @if ($menuData['categoryCreate']['index'] == true) checked @endif>
                                    <label for="categoryCreate1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="categoryCreate2" name="categoryCreate" value="false" @if ($menuData['categoryCreate']['index'] == false) checked @endif>
                                    <label for="categoryCreate2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Edit</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="categoryEdit1" name="categoryEdit" value="true" @if ($menuData['categoryEdit']['index'] == true) checked @endif>
                                    <label for="categoryEdit1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="categoryEdit2" name="categoryEdit" value="false" @if ($menuData['categoryEdit']['index'] == false) checked @endif> 
                                    <label for="categoryEdit2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Delete</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="categoryDelete1" name="categoryDelete" value="true" @if ($menuData['categoryDelete']['index'] == true) checked @endif>
                                    <label for="categoryDelete1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="categoryDelete2" name="categoryDelete" value="false" @if ($menuData['categoryDelete']['index'] == false) checked @endif>
                                    <label for="categoryDelete2"></label>
                                </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Depreciation</h3>
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
                                    <input type="radio" id="depreciationIndex1" name="depreciationIndex" value="true" @if ($menuData['depreciationIndex']['index'] == true) checked @endif>
                                    <label for="depreciationIndex1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="depreciationIndex2" name="depreciationIndex" value="false" @if ($menuData['depreciationIndex']['index'] == false) checked @endif>
                                    <label for="depreciationIndex2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Create</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="depreciationCreate1" name="depreciationCreate" value="true" @if ($menuData['depreciationCreate']['index'] == true) checked @endif>
                                    <label for="depreciationCreate1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="depreciationCreate2" name="depreciationCreate" value="false" @if ($menuData['depreciationCreate']['index'] == false) checked @endif>
                                    <label for="depreciationCreate2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Edit</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="depreciationEdit1" name="depreciationEdit" value="true" @if ($menuData['depreciationEdit']['index'] == true) checked @endif>
                                    <label for="depreciationEdit1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="depreciationEdit2" name="depreciationEdit" value="false" @if ($menuData['depreciationEdit']['index'] == false) checked @endif> 
                                    <label for="depreciationEdit2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Delete</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="depreciationDelete1" name="depreciationDelete" value="true" @if ($menuData['depreciationDelete']['index'] == true) checked @endif>
                                    <label for="depreciationDelete1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="depreciationDelete2" name="depreciationDelete" value="false" @if ($menuData['depreciationDelete']['index'] == false) checked @endif>
                                    <label for="depreciationDelete2"></label>
                                </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Asset Model</h3>
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
                                    <input type="radio" id="assetModelIndex1" name="assetModelIndex" value="true" @if ($menuData['assetModelIndex']['index'] == true) checked @endif>
                                    <label for="assetModelIndex1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="assetModelIndex2" name="assetModelIndex" value="false" @if ($menuData['assetModelIndex']['index'] == false) checked @endif>
                                    <label for="assetModelIndex2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Create</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="assetModelCreate1" name="assetModelCreate" value="true" @if ($menuData['assetModelCreate']['index'] == true) checked @endif>
                                    <label for="assetModelCreate1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="assetModelCreate2" name="assetModelCreate" value="false" @if ($menuData['assetModelCreate']['index'] == false) checked @endif>
                                    <label for="assetModelCreate2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Edit</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="assetModelEdit1" name="assetModelEdit" value="true" @if ($menuData['assetModelEdit']['index'] == true) checked @endif>
                                    <label for="assetModelEdit1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="assetModelEdit2" name="assetModelEdit" value="false" @if ($menuData['assetModelEdit']['index'] == false) checked @endif> 
                                    <label for="assetModelEdit2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Delete</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="assetModelDelete1" name="assetModelDelete" value="true" @if ($menuData['assetModelDelete']['index'] == true) checked @endif>
                                    <label for="assetModelDelete1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="assetModelDelete2" name="assetModelDelete" value="false" @if ($menuData['assetModelDelete']['index'] == false) checked @endif>
                                    <label for="assetModelDelete2"></label>
                                </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Asset</h3>
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
                            <td>My Asset</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="assetIndex1" name="assetIndex" value="true" @if ($menuData['assetIndex']['index'] == true) checked @endif>
                                    <label for="assetIndex1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="assetIndex2" name="assetIndex" value="false" @if ($menuData['assetIndex']['index'] == false) checked @endif>
                                    <label for="assetIndex2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Asset Archive</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="assetArchiveIndex1" name="assetArchiveIndex" value="true" @if ($menuData['assetArchiveIndex']['index'] == true) checked @endif>
                                    <label for="assetArchiveIndex1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="assetArchiveIndex2" name="assetArchiveIndex" value="false" @if ($menuData['assetArchiveIndex']['index'] == false) checked @endif>
                                    <label for="assetArchiveIndex2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Asset Repair</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="assetRepairIndex1" name="assetRepairIndex" value="true" @if ($menuData['assetRepairIndex']['index'] == true) checked @endif>
                                    <label for="assetRepairIndex1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="assetRepairIndex2" name="assetRepairIndex" value="false" @if ($menuData['assetRepairIndex']['index'] == false) checked @endif> 
                                    <label for="assetRepairIndex2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Asset Broken</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="assetBrokenIndex1" name="assetBrokenIndex" value="true" @if ($menuData['assetBrokenIndex']['index'] == true) checked @endif>
                                    <label for="assetBrokenIndex1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="assetBrokenIndex2" name="assetBrokenIndex" value="false" @if ($menuData['assetBrokenIndex']['index'] == false) checked @endif>
                                    <label for="assetBrokenIndex2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Asset Disposal</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="assetDisposalIndex1" name="assetDisposalIndex" value="true" @if ($menuData['assetDisposalIndex']['index'] == true) checked @endif>
                                    <label for="assetDisposalIndex1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="assetDisposalIndex2" name="assetDisposalIndex" value="false" @if ($menuData['assetDisposalIndex']['index'] == false) checked @endif>
                                    <label for="assetDisposalIndex2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Asset Depreciation</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="assetDepreciationIndex1" name="assetDepreciationIndex" value="true" @if ($menuData['assetDepreciationIndex']['index'] == true) checked @endif>
                                    <label for="assetDepreciationIndex1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="assetDepreciationIndex2" name="assetDepreciationIndex" value="false" @if ($menuData['assetDepreciationIndex']['index'] == false) checked @endif>
                                    <label for="assetDepreciationIndex2"></label>
                                </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Asset Procurement</h3>
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
                            <td>All Procurement</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="assetProcurementAllIndex1" name="assetProcurementAllIndex" value="true" @if ($menuData['assetProcurementAllIndex']['index'] == true) checked @endif>
                                    <label for="assetProcurementAllIndex1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="assetProcurementAllIndex2" name="assetProcurementAllIndex" value="false" @if ($menuData['assetProcurementAllIndex']['index'] == false) checked @endif>
                                    <label for="assetProcurementAllIndex2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>My Procurement</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="assetProcurementIndex1" name="assetProcurementIndex" value="true" @if ($menuData['assetProcurementIndex']['index'] == true) checked @endif>
                                    <label for="assetProcurementIndex1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="assetProcurementIndex2" name="assetProcurementIndex" value="false" @if ($menuData['assetProcurementIndex']['index'] == false) checked @endif>
                                    <label for="assetProcurementIndex2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Approval Manager</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="assetProcurementApprovalManager1" name="assetProcurementApprovalManager" value="true" @if ($menuData['assetProcurementApprovalManager']['index'] == true) checked @endif>
                                    <label for="assetProcurementApprovalManager1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="assetProcurementApprovalManager2" name="assetProcurementApprovalManager" value="false" @if ($menuData['assetProcurementApprovalManager']['index'] == false) checked @endif> 
                                    <label for="assetProcurementApprovalManager2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Approval IT Manager</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="assetProcurementApprovalITManager1" name="assetProcurementApprovalITManager" value="true" @if ($menuData['assetProcurementApprovalITManager']['index'] == true) checked @endif>
                                    <label for="assetProcurementApprovalITManager1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="assetProcurementApprovalITManager2" name="assetProcurementApprovalITManager" value="false" @if ($menuData['assetProcurementApprovalITManager']['index'] == false) checked @endif>
                                    <label for="assetProcurementApprovalITManager2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Asset Purchase</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="assetPurchaseIndex1" name="assetPurchaseIndex" value="true" @if ($menuData['assetPurchaseIndex']['index'] == true) checked @endif>
                                    <label for="assetPurchaseIndex1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="assetPurchaseIndex2" name="assetPurchaseIndex" value="false" @if ($menuData['assetPurchaseIndex']['index'] == false) checked @endif>
                                    <label for="assetPurchaseIndex2"></label>
                                </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Asset Deployment</h3>
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
                            <td>All Deployment</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="assetDeploymentAllIndex1" name="assetDeploymentAllIndex" value="true" @if ($menuData['assetDeploymentAllIndex']['index'] == true) checked @endif>
                                    <label for="assetDeploymentAllIndex1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="assetDeploymentAllIndex2" name="assetDeploymentAllIndex" value="false" @if ($menuData['assetDeploymentAllIndex']['index'] == false) checked @endif>
                                    <label for="assetDeploymentAllIndex2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Pre-Deployment</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="assetPreDeploymentIndex1" name="assetPreDeploymentIndex" value="true" @if ($menuData['assetPreDeploymentIndex']['index'] == true) checked @endif>
                                    <label for="assetPreDeploymentIndex1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="assetPreDeploymentIndex2" name="assetPreDeploymentIndex" value="false" @if ($menuData['assetPreDeploymentIndex']['index'] == false) checked @endif>
                                    <label for="assetPreDeploymentIndex2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Deployment Ready</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="assetDeploymentReadyIndex1" name="assetDeploymentReadyIndex" value="true" @if ($menuData['assetDeploymentReadyIndex']['index'] == true) checked @endif>
                                    <label for="assetDeploymentReadyIndex1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="assetDeploymentReadyIndex2" name="assetDeploymentReadyIndex" value="false" @if ($menuData['assetDeploymentReadyIndex']['index'] == false) checked @endif> 
                                    <label for="assetDeploymentReadyIndex2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Deployment Checkout</td>
                            <td>
                                <div class="icheck-primary">
                                    <input type="radio" id="assetDeploymentCheckoutIndex1" name="assetDeploymentCheckoutIndex" value="true" @if ($menuData['assetDeploymentCheckoutIndex']['index'] == true) checked @endif>
                                    <label for="assetDeploymentCheckoutIndex1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-danger">
                                    <input type="radio" id="assetDeploymentCheckoutIndex2" name="assetDeploymentCheckoutIndex" value="false" @if ($menuData['assetDeploymentCheckoutIndex']['index'] == false) checked @endif>
                                    <label for="assetDeploymentCheckoutIndex2"></label>
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