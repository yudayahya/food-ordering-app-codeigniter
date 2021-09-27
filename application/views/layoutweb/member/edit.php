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
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 cart__footer mb-4">
                <div class="cart-note">
                    <div class="solid-border">
                        <div class="row">
                            <div class="col-sm-10">
                                <h5><label for="CartSpecialInstructions" class="cart-note__label small--text-center">Foto Profile</label></h5>
                            </div>
                            <div class="col-sm-2">
                                <a href="javascript:void(0)" title="Ganti Foto" data-toggle="modal" data-target="#content_quickview">
                                    <i class="anm anm-edit" aria-hidden="true"></i>
                                </a>
                            </div>
                            <div class="customer-profile">
                                <a href="#" class="d-inline-block"><img src="<?= base_url('assets/gambar_member/') . $user['gambar'] ?>" class="img-fluid rounded-circle customer-image">
                                </a>
                            </div>
                            <div class="col-lg pt-3">
                                <h5 class="d-flex justify-content-center"><?= $user['nama_lengkap'] ?></h5>
                                <p class="text-muted text-small d-flex justify-content-center"><?= $user['email'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <nav class="list-group customer-nav">
                            <a href="<?= base_url('member/orders') ?>" class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Orders</span>
                                <small class="badge badge-pill badge-primary"><?= $list ?></small>
                            </a>
                            <a href="<?= base_url('livechat') ?>" class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Live Chat</span>
                            </a>
                            <a href="<?= base_url('member/dashboard') ?>" class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Profile</span>
                            </a>
                            <a href="<?= base_url('member/edit') ?>" class="<?php if ($this->uri->segment(2) == 'edit') {
                                                                                echo 'active';
                                                                            } ?> list-group-item d-flex justify-content-between align-items-center">
                                <span>Edit Profile</span>
                            </a>
                            <a href="<?= base_url('member/logout') ?>" class="list-group-item d-flex justify-content-between align-items-center">
                                <span><span class="fa fa-sign-out"></span>Log out</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-9 col-lg-9 main-col">
                <form method="post" action="<?= base_url('member/edit') ?>" id="CustomerLoginForm" accept-charset="UTF-8" class="contact-form">
                    <input type="hidden" name="id" value="<?= $user['member_id'] ?>">
                    <div class="row">
                        <div class="col-lg">
                            <h3>EDIT DATA DIRI</h3>
                        </div>
                    </div>
                    <hr>
                    <div class="row pt-2">
                        <div class="col-md-4">
                            <label>Email</label>
                        </div>
                        <div class="col-md-8">
                            <label><?= $user['email'] ?></label>
                        </div>
                    </div>
                    <hr>
                    <div class="row pt-2">
                        <div class="col-md-4">
                            <label>Username</label>
                        </div>
                        <div class="col-md-8">
                            <label><?= $user['username'] ?></label>
                        </div>
                    </div>
                    <hr>
                    <div class="row pt-2">
                        <div class="col-md-4">
                            <label>Nama Lengkap</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="nama" placeholder="Nama lengkap" id="Customernama" value="<?= $user['nama_lengkap'] ?>">
                            <?= form_error('nama', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row pt-2">
                        <div class="col-md-4">
                            <label>Nomor Handphone</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="hp" placeholder="Nomor Handphone" id="Customerhp" value="<?= $user['no_hp'] ?>">
                            <?= form_error('hp', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row pt-2">
                        <div class="col-md-4">
                            <label>Lokasi Pengiriman</label>
                        </div>
                        <div class="col-md-8">
                            <div class="alert alert-info" role="alert">
                                <b>Note:</b> Geser marker atau klik pada map untuk menentukan lokasi anda secara akurat. <b>Izinkan browser untuk mengakses lokasi anda.</b>
                            </div>
                            <div id="note" style="visibility: hidden;">

                            </div>
                            <div id="map_container">
                                <div class="mapHead" id="resultDiv">&nbsp;</div>

                                <div id="lat-long-map" style="height: 400px">&nbsp;</div>
                            </div>
                            <input name="lat" id="lat" value="" type="hidden">
                            <input name="lng" id="lng" value="" type="hidden">
                            <?= form_error('lat', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-4">
                        <button type="submit" name="edit" id="edit" class="btn btn--small-wide checkout">Simpan Data</button>
                    </div>
                </form>
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
                        <div class="row">
                            <div class="col-sm-6 mx-auto">
                                <div class="product-details-img">
                                    <div class="pl-20">
                                        <img src="<?= base_url('assets/gambar_member/') . $user['gambar'] ?>" class="rounded" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-sm-10 mx-auto">
                                <div class="product-single__meta">
                                    <form method="post" action="<?= base_url('member/gambar') ?>" class="product-form product-form-product-template hidedropdown" enctype="multipart/form-data">
                                        <div class="swatch clearfix swatch-0 option1" data-option-index="0">
                                            <div class="product-form__item">
                                                <input type="hidden" value="<?= $user['member_id'] ?>" name="id" id="id">
                                                <input type="file" id="gambar" name="gambar" class="form-control" required>
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

<link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.js"></script>
<script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-map.js?key=AMRp9A74OBvMWuxGZG0A2y6gR0Ara3u5"></script>
<script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-geocoding.js?key=AMRp9A74OBvMWuxGZG0A2y6gR0Ara3u5"></script>

<script type="text/javascript">
    window.onload = getLocation;

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
            document.getElementById("lat").value = roundNumber(ll.lat, 6);
            document.getElementById("lng").value = roundNumber(ll.lng, 6);
        }
    }
</script>