-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2018 at 02:34 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `the_school`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_number` int(20) NOT NULL,
  `name` varchar(256) COLLATE utf8_bin NOT NULL,
  `description` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `img` text COLLATE utf8_bin,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `id` int(20) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `role` int(11) NOT NULL,
  `phone` varchar(20) COLLATE utf8_bin NOT NULL,
  `email` varchar(256) COLLATE utf8_bin NOT NULL,
  `img` text COLLATE utf8_bin,
  `password` varchar(256) COLLATE utf8_bin NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`id`, `name`, `role`, `phone`, `email`, `img`, `password`, `is_deleted`) VALUES
(1, 'admin', 1, '0528011387', 'admin@admin.com', NULL, '$2y$10$3Wv5lEhzTfFgL1SAe2ZNi.SlXGM9THCiQmsigHz.g4DcYkdDpDcr6', 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(20) NOT NULL,
  `name` varchar(256) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'owner'),
(2, 'manager'),
(3, 'sales');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(20) NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `phone` varchar(20) COLLATE utf8_bin NOT NULL,
  `email` varchar(256) COLLATE utf8_bin NOT NULL,
  `img` text COLLATE utf8_bin,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `students2courses`
--

CREATE TABLE `students2courses` (
  `id` int(20) NOT NULL,
  `s_id` int(20) NOT NULL,
  `c_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_messages`
--

CREATE TABLE `user_messages` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user_messages`
--

INSERT INTO `user_messages` (`id`, `name`, `description`) VALUES
(1, 'name', 'The name is invalid. Cannot be empty.'),
(2, 'password', 'Invalid password. must be 6-10 chars long with at least 1 number, 1 letter and no special chars.'),
(3, 'failed_login', 'User email and password do not match.'),
(4, 'session_timeout', 'Your session has timed out please login again.'),
(5, 'unauthorized', 'You are not authorized to perofrm this action'),
(6, 'general', 'General error. please contact your site administrator.'),
(7, 'success', 'Details have been successfully saved'),
(8, 'email_pattern', 'Invalid email pattern.'),
(9, 'email_exists', 'Email already exists. must be unique'),
(10, 'course_number', 'Invalid course number . should be 4-6 digits.'),
(11, 'course_number_unique', 'Course number already exists. should be unique.'),
(12, 'description', 'Description is invalid . cannot be empty.'),
(13, 'file_type', 'File type is not adquate. please upload only images'),
(14, 'file_general', 'Something is wrong with the file. please try again or replace it.'),
(15, 'phone', 'phone should be between 9 to 13 digits.'),
(16, 'role', 'Role is invalid.'),
(17, 'password_retype', 'Retype password doesn\'t match the password value.'),
(18, 'password_old', 'Old password is incorrect.'),
(19, 'course_name_unique', 'Course name already exists. Must be unique'),
(20, 'course_doesnt_exist', 'A course you requested is not in our available courses. Please select again');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_number` (`id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`id`);

--
-- Indexes for table `students2courses`
--
ALTER TABLE `students2courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_messages`
--
ALTER TABLE `user_messages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students2courses`
--
ALTER TABLE `students2courses`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_messages`
--
ALTER TABLE `user_messages`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
