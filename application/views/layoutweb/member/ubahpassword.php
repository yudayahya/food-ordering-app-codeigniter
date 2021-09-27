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
                            <a href="<?= base_url('member/dashboard') ?>" class="<?php if ($this->uri->segment(2) == 'ubahpassword') {
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
            <div class="col-12 col-sm-12 col-md-9 col-lg-9 main-col">
                <form method="post" action="<?= base_url('member/ubahpassword') ?>" id="CustomerLoginForm" accept-charset="UTF-8" class="contact-form">
                    <input type="hidden" name="id" value="<?= $user['member_id'] ?>">
                    <div class="row">
                        <div class="col-lg">
                            <h3>UBAH PASSWORD</h3>
                        </div>
                    </div>
                    <hr>
                    <div class="row pt-2">
                        <div class="col-md-4">
                            <label>Masukan Password</label>
                        </div>
                        <div class="col-md-8">
                            <input type="password" name="password" placeholder="password" id="Customerpass">
                            <?= form_error('password', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row pt-2">
                        <div class="col-md-4">
                            <label>Password Baru</label>
                        </div>
                        <div class="col-md-8">
                            <input type="password" name="newpassword1" placeholder="password baru" id="Customerpass1">
                            <?= form_error('newpassword1', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row pt-2">
                        <div class="col-md-4">
                            <label>Ulangi Password Baru</label>
                        </div>
                        <div class="col-md-8">
                            <input type="password" name="newpassword2" placeholder="ulangi password baru" id="Customerpass2">
                            <?= form_error('newpassword2', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-4">
                        <button type="submit" name="edit" id="edit" class="btn btn--small-wide checkout">Ubah Password</button>
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