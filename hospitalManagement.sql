-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 07, 2019 at 06:21 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospitalManagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis`
--

CREATE TABLE `diagnosis` (
  `diagnoseID` int(11) NOT NULL,
  `DocNotes` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diagnosis`
--

INSERT INTO `diagnosis` (`diagnoseID`, `DocNotes`, `visID`) VALUES
(1, 'Fever', 1),
(2, 'Vomitting', 1),
(3, 'Headache', 1),
(4, 'Stomach pain', 1),
(5, 'Fever New', 90),
(6, 'Fever New', 90),
(7, 'Fever New', 90),
(8, 'Fever New', 90),
(9, 'Fever New', 90),
(10, '', 93),
(11, '', 93),
(12, '', 93),
(13, '', 93),
(14, '', 94),
(15, '', 94),
(16, '', 95),
(17, 'NEW FEVER', 96),
(18, 'New fever\r\nHeahache', 164),
(19, 'Fever', 169),
(20, 'Headache', 171),
(21, 'kshkjads', 174);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctorID` int(11) NOT NULL,
  `firstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contactNo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `workingHr` int(11) NOT NULL,
  `Pwd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctorID`, `firstName`, `lastName`, `contactNo`, `email`, `addr`, `workingHr`, `Pwd`) VALUES
(1, 'M', 'Salih', '7902459130', 'salih@gmail.com', 'NITC, Hostel', 0, '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'S', 'Mushrif', '7902459130', 'mushrif@gmail.com', 'NITC, Hostel', 0, '81dc9bdb52d04dc20036dbd8313ed055'),
(3, 'Rizwan', 'M', '9959384725', 'rizwan_b170829cs@nitc.ac.in', 'NITC, Calicut', 0, '63a9f0ea7bb98050796b649e85481845');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `medicineID` int(11) NOT NULL,
  `medicineName` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distributer` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`medicineID`, `medicineName`, `distributer`, `stock`) VALUES
(1, 'PCM', NULL, 120),
(2, 'Bcomplex', NULL, 200),
(3, 'Citricin', NULL, 120),
(4, 'ORS', NULL, 200),
(5, 'Paracetamol', 'Mushrif', 120),
(6, 'Tylenol', '', 200);

-- --------------------------------------------------------

--
-- Table structure for table `medprescribed`
--

CREATE TABLE `medprescribed` (
  `prescID` int(11) NOT NULL,
  `medID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medprescribed`
--

INSERT INTO `medprescribed` (`prescID`, `medID`) VALUES
(12, 3),
(20, 1),
(20, 3),
(20, 5),
(21, 1),
(21, 2),
(21, 5),
(22, 3),
(23, 1),
(23, 2),
(23, 4),
(24, 3),
(24, 4),
(24, 6);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patientID` int(11) NOT NULL,
  `firstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `contactNo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Age` int(11) NOT NULL,
  `Pwd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patientID`, `firstName`, `lastName`, `Designation`, `email`, `dob`, `contactNo`, `addr`, `Age`, `Pwd`) VALUES
(1, 'Prabodh', 'T R', 'student', 'prabodhtr@gmail.com', '1999-01-08', '2299222555', 'root', 70, '63a9f0ea7bb98050796b649e85481845'),
(2, 'Varun', 'Kumar', 'student', 'varun@gmail.com', '2017-05-09', '1234567891', 'NITC', 70, '81dc9bdb52d04dc20036dbd8313ed055'),
(3, 'Sonaal', 'Pradeep', 'student', 'sonaal@gmail.com', '1999-02-03', '1234567890', 'NITC', 70, '81dc9bdb52d04dc20036dbd8313ed055'),
(4, 'Varun', 'Kumar', 'student', 'var1@gmail.com', '2019-08-12', '1234567890', 'NITC', 70, '63a9f0ea7bb98050796b649e85481845');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `prescriptionID` int(11) NOT NULL,
  `diagID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`prescriptionID`, `diagID`) VALUES
