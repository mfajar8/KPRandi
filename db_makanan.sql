-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2020 at 09:14 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_makanan`
--

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id_item` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_makanan` int(11) NOT NULL,
  `nama_makanan` varchar(150) NOT NULL,
  `harga` double NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `tipe` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_makanan`, `nama_makanan`, `harga`, `gambar`, `tipe`) VALUES
(1, 'Mie Goreng Solop', 8000, 'mie_goreng_solop', 'makanan'),
(2, 'Mie Rebus Solop', 8000, 'mie_rebus_solop', 'makanan'),
(3, 'Mie Goreng Rulet', 10000, 'mie_goreng_rulet', 'makanan'),
(4, 'Mie Rebus Rulet', 10000, 'mie_rebus_rulet', 'makanan'),
(5, 'Mie Goreng Tante', 12000, 'mie_goreng_tante', 'makanan'),
(6, 'Mie Rebus Tante', 12000, 'mie_rebus_tante', 'makanan'),
(7, 'Mie Goreng Telur', 15000, 'mie_goreng_telur', 'makanan'),
(8, 'Mie Rebus Telur', 15000, 'mie_rebus_telur', 'makanan'),
(9, 'French Fries', 12000, 'french_fries', 'makanan'),
(10, 'Mac & Cheese', 17000, 'Mac&cheese', 'makanan'),
(11, 'Fettucine', 17000, 'fettucine', 'makanan'),
(12, 'Tomyum Soup', 18000, 'tomyum_soup', 'makanan'),
(13, 'Nasgor Telur', 17000, 'nasgor_telur', 'makanan'),
(14, 'Nasgor Ayam Telur', 20000, 'nasgor_ayam_telur', 'makanan'),
(15, 'Nasgor Spesial', 25000, 'nasgor_spesial', 'makanan'),
(16, 'Nasi Ayam Serundeng', 25000, 'nasi_ayam_surendeng', 'makanan'),
(17, 'Nasi Bento Ayam', 25000, 'nasi_bento_ayam', 'makanan'),
(18, 'Telur Dadar', 5000, 'telur_dadar', 'makanan'),
(19, 'Sosis', 15000, 'sosis_gambar', 'makanan'),
(20, 'Es Kopaja', 20000, 'es_kopaja', 'minuman'),
(21, 'Es Kopi Klasik', 20000, 'es_kopi_klasik', 'minuman'),
(22, 'Es Kopaja Kebut', 22000, 'es_kopaja_kebut', 'minuman'),
(23, 'Es Kober', 23000, 'es_kober', 'minuman'),
(24, 'Es Susu Belanda', 20000, 'es_susu_belanda', 'minuman'),
(25, 'Es Susu Nigeria', 20000, 'es_susu_nigeria', 'minuman'),
(26, 'Classic Coklat', 20000, 'classic_coklat', 'minuman'),
(27, 'Es Cokmel', 20000, 'es_cokmel', 'minuman'),
(28, 'Choco Praline', 20000, 'choco_praline', 'minuman'),
(29, 'Matcha', 20000, 'matcha_gambar', 'minuman'),
(30, 'Es Djantjoek', 23000, 'es_djantoek', 'minuman'),
(31, 'Vietnam Drip', 20000, 'vietnam_drip', 'minuman'),
(32, 'V60', 20000, 'v60_gambar', 'minuman'),
(33, 'Japanese', 25000, 'japanese_gambar', 'minuman'),
(34, 'Americano', 20000, 'americano_gambar', 'minuman'),
(35, 'Long Black', 20000, 'long_black', 'minuman');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `nama_pemesan` varchar(50) NOT NULL,
  `tanggal_pesan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id_item`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_makanan`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_makanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
