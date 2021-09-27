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
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Informasi Transaksi</h3>
    </div>
    <input type="hidden" name="id" value="<?php echo $pesanan['transaksi_id']; ?>">
    <table class="table table-bordered">
        <tr>
            <td width="200">Tanggal & Waktu Order</td>
            <td><?= date("d F Y H:i:s", strtotime($pesanan['waktu'])) ?></td>
        </tr>
        <tr>
            <td>Status Order</td>
            <td>KONFIRMASI DAPUR</td>
        </tr>
    </table>

    <div class="box-header">
        <h3 class="box-title">Detail Transaksi</h3>
    </div>
    <table class="table table-bordered">
        <tr>
            <th width="10">No</th>
            <th>Nama Produk</th>
            <th width="20">Jumlah</th>
            <th>Harga</th>
            <th>Total</th>
        </tr>
        <?php
        $no = 1;
        $total = 0;
        foreach ($order as $o) {
            $saos = $this->db->get_where('tabel_varian_saus', array('varian_id' => $o->varian_id))->row_array();
        ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $o->produk_nama;
                    if ($saos) {
                        echo "<br><h6>Varian Saos : " . $saos['nama_varian'] . " </h6>";
                    } ?></td>
                <td><?= $o->qty ?></td>
                <?php if ($saos) { ?>
                    <td>Rp. <?= number_format($o->harga + $saos['harga'], 0, ".", ".") ?></td>
                <?php } else { ?>
                    <td>Rp. <?= number_format($o->harga, 0, ".", ".") ?></td>
                <?php } ?>
                <?php if ($saos) { ?>
                    <td>Rp. <?= number_format(($o->harga * $o->qty) + ($saos['harga'] * $o->qty), 0, ".", ".") ?></td>
                <?php } else { ?>
                    <td>Rp. <?= number_format($o->harga * $o->qty, 0, ".", ".") ?></td>
                <?php } ?>
            <tr>

            <?php
            $total = $total + ($o->harga * $o->qty);
            $no++;
        } ?>
    </table>

    <div class="box-footer">
        <div class="row no-print">
            <div class="col-xs-12">
                <a href="javascript:void(0)" onclick="konfirmasi()" class="btn btn-success btn-sm">KONFIRMASI</a>
                <a href="javascript:void(0)" onclick="tolak()" class="btn btn-danger btn-sm">TOLAK</a>
            </div>
        </div>
    </div>
</div>

<!--MODAL KONFIRMASI-->
<div class="modal fade" id="ModalKonfirmasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Konfirmasi Transaksi</h4>
            </div>
            <form class="form-horizontal" id="formkonfirmasi" method="post">
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <p>Apakah Anda yakin mengkonfirmasi order ini?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn_konfirmasi btn btn-success" name="btn_konfirmasi" id="btn_konfirmasi">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--END MODAL KONFIRMASI-->

<!--MODAL TOLAK-->
<div class="modal fade" id="ModalTolak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Tolak Transaksi</h4>
            </div>
            <form class="form-horizontal" id="formtolak" method="post">
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <p>Apakah Anda yakin menolak order ini?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn_tolak btn btn-danger" name="btn_tolak" id="btn_tolak">Tolak</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--END MODAL TOLAK-->

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

<script>
    function konfirmasi() {
        $('#ModalKonfirmasi').modal('show');
        $('#btn_konfirmasi').on('click', function() {
            $("#btn_konfirmasi").attr("disabled", true);
            var id = <?= $this->uri->segment(4); ?>;
            $.ajax({
                type: "POST",
                url: "<?= base_url('admin/transaksi/konfirmasiDapur') ?>",
                data: {
                    id: id
                },
                success: function() {
                    $('#ModalKonfirmasi').modal('hide');
                    $("#btn_konfirmasi").attr("disabled", false);
                    window.location.href = "<?= base_url('admin/transaksi'); ?>";
                }
            });
            return false;
        });
    };

    function tolak() {
        $('#ModalTolak').modal('show');
        $('#btn_tolak').on('click', function() {
            $("#btn_tolak").attr("disabled", true);
            var id = <?= $this->uri->segment(4); ?>;
            $.ajax({
                type: "POST",
                url: "<?= base_url('admin/transaksi/tolakDapur') ?>",
                data: {
                    id: id
                },
                success: function() {
                    $('#ModalTolak').modal('hide');
                    $("#btn_tolak").attr("disabled", false);
                    window.location.href = "<?= base_url('admin/transaksi'); ?>";
                }
            });
            return false;
        });
    };
</script>