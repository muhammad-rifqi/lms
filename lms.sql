-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2022 at 09:28 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `diskusi`
--

CREATE TABLE `diskusi` (
  `id_diskusi` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_update` datetime NOT NULL,
  `user_update` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diskusi`
--

INSERT INTO `diskusi` (`id_diskusi`, `file`, `keterangan`, `tanggal_update`, `user_update`) VALUES
(1, 'download.jpg', 'ini contoh keterangan untuk post postan diskusi', '2022-02-16 19:44:26', 'Guru Guru'),
(3, 'lm pattra pusat jakarta indonesia.jpg', 'Ini rifqi', '2022-02-16 20:39:15', 'Muhammad Rifqi');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nama_kelas` varchar(255) DEFAULT NULL,
  `guru` varchar(255) DEFAULT NULL,
  `materi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `guru`, `materi`) VALUES
(6, 'Kalkulus', 'Muhammad Rifqi', 'strukturorganisasi.docx'),
(7, 'Matematika', 'Guru Guru', 'mat.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id` int(11) NOT NULL,
  `id_diskusi` int(11) NOT NULL,
  `komentar` text DEFAULT NULL,
  `user_update` varchar(255) DEFAULT NULL,
  `tanggal_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `id_diskusi`, `komentar`, `user_update`, `tanggal_update`) VALUES
(1, 1, 'ini  response dari rifqi', 'Muhammad Rifqi', '2022-02-16 21:13:41'),
(2, 3, 'ini response rifqi', 'Muhammad Rifqi', '2022-02-16 21:32:19'),
(3, 1, 'oke baik', 'Muhammad Rifqi', '2022-02-16 21:38:31'),
(4, 3, 'ini bima', 'Bima Perdana', '2022-02-16 21:40:08'),
(5, 1, 'tes komentar', 'Bima Perdana', '2022-02-16 23:34:25');

-- --------------------------------------------------------

--
-- Table structure for table `siswa_kelas`
--

CREATE TABLE `siswa_kelas` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `berkas` varchar(255) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa_kelas`
--

INSERT INTO `siswa_kelas` (`id`, `id_user`, `id_kelas`, `full_name`, `berkas`, `nilai`) VALUES
(3, 3, 6, 'Bima Perdana', '72-238-1-pb.pdf', 60);

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id` int(11) NOT NULL,
  `nama_kelas` varchar(255) DEFAULT NULL,
  `berkas` varchar(255) DEFAULT NULL,
  `tanggal_update` datetime DEFAULT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id`, `nama_kelas`, `berkas`, `tanggal_update`, `id_kelas`) VALUES
(3, 'Kalkulus', 'sample.pdf', '2022-02-17 11:34:06', 6);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `access` enum('admin','guru','siswa') NOT NULL DEFAULT 'siswa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `full_name`, `access`) VALUES
(1, 'admin@localhost.com', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin'),
(2, 'guru@localhost.com', '77e69c137812518e359196bb2f5e9bb9', 'Guru Guru', 'guru'),
(3, 'bima@gmail.com', '7fcba392d4dcca33791a44cd892b2112', 'Bima Perdana', 'siswa'),
(4, 'rifqi@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Muhammad Rifqi', 'guru'),
(5, 'budi@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Budianto', 'siswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diskusi`
--
ALTER TABLE `diskusi`
  ADD PRIMARY KEY (`id_diskusi`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa_kelas`
--
ALTER TABLE `siswa_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diskusi`
--
ALTER TABLE `diskusi`
  MODIFY `id_diskusi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `siswa_kelas`
--
ALTER TABLE `siswa_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
