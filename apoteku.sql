-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2020 at 01:51 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apoteku`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(5) NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(128) COLLATE latin1_general_ci DEFAULT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap_seo` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `deskripsi` text COLLATE latin1_general_ci DEFAULT NULL,
  `level` enum('admin','gudang','apoteker') COLLATE latin1_general_ci NOT NULL DEFAULT 'gudang',
  `status` enum('Aktif','Blokir') COLLATE latin1_general_ci NOT NULL DEFAULT 'Aktif',
  `id_session` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `last_login` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `gambar`, `nama_lengkap`, `nama_lengkap_seo`, `email`, `no_telp`, `deskripsi`, `level`, `status`, `id_session`, `last_login`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'humas-indonesia-admin-55.png', 'Admin', 'admin', 'admin@gmail.com', '', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.<br />\r\n&nbsp;</p>\r\n', 'admin', 'Aktif', '', '2020-05-12 13:05:53'),
(2, 'gudang', '202446dd1d6028084426867365b0c7a1', NULL, 'gudang', NULL, 'gudang@gmail.com', '03322', NULL, 'gudang', 'Aktif', '', '2020-05-12 12:52:15'),
(3, 'apoteker', '326dd0e9d42a3da01b50028c51cf21fc', NULL, 'apoteker', NULL, 'apoteker@gmail.com', '03322', NULL, 'apoteker', 'Aktif', '', '2020-05-12 13:02:44');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `kode_obat` varchar(200) NOT NULL,
  `no_batch` varchar(200) NOT NULL,
  `qty` int(11) NOT NULL,
  `expired` varchar(100) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_diskon` int(11) NOT NULL DEFAULT 0,
  `harga_jual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id_pembelian`, `kode_obat`, `no_batch`, `qty`, `expired`, `harga_beli`, `harga_diskon`, `harga_jual`) VALUES
(14, 'BRX', '601', 4, '12/20', 1000, 500, 2000),
(15, 'BRX', '602', 6, '12/22', 1000, 0, 2500),
(16, 'DLN', '6003', 10, '12/22', 1500, 0, 2000),
(17, 'CBN', '121', 5, '12/20', 1000, 0, 2000),
(21, 'CBN', '134', 5, '12/22', 0, 500, 2000),
(22, 'BRX', '423', 10, '12/22', 500, 100, 1000),
(23, 'CBN', '344', 10, '12/22', 100, 500, 1000),
(24, 'DLN', '324', 10, '12/22', 100, 50, 1000),
(25, 'PND', '132', 5, '12/22', 1000, 500, 2000),
(26, 'BRX', '3242', 10, '12/22', 3242, 2342, 4324324),
(27, 'BRX', '4332', 22, '12/22', 432432, 3232, 324243242),
(28, 'CBN', '22', 22, '12/22', 22, 0, 222),
(29, 'DLN', '324', 10, '12/22', 233232, 3232, 3323232),
(30, 'BRX', '342243', 10, '12/22', 333, 33, 3333),
(32, 'CBN', '2', 2, '12/22', 2, 0, 2),
(33, 'PRX', '2', 2, '12/22', 2, 0, 2),
(34, 'PND', '124', 10, '12/22', 1000, 0, 2000),
(35, 'DLN', '234', 5, '12/22', 1000, 0, 1500),
(36, 'CBN', '32332', 4, '12/22', 222, 222, 2),
(37, 'CBN', '2323', 5, '12/22', 11, 0, 3333),
(38, 'CBN', '5343', 5, '12/22', 3443, 0, 3434),
(39, 'BRX', '21', 9, '12/22', 1212, 0, 2121),
(40, 'CBN', '3434', 5, '12/22', 3443, 4334, 4334),
(41, 'CBN', '32423', 5, '12/22', 333, 0, 33),
(42, 'CBN', '5555', 5, '12/22', 3443, 0, 4343444),
(43, 'CBN', '555', 5, '12/22', 655656, 6565, 5665),
(44, 'CBN', '333', 2, '12/22', 33, 0, 33),
(45, 'CBN', '22', 2, '12/22', 2222, 0, 22),
(46, 'DLN', '435', 5, '12/22', 4334, 0, 3443),
(47, 'CBN', '3343', 2, '12/22', 333, 0, 333),
(48, 'BRX', '4334', 3, '12/20', 3443, 0, 3443),
(49, 'BRX', '22', 2, '12/22', 22, 0, 22),
(50, 'BRX', '222', 2, '12/22', 222, 0, 22),
(51, 'BRX', '334', 3, '12/22', 333, 0, 4334),
(52, 'CBN', '5454', 4, '12/22', 5454, 0, 5454),
(53, 'PND', '242', 2, '12/22', 4242, 0, 4242),
(54, 'PND', '423324', 2, '12/22', 423, 0, 243234),
(55, 'CBN', '423423', 5, '12/22', 2423, 0, 4223),
(56, 'CBN', '4343', 5, '12/22', 444, 4, 444),
(57, 'CBN', '2112', 2, '12/22', 1212, 212, 2121),
(58, 'BRX', '243234', 2, '12/22', 24342, 23423, 3223),
(59, 'PND', '1321', 6, '12/22', 2000, 1000, 3000),
(60, 'BRX', '434', 6, '12/22', 2000, 1000, 3000),
(61, 'CBN', '3234', 6, '12/22', 2000, 1000, 4000),
(62, 'BRX', '1231', 6, '12/22', 2000, 1000, 1500),
(63, 'DLN', '423fsfdf', 2, '12/22', 1000, 0, 1500),
(64, 'BRX', 'adssda22', 6, '12/22', 1, 500, 2),
(65, 'CBN', '33w', 2, '12/22', 1, 0, 2),
(66, 'CBN', '234432', 10, '12/22', 1, 500, 2),
(67, 'BRX', '43223frds', 2, '12/22', 100, 0, 1),
(68, 'BRX', '43223frds', 2, '12/22', 5, 0, 6),
(69, 'CBN', '43223frds', 2, '12/22', 1, 0, 2),
(69, 'BRX', '423fsfdf', 2, '12/22', 1, 0, 15),
(70, 'CBN', '43223frds', 2, '12/22', 1, 0, 2),
(71, 'BRX', 'adssda22', 2, '12/22', 1, 0, 2),
(72, 'CBN', '423fsfdf', 2, '12/22', 2, 0, 3),
(73, 'BRX', '423fsfdf', 2, '12/22', 1, 0, 2),
(73, 'CBN', 'adssda22', 4, '12/22', 1, 0, 2),
(74, 'PND', '234432', 10, '12/22', 2000, 0, 3000),
(75, 'PRX', 'ds2222', 2, '12/22', 1000, 500, 2000),
(76, 'PRO', '43223frds', 2, '12/22', 1000, 0, 2000),
(77, 'PRO', '43223frds', 2, '12/22', 1000, 0, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `kode_obat` varchar(200) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id_penjualan`, `kode_obat`, `jumlah`, `sub_total`) VALUES
(1, 'PND', 100, 200000),
(1, 'CBN', 2, 4000),
(2, 'PND', 100, 200000),
(2, 'CBN', 2, 4000),
(3, 'CBN', 8, 16000),
(4, 'DLN', 50, 166161600),
(6, 'CBN', 1, 2000),
(7, 'CBN', 1, 2000),
(8, 'CBN', 1, 2000),
(9, 'BRX', 1, 324243242),
(10, 'CBN', 1, 2000),
(11, 'CBN', 1, 2000),
(12, 'CBN', 1, 2000),
(13, 'PRX', 1, 2000),
(14, 'PND', 10, 2432340);

