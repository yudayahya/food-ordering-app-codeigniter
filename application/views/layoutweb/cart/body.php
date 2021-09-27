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
    <!--End Page Title-->

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
                <?= $this->session->flashdata('message'); ?>
                <form action="<?= base_url('cart/shopcart') ?>" method="post" class="cart style2">
                    <table>
                        <thead class="cart__row cart__header">
                            <tr>
                                <th colspan="2" class="text-center">Product</th>
                                <th class="text-center">Price</th>
                                <th class="text-center" style="max-width: 20px">Quantity</th>
                                <th class="text-right">Total</th>
                                <th class="action">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $subtotal = 0;
                            $total = 0;
                            if (!$this->cart->contents()) {
                                echo "<tr>
                                <td>Keranjang Belanja Anda Kosong<td>
                                <tr>";
                            } else {


                                foreach ($this->cart->contents() as $i) {
                                    $saos = $this->db->get_where('tabel_varian_saus', array('varian_id' => $i['options']['varian_id']))->row_array();
                                    $produk = $this->db->get_where('tabel_produk', ['produk_id' => $i['id']])->row_array();
                            ?>
                                    <tr class="cart__row border-bottom line1 cart-flex border-top">
                                        <td class="cart__image-wrapper cart-flex-item small--hide">
                                            <a href="<?= base_url('produk/detail/') . $produk['produk_nama_seo'] ?>"><img class="cart__image" src="<?= base_url('assets/gambar_produk/') . $produk['gambar'] ?>" alt=""></a>
                                        </td>
                                        <td class="cart__meta small--text-left cart-flex-item">
                                            <div class="list-view-item__title">
                                                <a href="<?= base_url('produk/detail/') . $produk['produk_nama_seo'] ?>"><?= $i['name']; ?></a>
                                                <?php if ($saos) { ?>
                                                    <div class="cart__meta-text">
                                                        Saos : <?= $saos['nama_varian'] ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </td>
                                        <td class="cart__price-wrapper cart-flex-item small--hide">
                                            <?php if ($saos) { ?>
                                                <span class="money">Rp. <?= number_format($i['price'] + $saos['harga'], 0, ".", "."); ?></span>
                                            <?php } else { ?>
                                                <span class="money">Rp. <?= number_format($i['price'], 0, ".", "."); ?></span>
                                            <?php } ?>
                                        </td>
                                        <td class="cart-flex-item text-right">
                                            <div class="cart__qty text-center">
                                                <div class="qtyField">
                                                    <input type="hidden" name="id<?= $i['rowid'] ?>" value="<?= $i['rowid'] ?>">
                                                    <input class="cart__qty-input qty" type="number" name="quantity<?= $i['rowid'] ?>" id="qty<?= $i['rowid'] ?>" value="<?= $i['qty']; ?>" pattern="[0-9]*">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($saos) { ?>
                                                <div><span class="money">Rp. <?= number_format($subtotal = ($i['price'] * $i['qty']) + ($saos['harga'] * $i['qty']), 0, ".", "."); ?></span></div>
                                            <?php } else { ?>
                                                <div><span class="money">Rp. <?= number_format($subtotal = $i['price'] * $i['qty'], 0, ".", "."); ?></span></div>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center"><a href="<?= base_url() . 'cart/hapus_item/' . $i['rowid'] ?>" class="btn btn--secondary cart__remove" title="Remove tem"><i class="icon icon anm anm-times-l"></i></a></td>
                                    </tr>
                            <?php
                                    $total += $subtotal;
                                }
                            }

                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-left"><a href="<?= base_url() ?>" class="btn btn-secondary btn--small cart-continue">Continue shopping</a></td>
                                <td colspan="3" class="text-right">
                                    <button type="submit" name="update" class="btn btn-secondary btn--small cart-continue ml-2">Update Cart</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
            </div>

            <div class="container mt-4">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-8 col-lg-8 mb-8 pb-2">
                        <div id="cekongkir" style="display: none">
                            <h5>Cek Ongkos Kirim</h5>
                            <div class="alert alert-info" role="alert">
                                <b>Note:</b> Geser marker atau klik pada map untuk menentukan lokasi anda secara akurat. <b>Izinkan browser untuk mengakses lokasi anda.</b>
                            </div>
                            <div id="note" style="visibility: hidden;">

                            </div>
                            <div id="map_container">
                                <div class="mapHead" id="resultDiv" style="display: none">&nbsp;</div>

                                <div id="lat-long-map" style="height: 400px">&nbsp;</div>
                            </div>
                            <br>
                            <input class="btn btn-default" id="btnGC" type="button" value="Hitung Tarif">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 cart__footer">
                        <div class="solid-border">
                            <div class="row border-bottom pb-2">
                                <span class="col-12 col-sm-6 cart__subtotal-title">Subtotal</span>
                                <span class="col-12 col-sm-6 text-right"><span class="money">Rp. <?= number_format($total, 0, ".", ".") ?></span></span>
                            </div>
                            <div class="row border-bottom pb-2 pt-2">
                                <span class="col-12 col-sm-6 cart__subtotal-title">Ongkos Kirim</span>
                                <div class="col-12 col-sm-6 text-right" id="ongkir">
                                    <button class="btn btn-secondary btn--small" onclick="cekongkir()">Cek Ongkir</button>
                                </div>
                            </div>
                            <div class="row border-bottom pb-2 pt-2">
                                <span class="col-12 col-sm-6 cart__subtotal-title"><strong>Grand Total</strong></span>
                                <span class="col-12 col-sm-6 cart__subtotal-title cart__subtotal text-right"><span class="money" id="totalcart">Rp. <?= number_format($total, 0, ".", ".") ?></span></span>
                            </div>
                            <button onclick="window.location.href = '<?= base_url('checkout') ?>';" name="checkout" id="cartCheckout" class="btn btn--small-wide checkout">Proceed To Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!--End Body Content-->

<link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.js"></script>
<script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-map.js?key=AMRp9A74OBvMWuxGZG0A2y6gR0Ara3u5"></script>
<script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-geocoding.js?key=AMRp9A74OBvMWuxGZG0A2y6gR0Ara3u5"></script>

<script type="text/javascript">
    var x = document.getElementById("note");
    document.getElementById("btnGC").addEventListener("click", tarifInfo);

    function cekongkir() {
        var x = document.getElementById("cekongkir");
        if (x.style.display === "none") {
            x.style.display = "block";
            getLocation();
        } else {
            x.style.display = "none";
        }
    }

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function tarifInfo() {
        var lat = document.getElementById('lat').innerHTML;
        var lng = document.getElementById('lng').innerHTML;
        $.ajax({
            url: "https://www.mapquestapi.com/directions/v2/routematrix?key=AMRp9A74OBvMWuxGZG0A2y6gR0Ara3u5&json={locations:[{latLng:{lat:-7.736103,lng:110.398838}},{latLng:{lat:" + lat + ",lng:" + lng + "}}],options:{allToAll:false}}",
            dataType: 'json',
            type: 'POST',
            success: function(data) {
                var myobj, x, tarif;
                myobj = data
                x = myobj.distance[1] * 1.60934;
                tarif = x.toFixed(0) * 2000;
                strResult = "Rp. " + rupiahFormat(tarif);
                updateTotal = "Rp. " + rupiahFormat(tarif + <?= $total; ?>);
                document.getElementById('ongkir').innerHTML = strResult;
                document.getElementById('totalcart').innerHTML = updateTotal;
            },
            error: function(xhr, status, error) {
                console.log('error occurred - ' + xhr + status + error)
            }
        });
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

    function showPosition(position) {
        var mapLayer = MQ.mapLayer();
        var mapLeaflet;

        var latLng = new L.LatLng(position.coords.latitude, position.coords.longitude);

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
            strResult = "<div class='mapTitle'><span class='latitude'>Latitude:</span><span id='lat'>" + roundNumber(ll.lat, 6) + "</span><span class='longitude'>, Longitude:</span><span id='lng'>" + roundNumber(ll.lng, 6) + "</span><span class='quality'>, Quality: </span>" + quality + "</div>";
            document.getElementById('resultDiv').innerHTML = strResult;
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
</script>