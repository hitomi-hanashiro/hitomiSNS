-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 24, 2020 at 09:24 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mywebsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `allow`
--

CREATE TABLE `allow` (
  `allowid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `allowUserid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `allow`
--

INSERT INTO `allow` (`allowid`, `userid`, `allowUserid`) VALUES
(23, 21, 21),
(24, 22, 22),
(25, 23, 23),
(26, 24, 24),
(27, 25, 25),
(28, 26, 26),
(29, 27, 27),
(30, 28, 28),
(31, 29, 29),
(32, 27, 21),
(33, 30, 30),
(34, 28, 21),
(35, 23, 21),
(36, 27, 29),
(37, 31, 31),
(38, 27, 31);

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chatid` int(11) NOT NULL,
  `sendid` int(11) NOT NULL,
  `receiveid` int(11) NOT NULL,
  `sendTime` datetime DEFAULT NULL,
  `sentence` varchar(100) DEFAULT NULL,
  `chatCheck` varchar(100) NOT NULL DEFAULT 'notcheck'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chatid`, `sendid`, `receiveid`, `sendTime`, `sentence`, `chatCheck`) VALUES
(19, 28, 21, '2020-01-24 14:44:58', 'hallo!', 'check'),
(20, 21, 28, '2020-01-24 14:47:44', 'haha', 'notcheck'),
(21, 31, 21, '2020-01-24 16:17:35', 'hallo!', 'check'),
(22, 21, 31, '2020-01-24 16:17:47', 'hallo!', 'check');

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `followid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `followedid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`followid`, `userid`, `followedid`) VALUES
(51, 16, 7),
(52, 16, 2),
(53, 7, 16),
(54, 16, 3),
(55, 14, 2),
(56, 17, 17),
(58, 17, 7),
(59, 17, 6),
(60, 17, 14),
(61, 7, 17),
(65, 3, 16),
(66, 7, 2),
(67, 2, 7),
(68, 2, 3),
(69, 3, 2),
(70, 1, 1),
(71, 18, 18),
(72, 19, 19),
(73, 19, 7),
(74, 7, 19),
(75, 7, 15),
(76, 15, 7),
(77, 20, 20),
(78, 21, 21),
(79, 22, 22),
(80, 23, 23),
(81, 24, 24),
(82, 25, 25),
(83, 26, 26),
(84, 27, 27),
(85, 28, 28),
(86, 29, 29),
(87, 21, 25),
(88, 21, 27),
(89, 21, 23),
(90, 21, 26),
(91, 21, 28),
(93, 21, 22),
(94, 21, 29),
(95, 27, 21),
(96, 27, 24),
(97, 27, 26),
(98, 27, 29),
(99, 30, 30),
(100, 30, 21),
(101, 29, 21),
(102, 29, 27),
(103, 28, 21),
(104, 28, 30),
(105, 28, 29),
(106, 28, 22),
(107, 28, 25),
(108, 21, 30),
(109, 26, 21),
(110, 26, 27),
(111, 26, 30),
(112, 26, 22),
(113, 26, 23),
(114, 26, 25),
(115, 23, 21),
(116, 23, 26),
(117, 31, 31),
(118, 31, 21),
(119, 31, 28),
(120, 31, 27),
(121, 27, 31);

-- --------------------------------------------------------

--
-- Table structure for table `groupChat`
--

