-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2018 at 01:10 PM
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
-- Database: `online_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int(11) NOT NULL,
  `en_about_us` longtext,
  `hi_about_us` longtext CHARACTER SET utf8,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `en_about_us`, `hi_about_us`, `created_at`, `updated_at`) VALUES
(1, '<p>Gradeup is India&rsquo;s largest and most engaged community for online learning. Since its launch (in Sep 15), Gradeup&#39;s android app has been downloaded by over 6 Million students with a rating of 4.7 on Google Play Store, and has received phenomenal response in terms of engagement and feedback of students. Gradeup is currently positioned as a one stop test prep app for Banking, SSC, GATE, TET (teaching), JEE, NEET and other important exams in India. Students can ask their doubts, access study material, practice and benchmark their preparation among millions of other students. Gradeup has recently launched an app for school students to find solutions for their&nbsp;<a href=\"https://play.google.com/store/apps/details?id=co.gradeup.k12\">home work</a></p>\r\n\r\n<p>At Gradeup we believe that, access to good content, when combined with the power of online communities, can make learning process significantly more collaborative and engaging, and hence much more impactful. We imagined Gradeup as a place where learners can interact with each other and help each other, can access study material and other resources relevant to them, and seek guidance from experts. We really feel that such a platform can become the centre of learning for millions of students. It is this promise which forms the core of value proposition at Gradeup.</p>', '<pre>\r\nऑनलाइन सीखने के लिए ग्रेडअप भारत का सबसे बड़ा और सबसे ज्यादा व्यस्त समुदाय है। इसकी शुरुआत (15 सितंबर) के बाद से, ग्रेडअप एंड्रॉइड ऐप Google Play Store पर 4.7 की रेटिंग के साथ 6 मिलियन से अधिक छात्रों द्वारा डाउनलोड किया गया है, और छात्रों के सगाई और प्रतिक्रिया के संदर्भ में उन्हें अभूतपूर्व प्रतिक्रिया मिली है। ग्रेडअप वर्तमान में बैंकिंग, एसएससी, गेट, टीईटी (टीईटी), जेईई, एनईईटी और भारत में अन्य महत्वपूर्ण परीक्षाओं के लिए एक स्टॉप टेस्ट प्रैप ऐप के रूप में तैनात है। छात्र अपने संदेहों को पूछ सकते हैं, अध्ययन सामग्री, अभ्यास और लाखों अन्य छात्रों के बीच अपनी तैयारी बेंचमार्क तक पहुंच सकते हैं। ग्रेडअप ने हाल ही में स्कूल के छात्रों के लिए अपने घर के काम के समाधान खोजने के लिए एक ऐप लॉन्च किया है\r\n\r\nग्रेडअप में हम मानते हैं कि ऑनलाइन समुदायों की शक्ति के साथ मिलकर, अच्छी सामग्री तक पहुंच, सीखने की प्रक्रिया काफी अधिक सहयोगी और आकर्षक बना सकती है, और इसलिए अधिक प्रभावकारी। हमने ग्रेडअप को उस जगह के रूप में देखा जहां शिक्षार्थी एक-दूसरे के साथ बातचीत कर सकते हैं और एक-दूसरे की मदद कर सकते हैं, अध्ययन सामग्री और उनसे संबंधित अन्य संसाधनों का उपयोग कर सकते हैं, और विशेषज्ञों से मार्गदर्शन प्राप्त कर सकते हैं। हम वास्तव में महसूस करते हैं कि इस तरह का एक मंच लाखों छात्रों के लिए सीखने का केंद्र बन सकता है। यह यह वादा है जो ग्रेडअप पर मूल्य प्रस्ताव के मूल रूप बनाता है।</pre>\r\n', '0000-00-00 00:00:00', '2018-03-14 12:56:28');

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
(2, 7, 'bank Po', 'बैंक पो', '2018-03-14 12:42:03', '2018-03-14 17:12:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `en_module_name` varchar(255) DEFAULT NULL,
  `hi_module_name` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `en_module_name`, `hi_module_name`, `created_at`, `updated_at`, `is_active`) VALUES
(7, 'banking', 'बैंकिंग', '2018-03-14 11:44:47', '2018-03-14 16:14:47', 0),
(8, 'JEE', ' जेईई', '2018-03-14 13:01:01', '2018-03-14 17:31:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policy`
--

