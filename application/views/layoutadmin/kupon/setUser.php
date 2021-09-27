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

</span>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><strong>Daftar Pengguna Kupon</strong></h3>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <?php if (!$cek) { ?>
            <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ModalAllmember">Gunakan Untuk Semua Member?</a>
            <br><br>
            <div class="box-body table-responsive no-padding">
                <table id="tabel1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px;">No</th>
                            <th>Nama Member</th>
                            <th>Email</th>
                            <th style="width: 10px;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="show-data1">

                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg text-center">
                        <h2><strong>Kupon Ini Diterapkan Untuk Semua Member</strong></h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg text-center">
                        <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ModalSetAllmember">Ingin Custom Pengguna Kupon?</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <!-- /.box-body -->
</div>
<?php if (!$cek) { ?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><strong>List Member</strong></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="box-body table-responsive no-padding">
                <table id="tabel2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px;">No</th>
                            <th>Nama Member</th>
                            <th>Email</th>
                            <th>Jumlah Transaksi Selesai</th>
                            <th style="width: 10px;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="show-data2">

                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
<?php } ?>

<div class="modal fade" id="ModalAllmember" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Gunakan Kupon Untuk Semua Member</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <p>Apakah anda yakin ingin menerapkan kupon ini untuk semua member?</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn_allmember btn btn-success" name="btn_allmember" id="btn_allmember">Yakin</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalSetAllmember" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Custom Member Kupon</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <p>Apakah anda yakin ingin melakukan custom member pada kupon ini?</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn_setallmember btn btn-success" name="btn_setallmember" id="btn_setallmember">Yakin</button>
            </div>
        </div>
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
    var table1;
    $(document).ready(function() {
        var id = <?= $this->uri->segment(4); ?>;
        table1 = $('#tabel1').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?= base_url('admin/kupon/list_user_kupon'); ?>",
                "type": "POST",
                "data": {
                    "id": id
                }
            },
        });

        table2 = $('#tabel2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?= base_url('admin/kupon/list_member') ?>",
                "type": "POST",
                "data": {
                    "id": id
                }
            },
        });
    });

    function refreshTable() {
        table1.ajax.reload();
        table2.ajax.reload();
    }

    function remove_user(id) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('admin/kupon/remove_kupon_user') ?>",
            dataType: "JSON",
            data: {
                id_kupon: id
            },
            success: function(data) {
                Toast.fire({
                    icon: 'error',
                    title: 'Data Berhasil Dihapus.'
                });
                refreshTable();
            }
        });
        return false;
    };

    function add_user(id) {
        var id_kupon = <?= $this->uri->segment(4); ?>;
        $.ajax({
            type: "POST",
            url: "<?= base_url('admin/kupon/add_kupon_user') ?>",
            dataType: "JSON",
            data: {
                id_member: id,
                id_kupon: id_kupon
            },
            success: function(data) {
                Toast.fire({
                    icon: 'success',
                    title: 'Data Berhasil Ditambahkan.'
                });
                refreshTable();
            }
        });
        return false;
    };

    $('#btn_allmember').on('click', function() {
        var id_kupon = <?= $this->uri->segment(4); ?>;
        $.ajax({
            type: "POST",
            url: "<?= base_url('admin/kupon/kupon_allmember') ?>",
            dataType: "JSON",
            data: {
                id_kupon: id_kupon
            },
            success: function(data) {
                window.location.reload();
            }
        });
        return false;
    });

    $('#btn_setallmember').on('click', function() {
        var id_kupon = <?= $this->uri->segment(4); ?>;
        $.ajax({
            type: "POST",
            url: "<?= base_url('admin/kupon/kupon_custommember') ?>",
            dataType: "JSON",
            data: {
                id_kupon: id_kupon
            },
            success: function(data) {
                window.location.reload();
            }
        });
        return false;
    });
</script>