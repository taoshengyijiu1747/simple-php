-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 29, 2016 at 09:12 PM
-- Server version: 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mydate`
--

-- --------------------------------------------------------

--
-- Table structure for table `rsslink`
--

CREATE TABLE IF NOT EXISTS `rsslink` (
  `url` varchar(300) NOT NULL,
  `id` int(5) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `rsslink`
--

INSERT INTO `rsslink` (`url`, `id`) VALUES
('IGh0dHA6Ly93d3cudDA4Ni5jb20vY29kZS9waHAvZnVuY3Rpb24ucGhwLWJhc2U2NF9kZWNvZGUucGhw', 1),
('IHNkdGdqZmRzZ2pkZmdqZGZramRmamQ=', 2),
('IGRmaGtkZ2hrZ2ZqaGtmZ2poa2g0NTYzNDU2', 3),
('IGh0dHA6Ly9wdC54c3l1LmVkdS5jbi90b3JyZW50cnNzLnBocD9yb3dzPTEwJmxpbmt0eXBlPWRsJnBhc3NrZXk9ZWEwZmE2NWQyOWYzZDI1NjU3Yjc0ZTJhM2IyYjY2OWE=', 4),
('IGh0dHA6Ly93d3cudzNzY2hvb2wuY29tLmNuL3NxbC9zcWxfYWx0ZXIuYXNw', 5),
('IDJ3NnkyNTQ3Nnk1NHkyNDV1eWV3cnR5d3RyeXd0ZXJ1eXdydHl3cnR5dzR0eQ==', 6),
('IHdldGhkZmdqaGRzZmdqaGRmZ2pnZGhmag==', 7);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