(1, 1),
(4, 1),
(5, 1),
(8, 2),
(2, 3),
(6, 3),
(3, 4),
(7, 4),
(9, 5),
(10, 7),
(11, 8),
(12, 9),
(13, 10),
(14, 11),
(15, 12),
(16, 13),
(17, 14),
(18, 15),
(19, 16),
(20, 17),
(21, 18),
(22, 19),
(23, 20),
(24, 21);

-- --------------------------------------------------------

--
-- Table structure for table `referral`
--

CREATE TABLE `referral` (
  `referralID` int(11) NOT NULL,
  `refNotes` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diagID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `testID` int(11) NOT NULL,
  `testName` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`testID`, `testName`) VALUES
(1, 'Blood Test');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_presc_med`
-- (See below for the actual view)
--
CREATE TABLE `view_presc_med` (
`visitID` int(11)
,`prescriptionID` int(11)
,`medicineName` varchar(1000)
);

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

CREATE TABLE `visit` (
  `visitID` int(11) NOT NULL,
  `DandT` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pID` int(11) NOT NULL,
  `docID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visit`
--

INSERT INTO `visit` (`visitID`, `DandT`, `pID`, `docID`) VALUES
(1, '2019-11-01 00:29:53', 2, 1),
(2, '2019-11-01 00:31:54', 1, 1),
(3, '2019-11-01 00:34:09', 1, 1),
(4, '2019-11-01 10:03:15', 1, 3),
(5, '2019-11-01 10:03:20', 2, 3),
(6, '2019-11-01 10:03:49', 1, 3),
(7, '2019-11-01 10:05:17', 2, 1),
(8, '2019-11-01 10:05:56', 2, 1),
(9, '2019-11-01 10:07:39', 1, 1),
(10, '2019-11-01 10:07:49', 1, 1),
(11, '2019-11-01 10:07:57', 1, 1),
(12, '2019-11-01 10:09:48', 2, 3),
(13, '2019-11-01 16:36:30', 1, 1),
(14, '2019-11-01 16:36:39', 2, 1),
(15, '2019-11-01 16:36:44', 3, 1),
(16, '2019-11-01 16:36:50', 2, 1),
(17, '2019-11-01 16:37:09', 1, 1),
(18, '2019-11-01 16:37:18', 2, 1),
(19, '2019-11-01 16:37:21', 3, 1),
(20, '2019-11-01 16:40:31', 3, 1),
(21, '2019-11-02 15:00:37', 1, 1),
(22, '2019-11-02 15:03:14', 1, 1),
(23, '2019-11-02 13:30:08', 1, 1),
(24, '2019-11-03 19:26:31', 1, 1),
(25, '2019-11-03 19:27:18', 1, 1),
(26, '2019-11-03 19:28:15', 1, 1),
(27, '2019-11-03 19:29:42', 1, 1),
(28, '2019-11-03 19:31:06', 1, 1),
(29, '2019-11-03 19:32:47', 1, 1),
(30, '2019-11-03 20:11:06', 1, 1),
(31, '2019-11-03 23:16:02', 1, 1),
(32, '2019-11-03 23:21:57', 1, 1),
(33, '2019-11-03 23:22:04', 2, 1),
(34, '2019-11-03 23:24:16', 2, 1),
(35, '2019-11-03 23:24:26', 2, 1),
(36, '2019-11-03 23:32:10', 2, 1),
(37, '2019-11-03 23:32:24', 2, 1),
(38, '2019-11-03 23:33:04', 2, 1),
(39, '2019-11-03 23:39:46', 2, 1),
(40, '2019-11-04 00:42:56', 2, 1),
(41, '2019-11-04 00:44:06', 2, 1),
(42, '2019-11-04 00:44:15', 2, 1),
(43, '2019-11-04 00:44:51', 2, 1),
(44, '2019-11-04 00:44:58', 2, 1),
(45, '2019-11-04 00:45:18', 2, 1),
(46, '2019-11-04 00:45:24', 2, 1),
(47, '2019-11-04 00:45:36', 2, 1),
(48, '2019-11-04 00:45:51', 2, 1),
(49, '2019-11-04 00:46:41', 2, 1),
(50, '2019-11-04 00:46:50', 2, 1),
(51, '2019-11-04 00:47:31', 2, 1),
(52, '2019-11-04 00:47:47', 2, 1),
(53, '2019-11-04 00:48:05', 2, 1),
(54, '2019-11-04 00:48:17', 2, 1),
(55, '2019-11-04 00:50:22', 2, 1),
(56, '2019-11-04 00:50:37', 2, 1),
(57, '2019-11-04 00:50:48', 2, 1),
(58, '2019-11-04 00:51:02', 2, 1),
(59, '2019-11-04 00:53:43', 2, 1),
(60, '2019-11-04 00:53:52', 2, 1),
(61, '2019-11-04 00:53:59', 2, 1),
(62, '2019-11-04 00:54:19', 2, 1),
(63, '2019-11-04 00:55:02', 2, 1),
(64, '2019-11-04 00:55:15', 2, 1),
(65, '2019-11-04 00:55:28', 2, 1),
(66, '2019-11-04 00:55:50', 2, 1),
(67, '2019-11-04 00:56:01', 2, 1),
(68, '2019-11-04 00:56:08', 2, 1),
(69, '2019-11-04 00:56:17', 2, 1),
(70, '2019-11-04 00:57:12', 2, 1),
(71, '2019-11-04 00:58:02', 2, 1),
(72, '2019-11-04 00:59:20', 2, 1),
(73, '2019-11-04 00:59:35', 2, 1),
(74, '2019-11-04 00:59:51', 2, 1),
(75, '2019-11-04 01:00:00', 2, 1),
(76, '2019-11-04 01:00:09', 2, 1),
(77, '2019-11-04 01:00:35', 2, 1),
(78, '2019-11-04 01:00:43', 2, 1),
(79, '2019-11-04 01:01:01', 2, 1),
(80, '2019-11-04 01:01:10', 2, 1),
(81, '2019-11-04 01:07:59', 2, 1),
(82, '2019-11-04 01:08:03', 1, 1),
(83, '2019-11-04 01:09:50', 1, 1),
(84, '2019-11-04 01:10:02', 2, 1),
(85, '2019-11-04 01:14:48', 2, 1),
(86, '2019-11-04 01:20:47', 1, 1),
(87, '2019-11-04 01:29:17', 1, 1),
(88, '2019-11-04 01:29:23', 1, 1),
(89, '2019-11-04 01:30:35', 1, 1),
(90, '2019-11-04 01:31:36', 1, 1),
(91, '2019-11-05 00:17:59', 3, 1),
(92, '2019-11-05 00:19:58', 3, 1),
(93, '2019-11-05 00:20:43', 3, 1),
(94, '2019-11-05 00:24:24', 3, 1),
(95, '2019-11-05 00:24:49', 2, 1),
(96, '2019-11-05 00:26:42', 3, 1),
(97, '2019-11-05 00:28:50', 3, 1),
(98, '2019-11-05 00:29:18', 3, 1),
(99, '2019-11-05 00:30:14', 3, 1),
(100, '2019-11-05 00:30:23', 2, 1),
(101, '2019-11-05 00:30:34', 2, 1),
(103, '2019-11-05 00:35:23', 1, 1),
(104, '2019-11-05 00:35:52', 1, 1),
(105, '2019-11-05 00:36:00', 1, 1),
(106, '2019-11-05 00:36:12', 1, 1),
(107, '2019-11-05 00:36:28', 1, 1),
(108, '2019-11-05 00:36:59', 1, 1),
(109, '2019-11-05 00:37:14', 1, 1),
(110, '2019-11-05 00:37:20', 1, 1),
(111, '2019-11-05 00:38:12', 1, 1),
(112, '2019-11-05 00:38:21', 1, 1),
(113, '2019-11-05 00:38:47', 1, 1),
(114, '2019-11-05 00:39:02', 1, 1),
(115, '2019-11-05 00:39:23', 1, 1),
(116, '2019-11-05 00:39:39', 2, 1),
(117, '2019-11-05 00:39:41', 3, 1),
(118, '2019-11-05 00:40:13', 3, 1),
(119, '2019-11-05 00:40:23', 3, 1),
(120, '2019-11-05 00:40:38', 3, 1),
(121, '2019-11-05 00:44:19', 3, 1),
(122, '2019-11-05 00:44:25', 3, 1),
(123, '2019-11-05 00:45:37', 3, 1),
(124, '2019-11-05 00:45:47', 3, 1),
(125, '2019-11-05 00:46:00', 3, 1),
(126, '2019-11-05 00:46:05', 3, 1),
(127, '2019-11-05 00:47:03', 3, 1),
(128, '2019-11-05 00:47:20', 3, 1),
(129, '2019-11-05 00:47:33', 3, 1),
(130, '2019-11-05 00:47:45', 3, 1),
(131, '2019-11-05 00:48:18', 3, 1),
(132, '2019-11-05 00:48:38', 3, 1),
(133, '2019-11-05 00:49:41', 3, 1),
(134, '2019-11-05 00:50:37', 3, 1),
(135, '2019-11-05 00:51:28', 3, 1),
(136, '2019-11-05 00:51:38', 3, 1),
(137, '2019-11-05 00:52:29', 3, 1),
(138, '2019-11-05 00:53:34', 3, 1),
(139, '2019-11-05 00:53:50', 3, 1),
(140, '2019-11-05 00:53:59', 3, 1),
(141, '2019-11-05 00:54:04', 3, 1),
(142, '2019-11-05 00:54:14', 3, 1),
(143, '2019-11-05 00:54:28', 3, 1),
(144, '2019-11-05 00:54:39', 3, 1),
(145, '2019-11-05 00:55:01', 3, 1),
(146, '2019-11-05 00:55:42', 3, 1),
(147, '2019-11-05 00:56:09', 3, 1),
(148, '2019-11-05 00:56:20', 3, 1),
(149, '2019-11-05 00:56:24', 3, 1),
(150, '2019-11-05 00:56:56', 3, 1),
(151, '2019-11-05 00:57:06', 3, 1),
(152, '2019-11-05 00:57:22', 3, 1),
(153, '2019-11-05 00:57:41', 3, 1),
(154, '2019-11-05 00:57:47', 3, 1),
(155, '2019-11-05 00:57:52', 3, 1),
(156, '2019-11-05 00:57:58', 3, 1),
(157, '2019-11-05 00:58:07', 3, 1),
(158, '2019-11-05 00:58:13', 3, 1),
(159, '2019-11-05 00:58:21', 3, 1),
(160, '2019-11-05 00:58:26', 3, 1),
(161, '2019-11-05 00:58:46', 3, 1),
(162, '2019-11-05 00:59:34', 3, 1),
(163, '2019-11-05 00:59:46', 3, 1),
(164, '2019-11-05 22:11:06', 2, 1),
(165, '2019-11-05 22:11:48', 2, 1),
(166, '2019-11-05 22:12:06', 3, 1),
(167, '2019-11-05 22:12:12', 2, 1),
(168, '2019-11-05 22:14:00', 3, 1),
(169, '2019-11-06 00:11:03', 4, 1),
(170, '2019-11-06 00:15:55', 3, 1),
(171, '2019-11-06 00:15:59', 4, 1),
(172, '2019-11-06 00:32:50', 4, 1),
(173, '2019-11-06 00:40:28', 2, 1),
(174, '2019-11-06 09:11:07', 3, 1),
(175, '2019-11-06 09:13:35', 1, 1),
(176, '2019-11-06 09:16:32', 1, 1),
(177, '2019-11-07 23:38:18', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `visitAndtest`
--

CREATE TABLE `visitAndtest` (
  `visID` int(11) DEFAULT NULL,
  `testID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure for view `view_presc_med`
--
DROP TABLE IF EXISTS `view_presc_med`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_presc_med`  AS  select `V`.`visitID` AS `visitID`,`P`.`prescriptionID` AS `prescriptionID`,`M`.`medicineName` AS `medicineName` from ((((`visit` `V` left join `diagnosis` `D` on(`V`.`visitID` = `D`.`visID`)) left join `prescription` `P` on(`P`.`diagID` = `D`.`diagnoseID`)) left join `medprescribed` `mp` on(`P`.`prescriptionID` = `mp`.`prescID`)) left join `medicine` `M` on(`M`.`medicineID` = `mp`.`medID`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diagnosis`
--
ALTER TABLE `diagnosis`
  ADD PRIMARY KEY (`diagnoseID`),
  ADD KEY `visID` (`visID`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctorID`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`medicineID`);

--
-- Indexes for table `medprescribed`
--
ALTER TABLE `medprescribed`
  ADD KEY `medID` (`medID`),
  ADD KEY `prescID` (`prescID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patientID`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`prescriptionID`),
  ADD KEY `diagID` (`diagID`);

--
-- Indexes for table `referral`
--
ALTER TABLE `referral`
  ADD PRIMARY KEY (`referralID`),
  ADD KEY `diagID` (`diagID`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`testID`);

--
-- Indexes for table `visit`
--
ALTER TABLE `visit`
  ADD PRIMARY KEY (`visitID`),
  ADD KEY `docID` (`docID`),
  ADD KEY `pID` (`pID`);

--
-- Indexes for table `visitAndtest`
--
ALTER TABLE `visitAndtest`
  ADD KEY `testID` (`testID`),
  ADD KEY `visID` (`visID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diagnosis`
--
ALTER TABLE `diagnosis`
  MODIFY `diagnoseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `medicineID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `prescriptionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `referral`
--
ALTER TABLE `referral`
  MODIFY `referralID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `testID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visit`
--
ALTER TABLE `visit`
  MODIFY `visitID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `diagnosis`
--
ALTER TABLE `diagnosis`
  ADD CONSTRAINT `diagnosis_ibfk_1` FOREIGN KEY (`visID`) REFERENCES `visit` (`visitID`);

--
-- Constraints for table `medprescribed`
--
ALTER TABLE `medprescribed`
  ADD CONSTRAINT `medprescribed_ibfk_1` FOREIGN KEY (`medID`) REFERENCES `medicine` (`medicineID`),
  ADD CONSTRAINT `medprescribed_ibfk_2` FOREIGN KEY (`prescID`) REFERENCES `prescription` (`prescriptionID`);

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `prescription_ibfk_1` FOREIGN KEY (`diagID`) REFERENCES `diagnosis` (`diagnoseID`);

--
-- Constraints for table `referral`
--
ALTER TABLE `referral`
  ADD CONSTRAINT `referral_ibfk_1` FOREIGN KEY (`diagID`) REFERENCES `diagnosis` (`diagnoseID`);

--
-- Constraints for table `visit`
--
ALTER TABLE `visit`
  ADD CONSTRAINT `visit_ibfk_1` FOREIGN KEY (`docID`) REFERENCES `doctor` (`doctorID`),
  ADD CONSTRAINT `visit_ibfk_2` FOREIGN KEY (`pID`) REFERENCES `patient` (`patientID`);

--
-- Constraints for table `visitAndtest`
--
ALTER TABLE `visitAndtest`
  ADD CONSTRAINT `visitAndtest_ibfk_1` FOREIGN KEY (`testID`) REFERENCES `test` (`testID`),
  ADD CONSTRAINT `visitAndtest_ibfk_2` FOREIGN KEY (`visID`) REFERENCES `visit` (`visitID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
