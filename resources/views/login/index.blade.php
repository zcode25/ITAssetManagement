@extends('layouts.login')
@section('container')
    <div class="container">
      <div class="row align-items-center justify-content-center" style="min-height: 100vh">
        <div class="col-xl-6 col-md-8">
          <div class="row">
            <div class="col">
              @if (session()->has('loginError'))  
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{ session('loginError') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
            </div>
          </div>
          <div class="card">
            <div class="card-body p-4">
              <div class="row">
                <div class="col text-center">
                  <h3>IT Asset Management</h3>
                  <p>Welcome, please login.</p>
                  <hr>
                </div>
              </div>
              
              <div class="row">
                <div class="col">
                  <form action="/login/authenticate" method="POST">
                    @csrf
                    <div class="mb-3">
                      <input type="text" class="form-control @error('employeeNumber') is-invalid @enderror" id="employeeNumber" placeholder="Employee Number" name="employeeNumber" autocomplete="off">
                      @error('employeeNumber') 
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password">
                      @error('password') 
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="d-grid gap-2">
                      <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> 
@endsection