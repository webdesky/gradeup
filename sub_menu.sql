-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2018 at 02:06 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gradeup`
--

-- --------------------------------------------------------

--
-- Table structure for table `sub_menu`
--

CREATE TABLE `sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `en_sub_menu_name` varchar(255) DEFAULT NULL,
  `hi_sub_menu_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` longtext,
  `meta_keyword` longtext,
  `category_image` varchar(255) DEFAULT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_menu`
--

INSERT INTO `sub_menu` (`id`, `menu_id`, `en_sub_menu_name`, `hi_sub_menu_name`, `url`, `meta_title`, `meta_description`, `meta_keyword`, `category_image`, `banner_image`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 1, 'SBI', ' स्टेट बैंक ऑफ इंडिया', 'xcxzc', 'xcxczc', '<p>dcx</p>\r\n', '<p>xcxzxc</p>\r\n', 'download.png', NULL, '2018-03-19 08:27:40', '2018-03-19 12:57:40', 1),
(2, 1, 'IBPS', 'आईबीपीएस', NULL, NULL, NULL, NULL, NULL, NULL, '2018-03-19 12:18:33', '2018-03-19 16:48:33', 1),
(3, 1, 'RBI', 'भारतीय रिजर्व बैंक', NULL, NULL, NULL, NULL, NULL, NULL, '2018-03-19 12:18:48', '2018-03-19 16:48:48', 1),
(4, 1, 'Insurance', 'बीमा', NULL, NULL, NULL, NULL, NULL, NULL, '2018-03-19 12:19:06', '2018-03-19 16:49:06', 1),
(5, 6, 'SSC & Railways', 'एसएससी और रेलवे', NULL, NULL, NULL, NULL, NULL, NULL, '2018-03-19 12:21:16', '2018-03-19 16:51:16', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sub_menu`
--
ALTER TABLE `sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
