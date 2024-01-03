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
-- Struktur dari tabel `tb_laporan_kerusakan`
--

CREATE TABLE `tb_laporan_kerusakan` (
  `id` int(11) NOT NULL,
  `akun_customer_id` int(11) NOT NULL,
  `tgl_lapor` date NOT NULL,
  `barang_dikirim_id` int(11) NOT NULL,
  `status_garansi` varchar(100) NOT NULL,
  `kategori_job_id` int(11) NOT NULL,
  `problem` varchar(200) NOT NULL,
  `lokasi` varchar(200) NOT NULL,
  `exp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_laporan_kerusakan`
--

INSERT INTO `tb_laporan_kerusakan` (`id`, `akun_customer_id`, `tgl_lapor`, `barang_dikirim_id`, `status_garansi`, `kategori_job_id`, `problem`, `lokasi`, `exp`) VALUES
(6, 4, '2018-05-25', 3, 'Masih Garansi', 1, 'fsfdsgfdsg', 'RSUD Abdul  Aziz Singkawang', 1),
(8, 4, '2018-05-28', 3, 'Masih Garansi', 4, 'dsadsd', 'RSUD Abdul  Aziz Singkawang', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_laporan_kerusakan`
--
ALTER TABLE `tb_laporan_kerusakan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_barang` (`barang_dikirim_id`),
  ADD KEY `akun_customer_id` (`akun_customer_id`),
  ADD KEY `kategori_job_id` (`kategori_job_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_laporan_kerusakan`
--
ALTER TABLE `tb_laporan_kerusakan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_laporan_kerusakan`
--
ALTER TABLE `tb_laporan_kerusakan`
  ADD CONSTRAINT `tb_laporan_kerusakan_ibfk_1` FOREIGN KEY (`barang_dikirim_id`) REFERENCES `barang_dikirim` (`id`),
  ADD CONSTRAINT `tb_laporan_kerusakan_ibfk_2` FOREIGN KEY (`akun_customer_id`) REFERENCES `akun_customer` (`id`),
  ADD CONSTRAINT `tb_laporan_kerusakan_ibfk_3` FOREIGN KEY (`kategori_job_id`) REFERENCES `kategori_job` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
