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
<script src="<?= base_url() ?>template/belle/assets/js/sweetalert2.all.min.js"></script>
<link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-material-ui/material-ui.css" rel="stylesheet">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>
<!--For Newsletter Popup-->
<script type="text/javascript">
	var listVarian = <?php echo json_encode($this->db->query("SELECT varian_id,nama_varian,in_stock FROM tabel_varian_saus WHERE in_stock='1' ORDER BY varian_id DESC;")->result_array()); ?>;
	var options = {};
	$.map(listVarian,
		function(o) {
			options[o.varian_id] = o.nama_varian;
		});

	// Load mini cart
	$.ajax({
		type: "POST",
		url: "<?= base_url('home/load_cart') ?>",
		dataType: 'json',
		cache: false,
		success: function(data) {
			$('#CartCount').html(data.count);
			$('#header-cart').html(data.item);
		}
	});

	//add mini cart
	$(document).on('click', '.add_cart', function() {
		var produk_id = $(this).data("produkid");
		$.ajax({
			url: "<?= base_url('home/cekStock') ?>",
			method: "POST",
			dataType: 'json',
			data: {
				produk_id: produk_id
			},
			success: function(data) {
				if (data.output == '1') {
					if (data.saus == '1') {
						addProdukQuick(produk_id);
					} else {
						$.ajax({
							url: "<?= base_url('home/add_cart') ?>",
							method: "POST",
							dataType: 'json',
							data: {
								produk_id: produk_id,
								saos: '0'
							},
							success: function(data) {
								$('#CartCount').html(data.count);
								$('#header-cart').html(data.item);
								Swal.fire({
									icon: 'success',
									title: 'Yeah..',
									text: 'Produk ditambahkan ke keranjang!',
									showConfirmButton: false,
									timer: 2000
								});
							}
						});
					}
				} else {
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'Ternyata produk tidak tersedia!',
						confirmButtonText: 'OK!'
					}).then((result) => {
						if (result.value) {
							location.reload()
						}
					});
				}
			}
		});
	});

	async function addProdukQuick(id) {
		const {
			value: saus
		} = await Swal.fire({
			title: 'Pilihan saos : ',
			input: 'select',
			inputOptions: options,
			inputPlaceholder: 'Pilih saos',
			showCancelButton: true,
			inputValidator: (value) => {
				return new Promise((resolve) => {
					if (value != '') {
						resolve()
					} else {
						resolve('Silahkan pilih saos')
					}
				})
			}
		})

		if (saus) {
			$.ajax({
				url: "<?= base_url('home/cekStockSaus') ?>",
				method: "POST",
				dataType: 'json',
				data: {
					saos: saus
				},
				success: function(data) {
					if (data.output == '1') {
						$.ajax({
							url: "<?= base_url('home/add_cart') ?>",
							method: "POST",
							dataType: 'json',
							data: {
								produk_id: id,
								saos: saus
							},
							success: function(data) {
								$('#CartCount').html(data.count);
								$('#header-cart').html(data.item);
								Swal.fire({
									icon: 'success',
									title: 'Yeah..',
									text: 'Produk ditambahkan ke keranjang!',
									showConfirmButton: false,
									timer: 2000
								});
							}
						});
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: 'Ternyata saus tersebut tidak tersedia!',
							confirmButtonText: 'OK!'
						}).then((result) => {
							if (result.value) {
								location.reload()
							}
						});
					}
				}
			});
		}
	}

	//add produk to cart
	$(document).on('click', '.add_shopcart', function() {
		var produk_id = $(this).data("produkid");
		var quantity = $('#quantity' + produk_id).val();
		$.ajax({
			url: "<?= base_url('home/cekStock') ?>",
			method: "POST",
			dataType: 'json',
			data: {
				produk_id: produk_id
			},
			success: function(data) {
				if (data.output == '1') {
					if (data.saus == '1') {
						addProduk(produk_id, quantity);
					} else {
						$.ajax({
							url: "<?= base_url('produk/add_produk') ?>",
							method: "POST",
							dataType: 'json',
							data: {
								produk_id: produk_id,
								quantity: quantity,
								saos: '0'
							},
							success: function(data) {
								$('#CartCount').html(data.count);
								$('#header-cart').html(data.item);
								Swal.fire({
									icon: 'success',
									title: 'Yeah..',
									text: 'Produk ditambahkan ke keranjang!',
									showConfirmButton: false,
									timer: 2000
								});
							}
						});
					}
				} else {
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'Ternyata produk tidak tersedia!',
						confirmButtonText: 'OK!'
					}).then((result) => {
						if (result.value) {
							location.reload()
						}
					});
				}
			}
		});
	});

	async function addProduk(id, qty) {
		const {
			value: sausproduk
		} = await Swal.fire({
			title: 'Pilihan saos : ',
			input: 'select',
			inputOptions: options,
			inputPlaceholder: 'Pilih saos',
			showCancelButton: true,
			inputValidator: (value) => {
				return new Promise((resolve) => {
					if (value != '') {
						resolve()
					} else {
						resolve('Silahkan pilih saos :)')
					}
				})
			}
		})

		if (sausproduk) {
			$.ajax({
				url: "<?= base_url('home/cekStockSaus') ?>",
				method: "POST",
				dataType: 'json',
				data: {
					saos: sausproduk
				},
				success: function(data) {
					if (data.output == '1') {
						$.ajax({
							url: "<?= base_url('produk/add_produk') ?>",
							method: "POST",
							dataType: 'json',
							data: {
								produk_id: id,
								quantity: qty,
								saos: sausproduk
							},
							success: function(data) {
								$('#CartCount').html(data.count);
								$('#header-cart').html(data.item);
								Swal.fire({
									icon: 'success',
									title: 'Yeah..',
									text: 'Produk ditambahkan ke keranjang!',
									showConfirmButton: false,
									timer: 2000
								});
							}
						});
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: 'Ternyata saus tersebut tidak tersedia!',
							confirmButtonText: 'OK!'
						}).then((result) => {
							if (result.value) {
								location.reload()
							}
						});
					}
				}
			});
		}
	}

	//Hapus Item mini Cart
	$(document).on('click', '.hapus_cart', function() {
		var detail_id = $(this).attr("id"); //mengambil detail_id dari artibut id
		$.ajax({
			url: "<?= base_url('home/hapus_cart') ?>",
			method: "POST",
			dataType: 'json',
			data: {
				detail_id: detail_id
			},
			success: function(data) {
				$('#CartCount').html(data.count);
				$('#header-cart').html(data.item);
			}
		});
	});

	$("#keyword").keyup(function(event) {
		if (event.keyCode === 13) {
			$("#btn-search").click();
		}
	});

	$("#btn-search").click(function() {
		$.ajax({
			url: "<?= base_url('kategori/search') ?>",
			type: 'POST',
			data: {
				keyword: $("#keyword").val()
			},
			dataType: "json",
			success: function(response) {
				$("#view").html(response.hasil);
			}
		});
	});

	$(document).on('change', '#SortBy', function(e) {
		if (e.target.selectedIndex == "0") {
			window.location.href = "<?= base_url('kategori') ?>";
		} else if (e.target.selectedIndex == "1") {
			window.location.href = "<?= base_url('kategori/sortbyLow') ?>";
		} else {
			window.location.href = "<?= base_url('kategori/sortbyHigh') ?>";
		}
	});

	function voucher_detail(id) {
		$('#ModalDetailVoucher').modal('show');
		$.ajax({
			url: "<?= base_url('member/dashboard_detail_voucher') ?>",
			type: 'POST',
			data: {
				id: id
			},
			dataType: "json",
			success: function(data) {
				$("#deskripsi").html(data.deskripsi);
				$("#layanan").html(data.layanan);
			}
		});
	}

	function Logout() {
		localStorage.removeItem("idapply");
		localStorage.removeItem("id");
		localStorage.removeItem("nominalDiskon");
		localStorage.removeItem("ongkir");
		window.location.replace("<?= base_url('member/logout') ?>");
	}

	function failDiskon() {
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Voucher Gagal Diterapkan! Total Pembelian Anda Kurang.',
			confirmButtonText: 'OK!'
		});
	}

	function erorDiskon() {
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Error Voucher!',
			showConfirmButton: false,
			timer: 2000
		}).then(function() {
			location.reload();
		})
	}

	function suksesDiskon() {
		Swal.fire({
			icon: 'success',
			title: 'Yeah..',
			text: 'Voucher berhasil diterapkan!',
			showConfirmButton: false,
			timer: 2000
		});
	}

	function erorCheckoutProduk() {
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Ternyata produk tidak tersedia! Keranjang Telah Kami Perbarui, Periksa Kembali Keranjang Anda.',
			confirmButtonText: 'OK!'
		}).then((result) => {
			if (result.value) {
				window.location.href = "<?= base_url('cart/shopcart') ?>";
			}
		});
	}

	function errorChatting() {
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Pastikan gambar yang anda upload bertipe PNG/JPG/JPEG dengan size kurang dari 1 MB!',
			confirmButtonText: 'OK!'
		});
	}

	function errorMap() {
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Izinkan Browser untuk menggunakan lokasi anda. lalu pilih lokasi pengiriman. atau reload halaman jika lokasi telah diizinkan!',
			confirmButtonText: 'OK!'
		});
	}
</script>
<!--End For Newsletter Popup-->
</div>
</body>

<!-- belle/index.html   11 Nov 2019 12:20:55 GMT -->

</html>