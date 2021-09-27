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
        <h3 class="box-title">Data Banner</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ModalaAdd"><span class="fa fa-plus"></span> Tambah Banner</a>
        <br><br>
        <div class="box-body table-responsive no-padding">
            <table id="tabel" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px;">No</th>
                        <th>Judul Banner</th>
                        <th>Keterangan</th>
                        <th>Gambar</th>
                        <th style="width:125px;">Action</th>
                    </tr>
                </thead>
                <tbody id="show_data">

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
                <h3 class="modal-title" id="myModalLabel">Tambah Banner</h3>
            </div>
            <form class="form-horizontal" id="formtambah" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-xs-3">Judul Banner</label>
                        <div class="col-xs-9">
                            <select id="judul" name="judul" class="form-control">
                                <?php
                                foreach ($produk as $p) {
                                    echo "<option value='$p->produk_id'>$p->produk_nama</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Keterangan Banner</label>
                        <div class="col-xs-9">
                            <input name="keterangan" id="keterangan" class="form-control" type="text">
                            <span id="error_keterangan" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Gambar</label>
                        <div class="col-xs-9">
                            <input type="file" id="image" name="image" class="form-control">
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

<!-- MODAL EDIT -->
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Edit Banner</h3>
            </div>
            <form class="form-horizontal" id="formedit" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="kode" id="kode" value="">
                    <input type="hidden" name="imagename" id="imagename" value="">
                    <div class="form-group">
                        <label class="control-label col-xs-3">Judul Banner</label>
                        <div class="col-xs-9">
                            <select id="juduledit" name="juduledit" class="form-control">
                                <?php
                                foreach ($produk as $p) {
                                    echo "<option value='$p->produk_id'>$p->produk_nama</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Keterangan Banner</label>
                        <div class="col-xs-9">
                            <input name="keteranganedit" id="keteranganedit" class="form-control" type="text">
                            <span id="error_keteranganedit" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Gambar</label>
                        <div class="col-xs-9">
                            <input type="file" id="imageedit" name="imageedit" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button type="submit" class="btn btn-info" name="btn_edit" id="btn_edit">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--END MODAL EDIT-->

<!--MODAL HAPUS-->
<div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Hapus Barang</h4>
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
<!-- page script -->


<script type="text/javascript">
    var table;
    $(document).ready(function() {
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
                "url": "<?= base_url('admin/banner/ajax_list') ?>",
                "type": "POST"
            },
        });
    });

    function refreshTable() {
        table.ajax.reload(null, false);
    }

    //form simpan
    $('#formtambah').on('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        var x = document.getElementById('judul');
        var judul = x.options[x.selectedIndex].text;
        formData.append("judultext", judul);
        $.ajax({
            url: "<?= base_url('admin/banner/simpan_banner') ?>",
            enctype: 'multipart/form-data',
            type: 'post',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data) {
                if (data.error) {
                    if (data.error_keterangan != '') {
                        $('#error_keterangan').html(data.error_keterangan);
                    } else {
                        $('#error_keterangan').html('');
                    }
                }
                if (data.success) {
                    $('#error_keterangan').html('');
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

    //getedit
    function edit_person(id, produkid, ket, img) {
        $('#ModalEdit').modal('show');
        document.getElementById("kode").value = id;
        document.getElementById("imagename").value = img;
        document.getElementById('juduledit').value = produkid;
        $('[name="keteranganedit"]').val(ket);
        $('#error_keteranganedit').html('');
    }

    //form edit
    $('#formedit').on('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        var x = document.getElementById('juduledit');
        var judul = x.options[x.selectedIndex].text;
        formData.append("judultext", judul);
        $.ajax({
            url: "<?= base_url('admin/banner/edit_banner') ?>",
            enctype: 'multipart/form-data',
            type: 'post',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data) {
                if (data.error) {
                    if (data.error_keterangan != '') {
                        $('#error_keteranganedit').html(data.error_keterangan);
                    } else {
                        $('#error_keteranganedit').html('');
                    }
                }
                if (data.success) {
                    $('#error_keteranganedit').html('');
                    $('#formedit')[0].reset();
                    $('#ModalEdit').modal('hide');
                    Toast.fire({
                        icon: 'info',
                        title: 'Data Berhasil Diubah.'
                    });
                    refreshTable();
                }
            }
        });
    });

    //hapus
    function delete_person(id) {
        document.getElementById("id_hapus").value = id;
        $('#ModalHapus').modal('show');
        $('#btn_hapus').on('click', function() {
            var id_hapus = document.getElementById("id_hapus").value;
            $.ajax({
                type: "POST",
                url: "<?= base_url('admin/banner/hapus_banner') ?>",
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