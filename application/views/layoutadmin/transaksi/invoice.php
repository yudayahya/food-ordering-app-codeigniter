<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>The Crabbys | <?= $title ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/dist/css/AdminLTE.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body onload="window.print();">
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <img src="<?= base_url('assets/logo/favicon.ico') ?>" style="max-height: 30px;" alt=""> The Crabbys.
                        <small class="pull-right">Tanggal : <?= date("d F Y", strtotime($transaksi['tanggal'])); ?></small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    Dari
                    <address>
                        <strong>The Crabbys.</strong><br>
                        Daerah Istimewa Yogyakarta.<br>
                        Jl. Sidomukti, Tiyosan, Condongcatur, Kec. Depok, Kabupaten Sleman.<br>
                        Phone: +62-813-8244-4327<br>
                        Email: crabbys.info@gmail.com
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    Ke
                    <address>
                        <strong><?= $billing['nama_lengkap'] ?></strong><br>
                        Phone: <?= $billing['no_hp'] ?><br>
                        Email: <?= $billing['email'] ?>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Invoice #<?= $transaksi['transaksi_id'] ?></b><br>
                    <br>
                    <b>Order ID:</b> <?= $transaksi['transaksi_id'] ?><br>
                    <b>Tanggal Pemesanan:</b> <?= date("d F Y", strtotime($transaksi['tanggal'])); ?><br>
                    <b>Nama Member:</b> <?= $member['nama_lengkap'] ?>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Qty</th>
                                <th>Nama Produk</th>
                                <th>Deskripsi Varian</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $subtotal = 0;
                            foreach ($order as $o) {
                                $varian = $this->db->get_where('tabel_varian_saus', ['varian_id' => $o['varian_id']])->row_array();
                                $produk = $this->db->get_where('tabel_produk', ['produk_id' => $o['produk_id']])->row_array();
                                if ($varian) {
                                    $sub = ($produk['harga'] * $o['qty']) + ($varian['harga'] * $o['qty']);
                                } else {
                                    $sub = $produk['harga'] * $o['qty'];
                                }
                            ?>
                                <tr>
                                    <td><?= $o['qty'] ?></td>
                                    <td><?= $produk['produk_nama'] ?></td>
                                    <td><?= $varian['nama_varian'] ?></td>
                                    <td>Rp. <?= number_format($sub, 0, ".", ".") ?></td>
                                </tr>
                            <?php
                                $subtotal += $sub;
                            } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-6">
                    <p class="lead">Metode Pembayaran:</p>
                    <label for=""><?= strtoupper($transaksi['pembayaran']); ?></label>
                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                        Terima kasih atas pembelian anda. Selamat Menikmati :)
                    </p>
                </div>
                <!-- /.col -->
                <div class="col-xs-6">
                    <p class="lead">Tanggal Pemesanan : <?= date("d F Y", strtotime($transaksi['tanggal'])); ?></p>

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>Rp. <?= number_format($subtotal, 0, ".", ".") ?></td>
                            </tr>
                            <tr>
                                <th>Ongkir:</th>
                                <td>Rp. <?= number_format($transaksi['ongkir'], 0, ".", ".") ?></td>
                            </tr>
                            <?php if ($transaksi['id_kupon']) { ?>
                                <tr>
                                    <th>Diskon:</th>
                                    <td><strike>Rp. <?= number_format($transaksi['potongan'], 0, ".", ".") ?></strike></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <th>Total:</th>
                                <td>Rp. <?= number_format($transaksi['total'], 0, ".", ".") ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
</body>

</html>