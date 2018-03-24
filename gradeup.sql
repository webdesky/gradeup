-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 24, 2018 at 12:52 PM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.0.28-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `testimonial` longtext NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `user_id`, `testimonial`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 3, 'A dream come true for aspirants of gov jobs!!get connected with real time seriously hard working scholars!!', 1, '2018-03-24 04:21:39', '2018-03-24 10:50:17');

-- --------------------------------------------------------

--
-- Table structure for table `why_choose_us`
--

CREATE TABLE `why_choose_us` (
  `id` int(11) NOT NULL,
  `en_title` varchar(255) NOT NULL,
  `en_content` longtext NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `hi_title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `hi_content` longtext CHARACTER SET utf8 NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `why_choose_us`
--

INSERT INTO `why_choose_us` (`id`, `en_title`, `en_content`, `image`, `hi_title`, `hi_content`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Real-time Exam Prep Community', '<p>&nbsp;</p>\r\n\r\n<p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor.</p>', NULL, 'रीयल-टाइम परीक्षा तैयारी समुदाय', '<p>एनिम उनके परिवार के लिए उच्च जीवन अभियुक्त टेरी रिचर्डसन एड स्क्वीड के बारे में पूछताछ करता है। 3 भेड़िया चाँद officia aute, गैर cupidatat स्केटबोर्ड रंग</p>', 1, '2018-03-24 12:22:45', '2018-03-24 12:22:45'),
(2, 'Real-time Exam Prep Community', '<p>&nbsp;</p>\r\n\r\n<p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor.</p>', '5ab5fa8211fbd.png', 'रीयल-टाइम परीक्षा तैयारी समुदाय', '<p>एनिम उनके परिवार के लिए उच्च जीवन अभियुक्त टेरी रिचर्डसन एड स्क्वीड के बारे में पूछताछ करता है। 3 भेड़िया चाँद officia aute, गैर cupidatat स्केटबोर्ड रंग</p>', 1, '2018-03-24 12:35:56', '2018-03-24 12:35:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `why_choose_us`
--
ALTER TABLE `why_choose_us`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `why_choose_us`
--
ALTER TABLE `why_choose_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
