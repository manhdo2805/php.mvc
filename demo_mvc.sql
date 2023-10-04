-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2023 at 04:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo_mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `email` varchar(64) DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `first_name` varchar(64) DEFAULT NULL,
  `last_name` varchar(64) DEFAULT NULL,
  `phone_number` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `phone_number`) VALUES
(10, 'bilgate1', 'bilgate@gmail.com', '', NULL, NULL, NULL),
(11, 'stevejob', 'stevejob@gmail.com', '', NULL, NULL, NULL),
(12, 'stevejob', 'stevejob@gmail.com', '', NULL, NULL, NULL),
(16, 'gastown', 'gastown@outlook.com', '', NULL, NULL, NULL),
(17, 'library', 'library@verizon.net', '', NULL, NULL, NULL),
(18, 'penna', 'penna@mac.com', '', NULL, NULL, NULL),
(19, 'amichalo', 'amichalo@live.com', '', NULL, NULL, NULL),
(20, 'microfab', 'microfab@att.net', '', NULL, NULL, NULL),
(21, 'enintend', 'enintend@msn.com', '', NULL, NULL, NULL),
(22, 'seurat', 'seurat@hotmail.com', '', NULL, NULL, NULL),
(23, 'gward', 'gward@msn.com', '', NULL, NULL, NULL),
(24, 'mddallara', 'mddallara@mac.com', '', NULL, NULL, NULL),
(25, 'odlyzko', 'odlyzko@comcast.net', '', NULL, NULL, NULL),
(26, 'frikazoyd', 'frikazoyd@sbcglobal.net', '', NULL, NULL, NULL),
(27, 'crobles', 'crobles@live.com', '', NULL, NULL, NULL),
(28, 'parksh', 'parksh@yahoo.com', '', NULL, NULL, NULL),
(29, 'kobayasi', 'kobayasi@aol.com', '', NULL, NULL, NULL),
(30, 'bmidd', 'bmidd@gmail.com', '', NULL, NULL, NULL),
(31, 'hmbrand', 'hmbrand@live.com', '', NULL, NULL, NULL),
(32, 'farber', 'farber@outlook.com', '', NULL, NULL, NULL),
(33, 'syrinx', 'syrinx@optonline.net', '', NULL, NULL, NULL),
(34, 'mosses', 'mosses@aol.com', '', NULL, NULL, NULL),
(35, 'giafly', 'giafly@verizon.net', '', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
