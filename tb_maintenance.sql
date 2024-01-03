-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Bulan Mei 2018 pada 07.59
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
-- Struktur dari tabel `tb_maintenance`
--

CREATE TABLE `tb_maintenance` (
  `id` int(11) NOT NULL,
  `tgl_maintenance` date NOT NULL,
  `teknisi_id` int(11) NOT NULL,
  `laporan_kerusakan_id` int(11) NOT NULL,
  `status_proses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_maintenance`
--

INSERT INTO `tb_maintenance` (`id`, `tgl_maintenance`, `teknisi_id`, `laporan_kerusakan_id`, `status_proses`) VALUES
(1, '2018-05-28', 16, 6, 0),
(2, '2018-05-28', 17, 8, 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_maintenance`
--
ALTER TABLE `tb_maintenance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_lapor` (`laporan_kerusakan_id`),
  ADD KEY `id_teknisi` (`teknisi_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_maintenance`
--
ALTER TABLE `tb_maintenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_maintenance`
--
ALTER TABLE `tb_maintenance`
  ADD CONSTRAINT `tb_maintenance_ibfk_1` FOREIGN KEY (`laporan_kerusakan_id`) REFERENCES `tb_laporan_kerusakan` (`id`),
  ADD CONSTRAINT `tb_maintenance_ibfk_2` FOREIGN KEY (`teknisi_id`) REFERENCES `tb_teknisi` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
