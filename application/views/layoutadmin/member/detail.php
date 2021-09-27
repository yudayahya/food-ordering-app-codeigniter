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

<div class="box box-primary">
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
      <td>No HP / Telpon</td>
      <td><?php echo $row['no_hp']; ?></td>
    </tr>
    <tr>
      <td>Lokasi</td>
      <td>
        <?php if (!$row['lat'] || !$row['lng']) {
          echo "Data Lokasi Masih Kosong";
        } else {
          echo "<div id='map' style='height: 400px'></div>";
        } ?>
      </td>
    </tr>
  </table>

  <div class="box-header">
    <h3 class="box-title">Riwayat Transaksi</h3>
  </div>
  <table class="table table-bordered">
    <tr>
      <th width="10">No</th>
      <th>Tanggal</th>
      <th>Status</th>
    </tr>
    <?php
    $no = 1;
    foreach ($order as $o) {
      if ($o->status == 1) {
        $status = 'KONFIRMASI DAPUR';
      } else if ($o->status == 2) {
        $status = 'MENUNGGU PEMBAYARAN';
      } else if ($o->status == 3) {
        $status = 'MEMASAK';
      } else if ($o->status == 4) {
        $status = 'MENGIRIM';
      } else if ($o->status == 5) {
        $status = 'SELESAI';
      } else {
        $status = 'EXPIRED';
      }
      echo "<tr>
                <td>$no</td>
                <td>$o->tanggal</td>
                <td>$status</td>
              <tr>";
      $no++;
    }
    ?>
  </table>
  <div class="box-footer">
    <?php
    echo anchor('admin/member', 'Kembali', array('class' => 'btn btn-primary'))
    ?>
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
<script src="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.js"></script>
<link type="text/css" rel="stylesheet" href="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.css" />

<script type="text/javascript">
  <?php if ($row['lat'] || $row['lng']) { ?>
    L.mapquest.key = 'AMRp9A74OBvMWuxGZG0A2y6gR0Ara3u5';
    var lat = <?= $row['lat'] ?>;
    var lng = <?= $row['lng'] ?>;
    var nama = '<?= $row['nama_lengkap'] ?>';

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
  <?php } ?>
</script>