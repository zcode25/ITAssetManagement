@extends('layouts/main')
@section('container')
@php
    use App\Models\User;
@endphp

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Asset Purchase</h1>
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
                <h3 class="card-title">Form Asset Purchase</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/assetPurchase/purchase/store/{{ $assetProcurement->assetProcurementId }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                <div class="card-body">
                  {{-- <input type="hidden" id="userId" name="userId" value="{{ $user->userId }}"> --}}
                  <div class="form-group">
                    <label for="assetProcurementNumber" class="form-label">Procurement Number</label>
                    <p>{{ $assetProcurement->assetProcurementNumber }}</p>
                  </div>
                  <div class="form-group">
                    <label for="assetProcurementDate" class="form-label">Procurement Date</label>
                    <p>{{ $assetProcurement->assetProcurementDate }}</p>
                  </div>
                  <div class="form-group">
                    <label for="employeeName" class="form-label">Name</label>
                    <p>{{ $assetProcurement->user->employeeName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="locationId" class="form-label">Location</label>
                    <p>{{ $assetProcurement->location->company->companyName }} - {{ $assetProcurement->location->locationName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="departementId" class="form-label">Departement</label>
                    <p>{{ $assetProcurement->user->departement->departementName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="positionId" class="form-label">Position</label>
                    <p>{{ $assetProcurement->user->position->positionName }}</p>
                  </div>
                  <div class="form-group">
                    <label for="managerId" class="form-label">Manager</label>
                    <p>{{ $assetProcurement->manager->employeeName }}</p>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="assetPurchaseNumber" class="form-label">Purchase Number <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('assetPurchaseNumber') is-invalid @enderror" id="assetPurchaseNumber" name="assetPurchaseNumber" value="{{ old('assetPurchaseNumber') }}">
                    @error('assetPurchaseNumber') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="assetPurchaseDate" class="form-label">Purchase Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('assetPurchaseDate') is-invalid @enderror" id="assetPurchaseDate" name="assetPurchaseDate" value="{{ old('assetPurchaseDate') }}">
                    @error('assetPurchaseDate') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <hr>
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Form Asset Device</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <!-- form start -->
                    @if (count($assetProcurementDevices) > 0)
                    <div class="table-responsive-md">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Device</th>
                          <th>Image</th>
                          <th>Qty</th>
                          <th>Price/Unit</th>
                          <th>Supplier</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($assetProcurementDevices as $assetProcurementDevice)
                        <tr>
                          <td>{{ $i }}</td>
                          <td>{{ $assetProcurementDevice->assetModel->assetModelName }}</td>
                          <td><img src="{{ asset('storage/' .  $assetProcurementDevice->assetModel->assetModelImage ) }}" alt="{{ $assetProcurementDevice->assetModel->assetModelName }}" class="img-responsive" style="max-height: 30px; width: auto;"></td>
                          <td>{{ $assetProcurementDevice->assetProcurementDeviceQuantity }}</td>
                          <td>
                            <input type="hidden" class="form-control" id="assetProcurementDeviceId-{{ $i }}" name="assetProcurementDeviceId-{{ $i }}" value="{{ $assetProcurementDevice->assetProcurementDeviceId }}">
                            <input type="number" class="form-control @error('assetProcurementDevicePrice-{{ $i }}') is-invalid @enderror" id="assetProcurementDevicePrice-{{ $i }}" name="assetProcurementDevicePrice-{{ $i }}" value="{{ old('assetProcurementDevicePrice'. $i ) }}">
                            @error('assetProcurementDevicePrice-{{ $i }}') 
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </td>
                          <td>
                            <div class="row">
                              <div class="col-8">
                                <select class="form-control select2bs4" id="supplierId-{{ $i }}" name="supplierId-{{ $i }}" data-placeholder="Select a Supplier">
                                  <option value=""></option>
                                  @foreach ($suppliers as $supplier)
                                      @if (old('supplierId') == $supplier->supplierId)
                                          <option value="{{ $supplier->supplierId }}" selected>{{ $supplier->supplierName }}</option>
                                          @else
                                          <option value="{{ $supplier->supplierId }}">{{ $supplier->supplierName }}</option>
                                      @endif
                                  @endforeach
                                </select>
                              </div>
                            </div>
                              
                          </td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                        @endforeach
                      </tbody>
                    </table>
                    </div>
                    @else
                      <p class="text-center">No data available in table</p>
                    @endif
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="/assetPurchase" class="btn btn-default">Cancel</a>
                  <button type="submit" name="submit" class="btn btn-primary float-right">Save</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->
        </div>
        {{-- <div class="col-xl-6">
          <!-- Horizontal Form -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Form Create Procurement</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <!-- form start -->
            @if (count($assetProcurementDevices) > 0)
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Device</th>
                  <th>Device Image</th>
                  <th>Quantity</th>
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
                  <td><img src="{{ asset('storage/' .  $assetProcurementDevice->assetModel->assetModelImage ) }}" alt="{{ $assetProcurementDevice->assetModel->assetModelName }}" class="img-responsive" style="max-height: 30px; width: auto;"></td>
                  <td>{{ $assetProcurementDevice->assetProcurementDeviceQuantity }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @else
              <p class="text-center">No data available in table</p>
            @endif
            </div>
          </div>
          <!-- /.card -->
        </div> --}}
      </div>
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection