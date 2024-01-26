<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    {{-- <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
    <span class="brand-text font-weight-light">IT Asset Management</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ auth()->user()->employeeName }}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        {{-- <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Starter Pages
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link active">
                <i class="far fa-circle nav-icon"></i>
                <p>Active Page</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Inactive Page</p>
              </a>
            </li>
          </ul>
        </li> --}}
        <li class="nav-item">
          <a href="/dashboard" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
            <i class="nav-icon fas fa fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item {{ Request::is('company*', 'location*', 'departement*', 'position*', 'user*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('company*', 'location*', 'departement*', 'position*', 'user*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Master Data
              <i class="right fas fa fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @if (auth()->user()->employeeNumber == '1234567892')
            <li class="nav-item">
              <a href="/company" class="nav-link {{ Request::is('company*') ? 'active' : '' }}">
                <i class="far fa fa-building nav-icon"></i>
                <p>Company</p>
              </a>
            </li>
            @endif
            <li class="nav-item">
              <a href="/location" class="nav-link {{ Request::is('location*') ? 'active' : '' }}">
                <i class="far fa fa-map nav-icon"></i>
                <p>Location</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/departement" class="nav-link {{ Request::is('departement*') ? 'active' : '' }}">
                <i class="far fa fa-briefcase nav-icon"></i>
                <p>Departement</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/position" class="nav-link {{ Request::is('position*') ? 'active' : '' }}">
                <i class="far fa fa-feather nav-icon"></i>
                <p>Position</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/user" class="nav-link {{ Request::is('user*') ? 'active' : '' }}">
                <i class="far fa fa-user nav-icon"></i>
                <p>User</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="/logout" class="nav-link">
            <i class="nav-icon fa fa-right-from-bracket"></i>
            <p>
              Logout
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
  <div class="p-3">
    <h5>Title</h5>
    <p>Sidebar content</p>
  </div>
</aside>
<!-- /.control-sidebar -->