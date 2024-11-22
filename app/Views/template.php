<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Point Of Sales</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href=<?php echo base_url("assets/plugins/fontawesome-free/css/all.min.css"); ?>>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Theme style -->
  <script src=<?= base_url("assets/plugins/jquery/jquery.min.js") ?>></script>
  <link rel="stylesheet" href=<?= base_url("assets/dist/css/adminlte.min.css") ?>>
  <link rel="stylesheet" href=<?= base_url("assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"); ?>>
  <link rel="stylesheet" href=<?= base_url("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css"); ?>>
  <link rel="stylesheet" href=<?= base_url("assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css"); ?>>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
  <style>
    .aktif {
      background-color: #676b6f7d !important;
      color: white !important;
    }
    .aktif2 {
      background-color: #52525240 !important;
      color: white !important;
    }
  </style>

</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>
        <!-- User Account -->
        <li>
          <a class="nav-link" href="<?= base_url('logout') ?>">Logout</a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="" class="brand-link">
        <img src="<?= base_url("/assets/dist/img/AdminLTELogo.png") ?>" alt="AdminLTE Logo"
          class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">POS</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?= base_url("assets/dist/img/user2-160x160.jpg") ?>" class="img-circle elevation-2"
              alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo session()->get('name') ?></a>
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
            <li class="nav-header">MAIN NAVIGATION</li>
            <li class="nav-item ">
              <a href="<?= base_url('dashboard') ?>"
                class="nav-link <?= (request()->getUri()->getSegment(1) == 'dashboard') || (request()->getUri()->getSegment(1) == '') ? 'aktif' : '' ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('suppliers') ?>"
                class="nav-link <?= (request()->getUri()->getSegment(1) == 'suppliers') ? 'aktif' : '' ?>">
                <i class="nav-icon fas fa-truck"></i>
                <p>Suppliers</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('customers') ?>"
                class="nav-link <?= (request()->getUri()->getSegment(1) == 'customers') ? 'aktif' : '' ?>">
                <i class="nav-icon fas fa-users"></i>
                <p>Customers</p>
              </a>
            </li>
            <li
              class="nav-item <?= (request()->getUri()->getSegment(1) == 'products' && in_array(request()->getUri()->getSegment(2), ['categories', 'units', 'items'])) ? 'menu-open' : '' ?>">
              <a href="#"
                class="nav-link <?= (request()->getUri()->getSegment(1) == 'products' && in_array(request()->getUri()->getSegment(2), ['categories', 'units', 'items'])) ? 'aktif' : '' ?>">
                <i class="nav-icon fas fa-archive"></i>
                <p>
                  Products
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('products/categories') ?>"
                    class="nav-link <?= (request()->getUri()->getSegment(1) == 'products' && request()->getUri()->getSegment(2) == 'categories') ? 'aktif2' : '' ?>">
                    <i class=" nav-icon <?= (request()->getUri()->getSegment(1) == 'products' && request()->getUri()->getSegment(2) == 'categories') ? 'fas fa-dot-circle' : 'far fa-circle' ?>"></i>
                    <p>Categories</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('products/units') ?>"
                    class="nav-link <?= (request()->getUri()->getSegment(1) == 'products' && request()->getUri()->getSegment(2) == 'units') ? 'aktif2' : '' ?>">
                    <i class="nav-icon <?= (request()->getUri()->getSegment(1) == 'products' && request()->getUri()->getSegment(2) == 'units') ? 'fas fa-dot-circle' : 'far fa-circle' ?>"></i>
                    <p>Units</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('products/items') ?>"
                    class="nav-link <?= (request()->getUri()->getSegment(1) == 'products' && request()->getUri()->getSegment(2) == 'items') ? 'aktif2' : '' ?>">
                    <i class="nav-icon <?= (request()->getUri()->getSegment(1) == 'products' && request()->getUri()->getSegment(2) == 'items') ? 'fas fa-dot-circle' : 'far fa-circle' ?>"></i>
                    <p>Items</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item <?= (request()->getUri()->getSegment(1) == 'trancactions' && in_array(request()->getUri()->getSegment(2), ['stocks', 'sales'])) ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?= (request()->getUri()->getSegment(1) == 'products' && in_array(request()->getUri()->getSegment(2), ['stocks', 'sales'])) ? 'aktif' : '' ?>">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>
                  Trancaction
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url("trancactions/sales")?>" class="nav-link <?= (request()->getUri()->getSegment(1) == 'trancactions' && request()->getUri()->getSegment(2) == 'sales') ? 'aktif2' : '' ?>">
                    <i class="nav-icon <?= (request()->getUri()->getSegment(1) == 'trancactions' && request()->getUri()->getSegment(2) == 'sales') ? 'fas fa-dot-circle' : 'far fa-circle' ?>"></i>
                    <p>Sales</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href=<?= base_url("trancactions/stocks/in")?>  class="nav-link <?= (request()->getUri()->getSegment(1) == 'trancactions' && request()->getUri()->getSegment(3) == 'in') ? 'aktif2' : '' ?>">
                    <i class="nav-icon <?= (request()->getUri()->getSegment(1) == 'trancactions' && request()->getUri()->getSegment(3) == 'in') ? 'fas fa-dot-circle' : 'far fa-circle' ?>"></i>
                    <p>Stock In</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url("trancactions/stocks/out")?>" class="nav-link <?= (request()->getUri()->getSegment(1) == 'trancactions' && request()->getUri()->getSegment(3) == 'out') ? 'aktif2' : '' ?>">
                    <i class="nav-icon <?= (request()->getUri()->getSegment(1) == 'trancactions' && request()->getUri()->getSegment(3) == 'out') ? 'fas fa-dot-circle' : 'far fa-circle' ?>"></i>
                    <p>Stock Out</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  Reports
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../tables/simple.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Sales</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../tables/data.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Stocks</p>
                  </a>
                </li>
              </ul>
            </li>


            <?php
            // Retrieve user level from session
            $userLevel = session()->get('level');
            ?>

            <?php if ($userLevel == 1): ?>
              <li class="nav-header">SETTINGS</li>
              <li class="nav-item">
                <a href="<?= base_url('users'); ?>" class="nav-link">
                  <i class="nav-icon fas fa-user"></i>
                  <p>Users</p>
                </a>
              </li>
            <?php endif; ?>
          </ul>
        </nav>
      </div>
    </aside>

    <div class="content-wrapper">
      <?php echo $contents ?>
    </div>

    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src=<?= base_url("assets/plugins/jquery/jquery.min.js") ?>></script>
  <script src=<?= base_url("assets/plugins/bootstrap/js/bootstrap.bundle.min.js") ?>></script>
  <script src=<?= base_url("assets/plugins/datatables/jquery.dataTables.min.js"); ?>></script>
  <script src=<?= base_url("assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"); ?>></script>
  <script src=<?= base_url("assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"); ?>></script>
  <script src=<?= base_url("assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"); ?>></script>
  <script src=<?= base_url("assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"); ?>></script>
  <script src=<?= base_url("assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"); ?>></script>
  <script src=<?= base_url("assets/plugins/jszip/jszip.min.js"); ?>></script>
  <script src=<?= base_url("assets/plugins/pdfmake/pdfmake.min.js"); ?>></script>
  <script src=<?= base_url("assets/plugins/pdfmake/vfs_fonts.js"); ?>></script>
  <script src=<?= base_url("assets/plugins/datatables-buttons/js/buttons.html5.min.js"); ?>></script>
  <script src=<?= base_url("assets/plugins/datatables-buttons/js/buttons.print.min.js"); ?>></script>
  <script src=<?= base_url("assets/plugins/datatables-buttons/js/buttons.colVis.min.js"); ?>></script>
  <!-- AdminLTE App -->
  <!-- AdminLTE App -->
  <script src=<?= base_url("assets/dist/js/adminlte.min.js") ?>></script>
  <!-- AdminLTE for demo purposes -->
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
    $(function () {
      $("#tabel1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false
      }).buttons().container().appendTo('#tabel1_wrapper .col-md-6:eq(0)');
    });
  </script>
</body>

</html>