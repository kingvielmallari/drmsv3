-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2025 at 04:49 PM
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
-- Database: `practice2`
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
(1, 'COG', 'Certificate of Grades', 150, 'no', 1),
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
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(64) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `expires_at`, `created_at`) VALUES
(6, 'klmallari@paterostechnologicalcollege.edu.ph', '832d44c1db3f82d364252fb6d250217394506d5d059d41c61918167d56faeab2', '2025-04-21 14:34:47', '2025-04-21 06:29:47');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `program_section` varchar(50) NOT NULL,
  `document_request` varchar(150) NOT NULL,
  `delivery_option` enum('pickup','delivery') DEFAULT 'pickup',
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `student_id`, `student_name`, `program_section`, `document_request`, `delivery_option`, `appointment_date`, `appointment_time`, `total_price`, `created_at`) VALUES
(1, '23BSIT-0121', 'Jazmine Louise J. Abagat', 'BSIT - 2C (Regular)', 'Certificate of Grades (4th Year, 1st Sem)', 'pickup', '0000-00-00', '10:00:00', 180.00, '2025-04-14 01:56:35'),
(2, '23BSIT-0121', 'Jazmine Louise J. Abagat', 'BSIT - 2C (Regular)', 'Certificate of Grades (4th Year, 2nd Sem)', 'pickup', '2025-04-23', '11:00:00', 180.00, '2025-04-14 02:03:12'),
(3, '23BSIT-0121', 'Jazmine Louise J. Abagat', 'BSIT - 2C (Regular)', 'Certificate of Grades (2nd Year, 1st Sem), Certificate of Registration (4th Year, 1st Sem), Transcript of Records', 'pickup', '2025-04-16', '04:00:00', 630.00, '2025-04-14 02:10:53'),
(5, '23BSIT-0121', 'Jazmine Louise J. Abagat', 'BSIT - 2C (Regular)', 'Certificate of Grades (4th Year, 2nd Sem)', 'pickup', '2025-04-17', '11:00:00', 180.00, '2025-04-15 00:40:24'),
(6, '23BSIT-0121', 'Jazmine Louise J. Abagat', 'BSIT - 2C (Regular)', 'Transcript of Records', 'pickup', '2025-04-24', '11:00:00', 330.00, '2025-04-15 00:59:42'),
(7, '23BSIT-0121', 'Jazmine Louise J. Abagat', 'BSIT - 2C (Regular)', 'Certificate of Registration (4th Year, 1st Sem)', 'pickup', '2025-04-22', '10:00:00', 180.00, '2025-04-15 01:01:43'),
(8, '23BSIT-0121', 'Jazmine Louise J. Labagat', 'BSIT - 2C (Regular)', 'Transcript of Records', 'pickup', '2025-04-25', '09:00:00', 330.00, '2025-04-21 05:14:01');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('mis_head','mis_staff','reg_head','reg_staff') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `username`, `password`, `role`) VALUES
(1, 'King Viel Mallari', 'mishead', 'king', 'mis_head'),
(2, 'King Viel Mallari', 'misstaff', 'king', 'mis_staff'),
(3, 'King Viel Mallari', 'reghead', 'king', 'reg_head'),
(4, 'King Viel Mallari', 'regstaff', 'king', 'reg_staff');

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
  `program` enum('BSIT','BSOA','CCS') NOT NULL,
  `year` enum('1','2','3','4') NOT NULL,
  `section` varchar(5) NOT NULL,
  `status` enum('Regular','Irregular') NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `last_name`, `first_name`, `middle_name`, `email`, `gender`, `program`, `year`, `section`, `status`, `password`) VALUES
(1, '23BSIT-0121', 'Labagat', 'Jazmine Louise', 'Joseph', 'jjabagat@paterostechnologicalcollege.edu.ph', 'Female', 'BSIT', '2', 'C', 'Regular', '$2y$10$X9lL/hIhG2yTT95/dw1Om.kfT4bTNqtyb5XOVZO.Y6pKTTS64FWRq'),
(2, '25CCS-2025', 'Mallari', 'Viel King', 'Labro', 'klmallari@paterostechnologicalcollege.edu.ph', 'Male', 'BSIT', '4', 'A', 'Irregular', '$2y$10$X9lL/hIhG2yTT95/dw1Om.kfT4bTNqtyb5XOVZO.Y6pKTTS64FWRq'),
(3, '25BSOA-2025', 'Parman', 'Bernadette Parman', 'Mendoza', 'mallariking0@gmail.com', 'Female', 'BSOA', '4', 'A', 'Regular', '$2y$10$X9lL/hIhG2yTT95/dw1Om.kfT4bTNqtyb5XOVZO.Y6pKTTS64FWRq');

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
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
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
