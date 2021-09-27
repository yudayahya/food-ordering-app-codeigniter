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
            <div class="col-lg">
                <?= $this->session->flashdata('message'); ?>
            </div>
        </div>
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
                            <a href="<?= base_url('member/dashboard') ?>" class="<?php if ($this->uri->segment(2) == 'dashboard') {
                                                                                        echo 'active';
                                                                                    } ?> list-group-item d-flex justify-content-between align-items-center">
                                <span>Profile</span>
                            </a>
                            <a href="<?= base_url('member/edit') ?>" class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Edit Profile</span>
                            </a>
                            <a href="<?= base_url('member/logout') ?>" class="list-group-item d-flex justify-content-between align-items-center">
                                <span><span class="fa fa-sign-out"></span>Log out</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-5 col-lg-5 main-col">
                <div class="row">
                    <div class="col-lg">
                        <h3>DETAIL DATA DIRI</h3>
                    </div>
                </div>
                <hr>
                <div class="row pt-2">
                    <div class="col-md-3">
                        <label>Nama Lengkap</label>
                    </div>
                    <div class="col-md-9">
                        <label><?= $user['nama_lengkap'] ?></label>
                    </div>
                </div>
                <hr>
                <div class="row pt-2">
                    <div class="col-md-3">
                        <label>Email</label>
                    </div>
                    <div class="col-md-9">
                        <label><?= $user['email'] ?></label>
                    </div>
                </div>
                <hr>
                <div class="row pt-2">
                    <div class="col-md-3">
                        <label>Username</label>
                    </div>
                    <div class="col-md-9">
                        <label><?= $user['username'] ?></label>
                    </div>
                </div>
                <hr>
                <div class="row pt-2">
                    <div class="col-md-3">
                        <label>Nomor Handphone</label>
                    </div>
                    <div class="col-md-9">
                        <?php if ($user['no_hp'] == null) { ?>
                            <label class="text-danger">Data masih kosong! Silahkan isi terlebih dahulu.</label>
                        <?php } else { ?>
                            <label><?= $user['no_hp'] ?></label>
                        <?php } ?>
                    </div>
                </div>
                <hr>
                <div class="row pt-2">
                    <div class="col-md">
                        <label>Lokasi Pengiriman :</label>
                    </div>
                </div>
                <div class="row pt-2">
                    <div class="col-md">
                        <?php if (!$user['lat'] || !$user['lng']) { ?>
                            <label class="text-danger">Data masih kosong! Silahkan isi terlebih dahulu.</label>
                        <?php } else {
                            echo '<img src="https://www.mapquestapi.com/staticmap/v4/getmap?key=AMRp9A74OBvMWuxGZG0A2y6gR0Ara3u5&size=600,400&type=map&imagetype=png&pois=mcenter,' . $user['lat'] . ',' . $user['lng'] . '"/>';
                        } ?>
                    </div>
                </div>
                <hr>
                <div class="mb-4">
                    <a href="<?= base_url('member/ubahpassword') ?>" name="gantipass" id="gantipass" class="btn btn--small-wide checkout">Ubah Password</a>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 cart__footer">
                <div class="cart-note">
                    <div class="solid-border">
                        <div class="row mb-4">
                            <div class="col-sm">
                                <h5><label for="CartSpecialInstructions" class="cart-note__label small--text-center">Available Vouchers</label></h5>
                                <span>Gunakan voucher saat proses checkout.</span>
                            </div>
                        </div>
                        <?php
                        $cek = 0;
                        foreach ($kupon as $k) {
                            $last_date = strtotime($k['last_date']);
                            $kuponused = count($this->db->get_where('tabel_kupon_used', array('id_kupon' => $k['id'], 'id_member' => $this->session->userdata('id')))->result());
                            if ($k['status'] == 1 && date('m/d/Y', time()) <= date('m/d/Y', $last_date) && $kuponused < $k['valid_per_member']) {
                                $cek = 1;
                            }
                        }
                        if ($cek == 0) { ?>
                            <nav class="list-group customer-nav">
                                <div class="align-items-center">
                                    <span><strong>Saat ini kamu tidak punya voucher.</strong></span>
                                </div>
                            </nav>
                        <?php } ?>
                        <?php foreach ($kupon as $k) {
                            $last_date = strtotime($k['last_date']);
                            $kuponused = count($this->db->get_where('tabel_kupon_used', array('id_kupon' => $k['id'], 'id_member' => $this->session->userdata('id')))->result());
                            if ($k['status'] == 1 && date('m/d/Y', time()) <= date('m/d/Y', $last_date) && $kuponused < $k['valid_per_member']) { ?>
                                <div>
                                    <nav class="list-group customer-nav">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span><strong><?= $k['kupon_nama']; ?></strong></span>
                                            <a href="<?= base_url('kategori'); ?>" class="badge badge-pill badge-success">Shop now</a>
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
                                            <a href="javascript:void(0)" onclick="voucher_detail(<?= $k['id']; ?>)" style="color: #4A975C">View details</a>
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

</div>
<!--End Body Content-->

<!--Ubah Foto Profil popup-->
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
<!--End Ubah Foto Profil popup-->

<!--Detail Vouchers popup-->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="ModalDetailVoucher">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div id="ProductSection-product-template" class="product-template__container prstyle1">
                    <div class="product-single">
                        <div id="ProductSection-product-template" class="product-template__container prstyle1 container">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="deskripsi-tab" data-toggle="tab" href="#deskripsi" role="tab" aria-controls="deskripsi" aria-selected="true">Deskripsi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="layanan-tab" data-toggle="tab" href="#layanan" role="tab" aria-controls="layanan" aria-selected="false">Layanan Ketentuan</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active pt-2" id="deskripsi" role="tabpanel" aria-labelledby="deskripsi-tab"></div>
                                <div class="tab-pane fade pt-2" id="layanan" role="tabpanel" aria-labelledby="layanan-tab"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Detail Vouchers popup-->