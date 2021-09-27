<!--Collection Tab slider-->
<div class="tab-slider-product section">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="section-header text-center">
                    <h2 class="h2">Produk Terbaru</h2>
                    <p>Jelajahi berbagai macam produk kami</p>
                </div>
                <div class="tabs-listing">
                    <ul class="tabs clearfix">
                    </ul>
                    <div class="tab_container">
                        <div id="tab1" class="tab_content grid-products">
                            <div class="productSlider">
                                <?php
                                foreach ($newproduk->result() as $n) {

                                ?>
                                    <div class="col-12 item">
                                        <!-- start product image -->
                                        <div class="product-image">
                                            <!-- start product image -->
                                            <a href="<?= base_url('produk/detail/') . $n->produk_nama_seo ?>">
                                                <!-- image -->
                                                <img class="primary blur-up lazyload" data-src="<?= base_url() . 'assets/gambar_produk/' . $n->gambar ?>" src="<?= base_url() . 'assets/gambar_produk/' . $n->gambar ?>" alt="image" title="product">
                                                <!-- End image -->
                                                <!-- Hover image -->
                                                <img class="hover blur-up lazyload" data-src="<?= base_url() . 'assets/gambar_produk/' . $n->gambar ?>" src="<?= base_url() . 'assets/gambar_produk/' . $n->gambar ?>" alt="image" title="product">
                                                <!-- End hover image -->
                                            </a>
                                            <!-- end product image -->

                                            <!-- Start product button -->
                                            <?php if ($n->in_stock == 1) { ?>
                                                <form class="variants add" action="#" method="post">
                                                    <button class="btn btn-addto-cart add_cart" type="button" tabindex="0" data-produkid="<?= $n->produk_id ?>">Add To Cart</button>
                                                </form>
                                            <?php } else { ?>
                                                <form class="variants add" action="#;" method="post">
                                                    <button class="btn btn-addto-cart" type="button" tabindex="0" disabled>Out of Stock</button>
                                                </form>
                                            <?php } ?>
                                            <!-- end product button -->
                                        </div>
                                        <!-- end product image -->
                                        <!--start product details -->
                                        <div class="product-details text-center">
                                            <!-- product name -->
                                            <div class="product-name">
                                                <a href="<?= base_url('produk/detail/') . $n->produk_nama_seo ?>"><?= $n->produk_nama ?></a>
                                            </div>
                                            <!-- End product name -->
                                            <!-- product price -->
                                            <div class="product-price">
                                                <span class="price">Rp. <?= number_format($n->harga, 0, ".", ".") ?></span>
                                            </div>
                                            <!-- End product price -->
                                        </div>
                                        <!-- End product details -->
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Collection Tab slider-->

<!--Featured Product-->
<div class="product-rows section">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="section-header text-center">
                    <h2 class="h2">Produk Rekomendasi</h2>
                    <p>Produk kami yang paling populer berdasarkan penjualan</p>
                </div>
            </div>
        </div>
        <div class="grid-products">
            <div class="row">
                <?php
                foreach ($produk->result() as $p) {

                ?>
                    <div class="col-6 col-sm-6 col-md-4 col-lg-4 item grid-view-item style2">
                        <div class="grid-view_image">
                            <!-- start product image -->
                            <a href="<?= base_url('produk/detail/') . $p->produk_nama_seo ?>" class="grid-view-item__link">
                                <!-- image -->
                                <img class="grid-view-item__image primary blur-up lazyload" data-src="<?= base_url() . 'assets/gambar_produk/' . $p->gambar ?>" src="<?= base_url() . 'assets/gambar_produk/' . $p->gambar ?>" alt="image" title="product">
                                <!-- End image -->
                                <!-- Hover image -->
                                <img class="grid-view-item__image hover blur-up lazyload" data-src="<?= base_url() . 'assets/gambar_produk/' . $p->gambar ?>" src="<?= base_url() . 'assets/gambar_produk/' . $p->gambar ?>" alt="image" title="product">
                                <!-- End hover image -->
                            </a>
                            <!-- end product image -->
                            <!--start product details -->
                            <div class="product-details hoverDetails text-center mobile">
                                <!-- product name -->
                                <div class="product-name">
                                    <a href="<?= base_url('produk/detail/') . $p->produk_nama_seo ?>"><?= $p->produk_nama ?></a>
                                </div>
                                <!-- End product name -->
                                <!-- product price -->
                                <div class="product-price">
                                    <span class="price">Rp. <?= number_format($p->harga, 0, ".", ".") ?></span>
                                </div>
                                <!-- End product price -->

                                <!-- Start product button -->
                                <?php if ($p->in_stock == 1) { ?>
                                    <form class="variants add" action="#" method="post">
                                        <button class="btn btn-addto-cart add_cart" type="button" tabindex="0" data-produkid="<?= $p->produk_id ?>">Add To Cart</button>
                                    </form>
                                <?php } else { ?>
                                    <form class="variants add" action="#;" method="post">
                                        <button class="btn btn-addto-cart" type="button" tabindex="0" disabled>Out of Stock</button>
                                    </form>
                                <?php } ?>
                            </div>
                            <!-- End product details -->
                        </div>
                    </div>
                <?php
                    //end looping produk
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!--End Featured Product-->

<!--
<div class="store-feature section">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <ul class="display-table store-info">
                    <li class="display-table-cell">
                        <i class="icon anm anm-truck-l"></i>
                        <h5>Free Shipping &amp; Return</h5>
                        <span class="sub-text">Free shipping on all US orders</span>
                    </li>
                    <li class="display-table-cell">
                        <i class="icon anm anm-dollar-sign-r"></i>
                        <h5>Money Guarantee</h5>
                        <span class="sub-text">30 days money back guarantee</span>
                    </li>
                    <li class="display-table-cell">
                        <i class="icon anm anm-comments-l"></i>
                        <h5>Online Support</h5>
                        <span class="sub-text">We support online 24/7 on day</span>
                    </li>
                    <li class="display-table-cell">
                        <i class="icon anm anm-credit-card-front-r"></i>
                        <h5>Secure Payments</h5>
                        <span class="sub-text">All payment are Secured and trusted.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
-->
</div>
<!--End Body Content-->