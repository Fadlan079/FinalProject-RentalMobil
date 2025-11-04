-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 04, 2025 at 11:58 PM
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
  `img` varchar(255) NOT NULL,
  `tahun` year NOT NULL,
  `warna` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `noplat` varchar(255) NOT NULL,
  `nomesin` varchar(255) NOT NULL,
  `norangka` varchar(255) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_tipe` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`id_mobil`, `img`, `tahun`, `warna`, `noplat`, `nomesin`, `norangka`, `status`, `id_tipe`) VALUES
(38, 'koenigsegg-merah.jpg', '2024', 'Merah', 'B 1 KSG', 'KJ5000V8X001', 'RNGKJ5000X001', 'maintenance', 10),
(39, 'koenigsegg-biru.jpg', '2024', 'Biru', 'B 2 KSG', 'KJ5000V8X002', 'RNGKJ5000X002', 'maintenance', 10),
(40, 'ferrari-merah.jpg', '2023', 'Merah', 'B 3 FER', 'FE3990V8X003', 'RNGFE3990X003', 'maintenance', 11),
(41, 'ferrari-kuning.jpg', '2023', 'Kuning', 'B 4 FER', 'FE3990V8X004', 'RNGFE3990X004', 'rent', 11),
(42, 'porsche-hitam.jpg', '2023', 'Hitam', 'B 5 POR', 'PO3745V6X005', 'RNGPO3745X005', 'rent', 12),
(43, 'lamborghini-hijau.jpg', '2024', 'Hijau', 'B 6 LAM', 'LA6498V12X006', 'RNGLA6498X006', 'rent', 13),
(44, 'bugatti-biru.jpg', '2024', 'Biru', 'B 7 BUG', 'BU7993V16X007', 'RNGBU7993X007', 'rent', 14),
(45, 'mclaren-orange.jpg', '2023', 'Orange', 'B 8 MCL', 'MC3994V8X008', 'RNGMC3994X008', 'ready', 15),
(46, 'astonmartin-silver.jpg', '2024', 'Silver', 'B 9 AST', 'AM6500V12X009', 'RNGAM6500X009', 'ready', 16),
(47, 'pagani-hitam.jpg', '2024', 'Hitam', 'B 10 PAG', 'PA5980V12X010', 'RNGPA5980X010', 'ready', 17),
(48, 'mercedesbenz-putih.jpg', '2023', 'Putih', 'B 11 MER', 'MB1599V6X011', 'RNGMB1599X011', 'ready', 18),
(49, 'rimac-biru.jpg', '2024', 'Biru', 'B 12 RIM', 'RI0V8X012', 'RNGRI0X012', 'ready', 19),
(50, 'tesla-merah.jpg', '2024', 'Merah', 'B 13 TES', 'TS0EVX013', 'RNGTS0X013', 'ready', 20),
(51, 'lucid-putih.jpg', '2024', 'Putih', 'B 14 LUC', 'LU0EVX014', 'RNGLU0X014', 'ready', 21),
(52, 'lotus-hijau.jpg', '2024', 'Hijau', 'B 15 LOT', 'LO0EVX015', 'RNGLO0X015', 'ready', 22),
(53, 'bmw-biru.jpg', '2023', 'Biru', 'B 16 BMW', 'BM1500V6X016', 'RNGBM1500X016', 'ready', 23),
(54, 'pagani-abu.jpg', '2024', 'Abu', 'B 17 PAG', 'PA7500V12X017', 'RNGPA7500X017', 'ready', 24),
(55, 'koenigsegg-hitam.jpg', '2024', 'Hitam', 'B 18 KSG', 'KJ5000V8X018', 'RNGKJ5000X018', 'ready', 10),
(56, 'ferrari-putih.jpg', '2023', 'Putih', 'B 19 FER', 'FE3990V8X019', 'RNGFE3990X019', 'ready', 11),
(57, 'porsche-merah.jpg', '2023', 'Merah', 'B 20 POR', 'PO3745V6X020', 'RNGPO3745X020', 'ready', 12);

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
  `kota` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `KP` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `telp` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `bio` text NOT NULL,
  `pp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `id_user`, `nama`, `tmpt_lhr`, `tgl_lhr`, `alamat`, `kel`, `kec`, `kota`, `KP`, `telp`, `bio`, `pp`) VALUES
(1, 2, 'Test1', 'Samarinda', '2008-09-11', 'Jl Tanah Hitam', 'Gunung kelua', 'Samarinda Ulu', 'Samarinda', '12346', '0822100732927', '', ''),
(4, 7, 'Pegawai 1', '', '2006-01-10', '', '', '', '', '', '', '', 'pp_690725e7ce8fd.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `nik` char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat` text NOT NULL,
  `kelurahan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kecamatan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kota` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kp` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `telp` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `bio` text NOT NULL,
  `pp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `id_user`, `nama`, `nik`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `kp`, `telp`, `bio`, `pp`) VALUES
