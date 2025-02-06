-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2025 at 10:28 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `import`
--

-- --------------------------------------------------------

--
-- Table structure for table `t2mis`
--

CREATE TABLE `t2mis` (
  `id` int(10) NOT NULL,
  `RMQ` varchar(255) DEFAULT NULL,
  `QUALIFICATION` varchar(255) DEFAULT NULL,
  `A` text DEFAULT NULL,
  `B` text DEFAULT NULL,
  `C` text DEFAULT NULL,
  `D` text DEFAULT NULL,
  `E` text DEFAULT NULL,
  `F` text DEFAULT NULL,
  `G` text DEFAULT NULL,
  `H` text DEFAULT NULL,
  `I` text DEFAULT NULL,
  `J` text DEFAULT NULL,
  `K` text DEFAULT NULL,
  `L` text DEFAULT NULL,
  `M` text DEFAULT NULL,
  `N` text DEFAULT NULL,
  `O` text DEFAULT NULL,
  `P` text DEFAULT NULL,
  `Q` text DEFAULT NULL,
  `R` text DEFAULT NULL,
  `S` text DEFAULT NULL,
  `T` text DEFAULT NULL,
  `U` text DEFAULT NULL,
  `V` text DEFAULT NULL,
  `W` text DEFAULT NULL,
  `X` text DEFAULT NULL,
  `Y` text DEFAULT NULL,
  `Z` text DEFAULT NULL,
  `AA` text DEFAULT NULL,
  `AB` text DEFAULT NULL,
  `AC` text DEFAULT NULL,
  `AD` text DEFAULT NULL,
  `AE` text DEFAULT NULL,
  `AF` text DEFAULT NULL,
  `AG` text DEFAULT NULL,
  `AH` text DEFAULT NULL,
  `AI` text DEFAULT NULL,
  `AJ` text DEFAULT NULL,
  `AK` text DEFAULT NULL,
  `AL` text DEFAULT NULL,
  `AM` text DEFAULT NULL,
  `AN` text DEFAULT NULL,
  `AO` text DEFAULT NULL,
  `AP` text DEFAULT NULL,
  `AQ` varchar(255) DEFAULT NULL,
  `AR` text DEFAULT NULL,
  `AS1` text DEFAULT NULL,
  `AT` text DEFAULT NULL,
  `AU` text DEFAULT NULL,
  `AV` text DEFAULT NULL,
  `AW` varchar(255) NOT NULL,
  `AX` varchar(255) NOT NULL,
  `AY` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t2mis`
--
ALTER TABLE `t2mis`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t2mis`
--
ALTER TABLE `t2mis`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
