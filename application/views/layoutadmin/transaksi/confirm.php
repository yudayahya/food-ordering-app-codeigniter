<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/dist/css/skins/_all-skins.min.css">

<span id="success_message">
    <?= $this->session->flashdata('message'); ?>
</span>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Data Transaksi <strong>KONFIRMASI DAPUR</strong></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="box-body table-responsive no-padding">
            <table id="tabel" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px;">No</th>
                        <th>Nama Pemesan</th>
                        <th>Order ID</th>
                        <th>Tanggal & Waktu</th>
                        <th>Batas Pembayaran</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th style="width: 70px;">Action</th>
                    </tr>
                </thead>
                <tbody id="show-data">

                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
</div>

<!-- jQuery 3 -->
<script src="<?php echo base_url() ?>template/AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() ?>template/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url() ?>template/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>template/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url() ?>template/AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url() ?>template/AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>template/AdminLTE/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>template/AdminLTE/dist/js/demo.js"></script>

<!-- page script -->
<script type="text/javascript">
    var table;
    $(document).ready(function() {
        table = $('#tabel').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?= base_url('admin/transaksi/list_confirm') ?>",
                "type": "POST"
            },
        });
    });

    function refreshTable() {
        table.ajax.reload();
    }
</script>