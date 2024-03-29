<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="" class="brand-link">
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
        @if($menuData['assetIndex']['index'])
        <li class="nav-item">
          <a href="/asset" class="nav-link {{ Request::is('asset', 'asset/detail*') ? 'active' : '' }}">
            <i class="far fa fa-laptop nav-icon"></i>
            <p>My Asset</p>
          </a>
        </li>
        @endif
        @if($menuData['assetProcurementAllIndex']['index'] || $menuData['assetProcurementIndex']['index'] || $menuData['assetProcurementApprovalManager']['index'] || $menuData['assetProcurementApprovalITManager']['index'] || $menuData['assetPurchaseIndex']['index'])      
          <li class="nav-item {{ Request::is('assetProcurement*', 'assetPurchase*', 'assetMovement*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('assetProcurement*', 'assetPurchase*', 'assetMovement*',) ? 'active' : '' }}">
              <i class="nav-icon fas fa fa-truck"></i>
              <p>
                Asset Procurement
                <i class="right fas fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if($menuData['assetProcurementAllIndex']['index'])
              <li class="nav-item">
                <a href="/assetProcurementAll" class="nav-link {{ Request::is('assetProcurementAll*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Procurement</p>
                </a>
              </li>
              @endif
              @if($menuData['assetProcurementIndex']['index'])
              <li class="nav-item">
                <a href="/assetProcurement" class="nav-link {{ Request::is('assetProcurement', 'assetProcurement/create', 'assetProcurement/device*', 'assetProcurement/detail*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My Procurement</p>
                </a>
              </li>
              @endif
              @if($menuData['assetProcurementApprovalManager']['index'])
              <li class="nav-item">
                <a href="/assetProcurementApprovalManager" class="nav-link {{ Request::is('assetProcurementApprovalManager*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approval Manager</p>
                </a>
              </li>
              @endif
              @if($menuData['assetProcurementApprovalITManager']['index'])
              <li class="nav-item">
                <a href="/assetProcurementApprovalITManager" class="nav-link {{ Request::is('assetProcurementApprovalITManager*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approval IT Manager</p>
                </a>
              </li>
              @endif
              @if($menuData['assetPurchaseIndex']['index'])
              <li class="nav-item">
                <a href="/assetPurchase" class="nav-link {{ Request::is('assetPurchase*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Asset Purchase</p>
                </a>
              </li>
              @endif
              {{-- @if($menuData['assetPurchaseIndex']['index']) --}}
              <li class="nav-item">
                <a href="/assetMovement" class="nav-link {{ Request::is('assetMovement*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Asset Movement</p>
                </a>
              </li>
              {{-- @endif --}}
            </ul>
          </li>
        @endif
        @if($menuData['assetDeploymentAllIndex']['index'] || $menuData['assetPreDeploymentIndex']['index'] || $menuData['assetDeploymentReadyIndex']['index'] || $menuData['assetDeploymentCheckoutIndex']['index'])     
          <li class="nav-item {{ Request::is('assetDeployment*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('assetDeployment*') ? 'active' : '' }}">
              <i class="nav-icon fas fa fa-globe"></i>
              <p>
                Asset Deployment
                <i class="right fas fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if($menuData['assetDeploymentAllIndex']['index'])
              <li class="nav-item">
                <a href="/assetDeploymentAll" class="nav-link {{ Request::is('assetDeploymentAll*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Deployment</p>
                </a>
              </li>
              @endif
              @if($menuData['assetPreDeploymentIndex']['index'])
              <li class="nav-item">
                <a href="/assetDeploymentPre" class="nav-link {{ Request::is('assetDeploymentPre*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pre-Deployment</p>
                </a>
              </li>
              @endif
              @if($menuData['assetDeploymentReadyIndex']['index'])
              <li class="nav-item">
                <a href="/assetDeploymentReady" class="nav-link {{ Request::is('assetDeploymentReady*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Deployment Ready</p>
                </a>
              </li>
              @endif
              @if($menuData['assetDeploymentCheckoutIndex']['index'])
              <li class="nav-item">
                <a href="/assetDeploymentCheckout" class="nav-link {{ Request::is('assetDeploymentCheckout*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Deployment Checkout</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
        @endif
        @if($menuData['assetArchiveIndex']['index'])
        <li class="nav-item">
          <a href="/assetArchive" class="nav-link {{ Request::is('assetArchive*') ? 'active' : '' }}">
            <i class="far fa fa-box-open nav-icon"></i>
            <p>Asset Archive</p>
          </a>
        </li>
        @endif
        @if($menuData['assetRepairIndex']['index'])
        <li class="nav-item">
          <a href="/assetRepair" class="nav-link {{ Request::is('assetRepair*') ? 'active' : '' }}">
            <i class="far fa fa-toolbox nav-icon"></i>
            <p>Asset Repair</p>
          </a>
        </li>
        @endif
        @if($menuData['assetBrokenIndex']['index'])
        <li class="nav-item">
          <a href="/assetBroken" class="nav-link {{ Request::is('assetBroken*') ? 'active' : '' }}">
            <i class="far fa fa-exclamation nav-icon"></i>
            <p>Asset Broken</p>
          </a>
        </li>
        @endif
        @if($menuData['assetDisposalIndex']['index'])
        <li class="nav-item">
          <a href="/assetDisposal" class="nav-link {{ Request::is('assetDisposal*') ? 'active' : '' }}">
            <i class="far fa fa-trash nav-icon"></i>
            <p>Asset Disposal</p>
          </a>
        </li>
        @endif
        @if($menuData['assetDepreciationIndex']['index'])
        <li class="nav-item">
          <a href="/assetDepreciation" class="nav-link {{ Request::is('assetDepreciation*') ? 'active' : '' }}">
            <i class="far fa fa-clock nav-icon"></i>
            <p>Asset Depreciation</p>
          </a>
        </li>
        @endif
        @if($menuData['supplierIndex']['index'] || $menuData['manufactureIndex']['index'] || $menuData['categoryIndex']['index'] || $menuData['depreciationIndex']['index'] || $menuData['assetModelIndex']['index'])
        <li class="nav-item {{ Request::is('supplier*', 'manufacture*', 'category*', 'accessoryModel*', 'assetModel*', 'depreciation*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('supplier*', 'manufacture*', 'category*', 'accessoryModel*', 'assetModel*', 'depreciation*') ? 'active' : '' }}">
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
            @if($menuData['depreciationIndex']['index'])
            <li class="nav-item">
              <a href="/depreciation" class="nav-link {{ Request::is('depreciation*') ? 'active' : '' }}">
                <i class="far fa fa-clock nav-icon"></i>
                <p>Depreciation</p>
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
          <a href="#" class="nav-link" id="logoutLink">
              <i class="far fa fa-arrow-left nav-icon"></i>
              <p>Logout</p>
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

<script>
  document.getElementById('logoutLink').addEventListener('click', function(event) {
      event.preventDefault(); // Menghentikan link agar tidak langsung terjadi redirect

      Swal.fire({
          title: 'Are you sure?',
          text: "You will be logged out.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, log me out!'
      }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = '/logout'; // Redirect ke URL logout
          }
      });
  });
</script>