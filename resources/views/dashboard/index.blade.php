@extends('layouts/main')
@section('container')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $assetCount }}</h3>

                <p>Assets</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-barcode"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $licenseCount }}</h3>

                <p>License</p>
              </div>
              <div class="icon">
                <i class="fa-regular fa-floppy-disk"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-purple">
              <div class="inner">
                <h3>{{ $accessoryCount }}</h3>

                <p>Accessories</p>
              </div>
              <div class="icon">
                <i class="fa-regular fa-keyboard"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $consumableCount }}</h3>

                <p>Consumable</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-droplet"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{ $componentCount }}</h3>

                <p>Component</p>
              </div>
              <div class="icon">
                <i class="fa-regular fa-hard-drive"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>{{ $userCount }}</h3>

                <p>User</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-users"></i>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>

                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk of the card's
                  content.
                </p>

                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header">
                <h5 class="m-0">Asset Deployment by Status</h5>
              </div>
              <div class="card-body">
                @if ($label)
                <div class="chart">
                  <canvas id="dashboard-pie"></canvas>
                </div>
                @else
                <div class="text-center">
                  <i class="align-middle mb-2" data-feather="alert-circle"></i>
                  <h5>Data is still empty</h5>
                </div>
                @endif 
              </div>
            </div>

            
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    var label =  {{ Js::from($label) }};
    var total =  {{ Js::from($total) }};

    document.addEventListener("DOMContentLoaded", function() {
      // Pie chart
      new Chart(document.getElementById("dashboard-pie"), {
        type: "pie",
        data: {
          labels: label,
          datasets: [{
            data: total,
            borderWidth: 1
          }]
        },
        options: {
          responsive: !window.MSInputMethodContext,
          maintainAspectRatio: false,
          legend: {
            display: true,
            position: 'right'
          },
          cutoutPercentage: 60
        }
      });
    });
  </script>

  @endsection

  