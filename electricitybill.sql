-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2024 at 03:04 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `electricitybill`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `bill_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `floor` varchar(255) NOT NULL,
  `rent` varchar(255) NOT NULL,
  `current_unit` varchar(255) NOT NULL,
  `water_unit` varchar(255) NOT NULL,
  `rupee_per_unit` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`bill_id`, `user_id`, `name`, `floor`, `rent`, `current_unit`, `water_unit`, `rupee_per_unit`, `phone`) VALUES
(21, 5, 'Harish sharma', 'IInd Floor', '5800', '13913', '0', '8', '9719448110'),
(47, 7, 'Karan', 'Ist Floor', '10000', '100000', '5', '9', '1234567890'),
(83, 7, 'salman khan', 'Ist Floor', '1', '2', '1', '9', '1234565432'),
(84, 6, 'Aakash', 'Ist Floor', '1000', '10', '10', '10', '1234567890'),
(85, 6, 'Aakash Sharma', 'Ist Floor', '500', '5', '5', '5', '1234512345'),
(117, 38, 'Aakash Sharma', 'Ist Floor', '1', '1', '1', '1', '1234567890');

-- --------------------------------------------------------

--
-- Table structure for table `forgot`
--

CREATE TABLE `forgot` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `history_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `floor` varchar(255) NOT NULL,
  `rent` varchar(255) NOT NULL,
  `current_unit` varchar(255) NOT NULL,
  `previous_unit` varchar(255) NOT NULL,
  `water_unit` varchar(255) NOT NULL,
  `rupee_per_unit` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `bill_date` date NOT NULL,
  `bill_amount` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`history_id`, `user_id`, `bill_id`, `name`, `floor`, `rent`, `current_unit`, `previous_unit`, `water_unit`, `rupee_per_unit`, `phone`, `bill_date`, `bill_amount`) VALUES
(30, 5, 21, 'Harish sharma', 'IInd Floor', '5800', '13801', '13761', '0', '8', '9719448110', '2024-04-01', '6120'),
(55, 5, 21, 'Harish sharma', 'IInd Floor', '5800', '13913', '13801', '0', '8', '9719448110', '2024-05-01', '6696'),
(58, 7, 47, 'Karan', 'Ist Floor', '10000', '100', '9', '55', '9', '1234567890', '2024-05-31', '11314'),
(59, 7, 47, 'Karan', 'Ist Floor', '10000', '110', '100', '55', '9', '1234567890', '2024-06-30', '10585'),
(60, 7, 47, 'Karan', 'Ist Floor', '10000', '200', '110', '5', '9', '1234567890', '2024-05-31', '10855'),
(62, 7, 47, 'Karan', 'Ist Floor', '10000', '100000', '200', '5', '9', '1234567890', '2024-05-29', '908245');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `is_active`) VALUES
(5, 'ntpcrakesh.8510@gmail.com', '12345', 0),
(6, 'aakash203201@gmail.com', '12345', 0),
(7, 'vikas203201@gmail.com', '12345', 0),
(9, 'abc@gmail.com', '$2y$10$tGJcFHPA73ci2jZB7mg4w.THx.jjYTqqMT7SrYzjySaJarDkoQJGe', 0),
(11, 'a@gmail.com', '$2y$10$IuOBQmPtnLs55/seR.xZfOQawBzF1fVAeKGssbuFZRt1HjirOArK.', 0),
(12, 'abcd@gmail.com', '$2y$10$LOgQ8O/hYR0n4GvNclyoie.IT7tSvC3Q.U0G8aMx6rcV0s7f0kiw2', 0),
(13, 'abce@gmail.com', '$2y$10$t9pW9eAB/yLvlXTMg8.TUO8h3CrFh4HIOweLAIFOLnmdbfkyL2ueG', 0),
(38, 'aakashpc203201@gmail.com', '$2y$10$b.I4Wfg.tAFJFEM46LFwqOXRw8jPwD0Dw4silAZ./6BKBYLG7BCKS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `verify_user`
--

CREATE TABLE `verify_user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `verify_user`
--

INSERT INTO `verify_user` (`user_id`, `email`, `token`, `created_time`) VALUES
(38, 'aakashpc203201@gmail.com', '$2y$10$vrrlszaRZ2R9FT.kibeARuJ4rKsghFj6kEwrxDGf1LeQ7zxPHWWjS', '2024-08-23 16:02:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_id`),
  ADD UNIQUE KEY `bill_id` (`bill_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`history_id`),
  ADD UNIQUE KEY `history_id` (`history_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
