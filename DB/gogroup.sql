-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 03, 2019 at 07:05 AM
-- Server version: 5.7.24-0ubuntu0.16.04.1
-- PHP Version: 7.0.32-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gogroup_new`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Get_all_category_data` ()  NO SQL
BEGIN

Select categories.category_title, subcategories.subcategory_title, subcategories2.subcategory_title2, subcategories3.subcategory_title3, subcategories4.subcategory_title4, subcategories5.subcategory_title5  FROM categories LEFT JOIN subcategories ON categories.category_id = subcategories.category_id LEFT JOIN subcategories2 ON subcategories.subcategory_id = subcategories2.subcategory_id LEFT JOIN subcategories3 ON subcategories2.subcategory2_id = subcategories3.subcategory2_id LEFT JOIN subcategories4 ON subcategories3.subcategory3_id = subcategories4.subcategory3_id LEFT JOIN subcategories5 ON subcategories4.subcategory4_id = subcategories5.subcategory4_id ORDER BY categories.category_title;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `advertisement_id` int(11) NOT NULL,
  `advertisement_name` varchar(255) DEFAULT NULL,
  `actual_price` int(11) DEFAULT NULL,
  `offer_price` int(11) DEFAULT NULL,
  `offerfortwo` varchar(15) DEFAULT NULL,
  `offerforx` varchar(15) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `subcategory2_id` int(11) DEFAULT NULL,
  `subcategory3_id` int(11) DEFAULT NULL,
  `subcategory4_id` int(11) DEFAULT NULL,
  `subcategory5_id` int(11) DEFAULT NULL,
  `advertisement_details` text,
  `HistoryOfChange` varchar(255) DEFAULT NULL,
  `user_count` int(11) DEFAULT NULL,
  `min_user_count` int(11) NOT NULL,
  `location` varchar(200) DEFAULT NULL,
  `quantity_per_user` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `createdby_userid` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `is_approved` int(11) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`advertisement_id`, `advertisement_name`, `actual_price`, `offer_price`, `offerfortwo`, `category_id`, `subcategory_id`, `subcategory2_id`, `subcategory3_id`, `subcategory4_id`, `subcategory5_id`, `advertisement_details`, `HistoryOfChange`, `user_count`, `min_user_count`, `location`, `start_date`, `end_date`, `createdby_userid`, `status`, `is_approved`, `created_by`, `created_date`, `modify_date`) VALUES
(1, 'Dwarka add', 70001, 411, '258', 4, 7, 0, 0, 0, 0, '30% of on possession.    ', 'Prevoious End date was2023-08-20', NULL, 301, 'Dwarka, Gujarat, India', '2018-04-05', '2023-08-20', 1, 'unapproved', 0, 1, '2018-01-18 10:14:58', '2019-01-03 07:04:27'),
(2, 'weekend offer', 7000, 4100, NULL, 1, 4, NULL, NULL, NULL, NULL, 'Available discount for 2/3 BHK flats near NH8. offer ending soon', NULL, NULL, 0, 'Gurgaon, Haryana, India', '2018-04-26', '2018-10-26', 9, 'approved', 1, 9, '2018-01-21 05:30:18', '2018-08-18 05:13:04'),
(3, NULL, 7000, 4100, NULL, 3, 5, NULL, NULL, NULL, NULL, 'discounts on 3 or more buyres buying cars', NULL, NULL, 0, 'Noida, Uttar Pradesh, India', '2018-01-26', '2018-01-31', 16, 'expired', 0, 16, '2018-01-26 07:13:34', '2018-08-18 05:13:04'),
(4, NULL, 7000, 4100, NULL, 4, 7, NULL, NULL, NULL, NULL, 'CCNA training - deals for bulk booking with atleast 3 people', 'Prevoious End date was2018-02-28', NULL, 0, 'Lucknow, Uttar Pradesh, India', '2018-01-31', '2018-05-30', 9, 'expired', 0, 9, '2018-01-27 17:45:37', '2018-08-18 05:13:04'),
(5, 'Kanpur Deal', 7000, 4100, NULL, 1, 2, 0, 0, 0, 0, 'test', 'Prevoious End date was2021-08-20', NULL, 58, 'Kanpur, Uttar Pradesh, India', '2018-01-29', '2021-08-20', 1, 'approved', 1, 1, '2018-01-29 10:47:08', '2018-10-12 07:48:13'),
(6, NULL, 7000, 4100, NULL, 3, 5, NULL, NULL, NULL, NULL, '20 percent off for a group of 4', NULL, NULL, 0, 'Malibu Town, Gurugram, Haryana, India', '2018-02-01', '2018-02-15', 20, 'expired', 0, 20, '2018-01-29 10:49:12', '2018-08-18 05:13:04'),
(7, NULL, 7000, 4100, NULL, 3, 5, 0, 0, 0, 0, 'testing. deals for honda jazz', 'Prevoious End date was2018-02-17', NULL, 0, 'Kanpur Central, Kanpur, Uttar Pradesh, India', '2018-01-29', '2018-05-27', 9, 'expired', 0, 9, '2018-01-29 10:57:09', '2018-08-18 05:13:04'),
(8, 'Offer Price Avl', 7000, 4100, NULL, 3, 0, 0, 0, 0, 0, 'gh', 'Prevoious End date was2018-01-29', NULL, 0, 'test', '2018-01-29', '2021-08-20', 1, 'approved', 1, 1, '2018-01-29 11:03:02', '2018-08-20 06:58:12'),
(9, 'Mobile Sale', 7000, 4100, NULL, 6, 0, 0, 0, 0, 0, 'test', 'Prevoious End date was2018-05-31', NULL, 2, 'Kolkata, West Bengal, India', '2018-05-09', '2021-08-20', 1, 'approved', 1, 1, '2018-01-29 11:03:45', '2018-08-20 06:58:22'),
(10, NULL, 7000, 4100, NULL, 1, 4, NULL, NULL, NULL, NULL, '10% discount on base price for three flats.', NULL, NULL, 0, 'Indore, Madhya Pradesh, India', '2018-01-31', '2018-02-06', 16, 'expired', 0, 16, '2018-01-30 02:52:33', '2018-08-18 05:13:04'),
(11, NULL, 7000, 4100, NULL, 4, 8, 0, 0, 0, 0, 'test12345', 'Prevoious End date was2018-05-31', NULL, 5, 'Gorakhpur, Uttar Pradesh, India', '2018-02-04', '2018-05-31', 9, 'expired', 0, 9, '2018-02-02 07:04:15', '2018-08-18 05:13:04'),
(12, 'Property yes1', 7000, 4100, NULL, 1, 2, 0, 0, 0, 0, 'detakjislsa lak', 'Prevoious End date was2022-08-20', NULL, 3, 'Dugri, Ludhiana, Punjab, India', '2018-02-05', '2022-08-20', 1, 'rejected', 0, 1, '2018-02-05 11:44:20', '2018-10-12 05:27:44'),
(13, 'Dugri Zabius1', 7000, 4100, NULL, 1, 4, 0, 0, 0, 0, 'test', 'Prevoious End date was2021-08-20', NULL, 395, 'Ludhiana, Punjab, India', '2018-02-06', '2021-08-20', 1, 'approved', 1, 1, '2018-02-06 10:41:48', '2018-10-12 07:41:09'),
(14, NULL, 7000, 4100, NULL, 2, 1, NULL, NULL, NULL, NULL, 'HTC one offer - 20% discount for 3 or nore users', 'Prevoious End date was2018-02-19', NULL, 3, 'Noida, Uttar Pradesh, India', '2018-02-17', '2018-02-17', 16, 'expired', 0, 16, '2018-02-17 16:22:10', '2018-08-18 05:13:04'),
(15, NULL, 7000, 4100, NULL, 4, 9, 0, 0, 0, 0, 'testing for UAT .', 'Prevoious End date was2018-02-17', NULL, 3, 'Gorakhpur, Uttar Pradesh, India', '2018-02-17', '2018-03-26', 9, 'expired', 0, 9, '2018-02-17 16:23:04', '2018-08-18 05:13:04'),
(16, NULL, 7000, 4100, NULL, 2, 0, 0, 0, 0, 0, 'detail', 'Prevoious End date was2018-03-30', NULL, 30, 'Ludhiana, Punjab, India', '2018-03-20', '2018-03-30', 1, 'expired', 0, 1, '2018-03-20 06:15:03', '2018-08-18 05:13:04'),
(17, 'Propert buy', 7000, 4100, NULL, 1, 2, NULL, NULL, NULL, NULL, 'discount upto 2 lac for more than two buyers', NULL, NULL, 2, 'Noida, Uttar Pradesh, India', '2018-03-01', '2018-08-31', 16, 'expired', 0, 16, '2018-03-25 13:28:58', '2018-09-24 09:01:25'),
(18, NULL, 7000, 4100, NULL, 1, 2, NULL, NULL, NULL, NULL, 'gujgt', NULL, NULL, 25, 'Ludhiana, Punjab, India', '2018-03-26', '2018-03-31', 1, 'expired', 0, 1, '2018-03-26 05:22:07', '2018-08-18 05:13:04'),
(19, NULL, 7000, 4100, NULL, 2, 1, NULL, NULL, NULL, NULL, 'testing', NULL, NULL, 5, 'Gurgaon, Haryana, India', '2018-03-26', '2018-03-29', 9, 'expired', 0, 9, '2018-03-26 09:49:44', '2018-08-18 05:13:04'),
(20, NULL, 7000, 4100, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2bhk in Gaur city, greater Noida, additional discount for group booking.', NULL, NULL, 2, 'Noida, Uttar Pradesh, India', '2018-05-22', '2018-05-31', 16, 'expired', 0, 16, '2018-05-22 07:49:02', '2018-08-18 05:13:04'),
(21, 'condi', 7000, 4100, NULL, 2, 1, 0, 0, 0, 0, 'pawan test', 'Prevoious End date was2018-07-20', NULL, 1818, 'Ludhiana, Punjab, India', '2018-05-31', '2018-07-20', 1, 'expired', 0, 1, '2018-05-30 11:39:44', '2018-09-24 09:01:25'),
(22, 'Elecronic deals', 7000, 4100, NULL, 2, 1, 0, 0, 0, 0, 'delcelc sssss', 'Prevoious End date was2020-08-20', NULL, 1313, 'Delhi, India', '2018-05-31', '2020-08-20', 1, 'rejected', 0, 1, '2018-05-30 11:40:38', '2018-10-12 07:43:59'),
(23, 'new deal', 7000, 4100, NULL, 4, 8, 0, 0, 0, 0, 'jd sjs sisvsbj', 'Prevoious End date was2018-07-26', NULL, 1616, 'Mumbai, Maharashtra, India', '2018-05-30', '2018-07-26', 1, 'expired', 0, 1, '2018-05-30 11:41:35', '2018-08-18 05:13:04'),
(24, NULL, 7000, 4100, NULL, 4, 8, NULL, NULL, NULL, NULL, 'jd sjs sisvsbj', NULL, NULL, 1616, 'Mumbai, Maharashtra, India', '2018-05-30', '2018-07-26', 1, 'expired', 0, 1, '2018-05-30 11:41:58', '2018-08-18 05:13:04'),
(25, 'My First Deal Updated', 7000, 4100, NULL, 3, 0, 0, 0, 0, 0, 'THis is deal Detail', 'Prevoious End date was2018-06-21', NULL, 25, 'Asheville, NC, USA', '2018-06-06', '2018-06-21', 1, 'expired', 0, 1, '2018-06-06 05:08:00', '2018-08-18 05:13:04'),
(26, 'CCNA training for 5 pers', 7000, 4100, NULL, 4, 8, NULL, NULL, NULL, NULL, 'Once minimum 5 persons will join, the discount will be 10%', NULL, NULL, 5, 'Gurgaon, Haryana, India', '2018-06-08', '2018-06-15', 9, 'expired', 0, 9, '2018-06-08 17:22:37', '2018-08-18 05:13:04'),
(27, 'MRI scan', 7000, 4100, NULL, 5, NULL, NULL, NULL, NULL, NULL, 'attractive discounts for people xoming in group', NULL, NULL, 2, 'Noida', '2018-06-21', '2018-06-30', 16, 'expired', 0, 16, '2018-06-20 10:17:26', '2018-08-18 05:13:04'),
(28, 'mri scan in greater noida', 7000, 4100, NULL, 5, NULL, NULL, NULL, NULL, NULL, '20% discount for two or more persons.', NULL, NULL, 2, 'Greater Noida, Uttar Pradesh, India', '2018-06-20', '2018-06-30', 16, 'unapproved', 0, 16, '2018-06-20 10:24:03', '2018-09-27 12:40:18'),
(29, 'New AUG Deal', 7000, 4100, NULL, 1, 2, 0, 0, 0, 0, 'THis is new Deal', 'Prevoious End date was2018-08-24', NULL, 2392, 'Ludhiana, Punjab, India', '2018-08-08', '2021-08-20', 1, 'approved', 1, 1, '2018-08-08 07:45:22', '2018-09-27 13:05:00'),
(30, 'New AUG Deal', 2500000, 2450000, NULL, 1, 2, 0, 0, 0, 0, 'asdasdasdasdasdasd  asd', 'asdasdasdasd   ', NULL, 2, NULL, '2018-08-25', '2018-08-25', 30, 'expired', 0, 30, '2018-08-24 07:35:28', '2018-09-24 09:01:25'),
(31, 'Propert Deals1', 5000001, 4000001, NULL, 1, 2, 0, 0, 0, 0, 'sadasd asdasdasd', 'abcdefgh', NULL, 12, NULL, '2018-08-25', '2018-08-31', 30, 'expired', 0, 30, '2018-08-24 07:46:53', '2018-09-24 09:01:25'),
(32, 'Full HD LED smart TV', 150000, 140000, NULL, 2, NULL, NULL, NULL, NULL, NULL, 'Smart LED 100 cms TV, Full HD, 2 HDMI, 2USB, 20watt speaker,', NULL, NULL, 2, 'Noida, Uttar Pradesh, India', '2018-08-25', '2018-08-31', 16, 'expired', 0, 16, '2018-08-25 03:58:10', '2018-09-24 09:01:25');

-- --------------------------------------------------------

--
-- Table structure for table `advertisements_images`
--

CREATE TABLE `advertisements_images` (
  `image_id` int(11) NOT NULL,
  `advertisement_id` int(11) NOT NULL,
  `image_path` varchar(200) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `advertisements_images`
--

INSERT INTO `advertisements_images` (`image_id`, `advertisement_id`, `image_path`, `created_by`, `created_date`, `modify_date`) VALUES
(1, 1, '15162704980.png', 1, '2018-01-18 10:14:58', '2018-01-18 10:14:58'),
(2, 1, '15162704981.png', 1, '2018-01-18 10:14:58', '2018-01-18 10:14:58'),
(3, 2, '15165126180.jpg', 9, '2018-01-21 05:30:18', '2018-01-21 05:30:18'),
(4, 2, '15165126181.jpg', 9, '2018-01-21 05:30:18', '2018-01-21 05:30:18'),
(5, 3, '15169508140.jpg', 16, '2018-01-26 07:13:34', '2018-01-26 07:13:34'),
(6, 4, '15170751370.jpg', 9, '2018-01-27 17:45:37', '2018-01-27 17:45:37'),
(7, 4, '15170751371.jpg', 9, '2018-01-27 17:45:37', '2018-01-27 17:45:37'),
(8, 4, '15170751372.jpg', 9, '2018-01-27 17:45:37', '2018-01-27 17:45:37'),
(9, 4, '15170751373.jpg', 9, '2018-01-27 17:45:37', '2018-01-27 17:45:37'),
(10, 5, '15172228280.jpg', 1, '2018-01-29 10:47:08', '2018-01-29 10:47:08'),
(11, 6, '15172229520.jpg', 20, '2018-01-29 10:49:12', '2018-01-29 10:49:12'),
(12, 7, '15172234290.jpg', 9, '2018-01-29 10:57:09', '2018-01-29 10:57:09'),
(13, 8, '15172237820.jpg', 1, '2018-01-29 11:03:02', '2018-01-29 11:03:02'),
(14, 9, '15172238250.jpg', 1, '2018-01-29 11:03:45', '2018-01-29 11:03:45'),
(15, 10, '15172807530.jpeg', 16, '2018-01-30 02:52:33', '2018-01-30 02:52:33'),
(16, 11, '15175550550.jpg', 9, '2018-02-02 07:04:15', '2018-02-02 07:04:15'),
(17, 12, '15178310600.jpg', 1, '2018-02-05 11:44:20', '2018-02-05 11:44:20'),
(18, 13, '15179137080.jpg', 1, '2018-02-06 10:41:48', '2018-02-06 10:41:48'),
(19, 13, '15179137081.jpg', 1, '2018-02-06 10:41:48', '2018-02-06 10:41:48'),
(20, 14, '15188845300.jpg', 16, '2018-02-17 16:22:10', '2018-02-17 16:22:10'),
(21, 15, '15188845840.jpg', 9, '2018-02-17 16:23:04', '2018-02-17 16:23:04'),
(22, 15, '15188845841.jpg', 9, '2018-02-17 16:23:04', '2018-02-17 16:23:04'),
(23, 15, '15188845842.jpg', 9, '2018-02-17 16:23:04', '2018-02-17 16:23:04'),
(24, 16, '15215265030.jpg', 1, '2018-03-20 06:15:03', '2018-03-20 06:15:03'),
(25, 17, '15219845380.jpg', 16, '2018-03-25 13:28:58', '2018-03-25 13:28:58'),
(26, 18, '15220417270.jpg', 1, '2018-03-26 05:22:07', '2018-03-26 05:22:07'),
(27, 19, '15220577840.jpg', 9, '2018-03-26 09:49:44', '2018-03-26 09:49:44'),
(28, 20, '15269753420.jpg', 16, '2018-05-22 07:49:02', '2018-05-22 07:49:02'),
(29, 21, '15276803840.jpg', 1, '2018-05-30 11:39:44', '2018-05-30 11:39:44'),
(30, 22, '15276804380.png', 1, '2018-05-30 11:40:38', '2018-05-30 11:40:38'),
(31, 23, '15276804950.jpg', 1, '2018-05-30 11:41:35', '2018-05-30 11:41:35'),
(32, 24, '15276805180.jpg', 1, '2018-05-30 11:41:58', '2018-05-30 11:41:58'),
(33, 25, '15282616800.jpg', 1, '2018-06-06 05:08:00', '2018-06-06 05:08:00'),
(34, 26, '15284785570.jpg', 9, '2018-06-08 17:22:37', '2018-06-08 17:22:37'),
(35, 26, '15284785571.jpg', 9, '2018-06-08 17:22:37', '2018-06-08 17:22:37'),
(36, 26, '15284785572.jpg', 9, '2018-06-08 17:22:37', '2018-06-08 17:22:37'),
(37, 26, '15284785573.jpg', 9, '2018-06-08 17:22:37', '2018-06-08 17:22:37'),
(38, 27, '15294898460.jpg', 16, '2018-06-20 10:17:26', '2018-06-20 10:17:26'),
(39, 28, '15294902430.jpg', 16, '2018-06-20 10:24:03', '2018-06-20 10:24:03'),
(40, 29, '15337143220.jpg', 1, '2018-08-08 07:45:22', '2018-08-08 07:45:22'),
(42, 30, '1535096128favicon.png', 30, '2018-08-24 07:35:28', '2018-08-24 07:35:28'),
(43, 31, '1535096813download.jpg', 30, '2018-08-24 07:46:53', '2018-08-24 07:46:53'),
(44, 31, '1535096813favicon.png', 30, '2018-08-24 07:46:53', '2018-08-24 07:46:53'),
(45, 31, '1535096813green.png', 30, '2018-08-24 07:46:53', '2018-08-24 07:46:53'),
(46, 32, '15351694900.png', 16, '2018-08-25 03:58:10', '2018-08-25 03:58:10');

-- --------------------------------------------------------

--
-- Table structure for table `advertisement_liked`
--

CREATE TABLE `advertisement_liked` (
  `ID` int(11) NOT NULL,
  `advertisement_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `isLiked` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `advertisement_liked`
--

INSERT INTO `advertisement_liked` (`ID`, `advertisement_id`, `buyer_id`, `isLiked`, `created_at`) VALUES
(2, 2, 6, 1, '2018-08-21 12:28:07'),
(3, 12, 6, 0, '2018-08-21 12:32:21'),
(4, 17, 6, 1, '2018-08-21 12:37:53'),
(5, 1, 6, 3, '2018-08-21 12:38:49'),
(6, 22, 6, 1, '2018-08-21 12:48:53'),
(7, 9, 8, 1, '2018-08-22 12:28:09'),
(8, 2, 5, 1, '2018-08-23 09:51:46'),
(9, 17, 5, 1, '2018-08-25 09:15:10'),
(10, 22, 8, 1, '2018-08-25 09:20:12'),
(11, 1, 8, 1, '2018-08-25 09:45:51'),
(12, 22, 14, 1, '2018-09-06 11:53:19'),
(13, 2, 14, 1, '2018-09-06 12:33:10'),
(14, 29, 14, 1, '2018-10-11 07:45:40');

-- --------------------------------------------------------

--
-- Table structure for table `advertisement_statics`
--

CREATE TABLE `advertisement_statics` (
  `id` int(11) NOT NULL,
  `advertisement_id` int(11) NOT NULL,
  `views_count` bigint(20) DEFAULT NULL,
  `group_count` bigint(20) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `advertisement_statics`
--

INSERT INTO `advertisement_statics` (`id`, `advertisement_id`, `views_count`, `group_count`, `created_by`, `created_date`, `modify_date`) VALUES
(9, 1, 5, 0, 1, '2018-05-30 11:51:35', '2018-09-18 05:58:34'),
(10, 4, 1, 3, 6, '2018-05-30 11:51:35', '2018-05-30 12:10:54'),
(11, 11, 3, 0, 8, '2018-05-30 11:51:35', '2018-05-31 07:23:28'),
(12, 22, 6, 0, 1, '2018-05-31 05:09:26', '2018-10-03 08:45:23'),
(13, 9, 2, 0, 1, '2018-05-31 07:23:42', '2018-10-03 09:23:30'),
(14, 2, 7, 12, 14, '2018-05-31 07:23:53', '2018-10-12 07:34:31'),
(15, 12, 6, 0, 1, '2018-06-20 06:58:47', '2018-10-03 09:23:39'),
(16, 17, 5, 0, 14, '2018-06-20 07:04:21', '2018-09-06 13:09:51'),
(17, 29, 7, 0, 2, '2018-08-08 10:30:51', '2019-01-03 07:02:39'),
(18, 8, 2, 0, 33, '2018-08-22 05:40:39', '2018-10-01 12:17:21'),
(19, 5, 4, 0, 1, '2018-08-25 09:55:32', '2018-10-04 07:44:50'),
(20, 13, 3, 0, 1, '2018-08-28 11:37:37', '2018-10-04 07:48:35'),
(21, 31, NULL, 1, 6, '2018-08-28 11:37:37', '2018-08-28 11:37:37');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `ID` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `order_number` int(11) NOT NULL,
  `CreateDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`ID`, `image_name`, `order_number`, `CreateDate`) VALUES
(1, '1.jpg', 1, '2018-08-29 09:51:35'),
(2, '2.jpg', 2, '2018-08-29 09:51:35'),
(3, '3.jpg', 3, '2018-08-29 09:52:06'),
(4, '4.jpg', 4, '2018-08-29 09:52:06');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(255) DEFAULT NULL,
  `category_image` varchar(255) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`, `category_image`, `created_by`, `created_date`, `updated_date`) VALUES
(1, 'Property', '1516270402Hopetoun_falls.jpg', NULL, '2018-01-18 10:13:00', '2018-01-18 10:13:22'),
(2, 'Electronics', '1516948734Electrical1.jpg', NULL, '2018-01-18 10:13:36', '2018-01-26 06:38:54'),
(3, 'AutoMobile', '1516947556cars.jpg', NULL, '2018-01-26 06:15:07', '2018-01-26 06:19:16'),
(4, 'Training-Courses-Study', '1516949090Courses.jpeg', NULL, '2018-01-26 06:21:14', '2018-01-26 06:44:50'),
(5, 'Health and medical', '1516948230health1.jpg', NULL, '2018-01-26 06:23:43', '2018-01-26 06:30:30'),
(6, 'Furniture & interiors', '1516948125furni.jpg', NULL, '2018-01-26 06:28:45', '2018-01-26 06:28:45'),
(7, 'servo TV', '15410650881024-1024-2.png', NULL, '2018-11-01 09:38:08', '2018-11-01 09:38:08'),
(8, '', '1541065150', NULL, '2018-11-01 09:39:10', '2018-11-01 09:39:10'),
(9, 'hvjv mm', 'dummy.jpg', NULL, '2018-11-01 10:14:23', '2018-11-01 10:14:23');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `coupon_id` int(11) NOT NULL,
  `advertisement_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `coupon_code` varchar(20) NOT NULL,
  `status` enum('pending','purchased','expired','orderPlaced') NOT NULL,
  `order_ref_id` varchar(100) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `address` text,
  `sequence_of_order` int(11) DEFAULT '0',
  `remarks` text NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `order_placed_date` datetime DEFAULT NULL,
  `purchased_date` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`coupon_id`, `advertisement_id`, `seller_id`, `buyer_id`, `coupon_code`, `status`, `order_ref_id`, `location`, `address`, `sequence_of_order`, `remarks`, `order_placed_date`, `purchased_date`, `created_at`, `updated_at`) VALUES
(45, 12, 31, 1, 'e4c3c42', 'purchased', 'd4e88c81crqu', NULL, NULL, 1, 'again changed', NULL, NULL, '2018-08-24 12:43:18', '2018-11-01 07:50:29'),
(46, 2, 9, 6, '023b102', 'orderPlaced', '22f5443e4H$e', NULL, NULL, 0, 'entered for second record', NULL, NULL, '2018-08-24 13:25:21', '2018-11-01 07:50:48'),
(47, 22, 1, 5, '39ee03d', 'purchased', '862281137wob', NULL, NULL, 1, 'fghkl lkshdfl;jgh sldfgs\ndfhsdfhs gj dfgj dj \nsg jdfjd ghj', NULL, NULL, '2018-08-25 03:43:54', '2018-11-01 08:10:22'),
(48, 2, 9, 5, '9374f0b', 'purchased', '327a380c9kO@', NULL, NULL, 3, 'hey', NULL, NULL, '2018-08-25 04:56:34', '2018-11-01 08:07:51'),
(49, 12, 1, 5, 'f2fefa7', 'pending', NULL, NULL, NULL, 0, 'now entered short remarks', NULL, NULL, '2018-08-25 09:09:47', '2018-11-01 07:54:49'),
(50, 22, 1, 8, '7b84de6', 'purchased', '82ee622eapjz', NULL, NULL, 2, 'entered for electronic deals atinder', NULL, NULL, '2018-08-25 09:33:37', '2018-11-01 07:51:11'),
(51, 5, 1, 5, '888e6da', 'pending', NULL, NULL, NULL, 0, 'jlhd jahsdjg hskfdjgh a;jkg h;ajks hla;jsgh a;jg ha;jg hkajdfgh ajha;jfdgh akjf ga\ndfgadf\ng \ndfh \nsdfh sdgh; s;ljfdh;la;f jfdsh', NULL, NULL, '2018-08-25 10:00:03', '2018-11-01 08:08:49'),
(52, 17, 16, 5, 'efeeeed', 'pending', NULL, NULL, NULL, 0, '', NULL, NULL, '2018-08-25 10:00:25', '2018-08-25 10:00:25'),
(53, 2, 9, 14, 'e9f7d7f', 'orderPlaced', '219379f95f*H', NULL, NULL, 0, '', NULL, NULL, '2018-09-04 12:47:00', '2018-09-18 11:39:32'),
(54, 22, 1, 14, '0376237', 'purchased', 'd9e6c1806Zmj', NULL, NULL, 3, '', NULL, '2018-09-24 12:28:01', '2018-09-06 07:12:50', '2018-09-24 06:58:01'),
(55, 5, 1, 14, 'dd06646', 'orderPlaced', '8a0656b704q*', 'Ludhiana, Punjab, India', 'Sas', 0, '', '2018-10-01 17:59:38', NULL, '2018-09-19 06:18:04', '2018-10-01 12:29:38'),
(56, 12, 1, 14, '46e2cae', 'orderPlaced', '2f96a0118jTD', NULL, NULL, 0, '', '2018-10-01 18:06:47', NULL, '2018-09-21 05:49:56', '2018-10-01 12:36:47'),
(57, 2, 9, 33, 'f66bf9d', 'orderPlaced', '94d0b541fElh', 'Ludhiana, Punjab, India', 'sas nagar , 11799', 0, '', '2018-09-27 17:53:27', NULL, '2018-09-27 11:38:18', '2018-09-27 12:23:27'),
(58, 12, 1, 33, '505b11a', 'orderPlaced', 'de831e2d7eP(', 'Ludhiana, Punjab, India', 'nsdf r4 bnmmmmn', 0, '', '2018-09-27 17:55:35', NULL, '2018-09-27 12:25:21', '2018-09-27 12:25:35'),
(59, 5, 1, 33, 'b265dfb', 'purchased', 'd01ea5d82rNi', 'Ludhiana, Punjab, India', 'Face 1 dugri', 1, '', '2018-09-27 18:01:55', '2018-10-01 18:08:38', '2018-09-27 12:25:45', '2018-10-01 12:38:38'),
(60, 13, 1, 33, 'be4714a', 'pending', NULL, NULL, NULL, 0, '', NULL, NULL, '2018-09-27 12:32:56', '2018-09-27 12:32:56'),
(61, 29, 1, 14, '28ed4cc', 'purchased', 'ece45d1c8s$u', 'Ludhiana, Punjab, India', 'sas', 1, '', '2018-10-11 15:05:31', '2018-10-11 15:06:31', '2018-10-11 07:10:10', '2018-10-11 09:36:31'),
(62, 29, 1, 17, '1efd858', 'pending', NULL, NULL, NULL, 0, '', NULL, NULL, '2019-01-03 06:06:46', '2019-01-03 06:06:46');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(200) DEFAULT NULL,
  `channelkey` int(11) NOT NULL,
  `group_image` varchar(200) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `subcategory2_id` int(11) NOT NULL,
  `subcategory3_id` int(11) NOT NULL,
  `subcategory4_id` int(11) NOT NULL,
  `subcategory5_id` int(11) NOT NULL,
  `createdby_userid` int(11) NOT NULL,
  `cost_range` int(11) DEFAULT '0',
  `members_count` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `description` text,
  `HistoryOfChange` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `is_approved` int(11) DEFAULT '0',
  `rating` int(11) NOT NULL,
  `check_join_count` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `channelkey`, `group_image`, `location`, `category_id`, `subcategory_id`, `subcategory2_id`, `subcategory3_id`, `subcategory4_id`, `subcategory5_id`, `createdby_userid`, `cost_range`, `members_count`, `start_date`, `end_date`, `description`, `HistoryOfChange`, `status`, `is_approved`, `rating`, `check_join_count`, `created_by`, `created_date`, `modify_date`) VALUES
