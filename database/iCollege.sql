-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 25, 2021 at 08:53 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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

--
-- Dumping data for table `iCollege_courses`
--

INSERT INTO `iCollege_courses` (`id`, `code`, `name`, `hod`, `details`) VALUES
('b981ec599e7038f41bb4aac1d2690b48730000', 'BIRJ3-83406', 'Bachelors Of Science In Computer Science', 'Jane Doe', 0x5468697320697320636f757273652064657461696c73),
('b981ec599e7038f41bb4aac1d2690b48730001', 'BIRJ3-83407', 'Bachelors Of Science In Computer Engineering', 'Jane Doe', 0x5468697320697320636f757273652064657461696c73),
('b981ec599e7038f41bb4aac1d2690b48730002', 'BIRJ3-83408', 'Bachelors Of Science In Civil Engineering', 'John F Doe', 0x5468697320697320636f757273652064657461696c73),
('b981ec599e7038f41bb4aac1d2690b48730003', 'BIRJ3-83409', 'Bachelors Of Science In Electrical Engineering', 'Jane Doe', 0x54686973206973206d7920636f757273652064657461696c73),
('b981ec599e7038f41bb4aac1d2690b48730004', 'BIRJ3-83410', 'Bachelors Of Business Information Technology', 'John  Doe', 0x5468697320697320636f757273652064657461696c73),
('b981ec599e7038f41bb4aac1d2690b48730005', 'BIRJ3-83411', 'Bachelors Information Technology', 'Jane Doe', 0x5468697320697320636f757273652064657461696c73),
('b981ec599e7038f41bb4aac1d2690b48730006', 'BIRJ3-83412', 'Diploma In Computer Science', 'John C Doe', 0x5468697320697320636f757273652064657461696c73),
('b981ec599e7038f41bb4aac1d2690b48730007', 'BIRJ3-83413', 'Diploma In Computer Engineering', 'Jane H Doe', 0x5468697320697320636f757273652064657461696c73),
('b981ec599e7038f41bb4aac1d2690b48730008', 'BIRJ3-83414', 'Diploma In Civil Engineering', 'Jane Doe', 0x5468697320697320636f757273652064657461696c73),
('b981ec599e7038f41bb4aac1d2690b48730009', 'BIRJ3-83415', 'Diploma In Electrical Engineering', 'Jane Doe', 0x5468697320697320636f757273652064657461696c73),
('b981ec599e7038f41bb4aac1d2690b48730010', 'BIRJ3-83416', 'Diploma In Business Information Technology', 'Jane Doe', 0x5468697320697320636f757273652064657461696c73),
('b981ec599e7038f41bb4aac1d2690b48730011', 'BIRJ3-83417', 'Diploma In Information Technology', 'Jane Doe', 0x5468697320697320636f757273652064657461696c73);

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

--
-- Dumping data for table `iCollege_enrollments`
--

