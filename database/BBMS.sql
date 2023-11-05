-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 05, 2023 at 02:34 PM
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
-- Database: `BBMS`
--

-- --------------------------------------------------------

--
-- Table structure for table `blood`
--

CREATE TABLE `blood` (
  `id` bigint(20) NOT NULL,
  `AP` bigint(20) DEFAULT NULL,
  `AN` bigint(20) DEFAULT NULL,
  `BP` bigint(20) DEFAULT NULL,
  `BN` bigint(20) DEFAULT NULL,
  `ABP` bigint(20) DEFAULT NULL,
  `ABN` bigint(20) DEFAULT NULL,
  `OP` bigint(20) DEFAULT NULL,
  `ON` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood`
--

INSERT INTO `blood` (`id`, `AP`, `AN`, `BP`, `BN`, `ABP`, `ABN`, `OP`, `ON`) VALUES
(1, 0, 2, 3, 4, 3, 2, 7, 4);

-- --------------------------------------------------------

--
-- Table structure for table `donate`
--

CREATE TABLE `donate` (
  `id` bigint(20) NOT NULL,
  `donor_id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `disease` varchar(255) NOT NULL,
  `blood` varchar(10) NOT NULL,
  `unit` bigint(20) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donate`
--

INSERT INTO `donate` (`id`, `donor_id`, `username`, `disease`, `blood`, `unit`, `status`) VALUES
(4, 4, 'tester', 'asdaef', 'AB+', 3, 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `blood` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`id`, `name`, `username`, `email`, `pwd`, `blood`) VALUES
(4, 'tester', 'tester', 'tester@gmail.com', '$2y$10$GmEZ9574xLwBHLs0pKl8MuhLBRSetQU7VfaV/tO26F4TxsjyeaxlC', 'AB+');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `blood` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `name`, `username`, `email`, `pwd`, `blood`) VALUES
(7, 'tester', 'tester', 'tester@gmail.com', '$2y$10$v39CpZRtkDUewu4KMHD0YeKYEXx0yJPlwovAub6PauJryTHcgcNQS', 'A-');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` bigint(20) NOT NULL,
  `patient_id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `blood` varchar(10) NOT NULL,
  `unit` bigint(20) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `patient_id`, `username`, `reason`, `blood`, `unit`, `status`) VALUES
(1, 7, 'test', 'adasd', 'A-', 1, 'approved'),
(2, 7, 'tester2', 'adasd', 'A-', 5, 'rejected due to insufficient blood stock of A- '),
(3, 7, 'tester', 'hhghg', 'A-', 6, 'approved'),
(4, 7, 'tester', 'fsgb', 'A-', 5, 'rejected due to insufficient blood stock of A-'),
(6, 7, 'tester', 'dfndfjs', 'A-', 2, 'approved'),
(7, 7, 'tester', 'gdh', 'A-', 4, 'rejected due to insufficient blood stock of A-');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blood`
--
ALTER TABLE `blood`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donate`
--
ALTER TABLE `donate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blood`
--
ALTER TABLE `blood`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `donate`
--
ALTER TABLE `donate`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
