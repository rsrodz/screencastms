-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 29, 2015 at 08:27 AM
-- Server version: 5.5.41-37.0-log
-- PHP Version: 5.4.23

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rsrodzc1_mdcast`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

DROP TABLE IF EXISTS `tbl_comment`;
CREATE TABLE IF NOT EXISTS `tbl_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reportID` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `userID` int(11) NOT NULL,
  `comment` text NOT NULL,
  `likeCount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_report`
--

DROP TABLE IF EXISTS `tbl_report`;
CREATE TABLE IF NOT EXISTS `tbl_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateCreated` datetime NOT NULL,
  `dateRecorded` datetime NOT NULL,
  `title` text NOT NULL,
  `presenterID` int(11) NOT NULL,
  `videoUrl` text NOT NULL,
  `likeCount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sheet`
--

DROP TABLE IF EXISTS `tbl_sheet`;
CREATE TABLE IF NOT EXISTS `tbl_sheet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reportID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `sheetUrl` text NOT NULL,
  `dateCreated` datetime NOT NULL,
  `description` text NOT NULL,
  `likeCount` int(11) NOT NULL,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_track`
--

DROP TABLE IF EXISTS `tbl_track`;
CREATE TABLE IF NOT EXISTS `tbl_track` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateStamped` datetime NOT NULL,
  `url` text NOT NULL,
  `reportID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `typeID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=546 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_uritoken`
--

DROP TABLE IF EXISTS `tbl_uritoken`;
CREATE TABLE IF NOT EXISTS `tbl_uritoken` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateCreated` datetime NOT NULL,
  `token` text NOT NULL,
  `refURI` text NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=149 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `userStatus` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `lastLogin` datetime NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
