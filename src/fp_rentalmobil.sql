-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 14, 2025 at 01:15 AM
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
  `warna` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` enum('ready','rent','maintenance','nonactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `noplat` varchar(255) NOT NULL,
  `nomesin` varchar(255) NOT NULL,
  `norangka` varchar(255) NOT NULL,
  `id_tipe` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`id_mobil`, `img`, `tahun`, `warna`, `status`, `noplat`, `nomesin`, `norangka`, `id_tipe`) VALUES
(38, 'koenigsegg-merah.jpg', '2024', 'Merah', 'rent', 'B 1 KSG', 'KJ5000V8X001', 'RNGKJ5000X001', 10),
(39, 'koenigsegg-biru.jpg', '2024', 'Biru', 'ready', 'B 2 KSG', 'KJ5000V8X002', 'RNGKJ5000X002', 10),
(40, 'ferrari-merah.jpg', '2023', 'Merah', 'rent', 'B 3 FER', 'FE3990V8X003', 'RNGFE3990X003', 11),
(41, 'ferrari-kuning.jpg', '2023', 'Kuning', 'ready', 'B 4 FER', 'FE3990V8X004', 'RNGFE3990X004', 11),
(42, 'porsche-hitam.jpg', '2023', 'Hitam', 'rent', 'B 5 POR', 'PO3745V6X005', 'RNGPO3745X005', 12),
(43, 'lamborghini-hijau.jpg', '2024', 'Hijau', 'ready', 'B 6 LAM', 'LA6498V12X006', 'RNGLA6498X006', 13),
(44, 'bugatti-biru.jpg', '2024', 'Biru', 'rent', 'B 7 BUG', 'BU7993V16X007', 'RNGBU7993X007', 14),
(45, 'mclaren-orange.jpg', '2023', 'Orange', 'ready', 'B 8 MCL', 'MC3994V8X008', 'RNGMC3994X008', 15),
(46, 'astonmartin-silver.jpg', '2024', 'Silver', 'rent', 'B 9 AST', 'AM6500V12X009', 'RNGAM6500X009', 16),
(47, 'pagani-hitam.jpg', '2024', 'Hitam', 'ready', 'B 10 PAG', 'PA5980V12X010', 'RNGPA5980X010', 17),
(48, 'mercedesbenz-putih.jpg', '2023', 'Putih', 'ready', 'B 11 MER', 'MB1599V6X011', 'RNGMB1599X011', 18),
(49, 'rimac-biru.jpg', '2024', 'Biru', 'ready', 'B 12 RIM', 'RI0V8X012', 'RNGRI0X012', 19),
(50, 'tesla-merah.jpg', '2024', 'Merah', 'ready', 'B 13 TES', 'TS0EVX013', 'RNGTS0X013', 20),
(51, 'lucid-putih.jpg', '2024', 'Putih', 'ready', 'B 14 LUC', 'LU0EVX014', 'RNGLU0X014', 21),
(52, 'lotus-hijau.jpg', '2024', 'Hijau', 'ready', 'B 15 LOT', 'LO0EVX015', 'RNGLO0X015', 22),
(53, 'bmw-biru.jpg', '2023', 'Biru', 'ready', 'B 16 BMW', 'BM1500V6X016', 'RNGBM1500X016', 23),
(54, 'pagani-abu.jpg', '2024', 'Abu', 'ready', 'B 17 PAG', 'PA7500V12X017', 'RNGPA7500X017', 24),
(55, 'koenigsegg-hitam.jpg', '2024', 'Hitam', 'ready', 'B 18 KSG', 'KJ5000V8X018', 'RNGKJ5000X018', 10),
(56, 'ferrari-putih.jpg', '2023', 'Putih', 'ready', 'B 19 FER', 'FE3990V8X019', 'RNGFE3990X019', 11),
(57, 'porsche-merah.jpg', '2023', 'Merah', 'ready', 'B 20 POR', 'PO3745V6X020', 'RNGPO3745X020', 12);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `tmpt_lhr` varchar(255) DEFAULT NULL,
  `tgl_lhr` date DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kel` varchar(255) DEFAULT NULL,
  `kec` varchar(255) DEFAULT NULL,
  `kota` varchar(255) DEFAULT NULL,
  `KP` char(5) DEFAULT NULL,
  `telp` varchar(13) DEFAULT NULL,
  `bio` text,
  `pp` varchar(255) DEFAULT NULL,
  `jabatan` enum('admin','customer service') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `id_user`, `nama`, `tmpt_lhr`, `tgl_lhr`, `alamat`, `kel`, `kec`, `kota`, `KP`, `telp`, `bio`, `pp`, `jabatan`) VALUES
