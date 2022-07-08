-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2022 at 02:33 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `electricity_billing`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `id` int(10) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`id`, `firstName`, `lastName`, `emailAddress`, `password`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', '11111');

-- --------------------------------------------------------

--
-- Table structure for table `bill_tbl`
--

CREATE TABLE `bill_tbl` (
  `id` int(10) NOT NULL,
  `userId` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `consumption` varchar(50) NOT NULL,
  `tariffRate` varchar(10) DEFAULT NULL,
  `amount` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `billDate` varchar(50) NOT NULL,
  `dueDate` varchar(50) NOT NULL,
  `dateCreated` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill_tbl`
--

INSERT INTO `bill_tbl` (`id`, `userId`, `description`, `consumption`, `tariffRate`, `amount`, `status`, `billDate`, `dueDate`, `dateCreated`) VALUES
(50, '4', 'This Bill is for the energy used in April 2022', '624', '24', '10', 'Paid', '2022-04-01', '2022-05-01', '2022-04-24'),
(51, '5', 'This Bill is for the energy used in April 2022', '800', '24', '19200', 'Pending', '2022-04-21', '2022-05-21', '2022-04-24'),
(52, '6', 'This Bill is for the energy used in April 2022', '720', '24', '17280', 'Pending', '2022-04-30', '2022-05-30', '2022-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `complainttype_tbl`
--

CREATE TABLE `complainttype_tbl` (
  `id` int(10) NOT NULL,
  `typeName` varchar(255) NOT NULL,
  `dateCreated` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complainttype_tbl`
--

INSERT INTO `complainttype_tbl` (`id`, `typeName`, `dateCreated`) VALUES
(2, 'Incorrect billing for the current Month', '2022-04-21 13:20:37'),
(3, 'Wrong calculation of bill', '2022-04-21 13:21:01'),
(4, 'Energy Consumption ', '2022-04-23 18:53:05');

-- --------------------------------------------------------

--
-- Table structure for table `complaint_tbl`
--

CREATE TABLE `complaint_tbl` (
  `id` int(10) NOT NULL,
  `userId` varchar(10) NOT NULL,
  `billId` varchar(50) NOT NULL,
  `complaintTypeId` varchar(10) NOT NULL,
  `complaint` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `dateCreated` varchar(50) NOT NULL,
  `dateTreated` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complaint_tbl`
--

INSERT INTO `complaint_tbl` (`id`, `userId`, `billId`, `complaintTypeId`, `complaint`, `status`, `dateCreated`, `dateTreated`) VALUES
(2, '4', '47', '2', 'Incorrect Billing', 'Treated', '2022-04-22 14:06:32', '2022-04-23 18:14:29'),
(3, '4', '47', '3', 'Incorrect Billing', 'Treated', '2022-04-22 15:49:13', '2022-04-23 18:51:45');

-- --------------------------------------------------------

--
-- Table structure for table `rate_tbl`
--

CREATE TABLE `rate_tbl` (
  `id` int(10) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `dateModified` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rate_tbl`
--

INSERT INTO `rate_tbl` (`id`, `rate`, `dateModified`) VALUES
(1, '24', '2022-04-23 18:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_tbl`
--

CREATE TABLE `transaction_tbl` (
  `id` int(10) NOT NULL,
  `userId` varchar(20) NOT NULL,
  `billId` varchar(20) NOT NULL,
  `referenceNo` varchar(255) DEFAULT NULL,
  `amount` varchar(50) NOT NULL,
  `datePaid` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `dateCreated` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_tbl`
--

INSERT INTO `transaction_tbl` (`id`, `userId`, `billId`, `referenceNo`, `amount`, `datePaid`, `status`, `dateCreated`) VALUES
(29, '4', '50', 'T506094890628698', '10', '2022-04-23 19:41:10', 'Paid', '2022-04-23 19:41:10');

-- --------------------------------------------------------

--
-- Table structure for table `users_tbl`
--

CREATE TABLE `users_tbl` (
  `id` int(10) NOT NULL,
  `accountNo` varchar(50) DEFAULT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phoneNo` varchar(12) NOT NULL,
  `address` text NOT NULL,
  `consumption` varchar(10) DEFAULT NULL,
  `dateRegistered` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_tbl`
--

INSERT INTO `users_tbl` (`id`, `accountNo`, `firstName`, `lastName`, `emailAddress`, `password`, `phoneNo`, `address`, `consumption`, `dateRegistered`) VALUES
(4, '83/27/16/51-5606', 'Adewale ', 'Sewanu', 'Ahmedsodiq7@gmail.com', '11111', '09088997744', '24, Iseyin Street off Agunlejika Surulere Lagos State.', '624', '2022-03-01 15:50:59'),
(5, '47/30/96/40-9722', 'Ajose', 'Omoba', 'Adewaleomoba33@yahoo.com', '11111', '09099889930', '24, Banana Island', '800', '2022-04-21 15:51:29'),
(6, '66/98/13/94-2877', 'Kunle', 'Yemisi', 'Ajose22sewanu@gmail.com', '11111', '07065903222', '32, Ilogobo Eremi', '720', '2022-04-30 15:52:05'),
(7, '49/46/84/72-9867', 'Wale', 'Ope', 'WaleOpe@gmail.com', '11111', '09088776652', '24, Banana Island', '0', '2022-04-24 13:24:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_tbl`
--
ALTER TABLE `bill_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complainttype_tbl`
--
ALTER TABLE `complainttype_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaint_tbl`
--
ALTER TABLE `complaint_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rate_tbl`
--
ALTER TABLE `rate_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_tbl`
--
ALTER TABLE `transaction_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_tbl`
--
ALTER TABLE `users_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bill_tbl`
--
ALTER TABLE `bill_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `complainttype_tbl`
--
ALTER TABLE `complainttype_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `complaint_tbl`
--
ALTER TABLE `complaint_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rate_tbl`
--
ALTER TABLE `rate_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaction_tbl`
--
ALTER TABLE `transaction_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users_tbl`
--
ALTER TABLE `users_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
