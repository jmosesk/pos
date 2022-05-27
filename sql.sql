-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2022 at 02:10 PM
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
-- Table structure for table `rpt_sales`
--

CREATE TABLE `rpt_sales` (
  `id` bigint(255) NOT NULL,
  `close_shift_id` bigint(20) NOT NULL,
  `shift_id` bigint(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `item_id` bigint(255) DEFAULT NULL,
  `employee_id` bigint(255) DEFAULT NULL,
  `centre_id` bigint(255) DEFAULT NULL,
  `sales_qty` varchar(255) NOT NULL DEFAULT '0',
  `price` varchar(255) NOT NULL DEFAULT '0',
  `amount` double NOT NULL,
  `vat_rate` double NOT NULL,
  `measurement_value` double NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rpt_sales`
--
ALTER TABLE `rpt_sales`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rpt_sales`
--
ALTER TABLE `rpt_sales`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



ALTER TABLE `tbl_close_shift_lubes` ADD `rpt_sales_mapping` TINYINT NOT NULL DEFAULT '0' AFTER `status`;