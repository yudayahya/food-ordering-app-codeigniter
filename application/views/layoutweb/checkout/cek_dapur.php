<!DOCTYPE html>
<html class="no-js" lang="en">

<!-- belle/index.html   11 Nov 2019 12:16:10 GMT -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $title ?></title>
    <meta name="description" content="description">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url() ?>assets/logo/logo.png" />
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>template/belle/assets/css/plugins.css">
    <!-- Bootstap CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>template/belle/assets/css/bootstrap.min.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>template/belle/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>template/belle/assets/css/responsive.css">
    <style>
        @media (max-width: 575.98px) {
            .container .row .kolom-bouncer {
                height: 280px;
            }

            .container .row .dapur-teks .teks {
                font-size: 20px;
            }
        }

        @media (min-width: 576px) and (max-width: 767.98px) {
            .container .row .kolom-bouncer {
                height: 400px;
            }

            .container .row .dapur-teks .teks {
                font-size: 30px;
            }
        }

        @media (min-width: 768px) and (max-width: 991.98px) {
            .container .row .kolom-bouncer {
                height: 490px;
            }

            .container .row .dapur-teks .teks {
                font-size: 30px;
            }
        }

        @media (min-width: 992px) and (max-width: 1199.98px) {
            .container .row .kolom-bouncer {
                height: 480px;
            }

            .container .row .dapur-teks .teks {
                font-size: 35px;
            }
        }

        @media (min-width: 1200px) {
            .container .row .kolom-bouncer {
                height: 550px;
            }

            .container .row .dapur-teks .teks {
                font-size: 35px;
            }
        }
    </style>
</head>

