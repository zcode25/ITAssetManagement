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
        @if($menuData['dashboardIndex']['index'])
        <li class="nav-item">
          <a href="/dashboard" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
            <i class="nav-icon fas fa fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        @endif
        {{-- @if($menuData['supplierIndex']['index'] || $menuData['manufactureIndex']['index'] || $menuData['categoryIndex']['index'] || $menuData['accessoryModelIndex']['index'] || $menuData['assetModelIndex']['index']) --}}
        <li class="nav-item {{ Request::is('procurement*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('procurement*') ? 'active' : '' }}">
            <i class="nav-icon fas fa fa-barcode"></i>
            <p>
              Asset
              <i class="right fas fa fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            {{-- @if($menuData['assetModelIndex']['index']) --}}
            <li class="nav-item">
              <a href="/assetProcurement" class="nav-link {{ Request::is('assetProcurement*') ? 'active' : '' }}">
                <i class="far fa fa-store nav-icon"></i>
                <p>Procurement</p>
              </a>
            </li>
            {{-- @endif --}}
          </ul>
        </li>
        {{-- @endif --}}
        @if($menuData['supplierIndex']['index'] || $menuData['manufactureIndex']['index'] || $menuData['categoryIndex']['index'] || $menuData['accessoryModelIndex']['index'] || $menuData['assetModelIndex']['index'])
        <li class="nav-item {{ Request::is('supplier*', 'manufacture*', 'category*', 'accessoryModel*', 'assetModel*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('supplier*', 'manufacture*', 'category*', 'accessoryModel*', 'assetModel*') ? 'active' : '' }}">
            <i class="nav-icon fas fa fa-box"></i>
            <p>
              Master Asset
              <i class="right fas fa fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @if($menuData['assetModelIndex']['index'])
            <li class="nav-item">
              <a href="/assetModel" class="nav-link {{ Request::is('assetModel*') ? 'active' : '' }}">
                <i class="far fa fa-barcode nav-icon"></i>
                <p>Asset Model</p>
              </a>
            </li>
            @endif
            @if($menuData['accessoryModelIndex']['index'])
            <li class="nav-item">
              <a href="/accessoryModel" class="nav-link {{ Request::is('accessoryModel*') ? 'active' : '' }}">
                <i class="far fa fa-keyboard nav-icon"></i>
                <p>Accessory Model</p>
              </a>
            </li>
            @endif
            @if($menuData['categoryIndex']['index'])
            <li class="nav-item">
              <a href="/category" class="nav-link {{ Request::is('category*') ? 'active' : '' }}">
                <i class="far fa fa-layer-group nav-icon"></i>
                <p>Category</p>
              </a>
            </li>
            @endif
            @if($menuData['manufactureIndex']['index'])
            <li class="nav-item">
              <a href="/manufacture" class="nav-link {{ Request::is('manufacture*') ? 'active' : '' }}">
                <i class="far fa fa-industry nav-icon"></i>
                <p>Manufacture</p>
              </a>
            </li>
            @endif
            @if($menuData['supplierIndex']['index'])
            <li class="nav-item">
              <a href="/supplier" class="nav-link {{ Request::is('supplier*') ? 'active' : '' }}">
                <i class="far fa fa-truck nav-icon"></i>
                <p>Supplier</p>
              </a>
            </li>
            @endif
          </ul>
        </li>
        @endif
        @if($menuData['companyIndex']['index'] || $menuData['locationIndex']['index'] || $menuData['departementIndex']['index'] || $menuData['positionIndex']['index'] || $menuData['userIndex']['index'])
        <li class="nav-item {{ Request::is('company*', 'location*', 'departement*', 'position*', 'user*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('company*', 'location*', 'departement*', 'position*', 'user*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Master User
              <i class="right fas fa fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @if($menuData['companyIndex']['index'])
            <li class="nav-item">
              <a href="/company" class="nav-link {{ Request::is('company*') ? 'active' : '' }}">
                <i class="far fa fa-building nav-icon"></i>
                <p>Company</p>
              </a>
            </li>
            @endif
            @if($menuData['locationIndex']['index'])
            <li class="nav-item">
              <a href="/location" class="nav-link {{ Request::is('location*') ? 'active' : '' }}">
                <i class="far fa fa-map nav-icon"></i>
                <p>Location</p>
              </a>
            </li>
            @endif
            @if($menuData['departementIndex']['index'])
            <li class="nav-item">
              <a href="/departement" class="nav-link {{ Request::is('departement*') ? 'active' : '' }}">
                <i class="far fa fa-briefcase nav-icon"></i>
                <p>Departement</p>
              </a>
            </li>
            @endif
            @if($menuData['positionIndex']['index'])
            <li class="nav-item">
              <a href="/position" class="nav-link {{ Request::is('position*') ? 'active' : '' }}">
                <i class="far fa fa-feather nav-icon"></i>
                <p>Position</p>
              </a>
            </li>
            @endif
            @if($menuData['userIndex']['index'])
            <li class="nav-item">
              <a href="/user" class="nav-link {{ Request::is('user*') ? 'active' : '' }}">
                <i class="far fa fa-user nav-icon"></i>
                <p>User</p>
              </a>
            </li>
            @endif
          </ul>
        </li>
        @endif
        <li class="nav-item">
          <a href="/logout" class="nav-link">
            <i class="far fa fa-arrow-left nav-icon text-danger"></i>
            <p class="text-danger">
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