<body class="contact-template page-template belle">
    <div class="pageWrapper">
        <!--Top Header-->
        <div class="top-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-10 col-sm-8 col-md-5 col-lg-4">
                        <p class="phone-no"><i class="anm anm-phone-s"></i> +62-813-8244-4327</p>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4 d-none d-lg-none d-md-block d-lg-block">
                        <div class="text-center">
                            <p class="top-header_middle-text"> The Crabbys - Yogyakarta</p>
                        </div>
                    </div>
                    <div class="col-2 col-sm-4 col-md-3 col-lg-4 text-right">
                        <span class="user-menu d-block d-lg-none"><i class="anm anm-user-al" aria-hidden="true"></i></span>
                        <ul class="customer-links list-inline">
                            <li><a href="<?= base_url('livechat'); ?>"><i class="icon anm anm-facebook-messenger"></i> Live Chat <?php if ($newmessage == 'ada') {
                                                                                                                                        echo "<span class='text-warning' style='animation: blinker 1s linear infinite; @keyframes blinker {50% {opacity: 0;}}'>New Message!</span></a>";
                                                                                                                                    } ?></li>
                            <?php if ($this->session->userdata('username')) { ?>
                                <li><a href="<?= base_url('member/dashboard') ?>">Hi. <?= $this->session->userdata('nama_member') ?></a></li>
                                <li><a onclick="Logout()" href="javascript:void(0)">Logout</a></li>
                            <?php } else { ?>
                                <li><a href="<?= base_url('member') ?>">Login</a></li>
                                <li><a href="<?= base_url('member/register') ?>">Create Account</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--End Top Header-->
        <!--Header-->
        <div class="header-wrap animated d-flex">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <!--Desktop Logo-->
                    <div class="logo col-md-2 col-lg-2 d-none d-lg-block">
                        <a href="<?= base_url('home') ?>">
                            <img src="<?= base_url() ?>/assets/logo/logo-home.png" />
                        </a>
                    </div>
                    <!--End Desktop Logo-->
                    <div class="col-2 col-sm-3 col-md-3 col-lg-8">
                        <div class="d-block d-lg-none">
                            <button type="button" class="btn--link site-header__menu js-mobile-nav-toggle mobile-nav--open">
                                <i class="icon anm anm-times-l"></i>
                                <i class="anm anm-bars-r"></i>
                            </button>
                        </div>
                        <!--Desktop Menu-->
                        <nav class="grid__item" id="AccessibleNav">
                            <!-- for mobile -->
                            <ul id="siteNav" class="site-nav medium center hidearrow">
                                <li class="lvl1 parent megamenu"><a href="<?= base_url() ?>">Home <i class="anm anm-angle-down-l"></i></a>
                                </li>
                                <li class="lvl1 parent megamenu"><a href="<?= base_url('kategori') ?>">Produk <i class="anm anm-angle-down-l"></i></a>
                                </li>
                                <li class="lvl1 parent megamenu"><a href="<?= base_url('home/contact_us') ?>">Contact Us <i class="anm anm-angle-down-l"></i></a>
                                </li>
                            </ul>
                        </nav>
                        <!--End Desktop Menu-->
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-2 d-block d-lg-none mobile-logo">
                        <div class="logo">
                            <a href="<?= base_url('home') ?>">
                                <img src="<?= base_url() ?>/assets/logo/logo-home.png" />
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-sm-3 col-md-3 col-lg-2">
                        <div class="site-cart">
                            <a href="#;" class="site-header__cart" title="Cart">
                                <i class="icon anm anm-bag-l"></i>
                                <span id="CartCount" class="site-header__cart-count" data-cart-render="item_count">0</span>
                            </a>
                            <!--Minicart Popup-->
                            <div id="header-cart" class="block block-cart">
                                <!--Load cart dengan Ajax-->
                            </div>
                            <!--EndMinicart Popup-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Header-->
        <!--Mobile Menu-->
        <div class="mobile-nav-wrapper" role="navigation">
            <div class="closemobileMenu"><i class="icon anm anm-times-l pull-right"></i> Close Menu</div>
            <ul id="MobileNav" class="mobile-nav">
                <li class="lvl1 parent megamenu"><a href="<?= base_url() ?>">Home </a></li>
                <li class="lvl1 parent megamenu"><a href="<?= base_url('kategori') ?>">Produk </a></li>
                <li class="lvl1 parent megamenu"><a href="<?= base_url('home/contact_us') ?>">Contact Us </a></li>
            </ul>
        </div>
        <!--End Mobile Menu-->

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
            <div class="map-section map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.5043001197764!2d110.39664961546407!3d-7.73620887882621!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5905679dafa3%3A0xaa9f37e082a1697a!2sThe%20Crabbys!5e0!3m2!1sid!2sid!4v1581089206296!5m2!1sid!2sid" height="350" allowfullscreen></iframe>
                <div class="container">
                    <div class="row">
                        <div class="map-section__overlay-wrapper">
                            <div class="map-section__overlay">
                                <h3 class="h4">Kunjungi Kami</h3>
                                <div class="rte-setting">
                                    <p>Jl. Sidomukti, Tiyosan, Condongcatur, Kec. Depok, Kabupaten Sleman.<br>Daerah Istimewa Yogyakarta.</p>
                                    <p>Senin-Minggu, 11.00 - 22.00</p>
                                </div>
                                <p><a href="https://goo.gl/maps/hgwrpR21Kdb8kW6t5" class="btn btn--secondary btn--small" target="_blank">Dapatkan Petunjuk Arah</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bredcrumbWrap">
                <div class="container breadcrumbs">
                    <a href="<?= base_url('home') ?>" title="Kembali ke home">Home</a><span aria-hidden="true">›</span><span>Hubungi Kami</span>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-8 col-lg-8 mb-4">
                        <?= $this->session->flashdata('message'); ?>
                        <h2>Kritik & Saran</h2>
                        <div class="formFeilds contact-form form-vertical">
                            <form action="<?= base_url('home/contact_us') ?>" method="post" id="contact_form" class="contact-form">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <input type="text" id="ContactFormName" name="nama" placeholder="masukan nama" value="<?= set_value('nama'); ?>">
                                            <?= form_error('nama', '<small class="text-danger pl-1">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <input type="text" id="ContactFormEmail" name="email" placeholder="masukan email" value="<?= set_value('email'); ?>">
                                            <?= form_error('email', '<small class="text-danger pl-1">', '</small>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <input type="text" id="ContactFormPhone" name="hp" placeholder="masukan nomor handphone" value="<?= set_value('hp'); ?>">
                                            <?= form_error('hp', '<small class="text-danger pl-1">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <input type="text" id="ContactSubject" name="subject" placeholder="masukan subject" value="<?= set_value('subject'); ?>">
                                            <?= form_error('subject', '<small class="text-danger pl-1">', '</small>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <textarea rows="10" id="ContactFormMessage" name="message" placeholder="masukan kritik atau saran"><?= set_value('message'); ?></textarea>
                                            <?= form_error('message', '<small class="text-danger pl-1">', '</small>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <input type="submit" class="btn" value="Send Message">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="open-hours">
                            <strong>Jam Buka</strong><br>
                            Senin - Minggu : 11.00 - 22.00
                        </div>
                        <hr />
                        <ul class="addressFooter">
                            <li><i class="icon anm anm-map-marker-al"></i>
                                <p>Daerah Istimewa Yogyakarta.<br>Jl. Sidomukti, Tiyosan, Condongcatur, Kec. Depok, Kabupaten Sleman.</p>
                            </li>
                            <li class="phone"><i class="icon anm anm-phone-s"></i>
                                <p>+62-813-8244-4327</p>
                            </li>
                            <li class="email"><i class="icon anm anm-envelope-l"></i>
                                <p>crabbys.info@gmail.com</p>
                            </li>
                        </ul>
                        <hr />
                    </div>
                </div>
            </div>

        </div>
        <!--End Body Content-->