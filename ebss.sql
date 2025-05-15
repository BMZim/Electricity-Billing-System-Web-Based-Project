-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2025 at 08:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ebss`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `name` varchar(20) DEFAULT NULL,
  `jobid` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `PASSWORD` varchar(20) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `division` varchar(20) DEFAULT NULL,
  `nid` int(11) DEFAULT NULL,
  `Security_Question` text DEFAULT NULL,
  `answer` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`name`, `jobid`, `email`, `phone`, `PASSWORD`, `date_of_birth`, `address`, `gender`, `division`, `nid`, `Security_Question`, `answer`) VALUES
(NULL, 221002553, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('B.M. Zim', 221002561, 'shafinrubaer@gmail.com', 1727743670, '12345', '2024-12-05', 'Jhenaidah,Dhaka,Bangladesh', 'Male', 'Dhaka', 34242, 'What is your pet name?', 'Cat'),
(NULL, 221002562, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, 221002563, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `meter_no` int(20) NOT NULL,
  `bill_issue_date` varchar(20) NOT NULL,
  `billing_month_year` varchar(20) NOT NULL,
  `units` float(20,5) NOT NULL,
  `totalbill` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`meter_no`, `bill_issue_date`, `billing_month_year`, `units`, `totalbill`, `status`) VALUES
(100006, '2024-12-07', '2024-11', 200.00000, 1925, 'Paid'),
(100006, '2024-12-12', '2024-10', 200.00000, 1925, 'Paid'),
(100006, '2024-12-12', '2024-09', 200.00000, 1925, 'Paid'),
(100006, '2025-03-11', '2025-04', 200.00000, 1925, 'Not Paid'),
(100006, '2025-04-28', '2025-01', 200.00000, 1925, 'Not Paid'),
(100006, '2025-04-28', '2025-07', 350.00000, 3268, 'Paid'),
(100006, '2025-04-28', '2025-03', 500.00000, 4610, 'Not Paid');

--
-- Triggers `bill`
--
DELIMITER $$
CREATE TRIGGER `TotalBill_Constraints` BEFORE INSERT ON `bill` FOR EACH ROW BEGIN
    -- Make sure the totalbill is a positive number
    IF NEW.totalbill > 0 THEN
        SET NEW.totalbill = CEIL(NEW.totalbill);
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `name` char(20) NOT NULL,
  `meter_no` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `division` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(20) NOT NULL,
  `PASSWORD` varchar(20) NOT NULL,
  `opening_date` varchar(20) DEFAULT NULL,
  `nid` int(11) NOT NULL,
  `date_of_birth` varchar(20) NOT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `Security_Question` text NOT NULL,
  `answer` text NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`name`, `meter_no`, `address`, `division`, `email`, `phone`, `PASSWORD`, `opening_date`, `nid`, `date_of_birth`, `gender`, `Security_Question`, `answer`, `status`) VALUES
('B.M. Zim', 100006, 'Mirpur', 'Khulna', 'shafinrubaer@gmail.com', 12345, '12345', '2024-12', 34242, '2024-12-07', 'Male', 'What is your pet name?', 'Cat', 'Verified'),
('Arman', 100007, 'Ghrgenkrebfjefn', 'Rajshahi', 'arman@gmail.com', 845, '123', '2024-12', 58955, '2024-12-24', 'Male', 'What is your pet name?', 'wd', 'Verified'),
('Zim', 100008, 'Mirpur', 'Dhaka', 'zim@gmail.com', 4353453, '12345', '2024-12', 122345, '2024-12-17', 'Male', 'What is your pet name?', 'dog', 'Verified'),
('Chinmoy', 100009, 'Mirpur', 'Dhaka', 'chinmoy23@gmail.com', 1874794255, '12345', '2025-05', 3456233, '2025-05-02', 'Male', 'What is your pet name?', 'Cat', 'Not Verified');

-- --------------------------------------------------------

--
-- Table structure for table `customer_report`
--

CREATE TABLE `customer_report` (
  `meter_no` int(11) NOT NULL,
  `report` text DEFAULT NULL,
  `date_month_year` varchar(50) DEFAULT NULL,
  `replay` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_report`
--

