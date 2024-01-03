-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 07, 2018 at 10:03 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bagisamp_alkes`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'cipta', '8d54d98edb4b4ebdb4a2cc0cffe6eb1f');

-- --------------------------------------------------------

--
-- Table structure for table `aksesoris`
--

CREATE TABLE `aksesoris` (
  `id` int(11) NOT NULL,
  `nama_akse` varchar(100) NOT NULL,
  `model_akse` varchar(50) NOT NULL,
  `tipe_akse` varchar(50) NOT NULL,
  `no_akse` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aksesoris`
--

INSERT INTO `aksesoris` (`id`, `nama_akse`, `model_akse`, `tipe_akse`, `no_akse`) VALUES
(1, 'akse1', 'akse', 'akse', 'akse');

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat_user` mediumtext NOT NULL,
  `provinsi_user` varchar(50) NOT NULL,
  `kota_user` varchar(50) NOT NULL,
  `telp_user` varchar(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `nama`, `alamat_user`, `provinsi_user`, `kota_user`, `telp_user`, `username`, `password`) VALUES
(4, 'USER', 'ALA', 'KALBAR', 'PONTI', '088', 'USER', '2e40ad879e955201df4dedbf8d479a12'),
(5, 'rs kartika husada', 'jl', 'jakarta', 'kota2', '0987', 'kartika', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `alat_pelatihan`
--

CREATE TABLE `alat_pelatihan` (
  `id` int(11) NOT NULL,
  `id_uji` int(11) NOT NULL,
  `peserta` varchar(100) NOT NULL,
  `pelatih` varchar(50) NOT NULL,
  `tgl_pelatihan` date NOT NULL,
  `pelatihan_oleh` varchar(100) NOT NULL,
  `lamp1` varchar(200) NOT NULL,
  `lamp2` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alat_pelatihan`
--

