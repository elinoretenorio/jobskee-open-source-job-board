-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 30, 2015 at 09:50 PM
-- Server version: 5.5.27
-- PHP Version: 5.5.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `jobskee`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@example.com', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE IF NOT EXISTS `applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `cover_letter` text COLLATE utf8_unicode_ci,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `websites` text COLLATE utf8_unicode_ci,
  `attachment` text COLLATE utf8_unicode_ci,
  `token` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `banlist`
--

CREATE TABLE IF NOT EXISTS `banlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE IF NOT EXISTS `blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`id`, `name`, `url`, `content`) VALUES
(1, 'AddThis', 'addthis', '<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-541e6f810d78ec0c"></script>\n<div class="addthis_sharing_toolbox"></div>');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `url`, `sort`) VALUES
(1, 'Programming', 'Find the best Programming jobs here!', 'programming', 1),
(2, 'Design', 'Find the best Design jobs here!', 'design', 2),
(3, 'Business', 'Find the best Business jobs here!', 'business', 3),
(4, 'IT Admin', 'Find the best IT Admin jobs here!', 'it-admin', 4),
(5, 'Content', 'Find the best Content jobs here!', 'content', 6),
(6, 'Support', 'Find the best Support jobs here!', 'support', 5);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `description`, `url`, `sort`) VALUES
(1, 'Anywhere', 'Find the best jobs here!', 'anywhere', 1),
(2, 'Manila', 'Find the best Manila jobs here!', 'manila', 2),
(3, 'Madrid', 'Find the best Madrid jobs here!', 'madrid', 3),
(4, 'Frankfurt', 'Find the best Frankfurt jobs here!', 'frankfurt', 4),
(5, 'Beijing', 'Find the best Beijing jobs here!', 'beijing', 5),
(6, 'New York', 'Find the best New York jobs here!', 'new-york', 6);

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE IF NOT EXISTS `downloads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` text COLLATE utf8_unicode_ci,
  `ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category` tinyint(4) DEFAULT NULL,
  `city` tinyint(4) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `perks` text COLLATE utf8_unicode_ci,
  `how_to_apply` text COLLATE utf8_unicode_ci,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` text COLLATE utf8_unicode_ci,
  `url` text COLLATE utf8_unicode_ci,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT NULL,
  `token` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `description`, `url`, `content`) VALUES
(1, 'About', 'About', 'about', 'about'),
(2, 'Contact', 'Contact us', 'contact', 'contact us'),
(3, 'Terms', 'Terms', 'terms', 'terms'),
(13, 'Conditions', 'Conditions', 'conditions', 'conditions');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` tinyint(4) NOT NULL,
  `city_id` tinyint(4) NOT NULL,
  `token` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_sent` datetime DEFAULT NULL,
  `is_confirmed` tinyint(4) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;