-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2019 at 03:22 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `your_radio_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `user_role` enum('100','101','102') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `email`, `full_name`, `user_role`) VALUES
(1, 'admin', 'd82494f05d6917ba02f7aaa29689ccb444bb73f20380876cb05d1f37537b7892', 'help.solodroid@gmail.com', 'Administrator', '100');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cid` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cid`, `category_name`, `category_image`) VALUES
(4, 'Misc', '1190-2018-04-23.png'),
(5, 'Culture', '6563-2015-11-15.png'),
(7, 'Education', '8649-2015-11-15.png'),
(8, 'Newscast', '2215-2015-11-15.png'),
(9, 'World', '5837-2018-05-27.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fcm_template`
--

CREATE TABLE `tbl_fcm_template` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT 'Notification',
  `link` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_fcm_template`
--

INSERT INTO `tbl_fcm_template` (`id`, `message`, `image`, `title`, `link`) VALUES
(28, 'Hello World, This is Your Radio App, you can purchase it on Codecanyon officially.', '7843-2017-04-11.jpg', 'Your Radio App', ''),
(30, 'New updated version available now on Codecanyon!', '7801-2018-12-26.jpg', 'Your Radio App', 'https://codecanyon.net/item/your-radio-app/13706746');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fcm_token`
--

CREATE TABLE `tbl_fcm_token` (
  `id` int(11) NOT NULL,
  `user_android_token` varchar(255) NOT NULL,
  `app_version` varchar(255) NOT NULL,
  `os_version` varchar(255) NOT NULL,
  `device_model` varchar(255) NOT NULL,
  `device_manufacturer` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_code`
--

CREATE TABLE `tbl_purchase_code` (
  `id` int(11) NOT NULL,
  `item_purchase_code` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_radio`
--

CREATE TABLE `tbl_radio` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `radio_name` varchar(255) NOT NULL,
  `radio_image` varchar(255) NOT NULL,
  `radio_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_radio`
--

INSERT INTO `tbl_radio` (`id`, `category_id`, `radio_name`, `radio_image`, `radio_url`) VALUES
(22, 9, 'Maestro Bandung FM', '8841-2015-11-15.jpg', 'http://192.99.170.8:5756/'),
(24, 4, 'Radio Jaca', '4548-2015-11-15.jpg', 'http://s6.voscast.com:8824'),
(25, 5, 'Radio Rama', '3757-2015-11-15.jpg', 'http://rama-fm.simaya.net.id:8800/'),
(26, 4, 'Radio Niagara', '5962-2015-11-15.jpg', 'http://s2.voscast.com:7386'),
(29, 7, 'Radio Rodja', '1593-2015-11-15.jpg', 'http://live.radiorodja.com/'),
(30, 8, 'Radio Zelengrad', '8896-2015-11-15.jpg', 'http://188.212.103.121:8000/'),
(31, 9, 'Suara Madu FM', '0253-2015-11-15.jpg', 'http://142.4.217.133:9228/stream'),
(33, 9, 'V Radio FM Jakarta', '7913-2017-11-07.jpg', 'http://193.0.98.66:8005'),
(37, 9, 'Radio 2.0 - Valli di Bergamo', '0894-2019-05-03.jpg', 'http://46.252.154.133:8080');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL,
  `app_fcm_key` text NOT NULL,
  `api_key` varchar(255) NOT NULL,
  `package_name` varchar(500) NOT NULL DEFAULT 'com.app.yourradioapp',
  `onesignal_app_id` varchar(500) NOT NULL DEFAULT '0',
  `onesignal_rest_api_key` varchar(500) NOT NULL DEFAULT '0',
  `protocol_type` varchar(10) NOT NULL DEFAULT 'http://',
  `privacy_policy` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `app_fcm_key`, `api_key`, `package_name`, `onesignal_app_id`, `onesignal_rest_api_key`, `protocol_type`, `privacy_policy`) VALUES
(1, '0', 'cda11lHY0ZafN2nrti4U5QAKMDhTw7Czm1xoSsyVLduvRegkqE', 'com.app.yourradioapp', '0', '0', 'http://', '<p>This privacy policy includes all the details about the data collected in Your Radio App and how it&rsquo;s used.</p>\r\n\r\n<p>As a user we also do not like to give personal informations and we don&rsquo;t want to see our informations collected without knowing what will going to happen to those datas. Your Radio App has been alive with the support and trust of it&rsquo;s users. We want to keep the trust; you can find all the details about the data usage below.</p>\r\n\r\n<p>Your Radio App does collect anonymous usage data. This data does not include your original device identification numbers, your real personality or your personal data if it&rsquo;s not directly given by you in an open form.</p>\r\n\r\n<p>Your Radio App can not access to your real information and your purchases or any other action may not be restored without associating purchases with some information. This is why it is recommended to fill the registration form in the application. That form contains personal information which helps us contact the user easily, help quickly and solve possible licensing problems.</p>\r\n\r\n<p>Usage / interactions in the application are used to determine what stations is being listed at most and which functions attracts the most attention so we can improve those sections. This information also allows us to be able to serve better features like listing most popular stations according to a specific region.</p>\r\n\r\n<p>These datas may be used to serve additional services to 3rd parties like station statistics. NONE of these services will include sensitive information/personally identifying data if not permitted by you.</p>\r\n\r\n<p>In some cases Your Radio App may communicate directly with a 3rd party server to obtain latest data for display within the app (such as rss feeds, artist/song images and informations) . When this happens &ndash; we don&rsquo;t transmit any data about you or your usage to these 3rd parties except where explicitly stated. Please check these 3rd parties (where applicable) for their additional privacy policies.</p>\r\n\r\n<p>Advertising Banner Privacy Policy</p>\r\n\r\n<p>Your Radio App may display advertisements on various places in the application. This system may use and transmit basic regional/language information about you to the advertising banner system in order to provide you with relevant ads. In some cases, we may have agreements with sponsors and we may hide advertisements in that situation. Eventhough the advertisement may get hidden in that situation, we may provide similar informations to sponsors or 3rd parties.</p>\r\n\r\n<p>3rd Party Content Privacy Policy</p>\r\n\r\n<p>Your Radio App may display live web pages or images from 3rd party sources and in these cases you should read the privacy policies displayed by these websites. We use Google Image Search for some of the images related to now playing info.</p>\r\n\r\n<p>Contact us</p>\r\n\r\n<p>If you have any questions regarding privacy while using the Application, or have questions about our practices, please contact us via email at help.solodroid@gmail.com</p>\r\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `tbl_fcm_template`
--
ALTER TABLE `tbl_fcm_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_fcm_token`
--
ALTER TABLE `tbl_fcm_token`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_android_token` (`user_android_token`);

--
-- Indexes for table `tbl_purchase_code`
--
ALTER TABLE `tbl_purchase_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_radio`
--
ALTER TABLE `tbl_radio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_fcm_template`
--
ALTER TABLE `tbl_fcm_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_fcm_token`
--
ALTER TABLE `tbl_fcm_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchase_code`
--
ALTER TABLE `tbl_purchase_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_radio`
--
ALTER TABLE `tbl_radio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