(3, 1, 'Fadlan', '1234', 'Jl Aw Syahrani', 'Gunung kelua', 'Samarinda Ulu', 'Samarinda', '12345', '0822100732928', 'testing', 'testing.jpg'),
(4, 4, 'Test 2', '', '', '', '', '', '', '', '', 'pp_6909dc3a3eb0c.jpg');

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
  `merk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `model` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis` varchar(255) NOT NULL,
  `silinder` int NOT NULL,
  `bhn_bkr` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `transmisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pintu` tinyint NOT NULL,
  `kursi` tinyint NOT NULL,
  `harga` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tipemobil`
--

INSERT INTO `tipemobil` (`id_tipe`, `merk`, `tipe`, `model`, `jenis`, `silinder`, `bhn_bkr`, `transmisi`, `pintu`, `kursi`, `harga`) VALUES
(10, 'Koenigsegg', 'Jesko', 'Megacar', 'Coupe', 5000, 'pertamax', 'automatic', 2, 2, 3000000.00),
(11, 'Ferrari', 'SF90 Stradale', 'Hybrid Supercar', 'Coupe', 3990, 'pertamax', 'automatic', 2, 2, 1500000.00),
(12, 'Porsche', '911 Turbo S', '992', 'Coupe', 3745, 'pertamax', 'automatic', 2, 2, 300000.00),
(13, 'Lamborghini', 'Aventador SVJ', 'LP770-4', 'Coupe', 6498, 'pertamax', 'automatic', 2, 2, 500000.00),
(14, 'Bugatti', 'Chiron Super Sport', '300+', 'Coupe', 7993, 'pertamax', 'automatic', 2, 2, 3500000.00),
(15, 'McLaren', '765LT', 'Super Series', 'Coupe', 3994, 'pertamax', 'automatic', 2, 2, 350000.00),
(16, 'Aston Martin', 'Valkyrie', 'AMR Pro', 'Coupe', 6500, 'pertamax', 'automatic', 2, 2, 4000000.00),
(17, 'Pagani', 'Huayra BC', 'BC Roadster', 'Coupe', 5980, 'pertamax', 'automatic', 2, 2, 2500000.00),
(18, 'Mercedes-Benz', 'AMG One', 'Hypercar', 'Coupe', 1599, 'pertamax', 'automatic', 2, 2, 2000000.00),
(19, 'Rimac', 'Nevera', 'EV Hypercar', 'Coupe', 0, 'pertamax', 'automatic', 2, 2, 1900000.00),
(20, 'Tesla', 'Model S Plaid', 'Plaid', 'EV Sedan', 0, 'listrik', 'automatic', 4, 5, 1500000.00),
(21, 'Lucid', 'Air Dream Edition', 'Dream', 'EV Sedan', 0, 'listrik', 'automatic', 4, 5, 1200000.00),
(22, 'Lotus', 'Evija', 'Evija', 'EV Hypercar', 0, 'listrik', 'automatic', 2, 2, 2000000.00),
(23, 'BMW', 'i8 Roadster', 'i8', 'Hybrid Sports', 1500, 'pertamax', 'automatic', 2, 2, 1500000.00),
(24, 'Pagani', 'Zonda HP Barchetta', 'HP Barchetta', 'Coupe', 7500, 'pertamax', 'automatic', 2, 2, 3000000.00);

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
(5, 'Test3@gmail.com', '$2y$10$VaDzCwwQtuEx3OmYBWcB4uIVhBS5ukb8CYqFg5NUYL78ooow6LUWW', 'P', 'pelanggan', '2025-10-29 11:28:27'),
(6, 'test4@gmail.com', '$2y$10$q3Fh4P0HwqdMc1lpvlOT6eb0qkDcjz4RK2wg0dY0jIqAM1h4jxxBK', 'P', 'pelanggan', '2025-10-30 14:03:25'),
(7, 'pegawai1@rentcar.com', '$2y$10$lpy/ycuTWcTE.uy8Es09R.dKw.DwkXmkHu0HD8CHcNuH3txINoQq2', 'P', 'pegawai', '2025-11-01 11:52:16');

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
  MODIFY `id_mobil` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rental`
--
ALTER TABLE `rental`
  MODIFY `id_rental` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipemobil`
--
ALTER TABLE `tipemobil`
  MODIFY `id_tipe` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
