@extends('layouts/main')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Category</h1>
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
                <h3 class="card-title">Form Update Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/category/update/{{ $category->categoryId }}" method="POST" class="form-horizontal">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="categoryName" class="form-label">Category Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('categoryName') is-invalid @enderror" id="categoryName" name="categoryName" value="{{ old('categoryName', $category->categoryName) }}">
                    @error('categoryName') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="categoryType" class="form-label">Type <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4" id="categoryType" name="categoryType">
                        @foreach($types as $type)
                            @if (old('categoryType', $category->categoryType) == $type['type'])
                                <option value="{{ $type['type'] }}" selected = "selected">{{ $type['type'] }}</option>
                            @else
                                <option value="{{ $type['type'] }}">{{ $type['type'] }}</option>
                            @endif
                        @endforeach
                    </select>
                  </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="/category" class="btn btn-default">Cancel</a>
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