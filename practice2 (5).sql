-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2025 at 04:12 PM
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
  `eta` int(15) NOT NULL,
  `doc_type` enum('Official','Certification') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `code`, `name`, `price`, `is_available`, `eta`, `doc_type`) VALUES
(45, 'COG', 'Certificate Of Grades', 50, 'yes', 1, 'Official'),
(46, 'COR', 'Certificate Of Registration', 50, 'yes', 1, 'Official'),
(47, 'TOR', 'Transcript Of Records', 200, 'yes', 14, 'Official'),
(48, 'HD', 'Honorable Dismissal', 100, 'yes', 1, 'Official'),
(50, 'GM', 'Good Moral', 80, 'yes', 1, 'Official'),
(58, 'CTC', 'CTC - Certificate of Registration', 50, 'yes', 1, 'Certification'),
(59, 'CTC', 'CTC - Certificate of Grades', 50, 'yes', 1, 'Certification'),
(60, 'F13', 'Form 137', 50, 'yes', 1, 'Certification');

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
(1, 10);

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

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `request_id` varchar(10) NOT NULL,
  `student_id` varchar(20) DEFAULT NULL,
  `student_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `program_section` varchar(50) NOT NULL,
  `document_request` varchar(150) NOT NULL,
  `delivery_option` enum('Cashier','Gcash') NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `date_releasing` date DEFAULT NULL,
  `processing_officer` varchar(100) DEFAULT NULL,
  `status` enum('Received','Declined','Processing','Releasing','Released','Expired') NOT NULL DEFAULT 'Received',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `request_id`, `student_id`, `student_name`, `email`, `program_section`, `document_request`, `delivery_option`, `appointment_date`, `appointment_time`, `total_price`, `date_releasing`, `processing_officer`, `status`, `created_at`) VALUES
(107, 'PTC-449569', '2021-3537', 'King Viel L. Mallari', 'klmallari@paterostechnologicalcollege.edu.ph', 'BSIT - 4A (Regular)', 'CTC - Certificate of Grades', 'Cashier', '2025-05-08', '02:00:00', 60.00, NULL, NULL, 'Received', '2025-04-29 02:07:48'),
(108, 'PTC-216281', '2021-3537', 'King Viel L. Mallari', 'klmallari@paterostechnologicalcollege.edu.ph', 'BSIT - 4A (Regular)', 'CTC - Certificate of Registration', 'Cashier', '2025-05-08', '04:00:00', 60.00, NULL, NULL, 'Received', '2025-04-29 02:08:12'),
(109, '', '2021-3537', 'King Viel L. Mallari', 'klmallari@paterostechnologicalcollege.edu.ph', 'BSIT - 4A (Regular)', 'Certificate Of Grades (2nd Year 2nd Sem)', 'Cashier', '2025-05-01', '03:00:00', 60.00, NULL, NULL, 'Received', '2025-04-29 02:24:18');

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
(1, 'Julius Codilan', 'mishead', 'king', 'mis_head'),
(2, 'King Viel Mallari', 'misstaff', 'king', 'mis_staff'),
(3, 'Melissa Patco', 'reghead', 'king', 'reg_head'),
(4, 'King Viel Mallari', 'regstaff', 'king', 'reg_staff');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_id` varchar(15) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `program` enum('BSIT','BSOA','CCS') DEFAULT NULL,
  `year` enum('1','2','3','4') DEFAULT NULL,
  `section` varchar(5) DEFAULT NULL,
  `status` enum('Regular','Irregular','Graduated') DEFAULT NULL,
  `year_graduated` year(4) DEFAULT NULL,
  `last_year_attended` year(4) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `last_name`, `first_name`, `middle_name`, `email`, `gender`, `program`, `year`, `section`, `status`, `year_graduated`, `last_year_attended`, `password`) VALUES
(26, '2021-3537', 'Mallari', 'King Viel', 'Labro', 'klmallari@paterostechnologicalcollege.edu.ph', 'Male', 'BSIT', '4', 'A', 'Regular', NULL, NULL, '$2y$10$FXVR7yIXGiXRkw6zS45rGOnfWkBAmPculkX0yMWq2j9P/PGOgpKXy'),
(28, NULL, 'Parman', 'Bernadette', 'Mendoza', 'mallariking0@gmail.com', 'Male', NULL, NULL, NULL, 'Graduated', '2025', '2025', '$2y$10$.3yIg.GCVgFBhBGP.1vJ0uwiaZn0qaMHGU2OKqlwEtRWQWaq8qjTe'),
(29, '2021-3080', 'Perez', 'Sean Ray', 'Dapon', 'sdperez@paterostechnologicalcollege.edu.ph', 'Male', 'BSIT', '4', 'A', 'Regular', NULL, NULL, '$2y$10$oAnLpksodlbvZ0CnJwQksObPTt5ztJysXYf2tonsSSPF946997FKi');

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
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
