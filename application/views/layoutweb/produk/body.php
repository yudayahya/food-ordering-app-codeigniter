        <!--Body Content-->
        <div id="page-content">
            <!--Collection Banner-->
            <div class="page section-header text-center">
                <div class="page-title">
                    <div class="wrapper">
                        <h1 class="page-width"><?= $title ?></h1>
                    </div>
                </div>
            </div>
            <!--End Collection Banner-->

            <div class="container">
                <div class="row">
                    <!--Sidebar-->
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 sidebar filterbar">
                        <div class="closeFilter d-block d-md-none d-lg-none"><i class="icon icon anm anm-times-l"></i></div>
                        <div class="sidebar_tags">
                            <!--Categories-->
                            <div class="sidebar_widget categories filterBox filter-widget">
                                <div class="widget-title">
                                    <h2>Kategori Produk</h2>
                                </div>
                                <div class="widget-content">
                                    <ul class="sidebar_categories">
                                        <li class="lvl-1"><a href="<?= base_url('kategori/') ?>" class="site-nav">Semua Produk</a></li>
                                        <li class="lvl-1"><a href="<?= base_url('kategori/rekomendasi') ?>" class="site-nav">Rekomendasi Produk</a></li>
                                        <!-- query kategori -->
                                        <?php
                                        $mainKategori = $this->db->get_where('tabel_kategori', array('parent <=' => 0));
                                        foreach ($mainKategori->result() as $k) {
                                            $subKategori = $this->db->get_where('tabel_kategori', array('parent' => $k->kategori_id));
                                            if ($subKategori->num_rows() > 0) { ?>
                                                <li class="level1 sub-level"><a href="#;" class="site-nav"><?= $k->kategori_nama ?></a>
                                                    <ul class="sublinks">
                                                        <?php
                                                        foreach ($subKategori->result() as $s) { ?>
                                                            <li class="level2"><a href="<?= base_url('kategori/produk/') . $s->kategori_nama_seo ?>" class="site-nav"><?= $s->kategori_nama ?></a></li>
                                                        <?php
                                                        } ?>
                                                    </ul>
                                                </li>
                                            <?php
                                            } else { ?>
                                                <li class="lvl-1"><a href="<?= base_url('kategori/produk/') . $k->kategori_nama_seo ?>" class="site-nav"><?= $k->kategori_nama ?></a></li>
                                        <?php }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <!--Categories-->
                            <!--Popular Products-->
                            <div class="sidebar_widget">
                                <div class="widget-title">
                                    <h2>Rekomendasi Produk</h2>
                                </div>
                                <div class="widget-content">
                                    <div class="list list-sidebar-products">
                                        <div class="grid">
                                            <?php
                                            foreach ($topproduk->result() as $top) {

                                            ?>
                                                <div class="grid__item">
                                                    <div class="mini-list-item">
                                                        <div class="mini-view_image">
                                                            <a class="grid-view-item__link" href="<?= base_url('produk/detail/') . $top->produk_nama_seo ?>">
                                                                <img class="grid-view-item__image" src="<?= base_url('assets/gambar_produk/') . $top->gambar ?>" alt="" />
                                                            </a>
                                                        </div>
                                                        <div class="details"> <a class="grid-view-item__title" href="<?= base_url('produk/detail/') . $top->produk_nama_seo ?>"><?= $top->produk_nama ?></a>
                                                            <div class="grid-view-item__meta"><span class="product-price__price"><span class="money">Rp. <?= number_format($top->harga, 0, ".", ".") ?></span></span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End Popular Products-->
                        </div>
                    </div>
                    <!--End Sidebar-->
                    <!--Main Content-->
                    <div class="col-12 col-sm-12 col-md-9 col-lg-9 main-col" id="view">
                        <div class="productList">
                            <!--Toolbar-->
                            <button type="button" class="btn btn-filter d-block d-md-none d-lg-none"> Kategori Produk</button>
                            <div class="toolbar">
                                <div class="filters-toolbar-wrapper">
                                    <div class="row">
                                        <div class="col-4 col-md-4 col-lg-4 filters-toolbar__item collection-view-as d-flex justify-content-start align-items-center">
                                            <div class="filters-toolbar__item">
                                                <label for="SortBy" class="hidden">Sort</label>
                                                <select name="SortBy" id="SortBy" class="filters-toolbar__input filters-toolbar__input--sort">
                                                    <?php if ($sort == '0') { ?>
                                                        <option value="title-ascending" selected="selected">Sort</option>
                                                        <option>Harga Terendah</option>
                                                        <option>Harga Tertinggi</option>
                                                    <?php } else if ($sort == '1') { ?>
                                                        <option>Sort</option>
                                                        <option value="title-ascending" selected="selected">Harga Terendah</option>
                                                        <option>Harga Tertinggi</option>
                                                    <?php } else { ?>
                                                        <option>Sort</option>
                                                        <option>Harga Terendah</option>
                                                        <option value="title-ascending" selected="selected">Harga Tertinggi</option>
                                                    <?php } ?>
                                                </select>
                                                <input class="collection-header__default-sort" type="hidden" value="manual">
                                            </div>
                                        </div>
                                        <div class="col-4 col-md-4 col-lg-4 text-center filters-toolbar__item filters-toolbar__item--count d-flex justify-content-center align-items-center">
                                            <span class="filters-toolbar__product-count">Menampilkan : <?= count($produk) ?> Produk</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End Toolbar-->
                            <div class="grid-products grid--view-items">
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
                        <?= $this->pagination->create_links(); ?>
                    </div>
                    <!--End Main Content-->
                </div>
            </div>

        </div>
        <!--End Body Content-->