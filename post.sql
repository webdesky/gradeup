-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 16, 2018 at 03:06 PM
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
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `en_post` longtext NOT NULL,
  `hi_post` longtext CHARACTER SET utf8 NOT NULL,
  `en_post_title` varchar(255) NOT NULL,
  `hi_post_title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `module_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `added_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `en_post`, `hi_post`, `en_post_title`, `hi_post_title`, `module_id`, `is_active`, `created_at`, `updated_at`, `added_by`) VALUES
(1, '<p>Here you can build your own fake whatsapp messages and prank your friends. You can change ANYTHING, use emoticons and even upload your own profile photos. This generator is in no way associated with WhatsApp. All graphical material is protected by the copyright owner. May only be used for personal use.</p>', '<p>यहां आप अपने खुद के नकली व्हाट्सएप संदेश बना सकते हैं और अपने दोस्तों को शरारत कर सकते हैं। आप कुछ भी बदल सकते हैं, इमोटिकॉन्स का उपयोग कर सकते हैं और यहां तक कि अपनी प्रोफ़ाइल फ़ोटो भी अपलोड कर सकते हैं। यह जनरेटर व्हाट्सएप के साथ जुड़ा हुआ नहीं है। सभी चित्रमय सामग्री कॉपीराइट स्वामी द्वारा सुरक्षित हैं केवल व्यक्तिगत उपयोग के लिए इस्तेमाल किया जा सकता है</p>', 'banking', 'बैंकिंग', 7, 1, '2018-03-16 13:03:11', '2018-03-16 13:03:11', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
