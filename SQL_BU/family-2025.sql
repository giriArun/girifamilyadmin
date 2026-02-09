-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 13, 2025 at 03:33 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

DROP TABLE IF EXISTS `family`;
CREATE TABLE IF NOT EXISTS `family` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `nickName` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `DOD` date DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `spouse_id` int(11) NOT NULL DEFAULT '0',
  `sequence` smallint(6) NOT NULL DEFAULT '1',
  `isRoot` bit(1) NOT NULL DEFAULT b'0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=124 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `family`
--

INSERT INTO `family` (`id`, `name`, `nickName`, `gender`, `DOB`, `DOD`, `parent_id`, `spouse_id`, `sequence`, `isRoot`, `created_on`, `modified_on`) VALUES
(1, 'Kanan Bala Giri', NULL, 'F', NULL, NULL, 0, 36, 1, b'0', '2022-08-28 14:33:16', '2022-09-04 09:38:11'),
(2, 'Asish Giri', 'Khokon', 'M', NULL, NULL, 36, 3, 1, b'0', '2022-08-28 14:33:57', '2022-09-04 09:38:30'),
(3, 'Ranu Giri', NULL, 'F', NULL, NULL, 0, 2, 1, b'0', '2022-08-28 14:34:15', NULL),
(4, 'Arun Giri', 'Piku', 'M', NULL, NULL, 2, 5, 1, b'0', '2022-08-28 14:34:36', '2022-09-04 12:07:47'),
(5, 'Sumita Giri', 'Mam', 'F', NULL, NULL, 0, 4, 1, b'0', '2022-08-28 14:34:53', '2022-09-04 12:08:04'),
(17, 'Pritam Giri', 'Tom', 'M', '2004-01-26', NULL, 25, 0, 1, b'0', '2022-09-03 18:25:47', '2022-09-04 09:23:05'),
(16, 'Mayna Patra Giri', NULL, 'F', '1977-01-07', NULL, 0, 25, 1, b'0', '2022-09-03 18:25:32', '2022-09-04 09:22:11'),
(15, 'Rittwika Giri', 'Mamon', 'F', NULL, NULL, 22, 0, 1, b'0', '2022-09-03 18:11:30', '2022-09-04 09:18:37'),
(14, 'Chittaranjan Giri', NULL, 'M', NULL, NULL, 0, 22, 1, b'0', '2022-09-03 18:11:12', '2022-09-04 09:16:01'),
(13, 'Yotshna Rani Giri', NULL, 'F', NULL, NULL, 0, 18, 1, b'0', '2022-09-03 18:10:45', NULL),
(18, 'Pravash Chandra Giri', NULL, 'M', NULL, NULL, 29, 13, 3, b'0', '2022-09-04 06:21:16', '2022-09-04 09:39:46'),
(19, 'Priyam Giri', NULL, 'M', '2017-05-28', NULL, 25, 0, 2, b'0', '2022-09-04 06:58:34', '2022-09-04 09:24:00'),
(20, 'Ranjan Bhuniya', NULL, 'M', NULL, NULL, 0, 23, 1, b'0', '2022-09-04 06:59:34', '2022-09-04 09:25:08'),
(21, 'Debashis Das', NULL, 'M', NULL, NULL, 0, 24, 1, b'0', '2022-09-04 06:59:46', '2022-09-04 09:26:08'),
(22, 'Papu Giri', NULL, 'F', NULL, NULL, 18, 14, 1, b'0', '2022-09-04 08:52:09', NULL),
(23, 'Rupu Giri', NULL, 'F', NULL, NULL, 18, 20, 3, b'0', '2022-09-04 08:53:14', '2022-09-04 09:13:31'),
(24, 'Lipika Giri', NULL, 'F', NULL, NULL, 18, 21, 4, b'0', '2022-09-04 08:53:47', '2022-09-04 09:13:04'),
(25, 'Pratip Kumar Giri', 'Tipu', 'M', '1972-09-22', NULL, 18, 16, 2, b'0', '2022-09-04 08:55:16', '2022-09-04 09:20:52'),
(26, 'Rishika Giri', 'Mantu', 'F', NULL, NULL, 22, 0, 2, b'0', '2022-09-04 09:19:12', NULL),
(27, 'Samriddhi Das', NULL, 'F', NULL, NULL, 24, 0, 1, b'0', '2022-09-04 09:26:44', NULL),
(28, 'Misti Das', NULL, 'F', NULL, NULL, 24, 0, 2, b'0', '2022-09-04 09:27:04', '2022-09-04 09:27:27'),
(29, 'Khagendranath Giri', 'M', 'M', NULL, NULL, 86, 30, 1, b'0', '2022-09-04 09:29:45', '2024-10-20 15:47:14'),
(30, 'Giribala Giri', NULL, 'F', NULL, NULL, 0, 29, 1, b'0', '2022-09-04 09:30:29', NULL),
(31, 'Barendranath Giri', 'M', 'M', NULL, NULL, 86, 0, 2, b'0', '2022-09-04 09:31:24', '2024-10-20 15:46:49'),
(32, 'Dhirendranath Giri', 'M', 'M', NULL, NULL, 86, 0, 3, b'0', '2022-09-04 09:31:55', '2024-10-20 15:47:28'),
(33, 'Jagadish Giri', NULL, 'M', NULL, NULL, 86, 0, 6, b'0', '2022-09-04 09:32:31', '2023-05-23 17:33:11'),
(34, 'Prafulla Ranjon Giri', NULL, 'M', NULL, NULL, 29, 35, 1, b'0', '2022-09-04 09:33:50', '2022-09-04 17:48:20'),
(35, 'Janhabi Bala Giri', NULL, 'F', NULL, NULL, 0, 34, 1, b'0', '2022-09-04 09:35:33', '2022-09-04 17:49:09'),
(36, 'Prabir Giri', NULL, 'M', NULL, NULL, 29, 1, 2, b'0', '2022-09-04 09:36:41', NULL),
(37, 'Prabartak Giri', NULL, 'M', NULL, NULL, 29, 0, 9, b'0', '2022-09-04 09:41:26', NULL),
(38, 'Prashanta Giri', 'Montu', 'M', NULL, NULL, 29, 0, 10, b'0', '2022-09-04 09:42:31', NULL),
(85, 'Biswanath Giri', 'M', 'M', NULL, NULL, 97, 0, 3, b'0', '2023-05-23 17:27:08', '2024-09-23 17:30:44'),
(40, 'Manishi Ranjan Giri', NULL, 'M', NULL, NULL, 34, 41, 1, b'0', '2022-09-04 17:50:06', NULL),
(41, 'Sumitra Giri', NULL, 'F', NULL, NULL, 0, 40, 1, b'0', '2022-09-04 17:50:39', NULL),
(42, 'Sumana Giri', 'Rumi', 'F', NULL, NULL, 40, 0, 1, b'0', '2022-09-04 17:55:19', NULL),
(43, 'Suman Giri', 'Shuvo', 'M', NULL, NULL, 40, 0, 2, b'0', '2022-09-04 17:55:51', NULL),
(44, 'Sadhana Giri', NULL, 'F', NULL, NULL, 34, 45, 2, b'0', '2022-09-04 17:56:49', '2022-09-04 17:58:05'),
(45, 'Horipada Maity', NULL, 'M', NULL, NULL, 0, 44, 1, b'0', '2022-09-04 17:57:30', NULL),
(46, 'Tarasankor Maity', NULL, 'M', NULL, NULL, 44, 0, 1, b'0', '2022-09-04 17:59:08', NULL),
(47, 'Anita Giri', NULL, 'F', NULL, NULL, 34, 48, 3, b'0', '2022-09-04 17:59:39', NULL),
(48, 'Narayan Pradhan', NULL, 'M', NULL, NULL, 0, 47, 1, b'0', '2022-09-04 18:00:19', NULL),
(49, 'Soumya Pradhan', NULL, 'M', NULL, NULL, 47, 0, 1, b'0', '2022-09-04 18:01:05', NULL),
(50, 'Manas Giri', NULL, 'M', NULL, NULL, 34, 51, 4, b'0', '2022-09-04 18:01:45', NULL),
(51, 'Archana Giri', NULL, 'F', NULL, NULL, 0, 50, 1, b'0', '2022-09-04 18:02:29', NULL),
(52, 'Sampad Giri', 'Omm', 'M', NULL, NULL, 50, 0, 1, b'0', '2022-09-04 18:03:00', NULL),
(53, 'Songlap Giri', NULL, 'M', NULL, NULL, 50, 0, 2, b'0', '2022-09-04 18:03:33', NULL),
(54, 'Kashinath Giri', 'M', 'M', NULL, NULL, 97, 0, 2, b'0', '2023-05-23 15:49:54', '2024-09-23 17:30:22'),
(55, 'Narendre nath Giri', NULL, 'M', NULL, NULL, 54, 56, 4, b'0', '2023-05-23 15:51:02', NULL),
(56, 'Grirbala Giri', NULL, 'F', NULL, NULL, 0, 55, 1, b'0', '2023-05-23 15:51:42', NULL),
(57, 'Suresh Chandra Giri', NULL, 'M', NULL, NULL, 55, 58, 1, b'0', '2023-05-23 15:54:11', '2023-05-23 15:55:43'),
(58, 'Purnima Giri', NULL, 'F', NULL, NULL, 0, 57, 1, b'0', '2023-05-23 15:54:46', NULL),
(59, 'Santosh Kumar Giri', NULL, 'M', NULL, NULL, 55, 0, 2, b'0', '2023-05-23 15:55:28', NULL),
(60, 'Swapan Kumar Giri', NULL, 'M', NULL, NULL, 57, 61, 1, b'0', '2023-05-23 15:56:42', NULL),
(61, 'Sonai Giri', NULL, 'F', NULL, NULL, 0, 60, 1, b'0', '2023-05-23 15:57:08', NULL),
(62, 'Tapan Kumar Giri', NULL, 'M', NULL, NULL, 57, 63, 2, b'0', '2023-05-23 15:57:43', NULL),
(63, 'Arati Giri', NULL, 'F', NULL, NULL, 0, 62, 1, b'0', '2023-05-23 15:59:21', NULL),
(64, 'Gopa Giri', NULL, 'F', NULL, NULL, 57, 65, 3, b'0', '2023-05-23 16:00:35', NULL),
(65, 'Puranjan Guria', NULL, 'M', NULL, NULL, 0, 64, 1, b'0', '2023-05-23 16:01:08', NULL),
(66, 'Nidra Giri', NULL, 'F', NULL, NULL, 57, 67, 4, b'0', '2023-05-23 16:01:52', NULL),
(67, 'Balai Jana', NULL, 'M', NULL, NULL, 0, 66, 1, b'0', '2023-05-23 16:02:21', NULL),
(68, 'Anirban Jana', NULL, 'M', NULL, NULL, 66, 0, 1, b'0', '2023-05-23 16:03:51', NULL),
(69, 'Anindita Jana', NULL, 'F', NULL, NULL, 66, 0, 2, b'0', '2023-05-23 16:04:18', NULL),
(70, 'Saswati Guria', NULL, 'F', NULL, NULL, 64, 0, 1, b'0', '2023-05-23 16:05:11', NULL),
(71, 'Smritilekha Guria', NULL, 'F', NULL, NULL, 64, 0, 2, b'0', '2023-05-23 16:05:53', NULL),
(72, 'Jayeeta Giri', NULL, 'F', NULL, NULL, 62, 73, 1, b'0', '2023-05-23 16:06:37', NULL),
(73, 'Ranjit Giri', NULL, 'M', NULL, NULL, 0, 72, 1, b'0', '2023-05-23 16:07:10', NULL),
(74, 'Ramen Giri', NULL, 'M', NULL, NULL, 72, 0, 1, b'0', '2023-05-23 16:07:37', NULL),
(75, 'Suchita Giri', NULL, 'F', NULL, NULL, 62, 76, 2, b'0', '2023-05-23 16:08:04', NULL),
(76, 'Nanojit Jana', NULL, 'M', NULL, NULL, 0, 75, 1, b'0', '2023-05-23 16:08:35', NULL),
(77, 'Trishanjit Jana', NULL, 'M', NULL, NULL, 75, 0, 1, b'0', '2023-05-23 16:09:19', '2023-05-23 17:43:59'),
(78, 'Sayan Giri', NULL, 'M', NULL, NULL, 62, 0, 3, b'0', '2023-05-23 16:09:43', NULL),
(79, 'Shantanu Giri', NULL, 'M', NULL, NULL, 60, 80, 1, b'0', '2023-05-23 16:12:20', NULL),
(80, 'Puja Giri', NULL, 'F', NULL, NULL, 0, 79, 1, b'0', '2023-05-23 16:12:50', NULL),
(81, 'Samprit Giri', NULL, 'M', NULL, NULL, 79, 0, 1, b'0', '2023-05-23 16:13:26', NULL),
(82, 'Stuti Giri', NULL, 'F', NULL, NULL, 60, 83, 2, b'0', '2023-05-23 16:14:01', NULL),
(83, 'Pulin Pradhan', NULL, 'M', NULL, NULL, 0, 82, 1, b'0', '2023-05-23 16:14:25', NULL),
(84, 'Pustika Pradhan', NULL, 'F', NULL, NULL, 82, 0, 1, b'0', '2023-05-23 16:14:56', NULL),
(86, 'Chandranath Giri', 'M', 'M', NULL, NULL, 97, 98, 5, b'0', '2023-05-23 17:28:06', '2024-09-23 17:31:14'),
(87, 'Sivam Bhuniya', 'M', 'M', '2024-04-09', NULL, 23, 0, 1, b'0', '2024-09-08 17:28:24', '2024-09-09 15:37:01'),
(88, 'Shefalika Giri', 'F', 'F', NULL, NULL, 29, 89, 4, b'0', '2024-09-08 17:47:43', '2024-09-23 17:36:22'),
(90, 'Yotshna Shysmal', 'F', 'F', NULL, NULL, 29, 91, 5, b'0', '2024-09-08 18:54:44', '2024-09-23 17:37:21'),
(89, 'Bisnupada Giri', 'M', 'M', NULL, NULL, 0, 88, 1, b'0', '2024-09-08 18:03:16', '2024-09-23 17:36:51'),
(91, 'Sashanka Shysmal', 'M', 'M', NULL, NULL, 0, 90, 1, b'0', '2024-09-09 15:51:16', NULL),
(92, 'Nilima Patra', 'F', 'F', NULL, NULL, 29, 93, 6, b'0', '2024-09-09 15:53:46', '2024-09-23 17:38:09'),
(93, 'Khitish Patra', 'M', 'M', NULL, NULL, 0, 92, 1, b'0', '2024-09-09 15:55:21', NULL),
(97, 'Ghoti charan Giri', 'M', 'M', NULL, NULL, 0, 0, 1, b'1', '2024-09-23 17:28:25', NULL),
(98, 'Rajeswari Giri', 'F', 'F', NULL, NULL, 0, 86, 1, b'0', '2024-09-23 17:34:25', NULL),
(99, 'Tripti Mal', 'F', 'F', NULL, NULL, 29, 100, 7, b'0', '2024-09-23 17:39:07', NULL),
(100, 'Vivek Mal', 'M', 'M', NULL, NULL, 0, 99, 1, b'0', '2024-09-23 17:40:27', NULL),
(101, 'Dipti Giri', 'F', 'F', NULL, NULL, 29, 0, 8, b'0', '2024-09-23 17:41:17', NULL),
(102, 'Bidesh Giri', 'M', 'M', NULL, NULL, 88, 0, 1, b'0', '2024-09-23 17:42:36', NULL),
(103, 'Sadesh Giri', 'M', 'M', NULL, NULL, 88, 0, 2, b'0', '2024-09-23 17:42:58', NULL),
(104, 'Bithika Giri', 'F', 'F', NULL, NULL, 88, 0, 3, b'0', '2024-09-23 17:43:31', NULL),
(105, 'Dinesh Giri', 'M', 'M', NULL, NULL, 88, 0, 4, b'0', '2024-09-23 17:43:51', NULL),
(106, 'Rita Shysmal', 'F', 'F', NULL, NULL, 90, 0, 1, b'0', '2024-09-23 17:46:50', NULL),
(107, 'Mita Shysmal', 'F', 'F', NULL, NULL, 90, 0, 2, b'0', '2024-09-23 17:47:27', NULL),
(108, 'Tuntuni Shysmal', 'F', 'F', NULL, NULL, 90, 0, 3, b'0', '2024-09-23 17:48:01', NULL),
(109, 'Khokon Shysmal', 'M', 'M', NULL, NULL, 90, 0, 4, b'0', '2024-09-23 17:48:31', NULL),
(110, 'Ashim Shysmal', 'M', 'M', NULL, NULL, 90, 0, 5, b'0', '2024-09-23 17:48:59', NULL),
(111, 'Bapi Patra', 'M', 'M', NULL, NULL, 92, 0, 1, b'0', '2024-09-23 17:50:07', NULL),
(112, 'Doli Patra', 'F', 'F', NULL, NULL, 92, 0, 2, b'0', '2024-09-23 17:50:36', NULL),
(113, 'Shuli Patra', 'F', 'F', NULL, NULL, 92, 0, 3, b'0', '2024-09-23 17:50:57', NULL),
(114, 'Bablu Patra', 'M', 'M', NULL, NULL, 92, 0, 4, b'0', '2024-09-23 17:51:34', NULL),
(115, 'Bulbuli Patra', 'F', 'F', NULL, NULL, 92, 0, 5, b'0', '2024-09-23 17:52:05', NULL),
(116, 'Tapu Patra', 'M', 'M', NULL, NULL, 92, 0, 6, b'0', '2024-09-23 17:52:38', NULL),
(117, 'Archana Mal', 'F', 'F', NULL, NULL, 99, 0, 1, b'0', '2024-09-23 17:54:53', NULL),
(118, 'Piku Mal', 'M', 'M', NULL, NULL, 99, 0, 2, b'0', '2024-09-23 17:56:09', NULL),
(119, 'Litu Mal', 'M', 'M', NULL, NULL, 99, 0, 3, b'0', '2024-09-23 17:56:47', NULL),
(120, 'Babu Mal', 'M', 'M', NULL, NULL, 99, 0, 4, b'0', '2024-09-23 17:57:16', NULL),
(121, 'Logen Giri', 'M', 'M', NULL, NULL, 86, 0, 4, b'0', '2024-10-20 15:46:04', NULL),
(122, 'Bivuti Giri', 'M', 'M', NULL, NULL, 86, 0, 5, b'0', '2024-10-20 15:48:42', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
