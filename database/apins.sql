-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 12 Okt 2019 pada 20.35
-- Versi Server: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apins`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `ptk_id` varchar(36) DEFAULT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `gelar` varchar(30) NOT NULL,
  `jenis_kelamin` varchar(1) DEFAULT NULL,
  `tempat_lahir` varchar(20) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `niy_nigk` varchar(14) DEFAULT NULL,
  `nuptk` varchar(16) DEFAULT NULL,
  `status_kepegawaian_id` int(1) DEFAULT NULL,
  `jenis_ptk_id` int(2) DEFAULT NULL,
  `alamat_jalan` varchar(250) DEFAULT NULL,
  `no_hp` varchar(14) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status_keaktifan_id` int(1) DEFAULT NULL,
  `sekolah_id` varchar(50) NOT NULL,
  `avatar` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `operator`
--

CREATE TABLE `operator` (
  `user_id` varchar(36) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(36) NOT NULL,
  `sekolah_id` varchar(50) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `operator`
--

INSERT INTO `operator` (`user_id`, `username`, `password`, `sekolah_id`, `level`) VALUES
('46292751-4289-11e9-825b-c0cb38a9279a', 'farhan', 'myfarhan', 'AZXCR-43TE-VYTE5-8D3S', 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `user_id` varchar(36) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(36) NOT NULL,
  `sekolah_id` varchar(50) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sekolah`
--

CREATE TABLE `sekolah` (
  `id` int(11) NOT NULL,
  `sekolah_id` varchar(50) NOT NULL,
  `nama_sekolah` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `akreditasi` varchar(10) NOT NULL,
  `alamat` text NOT NULL,
  `logo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sekolah`
--

INSERT INTO `sekolah` (`id`, `sekolah_id`, `nama_sekolah`, `status`, `akreditasi`, `alamat`, `logo`) VALUES
(1, 'AZXCR-43TE-VYTE5-8D3S', 'SD Islam Al-Jannah', 2, 'A', 'Jl. Raya Gabuswetan No. 1 Desa Gabuswetan Kec. Gabuswetan Indramayu', 'logo.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `siswa_id` varchar(36) NOT NULL DEFAULT '',
  `sekolah_id` varchar(50) NOT NULL,
  `nis` varchar(9) NOT NULL,
  `nisn` varchar(10) DEFAULT NULL,
  `nama` varchar(41) DEFAULT NULL,
  `jk` varchar(1) DEFAULT NULL,
  `tempat` varchar(10) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `agama` int(11) NOT NULL,
  `pend_sebelum` varchar(100) NOT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `nama_ayah` varchar(22) DEFAULT NULL,
  `nama_ibu` varchar(23) DEFAULT NULL,
  `pek_ayah` int(11) NOT NULL,
  `pek_ibu` int(11) NOT NULL,
  `jalan` varchar(100) NOT NULL,
  `kelurahan` varchar(50) NOT NULL,
  `kecamatan` int(11) NOT NULL,
  `kabupaten` int(11) NOT NULL,
  `provinsi` int(11) NOT NULL,
  `avatar` varchar(200) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ptk_id` (`ptk_id`);

--
-- Indexes for table `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `peserta_didik_id` (`siswa_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