CREATE TABLE `groupChat` (
  `groupCahtid` int(11) NOT NULL,
  `groupChatName` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL,
  `groupChatPicture` varchar(100) DEFAULT NULL,
  `groupid` int(11) NOT NULL,
  `latestTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groupChat`
--

INSERT INTO `groupChat` (`groupCahtid`, `groupChatName`, `userid`, `groupChatPicture`, `groupid`, `latestTime`) VALUES
(51, 'group1', 27, 'bucks.jpeg', 1, '2020-01-24 15:48:47'),
(52, 'group1', 29, 'bucks.jpeg', 1, '2020-01-24 15:48:47'),
(53, 'group1', 23, 'bucks.jpeg', 1, '2020-01-24 15:48:47'),
(54, 'group1', 21, 'bucks.jpeg', 1, '2020-01-24 15:48:47'),
(55, 'group1', 26, 'bucks.jpeg', 1, '2020-01-24 15:48:47'),
(56, 'group2', 30, 'post14.jpeg', 2, '2020-01-24 16:19:02'),
(57, 'group2', 29, 'post14.jpeg', 2, '2020-01-24 16:19:02'),
(58, 'group2', 26, 'post14.jpeg', 2, '2020-01-24 16:19:02'),
(59, 'group2', 21, 'post14.jpeg', 2, '2020-01-24 16:19:02'),
(60, 'group2', 23, 'post14.jpeg', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groupChatSentence`
--

CREATE TABLE `groupChatSentence` (
  `groupChatSentenceid` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `groupChatSentence` varchar(100) NOT NULL,
  `sendTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groupChatSentence`
--

INSERT INTO `groupChatSentence` (`groupChatSentenceid`, `groupid`, `userid`, `groupChatSentence`, `sendTime`) VALUES
(30, 1, 21, 'hoihoi', '2020-01-24 14:48:11'),
(31, 1, 21, 'hoihoihhoi', '2020-01-24 15:48:23'),
(32, 1, 27, 'ei', '2020-01-24 15:48:47'),
(33, 2, 21, 'hallo!', '2020-01-24 16:19:02');

-- --------------------------------------------------------

--
-- Table structure for table `groupChatSentenceCheck`
--

CREATE TABLE `groupChatSentenceCheck` (
  `groupChatSentenceCheckid` int(11) NOT NULL,
  `groupChatSentenceid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `groupid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groupChatSentenceCheck`
--

INSERT INTO `groupChatSentenceCheck` (`groupChatSentenceCheckid`, `groupChatSentenceid`, `userid`, `groupid`) VALUES
(41, 30, 27, 1),
(42, 31, 27, 1),
(43, 32, 21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `loginTime`
--

CREATE TABLE `loginTime` (
  `loginTimeID` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loginTime`
--

INSERT INTO `loginTime` (`loginTimeID`, `userid`, `time`) VALUES
(194, 24, '2020-01-24 14:20:41'),
(195, 25, '2020-01-24 14:21:43'),
(202, 22, '2020-01-24 14:31:13'),
(207, 29, '2020-01-24 14:37:41'),
(210, 26, '2020-01-24 14:45:38'),
(211, 23, '2020-01-24 14:46:03'),
(216, 28, '2020-01-24 15:08:24'),
(221, 30, '2020-01-24 16:08:09'),
(228, 27, '2020-01-24 16:20:22'),
(229, 31, '2020-01-24 16:20:40'),
(230, 21, '2020-01-24 17:10:46');

-- --------------------------------------------------------

--
-- Table structure for table `nice`
--

CREATE TABLE `nice` (
  `niceid` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'unlike'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nice`
--

INSERT INTO `nice` (`niceid`, `postid`, `userid`, `status`) VALUES
(39, 48, 27, 'unlike'),
(40, 51, 21, 'unlike'),
(41, 53, 21, 'unlike'),
(42, 48, 21, 'unlike'),
(43, 51, 31, 'unlike'),
(45, 50, 21, 'unlike');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `postid` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `vio` varchar(200) NOT NULL,
  `postPicture` varchar(100) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `postDay` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`postid`, `title`, `vio`, `postPicture`, `userid`, `postDay`) VALUES
(48, 'hitomi is handosme', 'as;ljgfdnlkanl;rwnglnaw;lnglk;an;flegn;', 'post1.jpeg', 29, '2020-01-24 14:27:51'),
(49, 'hitomi is handsome', 'hahahahhaahahahhahhhahhahahaa', 'post2.jpeg', 28, '2020-01-24 14:28:33'),
(50, 'hitomi is fabulous', 'aasdlgna;lnwbfgakblsfdjj;;kbasfgd', 'post3.jpeg', 27, '2020-01-24 14:29:08'),
(51, 'You flatter me', 'af.mgnl;anklgnlkansd;ngl;ansflkgnlak;sfng', 'post5.jpeg', 21, '2020-01-24 14:29:55'),
(52, 'We love Hitomi', 'afsgfafgdsfglka@rohgiafdon', 'post6.jpeg', 23, '2020-01-24 14:31:02'),
(53, 'Hitomi is genious', 'adsflmgn;lanlgknlak;wn;glqwl;rng', 'post7.jpeg', 22, '2020-01-24 14:31:39'),
(54, 'I am stupid', 'afd,/mgljaqbnfgjlbql;er', 'post11.jpeg', 31, '2020-01-24 16:15:10'),
(55, 'I am crazy', 'as:;djgk:asjk:fgl', 'post10.jpeg', 31, '2020-01-24 16:15:38');

-- --------------------------------------------------------

--
-- Table structure for table `postComment`
--

CREATE TABLE `postComment` (
  `postCommentid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `comment` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `postComment`
--

INSERT INTO `postComment` (`postCommentid`, `userid`, `postid`, `comment`) VALUES
(4, 28, 49, 'I like this picture!'),
(5, 21, 48, 'Thankyou'),
(6, 31, 54, 'sorry');

-- --------------------------------------------------------

--
-- Table structure for table `pre_user`
--

CREATE TABLE `pre_user` (
  `pre_userid` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `privacy` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pre_user`
--

INSERT INTO `pre_user` (`pre_userid`, `username`, `password`, `picture`, `privacy`, `email`, `token`) VALUES
(3, 'haruka', 'haruka', 'flower.gif', '11', 'grryd@icloud.com', '3fecd5f7e66cf617a6bb895ace107c25');

-- --------------------------------------------------------

--
-- Table structure for table `share`
--

CREATE TABLE `share` (
  `shareid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `postid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `share`
--

INSERT INTO `share` (`shareid`, `userid`, `postid`) VALUES
(28, 29, 48),
(29, 28, 49),
(30, 27, 50),
(31, 21, 51),
(32, 23, 52),
(33, 22, 53),
(34, 27, 48),
(35, 21, 50),
(36, 31, 54),
(37, 31, 55),
(38, 31, 50);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `privacy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `password`, `picture`, `privacy`) VALUES
(21, 'hitomi', 'eebbef99d3a895383556e90c5f3fbb3b', 'hair1.jpeg', 'unlock'),
(22, 'curt', '0d9ab6066a79ccddb295cbd1be995201', 'hair2.jpg', 'unlock'),
(23, 'hotaka', 'f6d7d2f0aed2250bf0a2492292ab9a40', 'toni.jpeg', 'lock'),
(25, 'tenga', '044580a6d3ead0f3ba4f68caec711e40', 'yuamikami.jpeg', 'unlock'),
(26, 'sho', '02a55f6b0b75a11ad1dedf9f8b4d9b4f', 'hair3.jpg', 'unlock'),
(27, 'girl', '28ca53d2b7bb4aa13549b4022c79dca1', 'connie.jpg', 'lock'),
(28, 'haruka', 'b450788dc032917ae79b28cd5423ff68', 'girl.jpg', 'lock'),
(29, 'maika', '89e54ac6eda659d247a747d212e2e29d', 'girl3.jpg', 'unlock'),
(30, 'seiya', 'a7a9a28ff3930a99fbbbf8c7944bfeb0', 'slide5.jpeg', 'unlock'),
(31, 'curt1', '9147497b68915eb67c023656fecd89da', 'flower.gif', 'lock');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allow`
--
ALTER TABLE `allow`
  ADD PRIMARY KEY (`allowid`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chatid`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`followid`);

--
-- Indexes for table `groupChat`
--
ALTER TABLE `groupChat`
  ADD PRIMARY KEY (`groupCahtid`);

--
-- Indexes for table `groupChatSentence`
--
ALTER TABLE `groupChatSentence`
  ADD PRIMARY KEY (`groupChatSentenceid`);

--
-- Indexes for table `groupChatSentenceCheck`
--
ALTER TABLE `groupChatSentenceCheck`
  ADD PRIMARY KEY (`groupChatSentenceCheckid`);

--
-- Indexes for table `loginTime`
--
ALTER TABLE `loginTime`
  ADD PRIMARY KEY (`loginTimeID`);

--
-- Indexes for table `nice`
--
ALTER TABLE `nice`
  ADD PRIMARY KEY (`niceid`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postid`);

--
-- Indexes for table `postComment`
--
ALTER TABLE `postComment`
  ADD PRIMARY KEY (`postCommentid`);

--
-- Indexes for table `pre_user`
--
ALTER TABLE `pre_user`
  ADD PRIMARY KEY (`pre_userid`);

--
-- Indexes for table `share`
--
ALTER TABLE `share`
  ADD PRIMARY KEY (`shareid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allow`
--
ALTER TABLE `allow`
  MODIFY `allowid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chatid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `followid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `groupChat`
--
ALTER TABLE `groupChat`
  MODIFY `groupCahtid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `groupChatSentence`
--
ALTER TABLE `groupChatSentence`
  MODIFY `groupChatSentenceid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `groupChatSentenceCheck`
--
ALTER TABLE `groupChatSentenceCheck`
  MODIFY `groupChatSentenceCheckid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `loginTime`
--
ALTER TABLE `loginTime`
  MODIFY `loginTimeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;

--
-- AUTO_INCREMENT for table `nice`
--
ALTER TABLE `nice`
  MODIFY `niceid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `postid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `postComment`
--
ALTER TABLE `postComment`
  MODIFY `postCommentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pre_user`
--
ALTER TABLE `pre_user`
  MODIFY `pre_userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `share`
--
ALTER TABLE `share`
  MODIFY `shareid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
