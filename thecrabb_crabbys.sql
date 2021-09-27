-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 21, 2021 at 03:01 AM
-- Server version: 5.7.34
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thecrabb_crabbys`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_admin`
--

CREATE TABLE `tabel_admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_admin`
--

INSERT INTO `tabel_admin` (`id`, `nama`, `username`, `email`, `image`, `password`, `role_id`) VALUES
(1, 'Aziiza Yuda Yahya', 'yudayahya', 'yudayahya7@gmail.com', '3853913ffc5fab27c4ee871fb883dd39.png', '$2y$10$70gL.KE.bIasulNudd28UO4iq5lc/7hu5B/QXQDgY68S2HY1FmFz6', 1),
(4, 'Dwi Lutfiana', 'dwilutfiana', 'dwilutfiana7@gmail.com', 'ecdaaa5ab6478a90c0d7f689ba1a936c.png', '$2y$10$x0INd27o2r2Cqs76k0Gd8.Q.vhXEK2DE7AN3YwPNt9pnL2ktMNHyi', 2),
(6, 'Zakaria', 'zakaria', 'ibeng@gmail.com', '18abf97a53a7177dd4a70798aa625a32.jpg', '$2y$10$msBY3C1e2mWhbhd1.kLi3uB1B60bK3bBEfucO3fZgRnM7yWtWzo0m', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_admin_access_menu`
--

CREATE TABLE `tabel_admin_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_admin_access_menu`
--

INSERT INTO `tabel_admin_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(11, 2, 3),
(12, 2, 4),
(13, 2, 5),
(15, 2, 7),
(16, 2, 8),
(17, 1, 10),
(18, 2, 10),
(19, 2, 1),
(20, 1, 11),
(21, 1, 12),
(22, 2, 11),
(23, 2, 12),
(26, 1, 14),
(27, 1, 15),
(28, 2, 14),
(29, 2, 15),
(30, 1, 16),
(31, 2, 16),
(32, 1, 17),
(33, 2, 17),
(34, 1, 6),
(35, 2, 6),
(36, 1, 21),
(37, 2, 21),
(38, 2, 22),
(39, 1, 22);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_admin_role`
--

CREATE TABLE `tabel_admin_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_admin_role`
--

INSERT INTO `tabel_admin_role` (`id`, `role`) VALUES
(1, 'Owner'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_banner`
--

CREATE TABLE `tabel_banner` (
  `id` int(11) NOT NULL,
  `nama_banner` varchar(120) NOT NULL,
  `nama_banner_seo` varchar(120) NOT NULL,
  `keterangan` varchar(256) NOT NULL,
  `image` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_banner`
--

INSERT INTO `tabel_banner` (`id`, `nama_banner`, `nama_banner_seo`, `keterangan`, `image`) VALUES
(10, 'Super Giant Crab', 'super-giant-crab', 'MEDIUM CRAB 8 EKOR / 8 KEPITING MEDIUM, FRIED CHICKEN WINGS / 4-5 SAYAP AYAM GORENG...', '20eb928e0d180b2074736d9c90c03fc5.jpg'),
(11, 'Super Crabster', 'super-crabster', 'MEDIUM CRAB 4 EKOR / 4 KEPITING MEDIUM, LOBSTER 2 EKOR...', 'acf0601bfc5949b5466a08eb9b983fa5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_kategori`
--

CREATE TABLE `tabel_kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_nama` varchar(70) NOT NULL,
  `parent` int(11) NOT NULL,
  `kategori_nama_seo` varchar(150) NOT NULL,
  `varian` int(11) DEFAULT NULL COMMENT '1=butuh varian saus'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_kategori`
--

INSERT INTO `tabel_kategori` (`kategori_id`, `kategori_nama`, `parent`, `kategori_nama_seo`, `varian`) VALUES
(31, 'Giant Package', 0, 'giant-package', 1),
(32, 'Crab Package', 0, 'crab-package', 1),
(33, 'Crab & Lobster Package', 0, 'crab--lobster-package', 1),
(34, 'Crab & Crayfish Package', 0, 'crab--crayfish-package', 1),
(35, 'New Smoked Crab / Kepiting Asap', 0, 'new-smoked-crab--kepiting-asap', 0),
(36, 'The Crabbys Big Match', 0, 'the-crabbys-big-match', 0),
(37, 'Side Dish', 0, 'side-dish', 0),
(38, 'Single', 0, 'single', 0),
(39, 'On Kilos', 0, 'on-kilos', 0),
(40, 'Trouble', 0, 'trouble', 0),
(41, 'Extra', 0, 'extra', 0),
(42, 'Fish', 0, 'fish', 0),
(43, 'Ufo (Flaying Plate)', 0, 'ufo-flaying-plate', 0),
(45, 'Laguna Drinks', 0, 'laguna-drinks', 0),
(46, 'Beverages', 0, 'beverages', 0),
(47, 'Fruit Juice', 0, 'fruit-juice', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_kupon`
--

CREATE TABLE `tabel_kupon` (
  `id` int(11) NOT NULL,
  `kupon_nama` varchar(128) NOT NULL,
  `valid_per_member` int(11) NOT NULL,
  `last_date` date NOT NULL,
  `diskon` int(11) NOT NULL,
  `minimum_spend` int(11) NOT NULL,
  `maksimal_diskon` int(11) NOT NULL,
  `kupon_type` int(11) NOT NULL COMMENT '1=diskon %, 2=diskon flat',
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_kupon`
--

INSERT INTO `tabel_kupon` (`id`, `kupon_nama`, `valid_per_member`, `last_date`, `diskon`, `minimum_spend`, `maksimal_diskon`, `kupon_type`, `status`) VALUES
(16, '15K DISKON', 3, '2021-06-30', 15000, 120000, 15000, 2, 1),
(17, '30% DISKON', 3, '2021-06-22', 30, 50000, 30000, 1, 1),
(18, '30% DISKON(MAKS 80K)', 8, '2021-06-16', 30, 50000, 80000, 1, 1),
(19, '40% DISKON(MAKS 90K)', 3, '2021-06-30', 40, 350000, 90000, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_kupon_used`
--

CREATE TABLE `tabel_kupon_used` (
  `id` int(11) NOT NULL,
  `id_kupon` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_member` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_kupon_used`
--

INSERT INTO `tabel_kupon_used` (`id`, `id_kupon`, `id_transaksi`, `id_member`) VALUES
(1, 16, 215, 57),
(4, 18, 222, 57),
(5, 17, 228, 44),
(6, 16, 229, 61),
(7, 18, 231, 44),
(8, 18, 232, 44),
(9, 17, 234, 32);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_kupon_user`
--

CREATE TABLE `tabel_kupon_user` (
  `id` int(11) NOT NULL,
  `id_kupon` int(11) NOT NULL,
  `id_member` int(11) NOT NULL COMMENT '0=all member'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_kupon_user`
--

INSERT INTO `tabel_kupon_user` (`id`, `id_kupon`, `id_member`) VALUES
(40, 17, 0),
(41, 18, 32),
(42, 18, 44),
(43, 18, 56),
(44, 18, 33),
(45, 18, 34),
(46, 18, 57),
(64, 19, 0),
(68, 16, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_member`
--

CREATE TABLE `tabel_member` (
  `member_id` int(11) NOT NULL,
  `nama_lengkap` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `gambar` varchar(128) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `is_active` int(11) NOT NULL COMMENT '1=active',
  `lat` varchar(128) DEFAULT NULL,
  `lng` varchar(128) DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '0=off, 1=online'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_member`
--

INSERT INTO `tabel_member` (`member_id`, `nama_lengkap`, `username`, `email`, `password`, `gambar`, `no_hp`, `is_active`, `lat`, `lng`, `status`) VALUES
(32, 'Dwi Lutfiana', 'dwilutfiana', 'dwilutfiana7@gmail.com', '$2y$10$m01WKoCglEVZ/5sZ2Y9wYeVrPFPuHkbVp4W9enKAAhPqNuLlYGwSq', 'default.png', '08212673218', 1, '-7.750316', '110.353626', 1),
(33, 'Yuda fak', 'yudafak', 'yudafak7@gmail.com', '$2y$10$r8XrX8b7eyEgoJqKrmqgBuwKVKKxdlyIM4V.sKDr6HYEysmkf8M4W', '7685395cfa1fd009310cafd4ba4813f6.png', '086732515362', 1, '-7.766592', '110.378362', 0),
(34, 'ibeng', 'ibeng', 'ibengengs@gmail.com', '$2y$10$fqNtclblNpzVZJ.QYZ8BbuNEC/bqXb0q5kXWesXcY85eRPy9bfKwi', 'default.png', NULL, 1, NULL, NULL, 0),
(35, 'Yildi', 'yildi', 'balikpapanku213@gmail.com', '$2y$10$Y8FDr4Z..eKT08tHZVZXiO1c8Ga/OJxROAn8Dh.1B0R100pByT00.', 'default.png', NULL, 1, NULL, NULL, 0),
(36, 'Nicken', 'nickenltf', 'nickenlutfyanis47@gmail.com', '$2y$10$/zZHMDSDauZoTuDr9BQwE.L9e0kAw9uqVhBhB2dQmxDNNyR3wrFgy', 'f946aa854402152c89d92cacd03c9a65.jpeg', NULL, 1, NULL, NULL, 0),
(39, 'eddy', 'eddy', 'eddysutrisno53@gmail.com', '$2y$10$ndDx36TRdSAMYudJLTYjTeIgWOooXQvESqeQEDOC.d2lPtnRBqBP2', 'default.png', NULL, 1, NULL, NULL, 0),
(40, 'Guntur', 'guntur', 'gunturpurwanto19@gmail.com', '$2y$10$MK//RiaISEAyJFROyWUUAeUCjPjyXbyEAp.pErafPiEqaUla9lgEC', 'default.png', NULL, 1, NULL, NULL, 0),
(41, 'Budi Ari', 'budiari', 'budhiari99@gmail.com', '$2y$10$2NXmnPicUbtYE1K95mFI0.7IDBctgCIFylGNHdJjWx8udzaGEjO3C', 'default.png', NULL, 1, NULL, NULL, 0),
(42, 'Budi Ari P', 'budz', 'budz5231@gmail.com', '$2y$10$yg.wIOOtFe/GrMeuXD1HPOXqBDHICWA6qDQLjzBbNekFZmg5ZXRJy', 'default.png', NULL, 1, NULL, NULL, 0),
(44, 'Aziiza Yuda Yahya', 'yudayahya', 'yudayahya7@gmail.com', '$2y$10$gLlqenytbXDnXDgb.ChgmesrJv4m6LtY5.IFieRHN7F22B1uF2WaK', '825e713eec06fa29513cd396cc24b83d.png', '081615407084', 1, '-7.746514', '110.346945', 1),
(51, 'Ibnu Sofyan', 'ibnusofyan', 'ibnusofyanfyan@gmail.com', '$2y$10$AThaLZqSvWrAo5wEdZMTLe1lJrypJU3V/P0XJXYEQztiUu7m12XVW', 'default.png', NULL, 1, NULL, NULL, 0),
(52, 'Yoyo', 'yoyo', 'humsyalai@gmail.com', '$2y$10$kFdQVA39x4EfchwxY2DP9.u8c.xxa8KmDI6nbHHv2hlwNeBghjZ3e', 'default.png', NULL, 1, NULL, NULL, 0),
(53, 'Doguf', 'doguf', 'xeundoguf@gmail.com', '$2y$10$Fh.cJyM18gx6WDzOCnWBqejHFEdLHsvXlxuwJV1zo2VL/s9TgYbA2', 'default.png', NULL, 1, NULL, NULL, 0),
(54, 'Idweb', 'Idwebs', 'id.syaiful@gmail.com', '$2y$10$fr8r7COOyOQ40XutPZVpgeEeShm/4JSZJSUPQuLzTKOykzCXYdjzO', 'default.png', NULL, 0, NULL, NULL, 0),
(55, 'Puputfikyfendy', 'Vino', 'pinokioboy69@yahoo.co.id', '$2y$10$Rq1wjVaTd5x1lpuoUR4TY.9ftBQRrhdSDHWsz.ps0UObhpLm/UIu2', 'default.png', NULL, 0, NULL, NULL, 0),
(56, 'Noha Fitria', 'Nohafitria', 'nohaftria@gmail.com', '$2y$10$KPREeOZcdzjuLKFLIexLve09wwU.HOefEv91FDS93/BOlO.lF7n2W', 'default.png', NULL, 1, NULL, NULL, 0),
(57, 'The Crabbys', 'thecrabbys', 'crabbys.info@gmail.com', '$2y$10$hSYXySAeyYrolYqYUSDAA.e9NLaz20cUzmEXKW/ChF.JKCEaLDh1S', 'default.png', '085738737371', 1, '-7.746497', '110.346983', 1),
(61, 'Candra Kusuma', 'candrakusuma', 'candrak60@gmail.com', '$2y$10$uQgyM4LhZuRIgWmHly/49.KMDd2Vzhp4X8FPC6QlEjBn6eEp7DppG', 'default.png', NULL, 1, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_member_token`
--

CREATE TABLE `tabel_member_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_member_token`
--

INSERT INTO `tabel_member_token` (`id`, `email`, `token`, `date_created`) VALUES
(33, 'id.syaiful@gmail.com', 'sgqsS6jwgfBX+O46ORKMT64SgLVmmlFG2xssw4nFUxER7PEIG6IEn7BjgQ1rpMrc7htWdzFUsMauESFE4/Uz/Q==', 1615101698),
(34, 'pinokioboy69@yahoo.co.id', '8dCRQc+8JIUcoGwGJMQ9PsAAZwlC9XIE87bsyex8G78YcRjYBaw4VJD94ceEFGZBMFSKxZi3j3y1sH6y3wfHlA==', 1616593481),
(35, 'budhiari99@gmail.com', 'VWbr648wkq4+HxmcM5uN0gsbfxw40xJpR+80TJz7LjPpA8lMPNFwO7tqP8O0EX/yBnkYnkMiV4m61ZNrqIWt/Q==', 1617979119),
(36, 'riris1111@gmail.com', '47vMi875fK8Z0zjPyf9BxV2cmOP14LYDJJs1asIPoNLj6RoilHNyupRcp1G9A/7niENvBdJZt8hfweZn53pj9Q==', 1620378803),
(37, 'riris1111@gmail.com', 'AoMfK3s539Y7dZFdVMNd/tSdk00DBenMA+4Gej8K1LQxW3nTr9ZcMcWP4FZjrZRWIAJ1jsnspzoIQ9Z5Ula6QQ==', 1620379119),
(38, 'riris1111@gmail.com', 'ppfyyDjVWcxgtf6mDcOpCZlX4h6Xi099cBeqagrnSPmX2BM/bOKyK3VRSn4PXSD2m7qjC1dxntV2KjNKDvmQxw==', 1620379348),
(40, 'cobasaja@gmail.com', 'adrzClM77Lzf43pZ5MJ5lyDHsZzeBEU4FZj+nGUVHw3LKLIGxMbq2MQ/AMq5wXDAGyjdxsKXeW7drT/aiAf9UQ==', 1620389067);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_menu_admin`
--

CREATE TABLE `tabel_menu_admin` (
  `menu_id` int(11) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `link` varchar(100) NOT NULL,
  `parent` int(11) NOT NULL COMMENT '0= main menu'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_menu_admin`
--

INSERT INTO `tabel_menu_admin` (`menu_id`, `nama_menu`, `icon`, `link`, `parent`) VALUES
(1, 'Dashboard', 'fa-dashboard', '', 0),
(3, 'Member', 'fa-users', 'member', 11),
(4, 'Konfirmasi Dapur', 'fa-credit-card', 'transaksi', 12),
(5, 'Varian', ' fa-map-pin', 'varian', 11),
(6, 'Pending Bayar', 'fa-credit-card', 'transaksi/pending', 12),
(7, 'Produk', 'fa-cutlery', 'barang', 11),
(8, 'Kategori', 'fa-puzzle-piece', 'kategori', 11),
(9, 'Data Admin', 'fa-dashboard', 'dataAdmin', 1),
(10, 'Profile', 'fa-user', 'profile', 1),
(11, 'Menu', 'fa-th-large', '', 0),
(12, 'Transaksi', 'fa-credit-card', '', 0),
(14, 'Memasak', 'fa-credit-card', 'transaksi/memasak', 12),
(15, 'Mengirim', 'fa-credit-card', 'transaksi/mengirim', 12),
(16, 'Selesai', 'fa-credit-card', 'transaksi/done', 12),
(17, 'Banner', 'fa-file-image-o', 'banner', 11),
(21, 'Kupon', 'fa-money', 'kupon', 11),
(22, 'Live Chat', 'fa-wechat', 'chat', 11);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_message`
--

CREATE TABLE `tabel_message` (
  `msg_id` int(11) NOT NULL,
  `msg_timestamp` datetime NOT NULL,
  `pengirim_msg_id` int(11) NOT NULL,
  `penerima_msg_id` int(11) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `msg_type` int(11) NOT NULL COMMENT '0=text,1=picture',
  `status` int(11) NOT NULL COMMENT '0=unread,1=read'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_message`
--

INSERT INTO `tabel_message` (`msg_id`, `msg_timestamp`, `pengirim_msg_id`, `penerima_msg_id`, `message`, `msg_type`, `status`) VALUES
(116, '2021-06-04 01:32:37', 1, 35, 'yu', 0, 0),
(117, '2021-06-04 01:34:24', 1, 39, 'uyu', 0, 0),
(118, '2021-06-04 01:35:26', 1, 34, 'yuyuyhfgh', 0, 0),
(119, '2021-06-04 01:36:20', 1, 34, 'ghfgh', 0, 0),
(120, '2021-06-04 01:36:32', 1, 34, '63abdad2abd0755027674234be6c7772.png', 1, 0),
(124, '2021-06-04 01:37:25', 32, 1, 'P', 0, 1),
(125, '2021-06-04 01:48:21', 44, 1, 'hjkhj', 0, 1),
(126, '2021-06-04 01:48:38', 1, 44, 'fvghdrtgd', 0, 1),
(127, '2021-06-15 11:19:40', 44, 1, 'halo bro', 0, 1),
(128, '2021-06-16 17:30:52', 32, 1, 'halo admin', 0, 1),
(129, '2021-06-16 17:38:04', 32, 1, 'halo', 0, 1),
(130, '2021-06-16 17:38:17', 1, 32, 'iya kak', 0, 1),
(131, '2021-06-16 20:40:12', 32, 1, 'halo', 0, 1),
(132, '2021-06-16 20:40:27', 1, 39, 'fdsfsd', 0, 0),
(133, '2021-06-16 20:40:38', 32, 1, 'admin', 0, 1),
(134, '2021-06-16 20:40:55', 1, 32, '7f9037b3fc4c6f44d497ba3d3280f0d1.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_produk`
--

CREATE TABLE `tabel_produk` (
  `produk_id` int(11) NOT NULL,
  `produk_nama` varchar(100) NOT NULL,
  `produk_nama_seo` varchar(140) NOT NULL,
  `harga` int(11) NOT NULL,
  `keterangan` text,
  `gambar` text NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `seller` int(11) DEFAULT NULL COMMENT '1=produk unggulan',
  `in_stock` int(11) DEFAULT NULL COMMENT '1=in stock'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_produk`
--

INSERT INTO `tabel_produk` (`produk_id`, `produk_nama`, `produk_nama_seo`, `harga`, `keterangan`, `gambar`, `kategori_id`, `seller`, `in_stock`) VALUES
(48, 'Gangster Giant', 'gangster-giant', 250000, '<h3><strong>FOR 4 PACKAGE</strong></h3><ul><li>GIANT CRAB 1 EKOR / KEPITING GIANT</li><li>LOBSTER 1 EKOR</li><li>FRIED CHICKEN WINGS / 2-3 SAYAP AYAM GORENG</li><li>MUSSELS / KERANG 200 GRAM</li><li>WHITE SHRIMP PANAMI / UDANG 150 GRAM</li><li>4 NASI / JAGUNG</li></ul>', 'd243609615d0b13d3b0fc9f720ce4b1a.jpg', 31, 1, 0),
(49, 'Master Giant', 'master-giant', 350000, '<h3><strong>FOR 6 PERSON</strong></h3><ul><li>GIANT CRAB 2 EKOR / KEPITING GIANT</li><li>LOBSTER 1 EKOR</li><li>FRIED CHICKEN WINGS / 3-4 SAYAP AYAM GORENG</li><li>MUSSELS / KERANG 300 GRAM</li><li>WHITE SHRIMP PANAMI / UDANG 150 GRAM</li><li>6 NASI / JAGUNG</li></ul>', 'f409630cb2b1dbbe14d5b00b5a515f0d.jpg', 31, 0, 0),
(50, 'Witch Giant', 'witch-giant', 230000, '<h3><strong>FOR 3-4 PERSON</strong></h3><ul><li>GIANT CRAB 2 EKOR / 2 KEPITING GIANT</li><li>FRIED CHICKEN WINGS / 2-3 SAYAP AYAM GORENG</li><li>MUSSELS / KERANG 250 GRAM</li><li>WHITE SHRIMP PANAMI / UDANG 100 GRAM</li><li>3 NASI / JAGUNG</li></ul>', '881d1f837eca297b0d09900d3c1d78e4.jpg', 31, 0, 0),
(51, 'Witch Crab', 'witch-crab', 190000, '<h3><strong>FOR 2-3 PERSON</strong></h3><ul><li>MEDIUM CRAB 2 EKOR / 2 KEPITING MEDIUM</li><li>FRIED CHICKEN WINGS / 2-3 SAYAP AYAM GORENG</li><li>MUSSELS / KERANG 250 GRAM</li><li>WHITE SHRIMP PANAMI / UDANG 100 GRAM</li><li>2 NASI / JAGUNG</li></ul>', '36327b7be67125d8a8febe87d518d279.jpg', 32, 0, 0),
(52, 'Monster Crab', 'monster-crab', 300000, '<h3><strong>FOR 5-6 PERSON</strong></h3><ul><li>MEDIUM CRAB 4 EKOR / 4 KEPITING MEDIUM</li><li>FRIED CHICKEN WINGS / 3-4 SAYAP AYAM GORENG</li><li>MUSSELS / KERANG 300 GRAM</li><li>WHITE SHRIMP PANAMI / UDANG 150 GRAM</li><li>8 NASI / JAGUNG</li></ul>', '40dc742788dbd72e0493ea8d042e8624.jpg', 32, 0, 0),
(53, 'King Crab', 'king-crab', 425000, '<h3><strong>FOR 6-8 PERSON</strong></h3><ul><li>MEDIUM CRAB 6 EKOR / 6 KEPITING MEDIUM</li><li>FRIED CHICKEN WINGS / 4-5 SAYAP AYAM GORENG</li><li>MUSSELS / KERANG 400 GRAM</li><li>WHITE SHRIMP PANAMI / UDANG 200 GRAM</li><li>6 NASI / JAGUNG</li></ul>', '50d5392ff0cfca71fcc5330bb1fe3150.jpg', 32, 0, 0),
(54, 'Super Giant Crab', 'super-giant-crab', 575000, '<h3><strong>FOR 8-10 PERSON</strong></h3><ul><li>MEDIUM CRAB 8 EKOR / 8 KEPITING MEDIUM</li><li>FRIED CHICKEN WINGS / 4-5 SAYAP AYAM GORENG</li><li>MUSSELS / KERANG &nbsp;400 GRAM</li><li>WHITE SHRIMP PANAMI / UDANG 200 GRAM</li><li>8 NASI / JAGUNG</li></ul>', '5a70f6dfac850f2ab62401d7b25630fd.jpg', 32, 0, 0),
(55, 'Gangster', 'gangster', 220000, '<h3><strong>FOR 3-4 PERSON</strong></h3><ul><li>MEDIUM CRAB 1 EKOR / 1 KEPITING MEDIUM</li><li>LOBSTER 1 EKOR</li><li>FRIED CHICKEN WINGS / 2-3 SAYAP AYAM GORENG</li><li>MUSSELS / KERANG 200 GRAM</li><li>WHITE SHRIMP PANAMI / UDANG 150 GRAM</li><li>3 NASI / JAGUNG</li></ul>', '23bdebb311b04d75c2705b64e47bfdb4.jpg', 33, 0, 0),
(56, 'Master', 'master', 300000, '<h3><strong>FOR 5-6 PERSON</strong></h3><ul><li>MEDIUM CRAB 2 EKOR / 2 KEPITING MEDIUM</li><li>LOBSTER 1 EKOR</li><li>FRIED CHICKEN WINGS / 3-4 SAYAP AYAM GORENG</li><li>MUSSELS / KERANG 300 GRAM</li><li>WHITE SHRIMP PANAMI / UDANG 150 GRAM</li><li>4 NASI / JAGUNG</li></ul>', '9637e2e32aa8047a289153a62376b21c.jpg', 33, 1, 0),
(57, 'Super Crabster', 'super-crabster', 500000, '<h3><strong>FOR 7-8 PERSON</strong></h3><ul><li>MEDIUM CRAB 4 EKOR / 4 KEPITING MEDIUM</li><li>LOBSTER 2 EKOR</li><li>FRIED CHICKEN WINGS / 3-4 SAYAP AYAM GORENG</li><li>MUSSELS / KERANG 400 GRAM</li><li>WHITE SHRIMP PANAMI / UDANG 200 GRAM</li><li>7 NASI / JAGUNG</li></ul>', '9b6a12a1656b766ba617c14472cd1b82.jpg', 33, 0, 0),
(60, 'Monster Giant', 'monster-giant', 350000, '<h3><strong>FOR 7-8 PERSON</strong></h3><ul><li>GIANT CRAB 4 EKOR / 4 KEPITING GIANT</li><li>FRIED CHICKEN WINGS / 3-4 SAYAP AYAM GORENG</li><li>MUSSELS / KERANG 300 GRAM</li><li>WHITE SHRIMP PANAMI / UDANG 150 GRAM</li><li>6 NASI / JAGUNG</li></ul>', '00c1dad57ba46db8e767982443613585.jpg', 31, 0, 0),
(61, 'King Giant', 'king-giant', 520000, '<h3><strong>FOR 8-10 PERSON</strong></h3><ul><li>GIANT CRAB 6 EKOR / 6 KEPITING GIANT</li><li>FRIED CHICKEN WINGS / 4-5 SAYAP AYAM GORENG</li><li>MUSSELS / KERANG 400 GRAM</li><li>WHITE SHRIMP PANAMI / UDANG 200 GRAM</li><li>8 NASI / JAGUNG</li></ul>', '6e8fced4437cffb7d1ec5aade3bdfd5b.jpg', 31, 0, 0),
(62, 'Super Crabster Giant', 'super-crabster-giant', 570000, '<h3><strong>FOR 9-10 PERSON</strong></h3><ul><li>GIANT CRAB 4 EKOR / 4 KEPITING GIANT</li><li>LOBSTER 2 EKOR</li><li>FRIED CHICKEN WINGS / 3-4 SAYAP AYAM GORENG</li><li>MUSSELS / KERANG 400 GRAM</li><li>WHITE SHRIMP PANAMI / UDANG 200 GRAM</li><li>8 NASI / JAGUNG</li></ul>', '3b6abd7a98730e6d6ada957ac2ffab07.jpg', 31, 0, 0),
(63, 'Crab Fish Combo 1', 'crab-fish-combo-1', 150000, '<h3><strong>FOR 2-3 PERSON</strong></h3><ul><li>1 KEPITING MEDIUM</li><li>2 LOBSTER TAWAR / CRAYFISH</li><li>MUSSELS / KERANG 300 GRAM</li><li>4 NASI / JAGUNG</li></ul>', 'c23a680513fa448f6006ce0e127125e7.jpg', 34, 0, 0),
(64, 'Crab Fish Combo 2', 'crab-fish-combo-2', 230000, '<h3><strong>FOR 2-3 PERSON</strong></h3><ul><li>2 KEPITING MEDIUM</li><li>4 LOBSTER TAWAR / CRAYFISH</li><li>MUSSELS / KERANG 500 GRAM</li><li>4 NASI / JAGUNG</li></ul>', 'cce78ff2023decfcf1c334523cbfef8b.jpg', 34, 0, 0),
(65, 'Smoked Crab Medium', 'smoked-crab-medium', 100000, '<p>TRADITIONAL FLAVOR WITH SPICY AND SAVORY TASTE, SMOKED WITH BANANA LEAF SMELL\'S SO GOOD</p>', '7fad13ced82df26a7caab622b2910e73.jpg', 35, 0, 0),
(66, 'Smoked Crab Giant', 'smoked-crab-giant', 130000, '<p>TRADITIONAL FLAVOR WITH SPICY AND SAVORY TASTE, SMOKED WITH BANANA LEAF SMELL\'S SO GOOD</p>', 'f7672da79d0ccf6ed91f6a8a834763c7.jpg', 35, 1, 0),
(67, 'New The Crabbys Big Match 1', 'new-the-crabbys-big-match-1', 550000, '<h3><strong>FOR 7-8 PERSON</strong></h3><ul><li>1 KG KEPITING TARAKAN ISI 4 EKOR SAUS CRABBYS</li><li>1 KG MIX KEPITING SAUS CRABBYS</li><li>1 PAX UDANG GORENG TEPUNG 100 GRAM</li><li>1 PAX CUMI SAUS CRABBYS 100 GRAM</li><li>1 GURAME / BAWAL GORENG TEPUNG</li><li>1 PAX TERONG GORENG TEPUNG</li><li>1 PAX TEMPE GORENG TEPUNG</li><li>1 PORSI CA KANGKUNG</li><li>1 PORSI CA BUNCIS</li></ul>', 'default.png', 36, 0, 0),
(68, 'Ca Buncis', 'ca-buncis', 12000, NULL, 'default.png', 37, 0, 0),
(69, 'Ca Kangkung', 'ca-kangkung', 12000, NULL, 'default.png', 37, 0, 0),
(70, 'Broccoli', 'broccoli', 20000, NULL, 'default.png', 37, 0, 0),
(71, 'Terong Crispy', 'terong-crispy', 7000, NULL, 'default.png', 37, 0, 0),
(72, 'Tempe Mendoan', 'tempe-mendoan', 7000, NULL, '90150c5b91aab9859621e42e133dd69e.jpg', 37, 1, 0),
(73, 'French Fries', 'french-fries', 18000, NULL, 'default.png', 37, 0, 0),
(74, 'Jengkol Balado', 'jengkol-balado', 15000, NULL, 'default.png', 37, 0, 0),
(75, 'Pete Goreng', 'pete-goreng', 15000, NULL, 'default.png', 37, 0, 0),
(76, 'Single Tarakan Giant Crab', 'single-tarakan-giant-crab', 120000, '<ul><li>350 - 400 GRAMS UP</li><li>INCLUDE MUSSELS &amp; SWEET CORN OR RICE</li></ul>', 'default.png', 38, 0, 0),
(77, 'Single Local Crab', 'single-local-crab', 45000, '<p>INCLUDE MUSSELS &amp; SWEET CORN OR RICE</p>', '990e1fde891007eb5067133bbfb25264.jpg', 38, 0, 0),
(78, 'Single Tarakan Crab ', 'single-tarakan-crab-', 80000, '<p>INCLUDE MUSSELS &amp; SWEET CORN OR RICE</p>', '168d8cbc5cd800a7fdefbc717c84b5d5.jpg', 38, 0, 0),
(79, 'Lobster', 'lobster', 125000, '<p>INCLUDE MUSSELS &amp; SWEET CORN OR RICE</p>', 'default.png', 38, 0, 0),
(80, 'Crayfish', 'crayfish', 35000, '<p>INCLUDE &nbsp;SWEET CORN OR RICE</p>', 'default.png', 38, 0, 0),
(81, 'Medium Local Crab ', 'medium-local-crab-', 180000, '<p>1 KG LOCAL CRAB (16K/GRAMS)</p>', '2bd82dd7e7b01df5b81fd684b7bf5239.jpg', 39, 0, 0),
(82, 'Medium Tarakan Crab', 'medium-tarakan-crab', 240000, '<p>1 KG TARAKAN CRAB (20K/GRAMS)</p>', '0079879c55d0e52f2a8d11f1b893bb18.jpg', 39, 0, 0),
(83, 'Giant Tarakan Crab', 'giant-tarakan-crab', 300000, '<p>1 KG TARAKAN CRAB (20K/GRAMS)</p>', 'ead8c18ce4a8f1b8ba3b03c1f018ef29.jpg', 39, 0, 0),
(84, 'King Tarakan Crab', 'king-tarakan-crab', 350000, '<p>1 KG TARAKAN CRAB (20K/GRAMS)</p>', 'd2a48e2cc63364440622bf12df84ad4e.jpg', 39, 1, 0),
(85, 'Lobster', 'lobster', 400000, '<p>1 KG LOBSTER ( ISI -+ 12-10 EKOR)&nbsp;</p>', 'default.png', 39, 0, 0),
(86, 'Crayfish', 'crayfish', 250000, '<p>1 KG LOBSTER TAWAR / CRAYFISH (ISI -+ 10 EKOR)</p>', 'default.png', 39, 0, 0),
(87, 'Double Trouble Tarakan Crab ', 'double-trouble-tarakan-crab-', 150000, '<h3><strong>FOR 2-3 PERSON</strong></h3><ul><li>2 MEDIUM CRAB / 2 KEPITING MEDIUM</li><li>INCLUDE MUSSES &amp; SWEET CORN OR RICE</li></ul>', '93e920cef09d2d83946c19b06e30dca6.jpg', 40, 0, 0),
(88, 'Triple Trouble Tarakan Crab', 'triple-trouble-tarakan-crab', 210000, '<h3><strong>FOR 3-4 PERSON</strong></h3><ul><li>3 MEDIUM CRAB / 3 KEPITING MEDIUM</li><li>INCLUDE MUSSES &amp; SWEET CORN OR RICE</li></ul>', 'ac6224bb3e733a3d8f2bdd8c90287567.jpg', 40, 0, 0),
(89, 'Extra Corn', 'extra-corn', 6000, '', 'default.png', 41, 0, 0),
(90, 'Extra Rice', 'extra-rice', 5000, NULL, 'default.png', 41, 0, 0),
(91, 'Shrimp ', 'shrimp-', 25000, '<ul><li>FRIED / GORENG</li><li>THE CRABBYS SECRET SAUCE</li><li>GRILL / &nbsp;BAKAR</li></ul>', 'default.png', 41, 0, 0),
(92, 'Chicken Wings', 'chicken-wings', 18000, '<p>4 PCS CHICKEN WINGS</p>', 'default.png', 41, 0, 0),
(93, 'SQUID ', 'squid-', 22000, '<p>+- 100 GRAM SQUID</p><p>FRIED // THE CRABBYS SECRET SAUCE</p>', 'default.png', 41, 0, 0),
(94, 'Sambal', 'sambal', 5000, '<p>SAMBAL BAWANG, SAMBAL BALADO, SAMBAL KOREK</p>', 'default.png', 41, 0, 0),
(95, 'Extra Kerang ', 'extra-kerang-', 25000, '<p>250 GRAMS, GORENG / REBUS / MASAK SAUCE THE CRABBYS SECRET SAUCE &amp; BLACK MAGIC</p>', 'default.png', 41, 0, 0),
(96, 'Apron', 'apron', 2500, '<p>(DISPOSABLE APRON) APRON KERTAS HANYA UNTUK PAKETAN YANG SUDAH DISESUAIKAN JUMLAH PERSON DI MENU SELEBIHNYA AKAN DIKENAKAN CHARGE RP 2.500 PER PCS</p>', 'default.png', 41, 0, 0),
(97, 'Bawal', 'bawal', 45000, '<p>BAWAL LAUT</p><p>GORENG / BAKAR / SAUCE</p><p>INCLUDE NASI + LALAPAN + SAMBAL</p>', 'default.png', 42, 0, 0),
(98, 'Nila', 'nila', 25000, '<p>GORENG / BAKAR / SAUCE</p><p>INCLUDE NASI + LALAPAN + SAMBAL</p>', 'default.png', 42, 0, 0),
(99, 'Gurameh', 'gurameh', 40000, '<p>GORENG / BAKAR / SAUCE</p><p>INCLUDE NASI + LALAPAN + SAMBAL</p>', 'default.png', 42, 0, 0),
(100, 'Lobster Giant Plate', 'lobster-giant-plate', 75000, '<p>LOBSTER GIANT WITH EGG, RICE, CORN, SECRET SAUCE</p>', 'default.png', 43, 0, 0),
(101, 'Lobster Pluto', 'lobster-pluto', 45000, '<p>LOBSTER WITH EGG, RICE, CORN, SECRET SAUCE</p>', 'default.png', 43, 0, 0),
(102, 'Prawn Plate', 'prawn-plate', 25000, '<p>PRAWN WITH EGG, RICE, CORN, SECRET SAUCE</p>', 'default.png', 43, 0, 0),
(103, 'Chicken Plate', 'chicken-plate', 20000, '<p>CHICKEN WITH EGG, RICE, CORN, SECRET SAUCE</p>', 'default.png', 43, 0, 0),
(104, 'Squid Plate', 'squid-plate', 25000, '<p>SQUID WITH EGG, RICE, CORN, SECRET SAUCE</p>', 'default.png', 43, 0, 0),
(105, 'Kubu', 'kubu', 17000, '<p>MANGO, SPARKLING BERRY, YOGURT</p>', 'default.png', 45, 0, 0),
(106, 'Swingberry', 'swingberry', 17000, '<p>BANANA, SPARKLING BERRY, YOGURT</p>', 'default.png', 45, 0, 0),
(107, 'Maui', 'maui', 17000, '<p>APPLE, SPARKLING BERRY, YOGURT</p>', 'default.png', 45, 0, 0),
(108, 'Lemon For Lulu', 'lemon-for-lulu', 17000, '<p>STRAWBERRY, SPARKLING LEMON, CRUNCHY BERRY, LEMON</p>', 'default.png', 45, 0, 0),
(109, 'Yellow Spike', 'yellow-spike', 17000, '<p>PINEAPLE BREEZE, ORANGE, LEMON</p>', 'default.png', 45, 0, 0),
(110, 'Holy Pineapple', 'holy-pineapple', 20000, '<p>SPARKLING PINEAPPLE BREEZE, ACID BERRY, SO TROPICAL</p>', 'f166b8e5733e6a343ad0ef551a9931d8.jpg', 45, 0, 0),
(111, 'Pipeline', 'pipeline', 17000, '<p>CUCUMBER, ORANGE, SPARKLING ORANGE, LEMON</p>', 'default.png', 45, 0, 0),
(112, 'Tea Hot', 'tea-hot', 5000, NULL, 'default.png', 46, 0, 0),
(113, 'Tea Ice', 'tea-ice', 6000, NULL, 'default.png', 46, 0, 0),
(114, 'Orange Hot', 'orange-hot', 6000, NULL, 'default.png', 46, 0, 0),
(115, 'Orange Ice', 'orange-ice', 7000, NULL, 'default.png', 46, 0, 0),
(116, 'Lime Hot', 'lime-hot', 7000, NULL, 'default.png', 46, 0, 0),
(117, 'Lime Ice', 'lime-ice', 8000, NULL, 'default.png', 46, 0, 0),
(118, 'Thai Tea Hot', 'thai-tea-hot', 14000, NULL, 'default.png', 46, 0, 0),
(119, 'Thai Tea Ice', 'thai-tea-ice', 15000, NULL, 'default.png', 46, 0, 0),
(120, 'Original Coconut', 'original-coconut', 18000, NULL, 'default.png', 46, 0, 0),
(121, 'Plus Coconut', 'plus-coconut', 20000, NULL, 'default.png', 46, 0, 0),
(122, 'Teh Tarik Hot', 'teh-tarik-hot', 8000, NULL, 'default.png', 46, 0, 0),
(123, 'Teh Tarik Ice', 'teh-tarik-ice', 9000, NULL, 'default.png', 46, 0, 0),
(124, 'Cappuccino Hot', 'cappuccino-hot', 12000, NULL, 'default.png', 46, 0, 0),
(125, 'Cappuccino Ice', 'cappuccino-ice', 13000, NULL, 'default.png', 46, 0, 0),
(126, 'Black Coffee Hot', 'black-coffee-hot', 8000, NULL, 'default.png', 46, 0, 0),
(127, 'Black Coffee Ice', 'black-coffee-ice', 9000, NULL, 'default.png', 46, 0, 0),
(128, 'Milo Hot', 'milo-hot', 12000, NULL, 'default.png', 46, 0, 0),
(129, 'Milo Ice', 'milo-ice', 13000, NULL, 'default.png', 46, 0, 0),
(130, 'Matcha Latte Hot', 'matcha-latte-hot', 12000, NULL, 'default.png', 46, 0, 0),
(131, 'Matcha Latte Ice', 'matcha-latte-ice', 13000, NULL, 'default.png', 46, 0, 0),
(132, 'Mineral Water', 'mineral-water', 5000, NULL, 'default.png', 46, 0, 0),
(133, 'Cucumber', 'cucumber', 12000, NULL, 'default.png', 47, 0, 0),
(134, 'Banana', 'banana', 13000, NULL, 'default.png', 47, 0, 0),
(135, 'Pineapple', 'pineapple', 13000, NULL, 'default.png', 47, 0, 0),
(136, 'Strawberry', 'strawberry', 15000, NULL, 'd6b036e306759b5c7a443b38d9df4b03.jpg', 47, 0, 0),
(137, 'Apple', 'apple', 15000, NULL, '8dcc1f560c64c3d9bae681ae7abb7914.jpg', 47, 1, 0),
(138, 'Mango', 'mango', 16000, NULL, '347f953e107978c66365bead4c843e2a.jpg', 47, 1, 0),
(139, 'Dragon Fruit', 'dragon-fruit', 18000, NULL, '2d2badc7cdc2748eeb2d64a509fa5b26.jpg', 47, 0, 0),
(140, 'Banaberry', 'banaberry', 15000, NULL, '6fbe4aa5118d1a49b038ffa74f3a7a97.jpg', 47, 1, 0),
(141, 'Mangoberry', 'mangoberry', 19000, NULL, '11bc78763a0f795205cceb987e682af5.jpg', 47, 0, 0),
(142, 'Water Melon', 'water-melon', 13000, NULL, 'a1ffbc8f3e44823ca00062341157545a.jpg', 47, 0, 0),
(143, 'Avocado', 'avocado', 13000, NULL, 'f68e92d9c371416077304d99ae0987b3.jpg', 47, 0, 0),
(144, 'Orange Juice', 'orange-juice', 13000, NULL, 'fcfcac92f5ff541d6b3b46e58550f936.jpg', 47, 0, 0),
(145, 'Melon', 'melon', 13000, NULL, 'd8b230c11403ebdf6e7f2817704bbacb.jpg', 47, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_transaksi`
--

CREATE TABLE `tabel_transaksi` (
  `transaksi_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=konfirm dapur, 2=pending bayar,3=memasak,4=mengirim,5=selesai, 6=expired',
  `waktu` datetime NOT NULL,
  `waktu_batas` datetime NOT NULL,
  `pembayaran` varchar(25) NOT NULL,
  `total` int(11) NOT NULL,
  `id_kupon` int(11) DEFAULT NULL,
  `potongan` int(11) DEFAULT NULL,
  `ongkir` int(11) NOT NULL,
  `for_event` int(11) DEFAULT NULL COMMENT '1=event on',
  `code_bayar` varchar(256) DEFAULT NULL COMMENT 'va number dan qr code',
  `deeplink` varchar(256) DEFAULT NULL COMMENT 'deeplink gopay dan company code'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_transaksi`
--

INSERT INTO `tabel_transaksi` (`transaksi_id`, `member_id`, `tanggal`, `status`, `waktu`, `waktu_batas`, `pembayaran`, `total`, `id_kupon`, `potongan`, `ongkir`, `for_event`, `code_bayar`, `deeplink`) VALUES
(44, 44, '2021-03-08', 5, '2021-03-08 23:41:50', '2021-03-09 00:01:50', 'gopay', 31000, NULL, NULL, 18000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/89bd5ce2-2016-44b5-8aee-675154943e65/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=dd9fbb05-984f-49d1-8d20-ec80b6b87498'),
(45, 44, '2021-03-09', 5, '2021-03-09 00:50:29', '2021-03-09 01:10:29', 'bca', 148000, NULL, NULL, 18000, 0, '89324443346', ''),
(46, 44, '2021-03-09', 5, '2021-03-09 00:55:38', '2021-03-09 01:15:38', 'bca', 25000, NULL, NULL, 18000, 0, '89324886494', ''),
(47, 44, '2021-03-09', 5, '2021-03-09 01:00:26', '2021-03-09 01:20:26', 'bca', 38000, NULL, NULL, 18000, 0, '89324299329', ''),
(48, 44, '2021-03-09', 5, '2021-03-09 01:05:24', '2021-03-09 01:25:24', 'permata', 148000, NULL, NULL, 18000, 0, '893002975508271', ''),
(49, 44, '2021-03-09', 5, '2021-03-09 01:18:10', '2021-03-09 01:38:10', 'mandiri', 25000, NULL, NULL, 18000, 0, '863583255018', '70012'),
(52, 44, '2021-03-09', 5, '2021-03-09 10:35:37', '2021-03-09 10:55:37', 'bca', 148000, NULL, NULL, 18000, 0, '89324219414', ''),
(55, 44, '2021-03-09', 5, '2021-03-09 12:46:15', '2021-03-09 13:06:15', 'permata', 38000, NULL, NULL, 18000, 0, '893006858619989', ''),
(57, 44, '2021-03-09', 5, '2021-03-09 14:05:19', '2021-03-09 14:25:19', 'permata', 368000, NULL, NULL, 18000, 0, '893008878829324', ''),
(59, 44, '2021-03-10', 5, '2021-03-10 14:34:07', '2021-03-10 14:54:07', 'bca', 38000, NULL, NULL, 18000, 0, '89324982683', ''),
(60, 44, '2021-03-10', 5, '2021-03-10 18:32:34', '2021-03-10 18:52:34', 'gopay', 148000, NULL, NULL, 18000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/d1bff9ce-31aa-4772-8f3f-3840ca0d7606/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=564923da-2a29-42af-a368-c2f221a375a6'),
(66, 44, '2021-03-10', 5, '2021-03-10 19:55:43', '2021-03-10 20:15:43', 'permata', 268000, NULL, NULL, 18000, 0, '893004018190242', ''),
(67, 44, '2021-03-10', 5, '2021-03-10 19:56:17', '2021-03-10 20:16:17', 'gopay', 368000, NULL, NULL, 18000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/7ac694a3-87a4-43ec-a1b5-bc9c606a0cc3/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=7bc97877-4590-410f-8883-609fc9410915'),
(70, 44, '2021-03-10', 5, '2021-03-10 23:59:34', '2021-03-11 00:19:34', 'bca', 38000, NULL, NULL, 18000, 0, '89324949532', ''),
(71, 44, '2021-03-11', 5, '2021-03-11 00:00:09', '2021-03-11 00:20:09', 'gopay', 25000, NULL, NULL, 18000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/3a04e97a-b2be-4be0-9694-297efdf7683f/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=1632f96b-d41d-4ff6-99ba-b6b00b6f9ee2'),
(76, 44, '2021-03-11', 5, '2021-03-11 19:26:35', '2021-03-11 19:46:35', 'gopay', 318000, NULL, NULL, 18000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/5560091e-3fe4-4c77-8391-2cb5d974fa73/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=ff73cf5e-56fb-4e1a-a336-f316d071e6ac'),
(95, 44, '2021-03-12', 5, '2021-03-12 02:22:50', '2021-03-12 02:42:50', 'mandiri', 148000, NULL, NULL, 18000, 0, '13898125090', '70012'),
(96, 44, '2021-03-12', 5, '2021-03-12 02:32:38', '2021-03-12 02:52:38', 'bca', 148000, NULL, NULL, 18000, 0, '89324002059', ''),
(97, 44, '2021-03-12', 5, '2021-03-12 02:38:43', '2021-03-12 02:58:43', 'bca', 31000, NULL, NULL, 18000, 0, '89324899228', ''),
(99, 44, '2021-03-12', 5, '2021-03-12 02:48:56', '2021-03-12 03:08:56', 'bca', 31000, NULL, NULL, 18000, 0, '89324197140', ''),
(107, 44, '2021-03-12', 5, '2021-03-12 15:21:50', '2021-03-12 15:41:50', 'bca', 31000, NULL, NULL, 18000, 0, '89324050602', ''),
(111, 44, '2021-03-12', 5, '2021-03-12 16:26:43', '2021-03-12 16:46:43', 'gopay', 148000, NULL, NULL, 18000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/2a37dd3c-2f85-4bbe-8efc-7419e1b7daf3/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=3459c4e8-2fc2-448a-a908-b2fbf3335ee0'),
(118, 44, '2021-03-13', 5, '2021-03-13 21:13:14', '2021-03-13 21:33:14', 'gopay', 148000, NULL, NULL, 18000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/52c45d95-22a7-4c90-8d61-910bd54d41ee/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=a492450b-e929-4289-93e4-addabf912e2e'),
(143, 44, '2021-03-16', 5, '2021-03-16 00:29:10', '2021-03-16 00:49:10', 'bni', 31000, NULL, NULL, 18000, 0, '9888932473677421', ''),
(150, 32, '2021-03-16', 5, '2021-03-16 00:48:02', '2021-03-16 01:08:02', 'bca', 213000, NULL, NULL, 200000, 0, '89324355459', ''),
(172, 44, '2021-03-22', 4, '2021-03-22 17:08:48', '2021-03-22 17:28:48', 'gopay', 228000, 6, 30000, 18000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/ac594988-a27e-46ab-8d2e-0d7fefe112a5/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=6bbd9763-1980-4a2e-b069-95171512bb3a'),
(173, 44, '2021-03-22', 5, '2021-03-22 17:16:55', '2021-03-22 17:36:55', 'gopay', 448000, 13, 50000, 18000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/bedcf3e7-fff1-4a25-9a56-be4e1d8b012f/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=3a1317ed-86cf-4534-b536-ad708adfdc8b'),
(174, 44, '2021-03-22', 5, '2021-03-22 17:18:26', '2021-03-22 17:38:26', 'gopay', 218000, 13, 50000, 18000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/384adfef-333f-415b-8a79-27c28c964ecb/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=a4fcf8f3-8b5d-46b6-aae0-d5eba62a4046'),
(176, 32, '2021-03-22', 4, '2021-03-22 17:23:07', '2021-03-22 17:43:07', 'gopay', 103000, 15, 39000, 12000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/ca215cd8-5028-4c38-9117-dc63ae6c4db0/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=4f2e9759-2935-4b05-ab96-ca1a5f00b7da'),
(177, 32, '2021-03-22', 3, '2021-03-22 18:11:14', '2021-03-22 18:31:14', 'gopay', 300100, 13, 42900, 200000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/5d24d470-6549-440a-a84b-e53fb1222e9e/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=82f5c3bb-97bb-4bae-a194-e6b0016e4f05'),
(178, 32, '2021-03-22', 3, '2021-03-22 19:27:36', '2021-03-22 19:47:36', 'gopay', 114100, 13, 42900, 14000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/40822ac6-ec79-44a3-a046-66586e7b439a/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=624e7beb-cdee-4e93-a4e5-79b050a2d5a4'),
(179, 32, '2021-03-22', 3, '2021-03-22 19:57:12', '2021-03-22 20:17:12', 'gopay', 433000, 15, 80000, 18000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/e3b6c42e-60e8-4aef-8526-ec97f2b9fa79/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=4e966bec-46f6-4c25-a43f-89cf99fe6286'),
(180, 32, '2021-03-22', 3, '2021-03-22 20:18:48', '2021-03-22 20:38:48', 'gopay', 263000, 15, 80000, 18000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/99701c04-d6ee-46e0-8996-f8bb1ad83a6d/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=df8f98f4-dec3-421e-8f0b-7de4653ebf04'),
(181, 51, '2021-03-22', 3, '2021-03-22 20:19:08', '2021-03-22 20:39:08', 'gopay', 117500, 13, 43500, 16000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/93e32a05-e4f3-4168-a814-cfb8f668968c/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=59dfb0da-3171-41f6-a252-1c943f6d71e0'),
(183, 44, '2021-03-24', 4, '2021-03-24 21:02:27', '2021-03-24 21:22:27', 'gopay', 278000, 13, 50000, 18000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/10c5c75b-4fb3-472f-9981-3d93034da713/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=e698d67a-e9ed-498f-8589-87573f9d2466'),
(185, 44, '2021-03-30', 5, '2021-03-30 21:26:09', '2021-03-30 21:46:09', 'gopay', 503000, 15, 80000, 18000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/0948e878-03ee-4ce5-9d06-1de3db665051/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=462baa97-0697-4ee5-983b-baeeeac140e4'),
(186, 44, '2021-03-30', 5, '2021-03-30 21:28:13', '2021-03-30 21:48:13', 'gopay', 288000, 15, 80000, 18000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/a9c4e5c9-b0b0-4ba0-9f2e-7e1cc8f0c4b4/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=f1d11149-6d0d-441d-93fe-d99204c7c29a'),
(204, 56, '2021-03-31', 5, '2021-03-31 23:53:22', '2021-04-01 00:13:22', 'gopay', 220000, 13, 50000, 20000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/30f78f81-4762-49a2-8a24-f98f0a5b49db/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=dde6ef1e-d435-4d5e-8cd4-087ad2246b0b'),
(205, 56, '2021-04-01', 5, '2021-04-01 00:38:28', '2021-04-01 00:58:28', 'gopay', 210000, 0, 0, 20000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/279259cb-ec17-4244-8124-6294c72d2726/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=e08af59a-065c-4d7c-bb67-4db5f3d1e452'),
(211, 44, '2021-04-13', 6, '2021-04-13 17:05:13', '2021-04-13 17:25:13', 'bca', 118000, 17, 30000, 18000, 1, '89324092197', ''),
(212, 44, '2021-04-16', 6, '2021-04-16 01:09:09', '2021-04-16 01:29:09', 'bca', 44000, 0, 0, 18000, 1, '89324473012', ''),
(213, 44, '2021-04-16', 6, '2021-04-16 01:28:18', '2021-04-16 01:48:18', 'gopay', 188100, 18, 72900, 18000, 1, NULL, NULL),
(214, 44, '2021-04-16', 3, '2021-04-16 01:33:58', '2021-04-16 01:53:58', 'gopay', 31000, 0, 0, 18000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/e86d97d1-385c-4479-badf-84eac63ebf91/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=ed8175ad-9db9-44f6-b20a-153ffa55e7e1'),
(215, 57, '2021-05-02', 5, '2021-05-02 02:11:01', '2021-05-02 02:31:01', 'gopay', 146000, 16, 15000, 18000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/de8895cf-ffe1-4b29-8c25-0cd5f652a654/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=4165196d-e312-4f10-a584-7f71f92b147f'),
(216, 57, '2021-05-02', 6, '2021-05-02 02:12:09', '2021-05-02 02:32:09', 'gopay', 238000, 17, 30000, 18000, 1, NULL, NULL),
(217, 57, '2021-05-02', 3, '2021-05-02 02:13:34', '2021-05-02 02:33:34', 'bca', 268000, 0, 0, 18000, 0, '89324605303', ''),
(218, 57, '2021-05-02', 4, '2021-05-02 02:14:21', '2021-05-02 02:34:21', 'gopay', 268000, 0, 0, 18000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/4ada2224-287a-4b0a-89a7-77d6c54524f3/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=e27898cc-427c-4ae6-9a53-5485d4d8dc29'),
(219, 57, '2021-05-02', 6, '2021-05-02 02:20:38', '2021-05-02 02:40:38', 'gopay', 368000, 0, 0, 18000, 1, 'https://api.sandbox.veritrans.co.id/v2/gopay/40fa8417-f907-4a08-9f5d-3e46f857dbe4/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=c85d0374-63c1-4904-8f30-b2c862eb44b6'),
(220, 57, '2021-05-02', 6, '2021-05-02 02:21:38', '2021-05-02 02:41:38', 'gopay', 148000, 0, 0, 18000, 1, 'https://api.sandbox.veritrans.co.id/v2/gopay/6be27c6d-ea9b-4ba1-b8d2-9ecceb45d79c/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=ae563829-1e08-4bbd-b7ca-5b8472f5f281'),
(221, 57, '2021-05-02', 6, '2021-05-02 23:13:40', '2021-05-02 23:33:40', 'gopay', 202100, 18, 78900, 18000, 1, 'https://api.sandbox.veritrans.co.id/v2/gopay/7f0efc89-cdc7-4bc1-ba61-02093b2789d1/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=22f0d40c-669c-4d03-ba3f-fca191417541'),
(222, 57, '2021-05-02', 5, '2021-05-02 23:55:02', '2021-05-03 00:15:02', 'bca', 486000, 18, 80000, 18000, 0, '89324734412', ''),
(223, 57, '2021-05-03', 6, '2021-05-03 00:09:48', '2021-05-03 00:29:48', 'gopay', 248000, 0, 0, 18000, 1, 'https://api.sandbox.veritrans.co.id/v2/gopay/a06844fa-cabe-4570-b892-8be64f2f78ed/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=4bff95a6-b0c6-43e5-acff-ae8642fc4482'),
(224, 57, '2021-05-03', 5, '2021-05-03 02:40:21', '2021-05-03 03:00:21', 'gopay', 148000, 0, 0, 18000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/91384af8-a4e0-4f78-ade2-9d90d3558bbe/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=fdde7de2-3d3e-42bb-b21e-07fe67d41594'),
(225, 44, '2021-05-05', 6, '2021-05-05 11:14:25', '2021-05-05 11:34:25', 'gopay', 268000, 0, 0, 18000, 1, 'https://api.sandbox.veritrans.co.id/v2/gopay/7eaf9f2b-212a-4a45-a7cf-fd427006499d/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=7b1c7dd0-e2eb-49a8-bb8b-9fe7ac225f0a'),
(228, 44, '2021-05-05', 3, '2021-05-05 11:27:40', '2021-05-05 11:47:40', 'gopay', 338000, 17, 30000, 18000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/b438b241-3f24-48b9-a43a-abc620d8d53b/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=deddf3bf-10ab-4e64-aa46-bcb63878c221'),
(229, 61, '2021-05-07', 5, '2021-05-07 16:35:20', '2021-05-07 16:55:20', 'bca', 1100000, 16, 15000, 18000, 0, '89324637279', ''),
(230, 44, '2021-06-04', 3, '2021-06-04 01:40:24', '2021-06-04 02:00:24', 'gopay', 278000, 0, 0, 18000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/c303b56b-4972-4675-9489-ca20e136dba9/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=12f668b7-35b5-4568-959a-bca545a09707'),
(231, 44, '2021-06-04', 5, '2021-06-04 01:46:34', '2021-06-04 02:06:34', 'gopay', 193000, 18, 75000, 18000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/1c8c0543-9654-47e7-8e83-19323017cf1f/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=3b2766ee-0bb4-417a-8fb8-b4ca9d6d3c5d'),
(232, 44, '2021-06-15', 3, '2021-06-15 10:49:28', '2021-06-15 11:09:28', 'bca', 304000, 18, 80000, 34000, 0, '89324298872', ''),
(233, 44, '2021-06-15', 3, '2021-06-15 11:06:07', '2021-06-15 11:26:07', 'gopay', 248000, 0, 0, 18000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/9e3ded42-b6f4-4445-885b-cba8f8c65aef/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=b58994d2-c3f8-40a9-9d22-5cc5950faa29'),
(234, 32, '2021-06-18', 5, '2021-06-18 08:58:54', '2021-06-18 09:18:54', 'gopay', 240000, 17, 30000, 20000, 0, 'https://api.sandbox.veritrans.co.id/v2/gopay/a44c9543-2501-4427-a5f9-69f1d88c6151/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=1612b836-1a97-429a-9b43-ed943e08eed4'),
(235, 44, '2021-06-20', 6, '2021-06-20 17:32:40', '2021-06-20 17:52:40', 'gopay', 253000, 17, 30000, 18000, 1, 'https://api.sandbox.veritrans.co.id/v2/gopay/2aa80806-1b48-425b-942a-a067725b0852/qr-code', 'https://simulator.sandbox.midtrans.com/gopay/partner/app/payment-pin?id=e2751ec8-e51e-43e9-a419-8cbe6655925b');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_transaksi_detail`
--

CREATE TABLE `tabel_transaksi_detail` (
  `detail_id` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `varian_id` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_transaksi_detail`
--

INSERT INTO `tabel_transaksi_detail` (`detail_id`, `transaksi_id`, `produk_id`, `varian_id`, `qty`) VALUES
(77, 44, 143, 0, 1),
(78, 45, 66, 0, 1),
(79, 46, 72, 0, 1),
(80, 47, 110, 0, 1),
(81, 48, 66, 0, 1),
(82, 49, 72, 0, 1),
(85, 52, 66, 0, 1),
(88, 55, 110, 0, 1),
(90, 57, 84, 0, 1),
(92, 59, 110, 0, 1),
(93, 60, 66, 0, 1),
(99, 66, 48, 9, 1),
(100, 67, 84, 0, 1),
(103, 70, 110, 0, 1),
(104, 71, 72, 0, 1),
(110, 76, 56, 11, 1),
(132, 95, 66, 0, 1),
(133, 96, 66, 0, 1),
(134, 97, 143, 0, 1),
(136, 99, 143, 0, 1),
(144, 107, 142, 0, 1),
(148, 111, 66, 0, 1),
(158, 118, 66, 0, 1),
(183, 143, 142, 0, 1),
(190, 150, 143, 0, 1),
(218, 172, 50, 17, 1),
(219, 173, 49, 1, 1),
(220, 173, 66, 0, 1),
(221, 174, 48, 15, 1),
(223, 176, 66, 0, 1),
(224, 177, 142, 0, 1),
(225, 177, 66, 0, 1),
(226, 178, 142, 0, 1),
(227, 178, 66, 0, 1),
(228, 179, 137, 0, 1),
(229, 179, 66, 0, 1),
(230, 179, 84, 0, 1),
(231, 180, 56, 17, 1),
(232, 180, 137, 0, 1),
(233, 181, 66, 0, 1),
(234, 181, 137, 0, 1),
(237, 183, 56, 17, 1),
(239, 185, 56, 15, 1),
(240, 185, 137, 0, 1),
(241, 185, 48, 1, 1),
(242, 186, 84, 0, 1),
(260, 204, 48, 15, 1),
(261, 205, 51, 1, 1),
(267, 211, 66, 0, 1),
(268, 212, 142, 0, 1),
(269, 212, 143, 0, 1),
(270, 213, 50, 11, 1),
(271, 213, 142, 0, 1),
(272, 214, 142, 0, 1),
(273, 215, 66, 0, 1),
(274, 215, 142, 0, 1),
(275, 216, 48, 11, 1),
(276, 217, 48, 1, 1),
(277, 218, 48, 1, 1),
(278, 219, 84, 0, 1),
(279, 220, 66, 0, 1),
(280, 221, 142, 0, 1),
(281, 221, 48, 1, 1),
(282, 222, 49, 16, 1),
(283, 222, 110, 0, 2),
(284, 222, 139, 0, 1),
(285, 222, 66, 0, 1),
(286, 223, 50, 11, 1),
(287, 224, 66, 0, 1),
(288, 225, 48, 11, 1),
(291, 228, 84, 0, 1),
(292, 229, 56, 12, 1),
(293, 229, 56, 16, 1),
(294, 229, 84, 0, 1),
(295, 229, 66, 0, 1),
(296, 229, 72, 0, 1),
(297, 230, 48, 17, 1),
(298, 231, 48, 1, 1),
(299, 232, 49, 1, 1),
(300, 233, 50, 11, 1),
(301, 234, 48, 14, 1),
(302, 235, 48, 11, 1),
(303, 235, 137, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_transaksi_detail_billing`
--

CREATE TABLE `tabel_transaksi_detail_billing` (
  `id` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL,
  `nama_lengkap` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `catatan` text,
  `lat` varchar(128) NOT NULL,
  `lng` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_transaksi_detail_billing`
--

INSERT INTO `tabel_transaksi_detail_billing` (`id`, `transaksi_id`, `nama_lengkap`, `email`, `no_hp`, `catatan`, `lat`, `lng`) VALUES
(44, 44, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'sadsa', '-7.746514', '110.346945'),
(45, 45, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'dsadsa', '-7.746514', '110.346945'),
(46, 46, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'dsadsa', '-7.746514', '110.346945'),
(47, 47, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'jhjg', '-7.746514', '110.346945'),
(48, 48, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'dsadsa', '-7.746514', '110.346945'),
(49, 49, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'dsad', '-7.746514', '110.346945'),
(52, 52, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'dsadas', '-7.746514', '110.346945'),
(55, 55, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'sasas', '-7.746514', '110.346945'),
(57, 57, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'dsadsa', '-7.746514', '110.346945'),
(59, 59, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'dsadsa', '-7.746514', '110.346945'),
(60, 60, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'sadsa', '-7.746514', '110.346945'),
(66, 66, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'fdsfds', '-7.746514', '110.346945'),
(67, 67, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'dfdsdfg', '-7.746514', '110.346945'),
(70, 70, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'dsadsad', '-7.746514', '110.346945'),
(71, 71, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'dsadasd', '-7.746514', '110.346945'),
(76, 76, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'hjghj', '-7.746514', '110.346945'),
(95, 95, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'dsadsa', '-7.746514', '110.346945'),
(96, 96, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'dsadsa', '-7.746514', '110.346945'),
(97, 97, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'dsadsa', '-7.746514', '110.346945'),
(99, 99, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'dsad', '-7.746514', '110.346945'),
(107, 107, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'dsad', '-7.746514', '110.346945'),
(111, 111, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'dsdsa', '-7.746514', '110.346945'),
(118, 118, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'sdadsa', '-7.746514', '110.346945'),
(143, 143, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'dsa', '-7.746514', '110.346945'),
(150, 150, 'Dwi Lutfiana', 'dwilutfiana7@gmail.com', '7657354353', 'dsada', '-7.150975', '110.140259'),
(172, 172, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'dsadsa', '-7.746514', '110.346945'),
(173, 173, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'dsadsa', '-7.746514', '110.346945'),
(174, 174, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'dsafsa', '-7.746514', '110.346945'),
(176, 176, 'Dwi Lutfiana', 'dwilutfiana7@gmail.com', '086674344', 'fdhfgh', '-7.749817', '110.362601'),
(177, 177, 'Dwi Lutfiana', 'dwilutfiana7@gmail.com', '787', 'sd', '-7.150975', '110.140259'),
(178, 178, 'Dwi Lutfiana', 'dwilutfiana7@gmail.com', '5465475676', 'dsfdsfs', '-7.74952', '110.362279'),
(179, 179, 'Dwi Lutfiana', 'dwilutfiana7@gmail.com', '08212673218', 'ghfgfhg', '-7.750316', '110.353626'),
(180, 180, 'Dwi Lutfiana', 'dwilutfiana7@gmail.com', '08212673218', 'Gjohxbmoj', '-7.750316', '110.353626'),
(181, 181, 'Ibnu Sofyan', 'ibnusofyanfyan@gmail.com', '86544789', 'Fhjjh', '-7.744777', '110.346334'),
(183, 183, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'Hhh', '-7.746514', '110.346945'),
(185, 185, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'hhhhh', '-7.746514', '110.346945'),
(186, 186, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'bhjkkl', '-7.746514', '110.346945'),
(204, 204, 'Noha Fitria', 'nohaftria@gmail.com', '081233', 'Rghgf', '-7.748201', '110.354361'),
(205, 205, 'Noha Fitria', 'nohaftria@gmail.com', '081233', 'Hgfv', '-7.748201', '110.354361'),
(211, 211, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'dsadsa', '-7.746514', '110.346945'),
(212, 212, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'dsadsa', '-7.746514', '110.346945'),
(213, 213, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'dsadas', '-7.746514', '110.346945'),
(214, 214, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'sdadas', '-7.746514', '110.346945'),
(215, 215, 'The Crabbys', 'crabbys.info@gmail.com', '085738737371', 'kos warna coklat', '-7.746497', '110.346983'),
(216, 216, 'The Crabbys', 'crabbys.info@gmail.com', '085738737371', 'kos warna coklat', '-7.746497', '110.346983'),
(217, 217, 'The Crabbys', 'crabbys.info@gmail.com', '085738737371', 'bfdgdf', '-7.746497', '110.346983'),
(218, 218, 'The Crabbys', 'crabbys.info@gmail.com', '085738737371', 'dsadsa', '-7.746497', '110.346983'),
(219, 219, 'The Crabbys', 'crabbys.info@gmail.com', '085738737371', 'dsadsa', '-7.746497', '110.346983'),
(220, 220, 'The Crabbys', 'crabbys.info@gmail.com', '085738737371', 'dsadas', '-7.746497', '110.346983'),
(221, 221, 'The Crabbys', 'crabbys.info@gmail.com', '085738737371', 'dsadsa', '-7.746497', '110.346983'),
(222, 222, 'The Crabbys', 'crabbys.info@gmail.com', '085738737371', 'Kos warna krem pagar warna hitam kamar no.3', '-7.746497', '110.346983'),
(223, 223, 'The Crabbys', 'crabbys.info@gmail.com', '085738737371', 'dsads', '-7.746497', '110.346983'),
(224, 224, 'The Crabbys', 'crabbys.info@gmail.com', '085738737371', 'dsads', '-7.746497', '110.346983'),
(225, 225, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'Hshajaj', '-7.746514', '110.346945'),
(228, 228, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'Cssff', '-7.746514', '110.346945'),
(229, 229, 'Condro Kusumo', 'candrak60@gmail.com', '08216172829677', 'Ngak usah dikirim', '-7.75037', '110.353837'),
(230, 230, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'fgvhfghfg', '-7.746514', '110.346945'),
(231, 231, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'dfgdfg', '-7.746514', '110.346945'),
(232, 232, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'dsadsa', '-7.599726', '110.427361'),
(233, 233, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'dsadsa', '-7.746514', '110.346945'),
(234, 234, 'Dwi Lutfiana', 'dwilutfiana7@gmail.com', '08212673218', 'kampus uty ruang h31', '-7.747521', '110.35522'),
(235, 235, 'Aziiza Yuda Yahya', 'yudayahya7@gmail.com', '081615407084', 'Kos warna krem kamar no 3', '-7.746514', '110.346945');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_varian_saus`
--

CREATE TABLE `tabel_varian_saus` (
  `varian_id` int(11) NOT NULL,
  `nama_varian` varchar(70) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `in_stock` int(11) NOT NULL COMMENT '1=in stock'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_varian_saus`
--

INSERT INTO `tabel_varian_saus` (`varian_id`, `nama_varian`, `harga`, `in_stock`) VALUES
(1, '- Tanpa Saus -', 0, 1),
(9, 'The Crabbys Secret Sauce', 0, 0),
(11, 'Black Pepper Sauce', 0, 1),
(12, 'Sauce Goreng Mentega', 0, 1),
(13, 'Balado Sauce', 0, 0),
(14, 'Tiram Sauce', 0, 1),
(15, 'Goreng Bawang Putih', 0, 1),
(16, 'Salted Egg (+10K)', 10000, 0),
(17, 'Creamy Cheese Sauce (+10K)', 10000, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_admin`
--
ALTER TABLE `tabel_admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `tabel_admin_access_menu`
--
ALTER TABLE `tabel_admin_access_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `tabel_admin_role`
--
ALTER TABLE `tabel_admin_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_banner`
--
ALTER TABLE `tabel_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_kategori`
--
ALTER TABLE `tabel_kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `tabel_kupon`
--
ALTER TABLE `tabel_kupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_kupon_used`
--
ALTER TABLE `tabel_kupon_used`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kupon` (`id_kupon`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_member` (`id_member`);

--
-- Indexes for table `tabel_kupon_user`
--
ALTER TABLE `tabel_kupon_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kupon` (`id_kupon`);

--
-- Indexes for table `tabel_member`
--
ALTER TABLE `tabel_member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `tabel_member_token`
--
ALTER TABLE `tabel_member_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_menu_admin`
--
ALTER TABLE `tabel_menu_admin`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `tabel_message`
--
ALTER TABLE `tabel_message`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `tabel_produk`
--
ALTER TABLE `tabel_produk`
  ADD PRIMARY KEY (`produk_id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indexes for table `tabel_transaksi`
--
ALTER TABLE `tabel_transaksi`
  ADD PRIMARY KEY (`transaksi_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `tabel_transaksi_detail`
--
ALTER TABLE `tabel_transaksi_detail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `transaksi_id` (`transaksi_id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indexes for table `tabel_transaksi_detail_billing`
--
ALTER TABLE `tabel_transaksi_detail_billing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- Indexes for table `tabel_varian_saus`
--
ALTER TABLE `tabel_varian_saus`
  ADD PRIMARY KEY (`varian_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_admin`
--
ALTER TABLE `tabel_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tabel_admin_access_menu`
--
ALTER TABLE `tabel_admin_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tabel_admin_role`
--
ALTER TABLE `tabel_admin_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tabel_banner`
--
ALTER TABLE `tabel_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tabel_kategori`
--
ALTER TABLE `tabel_kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tabel_kupon`
--
ALTER TABLE `tabel_kupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tabel_kupon_used`
--
ALTER TABLE `tabel_kupon_used`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tabel_kupon_user`
--
ALTER TABLE `tabel_kupon_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tabel_member`
--
ALTER TABLE `tabel_member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `tabel_member_token`
--
ALTER TABLE `tabel_member_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tabel_menu_admin`
--
ALTER TABLE `tabel_menu_admin`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tabel_message`
--
ALTER TABLE `tabel_message`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `tabel_produk`
--
ALTER TABLE `tabel_produk`
  MODIFY `produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `tabel_transaksi`
--
ALTER TABLE `tabel_transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;

--
-- AUTO_INCREMENT for table `tabel_transaksi_detail`
--
ALTER TABLE `tabel_transaksi_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=304;

--
-- AUTO_INCREMENT for table `tabel_transaksi_detail_billing`
--
ALTER TABLE `tabel_transaksi_detail_billing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;

--
-- AUTO_INCREMENT for table `tabel_varian_saus`
--
ALTER TABLE `tabel_varian_saus`
  MODIFY `varian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tabel_admin`
--
ALTER TABLE `tabel_admin`
  ADD CONSTRAINT `tabel_admin_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tabel_admin_role` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tabel_admin_access_menu`
--
ALTER TABLE `tabel_admin_access_menu`
  ADD CONSTRAINT `tabel_admin_access_menu_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tabel_admin_role` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tabel_admin_access_menu_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `tabel_menu_admin` (`menu_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tabel_kupon_used`
--
ALTER TABLE `tabel_kupon_used`
  ADD CONSTRAINT `tabel_kupon_used_ibfk_1` FOREIGN KEY (`id_kupon`) REFERENCES `tabel_kupon` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tabel_kupon_used_ibfk_2` FOREIGN KEY (`id_transaksi`) REFERENCES `tabel_transaksi` (`transaksi_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tabel_kupon_used_ibfk_3` FOREIGN KEY (`id_member`) REFERENCES `tabel_member` (`member_id`) ON DELETE CASCADE;

--
-- Constraints for table `tabel_kupon_user`
--
ALTER TABLE `tabel_kupon_user`
  ADD CONSTRAINT `tabel_kupon_user_ibfk_1` FOREIGN KEY (`id_kupon`) REFERENCES `tabel_kupon` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tabel_produk`
--
ALTER TABLE `tabel_produk`
  ADD CONSTRAINT `tabel_produk_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `tabel_kategori` (`kategori_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tabel_transaksi`
--
ALTER TABLE `tabel_transaksi`
  ADD CONSTRAINT `tabel_transaksi_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `tabel_member` (`member_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tabel_transaksi_detail`
--
ALTER TABLE `tabel_transaksi_detail`
  ADD CONSTRAINT `tabel_transaksi_detail_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `tabel_transaksi` (`transaksi_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tabel_transaksi_detail_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `tabel_produk` (`produk_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tabel_transaksi_detail_billing`
--
ALTER TABLE `tabel_transaksi_detail_billing`
  ADD CONSTRAINT `tabel_transaksi_detail_billing_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `tabel_transaksi` (`transaksi_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
