-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2022 at 11:21 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tanamapa-app`
--

-- --------------------------------------------------------

--
-- Table structure for table `classification`
--

CREATE TABLE `classification` (
  `id` int(11) NOT NULL,
  `plant_name` varchar(50) DEFAULT NULL,
  `temp_min` float DEFAULT NULL,
  `temp_max` float DEFAULT NULL,
  `rf_min` float DEFAULT NULL,
  `rf_max` float DEFAULT NULL,
  `hmdt_min` float DEFAULT 0,
  `hmdt_max` float DEFAULT 100,
  `ph_min` float DEFAULT NULL,
  `ph_max` float DEFAULT NULL,
  `ele_min` float DEFAULT 0,
  `ele_max` float DEFAULT 2500
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classification`
--

INSERT INTO `classification` (`id`, `plant_name`, `temp_min`, `temp_max`, `rf_min`, `rf_max`, `hmdt_min`, `hmdt_max`, `ph_min`, `ph_max`, `ele_min`, `ele_max`) VALUES
(1, 'Alpukat', 18, 26, 1200, 2000, 0, 100, 5, 6.5, 5, 1500),
(2, 'Anggur', 22, 28, 1000, 2000, 0, 100, 5.5, 7.3, 0, 2000),
(3, 'Apel', 16, 20, 2200, 2500, 43, 100, 5.5, 7.8, 700, 1200),
(4, 'Belimbing', 22, 25, 1000, 2000, 43, 100, 5.5, 7.8, 0, 2000),
(5, 'Blewah', 22, 30, 400, 700, 24, 80, 5.8, 7.6, 0, 2000),
(6, 'Cempedak', 22, 28, 1000, 2000, 0, 100, 5, 6, 0, 2000),
(7, 'Carica', 10, 20, 1000, 2000, 43, 100, 5.5, 7.8, 0, 2000),
(8, 'Duku', 25, 28, 2000, 3000, 0, 100, 5, 6, 0, 650),
(9, 'Durian', 25, 28, 2000, 3000, 43, 100, 5.5, 7.8, 100, 500),
(10, 'Jambu biji', 22, 28, 1000, 2000, 0, 100, 5, 6, 5, 1200),
(11, 'Jambu Siam', 22, 28, 1000, 2000, 0, 100, 5, 6, 0, 1000),
(12, 'Jambu Mente', 25, 28, 1200, 1500, 0, 100, 5.2, 7.2, 0, 2000),
(13, 'Jeruk', 19, 33, 1200, 3000, 50, 90, 5.5, 7.6, 0, 1200),
(14, 'Kelengkeng', 18, 25, 1000, 2000, 43, 100, 5.5, 7.8, 0, 600),
(15, 'Kepayang', 18, 25, 1000, 2000, 43, 100, 5.5, 7.8, 0, 2000),
(16, 'Kesemek', 18, 20, 1000, 2000, 43, 100, 5.5, 7.8, 0, 2000),
(17, 'Mangga', 22, 28, 1250, 1750, 43, 100, 5.5, 7.8, 0, 500),
(18, 'Manggis', 20, 23, 1250, 1750, 0, 100, 5, 6, 0, 1500),
(19, 'Markisa', 16, 18, 2000, 2500, 0, 100, 5.5, 7.3, 0, 2000),
(20, 'Melon', 22, 30, 400, 700, 24, 80, 5.8, 7.6, 0, 2000),
(21, 'Nanas', 20, 26, 1000, 1600, 50, 100, 5, 6.5, 0, 2000),
(22, 'Nangka', 22, 28, 1500, 2000, 0, 100, 5, 6, 0, 1300),
(23, 'Pepaya', 25, 28, 1000, 1500, 24, 80, 6, 6.6, 0, 1000),
(24, 'Pisang', 25, 27, 1500, 2500, 60, 100, 5.6, 7.8, 0, 1200),
(25, 'Rambutan', 25, 28, 2000, 3000, 0, 100, 5, 6, 30, 500),
(26, 'Salak', 22, 28, 1000, 2000, 0, 100, 6, 7, 0, 2000),
(27, 'Sawo', 18, 25, 1000, 2000, 43, 100, 5.5, 7.8, 0, 1200),
(28, 'Semangka', 22, 30, 400, 700, 24, 80, 5.8, 7.6, 0, 2000),
(29, 'Sirsak', 18, 25, 1000, 2500, 43, 100, 5.5, 6.5, 0, 1000),
(30, 'Srikaya', 18, 25, 1000, 2000, 43, 100, 5.5, 6.5, 0, 1000),
(31, 'Strawberi', 10, 18, 1000, 2000, 43, 100, 5.5, 7.3, 1000, 2000),
(32, 'Sukun', 22, 28, 1000, 2500, 0, 100, 5, 6, 0, 2000),
(33, 'Tomat buah', 18, 26, 400, 2000, 24, 80, 6, 7.5, 0, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `climate`
--

CREATE TABLE `climate` (
  `id` int(11) NOT NULL,
  `region` varchar(100) NOT NULL,
  `average_temp` float NOT NULL,
  `rainfall` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `climate`
--

INSERT INTO `climate` (`id`, `region`, `average_temp`, `rainfall`) VALUES
(1, 'Lebak', 27.557, 1833.7),
(2, 'Serang', 27.775, 1950.26),
(3, 'Tangerang', 28.1, 1726.98),
(4, 'Pandeglang', 26.8, 2115.78),
(5, 'Cilegon', 27.4917, 2303);

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` varchar(10) NOT NULL,
  `token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `token`) VALUES
('frw7Uby', 'YVqLANUGQDSPlgtXUW2rEH5LO333qcmP');

-- --------------------------------------------------------

--
-- Table structure for table `measurement_history`
--

CREATE TABLE `measurement_history` (
  `id` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `device_id` varchar(50) NOT NULL,
  `average_temp` float NOT NULL,
  `rainfall` float NOT NULL,
  `humidity` float NOT NULL,
  `ph` float NOT NULL,
  `elevation` float NOT NULL,
  `lat` varchar(20) NOT NULL,
  `lng` varchar(50) NOT NULL,
  `place_name` text NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `measurement_history`
--

INSERT INTO `measurement_history` (`id`, `user_id`, `device_id`, `average_temp`, `rainfall`, `humidity`, `ph`, `elevation`, `lat`, `lng`, `place_name`, `timestamp`) VALUES
('762f0e4c4513fc', 4, 'frw7Uby', 28.5, 1726.98, 63, 7.25, 33, '-6.2381', '106.5211', 'Tangerang', 1659954380),
('762f0f1e24193f', 4, 'frw7Uby', 28.5, 1726.98, 63, 7.39, 33, '-6.2381', '106.5211', 'Tangerang', 1659957733),
('762f0f5ce04358', 4, 'frw7Uby', 28.5, 1726.98, 63, 3.85, 33, '-6.2381', '106.5211', 'Tangerang', 1659958736),
('762f0fb364e761', 4, 'frw7Uby', 26.41, 2115.78, 63, 7.39, 165, '-6.3208735', '106.118487', 'Pandeglang', 1659960130),
('762f0fbe87a103', 4, 'frw7Uby', 28.5, 1726.98, 63, 6.35, 33, '-6.2381', '106.5211', 'Tangerang', 1659960301),
('762f0fca9deb99', 4, 'frw7Uby', 28.5, 1726.98, 63, 6.69, 33, '-6.2381', '106.5211', 'Tangerang', 1659960492);

-- --------------------------------------------------------

--
-- Table structure for table `measurement_result`
--

CREATE TABLE `measurement_result` (
  `id` int(11) NOT NULL,
  `measurement_history_id` int(11) NOT NULL,
  `classification_id` int(11) NOT NULL,
  `average_temp` tinyint(1) NOT NULL,
  `rainfall` tinyint(1) NOT NULL,
  `humidity` tinyint(1) NOT NULL,
  `ph` tinyint(1) NOT NULL,
  `elevation` tinyint(1) NOT NULL,
  `distance` float NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `device_id` varchar(7) NOT NULL DEFAULT '0',
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `device_id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'frw7Uby', 'Riyan Husen', 'admin@gmail.com', 'avatar1.png', '$2y$10$saSay36tf7YVknoV/6wk3.M0q22Aub8szDTz21FVGXuWa0E1Gteym', 1, 1, 1653375489),
(4, 'frw7Uby', 'Riyan Husen', 'member@gmail.com', 'default.webp', '$2y$10$TqcO1ZcCLKaOMf6DDdD2puR2xjiVFjWo7158cdWULt4CP6mSJgAyq', 2, 1, 1653376121),
(10, '0', 'Didin', 'Didin@gmail.com', 'default.webp', '$2y$10$W4Z74IA/XwPTfV8tUH.xaOnfZ/BesZs6T2JWH9AdoF/kHgtSjkvzK', 2, 1, 1653377678),
(12, '0', 'Lily', 'juliabahar70@gmail.com', 'default.webp', '$2y$10$z/UpIi0T4MFN4dDfx.eVjuuo01PG2CLkAjDFHoaeLAQiqs12jsvdi', 2, 1, 1653735926);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(7, 2, 2),
(12, 1, 6),
(13, 3, 3),
(15, 3, 2),
(16, 1, 7),
(19, 2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'Member'),
(3, 'Menu'),
(7, 'Klasifikasi'),
(9, 'Iklim');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Main Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'Beranda', 'member', 'fas fa-fw fa-home', 1),
(3, 3, 'Manajemen Menu', 'menu', 'fas fa-fw fa-folder', 1),
(4, 3, 'Manajemen Sub Menu', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(7, 1, 'Akses Pengguna', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(8, 1, 'Kelola Pengguna', 'admin/users', 'fas fa-fw fa-users', 1),
(9, 1, 'Kelola Perangkat', 'admin/devices', 'fas fa-fw fa-microchip', 1),
(10, 2, 'Seleksi Tanaman', 'member/selection', 'fas fa-fw fa-seedling', 1),
(11, 2, 'Riwayat Seleksi', 'member/histories', 'fas fa-fw fa-history', 1),
(12, 2, 'Perangkat Saya', 'member/mydevice', 'fas fa-fw fa-microchip', 1),
(13, 7, 'Kesesuaian Lahan', 'klasifikasi', 'fas fa-fw fa-tree', 1),
(14, 9, 'Curah Hujan dan Suhu', 'iklim', 'fas fa-fw fa-cloud-sun-rain', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classification`
--
ALTER TABLE `classification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `climate`
--
ALTER TABLE `climate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `measurement_history`
--
ALTER TABLE `measurement_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `measurement_result`
--
ALTER TABLE `measurement_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classification`
--
ALTER TABLE `classification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `climate`
--
ALTER TABLE `climate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `measurement_result`
--
ALTER TABLE `measurement_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