INSERT INTO `alat_pelatihan` (`id`, `id_uji`, `peserta`, `pelatih`, `tgl_pelatihan`, `pelatihan_oleh`, `lamp1`, `lamp2`) VALUES
(5, 6, 'perawat', 'Andi', '2018-05-03', 'Andi', '13177082_915658311866312_1323707527793832724_n.jpg', ''),
(6, 7, '10', 'Anton', '2018-05-03', 'Anton', '7.jpg', '7cc26378c55bf6c1d46dd230a7c83f3b.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `alat_uji`
--

CREATE TABLE `alat_uji` (
  `id` int(11) NOT NULL,
  `id_master_brg` int(11) NOT NULL,
  `aksesoris` varchar(100) NOT NULL,
  `model_akse` varchar(50) NOT NULL,
  `tipe_akse` varchar(50) NOT NULL,
  `no_akse` varchar(50) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `soft_version` varchar(50) NOT NULL,
  `tgl_garansi_habis` date NOT NULL,
  `pemakai` varchar(100) NOT NULL,
  `tgl_f` date NOT NULL,
  `lampiran_f` varchar(200) NOT NULL,
  `tgl_i` date NOT NULL,
  `lampiran_i` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alat_uji`
--

INSERT INTO `alat_uji` (`id`, `id_master_brg`, `aksesoris`, `model_akse`, `tipe_akse`, `no_akse`, `keterangan`, `soft_version`, `tgl_garansi_habis`, `pemakai`, `tgl_f`, `lampiran_f`, `tgl_i`, `lampiran_i`) VALUES
(6, 17, '-', 'mi67', '9877', '45678', '-', '2322', '2018-05-26', 'Contoh1', '2018-05-03', '7cc26378c55bf6c1d46dd230a7c83f3b.jpg', '2018-05-04', '13173931_913549405410536_991705650835195700_n.jpg'),
(7, 18, 'a,b,c,d,', 'mode', 'tpye', '09877', 'kalau ada', '98766', '2018-05-31', 'RS', '2018-05-02', '2018-03-10-PHOTO-00000044.jpg', '2018-05-03', '11.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `merk` varchar(500) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `no_seri` varchar(200) NOT NULL,
  `kepemilikan` varchar(100) NOT NULL,
  `deskripsi` mediumtext NOT NULL,
  `status_lapor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `id_akun`, `nama_barang`, `merk`, `tipe`, `no_seri`, `kepemilikan`, `deskripsi`, `status_lapor`) VALUES
(4, 4, 'TS', 'ABC', 'DEF', '098', 'UMUM', '-', 0),
(5, 4, 'ronsen', 'merk12', 'typecon', '088', 'Rumah Saakit Umm', 'uteteetdesk', 1),
(6, 5, 'mri', 'merk3', 'tipe4', '789', 'RS', '----', 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_barang`
--

CREATE TABLE `master_barang` (
  `id` int(11) NOT NULL,
  `id_teknisi` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `nama_brg` varchar(50) NOT NULL,
  `tipe_brg` varchar(50) NOT NULL,
  `merk_brg` varchar(100) NOT NULL,
  `no_seri_brg` varchar(100) NOT NULL,
  `nie_brg` varchar(50) NOT NULL,
  `pembeli` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kontak` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ket_lain` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_barang`
--

INSERT INTO `master_barang` (`id`, `id_teknisi`, `tgl_masuk`, `nama_brg`, `tipe_brg`, `merk_brg`, `no_seri_brg`, `nie_brg`, `pembeli`, `alamat`, `kontak`, `email`, `ket_lain`) VALUES
(17, 17, '2018-05-03', 'tes1', 'TYPE1', 'MERK1', '0000009', '7899', 'rumahs sakita', 'jl', '098', 'aa@gmail.com', '-nkotanka'),
(18, 19, '2018-05-01', 'Mri', 'type', 'cont', '97777', '987666', 'RS Kartika Husada', 'Jl..', '009', 'aa@gmail.com', '-');

-- --------------------------------------------------------

--
-- Table structure for table `pemusnahan`
--

CREATE TABLE `pemusnahan` (
  `id` int(11) NOT NULL,
  `tgl_pemusnahan` date NOT NULL,
  `disetujui_oleh` varchar(50) NOT NULL,
  `disiapkan_oleh` varchar(50) NOT NULL,
  `diperiksa_oleh` varchar(50) NOT NULL,
  `nama_item` varchar(100) NOT NULL,
  `jumlah_unit` int(11) NOT NULL,
  `uraian` mediumtext NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `penanggung_jawab` varchar(50) NOT NULL,
  `jam_mulai` varchar(20) NOT NULL,
  `jam_selesai` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemusnahan`
--

INSERT INTO `pemusnahan` (`id`, `tgl_pemusnahan`, `disetujui_oleh`, `disiapkan_oleh`, `diperiksa_oleh`, `nama_item`, `jumlah_unit`, `uraian`, `lokasi`, `penanggung_jawab`, `jam_mulai`, `jam_selesai`) VALUES
(4, '2018-03-29', '3', '3', '3', 'Alkes 2', 3, '3', '3', '3', '3', '3'),
(5, '2018-03-31', '4', '4', '4', 'Item4', 4, '4', '4', '4', '4', '4');

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `id` int(11) NOT NULL,
  `id_spk` int(11) NOT NULL,
  `tgl_progress` date NOT NULL,
  `deskripsi_kerusakan` mediumtext NOT NULL,
  `deskripsi_perbaikan` mediumtext NOT NULL,
  `lampiran` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`id`, `id_spk`, `tgl_progress`, `deskripsi_kerusakan`, `deskripsi_perbaikan`, `lampiran`) VALUES
(3, 4, '2018-03-28', '1', '2', 'doctor-1650291_960_720.png'),
(4, 10, '2018-05-03', 'tagggggg', 'perbhhhh', '1_year_warranty_logo2.jpg'),
(5, 11, '2018-05-03', 'cont 2', 'cont45', '0003UPEBD1F70A08862492original.jpg'),
(6, 11, '2018-05-03', 'tes', 'tws', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_laporan_kerusakan`
--

CREATE TABLE `tb_laporan_kerusakan` (
  `id` int(11) NOT NULL,
  `tgl_lapor` date NOT NULL,
  `id_barang` int(11) NOT NULL,
  `status_garansi` varchar(100) NOT NULL,
  `kerusakan` varchar(200) NOT NULL,
  `lokasi` varchar(200) NOT NULL,
  `kontak` varchar(50) NOT NULL,
  `exp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_laporan_kerusakan`
--

INSERT INTO `tb_laporan_kerusakan` (`id`, `tgl_lapor`, `id_barang`, `status_garansi`, `kerusakan`, `lokasi`, `kontak`, `exp`) VALUES
(7, '2018-05-01', 4, 'GAR', '-', 'PON', '09', 1),
(8, '2018-05-03', 5, 'garansi expired', 'konslet', 'Jakarta TImur Jl;[[', '09888', 1),
(9, '2018-05-03', 6, 'garansi expired', 'deskripsi cont', 'jakarta', '098767', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_spk`
--

CREATE TABLE `tb_spk` (
  `id` int(11) NOT NULL,
  `tgl_spk` date NOT NULL,
  `id_teknisi` int(11) NOT NULL,
  `id_lapor` int(11) NOT NULL,
  `status_proses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_spk`
--

INSERT INTO `tb_spk` (`id`, `tgl_spk`, `id_teknisi`, `id_lapor`, `status_proses`) VALUES
(9, '2018-05-02', 17, 7, 0),
(10, '2018-05-03', 18, 8, 2),
(11, '2018-05-03', 19, 9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_teknisi`
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
-- Dumping data for table `tb_teknisi`
--

INSERT INTO `tb_teknisi` (`id`, `nama_teknisi`, `bidang`, `no_str`, `no_hp`, `username`, `password`, `ijazah`, `sertifikat`) VALUES
(17, 'Andi', 'TEKNIS', '001', '09877', 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'Andi-', 'Andi-'),
(18, 'JOni', 'bisanQ', 's8909', '0988', 'joni', 'e10adc3949ba59abbe56e057f20f883e', 'JOni-', 'JOni-'),
(19, 'Anton', 'Lab', '08777', '085644', 'anton', '827ccb0eea8a706c4c34a16891f84e7b', 'Anton-', 'Anton-');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aksesoris`
--
ALTER TABLE `aksesoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alat_pelatihan`
--
ALTER TABLE `alat_pelatihan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelatihan_alat_ibfk_1` (`id_uji`);

--
-- Indexes for table `alat_uji`
--
ALTER TABLE `alat_uji`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_master_brg` (`id_master_brg`),
  ADD KEY `id_aksesoris` (`aksesoris`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_akun` (`id_akun`);

--
-- Indexes for table `master_barang`
--
ALTER TABLE `master_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemusnahan`
--
ALTER TABLE `pemusnahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_laporan_kerusakan`
--
ALTER TABLE `tb_laporan_kerusakan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `tb_spk`
--
ALTER TABLE `tb_spk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_lapor` (`id_lapor`),
  ADD KEY `id_teknisi` (`id_teknisi`);

--
-- Indexes for table `tb_teknisi`
--
ALTER TABLE `tb_teknisi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `aksesoris`
--
ALTER TABLE `aksesoris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `alat_pelatihan`
--
ALTER TABLE `alat_pelatihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `alat_uji`
--
ALTER TABLE `alat_uji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `master_barang`
--
ALTER TABLE `master_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pemusnahan`
--
ALTER TABLE `pemusnahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_laporan_kerusakan`
--
ALTER TABLE `tb_laporan_kerusakan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_spk`
--
ALTER TABLE `tb_spk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_teknisi`
--
ALTER TABLE `tb_teknisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alat_pelatihan`
--
ALTER TABLE `alat_pelatihan`
  ADD CONSTRAINT `alat_pelatihan_ibfk_1` FOREIGN KEY (`id_uji`) REFERENCES `alat_uji` (`id`);

--
-- Constraints for table `alat_uji`
--
ALTER TABLE `alat_uji`
  ADD CONSTRAINT `alat_uji_ibfk_1` FOREIGN KEY (`id_master_brg`) REFERENCES `master_barang` (`id`);

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id`);

--
-- Constraints for table `tb_laporan_kerusakan`
--
ALTER TABLE `tb_laporan_kerusakan`
  ADD CONSTRAINT `tb_laporan_kerusakan_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`);

--
-- Constraints for table `tb_spk`
--
ALTER TABLE `tb_spk`
  ADD CONSTRAINT `tb_spk_ibfk_1` FOREIGN KEY (`id_lapor`) REFERENCES `tb_laporan_kerusakan` (`id`),
  ADD CONSTRAINT `tb_spk_ibfk_2` FOREIGN KEY (`id_teknisi`) REFERENCES `tb_teknisi` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
