-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 08, 2021 at 03:15 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iCollege`
--

-- --------------------------------------------------------

--
-- Table structure for table `iCollege_admin`
--

CREATE TABLE `iCollege_admin` (
  `id` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iCollege_admin`
--

INSERT INTO `iCollege_admin` (`id`, `email`, `password`) VALUES
('a69681bcf334ae130217fea4505fd3c994f5683f', 'sysadmin@iCollege.org', 'a69681bcf334ae130217fea4505fd3c994f5683f');

-- --------------------------------------------------------

--
-- Table structure for table `iCollege_courses`
--

CREATE TABLE `iCollege_courses` (
  `id` varchar(200) NOT NULL,
  `code` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `hod` varchar(200) NOT NULL,
  `details` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iCollege_enrollments`
--

CREATE TABLE `iCollege_enrollments` (
  `id` varchar(200) NOT NULL,
  `std_regno` varchar(200) NOT NULL,
  `std_name` varchar(200) NOT NULL,
  `unit_code` varchar(200) NOT NULL,
  `unit_name` varchar(200) NOT NULL,
  `semester_enrolled` varchar(200) NOT NULL,
  `academic_year_enrolled` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iCollege_exammarks`
--

CREATE TABLE `iCollege_exammarks` (
  `id` varchar(200) NOT NULL,
  `course_id` varchar(200) NOT NULL,
  `course_name` varchar(200) NOT NULL,
  `unit_code` varchar(200) NOT NULL,
  `unit_name` varchar(200) NOT NULL,
  `std_regno` varchar(200) NOT NULL,
  `std_name` varchar(200) NOT NULL,
  `semester_enrolled` varchar(200) NOT NULL,
  `academic_year` varchar(200) NOT NULL,
  `marks` varchar(200) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iCollege_fees_payments`
--

CREATE TABLE `iCollege_fees_payments` (
  `id` varchar(200) NOT NULL,
  `std_regno` varchar(200) NOT NULL,
  `std_name` varchar(200) NOT NULL,
  `amt_billed` varchar(200) NOT NULL,
  `amt_paid` varchar(200) NOT NULL,
  `payment_means` varchar(200) NOT NULL,
  `payment_code` varchar(200) NOT NULL,
  `date_paid` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iCollege_lecturers`
--

CREATE TABLE `iCollege_lecturers` (
  `id` varchar(200) NOT NULL,
  `number` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `idno` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `dpic` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iCollege_parents`
--

CREATE TABLE `iCollege_parents` (
  `id` int(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `idno` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `adr` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `iCollege_Settings`
--

CREATE TABLE `iCollege_Settings` (
  `sys_id` varchar(200) NOT NULL,
  `sys_name` varchar(200) NOT NULL,
  `sys_logo` varchar(200) NOT NULL,
  `sys_tagline` longblob NOT NULL,
  `sys_mail` varchar(200) NOT NULL,
  `sys_phone_contact` varchar(200) NOT NULL,
  `sys_about` longblob NOT NULL,
  `sys_googlemap` longblob NOT NULL,
  `sys_fb` varchar(200) NOT NULL,
  `sys_twitter` varchar(200) NOT NULL,
  `sys_ig` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iCollege_Settings`
--

INSERT INTO `iCollege_Settings` (`sys_id`, `sys_name`, `sys_logo`, `sys_tagline`, `sys_mail`, `sys_phone_contact`, `sys_about`, `sys_googlemap`, `sys_fb`, `sys_twitter`, `sys_ig`) VALUES
('a69681bcf334ae130217fea4505fd3c994f5683f', 'AUTOMATED ACADEMIC SYSTEM', 'logo.png', 0x496e7374696c6c696e6720496e6e6f766174696f6e204f6e2041636164656d696373, 'hello@icollege.org', '+254737229776', 0x3c703e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e3c2f703e0d0a, 0x3c696672616d65207372633d5c2268747470733a2f2f7777772e676f6f676c652e636f6d2f6d6170732f656d6265643f70623d21316d313421316d313221316d3321316431353935332e35383732323739373232373221326433372e32373436373632343334383631342133642d312e3532393439393834323938363521326d3321316630213266302133663021336d322131693130323421326937363821346631332e312135653021336d32213173656e2132736b652134763136313432333738373334353521356d32213173656e2132736b655c222077696474683d5c223630305c22206865696768743d5c223435305c22207374796c653d5c22626f726465723a303b5c2220616c6c6f7766756c6c73637265656e3d5c225c22206c6f6164696e673d5c226c617a795c223e3c2f696672616d653e, 'iCollege', '@iCollege', 'iCollege');

-- --------------------------------------------------------

--
-- Table structure for table `iCollege_students`
--

CREATE TABLE `iCollege_students` (
  `id` varchar(200) NOT NULL,
  `admno` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `idno` varchar(200) NOT NULL,
  `adr` varchar(200) NOT NULL,
  `sex` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `dpic` varchar(200) NOT NULL,
  `course_name` varchar(200) NOT NULL,
  `parent_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iCollege_termdates`
--

CREATE TABLE `iCollege_termdates` (
  `id` int(20) NOT NULL,
  `date` varchar(200) NOT NULL,
  `details` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `iCollege_timetable`
--

CREATE TABLE `iCollege_timetable` (
  `id` varchar(200) NOT NULL,
  `course_name` varchar(200) NOT NULL,
  `unit_code` varchar(200) NOT NULL,
  `unit_name` varchar(200) NOT NULL,
  `lec_name` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `time` varchar(200) NOT NULL,
  `room` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iCollege_units`
--

CREATE TABLE `iCollege_units` (
  `id` varchar(200) NOT NULL,
  `course_name` varchar(200) NOT NULL,
  `code` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iCollege_units_allocation`
--

CREATE TABLE `iCollege_units_allocation` (
  `id` varchar(200) NOT NULL,
  `unit_code` varchar(200) NOT NULL,
  `unit_name` varchar(200) NOT NULL,
  `lec_number` varchar(200) NOT NULL,
  `lec_name` varchar(200) NOT NULL,
  `date_allocated` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `iCollege_admin`
--
ALTER TABLE `iCollege_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iCollege_courses`
--
ALTER TABLE `iCollege_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iCollege_enrollments`
--
ALTER TABLE `iCollege_enrollments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iCollege_exammarks`
--
ALTER TABLE `iCollege_exammarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iCollege_fees_payments`
--
ALTER TABLE `iCollege_fees_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iCollege_lecturers`
--
ALTER TABLE `iCollege_lecturers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iCollege_parents`
--
ALTER TABLE `iCollege_parents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iCollege_Settings`
--
ALTER TABLE `iCollege_Settings`
  ADD PRIMARY KEY (`sys_id`);

--
-- Indexes for table `iCollege_students`
--
ALTER TABLE `iCollege_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iCollege_termdates`
--
ALTER TABLE `iCollege_termdates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iCollege_timetable`
--
ALTER TABLE `iCollege_timetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iCollege_units`
--
ALTER TABLE `iCollege_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iCollege_units_allocation`
--
ALTER TABLE `iCollege_units_allocation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `iCollege_parents`
--
ALTER TABLE `iCollege_parents`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iCollege_termdates`
--
ALTER TABLE `iCollege_termdates`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
