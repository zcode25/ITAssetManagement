@extends('layouts/main')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Position</h1>
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
                <h3 class="card-title">Form Create Position</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/assetProcurement/device/store/{{ $assetProcurement->assetProcurementId }}" method="POST" class="form-horizontal">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="assetModelId" class="form-label">Asset Model <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4" id="assetModelId" name="assetModelId">
                      @foreach ($assetModels as $assetModel)
                          @if (old('assetModelId') == $assetModel->assetModelId)
                              <option value="{{ $assetModel->assetModelId }}" selected>{{ $assetModel->assetModelName }}</option>
                              @else
                              <option value="{{ $assetModel->assetModelId }}">{{ $assetModel->assetModelName }}</option>
                          @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="assetProcurementDeviceQuantity" class="form-label">Quantity <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('assetProcurementDeviceQuantity') is-invalid @enderror" id="assetProcurementDeviceQuantity" name="assetProcurementDeviceQuantity" value="{{ old('assetProcurementDeviceQuantity') }}">
                    @error('assetProcurementDeviceQuantity') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="d-grid gap-2">
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Add</button>
                  </div>
                  <hr>
                  <table class="table table-sm">
                    <thead>
                      <tr>
                        <th style="width: 20px">No</th>
                        <th>Device</th>
                        <th>Quantity</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                          $i = 1;
                      @endphp
                      @foreach ($assetProcurementDevices as $assetProcurementDevice)
                      <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $assetProcurementDevice->assetModel->assetModelName }}</td>
                        <td>{{ $assetProcurementDevice->assetProcurementDeviceQuantity }}</td>
                        <td><button class="btn btn-danger btn-sm">Delete</button></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="/assetProcurement" class="btn btn-primary float-right">Save</a>
                  {{-- <button type="submit" name="submit" class="btn btn-primary float-right">Save</button> --}}
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
              <h3 class="card-title">Form Create Position</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/position/store" method="POST" class="form-horizontal">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="positionName" class="form-label">Position Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('positionName') is-invalid @enderror" id="positionName" name="positionName" value="{{ old('positionName') }}">
                  @error('positionName') 
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <a href="/position" class="btn btn-default">Cancel</a>
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