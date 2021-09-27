<!--Body Content-->
<div id="page-content">
    <!--Page Title-->
    <div class="page section-header text-center">
        <div class="page-title">
            <div class="wrapper">
                <h1 class="page-width">Checkout</h1>
            </div>
        </div>
    </div>
    <!--End Page Title-->
    <form class="form-horizontal" id="formCheckout" method="post" enctype="multipart/form-data">
        <div class="container">
            <div class="row billing-fields">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 sm-margin-30px-bottom">
                    <div class="create-ac-content bg-light-gray padding-20px-all">
                        <fieldset>
                            <h2 class="login-title mb-3">Detail Tagihan</h2>
                            <div class="row">
                                <div class="form-group col-md col-lg col-xl required">
                                    <label for="input-firstname">Nama Lengkap <span class="required-f">*</span></label>
                                    <input name="nama" value="<?= $user['nama_lengkap'] ?>" id="input-firstname" type="text">
                                    <span id="error_nama"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md col-lg col-xl required">
                                    <label for="input-email">E-Mail <span class="required-f">*</span></label>
                                    <input name="email" value="<?= $user['email'] ?>" id="input-email" type="email">
                                    <span id="error_email"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md col-lg col-xl required">
                                    <label for="input-hp">Nomor Handphone <span class="required-f">*</span></label>
                                    <input name="hp" value="<?= $user['no_hp'] ?>" id="input-hp" type="text">
                                    <span id="error_hp"></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="form-group col-md col-lg col-xl required">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-12">
                                        <div id="cekongkir">
                                            <h5>Tentukan Lokasi Pengiriman *</h5>
                                            <div class="alert alert-info" role="alert">
                                                <b>Note:</b> Geser marker atau klik pada map untuk menentukan lokasi anda secara akurat. <b>Izinkan browser untuk mengakses lokasi anda.</b>
                                            </div>
                                            <div id="note" style="visibility: hidden;">

                                            </div>
                                            <div id="map_container">
                                                <div class="mapHead" id="resultDiv" style="display: none">&nbsp;</div>

                                                <div id="lat-long-map" style="height: 400px">&nbsp;</div>
                                            </div>
                                            <input name="lat" id="lat" value="" type="hidden">
                                            <input name="lng" id="lng" value="" type="hidden">
                                            <input name="inputongkir" id="inputongkir" value="" type="hidden">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="form-group col-md col-lg col-xl">
                                    <label for="input-catatan">Catatan Pengiriman<span class="required-f">*</span></label>
                                    <textarea name="catatan" class="form-control resize-both" rows="3"></textarea>
                                    <span id="error_catatan"></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="form-group col-md col-lg col-xl">
                                    <label><strong>* Data Wajib Diisi.</strong></label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="your-order-payment">
                        <div class="your-order">
                            <h2 class="order-title mb-4">Pembelian Anda</h2>

                            <div class="table-responsive-sm order-table">
                                <table class="bg-white table table-bordered table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Product Name</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $subtotal = 0;
                                        $total = 0;
                                        foreach ($this->cart->contents() as $i) {
                                            $saos = $this->db->get_where('tabel_varian_saus', array('varian_id' => $i['options']['varian_id']))->row_array();
                                            $produk = $this->db->get_where('tabel_produk', ['produk_id' => $i['id']])->row_array();
                                        ?>
                                            <tr>
                                                <td class="text-left">
                                                    <?= $i['name']; ?><br>
                                                    <?php if ($saos) { ?>
                                                        <div class="cart__meta-text">
                                                            Saos : <?= $saos['nama_varian'] ?>
                                                        </div>
                                                    <?php } ?>
                                                </td>
                                                <?php if ($saos) { ?>
                                                    <td>Rp. <?= number_format($i['price'] + $saos['harga'], 0, ".", "."); ?></td>
                                                <?php } else { ?>
                                                    <td>Rp. <?= number_format($i['price'], 0, ".", "."); ?></td>
                                                <?php } ?>
                                                <td><?= $i['qty']; ?></td>
                                                <?php if ($saos) { ?>
                                                    <td>Rp. <?= number_format($subtotal = ($i['price'] * $i['qty']) + ($saos['harga'] * $i['qty']), 0, ".", "."); ?></td>
                                                <?php } else { ?>
                                                    <td>Rp. <?= number_format($subtotal = $i['price'] * $i['qty'], 0, ".", "."); ?></td>
                                                <?php } ?>
                                            </tr>
                                        <?php
                                            $total += $subtotal;
                                        }

                                        ?>
                                    </tbody>
                                    <tfoot class="font-weight-600">
                                        <tr>
                                            <td colspan="3" class="text-right">Ongkir </td>
                                            <td><span id="ongkir"></span></td>
                                        </tr>
                                        <tr id="rowDiskon">
                                            <!-- row diskon -->
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-right">Total</td>
                                            <td><span id="total"></span></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <input type="hidden" name="total" id="totalbayar" value="">
                                <input type="hidden" name="id_kupon" id="id_kupon" value="">
                                <input type="hidden" name="potongan" id="potongan" value="">
                            </div>
                        </div>

                        <hr>
                        <?php
                        $cek = 0;
                        foreach ($kupon as $k) {
                            $last_date = strtotime($k['last_date']);
                            if ($k['status'] == 1 && date('m/d/Y', time()) <= date('m/d/Y', $last_date)) {
                                $cek = 1;
                            }
                        }
                        if ($cek == 1) { ?>
                            <div style="background-color: #4A975C; color: #fff; font-size: small;" class="badge badge-pill badge-success list-group-item d-flex justify-content-between align-items-center">
                                <span id="ketVoucher">Kamu punya voucher...</span>
                                <a href="#" style="color: #fff;" data-toggle="modal" data-target="#ModalApplyVoucher">
                                    Lihat disini
                                </a>
                            </div>
                            <hr>
                        <?php } ?>

                        <div class="your-payment">
                            <h2 class="payment-title mb-3">Metode Pembayaran</h2>
                            <div class="payment-method">
                                <div class="payment-accordion">
                                    <div id="accordion" class="payment-section">
                                        <div class="card mb-2">
                                            <div class="card-header">
                                                <a class="card-link" data-toggle="collapse" href="#collapseOne"> Transfer Bank (Virtual Account) </a>
                                            </div>
                                            <div id="collapseOne" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="bayar" id="bca" value="bca">
                                                        <label class="form-check-label" for="bca">
                                                            <p class="no-margin font-15">BCA (Automatic Check)</p>
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="bayar" id="mandiri" value="mandiri">
                                                        <label class="form-check-label" for="mandiri">
                                                            <p class="no-margin font-15">Mandiri (Automatic Check)</p>
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="bayar" id="bni" value="bni">
                                                        <label class="form-check-label" for="bni">
                                                            <p class="no-margin font-15">BNI (Automatic Check)</p>
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="bayar" id="permata" value="permata">
                                                        <label class="form-check-label" for="permata">
                                                            <p class="no-margin font-15">Permata (Automatic Check)</p>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mb-2">
                                            <div class="card-header">
                                                <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo"> E-money </a>
                                            </div>
                                            <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="bayar" id="gopay" value="gopay">
                                                        <label class="form-check-label" for="gopay">
                                                            <p class="no-margin font-15">Gopay (Automatic check)</p>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <span id="message"></span>
                                        <span id="error_inputongkir"></span>
                                    </div>
                                </div>

                                <div class="order-button-payment">
                                    <button class="btn" value="Place order" id="btn_checkout" type="submit">Place order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!--End Body Content-->

<!-- Modal Voucher -->
<div class="modal fade" id="ModalApplyVoucher" tabindex="-1" role="dialog" aria-labelledby="ModalApplyVoucherTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalApplyVoucherLongTitle">Voucher Yang Tersedia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="overflow: auto; height: 400px;">
                    <?php foreach ($kupon as $k) {
                        $last_date = strtotime($k['last_date']);
                        $kuponused = count($this->db->get_where('tabel_kupon_used', array('id_kupon' => $k['id'], 'id_member' => $this->session->userdata('id')))->result());
                        if ($k['status'] == 1 && date('m/d/Y', time()) <= date('m/d/Y', $last_date) && $kuponused < $k['valid_per_member']) { ?>
                            <div>
                                <nav class="list-group customer-nav">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span><strong><?= $k['kupon_nama']; ?></strong></span>
                                        <a style="font-size: small;" href="javascript:void(0)" id="apply_voucher<?= $k['id']; ?>" onclick="apply_voucher(<?= $k['id']; ?>)" class="badge badge-pill badge-success">Apply now</a>
                                    </div>
                                </nav>
                                <nav class="list-group customer-nav">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>Minimal Pembelian Rp. <?= number_format($k['minimum_spend'], 0, ".", "."); ?></span>
                                    </div>
                                </nav>
                                <?php if ($k['kupon_type'] == 1) { ?>
                                    <nav class="list-group customer-nav">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span>Maksimal Diskon Rp. <?= number_format($k['maksimal_diskon'], 0, ".", "."); ?></span>
                                        </div>
                                    </nav>
                                <?php } ?>
                                <nav class="list-group customer-nav">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>Expire on <?= date('M d, Y', $last_date); ?></span>
                                    </div>
                                </nav>
                                <hr>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.js"></script>
<script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-map.js?key=AMRp9A74OBvMWuxGZG0A2y6gR0Ara3u5"></script>
<script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-geocoding.js?key=AMRp9A74OBvMWuxGZG0A2y6gR0Ara3u5"></script>
<script src="<?= base_url() ?>template/belle/assets/js/vendor/jquery-3.3.1.min.js"></script>

<script type="text/javascript">
    var totalpembelian = <?= $total ?>;
    $(document).ready(function() {
        if (localStorage.getItem("id") != null) {
            validasi_kupon();
            getLocation();
        } else {
            getLocation();
        }
    });

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        var mapLayer = MQ.mapLayer();
        var mapLeaflet;

        <?php if (!$user['lat'] || !$user['lng']) { ?>
            var latLng = new L.LatLng(position.coords.latitude, position.coords.longitude);
        <?php } else { ?>
            var latLng = new L.LatLng(<?= $user['lat'] ?>, <?= $user['lng'] ?>);
        <?php } ?>

        showLL(latLng, '');

        var map = L.map('lat-long-map', {
            layers: mapLayer,
            center: latLng,
            zoom: 15
        }).on('click', function(e) {
            addMarker(e);
        });


        var mapQuestMarker = L.icon({
            iconUrl: MQ.mapConfig.getConfig("imagePath") + 'poi.png',
            iconRetinaUrl: MQ.mapConfig.getConfig("imagePath") + 'poi@2x.png',
            iconSize: [36, 35],
            iconAnchor: [15, 35],
            popupAnchor: [-1, -30]
        });

        var popup = L.marker(latLng, {
            icon: mapQuestMarker,
            draggable: true
        }).addTo(map);

        popup.on('dragend', function(event) {
            var marker = event.target;
            var position = marker.getLatLng().wrap();
            showLL(position, 'USER_DEFINED');
        });

        function roundNumber(num, dec) {
            return Math.round(num * Math.pow(10, dec)) / Math.pow(10, dec);
        }

        function clearMap() {
            document.getElementById('resultDiv').innerHTML = strResult;
        }

        function addMarker(e) {
            popup.setLatLng(e.latlng);
            showLL(e.latlng.wrap(), 'USER_DEFINED');
        }

        function showLL(ll, quality) {
            $.ajax({
                url: "https://www.mapquestapi.com/directions/v2/routematrix?key=AMRp9A74OBvMWuxGZG0A2y6gR0Ara3u5&json={locations:[{latLng:{lat:-7.736103,lng:110.398838}},{latLng:{lat:" + roundNumber(ll.lat, 6) + ",lng:" + roundNumber(ll.lng, 6) + "}}],options:{allToAll:false}}",
                dataType: 'json',
                type: 'POST',
                success: function(data) {
                    var myobj, x, tarif;
                    myobj = data
                    x = myobj.distance[1] * 1.60934;
                    tarif = x.toFixed(0) * 2000;
                    localStorage.setItem("ongkir", tarif);
                    hitungbayar(localStorage.getItem("ongkir"));

                    strResult = "Rp. " + rupiahFormat(tarif);
                    document.getElementById('ongkir').innerHTML = strResult;
                    document.getElementById("lat").value = roundNumber(ll.lat, 6);
                    document.getElementById("lng").value = roundNumber(ll.lng, 6);
                    document.getElementById("inputongkir").value = tarif;
                },
                error: function(xhr, status, error) {
                    console.log('error occurred - ' + xhr + status + error)
                }
            });
        }

        function searchKeyPress(e) {
            if (window.event) {
                e = window.event;
            }
            if (e.keyCode == 13) {
                document.getElementById('btnGC').click();
            }
        }
    }

    function hitungbayar(tarif) {
        var ongkir = parseInt(tarif);
        if (localStorage.getItem("nominalDiskon") != null) {
            document.getElementById(localStorage.getItem("idapply")).className = "badge badge-pill badge-danger";
            document.getElementById(localStorage.getItem("idapply")).innerHTML = "Cancel";
            document.getElementById("ketVoucher").innerHTML = "Diskon voucher diterapkan...";
            document.getElementById(localStorage.getItem("idapply")).setAttribute('onclick', 'cancel_voucher(' + localStorage.getItem("id") + ')');
            document.getElementById("rowDiskon").innerHTML = '<td colspan="3" class="text-right">Diskon</td><td><strike>Rp. ' + rupiahFormat(localStorage.getItem("nominalDiskon")) + '</strike></td>';
            totBeli = totalpembelian - localStorage.getItem("nominalDiskon");
            document.getElementById("id_kupon").value = localStorage.getItem("id");
            document.getElementById("potongan").value = localStorage.getItem("nominalDiskon");
            suksesDiskon();
        } else {
            totBeli = totalpembelian;
        }
        total = totBeli + ongkir;

        strResulttotal = "Rp. " + rupiahFormat(total);
        document.getElementById('total').innerHTML = strResulttotal;
        document.getElementById("totalbayar").value = total;
    }

    function rupiahFormat(bilangan) {
        var number_string = bilangan.toString(),
            sisa = number_string.length % 3,
            rupiah = number_string.substr(0, sisa),
            ribuan = number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        return rupiah;
    }

    function validasi_kupon() {
        var id = localStorage.getItem("id");
        if (id != null) {
            $.ajax({
                url: "<?= base_url('checkout/apply_voucher') ?>",
                type: 'POST',
                data: {
                    id: id
                },
                dataType: "json",
                success: function(data) {
                    if (data == 'fail' || data == 'invalid') {
                        localStorage.removeItem("idapply");
                        localStorage.removeItem("id");
                        localStorage.removeItem("nominalDiskon");
                        localStorage.removeItem("ongkir");
                        erorDiskon();
                    } else {
                        if (totalpembelian < parseInt(data.minimum_spend)) {
                            localStorage.removeItem("idapply");
                            localStorage.removeItem("id");
                            localStorage.removeItem("nominalDiskon");
                            localStorage.removeItem("ongkir");
                            erorDiskon();
                        }
                        createDiskon(data);
                    }
                }
            });
        }
    }

    $('#formCheckout').on('submit', function(event) {
        event.preventDefault();
        document.getElementById("btn_checkout").disabled = true;
        document.getElementById("btn_checkout").innerHTML = 'please wait..';
        var formData = new FormData(this);
        var radios = document.getElementsByName("bayar");
        var formValid = false;

        var i = 0;
        while (!formValid && i < radios.length) {
            if (radios[i].checked) formValid = true;
            i++;
        }

        if (!formValid) {
            document.getElementById('message').innerHTML = '<div class="alert alert-danger" role="alert">Anda belum memilih metode pembayaran! Silahkan pilih terlebih dahulu</div>';
            document.getElementById("btn_checkout").disabled = false;
            document.getElementById("btn_checkout").innerHTML = 'place order';
        } else {
            validasi_kupon();
            $.ajax({
                url: "<?= base_url('checkout/validasi_produk') ?>",
                type: 'POST',
                dataType: "json",
                success: function(data) {
                    if (data == 'fail') {
                        document.getElementById("btn_checkout").disabled = false;
                        document.getElementById("btn_checkout").innerHTML = 'place order';
                        erorCheckoutProduk();
                    } else {
                        $.ajax({
                            url: "<?= base_url('checkout/proses_checkout') ?>",
                            enctype: 'multipart/form-data',
                            type: 'post',
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(data) {
                                document.getElementById("btn_checkout").disabled = false;
                                document.getElementById("btn_checkout").innerHTML = 'place order';
                                if (data.error) {
                                    if (data.error_nama != '') {
                                        $('#error_nama').html(data.error_nama);
                                    } else {
                                        $('#error_nama').html('');
                                    }
                                    if (data.error_email != '') {
                                        $('#error_email').html(data.error_email);
                                    } else {
                                        $('#error_email').html('');
                                    }
                                    if (data.error_hp != '') {
                                        $('#error_hp').html(data.error_hp);
                                    } else {
                                        $('#error_hp').html('');
                                    }
                                    if (data.error_inputongkir != '') {
                                        errorMap();
                                    }
                                    if (data.error_catatan != '') {
                                        $('#error_catatan').html(data.error_catatan);
                                    } else {
                                        $('#error_catatan').html('');
                                    }
                                }
                                if (data.success) {
                                    localStorage.removeItem("idapply");
                                    localStorage.removeItem("id");
                                    localStorage.removeItem("nominalDiskon");
                                    localStorage.removeItem("ongkir");
                                    $('#error_nama').html('');
                                    $('#error_email').html('');
                                    $('#error_hp').html('');
                                    $('#error_catatan').html('');
                                    $('#formCheckout')[0].reset();
                                    window.location.href = "<?= base_url('checkout/cek_dapur/') ?>" + data.order_id;
                                }
                            }
                        });
                    }
                }
            });
        }
    });

    function apply_voucher(id) {
        $.ajax({
            url: "<?= base_url('checkout/apply_voucher') ?>",
            type: 'POST',
            data: {
                id: id
            },
            dataType: "json",
            success: function(data) {
                if (data == 'fail' || data == 'invalid') {
                    window.location.reload();
                } else {
                    var cekdiskon = createDiskon(data);
                    $("#ModalApplyVoucher").modal('hide');
                    if (cekdiskon == 'fail') {
                        failDiskon();
                    } else {
                        if (localStorage.getItem("id") != null) {
                            document.getElementById(localStorage.getItem("idapply")).className = "badge badge-pill badge-success";
                            document.getElementById(localStorage.getItem("idapply")).innerHTML = "Apply now";
                            document.getElementById(localStorage.getItem("idapply")).setAttribute('onclick', 'apply_voucher(' + localStorage.getItem("id") + ')');
                            localStorage.setItem("idapply", 'apply_voucher' + data.id);
                            localStorage.setItem("id", data.id);
                        } else {
                            localStorage.setItem("idapply", 'apply_voucher' + data.id);
                            localStorage.setItem("id", data.id);
                        }
                        hitungbayar(localStorage.getItem("ongkir"));
                    }
                }
            }
        });
    }

    function cancel_voucher(id) {
        $.ajax({
            url: "<?= base_url('checkout/apply_voucher') ?>",
            type: 'POST',
            data: {
                id: id
            },
            dataType: "json",
            success: function(data) {
                $("#ModalApplyVoucher").modal('hide');
                localStorage.setItem("idapply", 'apply_voucher' + data.id);
                localStorage.setItem("id", data.id);
                localStorage.removeItem("nominalDiskon");
                document.getElementById(localStorage.getItem("idapply")).className = "badge badge-pill badge-success";
                document.getElementById(localStorage.getItem("idapply")).innerHTML = "Apply now";
                document.getElementById("ketVoucher").innerHTML = "Kamu punya voucher...";
                document.getElementById("rowDiskon").innerHTML = '';
                document.getElementById(localStorage.getItem("idapply")).setAttribute('onclick', 'apply_voucher(' + data.id + ')');
                document.getElementById("id_kupon").value = '';
                document.getElementById("potongan").value = '';
                hitungbayar(localStorage.getItem("ongkir"));
            }
        });
    }

    function createDiskon(data) {
        totalbeli = totalpembelian;
        if (totalbeli >= data.minimum_spend) {
            if (data.kupon_type == 1) {
                diskon = totalbeli * (data.diskon / 100);
                if (diskon > data.maksimal_diskon) {
                    diskon = data.maksimal_diskon;
                }
            } else {
                diskon = data.diskon
            }
            localStorage.setItem("nominalDiskon", diskon);
        } else {
            return 'fail';
        }
    }
</script>