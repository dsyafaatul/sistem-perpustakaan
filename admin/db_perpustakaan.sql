-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2018 at 10:39 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpustakaan`
--
CREATE DATABASE IF NOT EXISTS `db_perpustakaan` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_perpustakaan`;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `keterangan` text NOT NULL,
  `logo` text NOT NULL,
  `denda` int(11) NOT NULL,
  `jumlah_pinjam_maksimal` int(11) NOT NULL,
  `lama_pinjam_maksimal` int(11) NOT NULL,
  `ukuran_laporan` enum('A3','A4','A5','Letter','Legal') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`nama`, `alamat`, `keterangan`, `logo`, `denda`, `jumlah_pinjam_maksimal`, `lama_pinjam_maksimal`, `ukuran_laporan`) VALUES
('SMK PUI Majalengka', 'Jalan Suma No.478 Majalengka 45419 Telp. /Fax (0233) 281027', 'www.smkpui-majalengka.sch.id email: smkpuimjlk@yahoo.com', '20180316055224_LOGO.png', 1000, 3, 3, 'A4');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `id_penjaga` varchar(15) NOT NULL,
  `aktivitas` text NOT NULL,
  `tanggal_log` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id_log`, `id_penjaga`, `aktivitas`, `tanggal_log`) VALUES
(1, '1', 'Menghapus Log Aktivitas', '2018-03-08 12:41:33'),
(2, '1', 'Mengedit Pengaturan Perpustakaan', '2018-03-08 15:00:13'),
(3, '1', 'Mengedit Pengaturan Perpustakaan', '2018-03-08 15:02:15'),
(4, '1', 'Mengedit Pengaturan Perpustakaan', '2018-03-08 15:04:45'),
(5, '1', 'Mengedit Pengaturan Perpustakaan', '2018-03-08 15:05:46'),
(6, '1', 'Mengedit Pengaturan Perpustakaan', '2018-03-08 15:09:35'),
(7, '1', 'Mengedit Pengaturan Perpustakaan', '2018-03-08 15:12:22'),
(8, '1', 'Mengedit Pengaturan Perpustakaan', '2018-03-08 15:13:05'),
(9, '1', 'Mengedit Pengaturan Perpustakaan', '2018-03-08 15:15:03'),
(10, '2', 'Mengedit Data penjaga D.Syafaatul Anbiya', '2018-03-08 15:18:52'),
(11, '2', 'Mengedit Data penjaga D.Syafaatul Anbiya', '2018-03-08 15:25:59'),
(12, '2', 'Mengedit Data penjaga D.Syafaatul Anbiya', '2018-03-08 15:26:08'),
(13, '2', 'Mengedit Data penjaga D.Syafaatul Anbiya', '2018-03-08 15:28:24'),
(14, '1', 'Mengedit Data Buku Belajar Javascript dasar pemula', '2018-03-08 15:31:06'),
(15, '1', 'Mengedit Data Anggota D.Syafaatul Anbiya', '2018-03-08 15:32:16'),
(16, '1', 'Mengedit Pengaturan Perpustakaan', '2018-03-08 15:32:37'),
(17, '1', 'Mengedit Pengaturan Perpustakaan', '2018-03-08 15:32:45'),
(18, '1', 'Mengedit Data Profile Admin web', '2018-03-08 15:58:54'),
(19, '1', 'Mengedit Data Profile Admin web', '2018-03-08 15:59:16'),
(20, '1', 'D.Jamaatul Anbiya Memperpanjang Memperpanjang Buku Belajar PHP dasar pemula', '2018-03-08 16:11:14'),
(21, '1', 'D.Jamaatul Anbiya Memperpanjang Memperpanjang Buku Belajar PHP dasar pemula', '2018-03-08 16:11:48'),
(22, '1', 'D.Jamaatul Anbiya Memperpanjang Memperpanjang Buku Belajar PHP dasar pemula', '2018-03-08 16:12:01'),
(23, '1', 'Mengedit Pengaturan Perpustakaan', '2018-03-08 16:12:59'),
(24, '1', 'Menambahkan peminjaman baru dari D.Syafaatul Anbiya', '2018-03-08 16:13:12'),
(25, '1', 'D.Syafaatul Anbiya Memperpanjang Memperpanjang Buku Belajar Javascript dasar pemula', '2018-03-08 16:13:45'),
(26, '1', 'Mengedit Pengaturan Perpustakaan', '2018-03-08 16:14:40'),
(27, '1', 'D.Syafaatul Anbiya Memperpanjang Memperpanjang Buku Belajar PHP dasar pemula', '2018-03-08 16:17:59'),
(28, '1', 'D.Jamaatul Anbiya Memperpanjang Memperpanjang Buku Majalengka Kota Angin', '2018-03-08 16:18:23'),
(29, '1', 'D.Jamaatul Anbiya Memperpanjang Memperpanjang Buku Majalengka Kota Angin', '2018-03-08 16:18:47'),
(30, '1', 'D.Jamaatul Anbiya Memperpanjang Memperpanjang Buku Majalengka Kota Angin', '2018-03-08 16:19:07'),
(31, '1', 'D.Jamaatul Anbiya Memperpanjang Memperpanjang Buku Majalengka Kota Angin', '2018-03-08 16:20:19'),
(32, '1', 'D.Jamaatul Anbiya Memperpanjang Memperpanjang Buku Majalengka Kota Angin', '2018-03-08 16:20:36'),
(33, '1', 'D.Jamaatul Anbiya Memperpanjang Memperpanjang Buku Majalengka Kota Angin', '2018-03-08 16:21:08'),
(34, '1', 'D.Jamaatul Anbiya Memperpanjang Memperpanjang Buku Majalengka Kota Angin', '2018-03-08 16:23:21'),
(35, '1', 'D.Jamaatul Anbiya Memperpanjang Memperpanjang Buku Majalengka Kota Angin', '2018-03-08 16:24:46'),
(36, '1', 'D.Syafaatul Anbiya Memperpanjang Memperpanjang Buku Belajar PHP dasar pemula', '2018-03-08 16:24:56'),
(37, '1', 'D.Syafaatul Anbiya Memperpanjang Memperpanjang Buku Belajar Javascript dasar pemula', '2018-03-08 16:25:14'),
(38, '1', 'D.Syafaatul Anbiya Memperpanjang Memperpanjang Buku Belajar Javascript dasar pemula', '2018-03-08 16:30:00'),
(39, '1', 'D.Jamaatul Anbiya Memperpanjang Memperpanjang Buku Belajar PHP dasar pemula', '2018-03-08 16:30:07'),
(40, '1', 'D.Syafaatul Anbiya Memperpanjang Memperpanjang Buku Belajar PHP dasar pemula', '2018-03-08 16:36:19'),
(41, '1', 'Dimas Septian Irawan Memperpanjang Memperpanjang Buku Majalengka Kota Angin', '2018-03-08 16:36:25'),
(42, '1', 'Dimas Septian Irawan Mengembalikan Buku Majalengka Kota Angin', '2018-03-08 16:37:47'),
(43, '1', 'Dimas Septian Irawan Mengembalikan Buku Majalengka Kota Angin', '2018-03-08 16:38:12'),
(44, '1', 'Dimas Septian Irawan Mengembalikan Buku Belajar PHP dasar pemula', '2018-03-08 16:39:03'),
(45, '1', 'Dimas Septian Irawan Mengembalikan Buku Majalengka Kota Angin', '2018-03-08 16:39:12'),
(46, '1', 'D.Syafaatul Anbiya Mengembalikan Buku Si Juki Anti Mainstream', '2018-03-08 16:39:42'),
(47, '1', 'D.Syafaatul Anbiya Mengembalikan Buku Si Juki Anti Mainstream', '2018-03-08 16:39:53'),
(48, '1', 'D.Syafaatul Anbiya Mengembalikan Buku Si Juki Anti Mainstream', '2018-03-08 16:40:42'),
(49, '1', 'D.Jamaatul Anbiya Mengembalikan Buku Si Juki Anti Mainstream', '2018-03-08 16:41:32'),
(50, '1', 'D.Syafaatul Anbiya Mengembalikan Buku Belajar Javascript dasar pemula', '2018-03-08 16:42:47'),
(51, '1', 'D.Syafaatul Anbiya Mengembalikan Buku Belajar Javascript dasar pemula', '2018-03-08 16:43:01'),
(52, '1', 'D.Syafaatul Anbiya Mengembalikan Buku Si Juki Anti Mainstream', '2018-03-08 16:46:49'),
(53, '1', 'D.Jamaatul Anbiya Mengembalikan Buku Si Juki Anti Mainstream', '2018-03-08 16:46:55'),
(54, '1', 'D.Jamaatul Anbiya Mengembalikan Buku Si Juki Anti Mainstream', '2018-03-08 16:47:02'),
(55, '1', 'D.Jamaatul Anbiya Mengembalikan Buku Si Juki Anti Mainstream', '2018-03-08 16:47:11'),
(56, '1', 'D.Syafaatul Anbiya Mengembalikan Buku Si Juki Anti Mainstream', '2018-03-08 16:48:38'),
(57, '1', 'D.Syafaatul Anbiya Mengembalikan Buku Si Juki Anti Mainstream', '2018-03-08 16:48:42'),
(58, '1', 'Dimas Septian Irawan Mengembalikan Buku Majalengka Kota Angin', '2018-03-08 16:48:46'),
(59, '1', 'Dimas Septian Irawan Mengembalikan Buku Majalengka Kota Angin', '2018-03-08 16:48:49'),
(60, '1', 'Dimas Septian Irawan Mengembalikan Buku Majalengka Kota Angin', '2018-03-08 17:06:09'),
(61, '1', 'Dimas Septian Irawan Mengembalikan Buku Majalengka Kota Angin', '2018-03-08 17:07:13'),
(62, '1', 'D.Jamaatul Anbiya Mengembalikan Buku Majalengka Kota Angin', '2018-03-08 17:07:27'),
(63, '1', 'D.Syafaatul Anbiya Memperpanjang Memperpanjang Buku Si Juki Anti Mainstream', '2018-03-08 17:07:40'),
(64, '1', 'D.Syafaatul Anbiya Memperpanjang Memperpanjang Buku Si Juki Anti Mainstream', '2018-03-08 17:09:12'),
(65, '1', 'D.Jamaatul Anbiya Mengembalikan Buku Belajar PHP dasar pemula', '2018-03-08 17:10:14'),
(66, '1', 'Mengedit Data Anggota D.Syafaatul Anbiya', '2018-03-08 20:11:43'),
(67, '1', 'Mengedit Data Anggota D.Jamaatul Anbiya', '2018-03-08 20:11:51'),
(68, '1', 'D.Syafaatul Anbiya Mengembalikan Buku Si Juki Anti Mainstream', '2018-03-08 20:22:46'),
(69, '1', 'D.Syafaatul Anbiya Mengembalikan Buku Si Juki Anti Mainstream', '2018-03-08 20:22:56'),
(70, '1', 'D.Syafaatul Anbiya Mengembalikan Buku Belajar PHP dasar pemula', '2018-03-08 20:23:03'),
(71, '1', 'Menambahkan peminjaman baru dari D.Syafaatul Anbiya', '2018-03-09 07:53:43'),
(72, '1', 'Menambahkan peminjaman baru dari D.Jamaatul Anbiya', '2018-03-09 07:54:29'),
(73, '1', 'Menambahkan peminjaman baru dari D.Jamaatul Anbiya', '2018-03-09 07:54:38'),
(74, '1', 'Menambahkan peminjaman baru dari Dimas Septian Irawan', '2018-03-09 07:54:45'),
(75, '1', 'Menambahkan peminjaman baru dari Dimas Septian Irawan', '2018-03-09 07:54:45'),
(76, '1', 'Menambahkan Buku Baru Masuk', '2018-03-09 10:35:40'),
(77, '1', 'Menambahkan Buku Baru 1', '2018-03-09 10:52:40'),
(78, '1', 'Menghapus Catatan Buku Kas', '2018-03-09 10:56:11'),
(79, '1', 'Mengedit Catatan Buku Kas', '2018-03-09 11:15:08'),
(80, '1', 'Mengedit Catatan Buku Kas', '2018-03-09 11:15:24'),
(81, '1', 'Mengedit Catatan Buku Kas', '2018-03-09 11:15:53'),
(82, '1', 'Mengedit Catatan Buku Kas', '2018-03-09 11:16:30'),
(83, '1', 'Mengedit Catatan Buku Kas', '2018-03-09 11:24:14'),
(84, '1', 'Mengedit Catatan Buku Kas', '2018-03-09 11:24:39'),
(85, '1', 'D.Syafaatul Anbiya Mengembalikan Buku Si Juki Anti Mainstream', '2018-03-09 13:46:52'),
(86, '1', 'Dimas Septian Irawan Membayar denda', '2018-03-09 13:50:37'),
(87, '1', 'Menambahkan Catatan Buku Kas', '2018-03-09 14:03:44'),
(88, '1', 'Dimas Septian Irawan Membayar denda', '2018-03-09 14:04:41'),
(89, '1', 'Menghapus Catatan Buku Kas', '2018-03-09 14:04:55'),
(90, '1', 'Dimas Septian Irawan Membayar denda', '2018-03-09 14:06:07'),
(91, '1', 'Menghapus Catatan Buku Kas', '2018-03-09 14:07:19'),
(92, '1', 'Menambahkan Catatan Buku Kas', '2018-03-09 14:09:57'),
(93, '1', 'Dimas Septian Irawan Membayar denda', '2018-03-09 14:10:50'),
(94, '1', 'Menghapus Catatan Buku Kas', '2018-03-09 14:10:58'),
(95, '1', 'Dimas Septian Irawan Membayar denda', '2018-03-09 14:12:29'),
(96, '1', 'Menghapus Catatan Buku Kas', '2018-03-09 14:12:48'),
(97, '1', 'Menambahkan Catatan Buku Kas', '2018-03-09 14:13:39'),
(98, '1', 'D.Syafaatul Anbiya Membayar denda', '2018-03-09 16:14:07'),
(99, '1', 'Dimas Septian Irawan Membayar denda', '2018-03-09 16:14:40'),
(100, '1', 'Dimas Septian Irawan Membayar denda', '2018-03-09 16:14:44'),
(101, '1', 'Menghapus Catatan Buku Kas', '2018-03-09 16:31:21'),
(102, '1', 'Dimas Septian Irawan Membayar denda', '2018-03-10 08:12:42'),
(103, '1', 'Menambahkan Catatan Buku Kas', '2018-03-10 08:18:49'),
(104, '1', 'Menambahkan Catatan Buku Kas', '2018-03-10 08:39:29'),
(105, '1', 'Mengedit Catatan Buku Kas', '2018-03-10 08:40:11'),
(106, '1', 'Mengedit Catatan Buku Kas', '2018-03-10 08:40:51'),
(107, '1', 'Menambahkan Catatan Buku Kas', '2018-03-10 22:39:03'),
(108, '1', 'D.Syafaatul Anbiya Mengembalikan Buku Si Juki Anti Mainstream', '2018-03-10 22:39:45'),
(109, '1', 'Dimas Septian Irawan Mengembalikan Buku Majalengka Kota Angin', '2018-03-10 22:40:19'),
(110, '1', 'Dimas Septian Irawan Mengembalikan Buku Majalengka Kota Angin', '2018-03-10 22:40:44'),
(111, '1', 'Dimas Septian Irawan Mengembalikan Buku Belajar PHP dasar pemula', '2018-03-10 22:40:52'),
(112, '1', 'D.Syafaatul Anbiya Mengembalikan Buku Si Juki Anti Mainstream', '2018-03-10 22:42:00'),
(113, '1', 'D.Syafaatul Anbiya Mengembalikan Buku Si Juki Anti Mainstream', '2018-03-10 22:42:08'),
(114, '1', 'D.Jamaatul Anbiya Mengembalikan Buku Si Juki Anti Mainstream', '2018-03-10 22:42:53'),
(115, '1', 'D.Jamaatul Anbiya Mengembalikan Buku Si Juki Anti Mainstream', '2018-03-10 22:43:06'),
(116, '1', 'D.Syafaatul Anbiya Mengembalikan Buku Si Juki Anti Mainstream', '2018-03-10 22:45:48'),
(117, '1', 'Dimas Septian Irawan Mengembalikan Buku Majalengka Kota Angin', '2018-03-10 22:46:14'),
(118, '1', 'Menambahkan Kategori Baru Internet', '2018-03-10 23:03:50'),
(119, '1', 'Menambahkan Kategori Baru Politik', '2018-03-10 23:04:04'),
(120, '1', 'Menambahkan Kategori Baru Sejarah', '2018-03-10 23:04:15'),
(121, '1', 'Menambahkan Buku Baru hentai', '2018-03-11 13:42:01'),
(122, '1', 'Menghapus Buku hentai', '2018-03-11 13:51:29'),
(123, '1', 'D.Syafaatul Anbiya Mengembalikan Buku Si Juki Anti Mainstream', '2018-03-11 17:21:56'),
(124, '1', 'Dimas Septian Irawan Mengembalikan Buku Majalengka Kota Angin', '2018-03-11 17:30:21'),
(125, '1', 'Menambahkan peminjaman baru dari D.Syafaatul Anbiya', '2018-03-11 17:30:45'),
(126, '1', 'Mengedit Pengaturan Perpustakaan', '2018-03-14 22:38:19'),
(127, '1', 'Mengedit Pengaturan Perpustakaan', '2018-03-14 22:39:01'),
(128, '1', 'D.Syafaatul Anbiya Mengembalikan Buku Belajar Javascript dasar pemula', '2018-03-16 11:38:41'),
(129, '1', 'Menambahkan peminjaman baru dari D.Syafaatul Anbiya', '2018-03-16 11:41:41'),
(130, '1', 'D.Syafaatul Anbiya Mengembalikan Buku Belajar HTML dasar Pemula', '2018-03-16 11:42:02'),
(131, '1', 'Dimas Septian Irawan Mengembalikan Buku Belajar Javascript dasar pemula', '2018-03-16 11:43:50'),
(132, '1', 'Menambahkan peminjaman baru dari D.Syafaatul Anbiya', '2018-03-16 11:44:05'),
(133, '1', 'Mengedit Pengaturan Perpustakaan', '2018-03-16 11:51:48'),
(134, '1', 'Mengedit Pengaturan Perpustakaan', '2018-03-16 11:52:24'),
(135, '1', 'Mengedit Pengaturan Perpustakaan', '2018-03-16 11:52:50'),
(136, '1', 'Mengedit Pengaturan Perpustakaan', '2018-03-16 11:53:28');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_buku`
--

