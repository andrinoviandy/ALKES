-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2019 at 09:54 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kharisma_yang_dipakai`
--

-- --------------------------------------------------------

--
-- Table structure for table `coa_sub`
--

CREATE TABLE `coa_sub` (
  `id` int(11) NOT NULL,
  `coa_id` int(11) NOT NULL,
  `nama_sub_grup` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coa_sub`
--

INSERT INTO `coa_sub` (`id`, `coa_id`, `nama_sub_grup`) VALUES
(1, 1, 'Persediaan Barang Dagangan'),
(2, 1, 'Piutang Usaha'),
(3, 1, 'Uang Muka'),
(4, 1, 'Pajak Dibayar Dimuka'),
(5, 1, 'Biaya Dibayar Dimuka'),
(6, 1, 'Aktiva Tetap'),
(7, 1, 'Akumulasi Penyusutan Aktiva Tetap'),
(8, 1, 'Aktiva Lain-Lain'),
(9, 2, 'Hutang Usaha'),
(10, 2, 'Uang Muka Pelanggan'),
(11, 2, 'Hutang Pajak'),
(12, 2, 'Biaya Yang Masih Harus Dibayar'),
(13, 2, 'Hutang Jangka Panjang'),
(15, 3, 'Modal'),
(16, 3, 'Saldo Laba'),
(19, 4, 'Pendapatan Usaha'),
(21, 4, 'Beban Pokok Penjualan'),
(22, 5, 'Beban Pemasaran'),
(23, 5, 'Beban Perjalanan Dinas'),
(24, 5, 'Beban Pos, Surat, Materai'),
(25, 5, 'Beban Perjamuan'),
(26, 5, 'Beban Pengemasan'),
(27, 5, 'Beban Penyusutan'),
(28, 5, 'Beban Administrasi dan Umum'),
(29, 5, 'Beban Lain-Lain'),
(30, 5, 'Penghasilan Lain-Lain'),
(31, 3, 'Akun Tidak Terdefinisi'),
(32, 3, 'Laba Ditahan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coa_sub`
--
ALTER TABLE `coa_sub`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coa_id` (`coa_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coa_sub`
--
ALTER TABLE `coa_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