(10, '2bhk flat in greater noida', 7088299, '1516507728.jpg', 'greater noida', 1, 2, 0, 0, 0, 0, 5, 4000000, 3, '2018-01-21', '2018-01-31', 'to get good discounts on group deal', 'Prevoious End date was2018-01-31', 'expired', 0, 0, 2, 5, '2018-01-21 04:08:48', '2018-03-25 10:23:52'),
(11, 'Samsung new', 7088438, '1516508651.jpg', 'Noida', 2, 3, 0, 0, 0, 0, 5, 40000, 3, '2018-01-21', '2018-01-31', 'discounts', NULL, 'expired', 0, 0, 0, 5, '2018-01-21 04:24:11', '2018-02-23 07:13:54'),
(12, 'commercial shops in Lucknow', 7088683, '1516510144.jpg', 'Lucknow Airport, Amausi, Lucknow, Uttar Pradesh, India', 1, 2, 0, 0, 0, 0, 8, 3500000, 3, '2018-01-21', '2018-02-28', 'looking for people to join in a group so that discount can be available by any builder . atleast 3 persons can join. we can look for more peoepel to join as well.', NULL, 'expired', 0, 0, 2, 8, '2018-01-21 04:49:04', '2018-08-02 08:00:12'),
(13, 'by Atinder', 7088861, '1516511287.jpg', 'New Delhi, Delhi, India', 2, 3, 0, 0, 0, 0, 6, 80000, 5, '2018-01-21', '2018-01-25', 'yeh hsh he bus His. hsvdjbs', NULL, 'expired', 0, 0, 0, 6, '2018-01-21 05:08:07', '2018-02-23 07:13:54'),
(14, 'new Samsung phone', 7088862, '1516511287.jpg', 'Noida', 2, 3, 0, 0, 0, 0, 5, 10000, 5, '2018-01-21', '2018-01-30', 'discounts', NULL, 'expired', 0, 0, 2, 5, '2018-01-21 05:08:07', '2018-02-23 07:13:54'),
(15, 'crockery', 7088953, '1516511943.JPG', 'Ludhiana, Punjab, India', 2, 1, 0, 0, 0, 0, 6, 68000, 5, '2018-01-21', '2018-01-30', 'yeh sjsbs', NULL, 'expired', 0, 0, 4, 6, '2018-01-21 05:19:03', '2018-02-23 07:13:54'),
(16, 'Here byke', 7166015, '1516948822.jpg', 'Noida, Uttar Pradesh, India', 3, 6, 0, 0, 0, 0, 5, 60000, 3, '2018-01-26', '2018-02-07', 'discounts', NULL, 'expired', 0, 0, 3, 5, '2018-01-26 06:40:22', '2018-02-23 07:13:54'),
(17, 'medical coaching jn Noida', 7170087, '1516974097.jpg', 'Noida, Uttar Pradesh, India', 4, 9, 0, 0, 0, 0, 5, 50000, 5, '2018-04-04', '2018-05-31', 'looking for medic coaching in Noida, if three or more join together, can get discounts upto 20%', NULL, 'expired', 0, 0, 3, 5, '2018-01-26 13:41:37', '2018-08-02 08:00:12'),
(18, 'Education solutions', 7176067, '1517029050.jpg', 'Etawah, Uttar Pradesh, India', 4, 9, 0, 0, 0, 0, 18, 50000, 50, '2018-01-27', '2018-04-27', 'Providing education with fun', NULL, 'expired', 0, 0, 4, 18, '2018-01-27 04:57:30', '2018-08-02 08:00:12'),
(19, 'data science course from Jigsaw (more people to book)', 7179038, '1517045948.jpg', 'Kanpur, Uttar Pradesh, India', 4, 9, 0, 0, 0, 0, 8, 15000, 5, '2018-01-27', '2018-02-28', 'looking for analytics course in data science. \nif we book together, will get more discount and can make study circle', NULL, 'expired', 0, 0, 3, 8, '2018-01-27 09:39:08', '2018-08-02 08:00:12'),
(21, 'test for reject', 7179533, '1517049259.jpg', 'Delhi, India', 6, 0, 0, 0, 0, 0, 8, 20000, 5, '2018-01-27', '2018-01-31', 'testing', NULL, 'expired', 0, 0, 0, 8, '2018-01-27 10:34:19', '2018-02-23 07:13:54'),
(1001, 'manu', 7564414, '1519368150.jpg', 'Fyllingsdalen, Bergen, Norway', 2, 0, 0, 0, 0, 0, 14, 10000, 25, '2018-02-23', '2018-02-26', 'fjj', NULL, 'expired', 0, 0, 2, 14, '2018-02-23 06:42:30', '2018-08-02 08:00:12'),
(1002, 'test123', 7564623, '1519369055.jpg', 'Lucknow, Uttar Pradesh, India', 1, 2, 0, 0, 0, 0, 6, 10000, 5, '2018-02-23', '2018-02-26', 'nothing', NULL, 'expired', 0, 0, 2, 6, '2018-02-23 06:57:35', '2018-08-02 08:00:12'),
(1003, 'Sandy Group ', 7564645, '1519369155.jpg', 'Lidingö, Sweden', 1, 0, 0, 0, 0, 0, 14, 10000, 837, '2018-02-23', '2018-05-24', 'vdjk', NULL, 'expired', 0, 0, 2, 14, '2018-02-23 06:59:15', '2018-08-02 08:00:12'),
(1004, 'fyi', 7564724, '1519369458.jpg', 'Ludhiana, Punjab, India', 4, 0, 0, 0, 0, 0, 14, 2000, 5, '2018-02-23', '2018-03-23', 'GK', NULL, 'expired', 0, 0, 0, 14, '2018-02-23 07:04:18', '2018-08-02 08:00:12'),
(1005, 'y set get ', 7564872, '1519369978.jpg', 'Fuhlsbüttel, Germany', 4, 8, 0, 0, 0, 0, 14, 53866, 86, '2018-02-23', '2018-03-23', 'shi', NULL, 'expired', 0, 0, 0, 14, '2018-02-23 07:12:58', '2018-08-02 08:00:12'),
(1006, 'test', 7565777, '1519373220.jpg', 'Hinjawadi, Pune, Maharashtra, India', 1, 2, 0, 0, 0, 0, 6, 20000, 5, '2018-02-23', '2018-03-29', 'something', NULL, 'expired', 0, 0, 2, 6, '2018-02-23 08:07:00', '2018-08-02 08:00:12'),
(1007, 'do do', 7567441, '1519379406.jpg', 'Lhasa, Tibet, China', 1, 2, 0, 0, 0, 0, 14, 9056, 989, '2018-02-23', '2018-05-23', 'shut', NULL, 'expired', 0, 0, 3, 14, '2018-02-23 09:50:06', '2018-08-02 08:00:12'),
(1008, 'Digital camera', 8057501, '1521970488.jpg', 'Noida, Uttar Pradesh, India', 2, 3, 0, 0, 0, 0, 5, 30000, 3, '2018-03-25', '2018-03-31', 'additional discount for group of buyers', NULL, 'expired', 0, 0, 1, 5, '2018-03-25 09:34:48', '2018-08-02 08:00:12'),
(1009, 'Need 5 people for a microwave purchase', 8057529, '1521970671.jpg', 'Gurugram, Haryana, India', 2, 3, 1, 0, 0, 0, 8, 30000, 5, '2018-03-25', '2018-03-27', 'testing', NULL, 'expired', 0, 0, 0, 8, '2018-03-25 09:37:51', '2018-08-02 08:00:12'),
(1010, 'hyundai verna', 8057764, '1521972108.jpg', 'Noida, Uttar Pradesh, India', 3, 5, 0, 0, 0, 0, 5, 1500000, 2, '2018-03-25', '2018-03-31', 'additional 39k discount for two buyer\'s', 'Prevoious End date was2018-03-31', 'expired', 0, 0, 0, 5, '2018-03-25 10:01:48', '2018-08-02 08:00:12'),
(1011, 'ccna training', 8058166, '1521974932.jpg', 'Lucknow, Uttar Pradesh, India', 4, 8, 0, 0, 0, 0, 8, 20000, 4, '2018-03-25', '2018-03-26', 'test', NULL, 'expired', 0, 0, 0, 8, '2018-03-25 10:48:52', '2018-08-02 08:00:12'),
(1012, 'test furniture', 9086252, '1526924488.jpg', 'Bhopal, Madhya Pradesh, India', 6, 0, 0, 0, 0, 0, 8, 10000, 5, '2018-05-21', '2018-05-23', 'testing only', NULL, 'expired', 0, 0, 2, 8, '2018-05-21 17:41:28', '2018-08-02 08:00:12'),
(1013, 'one plus mobile', 9086256, '1526924523.jpg', 'Noida, Uttar Pradesh, India', 2, 0, 0, 0, 0, 0, 5, 20000, 2, '2018-05-21', '2018-05-31', 'good deal', 'Prevoious End date was2018-05-31', 'expired', 0, 0, 0, 5, '2018-05-21 17:42:03', '2018-08-02 08:00:12'),
(1014, 'test23', 9086301, '1526924802.jpg', 'Indore, Madhya Pradesh, India', 6, 0, 0, 0, 0, 0, 8, 50000, 3, '2018-05-21', '2018-05-24', 'test23 objective', NULL, 'expired', 0, 0, 0, 8, '2018-05-21 17:46:42', '2018-08-02 08:00:12'),
(1015, 'Samsung AC turbo in Gurgaon', 9103549, '1526986031.jpg', 'Sector 24, Gurugram, Haryana, India', 2, 3, 1, 1, 0, 0, 8, 30000, 2, '2018-05-22', '2018-05-23', 'forming to get bulk deal on AC 1 Ton, location Gurgaon', NULL, 'expired', 0, 0, 1, 8, '2018-05-22 10:47:11', '2018-08-02 08:00:12'),
(1017, 'atinder test', 9116908, '1527056963.jpg', 'Ludhiana, Punjab, India', 2, 0, 0, 0, 0, 0, 6, 500000, 80, '2018-05-23', '2018-05-31', 'just. js. dj. dj. ndjdj.', NULL, 'expired', 0, 0, 0, 6, '2018-05-23 06:29:23', '2018-08-02 08:00:12'),
(1018, 'hey', 9139810, '1527162955.jpg', 'Ludhiana, Punjab, India', 2, 0, 0, 0, 0, 0, 6, 25, 25, '2018-05-31', '2018-06-07', 'ghj h', NULL, 'expired', 0, 0, 0, 6, '2018-05-24 11:55:55', '2018-08-02 08:00:12'),
(1020, 'Ludhiana Live', 9251125, '1529477671ic_logo.png', 'Sarabha Nagar, Ludhiana, Punjab, India', 1, 2, 0, 0, 0, 0, 6, 2500000, 90, '2018-05-31', '2018-07-31', 'sale and purchase for investment purposes.', NULL, 'expired', 0, 0, 3, 6, '2018-05-31 02:23:46', '2018-08-02 08:00:12'),
(1021, 'by atinder', 9581876, '1529477780.jpg', 'Ludhiana, Punjab, India', 1, 4, 0, 0, 0, 0, 6, 200000, 50, '2018-06-20', '2018-06-30', 'here goes the group objective', NULL, 'expired', 0, 0, 2, 6, '2018-06-20 06:56:20', '2018-08-02 08:00:12'),
(1022, 'MRI scanning', 9585657, '1529489371.jpg', 'Greater Noida, Uttar Pradesh, India', 5, 10, 0, 0, 0, 0, 5, 100000, 3, '2018-06-20', '2018-06-30', 'good discount for three or more members.', NULL, 'expired', 0, 0, 0, 5, '2018-06-20 10:09:31', '2018-08-02 08:00:12'),
(1024, 'Notification group', 9629754, '1529660083.jpg', 'Ludhiana, Punjab, India', 2, 1, 0, 0, 0, 0, 14, 35000, 25, '2018-06-22', '2018-09-13', 'Air c', NULL, 'expired', 0, 0, 3, 14, '2018-06-22 09:34:43', '2018-09-24 09:01:25'),
(1025, 'push', 9632122, '1529667693.jpg', 'Ludhiana - Chandigarh State Highway, Marauli Kalan, Punjab, India', 2, 1, 0, 0, 0, 0, 6, 58669, 55, '2018-06-22', '2018-06-28', 'ggg', NULL, 'expired', 0, 0, 1, 6, '2018-06-22 11:41:33', '2018-08-02 08:00:12'),
(1026, 'flat', 0, '', 'Canada', 1, 4, 0, 0, 0, 0, 14, 780909, 0, '2018-09-18', '2018-09-30', 'endddd', NULL, 'approved', 1, 0, 2, 14, '2018-09-18 11:55:38', '2018-09-21 09:55:53'),
(1027, 'home', 0, NULL, 'Switzerland', 1, 2, 0, 0, 0, 0, 14, 2147483647, 0, '2018-09-18', '2018-09-30', 'sakjdljf as', NULL, 'rejected', 0, 0, 0, 14, '2018-09-18 12:00:50', '2018-11-01 06:54:02'),
(1028, 'mvore', 0, NULL, '2495 Massachusetts Avenue, Cambridge, MA, USA', 4, 7, 3, 0, 0, 0, 14, 234, 0, '2018-09-18', '2018-09-18', '234', NULL, 'expired', 0, 0, 0, 14, '2018-09-18 12:02:50', '2018-09-24 09:01:25'),
(1029, 'wtvr', 0, NULL, 'Louisville International Airport (SDF), Terminal Drive, Louisville, KY, USA', 1, 2, 0, 0, 0, 0, 14, 43343, 0, '2018-09-18', '2018-09-18', 'fvvx', NULL, 'expired', 0, 0, 0, 14, '2018-09-18 12:05:26', '2018-09-24 09:01:25'),
(1030, 'kit', 0, NULL, 'Federal Way, WA, USA', 1, 4, 0, 0, 0, 0, 14, 2342, 0, '2018-09-18', '2018-09-18', 'asdf', NULL, 'expired', 0, 0, 0, 14, '2018-09-18 12:09:05', '2018-09-24 09:01:25'),
(1031, '2 bhk', 0, NULL, 'Delhi, India', 1, 2, 0, 0, 0, 0, 14, 500000, 0, '2018-09-20', '2018-09-28', 'jdhdhdhd', NULL, 'rejected', 0, 0, 0, 14, '2018-09-20 04:36:30', '2018-11-01 09:25:58'),
(1032, 'Flat', 0, NULL, 'Ludhiana', 1, 2, 0, 0, 0, 0, 14, 1000000, 0, '2018-09-21', '2018-09-21', 'Description', NULL, 'expired', 0, 0, 0, 14, '2018-09-21 09:48:51', '2018-09-24 09:01:25'),
(1033, 'AC gruop', 0, NULL, 'Ludhiana - Chandigarh State Highway, Marauli Kalan, Punjab, India', 1, 2, 0, 0, 0, 0, 33, 4234234, 0, '2018-10-01', '2018-10-31', 'salsjdlk alksdf', NULL, 'approved', 1, 0, 2, 33, '2018-10-01 11:56:54', '2018-10-01 12:39:40'),
(1034, 'good group', 0, NULL, 'Ludwigsburg, Germany', 1, 4, 0, 0, 0, 0, 33, 23412, 0, '2018-10-01', '2018-10-01', 'asdfasdf', NULL, 'approved', 1, 0, 2, 33, '2018-10-01 12:00:45', '2018-10-01 12:40:36'),
(1035, 'saab Elect', 0, NULL, 'Ludhiana, Punjab, India', 2, 1, 0, 0, 0, 0, 33, 234234, 0, '2018-10-01', '2018-10-31', 'asjdlkfjlkasdjklf', NULL, 'approved', 1, 0, 0, 33, '2018-10-01 12:27:48', '2018-10-01 12:38:59'),
(1036, 'Full Gard', 0, NULL, 'Ludwigsburg, Germany', 1, 2, 0, 0, 0, 0, 33, 234234, 0, '2018-10-01', '2018-10-01', 'asdfasdf', NULL, 'rejected', 0, 0, 0, 33, '2018-10-01 12:34:31', '2018-11-03 11:03:55'),
(1037, 'Full Gard', 0, '1541243080gogroup.jpg', 'Ludwigsburg, Germany', 1, 2, 0, 0, 0, 0, 33, 234234, 0, '2018-10-01', '2018-10-01', 'asdfasdf', NULL, 'approved', 1, 0, 0, 33, '2018-10-01 12:34:57', '2018-11-03 11:04:52'),
(1038, 'Top', 0, NULL, 'Ksar Hellal, Tunisia', 2, 3, 0, 0, 0, 0, 14, 2523, 0, '2018-10-01', '2018-10-24', 'asdf', NULL, 'rejected', 0, 0, 0, 14, '2018-10-01 12:42:32', '2018-11-01 09:27:56'),
(1039, 'Top flat', 0, '1538548534.jpg', 'Lucknow, Uttar Pradesh, India', 1, 4, 0, 0, 0, 0, 14, 105430, 0, '2018-10-03', '2018-10-18', 'geyshb', NULL, 'unapproved', 0, 0, 0, 14, '2018-10-03 06:35:34', '2018-11-03 11:03:22');

