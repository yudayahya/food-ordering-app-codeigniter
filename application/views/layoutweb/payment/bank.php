<!--Body Content-->
<div id="page-content">
    <!--Page Title-->
    <div class="page section-header text-center">
        <div class="page-title">
            <div class="wrapper">
                <h1 class="page-width"><?= $title ?></h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg" id="judul">
                <!-- Javascript informasi-->
            </div>
        </div>
        <div class="row" id="content">
            <?php if ($transaksi['status'] == 1 || $transaksi['status'] == 4 || $transaksi['status'] == 5 || $transaksi['status'] == 7) { ?>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="empty-page-content text-center">
                        <div id="time">
                            <!-- Javascript countdown -->
                        </div>
                        <div id="info">
                            <!-- Javascript informasi -->
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
                    <table class="table table-hover table-responsive-md">
                        <thead>
                            <tr>
                                <th style="width: 10px">No</th>
                                <th colspan="2" class="text-center">Produk</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Qty</th>
                                <th class="text-center">Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $pesanan = $this->db->get_where('tabel_transaksi', array('transaksi_id' => $this->uri->segment(3)))->row_array();
                            $subtotal = 0;
                            $no = 1;
                            foreach ($detail as $d) {
                                $saos = $this->db->get_where('tabel_varian_saus', array('varian_id' => $d->varian_id))->row_array();
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td class="cart__image-wrapper cart-flex-item">
                                        <a href="<?= base_url('produk/detail/') . $d->produk_nama_seo ?>"><img class="cart__image" src="<?= base_url('assets/gambar_produk/') . $d->gambar ?>" alt="Elastic Waist Dress - Navy / Small"></a>
                                    </td>
                                    <td class="cart__meta small--text-left cart-flex-item">
                                        <div class="list-view-item__title">
                                            <a href="<?= base_url('produk/detail/') . $d->produk_nama_seo ?>"><?= $d->produk_nama; ?></a>
                                            <?php if ($saos) { ?>
                                                <div class="cart__meta-text">
                                                    Saos : <?= $saos['nama_varian'] ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($saos) { ?>
                                            <span>Rp. <?= number_format($d->harga + $saos['harga'], 0, ".", "."); ?></span>
                                        <?php } else { ?>
                                            <span>Rp. <?= number_format($d->harga, 0, ".", "."); ?></span>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="cart__qty text-center">
                                            <span><?= $d->qty; ?></span>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <?php if ($saos) { ?>
                                            <div><span>Rp. <?= number_format($subtotal = ($d->harga * $d->qty) + ($saos['harga'] * $d->qty), 0, ".", "."); ?></span></div>
                                        <?php } else { ?>
                                            <div><span>Rp. <?= number_format($subtotal = $d->harga * $d->qty, 0, ".", "."); ?></span></div>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-right">
                                    <div><span><strong>Ongkir</strong></span></div>
                                </td>
                                <td class="text-right">
                                    <div><span><strong>Rp. <?= number_format($pesanan['ongkir'], 0, ".", "."); ?></strong></span></div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right">
                                    <div><span><strong>Total Harga</strong></span></div>
                                </td>
                                <td class="text-right">
                                    <div><span><strong>Rp. <?= number_format($pesanan['total'], 0, ".", "."); ?></strong></span></div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php } ?>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
                <div id="accordionExample">
                    <h2 class="title h2">cara pembayaran</h2>
                    <div class="faq-body">
                        <h4 class="panel-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Bayar Dengan Bank BCA</h4>
                        <div id="collapseOne" class="collapse panel-content" data-parent="#accordionExample">Gunakan ATM / iBanking / mBanking <br> Harap lakukan transfer hingga 3 digit terakhir seperti yang tertera di atas <br><br> No. Rekening : 123-456-78 <br> Nama Rekening : The Crabbys <br><br> Silahkan lakukan verifikasi dengan mengirimkan bukti transfer anda. <br> Demi keamanan transaksi, mohon untuk tidak membagikan bukti atau konfirmasi pembayaran pesanan kepada siapapun, selain mengunggahnya melalui halaman web ini.</div>
                    </div>
                    <div class="faq-body">
                        <h4 class="panel-title" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Bayar Dengan Bank Lain</h4>
                        <div id="collapseTwo" class="collapse panel-content">Gunakan ATM / iBanking / mBanking dan pilih transfer antar bank <br> Harap lakukan transfer hingga 3 digit terakhir seperti yang tertera di atas <br><br> No. Rekening : 123-456-78 <br> Nama Rekening : The Crabbys <br><br> Silahkan lakukan verifikasi dengan mengirimkan bukti transfer anda. <br> Demi keamanan transaksi, mohon untuk tidak membagikan bukti atau konfirmasi pembayaran pesanan kepada siapapun, selain mengunggahnya melalui halaman web ini.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!--End Body Content-->

<!--Quick View popup-->
<div class="modal fade quick-view-popup" id="content_quickview">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div id="ProductSection-product-template" class="product-template__container prstyle1">
                    <div class="product-single">
                        <!-- Start model close -->
                        <a href="javascript:void()" data-dismiss="modal" class="model-close-btn pull-right" title="close"><span class="icon icon anm anm-times-l"></span></a>
                        <!-- End model close -->
                        <div class="row pt-3">
                            <div class="col-lg mx-auto">
                                <div class="product-single__meta">
                                    <form method="post" action="<?= base_url('payment/transfer_bukti') ?>" class="product-form product-form-product-template hidedropdown" enctype="multipart/form-data">
                                        <div class="swatch clearfix swatch-0 option1" data-option-index="0">
                                            <div class="modal-body">
                                                <input type="hidden" value="<?= $transaksi['transaksi_id'] ?>" name="id" id="id">
                                                <div class="form-group">
                                                    <label class="control-label col-xs-3">Nama Rekening*</label>
                                                    <div class="col-xs-9">
                                                        <input name="nama" id="nama" class="form-control" type="text" required oninvalid="this.setCustomValidity('Masukan atas nama rekening')" oninput="this.setCustomValidity('')">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-xs-3">Nomor Rekening*</label>
                                                    <div class="col-xs-9">
                                                        <input name="nomor" id="nomor" class="form-control" type="text" required oninvalid="this.setCustomValidity('Masukan nomor rekening')" oninput="this.setCustomValidity('')">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-xs-3">Nama Bank*</label>
                                                    <div class="col-xs-9">
                                                        <input name="bank" id="bank" class="form-control" type="text" required oninvalid="this.setCustomValidity('Masukan nama bank')" oninput="this.setCustomValidity('')">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-xs-3">Bukti Pembayaran* (format gambar png/jpg/jpeg)</label>
                                                    <div class="col-xs-9">
                                                        <input type="file" id="gambar" name="gambar" class="form-control" required oninvalid="this.setCustomValidity('Pilih gambar sebagai bukti pembayaran')" oninput="this.setCustomValidity('')">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product Action -->
                                        <div class="product-action clearfix">
                                            <div class="product-form__item--submit">
                                                <button type="submit" name="add" class="btn product-form__cart-submit">
                                                    <span>Simpan</span>
                                                </button>
                                            </div>
                                        </div>
                                        <!-- End Product Action -->
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--End-product-single-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Quick View popup-->

<?php
if ($transaksi['status'] == 1 || $transaksi['status'] == 4 || $transaksi['status'] == 5 || $transaksi['status'] == 7) {
    if (!$transaksi['id_bukti']) { ?>
        <script type="text/javascript">
            var countDownDate = <?php
                                echo strtotime($transaksi['waktu_batas']) ?> * 1000;
            var now = <?php echo strtotime($time) ?> * 1000;

            // Update the count down every 1 second
            var x = setInterval(function() {
                now = now + 1000;
                // Find the distance between now an the count down date
                var distance = countDownDate - now;
                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                // Output the result in an element with id="time"
                document.getElementById("time").innerHTML = "<h1 style='font-size: 74px'>" + hours + " Jam : " + minutes + " Menit : " + seconds + " Detik</h1>";
                document.getElementById("info").innerHTML = "<p style='font-size: 30px'>Silahkan lakukan pembayaran sebesar Rp. <strong><?= number_format($transaksi['total'] + $transaksi['kode_unik'], 0, ".", "."); ?></strong>, sebelum <strong><?= date("d F Y H:i:s", strtotime($transaksi['waktu_batas'])) ?></strong></p><p><a href='javascript:void(0)'' id='verify' data-toggle='modal' data-target='#content_quickview' class='btn btn--has-icon-after'>Verifikasi Pembayaran <i class='fa fa-caret-right' aria-hidden='true'></i></a></p>";

                <?php if ($transaksi['status'] == 1) { ?>
                    document.getElementById("judul").innerHTML = "<div class='alert alert-success'  role='alert'><p style='font-size: 20px'><strong>Selamat!</strong> Anda berhasil melakukan pemesanan produk. Cara dan batas pembayaran sebagai berikut.</p></div>";
                <?php } else if ($transaksi['status'] == 7) { ?>
                    document.getElementById("judul").innerHTML = "<div class='alert alert-danger'  role='alert'><p style='font-size: 20px'><strong>Maaf!</strong> Pemesanan anda dibatalkan karena waktu pembayaran telah habis</p></div>";
                <?php } ?>
                // If the count down is over, write some text 
                if (distance < 0) {
                    clearInterval(x);
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('checkout/ubah_status') ?>",
                        data: {
                            id: <?= $transaksi['transaksi_id'] ?>
                        },
                        success: function() {
                            document.getElementById("time").innerHTML = "<p class='text-danger' style='font-size: 50px'>TRANSAKSI EXPIRED</p>";
                            document.getElementById('verify').style.visibility = 'hidden';
                        }
                    });
                }
            }, 1000);
        </script>
    <?php } else if ($transaksi['status'] == 4) { ?>
        <script type="text/javascript">
            document.getElementById("info").innerHTML = "<p style='font-size: 30px'>Silahkan lakukan pembayaran sebesar Rp. <strong><?= number_format($transaksi['total'] + $transaksi['kode_unik'], 0, ".", "."); ?></strong>, sebelum <strong><?= date("d F Y H:i:s", strtotime($transaksi['waktu_batas'])) ?></strong></p><p><a href='javascript:void(0)'' id='verify' data-toggle='modal' data-target='#content_quickview' class='btn btn--has-icon-after'>Verifikasi Pembayaran <i class='fa fa-caret-right' aria-hidden='true'></i></a></p>";
            document.getElementById("time").innerHTML = "<p class='text-danger' style='font-size: 50px'>BUKTI PEMBAYARAN SEDANG KAMI CEK. MOHON DITUNGGU.</p>";
            document.getElementById("judul").innerHTML = "<div class='alert alert-success'  role='alert'><p style='font-size: 20px'><strong>Selamat!</strong> Anda berhasil melakukan pemesanan produk. Cara dan batas pembayaran sebagai berikut.</p></div>";
        </script>
    <?php } else if ($transaksi['status'] == 5) { ?>
        <script type="text/javascript">
            var countDownDate = <?php
                                echo strtotime($transaksi['waktu_batas']) ?> * 1000;
            var now = <?php echo strtotime($time) ?> * 1000;

            // Update the count down every 1 second
            var x = setInterval(function() {
                now = now + 1000;
                // Find the distance between now an the count down date
                var distance = countDownDate - now;
                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                // Output the result in an element with id="time"
                document.getElementById("time").innerHTML = "<h1 style='font-size: 74px'>" + hours + " Jam : " + minutes + " Menit : " + seconds + " Detik</h1>";
                document.getElementById("info").innerHTML = "<p style='font-size: 30px'>Silahkan lakukan pembayaran sebesar Rp. <strong><?= number_format($transaksi['total'] + $transaksi['kode_unik'], 0, ".", "."); ?></strong>, sebelum <strong><?= date("d F Y H:i:s", strtotime($transaksi['waktu_batas'])) ?></strong></p><p><a href='javascript:void(0)'' id='verify' data-toggle='modal' data-target='#content_quickview' class='btn btn--has-icon-after'>Verifikasi Pembayaran <i class='fa fa-caret-right' aria-hidden='true'></i></a></p>";
                document.getElementById("judul").innerHTML = "<div class='alert alert-danger'  role='alert'><p style='font-size: 20px'><strong>Maaf!</strong> Bukti pembayaran anda ditolak. <strong>Mohon lakukan verifikasi pembayaran lagi</strong>. Cara dan batas pembayaran sebagai berikut.</p></div>";
                // If the count down is over, write some text 
                if (distance < 0) {
                    clearInterval(x);
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('checkout/ubah_status') ?>",
                        data: {
                            id: <?= $transaksi['transaksi_id'] ?>
                        },
                        success: function() {
                            document.getElementById("time").innerHTML = "<p class='text-danger' style='font-size: 50px'>TRANSAKSI EXPIRED</p>";
                            document.getElementById('verify').style.visibility = 'hidden';
                        }
                    });
                }
            }, 1000);
        </script>
    <?php } else { ?>
        <script type="text/javascript">
            var countDownDate = <?php
                                echo strtotime($transaksi['waktu_batas']) ?> * 1000;
            var now = <?php echo strtotime($time) ?> * 1000;

            // Update the count down every 1 second
            var x = setInterval(function() {
                now = now + 1000;
                // Find the distance between now an the count down date
                var distance = countDownDate - now;
                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                // Output the result in an element with id="time"
                document.getElementById("time").innerHTML = "<h1 style='font-size: 74px'>" + hours + " Jam : " + minutes + " Menit : " + seconds + " Detik</h1>";
                document.getElementById("info").innerHTML = "<p style='font-size: 30px'>Silahkan lakukan pembayaran sebesar Rp. <strong><?= number_format($transaksi['total'] + $transaksi['kode_unik'], 0, ".", "."); ?></strong>, sebelum <strong><?= date("d F Y H:i:s", strtotime($transaksi['waktu_batas'])) ?></strong></p><p><a href='javascript:void(0)'' id='verify' data-toggle='modal' data-target='#content_quickview' class='btn btn--has-icon-after'>Verifikasi Pembayaran <i class='fa fa-caret-right' aria-hidden='true'></i></a></p>";

                <?php if ($transaksi['status'] == 1) { ?>
                    document.getElementById("judul").innerHTML = "<div class='alert alert-success'  role='alert'><p style='font-size: 20px'><strong>Selamat!</strong> Anda berhasil melakukan pemesanan produk. Cara dan batas pembayaran sebagai berikut.</p></div>";
                <?php } else if ($transaksi['status'] == 7) { ?>
                    document.getElementById("judul").innerHTML = "<div class='alert alert-danger'  role='alert'><p style='font-size: 20px'><strong>Maaf!</strong> Pemesanan anda dibatalkan karena waktu pembayaran telah habis</p></div>";
                <?php } ?>
                // If the count down is over, write some text 
                if (distance < 0) {
                    clearInterval(x);
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('checkout/ubah_status') ?>",
                        data: {
                            id: <?= $transaksi['transaksi_id'] ?>
                        },
                        success: function() {
                            document.getElementById("time").innerHTML = "<p class='text-danger' style='font-size: 50px'>TRANSAKSI EXPIRED</p>";
                            document.getElementById('verify').style.visibility = 'hidden';
                        }
                    });
                }
            }, 1000);
        </script>
    <?php } ?>
<?php } else if ($transaksi['status'] == 2 || $transaksi['status'] == 3) { ?>
    <script type="text/javascript">
        <?php if ($transaksi['status'] == 2) { ?>
            document.getElementById("judul").innerHTML = "<div class='alert alert-success'  role='alert'><p style='font-size: 20px'><strong>Informasi!</strong> Pesanan anda sedang dalam proses <strong>pemasakan</strong>. Berikut detail pesanan anda.</p></div>";
        <?php } else if ($transaksi['status'] == 3) { ?>
            document.getElementById("judul").innerHTML = "<div class='alert alert-success'  role='alert'><p style='font-size: 20px'><strong>Informasi!</strong> Pesanan anda sedang dalam proses <strong>pengiriman</strong>. Berikut detail pesanan anda.</p></div>";
        <?php } ?>
    </script>

<?php } else { ?>
    <script type="text/javascript">
        document.getElementById("judul").innerHTML = "<div class='alert alert-success'  role='alert'><p style='font-size: 20px'><strong>Informasi!</strong> Pesanan anda sudah <strong>selesai</strong>. Berikut detail pesanan anda.</p></div>";
    </script>

<?php } ?>