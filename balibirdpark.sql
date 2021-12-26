-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2021 at 10:37 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `balibirdpark`
--
CREATE DATABASE IF NOT EXISTS `balibirdpark` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `balibirdpark`;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` varchar(36) NOT NULL,
  `package` enum('balinese','indonesian','overseas','vip') NOT NULL,
  `child` int(6) NOT NULL,
  `adult` int(6) NOT NULL,
  `customer_id` varchar(36) NOT NULL,
  `booking_date` date NOT NULL,
  `booking_price` double NOT NULL,
  `payment_method` varchar(12) NOT NULL,
  `payment_date` datetime NOT NULL,
  `booking_status` enum('paid','actived') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `package`, `child`, `adult`, `customer_id`, `booking_date`, `booking_price`, `payment_method`, `payment_date`, `booking_status`) VALUES
('211224160613ZABL', 'vip', 0, 2, '21de7e40e99c3b852885b2a9caea85ef', '2021-12-26', 1500000, 'bca', '2021-12-24 16:06:13', 'actived'),
('211224160636NFST', 'overseas', 0, 4, '21de7e40e99c3b852885b2a9caea85ef', '2021-12-25', 1000000, 'paypal', '2021-12-24 16:06:36', 'actived'),
('211225121034GBXL', 'vip', 0, 1, '21de7e40e99c3b852885b2a9caea85ef', '2021-12-25', 750000, 'bca', '2021-12-25 12:10:34', 'actived'),
('211225163729BFJP', 'balinese', 0, 2, '02aeaa72fd29fc682788b2383ade7dc8', '2021-12-25', 150000, 'bca', '2021-12-25 16:37:29', 'actived'),
('211226154020MTCK', 'overseas', 1, 1, '21de7e40e99c3b852885b2a9caea85ef', '2021-12-31', 375000, 'bca', '2021-12-26 15:40:20', 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(36) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(36) NOT NULL,
  `username` varchar(12) NOT NULL,
  `phone` varchar(24) NOT NULL,
  `role` enum('customer','admin') NOT NULL,
  `status` enum('safe','banned') NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `username`, `phone`, `role`, `status`, `description`) VALUES
('02aeaa72fd29fc682788b2383ade7dc8', 'ciayi@gmail.com', 'f5bb0c8de146c67b44babbf4e6584cc0', 'ciayi', '08980733556', 'customer', 'safe', ''),
('0ffa9d28dc6ac6ac6b1db8b837ad03ad', 'dummy12@data.com', 'f5bb0c8de146c67b44babbf4e6584cc0', 'dummydata12', '081', 'customer', 'safe', ''),
('101a0cdb4665c3b427cabb83b67937ed', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', 'admin_bbp', '-', 'admin', 'safe', ''),
('20915f56f9535d1353a56e461ea57310', 'dummy1@data.com', 'f5bb0c8de146c67b44babbf4e6584cc0', 'dummydata2', '081', 'customer', 'safe', ''),
('21de7e40e99c3b852885b2a9caea85ef', 'cagieeeee@gmail.com', '202cb962ac59075b964b07152d234b70', 'cagie', '08980733556', 'customer', 'safe', ''),
('22eab4afd9d75b89db26ab33ad7fa192', 'elonmusk@gmail.com', '202cb962ac59075b964b07152d234b70', 'elonmusk', '081163752441', 'customer', 'banned', 'Beause you are ugly'),
('6f493f3433afeac7c85d1ba1d2149085', 'dummy@data.co', 'f5bb0c8de146c67b44babbf4e6584cc0', 'dummydata1a', '081', 'customer', 'safe', ''),
('7c35be651c4a9f8ae83870361ba8b02f', 'nicolatesla@gmail.com', '7c35be651c4a9f8ae83870361ba8b02f', 'nicolatesla', '0895624318871', 'customer', 'banned', 'Jump into the bird area'),
('9ef2ec922bf5cfcb3511129b036ea978', 'dummy@data.com', 'f5bb0c8de146c67b44babbf4e6584cc0', 'dummydata1', '081', 'customer', 'safe', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `name` (`username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