CREATE TABLE `privacy_policy` (
  `id` int(11) NOT NULL,
  `en_privacy_policy` longtext,
  `hi_privacy_policy` longtext CHARACTER SET utf8,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privacy_policy`
--

INSERT INTO `privacy_policy` (`id`, `en_privacy_policy`, `hi_privacy_policy`, `created_at`, `updated_at`) VALUES
(1, '<h1>PRIVACY POLICY&nbsp;</h1>\r\n\r\n<p>The following privacy policy is being published in accordance with the provisions of the Information Technology Act, 2000<strong>&nbsp;(&quot;IT ACT&quot;)</strong>, Information Technology (Intermediary Guidelines) Rules, 2011, Information Technology (Reasonable Security Practices and Procedures and Sensitive Personal Data or Information) Rules, 2011.</p>\r\n\r\n<h2>INTRODUCTION</h2>\r\n\r\n<p>This Privacy Policy explains the policy of Gradeup&rsquo;s website (hereinafter referred to as<strong>&nbsp;&quot;the Website&quot;</strong>) and Gradeup&rsquo;s mobile application (hereinafter referred to as<strong>&nbsp;&quot;the App&quot;</strong>), with respect to the disclosure, collection, storage, usage and protection of your information during the course your interaction with the Website and the App.</p>\r\n\r\n<p>Please read this Privacy Policy carefully and in conjunction with the Terms of Use. If you do not understand this policy, or do not accept any part of it, then you should not use the Platform, as the case may be. Your use and/or continued use of the Platform, as the case may be amounts to an express consent to the terms of this Privacy Policy as well as the Terms of Use.</p>\r\n\r\n<p>For the purposes of this Policy, accessing of the Website and the App together with any study material made available or uploaded therein or downloaded, embedded therefrom shall collectively be referred to as the<strong>&quot;Services&quot;</strong>. The Website and the App shall be collectively referred to as<strong>&nbsp;&quot;the Platform&quot;.</strong></p>\r\n\r\n<p>This Privacy Policy forms part and parcel of the Terms of Use for the Gradeup Services and shall be read as a whole. Capitalized terms used here, but undefined, shall have the same meaning as attributed to them in the Terms of Use.</p>\r\n\r\n<ol>\r\n	<li>\r\n	<h2>INFORMATION COLLECTED FROM YOU</h2>\r\n\r\n	<ol style=\"list-style-type:lower-alpha\">\r\n		<li>When you use the Platform by way of registration, log in, creation of a user account or creation of a post, purchase of a test series, attempting a mock test, etc. or by way of interaction via third party websites and/or mobile applications or by way of any other communication with the Platform, Gradeup may collect your personally identifiable information including name, date of birth, gender, demographic information, photos, e-mail address, telephone number, mobile phone number, credit card or debit card details, geographic location, mailing address, social media account details including list of contacts/friends and examination preference.</li>\r\n		<li>Gradeup will use this information to validate you as a user when using the Platform, to provide the Service to you, including administration of your user account, to notify you of changes to the Service or about any changes to our terms and conditions or this privacy policy, to manage its business, including financial reporting and billing of its Service, for the development of new products and services, to send you newsletters, offers and promotion coupons to market and advertise its products and services by email, to comply with applicable laws, court orders and government enforcement agency requests, for research and analytic purposes including to improve the quality of the Service and to ensure that the Service is presented in the most effective manner for you and your device.</li>\r\n		<li>By registering on the Platform, you agree and confirm your consent to providing Gradeup your aforementioned personal information, which is lawful, necessary and permissible. You at all times have the right to discontinue the use of the Platform. Gradeup is not liable to provide you its Services in the absence of or your refusal to provide the aforesaid information. Additionally, Gradeup is not liable to ensure or maintain the same quality of its Services to you, as it may for a user who provides all aforementioned information.</li>\r\n		<li>Any information provided by you under Gradeup&rsquo;s &quot;create a post&quot; feature, comments, upvotes or otherwise any information that you provide on the Platform is not personal information and shall become part of Gradeup&rsquo;s published content. Gradeup may use the aforementioned information without your consent for purposes including but not limited to improving its products and services, developing new products and services and sending you messages about promotions and offers.</li>\r\n	</ol>\r\n	</li>\r\n	<li>\r\n	<h2>INFORMATION COLLECTED AUTOMATICALLY</h2>\r\n\r\n	<ol style=\"list-style-type:lower-alpha\">\r\n		<li>When you visit or interact with the Platform, apart from Gradeup certain third party advertisers and/or service providers may use technologies that automatically collect information about you for both transactional (e.g., confirmation of registration, notification of purchase made, etc.) and promotional (e.g., promotions, newsletters, etc.) purposes. Your information may be collected by Gradeup or such third party advertisers and/or service providers in the following ways:-\r\n		<ol style=\"list-style-type:lower-roman\">\r\n			<li><strong>Log Files:</strong>&nbsp;Every time you visit the Platform, Gradeup servers automatically receive and log information from your browser and device used to access the Platform (such as IP address, device ID, details of your network operator and type, your operating system, browser type and version, CPU speed, and connection speed). This enables us to validate you as a User, to understand your usage of the Platform and helps us to make changes and updates most suited to your needs and interests.</li>\r\n			<li><strong>Mobile Device:</strong>&nbsp;When you register your mobile device or use the mobile device to access the App, In addition to the aforesaid, Gradeup will also collect device information such as mobile device ID, model and manufacturer details, operating system etc. for the purpose of improving the App&rsquo;s overall functionality and displaying content according to your preferences.</li>\r\n			<li><strong>Cookies:</strong>&nbsp;Cookies are data files placed on your device, used to keep track of information such as your interaction with social media websites, the content you click on, download, upload or share and other activity on the Platform etc. in order to improve your experience of the Platform by personalizing it to your preferences and usage trends.</li>\r\n			<li><strong>Web Beacons:</strong>&nbsp;Web beacons are transparent graphic images used in our email communication to you, in order to understand customer behavior and improve the overall quality, functionality and interactivity of the Platform.</li>\r\n			<li><strong>Mobile Analytics:</strong>&nbsp;Mobile analytics software is used by Gradeup to better understand and customize the functionality of the App&rsquo;s software on your phone. This is done by collecting information such as your frequency of the App&rsquo;s usage, the features you prefer to use on the App, where the App was downloaded from, Device Id, name of other mobile applications on your device, etc.</li>\r\n			<li><strong>Mobile Analytics:</strong>&nbsp;Mobile analytics software is used by Gradeup to better understand and customize the functionality of the App&rsquo;s software on your phone. This is done by collecting information such as your frequency of the App&rsquo;s usage, the features you prefer to use on the App, where the App was downloaded from, Device Id, name of other mobile applications on your device, etc.</li>\r\n			<li><strong>Payment /Purchase Information:</strong>&nbsp;In order to access certain paid features and services on the Platform, you may be required to create or log into a separate account on a payment gateway or website such as &ldquo;PayU&rdquo; or &ldquo;PayTM&rdquo;. Once such an account is created, in order to process your payments/ purchases on the Platform, such payment gateway provider may require and collect your details such as name, address, phone number, email address and credit or debit card information, netbanking information or details of any web wallets maintained by you. Any and all payments made/processed or details provided to or shared with such authorized payment gateway providers shall be stored directly by such payment gateway providers without any information passing through or relayed to Gradeup. Gradeup assumes no liability in respect of such payments and/or information shared with or provided to such authorized payment gateway providers. It is further clarified that the aforementioned information is only used in accordance with the provisions of the applicable law and in strict adherence to this Privacy Policy.</li>\r\n			<li><strong>Public Forums:</strong>&nbsp;Any information that is disclosed by you in the comments section or by way of the &ldquo;create a post&rdquo; feature, becomes published information and Gradeup shall not be held liable for the security of the same or any persona information that you disclose herein. You agree to exercise caution when disclosing any personal information or personally identifiable information in this regard.</li>\r\n		</ol>\r\n		</li>\r\n		<li>Please note that we only use the aforesaid information to communicate with and/or improve the Service and to better understand our users&#39; operating systems, for system administration and to audit the use of the Service. We do not use any of the aforesaid data to identify the name, address or other personal details of any individual.</li>\r\n		<li>For the purpose of this Privacy Policy, any passwords, financial information such as credit or debit card details or other payment instrument details and any other information prescribed by law to be sensitive that may be collected by Gradeup during your use of the Platform and the Services provided thereon, shall be referred to as &quot;Sensitive Personal Data or Information&quot;.</li>\r\n	</ol>\r\n	</li>\r\n	<li>\r\n	<h2>LINK TO THIRD PARTIES</h2>\r\n\r\n	<p>The Platform may include links that redirect you to other websites. These third party websites are not covered by this Privacy Policy. You agree that once you leave our servers, any third party websites that you go to or interact with are at your own risk. Gradeup shall not be held liable for any default, loss of function or any risk that your personal sensitive information may be exposed to as a result of the same.</p>\r\n	</li>\r\n	<li>\r\n	<h2>SHARING OR DISCLOSURE OF INFORMATION COLLECTED</h2>\r\n\r\n	<ol style=\"list-style-type:lower-alpha\">\r\n		<li>As a strict policy we will not disclose, share or exploit your information with anyone without your express permission.</li>\r\n		<li>However, we may be mandated under law or under contracts to make certain limited disclosures under the following circumstances:\r\n		<ol style=\"list-style-type:lower-roman\">\r\n			<li><strong>Legal Necessity:</strong>&nbsp;Gradeup may share any of the aforesaid information, including your personally identifiable information or Sensitive Personal Data or Information, without obtaining a separate consent from you, if and when such information is requested or required by law or by any court or governmental agency or authority to disclose, for the purpose of verification of identity, or for the prevention, detection, investigation of any criminal activity, or for prosecution and punishment of offences.</li>\r\n			<li><strong>Limited Disclosure to Service Providers:</strong>&nbsp;we may disclose your information (but not Sensitive Personal Data or Information) to our service providers and business partners (<strong>&quot;Service Providers&quot;</strong>&nbsp;) for the purposes of betterment and improvement of our services including but not limited to hosting the Platform, payment processing, analyzing data, providing customer service, etc., for the purpose of making various features, services and products of Gradeup available to you and investigating or redressing grievances. This will be in the form of aggregated anonymized data and will be under strict contractual arrangements that preserve the confidentiality and security of your personal information in accordance with this Privacy Policy;</li>\r\n			<li><strong>Limited Disclosures for improvement of services:</strong>&nbsp;Gradeup may share the aforesaid information including your personally identifiable information (but not Sensitive Personal Data or Information) when it is required to be shared with sponsors, partners, advertisers, analytics companies or third parties for the purpose of marketing, advertising promotional offers, offering product information and market research, in connection with the Service. This will be in the form of aggregated anonymized data and will be under strict contractual arrangements that preserve the confidentiality and security of your personal information in accordance with this Privacy Policy;</li>\r\n		</ol>\r\n		</li>\r\n	</ol>\r\n	</li>\r\n	<li>\r\n	<h2>SECURITY OF INFORMATION COLLECTED</h2>\r\n\r\n	<ol style=\"list-style-type:lower-alpha\">\r\n		<li>We take the security of your personal information seriously and use appropriate technical and organizational measures to protect your personal information against unauthorized or unlawful processing and against accidental loss, destruction or damage.&nbsp;Unfortunately, the transmission of information via the internet is not completely secure. Although we will do our best to protect your personal data, we cannot guarantee the security of your data which is transmitted to or from the Service. Any transmission is at your own risk.</li>\r\n		<li>We keep your personal information for no longer than is necessary for our business purposes or for legal requirements.</li>\r\n	</ol>\r\n	</li>\r\n	<li>\r\n	<h2>AMENDMENTS TO THE PRIVACY POLICY</h2>\r\n\r\n	<p>Gradeup may amend the Privacy Policy posted on the Website from time to time at its sole discretion. Your continued access or use of the Platform or Services constitute your acceptance of the amendments. Your access and use of the Platform and Services will be subject to the most current version of the Terms of Use, rules and guidelines posted on the Website at the time of such use. Please regularly check the link on the home page to view the most current Privacy Policy.</p>\r\n	</li>\r\n	<li>\r\n	<h2>CONTACT US</h2>\r\n\r\n	<p>If you have any questions or concerns regarding this Privacy Policy, kindly contact us at:<a href=\"mailto:admin@gradeup.co\">&nbsp;contact@gradeup.co</a></p>\r\n	</li>\r\n</ol>', '<pre>\r\nगोपनीयता नीति\r\nसूचना प्रौद्योगिकी अधिनियम, 2000 (&quot;आईटी अधिनियम&quot;), सूचना प्रौद्योगिकी (मध्यस्थ दिशानिर्देश) नियम, 2011, सूचना प्रौद्योगिकी (उचित सुरक्षा प्रथाओं और प्रक्रियाओं और संवेदनशील व्यक्तिगत डेटा या सूचना के प्रावधानों के अनुसार निम्नलिखित गोपनीयता नीति प्रकाशित की जा रही है ) नियम, 2011\r\n\r\nपरिचय\r\nयह जानकारी गोपनीयता की जानकारी, संग्रह, भंडारण, उपयोग और आपकी जानकारी के संरक्षण के संबंध में, ग्रेडअप की वेबसाइट की नीति (बाद में &quot;वेबसाइट&quot; के रूप में संदर्भित है) और ग्रेडअप के मोबाइल एप्लिकेशन (बाद में &quot;ऐप&quot; के रूप में संदर्भित) की नीति बताती है पाठ्यक्रम के दौरान वेबसाइट और ऐप के साथ आपकी बातचीत\r\n\r\nकृपया इस गोपनीयता नीति को सावधानी से और उपयोग की शर्तों के साथ पढ़ें। यदि आप इस नीति को समझ नहीं पाते हैं, या इसके किसी भी भाग को स्वीकार नहीं करते हैं, तो आपको प्लेटफ़ॉर्म का उपयोग नहीं करना चाहिए, जैसा कि मामला हो। आपका उपयोग और / या प्लेटफ़ॉर्म का निरंतर उपयोग, जैसा कि मामला इस गोपनीयता नीति के नियमों के साथ-साथ उपयोग की शर्तों के लिए एक स्पष्ट सहमति के बराबर हो सकता है।\r\n\r\nइस नीति के प्रयोजनों के लिए, वेबसाइट और ऐप को किसी भी अध्ययन सामग्री के साथ मिलकर उपलब्ध है या उसमें अपलोड किया गया है या डाउनलोड किया गया है, वहां से एम्बेडेड सामूहिक रूप से &quot;सेवाएं&quot; के रूप में संदर्भित किया जाएगा। वेबसाइट और ऐप को सामूहिक रूप से &quot;मंच&quot; के रूप में जाना जाएगा</pre>\r\n', '2018-03-14 04:00:00', '2018-03-14 13:14:57');

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
  `en_contact_us` longtext NOT NULL,
  `en_meta_tags` varchar(255) NOT NULL,
  `hi_copyright` longtext CHARACTER SET utf8,
  `hi_contact_us` longtext CHARACTER SET utf8,
  `hi_meta_tags` longtext CHARACTER SET utf8,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `en_site_title`, `hi_site_title`, `logo`, `favicon`, `en_copyright`, `en_contact_us`, `en_meta_tags`, `hi_copyright`, `hi_contact_us`, `hi_meta_tags`, `created_at`, `updated_at`) VALUES
(1, 'online test', 'ऑनलाइन टेस्ट', 'download.png', 'logo_trb_final72.jpg', '<p>Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Donec sollicitudin molestie malesuada. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Nulla quis lorem ut libero malesuada feugiat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porttitor lectus nibh. Donec sollicitudin molestie malesuada. Nulla quis lorem ut libero malesuada feugiat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.gaurav</p>\r\n', '<p>Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Donec sollicitudin molestie malesuada. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Nulla quis lorem ut libero malesuada feugiat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porttitor lectus nibh. Donec sollicitudin molestie malesuada. Nulla quis lorem ut libero malesuada feugiat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.</p>\r\n', 'test', '<pre>\r\nक्यूबाटुर आर्क, उस पर हस्ताक्षर किए गए थे किसी भी प्रकार के लिए, यह मात्रा के लिए मूल्य के रूप में, के लिए तत्व आईडी। डोनिक सोल्लिटिडिन मोलिस्टी नरसुदा एक सपिया मस्तिष्क के लिए, एक पिल्लेसेक नसीब पर आपत्ति नहीं है, कभी भी नहीं। किसी भी तरह से मुफ्त में पुरुषों की मेजबानी के लिए तैयार हो जाओ। इस वेबसाइट पर विज्ञापन दें, कृपया हमसे संपर्क करें एसडी पोर्टेटर लिक्टस निभ डोनिक सोल्लिटिडिन मोलिस्टी नरसुदा किसी भी तरह से मुफ्त में पुरुषों की मेजबानी के लिए तैयार हो जाओ। गर्भवती महिलाओं और महिलाओं के लिए सबसे पहले कुर्सियों की कवच ​​में प्रयुक्त; किसी भी तरह से, किसी भी व्यक्ति या किसी भी व्यक्ति के लिए,</pre>\r\n', '<p>क्यूबाटुर आर्क, उस पर हस्ताक्षर किए गए थे किसी भी प्रकार के लिए, यह मात्रा के लिए मूल्य के रूप में, के लिए तत्व आईडी। डोनिक सोल्लिटिडिन मोलिस्टी नरसुदा एक सपिया मस्तिष्क के लिए, एक पिल्लेसेक नसीब पर आपत्ति नहीं है, कभी भी नहीं। किसी भी तरह से मुफ्त में पुरुषों की मेजबानी के लिए तैयार हो जाओ। इस वेबसाइट पर विज्ञापन दें, कृपया हमसे संपर्क करें एसडी पोर्टेटर लिक्टस निभ डोनिक सोल्लिटिडिन मोलिस्टी नरसुदा किसी भी तरह से मुफ्त में पुरुषों की मेजबानी के लिए तैयार हो जाओ। गर्भवती महिलाओं और महिलाओं के लिए सबसे पहले कुर्सियों की कवच ​​में प्रयुक्त; किसी भी तरह से, किसी भी व्यक्ति या किसी भी व्यक्ति के लिए,</p>\r\n', 'परीक्षा', '2018-03-14 08:18:09', '2018-03-14 11:21:42');

-- --------------------------------------------------------

--
-- Table structure for table `terms_conditions`
--

CREATE TABLE `terms_conditions` (
  `id` int(11) NOT NULL,
  `en_terms` longtext,
  `hi_terms` longtext CHARACTER SET utf8mb4 NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terms_conditions`
--

INSERT INTO `terms_conditions` (`id`, `en_terms`, `hi_terms`, `created_at`, `updated_at`) VALUES
(1, '<h1>TERMS OF USE</h1>\r\n\r\n<p>The present Terms of Use document is being published in accordance with the provisions of the Information Technology Act, 2000 and other applicable Rules thereunder, including but not limited to the Information Technology (Intermediary Guidelines) Rules, 2011.</p>\r\n\r\n<p>Welcome to the Gradeup website<strong>&nbsp;(&quot;the Website&quot;)</strong>and/ or Gradeup mobile app<strong>&nbsp;(&quot;the App&quot;).</strong>The Website and the App are owned and provided to you by Grade Stack Learning Pvt. Ltd., having its registered office at A-25, Panchwati, New Delhi- 110033. The Website and the App shall hereinafter be collectively referred to as<strong>&nbsp;&quot;the Platform&quot;.</strong>For the purposes of this Terms of Use, accessing of the Platform together with any study material made available or uploaded therein or downloaded, embedded therefrom shall hereinafter be collectively be referred to as the<strong>&quot;Services&quot;.</strong></p>\r\n\r\n<h2>INTRODUCTION</h2>\r\n\r\n<p>By using or accessing the Platform in any way, including registering on the Platform, using, viewing, sharing, embedding and/or downloading any Services, you agree to be bound by the Terms of Use set forth herein. By accepting these Terms of Use, you also accept and agree to be bound by Gradeup Policies, including but not limited to the Gradeup Privacy Policy and the Gradeup Copyright Policy.</p>\r\n\r\n<p>If you do not understand the present Terms of Use or do not agree with/accept any part thereof, you should immediately discontinue using or accessing the Platform. Your use and/or continued use of the Platform, as the case may be, amounts to an express consent by you to the terms of this Terms of Use as well as other Gradeup Policies.</p>\r\n\r\n<h2>ELIGIBILITY</h2>\r\n\r\n<p>By agreeing to these Terms of Use, you represent that you are legally competent to enter into an agreement and provide consent to these Terms of Use. You further represent that</p>\r\n\r\n<ol style=\"list-style-type:lower-roman\">\r\n	<li>You are of sound mind.</li>\r\n	<li>Have attained the legal age necessary under the applicable laws to enter into an agreement and/or access, avail the Services and.</li>\r\n	<li>Are not prohibited from entering into a legally binding contract as per applicable laws.</li>\r\n</ol>\r\n\r\n<p>In case the Platform is being accessed and the Services are being availed for the benefit of a minor, you expressly confirm that you are legally competent to provide consent on behalf of such a minor and that the minor&rsquo;s use of the Platform and/or the Services shall be subject to the Terms of Use.</p>\r\n\r\n<h2>YOUR ACCOUNT</h2>\r\n\r\n<p>You can become a registered user of the Platform by setting up a password protected account with us. In order to set up such an account, you will be required to enter details of your registered email id and password or you may login using the account details of any partner website. By setting up the account, you agree to accept any and all responsibility for any and all activities that occur under your account.&nbsp;By setting up the account, you further agree to the contents of the Privacy Policy.</p>\r\n\r\n<p>Gradeup reserves the right and sole discretion to refuse access to the Platform, terminate any account, remove or restrict any content, at any time, with or without notice to you in case we notice any illegal activity on or from account or if we have reasons to believe that any information provided by you is untrue, inaccurate, outdated or incomplete.</p>\r\n\r\n<h2>USER CONTENT</h2>\r\n\r\n<p>Gradeup provides its users the option of creating posts and/or upload content on the Platform<strong>(&quot;User Content&quot;).</strong>When you submit or upload any content on the Platform you represent and warrant that:</p>\r\n\r\n<ul>\r\n	<li>You own all copyright in the content, or if you are not the owner, that you have permission to use the content, and that you have all the rights and permissions necessary to permit uploading, displaying, sharing, reproduction, downloading, transmission of such content.</li>\r\n	<li>The content you upload will not infringe the intellectual property rights or other rights of any person or entity, including but not limited to copyright, moral rights, trade mark, patent or rights of privacy or publicity.</li>\r\n	<li>Your use of the Platform will comply with all applicable laws, rules and regulations.</li>\r\n	<li>The content does not contain material that defames or vilifies any person, people, races, religion or religious group and is not obscene, pornographic, indecent, harassing, threatening, harmful, invasive of privacy or publicity rights, abusive, inflammatory or otherwise objectionable.</li>\r\n	<li>The content is not misleading and deceptive and does not offer or disseminate fraudulent goods, services, schemes, or promotions.</li>\r\n</ul>\r\n\r\n<p>Gradeup reserves the right to review such content uploaded by the user and in case any content is found to be violation of any of the Terms of Use and/or any applicable laws, Gradeup may remove any content from the Platform and/or terminate or suspend the user account in its sole discretion.</p>\r\n\r\n<h2>RESTRICTION AND TERMINATION OF USE</h2>\r\n\r\n<p>Gradeup may block, restrict, disable, suspend or terminate your access to all or part of the free Services offered on the Platform, at any time in Gradeup&#39;s sole discretion, without prior notice to you upon Gradeup. Specifically, in case of prolonged inactivity, Gradeup reserves the right to disable, deactivate or terminate a user&#39;s account. If an account has been disabled or deactivated for inactivity, the user name associated with that account may be given to another user without notice to you or such other party. If you violate the Terms of Use, Gradeup may at its sole discretion, block, restrict, disable, suspend or terminate the paid Services offered on the Platform.</p>\r\n\r\n<h2>INTELLECTUAL PROPERTY</h2>\r\n\r\n<p>The Services, including but not limited to digital content on the website&nbsp;i.e. text, graphics, user interface, images, video interface and software as well as their selection and arrangement, may belong to Gradeup or to its partners who have granted Gradeup the right to use their content and are protected to the fullest extent possible by applicable laws related to copyrights, trademarks, trade secrets and all other intellectual property and proprietary rights (collectively,<strong>&nbsp;&quot;Intellectual Property Rights&quot;</strong>). Any unauthorized use of the Services may violate such laws and the Terms of Use. Gradeup reserves all its legal rights to prohibit, stop or contain any such violations.</p>\r\n\r\n<p>You agree not to copy, republish, frame, download, transmit, modify, adapt, create derivative works based on, rent, lease, loan, sell, assign, distribute, display, perform, license, sublicense or reverse engineer the Platform and Services or any parts thereof or the selection and arrangement of the Platform and Services, except as expressly authorized herein. Gradeup grants you a non-exclusive, non-transferable, limited permission to access and display the web pages within this Platform, solely on your computer or any other electronic viewing device for your personal, non-commercial use of this Platform. This permission is conditional on the basis that you shall not modify, alter or illegally use the content displayed on this Platform and shall keep intact and comply with all copyright, trademark, and other proprietary notices of the Platform, if any. The rights granted to you constitute a license and not a transfer of title in any manner.</p>\r\n\r\n<p>Use of the Platform or Services for any other purpose other than expressly granted hereunder is expressly prohibited and may result in severe civil and criminal penalties.</p>\r\n\r\n<p>In relation to any content submitted, uploaded or generated by you on the Platform, you hereby grant an unconditional, unlimited, perpetual, royalty-free, worldwide license and permission to Gradeup and its affiliates, content sharing partners to display, store, host, publish, digitally reproduce or copy, transmit, communicate, modify, translate, distribute or otherwise make such content available on the Platform or in relation to the Services provided by Gradeup. You agree that such content may continue to be made available on Gradeup despite any termination or suspension of your account, if such content has been shared, stored or embedded by any other user(s). You agree to not hold Gradeup responsible for the aforesaid activities in relation to your content.</p>\r\n\r\n<h2>ADVERTISEMENTS AND PROMOTIONS</h2>\r\n\r\n<p>This Platform may run advertisements and promotions from third parties, products and/or services in any manner and to any extent. Your communications, activities, relationships and business dealings with any third parties advertising or promoting via the Platform, including payment and delivery of related goods or services, and any other terms, conditions, warranties or representations associated with such dealings, shall be solely matters between you and such third parties.</p>\r\n\r\n<p>You acknowledge and agree that Gradeup is not responsible or liable for any loss or damage of any kind incurred as the result of any such dealings or as the result of the presence of such non-Gradeup advertisers on the Platform.</p>\r\n\r\n<p>Our links with advertisers should not be construed as an endorsement, approval or recommendation by us of the owners or operators of those linked websites, or of any information, graphics, materials, products or services referred to or contained on those linked websites, unless and to the extent stipulated to the contrary.</p>\r\n\r\n<h2>LINKS TO THIRD PARTY WEBSITES</h2>\r\n\r\n<p>The Platform may include links that redirect you to other websites. These third party websites are not covered by the Terms of Use. You agree that once you leave our servers, any third party websites that you go to or interact with are at your own risk. Gradeup shall not be held liable for any default, loss of function or any risk or consequence that you may be exposed to as a result of the same.</p>\r\n\r\n<h2>SPAM E-MAIL AND POSTINGS</h2>\r\n\r\n<p>In the event your access or use of the Platform and Services is found to be spammy, misleading, malicious, annoying or containing/promoting unsolicited e-mails or network postings, Gradeup reserves its right to obtain immediate injunctive reliefs against you or against such use by you, in addition to all other remedies available at law or in equity. Gradeup may also opt to block, filter or delete unsolicited e-mail, messages or postings as per its sole discretion.</p>\r\n\r\n<h2>INDEMNITY</h2>\r\n\r\n<p>You agree to indemnify, defend and hold Gradeup and its officers, directors, partners, employees, agents and representatives harmless, from and against any and all claims, damages, losses, liabilities, costs (including reasonable legal fees) or other expenses that arise directly or indirectly out of or from</p>\r\n\r\n<ol style=\"list-style-type:lower-roman\">\r\n	<li>Your user content and any other content (e.g. computer viruses) that you may submit, post to or transmit through the Platform (including a third party&#39;s use of such user content (e.g. reliance on the accuracy, completeness or usefulness of your user content).</li>\r\n	<li>Your access to or use of the Platform and Services (including any use by your employees, contractors or agents and all uses of your account numbers, user names and passwords, whether or not actually or expressly authorised by you, in connection with the Platform and Services).</li>\r\n	<li>Your breach of any clause of the Terms of Use.</li>\r\n	<li>Any allegation that while using any of the software made available on the Platform you infringe or otherwise violate the copyright, trademark, trade secret or other intellectual property or other rights of any third party and/or any dealings between you and any third parties advertising or promoting or linked via the Platform.</li>\r\n	<li>Your activities in connection with the Platform.</li>\r\n</ol>\r\n\r\n<p>This indemnity will be applicable without regard to the negligence of any party, including any indemnified person.</p>\r\n\r\n<h2>DISCLAIMER</h2>\r\n\r\n<p>We do not represent or guarantee that this Platform will be free from errors or viruses. You acknowledge that this Website may be affected by outages, faults or delays. Such outages, faults or delays may be caused by factors, including technical difficulties with the performance or operation of our or another person&rsquo;s software, equipment or systems, traffic or technical difficulties with the Internet or infrastructure failures.</p>\r\n\r\n<p>We do not accept responsibility for any loss or damage, however caused (including through negligence), that you may directly or indirectly suffer in connection with your use of this Platform, nor do we accept any responsibility for any such loss arising out of your use of or reliance on information contained on or accessed through this Platform.</p>\r\n\r\n<h2>PRIVACY POLICY</h2>\r\n\r\n<p>Your privacy is very important to us. Users of our Platform should refer to our<a href=\"https://gradeup.co/privacy-policy\" target=\"_blank\">&nbsp;Privacy Policy</a>, which is incorporated into this Terms of Use by reference, with respect to the disclosure, collection, storage, usage and protection of your information during the course your interaction with the Platform.</p>\r\n\r\n<h2>COPYRIGHT POLICY</h2>\r\n\r\n<p>Gradeup respects and recognize the intellectual property rights of others and expects users of Gradeup to do the same. Users of our Platform should refer to our<a href=\"https://gradeup.co/copyright-policy\" target=\"_blank\">&nbsp;Copyright Policy</a>, which is incorporated into this Terms of Use by reference. If you believe that your content has been used on Gradeup in a way that constitutes an infringement of your copyright, please notify Gradeup&rsquo;s designated agent for complaints or approach us through the procedure set out under the applicable provisions of the Information Technology Act. If you have a good faith belief that your copyright has been infringed by any of our users, you may follow the process as specified in our Copyright Policy.</p>\r\n\r\n<h2>CANCELLATIONS &amp; REFUND POLICY</h2>\r\n\r\n<p>Cancellations: As a general rule, all sales made on Gradeup are final and you shall not be entitled to cancel your order once you have received confirmation of the same. Gradeup reserves the sole right to cancel any order as per our discretion in case (i) we are unable to deliver the order in a satisfactory manner and/ or (ii) the user tries to take advantage of the system which violates the Terms of Use. Gradeup will ensure that any communication of cancellation of an order or any applicable refund will be made within a reasonable period of time.</p>\r\n\r\n<p>Refunds: You shall be entitled to a refund only if Gradeup is unable to deliver your order in an adequate manner. All refunds will be processed on a pro-rated basis, depending on the service already delivered by Gradeup. Refunds will be done directly to the original payment mode within seven days of finalization of claim.</p>\r\n\r\n<h2>AMENDMENTS TO THE TERMS AND CONDITIONS</h2>\r\n\r\n<p>Gradeup may amend the Terms of Use and other Gradeup Policies published on the Platform from time to time at its sole discretion. Your continued access or use of the Platform and Services constitutes your acceptance of the amendments. Your access and use of the Platform and Services will be subject to the most current version of the Terms of Use, Privacy Policy and Copyright Policy posted on the Platform at the time of such use. Please regularly check the Platform to view the latest version of Gradeup Policies.</p>\r\n\r\n<h2>APPLICABLE LAW AND JURISDICTION</h2>\r\n\r\n<p>Terms of Use shall be governed by and construed in accordance with the Laws of India. In case of any disputes the courts in Delhi will have exclusive jurisdiction to try any such disputes to the exclusion of all other courts.</p>', '<p>उपयोग की शर्तें सूचना प्रौद्योगिकी अधिनियम, 2000 के प्रावधानों और इसके तहत लागू होने वाले अन्य लागू नियमों के अनुसार, सूचना प्रौद्योगिकी (मध्यस्थता दिशानिर्देश) नियम, 2011 तक सीमित नहीं बल्कि इन तक सीमित नहीं है। ग्रेडअप वेबसाइट (&quot;वेबसाइट&quot;) और / या ग्रेडअप मोबाइल ऐप (&quot;ऐप&quot;) में आपका स्वागत है। वेबसाइट और ऐप का स्वामित्व और ग्रेड स्टैक लर्निंग प्राइवेट द्वारा आपको प्रदान किया जाता है। लिमिटेड, इसका पंजीकृत कार्यालय ए -5, पंचविती, नई दिल्ली -110033 में है। वेबसाइट और ऐप को बाद में सामूहिक रूप से &quot;प्लेटफार्म&quot; के रूप में जाना जाएगा। उपयोग की शर्तों के प्रयोजनों के लिए, प्लेटफार्म को एक साथ मिलना किसी भी अध्ययन सामग्री के साथ जो उसमें उपलब्ध या अपलोड किया गया था या डाउनलोड किया गया था, वहां से एम्बेडेड होने के बाद उसके बाद सामूहिक रूप से &quot;सेवाएं&quot; कहा जाएगा। परिचय प्लेटफार्म पर पंजीकरण करने, देखने, देखने, साझा करने, एम्बेड करने और / या किसी भी सेवा को डाउनलोड करने सहित किसी भी तरह से प्लेटफॉर्म का उपयोग या एक्सेस करने से, आप यहां दिए गए उपयोग की शर्तों से बाध्य होने के लिए सहमत हैं। इन नियमों की शर्तों को स्वीकार करके, आप ग्रेडअप नीतियों और ग्रेडअप कॉपीराइट नीति तक सीमित नहीं बल्कि इसमें ग्रेडअप नीतियों से बाध्य होने के लिए भी स्वीकार करते हैं और सहमत होते हैं।<br />\r\n&nbsp;</p>\r\n', '0000-00-00 00:00:00', '2018-03-14 13:20:20');

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
(2, 'admin', 'admin', '02/02/2018', 'male', 'a+', '05-755766569.jpg', 'admin', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '7828759804', '9699996116', 'indore', 1, NULL, 1, '2018-01-25 04:01:40', '2018-01-25 04:01:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privacy_policy`
--
ALTER TABLE `privacy_policy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `terms_conditions`
--
ALTER TABLE `terms_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `privacy_policy`
--
ALTER TABLE `privacy_policy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `terms_conditions`
--
ALTER TABLE `terms_conditions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