-- --------------------------------------------------------

--
-- Table structure for table `group_advertisements`
--

CREATE TABLE `group_advertisements` (
  `id` int(11) NOT NULL,
  `advertisement_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_advertisements`
--

INSERT INTO `group_advertisements` (`id`, `advertisement_id`, `group_id`, `created_by`, `created_date`, `modify_date`) VALUES
(1, 1, 1, 2, '2018-01-18 10:27:51', '2018-01-18 10:27:51'),
(2, 2, 12, 8, '2018-01-21 05:39:37', '2018-01-21 05:39:37'),
(3, 2, 1, 6, '2018-01-21 05:39:50', '2018-01-21 05:39:50'),
(4, 3, 16, 15, '2018-01-26 07:33:08', '2018-01-26 07:33:08'),
(5, 2, 10, 5, '2018-01-26 13:32:06', '2018-01-26 13:32:06'),
(6, 10, 10, 5, '2018-02-03 04:48:33', '2018-02-03 04:48:33'),
(7, 10, 12, 5, '2018-02-03 04:48:41', '2018-02-03 04:48:41'),
(8, 12, 12, 5, '2018-02-06 16:01:22', '2018-02-06 16:01:22'),
(9, 11, 18, 6, '2018-02-07 05:16:15', '2018-02-07 05:16:15'),
(10, 6, 16, 6, '2018-02-07 06:41:05', '2018-02-07 06:41:05'),
(11, 7, 16, 6, '2018-02-07 06:41:05', '2018-02-07 06:41:05'),
(12, 2, 1002, 6, '2018-02-23 07:06:39', '2018-02-23 07:06:39'),
(13, 2, 1003, 6, '2018-02-23 07:07:29', '2018-02-23 07:07:29'),
(14, 2, 1006, 14, '2018-02-23 09:26:28', '2018-02-23 09:26:28'),
(15, 17, 1003, 6, '2018-03-29 09:24:08', '2018-03-29 09:24:08'),
(16, 17, 1007, 6, '2018-03-29 09:24:40', '2018-03-29 09:24:40'),
(17, 1, 17, 8, '2018-05-22 07:57:46', '2018-05-22 07:57:46'),
(18, 4, 17, 8, '2018-05-22 07:57:46', '2018-05-22 07:57:46'),
(19, 11, 17, 8, '2018-05-22 07:57:46', '2018-05-22 07:57:46'),
(20, 9, 1012, 5, '2018-05-22 08:26:36', '2018-05-22 08:26:36'),
(21, 1, 1005, 14, '2018-05-29 10:18:45', '2018-05-29 10:18:45'),
(22, 4, 1005, 14, '2018-05-29 10:18:45', '2018-05-29 10:18:45'),
(23, 11, 1005, 14, '2018-05-29 10:18:45', '2018-05-29 10:18:45'),
(24, 1, 19, 8, '2018-05-29 18:52:24', '2018-05-29 18:52:24'),
(25, 4, 19, 8, '2018-05-29 18:52:24', '2018-05-29 18:52:24'),
(26, 11, 19, 8, '2018-05-29 18:52:24', '2018-05-29 18:52:24'),
(27, 1, 18, 6, '2018-05-31 02:20:22', '2018-05-31 02:20:22'),
(28, 2, 1020, 6, '2018-06-20 07:04:21', '2018-06-20 07:04:21'),
(29, 12, 1020, 6, '2018-06-20 07:04:21', '2018-06-20 07:04:21'),
(30, 17, 1020, 6, '2018-06-20 07:04:21', '2018-06-20 07:04:21'),
(31, 2, 1021, 6, '2018-06-20 07:04:25', '2018-06-20 07:04:25'),
(32, 12, 1021, 6, '2018-06-20 07:04:25', '2018-06-20 07:04:25'),
(33, 17, 1021, 6, '2018-06-20 07:04:25', '2018-06-20 07:04:25'),
(34, 22, 1024, 6, '2018-08-27 12:19:43', '2018-08-27 12:19:43'),
(35, 22, 1025, 6, '2018-08-28 11:37:28', '2018-08-28 11:37:28'),
(36, 22, 15, 6, '2018-08-28 11:37:34', '2018-08-28 11:37:34'),
(37, 5, 1006, 6, '2018-08-28 11:37:37', '2018-08-28 11:37:37'),
(38, 12, 1006, 6, '2018-08-28 11:37:37', '2018-08-28 11:37:37'),
(39, 13, 1006, 6, '2018-08-28 11:37:37', '2018-08-28 11:37:37'),
(40, 17, 1006, 6, '2018-08-28 11:37:37', '2018-08-28 11:37:37'),
(41, 31, 1006, 6, '2018-08-28 11:37:37', '2018-08-28 11:37:37'),
(42, 5, 1, 6, '2018-09-06 13:45:16', '2018-09-06 13:45:16'),
(43, 12, 1, 6, '2018-09-06 13:45:16', '2018-09-06 13:45:16'),
(44, 13, 1, 6, '2018-09-06 13:45:16', '2018-09-06 13:45:16'),
(45, 2, 1026, 14, '2018-09-18 12:32:38', '2018-09-18 12:32:38'),
(46, 5, 1026, 14, '2018-09-18 12:32:38', '2018-09-18 12:32:38'),
(47, 12, 1026, 14, '2018-09-18 12:32:38', '2018-09-18 12:32:38'),
(48, 13, 1026, 14, '2018-09-18 12:32:38', '2018-09-18 12:32:38'),
(49, 2, 1032, 14, '2018-09-21 09:49:21', '2018-09-21 09:49:21'),
(50, 5, 1032, 14, '2018-09-21 09:49:21', '2018-09-21 09:49:21'),
(51, 12, 1032, 14, '2018-09-21 09:49:21', '2018-09-21 09:49:21'),
(52, 13, 1032, 14, '2018-09-21 09:49:21', '2018-09-21 09:49:21'),
(53, 2, 1033, 14, '2018-10-01 12:39:38', '2018-10-01 12:39:38'),
(54, 5, 1033, 14, '2018-10-01 12:39:38', '2018-10-01 12:39:38'),
(55, 12, 1033, 14, '2018-10-01 12:39:38', '2018-10-01 12:39:38'),
(56, 13, 1033, 14, '2018-10-01 12:39:38', '2018-10-01 12:39:38'),
(57, 29, 1033, 14, '2018-10-01 12:39:38', '2018-10-01 12:39:38'),
(58, 2, 1034, 14, '2018-10-01 12:40:33', '2018-10-01 12:40:33'),
(59, 5, 1034, 14, '2018-10-01 12:40:33', '2018-10-01 12:40:33'),
(60, 12, 1034, 14, '2018-10-01 12:40:33', '2018-10-01 12:40:33'),
(61, 13, 1034, 14, '2018-10-01 12:40:33', '2018-10-01 12:40:33'),
(62, 29, 1034, 14, '2018-10-01 12:40:33', '2018-10-01 12:40:33'),
(63, 29, 1026, 14, '2018-10-12 06:51:16', '2018-10-12 06:51:16');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `Status` int(11) NOT NULL DEFAULT '0',
  `opt_text` varchar(255) DEFAULT NULL,
  `opt_verify_status` int(11) DEFAULT '0',
  `device_token` varchar(255) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `user_id`, `user_name`, `password`, `user_type`, `Status`, `opt_text`, `opt_verify_status`, `device_token`, `created_date`, `modify_date`, `created_by`) VALUES
