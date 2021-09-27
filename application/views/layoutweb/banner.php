<!--Body Content-->
<div id="page-content">
	<!--Home slider-->
	<div class="slideshow slideshow-wrapper pb-section sliderFull">
		<div class="home-slideshow" style="padding-top:65px">
			<?php foreach ($banner as $b) { ?>
				<div class="slide">
					<div class="blur-up lazyload bg-size">
						<img class="blur-up lazyload bg-img" data-src="<?= base_url('assets/banner/') . $b['image'] ?>" src="<?= base_url('assets/banner/') . $b['image'] ?>" />
						<div class="slideshow__text-wrap slideshow__overlay classic bottom">
							<div class="slideshow__text-content bottom">
								<div class="wrap-caption center">
									<h2 class="h1 mega-title slideshow__title"><?= $b['nama_banner'] ?></h2>
									<span class="mega-subtitle slideshow__subtitle"><?= $b['keterangan'] ?></span>
									<span onclick="window.location.href = '<?= base_url('produk/detail/') . $b['nama_banner_seo'] ?>';" class="btn">CEK DISINI</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
	<!--End Home slider-->