(1, 2, 'Test1', 'Samarinda', '2008-09-11', 'Jl Tanah Hitam', 'Gunung kelua', 'Samarinda Ulu', 'Samarinda', '12346', '0822100732927', '', '', 'admin'),
(4, 7, 'Pegawai 1', '', '2006-01-10', '', '', '', '', '', '', '', 'pp_690725e7ce8fd.jpg', 'admin'),
(5, 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `nik` char(16) DEFAULT NULL,
  `alamat` text,
  `kelurahan` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `kota` varchar(255) DEFAULT NULL,
  `kp` char(5) DEFAULT NULL,
  `telp` varchar(13) DEFAULT NULL,
  `bio` text,
  `pp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `id_user`, `nama`, `nik`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `kp`, `telp`, `bio`, `pp`) VALUES
(4, 4, 'syahid hussein', '', '', '', '', '', '', '', '', 'pp_691315b95376a.jpg'),
(7, 8, '', NULL, '', '', '', '', '', '', '', 'pp_690a94c260f52.jpg'),
(8, 9, 'Achmad fattah Safaraj', NULL, 'Perumahan bumi Sempaja', '', '', 'Samarinda', '45433', '085252829756', '', 'pp_690c18ca023a2.jpg'),
(9, 10, '', NULL, '', '', '', '', '', '', '', ''),
(10, 11, '', NULL, '', '', '', '', '', '', '', ''),
(14, 18, '', '9878765467897656', 'Jl aws', '', '', '', '', '0822198274141', '', 'pp_691289e9172b4.jpg'),
(15, 19, 'Test9', '9128374467132241', 'Jl Tol', '', '', '', '', '0822101233', '', 'default.svg'),
(16, 20, '', '9182471567891132', 'jl jalan', '', '', '', '', '08712564313', '', 'default.svg'),
(17, 21, 'kizunari nooru', '9876325163894872', 'JL dimana aja', '', '', '', '', '087615423141', '', 'default.svg'),
(18, 22, 'Andik Firdus', '1754869166456534', 'Jl. aws 7', 'pak lurah', 'tanjung pinang', 'Bandung', '15783', '08526751898', 'bingo', 'pp_691296d3a3c65.png'),
(19, 23, 'test12', '0123812312312312', 'jl jalan', 'tes', 'tes', 'samarinda', '86612', '08612361231', 'tes', 'pp_6914234a49b6e.jpg'),
(21, 25, 'Fadlan Pelanggan', '8812321213198432', 'JL Aw.Syahrani gang 45', 'Gunung Kelua', 'Samarinda Ulu', 'Samarinda', '45433', '082210732928', 'tes tes', 'pp_6914cf247acb1.jpg'),
(23, 27, 'Fahri Noor', '0918194113244324', 'jl pahlawan', '', '', 'samarinda', '', '0822192746102', '', 'pp_691535ba55b7d.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tipemobil`
--

CREATE TABLE `tipemobil` (
  `id_tipe` int NOT NULL,
  `merk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tipe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `model` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jenis` varchar(255) NOT NULL,
  `silinder` int NOT NULL,
  `bhn_bkr` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `transmisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `pintu` tinyint NOT NULL,
  `kursi` tinyint NOT NULL,
  `harga` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tipemobil`
--

INSERT INTO `tipemobil` (`id_tipe`, `merk`, `tipe`, `model`, `jenis`, `silinder`, `bhn_bkr`, `transmisi`, `pintu`, `kursi`, `harga`) VALUES
(10, 'Koenigsegg', 'Jesko', 'Megacar', 'Coupe', 5000, 'bensin', 'automatic', 2, 2, 3000000.00),
(11, 'Ferrari', 'SF90 Stradale', 'Hybrid Supercar', 'Coupe', 3990, 'bensin', 'automatic', 2, 2, 1500000.00),
(12, 'Porsche', '911 Turbo S', '992', 'Coupe', 3745, 'bensin', 'automatic', 2, 2, 300000.00),
(13, 'Lamborghini', 'Aventador SVJ', 'LP770-4', 'Coupe', 6498, 'bensin', 'automatic', 2, 2, 500000.00),
(14, 'Bugatti', 'Chiron Super Sport', '300+', 'Coupe', 7993, 'bensin', 'automatic', 2, 2, 3500000.00),
(15, 'McLaren', '765LT', 'Super Series', 'Coupe', 3994, 'bensin', 'automatic', 2, 2, 350000.00),
(16, 'Aston Martin', 'Valkyrie', 'AMR Pro', 'Coupe', 6500, 'bensin', 'automatic', 2, 2, 4000000.00),
(17, 'Pagani', 'Huayra BC', 'BC Roadster', 'Coupe', 5980, 'bensin', 'automatic', 2, 2, 2500000.00),
(18, 'Mercedes-Benz', 'AMG One', 'Hypercar', 'Coupe', 1599, 'bensin', 'automatic', 2, 2, 2000000.00),
(19, 'Rimac', 'Nevera', 'EV Hypercar', 'Coupe', 0, 'bensin', 'automatic', 2, 2, 1900000.00),
(20, 'Tesla', 'Model S Plaid', 'Plaid', 'EV Sedan', 0, 'listrik', 'automatic', 4, 5, 1500000.00),
(21, 'Lucid', 'Air Dream Edition', 'Dream', 'EV Sedan', 0, 'listrik', 'automatic', 4, 5, 1200000.00),
(22, 'Lotus', 'Evija', 'Evija', 'EV Hypercar', 0, 'listrik', 'automatic', 2, 2, 2000000.00),
(23, 'BMW', 'i8 Roadster', 'i8', 'Hybrid Sports', 1500, 'bensin', 'automatic', 2, 2, 1500000.00),
(24, 'Pagani', 'Zonda HP Barchetta', 'HP Barchetta', 'Coupe', 7500, 'bensin', 'automatic', 2, 2, 3000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int NOT NULL,
  `id_mobil` int NOT NULL,
  `id_pelanggan` int NOT NULL,
  `id_pegawai` int DEFAULT NULL,
  `tgl_sewa` datetime NOT NULL,
  `tgl_kembali` datetime NOT NULL,
  `total_bayar` decimal(12,2) NOT NULL,
  `durasi_sewa` int NOT NULL,
  `status` enum('berjalan','selesai','batal') NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_mobil`, `id_pelanggan`, `id_pegawai`, `tgl_sewa`, `tgl_kembali`, `total_bayar`, `durasi_sewa`, `status`, `tgl_dibuat`) VALUES
(12, 40, 4, 4, '2025-11-04 00:00:00', '2025-11-13 00:00:00', 9.00, 13500000, 'berjalan', '2025-11-10 17:10:46'),
(13, 38, 4, 4, '2025-11-11 00:00:00', '2025-11-13 00:00:00', 2.00, 6000000, 'berjalan', '2025-11-10 23:27:31'),
(17, 41, 4, 4, '2025-11-11 00:00:00', '2025-11-13 00:00:00', 2.00, 3000000, 'berjalan', '2025-11-11 01:13:22'),
(28, 42, 17, NULL, '2025-11-11 00:00:00', '2025-11-13 00:00:00', 600000.00, 2, 'berjalan', '2025-11-11 02:20:19'),
(29, 39, 18, NULL, '2025-11-11 00:00:00', '2025-11-13 00:00:00', 6000000.00, 2, 'berjalan', '2025-11-11 02:22:06'),
(30, 53, 17, NULL, '2025-11-11 00:00:00', '2025-11-12 00:00:00', 1500000.00, 1, 'berjalan', '2025-11-11 03:47:01'),
(31, 46, 17, NULL, '2025-11-11 00:00:00', '2025-11-12 00:00:00', 4000000.00, 1, 'berjalan', '2025-11-11 05:09:39'),
(32, 45, 17, NULL, '2025-11-11 00:00:00', '2025-11-20 00:00:00', 3150000.00, 9, 'berjalan', '2025-11-11 05:26:01'),
(33, 56, 4, NULL, '2025-11-12 00:00:00', '2025-11-14 00:00:00', 3000000.00, 2, 'berjalan', '2025-11-11 06:03:00'),
(34, 47, 4, NULL, '2025-11-11 00:00:00', '2025-11-12 00:00:00', 2500000.00, 1, 'berjalan', '2025-11-11 06:17:19'),
(36, 44, 21, 5, '2025-11-13 01:52:00', '2025-11-29 01:52:00', 56000000.00, 16, 'batal', '2025-11-12 17:53:01'),
(38, 52, 21, 5, '2025-11-13 01:58:00', '2025-11-28 01:58:00', 30000000.00, 15, 'batal', '2025-11-12 17:58:14'),
(39, 48, 21, 5, '2025-11-13 02:01:00', '2025-11-21 02:01:00', 16000000.00, 8, 'batal', '2025-11-12 18:01:41'),
(40, 49, 21, 5, '2025-11-13 02:03:00', '2025-11-27 02:03:00', 26600000.00, 14, 'batal', '2025-11-12 18:03:14'),
(41, 50, 21, 5, '2025-11-13 02:04:00', '2025-11-15 02:04:00', 3000000.00, 2, 'batal', '2025-11-12 18:04:08'),
(42, 54, 21, 5, '2025-11-13 02:04:00', '2025-11-29 23:59:59', 24000000.00, 8, 'batal', '2025-11-12 18:05:00'),
(43, 51, 21, 5, '2025-11-13 02:06:00', '2025-11-15 02:06:00', 2400000.00, 2, 'selesai', '2025-11-12 18:06:58'),
(44, 51, 21, 5, '2025-11-13 02:07:00', '2025-11-21 02:07:00', 9600000.00, 8, 'selesai', '2025-11-12 18:07:27'),
(45, 55, 21, 5, '2025-11-13 02:07:00', '2025-11-26 02:07:00', 39000000.00, 13, 'batal', '2025-11-12 18:07:37'),
(53, 47, 21, 5, '2025-11-13 06:36:00', '2025-11-15 06:36:00', 5000000.00, 2, 'batal', '2025-11-12 22:36:30'),
(54, 41, 21, 5, '2025-11-13 08:07:00', '2025-11-15 08:07:00', 3000000.00, 2, 'batal', '2025-11-13 00:07:50'),
(55, 38, 21, 5, '2025-11-13 08:53:00', '2025-11-14 08:53:00', 3000000.00, 1, 'batal', '2025-11-13 00:54:01'),
(56, 42, 21, 5, '2025-11-13 09:07:00', '2025-11-15 09:07:00', 600000.00, 2, 'batal', '2025-11-13 01:07:47'),
(57, 46, 21, 5, '2025-11-13 09:07:00', '2025-11-15 09:07:00', 8000000.00, 2, 'batal', '2025-11-13 01:07:57'),
(58, 42, 21, 5, '2025-11-13 09:25:00', '2025-11-22 09:25:00', 2700000.00, 9, 'batal', '2025-11-13 01:25:21'),
(59, 38, 23, 5, '2025-11-13 09:39:00', '2025-11-22 09:39:00', 27000000.00, 9, 'batal', '2025-11-13 01:39:46'),
(60, 40, 23, 5, '2025-11-13 09:41:00', '2025-11-29 09:41:00', 24000000.00, 16, 'selesai', '2025-11-13 01:41:27'),
(61, 44, 23, 5, '2025-11-13 09:42:00', '2025-11-15 23:59:59', 3500000.00, 1, 'berjalan', '2025-11-13 01:42:28');

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
(2, 'test1@gmail.com', '$2y$12$kRUzzW9nZqwHuEaEDr6WCu7hLRDq8smn1/BcvhlVGrXG2P6wpd2m6', 'L', 'pelanggan', '2025-10-29 06:05:49'),
(4, 'Test2@gmail.com', '$2y$10$H.66mBQY0.LcmlGy7NyI3u.FOoaLEm4/CwTHmmuJZHTd9dNlVTFH2', 'L', 'pelanggan', '2025-10-29 11:25:21'),
(5, 'Test3@gmail.com', '$2y$10$VaDzCwwQtuEx3OmYBWcB4uIVhBS5ukb8CYqFg5NUYL78ooow6LUWW', 'P', 'pelanggan', '2025-10-29 11:28:27'),
(6, 'test4@gmail.com', '$2y$10$q3Fh4P0HwqdMc1lpvlOT6eb0qkDcjz4RK2wg0dY0jIqAM1h4jxxBK', 'P', 'pelanggan', '2025-10-30 14:03:25'),
(7, 'pegawai1@rentcar.com', '$2y$10$lpy/ycuTWcTE.uy8Es09R.dKw.DwkXmkHu0HD8CHcNuH3txINoQq2', 'P', 'pegawai', '2025-11-01 11:52:16'),
(8, 'Test5@gmail.com', '$2y$10$4HWauxcEifr1ohO586LcT.9ttv3HFzZ0/JAdJmdj/gvrFLoSDhimu', 'P', 'pelanggan', '2025-11-05 00:00:36'),
(9, 'fattah@gmail.com', '$2y$10$K5co5lghcKR8VB0/HlHBYeXhflpHLUIXgw6X7sT0yu.FVgibq7uIW', 'P', 'pelanggan', '2025-11-06 03:38:06'),
(10, 'airgeming20@gmail.com', '$2y$10$9g94yMpJ5jVESCcXDpUGRue4lUux/s4PElwtfH/wzPCRaorA6iAiS', 'P', 'pelanggan', '2025-11-10 03:40:20'),
(11, 'AkuJago@gmail.com', '$2y$10$RZp/c.Urku2HsmEU9XKh/eMDW4KqtO7ngquS4tboBwDWefImunAla', 'P', 'pelanggan', '2025-11-10 05:50:27'),
(12, 'test7@gmail.com', '$2y$10$k0wjE97pNSo5hXaBdwJsN.dwVZKu9vN91sHLbMvU7YKSJEbVlpHya', 'P', 'pelanggan', '2025-11-10 14:29:33'),
(18, 'farrel@gmail.com', '$2y$10$aqjbHzFBJ0uQNyjFo1V93.VortEBLfjF3cAVMvKUSrTT/jlhUmwb2', 'P', 'pelanggan', '2025-11-11 00:56:14'),
(19, 'test10@gmail.com', '$2y$10$ty3m/gjSVpFXVB6hPgIxPOvxzH9HIJivwugEt147H7TvBElqpQhCW', 'L', 'pelanggan', '2025-11-11 01:16:34'),
(20, 'test9@gmail.com', '$2y$10$h8lmGlX.1nhj2IQBoaGNFOS0HrM6s7ykCBk0GLb8MF7oHKK23Bn0C', 'L', 'pelanggan', '2025-11-11 01:18:34'),
(21, 'kizunari@gmail.com', '$2y$10$ov6lbHs6AcebIHJ8W70OauqPLoAEAzQXR0gSUB9bBIutCZEnsDNXG', 'L', 'pelanggan', '2025-11-11 01:44:15'),
(22, 'natandick@gmail.com', '$2y$10$B6J3RnxDIq4HEapTjSTmneu0vllC7sTf6nVJRSfgOvPrAHJOH8vB6', 'L', 'pelanggan', '2025-11-11 01:48:22'),
(23, 'test12@gmail.com', '$2y$10$.h9rH1pcIVrBw4J58poM7uAad4qo3Q.ImBQNCPsgYsHKcf/uGsmEK', 'P', 'pelanggan', '2025-11-12 06:03:05'),
(25, 'fadlanpelanggan@gmail.com', '$2y$10$75.RAagiOP7TDhklVfXMN.BVX1Jf1W9jol7LSzkMZWETNRkuxSqF6', 'L', 'pelanggan', '2025-11-12 14:51:12'),
(26, 'fadlanadmin@gmail.com', '$2y$10$MZo3YIHEmQknmTZnezthz.c02CmEkXvQvp2KsE5jqEKRZif3PCuv.', 'L', 'pegawai', '2025-11-12 16:56:49'),
(27, 'fahri@gmail.com', '$2y$10$FREDNpmJbV/SKYBdbtnxzONFt7.HE2Ga5PxHDgpUZEL5SbKjT1oei', 'P', 'pelanggan', '2025-11-13 01:34:08');

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
  ADD UNIQUE KEY `uq_pegawai_user` (`id_user`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD UNIQUE KEY `uq_pelanggan_user` (`id_user`);

--
-- Indexes for table `tipemobil`
--
ALTER TABLE `tipemobil`
  ADD PRIMARY KEY (`id_tipe`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `fk_transaksi_mobil` (`id_mobil`),
  ADD KEY `fk_transaksi_pelanggan` (`id_pelanggan`),
  ADD KEY `fk_transaksi_pegawai` (`id_pegawai`);

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
  MODIFY `id_pegawai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tipemobil`
--
ALTER TABLE `tipemobil`
  MODIFY `id_tipe` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_mobil` FOREIGN KEY (`id_mobil`) REFERENCES `mobil` (`id_mobil`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaksi_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaksi_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