<body class="page-template belle cart-variant1">
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
                                <li><a href="<?= base_url('member/logout') ?>">Logout</a></li>
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
                                <li class="lvl1 parent dropdown"><a href="<?= base_url('home/contact_us') ?>">Contact Us <i class="anm anm-angle-down-l"></i></a>
                                </li>
                            </ul>
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
                        <div class="site-cart" <?php if ($this->uri->segment(2) == 'shopcart' || $this->uri->segment(1) == 'checkout' || $this->uri->segment(1) == 'payment') {
                                                    echo "style='display: none'";
                                                } ?>>
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
                        <h1 class="page-width">Konfirmasi Dapur</h1>
                    </div>
                </div>
            </div>
            <!--End Page Title-->
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 kolom-bouncer">
                        <div class="bouncer" style="position: absolute;">
                            <div class="img-fluid"><img src="<?= base_url() ?>/assets/logo/vector-creator.png"></div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm text-center dapur-teks">
                        <p class="teks">
                            Konfirmasi Dapur Dulu, Tunggu Sebentar yaa... Jika Order Kami Tolak Mohon Kurangi Qty Item Anda :)
                            <span id="time"></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!--End Body Content-->

        <!--Footer-->
        <footer id="footer">
            <div class="newsletter-section">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-7 w-100 d-flex justify-content-start align-items-center">

                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-5 d-flex justify-content-end align-items-center">

                        </div>
                    </div>
                </div>
            </div>
            <div class="site-footer">
                <div class="container">
                    <!--Footer Links-->
                    <div class="footer-top">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                                <h4 class="h4">Menu</h4>
                                <ul>
                                    <li><a href="<?= base_url() ?>">Home</a></li>
                                    <li><a href="<?= base_url('kategori') ?>">Produk</a></li>
                                    <li><a href="<?= base_url('home/contact_us') ?>">Contact Us</a></li>
                                </ul>
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                                <h4 class="h4">Member</h4>
                                <ul>
                                    <li><a href="<?= base_url('member/dashboard') ?>">Akun Saya</a></li>
                                    <li><a href="<?= base_url('member/orders') ?>">Pesanan</a></li>
                                </ul>
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                                <h4 class="h4">Layanan Pelanggan</h4>
                                <ul>
                                    <li><a href="<?= base_url('member/register') ?>">Daftar</a></li>
                                    <li><a href="<?= base_url('member') ?>">Login</a></li>
                                    <li><a href="<?= base_url('member/forgotPassword') ?>">Lupa Password</a></li>
                                    <li><a href="<?= base_url('cart/shopcart') ?>">Cek Ongkir</a></li>
                                    <li><a href="<?= base_url('home/contact_us') ?>">Contact Us</a></li>
                                </ul>
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 contact-box">
                                <h4 class="h4">Hubungi Kami</h4>
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
                            </div>
                        </div>
                    </div>
                    <!--End Footer Links-->
                    <hr>
                    <div class="footer-bottom">
                        <div class="row">
                            <!--Footer Copyright-->
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-1 order-md-0 order-lg-0 order-sm-1 copyright text-sm-center text-md-left text-lg-left"><span></span> <a href="<?= base_url('home') ?>">@The Crabbys</a></div>
                            <!--End Footer Copyright-->
                            <!--Footer Payment Icon-->
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-0 order-md-1 order-lg-1 order-sm-0 payment-icons text-right text-md-center">
                                <li><a href="https://www.instagram.com/thecrabbys/" target="_blank" title="The Crabbys on Instagram"><i class="icon icon-instagram"></i></a></li>
                            </div>
                            <!--End Footer Payment Icon-->
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--End Footer-->

        <!--Scoll Top-->
        <span id="site-scroll"><i class="icon anm anm-angle-up-r"></i></span>
        <!--End Scoll Top-->

        <!-- Including Jquery -->
        <script src="<?= base_url() ?>template/belle/assets/js/vendor/jquery-3.3.1.min.js"></script>
        <script src="<?= base_url() ?>template/belle/assets/js/vendor/modernizr-3.6.0.min.js"></script>
        <script src="<?= base_url() ?>template/belle/assets/js/vendor/jquery.cookie.js"></script>
        <script src="<?= base_url() ?>template/belle/assets/js/vendor/wow.min.js"></script>
        <!-- Including Javascript -->
        <script src="<?= base_url() ?>template/belle/assets/js/bootstrap.min.js"></script>
        <script src="<?= base_url() ?>template/belle/assets/js/plugins.js"></script>
        <script src="<?= base_url() ?>template/belle/assets/js/popper.min.js"></script>
        <script src="<?= base_url() ?>template/belle/assets/js/lazysizes.js"></script>
        <script src="<?= base_url() ?>template/belle/assets/js/main.js"></script>
        <!--For Newsletter Popup-->
        <script src="https://js.pusher.com/5.1/pusher.min.js"></script>

        <script>
            function loop() {
                $('.bouncer').animate({
                    'top': '30'
                }, {
                    duration: 1000,
                    complete: function() {
                        $('.bouncer').animate({
                            top: 0
                        }, {
                            duration: 1000,
                            complete: loop
                        });
                    }
                });
            }
            loop();

            var pusher = new Pusher('53605ae7340f790a342a', {
                cluster: 'ap1',
                forceTLS: true
            });

            var order_id = <?= $this->uri->segment(3) ?>;
            var channel = pusher.subscribe('dapur' + order_id);
            channel.bind('konfirmasi', function(data) {
                if (data.hasil == 'terima') {
                    window.location.href = "<?= base_url('payment/gateway/'); ?>" + data.id;
                } else {
                    window.location.href = "<?= base_url('cart/shopcart'); ?>";
                }
            });

            var countDownDate = <?= $waktu ?> * 1000;
            var now = <?= strtotime($time) ?> * 1000;
            var x = setInterval(function() {
                now = now + 1000;
                var distance = countDownDate - now;
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                // Output the result in an element with id="time"
                document.getElementById("time").innerHTML = "<p>Time out... " + minutes + ":" + seconds + "</p>";

                // If the count down is over, write some text 
                if (distance < 0) {
                    clearInterval(x);
                    var id = <?= $this->uri->segment(3) ?>;
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('checkout/orderTimeout') ?>",
                        data: {
                            id: id
                        },
                        success: function() {
                            window.location.href = "<?= base_url('cart/shopcart'); ?>";
                        }
                    });
                }
            }, 1000);
        </script>
    </div>
</body>

</html>