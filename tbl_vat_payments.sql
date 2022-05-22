-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2022 at 10:56 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `posmain`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vat_payments`
--

CREATE TABLE `tbl_vat_payments` (
  `payment_id` bigint(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `account_m` int(11) DEFAULT 0,
  `account_c` int(11) DEFAULT 0,
  `account_b` int(11) DEFAULT 0,
  `ref_no` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `invoice_date` date NOT NULL,
  `remarks` text NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vat_payments`
--

INSERT INTO `tbl_vat_payments` (`payment_id`, `reason`, `payment_type`, `account_m`, `account_c`, `account_b`, `ref_no`, `amount`, `invoice_date`, `remarks`, `datetime`, `status`, `deleted`) VALUES
(1, 'Invoice', 1, 0, 0, 200, 'ererrwrw', '4545', '0000-00-00', 'ererer', '2022-05-21 17:33:04', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_vat_payments`
--
ALTER TABLE `tbl_vat_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_vat_payments`
--
ALTER TABLE `tbl_vat_payments`
  MODIFY `payment_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