-- --------------------------------------------------------

--
-- Table structure for table `distributor`
--

CREATE TABLE `distributor` (
  `id_distributor` int(5) NOT NULL,
  `kode_distributor` varchar(150) NOT NULL,
  `npwp` varchar(100) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `distributor`
--

INSERT INTO `distributor` (`id_distributor`, `kode_distributor`, `npwp`, `nama`, `alamat`, `no_hp`, `tgl`) VALUES
(168, 'AMS', '07.819.702.7.523.000', 'PT ANTARMITRA SEMBADA', 'JL. KH Abdul Malik no. 16 rt 03/03 mersi purwokerto timur', '', '2020-04-20 15:34:55'),
(169, 'AAM', '01.129.737.1.411.000', 'PT Anugrah Argon Medica', 'Jl. S. Parman no.70 rt 09/rw 02 purwokerto', '', '2020-04-20 15:34:55'),
(170, 'AMJ', '(0271) 6844100-622495', 'PT. Abadi Jaya', 'Jl. Jendral Sudirman timur no.30 purwokerto', '', '2020-04-20 15:34:55'),
(171, 'APL', '01.369.518.4.092.000', 'PT. Anugrah Pharmindo Lestari', 'Jl. Boulevard BGR no 1 komplek pergudangan BGR Gudang M Jakarta Utara', '', '2020-04-20 15:34:55'),
(172, 'ABM', '316.060.375.541.000', 'PT. Anugrah Bintang Meditama', 'Jl. Dr. Wahidin no.34 klitren gondokusuman Yogyakarta 55222', '', '2020-04-20 15:34:56'),
(173, 'ATM', '(0281) 6512304', 'PT. Anugrah Tunas Medica Utama', 'Jl. HM. Bachroen no.36  Mersi Purwokerto', '', '2020-04-20 15:34:56'),
(174, 'BSP', '01.588.725.0-092.000', 'PT. Bina San Prima', 'Jl. Sultan Agung no 7A Teluk Kec. Purwokerto Selatan', '', '2020-04-20 15:34:56'),
(175, 'BKM', '71.275.896.0.526.000', 'PT. Bersama Kita Melangkah', 'Dk. Ceplukan rt 01 rw 17 wonorejo Gondanrejo Karanganyar Surakarta', '', '2020-04-20 15:34:56'),
(176, 'BTO', '', 'PT. Brataco', 'Jl. Perintis Kemerdekaan no. 75 B purwokerto', '', '2020-04-20 15:34:56'),
(177, 'CPM', '02.036.500.3-511.000', 'PT. Combi Putra Mandiri', 'Jl. Kalimas Raya A 54/ 111 Semarang 50143', '', '2020-04-20 15:34:56'),
(178, 'DNR', '07.819.702.7-523.000', 'PT Dos NI Roha', 'Jl. Parangtritis KM 4 Bangun harjo sewon Bantu Yogyakarta', '', '2020-04-20 15:34:56'),
(179, 'DBM', '01.555.204.5.004.000', 'PT. Distriversa Buanamas', 'Jl. DI Panjaitan Gang Karang Baru No. 1 Purwokerto', '', '2020-04-20 15:34:56'),
(180, 'EPM', '07.819.702.7.323.000', 'PT. Enseval Putera Megatrading Tbk', 'Jl. Soeparjo Roestam KM 04,1  Rt 07 rw 06 Purwokerto', '', '2020-04-20 15:34:56'),
(181, 'GJF', '01.202.115.0.511.000', 'PT Gratia Jaya Farma', 'Kawasan Industri Candi  Jl. Gatot Subroto Blok V No. 11 Semarang', '', '2020-04-20 15:34:56'),
(182, 'IGM', '01.061.184.6-051.000', 'PT Indofarma Global Medika', 'Komplek Infinia Park Jl. Dr. Saharjo No. 45', '', '2020-04-20 15:34:56'),
(183, 'KBP', '01.308.506.3-073.000', 'PT. Kebayoran Pharma', 'Jl. Melati Wetan 6 A', '', '2020-04-20 15:34:56'),
(184, 'KFM', '01.061.228.1-051.000', 'PT Kimia Farma', 'Jl. Pahlawan  no 875', '', '2020-04-20 15:34:56'),
(185, 'KPP', '02.656.398.1-518.000', 'PT. Kinarya Putra Perkasa', 'Jl. Jolotundo 11 no. 6', '', '2020-04-20 15:34:56'),
(186, 'MBS', '01.315.708.6-007.000', 'PT. Mensa Binasukses', 'Jl. Suparjo Rustam rt 01/00', '', '2020-04-20 15:34:56'),
(187, 'MPI', '01.300.861.0.054.000', 'PT. Millenium Pharmacon  International', 'Jl. Mangunjaya no. 272', '', '2020-04-20 15:34:56'),
(188, 'MNJ', '01.373.530.007.000', 'PT. Marga Nusantara Jaya', 'Jl. Pulo Kambing Kav II -E no. 9 KIP', '', '2020-04-20 15:34:56'),
(189, 'MUP', '07.819.702.7-523.000', 'PT. Merapi Utama Pharma', 'Jl. Cilosari 23 Cikini Menteng Jakarta 10330', '', '2020-04-20 15:34:57'),
(190, 'PVP', '07.819.702.7-523.000', 'PT Penta Valent', 'Jl. Martadireja 1 No. 788', '', '2020-04-20 15:34:57'),
(191, 'PAP', '01.515.622.7-526.000', 'Pt Pradipta Adipacific', 'Jl. Mertolulutan no 1', '', '2020-04-20 15:34:57'),
(192, 'PPD', '07.819.702.7-523.000', 'PT. Parit Padang Global', 'Jl. Nitipuran no. 9 Kadipiro Baru ', '', '2020-04-20 15:34:57'),
(193, 'RNI', '07.819.702.7.523.000', 'PT Rajawali Nusindo', 'Jl. Martadireja 1 no. 274 A', '', '2020-04-20 15:34:57'),
(194, 'SST', '07.819.702.7523.000', 'PT. sapta Sari Tama', 'Jl. Adipati Mersi no. 40', '', '2020-04-20 15:34:57'),
(195, 'SFS', '03.344.955.4-518.000', 'PT. Sumber Farma Semarang', 'Jl. Kimar I no. 249', '', '2020-04-20 15:34:57'),
(196, 'TSJ', '07.819.702.7-523.000', 'PT. Tri Sapta Jaya', 'Jl. Kabupaten rt 4 rw 12 Ngawen ', '', '2020-04-20 15:34:57'),
(197, 'TMP', '07.819.702.7.523.000', 'PT. Tempo', 'Jl. DI Panjaitan no 114', '', '2020-04-20 15:34:57'),
(198, 'TPJ', '', 'Toko Pojok', 'Jl. Sempor Lama no 56', '', '2020-04-20 15:34:57'),
(199, 'UDC', '01.301.246.3-073.000', 'PT. United Dico Citas', 'Jl. Pandega Karya no. 26 Depok', '', '2020-04-20 15:34:58');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id_module` int(5) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `gambar` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `jenis_modul` enum('text','textarea','images') NOT NULL,
  `tgl_update` datetime NOT NULL,
  `status` enum('on','off') NOT NULL,
  `tampil` enum('ya','tidak') NOT NULL,
  `no_urut` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id_module`, `nama`, `gambar`, `deskripsi`, `jenis_modul`, `tgl_update`, `status`, `tampil`, `no_urut`) VALUES
