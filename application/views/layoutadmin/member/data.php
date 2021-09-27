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
    <h3 class="box-title">Data Member</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive no-padding">
    <table id="tabel" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th style="width: 10px;">No</th>
          <th>Nama Lengkap</th>
          <th>Email</th>
          <th>Gambar</th>
          <th style="width:125px;">Action</th>
        </tr>
      </thead>
      <tbody id="show-data">

      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>

<!--MODAL HAPUS-->
<div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Hapus Member</h4>
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
        "url": "<?= base_url('admin/member/ajax_list') ?>",
        "type": "POST"
      },
    });
  });

  function refreshTable() {
    table.ajax.reload(null, false);
  }

  //getdetail
  function detail_person(id) {
    var url = "<?= base_url('admin/member/detail/') ?>" + id;
    window.location = url;
  }

  //hapus
  function delete_person(id) {
    document.getElementById("id_hapus").value = id;
    $('#ModalHapus').modal('show');
    $('#btn_hapus').on('click', function() {
      var id_hapus = document.getElementById("id_hapus").value;
      $.ajax({
        type: "POST",
        url: "<?= base_url('admin/member/hapus') ?>",
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