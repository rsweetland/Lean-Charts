-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 07, 2011 at 11:31 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sonar`
--

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `logid` int(11) NOT NULL AUTO_INCREMENT,
  `event` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `oid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`logid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49200 ;

--
-- Dumping data for table `log`
--

INSERT INTO `log` VALUES(36, 'fut scheduled', '2011-05-04 14:00:07', 41, 41, '');
INSERT INTO `log` VALUES(38, 'fut scheduled', '2011-05-04 14:39:40', 42, 41, '');
INSERT INTO `log` VALUES(40, 'fut scheduled', '2011-05-04 14:44:43', 43, 41, '');
INSERT INTO `log` VALUES(42, 'edit: success', '2011-05-04 14:53:48', 43, 41, '');
INSERT INTO `log` VALUES(43, 'edit: success', '2011-05-04 14:54:04', 43, 41, '');
INSERT INTO `log` VALUES(44, 'edit: success', '2011-05-04 14:54:36', 43, 41, '');
INSERT INTO `log` VALUES(45, 'edit: success', '2011-05-04 14:55:57', 43, 41, '');
INSERT INTO `log` VALUES(46, 'sent: fut to sender', '2011-05-04 14:57:04', 43, 41, '');
INSERT INTO `log` VALUES(47, 'edit: success', '2011-05-04 14:57:07', 43, 41, '');
INSERT INTO `log` VALUES(48, 'edit: success', '2011-05-04 14:57:08', 43, 41, '');
INSERT INTO `log` VALUES(49, 'edit: success', '2011-05-04 14:57:32', 43, 41, '');
INSERT INTO `log` VALUES(50, 'sent: fut to sender', '2011-05-04 14:58:42', 43, 41, '');
INSERT INTO `log` VALUES(51, 'sent: fut to sender', '2011-05-04 15:29:04', 40, 41, '');
INSERT INTO `log` VALUES(52, 'sent: fut to sender', '2011-05-04 21:02:02', 41, 41, '');
INSERT INTO `log` VALUES(53, 'sent: fut to sender', '2011-05-04 21:41:02', 42, 41, '');
INSERT INTO `log` VALUES(58, 'sent: fut to sender', '2011-05-05 11:18:02', 45, 43, '');
INSERT INTO `log` VALUES(59, 'fut scheduled', '2011-05-05 11:22:18', 46, 43, '');
INSERT INTO `log` VALUES(61, 'sent: fut to sender', '2011-05-05 11:23:02', 44, 42, '');
INSERT INTO `log` VALUES(62, 'sent: fut to sender', '2011-05-05 11:24:02', 46, 43, '');
INSERT INTO `log` VALUES(63, 'fut scheduled', '2011-05-05 11:28:28', 47, 43, '');
INSERT INTO `log` VALUES(65, 'sent: fut to sender', '2011-05-05 11:30:01', 47, 43, '');
INSERT INTO `log` VALUES(66, 'fut scheduled', '2011-05-05 11:32:28', 48, 43, '');
INSERT INTO `log` VALUES(68, 'fut scheduled', '2011-05-05 11:32:35', 49, 42, '');
INSERT INTO `log` VALUES(70, 'sent: fut to sender', '2011-05-05 11:34:02', 48, 43, '');
INSERT INTO `log` VALUES(71, 'sent: fut to sender', '2011-05-05 11:34:02', 49, 42, '');
INSERT INTO `log` VALUES(72, 'fut scheduled', '2011-05-05 11:35:44', 50, 43, '');
INSERT INTO `log` VALUES(74, 'sent: fut to sender', '2011-05-05 11:37:01', 50, 43, '');
INSERT INTO `log` VALUES(75, 'fut scheduled', '2011-05-05 11:37:53', 51, 43, '');
INSERT INTO `log` VALUES(77, 'sent: fut to sender', '2011-05-05 11:39:02', 51, 43, '');
INSERT INTO `log` VALUES(78, 'fut scheduled', '2011-05-05 11:41:28', 52, 42, '');
INSERT INTO `log` VALUES(80, 'sent: fut to sender', '2011-05-05 11:43:02', 52, 42, '');
INSERT INTO `log` VALUES(81, 'fut scheduled', '2011-05-05 12:13:54', 53, 43, '');
INSERT INTO `log` VALUES(83, 'sent: fut to sender', '2011-05-05 12:15:01', 53, 43, '');
INSERT INTO `log` VALUES(84, 'fut scheduled', '2011-05-05 12:18:24', 54, 41, '');
INSERT INTO `log` VALUES(86, 'fut scheduled', '2011-05-05 12:19:57', 55, 43, '');
INSERT INTO `log` VALUES(88, 'sent: fut to sender', '2011-05-05 12:20:02', 54, 41, '');
INSERT INTO `log` VALUES(89, 'sent: fut to sender', '2011-05-05 12:21:01', 55, 43, '');
INSERT INTO `log` VALUES(90, 'fut scheduled', '2011-05-05 12:22:06', 56, 43, '');
INSERT INTO `log` VALUES(92, 'sent: fut to sender', '2011-05-05 12:24:02', 56, 43, '');
INSERT INTO `log` VALUES(93, 'fut scheduled', '2011-05-05 12:28:57', 57, 43, '');
INSERT INTO `log` VALUES(95, 'fut scheduled', '2011-05-05 12:29:04', 58, 43, '');
INSERT INTO `log` VALUES(97, 'sent: fut to sender', '2011-05-05 12:30:01', 57, 43, '');
INSERT INTO `log` VALUES(98, 'sent: fut to sender', '2011-05-05 12:31:01', 58, 43, '');
INSERT INTO `log` VALUES(99, 'fut scheduled', '2011-05-05 12:33:06', 59, 43, '');
INSERT INTO `log` VALUES(101, 'fut scheduled', '2011-05-05 12:33:22', 60, 43, '');
INSERT INTO `log` VALUES(103, 'fut scheduled', '2011-05-05 12:33:43', 61, 43, '');
INSERT INTO `log` VALUES(105, 'sent: fut to sender', '2011-05-05 12:35:02', 59, 43, '');
INSERT INTO `log` VALUES(106, 'sent: fut to sender', '2011-05-05 12:35:02', 60, 43, '');
INSERT INTO `log` VALUES(107, 'sent: fut to sender', '2011-05-05 12:35:03', 61, 43, '');
INSERT INTO `log` VALUES(108, 'fut scheduled', '2011-05-05 12:35:16', 62, 43, '');
INSERT INTO `log` VALUES(110, 'sent: fut to sender', '2011-05-05 12:37:02', 62, 43, '');
INSERT INTO `log` VALUES(111, 'fut scheduled', '2011-05-05 12:37:40', 63, 43, '');
INSERT INTO `log` VALUES(113, 'fut scheduled', '2011-05-05 12:38:53', 64, 43, '');
INSERT INTO `log` VALUES(115, 'fut scheduled', '2011-05-05 12:38:59', 65, 43, '');
INSERT INTO `log` VALUES(117, 'sent: fut to sender', '2011-05-05 12:39:02', 63, 43, '');
INSERT INTO `log` VALUES(118, 'fut scheduled', '2011-05-05 12:39:07', 66, 43, '');
INSERT INTO `log` VALUES(120, 'fut scheduled', '2011-05-05 12:39:10', 67, 43, '');
INSERT INTO `log` VALUES(122, 'sent: fut to sender', '2011-05-05 12:40:01', 64, 43, '');
INSERT INTO `log` VALUES(123, 'sent: fut to sender', '2011-05-05 12:40:02', 65, 43, '');
INSERT INTO `log` VALUES(124, 'fut scheduled', '2011-05-05 12:41:00', 68, 43, '');
INSERT INTO `log` VALUES(126, 'sent: fut to sender', '2011-05-05 12:41:02', 66, 43, '');
INSERT INTO `log` VALUES(127, 'sent: fut to sender', '2011-05-05 12:41:02', 67, 43, '');
INSERT INTO `log` VALUES(128, 'fut scheduled', '2011-05-05 12:41:09', 69, 43, '');
INSERT INTO `log` VALUES(130, 'sent: fut to sender', '2011-05-05 12:42:01', 68, 43, '');
INSERT INTO `log` VALUES(131, 'sent: fut to sender', '2011-05-05 12:43:02', 69, 43, '');
INSERT INTO `log` VALUES(132, 'fut scheduled', '2011-05-05 12:46:36', 70, 43, '');
INSERT INTO `log` VALUES(134, 'fut scheduled', '2011-05-05 12:46:45', 71, 43, '');
INSERT INTO `log` VALUES(136, 'fut scheduled', '2011-05-05 12:47:00', 72, 43, '');
INSERT INTO `log` VALUES(138, 'fut scheduled', '2011-05-05 12:47:07', 73, 43, '');
INSERT INTO `log` VALUES(140, 'fut scheduled', '2011-05-05 12:47:18', 74, 41, '');
INSERT INTO `log` VALUES(142, 'fut scheduled', '2011-05-05 12:47:26', 75, 43, '');
INSERT INTO `log` VALUES(144, 'sent: fut to sender', '2011-05-05 12:48:01', 70, 43, '');
INSERT INTO `log` VALUES(145, 'sent: fut to sender', '2011-05-05 12:48:02', 71, 43, '');
INSERT INTO `log` VALUES(146, 'sent: fut to sender', '2011-05-05 12:48:02', 72, 43, '');
INSERT INTO `log` VALUES(147, 'sent: fut to sender', '2011-05-05 12:49:01', 73, 43, '');
INSERT INTO `log` VALUES(148, 'sent: fut to sender', '2011-05-05 12:49:01', 74, 41, '');
INSERT INTO `log` VALUES(149, 'sent: fut to sender', '2011-05-05 12:49:02', 75, 43, '');
INSERT INTO `log` VALUES(150, 'fut scheduled', '2011-05-05 12:52:12', 76, 41, '');
INSERT INTO `log` VALUES(152, 'fut scheduled', '2011-05-05 12:53:04', 77, 43, '');
INSERT INTO `log` VALUES(154, 'fut scheduled', '2011-05-05 12:53:13', 78, 43, '');
INSERT INTO `log` VALUES(156, 'fut scheduled', '2011-05-05 12:53:20', 79, 43, '');
INSERT INTO `log` VALUES(158, 'fut scheduled', '2011-05-05 12:53:30', 80, 43, '');
INSERT INTO `log` VALUES(160, 'fut scheduled', '2011-05-05 12:53:38', 81, 43, '');
INSERT INTO `log` VALUES(162, 'fut scheduled', '2011-05-05 12:53:47', 82, 43, '');
INSERT INTO `log` VALUES(164, 'sent: fut to sender', '2011-05-05 12:54:01', 76, 41, '');
INSERT INTO `log` VALUES(165, 'fut scheduled', '2011-05-05 12:54:31', 83, 43, '');
INSERT INTO `log` VALUES(167, 'sent: fut to sender', '2011-05-05 12:55:02', 77, 43, '');
INSERT INTO `log` VALUES(168, 'sent: fut to sender', '2011-05-05 12:55:02', 78, 43, '');
INSERT INTO `log` VALUES(169, 'sent: fut to sender', '2011-05-05 12:55:03', 79, 43, '');
INSERT INTO `log` VALUES(170, 'sent: fut to sender', '2011-05-05 12:55:03', 80, 43, '');
INSERT INTO `log` VALUES(171, 'sent: fut to sender', '2011-05-05 12:55:04', 81, 43, '');
INSERT INTO `log` VALUES(172, 'sent: fut to sender', '2011-05-05 12:55:04', 82, 43, '');
INSERT INTO `log` VALUES(173, 'sent: fut to sender', '2011-05-05 12:56:02', 83, 43, '');
INSERT INTO `log` VALUES(174, 'fut scheduled', '2011-05-05 13:03:07', 84, 41, '');
INSERT INTO `log` VALUES(176, 'fut scheduled', '2011-05-05 13:07:40', 85, 41, '');
INSERT INTO `log` VALUES(177, 'fut scheduled', '2011-05-05 13:11:05', 86, 42, '');
INSERT INTO `log` VALUES(182, 'sent: fut to sender', '2011-05-05 13:20:40', 84, 41, '');
INSERT INTO `log` VALUES(183, 'sent: fut to sender', '2011-05-05 13:22:01', 88, 41, '');
INSERT INTO `log` VALUES(184, 'fut scheduled', '2011-05-05 13:24:17', 88, 41, '');
INSERT INTO `log` VALUES(185, 'sent: fut to sender', '2011-05-05 13:25:42', 85, 41, '');
INSERT INTO `log` VALUES(187, 'sent: fut to sender', '2011-05-05 13:27:32', 86, 42, '');
INSERT INTO `log` VALUES(188, 'fut scheduled', '2011-05-05 13:32:05', 89, 43, '');
INSERT INTO `log` VALUES(190, 'sent: fut to sender', '2011-05-05 13:34:02', 89, 43, '');
INSERT INTO `log` VALUES(195, 'sent: fut to sender', '2011-05-05 14:34:01', 90, 45, '');
INSERT INTO `log` VALUES(196, 'sent: fut to sender', '2011-05-05 14:34:02', 91, 45, '');
INSERT INTO `log` VALUES(197, 'fut scheduled', '2011-05-05 15:01:46', 92, 45, '');
INSERT INTO `log` VALUES(199, 'sent: fut to sender', '2011-05-05 15:03:01', 92, 45, '');
INSERT INTO `log` VALUES(200, 'fut scheduled', '2011-05-05 15:15:19', 93, 41, '');
INSERT INTO `log` VALUES(202, 'sent: fut to sender', '2011-05-05 15:17:01', 93, 41, '');
INSERT INTO `log` VALUES(203, 'fut scheduled', '2011-05-05 15:37:40', 94, 45, '');
INSERT INTO `log` VALUES(205, 'sent: fut to sender', '2011-05-05 15:39:02', 94, 45, '');
INSERT INTO `log` VALUES(206, 'fut scheduled', '2011-05-05 15:56:20', 95, 41, '');
INSERT INTO `log` VALUES(208, 'sent: fut to sender', '2011-05-05 15:58:01', 95, 41, '');
INSERT INTO `log` VALUES(209, 'fut scheduled', '2011-05-05 16:03:32', 96, 42, '');
INSERT INTO `log` VALUES(211, 'sent: fut to sender', '2011-05-05 16:05:02', 96, 42, '');
INSERT INTO `log` VALUES(212, 'fut scheduled', '2011-05-05 16:10:33', 97, 42, '');
INSERT INTO `log` VALUES(214, 'fut scheduled', '2011-05-05 16:11:05', 98, 42, '');
INSERT INTO `log` VALUES(216, 'sent: fut to sender', '2011-05-05 16:12:01', 97, 42, '');
INSERT INTO `log` VALUES(217, 'fut scheduled', '2011-05-05 16:12:07', 99, 42, '');
INSERT INTO `log` VALUES(219, 'fut scheduled', '2011-05-05 16:12:53', 100, 42, '');
INSERT INTO `log` VALUES(221, 'sent: fut to sender', '2011-05-05 16:13:01', 98, 42, '');
INSERT INTO `log` VALUES(222, 'sent: fut to sender', '2011-05-05 16:14:01', 99, 42, '');
INSERT INTO `log` VALUES(223, 'sent: fut to sender', '2011-05-05 16:14:01', 100, 42, '');
INSERT INTO `log` VALUES(224, 'fut scheduled', '2011-05-05 16:16:02', 101, 42, '');
INSERT INTO `log` VALUES(226, 'sent: fut to sender', '2011-05-05 16:18:01', 101, 42, '');
INSERT INTO `log` VALUES(229, 'fut scheduled', '2011-05-05 16:20:27', 103, 46, '');
INSERT INTO `log` VALUES(231, 'sent: fut to sender', '2011-05-05 16:21:01', 102, 46, '');
INSERT INTO `log` VALUES(232, 'sent: fut to sender', '2011-05-05 16:22:01', 103, 46, '');
INSERT INTO `log` VALUES(233, 'fut scheduled', '2011-05-05 16:25:28', 104, 45, '');
INSERT INTO `log` VALUES(235, 'sent: fut to sender', '2011-05-05 16:27:01', 104, 45, '');
INSERT INTO `log` VALUES(236, 'fut scheduled', '2011-05-05 16:43:24', 105, 46, '');
INSERT INTO `log` VALUES(238, 'sent: fut to sender', '2011-05-05 16:45:01', 105, 46, '');
INSERT INTO `log` VALUES(239, 'fut scheduled', '2011-05-05 16:58:49', 106, 41, '');
INSERT INTO `log` VALUES(241, 'sent: fut to sender', '2011-05-05 17:00:02', 106, 41, '');
INSERT INTO `log` VALUES(242, 'edit: success', '2011-05-05 17:00:44', 106, 41, '');
INSERT INTO `log` VALUES(243, 'edit: success', '2011-05-05 17:00:45', 106, 41, '');
INSERT INTO `log` VALUES(244, 'edit: success', '2011-05-05 17:02:00', 106, 41, '');
INSERT INTO `log` VALUES(245, 'edit: success', '2011-05-05 17:02:20', 106, 41, '');
INSERT INTO `log` VALUES(246, 'edit: success', '2011-05-05 17:02:20', 106, 41, '');
INSERT INTO `log` VALUES(247, 'fut scheduled', '2011-05-05 17:32:10', 107, 41, '');
INSERT INTO `log` VALUES(249, 'sent: fut to sender', '2011-05-05 17:34:02', 107, 41, '');
INSERT INTO `log` VALUES(250, 'fut scheduled', '2011-05-05 17:35:03', 108, 41, '');
INSERT INTO `log` VALUES(252, 'fut scheduled', '2011-05-05 17:36:59', 109, 41, '');
INSERT INTO `log` VALUES(254, 'sent: fut to sender', '2011-05-05 17:37:01', 108, 41, '');
INSERT INTO `log` VALUES(255, 'sent: fut to sender', '2011-05-05 17:38:05', 109, 41, '');
INSERT INTO `log` VALUES(256, 'fut scheduled', '2011-05-05 17:38:18', 110, 41, '');
INSERT INTO `log` VALUES(258, 'sent: fut to sender', '2011-05-05 17:40:02', 110, 41, '');
INSERT INTO `log` VALUES(259, 'sent: fut to sender', '2011-05-06 17:03:02', 106, 41, '');
INSERT INTO `log` VALUES(260, 'fut scheduled', '2011-05-09 10:13:39', 111, 46, '');
INSERT INTO `log` VALUES(262, 'sent: fut to sender', '2011-05-09 10:15:02', 111, 46, '');
INSERT INTO `log` VALUES(263, 'fut scheduled', '2011-05-09 10:23:24', 112, 46, '');
INSERT INTO `log` VALUES(265, 'sent: fut to sender', '2011-05-09 10:25:02', 112, 46, '');
INSERT INTO `log` VALUES(266, 'fut scheduled', '2011-05-09 10:29:32', 113, 46, '');
INSERT INTO `log` VALUES(268, 'sent: fut to sender', '2011-05-09 10:31:01', 113, 46, '');
INSERT INTO `log` VALUES(269, 'fut scheduled', '2011-05-09 10:33:27', 114, 46, '');
INSERT INTO `log` VALUES(271, 'sent: fut to sender', '2011-05-09 10:35:02', 114, 46, '');
INSERT INTO `log` VALUES(272, 'fut scheduled', '2011-05-09 10:39:14', 115, 46, '');
INSERT INTO `log` VALUES(274, 'sent: fut to sender', '2011-05-09 10:41:01', 115, 46, '');
INSERT INTO `log` VALUES(275, 'fut scheduled', '2011-05-09 10:42:38', 116, 46, '');
INSERT INTO `log` VALUES(277, 'sent: fut to sender', '2011-05-09 10:44:02', 116, 46, '');
INSERT INTO `log` VALUES(278, 'fut scheduled', '2011-05-09 10:44:09', 117, 46, '');
INSERT INTO `log` VALUES(280, 'sent: fut to sender', '2011-05-09 10:46:02', 117, 46, '');
INSERT INTO `log` VALUES(281, 'fut scheduled', '2011-05-09 10:54:12', 118, 46, '');
INSERT INTO `log` VALUES(283, 'sent: fut to sender', '2011-05-09 10:56:02', 118, 46, '');
INSERT INTO `log` VALUES(284, 'fut scheduled', '2011-05-09 11:04:53', 119, 46, '');
INSERT INTO `log` VALUES(286, 'sent: fut to sender', '2011-05-09 11:06:02', 119, 46, '');
INSERT INTO `log` VALUES(287, 'fut scheduled', '2011-05-09 11:06:58', 120, 46, '');
INSERT INTO `log` VALUES(289, 'sent: fut to sender', '2011-05-09 11:08:01', 120, 46, '');
INSERT INTO `log` VALUES(290, 'fut scheduled', '2011-05-09 11:10:48', 121, 46, '');
INSERT INTO `log` VALUES(292, 'sent: fut to sender', '2011-05-09 11:12:02', 121, 46, '');
INSERT INTO `log` VALUES(293, 'fut scheduled', '2011-05-09 11:12:48', 122, 46, '');
INSERT INTO `log` VALUES(295, 'sent: fut to sender', '2011-05-09 11:14:02', 122, 46, '');
INSERT INTO `log` VALUES(296, 'fut scheduled', '2011-05-09 12:34:44', 123, 46, '');
INSERT INTO `log` VALUES(298, 'sent: fut to sender', '2011-05-09 12:36:01', 123, 46, '');
INSERT INTO `log` VALUES(299, 'fut scheduled', '2011-05-09 12:54:21', 124, 46, '');
INSERT INTO `log` VALUES(301, 'sent: fut to sender', '2011-05-09 12:56:01', 124, 46, '');
INSERT INTO `log` VALUES(302, 'fut scheduled', '2011-05-09 12:58:37', 125, 46, '');
INSERT INTO `log` VALUES(304, 'sent: fut to sender', '2011-05-09 13:00:02', 125, 46, '');
INSERT INTO `log` VALUES(305, 'fut scheduled', '2011-05-09 13:02:57', 126, 46, '');
INSERT INTO `log` VALUES(307, 'sent: fut to sender', '2011-05-09 13:04:01', 126, 46, '');
INSERT INTO `log` VALUES(310, 'sent: fut to sender', '2011-05-09 13:20:01', 127, 47, '');
INSERT INTO `log` VALUES(311, 'fut scheduled', '2011-05-09 13:26:57', 128, 46, '');
INSERT INTO `log` VALUES(313, 'sent: fut to sender', '2011-05-09 13:28:01', 128, 46, '');
INSERT INTO `log` VALUES(314, 'fut scheduled', '2011-05-09 17:36:32', 129, 46, '');
INSERT INTO `log` VALUES(316, 'sent: fut to sender', '2011-05-09 17:37:41', 129, 46, '');
INSERT INTO `log` VALUES(317, 'fut scheduled', '2011-05-09 17:39:27', 130, 46, '');
INSERT INTO `log` VALUES(319, 'sent: fut to sender', '2011-05-09 17:40:40', 130, 46, '');
INSERT INTO `log` VALUES(338, 'fut scheduled', '2011-05-09 18:00:58', 131, 46, '');
INSERT INTO `log` VALUES(348, 'sent: fut to sender', '2011-05-09 18:02:02', 131, 46, '');
INSERT INTO `log` VALUES(5439, 'fut scheduled', '2011-05-11 12:03:25', 132, 46, '');
INSERT INTO `log` VALUES(5539, 'fut scheduled', '2011-05-11 12:53:52', 133, 46, '');
INSERT INTO `log` VALUES(5543, 'fut scheduled', '2011-05-11 12:55:51', 134, 46, '');
INSERT INTO `log` VALUES(5547, 'fut scheduled', '2011-05-11 12:57:31', 135, 46, '');
INSERT INTO `log` VALUES(5552, 'sent: fut to sender', '2011-05-11 12:59:02', 135, 46, '');
INSERT INTO `log` VALUES(5594, 'fut scheduled', '2011-05-11 13:18:05', 136, 46, '');
INSERT INTO `log` VALUES(5602, 'fut scheduled', '2011-05-11 13:22:49', 137, 46, '');
INSERT INTO `log` VALUES(5607, 'sent: fut to sender', '2011-05-11 13:24:03', 137, 46, '');
INSERT INTO `log` VALUES(5691, 'fut scheduled', '2011-05-11 14:04:22', 138, 46, '');
INSERT INTO `log` VALUES(5696, 'sent: fut to sender', '2011-05-11 14:06:01', 138, 46, '');
INSERT INTO `log` VALUES(5711, 'fut scheduled', '2011-05-11 14:12:07', 139, 46, '');
INSERT INTO `log` VALUES(5716, 'sent: fut to sender', '2011-05-11 14:14:02', 139, 46, '');
INSERT INTO `log` VALUES(5763, 'fut scheduled', '2011-05-11 14:36:41', 140, 46, '');
INSERT INTO `log` VALUES(5768, 'sent: fut to sender', '2011-05-11 14:38:02', 140, 46, '');
INSERT INTO `log` VALUES(5785, 'fut scheduled', '2011-05-11 14:45:31', 141, 46, '');
INSERT INTO `log` VALUES(5791, 'sent: fut to sender', '2011-05-11 14:47:03', 141, 46, '');
INSERT INTO `log` VALUES(7973, 'fut scheduled', '2011-05-12 08:47:35', 142, 41, '');
INSERT INTO `log` VALUES(7988, 'sent: fut to sender', '2011-05-12 08:53:03', 142, 41, '');
INSERT INTO `log` VALUES(8012, 'fut scheduled', '2011-05-12 09:03:53', 143, 46, '');
INSERT INTO `log` VALUES(8017, 'sent: fut to sender', '2011-05-12 09:05:02', 143, 46, '');
INSERT INTO `log` VALUES(8038, 'fut scheduled', '2011-05-12 09:14:36', 144, 46, '');
INSERT INTO `log` VALUES(8043, 'sent: fut to sender', '2011-05-12 09:16:01', 144, 46, '');
INSERT INTO `log` VALUES(8052, 'fut scheduled', '2011-05-12 09:19:55', 145, 46, '');
INSERT INTO `log` VALUES(8057, 'sent: fut to sender', '2011-05-12 09:21:02', 145, 46, '');
INSERT INTO `log` VALUES(8070, 'fut scheduled', '2011-05-12 09:26:44', 146, 46, '');
INSERT INTO `log` VALUES(8075, 'sent: fut to sender', '2011-05-12 09:28:02', 146, 46, '');
INSERT INTO `log` VALUES(8086, 'fut scheduled', '2011-05-12 09:32:27', 147, 46, '');
INSERT INTO `log` VALUES(8091, 'sent: fut to sender', '2011-05-12 09:34:02', 147, 46, '');
INSERT INTO `log` VALUES(8102, 'fut scheduled', '2011-05-12 09:38:02', 148, 46, '');
INSERT INTO `log` VALUES(8107, 'sent: fut to sender', '2011-05-12 09:40:03', 148, 46, '');
INSERT INTO `log` VALUES(11046, 'fut scheduled', '2011-05-13 09:55:42', 149, 46, '');
INSERT INTO `log` VALUES(11051, 'sent: fut to sender', '2011-05-13 09:57:03', 149, 46, '');
INSERT INTO `log` VALUES(11069, 'fut scheduled', '2011-05-13 10:04:53', 150, 46, '');
INSERT INTO `log` VALUES(11074, 'sent: fut to sender', '2011-05-13 10:06:03', 150, 46, '');
INSERT INTO `log` VALUES(11212, 'fut scheduled', '2011-05-13 11:13:22', 151, 46, '');
INSERT INTO `log` VALUES(11217, 'sent: fut to sender', '2011-05-13 11:15:03', 151, 46, '');
INSERT INTO `log` VALUES(22807, 'fut scheduled', '2011-05-17 10:59:39', 152, 41, '');
INSERT INTO `log` VALUES(22812, 'sent: fut to sender', '2011-05-17 11:01:03', 152, 41, '');
INSERT INTO `log` VALUES(22930, 'fut scheduled', '2011-05-17 11:58:54', 153, 41, '');
INSERT INTO `log` VALUES(22933, 'sent: fut to sender', '2011-05-17 11:59:02', 153, 41, '');
INSERT INTO `log` VALUES(22936, 'fut scheduled', '2011-05-17 11:59:09', 154, 41, '');
INSERT INTO `log` VALUES(22940, 'sent: fut to sender', '2011-05-17 12:01:02', 154, 41, '');
INSERT INTO `log` VALUES(22966, 'fut scheduled', '2011-05-17 12:10:16', 155, 41, '');
INSERT INTO `log` VALUES(22977, 'sent: fut to sender', '2011-05-17 12:13:49', 155, 41, '');
INSERT INTO `log` VALUES(23151, 'fut scheduled', '2011-05-17 13:35:23', 162, 41, '');
INSERT INTO `log` VALUES(23171, 'sent: fut to sender', '2011-05-17 13:53:04', 162, 41, '');
INSERT INTO `log` VALUES(31399, 'first time fut use: user record created', '2011-05-20 09:44:14', 0, 188, '');
INSERT INTO `log` VALUES(31427, 'fut scheduled', '2011-05-20 09:52:56', 164, 46, '');
INSERT INTO `log` VALUES(31431, 'fut scheduled', '2011-05-20 09:53:26', 165, 46, '');
INSERT INTO `log` VALUES(31455, 'sent: fut to sender', '2011-05-20 10:03:02', 164, 46, '');
INSERT INTO `log` VALUES(31469, 'sent: fut to sender', '2011-05-20 10:09:02', 165, 46, '');
INSERT INTO `log` VALUES(40794, 'fut scheduled', '2011-05-23 15:09:10', 166, 46, '');
INSERT INTO `log` VALUES(40818, 'sent: fut to sender', '2011-05-23 15:20:03', 166, 46, '');
INSERT INTO `log` VALUES(40827, 'first time fut use: user record created', '2011-05-23 15:23:29', 0, 189, '');
INSERT INTO `log` VALUES(40833, 'validation completed', '2011-05-23 15:23:53', NULL, 189, '');
INSERT INTO `log` VALUES(40847, 'first time fut use: user record created', '2011-05-23 15:29:52', 0, 190, '');
INSERT INTO `log` VALUES(40874, 'sent: fut to sender', '2011-05-23 15:40:02', 167, 189, '');
INSERT INTO `log` VALUES(43182, 'fut scheduled', '2011-05-24 10:42:41', 169, 41, '');
INSERT INTO `log` VALUES(43188, 'sent: fut to sender', '2011-05-24 10:44:02', 169, 41, '');
INSERT INTO `log` VALUES(43192, 'first time fut use: user record created', '2011-05-24 10:44:41', 0, 191, '');
INSERT INTO `log` VALUES(43197, 'validation completed', '2011-05-24 10:44:48', NULL, 41, '');
INSERT INTO `log` VALUES(43258, 'fut scheduled', '2011-05-24 11:07:08', 171, 41, '');
INSERT INTO `log` VALUES(43261, 'fut scheduled', '2011-05-24 11:07:58', 172, 41, '');
INSERT INTO `log` VALUES(43267, 'sent: fut to sender', '2011-05-24 11:09:02', 171, 41, '');
INSERT INTO `log` VALUES(43268, 'sent: fut to sender', '2011-05-24 11:09:02', 172, 41, '');
INSERT INTO `log` VALUES(43287, 'edit: success', '2011-05-24 11:18:01', 171, 41, '');
INSERT INTO `log` VALUES(43290, 'edit: success', '2011-05-24 11:18:04', 171, 41, '');
INSERT INTO `log` VALUES(43293, 'edit: success', '2011-05-24 11:19:22', 171, 41, '');
INSERT INTO `log` VALUES(43296, 'edit: success', '2011-05-24 11:20:10', 171, 41, '');
INSERT INTO `log` VALUES(43297, 'edit: success', '2011-05-24 11:20:20', 171, 41, '');
INSERT INTO `log` VALUES(43298, 'edit: success', '2011-05-24 11:20:27', 171, 41, '');
INSERT INTO `log` VALUES(43299, 'edit: success', '2011-05-24 11:20:29', 171, 41, '');
INSERT INTO `log` VALUES(43310, 'edit: success', '2011-05-24 11:24:01', 39, 41, '');
INSERT INTO `log` VALUES(43320, 'sent: fut to sender', '2011-05-24 11:26:04', 39, 41, '');
INSERT INTO `log` VALUES(43323, 'first time fut use: user record created', '2011-05-24 11:26:04', 0, 193, '');
INSERT INTO `log` VALUES(43494, 'customize page: custom settings saved', '2011-05-24 11:30:28', NULL, 41, '');
INSERT INTO `log` VALUES(43501, 'fut scheduled', '2011-05-24 11:30:45', 174, 41, '');
INSERT INTO `log` VALUES(43510, 'fut scheduled', '2011-05-24 11:31:02', 175, 41, '');
INSERT INTO `log` VALUES(43530, 'sent: fut to sender', '2011-05-24 11:32:01', 174, 41, '');
INSERT INTO `log` VALUES(43550, 'sent: fut to sender', '2011-05-24 11:33:02', 175, 41, '');
INSERT INTO `log` VALUES(44729, 'fut scheduled', '2011-05-24 14:13:24', 176, 46, '');
INSERT INTO `log` VALUES(44732, 'first time fut use: user record created', '2011-05-24 14:13:48', 0, 194, '');
INSERT INTO `log` VALUES(44739, 'fut scheduled', '2011-05-24 14:14:10', 178, 46, '');
INSERT INTO `log` VALUES(44748, 'customize page: custom settings saved', '2011-05-24 14:15:32', NULL, 46, '');
INSERT INTO `log` VALUES(44751, 'validation completed', '2011-05-24 14:15:53', NULL, 46, '');
INSERT INTO `log` VALUES(44770, 'fut scheduled', '2011-05-24 14:18:14', 180, 46, '');
INSERT INTO `log` VALUES(44774, 'validation completed', '2011-05-24 14:18:24', NULL, 46, '');
INSERT INTO `log` VALUES(44786, 'sent: fut to sender', '2011-05-24 14:20:02', 180, 46, '');
INSERT INTO `log` VALUES(44975, 'fut scheduled', '2011-05-24 14:57:28', 182, 46, '');
INSERT INTO `log` VALUES(44985, 'sent: fut to sender', '2011-05-24 14:59:02', 182, 46, '');
INSERT INTO `log` VALUES(49051, 'fut scheduled', '2011-05-25 09:35:24', 183, 46, '');
INSERT INTO `log` VALUES(49172, 'fut scheduled', '2011-05-24 14:20:00', NULL, 194, '');
INSERT INTO `log` VALUES(49173, 'fut scheduled', '2011-05-24 14:20:00', NULL, 194, '');
INSERT INTO `log` VALUES(49174, 'fut scheduled', '2011-05-24 14:20:00', NULL, 194, '');
INSERT INTO `log` VALUES(49175, 'fut scheduled', '2011-05-24 14:20:00', NULL, 194, '');
INSERT INTO `log` VALUES(49176, 'fut scheduled', '2011-05-24 14:20:00', NULL, 194, '');
INSERT INTO `log` VALUES(49177, 'fut scheduled', '2011-05-24 14:20:00', NULL, 194, '');
INSERT INTO `log` VALUES(49178, 'fut scheduled', '2011-05-24 14:20:00', NULL, 194, '');
INSERT INTO `log` VALUES(49179, 'fut scheduled', '2011-05-24 14:20:00', NULL, 194, '');
INSERT INTO `log` VALUES(49180, 'fut scheduled', '2011-05-24 14:20:00', NULL, 194, '');
INSERT INTO `log` VALUES(49181, 'fut scheduled', '2011-05-24 14:20:00', NULL, 194, '');
INSERT INTO `log` VALUES(49182, 'fut scheduled', '2011-05-24 14:20:00', NULL, 194, '');
INSERT INTO `log` VALUES(49183, 'fut scheduled', '2011-05-04 14:20:00', NULL, 193, '');
INSERT INTO `log` VALUES(49184, 'fut scheduled', '2011-05-04 14:20:00', NULL, 193, '');
INSERT INTO `log` VALUES(49185, 'fut scheduled', '2011-05-04 14:20:00', NULL, 193, '');
INSERT INTO `log` VALUES(49186, 'fut scheduled', '2011-05-04 14:20:00', NULL, 191, '');
INSERT INTO `log` VALUES(49187, 'fut scheduled', '2011-05-04 14:20:00', NULL, 191, '');
INSERT INTO `log` VALUES(49188, 'fut scheduled', '2011-05-04 14:20:00', NULL, 190, '');
INSERT INTO `log` VALUES(49193, 'validation completed', '2011-05-04 14:20:00', NULL, 194, '');
INSERT INTO `log` VALUES(49194, 'validation completed', '2011-05-04 14:20:00', NULL, 193, '');
INSERT INTO `log` VALUES(49195, 'validation completed', '2011-05-04 14:20:00', NULL, 191, '');
INSERT INTO `log` VALUES(49196, 'validation completed', '2011-05-04 14:20:00', NULL, 190, '');
