-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2018 at 12:20 PM
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
-- Table structure for table `featured_links`
--

CREATE TABLE `featured_links` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `featured_links`
--

INSERT INTO `featured_links` (`id`, `category_id`, `title`, `url`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 1, 'Static GK Quiz 07.10.2017', '#', '2018-04-02 12:03:25', '2018-04-02 15:33:25', 1),
(3, 1, 'Syndicate Bank PO Exam Analysis 2018: 25th February (Second Shift)', '#', '2018-04-02 12:08:13', '2018-04-02 15:38:13', 1),
(4, 1, 'SBI Clerk Previous Year Question Paper with Answers (Hindi/Eng), Download PDF!', '#', '2018-04-02 12:08:27', '2018-04-02 15:38:27', 1),
(5, 1, 'List of Best Books for SBI Clerk 2018 Exam Preparation!', '#', '2018-04-02 12:08:46', '2018-04-02 15:38:46', 1),
(6, 4, 'GK Updates 15th- 21st Oct', '#', '2018-04-02 12:14:21', '2018-04-02 15:44:21', 1),
(7, 4, 'GK Updates 08th- 14th Oct', '#', '2018-04-02 12:14:38', '2018-04-02 15:44:38', 1),
(8, 4, 'Monthly GK Digest : Sept', '#', '2018-04-02 12:14:50', '2018-04-02 15:44:50', 1),
(9, 4, 'Monthly GK Digest : August', '#', '2018-04-02 12:15:08', '2018-04-02 15:45:08', 1),
(10, 5, 'Quantitative Notes', '#', '2018-04-02 12:15:40', '2018-04-02 15:45:40', 1),
(11, 5, 'Reasoning Notes', '#', '2018-04-02 12:15:52', '2018-04-02 15:45:52', 1),
(12, 5, 'Marketing Notes', '#', '2018-04-02 12:16:04', '2018-04-02 15:46:04', 1),
(13, 5, 'English Notes', '#', '2018-04-02 12:16:18', '2018-04-02 15:46:18', 1),
(14, 5, 'Computer Notes', '#', '2018-04-02 12:16:30', '2018-04-02 15:46:30', 1),
(15, 6, 'Quantitative Quizzes', '#', '2018-04-02 12:16:44', '2018-04-02 15:46:44', 1),
(16, 6, 'Reasoning Quizzes', '#', '2018-04-02 12:16:54', '2018-04-02 15:46:54', 1),
(17, 6, 'DI Quizzes', '#', '2018-04-02 12:17:05', '2018-04-02 15:47:05', 1),
(18, 6, 'English Quizzes', '#', '2018-04-02 12:17:15', '2018-04-02 15:47:15', 1),
(19, 6, 'Computer Quizzes', '#', '2018-04-02 12:17:27', '2018-04-02 15:47:27', 1),
(20, 6, 'GK Quizzes', '#', '2018-04-02 12:17:37', '2018-04-02 15:47:37', 1),
(21, 7, 'Daily GK Updates', '#', '2018-04-02 12:18:05', '2018-04-02 15:48:05', 1),
(22, 7, 'Monthly GK Updates', '#', '2018-04-02 12:18:17', '2018-04-02 15:48:17', 1),
(23, 7, 'Weekly One Liners', '#', '2018-04-02 12:18:29', '2018-04-02 15:48:29', 1),
(24, 7, 'General Awareness', '#', '2018-04-02 12:18:42', '2018-04-02 15:48:42', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `featured_links`
--
ALTER TABLE `featured_links`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `featured_links`
--
ALTER TABLE `featured_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
