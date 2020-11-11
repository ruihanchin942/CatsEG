-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 29, 2020 at 02:11 AM
-- Server version: 5.7.31-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `catseg`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `message` longtext NOT NULL,
  `timeStamp` datetime NOT NULL,
  `teacherId` int(11) NOT NULL,
  `announcementType` varchar(3) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `message`, `timeStamp`, `teacherId`, `announcementType`, `status`) VALUES
(1, 'Announcement: Intro', 'Welcome to the end of the semester!', '2020-10-20 02:33:21', 5, '0', 0),
(13, 'Announcement: Hello 6F', 'Welcome to math101.', '2020-10-26 00:30:48', 5, '6f', 0),
(15, 'Announcement: 6F', 'Welcome class to the start of the year!', '2020-10-26 00:43:12', 5, '6E', 0),
(19, 'testing', 'testing', '2020-10-29 12:05:04', 5, '6F', 0);

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `id` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `teacherId` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` datetime NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`id`, `studentId`, `teacherId`, `message`, `timestamp`, `status`) VALUES
(38, 24, 5, 'student1', '2020-10-08 21:18:09', 0),
(39, 24, 5, 'student1', '2020-10-08 21:18:16', 0),
(40, 24, 5, 'student2', '2020-10-08 21:18:21', 0),
(41, 24, 5, 'student1', '2020-10-08 21:18:38', 0),
(42, 24, 5, 'student1', '2020-10-08 21:22:33', 0),
(43, 24, 5, 'student1', '2020-10-08 21:24:40', 0),
(46, 24, 5, 'teacher1', '2020-10-08 22:07:51', 1),
(47, 24, 5, 'teachertoo', '2020-10-08 22:25:12', 1),
(48, 40, 5, 'Hello\n', '2020-10-28 17:46:32', 0),
(49, 24, 5, 'Hello', '2020-10-29 11:10:39', 1),
(50, 25, 5, 'Hello', '2020-10-29 11:10:48', 1),
(51, 24, 5, 'Hello', '2020-10-29 11:14:19', 0),
(52, 24, 5, 'testing message', '2020-10-29 12:07:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `description` longtext NOT NULL,
  `genre` text NOT NULL,
  `grade` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`id`, `name`, `subject`, `description`, `genre`, `grade`, `status`) VALUES
(1, 'Who Lost Roger', 'English', 'Your name is Roger ... that\'s all you know. You wake up in an unknown room, and you don\'t know who you are, or where you came from. The house you are in has a weird vibe, and you need to find out who you are, and escape the house before it\'s too late ...', 'Thriller, Hidden Objects', 6, 0),
(2, 'Puzzle Master', 'Mathematics', 'Stuff', 'Mystery', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`id`, `name`, `status`) VALUES
(1, 'Ironside State School', 0),
(2, 'Holy Family Primary School', 0),
(3, 'St Ignatius School', 0),
(4, 'West End State School', 0),
(5, 'Toowong State School', 0),
(6, 'St Ita\'s Regional Primary School', 0),
(7, 'Dutton Park State School', 0),
(8, 'Milton State School', 0),
(9, 'Petrie Terrace State School', 0),
(10, 'Brisbane Central State School', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(10) UNSIGNED NOT NULL,
  `school` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nickname` varchar(20) DEFAULT NULL,
  `profileImage` varchar(100) DEFAULT NULL,
  `pwd` varchar(100) NOT NULL,
  `grade` int(1) UNSIGNED NOT NULL,
  `class` varchar(1) NOT NULL,
  `lastactivity` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `school`, `firstname`, `lastname`, `username`, `nickname`, `profileImage`, `pwd`, `grade`, `class`, `lastactivity`, `status`) VALUES
