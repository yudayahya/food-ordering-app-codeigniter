<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/dist/css/skins/_all-skins.min.css">

<span id="success_message">

</span>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Data Kupon</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ModalaAdd"><span class="fa fa-plus"></span> Tambah Kupon</a>
        <br><br>
        <div class="box-body table-responsive no-padding">
            <table id="tabel" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px;">No</th>
                        <th>Nama Kupon</th>
                        <th style="width:70px;">Used per Member</th>
                        <th style="width:200px;">Tanggal Expired</th>
                        <th>Diskon</th>
                        <th>Minimal Pembelian</th>
                        <th>Maksimal Diskon</th>
                        <th>Digunakan Oleh</th>
                        <th style="width:80px;">Status</th>
                        <th style="width:60px;">Action</th>
                    </tr>
                </thead>
                <tbody id="show-data">

                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box-body -->
</div>

<!-- MODAL ADD -->
<div class="modal fade" id="ModalaAdd" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Kupon</h3>
            </div>
            <form class="form-horizontal" id="formtambah" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-xs-5">Nama Kupon</label>
                        <div class="col-xs-7">
                            <input style="text-transform: uppercase" name="namakupon" id="namakupon" class="form-control" type="text">
                            <span id="error_namakupon" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5">Tipe Kupon</label>
                        <div class="col-xs-2">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="1" checked="" onclick="persenFunction()">
                                    % Basis
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-5">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="2" onclick="flatFunction()">
                                    Flat Diskon
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5">Diskon</label>
                        <div class="col-xs-7">
                            <input name="diskon" id="diskon" class="form-control" type="text">
                            <span id="error_diskon" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5">Minimum Pembelian</label>
                        <div class="col-xs-7">
                            <input name="minimum_spend" id="minimum_spend" class="form-control" type="text">
                            <span id="error_minimum_spend" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5">Maksimal Diskon</label>
                        <div class="col-xs-7">
                            <input name="maksimal_diskon" id="maksimal_diskon" class="form-control" type="text">
                            <span id="error_maksimal_diskon" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5">Jumlah Penggunaan per Member</label>
                        <div class="col-xs-7">
                            <input name="NoOfUse" id="NoOfUse" class="form-control" type="text">
                            <span id="error_NoOfUse" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5">Tgl Expired</label>
                        <div class="col-xs-7">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="tglexpired" name="tglexpired">
                            </div>
                            <span id="error_tglexpired" class="text-danger"></span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button type="submit" class="btn btn-info" name="btn_simpan" id="btn_simpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--END MODAL ADD-->

<!--MODAL HAPUS-->
<div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Hapus Kupon</h4>
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
<!-- bootstrap datepicker -->
<script src="<?php echo base_url() ?>template/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- page script -->
<script type="text/javascript">
    var table;
    $(document).ready(function() {
        //Date picker
        $('#tglexpired').datepicker({
            startDate: "today",
            todayHighlight: true,
            autoclose: true
        })
        //datatables
        table = $('#tabel').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?= base_url('admin/kupon/ajax_list') ?>",
                "type": "POST"
            },
        });
    });

    function refreshTable() {
        table.ajax.reload(null, false);
        document.getElementById("maksimal_diskon").disabled = false;
    }

    function persenFunction() {
        document.getElementById("maksimal_diskon").disabled = false;
    }

    function flatFunction() {
        document.getElementById("maksimal_diskon").disabled = true;
        document.getElementById("maksimal_diskon").value = "";
    }

    //form simpan
    $('#formtambah').on('submit', function(event) {
        event.preventDefault();
        var tipe_diskon = $("input[type='radio'][name='optionsRadios']:checked").val();
        var tglexpired = $('#tglexpired').val();
        var formData = new FormData(this);
        if (document.getElementById("maksimal_diskon").disabled == true) {
            var maksimal_diskon = $('#diskon').val();
            formData.append("maksimal_diskon", maksimal_diskon);
        }
        formData.append("tipe", tipe_diskon);
        formData.append("tgl", tglexpired);
        $.ajax({
            url: "<?= base_url('admin/kupon/simpan_kupon') ?>",
            enctype: 'multipart/form-data',
            type: 'post',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data) {
                if (data.error) {
                    if (data.error_namakupon != '') {
                        $('#error_namakupon').html(data.error_namakupon);
                    } else {
                        $('#error_namakupon').html('');
                    }
                    if (data.error_diskon != '') {
                        $('#error_diskon').html(data.error_diskon);
                    } else {
                        $('#error_diskon').html('');
                    }
                    if (data.error_minimum_spend != '') {
                        $('#error_minimum_spend').html(data.error_minimum_spend);
                    } else {
                        $('#error_minimum_spend').html('');
                    }
                    if (data.error_maksimal_diskon != '') {
                        $('#error_maksimal_diskon').html(data.error_maksimal_diskon);
                    } else {
                        $('#error_maksimal_diskon').html('');
                    }
                    if (data.error_NoOfUse != '') {
                        $('#error_NoOfUse').html(data.error_NoOfUse);
                    } else {
                        $('#error_NoOfUse').html('');
                    }
                    if (data.error_tglexpired != '') {
                        $('#error_tglexpired').html(data.error_tglexpired);
                    } else {
                        $('#error_tglexpired').html('');
                    }
                }
                if (data.success) {
                    $('#error_namakupon').html('');
                    $('#error_diskon').html('');
                    $('#error_minimum_spend').html('');
                    $('#error_maksimal_diskon').html('');
                    $('#error_NoOfUse').html('');
                    $('#error_tglexpired').html('');
                    $('#formtambah')[0].reset();
                    $('#ModalaAdd').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: 'Data Berhasil Ditambahkan.'
                    });
                    refreshTable();
                }
            }
        });
    });

    //form edit
    function changestatus(id, status) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('admin/kupon/changestatus') ?>",
            dataType: "JSON",
            data: {
                id: id,
                status: status
            },
            success: function(data) {
                Toast.fire({
                    icon: 'info',
                    title: 'Status Berhasil Diubah.'
                });
                refreshTable();
            }
        });
        return false;
    };

    //hapus
    function delete_person(id) {
        document.getElementById("id_hapus").value = id;
        $('#ModalHapus').modal('show');
        $('#btn_hapus').on('click', function() {
            var id_hapus = document.getElementById("id_hapus").value;
            $.ajax({
                type: "POST",
                url: "<?= base_url('admin/kupon/hapus_kupon') ?>",
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
</script>