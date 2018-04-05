-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Apr 03, 2018 at 10:55 AM
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
-- Table structure for table `news_comment`
--

CREATE TABLE IF NOT EXISTS `news_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `news_comment`
--

INSERT INTO `news_comment` (`id`, `user_id`, `news_id`, `comment`, `comment_id`, `created_at`, `is_active`) VALUES
(1, 3, 4, 'sdsd', NULL, '2018-04-02 17:55:13', 1),
(2, 2, 5, 'hello', 1, '2018-04-05 00:00:00', 1),
(3, 3, 5, 'sdsd', NULL, '2018-04-03 13:06:38', 1),
(4, 3, 5, 'sdsd', 3, '2018-04-03 13:07:41', 1),
(5, 3, 4, 'hi1', NULL, '2018-04-03 14:51:52', 1),
(6, 3, 4, 'hi2', NULL, '2018-04-03 14:52:49', 1),
(7, 3, 4, 'asdasd', NULL, '2018-04-03 14:53:38', 1),
(8, 3, 1, 'check', NULL, '2018-04-03 14:54:29', 1),
(9, 3, 1, 'ok123', NULL, '2018-04-03 14:56:19', 1),
(10, 3, 5, 'sdsd', NULL, '2018-04-03 15:05:48', 1),
(11, 3, 5, 'sdsd', NULL, '2018-04-03 15:06:33', 1),
(12, 3, 1, 'or sunao kya haal hai', NULL, '2018-04-03 15:11:33', 1),
(13, 3, 1, 'must hai baba', NULL, '2018-04-03 15:12:07', 1),
(14, 3, 5, 'sdsd', NULL, '2018-04-03 15:13:18', 1),
(15, 3, 5, 'sdsd', NULL, '2018-04-03 15:14:26', 1),
(16, 3, 5, 'sdsd', NULL, '2018-04-03 15:14:31', 1),
(17, 3, 5, 'sdsd', NULL, '2018-04-03 15:14:48', 1),
(18, 3, 5, 'sdsd', NULL, '2018-04-03 15:15:24', 1),
(19, 3, 4, 'ghghghjghj', NULL, '2018-04-03 15:15:54', 1),
(20, 3, 1, 'ok bhai logo', NULL, '2018-04-03 15:16:35', 1),
(21, 3, 1, 'thanks bhai', NULL, '2018-04-03 15:18:04', 1),
(22, 3, 1, 'hi kese ho', NULL, '2018-04-03 15:20:34', 1),
(23, 3, 1, 'fully commepelte', NULL, '2018-04-03 15:24:33', 1),
(24, 3, 1, 'xcvxzcvxzcv', NULL, '2018-04-03 15:25:57', 1),
(25, 3, 1, 'sdfsdfsd', NULL, '2018-04-03 15:28:48', 1),
(26, 3, 1, 'Zcxczxczxczxcxzcxzc', NULL, '2018-04-03 15:32:19', 1),
(27, 3, 1, 'zxczxczxc', NULL, '2018-04-03 15:33:55', 1),
(28, 3, 1, 'sdgdfgdfg', NULL, '2018-04-03 15:35:43', 1),
(29, 3, 1, 'dfgdfgdfgd', NULL, '2018-04-03 15:36:38', 1),
(30, 3, 1, 'hfhfghfgh', NULL, '2018-04-03 15:38:03', 1),
(31, 3, 1, 'sdafsdfsdf', NULL, '2018-04-03 15:49:35', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
