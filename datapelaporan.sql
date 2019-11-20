-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 03, 2019 at 12:51 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datapelaporan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

DROP TABLE IF EXISTS `barang`;
CREATE TABLE IF NOT EXISTS `barang` (
  `id_barang` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_barang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_jual` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `foto_barang`, `stock_barang`, `kategori_barang`, `harga_jual`, `created_at`, `updated_at`) VALUES
('c4e05208-c8b4-4610-91d0-1d0ec52f6bce', 'tes1', NULL, '59', '9f67f5c0-9d4c-4e1e-97d7-1b4b25139415', '10000', '2019-10-13 03:48:19', '2019-10-13 03:48:19'),
('924e4a9c-14d4-4730-a864-6083a472b602', 'AL HARAMAIN AMBER15 ML', '1570198823.jpg', '3284', '17fd4fb6-f7ca-47f0-87e1-60e3955560dc', '2500', '2019-10-04 14:20:23', '2019-10-04 14:20:23'),
('b2a4ebc8-0700-499e-a2d2-35022d638298', 'AL HARAMAIN BADAR15 ML', '1570198859.jpg', '0', '17fd4fb6-f7ca-47f0-87e1-60e3955560dc', '1000', '2019-10-04 14:21:00', '2019-10-04 14:21:00'),
('a98d20cb-c07f-4cce-9976-afe00533e108', 'handuk', NULL, '0', '686515bc-32a3-408c-ae4c-031d7c2a8d0b', '100000', '2019-10-27 04:43:46', '2019-10-27 09:31:22'),
('265dab0a-b074-4192-980d-ecbe7371c83e', 'Parfum', '2019-10-27,055834.jpg', '40', '9f67f5c0-9d4c-4e1e-97d7-1b4b25139415', '40000', '2019-10-26 22:58:35', '2019-10-27 09:31:11');

-- --------------------------------------------------------

--
-- Table structure for table `barang_order`
--

DROP TABLE IF EXISTS `barang_order`;
CREATE TABLE IF NOT EXISTS `barang_order` (
  `id_barang_order` int(36) NOT NULL AUTO_INCREMENT,
  `id_reseller` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_order` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_barang` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` int(11) NOT NULL,
  `stock_berkurang` int(11) DEFAULT NULL,
  `note_order` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_barang_order`)
) ENGINE=MyISAM AUTO_INCREMENT=193 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang_order`
--

INSERT INTO `barang_order` (`id_barang_order`, `id_reseller`, `id_order`, `id_barang`, `subtotal`, `stock_berkurang`, `note_order`, `created_at`, `updated_at`) VALUES
(192, '1', '03112019-173439', '924e4a9c-14d4-4730-a864-6083a472b602', 7500, 3, 'packing rapih', '2019-11-03 10:34:39', '2019-11-03 10:34:39'),
(191, '1', '03112019-173402', 'c4e05208-c8b4-4610-91d0-1d0ec52f6bce', 10000, 1, NULL, '2019-11-03 10:34:02', '2019-11-03 10:34:02'),
(190, '1', '03112019-173402', 'a98d20cb-c07f-4cce-9976-afe00533e108', 150000, 2, 'Potongan diskon', '2019-11-03 10:34:02', '2019-11-03 10:34:02');

--
-- Triggers `barang_order`
--
DROP TRIGGER IF EXISTS `stok`;
DELIMITER $$
CREATE TRIGGER `stok` AFTER INSERT ON `barang_order` FOR EACH ROW BEGIN
	UPDATE barang SET stock_barang = stock_barang - NEW.stock_berkurang
    where id_barang = NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id_customer` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_customer` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_customer` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon_customer` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_customer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelurahan_customer` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan_customer` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota_customer` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provinsi_customer` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kodepos_customer` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `kode_customer`, `nama_customer`, `telepon_customer`, `alamat_customer`, `kelurahan_customer`, `kecamatan_customer`, `kota_customer`, `provinsi_customer`, `kodepos_customer`, `created_at`, `updated_at`) VALUES
('a06dc782-1362-414c-bdd7-d356c2b94a06', 'CUS-0000000003', 'Customer 2', '089544221122', 'Jl customer 2 no 2 rt2 rw 2', 'padang', 'siantar', 'trengalek', 'sulawesi tengah', 14422, '2019-11-03 12:36:23', '2019-11-03 12:36:23'),
('d914632c-ce51-44cf-97ce-92c52f1cdcd0', 'CUS-0000000001', 'Data Reserved', '081294572272', 'Alamat Reserved', 'reserved', 'reserved', 'reserved', 'jawa barat', 141412, '2019-10-26 22:59:03', '2019-10-26 22:59:03'),
('c24ed1a7-d9dc-4d88-b973-9217578cb385', 'CUS-0000000002', 'tester', '081294572222', 'Jalan perumahan rt 2 rw 1', 'cikapundung', 'sidoarja', 'tangerang', 'jawa tengah', 12211, '2019-11-02 01:13:34', '2019-11-02 01:13:34');

-- --------------------------------------------------------

--
-- Table structure for table `ecommerce`
--

DROP TABLE IF EXISTS `ecommerce`;
CREATE TABLE IF NOT EXISTS `ecommerce` (
  `id_ecommerce` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_ecommerce` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_ecommerce` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_ecommerce`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ecommerce`
--

INSERT INTO `ecommerce` (`id_ecommerce`, `kode_ecommerce`, `nama_ecommerce`, `created_at`, `updated_at`) VALUES
('260181ca-6501-4ae6-9044-b149ec20eb6d', 'ECO-01', 'Bukalapak', '2019-09-28 02:39:59', '2019-09-28 02:39:59'),
('8f781715-2c8b-412f-b288-8b058306c621', 'ECO-02', 'Shopee', '2019-09-28 05:57:28', '2019-09-28 05:57:28'),
('643c56ef-3f40-4e85-a7a0-84bb5c28714e', 'ECO-03', 'Tokopedia', '2019-09-28 05:57:35', '2019-09-28 05:57:35'),
('2bf7bcb7-29f7-495e-8179-cac4cbf54199', 'ECO-04', 'Lazada', '2019-10-26 22:51:51', '2019-10-26 22:51:51'),
('d93c537a-9b26-438f-bb34-d2cc01f1282b', 'ECO-05', 'Ebay', '2019-10-26 23:00:19', '2019-10-26 23:00:19');

-- --------------------------------------------------------

--
-- Table structure for table `expedisi`
--

DROP TABLE IF EXISTS `expedisi`;
CREATE TABLE IF NOT EXISTS `expedisi` (
  `id_expedisi` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_expedisi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_expedisi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_expedisi`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expedisi`
--

INSERT INTO `expedisi` (`id_expedisi`, `kode_expedisi`, `nama_expedisi`, `created_at`, `updated_at`) VALUES
('00c79b07-096c-4ace-b4e4-8d47ccaadb45', 'EX-006', 'Paxel', '2019-10-26 23:00:01', '2019-10-26 23:00:01'),
('47d70b36-22b8-42e0-8461-38365ac8aaaf', 'EX-005', 'Anteriaja', '2019-10-26 22:51:38', '2019-10-26 22:51:38'),
('2616af9e-8fed-40cf-b21b-a76aecd6e726', 'EX-003', 'SiCepat', '2019-09-28 02:16:40', '2019-09-28 02:16:40'),
('c9ddfc7a-e6a0-43b9-9b10-9ace9dd26c91', 'EX-004', 'Wahana Logistik', '2019-09-28 02:16:46', '2019-09-28 02:23:15'),
('92e50631-eedc-4ed5-a9b2-d1a8a39c42a3', 'EX-001', 'J&T', '2019-09-28 02:16:30', '2019-09-28 02:22:59'),
('d4e4ab96-454a-4c0b-be35-0675731e071d', 'EX-002', 'GO-SEND', '2019-09-28 02:16:35', '2019-09-28 02:16:35');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
('9f67f5c0-9d4c-4e1e-97d7-1b4b25139415', 'Al Rehab 6ml', '2019-10-03 14:11:12', '2019-10-04 13:48:59'),
('17fd4fb6-f7ca-47f0-87e1-60e3955560dc', 'Perkakas', '2019-10-04 13:12:45', '2019-10-06 03:14:25'),
('686515bc-32a3-408c-ae4c-031d7c2a8d0b', 'Kebutuhan rumah tangga', '2019-10-04 13:13:06', '2019-10-04 13:49:27'),
('e612d313-b0a7-498c-9717-a3add580153d', 'Al Haramain 10ml', '2019-10-04 13:13:22', '2019-10-04 13:49:41');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(10, '2019_09_24_125653_bikin_tabel_ecommerce', 2),
(11, '2019_09_25_123910_bikin_table_expedisi', 2),
(12, '2019_09_26_123140_bikin_table_customer', 2),
(15, '2019_10_01_200400_bikin_table_vendor', 3),
(16, '2019_10_03_194240_bikin_table_kategori', 4),
(17, '2019_10_04_200407_bikin_table_barang', 5),
(18, '2019_10_06_195945_bikin_table_order', 6),
(19, '2019_10_07_200048_bikin_table_barang_order', 6);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id_order` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_order` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reseller_order` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengirim_order` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon_order` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ecommerce_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expedisi_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ongkir_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resiotomatis_order` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id_order`, `tanggal_order`, `reseller_order`, `pengirim_order`, `telepon_order`, `ecommerce_order`, `expedisi_order`, `ongkir_order`, `total_order`, `customer_order`, `resiotomatis_order`, `created_at`, `updated_at`) VALUES
('03112019-173439', 'Sun,03-Nov-2019', '1', NULL, NULL, '260181ca-6501-4ae6-9044-b149ec20eb6d', '00c79b07-096c-4ace-b4e4-8d47ccaadb45', '15000', '22500', 'c24ed1a7-d9dc-4d88-b973-9217578cb385', NULL, '2019-11-03 10:34:39', '2019-11-03 10:34:39'),
('03112019-173402', 'Sun,03-Nov-2019', '1', NULL, NULL, '260181ca-6501-4ae6-9044-b149ec20eb6d', '47d70b36-22b8-42e0-8461-38365ac8aaaf', '1111', '161111', 'd914632c-ce51-44cf-97ce-92c52f1cdcd0', NULL, '2019-11-03 10:34:02', '2019-11-03 10:34:02');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `totalharga_order`
--