(0, 'Nama Web', '', 'Sistem Apotik,sistem-apotik,sistem-apotik,sistim-apotik,sistem-apotik,sistem-apotik', '', '2017-11-01 02:22:09', 'on', 'tidak', 0),
(1, 'Logo', 'gallery-olshop-logo-82.png', '', 'images', '2018-06-28 18:23:39', 'on', 'ya', 1),
(2, 'Alamat', '', 'Jl. Yos Sudarso 406', 'text', '2018-06-19 17:57:12', 'on', 'ya', 3),
(3, 'Maps', '', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15811.018935326638!2d110.3540983!3d-7.8157663!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x7c3f64463577856a!2sHomestay+Backpacker+Omah+Dewe!5e0!3m2!1sid!2sid!4v1550140151886\" width=\"100%\" height=\"250\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>\r\n ', 'text', '2018-05-15 08:40:20', 'off', 'tidak', 3),
(4, 'Facebook Plugins', '', 'https://www.facebook.com/evabeautycareolshop/', 'text', '2018-05-15 08:40:20', 'off', 'tidak', 4),
(5, 'Kontak Sidebar', '', '<p><span style=\"color:#ffffff\"><span style=\"font-family:Overlock\">PUSAT PENELITIAN DAN PENGEMBANGAN<br />\nPERHUTANI<br />\nALAMAT&nbsp; :<br />\nJL. WONOSARI BATOKAN TROMOL POS 6 CEPU<br />\nKAB. BLORA 58302&nbsp; JAWA TENGAH<br />\n<br />\nINDONESIA<br />\nâ€‹TELPON / FAX&nbsp; :<br />\n+62 296 421233 / +62 296 422439<br />\nEMAIL&nbsp; :</span></span><br />\n<object height=\"0\"><span style=\"font-family:Overlock\"><a data-auto-recognition=\"true\" data-content=\"puslitbang.dokinfo@gmail.com\" data-type=\"mail\" href=\"mailto:puslitbang.dokinfo@gmail.com\"><span style=\"color:#ffffff\">puslitbang.dokinfo@gmail.com</span></a></span></object></p>\n', 'textarea', '2018-02-22 17:46:03', 'off', 'tidak', 5),
(6, 'No Telpon', '', '0287 473686', 'text', '2018-04-23 05:26:25', 'on', 'ya', 6),
(7, 'No WA', '', '+62 812-7608-6260', 'text', '2018-04-24 11:45:45', 'on', 'ya', 6),
(8, 'Statistik Pengunjung', '', ' <!-- Histats.com  (div with counter) -->\r\n<div id=\"histats_counter\"></div>\r\n<!-- Histats.com  START  (aync)-->\r\n<script type=\"text/javascript\">var _Hasync= _Hasync|| [];\r\n_Hasync.push([\'Histats.start\', \'1,4011974,4,406,165,100,00011111\']);\r\n_Hasync.push([\'Histats.fasi\', \'1\']);\r\n_Hasync.push([\'Histats.track_hits\', \'\']);\r\n(function() {\r\nvar hs = document.createElement(\'script\'); hs.type = \'text/javascript\'; hs.async = true;\r\nhs.src = (\'//s10.histats.com/js15_as.js\');\r\n(document.getElementsByTagName(\'head\')[0] || document.getElementsByTagName(\'body\')[0]).appendChild(hs);\r\n})();</script>\r\n<noscript><a href=\"/\" target=\"_blank\"><img  src=\"//sstatic1.histats.com/0.gif?4011974&101\" alt=\"web hit counter\" border=\"0\"></a></noscript>\r\n<!-- Histats.com  END  -->', 'text', '2017-06-12 02:14:28', 'off', 'tidak', 8),
(9, 'Email', '', 'leriegita@yahoo.co.id', 'text', '2018-04-10 00:24:18', 'on', 'ya', 4),
(10, 'Email 2', '', 'adiwarnatour@gmail.com', 'text', '2018-04-10 00:24:24', 'off', 'tidak', 5),
(11, 'NPWP', '', '0-192-105-1-7541000', 'text', '2018-06-25 09:04:15', 'on', 'ya', 7),
(12, 'Nama Toko', '', 'Apotik Prima Sehat', 'text', '2018-06-25 09:05:51', 'on', 'ya', 0),
(14, 'Instagram Widget', '', '<!-- InstaWidget -->\r\n<a href=\"https://instawidget.net/v/user/eva_beautycare_fashionshop\" id=\"link-63759dd1a6e3e57a266e878bf6703f3c9b229437a69e654cac8fbcda3142f954\">@eva_beautycare_fashionshop</a>\r\n<script src=\"https://instawidget.net/js/instawidget.js?u=63759dd1a6e3e57a266e878bf6703f3c9b229437a69e654cac8fbcda3142f954&width=300px\"></script>', 'text', '2018-06-25 10:27:57', 'off', 'tidak', 9),
(19, 'Login', '', '<b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-11 09:22:47 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-11 09:24:08 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-11 09:24:58 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-11 10:20:03 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-11 11:01:55 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-11 11:35:08 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-11 12:08:04 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-11 13:07:44 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-11 13:15:42 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-13 06:05:19 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-13 07:44:00 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-13 07:49:48 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-13 07:56:42 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-13 08:01:47 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-13 08:26:56 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-13 08:29:03 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-13 10:00:56 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-13 10:15:36 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-16 03:12:11 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-16 07:43:54 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-20 08:37:13 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-20 10:21:46 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-22 07:34:26 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-22 07:41:42 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-22 08:17:21 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-22 09:56:40 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-22 10:02:08 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-22 10:27:23 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-22 10:46:50 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-22 10:55:54 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-22 11:22:19 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-22 11:32:12 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-22 12:23:07 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-22 13:11:20 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-22 13:41:32 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-22 14:01:37 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-22 15:25:55 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-22 15:51:44 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-22 16:17:12 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-22 16:35:48 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-22 17:57:30 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-22 18:32:26 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-22 18:54:00 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-22 22:55:48 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-02-28 20:36:24 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-02 15:57:30 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-02 15:58:57 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-02 16:55:02 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-02 18:35:08 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-02 20:42:01 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-03 11:27:55 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-05 14:36:30 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-05 15:57:47 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-05 16:00:05 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-05 16:55:25 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-05 17:36:57 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-05 18:06:47 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-05 18:32:59 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-05 22:31:18 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-05 23:29:26 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-05 23:34:51 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-06 03:08:32 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-06 05:19:02 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-06 06:21:05 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-06 06:25:45 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-06 19:02:10 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-06 20:17:55 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-11 12:20:11 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-11 12:41:42 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-11 14:56:31 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-11 14:59:16 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-11 21:18:05 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-15 21:14:50 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-15 23:34:42 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-16 00:47:06 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-16 15:58:21 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-17 07:49:37 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-20 09:38:44 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-20 10:47:32 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-20 19:57:12 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-20 23:35:45 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-20 23:43:17 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-21 01:08:56 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-21 02:00:40 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-21 12:17:54 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-21 16:46:20 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-21 17:02:44 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-21 21:47:26 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-21 22:05:43 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-21 22:26:08 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-22 01:00:45 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-22 06:45:17 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-24 12:06:08 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-25 19:58:05 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-25 21:12:15 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-27 08:25:31 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-28 06:35:24 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-28 08:27:04 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-28 09:46:05 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-28 09:49:16 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-28 10:44:14 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-28 10:46:31 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-28 17:15:16 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-28 19:51:22 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-29 02:03:05 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-29 09:56:15 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-29 11:39:48 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-29 12:18:26 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-29 23:16:26 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-30 08:30:46 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-30 11:01:23 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-30 11:26:46 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-30 21:59:18 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-30 23:02:56 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-30 23:58:54 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-03-31 08:02:18 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-01 00:23:39 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-01 01:31:37 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-01 07:45:06 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-01 09:47:34 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-02 22:58:09 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-03 12:07:37 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-04 02:34:47 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-09 22:38:58 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-10 01:16:30 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-10 09:10:18 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-10 11:45:42 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-10 16:17:48 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-10 20:36:58 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-18 00:26:46 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-18 11:24:57 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-18 12:41:56 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-18 14:43:25 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-18 21:58:50 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-19 20:48:13 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-23 05:25:11 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-24 11:11:19 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-24 11:45:07 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-26 11:08:33 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-26 11:47:19 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-26 12:01:17 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-26 21:14:38 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-26 21:16:15 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-26 22:19:55 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-26 22:24:31 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-26 22:39:53 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-04-26 22:46:34 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-05-15 03:54:33 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-05-15 04:11:33 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-05-15 04:26:10 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-05-15 04:40:58 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-05-15 06:16:13 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-05-15 06:24:04 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-05-15 06:30:45 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-05-15 06:46:22 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-05-15 07:45:22 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-05-15 08:03:43 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-05-15 08:11:26 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-05-15 08:40:15 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-05-27 21:53:27 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-05-27 23:34:25 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-05-27 23:35:28 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-05-28 01:29:28 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-05-28 03:52:58 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-05-28 04:27:53 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-06-19 17:51:01 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-06-19 19:16:12 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-06-19 21:04:47 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-06-19 21:54:22 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-06-19 23:14:22 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-06-19 23:45:56 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-06-20 00:00:26 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-06-20 16:03:58 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-06-22 10:39:54 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-06-25 08:47:07 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-06-25 09:18:47 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-06-25 10:18:55 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-06-26 22:03:36 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-06-28 18:13:53 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-07-01 17:50:24 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-07-01 18:42:48 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-07-01 19:14:52 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-07-01 20:53:09 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-13 11:09:53 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-13 16:32:51 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-13 16:55:20 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-13 16:58:18 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-13 17:18:46 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-16 16:15:37 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-17 13:48:40 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-17 15:16:54 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-17 16:15:08 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-17 17:54:12 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-17 19:07:55 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-17 19:07:56 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-17 21:00:41 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-17 21:18:24 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-17 22:26:38 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-19 02:43:11 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-19 15:26:49 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-19 15:52:04 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-19 16:46:03 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-19 23:58:17 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-20 00:05:46 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-20 00:20:04 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-20 00:45:48 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-20 00:55:07 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-20 01:35:20 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-20 09:18:46 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-20 09:29:13 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-20 09:44:42 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-20 10:10:37 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-20 10:17:49 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-20 10:43:53 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-20 11:29:14 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-20 12:48:00 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-20 13:57:44 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-20 15:34:53 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-20 18:08:32 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-20 18:14:46 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-20 18:38:48 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-21 12:28:09 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-21 14:35:39 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-21 14:55:07 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-22 08:03:05 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-23 22:38:35 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-24 11:19:02 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-24 19:34:59 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-24 20:14:02 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-24 20:32:46 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-24 20:40:00 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-26 08:05:23 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-26 08:51:16 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-26 19:43:25 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-26 20:04:42 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-27 10:23:16 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-27 15:57:42 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-27 19:47:44 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-28 09:45:10 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-28 10:05:26 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-28 18:39:25 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-29 11:53:51 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-29 15:57:47 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-08-29 16:09:43 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-10-31 22:50:31 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-01 00:32:34 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-01 03:13:15 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-01 04:17:14 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-01 07:51:39 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-05 04:51:27 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-05 04:54:58 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-05 05:22:18 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-05 05:24:21 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-05 05:38:42 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-05 05:43:03 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-05 06:17:39 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-05 11:16:56 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-05 13:08:30 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-06 12:23:18 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-18 09:17:05 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-18 16:36:17 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-18 18:44:45 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-18 18:50:33 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-18 19:27:24 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-18 21:25:13 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-18 22:37:02 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-19 11:25:57 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-19 11:31:04 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-19 11:57:09 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-19 14:12:35 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-19 15:57:23 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-19 20:08:47 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-19 20:19:28 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-21 14:10:51 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-21 14:34:48 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-21 15:17:45 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-21 15:57:14 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-21 17:58:26 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-21 18:02:59 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-21 21:12:58 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-21 23:27:19 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-22 01:29:21 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-22 14:46:46 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-22 15:39:25 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-23 22:12:31 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-24 10:29:05 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-24 20:28:44 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-27 07:46:30 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-27 08:09:49 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-27 12:35:41 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-28 10:41:21 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-28 11:05:13 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-11-29 08:59:14 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-06 12:23:23 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-11 06:04:36 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-11 06:09:36 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-11 07:28:02 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-11 08:14:12 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-11 09:33:11 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-11 09:36:58 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-11 09:55:21 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-11 10:14:11 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-11 11:00:39 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-11 11:04:24 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-11 11:11:19 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-11 11:15:28 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-11 11:23:01 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-11 11:41:51 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-11 11:48:58 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-11 11:56:35 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-12 05:53:18 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-12 09:58:10 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-12 10:34:21 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-12 14:03:52 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-23 09:26:18 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-23 10:01:08 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-23 10:02:28 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-23 14:45:40 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-23 16:40:49 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-23 16:42:40 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-23 16:47:21 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-23 18:40:43 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-23 19:19:26 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-23 21:40:13 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-23 21:55:57 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-23 22:10:03 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-24 00:20:51 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-24 00:20:58 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-24 00:21:02 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-24 00:21:40 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-24 14:02:58 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-24 14:26:42 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-25 09:33:05 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-25 10:12:22 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-25 16:53:25 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-25 17:13:33 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2018-12-26 16:55:13 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2019-01-02 16:10:06 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2019-01-05 21:26:09 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2019-01-06 02:41:50 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2019-01-06 05:18:13 | User +admin+ | Password +admin+ <br><b>Login in &nbsp;&nbsp;&nbsp;: </b>2019-01-06 05:43:41 | User +admin+ | Password +admin+ <br>', 'text', '2017-09-17 13:29:44', 'off', 'tidak', 0),
(20, 'Welcome Home', '', '\"Pilih dan pesan paket liburanmu sekarang juga!!\"', 'text', '2018-04-10 20:51:29', 'off', 'tidak', 2),
(21, 'Home Footer 2', '', '<p>Exclusive design, compact spatial, prestigious location, limited units, facilities, valuable investment with reasonable price. Find on OUR PROJECT In Yogyakarta..... <a class=\"g-transparent-a b3link\" href=\"project\" id=\"StBttn0link\" target=\"_self\"> </a>VIEW MORE<a class=\"g-transparent-a b3link\" href=\"project\" id=\"StBttn0link\" target=\"_self\"> </a></p>\n', 'textarea', '2017-12-18 04:20:01', 'off', 'tidak', 0),
(22, 'Logo WEB Small', '', 'logo_new@2x.png', 'images', '2017-11-21 22:56:16', 'off', 'tidak', 0),
(23, 'Footer Home', '', '\"Adi Warna Tour siap mengantar Anda ke berbagai tempat wisata di Yogyakarta\"\r\n', 'text', '2018-04-10 20:51:33', 'off', 'tidak', 2);

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(11) NOT NULL,
  `kode_obat` varchar(200) NOT NULL,
  `nama_obat` varchar(400) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `kode_distributor` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id_obat`, `kode_obat`, `nama_obat`, `stok`, `kode_distributor`) VALUES
(3, 'BRX', 'Bodrex', 110, 'AMS'),
(4, 'DLN', 'Delcogen', 32, 'AAM'),
(5, 'PND', 'Panadol', 40, 'AMJ'),
(6, 'PRX', 'Paramex', 3, 'APL'),
(7, 'FTG', 'Fatigon', 0, 'ABM'),
(8, 'CBN', 'Combatrin', 110, 'AMS'),
(9, 'PRO', 'Protap', 14, 'AMS'),
(11, 'BAC', 'Bacteria', 0, 'AMS');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id_page` int(5) NOT NULL,
  `urutan` int(2) NOT NULL DEFAULT 0,
  `judul` varchar(180) NOT NULL,
  `judul_seo` varchar(200) NOT NULL,
  `gambar` varchar(128) NOT NULL,
  `deskripsi` text NOT NULL,
  `hapus` enum('Yes','No') NOT NULL,
  `jenis_modul` enum('Text','Textarea','Textarea SEO','Judul & Text','Judul & Textarea','Text Images','Textarea Images','Images','Images SEO','SEO','All') NOT NULL,
  `status` enum('On','Off') NOT NULL,
  `tampil` enum('Ya','Tidak') NOT NULL,
  `title` varchar(128) NOT NULL,
  `keyword` text NOT NULL,
  `description` text NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `tgl_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id_page`, `urutan`, `judul`, `judul_seo`, `gambar`, `deskripsi`, `hapus`, `jenis_modul`, `status`, `tampil`, `title`, `keyword`, `description`, `keterangan`, `tgl_update`) VALUES
