-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2022 at 02:28 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resto`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktiva`
--

CREATE TABLE `aktiva` (
  `id_aktiva` int(11) NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `id_kelompok` int(11) NOT NULL,
  `barang` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `debit_aktiva` double NOT NULL,
  `kredit_aktiva` double NOT NULL,
  `nota` varchar(100) NOT NULL,
  `b_penyusutan` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ctt_driver`
--

CREATE TABLE `ctt_driver` (
  `id_driver` int(11) NOT NULL,
  `no_order` varchar(50) NOT NULL,
  `nm_driver` varchar(100) NOT NULL,
  `nominal` double NOT NULL,
  `tgl` date NOT NULL,
  `admin` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ctt_driver`
--

INSERT INTO `ctt_driver` (`id_driver`, `no_order`, `nm_driver`, `nominal`, `tgl`, `admin`, `created_at`, `updated_at`) VALUES
(1, 'TDe-2203030001', 'Mas Ari', 30000, '2022-03-03', 'Mas Ari', '2022-03-03 02:58:04', '2022-03-03 02:58:04'),
(2, 'TDe-2203030002', 'Budi Rahmat', 30000, '2022-03-03', 'Mas Ari', '2022-03-03 03:02:13', '2022-03-03 03:02:13'),
(3, 'TDe-2203030003', 'Mas Ari', 30000, '2022-03-03', 'Mas Ari', '2022-03-03 03:17:42', '2022-03-03 03:17:42'),
(4, 'TDe-2203240001', 'Mas Ari', 30000, '2022-03-24', 'Aldi', '2022-03-24 07:54:22', '2022-03-24 07:54:22'),
(5, 'TDe-2203240002', 'Mas Ari', 30000, '2022-03-24', 'Aldi', '2022-03-24 07:54:39', '2022-03-24 07:54:39'),
(6, 'TDe-2203240003', 'Mas Ari', 30000, '2022-03-24', 'Aldi', '2022-03-24 07:54:45', '2022-03-24 07:54:45'),
(7, 'TDe-2203240004', 'Mas Ari', 30000, '2022-03-24', 'Aldi', '2022-03-24 07:58:44', '2022-03-24 07:58:44'),
(8, 'TDe-2203240005', 'Mas Ari', 30000, '2022-03-24', 'Aldi', '2022-03-24 08:32:48', '2022-03-24 08:32:48'),
(9, 'TDe-2203240006', 'Mas Ari', 30000, '2022-03-24', 'Aldi', '2022-03-24 08:39:27', '2022-03-24 08:39:27'),
(10, 'TDe-2203240007', 'Mas Ari', 30000, '2022-03-24', 'Aldi', '2022-03-24 08:44:07', '2022-03-24 08:44:07'),
(11, 'TDe-2203240008', 'Mas Ari', 30000, '2022-03-24', 'Aldi', '2022-03-24 08:49:04', '2022-03-24 08:49:04'),
(12, 'TDe-2203250001', 'Wawan', 30000, '2022-03-25', 'Aldi', '2022-03-25 00:19:50', '2022-03-25 00:19:50'),
(13, 'TDe-2203250002', 'Mas Ari', 30000, '2022-03-25', 'Aldi', '2022-03-25 00:38:47', '2022-03-25 00:38:47'),
(14, 'TDe-2203250003', 'Mas Ari', 30000, '2022-03-25', 'Aldi', '2022-03-25 00:51:46', '2022-03-25 00:51:46'),
(15, 'TDe-2203250001', 'Mas Ari', 30000, '2022-03-25', 'Aldi', '2022-03-25 01:59:06', '2022-03-25 01:59:06'),
(16, 'TDe-2203250002', 'Mas Ari', 30000, '2022-03-25', 'Aldi', '2022-03-25 02:02:45', '2022-03-25 02:02:45'),
(17, 'TDe-2203250003', 'Mas Ari', 30000, '2022-03-25', 'Aldi', '2022-03-25 02:32:54', '2022-03-25 02:32:54'),
(18, 'TDe-2203250001', 'Wawan', 30000, '2022-03-25', 'Aldi', '2022-03-25 07:18:44', '2022-03-25 07:18:44'),
(19, 'TDe-2203250002', 'Mas Ari', 30000, '2022-03-25', 'Aldi', '2022-03-25 07:38:06', '2022-03-25 07:38:06'),
(20, 'TDe-2203250003', 'Mas Ari', 30000, '2022-03-25', 'Aldi', '2022-03-25 07:45:56', '2022-03-25 07:45:56'),
(21, 'TDe-2203260001', 'Mas Ari', 30000, '2022-03-26', 'Aldi', '2022-03-26 05:25:08', '2022-03-26 05:25:08'),
(22, 'TDe-2203260002', 'Mas Ari', 30000, '2022-03-26', 'Aldi', '2022-03-26 05:39:57', '2022-03-26 05:39:57'),
(23, 'TDe-2203260003', 'Mas Ari', 30000, '2022-03-26', 'Aldi', '2022-03-26 05:41:00', '2022-03-26 05:41:00'),
(24, 'TDe-2203260004', 'Mas Ari', 30000, '2022-03-26', 'Aldi', '2022-03-26 05:41:34', '2022-03-26 05:41:34'),
(25, 'TDe-2203260005', 'Mas Ari', 30000, '2022-03-26', 'Aldi', '2022-03-26 05:41:40', '2022-03-26 05:41:40'),
(26, 'TDe-2203260006', 'Wawan', 30000, '2022-03-26', 'Aldi', '2022-03-26 05:42:22', '2022-03-26 05:42:22'),
(27, 'TDe-2203260007', 'Wawan', 30000, '2022-03-26', 'Aldi', '2022-03-26 05:45:49', '2022-03-26 05:45:49'),
(28, 'TDe-2203260008', 'Mas Ari', 30000, '2022-03-26', 'Aldi', '2022-03-26 05:50:07', '2022-03-26 05:50:07'),
(29, 'TDe-2203260009', 'Mas Ari', 30000, '2022-03-26', 'Aldi', '2022-03-26 05:51:22', '2022-03-26 05:51:22'),
(30, 'SDe-2203260001', 'Fazar', 30000, '2022-03-26', 'Aldi', '2022-03-26 05:53:55', '2022-03-26 05:53:55'),
(31, 'SDe-2203260002', 'Fazar', 30000, '2022-03-26', 'Aldi', '2022-03-26 05:55:08', '2022-03-26 05:55:08'),
(32, 'SDe-2203260003', 'Fazar', 30000, '2022-03-26', 'Aldi', '2022-03-26 05:55:52', '2022-03-26 05:55:52'),
(33, 'SDe-2203260004', 'Gunawan', 30000, '2022-03-26', 'Aldi', '2022-03-26 05:56:46', '2022-03-26 05:56:46'),
(34, 'SDe-2203260005', 'Gunawan', 30000, '2022-03-26', 'Aldi', '2022-03-26 05:58:04', '2022-03-26 05:58:04'),
(35, 'TDe-2203260010', 'Mas Ari', 30000, '2022-03-26', 'Aldi', '2022-03-26 06:06:23', '2022-03-26 06:06:23');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `homes`
--

CREATE TABLE `homes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keterangan_cuci`
--

CREATE TABLE `keterangan_cuci` (
  `id_ket` int(11) NOT NULL,
  `ket` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keterangan_cuci`
--

INSERT INTO `keterangan_cuci` (`id_ket`, `ket`) VALUES
(1, 'Clear Up'),
(2, 'Cuci'),
(3, 'Masak'),
(4, 'Prepare');

-- --------------------------------------------------------

--
-- Stand-in structure for view `menu1`
-- (See below for the actual view)
--
CREATE TABLE `menu1` (
`nm_menu` varchar(120)
,`nm_meja` varchar(20)
,`id_order` int(11)
,`no_order` varchar(20)
,`id_harga` int(11)
,`qty` double
,`harga` double
,`request` varchar(100)
,`tambahan` int(11)
,`page` int(11)
,`id_meja` int(11)
,`selesai` enum('dimasak','selesai','diantar')
,`id_lokasi` int(11)
,`pengantar` varchar(20)
,`tgl` date
,`admin` varchar(20)
,`void` int(11)
,`round` double
,`alasan` varchar(40)
,`nm_void` varchar(100)
,`j_mulai` datetime
,`j_selesai` datetime
,`diskon` double
,`wait` datetime
,`aktif` int(11)
,`id_koki1` int(11)
,`id_koki2` int(11)
,`id_koki3` int(11)
,`ongkir` double
,`id_distribusi` int(11)
,`orang` double
,`no_checker` enum('T','Y')
,`print` enum('T','Y')
,`copy_print` enum('T','Y')
,`created_at` timestamp
,`updated_at` timestamp
,`selisih` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `menu2`
-- (See below for the actual view)
--
CREATE TABLE `menu2` (
`nm_menu` varchar(120)
,`nm_meja` varchar(20)
,`id_order` int(11)
,`no_order` varchar(20)
,`id_harga` int(11)
,`qty` double
,`harga` double
,`request` varchar(100)
,`tambahan` int(11)
,`page` int(11)
,`id_meja` int(11)
,`selesai` enum('dimasak','selesai','diantar')
,`id_lokasi` int(11)
,`pengantar` varchar(20)
,`tgl` date
,`admin` varchar(20)
,`void` int(11)
,`round` double
,`alasan` varchar(40)
,`nm_void` varchar(100)
,`j_mulai` datetime
,`j_selesai` datetime
,`diskon` double
,`wait` datetime
,`aktif` int(11)
,`id_koki1` int(11)
,`id_koki2` int(11)
,`id_koki3` int(11)
,`ongkir` double
,`id_distribusi` int(11)
,`orang` double
,`no_checker` enum('T','Y')
,`print` enum('T','Y')
,`copy_print` enum('T','Y')
,`created_at` timestamp
,`updated_at` timestamp
,`selisih` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(12, '2014_10_12_000000_create_users_table', 1),
(13, '2014_10_12_100000_create_password_resets_table', 1),
(14, '2019_08_19_000000_create_failed_jobs_table', 1),
(15, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(16, '2022_02_03_023812_create_homes_table', 1),
(17, '2022_02_03_031426_create_orders_table', 1),
(18, '2022_02_03_060853_create_menus_table', 2),
(19, '2022_02_09_001143_create_users', 3),
(20, '2022_02_09_003849_create_user_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id_order` int(10) UNSIGNED NOT NULL,
  `no_order` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_harga` int(11) NOT NULL,
  `qty` double NOT NULL,
  `harga` double NOT NULL,
  `request` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tambahan` int(11) NOT NULL,
  `page` int(11) NOT NULL,
  `id_meja` int(11) NOT NULL,
  `selesai` enum('dimasak','selesai','diantar') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `pengantar` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl` date NOT NULL,
  `alasan` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_void` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `j_mulai` datetime NOT NULL,
  `j_selesai` datetime NOT NULL,
  `diskon` double NOT NULL,
  `wait` datetime NOT NULL,
  `aktif` int(11) NOT NULL,
  `id_koki1` int(11) NOT NULL,
  `id_koki2` int(11) NOT NULL,
  `id_koki3` int(11) NOT NULL,
  `ongkir` double NOT NULL,
  `id_distribusi` int(11) NOT NULL,
  `orang` double NOT NULL,
  `no_checker` enum('T','Y') COLLATE utf8mb4_unicode_ci NOT NULL,
  `print` enum('T','Y') COLLATE utf8mb4_unicode_ci NOT NULL,
  `copy_print` enum('T','Y') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `status`) VALUES
(1, 'M'),
(2, 'OFF'),
(3, 'E'),
(4, 'SP');

-- --------------------------------------------------------

--
-- Table structure for table `tb_absen`
--

CREATE TABLE `tb_absen` (
  `id_absen` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `tgl` date NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_absen`
--

INSERT INTO `tb_absen` (`id_absen`, `id_karyawan`, `status`, `tgl`, `id_lokasi`, `created_at`, `updated_at`) VALUES
(2, 1, 'M', '2022-03-01', 1, '2022-03-06 16:27:35', '2022-03-06 16:27:35'),
(5, 2, 'M', '2022-03-01', 1, '2022-03-06 16:33:14', '2022-03-06 16:33:14'),
(6, 3, 'M', '2022-03-01', 1, '2022-03-06 16:33:15', '2022-03-06 16:33:15'),
(7, 96, 'M', '2022-03-01', 1, '2022-03-06 16:33:18', '2022-03-06 16:33:18'),
(8, 25, 'M', '2022-03-01', 1, '2022-03-06 16:33:19', '2022-03-06 16:33:19'),
(9, 24, 'M', '2022-03-01', 1, '2022-03-06 16:33:20', '2022-03-06 16:33:20'),
(10, 6, 'M', '2022-03-01', 2, '2022-03-06 16:34:25', '2022-03-06 16:34:25'),
(11, 5, 'M', '2022-03-01', 2, '2022-03-06 16:34:26', '2022-03-06 16:34:26'),
(12, 4, 'M', '2022-03-01', 2, '2022-03-06 16:34:30', '2022-03-06 16:34:30'),
(13, 7, 'M', '2022-03-01', 2, '2022-03-06 16:34:43', '2022-03-06 16:34:43'),
(14, 1, 'M', '2022-03-07', 1, '2022-03-06 16:35:55', '2022-03-06 16:35:55'),
(15, 2, 'M', '2022-03-07', 1, '2022-03-06 16:35:56', '2022-03-06 16:35:56'),
(16, 3, 'M', '2022-03-07', 1, '2022-03-06 16:35:57', '2022-03-06 16:35:57'),
(17, 6, 'M', '2022-03-07', 2, '2022-03-06 16:36:08', '2022-03-06 16:36:08'),
(18, 5, 'M', '2022-03-07', 2, '2022-03-06 16:36:09', '2022-03-06 16:36:09'),
(19, 4, 'M', '2022-03-07', 2, '2022-03-06 16:36:10', '2022-03-06 16:36:10'),
(20, 1, 'M', '2022-03-08', 1, '2022-03-07 19:55:36', '2022-03-07 19:55:36'),
(21, 2, 'M', '2022-03-08', 1, '2022-03-07 19:55:37', '2022-03-07 19:55:37'),
(22, 3, 'M', '2022-03-08', 1, '2022-03-07 19:55:37', '2022-03-07 19:55:37'),
(23, 96, 'M', '2022-03-08', 1, '2022-03-07 19:55:39', '2022-03-07 19:55:39'),
(24, 25, 'M', '2022-03-08', 1, '2022-03-07 19:55:40', '2022-03-07 19:55:40'),
(25, 4, 'M', '2022-03-08', 1, '2022-03-07 21:24:54', '2022-03-07 21:24:54'),
(28, 5, 'M', '2022-03-08', 2, '2022-03-07 22:17:00', '2022-03-07 22:17:00'),
(29, 6, 'M', '2022-03-08', 2, '2022-03-07 22:17:02', '2022-03-07 22:17:02'),
(30, 24, 'M', '2022-03-08', 2, '2022-03-07 22:17:17', '2022-03-07 22:17:17'),
(31, 22, 'M', '2022-03-08', 2, '2022-03-07 22:17:17', '2022-03-07 22:17:17'),
(32, 1, 'M', '2022-03-09', 1, '2022-03-09 00:46:35', '2022-03-09 00:46:35'),
(33, 2, 'M', '2022-03-09', 1, '2022-03-09 00:46:36', '2022-03-09 00:46:36'),
(34, 3, 'M', '2022-03-09', 1, '2022-03-09 00:46:37', '2022-03-09 00:46:37'),
(35, 96, 'M', '2022-03-09', 1, '2022-03-09 00:46:39', '2022-03-09 00:46:39'),
(36, 25, 'M', '2022-03-09', 1, '2022-03-09 00:46:40', '2022-03-09 00:46:40'),
(37, 24, 'M', '2022-03-09', 1, '2022-03-09 00:46:41', '2022-03-09 00:46:41'),
(38, 1, 'M', '2022-03-22', 1, '2022-03-22 06:18:59', '2022-03-22 06:18:59'),
(39, 2, 'M', '2022-03-22', 1, '2022-03-22 06:19:00', '2022-03-22 06:19:00'),
(40, 3, 'M', '2022-03-22', 1, '2022-03-22 06:19:03', '2022-03-22 06:19:03'),
(41, 96, 'M', '2022-03-22', 1, '2022-03-22 06:19:12', '2022-03-22 06:19:12'),
(42, 25, 'M', '2022-03-22', 1, '2022-03-22 06:19:13', '2022-03-22 06:19:13'),
(43, 24, 'M', '2022-03-22', 1, '2022-03-22 06:19:14', '2022-03-22 06:19:14'),
(44, 1, 'M', '2022-03-24', 1, '2022-03-23 23:51:11', '2022-03-23 23:51:11'),
(45, 2, 'M', '2022-03-24', 1, '2022-03-23 23:51:12', '2022-03-23 23:51:12'),
(46, 3, 'M', '2022-03-24', 1, '2022-03-23 23:51:14', '2022-03-23 23:51:14'),
(47, 24, 'M', '2022-03-24', 1, '2022-03-23 23:51:16', '2022-03-23 23:51:16'),
(48, 22, 'M', '2022-03-24', 1, '2022-03-23 23:51:18', '2022-03-23 23:51:18'),
(49, 25, 'M', '2022-03-24', 1, '2022-03-23 23:51:31', '2022-03-23 23:51:31'),
(50, 1, 'M', '2022-03-25', 1, '2022-03-25 00:17:42', '2022-03-25 00:17:42'),
(51, 2, 'M', '2022-03-25', 1, '2022-03-25 00:17:43', '2022-03-25 00:17:43'),
(52, 3, 'M', '2022-03-25', 1, '2022-03-25 00:17:44', '2022-03-25 00:17:44'),
(53, 25, 'M', '2022-03-25', 1, '2022-03-25 00:17:47', '2022-03-25 00:17:47'),
(54, 24, 'M', '2022-03-25', 1, '2022-03-25 00:17:48', '2022-03-25 00:17:48'),
(55, 22, 'M', '2022-03-25', 1, '2022-03-25 00:17:52', '2022-03-25 00:17:52'),
(56, 4, 'M', '2022-03-25', 2, '2022-03-25 05:57:17', '2022-03-25 05:57:17'),
(57, 5, 'M', '2022-03-25', 2, '2022-03-25 05:57:17', '2022-03-25 05:57:17'),
(58, 6, 'M', '2022-03-25', 2, '2022-03-25 05:57:19', '2022-03-25 05:57:19'),
(59, 21, 'M', '2022-03-25', 2, '2022-03-25 05:57:21', '2022-03-25 05:57:21'),
(60, 20, 'M', '2022-03-25', 2, '2022-03-25 05:57:21', '2022-03-25 05:57:21'),
(61, 23, 'M', '2022-03-25', 2, '2022-03-25 05:57:23', '2022-03-25 05:57:23'),
(62, 1, 'M', '2022-03-26', 1, '2022-03-25 23:54:29', '2022-03-25 23:54:29'),
(63, 2, 'M', '2022-03-26', 1, '2022-03-25 23:54:30', '2022-03-25 23:54:30'),
(64, 3, 'M', '2022-03-26', 1, '2022-03-25 23:54:32', '2022-03-25 23:54:32'),
(66, 24, 'M', '2022-03-26', 1, '2022-03-25 23:54:35', '2022-03-25 23:54:35'),
(67, 23, 'M', '2022-03-26', 1, '2022-03-25 23:54:37', '2022-03-25 23:54:37'),
(68, 22, 'M', '2022-03-26', 1, '2022-03-25 23:54:38', '2022-03-25 23:54:38'),
(69, 4, 'M', '2022-03-26', 2, '2022-03-26 00:27:07', '2022-03-26 00:27:07'),
(70, 5, 'M', '2022-03-26', 2, '2022-03-26 00:27:08', '2022-03-26 00:27:08'),
(71, 6, 'M', '2022-03-26', 2, '2022-03-26 00:27:08', '2022-03-26 00:27:08'),
(72, 21, 'M', '2022-03-26', 2, '2022-03-26 00:27:10', '2022-03-26 00:27:10'),
(73, 25, 'M', '2022-03-26', 2, '2022-03-26 00:27:21', '2022-03-26 00:27:21'),
(74, 1, 'M', '2022-03-29', 1, '2022-03-29 00:06:51', '2022-03-29 00:06:51'),
(75, 2, 'M', '2022-03-29', 1, '2022-03-29 00:06:52', '2022-03-29 00:06:52'),
(76, 3, 'M', '2022-03-29', 1, '2022-03-29 00:06:54', '2022-03-29 00:06:54'),
(77, 96, 'M', '2022-03-29', 1, '2022-03-29 00:06:55', '2022-03-29 00:06:55'),
(78, 25, 'M', '2022-03-29', 1, '2022-03-29 00:06:56', '2022-03-29 00:06:56'),
(79, 24, 'M', '2022-03-29', 1, '2022-03-29 00:06:57', '2022-03-29 00:06:57');

-- --------------------------------------------------------

--
-- Table structure for table `tb_akun`
--

CREATE TABLE `tb_akun` (
  `id_akun` int(11) NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `kd_akun` varchar(10) NOT NULL,
  `no_akun` varchar(20) NOT NULL,
  `nm_akun` varchar(50) NOT NULL,
  `id_kategori` tinyint(4) NOT NULL,
  `pl` enum('T','Y') NOT NULL,
  `neraca` enum('T','Y') NOT NULL,
  `penyesuaian` enum('T','Y') NOT NULL,
  `neraca_saldo` enum('T','Y') NOT NULL,
  `penutup` enum('T','Y') NOT NULL,
  `ekuitas` enum('T','Y') NOT NULL,
  `aktiva_t` enum('T','Y') NOT NULL,
  `aktiva_l` enum('T','Y') NOT NULL,
  `pendapatan` enum('T','Y') NOT NULL,
  `pengeluaran` enum('T','Y') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_akun`
--

INSERT INTO `tb_akun` (`id_akun`, `id_lokasi`, `kd_akun`, `no_akun`, `nm_akun`, `id_kategori`, `pl`, `neraca`, `penyesuaian`, `neraca_saldo`, `penutup`, `ekuitas`, `aktiva_t`, `aktiva_l`, `pendapatan`, `pengeluaran`, `created_at`, `updated_at`) VALUES
(66, 1, 'BKBC', '1100', 'Bank BCA', 1, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(67, 1, 'BKM', '1101', 'Bank Mandiri', 1, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(68, 1, 'KSTKM', '1102', 'Kas', 1, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-26 03:53:04'),
(69, 1, 'PBC', '1200', 'Piutang BCA', 7, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(70, 1, 'PMD', '1201', 'Piutang Mandiri', 7, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(71, 1, 'PRL', '1300', 'Peralatan', 1, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(72, 1, 'APP', '1301', 'Akumulasi Penyusutan Peralatan', 1, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(73, 1, 'PBD', '1400', 'Persediaan Barang Dagangan', 1, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(74, 1, 'ADP', '1500', 'Atk dan Perlengkapan', 1, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(75, 1, 'HKD', '2001', 'Hutang Kas Dll', 2, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(76, 1, 'PJL', '4001', 'Penjualan', 4, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(77, 1, 'PLL', '4002', 'Pendapatan di Luar Usaha / lain - lain', 4, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 07:46:53'),
(78, 1, 'BPM', '5001', 'Biaya Persediaan Makanan', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(79, 1, 'BGK', '5002', 'Biaya Gaji Karyawan', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(80, 1, 'BL', '5003', 'Biaya Listrik', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(81, 1, 'BPD', '5004', 'Biaya Pdam', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(82, 1, 'BTI', '5005', 'Biaya Telepon dan Internet', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(83, 1, 'BPOA', '5006', 'Biaya Pengiriman dan Ongkos Angkut', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(84, 1, 'BAP', '5007', 'Biaya Atk dan Perlengkapan', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(85, 1, 'BLL', '5008', 'Biaya Lain-Lain', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(86, 1, 'BBTP', '5009', 'Biaya Bensin, tol dan parkir', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(87, 1, 'BA', '5010', 'Biaya Asuransi', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(88, 1, 'BP', '5011', 'Biaya Pajak', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(89, 1, 'BPPB', '5012', 'Biaya Pemeliharaan dan Perbaikan Bangunan', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(90, 1, 'BPPK', '5013', 'Biaya Pemeliharaan dan Perbaikan Kendaraan', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(91, 1, 'BIKK', '5014', 'Biaya Iuran Kebersihan dan Keamanan', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(92, 1, 'BI', '5015', 'Biaya Iklan', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(93, 1, 'BB', '5016', 'Biaya Bpjs', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(94, 1, 'BAB', '5017', 'Biaya Administrasi Bank', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(95, 1, 'BKT', '5018', 'Biaya Kantin', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(96, 1, 'BLPG', '5019', 'Biaya Lpg', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(97, 1, 'BSW', '5020', 'Biaya Sewa', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 02:54:10', '2022-03-24 02:54:10'),
(98, 1, 'PSC', '4003', 'Pendapatan Service Charge', 4, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 05:52:54', '2022-03-24 05:52:54'),
(99, 1, 'BD', '5021', 'Biaya Delivery', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 05:53:45', '2022-03-24 05:53:45'),
(100, 1, 'PPK', '5022', 'Ppn Keluaran', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 05:54:08', '2022-03-24 05:54:08'),
(101, 1, 'HSC', '2002', 'Hutang Service Charge 7%', 2, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 07:08:45', '2022-03-24 07:08:45'),
(102, 1, 'HO', '2003', 'Hutang Ongkir', 2, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 07:09:15', '2022-03-24 07:09:15'),
(103, 1, 'PPD', '2004', 'Pb1 Pajak Daerah 10%', 2, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-24 07:11:33', '2022-03-24 07:11:33'),
(104, 2, 'BKBC', '1100', 'Bank BCA', 1, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(105, 2, 'BKM', '1101', 'Bank Mandiri', 1, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(106, 2, 'KSTKM', '1102', 'Kas', 1, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-26 03:53:13'),
(107, 2, 'PBC', '1200', 'Piutang BCA', 7, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(108, 2, 'PMD', '1201', 'Piutang Mandiri', 7, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(109, 2, 'PRL', '1300', 'Peralatan', 1, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(110, 2, 'APP', '1301', 'Akumulasi Penyusutan Peralatan', 1, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(111, 2, 'PBD', '1400', 'Persediaan Barang Dagangan', 1, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(112, 2, 'ADP', '1500', 'Atk dan Perlengkapan', 1, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(113, 2, 'HKD', '2001', 'Hutang Kas Dll', 2, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(114, 2, 'HSC', '2002', 'Hutang Service Charge 7%', 2, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(115, 2, 'HO', '2003', 'Hutang Ongkir', 2, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(116, 2, 'PPD', '2004', 'Pb1 Pajak Daerah 10%', 2, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(117, 2, 'PJL', '4001', 'Penjualan', 4, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(118, 2, 'PLL', '4002', 'Pendapatan di Luar Usaha / lain - lain', 4, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(119, 2, 'PSC', '4003', 'Pendapatan Service Charge', 4, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(120, 2, 'BPM', '5001', 'Biaya Persediaan Makanan', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(121, 2, 'BGK', '5002', 'Biaya Gaji Karyawan', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(122, 2, 'BL', '5003', 'Biaya Listrik', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(123, 2, 'BPD', '5004', 'Biaya Pdam', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(124, 2, 'BTI', '5005', 'Biaya Telepon dan Internet', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(125, 2, 'BPOA', '5006', 'Biaya Pengiriman dan Ongkos Angkut', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(126, 2, 'BAP', '5007', 'Biaya Atk dan Perlengkapan', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(127, 2, 'BLL', '5008', 'Biaya Lain-Lain', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(128, 2, 'BBTP', '5009', 'Biaya Bensin, tol dan parkir', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(129, 2, 'BA', '5010', 'Biaya Asuransi', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(130, 2, 'BP', '5011', 'Biaya Pajak', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(131, 2, 'BPPB', '5012', 'Biaya Pemeliharaan dan Perbaikan Bangunan', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(132, 2, 'BPPK', '5013', 'Biaya Pemeliharaan dan Perbaikan Kendaraan', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(133, 2, 'BIKK', '5014', 'Biaya Iuran Kebersihan dan Keamanan', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(134, 2, 'BI', '5015', 'Biaya Iklan', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(135, 2, 'BB', '5016', 'Biaya Bpjs', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(136, 2, 'BAB', '5017', 'Biaya Administrasi Bank', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(137, 2, 'BKT', '5018', 'Biaya Kantin', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(138, 2, 'BLPG', '5019', 'Biaya Lpg', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(139, 2, 'BSW', '5020', 'Biaya Sewa', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(140, 2, 'BD', '5021', 'Biaya Delivery', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(141, 2, 'PPK', '5022', 'Ppn Keluaran', 5, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-25 05:49:20', '2022-03-25 05:49:20'),
(143, 1, 'AKT', '1401', 'Aktiva', 1, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-29 01:53:33', '2022-03-29 01:55:24'),
(144, 1, 'APA', '1402', 'Akumulasi Penyusutan Aktiva', 1, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-29 01:55:59', '2022-03-29 01:55:59'),
(145, 1, 'AKGT', '1403', 'Aktiva Gantung', 1, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-29 01:57:08', '2022-03-29 01:57:08'),
(146, 2, 'AKV', '1401', 'Aktiva', 1, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-29 01:59:22', '2022-03-29 01:59:22'),
(147, 2, 'APA', '1402', 'Akumulasi Penyusutan Aktiva', 1, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-29 01:59:35', '2022-03-29 01:59:35'),
(148, 2, 'AKG', '1403', 'Aktiva Gantung', 1, 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', 'T', '2022-03-29 01:59:54', '2022-03-29 01:59:54');

-- --------------------------------------------------------

--
-- Table structure for table `tb_atk`
--

CREATE TABLE `tb_atk` (
  `id_atk` int(11) NOT NULL,
  `nm_barang` varchar(50) NOT NULL,
  `qty_debit` double NOT NULL,
  `qty_kredit` double NOT NULL,
  `debit_atk` double NOT NULL,
  `kredit_atk` double NOT NULL,
  `no_nota` varchar(50) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_atk`
--

INSERT INTO `tb_atk` (`id_atk`, `nm_barang`, `qty_debit`, `qty_kredit`, `debit_atk`, `kredit_atk`, `no_nota`, `id_satuan`, `tgl`, `id_lokasi`, `created_at`, `updated_at`) VALUES
(2, 'beli paku', 100, 0, 100000, 0, '1001', 26, '2022-03-28', 1, '2022-03-28 06:17:05', '2022-03-28 06:17:05'),
(3, 'beli bor', 200, 0, 200000, 0, '1001', 26, '2022-03-28', 1, '2022-03-28 06:18:44', '2022-03-28 06:18:44'),
(4, 'beli pulpen', 50, 0, 50000, 0, '1001', 26, '2022-03-28', 1, '2022-03-28 08:58:46', '2022-03-28 08:58:46');

-- --------------------------------------------------------

--
-- Table structure for table `tb_batas_ongkir`
--

CREATE TABLE `tb_batas_ongkir` (
  `id_batas_ongkir` int(11) NOT NULL,
  `rupiah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_batas_ongkir`
--

INSERT INTO `tb_batas_ongkir` (`id_batas_ongkir`, `rupiah`, `created_at`, `updated_at`) VALUES
(1, 200000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_bk`
--

CREATE TABLE `tb_bk` (
  `id_bk` int(11) NOT NULL,
  `id_kategori_bk` int(11) NOT NULL,
  `kode_bk` varchar(50) NOT NULL,
  `nm_bk` varchar(100) NOT NULL,
  `hrg_stn_beli` int(11) NOT NULL,
  `satuan_beli` varchar(20) NOT NULL,
  `qty_beli` int(11) NOT NULL,
  `satuan_aktual` varchar(10) NOT NULL,
  `susut` int(11) NOT NULL,
  `modal` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `monitoring` enum('Y','T','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_bk`
--

INSERT INTO `tb_bk` (`id_bk`, `id_kategori_bk`, `kode_bk`, `nm_bk`, `hrg_stn_beli`, `satuan_beli`, `qty_beli`, `satuan_aktual`, `susut`, `modal`, `stok`, `monitoring`) VALUES
(1, 2, 'BK001', 'UNAGI', 35000, 'pack', 10, 'gr', 80, 44, 25143, 'Y'),
(2, 3, 'BK002', 'MARINATE SPICY V2', 51, 'ml', 51, 'ml', 90, 51, 51, 'T'),
(3, 2, 'BK003', 'DORI', 85000, 'pack', 15, 'gr', 90, 63, 30000, 'Y'),
(4, 5, 'BK004', 'MELTIQUE', 105000, 'kg', 10, 'gr', 80, 131, 159000, 'Y'),
(5, 3, 'BK005', 'SEASONING SHIO', 1500, 'pack', 10, 'gr', 90, 167, 10, 'T'),
(6, 3, 'BK006', 'MARINATE SPICY', 7100, 'pack', 130, 'ml', 90, 61, 130, 'Y'),
(7, 3, 'BK007', 'MARINATE BULGOGI YAKINIKU SAUCE', 142000, 'pack', 5300, 'ml', 90, 30, 5300, 'Y'),
(8, 4, 'BK008', 'DAUN BAWANG', 38000, 'kg', 1000, 'gr', 50, 76, 1000, 'T'),
(9, 3, 'BK009', 'MARINATE ORIGINAL SAUCE MIX', 0, '', 0, '', 90, 0, 0, 'Y'),
(10, 2, 'BK010', 'SALMON', 0, '', 0, '', 50, 0, 0, 'Y'),
(11, 1, 'BK011', 'SELADA', 0, '', 0, '', 75, 0, 0, 'T'),
(12, 1, 'BK012', 'JAMUR KUPING', 0, '', 0, '', 80, 0, 0, 'T'),
(13, 1, 'BK013', 'RUMPUT LAUT KERING', 0, '', 0, '', 80, 0, 0, 'Y'),
(14, 1, 'BK014', 'KULIT TAHU', 0, '', 0, '', 80, 0, 0, 'Y'),
(1, 2, 'BK001', 'UNAGI', 35000, 'pack', 10, 'gr', 80, 44, 25143, 'Y'),
(2, 3, 'BK002', 'MARINATE SPICY V2', 51, 'ml', 51, 'ml', 90, 51, 51, 'T'),
(3, 2, 'BK003', 'DORI', 85000, 'pack', 15, 'gr', 90, 63, 30000, 'Y'),
(4, 5, 'BK004', 'MELTIQUE', 105000, 'kg', 10, 'gr', 80, 131, 159000, 'Y'),
(5, 3, 'BK005', 'SEASONING SHIO', 1500, 'pack', 10, 'gr', 90, 167, 10, 'T'),
(6, 3, 'BK006', 'MARINATE SPICY', 7100, 'pack', 130, 'ml', 90, 61, 130, 'Y'),
(7, 3, 'BK007', 'MARINATE BULGOGI YAKINIKU SAUCE', 142000, 'pack', 5300, 'ml', 90, 30, 5300, 'Y'),
(8, 4, 'BK008', 'DAUN BAWANG', 38000, 'kg', 1000, 'gr', 50, 76, 1000, 'T'),
(9, 3, 'BK009', 'MARINATE ORIGINAL SAUCE MIX', 0, '', 0, '', 90, 0, 0, 'Y'),
(10, 2, 'BK010', 'SALMON', 0, '', 0, '', 50, 0, 0, 'Y'),
(11, 1, 'BK011', 'SELADA', 0, '', 0, '', 75, 0, 0, 'T'),
(12, 1, 'BK012', 'JAMUR KUPING', 0, '', 0, '', 80, 0, 0, 'T'),
(13, 1, 'BK013', 'RUMPUT LAUT KERING', 0, '', 0, '', 80, 0, 0, 'Y'),
(14, 1, 'BK014', 'KULIT TAHU', 0, '', 0, '', 80, 0, 0, 'Y'),
(1, 2, 'BK001', 'UNAGI', 35000, 'pack', 10, 'gr', 80, 44, 25143, 'Y'),
(2, 3, 'BK002', 'MARINATE SPICY V2', 51, 'ml', 51, 'ml', 90, 51, 51, 'T'),
(3, 2, 'BK003', 'DORI', 85000, 'pack', 15, 'gr', 90, 63, 30000, 'Y'),
(4, 5, 'BK004', 'MELTIQUE', 105000, 'kg', 10, 'gr', 80, 131, 159000, 'Y'),
(5, 3, 'BK005', 'SEASONING SHIO', 1500, 'pack', 10, 'gr', 90, 167, 10, 'T'),
(6, 3, 'BK006', 'MARINATE SPICY', 7100, 'pack', 130, 'ml', 90, 61, 130, 'Y'),
(7, 3, 'BK007', 'MARINATE BULGOGI YAKINIKU SAUCE', 142000, 'pack', 5300, 'ml', 90, 30, 5300, 'Y'),
(8, 4, 'BK008', 'DAUN BAWANG', 38000, 'kg', 1000, 'gr', 50, 76, 1000, 'T'),
(9, 3, 'BK009', 'MARINATE ORIGINAL SAUCE MIX', 0, '', 0, '', 90, 0, 0, 'Y'),
(10, 2, 'BK010', 'SALMON', 0, '', 0, '', 50, 0, 0, 'Y'),
(11, 1, 'BK011', 'SELADA', 0, '', 0, '', 75, 0, 0, 'T'),
(12, 1, 'BK012', 'JAMUR KUPING', 0, '', 0, '', 80, 0, 0, 'T'),
(13, 1, 'BK013', 'RUMPUT LAUT KERING', 0, '', 0, '', 80, 0, 0, 'Y'),
(14, 1, 'BK014', 'KULIT TAHU', 0, '', 0, '', 80, 0, 0, 'Y'),
(1, 2, 'BK001', 'UNAGI', 35000, 'pack', 10, 'gr', 80, 44, 25143, 'Y'),
(2, 3, 'BK002', 'MARINATE SPICY V2', 51, 'ml', 51, 'ml', 90, 51, 51, 'T'),
(3, 2, 'BK003', 'DORI', 85000, 'pack', 15, 'gr', 90, 63, 30000, 'Y'),
(4, 5, 'BK004', 'MELTIQUE', 105000, 'kg', 10, 'gr', 80, 131, 159000, 'Y'),
(5, 3, 'BK005', 'SEASONING SHIO', 1500, 'pack', 10, 'gr', 90, 167, 10, 'T'),
(6, 3, 'BK006', 'MARINATE SPICY', 7100, 'pack', 130, 'ml', 90, 61, 130, 'Y'),
(7, 3, 'BK007', 'MARINATE BULGOGI YAKINIKU SAUCE', 142000, 'pack', 5300, 'ml', 90, 30, 5300, 'Y'),
(8, 4, 'BK008', 'DAUN BAWANG', 38000, 'kg', 1000, 'gr', 50, 76, 1000, 'T'),
(9, 3, 'BK009', 'MARINATE ORIGINAL SAUCE MIX', 0, '', 0, '', 90, 0, 0, 'Y'),
(10, 2, 'BK010', 'SALMON', 0, '', 0, '', 50, 0, 0, 'Y'),
(11, 1, 'BK011', 'SELADA', 0, '', 0, '', 75, 0, 0, 'T'),
(12, 1, 'BK012', 'JAMUR KUPING', 0, '', 0, '', 80, 0, 0, 'T'),
(13, 1, 'BK013', 'RUMPUT LAUT KERING', 0, '', 0, '', 80, 0, 0, 'Y'),
(14, 1, 'BK014', 'KULIT TAHU', 0, '', 0, '', 80, 0, 0, 'Y'),
(1, 2, 'BK001', 'UNAGI', 35000, 'pack', 10, 'gr', 80, 44, 25143, 'Y'),
(2, 3, 'BK002', 'MARINATE SPICY V2', 51, 'ml', 51, 'ml', 90, 51, 51, 'T'),
(3, 2, 'BK003', 'DORI', 85000, 'pack', 15, 'gr', 90, 63, 30000, 'Y'),
(4, 5, 'BK004', 'MELTIQUE', 105000, 'kg', 10, 'gr', 80, 131, 159000, 'Y'),
(5, 3, 'BK005', 'SEASONING SHIO', 1500, 'pack', 10, 'gr', 90, 167, 10, 'T'),
(6, 3, 'BK006', 'MARINATE SPICY', 7100, 'pack', 130, 'ml', 90, 61, 130, 'Y'),
(7, 3, 'BK007', 'MARINATE BULGOGI YAKINIKU SAUCE', 142000, 'pack', 5300, 'ml', 90, 30, 5300, 'Y'),
(8, 4, 'BK008', 'DAUN BAWANG', 38000, 'kg', 1000, 'gr', 50, 76, 1000, 'T'),
(9, 3, 'BK009', 'MARINATE ORIGINAL SAUCE MIX', 0, '', 0, '', 90, 0, 0, 'Y'),
(10, 2, 'BK010', 'SALMON', 0, '', 0, '', 50, 0, 0, 'Y'),
(11, 1, 'BK011', 'SELADA', 0, '', 0, '', 75, 0, 0, 'T'),
(12, 1, 'BK012', 'JAMUR KUPING', 0, '', 0, '', 80, 0, 0, 'T'),
(13, 1, 'BK013', 'RUMPUT LAUT KERING', 0, '', 0, '', 80, 0, 0, 'Y'),
(14, 1, 'BK014', 'KULIT TAHU', 0, '', 0, '', 80, 0, 0, 'Y'),
(1, 2, 'BK001', 'UNAGI', 35000, 'pack', 10, 'gr', 80, 44, 25143, 'Y'),
(2, 3, 'BK002', 'MARINATE SPICY V2', 51, 'ml', 51, 'ml', 90, 51, 51, 'T'),
(3, 2, 'BK003', 'DORI', 85000, 'pack', 15, 'gr', 90, 63, 30000, 'Y'),
(4, 5, 'BK004', 'MELTIQUE', 105000, 'kg', 10, 'gr', 80, 131, 159000, 'Y'),
(5, 3, 'BK005', 'SEASONING SHIO', 1500, 'pack', 10, 'gr', 90, 167, 10, 'T'),
(6, 3, 'BK006', 'MARINATE SPICY', 7100, 'pack', 130, 'ml', 90, 61, 130, 'Y'),
(7, 3, 'BK007', 'MARINATE BULGOGI YAKINIKU SAUCE', 142000, 'pack', 5300, 'ml', 90, 30, 5300, 'Y'),
(8, 4, 'BK008', 'DAUN BAWANG', 38000, 'kg', 1000, 'gr', 50, 76, 1000, 'T'),
(9, 3, 'BK009', 'MARINATE ORIGINAL SAUCE MIX', 0, '', 0, '', 90, 0, 0, 'Y'),
(10, 2, 'BK010', 'SALMON', 0, '', 0, '', 50, 0, 0, 'Y'),
(11, 1, 'BK011', 'SELADA', 0, '', 0, '', 75, 0, 0, 'T'),
(12, 1, 'BK012', 'JAMUR KUPING', 0, '', 0, '', 80, 0, 0, 'T'),
(13, 1, 'BK013', 'RUMPUT LAUT KERING', 0, '', 0, '', 80, 0, 0, 'Y'),
(14, 1, 'BK014', 'KULIT TAHU', 0, '', 0, '', 80, 0, 0, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tb_buku`
--

CREATE TABLE `tb_buku` (
  `id_buku` int(11) NOT NULL,
  `nm_buku` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_buku`
--

INSERT INTO `tb_buku` (`id_buku`, `nm_buku`) VALUES
(1, 'Penjualan'),
(2, 'Penerimaan Bank'),
(3, 'Pengeluaran');

-- --------------------------------------------------------

--
-- Table structure for table `tb_denda`
--

CREATE TABLE `tb_denda` (
  `id_denda` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alasan` varchar(100) NOT NULL,
  `nominal` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `admin` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_denda`
--

INSERT INTO `tb_denda` (`id_denda`, `nama`, `alasan`, `nominal`, `tgl`, `id_lokasi`, `admin`, `created_at`, `updated_at`) VALUES
(58, 'HERLINA', 'Kimchi jar hilang 1pck', 8000, '2022-02-03', 1, 'wawan', NULL, NULL),
(59, 'SERLI', 'Kimchi jar hilang 1pck', 8000, '2022-02-03', 1, 'wawan', NULL, NULL),
(60, 'DEA', 'Kimchi jar hilang 1pck', 8000, '2022-02-03', 1, 'wawan', NULL, NULL),
(61, 'AISYAH', 'Kimchi jar hilang 1pck', 8000, '2022-02-03', 1, 'wawan', NULL, NULL),
(62, 'PUTRI', 'Kimchi jar hilang 1pck', 8000, '2022-02-03', 1, 'wawan', NULL, NULL),
(63, 'ANGEL', 'Kimchi jar hilang 1pck', 8000, '2022-02-03', 1, 'wawan', NULL, NULL),
(64, 'NETY', 'Kimchi jar hilang 1pck', 8000, '2022-02-03', 1, 'wawan', NULL, NULL),
(65, 'RIA', 'Kimchi jar hilang 1pck', 8000, '2022-02-03', 1, 'wawan', NULL, NULL),
(66, 'Eren', 'Kimchi jar hilang 1pck', 8000, '2022-02-03', 1, 'wawan', NULL, NULL),
(67, 'MAS_ARI', 'Kimchi jar hilang 1pck', 8000, '2022-02-03', 1, 'wawan', NULL, '2022-02-08 00:06:15');

-- --------------------------------------------------------

--
-- Table structure for table `tb_discount`
--

CREATE TABLE `tb_discount` (
  `id_discount` int(11) NOT NULL,
  `disc` int(11) NOT NULL,
  `ket` text NOT NULL,
  `jenis` varchar(10) DEFAULT NULL,
  `dari` date DEFAULT NULL,
  `expired` date NOT NULL,
  `status` enum('0','1','','') NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_discount`
--

INSERT INTO `tb_discount` (`id_discount`, `disc`, `ket`, `jenis`, `dari`, `expired`, `status`, `lokasi`, `created_at`, `updated_at`) VALUES
(19, 50000, 'diskon bulan puasa', 'Rp', '2022-03-04', '2022-03-10', '0', '1', '2022-03-03 22:28:51', '2022-03-03 22:28:51'),
(20, 100, 'Pesan meja 10', 'Persen', '2022-03-04', '2022-03-30', '0', '1', '2022-03-03 22:42:40', '2022-03-03 22:42:40'),
(21, 50, 'diskon ac', 'Persen', '2022-03-04', '2022-03-14', '0', '1', '2022-03-04 00:07:20', '2022-03-04 00:07:20');

-- --------------------------------------------------------

--
-- Table structure for table `tb_distribusi`
--

CREATE TABLE `tb_distribusi` (
  `id_distribusi` int(11) NOT NULL,
  `nm_distribusi` varchar(20) NOT NULL,
  `service` enum('Y','T') NOT NULL,
  `ongkir` enum('Y','T') NOT NULL,
  `tax` enum('T','Y') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_distribusi`
--

INSERT INTO `tb_distribusi` (`id_distribusi`, `nm_distribusi`, `service`, `ongkir`, `tax`, `created_at`, `updated_at`) VALUES
(1, 'Dine-In / Takeway', 'Y', 'T', 'Y', NULL, '2022-03-25 07:36:17'),
(2, 'Gojek', 'T', 'T', 'T', NULL, '2022-03-25 07:36:31'),
(3, 'Delivery', 'Y', 'Y', 'Y', NULL, '2022-03-01 23:18:57');

-- --------------------------------------------------------

--
-- Table structure for table `tb_dp`
--

CREATE TABLE `tb_dp` (
  `id_dp` int(11) NOT NULL,
  `kd_dp` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `nm_customer` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `server` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `ket` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `metode` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `tgl_input` date NOT NULL,
  `tgl_digunakan` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `admin` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `id_lokasi` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_dp`
--

INSERT INTO `tb_dp` (`id_dp`, `kd_dp`, `nm_customer`, `server`, `jumlah`, `tgl`, `ket`, `metode`, `tgl_input`, `tgl_digunakan`, `status`, `admin`, `id_lokasi`, `created_at`, `updated_at`) VALUES
(1, 'SDBDP280', 'PATRICK', 'herlina', 250000, '2022-01-08', 'DP RESERVASI ', 'CASH', '2022-01-08', '0000-00-00', 1, NULL, 2, NULL, NULL),
(2, 'TKMRDP782', 'ABI', 'AULIA', 150000, '2022-01-12', 'DP RESERVASI 3 ORNG', 'CASH', '2022-01-12', '0000-00-00', 1, NULL, 1, NULL, NULL),
(3, 'TKMRDP875', 'RANDY', 'putri', 2, '2022-01-22', 'BUAT MALAM INI JAM 7 MALAM', 'CASH', '2022-01-22', '0000-00-00', 0, 'putri', 1, NULL, NULL),
(4, 'TKMRDP089', 'RANDY', 'putri', 100000, '2022-01-22', 'BUAT MALAM INI JAM 7 MALAM', 'CASH', '2022-01-22', '0000-00-00', 1, 'putri', 1, NULL, NULL),
(5, 'SDBDP105', 'anngy', 'Serli', 1040000, '2022-01-24', 'dp tf reservasi an anggy untuk 15 orang', 'CASH', '2022-01-24', '0000-00-00', 1, 'Serli', 2, NULL, NULL),
(6, 'TKMRDP403', 'ABI MA\'RUF', 'putri', 300000, '2022-01-24', 'BUAT DINE IN JAM 7 MALAM', 'CASH', '2022-01-24', '0000-00-00', 1, 'putri', 1, NULL, NULL),
(7, 'TKMRDP481', 'DIAN ARIF', 'putri', 1000000, '2022-01-24', 'BUAT 8 ORANG DINE IN JAM SET 7 MALAM', 'CASH', '2022-01-24', '0000-00-00', 1, 'putri', 1, NULL, NULL),
(8, 'SDBDP239', 'MARIDA MULYATE', 'Serli', 500000, '2022-01-29', 'DP TF RESRVASI UNTUK 11 ORANG 3 BABY', 'CASH', '2022-01-29', '0000-00-00', 1, 'Serli', 2, NULL, NULL),
(9, 'SDBDP034', 'VIVIN', 'dea', 250000, '2022-01-30', 'RERVASI JAM 8 MALAM ', 'CASH', '2022-01-30', '0000-00-00', 1, 'dea', 2, NULL, NULL),
(27, 'TKMRDP139', 'Aldi', '', 2000000, '2022-02-20', 'Ulang Tahun', 'CASH', '2022-02-10', '0000-00-00', 0, NULL, 1, '2022-02-09 19:36:54', '2022-02-09 19:36:54'),
(28, 'SDBDP368', 'Udin Banua', '', 3, '2022-02-11', 'Pesan meja 10', 'CASH', '2022-02-11', '0000-00-00', 0, NULL, 2, '2022-02-10 17:18:27', '2022-02-10 17:18:27'),
(29, 'TKMRDP658', '2', '1', 1, '2022-02-11', '2', 'CASH', '2022-02-11', '0000-00-00', 0, NULL, 1, '2022-02-10 19:31:42', '2022-02-10 19:31:42'),
(30, 'TKMRDP579', 'Udin Banua', '1', 2000, '2022-03-05', 'diskon bulan puasa', 'CASH', '2022-02-11', '0000-00-00', 1, NULL, 1, '2022-02-10 21:36:47', '2022-02-10 21:36:47'),
(31, 'TKMRDP376', 'mahda', '1', 2000, '2022-02-11', 'Pesan meja 10', 'CASH', '2022-02-11', '0000-00-00', 1, NULL, 1, '2022-02-10 21:37:08', '2022-03-04 07:02:56'),
(32, 'TKMRDP782', 'Basir', 'Aldi', 20000, '2022-03-02', 'Ulang Tahun', 'CASH', '2022-03-01', '0000-00-00', 1, NULL, 1, '2022-02-28 19:28:59', '2022-03-01 03:40:40'),
(33, 'TKMRDP376', 'Siri', 'Mas Ari', 10000, '2022-03-05', 'Dp Meja 10', 'CASH', '2022-03-05', '0000-00-00', 0, NULL, 1, '2022-03-04 16:11:15', '2022-03-04 16:11:15');

-- --------------------------------------------------------

--
-- Table structure for table `tb_gaji`
--

CREATE TABLE `tb_gaji` (
  `id_gaji` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `rp_e` int(11) NOT NULL,
  `rp_m` int(11) NOT NULL,
  `rp_sp` int(11) NOT NULL,
  `g_bulanan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_gaji`
--

INSERT INTO `tb_gaji` (`id_gaji`, `id_karyawan`, `rp_e`, `rp_m`, `rp_sp`, `g_bulanan`, `created_at`, `updated_at`) VALUES
(3, 25, 75000, 75000, 121875, 0, '2022-02-21 22:03:26', '2022-02-22 19:07:42'),
(5, 24, 75000, 75000, 121875, 0, '2022-02-21 22:21:13', '2022-02-22 19:07:56'),
(6, 23, 0, 0, 0, 0, '2022-02-22 17:46:58', '2022-02-22 19:08:18'),
(7, 3, 75000, 75000, 121875, 0, '2022-02-22 17:47:14', '2022-02-22 19:08:37'),
(8, 12, 75000, 75000, 121875, 0, '2022-02-22 19:09:50', '2022-02-22 19:09:50'),
(9, 11, 75000, 75000, 121875, 0, '2022-02-22 19:10:22', '2022-02-22 19:10:22'),
(10, 7, 75000, 75000, 121875, 0, '2022-02-22 19:10:37', '2022-02-22 19:10:37'),
(11, 20, 75000, 75000, 121875, 0, '2022-02-22 19:11:03', '2022-02-22 19:11:03'),
(12, 14, 75000, 75000, 121875, 0, '2022-02-22 19:11:26', '2022-02-22 19:11:26'),
(13, 21, 75000, 75000, 121875, 0, '2022-02-22 19:11:48', '2022-02-22 19:11:48'),
(14, 19, 75000, 75000, 121875, 0, '2022-02-22 19:12:00', '2022-02-22 19:12:00'),
(15, 10, 75000, 75000, 121875, 0, '2022-02-22 19:13:22', '2022-02-22 19:13:22'),
(16, 16, 75000, 75000, 121875, 0, '2022-02-22 19:13:34', '2022-02-22 19:13:34'),
(17, 5, 75000, 75000, 121875, 0, '2022-02-22 19:13:50', '2022-02-22 19:13:50'),
(18, 4, 75000, 75000, 121875, 0, '2022-02-22 19:14:03', '2022-02-22 19:14:03'),
(19, 6, 75000, 75000, 121875, 0, '2022-02-22 19:14:19', '2022-02-22 19:14:19'),
(20, 9, 75000, 75000, 121875, 0, '2022-02-22 19:14:29', '2022-02-22 19:14:29'),
(21, 18, 75000, 75000, 121875, 0, '2022-02-22 19:14:43', '2022-02-22 19:14:43'),
(22, 8, 75000, 75000, 121875, 0, '2022-02-22 19:14:59', '2022-02-22 19:14:59'),
(23, 1, 0, 0, 0, 0, '2022-02-22 19:15:22', '2022-02-22 19:34:59'),
(24, 22, 0, 0, 0, 0, '2022-02-22 22:38:33', '2022-02-22 22:38:33'),
(25, 17, 0, 0, 0, 0, '2022-02-22 22:38:50', '2022-02-22 22:38:50'),
(26, 15, 0, 0, 0, 0, '2022-02-22 22:39:08', '2022-02-22 22:39:08'),
(27, 13, 0, 0, 0, 0, '2022-02-22 22:39:23', '2022-02-22 22:39:23'),
(28, 2, 0, 0, 0, 0, '2022-02-22 22:39:33', '2022-02-22 22:39:33');

-- --------------------------------------------------------

--
-- Table structure for table `tb_harga`
--

CREATE TABLE `tb_harga` (
  `id_harga` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_distribusi` int(11) NOT NULL,
  `harga` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_harga`
--

INSERT INTO `tb_harga` (`id_harga`, `id_menu`, `id_distribusi`, `harga`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 28000, NULL, NULL),
(2, 2, 1, 25000, NULL, NULL),
(3, 3, 1, 60000, NULL, NULL),
(4, 4, 1, 34000, NULL, NULL),
(5, 5, 1, 28000, NULL, NULL),
(6, 6, 1, 30000, NULL, NULL),
(7, 7, 1, 30000, NULL, NULL),
(8, 8, 1, 80000, NULL, NULL),
(9, 9, 1, 80000, NULL, NULL),
(10, 10, 1, 42000, NULL, NULL),
(11, 11, 1, 44000, NULL, NULL),
(12, 12, 1, 62000, NULL, NULL),
(13, 13, 1, 62000, NULL, NULL),
(14, 14, 1, 37000, NULL, NULL),
(15, 15, 1, 47000, NULL, NULL),
(16, 16, 1, 60000, NULL, NULL),
(17, 17, 1, 69000, NULL, NULL),
(18, 18, 1, 44000, NULL, NULL),
(19, 19, 1, 49000, NULL, NULL),
(20, 20, 1, 40000, NULL, NULL),
(21, 21, 1, 40000, NULL, NULL),
(22, 22, 1, 40000, NULL, NULL),
(23, 23, 1, 40000, NULL, NULL),
(24, 24, 1, 40000, NULL, NULL),
(25, 25, 1, 40000, NULL, NULL),
(26, 26, 1, 40000, NULL, NULL),
(27, 27, 1, 47000, NULL, NULL),
(28, 28, 1, 62000, NULL, NULL),
(29, 29, 1, 45000, NULL, NULL),
(30, 30, 1, 65000, NULL, NULL),
(31, 31, 1, 31000, NULL, NULL),
(32, 32, 1, 31000, NULL, NULL),
(33, 33, 1, 55000, NULL, NULL),
(34, 34, 1, 49000, NULL, NULL),
(35, 35, 1, 49000, NULL, NULL),
(36, 36, 1, 49000, NULL, NULL),
(37, 37, 1, 45000, NULL, NULL),
(38, 38, 1, 70000, NULL, NULL),
(39, 39, 1, 56000, NULL, NULL),
(40, 40, 1, 44000, NULL, NULL),
(41, 41, 1, 40000, NULL, NULL),
(42, 42, 1, 44000, NULL, NULL),
(43, 43, 1, 69000, NULL, NULL),
(44, 44, 1, 56000, NULL, NULL),
(45, 45, 1, 85000, NULL, NULL),
(46, 46, 1, 87000, NULL, NULL),
(47, 47, 1, 61000, NULL, NULL),
(48, 48, 1, 67000, NULL, NULL),
(49, 49, 1, 63000, NULL, NULL),
(50, 50, 1, 74000, NULL, NULL),
(51, 51, 1, 130000, NULL, NULL),
(52, 52, 1, 160000, NULL, NULL),
(53, 53, 1, 37000, NULL, NULL),
(54, 54, 1, 37000, NULL, NULL),
(55, 55, 1, 37000, NULL, NULL),
(56, 56, 1, 12000, NULL, NULL),
(57, 57, 1, 30000, NULL, NULL),
(58, 58, 1, 11000, NULL, NULL),
(59, 59, 1, 41000, NULL, NULL),
(60, 60, 1, 57000, NULL, NULL),
(61, 61, 1, 12000, NULL, NULL),
(62, 62, 1, 11000, NULL, NULL),
(63, 63, 1, 49000, NULL, NULL),
(64, 64, 1, 52000, NULL, NULL),
(65, 65, 1, 99000, NULL, NULL),
(66, 66, 1, 37000, NULL, NULL),
(67, 67, 1, 11000, NULL, NULL),
(68, 68, 1, 32000, NULL, NULL),
(69, 69, 1, 32000, NULL, NULL),
(70, 70, 1, 63000, NULL, NULL),
(71, 71, 1, 22000, NULL, NULL),
(72, 72, 1, 53000, NULL, NULL),
(73, 73, 1, 53000, NULL, NULL),
(74, 74, 1, 53000, NULL, NULL),
(75, 75, 1, 52000, NULL, NULL),
(76, 76, 1, 69000, NULL, NULL),
(77, 77, 1, 69000, NULL, NULL),
(78, 78, 1, 24000, NULL, NULL),
(79, 79, 1, 36000, NULL, NULL),
(80, 80, 1, 40000, NULL, NULL),
(81, 81, 1, 59000, NULL, NULL),
(82, 82, 1, 33000, NULL, NULL),
(83, 83, 1, 44000, NULL, NULL),
(84, 84, 1, 42000, NULL, NULL),
(85, 85, 1, 42000, NULL, NULL),
(86, 86, 1, 42000, NULL, NULL),
(87, 87, 1, 0, NULL, NULL),
(88, 88, 1, 0, NULL, NULL),
(89, 89, 1, 0, NULL, NULL),
(90, 90, 1, 0, NULL, NULL),
(91, 91, 1, 0, NULL, NULL),
(92, 92, 1, 0, NULL, NULL),
(93, 93, 1, 12000, NULL, NULL),
(94, 94, 1, 5000, NULL, NULL),
(95, 95, 1, 61000, NULL, NULL),
(96, 96, 1, 12000, NULL, NULL),
(97, 97, 1, 12000, NULL, NULL),
(98, 98, 1, 86000, NULL, NULL),
(99, 99, 1, 11000, NULL, NULL),
(100, 100, 1, 59000, NULL, NULL),
(101, 101, 1, 46000, NULL, NULL),
(102, 102, 1, 129000, NULL, NULL),
(103, 103, 1, 40000, NULL, NULL),
(104, 104, 1, 322853, NULL, NULL),
(105, 105, 1, 382311, NULL, NULL),
(106, 106, 1, 0, NULL, NULL),
(107, 107, 1, 15000, NULL, NULL),
(108, 108, 1, 15000, NULL, NULL),
(109, 109, 1, 15000, NULL, NULL),
(110, 110, 1, 15000, NULL, NULL),
(111, 111, 1, 40000, NULL, NULL),
(112, 112, 1, 15000, NULL, NULL),
(113, 113, 1, 339847, NULL, NULL),
(114, 114, 1, 50000, NULL, NULL),
(115, 115, 1, 15000, NULL, NULL),
(116, 116, 1, 15000, NULL, NULL),
(117, 117, 1, 15000, NULL, NULL),
(118, 118, 1, 15000, NULL, NULL),
(119, 119, 1, 40000, NULL, NULL),
(120, 120, 1, 15000, NULL, NULL),
(121, 121, 1, 0, NULL, NULL),
(122, 122, 1, 0, NULL, NULL),
(123, 123, 1, 12000, NULL, NULL),
(124, 124, 1, 0, NULL, NULL),
(125, 125, 1, 0, NULL, NULL),
(126, 126, 1, 0, NULL, NULL),
(127, 127, 1, 0, NULL, NULL),
(128, 128, 1, 52000, NULL, NULL),
(129, 129, 1, 52000, NULL, NULL),
(130, 130, 1, 500000, NULL, NULL),
(131, 131, 1, 382311, NULL, NULL),
(132, 132, 1, 99000, NULL, NULL),
(133, 133, 1, 55000, NULL, NULL),
(134, 134, 1, 55000, NULL, NULL),
(135, 135, 1, 15000, NULL, NULL),
(136, 136, 1, 30000, NULL, NULL),
(137, 137, 1, 15000, NULL, NULL),
(138, 138, 1, 15000, NULL, NULL),
(139, 139, 1, 15000, NULL, NULL),
(140, 140, 1, 20000, NULL, NULL),
(141, 141, 1, 33000, NULL, NULL),
(142, 142, 1, 20000, NULL, NULL),
(143, 143, 1, 268000, NULL, NULL),
(144, 144, 1, 75000, NULL, NULL),
(145, 145, 1, 17841, NULL, NULL),
(146, 146, 1, 80000, NULL, NULL),
(147, 147, 1, 88000, NULL, NULL),
(148, 148, 1, 64000, NULL, NULL),
(149, 149, 1, 82000, NULL, NULL),
(150, 150, 1, 97000, NULL, NULL),
(151, 151, 1, 64000, NULL, NULL),
(152, 152, 1, 62000, NULL, NULL),
(153, 153, 1, 62000, NULL, NULL),
(154, 154, 1, 62000, NULL, NULL),
(155, 155, 1, 62000, NULL, NULL),
(156, 156, 1, 62000, NULL, NULL),
(157, 157, 1, 25000, NULL, NULL),
(158, 158, 1, 62000, NULL, NULL),
(159, 159, 1, 12000, NULL, NULL),
(160, 160, 1, 12000, NULL, NULL),
(161, 161, 1, 12000, NULL, NULL),
(162, 162, 1, 12000, NULL, NULL),
(163, 163, 1, 0, NULL, NULL),
(164, 164, 1, 28000, NULL, NULL),
(165, 165, 1, 33950, NULL, NULL),
(166, 166, 1, 62000, NULL, NULL),
(167, 167, 1, 58000, NULL, NULL),
(168, 168, 1, 0, NULL, NULL),
(169, 169, 1, 65000, NULL, NULL),
(170, 170, 1, 55000, NULL, NULL),
(171, 171, 1, 20000, NULL, NULL),
(172, 172, 1, 25000, NULL, NULL),
(173, 173, 1, 60000, NULL, NULL),
(174, 174, 1, 45000, NULL, NULL),
(175, 175, 1, 45000, NULL, NULL),
(176, 176, 1, 30000, NULL, NULL),
(177, 177, 1, 99000, NULL, NULL),
(178, 178, 1, 45000, NULL, NULL),
(179, 179, 1, 40000, NULL, NULL),
(180, 180, 1, 62000, NULL, NULL),
(181, 181, 1, 45000, NULL, NULL),
(182, 182, 1, 68000, NULL, NULL),
(183, 1, 2, 40000, NULL, NULL),
(184, 2, 2, 36000, NULL, NULL),
(185, 3, 2, 85000, NULL, NULL),
(186, 4, 2, 45000, NULL, NULL),
(187, 5, 2, 40000, NULL, NULL),
(188, 6, 2, 43000, NULL, NULL),
(189, 7, 2, 43000, NULL, NULL),
(190, 8, 2, 113000, NULL, NULL),
(191, 9, 2, 113000, NULL, NULL),
(192, 10, 2, 60000, NULL, NULL),
(193, 11, 2, 63000, NULL, NULL),
(194, 12, 2, 88000, NULL, NULL),
(195, 13, 2, 88000, NULL, NULL),
(196, 14, 2, 53000, NULL, NULL),
(197, 15, 2, 62500, NULL, NULL),
(198, 16, 2, 85000, NULL, NULL),
(199, 17, 2, 98000, NULL, NULL),
(200, 18, 2, 63000, NULL, NULL),
(201, 19, 2, 70000, NULL, NULL),
(202, 20, 2, 57000, NULL, NULL),
(203, 21, 2, 57000, NULL, NULL),
(204, 22, 2, 57000, NULL, NULL),
(205, 23, 2, 57000, NULL, NULL),
(206, 24, 2, 57000, NULL, NULL),
(207, 25, 2, 57000, NULL, NULL),
(208, 26, 2, 57000, NULL, NULL),
(209, 27, 2, 62500, NULL, NULL),
(210, 28, 2, 88000, NULL, NULL),
(211, 29, 2, 64000, NULL, NULL),
(212, 30, 2, 92000, NULL, NULL),
(213, 31, 2, 44000, NULL, NULL),
(214, 32, 2, 44000, NULL, NULL),
(215, 33, 2, 78000, NULL, NULL),
(216, 34, 2, 70000, NULL, NULL),
(217, 35, 2, 70000, NULL, NULL),
(218, 36, 2, 70000, NULL, NULL),
(219, 37, 2, 64000, NULL, NULL),
(220, 38, 2, 99000, NULL, NULL),
(221, 39, 2, 80000, NULL, NULL),
(222, 40, 2, 63000, NULL, NULL),
(223, 41, 2, 57000, NULL, NULL),
(224, 42, 2, 63000, NULL, NULL),
(225, 43, 2, 98000, NULL, NULL),
(226, 44, 2, 80000, NULL, NULL),
(227, 45, 2, 120000, NULL, NULL),
(228, 46, 2, 123000, NULL, NULL),
(229, 47, 2, 81000, NULL, NULL),
(230, 48, 2, 88500, NULL, NULL),
(231, 49, 2, 83500, NULL, NULL),
(232, 50, 2, 98000, NULL, NULL),
(233, 51, 2, 184000, NULL, NULL),
(234, 52, 2, 226000, NULL, NULL),
(235, 53, 2, 53000, NULL, NULL),
(236, 54, 2, 53000, NULL, NULL),
(237, 55, 2, 53000, NULL, NULL),
(238, 56, 2, 17000, NULL, NULL),
(239, 57, 2, 43000, NULL, NULL),
(240, 58, 2, 15000, NULL, NULL),
(241, 59, 2, 58000, NULL, NULL),
(242, 60, 2, 81000, NULL, NULL),
(243, 61, 2, 16000, NULL, NULL),
(244, 62, 2, 15000, NULL, NULL),
(245, 63, 2, 70000, NULL, NULL),
(246, 64, 2, 74000, NULL, NULL),
(247, 65, 2, 140000, NULL, NULL),
(248, 66, 2, 53000, NULL, NULL),
(249, 67, 2, 16000, NULL, NULL),
(250, 69, 2, 46000, NULL, NULL),
(251, 70, 2, 89000, NULL, NULL),
(252, 71, 2, 31000, NULL, NULL),
(253, 72, 2, 70000, NULL, NULL),
(254, 73, 2, 88000, NULL, NULL),
(255, 74, 2, 75000, NULL, NULL),
(256, 75, 2, 75000, NULL, NULL),
(257, 76, 2, 98000, NULL, NULL),
(258, 77, 2, 98000, NULL, NULL),
(259, 78, 2, 34000, NULL, NULL),
(260, 79, 2, 51000, NULL, NULL),
(261, 80, 2, 57000, NULL, NULL),
(262, 81, 2, 84000, NULL, NULL),
(263, 82, 2, 47000, NULL, NULL),
(264, 83, 2, 63000, NULL, NULL),
(265, 84, 2, 55000, NULL, NULL),
(266, 85, 2, 55000, NULL, NULL),
(267, 86, 2, 55000, NULL, NULL),
(268, 87, 2, 0, NULL, NULL),
(269, 88, 2, 0, NULL, NULL),
(270, 89, 2, 0, NULL, NULL),
(271, 91, 2, 0, NULL, NULL),
(272, 93, 2, 16000, NULL, NULL),
(273, 94, 2, 7000, NULL, NULL),
(274, 95, 2, 87000, NULL, NULL),
(275, 96, 2, 16000, NULL, NULL),
(276, 97, 2, 16000, NULL, NULL),
(277, 98, 2, 122000, NULL, NULL),
(278, 99, 2, 15000, NULL, NULL),
(279, 100, 2, 84000, NULL, NULL),
(280, 101, 2, 65000, NULL, NULL),
(281, 102, 2, 183000, NULL, NULL),
(282, 103, 2, 53000, NULL, NULL),
(283, 106, 2, 0, NULL, NULL),
(284, 107, 2, 22000, NULL, NULL),
(285, 108, 2, 22000, NULL, NULL),
(286, 109, 2, 22000, NULL, NULL),
(287, 110, 2, 22000, NULL, NULL),
(288, 112, 2, 22000, NULL, NULL),
(289, 115, 2, 22000, NULL, NULL),
(290, 116, 2, 20000, NULL, NULL),
(291, 117, 2, 22000, NULL, NULL),
(292, 118, 2, 22000, NULL, NULL),
(293, 120, 2, 22000, NULL, NULL),
(294, 122, 2, 0, NULL, NULL),
(295, 123, 2, 16000, NULL, NULL),
(296, 132, 2, 140000, NULL, NULL),
(297, 133, 2, 78000, NULL, NULL),
(298, 134, 2, 78000, NULL, NULL),
(299, 135, 2, 20000, NULL, NULL),
(300, 136, 2, 43000, NULL, NULL),
(301, 137, 2, 20000, NULL, NULL),
(302, 138, 2, 22000, NULL, NULL),
(303, 139, 2, 22000, NULL, NULL),
(304, 140, 2, 29000, NULL, NULL),
(305, 141, 2, 47000, NULL, NULL),
(306, 142, 2, 29000, NULL, NULL),
(307, 143, 2, 354000, NULL, NULL),
(310, 148, 2, 70000, NULL, NULL),
(311, 149, 2, 116000, NULL, NULL),
(312, 150, 2, 137000, NULL, NULL),
(313, 151, 2, 74000, NULL, NULL),
(314, 152, 2, 88000, NULL, NULL),
(315, 153, 2, 88000, NULL, NULL),
(316, 154, 2, 88000, NULL, NULL),
(317, 155, 2, 88000, NULL, NULL),
(318, 158, 2, 88000, NULL, NULL),
(319, 164, 2, 40000, NULL, NULL),
(320, 167, 2, 82000, NULL, NULL),
(321, 195, 1, 28000, NULL, NULL),
(322, 196, 1, 22000, NULL, NULL),
(323, 197, 1, 10000, NULL, NULL),
(324, 198, 1, 15000, NULL, NULL),
(325, 199, 1, 23000, NULL, NULL),
(326, 200, 1, 55000, NULL, NULL),
(327, 201, 1, 23000, NULL, NULL),
(328, 202, 1, 0, NULL, NULL),
(329, 203, 1, 41000, NULL, NULL),
(330, 204, 1, 37000, NULL, NULL),
(331, 205, 1, 37000, NULL, NULL),
(332, 206, 1, 39000, NULL, NULL),
(333, 207, 1, 39000, NULL, NULL),
(334, 208, 1, 37000, NULL, NULL),
(335, 209, 1, 33000, NULL, NULL),
(336, 210, 1, 120000, NULL, NULL),
(337, 211, 1, 46000, NULL, NULL),
(338, 212, 1, 75000, NULL, NULL),
(339, 213, 1, 40000, NULL, NULL),
(340, 214, 1, 55000, NULL, NULL),
(341, 215, 1, 50000, NULL, NULL),
(342, 216, 1, 37000, NULL, NULL),
(343, 217, 1, 35000, NULL, NULL),
(344, 218, 1, 58000, NULL, NULL),
(345, 219, 1, 38000, NULL, NULL),
(346, 220, 1, 40000, NULL, NULL),
(347, 221, 1, 48000, NULL, NULL),
(348, 222, 1, 129000, NULL, NULL),
(349, 223, 1, 129000, NULL, NULL),
(350, 224, 1, 52000, NULL, NULL),
(351, 225, 1, 45000, NULL, NULL),
(352, 226, 1, 85000, NULL, NULL),
(353, 227, 1, 58000, NULL, NULL),
(354, 228, 1, 58000, NULL, NULL),
(355, 229, 1, 75000, NULL, NULL),
(356, 230, 1, 10000, NULL, NULL),
(357, 231, 1, 20000, NULL, NULL),
(358, 232, 1, 120000, NULL, NULL),
(359, 233, 1, 120000, NULL, NULL),
(360, 234, 1, 120000, NULL, NULL),
(361, 235, 1, 46000, NULL, NULL),
(362, 236, 1, 46000, NULL, NULL),
(363, 237, 1, 46000, NULL, NULL),
(364, 238, 1, 75000, NULL, NULL),
(365, 239, 1, 75000, NULL, NULL),
(366, 240, 1, 75000, NULL, NULL),
(367, 241, 1, 40000, NULL, NULL),
(368, 242, 1, 40000, NULL, NULL),
(369, 243, 1, 40000, NULL, NULL),
(370, 244, 1, 55000, NULL, NULL),
(371, 245, 1, 55000, NULL, NULL),
(372, 246, 1, 50000, NULL, NULL),
(373, 247, 1, 50000, NULL, NULL),
(374, 248, 1, 50000, NULL, NULL),
(375, 249, 1, 35000, NULL, NULL),
(376, 250, 1, 35000, NULL, NULL),
(377, 251, 1, 35000, NULL, NULL),
(379, 253, 1, 37000, NULL, NULL),
(380, 254, 1, 42000, NULL, NULL),
(381, 255, 1, 10000, NULL, NULL),
(382, 256, 1, 35000, NULL, NULL),
(383, 257, 1, 0, NULL, NULL),
(391, 265, 1, 0, NULL, NULL),
(392, 266, 1, 80000, NULL, NULL),
(393, 267, 1, 10000, NULL, NULL),
(394, 268, 1, 0, NULL, NULL),
(395, 269, 1, 20000, NULL, NULL),
(396, 270, 1, 8000, NULL, NULL),
(397, 271, 1, 7000, NULL, NULL),
(398, 272, 1, 20000, NULL, NULL),
(399, 273, 1, 7000, NULL, NULL),
(400, 274, 1, 50000, NULL, NULL),
(401, 275, 1, 80000, NULL, NULL),
(402, 276, 1, 25000, NULL, NULL),
(403, 277, 1, 20000, NULL, NULL),
(404, 278, 1, 10000, NULL, NULL),
(405, 279, 1, 10000, NULL, NULL),
(406, 280, 1, 10000, NULL, NULL),
(407, 281, 1, 400000, NULL, NULL),
(408, 282, 1, 25000, NULL, NULL),
(409, 283, 1, 80000, NULL, NULL),
(410, 284, 1, 25000, NULL, NULL),
(430, 304, 1, 25000, NULL, NULL),
(431, 305, 1, 20000, NULL, NULL),
(432, 306, 1, 61000, NULL, NULL),
(433, 307, 1, 61000, NULL, NULL),
(434, 308, 1, 61000, NULL, NULL),
(435, 309, 1, 61000, NULL, NULL),
(436, 310, 1, 65000, NULL, NULL),
(437, 311, 1, 65000, NULL, NULL),
(438, 312, 1, 65000, NULL, NULL),
(439, 313, 1, 65000, NULL, NULL),
(440, 314, 1, 52000, NULL, NULL),
(441, 315, 1, 52000, NULL, NULL),
(442, 316, 1, 52000, NULL, NULL),
(443, 317, 1, 129000, NULL, NULL),
(444, 318, 1, 129000, NULL, NULL),
(445, 319, 1, 72000, NULL, NULL),
(446, 320, 1, 72000, NULL, NULL),
(447, 321, 1, 72000, NULL, NULL),
(449, 323, 1, 52000, NULL, NULL),
(454, 328, 1, 28000, NULL, NULL),
(455, 329, 1, 90000, NULL, NULL),
(456, 330, 1, 90000, NULL, NULL),
(457, 331, 1, 90000, NULL, NULL),
(458, 332, 1, 90000, NULL, NULL),
(459, 333, 1, 138000, NULL, NULL),
(460, 334, 1, 138000, NULL, NULL),
(461, 335, 1, 138000, NULL, NULL),
(462, 336, 1, 138000, NULL, NULL),
(463, 337, 1, 129000, NULL, NULL),
(464, 338, 1, 429057, NULL, NULL),
(465, 339, 1, 284622, NULL, NULL),
(466, 340, 1, 124044, NULL, NULL),
(467, 341, 1, 26000, NULL, NULL),
(468, 342, 1, 36000, NULL, NULL),
(469, 343, 1, 32000, NULL, NULL),
(470, 344, 1, 30000, NULL, NULL),
(471, 345, 1, 120000, NULL, NULL),
(472, 346, 1, 120000, NULL, NULL),
(473, 347, 1, 120000, NULL, NULL),
(474, 348, 1, 120000, NULL, NULL),
(475, 349, 1, 47000, NULL, NULL),
(476, 350, 1, 15000, NULL, NULL),
(477, 351, 1, 138000, NULL, NULL),
(478, 352, 1, 138000, NULL, NULL),
(479, 353, 1, 138000, NULL, NULL),
(480, 354, 1, 138000, NULL, NULL),
(481, 355, 1, 12000, NULL, NULL),
(482, 356, 1, 36000, NULL, NULL),
(483, 357, 1, 39000, NULL, NULL),
(484, 358, 1, 26000, NULL, NULL),
(485, 359, 1, 39000, NULL, NULL),
(486, 360, 1, 20000, NULL, NULL),
(487, 361, 1, 31000, NULL, NULL),
(488, 362, 1, 16000, NULL, NULL),
(489, 363, 1, 36000, NULL, NULL),
(490, 364, 1, 175000, NULL, NULL),
(491, 365, 1, 150000, NULL, NULL),
(492, 366, 1, 150000, NULL, NULL),
(493, 367, 1, 150000, NULL, NULL),
(494, 368, 1, 12000, NULL, NULL),
(495, 369, 1, 20000, NULL, NULL),
(496, 370, 1, 20000, NULL, NULL),
(497, 371, 1, 20000, NULL, NULL),
(498, 372, 1, 20000, NULL, NULL),
(500, 374, 1, 36000, NULL, NULL),
(501, 375, 1, 17000, NULL, NULL),
(502, 195, 2, 40000, NULL, NULL),
(503, 196, 2, 32000, NULL, NULL),
(504, 197, 2, 15000, NULL, NULL),
(505, 198, 2, 22000, NULL, NULL),
(506, 199, 2, 33000, NULL, NULL),
(507, 200, 2, 78000, NULL, NULL),
(508, 201, 2, 33000, NULL, NULL),
(509, 203, 2, 58000, NULL, NULL),
(510, 204, 2, 53000, NULL, NULL),
(511, 205, 2, 53000, NULL, NULL),
(512, 206, 2, 56000, NULL, NULL),
(513, 207, 2, 56000, NULL, NULL),
(514, 208, 2, 53000, NULL, NULL),
(515, 209, 2, 47000, NULL, NULL),
(516, 210, 2, 158500, NULL, NULL),
(517, 211, 2, 61000, NULL, NULL),
(518, 212, 2, 99000, NULL, NULL),
(519, 213, 2, 53000, NULL, NULL),
(520, 214, 2, 102000, NULL, NULL),
(521, 215, 2, 66000, NULL, NULL),
(522, 216, 2, 53000, NULL, NULL),
(523, 217, 2, 50000, NULL, NULL),
(524, 218, 2, 82000, NULL, NULL),
(525, 219, 2, 54000, NULL, NULL),
(526, 220, 2, 57000, NULL, NULL),
(527, 221, 2, 68000, NULL, NULL),
(528, 222, 2, 183000, NULL, NULL),
(529, 223, 2, 183000, NULL, NULL),
(530, 224, 2, 74000, NULL, NULL),
(531, 225, 2, 64000, NULL, NULL),
(532, 226, 2, 121000, NULL, NULL),
(533, 227, 2, 77000, NULL, NULL),
(534, 228, 2, 82000, NULL, NULL),
(535, 229, 2, 106000, NULL, NULL),
(536, 230, 2, 15000, NULL, NULL),
(537, 231, 2, 30000, NULL, NULL),
(538, 232, 2, 158500, NULL, NULL),
(539, 233, 2, 158500, NULL, NULL),
(540, 234, 2, 158500, NULL, NULL),
(541, 235, 2, 61000, NULL, NULL),
(542, 236, 2, 61000, NULL, NULL),
(543, 237, 2, 61000, NULL, NULL),
(544, 238, 2, 99000, NULL, NULL),
(545, 239, 2, 99000, NULL, NULL),
(546, 240, 2, 99000, NULL, NULL),
(547, 241, 2, 53000, NULL, NULL),
(548, 242, 2, 53000, NULL, NULL),
(549, 243, 2, 53000, NULL, NULL),
(550, 244, 2, 73000, NULL, NULL),
(551, 245, 2, 73000, NULL, NULL),
(552, 246, 2, 66000, NULL, NULL),
(553, 247, 2, 66000, NULL, NULL),
(554, 248, 2, 66000, NULL, NULL),
(555, 249, 2, 50000, NULL, NULL),
(556, 250, 2, 50000, NULL, NULL),
(557, 251, 2, 50000, NULL, NULL),
(559, 253, 2, 53000, NULL, NULL),
(560, 254, 2, 60000, NULL, NULL),
(561, 255, 2, 15000, NULL, NULL),
(562, 256, 2, 46500, NULL, NULL),
(563, 257, 2, 78000, NULL, NULL),
(567, 265, 2, 78000, NULL, NULL),
(568, 266, 2, 96000, NULL, NULL),
(569, 267, 2, 15000, NULL, NULL),
(570, 268, 2, 15000, NULL, NULL),
(571, 269, 2, 12000, NULL, NULL),
(572, 270, 2, 12000, NULL, NULL),
(573, 271, 2, 10000, NULL, NULL),
(574, 272, 2, 30000, NULL, NULL),
(575, 273, 2, 10000, NULL, NULL),
(576, 275, 2, 36000, NULL, NULL),
(577, 276, 2, 36000, NULL, NULL),
(578, 277, 2, 30000, NULL, NULL),
(579, 278, 2, 15000, NULL, NULL),
(580, 279, 2, 15000, NULL, NULL),
(581, 281, 2, 36000, NULL, NULL),
(582, 283, 2, 113000, NULL, NULL),
(583, 284, 2, 36000, NULL, NULL),
(585, 304, 2, 33000, NULL, NULL),
(586, 305, 2, 30000, NULL, NULL),
(587, 306, 2, 87000, NULL, NULL),
(588, 307, 2, 87000, NULL, NULL),
(589, 308, 2, 87000, NULL, NULL),
(590, 309, 2, 87000, NULL, NULL),
(591, 310, 2, 92000, NULL, NULL),
(592, 311, 2, 92000, NULL, NULL),
(593, 312, 2, 92000, NULL, NULL),
(594, 313, 2, 92000, NULL, NULL),
(595, 314, 2, 74000, NULL, NULL),
(596, 315, 2, 74000, NULL, NULL),
(597, 316, 2, 74000, NULL, NULL),
(598, 317, 2, 183000, NULL, NULL),
(599, 318, 2, 183000, NULL, NULL),
(600, 319, 2, 95000, NULL, NULL),
(601, 320, 2, 102000, NULL, NULL),
(603, 328, 2, 0, NULL, NULL),
(604, 329, 2, 128000, NULL, NULL),
(605, 330, 2, 128000, NULL, NULL),
(606, 331, 2, 128000, NULL, NULL),
(607, 332, 2, 128000, NULL, NULL),
(608, 333, 2, 195000, NULL, NULL),
(609, 334, 2, 195000, NULL, NULL),
(610, 335, 2, 195000, NULL, NULL),
(611, 336, 2, 195000, NULL, NULL),
(612, 340, 2, 0, NULL, NULL),
(613, 341, 2, 37000, NULL, NULL),
(614, 342, 2, 51000, NULL, NULL),
(615, 343, 2, 46000, NULL, NULL),
(616, 344, 2, 42000, NULL, NULL),
(617, 348, 2, 170000, NULL, NULL),
(618, 349, 2, 36000, NULL, NULL),
(619, 355, 2, 17000, NULL, NULL),
(620, 356, 2, 51000, NULL, NULL),
(621, 357, 2, 52000, NULL, NULL),
(622, 358, 2, 34500, NULL, NULL),
(623, 359, 2, 56000, NULL, NULL),
(624, 360, 2, 29000, NULL, NULL),
(625, 361, 2, 44000, NULL, NULL),
(626, 362, 2, 22000, NULL, NULL),
(627, 363, 2, 51000, NULL, NULL),
(628, 364, 2, 231000, NULL, NULL),
(629, 368, 2, 12000, NULL, NULL),
(630, 369, 2, 29000, NULL, NULL),
(631, 370, 2, 29000, NULL, NULL),
(632, 371, 2, 29000, NULL, NULL),
(633, 372, 2, 29000, NULL, NULL),
(635, 374, 2, 36000, NULL, NULL),
(636, 375, 2, 17000, NULL, NULL),
(637, 376, 1, 65000, NULL, NULL),
(638, 376, 2, 92000, NULL, NULL),
(639, 377, 1, 55000, NULL, NULL),
(640, 377, 2, 78000, NULL, NULL),
(641, 378, 1, 65000, NULL, NULL),
(642, 378, 2, 92000, NULL, NULL),
(643, 379, 1, 55000, NULL, NULL),
(644, 379, 2, 78000, NULL, NULL),
(645, 380, 1, 49000, NULL, NULL),
(646, 380, 2, 70000, NULL, NULL),
(647, 381, 1, 28000, NULL, NULL),
(648, 381, 2, 40000, NULL, NULL),
(649, 382, 1, 22000, NULL, NULL),
(650, 382, 2, 32000, NULL, NULL),
(651, 383, 1, 10000, NULL, NULL),
(652, 383, 2, 15000, NULL, NULL),
(653, 384, 1, 15000, NULL, NULL),
(654, 384, 2, 22000, NULL, NULL),
(655, 385, 1, 23000, NULL, NULL),
(656, 385, 2, 33000, NULL, NULL),
(657, 386, 1, 55000, NULL, NULL),
(658, 386, 2, 78000, NULL, NULL),
(659, 387, 1, 49000, NULL, NULL),
(660, 387, 2, 70000, NULL, NULL),
(661, 171, 2, 29000, NULL, NULL),
(662, 172, 2, 36000, NULL, NULL),
(663, 173, 2, 85000, NULL, NULL),
(664, 174, 2, 64000, NULL, NULL),
(665, 388, 2, 68000, NULL, NULL),
(666, 388, 1, 48000, NULL, NULL),
(667, 389, 2, 183000, NULL, NULL),
(668, 185, 1, 27000, NULL, NULL),
(669, 183, 1, 12000, NULL, NULL),
(670, 187, 1, 21000, NULL, NULL),
(671, 187, 2, 30000, NULL, NULL),
(672, 186, 2, 55000, NULL, NULL),
(673, 190, 1, 37000, NULL, NULL),
(674, 184, 1, 37000, NULL, NULL),
(676, 175, 2, 64000, NULL, NULL),
(677, 186, 1, 39000, NULL, NULL),
(678, 188, 1, 32000, NULL, NULL),
(679, 146, 2, 113000, NULL, NULL),
(680, 147, 2, 125000, NULL, NULL),
(681, 176, 2, 43000, NULL, NULL),
(682, 183, 2, 16000, NULL, NULL),
(683, 170, 2, 78000, NULL, NULL),
(684, 390, 1, 15000, NULL, NULL),
(685, 390, 2, 22000, NULL, NULL),
(686, 390, 3, 15000, NULL, NULL),
(687, 323, 2, 74000, NULL, NULL),
(688, 190, 2, 53000, NULL, NULL),
(689, 347, 2, 170000, NULL, NULL),
(690, 346, 2, 170000, NULL, NULL),
(691, 345, 2, 170000, NULL, NULL),
(692, 391, 1, 250000, NULL, NULL),
(693, 391, 3, 250000, NULL, NULL),
(694, 280, 2, 15000, NULL, NULL),
(695, 392, 2, 54000, NULL, NULL),
(696, 393, 2, 60000, NULL, NULL),
(697, 394, 2, 67000, NULL, NULL),
(698, 395, 2, 92000, NULL, NULL),
(699, 396, 2, 81000, NULL, NULL),
(700, 397, 2, 54000, NULL, NULL),
(701, 398, 2, 60000, NULL, NULL),
(702, 191, 1, 175000, NULL, NULL),
(703, 191, 2, 248000, NULL, NULL),
(704, 192, 1, 150000, NULL, NULL),
(705, 193, 1, 150000, NULL, NULL),
(706, 194, 1, 150000, NULL, NULL),
(707, 111, 2, 57000, NULL, NULL),
(708, 68, 2, 46000, NULL, NULL),
(709, 169, 2, 92000, NULL, NULL),
(710, 184, 2, 53000, NULL, NULL),
(711, 185, 2, 39000, NULL, NULL),
(712, 181, 2, 64000, NULL, NULL),
(713, 182, 2, 97000, NULL, NULL),
(714, 180, 2, 88000, NULL, NULL),
(715, 282, 0, 36000, NULL, NULL),
(718, 321, 2, 95000, NULL, NULL),
(719, 350, 2, 22000, NULL, NULL),
(720, 177, 2, 140000, NULL, NULL),
(721, 179, 2, 57000, NULL, NULL),
(722, 178, 2, 64000, NULL, NULL),
(723, 188, 2, 46000, NULL, NULL),
(724, 189, 1, 16000, NULL, NULL),
(725, 189, 2, 21500, NULL, NULL),
(726, 399, 1, 37000, NULL, NULL),
(727, 400, 1, 15000, NULL, NULL),
(728, 400, 3, 15000, NULL, NULL),
(729, 400, 2, 22000, NULL, NULL),
(730, 401, 1, 15000, NULL, NULL),
(731, 401, 3, 15000, NULL, NULL),
(732, 401, 2, 22000, NULL, NULL),
(733, 402, 1, 15000, NULL, NULL),
(734, 402, 3, 15000, NULL, NULL),
(735, 402, 2, 22000, NULL, NULL),
(736, 399, 3, 37000, NULL, NULL),
(737, 399, 2, 53000, NULL, NULL),
(738, 403, 1, 42000, NULL, NULL),
(739, 404, 1, 28000, NULL, NULL),
(740, 404, 3, 40000, NULL, NULL),
(741, 404, 3, 28000, NULL, NULL),
(742, 403, 3, 42000, NULL, NULL),
(743, 403, 2, 59000, NULL, NULL),
(744, 369, 3, 20000, NULL, NULL),
(745, 370, 3, 20000, NULL, NULL),
(746, 272, 3, 20000, NULL, NULL),
(747, 405, 1, 0, NULL, NULL),
(748, 406, 1, 0, NULL, NULL),
(749, 407, 1, 0, NULL, NULL),
(750, 408, 1, 0, NULL, NULL),
(751, 409, 1, 0, NULL, NULL),
(752, 410, 1, 0, NULL, NULL),
(753, 274, 2, 71000, NULL, NULL),
(754, 392, 1, 38000, NULL, NULL),
(755, 393, 1, 42000, NULL, NULL),
(756, 394, 1, 47000, NULL, NULL),
(757, 411, 1, 25488.5, NULL, NULL),
(758, 412, 1, 20000, NULL, NULL),
(759, 412, 3, 20000, NULL, NULL),
(760, 412, 2, 29000, NULL, NULL),
(761, 413, 1, 20000, NULL, NULL),
(762, 413, 3, 20000, NULL, NULL),
(763, 413, 2, 29000, NULL, NULL),
(764, 414, 1, 60000, NULL, NULL),
(765, 414, 3, 60000, NULL, NULL),
(766, 414, 2, 85000, NULL, NULL),
(767, 415, 1, 0, NULL, NULL),
(768, 415, 2, 0, NULL, NULL),
(769, 415, 3, 0, NULL, NULL),
(773, 417, 1, 0, NULL, NULL),
(774, 417, 2, 0, NULL, NULL),
(775, 417, 3, 0, NULL, NULL),
(782, 420, 1, 0, NULL, NULL),
(783, 420, 2, 0, NULL, NULL),
(784, 420, 3, 0, NULL, NULL),
(788, 422, 1, 0, NULL, NULL),
(789, 422, 3, 0, NULL, NULL),
(790, 422, 2, 0, NULL, NULL),
(791, 423, 1, 0, NULL, NULL),
(792, 423, 3, 0, NULL, NULL),
(793, 423, 2, 0, NULL, NULL),
(794, 424, 1, 25000, NULL, NULL),
(795, 424, 2, 36000, NULL, NULL),
(797, 426, 1, 0, NULL, NULL),
(798, 426, 2, 0, NULL, NULL),
(799, 426, 3, 0, NULL, NULL),
(800, 427, 1, 500000, NULL, NULL),
(801, 427, 3, 500000, NULL, NULL),
(802, 427, 2, 707000, NULL, NULL),
(803, 428, 1, 0, NULL, NULL),
(804, 428, 3, 0, NULL, NULL),
(805, 428, 2, 0, NULL, NULL),
(809, 430, 1, 0, NULL, NULL),
(810, 430, 3, 0, NULL, NULL),
(811, 430, 2, 0, NULL, NULL),
(812, 431, 1, 0, NULL, NULL),
(813, 431, 3, 0, NULL, NULL),
(814, 431, 2, 0, NULL, NULL),
(815, 432, 1, 0, NULL, NULL),
(816, 432, 3, 0, NULL, NULL),
(817, 432, 2, 0, NULL, NULL),
(818, 433, 1, 0, NULL, NULL),
(819, 433, 3, 0, NULL, NULL),
(820, 433, 2, 0, NULL, NULL),
(821, 434, 1, 0, NULL, NULL),
(822, 434, 3, 0, NULL, NULL),
(823, 434, 2, 0, NULL, NULL),
(824, 435, 1, 0, NULL, NULL),
(825, 435, 3, 0, NULL, NULL),
(826, 435, 2, 0, NULL, NULL),
(827, 436, 1, 0, NULL, NULL),
(828, 436, 3, 0, NULL, NULL),
(829, 436, 2, 0, NULL, NULL),
(830, 437, 1, 0, NULL, NULL),
(831, 437, 3, 0, NULL, NULL),
(832, 437, 2, 0, NULL, NULL),
(833, 438, 1, 0, NULL, NULL),
(834, 438, 3, 0, NULL, NULL),
(835, 438, 2, 0, NULL, NULL),
(836, 439, 1, 0, NULL, NULL),
(837, 439, 3, 0, NULL, NULL),
(838, 439, 2, 0, NULL, NULL),
(839, 440, 1, 0, NULL, NULL),
(840, 440, 3, 0, NULL, NULL),
(841, 440, 2, 0, NULL, NULL),
(842, 441, 1, 0, NULL, NULL),
(843, 441, 3, 0, NULL, NULL),
(844, 441, 2, 0, NULL, NULL),
(845, 442, 1, 0, NULL, NULL),
(846, 442, 3, 0, NULL, NULL),
(847, 442, 2, 0, NULL, NULL),
(848, 443, 1, 0, NULL, NULL),
(849, 443, 3, 0, NULL, NULL),
(850, 443, 2, 0, NULL, NULL),
(851, 444, 1, 0, NULL, NULL),
(852, 444, 3, 0, NULL, NULL),
(853, 444, 2, 0, NULL, NULL),
(854, 445, 1, 0, NULL, NULL),
(855, 445, 3, 0, NULL, NULL),
(856, 445, 2, 0, NULL, NULL),
(875, 453, 1, 550000, NULL, NULL),
(876, 453, 3, 550000, NULL, NULL),
(877, 453, 2, 777000, NULL, NULL),
(878, 473, 1, 600000, NULL, NULL),
(879, 473, 3, 600000, NULL, NULL),
(880, 473, 2, 848000, NULL, NULL),
(884, 499, 1, 10000, '2022-03-09 08:13:27', '2022-03-09 08:13:27'),
(886, 500, 1, 20000, '2022-03-09 08:20:24', '2022-03-09 08:20:24');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jurnal`
--

CREATE TABLE `tb_jurnal` (
  `id_jurnal` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `id_post_center` int(11) DEFAULT NULL,
  `kd_gabungan` varchar(20) NOT NULL,
  `no_nota` varchar(20) DEFAULT NULL,
  `id_lokasi` int(11) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `no_urutan` varchar(50) DEFAULT NULL,
  `urutan` int(11) NOT NULL,
  `debit` double DEFAULT NULL,
  `kredit` double DEFAULT NULL,
  `no_bkin` varchar(50) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `id_satuan` smallint(6) DEFAULT NULL,
  `rp_beli` int(11) DEFAULT NULL,
  `ttl_rp` int(11) DEFAULT NULL,
  `rp_pajak` int(11) DEFAULT NULL,
  `tgl` date NOT NULL,
  `tgl_input` datetime DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  `ket2` varchar(100) DEFAULT NULL,
  `admin` varchar(20) DEFAULT NULL,
  `status` enum('Y','T') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_jurnal`
--

INSERT INTO `tb_jurnal` (`id_jurnal`, `id_buku`, `id_akun`, `id_post_center`, `kd_gabungan`, `no_nota`, `id_lokasi`, `jenis`, `no_urutan`, `urutan`, `debit`, `kredit`, `no_bkin`, `id_produk`, `qty`, `id_satuan`, `rp_beli`, `ttl_rp`, `rp_pajak`, `tgl`, `tgl_input`, `ket`, `ket2`, `admin`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 106, NULL, 'SDI-2203260002', 'KSTKM2022-03-1', 2, '', NULL, 0, 42000, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-26', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-26 05:59:41', '2022-03-26 05:59:41'),
(2, 1, 117, NULL, 'SDI-2203260002', 'PJL2022-03-1', 2, '', NULL, 0, 0, 35000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-26', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-26 05:59:41', '2022-03-26 05:59:41'),
(3, 1, 118, NULL, 'SDI-2203260002', 'PLL2022-03-1', 2, '', NULL, 0, 0, 805, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-26', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-26 05:59:41', '2022-03-26 05:59:41'),
(4, 1, 115, NULL, 'SDI-2203260002', 'HO2022-03-1', 2, '', NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-26', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-26 05:59:41', '2022-03-26 05:59:41'),
(5, 1, 114, NULL, 'SDI-2203260002', 'HSC2022-03-1', 2, '', NULL, 0, 0, 2450, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-26', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-26 05:59:41', '2022-03-26 05:59:41'),
(6, 1, 116, NULL, 'SDI-2203260002', 'PPD2022-03-1', 2, '', NULL, 0, 0, 3745, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-26', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-26 05:59:41', '2022-03-26 05:59:41'),
(7, 1, 104, NULL, 'SDI-2203260003', 'BKBC2022-03-1', 2, '', NULL, 0, 44000, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-26', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-26 06:00:28', '2022-03-26 06:00:28'),
(8, 1, 117, NULL, 'SDI-2203260003', 'PJL2022-03-1', 2, '', NULL, 0, 0, 37000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-26', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-26 06:00:28', '2022-03-26 06:00:28'),
(9, 1, 118, NULL, 'SDI-2203260003', 'PLL2022-03-1', 2, '', NULL, 0, 0, 451, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-26', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-26 06:00:28', '2022-03-26 06:00:28'),
(10, 1, 115, NULL, 'SDI-2203260003', 'HO2022-03-1', 2, '', NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-26', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-26 06:00:28', '2022-03-26 06:00:28'),
(11, 1, 114, NULL, 'SDI-2203260003', 'HSC2022-03-1', 2, '', NULL, 0, 0, 2590, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-26', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-26 06:00:28', '2022-03-26 06:00:28'),
(12, 1, 116, NULL, 'SDI-2203260003', 'PPD2022-03-1', 2, '', NULL, 0, 0, 3959, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-26', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-26 06:00:28', '2022-03-26 06:00:28'),
(13, 1, 107, NULL, 'SDI-2203260004', 'PBC2022-03-1', 2, '', NULL, 0, 44000, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-26', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-26 06:03:10', '2022-03-26 06:03:10'),
(14, 1, 117, NULL, 'SDI-2203260004', 'PJL2022-03-1', 2, '', NULL, 0, 0, 37000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-26', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-26 06:03:10', '2022-03-26 06:03:10'),
(15, 1, 118, NULL, 'SDI-2203260004', 'PLL2022-03-1', 2, '', NULL, 0, 0, 451, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-26', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-26 06:03:10', '2022-03-26 06:03:10'),
(16, 1, 115, NULL, 'SDI-2203260004', 'HO2022-03-1', 2, '', NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-26', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-26 06:03:10', '2022-03-26 06:03:10'),
(17, 1, 114, NULL, 'SDI-2203260004', 'HSC2022-03-1', 2, '', NULL, 0, 0, 2590, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-26', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-26 06:03:10', '2022-03-26 06:03:10'),
(18, 1, 116, NULL, 'SDI-2203260004', 'PPD2022-03-1', 2, '', NULL, 0, 0, 3959, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-26', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-26 06:03:10', '2022-03-26 06:03:10'),
(19, 1, 66, NULL, 'TDE-2203260007', 'BKBC2022-03-1', 1, '', NULL, 0, 90000, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-26', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-26 06:06:23', '2022-03-26 06:06:23'),
(20, 1, 68, NULL, 'TDE-2203260007', 'KSTKM2022-03-1', 1, '', NULL, 0, 9000, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-26', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-26 06:06:23', '2022-03-26 06:06:23'),
(21, 1, 76, NULL, 'TDE-2203260007', 'PJL2022-03-1', 1, '', NULL, 0, 0, 42000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-26', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-26 06:06:23', '2022-03-26 06:06:23'),
(22, 1, 77, NULL, 'TDE-2203260007', 'PLL2022-03-1', 1, '', NULL, 0, 0, 66, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-26', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-26 06:06:23', '2022-03-26 06:06:23'),
(23, 1, 102, NULL, 'TDE-2203260007', 'HO2022-03-1', 1, '', NULL, 0, 0, 45000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-26', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-26 06:06:23', '2022-03-26 06:06:23'),
(24, 1, 101, NULL, 'TDE-2203260007', 'HSC2022-03-1', 1, '', NULL, 0, 0, 2940, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-26', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-26 06:06:23', '2022-03-26 06:06:23'),
(25, 1, 103, NULL, 'TDE-2203260007', 'PPD2022-03-1', 1, '', NULL, 0, 0, 8994, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-26', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-26 06:06:23', '2022-03-26 06:06:23'),
(35, 3, 66, NULL, 'RST280322RCC', 'BKBC0322-2', 1, 'biaya', '1234', 0, NULL, 90000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28', NULL, NULL, NULL, 'Aldi', 'Y', '2022-03-28 05:18:42', '2022-03-28 05:18:42'),
(36, 3, 81, NULL, 'RST280322RCC', 'BPD0322-1', 1, 'biaya', NULL, 0, 40000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28', NULL, 'kesini', NULL, 'Aldi', 'Y', '2022-03-28 05:18:42', '2022-03-28 05:18:42'),
(37, 3, 81, NULL, 'RST280322RCC', 'BPD0322-1', 1, 'biaya', NULL, 0, 50000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28', NULL, 'kesitu', NULL, 'Aldi', 'Y', '2022-03-28 05:18:42', '2022-03-28 05:18:42'),
(53, 3, 66, NULL, 'RST280322OZF', 'BKBC0322-3', 1, 'biaya', NULL, 0, NULL, 100000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28', NULL, NULL, NULL, 'Aldi', 'Y', '2022-03-28 06:17:05', '2022-03-28 06:17:05'),
(54, 3, 74, NULL, 'RST280322OZF', 'ADP0322-1', 1, 'biaya', '2', 0, 100000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28', NULL, 'paku', 'beli paku', 'Aldi', 'Y', '2022-03-28 06:17:05', '2022-03-28 06:17:05'),
(55, 3, 66, NULL, 'RST280322AVR', 'BKBC0322-4', 1, 'biaya', NULL, 0, NULL, 200000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28', NULL, NULL, NULL, 'Aldi', 'Y', '2022-03-28 06:18:44', '2022-03-28 06:18:44'),
(56, 3, 74, NULL, 'RST280322AVR', 'ADP0322-2', 1, 'biaya', 'made1', 0, 200000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28', NULL, 'bor', 'beli bor', 'Aldi', 'Y', '2022-03-28 06:18:44', '2022-03-28 06:18:44'),
(64, 3, 66, NULL, 'RST280322IZ4', 'BKBC0322-5', 1, 'peralatan', NULL, 0, NULL, 50000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28', NULL, NULL, NULL, 'Aldi', 'Y', '2022-03-28 08:30:35', '2022-03-28 08:30:35'),
(65, 3, 71, NULL, 'RST280322IZ4', 'PRL0322-1', 1, 'peralatan', 'bs21', 0, 50000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28', NULL, 'pembelian  Obeng', NULL, 'Aldi', 'Y', '2022-03-28 08:30:35', '2022-03-28 08:30:35'),
(66, 3, 66, NULL, 'RST280322XKC', 'BKBC0322-6', 1, 'atk', NULL, 0, NULL, 50000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28', NULL, NULL, NULL, 'Aldi', 'Y', '2022-03-28 08:58:46', '2022-03-28 08:58:46'),
(67, 3, 74, NULL, 'RST280322XKC', 'ADP0322-3', 1, 'atk', 'tes1', 0, 50000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28', NULL, 'pulpen', 'beli pulpen', 'Aldi', 'Y', '2022-03-28 08:58:46', '2022-03-28 08:58:46'),
(68, 1, 68, NULL, 'TDI-2203290001', 'KSTKM2022-03-2', 1, '', NULL, 0, 95000, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-29', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-29 00:07:55', '2022-03-29 00:07:55'),
(69, 1, 76, NULL, 'TDI-2203290001', 'PJL2022-03-2', 1, '', NULL, 0, 0, 80000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-29', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-29 00:07:55', '2022-03-29 00:07:55'),
(70, 1, 77, NULL, 'TDI-2203290001', 'PLL2022-03-2', 1, '', NULL, 0, 0, 840, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-29', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-29 00:07:55', '2022-03-29 00:07:55'),
(71, 1, 102, NULL, 'TDI-2203290001', 'HO2022-03-2', 1, '', NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-29', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-29 00:07:55', '2022-03-29 00:07:55'),
(72, 1, 101, NULL, 'TDI-2203290001', 'HSC2022-03-2', 1, '', NULL, 0, 0, 5600, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-29', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-29 00:07:55', '2022-03-29 00:07:55'),
(73, 1, 103, NULL, 'TDI-2203290001', 'PPD2022-03-2', 1, '', NULL, 0, 0, 8560, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-29', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-29 00:07:55', '2022-03-29 00:07:55'),
(74, 1, 66, NULL, 'TDI-2203290002', 'BKBC2022-03-7', 1, '', NULL, 0, 36000, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-29', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-29 00:09:32', '2022-03-29 00:09:32'),
(75, 1, 76, NULL, 'TDI-2203290002', 'PJL2022-03-7', 1, '', NULL, 0, 0, 30000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-29', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-29 00:09:32', '2022-03-29 00:09:32'),
(76, 1, 77, NULL, 'TDI-2203290002', 'PLL2022-03-7', 1, '', NULL, 0, 0, 690, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-29', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-29 00:09:32', '2022-03-29 00:09:32'),
(77, 1, 102, NULL, 'TDI-2203290002', 'HO2022-03-7', 1, '', NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-29', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-29 00:09:32', '2022-03-29 00:09:32'),
(78, 1, 101, NULL, 'TDI-2203290002', 'HSC2022-03-7', 1, '', NULL, 0, 0, 2100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-29', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-29 00:09:32', '2022-03-29 00:09:32'),
(79, 1, 103, NULL, 'TDI-2203290002', 'PPD2022-03-7', 1, '', NULL, 0, 0, 3210, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-29', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-29 00:09:32', '2022-03-29 00:09:32'),
(80, 1, 68, NULL, 'TDI-2203290003', 'KSTKM2022-03-3', 1, '', NULL, 0, 50000, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-29', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-29 00:09:46', '2022-03-29 00:09:46'),
(81, 1, 76, NULL, 'TDI-2203290003', 'PJL2022-03-3', 1, '', NULL, 0, 0, 42000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-29', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-29 00:09:46', '2022-03-29 00:09:46'),
(82, 1, 77, NULL, 'TDI-2203290003', 'PLL2022-03-3', 1, '', NULL, 0, 0, 566, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-29', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-29 00:09:46', '2022-03-29 00:09:46'),
(83, 1, 102, NULL, 'TDI-2203290003', 'HO2022-03-3', 1, '', NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-29', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-29 00:09:46', '2022-03-29 00:09:46'),
(84, 1, 101, NULL, 'TDI-2203290003', 'HSC2022-03-3', 1, '', NULL, 0, 0, 2940, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-29', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-29 00:09:46', '2022-03-29 00:09:46'),
(85, 1, 103, NULL, 'TDI-2203290003', 'PPD2022-03-3', 1, '', NULL, 0, 0, 4494, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-29', NULL, 'penjualan', NULL, 'Aldi', 'Y', '2022-03-29 00:09:46', '2022-03-29 00:09:46');

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan`
--

CREATE TABLE `tb_karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_status` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `id_posisi` int(11) NOT NULL,
  `posisi` varchar(100) NOT NULL,
  `updated_at` varchar(200) NOT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`id_karyawan`, `nama`, `id_status`, `tgl_masuk`, `id_posisi`, `posisi`, `updated_at`, `created_at`) VALUES
(1, 'Mas Ari', 1, '2014-12-01', 3, '', '', ''),
(2, 'Wawan', 1, '2014-12-01', 3, '', '', ''),
(3, 'Andi', 1, '2019-10-16', 6, '', '', ''),
(4, 'Inov', 1, '2017-11-08', 6, '', '', ''),
(5, 'Gunawan', 1, '2017-12-01', 6, '', '', ''),
(6, 'Fazar', 1, '2017-11-08', 6, '', '', ''),
(7, 'Fauzan', 1, '2019-08-19', 6, '', '', ''),
(8, 'Yadi', 1, '2015-11-01', 6, '', '', ''),
(9, 'Ugi', 1, '2016-11-01', 6, '', '', ''),
(10, 'Sufian', 1, '2019-01-01', 6, '', '', ''),
(11, 'Renaldi', 1, '2019-08-25', 6, '', '', ''),
(12, 'Ahmad', 1, '2019-09-04', 6, '', '', ''),
(13, 'Lana', 1, '2019-07-03', 2, '', '', ''),
(14, 'Madi', 1, '2019-07-02', 6, '', '', ''),
(15, 'Feri', 1, '2019-07-11', 2, '', '', ''),
(16, 'Budiman', 1, '2018-01-04', 6, '', '', ''),
(17, 'Agus', 1, '2014-11-01', 6, '', '', ''),
(18, 'Hendri', 1, '2016-11-01', 6, '', '', ''),
(19, 'Herlina', 2, '2019-04-16', 5, '', '', ''),
(20, 'Ridwan', 1, '2019-07-09', 6, '', '', ''),
(21, 'Budi Rahmat', 1, '2019-06-29', 6, '', '', ''),
(22, 'Serli', 2, '2019-01-01', 5, '', '', ''),
(23, 'Training', 2, '2020-01-01', 5, '', '', ''),
(24, 'Dea', 2, '2020-12-12', 5, '', '', ''),
(25, 'Aisyah', 2, '2021-01-08', 5, '', '2022-02-22 08:18:23', ''),
(96, 'Bayadi', 1, '2022-03-04', 9, '', '2022-03-04 03:04:03', '2022-03-04 03:03:37');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kasbon`
--

CREATE TABLE `tb_kasbon` (
  `id_kasbon` int(11) NOT NULL,
  `nm_karyawan` varchar(50) NOT NULL,
  `nominal` double NOT NULL,
  `tgl` date NOT NULL,
  `admin` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kasbon`
--

INSERT INTO `tb_kasbon` (`id_kasbon`, `nm_karyawan`, `nominal`, `tgl`, `admin`, `created_at`, `updated_at`) VALUES
(5, 'INOV', 1000, '2022-02-11', '1', '2022-02-10 19:24:14', '2022-02-10 21:35:20'),
(6, 'SUFIAN', 20000, '2022-02-12', 'aldi', '2022-02-10 19:24:54', '2022-02-10 19:24:54'),
(7, 'Mas Ari', 20000, '2022-03-28', 'Aldi', '2022-03-28 01:42:46', '2022-03-28 01:42:46'),
(8, 'WAWAN', 50000, '2022-03-28', 'Aldi', '2022-03-28 01:42:46', '2022-03-28 01:42:46'),
(9, 'Mas Ari', 30000, '2022-03-28', 'Aldi', '2022-03-28 07:08:04', '2022-03-28 07:08:04'),
(10, 'WAWAN', 50000, '2022-03-28', 'Aldi', '2022-03-28 07:08:04', '2022-03-28 07:08:04');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `kd_kategori` int(11) NOT NULL,
  `kategori` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`kd_kategori`, `kategori`, `lokasi`, `created_at`, `updated_at`, `id`) VALUES
(1, 'Agemono dan Yakimono', 'TAKEMORI', NULL, NULL, 1),
(2, 'Ala Carte', 'SOONDOBU', NULL, NULL, 2),
(3, 'Appetizer dan Salad', 'TAKEMORI', NULL, NULL, 3),
(4, 'Bento', 'TAKEMORI', NULL, NULL, 4),
(5, 'Beverages', 'TAKEMORI', NULL, NULL, 5),
(6, 'Bibimbap', 'SOONDOBU', NULL, NULL, 6),
(7, 'Donburi', 'TAKEMORI', NULL, NULL, 7),
(8, 'Grill', 'SOONDOBU', NULL, NULL, 8),
(9, 'Menu Baru (Tkm)', 'TAKEMORI', NULL, NULL, 9),
(10, 'Menu Baru (Sdb)', 'SOONDOBU', NULL, NULL, 10),
(11, 'Ongkir', 'TAKEMORI', NULL, NULL, 11),
(12, 'Paket', 'SOONDOBU', NULL, NULL, 12),
(13, 'Ramen dan Udon', 'TAKEMORI', NULL, NULL, 13),
(14, 'Set Shabu-shabu dan Sukiyaki', 'TAKEMORI', NULL, NULL, 14),
(15, 'Shabu-shabu Kaldu', 'TAKEMORI', NULL, NULL, 15),
(16, 'Soup', 'SOONDOBU', NULL, NULL, 16),
(17, 'Sukiyaki dan Shabu - Shabu (Tambahan)', 'TAKEMORI', NULL, NULL, 17),
(18, 'Sushi Rolls', 'TAKEMORI', NULL, NULL, 18),
(19, 'Tambahan', 'SOONDOBU', NULL, NULL, 19),
(23, 'Beverages', 'SOONDOBU', NULL, NULL, 20),
(24, 'Ongkir', 'SOONDOBU', NULL, NULL, 21),
(25, 'Soondobu Express', 'SOONDOBU', NULL, NULL, 22),
(26, 'Chirashi & Hampers', 'TAKEMORI', NULL, NULL, 23);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_akun`
--

CREATE TABLE `tb_kategori_akun` (
  `id_kategori` int(11) NOT NULL,
  `nm_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kategori_akun`
--

INSERT INTO `tb_kategori_akun` (`id_kategori`, `nm_kategori`) VALUES
(1, 'Aset'),
(2, 'Hutang'),
(3, 'Modal'),
(4, 'Pendapatan'),
(5, 'Biaya'),
(6, 'Kas'),
(7, 'Piutang'),
(8, 'Aktiva'),
(9, 'Beban');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kd_invoice`
--

CREATE TABLE `tb_kd_invoice` (
  `no_invoice` varchar(50) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kd_invoice`
--

INSERT INTO `tb_kd_invoice` (`no_invoice`, `tanggal`, `created_at`, `updated_at`) VALUES
('TDI-2203260001', '2022-03-25 16:00:00', '2022-03-25 23:57:30', '2022-03-25 23:57:30'),
('SDI-2203260001', '2022-03-25 16:00:00', '2022-03-26 00:27:39', '2022-03-26 00:27:39'),
('TDI-2203260002', '2022-03-25 16:00:00', '2022-03-26 05:20:20', '2022-03-26 05:20:20'),
('TDI-2203260003', '2022-03-25 16:00:00', '2022-03-26 05:23:40', '2022-03-26 05:23:40'),
('TDE-2203260001', '2022-03-25 16:00:00', '2022-03-26 05:24:40', '2022-03-26 05:24:40'),
('TDI-2203260004', '2022-03-25 16:00:00', '2022-03-26 05:34:13', '2022-03-26 05:34:13'),
('TDI-2203260005', '2022-03-25 16:00:00', '2022-03-26 05:35:36', '2022-03-26 05:35:36'),
('TDI-2203260006', '2022-03-25 16:00:00', '2022-03-26 05:36:31', '2022-03-26 05:36:31'),
('TDE-2203260002', '2022-03-25 16:00:00', '2022-03-26 05:39:15', '2022-03-26 05:39:15'),
('TDE-2203260003', '2022-03-25 16:00:00', '2022-03-26 05:41:57', '2022-03-26 05:41:57'),
('TDE-2203260004', '2022-03-25 16:00:00', '2022-03-26 05:45:18', '2022-03-26 05:45:18'),
('TDE-2203260005', '2022-03-25 16:00:00', '2022-03-26 05:49:20', '2022-03-26 05:49:20'),
('TDE-2203260006', '2022-03-25 16:00:00', '2022-03-26 05:51:00', '2022-03-26 05:51:00'),
('TDI-2203260007', '2022-03-25 16:00:00', '2022-03-26 05:51:49', '2022-03-26 05:51:49'),
('SDE-2203260001', '2022-03-25 16:00:00', '2022-03-26 05:53:17', '2022-03-26 05:53:17'),
('SDE-2203260002', '2022-03-25 16:00:00', '2022-03-26 05:56:18', '2022-03-26 05:56:18'),
('SDE-2203260003', '2022-03-25 16:00:00', '2022-03-26 05:57:45', '2022-03-26 05:57:45'),
('SDI-2203260002', '2022-03-25 16:00:00', '2022-03-26 05:59:26', '2022-03-26 05:59:26'),
('SDI-2203260003', '2022-03-25 16:00:00', '2022-03-26 06:00:10', '2022-03-26 06:00:10'),
('SDI-2203260004', '2022-03-25 16:00:00', '2022-03-26 06:02:50', '2022-03-26 06:02:50'),
('TDE-2203260007', '2022-03-25 16:00:00', '2022-03-26 06:05:57', '2022-03-26 06:05:57'),
('TDI-2203290001', '2022-03-28 16:00:00', '2022-03-29 00:07:27', '2022-03-29 00:07:27'),
('TDI-2203290002', '2022-03-28 16:00:00', '2022-03-29 00:09:00', '2022-03-29 00:09:00'),
('TDI-2203290003', '2022-03-28 16:00:00', '2022-03-29 00:09:08', '2022-03-29 00:09:08'),
('TDI-2203290004', '2022-03-28 16:00:00', '2022-03-29 00:23:11', '2022-03-29 00:23:11'),
('TDI-2203290005', '2022-03-28 16:00:00', '2022-03-29 00:23:21', '2022-03-29 00:23:21');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kd_invoice2`
--

CREATE TABLE `tb_kd_invoice2` (
  `no_invoice` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kd_invoice2`
--

INSERT INTO `tb_kd_invoice2` (`no_invoice`, `tanggal`, `created_at`, `updated_at`) VALUES
('TDi-2203260001', '2022-03-26', '2022-03-25 23:58:03', '2022-03-25 23:58:03'),
('SDi-2203260001', '2022-03-26', '2022-03-26 00:28:06', '2022-03-26 00:28:06'),
('TDi-2203260002', '2022-03-26', '2022-03-26 05:20:45', '2022-03-26 05:20:45'),
('TDi-2203260003', '2022-03-26', '2022-03-26 05:22:11', '2022-03-26 05:22:11'),
('TDi-2203260004', '2022-03-26', '2022-03-26 05:22:20', '2022-03-26 05:22:20'),
('TDi-2203260005', '2022-03-26', '2022-03-26 05:22:47', '2022-03-26 05:22:47'),
('TDi-2203260006', '2022-03-26', '2022-03-26 05:24:11', '2022-03-26 05:24:11'),
('TDe-2203260001', '2022-03-26', '2022-03-26 05:25:08', '2022-03-26 05:25:08'),
('TDi-2203260007', '2022-03-26', '2022-03-26 05:34:47', '2022-03-26 05:34:47'),
('TDi-2203260008', '2022-03-26', '2022-03-26 05:35:54', '2022-03-26 05:35:54'),
('TDi-2203260009', '2022-03-26', '2022-03-26 05:36:53', '2022-03-26 05:36:53'),
('TDe-2203260002', '2022-03-26', '2022-03-26 05:39:57', '2022-03-26 05:39:57'),
('TDe-2203260003', '2022-03-26', '2022-03-26 05:41:00', '2022-03-26 05:41:00'),
('TDe-2203260004', '2022-03-26', '2022-03-26 05:41:33', '2022-03-26 05:41:33'),
('TDe-2203260005', '2022-03-26', '2022-03-26 05:41:40', '2022-03-26 05:41:40'),
('TDe-2203260006', '2022-03-26', '2022-03-26 05:42:22', '2022-03-26 05:42:22'),
('TDe-2203260007', '2022-03-26', '2022-03-26 05:45:49', '2022-03-26 05:45:49'),
('TDe-2203260008', '2022-03-26', '2022-03-26 05:50:07', '2022-03-26 05:50:07'),
('TDe-2203260009', '2022-03-26', '2022-03-26 05:51:22', '2022-03-26 05:51:22'),
('TDi-2203260010', '2022-03-26', '2022-03-26 05:52:24', '2022-03-26 05:52:24'),
('SDe-2203260001', '2022-03-26', '2022-03-26 05:53:55', '2022-03-26 05:53:55'),
('SDe-2203260002', '2022-03-26', '2022-03-26 05:55:08', '2022-03-26 05:55:08'),
('SDe-2203260003', '2022-03-26', '2022-03-26 05:55:52', '2022-03-26 05:55:52'),
('SDe-2203260004', '2022-03-26', '2022-03-26 05:56:46', '2022-03-26 05:56:46'),
('SDe-2203260005', '2022-03-26', '2022-03-26 05:58:04', '2022-03-26 05:58:04'),
('SDi-2203260002', '2022-03-26', '2022-03-26 05:59:41', '2022-03-26 05:59:41'),
('SDi-2203260003', '2022-03-26', '2022-03-26 06:00:28', '2022-03-26 06:00:28'),
('SDi-2203260004', '2022-03-26', '2022-03-26 06:03:10', '2022-03-26 06:03:10'),
('TDe-2203260010', '2022-03-26', '2022-03-26 06:06:23', '2022-03-26 06:06:23'),
('TDi-2203290001', '2022-03-29', '2022-03-29 00:07:54', '2022-03-29 00:07:54'),
('TDi-2203290002', '2022-03-29', '2022-03-29 00:09:32', '2022-03-29 00:09:32'),
('TDi-2203290003', '2022-03-29', '2022-03-29 00:09:46', '2022-03-29 00:09:46');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelompok_aktiva`
--

CREATE TABLE `tb_kelompok_aktiva` (
  `id_kelompok` int(11) NOT NULL,
  `nm_kelompok` varchar(50) NOT NULL,
  `umur` int(11) NOT NULL,
  `tarif` double NOT NULL,
  `barang_kelompok` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kelompok_aktiva`
--

INSERT INTO `tb_kelompok_aktiva` (`id_kelompok`, `nm_kelompok`, `umur`, `tarif`, `barang_kelompok`) VALUES
(1, 'Kelompok 1', 4, 0.25, 'Kulkas, TV, HP, AC, Laptop, Printer, Kursi dan Mebel(Bukan Stainless) dan Sepeda Motor'),
(2, 'Kelompok 2', 8, 0.125, 'Mobil, Lemari Besi dan Kursi (Stainless), Truck, Brankas, dan Genset'),
(3, 'Kelompok 3', 16, 0.0625, 'Tractor dan Alat Berat'),
(4, 'Kelompok 4A', 20, 0.05, 'Bangunan Permanen'),
(5, 'Kelompok 4B', 10, 0.1, 'Bangunan Tidak Permanen');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelompok_peralatan`
--

CREATE TABLE `tb_kelompok_peralatan` (
  `id_kelompok` int(11) NOT NULL,
  `nm_kelompok` varchar(30) NOT NULL,
  `umur` double NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `tarif` double NOT NULL,
  `barang_kelompok` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kelompok_peralatan`
--

INSERT INTO `tb_kelompok_peralatan` (`id_kelompok`, `nm_kelompok`, `umur`, `satuan`, `tarif`, `barang_kelompok`) VALUES
(1, 'Kelompok 1', 6, 'Bulan', 0.25, 'Obeng, Mata bor'),
(2, 'Kelompok 2', 1, 'Tahun', 1, 'Timbangan'),
(3, 'Kelompok 3', 1.5, 'Tahun', 0.0625, 'Kipas angin ');

-- --------------------------------------------------------

--
-- Table structure for table `tb_koki`
--

CREATE TABLE `tb_koki` (
  `id_koki` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_koki`
--

INSERT INTO `tb_koki` (`id_koki`, `id_karyawan`, `tgl`, `status`, `id_lokasi`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-03-07', '1', 1, '2022-03-06 16:41:16', '2022-03-06 16:41:16'),
(2, 1, '2022-03-08', '1', 1, '2022-03-07 19:55:53', '2022-03-07 19:55:53'),
(3, 6, '2022-03-08', '1', 2, '2022-03-07 22:17:08', '2022-03-07 22:17:08'),
(4, 1, '2022-03-09', '1', 1, '2022-03-09 00:46:50', '2022-03-09 00:46:50'),
(5, 2, '2022-03-09', '1', 1, '2022-03-09 00:46:50', '2022-03-09 00:46:50'),
(6, 3, '2022-03-09', '1', 1, '2022-03-09 00:46:50', '2022-03-09 00:46:50'),
(7, 1, '2022-03-22', '1', 1, '2022-03-22 06:19:26', '2022-03-22 06:19:26'),
(8, 2, '2022-03-22', '1', 1, '2022-03-22 06:19:26', '2022-03-22 06:19:26'),
(9, 1, '2022-03-24', '1', 1, '2022-03-23 23:51:46', '2022-03-23 23:51:46'),
(10, 3, '2022-03-24', '1', 1, '2022-03-23 23:51:46', '2022-03-23 23:51:46'),
(11, 1, '2022-03-25', '1', 1, '2022-03-25 00:18:03', '2022-03-25 00:18:03'),
(12, 2, '2022-03-25', '1', 1, '2022-03-25 00:18:03', '2022-03-25 00:18:03'),
(13, 4, '2022-03-25', '1', 2, '2022-03-25 05:57:31', '2022-03-25 05:57:31'),
(14, 21, '2022-03-25', '1', 2, '2022-03-25 05:57:31', '2022-03-25 05:57:31'),
(15, 2, '2022-03-26', '1', 1, '2022-03-25 23:54:51', '2022-03-25 23:54:51'),
(16, 3, '2022-03-26', '1', 1, '2022-03-25 23:54:51', '2022-03-25 23:54:51'),
(17, 4, '2022-03-26', '1', 2, '2022-03-26 00:27:29', '2022-03-26 00:27:29'),
(18, 5, '2022-03-26', '1', 2, '2022-03-26 00:27:29', '2022-03-26 00:27:29'),
(19, 3, '2022-03-29', '1', 1, '2022-03-29 00:07:08', '2022-03-29 00:07:08'),
(20, 96, '2022-03-29', '1', 1, '2022-03-29 00:07:08', '2022-03-29 00:07:08');

-- --------------------------------------------------------

--
-- Table structure for table `tb_limit`
--

CREATE TABLE `tb_limit` (
  `id_limit` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `batas_limit` int(11) NOT NULL,
  `jml_limit` int(11) NOT NULL,
  `admin` varchar(50) NOT NULL,
  `tgl` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_limit`
--

INSERT INTO `tb_limit` (`id_limit`, `id_menu`, `id_lokasi`, `batas_limit`, `jml_limit`, `admin`, `tgl`, `created_at`, `updated_at`) VALUES
(3, 4, 1, 1, 1, 'Mas Ari', '2022-03-01', '2022-02-28 17:32:15', '2022-02-28 17:32:15'),
(4, 2, 1, 4, 2, 'Mas Ari', '2022-03-01', '2022-02-28 18:22:29', '2022-02-28 18:22:29'),
(5, 7, 1, 3, 2, 'Aldi', '2022-03-01', '2022-02-28 23:18:51', '2022-02-28 23:18:51'),
(6, 5, 1, 4, 2, 'Aldi', '2022-03-01', '2022-02-28 23:46:04', '2022-02-28 23:46:04'),
(7, 201, 2, 3, 2, 'unta', '2022-03-02', '2022-03-01 21:12:52', '2022-03-01 21:12:52'),
(8, 2, 1, 2, 2, 'Mas Ari', '2022-03-05', '2022-03-04 22:33:28', '2022-03-04 22:33:28'),
(10, 1, 1, 2, 2, 'Mas Ari', '2022-03-07', '2022-03-06 16:43:35', '2022-03-06 16:43:35'),
(12, 203, 2, 2, 2, 'unta', '2022-03-07', '2022-03-06 17:15:03', '2022-03-06 17:15:03');

-- --------------------------------------------------------

--
-- Table structure for table `tb_lokasi`
--

CREATE TABLE `tb_lokasi` (
  `id_lokasi` int(11) NOT NULL,
  `nm_lokasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_lokasi`
--

INSERT INTO `tb_lokasi` (`id_lokasi`, `nm_lokasi`) VALUES
(1, 'TAKEMORI'),
(2, 'SOONDOBU');

-- --------------------------------------------------------

--
-- Table structure for table `tb_meja`
--

CREATE TABLE `tb_meja` (
  `id_meja` int(11) NOT NULL,
  `nm_meja` varchar(20) NOT NULL,
  `id_distribusi` int(11) NOT NULL,
  `id_lokasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_meja`
--

INSERT INTO `tb_meja` (`id_meja`, `nm_meja`, `id_distribusi`, `id_lokasi`) VALUES
(1, 'Meja 1', 1, 1),
(2, 'Meja 2', 1, 1),
(3, 'Meja 3', 1, 1),
(4, 'Meja 4', 1, 1),
(5, 'Meja 5', 1, 1),
(6, 'Meja 6', 1, 1),
(7, 'Meja 7', 1, 1),
(8, 'Meja 8', 1, 1),
(9, 'Meja 9', 1, 1),
(10, 'Meja 10', 1, 1),
(11, 'Meja 11', 1, 1),
(12, 'Meja 12', 1, 1),
(13, 'Meja 13', 1, 1),
(14, 'Meja 14', 1, 1),
(15, 'Meja 15', 1, 1),
(16, 'Meja 16', 1, 1),
(17, 'Meja 17', 1, 1),
(18, 'Meja 18', 1, 1),
(19, 'Meja 19', 1, 1),
(20, 'Meja 20', 1, 1),
(21, 'Meja 21', 1, 1),
(22, 'Meja 22', 1, 1),
(23, 'Meja 23', 1, 1),
(24, 'Meja 24', 1, 1),
(25, 'Meja 25', 1, 1),
(26, 'Meja 26', 1, 1),
(27, 'Meja 27', 1, 1),
(28, 'Meja 28', 1, 1),
(29, 'Meja 29', 1, 1),
(30, 'Meja 30', 1, 1),
(31, 'Meja 31', 1, 1),
(32, 'Meja 32', 1, 1),
(33, 'Meja 33', 1, 1),
(34, 'Meja 34', 1, 1),
(35, 'Meja 35', 1, 1),
(36, 'Meja 36', 1, 1),
(37, 'Meja 37', 1, 1),
(38, 'Meja 38', 1, 1),
(39, 'Meja 39', 1, 1),
(40, 'Meja 40', 1, 1),
(41, 'Meja 41', 1, 1),
(42, 'Meja 42', 1, 1),
(43, 'Meja 43', 1, 1),
(44, 'Meja 44', 1, 1),
(45, 'Meja 45', 1, 1),
(46, 'Meja 46', 1, 1),
(47, 'Meja 47', 1, 1),
(48, 'Meja 48', 1, 1),
(49, 'Meja 49', 1, 1),
(50, 'Meja 50', 1, 1),
(51, 'Meja 51', 1, 1),
(52, 'Meja 52', 1, 1),
(53, 'Meja 53', 1, 1),
(54, 'Meja 54', 1, 1),
(55, 'Meja 55', 1, 1),
(56, 'Meja 56', 1, 1),
(57, 'Meja 57', 1, 1),
(58, 'Meja 58', 1, 1),
(59, 'Meja 59', 1, 1),
(60, 'Meja 60', 1, 1),
(61, 'Meja 1', 1, 2),
(62, 'Meja 2', 1, 2),
(63, 'Meja 3', 1, 2),
(64, 'Meja 4', 1, 2),
(65, 'Meja 5', 1, 2),
(66, 'Meja 6', 1, 2),
(67, 'Meja 7', 1, 2),
(68, 'Meja 8', 1, 2),
(69, 'Meja 9', 1, 2),
(70, 'Meja 10', 1, 2),
(71, 'Meja 11', 1, 2),
(72, 'Meja 12', 1, 2),
(73, 'Meja 13', 1, 2),
(74, 'Meja 14', 1, 2),
(75, 'Meja 15', 1, 2),
(76, 'Meja 16', 1, 2),
(77, 'Meja 17', 1, 2),
(78, 'Meja 18', 1, 2),
(79, 'Meja 19', 1, 2),
(80, 'Meja 20', 1, 2),
(81, 'Meja 21', 1, 2),
(82, 'Meja 22', 1, 2),
(83, 'Meja 23', 1, 2),
(84, 'Meja 24', 1, 2),
(85, 'Meja 25', 1, 2),
(86, 'Meja 26', 1, 2),
(87, 'Meja 27', 1, 2),
(88, 'Meja 28', 1, 2),
(89, 'Meja 29', 1, 2),
(90, 'Meja 30', 1, 2),
(91, 'Meja 31', 1, 2),
(92, 'Meja 32', 1, 2),
(93, 'Meja 33', 1, 2),
(94, 'Meja 34', 1, 2),
(95, 'Meja 35', 1, 2),
(96, 'Meja 36', 1, 2),
(97, 'Meja 37', 1, 2),
(98, 'Meja 38', 1, 2),
(99, 'Meja 39', 1, 2),
(100, 'Meja 40', 1, 2),
(101, 'Meja 41', 1, 2),
(102, 'Meja 42', 1, 2),
(103, 'Meja 43', 1, 2),
(104, 'Meja 44', 1, 2),
(105, 'Meja 45', 1, 2),
(106, 'Meja 46', 1, 2),
(107, 'Meja 47', 1, 2),
(108, 'Meja 48', 1, 2),
(109, 'Meja 49', 1, 2),
(110, 'Meja 50', 1, 2),
(111, 'Meja 51', 1, 2),
(112, 'Meja 52', 1, 2),
(113, 'Meja 53', 1, 2),
(114, 'Meja 54', 1, 2),
(115, 'Meja 55', 1, 2),
(116, 'Meja 56', 1, 2),
(117, 'Meja 57', 1, 2),
(118, 'Meja 58', 1, 2),
(119, 'Meja 59', 1, 2),
(120, 'Meja 60', 1, 2),
(121, 'Delivery 1', 3, 1),
(122, 'Delivery 2', 3, 1),
(123, 'Delivery 3', 3, 1),
(124, 'Delivery 4', 3, 1),
(125, 'Delivery 5', 3, 1),
(126, 'Delivery 6', 3, 1),
(127, 'Delivery 7', 3, 1),
(128, 'Delivery 8', 3, 1),
(129, 'Delivery 9', 3, 1),
(130, 'Delivery 10', 3, 1),
(131, 'Delivery 11', 3, 1),
(132, 'Delivery 12', 3, 1),
(133, 'Delivery 13', 3, 1),
(134, 'Delivery 14', 3, 1),
(135, 'Delivery 15', 3, 1),
(136, 'Delivery 16', 3, 1),
(137, 'Delivery 17', 3, 1),
(138, 'Delivery 18', 3, 1),
(139, 'Delivery 19', 3, 1),
(140, 'Delivery 20', 3, 1),
(141, 'Delivery 21', 3, 1),
(142, 'Delivery 22', 3, 1),
(143, 'Delivery 23', 3, 1),
(144, 'Delivery 24', 3, 1),
(145, 'Delivery 25', 3, 1),
(146, 'Delivery 26', 3, 1),
(147, 'Delivery 27', 3, 1),
(148, 'Delivery 28', 3, 1),
(149, 'Delivery 29', 3, 1),
(150, 'Delivery 30', 3, 1),
(151, 'Delivery 31', 3, 1),
(152, 'Delivery 32', 3, 1),
(153, 'Delivery 33', 3, 1),
(154, 'Delivery 34', 3, 1),
(155, 'Delivery 35', 3, 1),
(156, 'Delivery 36', 3, 1),
(157, 'Delivery 37', 3, 1),
(158, 'Delivery 38', 3, 1),
(159, 'Delivery 39', 3, 1),
(160, 'Delivery 40', 3, 1),
(161, 'Delivery 41', 3, 1),
(162, 'Delivery 42', 3, 1),
(163, 'Delivery 43', 3, 1),
(164, 'Delivery 44', 3, 1),
(165, 'Delivery 45', 3, 1),
(166, 'Delivery 46', 3, 1),
(167, 'Delivery 47', 3, 1),
(168, 'Delivery 48', 3, 1),
(169, 'Delivery 49', 3, 1),
(170, 'Delivery 50', 3, 1),
(171, 'Delivery 51', 3, 1),
(172, 'Delivery 52', 3, 1),
(173, 'Delivery 53', 3, 1),
(174, 'Delivery 54', 3, 1),
(175, 'Delivery 55', 3, 1),
(176, 'Delivery 56', 3, 1),
(177, 'Delivery 57', 3, 1),
(178, 'Delivery 58', 3, 1),
(179, 'Delivery 59', 3, 1),
(180, 'Delivery 60', 3, 1),
(181, 'Delivery 1', 3, 2),
(182, 'Delivery 2', 3, 2),
(183, 'Delivery 3', 3, 2),
(184, 'Delivery 4', 3, 2),
(185, 'Delivery 5', 3, 2),
(186, 'Delivery 6', 3, 2),
(187, 'Delivery 7', 3, 2),
(188, 'Delivery 8', 3, 2),
(189, 'Delivery 9', 3, 2),
(190, 'Delivery 10', 3, 2),
(191, 'Delivery 11', 3, 2),
(192, 'Delivery 12', 3, 2),
(193, 'Delivery 13', 3, 2),
(194, 'Delivery 14', 3, 2),
(195, 'Delivery 15', 3, 2),
(196, 'Delivery 16', 3, 2),
(197, 'Delivery 17', 3, 2),
(198, 'Delivery 18', 3, 2),
(199, 'Delivery 19', 3, 2),
(200, 'Delivery 20', 3, 2),
(201, 'Delivery 21', 3, 2),
(202, 'Delivery 22', 3, 2),
(203, 'Delivery 23', 3, 2),
(204, 'Delivery 24', 3, 2),
(205, 'Delivery 25', 3, 2),
(206, 'Delivery 26', 3, 2),
(207, 'Delivery 27', 3, 2),
(208, 'Delivery 28', 3, 2),
(209, 'Delivery 29', 3, 2),
(210, 'Delivery 30', 3, 2),
(211, 'Delivery 31', 3, 2),
(212, 'Delivery 32', 3, 2),
(213, 'Delivery 33', 3, 2),
(214, 'Delivery 34', 3, 2),
(215, 'Delivery 35', 3, 2),
(216, 'Delivery 36', 3, 2),
(217, 'Delivery 37', 3, 2),
(218, 'Delivery 38', 3, 2),
(219, 'Delivery 39', 3, 2),
(220, 'Delivery 40', 3, 2),
(221, 'Delivery 41', 3, 2),
(222, 'Delivery 42', 3, 2),
(223, 'Delivery 43', 3, 2),
(224, 'Delivery 44', 3, 2),
(225, 'Delivery 45', 3, 2),
(226, 'Delivery 46', 3, 2),
(227, 'Delivery 47', 3, 2),
(228, 'Delivery 48', 3, 2),
(229, 'Delivery 49', 3, 2),
(230, 'Delivery 50', 3, 2),
(231, 'Delivery 51', 3, 2),
(232, 'Delivery 52', 3, 2),
(233, 'Delivery 53', 3, 2),
(234, 'Delivery 54', 3, 2),
(235, 'Delivery 55', 3, 2),
(236, 'Delivery 56', 3, 2),
(237, 'Delivery 57', 3, 2),
(238, 'Delivery 58', 3, 2),
(239, 'Delivery 59', 3, 2),
(240, 'Delivery 60', 3, 2),
(241, 'Gojek 1', 2, 1),
(242, 'Gojek 2', 2, 1),
(243, 'Gojek 3', 2, 1),
(244, 'Gojek 4', 2, 1),
(245, 'Gojek 5', 2, 1),
(246, 'Gojek 6', 2, 1),
(247, 'Gojek 7', 2, 1),
(248, 'Gojek 8', 2, 1),
(249, 'Gojek 9', 2, 1),
(250, 'Gojek 10', 2, 1),
(251, 'Gojek 11', 2, 1),
(252, 'Gojek 12', 2, 1),
(253, 'Gojek 13', 2, 1),
(254, 'Gojek 14', 2, 1),
(255, 'Gojek 15', 2, 1),
(256, 'Gojek 16', 2, 1),
(257, 'Gojek 17', 2, 1),
(258, 'Gojek 18', 2, 1),
(259, 'Gojek 19', 2, 1),
(260, 'Gojek 20', 2, 1),
(261, 'Gojek 21', 2, 1),
(262, 'Gojek 22', 2, 1),
(263, 'Gojek 23', 2, 1),
(264, 'Gojek 24', 2, 1),
(265, 'Gojek 25', 2, 1),
(266, 'Gojek 26', 2, 1),
(267, 'Gojek 27', 2, 1),
(268, 'Gojek 28', 2, 1),
(269, 'Gojek 29', 2, 1),
(270, 'Gojek 30', 2, 1),
(271, 'Gojek 31', 2, 1),
(272, 'Gojek 32', 2, 1),
(273, 'Gojek 33', 2, 1),
(274, 'Gojek 34', 2, 1),
(275, 'Gojek 35', 2, 1),
(276, 'Gojek 36', 2, 1),
(277, 'Gojek 37', 2, 1),
(278, 'Gojek 38', 2, 1),
(279, 'Gojek 39', 2, 1),
(280, 'Gojek 40', 2, 1),
(281, 'Gojek 41', 2, 1),
(282, 'Gojek 42', 2, 1),
(283, 'Gojek 43', 2, 1),
(284, 'Gojek 44', 2, 1),
(285, 'Gojek 45', 2, 1),
(286, 'Gojek 46', 2, 1),
(287, 'Gojek 47', 2, 1),
(288, 'Gojek 48', 2, 1),
(289, 'Gojek 49', 2, 1),
(290, 'Gojek 50', 2, 1),
(291, 'Gojek 51', 2, 1),
(292, 'Gojek 52', 2, 1),
(293, 'Gojek 53', 2, 1),
(294, 'Gojek 54', 2, 1),
(295, 'Gojek 55', 2, 1),
(296, 'Gojek 56', 2, 1),
(297, 'Gojek 57', 2, 1),
(298, 'Gojek 58', 2, 1),
(299, 'Gojek 59', 2, 1),
(301, 'Gojek 1', 2, 2),
(302, 'Gojek 2', 2, 2),
(303, 'Gojek 3', 2, 2),
(304, 'Gojek 4', 2, 2),
(305, 'Gojek 5', 2, 2),
(306, 'Gojek 6', 2, 2),
(307, 'Gojek 7', 2, 2),
(308, 'Gojek 8', 2, 2),
(309, 'Gojek 9', 2, 2),
(310, 'Gojek 10', 2, 2),
(311, 'Gojek 11', 2, 2),
(312, 'Gojek 12', 2, 2),
(313, 'Gojek 13', 2, 2),
(314, 'Gojek 14', 2, 2),
(315, 'Gojek 15', 2, 2),
(316, 'Gojek 16', 2, 2),
(317, 'Gojek 17', 2, 2),
(318, 'Gojek 18', 2, 2),
(319, 'Gojek 19', 2, 2),
(320, 'Gojek 20', 2, 2),
(321, 'Gojek 21', 2, 2),
(322, 'Gojek 22', 2, 2),
(323, 'Gojek 23', 2, 2),
(324, 'Gojek 24', 2, 2),
(325, 'Gojek 25', 2, 2),
(326, 'Gojek 26', 2, 2),
(327, 'Gojek 27', 2, 2),
(328, 'Gojek 28', 2, 2),
(329, 'Gojek 29', 2, 2),
(330, 'Gojek 30', 2, 2),
(331, 'Gojek 31', 2, 2),
(332, 'Gojek 32', 2, 2),
(333, 'Gojek 33', 2, 2),
(334, 'Gojek 34', 2, 2),
(335, 'Gojek 35', 2, 2),
(336, 'Gojek 36', 2, 2),
(337, 'Gojek 37', 2, 2),
(338, 'Gojek 38', 2, 2),
(339, 'Gojek 39', 2, 2),
(340, 'Gojek 40', 2, 2),
(341, 'Gojek 41', 2, 2),
(342, 'Gojek 42', 2, 2),
(343, 'Gojek 43', 2, 2),
(344, 'Gojek 44', 2, 2),
(345, 'Gojek 45', 2, 2),
(346, 'Gojek 46', 2, 2),
(347, 'Gojek 47', 2, 2),
(348, 'Gojek 48', 2, 2),
(349, 'Gojek 49', 2, 2),
(350, 'Gojek 50', 2, 2),
(351, 'Gojek 51', 2, 2),
(352, 'Gojek 52', 2, 2),
(353, 'Gojek 53', 2, 2),
(354, 'Gojek 54', 2, 2),
(355, 'Gojek 55', 2, 2),
(356, 'Gojek 56', 2, 2),
(357, 'Gojek 57', 2, 2),
(358, 'Gojek 58', 2, 2),
(359, 'Gojek 59', 2, 2),
(360, 'Gojek 60', 2, 2),
(361, 'Meja 61', 1, 1),
(362, 'Meja 62', 1, 1),
(363, 'Meja 63', 1, 1),
(364, 'Meja 64', 1, 1),
(365, 'Meja 65', 1, 1),
(366, 'Meja 66', 1, 1),
(367, 'Meja 67', 1, 1),
(368, 'Meja 68', 1, 1),
(369, 'Meja 69', 1, 1),
(370, 'Meja 70', 1, 1),
(371, 'Meja 61', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_mencuci`
--

CREATE TABLE `tb_mencuci` (
  `id_mencuci` int(11) NOT NULL,
  `nm_karyawan` varchar(50) NOT NULL,
  `id_ket` int(11) NOT NULL,
  `j_awal` time NOT NULL,
  `j_akhir` time NOT NULL,
  `tgl` date NOT NULL,
  `admin` varchar(40) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_mencuci`
--

INSERT INTO `tb_mencuci` (`id_mencuci`, `nm_karyawan`, `id_ket`, `j_awal`, `j_akhir`, `tgl`, `admin`, `created_at`, `updated_at`) VALUES
(1, 'Andi', 2, '13:13:00', '14:14:00', '2022-02-23', 'aldi', '2022-02-22 21:13:28', '2022-02-22 21:13:28'),
(2, 'Mas Ari', 2, '13:30:00', '13:30:00', '2022-02-23', 'aldi', '2022-02-22 21:30:23', '2022-02-22 21:30:23'),
(3, 'Andi', 2, '10:55:00', '13:55:00', '2022-02-22', 'aldi', '2022-02-22 21:55:59', '2022-02-22 21:55:59'),
(4, 'Gunawan', 2, '04:56:00', '15:56:00', '2022-02-14', 'aldi', '2022-02-22 21:56:23', '2022-02-22 21:56:23'),
(5, 'Wawan', 2, '10:57:00', '13:57:00', '2022-02-10', 'aldi', '2022-02-22 21:57:17', '2022-02-22 21:57:17'),
(6, 'Aisyah', 2, '10:49:00', '14:49:00', '2022-02-15', 'aldi', '2022-02-22 22:49:39', '2022-02-22 22:49:39');

-- --------------------------------------------------------

--
-- Table structure for table `tb_menu`
--

CREATE TABLE `tb_menu` (
  `id_menu` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `kd_menu` int(11) NOT NULL,
  `nm_menu` varchar(120) NOT NULL,
  `tipe` enum('food','drink') NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `lokasi` tinyint(4) NOT NULL,
  `image` varchar(100) NOT NULL,
  `aktif` enum('on','off') NOT NULL,
  `tgl_sold` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_menu`
--

INSERT INTO `tb_menu` (`id_menu`, `id_kategori`, `kd_menu`, `nm_menu`, `tipe`, `jenis`, `lokasi`, `image`, `aktif`, `tgl_sold`, `created_at`, `updated_at`) VALUES
(1, 3, 1101, 'Chawan mushi', 'food', 'menu', 1, 'CHAWAN MUSHI 1.jpg', 'on', '0000-00-00', NULL, NULL),
(2, 3, 1102, 'Edamame tkmr', 'food', 'menu', 1, 'EDAMAME.jpg', 'on', '0000-00-00', NULL, NULL),
(3, 3, 1103, 'Ikan salmon skin furai', 'food', 'menu', 1, 'SALMON SKIN FURAI.jpg', 'on', '0000-00-00', NULL, NULL),
(4, 3, 1104, 'Agedashi tofu', 'food', 'menu', 1, 'AGEDASHI TOFU.jpg', 'on', '0000-00-00', NULL, NULL),
(5, 3, 1105, 'Kakiage', 'food', 'menu', 1, 'KAKIAGE.jpg', 'on', '0000-00-00', NULL, NULL),
(6, 3, 1106, 'Crispy gyoza', 'food', 'menu', 1, 'CRISPY GYOZA.jpg', 'on', '0000-00-00', NULL, NULL),
(7, 3, 1107, 'Yaki gyoza', 'food', 'menu', 1, 'YAKI GYOZA.jpg', 'on', '0000-00-00', NULL, NULL),
(8, 1, 1108, 'Ikan salmon teriyaki', 'food', 'menu', 1, 'SALMON TERIYAKI 1.jpg', 'on', '0000-00-00', NULL, NULL),
(9, 1, 1109, 'Salmon shio', 'food', 'menu', 1, 'SALMON SHIO.jpg', 'on', '0000-00-00', NULL, NULL),
(10, 1, 1110, 'Dori katsu', 'food', 'menu', 1, 'DORY KATSU.jpg', 'on', '0000-00-00', NULL, NULL),
(11, 1, 1111, 'Chicken katsu', 'food', 'menu', 1, 'CHICKEN KATSU.jpg', 'on', '0000-00-00', NULL, NULL),
(12, 1, 1112, 'Tori karage', 'food', 'menu', 1, 'TORI KARAGE.jpg', 'on', '0000-00-00', NULL, NULL),
(13, 1, 1113, 'Beef yakiniku', 'food', 'menu', 1, 'BEEF YAKINIKU ATAU BEEF TERIYAKI.jpg', 'off', '0000-00-00', NULL, NULL),
(14, 1, 1114, 'Chicken teriyaki', 'food', 'menu', 1, 'CHICKEN TERIYAKI.jpg', 'on', '0000-00-00', NULL, NULL),
(15, 1, 1115, 'Beef teriyaki', 'food', 'menu', 1, 'BEEF YAKINIKU ATAU BEEF TERIYAKI.jpg', 'off', '0000-00-00', NULL, NULL),
(16, 1, 1116, 'Ebi tempura', 'food', 'menu', 1, 'EBI TEMPURA.jpg', 'on', '0000-00-00', NULL, NULL),
(17, 13, 1117, 'Dry ramen salmon', 'food', 'menu', 1, 'DRY RAMEN SALMON.jpg', 'on', '0000-00-00', NULL, NULL),
(18, 13, 1118, 'Beef udon', 'food', 'menu', 1, 'BEEF UDON.jpg', 'on', '0000-00-00', NULL, NULL),
(19, 13, 1119, 'Yaki udon tkmr', 'food', 'menu', 1, 'YAKI UDON.jpg', 'on', '0000-00-00', NULL, NULL),
(20, 13, 1120, 'Shoyu beef ramen', 'food', 'menu', 1, 'SHOYU BEEF RAMEN.jpg', 'on', '0000-00-00', NULL, NULL),
(21, 13, 1121, 'Spicy beef ramen', 'food', 'menu', 1, 'DRY SPICY BEEF RAMEN.jpg', 'on', '0000-00-00', NULL, NULL),
(22, 13, 1122, 'Shoyu seafood ramen', 'food', 'menu', 1, 'SHOYU BEEF RAMEN.jpg', 'on', '0000-00-00', NULL, NULL),
(23, 13, 1123, 'Spicy seafood ramen', 'food', 'menu', 1, 'SPICY SEAFOOD RAMEN.jpg', 'on', '0000-00-00', NULL, NULL),
(24, 7, 1124, 'Gyutama don', 'food', 'menu', 1, 'GYUTAMA DON 1.jpg', 'on', '0000-00-00', NULL, NULL),
(25, 7, 1125, 'Oyako don', 'food', 'menu', 1, 'OYAKO DON.jpg', 'on', '0000-00-00', NULL, NULL),
(26, 7, 1126, 'Dori don', 'food', 'menu', 1, 'DORI DON.jpg', 'on', '0000-00-00', NULL, NULL),
(27, 7, 1127, 'Yakiniku don', 'food', 'menu', 1, 'YAKINIKU DON.jpg', 'off', '0000-00-00', NULL, NULL),
(28, 7, 1128, 'Salmon fried rice', 'food', 'menu', 1, 'SALMON FRIED RICE.jpg', 'on', '0000-00-00', NULL, NULL),
(29, 18, 1129, 'Dynamite', 'food', 'menu', 1, 'DYNAMITE.jpg', 'on', '0000-00-00', NULL, NULL),
(30, 18, 1130, 'Aburi salmon nigiri sushi', 'food', 'menu', 1, 'ABURI SALMON NIGIRI SUSHI.jpg', 'on', '0000-00-00', NULL, NULL),
(31, 18, 1131, 'Spicy aburi salmon', 'food', 'menu', 1, 'SPICY ABURI SALMON.jpg', 'on', '0000-00-00', NULL, NULL),
(32, 18, 1132, 'Spicy salmon gunkan', 'food', 'menu', 1, 'SPICY SALMON GUNKAN.jpg', 'on', '0000-00-00', NULL, NULL),
(33, 18, 1133, 'Volcano roll', 'food', 'menu', 1, 'VOLCANO ROLL.jpg', 'on', '0000-00-00', NULL, NULL),
(34, 18, 1134, 'Crunchy beef roll', 'food', 'menu', 1, 'CRUNCHY BEEF ROLL.jpg', 'on', '0000-00-00', NULL, NULL),
(35, 18, 1135, 'Crunchy salmon roll', 'food', 'menu', 1, 'CRUNCHY SALMON ROLL.jpg', 'on', '0000-00-00', NULL, NULL),
(36, 18, 1136, 'Crunchy chicken roll', 'food', 'menu', 1, 'CRUNCHY CHICKEN ROLL.jpg', 'on', '0000-00-00', NULL, NULL),
(37, 18, 1137, 'Merapi roll', 'food', 'menu', 1, 'MERAPI ROLL.jpg', 'on', '0000-00-00', NULL, NULL),
(38, 18, 1138, 'Birthday wans roll', 'food', 'menu', 1, 'BIRTHDAY WANS ROLL.jpg', 'on', '0000-00-00', NULL, NULL),
(39, 18, 1139, 'Philly roll', 'food', 'menu', 1, 'PHILLY ROLL.jpg', 'on', '0000-00-00', NULL, NULL),
(40, 18, 1140, 'Moss roll', 'food', 'menu', 1, 'MOSS ROLL.jpg', 'on', '0000-00-00', NULL, NULL),
(41, 18, 1141, 'California roll', 'food', 'menu', 1, 'CALIFORNIA ROLL.jpg', 'on', '0000-00-00', NULL, NULL),
(42, 18, 1142, 'Pollo roll', 'food', 'menu', 1, 'POLLO ROLL.jpg', 'on', '0000-00-00', NULL, NULL),
(43, 18, 1143, 'Kamikaze roll', 'food', 'menu', 1, 'KAMIKAZE ROLL.jpg', 'on', '0000-00-00', NULL, NULL),
(44, 18, 1144, 'Ken salmon roll', 'food', 'menu', 1, 'KEN SALMON ROLL.jpg', 'on', '0000-00-00', NULL, NULL),
(45, 14, 1146, 'Salmon set', 'food', 'menu', 1, 'SALMON SET.jpg', 'on', '0000-00-00', NULL, NULL),
(46, 14, 1147, 'Mix seafood set', 'food', 'menu', 1, 'MIX SEAFOOD SET.jpg', 'on', '0000-00-00', NULL, NULL),
(47, 14, 1148, 'Standart us beef set regular 50 gr', 'food', 'menu', 1, 'STANDART US BEEF SET REGULAR 50 GR.jpg', 'off', '0000-00-00', NULL, NULL),
(48, 14, 1149, 'Standart us beef set large 100 gr', 'food', 'menu', 1, 'STANDART US BEEF SET LARGE 100 GR.jpg', 'off', '0000-00-00', NULL, NULL),
(49, 14, 1150, 'Australian rib eye set regular 50 gr', 'food', 'menu', 1, 'AUSTRALIAN RIB EYE SET REGULAR 50 GR.jpg', 'off', '0000-00-00', NULL, NULL),
(50, 14, 1151, 'Australian rib eye set large 100 gr ', 'food', 'menu', 1, 'AUSTRALIAN RIB EYE SET LARGE 100 GR.jpg', 'off', '0000-00-00', NULL, NULL),
(51, 14, 1152, 'Wagyu rib eye set regular 50 gr', 'food', 'menu', 1, 'WAGYU.jpg', 'on', '0000-00-00', NULL, NULL),
(52, 14, 1153, 'Wagyu rib eye set large 100 gr', 'food', 'menu', 1, 'WAGYU.jpg', 'on', '0000-00-00', NULL, NULL),
(53, 17, 1155, 'So tsukune 1', 'food', 'menu', 1, 'SO TSUKUNE 1.jpg', 'on', '0000-00-00', NULL, NULL),
(54, 17, 1156, 'So tsukune 2', 'food', 'menu', 1, 'SO TSUKUNE 2.jpg', 'on', '0000-00-00', NULL, NULL),
(55, 17, 1157, 'So tsukune 3', 'food', 'menu', 1, 'SO TSUKUNE 3.jpg', 'on', '0000-00-00', NULL, NULL),
(56, 17, 1158, 'So soun', 'food', 'menu', 1, 'SO SOUN.jpg', 'on', '0000-00-00', NULL, NULL),
(57, 17, 1159, 'So udon mie besar', 'food', 'menu', 1, 'SO UDON MIE BESAR.jpg', 'on', '0000-00-00', NULL, NULL),
(58, 17, 1160, 'So raw egg (telur mentah)', 'food', 'menu', 1, 'SO RAW EGG (TELUR MENTAH).jpg', 'on', '0000-00-00', NULL, NULL),
(59, 17, 1161, 'So prawn', 'food', 'menu', 1, 'SO PRAWN.jpg', 'on', '0000-00-00', NULL, NULL),
(60, 17, 1162, 'So ikan salmon', 'food', 'menu', 1, 'SO IKAN SALMON.jpg', 'on', '0000-00-00', NULL, NULL),
(61, 17, 1163, 'So saos pounzu', 'food', 'menu', 1, 'SO SAOS POUNZU.jpg', 'on', '0000-00-00', NULL, NULL),
(62, 17, 1164, 'So gohan nasi putih', 'food', 'menu', 1, 'SO GOHAN NASI PUTIH.jpg', 'on', '0000-00-00', NULL, NULL),
(63, 17, 1165, 'So standart us beef 100 gr', 'food', 'menu', 1, 'SO STANDART US BEEF 100 GR.jpg', 'on', '0000-00-00', NULL, NULL),
(64, 17, 1166, 'So australian rib eye 100 gr', 'food', 'menu', 1, 'SO AUSTRALIAN RIB EYE 100 GR.jpg', 'on', '0000-00-00', NULL, NULL),
(65, 17, 1167, 'So wagyu rib eye 100 gr', 'food', 'menu', 1, 'WAGYU.jpg', 'on', '0000-00-00', NULL, NULL),
(66, 17, 1168, 'So mixed vegetables', 'food', 'menu', 1, 'SO MIXED VEGETABLES.jpg', 'on', '0000-00-00', NULL, NULL),
(67, 17, 1169, 'So garlic dan onion', 'food', 'menu', 1, 'SO GARLIC DAN ONION.jpg', 'on', '0000-00-00', NULL, NULL),
(68, 17, 1170, 'So shimeiji mushroom', 'food', 'menu', 1, 'SO SHIMEIJI MUSHROOM.jpg', 'on', '0000-00-00', NULL, NULL),
(69, 17, 1171, 'So enoki mushroom', 'food', 'menu', 1, 'SO ENOKI MUSHROOM.jpg', 'on', '0000-00-00', NULL, NULL),
(70, 17, 1172, 'So mixed seafood', 'food', 'menu', 1, 'SO MIXED SEAFOOD.jpg', 'on', '0000-00-00', NULL, NULL),
(71, 17, 1174, 'So chicken fillet', 'food', 'menu', 1, 'SO CHICKEN FILLET.jpg', 'on', '0000-00-00', NULL, NULL),
(72, 4, 1175, 'Yakiniku bento dan ebi tempura', 'food', 'menu', 1, 'YAKINIKU BENTO, EBI TEMPURA, SALMON HARUMAKI.jpg', 'off', '0000-00-00', NULL, NULL),
(73, 4, 1176, 'Yakiniku bento dan salmon harumaki', 'food', 'menu', 1, 'YAKINIKU BENTO, EBI TEMPURA, SALMON HARUMAKI.jpg', 'on', '0000-00-00', NULL, NULL),
(74, 4, 1177, 'Chicken teriyaki bento dan ebi tempura', 'food', 'menu', 1, 'YAKINIKU BENTO, EBI TEMPURA, SALMON HARUMAKI.jpg', 'on', '0000-00-00', NULL, NULL),
(75, 4, 1178, 'Chicken teriyaki bento dan salmon harumaki', 'food', 'menu', 1, 'YAKINIKU BENTO, EBI TEMPURA, SALMON HARUMAKI.jpg', 'on', '0000-00-00', NULL, NULL),
(76, 4, 1179, 'Salmon teriyaki bento dan ebi tempura', 'food', 'menu', 1, 'YAKINIKU BENTO, EBI TEMPURA, SALMON HARUMAKI.jpg', 'on', '0000-00-00', NULL, NULL),
(77, 4, 1180, 'Salmon teriyaki bento dan salmon harumaki', 'food', 'menu', 1, 'YAKINIKU BENTO, EBI TEMPURA, SALMON HARUMAKI.jpg', 'on', '0000-00-00', NULL, NULL),
(78, 17, 1196, 'So prawn ball', 'food', 'menu', 1, 'SO PRAWN BALL.jpg', 'on', '0000-00-00', NULL, NULL),
(79, 7, 1198, 'Yakitori don', 'food', 'menu', 1, 'YAKITORI DON.jpg', 'on', '0000-00-00', NULL, NULL),
(80, 1, 1199, 'Chicken namban', 'food', 'menu', 1, 'CHICKEN NAMBAN.jpg', 'on', '0000-00-00', NULL, NULL),
(81, 1, 1200, 'Grilled chicken ramen', 'food', 'menu', 1, 'GRILLED CHICKEN RAMEN.jpg', 'on', '0000-00-00', NULL, NULL),
(82, 18, 1201, 'Corn gunkan', 'food', 'menu', 1, 'CORN GUNKAN.jpg', 'on', '0000-00-00', NULL, NULL),
(83, 13, 1202, 'Spicy beef udon', 'food', 'menu', 1, 'SPICY BEEF UDON.jpg', 'on', '0000-00-00', NULL, NULL),
(84, 1, 1203, 'Ikan salmon head orishini', 'food', 'menu', 1, 'IKAN SALMON HEAD ORISHINI.jpg', 'on', '0000-00-00', NULL, NULL),
(85, 1, 1204, 'Salmon head tomyam ', 'food', 'menu', 1, 'SALMON HEAD TOMYAM.jpg', 'on', '0000-00-00', NULL, NULL),
(86, 1, 1205, 'Salmon head shio', 'food', 'menu', 1, 'SALMON HEAD SHIO.jpg', 'on', '0000-00-00', NULL, NULL),
(87, 15, 1206, 'Kaldu original', 'food', 'menu', 1, 'KALDU ORIGINAL.jpg', 'on', '0000-00-00', NULL, NULL),
(88, 15, 1207, 'Kaldu tomyam', 'food', 'menu', 1, 'KALDU TOMYAM.jpg', 'on', '0000-00-00', NULL, NULL),
(89, 15, 1208, 'Kaldu mix original dan tomyam ', 'food', 'menu', 1, 'KALDU MIX ORIGINAL DAN TOMYAM.jpg', 'on', '0000-00-00', NULL, NULL),
(90, 15, 1209, 'Free saos ponzu', 'food', 'menu', 1, 'FREE SAOS PONZU.jpg', 'on', '0000-00-00', NULL, NULL),
(91, 15, 1210, 'Free saos thai suki', 'food', 'menu', 1, 'FREE SAOS THAI SUKI.jpg', 'on', '0000-00-00', NULL, NULL),
(92, 17, 1211, 'Sukiyaki kondimen', 'food', 'menu', 1, 'SUKIYAKI KONDIMEN.jpg', 'on', '0000-00-00', NULL, NULL),
(93, 17, 1212, 'So tomyam', 'food', 'menu', 1, 'SO TOMYAM.jpg', 'on', '0000-00-00', NULL, NULL),
(94, 17, 1213, 'So butter', 'food', 'menu', 1, 'SO BUTTER.jpg', 'on', '0000-00-00', NULL, NULL),
(95, 14, 1214, 'Chicken set', 'food', 'menu', 1, 'CHICKEN SET.jpg', 'on', '0000-00-00', NULL, NULL),
(96, 17, 1215, 'So saos suki', 'food', 'menu', 1, 'SO SAOS SUKI.jpg', 'on', '0000-00-00', NULL, NULL),
(97, 17, 1216, 'So saos sukiyaki', 'food', 'menu', 1, 'SO SAOS SUKIYAKI.jpg', 'on', '0000-00-00', NULL, NULL),
(98, 1, 1217, 'Spicy salmon', 'food', 'menu', 1, 'SPICY SALMON.jpg', 'on', '0000-00-00', NULL, NULL),
(99, 17, 1465, 'So boiled egg (telur mateng)', 'food', 'menu', 1, 'SO BOILED EGG (TELUR MATENG).jpg', 'on', '0000-00-00', NULL, NULL),
(100, 13, 1218, 'Dry spicy beef ramen', 'food', 'menu', 1, 'DRY SPICY BEEF RAMEN.jpg', 'on', '0000-00-00', NULL, NULL),
(101, 1, 1219, 'Spicy dori', 'food', 'menu', 1, 'SPICY DORI.jpg', 'on', '0000-00-00', NULL, NULL),
(102, 14, 1220, 'Sumo beef set', 'food', 'menu', 1, 'SUMO BEEF SET.jpg', 'on', '0000-00-00', NULL, NULL),
(103, 5, 1467, 'Bir bintang bj', 'food', 'menu', 1, 'BIR BINTANG.jpg', 'on', '0000-00-00', NULL, NULL),
(104, 18, 1455, 'Chirashi sushi 380', 'food', 'menu', 1, 'CHIRASHI SUSHI 380.jpg', 'off', '0000-00-00', NULL, NULL),
(105, 18, 1456, 'Chirashi sushi 450', 'food', 'menu', 1, 'CHIRASHI SUSHI 450.jpg', 'off', '0000-00-00', NULL, NULL),
(106, 18, 1138, 'free birthday wans roll ms', 'food', 'menu', 1, 'FREE BIRTHDAY WANS ROLL MS.jpg', 'on', '0000-00-00', NULL, NULL),
(107, 17, 1457, 'So goreng fish ball', 'food', 'menu', 1, 'SO GORENG FISH BALL.jpg', 'on', '0000-00-00', NULL, NULL),
(108, 17, 1458, 'So goreng fish cube', 'food', 'menu', 1, 'SO GORENG FISH CUBE.jpg', 'on', '0000-00-00', NULL, NULL),
(109, 17, 1459, 'So chicken veggie siumay', 'food', 'menu', 1, 'SO CHICKEN VEGGIE SIUMAY.jpg', 'on', '0000-00-00', NULL, NULL),
(110, 17, 1460, 'So seaweed fishball', 'food', 'menu', 1, 'SO SEAWEED FISHBALL.jpg', 'on', '0000-00-00', NULL, NULL),
(111, 17, 1461, 'So meatball xl', 'food', 'menu', 1, 'SO MEATBALL XL.jpg', 'on', '0000-00-00', NULL, NULL),
(112, 17, 1462, 'So chicken siumay', 'food', 'menu', 1, 'SO CHICKEN SIUMAY.jpg', 'on', '0000-00-00', NULL, NULL),
(113, 18, 1463, 'chirashi sushi classic', 'food', 'menu', 1, 'CHIRASHI SUSHI CLASSIC.jpg', 'off', '0000-00-00', NULL, NULL),
(114, 18, 1464, 'chirashi sushi topper', 'food', 'menu', 1, 'CHIRASHI SUSHI TOPPER.jpg', 'off', '0000-00-00', NULL, NULL),
(115, 17, 1457, 'So fish ball', 'food', 'menu', 1, 'SO FISH BALL.jpg', 'on', '0000-00-00', NULL, NULL),
(116, 17, 1462, 'So goreng chicken siumay', 'food', 'menu', 1, 'SO GORENG CHICKEN SIUMAY.jpg', 'on', '0000-00-00', NULL, NULL),
(117, 17, 1459, 'So goreng chicken veggie siumay', 'food', 'menu', 1, 'SO GORENG CHICKEN VEGGIE SIUMAY.jpg', 'on', '0000-00-00', NULL, NULL),
(118, 17, 1458, 'So fish cube', 'food', 'menu', 1, 'SO FISH CUBE.jpg', 'on', '0000-00-00', NULL, NULL),
(119, 17, 1461, 'So goreng meatball xl', 'food', 'menu', 1, 'SO GORENG MEATBALL XL.jpg', 'on', '0000-00-00', NULL, NULL),
(120, 17, 1460, 'So goreng seaweed fishball', 'food', 'menu', 1, 'SO GORENG SEAWEED FISHBALL.jpg', 'on', '0000-00-00', NULL, NULL),
(121, 26, 1480, 'Chirashi Gold', 'food', 'menu', 1, 'CHIRASHI GOLD.jpg', 'on', '0000-00-00', NULL, NULL),
(122, 15, 1481, 'Free saos goma', 'food', 'menu', 1, 'FREE SAOS GOMA.jpg', 'on', '0000-00-00', NULL, NULL),
(123, 15, 1481, 'Saos goma so', 'food', 'menu', 1, 'SAOS GOMA SO.jpg', 'on', '0000-00-00', NULL, NULL),
(124, 26, 1482, 'Chirashi Tempura', 'food', 'menu', 1, 'CHIRASHI TEMPURA.jpg', 'on', '0000-00-00', NULL, NULL),
(125, 26, 1483, 'Chirashi Themes', 'food', 'menu', 1, 'CHIRASHI THEMES.jpg', 'on', '0000-00-00', NULL, NULL),
(126, 26, 1484, 'Chirashi Classic', 'food', 'menu', 1, 'CHIRASHI CLASSIC.jpg', 'on', '0000-00-00', NULL, NULL),
(127, 26, 1485, 'Chirashi Rose', 'food', 'menu', 1, 'CHIRASHI ROSE.jpg', 'on', '0000-00-00', NULL, NULL),
(128, 4, 1448, 'Beef yakiniku bento dan ebi tempura', 'food', 'menu', 1, 'YAKINIKU BENTO, EBI TEMPURA, SALMON HARUMAKI.jpg', 'off', '0000-00-00', NULL, NULL),
(129, 4, 1449, 'Beef yakiniku bento salmon harumaki', 'food', 'menu', 1, 'YAKINIKU BENTO, EBI TEMPURA, SALMON HARUMAKI.jpg', 'off', '0000-00-00', NULL, NULL),
(130, 14, 1486, 'Takemori christmas set', 'food', 'menu', 1, 'TAKEMORI CHRISTMAS SET.jpg', 'on', '0000-00-00', NULL, NULL),
(131, 18, 3010, 'Hampers', 'food', 'menu', 1, 'gratis-png-chica-monstruo-enciclopedia-basilisco-serpiente-lamia-serpiente.png', 'off', '0000-00-00', NULL, NULL),
(132, 7, 3011, 'Una don', 'food', 'menu', 1, 'UNA DON.jpg', 'on', '0000-00-00', NULL, NULL),
(133, 18, 3012, 'Unagi nigiri sushi', 'food', 'menu', 1, 'UNAGI NIGIRI SUSHI.jpg', 'on', '0000-00-00', NULL, NULL),
(134, 18, 3013, 'Spicy unagi nigiri sushi', 'food', 'menu', 1, 'SPICY UNAGI NIGIRI SUSHI.jpg', 'on', '0000-00-00', NULL, NULL),
(135, 17, 3014, 'So tofu skin', 'food', 'menu', 1, 'SO TOFU SKIN.jpg', 'on', '0000-00-00', NULL, NULL),
(136, 17, 3015, 'So satsuma age kekian', 'food', 'menu', 1, 'SO SATSUMA AGE KEKIAN.jpg', 'on', '0000-00-00', NULL, NULL),
(137, 17, 3016, 'So arage mushroom jamur kuping', 'food', 'menu', 1, 'SO ARAGE MUSHROOM JAMUR KUPING.jpg', 'on', '0000-00-00', NULL, NULL),
(138, 17, 3017, 'So seaweed rumput laut', 'food', 'menu', 1, 'SO SEAWEED RUMPUT LAUT.jpg', 'on', '0000-00-00', NULL, NULL),
(139, 17, 3018, 'So daun selada', 'food', 'menu', 1, 'SO DAUN SELADA.jpg', 'on', '0000-00-00', NULL, NULL),
(140, 17, 3019, 'So sosis', 'food', 'menu', 1, 'SO SOSIS.jpg', 'on', '0000-00-00', NULL, NULL),
(141, 18, 3020, 'Tuna gunkan', 'food', 'menu', 1, 'TUNA GUNKAN.jpg', 'on', '0000-00-00', NULL, NULL),
(142, 17, 3021, 'So mie ramyon', 'food', 'menu', 1, 'SO MIE RAMYON.jpg', 'on', '0000-00-00', NULL, NULL),
(143, 17, 3022, 'So teripang', 'food', 'menu', 1, 'SO TERIPANG.jpg', 'on', '0000-00-00', NULL, NULL),
(144, 26, 3023, 'Custom Chirashi', 'food', 'menu', 1, 'CUSTOM CHIRASHI.jpg', 'on', '0000-00-00', NULL, NULL),
(145, 11, 3024, 'ongkir gosend 21', 'food', 'menu', 1, 'ONGKIR GOSEND 21.jpg', 'on', '0000-00-00', NULL, NULL),
(146, 14, 1148, 'Standart us beef set regular 50 gr a', 'food', 'menu', 1, 'STANDART US BEEF SET REGULAR 50 GR A.jpg', 'on', '0000-00-00', NULL, NULL),
(147, 14, 1149, 'Standart us beef set large 100 gr a', 'food', 'menu', 1, 'STANDART US BEEF SET LARGE 100 GR A.jpg', 'on', '0000-00-00', NULL, NULL),
(148, 17, 1165, 'So standart us beef 100 gr a', 'food', 'menu', 1, 'SO STANDART US BEEF 100 GR A.jpg', 'off', '0000-00-00', NULL, NULL),
(149, 14, 1150, 'australian rib eye set regular 50 gr a', 'food', 'menu', 1, 'AUSTRALIAN RIB EYE SET REGULAR 50 GR A.jpg', 'on', '0000-00-00', NULL, NULL),
(150, 14, 1151, 'australian rib eye set large 100 gr a', 'food', 'menu', 1, 'AUSTRALIAN RIB EYE SET LARGE 100 GR A.jpg', 'on', '0000-00-00', NULL, NULL),
(151, 17, 1166, 'So australian rib eye  100 gr a', 'food', 'menu', 1, 'SO AUSTRALIAN RIB EYE  100 GR A.jpg', 'off', '0000-00-00', NULL, NULL),
(152, 1, 1113, 'beef yakiniku a', 'food', 'menu', 1, 'BEEF YAKINIKU A.jpg', 'on', '0000-00-00', NULL, NULL),
(153, 1, 1115, 'beef teriyaki a', 'food', 'menu', 1, 'BEEF TERIYAKI A.jpg', 'on', '0000-00-00', NULL, NULL),
(154, 7, 1127, 'yakiniku don a', 'food', 'menu', 1, 'YAKINIKU DON A.jpg', 'on', '0000-00-00', NULL, NULL),
(155, 4, 1175, 'yakiniku bento dan ebi tempura a', 'food', 'menu', 1, 'YAKINIKU BENTO, EBI TEMPURA, SALMON HARUMAKI.jpg', 'on', '0000-00-00', NULL, NULL),
(156, 4, 1448, 'beef yakiniku bento dan ebi tempura a', 'food', 'menu', 1, 'YAKINIKU BENTO, EBI TEMPURA, SALMON HARUMAKI.jpg', 'on', '0000-00-00', NULL, NULL),
(157, 11, 11, 'Ongkir delivery', 'food', 'menu', 1, 'ONGKIR DELIVERY.jpg', 'on', '0000-00-00', NULL, NULL),
(158, 4, 1176, 'yakiniku bento dan salmon harumaki a', 'food', 'menu', 1, 'YAKINIKU BENTO, EBI TEMPURA, SALMON HARUMAKI.jpg', 'on', '0000-00-00', NULL, NULL),
(159, 5, 3025, 'ice tea (tawar)', 'food', 'menu', 1, 'ICE TEA (TAWAR).jpg', 'on', '0000-00-00', NULL, NULL),
(160, 5, 3026, 'ice tea (manis)', 'food', 'menu', 1, 'ICE TEA (MANIS).jpg', 'on', '0000-00-00', NULL, NULL),
(161, 5, 3027, 'hot tea (tawar)', 'food', 'menu', 1, 'HOT TEA (TAWAR).jpg', 'on', '0000-00-00', NULL, NULL),
(162, 5, 3028, 'hot tea (manis)', 'food', 'menu', 1, 'HOT TEA (MANIS).jpg', 'on', '0000-00-00', NULL, NULL),
(163, 5, 3029, 'hot water (free)', 'food', 'menu', 1, 'HOT WATER (FREE).jpg', 'on', '0000-00-00', NULL, NULL),
(164, 5, 1479, 'oreo tempura ice cream', 'food', 'menu', 1, 'OREO TEMPURA ICE CREAM.jpg', 'on', '0000-00-00', NULL, NULL),
(165, 9, 3030, 'Topper', 'food', 'menu', 1, 'TOPPER.jpg', 'on', '0000-00-00', NULL, NULL),
(166, 4, 1449, 'beef yakiniku bento salmon harumaki a', 'food', 'menu', 1, 'YAKINIKU BENTO, EBI TEMPURA, SALMON HARUMAKI.jpg', 'on', '0000-00-00', NULL, NULL),
(167, 18, 3031, 'Mango sushi roll', 'food', 'menu', 1, 'WhatsApp_Image_2021-09-29_at_16_10_11.jpeg', 'on', '0000-00-00', NULL, NULL),
(168, 26, 3032, 'Chirashi Custom 5 layer', 'food', 'menu', 1, 'CHIRASHI CUSTOM 6 LAYER.jpg', 'on', '0000-00-00', NULL, NULL),
(169, 18, 3033, 'Ika aburi shimeji', 'food', 'menu', 1, 'IKA ABURI SHIMEJI.jpg', 'on', '0000-00-00', NULL, NULL),
(170, 18, 3035, 'Ebi aburi beef', 'food', 'menu', 1, 'EBI ABURI BEEF.jpg', 'on', '0000-00-00', NULL, NULL),
(171, 18, 3037, 'inari', 'food', 'menu', 1, 'INARI.jpg', 'on', '0000-00-00', NULL, NULL),
(172, 18, 3039, 'inari tamago', 'food', 'menu', 1, 'INARI TAMAGO.jpg', 'on', '0000-00-00', NULL, NULL),
(173, 18, 3041, 'inari chuka idako salad', 'food', 'menu', 1, 'INARI CHUKA IDAKO SALAD.jpg', 'on', '0000-00-00', NULL, NULL),
(174, 18, 3043, 'inari jellyfish', 'food', 'menu', 1, 'INARI JELLYFISH.jpg', 'on', '0000-00-00', NULL, NULL),
(175, 18, 3045, 'inari chuka wakame salad', 'food', 'menu', 1, 'INARI CHUKA WAKAME SALAD.jpg', 'on', '0000-00-00', NULL, NULL),
(176, 18, 3047, 'inari kyuri kani salad', 'food', 'menu', 1, 'INARI KYURI KANI SALAD.jpg', 'on', '0000-00-00', NULL, NULL),
(177, 18, 3049, 'magic chirashi', 'food', 'menu', 1, 'MAGIC CHIRASHI.jpg', 'on', '0000-00-00', NULL, NULL),
(178, 3, 3051, 'chawan mushi unagi', 'food', 'menu', 1, 'CHAWAN MUSHI UNAGI.jpg', 'on', '0000-00-00', NULL, NULL),
(179, 3, 3053, 'chawan mushi ebi', 'food', 'menu', 1, 'CHAWAN MUSHI EBI.jpg', 'on', '0000-00-00', NULL, NULL),
(180, 3, 3055, 'chuka wakame salad', 'food', 'menu', 1, 'CHUKA WAKAME SALAD.jpg', 'on', '0000-00-00', NULL, NULL),
(181, 3, 3057, 'jellyfish salad', 'food', 'menu', 1, 'JELLYFISH SALAD.jpg', 'on', '0000-00-00', NULL, NULL),
(182, 3, 3059, 'chuka idako salad', 'food', 'menu', 1, 'CHUKA IDAKO SALAD.jpg', 'on', '0000-00-00', NULL, NULL),
(183, 3, 1475, 'DRINK AT BAR TAKEMORI', 'drink', 'menu', 1, 'notfound.png', 'on', NULL, NULL, NULL),
(184, 3, 1466, 'AVOCADO JUICE', 'drink', 'menu', 1, 'AVOCADO JUICE.jpg', 'on', NULL, NULL, NULL),
(185, 3, 1468, 'GREEN TEA ICE CREAM', 'drink', 'menu', 1, 'GREEN TEA ICE CREAM.jpg', 'on', NULL, NULL, NULL),
(186, 3, 1469, 'GREEN TEA MILKSHAKE', 'drink', 'menu', 1, 'GREEN TEA MILKSHAKE.jpg', 'on', NULL, NULL, NULL),
(187, 3, 1470, 'ICE LEMON TEA', 'drink', 'menu', 1, 'ICE LEMON TEA.jpg', 'on', NULL, NULL, NULL),
(188, 3, 1471, 'LEMON JUICE', 'drink', 'menu', 1, 'LEMON JUICE.jpg', 'on', NULL, NULL, NULL),
(189, 3, 1472, 'MINERAL WATER', 'drink', 'menu', 1, 'MINERAL WATER.jpg', 'on', NULL, NULL, NULL),
(190, 1, 1473, 'STRAWBERRY JUICE', 'drink', 'menu', 1, 'STRAWBERRY JUICE.jpg', 'on', NULL, NULL, NULL),
(191, 1, 1474, 'BIRDNEST COLLAGEN', 'drink', 'menu', 1, 'BIRDNEST COLLAGEN SDB.jpg', 'on', NULL, NULL, NULL),
(192, 1, 1476, 'SOJU ORIGINAL', 'drink', 'menu', 1, 'SOJU ORIGINAL.jpg', 'on', NULL, NULL, NULL),
(193, 1, 1477, 'SOJU PEACH', 'drink', 'menu', 1, 'SOJU PEACH.jpg', 'on', NULL, NULL, NULL),
(194, 1, 1478, 'SOJU GRAPEFRUIT', 'drink', 'menu', 1, 'SOJU GRAPEFRUIT.jpg', 'on', NULL, NULL, NULL),
(195, 2, 2101, 'NAMURU MORI', 'food', 'menu', 1, 'NAMURU MORI.jpg', 'on', NULL, NULL, NULL),
(196, 2, 2102, 'CHIJIMI', 'food', 'menu', 1, 'CHIJIMI.jpg', 'on', NULL, NULL, NULL),
(197, 2, 2103, 'KIMCHI', 'food', 'menu', 1, 'KIMCHI.jpg', 'on', NULL, NULL, NULL),
(198, 2, 2104, 'SANCHU', 'food', 'menu', 1, 'SANCHU.jpg', 'on', NULL, NULL, NULL),
(199, 2, 2105, 'JAKKOTOFU', 'food', 'menu', 1, 'JAKKOTOFU.jpg', 'on', NULL, NULL, NULL),
(200, 2, 2106, 'JAPCHAE', 'food', 'menu', 1, 'JAPCHAE.jpg', 'on', NULL, NULL, NULL),
(201, 8, 2107, 'KYURI SALAD', 'food', 'menu', 2, 'KYURI SALAD.jpg', 'on', NULL, NULL, NULL),
(202, 2, 2108, 'FREE RICE', 'food', 'menu', 2, 'FREE RICE.jpg', 'on', NULL, NULL, NULL),
(203, 2, 2109, 'CHICKEN KUPPA', 'food', 'menu', 2, 'CHICKEN KUPPA.jpg', 'on', NULL, NULL, NULL),
(204, 16, 2110, 'YUKKEJANG SOUP', 'food', 'menu', 2, 'YUKKEJANG SOUP.jpg', 'on', NULL, NULL, NULL),
(205, 16, 2111, 'KIMCHI JIGAE', 'food', 'menu', 2, 'KIMCHI JIGAE.jpg', 'on', NULL, NULL, NULL),
(206, 16, 2112, 'CHICKEN COLLAGEN SOUP', 'food', 'menu', 2, 'CHICKEN COLLAGEN SOUP.jpg', 'on', NULL, NULL, NULL),
(207, 16, 2113, 'KOMUTAN SOUP', 'food', 'menu', 2, 'KOMUTAN SOUP.jpg', 'on', NULL, NULL, NULL),
(208, 16, 2114, 'SOONDOBU JIGAE', 'food', 'menu', 2, 'SOONDOBU JIGAE.jpg', 'on', NULL, NULL, NULL),
(209, 6, 2115, 'BIBIMBAP', 'food', 'menu', 2, 'BIBIMBAP.jpg', 'on', NULL, NULL, NULL),
(210, 8, 2116, 'WAGYU BULGOGI', 'food', 'menu', 2, 'WAGYU BULGOGI.jpg', 'off', NULL, NULL, NULL),
(211, 8, 2117, 'SIRLOIN BULGOGI', 'food', 'menu', 2, 'SIRLOIN BULGOGI.jpg', 'off', NULL, NULL, NULL),
(212, 8, 2118, 'SAIKORO BULGOGI', 'food', 'menu', 2, 'SAIKORO BULGOGI.jpg', 'off', NULL, NULL, NULL),
(213, 8, 2119, 'YAKIBELLY BULGOGI', 'food', 'menu', 2, 'YAKIBELLY BULGOGI.jpg', 'off', NULL, NULL, NULL),
(214, 8, 2120, 'GYU TAN-NEGI', 'food', 'menu', 2, 'GYU TAN-NEGI.jpg', 'off', NULL, NULL, NULL),
(215, 8, 2121, 'TENDERLOIN BULGOGI', 'food', 'menu', 2, 'TENDERLOIN BULGOGI.jpg', 'off', NULL, NULL, NULL),
(216, 8, 2123, 'EBI SHIO', 'food', 'menu', 2, 'EBI SHIO.jpg', 'on', NULL, NULL, NULL),
(217, 8, 2124, 'CHICKEN BULGOGI', 'food', 'menu', 2, 'CHICKEN BULGOGI.jpg', 'on', NULL, NULL, NULL),
(218, 2, 2125, 'CHILLY SEAFOOD RAMEN', 'food', 'menu', 2, 'CHILLY SEAFOOD RAMEN.jpg', 'on', NULL, NULL, NULL),
(219, 2, 2126, 'GYOZA BEEF', 'food', 'menu', 2, 'GYOZA BEEF.jpg', 'on', NULL, NULL, NULL),
(220, 2, 2127, 'MOMO KUSHI YAKITORI', 'food', 'menu', 2, 'MOMO KUSHI YAKITORI.jpg', 'on', NULL, NULL, NULL),
(221, 2, 2128, 'SOBORO DON BEEF', 'food', 'menu', 2, 'SOBORO DON BEEF.jpg', 'on', NULL, NULL, NULL),
(222, 12, 2129, 'SDB PAKET A', 'food', 'menu', 2, 'PAKET A.jpg', 'off', NULL, NULL, NULL),
(223, 12, 2130, 'SDB PAKET B', 'food', 'menu', 2, 'PAKET B.jpg', 'off', NULL, NULL, NULL),
(224, 2, 2139, 'YAKI UDON SDB', 'food', 'menu', 2, 'YAKI UDON SDB.jpg', 'on', NULL, NULL, NULL),
(225, 2, 2141, 'CHILLY DORI SAMBEL MATAH', 'food', 'menu', 2, 'CHILLY DORI SAMBEL MATAH.jpg', 'on', NULL, NULL, NULL),
(226, 2, 2142, 'CHILLY SALMON', 'food', 'menu', 2, 'CHILLY SALMON.jpg', 'on', NULL, NULL, NULL),
(227, 2, 2143, 'FISH BEE HOON (HEAD)', 'food', 'menu', 2, 'FISH BEE HOON (HEAD).jpg', 'on', NULL, NULL, NULL),
(228, 2, 2144, 'FISH BEE HOON ORIGINAL', 'food', 'menu', 2, 'FISH BEE HOON (ORIGINAL).jpg', 'on', NULL, NULL, NULL),
(229, 2, 2145, 'KORO KORO DON', 'food', 'menu', 2, 'KORO KORO DON.jpg', 'on', NULL, NULL, NULL),
(230, 2, 2146, 'RICE', 'food', 'menu', 2, 'RICE.jpg', 'on', NULL, NULL, NULL),
(231, 2, 2147, 'TEBASAKI', 'food', 'menu', 2, 'TEBASAKI.jpg', 'on', NULL, NULL, NULL),
(232, 8, 2148, 'WAGYU ORIGINAL SAUCE', 'food', 'menu', 2, 'WAGYU ORIGINAL SAUCE.jpg', 'off', NULL, NULL, NULL),
(233, 8, 2149, 'WAGYU SHIO', 'food', 'menu', 2, 'WAGYU SHIO.jpg', 'off', NULL, NULL, NULL),
(234, 8, 2150, 'WAGYU SPICY SAUCE', 'food', 'menu', 2, 'WAGYU SPICY SAUCE.jpg', 'off', NULL, NULL, NULL),
(235, 8, 2151, 'SIRLOIN ORIGINAL SAUCE', 'food', 'menu', 2, 'SIRLOIN ORIGINAL SAUCE.jpg', 'off', NULL, NULL, NULL),
(236, 8, 2152, 'SIRLOIN SHIO', 'food', 'menu', 2, 'SIRLOIN SHIO.jpg', 'off', NULL, NULL, NULL),
(237, 8, 2153, 'SIRLOIN SPICY SAUCE', 'food', 'menu', 2, 'SIRLOIN SPICY SAUCE.jpg', 'off', NULL, NULL, NULL),
(238, 8, 2154, 'SAIKORO ORIGINAL SAUCE', 'food', 'menu', 2, 'SAIKORO.jpg', 'off', NULL, NULL, NULL),
(239, 8, 2155, 'SAIKORO SHIO', 'food', 'menu', 2, 'SAIKORO.jpg', 'off', NULL, NULL, NULL),
(240, 8, 2156, 'SAIKORO SPICY SAUCE', 'food', 'menu', 2, 'SAIKORO.jpg', 'off', NULL, NULL, NULL),
(241, 8, 2157, 'YAKIBELLY ORIGINAL SAUCE', 'food', 'menu', 2, 'YAKIBELLY.jpg', 'off', NULL, NULL, NULL),
(242, 8, 2158, 'YAKIBELLY SHIO', 'food', 'menu', 2, 'YAKIBELLY.jpg', 'off', NULL, NULL, NULL),
(243, 8, 2159, 'YAKIBELLY SPICY SAUCE', 'food', 'menu', 2, 'YAKIBELLY.jpg', 'off', NULL, NULL, NULL),
(244, 8, 2160, 'GYU TAN-SHIO', 'food', 'menu', 2, 'GYU TAN.jpg', 'off', NULL, NULL, NULL),
(245, 8, 2161, 'GYU TAN-TARE', 'food', 'menu', 2, 'GYU TAN.jpg', 'off', NULL, NULL, NULL),
(246, 8, 2162, 'TENDERLOIN ORIGINAL SAUCE', 'food', 'menu', 2, 'TENDERLOIN.jpg', 'off', NULL, NULL, NULL),
(247, 8, 2163, 'TENDERLOIN SHIO', 'food', 'menu', 2, 'TENDERLOIN.jpg', 'off', NULL, NULL, NULL),
(248, 8, 2164, 'TENDERLOIN SPICY SAUCE', 'food', 'menu', 2, 'TENDERLOIN.jpg', 'off', NULL, NULL, NULL),
(249, 8, 2165, 'CHICKEN ORIGINAL SAUCE', 'food', 'menu', 2, 'CHICKEN.jpg', 'on', NULL, NULL, NULL),
(250, 8, 2166, 'CHICKEN SHIO', 'food', 'menu', 2, 'CHICKEN.jpg', 'on', NULL, NULL, NULL),
(251, 8, 2167, 'CHICKEN SPICY SAUCE ', 'food', 'menu', 2, 'CHICKEN.jpg', 'on', NULL, NULL, NULL),
(253, 8, 2122, 'dori grill spicy sauce', 'food', 'menu', 2, 'SPICY DORI.jpg', 'on', NULL, NULL, NULL),
(254, 6, 2133, 'BIBIMBAP 2', 'food', 'menu', 2, 'BIBIMBAP II.jpg', 'on', NULL, NULL, NULL),
(255, 6, 2169, 'TAMAGO YAKI', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(256, 2, 2225, 'KIMCHI PACK SDB', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(257, 2, 2106, 'FREE JAPHAE', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(265, 2, 2106, 'FREE JAPCHAE BIRTHDAY', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(266, 2, 2226, 'KIMCHI JAR SDB', 'food', 'menu', 2, 'KIMCHI JAR.jpg', 'on', NULL, NULL, NULL),
(267, 2, 2195, 'bubur', 'food', 'menu', 2, 'BUBUR.jpg', 'on', NULL, NULL, NULL),
(268, 2, 2195, 'FREE BUBUR', 'food', 'menu', 2, 'BUBUR.jpg', 'on', NULL, NULL, NULL),
(269, 2, 2228, 'SOONDOBU EXPRESS RICE EGG SET', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(270, 2, 2229, 'SOONDOBU EXPRESS CHICKEN FILLET', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(271, 2, 2230, 'SOONDOBU EXPRESS FISH CAKE', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(272, 2, 2231, 'SOONDOBU EXPRESS SAUSAGE', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(273, 2, 2232, 'SOONDOBU EXPRESS FISH BALL', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(274, 2, 2196, 'SAMOSA PLATTER', 'food', 'menu', 2, 'SAMOSA.jpg', 'on', NULL, NULL, NULL),
(275, 2, 2197, 'GYOZA PLATTER', 'food', 'menu', 2, 'GYOZA.jpg', 'on', NULL, NULL, NULL),
(276, 2, 2242, 'SOONDOBU EXPRESS DAK GALBI SUNDEE', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(277, 2, 2239, 'SOONDOBU EXPRESS GOON MANDU SIOMAY', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(278, 2, 2240, 'SOONDOBU EXPRESS SOSIS ODENG IKAN', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(279, 2, 2241, 'SOONDOBU EXPRESS ODENG ROLL', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(280, 2, 2238, 'SELADA', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(281, 12, 2254, 'SOONDOBU CHRISTMAS SET', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(282, 8, 3010, 'PATIN', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(283, 8, 3011, 'SALMON', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(284, 8, 3012, 'PATIN SHIO', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(304, 8, 3035, 'tuna', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(305, 2, 2244, 'SOONDOBU EXPRESS BASIC RICE', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(306, 8, 2117, 'sirloin bulgogi', 'food', 'menu', 2, 'SIRLOIN.jpg', 'on', NULL, NULL, NULL),
(307, 8, 2151, 'sirloin original sauce', 'food', 'menu', 2, 'SIRLOIN.jpg', 'on', NULL, NULL, NULL),
(308, 8, 2152, 'sirloin shio A', 'food', 'menu', 2, 'SIRLOIN.jpg', 'on', NULL, NULL, NULL),
(309, 8, 2153, 'sirloin spicy sauce', 'food', 'menu', 2, 'SIRLOIN.jpg', 'on', NULL, NULL, NULL),
(310, 8, 2121, 'tenderloin bulgogi', 'food', 'menu', 2, 'TENDERLOIN.jpg', 'on', NULL, NULL, NULL),
(311, 8, 2162, 'tenderloin original sauce', 'food', 'menu', 2, 'TENDERLOIN.jpg', 'on', NULL, NULL, NULL),
(312, 8, 2163, 'tenderloin shio A', 'food', 'menu', 2, 'TENDERLOIN.jpg', 'on', NULL, NULL, NULL),
(313, 8, 2164, 'tenderloin spicy sauce', 'food', 'menu', 2, 'TENDERLOIN.jpg', 'on', NULL, NULL, NULL),
(314, 8, 2119, 'yakibelly bulgogi', 'food', 'menu', 2, 'YAKIBELLY.jpg', 'on', NULL, NULL, NULL),
(315, 8, 2157, 'yakibelly original sauce', 'food', 'menu', 2, 'YAKIBELLY.jpg', 'on', NULL, NULL, NULL),
(316, 8, 2158, 'yakibelly shio A', 'food', 'menu', 2, 'YAKIBELLY.jpg', 'on', NULL, NULL, NULL),
(317, 12, 2130, 'sdb paket b A', 'food', 'menu', 2, 'PAKET B.jpg', 'on', NULL, NULL, NULL),
(318, 12, 2129, 'sdb paket a A', 'food', 'menu', 2, 'PAKET A.jpg', 'on', NULL, NULL, NULL),
(319, 8, 2160, 'gyu tan-shio A', 'food', 'menu', 2, 'GYU TAN.jpg', 'on', NULL, NULL, NULL),
(320, 8, 2120, 'gyu tan-negi A', 'food', 'menu', 2, 'GYU TAN.jpg', 'on', NULL, NULL, NULL),
(321, 8, 2161, 'gyu tan-tare A', 'food', 'menu', 2, 'GYU TAN.jpg', 'on', NULL, NULL, NULL),
(323, 8, 2159, 'yakibelly spicy sauce', 'food', 'menu', 2, 'YAKIBELLY.jpg', 'on', NULL, NULL, NULL),
(328, 23, 1479, 'oreo tempura ice cream', 'food', 'menu', 2, 'OREO TEMPURA ICE CREAM.jpg', 'on', NULL, NULL, NULL),
(329, 8, 2118, 'saikoro bulgogi', 'food', 'menu', 2, 'SAIKORO.jpg', 'on', NULL, NULL, NULL),
(330, 8, 2154, 'saikoro original sauce', 'food', 'menu', 2, 'SAIKORO.jpg', 'on', NULL, NULL, NULL),
(331, 8, 2155, 'saikoro shio A', 'food', 'menu', 2, 'SAIKORO.jpg', 'on', NULL, NULL, NULL),
(332, 8, 2156, 'saikoro spicy sauce', 'food', 'menu', 2, 'SAIKORO.jpg', 'on', NULL, NULL, NULL),
(333, 8, 2116, 'wagyu bulgogi', 'food', 'menu', 2, 'WAGYU.jpg', 'on', NULL, NULL, NULL),
(334, 8, 2148, 'wagyu original sauce', 'food', 'menu', 2, 'WAGYU.jpg', 'on', NULL, NULL, NULL),
(335, 8, 2149, 'wagyu shio A', 'food', 'menu', 2, 'WAGYU.jpg', 'on', NULL, NULL, NULL),
(336, 8, 2150, 'wagyu spicy sauce', 'food', 'menu', 2, 'WAGYU.jpg', 'on', NULL, NULL, NULL),
(337, 12, 2168, 'sumo beef paket c', 'food', 'menu', 2, 'SUMO BEEF.jpg', 'on', NULL, NULL, NULL),
(338, 8, 3036, 'hampers seoul', 'food', 'menu', 2, 'notfound.png', 'off', NULL, NULL, NULL),
(339, 8, 3037, 'hampers busan', 'food', 'menu', 2, 'notfound.png', 'off', NULL, NULL, NULL),
(340, 8, 3038, 'hampers incheon', 'food', 'menu', 2, 'notfound.png', 'off', NULL, NULL, NULL),
(341, 2, 3039, 'gimbap', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(342, 2, 3040, 'gimbap cheese', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(343, 2, 3041, 'bokkeumbap', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(344, 2, 3042, 'champong ramyun', 'food', 'menu', 2, 'notfound.png', 'off', NULL, NULL, NULL),
(345, 8, 3043, 'karubi shio', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(346, 8, 3044, 'karubi original sauce', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(347, 8, 3045, 'karubi spicy sauce', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(348, 8, 3046, 'karubi bulgogi', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(349, 12, 3047, 'Soondobu express 1', 'food', 'menu', 2, 'notfound.png', 'off', NULL, NULL, NULL),
(350, 12, 3010, 'Patin sdb express', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(351, 8, 3055, 'udang premium bulgogi', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(352, 8, 3055, 'udang premium original sauce', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(353, 8, 3055, 'Udang premium shio', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(354, 8, 3055, 'Udang premium spicy saus', 'food', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(355, 23, 2180, 'GENMAICHA REFILL SDB', 'drink', 'menu', 2, 'GENMAICHA.jpg', 'on', NULL, NULL, NULL),
(356, 23, 2170, 'AVOCADO JUICE SDB', 'drink', 'menu', 2, 'AVOCADO JUICE SDB.jpg', 'on', NULL, NULL, NULL),
(357, 23, 2171, 'BIR BINTANG BJ SDB', 'drink', 'menu', 2, 'BIR BINTANG BJ.jpg', 'on', NULL, NULL, NULL),
(358, 23, 2172, 'GREEN TEA ICE CREAM SDB', 'drink', 'menu', 2, 'GREEN TEA ICE CREAM.jpg', 'on', NULL, NULL, NULL),
(359, 23, 2173, 'GREEN TEA MILKSHAKE SDB', 'drink', 'menu', 2, 'GREEN TEA MILKSHAKE.jpg', 'on', NULL, NULL, NULL),
(360, 23, 2174, 'ICE LEMON TEA SDB', 'drink', 'menu', 2, 'ICE LEMON TEA.jpg', 'on', NULL, NULL, NULL),
(361, 23, 2175, 'LEMON JUICE SDB', 'drink', 'menu', 2, 'LEMON JUICE.jpg', 'on', NULL, NULL, NULL),
(362, 23, 2176, 'MINERAL WATER SDB', 'drink', 'menu', 2, 'MINERAL WATER.jpg', 'on', NULL, NULL, NULL),
(363, 23, 2177, 'STRAWBERRY JUICE SDB', 'drink', 'menu', 2, 'STRAWBERRY JUICE.jpg', 'on', NULL, NULL, NULL),
(364, 23, 2178, 'BIRDNEST COLLAGEN SDB', 'drink', 'menu', 2, 'BIRDNEST COLLAGEN.jpg', 'off', NULL, NULL, NULL),
(365, 23, 2181, 'SOJU ORIGINAL SDB', 'drink', 'menu', 2, 'SOJU ORIGINAL.jpg', 'on', NULL, NULL, NULL),
(366, 23, 2182, 'SOJU PEACH SDB', 'drink', 'menu', 2, 'SOJU PEACH.jpg', 'on', NULL, NULL, NULL),
(367, 23, 2183, 'SOJU GRAPEFRUIT SDB', 'drink', 'menu', 2, 'SOJU GRAPEFRUIT.jpg', 'on', NULL, NULL, NULL),
(368, 23, 2179, 'DRINK AT BAR SDB', 'drink', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(369, 23, 2184, 'COFFEE LATTE HOT', 'drink', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(370, 23, 2185, 'COFFEE LATTE COLD', 'drink', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(371, 23, 2186, 'COFFEE HITAM HOT', 'drink', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(372, 23, 2187, 'COFFEE HITAM COLD', 'drink', 'menu', 2, 'notfound.png', 'on', NULL, NULL, NULL),
(374, 23, 3033, 'GENMAICHA 1 LITRE', 'drink', 'menu', 2, 'GENMAICHA.jpg', 'on', NULL, NULL, NULL),
(375, 23, 2180, 'genmaicha 1 liter', 'drink', 'menu', 2, 'GENMAICHA.jpg', 'on', NULL, NULL, NULL),
(376, 1, 3061, 'chicken katsu curry', 'food', '', 1, '', 'on', NULL, NULL, NULL),
(377, 1, 3062, 'grilled chicken curry', 'food', '', 1, '', 'on', NULL, NULL, NULL),
(378, 1, 3063, 'beef curry', 'food', '', 1, '', 'on', NULL, NULL, NULL),
(379, 1, 3064, 'fat fish curry', 'food', '', 1, '', 'on', NULL, NULL, NULL),
(380, 17, 3065, 'so beef enoki roll', 'food', '', 1, '', 'on', NULL, NULL, NULL),
(381, 2, 2101, 'NAMURU MORI', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(382, 2, 2102, 'CHIJIMI', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(383, 2, 2103, 'kimchi', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(384, 2, 2104, 'SANCHU', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(385, 2, 2105, 'JAKKOTOFU', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(386, 2, 2106, 'JAPCHAE', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(387, 8, 3056, 'Beef Enoki Roll', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(388, 2, 2128, 'soboro don beef ', 'food', '', 2, '', 'off', NULL, NULL, NULL),
(389, 12, 2168, 'paket c', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(390, 8, 3057, 'Marshmallow', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(391, 18, 3067, 'fortune boat', 'food', '', 1, '', 'on', NULL, NULL, NULL),
(392, 25, 3049, 'set 1 Basic rice, Odeng sausage, Chicken Fillet', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(393, 25, 3049, 'set 2 Basic rice, Patin, Fish cake', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(394, 25, 3050, 'set 3 Basic rice, Sausage, Fish cake', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(395, 25, 3051, 'set 4 basic rice, sausage, dak galbi', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(396, 25, 3052, 'set 5 basic rice, odeng roll, fish ball, goon mandu', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(397, 25, 3053, 'set 6 basic rice, odeng sausage, chicken fillet', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(398, 25, 3054, 'set 7 basic rice, patin, fish cake', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(399, 8, 3058, 'Squid', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(400, 8, 3059, 'garlic satay', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(401, 8, 3060, 'green onion satay', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(402, 8, 3061, 'onion satay', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(403, 2, 3062, 'Calamari', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(404, 2, 3063, 'Potato wedges', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(405, 26, 3068, 'Chirashi Nagoya', 'food', '', 1, '', 'on', NULL, NULL, NULL),
(406, 26, 3069, 'Chirashi Osaka', 'food', '', 1, '', 'on', NULL, NULL, NULL),
(407, 26, 3070, 'Chirashi Yokohama', 'food', '', 1, '', 'on', NULL, NULL, NULL),
(408, 26, 3071, 'Hampers Kanazawa', 'food', '', 1, '', 'on', NULL, NULL, NULL),
(409, 26, 3072, 'Hampers Tokyo', 'food', '', 1, '', 'on', NULL, NULL, NULL),
(410, 26, 3073, 'Hampers Kyoto', 'food', '', 1, '', 'on', NULL, NULL, NULL),
(411, 8, 3064, 'hampers', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(412, 2, 3065, 'pa muchim (green onion salad)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(413, 2, 3066, 'oi muchim (cucumber)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(414, 12, 3067, 'Banchan jangmi 6', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(415, 2, 3068, 'B.jangmi selada (1)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(417, 2, 3070, 'B.jangmi kimchi (2)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(420, 2, 3073, 'B.jangmi namuru mori (3)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(422, 2, 3075, 'B.jangmi pa muchim (4)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(423, 2, 3076, 'B.jangmi oi muchim (5)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(424, 8, 3077, 'Sausage', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(426, 2, 3078, 'B.jangmi gamja jorim (6)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(427, 12, 3079, 'Set D: (21 items)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(428, 12, 3080, 'Set.D rice/bubur (1-4) (kasi ket jumlah)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(430, 12, 3082, 'Set.D selada (5)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(431, 12, 3083, 'Set.D kimchi 2 buah (6 & 7) ', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(432, 12, 3084, 'Set.D namoru mori (8)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(433, 12, 3085, 'Set.D pa muchim (9)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(434, 12, 3086, 'Set.D oi muchim (10)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(435, 12, 3087, 'Set.D kimchi jigae (11)', 'drink', '', 2, '', 'on', NULL, NULL, NULL),
(436, 12, 3088, 'Set.D komutan soup (12)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(437, 12, 3089, 'Set.D wagyu (13)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(438, 12, 3090, '	Set.D saikoro (14)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(439, 12, 3091, '	Set.D yakibelly (15)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(440, 12, 3092, 'Set.D ebi shio (16)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(441, 12, 3093, 'Set.D sausage (17)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(442, 12, 3094, 'Set.D patin (18)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(443, 12, 3095, 'Set.D garlic satay (19)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(444, 12, 3096, 'Set.D green onion satay (20)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(445, 12, 3097, 'Set.D marshmallow (21)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(453, 12, 3100, 'Set E: (21 items)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(454, 12, 3101, 'Set.E rice/bubur (1-3) (kasi ket jumlah)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(456, 12, 3103, 'Set.E selada (4)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(457, 12, 3104, 'Set.E kimchi 2 buah (5 & 6)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(458, 12, 3105, 'Set.E namoru mori (7)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(459, 12, 3106, 'Set.E pa muchim (8)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(460, 12, 3107, 'Set.E oi muchim (9)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(461, 12, 3108, 'Set.E gamja jorim (10)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(462, 12, 3109, 'Set.E gimbap (11)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(463, 12, 3110, 'Set.E japchae (12)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(464, 12, 3111, 'Set.E ebi bulgogi (13)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(465, 12, 3112, 'Set.E patin (14)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(466, 12, 3113, 'Set.E squid (15)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(467, 12, 3114, 'Set.E dori (16)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(468, 12, 3115, 'Set.E udang premium (17)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(469, 12, 3116, 'Set.E salmon (18)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(470, 12, 3117, 'Set.E marshmallow (19)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(471, 12, 3118, 'Set.E onion satay  (20)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(472, 12, 3119, 'Set.E green onion satay  (21)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(473, 12, 3120, 'Set F: (20 items)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(474, 12, 3121, 'Set.F rice/bubur (1-2) (kasi ket jumlah)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(476, 12, 3123, 'Set.F selada (3)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(477, 12, 3124, 'Set.F kimchi 2 buah (4 & 5)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(478, 12, 3125, 'Set.F namoru mori (6)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(479, 12, 3126, 'Set.F pa muchim (7)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(480, 12, 3127, 'Set.F oi muchim (8)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(481, 12, 3128, 'Set.F chicken collagen soup (9)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(482, 12, 3129, 'Set.F yukkejang soup (10)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(483, 12, 3130, 'Set.F cheese gimbap (11)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(484, 12, 3131, 'Set.F yakibelly (12)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(485, 12, 3132, 'Set.F karubi (13)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(486, 12, 3133, 'Set.F beef enoki roll (14)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(487, 12, 3134, 'Set.F saikoro (15)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(488, 12, 3135, 'Set.F salmon (16)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(489, 12, 3136, 'Set.F patin (17)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(490, 12, 3137, 'Set.F chicken (18)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(491, 12, 3138, 'Set.F onion satay (20)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(492, 12, 3139, 'Set.F garlic satay (21)', 'food', '', 2, '', 'on', NULL, NULL, NULL),
(499, 2, 3074, 'abhsen', 'food', '', 1, 'EABS.png', 'on', NULL, '2022-03-09 08:13:27', '2022-03-09 08:13:27'),
(500, 3, 3075, 'tes', 'food', '', 1, 'EABS.png', 'on', NULL, '2022-03-09 08:19:47', '2022-03-09 08:19:47');

-- --------------------------------------------------------

--
-- Table structure for table `tb_navbar`
--

CREATE TABLE `tb_navbar` (
  `id_navbar` int(11) NOT NULL,
  `navbar` varchar(100) NOT NULL,
  `img` varchar(100) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `rot` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_navbar`
--

INSERT INTO `tb_navbar` (`id_navbar`, `navbar`, `img`, `jenis`, `rot`, `created_at`, `updated_at`) VALUES
(1, 'Absen', 'calendar.png', 'navbar', 'absen', NULL, NULL),
(2, 'Add Koki', 'add-user.png', 'navbar', 'addKoki', NULL, NULL),
(3, 'Catatan', 'notebook.png', 'sub', 'driver', NULL, NULL),
(4, 'Database', 'server.png', 'sub', 'kasbon', NULL, NULL),
(5, 'Peringatan', '', 'sub', 'dp', NULL, NULL),
(6, 'Discount', 'discount.png', 'navbar', 'discount', NULL, NULL),
(21, 'Akun', 'accounting.png', 'navbar', 'accounting', NULL, NULL),
(22, 'Gaji', 'gaji.png', 'navbar', 'gaji', NULL, NULL),
(25, 'Order', 'order.png', 'navbar', 'order', NULL, NULL),
(26, 'Meja', 'stack.png', 'navbar', 'meja', NULL, NULL),
(27, 'Tugas Head', 'chef-hat.png', 'navbar', 'head', NULL, NULL),
(28, 'Laporan', 'report.png', 'navbar', 'laporan', NULL, NULL),
(29, 'Orderan', 'order2.png', 'subnavbar', 'orderan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_ongkir`
--

CREATE TABLE `tb_ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `nama_ongkir` varchar(200) NOT NULL,
  `rupiah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_ongkir`
--

INSERT INTO `tb_ongkir` (`id_ongkir`, `nama_ongkir`, `rupiah`, `created_at`, `updated_at`) VALUES
(1, 'Driver Delivery', 30000, NULL, NULL),
(2, 'Resto', 15000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `id_order` int(11) NOT NULL,
  `no_order` varchar(20) NOT NULL,
  `id_harga` int(11) NOT NULL,
  `qty` double NOT NULL,
  `harga` double NOT NULL,
  `request` varchar(100) DEFAULT NULL,
  `tambahan` int(11) NOT NULL,
  `page` int(11) NOT NULL,
  `id_meja` int(11) NOT NULL,
  `selesai` enum('dimasak','selesai','diantar') NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `pengantar` varchar(20) DEFAULT NULL,
  `tgl` date NOT NULL,
  `admin` varchar(20) NOT NULL,
  `void` int(11) NOT NULL,
  `round` double NOT NULL,
  `alasan` varchar(40) NOT NULL,
  `nm_void` varchar(100) DEFAULT NULL,
  `j_mulai` datetime NOT NULL,
  `j_selesai` datetime NOT NULL,
  `diskon` double NOT NULL,
  `wait` datetime NOT NULL,
  `aktif` int(11) NOT NULL,
  `id_koki1` int(11) NOT NULL,
  `id_koki2` int(11) NOT NULL,
  `id_koki3` int(11) NOT NULL,
  `ongkir` double NOT NULL,
  `id_distribusi` int(11) NOT NULL,
  `orang` double NOT NULL,
  `no_checker` enum('T','Y') NOT NULL,
  `print` enum('T','Y') NOT NULL,
  `copy_print` enum('T','Y') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`id_order`, `no_order`, `id_harga`, `qty`, `harga`, `request`, `tambahan`, `page`, `id_meja`, `selesai`, `id_lokasi`, `pengantar`, `tgl`, `admin`, `void`, `round`, `alasan`, `nm_void`, `j_mulai`, `j_selesai`, `diskon`, `wait`, `aktif`, `id_koki1`, `id_koki2`, `id_koki3`, `ongkir`, `id_distribusi`, `orang`, `no_checker`, `print`, `copy_print`, `created_at`, `updated_at`) VALUES
(1, 'TDI-2203260001', 3, 1, 60000, NULL, 0, 0, 1, 'selesai', 1, 'Aisyah', '2022-03-26', 'Aldi', 0, 0, '', NULL, '2022-03-26 07:57:30', '2022-03-26 07:57:40', 0, '2022-03-26 07:57:43', 1, 2, 0, 0, 0, 1, 1, 'T', 'T', 'T', '2022-03-25 23:57:30', '2022-03-25 23:57:44'),
(2, 'SDI-2203260001', 342, 1, 37000, NULL, 0, 0, 61, 'selesai', 2, 'Aisyah', '2022-03-26', 'Aldi', 0, 0, '', NULL, '2022-03-26 08:27:39', '2022-03-26 08:27:48', 0, '2022-03-26 08:27:51', 1, 4, 0, 0, 0, 1, 1, 'T', 'T', 'T', '2022-03-26 00:27:39', '2022-03-26 00:27:52'),
(3, 'TDI-2203260002', 10, 1, 42000, NULL, 0, 0, 2, 'selesai', 1, 'Dea', '2022-03-26', 'Aldi', 0, 0, '', NULL, '2022-03-26 13:20:20', '2022-03-26 13:20:25', 0, '2022-03-26 13:20:28', 1, 2, 0, 0, 0, 1, 1, 'T', 'T', 'T', '2022-03-26 05:20:20', '2022-03-26 05:20:29'),
(4, 'TDI-2203260003', 6, 1, 30000, NULL, 0, 0, 3, 'selesai', 1, 'Training', '2022-03-26', 'Aldi', 0, 0, '', NULL, '2022-03-26 13:23:40', '2022-03-26 13:23:47', 0, '2022-03-26 13:24:01', 1, 2, 0, 0, 0, 1, 1, 'T', 'T', 'T', '2022-03-26 05:23:40', '2022-03-26 05:24:02'),
(5, 'TDE-2203260001', 8, 1, 80000, NULL, 0, 0, 121, 'selesai', 1, 'Mas Ari', '2022-03-26', 'Aldi', 0, 0, '', NULL, '2022-03-26 13:24:40', '2022-03-26 13:24:50', 0, '2022-03-26 13:24:53', 1, 2, 0, 0, 45000, 3, 1, 'T', 'T', 'T', '2022-03-26 05:24:40', '2022-03-26 05:24:54'),
(6, 'TDI-2203260004', 11, 1, 44000, NULL, 0, 0, 4, 'selesai', 1, 'Dea', '2022-03-26', 'Aldi', 0, 0, '', NULL, '2022-03-26 13:34:13', '2022-03-26 13:34:28', 0, '2022-03-26 13:34:32', 1, 2, 0, 0, 0, 1, 1, 'T', 'T', 'T', '2022-03-26 05:34:13', '2022-03-26 05:34:33'),
(7, 'TDI-2203260005', 7, 1, 30000, NULL, 0, 0, 5, 'selesai', 1, 'Dea', '2022-03-26', 'Aldi', 0, 0, '', NULL, '2022-03-26 13:35:36', '2022-03-26 13:35:41', 0, '2022-03-26 13:35:45', 1, 2, 0, 0, 0, 1, 1, 'T', 'T', 'T', '2022-03-26 05:35:36', '2022-03-26 05:35:46'),
(8, 'TDI-2203260006', 6, 1, 30000, NULL, 0, 0, 6, 'selesai', 1, 'Dea', '2022-03-26', 'Aldi', 0, 0, '', NULL, '2022-03-26 13:36:31', '2022-03-26 13:36:39', 0, '2022-03-26 13:36:44', 1, 2, 0, 0, 0, 1, 1, 'T', 'T', 'T', '2022-03-26 05:36:31', '2022-03-26 05:36:45'),
(9, 'TDE-2203260002', 8, 1, 80000, NULL, 0, 0, 122, 'selesai', 1, 'Mas Ari', '2022-03-26', 'Aldi', 0, 0, '', NULL, '2022-03-26 13:39:15', '2022-03-26 13:39:24', 0, '2022-03-26 13:39:29', 1, 2, 0, 0, 45000, 3, 1, 'T', 'T', 'T', '2022-03-26 05:39:15', '2022-03-26 05:39:30'),
(10, 'TDE-2203260003', 8, 1, 80000, NULL, 0, 0, 123, 'selesai', 1, 'Wawan', '2022-03-26', 'Aldi', 0, 0, '', NULL, '2022-03-26 13:41:57', '2022-03-26 13:42:04', 0, '2022-03-26 13:42:08', 1, 2, 0, 0, 45000, 3, 1, 'T', 'T', 'T', '2022-03-26 05:41:57', '2022-03-26 05:42:10'),
(11, 'TDE-2203260004', 3, 1, 60000, NULL, 0, 0, 124, 'selesai', 1, 'Wawan', '2022-03-26', 'Aldi', 0, 0, '', NULL, '2022-03-26 13:45:18', '2022-03-26 13:45:23', 0, '2022-03-26 13:45:27', 1, 2, 0, 0, 45000, 3, 1, 'T', 'T', 'T', '2022-03-26 05:45:18', '2022-03-26 05:45:27'),
(12, 'TDE-2203260005', 8, 1, 80000, NULL, 0, 0, 125, 'selesai', 1, 'Mas Ari', '2022-03-26', 'Aldi', 0, 0, '', NULL, '2022-03-26 13:49:20', '2022-03-26 13:49:30', 0, '2022-03-26 13:49:35', 1, 2, 0, 0, 45000, 3, 1, 'T', 'T', 'T', '2022-03-26 05:49:20', '2022-03-26 05:49:37'),
(13, 'TDE-2203260005', 8, 1, 80000, NULL, 0, 0, 125, 'selesai', 1, 'Mas Ari', '2022-03-26', 'Aldi', 0, 0, '', NULL, '2022-03-26 13:49:20', '2022-03-26 13:49:29', 0, '2022-03-26 13:49:35', 1, 2, 0, 0, 45000, 3, 1, 'T', 'T', 'T', '2022-03-26 05:49:20', '2022-03-26 05:49:36'),
(14, 'TDE-2203260006', 8, 1, 80000, NULL, 0, 0, 126, 'selesai', 1, 'Mas Ari', '2022-03-26', 'Aldi', 0, 0, '', NULL, '2022-03-26 13:51:00', '2022-03-26 13:51:06', 0, '2022-03-26 13:51:09', 1, 2, 0, 0, 45000, 3, 1, 'T', 'T', 'T', '2022-03-26 05:51:00', '2022-03-26 05:51:10'),
(15, 'TDI-2203260007', 6, 1, 30000, NULL, 0, 0, 7, 'selesai', 1, 'Dea', '2022-03-26', 'Aldi', 0, 0, '', NULL, '2022-03-26 13:51:50', '2022-03-26 13:51:55', 0, '2022-03-26 13:52:02', 1, 2, 0, 0, 0, 1, 1, 'T', 'T', 'T', '2022-03-26 05:51:50', '2022-03-26 05:52:03'),
(16, 'SDE-2203260001', 343, 1, 35000, NULL, 0, 0, 181, 'selesai', 2, 'Fazar', '2022-03-26', 'Aldi', 0, 0, '', NULL, '2022-03-26 13:53:17', '2022-03-26 13:53:22', 0, '2022-03-26 13:53:25', 1, 5, 0, 0, 45000, 3, 1, 'T', 'T', 'T', '2022-03-26 05:53:17', '2022-03-26 05:53:26'),
(17, 'SDE-2203260002', 344, 1, 58000, NULL, 0, 0, 182, 'selesai', 2, 'Gunawan', '2022-03-26', 'Aldi', 0, 0, '', NULL, '2022-03-26 13:56:18', '2022-03-26 13:56:23', 0, '2022-03-26 13:56:27', 1, 5, 0, 0, 45000, 3, 1, 'T', 'T', 'T', '2022-03-26 05:56:18', '2022-03-26 05:56:28'),
(18, 'SDE-2203260003', 333, 1, 39000, NULL, 0, 0, 183, 'selesai', 2, 'Gunawan', '2022-03-26', 'Aldi', 0, 0, '', NULL, '2022-03-26 13:57:45', '2022-03-26 13:57:52', 0, '2022-03-26 13:57:58', 1, 4, 0, 0, 45000, 3, 1, 'T', 'T', 'T', '2022-03-26 05:57:45', '2022-03-26 05:57:58'),
(19, 'SDI-2203260002', 343, 1, 35000, NULL, 0, 0, 62, 'selesai', 2, 'Aisyah', '2022-03-26', 'Aldi', 0, 0, '', NULL, '2022-03-26 13:59:26', '2022-03-26 13:59:30', 0, '2022-03-26 13:59:32', 1, 4, 0, 0, 0, 1, 1, 'T', 'T', 'T', '2022-03-26 05:59:26', '2022-03-26 05:59:33'),
(20, 'SDI-2203260003', 334, 1, 37000, NULL, 0, 0, 63, 'selesai', 2, 'Aisyah', '2022-03-26', 'Aldi', 0, 0, '', NULL, '2022-03-26 14:00:10', '2022-03-26 14:00:16', 0, '2022-03-26 14:00:22', 1, 4, 0, 0, 0, 1, 1, 'T', 'T', 'T', '2022-03-26 06:00:10', '2022-03-26 06:00:22'),
(21, 'SDI-2203260004', 342, 1, 37000, NULL, 0, 0, 64, 'selesai', 2, 'Aisyah', '2022-03-26', 'Aldi', 0, 0, '', NULL, '2022-03-26 14:02:50', '2022-03-26 14:02:57', 0, '2022-03-26 14:03:01', 1, 4, 0, 0, 0, 1, 1, 'T', 'T', 'T', '2022-03-26 06:02:50', '2022-03-26 06:03:02'),
(22, 'TDE-2203260007', 10, 1, 42000, NULL, 0, 0, 127, 'selesai', 1, 'Mas Ari', '2022-03-26', 'Aldi', 0, 0, '', NULL, '2022-03-26 14:05:57', '2022-03-26 14:06:05', 0, '2022-03-26 14:06:09', 1, 2, 0, 0, 45000, 3, 1, 'T', 'T', 'T', '2022-03-26 06:05:57', '2022-03-26 06:06:10'),
(23, 'TDI-2203290001', 8, 1, 80000, NULL, 0, 0, 8, 'selesai', 1, 'Aisyah', '2022-03-29', 'Aldi', 1, 0, '', 'Aldi', '2022-03-29 08:07:27', '2022-03-29 08:07:36', 0, '2022-03-29 08:07:43', 1, 3, 0, 0, 0, 1, 1, 'T', 'T', 'T', '2022-03-29 00:07:27', '2022-03-29 00:08:06'),
(24, 'TDI-2203290002', 7, 1, 30000, NULL, 0, 0, 9, 'selesai', 1, 'Aisyah', '2022-03-29', 'Aldi', 1, 0, 'tes', 'Aldi', '2022-03-29 08:09:00', '2022-03-29 08:09:15', 0, '2022-03-29 08:09:21', 1, 3, 0, 0, 0, 1, 1, 'T', 'T', 'T', '2022-03-29 00:09:00', '2022-03-29 00:20:05'),
(25, 'TDI-2203290003', 10, 1, 42000, NULL, 0, 0, 10, 'selesai', 1, 'Dea', '2022-03-29', 'Aldi', 1, 0, '', 'Aldi', '2022-03-29 08:09:08', '2022-03-29 08:09:16', 0, '2022-03-29 08:09:20', 1, 96, 0, 0, 0, 1, 1, 'T', 'T', 'T', '2022-03-29 00:09:08', '2022-03-29 00:09:53'),
(27, 'TDI-2203290004', 6, 1, 30000, NULL, 0, 0, 11, 'selesai', 1, 'Aisyah', '2022-03-29', 'Aldi', 0, 0, '', NULL, '2022-03-29 08:23:11', '2022-03-29 08:23:43', 0, '2022-03-29 08:23:52', 1, 3, 0, 0, 0, 1, 1, 'T', 'T', 'T', '2022-03-29 00:23:11', '2022-03-29 00:23:55'),
(28, 'TDI-2203290005', 12, 1, 62000, NULL, 0, 0, 12, 'selesai', 1, 'Dea', '2022-03-29', 'Aldi', 0, 0, '', NULL, '2022-03-29 08:23:21', '2022-03-29 08:23:40', 0, '2022-03-29 08:23:53', 1, 96, 0, 0, 0, 1, 1, 'T', 'T', 'T', '2022-03-29 00:23:21', '2022-03-29 00:23:54');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order2`
--

CREATE TABLE `tb_order2` (
  `id_order2` int(11) NOT NULL,
  `id_order1` int(11) NOT NULL,
  `no_order` varchar(30) NOT NULL,
  `no_order2` varchar(50) NOT NULL,
  `id_harga` int(11) NOT NULL,
  `qty` double NOT NULL,
  `harga` double NOT NULL,
  `tgl` date NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `admin` varchar(20) NOT NULL,
  `id_distribusi` int(11) NOT NULL,
  `id_meja` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_order2`
--

INSERT INTO `tb_order2` (`id_order2`, `id_order1`, `no_order`, `no_order2`, `id_harga`, `qty`, `harga`, `tgl`, `id_lokasi`, `admin`, `id_distribusi`, `id_meja`, `created_at`, `updated_at`) VALUES
(1, 1, 'TDI-2203260001', 'TDi-2203260001', 3, 1, 60000, '2022-03-26', 1, 'Aldi', 1, 1, '2022-03-25 23:58:03', '2022-03-25 23:58:03'),
(2, 2, 'SDI-2203260001', 'SDi-2203260001', 342, 1, 37000, '2022-03-26', 2, 'Aldi', 1, 61, '2022-03-26 00:28:06', '2022-03-26 00:28:06'),
(3, 3, 'TDI-2203260002', 'TDi-2203260002', 10, 1, 42000, '2022-03-26', 1, 'Aldi', 1, 2, '2022-03-26 05:20:45', '2022-03-26 05:20:45'),
(4, 3, 'TDI-2203260002', 'TDi-2203260003', 10, 1, 42000, '2022-03-26', 1, 'Aldi', 1, 2, '2022-03-26 05:22:11', '2022-03-26 05:22:11'),
(5, 3, 'TDI-2203260002', 'TDi-2203260004', 10, 1, 42000, '2022-03-26', 1, 'Aldi', 1, 2, '2022-03-26 05:22:20', '2022-03-26 05:22:20'),
(6, 3, 'TDI-2203260002', 'TDi-2203260005', 10, 1, 42000, '2022-03-26', 1, 'Aldi', 1, 2, '2022-03-26 05:22:47', '2022-03-26 05:22:47'),
(7, 4, 'TDI-2203260003', 'TDi-2203260006', 6, 1, 30000, '2022-03-26', 1, 'Aldi', 1, 3, '2022-03-26 05:24:11', '2022-03-26 05:24:11'),
(8, 5, 'TDE-2203260001', 'TDe-2203260001', 8, 1, 80000, '2022-03-26', 1, 'Aldi', 3, 121, '2022-03-26 05:25:08', '2022-03-26 05:25:08'),
(9, 6, 'TDI-2203260004', 'TDi-2203260007', 11, 1, 44000, '2022-03-26', 1, 'Aldi', 1, 4, '2022-03-26 05:34:47', '2022-03-26 05:34:47'),
(10, 7, 'TDI-2203260005', 'TDi-2203260008', 7, 1, 30000, '2022-03-26', 1, 'Aldi', 1, 5, '2022-03-26 05:35:54', '2022-03-26 05:35:54'),
(11, 8, 'TDI-2203260006', 'TDi-2203260009', 6, 1, 30000, '2022-03-26', 1, 'Aldi', 1, 6, '2022-03-26 05:36:53', '2022-03-26 05:36:53'),
(12, 9, 'TDE-2203260002', 'TDe-2203260002', 8, 1, 80000, '2022-03-26', 1, 'Aldi', 3, 122, '2022-03-26 05:39:57', '2022-03-26 05:39:57'),
(13, 9, 'TDE-2203260002', 'TDe-2203260003', 8, 1, 80000, '2022-03-26', 1, 'Aldi', 3, 122, '2022-03-26 05:41:00', '2022-03-26 05:41:00'),
(14, 9, 'TDE-2203260002', 'TDe-2203260004', 8, 1, 80000, '2022-03-26', 1, 'Aldi', 3, 122, '2022-03-26 05:41:34', '2022-03-26 05:41:34'),
(15, 9, 'TDE-2203260002', 'TDe-2203260005', 8, 1, 80000, '2022-03-26', 1, 'Aldi', 3, 122, '2022-03-26 05:41:40', '2022-03-26 05:41:40'),
(16, 10, 'TDE-2203260003', 'TDe-2203260006', 8, 1, 80000, '2022-03-26', 1, 'Aldi', 3, 123, '2022-03-26 05:42:22', '2022-03-26 05:42:22'),
(17, 11, 'TDE-2203260004', 'TDe-2203260007', 3, 1, 60000, '2022-03-26', 1, 'Aldi', 3, 124, '2022-03-26 05:45:49', '2022-03-26 05:45:49'),
(18, 12, 'TDE-2203260005', 'TDe-2203260008', 8, 1, 80000, '2022-03-26', 1, 'Aldi', 3, 125, '2022-03-26 05:50:07', '2022-03-26 05:50:07'),
(19, 13, 'TDE-2203260005', 'TDe-2203260008', 8, 1, 80000, '2022-03-26', 1, 'Aldi', 3, 125, '2022-03-26 05:50:07', '2022-03-26 05:50:07'),
(20, 14, 'TDE-2203260006', 'TDe-2203260009', 8, 1, 80000, '2022-03-26', 1, 'Aldi', 3, 126, '2022-03-26 05:51:22', '2022-03-26 05:51:22'),
(21, 15, 'TDI-2203260007', 'TDi-2203260010', 6, 1, 30000, '2022-03-26', 1, 'Aldi', 1, 7, '2022-03-26 05:52:24', '2022-03-26 05:52:24'),
(22, 16, 'SDE-2203260001', 'SDe-2203260001', 343, 1, 35000, '2022-03-26', 2, 'Aldi', 3, 181, '2022-03-26 05:53:55', '2022-03-26 05:53:55'),
(23, 16, 'SDE-2203260001', 'SDe-2203260002', 343, 1, 35000, '2022-03-26', 2, 'Aldi', 3, 181, '2022-03-26 05:55:08', '2022-03-26 05:55:08'),
(24, 16, 'SDE-2203260001', 'SDe-2203260003', 343, 1, 35000, '2022-03-26', 2, 'Aldi', 3, 181, '2022-03-26 05:55:52', '2022-03-26 05:55:52'),
(25, 17, 'SDE-2203260002', 'SDe-2203260004', 344, 1, 58000, '2022-03-26', 2, 'Aldi', 3, 182, '2022-03-26 05:56:46', '2022-03-26 05:56:46'),
(26, 18, 'SDE-2203260003', 'SDe-2203260005', 333, 1, 39000, '2022-03-26', 2, 'Aldi', 3, 183, '2022-03-26 05:58:04', '2022-03-26 05:58:04'),
(27, 19, 'SDI-2203260002', 'SDi-2203260002', 343, 1, 35000, '2022-03-26', 2, 'Aldi', 1, 62, '2022-03-26 05:59:41', '2022-03-26 05:59:41'),
(28, 20, 'SDI-2203260003', 'SDi-2203260003', 334, 1, 37000, '2022-03-26', 2, 'Aldi', 1, 63, '2022-03-26 06:00:28', '2022-03-26 06:00:28'),
(29, 21, 'SDI-2203260004', 'SDi-2203260004', 342, 1, 37000, '2022-03-26', 2, 'Aldi', 1, 64, '2022-03-26 06:03:10', '2022-03-26 06:03:10'),
(30, 22, 'TDE-2203260007', 'TDe-2203260010', 10, 1, 42000, '2022-03-26', 1, 'Aldi', 3, 127, '2022-03-26 06:06:23', '2022-03-26 06:06:23'),
(31, 23, 'TDI-2203290001', 'TDi-2203290001', 8, 1, 80000, '2022-03-29', 1, 'Aldi', 1, 8, '2022-03-29 00:07:55', '2022-03-29 00:07:55'),
(32, 24, 'TDI-2203290002', 'TDi-2203290002', 7, 1, 30000, '2022-03-29', 1, 'Aldi', 1, 9, '2022-03-29 00:09:32', '2022-03-29 00:09:32'),
(33, 25, 'TDI-2203290003', 'TDi-2203290003', 10, 1, 42000, '2022-03-29', 1, 'Aldi', 1, 10, '2022-03-29 00:09:46', '2022-03-29 00:09:46');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penanggung_jawab`
--

CREATE TABLE `tb_penanggung_jawab` (
  `id_penanggung` int(11) NOT NULL,
  `nm_penanggung` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_penanggung_jawab`
--

INSERT INTO `tb_penanggung_jawab` (`id_penanggung`, `nm_penanggung`) VALUES
(1, 'Hendi'),
(2, 'Made'),
(3, 'Masisah');

-- --------------------------------------------------------

--
-- Table structure for table `tb_peralatan`
--

CREATE TABLE `tb_peralatan` (
  `id_peralatan` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `id_kelompok_peralatan` int(11) NOT NULL,
  `barang` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `debit` double NOT NULL,
  `lokasi` varchar(70) NOT NULL,
  `penanggung_jawab` int(11) NOT NULL,
  `b_penyusutan` double NOT NULL,
  `id_peralatan_kredit` int(11) NOT NULL,
  `kredit` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_peralatan`
--

INSERT INTO `tb_peralatan` (`id_peralatan`, `tgl`, `id_kelompok_peralatan`, `barang`, `qty`, `id_satuan`, `debit`, `lokasi`, `penanggung_jawab`, `b_penyusutan`, `id_peralatan_kredit`, `kredit`, `created_at`, `updated_at`) VALUES
(3, '2022-03-28', 1, 'Obeng', 2, 3, 50000, '1', 2, 8333.3333333333, 65, 0, '2022-03-28 08:30:35', '2022-03-28 08:30:35');

-- --------------------------------------------------------

--
-- Table structure for table `tb_peringatan`
--

CREATE TABLE `tb_peringatan` (
  `id_peringatan` int(11) NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `jam_buat` time NOT NULL,
  `jam_akhir` time NOT NULL,
  `tgl` date NOT NULL,
  `admin` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_peringatan`
--

INSERT INTO `tb_peringatan` (`id_peringatan`, `id_lokasi`, `jam_buat`, `jam_akhir`, `tgl`, `admin`, `created_at`, `updated_at`) VALUES
(6, 1, '14:57:48', '15:42:48', '2022-02-25', 'nanda', NULL, NULL),
(19, 1, '09:02:28', '09:32:28', '2022-03-02', 'Mas Ari', '2022-03-02 01:02:28', '2022-03-02 01:02:28'),
(20, 1, '15:15:48', '15:45:48', '2022-03-02', 'Mas Ari', '2022-03-02 07:15:48', '2022-03-02 07:15:48'),
(24, 1, '08:28:15', '08:58:15', '2022-03-03', 'Mas Ari', '2022-03-03 00:28:15', '2022-03-03 00:28:15'),
(25, 1, '10:35:03', '11:05:03', '2022-03-03', 'Mas Ari', '2022-03-03 02:35:03', '2022-03-03 02:35:03'),
(26, 2, '13:06:03', '13:36:03', '2022-03-03', 'unta', '2022-03-03 05:06:03', '2022-03-03 05:06:03'),
(28, 1, '14:36:57', '15:06:57', '2022-03-05', 'Mas Ari', '2022-03-05 06:36:57', '2022-03-05 06:36:57');

-- --------------------------------------------------------

--
-- Table structure for table `tb_permission`
--

CREATE TABLE `tb_permission` (
  `id_menu` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `lokasi` varchar(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_permission`
--

INSERT INTO `tb_permission` (`id_menu`, `id_user`, `lokasi`, `created_at`, `updated_at`) VALUES
(25, 47, 'tkm', '2022-02-28 19:20:52', '2022-02-28 19:20:52'),
(26, 47, 'tkm', '2022-02-28 19:20:52', '2022-02-28 19:20:52'),
(27, 47, 'tkm', '2022-02-28 19:20:52', '2022-02-28 19:20:52'),
(28, 47, 'tkm', '2022-02-28 19:20:52', '2022-02-28 19:20:52'),
(1, 47, 'tkm', '2022-02-28 19:20:52', '2022-02-28 19:20:52'),
(2, 47, 'tkm', '2022-02-28 19:20:52', '2022-02-28 19:20:52'),
(6, 47, 'tkm', '2022-02-28 19:20:52', '2022-02-28 19:20:52'),
(29, 47, 'tkm', '2022-02-28 19:20:52', '2022-02-28 19:20:52'),
(30, 47, 'tkm', '2022-02-28 19:20:52', '2022-02-28 19:20:52'),
(31, 47, 'tkm', '2022-02-28 19:20:52', '2022-02-28 19:20:52'),
(3, 47, 'tkm', '2022-02-28 19:20:52', '2022-02-28 19:20:52'),
(4, 47, 'tkm', '2022-02-28 19:20:52', '2022-02-28 19:20:52'),
(5, 47, 'tkm', '2022-02-28 19:20:52', '2022-02-28 19:20:52'),
(9, 47, 'tkm', '2022-02-28 19:20:52', '2022-02-28 19:20:52'),
(7, 47, 'tkm', '2022-02-28 19:20:52', '2022-02-28 19:20:52'),
(8, 47, 'tkm', '2022-02-28 19:20:52', '2022-02-28 19:20:52'),
(18, 47, 'tkm', '2022-02-28 19:20:52', '2022-02-28 19:20:52'),
(19, 47, 'tkm', '2022-02-28 19:20:52', '2022-02-28 19:20:52'),
(20, 47, 'tkm', '2022-02-28 19:20:52', '2022-02-28 19:20:52'),
(21, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(22, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(11, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(12, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(13, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(14, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(15, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(16, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(23, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(24, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(25, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(26, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(27, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(28, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(1, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(2, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(6, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(29, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(30, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(31, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(3, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(4, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(5, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(9, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(7, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(8, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(18, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(19, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(20, 27, 'adm', '2022-02-28 19:24:06', '2022-02-28 19:24:06'),
(25, 49, 'sdb', '2022-03-01 21:06:14', '2022-03-01 21:06:14'),
(26, 49, 'sdb', '2022-03-01 21:06:14', '2022-03-01 21:06:14'),
(27, 49, 'sdb', '2022-03-01 21:06:14', '2022-03-01 21:06:14'),
(28, 49, 'sdb', '2022-03-01 21:06:14', '2022-03-01 21:06:14'),
(1, 49, 'sdb', '2022-03-01 21:06:14', '2022-03-01 21:06:14'),
(2, 49, 'sdb', '2022-03-01 21:06:14', '2022-03-01 21:06:14'),
(6, 49, 'sdb', '2022-03-01 21:06:14', '2022-03-01 21:06:14'),
(29, 49, 'sdb', '2022-03-01 21:06:14', '2022-03-01 21:06:14'),
(30, 49, 'sdb', '2022-03-01 21:06:14', '2022-03-01 21:06:14'),
(31, 49, 'sdb', '2022-03-01 21:06:14', '2022-03-01 21:06:14'),
(3, 49, 'sdb', '2022-03-01 21:06:14', '2022-03-01 21:06:14'),
(4, 49, 'sdb', '2022-03-01 21:06:14', '2022-03-01 21:06:14'),
(5, 49, 'sdb', '2022-03-01 21:06:14', '2022-03-01 21:06:14'),
(9, 49, 'sdb', '2022-03-01 21:06:14', '2022-03-01 21:06:14'),
(7, 49, 'sdb', '2022-03-01 21:06:14', '2022-03-01 21:06:14'),
(8, 49, 'sdb', '2022-03-01 21:06:14', '2022-03-01 21:06:14'),
(18, 49, 'sdb', '2022-03-01 21:06:14', '2022-03-01 21:06:14'),
(19, 49, 'sdb', '2022-03-01 21:06:14', '2022-03-01 21:06:14'),
(20, 49, 'sdb', '2022-03-01 21:06:14', '2022-03-01 21:06:14'),
(25, 50, 'tkm', '2022-03-03 19:08:10', '2022-03-03 19:08:10'),
(27, 50, 'tkm', '2022-03-03 19:08:10', '2022-03-03 19:08:10'),
(28, 50, 'tkm', '2022-03-03 19:08:10', '2022-03-03 19:08:10'),
(1, 50, 'tkm', '2022-03-03 19:08:10', '2022-03-03 19:08:10'),
(2, 50, 'tkm', '2022-03-03 19:08:10', '2022-03-03 19:08:10'),
(6, 50, 'tkm', '2022-03-03 19:08:10', '2022-03-03 19:08:10'),
(29, 50, 'tkm', '2022-03-03 19:08:10', '2022-03-03 19:08:10'),
(30, 50, 'tkm', '2022-03-03 19:08:10', '2022-03-03 19:08:10'),
(31, 50, 'tkm', '2022-03-03 19:08:10', '2022-03-03 19:08:10'),
(3, 50, 'tkm', '2022-03-03 19:08:10', '2022-03-03 19:08:10'),
(18, 50, 'tkm', '2022-03-03 19:08:10', '2022-03-03 19:08:10'),
(19, 50, 'tkm', '2022-03-03 19:08:10', '2022-03-03 19:08:10'),
(20, 50, 'tkm', '2022-03-03 19:08:10', '2022-03-03 19:08:10'),
(32, 27, 'adm', NULL, NULL),
(33, 27, 'adm', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_posisi`
--

CREATE TABLE `tb_posisi` (
  `id_posisi` int(11) NOT NULL,
  `nm_posisi` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_posisi`
--

INSERT INTO `tb_posisi` (`id_posisi`, `nm_posisi`, `created_at`, `updated_at`) VALUES
(1, 'Presiden', NULL, NULL),
(2, 'Head', NULL, NULL),
(3, 'Head Chef', NULL, NULL),
(4, 'Head Server', NULL, NULL),
(5, 'Server', NULL, NULL),
(6, 'Asisten Cook', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_post_center`
--

CREATE TABLE `tb_post_center` (
  `id_post` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `nm_post` varchar(100) NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_satuan`
--

CREATE TABLE `tb_satuan` (
  `id` int(11) NOT NULL,
  `n` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_satuan`
--

INSERT INTO `tb_satuan` (`id`, `n`) VALUES
(1, 'NOTA'),
(2, 'BALL'),
(3, 'BARANG'),
(4, 'BIJI'),
(5, 'BKS'),
(6, 'BOTOL'),
(7, 'BTG'),
(8, 'BULAN'),
(9, 'CM'),
(10, 'CTN'),
(11, 'DUS'),
(12, 'GR'),
(13, 'IKAT'),
(14, 'JERIGEN'),
(15, 'KALENG'),
(16, 'KALI'),
(17, 'KARTON'),
(18, 'KG'),
(19, 'KOLI'),
(20, 'KOTAK'),
(21, 'LEMBAR'),
(22, 'LITER'),
(23, 'METER'),
(24, 'ML'),
(25, 'PACK'),
(26, 'PCS'),
(27, 'PORSI'),
(28, 'RIM'),
(29, 'ROLL'),
(30, 'SAK'),
(31, 'SET'),
(32, 'EKOR'),
(33, 'PASANG'),
(34, 'KUBIK'),
(35, 'HARI'),
(36, 'ORANG'),
(37, 'TABUNG'),
(38, 'RIT'),
(39, 'KARUNG'),
(40, 'LUSIN'),
(41, 'DS');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sold_out`
--

CREATE TABLE `tb_sold_out` (
  `id_sold_out` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `admin` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_sold_out`
--

INSERT INTO `tb_sold_out` (`id_sold_out`, `tgl`, `id_menu`, `id_lokasi`, `admin`, `created_at`, `updated_at`) VALUES
(37, '2022-03-01', 2, 1, 'Aldi', '2022-02-28 23:02:14', '2022-02-28 23:02:14'),
(38, '2022-03-01', 3, 1, 'Aldi', '2022-02-28 23:02:14', '2022-02-28 23:02:14'),
(39, '2022-03-02', 201, 2, 'unta', '2022-03-01 21:13:41', '2022-03-01 21:13:41'),
(41, '2022-03-04', 2, 1, 'Mas Ari', '2022-03-04 00:56:52', '2022-03-04 00:56:52'),
(42, '2022-03-07', 201, 2, 'unta', '2022-03-06 16:41:54', '2022-03-06 16:41:54');

-- --------------------------------------------------------

--
-- Table structure for table `tb_status`
--

CREATE TABLE `tb_status` (
  `id_status` int(11) NOT NULL,
  `nm_status` varchar(50) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_status`
--

INSERT INTO `tb_status` (`id_status`, `nm_status`, `created_at`, `updated_at`) VALUES
(1, 'Kitchen', NULL, NULL),
(2, 'Waitress', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sub_navbar`
--

CREATE TABLE `tb_sub_navbar` (
  `id_sub_navbar` int(11) NOT NULL,
  `id_navbar` int(11) NOT NULL,
  `sub_navbar` varchar(100) NOT NULL,
  `rot` varchar(100) NOT NULL,
  `img` varchar(100) NOT NULL,
  `jen` int(11) NOT NULL,
  `urutan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_sub_navbar`
--

INSERT INTO `tb_sub_navbar` (`id_sub_navbar`, `id_navbar`, `sub_navbar`, `rot`, `img`, `jen`, `urutan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Absen', 'absen', 'calendar.png', 1, 18, NULL, '2022-03-22 05:40:33'),
(2, 2, 'Add Koki', 'addKoki', 'add-user.png', 1, 19, NULL, '2022-03-22 05:40:33'),
(3, 3, 'Data Driver', 'driver', '', 1, 21, NULL, '2022-03-22 05:40:33'),
(4, 3, 'Data Kasbon', 'kasbon', '', 1, 22, NULL, '2022-03-22 05:40:33'),
(5, 3, 'Data Mencuci', 'mencuci', '', 1, 23, NULL, '2022-03-22 05:40:33'),
(6, 6, 'Discount', 'discount', 'discount.png', 1, 20, NULL, '2022-03-22 05:40:33'),
(7, 3, 'Data tips', 'tips', '', 1, 25, NULL, '2022-03-22 05:40:33'),
(8, 3, 'Dp', 'dp', '', 1, 26, NULL, '2022-03-22 05:40:33'),
(9, 3, 'Data Denda', 'denda', '', 1, 24, NULL, '2022-03-22 05:40:33'),
(11, 4, 'Menu Takemori', 'menu', '', 2, 3, NULL, '2022-03-22 05:40:33'),
(12, 4, 'Menu Soondobu', 'menu', '', 2, 4, NULL, '2022-03-22 05:40:33'),
(13, 4, 'Karyawan Ts', 'karyawan', '', 2, 5, NULL, '2022-03-22 05:40:33'),
(14, 4, 'Departemen', 'status', '', 2, 6, NULL, '2022-03-22 05:40:33'),
(15, 4, 'Posisi', 'posisi', '', 2, 7, NULL, '2022-03-22 05:40:33'),
(16, 4, 'Distribusi', 'distribusi', '', 2, 8, NULL, '2022-03-22 05:40:33'),
(18, 5, 'Sold Out', 'soldOut', '', 1, 9, NULL, '2022-03-22 05:40:33'),
(19, 5, 'Waktu Tunggu', 'waktuTunggu', '', 1, 10, NULL, '2022-03-22 05:40:33'),
(20, 5, 'Limit', 'limit', '', 1, 11, NULL, '2022-03-22 05:40:33'),
(21, 21, 'Accounting', 'accounting', 'accounting.png', 2, 1, NULL, '2022-03-22 05:40:33'),
(22, 22, 'Gaji', 'gaji', 'gaji.png', 2, 2, NULL, '2022-03-22 05:40:33'),
(23, 4, 'Ongkir', 'ongkir', '', 2, 12, NULL, '2022-03-22 05:40:33'),
(24, 4, 'Users', 'users', '', 2, 13, NULL, '2022-03-22 05:40:33'),
(25, 25, 'Order', 'order', 'order.png', 1, 14, NULL, '2022-03-22 05:40:33'),
(26, 26, 'Meja', 'meja', 'stack.png', 1, 15, NULL, '2022-03-22 05:40:33'),
(27, 27, 'Tugas Head', 'head', 'chef-hat.png', 1, 16, NULL, '2022-03-22 05:40:33'),
(28, 28, 'Laporan', 'laporan', 'report.png', 1, 17, NULL, '2022-03-22 05:40:33'),
(29, 29, 'Data Orderan', 'dataOrderan', ' ', 1, 27, NULL, '2022-03-22 05:40:33'),
(30, 29, 'Data Invoice', 'invoice', ' ', 1, 28, NULL, '2022-03-22 05:40:33'),
(31, 29, 'Void', 'void', ' ', 1, 29, NULL, '2022-03-22 05:40:33');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tips`
--

CREATE TABLE `tb_tips` (
  `id_tips` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `nominal` int(11) NOT NULL,
  `admin` varchar(110) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_tips`
--

INSERT INTO `tb_tips` (`id_tips`, `tgl`, `nominal`, `admin`, `created_at`, `updated_at`) VALUES
(7, '2022-03-04', 2000, 'Mas Ari', '2022-03-03 19:21:08', '2022-03-03 19:21:08');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `no_order` varchar(40) NOT NULL,
  `total_orderan` double NOT NULL,
  `discount` double NOT NULL,
  `voucher` double NOT NULL DEFAULT 0,
  `dp` double NOT NULL DEFAULT 0,
  `gosen` double NOT NULL,
  `total_bayar` double NOT NULL,
  `admin` varchar(20) NOT NULL,
  `round` double NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `cash` double NOT NULL,
  `d_bca` double NOT NULL,
  `k_bca` double NOT NULL,
  `d_mandiri` double NOT NULL,
  `k_mandiri` double NOT NULL,
  `ongkir` double NOT NULL,
  `service` double NOT NULL,
  `tax` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `tgl_transaksi`, `no_order`, `total_orderan`, `discount`, `voucher`, `dp`, `gosen`, `total_bayar`, `admin`, `round`, `id_lokasi`, `cash`, `d_bca`, `k_bca`, `d_mandiri`, `k_mandiri`, `ongkir`, `service`, `tax`, `created_at`, `updated_at`) VALUES
(1, '2022-03-08', 'TDi-2203080001', 28000, 0, 0, 0, 0, 31000, 'Aldi', 200, 1, 40000, 0, 0, 0, 0, 0, 0, 2800, '2022-03-08 03:56:43', '2022-03-08 03:56:43'),
(2, '2022-03-08', 'SDi-2203080001', 23000, 0, 0, 0, 0, 26000, 'Aldi', 700, 2, 30000, 0, 0, 0, 0, 0, 0, 2300, '2022-03-08 06:17:48', '2022-03-08 06:17:48'),
(3, '2022-03-08', 'SDi-2203080002', 41000, 0, 0, 0, 0, 46000, 'Aldi', 900, 2, 50000, 0, 0, 0, 0, 0, 0, 4100, '2022-03-08 06:18:15', '2022-03-08 06:18:15'),
(4, '2022-03-24', 'TDi-2203240001', 50000, 0, 0, 0, 0, 55000, 'Aldi', 0, 1, 60000, 0, 0, 0, 0, 0, 0, 5000, '2022-03-24 01:51:07', '2022-03-24 01:51:07'),
(5, '2022-03-24', 'TDi-2203240002', 50000, 0, 0, 0, 0, 55000, 'Aldi', 0, 1, 60000, 0, 0, 0, 0, 0, 0, 5000, '2022-03-24 01:55:03', '2022-03-24 01:55:03'),
(6, '2022-03-24', 'TDi-2203240003', 50000, 0, 0, 0, 0, 55000, 'Aldi', 0, 1, 60000, 0, 0, 0, 0, 0, 0, 5000, '2022-03-24 01:59:03', '2022-03-24 01:59:03'),
(7, '2022-03-24', 'TDi-2203240004', 50000, 0, 0, 0, 0, 55000, 'Aldi', 0, 1, 60000, 0, 0, 0, 0, 0, 0, 5000, '2022-03-24 01:59:31', '2022-03-24 01:59:31'),
(8, '2022-03-24', 'TDi-2203240005', 50000, 0, 0, 0, 0, 55000, 'Aldi', 0, 1, 60000, 0, 0, 0, 0, 0, 0, 5000, '2022-03-24 02:00:03', '2022-03-24 02:00:03'),
(9, '2022-03-24', 'TDi-2203240006', 50000, 0, 0, 0, 0, 55000, 'Aldi', 0, 1, 60000, 0, 0, 0, 0, 0, 0, 5000, '2022-03-24 02:00:21', '2022-03-24 02:00:21'),
(10, '2022-03-24', 'TDi-2203240007', 50000, 0, 0, 0, 0, 55000, 'Aldi', 0, 1, 60000, 0, 0, 0, 0, 0, 0, 5000, '2022-03-24 02:01:20', '2022-03-24 02:01:20'),
(11, '2022-03-24', 'TDi-2203240008', 62000, 0, 0, 0, 0, 69000, 'Aldi', 800, 1, 70000, 0, 0, 0, 0, 0, 0, 6200, '2022-03-24 02:02:28', '2022-03-24 02:02:28'),
(12, '2022-03-24', 'TDi-2203240009', 62000, 0, 0, 0, 0, 69000, 'Aldi', 800, 1, 70000, 0, 0, 0, 0, 0, 0, 6200, '2022-03-24 02:03:48', '2022-03-24 02:03:48'),
(13, '2022-03-24', 'TDi-2203240010', 62000, 0, 0, 0, 0, 69000, 'Aldi', 800, 1, 70000, 0, 0, 0, 0, 0, 0, 6200, '2022-03-24 02:04:03', '2022-03-24 02:04:03'),
(14, '2022-03-24', 'TDi-2203240011', 62000, 0, 0, 0, 0, 69000, 'Aldi', 800, 1, 70000, 0, 0, 0, 0, 0, 0, 6200, '2022-03-24 02:04:16', '2022-03-24 02:04:16'),
(15, '2022-03-24', 'TDi-2203240012', 62000, 0, 0, 0, 0, 69000, 'Aldi', 800, 1, 70000, 0, 0, 0, 0, 0, 0, 6200, '2022-03-24 02:55:38', '2022-03-24 02:55:38'),
(16, '2022-03-24', 'TDi-2203240013', 62000, 0, 0, 0, 0, 69000, 'Aldi', 800, 1, 70000, 0, 0, 0, 0, 0, 0, 6200, '2022-03-24 02:59:57', '2022-03-24 02:59:57'),
(17, '2022-03-24', 'TDi-2203240014', 80000, 0, 0, 0, 0, 88000, 'Aldi', 0, 1, 90000, 0, 0, 0, 0, 0, 0, 8000, '2022-03-24 03:07:43', '2022-03-24 03:07:43'),
(18, '2022-03-24', 'TDi-2203240015', 30000, 0, 0, 0, 0, 33000, 'Aldi', 0, 1, 50000, 0, 0, 0, 0, 0, 0, 3000, '2022-03-24 03:08:05', '2022-03-24 03:08:05'),
(19, '2022-03-24', 'TDi-2203240016', 30000, 0, 0, 0, 0, 33000, 'Aldi', 0, 1, 50000, 0, 0, 0, 0, 0, 0, 3000, '2022-03-24 03:08:35', '2022-03-24 03:08:35'),
(20, '2022-03-24', 'TDi-2203240017', 80000, 0, 0, 0, 0, 88000, 'Aldi', 0, 1, 90000, 0, 0, 0, 0, 0, 0, 8000, '2022-03-24 03:10:49', '2022-03-24 03:10:49'),
(21, '2022-03-24', 'TDi-2203240018', 30000, 0, 0, 0, 0, 33000, 'Aldi', 0, 1, 50000, 0, 0, 0, 0, 0, 0, 3000, '2022-03-24 03:13:32', '2022-03-24 03:13:32'),
(22, '2022-03-24', 'TDi-2203240019', 28000, 0, 0, 0, 0, 31000, 'Aldi', 200, 1, 35000, 0, 0, 0, 0, 0, 0, 2800, '2022-03-24 03:25:37', '2022-03-24 03:25:37'),
(23, '2022-03-24', 'TDi-2203240020', 94000, 0, 0, 0, 0, 104000, 'Aldi', 600, 1, 50000, 60000, 0, 0, 0, 0, 0, 9400, '2022-03-24 03:38:22', '2022-03-24 03:38:22'),
(24, '2022-03-24', 'TDi-2203240021', 25000, 0, 0, 0, 0, 28000, 'Aldi', 500, 1, 20000, 8000, 0, 0, 0, 0, 0, 2500, '2022-03-24 03:40:46', '2022-03-24 03:40:46'),
(25, '2022-03-24', 'TDi-2203240022', 42000, 0, 0, 0, 0, 47000, 'Aldi', 800, 1, 40000, 7000, 0, 0, 0, 0, 0, 4200, '2022-03-24 03:41:54', '2022-03-24 03:41:54'),
(26, '2022-03-24', 'TDi-2203240023', 80000, 0, 0, 0, 0, 88000, 'Aldi', 0, 1, 90000, 0, 0, 0, 0, 0, 0, 8000, '2022-03-24 05:06:44', '2022-03-24 05:06:44'),
(27, '2022-03-24', 'TDi-2203240024', 28000, 0, 0, 0, 0, 31000, 'Aldi', 200, 1, 35000, 0, 0, 0, 0, 0, 0, 2800, '2022-03-24 07:15:49', '2022-03-24 07:15:49'),
(28, '2022-03-24', 'TDi-2203240025', 28000, 0, 0, 0, 0, 31000, 'Aldi', 200, 1, 35000, 0, 0, 0, 0, 0, 0, 2800, '2022-03-24 07:16:48', '2022-03-24 07:16:48'),
(29, '2022-03-24', 'TDe-2203240001', 30000, 0, 0, 0, 0, 85000, 'Aldi', 190, 1, 90000, 0, 0, 0, 0, 45000, 2100, 7710, '2022-03-24 07:54:22', '2022-03-24 07:54:22'),
(30, '2022-03-24', 'TDe-2203240002', 30000, 0, 0, 0, 0, 85000, 'Aldi', 190, 1, 90000, 0, 0, 0, 0, 45000, 2100, 7710, '2022-03-24 07:54:39', '2022-03-24 07:54:39'),
(31, '2022-03-24', 'TDe-2203240003', 30000, 0, 0, 0, 0, 85000, 'Aldi', 190, 1, 90000, 0, 0, 0, 0, 45000, 2100, 7710, '2022-03-24 07:54:45', '2022-03-24 07:54:45'),
(32, '2022-03-24', 'TDe-2203240004', 60000, 0, 0, 0, 0, 121000, 'Aldi', 880, 1, 130000, 0, 0, 0, 0, 45000, 4200, 10920, '2022-03-24 07:58:44', '2022-03-24 07:58:44'),
(33, '2022-03-24', 'TDi-2203240026', 42000, 0, 0, 0, 0, 47000, 'Aldi', 800, 1, 50000, 0, 0, 0, 0, 0, 0, 4200, '2022-03-24 08:03:24', '2022-03-24 08:03:24'),
(34, '2022-03-24', 'TDe-2203240005', 34000, 0, 0, 0, 0, 90000, 'Aldi', 482, 1, 80000, 10000, 0, 0, 0, 45000, 2380, 8138, '2022-03-24 08:32:48', '2022-03-24 08:32:48'),
(35, '2022-03-24', 'TDi-2203240027', 60000, 0, 0, 0, 0, 66000, 'Aldi', 0, 1, 100000, 0, 0, 0, 0, 0, 0, 6000, '2022-03-24 08:35:54', '2022-03-24 08:35:54'),
(36, '2022-03-24', 'TDe-2203240006', 30000, 0, 0, 0, 0, 85000, 'Aldi', 190, 1, 50000, 50000, 0, 0, 0, 45000, 2100, 7710, '2022-03-24 08:39:27', '2022-03-24 08:39:27'),
(37, '2022-03-24', 'TDi-2203240028', 25000, 0, 0, 0, 0, 28000, 'Aldi', 500, 1, 50000, 0, 0, 0, 0, 0, 0, 2500, '2022-03-24 08:40:54', '2022-03-24 08:40:54'),
(38, '2022-03-24', 'TDi-2203240029', 25000, 0, 0, 0, 0, 28000, 'Aldi', 500, 1, 50000, 0, 0, 0, 0, 0, 0, 2500, '2022-03-24 08:41:06', '2022-03-24 08:41:06'),
(39, '2022-03-24', 'TDi-2203240030', 25000, 0, 0, 0, 0, 28000, 'Aldi', 500, 1, 50000, 0, 0, 0, 0, 0, 0, 2500, '2022-03-24 08:41:19', '2022-03-24 08:41:19'),
(40, '2022-03-24', 'TDi-2203240031', 25000, 0, 0, 0, 0, 28000, 'Aldi', 500, 1, 50000, 0, 0, 0, 0, 0, 0, 2500, '2022-03-24 08:41:32', '2022-03-24 08:41:32'),
(41, '2022-03-24', 'TDi-2203240032', 25000, 0, 0, 0, 0, 28000, 'Aldi', 500, 1, 50000, 0, 0, 0, 0, 0, 0, 2500, '2022-03-24 08:41:41', '2022-03-24 08:41:41'),
(42, '2022-03-24', 'TDi-2203240033', 25000, 0, 0, 0, 0, 28000, 'Aldi', 500, 1, 50000, 0, 0, 0, 0, 0, 0, 2500, '2022-03-24 08:43:00', '2022-03-24 08:43:00'),
(43, '2022-03-24', 'TDi-2203240034', 25000, 0, 0, 0, 0, 28000, 'Aldi', 500, 1, 50000, 0, 0, 0, 0, 0, 0, 2500, '2022-03-24 08:43:06', '2022-03-24 08:43:06'),
(44, '2022-03-24', 'TDe-2203240007', 30000, 0, 0, 0, 0, 85000, 'Aldi', 190, 1, 50000, 50000, 0, 0, 0, 45000, 2100, 7710, '2022-03-24 08:44:07', '2022-03-24 08:44:07'),
(45, '2022-03-24', 'TDe-2203240008', 30000, 0, 0, 0, 0, 85000, 'Aldi', 190, 1, 50000, 50000, 0, 0, 0, 45000, 2100, 7710, '2022-03-24 08:49:04', '2022-03-24 08:49:04'),
(46, '2022-03-25', 'TDe-2203250001', 30000, 0, 0, 0, 0, 85000, 'Aldi', 190, 1, 50000, 50000, 0, 0, 0, 45000, 2100, 7710, '2022-03-25 00:19:50', '2022-03-25 00:19:50'),
(47, '2022-03-25', 'TDe-2203250002', 80000, 0, 0, 0, 0, 144000, 'Aldi', 340, 1, 100000, 50000, 0, 0, 0, 45000, 5600, 13060, '2022-03-25 00:38:47', '2022-03-25 00:38:47'),
(48, '2022-03-25', 'TDi-2203250001', 30000, 0, 0, 0, 0, 33000, 'Aldi', 0, 1, 50000, 0, 0, 0, 0, 0, 0, 3000, '2022-03-25 00:39:38', '2022-03-25 00:39:38'),
(49, '2022-03-25', 'TDe-2203250003', 60000, 0, 0, 0, 0, 121000, 'Aldi', 880, 1, 25000, 100000, 0, 0, 0, 45000, 4200, 10920, '2022-03-25 00:51:46', '2022-03-25 00:51:46'),
(50, '2022-03-25', 'TDi-2203250002', 30000, 0, 0, 0, 0, 33000, 'Aldi', 0, 1, 50000, 0, 0, 0, 0, 0, 0, 3000, '2022-03-25 00:53:27', '2022-03-25 00:53:27'),
(51, '2022-03-25', 'TDi-2203250003', 108000, 0, 0, 0, 0, 119000, 'Aldi', 200, 1, 0, 150000, 0, 0, 0, 0, 0, 10800, '2022-03-25 00:56:10', '2022-03-25 00:56:10'),
(52, '2022-03-25', 'TDi-2203250004', 30000, 0, 0, 0, 0, 33000, 'Aldi', 0, 1, 0, 50000, 0, 0, 0, 0, 0, 3000, '2022-03-25 01:05:22', '2022-03-25 01:05:22'),
(53, '2022-03-25', 'TDi-2203250001', 30000, 0, 0, 0, 0, 33000, 'Aldi', 0, 1, 0, 50000, 0, 0, 0, 0, 0, 3000, '2022-03-25 01:09:44', '2022-03-25 01:09:44'),
(54, '2022-03-25', 'TDi-2203250002', 30000, 0, 0, 0, 0, 33000, 'Aldi', 0, 1, 0, 40000, 0, 0, 0, 0, 0, 3000, '2022-03-25 01:14:27', '2022-03-25 01:14:27'),
(55, '2022-03-25', 'TDi-2203250003', 60000, 0, 0, 0, 0, 66000, 'Aldi', 0, 1, 0, 0, 70000, 0, 0, 0, 0, 6000, '2022-03-25 01:58:14', '2022-03-25 01:58:14'),
(56, '2022-03-25', 'TDe-2203250001', 60000, 0, 0, 0, 0, 121000, 'Aldi', 880, 1, 0, 30000, 100000, 0, 0, 45000, 4200, 10920, '2022-03-25 01:59:06', '2022-03-25 01:59:06'),
(57, '2022-03-25', 'TDi-2203250004', 30000, 0, 0, 0, 0, 33000, 'Aldi', 0, 1, 50000, 0, 0, 0, 0, 0, 0, 3000, '2022-03-25 02:02:05', '2022-03-25 02:02:05'),
(58, '2022-03-25', 'TDe-2203250002', 30000, 0, 0, 0, 0, 85000, 'Aldi', 190, 1, 100000, 0, 0, 0, 0, 45000, 2100, 7710, '2022-03-25 02:02:45', '2022-03-25 02:02:45'),
(59, '2022-03-25', 'TDi-2203250005', 25000, 0, 0, 0, 0, 28000, 'Aldi', 500, 1, 8000, 20000, 0, 0, 0, 0, 0, 2500, '2022-03-25 02:04:02', '2022-03-25 02:04:02'),
(60, '2022-03-25', 'TDi-2203250006', 94000, 0, 0, 0, 0, 104000, 'Aldi', 600, 1, 5000, 0, 100000, 0, 0, 0, 0, 9400, '2022-03-25 02:05:56', '2022-03-25 02:05:56'),
(61, '2022-03-25', 'TDi-2203250007', 30000, 0, 0, 0, 0, 33000, 'Aldi', 0, 1, 0, 100000, 0, 0, 0, 0, 0, 3000, '2022-03-25 02:08:26', '2022-03-25 02:08:26'),
(62, '2022-03-25', 'TDi-2203250008', 30000, 0, 0, 0, 0, 33000, 'Aldi', 0, 1, 0, 0, 50000, 0, 0, 0, 0, 3000, '2022-03-25 02:12:50', '2022-03-25 02:12:50'),
(63, '2022-03-25', 'TDi-2203250009', 30000, 0, 0, 0, 0, 33000, 'Aldi', 0, 1, 3000, 0, 30000, 0, 0, 0, 0, 3000, '2022-03-25 02:13:20', '2022-03-25 02:13:20'),
(64, '2022-03-25', 'TDi-2203250010', 30000, 0, 0, 0, 0, 33000, 'Aldi', 0, 1, 5000, 30000, 0, 0, 0, 0, 0, 3000, '2022-03-25 02:14:19', '2022-03-25 02:14:19'),
(65, '2022-03-25', 'TDi-2203250011', 25000, 0, 0, 0, 0, 28000, 'Aldi', 500, 1, 10000, 20000, 0, 0, 0, 0, 0, 2500, '2022-03-25 02:26:45', '2022-03-25 02:26:45'),
(66, '2022-03-25', 'TDi-2203250012', 60000, 0, 0, 0, 0, 66000, 'Aldi', 0, 1, 60000, 10000, 0, 0, 0, 0, 0, 6000, '2022-03-25 02:27:31', '2022-03-25 02:27:31'),
(67, '2022-03-25', 'TDi-2203250013', 30000, 0, 0, 0, 0, 33000, 'Aldi', 0, 1, 5000, 10000, 10000, 10000, 0, 0, 0, 3000, '2022-03-25 02:31:25', '2022-03-25 02:31:25'),
(68, '2022-03-25', 'TDe-2203250003', 30000, 0, 0, 0, 0, 85000, 'Aldi', 190, 1, 5000, 30000, 30000, 10000, 10000, 45000, 2100, 7710, '2022-03-25 02:32:54', '2022-03-25 02:32:54'),
(69, '2022-03-25', 'TDi-2203250014', 60000, 0, 0, 0, 0, 66000, 'Aldi', 0, 1, 0, 0, 70000, 0, 0, 0, 0, 6000, '2022-03-25 02:36:24', '2022-03-25 02:36:24'),
(70, '2022-03-25', 'TDi-2203250015', 60000, 0, 0, 0, 0, 66000, 'Aldi', 0, 1, 0, 70000, 0, 0, 0, 0, 0, 6000, '2022-03-25 02:42:39', '2022-03-25 02:42:39'),
(71, '2022-03-25', 'TDi-2203250016', 80000, 0, 0, 0, 0, 88000, 'Aldi', 0, 1, 0, 90000, 0, 0, 0, 0, 0, 8000, '2022-03-25 02:44:24', '2022-03-25 02:44:24'),
(72, '2022-03-25', 'TDi-2203250017', 60000, 0, 0, 0, 0, 66000, 'Aldi', 0, 1, 6000, 60000, 0, 0, 0, 0, 0, 6000, '2022-03-25 02:45:46', '2022-03-25 02:45:46'),
(73, '2022-03-25', 'TDi-2203250018', 42000, 0, 0, 0, 0, 47000, 'Aldi', 800, 1, 10000, 40000, 0, 0, 0, 0, 0, 4200, '2022-03-25 02:46:39', '2022-03-25 02:46:39'),
(74, '2022-03-25', 'TDi-2203250019', 30000, 0, 0, 0, 0, 33000, 'Aldi', 0, 1, 0, 40000, 0, 0, 0, 0, 0, 3000, '2022-03-25 02:48:47', '2022-03-25 02:48:47'),
(75, '2022-03-25', 'TDi-2203250020', 60000, 0, 0, 0, 0, 66000, 'Aldi', 0, 1, 10000, 62000, 0, 0, 0, 0, 0, 6000, '2022-03-25 02:51:29', '2022-03-25 02:51:29'),
(76, '2022-03-25', 'TDi-2203250021', 25000, 0, 0, 0, 0, 28000, 'Aldi', 500, 1, 10000, 20000, 0, 0, 0, 0, 0, 2500, '2022-03-25 02:52:46', '2022-03-25 02:52:46'),
(77, '2022-03-25', 'TDi-2203250022', 60000, 0, 0, 0, 0, 66000, 'Aldi', 0, 1, 10000, 60000, 0, 0, 0, 0, 0, 6000, '2022-03-25 02:54:21', '2022-03-25 02:54:21'),
(78, '2022-03-25', 'TDi-2203250023', 25000, 0, 0, 0, 0, 28000, 'Aldi', 500, 1, 10000, 20000, 0, 0, 0, 0, 0, 2500, '2022-03-25 02:56:20', '2022-03-25 02:56:20'),
(79, '2022-03-25', 'TDi-2203250024', 42000, 0, 0, 0, 0, 47000, 'Aldi', 800, 1, 7000, 40000, 0, 0, 0, 0, 0, 4200, '2022-03-25 02:59:15', '2022-03-25 02:59:15'),
(80, '2022-03-25', 'TDi-2203250025', 60000, 0, 0, 0, 0, 66000, 'Aldi', 0, 1, 0, 66000, 0, 0, 0, 0, 0, 6000, '2022-03-25 03:02:16', '2022-03-25 03:02:16'),
(81, '2022-03-25', 'TDi-2203250026', 30000, 0, 0, 0, 0, 33000, 'Aldi', 0, 1, 0, 0, 35000, 0, 0, 0, 0, 3000, '2022-03-25 03:06:58', '2022-03-25 03:06:58'),
(82, '2022-03-25', 'TDi-2203250001', 30000, 0, 0, 0, 0, 33000, 'Aldi', 0, 1, 3000, 0, 0, 30000, 0, 0, 0, 3000, '2022-03-25 03:12:26', '2022-03-25 03:12:26'),
(83, '2022-03-25', 'TDi-2203250002', 60000, 0, 0, 0, 0, 66000, 'Aldi', 0, 1, 70000, 0, 0, 0, 0, 0, 0, 6000, '2022-03-25 03:35:02', '2022-03-25 03:35:02'),
(84, '2022-03-25', 'TDi-2203250003', 60000, 0, 0, 0, 0, 66000, 'Aldi', 0, 1, 70000, 0, 0, 0, 0, 0, 0, 6000, '2022-03-25 03:44:07', '2022-03-25 03:44:07'),
(85, '2022-03-25', 'SDi-2203250001', 41000, 0, 0, 0, 0, 46000, 'Aldi', 900, 2, 6000, 40000, 0, 0, 0, 0, 0, 4100, '2022-03-25 05:58:09', '2022-03-25 05:58:09'),
(86, '2022-03-25', 'TDi-2203250004', 25000, 0, 0, 0, 0, 28000, 'Aldi', 500, 1, 30000, 0, 0, 0, 0, 0, 0, 2500, '2022-03-25 06:22:21', '2022-03-25 06:22:21'),
(87, '2022-03-25', 'TDi-2203250005', 25000, 0, 0, 0, 0, 28000, 'Aldi', 500, 1, 30000, 0, 0, 0, 0, 0, 0, 2500, '2022-03-25 06:23:53', '2022-03-25 06:23:53'),
(88, '2022-03-25', 'TDi-2203250006', 25000, 0, 0, 0, 0, 28000, 'Aldi', 500, 1, 30000, 0, 0, 0, 0, 0, 0, 2500, '2022-03-25 06:24:07', '2022-03-25 06:24:07'),
(89, '2022-03-25', 'TDi-2203250007', 25000, 0, 0, 0, 0, 28000, 'Aldi', 500, 1, 30000, 0, 0, 0, 0, 0, 0, 2500, '2022-03-25 06:24:22', '2022-03-25 06:24:22'),
(90, '2022-03-25', 'TDi-2203250008', 25000, 0, 0, 0, 0, 28000, 'Aldi', 500, 1, 30000, 0, 0, 0, 0, 0, 0, 2500, '2022-03-25 06:24:38', '2022-03-25 06:24:38'),
(91, '2022-03-25', 'TDi-2203250009', 25000, 0, 0, 0, 0, 28000, 'Aldi', 500, 1, 30000, 0, 0, 0, 0, 0, 0, 2500, '2022-03-25 06:25:46', '2022-03-25 06:25:46'),
(92, '2022-03-25', 'TDi-2203250010', 25000, 0, 0, 0, 0, 28000, 'Aldi', 500, 1, 30000, 0, 0, 0, 0, 0, 0, 2500, '2022-03-25 06:25:55', '2022-03-25 06:25:55'),
(93, '2022-03-25', 'TDi-2203250011', 319000, 0, 0, 0, 0, 351000, 'Aldi', 100, 1, 360000, 0, 0, 0, 0, 0, 0, 31900, '2022-03-25 06:30:36', '2022-03-25 06:30:36'),
(94, '2022-03-25', 'TDi-2203250012', 60000, 0, 0, 0, 0, 66000, 'Aldi', 0, 1, 70000, 0, 0, 0, 0, 0, 0, 6000, '2022-03-25 06:32:31', '2022-03-25 06:32:31'),
(95, '2022-03-25', 'TDi-2203250013', 60000, 0, 0, 0, 0, 66000, 'Aldi', 0, 1, 80000, 0, 0, 0, 0, 0, 0, 6000, '2022-03-25 06:32:40', '2022-03-25 06:32:40'),
(96, '2022-03-25', 'TDi-2203250014', 30000, 0, 50000, 0, 0, 0, 'Aldi', 0, 1, 0, 0, 0, 0, 0, 0, -1400.0000000000002, 0, '2022-03-25 06:44:18', '2022-03-25 06:44:18'),
(97, '2022-03-25', 'TDi-2203250015', 25000, 0, 50000, 0, 0, 0, 'Aldi', 500, 1, 0, 0, 0, 0, 0, 0, -1750.0000000000002, 0, '2022-03-25 06:46:04', '2022-03-25 06:46:04'),
(98, '2022-03-25', 'TDi-2203250016', 25000, 0, 0, 0, 0, 28000, 'Aldi', 500, 1, 30000, 0, 0, 0, 0, 0, 0, 2500, '2022-03-25 06:48:22', '2022-03-25 06:48:22'),
(99, '2022-03-25', 'TDi-2203250017', 25000, 0, 0, 0, 0, 28000, 'Aldi', 500, 1, 30000, 0, 0, 0, 0, 0, 0, 2500, '2022-03-25 06:49:35', '2022-03-25 06:49:35'),
(100, '2022-03-25', 'TDi-2203250018', 30000, 0, 0, 0, 0, 33000, 'Aldi', 0, 1, 40000, 0, 0, 0, 0, 0, 0, 3000, '2022-03-25 06:50:27', '2022-03-25 06:50:27'),
(101, '2022-03-25', 'TDi-2203250019', 30000, 0, 0, 0, 0, 33000, 'Aldi', 0, 1, 40000, 0, 0, 0, 0, 0, 0, 3000, '2022-03-25 06:56:16', '2022-03-25 06:56:16'),
(102, '2022-03-25', 'TDi-2203250020', 25000, 0, 0, 0, 0, 28000, 'Aldi', 500, 1, 0, 30000, 0, 0, 0, 0, 0, 2500, '2022-03-25 07:02:56', '2022-03-25 07:02:56'),
(103, '2022-03-25', 'TDi-2203250021', 60000, 0, 0, 0, 0, 66000, 'Aldi', 0, 1, 70000, 0, 0, 0, 0, 0, 0, 6000, '2022-03-25 07:06:08', '2022-03-25 07:06:08'),
(104, '2022-03-25', 'TDi-2203250022', 60000, 0, 0, 0, 0, 66000, 'Aldi', 0, 1, 70000, 0, 0, 0, 0, 0, 0, 6000, '2022-03-25 07:16:03', '2022-03-25 07:16:03'),
(105, '2022-03-25', 'TDi-2203250023', 60000, 0, 0, 0, 0, 66000, 'Aldi', 0, 1, 70000, 0, 0, 0, 0, 0, 0, 6000, '2022-03-25 07:17:33', '2022-03-25 07:17:33'),
(106, '2022-03-25', 'TDe-2203250001', 80000, 0, 0, 0, 0, 144000, 'Aldi', 340, 1, 50000, 100000, 0, 0, 0, 45000, 5600, 13060, '2022-03-25 07:18:44', '2022-03-25 07:18:44'),
(107, '2022-03-25', 'TDi-2203250024', 80000, 0, 0, 0, 0, 88000, 'Aldi', 0, 1, 20000, 20000, 20000, 20000, 20000, 0, 0, 8000, '2022-03-25 07:34:00', '2022-03-25 07:34:00'),
(108, '2022-03-25', 'TDe-2203250002', 80000, 0, 0, 0, 0, 144000, 'Aldi', 340, 1, 20000, 20000, 20000, 20000, 65000, 45000, 5600, 13060, '2022-03-25 07:38:06', '2022-03-25 07:38:06'),
(109, '2022-03-25', 'TDe-2203250003', 80000, 0, 0, 0, 0, 144000, 'Aldi', 340, 1, 20000, 20000, 20000, 20000, 70000, 45000, 5600, 13060, '2022-03-25 07:45:56', '2022-03-25 07:45:56'),
(110, '2022-03-26', 'TDi-2203260001', 60000, 0, 0, 0, 0, 71000, 'Aldi', 380, 1, 75000, 0, 0, 0, 0, 0, 4200, 6420, '2022-03-25 23:58:03', '2022-03-25 23:58:03'),
(111, '2022-03-26', 'SDi-2203260001', 37000, 0, 0, 0, 0, 44000, 'Aldi', 451, 2, 5000, 40000, 0, 0, 0, 0, 2590, 3959, '2022-03-26 00:28:06', '2022-03-26 00:28:06'),
(112, '2022-03-26', 'TDi-2203260002', 42000, 0, 0, 0, 0, 50000, 'Aldi', 566, 1, 0, 60000, 0, 0, 0, 0, 2940, 4494, '2022-03-26 05:20:45', '2022-03-26 05:20:45'),
(113, '2022-03-26', 'TDi-2203260003', 42000, 0, 0, 0, 0, 50000, 'Aldi', 566, 1, 0, 60000, 0, 0, 0, 0, 2940, 4494, '2022-03-26 05:22:11', '2022-03-26 05:22:11'),
(114, '2022-03-26', 'TDi-2203260004', 42000, 0, 0, 0, 0, 50000, 'Aldi', 566, 1, 0, 60000, 0, 0, 0, 0, 2940, 4494, '2022-03-26 05:22:20', '2022-03-26 05:22:20'),
(115, '2022-03-26', 'TDi-2203260005', 42000, 0, 0, 0, 0, 50000, 'Aldi', 566, 1, 0, 60000, 0, 0, 0, 0, 2940, 4494, '2022-03-26 05:22:47', '2022-03-26 05:22:47'),
(116, '2022-03-26', 'TDi-2203260006', 30000, 0, 0, 0, 0, 36000, 'Aldi', 690, 1, 0, 40000, 0, 0, 0, 0, 2100, 3210, '2022-03-26 05:24:11', '2022-03-26 05:24:11'),
(117, '2022-03-26', 'TDe-2203260001', 80000, 0, 0, 0, 0, 144000, 'Aldi', 340, 1, 50000, 100000, 0, 0, 0, 45000, 5600, 13060, '2022-03-26 05:25:08', '2022-03-26 05:25:08'),
(118, '2022-03-26', 'TDi-2203260007', 44000, 0, 0, 0, 0, 52000, 'Aldi', 212, 1, 3000, 50000, 0, 0, 0, 0, 3080, 4708, '2022-03-26 05:34:47', '2022-03-26 05:34:47'),
(119, '2022-03-26', 'TDi-2203260008', 30000, 0, 0, 0, 0, 36000, 'Aldi', 690, 1, 0, 36000, 0, 0, 0, 0, 2100, 3210, '2022-03-26 05:35:54', '2022-03-26 05:35:54'),
(120, '2022-03-26', 'TDi-2203260009', 30000, 0, 0, 0, 0, 36000, 'Aldi', 690, 1, 0, 36000, 0, 0, 0, 0, 2100, 3210, '2022-03-26 05:36:53', '2022-03-26 05:36:53'),
(121, '2022-03-26', 'TDe-2203260002', 80000, 0, 0, 0, 0, 144000, 'Aldi', 340, 1, 70000, 20000, 20000, 20000, 20000, 45000, 5600, 13060, '2022-03-26 05:39:57', '2022-03-26 05:39:57'),
(122, '2022-03-26', 'TDe-2203260003', 80000, 0, 0, 0, 0, 144000, 'Aldi', 340, 1, 70000, 20000, 20000, 20000, 20000, 45000, 5600, 13060, '2022-03-26 05:41:00', '2022-03-26 05:41:00'),
(123, '2022-03-26', 'TDe-2203260004', 80000, 0, 0, 0, 0, 144000, 'Aldi', 340, 1, 70000, 20000, 20000, 20000, 20000, 45000, 5600, 13060, '2022-03-26 05:41:34', '2022-03-26 05:41:34'),
(124, '2022-03-26', 'TDe-2203260005', 80000, 0, 0, 0, 0, 144000, 'Aldi', 340, 1, 70000, 20000, 20000, 20000, 20000, 45000, 5600, 13060, '2022-03-26 05:41:40', '2022-03-26 05:41:40'),
(125, '2022-03-26', 'TDe-2203260006', 80000, 0, 0, 0, 0, 144000, 'Aldi', 340, 1, 70000, 20000, 20000, 20000, 20000, 45000, 5600, 13060, '2022-03-26 05:42:22', '2022-03-26 05:42:22'),
(126, '2022-03-26', 'TDe-2203260007', 60000, 0, 0, 0, 0, 121000, 'Aldi', 880, 1, 45000, 20000, 20000, 20000, 20000, 45000, 4200, 10920, '2022-03-26 05:45:49', '2022-03-26 05:45:49'),
(127, '2022-03-26', 'TDe-2203260008', 160000, 0, 0, 0, 0, 238000, 'Aldi', 180, 1, 10000, 30000, 50000, 50000, 100000, 45000, 11200, 21620, '2022-03-26 05:50:07', '2022-03-26 05:50:07'),
(128, '2022-03-26', 'TDe-2203260009', 80000, 0, 0, 0, 0, 144000, 'Aldi', 340, 1, 70000, 20000, 20000, 20000, 20000, 45000, 5600, 13060, '2022-03-26 05:51:22', '2022-03-26 05:51:22'),
(129, '2022-03-26', 'TDi-2203260010', 30000, 0, 0, 0, 0, 36000, 'Aldi', 690, 1, 0, 36000, 0, 0, 0, 0, 2100, 3210, '2022-03-26 05:52:24', '2022-03-26 05:52:24'),
(130, '2022-03-26', 'SDe-2203260001', 35000, 0, 0, 0, 0, 91000, 'Aldi', 305, 2, 15000, 20000, 20000, 20000, 20000, 45000, 2450, 8245, '2022-03-26 05:53:55', '2022-03-26 05:53:55'),
(131, '2022-03-26', 'SDe-2203260002', 35000, 0, 0, 0, 0, 91000, 'Aldi', 305, 2, 15000, 20000, 20000, 20000, 20000, 45000, 2450, 8245, '2022-03-26 05:55:08', '2022-03-26 05:55:08'),
(132, '2022-03-26', 'SDe-2203260003', 35000, 0, 0, 0, 0, 91000, 'Aldi', 305, 2, 15000, 20000, 20000, 20000, 20000, 45000, 2450, 8245, '2022-03-26 05:55:52', '2022-03-26 05:55:52'),
(133, '2022-03-26', 'SDe-2203260004', 58000, 0, 0, 0, 0, 118000, 'Aldi', 234, 2, 40000, 20000, 20000, 20000, 20000, 45000, 4060, 10706, '2022-03-26 05:56:46', '2022-03-26 05:56:46'),
(134, '2022-03-26', 'SDe-2203260005', 39000, 0, 0, 0, 0, 96000, 'Aldi', 597, 2, 100000, 0, 0, 0, 0, 45000, 2730, 8673, '2022-03-26 05:58:04', '2022-03-26 05:58:04'),
(135, '2022-03-26', 'SDi-2203260002', 35000, 0, 0, 0, 0, 42000, 'Aldi', 805, 2, 50000, 0, 0, 0, 0, 0, 2450, 3745, '2022-03-26 05:59:41', '2022-03-26 05:59:41'),
(136, '2022-03-26', 'SDi-2203260003', 37000, 0, 0, 0, 0, 44000, 'Aldi', 451, 2, 0, 50000, 0, 0, 0, 0, 2590, 3959, '2022-03-26 06:00:28', '2022-03-26 06:00:28'),
(137, '2022-03-26', 'SDi-2203260004', 37000, 0, 0, 0, 0, 44000, 'Aldi', 451, 2, 0, 0, 44000, 0, 0, 0, 2590, 3959, '2022-03-26 06:03:10', '2022-03-26 06:03:10'),
(138, '2022-03-26', 'TDe-2203260010', 42000, 0, 0, 0, 0, 99000, 'Aldi', 66, 1, 10000, 90000, 0, 0, 0, 45000, 2940, 8994, '2022-03-26 06:06:23', '2022-03-26 06:06:23'),
(139, '2022-03-29', 'TDi-2203290001', 80000, 0, 0, 0, 0, 95000, 'Aldi', 840, 1, 100000, 0, 0, 0, 0, 0, 5600, 8560, '2022-03-29 00:07:55', '2022-03-29 00:07:55'),
(140, '2022-03-29', 'TDi-2203290002', 30000, 0, 0, 0, 0, 36000, 'Aldi', 690, 1, 0, 36000, 0, 0, 0, 0, 2100, 3210, '2022-03-29 00:09:32', '2022-03-29 00:09:32'),
(141, '2022-03-29', 'TDi-2203290003', 42000, 0, 0, 0, 0, 50000, 'Aldi', 566, 1, 50000, 0, 0, 0, 0, 0, 2940, 4494, '2022-03-29 00:09:46', '2022-03-29 00:09:46');

-- --------------------------------------------------------

--
-- Table structure for table `tb_voucher`
--

CREATE TABLE `tb_voucher` (
  `id_voucher` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `ket` text NOT NULL,
  `expired` date NOT NULL,
  `status` enum('0','1','','') NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kode` varchar(10) NOT NULL,
  `terpakai` varchar(30) DEFAULT NULL,
  `admin` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_voucher`
--

INSERT INTO `tb_voucher` (`id_voucher`, `jumlah`, `ket`, `expired`, `status`, `lokasi`, `created_at`, `updated_at`, `kode`, `terpakai`, `admin`) VALUES
(17, 50000, '2', '2022-03-01', '', '1', '2022-02-28 18:49:49', '2022-03-01 03:40:40', 'TKMR912602', 'sudah', 'Mas Ari'),
(19, 23, '2', '2022-03-01', '1', '1', '2022-02-28 18:58:12', '2022-02-28 19:00:58', 'TKMR442449', 'terpakai', 'Mas Ari'),
(20, 2, 'Pesan meja 10', '2022-03-03', '', '2', '2022-03-02 21:38:21', '2022-03-02 21:40:09', 'SDB4028492', 'belum', 'unta'),
(22, 10000, 'Pesan meja 10', '2022-03-05', '1', '1', '2022-03-04 16:46:58', '2022-03-04 16:46:58', 'TKMR275901', 'belum', 'Mas Ari'),
(23, 1000222, '2323', '2022-03-26', '1', '1', '2022-03-25 05:25:30', '2022-03-25 05:33:09', 'TKMR214171', 'belum', 'Aldi'),
(24, 50000, 'tes', '2022-03-30', '', '1', '2022-03-25 06:26:52', '2022-03-25 06:46:04', 'TKMR791251', 'sudah', 'Aldi');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_posisi` int(11) NOT NULL,
  `jenis` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `id_posisi`, `jenis`, `created_at`, `updated_at`) VALUES
(27, 'Aldi', '1', '$2y$10$.tHKH4/zs6B6j17zqn9Fz.7XyAYhuBGw.9IPodPa7ymComP8RxZ92', 1, 'adm', '2022-01-30 17:46:04', '2022-01-30 17:46:04'),
(47, 'Mas Ari', '2', '$2y$10$nsZq53EkzgXvPFHykWmoruQFUpoZGfo6oCdM8cxjOPJbBo0hjtkW6', 3, 'tkm', '2022-02-27 21:10:25', '2022-02-27 21:10:25'),
(48, 'Head', '21', '$2y$10$z7/hBnamzs3thmne9IlOIuiF4NCuY8VCFFW7zg/pFCNYYoRltxNyO', 2, 'tkm', '2022-02-27 21:10:38', '2022-02-27 21:10:38'),
(49, 'unta', 'sdb', '$2y$10$hvpC6a0pHPPX7Y0RhYbxXu/6OI3sXkWRDHUhGtfVh3MHfY1VzumU.', 1, 'sdb', '2022-03-01 21:05:22', '2022-03-01 21:05:22'),
(50, 'bama', 'bama', '$2y$10$Gfs72GlgtLaViQryjCfzAeenbWNDA2pkFOs4lagsXGBkZqeBORtGG', 2, 'tkm', '2022-03-03 19:07:08', '2022-03-03 19:07:08');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_koki_masak`
-- (See below for the actual view)
--
CREATE TABLE `view_koki_masak` (
`id_order` int(11)
,`tgl` date
,`id_lokasi` int(11)
,`nm_lokasi` varchar(50)
,`nm_distribusi` varchar(20)
,`no_order` varchar(20)
,`nm_menu` varchar(120)
,`qty` double
,`koki1` varchar(50)
,`koki2` varchar(50)
,`koki3` varchar(50)
,`menit` int(2)
,`menit_bagi` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_mencuci`
-- (See below for the actual view)
--
CREATE TABLE `view_mencuci` (
`id_mencuci` int(11)
,`nm_karyawan` varchar(50)
,`id_ket` int(11)
,`j_awal` time
,`j_akhir` time
,`tgl` date
,`admin` varchar(40)
,`lama_cuci` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_menu`
-- (See below for the actual view)
--
CREATE TABLE `view_menu` (
`id_harga` int(11)
,`id_menu` int(11)
,`id_distribusi` int(11)
,`harga` double
,`nm_menu` varchar(120)
,`nm_distribusi` varchar(20)
,`image` varchar(100)
,`akv` enum('on','off')
,`lokasi` tinyint(4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_menu2`
-- (See below for the actual view)
--
CREATE TABLE `view_menu2` (
`id_harga` int(11)
,`id_menu` int(11)
,`id_distribusi` int(11)
,`harga` double
,`nm_menu` varchar(120)
,`nm_distribusi` varchar(20)
,`image` varchar(100)
,`akv` enum('on','off')
,`lokasi` tinyint(4)
,`id_kategori` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_menu_kategori`
-- (See below for the actual view)
--
CREATE TABLE `view_menu_kategori` (
`id_menu` int(11)
,`id_harga` int(11)
,`nm_menu` varchar(120)
,`nm_distribusi` varchar(20)
,`harga` double
,`image` varchar(100)
,`id_distribusi` int(11)
,`lokasi` tinyint(4)
,`id_kategori` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_nilai_masak`
-- (See below for the actual view)
--
CREATE TABLE `view_nilai_masak` (
`id_order` int(11)
,`tgl` date
,`no_order` varchar(20)
,`id_harga` int(11)
,`id_lokasi` int(11)
,`id_distribusi` int(11)
,`qty` double
,`id_koki1` int(11)
,`id_koki2` int(11)
,`id_koki3` int(11)
,`lama_masak` bigint(21)
,`nilai_koki` double
,`jml_koki` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_nilai_masak2`
-- (See below for the actual view)
--
CREATE TABLE `view_nilai_masak2` (
`id_order` int(11)
,`tgl` date
,`no_order` varchar(20)
,`id_harga` int(11)
,`id_lokasi` int(11)
,`id_distribusi` int(11)
,`qty` double
,`koki` int(11)
,`lama_masak` bigint(21)
,`nilai_koki` double
,`jml_koki` int(11)
,`ket` varchar(5)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_waktu`
-- (See below for the actual view)
--
CREATE TABLE `view_waktu` (
`nm_menu` varchar(120)
,`nm_meja` varchar(20)
,`id_order` int(11)
,`no_order` varchar(20)
,`id_harga` int(11)
,`qty` double
,`harga` double
,`request` varchar(100)
,`tambahan` int(11)
,`page` int(11)
,`id_meja` int(11)
,`selesai` enum('dimasak','selesai','diantar')
,`id_lokasi` int(11)
,`pengantar` varchar(20)
,`tgl` date
,`admin` varchar(20)
,`void` int(11)
,`round` double
,`alasan` varchar(40)
,`nm_void` varchar(100)
,`j_mulai` datetime
,`j_selesai` datetime
,`diskon` double
,`wait` datetime
,`aktif` int(11)
,`id_koki1` int(11)
,`id_koki2` int(11)
,`id_koki3` int(11)
,`ongkir` double
,`id_distribusi` int(11)
,`orang` double
,`no_checker` enum('T','Y')
,`print` enum('T','Y')
,`copy_print` enum('T','Y')
,`created_at` timestamp
,`updated_at` timestamp
,`selisih` bigint(21)
,`wait_2` bigint(21)
);

-- --------------------------------------------------------

--
-- Structure for view `menu1`
--
DROP TABLE IF EXISTS `menu1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `menu1`  AS SELECT `b`.`nm_menu` AS `nm_menu`, `c`.`nm_meja` AS `nm_meja`, `a`.`id_order` AS `id_order`, `a`.`no_order` AS `no_order`, `a`.`id_harga` AS `id_harga`, `a`.`qty` AS `qty`, `a`.`harga` AS `harga`, `a`.`request` AS `request`, `a`.`tambahan` AS `tambahan`, `a`.`page` AS `page`, `a`.`id_meja` AS `id_meja`, `a`.`selesai` AS `selesai`, `a`.`id_lokasi` AS `id_lokasi`, `a`.`pengantar` AS `pengantar`, `a`.`tgl` AS `tgl`, `a`.`admin` AS `admin`, `a`.`void` AS `void`, `a`.`round` AS `round`, `a`.`alasan` AS `alasan`, `a`.`nm_void` AS `nm_void`, `a`.`j_mulai` AS `j_mulai`, `a`.`j_selesai` AS `j_selesai`, `a`.`diskon` AS `diskon`, `a`.`wait` AS `wait`, `a`.`aktif` AS `aktif`, `a`.`id_koki1` AS `id_koki1`, `a`.`id_koki2` AS `id_koki2`, `a`.`id_koki3` AS `id_koki3`, `a`.`ongkir` AS `ongkir`, `a`.`id_distribusi` AS `id_distribusi`, `a`.`orang` AS `orang`, `a`.`no_checker` AS `no_checker`, `a`.`print` AS `print`, `a`.`copy_print` AS `copy_print`, `a`.`created_at` AS `created_at`, `a`.`updated_at` AS `updated_at`, timestampdiff(MINUTE,`a`.`j_mulai`,`a`.`wait`) AS `selisih` FROM ((`tb_order` `a` left join `view_menu` `b` on(`b`.`id_harga` = `a`.`id_harga`)) left join `tb_meja` `c` on(`c`.`id_meja` = `a`.`id_meja`)) WHERE `a`.`selesai` <> 'selesai' AND `a`.`aktif` = '1' AND `a`.`void` = 0 ORDER BY `a`.`selesai` DESC ;

-- --------------------------------------------------------

--
-- Structure for view `menu2`
--
DROP TABLE IF EXISTS `menu2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `menu2`  AS SELECT `b`.`nm_menu` AS `nm_menu`, `c`.`nm_meja` AS `nm_meja`, `a`.`id_order` AS `id_order`, `a`.`no_order` AS `no_order`, `a`.`id_harga` AS `id_harga`, `a`.`qty` AS `qty`, `a`.`harga` AS `harga`, `a`.`request` AS `request`, `a`.`tambahan` AS `tambahan`, `a`.`page` AS `page`, `a`.`id_meja` AS `id_meja`, `a`.`selesai` AS `selesai`, `a`.`id_lokasi` AS `id_lokasi`, `a`.`pengantar` AS `pengantar`, `a`.`tgl` AS `tgl`, `a`.`admin` AS `admin`, `a`.`void` AS `void`, `a`.`round` AS `round`, `a`.`alasan` AS `alasan`, `a`.`nm_void` AS `nm_void`, `a`.`j_mulai` AS `j_mulai`, `a`.`j_selesai` AS `j_selesai`, `a`.`diskon` AS `diskon`, `a`.`wait` AS `wait`, `a`.`aktif` AS `aktif`, `a`.`id_koki1` AS `id_koki1`, `a`.`id_koki2` AS `id_koki2`, `a`.`id_koki3` AS `id_koki3`, `a`.`ongkir` AS `ongkir`, `a`.`id_distribusi` AS `id_distribusi`, `a`.`orang` AS `orang`, `a`.`no_checker` AS `no_checker`, `a`.`print` AS `print`, `a`.`copy_print` AS `copy_print`, `a`.`created_at` AS `created_at`, `a`.`updated_at` AS `updated_at`, timestampdiff(MINUTE,`a`.`j_mulai`,`a`.`wait`) AS `selisih` FROM ((`tb_order` `a` left join `view_menu` `b` on(`b`.`id_harga` = `a`.`id_harga`)) left join `tb_meja` `c` on(`c`.`id_meja` = `a`.`id_meja`)) WHERE `a`.`selesai` = 'selesai' AND `a`.`aktif` = '1' AND `a`.`void` = 0 ;

-- --------------------------------------------------------

--
-- Structure for view `view_koki_masak`
--
DROP TABLE IF EXISTS `view_koki_masak`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_koki_masak`  AS SELECT `tb_order`.`id_order` AS `id_order`, `tb_order`.`tgl` AS `tgl`, `tb_lokasi`.`id_lokasi` AS `id_lokasi`, `tb_lokasi`.`nm_lokasi` AS `nm_lokasi`, `tb_distribusi`.`nm_distribusi` AS `nm_distribusi`, `tb_order`.`no_order` AS `no_order`, `view_menu`.`nm_menu` AS `nm_menu`, `tb_order`.`qty` AS `qty`, `a`.`nama` AS `koki1`, `b`.`nama` AS `koki2`, `c`.`nama` AS `koki3`, minute(timediff(`tb_order`.`j_mulai`,`tb_order`.`j_selesai`)) AS `menit`, minute(timediff(`tb_order`.`j_mulai`,`tb_order`.`j_selesai`)) / `tb_order`.`qty` AS `menit_bagi` FROM ((((((`tb_order` left join `tb_lokasi` on(`tb_order`.`id_lokasi` = `tb_lokasi`.`id_lokasi`)) left join `view_menu` on(`tb_order`.`id_harga` = `view_menu`.`id_harga`)) left join `tb_distribusi` on(`tb_order`.`id_distribusi` = `tb_distribusi`.`id_distribusi`)) left join `tb_karyawan` `a` on(`tb_order`.`id_koki1` = `a`.`id_karyawan`)) left join `tb_karyawan` `b` on(`tb_order`.`id_koki2` = `b`.`id_karyawan`)) left join `tb_karyawan` `c` on(`tb_order`.`id_koki3` = `c`.`id_karyawan`)) WHERE `tb_order`.`aktif` = 2 AND `tb_order`.`void` = 0 ;

-- --------------------------------------------------------

--
-- Structure for view `view_mencuci`
--
DROP TABLE IF EXISTS `view_mencuci`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_mencuci`  AS SELECT `tb_mencuci`.`id_mencuci` AS `id_mencuci`, `tb_mencuci`.`nm_karyawan` AS `nm_karyawan`, `tb_mencuci`.`id_ket` AS `id_ket`, `tb_mencuci`.`j_awal` AS `j_awal`, `tb_mencuci`.`j_akhir` AS `j_akhir`, `tb_mencuci`.`tgl` AS `tgl`, `tb_mencuci`.`admin` AS `admin`, timestampdiff(MINUTE,`tb_mencuci`.`j_awal`,`tb_mencuci`.`j_akhir`) AS `lama_cuci` FROM `tb_mencuci` ;

-- --------------------------------------------------------

--
-- Structure for view `view_menu`
--
DROP TABLE IF EXISTS `view_menu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_menu`  AS SELECT `a`.`id_harga` AS `id_harga`, `a`.`id_menu` AS `id_menu`, `a`.`id_distribusi` AS `id_distribusi`, `a`.`harga` AS `harga`, `b`.`nm_menu` AS `nm_menu`, `c`.`nm_distribusi` AS `nm_distribusi`, `b`.`image` AS `image`, `b`.`aktif` AS `akv`, `b`.`lokasi` AS `lokasi` FROM ((`tb_harga` `a` left join `tb_menu` `b` on(`a`.`id_menu` = `b`.`id_menu`)) left join `tb_distribusi` `c` on(`a`.`id_distribusi` = `c`.`id_distribusi`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_menu2`
--
DROP TABLE IF EXISTS `view_menu2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_menu2`  AS SELECT `a`.`id_harga` AS `id_harga`, `a`.`id_menu` AS `id_menu`, `a`.`id_distribusi` AS `id_distribusi`, `a`.`harga` AS `harga`, `b`.`nm_menu` AS `nm_menu`, `c`.`nm_distribusi` AS `nm_distribusi`, `b`.`image` AS `image`, `b`.`aktif` AS `akv`, `b`.`lokasi` AS `lokasi`, `b`.`id_kategori` AS `id_kategori` FROM ((`tb_harga` `a` left join `tb_menu` `b` on(`a`.`id_menu` = `b`.`id_menu`)) left join `tb_distribusi` `c` on(`a`.`id_distribusi` = `c`.`id_distribusi`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_menu_kategori`
--
DROP TABLE IF EXISTS `view_menu_kategori`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_menu_kategori`  AS SELECT `a`.`id_menu` AS `id_menu`, `a`.`id_harga` AS `id_harga`, `b`.`nm_menu` AS `nm_menu`, `c`.`nm_distribusi` AS `nm_distribusi`, `a`.`harga` AS `harga`, `b`.`image` AS `image`, `a`.`id_distribusi` AS `id_distribusi`, `b`.`lokasi` AS `lokasi`, `b`.`id_kategori` AS `id_kategori` FROM ((`tb_harga` `a` left join `tb_menu` `b` on(`b`.`id_menu` = `a`.`id_menu`)) left join `tb_distribusi` `c` on(`c`.`id_distribusi` = `a`.`id_distribusi`)) GROUP BY `a`.`id_harga` ;

-- --------------------------------------------------------

--
-- Structure for view `view_nilai_masak`
--
DROP TABLE IF EXISTS `view_nilai_masak`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_nilai_masak`  AS SELECT `tb_order`.`id_order` AS `id_order`, `tb_order`.`tgl` AS `tgl`, `tb_order`.`no_order` AS `no_order`, `tb_order`.`id_harga` AS `id_harga`, `tb_order`.`id_lokasi` AS `id_lokasi`, `tb_order`.`id_distribusi` AS `id_distribusi`, `tb_order`.`qty` AS `qty`, `tb_order`.`id_koki1` AS `id_koki1`, `tb_order`.`id_koki2` AS `id_koki2`, `tb_order`.`id_koki3` AS `id_koki3`, timestampdiff(MINUTE,`tb_order`.`j_mulai`,`tb_order`.`j_selesai`) AS `lama_masak`, if(`tb_order`.`id_koki1` > 0 and `tb_order`.`id_koki2` > 0 and `tb_order`.`id_koki3` > 0,`tb_order`.`qty` / 3,if(`tb_order`.`id_koki1` > 0 and `tb_order`.`id_koki2` > 0,`tb_order`.`qty` / 2,`tb_order`.`qty`)) AS `nilai_koki`, if(`tb_order`.`id_koki1` > 0 and `tb_order`.`id_koki2` > 0 and `tb_order`.`id_koki3` > 0,3,if(`tb_order`.`id_koki1` > 0 and `tb_order`.`id_koki2` > 0,2,1)) AS `jml_koki` FROM `tb_order` WHERE `tb_order`.`void` = 0 AND `tb_order`.`aktif` = 2 ;

-- --------------------------------------------------------

--
-- Structure for view `view_nilai_masak2`
--
DROP TABLE IF EXISTS `view_nilai_masak2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_nilai_masak2`  AS SELECT `koki_masak`.`id_order` AS `id_order`, `koki_masak`.`tgl` AS `tgl`, `koki_masak`.`no_order` AS `no_order`, `koki_masak`.`id_harga` AS `id_harga`, `koki_masak`.`id_lokasi` AS `id_lokasi`, `koki_masak`.`id_distribusi` AS `id_distribusi`, `koki_masak`.`qty` AS `qty`, `koki_masak`.`koki` AS `koki`, `koki_masak`.`lama_masak` AS `lama_masak`, `koki_masak`.`nilai_koki` AS `nilai_koki`, `koki_masak`.`jml_koki` AS `jml_koki`, `koki_masak`.`ket` AS `ket` FROM (select `view_nilai_masak`.`id_order` AS `id_order`,`view_nilai_masak`.`tgl` AS `tgl`,`view_nilai_masak`.`no_order` AS `no_order`,`view_nilai_masak`.`id_harga` AS `id_harga`,`view_nilai_masak`.`id_lokasi` AS `id_lokasi`,`view_nilai_masak`.`id_distribusi` AS `id_distribusi`,`view_nilai_masak`.`qty` AS `qty`,`view_nilai_masak`.`id_koki1` AS `koki`,`view_nilai_masak`.`lama_masak` AS `lama_masak`,`view_nilai_masak`.`nilai_koki` AS `nilai_koki`,`view_nilai_masak`.`jml_koki` AS `jml_koki`,'koki1' AS `ket` from `view_nilai_masak` where `view_nilai_masak`.`id_koki1` > 0 union all select `view_nilai_masak`.`id_order` AS `id_order`,`view_nilai_masak`.`tgl` AS `tgl`,`view_nilai_masak`.`no_order` AS `no_order`,`view_nilai_masak`.`id_harga` AS `id_harga`,`view_nilai_masak`.`id_lokasi` AS `id_lokasi`,`view_nilai_masak`.`id_distribusi` AS `id_distribusi`,`view_nilai_masak`.`qty` AS `qty`,`view_nilai_masak`.`id_koki2` AS `koki`,`view_nilai_masak`.`lama_masak` AS `lama_masak`,`view_nilai_masak`.`nilai_koki` AS `nilai_koki`,`view_nilai_masak`.`jml_koki` AS `jml_koki`,'koki2' AS `ket` from `view_nilai_masak` where `view_nilai_masak`.`id_koki2` > 0 union all select `view_nilai_masak`.`id_order` AS `id_order`,`view_nilai_masak`.`tgl` AS `tgl`,`view_nilai_masak`.`no_order` AS `no_order`,`view_nilai_masak`.`id_harga` AS `id_harga`,`view_nilai_masak`.`id_lokasi` AS `id_lokasi`,`view_nilai_masak`.`id_distribusi` AS `id_distribusi`,`view_nilai_masak`.`qty` AS `qty`,`view_nilai_masak`.`id_koki3` AS `koki`,`view_nilai_masak`.`lama_masak` AS `lama_masak`,`view_nilai_masak`.`nilai_koki` AS `nilai_koki`,`view_nilai_masak`.`jml_koki` AS `jml_koki`,'koki3' AS `ket` from `view_nilai_masak` where `view_nilai_masak`.`id_koki3` > 0) AS `koki_masak` ORDER BY `koki_masak`.`id_order` ASC, `koki_masak`.`ket` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `view_waktu`
--
DROP TABLE IF EXISTS `view_waktu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_waktu`  AS SELECT `b`.`nm_menu` AS `nm_menu`, `c`.`nm_meja` AS `nm_meja`, `a`.`id_order` AS `id_order`, `a`.`no_order` AS `no_order`, `a`.`id_harga` AS `id_harga`, `a`.`qty` AS `qty`, `a`.`harga` AS `harga`, `a`.`request` AS `request`, `a`.`tambahan` AS `tambahan`, `a`.`page` AS `page`, `a`.`id_meja` AS `id_meja`, `a`.`selesai` AS `selesai`, `a`.`id_lokasi` AS `id_lokasi`, `a`.`pengantar` AS `pengantar`, `a`.`tgl` AS `tgl`, `a`.`admin` AS `admin`, `a`.`void` AS `void`, `a`.`round` AS `round`, `a`.`alasan` AS `alasan`, `a`.`nm_void` AS `nm_void`, `a`.`j_mulai` AS `j_mulai`, `a`.`j_selesai` AS `j_selesai`, `a`.`diskon` AS `diskon`, `a`.`wait` AS `wait`, `a`.`aktif` AS `aktif`, `a`.`id_koki1` AS `id_koki1`, `a`.`id_koki2` AS `id_koki2`, `a`.`id_koki3` AS `id_koki3`, `a`.`ongkir` AS `ongkir`, `a`.`id_distribusi` AS `id_distribusi`, `a`.`orang` AS `orang`, `a`.`no_checker` AS `no_checker`, `a`.`print` AS `print`, `a`.`copy_print` AS `copy_print`, `a`.`created_at` AS `created_at`, `a`.`updated_at` AS `updated_at`, timestampdiff(MINUTE,`a`.`j_mulai`,`a`.`j_selesai`) AS `selisih`, timestampdiff(MINUTE,`a`.`j_selesai`,`a`.`wait`) AS `wait_2` FROM ((`tb_order` `a` left join `view_menu` `b` on(`b`.`id_harga` = `a`.`id_harga`)) left join `tb_meja` `c` on(`c`.`id_meja` = `a`.`id_meja`)) WHERE `a`.`selesai` = 'selesai' AND `a`.`aktif` = '1' AND `a`.`void` = 0 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktiva`
--
ALTER TABLE `aktiva`
  ADD PRIMARY KEY (`id_aktiva`);

--
-- Indexes for table `ctt_driver`
--
ALTER TABLE `ctt_driver`
  ADD PRIMARY KEY (`id_driver`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `homes`
--
ALTER TABLE `homes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `tb_absen`
--
ALTER TABLE `tb_absen`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indexes for table `tb_akun`
--
ALTER TABLE `tb_akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `tb_atk`
--
ALTER TABLE `tb_atk`
  ADD PRIMARY KEY (`id_atk`);

--
-- Indexes for table `tb_batas_ongkir`
--
ALTER TABLE `tb_batas_ongkir`
  ADD PRIMARY KEY (`id_batas_ongkir`);

--
-- Indexes for table `tb_denda`
--
ALTER TABLE `tb_denda`
  ADD PRIMARY KEY (`id_denda`);

--
-- Indexes for table `tb_discount`
--
ALTER TABLE `tb_discount`
  ADD PRIMARY KEY (`id_discount`);

--
-- Indexes for table `tb_distribusi`
--
ALTER TABLE `tb_distribusi`
  ADD PRIMARY KEY (`id_distribusi`);

--
-- Indexes for table `tb_dp`
--
ALTER TABLE `tb_dp`
  ADD PRIMARY KEY (`id_dp`);

--
-- Indexes for table `tb_gaji`
--
ALTER TABLE `tb_gaji`
  ADD PRIMARY KEY (`id_gaji`);

--
-- Indexes for table `tb_harga`
--
ALTER TABLE `tb_harga`
  ADD PRIMARY KEY (`id_harga`);

--
-- Indexes for table `tb_jurnal`
--
ALTER TABLE `tb_jurnal`
  ADD PRIMARY KEY (`id_jurnal`);

--
-- Indexes for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `tb_kasbon`
--
ALTER TABLE `tb_kasbon`
  ADD PRIMARY KEY (`id_kasbon`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kelompok_peralatan`
--
ALTER TABLE `tb_kelompok_peralatan`
  ADD PRIMARY KEY (`id_kelompok`);

--
-- Indexes for table `tb_koki`
--
ALTER TABLE `tb_koki`
  ADD PRIMARY KEY (`id_koki`);

--
-- Indexes for table `tb_limit`
--
ALTER TABLE `tb_limit`
  ADD PRIMARY KEY (`id_limit`);

--
-- Indexes for table `tb_lokasi`
--
ALTER TABLE `tb_lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `tb_meja`
--
ALTER TABLE `tb_meja`
  ADD PRIMARY KEY (`id_meja`);

--
-- Indexes for table `tb_mencuci`
--
ALTER TABLE `tb_mencuci`
  ADD PRIMARY KEY (`id_mencuci`);

--
-- Indexes for table `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `tb_navbar`
--
ALTER TABLE `tb_navbar`
  ADD PRIMARY KEY (`id_navbar`);

--
-- Indexes for table `tb_ongkir`
--
ALTER TABLE `tb_ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `tb_order2`
--
ALTER TABLE `tb_order2`
  ADD PRIMARY KEY (`id_order2`);

--
-- Indexes for table `tb_penanggung_jawab`
--
ALTER TABLE `tb_penanggung_jawab`
  ADD PRIMARY KEY (`id_penanggung`);

--
-- Indexes for table `tb_peralatan`
--
ALTER TABLE `tb_peralatan`
  ADD PRIMARY KEY (`id_peralatan`);

--
-- Indexes for table `tb_peringatan`
--
ALTER TABLE `tb_peringatan`
  ADD PRIMARY KEY (`id_peringatan`);

--
-- Indexes for table `tb_posisi`
--
ALTER TABLE `tb_posisi`
  ADD PRIMARY KEY (`id_posisi`);

--
-- Indexes for table `tb_post_center`
--
ALTER TABLE `tb_post_center`
  ADD PRIMARY KEY (`id_post`);

--
-- Indexes for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_sold_out`
--
ALTER TABLE `tb_sold_out`
  ADD PRIMARY KEY (`id_sold_out`);

--
-- Indexes for table `tb_status`
--
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `tb_sub_navbar`
--
ALTER TABLE `tb_sub_navbar`
  ADD PRIMARY KEY (`id_sub_navbar`);

--
-- Indexes for table `tb_tips`
--
ALTER TABLE `tb_tips`
  ADD PRIMARY KEY (`id_tips`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `tb_voucher`
--
ALTER TABLE `tb_voucher`
  ADD PRIMARY KEY (`id_voucher`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktiva`
--
ALTER TABLE `aktiva`
  MODIFY `id_aktiva` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ctt_driver`
--
ALTER TABLE `ctt_driver`
  MODIFY `id_driver` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homes`
--
ALTER TABLE `homes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id_order` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_absen`
--
ALTER TABLE `tb_absen`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `tb_akun`
--
ALTER TABLE `tb_akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `tb_atk`
--
ALTER TABLE `tb_atk`
  MODIFY `id_atk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_batas_ongkir`
--
ALTER TABLE `tb_batas_ongkir`
  MODIFY `id_batas_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_denda`
--
ALTER TABLE `tb_denda`
  MODIFY `id_denda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `tb_discount`
--
ALTER TABLE `tb_discount`
  MODIFY `id_discount` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_distribusi`
--
ALTER TABLE `tb_distribusi`
  MODIFY `id_distribusi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_dp`
--
ALTER TABLE `tb_dp`
  MODIFY `id_dp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tb_gaji`
--
ALTER TABLE `tb_gaji`
  MODIFY `id_gaji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tb_harga`
--
ALTER TABLE `tb_harga`
  MODIFY `id_harga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=887;

--
-- AUTO_INCREMENT for table `tb_jurnal`
--
ALTER TABLE `tb_jurnal`
  MODIFY `id_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `tb_kasbon`
--
ALTER TABLE `tb_kasbon`
  MODIFY `id_kasbon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `tb_kelompok_peralatan`
--
ALTER TABLE `tb_kelompok_peralatan`
  MODIFY `id_kelompok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_koki`
--
ALTER TABLE `tb_koki`
  MODIFY `id_koki` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_limit`
--
ALTER TABLE `tb_limit`
  MODIFY `id_limit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_lokasi`
--
ALTER TABLE `tb_lokasi`
  MODIFY `id_lokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_meja`
--
ALTER TABLE `tb_meja`
  MODIFY `id_meja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=372;

--
-- AUTO_INCREMENT for table `tb_mencuci`
--
ALTER TABLE `tb_mencuci`
  MODIFY `id_mencuci` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_menu`
--
ALTER TABLE `tb_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=502;

--
-- AUTO_INCREMENT for table `tb_navbar`
--
ALTER TABLE `tb_navbar`
  MODIFY `id_navbar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=275;

--
-- AUTO_INCREMENT for table `tb_ongkir`
--
ALTER TABLE `tb_ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tb_order2`
--
ALTER TABLE `tb_order2`
  MODIFY `id_order2` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tb_penanggung_jawab`
--
ALTER TABLE `tb_penanggung_jawab`
  MODIFY `id_penanggung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_peralatan`
--
ALTER TABLE `tb_peralatan`
  MODIFY `id_peralatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_peringatan`
--
ALTER TABLE `tb_peringatan`
  MODIFY `id_peringatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tb_posisi`
--
ALTER TABLE `tb_posisi`
  MODIFY `id_posisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_post_center`
--
ALTER TABLE `tb_post_center`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tb_sold_out`
--
ALTER TABLE `tb_sold_out`
  MODIFY `id_sold_out` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tb_status`
--
ALTER TABLE `tb_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_sub_navbar`
--
ALTER TABLE `tb_sub_navbar`
  MODIFY `id_sub_navbar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `tb_tips`
--
ALTER TABLE `tb_tips`
  MODIFY `id_tips` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `tb_voucher`
--
ALTER TABLE `tb_voucher`
  MODIFY `id_voucher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