(206, 219, 'pawan@email.com', 'pawan', 'Admin', 1, NULL, 0, NULL, '2017-12-13 04:48:36', '2017-12-13 04:52:40', 0),
(269, 1, 'atinder.singh13@gmail.com', '1e324226438491041138fc0666be67bd9108ae1803e35efd750eb9e76cded99b67d66e32cf427e5851819770fd6ee81fdacb3ac32cf5d940f8f15a2ab5c3e364xFbcmAln2NKfu+xLm4gl4tlPocKpciv02V8Tj9yJIFA=', 'Seller', 1, '4639', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMSJ9.o-KRJyklL7nz1BXBjSuWSdNi2_bW1I5yhWtVhxSu3PU', '2018-01-18 10:12:02', '2018-03-26 05:20:29', 1),
(270, 2, 'pawan.gulati@zabius.com', '1631acc2b21909c80e73a256cc64aa8d6735a9e269206d83de78f15d1dbce5809886f11a4ba476a614344e9a3722fe37568b911d41af2f6beebd68a47f3f783ayMytJCpjW1wwEgJBd/DGd+uVof0puA0F/Ddq3ayrjk0=', 'Seller', 1, '5128', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMiJ9.s7ON9ZwuUq9q5FXxAujXTAxVCjnQiiYurpSFXmTj_Ww', '2018-01-18 10:17:40', '2018-08-24 12:19:00', 2),
(271, 3, 'test@test.com', '1631acc2b21909c80e73a256cc64aa8d6735a9e269206d83de78f15d1dbce5809886f11a4ba476a614344e9a3722fe37568b911d41af2f6beebd68a47f3f783ayMytJCpjW1wwEgJBd/DGd+uVof0puA0F/Ddq3ayrjk0=', 'User', 1, '9339', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMyJ9.V4Qo2TnNmD52zrWLt_s6o_qiKfDTslsNOccXoHZ7SM0', '2018-01-18 11:05:47', '2018-01-18 11:07:41', 0),
(272, 4, 'mandeepkaurjandu@gmail.com', '87a9808c2b8c4179fe890c0b0fc551ba83583cc1bc80a230f7e1f5b6a7bc669a9df621a2c449115cb45211b00515d06dcff761b862d4d1f6919bf8d21f8a5ebfRGVJbijE2E4OAg0xgHwvnpsoMJ6WD8w1SqXFg+ITa5Q=', 'User', 1, '9972', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjo0fQ.MM0C3BY7TwFbymeGOp-boDOtdJA7bBi8hphGx5PX1Xw', '2018-01-18 11:14:35', '2018-01-18 11:15:47', 4),
(273, 5, 'bhu.bhupendra@gmail.com', '157349efa729cbc4ca4bb745f7c18e07261c067bc7d71002c1df9a66ae53a2974aa688e5ba15c45a87da55180b5d85f8b1e4eed4891ef8aa6083fcc4046eb4135y8gCCY/k7CtLmR7xgCY0Ojm33DKeamQRClyF+1NQ/k=', 'User', 1, '8765', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiNSJ9.gEd0_4GAR_C8P8VZkLtkipw8t2rkSLctgRnu6XlYhqE', '2018-01-19 12:43:33', '2018-01-19 12:44:15', 5),
(274, 6, 'atinder@zabius.com', '8cd686a25e9b19348beb004c0b7059e34474bcdfb7b05828ada83cbda855ae56e304ed4d2bdf28ede34de5c7736318c92a74658f5bc351e072cf8f38bcf0717cPA718qn5S45TyERPJiluca62IdM94sjFVOAVjm7n464=', 'User', 1, '5669', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiNiJ9.l8DSJpV6L_Ef2QOX5ZoZ9Re4hMECx9gR1sgx9qzi0y4', '2018-01-21 02:59:07', '2018-01-21 03:00:03', 6),
(276, 8, 'anujmmm@gmail.com', '7639232713c69cd252eb2b608b8741c28f633c7580ffe061f0f8ce3f9735a8ad59ca07f7eccf93d260229a961fbf099e29fdc12beae4ea1502906155dbd44ee07igJKtwjjomvUd1XddXRHh5f5HnXSwmrOI9gWF3Ckh0=', 'User', 1, '7222', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiOCJ9.DuO5P2SC2I7xHgEUFqQhBF-HNHGShlQETrz71zKBQ5E', '2018-01-21 03:16:07', '2018-01-21 03:17:12', 8),
(277, 9, 'anuj.mmm123@gmail.com', 'd394de41ec56e855f80ad4d1db9888f023326592159c942c901dc72c3139c8a307bf1b6660a250dc97e324d097e0f0e0089281cd5b3e0381fdd540252b10c4e00ltuQYXmffOvCRHZxi+Ob6dmwvbVoH0wRA3rxYiJ4x4=', 'Seller', 1, '1433', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiOSJ9.1KN25DuJWXwT1_ReAF3BB2hP8RzFj-fbt_UdfudD-ks', '2018-01-21 05:27:37', '2018-01-21 05:28:52', 9),
(278, 10, 'jasdeep0610@gmail.com', '9a836cf5f4771a6fd5d2ed9c90e27b27e24e63328d8765eabc67045b293be7dca382c740256a05b290cc3bc44f44a5e0589bfdfaab3a936c0485eaaa914631fdlU58iHxxmIUcnBIrGRA0heBnIYd0IiDI6U+D9Oaef6M=', 'User', 1, '1460', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMTAifQ.ATgRNVZap3dmF-6r6zEQhMYAJMKEVG45GTZbzscNAlY', '2018-01-21 10:12:48', '2018-01-21 10:17:34', 10),
(279, 11, 'kaurjasdeep06@ymail.com', '239c9bbc61d90e71a784c54e7f8a1c87c29d4da1a083a7b2586083cfd2625dbcc5d1528c69962928035858cdc2ae927322849229eed4a220411b434a1ba166af93DGuGZ4uPe4a6OjYiniYAJpzrS1tDriwnOK9DlJi30=', 'Seller', 1, '6552', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMTEifQ.m3zQYyErfaJHY7UKSIY5_DsE6KfhVxKu5rPM88HEajs', '2018-01-21 10:38:13', '2018-01-26 07:11:08', 11),
(280, 12, 'manpreet@zabius.con', '23acf0dbb28d5459da800d6fa21ed7acb0aef16ec4cda097daf2ca7939331f4f3018590ff0aedb8118dc34d2a7af5341a66b020e5991d398f61a5e2a580dd25cB1Zied5hltwxEK+RFiQGjxPQktV29HMLwRbsE90RjSE=', 'User', 1, '3238', 0, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoxMn0.hUKDxgoDJsrWBPH6nSubQow7iVaXYOUeRdkga7mlpwM', '2018-01-23 06:12:08', '2018-01-23 06:12:08', 12),
(281, 13, 'sandeep.netdev@live.com', '44add89f1c6e3bf344dc43c50bd35271b79d5e9ca8721d69bb2d530c6749f68ab6a0b649e523a48705d7ad38d8e97ab2c4ec3f2d79a8b684d8543d8005821549agt7RoF1Iypit7Zrl+SFAukJASZRhiRp9X5HMF49Xjw=', 'User', 1, '0089', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMTMifQ.mkGAZ2IfKTymonuYpIzQamXJRx7OIIKtcKs6H3XLKR4', '2018-01-23 06:14:27', '2018-01-23 06:15:50', 13),
(282, 14, 'manpreet@zabius.com', '8cd686a25e9b19348beb004c0b7059e34474bcdfb7b05828ada83cbda855ae56e304ed4d2bdf28ede34de5c7736318c92a74658f5bc351e072cf8f38bcf0717cPA718qn5S45TyERPJiluca62IdM94sjFVOAVjm7n464=', 'User', 1, '5657', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMTQifQ.n7QPYfDRWwLBxveCCwlW5cnKce3AuVEF29wUBLi9e7Y', '2018-01-23 06:16:58', '2018-08-31 10:45:12', 14),
(283, 15, 'aanchal001@gmail.com', '4cc0d5ee91704878d1767b9929e85323cae92b96836b3e03ecbb389ce29238c78c97c4fae8c096f0857e3fb4c240f9aa98f5c703f85253a5f81064119aa7a88fw27Wf4dxmakqFCsLUwCMZUOpjQHP6n29CfRhJdsWaTI=', 'User', 1, '7043', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMTUifQ.3vcKELnyIDyY2oSZ7RIX-ZgNiFi_U2yg8j_W70vmwUU', '2018-01-26 06:32:03', '2018-01-26 06:35:47', 15),
(284, 16, 'bhup@outlook.com', '6032041d5d7246f8a5f892c07b3625b911b8313efd083cba11fe6bff6b2189bdd6c5f53a9f2f6c53619c1fde29d02dc0cce184e4ab62914614fcca393645c4f52UQf+uJHXVpOB/9/VlZdTWsc6t33MWBL4LkUPd68Fv4=', 'Seller', 1, '3068', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMTYifQ.3Krg_drKaszhogZssZ6qGO_7ccCP1wVJ0nRLUYxDCOw', '2018-01-26 07:02:25', '2018-01-26 07:10:52', 16),
(285, 17, 'sandeep@zabius.com', '8cc7ce8810556ebc60173d6528e90a53fe91882c7e06cfadf2d6c828c47bba8fa34b3575c37a39a1a48f7335763641f98f6dad1af385597cc1ddfa8ae888cd44uXxILkfmE+O69M2UsilVRLN9/lB90v6GLp0MM2NSWwo=', 'User', 1, '2734', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMTcifQ.u8jhh3zExneWvCnpbpRnXrKJlx9YTLIKgKWMCSNXOtU', '2018-01-26 07:19:22', '2018-01-26 07:20:13', 17),
(286, 18, 'mukeshbarua@gmail.com', '2e7bd96e1396916cdcf9aabad20224d82b9ddad331499c4ab2fb50d554d8ef02cc4b03b8be0bf1eef5bf2312fcd589a12e6e17ecedae68abf1473a2a126f71cf0HuURGTjGV7dYBZYHsV3ZXuZbNt+kv8Re1ndK0RFrag=', 'User', 1, '0758', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMTgifQ.xvojr5JuhsR9D1HEBJPrHqofEdxwsrvkWL7mKBka0BQ', '2018-01-27 04:42:59', '2018-01-27 04:44:11', 18),
(287, 19, 'anujmmm1@gmail.com', '079777f7cb0ef4c0e1653839f26d023c18209bf157bb187128facadcae7a6fda750502093113e78a7266549e5abc8c1048c225ee0516f5277cc23bde36732976vhz6UbC/3NBaWK50uLKELfuCyRw7pAMr7XORGWYCbFo=', 'User', 1, '4646', 0, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoxOX0.0dgYWnpSqy5qvcaHUrfu4H3XQqlUC2DNuTTDSnjbgDw', '2018-01-27 09:12:47', '2018-01-27 09:12:47', 19),
(288, 20, 'aanchal.srivas@gmail.com', '7fe19ac65e92aaa2c5a1d7cb402d2aa10018032b37b975aa6b177737ac124b7a35a6731c4f1ee0aef5c2d2df15263c9cd0f0b8a287249d54a43029775d9c4c97deqW/y4OfocCgEF1l7wyjHv7hZIK1BpTiON11vwBtAY=', 'Seller', 1, '5512', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMjAifQ.4pXmKpao4PsCMYPXQ-dZxUdraGqxijYFCkVq-fu6seA', '2018-01-29 10:23:58', '2018-05-23 06:49:52', 20),
(289, 21, 'anupam@ebabu.co', '15537ec142235ee52c7dc46418b2b32f71dbf64a5a6590dcffeb760b98609930e24372235daf9b67695aa063ea8549c8924852ac87d0d94caee40ae9583a2e4ep7PQYHB32QWgC4qO+mmGnAqA1Bj7WkMkoquSedLW8lg=', 'User', 1, '8241', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMjEifQ.-exnhk0b8dj-asE885CGlgSrUf06y1Mh46rP5o-dtX8', '2018-06-06 08:50:33', '2018-06-06 08:51:18', 21),
(290, 22, 'dummy@email.com', '443e7753772b5d72e1ed2ac8a1de56e944d181d66ef83ed08754805762b21dfec58dccf4ea452e9cc723a1d8f092e340ed688c3f8b75e68d13f36e2ea73f5fa8IlXSrrp5KdgOhsG7UiDZxX0tlEkC9xvLm9AizOvX4tA=', 'User', 1, '4220', 0, NULL, '2018-06-20 05:27:09', '2018-06-20 05:27:09', 0),
(291, 23, 'asd@sad.asf', '25910b223f30c5d361f6b0255aba88048813ddd8fb68f022881e913f48636fe2147693b690db63cf753aee33b88d241b5f279e0ac4088f829a73ae2ed4d467d4K8Tqe2/bkIkW15OK9eitoVSr7o23qP46V5CqgOuHhSM=', 'Seller', 2, '6446', 0, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoyM30.xqxtEon-t_wmfcgWYYZ2Fex9pdMah45wfDrZyO6n584', '2018-08-07 05:14:17', '2018-11-01 06:55:10', 23),
(292, 24, 'gurpreet@zabius.com', '8995a3c5631ab6731fe4b06ed580c9d57e321ab731fcf1120c15cb84a14637992d45fc26a32b2e027350c3df581263d4e40fa0aa14ffaa073ece8d36ccf5137djGQtspsVVwh9VBSQqU1hl4clC5KIaxJDvxECPyCVqLI=', 'Seller', 0, '7863', 0, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoyNH0.rJ0OtQBNzlSZzAKUx3MA7PdpsqGViXbNFfsjvZ31ZJk', '2018-08-07 06:17:51', '2018-08-07 06:17:51', 24),
(293, 25, 'gurpreet@zabius.com', '971a00ea30cc0be90c9e9bd513f722225e148979bb7050aeecf4482859289750c1b218bfb45d3f90445ac44b47a67e3228e4a3a3ccb6cccae37d2b90ba77fb0bvGv/nboqSGV22OUxYJcCJuaJ5P2RSHx9+2W7Ce0urrc=', 'Seller', 0, '0047', 0, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoyNX0.q-6xYM5rxbny00L7M-fIYHRFnxARqtH3e2CgBZoM3fQ', '2018-08-07 06:37:39', '2018-08-07 06:37:39', 25),
(294, 26, 'gurpreet.singh@zabius.com', '4ae9da133fede89e714c33fd2f38005401f0e4a19fd2e2aad37bc13bcfb2473a15475ba6596e4e94109dcb395272a467f70bcbea1fc3ce19ae8458d07bd65f83i/yOtxcKUCPWgcLFp9uBLyq3rg/XaUp//QOiN6tugwk=', 'Seller', 1, '6808', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMjYifQ.tHNOLYyE89sogTACe8iIPbNskl_g7cuO8-9rgrhIwf4', '2018-08-07 06:40:50', '2018-08-07 06:45:53', 26),
(295, 27, 'pawan@zabius.com', '6a55ea62ead7a6b6a42626c0e5b50159cab36dc90b86bb62e73e2b33d2785cef3882de14de2a5199b6a7c3e7ee88a5466220946e35982906a2dc47207b46e529g24j2mxNt74MztolFwtHTcYP1cvjt6RUA9PdyG1rm00=', 'User', 1, '2161', 0, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoyN30.8An5c3yC8TJDQqxwNtHXbd0dZIN5tonO85Z9dIMRdik', '2018-08-07 09:49:29', '2018-08-07 09:49:29', 27),
(296, 28, 'pawan.zabius@gmail.com', 'ad57250756ae31bdbfc58ac3e1f577eede7ab5190d792eab10fca48c4f61fe70d0acd6a4257cb238907b786d595420bb9759607fcaa7ba586ebd3b10d441b741/C9pgpxLM33aMFsffI3hJRaJVza7xjrIcwzbzoSipyE=', 'User', 1, '5919', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMjgifQ.eYtV9Hv5nB1mDPAFeemJrMOUTUZNdzngMqD4Or3PFT4', '2018-08-07 10:38:56', '2018-08-07 10:40:30', 28),
(297, 29, 'mitin.dixit@gmail.com', '79b368a8446f68886756006eaab4413a913cbbd190fd326fff99beff61e3dffd2419f04842c55e8f97c397f0a9159fb31625a92b78fcf51ce9d9149430b8d9f0jf38MjO66/MACjs+j5OxjPg0tIpzrCqdXimQEr+CgD4=', 'User', 1, '1320', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMjkifQ.h3CMRoBETxLFw_qhGJ2e5laoaWblo3rao5Bz4kQKMwc', '2018-08-22 05:39:09', '2018-08-22 05:39:52', 29),
(298, 30, 'pawan1.gulati@zabius.com', '1c3f07122515740b4b6a247b0b92dc71e9cd7b6fc32920a2c68326e9f74a2a5dd77d0ce1490bc2ca2aec0f8c27b802bdb8a0f7e497c4981c9b2b56357cb3c2abgSiRL4cRh6vb1Q8T6Q5Id2KGF/uRZzdEWIew0W6q9qQ=', 'Seller', 1, '8562', 0, NULL, '2018-08-24 07:09:45', '2018-08-24 07:09:45', 0),
(299, 31, 'pawan121.gulati@zabius.com', '2e28bdd9c00f50affe8d7bdc062855f47ef5453b6d05797f2d7bc8d714e59aede4a115091c680d09b1b3ad4df39ae741b87b4333165e615fb602880943d2fd1arZfJ/HrVAknvz3ppf5pmqmTLIqdwy214jM/pK6289+U=', 'User', 1, '2611', 0, NULL, '2018-08-24 09:18:18', '2018-11-01 09:33:50', 0),
(300, 32, 'alskfd@lksdjf.co', '51f76a0dae63b75d9dd8a7f5b825b92a54f08691de4bbcb46c3f96493b22cfd60d05a2ea397ebf6238c3abdd45ddceffb828bd77b22668ba4192111dc57c288aGUyfqayGdlSTykFCQBWGcXThIWr77YwxWwTXlsTA3sA=', 'User', 1, '3947', 0, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjozMn0.FBfBlSqx2LuWM78m1A7gt1C7Rzad_er4yLjRiae4ldg', '2018-09-18 07:45:17', '2018-09-18 07:45:17', 32),
(301, 33, 'sandeep@zabius.co', 'bb989389b0a22b3682808390a7c5c4df267688595d1258a011f4ebc0fc77c44aefab597f451f808bf3f446e9875e1d18c67190507b001d264bec94b3c7f2ce57VmQZttfm/JgtBv9X2GsBnYYHqRnhcmZDkHEtG1AkF34=', 'User', 1, '7225', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMzMifQ.9sRignTonQbdkR95mni35s-lYWY-t900WZn1nGg3DwY', '2018-09-27 10:51:09', '2018-09-27 10:56:12', 33);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `adver_id` int(11) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  `read_status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `reason` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `adver_id`, `seller_id`, `user_id`, `group_id`, `status`, `read_status`, `created_at`, `updated_at`, `created_by`, `reason`) VALUES
(1, 1, 1, NULL, NULL, 'approved', 1, '2018-01-18 10:15:55', '2018-01-18 10:16:10', NULL, NULL),
(2, NULL, NULL, 2, 1, 'approved', 1, '2018-01-18 10:57:27', '2018-01-18 10:57:36', NULL, NULL),
(3, NULL, NULL, 8, 12, 'approved', 1, '2018-01-21 05:02:45', '2018-01-21 18:19:40', NULL, NULL),
(4, NULL, NULL, 8, 12, 'approved', 1, '2018-01-21 05:02:47', '2018-01-21 18:19:40', NULL, NULL),
(5, NULL, NULL, 5, 2, 'approved', 1, '2018-01-21 05:04:02', '2018-01-21 05:22:30', NULL, NULL),
(6, NULL, NULL, 6, 13, 'approved', 1, '2018-01-21 05:08:21', '2018-01-21 05:08:39', NULL, NULL),
(7, NULL, NULL, 5, 14, 'approved', 1, '2018-01-21 05:09:50', '2018-01-21 05:22:30', NULL, NULL),
(8, NULL, NULL, 6, 15, 'approved', 1, '2018-01-21 05:19:16', '2018-01-21 05:27:22', NULL, NULL),
(9, 2, 9, NULL, NULL, 'approved', 1, '2018-01-21 05:39:19', '2018-01-26 07:15:57', NULL, NULL),
(10, NULL, NULL, 5, 16, 'approved', 1, '2018-01-26 06:41:52', '2018-01-26 06:47:35', NULL, NULL),
(11, NULL, NULL, 5, 3, 'rejected', 1, '2018-01-26 06:42:41', '2018-01-26 06:47:35', NULL, NULL),
(12, NULL, NULL, 5, 6, 'rejected', 1, '2018-01-26 06:43:58', '2018-01-26 06:47:35', NULL, NULL),
(13, NULL, NULL, 5, 4, 'rejected', 1, '2018-01-26 06:43:58', '2018-01-26 06:47:35', NULL, NULL),
(14, NULL, NULL, 5, 5, 'rejected', 1, '2018-01-26 06:44:04', '2018-01-26 06:47:35', NULL, NULL),
(15, NULL, NULL, 5, 7, 'rejected', 1, '2018-01-26 06:44:11', '2018-01-26 06:47:35', NULL, NULL),
(16, NULL, NULL, 5, 8, 'rejected', 1, '2018-01-26 06:44:17', '2018-01-26 06:47:35', NULL, NULL),
(17, NULL, NULL, 5, 11, 'rejected', 1, '2018-01-26 06:44:27', '2018-01-26 06:47:35', NULL, NULL),
(18, 3, 16, NULL, NULL, 'approved', 1, '2018-01-26 07:13:46', '2018-01-26 13:46:01', NULL, NULL),
(19, NULL, NULL, 5, 17, 'approved', 1, '2018-01-26 13:44:09', '2018-01-26 16:48:32', NULL, NULL),
(20, NULL, NULL, 5, 10, 'approved', 1, '2018-01-26 13:44:15', '2018-01-26 16:48:32', NULL, NULL),
(21, NULL, NULL, 5, 9, 'rejected', 1, '2018-01-26 13:44:24', '2018-01-26 16:48:32', NULL, NULL),
(22, NULL, NULL, 18, 18, 'approved', 1, '2018-01-27 09:14:25', '2018-02-01 09:32:51', NULL, NULL),
(23, NULL, NULL, 8, 19, 'approved', 1, '2018-01-27 09:50:17', '2018-01-27 10:00:04', NULL, NULL),
(24, NULL, NULL, 8, 20, 'rejected', 1, '2018-01-27 10:34:23', '2018-01-27 10:35:10', NULL, NULL),
(25, NULL, NULL, 8, 21, 'rejected', 1, '2018-01-27 10:35:42', '2018-01-27 10:36:43', NULL, NULL),
(26, NULL, NULL, 10, 22, 'approved', 0, '2018-01-27 11:12:21', '2018-01-27 11:12:21', NULL, NULL),
(27, NULL, NULL, 8, 34, 'approved', 1, '2018-01-27 11:17:10', '2018-01-27 11:34:25', NULL, NULL),
(28, NULL, NULL, 10, 33, 'approved', 0, '2018-01-27 11:33:50', '2018-01-27 11:33:50', NULL, NULL),
(29, NULL, NULL, 5, 37, 'approved', 1, '2018-01-27 11:35:09', '2018-01-27 11:35:47', NULL, NULL),
(30, 4, 9, NULL, NULL, 'rejected', 1, '2018-01-27 18:01:36', '2018-01-27 18:01:54', NULL, NULL),
(31, 6, 20, NULL, NULL, 'approved', 1, '2018-01-29 10:49:56', '2018-01-29 11:20:34', NULL, NULL),
(32, 11, 9, NULL, NULL, 'approved', 1, '2018-02-02 07:04:40', '2018-02-02 07:04:49', NULL, NULL),
(33, 7, 9, NULL, NULL, 'approved', 1, '2018-02-02 07:06:13', '2018-02-17 16:32:53', NULL, NULL),
(34, 10, 16, NULL, NULL, 'approved', 1, '2018-02-02 17:55:07', '2018-02-17 16:15:52', NULL, NULL),
(35, 12, 1, NULL, NULL, 'approved', 1, '2018-02-05 11:44:50', '2018-02-06 04:30:27', NULL, NULL),
(36, 15, 9, NULL, NULL, 'approved', 1, '2018-02-17 16:29:51', '2018-02-17 16:32:53', NULL, NULL),
(37, 14, 16, NULL, NULL, 'rejected', 1, '2018-02-17 16:30:34', '2018-02-17 16:36:16', NULL, NULL),
(38, NULL, NULL, 8, 12, 'disable', 1, '2018-02-23 05:19:05', '2018-02-23 05:19:30', NULL, 'Please resubit or create new group'),
(39, 12, 1, NULL, NULL, 'rejected', 1, '2018-02-23 05:39:33', '2018-02-23 12:20:33', NULL, NULL),
(40, 13, 1, NULL, NULL, 'Expired', 1, '2018-02-23 07:13:54', '2018-02-23 12:20:33', NULL, NULL),
(41, NULL, NULL, 8, 42, 'Expired', 1, '2018-02-23 07:13:54', '2018-02-26 16:47:08', NULL, NULL),
(42, NULL, NULL, 8, 43, 'Expired', 1, '2018-02-23 07:13:54', '2018-02-26 16:47:08', NULL, NULL),
(43, NULL, NULL, 8, 44, 'Expired', 1, '2018-02-23 07:13:54', '2018-02-26 16:47:08', NULL, NULL),
(44, NULL, NULL, 8, 45, 'Expired', 1, '2018-02-23 07:13:54', '2018-02-26 16:47:08', NULL, NULL),
(45, NULL, NULL, 8, 46, 'Expired', 1, '2018-02-23 07:13:54', '2018-02-26 16:47:08', NULL, NULL),
(46, 13, 1, NULL, NULL, 'rejected', 1, '2018-03-13 06:50:16', '2018-03-13 07:00:23', NULL, NULL),
(47, NULL, 1, NULL, NULL, NULL, 0, '2018-03-14 05:00:30', '2018-03-14 05:00:30', NULL, 'sdgd fdfgh'),
(48, NULL, NULL, 5, 1008, 'approved', 1, '2018-03-25 09:39:20', '2018-03-25 09:53:20', NULL, NULL),
(49, NULL, NULL, 8, 1009, 'disable', 1, '2018-03-25 09:49:25', '2018-03-25 09:50:35', NULL, 'Pls resubmit because the end date is beyond an year'),
(50, NULL, NULL, 5, 1010, 'rejected', 1, '2018-03-25 10:02:41', '2018-03-25 10:03:07', NULL, NULL),
(51, NULL, NULL, 14, 1007, 'enable', 1, '2018-03-25 10:36:52', '2018-05-25 07:26:46', NULL, NULL),
(52, NULL, NULL, 8, 1011, 'rejected', 1, '2018-03-25 10:59:31', '2018-03-25 11:07:11', NULL, NULL),
(53, 17, 0, NULL, NULL, 'rejected', 0, '2018-03-25 13:31:19', '2018-03-25 13:31:19', NULL, NULL),
(54, 17, 0, NULL, NULL, 'rejected', 0, '2018-03-25 13:31:28', '2018-03-25 13:31:28', NULL, NULL),
(55, 17, 0, NULL, NULL, 'rejected', 0, '2018-03-25 13:31:30', '2018-03-25 13:31:30', NULL, NULL),
(56, 17, 0, NULL, NULL, 'rejected', 0, '2018-03-25 13:31:31', '2018-03-25 13:31:31', NULL, NULL),
(57, 17, 0, NULL, NULL, 'rejected', 0, '2018-03-25 13:31:33', '2018-03-25 13:31:33', NULL, NULL),
(58, 17, 0, NULL, NULL, 'rejected', 0, '2018-03-25 13:31:43', '2018-03-25 13:31:43', NULL, NULL),
(59, 17, 0, NULL, NULL, 'rejected', 0, '2018-03-25 13:31:48', '2018-03-25 13:31:48', NULL, NULL),
(60, 17, 0, NULL, NULL, 'rejected', 0, '2018-03-25 13:31:55', '2018-03-25 13:31:55', NULL, NULL),
(61, 17, 0, NULL, NULL, 'rejected', 0, '2018-03-25 13:32:11', '2018-03-25 13:32:11', NULL, NULL),
(62, 17, 0, NULL, NULL, 'rejected', 0, '2018-03-25 13:32:26', '2018-03-25 13:32:26', NULL, NULL),
(63, 17, 0, NULL, NULL, 'rejected', 0, '2018-03-25 13:32:29', '2018-03-25 13:32:29', NULL, NULL),
(64, 17, 0, NULL, NULL, 'rejected', 0, '2018-03-25 13:32:30', '2018-03-25 13:32:30', NULL, NULL),
(65, 17, 0, NULL, NULL, 'rejected', 0, '2018-03-25 13:32:30', '2018-03-25 13:32:30', NULL, NULL),
(66, 17, 0, NULL, NULL, 'rejected', 0, '2018-03-25 13:32:31', '2018-03-25 13:32:31', NULL, NULL),
(67, 17, 0, NULL, NULL, 'rejected', 0, '2018-03-25 13:32:32', '2018-03-25 13:32:32', NULL, NULL),
(68, 17, 0, NULL, NULL, 'rejected', 0, '2018-03-25 13:32:43', '2018-03-25 13:32:43', NULL, NULL),
(69, 17, 0, NULL, NULL, 'rejected', 0, '2018-03-25 13:32:43', '2018-03-25 13:32:43', NULL, NULL),
(70, 17, 0, NULL, NULL, 'rejected', 0, '2018-03-25 13:32:44', '2018-03-25 13:32:44', NULL, NULL),
(71, 17, 0, NULL, NULL, 'rejected', 0, '2018-03-25 13:32:46', '2018-03-25 13:32:46', NULL, NULL),
(72, 17, 0, NULL, NULL, 'rejected', 0, '2018-03-25 13:32:47', '2018-03-25 13:32:47', NULL, NULL),
(73, 17, 0, NULL, NULL, 'rejected', 0, '2018-03-25 13:32:47', '2018-03-25 13:32:47', NULL, NULL),
(74, 17, 0, NULL, NULL, 'rejected', 0, '2018-03-25 13:32:58', '2018-03-25 13:32:58', NULL, NULL),
(75, 17, 16, NULL, NULL, 'approved', 1, '2018-03-25 13:33:03', '2018-03-25 14:01:13', NULL, NULL),
(76, NULL, NULL, 5, 1013, 'rejected', 1, '2018-05-21 17:43:10', '2018-05-21 17:43:35', NULL, NULL),
(77, NULL, NULL, 8, 1012, 'approved', 1, '2018-05-21 17:44:26', '2018-05-21 17:44:35', NULL, NULL),
(78, 15, 0, NULL, NULL, 'rejected', 0, '2018-05-21 17:53:25', '2018-05-21 17:53:25', NULL, NULL),
(79, 15, 0, NULL, NULL, 'rejected', 0, '2018-05-21 17:53:32', '2018-05-21 17:53:32', NULL, NULL),
(80, 15, 0, NULL, NULL, 'rejected', 0, '2018-05-21 17:54:07', '2018-05-21 17:54:07', NULL, NULL),
(81, 1, 1, NULL, NULL, 'approved', 1, '2018-05-21 18:03:23', '2018-05-25 07:51:15', NULL, NULL),
(82, 11, 9, NULL, NULL, 'approved', 1, '2018-05-21 18:13:52', '2018-05-21 18:13:57', NULL, NULL),
(83, 11, 9, NULL, NULL, 'approved', 1, '2018-05-21 18:16:11', '2018-05-22 08:11:59', NULL, NULL),
(84, NULL, NULL, 8, 1015, 'approved', 1, '2018-05-22 10:51:27', '2018-05-26 19:00:54', NULL, NULL),
(85, 19, 0, NULL, NULL, 'rejected', 0, '2018-05-27 06:14:47', '2018-05-27 06:14:47', NULL, NULL),
(86, 5, 0, NULL, NULL, 'rejected', 0, '2018-05-27 06:23:43', '2018-05-27 06:23:43', NULL, NULL),
(87, 7, 9, NULL, NULL, 'approved', 1, '2018-05-27 07:00:54', '2018-05-31 07:26:58', NULL, NULL),
(88, NULL, NULL, 6, 1018, 'rejected', 1, '2018-05-30 11:34:03', '2018-05-31 02:19:38', NULL, NULL),
(89, NULL, NULL, 8, 1014, 'rejected', 1, '2018-05-30 11:35:32', '2018-06-08 06:43:38', NULL, NULL),
(90, 12, 0, NULL, NULL, 'rejected', 0, '2018-05-30 11:35:45', '2018-05-30 11:35:45', NULL, NULL),
(91, 12, 0, NULL, NULL, 'rejected', 0, '2018-05-30 11:35:49', '2018-05-30 11:35:49', NULL, NULL),
(92, 12, 0, NULL, NULL, 'rejected', 0, '2018-05-30 11:35:50', '2018-05-30 11:35:50', NULL, NULL),
(93, 12, 0, NULL, NULL, 'rejected', 0, '2018-05-30 11:35:51', '2018-05-30 11:35:51', NULL, NULL),
(94, 12, 0, NULL, NULL, 'rejected', 0, '2018-05-30 11:35:52', '2018-05-30 11:35:52', NULL, NULL),
(95, 12, 0, NULL, NULL, 'rejected', 0, '2018-05-30 11:35:52', '2018-05-30 11:35:52', NULL, NULL),
(96, 18, 0, NULL, NULL, 'rejected', 0, '2018-05-30 11:37:24', '2018-05-30 11:37:24', NULL, NULL),
(97, 13, 0, NULL, NULL, 'rejected', 0, '2018-05-30 11:37:58', '2018-05-30 11:37:58', NULL, NULL),
(98, 21, 0, NULL, NULL, 'rejected', 0, '2018-05-30 11:39:55', '2018-05-30 11:39:55', NULL, NULL),
(99, 22, 0, NULL, NULL, 'rejected', 0, '2018-05-30 11:41:50', '2018-05-30 11:41:50', NULL, NULL),
(100, 22, 1, NULL, NULL, 'approved', 1, '2018-05-30 11:45:11', '2018-06-01 08:56:13', NULL, NULL),
(101, 21, 0, NULL, NULL, 'rejected', 0, '2018-05-30 11:45:21', '2018-05-30 11:45:21', NULL, NULL),
(102, 19, 9, NULL, NULL, 'rejected', 1, '2018-05-30 11:57:09', '2018-05-31 07:26:58', NULL, NULL),
(103, 23, 1, NULL, NULL, 'rejected', 1, '2018-05-30 11:57:35', '2018-06-01 08:56:13', NULL, NULL),
(104, 15, 9, NULL, NULL, 'rejected', 1, '2018-05-30 11:59:18', '2018-05-31 07:26:58', NULL, NULL),
(105, NULL, NULL, 6, 1017, 'approved', 1, '2018-06-05 10:38:48', '2018-06-05 10:41:24', NULL, NULL),
(106, NULL, NULL, 6, 1020, 'approved', 1, '2018-06-05 10:39:55', '2018-06-05 10:41:24', NULL, NULL),
(107, NULL, NULL, 6, 1020, 'approved', 1, '2018-06-20 06:54:34', '2018-06-20 06:57:14', NULL, NULL),
(108, NULL, NULL, 6, 1021, 'approved', 1, '2018-06-20 06:56:40', '2018-06-20 06:57:14', NULL, NULL),
(109, 12, 1, NULL, NULL, 'approved', 1, '2018-06-20 06:57:02', '2018-06-20 12:41:14', NULL, NULL),
(110, NULL, NULL, 5, 1022, 'approved', 1, '2018-06-20 10:11:12', '2018-06-20 10:12:31', NULL, NULL),
(111, 26, 9, NULL, NULL, 'approved', 1, '2018-06-20 10:25:13', '2018-08-25 09:39:30', NULL, NULL),
(112, 29, 1, NULL, NULL, 'approved', 1, '2018-08-08 10:30:35', '2018-08-20 10:35:51', NULL, NULL),
(113, 1, 1, NULL, NULL, 'approved', 1, '2018-08-22 04:37:39', '2018-08-29 06:28:49', NULL, NULL),
(114, 13, 1, NULL, NULL, 'approved', 1, '2018-08-22 04:37:47', '2018-08-29 06:28:49', NULL, NULL),
(115, 1, 1, NULL, NULL, 'disable', 1, '2018-08-24 06:25:27', '2018-08-29 06:28:49', NULL, 'wqeqwe'),
(116, 22, 1, NULL, NULL, 'approved', 1, '2018-09-27 12:41:17', '2018-09-27 13:03:08', NULL, NULL),
(117, 22, 1, NULL, NULL, 'approved', 1, '2018-09-27 12:41:26', '2018-09-27 13:03:08', NULL, NULL),
(118, 22, 1, NULL, NULL, 'approved', 1, '2018-09-27 12:41:59', '2018-09-27 13:03:08', NULL, NULL),
(119, 22, 1, NULL, NULL, 'approved', 1, '2018-09-27 12:42:47', '2018-09-27 13:03:08', NULL, NULL),
(120, 22, 1, NULL, NULL, 'approved', 1, '2018-09-27 12:43:21', '2018-09-27 13:03:08', NULL, NULL),
(121, 22, 1, NULL, NULL, 'approved', 1, '2018-09-27 12:43:55', '2018-09-27 13:03:08', NULL, NULL),
(122, 22, 1, NULL, NULL, 'approved', 1, '2018-09-27 12:44:21', '2018-09-27 13:03:08', NULL, NULL),
(123, 29, 1, NULL, NULL, 'approved', 1, '2018-09-27 12:44:52', '2018-09-27 13:03:08', NULL, NULL),
(124, 29, 1, NULL, NULL, 'approved', 1, '2018-09-27 12:49:30', '2018-09-27 13:03:08', NULL, NULL),
(125, 29, 1, NULL, NULL, 'approved', 1, '2018-09-27 12:52:27', '2018-09-27 13:03:08', NULL, NULL),
(126, 29, 1, NULL, NULL, 'approved', 1, '2018-09-27 12:56:28', '2018-09-27 13:03:08', NULL, NULL),
(127, 29, 1, NULL, NULL, 'approved', 1, '2018-09-27 13:03:15', '2018-10-03 08:48:13', NULL, NULL),
(128, 29, 1, NULL, NULL, 'approved', 1, '2018-09-27 13:05:00', '2018-10-03 08:48:13', NULL, NULL),
(129, 5, 1, NULL, NULL, 'rejected', 1, '2018-10-11 12:08:48', '2018-10-12 07:40:39', NULL, NULL),
(130, 12, 1, NULL, NULL, 'rejected', 1, '2018-10-12 05:27:44', '2018-10-12 07:40:39', NULL, NULL),
(131, 13, 1, NULL, NULL, 'approved', 1, '2018-10-12 07:41:09', '2018-10-12 07:45:19', NULL, NULL),
(132, 22, 1, NULL, NULL, 'rejected', 1, '2018-10-12 07:43:59', '2018-10-12 07:45:19', NULL, 'seller reject'),
(133, 1, 1, NULL, NULL, 'approved', 1, '2018-10-12 07:45:39', '2018-10-12 07:47:05', NULL, NULL),
(134, 1, 1, NULL, NULL, 'approved', 1, '2018-10-12 07:47:59', '2018-10-12 07:49:08', NULL, NULL),
(135, 5, 1, NULL, NULL, 'approved', 1, '2018-10-12 07:48:13', '2018-10-12 07:49:08', NULL, NULL),
(136, 1, 1, NULL, NULL, 'rejected', 1, '2018-10-12 07:49:05', '2018-10-12 07:49:08', NULL, 'kuch bhi'),
(137, NULL, NULL, 14, 1027, 'rejected', 0, '2018-11-01 06:54:02', '2018-11-01 06:54:02', NULL, 'rejection message'),
(138, NULL, NULL, 14, 1027, 'rejected', 0, '2018-11-01 06:54:14', '2018-11-01 06:54:14', NULL, 'rejection message'),
(139, NULL, NULL, 14, 1031, 'rejected', 0, '2018-11-01 09:25:58', '2018-11-01 09:25:58', NULL, 'jh kjh'),
(140, NULL, NULL, 14, 1038, 'rejected', 0, '2018-11-01 09:27:56', '2018-11-01 09:27:56', NULL, 'rejected'),
(141, 1, 1, NULL, NULL, 'rejected', 0, '2018-11-01 09:29:40', '2018-11-01 09:29:40', NULL, 'ghdf hdgfh dgh'),
(142, NULL, 31, NULL, NULL, NULL, 0, '2018-11-01 09:32:30', '2018-11-01 09:32:30', NULL, 'rejected'),
(143, NULL, NULL, 14, 1039, 'approved', 0, '2018-11-03 10:47:34', '2018-11-03 10:47:34', NULL, NULL),
(144, NULL, NULL, 14, 1039, 'approved', 0, '2018-11-03 10:54:25', '2018-11-03 10:54:25', NULL, NULL),
(145, NULL, NULL, 14, 1039, 'approved', 0, '2018-11-03 10:55:14', '2018-11-03 10:55:14', NULL, NULL),
(146, NULL, NULL, 14, 1039, 'approved', 0, '2018-11-03 10:55:32', '2018-11-03 10:55:32', NULL, NULL),
(147, NULL, NULL, 14, 1039, 'approved', 0, '2018-11-03 10:56:36', '2018-11-03 10:56:36', NULL, NULL),
(148, NULL, NULL, 14, 1039, 'approved', 0, '2018-11-03 11:02:30', '2018-11-03 11:02:30', NULL, NULL),
(149, NULL, NULL, 33, 1036, 'rejected', 0, '2018-11-03 11:03:55', '2018-11-03 11:03:55', NULL, 'gdfg dfg fdg'),
(150, NULL, NULL, 33, 1037, 'approved', 0, '2018-11-03 11:04:52', '2018-11-03 11:04:52', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `push_notification`
--

CREATE TABLE `push_notification` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `device_token` varchar(255) DEFAULT NULL,
  `user_type` varchar(15) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `push_notification`
--

INSERT INTO `push_notification` (`ID`, `user_id`, `device_token`, `user_type`, `created_at`) VALUES
(142, 1, 'dCNPYFg8mys:APA91bEo-ESS4nT-RmX2u9EiwQkYSz81E7juJL5TPx5T79CvWpcXgWwa_rxjH_jqmHzWtF3my9HrHwwvrXZknnHfWlQN27GHRFUAKR5utQQBg6P0cbdejYKshgw8dstsFm5_SYqa84Y2', 'Seller', '2018-10-11 07:08:17'),
(144, 1, 'f-iwTBsk7Qo:APA91bEiTV8U6L04zDI-43uWiw3vkJvRyO07Hdr9vc6RwpcygLuDuUlbWcWLbVsJJVJ-O27s-gEjyrguw3rS10MWMeJo3_sHBtUqxGqrr5KyC4B93QeigMfQAJ1e7t5do9PEOMPzkKLS', 'Seller', '2018-10-12 07:40:59'),
(146, 14, 'dZ1LovhW5zk:APA91bFysRD2sdVVWasigJXwF_CH_7gLfyI74koez78q5zBkQHDyVcGUEomR9NXDmKHfu9Q2YNtwjB4S8CS3INo0rr4jqQwtKHZztK6x_w2rCq-W3spyaNKKj_nnzKClLu7o9UMlJfQ1', 'User', '2018-10-12 07:49:40'),
(149, 1, 'e1uqllfLbGI:APA91bGjDo4godF8XakX2vn350TnVfUZ5BtYS32z1_V81pcNb5mxb1zTWHdJHhxeuyPg4D-3CbFTyp3uIWe5-a5rfmJRo3FarSAXJqYcH9D23p8Dl3fsgfP-vOdziyf_6A7aG4O8yFfH', 'Seller', '2018-11-01 06:25:44'),
(152, 1, 'e7fNVDecmtQ:APA91bFhfEq5dWmsq6eUIEo38eMj_IQracjUWiQs9LNj1xy6v-BdjHrKFIAPLwsnpYjVUfOJXSiDFSg-TUMxCMGgZg_MgVWtqqHVCaxw_e7CRrV1mRHm3YBeFcmT6ObEhmPKv0Faarn1', 'Seller', '2019-01-03 07:04:14');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `ID` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`ID`, `seller_id`, `rating`, `buyer_id`) VALUES
(4, 1, 5, 14),
(5, 9, 3, 14),
(6, 1, 2, 6),
(7, 9, 1, 33);

-- --------------------------------------------------------

--
-- Table structure for table `report_advertisements`
--

CREATE TABLE `report_advertisements` (
  `report_id` int(11) NOT NULL,
  `report_userid` int(11) NOT NULL,
  `advertisement_id` int(11) NOT NULL,
  `comments` text,
  `report_type` text,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report_advertisements`
--

INSERT INTO `report_advertisements` (`report_id`, `report_userid`, `advertisement_id`, `comments`, `report_type`, `created_by`, `created_date`, `modify_date`) VALUES
(1, 2, 1, 'Seems broker OR creating \n 	 	 	 un-necessary discussion', 'ads', 2, '2018-01-18 11:02:42', '2018-01-18 11:02:42'),
(2, 3, 1, 'Spamming the group', 'group', 3, '2018-01-18 11:08:08', '2018-01-18 11:08:08'),
(3, 8, 14, 'Seems broker OR creating \n 	 	 	 un-necessary discussion', 'group', 8, '2018-01-21 05:21:17', '2018-01-21 05:21:17'),
(4, 6, 10, 'b him', 'ads', 6, '2018-02-06 12:10:51', '2018-02-06 12:10:51'),
(5, 14, 2, 'Seems fake user', 'ads', 14, '2018-02-19 13:09:26', '2018-02-19 13:09:26'),
(6, 8, 5, 'Spamming the group', 'member', 8, '2018-05-22 11:13:09', '2018-05-22 11:13:09'),
(7, 6, 1024, 'Seems fake user', 'group', 6, '2018-09-07 09:05:07', '2018-09-07 09:05:07');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `subcategory_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_title` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`subcategory_id`, `category_id`, `subcategory_title`, `created_by`, `created_date`, `modify_date`) VALUES
(1, 2, 'Air conditioner', NULL, '2018-01-18 10:13:47', '2018-04-20 17:38:31'),
(2, 1, '2 BHK', NULL, '2018-01-18 10:14:02', '2018-01-18 10:14:02'),
(3, 2, 'Samsung', NULL, '2018-01-21 03:24:45', '2018-01-21 03:24:45'),
(4, 1, '3BHK', NULL, '2018-01-21 03:25:22', '2018-01-21 03:25:22'),
(5, 3, 'Four wheeler', NULL, '2018-01-26 06:15:58', '2018-01-26 06:15:58'),
(6, 3, 'Two wheeler', NULL, '2018-01-26 06:16:12', '2018-01-26 06:16:12'),
(7, 4, 'Sports', NULL, '2018-01-26 06:23:39', '2018-01-26 06:23:39'),
(8, 4, 'Skill ', NULL, '2018-01-26 06:23:57', '2018-01-26 06:23:57'),
(9, 4, 'Exam', NULL, '2018-01-26 06:26:00', '2018-01-26 06:26:00'),
(10, 5, 'exp1', NULL, '2018-05-27 06:41:13', '2018-05-27 06:41:13'),
(11, 1, '', NULL, '2018-11-01 10:18:55', '2018-11-01 10:18:55');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories2`
--

CREATE TABLE `subcategories2` (
  `subcategory2_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `subcategory_title2` varchar(200) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategories2`
--

INSERT INTO `subcategories2` (`subcategory2_id`, `subcategory_id`, `subcategory_title2`, `created_by`, `created_date`, `modify_date`) VALUES
(1, 3, 'Galaxy Series', NULL, '2018-01-29 09:26:29', '2018-01-29 09:26:29'),
(2, 7, 'Outdoor', NULL, '2018-02-02 17:32:17', '2018-02-02 17:32:17'),
(3, 7, 'Indoor', NULL, '2018-02-02 17:32:37', '2018-02-02 17:32:37'),
(4, 1, 'Voltas', NULL, '2018-04-20 17:33:56', '2018-04-20 17:38:53'),
(5, 10, 'exp2', NULL, '2018-05-27 06:41:54', '2018-05-27 06:41:54');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories3`
--

CREATE TABLE `subcategories3` (
  `subcategory3_id` int(11) NOT NULL,
  `subcategory2_id` int(11) NOT NULL,
  `subcategory_title3` varchar(200) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategories3`
--

INSERT INTO `subcategories3` (`subcategory3_id`, `subcategory2_id`, `subcategory_title3`, `created_by`, `created_date`, `modify_date`) VALUES
(1, 1, 'Y Series', NULL, '2018-01-29 09:26:50', '2018-01-29 09:26:50'),
(2, 4, '1 TON', NULL, '2018-04-20 17:34:13', '2018-04-20 17:40:11');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories4`
--

CREATE TABLE `subcategories4` (
  `subcategory4_id` int(11) NOT NULL,
  `subcategory3_id` int(11) NOT NULL,
  `subcategory_title4` varchar(200) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategories4`
--

INSERT INTO `subcategories4` (`subcategory4_id`, `subcategory3_id`, `subcategory_title4`, `created_by`, `created_date`, `modify_date`) VALUES
(1, 2, '3 Star power', NULL, '2018-04-20 17:34:35', '2018-04-20 17:41:18');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories5`
--

CREATE TABLE `subcategories5` (
  `subcategory5_id` int(11) NOT NULL,
  `subcategory4_id` int(11) NOT NULL,
  `subcategory_title5` varchar(200) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `contact_number` varchar(200) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `profile_image` varchar(200) DEFAULT NULL,
  `seller_tinNo` varchar(255) DEFAULT NULL,
  `seller_companyName` varchar(200) DEFAULT NULL,
  `seller_usp` varchar(255) DEFAULT NULL,
  `seller_secondary_name` varchar(200) DEFAULT NULL,
  `seller_secondary_contact` varchar(200) DEFAULT NULL,
  `seller_secondary_email` varchar(200) DEFAULT NULL,
  `account_number` varchar(30) DEFAULT NULL,
  `ac_holder_name` varchar(255) DEFAULT NULL,
  `ifsc` varchar(15) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `paytm_no` varchar(15) DEFAULT NULL,
  `user_type` varchar(200) DEFAULT NULL,
  `notify_status` varchar(255) DEFAULT 'false',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `lastName`, `age`, `email`, `contact_number`, `address`, `location`, `zipcode`, `profile_image`, `seller_tinNo`, `seller_companyName`, `seller_usp`, `seller_secondary_name`, `seller_secondary_contact`, `seller_secondary_email`, `account_number`, `ac_holder_name`, `ifsc`, `bank_name`, `paytm_no`, `user_type`, `notify_status`, `created_date`, `modify_date`) VALUES
(1, 'Atinder', '', NULL, 'atinder.singh13@gmail.com', '918800685443', 'Dugri', 'Chaukiman, Punjab, India', '141012', '1516277673.jpg', 'Gst123', 'Urban Ladder', 'we Provide Bulk Discount', '', '', '', '12345324', 'Atinder', 'sj3jh', 'INdusind', '23', 'Seller', 'false', '2018-01-18 10:12:02', '2018-09-18 12:48:12'),
(2, 'Pawan', 'Gulati', 23, 'pawan11.gulati@zabius.com', '12312312', NULL, 'Model Town, New Delhi, Delhi, India', '141001', '1535102245green.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12', 'User', 'false', '2018-01-18 10:17:40', '2018-08-24 10:26:12'),
(3, 'arun', NULL, 23, 'test@test.com', '9041176773', NULL, 'ldh', '121234', '151627354715.34.08.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'User', 'false', '2018-01-18 11:05:47', '2018-01-18 11:07:00'),
(4, 'mandeep', 'kaur', 23, 'mandeepkaurjandu@gmail.com', '911234567890', NULL, 'LDA Colony, Lucknow, Uttar Pradesh, India', '123456', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'User', 'false', '2018-01-18 11:14:35', '2018-01-18 11:14:35'),
(5, 'Bhupendra', 'Pandey', 32, 'bhu.bhupendra@gmail.com', '919867893491', NULL, 'Etawah, Uttar Pradesh, India', '201301', '1529489178.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'User', 'true', '2018-01-19 12:43:33', '2018-06-20 10:06:18'),
(6, 'Sonic', 'pcte', 28, 'atinder@zabius.com', '918437818686', '', 'Yamuna Nagar, Haryana, India', '141013', '1516503547.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '1342314', 'Atinder', '21w2sdf', 'SBIsdf', '42378', 'User', 'false', '2018-01-21 02:59:07', '2018-08-08 12:52:50'),
(8, 'Anuj', 'Srivastava', 33, 'anujmmm@gmail.com', '9717480123', NULL, 'palladians society park, Sector 47, Gurugram, Haryana, India', '122018', '1516949655.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'User', 'false', '2018-01-21 03:16:07', '2018-01-27 09:14:30'),
(9, 'Anuj', '', NULL, 'anuj.mmm123@gmail.com', '919873910610', NULL, 'Baani Square, Block N, Gurugram, Haryana, India', '122018', '', '1213', 'A1 pvt ltd', 'We provide connercial space in property', '', '', '', NULL, NULL, NULL, NULL, NULL, 'Seller', 'true', '2018-01-21 05:27:37', '2018-01-26 07:16:08'),
(10, 'Jasdeep', 'kaur', 25, 'jasdeep0610@gmail.com', '919654239615', NULL, 'Najafgarh, New Delhi, Delhi, India', '110043', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'User', 'false', '2018-01-21 10:12:48', '2018-01-21 10:12:48'),
(11, 'Jasdeep Kaur', '', NULL, 'kaurjasdeep06@ymail.com', '919654816615', NULL, 'Najafgarh, New Delhi, Delhi, India', '110043', '', '666666', 'JJJ', 'Furniture Showroom', 'Harpreet Singh', '9654239615', '', NULL, NULL, NULL, NULL, NULL, 'Seller', 'false', '2018-01-21 10:38:13', '2018-01-21 10:38:13'),
(12, 'manpreet', 'Singh', 23, 'manpreet@zabius.con', '918591222555', NULL, 'Ludhiana, Punjab, India', '141003', '1516687928.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'User', 'false', '2018-01-23 06:12:08', '2018-01-23 06:12:08'),
(13, 'sandeep', 'pathak', 24, 'sandeep.netdev@live.com', '917643198564', NULL, 'Dugri, Ludhiana, Punjab, India', '141013', '1516688067.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'User', 'false', '2018-01-23 06:14:27', '2018-01-23 06:14:27'),
(14, 'Manpreet', 'Singh', 23, 'manpreet@zabius.com', '918591222522', NULL, 'Ludhiana, Punjab, India', '141003', '1516688218.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'User', 'false', '2018-01-23 06:16:58', '2018-02-19 06:01:28'),
(15, 'aanchal', 'srivastava', 30, 'aanchal001@gmail.com', '919711973090', NULL, 'Gurugram, Haryana, India', '122018', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'User', 'false', '2018-01-26 06:32:03', '2018-01-26 06:32:03'),
(16, 'bhupendra', '', NULL, 'bhup@outlook.com', '919867893497', NULL, 'Noida, Uttar Pradesh, India', '201309', '', 'adbhdj', 'brian booster', 'seller', '', '', '', NULL, NULL, NULL, NULL, NULL, 'Seller', 'false', '2018-01-26 07:02:25', '2018-01-26 07:02:25'),
(17, 'sandeep', 'pathak', 28, 'sandeep@zabius.com', '911478523695', NULL, 'Delhi, India', 'shsh', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'User', 'false', '2018-01-26 07:19:22', '2018-01-26 07:19:22'),
(18, 'mukesh', 'barua', 31, 'mukeshbarua@gmail.com', '918126265330', NULL, 'Etawah, Uttar Pradesh, India', '206001', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'User', 'false', '2018-01-27 04:42:59', '2018-01-27 04:42:59'),
(19, 'anij', 'kunar', 36, 'anujmmm1@gmail.com', '919717480123', NULL, 'Delhi, India', '111100', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'User', 'false', '2018-01-27 09:12:47', '2018-01-27 09:12:47'),
(20, 'Aanchal', '', NULL, 'aanchal.srivas@gmail.com', '919757424947', NULL, 'Malibu town', '122018', '', 'Bbb', '123', 'Hyundai cars', 'anuj', '9711973090', 'aanchal_mmmec@yahoo.com', NULL, NULL, NULL, NULL, NULL, 'Seller', 'false', '2018-01-29 10:23:58', '2018-01-29 10:23:58'),
(21, 'anupam', 'majumdar', 28, 'anupam@ebabu.co', '918770525920', NULL, 'Indore, Madhya Pradesh, India', '452001', '1528275033.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'User', 'false', '2018-06-06 08:50:33', '2018-06-06 08:50:33'),
(22, 'PawaN', NULL, 11, 'dummy@email.com', '111234567890', NULL, 'PHILLAUR', '12312', '1529472429ic_logo.png', NULL, NULL, NULL, 'sadf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'User', 'false', '2018-06-20 05:27:09', '2018-08-24 06:22:31'),
(23, 'asdf', 'ghijkll', NULL, 'asd@sad.asf', '913434343434', 'sas nagar', 'A S D F a S F, Sagebrush Terrace, Laurel, MD, USA', 'asdf', '', 'asdf', 'sadf', 'asdf', 'asdasdasd', 'asdf', '', '1234567890', 'mitin', 'utc000789', 'Axis', '132123123123123', 'Seller', 'false', '2018-08-07 05:14:17', '2018-08-24 06:24:12'),
(26, 'Gurpreet Singh', '', NULL, 'gurpreet.singh@zabius.com', '918591293031', 'sas nagar', 'Ludhiana, Kamla Nehru Market, Old Ludhiana, Ludhiana, Punjab, India', 'asdf', '1533624050.jpg', 'sdaf', 'Zabius', 'asdf', '', '', '', '2387498723849', 'Gurpreet singh', 'asdf', 'IndusInd Bank', 'asdf', 'Seller', 'false', '2018-08-07 06:40:50', '2018-08-07 06:42:28'),
(27, 'Manpreet', 'Singh', 25, 'pawan@zabius.com', '918593847463', NULL, 'Ludhiana, Punjab, India', '144103', '', NULL, NULL, NULL, NULL, NULL, NULL, '234245452345', 'Manpreet Singh', '12jk21', 'IndusInd', '212452', 'User', 'false', '2018-08-07 09:49:29', '2018-08-07 09:49:29'),
(28, 'Pawan', 'Gulati', 25, 'pawan.zabius@gmail.com', '917684948763', '', 'Ludhiana, Punjab, India', '247474', '1533638336.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '782798475555', 'Pawan gulati', 's3ks555', 'IndusInd', '234555', 'User', 'false', '2018-08-07 10:38:56', '2018-08-07 13:23:45'),
(29, 'mitin', 'dixit', 26, 'mitin.dixit@gmail.com', '917065380958', NULL, 'Lucknow, Uttar Pradesh, India', '226004', '', NULL, NULL, NULL, NULL, NULL, NULL, '1234567890', 'mitin', 'utc000789', 'Axis', '', 'User', 'false', '2018-08-22 05:39:09', '2018-08-22 05:39:09'),
(30, 'Pawan Gulati', NULL, NULL, 'pawan1.gulati@zabius.com', '9112312312', 'ludhiana', 'Ludhiana, Kamla Nehru Market, Old Ludhiana, Ludhiana, Punjab, India', '12112', '1535094585download.jpg', '4546465', 'Zabius', '58464654', 'abcd', '12345678901', 'pawan2.gulati@zabius.com', '123412321123123', 'Pawan1', '14784ab', 'ABCD', '2133', 'Seller', 'false', '2018-08-24 07:09:45', '2018-08-24 10:18:46'),
(31, 'Pawan Gulati', NULL, 23, 'pawan.gulati@zabius.com', '9121231', NULL, 'Ludhiana, Kamla Nehru Market, Old Ludhiana, Ludhiana, Punjab, India', '141001', '1535102298download.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7894', 'Seller', 'false', '2018-08-24 09:18:18', '2018-08-24 12:18:34'),
(32, 'preet', 'goldy', 23, 'alskfd@lksdjf.co', '912337473732', NULL, 'Lucknow, Uttar Pradesh, India', '13i3e', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'User', 'false', '2018-09-18 07:45:17', '2018-09-18 07:45:17'),
(33, 'Sandeep', 'Singh', 35, 'sandeep@zabius.co', '914657890394', 'nsdf r4 bnmmmmn', 'Ludhiana, Punjab, India', '141003', '1538046011.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'User', 'false', '2018-09-27 10:51:09', '2018-09-27 11:00:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `join_status` int(11) NOT NULL,
  `user_favourite` int(11) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `user_id`, `group_id`, `join_status`, `user_favourite`, `created_by`, `created_date`, `modify_date`) VALUES
(1, 2, 1, 1, 0, 2, '2018-01-18 10:27:35', '2018-01-18 10:27:35'),
(2, 3, 1, 1, 1, 3, '2018-01-18 11:07:52', '2018-01-18 11:07:56'),
(3, 5, 1, 0, 0, 5, '2018-01-19 12:45:02', '2018-01-27 09:40:48'),
(4, 5, 2, 1, 0, 5, '2018-01-21 03:38:16', '2018-01-21 03:38:16'),
(5, 5, 3, 1, 0, 5, '2018-01-21 03:38:24', '2018-01-21 03:38:24'),
(6, 5, 4, 1, 0, 5, '2018-01-21 03:38:36', '2018-01-21 03:38:36'),
(7, 5, 5, 1, 0, 5, '2018-01-21 03:38:47', '2018-01-21 03:38:47'),
(8, 5, 6, 1, 0, 5, '2018-01-21 03:47:05', '2018-01-21 03:47:05'),
(9, 5, 7, 1, 0, 5, '2018-01-21 03:47:16', '2018-01-21 03:47:16'),
(10, 5, 8, 1, 0, 5, '2018-01-21 03:47:25', '2018-01-21 03:47:25'),
(11, 5, 9, 1, 0, 5, '2018-01-21 03:47:33', '2018-01-21 03:47:33'),
(12, 5, 10, 1, 0, 5, '2018-01-21 04:08:48', '2018-01-27 10:22:42'),
(13, 5, 11, 1, 0, 5, '2018-01-21 04:24:11', '2018-01-21 04:24:11'),
(14, 8, 12, 1, 0, 8, '2018-01-21 04:49:04', '2018-01-21 05:04:08'),
(15, 6, 1, 1, 1, 6, '2018-01-21 05:03:48', '2018-01-21 05:14:33'),
(16, 6, 12, 1, 0, 6, '2018-01-21 05:04:44', '2018-01-21 05:04:44'),
(18, 8, 1, 1, 1, 8, '2018-01-21 05:05:47', '2018-01-21 05:05:55'),
(19, 6, 13, 1, 0, 6, '2018-01-21 05:08:07', '2018-01-21 05:08:07'),
(20, 5, 14, 1, 0, 5, '2018-01-21 05:08:07', '2018-01-27 10:23:00'),
(21, 6, 15, 1, 0, 6, '2018-01-21 05:19:03', '2018-01-21 05:19:03'),
(22, 5, 15, 1, 1, 5, '2018-01-21 05:20:26', '2018-01-21 05:22:24'),
(23, 8, 14, 0, 0, 8, '2018-01-21 05:21:06', '2018-01-27 10:40:29'),
(24, 10, 15, 1, 0, 10, '2018-01-21 10:23:53', '2018-01-21 10:23:53'),
(26, 5, 16, 1, 0, 5, '2018-01-26 06:40:22', '2018-01-26 06:40:22'),
(27, 15, 16, 1, 0, 15, '2018-01-26 07:33:16', '2018-01-26 07:33:16'),
(29, 17, 16, 1, 0, 17, '2018-01-26 07:56:36', '2018-01-26 07:56:36'),
(30, 5, 17, 1, 0, 5, '2018-01-26 13:41:37', '2018-01-26 13:41:37'),
(31, 18, 18, 1, 0, 18, '2018-01-27 04:57:30', '2018-01-27 04:57:30'),
(32, 18, 17, 1, 0, 18, '2018-01-27 04:58:23', '2018-01-27 04:58:23'),
(33, 5, 18, 1, 0, 5, '2018-01-27 09:16:37', '2018-01-27 09:16:37'),
(34, 8, 19, 1, 1, 8, '2018-01-27 09:39:08', '2018-01-27 10:22:19'),
(35, 5, 19, 0, 0, 5, '2018-01-27 10:09:07', '2018-01-27 10:47:30'),
(36, 8, 20, 1, 0, 8, '2018-01-27 10:34:04', '2018-01-27 10:34:04'),
(37, 8, 21, 1, 0, 8, '2018-01-27 10:34:19', '2018-01-27 10:34:19'),
(38, 8, 15, 1, 0, 8, '2018-01-27 10:45:36', '2018-01-27 10:45:36'),
(39, 8, 18, 1, 1, 8, '2018-01-27 10:48:31', '2018-02-23 05:24:09'),
(40, 8, 10, 0, 0, 8, '2018-01-27 10:50:08', '2018-01-27 10:57:45'),
(41, 10, 22, 1, 0, 10, '2018-01-27 11:00:58', '2018-01-27 11:00:58'),
(42, 10, 23, 1, 0, 10, '2018-01-27 11:01:03', '2018-01-27 11:01:03'),
(43, 10, 24, 1, 0, 10, '2018-01-27 11:01:14', '2018-01-27 11:01:14'),
(44, 10, 25, 1, 0, 10, '2018-01-27 11:01:22', '2018-01-27 11:01:22'),
(45, 10, 26, 1, 0, 10, '2018-01-27 11:01:35', '2018-01-27 11:01:35'),
(46, 10, 27, 1, 0, 10, '2018-01-27 11:01:50', '2018-01-27 11:01:50'),
(47, 10, 28, 1, 0, 10, '2018-01-27 11:01:58', '2018-01-27 11:01:58'),
(48, 10, 29, 1, 0, 10, '2018-01-27 11:02:28', '2018-01-27 11:02:28'),
(49, 10, 30, 1, 0, 10, '2018-01-27 11:12:54', '2018-01-27 11:12:54'),
(50, 10, 31, 1, 0, 10, '2018-01-27 11:13:02', '2018-01-27 11:13:02'),
(51, 10, 32, 1, 0, 10, '2018-01-27 11:13:29', '2018-01-27 11:13:29'),
(52, 10, 33, 1, 0, 10, '2018-01-27 11:13:49', '2018-01-27 11:13:49'),
(53, 8, 34, 1, 0, 8, '2018-01-27 11:16:05', '2018-01-27 11:16:05'),
(54, 8, 35, 1, 0, 8, '2018-01-27 11:16:16', '2018-01-27 11:16:16'),
(55, 8, 36, 1, 0, 8, '2018-01-27 11:16:35', '2018-01-27 11:16:35'),
(56, 5, 37, 1, 0, 5, '2018-01-27 11:32:55', '2018-01-27 11:32:55'),
(57, 18, 19, 0, 0, 18, '2018-01-31 08:11:15', '2018-01-31 08:12:22'),
(58, 5, 22, 1, 0, 5, '2018-02-02 17:54:20', '2018-02-02 17:54:20'),
(59, 5, 23, 1, 0, 5, '2018-02-02 17:55:32', '2018-02-02 17:55:32'),
(60, 5, 24, 1, 0, 5, '2018-02-02 17:55:56', '2018-02-02 17:55:56'),
(61, 5, 25, 1, 0, 5, '2018-02-02 17:56:09', '2018-02-02 17:56:09'),
(62, 5, 26, 1, 0, 5, '2018-02-02 17:57:04', '2018-02-02 17:57:04'),
(63, 5, 27, 1, 0, 5, '2018-02-03 04:39:26', '2018-02-03 04:39:26'),
(64, 5, 28, 1, 0, 5, '2018-02-03 04:39:55', '2018-02-03 04:39:55'),
(65, 5, 29, 1, 0, 5, '2018-02-03 04:45:57', '2018-02-03 04:45:57'),
(66, 5, 30, 1, 0, 5, '2018-02-03 04:47:27', '2018-02-03 04:47:27'),
(67, 5, 31, 1, 0, 5, '2018-02-03 04:47:45', '2018-02-03 04:47:45'),
(68, 5, 32, 1, 0, 5, '2018-02-03 04:48:12', '2018-02-03 04:48:12'),
(69, 5, 33, 1, 0, 5, '2018-02-03 17:13:39', '2018-02-03 17:13:39'),
(70, 5, 34, 1, 0, 5, '2018-02-03 17:13:51', '2018-02-03 17:13:51'),
(71, 6, 18, 1, 0, 6, '2018-02-07 05:16:24', '2018-03-07 13:04:27'),
(72, 14, 35, 1, 0, 14, '2018-02-19 06:30:57', '2018-02-19 06:30:57'),
(73, 14, 36, 1, 0, 14, '2018-02-19 06:31:02', '2018-02-19 06:31:02'),
(74, 14, 37, 1, 0, 14, '2018-02-19 06:31:06', '2018-02-19 06:31:06'),
(75, 14, 38, 1, 0, 14, '2018-02-19 06:31:16', '2018-02-19 06:31:16'),
(76, 14, 39, 1, 0, 14, '2018-02-19 06:32:17', '2018-02-19 06:32:17'),
(77, 14, 12, 0, 0, 14, '2018-02-19 07:35:23', '2018-02-21 06:27:23'),
(78, 8, 40, 1, 0, 8, '2018-02-20 05:01:49', '2018-02-20 05:01:49'),
(79, 8, 41, 1, 0, 8, '2018-02-20 05:02:01', '2018-02-20 05:02:01'),
(80, 8, 42, 1, 0, 8, '2018-02-23 05:14:07', '2018-02-23 05:14:07'),
(81, 8, 43, 1, 0, 8, '2018-02-23 05:14:22', '2018-02-23 05:14:22'),
(82, 8, 44, 1, 0, 8, '2018-02-23 05:14:36', '2018-02-23 05:14:36'),
(83, 8, 45, 1, 0, 8, '2018-02-23 05:14:43', '2018-02-23 05:14:43'),
(84, 8, 46, 1, 0, 8, '2018-02-23 05:14:55', '2018-02-23 05:14:55'),
(85, 14, 47, 1, 0, 14, '2018-02-23 06:38:23', '2018-02-23 06:38:23'),
(86, 14, 48, 1, 0, 14, '2018-02-23 06:39:28', '2018-02-23 06:39:28'),
(87, 14, 1001, 1, 0, 14, '2018-02-23 06:42:30', '2018-02-23 06:42:30'),
(88, 6, 1002, 1, 1, 6, '2018-02-23 06:57:35', '2018-02-23 07:47:41'),
(89, 14, 1003, 1, 0, 14, '2018-02-23 06:59:15', '2018-02-23 06:59:15'),
(90, 14, 1004, 1, 0, 14, '2018-02-23 07:04:18', '2018-02-23 07:04:18'),
(91, 14, 1005, 1, 0, 14, '2018-02-23 07:12:58', '2018-02-23 07:12:58'),
(92, 6, 1001, 1, 0, 6, '2018-02-23 07:43:14', '2018-02-23 09:29:44'),
(93, 6, 1006, 1, 0, 6, '2018-02-23 08:07:00', '2018-02-23 08:07:00'),
(94, 14, 1002, 1, 1, 14, '2018-02-23 09:28:20', '2018-02-26 13:25:58'),
(95, 14, 1007, 1, 0, 14, '2018-02-23 09:50:06', '2018-02-23 09:50:06'),
(96, 5, 1003, 1, 0, 5, '2018-03-22 12:27:30', '2018-03-25 11:29:50'),
(97, 5, 1008, 1, 0, 5, '2018-03-25 09:34:48', '2018-03-25 11:13:02'),
(98, 8, 1009, 1, 0, 8, '2018-03-25 09:37:51', '2018-03-25 09:37:51'),
(99, 8, 1008, 0, 0, 8, '2018-03-25 09:51:02', '2018-03-25 11:29:16'),
(100, 5, 1010, 1, 0, 5, '2018-03-25 10:01:48', '2018-03-25 10:01:48'),
(101, 5, 1007, 1, 0, 5, '2018-03-25 10:38:48', '2018-03-25 10:40:55'),
(102, 8, 1011, 1, 0, 8, '2018-03-25 10:48:52', '2018-03-25 10:48:52'),
(103, 5, 1006, 0, 0, 5, '2018-03-25 11:13:22', '2018-03-25 11:13:27'),
(104, 8, 1003, 0, 1, 8, '2018-03-25 11:17:03', '2018-05-22 11:07:53'),
(105, 8, 1006, 1, 0, 8, '2018-03-25 11:21:43', '2018-03-25 11:21:43'),
(106, 6, 1003, 0, 0, 6, '2018-03-29 09:24:15', '2018-05-24 07:59:19'),
(107, 8, 1007, 1, 1, 8, '2018-04-06 18:19:53', '2018-05-21 17:38:40'),
(108, 8, 1012, 1, 0, 8, '2018-05-21 17:41:28', '2018-05-21 17:41:28'),
(109, 5, 1013, 1, 0, 5, '2018-05-21 17:42:03', '2018-05-21 17:42:03'),
(110, 8, 1014, 1, 0, 8, '2018-05-21 17:46:42', '2018-05-21 17:46:42'),
(111, 8, 1015, 1, 0, 8, '2018-05-22 10:47:11', '2018-05-22 10:47:11'),
(112, 5, 1015, 0, 0, 5, '2018-05-22 11:03:37', '2018-05-22 11:05:32'),
(113, 5, 1012, 1, 0, 5, '2018-05-22 11:11:31', '2018-05-22 11:11:31'),
(114, 6, 1017, 1, 0, 6, '2018-05-23 06:29:23', '2018-05-23 06:29:23'),
(115, 6, 1018, 1, 0, 6, '2018-05-24 11:55:55', '2018-05-24 11:55:55'),
(116, 14, 1019, 1, 0, 14, '2018-05-25 05:47:14', '2018-05-25 05:47:14'),
(117, 14, 17, 1, 0, 14, '2018-05-25 06:23:01', '2018-05-30 11:21:36'),
(118, 8, 17, 0, 1, 8, '2018-05-26 18:59:17', '2018-05-27 06:32:23'),
(119, 6, 17, 0, 1, 6, '2018-05-27 05:49:23', '2018-05-31 02:21:49'),
(120, 6, 1020, 1, 0, 6, '2018-05-31 02:23:46', '2018-05-31 02:23:46'),
(121, 6, 1021, 1, 0, 6, '2018-06-20 06:56:20', '2018-06-20 06:56:20'),
(122, 5, 1021, 1, 0, 5, '2018-06-20 07:30:08', '2018-06-20 07:30:08'),
(123, 5, 1020, 1, 1, 5, '2018-06-20 07:31:20', '2018-06-21 07:48:07'),
(124, 5, 1022, 1, 0, 5, '2018-06-20 10:09:31', '2018-06-20 10:09:31'),
(125, 5, 1023, 1, 0, 5, '2018-06-20 10:10:01', '2018-06-20 10:10:01'),
(126, 14, 1020, 1, 0, 14, '2018-06-20 10:14:30', '2018-06-27 14:21:02'),
(127, 14, 1024, 1, 0, 14, '2018-06-22 09:34:43', '2018-06-22 09:34:43'),
(134, 6, 1024, 1, 0, 6, '2018-06-22 10:11:41', '2018-09-07 10:06:27'),
(135, 6, 1025, 1, 0, 6, '2018-06-22 11:41:33', '2018-06-22 11:41:33'),
(136, 14, 1025, 0, 0, 14, '2018-06-22 11:42:16', '2018-06-22 12:59:25'),
(137, 14, 1021, 0, 0, 14, '2018-06-27 14:21:03', '2018-06-27 14:21:05'),
(138, 5, 1024, 1, 0, 5, '2018-08-18 11:14:35', '2018-08-18 11:14:35'),
(139, 8, 1024, 0, 1, 8, '2018-09-02 17:13:58', '2018-09-02 17:13:58'),
(140, 14, 1026, 1, 1, 14, '2018-09-18 11:55:38', '2018-09-21 09:59:38'),
(141, 14, 1027, 1, 0, 14, '2018-09-18 12:00:50', '2018-09-18 12:00:50'),
(142, 14, 1028, 1, 0, 14, '2018-09-18 12:02:50', '2018-09-18 12:02:50'),
(143, 14, 1029, 1, 0, 14, '2018-09-18 12:05:26', '2018-09-18 12:05:26'),
(144, 14, 1030, 1, 0, 14, '2018-09-18 12:09:05', '2018-09-18 12:09:05'),
(145, 6, 1026, 1, 0, 6, '2018-09-18 12:40:17', '2018-09-18 12:40:17'),
(146, 14, 1031, 1, 0, 14, '2018-09-20 04:36:30', '2018-09-20 04:36:30'),
(147, 14, 1032, 1, 0, 14, '2018-09-21 09:48:51', '2018-09-21 09:48:51'),
(148, 33, 1033, 1, 0, 33, '2018-10-01 11:56:54', '2018-10-01 11:56:54'),
(149, 33, 1034, 1, 0, 33, '2018-10-01 12:00:45', '2018-10-01 12:00:45'),
(150, 33, 1035, 1, 0, 33, '2018-10-01 12:27:48', '2018-10-01 12:27:48'),
(151, 33, 1036, 1, 0, 33, '2018-10-01 12:34:31', '2018-10-01 12:34:31'),
(152, 33, 1037, 1, 0, 33, '2018-10-01 12:34:57', '2018-10-01 12:34:57'),
(153, 14, 1033, 1, 0, 14, '2018-10-01 12:39:40', '2018-10-01 12:39:40'),
(154, 14, 1034, 1, 0, 14, '2018-10-01 12:40:36', '2018-10-01 12:40:36'),
(155, 14, 1038, 1, 0, 14, '2018-10-01 12:42:32', '2018-10-01 12:42:32'),
(156, 14, 1039, 1, 0, 14, '2018-10-03 06:35:34', '2018-10-03 06:35:34');

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `advertisement_id` int(11) NOT NULL,
  `Favorites_ads` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`id`, `user_id`, `advertisement_id`, `Favorites_ads`, `created_by`, `created_date`, `modify_date`) VALUES
(7, 14, 4, 0, 14, '2018-05-30 11:51:37', '2018-05-30 11:51:37'),
(8, 14, 1, 0, 14, '2018-05-30 11:52:03', '2018-05-30 11:52:03'),
(9, 14, 11, 0, 14, '2018-05-30 11:52:44', '2018-05-30 11:52:44'),
(11, 6, 1, 1, 6, '2018-05-31 02:20:38', '2018-08-20 05:46:42'),
(12, 6, 11, 0, 6, '2018-05-31 02:20:44', '2018-05-31 02:20:44'),
(13, 5, 22, 0, 5, '2018-05-31 05:09:26', '2018-05-31 05:09:26'),
(14, 5, 1, 0, 5, '2018-05-31 05:10:30', '2018-05-31 05:10:30'),
(15, 8, 11, 0, 8, '2018-05-31 07:23:28', '2018-05-31 07:23:28'),
(16, 8, 9, 0, 8, '2018-05-31 07:23:42', '2018-05-31 07:23:42'),
(17, 8, 2, 0, 8, '2018-05-31 07:23:53', '2018-08-27 11:13:23'),
(18, 14, 22, 0, 14, '2018-06-03 07:11:16', '2018-06-03 07:11:16'),
(19, 14, 2, 0, 14, '2018-06-06 06:25:39', '2018-09-21 09:59:33'),
(20, 21, 2, 0, 21, '2018-06-06 08:51:56', '2018-06-06 08:51:56'),
(21, 6, 2, 1, 6, '2018-06-07 08:53:31', '2018-08-08 10:38:37'),
(22, 5, 2, 0, 5, '2018-06-07 11:59:47', '2018-06-07 11:59:47'),
(23, 6, 12, 0, 6, '2018-06-20 06:58:47', '2018-08-21 08:59:28'),
(24, 5, 12, 0, 5, '2018-06-20 07:36:08', '2018-06-20 07:36:08'),
(25, 5, 17, 1, 5, '2018-06-20 07:37:19', '2018-08-25 09:15:26'),
(26, 14, 12, 0, 14, '2018-06-20 10:12:23', '2018-06-20 10:12:23'),
(27, 8, 12, 0, 8, '2018-06-21 06:24:16', '2018-06-21 06:24:16'),
(28, 14, 17, 1, 14, '2018-06-22 05:04:01', '2018-06-22 05:04:01'),
(29, 8, 17, 0, 8, '2018-07-23 14:38:00', '2018-07-23 14:38:00'),
(30, 6, 17, 1, 6, '2018-08-08 10:22:59', '2018-08-21 08:59:13'),
(31, 6, 29, 1, 6, '2018-08-08 10:30:51', '2018-08-08 10:38:38'),
(32, 5, 29, 0, 5, '2018-08-11 14:25:15', '2018-08-11 14:25:15'),
(33, 6, 22, 0, 6, '2018-08-20 12:57:50', '2018-08-21 12:49:19'),
(34, 29, 8, 0, 29, '2018-08-22 05:40:39', '2018-08-22 05:40:39'),
(35, 29, 17, 0, 29, '2018-08-22 05:41:17', '2018-08-22 05:41:17'),
(36, 8, 22, 1, 8, '2018-08-25 09:18:00', '2018-09-02 17:13:59'),
(37, 8, 1, 1, 8, '2018-08-25 09:45:24', '2018-08-25 09:45:24'),
(38, 5, 5, 0, 5, '2018-08-25 09:55:32', '2018-08-25 09:55:32'),
(39, 6, 13, 0, 6, '2018-09-07 13:59:17', '2018-09-07 13:59:17'),
(40, 1, 1, 0, 1, '2018-09-18 05:58:34', '2018-09-18 05:58:34'),
(41, 14, 5, 0, 14, '2018-09-18 11:40:03', '2018-09-18 11:40:03'),
(42, 1, 22, 0, 1, '2018-09-21 10:04:40', '2018-09-21 10:04:40'),
(43, 33, 2, 1, 33, '2018-09-27 11:38:14', '2018-10-01 11:18:34'),
(44, 33, 12, 0, 33, '2018-09-27 12:25:19', '2018-09-27 12:25:19'),
(45, 33, 5, 0, 33, '2018-09-27 12:25:43', '2018-09-27 12:25:43'),
(46, 33, 13, 0, 33, '2018-09-27 12:32:54', '2018-09-27 12:32:54'),
(47, 33, 29, 0, 33, '2018-10-01 11:19:36', '2018-10-01 11:19:36'),
(48, 33, 22, 0, 33, '2018-10-01 11:30:37', '2018-10-01 11:30:37'),
(49, 1, 12, 0, 1, '2018-10-01 12:04:25', '2018-10-01 12:04:25'),
(50, 33, 8, 0, 33, '2018-10-01 12:17:21', '2018-10-01 12:17:21'),
(51, 1, 5, 0, 1, '2018-10-01 12:37:24', '2018-10-01 12:37:24'),
(52, 14, 29, 0, 14, '2018-10-01 13:03:40', '2018-10-01 13:03:40'),
(53, 1, 9, 0, 1, '2018-10-03 09:23:30', '2018-10-03 09:23:30'),
(54, 1, 13, 0, 1, '2018-10-04 07:48:35', '2018-10-04 07:48:35'),
(55, 17, 2, 0, 17, '2018-10-04 09:21:44', '2018-10-04 09:21:44'),
(56, 1, 29, 0, 1, '2018-10-11 07:10:02', '2018-10-11 07:10:02'),
(57, 17, 29, 0, 17, '2019-01-03 06:06:44', '2019-01-03 06:06:44'),
(58, 2, 29, 0, 2, '2019-01-03 07:02:39', '2019-01-03 07:02:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`advertisement_id`);

--
-- Indexes for table `advertisements_images`
--
ALTER TABLE `advertisements_images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `advertisement_liked`
--
ALTER TABLE `advertisement_liked`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `advertisement_statics`
--
ALTER TABLE `advertisement_statics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `group_advertisements`
--
ALTER TABLE `group_advertisements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `push_notification`
--
ALTER TABLE `push_notification`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `report_advertisements`
--
ALTER TABLE `report_advertisements`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`subcategory_id`);

--
-- Indexes for table `subcategories2`
--
ALTER TABLE `subcategories2`
  ADD PRIMARY KEY (`subcategory2_id`);

--
-- Indexes for table `subcategories3`
--
ALTER TABLE `subcategories3`
  ADD PRIMARY KEY (`subcategory3_id`);

--
-- Indexes for table `subcategories4`
--
ALTER TABLE `subcategories4`
  ADD PRIMARY KEY (`subcategory4_id`);

--
-- Indexes for table `subcategories5`
--
ALTER TABLE `subcategories5`
  ADD PRIMARY KEY (`subcategory5_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `advertisement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `advertisements_images`
--
ALTER TABLE `advertisements_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `advertisement_liked`
--
ALTER TABLE `advertisement_liked`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `advertisement_statics`
--
ALTER TABLE `advertisement_statics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1040;
--
-- AUTO_INCREMENT for table `group_advertisements`
--
ALTER TABLE `group_advertisements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=302;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;
--
-- AUTO_INCREMENT for table `push_notification`
--
ALTER TABLE `push_notification`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;
--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `report_advertisements`
--
ALTER TABLE `report_advertisements`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `subcategories2`
--
ALTER TABLE `subcategories2`
  MODIFY `subcategory2_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `subcategories3`
--
ALTER TABLE `subcategories3`
  MODIFY `subcategory3_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `subcategories4`
--
ALTER TABLE `subcategories4`
  MODIFY `subcategory4_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `subcategories5`
--
ALTER TABLE `subcategories5`
  MODIFY `subcategory5_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;
--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
