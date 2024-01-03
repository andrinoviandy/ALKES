-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jul 2018 pada 11.27
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kharisma`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_teknisi`
--

CREATE TABLE `tb_teknisi` (
  `id` int(11) NOT NULL,
  `nama_teknisi` varchar(100) NOT NULL,
  `bidang` varchar(50) NOT NULL,
  `no_str` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `ijazah` varchar(100) NOT NULL,
  `sertifikat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_teknisi`
--

INSERT INTO `tb_teknisi` (`id`, `nama_teknisi`, `bidang`, `no_str`, `no_hp`, `username`, `password`, `ijazah`, `sertifikat`) VALUES
(18, 'Rahmat Hidayat', 'Teknisi', '2813511161160403', '082312952471', 'Dayat', 'bf7def6df5697beab36fbd94fa48e9ed', 'teknisi 1-', 'teknisi 1-'),
(19, 'Alip Pembayu', 'Teknisi', '1213511161151192', '081908154590', 'Bayu', 'f455c32d57203e66f4c07697d24bd0af', 'Teknisi 2-', 'Teknisi 2-'),
(20, 'Ahmad Subkhan', 'Teknisi', '1213511162002681', '085772880078', 'subkhan', '93657a147f7db64c31265d3c81d566d3', 'Ahmad Subkhan-Irdi (1).jpg', 'Ahmad Subkhan-'),
(21, 'Irdiyanto', 'Teknisi', '1213511162015118', '0812824817', 'Irdiyanto', 'b09dbb8485ac5f9f319fce11e67b38ea', 'Irdiyanto-', 'Irdiyanto-'),
(22, 'Muhamad Arfan Hidayat', 'Teknisi', '1213511120618446', '082112666619', 'Arfan', 'cff353406305f7bbe056e9aef4958291', 'Muhamad Arfan Hidayat-', 'Muhamad Arfan Hidayat-'),
(23, 'I Made Sosiawan', 'Teknisi', '1213511162018421', '08161118227', 'Made', 'c8137d193bac7523c32a3ff397df451d', 'I Made Sosiawan-', 'I Made Sosiawan-'),
(24, 'Marsito', 'Teknisi', '000000000000', '08129161456', 'Marsito', '052d8a43dad76382c6f2256080c3a7c7', 'Marsito-', 'Marsito-');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_teknisi`
--
ALTER TABLE `tb_teknisi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_teknisi`
--
ALTER TABLE `tb_teknisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