INSERT INTO `iCollege_enrollments` (`id`, `std_regno`, `std_name`, `unit_code`, `unit_name`, `semester_enrolled`, `academic_year_enrolled`) VALUES
('5a05796c44f4b6dd517defbc12fc639f8dede8e2bc', 'N0OY5-73169', 'Student 001', 'LSG1Y-65827', 'Digital Electronics 1', 'Jan - Apr 2021', '2020 - 2021');

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
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iCollege_exammarks`
--

INSERT INTO `iCollege_exammarks` (`id`, `course_id`, `course_name`, `unit_code`, `unit_name`, `std_regno`, `std_name`, `semester_enrolled`, `academic_year`, `marks`, `created_at`) VALUES
('966d5825b471190003fa012c93769f96ad5d69cd69', 'b981ec599e7038f41bb4aac1d2690b48730000', 'Bachelors Of Science In Computer Science', 'LSG1Y-65828', 'Digital Electronics 2', 'N0OY5-73169', 'Student 001', 'Jan - Apr 2021', '2020 - 2021', '70', '2021-02-12 07:13:43.568937'),
('e9899cc566754ea4ded096d2ccb9a042843f592724', 'b981ec599e7038f41bb4aac1d2690b48730000', 'Bachelors Of Science In Computer Science', 'LSG1Y-65827', 'Digital Electronics 1', 'N0OY5-73169', 'Student 001', 'Jan - Apr 2021', '2020 - 2021', '90', '2021-02-09 08:14:11.021905');

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

--
-- Dumping data for table `iCollege_fees_payments`
--

INSERT INTO `iCollege_fees_payments` (`id`, `std_regno`, `std_name`, `amt_billed`, `amt_paid`, `payment_means`, `payment_code`, `date_paid`) VALUES
('38807371f6a36616fdbc8eed1', 'N0OY5-73170', 'Student 002', '55000', '55000', 'Bank Deposit', 'W4GIA7985220', '2021-02-06'),
('38807371f6a36616fdbc8eed10', 'N0OY5-73179', 'Student 011', '55000', '55000', 'Bank Deposit', 'W4GIA7985229', '2021-02-15'),
('38807371f6a36616fdbc8eed100', 'N0OY5-73269', 'Student 101', '55000', '55000', 'Bank Deposit', 'W4GIA7985319', '2021-02-05'),
('38807371f6a36616fdbc8eed101', 'N0OY5-73270', 'Student 102', '55000', '55000', 'Bank Deposit', 'W4GIA7985320', '2021-02-05'),
('38807371f6a36616fdbc8eed102', 'N0OY5-73271', 'Student 103', '55000', '55000', 'Bank Deposit', 'W4GIA7985321', '2021-02-05'),
('38807371f6a36616fdbc8eed103', 'N0OY5-73272', 'Student 104', '55000', '55000', 'Bank Deposit', 'W4GIA7985322', '2021-02-05'),
('38807371f6a36616fdbc8eed104', 'N0OY5-73273', 'Student 105', '55000', '55000', 'Bank Deposit', 'W4GIA7985323', '2021-02-05'),
('38807371f6a36616fdbc8eed105', 'N0OY5-73274', 'Student 106', '55000', '55000', 'Bank Deposit', 'W4GIA7985324', '2021-02-05'),
('38807371f6a36616fdbc8eed106', 'N0OY5-73275', 'Student 107', '55000', '55000', 'Bank Deposit', 'W4GIA7985325', '2021-02-05'),
('38807371f6a36616fdbc8eed107', 'N0OY5-73276', 'Student 108', '55000', '55000', 'Bank Deposit', 'W4GIA7985326', '2021-02-05'),
('38807371f6a36616fdbc8eed108', 'N0OY5-73277', 'Student 109', '55000', '55000', 'Bank Deposit', 'W4GIA7985327', '2021-02-05'),
('38807371f6a36616fdbc8eed109', 'N0OY5-73278', 'Student 110', '55000', '55000', 'Bank Deposit', 'W4GIA7985328', '2021-02-05'),
('38807371f6a36616fdbc8eed11', 'N0OY5-73180', 'Student 012', '55000', '55000', 'Bank Deposit', 'W4GIA7985230', '2021-02-16'),
('38807371f6a36616fdbc8eed110', 'N0OY5-73279', 'Student 111', '55000', '55000', 'Bank Deposit', 'W4GIA7985329', '2021-02-05'),
('38807371f6a36616fdbc8eed111', 'N0OY5-73280', 'Student 112', '55000', '55000', 'Bank Deposit', 'W4GIA7985330', '2021-02-05'),
('38807371f6a36616fdbc8eed112', 'N0OY5-73281', 'Student 113', '55000', '55000', 'Bank Deposit', 'W4GIA7985331', '2021-02-05'),
('38807371f6a36616fdbc8eed113', 'N0OY5-73282', 'Student 114', '55000', '55000', 'Bank Deposit', 'W4GIA7985332', '2021-02-05'),
('38807371f6a36616fdbc8eed114', 'N0OY5-73283', 'Student 115', '55000', '55000', 'Bank Deposit', 'W4GIA7985333', '2021-02-05'),
('38807371f6a36616fdbc8eed115', 'N0OY5-73284', 'Student 116', '55000', '55000', 'Bank Deposit', 'W4GIA7985334', '2021-02-05'),
('38807371f6a36616fdbc8eed116', 'N0OY5-73285', 'Student 117', '55000', '55000', 'Bank Deposit', 'W4GIA7985335', '2021-02-05'),
('38807371f6a36616fdbc8eed117', 'N0OY5-73286', 'Student 118', '55000', '55000', 'Bank Deposit', 'W4GIA7985336', '2021-02-05'),
('38807371f6a36616fdbc8eed118', 'N0OY5-73287', 'Student 119', '55000', '55000', 'Bank Deposit', 'W4GIA7985337', '2021-02-05'),
('38807371f6a36616fdbc8eed119', 'N0OY5-73288', 'Student 120', '55000', '55000', 'Bank Deposit', 'W4GIA7985338', '2021-02-05'),
('38807371f6a36616fdbc8eed12', 'N0OY5-73181', 'Student 013', '55000', '55000', 'Bank Deposit', 'W4GIA7985231', '2021-02-17'),
('38807371f6a36616fdbc8eed120', 'N0OY5-73289', 'Student 121', '55000', '55000', 'Bank Deposit', 'W4GIA7985339', '2021-02-05'),
('38807371f6a36616fdbc8eed121', 'N0OY5-73290', 'Student 122', '55000', '55000', 'Bank Deposit', 'W4GIA7985340', '2021-02-05'),
('38807371f6a36616fdbc8eed122', 'N0OY5-73291', 'Student 123', '55000', '55000', 'Bank Deposit', 'W4GIA7985341', '2021-02-05'),
('38807371f6a36616fdbc8eed123', 'N0OY5-73292', 'Student 124', '55000', '55000', 'Bank Deposit', 'W4GIA7985342', '2021-02-05'),
('38807371f6a36616fdbc8eed124', 'N0OY5-73293', 'Student 125', '55000', '55000', 'Bank Deposit', 'W4GIA7985343', '2021-02-05'),
('38807371f6a36616fdbc8eed125', 'N0OY5-73294', 'Student 126', '55000', '55000', 'Bank Deposit', 'W4GIA7985344', '2021-02-05'),
('38807371f6a36616fdbc8eed126', 'N0OY5-73295', 'Student 127', '55000', '55000', 'Bank Deposit', 'W4GIA7985345', '2021-02-05'),
('38807371f6a36616fdbc8eed127', 'N0OY5-73296', 'Student 128', '55000', '55000', 'Bank Deposit', 'W4GIA7985346', '2021-02-05'),
('38807371f6a36616fdbc8eed128', 'N0OY5-73297', 'Student 129', '55000', '55000', 'Bank Deposit', 'W4GIA7985347', '2021-02-05'),
('38807371f6a36616fdbc8eed129', 'N0OY5-73298', 'Student 130', '55000', '55000', 'Bank Deposit', 'W4GIA7985348', '2021-02-05'),
('38807371f6a36616fdbc8eed13', 'N0OY5-73182', 'Student 014', '55000', '55000', 'Bank Deposit', 'W4GIA7985232', '2021-02-18'),
('38807371f6a36616fdbc8eed130', 'N0OY5-73299', 'Student 131', '55000', '55000', 'Bank Deposit', 'W4GIA7985349', '2021-02-05'),
('38807371f6a36616fdbc8eed131', 'N0OY5-73300', 'Student 132', '55000', '55000', 'Bank Deposit', 'W4GIA7985350', '2021-02-05'),
('38807371f6a36616fdbc8eed132', 'N0OY5-73301', 'Student 133', '55000', '55000', 'Bank Deposit', 'W4GIA7985351', '2021-02-05'),
('38807371f6a36616fdbc8eed133', 'N0OY5-73302', 'Student 134', '55000', '55000', 'Bank Deposit', 'W4GIA7985352', '2021-02-05'),
('38807371f6a36616fdbc8eed134', 'N0OY5-73303', 'Student 135', '55000', '55000', 'Bank Deposit', 'W4GIA7985353', '2021-02-05'),
('38807371f6a36616fdbc8eed135', 'N0OY5-73304', 'Student 136', '55000', '55000', 'Bank Deposit', 'W4GIA7985354', '2021-02-05'),
('38807371f6a36616fdbc8eed136', 'N0OY5-73305', 'Student 137', '55000', '55000', 'Bank Deposit', 'W4GIA7985355', '2021-02-05'),
('38807371f6a36616fdbc8eed137', 'N0OY5-73306', 'Student 138', '55000', '55000', 'Bank Deposit', 'W4GIA7985356', '2021-02-05'),
('38807371f6a36616fdbc8eed138', 'N0OY5-73307', 'Student 139', '55000', '55000', 'Bank Deposit', 'W4GIA7985357', '2021-02-05'),
('38807371f6a36616fdbc8eed139', 'N0OY5-73308', 'Student 140', '55000', '55000', 'Bank Deposit', 'W4GIA7985358', '2021-02-05'),
('38807371f6a36616fdbc8eed14', 'N0OY5-73183', 'Student 015', '55000', '55000', 'Bank Deposit', 'W4GIA7985233', '2021-02-19'),
('38807371f6a36616fdbc8eed140', 'N0OY5-73309', 'Student 141', '55000', '55000', 'Bank Deposit', 'W4GIA7985359', '2021-02-05'),
('38807371f6a36616fdbc8eed141', 'N0OY5-73310', 'Student 142', '55000', '55000', 'Bank Deposit', 'W4GIA7985360', '2021-02-05'),
('38807371f6a36616fdbc8eed142', 'N0OY5-73311', 'Student 143', '55000', '55000', 'Bank Deposit', 'W4GIA7985361', '2021-02-05'),
('38807371f6a36616fdbc8eed143', 'N0OY5-73312', 'Student 144', '55000', '55000', 'Bank Deposit', 'W4GIA7985362', '2021-02-05'),
('38807371f6a36616fdbc8eed144', 'N0OY5-73313', 'Student 145', '55000', '55000', 'Bank Deposit', 'W4GIA7985363', '2021-02-05'),
('38807371f6a36616fdbc8eed145', 'N0OY5-73314', 'Student 146', '55000', '55000', 'Bank Deposit', 'W4GIA7985364', '2021-02-05'),
('38807371f6a36616fdbc8eed146', 'N0OY5-73315', 'Student 147', '55000', '55000', 'Bank Deposit', 'W4GIA7985365', '2021-02-05'),
('38807371f6a36616fdbc8eed147', 'N0OY5-73316', 'Student 148', '55000', '55000', 'Bank Deposit', 'W4GIA7985366', '2021-02-05'),
('38807371f6a36616fdbc8eed148', 'N0OY5-73317', 'Student 149', '55000', '55000', 'Bank Deposit', 'W4GIA7985367', '2021-02-05'),
('38807371f6a36616fdbc8eed149', 'N0OY5-73318', 'Student 150', '55000', '55000', 'Bank Deposit', 'W4GIA7985368', '2021-02-05'),
('38807371f6a36616fdbc8eed15', 'N0OY5-73184', 'Student 016', '55000', '55000', 'Bank Deposit', 'W4GIA7985234', '2021-02-20'),
('38807371f6a36616fdbc8eed150', 'N0OY5-73319', 'Student 151', '55000', '55000', 'Bank Deposit', 'W4GIA7985369', '2021-02-05'),
('38807371f6a36616fdbc8eed151', 'N0OY5-73320', 'Student 152', '55000', '55000', 'Bank Deposit', 'W4GIA7985370', '2021-02-05'),
('38807371f6a36616fdbc8eed152', 'N0OY5-73321', 'Student 153', '55000', '55000', 'Bank Deposit', 'W4GIA7985371', '2021-02-05'),
('38807371f6a36616fdbc8eed153', 'N0OY5-73322', 'Student 154', '55000', '55000', 'Bank Deposit', 'W4GIA7985372', '2021-02-05'),
('38807371f6a36616fdbc8eed154', 'N0OY5-73323', 'Student 155', '55000', '55000', 'Bank Deposit', 'W4GIA7985373', '2021-02-05'),
('38807371f6a36616fdbc8eed155', 'N0OY5-73324', 'Student 156', '55000', '55000', 'Bank Deposit', 'W4GIA7985374', '2021-02-05'),
('38807371f6a36616fdbc8eed156', 'N0OY5-73325', 'Student 157', '55000', '55000', 'Bank Deposit', 'W4GIA7985375', '2021-02-05'),
('38807371f6a36616fdbc8eed157', 'N0OY5-73326', 'Student 158', '55000', '55000', 'Bank Deposit', 'W4GIA7985376', '2021-02-05'),
('38807371f6a36616fdbc8eed158', 'N0OY5-73327', 'Student 159', '55000', '55000', 'Bank Deposit', 'W4GIA7985377', '2021-02-05'),
('38807371f6a36616fdbc8eed159', 'N0OY5-73328', 'Student 160', '55000', '55000', 'Bank Deposit', 'W4GIA7985378', '2021-02-05'),
('38807371f6a36616fdbc8eed16', 'N0OY5-73185', 'Student 017', '55000', '55000', 'Bank Deposit', 'W4GIA7985235', '2021-02-21'),
('38807371f6a36616fdbc8eed160', 'N0OY5-73329', 'Student 161', '55000', '55000', 'Bank Deposit', 'W4GIA7985379', '2021-02-05'),
('38807371f6a36616fdbc8eed161', 'N0OY5-73330', 'Student 162', '55000', '55000', 'Bank Deposit', 'W4GIA7985380', '2021-02-05'),
('38807371f6a36616fdbc8eed162', 'N0OY5-73331', 'Student 163', '55000', '55000', 'Bank Deposit', 'W4GIA7985381', '2021-02-05'),
('38807371f6a36616fdbc8eed163', 'N0OY5-73332', 'Student 164', '55000', '55000', 'Bank Deposit', 'W4GIA7985382', '2021-02-05'),
('38807371f6a36616fdbc8eed164', 'N0OY5-73333', 'Student 165', '55000', '55000', 'Bank Deposit', 'W4GIA7985383', '2021-02-05'),
('38807371f6a36616fdbc8eed165', 'N0OY5-73334', 'Student 166', '55000', '55000', 'Bank Deposit', 'W4GIA7985384', '2021-02-05'),
('38807371f6a36616fdbc8eed166', 'N0OY5-73335', 'Student 167', '55000', '55000', 'Bank Deposit', 'W4GIA7985385', '2021-02-05'),
('38807371f6a36616fdbc8eed167', 'N0OY5-73336', 'Student 168', '55000', '55000', 'Bank Deposit', 'W4GIA7985386', '2021-02-05'),
('38807371f6a36616fdbc8eed168', 'N0OY5-73337', 'Student 169', '55000', '55000', 'Bank Deposit', 'W4GIA7985387', '2021-02-05'),
('38807371f6a36616fdbc8eed169', 'N0OY5-73338', 'Student 170', '55000', '55000', 'Bank Deposit', 'W4GIA7985388', '2021-02-05'),
('38807371f6a36616fdbc8eed17', 'N0OY5-73186', 'Student 018', '55000', '55000', 'Bank Deposit', 'W4GIA7985236', '2021-02-22'),
('38807371f6a36616fdbc8eed170', 'N0OY5-73339', 'Student 171', '55000', '55000', 'Bank Deposit', 'W4GIA7985389', '2021-02-05'),
('38807371f6a36616fdbc8eed171', 'N0OY5-73340', 'Student 172', '55000', '55000', 'Bank Deposit', 'W4GIA7985390', '2021-02-05'),
('38807371f6a36616fdbc8eed172', 'N0OY5-73341', 'Student 173', '55000', '55000', 'Bank Deposit', 'W4GIA7985391', '2021-02-05'),
('38807371f6a36616fdbc8eed173', 'N0OY5-73342', 'Student 174', '55000', '55000', 'Bank Deposit', 'W4GIA7985392', '2021-02-05'),
('38807371f6a36616fdbc8eed174', 'N0OY5-73343', 'Student 175', '55000', '55000', 'Bank Deposit', 'W4GIA7985393', '2021-02-05'),
('38807371f6a36616fdbc8eed175', 'N0OY5-73344', 'Student 176', '55000', '55000', 'Bank Deposit', 'W4GIA7985394', '2021-02-05'),
('38807371f6a36616fdbc8eed176', 'N0OY5-73345', 'Student 177', '55000', '55000', 'Bank Deposit', 'W4GIA7985395', '2021-02-05'),
('38807371f6a36616fdbc8eed177', 'N0OY5-73346', 'Student 178', '55000', '55000', 'Bank Deposit', 'W4GIA7985396', '2021-02-05'),
('38807371f6a36616fdbc8eed178', 'N0OY5-73347', 'Student 179', '55000', '55000', 'Bank Deposit', 'W4GIA7985397', '2021-02-05'),
('38807371f6a36616fdbc8eed179', 'N0OY5-73348', 'Student 180', '55000', '55000', 'Bank Deposit', 'W4GIA7985398', '2021-02-05'),
('38807371f6a36616fdbc8eed18', 'N0OY5-73187', 'Student 019', '55000', '55000', 'Bank Deposit', 'W4GIA7985237', '2021-02-23'),
('38807371f6a36616fdbc8eed180', 'N0OY5-73349', 'Student 181', '55000', '55000', 'Bank Deposit', 'W4GIA7985399', '2021-02-05'),
('38807371f6a36616fdbc8eed181', 'N0OY5-73350', 'Student 182', '55000', '55000', 'Bank Deposit', 'W4GIA7985400', '2021-02-05'),
('38807371f6a36616fdbc8eed182', 'N0OY5-73351', 'Student 183', '55000', '55000', 'Bank Deposit', 'W4GIA7985401', '2021-02-05'),
('38807371f6a36616fdbc8eed183', 'N0OY5-73352', 'Student 184', '55000', '55000', 'Bank Deposit', 'W4GIA7985402', '2021-02-05'),
('38807371f6a36616fdbc8eed184', 'N0OY5-73353', 'Student 185', '55000', '55000', 'Bank Deposit', 'W4GIA7985403', '2021-02-05'),
('38807371f6a36616fdbc8eed185', 'N0OY5-73354', 'Student 186', '55000', '55000', 'Bank Deposit', 'W4GIA7985404', '2021-02-05'),
('38807371f6a36616fdbc8eed186', 'N0OY5-73355', 'Student 187', '55000', '55000', 'Bank Deposit', 'W4GIA7985405', '2021-02-05'),
('38807371f6a36616fdbc8eed187', 'N0OY5-73356', 'Student 188', '55000', '55000', 'Bank Deposit', 'W4GIA7985406', '2021-02-05'),
('38807371f6a36616fdbc8eed188', 'N0OY5-73357', 'Student 189', '55000', '55000', 'Bank Deposit', 'W4GIA7985407', '2021-02-05'),
('38807371f6a36616fdbc8eed189', 'N0OY5-73358', 'Student 190', '55000', '55000', 'Bank Deposit', 'W4GIA7985408', '2021-02-05'),
('38807371f6a36616fdbc8eed19', 'N0OY5-73188', 'Student 020', '55000', '55000', 'Bank Deposit', 'W4GIA7985238', '2021-02-24'),
('38807371f6a36616fdbc8eed190', 'N0OY5-73359', 'Student 191', '55000', '55000', 'Bank Deposit', 'W4GIA7985409', '2021-02-05'),
('38807371f6a36616fdbc8eed191', 'N0OY5-73360', 'Student 192', '55000', '55000', 'Bank Deposit', 'W4GIA7985410', '2021-02-05'),
('38807371f6a36616fdbc8eed192', 'N0OY5-73361', 'Student 193', '55000', '55000', 'Bank Deposit', 'W4GIA7985411', '2021-02-05'),
('38807371f6a36616fdbc8eed193', 'N0OY5-73362', 'Student 194', '55000', '55000', 'Bank Deposit', 'W4GIA7985412', '2021-02-05'),
('38807371f6a36616fdbc8eed194', 'N0OY5-73363', 'Student 195', '55000', '55000', 'Bank Deposit', 'W4GIA7985413', '2021-02-05'),
('38807371f6a36616fdbc8eed195', 'N0OY5-73364', 'Student 196', '55000', '55000', 'Bank Deposit', 'W4GIA7985414', '2021-02-05'),
('38807371f6a36616fdbc8eed196', 'N0OY5-73365', 'Student 197', '55000', '55000', 'Bank Deposit', 'W4GIA7985415', '2021-02-05'),
('38807371f6a36616fdbc8eed197', 'N0OY5-73366', 'Student 198', '55000', '55000', 'Bank Deposit', 'W4GIA7985416', '2021-02-05'),
('38807371f6a36616fdbc8eed198', 'N0OY5-73367', 'Student 199', '55000', '55000', 'Bank Deposit', 'W4GIA7985417', '2021-02-05'),
('38807371f6a36616fdbc8eed199', 'N0OY5-73368', 'Student 200', '55000', '55000', 'Bank Deposit', 'W4GIA7985418', '2021-02-05'),
('38807371f6a36616fdbc8eed2', 'N0OY5-73171', 'Student 003', '55000', '55000', 'Bank Deposit', 'W4GIA7985221', '2021-02-07'),
('38807371f6a36616fdbc8eed20', 'N0OY5-73189', 'Student 021', '55000', '55000', 'Bank Deposit', 'W4GIA7985239', '2021-02-25'),
('38807371f6a36616fdbc8eed200', 'N0OY5-73369', 'Student 201', '55000', '55000', 'Bank Deposit', 'W4GIA7985419', '2021-02-05'),
('38807371f6a36616fdbc8eed201', 'N0OY5-73370', 'Student 202', '55000', '55000', 'Bank Deposit', 'W4GIA7985420', '2021-02-05'),
('38807371f6a36616fdbc8eed202', 'N0OY5-73371', 'Student 203', '55000', '55000', 'Bank Deposit', 'W4GIA7985421', '2021-02-05'),
('38807371f6a36616fdbc8eed203', 'N0OY5-73372', 'Student 204', '55000', '55000', 'Bank Deposit', 'W4GIA7985422', '2021-02-05'),
('38807371f6a36616fdbc8eed204', 'N0OY5-73373', 'Student 205', '55000', '55000', 'Bank Deposit', 'W4GIA7985423', '2021-02-05'),
('38807371f6a36616fdbc8eed205', 'N0OY5-73374', 'Student 206', '55000', '55000', 'Bank Deposit', 'W4GIA7985424', '2021-02-12'),
('38807371f6a36616fdbc8eed206', 'N0OY5-73375', 'Student 207', '55000', '55000', 'Bank Deposit', 'W4GIA7985425', '2021-02-12'),
('38807371f6a36616fdbc8eed207', 'N0OY5-73376', 'Student 208', '55000', '55000', 'Bank Deposit', 'W4GIA7985426', '2021-02-12'),
('38807371f6a36616fdbc8eed208', 'N0OY5-73377', 'Student 209', '55000', '55000', 'Bank Deposit', 'W4GIA7985427', '2021-02-12'),
('38807371f6a36616fdbc8eed209', 'N0OY5-73378', 'Student 210', '55000', '55000', 'Bank Deposit', 'W4GIA7985428', '2021-02-12'),
('38807371f6a36616fdbc8eed21', 'N0OY5-73190', 'Student 022', '55000', '55000', 'Bank Deposit', 'W4GIA7985240', '2021-02-26'),
('38807371f6a36616fdbc8eed22', 'N0OY5-73191', 'Student 023', '55000', '55000', 'Bank Deposit', 'W4GIA7985241', '2021-02-27'),
('38807371f6a36616fdbc8eed23', 'N0OY5-73192', 'Student 024', '55000', '55000', 'Bank Deposit', 'W4GIA7985242', '2021-02-28'),
('38807371f6a36616fdbc8eed24', 'N0OY5-73193', 'Student 025', '55000', '55000', 'Bank Deposit', 'W4GIA7985243', '2021-02-29'),
('38807371f6a36616fdbc8eed25', 'N0OY5-73194', 'Student 026', '55000', '55000', 'Bank Deposit', 'W4GIA7985244', '2021-02-05'),
('38807371f6a36616fdbc8eed26', 'N0OY5-73195', 'Student 027', '55000', '55000', 'Bank Deposit', 'W4GIA7985245', '2021-02-05'),
('38807371f6a36616fdbc8eed27', 'N0OY5-73196', 'Student 028', '55000', '55000', 'Bank Deposit', 'W4GIA7985246', '2021-02-05'),
('38807371f6a36616fdbc8eed28', 'N0OY5-73197', 'Student 029', '55000', '55000', 'Bank Deposit', 'W4GIA7985247', '2021-02-05'),
('38807371f6a36616fdbc8eed29', 'N0OY5-73198', 'Student 030', '55000', '55000', 'Bank Deposit', 'W4GIA7985248', '2021-02-05'),
('38807371f6a36616fdbc8eed3', 'N0OY5-73172', 'Student 004', '55000', '55000', 'Bank Deposit', 'W4GIA7985222', '2021-02-08'),
('38807371f6a36616fdbc8eed30', 'N0OY5-73199', 'Student 031', '55000', '55000', 'Bank Deposit', 'W4GIA7985249', '2021-02-05'),
('38807371f6a36616fdbc8eed31', 'N0OY5-73200', 'Student 032', '55000', '55000', 'Bank Deposit', 'W4GIA7985250', '2021-02-05'),
('38807371f6a36616fdbc8eed32', 'N0OY5-73201', 'Student 033', '55000', '55000', 'Bank Deposit', 'W4GIA7985251', '2021-02-05'),
('38807371f6a36616fdbc8eed33', 'N0OY5-73202', 'Student 034', '55000', '55000', 'Bank Deposit', 'W4GIA7985252', '2021-02-05'),
('38807371f6a36616fdbc8eed34', 'N0OY5-73203', 'Student 035', '55000', '55000', 'Bank Deposit', 'W4GIA7985253', '2021-02-05'),
('38807371f6a36616fdbc8eed35', 'N0OY5-73204', 'Student 036', '55000', '55000', 'Bank Deposit', 'W4GIA7985254', '2021-02-05'),
('38807371f6a36616fdbc8eed36', 'N0OY5-73205', 'Student 037', '55000', '55000', 'Bank Deposit', 'W4GIA7985255', '2021-02-05'),
('38807371f6a36616fdbc8eed37', 'N0OY5-73206', 'Student 038', '55000', '55000', 'Bank Deposit', 'W4GIA7985256', '2021-02-05'),
('38807371f6a36616fdbc8eed38', 'N0OY5-73207', 'Student 039', '55000', '55000', 'Bank Deposit', 'W4GIA7985257', '2021-02-05'),
('38807371f6a36616fdbc8eed39', 'N0OY5-73208', 'Student 040', '55000', '55000', 'Bank Deposit', 'W4GIA7985258', '2021-02-05'),
('38807371f6a36616fdbc8eed4', 'N0OY5-73173', 'Student 005', '55000', '55000', 'Bank Deposit', 'W4GIA7985223', '2021-02-09'),
('38807371f6a36616fdbc8eed40', 'N0OY5-73209', 'Student 041', '55000', '55000', 'Bank Deposit', 'W4GIA7985259', '2021-02-05'),
('38807371f6a36616fdbc8eed41', 'N0OY5-73210', 'Student 042', '55000', '55000', 'Bank Deposit', 'W4GIA7985260', '2021-02-05'),
('38807371f6a36616fdbc8eed42', 'N0OY5-73211', 'Student 043', '55000', '55000', 'Bank Deposit', 'W4GIA7985261', '2021-02-05'),
('38807371f6a36616fdbc8eed43', 'N0OY5-73212', 'Student 044', '55000', '55000', 'Bank Deposit', 'W4GIA7985262', '2021-02-05'),
('38807371f6a36616fdbc8eed44', 'N0OY5-73213', 'Student 045', '55000', '55000', 'Bank Deposit', 'W4GIA7985263', '2021-02-05'),
('38807371f6a36616fdbc8eed45', 'N0OY5-73214', 'Student 046', '55000', '55000', 'Bank Deposit', 'W4GIA7985264', '2021-02-05'),
('38807371f6a36616fdbc8eed46', 'N0OY5-73215', 'Student 047', '55000', '55000', 'Bank Deposit', 'W4GIA7985265', '2021-02-05'),
('38807371f6a36616fdbc8eed47', 'N0OY5-73216', 'Student 048', '55000', '55000', 'Bank Deposit', 'W4GIA7985266', '2021-02-05'),
('38807371f6a36616fdbc8eed48', 'N0OY5-73217', 'Student 049', '55000', '55000', 'Bank Deposit', 'W4GIA7985267', '2021-02-05'),
('38807371f6a36616fdbc8eed49', 'N0OY5-73218', 'Student 050', '55000', '55000', 'Bank Deposit', 'W4GIA7985268', '2021-02-05'),
('38807371f6a36616fdbc8eed5', 'N0OY5-73174', 'Student 006', '55000', '55000', 'Bank Deposit', 'W4GIA7985224', '2021-02-10'),
('38807371f6a36616fdbc8eed50', 'N0OY5-73219', 'Student 051', '55000', '55000', 'Bank Deposit', 'W4GIA7985269', '2021-02-05'),
('38807371f6a36616fdbc8eed51', 'N0OY5-73220', 'Student 052', '55000', '55000', 'Bank Deposit', 'W4GIA7985270', '2021-02-05'),
('38807371f6a36616fdbc8eed52', 'N0OY5-73221', 'Student 053', '55000', '55000', 'Bank Deposit', 'W4GIA7985271', '2021-02-05'),
('38807371f6a36616fdbc8eed53', 'N0OY5-73222', 'Student 054', '55000', '55000', 'Bank Deposit', 'W4GIA7985272', '2021-02-05'),
('38807371f6a36616fdbc8eed54', 'N0OY5-73223', 'Student 055', '55000', '55000', 'Bank Deposit', 'W4GIA7985273', '2021-02-05'),
('38807371f6a36616fdbc8eed55', 'N0OY5-73224', 'Student 056', '55000', '55000', 'Bank Deposit', 'W4GIA7985274', '2021-02-05'),
('38807371f6a36616fdbc8eed56', 'N0OY5-73225', 'Student 057', '55000', '55000', 'Bank Deposit', 'W4GIA7985275', '2021-02-05'),
('38807371f6a36616fdbc8eed57', 'N0OY5-73226', 'Student 058', '55000', '55000', 'Bank Deposit', 'W4GIA7985276', '2021-02-05'),
('38807371f6a36616fdbc8eed58', 'N0OY5-73227', 'Student 059', '55000', '55000', 'Bank Deposit', 'W4GIA7985277', '2021-02-05'),
('38807371f6a36616fdbc8eed59', 'N0OY5-73228', 'Student 060', '55000', '55000', 'Bank Deposit', 'W4GIA7985278', '2021-02-05'),
('38807371f6a36616fdbc8eed6', 'N0OY5-73175', 'Student 007', '55000', '55000', 'Bank Deposit', 'W4GIA7985225', '2021-02-11'),
('38807371f6a36616fdbc8eed60', 'N0OY5-73229', 'Student 061', '55000', '55000', 'Bank Deposit', 'W4GIA7985279', '2021-02-05'),
('38807371f6a36616fdbc8eed61', 'N0OY5-73230', 'Student 062', '55000', '55000', 'Bank Deposit', 'W4GIA7985280', '2021-02-05'),
('38807371f6a36616fdbc8eed62', 'N0OY5-73231', 'Student 063', '55000', '55000', 'Bank Deposit', 'W4GIA7985281', '2021-02-05'),
('38807371f6a36616fdbc8eed63', 'N0OY5-73232', 'Student 064', '55000', '55000', 'Bank Deposit', 'W4GIA7985282', '2021-02-05'),
('38807371f6a36616fdbc8eed64', 'N0OY5-73233', 'Student 065', '55000', '55000', 'Bank Deposit', 'W4GIA7985283', '2021-02-05'),
('38807371f6a36616fdbc8eed65', 'N0OY5-73234', 'Student 066', '55000', '55000', 'Bank Deposit', 'W4GIA7985284', '2021-02-05'),
('38807371f6a36616fdbc8eed66', 'N0OY5-73235', 'Student 067', '55000', '55000', 'Bank Deposit', 'W4GIA7985285', '2021-02-05'),
('38807371f6a36616fdbc8eed67', 'N0OY5-73236', 'Student 068', '55000', '55000', 'Bank Deposit', 'W4GIA7985286', '2021-02-05'),
('38807371f6a36616fdbc8eed68', 'N0OY5-73237', 'Student 069', '55000', '55000', 'Bank Deposit', 'W4GIA7985287', '2021-02-05'),
('38807371f6a36616fdbc8eed69', 'N0OY5-73238', 'Student 070', '55000', '55000', 'Bank Deposit', 'W4GIA7985288', '2021-02-05'),
('38807371f6a36616fdbc8eed7', 'N0OY5-73176', 'Student 008', '55000', '55000', 'Bank Deposit', 'W4GIA7985226', '2021-02-12'),
('38807371f6a36616fdbc8eed70', 'N0OY5-73239', 'Student 071', '55000', '55000', 'Bank Deposit', 'W4GIA7985289', '2021-02-05'),
('38807371f6a36616fdbc8eed71', 'N0OY5-73240', 'Student 072', '55000', '55000', 'Bank Deposit', 'W4GIA7985290', '2021-02-05'),
('38807371f6a36616fdbc8eed72', 'N0OY5-73241', 'Student 073', '55000', '55000', 'Bank Deposit', 'W4GIA7985291', '2021-02-05'),
('38807371f6a36616fdbc8eed73', 'N0OY5-73242', 'Student 074', '55000', '55000', 'Bank Deposit', 'W4GIA7985292', '2021-02-05'),
('38807371f6a36616fdbc8eed74', 'N0OY5-73243', 'Student 075', '55000', '55000', 'Bank Deposit', 'W4GIA7985293', '2021-02-05'),
('38807371f6a36616fdbc8eed75', 'N0OY5-73244', 'Student 076', '55000', '55000', 'Bank Deposit', 'W4GIA7985294', '2021-02-05'),
('38807371f6a36616fdbc8eed76', 'N0OY5-73245', 'Student 077', '55000', '55000', 'Bank Deposit', 'W4GIA7985295', '2021-02-05'),
('38807371f6a36616fdbc8eed77', 'N0OY5-73246', 'Student 078', '55000', '55000', 'Bank Deposit', 'W4GIA7985296', '2021-02-05'),
('38807371f6a36616fdbc8eed78', 'N0OY5-73247', 'Student 079', '55000', '55000', 'Bank Deposit', 'W4GIA7985297', '2021-02-05'),
('38807371f6a36616fdbc8eed79', 'N0OY5-73248', 'Student 080', '55000', '55000', 'Bank Deposit', 'W4GIA7985298', '2021-02-05'),
('38807371f6a36616fdbc8eed8', 'N0OY5-73177', 'Student 009', '55000', '55000', 'Bank Deposit', 'W4GIA7985227', '2021-02-13'),
('38807371f6a36616fdbc8eed80', 'N0OY5-73249', 'Student 081', '55000', '55000', 'Bank Deposit', 'W4GIA7985299', '2021-02-05'),
('38807371f6a36616fdbc8eed81', 'N0OY5-73250', 'Student 082', '55000', '55000', 'Bank Deposit', 'W4GIA7985300', '2021-02-05'),
('38807371f6a36616fdbc8eed8140', 'N0OY5-73169', 'Student 001', '55000', '55000', 'Bank Deposit', 'W4GIA7OMYQ', '2021-02-05'),
('38807371f6a36616fdbc8eed81400741350b9849fe', 'N0OY5-73169', 'Student 001', '55000', '55000', 'Bank Deposit', 'W4GIA7OMYQ', '2021-02-05'),
('38807371f6a36616fdbc8eed82', 'N0OY5-73251', 'Student 083', '55000', '55000', 'Bank Deposit', 'W4GIA7985301', '2021-02-05'),
('38807371f6a36616fdbc8eed83', 'N0OY5-73252', 'Student 084', '55000', '55000', 'Bank Deposit', 'W4GIA7985302', '2021-02-05'),
('38807371f6a36616fdbc8eed84', 'N0OY5-73253', 'Student 085', '55000', '55000', 'Bank Deposit', 'W4GIA7985303', '2021-02-05'),
('38807371f6a36616fdbc8eed85', 'N0OY5-73254', 'Student 086', '55000', '55000', 'Bank Deposit', 'W4GIA7985304', '2021-02-05'),
('38807371f6a36616fdbc8eed86', 'N0OY5-73255', 'Student 087', '55000', '55000', 'Bank Deposit', 'W4GIA7985305', '2021-02-05'),
('38807371f6a36616fdbc8eed87', 'N0OY5-73256', 'Student 088', '55000', '55000', 'Bank Deposit', 'W4GIA7985306', '2021-02-05'),
('38807371f6a36616fdbc8eed88', 'N0OY5-73257', 'Student 089', '55000', '55000', 'Bank Deposit', 'W4GIA7985307', '2021-02-05'),
('38807371f6a36616fdbc8eed89', 'N0OY5-73258', 'Student 090', '55000', '55000', 'Bank Deposit', 'W4GIA7985308', '2021-02-05'),
('38807371f6a36616fdbc8eed9', 'N0OY5-73178', 'Student 010', '55000', '55000', 'Bank Deposit', 'W4GIA7985228', '2021-02-14'),
('38807371f6a36616fdbc8eed90', 'N0OY5-73259', 'Student 091', '55000', '55000', 'Bank Deposit', 'W4GIA7985309', '2021-02-05'),
('38807371f6a36616fdbc8eed91', 'N0OY5-73260', 'Student 092', '55000', '55000', 'Bank Deposit', 'W4GIA7985310', '2021-02-05'),
('38807371f6a36616fdbc8eed92', 'N0OY5-73261', 'Student 093', '55000', '55000', 'Bank Deposit', 'W4GIA7985311', '2021-02-05'),
('38807371f6a36616fdbc8eed93', 'N0OY5-73262', 'Student 094', '55000', '55000', 'Bank Deposit', 'W4GIA7985312', '2021-02-05'),
('38807371f6a36616fdbc8eed94', 'N0OY5-73263', 'Student 095', '55000', '55000', 'Bank Deposit', 'W4GIA7985313', '2021-02-05'),
('38807371f6a36616fdbc8eed95', 'N0OY5-73264', 'Student 096', '55000', '55000', 'Bank Deposit', 'W4GIA7985314', '2021-02-05'),
('38807371f6a36616fdbc8eed96', 'N0OY5-73265', 'Student 097', '55000', '55000', 'Bank Deposit', 'W4GIA7985315', '2021-02-05'),
('38807371f6a36616fdbc8eed97', 'N0OY5-73266', 'Student 098', '55000', '55000', 'Bank Deposit', 'W4GIA7985316', '2021-02-05'),
('38807371f6a36616fdbc8eed98', 'N0OY5-73267', 'Student 099', '55000', '55000', 'Bank Deposit', 'W4GIA7985317', '2021-02-05'),
('38807371f6a36616fdbc8eed99', 'N0OY5-73268', 'Student 100', '55000', '55000', 'Bank Deposit', 'W4GIA7985318', '2021-02-05');

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

--
-- Dumping data for table `iCollege_lecturers`
--

INSERT INTO `iCollege_lecturers` (`id`, `number`, `name`, `phone`, `idno`, `email`, `password`, `dpic`) VALUES
('000c41fefe9f1f804582b79f8af93ad4ad000000', 'iCollege0000', 'Lec 0001', '127-09140001', '1279000', 'lec001@icollege.001', 'adcd7048512e64b48da55b027577886ee5a36350', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000001', 'iCollege0001', 'Lec 0002', '127-09140002', '1279001', 'lec001@icollege.002', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000002', 'iCollege0002', 'Lec 0003', '127-09140003', '1279002', 'lec001@icollege.003', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000003', 'iCollege0003', 'Lec 0004', '127-09140004', '1279003', 'lec001@icollege.004', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000004', 'iCollege0004', 'Lec 0005', '127-09140005', '1279004', 'lec001@icollege.005', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000005', 'iCollege0005', 'Lec 0006', '127-09140006', '1279005', 'lec001@icollege.006', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000006', 'iCollege0006', 'Lec 0007', '127-09140007', '1279006', 'lec001@icollege.007', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000007', 'iCollege0007', 'Lec 0008', '127-09140008', '1279007', 'lec001@icollege.008', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000008', 'iCollege0008', 'Lec 0009', '127-09140009', '1279008', 'lec001@icollege.009', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000009', 'iCollege0009', 'Lec 0010', '127-09140010', '1279009', 'lec001@icollege.010', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000010', 'iCollege0010', 'Lec 0011', '127-09140011', '1279010', 'lec001@icollege.011', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000011', 'iCollege0011', 'Lec 0012', '127-09140012', '1279011', 'lec001@icollege.012', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000012', 'iCollege0012', 'Lec 0013', '127-09140013', '1279012', 'lec001@icollege.013', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000013', 'iCollege0013', 'Lec 0014', '127-09140014', '1279013', 'lec001@icollege.014', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000014', 'iCollege0014', 'Lec 0015', '127-09140015', '1279014', 'lec001@icollege.015', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000015', 'iCollege0015', 'Lec 0016', '127-09140016', '1279015', 'lec001@icollege.016', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000016', 'iCollege0016', 'Lec 0017', '127-09140017', '1279016', 'lec001@icollege.017', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000017', 'iCollege0017', 'Lec 0018', '127-09140018', '1279017', 'lec001@icollege.018', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000018', 'iCollege0018', 'Lec 0019', '127-09140019', '1279018', 'lec001@icollege.019', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000019', 'iCollege0019', 'Lec 0020', '127-09140020', '1279019', 'lec001@icollege.020', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000020', 'iCollege0020', 'Lec 0021', '127-09140021', '1279020', 'lec001@icollege.021', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000021', 'iCollege0021', 'Lec 0022', '127-09140022', '1279021', 'lec001@icollege.022', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000022', 'iCollege0022', 'Lec 0023', '127-09140023', '1279022', 'lec001@icollege.023', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000023', 'iCollege0023', 'Lec 0024', '127-09140024', '1279023', 'lec001@icollege.024', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000024', 'iCollege0024', 'Lec 0025', '127-09140025', '1279024', 'lec001@icollege.025', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000025', 'iCollege0025', 'Lec 0026', '127-09140026', '1279025', 'lec001@icollege.026', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000026', 'iCollege0026', 'Lec 0027', '127-09140027', '1279026', 'lec001@icollege.027', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000027', 'iCollege0027', 'Lec 0028', '127-09140028', '1279027', 'lec001@icollege.028', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000028', 'iCollege0028', 'Lec 0029', '127-09140029', '1279028', 'lec001@icollege.029', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000029', 'iCollege0029', 'Lec 0030', '127-09140030', '1279029', 'lec001@icollege.030', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000030', 'iCollege0030', 'Lec 0031', '127-09140031', '1279030', 'lec001@icollege.031', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000031', 'iCollege0031', 'Lec 0032', '127-09140032', '1279031', 'lec001@icollege.032', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000032', 'iCollege0032', 'Lec 0033', '127-09140033', '1279032', 'lec001@icollege.033', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000033', 'iCollege0033', 'Lec 0034', '127-09140034', '1279033', 'lec001@icollege.034', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000034', 'iCollege0034', 'Lec 0035', '127-09140035', '1279034', 'lec001@icollege.035', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000035', 'iCollege0035', 'Lec 0036', '127-09140036', '1279035', 'lec001@icollege.036', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000036', 'iCollege0036', 'Lec 0037', '127-09140037', '1279036', 'lec001@icollege.037', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000037', 'iCollege0037', 'Lec 0038', '127-09140038', '1279037', 'lec001@icollege.038', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000038', 'iCollege0038', 'Lec 0039', '127-09140039', '1279038', 'lec001@icollege.039', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000039', 'iCollege0039', 'Lec 0040', '127-09140040', '1279039', 'lec001@icollege.040', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000040', 'iCollege0040', 'Lec 0041', '127-09140041', '1279040', 'lec001@icollege.041', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000041', 'iCollege0041', 'Lec 0042', '127-09140042', '1279041', 'lec001@icollege.042', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000042', 'iCollege0042', 'Lec 0043', '127-09140043', '1279042', 'lec001@icollege.043', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000043', 'iCollege0043', 'Lec 0044', '127-09140044', '1279043', 'lec001@icollege.044', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000044', 'iCollege0044', 'Lec 0045', '127-09140045', '1279044', 'lec001@icollege.045', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000045', 'iCollege0045', 'Lec 0046', '127-09140046', '1279045', 'lec001@icollege.046', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000046', 'iCollege0046', 'Lec 0047', '127-09140047', '1279046', 'lec001@icollege.047', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000047', 'iCollege0047', 'Lec 0048', '127-09140048', '1279047', 'lec001@icollege.048', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000048', 'iCollege0048', 'Lec 0049', '127-09140049', '1279048', 'lec001@icollege.049', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000049', 'iCollege0049', 'Lec 0050', '127-09140050', '1279049', 'lec001@icollege.050', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000050', 'iCollege0050', 'Lec 0051', '127-09140051', '1279050', 'lec001@icollege.051', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000051', 'iCollege0051', 'Lec 0052', '127-09140052', '1279051', 'lec001@icollege.052', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000052', 'iCollege0052', 'Lec 0053', '127-09140053', '1279052', 'lec001@icollege.053', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000053', 'iCollege0053', 'Lec 0054', '127-09140054', '1279053', 'lec001@icollege.054', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000054', 'iCollege0054', 'Lec 0055', '127-09140055', '1279054', 'lec001@icollege.055', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000055', 'iCollege0055', 'Lec 0056', '127-09140056', '1279055', 'lec001@icollege.056', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000056', 'iCollege0056', 'Lec 0057', '127-09140057', '1279056', 'lec001@icollege.057', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000057', 'iCollege0057', 'Lec 0058', '127-09140058', '1279057', 'lec001@icollege.058', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000058', 'iCollege0058', 'Lec 0059', '127-09140059', '1279058', 'lec001@icollege.059', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000059', 'iCollege0059', 'Lec 0060', '127-09140060', '1279059', 'lec001@icollege.060', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000060', 'iCollege0060', 'Lec 0061', '127-09140061', '1279060', 'lec001@icollege.061', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000061', 'iCollege0061', 'Lec 0062', '127-09140062', '1279061', 'lec001@icollege.062', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000062', 'iCollege0062', 'Lec 0063', '127-09140063', '1279062', 'lec001@icollege.063', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000063', 'iCollege0063', 'Lec 0064', '127-09140064', '1279063', 'lec001@icollege.064', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000064', 'iCollege0064', 'Lec 0065', '127-09140065', '1279064', 'lec001@icollege.065', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000065', 'iCollege0065', 'Lec 0066', '127-09140066', '1279065', 'lec001@icollege.066', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000066', 'iCollege0066', 'Lec 0067', '127-09140067', '1279066', 'lec001@icollege.067', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000067', 'iCollege0067', 'Lec 0068', '127-09140068', '1279067', 'lec001@icollege.068', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000068', 'iCollege0068', 'Lec 0069', '127-09140069', '1279068', 'lec001@icollege.069', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000069', 'iCollege0069', 'Lec 0070', '127-09140070', '1279069', 'lec001@icollege.070', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000070', 'iCollege0070', 'Lec 0071', '127-09140071', '1279070', 'lec001@icollege.071', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000071', 'iCollege0071', 'Lec 0072', '127-09140072', '1279071', 'lec001@icollege.072', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000072', 'iCollege0072', 'Lec 0073', '127-09140073', '1279072', 'lec001@icollege.073', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000073', 'iCollege0073', 'Lec 0074', '127-09140074', '1279073', 'lec001@icollege.074', 'a69681bcf334ae130217fea4505fd3c994f5683f', ''),
('000c41fefe9f1f804582b79f8af93ad4ad000074', 'iCollege0074', 'Lec 0075', '127-09140075', '1279074', 'lec001@icollege.075', 'a69681bcf334ae130217fea4505fd3c994f5683f', '');

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
('a69681bcf334ae130217fea4505fd3c994f5683f', 'iCollege', 'DevLogo.png', 0x496e7374696c6c696e6720496e6e6f766174696f6e204f6e2041636164656d696373, 'hello@icollege.org', '+254737229776', 0x4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e, 0x3c696672616d65207372633d5c2268747470733a2f2f7777772e676f6f676c652e636f6d2f6d6170732f656d6265643f70623d21316d313421316d313221316d3321316431353935332e35383732323739373232373221326433372e32373436373632343334383631342133642d312e3532393439393834323938363521326d3321316630213266302133663021336d322131693130323421326937363821346631332e312135653021336d32213173656e2132736b652134763136313432333738373334353521356d32213173656e2132736b655c222077696474683d5c223630305c22206865696768743d5c223435305c22207374796c653d5c22626f726465723a303b5c2220616c6c6f7766756c6c73637265656e3d5c225c22206c6f6164696e673d5c226c617a795c223e3c2f696672616d653e, 'iCollege', '@iCollege', 'iCollege');

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
  `course_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iCollege_students`
--

INSERT INTO `iCollege_students` (`id`, `admno`, `name`, `phone`, `idno`, `adr`, `sex`, `email`, `password`, `dpic`, `course_name`) VALUES
('992ae584c4df83b54397ef9b1bee4d0000000', 'N0OY5-73169', 'Student 001', '127914000', '127000', '127001 Localhost', 'Male', 'student@icampus.000', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000001', 'N0OY5-73170', 'Student 002', '127914001', '127001', '127002 Localhost', 'Male', 'student@icampus.001', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000002', 'N0OY5-73171', 'Student 003', '127914002', '127002', '127003 Localhost', 'Male', 'student@icampus.002', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000003', 'N0OY5-73172', 'Student 004', '127914003', '127003', '127004 Localhost', 'Male', 'student@icampus.003', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000004', 'N0OY5-73173', 'Student 005', '127914004', '127004', '127005 Localhost', 'Male', 'student@icampus.004', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000005', 'N0OY5-73174', 'Student 006', '127914005', '127005', '127006 Localhost', 'Male', 'student@icampus.005', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000006', 'N0OY5-73175', 'Student 007', '127914006', '127006', '127007 Localhost', 'Male', 'student@icampus.006', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000007', 'N0OY5-73176', 'Student 008', '127914007', '127007', '127008 Localhost', 'Male', 'student@icampus.007', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000008', 'N0OY5-73177', 'Student 009', '127914008', '127008', '127009 Localhost', 'Male', 'student@icampus.008', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000009', 'N0OY5-73178', 'Student 010', '127914009', '127009', '127010 Localhost', 'Male', 'student@icampus.009', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000010', 'N0OY5-73179', 'Student 011', '127914010', '127010', '127011 Localhost', 'Male', 'student@icampus.010', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000011', 'N0OY5-73180', 'Student 012', '127914011', '127011', '127012 Localhost', 'Male', 'student@icampus.011', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000012', 'N0OY5-73181', 'Student 013', '127914012', '127012', '127013 Localhost', 'Male', 'student@icampus.012', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000013', 'N0OY5-73182', 'Student 014', '127914013', '127013', '127014 Localhost', 'Male', 'student@icampus.013', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000014', 'N0OY5-73183', 'Student 015', '127914014', '127014', '127015 Localhost', 'Male', 'student@icampus.014', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000015', 'N0OY5-73184', 'Student 016', '127914015', '127015', '127016 Localhost', 'Male', 'student@icampus.015', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000016', 'N0OY5-73185', 'Student 017', '127914016', '127016', '127017 Localhost', 'Male', 'student@icampus.016', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000017', 'N0OY5-73186', 'Student 018', '127914017', '127017', '127018 Localhost', 'Male', 'student@icampus.017', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000018', 'N0OY5-73187', 'Student 019', '127914018', '127018', '127019 Localhost', 'Male', 'student@icampus.018', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000019', 'N0OY5-73188', 'Student 020', '127914019', '127019', '127020 Localhost', 'Male', 'student@icampus.019', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000020', 'N0OY5-73189', 'Student 021', '127914020', '127020', '127021 Localhost', 'Male', 'student@icampus.020', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000021', 'N0OY5-73190', 'Student 022', '127914021', '127021', '127022 Localhost', 'Male', 'student@icampus.021', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000022', 'N0OY5-73191', 'Student 023', '127914022', '127022', '127023 Localhost', 'Male', 'student@icampus.022', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000023', 'N0OY5-73192', 'Student 024', '127914023', '127023', '127024 Localhost', 'Male', 'student@icampus.023', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000024', 'N0OY5-73193', 'Student 025', '127914024', '127024', '127025 Localhost', 'Male', 'student@icampus.024', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000025', 'N0OY5-73194', 'Student 026', '127914025', '127025', '127026 Localhost', 'Male', 'student@icampus.025', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000026', 'N0OY5-73195', 'Student 027', '127914026', '127026', '127027 Localhost', 'Male', 'student@icampus.026', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000027', 'N0OY5-73196', 'Student 028', '127914027', '127027', '127028 Localhost', 'Male', 'student@icampus.027', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000028', 'N0OY5-73197', 'Student 029', '127914028', '127028', '127029 Localhost', 'Male', 'student@icampus.028', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000029', 'N0OY5-73198', 'Student 030', '127914029', '127029', '127030 Localhost', 'Male', 'student@icampus.029', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000030', 'N0OY5-73199', 'Student 031', '127914030', '127030', '127031 Localhost', 'Male', 'student@icampus.030', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000031', 'N0OY5-73200', 'Student 032', '127914031', '127031', '127032 Localhost', 'Male', 'student@icampus.031', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000032', 'N0OY5-73201', 'Student 033', '127914032', '127032', '127033 Localhost', 'Male', 'student@icampus.032', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000033', 'N0OY5-73202', 'Student 034', '127914033', '127033', '127034 Localhost', 'Male', 'student@icampus.033', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000034', 'N0OY5-73203', 'Student 035', '127914034', '127034', '127035 Localhost', 'Male', 'student@icampus.034', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000035', 'N0OY5-73204', 'Student 036', '127914035', '127035', '127036 Localhost', 'Male', 'student@icampus.035', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000036', 'N0OY5-73205', 'Student 037', '127914036', '127036', '127037 Localhost', 'Male', 'student@icampus.036', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000037', 'N0OY5-73206', 'Student 038', '127914037', '127037', '127038 Localhost', 'Male', 'student@icampus.037', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000038', 'N0OY5-73207', 'Student 039', '127914038', '127038', '127039 Localhost', 'Female', 'student@icampus.038', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000039', 'N0OY5-73208', 'Student 040', '127914039', '127039', '127040 Localhost', 'Female', 'student@icampus.039', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000040', 'N0OY5-73209', 'Student 041', '127914040', '127040', '127041 Localhost', 'Female', 'student@icampus.040', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000041', 'N0OY5-73210', 'Student 042', '127914041', '127041', '127042 Localhost', 'Female', 'student@icampus.041', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000042', 'N0OY5-73211', 'Student 043', '127914042', '127042', '127043 Localhost', 'Female', 'student@icampus.042', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000043', 'N0OY5-73212', 'Student 044', '127914043', '127043', '127044 Localhost', 'Female', 'student@icampus.043', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000044', 'N0OY5-73213', 'Student 045', '127914044', '127044', '127045 Localhost', 'Female', 'student@icampus.044', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000045', 'N0OY5-73214', 'Student 046', '127914045', '127045', '127046 Localhost', 'Female', 'student@icampus.045', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000046', 'N0OY5-73215', 'Student 047', '127914046', '127046', '127047 Localhost', 'Female', 'student@icampus.046', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000047', 'N0OY5-73216', 'Student 048', '127914047', '127047', '127048 Localhost', 'Female', 'student@icampus.047', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000048', 'N0OY5-73217', 'Student 049', '127914048', '127048', '127049 Localhost', 'Female', 'student@icampus.048', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000049', 'N0OY5-73218', 'Student 050', '127914049', '127049', '127050 Localhost', 'Female', 'student@icampus.049', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000050', 'N0OY5-73219', 'Student 051', '127914050', '127050', '127051 Localhost', 'Female', 'student@icampus.050', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000051', 'N0OY5-73220', 'Student 052', '127914051', '127051', '127052 Localhost', 'Female', 'student@icampus.051', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000052', 'N0OY5-73221', 'Student 053', '127914052', '127052', '127053 Localhost', 'Female', 'student@icampus.052', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000053', 'N0OY5-73222', 'Student 054', '127914053', '127053', '127054 Localhost', 'Female', 'student@icampus.053', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000054', 'N0OY5-73223', 'Student 055', '127914054', '127054', '127055 Localhost', 'Female', 'student@icampus.054', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000055', 'N0OY5-73224', 'Student 056', '127914055', '127055', '127056 Localhost', 'Female', 'student@icampus.055', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000056', 'N0OY5-73225', 'Student 057', '127914056', '127056', '127057 Localhost', 'Female', 'student@icampus.056', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000057', 'N0OY5-73226', 'Student 058', '127914057', '127057', '127058 Localhost', 'Female', 'student@icampus.057', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000058', 'N0OY5-73227', 'Student 059', '127914058', '127058', '127059 Localhost', 'Female', 'student@icampus.058', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000059', 'N0OY5-73228', 'Student 060', '127914059', '127059', '127060 Localhost', 'Female', 'student@icampus.059', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000060', 'N0OY5-73229', 'Student 061', '127914060', '127060', '127061 Localhost', 'Female', 'student@icampus.060', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000061', 'N0OY5-73230', 'Student 062', '127914061', '127061', '127062 Localhost', 'Female', 'student@icampus.061', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000062', 'N0OY5-73231', 'Student 063', '127914062', '127062', '127063 Localhost', 'Female', 'student@icampus.062', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000063', 'N0OY5-73232', 'Student 064', '127914063', '127063', '127064 Localhost', 'Female', 'student@icampus.063', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000064', 'N0OY5-73233', 'Student 065', '127914064', '127064', '127065 Localhost', 'Female', 'student@icampus.064', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000065', 'N0OY5-73234', 'Student 066', '127914065', '127065', '127066 Localhost', 'Female', 'student@icampus.065', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000066', 'N0OY5-73235', 'Student 067', '127914066', '127066', '127067 Localhost', 'Female', 'student@icampus.066', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000067', 'N0OY5-73236', 'Student 068', '127914067', '127067', '127068 Localhost', 'Female', 'student@icampus.067', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000068', 'N0OY5-73237', 'Student 069', '127914068', '127068', '127069 Localhost', 'Female', 'student@icampus.068', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000069', 'N0OY5-73238', 'Student 070', '127914069', '127069', '127070 Localhost', 'Female', 'student@icampus.069', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000070', 'N0OY5-73239', 'Student 071', '127914070', '127070', '127071 Localhost', 'Female', 'student@icampus.070', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000071', 'N0OY5-73240', 'Student 072', '127914071', '127071', '127072 Localhost', 'Female', 'student@icampus.071', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000072', 'N0OY5-73241', 'Student 073', '127914072', '127072', '127073 Localhost', 'Female', 'student@icampus.072', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000073', 'N0OY5-73242', 'Student 074', '127914073', '127073', '127074 Localhost', 'Female', 'student@icampus.073', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000074', 'N0OY5-73243', 'Student 075', '127914074', '127074', '127075 Localhost', 'Female', 'student@icampus.074', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000075', 'N0OY5-73244', 'Student 076', '127914075', '127075', '127076 Localhost', 'Female', 'student@icampus.075', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000076', 'N0OY5-73245', 'Student 077', '127914076', '127076', '127077 Localhost', 'Female', 'student@icampus.076', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000077', 'N0OY5-73246', 'Student 078', '127914077', '127077', '127078 Localhost', 'Female', 'student@icampus.077', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000078', 'N0OY5-73247', 'Student 079', '127914078', '127078', '127079 Localhost', 'Female', 'student@icampus.078', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000079', 'N0OY5-73248', 'Student 080', '127914079', '127079', '127080 Localhost', 'Female', 'student@icampus.079', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000080', 'N0OY5-73249', 'Student 081', '127914080', '127080', '127081 Localhost', 'Female', 'student@icampus.080', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000081', 'N0OY5-73250', 'Student 082', '127914081', '127081', '127082 Localhost', 'Female', 'student@icampus.081', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000082', 'N0OY5-73251', 'Student 083', '127914082', '127082', '127083 Localhost', 'Female', 'student@icampus.082', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000083', 'N0OY5-73252', 'Student 084', '127914083', '127083', '127084 Localhost', 'Female', 'student@icampus.083', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000084', 'N0OY5-73253', 'Student 085', '127914084', '127084', '127085 Localhost', 'Female', 'student@icampus.084', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000085', 'N0OY5-73254', 'Student 086', '127914085', '127085', '127086 Localhost', 'Female', 'student@icampus.085', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000086', 'N0OY5-73255', 'Student 087', '127914086', '127086', '127087 Localhost', 'Female', 'student@icampus.086', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000087', 'N0OY5-73256', 'Student 088', '127914087', '127087', '127088 Localhost', 'Female', 'student@icampus.087', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000088', 'N0OY5-73257', 'Student 089', '127914088', '127088', '127089 Localhost', 'Female', 'student@icampus.088', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000089', 'N0OY5-73258', 'Student 090', '127914089', '127089', '127090 Localhost', 'Female', 'student@icampus.089', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000090', 'N0OY5-73259', 'Student 091', '127914090', '127090', '127091 Localhost', 'Female', 'student@icampus.090', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000091', 'N0OY5-73260', 'Student 092', '127914091', '127091', '127092 Localhost', 'Female', 'student@icampus.091', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000092', 'N0OY5-73261', 'Student 093', '127914092', '127092', '127093 Localhost', 'Female', 'student@icampus.092', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000093', 'N0OY5-73262', 'Student 094', '127914093', '127093', '127094 Localhost', 'Female', 'student@icampus.093', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000094', 'N0OY5-73263', 'Student 095', '127914094', '127094', '127095 Localhost', 'Female', 'student@icampus.094', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000095', 'N0OY5-73264', 'Student 096', '127914095', '127095', '127096 Localhost', 'Female', 'student@icampus.095', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000096', 'N0OY5-73265', 'Student 097', '127914096', '127096', '127097 Localhost', 'Female', 'student@icampus.096', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000097', 'N0OY5-73266', 'Student 098', '127914097', '127097', '127098 Localhost', 'Female', 'student@icampus.097', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000098', 'N0OY5-73267', 'Student 099', '127914098', '127098', '127099 Localhost', 'Female', 'student@icampus.098', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000099', 'N0OY5-73268', 'Student 100', '127914099', '127099', '127100 Localhost', 'Female', 'student@icampus.099', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000100', 'N0OY5-73269', 'Student 101', '127914100', '127100', '127101 Localhost', 'Female', 'student@icampus.100', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000101', 'N0OY5-73270', 'Student 102', '127914101', '127101', '127102 Localhost', 'Female', 'student@icampus.101', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000102', 'N0OY5-73271', 'Student 103', '127914102', '127102', '127103 Localhost', 'Female', 'student@icampus.102', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000103', 'N0OY5-73272', 'Student 104', '127914103', '127103', '127104 Localhost', 'Female', 'student@icampus.103', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000104', 'N0OY5-73273', 'Student 105', '127914104', '127104', '127105 Localhost', 'Female', 'student@icampus.104', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000105', 'N0OY5-73274', 'Student 106', '127914105', '127105', '127106 Localhost', 'Female', 'student@icampus.105', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000106', 'N0OY5-73275', 'Student 107', '127914106', '127106', '127107 Localhost', 'Female', 'student@icampus.106', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000107', 'N0OY5-73276', 'Student 108', '127914107', '127107', '127108 Localhost', 'Female', 'student@icampus.107', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000108', 'N0OY5-73277', 'Student 109', '127914108', '127108', '127109 Localhost', 'Female', 'student@icampus.108', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000109', 'N0OY5-73278', 'Student 110', '127914109', '127109', '127110 Localhost', 'Female', 'student@icampus.109', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000110', 'N0OY5-73279', 'Student 111', '127914110', '127110', '127111 Localhost', 'Female', 'student@icampus.110', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000111', 'N0OY5-73280', 'Student 112', '127914111', '127111', '127112 Localhost', 'Female', 'student@icampus.111', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000112', 'N0OY5-73281', 'Student 113', '127914112', '127112', '127113 Localhost', 'Female', 'student@icampus.112', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000113', 'N0OY5-73282', 'Student 114', '127914113', '127113', '127114 Localhost', 'Female', 'student@icampus.113', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000114', 'N0OY5-73283', 'Student 115', '127914114', '127114', '127115 Localhost', 'Female', 'student@icampus.114', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000115', 'N0OY5-73284', 'Student 116', '127914115', '127115', '127116 Localhost', 'Female', 'student@icampus.115', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000116', 'N0OY5-73285', 'Student 117', '127914116', '127116', '127117 Localhost', 'Female', 'student@icampus.116', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000117', 'N0OY5-73286', 'Student 118', '127914117', '127117', '127118 Localhost', 'Female', 'student@icampus.117', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000118', 'N0OY5-73287', 'Student 119', '127914118', '127118', '127119 Localhost', 'Female', 'student@icampus.118', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000119', 'N0OY5-73288', 'Student 120', '127914119', '127119', '127120 Localhost', 'Female', 'student@icampus.119', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000120', 'N0OY5-73289', 'Student 121', '127914120', '127120', '127121 Localhost', 'Female', 'student@icampus.120', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000121', 'N0OY5-73290', 'Student 122', '127914121', '127121', '127122 Localhost', 'Female', 'student@icampus.121', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000122', 'N0OY5-73291', 'Student 123', '127914122', '127122', '127123 Localhost', 'Female', 'student@icampus.122', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000123', 'N0OY5-73292', 'Student 124', '127914123', '127123', '127124 Localhost', 'Female', 'student@icampus.123', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000124', 'N0OY5-73293', 'Student 125', '127914124', '127124', '127125 Localhost', 'Female', 'student@icampus.124', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000125', 'N0OY5-73294', 'Student 126', '127914125', '127125', '127126 Localhost', 'Female', 'student@icampus.125', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000126', 'N0OY5-73295', 'Student 127', '127914126', '127126', '127127 Localhost', 'Female', 'student@icampus.126', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000127', 'N0OY5-73296', 'Student 128', '127914127', '127127', '127128 Localhost', 'Female', 'student@icampus.127', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000128', 'N0OY5-73297', 'Student 129', '127914128', '127128', '127129 Localhost', 'Female', 'student@icampus.128', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000129', 'N0OY5-73298', 'Student 130', '127914129', '127129', '127130 Localhost', 'Female', 'student@icampus.129', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000130', 'N0OY5-73299', 'Student 131', '127914130', '127130', '127131 Localhost', 'Female', 'student@icampus.130', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000131', 'N0OY5-73300', 'Student 132', '127914131', '127131', '127132 Localhost', 'Female', 'student@icampus.131', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000132', 'N0OY5-73301', 'Student 133', '127914132', '127132', '127133 Localhost', 'Female', 'student@icampus.132', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000133', 'N0OY5-73302', 'Student 134', '127914133', '127133', '127134 Localhost', 'Female', 'student@icampus.133', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000134', 'N0OY5-73303', 'Student 135', '127914134', '127134', '127135 Localhost', 'Female', 'student@icampus.134', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000135', 'N0OY5-73304', 'Student 136', '127914135', '127135', '127136 Localhost', 'Female', 'student@icampus.135', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000136', 'N0OY5-73305', 'Student 137', '127914136', '127136', '127137 Localhost', 'Female', 'student@icampus.136', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000137', 'N0OY5-73306', 'Student 138', '127914137', '127137', '127138 Localhost', 'Female', 'student@icampus.137', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000138', 'N0OY5-73307', 'Student 139', '127914138', '127138', '127139 Localhost', 'Female', 'student@icampus.138', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000139', 'N0OY5-73308', 'Student 140', '127914139', '127139', '127140 Localhost', 'Female', 'student@icampus.139', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000140', 'N0OY5-73309', 'Student 141', '127914140', '127140', '127141 Localhost', 'Female', 'student@icampus.140', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000141', 'N0OY5-73310', 'Student 142', '127914141', '127141', '127142 Localhost', 'Female', 'student@icampus.141', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000142', 'N0OY5-73311', 'Student 143', '127914142', '127142', '127143 Localhost', 'Female', 'student@icampus.142', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000143', 'N0OY5-73312', 'Student 144', '127914143', '127143', '127144 Localhost', 'Female', 'student@icampus.143', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000144', 'N0OY5-73313', 'Student 145', '127914144', '127144', '127145 Localhost', 'Female', 'student@icampus.144', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000145', 'N0OY5-73314', 'Student 146', '127914145', '127145', '127146 Localhost', 'Female', 'student@icampus.145', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000146', 'N0OY5-73315', 'Student 147', '127914146', '127146', '127147 Localhost', 'Female', 'student@icampus.146', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000147', 'N0OY5-73316', 'Student 148', '127914147', '127147', '127148 Localhost', 'Female', 'student@icampus.147', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000148', 'N0OY5-73317', 'Student 149', '127914148', '127148', '127149 Localhost', 'Female', 'student@icampus.148', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000149', 'N0OY5-73318', 'Student 150', '127914149', '127149', '127150 Localhost', 'Female', 'student@icampus.149', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000150', 'N0OY5-73319', 'Student 151', '127914150', '127150', '127151 Localhost', 'Female', 'student@icampus.150', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000151', 'N0OY5-73320', 'Student 152', '127914151', '127151', '127152 Localhost', 'Female', 'student@icampus.151', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000152', 'N0OY5-73321', 'Student 153', '127914152', '127152', '127153 Localhost', 'Female', 'student@icampus.152', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000153', 'N0OY5-73322', 'Student 154', '127914153', '127153', '127154 Localhost', 'Female', 'student@icampus.153', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000154', 'N0OY5-73323', 'Student 155', '127914154', '127154', '127155 Localhost', 'Female', 'student@icampus.154', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000155', 'N0OY5-73324', 'Student 156', '127914155', '127155', '127156 Localhost', 'Female', 'student@icampus.155', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000156', 'N0OY5-73325', 'Student 157', '127914156', '127156', '127157 Localhost', 'Female', 'student@icampus.156', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000157', 'N0OY5-73326', 'Student 158', '127914157', '127157', '127158 Localhost', 'Female', 'student@icampus.157', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000158', 'N0OY5-73327', 'Student 159', '127914158', '127158', '127159 Localhost', 'Female', 'student@icampus.158', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000159', 'N0OY5-73328', 'Student 160', '127914159', '127159', '127160 Localhost', 'Female', 'student@icampus.159', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000160', 'N0OY5-73329', 'Student 161', '127914160', '127160', '127161 Localhost', 'Female', 'student@icampus.160', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000161', 'N0OY5-73330', 'Student 162', '127914161', '127161', '127162 Localhost', 'Female', 'student@icampus.161', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000162', 'N0OY5-73331', 'Student 163', '127914162', '127162', '127163 Localhost', 'Female', 'student@icampus.162', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000163', 'N0OY5-73332', 'Student 164', '127914163', '127163', '127164 Localhost', 'Female', 'student@icampus.163', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000164', 'N0OY5-73333', 'Student 165', '127914164', '127164', '127165 Localhost', 'Female', 'student@icampus.164', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000165', 'N0OY5-73334', 'Student 166', '127914165', '127165', '127166 Localhost', 'Female', 'student@icampus.165', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000166', 'N0OY5-73335', 'Student 167', '127914166', '127166', '127167 Localhost', 'Female', 'student@icampus.166', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000167', 'N0OY5-73336', 'Student 168', '127914167', '127167', '127168 Localhost', 'Female', 'student@icampus.167', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000168', 'N0OY5-73337', 'Student 169', '127914168', '127168', '127169 Localhost', 'Female', 'student@icampus.168', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000169', 'N0OY5-73338', 'Student 170', '127914169', '127169', '127170 Localhost', 'Female', 'student@icampus.169', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000170', 'N0OY5-73339', 'Student 171', '127914170', '127170', '127171 Localhost', 'Female', 'student@icampus.170', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000171', 'N0OY5-73340', 'Student 172', '127914171', '127171', '127172 Localhost', 'Female', 'student@icampus.171', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000172', 'N0OY5-73341', 'Student 173', '127914172', '127172', '127173 Localhost', 'Female', 'student@icampus.172', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000173', 'N0OY5-73342', 'Student 174', '127914173', '127173', '127174 Localhost', 'Female', 'student@icampus.173', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000174', 'N0OY5-73343', 'Student 175', '127914174', '127174', '127175 Localhost', 'Female', 'student@icampus.174', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000175', 'N0OY5-73344', 'Student 176', '127914175', '127175', '127176 Localhost', 'Female', 'student@icampus.175', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000176', 'N0OY5-73345', 'Student 177', '127914176', '127176', '127177 Localhost', 'Female', 'student@icampus.176', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000177', 'N0OY5-73346', 'Student 178', '127914177', '127177', '127178 Localhost', 'Female', 'student@icampus.177', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000178', 'N0OY5-73347', 'Student 179', '127914178', '127178', '127179 Localhost', 'Female', 'student@icampus.178', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000179', 'N0OY5-73348', 'Student 180', '127914179', '127179', '127180 Localhost', 'Female', 'student@icampus.179', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000180', 'N0OY5-73349', 'Student 181', '127914180', '127180', '127181 Localhost', 'Female', 'student@icampus.180', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000181', 'N0OY5-73350', 'Student 182', '127914181', '127181', '127182 Localhost', 'Female', 'student@icampus.181', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000182', 'N0OY5-73351', 'Student 183', '127914182', '127182', '127183 Localhost', 'Female', 'student@icampus.182', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000183', 'N0OY5-73352', 'Student 184', '127914183', '127183', '127184 Localhost', 'Female', 'student@icampus.183', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000184', 'N0OY5-73353', 'Student 185', '127914184', '127184', '127185 Localhost', 'Female', 'student@icampus.184', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000185', 'N0OY5-73354', 'Student 186', '127914185', '127185', '127186 Localhost', 'Female', 'student@icampus.185', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000186', 'N0OY5-73355', 'Student 187', '127914186', '127186', '127187 Localhost', 'Female', 'student@icampus.186', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000187', 'N0OY5-73356', 'Student 188', '127914187', '127187', '127188 Localhost', 'Female', 'student@icampus.187', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000188', 'N0OY5-73357', 'Student 189', '127914188', '127188', '127189 Localhost', 'Female', 'student@icampus.188', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000189', 'N0OY5-73358', 'Student 190', '127914189', '127189', '127190 Localhost', 'Female', 'student@icampus.189', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000190', 'N0OY5-73359', 'Student 191', '127914190', '127190', '127191 Localhost', 'Female', 'student@icampus.190', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000191', 'N0OY5-73360', 'Student 192', '127914191', '127191', '127192 Localhost', 'Female', 'student@icampus.191', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000192', 'N0OY5-73361', 'Student 193', '127914192', '127192', '127193 Localhost', 'Female', 'student@icampus.192', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000193', 'N0OY5-73362', 'Student 194', '127914193', '127193', '127194 Localhost', 'Female', 'student@icampus.193', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000194', 'N0OY5-73363', 'Student 195', '127914194', '127194', '127195 Localhost', 'Female', 'student@icampus.194', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000195', 'N0OY5-73364', 'Student 196', '127914195', '127195', '127196 Localhost', 'Female', 'student@icampus.195', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000196', 'N0OY5-73365', 'Student 197', '127914196', '127196', '127197 Localhost', 'Female', 'student@icampus.196', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000197', 'N0OY5-73366', 'Student 198', '127914197', '127197', '127198 Localhost', 'Female', 'student@icampus.197', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science'),
('992ae584c4df83b54397ef9b1bee4d0000198', 'N0OY5-73367', 'Student 199', '127914198', '127198', '127199 Localhost', 'Female', 'student@icampus.198', 'a69681bcf334ae130217fea4505fd3c994f5683f', '', 'Bachelors Of Science In Computer Science');

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

--
-- Dumping data for table `iCollege_timetable`
--

INSERT INTO `iCollege_timetable` (`id`, `course_name`, `unit_code`, `unit_name`, `lec_name`, `day`, `time`, `room`) VALUES
('a309549835d602c1e482fd99f18cc5d4b00000', 'Bachelors Of Science In Computer Science', 'LSG1Y-65827', 'Digital Electronics 1', 'Lec 0001', 'Monday', '12:00 Noon - 03 : 00 PM', '6'),
('a309549835d602c1e482fd99f18cc5d4b00001', 'Bachelors Of Science In Computer Science', 'LSG1Y-65828', 'Digital Electronics 2', 'Lec 0002', 'Tuesday', '12:00 Noon - 03 : 00 PM', '7'),
('a309549835d602c1e482fd99f18cc5d4b00002', 'Bachelors Of Science In Computer Science', 'LSG1Y-65829', 'Digital Electronics 3', 'Lec 0003', 'Wednesday', '12:00 Noon - 03 : 00 PM', '8'),
('a309549835d602c1e482fd99f18cc5d4b00003', 'Bachelors Of Science In Computer Science', 'LSG1Y-65830', 'Digital Electronics 4', 'Lec 0004', 'Thursday', '12:00 Noon - 03 : 00 PM', '9'),
('a309549835d602c1e482fd99f18cc5d4b00004', 'Bachelors Of Science In Computer Science', 'LSG1Y-65831', 'Digital Electronics 5', 'Lec 0005', 'Friday', '12:00 Noon - 03 : 00 PM', '10'),
('a309549835d602c1e482fd99f18cc5d4b00005', 'Bachelors Of Science In Computer Science', 'LSG1Y-65832', 'Digital Electronics 6', 'Lec 0006', 'Saturday', '12:00 Noon - 03 : 00 PM', '11'),
('a309549835d602c1e482fd99f18cc5d4b00006', 'Bachelors Of Science In Computer Science', 'LSG1Y-65833', 'Digital Electronics 7', 'Lec 0007', 'Sunday', '12:00 Noon - 03 : 00 PM', '12'),
('a309549835d602c1e482fd99f18cc5d4b00007', 'Bachelors Of Science In Computer Science', 'LSG1Y-65834', 'Digital Electronics 8', 'Lec 0008', 'Monday', '12:00 Noon - 03 : 00 PM', '13'),
('a309549835d602c1e482fd99f18cc5d4b00008', 'Bachelors Of Science In Computer Science', 'LSG1Y-65835', 'Digital Electronics 9', 'Lec 0009', 'Tuesday', '12:00 Noon - 03 : 00 PM', '14'),
('a309549835d602c1e482fd99f18cc5d4b00009', 'Bachelors Of Science In Computer Science', 'LSG1Y-65836', 'Digital Electronics 10', 'Lec 0010', 'Wednesday', '12:00 Noon - 03 : 00 PM', '15'),
('a309549835d602c1e482fd99f18cc5d4b00010', 'Bachelors Of Science In Computer Science', 'LSG1Y-65837', 'Digital Electronics 11', 'Lec 0011', 'Thursday', '12:00 Noon - 03 : 00 PM', '16'),
('a309549835d602c1e482fd99f18cc5d4b00011', 'Bachelors Of Science In Computer Science', 'LSG1Y-65838', 'Digital Electronics 12', 'Lec 0012', 'Friday', '12:00 Noon - 03 : 00 PM', '17'),
('a309549835d602c1e482fd99f18cc5d4b00012', 'Bachelors Of Science In Computer Science', 'LSG1Y-65839', 'Digital Electronics 13', 'Lec 0013', 'Saturday', '12:00 Noon - 03 : 00 PM', '18'),
('a309549835d602c1e482fd99f18cc5d4b00013', 'Bachelors Of Science In Computer Science', 'LSG1Y-65840', 'Digital Electronics 14', 'Lec 0014', 'Sunday', '12:00 Noon - 03 : 00 PM', '19'),
('a309549835d602c1e482fd99f18cc5d4b00014', 'Bachelors Of Science In Computer Science', 'LSG1Y-65841', 'Digital Electronics 15', 'Lec 0015', 'Monday', '12:00 Noon - 03 : 00 PM', '20'),
('a309549835d602c1e482fd99f18cc5d4b00015', 'Bachelors Of Science In Computer Science', 'LSG1Y-65842', 'Digital Electronics 16', 'Lec 0016', 'Tuesday', '12:00 Noon - 03 : 00 PM', '21'),
('a309549835d602c1e482fd99f18cc5d4b00016', 'Bachelors Of Science In Computer Science', 'LSG1Y-65843', 'Digital Electronics 17', 'Lec 0017', 'Wednesday', '12:00 Noon - 03 : 00 PM', '22'),
('a309549835d602c1e482fd99f18cc5d4b00017', 'Bachelors Of Science In Computer Science', 'LSG1Y-65844', 'Digital Electronics 18', 'Lec 0018', 'Thursday', '12:00 Noon - 03 : 00 PM', '23'),
('a309549835d602c1e482fd99f18cc5d4b00018', 'Bachelors Of Science In Computer Science', 'LSG1Y-65845', 'Digital Electronics 19', 'Lec 0019', 'Friday', '12:00 Noon - 03 : 00 PM', '24'),
('d309549835d602c1e482fd99f18cc5d4b195d462f5', 'Bachelors Of Science In Computer Science', 'LSG1Y-65827', 'Digital Electronics 1', 'Lec 0001', 'Monday', '12:00 Noon - 03 : 00 PM', '6');

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

--
-- Dumping data for table `iCollege_units`
--

INSERT INTO `iCollege_units` (`id`, `course_name`, `code`, `name`) VALUES
('3fc75ed97607aac71ae17060f2d5ctgf0000', 'Bachelors Of Science In Computer Science', 'LSG1Y-65827', 'Digital Electronics 1'),
('3fc75ed97607aac71ae17060f2d5ctgf0001', 'Bachelors Of Science In Computer Science', 'LSG1Y-65828', 'Digital Electronics 2'),
('3fc75ed97607aac71ae17060f2d5ctgf0002', 'Bachelors Of Science In Computer Science', 'LSG1Y-65829', 'Automata Theory'),
('3fc75ed97607aac71ae17060f2d5ctgf0003', 'Bachelors Of Science In Computer Science', 'LSG1Y-65830', 'Computer Graphics'),
('3fc75ed97607aac71ae17060f2d5ctgf0004', 'Bachelors Of Science In Computer Science', 'LSG1Y-65831', 'Linear Algebra'),
('3fc75ed97607aac71ae17060f2d5ctgf0005', 'Bachelors Of Science In Computer Science', 'LSG1Y-65832', 'Basic Calculus'),
('3fc75ed97607aac71ae17060f2d5ctgf0006', 'Bachelors Of Science In Computer Science', 'LSG1Y-65833', 'OOP 1'),
('3fc75ed97607aac71ae17060f2d5ctgf0007', 'Bachelors Of Science In Computer Science', 'LSG1Y-65834', 'OOP 2'),
('3fc75ed97607aac71ae17060f2d5ctgf0008', 'Bachelors Of Science In Computer Science', 'LSG1Y-65835', 'Web Technologies'),
('3fc75ed97607aac71ae17060f2d5ctgf0009', 'Bachelors Of Science In Computer Science', 'LSG1Y-65836', 'Machine Learning'),
('3fc75ed97607aac71ae17060f2d5ctgf0010', 'Bachelors Of Science In Computer Science', 'LSG1Y-65837', 'Assembly Programming'),
('3fc75ed97607aac71ae17060f2d5ctgf0011', 'Bachelors Of Science In Computer Science', 'LSG1Y-65838', 'Cryptography And Coding Theory'),
('3fc75ed97607aac71ae17060f2d5ctgf0012', 'Bachelors Of Science In Computer Science', 'LSG1Y-65839', 'Unix Shell Programming'),
('3fc75ed97607aac71ae17060f2d5ctgf0013', 'Bachelors Of Science In Computer Science', 'LSG1Y-65840', 'Advanced Database System'),
('3fc75ed97607aac71ae17060f2d5ctgf0014', 'Bachelors Of Science In Computer Science', 'LSG1Y-65841', 'Software Engineering 1'),
('3fc75ed97607aac71ae17060f2d5ctgf0015', 'Bachelors Of Science In Computer Science', 'LSG1Y-65842', 'Software Engineering 2'),
('3fc75ed97607aac71ae17060f2d5ctgf0016', 'Bachelors Of Science In Computer Science', 'LSG1Y-65843', 'Computer Networks'),
('3fc75ed97607aac71ae17060f2d5ctgf0017', 'Bachelors Of Science In Computer Science', 'LSG1Y-65844', 'Data Communications'),
('3fc75ed97607aac71ae17060f2d5ctgf0018', 'Bachelors Of Science In Computer Science', 'LSG1Y-65845', 'Discrete Structures 1'),
('3fc75ed97607aac71ae17060f2d5ctgf0019', 'Bachelors Of Science In Computer Science', 'LSG1Y-65846', 'Discrete Structures 2'),
('3fc75ed97607aac71ae17060f2d5ctgf0020', 'Bachelors Of Science In Computer Science', 'LSG1Y-65847', 'XML And Web Technologies'),
('3fc75ed97607aac71ae17060f2d5ctgf0021', 'Bachelors Of Science In Computer Science', 'LSG1Y-65848', 'Mobile Computing'),
('3fc75ed97607aac71ae17060f2d5ctgf0022', 'Bachelors Of Science In Computer Science', 'LSG1Y-65849', 'Principles Of Programming Languages');

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
-- Dumping data for table `iCollege_units_allocation`
--

INSERT INTO `iCollege_units_allocation` (`id`, `unit_code`, `unit_name`, `lec_number`, `lec_name`, `date_allocated`) VALUES
('657c39fe4d82b5d86983baf716ff0242ab90a6a10c', 'LSG1Y-65827', 'Digital Electronics 1', 'iCollege0000', 'Lec 0001', '03 Feb 2021'),
('a01fd600ac262034491df884761085826399237af9', 'LSG1Y-65827', 'Digital Electronics 1', 'iCollege0001', 'Lec 0002', '03 Feb 2021');

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
