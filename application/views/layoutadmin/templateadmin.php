<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>The Crabbys Management System | <?= $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Favicon -->
  <link rel="shortcut icon" href="<?= base_url() ?>assets/logo/logo.png" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="<?= base_url() ?>template/belle/assets/css/sweetalert2.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/toastr/toastr.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    .swal2-popup {
      font-size: 1.6rem !important;
    }
  </style>
</head>

<body class="hold-transition skin-red-light sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="<?= base_url('admin') ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>CRBS</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>THE</b>Crabbys</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown notifications-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                <i class="fa fa-bell-o"></i>
                <span class="label label-warning" id="notif-total"></span>
              </a>
              <ul class="dropdown-menu" id="notif">

              </ul>
            </li>
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?= base_url('assets/gambar_admin/') . $user['image']; ?>" class="user-image" alt="User Image">
                <span class="hidden-xs"><?= $this->session->userdata('nama'); ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="<?= base_url('assets/gambar_admin/') . $user['image']; ?>" class="img-circle" alt="User Image">

                  <p>
                    <?= $this->session->userdata('nama'); ?>
                    <small><?php if ($user['role_id'] == 1) {
                              echo "Owner";
                            } else {
                              echo "Admin";
                            } ?></small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?= base_url('admin/profile'); ?>" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="#" data-toggle="modal" data-target="#ModalLogout" class="btn btn-default btn-flat">Logout</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button 
            <li>
              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
            -->
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?= base_url('assets/gambar_admin/') . $user['image']; ?>" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?= $this->session->userdata('nama'); ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

          <?php
          $role_id = $this->session->userdata('role_id');
          $queryMenu = "SELECT * FROM `tabel_menu_admin` JOIN `tabel_admin_access_menu` ON `tabel_menu_admin`.`menu_id` = `tabel_admin_access_menu`.`menu_id` WHERE `tabel_admin_access_menu`.`role_id`= $role_id AND `tabel_menu_admin`.`parent`=0 ORDER BY `tabel_admin_access_menu`.`menu_id` ASC
                ";

          $menu = $this->db->query($queryMenu)->result_array();

          foreach ($menu as $m) : ?>
            <li class="header"><i class="fa <?= $m['icon'] ?>"></i> <?= $m['nama_menu'] ?></li>

            <!-- Siapkan sub menu sesuai menu-->
            <?php
            $menuId = $m['menu_id'];
            $querySubMenu = "SELECT * FROM `tabel_menu_admin` JOIN `tabel_admin_access_menu` ON `tabel_menu_admin`.`menu_id` = `tabel_admin_access_menu`.`menu_id` WHERE `tabel_admin_access_menu`.`role_id`= $role_id AND `tabel_menu_admin`.`parent`=$menuId ORDER BY `tabel_admin_access_menu`.`menu_id` ASC";

            $subMenu = $this->db->query($querySubMenu)->result_array();

            ?>
            <?php
            foreach ($subMenu as $sm) : ?>
              <?php if ($aktif == $sm['nama_menu']) : ?>
                <!-- Nav Item - Dashboard -->
                <li class="active">
                <?php else : ?>
                <li>
                <?php endif; ?>
                <a href="<?= base_url('admin/') . $sm['link'] ?>">
                  <i class="fa <?= $sm['icon'] ?>"></i> <span><?= $sm['nama_menu'] ?></span>
                  <span class="pull-right-container">
                    <small class="label pull-right bg-red" id="<?= $sm['link'] ?>"></small>
                  </span>
                </a>
                </li>
              <?php endforeach; ?>
            <?php endforeach; ?>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <?= $title; ?>
          <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?= base_url('admin/profile'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active"><?= $title; ?></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <?php echo $contents ?>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.2.1
      </div>
      <strong>Copyright &copy; <?= date('Y') ?> <a href="#">The Crabbys</a>.</strong> All rights
      reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Create the tabs -->
      <ul class="nav nav-tabs nav-justified control-sidebar-tabs">

      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab">
          <!-- /.control-sidebar-menu -->
        </div>
        <!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        <!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
        </div>
        <!-- /.tab-pane -->
      </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->

</body>

<!--MODAL LOGOUT-->
<div class="modal fade" id="ModalLogout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Logout</h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-warning">
          <p>Apakah Anda yakin Logout?</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <a href="<?= base_url('admin/auth/logout') ?>" class="btn_hapus btn btn-danger" name="btn_logout" id="btn_logout">Logout</a>
      </div>
    </div>
  </div>
</div>
<!--END MODAL LOGOUT-->

<!-- notify.js -->
<script src="<?php echo base_url() ?>assets/js/bootstrap-notify.js"></script>
<link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-material-ui/material-ui.css" rel="stylesheet">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url() ?>assets/toastr/toastr.min.js"></script>
<script src="https://js.pusher.com/5.1/pusher.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $.ajax({
      type: "POST",
      url: "<?= base_url('admin/notification/notify') ?>",
      dataType: "JSON",
      data: {},
      success: function(data) {
        $("#notif-total").html(data.total);
        $("#transaksi").html(data.total);
        $("#notif").html(data.result);
      }
    });
  });

  // Enable pusher logging - don't include this in production
  //Pusher.logToConsole = true;

  var pusher = new Pusher('53605ae7340f790a342a', {
    cluster: 'ap1',
    forceTLS: true
  });

  var channel = pusher.subscribe('adminNotif');
  channel.bind('settlement', function(data) {
    var order_id = data.id;
    if ($("#tabel").length) {
      table.ajax.reload();
    }
    notif(order_id);
  });

  channel.bind('orderTimeout', function() {
    $.ajax({
      type: "POST",
      url: "<?= base_url('admin/notification/notify') ?>",
      dataType: "JSON",
      data: {},
      success: function(data) {
        $("#notif-total").html(data.total);
        $("#transaksi").html(data.total);
        $("#notif").html(data.result);
        if ($("#tabel").length) {
          table.ajax.reload();
        }
      }
    });
  });

  channel.bind('dapur', function(data) {
    var order_id = data.id;
    $.ajax({
      type: "POST",
      url: "<?= base_url('admin/notification/notify') ?>",
      dataType: "JSON",
      data: {},
      success: function(data) {
        $("#notif-total").html(data.total);
        $("#transaksi").html(data.total);
        $("#notif").html(data.result);
        if ($("#tabel").length) {
          table.ajax.reload();
        }
      }
    });
    notif(order_id);
  });

  function notif(a) {
    $.notify({
      // options
      icon: 'glyphicon glyphicon-info-sign',
      title: 'Notifikasi! ',
      message: 'Transaksi baru untuk proses pengecekan.',
      url: '<?= base_url('admin/transaksi/detail/') ?>' + a,
      target: '_blank'
    }, {
      // settings
      element: 'body',
      position: null,
      type: "info",
      allow_dismiss: true,
      newest_on_top: false,
      showProgressbar: false,
      placement: {
        from: "top",
        align: "right"
      },
      offset: 20,
      spacing: 10,
      z_index: 1031,
      delay: 10000,
      timer: 1000,
      url_target: '_blank',
      mouse_over: null,
      animate: {
        enter: 'animated fadeInDown',
        exit: 'animated fadeOutUp'
      },
      onShow: null,
      onShown: null,
      onClose: null,
      onClosed: null,
      icon_type: 'class',
      template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
        '<span data-notify="icon"></span> ' +
        '<span data-notify="title">{1}</span> ' +
        '<span data-notify="message">{2}</span>' +
        '<div class="progress" data-notify="progressbar">' +
        '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
        '</div>' +
        '<a href="{3}" target="{4}" data-notify="url"></a>' +
        '</div>'
    });
  }

  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
</script>

</html>