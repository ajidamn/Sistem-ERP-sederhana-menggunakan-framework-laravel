-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2023 at 02:53 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `npa`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `kode` bigint(20) UNSIGNED NOT NULL,
  `transaksi` varchar(30) NOT NULL,
  `kode_pembuat` varchar(30) NOT NULL,
  `kode_pemeriksa` varchar(30) DEFAULT NULL,
  `diperiksa` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`kode`, `transaksi`, `kode_pembuat`, `kode_pemeriksa`, `diperiksa`, `created_at`, `updated_at`) VALUES
(1, 'PO.21.230310.0001', 'NPA.0001', 'NPA.0001', '2023-03-10 07:42:21', '2023-03-10 00:41:38', '2023-03-10 07:42:21'),
(2, 'MR.61.230310.0001', 'NPA.0001', 'NPA.0001', '2023-03-10 08:31:55', '2023-03-10 01:31:42', '2023-03-10 08:30:43'),
(3, 'SO.61.230310.0001', 'NPA.0001', 'NPA.0001', '2023-03-10 09:37:49', '2023-03-10 09:36:06', '2023-03-10 09:36:06'),
(5, 'SJ.41.230310.0001', 'NPA.0001', 'NPA.0001', '2023-03-10 09:55:33', '2023-03-10 02:42:02', '2023-03-10 09:55:32'),
(6, 'INV.230310.0001', 'NPA.0001', 'NPA.0001', '2023-03-10 09:56:28', '2023-03-10 09:37:56', '2023-03-10 09:56:27');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `kode` bigint(20) UNSIGNED NOT NULL,
  `bank` varchar(20) NOT NULL,
  `rekening` varchar(20) NOT NULL,
  `atas_nama` varchar(40) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`kode`, `bank`, `rekening`, `atas_nama`, `created_at`, `updated_at`) VALUES
(1, 'Mandiri', '68612381923', 'Daris Rafid', '2023-03-10 07:05:47', '2023-03-10 00:05:48'),
(2, 'Mandiri', '763834299', 'CV. Nusa Pratama Anugrah', '2023-03-10 07:06:05', '2023-03-10 00:06:06'),
(3, 'KAS', '0', 'TUNAI', '2023-03-10 07:06:27', '2023-03-10 00:06:27');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kode` varchar(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `packing` varchar(20) NOT NULL,
  `perusahaan` varchar(50) NOT NULL,
  `kd_persediaan` varchar(7) NOT NULL,
  `kd_persediaan_hpp` varchar(7) NOT NULL,
  `kd_pendapatan` varchar(7) NOT NULL,
  `kd_persediaan_intransit` varchar(7) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode`, `nama`, `jenis`, `satuan`, `packing`, `perusahaan`, `kd_persediaan`, `kd_persediaan_hpp`, `kd_pendapatan`, `kd_persediaan_intransit`, `keterangan`, `created_at`, `updated_at`) VALUES
('000001', 'Soda Ash', 'PADAT', 'KG', 'SAK', 'Pt. Toya Indo Manunggal', '170.2', '410', '400', '172', 'Soda Ash @25kg\nPutih Bersih\nex China', '2023-03-10 00:07:33', '2023-03-10 00:07:33'),
('000002', 'Alkohol Foodgrade', 'CAIR', 'LITER', 'DRUM', 'Pt. Toya Indo Manunggal', '170.1', '410', '400', '172', 'alkohol foograde @200L', '2023-03-10 00:08:22', '2023-03-10 00:08:22'),
('000003', 'Belerang Granul', 'PADAT', 'KG', 'SAK', 'Cv. Intech Jaya', '170.2', '410', '400', '172', '--', '2023-03-10 00:08:53', '2023-03-10 00:08:53');

-- --------------------------------------------------------

--
-- Table structure for table `detail_invoice`
--