(0, 0, 'Home', 'home', '', '', 'No', 'SEO', 'On', 'Tidak', 'Home | Gallery Olshop', 'Home Gallery Olshop', 'Home Gallery Olshop', '', '2019-01-23 12:06:03'),
(1, 1, 'Produk', 'Produk', '', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.<br />\n<br />\nNulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.<br />\n<br />\nAenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.<br />\n<br />\nNam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.</p>\n', 'No', 'Textarea SEO', 'On', 'Ya', 'Produk | Gallery Olshop', 'Produk Gallery Olshop', 'Produk Gallery Olshop', '', '2018-08-20 13:58:52'),
(2, 2, 'Tentang Kami', 'tentang-kami', '', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.<br />\n<br />\nNulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.<br />\n<br />\nAenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.<br />\n<br />\nNam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.</p>\n', 'No', 'Textarea SEO', 'On', 'Ya', 'Tentang Kami | Gallery Olshop', 'Tentang Kami Gallery Olshop', 'Tentang Kami Gallery Olshop', '', '2018-11-05 06:41:45'),
(3, 3, 'Reseller', 'reseller', '', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. <br><br>\r\n\r\nNulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.<br><br>\r\n\r\nAenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. <br><br>\r\n \r\nNam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.</p>\r\n', 'No', 'Textarea SEO', 'On', 'Ya', 'Reseller | Gallery Olshop', 'Reseller Gallery Olshop', 'Reseller Gallery Olshop', '', '2019-02-14 01:48:03'),
(4, 4, 'Artikel', 'artikel', '', '<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">Jl. Jatimulyo, RT: 04 RW:04 Kedung Dayak 4, Jatimulyo, Dlingo, Bantul, Daerah Istimewa Yogyakarta 55783<br />\r\nTlp, WA, SMS : 085883661442<br />\r\n&nbsp;Email: </span><a href=\"mailto:kiwarifurniture@gmail.com\" style=\"color:blue; text-decoration:underline\"><span style=\"font-size:12.0pt\">kiwarifurniture@gmail.com</span></a></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">Instagram: @kiwaristudio_</span></span></span></p>\r\n', 'No', 'SEO', 'On', 'Ya', 'Artikel | Gallery Olshop', 'Artikel Gallery Olshop', 'Artikel Gallery Olshop', '', '2019-01-23 14:14:18'),
(5, 5, 'Cara Pembayaran', 'cara-pembayaran', '', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.<br />\r\n<br />\r\nNulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.<br />\r\n<br />\r\nAenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.<br />\r\n<br />\r\nNam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.</p>\r\n', 'No', 'Textarea SEO', 'On', 'Ya', 'Cara Pembayaran | Gallery Olshop', 'Cara Pembayaran Gallery Olshop', 'Cara Pembayaran Gallery Olshop', '', '2019-02-14 01:50:04'),
(6, 6, 'Home Text', 'home-text', '', '<h1 style=\"text-align:center\"><span style=\"font-size:48px\"><span style=\"font-family:Mr De Haviland\">Tulus Merawat Cantik Aslimu</span></span></h1>\r\n\r\n<p style=\"text-align:center\">Wajah cerah&nbsp;adalah investasi tak ternilai, rawat Wajah Anda sekarang juga dengan rangkaian perawatan wajah dari kami di Gallery Olshop&nbsp;untuk tetap cantik di masa tua.</p>\r\n\r\n<p style=\"text-align:center\">Yuk konsultasikan dengan Personal Beauty Consultant kami sekarang juga !</p>\r\n', 'No', 'Textarea', 'On', 'Ya', '', '', '', '', '2019-02-14 13:36:44'),
(7, 7, 'Home Text 2', 'home-text-2', 'gallery-olshop-home-text-2-57.png', '<h2><span style=\"font-size:36px\"><span style=\"font-family:Mr De Haviland\">Meet Your Personal Beauty Consultant!</span></span></h2>\r\n\r\n<h4>Personal Beauty Consultant dari Gallery Olshop&nbsp;yang telah Terdidik &amp; Terlatih dengan baik serta Ahli di bidangnya siap dengan Tulus Membantumu merawat Cantik Aslimu</h4>\r\n\r\n<p>Privasi Terjaga, Nyaman dan Bebas Biaya.</p>\r\n', 'No', 'Textarea Images', 'On', 'Ya', '', '', '', '', '2019-02-16 12:34:05'),
(8, 8, 'Shipping And Returns', 'shipping-and-returns', '', '<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">Pengiriman dilakukan melalui kurir cargo yang telah bekerjasama dengan kiwari.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">Biaya pengiriman untuk pembelian online dapat diketahui melalui harga produk dan atau keterangan biaya pengiriman. Anda juga dapat memilih untuk mengambil pesanan Anda secara pribadi di tempat produksi.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">Pengemasan dilakukan dengan standar packing produk furniture untuk menjaga kondisi barang dengan baik selama waktu pengiriman.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">Pesanan online akan diproses di hari kerja dan dikirimkan dalam waktu pengiriman bervariasi sesuai lokasi pelanggan.</span></span></span></p>\r\n', 'No', 'Textarea SEO', 'On', 'Ya', 'Home | Gallery Olshop', 'Gallery Olshop', 'Gallery Olshop', '', '2019-01-23 14:31:12'),
(9, 9, 'Faqs', 'faqs', '', '<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">Apakah semua furniture yang dibuat Kiwari dari kayu jati?</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">Iya. Kami berspesialisasi dalam memproduksi furniture dari material kayu jati sebagai bahan baku utama. </span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">Bagaimana saya tahu barang furniture mana yang masih tersedia di toko dari situs web?</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">Barang apa pun yang tidak dicantumkan sebagai &quot;ready stock&quot; atau &quot;ready shipping&quot; pada deskripsi produk berarti dapat dipesan secara pre order.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">Bagaimana cara melakukan pesanan pre order?</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">Pesanan pre order dapat dilakukan dengan cara menhubungi Kiwari lewat chatting Watsapp untuk kemudian diproses selanjutnya.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">Bagaimana cara melakukan pesanan produk custom?</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">Pesanan custom dapat dilakukan dengan cara menhubungi Kiwari lewat chatting Watsapp untuk kemudian diproses selanjutnya.</span></span></span></p>\r\n', 'No', 'Textarea SEO', 'On', 'Ya', 'Home | Gallery Olshop', 'Gallery Olshop', 'Gallery Olshop', '', '2019-01-23 14:30:47'),
(10, 10, 'Custom Order', 'custom-order', '', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.<br />\r\n<br />\r\nNulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.<br />\r\n<br />\r\nAenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.<br />\r\n<br />\r\nNam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.</p>\r\n', 'No', 'Textarea SEO', 'On', 'Ya', 'Home | Gallery Olshop', 'Gallery Olshop', 'Gallery Olshop', '', '2018-12-23 09:39:23');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_distributor` varchar(200) NOT NULL,
  `total_barang` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `tanggal`, `kode_distributor`, `total_barang`, `total_harga`, `id_admin`, `created_at`) VALUES
(14, '2020-04-26', 'AMS', 4, 2000, 1, '2020-04-26 14:17:37'),
(15, '2020-04-26', 'AMS', 6, 6000, 1, '2020-04-26 14:25:13'),
(16, '2020-04-26', 'AAM', 10, 15000, 1, '2020-04-26 14:44:22'),
(17, '2020-04-27', 'AMS', 5, 5000, 1, '2020-04-27 09:29:52'),
(18, '2020-04-27', 'AMS', 5, 5000, 1, '2020-04-27 09:29:56'),
(19, '2020-04-27', 'AMS', 5, 5000, 1, '2020-04-27 09:29:59'),
(20, '2020-04-27', 'AMS', 5, 5000, 1, '2020-04-27 09:29:59'),
(21, '2020-04-27', 'AMS', 5, 2500, 1, '2020-04-27 09:31:21'),
(22, '2020-04-27', 'AMS', 10, 1000, 1, '2020-04-27 09:39:23'),
(23, '2020-04-27', 'AMS', 10, 5000, 1, '2020-04-27 09:40:09'),
(24, '2020-04-27', 'AAM', 10, 500, 1, '2020-04-27 09:57:27'),
(25, '2020-04-27', 'AMJ', 5, 2500, 1, '2020-04-27 10:05:39'),
(26, '2020-04-27', 'AMS', 10, 23420, 1, '2020-04-27 10:06:43'),
(27, '2020-04-27', 'AMS', 22, 71104, 1, '2020-04-27 10:12:43'),
(28, '2020-04-27', 'AMS', 22, 484, 1, '2020-04-27 10:16:13'),
(29, '2020-04-27', 'AAM', 10, 32320, 1, '2020-04-27 10:18:21'),
(30, '2020-05-11', 'AMS', 10, 330, 1, '2020-05-11 04:03:19'),
(31, '2020-05-11', 'AMS', 10, 330, 1, '2020-05-11 04:10:49'),
(32, '2020-05-11', 'AMS', 2, 4, 1, '2020-05-11 04:11:07'),
(33, '2020-05-11', 'APL', 2, 4, 1, '2020-05-11 04:11:39'),
(34, '2020-05-11', 'AMJ', 10, 10000, 1, '2020-05-11 05:00:03'),
(35, '2020-05-11', 'AAM', 5, 5000, 1, '2020-05-11 05:07:21'),
(36, '2020-05-11', 'AMS', 4, 888, 1, '2020-05-11 05:11:11'),
(37, '2020-05-11', 'AMS', 5, 55, 1, '2020-05-11 05:12:28'),
(38, '2020-05-11', 'AMS', 5, 17215, 1, '2020-05-11 05:13:49'),
(39, '2020-05-11', 'AMS', 9, 10908, 1, '2020-05-11 05:15:09'),
(40, '2020-05-11', 'AMS', 5, 21670, 1, '2020-05-11 05:22:14'),
(41, '2020-05-11', 'AMS', 5, 1665, 1, '2020-05-11 05:26:21'),
(42, '2020-05-11', 'AMS', 5, 17215, 1, '2020-05-11 05:28:54'),
(43, '2020-05-11', 'AMS', 5, 32825, 1, '2020-05-11 05:30:44'),
(44, '2020-05-11', 'AMS', 2, 66, 1, '2020-05-11 07:19:09'),
(45, '2020-05-11', 'AMS', 2, 4444, 1, '2020-05-11 07:20:05'),
(46, '2020-05-11', 'AAM', 5, 21670, 1, '2020-05-11 07:21:52'),
(47, '2020-05-11', 'AMS', 2, 666, 1, '2020-05-11 07:22:46'),
(48, '2020-05-11', 'AMS', 3, 10329, 1, '2020-05-11 07:30:25'),
(49, '2020-05-11', 'AMS', 2, 44, 1, '2020-05-11 07:31:15'),
(50, '2020-05-11', 'AMS', 2, 444, 1, '2020-05-11 07:38:24'),
(51, '2020-05-11', 'AMS', 3, 999, 1, '2020-05-11 07:40:50'),
(52, '2020-05-11', 'AMS', 4, 21816, 1, '2020-05-11 07:41:53'),
(53, '2020-05-11', 'AMJ', 2, 8484, 1, '2020-05-11 07:44:21'),
(54, '2020-05-11', 'AMJ', 2, 846, 1, '2020-05-11 07:45:44'),
(55, '2020-05-11', 'AMS', 5, 12115, 1, '2020-05-11 07:49:42'),
(56, '2020-05-11', 'AMS', 5, 20, 1, '2020-05-11 07:56:14'),
(57, '2020-05-11', 'AMS', 2, 424, 1, '2020-05-11 07:57:20'),
(58, '2020-05-11', 'AMS', 2, 46846, 1, '2020-05-11 08:18:06'),
(59, '2020-05-11', 'AMJ', 6, 6000, 1, '2020-05-11 08:26:13'),
(60, '2020-05-11', 'AMS', 6, 12000, 1, '2020-05-11 08:29:15'),
(61, '2020-05-11', 'AMS', 6, 12000, 1, '2020-05-11 08:31:21'),
(62, '2020-05-11', 'AMS', 6, 12000, 1, '2020-05-11 08:32:21'),
(63, '2020-05-11', 'AAM', 2, 2000, 1, '2020-05-11 11:52:50'),
(64, '2020-05-11', 'AMS', 6, 6, 1, '2020-05-11 11:54:32'),
(65, '2020-05-11', 'AMS', 2, 2, 1, '2020-05-11 11:59:18'),
(66, '2020-05-11', 'AMS', 10, 10, 1, '2020-05-11 12:01:32'),
(67, '2020-05-11', 'AMS', 2, 200, 1, '2020-05-11 12:31:16'),
(68, '2020-05-11', 'AMS', 2, 10, 1, '2020-05-11 12:32:03'),
(69, '2020-05-11', 'AMS', 4, 4, 1, '2020-05-11 12:39:46'),
(70, '2020-05-11', 'AMS', 2, 2, 1, '2020-05-11 12:41:02'),
(71, '2020-05-11', 'AMS', 2, 2003, 1, '2020-05-11 12:42:13'),
(72, '2020-05-11', 'AMS', 2, 4000, 1, '2020-05-11 12:42:49'),
(73, '2020-05-11', 'AMS', 6, 6000, 1, '2020-05-11 12:44:47'),
(74, '2020-05-11', 'AMJ', 10, 20000, 1, '2020-05-11 12:50:42'),
(75, '2020-05-11', 'APL', 2, 2000, 1, '2020-05-11 12:54:03'),
(76, '2020-05-12', 'AMS', 2, 2000, 1, '2020-05-12 07:14:54'),
(77, '2020-05-12', 'AMS', 2, 2000, 1, '2020-05-12 07:16:13');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `nama_pelanggan` varchar(300) DEFAULT NULL,
  `dokter` varchar(300) DEFAULT NULL,
  `asal_rs` varchar(300) DEFAULT NULL,
  `biaya_racik` int(11) NOT NULL,
  `biaya_resep` int(11) NOT NULL,
  `total_biaya` int(11) NOT NULL,
  `total_obat` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `id_admin` int(11) NOT NULL,
  `resep` enum('ya','tidak','','') NOT NULL DEFAULT 'tidak'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `nama_pelanggan`, `dokter`, `asal_rs`, `biaya_racik`, `biaya_resep`, `total_biaya`, `total_obat`, `tanggal`, `id_admin`, `resep`) VALUES
(1, '', '', '', 6, 76, 206082, 102, '2020-04-29', 1, 'tidak'),
(2, '', '', '', 6, 76, 206082, 102, '2020-04-29', 1, 'tidak'),
(3, '', '', '', 1000, 1000, 19000, 8, '2020-04-29', 1, 'tidak'),
(4, '', '', '', 3000, 444, 166166044, 50, '2020-04-29', 1, 'tidak'),
(5, '', '', '', 1000, 1000, 5000, 1, '2020-04-30', 1, 'tidak'),
(6, '', '', '', 100, 100, 3200, 1, '2020-04-30', 1, 'tidak'),
(7, '', '', '', 1, 1, 3002, 1, '2020-04-30', 1, 'tidak'),
(8, '', '', '', 0, 0, 3000, 1, '2020-04-30', 1, 'tidak'),
(9, '', '', '', 1, 1, 324244244, 1, '2020-05-02', 1, 'tidak'),
(10, '', '', '', 1, 1, 3002, 1, '2020-05-02', 3, 'tidak'),
(11, '', '', '', 1, 1, 3002, 1, '2020-05-02', 3, 'tidak'),
(12, '', '', '', 2, 2, 3004, 1, '2020-05-02', 3, 'tidak'),
(13, '', '', '', 1000, 1000, 5000, 1, '2020-05-12', 3, 'tidak'),
(14, '', '', '', 500, 1000, 2434840, 10, '2020-05-12', 3, 'tidak');

-- --------------------------------------------------------

--
-- Table structure for table `statistik`
--

CREATE TABLE `statistik` (
  `id` int(5) NOT NULL,
  `ip` varchar(20) NOT NULL DEFAULT '',
  `tanggal` date NOT NULL,
  `hits` int(10) NOT NULL DEFAULT 1,
  `online` varchar(255) NOT NULL,
  `tgl_masuk` datetime DEFAULT current_timestamp(),
  `browser` varchar(30) NOT NULL DEFAULT 'Undetect',
  `platform` varchar(30) NOT NULL DEFAULT 'Undetect'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statistik`
--

INSERT INTO `statistik` (`id`, `ip`, `tanggal`, `hits`, `online`, `tgl_masuk`, `browser`, `platform`) VALUES
(4, '::1', '2019-02-05', 11, '1549350889', '2019-02-05 14:03:28', 'Google Chrome', 'Windows'),
(5, '::1', '2019-02-13', 19, '1550077117', '2019-02-13 22:38:21', 'Google Chrome', 'Windows'),
(6, '::1', '2019-02-14', 481, '1550110262', '2019-02-14 00:02:06', 'Google Chrome', 'Windows'),
(7, '180.254.106.149', '2019-02-14', 11, '1550114130', '2019-02-14 08:01:37', 'Google Chrome', 'Windows'),
(8, '180.254.106.149', '2019-02-14', 1, '1550111504', '2019-02-14 08:01:44', '', ''),
(9, '36.73.104.80', '2019-02-14', 108, '1550140444', '2019-02-14 08:07:20', 'Google Chrome', 'Windows'),
(10, '36.73.104.80', '2019-02-14', 2, '1550128883', '2019-02-14 09:41:27', 'IBrowse', 'Linux'),
(11, '36.73.104.80', '2019-02-14', 2, '1550140286', '2019-02-14 16:01:22', '', ''),
(12, '114.125.108.106', '2019-02-14', 1, '1550141328', '2019-02-14 16:18:48', 'Google Chrome', 'Linux'),
(13, '114.125.127.212', '2019-02-14', 1, '1550149671', '2019-02-14 18:37:51', 'Google Chrome', 'Linux'),
(14, '36.73.104.80', '2019-02-15', 69, '1550227135', '2019-02-15 08:21:02', 'Google Chrome', 'Windows'),
(15, '36.73.52.3', '2019-02-15', 1, '1550234739', '2019-02-15 18:15:39', 'Google Chrome', 'Linux'),
(16, '180.246.174.108', '2019-02-16', 34, '1550306793', '2019-02-16 08:50:56', 'Google Chrome', 'Windows'),
(17, '66.102.6.179', '2019-02-16', 1, '1550289504', '2019-02-16 09:28:24', 'Google Chrome', 'Linux'),
(18, '180.246.174.108', '2019-02-16', 1, '1550306202', '2019-02-16 14:06:42', '', ''),
(19, '182.1.64.15', '2019-02-16', 4, '1550312296', '2019-02-16 15:39:21', 'Google Chrome', 'Linux'),
(20, '182.1.67.35', '2019-02-16', 1, '1550311963', '2019-02-16 15:42:43', 'Google Chrome', 'Linux'),
(21, '182.1.65.27', '2019-02-16', 1, '1550311971', '2019-02-16 15:42:51', 'Google Chrome', 'Linux'),
(22, '182.1.66.178', '2019-02-16', 1, '1550312128', '2019-02-16 15:45:28', 'Google Chrome', 'Linux'),
(23, '182.1.83.140', '2019-02-16', 1, '1550312171', '2019-02-16 15:46:11', 'Google Chrome', 'Linux'),
(24, '182.1.82.162', '2019-02-16', 1, '1550312312', '2019-02-16 15:48:32', 'Google Chrome', 'Linux'),
(25, '36.73.52.3', '2019-02-17', 1, '1550365538', '2019-02-17 06:35:38', 'Google Chrome', 'Linux'),
(26, '180.246.174.108', '2019-02-18', 5, '1550472646', '2019-02-18 12:19:26', 'Google Chrome', 'Windows'),
(27, '180.246.174.108', '2019-02-19', 2, '1550550491', '2019-02-19 09:58:03', 'Google Chrome', 'Windows'),
(28, '36.80.219.33', '2019-02-20', 9, '1550624770', '2019-02-20 06:29:08', 'Mozilla Firefox', 'Windows'),
(29, '36.80.219.33', '2019-02-20', 1, '1550624473', '2019-02-20 06:31:13', 'Google Chrome', 'Windows'),
(30, '180.246.174.108', '2019-02-20', 10, '1550642266', '2019-02-20 07:45:23', 'Google Chrome', 'Windows'),
(31, '180.246.174.108', '2019-02-20', 1, '1550631857', '2019-02-20 08:34:17', '', ''),
(32, '182.0.133.34', '2019-02-20', 2, '1550647385', '2019-02-20 12:52:47', 'Google Chrome', 'Windows'),
(33, '182.0.135.203', '2019-02-20', 1, '1550647469', '2019-02-20 12:54:29', 'Google Chrome', 'Windows'),
(34, '182.0.166.234', '2019-02-20', 1, '1550647481', '2019-02-20 12:54:41', 'Google Chrome', 'Windows'),
(35, '182.0.132.46', '2019-02-20', 1, '1550647578', '2019-02-20 12:56:18', 'Google Chrome', 'Windows'),
(36, '182.0.132.185', '2019-02-20', 2, '1550647635', '2019-02-20 12:56:34', 'Google Chrome', 'Windows'),
(37, '182.0.166.34', '2019-02-20', 3, '1550647648', '2019-02-20 12:56:51', 'Google Chrome', 'Windows'),
(38, '182.0.165.15', '2019-02-20', 1, '1550647678', '2019-02-20 12:57:58', 'Google Chrome', 'Windows'),
(39, '182.0.164.202', '2019-02-20', 1, '1550647719', '2019-02-20 12:58:39', 'Google Chrome', 'Windows'),
(40, '182.0.135.3', '2019-02-20', 1, '1550647731', '2019-02-20 12:58:51', 'Google Chrome', 'Windows'),
(41, '182.0.133.179', '2019-02-20', 1, '1550648006', '2019-02-20 13:03:26', 'Google Chrome', 'Windows'),
(42, '120.188.65.2', '2019-02-20', 1, '1550672356', '2019-02-20 19:49:16', 'Google Chrome', 'Windows'),
(43, '36.80.239.41', '2019-02-22', 1, '1550807026', '2019-02-22 09:13:46', 'Google Chrome', 'Windows'),
(44, '120.188.65.227', '2019-02-24', 1, '1550985484', '2019-02-24 10:48:04', 'Google Chrome', 'Windows'),
(45, '180.246.147.253', '2019-03-13', 31, '1552461577', '2019-03-13 10:09:16', 'Google Chrome', 'Windows'),
(46, '180.246.147.253', '2019-03-13', 1, '1552451979', '2019-03-13 10:09:39', '', ''),
(47, '182.0.196.18', '2019-03-13', 2, '1552452896', '2019-03-13 10:24:25', 'Google Chrome', 'Linux'),
(48, '182.0.199.59', '2019-03-13', 1, '1552452911', '2019-03-13 10:25:11', 'Google Chrome', 'Linux'),
(49, '182.0.196.182', '2019-03-13', 2, '1552452924', '2019-03-13 10:25:18', 'Google Chrome', 'Linux'),
(50, '36.81.49.19', '2019-03-13', 1, '1552461716', '2019-03-13 12:51:56', 'Google Chrome', 'Windows'),
(51, '180.245.208.188', '2019-03-15', 11, '1552640998', '2019-03-15 16:03:52', 'Google Chrome', 'Windows'),
(52, '180.246.219.7', '2019-03-16', 18, '1552703025', '2019-03-16 09:17:30', 'Google Chrome', 'Windows'),
(53, '180.246.147.110', '2019-03-16', 11, '1552719449', '2019-03-16 09:29:48', 'Google Chrome', 'Windows'),
(54, '66.102.6.103', '2019-03-16', 1, '1552711071', '2019-03-16 11:37:51', 'Google Chrome', 'Linux'),
(55, '120.188.93.47', '2019-03-17', 9, '1552758293', '2019-03-17 00:31:19', 'Google Chrome', 'Windows'),
(56, '36.78.32.169', '2019-03-20', 76, '1553076595', '2019-03-20 15:28:08', 'Google Chrome', 'Windows'),
(57, '36.78.32.169', '2019-03-21', 77, '1553160856', '2019-03-21 09:34:03', 'Google Chrome', 'Windows'),
(58, '36.78.32.169', '2019-03-21', 2, '1553160703', '2019-03-21 09:53:24', '', ''),
(59, '66.102.6.91', '2019-03-21', 1, '1553140294', '2019-03-21 10:51:34', 'Google Chrome', 'Linux'),
(60, '118.96.165.199', '2019-03-23', 8, '1553322838', '2019-03-23 13:30:14', 'Google Chrome', 'Linux'),
(61, '120.188.39.124', '2019-03-31', 8, '1554047631', '2019-03-31 22:47:35', 'Google Chrome', 'Windows'),
(62, '120.188.39.124', '2019-03-31', 1, '1554047297', '2019-03-31 22:48:17', '', ''),
(63, '64.233.173.43', '2019-03-31', 6, '1554048127', '2019-03-31 22:48:55', 'Google Chrome', 'Linux'),
(64, '64.233.173.45', '2019-03-31', 9, '1554048135', '2019-03-31 22:50:58', 'Google Chrome', 'Linux'),
(65, '64.233.173.47', '2019-03-31', 7, '1554049720', '2019-03-31 23:00:00', 'Google Chrome', 'Linux'),
(66, '180.248.6.142', '2019-03-31', 1, '1554048011', '2019-03-31 23:00:11', 'Google Chrome', 'Linux'),
(67, '64.233.173.47', '2019-04-01', 1, '1554079560', '2019-04-01 07:46:00', 'Google Chrome', 'Linux'),
(68, '64.233.173.47', '2019-04-12', 4, '1555002218', '2019-04-12 00:02:56', 'Google Chrome', 'Linux'),
(69, '64.233.173.43', '2019-04-12', 2, '1555002197', '2019-04-12 00:03:04', 'Google Chrome', 'Linux'),
(70, '64.233.173.45', '2019-04-12', 1, '1555002228', '2019-04-12 00:03:48', 'Google Chrome', 'Linux'),
(71, '180.254.99.55', '2019-04-15', 5, '1555320684', '2019-04-15 16:05:11', 'Google Chrome', 'Windows'),
(72, '180.254.56.52', '2019-05-04', 1, '1556948129', '2019-05-04 12:35:29', 'Google Chrome', 'Windows'),
(73, '36.73.82.254', '2019-05-18', 3, '1558154430', '2019-05-18 11:39:23', 'Google Chrome', 'Windows'),
(74, '36.73.82.254', '2019-05-18', 1, '1558154386', '2019-05-18 11:39:46', '', ''),
(75, '::1', '2020-04-20', 1, '1587377114', '2020-04-20 17:05:14', 'Google Chrome', 'Windows');

-- --------------------------------------------------------

--
-- Table structure for table `z`
--

CREATE TABLE `z` (
  `id` int(5) NOT NULL,
  `z` text NOT NULL,
  `d` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `z`
--

INSERT INTO `z` (`id`, `z`, `d`) VALUES
(1, '', '2017-11-14 19:41:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD KEY `id_pembelian` (`id_pembelian`,`kode_obat`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD KEY `id_penjualan` (`id_penjualan`),
  ADD KEY `kode_obat` (`kode_obat`);

--
-- Indexes for table `distributor`
--
ALTER TABLE `distributor`
  ADD PRIMARY KEY (`id_distributor`),
  ADD UNIQUE KEY `judul` (`kode_distributor`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id_module`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`),
  ADD UNIQUE KEY `kode_obat` (`kode_obat`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id_page`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `statistik`
--
ALTER TABLE `statistik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `z`
--
ALTER TABLE `z`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `distributor`
--
ALTER TABLE `distributor`
  MODIFY `id_distributor` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id_module` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id_page` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `statistik`
--
ALTER TABLE `statistik`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `z`
--
ALTER TABLE `z`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
