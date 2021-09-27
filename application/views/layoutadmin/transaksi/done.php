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
<!-- daterange picker -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-html5-1.6.1/datatables.min.css" />


<span id="success_message">

</span>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Data Transaksi <strong>SELESAI</strong></h3>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-lg-2">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="tgl_filter">
                </div>
            </div>
            <div class="col-lg-2 pull-right">
                <a href="<?= base_url('admin/transaksi/laporan') ?>" class="btn btn-block btn-success"><span class="glyphicon glyphicon-pencil"></span> Buat Laporan Penjualan</a>
            </div>
        </div>
        <br>
        <div class="box-body table-responsive no-padding">
            <table id="tabel1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px;">No</th>
                        <th>Nama Pemesan</th>
                        <th>Kode Unik</th>
                        <th>Tanggal & Waktu</th>
                        <th>Batas Pembayaran</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th style="width: 70px;">Action</th>
                    </tr>
                </thead>
                <tbody id="show-data1">

                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box-body -->
</div>

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Data Transaksi <strong>EXPIRED</strong></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-lg-2">
                <a href="javascript:void(0)" onclick="delete_expired()" class="btn btn-block btn-danger"><span class="glyphicon glyphicon-trash"></span> Bersihkan Semua Transaksi Expired</a>
            </div>
        </div>
        <br>
        <div class="box-body table-responsive no-padding">
            <table id="tabel2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px;">No</th>
                        <th>Nama Pemesan</th>
                        <th>Order ID</th>
                        <th>Tanggal & Waktu</th>
                        <th>Batas Pembayaran</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th style="width: 125px;">Action</th>
                    </tr>
                </thead>
                <tbody id="show-data2">

                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box-body -->
</div>

<!--MODAL HAPUS-->
<div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Hapus Transaksi</h4>
            </div>
            <form class="form-horizontal" id="formhapus" method="post">
                <div class="modal-body">
                    <input type="hidden" id="id_hapus" value="">
                    <div class="alert alert-warning">
                        <p>Apakah Anda yakin menghapus data ini?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn_hapus btn btn-danger" name="btn_hapus" id="btn_hapus">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--END MODAL HAPUS-->

<!--MODAL HAPUS-->
<div class="modal fade" id="ModalHapusExpired" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Expired Transaksi Expired</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <p>Apakah Anda yakin menghapus semua transaksi expired?</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn_hapus_expired btn btn-danger" name="btn_hapus_expired" id="btn_hapus_expired">Hapus</button>
            </div>
        </div>
    </div>
</div>
<!--END MODAL HAPUS-->

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
<!-- date-range-picker -->
<script src="<?php echo base_url() ?>template/AdminLTE/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url() ?>template/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-html5-1.6.1/datatables.min.js"></script>

<!-- page script -->
<script type="text/javascript">
    var table1, table2;
    $(document).ready(function() {
        table1 = $('#tabel1').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?= base_url('admin/transaksi/list_done') ?>",
                "type": "POST"
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
                "url": "<?= base_url('admin/transaksi/list_expired') ?>",
                "type": "POST"
            },
        });
    });

    function refreshTable() {
        table1.ajax.reload();
        table2.ajax.reload();
    }

    //hapus
    function delete_person(id) {
        document.getElementById("id_hapus").value = id;
        $('#ModalHapus').modal('show');
        $('#btn_hapus').on('click', function() {
            var id_hapus = document.getElementById("id_hapus").value;
            $.ajax({
                type: "POST",
                url: "<?= base_url('admin/transaksi/hapus') ?>",
                dataType: "JSON",
                data: {
                    hapus: id_hapus
                },
                success: function(data) {
                    $('#ModalHapus').modal('hide');
                    Toast.fire({
                        icon: 'error',
                        title: 'Data Berhasil Dihapus.'
                    });
                    refreshTable();
                }
            });
            return false;
        });
    };

    function delete_expired() {
        $('#ModalHapusExpired').modal('show');
        $('#btn_hapus_expired').on('click', function() {
            $('#ModalHapusExpired').modal('hide');
            $.ajax({
                type: "POST",
                url: "<?= base_url('admin/transaksi/hapus_expired') ?>",
                dataType: "JSON",
                success: function(data) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Semua Data Transaksi Expired Berhasil Dihapus.'
                    });
                    refreshTable();
                }
            });
            return false;
        });
    };

    $(function() {
        //Date range picker
        $('#tgl_filter').daterangepicker({
            opens: 'right'
        }, function(start, end, label) {
            $.ajax({
                type: "POST",
                url: "<?= base_url('admin/transaksi/sortDoneDate') ?>",
                dataType: "JSON",
                data: {
                    awal: start.format('YYYY-MM-DD'),
                    akhir: end.format('YYYY-MM-DD')
                },
                success: function(html) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Filter Tanggal Berhasil Diterapkan.'
                    });
                    table1.clear();
                    table1.rows.add(html.data);
                    table1.draw();
                }
            });
        });
    });
</script>