CREATE TABLE `detail_invoice` (
  `kode` bigint(20) UNSIGNED NOT NULL,
  `kode_inv` varchar(25) NOT NULL,
  `tgl_kirim` date NOT NULL,
  `tgl_terima` date NOT NULL,
  `kode_gdg` varchar(10) NOT NULL,
  `kode_brg` varchar(15) NOT NULL,
  `diakui` float NOT NULL,
  `dikirim` float NOT NULL,
  `diterima` float NOT NULL,
  `nama_request` varchar(50) DEFAULT NULL,
  `harga_jual` float NOT NULL,
  `dpp` float NOT NULL,
  `jumlah` float NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `debit` varchar(10) NOT NULL,
  `kredit` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_invoice`
--

INSERT INTO `detail_invoice` (`kode`, `kode_inv`, `tgl_kirim`, `tgl_terima`, `kode_gdg`, `kode_brg`, `diakui`, `dikirim`, `diterima`, `nama_request`, `harga_jual`, `dpp`, `jumlah`, `keterangan`, `debit`, `kredit`, `created_at`, `updated_at`) VALUES
(1, 'INV.230310.0001', '2023-03-10', '2023-03-10', 'BB', '000001', 1200, 1200, 1200, NULL, 9000, 10800000, 11988000, 'Soda Ash @25kg\nPutih Bersih\nex China', '12', '40', '2023-03-10 02:45:14', '2023-03-10 02:45:14');

-- --------------------------------------------------------

--
-- Table structure for table `detail_kas`
--

CREATE TABLE `detail_kas` (
  `kode` varchar(255) NOT NULL,
  `kode_kas` varchar(255) NOT NULL,
  `kode_transaksi` varchar(30) DEFAULT NULL,
  `kode_brg` varchar(255) DEFAULT NULL,
  `vat` double NOT NULL,
  `harga` float NOT NULL,
  `qty` float NOT NULL,
  `total` float NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `debit` varchar(7) NOT NULL,
  `kredit` varchar(7) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_kas`
--

INSERT INTO `detail_kas` (`kode`, `kode_kas`, `kode_transaksi`, `kode_brg`, `vat`, `harga`, `qty`, `total`, `keterangan`, `debit`, `kredit`, `created_at`, `updated_at`) VALUES
('1', 'KAS.230310.001', 'INV.230310.0001', '000001', 11, 9000, 1200, 11988000, 'Soda Ash @25kg\nPutih Bersih\nex China', '101.1', '12', '2023-03-10 03:41:10', '2023-03-10 03:41:10');

-- --------------------------------------------------------

--
-- Table structure for table `detail_mr`
--

CREATE TABLE `detail_mr` (
  `kode` bigint(20) UNSIGNED NOT NULL,
  `kode_mr` varchar(20) NOT NULL,
  `kode_brg` varchar(10) NOT NULL,
  `kode_gdg` varchar(10) NOT NULL,
  `harga` float NOT NULL,
  `dikirim` float NOT NULL,
  `diakui` float NOT NULL,
  `diterima` float NOT NULL,
  `dpp` float NOT NULL,
  `vat` float NOT NULL,
  `total` float NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `kode_debit` varchar(5) DEFAULT NULL,
  `kode_kredit` varchar(5) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_mr`
--

INSERT INTO `detail_mr` (`kode`, `kode_mr`, `kode_brg`, `kode_gdg`, `harga`, `dikirim`, `diakui`, `diterima`, `dpp`, `vat`, `total`, `keterangan`, `kode_debit`, `kode_kredit`, `created_at`, `updated_at`) VALUES
(1, 'MR.61.230310.0001', '000001', 'BB', 7600.5, 3000, 3000, 3000, 22801500, 11, 25309700, '--', '170.2', '300', '2023-03-10 08:30:43', '2023-03-10 01:30:43');

-- --------------------------------------------------------

--
-- Table structure for table `detail_po`
--

CREATE TABLE `detail_po` (
  `kode` bigint(20) UNSIGNED NOT NULL,
  `kode_po` varchar(20) NOT NULL,
  `kode_brg` varchar(10) NOT NULL,
  `harga` float NOT NULL,
  `qty` float NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `jumlah` float NOT NULL,
  `rate` float DEFAULT NULL,
  `debit` varchar(5) NOT NULL,
  `kredit` varchar(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_po`
--

INSERT INTO `detail_po` (`kode`, `kode_po`, `kode_brg`, `harga`, `qty`, `keterangan`, `jumlah`, `rate`, `debit`, `kredit`, `created_at`, `updated_at`) VALUES
(1, 'PO.21.230310.0001', '000001', 7600.5, 3000, '--', 25309700, NULL, '17', '300', '2023-03-10 07:41:25', '2023-03-10 00:41:25');

-- --------------------------------------------------------

--
-- Table structure for table `detail_sj`
--

CREATE TABLE `detail_sj` (
  `kode` bigint(20) UNSIGNED NOT NULL,
  `kode_sj` varchar(25) NOT NULL,
  `kode_gdg` varchar(15) NOT NULL,
  `kode_brg` varchar(15) NOT NULL,
  `nama_request` varchar(50) DEFAULT NULL,
  `qty` float NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `debit` varchar(5) NOT NULL,
  `kredit` varchar(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_sj`
--

INSERT INTO `detail_sj` (`kode`, `kode_sj`, `kode_gdg`, `kode_brg`, `nama_request`, `qty`, `keterangan`, `debit`, `kredit`, `created_at`, `updated_at`) VALUES
(1, 'SJ.41.230310.0001', 'BB', '000001', NULL, 1200, 'Soda Ash @25kg\nPutih Bersih\nex China', '410', '170.2', '2023-03-10 02:45:14', '2023-03-10 02:45:14');

-- --------------------------------------------------------

--
-- Table structure for table `detail_so`
--

CREATE TABLE `detail_so` (
  `kode` bigint(20) UNSIGNED NOT NULL,
  `kode_so` varchar(20) NOT NULL,
  `kode_brg` varchar(20) NOT NULL,
  `nama_request` varchar(50) DEFAULT NULL,
  `harga` float NOT NULL,
  `qty` float NOT NULL,
  `dpp` float NOT NULL,
  `vat` float NOT NULL,
  `total` float NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `debit` varchar(5) DEFAULT NULL,
  `kredit` varchar(5) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_so`
--

INSERT INTO `detail_so` (`kode`, `kode_so`, `kode_brg`, `nama_request`, `harga`, `qty`, `dpp`, `vat`, `total`, `keterangan`, `debit`, `kredit`, `created_at`, `updated_at`) VALUES
(1, 'SO.61.230310.0001', '000001', NULL, 9000, 1200, 10800000, 11, 11988000, 'Soda Ash @25kg\nPutih Bersih\nex China', '12', '40', '2023-03-10 09:36:30', '2023-03-10 02:36:31');

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE `gudang` (
  `kode` varchar(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`kode`, `nama`, `alamat`, `created_at`, `updated_at`) VALUES
('BB', 'Balung Bendo', 'Jl Raya By pass Krian', '2023-03-09 23:59:48', '2023-03-09 23:59:48'),
('KPTH', 'Keputih', 'Perumahan Bumi Marina Emas VII B-35, Keputih Surabaya', '2023-03-09 23:59:26', '2023-03-09 23:59:26'),
('SMRG', 'Gudang Semarang', 'Jl. Raya Mastrip no 21', '2023-03-10 00:00:26', '2023-03-10 00:00:26'),
('TPJ', 'Taman Pondok Jati', 'Taman Pondok Jati AR. 2 Sidoarjo', '2023-03-09 23:58:31', '2023-03-09 23:58:31');

-- --------------------------------------------------------

--
-- Table structure for table `hpp`
--

CREATE TABLE `hpp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `barang` varchar(255) NOT NULL,
  `qty` float NOT NULL,
  `total` float NOT NULL,
  `hpp` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `kode` varchar(25) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_so` varchar(25) NOT NULL,
  `kode_sj` varchar(25) NOT NULL,
  `kode_bank` varchar(2) NOT NULL,
  `po_req` varchar(50) DEFAULT NULL,
  `vat` double NOT NULL,
  `tgl_tempo` date DEFAULT NULL,
  `DP` float NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`kode`, `tanggal`, `kode_so`, `kode_sj`, `kode_bank`, `po_req`, `vat`, `tgl_tempo`, `DP`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
('INV.230310.0001', '2023-03-10', 'SO.61.230310.0001', 'SJ.41.230310.0001', '1', 'PO.23031012', 11, '2023-03-10', 0, '--', 'Selesai', '2023-03-10 09:37:56', '2023-03-10 10:57:22');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE `jurnal` (
  `kode_transaksi` varchar(30) NOT NULL,
  `akun_debit` varchar(10) DEFAULT NULL,
  `akun_kredit` varchar(10) DEFAULT NULL,
  `kode_brg` varchar(25) DEFAULT NULL,
  `nama_brg` varchar(50) DEFAULT NULL,
  `nama_request` varchar(50) DEFAULT NULL,
  `kode_gdg` varchar(15) DEFAULT NULL,
  `nama_gdg` varchar(50) DEFAULT NULL,
  `kode_marketing` varchar(15) DEFAULT NULL,
  `nama_marketing` varchar(50) DEFAULT NULL,
  `kode_rekanan` varchar(25) DEFAULT NULL,
  `nama_rekanan` varchar(50) DEFAULT NULL,
  `qty_debit` float DEFAULT NULL,
  `harga_debit` float DEFAULT NULL,
  `jumlah_debit` float DEFAULT NULL,
  `qty_kredit` float DEFAULT NULL,
  `harga_kredit` float DEFAULT NULL,
  `jumlah_kredit` float DEFAULT NULL,
  `satuan` varchar(15) DEFAULT NULL,
  `vat` double DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `status` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jurnal`
--

INSERT INTO `jurnal` (`kode_transaksi`, `akun_debit`, `akun_kredit`, `kode_brg`, `nama_brg`, `nama_request`, `kode_gdg`, `nama_gdg`, `kode_marketing`, `nama_marketing`, `kode_rekanan`, `nama_rekanan`, `qty_debit`, `harga_debit`, `jumlah_debit`, `qty_kredit`, `harga_kredit`, `jumlah_kredit`, `satuan`, `vat`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
('INV.230310.0001.1D', '12', '40', '000001', 'Soda Ash', NULL, 'BB', 'Balung Bendo', 'NPA.0005', 'Imam', 'NP.C.00001', 'PTPN XI', 1200, 9000, 11988000, NULL, NULL, NULL, 'KG', 11, 'Soda Ash @25kg\nPutih Bersih\nex China', 'Selesai', '2023-03-10 02:45:14', '2023-03-10 10:57:22'),
('INV.230310.0001.1K', '40', '12', '000001', 'Soda Ash', NULL, NULL, 'Balung Bendo', 'NPA.0005', 'Imam', 'NP.C.00001', 'PTPN XI', NULL, NULL, NULL, 1200, 9000, 11988000, 'KG', 11, 'Soda Ash @25kg\nPutih Bersih\nex China', 'Selesai', '2023-03-10 02:45:14', '2023-03-10 10:57:22'),
('KAS.230310.001.1D', '101.1', '12', '000001', 'Soda Ash', NULL, 'BB', 'Balung Bendo', NULL, NULL, 'NP.C.00001', 'PTPN XI', 1200, 9000, 11988000, NULL, NULL, NULL, 'KG', 11, 'Soda Ash @25kg\nPutih Bersih\nex China', 'Belum Diperiksa', '2023-03-10 03:41:10', '2023-03-10 03:41:10'),
('KAS.230310.001.1K', '12', '101.1', '000001', 'Soda Ash', NULL, 'BB', 'Balung Bendo', NULL, NULL, 'NP.C.00001', 'PTPN XI', NULL, NULL, NULL, 1200, 9000, 11988000, 'KG', 11, 'Soda Ash @25kg\nPutih Bersih\nex China', 'Belum Diperiksa', '2023-03-10 03:41:10', '2023-03-10 03:41:10'),
('MR.61.230310.0001.1D', '170.2', '300', '000001', 'Soda Ash', NULL, 'BB', 'Balung Bendo', NULL, NULL, NULL, NULL, 3000, 7600.5, 25309700, NULL, NULL, NULL, 'KG', 11, '--', 'Selesai', '2023-03-10 08:30:43', '2023-03-10 08:32:34'),
('MR.61.230310.0001.1K', '300', '170.2', '000001', 'Soda Ash', NULL, 'BB', 'Balung Bendo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3000, 7600.5, 25309700, 'KG', 11, '--', 'Selesai', '2023-03-10 08:30:43', '2023-03-10 09:12:29'),
('PO.21.230310.0001.1D', '17', '300', '000001', 'Soda Ash', NULL, NULL, NULL, NULL, NULL, 'NP.S.00001', 'Mr. Ali', 3000, 7600.5, 25309700, NULL, NULL, NULL, 'KG', 11, '--', 'Sudah Diperiksa', '2023-03-10 07:41:25', '2023-03-10 07:42:21'),
('PO.21.230310.0001.1K', '300', '17', '000001', 'Soda Ash', NULL, NULL, NULL, NULL, NULL, 'NP.S.00001', 'Mr. Ali', NULL, NULL, NULL, 3000, 7600.5, 25309700, 'KG', 11, '--', 'Sudah Diperiksa', '2023-03-10 07:41:25', '2023-03-10 07:42:21'),
('SJ.41.230310.0001.1D', '410', '170.2', '000001', 'Soda Ash', NULL, 'BB', 'Balung Bendo', 'NPA.0005', 'Imam', 'NP.C.00001', 'PTPN XI', 1200, 8436.57, 10123900, NULL, NULL, NULL, 'KG', 11, 'Soda Ash @25kg\nPutih Bersih\nex China', 'Selesai', '2023-03-10 02:45:14', '2023-03-10 10:57:38'),
('SJ.41.230310.0001.1K', '170.2', '410', '000001', 'Soda Ash', NULL, NULL, 'Balung Bendo', 'NPA.0005', 'Imam', 'NP.C.00001', 'PTPN XI', NULL, NULL, NULL, 1200, 8436.57, 10123900, 'KG', 11, 'Soda Ash @25kg\nPutih Bersih\nex China', 'Selesai', '2023-03-10 02:45:14', '2023-03-10 10:57:38');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `kode` varchar(8) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `ttl` date DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `divisi` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`kode`, `nama`, `ttl`, `telp`, `alamat`, `divisi`, `lokasi`, `created_at`, `updated_at`) VALUES
('NPA.0001', 'Superadmin', '2023-03-10', '086641361232', 'Taman Pondok Jati AR 2 Sidoarjo', 'superadmin', 'TPJ', '2023-03-10 06:22:39', '2023-03-10 06:23:11'),
('NPA.0002', 'Daris Rafid', '2002-02-14', '081111111111', '--', 'ceo', 'KPTH', '2023-03-10 00:01:33', '2023-03-10 07:04:50'),
('NPA.0003', 'Alf Justico', '1997-01-01', '081111111111', '--', 'Manager Marketing', 'TPJ', '2023-03-10 00:02:17', '2023-03-10 00:02:17'),
('NPA.0004', 'Vania', '2002-01-01', '081111111111', '--', 'Administrasi Internal', 'KPTH', '2023-03-10 00:03:01', '2023-03-10 00:03:01'),
('NPA.0005', 'Imam', '1996-01-01', '082322232323', 'Keputih', 'Marketing Agro-Chemidal', 'TPJ', '2023-03-10 00:03:37', '2023-03-10 00:03:37'),
('NPA.0006', 'Luki', '1999-01-01', '08123312', '--', 'Accounting', 'KPTH', '2023-03-10 00:04:09', '2023-03-10 00:04:09');

-- --------------------------------------------------------

--
-- Table structure for table `kas`
--

CREATE TABLE `kas` (
  `kode` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `dk` varchar(2) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `status` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kas`
--

INSERT INTO `kas` (`kode`, `tanggal`, `dk`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
('KAS.230310.001', '2023-03-10', 'D', 'pembayaran inv', 'Selesai', '2023-03-10 03:41:23', '2023-03-10 10:56:51');

-- --------------------------------------------------------

--
-- Table structure for table `kodeakuntansi`
--

CREATE TABLE `kodeakuntansi` (
  `kode` double NOT NULL,
  `nama_perkiraan` varchar(50) NOT NULL,
  `jenis` varchar(1) NOT NULL,
  `no_group` double NOT NULL,
  `nomor` double NOT NULL,
  `no_urut_group` double NOT NULL,
  `no_urut_laporan` double NOT NULL,
  `jenis_laporan` varchar(30) NOT NULL,
  `group_laporan` varchar(30) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kodeakuntansi`
--

INSERT INTO `kodeakuntansi` (`kode`, `nama_perkiraan`, `jenis`, `no_group`, `nomor`, `no_urut_group`, `no_urut_laporan`, `jenis_laporan`, `group_laporan`, `keterangan`, `created_at`, `updated_at`) VALUES
(3, 'Kewajiban', 'K', 13, 13, 1, 11, 'neraca', 'passiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(10, 'Kas', 'D', 1, 1, 1, 1, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(12, 'Piutang Usaha', 'D', 4, 4, 1, 4, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(12.1, 'Piutang Lain-Lain', 'D', 5, 5, 1, 5, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(13, 'Uang Muka', 'D', 6, 6, 1, 6, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(15, 'Pajak Dibayar Dimuka', 'D', 8, 8, 1, 7, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(17, 'Persediaan', 'D', 9, 9, 1, 8, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(25, 'Aktiva Tetap', 'D', 10, 10, 1, 9, 'neraca', 'aktiva tetap', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(26, 'Akumulasi Penyusutan', 'D', 12, 12, 1, 10, 'neraca', 'aktiva tetap', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(30, 'Hutang Usaha', 'K', 14, 14, 1, 11, 'neraca', 'passiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(30.1, 'Laba Yang Di Tahan', 'K', 18, 18, 1, 18, 'neraca', 'laba yang ditahan', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(30.2, 'Prive', 'D', 20, 20, 2, 0, '', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(40, 'Penjualan', 'K', 21, 21, 1, 19, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(51, 'Pendapatan Lain - Lain', 'K', 27, 27, 1, 24, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(64, 'Beban Lain - Lain', 'D', 28, 28, 1, 25, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(100, 'Kas Perusahaan', 'D', 1, 1, 2, 1, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(100.2, 'Kas Sementara (saldo tokped dan shopee)', 'D', 1, 1, 3, 1, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(100.3, 'Kas Gudang', 'D', 1, 1, 4, 1, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(101.1, 'Bank Mandiri - Rp(CV.Nusa)', 'D', 2, 2, 2, 2, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(101.2, 'Bank Mandiri - Rp(Transaksi Kecil)', 'D', 2, 2, 2, 2, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(101.3, 'Bank Mandiri - Rp(Transaksi Menengah)', 'D', 2, 2, 2, 2, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(102.1, 'Bank BRI', 'D', 2, 2, 2, 2, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(120, 'Piutang Dagang DPP', 'D', 4, 4, 2, 4, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(120.1, 'Piutang Dagang PPN', 'D', 4, 4, 3, 4, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(120.2, 'Piutang Dagang Belum Difakturkan', 'D', 4, 4, 4, 4, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(120.3, 'Cadangan Piutang Tidak Tertagih', 'D', 4, 4, 5, 4, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(121, 'Piutang Karyawan /Kas Bon', 'D', 5, 5, 2, 5, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(121.1, 'Piutang Karyawan /Pinjaman Karyawan', 'D', 5, 5, 3, 5, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(122, 'Piutang Lain-Lain Eksternal', 'D', 5, 5, 4, 5, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(123, 'Piutang Direksi', 'D', 5, 5, 5, 5, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(124, 'Piutang NPA', 'D', 5, 5, 6, 5, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(125, 'Piutang Pendapatan (Angkutan, Bunga)', 'D', 5, 5, 7, 5, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(126, 'Piutang Bank Garansi / Jaminan', 'D', 5, 5, 8, 5, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(127, 'Piutang Interchain , Toya Group', 'D', 5, 5, 9, 5, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(128, 'Deposito', 'D', 3, 3, 1, 3, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(128.1, 'Deposito - Rp', 'D', 3, 3, 2, 3, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(128.2, 'Deposito - Usd', 'D', 3, 3, 3, 3, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(130, 'Uang Muka Pembelian Lokal', 'D', 6, 6, 2, 6, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(131, 'Uang Muka Pembelian Import', 'D', 6, 6, 3, 6, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(131.1, 'Uang Muka (custom -EMKL import)', 'D', 6, 6, 4, 6, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(132, 'Uang Muka Pembelian Lain -2', 'D', 6, 6, 5, 6, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(133, 'Uang Muka Angkutan', 'D', 6, 6, 6, 6, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(134, 'Web Domain', 'D', 6, 6, 7, 6, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(140, 'Gross Transaction / Kode Tampung', 'D', 7, 7, 1, 6, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(152.1, 'PPn Masukan Lokal', 'D', 8, 8, 2, 7, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(152.2, 'PPn Masukan Import', 'D', 8, 8, 3, 7, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(152.3, 'PPh 22(Import)', 'D', 8, 8, 4, 7, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(152.4, 'PPh 23', 'D', 8, 8, 5, 7, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(152.5, 'PPh 25', 'D', 8, 8, 6, 7, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(152.6, 'Lain-Lain', 'D', 8, 8, 7, 7, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(170, 'Persediaan Barang Dagangan', 'D', 9, 9, 2, 8, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(170.1, 'Persediaan Barang Dagangan - Cair', 'D', 9, 9, 3, 8, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(170.2, 'Persediaan Barang Dagangan - Padat', 'D', 9, 9, 4, 8, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(170.3, 'Persediaan Barang Dagangan - Gas', 'D', 9, 9, 5, 8, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(170.4, 'Persediaan Barang Dagangan - lain-lain', 'D', 9, 9, 6, 8, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(171, 'Persediaan Blending', 'D', 9, 9, 7, 8, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(172, 'Persediaan Barang Dagangan - Intransit Customer', 'D', 9, 9, 8, 8, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(173, 'Persediaan Barang Dagangan /Konsiyasi', 'D', 9, 9, 9, 8, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(174, 'Persediaan Barang Dagangan - Intransit Gudang', 'D', 9, 9, 10, 8, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(175, 'Persediaan Barang Dagangan - Intransit Supplier', 'D', 9, 9, 11, 8, 'neraca', 'aktiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(250, 'Tanah', 'D', 11, 11, 1, 9, 'neraca', 'aktiva tetap', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(251, 'Bangunan', 'D', 11, 11, 2, 9, 'neraca', 'aktiva tetap', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(251.1, 'Sarana dan Prasarana', 'D', 11, 11, 3, 9, 'neraca', 'aktiva tetap', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(252, 'Inventaris Kantor', 'D', 11, 11, 4, 9, 'neraca', 'aktiva tetap', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(253, 'Kendaraan', 'D', 11, 11, 5, 9, 'neraca', 'aktiva tetap', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(254, 'Mesin dan Tangki', 'D', 11, 11, 6, 9, 'neraca', 'aktiva tetap', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(255, 'Peralatan dan Perlengkapan Gudang', 'D', 11, 11, 7, 9, 'neraca', 'aktiva tetap', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(256, 'Asset dalam Penyelesaian', 'D', 11, 11, 8, 9, 'neraca', 'aktiva tetap', NULL, '2022-12-20 07:15:00', '2023-02-11 02:57:20'),
(257, 'Other', 'D', 11, 11, 9, 9, 'neraca', 'aktiva tetap', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(269.1, 'Akumulasi Penyusutan Bangunan', 'D', 12, 12, 2, 10, 'neraca', 'aktiva tetap', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(269.11, 'Akumulasi Penyusutan sarana dan prasarana', 'D', 12, 12, 3, 10, 'neraca', 'aktiva tetap', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(269.2, 'Akumulasi Penyusutan Inventaris Kantor', 'D', 12, 12, 4, 10, 'neraca', 'aktiva tetap', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(269.3, 'Akumulasi Penyusutan Kendaraan', 'D', 12, 12, 5, 10, 'neraca', 'aktiva tetap', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(269.4, 'Akumulasi Penyusutan Mesin Dan Tangki', 'D', 12, 12, 6, 10, 'neraca', 'aktiva tetap', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(269.5, 'Akumulasi Penyusutan Peralatan dan perlengkapan gu', 'D', 12, 12, 7, 10, 'neraca', 'aktiva tetap', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(300, 'Hutang Dagang - DPP', 'K', 14, 14, 2, 11, 'neraca', 'passiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(300.1, 'Hutang Dagang - PPn', 'K', 14, 14, 3, 11, 'neraca', 'passiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(300.2, 'Hutang Dagang Belum di Fakturkan', 'K', 14, 14, 4, 11, 'neraca', 'passiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(301, 'Hutang Lain - Lain', 'K', 141, 141, 1, 12, 'neraca', 'passiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(301.1, 'Hutang Lain - Lain - Astek', 'K', 141, 141, 2, 12, 'neraca', 'passiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(301.2, 'Hutang Lain - Lain', 'K', 141, 141, 3, 12, 'neraca', 'passiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(302, 'Hutang Biaya', 'K', 15, 15, 1, 13, 'neraca', 'passiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(302.1, 'Hutang Biaya  (rupiah) /Angkutan, Custom import st', 'K', 15, 15, 2, 13, 'neraca', 'passiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(302.2, 'Hutang Biaya  (USD)   (THC import etc )', 'K', 15, 15, 3, 13, 'neraca', 'passiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(303, 'Hutang Lain - Lain', 'K', 16, 16, 1, 14, 'neraca', 'passiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(303.1, 'Hutang Angkutan', 'K', 16, 16, 2, 14, 'neraca', 'passiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(303.2, 'Hutang bank', 'K', 16, 16, 3, 14, 'neraca', 'passiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(303.3, 'Hutang bunga', 'K', 16, 16, 4, 14, 'neraca', 'passiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(303.4, 'Hutang Leasing', 'K', 16, 16, 5, 14, 'neraca', 'passiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(303.5, 'Hutang Direksi', 'K', 16, 16, 6, 14, 'neraca', 'passiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(303.6, 'Hutang NPA', 'K', 16, 16, 7, 14, 'neraca', 'passiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(303.7, 'Hutang Interchain', 'K', 16, 16, 8, 14, 'neraca', 'passiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(303.8, 'Hutang Enzcarbo', 'K', 16, 16, 9, 14, 'neraca', 'passiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(304, 'Hutang Pajak', 'K', 17, 17, 1, 15, 'neraca', 'passiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(304.1, 'Hutang PPn', 'K', 17, 17, 2, 15, 'neraca', 'passiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(304.2, 'Hutang PPh 21', 'K', 17, 17, 3, 15, 'neraca', 'passiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(304.3, 'Hutang PPh 23', 'K', 17, 17, 4, 15, 'neraca', 'passiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(304.4, 'Hutang PPh 25', 'K', 17, 17, 5, 15, 'neraca', 'passiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(304.5, 'Hutang PPh final', 'K', 17, 17, 6, 15, 'neraca', 'passiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(306, 'R/E - awal', 'K', 18, 18, 2, 18, 'neraca', 'laba yang ditahan', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(306.1, 'R/E - berjalan', 'K', 18, 18, 3, 18, 'neraca', 'laba yang ditahan', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(310, 'Uang Muka Penjualan', 'K', 19, 19, 1, 16, 'neraca', 'passiva lancar', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(330, 'Modal', 'K', 20, 20, 1, 17, 'neraca', 'modal', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(400, 'Sales', 'K', 21, 21, 2, 19, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(401, 'Free  Sample/Penjualan Free', 'K', 21, 21, 3, 19, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(402, 'Retur Penjulan', 'K', 21, 21, 4, 19, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(403, 'Selisih beda timbang penjualan/Klaim', 'K', 21, 21, 5, 19, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(410, 'Harga Pokok Penjualan', 'D', 22, 22, 1, 19, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(501, 'Biaya Karyawan', 'D', 23, 23, 1, 20, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(501.1, 'Gaji', 'D', 23, 23, 2, 20, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(501.2, 'Lembur + Insentiff', 'D', 23, 23, 3, 20, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(501.3, 'Tunjangan Makan', 'D', 23, 23, 4, 20, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(501.4, 'Tunjangan Transport', 'D', 23, 23, 5, 20, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(501.5, 'Tunjangan Kesehatan', 'D', 23, 23, 6, 20, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(501.6, 'Tunjangan Jamsostek + Insurance', 'D', 23, 23, 7, 20, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(501.7, 'PPh karyawan', 'D', 23, 23, 8, 20, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(501.8, 'Lain-lain', 'D', 23, 23, 9, 20, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(502, 'Biaya General/Operasional', 'D', 24, 24, 1, 21, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(502.1, 'Biaya ATK , Photo copy etc', 'D', 24, 24, 2, 21, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(502.11, 'Biaya pemeliharaan + perbaikan bangunan', 'D', 24, 24, 12, 21, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(502.12, 'Biaya Listrik, Air, Wifi', 'D', 24, 24, 13, 21, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(502.13, 'Biaya pemeliharaan + perbaikan mesin', 'D', 24, 24, 14, 21, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(502.14, 'Biaya Tehnical service  ( Analisa, surveyor. Lab )', 'D', 24, 24, 15, 21, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(502.15, 'Biaya Research + pengembangan', 'D', 24, 24, 16, 21, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(502.16, 'Biaya Operasional gudang', 'D', 24, 24, 17, 21, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(502.17, 'Biaya pemeliharaan + perbaikan Peralatan dan perle', 'D', 24, 24, 18, 21, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(502.18, 'Biaya pemeliharaan + perbaikan inventaris kantor', 'D', 24, 24, 19, 21, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(502.19, 'Biaya pemeliharaan + perbaikan kendaraan', 'D', 24, 24, 20, 21, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(502.2, 'Biaya komunikasi (telp, fax, Hp)', 'D', 24, 24, 3, 21, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(502.21, 'Biaya Operasional lain-lain', 'D', 24, 24, 22, 21, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(502.22, 'Biaya Sumbangan', 'D', 24, 24, 23, 21, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(502.3, 'Biaya perjalanan Dinas', 'D', 24, 24, 4, 21, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(502.4, 'Biaya Asuransi', 'D', 24, 24, 5, 21, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(502.5, 'Biaya Sewa', 'D', 24, 24, 6, 21, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(502.6, 'Biaya Entertaint', 'D', 24, 24, 7, 21, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(502.7, 'Biaya kendaraan kantor (BBM, Tol,Parkir, service, ', 'D', 24, 24, 8, 21, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(502.8, 'Biaya pemeliharaan + perbaikan Inventaris kantor', 'D', 24, 24, 9, 21, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(502.9, 'Biaya post + pengiriman + materai', 'D', 24, 24, 10, 21, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(503, 'Biaya Depresiasi / Penyusutan', 'D', 24, 24, 24, 21, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(503.23, 'Biaya Pengiriman', 'D', 24, 24, 27, 21, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(503.24, 'Biaya Sampel, R&D', 'D', 24, 24, 28, 21, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(504, 'Biaya bunga pinjaman', 'D', 24, 24, 25, 21, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(504.1, 'Biaya Administrasi pinjaman (provisi, asuransi, co', 'D', 24, 24, 26, 21, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(505, 'Biaya Pembelian (perolehan barang)', 'D', 25, 25, 1, 22, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(505.1, 'Biaya angkutan - dgn kurir', 'D', 25, 25, 2, 22, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(505.2, 'Biaya angkutan -  dgn ekspedisi dan trucking', 'D', 25, 25, 3, 22, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(505.3, 'Biaya Bongkar muat pembelian', 'D', 25, 25, 4, 22, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(505.4, 'Biaya Packing', 'D', 25, 25, 5, 22, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(505.5, 'Biaya Custom, handling & asuransi', 'D', 25, 25, 6, 22, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(505.6, 'Biaya Pembelian lain-lain', 'D', 25, 25, 7, 22, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(506, 'Biaya Penjualan', 'D', 26, 26, 1, 23, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(506.1, 'Biaya angkutan - dgn kurir', 'D', 26, 26, 2, 23, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(506.2, 'Biaya angkutan - dgn ekspedisi dan trucking', 'D', 26, 26, 3, 23, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(506.3, 'Biaya BBM Pengiriman', 'D', 26, 26, 4, 23, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(506.4, 'Biaya Tol Pengiriman', 'D', 26, 26, 5, 23, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(506.5, 'Karcis, Portal, dan Parkir Pengiriman', 'D', 26, 26, 6, 23, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(506.6, 'Biaya Freelance Produksi', 'D', 26, 26, 7, 23, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(506.7, 'Biaya Bongkar muat penjualan', 'D', 26, 26, 8, 23, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(506.8, 'Biaya Freelance Driver', 'D', 26, 26, 9, 23, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(506.9, 'Biaya Komisi Internal', 'D', 26, 26, 10, 23, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(510, 'Forex Gain / Loss - Selisih kurs valas', 'D', 27, 27, 2, 24, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(510.1, 'Forex Gain / Loss - Selisih kurs valas bank', 'D', 27, 27, 3, 24, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(511, 'Selisih Kuantitas Barang', 'D', 27, 27, 4, 24, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(610, 'Jasa Giro / Bunga', 'K', 27, 27, 5, 24, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(610.1, 'Pajak Jasa Giro / Bunga', 'K', 27, 27, 6, 24, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(611, 'Pendapatan lain - lain', 'K', 27, 27, 7, 24, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(640, 'Beban Lain - Lain', 'D', 28, 28, 2, 25, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(640.1, 'Beban Admin Bank', 'D', 28, 28, 4, 25, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54'),
(650, 'Biaya Bank (adm, by Jaminan Penawaran/Pelaksanaan)', 'D', 28, 28, 3, 25, 'laba/rugi', '', NULL, '2022-12-20 07:15:00', '2022-12-21 08:50:54');

-- --------------------------------------------------------

--
-- Table structure for table `lapmarketing`
--

CREATE TABLE `lapmarketing` (
  `kode` bigint(20) UNSIGNED NOT NULL,
  `marketing` varchar(15) NOT NULL,
  `tanggal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `laporan` longtext NOT NULL,
  `status` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `materialreceive`
--

CREATE TABLE `materialreceive` (
  `kode` varchar(20) NOT NULL,
  `transaksi` varchar(25) NOT NULL,
  `tanggal` date NOT NULL,
  `surat_jalan` varchar(25) DEFAULT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materialreceive`
--

INSERT INTO `materialreceive` (`kode`, `transaksi`, `tanggal`, `surat_jalan`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
('MR.61.230310.0001', 'PO.21.230310.0001', '2023-03-10', '--', 'keterangann', 'Selesai', '2023-03-10 01:31:42', '2023-03-10 08:32:34');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_10_12_063632_create_karyawan_table', 1),
(6, '2022_10_21_013008_create_gudang_table', 1),
(7, '2022_10_21_063909_create_barang_table', 1),
(8, '2022_10_21_235754_create_rekanan_table', 1),
(9, '2022_10_24_032522_create_purchaseorder_table', 1),
(10, '2022_10_24_034815_create_detail_po_table', 1),
(11, '2022_10_24_034916_create_author_table', 1),
(12, '2022_11_01_225912_create_materialrecieve_table', 1),
(13, '2022_11_02_022903_create_detail_mr_table', 1),
(14, '2022_11_05_015058_create_salesorder', 1),
(15, '2022_11_05_021827_create_detail_so', 1),
(16, '2022_11_10_091619_create_suratjalan_table', 1),
(17, '2022_11_11_023128_create_detail_sj_table', 1),
(18, '2022_11_18_034101_create_invoice_table', 1),
(19, '2022_11_18_034439_create_detail_invoice_table', 1),
(20, '2022_11_18_035726_create_transaksi_table', 1),
(21, '2022_11_19_052934_create_bank_table', 1),
(22, '2022_11_29_030011_create_lapmarketing_table', 1),
(23, '2022_11_30_043434_create_jurnal_table', 1),
(24, '2022_12_01_065605_create_permission_tables', 1),
(25, '2022_12_12_032735_create_planmarketing_table', 1),
(26, '2022_12_13_091958_create_kodeakuntansi_table', 1),
(27, '2023_02_11_034843_create_kas_table', 1),
(28, '2023_02_14_034339_create_hpp_table', 1),
(29, '2023_02_16_031222_create_detail_kas_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `planmarketing`
--

CREATE TABLE `planmarketing` (
  `kode` bigint(20) UNSIGNED NOT NULL,
  `marketing` varchar(25) NOT NULL,
  `awal` date NOT NULL,
  `akhir` date NOT NULL,
  `plan` longtext NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorder`
--

CREATE TABLE `purchaseorder` (
  `kode` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis` varchar(15) NOT NULL,
  `supplier` varchar(10) NOT NULL,
  `pembayaran` varchar(15) NOT NULL,
  `spk` varchar(25) DEFAULT NULL,
  `time_delivery` datetime DEFAULT NULL,
  `term_payment` varchar(30) DEFAULT NULL,
  `vat` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchaseorder`
--

INSERT INTO `purchaseorder` (`kode`, `tanggal`, `jenis`, `supplier`, `pembayaran`, `spk`, `time_delivery`, `term_payment`, `vat`, `status`, `created_at`, `updated_at`) VALUES
('PO.21.230310.0001', '2023-03-10', '21', 'NP.S.00001', 'TUNAI', '--', NULL, '--', 11, 'Sudah Diperiksa', '2023-03-10 00:40:58', '2023-03-10 07:42:21');

-- --------------------------------------------------------

--
-- Table structure for table `rekanan`
--

CREATE TABLE `rekanan` (
  `kode` varchar(10) NOT NULL,
  `mitra` varchar(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `wa` varchar(12) NOT NULL,
  `nama_perusahaan` varchar(50) DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `bank1` varchar(20) DEFAULT NULL,
  `bank2` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `marketing` varchar(10) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekanan`
--

INSERT INTO `rekanan` (`kode`, `mitra`, `nama`, `wa`, `nama_perusahaan`, `telp`, `bank1`, `bank2`, `email`, `marketing`, `alamat`, `created_at`, `updated_at`) VALUES
('NP.C.00001', 'CUSTOMER', 'PTPN XI', '08667126312', 'PTPN XI', '0313423', '00', '00', 'tender@PTPN.gov', '-', '---', '2023-03-10 00:12:44', '2023-03-10 00:12:44'),
('NP.C.00002', 'CUSTOMER', 'PT.SCMA', '087776123861', 'PT.SCMA', '00', '000', '00', 'SCMA@gmail.com', '-', 'Jl. Cendrawasih no 12, Krian, Sidoarjo', '2023-03-10 00:13:29', '2023-03-10 00:13:29'),
('NP.S.00001', 'SUPPLIER', 'Mr. Ali', '087776123861', 'PT. Toya Indo Manunggal', '03177342', '00', '00', 'sales@toya.co.id', 'NPA.0005', '--', '2023-03-10 00:11:03', '2023-03-10 00:11:03'),
('NP.S.00002', 'SUPPLIER', 'PT. Jaya Abadi', '082334243', 'PT. Jaya Abadi', '00', '0000', '000', 'salesjayaabadi@co.id', '-', '---', '2023-03-10 00:11:56', '2023-03-10 00:11:56');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', '2023-03-10 06:34:17', '2023-03-10 06:40:13'),
(2, 'marketing', '2023-03-10 06:34:17', '2023-03-10 06:40:21'),
(3, 'admin', '2023-03-10 06:39:34', '2023-03-10 06:40:24'),
(4, 'ceo', '2023-03-10 06:39:58', '2023-03-10 06:39:58'),
(5, 'accounting', '2023-03-10 06:40:52', '2023-03-10 06:40:52'),
(6, 'purchasing', '2023-03-10 06:40:52', '2023-03-10 06:40:52'),
(7, 'manager-marketing', '2023-03-10 06:41:29', '2023-03-10 06:41:29'),
(8, 'staff-gudang', '2023-03-10 06:41:29', '2023-03-10 06:41:29'),
(9, 'kepala-gudang', '2023-03-10 06:41:29', '2023-03-10 06:41:29');

-- --------------------------------------------------------

--
-- Table structure for table `salesorder`
--

CREATE TABLE `salesorder` (
  `kode` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis` varchar(15) NOT NULL,
  `konsumen` varchar(10) NOT NULL,
  `pembayaran` varchar(15) NOT NULL,
  `marketing` varchar(15) NOT NULL,
  `no_po` varchar(30) DEFAULT NULL,
  `tgl_diterima` date DEFAULT NULL,
  `term_payment` varchar(30) DEFAULT NULL,
  `vat` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salesorder`
--

INSERT INTO `salesorder` (`kode`, `tanggal`, `jenis`, `konsumen`, `pembayaran`, `marketing`, `no_po`, `tgl_diterima`, `term_payment`, `vat`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
('SO.61.230310.0001', '2023-03-10', '61', 'NP.C.00001', 'TUNAI', 'NPA.0005', 'PO.23031012', '2023-03-10', 'CBD', 11, '-', 'Selesai', '2023-03-10 09:36:06', '2023-03-10 10:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `suratjalan`
--

CREATE TABLE `suratjalan` (
  `kode` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `tipe` varchar(15) NOT NULL,
  `so` varchar(25) DEFAULT NULL,
  `tgl_kirim` date DEFAULT NULL,
  `kota` varchar(20) DEFAULT NULL,
  `konsumen` varchar(15) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `tgl_diterima` date DEFAULT NULL,
  `nopol` varchar(10) DEFAULT NULL,
  `ekspedisi` varchar(30) DEFAULT NULL,
  `no_resi` varchar(30) DEFAULT NULL,
  `keterangan` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suratjalan`
--

INSERT INTO `suratjalan` (`kode`, `tanggal`, `tipe`, `so`, `tgl_kirim`, `kota`, `konsumen`, `alamat`, `tgl_diterima`, `nopol`, `ekspedisi`, `no_resi`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
('SJ.41.230310.0001', '2023-03-10', '41', 'SO.61.230310.0001', '2023-03-10', NULL, 'NP.C.00001', '---', '2023-03-10', NULL, NULL, NULL, '--', 'Selesai', '2023-03-10 02:42:01', '2023-03-10 10:57:38');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL,
  `kode_karyawan` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `level`, `kode_karyawan`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'superadmin', 'NPA.0001', '$2y$10$2hS8mxeGJ2vqsitwRmXu6.pJ1K.THKAj//Abs/tegKja9WGS5hQa.', NULL, '2023-03-10 06:25:15', '2023-03-10 06:55:22'),
(2, 'mr.daris', 'ceo', 'NPA.0002', '$2y$10$H9z.jCVkwlH8wodxqRup/.MWRqAAAWBVQk1yedrT6rOqoxa8Bczyu', NULL, '2023-03-10 00:01:33', '2023-03-10 07:04:31'),
(3, 'mr.alfa', 'manager-marketing', 'NPA.0003', '$2y$10$Vmu7ZtLyMIArAvP3qrExp.TwWe6LwBlZfINQG.HcO27tQiShad1N2', NULL, '2023-03-10 00:02:17', '2023-03-10 00:02:17'),
(4, 'mrs.vania', 'admin', 'NPA.0004', '$2y$10$sQasOPfukmq9q3/oOZ0W8evOOLHhCtmB9AgOpcP1dD8q0Y2kTrg4W', NULL, '2023-03-10 00:03:01', '2023-03-10 00:03:01'),
(5, 'mr.imam', 'marketing', 'NPA.0005', '$2y$10$sQedx6jkQ/SoGDYqxyTh.OphyWD8C/MpTPqOWB3j.Qrl0OBhOk81W', NULL, '2023-03-10 00:03:37', '2023-03-10 00:03:37'),
(6, 'mrs.luki', 'accounting', 'NPA.0006', '$2y$10$x5KjQq5POwxN96ZRNn9VT.twRKi1zFmHU4RWCFgzTMENUR0NyvdfC', NULL, '2023-03-10 00:04:09', '2023-03-10 00:04:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`kode`),
  ADD UNIQUE KEY `author_transaksi_unique` (`transaksi`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `detail_invoice`
--
ALTER TABLE `detail_invoice`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `detail_kas`
--
ALTER TABLE `detail_kas`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `detail_mr`
--
ALTER TABLE `detail_mr`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `detail_po`
--
ALTER TABLE `detail_po`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `detail_sj`
--
ALTER TABLE `detail_sj`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `detail_so`
--
ALTER TABLE `detail_so`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `hpp`
--
ALTER TABLE `hpp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`kode_transaksi`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `kas`
--
ALTER TABLE `kas`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `kodeakuntansi`
--
ALTER TABLE `kodeakuntansi`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `lapmarketing`
--
ALTER TABLE `lapmarketing`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `materialreceive`
--
ALTER TABLE `materialreceive`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `planmarketing`
--
ALTER TABLE `planmarketing`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `purchaseorder`
--
ALTER TABLE `purchaseorder`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `rekanan`
--
ALTER TABLE `rekanan`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salesorder`
--
ALTER TABLE `salesorder`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `suratjalan`
--
ALTER TABLE `suratjalan`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `kode` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `kode` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_invoice`
--
ALTER TABLE `detail_invoice`
  MODIFY `kode` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_mr`
--
ALTER TABLE `detail_mr`
  MODIFY `kode` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_po`
--
ALTER TABLE `detail_po`
  MODIFY `kode` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_sj`
--
ALTER TABLE `detail_sj`
  MODIFY `kode` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_so`
--
ALTER TABLE `detail_so`
  MODIFY `kode` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hpp`
--
ALTER TABLE `hpp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lapmarketing`
--
ALTER TABLE `lapmarketing`
  MODIFY `kode` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `planmarketing`
--
ALTER TABLE `planmarketing`
  MODIFY `kode` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
