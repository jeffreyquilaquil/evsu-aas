-- phpMyAdmin SQL Dump
<<<<<<< HEAD
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2017 at 11:33 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13
=======
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2016 at 08:35 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12
>>>>>>> 130510f3927dfa86a848824eb300a3d41502740d

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
<<<<<<< HEAD
/*!40101 SET NAMES utf8mb4 */;
=======
/*!40101 SET NAMES utf8 */;
>>>>>>> 130510f3927dfa86a848824eb300a3d41502740d

--
-- Database: `aas_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_allowed`
--

<<<<<<< HEAD
CREATE TABLE `tbl_allowed` (
  `aid` int(6) NOT NULL,
  `file_id` int(6) DEFAULT NULL,
  `user_id` int(6) DEFAULT NULL,
  `stat` int(2) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_allowed`
--

INSERT INTO `tbl_allowed` (`aid`, `file_id`, `user_id`, `stat`) VALUES
(1, 2, 11, 1);
=======
CREATE TABLE IF NOT EXISTS `tbl_allowed` (
  `aid` int(6) NOT NULL AUTO_INCREMENT,
  `file_id` int(6) DEFAULT NULL,
  `user_id` int(6) DEFAULT NULL,
  `stat` int(2) DEFAULT '1',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
>>>>>>> 130510f3927dfa86a848824eb300a3d41502740d

-- --------------------------------------------------------

--
-- Table structure for table `tbl_areas`
--

<<<<<<< HEAD
CREATE TABLE `tbl_areas` (
  `area_id` int(3) NOT NULL,
  `area_name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
=======
CREATE TABLE IF NOT EXISTS `tbl_areas` (
  `area_id` int(3) NOT NULL AUTO_INCREMENT,
  `area_name` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`area_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;
>>>>>>> 130510f3927dfa86a848824eb300a3d41502740d

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

<<<<<<< HEAD
CREATE TABLE `tbl_backup` (
  `bid` int(3) NOT NULL,
  `date` date DEFAULT NULL,
  `interv` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
=======
CREATE TABLE IF NOT EXISTS `tbl_backup` (
  `bid` int(3) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `interv` int(4) DEFAULT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;
>>>>>>> 130510f3927dfa86a848824eb300a3d41502740d

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
<<<<<<< HEAD
(9, '2016-08-29', 0),
(10, '2017-01-04', 0),
(11, '2017-01-04', 0),
(12, '2017-01-05', 0),
(13, '2017-01-05', 7);
=======
(9, '2016-08-29', 0);
>>>>>>> 130510f3927dfa86a848824eb300a3d41502740d

-- --------------------------------------------------------

--
-- Table structure for table `tbl_downloads`
--

<<<<<<< HEAD
CREATE TABLE `tbl_downloads` (
  `download_id` int(11) NOT NULL,
  `file_id` int(6) DEFAULT NULL,
  `user_id` int(6) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_downloads`
--

INSERT INTO `tbl_downloads` (`download_id`, `file_id`, `user_id`, `date`) VALUES
(1, 1, 1, '2017-01-04 11:12:48'),
(2, 1, 1, '2017-01-04 12:58:33'),
(3, 15, 3, '2017-01-04 14:09:40'),
(4, 2, 10, '2017-01-04 16:15:19'),
(5, 2, 10, '2017-01-04 16:18:47'),
(6, 1, 10, '2017-01-05 10:32:08'),
(7, 2, 10, '2017-01-05 10:32:20'),
(8, 2, 9, '2017-01-05 10:48:00'),
(9, 1, 10, '2017-01-05 10:48:47'),
(10, 2, 10, '2017-01-05 10:48:58'),
(11, 12, 11, '2017-01-05 10:51:15'),
(12, 16, 10, '2017-01-05 11:16:37');
=======
CREATE TABLE IF NOT EXISTS `tbl_downloads` (
  `download_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_id` int(6) DEFAULT NULL,
  `user_id` int(6) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`download_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
>>>>>>> 130510f3927dfa86a848824eb300a3d41502740d

-- --------------------------------------------------------

--
-- Table structure for table `tbl_files`
--

<<<<<<< HEAD
CREATE TABLE `tbl_files` (
  `file_id` int(6) NOT NULL,
=======
CREATE TABLE IF NOT EXISTS `tbl_files` (
  `file_id` int(6) NOT NULL AUTO_INCREMENT,
>>>>>>> 130510f3927dfa86a848824eb300a3d41502740d
  `filename` varchar(100) DEFAULT NULL,
  `author_id` int(6) DEFAULT NULL,
  `file_size` varchar(9) DEFAULT NULL,
  `file_type` varchar(10) DEFAULT NULL,
  `area` int(3) NOT NULL,
  `dir` int(11) NOT NULL DEFAULT '0',
  `dir_name` varchar(100) DEFAULT NULL,
  `rest` int(3) DEFAULT '0',
<<<<<<< HEAD
  `upl_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
=======
  `upl_date` datetime DEFAULT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
>>>>>>> 130510f3927dfa86a848824eb300a3d41502740d

--
-- Dumping data for table `tbl_files`
--

INSERT INTO `tbl_files` (`file_id`, `filename`, `author_id`, `file_size`, `file_type`, `area`, `dir`, `dir_name`, `rest`, `upl_date`) VALUES
<<<<<<< HEAD
(1, 'class.document.php', 9, '16 kb', '', 1, 1, 'IT_Department/', 0, '2017-01-04 16:13:30'),
(2, 'Application letter.docx', 9, '13 kb', 'applicatio', 1, 1, 'IT_Department/', 1, '2017-01-04 16:13:59'),
(3, 'Sleep Away.mp3', 10, '4.6 mb', 'audio/mp3', 2, 5, 'Music/', 0, '2017-01-05 06:57:05'),
(4, 'Maid with the Flaxen Hair.mp3', 10, '3.9 mb', 'audio/mp3', 2, 5, 'Music/', 0, '2017-01-05 06:57:06'),
(5, 'Sleep Away.mp3', 10, '4.6 mb', 'audio/mp3', 2, 5, 'Music/', 0, '2017-01-05 06:58:09'),
(6, 'Koala.jpg', 10, '763 kb', 'image/jpeg', 2, 6, 'Gallery/', 0, '2017-01-05 06:58:35'),
(7, 'Lighthouse.jpg', 10, '548 kb', 'image/jpeg', 2, 6, 'Gallery/', 0, '2017-01-05 06:58:35'),
(8, 'Penguins.jpg', 10, '760 kb', 'image/jpeg', 2, 6, 'Gallery/', 0, '2017-01-05 06:58:35'),
(9, 'Wildlife.wmv', 11, '25 mb', 'video/x-ms', 3, 8, 'videos/', 0, '2017-01-05 07:00:33'),
(10, 'BUDGET REGISTRY REVISED UACS CODE (FY 2016) CORRECTED  region 8-NEW.xlsx', 11, '11.1 mb', 'applicatio', 3, 7, 'Files/', 0, '2017-01-05 07:01:46'),
(11, 'Resignation letter.docx', 9, '198 kb', 'applicatio', 1, 2, 'Entrep_Department/', 0, '2017-01-05 10:49:54'),
(12, 'RESUME.docx', 9, '16 kb', 'applicatio', 1, 2, 'Entrep_Department/', 1, '2017-01-05 10:50:15'),
(13, 'Leaving.docx', 9, '12 kb', 'applicatio', 1, 3, 'Education_Department/', 0, '2017-01-05 11:15:13'),
(14, 'Resignation letter.docx', 9, '198 kb', 'applicatio', 1, 3, 'Education_Department/', 0, '2017-01-05 11:15:13'),
(15, 'RESUME.docx', 9, '16 kb', 'applicatio', 1, 3, 'Education_Department/', 0, '2017-01-05 11:15:13'),
(16, 'Cover latter.png', 9, '99 kb', 'image/png', 1, 3, 'Education_Department/', 1, '2017-01-05 11:15:37'),
(17, '21.png', 1, '446 kb', 'image/png', 1, 2, '/', 0, '2017-01-05 11:22:08');
=======
(1, '20160312_130011.jpg', 1, '1 mb', 'image/jpeg', 1, 0, '/', 1, '2016-08-29 14:18:10');
>>>>>>> 130510f3927dfa86a848824eb300a3d41502740d

-- --------------------------------------------------------

--
-- Table structure for table `tbl_folders`
--

<<<<<<< HEAD
CREATE TABLE `tbl_folders` (
  `fldr_id` int(9) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `dir` varchar(3) DEFAULT NULL,
  `area` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_folders`
--

INSERT INTO `tbl_folders` (`fldr_id`, `name`, `date`, `dir`, `area`) VALUES
(1, 'IT_Department', '2017-01-04 16:12:33', '0', 1),
(2, 'Entrep_Department', '2017-01-04 16:12:45', '0', 1),
(3, 'Education_Department', '2017-01-04 16:13:03', '0', 1),
(4, 'Fishery_Department', '2017-01-04 16:13:14', '0', 1),
(5, 'Music', '2017-01-05 06:56:33', '0', 2),
(6, 'Gallery', '2017-01-05 06:56:45', '0', 2),
(7, 'Files', '2017-01-05 06:59:50', '0', 3),
(8, 'videos', '2017-01-05 07:00:15', '0', 3),
(9, 'Sports', '2017-01-05 07:27:53', '0', 4),
(10, 'Events', '2017-01-05 07:28:10', '0', 4),
(11, 'one', '2017-01-05 11:29:20', '1', 1);
=======
CREATE TABLE IF NOT EXISTS `tbl_folders` (
  `fldr_id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `dir` varchar(3) DEFAULT NULL,
  `area` int(4) DEFAULT NULL,
  PRIMARY KEY (`fldr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
>>>>>>> 130510f3927dfa86a848824eb300a3d41502740d

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notify`
--

<<<<<<< HEAD
CREATE TABLE `tbl_notify` (
  `nid` int(4) NOT NULL,
  `file_id` int(6) DEFAULT NULL,
  `user_id` int(6) DEFAULT NULL,
  `status` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_notify`
--

INSERT INTO `tbl_notify` (`nid`, `file_id`, `user_id`, `status`) VALUES
(1, 2, 10, 0),
(2, 2, 11, 0),
(3, 2, 9, 0),
(4, 12, 11, 0),
(5, 16, 10, 0);
=======
CREATE TABLE IF NOT EXISTS `tbl_notify` (
  `nid` int(4) NOT NULL AUTO_INCREMENT,
  `file_id` int(6) DEFAULT NULL,
  `user_id` int(6) DEFAULT NULL,
  `status` int(3) DEFAULT NULL,
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
>>>>>>> 130510f3927dfa86a848824eb300a3d41502740d

-- --------------------------------------------------------

--
-- Table structure for table `tbl_questions`
--

<<<<<<< HEAD
CREATE TABLE `tbl_questions` (
  `qid` int(3) NOT NULL,
  `question` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
=======
CREATE TABLE IF NOT EXISTS `tbl_questions` (
  `qid` int(3) NOT NULL AUTO_INCREMENT,
  `question` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`qid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
>>>>>>> 130510f3927dfa86a848824eb300a3d41502740d

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

<<<<<<< HEAD
CREATE TABLE `tbl_users` (
  `user_id` int(6) NOT NULL,
=======
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(6) NOT NULL AUTO_INCREMENT,
>>>>>>> 130510f3927dfa86a848824eb300a3d41502740d
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `area` int(3) DEFAULT NULL,
  `user_type` int(3) DEFAULT NULL,
  `user_status` int(3) DEFAULT NULL,
  `sc_question` int(3) DEFAULT NULL,
  `sc_answer` int(3) DEFAULT NULL,
  `f_login` int(2) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
<<<<<<< HEAD
  `password` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
=======
  `password` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;
>>>>>>> 130510f3927dfa86a848824eb300a3d41502740d

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `firstname`, `lastname`, `area`, `user_type`, `user_status`, `sc_question`, `sc_answer`, `f_login`, `username`, `password`) VALUES
(1, 'paul', 'george', 4, 1, 1, NULL, NULL, NULL, 'admin', 'password'),
<<<<<<< HEAD
(9, 'Jerson', 'Apostol', 1, 2, 1, 0, 0, 1, 'soon', 'soon1010'),
(10, 'Karlo', 'Aruta', 2, 2, 1, 0, 0, 1, 'karlo', 'karlo'),
(11, 'Ivy', 'Sabay', 3, 2, 1, 0, 0, 1, 'ivy.sabay', 'ivy123456'),
(12, 'Herbert', 'Burdan', 4, 2, 1, 0, 0, 1, 'herbert', 'hburdan'),
(13, 'Rona', 'Darnayla', 5, 2, 1, 0, 0, 1, 'ronron', 'darnayla'),
(14, 'rustom', 'clemente', 6, 2, 1, 0, 0, 1, 'chairman', 'hcairman');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_allowed`
--
ALTER TABLE `tbl_allowed`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `tbl_areas`
--
ALTER TABLE `tbl_areas`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `tbl_backup`
--
ALTER TABLE `tbl_backup`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `tbl_downloads`
--
ALTER TABLE `tbl_downloads`
  ADD PRIMARY KEY (`download_id`);

--
-- Indexes for table `tbl_files`
--
ALTER TABLE `tbl_files`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `tbl_folders`
--
ALTER TABLE `tbl_folders`
  ADD PRIMARY KEY (`fldr_id`);

--
-- Indexes for table `tbl_notify`
--
ALTER TABLE `tbl_notify`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `tbl_questions`
--
ALTER TABLE `tbl_questions`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_allowed`
--
ALTER TABLE `tbl_allowed`
  MODIFY `aid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_areas`
--
ALTER TABLE `tbl_areas`
  MODIFY `area_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_backup`
--
ALTER TABLE `tbl_backup`
  MODIFY `bid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbl_downloads`
--
ALTER TABLE `tbl_downloads`
  MODIFY `download_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_files`
--
ALTER TABLE `tbl_files`
  MODIFY `file_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tbl_folders`
--
ALTER TABLE `tbl_folders`
  MODIFY `fldr_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbl_notify`
--
ALTER TABLE `tbl_notify`
  MODIFY `nid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_questions`
--
ALTER TABLE `tbl_questions`
  MODIFY `qid` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
=======
(2, 'Jeffrey Noel', 'Quilaquil', 1, 2, 1, 0, 0, 1, 'jeffrey.quilaquil', 'something'),
(3, 'Ivy', 'Sabay', 3, 2, 1, 0, 2154, 1, 'ivy.sabay', '123456'),
(4, 'Herbert', 'Burdan', 8, 2, 1, 0, 25, 1, 'h.bert', 'herbert'),
(5, 'sds', 'dsds', 2, 1, 1, 0, 0, 1, 'sdsds', 'sdss'),
(6, 'Hulala', 'alaluH', 1, 1, 1, 0, 0, 1, '', ''),
(7, 'adsasd', 'ad', 1, 2, 1, 0, 0, 1, 'dsad', 'sdsd');

>>>>>>> 130510f3927dfa86a848824eb300a3d41502740d
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
