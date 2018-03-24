-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 24, 2018 at 09:35 AM
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
-- Table structure for table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `en_module_name` varchar(255) DEFAULT NULL,
  `hi_module_name` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `site_url` varchar(255) DEFAULT NULL,
  `image_folder` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `en_module_name`, `hi_module_name`, `image`, `site_url`, `image_folder`, `created_at`, `updated_at`, `is_active`) VALUES
(9, 'Banking', ' बैंकिंग ', 'banking.png', 'http://webdesky.com/gradeup/', 'asset/uploads/', '2018-03-19 11:09:06', '2018-03-19 15:39:06', 1),
(10, 'SSC & Railways', 'एसएससी और रेलवे', 'banking.png', 'http://webdesky.com/gradeup/', 'asset/uploads/', '2018-03-19 12:20:28', '2018-03-19 16:50:28', 1),
(11, 'UPSC  Civil Services', 'यूपीएससी सिविल सेवा', 'upsc.png', 'http://webdesky.com/gradeup/', 'asset/uploads/', '2018-03-19 12:22:30', '2018-03-19 16:52:30', 1),
(12, 'Teaching Exams', 'शिक्षण परीक्षाएं', 'teaching.png', 'http://webdesky.com/gradeup/', 'asset/uploads/', '2018-03-21 11:53:43', '2018-03-21 06:23:43', 1),
(13, 'MBA prepration Exams', ' एमबीए प्रीप्रेशन परीक्षाएं', 'mba.png', 'http://webdesky.com/gradeup/', 'asset/uploads/', '2018-03-21 11:54:18', '2018-03-21 06:24:18', 1),
(14, 'JEE & BITSAT', ' जेईई और बिटसैट', 'jee.png', 'http://webdesky.com/gradeup/', 'asset/uploads/', '2018-03-21 11:54:45', '2018-03-21 06:24:45', 1),
(15, 'Medical Entrance', 'चिकित्सा प्रवेश', 'medical.png', 'http://webdesky.com/gradeup/', 'asset/uploads/', '2018-03-21 11:55:14', '2018-03-21 06:25:14', 1),
(16, 'Gate & IES', ' गेट और आईईएस', 'gate.png', 'http://webdesky.com/gradeup/', 'asset/uploads/', '2018-03-21 11:55:37', '2018-03-21 06:25:37', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
