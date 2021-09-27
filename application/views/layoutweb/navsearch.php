<body class="page-template belle cart-variant1">
    <div class="pageWrapper">
        <!--Search Form Drawer-->
        <div class="search">
            <div class="search__form">
                <button class="go-btn search__button" type="button" id="btn-search"><i class="icon anm anm-search-l"></i></button>
                <input class="search__input" type="text" id="keyword" value="" placeholder="Cari produk disini..." aria-label="Search" autocomplete="off">
                <button type="button" class="search-trigger close-btn"><i class="icon anm anm-times-l"></i></button>
            </div>
        </div>
        <!--End Search Form Drawer-->
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
                        </nav>
                        <!--End Desktop Menu-->
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-2 d-block d-lg-none mobile-logo">
                        <div class="logo">
                            <a href="<?= base_url('home') ?>">
                                <img src="<?= base_url() ?>/assets/logo/logo-home.png" alt="Belle Multipurpose Html Template" title="Belle Multipurpose Html Template" />
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-sm-3 col-md-3 col-lg-2">
                        <div class="site-cart">
                            <a href="#" class="site-header__cart" title="Cart">
                                <i class="icon anm anm-bag-l"></i>
                                <span id="CartCount" class="site-header__cart-count" data-cart-render="item_count">0</span>
                            </a>
                            <!--Minicart Popup-->
                            <div id="header-cart" class="block block-cart">
                                <!--Load cart dengan Ajax-->
                            </div>
                            <!--EndMinicart Popup-->
                        </div>
                        <div class="site-header__search">
                            <button type="button" class="search-trigger"><i class="icon anm anm-search-l"></i></button>
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