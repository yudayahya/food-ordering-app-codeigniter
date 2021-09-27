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
  <div class="row">
    <div class="col-lg-6">
      <div class="box-header with-border">
        <h3 class="box-title">Detail Member</h3>
      </div>
      <table class="table table-bordered">
        <tr>
          <td width="200">Nama Lengkap</td>
          <td><?php echo $row['nama_lengkap']; ?></td>
        </tr>
        <tr>
          <td>Email</td>
          <td><?php echo $row['email']; ?></td>
        </tr>
        <tr>
          <td>Nomor Handphone</td>
          <td><?php echo $row['no_hp']; ?></td>
        </tr>
      </table>
    </div>
    <div class="col-lg-6">
      <div class="box-header with-border">
        <h3 class="box-title">Data Pembayaran</h3>
      </div>
      <table class="table table-bordered">
        <tr>
          <td width="200">Nama Pembayar</td>
          <td><?= $billing['nama_lengkap']; ?></td>
        </tr>
        <tr>
          <td>No. Virtual Account</td>
          <td><?= $pesanan['code_bayar']; ?></td>
        </tr>
        <tr>
          <td>Nama Bank</td>
          <td><?= $pesanan['pembayaran']; ?></td>
        </tr>
        <!-- <tr>
          <td>Bukti Transfer</td>
            <td><a href="javascript:void(0)" title="Foto" data-toggle="modal" data-target="#ModalaView">LIHAT DISINI</a>
            </td>
        </tr> -->
      </table>
    </div>
  </div>

  <div class="box-header with-border">
    <h3 class="box-title">Billing Info</h3>
  </div>
  <table class="table table-bordered">
    <tr>
      <td width="200">Nama Lengkap</td>
      <td><?= $billing['nama_lengkap']; ?></td>
    </tr>
    <tr>
      <td>Nomor Handphone</td>
      <td><?= $billing['no_hp']; ?></td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>
        <div id="resultDiv"><strong>Latitude :</strong> <?= $billing['lat'] ?> , <strong>Longitude :</strong> <?= $billing['lng'] ?></div>
        <div id="map" style="height: 400px"></div>
      </td>
    </tr>
    <tr>
      <td>Catatan</td>
      <td><?= $billing['catatan']; ?></td>
    </tr>
  </table>

  <div class="box-header with-border">
    <h3 class="box-title">Informasi Transaksi</h3>
  </div>
  <?php
  echo form_open('admin/transaksi/detail');
  $waktu = date("d F Y H:i:s", strtotime($pesanan['waktu']));
  ?>
  <input type="hidden" name="id" value="<?php echo $pesanan['transaksi_id']; ?>">
  <table class="table table-bordered">
    <tr>
      <td width="200">Tanggal & Waktu Order</td>
      <td><?php echo $waktu; ?></td>
    </tr>
    <tr>
      <td>Status Order</td>
      <td>
        <?php

        if ($pesanan['status'] == 2) {
          echo "<strong>MENUNGGU PEMBAYARAN</strong>";
        } else if ($pesanan['status'] == 5) {
          echo "<strong>SELESAI</strong>";
        } else if ($pesanan['status'] == 6) {
          echo "<strong>EXPIRED</strong>";
        } else {
          $status = array(
            3 => 'MEMASAK',
            4 => 'MENGIRIM',
            5 => 'SELESAI'
          );
          echo form_dropdown('status', $status, $pesanan['status'], "class='form-control'");
        }
        ?>
      </td>
    </tr>
    <tr>
      <td colspan="2"><button type="submit" name="submit" class="btn btn-danger btn-sm" <?php if ($pesanan['status'] == 2 || $pesanan['status'] == 5 || $pesanan['status'] == 6) {
                                                                                          echo "disabled";
                                                                                        } ?>>Simpan Perubahan</button></td>
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
      <tr>
        <td colspan="3"></td>
        <td>Ongkir</td>
        <td><?php echo "Rp. " . number_format($pesanan['ongkir'], 0, ".", "."); ?></td>
      </tr>
      <?php if ($pesanan['id_kupon']) { ?>
        <tr>
          <td colspan="3"></td>
          <td>Diskon</td>
          <td><strike><?php echo "Rp. " . number_format($pesanan['potongan'], 0, ".", "."); ?></strike></td>
        </tr>
      <?php } ?>
      <tr>
        <td colspan="3"></td>
        <td>Total Transaksi</td>
        <td><?php echo "Rp. " . number_format($pesanan['total'], 0, ".", "."); ?></td>
      </tr>
  </table>
  <?php if ($pesanan['status'] == 3 || $pesanan['status'] == 4 || $pesanan['status'] == 5) { ?>
    <div class="box-footer">
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="<?= base_url('admin/transaksi/invoice/') . $pesanan['transaksi_id'] ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print Invoice</a>
        </div>
      </div>
    </div>
  <?php } ?>

</div>

<!-- MODAL VIEW -->
<!-- <div class="modal fade" id="ModalaView" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="myModalLabel">Bukti Transfer</h3>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <img src="" class="img-thumbnail">
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
      </div>
    </div>
  </div>
</div> -->
<!--END MODAL VIEW-->

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

<script src="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.js"></script>
<link type="text/css" rel="stylesheet" href="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.css" />

<script type="text/javascript">
  L.mapquest.key = 'AMRp9A74OBvMWuxGZG0A2y6gR0Ara3u5';
  var lat = <?= $billing['lat'] ?>;
  var lng = <?= $billing['lng'] ?>;
  var nama = '<?= $billing['nama_lengkap'] ?>';

  // 'map' refers to a <div> element with the ID map
  var map = L.mapquest.map('map', {
    center: [lat, lng],
    layers: L.mapquest.tileLayer('map'),
    zoom: 15
  });

  L.mapquest.textMarker([lat, lng], {
    text: 'Lokasi Pengiriman',
    subtext: nama,
    position: 'right',
    type: 'marker',
    icon: {
      primaryColor: '#333333',
      secondaryColor: '#333333',
      size: 'sm'
    }
  }).addTo(map);
</script>