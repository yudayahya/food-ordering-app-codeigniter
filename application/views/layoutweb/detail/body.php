<!--Body Content-->
<div id="page-content">
    <!--MainContent-->
    <div id="MainContent" class="main-content" role="main">
        <!--Breadcrumb-->
        <div class="bredcrumbWrap">
            <div class="container breadcrumbs">
                <a href="<?= base_url() ?>">Home</a><span aria-hidden="true">›</span><a href="<?= base_url('kategori') ?>">Produk</a><span aria-hidden="true">›</span><span><?= $produk['produk_nama'] ?><span>
            </div>
        </div>
        <!--End Breadcrumb-->

        <div id="ProductSection-product-template" class="product-template__container prstyle2 container">
            <!--#ProductSection-product-template-->
            <div class="product-single product-single-1">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="product-details-img product-single__photos bottom">
                            <div class="zoompro-wrap product-zoom-right pl-20">
                                <div class="zoompro-span">
                                    <img class="blur-up lazyload zoompro" data-zoom-image="<?= base_url('assets/gambar_produk/') . $produk['gambar'] ?>" alt="" src="<?= base_url('assets/gambar_produk/') . $produk['gambar'] ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="product-single__meta">
                            <h1 class="product-single__title"><?= $produk['produk_nama'] ?></h1>
                            <div class="prInfoRow">
                                <div class="product-stock">
                                    <?php if ($produk['in_stock'] == 1) {
                                        echo "<span class='instock'>In Stock</span>";
                                    } else {
                                        echo "<span class='outstock' style='color: crimson'>Out of Stock</span>";
                                    } ?>
                                </div>
                            </div>
                            <p class="product-single__price product-single__price-product-template">
                                <span class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                                    <span id="ProductPrice-product-template"><span class="money">Rp. <?= number_format($produk['harga'], 0, ".", ".") ?></span></span>
                                </span>
                            </p>
                            <div class="product-single__description rte">
                                <?= $produk['keterangan'] ?>
                            </div>
                            <!-- Product Action -->
                            <form>
                                <div class="product-action clearfix">
                                    <div class="product-form__item--quantity">
                                        <div class="wrapQtyBtn">
                                            <div class="qtyField">
                                                <a class="qtyBtn minus" href="javascript:void(0);"><i class="fa anm anm-minus-r" aria-hidden="true"></i></a>
                                                <input type="text" id="quantity<?= $produk['produk_id'] ?>" name="quantity<?= $produk['produk_id'] ?>" value="1" class="product-form__input qty" disabled>
                                                <a class="qtyBtn plus" href="javascript:void(0);"><i class="fa anm anm-plus-r" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-form__item--submit">
                                        <?php if ($produk['in_stock'] == 1) { ?>
                                            <button type="button" name="add" class="btn product-form__cart-submit add_shopcart" data-produkid="<?= $produk['produk_id'] ?>">
                                                <span>Add to cart</span>
                                            </button>
                                        <?php } else { ?>
                                            <button type="button" name="add" class="btn product-form__cart-submit" disabled>
                                                <span>Out of Stock</span>
                                            </button>
                                        <?php } ?>
                                    </div>
                                </div>
                                <!-- End Product Action -->
                            </form>
                        </div>
                    </div>
                </div><br><br><br>
                <!--End-product-single-->

                <!--Related Product Slider-->
                <div class="related-product grid-products">
                    <header class="section-header">
                        <h2 class="section-header__title text-center h2"><span>Produk Yang Berhubungan</span></h2>
                        <p class="sub-heading">Berikut pilihan produk-produk lainnya yang mungkin anda tertarik</p>
                    </header>
                    <div class="productPageSlider">
                        <?php foreach ($produklain as $lain) { ?>
                            <div class="col-12 item">
                                <!-- start product image -->
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="<?= base_url('produk/detail/') . $lain['produk_nama_seo'] ?>">
                                        <!-- image -->
                                        <img class="primary blur-up lazyload" data-src="<?= base_url('assets/gambar_produk/') . $lain['gambar'] ?>" src="<?= base_url('assets/gambar_produk/') . $lain['gambar'] ?>" alt="image" title="product">
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="hover blur-up lazyload" data-src="<?= base_url('assets/gambar_produk/') . $lain['gambar'] ?>" src="<?= base_url('assets/gambar_produk/') . $lain['gambar'] ?>" alt="image" title="product">
                                        <!-- End hover image -->
                                    </a>
                                    <!-- end product image -->

                                    <!-- Start product button -->
                                    <?php if ($lain['in_stock'] == 1) { ?>
                                        <form class="variants add" action="#" method="post">
                                            <button class="btn btn-addto-cart add_cart" type="button" tabindex="0" data-produkid="<?= $lain['produk_id'] ?>">Add to Cart</button>
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
                                        <a href="<?= base_url('produk/detail/') . $lain['produk_nama_seo'] ?>"><?= $lain['produk_nama'] ?></a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="price">Rp. <?= number_format($lain['harga'], 0, ".", ".") ?></span>
                                    </div>
                                    <!-- End product price -->
                                </div>
                                <!-- End product details -->
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <!--End Related Product Slider-->

            </div>
            <!--#ProductSection-product-template-->
        </div>
        <!--MainContent-->
    </div>
    <!--End Body Content-->
</div>