INSERT INTO `customer_report` (`meter_no`, `report`, `date_month_year`, `replay`) VALUES
(100006, 'HIIII', '2024-12-07', 'Not bad'),
(100006, 'fghgfdh', '2024-12-10', 'ok'),
(100006, 'dsfds', '2024-12-17', 'ok'),
(100009, 'hiii', '2025-05-12', 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `meter_info`
--

CREATE TABLE `meter_info` (
  `meter_no` int(20) NOT NULL,
  `meter_location` char(20) NOT NULL,
  `meter_type` char(20) NOT NULL,
  `phase_code` int(20) NOT NULL,
  `bill_type` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meter_info`
--

INSERT INTO `meter_info` (`meter_no`, `meter_location`, `meter_type`, `phase_code`, `bill_type`) VALUES
(100006, 'Outside', 'Electrical', 101, 'Normal'),
(100007, 'Inside', 'Electrical', 103, 'Normal'),
(100008, 'Inside', 'Electrical', 102, 'Normal'),
(100009, 'Inside', 'Electrical', 103, 'Normal');

-- --------------------------------------------------------

--
-- Table structure for table `meter_request`
--

CREATE TABLE `meter_request` (
  `meter_no` int(11) NOT NULL,
  `status` char(10) NOT NULL,
  `RequestDate` varchar(20) DEFAULT NULL,
  `SendingDate` varchar(20) DEFAULT NULL,
  `ReceiveDate` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meter_request`
--

INSERT INTO `meter_request` (`meter_no`, `status`, `RequestDate`, `SendingDate`, `ReceiveDate`) VALUES
(100006, 'Received', '2024-12-07', '2024-12-07', '2024-12-07'),
(100008, 'Send', '2024-12-17', '2024-12-17', '');

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `cost_per_unit` float(20,5) NOT NULL,
  `meter_rent` float(20,5) NOT NULL,
  `service_charge` float(20,5) NOT NULL,
  `service_tax` float(20,5) NOT NULL,
  `vat` float(20,5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`cost_per_unit`, `meter_rent`, `service_charge`, `service_tax`, `vat`) VALUES
(8.95000, 50.00000, 20.00000, 50.00000, 15.00000);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `meter_no` int(11) NOT NULL,
  `TRANSACTIONNO` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `TRANSACTION_date` varchar(20) DEFAULT NULL,
  `billing_month_year` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`meter_no`, `TRANSACTIONNO`, `amount`, `TRANSACTION_date`, `billing_month_year`) VALUES
(100006, 1727743670, 1925, '2024-12-07', '2024-11'),
(100006, 1727743670, 1925, '2024-12-11', '2024-10'),
(100006, 1727743670, 1925, '2024-12-11', '2024-09'),
(100006, 1727743670, 1925, '2024-12-11', '2024-09'),
(100006, 1727743244, 2820, '2024-12-17', '2024-07'),
(100006, 1727743670, 2820, '2025-03-10', '2025-02'),
(100006, 1727743670, 2820, '2025-03-11', '2025-03'),
(100006, 1727743070, 3268, '2025-04-28', '2025-07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`jobid`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD KEY `meter_no` (`meter_no`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`meter_no`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `customer_report`
--
ALTER TABLE `customer_report`
  ADD KEY `meter_no` (`meter_no`);

--
-- Indexes for table `meter_info`
--
ALTER TABLE `meter_info`
  ADD KEY `meter_no` (`meter_no`);

--
-- Indexes for table `meter_request`
--
ALTER TABLE `meter_request`
  ADD KEY `meter_no` (`meter_no`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD KEY `meter_no` (`meter_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `meter_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100010;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`meter_no`) REFERENCES `customer` (`meter_no`) ON DELETE CASCADE;

--
-- Constraints for table `customer_report`
--
ALTER TABLE `customer_report`
  ADD CONSTRAINT `customer_report_ibfk_1` FOREIGN KEY (`meter_no`) REFERENCES `customer` (`meter_no`) ON DELETE CASCADE;

--
-- Constraints for table `meter_info`
--
ALTER TABLE `meter_info`
  ADD CONSTRAINT `meter_info_ibfk_1` FOREIGN KEY (`meter_no`) REFERENCES `customer` (`meter_no`) ON DELETE CASCADE;

--
-- Constraints for table `meter_request`
--
ALTER TABLE `meter_request`
  ADD CONSTRAINT `meter_request_ibfk_1` FOREIGN KEY (`meter_no`) REFERENCES `customer` (`meter_no`) ON DELETE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`meter_no`) REFERENCES `customer` (`meter_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
