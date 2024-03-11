@extends('layouts/main')
@section('container')
@php
$jsonData = auth()->user()->permission;
$menuData = json_decode($jsonData, true);
@endphp

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Asset Model</h1>
          </div>
          <div class="col-sm-6">
            <div class="float-sm-right">
              @if($menuData['assetModelCreate']['index'])
              <a href="/assetModel/create" class="btn btn-primary">Create New</a>
              @endif
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
          <h3 class="card-title">Asset Model List</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">

          <div class="row">
            <div class="col-xl-4 col-md-6">
              <div class="card-filter mb-3">
                <label for="categoryTypeFilter" class="form-label">Category Type</label>
                <select id="categoryTypeFilter" class="form-control custom-select">
                  <option value="">All Categories</option>
                  <option value="Asset">Asset</option>
                  <option value="Accessory">Accessory</option>
                  <option value="Consumable">Consumable</option>
                  <option value="Component">Component</option>
                  <option value="License">License</option>
                </select>
              </div>
            </div>
          </div>

          <table id="example1" class="table table-hover">
            <thead>
            <tr>
              <th>Name</th>
              <th>Image</th>
              <th>Model No.</th>
              <th>Category</th>
              <th>Type</th>
              <th>Manufacture</th>
              @if($menuData['assetModelEdit']['index'] || $menuData['assetModelDelete']['index'])
              <th>Action</th>
              @endif
            </tr>
            </thead>
            <tbody>
            @foreach ($assetModels as $assetModel)
            <tr>
              <td>{{ $assetModel->assetModelName }}</td>
              <td><img src="{{ asset('storage/' .  $assetModel->assetModelImage ) }}" alt="{{ $assetModel->assetModelName }}" class="img-responsive" style="max-height: 30px; width: auto;"></td>
              <td>{{ $assetModel->assetModelNumber }}</td>
              <td>{{ $assetModel->category->categoryName }}</td>
              <td>{{ $assetModel->category->categoryType }}</td>
              <td>{{ $assetModel->manufacture->manufactureName }}</td>
              @if($menuData['assetModelEdit']['index'] || $menuData['assetModelDelete']['index'])
              <td class="py-0 align-middle">
                <div class="btn-group btn-group-sm">
                  @if($menuData['assetModelEdit']['index'])
                  <a href="/assetModel/edit/{{ $assetModel->assetModelId }}" class="btn btn-primary">Edit</a>
                  @endif
                  @if($menuData['assetModelDelete']['index'])
                  <a href="/assetModel/destroy/{{ $assetModel->assetModelId }}" class="btn btn-danger" data-confirm-delete="true">Delete</a>
                  @endif
                </div>
              </td>
              @endif
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

  <script>
    document.addEventListener("DOMContentLoaded", function(){
      // Fungsi untuk memfilter tabel
      function filterTable(categoryType) {
        const rows = document.querySelectorAll("#example1 tbody tr");
    
        rows.forEach(row => {
          const tdCategoryType = row.querySelector("td:nth-child(6)").textContent;
          if (categoryType === "" || tdCategoryType === categoryType) {
            row.style.display = "";
          } else {
            row.style.display = "none";
          }
        });
      }
    
      // Event listener untuk dropdown filter
      document.querySelector("#categoryTypeFilter").addEventListener("change", function() {
        filterTable(this.value);
      });
    });
  </script>

@endsection