-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2026 at 05:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `civil_registry_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `birth_certificates`
--

CREATE TABLE `birth_certificates` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `place_of_birth` varchar(100) NOT NULL,
  `father_name` varchar(150) NOT NULL,
  `father_nid` varchar(50) NOT NULL,
  `mother_name` varchar(150) NOT NULL,
  `mother_nid` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `birth_certificates`
--

INSERT INTO `birth_certificates` (`id`, `first_name`, `middle_name`, `last_name`, `gender`, `dob`, `place_of_birth`, `father_name`, `father_nid`, `mother_name`, `mother_nid`, `address`, `phone_number`, `created_at`) VALUES
(1, 'mahir', 'ibrahim', 'ahmed', 'Male', '2007-02-02', 'dakhtarka weyn', 'ibrahim ahmed wasame', '0024', 'canab yusuf ducale', '0255', 'masalaha', '2345678', '2026-07-03 19:51:45'),
(2, 'ismacil', 'rabiic', 'deeq', 'Male', '2007-02-01', 'hargaisa', 'rabiic deeq muxumed', '0034', 'fadumo maxamud ahmed', '0028', 'siinay', '3456789', '2026-07-03 23:52:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT 'admin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'yusuf ibrahim', 'yusuf@government.so', 'admin123', 'admin', '2026-07-03 05:24:26'),
(2, 'yusuf ibrahim ahmed', 'yusuf2@gmal.com', '$2y$10$3/YM5VtWpiKZ50kman5qTOHOMSEDalN9jxki9uT4WkTDC/uKq5uFy', 'admin', '2026-07-03 07:03:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `birth_certificates`
--
ALTER TABLE `birth_certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `birth_certificates`
--
ALTER TABLE `birth_certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
