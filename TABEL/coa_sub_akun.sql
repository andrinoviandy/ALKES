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
-- Table structure for table `coa_sub_akun`
--

CREATE TABLE `coa_sub_akun` (
  `id` int(11) NOT NULL,
  `coa_sub_id` int(11) NOT NULL,
  `nama_akun` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coa_sub_akun`
--

INSERT INTO `coa_sub_akun` (`id`, `coa_sub_id`, `nama_akun`) VALUES
(8, 19, 'Penjualan Alat Kesehatan'),
(9, 19, 'Penjualan Reagen'),
(11, 21, 'Beban Pokok Penjualan Alat Kesehatan'),
(12, 21, 'Beban Pokok Penjualan Reagen'),
(13, 22, 'Beban Gaji dan Upah'),
(14, 23, 'BPD - M. Teguh Rahardjo'),
(15, 23, 'BPD - Yan Herman'),
(16, 23, 'BPD - Triyasno'),
(17, 23, 'BPD - Setyobudi'),
(18, 23, 'BPD - Made Sumarta'),
(19, 23, 'Beban Iklan Dan Promosi'),
(20, 1, 'Persediaan Alat Kesehatan'),
(21, 1, 'Persediaan Reagen'),
(22, 2, 'Piutang Dagang'),
(23, 2, 'Piutang Lain-Lain'),
(24, 2, 'Penyisihan Piutang Tak Tertagih'),
(25, 3, 'Uang Muka Pembelian-Barang Dagangan'),
(26, 3, 'Uang Muka Pembelian-Aktiva Tetap'),
(27, 3, 'Uang Muka Sewa Tempat'),
(28, 4, 'PPN Masukan (Pembelian)'),
(29, 4, 'PPh 21'),
(30, 4, 'PPh 23'),
(31, 4, 'PPh Final Ps 4 Ayat 2'),
(32, 4, 'PPh 25'),
(33, 5, 'Sewa Gudang'),
(34, 5, 'Asuransi Dibayar Dimuka'),
(35, 6, 'Tanah'),
(36, 6, 'Bangunan'),
(37, 6, 'Kendaraan '),
(38, 6, 'Peralatan'),
(39, 7, 'Akumulasi Penyusutan Tanah'),
(40, 7, 'Akumulasi Penyusutan Bangunan'),
(41, 7, 'Akumulasi Penyusutan Kendaraan '),
(42, 7, 'Akumulasi Penyusutan Peralatan'),
(43, 8, 'Piutang Kepada Pihak Istimewa'),
(44, 8, 'Uang Jaminan'),
(45, 9, 'Hutang Dagang'),
(46, 9, 'Hutang Lain-Lain'),
(47, 10, 'Uang Muka Pelanggan-Penjualan'),
(48, 11, 'PPN Keluaran-Penjualan'),
(49, 11, 'PPnBM'),
(50, 11, 'PPh 21'),
(51, 11, 'PPh 22'),
(52, 11, 'PPh 23'),
(53, 11, 'PPh Final Ps 4 Ayat 2'),
(54, 11, 'PPh 25'),
(55, 11, 'PPh 29'),
(56, 11, 'PBB '),
(57, 12, 'Biaya YMH Dibayar- Bunga Pinjaman'),
(58, 12, 'Biaya YMH Dibayar- Denda Pinjaman'),
(59, 12, 'Biaya YMH Dibayar- Telepon'),
(60, 12, 'Biaya YMH Dibayar- Listrik'),
(61, 12, 'Biaya YMH Dibayar- Sewa'),
(62, 12, 'Biaya YMH Dibayar- Gaji dan Upah'),
(63, 13, 'Hutang Bank'),
(64, 13, 'Hutang Pihak Ketiga'),
(65, 13, 'Hutang Lembaga Kredit'),
(66, 15, 'Modal Disetor'),
(67, 15, 'Tambahan Modal Disetor'),
(68, 16, 'Saldo Laba Tahun Lalu'),
(69, 16, 'Koreksi Saldo Laba'),
(70, 16, 'Saldo Laba Tahun Berjalan'),
(71, 24, 'BPSM - M. Teguh Rahardjo'),
(72, 24, 'BPSM - Yan Herman'),
(73, 24, 'BPSM - Triyasno'),
(74, 24, 'BPSM - Setyobudi'),
(75, 24, 'BPSM - Made Sumarta'),
(76, 25, 'BP - M. Teguh Rahardjo'),
(77, 25, 'BP - Yan Herman'),
(78, 25, 'BP - Triyasno'),
(79, 25, 'BP - Setyobudi'),
(80, 25, 'BP - Made Sumarta'),
(81, 26, 'BP - M. Teguh Rahardjo'),
(82, 26, 'BP - Yan Herman'),
(83, 26, 'BP - Triyasno'),
(84, 26, 'BP - Setyobudi'),
(85, 26, 'BP - Made Sumarta'),
(86, 26, 'Beban Telepon'),
(87, 26, 'Beban Listrik'),
(88, 26, 'Beban Asuransi'),
(89, 27, 'Beban Penyusutan Bangunan'),
(90, 27, 'Beban Penyusutan Kendaraan'),
(91, 27, 'Beban Penyusutan Peralatan'),
(92, 28, 'Beban Gaji dan Upah'),
(93, 28, 'Beban Perjalanan Dinas'),
(94, 28, 'Beban Iklan Dan Promosi'),
(95, 28, 'Beban Perlengkapan'),
(96, 28, 'Beban Ekspedisi'),
(97, 28, 'Beban Non Ekspedisi'),
(98, 28, 'Beban Perjamuan'),
(99, 28, 'Beban Sewa'),
(100, 28, 'Beban Telepon'),
(101, 28, 'Beban Listrik'),
(102, 28, 'Beban Asuransi'),
(103, 28, 'Beban Pemeliharaan dan Perbaikan'),
(104, 28, 'Beban Administrasi dan Umum Lainnya'),
(105, 29, 'Beban Pajak Jasa Giro'),
(106, 29, 'Beban Administrasi Jasa Giro'),
(107, 29, 'Rugi Penjualan Aktiva Tetap'),
(108, 29, 'Rugi Selisih Kurs'),
(109, 29, 'Beban Lainnya'),
(110, 30, 'Penghasilan Deviden'),
(111, 30, 'Penghasilan Bunga Jasa Giro'),
(112, 30, 'Laba Penjualan Aktiva Tetap'),
(113, 30, 'Penghasilan Sewa'),
(114, 30, 'Laba Selisih Kurs'),
(115, 30, 'Penghasilan Lainnya');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coa_sub_akun`
--
ALTER TABLE `coa_sub_akun`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coa_sub_akun`
--
ALTER TABLE `coa_sub_akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
