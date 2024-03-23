@extends('layouts/main')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Depreciation</h1>
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
                <h3 class="card-title">Form Create Depreciation</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/depreciation/update/{{ $depreciation->depreciationId }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="depreciationName" class="form-label">Depreciation Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('depreciationName') is-invalid @enderror" id="depreciationName" name="depreciationName" value="{{ old('depreciationName', $depreciation->depreciationName) }}">
                    @error('depreciationName') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="categoryId" class="form-label">Category <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4" id="categoryId" name="categoryId" data-placeholder="Select a Category">
                      <option value=""></option>
                      @foreach ($categories as $category)
                          @if (old('categoryId', $depreciation->categoryId) == $category->categoryId)
                              <option value="{{ $category->categoryId }}" selected>{{ $category->categoryName }}</option>
                              @else
                              <option value="{{ $category->categoryId }}">{{ $category->categoryName }}</option>
                          @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="depreciationUseful" class="form-label">Useful Period (years) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('depreciationUseful') is-invalid @enderror" id="depreciationUseful" name="depreciationUseful" value="{{ old('depreciationUseful', $depreciation->depreciationUseful) }}">
                    @error('depreciationUseful') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="depreciationResidual" class="form-label">Residual Value <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('depreciationResidual') is-invalid @enderror" id="depreciationResidual" name="depreciationResidual" value="{{ old('depreciationResidual', $depreciation->depreciationResidual) }}">
                    @error('depreciationResidual') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="/assetModel" class="btn btn-default">Cancel</a>
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