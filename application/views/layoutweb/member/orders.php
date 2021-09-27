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
                            <a href="<?= base_url('member/orders') ?>" class="<?php if ($this->uri->segment(2) == 'orders') {
                                                                                    echo 'active';
                                                                                } ?> list-group-item d-flex justify-content-between align-items-center">
                                <span>Orders</span>
                                <small class="badge badge-pill badge-primary"><?= $list ?></small>
                            </a>
                            <a href="<?= base_url('livechat') ?>" class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Live Chat</span>
                            </a>
                            <a href="<?= base_url('member/dashboard') ?>" class="list-group-item d-flex justify-content-between align-items-center">
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
            <div class="col-12 col-sm-12 col-md-9 col-lg-9 main-col">
                <div class="row">
                    <div class="col-lg">
                        <h3><strong>PESANAN PROSES</strong></h3>
                    </div>
                </div>
                <table class="table table-hover table-responsive-md">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Waktu Pemesanan</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th style="width: 25px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order as $o) {
                            if ($o->status < 5) {
                                $waktu = date("d F Y H:i:s", strtotime($o->waktu));
                        ?>
                                <tr>
                                    <th># <?= $o->transaksi_id ?></th>
                                    <td><?= $waktu ?></td>
                                    <td>Rp. <?= number_format($o->total, 0, ".", "."); ?></td>
                                    <td><?php if ($o->status == 1) {
                                            echo "<span class='badge badge-warning'>konfirmasi dapur</span>";
                                        } else if ($o->status == 2) {
                                            echo "<span class='badge badge-danger'>menunggu pembayaran</span>";
                                        } else if ($o->status == 3) {
                                            echo "<span class='badge badge-info'>memasak</span>";
                                        } else {
                                            echo "<span class='badge badge-info'>mengirim</span>";
                                        } ?></span></td>
                                    <td><a href="<?php if ($o->status == 1) {
                                                        echo base_url('checkout/cek_dapur/') . $o->transaksi_id;
                                                    } else {
                                                        echo base_url('payment/gateway/') . $o->transaksi_id;
                                                    }  ?>" class="btn btn-primary btn-sm">View</a></td>
                                </tr>
                        <?php }
                        }
                        ?>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-lg pt-4">
                        <h3><strong>PESANAN SELESAI</strong></h3>
                    </div>
                </div>
                <table class="table table-hover table-responsive-md">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Waktu Pemesanan</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th style="width: 25px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order as $o) {
                            if ($o->status == 5 || $o->status == 6) {
                                $waktu = date("d F Y H:i:s", strtotime($o->waktu));
                        ?>
                                <tr>
                                    <th># <?= $o->transaksi_id ?></th>
                                    <td><?= $waktu ?></td>
                                    <td>Rp. <?= number_format($o->total, 0, ".", "."); ?></td>
                                    <td><?php if ($o->status == 5) {
                                            echo "<span class='badge badge-success'>selesai</span>";
                                        } else if ($o->status == 6) {
                                            echo "<span class='badge badge-danger'>expired</span>";
                                        } ?></td>
                                    <td><a href="<?= base_url('payment/gateway/') . $o->transaksi_id ?>" class="btn btn-primary btn-sm">View</a></td>
                                </tr>
                        <?php }
                        }
                        ?>
                    </tbody>
                </table>
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