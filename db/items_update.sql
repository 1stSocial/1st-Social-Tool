-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 12, 2013 at 08:07 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `1stworld`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `title` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `created_by` int(10) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0',
  `createdTime` datetime NOT NULL,
  `board_id` int(50) NOT NULL,
  `image` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `title`, `body`, `created_by`, `status`, `createdTime`, `board_id`, `image`) VALUES
(10, 'driving', 'test', '<p>jdsfjaf</p><p>safjasf</p><p>asdf;lkdsa</p><p>fsdf</p><p><br></p>', 1, '0', '2013-09-05 03:09:42', 21, ''),
(11, 'test2', 'test2', 'hi this is a test job2...<br><p><br></p>', 1, '0', '2013-09-07 06:09:55', 23, ''),
(12, 'test3', 'test3', '<blockquote>hi this is a test job3<br></blockquote><p><br></p>', 1, '0', '2013-09-07 06:09:49', 23, ''),
(13, 'test4', 'test4', 'dsbkshdfkghdlkfghlk<p><br></p>', 1, '0', '2013-09-07 06:09:24', 23, ''),
(14, 'test5', 'test5', '<blockquote>dfjsleejflj</blockquote><p><br></p>', 1, '0', '2013-09-07 06:09:03', 23, ''),
(15, 'test6', 'driving', '<p>asdffsadf<br></p>', 1, '0', '2013-09-07 08:09:03', 23, ''),
(16, 'bmw', 'bmw', 'ajfld<p><br></p>', 1, '0', '2013-09-07 09:09:15', 24, 'assets/css/user/itemimage/upload1378972982.jpg'),
(17, 'new', 'new', 'lkjs;ak;f<p><br></p>', 1, '0', '2013-09-07 09:09:49', 23, ''),
(18, 'car', 'car', 'mksadfl<p><br></p>', 1, '0', '2013-09-07 01:09:10', 24, ''),
(21, 'image', 'new car ', 'lsdfj;l<p><br></p>', 1, '0', '2013-09-12 06:09:08', 24, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