DROP TABLE IF EXISTS `totalharga_order`;
CREATE TABLE IF NOT EXISTS `totalharga_order` (
  `id_totalharga` int(11) NOT NULL AUTO_INCREMENT,
  `id_order` varchar(255) NOT NULL,
  `id` bigint(20) NOT NULL,
  `totalharga` varchar(255) NOT NULL,
  PRIMARY KEY (`id_totalharga`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_akun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('admin','reseller','gudang') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `telepon`, `email_verified_at`, `password`, `foto`, `nama_akun`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@bwa.id', '082211', NULL, '$2y$10$U6FwktczBDgZdC.wV8GR7eCdSdmfcHasBKTkfFsF6MoZ/i5HXKsJO', NULL, 'admin', 'admin', 'EcAcMR68EMbNLYla1MRkTV537uhJ08laTfOPnwEXGgVUg8pvYh6kpAWrNlc6', '2019-09-17 05:46:27', '2019-09-29 14:07:55'),
(10, 'Chaerunnisa', 'chaerunnisa@bwa.id', '0812939393', NULL, '$2y$10$J9L10UA54ApTrT2KuHzz7ej9tEYYx8pQQKFLUqIiJcfYkSW8g.TEW', '1569762906-sizecooporatepersonal4-02.jpg', 'OliShop', 'reseller', NULL, '2019-09-29 01:17:39', '2019-09-29 06:18:23'),
(12, 'Dini Damayanti', 'dini.damayanti@bwa.id', '0899122211', NULL, '$2y$10$GVTBe/70Iv1cBNxCpwEwe.ty96R3z6.i8SfprmMSXhkvnv9O1FRiG', '2019-09-29,203415.png', 'Berkah Ramadhan', 'gudang', NULL, '2019-09-29 06:23:31', '2019-09-29 13:34:15'),
(14, 'Diki', 'diki@gmail.com', '0822111122', NULL, '$2y$10$AuDP22WZeKkLrEM/MvaAde1ZRBbQuh5ZhpUYB6en8NfmjovcdwguS', NULL, 'WangiShop', 'reseller', NULL, '2019-10-26 23:00:56', '2019-10-26 23:00:56');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

DROP TABLE IF EXISTS `vendor`;
CREATE TABLE IF NOT EXISTS `vendor` (
  `id_vendor` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_vendor` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon_vendor` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_vendor` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_barang` int(255) NOT NULL,
  `harga_jual` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_vendor`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id_vendor`, `nama_vendor`, `telepon_vendor`, `alamat_vendor`, `nama_barang`, `jumlah_barang`, `harga_jual`, `harga_beli`, `from`, `created_at`, `updated_at`) VALUES
('5f79c45b-726b-4bc2-8bcd-99162bc4c514', 'Toko Sebelah', '0812221111', 'Jalan sumedang raya km 20. rt 2 rw 01 bandung selatan', 'Parfum', 100, '220.000', '120.000', 'vendor', '2019-10-02 14:16:20', '2019-10-02 14:16:20'),
('43f086aa-60a0-44e8-9c93-dfb2762b9eca', 'Minyakwangiselalu', '08882211122', 'Jalan sumedang raya km 20. rt 2 rw 01 bandung selatan', 'Minyak wangi', 10, '20.100', '20.000', 'vendor', '2019-10-26 22:59:47', '2019-10-26 22:59:47');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
