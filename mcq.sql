-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 30, 2018 at 06:20 AM
-- Server version: 5.6.36-82.0-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `webdeqgk_gradeup`
--

-- --------------------------------------------------------

--
-- Table structure for table `mcq`
--

CREATE TABLE IF NOT EXISTS `mcq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` longtext CHARACTER SET utf8 NOT NULL,
  `option_a` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `option_b` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `option_c` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `option_d` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `option_e` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `chapter_id` int(11) NOT NULL,
  `super_submenu_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mcq`
--

INSERT INTO `mcq` (`id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `option_e`, `answer`, `chapter_id`, `super_submenu_id`, `added_by`, `created_at`, `updated_at`, `is_active`) VALUES
(1, '1xc2sddsds3456', '1xc2sddsds3456', '1xc2sddsds3456', '1xc2sddsds3456', '1xc2sddsds3456', '1xc2sddsds3456', 'option_a', 5, 2, 3, '2018-03-27 15:19:42', '2018-03-27 09:49:42', 1),
(2, '1xc2sddsds3456', '1xc2sddsds3456', '1xc2sddsds3456', '1xc2sddsds3456', '1xc2sddsds3456', '1xc2sddsds3456', 'option_a', 3, 2, 4, '2018-03-27 15:29:32', '2018-03-27 09:59:32', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
