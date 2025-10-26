-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 20, 2024 at 09:39 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `umms`
--

-- --------------------------------------------------------

--
-- Table structure for table `delete_log`
--

DROP TABLE IF EXISTS `delete_log`;
CREATE TABLE IF NOT EXISTS `delete_log` (
  `delete_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `reason` varchar(200) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`delete_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

DROP TABLE IF EXISTS `materials`;
CREATE TABLE IF NOT EXISTS `materials` (
  `material_id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `material_name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `buy_price` int NOT NULL,
  `price` int NOT NULL,
  `added_date` date NOT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `img_ext` varchar(6) NOT NULL,
  PRIMARY KEY (`material_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`material_id`, `category_id`, `material_name`, `buy_price`, `price`, `added_date`, `quantity`, `img_ext`) VALUES
(2, 1, 'Holcim Standard Cement ', 2860, 3000, '2024-09-03', 300, ''),
(3, 2, 'Mahiyangana Sand', 11000, 12000, '2024-09-12', 20, ''),
(4, 2, 'Thanamalwila Sand', 10500, 12000, '2024-09-01', 100, ''),
(5, 3, 'Koggala Bricks', 53, 60, '2024-09-03', 2000, ''),
(6, 4, '1.5mm Binding wires - Lanva', 1320, 1400, '2024-09-02', 40, ''),
(7, 4, '2.0 mm Binding Wires - Lanva', 1100, 1200, '2024-09-09', 60, ''),
(8, 5, 'Hexagon Paving Tiles', 55, 60, '2024-09-10', 400, 'jpg'),
(9, 6, 'Lanka Tiles 2x2 - Black - Ceramic', 800, 860, '2024-09-10', 200, 'png'),
(10, 1, 'InSee Standard Cement', 2500, 2800, '2024-09-02', 50, 'jpg'),
(11, 6, 'Aluminium Roofing Sheets', 2800, 3000, '2024-09-04', 200, 'jpg'),
(12, 8, 'Cement Roofing Sheets', 3250, 3500, '2024-09-12', 120, 'jpg'),
(13, 7, 'Kelani 9W LED Bulb', 920, 1000, '2024-09-17', 100, 'jpg'),
(14, 7, 'Panasonic 12W LED Bulb', 1400, 1500, '2024-09-16', 80, 'jpg'),
(15, 9, 'GI Pipes 0.75 Inch - 12Ft', 3800, 4000, '2024-09-12', 80, 'jpg'),
(16, 9, 'GI Pipes 1 Inch - 12Ft', 4200, 4500, '2024-09-18', 100, 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `material_category`
--

DROP TABLE IF EXISTS `material_category`;
CREATE TABLE IF NOT EXISTS `material_category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(60) NOT NULL,
  `quantity_all` int NOT NULL,
  `unit` varchar(10) NOT NULL,
  `extension` varchar(6) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `material_category`
--

INSERT INTO `material_category` (`category_id`, `category_name`, `quantity_all`, `unit`, `extension`) VALUES
(1, 'Cement', 350, '(50KG)', 'jpg'),
(2, 'Sand', 120, 'cube', ''),
(3, 'Bricks', 2400, 'bricks', ''),
(4, 'Binding Wires', 80, 'KG', 'jpg'),
(5, 'Paving Tiles', 400, 'Pcs', 'jpg'),
(6, 'Floor Tiles', 200, 'Pcs', 'png'),
(7, 'Bulbs', 180, 'Pcs', 'jpg'),
(8, 'Roofing Sheets', 120, 'Pcs', 'jpg'),
(9, 'GI Pipes', 180, 'Pipes', 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `msg_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `message` varchar(2000) NOT NULL,
  `answered` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`msg_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `user_id`, `name`, `email`, `message`, `answered`) VALUES
(1, 1, '0', '', 'dnjesbJbeskcvnskvbks', 1),
(2, 10, '0', 'chamadev@wizgentech.com', 'Hello Hello', 1),
(3, 11, 'chamal', 'maximal@gmail.com', 'Hi Lamai', 1),
(4, 12, 'new', 'new@exa.com', 'n kjnnlnlnlbol  jknln', 0),
(5, 14, 'pasindu', 'pasindu@gmail.com', 'Blah Blah ', 1),
(6, 1, 'ucsc', 'chamadev@wizgentech.com', 'jhbeskfbksdnvl fldxmnlkdfrdkv', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `material_id` int NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `address` varchar(100) NOT NULL,
  `quantity` int NOT NULL,
  `sent` varchar(6) NOT NULL DEFAULT 'NO',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=213 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `customer_name`, `material_id`, `phone`, `email`, `address`, `quantity`, `sent`, `time`) VALUES
(1, 1, 'P.Q.R. Silva', 1, '071 123 1234', 'pqrs@gmail.com', 'No.4, Temple Road, Maharagama.', 20, 'YES', '2024-09-19 10:28:13'),
(2, 1, 'P.Q.R. Silva', 4, '071 123 1234', 'pqrs@gmail.com', 'No.4, Temple Road, Maharagama.', 10, 'YES', '2024-09-19 10:28:13'),
(3, 1, 'P.Q.R. Silva', 4, '071 123 1234', 'pqrs@gmail.com', 'No.4, Temple Road, Maharagama.', 5, 'YES', '2024-09-19 10:28:13'),
(4, 1, 'P.Q.R. Silva', 5, '071 123 1234', 'pqrs@gmail.com', 'No.4, Temple Road, Maharagama.', 5000, 'YES', '2024-09-19 10:28:13'),
(5, 1, 'P.Q.R. Silva', 5, '071 123 1234', 'pqrs@gmail.com', 'No.4, Temple Road, Maharagama.', 20, 'YES', '2024-09-19 10:28:13'),
(6, 11, 'CC Het', 2, '070 000 0000', 'maximal@gmail.com', 'Something 07, Somesome', 50, 'YES', '2024-09-19 11:00:04'),
(7, 12, 'new man', 4, '2134241', 'new@exa.com', 'jwSNDOJSDNVVVNVO Ajnjs', 40, 'YES', '2024-09-19 11:13:01'),
(8, 14, 'P.Q.R. Silva', 2, '070 11111', 'pasindu@gmail.com', 'No.4, Temple Road, Maharagama.', 50, 'YES', '2024-09-19 15:12:49'),
(9, 1, 'P.Q.R. Silva', 10, '070 11111', 'chamadev@wizgentech.com', 'No.4, Temple Road, Maharagama.', 100, 'ON_WAY', '2024-09-19 19:10:42'),
(10, 17, 'Person 4', 4, '0740000000', 'p4@gmail.com', 'Address 4', 45, 'NO', '2023-02-20 20:20:16'),
(11, 16, 'Person 3', 7, '0730000000', 'p3@gmail.com', 'Address 3', 13, 'NO', '2024-09-01 16:08:18'),
(12, 17, 'Person 4', 13, '0740000000', 'p4@gmail.com', 'Address 4', 9, 'NO', '2024-05-28 16:19:25'),
(13, 14, 'Person 1', 13, '0710000000', 'p1@gmail.com', 'Address 1', 17, 'NO', '2024-01-30 23:03:57'),
(14, 16, 'Person 3', 12, '0730000000', 'p3@gmail.com', 'Address 3', 84, 'NO', '2023-03-22 18:59:25'),
(15, 17, 'Person 4', 13, '0740000000', 'p4@gmail.com', 'Address 4', 86, 'NO', '2023-07-14 09:01:57'),
(16, 17, 'Person 4', 4, '0740000000', 'p4@gmail.com', 'Address 4', 81, 'NO', '2024-07-04 17:52:05'),
(17, 14, 'Person 1', 15, '0710000000', 'p1@gmail.com', 'Address 1', 27, 'NO', '2024-10-25 02:12:10'),
(18, 15, 'Person 2', 6, '0720000000', 'p2@gmail.com', 'Address 2', 64, 'NO', '2024-04-16 16:45:30'),
(19, 15, 'Person 2', 9, '0720000000', 'p2@gmail.com', 'Address 2', 57, 'NO', '2023-07-20 17:00:49'),
(20, 15, 'Person 2', 12, '0720000000', 'p2@gmail.com', 'Address 2', 22, 'NO', '2023-07-24 04:24:17'),
(21, 15, 'Person 2', 2, '0720000000', 'p2@gmail.com', 'Address 2', 16, 'NO', '2023-03-10 22:18:54'),
(22, 15, 'Person 2', 3, '0720000000', 'p2@gmail.com', 'Address 2', 49, 'NO', '2024-02-06 00:42:24'),
(23, 15, 'Person 2', 13, '0720000000', 'p2@gmail.com', 'Address 2', 15, 'NO', '2024-09-17 13:55:42'),
(24, 14, 'Person 1', 15, '0710000000', 'p1@gmail.com', 'Address 1', 84, 'NO', '2024-11-20 22:04:50'),
(25, 15, 'Person 2', 16, '0720000000', 'p2@gmail.com', 'Address 2', 39, 'NO', '2023-11-21 05:02:14'),
(26, 16, 'Person 3', 16, '0730000000', 'p3@gmail.com', 'Address 3', 93, 'NO', '2024-01-30 13:44:26'),
(27, 14, 'Person 1', 4, '0710000000', 'p1@gmail.com', 'Address 1', 56, 'NO', '2024-02-18 06:03:52'),
(28, 15, 'Person 2', 10, '0720000000', 'p2@gmail.com', 'Address 2', 85, 'NO', '2024-11-08 13:00:57'),
(29, 16, 'Person 3', 8, '0730000000', 'p3@gmail.com', 'Address 3', 95, 'NO', '2024-07-29 23:06:21'),
(30, 14, 'Person 1', 6, '0710000000', 'p1@gmail.com', 'Address 1', 99, 'NO', '2023-10-07 12:04:53'),
(31, 15, 'Person 2', 9, '0720000000', 'p2@gmail.com', 'Address 2', 12, 'NO', '2023-11-07 17:46:15'),
(32, 17, 'Person 4', 8, '0740000000', 'p4@gmail.com', 'Address 4', 22, 'NO', '2024-05-09 01:12:30'),
(33, 16, 'Person 3', 3, '0730000000', 'p3@gmail.com', 'Address 3', 41, 'NO', '2024-08-06 01:11:40'),
(34, 16, 'Person 3', 4, '0730000000', 'p3@gmail.com', 'Address 3', 20, 'NO', '2024-07-08 12:34:08'),
(35, 16, 'Person 3', 14, '0730000000', 'p3@gmail.com', 'Address 3', 68, 'NO', '2023-01-26 08:53:57'),
(36, 15, 'Person 2', 13, '0720000000', 'p2@gmail.com', 'Address 2', 57, 'NO', '2024-11-29 22:03:07'),
(37, 14, 'Person 1', 5, '0710000000', 'p1@gmail.com', 'Address 1', 81, 'NO', '2024-01-08 22:09:35'),
(38, 16, 'Person 3', 15, '0730000000', 'p3@gmail.com', 'Address 3', 4, 'NO', '2024-07-07 22:04:21'),
(39, 14, 'Person 1', 7, '0710000000', 'p1@gmail.com', 'Address 1', 74, 'NO', '2023-10-17 22:32:33'),
(40, 14, 'Person 1', 5, '0710000000', 'p1@gmail.com', 'Address 1', 10, 'NO', '2023-01-21 12:06:18'),
(41, 16, 'Person 3', 5, '0730000000', 'p3@gmail.com', 'Address 3', 58, 'NO', '2024-12-22 05:52:48'),
(42, 15, 'Person 2', 4, '0720000000', 'p2@gmail.com', 'Address 2', 35, 'NO', '2023-01-27 22:11:23'),
(43, 15, 'Person 2', 12, '0720000000', 'p2@gmail.com', 'Address 2', 47, 'NO', '2023-04-13 06:36:57'),
(44, 14, 'Person 1', 16, '0710000000', 'p1@gmail.com', 'Address 1', 25, 'NO', '2024-06-08 21:49:22'),
(45, 15, 'Person 2', 6, '0720000000', 'p2@gmail.com', 'Address 2', 49, 'NO', '2024-02-10 13:03:16'),
(46, 15, 'Person 2', 15, '0720000000', 'p2@gmail.com', 'Address 2', 14, 'NO', '2024-12-08 19:54:04'),
(47, 14, 'Person 1', 2, '0710000000', 'p1@gmail.com', 'Address 1', 7, 'NO', '2023-05-06 17:34:02'),
(48, 14, 'Person 1', 6, '0710000000', 'p1@gmail.com', 'Address 1', 43, 'NO', '2023-06-30 00:31:02'),
(49, 14, 'Person 1', 4, '0710000000', 'p1@gmail.com', 'Address 1', 42, 'NO', '2024-08-02 09:51:05'),
(50, 17, 'Person 4', 5, '0740000000', 'p4@gmail.com', 'Address 4', 52, 'NO', '2024-03-01 12:51:45'),
(51, 16, 'Person 3', 15, '0730000000', 'p3@gmail.com', 'Address 3', 43, 'NO', '2024-01-14 23:17:32'),
(52, 14, 'Person 1', 16, '0710000000', 'p1@gmail.com', 'Address 1', 75, 'NO', '2023-07-11 20:23:25'),
(53, 17, 'Person 4', 10, '0740000000', 'p4@gmail.com', 'Address 4', 96, 'NO', '2023-10-05 01:52:54'),
(54, 15, 'Person 2', 9, '0720000000', 'p2@gmail.com', 'Address 2', 33, 'NO', '2024-01-05 07:06:28'),
(55, 14, 'Person 1', 3, '0710000000', 'p1@gmail.com', 'Address 1', 35, 'NO', '2023-09-16 06:09:59'),
(56, 15, 'Person 2', 4, '0720000000', 'p2@gmail.com', 'Address 2', 89, 'NO', '2023-02-09 01:29:14'),
(57, 16, 'Person 3', 10, '0730000000', 'p3@gmail.com', 'Address 3', 27, 'NO', '2023-12-05 01:09:41'),
(58, 16, 'Person 3', 5, '0730000000', 'p3@gmail.com', 'Address 3', 85, 'NO', '2023-08-14 01:40:44'),
(59, 17, 'Person 4', 14, '0740000000', 'p4@gmail.com', 'Address 4', 60, 'NO', '2024-11-08 10:26:27'),
(60, 16, 'Person 3', 15, '0730000000', 'p3@gmail.com', 'Address 3', 18, 'NO', '2023-03-22 00:14:09'),
(61, 14, 'Person 1', 2, '0710000000', 'p1@gmail.com', 'Address 1', 31, 'NO', '2023-08-23 14:11:40'),
(62, 15, 'Person 2', 7, '0720000000', 'p2@gmail.com', 'Address 2', 64, 'NO', '2023-12-20 02:37:38'),
(63, 17, 'Person 4', 6, '0740000000', 'p4@gmail.com', 'Address 4', 5, 'NO', '2023-10-23 12:47:17'),
(64, 14, 'Person 1', 15, '0710000000', 'p1@gmail.com', 'Address 1', 15, 'NO', '2024-01-13 03:00:25'),
(65, 17, 'Person 4', 14, '0740000000', 'p4@gmail.com', 'Address 4', 22, 'NO', '2023-06-12 13:19:59'),
(66, 17, 'Person 4', 13, '0740000000', 'p4@gmail.com', 'Address 4', 10, 'NO', '2024-09-30 05:45:00'),
(67, 14, 'Person 1', 15, '0710000000', 'p1@gmail.com', 'Address 1', 67, 'NO', '2024-07-07 15:23:12'),
(68, 15, 'Person 2', 11, '0720000000', 'p2@gmail.com', 'Address 2', 38, 'NO', '2023-10-24 07:04:26'),
(69, 14, 'Person 1', 2, '0710000000', 'p1@gmail.com', 'Address 1', 8, 'NO', '2023-01-15 19:07:11'),
(70, 15, 'Person 2', 14, '0720000000', 'p2@gmail.com', 'Address 2', 81, 'NO', '2024-08-09 04:33:50'),
(71, 14, 'Person 1', 16, '0710000000', 'p1@gmail.com', 'Address 1', 94, 'NO', '2023-10-25 16:52:35'),
(72, 15, 'Person 2', 16, '0720000000', 'p2@gmail.com', 'Address 2', 19, 'NO', '2023-09-01 06:24:54'),
(73, 16, 'Person 3', 10, '0730000000', 'p3@gmail.com', 'Address 3', 69, 'NO', '2023-02-14 14:40:39'),
(74, 16, 'Person 3', 6, '0730000000', 'p3@gmail.com', 'Address 3', 63, 'NO', '2024-10-22 06:09:36'),
(75, 15, 'Person 2', 5, '0720000000', 'p2@gmail.com', 'Address 2', 11, 'NO', '2024-11-08 22:07:38'),
(76, 17, 'Person 4', 5, '0740000000', 'p4@gmail.com', 'Address 4', 59, 'NO', '2024-11-22 03:28:11'),
(77, 16, 'Person 3', 14, '0730000000', 'p3@gmail.com', 'Address 3', 91, 'NO', '2023-03-19 17:32:38'),
(78, 17, 'Person 4', 2, '0740000000', 'p4@gmail.com', 'Address 4', 32, 'NO', '2024-11-20 01:11:10'),
(79, 16, 'Person 3', 2, '0730000000', 'p3@gmail.com', 'Address 3', 73, 'NO', '2024-03-14 21:39:02'),
(80, 16, 'Person 3', 10, '0730000000', 'p3@gmail.com', 'Address 3', 62, 'NO', '2024-11-28 13:08:41'),
(81, 17, 'Person 4', 10, '0740000000', 'p4@gmail.com', 'Address 4', 8, 'NO', '2023-08-29 16:30:19'),
(82, 17, 'Person 4', 2, '0740000000', 'p4@gmail.com', 'Address 4', 55, 'NO', '2024-06-17 04:16:03'),
(83, 14, 'Person 1', 4, '0710000000', 'p1@gmail.com', 'Address 1', 19, 'NO', '2023-03-28 00:44:12'),
(84, 14, 'Person 1', 7, '0710000000', 'p1@gmail.com', 'Address 1', 11, 'NO', '2023-06-27 17:09:04'),
(85, 16, 'Person 3', 15, '0730000000', 'p3@gmail.com', 'Address 3', 24, 'NO', '2023-07-17 17:36:36'),
(86, 14, 'Person 1', 6, '0710000000', 'p1@gmail.com', 'Address 1', 34, 'NO', '2023-11-28 21:04:18'),
(87, 15, 'Person 2', 8, '0720000000', 'p2@gmail.com', 'Address 2', 95, 'NO', '2023-07-26 10:51:07'),
(88, 16, 'Person 3', 16, '0730000000', 'p3@gmail.com', 'Address 3', 65, 'NO', '2024-03-15 11:09:37'),
(89, 14, 'Person 1', 12, '0710000000', 'p1@gmail.com', 'Address 1', 5, 'NO', '2023-12-16 00:49:41'),
(90, 17, 'Person 4', 11, '0740000000', 'p4@gmail.com', 'Address 4', 50, 'NO', '2023-09-02 03:41:18'),
(91, 17, 'Person 4', 7, '0740000000', 'p4@gmail.com', 'Address 4', 51, 'NO', '2024-02-05 10:01:44'),
(92, 14, 'Person 1', 9, '0710000000', 'p1@gmail.com', 'Address 1', 86, 'NO', '2024-03-08 22:07:36'),
(93, 15, 'Person 2', 13, '0720000000', 'p2@gmail.com', 'Address 2', 60, 'NO', '2023-07-18 05:24:42'),
(94, 14, 'Person 1', 3, '0710000000', 'p1@gmail.com', 'Address 1', 86, 'NO', '2023-05-08 22:19:52'),
(95, 15, 'Person 2', 9, '0720000000', 'p2@gmail.com', 'Address 2', 11, 'NO', '2023-01-02 03:20:54'),
(96, 14, 'Person 1', 9, '0710000000', 'p1@gmail.com', 'Address 1', 52, 'NO', '2023-12-19 14:14:07'),
(97, 15, 'Person 2', 8, '0720000000', 'p2@gmail.com', 'Address 2', 82, 'NO', '2023-01-05 21:15:32'),
(98, 15, 'Person 2', 14, '0720000000', 'p2@gmail.com', 'Address 2', 46, 'NO', '2024-04-10 11:04:44'),
(99, 15, 'Person 2', 13, '0720000000', 'p2@gmail.com', 'Address 2', 73, 'NO', '2023-10-27 19:42:27'),
(100, 15, 'Person 2', 16, '0720000000', 'p2@gmail.com', 'Address 2', 54, 'NO', '2023-02-27 03:44:25'),
(101, 16, 'Person 3', 3, '0730000000', 'p3@gmail.com', 'Address 3', 93, 'NO', '2024-06-06 06:51:52'),
(102, 14, 'Person 1', 16, '0710000000', 'p1@gmail.com', 'Address 1', 84, 'NO', '2023-04-15 06:17:09'),
(103, 16, 'Person 3', 15, '0730000000', 'p3@gmail.com', 'Address 3', 65, 'NO', '2024-09-24 07:25:01'),
(104, 17, 'Person 4', 13, '0740000000', 'p4@gmail.com', 'Address 4', 28, 'NO', '2023-04-28 03:41:25'),
(105, 15, 'Person 2', 8, '0720000000', 'p2@gmail.com', 'Address 2', 18, 'NO', '2024-09-15 20:52:07'),
(106, 17, 'Person 4', 6, '0740000000', 'p4@gmail.com', 'Address 4', 3, 'NO', '2023-04-03 12:24:47'),
(107, 15, 'Person 2', 12, '0720000000', 'p2@gmail.com', 'Address 2', 91, 'NO', '2024-06-18 12:24:47'),
(108, 14, 'Person 1', 5, '0710000000', 'p1@gmail.com', 'Address 1', 32, 'NO', '2023-10-18 06:43:48'),
(109, 16, 'Person 3', 7, '0730000000', 'p3@gmail.com', 'Address 3', 90, 'NO', '2023-12-01 09:05:25'),
(110, 15, 'Person 2', 8, '0720000000', 'p2@gmail.com', 'Address 2', 94, 'NO', '2024-11-20 23:17:55'),
(111, 16, 'Person 3', 13, '0730000000', 'p3@gmail.com', 'Address 3', 75, 'NO', '2023-06-28 04:34:57'),
(112, 15, 'Person 2', 6, '0720000000', 'p2@gmail.com', 'Address 2', 89, 'NO', '2024-04-18 18:48:42'),
(113, 14, 'Person 1', 3, '0710000000', 'p1@gmail.com', 'Address 1', 17, 'NO', '2024-05-20 18:37:48'),
(114, 14, 'Person 1', 8, '0710000000', 'p1@gmail.com', 'Address 1', 1, 'NO', '2023-05-29 19:16:18'),
(115, 17, 'Person 4', 16, '0740000000', 'p4@gmail.com', 'Address 4', 50, 'NO', '2024-08-31 21:54:16'),
(116, 16, 'Person 3', 14, '0730000000', 'p3@gmail.com', 'Address 3', 18, 'NO', '2024-03-26 22:46:37'),
(117, 15, 'Person 2', 5, '0720000000', 'p2@gmail.com', 'Address 2', 10, 'NO', '2024-05-07 00:17:36'),
(118, 14, 'Person 1', 5, '0710000000', 'p1@gmail.com', 'Address 1', 51, 'NO', '2023-10-03 01:22:49'),
(119, 16, 'Person 3', 4, '0730000000', 'p3@gmail.com', 'Address 3', 51, 'NO', '2024-08-25 16:42:05'),
(120, 17, 'Person 4', 14, '0740000000', 'p4@gmail.com', 'Address 4', 93, 'NO', '2024-05-31 00:04:40'),
(121, 15, 'Person 2', 4, '0720000000', 'p2@gmail.com', 'Address 2', 98, 'NO', '2023-03-26 06:40:06'),
(122, 14, 'Person 1', 7, '0710000000', 'p1@gmail.com', 'Address 1', 53, 'NO', '2023-01-18 18:38:29'),
(123, 16, 'Person 3', 8, '0730000000', 'p3@gmail.com', 'Address 3', 100, 'NO', '2024-03-01 22:22:04'),
(124, 16, 'Person 3', 16, '0730000000', 'p3@gmail.com', 'Address 3', 30, 'NO', '2023-01-15 05:55:30'),
(125, 17, 'Person 4', 3, '0740000000', 'p4@gmail.com', 'Address 4', 10, 'NO', '2023-10-28 07:00:25'),
(126, 14, 'Person 1', 8, '0710000000', 'p1@gmail.com', 'Address 1', 70, 'NO', '2023-04-24 13:18:41'),
(127, 16, 'Person 3', 16, '0730000000', 'p3@gmail.com', 'Address 3', 13, 'NO', '2023-12-20 07:08:15'),
(128, 14, 'Person 1', 3, '0710000000', 'p1@gmail.com', 'Address 1', 4, 'NO', '2024-08-10 14:34:59'),
(129, 16, 'Person 3', 6, '0730000000', 'p3@gmail.com', 'Address 3', 48, 'NO', '2023-05-27 10:17:01'),
(130, 17, 'Person 4', 6, '0740000000', 'p4@gmail.com', 'Address 4', 84, 'NO', '2023-08-17 05:56:22'),
(131, 16, 'Person 3', 14, '0730000000', 'p3@gmail.com', 'Address 3', 63, 'NO', '2023-11-23 16:09:34'),
(132, 14, 'Person 1', 10, '0710000000', 'p1@gmail.com', 'Address 1', 9, 'NO', '2023-07-04 14:05:29'),
(133, 14, 'Person 1', 12, '0710000000', 'p1@gmail.com', 'Address 1', 48, 'NO', '2023-02-05 21:24:56'),
(134, 14, 'Person 1', 10, '0710000000', 'p1@gmail.com', 'Address 1', 35, 'NO', '2023-10-08 11:52:40'),
(135, 17, 'Person 4', 13, '0740000000', 'p4@gmail.com', 'Address 4', 52, 'NO', '2023-08-12 14:53:23'),
(136, 16, 'Person 3', 10, '0730000000', 'p3@gmail.com', 'Address 3', 45, 'NO', '2024-03-19 04:35:56'),
(137, 14, 'Person 1', 10, '0710000000', 'p1@gmail.com', 'Address 1', 37, 'NO', '2023-03-30 23:50:32'),
(138, 17, 'Person 4', 15, '0740000000', 'p4@gmail.com', 'Address 4', 19, 'NO', '2024-03-03 14:43:01'),
(139, 17, 'Person 4', 3, '0740000000', 'p4@gmail.com', 'Address 4', 28, 'NO', '2024-07-02 05:55:07'),
(140, 14, 'Person 1', 6, '0710000000', 'p1@gmail.com', 'Address 1', 39, 'NO', '2024-05-14 17:03:15'),
(141, 16, 'Person 3', 11, '0730000000', 'p3@gmail.com', 'Address 3', 36, 'NO', '2023-03-06 08:35:37'),
(142, 17, 'Person 4', 10, '0740000000', 'p4@gmail.com', 'Address 4', 10, 'NO', '2024-03-25 16:58:18'),
(143, 15, 'Person 2', 5, '0720000000', 'p2@gmail.com', 'Address 2', 91, 'NO', '2023-03-18 11:36:22'),
(144, 17, 'Person 4', 16, '0740000000', 'p4@gmail.com', 'Address 4', 93, 'NO', '2023-01-01 01:18:19'),
(145, 17, 'Person 4', 3, '0740000000', 'p4@gmail.com', 'Address 4', 51, 'NO', '2023-12-20 15:33:18'),
(146, 15, 'Person 2', 4, '0720000000', 'p2@gmail.com', 'Address 2', 73, 'NO', '2024-06-07 02:33:22'),
(147, 16, 'Person 3', 2, '0730000000', 'p3@gmail.com', 'Address 3', 20, 'NO', '2024-10-01 21:48:00'),
(148, 16, 'Person 3', 16, '0730000000', 'p3@gmail.com', 'Address 3', 27, 'NO', '2024-03-25 14:58:52'),
(149, 16, 'Person 3', 12, '0730000000', 'p3@gmail.com', 'Address 3', 85, 'NO', '2024-09-04 02:45:24'),
(150, 14, 'Person 1', 16, '0710000000', 'p1@gmail.com', 'Address 1', 34, 'NO', '2024-03-27 21:26:29'),
(151, 15, 'Person 2', 12, '0720000000', 'p2@gmail.com', 'Address 2', 2, 'NO', '2023-01-12 04:36:51'),
(152, 14, 'Person 1', 2, '0710000000', 'p1@gmail.com', 'Address 1', 24, 'NO', '2024-10-02 01:54:16'),
(153, 16, 'Person 3', 4, '0730000000', 'p3@gmail.com', 'Address 3', 75, 'NO', '2024-01-29 21:49:01'),
(154, 14, 'Person 1', 15, '0710000000', 'p1@gmail.com', 'Address 1', 88, 'NO', '2024-03-16 16:06:30'),
(155, 16, 'Person 3', 2, '0730000000', 'p3@gmail.com', 'Address 3', 52, 'NO', '2023-01-07 01:32:04'),
(156, 16, 'Person 3', 10, '0730000000', 'p3@gmail.com', 'Address 3', 58, 'NO', '2023-12-31 12:12:21'),
(157, 16, 'Person 3', 14, '0730000000', 'p3@gmail.com', 'Address 3', 91, 'NO', '2024-02-12 05:26:08'),
(158, 17, 'Person 4', 8, '0740000000', 'p4@gmail.com', 'Address 4', 63, 'NO', '2024-08-08 23:52:20'),
(159, 14, 'Person 1', 3, '0710000000', 'p1@gmail.com', 'Address 1', 11, 'NO', '2023-10-18 00:53:01'),
(160, 16, 'Person 3', 6, '0730000000', 'p3@gmail.com', 'Address 3', 71, 'NO', '2024-03-27 23:25:12'),
(161, 17, 'Person 4', 16, '0740000000', 'p4@gmail.com', 'Address 4', 64, 'NO', '2024-12-04 07:49:46'),
(162, 15, 'Person 2', 14, '0720000000', 'p2@gmail.com', 'Address 2', 78, 'NO', '2023-01-07 23:47:00'),
(163, 15, 'Person 2', 5, '0720000000', 'p2@gmail.com', 'Address 2', 54, 'NO', '2024-04-15 10:54:39'),
(164, 17, 'Person 4', 11, '0740000000', 'p4@gmail.com', 'Address 4', 46, 'NO', '2023-07-22 08:59:28'),
(165, 16, 'Person 3', 3, '0730000000', 'p3@gmail.com', 'Address 3', 63, 'NO', '2024-01-11 13:01:13'),
(166, 14, 'Person 1', 5, '0710000000', 'p1@gmail.com', 'Address 1', 40, 'NO', '2024-04-01 14:57:25'),
(167, 16, 'Person 3', 7, '0730000000', 'p3@gmail.com', 'Address 3', 69, 'NO', '2023-05-19 18:11:17'),
(168, 14, 'Person 1', 10, '0710000000', 'p1@gmail.com', 'Address 1', 45, 'NO', '2023-08-16 11:26:17'),
(169, 16, 'Person 3', 3, '0730000000', 'p3@gmail.com', 'Address 3', 42, 'NO', '2023-12-01 00:09:29'),
(170, 16, 'Person 3', 3, '0730000000', 'p3@gmail.com', 'Address 3', 48, 'NO', '2024-01-22 16:35:30'),
(171, 16, 'Person 3', 15, '0730000000', 'p3@gmail.com', 'Address 3', 7, 'NO', '2024-04-12 00:29:14'),
(172, 14, 'Person 1', 3, '0710000000', 'p1@gmail.com', 'Address 1', 95, 'NO', '2023-05-27 05:02:43'),
(173, 16, 'Person 3', 10, '0730000000', 'p3@gmail.com', 'Address 3', 4, 'NO', '2023-02-15 18:38:37'),
(174, 16, 'Person 3', 8, '0730000000', 'p3@gmail.com', 'Address 3', 46, 'NO', '2024-04-24 18:32:42'),
(175, 14, 'Person 1', 16, '0710000000', 'p1@gmail.com', 'Address 1', 93, 'NO', '2023-12-25 04:09:25'),
(176, 16, 'Person 3', 16, '0730000000', 'p3@gmail.com', 'Address 3', 68, 'NO', '2023-08-10 14:49:46'),
(177, 16, 'Person 3', 13, '0730000000', 'p3@gmail.com', 'Address 3', 59, 'NO', '2024-09-17 02:11:21'),
(178, 16, 'Person 3', 10, '0730000000', 'p3@gmail.com', 'Address 3', 91, 'NO', '2023-02-22 15:10:09'),
(179, 16, 'Person 3', 13, '0730000000', 'p3@gmail.com', 'Address 3', 66, 'NO', '2023-02-28 10:43:09'),
(180, 14, 'Person 1', 5, '0710000000', 'p1@gmail.com', 'Address 1', 96, 'NO', '2023-09-23 03:38:00'),
(181, 14, 'Person 1', 8, '0710000000', 'p1@gmail.com', 'Address 1', 62, 'NO', '2023-10-02 22:26:31'),
(182, 14, 'Person 1', 12, '0710000000', 'p1@gmail.com', 'Address 1', 57, 'NO', '2023-08-04 12:52:13'),
(183, 17, 'Person 4', 12, '0740000000', 'p4@gmail.com', 'Address 4', 93, 'NO', '2024-08-02 12:24:18'),
(184, 14, 'Person 1', 13, '0710000000', 'p1@gmail.com', 'Address 1', 57, 'NO', '2023-03-02 07:29:51'),
(185, 17, 'Person 4', 13, '0740000000', 'p4@gmail.com', 'Address 4', 47, 'NO', '2024-11-11 05:12:20'),
(186, 17, 'Person 4', 16, '0740000000', 'p4@gmail.com', 'Address 4', 96, 'NO', '2024-03-29 05:08:30'),
(187, 16, 'Person 3', 15, '0730000000', 'p3@gmail.com', 'Address 3', 41, 'NO', '2023-09-27 14:50:48'),
(188, 17, 'Person 4', 3, '0740000000', 'p4@gmail.com', 'Address 4', 35, 'NO', '2024-01-14 11:15:04'),
(189, 17, 'Person 4', 16, '0740000000', 'p4@gmail.com', 'Address 4', 49, 'NO', '2024-02-06 04:34:08'),
(190, 14, 'Person 1', 5, '0710000000', 'p1@gmail.com', 'Address 1', 28, 'NO', '2023-09-25 06:52:10'),
(191, 16, 'Person 3', 8, '0730000000', 'p3@gmail.com', 'Address 3', 70, 'NO', '2024-12-18 03:10:01'),
(192, 15, 'Person 2', 5, '0720000000', 'p2@gmail.com', 'Address 2', 25, 'NO', '2023-05-24 23:59:14'),
(193, 17, 'Person 4', 3, '0740000000', 'p4@gmail.com', 'Address 4', 95, 'NO', '2023-05-08 18:28:25'),
(194, 16, 'Person 3', 14, '0730000000', 'p3@gmail.com', 'Address 3', 76, 'NO', '2024-08-10 16:23:51'),
(195, 17, 'Person 4', 5, '0740000000', 'p4@gmail.com', 'Address 4', 65, 'NO', '2024-10-22 05:56:30'),
(196, 16, 'Person 3', 9, '0730000000', 'p3@gmail.com', 'Address 3', 60, 'NO', '2023-10-04 05:34:12'),
(197, 14, 'Person 1', 7, '0710000000', 'p1@gmail.com', 'Address 1', 10, 'NO', '2024-04-17 08:36:07'),
(198, 16, 'Person 3', 13, '0730000000', 'p3@gmail.com', 'Address 3', 28, 'NO', '2024-02-25 06:53:25'),
(199, 14, 'Person 1', 3, '0710000000', 'p1@gmail.com', 'Address 1', 73, 'NO', '2023-04-13 20:01:56'),
(200, 17, 'Person 4', 4, '0740000000', 'p4@gmail.com', 'Address 4', 29, 'NO', '2024-01-18 20:44:56'),
(201, 15, 'Person 2', 2, '0720000000', 'p2@gmail.com', 'Address 2', 27, 'NO', '2024-06-22 08:52:50'),
(202, 17, 'Person 4', 14, '0740000000', 'p4@gmail.com', 'Address 4', 68, 'NO', '2024-08-16 09:25:25'),
(203, 14, 'Person 1', 15, '0710000000', 'p1@gmail.com', 'Address 1', 68, 'NO', '2023-10-03 08:43:46'),
(204, 16, 'Person 3', 6, '0730000000', 'p3@gmail.com', 'Address 3', 81, 'NO', '2023-05-24 10:53:47'),
(205, 14, 'Person 1', 13, '0710000000', 'p1@gmail.com', 'Address 1', 21, 'NO', '2024-10-27 22:36:06'),
(206, 14, 'Person 1', 8, '0710000000', 'p1@gmail.com', 'Address 1', 33, 'NO', '2024-03-13 16:58:32'),
(207, 16, 'Person 3', 12, '0730000000', 'p3@gmail.com', 'Address 3', 87, 'NO', '2024-07-04 06:29:16'),
(208, 17, 'Person 4', 3, '0740000000', 'p4@gmail.com', 'Address 4', 79, 'NO', '2024-01-30 19:37:16'),
(209, 15, 'Person 2', 14, '0720000000', 'p2@gmail.com', 'Address 2', 8, 'NO', '2024-02-15 15:46:30'),
(210, 15, 'Person 2', 12, '0720000000', 'p2@gmail.com', 'Address 2', 30, 'NO', '2023-10-19 01:09:17'),
(211, 14, 'Person 1', 4, '0710000000', 'p1@gmail.com', 'Address 1', 21, 'NO', '2024-08-06 14:21:33'),
(212, 14, 'Person 1', 12, '0710000000', 'p1@gmail.com', 'Address 1', 35, 'NO', '2024-10-25 03:05:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(32) NOT NULL,
  `password_change` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `password_change`, `role`) VALUES
(1, 'ucsc', 'chamadev@wizgentech.com', 'ucsc', '2024-09-19 03:20:09', 'ordinary'),
(2, 'admin', '', 'admin', '2024-09-18 19:32:36', 'admin'),
(14, 'pasindu', 'pasii@gmail.com', '12345', '2024-09-20 07:17:15', 'ordinary'),
(11, 'chamal', 'maximal@gmail.com', '1234', '2024-09-18 16:47:05', 'ordinary'),
(13, 'deliver', '', 'deliver', '2024-09-19 14:17:59', 'delivery');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
