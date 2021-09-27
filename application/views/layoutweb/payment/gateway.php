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
            <?php if ($transaksi['status'] == 2 || $transaksi['status'] == 6) { ?>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-4">
                    <div class="text-center">
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
                            <?php if ($pesanan['id_kupon']) { ?>
                                <tr>
                                    <td colspan="5" class="text-right">
                                        <div><span><strong>Diskon</strong></span></div>
                                    </td>
                                    <td class="text-right">
                                        <div><span><strike>Rp. <?= number_format($pesanan['potongan'], 0, ".", "."); ?></strike></span></div>
                                    </td>
                                </tr>
                            <?php } ?>
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
        <div class="row" id="carabayar">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
                <div id="accordionExample">
                    <h2 class="title h2">cara pembayaran</h2>
                    <?php if ($transaksi['pembayaran'] == 'bca') { ?>
                        <div class="faq-body">
                            <h4 class="panel-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">ATM BCA</h4>
                            <div id="collapseOne" class="panel-content collapse show" data-parent="#accordionExample">
                                <ul class="fa-ul">
                                    <li><i class="fa-li fa fa-check"></i>Masukkan Kartu ATM BCA & PIN</li>
                                    <li><i class="fa-li fa fa-check"></i>Pilih menu Transaksi Lainnya > Transfer > ke Rekening BCA Virtual Account</li>
                                    <li><i class="fa-li fa fa-check"></i>Masukkan nomor Virtual Account diatas</li>
                                    <li><i class="fa-li fa fa-check"></i>Pastikan semua informasi pembayaran Anda telah sesuai</li>
                                    <li><i class="fa-li fa fa-check"></i>Ikuti instruksi untuk menyelesaikan transaksi</li>
                                    <li><i class="fa-li fa fa-check"></i>Simpan struk transaksi sebagai bukti pembayaran</li>
                                </ul>
                            </div>
                        </div>
                        <div class="faq-body">
                            <h4 class="panel-title" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">m-BCA (BCA mobile)</h4>
                            <div id="collapseTwo" class="collapse panel-content">
                                <ul class="fa-ul">
                                    <li><i class="fa-li fa fa-check"></i>Lakukan log in pada aplikasi BCA Mobile</li>
                                    <li><i class="fa-li fa fa-check"></i>Pilih menu m-BCA, kemudian masukkan kode akses m-BCA</li>
                                    <li><i class="fa-li fa fa-check"></i>Pilih m-Transfer > BCA Virtual Account</li>
                                    <li><i class="fa-li fa fa-check"></i>Masukkan nomor Virtual Account diatas</li>
                                    <li><i class="fa-li fa fa-check"></i>Pastikan semua informasi pembayaran Anda telah sesuai</li>
                                    <li><i class="fa-li fa fa-check"></i>Masukkan pin m-BCA</li>
                                    <li><i class="fa-li fa fa-check"></i>Pembayaran selesai. Simpan notifikasi yang muncul sebagai bukti pembayaran</li>
                                </ul>
                            </div>
                        </div>
                        <div class="faq-body">
                            <h4 class="panel-title" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Internet Banking BCA</h4>
                            <div id="collapseThree" class="collapse panel-content">
                                <ul class="fa-ul">
                                    <li><i class="fa-li fa fa-check"></i>Login pada alamat Internet Banking BCA (<a href="https://klikbca.com" target="_blank">https://klikbca.com</a>)</li>
                                    <li><i class="fa-li fa fa-check"></i>Pilih menu Pembayaran Tagihan > Pembayaran > BCA Virtual Account</li>
                                    <li><i class="fa-li fa fa-check"></i>Masukkan nomor Virtual Account diatas</li>
                                    <li><i class="fa-li fa fa-check"></i>Pastikan semua informasi pembayaran Anda telah sesuai</li>
                                    <li><i class="fa-li fa fa-check"></i>Masukkan password dan mToken</li>
                                    <li><i class="fa-li fa fa-check"></i>Cetak/simpan struk pembayaran BCA Virtual Account sebagai bukti pembayaran</li>
                                </ul>
                            </div>
                        </div>
                    <?php } else if ($transaksi['pembayaran'] == 'mandiri') { ?>
                        <div class="faq-body">
                            <h4 class="panel-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">ATM Mandiri</h4>
                            <div id="collapseOne" class="panel-content collapse show" data-parent="#accordionExample">
                                <ul class="fa-ul">
                                    <li><i class="fa-li fa fa-check"></i>Masukkan kartu ATM dan PIN</li>
                                    <li><i class="fa-li fa fa-check"></i>Pilih menu "Bayar/Beli"</li>
                                    <li><i class="fa-li fa fa-check"></i>Pilih menu "Lainnya", hingga menemukan menu "Multipayment"</li>
                                    <li><i class="fa-li fa fa-check"></i>Masukkan Kode Biller (<?= $transaksi['deeplink']; ?>), lalu pilih Benar</li>
                                    <li><i class="fa-li fa fa-check"></i>Masukkan nomor Virtual Account diatas, lalu pilih tombol Benar</li>
                                    <li><i class="fa-li fa fa-check"></i>Masukkan Angka "1" untuk memilih tagihan, lalu pilih tombol Ya</li>
                                    <li><i class="fa-li fa fa-check"></i>Akan muncul konfirmasi pembayaran, lalu pilih tombol Ya</li>
                                    <li><i class="fa-li fa fa-check"></i>Simpan struk sebagai bukti pembayaran Anda</li>
                                </ul>
                            </div>
                        </div>
                        <div class="faq-body">
                            <h4 class="panel-title" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Mandiri Internet Banking / Mandiri Online</h4>
                            <div id="collapseTwo" class="collapse panel-content">
                                <ul class="fa-ul">
                                    <li><i class="fa-li fa fa-check"></i>Login Mandiri Online dengan memasukkan Username dan Password</li>
                                    <li><i class="fa-li fa fa-check"></i>Pilih menu "Pembayaran"</li>
                                    <li><i class="fa-li fa fa-check"></i>Pilih menu "Multipayment"</li>
                                    <li><i class="fa-li fa fa-check"></i>Pilih penyedia jasa "Midtrans"</li>
                                    <li><i class="fa-li fa fa-check"></i>Masukkan "Nomor Virtual Account" diatas dan "Nominal" yang akan dibayarkan, lalu pilih Lanjut</li>
                                    <li><i class="fa-li fa fa-check"></i>Setelah muncul tagihan, pilih Konfirmasi</li>
                                    <li><i class="fa-li fa fa-check"></i>Masukkan PIN / Challenge Code Token</li>
                                    <li><i class="fa-li fa fa-check"></i>Transaksi selesai, simpan bukti bayar Anda</li>
                                </ul>
                                <hr>
                                <p>Jangan gunakan fitur "Simpan Daftar Transfer" untuk pembayaran melalui Internet Banking karena dapat mengganggu proses pembayaran berikutnya. <br> Untuk menghapus daftar transfer tersimpan ikuti langkah berikut:</p>
                                <ul class="fa-ul">
                                    <li><i class="fa-li fa fa-check"></i>Login Mandiri Online</li>
                                    <li><i class="fa-li fa fa-check"></i>Pilih ke menu Pembayaran</li>
                                    <li><i class="fa-li fa fa-check"></i>Pilih menu Daftar Pembayaran</li>
                                    <li><i class="fa-li fa fa-check"></i>Pilih pada pembayaran yang tersimpan, lalu pilih menu untuk hapus</li>
                                </ul>
                            </div>
                        </div>
                    <?php } else if ($transaksi['pembayaran'] == 'bni') { ?>
                        <div class="faq-body">
                            <h4 class="panel-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">ATM BNI</h4>
                            <div id="collapseOne" class="panel-content collapse show" data-parent="#accordionExample">
                                <ul class="fa-ul">
                                    <li><i class="fa-li fa fa-check"></i>Masukkan Kartu Anda.</li>
                                    <li><i class="fa-li fa fa-check"></i>Pilih Bahasa.</li>
                                    <li><i class="fa-li fa fa-check"></i>Masukkan PIN ATM Anda.</li>
                                    <li><i class="fa-li fa fa-check"></i>Pilih "Menu Lainnya".</li>
                                    <li><i class="fa-li fa fa-check"></i>Pilih "Transfer".</li>
                                    <li><i class="fa-li fa fa-check"></i>Pilih Jenis rekening yang akan Anda gunakan (Contoh: "Dari Rekening Tabungan").</li>
                                    <li><i class="fa-li fa fa-check"></i>Pilih "Ke Rekening BNI".</li>
                                    <li><i class="fa-li fa fa-check"></i>Masukkan nomor Virtual Account diatas. Masukan jumlah uang sesuai tagihan diatas</li>
                                    <li><i class="fa-li fa fa-check"></i>Konfirmasi, apabila telah sesuai, lanjutkan transaksi.</li>
                                    <li><i class="fa-li fa fa-check"></i>Transaksi telah selesai.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="faq-body">
                            <h4 class="panel-title" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Internet Banking BNI</h4>
                            <div id="collapseTwo" class="collapse panel-content">
                                <ul class="fa-ul">
                                    <li><i class="fa-li fa fa-check"></i>Ketik alamat <a href="https://ibank.bni.co.id" target="_blank">https://ibank.bni.co.id</a> kemudian klik "Enter".</li>
                                    <li><i class="fa-li fa fa-check"></i>Masukkan User ID dan Password.</li>
                                    <li><i class="fa-li fa fa-check"></i>Pilih menu "Transfer".</li>
                                    <li><i class="fa-li fa fa-check"></i>Pilih "Virtual Account Billing".</li>
                                    <li><i class="fa-li fa fa-check"></i>Masukkan nomor Virtual Account yang hendak dibayarkan. Lalu pilih rekening debet yang akan digunakan. Kemudian tekan "lanjut".</li>
                                    <li><i class="fa-li fa fa-check"></i>Kemudian tagihan yang harus dibayarkan akan muncul pada layar konfirmasi.</li>
                                    <li><i class="fa-li fa fa-check"></i>Masukkan Kode Otentikasi Token.</li>
                                    <li><i class="fa-li fa fa-check"></i>Pembayaran Anda Telah Berhasil.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="faq-body">
                            <h4 class="panel-title" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Mobile Banking BNI</h4>
                            <div id="collapseThree" class="collapse panel-content">
                                <ul class="fa-ul">
                                    <li><i class="fa-li fa fa-check"></i>Akses BNI Mobile Banking dari handphone kemudian masukkan user ID dan password.</li>
                                    <li><i class="fa-li fa fa-check"></i>Pilih menu "Transfer".</li>
                                    <li><i class="fa-li fa fa-check"></i>Pilih menu "Virtual Account Billing" kemudian pilih rekening debet.</li>
                                    <li><i class="fa-li fa fa-check"></i>Masukkan nomor Virtual Account diatas pada menu "input baru".</li>
                                    <li><i class="fa-li fa fa-check"></i>Tagihan yang harus dibayarkan akan muncul pada layar konfirmasi.</li>
                                    <li><i class="fa-li fa fa-check"></i>Konfirmasi transaksi dan masukkan Password Transaksi.</li>
                                    <li><i class="fa-li fa fa-check"></i>Pembayaran Anda Telah Berhasil.</li>
                                </ul>
                            </div>
                        </div>
                    <?php } else if ($transaksi['pembayaran'] == 'permata') { ?>
                        <div class="faq-body">
                            <h4 class="panel-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">ATM Permata</h4>
                            <div id="collapseOne" class="panel-content collapse show" data-parent="#accordionExample">
                                <ul class="fa-ul">
                                    <li><i class="fa-li fa fa-check"></i>Masukkan Kartu ATM BCA & PIN</li>
                                    <li><i class="fa-li fa fa-check"></i>Pilih menu Transaksi Lainnya > Pembayaran > Pembayaran Lainnya > Virtual Account</li>
                                    <li><i class="fa-li fa fa-check"></i>Masukkan nomor Virtual Account diatas</li>
                                    <li><i class="fa-li fa fa-check"></i>Pastikan semua informasi pembayaran Anda telah sesuai</li>
                                    <li><i class="fa-li fa fa-check"></i>Ikuti instruksi untuk menyelesaikan transaksi</li>
                                    <li><i class="fa-li fa fa-check"></i>Simpan struk transaksi sebagai bukti pembayaran</li>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

</div>
<!--End Body Content-->

<!--Quick View popup-->
<!-- <div class="modal fade quick-view-popup" id="content_quickview">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div id="ProductSection-product-template" class="product-template__container prstyle1">
                    <div class="product-single">
                        <a href="javascript:void()" data-dismiss="modal" class="model-close-btn pull-right" title="close"><span class="icon icon anm anm-times-l"></span></a>
                        <div class="row pt-3">
                            <div class="col-lg mx-auto">
                                <div class="product-single__meta">
                                    <form method="post" action="" class="product-form product-form-product-template hidedropdown" enctype="multipart/form-data">
                                        <div class="swatch clearfix swatch-0 option1" data-option-index="0">
                                            <div class="modal-body">
                                                <input type="hidden" value="" name="id" id="id">
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
                                        <div class="product-action clearfix">
                                            <div class="product-form__item--submit">
                                                <button type="submit" name="add" class="btn product-form__cart-submit">
                                                    <span>Simpan</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!--End Quick View popup-->

<script src="https://js.pusher.com/5.1/pusher.min.js"></script>
<script>
    <?php if ($transaksi['pembayaran'] == 'gopay') { ?>
        document.getElementById("carabayar").innerHTML = "";
    <?php } ?>

    var pusher = new Pusher('53605ae7340f790a342a', {
        cluster: 'ap1',
        forceTLS: true
    });

    var order_id = <?= $this->uri->segment(3) ?>;
    var channel = pusher.subscribe('clientNotif' + order_id);
    channel.bind('settlement', function(data) {
        if (data.id == order_id) {
            location.reload();
        }
    });
</script>

<?php
if ($transaksi['status'] == 2) { ?>
    <script type="text/javascript">
        var countDownDate = <?php
                            echo strtotime($transaksi['waktu_batas']) ?> * 1000;
        var now = <?php echo strtotime($time) ?> * 1000;

        <?php
        if ($transaksi['pembayaran'] == 'gopay') { ?>
            document.getElementById("info").innerHTML = "<p style='font-size: 30px'>Silahkan lakukan pembayaran sebesar Rp. <strong><?= number_format($transaksi['total'], 0, ".", "."); ?></strong>, sebelum <strong><?= date("d F Y H:i:s", strtotime($transaksi['waktu_batas'])) ?></strong></p><div id='infobayar'><h1>Untuk menyelesaikan pembayaran dengan GO-PAY, buka aplikasi GO-JEK dan scan kode QR berikut.</h1><div class='row justify-content-center'><div class='col-3 text-center'><div class='text-center img-fluid'><img src='<?= $transaksi['code_bayar']; ?>'></div></div></div><h3>Atau tekan tombol berikut untuk membuka aplikasi Go-jek.</h3><p><a href='<?= $transaksi['deeplink']; ?>' target='_blank' class='btn btn--has-icon-after'>Buka Go-jek <i class='fa fa-caret-right' aria-hidden='true'></i></a></p><br>Halaman ini akan diperbarui saat pembayaran Anda selesai.</div>";
        <?php } else if ($transaksi['pembayaran'] == 'mandiri') { ?>
            document.getElementById("info").innerHTML = "<p style='font-size: 30px'>Silahkan lakukan pembayaran sebesar Rp. <strong><?= number_format($transaksi['total'], 0, ".", "."); ?></strong>, sebelum <strong><?= date("d F Y H:i:s", strtotime($transaksi['waktu_batas'])) ?></strong></p><div id='infobayar'><div class='row justify-content-center'><div class='col-6'><table style='font-size:200%' class='table table-hover table-responsive-md text-left'><tbody><tr><td>Bank</td><td>:</td><td><?= strtoupper($transaksi['pembayaran']); ?></td></tr><tr><td>Kode Biller</td><td>:</td><td><?= $transaksi['deeplink']; ?></td></tr><tr><td>No. Virtual Account</td><td>:</td><td><strong><?= $transaksi['code_bayar']; ?></strong></td></tr></tbody></table></div></div></div>";
        <?php } else { ?>
            document.getElementById("info").innerHTML = "<p style='font-size: 30px'>Silahkan lakukan pembayaran sebesar Rp. <strong><?= number_format($transaksi['total'], 0, ".", "."); ?></strong>, sebelum <strong><?= date("d F Y H:i:s", strtotime($transaksi['waktu_batas'])) ?></strong></p><div id='infobayar'><div class='row justify-content-center'><div class='col-6'><table style='font-size:200%' class='table table-hover table-responsive-md text-left'><tbody><tr><td>Bank</td><td>:</td><td><?= strtoupper($transaksi['pembayaran']); ?></td></tr><tr><td>No. Virtual Account</td><td>:</td><td><strong><?= $transaksi['code_bayar']; ?></strong></td></tr></tbody></table></div></div></div>";
        <?php } ?>

        document.getElementById("judul").innerHTML = "<div class='alert alert-success'  role='alert'><p style='font-size: 20px'><strong>Selamat!</strong> Anda berhasil melakukan pemesanan produk. Cara dan batas pembayaran sebagai berikut.</p></div>";
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
                        document.getElementById("judul").innerHTML = "<div class='alert alert-danger'  role='alert'><p style='font-size: 20px'><strong>Maaf!</strong> Pemesanan anda dibatalkan karena waktu pembayaran telah habis</p></div>";
                        document.getElementById("infobayar").innerHTML = "";
                    }
                });
            }
        }, 1000);
    </script>
