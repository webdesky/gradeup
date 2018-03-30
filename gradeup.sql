-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 30, 2018 at 05:14 PM
-- Server version: 5.7.21-0ubuntu0.17.10.1
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
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `en_title` varchar(255) NOT NULL,
  `hi_title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `en_description` longtext,
  `hi_description` longtext CHARACTER SET utf8,
  `en_address` varchar(255) DEFAULT NULL,
  `hi_address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `blog_date` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `en_title`, `hi_title`, `en_description`, `hi_description`, `en_address`, `hi_address`, `blog_date`, `image`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'The Amar Blog', 'The Amar Blog', '<p>I Am Amar Jain.</p>', '<p>I Am Amar Jain.</p>\r\n', '121 King Street, Melbourne', '121 King Street, Melbourne', '2018-03-21', '^13B972C52D5A1F4263ED192BB6A2A0D12D811CA627B6AD852C^pimgpsh_mobile_save_distr.jpg', '2018-03-27 11:55:27', '2018-03-27 06:25:27', 1),
(2, 'the Celebration', 'The Celebration', '<p>Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.</p>', '<p>Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.</p>\r\n', '121 King Street, Melbourne', '121 King Street, Melbourne', '2018-03-30', '2.jpg', '2018-03-27 16:32:49', '2018-03-27 11:02:49', 1),
(3, 'The Blog Maker', 'The Blog Maker', '<p>Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Curabitur aliquet quam id dui posuere blandit.</p>', '<p>Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Curabitur aliquet quam id dui posuere blandit.</p>\r\n', '121 King Street, Melbourne', '121 King Street, Melbourne', '2018-03-15', 'download.png', '2018-03-27 16:33:54', '2018-03-27 11:03:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id` int(11) NOT NULL,
  `fk_module_id` int(11) DEFAULT NULL,
  `en_chapter_name` varchar(255) DEFAULT NULL,
  `hi_chapter_name` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`id`, `fk_module_id`, `en_chapter_name`, `hi_chapter_name`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 9, 'General Awareness', 'General Awareness', '2018-03-26 15:53:52', '2018-03-26 10:23:52', 1),
(6, 9, 'Quantitative Aptitude', 'Quantitative Aptitude', '2018-03-26 15:54:11', '2018-03-26 10:24:11', 1),
(7, 9, 'English Comprehension', 'English Comprehension', '2018-03-26 15:55:06', '2018-03-26 10:25:06', 1),
(8, 9, 'General Intelligence and Reasoning', 'General Intelligence and Reasoning', '2018-03-26 15:55:19', '2018-03-26 10:25:19', 1),
(9, 9, 'Descriptive Paper', 'Descriptive Paper', '2018-03-26 15:55:37', '2018-03-26 10:25:37', 1),
(10, 9, 'Daily GK Updates', 'Daily GK Updates', '2018-03-26 15:55:48', '2018-03-26 10:25:48', 1),
(11, 9, 'General', 'General', '2018-03-26 15:56:04', '2018-03-26 10:26:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `event_date` varchar(255) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `description` longtext,
  `address` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `title`, `event_date`, `start_time`, `end_time`, `description`, `address`, `image`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'Gear up for giving', '2018-03-28', '05:30 PM', '09:30 PM', '<p>Lorem ipsum dolor sit ametasasasasa&nbsp; &nbsp;gaurav badlani</p>\r\n\r\n<p>&nbsp;</p>', '<p>New york</p>', 'download.png', '2018-03-24 08:03:49', '2018-03-24 12:33:49', 1),
