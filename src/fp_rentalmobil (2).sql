-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 14, 2025 at 05:36 AM
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
  `kapasitas` int NOT NULL,
  `merek` varchar(100) NOT NULL,
  `harga_hari` decimal(10,2) NOT NULL,
  `transmisi` enum('manual','metic') NOT NULL,
  `bahan_bakar` enum('pertalite','pertamax','solar') DEFAULT NULL,
  `tahun` year NOT NULL,
  `status` enum('rent','ready','maintenance') NOT NULL,
  `warna` varchar(100) NOT NULL,
  `model` varchar(255) NOT NULL,
  `bagasi` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`id_mobil`, `kapasitas`, `merek`, `harga_hari`, `transmisi`, `bahan_bakar`, `tahun`, `status`, `warna`, `model`, `bagasi`) VALUES
(6, 2, 'Koenigsegg Jesko', 25000000.00, 'metic', 'pertamax', '2023', 'ready', 'white', 'Hypercar', 1),
(7, 2, 'Lamborghini Aventador', 15000000.00, 'metic', 'pertamax', '2022', 'rent', 'yellow', 'Supercar', 1),
(8, 2, 'Ferrari SF90 Stradale', 18000000.00, 'metic', 'pertamax', '2023', 'ready', 'red', 'Supercar', 1),
(9, 2, 'Bugatti Chiron', 30000000.00, 'metic', 'pertamax', '2021', 'ready', 'blue', 'Hypercar', 1),
(10, 2, 'McLaren 720S', 12000000.00, 'metic', 'pertamax', '2022', 'maintenance', 'orange', 'Supercar', 1),
(11, 2, 'Porsche 911 Turbo S', 8000000.00, 'metic', 'pertamax', '2020', 'ready', 'silver', 'Sport Coupe', 2),
(12, 2, 'Aston Martin DBS Superleggera', 9500000.00, 'metic', 'pertamax', '2021', 'rent', 'dark green', 'Grand Tourer', 2),
(16, 2, 'Koenigsegg Jesko', 35000000.00, 'metic', 'pertamax', '2023', 'ready', 'Putih', 'Hypercar', 1),
(17, 2, 'Bugatti Chiron Super Sport', 40000000.00, 'metic', 'pertamax', '2022', 'ready', 'Hitam', 'Hypercar', 1),
(18, 2, 'Ferrari SF90 Stradale', 25000000.00, 'metic', 'pertamax', '2021', 'ready', 'Merah', 'Supercar', 1),
(19, 2, 'Lamborghini Aventador SVJ', 27000000.00, 'metic', 'pertamax', '2020', 'ready', 'Kuning', 'Supercar', 1),
(20, 2, 'McLaren 765LT', 24000000.00, 'metic', 'pertamax', '2021', 'ready', 'Abu-Abu', 'Supercar', 1),
(21, 4, 'Rolls-Royce Phantom', 30000000.00, 'metic', 'pertamax', '2022', 'ready', 'Silver', 'Luxury Sedan', 3),
(22, 4, 'Bentley Continental GT', 28000000.00, 'metic', 'pertamax', '2021', 'ready', 'Biru', 'Luxury Coupe', 3);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `mobil` varchar(100) NOT NULL,
  `tgl_sewa` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `total_bayar` decimal(10,2) NOT NULL,
  `status` enum('selesai','proses','gagal') NOT NULL,
  `denda` decimal(10,0) NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `nama_pelanggan`, `mobil`, `tgl_sewa`, `tgl_kembali`, `total_bayar`, `status`, `denda`, `tgl_dibuat`) VALUES
(9, 'Fadlan', 'Koenigsegg Jesko', '2025-10-01', '2025-10-03', 70000000.00, 'selesai', 0, '2025-10-13 11:44:21'),
(10, 'Nadia Putri', 'Bugatti Chiron Super Sport', '2025-10-05', '2025-10-07', 80000000.00, 'proses', 0, '2025-10-13 11:44:21'),
(11, 'Rafi Ahmad', 'Ferrari SF90 Stradale', '2025-10-08', '2025-10-09', 50000000.00, 'selesai', 0, '2025-10-13 11:44:21'),
(12, 'Aisyah Nur', 'Lamborghini Aventador SVJ', '2025-10-02', '2025-10-04', 54000000.00, 'selesai', 0, '2025-10-13 11:44:21'),
(13, 'Bima Pratama', 'McLaren 765LT', '2025-10-06', '2025-10-08', 48000000.00, 'proses', 0, '2025-10-13 11:44:21'),
(14, 'Siti Marlina', 'Rolls-Royce Phantom', '2025-10-09', '2025-10-11', 60000000.00, 'selesai', 0, '2025-10-13 11:44:21'),
(15, 'Nadia Putri', 'Bentley Continental GT', '2025-10-10', '2025-10-12', 56000000.00, 'gagal', 0, '2025-10-13 11:44:21'),
(16, 'Tester', 'Avanza', '2025-09-10', '2025-09-12', 999999.00, 'selesai', 0, '2025-09-10 02:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `sim` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `tgl_dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ktp` varchar(255) NOT NULL,
  `tlp` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `sim`, `email`, `password`, `role`, `tgl_dibuat`, `ktp`, `tlp`) VALUES
(8, 'Admin Utama', 'uploads/img.jpg', 'admin@rentcar.com', '$2y$10$EIEHUFX.3vr6VqW8G19vee5m8z76SfWKZha6wuzNVBoUTICa3kGYu', 'admin', '2025-10-13 11:46:34', 'uploads/img.jpg', '081234567890'),
(9, 'Fadlan', 'uploads/img.jpg', 'fadlan@gmail.com', '$2y$10$8y5JpTTKMv3ulVij2yseoe3wVOOKDRY957sOYOd2UNJtpHr6R8rGi', 'user', '2025-10-13 11:46:34', 'uploads/img.jpg', '081298765432'),
(10, 'Nadia Putri', 'uploads/img.jpg', 'nadia@gmail.com', '$2y$10$uRMSt7uVcojvnnZI4V/n8.6V.UOrh3MTkbd9QqUN109KvJHCUDbki', 'user', '2025-10-13 11:46:34', 'uploads/img.jpg', '081212345678'),
(11, 'Rafi Ahmad', 'uploads/img.jpg', 'rafi@gmail.com', '$2y$10$l6k.qZ0CuV8/vtxj1pEUtuVDY7161gmLLUyQS0/y73h1PIbZvVjxG', 'user', '2025-10-13 11:46:34', 'uploads/img.jpg', '082112345678'),
(12, 'Aisyah Nur', 'uploads/img.jpg', 'aisyah@gmail.com', '$2y$10$GkMw6pduQWGH2Ovmj0ov1uLDMuPcBfvIjdwkWc/N9R75yyo9StKRi', 'user', '2025-10-13 11:46:34', 'uploads/img.jpg', '083812345678'),
(13, 'Bima Pratama', 'uploads/img.jpg', 'bima@gmail.com', '$2y$10$lgo2anrI.h1L7alv5Az8POC0FPXUQIENp2YmZwNhNZbVA63wNtVHu', 'user', '2025-10-13 11:46:34', 'uploads/img.jpg', '085212345678'),
(14, 'Siti Marlina', 'uploads/img.jpg', 'siti@gmail.com', '$2y$10$Evz6GEVvKm1HcmdmAc8duOBgNQa8H9X5E.eTjaYR.8w2NTCzV9aaa', 'user', '2025-10-13 11:46:34', 'uploads/img.jpg', '087812345678');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

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
  MODIFY `id_mobil` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