CREATE TABLE `tabel_buku` (
  `id_buku` int(11) NOT NULL,
  `kode_buku` varchar(15) NOT NULL,
  `judul_buku` text NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `pengarang` varchar(50) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `tahun_terbit` varchar(15) NOT NULL,
  `tanggal_masuk` datetime NOT NULL,
  `stok` int(15) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_buku`
--

INSERT INTO `tabel_buku` (`id_buku`, `kode_buku`, `judul_buku`, `id_kategori`, `pengarang`, `penerbit`, `tahun_terbit`, `tanggal_masuk`, `stok`, `status`) VALUES
(1, 'B0867', 'Si Juki Anti Mainstream', 2, 'Si Juki', 'Gramedia', '2017', '2018-02-11 00:00:00', 10, '1'),
(6, 'B0390', 'Majalengka Kota Angin', 4, 'dsyafaatul tamvan', 'Gramedia', '2018', '2018-02-17 00:00:00', 10, '1'),
(7, 'B0507', 'Belajar PHP dasar pemula', 3, 'dsyafaatul tamvan', 'CV eaSYstem', '2018', '2018-02-18 00:00:00', 100, '1'),
(8, 'B0413', 'Belajar HTML dasar Pemula', 3, 'dsyafaatul tamvan', 'Gramedia', '2018', '2018-03-06 00:00:00', 100, '1'),
(9, 'B0436', 'Belajar Javascript dasar pemula', 3, 'dsyafaatul tamvan', 'Gramedia', '2018', '2018-03-07 20:01:33', 100, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_buku_kas`
--

CREATE TABLE `tabel_buku_kas` (
  `id` int(11) NOT NULL,
  `id_penjaga` int(15) DEFAULT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `keterangan` text NOT NULL,
  `uang` int(11) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_buku_kas`
--

INSERT INTO `tabel_buku_kas` (`id`, `id_penjaga`, `id_peminjaman`, `status`, `keterangan`, `uang`, `tanggal`) VALUES
(1, 1, 0, '1', 'Sumbangan Dari Kepala Sekolah', 2000, '2018-03-09 14:13:39'),
(2, 1, 1, '1', 'D.Syafaatul Anbiya Membayar denda', 7000, '2018-03-09 16:14:07'),
(3, 1, 3, '1', 'Dimas Septian Irawan Membayar denda', 10000, '2018-03-09 16:14:40'),
(4, 1, 4, '1', 'Dimas Septian Irawan Membayar denda', 13000, '2018-03-10 08:12:42'),
(5, 1, 0, '1', 'Sumbangan dari Tukang Parkir', 100, '2018-03-10 08:18:49'),
(6, 1, 0, '0', 'Membayar jatah preman', 100, '2018-03-10 08:39:29'),
(7, 1, 0, '0', 'Isi Ulang Galon', 5000, '2018-03-10 22:39:03');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_kategori`
--

CREATE TABLE `tabel_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_kategori`
--

INSERT INTO `tabel_kategori` (`id_kategori`, `nama_kategori`, `status`) VALUES
(1, 'Novel', '1'),
(2, 'Komik', '1'),
(3, 'Tutorial', '1'),
(4, 'Cerpen', '1'),
(5, 'Kamus', '1'),
(6, 'Internet', '1'),
(7, 'Politik', '1'),
(8, 'Sejarah', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_kelas`
--

CREATE TABLE `tabel_kelas` (
  `id_kelas` int(11) NOT NULL,
  `tingkat` int(15) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_kelas`
--

INSERT INTO `tabel_kelas` (`id_kelas`, `tingkat`, `jurusan`, `status`) VALUES
(1, 10, 'RPL', '1'),
(2, 10, 'TKJ', '1'),
(3, 11, 'RPL', '1'),
(4, 11, 'TKJ', '1'),
(5, 12, 'RPL', '1'),
(10, 12, 'TKJ', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_peminjaman`
--

CREATE TABLE `tabel_peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_penjaga` int(15) NOT NULL,
  `nis` varchar(15) NOT NULL,
  `kode_buku` varchar(15) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `batas_waktu` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0',
  `keterangan` enum('1','0') NOT NULL,
  `denda` int(11) NOT NULL,
  `status_denda` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_peminjaman`
--

INSERT INTO `tabel_peminjaman` (`id_peminjaman`, `id_penjaga`, `nis`, `kode_buku`, `tanggal_pinjam`, `batas_waktu`, `tanggal_kembali`, `status`, `keterangan`, `denda`, `status_denda`) VALUES
(1, 1, '0012498036', 'B0867', '2018-02-18', '2018-03-01', '2018-03-10', '1', '0', 9000, '0'),
(2, 1, '0012498037', 'B0390', '2018-02-18', '2018-03-14', '2018-03-08', '1', '1', 0, ''),
(3, 1, '0012498038', 'B0390', '2018-02-18', '2018-02-26', '2018-03-11', '1', '0', 13000, '0'),
(4, 1, '0012498038', 'B0390', '2018-02-18', '2018-02-23', '2018-03-10', '1', '0', 15000, '0'),
(5, 1, '0012498036', 'B0507', '2018-02-21', '2018-03-09', '2018-03-08', '1', '1', 0, ''),
(6, 1, '0012498037', 'B0507', '2018-02-22', '2018-03-17', '2018-03-08', '1', '1', 0, ''),
(8, 1, '0012498038', 'B0507', '2018-03-06', '2018-03-11', '2018-03-10', '1', '1', 0, ''),
(9, 1, '0012498037', 'B0867', '2018-03-06', '2018-03-11', '0000-00-00', '0', '', 0, ''),
(10, 1, '0012498036', 'B0867', '2018-03-07', '2018-03-10', '2018-03-11', '1', '0', 1000, '0'),
(11, 1, '0012498036', 'B0436', '2018-03-08', '2018-04-09', '2018-03-16', '1', '1', 0, ''),
(12, 1, '0012498036', 'B0867', '2018-03-09', '2018-03-12', '0000-00-00', '0', '', 0, ''),
(13, 1, '0012498037', 'B0413', '2018-03-09', '2018-03-12', '0000-00-00', '0', '', 0, ''),
(14, 1, '0012498037', 'B0507', '2018-03-09', '2018-03-12', '0000-00-00', '0', '', 0, ''),
(15, 1, '0012498038', 'B0436', '2018-03-09', '2018-03-12', '0000-00-00', '0', '', 0, ''),
(16, 1, '0012498038', 'B0436', '2018-03-09', '2018-03-12', '2018-03-16', '1', '0', 4000, '0'),
(17, 1, '0012498036', 'B0413', '2018-03-11', '2018-03-14', '2018-03-16', '1', '0', 2000, '0'),
(18, 1, '0012498036', 'B0867', '2018-03-16', '2018-03-19', '0000-00-00', '0', '', 0, ''),
(19, 1, '0012498036', 'B0507', '2018-03-16', '2018-03-19', '0000-00-00', '0', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_penjaga`
--

CREATE TABLE `tabel_penjaga` (
  `id_penjaga` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_penjaga` varchar(50) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `foto_penjaga` text,
  `level` enum('Admin','Penjaga') NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_penjaga`
--

INSERT INTO `tabel_penjaga` (`id_penjaga`, `username`, `password`, `nama_penjaga`, `jenis_kelamin`, `no_telepon`, `alamat`, `foto_penjaga`, `level`, `status`) VALUES
(1, 'admin', '$2y$10$.ynn5y/QaGCaZHVRaUYieurh5ue23Z7v6H28jqgBILd3uv/7goR1m', 'Admin web', 'L', '089677011289', 'Jl.Rajawali No.312, Rt.31/Rw.16, Perumahan Sindangkasih, Majalengka', '20180307035049_kamen_rider_genm_by_gegopat-dbb7ky0.png', 'Admin', '1'),
(2, 'dsyafaatul', '$2y$10$eYvgbY/Hr3nk0e4BdRepvuTz3zCXscGHps7PePBYKx0eULFq2LSIi', 'D.Syafaatul Anbiya', 'L', '089677011289', 'Jl.Rajawali No.312, Rt.31/Rw.16, Perumahan Sindangkasih, Majalengka', 'user.jpg', 'Penjaga', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_siswa`
--

CREATE TABLE `tabel_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` varchar(15) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_siswa`
--

INSERT INTO `tabel_siswa` (`id_siswa`, `nis`, `nama_siswa`, `id_kelas`, `jenis_kelamin`, `no_telepon`, `alamat`, `status`) VALUES
(1, '0012498036', 'D.Syafaatul Anbiya', 4, 'L', '089677011289', 'JL.Rajawali, No.312, Rt.32/Rw.16, Perumahan Sindangkasih, Majalengka', '1'),
(2, '0012498037', 'D.Jamaatul Anbiya', 3, 'L', '089697823201', 'Jl.Rajawali No.312, Rt.31/Rw.16, Perumahan Sindangkasih, Majalengka', '1'),
(3, '0012498038', 'Dimas Septian Irawan', 1, 'L', '081214171819', 'Perumahan Sindangkasih, Majalengka', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `tabel_buku`
--
ALTER TABLE `tabel_buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD UNIQUE KEY `kode_buku` (`kode_buku`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `tabel_buku_kas`
--
ALTER TABLE `tabel_buku_kas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penjaga` (`id_penjaga`),
  ADD KEY `nis` (`id_peminjaman`);

--
-- Indexes for table `tabel_kategori`
--
ALTER TABLE `tabel_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tabel_kelas`
--
ALTER TABLE `tabel_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `tabel_peminjaman`
--
ALTER TABLE `tabel_peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `kode_buku` (`kode_buku`),
  ADD KEY `nis` (`nis`),
  ADD KEY `id_penjaga` (`id_penjaga`);

--
-- Indexes for table `tabel_penjaga`
--
ALTER TABLE `tabel_penjaga`
  ADD PRIMARY KEY (`id_penjaga`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tabel_siswa`
--
ALTER TABLE `tabel_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `nis` (`nis`) USING BTREE,
  ADD KEY `id_kelas` (`id_kelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;
--
-- AUTO_INCREMENT for table `tabel_buku`
--
ALTER TABLE `tabel_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tabel_buku_kas`
--
ALTER TABLE `tabel_buku_kas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tabel_kategori`
--
ALTER TABLE `tabel_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tabel_kelas`
--
ALTER TABLE `tabel_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tabel_peminjaman`
--
ALTER TABLE `tabel_peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `tabel_penjaga`
--
ALTER TABLE `tabel_penjaga`
  MODIFY `id_penjaga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tabel_siswa`
--
ALTER TABLE `tabel_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tabel_buku`
--
ALTER TABLE `tabel_buku`
  ADD CONSTRAINT `tabel_buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `tabel_kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tabel_buku_kas`
--
ALTER TABLE `tabel_buku_kas`
  ADD CONSTRAINT `tabel_buku_kas_ibfk_2` FOREIGN KEY (`id_penjaga`) REFERENCES `tabel_penjaga` (`id_penjaga`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tabel_peminjaman`
--
ALTER TABLE `tabel_peminjaman`
  ADD CONSTRAINT `tabel_peminjaman_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `tabel_siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tabel_peminjaman_ibfk_2` FOREIGN KEY (`id_penjaga`) REFERENCES `tabel_penjaga` (`id_penjaga`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tabel_peminjaman_ibfk_3` FOREIGN KEY (`kode_buku`) REFERENCES `tabel_buku` (`kode_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tabel_siswa`
--
ALTER TABLE `tabel_siswa`
  ADD CONSTRAINT `tabel_siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `tabel_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