(24, 1, 'studentfirstname1', 'studentlastname1', 'student1', 'student1', '24_1603868606.jpg', 'ÁmW–Û]f—ö×«,Ji1', 6, 'F', '2020-10-29 12:09:05', 0),
(25, 1, 'studentfirstname2', 'studentlastname2', 'student2', 'student2', 'dummy.jpg', 'o[$	{çk„?2Dý«V-', 6, 'F', '2020-09-21 18:43:41', 0),
(49, 1, 'test1', 'test1', 'TESTER', NULL, NULL, 'Tbˆ	¬Ó>ûç“„ÒÞ)', 1, 'A', '2020-10-29 12:05:25', 0),
(50, 1, 'test2', 'test2', 'test2', NULL, NULL, 'Ü\\mÌ®iOJŠk5•u“S', 2, 'B', '2020-10-29 12:05:25', 0),
(51, 1, 'test3', 'test3', 'test3', NULL, NULL, '¢€6ÝÙ]@.·ŒÁ±(', 3, 'C', '2020-10-29 12:05:25', 0),
(52, 1, 'test4', 'test4', 'test4', NULL, NULL, 'ËjÇ‚Æ®ü*(ÏÍ>', 4, 'D', '2020-10-29 12:05:25', 0),
(53, 1, 'test5', 'test5', 'test5', NULL, NULL, 'Ã†Ék˜fq?\0V±lgÓéc', 5, 'E', '2020-10-29 12:05:25', 0),
(54, 1, 'test6', 'test6', 'test6', NULL, NULL, '`b1)’|üÈ1¤“†¬£\0', 6, 'F', '2020-10-29 12:05:25', 0),
(56, 1, 'f1', 'f1', 'test10', 'nickname', 'dummy.jpg', 'Ì¨¾çýþ*ðšÐŒ&*²', 1, 'A', '2020-10-29 12:05:47', 0),
(57, 1, 'test', 'test', 'test', NULL, 'dummy.jpg', 'þÞŽš;1¾™§>ÂÇà÷qº…f¯RŒƒTiA¹', 1, 'A', '2020-10-29 12:11:14', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(10) UNSIGNED NOT NULL,
  `school` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `profileImage` varchar(100) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `lastactivity` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `school`, `firstname`, `lastname`, `username`, `profileImage`, `pwd`, `lastactivity`, `status`) VALUES
(3, 1, 'Santana', 'Lopez Sir', 'mrapplepie2', '3_1600070135.jpg', 'AD(Áážzïð2\"%Ü˜T\\', '0000-00-00 00:00:00', 0),
(4, 1, 'Theodoric', 'Theo', 'mrtheo', '3_1599974146.jpg', 'kO“7[»ì%~ñ:c{', '0000-00-00 00:00:00', 0),
(5, 1, 'teacherF', 'teacherL', 'teacher1', '5_1603853244.jpg', 'fñ`¡Â7äZOäS•¡', '2020-10-29 12:11:21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `who_lost_roger`
--

CREATE TABLE `who_lost_roger` (
  `recordid` int(11) NOT NULL,
  `studentid` int(10) NOT NULL,
  `score` int(6) NOT NULL,
  `level` int(2) NOT NULL,
  `percentage` int(3) NOT NULL,
  `timeUsed` varchar(3) NOT NULL COMMENT '0~999 seconds',
  `nounsClicked` text NOT NULL COMMENT 'nouns1|nouns2|...',
  `dateTime` datetime NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `who_lost_roger`
--

INSERT INTO `who_lost_roger` (`recordid`, `studentid`, `score`, `level`, `percentage`, `timeUsed`, `nounsClicked`, `dateTime`, `status`) VALUES
(10, 24, 13, 1, 100, '9', 'Spume|Carafe|Swan|Memoir|Marigold|Cloud|Futon|Framed Art|Valise', '2020-10-16 20:26:15', 0),
(11, 25, 13, 2, 100, '9', 'Spume|Carafe|Swan|Memoir|Marigold|Cloud|Futon|Framed Art', '2020-09-17 20:26:15', 0),
(12, 25, 14, 1, 100, '9', 'Spume|Carafe|Swan|Memoir|Marigold|Cloud|Futon|Framed Art', '2020-10-16 20:26:15', 0),
(13, 25, 12, 2, 100, '9', 'Spume|Carafe|Swan|Memoir|Marigold|Cloud|Futon|Framed Art|Valise', '2020-10-16 20:26:15', 0),
(14, 24, 7, 1, 78, '15', 'Spume|Carafe|Swan|Memoir|Marigold|Cloud|Futon', '2020-10-27 11:00:44', 0),
(15, 24, 12, 1, 100, '11', 'Valise|Framed Art|Futon|Memoir|Marigold|Swan|Carafe|Spume|Cloud', '2020-10-27 11:01:18', 0),
(16, 24, 14, 1, 100, '28', 'Swan|Memoir|Marigold|Carafe|Spume|Framed Art|Futon|Valise|Cloud', '2020-10-27 11:21:58', 0),
(18, 24, 15, 1, 100, '13', 'Spume|Swan|Memoir|Marigold|Cloud|Framed Art|Futon|Valise|Carafe', '2020-10-29 11:13:59', 0),
(19, 24, 14, 1, 100, '15', 'Swan|Carafe|Futon|Framed Art|Valise|Spume|Marigold|Memoir|Cloud', '2020-10-29 12:08:56', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `school` (`school`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `school` (`school`);

--
-- Indexes for table `who_lost_roger`
--
ALTER TABLE `who_lost_roger`
  ADD PRIMARY KEY (`recordid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `who_lost_roger`
--
ALTER TABLE `who_lost_roger`
  MODIFY `recordid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_school` FOREIGN KEY (`school`) REFERENCES `school` (`id`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `fk_school2` FOREIGN KEY (`school`) REFERENCES `school` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
