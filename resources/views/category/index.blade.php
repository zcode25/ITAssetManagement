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
            <h1>Category</h1>
          </div>
          <div class="col-sm-6">
            <div class="float-sm-right">
              @if($menuData['categoryCreate']['index'])
              <a href="/category/create" class="btn btn-primary">Create New</a>
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
          <h3 class="card-title">Category List</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <table id="example1" class="table table-hover">
            <thead>
            <tr>
              <th>Category</th>
              <th>Type</th>
              @if($menuData['categoryEdit']['index'] || $menuData['categoryDelete']['index'])
              <th>Action</th>
              @endif
            </tr>
            </thead>
            <tbody>
            @foreach ($categories as $category)
            <tr>
              <td>{{ $category->categoryName }}</td>
              <td>{{ $category->categoryType }}</td>
              @if($menuData['categoryEdit']['index'] || $menuData['categoryDelete']['index'])
              <td class="py-0 align-middle">
                <div class="btn-group btn-group-sm">
                  @if($menuData['categoryEdit']['index'])
                  <a href="/category/edit/{{ $category->categoryId }}" class="btn btn-primary">Edit</a>
                  @endif
                  @if($menuData['categoryDelete']['index'])
                  <a href="/category/destroy/{{ $category->categoryId }}" class="btn btn-danger" data-confirm-delete="true">Delete</a>
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

@endsection