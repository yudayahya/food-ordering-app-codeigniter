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
    <h3 class="box-title">Data Kategori</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ModalaAdd"><span class="fa fa-plus"></span> Tambah Kategori</a>
    <br><br>
    <table id="tabel" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th style="width: 10px;">No</th>
          <th>Nama Kategori</th>
          <th>Jenis</th>
          <th style="width:125px;">Action</th>
        </tr>
      </thead>
      <tbody id="show-data">

      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>

<!-- MODAL ADD -->
<div class="modal fade" id="ModalaAdd" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="myModalLabel">Tambah Kategori</h3>
      </div>
      <form class="form-horizontal" id="formtambah" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label col-xs-3">Nama Kategori</label>
            <div class="col-xs-9">
              <input name="namakategori" id="namakategori" class="form-control" type="text">
              <span id="error_namakategori" class="text-danger"></span>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-xs-3">Parent Kategori</label>
            <div class="col-xs-9">
              <select id="parent" name="parent" class="form-control">

              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-xs-3"></label>
            <div class="col-xs-9">
              <div class="form-check">
                <label>
                  <input name="variansaus" id="variansaus" type="checkbox"> Butuh Varian Saus?
                </label>
              </div>
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
        <h3 class="modal-title" id="myModalLabel">Edit Kategori</h3>
      </div>
      <form class="form-horizontal" id="formedit" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" name="kode" id="kode" value="">
          <div class="form-group">
            <label class="control-label col-xs-3">Nama Kategori</label>
            <div class="col-xs-9">
              <input name="namakategoriedit" id="namakategoriedit" class="form-control" type="text">
              <span id="error_namakategoriedit" class="text-danger"></span>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-xs-3">Kategori Parent</label>
            <div class="col-xs-9">
              <select id="parentedit" name="parentedit" class="form-control">

              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-xs-3"></label>
            <div class="col-xs-9">
              <div class="form-check">
                <label>
                  <input name="varianedit" id="varianedit" type="checkbox"> Butuh Varian Saus?
                </label>
              </div>
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
        <h4 class="modal-title" id="myModalLabel">Hapus Kategori</h4>
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
    getparent();
    table = $('#tabel').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,

      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": "<?= base_url('admin/kategori/ajax_list') ?>",
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
    var varian = document.getElementById("variansaus").checked;
    var formData = new FormData(this);
    formData.append("varian", varian);
    $.ajax({
      url: "<?= base_url('admin/kategori/simpan_kategori') ?>",
      enctype: 'multipart/form-data',
      type: 'post',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function(data) {
        if (data.error) {
          if (data.error_namakategori != '') {
            $('#error_namakategori').html(data.error_namakategori);
          } else {
            $('#error_namakategori').html('');
          }
        }
        if (data.success) {
          $('#error_namakategori').html('');
          $('#formtambah')[0].reset();
          $('#ModalaAdd').modal('hide');
          Toast.fire({
            icon: 'success',
            title: 'Data Berhasil Ditambahkan.'
          });
          refreshTable();
          getparent();
        }
      }
    });
  });

  //getedit
  function edit_person(id, nama, parent, varian) {
    $('#ModalEdit').modal('show');
    document.getElementById("kode").value = id;
    $('[name="namakategoriedit"]').val(nama);
    if (varian == 1) {
      document.getElementById("varianedit").checked = true;
    } else {
      document.getElementById("varianedit").checked = false;
    }
    getparentedit(parent);
    $('#error_namakategoriedit').html('');
  }

  //form edit
  $('#formedit').on('submit', function(event) {
    event.preventDefault();
    var varian = document.getElementById("varianedit").checked;
    var formData = new FormData(this);
    formData.append("varian", varian);
    $.ajax({
      url: "<?= base_url('admin/kategori/edit_kategori') ?>",
      enctype: 'multipart/form-data',
      type: 'post',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function(data) {
        if (data.error) {
          if (data.error_namakategori != '') {
            $('#error_namakategoriedit').html(data.error_namakategori);
          } else {
            $('#error_namakategoriedit').html('');
          }
        }
        if (data.success) {
          $('#error_namakategoriedit').html('');
          $('#formedit')[0].reset();
          $('#ModalEdit').modal('hide');
          Toast.fire({
            icon: 'info',
            title: 'Data Berhasil Diubah.'
          });
          refreshTable();
          getparent();
        }
      }
    });
  });

  function getparent() {
    $.ajax({
      url: "<?= base_url('admin/kategori/getparent') ?>",
      dataType: 'json',
      success: function(data) {
        var html = '<option value="0">Parent Menu</option>';
        var i;
        for (i = 0; i < data.length; i++) {
          html += '<option value=' + data[i].kategori_id + '>' + data[i].kategori_nama + '</option>';
        }
        $('#parent').html(html);
      }
    });
    return false;
  };

  function getparentedit(parent) {
    $.ajax({
      url: "<?= base_url('admin/kategori/getparent') ?>",
      dataType: 'json',
      success: function(data) {
        var html = '<option value="0">Parent Menu</option>';
        var i;
        for (i = 0; i < data.length; i++) {
          html += '<option value=' + data[i].kategori_id + '>' + data[i].kategori_nama + '</option>';
        }
        $('#parentedit').html(html);
        document.getElementById('parentedit').value = parent;
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
        url: "<?= base_url('admin/kategori/hapus_kategori') ?>",
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
          getparent();
        }
      });
      return false;
    });
  };
</script>