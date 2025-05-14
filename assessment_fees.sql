-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2025 at 03:24 PM
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
-- Database: `ptcdatabase2`
--

-- --------------------------------------------------------

--
-- Table structure for table `assessment_fees`
--

CREATE TABLE `assessment_fees` (
  `id` int(11) NOT NULL,
  `payment_name` varchar(255) NOT NULL,
  `paying_new` decimal(10,2) DEFAULT NULL,
  `paying_old` decimal(10,2) DEFAULT NULL,
  `unifast_new` decimal(10,2) DEFAULT NULL,
  `unifast_old` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assessment_fees`
--

INSERT INTO `assessment_fees` (`id`, `payment_name`, `paying_new`, `paying_old`, `unifast_new`, `unifast_old`) VALUES
(1, 'Registration Fee', NULL, NULL, NULL, NULL),
(2, 'Library Fee', 1.00, NULL, NULL, NULL),
(3, 'Publication (PLUMAGE)', NULL, NULL, NULL, NULL),
(4, 'Athletic Fee', NULL, NULL, NULL, NULL),
(5, 'Cultural Fee', NULL, NULL, NULL, NULL),
(6, 'Supreme Student Council (SSC)', NULL, NULL, NULL, NULL),
(7, 'Guidance Fee', NULL, NULL, NULL, NULL),
(8, 'Career Development', NULL, NULL, NULL, NULL),
(9, 'Student Handbook', NULL, NULL, NULL, NULL),
(10, 'Medical and Dental Fee', NULL, NULL, NULL, NULL),
(11, 'Insurance Fee', NULL, NULL, NULL, NULL),
(12, 'ID Validation Fee', NULL, NULL, NULL, NULL),
(13, 'LMS', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assessment_fees`
--
ALTER TABLE `assessment_fees`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assessment_fees`
--
ALTER TABLE `assessment_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
