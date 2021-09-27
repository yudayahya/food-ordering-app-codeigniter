<div class="productList">
    <!--Toolbar-->
    <div class="toolbar">
        <div class="filters-toolbar-wrapper">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 text-center filters-toolbar__item filters-toolbar__item--count d-flex justify-content-center align-items-center">
                    <span class="filters-toolbar__product-count">Menampilkan : <?= count($produk) ?> Produk</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                <?php if (!$produk) { ?>
                    <label>Maaf kami tidak dapat menemukan pencarian anda. <strong><?= $keyword ?></strong>, tidak ditemukan produk tersebut.</label>
                <?php } else { ?>
                    <label>Menampilkan hasil pencarian <strong><?= $keyword ?></strong>, sebagai berikut:</label>
                <?php } ?>
            </div>
        </div>
    </div>
    <!--End Toolbar-->
    <div class="grid-products grid--view-items pt-4">
        <div class="row">
            <?php
            foreach ($produk as $p) {

            ?>
                <div class="col-6 col-sm-6 col-md-4 col-lg-4 item">
                    <!-- start product image -->
                    <div class="product-image">
                        <!-- start product image -->
                        <a href="<?= base_url('produk/detail/') . $p['produk_nama_seo'] ?>">
                            <!-- image -->
                            <img class="primary blur-up lazyload" data-src="<?= base_url() . 'assets/gambar_produk/' . $p['gambar'] ?>" src="<?= base_url() . 'assets/gambar_produk/' . $p['gambar'] ?>" alt="image" title="<?= $p['produk_nama'] ?>">
                            <!-- End image -->
                            <!-- Hover image -->
                            <img class="hover blur-up lazyload" data-src="<?= base_url() . 'assets/gambar_produk/' . $p['gambar'] ?>" src="<?= base_url() . 'assets/gambar_produk/' . $p['gambar'] ?>" alt="image" title="<?= $p['produk_nama'] ?>">
                            <!-- End hover image -->
                        </a>
                        <!-- end product image -->

                        <!-- Start product button -->
                        <?php if ($p['in_stock'] == 1) { ?>
                            <form class="variants add" action="#" method="post">
                                <button class="btn btn-addto-cart add_cart" type="button" tabindex="0" data-produkid="<?= $p['produk_id'] ?>">Add to cart</button>
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
                            <a href="<?= base_url('produk/detail/') . $p['produk_nama_seo'] ?>"><?= $p['produk_nama'] ?></a>
                        </div>
                        <!-- End product name -->
                        <!-- product price -->
                        <div class="product-price">
                            <span class="price">Rp. <?= number_format($p['harga'], 0, ".", ".") ?></span>
                        </div>
                        <!-- End product price -->
                    </div>
                    <!-- End product details -->
                </div>
            <?php
                //end looping produk
            }
            ?>
        </div>
    </div>
</div>
<hr class="clear">