<?php } else if ($transaksi['status'] == 3) { ?>
    <script type="text/javascript">
        document.getElementById("carabayar").innerHTML = "";
        document.getElementById("judul").innerHTML = "<div class='alert alert-success'  role='alert'><p style='font-size: 20px'><strong>Informasi!</strong> Pesanan anda sedang dalam proses <strong>pemasakan</strong>. Berikut detail pesanan anda.</p></div>";
    </script>
<?php } else if ($transaksi['status'] == 4) { ?>
    <script>
        document.getElementById("carabayar").innerHTML = "";
        document.getElementById("judul").innerHTML = "<div class='alert alert-success'  role='alert'><p style='font-size: 20px'><strong>Informasi!</strong> Pesanan anda sedang dalam proses <strong>pengiriman</strong>. Berikut detail pesanan anda.</p></div>";
    </script>
<?php } else if ($transaksi['status'] == 6) { ?>
    <script>
        document.getElementById("judul").innerHTML = "<div class='alert alert-danger'  role='alert'><p style='font-size: 20px'><strong>Maaf!</strong> Pemesanan anda dibatalkan karena waktu pembayaran telah habis</p></div>";
        document.getElementById("time").innerHTML = "<p class='text-danger' style='font-size: 50px'>TRANSAKSI EXPIRED</p>";
        document.getElementById("info").innerHTML = "<p style='font-size: 30px'>Silahkan lakukan pembayaran sebesar Rp. <strong><?= number_format($transaksi['total'], 0, ".", "."); ?></strong>, sebelum <strong><?= date("d F Y H:i:s", strtotime($transaksi['waktu_batas'])) ?></strong></p>";
    </script>
<?php } else { ?>
    <script type="text/javascript">
        document.getElementById("judul").innerHTML = "<div class='alert alert-success'  role='alert'><p style='font-size: 20px'><strong>Informasi!</strong> Pesanan anda sudah <strong>selesai</strong>. Berikut detail pesanan anda.</p></div>";
        document.getElementById("carabayar").innerHTML = "";
    </script>
<?php } ?>