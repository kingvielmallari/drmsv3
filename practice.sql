-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2025 at 05:54 PM
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
-- Database: `practice`
--

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(15) NOT NULL,
  `code` varchar(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(15) NOT NULL,
  `is_available` enum('yes','no') NOT NULL DEFAULT 'yes',
  `eta` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `code`, `name`, `price`, `is_available`, `eta`) VALUES
(1, 'COG', 'Certificate of Grades', 150, 'yes', 1),
(2, 'COR', 'Certificate of Registration', 150, 'yes', 1),
(3, 'TOR', 'Transcript of Records', 300, 'yes', 14);

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` int(11) NOT NULL,
  `amount` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `amount`) VALUES
(1, 30);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_id` varchar(15) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `program` enum('BSIT','BSOA','CCS','') NOT NULL,
  `year` enum('1','2','3','4') NOT NULL,
  `section` varchar(5) NOT NULL,
  `status` enum('Regular','Irregular') NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `last_name`, `first_name`, `middle_name`, `email`, `gender`, `program`, `year`, `section`, `status`, `password`) VALUES
(1, '23BSIT-0121', 'Abagat', 'Jazmine Louise', 'Joseph', 'jjabagat@paterostechnologicalcollege.edu.ph', 'Female', 'BSIT', '2', 'C', 'Regular', '$2y$10$x7Mig0lQQJbHN4WzZHFjC.y2Mr6ea3WaOJfW1QtIPm1xMqrdFMFxi'),
(2, '24BSIT-2024', 'Mallari', 'King Viel', 'Labro', 'klmallari@paterostechnologicalcollege.edu.ph', 'Male', 'BSIT', '4', 'A', 'Regular', '$2y$10$YOzGIzg3HsEd/kgzfmqa6OAenWlsxF9hRPxexiYRghevsVGencNSe'),
(3, '25BSOA-2025', 'Parman', 'Bernadette', 'Mendoza', 'bm@paterostechnologicalcollege.edu.ph', 'Female', 'BSOA', '4', 'A', 'Regular', '$2y$10$AZeA292sGqXIokaTYXjMI.h0D8X8chNhc/Nd6TFqfh9cl3RrDsAiG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
