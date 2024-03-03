@extends('layouts/main')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Accessory Model</h1>
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
                <h3 class="card-title">Form Create Accessory Model</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/accessoryModel/store" method="POST" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="accessoryModelName" class="form-label">Accessory Model Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('accessoryModelName') is-invalid @enderror" id="accessoryModelName" name="accessoryModelName" value="{{ old('accessoryModelName') }}">
                    @error('accessoryModelName') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="categoryId" class="form-label">Category <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4" id="categoryId" name="categoryId" data-placeholder="Select a Category">
                      <option value=""></option>
                      @foreach ($categories as $category)
                          @if (old('categoryId') == $category->categoryId)
                              <option value="{{ $category->categoryId }}" selected>{{ $category->categoryName }}</option>
                              @else
                              <option value="{{ $category->categoryId }}">{{ $category->categoryName }}</option>
                          @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="manufactureId" class="form-label">Manufacture <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4" id="manufactureId" name="manufactureId" data-placeholder="Select a Manufacture">
                      <option value=""></option>
                      @foreach ($manufactures as $manufacture)
                          @if (old('manufactureId') == $manufacture->manufactureId)
                              <option value="{{ $manufacture->manufactureId }}" selected>{{ $manufacture->manufactureName }}</option>
                              @else
                              <option value="{{ $manufacture->manufactureId }}">{{ $manufacture->manufactureName }}</option>
                          @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="accessoryModelNumber" class="form-label">Model No. <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('accessoryModelNumber') is-invalid @enderror" id="accessoryModelNumber" name="accessoryModelNumber" value="{{ old('accessoryModelNumber') }}">
                    @error('accessoryModelNumber') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="accessoryModelImage" class="form-label">Image <span class="text-danger">*</span></label>
                    <input type="file" class="form-control @error('accessoryModelImage') is-invalid @enderror" id="accessoryModelImage" name="accessoryModelImage" value="{{ old('accessoryModelImage') }}">
                    @error('accessoryModelImage') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="/accessoryModel" class="btn btn-default">Cancel</a>
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