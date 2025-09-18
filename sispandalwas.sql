-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 11, 2025 at 10:12 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sispandalwas`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `nama_lengkap` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `password` text COLLATE utf8mb4_general_ci NOT NULL,
  `role_id` int DEFAULT NULL,
  `aktif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama_lengkap`, `username`, `password`, `role_id`, `aktif`) VALUES
(1, 'Super Admin', 'super', '$2y$10$rcwfV3zHUp8o0TZJivQaten78fIMP0A0bfeoD6fjJM9elSqUatI2O', 1, 1),
(2, 'Administrator', 'admin', '$2y$10$GXaCE5GwGOZNqW5j3nrb8uKfvm/zelMpTU1zz3EDudkA.xOKWAg/i', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cluster`
--

CREATE TABLE `cluster` (
  `id` int NOT NULL,
  `nama_cluster` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cluster`
--

INSERT INTO `cluster` (`id`, `nama_cluster`) VALUES
(1, 'Cluster 1'),
(2, 'Cluster 2'),
(3, 'Cluster 3'),
(4, 'Cluster 4');

-- --------------------------------------------------------

--
-- Table structure for table `detail`
--

CREATE TABLE `detail` (
  `id` int NOT NULL,
  `registrasi_id` int NOT NULL,
  `cluster_id` int NOT NULL,
  `tanggal` date NOT NULL,
  `dive_spot_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail`
--

INSERT INTO `detail` (`id`, `registrasi_id`, `cluster_id`, `tanggal`, `dive_spot_id`) VALUES
(1, 1, 1, '2025-08-01', 2),
(2, 1, 2, '2025-08-04', 11);

-- --------------------------------------------------------

--
-- Table structure for table `detail_jam`
--

CREATE TABLE `detail_jam` (
  `id` int NOT NULL,
  `detail_id` int NOT NULL,
  `jam_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_jam`
--

INSERT INTO `detail_jam` (`id`, `detail_id`, `jam_id`) VALUES
(1, 1, 2),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `dive_spot`
--

CREATE TABLE `dive_spot` (
  `id` int NOT NULL,
  `nama_dive_spot` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cluster_id` int NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dive_spot`
--

INSERT INTO `dive_spot` (`id`, `nama_dive_spot`, `cluster_id`, `aktif`) VALUES
(1, 'Macro rock or Grouper net', 1, 1),
(2, 'Three rocks', 1, 1),
(3, 'Razorback rock', 1, 1),
(4, 'Cave and wall (farondi cave)', 1, 1),
(5, 'Pet Rock', 1, 1),
(6, 'Love Potion number nine', 1, 1),
(7, 'No contest', 1, 1),
(8, 'Plateau', 1, 1),
(9, 'Gorgonian passage (neptune fan sea)', 2, 1),
(10, 'Baraccuda Rock', 2, 1),
(11, 'Small World', 2, 1),
(12, 'Wedding Cake', 2, 1),
(13, 'Elephant Wall', 2, 1),
(14, 'Four King', 2, 1),
(15, 'Orange peel', 2, 1),
(16, 'Tobleron', 2, 1),
(17, 'Blue Hole', 2, 1),
(18, 'Kaleidoscope', 2, 1),
(19, 'Pele Playground', 2, 1),
(20, '2 For 2', 2, 1),
(21, 'Yellit Kecil', 3, 1),
(22, 'Boo Window', 3, 1),
(23, 'Boo East (cape Boo)', 3, 1),
(24, 'Romeo', 3, 1),
(25, 'Tank Rock', 3, 1),
(26, 'Nudi Rock', 3, 1),
(27, 'Whale Rock', 3, 1),
(28, 'Potato Point (east kalig)', 3, 1),
(29, 'Boo West', 3, 1),
(30, 'Fiabacet', 3, 1),
(31, 'Eagle Nest', 3, 1),
(32, 'Magic Mountain (karang bayangan)', 3, 1),
(33, 'Puri Pinnacle', 3, 1),
(34, 'Andiamo', 4, 1),
(35, 'Color Color', 4, 1),
(36, 'Candy Store', 4, 1),
(37, 'Andy\'s Ultimate', 4, 1),
(38, 'Black Rock', 4, 1),
(39, 'Yellit Besar', 3, 1),
(40, 'Kanim', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `durasi`
--

CREATE TABLE `durasi` (
  `id` int NOT NULL,
  `registrasi_id` int NOT NULL,
  `cluster_id` int NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `durasi`
--

INSERT INTO `durasi` (`id`, `registrasi_id`, `cluster_id`, `tanggal`) VALUES
(1, 1, 1, '2025-08-01'),
(2, 1, 1, '2025-08-02'),
(3, 1, 1, '2025-08-03'),
(4, 1, 2, '2025-08-04'),
(5, 1, 2, '2025-08-05'),
(6, 1, 2, '2025-08-06');

-- --------------------------------------------------------

--
-- Table structure for table `jam`
--

CREATE TABLE `jam` (
  `id` int NOT NULL,
  `nama_jam` varchar(30) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jam`
--

INSERT INTO `jam` (`id`, `nama_jam`) VALUES
(2, '07:00 - 09:00'),
(3, '09:00 - 11:00'),
(4, '14:00 - 16:00'),
(5, '18:00 - 20:00');

-- --------------------------------------------------------

--
-- Table structure for table `registrasi`
--

CREATE TABLE `registrasi` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `jml_penumpang` int NOT NULL,
  `dokumen` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_registrasi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrasi`
--

INSERT INTO `registrasi` (`id`, `user_id`, `jml_penumpang`, `dokumen`, `tgl_registrasi`) VALUES
(1, 1, 10, '', '2025-08-11 14:38:08');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int NOT NULL,
  `nama_role` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `nama_role`, `slug`) VALUES
(1, 'Super Admin', 'super'),
(2, 'Administrator', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_user` enum('Kapal','Land Base') COLLATE utf8mb4_general_ci NOT NULL,
  `nama_operator` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nomor_wa` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lokasi` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto` text COLLATE utf8mb4_general_ci,
  `gt_kapal` float DEFAULT NULL,
  `asal_kapal` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `max_penumpang` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `jenis_user`, `nama_operator`, `nomor_wa`, `email`, `password`, `lokasi`, `foto`, `gt_kapal`, `asal_kapal`, `max_penumpang`) VALUES
(1, 'Thousand Sunny', 'Kapal', 'Luffy', '085123123123', 'irmanfrdev@gmail.com', '$2y$10$v/5uaoGij/Q/GW5jOcSXAei4S6UiZj042VbwPzdlauoIPFQPwL9Wm', NULL, NULL, 31.5, 'Sky Barbershop', 25),
(2, 'Karang Resik', 'Land Base', 'Jajang', '089123456789', 'irmanf11@gmail.com', '$2y$10$r/AIKctsaz1X6TAKvSYW6uDYgsdgfKMnYykbyEEq64A2nuFQVVqai', 'Tasikmalaya', '1754883950_a3757c9f136d147fd6cb.png', NULL, NULL, 45);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `cluster`
--
ALTER TABLE `cluster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cluster_id` (`cluster_id`),
  ADD KEY `dive_spot_id` (`dive_spot_id`),
  ADD KEY `registrasi_id` (`registrasi_id`);

--
-- Indexes for table `detail_jam`
--
ALTER TABLE `detail_jam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_id` (`detail_id`),
  ADD KEY `jam_id` (`jam_id`);

--
-- Indexes for table `dive_spot`
--
ALTER TABLE `dive_spot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cluster_id` (`cluster_id`);

--
-- Indexes for table `durasi`
--
ALTER TABLE `durasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cluster_id` (`cluster_id`),
  ADD KEY `registrasi_id` (`registrasi_id`);

--
-- Indexes for table `jam`
--
ALTER TABLE `jam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registrasi`
--
ALTER TABLE `registrasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cluster`
--
ALTER TABLE `cluster`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `detail`
--
ALTER TABLE `detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `detail_jam`
--
ALTER TABLE `detail_jam`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dive_spot`
--
ALTER TABLE `dive_spot`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `durasi`
--
ALTER TABLE `durasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jam`
--
ALTER TABLE `jam`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `registrasi`
--
ALTER TABLE `registrasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail`
--
ALTER TABLE `detail`
  ADD CONSTRAINT `detail_ibfk_1` FOREIGN KEY (`cluster_id`) REFERENCES `cluster` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_ibfk_2` FOREIGN KEY (`dive_spot_id`) REFERENCES `dive_spot` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_ibfk_3` FOREIGN KEY (`registrasi_id`) REFERENCES `registrasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_jam`
--
ALTER TABLE `detail_jam`
  ADD CONSTRAINT `detail_jam_ibfk_1` FOREIGN KEY (`detail_id`) REFERENCES `detail` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_jam_ibfk_2` FOREIGN KEY (`jam_id`) REFERENCES `jam` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dive_spot`
--
ALTER TABLE `dive_spot`
  ADD CONSTRAINT `dive_spot_ibfk_1` FOREIGN KEY (`cluster_id`) REFERENCES `cluster` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `durasi`
--
ALTER TABLE `durasi`
  ADD CONSTRAINT `durasi_ibfk_1` FOREIGN KEY (`cluster_id`) REFERENCES `cluster` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `durasi_ibfk_2` FOREIGN KEY (`registrasi_id`) REFERENCES `registrasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `registrasi`
--
ALTER TABLE `registrasi`
  ADD CONSTRAINT `registrasi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