(2, 'Gear Up For Giving', '2018-03-30', '04:00 PM', '05:00 PM', '<p>testing</p>', '<p>Indore</p>', '', '2018-03-24 12:55:27', '2018-03-24 07:25:27', 1),
(3, 'Gear Up For Giving', '2018-03-31', '03:00 PM', '03:30 PM', '<p>Test</p>', '<p>Bhopal</p>', '', '2018-03-24 12:56:06', '2018-03-24 07:26:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` int(11) NOT NULL,
  `exam_name` varchar(255) NOT NULL,
  `package_id` int(11) NOT NULL,
  `time_per_question` double NOT NULL,
  `passing_marks` double(10,2) NOT NULL,
  `positive_mark` double(10,2) NOT NULL,
  `negative_mark` double(10,2) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `exam_name`, `package_id`, `time_per_question`, `passing_marks`, `positive_mark`, `negative_mark`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'bank p.o. mock test', 1, 30, 3.50, 10.00, 2.50, '2018-03-30 16:52:36', '2018-03-30 16:52:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mcq`
--

CREATE TABLE `mcq` (
  `id` int(11) NOT NULL,
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
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mcq`
--

INSERT INTO `mcq` (`id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `option_e`, `answer`, `chapter_id`, `super_submenu_id`, `added_by`, `created_at`, `updated_at`, `is_active`) VALUES
(1, '1xc2sddsds3456', '1xc2sddsds3456', '1xc2sddsds3456', '1xc2sddsds3456', '1xc2sddsds3456', '1xc2sddsds3456', 'option_a', 5, 2, 3, '2018-03-27 15:19:42', '2018-03-27 09:49:42', 1),
(2, '1xc2sddsds3456', '1xc2sddsds3456', '1xc2sddsds3456', '1xc2sddsds3456', '1xc2sddsds3456', '1xc2sddsds3456', 'option_a', 3, 2, 4, '2018-03-27 15:29:32', '2018-03-27 09:59:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `en_menu_name` varchar(255) DEFAULT NULL,
  `hi_menu_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `module_id`, `en_menu_name`, `hi_menu_name`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 9, 'Banking', 'बैंकिंग ', '2018-03-19 08:14:08', '2018-03-19 12:44:08', 1),
(6, 10, 'SSC', 'एसएससी ', '2018-03-19 12:20:43', '2018-03-19 16:50:43', 1),
(7, 11, 'UPSC', 'यूपीएससी ', '2018-03-19 12:23:36', '2018-03-19 16:53:36', 1),
(8, 12, 'Teaching', ' शिक्षण', '2018-03-21 11:56:23', '2018-03-21 06:26:23', 1),
(9, 14, 'JEE', ' जेईई', '2018-03-21 11:56:50', '2018-03-21 06:26:50', 1),
(10, 15, 'Medical', ' मेडिकल', '2018-03-21 11:57:24', '2018-03-21 06:27:24', 1),
(11, 9, 'Test Series', ' टेस्ट सीरीज़     ', '2018-03-26 11:57:20', '2018-03-26 06:27:20', 1),
(13, 16, 'Engineering  Exams', 'इंजीनियरिंग परीक्षाएं        ', '2018-03-26 13:15:58', '2018-03-26 07:45:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `en_module_name` varchar(255) DEFAULT NULL,
  `hi_module_name` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `en_module_name`, `hi_module_name`, `image`, `created_at`, `updated_at`, `is_active`) VALUES
(9, 'Banking', ' बैंकिंग ', 'banking.png', '2018-03-19 11:09:06', '2018-03-19 15:39:06', 1),
(10, 'SSC & Railways', 'एसएससी और रेलवे', 'ssc.png', '2018-03-19 12:20:28', '2018-03-19 16:50:28', 1),
(11, 'UPSC  Civil Services', 'यूपीएससी सिविल सेवा', 'upsc.png', '2018-03-19 12:22:30', '2018-03-19 16:52:30', 1),
(12, 'Teaching Exams', 'शिक्षण परीक्षाएं', 'teaching.png', '2018-03-21 11:53:43', '2018-03-21 06:23:43', 1),
(13, 'MBA prepration Exams', ' एमबीए प्रीप्रेशन परीक्षाएं', 'mba.png', '2018-03-21 11:54:18', '2018-03-21 06:24:18', 1),
(14, 'JEE & BITSAT', ' जेईई और बिटसैट', 'jee.png', '2018-03-21 11:54:45', '2018-03-21 06:24:45', 1),
(15, 'Medical Entrance', 'चिकित्सा प्रवेश', 'medical.png', '2018-03-21 11:55:14', '2018-03-21 06:25:14', 1),
(16, 'Gate & IES', ' गेट और आईईएस', 'gate.png', '2018-03-21 11:55:37', '2018-03-21 06:25:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `news_description` longtext CHARACTER SET utf8,
  `news_url` varchar(255) DEFAULT NULL,
  `news_image` varchar(255) DEFAULT NULL,
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
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `news_description`, `news_url`, `news_image`, `url`, `meta_title`, `meta_description`, `meta_keyword`, `category_image`, `banner_image`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'AAP allots 26% to education sector: Delhi Budget 2018-19', '<p>testing</p>\r\n', 'Testing', 'untitled-design-1-img1521741626935-60.jpg-rs-high-webp.jpg', 'sdsd', 'sdsd', '<p>sds</p>\r\n', '<p>sdsd</p>\r\n', 'download.png', 'download.png', '2018-03-24 06:26:08', '2018-03-24 10:56:08', 1),
(4, 'UGC Grants Full Autonomy to 62 Higher Education Institutions: Prakash Javadekar', '<p>Testing</p>\r\n', 'testing', 'news2.jpg', '', '', '', '', NULL, NULL, '2018-03-24 12:00:18', '2018-03-24 06:30:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `notification_description` longtext CHARACTER SET utf8,
  `notification_url` varchar(255) DEFAULT NULL,
  `notification_image` varchar(255) DEFAULT NULL,
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
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `title`, `notification_description`, `notification_url`, `notification_image`, `url`, `meta_title`, `meta_description`, `meta_keyword`, `category_image`, `banner_image`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'GAurav', '<p>GAurav Commented On Your post</p>', 'assaa', 'download.png', 'dds', 'sdsd', '<p>sdsd</p>\r\n', '<p>sdsd</p>\r\n', 'download.png', 'download.png', '2018-03-24 06:45:38', '2018-03-24 11:15:38', 1),
(2, 'Amar', 'Anmar Likes the post', '', NULL, '', '', '', '', NULL, NULL, '2018-03-24 12:13:34', '2018-03-24 06:43:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int(11) NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `chapter_id` varchar(255) DEFAULT NULL,
  `question_id` varchar(255) DEFAULT NULL,
  `package_name` varchar(255) DEFAULT NULL,
  `question_type` varchar(255) DEFAULT NULL,
  `description` longtext,
  `payment_status` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `module_id`, `chapter_id`, `question_id`, `package_name`, `question_type`, `description`, `payment_status`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 9, '1,6,7,8,9,10,11', ' 1 , 3 , 4 , 5 ', 'mocktest 1', 'Options', '<p>first mock test</p>\r\n', 'free', '2018-03-30 16:16:14', '2018-03-30 16:16:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `en_post` longtext CHARACTER SET utf8,
  `hi_post` longtext CHARACTER SET utf8,
  `en_post_title` varchar(255) DEFAULT NULL,
  `hi_post_title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `chapter_id` int(11) DEFAULT NULL,
  `super_submenu_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `added_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `en_post`, `hi_post`, `en_post_title`, `hi_post_title`, `module_id`, `chapter_id`, `super_submenu_id`, `type`, `image`, `is_active`, `created_at`, `updated_at`, `added_by`) VALUES
(1, '<p>Here you can build your own fake whatsapp messages and prank your friends. You can change ANYTHING, use emoticons and even upload your own profile photos. This generator is in no way associated with WhatsApp. All graphical material is protected by the copyright owner. May only be used for personal use.</p>', '<p>यहां आप अपने खुद के नकली व्हाट्सएप संदेश बना सकते हैं और अपने दोस्तों को शरारत कर सकते हैं। आप कुछ भी बदल सकते हैं, इमोटिकॉन्स का उपयोग कर सकते हैं और यहां तक कि अपनी प्रोफ़ाइल फ़ोटो भी अपलोड कर सकते हैं। यह जनरेटर व्हाट्सएप के साथ जुड़ा हुआ नहीं है। सभी चित्रमय सामग्री कॉपीराइट स्वामी द्वारा सुरक्षित हैं केवल व्यक्तिगत उपयोग के लिए इस्तेमाल किया जा सकता है</p>', 'banking', 'बैंकिंग', 7, 5, 5, 'SHARED', NULL, 1, '2018-03-16 13:03:11', '2018-03-16 13:03:11', 2),
(2, 'Happy Mahavir jayanti Amar', NULL, NULL, NULL, NULL, 5, 5, 'SHARED', 'mahavir.jpeg', 1, '2018-03-29 16:18:15', '2018-03-26 10:48:15', 3),
(3, 'Is it True?', NULL, NULL, NULL, NULL, 5, 5, 'SHARED', 'news.jpeg', 1, '2018-03-26 16:55:36', '2018-03-26 11:25:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_likes`
--

INSERT INTO `post_likes` (`id`, `user_id`, `post_id`, `created_at`, `is_active`) VALUES
(1, 3, 2, '2018-03-29 18:14:03', 1);

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
  `hi_question` longtext CHARACTER SET utf8,
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
(1, 9, 1, 'Options', '<p>	\nThe Battle of Plassey was fought in</p>\n', '<p>प्लासी की लड़ाई में लड़ा गया था</p>\n', '5', '<p>fgfgdf</p>\r\n', '<p>fdgdfgd</p>\r\n', '<p>fgfdg</p>\r\n', '<p>fgdfg</p>\r\n', '<p>fgfgdfg</p>\r\n', '<p>fgdfgdfg</p>\r\n', '<p>gfggd</p>\r\n', '<p>dfgdgd</p>\r\n', '<p>fgfgfdg</p>\r\n', '<p>fgfgd</p>\r\n', '<p>dfgdgdf</p>\r\n', '<p>dfgdfgdf</p>\r\n', '2018-03-15 11:58:08', '2018-03-15 16:28:08', 1),
(2, 7, 2, 'True False', '<p>sdsda</p>\r\n', '<p>asdda</p>\r\n', '5', '', '', '', '', '', '', '', '', '1', '', '<p>sadasdasd</p>\r\n', '<p>sdsdadd</p>\r\n', '2018-03-15 11:58:36', '2018-03-15 16:28:36', 1),
(3, 9, 1, 'Options', '<p>The territory of Porus who offered strong resistance to Alexander was situated between the rivers of</p>\n', '<p>पोरस के इलाके, जो सिकंदर के खिलाफ मजबूत प्रतिरोध की पेशकश की थी, की नदियों के बीच स्थित था</p>\n', '5', '<p>fgfgdf</p>\r\n', '<p>fdgdfgd</p>\r\n', '<p>fgfdg</p>\r\n', '<p>fgdfg</p>\r\n', '<p>fgfgdfg</p>\r\n', '<p>fgdfgdfg</p>\r\n', '<p>gfggd</p>\r\n', '<p>dfgdgd</p>\r\n', '<p>fgfgfdg</p>\r\n', '<p>fgfgd</p>\r\n', '<p>dfgdgdf</p>\r\n', '<p>dfgdfgdf</p>\r\n', '2018-03-15 11:58:08', '2018-03-15 16:28:08', 1),
(4, 9, 1, 'Options', '<p>Under Akbar, the Mir Bakshi was required to look after</p>\n', '<p>अकबर के तहत, मीर बक्षी को ध्यान रखना आवश्यक था</p>\n', '5', '<p>fgfgdf</p>\r\n', '<p>fdgdfgd</p>\r\n', '<p>fgfdg</p>\r\n', '<p>fgdfg</p>\r\n', '<p>fgfgdfg</p>\r\n', '<p>fgdfgdfg</p>\r\n', '<p>gfggd</p>\r\n', '<p>dfgdgd</p>\r\n', '<p>fgfgfdg</p>\r\n', '<p>fgfgd</p>\r\n', '<p>dfgdgdf</p>\r\n', '<p>dfgdfgdf</p>\r\n', '2018-03-15 11:58:08', '2018-03-15 16:28:08', 1),
(5, 9, 6, 'Options', '<p>Ten years ago, P was half of Q&#39;s age. If the ratio of their present ages is&nbsp;3:43:4, what will be the total of their present ages?</p>\r\n', '<p>दस साल पहले, पी क्यू की उम्र का आधा था। यदि उनकी वर्तमान उम्र का अनुपात है<br />\r\n3: 4, उनके वर्तमान युग की कुल क्या होगी?</p>\r\n', '10', '<p>30</p>\r\n', '<p>35</p>\r\n', '<p>40</p>\r\n', '<p>45</p>\r\n', '<p>30</p>\r\n', '<p>35</p>\r\n', '<p>40</p>\r\n', '<p>45</p>\r\n', '<p>35</p>\r\n', '<p>35</p>\r\n', '<p>Let present age of P and Q be&nbsp;3x3x&nbsp;and&nbsp;4x4x&nbsp;respectively.<br />\r\n<br />\r\nTen years ago, P was half of Q&#39;s age<br />\r\n&rArr;(3x&minus;10)=12(4x&minus;10)&rArr;6x&minus;20=4x&minus;10&rArr;2x=10&rArr;x=5&rArr;(3x&minus;10)=12(4x&minus;10)&rArr;6x&minus;20=4x&minus;10&rArr;2x=10&rArr;x=5<br />\r\n<br />\r\nTotal of their present ages<br />\r\n=3x+4x=7x=7&times;5=35</p>\r\n', '<p>Let present age of P and Q be&nbsp;3x3x&nbsp;and&nbsp;4x4x&nbsp;respectively.<br />\r\n<br />\r\nTen years ago, P was half of Q&#39;s age<br />\r\n&rArr;(3x&minus;10)=12(4x&minus;10)&rArr;6x&minus;20=4x&minus;10&rArr;2x=10&rArr;x=5&rArr;(3x&minus;10)=12(4x&minus;10)&rArr;6x&minus;20=4x&minus;10&rArr;2x=10&rArr;x=5<br />\r\n<br />\r\nTotal of their present ages<br />\r\n=3x+4x=7x=7&times;5=35</p>\r\n', '2018-03-30 13:27:08', '2018-03-30 13:27:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `save_notes`
--

CREATE TABLE `save_notes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `save_notes`
--

INSERT INTO `save_notes` (`id`, `user_id`, `post_id`, `created_at`, `is_active`) VALUES
(1, 3, 3, '2018-03-29 16:17:04', 1),
(8, 3, 2, '2018-03-29 18:10:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `en_site_title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `hi_site_title` longtext CHARACTER SET utf8 NOT NULL,
  `logo` varchar(255) NOT NULL,
  `favicon` varchar(255) NOT NULL,
  `en_copyright` longtext NOT NULL,
  `contact_us_phone` varchar(255) NOT NULL,
  `en_meta_tags` varchar(255) NOT NULL,
  `hi_copyright` longtext CHARACTER SET utf8,
  `contact_us_email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `hi_meta_tags` longtext CHARACTER SET utf8,
  `en_about_us` longtext,
  `hi_about_us` longtext CHARACTER SET utf8mb4,
  `en_privacy_policy` longtext,
  `hi_privacy_policy` longtext CHARACTER SET utf8mb4,
  `en_terms` longtext,
  `hi_terms` longtext CHARACTER SET utf8 NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `twitter_url` varchar(255) NOT NULL,
  `insta_url` varchar(255) NOT NULL,
  `linkedin_url` varchar(255) NOT NULL,
  `fb_url` varchar(255) NOT NULL,
  `gplus_url` varchar(255) NOT NULL,
  `site_url` varchar(255) DEFAULT NULL,
  `image_folder` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `en_site_title`, `hi_site_title`, `logo`, `favicon`, `en_copyright`, `contact_us_phone`, `en_meta_tags`, `hi_copyright`, `contact_us_email`, `hi_meta_tags`, `en_about_us`, `hi_about_us`, `en_privacy_policy`, `hi_privacy_policy`, `en_terms`, `hi_terms`, `created_at`, `updated_at`, `twitter_url`, `insta_url`, `linkedin_url`, `fb_url`, `gplus_url`, `site_url`, `image_folder`) VALUES
(1, 'online test', 'ऑनलाइन टेस्ट', 'logo-wide.png', 'apple-touch-icon.png', '<p>Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Donec sollicitudin molestie malesuada. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Nulla quis lorem ut libero malesuada feugiat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porttitor lectus nibh. Donec sollicitudin molestie malesuada. Nulla quis lorem ut libero malesuada feugiat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.gaurav</p>\r\n', '987654321', 'test', '<pre>\r\nक्यूबाटुर आर्क, उस पर हस्ताक्षर किए गए थे किसी भी प्रकार के लिए, यह मात्रा के लिए मूल्य के रूप में, के लिए तत्व आईडी। डोनिक सोल्लिटिडिन मोलिस्टी नरसुदा एक सपिया मस्तिष्क के लिए, एक पिल्लेसेक नसीब पर आपत्ति नहीं है, कभी भी नहीं। किसी भी तरह से मुफ्त में पुरुषों की मेजबानी के लिए तैयार हो जाओ। इस वेबसाइट पर विज्ञापन दें, कृपया हमसे संपर्क करें एसडी पोर्टेटर लिक्टस निभ डोनिक सोल्लिटिडिन मोलिस्टी नरसुदा किसी भी तरह से मुफ्त में पुरुषों की मेजबानी के लिए तैयार हो जाओ। गर्भवती महिलाओं और महिलाओं के लिए सबसे पहले कुर्सियों की कवच ​​में प्रयुक्त; किसी भी तरह से, किसी भी व्यक्ति या किसी भी व्यक्ति के लिए,</pre>\r\n', 'contact@gmail.com', 'परीक्षा', '<p>&lt;p&gt;Gradeup is India&amp;rsquo;s largest and most engaged community for online learning. Since its launch (in Sep 15), Gradeup&amp;#39;s android app has been downloaded by over 6 Million students with a rating of 4.7 on Google Play Store, and has received phenomenal response in terms of engagement and feedback of students. Gradeup is currently positioned as a one stop test prep app for Banking, SSC, GATE, TET (teaching), JEE, NEET and other important exams in India. Students can ask their doubts, access study material, practice and benchmark their preparation among millions of other students. Gradeup has recently launched an app for school students to find solutions for their&amp;nbsp;&lt;a href=&quot;https://play.google.com/store/apps/details?id=co.gradeup.k12&quot;&gt;home work&lt;/a&gt;&lt;/p&gt;</p>\r\n\r\n<p>&lt;p&gt;At Gradeup we believe that, access to good content, when combined with the power of online communities, can make learning process significantly more collaborative and engaging, and hence much more impactful. We imagined Gradeup as a place where learners can interact with each other and help each other, can access study material and other resources relevant to them, and seek guidance from experts. We really feel that such a platform can become the centre of learning for millions of students. It is this promise which forms the core of value proposition at Gradeup.&lt;/p&gt;</p>', '<p>&lt;pre&gt;<br />\r\nऑनलाइन सीखने के लिए ग्रेडअप भारत का सबसे बड़ा और सबसे ज्यादा व्यस्त समुदाय है। इसकी शुरुआत (15 सितंबर) के बाद से, ग्रेडअप एंड्रॉइड ऐप Google Play Store पर 4.7 की रेटिंग के साथ 6 मिलियन से अधिक छात्रों द्वारा डाउनलोड किया गया है, और छात्रों के सगाई और प्रतिक्रिया के संदर्भ में उन्हें अभूतपूर्व प्रतिक्रिया मिली है। ग्रेडअप वर्तमान में बैंकिंग, एसएससी, गेट, टीईटी (टीईटी), जेईई, एनईईटी और भारत में अन्य महत्वपूर्ण परीक्षाओं के लिए एक स्टॉप टेस्ट प्रैप ऐप के रूप में तैनात है। छात्र अपने संदेहों को पूछ सकते हैं, अध्ययन सामग्री, अभ्यास और लाखों अन्य छात्रों के बीच अपनी तैयारी बेंचमार्क तक पहुंच सकते हैं। ग्रेडअप ने हाल ही में स्कूल के छात्रों के लिए अपने घर के काम के समाधान खोजने के लिए एक ऐप लॉन्च किया है</p>\r\n\r\n<p>ग्रेडअप में हम मानते हैं कि ऑनलाइन समुदायों की शक्ति के साथ मिलकर, अच्छी सामग्री तक पहुंच, सीखने की प्रक्रिया काफी अधिक सहयोगी और आकर्षक बना सकती है, और इसलिए अधिक प्रभावकारी। हमने ग्रेडअप को उस जगह के रूप में देखा जहां शिक्षार्थी एक-दूसरे के साथ बातचीत कर सकते हैं और एक-दूसरे की मदद कर सकते हैं, अध्ययन सामग्री और उनसे संबंधित अन्य संसाधनों का उपयोग कर सकते हैं, और विशेषज्ञों से मार्गदर्शन प्राप्त कर सकते हैं। हम वास्तव में महसूस करते हैं कि इस तरह का एक मंच लाखों छात्रों के लिए सीखने का केंद्र बन सकता है। यह यह वादा है जो ग्रेडअप पर मूल्य प्रस्ताव के मूल रूप बनाता है।&lt;/pre&gt;<br />\r\n&nbsp;</p>', '<p>&lt;h1&gt;PRIVACY POLICY&amp;nbsp;&lt;/h1&gt;</p>\r\n\r\n<p>&lt;p&gt;The following privacy policy is being published in accordance with the provisions of the Information Technology Act, 2000&lt;strong&gt;&amp;nbsp;(&amp;quot;IT ACT&amp;quot;)&lt;/strong&gt;, Information Technology (Intermediary Guidelines) Rules, 2011, Information Technology (Reasonable Security Practices and Procedures and Sensitive Personal Data or Information) Rules, 2011.&lt;/p&gt;</p>\r\n\r\n<p>&lt;h2&gt;INTRODUCTION&lt;/h2&gt;</p>\r\n\r\n<p>&lt;p&gt;This Privacy Policy explains the policy of Gradeup&amp;rsquo;s website (hereinafter referred to as&lt;strong&gt;&amp;nbsp;&amp;quot;the Website&amp;quot;&lt;/strong&gt;) and Gradeup&amp;rsquo;s mobile application (hereinafter referred to as&lt;strong&gt;&amp;nbsp;&amp;quot;the App&amp;quot;&lt;/strong&gt;), with respect to the disclosure, collection, storage, usage and protection of your information during the course your interaction with the Website and the App.&lt;/p&gt;</p>\r\n\r\n<p>&lt;p&gt;Please read this Privacy Policy carefully and in conjunction with the Terms of Use. If you do not understand this policy, or do not accept any part of it, then you should not use the Platform, as the case may be. Your use and/or continued use of the Platform, as the case may be amounts to an express consent to the terms of this Privacy Policy as well as the Terms of Use.&lt;/p&gt;</p>\r\n\r\n<p>&lt;p&gt;For the purposes of this Policy, accessing of the Website and the App together with any study material made available or uploaded therein or downloaded, embedded therefrom shall collectively be referred to as the&lt;strong&gt;&amp;quot;Services&amp;quot;&lt;/strong&gt;. The Website and the App shall be collectively referred to as&lt;strong&gt;&amp;nbsp;&amp;quot;the Platform&amp;quot;.&lt;/strong&gt;&lt;/p&gt;</p>\r\n\r\n<p>&lt;p&gt;This Privacy Policy forms part and parcel of the Terms of Use for the Gradeup Services and shall be read as a whole. Capitalized terms used here, but undefined, shall have the same meaning as attributed to them in the Terms of Use.&lt;/p&gt;</p>\r\n\r\n<p>&lt;ol&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&lt;li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&lt;h2&gt;INFORMATION COLLECTED FROM YOU&lt;/h2&gt;</p>\r\n\r\n<p>&nbsp;&nbsp; &nbsp;&lt;ol style=&quot;list-style-type:lower-alpha&quot;&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&lt;li&gt;When you use the Platform by way of registration, log in, creation of a user account or creation of a post, purchase of a test series, attempting a mock test, etc. or by way of interaction via third party websites and/or mobile applications or by way of any other communication with the Platform, Gradeup may collect your personally identifiable information including name, date of birth, gender, demographic information, photos, e-mail address, telephone number, mobile phone number, credit card or debit card details, geographic location, mailing address, social media account details including list of contacts/friends and examination preference.&lt;/li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&lt;li&gt;Gradeup will use this information to validate you as a user when using the Platform, to provide the Service to you, including administration of your user account, to notify you of changes to the Service or about any changes to our terms and conditions or this privacy policy, to manage its business, including financial reporting and billing of its Service, for the development of new products and services, to send you newsletters, offers and promotion coupons to market and advertise its products and services by email, to comply with applicable laws, court orders and government enforcement agency requests, for research and analytic purposes including to improve the quality of the Service and to ensure that the Service is presented in the most effective manner for you and your device.&lt;/li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&lt;li&gt;By registering on the Platform, you agree and confirm your consent to providing Gradeup your aforementioned personal information, which is lawful, necessary and permissible. You at all times have the right to discontinue the use of the Platform. Gradeup is not liable to provide you its Services in the absence of or your refusal to provide the aforesaid information. Additionally, Gradeup is not liable to ensure or maintain the same quality of its Services to you, as it may for a user who provides all aforementioned information.&lt;/li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&lt;li&gt;Any information provided by you under Gradeup&amp;rsquo;s &amp;quot;create a post&amp;quot; feature, comments, upvotes or otherwise any information that you provide on the Platform is not personal information and shall become part of Gradeup&amp;rsquo;s published content. Gradeup may use the aforementioned information without your consent for purposes including but not limited to improving its products and services, developing new products and services and sending you messages about promotions and offers.&lt;/li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&lt;/ol&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&lt;/li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&lt;li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&lt;h2&gt;INFORMATION COLLECTED AUTOMATICALLY&lt;/h2&gt;</p>\r\n\r\n<p>&nbsp;&nbsp; &nbsp;&lt;ol style=&quot;list-style-type:lower-alpha&quot;&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&lt;li&gt;When you visit or interact with the Platform, apart from Gradeup certain third party advertisers and/or service providers may use technologies that automatically collect information about you for both transactional (e.g., confirmation of registration, notification of purchase made, etc.) and promotional (e.g., promotions, newsletters, etc.) purposes. Your information may be collected by Gradeup or such third party advertisers and/or service providers in the following ways:-<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&lt;ol style=&quot;list-style-type:lower-roman&quot;&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&lt;li&gt;&lt;strong&gt;Log Files:&lt;/strong&gt;&amp;nbsp;Every time you visit the Platform, Gradeup servers automatically receive and log information from your browser and device used to access the Platform (such as IP address, device ID, details of your network operator and type, your operating system, browser type and version, CPU speed, and connection speed). This enables us to validate you as a User, to understand your usage of the Platform and helps us to make changes and updates most suited to your needs and interests.&lt;/li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&lt;li&gt;&lt;strong&gt;Mobile Device:&lt;/strong&gt;&amp;nbsp;When you register your mobile device or use the mobile device to access the App, In addition to the aforesaid, Gradeup will also collect device information such as mobile device ID, model and manufacturer details, operating system etc. for the purpose of improving the App&amp;rsquo;s overall functionality and displaying content according to your preferences.&lt;/li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&lt;li&gt;&lt;strong&gt;Cookies:&lt;/strong&gt;&amp;nbsp;Cookies are data files placed on your device, used to keep track of information such as your interaction with social media websites, the content you click on, download, upload or share and other activity on the Platform etc. in order to improve your experience of the Platform by personalizing it to your preferences and usage trends.&lt;/li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&lt;li&gt;&lt;strong&gt;Web Beacons:&lt;/strong&gt;&amp;nbsp;Web beacons are transparent graphic images used in our email communication to you, in order to understand customer behavior and improve the overall quality, functionality and interactivity of the Platform.&lt;/li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&lt;li&gt;&lt;strong&gt;Mobile Analytics:&lt;/strong&gt;&amp;nbsp;Mobile analytics software is used by Gradeup to better understand and customize the functionality of the App&amp;rsquo;s software on your phone. This is done by collecting information such as your frequency of the App&amp;rsquo;s usage, the features you prefer to use on the App, where the App was downloaded from, Device Id, name of other mobile applications on your device, etc.&lt;/li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&lt;li&gt;&lt;strong&gt;Mobile Analytics:&lt;/strong&gt;&amp;nbsp;Mobile analytics software is used by Gradeup to better understand and customize the functionality of the App&amp;rsquo;s software on your phone. This is done by collecting information such as your frequency of the App&amp;rsquo;s usage, the features you prefer to use on the App, where the App was downloaded from, Device Id, name of other mobile applications on your device, etc.&lt;/li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&lt;li&gt;&lt;strong&gt;Payment /Purchase Information:&lt;/strong&gt;&amp;nbsp;In order to access certain paid features and services on the Platform, you may be required to create or log into a separate account on a payment gateway or website such as &amp;ldquo;PayU&amp;rdquo; or &amp;ldquo;PayTM&amp;rdquo;. Once such an account is created, in order to process your payments/ purchases on the Platform, such payment gateway provider may require and collect your details such as name, address, phone number, email address and credit or debit card information, netbanking information or details of any web wallets maintained by you. Any and all payments made/processed or details provided to or shared with such authorized payment gateway providers shall be stored directly by such payment gateway providers without any information passing through or relayed to Gradeup. Gradeup assumes no liability in respect of such payments and/or information shared with or provided to such authorized payment gateway providers. It is further clarified that the aforementioned information is only used in accordance with the provisions of the applicable law and in strict adherence to this Privacy Policy.&lt;/li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&lt;li&gt;&lt;strong&gt;Public Forums:&lt;/strong&gt;&amp;nbsp;Any information that is disclosed by you in the comments section or by way of the &amp;ldquo;create a post&amp;rdquo; feature, becomes published information and Gradeup shall not be held liable for the security of the same or any persona information that you disclose herein. You agree to exercise caution when disclosing any personal information or personally identifiable information in this regard.&lt;/li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&lt;/ol&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&lt;/li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&lt;li&gt;Please note that we only use the aforesaid information to communicate with and/or improve the Service and to better understand our users&amp;#39; operating systems, for system administration and to audit the use of the Service. We do not use any of the aforesaid data to identify the name, address or other personal details of any individual.&lt;/li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&lt;li&gt;For the purpose of this Privacy Policy, any passwords, financial information such as credit or debit card details or other payment instrument details and any other information prescribed by law to be sensitive that may be collected by Gradeup during your use of the Platform and the Services provided thereon, shall be referred to as &amp;quot;Sensitive Personal Data or Information&amp;quot;.&lt;/li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&lt;/ol&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&lt;/li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&lt;li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&lt;h2&gt;LINK TO THIRD PARTIES&lt;/h2&gt;</p>\r\n\r\n<p>&nbsp;&nbsp; &nbsp;&lt;p&gt;The Platform may include links that redirect you to other websites. These third party websites are not covered by this Privacy Policy. You agree that once you leave our servers, any third party websites that you go to or interact with are at your own risk. Gradeup shall not be held liable for any default, loss of function or any risk that your personal sensitive information may be exposed to as a result of the same.&lt;/p&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&lt;/li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&lt;li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&lt;h2&gt;SHARING OR DISCLOSURE OF INFORMATION COLLECTED&lt;/h2&gt;</p>\r\n\r\n<p>&nbsp;&nbsp; &nbsp;&lt;ol style=&quot;list-style-type:lower-alpha&quot;&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&lt;li&gt;As a strict policy we will not disclose, share or exploit your information with anyone without your express permission.&lt;/li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&lt;li&gt;However, we may be mandated under law or under contracts to make certain limited disclosures under the following circumstances:<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&lt;ol style=&quot;list-style-type:lower-roman&quot;&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&lt;li&gt;&lt;strong&gt;Legal Necessity:&lt;/strong&gt;&amp;nbsp;Gradeup may share any of the aforesaid information, including your personally identifiable information or Sensitive Personal Data or Information, without obtaining a separate consent from you, if and when such information is requested or required by law or by any court or governmental agency or authority to disclose, for the purpose of verification of identity, or for the prevention, detection, investigation of any criminal activity, or for prosecution and punishment of offences.&lt;/li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&lt;li&gt;&lt;strong&gt;Limited Disclosure to Service Providers:&lt;/strong&gt;&amp;nbsp;we may disclose your information (but not Sensitive Personal Data or Information) to our service providers and business partners (&lt;strong&gt;&amp;quot;Service Providers&amp;quot;&lt;/strong&gt;&amp;nbsp;) for the purposes of betterment and improvement of our services including but not limited to hosting the Platform, payment processing, analyzing data, providing customer service, etc., for the purpose of making various features, services and products of Gradeup available to you and investigating or redressing grievances. This will be in the form of aggregated anonymized data and will be under strict contractual arrangements that preserve the confidentiality and security of your personal information in accordance with this Privacy Policy;&lt;/li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&lt;li&gt;&lt;strong&gt;Limited Disclosures for improvement of services:&lt;/strong&gt;&amp;nbsp;Gradeup may share the aforesaid information including your personally identifiable information (but not Sensitive Personal Data or Information) when it is required to be shared with sponsors, partners, advertisers, analytics companies or third parties for the purpose of marketing, advertising promotional offers, offering product information and market research, in connection with the Service. This will be in the form of aggregated anonymized data and will be under strict contractual arrangements that preserve the confidentiality and security of your personal information in accordance with this Privacy Policy;&lt;/li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&lt;/ol&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&lt;/li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&lt;/ol&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&lt;/li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&lt;li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&lt;h2&gt;SECURITY OF INFORMATION COLLECTED&lt;/h2&gt;</p>\r\n\r\n<p>&nbsp;&nbsp; &nbsp;&lt;ol style=&quot;list-style-type:lower-alpha&quot;&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&lt;li&gt;We take the security of your personal information seriously and use appropriate technical and organizational measures to protect your personal information against unauthorized or unlawful processing and against accidental loss, destruction or damage.&amp;nbsp;Unfortunately, the transmission of information via the internet is not completely secure. Although we will do our best to protect your personal data, we cannot guarantee the security of your data which is transmitted to or from the Service. Any transmission is at your own risk.&lt;/li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&lt;li&gt;We keep your personal information for no longer than is necessary for our business purposes or for legal requirements.&lt;/li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&lt;/ol&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&lt;/li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&lt;li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&lt;h2&gt;AMENDMENTS TO THE PRIVACY POLICY&lt;/h2&gt;</p>\r\n\r\n<p>&nbsp;&nbsp; &nbsp;&lt;p&gt;Gradeup may amend the Privacy Policy posted on the Website from time to time at its sole discretion. Your continued access or use of the Platform or Services constitute your acceptance of the amendments. Your access and use of the Platform and Services will be subject to the most current version of the Terms of Use, rules and guidelines posted on the Website at the time of such use. Please regularly check the link on the home page to view the most current Privacy Policy.&lt;/p&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&lt;/li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&lt;li&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&lt;h2&gt;CONTACT US&lt;/h2&gt;</p>\r\n\r\n<p>&nbsp;&nbsp; &nbsp;&lt;p&gt;If you have any questions or concerns regarding this Privacy Policy, kindly contact us at:&lt;a href=&quot;mailto:admin@gradeup.co&quot;&gt;&amp;nbsp;contact@gradeup.co&lt;/a&gt;&lt;/p&gt;<br />\r\n&nbsp;&nbsp; &nbsp;&lt;/li&gt;<br />\r\n&lt;/ol&gt;</p>', '<p>&lt;pre&gt;<br />\r\nगोपनीयता नीति<br />\r\nसूचना प्रौद्योगिकी अधिनियम, 2000 (&amp;quot;आईटी अधिनियम&amp;quot;), सूचना प्रौद्योगिकी (मध्यस्थ दिशानिर्देश) नियम, 2011, सूचना प्रौद्योगिकी (उचित सुरक्षा प्रथाओं और प्रक्रियाओं और संवेदनशील व्यक्तिगत डेटा या सूचना के प्रावधानों के अनुसार निम्नलिखित गोपनीयता नीति प्रकाशित की जा रही है ) नियम, 2011</p>\r\n\r\n<p>परिचय<br />\r\nयह जानकारी गोपनीयता की जानकारी, संग्रह, भंडारण, उपयोग और आपकी जानकारी के संरक्षण के संबंध में, ग्रेडअप की वेबसाइट की नीति (बाद में &amp;quot;वेबसाइट&amp;quot; के रूप में संदर्भित है) और ग्रेडअप के मोबाइल एप्लिकेशन (बाद में &amp;quot;ऐप&amp;quot; के रूप में संदर्भित) की नीति बताती है पाठ्यक्रम के दौरान वेबसाइट और ऐप के साथ आपकी बातचीत</p>\r\n\r\n<p>कृपया इस गोपनीयता नीति को सावधानी से और उपयोग की शर्तों के साथ पढ़ें। यदि आप इस नीति को समझ नहीं पाते हैं, या इसके किसी भी भाग को स्वीकार नहीं करते हैं, तो आपको प्लेटफ़ॉर्म का उपयोग नहीं करना चाहिए, जैसा कि मामला हो। आपका उपयोग और / या प्लेटफ़ॉर्म का निरंतर उपयोग, जैसा कि मामला इस गोपनीयता नीति के नियमों के साथ-साथ उपयोग की शर्तों के लिए एक स्पष्ट सहमति के बराबर हो सकता है।</p>\r\n\r\n<p>इस नीति के प्रयोजनों के लिए, वेबसाइट और ऐप को किसी भी अध्ययन सामग्री के साथ मिलकर उपलब्ध है या उसमें अपलोड किया गया है या डाउनलोड किया गया है, वहां से एम्बेडेड सामूहिक रूप से &amp;quot;सेवाएं&amp;quot; के रूप में संदर्भित किया जाएगा। वेबसाइट और ऐप को सामूहिक रूप से &amp;quot;मंच&amp;quot; के रूप में जाना जाएगा&lt;/pre&gt;<br />\r\n&nbsp;</p>', '<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td><a href=\"https://www.facebook.com/\"><strong>Exam Name</strong></a></td>\r\n			<td><a href=\"https://www.facebook.com/\"><strong>Exam Dates</strong></a></td>\r\n			<td><a href=\"https://www.facebook.com/\"><strong>Vacancy</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"https://www.facebook.com/\">IBPS PO</a></td>\r\n			<td><a href=\"https://www.facebook.com/\">13, 14, 20 &amp; 21 October 2018</a></td>\r\n			<td>\r\n			<table border=\"1px\">\r\n				<tbody>\r\n					<tr>\r\n						<td><a href=\"https://www.facebook.com/\">NA</a></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"https://www.facebook.com/\">IBPS Clerk</a></td>\r\n			<td><a href=\"https://www.facebook.com/\">8, 9, 15 &amp; 16 December 2018</a></td>\r\n			<td>\r\n			<table border=\"1px\">\r\n				<tbody>\r\n					<tr>\r\n						<td><a href=\"https://www.facebook.com/\">NA</a></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"https://www.facebook.com/\">IBPS Clerk</a></td>\r\n			<td>8, 9, 15 &amp; 16 December 2018</td>\r\n			<td>\r\n			<table border=\"1px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>NA</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"https://www.facebook.com/\" rel=\"noopener\" target=\"_blank\">IBPS Clerk</a></td>\r\n			<td>8, 9, 15 &amp; 16 December 2018</td>\r\n			<td>\r\n			<table border=\"1px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>NA</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h1><u><strong>TERMS OF USE</strong></u></h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The present Terms of Use document is being published in accordance with the provisions of the Information Technology Act, 2000 and other applicable Rules thereunder, including but not limited to the Information Technology (Intermediary Guidelines) Rules, 2011.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Welcome to the Gradeup website<strong>&nbsp;(&quot;the Website&quot;)</strong>and/ or Gradeup mobile app<strong>&nbsp;(&quot;the App&quot;).</strong>The Website and the App are owned and provided to you by Grade Stack Learning Pvt. Ltd., having its registered office at A-25, Panchwati, New Delhi- 110033. The Website and the App shall hereinafter be collectively referred to as<strong>&nbsp;&quot;the Platform&quot;.</strong>For the purposes of this Terms of Use, accessing of the Platform together with any study material made available or uploaded therein or downloaded, embedded therefrom shall hereinafter be collectively be referred to as the<strong>&quot;Services&quot;.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>INTRODUCTION</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>By using or accessing the Platform in any way, including registering on the Platform, using, viewing, sharing, embedding and/or downloading any Services, you agree to be bound by the Terms of Use set forth herein. By accepting these Terms of Use, you also accept and agree to be bound by Gradeup Policies, including but not limited to the Gradeup Privacy Policy and the Gradeup Copyright Policy.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>If you do not understand the present Terms of Use or do not agree with/accept any part thereof, you should immediately discontinue using or accessing the Platform. Your use and/or continued use of the Platform, as the case may be, amounts to an express consent by you to the terms of this Terms of Use as well as other Gradeup Policies.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>ELIGIBILITY</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>By agreeing to these Terms of Use, you represent that you are legally competent to enter into an agreement and provide consent to these Terms of Use. You further represent that</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol style=\"list-style-type:lower-roman\"><br />\r\n	<li>&nbsp;&nbsp; &nbsp;</li>\r\n	<li>You are of sound mind.</li>\r\n	<br />\r\n	<li>&nbsp;&nbsp; &nbsp;</li>\r\n	<li>Have attained the legal age necessary under the applicable laws to enter into an agreement and/or access, avail the Services and.</li>\r\n	<br />\r\n	<li>&nbsp;&nbsp; &nbsp;</li>\r\n	<li>Are not prohibited from entering into a legally binding contract as per applicable laws.</li>\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	&nbsp;\r\n	<li>&nbsp;</li>\r\n	<li>&nbsp;</li>\r\n	<li>&nbsp;</li>\r\n	<li>&nbsp;</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In case the Platform is being accessed and the Services are being availed for the benefit of a minor, you expressly confirm that you are legally competent to provide consent on behalf of such a minor and that the minor&rsquo;s use of the Platform and/or the Services shall be subject to the Terms of Use.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>YOUR ACCOUNT</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>You can become a registered user of the Platform by setting up a password protected account with us. In order to set up such an account, you will be required to enter details of your registered email id and password or you may login using the account details of any partner website. By setting up the account, you agree to accept any and all responsibility for any and all activities that occur under your account.&nbsp;By setting up the account, you further agree to the contents of the Privacy Policy.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Gradeup reserves the right and sole discretion to refuse access to the Platform, terminate any account, remove or restrict any content, at any time, with or without notice to you in case we notice any illegal activity on or from account or if we have reasons to believe that any information provided by you is untrue, inaccurate, outdated or incomplete.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>USER CONTENT</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Gradeup provides its users the option of creating posts and/or upload content on the Platform<strong>(&quot;User Content&quot;).</strong>When you submit or upload any content on the Platform you represent and warrant that:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul><br />\r\n	<li>&nbsp;&nbsp; &nbsp;</li>\r\n	<li>You own all copyright in the content, or if you are not the owner, that you have permission to use the content, and that you have all the rights and permissions necessary to permit uploading, displaying, sharing, reproduction, downloading, transmission of such content.</li>\r\n	<br />\r\n	<li>&nbsp;&nbsp; &nbsp;</li>\r\n	<li>The content you upload will not infringe the intellectual property rights or other rights of any person or entity, including but not limited to copyright, moral rights, trade mark, patent or rights of privacy or publicity.</li>\r\n	<br />\r\n	<li>&nbsp;&nbsp; &nbsp;</li>\r\n	<li>Your use of the Platform will comply with all applicable laws, rules and regulations.</li>\r\n	<br />\r\n	<li>&nbsp;&nbsp; &nbsp;</li>\r\n	<li>The content does not contain material that defames or vilifies any person, people, races, religion or religious group and is not obscene, pornographic, indecent, harassing, threatening, harmful, invasive of privacy or publicity rights, abusive, inflammatory or otherwise objectionable.</li>\r\n	<br />\r\n	<li>&nbsp;&nbsp; &nbsp;</li>\r\n	<li>The content is not misleading and deceptive and does not offer or disseminate fraudulent goods, services, schemes, or promotions.</li>\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	&nbsp;\r\n	<li>&nbsp;</li>\r\n	<li>&nbsp;</li>\r\n	<li>&nbsp;</li>\r\n	<li>&nbsp;</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Gradeup reserves the right to review such content uploaded by the user and in case any content is found to be violation of any of the Terms of Use and/or any applicable laws, Gradeup may remove any content from the Platform and/or terminate or suspend the user account in its sole discretion.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>RESTRICTION AND TERMINATION OF USE</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Gradeup may block, restrict, disable, suspend or terminate your access to all or part of the free Services offered on the Platform, at any time in Gradeup&#39;s sole discretion, without prior notice to you upon Gradeup. Specifically, in case of prolonged inactivity, Gradeup reserves the right to disable, deactivate or terminate a user&#39;s account. If an account has been disabled or deactivated for inactivity, the user name associated with that account may be given to another user without notice to you or such other party. If you violate the Terms of Use, Gradeup may at its sole discretion, block, restrict, disable, suspend or terminate the paid Services offered on the Platform.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>INTELLECTUAL PROPERTY</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Services, including but not limited to digital content on the website&nbsp;i.e. text, graphics, user interface, images, video interface and software as well as their selection and arrangement, may belong to Gradeup or to its partners who have granted Gradeup the right to use their content and are protected to the fullest extent possible by applicable laws related to copyrights, trademarks, trade secrets and all other intellectual property and proprietary rights (collectively,<strong>&nbsp;&quot;Intellectual Property Rights&quot;</strong>). Any unauthorized use of the Services may violate such laws and the Terms of Use. Gradeup reserves all its legal rights to prohibit, stop or contain any such violations.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>You agree not to copy, republish, frame, download, transmit, modify, adapt, create derivative works based on, rent, lease, loan, sell, assign, distribute, display, perform, license, sublicense or reverse engineer the Platform and Services or any parts thereof or the selection and arrangement of the Platform and Services, except as expressly authorized herein. Gradeup grants you a non-exclusive, non-transferable, limited permission to access and display the web pages within this Platform, solely on your computer or any other electronic viewing device for your personal, non-commercial use of this Platform. This permission is conditional on the basis that you shall not modify, alter or illegally use the content displayed on this Platform and shall keep intact and comply with all copyright, trademark, and other proprietary notices of the Platform, if any. The rights granted to you constitute a license and not a transfer of title in any manner.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Use of the Platform or Services for any other purpose other than expressly granted hereunder is expressly prohibited and may result in severe civil and criminal penalties.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In relation to any content submitted, uploaded or generated by you on the Platform, you hereby grant an unconditional, unlimited, perpetual, royalty-free, worldwide license and permission to Gradeup and its affiliates, content sharing partners to display, store, host, publish, digitally reproduce or copy, transmit, communicate, modify, translate, distribute or otherwise make such content available on the Platform or in relation to the Services provided by Gradeup. You agree that such content may continue to be made available on Gradeup despite any termination or suspension of your account, if such content has been shared, stored or embedded by any other user(s). You agree to not hold Gradeup responsible for the aforesaid activities in relation to your content.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>ADVERTISEMENTS AND PROMOTIONS</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>This Platform may run advertisements and promotions from third parties, products and/or services in any manner and to any extent. Your communications, activities, relationships and business dealings with any third parties advertising or promoting via the Platform, including payment and delivery of related goods or services, and any other terms, conditions, warranties or representations associated with such dealings, shall be solely matters between you and such third parties.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>You acknowledge and agree that Gradeup is not responsible or liable for any loss or damage of any kind incurred as the result of any such dealings or as the result of the presence of such non-Gradeup advertisers on the Platform.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Our links with advertisers should not be construed as an endorsement, approval or recommendation by us of the owners or operators of those linked websites, or of any information, graphics, materials, products or services referred to or contained on those linked websites, unless and to the extent stipulated to the contrary.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>LINKS TO THIRD PARTY WEBSITES</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Platform may include links that redirect you to other websites. These third party websites are not covered by the Terms of Use. You agree that once you leave our servers, any third party websites that you go to or interact with are at your own risk. Gradeup shall not be held liable for any default, loss of function or any risk or consequence that you may be exposed to as a result of the same.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>SPAM E-MAIL AND POSTINGS</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In the event your access or use of the Platform and Services is found to be spammy, misleading, malicious, annoying or containing/promoting unsolicited e-mails or network postings, Gradeup reserves its right to obtain immediate injunctive reliefs against you or against such use by you, in addition to all other remedies available at law or in equity. Gradeup may also opt to block, filter or delete unsolicited e-mail, messages or postings as per its sole discretion.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>INDEMNITY</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>You agree to indemnify, defend and hold Gradeup and its officers, directors, partners, employees, agents and representatives harmless, from and against any and all claims, damages, losses, liabilities, costs (including reasonable legal fees) or other expenses that arise directly or indirectly out of or from</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol style=\"list-style-type:lower-roman\"><br />\r\n	<li>&nbsp;&nbsp; &nbsp;</li>\r\n	<li>Your user content and any other content (e.g. computer viruses) that you may submit, post to or transmit through the Platform (including a third party&#39;s use of such user content (e.g. reliance on the accuracy, completeness or usefulness of your user content).</li>\r\n	<br />\r\n	<li>&nbsp;&nbsp; &nbsp;</li>\r\n	<li>Your access to or use of the Platform and Services (including any use by your employees, contractors or agents and all uses of your account numbers, user names and passwords, whether or not actually or expressly authorised by you, in connection with the Platform and Services).</li>\r\n	<br />\r\n	<li>&nbsp;&nbsp; &nbsp;</li>\r\n	<li>Your breach of any clause of the Terms of Use.</li>\r\n	<br />\r\n	<li>&nbsp;&nbsp; &nbsp;</li>\r\n	<li>Any allegation that while using any of the software made available on the Platform you infringe or otherwise violate the copyright, trademark, trade secret or other intellectual property or other rights of any third party and/or any dealings between you and any third parties advertising or promoting or linked via the Platform.</li>\r\n	<br />\r\n	<li>&nbsp;&nbsp; &nbsp;</li>\r\n	<li>Your activities in connection with the Platform.</li>\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	&nbsp;\r\n	<li>&nbsp;</li>\r\n	<li>&nbsp;</li>\r\n	<li>&nbsp;</li>\r\n	<li>&nbsp;</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>This indemnity will be applicable without regard to the negligence of any party, including any indemnified person.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>DISCLAIMER</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>We do not represent or guarantee that this Platform will be free from errors or viruses. You acknowledge that this Website may be affected by outages, faults or delays. Such outages, faults or delays may be caused by factors, including technical difficulties with the performance or operation of our or another person&rsquo;s software, equipment or systems, traffic or technical difficulties with the Internet or infrastructure failures.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>We do not accept responsibility for any loss or damage, however caused (including through negligence), that you may directly or indirectly suffer in connection with your use of this Platform, nor do we accept any responsibility for any such loss arising out of your use of or reliance on information contained on or accessed through this Platform.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>PRIVACY POLICY</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Your privacy is very important to us. Users of our Platform should refer to our<a href=\"https://gradeup.co/privacy-policy\" target=\"_blank\">&nbsp;Privacy Policy</a>, which is incorporated into this Terms of Use by reference, with respect to the disclosure, collection, storage, usage and protection of your information during the course your interaction with the Platform.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>COPYRIGHT POLICY</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Gradeup respects and recognize the intellectual property rights of others and expects users of Gradeup to do the same. Users of our Platform should refer to our<a href=\"https://gradeup.co/copyright-policy\" target=\"_blank\">&nbsp;Copyright Policy</a>, which is incorporated into this Terms of Use by reference. If you believe that your content has been used on Gradeup in a way that constitutes an infringement of your copyright, please notify Gradeup&rsquo;s designated agent for complaints or approach us through the procedure set out under the applicable provisions of the Information Technology Act. If you have a good faith belief that your copyright has been infringed by any of our users, you may follow the process as specified in our Copyright Policy.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>CANCELLATIONS &amp; REFUND POLICY</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Cancellations: As a general rule, all sales made on Gradeup are final and you shall not be entitled to cancel your order once you have received confirmation of the same. Gradeup reserves the sole right to cancel any order as per our discretion in case (i) we are unable to deliver the order in a satisfactory manner and/ or (ii) the user tries to take advantage of the system which violates the Terms of Use. Gradeup will ensure that any communication of cancellation of an order or any applicable refund will be made within a reasonable period of time.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Refunds: You shall be entitled to a refund only if Gradeup is unable to deliver your order in an adequate manner. All refunds will be processed on a pro-rated basis, depending on the service already delivered by Gradeup. Refunds will be done directly to the original payment mode within seven days of finalization of claim.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>AMENDMENTS TO THE TERMS AND CONDITIONS</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Gradeup may amend the Terms of Use and other Gradeup Policies published on the Platform from time to time at its sole discretion. Your continued access or use of the Platform and Services constitutes your acceptance of the amendments. Your access and use of the Platform and Services will be subject to the most current version of the Terms of Use, Privacy Policy and Copyright Policy posted on the Platform at the time of such use. Please regularly check the Platform to view the latest version of Gradeup Policies.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>APPLICABLE LAW AND JURISDICTION</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Terms of Use shall be governed by and construed in accordance with the Laws of India. In case of any disputes the courts in Delhi will have exclusive jurisdiction to try any such disputes to the exclusion of all other courts.</p>\r\n\r\n<p>&nbsp;</p>', '<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td><a href=\"https://www.facebook.com/\"><strong>Exam Name</strong></a></td>\r\n			<td><a href=\"https://www.facebook.com/\"><strong>Exam Dates</strong></a></td>\r\n			<td><a href=\"https://www.facebook.com/\"><strong>Vacancy</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"https://www.facebook.com/\">IBPS PO</a></td>\r\n			<td><a href=\"https://www.facebook.com/\">13, 14, 20 &amp; 21 October 2018</a></td>\r\n			<td><br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;\r\n			<table border=\"1px\">\r\n				<tbody>\r\n					<tr>\r\n						<td><a href=\"https://www.facebook.com/\">NA</a></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"https://www.facebook.com/\">IBPS Clerk</a></td>\r\n			<td><a href=\"https://www.facebook.com/\">8, 9, 15 &amp; 16 December 2018</a></td>\r\n			<td><br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;\r\n			<table border=\"1px\">\r\n				<tbody>\r\n					<tr>\r\n						<td><a href=\"https://www.facebook.com/\">NA</a></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"https://www.facebook.com/\">IBPS Clerk</a></td>\r\n			<td>8, 9, 15 &amp; 16 December 2018</td>\r\n			<td><br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;\r\n			<table border=\"1px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>NA</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"https://www.facebook.com/\" rel=\"noopener\" target=\"_blank\">IBPS Clerk</a></td>\r\n			<td>8, 9, 15 &amp; 16 December 2018</td>\r\n			<td><br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;\r\n			<table border=\"1px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>NA</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;\r\n<p>&nbsp;\r\n<p>&nbsp;</p>\r\n</p>\r\n</p>\r\n\r\n<p>उपयोग की शर्तें सूचना प्रौद्योगिकी अधिनियम, 2000 के प्रावधानों और इसके तहत लागू होने वाले अन्य लागू नियमों के अनुसार, सूचना प्रौद्योगिकी (मध्यस्थता दिशानिर्देश) नियम, 2011 तक सीमित नहीं बल्कि इन तक सीमित नहीं है। ग्रेडअप वेबसाइट (&quot;वेबसाइट&quot;) और / या ग्रेडअप मोबाइल ऐप (&quot;ऐप&quot;) में आपका स्वागत है। वेबसाइट और ऐप का स्वामित्व और ग्रेड स्टैक लर्निंग प्राइवेट द्वारा आपको प्रदान किया जाता है। लिमिटेड, इसका पंजीकृत कार्यालय ए -5, पंचविती, नई दिल्ली -110033 में है। वेबसाइट और ऐप को बाद में सामूहिक रूप से &quot;प्लेटफार्म&quot; के रूप में जाना जाएगा। उपयोग की शर्तों के प्रयोजनों के लिए, प्लेटफार्म को एक साथ मिलना किसी भी अध्ययन सामग्री के साथ जो उसमें उपलब्ध या अपलोड किया गया था या डाउनलोड किया गया था, वहां से एम्बेडेड होने के बाद उसके बाद सामूहिक रूप से &quot;सेवाएं&quot; कहा जाएगा। परिचय प्लेटफार्म पर पंजीकरण करने, देखने, देखने, साझा करने, एम्बेड करने और / या किसी भी सेवा को डाउनलोड करने सहित किसी भी तरह से प्लेटफॉर्म का उपयोग या एक्सेस करने से, आप यहां दिए गए उपयोग की शर्तों से बाध्य होने के लिए सहमत हैं। इन नियमों की शर्तों को स्वीकार करके, आप ग्रेडअप नीतियों और ग्रेडअप कॉपीराइट नीति तक सीमित नहीं बल्कि इसमें ग्रेडअप नीतियों से बाध्य होने के लिए भी स्वीकार करते हैं और सहमत होते हैं।<br />\r\n<br />\r\n&nbsp;</p>\r\n\r\n<p><br />\r\n&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', '2018-03-22 16:17:13', '2018-03-14 11:21:42', 'https://twitter.com/', 'https://www.instagram.com/', 'https://in.linkedin.com/', 'https://www.facebook.com/', 'https://plus.google.com/', 'http://webdesky.com/gradeup/', 'asset/uploads/');

-- --------------------------------------------------------

--
-- Table structure for table `sub_menu`
--

CREATE TABLE `sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `en_sub_menu_name` varchar(255) DEFAULT NULL,
  `hi_sub_menu_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_menu`
--

INSERT INTO `sub_menu` (`id`, `menu_id`, `en_sub_menu_name`, `hi_sub_menu_name`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 1, 'SBI', ' स्टेट बैंक ऑफ इंडिया', '2018-03-19 08:27:40', '2018-03-19 12:57:40', 1),
(2, 1, 'IBPS', 'आईबीपीएस', '2018-03-19 12:18:33', '2018-03-19 16:48:33', 1),
(3, 1, 'RBI', 'भारतीय रिजर्व बैंक', '2018-03-19 12:18:48', '2018-03-19 16:48:48', 1),
(4, 1, 'Insurance', 'बीमा', '2018-03-19 12:19:06', '2018-03-19 16:49:06', 1),
(5, 6, 'SSC & Railways', 'एसएससी और रेलवे', '2018-03-19 12:21:16', '2018-03-19 16:51:16', 1),
(7, 1, 'Important Links', 'महत्वपूर्ण कड़ियाँ', '2018-03-21 12:06:45', '2018-03-21 06:36:45', 1),
(8, 1, 'Other Exams', 'अन्य परीक्षाएं', '2018-03-21 12:08:49', '2018-03-21 06:38:49', 1),
(9, 1, 'Notes', ' टिप्पणियाँ', '2018-03-21 12:09:26', '2018-03-21 06:39:26', 1),
(10, 6, 'Other Exams', 'अन्य परीक्षाएं', '2018-03-21 12:11:42', '2018-03-21 06:41:42', 1),
(11, 6, 'State Exams', ' राज्य परीक्षाएं', '2018-03-21 12:12:09', '2018-03-21 06:42:09', 1),
(12, 6, 'SSC Quizes', 'एसएससी क्विज़', '2018-03-21 12:12:39', '2018-03-21 06:42:39', 1),
(13, 6, 'Quick Links', 'त्वरित सम्पक', '2018-03-21 12:13:12', '2018-03-21 06:43:12', 1),
(14, 6, 'Notification', 'अधिसूचना', '2018-03-21 12:13:30', '2018-03-21 06:43:30', 1),
(15, 6, 'Featured', ' विशेष रुप से प्रदर्शित', '2018-03-21 12:13:52', '2018-03-21 06:43:52', 1),
(16, 8, 'TET Exams', 'टीईटी परीक्षाएं', '2018-03-21 12:14:29', '2018-03-21 06:44:29', 1),
(17, 8, 'B. Ed Exams', ' बी एड परीक्षाएं', '2018-03-21 12:15:03', '2018-03-21 06:45:03', 1),
(18, 8, 'Other Exams', 'अन्य परीक्षाएं', '2018-03-21 12:15:23', '2018-03-21 06:45:23', 1),
(19, 8, 'Quizes', ' क्विज़', '2018-03-21 12:15:44', '2018-03-21 06:45:44', 1),
(20, 8, 'Subjects', ' विषय', '2018-03-21 12:17:15', '2018-03-21 06:47:15', 1),
(21, 8, 'Notifications', ' सूचनाएं', '2018-03-21 12:17:36', '2018-03-21 06:47:36', 1),
(22, 8, 'Featured', 'विशेष रुप से प्रदर्शित', '2018-03-21 12:17:59', '2018-03-21 06:47:59', 1),
(23, 9, 'JEE', ' जेईई', '2018-03-21 12:18:33', '2018-03-21 06:48:33', 1),
(24, 9, 'State Level Exams', ' राज्य स्तरीय परीक्षाएं', '2018-03-21 12:18:59', '2018-03-21 06:48:59', 1),
(25, 9, 'Quick Links', 'त्वरित सम्पक', '2018-03-21 12:19:25', '2018-03-21 06:49:25', 1),
(26, 9, 'Other exams', ' अन्य परीक्षाएं', '2018-03-21 12:19:51', '2018-03-21 06:49:51', 1),
(27, 9, 'Subjects', ' विषय', '2018-03-21 12:20:15', '2018-03-21 06:50:15', 1),
(28, 9, 'Topic Tests', ' विषय परीक्षण', '2018-03-21 12:20:40', '2018-03-21 06:50:40', 1),
(29, 9, 'Featured', ' विशेष रुप से प्रदर्शित', '2018-03-21 12:21:01', '2018-03-21 06:51:01', 1),
(30, 10, 'Exams', 'परीक्षाएं', '2018-03-21 12:21:38', '2018-03-21 06:51:38', 1),
(31, 10, 'Subject', ' विषय', '2018-03-21 12:22:06', '2018-03-21 06:52:06', 1),
(32, 10, 'Quizes', 'क्विज़', '2018-03-21 12:22:32', '2018-03-21 06:52:32', 1),
(33, 10, 'Quick Links', ' त्वरित सम्पक', '2018-03-21 12:23:07', '2018-03-21 06:53:07', 1),
(34, 10, 'Featured', ' विशेष रुप से प्रदर्शित', '2018-03-21 12:23:29', '2018-03-21 06:53:29', 1),
(35, 7, 'Exams', 'परीक्षा', '2018-03-21 12:23:53', '2018-03-21 06:53:53', 1),
(36, 7, 'Subjects', 'विषय', '2018-03-21 12:24:12', '2018-03-21 06:54:12', 1),
(37, 7, 'Quick Links', ' त्वरित सम्पक', '2018-03-21 12:24:46', '2018-03-21 06:54:46', 1),
(38, 7, 'Featured', ' विशेष रुप से प्रदर्शित', '2018-03-21 12:25:03', '2018-03-21 06:55:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `super_sub_menu`
--

CREATE TABLE `super_sub_menu` (
  `id` int(11) NOT NULL,
  `sub_menu_id` int(11) DEFAULT NULL,
  `en_super_sub_menu` varchar(255) DEFAULT NULL,
  `hi_super_sub_menu` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `super_sub_menu`
--

INSERT INTO `super_sub_menu` (`id`, `sub_menu_id`, `en_super_sub_menu`, `hi_super_sub_menu`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 1, 'SBI PO', 'एसबीआई पीओ', '2018-03-21 17:01:37', '2018-03-21 11:31:37', 1),
(2, 2, 'IBPS Exams', 'आईबीपीएस परीक्षाएं', '2018-03-21 17:02:12', '2018-03-21 11:32:12', 1),
(3, 3, 'RBI Grade B', 'आईबीपीएस परीक्षाएं', '2018-03-21 17:04:33', '2018-03-21 11:34:33', 1),
(4, 4, 'Insurance', 'बीमा', '2018-03-21 17:05:03', '2018-03-21 11:35:03', 1),
(5, 5, 'SSC GCL', 'एसएससी सीजीएल', '2018-03-21 17:05:50', '2018-03-21 11:35:50', 1),
(6, 10, 'IB SCIO', 'आईबी एसीआईओ', '2018-03-21 17:06:23', '2018-03-21 11:36:23', 1),
(7, 11, 'MP STATE EXAMS', 'एमपी स्टेट एक्जाम', '2018-03-21 17:07:02', '2018-03-21 11:37:02', 1),
(8, 12, 'SSC QUANT QUIZ', 'एसएससी क्वांट क्विज', '2018-03-21 17:07:55', '2018-03-21 11:37:55', 1),
(9, 13, 'General Awareness', 'सामान्य जागरूकता', '2018-03-21 17:08:37', '2018-03-21 11:38:37', 1),
(10, 14, 'SSC CGL Notification', 'एसएससी सीजीएल अधिसूचना', '2018-03-21 17:09:06', '2018-03-21 11:39:06', 1),
(11, 16, 'TET', 'टी ई टी', '2018-03-21 17:09:40', '2018-03-21 11:39:40', 1),
(12, 17, 'UP B.Ed', 'यूपी बीड', '2018-03-21 17:10:18', '2018-03-21 11:40:18', 1),
(13, 18, 'KVS', 'केवीएस', '2018-03-21 17:10:48', '2018-03-21 11:40:48', 1),
(14, 19, 'Social Science Quiz', 'सामाजिक विज्ञान प्रश्नोत्तरी', '2018-03-21 17:11:54', '2018-03-21 11:41:54', 1),
(15, 20, 'Hindi Language', 'हिन्दी भाषा', '2018-03-21 17:12:27', '2018-03-21 11:42:27', 1),
(16, 21, 'UPTET Notification', 'UPTET अधिसूचना', '2018-03-21 17:13:34', '2018-03-21 11:43:34', 1),
(17, 35, 'Civil Service Exams', 'सिविल सेवा परीक्षा', '2018-03-21 17:14:10', '2018-03-21 11:44:10', 1),
(18, 36, 'Indian History', 'भारतीय इतिहास', '2018-03-21 17:14:48', '2018-03-21 11:44:48', 1),
(19, 37, 'UPSC Notification', 'संघ लोक सेवा आयोग की अधिसूचना', '2018-03-21 17:15:33', '2018-03-21 11:45:33', 1),
(20, 23, 'Jee Advanced', 'जेईई एडवांसड', '2018-03-21 17:16:18', '2018-03-21 11:46:18', 1),
(21, 24, 'UPSEE', 'UPSEE', '2018-03-21 17:16:39', '2018-03-21 11:46:39', 1),
(22, 25, 'JEE MAIN LIST', 'जेईई मेन लिस्ट', '2018-03-21 17:17:13', '2018-03-21 11:47:13', 1),
(23, 26, 'BITSAT', 'BITSAT', '2018-03-21 17:17:37', '2018-03-21 11:47:37', 1),
(24, 1, 'SBI CLERK', 'एसबीआई क्लर्क', '2018-03-22 18:23:31', '2018-03-22 12:53:31', 1),
(25, 1, 'SBI SO', 'एसबीआई एओ', '2018-03-22 18:24:00', '2018-03-22 12:54:00', 1),
(26, 2, 'Bank Exams', 'बैंक परीक्षा', '2018-03-22 18:25:08', '2018-03-22 12:55:08', 1),
(27, 2, 'IBPS PO', 'आईबीपीएस पो', '2018-03-22 18:25:50', '2018-03-22 12:55:50', 1),
(28, 2, 'IBPS CLERK', 'आईबीपीएस क्लर्क', '2018-03-22 18:26:14', '2018-03-22 12:56:14', 1),
(29, 2, 'IBPS RRB', 'आईबीपीएस आरआरबी', '2018-03-22 18:26:35', '2018-03-22 12:56:35', 1),
(30, 2, 'IBPS S', 'आईबीपीएस  एस', '2018-03-22 18:27:27', '2018-03-22 12:57:27', 1),
(31, 3, 'RBI ASSISTANT', 'भारतीय रिजर्व बैंक के सहायक', '2018-03-22 18:27:59', '2018-03-22 12:57:59', 1),
(32, 4, 'NIACL', 'NIACL', '2018-03-22 18:28:38', '2018-03-22 12:58:38', 1),
(33, 4, 'NICL', 'एनआईसीएल', '2018-03-22 18:42:55', '2018-03-22 13:12:55', 1),
(34, 4, 'UIIC', 'UIIC', '2018-03-22 18:43:13', '2018-03-22 13:13:13', 1),
(35, 4, 'OICL', 'OICL', '2018-03-22 18:43:36', '2018-03-22 13:13:36', 1),
(36, 4, 'LIC', 'एलआईसी', '2018-03-22 18:43:54', '2018-03-22 13:13:54', 1),
(37, 7, 'Bank Po', 'बैंक पीओ', '2018-03-22 18:44:20', '2018-03-22 13:14:20', 1),
(38, 7, 'Bank Clerk', 'बैंक क्लर्क', '2018-03-22 18:44:44', '2018-03-22 13:14:44', 1),
(39, 7, 'BAnk Exam Notification', 'बैंक परीक्षा अधिसूचना', '2018-03-22 18:45:11', '2018-03-22 13:15:11', 1),
(40, 7, 'bank Exam Syllabus', 'बैंक परीक्षा पाठ्यक्रम', '2018-03-22 18:45:48', '2018-03-22 13:15:48', 1),
(41, 7, 'Bank Exam Subject', 'बैंक परीक्षा विषय', '2018-03-22 18:46:16', '2018-03-22 13:16:16', 1),
(42, 7, 'Latest Government Jobs', 'नवीनतम सरकारी कार्य', '2018-03-22 18:46:51', '2018-03-22 13:16:51', 1),
(43, 8, 'Dena Bank', 'डेना बांक', '2018-03-22 18:47:20', '2018-03-22 13:17:20', 1),
(44, 8, 'Indian Bank PO', 'इंडियन बैंक पीओ', '2018-03-22 18:47:47', '2018-03-22 13:17:47', 1),
(45, 8, 'IPPB', 'IPPB', '2018-03-22 18:48:04', '2018-03-22 13:18:04', 1),
(46, 8, 'NABARD', 'नाबार्ड', '2018-03-22 18:48:26', '2018-03-22 13:18:26', 1),
(47, 8, 'BOB Manipal', 'बॉब मणिपाल', '2018-03-22 18:48:48', '2018-03-22 13:18:48', 1),
(48, 8, 'Syndicate Bank PO', 'सिंडिकेट बैंक पीओ', '2018-03-22 18:49:08', '2018-03-22 13:19:08', 1),
(49, 9, 'Daily GK Updates', 'दैनिक जीके अपडेट', '2018-03-22 18:49:26', '2018-03-22 13:19:26', 1),
(50, 9, 'Current Affairs', 'सामयिकी', '2018-03-22 18:49:44', '2018-03-22 13:19:44', 1),
(51, 9, 'Banking Awareness', 'बैंकिंग जागरूकता', '2018-03-22 18:50:04', '2018-03-22 13:20:04', 1),
(52, 9, 'General Awareness', 'सामान्य जागरूकता', '2018-03-22 18:50:23', '2018-03-22 13:20:23', 1),
(53, 9, 'Quantitative Aptitude', 'मात्रात्मक रूझान', '2018-03-22 18:50:41', '2018-03-22 13:20:41', 1),
(54, 9, 'Reasoning Ability', 'सोचने की क्षमता', '2018-03-22 18:50:58', '2018-03-22 13:20:58', 1),
(55, 9, 'Bank PO Books', 'बैंक पीओ बुक्स', '2018-03-22 18:51:23', '2018-03-22 13:21:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `super_sub_menu_post`
--

CREATE TABLE `super_sub_menu_post` (
  `id` int(11) NOT NULL,
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

INSERT INTO `super_sub_menu_post` (`id`, `super_sub_menu_id`, `en_post`, `hi_post`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 1, '<h1>SBI PO 2018&nbsp;</h1>\r\n\r\n<p>2311.5 K+ Members | 330.4 K+ Posts</p>\r\n\r\n<p>SBI PO 2018 notification is expected to be released in last week of March 2018. Candidates preparing for SBI PO recruitment 2018 can check here notification details, vacancy list, exam date, syllabus, latest exam pattern, cut off marks, eligibility (age limit), mock test, &amp; previous year question papers for SBI PO exam preparation.</p>\r\n\r\n<table border=\"1px\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>SBI PO Notification 2018 Summary</strong></p>\r\n\r\n			<ul>\r\n				<li><a href=\"https://gradeup.co/banking-insurance/sbi-po#exam-date\">Exam Date</a></li>\r\n				<li><a href=\"https://gradeup.co/banking-insurance/sbi-po#eligibility\">Eligibility</a></li>\r\n				<li><a href=\"https://gradeup.co/banking-insurance/sbi-po#vacancy\">Vacancy</a></li>\r\n				<li><a href=\"https://gradeup.co/banking-insurance/sbi-po#apply-online\">Apply Online</a></li>\r\n				<li><a href=\"https://gradeup.co/banking-insurance/sbi-po#admit-card\">Admit Card</a></li>\r\n				<li><a href=\"https://gradeup.co/banking-insurance/sbi-po#salary\">Salary</a></li>\r\n				<li><a href=\"https://gradeup.co/banking-insurance/sbi-po#selection\">Selection</a></li>\r\n				<li><a href=\"https://gradeup.co/banking-insurance/sbi-po#syllabus\">Syllabus</a></li>\r\n				<li><a href=\"https://gradeup.co/banking-insurance/sbi-po#exam-pattern\">Exam Pattern</a></li>\r\n				<li><a href=\"https://gradeup.co/banking-insurance/sbi-po#cut-off\">Cut Off</a></li>\r\n				<li><a href=\"https://gradeup.co/banking-insurance/sbi-po#question-papers\">Question Papers</a></li>\r\n				<li><a href=\"https://gradeup.co/banking-insurance/sbi-po#preparation\">Preparation</a></li>\r\n				<li><a href=\"https://gradeup.co/banking-insurance/sbi-po#test-series\">Test Series</a></li>\r\n				<li><a href=\"https://gradeup.co/banking-insurance/sbi-po#result\">Result</a></li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h2>What is SBI PO Exam?</h2>\r\n\r\n<p>Probationary Officer in State Bank of India (SBI PO) is one of the most coveted exams in India. SBI conducts online recruitment exam for the post of&nbsp;<a href=\"https://gradeup.co/banking-insurance/bank-po\" rel=\"noopener\" target=\"_blank\">Bank PO</a>&nbsp;every year and almost 30 Lakh students appear for this exam annually. With SBI merges its associated entities, it has now become one of the largest banking institutions in the world, and thus, the bar of competition has gone up. Candidates get selected after the final interview round, gets the opportunity to work with SBI as a&nbsp;Probationary Officer (PO).</p>\r\n\r\n<h2>SBI PO Recruitment 2018: Important Dates</h2>\r\n\r\n<table border=\"1ppz\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>&nbsp;<strong>Event Name</strong></td>\r\n			<td><strong>Dates</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Publish Late of Notification</td>\r\n			<td>March 2018 (Last Week)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Start of Online Registration</td>\r\n			<td>April 2018</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Last Date of Online Registration</td>\r\n			<td>May 2018</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Download Admit Card</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>SBI PO Prelims Exam Date</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Prelims Result Date</td>\r\n			<td>-</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><em>* All the dates are tentative. The notification of SBI PO 2018 is yet to be released.</em></p>\r\n\r\n<h2><strong>Eligibility Criteria</strong></h2>\r\n\r\n<p>The&nbsp;<a href=\"https://gradeup.co/sbi-po-eligibility-i-daf85560-f448-11e7-81e0-89d92ab28fd7\" rel=\"noopener\" target=\"_blank\">eligibility criteria for SBI PO</a>&nbsp;Exam is as follows-</p>\r\n\r\n<ol>\r\n	<li><strong>Age-Based Eligibility</strong><br />\r\n	Minimum 21 years and maximum 30 years</li>\r\n	<li><strong>Educational Qualification</strong><br />\r\n	Graduation in any discipline from a recognized University or any equivalent qualification recognized as such by the Central Government</li>\r\n</ol>\r\n\r\n<h2>Vacancy</h2>\r\n\r\n<p>Last year, the notification for SBI PO was released for 2313 vacancies. The details are as follows-</p>\r\n\r\n<table border=\"1px\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"5\"><strong>Vacancies of SBI PO</strong></td>\r\n			<td colspan=\"4\"><strong>PWD Vacancy Details</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;<strong>SC</strong></td>\r\n			<td><strong>ST</strong></td>\r\n			<td><strong>OBC</strong></td>\r\n			<td><strong>General</strong></td>\r\n			<td><strong>Total</strong></td>\r\n			<td><strong>OH</strong></td>\r\n			<td><strong>VI</strong></td>\r\n			<td><strong>HI</strong></td>\r\n			<td><strong>Total</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;347</td>\r\n			<td>&nbsp;350</td>\r\n			<td>&nbsp;606</td>\r\n			<td>1010</td>\r\n			<td>2313</td>\r\n			<td>25</td>\r\n			<td>25</td>\r\n			<td>40</td>\r\n			<td>90</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h2>Application Form</h2>\r\n\r\n<p>Online Registration for SBI PO usually commences from the date on which the official notification is released. Once the registration link is activated, you can apply till 30 days. The link for online registration will be available on the&nbsp;<a href=\"https://www.sbi.co.in/careers/ongoing-recruitment.html\" rel=\"noopener\" target=\"_blank\">official website of SBI</a>. You can also go through the&nbsp;<a href=\"https://gradeup.co/sbi-po-application-form-2017-apply-online-for-2313-vacancies-i-b63997c0-ecf1-11e6-bcb5-ea224d212ebe\">SBI PO application form</a>&nbsp;for the direct link to the online form.</p>', '<h1>SBI PO 2018</h1>\r\n\r\n<p>2311.5 K+ Members | 330.4 K+ Posts</p>\r\n\r\n<p>SBI PO 2018 notification is expected to be released in last week of March 2018. Candidates preparing for SBI PO recruitment 2018 can check here notification details, vacancy list, exam date, syllabus, latest exam pattern, cut off marks, eligibility (age limit), mock test, &amp; previous year question papers for SBI PO exam preparation.</p>\r\n\r\n<table border=\"1px\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>SBI PO Notification 2018 Summary</strong></p>\r\n\r\n			<ul>\r\n				<li><a href=\"https://gradeup.co/banking-insurance/sbi-po#exam-date\">Exam Date</a></li>\r\n				<li><a href=\"https://gradeup.co/banking-insurance/sbi-po#eligibility\">Eligibility</a></li>\r\n				<li><a href=\"https://gradeup.co/banking-insurance/sbi-po#vacancy\">Vacancy</a></li>\r\n				<li><a href=\"https://gradeup.co/banking-insurance/sbi-po#apply-online\">Apply Online</a></li>\r\n				<li><a href=\"https://gradeup.co/banking-insurance/sbi-po#admit-card\">Admit Card</a></li>\r\n				<li><a href=\"https://gradeup.co/banking-insurance/sbi-po#salary\">Salary</a></li>\r\n				<li><a href=\"https://gradeup.co/banking-insurance/sbi-po#selection\">Selection</a></li>\r\n				<li><a href=\"https://gradeup.co/banking-insurance/sbi-po#syllabus\">Syllabus</a></li>\r\n				<li><a href=\"https://gradeup.co/banking-insurance/sbi-po#exam-pattern\">Exam Pattern</a></li>\r\n				<li><a href=\"https://gradeup.co/banking-insurance/sbi-po#cut-off\">Cut Off</a></li>\r\n				<li><a href=\"https://gradeup.co/banking-insurance/sbi-po#question-papers\">Question Papers</a></li>\r\n				<li><a href=\"https://gradeup.co/banking-insurance/sbi-po#preparation\">Preparation</a></li>\r\n				<li><a href=\"https://gradeup.co/banking-insurance/sbi-po#test-series\">Test Series</a></li>\r\n				<li><a href=\"https://gradeup.co/banking-insurance/sbi-po#result\">Result</a></li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h2>What is SBI PO Exam?</h2>\r\n\r\n<p>Probationary Officer in State Bank of India (SBI PO) is one of the most coveted exams in India. SBI conducts online recruitment exam for the post of&nbsp;<a href=\"https://gradeup.co/banking-insurance/bank-po\" rel=\"noopener\" target=\"_blank\">Bank PO</a>&nbsp;every year and almost 30 Lakh students appear for this exam annually. With SBI merges its associated entities, it has now become one of the largest banking institutions in the world, and thus, the bar of competition has gone up. Candidates get selected after the final interview round, gets the opportunity to work with SBI as a&nbsp;Probationary Officer (PO).</p>\r\n\r\n<h2>SBI PO Recruitment 2018: Important Dates</h2>\r\n\r\n<table border=\"1ppz\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>&nbsp;<strong>Event Name</strong></td>\r\n			<td><strong>Dates</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Publish Late of Notification</td>\r\n			<td>March 2018 (Last Week)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Start of Online Registration</td>\r\n			<td>April 2018</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Last Date of Online Registration</td>\r\n			<td>May 2018</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Download Admit Card</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>SBI PO Prelims Exam Date</td>\r\n			<td>-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Prelims Result Date</td>\r\n			<td>-</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><em>* All the dates are tentative. The notification of SBI PO 2018 is yet to be released.</em></p>\r\n\r\n<h2><strong>Eligibility Criteria</strong></h2>\r\n\r\n<p>The&nbsp;<a href=\"https://gradeup.co/sbi-po-eligibility-i-daf85560-f448-11e7-81e0-89d92ab28fd7\" rel=\"noopener\" target=\"_blank\">eligibility criteria for SBI PO</a>&nbsp;Exam is as follows-</p>\r\n\r\n<ol>\r\n	<li><strong>Age-Based Eligibility</strong><br />\r\n	Minimum 21 years and maximum 30 years</li>\r\n	<li><strong>Educational Qualification</strong><br />\r\n	Graduation in any discipline from a recognized University or any equivalent qualification recognized as such by the Central Government</li>\r\n</ol>\r\n\r\n<h2>Vacancy</h2>\r\n\r\n<p>Last year, the notification for SBI PO was released for 2313 vacancies. The details are as follows-</p>\r\n\r\n<table border=\"1px\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"5\"><strong>Vacancies of SBI PO</strong></td>\r\n			<td colspan=\"4\"><strong>PWD Vacancy Details</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;<strong>SC</strong></td>\r\n			<td><strong>ST</strong></td>\r\n			<td><strong>OBC</strong></td>\r\n			<td><strong>General</strong></td>\r\n			<td><strong>Total</strong></td>\r\n			<td><strong>OH</strong></td>\r\n			<td><strong>VI</strong></td>\r\n			<td><strong>HI</strong></td>\r\n			<td><strong>Total</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;347</td>\r\n			<td>&nbsp;350</td>\r\n			<td>&nbsp;606</td>\r\n			<td>1010</td>\r\n			<td>2313</td>\r\n			<td>25</td>\r\n			<td>25</td>\r\n			<td>40</td>\r\n			<td>90</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h2>Application Form</h2>\r\n\r\n<p>Online Registration for SBI PO usually commences from the date on which the official notification is released. Once the registration link is activated, you can apply till 30 days. The link for online registration will be available on the&nbsp;<a href=\"https://www.sbi.co.in/careers/ongoing-recruitment.html\" rel=\"noopener\" target=\"_blank\">official website of SBI</a>. You can also go through the&nbsp;<a href=\"https://gradeup.co/sbi-po-application-form-2017-apply-online-for-2313-vacancies-i-b63997c0-ecf1-11e6-bcb5-ea224d212ebe\">SBI PO application form</a>&nbsp;for the direct link to the online form.</p>', '2018-03-22 13:12:04', '2018-03-22 07:42:04', 1);

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
-- Table structure for table `training`
--

CREATE TABLE `training` (
  `id` int(11) NOT NULL,
  `module_id` varchar(255) DEFAULT NULL,
  `chapter_id` varchar(255) DEFAULT NULL,
  `en_training_name` varchar(255) NOT NULL,
  `hi_training_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `training`
--

INSERT INTO `training` (`id`, `module_id`, `chapter_id`, `en_training_name`, `hi_training_name`, `created_at`, `updated_at`, `is_active`) VALUES
(1, '7,8', '4,3,2', 'English', 'Hindi', '2018-03-15 06:41:36', '2018-03-15 11:11:36', 1),
(2, '7,8', '2,4', 'English Trainings', 'Hindi Trainings', '2018-03-15 07:23:45', '2018-03-15 11:53:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blood_group` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_role` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `date_of_birth`, `gender`, `blood_group`, `profile_pic`, `username`, `email`, `password`, `mobile`, `phone_no`, `address`, `user_role`, `remember_token`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'admin', 'admin', '02/02/2018', 'male', 'a+', '05-755766569.jpg', 'admin', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '7828759804', '9699996116', 'indore', 1, NULL, 1, '2018-01-25 04:01:40', '2018-01-25 04:01:40'),
(3, 'Gaurav', 'badlani', '', '', '', 'download.png', '', 'fgdfgdfg', '8d509c28896865f8640f328f30f15721', '', '', 'indore', 3, NULL, 1, '2018-03-24 17:39:48', '2018-03-24 12:09:48'),
(5, 'Govrav', 'jain', '', '', '', 'download.png', 'garov', 'garov@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', 'indore', 3, NULL, 1, '2018-03-24 17:56:03', '2018-03-24 12:26:03'),
(7, 'ok', 'ok1', '', '', '', 'download.png', 'ok1', 'ok1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', 'indore', 3, NULL, 1, '2018-03-24 17:57:34', '2018-03-24 12:27:34'),
(9, 'Govrav', 'jain', '', '', '', 'download.png', 'garovasa', 'garovasa@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', 3, NULL, 1, '2018-03-24 18:06:49', '2018-03-24 12:36:49'),
(10, 'sdgdfgdfg', 'dfgdfgdfg', '', '', '', NULL, 'ok', 'ok', '79337b65467667d3b91bad748d45b2ef', '', '', '', 3, NULL, 1, '2018-03-24 18:17:38', '2018-03-24 12:47:38'),
(11, 'amar kumar', 'jain', '', '', '', NULL, 'amarjain810', 'amarjain810@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', 3, NULL, 1, '2018-03-27 11:05:56', '2018-03-27 05:35:56'),
(12, 'Dharam', 'kumar', '', '', '', NULL, 'dharam', 'dharam@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', 3, NULL, 1, '2018-03-27 11:08:26', '2018-03-27 05:38:26'),
(13, 'sdfsdf', 'sdfsdf', '', '', '', NULL, 'sdfsdf', 'sdfsdf', 'f4afe93ad799484b1d512cc20e93efd1', '', '', '', 3, NULL, 1, '2018-03-27 11:09:48', '2018-03-27 05:39:48'),
(14, 'vivek', 'singh', '', '', '', NULL, 'vivek', 'vivek@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', 3, NULL, 1, '2018-03-27 11:26:15', '2018-03-27 05:56:15'),
(15, 'rajendra', 'sir', '', '', '', NULL, 'rajendra', 'rajendra@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', 3, NULL, 1, '2018-03-27 11:34:51', '2018-03-27 06:04:51');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`role_id`, `role_name`, `is_active`) VALUES
(1, 'admin', 1),
(2, 'mentor', 1),
(3, 'user', 1);

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
(1, 'Real-time Exam Prep Community', '<p>&nbsp;</p>\r\n\r\n<p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor.</p>', '5ab6375b1caad.jpg', 'रीयल-टाइम परीक्षा तैयारी समुदाय', '<p>एनिम उनके परिवार के लिए उच्च जीवन अभियुक्त टेरी रिचर्डसन एड स्क्वीड के बारे में पूछताछ करता है। 3 भेड़िया चाँद officia aute, गैर cupidatat स्केटबोर्ड रंग</p>', 1, '2018-03-24 12:22:45', '2018-03-24 12:22:45'),
(2, 'Real-time Exam Prep Community', '<p>&nbsp;</p>\r\n\r\n<p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor.</p>', '5ab6371e2bc72.png', 'रीयल-टाइम परीक्षा तैयारी समुदाय', '<p>एनिम उनके परिवार के लिए उच्च जीवन अभियुक्त टेरी रिचर्डसन एड स्क्वीड के बारे में पूछताछ करता है। 3 भेड़िया चाँद officia aute, गैर cupidatat स्केटबोर्ड रंग</p>', 1, '2018-03-24 12:35:56', '2018-03-24 12:35:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mcq`
--
ALTER TABLE `mcq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `save_notes`
--
ALTER TABLE `save_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `super_sub_menu`
--
ALTER TABLE `super_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `super_sub_menu_post`
--
ALTER TABLE `super_sub_menu_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`id`,`en_training_name`,`hi_training_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `why_choose_us`
--
ALTER TABLE `why_choose_us`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mcq`
--
ALTER TABLE `mcq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `save_notes`
--
ALTER TABLE `save_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sub_menu`
--
ALTER TABLE `sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `super_sub_menu`
--
ALTER TABLE `super_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `super_sub_menu_post`
--
ALTER TABLE `super_sub_menu_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `training`
--
ALTER TABLE `training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `why_choose_us`
--
ALTER TABLE `why_choose_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
