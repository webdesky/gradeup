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
-- Table structure for table `super_sub_menu`
--

CREATE TABLE `super_sub_menu` (
  `id` int(11) NOT NULL,
  `sub_menu_id` int(11) DEFAULT NULL,
  `en_super_sub_menu` varchar(255) DEFAULT NULL,
  `hi_super_sub_menu` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
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
-- Dumping data for table `super_sub_menu`
--

INSERT INTO `super_sub_menu` (`id`, `sub_menu_id`, `en_super_sub_menu`, `hi_super_sub_menu`, `url`, `meta_title`, `meta_description`, `meta_keyword`, `category_image`, `banner_image`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 2, 'IBPS Exams', 'आईबीपीएस परीक्षाएं', NULL, NULL, NULL, NULL, NULL, NULL, '2018-03-21 12:09:25', '2018-03-21 16:39:25', 1),
(2, 2, 'Bank Exams', 'बैंक परीक्षा', NULL, NULL, NULL, NULL, NULL, NULL, '2018-03-21 12:13:24', '2018-03-21 16:43:24', 1),
(3, 2, 'IPBS PO', 'आईबीपीएस  पीओ', NULL, NULL, NULL, NULL, NULL, NULL, '2018-03-21 12:14:33', '2018-03-21 16:44:33', 1),
(4, 2, 'IBPS CLERK', 'आईबीपीएस क्लर्क', NULL, NULL, NULL, NULL, NULL, NULL, '2018-03-21 12:14:59', '2018-03-21 16:44:59', 1),
(5, 2, 'IBPS RRB', 'आईबीपीएस आरआरबी', NULL, NULL, NULL, NULL, NULL, NULL, '2018-03-21 12:15:23', '2018-03-21 16:45:23', 1),
(6, 1, 'SBI PO', 'एसबीआई पीओ', 'asssa', 'asas', '<p>asasdfdff</p>\r\n', '<p>asa</p>\r\n', 'download.png', NULL, '2018-03-21 12:16:05', '2018-03-21 16:46:05', 1),
(7, 3, 'RBI GRADE B', 'आरबीआई ग्रेड बी', NULL, NULL, NULL, NULL, NULL, NULL, '2018-03-21 12:16:33', '2018-03-21 16:46:33', 1),
(8, 4, 'INSURANCE EXAMS', 'बीमा परीक्षा', NULL, NULL, NULL, NULL, NULL, NULL, '2018-03-21 12:16:59', '2018-03-21 16:46:59', 1),
(9, 5, 'SSC GCL', 'एसएससी सीजीएल', NULL, NULL, NULL, NULL, NULL, NULL, '2018-03-21 12:18:37', '2018-03-21 16:48:37', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `super_sub_menu`
--
ALTER TABLE `super_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `super_sub_menu`
--
ALTER TABLE `super_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
