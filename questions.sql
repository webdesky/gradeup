-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2018 at 12:24 PM
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
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `chapter_id` int(11) DEFAULT NULL,
  `question_type` varchar(255) DEFAULT NULL,
  `en_question` longtext,
  `hi_question` longtext,
  `question_marks` varchar(255) DEFAULT NULL,
  `en_option_a` varchar(255) DEFAULT NULL,
  `en_option_b` varchar(255) DEFAULT NULL,
  `en_option_c` varchar(255) DEFAULT NULL,
  `en_option_d` varchar(255) DEFAULT NULL,
  `hi_option_a` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `hi_option_b` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `hi_option_c` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `hi_option_d` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `en_answer` longtext,
  `hi_answer` longtext CHARACTER SET utf8mb4,
  `en_explaination` longtext,
  `hi_explaination` longtext CHARACTER SET utf8mb4,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `module_id`, `chapter_id`, `question_type`, `en_question`, `hi_question`, `question_marks`, `en_option_a`, `en_option_b`, `en_option_c`, `en_option_d`, `hi_option_a`, `hi_option_b`, `hi_option_c`, `hi_option_d`, `en_answer`, `hi_answer`, `en_explaination`, `hi_explaination`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 7, 3, 'Options', '<p>gfgdgdg</p>\r\n', '<p>dfggdg</p>\r\n', '5', '<p>fgfgdf</p>\r\n', '<p>fdgdfgd</p>\r\n', '<p>fgfdg</p>\r\n', '<p>fgdfg</p>\r\n', '<p>fgfgdfg</p>\r\n', '<p>fgdfgdfg</p>\r\n', '<p>gfggd</p>\r\n', '<p>dfgdgd</p>\r\n', '<p>fgfgfdg</p>\r\n', '<p>fgfgd</p>\r\n', '<p>dfgdgdf</p>\r\n', '<p>dfgdfgdf</p>\r\n', '2018-03-15 11:58:08', '2018-03-15 16:28:08', 1),
(2, 7, 2, 'True False', '<p>sdsda</p>\r\n', '<p>asdda</p>\r\n', '5', '', '', '', '', '', '', '', '', '1', '', '<p>sadasdasd</p>\r\n', '<p>sdsdadd</p>\r\n', '2018-03-15 11:58:36', '2018-03-15 16:28:36', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
