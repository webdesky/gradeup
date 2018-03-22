-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2018 at 07:32 AM
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
-- Table structure for table `super_sub_menu_post`
--

CREATE TABLE `super_sub_menu_post` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `sub_menu_id` int(11) NOT NULL,
  `super_sub_menu_id` int(11) NOT NULL,
  `en_post` longtext NOT NULL,
  `hi_post` longtext CHARACTER SET utf8 NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `super_sub_menu_post`
--

INSERT INTO `super_sub_menu_post` (`id`, `menu_id`, `sub_menu_id`, `super_sub_menu_id`, `en_post`, `hi_post`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 1, 1, 1, '<p>helloassa&nbsp; &nbsp;gaurav</p>', '<p>hellaxsasdsdsdsssdsdsd</p>', '2018-03-22 06:22:37', '2018-03-22 10:52:37', 1),
(9, 6, 5, 5, '<p>ssssasaasassas</p>', '<p>ssssasasasasa</p>', '2018-03-22 06:58:38', '2018-03-22 11:28:38', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `super_sub_menu_post`
--
ALTER TABLE `super_sub_menu_post`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `super_sub_menu_post`
--
ALTER TABLE `super_sub_menu_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
