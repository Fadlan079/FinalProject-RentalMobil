-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 30, 2025 at 06:58 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fp_rentalmobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `id_mobil` int NOT NULL,
  `tahun` year NOT NULL,
  `warna` varchar(255) NOT NULL,
  `noplat` varchar(255) NOT NULL,
  `nomesin` varchar(255) NOT NULL,
  `norangka` varchar(255) NOT NULL,
  `status` enum('ready','rent','maintenance') DEFAULT NULL,
  `id_tipe` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`id_mobil`, `tahun`, `warna`, `noplat`, `nomesin`, `norangka`, `status`, `id_tipe`) VALUES
(3, '2008', 'merah', '2928', '8991', '1239', 'ready', 1),
(7, '2008', 'merah', '2123', '1233', '1203', 'rent', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `tmpt_lhr` varchar(255) NOT NULL,
  `tgl_lhr` date DEFAULT NULL,
  `alamat` varchar(255) NOT NULL,
  `kel` varchar(255) NOT NULL,
  `kec` varchar(255) NOT NULL,
  `kab` varchar(255) NOT NULL,
  `KP` varchar(5) NOT NULL,
  `telp` varchar(30) NOT NULL,
  `bio` text NOT NULL,
  `pp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `id_user`, `nama`, `tmpt_lhr`, `tgl_lhr`, `alamat`, `kel`, `kec`, `kab`, `KP`, `telp`, `bio`, `pp`) VALUES
(1, 2, 'Test1', 'Samarinda', '2008-09-11', 'Jl Tanah Hitam', 'Gunung kelua', 'Samarinda Ulu', 'Samarinda', '12346', '0822100732927', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `kelurahan` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `kabkota` varchar(255) NOT NULL,
  `kp` varchar(5) NOT NULL,
  `telp` varchar(255) NOT NULL,
  `bio` text NOT NULL,
  `pp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `id_user`, `nama`, `nik`, `alamat`, `kelurahan`, `kecamatan`, `kabkota`, `kp`, `telp`, `bio`, `pp`) VALUES
(3, 1, 'Fadlan', '1234', 'Jl Aw Syahrani', 'Gunung kelua', 'Samarinda Ulu', 'Samarinda', '12345', '0822100732928', 'testing', 'testing.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rental`
--

CREATE TABLE `rental` (
  `id_rental` int NOT NULL,
  `tgl_rental` date NOT NULL,
  `ttltagihan` int NOT NULL,
  `id_pelanggan` int NOT NULL,
  `id_pegawai` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rentalmboil`
--

CREATE TABLE `rentalmboil` (
  `id_rental` int NOT NULL,
  `id_mobil` int NOT NULL,
  `tgl_klr` date NOT NULL,
  `jam_klr` time NOT NULL,
  `tgl_msk` date NOT NULL,
  `jam_msk` time NOT NULL,
  `status` enum('ready','rent','maintenance') DEFAULT NULL,
  `jmlh_byr` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tipemobil`
--

CREATE TABLE `tipemobil` (
  `id_tipe` int NOT NULL,
  `merk` varchar(255) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `silinder` int NOT NULL,
  `bhn_bkr` enum('pertamax','pertalite','solar','dexlite','pertaminadex') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tipemobil`
--

INSERT INTO `tipemobil` (`id_tipe`, `merk`, `tipe`, `model`, `jenis`, `silinder`, `bhn_bkr`) VALUES
(1, 'Test1', 'Testing1', 'Test1', 'Test', 4, 'solar'),
(9, 'test2', 'testing2', 'test2', 'testing', 2, 'pertamax');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `role` enum('pelanggan','pegawai') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'pelanggan',
  `tgl_dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `jk`, `role`, `tgl_dibuat`) VALUES
(1, 'fadlan@gmail.com', '$2y$12$OEUrePNEi3r2HsnBrCT7UONMUNbAMUfajUIn8Thhu3hY1802gWfK6', 'L', 'pelanggan', '2025-10-29 05:21:32'),
(2, 'test1@gmail.com', '$2y$12$kRUzzW9nZqwHuEaEDr6WCu7hLRDq8smn1/BcvhlVGrXG2P6wpd2m6', 'L', 'pelanggan', '2025-10-29 06:05:49'),
(4, 'Test2@gmail.com', '$2y$10$H.66mBQY0.LcmlGy7NyI3u.FOoaLEm4/CwTHmmuJZHTd9dNlVTFH2', 'L', 'pelanggan', '2025-10-29 11:25:21'),
(5, 'Test3@gmail.com', '$2y$10$VaDzCwwQtuEx3OmYBWcB4uIVhBS5ukb8CYqFg5NUYL78ooow6LUWW', 'P', 'pelanggan', '2025-10-29 11:28:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id_mobil`),
  ADD UNIQUE KEY `noplat` (`noplat`),
  ADD UNIQUE KEY `nomesin` (`nomesin`),
  ADD UNIQUE KEY `norangka` (`norangka`),
  ADD KEY `id_tipe` (`id_tipe`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD UNIQUE KEY `uq_pegawai_user` (`id_user`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD UNIQUE KEY `uq_pelanggan_user` (`id_user`);

--
-- Indexes for table `rental`
--
ALTER TABLE `rental`
  ADD PRIMARY KEY (`id_rental`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `rentalmboil`
--
ALTER TABLE `rentalmboil`
  ADD KEY `id_rental` (`id_rental`),
  ADD KEY `id_mobil` (`id_mobil`);

--
-- Indexes for table `tipemobil`
--
ALTER TABLE `tipemobil`
  ADD PRIMARY KEY (`id_tipe`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mobil`
--
ALTER TABLE `mobil`
  MODIFY `id_mobil` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rental`
--
ALTER TABLE `rental`
  MODIFY `id_rental` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipemobil`
--
ALTER TABLE `tipemobil`
  MODIFY `id_tipe` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mobil`
--
ALTER TABLE `mobil`
  ADD CONSTRAINT `mobil_ibfk_1` FOREIGN KEY (`id_tipe`) REFERENCES `tipemobil` (`id_tipe`);

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `fk_pegawai_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `fk_pelanggan_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rental`
--
ALTER TABLE `rental`
  ADD CONSTRAINT `rental_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `rental_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`);

--
-- Constraints for table `rentalmboil`
--
ALTER TABLE `rentalmboil`
  ADD CONSTRAINT `rentalmboil_ibfk_1` FOREIGN KEY (`id_rental`) REFERENCES `rental` (`id_rental`),
  ADD CONSTRAINT `rentalmboil_ibfk_2` FOREIGN KEY (`id_mobil`) REFERENCES `mobil` (`id_mobil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
