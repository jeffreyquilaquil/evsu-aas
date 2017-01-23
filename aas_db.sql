-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2017 at 07:21 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `aas_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_allowed`
--

CREATE TABLE IF NOT EXISTS `tbl_allowed` (
  `aid` int(6) NOT NULL AUTO_INCREMENT,
  `file_id` int(6) DEFAULT NULL,
  `user_id` int(6) DEFAULT NULL,
  `stat` int(2) DEFAULT '1',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_areas`
--

CREATE TABLE IF NOT EXISTS `tbl_areas` (
  `area_id` int(3) NOT NULL AUTO_INCREMENT,
  `area_name` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`area_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_areas`
--

INSERT INTO `tbl_areas` (`area_id`, `area_name`) VALUES
(1, 'Vision, Mission, Goals and Objectivess'),
(2, 'The Faculty'),
(3, 'Curriculum and Instruction'),
(4, 'Support to Students'),
(5, 'Research'),
(6, 'Extension and Community Involvement'),
(7, 'Library'),
(8, 'Physical Plant and Facilities'),
(9, 'Laboratories'),
(10, 'Administration');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_backup`
--

CREATE TABLE IF NOT EXISTS `tbl_backup` (
  `bid` int(3) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `interv` int(4) DEFAULT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=161 ;

--
-- Dumping data for table `tbl_backup`
--

INSERT INTO `tbl_backup` (`bid`, `date`, `interv`) VALUES
(1, '2016-08-29', 0),
(2, '2016-08-29', 0),
(3, '2016-08-29', 0),
(4, '2016-08-29', 0),
(5, '2016-08-29', 0),
(6, '2016-08-29', 0),
(7, '2016-08-29', 0),
(8, '2016-08-29', 0),
(9, '2016-08-29', 0),
(10, '2016-09-18', 0),
(11, '2016-09-18', 0),
(12, '2016-09-18', 0),
(13, '2016-09-18', 0),
(14, '2016-09-18', 0),
(15, '2016-09-18', 0),
(16, '2016-09-18', 0),
(17, '2016-09-18', 0),
(18, '2016-09-18', 0),
(19, '2016-09-18', 0),
(20, '2016-09-18', 0),
(21, '2016-09-18', 0),
(22, '2016-09-18', 0),
(23, '2016-09-18', 0),
(24, '2016-09-18', 0),
(25, '2016-09-18', 0),
(26, '2016-09-18', 0),
(27, '2016-09-18', 0),
(28, '2016-09-18', 0),
(29, '2016-09-18', 0),
(30, '2016-09-18', 0),
(31, '2016-09-18', 0),
(32, '2016-09-18', 0),
(33, '2016-09-18', 0),
(34, '2016-09-18', 0),
(35, '2016-09-19', 0),
(36, '2016-09-19', 0),
(37, '2016-09-19', 0),
(38, '2016-09-19', 0),
(39, '2016-09-19', 0),
(40, '2016-09-19', 0),
(41, '2016-09-19', 0),
(42, '2016-09-19', 0),
(43, '2016-09-19', 0),
(44, '2016-09-19', 0),
(45, '2016-11-14', 0),
(46, '2016-11-14', 0),
(47, '2016-11-14', 0),
(48, '2016-12-01', 0),
(49, '2016-12-01', 0),
(50, '2016-12-01', 0),
(51, '2016-12-01', 0),
(52, '2016-12-01', 0),
(53, '2016-12-01', 0),
(54, '2016-12-01', 0),
(55, '2016-12-01', 0),
(56, '2016-12-02', 0),
(57, '2016-12-02', 0),
(58, '2016-12-02', 0),
(59, '2016-12-02', 0),
(60, '2016-12-02', 0),
(61, '2016-12-02', 0),
(62, '2016-12-02', 0),
(63, '2016-12-02', 0),
(64, '2016-12-02', 0),
(65, '2016-12-02', 0),
(66, '2016-12-02', 0),
(67, '2016-12-08', 0),
(68, '2016-12-08', 0),
(75, '2016-12-11', 0),
(76, '2017-01-03', 0),
(77, '2017-01-07', 0),
(78, '2017-01-07', 0),
(79, '2017-01-07', 0),
(80, '2017-01-07', 0),
(81, '2017-01-07', 0),
(82, '2017-01-07', 0),
(83, '2017-01-07', 0),
(84, '2017-01-07', 0),
(85, '2017-01-07', 0),
(86, '2017-01-07', 0),
(87, '2017-01-07', 0),
(88, '2017-01-07', 0),
(89, '2017-01-07', 0),
(90, '2017-01-07', 0),
(91, '2017-01-07', 0),
(92, '2017-01-07', 0),
(93, '2017-01-07', 0),
(94, '2017-01-07', 0),
(95, '2017-01-07', 0),
(96, '2017-01-07', 0),
(97, '2017-01-07', 0),
(98, '2017-01-07', 0),
(99, '2017-01-07', 0),
(100, '2017-01-07', 0),
(101, '2017-01-07', 0),
(102, '2017-01-07', 0),
(103, '2017-01-07', 0),
(104, '2017-01-07', 0),
(105, '2017-01-08', 0),
(106, '2017-01-08', 0),
(107, '2017-01-08', 0),
(108, '2017-01-08', 0),
(109, '2017-01-08', 0),
(110, '2017-01-08', 0),
(111, '2017-01-08', 0),
(112, '2017-01-08', 0),
(113, '2017-01-08', 0),
(114, '2017-01-08', 0),
(115, '2017-01-08', 0),
(116, '2017-01-08', 0),
(117, '2017-01-08', 0),
(118, '2017-01-08', 0),
(119, '2017-01-08', 0),
(120, '2017-01-08', 0),
(121, '2017-01-08', 0),
(122, '2017-01-08', 0),
(123, '2017-01-08', 0),
(124, '2017-01-13', 0),
(125, '2017-01-13', 0),
(126, '2017-01-13', 0),
(127, '2017-01-13', 0),
(128, '2017-01-13', 0),
(129, '2017-01-13', 0),
(130, '2017-01-13', 0),
(131, '2017-01-13', 0),
(132, '2017-01-20', 0),
(133, '2017-01-20', 0),
(134, '2017-01-20', 0),
(135, '2017-01-20', 0),
(136, '2017-01-21', 0),
(137, '2017-01-21', 0),
(138, '2017-01-21', 0),
(139, '2017-01-21', 0),
(140, '2017-01-22', 0),
(141, '2017-01-22', 0),
(142, '2017-01-22', 0),
(143, '2017-01-22', 0),
(144, '2017-01-22', 0),
(145, '2017-01-22', 0),
(146, '2017-01-22', 0),
(147, '2017-01-22', 0),
(148, '2017-01-22', 0),
(149, '2017-01-22', 0),
(150, '2017-01-22', 0),
(151, '2017-01-22', 0),
(152, '2017-01-22', 0),
(153, '2017-01-22', 0),
(154, '2017-01-22', 0),
(155, '2017-01-22', 0),
(156, '2017-01-22', 0),
(157, '2017-01-22', 0),
(158, '2017-01-22', 0),
(159, '2017-01-22', 0),
(160, '2017-01-22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_downloads`
--

CREATE TABLE IF NOT EXISTS `tbl_downloads` (
  `download_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_id` int(6) DEFAULT NULL,
  `user_id` int(6) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`download_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_downloads`
--

INSERT INTO `tbl_downloads` (`download_id`, `file_id`, `user_id`, `date`) VALUES
(1, 1, 2, '2016-09-18 01:16:45'),
(2, 1, 1, '2016-09-19 00:20:59'),
(3, 1, 1, '2016-11-14 18:26:36'),
(4, 6, 1, '2016-12-02 21:54:35'),
(5, 5, 1, '2016-12-02 21:54:42'),
(6, 5, 1, '2016-12-02 22:04:27'),
(7, 7, 4, '2016-12-11 22:27:29'),
(8, 3, 4, '2016-12-11 22:28:20'),
(9, 17, 1, '2017-01-22 11:22:51'),
(10, 18, 1, '2017-01-22 11:26:40'),
(11, 17, 1, '2017-01-22 11:28:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_files`
--

CREATE TABLE IF NOT EXISTS `tbl_files` (
  `file_id` int(6) NOT NULL AUTO_INCREMENT,
  `filename` varchar(100) DEFAULT NULL,
  `author_id` int(6) DEFAULT NULL,
  `file_size` varchar(9) DEFAULT NULL,
  `file_type` varchar(10) DEFAULT NULL,
  `area` int(3) NOT NULL,
  `dir` int(11) NOT NULL DEFAULT '0',
  `rest` int(3) DEFAULT '0',
  `upl_date` datetime DEFAULT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_folders`
--

CREATE TABLE IF NOT EXISTS `tbl_folders` (
  `fldr_id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `dir` varchar(3) DEFAULT NULL,
  `area` int(4) DEFAULT NULL,
  `dir_name` text NOT NULL,
  PRIMARY KEY (`fldr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notify`
--

CREATE TABLE IF NOT EXISTS `tbl_notify` (
  `nid` int(4) NOT NULL AUTO_INCREMENT,
  `file_id` int(6) DEFAULT NULL,
  `user_id` int(6) DEFAULT NULL,
  `status` int(3) DEFAULT NULL,
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_questions`
--

CREATE TABLE IF NOT EXISTS `tbl_questions` (
  `qid` int(3) NOT NULL AUTO_INCREMENT,
  `question` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`qid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(6) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `area` int(3) DEFAULT NULL,
  `user_type` int(3) DEFAULT NULL,
  `user_status` int(3) DEFAULT NULL,
  `sc_question` int(3) DEFAULT NULL,
  `sc_answer` int(3) DEFAULT NULL,
  `f_login` int(2) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `firstname`, `lastname`, `area`, `user_type`, `user_status`, `sc_question`, `sc_answer`, `f_login`, `username`, `password`) VALUES
(1, 'paul', 'george', 4, 1, 1, NULL, NULL, NULL, 'admin', 'password'),
(2, 'Jeffrey Noel', 'Quilaquil', 1, 2, 1, 0, 0, 1, 'jeffrey.quilaquil', 'something'),
(3, 'Ivy', 'Sabay', 3, 2, 1, 0, 2154, 1, 'ivy.sabay', '123456'),
(4, 'Herbert', 'Burdan', 8, 2, 1, 0, 25, 1, 'h.bert', 'herbert'),
(5, 'sds', 'dsds', 2, 1, 1, 0, 0, 1, 'sdsds', 'sdss'),
(6, 'Hulala', 'alaluH', 1, 1, 1, 0, 0, 1, '', ''),
(7, 'adsasd', 'ad', 1, 2, 1, 0, 0, 1, 'dsad', 'sdsd');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
