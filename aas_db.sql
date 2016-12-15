-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2016 at 08:35 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(1, 'Vision, Mission, Goals and Objectives'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

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
(9, '2016-08-29', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `dir_name` varchar(100) DEFAULT NULL,
  `rest` int(3) DEFAULT '0',
  `upl_date` datetime DEFAULT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_files`
--

INSERT INTO `tbl_files` (`file_id`, `filename`, `author_id`, `file_size`, `file_type`, `area`, `dir`, `dir_name`, `rest`, `upl_date`) VALUES
(1, '20160312_130011.jpg', 1, '1 mb', 'image/jpeg', 1, 0, '/', 1, '2016-08-29 14:18:10');

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
  PRIMARY KEY (`fldr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
