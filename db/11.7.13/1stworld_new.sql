-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 07, 2013 at 02:11 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `1stworld_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `board`
--

CREATE TABLE IF NOT EXISTS `board` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `parent_tags` varchar(100) DEFAULT NULL,
  `createdTime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `Filterable_taxo` int(4) NOT NULL,
  `image` varchar(200) NOT NULL,
  `board_title` varchar(100) NOT NULL,
  `call_to_action` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `board_id` (`id`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `board`
--

INSERT INTO `board` (`id`, `name`, `parent_tags`, `createdTime`, `created_by`, `Filterable_taxo`, `image`, `board_title`, `call_to_action`) VALUES
(23, 'job', '57', '2013-09-06 09:09:36', 1, 2, 'assets/img/internal/logo_img/upload1380877229.jpg', 'job', 'Apply'),
(24, 'vehicle', '21', '2013-09-07 08:09:44', 1, 0, 'assets/img/internal/logo_img/upload1380873631.jpg', 'vehicle', ''),
(30, 'bodley', '36', '2013-09-23 11:09:59', 1, 7, 'assets/img/internal/logo_img/upload1382067886.jpg', 'The Bodley', 'Apply Here'),
(36, 'p&i', '36', '2013-10-08 02:10:36', 1, 7, '', 'Property and Investment', ''),
(37, 'regents', '50', '2013-10-08 02:10:49', 1, 7, 'assets/img/internal/logo_img/upload1381198601.jpg', 'Regents Lane, Woolloongabba', 'Apply'),
(44, 'test', '36,50', '2013-10-11 01:10:44', 1, 7, '', 'test', 'test'),
(45, 'tyrepower', '57', '2013-10-14 03:10:11', 1, 0, 'assets/img/internal/logo_img/upload1381761791.jpg', 'Tyrepower Jobs', ''),
(46, 'property', '36,50', '2013-10-16 10:10:57', 1, 7, 'assets/img/internal/logo_img/upload1383007118.jpg', 'Property & Investment', 'More Info'),
(47, 'triple', '36,50,57', '2013-10-17 12:10:57', 1, 7, '', 'triple', '');

-- --------------------------------------------------------

--
-- Table structure for table `board_domain`
--

CREATE TABLE IF NOT EXISTS `board_domain` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `board_id` int(4) NOT NULL,
  `domain_id` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

--
-- Dumping data for table `board_domain`
--

INSERT INTO `board_domain` (`id`, `board_id`, `domain_id`) VALUES
(3, 25, 1),
(6, 28, 2),
(8, 27, 2),
(15, 31, 15),
(26, 24, 2),
(39, 36, 15),
(58, 45, 1),
(62, 47, 13),
(68, 23, 1),
(69, 44, 15),
(71, 30, 15),
(72, 37, 15),
(74, 46, 15);

-- --------------------------------------------------------

--
-- Table structure for table `board_page`
--

CREATE TABLE IF NOT EXISTS `board_page` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `board_id` int(10) NOT NULL,
  `theme_id` int(4) NOT NULL,
  `board_css` text,
  `board_html` text NOT NULL,
  `board_js` text,
  `created_by` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `board_id` (`board_id`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `board_page`
--

INSERT INTO `board_page` (`id`, `board_id`, `theme_id`, `board_css`, `board_html`, `board_js`, `created_by`) VALUES
(2, 23, 2, NULL, '', NULL, 0),
(3, 24, 0, NULL, '', NULL, 0),
(5, 26, 0, NULL, '', NULL, 0),
(9, 30, 0, NULL, '', NULL, 0),
(15, 36, 0, NULL, '', NULL, 0),
(16, 37, 0, NULL, '', NULL, 0),
(23, 44, 0, NULL, '', NULL, 0),
(24, 45, 0, NULL, '', NULL, 0),
(25, 46, 0, NULL, '', NULL, 0),
(26, 47, 0, NULL, '', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `board_tags`
--

CREATE TABLE IF NOT EXISTS `board_tags` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `board_id` int(10) NOT NULL,
  `tag_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `board_id` (`board_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=90 ;

--
-- Dumping data for table `board_tags`
--

INSERT INTO `board_tags` (`id`, `board_id`, `tag_id`) VALUES
(30, 24, 21),
(32, 26, 1),
(42, 36, 2),
(65, 45, 57),
(71, 47, 36),
(72, 47, 50),
(73, 47, 57),
(79, 23, 57),
(80, 44, 36),
(81, 44, 50),
(84, 30, 36),
(85, 37, 50),
(88, 46, 36),
(89, 46, 50);

-- --------------------------------------------------------

--
-- Table structure for table `board_users`
--

CREATE TABLE IF NOT EXISTS `board_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `board_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

--
-- Dumping data for table `board_users`
--

INSERT INTO `board_users` (`id`, `board_id`, `user_id`) VALUES
(52, 24, 2),
(64, 26, 2),
(73, 23, 2),
(74, 23, 4);

-- --------------------------------------------------------

--
-- Table structure for table `domain`
--

CREATE TABLE IF NOT EXISTS `domain` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `parent_tags` varchar(100) NOT NULL,
  `createdTime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `domain`
--

INSERT INTO `domain` (`id`, `name`, `parent_tags`, `createdTime`) VALUES
(1, 'job', '', '2013-09-09 00:00:00'),
(2, 'car', '', '2013-09-10 00:00:00'),
(13, 'test', '', '2013-09-23 04:09:26'),
(14, 'iQuantum', '', '2013-09-23 10:09:47'),
(15, '1stWorld', '', '2013-09-24 02:09:07');

-- --------------------------------------------------------

--
-- Table structure for table `domain_tags`
--

CREATE TABLE IF NOT EXISTS `domain_tags` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `domain_id` int(10) NOT NULL,
  `tag_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `domain_id` (`domain_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `parent_tag_id` int(10) NOT NULL,
  `call_to_action` varchar(600) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=138 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `title`, `body`, `created_by`, `status`, `createdTime`, `board_id`, `image`, `parent_tag_id`, `call_to_action`) VALUES
(16, 'bmw 2', 'bmw 2', '<p><img style="width: 123.186px; height: 92px;" src="http://localhost/1st-Social-Tool-master/1st-Social-Tool/assets/css/user/content/Desert.jpg"></p><img style="width: 126.593px; height: 96px;" src="http://media1.santabanta.com/full1/Cars/BMW/bmw-26v.jpg"> BMW 23<br><br><b><span style="color: #fbd5b5;"><font color="#548dd4"><strike><span style="background-color: rgb(255, 255, 0);"></span></strike></font></span><iframe src="//www.youtube.com/embed/b_Oyt8jxTi8" allowfullscreen="" frameborder="0" height="315" width="560"></iframe></b><p></p><p></p><br><p></p>\n', 1, '0', '2013-09-07 09:09:15', 24, '', 21, ''),
(28, 'tm', 'tm', 'flsjdfakjflfjlkfljljf;lk<p><br></p>', 1, '0', '2013-09-16 01:09:51', 24, 'assets/css/user/itemimage/upload1379334591.jpg', 21, ''),
(31, 'new vehicle', 'new vehicle', 'ahdsflkhlakd<p><br></p>', 1, '0', '2013-09-19 11:09:02', 24, 'assets/css/user/itemimage/upload1379585822.jpg', 21, ''),
(35, 'xv', 'xv', '<p>vcb<br></p>', 1, '0', '2013-09-19 11:09:13', 24, 'assets/css/user/itemimage/upload1379586193.jpg', 21, ''),
(36, 'xv', 'xv', '<p>vcb<br></p>', 1, '0', '2013-09-19 11:09:19', 24, 'assets/css/user/itemimage/upload1379586199.jpg', 21, ''),
(39, 'sfdsaf', 'sfdsaf', '<p>asdfasdf<br></p>', 1, '0', '2013-09-19 11:09:28', 24, 'assets/css/user/itemimage/upload1379586687.jpg', 21, ''),
(43, 'rtyj', 'rtyj', '<p>hgjfj<br></p>', 1, '0', '2013-09-20 07:09:49', 24, 'assets/css/user/itemimage/upload1379656909.jpg', 21, ''),
(44, 'rtyj', 'rtyj', '<p>hgjfj<br></p>', 1, '0', '2013-09-20 07:09:04', 24, 'assets/css/user/itemimage/upload1379656924.jpg', 21, ''),
(45, 'rtyj', 'rtyj', '<p>hgjfj<br></p>', 1, '0', '2013-09-20 07:09:37', 24, 'assets/css/user/itemimage/upload1379656956.jpg', 21, ''),
(47, 'yiuiu', 'yiuiu', '<p>6676<br></p>', 1, '0', '2013-09-20 07:09:51', 24, 'assets/css/user/itemimage/upload1379657151.jpg', 21, ''),
(48, 'yiuiu', 'yiuiu', '<p>6676<br></p>', 1, '0', '2013-09-20 07:09:01', 24, 'assets/css/user/itemimage/upload1379657161.jpg', 21, ''),
(49, 'yiuiu', 'yiuiu', '<p>6676<br></p>', 1, '0', '2013-09-20 07:09:14', 24, 'assets/css/user/itemimage/upload1379657174.jpg', 21, ''),
(51, 'sfgdsfgs', 'sfgdsfgs', '<p>fgsdfgsdgsdg<br></p>', 1, '0', '2013-09-20 07:09:27', 24, '', 21, ''),
(52, 'dsfsdff', 'dsfsdff', '<p>dfgdghfhffghffgh<br></p>', 1, '0', '2013-09-23 05:09:53', 24, '', 21, ''),
(53, 'sfkjshf', 'sfkjshf', '<p>asdfasdfsad<br></p>', 1, '0', '2013-09-23 05:09:51', 24, '', 21, ''),
(57, 'Apartment G03 - 2 Beds, 2 Bath', 'Apartment G03 - 2 Beds, 2 Baths + Study', '<p>Construction has commenced on this exclusive boutique development, with only 28 luxury apartments, situated on  Beaumaris'' best beaches and boasts location and lifestyle.</p><p></p><ul><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Spacious 1, 2 & 3 Bedroom apartments with bay views</span></li><li>European styling and fit out incorporating natural stone and limed American Oak floor boards</li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Walking distance to beach and bike tracks</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Public Transport Access</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Close to Melbourne''s most prestigious Private schools</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Easy access to boutique shopping in Beaumaris and Westfield Southland</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">For Further information contact Jason Bell on 0408 655 772 or email <a href="mailto:jason@propertyandinvestment.com.au">jason@propertyandinvestment.com.au</a></span><br></li></ul><p></p>\n', 1, '0', '2013-10-01 01:10:10', 30, 'assets/css/user/itemimage/upload1381898842.jpg', 36, 'https://www.facebook.com/pages/The-Bodley-Apt-G03-2-Bdrms-2-Baths/546523598752349?id=546523598752349&sk=app_349013331835948'),
(58, 'Apartment G04 - 2 Beds, 2 Bath', 'Apartment G04 - 2 Beds, 2 Baths + Study', '<p>Construction has commenced on this exclusive boutique development, with only 28 luxury apartments, situated on &nbsp;Beaumaris'' best beaches and boasts location and lifestyle.</p><p></p><ul><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Spacious 1, 2 &amp; 3 Bedroom apartments with bay views</span></li><li>European styling and fit out incorporating natural stone and limed American Oak floor boards</li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Walking distance to beach and bike tracks</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Public Transport Access</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Close to Melbourne''s most prestigious Private schools</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Easy access to boutique shopping in Beaumaris and Westfield Southland</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">For Further information contact Jason Bell on 0408 655 772 or email <a href="mailto:jason@propertyandinvestment.com.au">jason@propertyandinvestment.com.au</a></span><br></li></ul><p></p>\n', 1, '0', '2013-10-01 01:10:24', 30, 'assets/css/user/itemimage/upload1381898759.jpg', 36, ''),
(59, 'Apartment G05 - 2 Beds, 2 Bath', 'Apartment G05 - 2 Beds, 2 Baths + Study', '<p>Construction has commenced on this exclusive boutique development, with only 28 luxury apartments, situated on &nbsp;Beaumaris'' best beaches and boasts location and lifestyle.</p><p></p><ul><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Spacious 1, 2 &amp; 3 Bedroom apartments with bay views</span></li><li>European styling and fit out incorporating natural stone and limed American Oak floor boards</li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Walking distance to beach and bike tracks</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Public Transport Access</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Close to Melbourne''s most prestigious Private schools</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Easy access to boutique shopping in Beaumaris and Westfield Southland</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">For Further information contact Jason Bell on 0408 655 772 or email <a href="mailto:jason@propertyandinvestment.com.au">jason@propertyandinvestment.com.au</a></span><br></li></ul><p></p>\n', 1, '0', '2013-10-01 02:10:10', 30, 'assets/css/user/itemimage/upload1381898466.jpg', 36, ''),
(60, 'Apartment G06 - 2 Beds, 2 Bath', 'Apartment G06 - 2 Beds, 2 Baths + Study', '<p>Construction has commenced on this exclusive boutique development, with only 28 luxury apartments, situated on &nbsp;Beaumaris'' best beaches and boasts location and lifestyle.</p><p></p><ul><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Spacious 1, 2 &amp; 3 Bedroom apartments with bay views</span></li><li>European styling and fit out incorporating natural stone and limed American Oak floor boards</li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Walking distance to beach and bike tracks</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Public Transport Access</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Close to Melbourne''s most prestigious Private schools</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Easy access to boutique shopping in Beaumaris and Westfield Southland</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">For Further information contact Jason Bell on 0408 655 772 or email <a href="mailto:jason@propertyandinvestment.com.au">jason@propertyandinvestment.com.au</a></span><br></li></ul><p></p>\n', 1, '0', '2013-10-01 02:10:46', 30, 'assets/css/user/itemimage/upload1381898344.jpg', 36, ''),
(61, 'Apartment G07 - 2 Beds, 2 Bath', 'Apartment G07 - 2 Beds, 2 Baths + Study', '<p>Construction has commenced on this exclusive boutique development, with only 28 luxury apartments, situated on &nbsp;Beaumaris'' best beaches and boasts location and lifestyle.</p><p></p><ul><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Spacious 1, 2 &amp; 3 Bedroom apartments with bay views</span></li><li>European styling and fit out incorporating natural stone and limed American Oak floor boards</li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Walking distance to beach and bike tracks</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Public Transport Access</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Close to Melbourne''s most prestigious Private schools</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Easy access to boutique shopping in Beaumaris and Westfield Southland</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">For Further information contact Jason Bell on 0408 655 772 or email <a href="mailto:jason@propertyandinvestment.com.au">jason@propertyandinvestment.com.au</a></span><br></li></ul><p></p>\n', 1, '0', '2013-10-01 02:10:59', 30, 'assets/css/user/itemimage/upload1381898147.jpg', 36, ''),
(62, 'Apartment G11 - 2 Beds, 2 Bath', 'Apartment G11 - 2 Beds, 2 Baths + Study', '<p>Construction has commenced on this exclusive boutique development, with only 28 luxury apartments, situated on  Beaumaris'' best beaches and boasts location and lifestyle.</p><p></p><ul><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Spacious 1, 2 & 3 Bedroom apartments with bay views</span></li><li>European styling and fit out incorporating natural stone and limed American Oak floor boards</li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Walking distance to beach and bike tracks</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Public Transport Access</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Close to Melbourne''s most prestigious Private schools</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Easy access to boutique shopping in Beaumaris and Westfield Southland</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">For Further information contact Jason Bell on 0408 655 772 or email <a href="mailto:jason@propertyandinvestment.com.au">jason@propertyandinvestment.com.au</a></span><br></li></ul><p></p>\n', 1, '0', '2013-10-01 02:10:15', 30, 'assets/css/user/itemimage/upload1381898056.jpg', 36, 'https://www.facebook.com/pages/The-Bodley-Apt-G11-2-Bdrms-2-Baths/259650720826965?id=259650720826965&sk=app_445131198938710'),
(64, 'Apartment 106 - 2 Beds, 2 Bath', 'Apartment 106 - 2 Beds, 2 Baths + Study', '<p>Construction has commenced on this exclusive boutique development, with only 28 luxury apartments, situated on  Beaumaris'' best beaches and boasts location and lifestyle.</p><p></p><ul><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Spacious 1, 2 & 3 Bedroom apartments with bay views</span></li><li>European styling and fit out incorporating natural stone and limed American Oak floor boards</li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Walking distance to beach and bike tracks</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Public Transport Access</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Close to Melbourne''s most prestigious Private schools</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Easy access to boutique shopping in Beaumaris and Westfield Southland</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">For Further information contact Jason Bell on 0408 655 772 or email <a href="mailto:jason@propertyandinvestment.com.au">jason@propertyandinvestment.com.au</a></span><br></li></ul><p></p>\n', 1, '1', '2013-10-01 02:10:09', 30, 'assets/css/user/itemimage/upload1381897832.jpg', 36, 'https://www.facebook.com/pages/The-Bodley-Apt-106-2-Bdrms-2-Baths/1379428925612940?id=1379428925612940&sk=app_445131198938710'),
(67, 'Apartment 105 - 2 Beds, 2 Bath', 'Apartment 105 - 2 Beds, 2 Baths + Study', '<p>Construction has commenced on this exclusive boutique development, with only 28 luxury apartments, situated on  Beaumaris'' best beaches and boasts location and lifestyle.</p><p></p><ul><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Spacious 1, 2 & 3 Bedroom apartments with bay views</span></li><li>European styling and fit out incorporating natural stone and limed American Oak floor boards</li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Walking distance to beach and bike tracks</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Public Transport Access</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Close to Melbourne''s most prestigious Private schools</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Easy access to boutique shopping in Beaumaris and Westfield Southland</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">For Further information contact Jason Bell on 0408 655 772 or email <a href="mailto:jason@propertyandinvestment.com.au">jason@propertyandinvestment.com.au</a></span><br></li></ul><p></p>', 1, '1', '2013-10-04 01:10:55', 30, 'assets/css/user/itemimage/upload1381897715.jpg', 36, ''),
(68, 'Apartment 108 - 2 Beds, 2 Bath', 'Apartment 108 - 2 Beds, 2 Baths + Study', '<p>Construction has commenced on this exclusive boutique development, with only 28 luxury apartments, situated on &nbsp;Beaumaris'' best beaches and boasts location and lifestyle.</p><p></p><ul><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Spacious 1, 2 &amp; 3 Bedroom apartments with bay views</span></li><li>European styling and fit out incorporating natural stone and limed American Oak floor boards</li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Walking distance to beach and bike tracks</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Public Transport Access</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Close to Melbourne''s most prestigious Private schools</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Easy access to boutique shopping in Beaumaris and Westfield Southland</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">For Further information contact Jason Bell on 0408 655 772 or email <a href="mailto:jason@propertyandinvestment.com.au">jason@propertyandinvestment.com.au</a></span><br></li></ul><p></p>\n', 1, '1', '2013-10-04 01:10:01', 30, 'assets/css/user/itemimage/upload1380846240.jpg', 36, ''),
(69, 'Apartment 109 - 2 Bed, 2 Bath ', 'Apartment 109 - 2 Bed, 2 Bath + Study', '<p>Construction has commenced on this exclusive boutique development, with only 28 luxury apartments, situated on &nbsp;Beaumaris'' best beaches and boasts location and lifestyle.</p><p></p><ul><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Spacious 1, 2 &amp; 3 Bedroom apartments with bay views</span></li><li>European styling and fit out incorporating natural stone and limed American Oak floor boards</li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Walking distance to beach and bike tracks</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Public Transport Access</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Close to Melbourne''s most prestigious Private schools</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Easy access to boutique shopping in Beaumaris and Westfield Southland</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">For Further information contact Jason Bell on 0408 655 772 or email <a href="mailto:jason@propertyandinvestment.com.au">jason@propertyandinvestment.com.au</a></span><br></li></ul><p></p>\n', 1, '1', '2013-10-04 01:10:36', 30, 'assets/css/user/itemimage/upload1380846335.jpg', 36, ''),
(70, 'Apartment 110 - 2 Bed, 2 Bath ', 'Apartment 110 - 2 Bed, 2 Bath + Study', '<p>Construction has commenced on this exclusive boutique development, with only 28 luxury apartments, situated on &nbsp;Beaumaris'' best beaches and boasts location and lifestyle.</p><p></p><ul><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Spacious 1, 2 &amp; 3 Bedroom apartments with bay views</span></li><li>European styling and fit out incorporating natural stone and limed American Oak floor boards</li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Walking distance to beach and bike tracks</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Public Transport Access</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Close to Melbourne''s most prestigious Private schools</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Easy access to boutique shopping in Beaumaris and Westfield Southland</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">For Further information contact Jason Bell on 0408 655 772 or email <a href="mailto:jason@propertyandinvestment.com.au">jason@propertyandinvestment.com.au</a></span><br></li></ul><p></p>\n', 1, '1', '2013-10-04 01:10:20', 30, 'assets/css/user/itemimage/upload1380846439.jpg', 36, ''),
(71, 'Apartment 111 - 2 Bed, 2 Bath ', 'Apartment 111 - 2 Bed, 2 Bath + Study', '<p>Construction has commenced on this exclusive boutique development, with only 28 luxury apartments, situated on &nbsp;Beaumaris'' best beaches and boasts location and lifestyle.</p><p></p><ul><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Spacious 1, 2 &amp; 3 Bedroom apartments with bay views</span></li><li>European styling and fit out incorporating natural stone and limed American Oak floor boards</li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Walking distance to beach and bike tracks</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Public Transport Access</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Close to Melbourne''s most prestigious Private schools</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Easy access to boutique shopping in Beaumaris and Westfield Southland</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">For Further information contact Jason Bell on 0408 655 772 or email <a href="mailto:jason@propertyandinvestment.com.au">jason@propertyandinvestment.com.au</a></span><br></li></ul><p></p>\n', 1, '1', '2013-10-04 01:10:43', 30, 'assets/css/user/itemimage/upload1380846522.jpg', 36, ''),
(72, 'Apartment 202 - 3 Beds, 2 Bath', 'Apartment 202 - 3 Beds, 2 Baths + Study', '<p>Construction has commenced on this exclusive boutique development, with only 28 luxury apartments, situated on &nbsp;Beaumaris'' best beaches and boasts location and lifestyle.</p><p></p><ul><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Spacious 1, 2 &amp; 3 Bedroom apartments with bay views</span></li><li>European styling and fit out incorporating natural stone and limed American Oak floor boards</li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Walking distance to beach and bike tracks</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Public Transport Access</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Close to Melbourne''s most prestigious Private schools</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Easy access to boutique shopping in Beaumaris and Westfield Southland</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">For Further information contact Jason Bell on 0408 655 772 or email <a href="mailto:jason@propertyandinvestment.com.au">jason@propertyandinvestment.com.au</a></span><br></li></ul><p></p>\n', 1, '1', '2013-10-04 01:10:11', 30, 'assets/css/user/itemimage/upload1380846671.jpg', 36, ''),
(73, 'Apartment 203 - 3 Beds, 2 Bath', 'Apartment 203 - 3 Beds, 2 Baths', '<p>Construction has commenced on this exclusive boutique development, with only 28 luxury apartments, situated on &nbsp;Beaumaris'' best beaches and boasts location and lifestyle.</p><p></p><ul><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Spacious 1, 2 &amp; 3 Bedroom apartments with bay views</span></li><li>European styling and fit out incorporating natural stone and limed American Oak floor boards</li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Walking distance to beach and bike tracks</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Public Transport Access</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Close to Melbourne''s most prestigious Private schools</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Easy access to boutique shopping in Beaumaris and Westfield Southland</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">For Further information contact Jason Bell on 0408 655 772 or email <a href="mailto:jason@propertyandinvestment.com.au">jason@propertyandinvestment.com.au</a></span><br></li></ul><p></p>\n', 1, '1', '2013-10-04 01:10:38', 30, 'assets/css/user/itemimage/upload1381897646.jpg', 36, ''),
(74, 'Apartment 204 - 3 Beds, 2 Bath', 'Apartment 204 - 3 Beds, 2 Baths + Study', '<p>Construction has commenced on this exclusive boutique development, with only 28 luxury apartments, situated on &nbsp;Beaumaris'' best beaches and boasts location and lifestyle.</p><p></p><ul><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Spacious 1, 2 &amp; 3 Bedroom apartments with bay views</span></li><li>European styling and fit out incorporating natural stone and limed American Oak floor boards</li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Walking distance to beach and bike tracks</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Public Transport Access</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Close to Melbourne''s most prestigious Private schools</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Easy access to boutique shopping in Beaumaris and Westfield Southland</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">For Further information contact Jason Bell on 0408 655 772 or email <a href="mailto:jason@propertyandinvestment.com.au">jason@propertyandinvestment.com.au</a></span><br></li></ul><p></p>\n', 1, '0', '2013-10-04 01:10:21', 30, 'assets/css/user/itemimage/upload1380846860.jpg', 36, ''),
(75, 'Apartment 205 - 3 Beds, 3 Bath', 'Apartment 205 - 3 Beds, 3 Baths + Study', '<p>Construction has commenced on this exclusive boutique development, with only 28 luxury apartments, situated on &nbsp;Beaumaris'' best beaches and boasts location and lifestyle.</p><p></p><ul><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Spacious 1, 2 &amp; 3 Bedroom apartments with bay views</span></li><li>European styling and fit out incorporating natural stone and limed American Oak floor boards</li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Walking distance to beach and bike tracks</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Public Transport Access</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Close to Melbourne''s most prestigious Private schools</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Easy access to boutique shopping in Beaumaris and Westfield Southland</span><br></li><li><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">For Further information contact Jason Bell on 0408 655 772 or email <a href="mailto:jason@propertyandinvestment.com.au">jason@propertyandinvestment.com.au</a></span><br></li></ul><p></p>\n', 1, '0', '2013-10-04 01:10:59', 30, 'assets/css/user/itemimage/upload1380846958.jpg', 36, ''),
(77, 'Apartment 50 Level 2   East Fa', 'Apartment 50 Level 2   East Facing 2 Bedroom 2 Bathroom', '<p>Walk-in & Built-in Wardrobe, Secure Car Park, Lock up Storage Facility, Large Balcony, Bi-Fold Windows (East facing Apartments Only), Air-conditioning & Fans, Quality Timber Tiles & Carpet, Stone Bench tops, Breakfast Bar, and Blinds.  <br></p>', 1, '0', '2013-10-08 02:10:26', 37, 'assets/css/user/itemimage/upload1381802014.jpg', 50, 'https://www.facebook.com/pages/Regents-Lane-Apt-50-2-Bdrms-2-Baths/167221333473182?id=167221333473182&sk=app_749461815071284'),
(78, 'Apartment 53 Level 7 North Fac', 'Apartment 53 Level 7 North Facing 2 Bedroom 2 Bathroom  ', '<p>Walk-in & Built-in Wardrobe, Secure Car Park, Lock up Storage Facility, Large Balcony, Bi-Fold Windows (East facing Apartments Only), Air-conditioning & Fans, Quality Timber Tiles & Carpet, Stone Bench tops, Breakfast Bar, and Blinds.  <br></p>', 1, '0', '2013-10-08 02:10:13', 37, 'assets/css/user/itemimage/upload1381803501.jpg', 50, 'https://www.facebook.com/pages/Regents-Lane-Apt-53-2-Bdrms-2-Baths/569317086472958?id=569317086472958&sk=app_749461815071284'),
(79, 'Apartment 55 West Facing 1 Bed', 'Apartment 55 West Facing 1 Bedroom 1 Bathroom ', '<p>Walk-in & Built-in Wardrobe, Secure Car Park, Lock up Storage Facility, Large Balcony, Bi-Fold Windows (East facing Apartments Only), Air-conditioning & Fans, Quality Timber Tiles & Carpet, Stone Bench tops, Breakfast Bar, and Blinds.  <br></p>', 1, '0', '2013-10-08 03:10:29', 37, 'assets/css/user/itemimage/upload1381803815.jpg', 50, 'https://www.facebook.com/pages/Regents-Lane-Apt-55-1-Bdrm-1-Bath/214087908766908?id=214087908766908&sk=app_749461815071284'),
(107, 'today news 2', 'today news 2', '<p>this is a test</p>', 1, '0', '2013-10-12 10:10:37', 44, 'assets/css/user/itemimage/upload1381568700.jpg', 50, ''),
(112, 'Apartment 45 Level 6 North Fac', 'Apartment 45 Level 6 North Facing 2 Bedroom 2 Bathroom ', '<p>Walk-in & Built-in Wardrobe, Secure Car Park, Lock up Storage Facility, Large Balcony, Bi-Fold Windows (East facing Apartments Only), Air-conditioning & Fans, Quality Timber Tiles & Carpet, Stone Bench tops, Breakfast Bar, and Blinds.  <br></p>', 1, '0', '2013-10-14 04:10:26', 37, 'assets/css/user/itemimage/upload1381803558.jpg', 50, 'https://www.facebook.com/pages/Regents-Lane-Apt-45-2-Bdrms-2-Baths/611998402197108?id=611998402197108&sk=app_749461815071284'),
(113, 'Apartment 37 Level 5 North Fac', 'Apartment 37 Level 5 North Facing 2 Bedroom 2 Bathroom ', '<p>Walk-in & Built-in Wardrobe, Secure Car Park, Lock up Storage Facility, Large Balcony, Bi-Fold Windows (East facing Apartments Only), Air-conditioning & Fans, Quality Timber Tiles & Carpet, Stone Bench tops, Breakfast Bar, and Blinds.  <br></p>', 1, '0', '2013-10-14 04:10:01', 37, 'assets/css/user/itemimage/upload1381803584.jpg', 50, 'https://www.facebook.com/pages/Regents-Lane-Apt-37-2-Bdrms-2-Baths/343189302488127?id=343189302488127&sk=app_749461815071284'),
(114, 'Apartment 13 Level 2 North Fac', 'Apartment 13 Level 2 North Facing 2 Bedroom 2 Bathroom ', '<p>Walk-in & Built-in Wardrobe, Secure Car Park, Lock up Storage Facility, Large Balcony, Bi-Fold Windows (East facing Apartments Only), Air-conditioning & Fans, Quality Timber Tiles & Carpet, Stone Bench tops, Breakfast Bar, and Blinds.  <br></p>', 1, '1', '2013-10-14 05:10:52', 37, 'assets/css/user/itemimage/upload1381803660.jpg', 50, 'https://www.facebook.com/pages/Regents-Lane-Apt-13-2-Bdrms-2-Baths/316445575164047?id=316445575164047&sk=app_749461815071284'),
(115, 'Apartment 42 Level 6 East Faci', 'Apartment 42 Level 6 East Facing  2 Bedroom 2 Bathroom ', '<p>Walk-In & Built-In Wardrobes, <span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Secure Car Park & Separate Storage Facility, </span><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Large Balcony with Bi- Fold Windows, </span><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Air-Conditioning & Fans, </span><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Quality Timber Tiles & Carpet, </span><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Stone Bench tops, </span><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Breakfast Bar, and </span><span style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px; line-height: 1.45em;">Blinds.  </span></p><p> </p>\n', 1, '0', '2013-10-15 12:10:50', 37, 'assets/css/user/itemimage/upload1381803073.jpg', 50, 'https://www.facebook.com/pages/Regents-Lane-Apt-42-2-Bdrms-2-Baths/208617555982564?id=208617555982564&sk=app_749461815071284'),
(116, 'Apartment 34 Level 5 East Faci', 'Apartment 34 Level 5 East Facing  2 Bedroom 2 Bathroom', '<p>Walk-In & Built-In Wardrobes, Secure Car Parking & Separate Storage Facility, Large Balcony with Bi- Fold Windows, Air-Conditioning & Fans, Quality Timber Tiles & Carpet, Stone Bench tops, Breakfast Bar, Blinds  <br></p>', 1, '0', '2013-10-15 12:10:41', 37, 'assets/css/user/itemimage/upload1381803131.jpg', 50, 'https://www.facebook.com/pages/Regents-Lane-Apt-34-2-Bdrms-2-Baths/169151403289964?id=169151403289964&sk=app_749461815071284'),
(117, 'Apartment 26 Level 4 2 Bedroom', 'Apartment 26 Level 4 2 Bedroom 2 Bathroom ', '<p>Walk-In & Built-In Wardrobes, Secure Car Parking & Separate Storage Facility, Large Balcony with Bi- Fold Windows, Air-Conditioning & Fans, Quality Timber Tiles & Carpet, Stone Bench tops, Breakfast Bar, Blinds  <br></p>', 1, '0', '2013-10-15 12:10:45', 37, 'assets/css/user/itemimage/upload1381803188.jpg', 50, 'https://www.facebook.com/pages/Regents-Lane-Apt-26-2-Bdrms-2-Baths/533422556740019?id=533422556740019&sk=app_749461815071284'),
(118, 'Apartment 44 Level 6 East Faci', 'Apartment 44 Level 6 East Facing 2 Bedroom 2 Bathroom', '<p>Walk-In & Built-In Wardrobes, Secure Car Park, Storage Lock Up Facility, Large Balcony with Bi- Fold Windows, Air-Conditioning & Fans, Quality Timber Tiles & Carpet, Stone Bench tops, Breakfast Bar, Blinds  <br></p>', 1, '0', '2013-10-15 12:10:30', 37, 'assets/css/user/itemimage/upload1381803335.jpg', 50, 'https://www.facebook.com/pages/Regents-Lane-Apt-44-2-Bdrms-2-Baths/203839706465185?id=203839706465185&sk=app_749461815071284'),
(119, 'Apartment 36 Level 5 East Faci', 'Apartment 36 Level 5 East Facing 2 Bedroom 2 Bathroom ', '<p>Walk-In & Built-In Wardrobes, Secure Car Park, Storage Lock Up Facility, Large Balcony with Bi- Fold Windows, Air-Conditioning & Fans, Quality Timber Tiles & Carpet, Stone Bench tops, Breakfast Bar, Blinds  <br></p>', 1, '0', '2013-10-15 12:10:45', 37, 'assets/css/user/itemimage/upload1381803384.jpg', 50, ''),
(120, 'Apartment 28 Level 4 East Faci', 'Apartment 28 Level 4 East Facing 2 Bedroom 2 Bathroom ', '<p>Walk-In & Built-In Wardrobes, Secure Car Park, Storage Lock Up Facility, Large Balcony with Bi- Fold Windows, Air-Conditioning & Fans, Quality Timber Tiles & Carpet, Stone Bench tops, Breakfast Bar, Blinds  <br></p>', 1, '0', '2013-10-15 12:10:14', 37, 'assets/css/user/itemimage/upload1381803447.jpg', 50, 'https://www.facebook.com/pages/Regents-Lane-Apt-28-2-Bdrms-2-Baths/513877628708575?id=513877628708575&sk=app_749461815071284'),
(121, 'Apartment 46 Level 6 West Faci', 'Apartment 46 Level 6 West Facing 2 Bedroom 2 Bathroom ', '<p>Walk-In & Built-In Wardrobes, Secure Car Park, Storage Lock Up Facility, Large Balcony with Bi- Fold Windows, Air-Conditioning & Fans, Quality Timber Tiles & Carpet, Stone Bench tops, Breakfast Bar, Blinds  <br></p>', 1, '0', '2013-10-15 12:10:00', 37, 'assets/css/user/itemimage/upload1381803716.jpg', 50, 'https://www.facebook.com/pages/Regents-Lane-Apt-46-2-Bdrms-2-Baths/545531502194495?id=545531502194495&sk=app_749461815071284'),
(122, 'Apartment 38 Level 5 West Faci', 'Apartment 38 Level 5 West Facing  2 Bedroom 2 Bathroom ', '<p>Walk-In & Built-In Wardrobes, Secure Car Park, Storage Lock Up Facility, Large Balcony with Bi- Fold Windows, Air-Conditioning & Fans, Quality Timber Tiles & Carpet, Stone Bench tops, Breakfast Bar, Blinds  <br></p>', 1, '0', '2013-10-15 12:10:14', 37, 'assets/css/user/itemimage/upload1381803756.jpg', 50, 'https://www.facebook.com/pages/Regents-Lane-Apt-38-2-Bdrms-2-Baths/249511061863093?id=249511061863093&sk=app_749461815071284'),
(123, 'Apartment 56 Level 7 West Faci', 'Apartment 56 Level 7 West Facing 2 Bedroom 2 Bathroom ', '<p>Walk-In & Built-In Wardrobes, Secure Car Park,  Lock Up Storage Facility, Large Balcony, Air-Conditioning & Fans, Quality Timber Tiles & Carpet, Stone Bench tops, Breakfast Bar, and Blinds.  <br></p>\n', 1, '0', '2013-10-15 12:10:48', 37, 'assets/css/user/itemimage/upload1381803986.jpg', 50, ''),
(124, 'Apartment 48 Level 6 West Faci', 'Apartment 48 Level 6 West Facing 2 Bedroom 2 Bathroom ', '<p>Walk-In & Built-In Wardrobes, Secure Car Park,  Lock Up Storage Facility, Large Balcony with, Air-Conditioning & Fans, Quality Timber Tiles & Carpet, Stone Bench tops, Breakfast Bar, Blinds  <br></p>', 1, '0', '2013-10-15 12:10:12', 37, 'assets/css/user/itemimage/upload1381804027.jpg', 50, 'https://www.facebook.com/pages/Regents-Lane-Apt-48-2-Bdrms-2-Baths/399387876856390?id=399387876856390&sk=app_749461815071284'),
(125, 'Apartment 40 Level 5 West Faci', 'Apartment 40 Level 5 West Facing 2 Bedroom 2 Bathroom ', '<p>Walk-In & Built-In Wardrobes, Secure Car Park,  Lock Up Storage Facility, Large Balcony with, Air-Conditioning & Fans, Quality Timber Tiles & Carpet, Stone Bench tops, Breakfast Bar, Blinds  <br></p>', 1, '0', '2013-10-15 12:10:35', 37, 'assets/css/user/itemimage/upload1381804072.jpg', 50, 'https://www.facebook.com/pages/Regents-Lane-Apt-40-2-Bdrms-2-Baths/215812201926654?id=215812201926654&sk=app_749461815071284'),
(126, 'Apartment 8 Level 1 West Facin', 'Apartment 8 Level 1 West Facing 2 Bedroom 2 Bathroom ', '<p>Walk-In & Built-In Wardrobes, Secure Car Park,  Lock Up Storage Facility, Large Balcony with, Air-Conditioning & Fans, Quality Timber Tiles & Carpet, Stone Bench tops, Breakfast Bar, Blinds  <br></p>', 1, '0', '2013-10-15 12:10:31', 37, 'assets/css/user/itemimage/upload1381804114.jpg', 50, ''),
(127, 'Apartment 23 Level 3 West Faci', 'Apartment 23 Level 3 West Facing 1 Bedroom 1 Bathroom ', '<p> Built-In Wardrobes, Secure Car Park, Large Balcony, Air-Conditioning & Fans, Quality Timber Tiles & Carpet, Stone Bench tops, Study, Blinds  <br></p>', 1, '0', '2013-10-15 12:10:05', 37, 'assets/css/user/itemimage/upload1381803849.jpg', 50, ''),
(128, 'Apartment 15 Level 2 West Faci', 'Apartment 15 Level 2 West Facing 1 Bedroom 1 Bathroom ', '<p> Built-In Wardrobes, Secure Car Park, Large Balcony, Air-Conditioning & Fans, Quality Timber Tiles & Carpet, Stone Bench tops, Study, Blinds  <br></p>', 1, '1', '2013-10-15 12:10:25', 37, 'assets/css/user/itemimage/upload1381803877.jpg', 50, ''),
(129, 'Apartment 7 Level 1 West Facin', 'Apartment 7 Level 1 West Facing 1 Bedroom 1 Bathroom ', '<p> Built-In Wardrobes, Secure Car Park, Large Balcony, Air-Conditioning & Fans, Quality Timber Tiles & Carpet, Stone Bench tops, Study, Blinds  <br></p>', 1, '0', '2013-10-15 12:10:42', 37, 'assets/css/user/itemimage/upload1381803932.jpg', 50, ''),
(130, 'Apartment 57 Level 7 South Fac', 'Apartment 57 Level 7 South Facing 2 Bedroom 2 Bathroom ', '<p> Walk In & Built-In Wardrobes, Secure Car Park, Lock Up & Storage Facility, Large Balcony, Bi-Fold Windows, Air-Conditioning & Fans, Quality Timber Tiles & Carpet, Stone Bench tops, Breakfast Bar, Blinds  <br></p>', 1, '0', '2013-10-15 12:10:14', 37, 'assets/css/user/itemimage/upload1381804164.jpg', 50, 'https://www.facebook.com/pages/Regents-Lane-Apt-57-2-Bdrms-2-Baths/667288019956797?id=667288019956797&sk=app_749461815071284'),
(131, 'Apartment 49 Level 6 South Fac', 'Apartment 49 Level 6 South Facing 2 Bedroom 2 Bathroom ', '<p>Walk-In & Built-In Wardrobe, Secure Car Park, Lock Up Storage Facility, Large Balcony, Bi-Fold Windows, Air-Conditioning & Fans, Quality Timber Tiles & Carpet, Stone Bench tops, and Blinds. <br></p>\n', 1, '0', '2013-10-15 12:10:51', 37, 'assets/css/user/itemimage/upload1381804207.jpg', 50, 'https://www.facebook.com/pages/Regents-Lane-Apt-49-2-Bdrms-2-Baths/727238710637399?id=727238710637399&sk=app_749461815071284'),
(132, 'Apartment 41 Level 5 South Fac', 'Apartment 41 Level 5 South Facing 2 Bedroom 2 Bathroom ', '<p> Built-In Wardrobes, Secure Car Park, Large Balcony, Air-Conditioning & Fans, Quality Timber Tiles & Carpet, Stone Bench tops, Study, Blinds  <br></p>', 1, '0', '2013-10-15 12:10:16', 37, 'assets/css/user/itemimage/upload1381804242.jpg', 50, 'https://www.facebook.com/pages/Regents-Lane-Apt-41-2-Bdrms-2-Baths/669563333062708?id=669563333062708&sk=app_749461815071284'),
(133, 'Apartment 9 Level 1 South Faci', 'Apartment 9 Level 1 South Facing 2 Bedroom 2 Bathroom ', '<p> Walk in & Built-In Wardrobes, Secure Car Park, Lock Up Storage Facility, Large Balcony, Air-Conditioning & Fans, Quality Timber Tiles & Carpet, Stone Bench tops, Study, Blinds  <br></p>', 1, '0', '2013-10-15 12:10:57', 37, 'assets/css/user/itemimage/upload1381804447.jpg', 50, ''),
(136, 'YES', 'YES', '<p>testing</p>', 1, '1', '2013-10-18 12:10:43', 24, '', 21, 'http://www.com.com'),
(137, 'YES', 'YES', '<p>testing</p>', 1, '1', '2013-10-18 12:10:04', 24, 'assets/css/user/itemimage/upload1382052300.jpg', 21, 'http://www.com.com');

-- --------------------------------------------------------

--
-- Table structure for table `item_tags`
--

CREATE TABLE IF NOT EXISTS `item_tags` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tag_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tag_id` (`tag_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=773 ;

--
-- Dumping data for table `item_tags`
--

INSERT INTO `item_tags` (`id`, `tag_id`, `item_id`) VALUES
(117, 5, 19),
(118, 5, 20),
(129, 6, 28),
(139, 6, 28),
(193, 7, 31),
(195, 6, 35),
(206, 7, 47),
(207, 9, 47),
(209, 7, 51),
(214, 6, 52),
(215, 6, 53),
(220, 42, 56),
(225, 6, 16),
(466, 52, 107),
(467, 53, 107),
(586, 54, 119),
(595, 55, 127),
(597, 55, 129),
(598, 55, 123),
(601, 55, 126),
(605, 53, 133),
(647, 6, 136),
(648, 6, 137),
(683, 55, 128),
(701, 1, 67),
(702, 38, 67),
(703, 46, 67),
(709, 1, 68),
(710, 38, 68),
(711, 47, 68),
(712, 1, 69),
(713, 38, 69),
(714, 48, 69),
(715, 1, 70),
(716, 38, 70),
(717, 48, 70),
(718, 1, 71),
(719, 38, 71),
(720, 48, 71),
(721, 1, 72),
(722, 38, 72),
(723, 39, 72),
(724, 49, 72),
(725, 1, 73),
(726, 38, 73),
(727, 39, 73),
(728, 46, 73),
(729, 38, 74),
(730, 39, 74),
(731, 46, 74),
(732, 38, 75),
(733, 39, 75),
(734, 46, 75),
(737, 38, 58),
(738, 46, 58),
(739, 38, 59),
(740, 46, 59),
(741, 38, 60),
(742, 48, 60),
(743, 38, 61),
(744, 46, 61),
(747, 38, 62),
(748, 45, 62),
(749, 1, 64),
(750, 38, 64),
(751, 45, 64),
(752, 38, 57),
(753, 45, 57),
(754, 52, 114),
(755, 54, 117),
(756, 54, 120),
(757, 54, 116),
(758, 52, 113),
(759, 55, 122),
(761, 55, 125),
(762, 53, 132),
(763, 54, 115),
(764, 54, 118),
(765, 52, 112),
(766, 55, 121),
(767, 55, 124),
(768, 53, 131),
(769, 54, 77),
(770, 52, 78),
(771, 55, 79),
(772, 53, 130);

-- --------------------------------------------------------

--
-- Table structure for table `item_taxo`
--

CREATE TABLE IF NOT EXISTS `item_taxo` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `item_id` int(5) NOT NULL,
  `taxo_id` int(5) NOT NULL,
  `value` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2411 ;

--
-- Dumping data for table `item_taxo`
--

INSERT INTO `item_taxo` (`id`, `item_id`, `taxo_id`, `value`) VALUES
(109, 19, 4, '22'),
(110, 19, 5, '22'),
(111, 19, 6, '222'),
(112, 20, 4, '33'),
(113, 20, 5, '33'),
(114, 20, 6, '33'),
(173, 28, 4, '45000'),
(174, 28, 5, 'ankit'),
(175, 28, 6, '45000'),
(288, 31, 4, '4500'),
(289, 31, 5, 'a20'),
(290, 31, 6, '4500'),
(294, 35, 4, '3333'),
(295, 35, 5, '333'),
(296, 35, 6, '3333'),
(311, 47, 4, '5454'),
(312, 47, 5, '54454'),
(313, 47, 6, '54554'),
(317, 51, 4, '223323'),
(318, 51, 5, '2322323'),
(319, 51, 6, '233223'),
(324, 52, 4, '455454'),
(325, 52, 5, 'fhfghj'),
(326, 53, 4, '45454'),
(327, 53, 5, 'abc'),
(332, 56, 9, '99'),
(336, 16, 4, '4500'),
(1213, 107, 7, '4545'),
(1214, 107, 18, '2'),
(1215, 107, 19, '2'),
(1216, 107, 20, '2'),
(1217, 107, 21, '2'),
(1218, 107, 22, '2'),
(1707, 119, 7, '487000'),
(1708, 119, 18, '2'),
(1709, 119, 19, 'A'),
(1710, 119, 20, '78'),
(1711, 119, 21, '19'),
(1712, 119, 22, '97'),
(1761, 127, 7, '352000'),
(1762, 127, 18, '1'),
(1763, 127, 19, 'E'),
(1764, 127, 20, '55'),
(1765, 127, 21, '11'),
(1766, 127, 22, '66'),
(1773, 129, 7, '340000'),
(1774, 129, 18, '1'),
(1775, 129, 19, 'E'),
(1776, 129, 20, '55'),
(1777, 129, 21, '12'),
(1778, 129, 22, '67'),
(1779, 123, 7, '519000'),
(1780, 123, 18, '2'),
(1781, 123, 19, 'A1'),
(1782, 123, 20, '80'),
(1783, 123, 21, '19'),
(1784, 123, 22, '99'),
(1797, 126, 7, '460000'),
(1798, 126, 18, '2'),
(1799, 126, 19, 'A1'),
(1800, 126, 20, '80'),
(1801, 126, 21, '35'),
(1802, 126, 22, '115'),
(1821, 133, 7, '456000'),
(1822, 133, 18, '2'),
(1823, 133, 19, 'C'),
(1824, 133, 20, '74'),
(1825, 133, 21, '28'),
(1826, 133, 22, '102'),
(2087, 128, 7, '346000'),
(2088, 128, 18, '1'),
(2089, 128, 19, 'E'),
(2090, 128, 20, '55'),
(2091, 128, 21, '11'),
(2092, 128, 22, '66'),
(2133, 67, 7, '919000'),
(2134, 67, 10, '2'),
(2135, 67, 11, '2'),
(2136, 67, 12, '2'),
(2137, 67, 13, '100.00'),
(2138, 67, 14, '109.00'),
(2139, 67, 15, '109.00'),
(2140, 67, 16, 'Yes'),
(2161, 68, 7, '950000'),
(2162, 68, 10, '2'),
(2163, 68, 11, '2'),
(2164, 68, 12, '2'),
(2165, 68, 13, '112.00'),
(2166, 68, 14, '19.80'),
(2167, 68, 15, '131.80'),
(2168, 68, 16, 'Yes'),
(2169, 69, 7, '935000'),
(2170, 69, 10, '2'),
(2171, 69, 11, '2'),
(2172, 69, 12, '2'),
(2173, 69, 13, '103.00'),
(2174, 69, 14, '9.00'),
(2175, 69, 15, '112.00'),
(2176, 69, 16, 'Yes'),
(2177, 70, 7, '935000'),
(2178, 70, 10, '2'),
(2179, 70, 11, '2'),
(2180, 70, 12, '2'),
(2181, 70, 13, '103.00'),
(2182, 70, 14, '9.00'),
(2183, 70, 15, '112.00'),
(2184, 70, 16, 'Yes'),
(2185, 71, 7, '935000'),
(2186, 71, 10, '2'),
(2187, 71, 11, '2'),
(2188, 71, 12, '2'),
(2189, 71, 13, '103.00'),
(2190, 71, 14, '9.00'),
(2191, 71, 15, '112.00'),
(2192, 71, 16, 'Yes'),
(2193, 72, 7, '1375000'),
(2194, 72, 10, '2'),
(2195, 72, 11, '3'),
(2196, 72, 12, '2'),
(2197, 72, 13, '144.50'),
(2198, 72, 14, '28.50'),
(2199, 72, 15, '173.00'),
(2200, 72, 16, 'Yes'),
(2201, 73, 7, '1200000'),
(2202, 73, 10, '2'),
(2203, 73, 11, '3'),
(2204, 73, 12, '2'),
(2205, 73, 13, '119.49'),
(2206, 73, 14, '38.38'),
(2207, 73, 15, '157.87'),
(2208, 73, 16, 'Yes'),
(2209, 74, 7, '1250000'),
(2210, 74, 10, '2'),
(2211, 74, 11, '3'),
(2212, 74, 12, '2'),
(2213, 74, 13, '126.34'),
(2214, 74, 14, '41.15'),
(2215, 74, 15, '167.49'),
(2216, 74, 16, 'Yes'),
(2217, 75, 7, '1700000'),
(2218, 75, 10, '2'),
(2219, 75, 11, '3'),
(2220, 75, 12, '3'),
(2221, 75, 13, '179.50'),
(2222, 75, 14, '73.00'),
(2223, 75, 15, '252.00'),
(2224, 75, 16, 'Yes'),
(2233, 58, 7, '829000'),
(2234, 58, 10, '2'),
(2235, 58, 11, '2'),
(2236, 58, 12, '2'),
(2237, 58, 13, '90.20'),
(2238, 58, 14, '31.11'),
(2239, 58, 15, '121.31'),
(2240, 58, 16, 'Yes'),
(2241, 59, 7, '829000'),
(2242, 59, 10, '2'),
(2243, 59, 11, '2'),
(2244, 59, 12, '2'),
(2245, 59, 13, '83.50'),
(2246, 59, 14, '17.00'),
(2247, 59, 15, '121.31'),
(2248, 59, 16, 'Yes'),
(2249, 60, 7, '919000'),
(2250, 60, 10, '2'),
(2251, 60, 11, '2'),
(2252, 60, 12, '2'),
(2253, 60, 13, '108.00'),
(2254, 60, 14, '42.50'),
(2255, 60, 15, '150.50'),
(2256, 60, 16, 'Yes'),
(2257, 61, 7, '919000'),
(2258, 61, 10, '2'),
(2259, 61, 11, '2'),
(2260, 61, 12, '2'),
(2261, 61, 13, '108.00'),
(2262, 61, 14, '42.50'),
(2263, 61, 15, '150.50'),
(2264, 61, 16, 'Yes'),
(2273, 62, 7, '969000'),
(2274, 62, 10, '2'),
(2275, 62, 11, '2'),
(2276, 62, 12, '2'),
(2277, 62, 13, '110.00'),
(2278, 62, 14, '78.00'),
(2279, 62, 15, '188.00'),
(2280, 62, 16, 'Yes'),
(2281, 64, 7, '919000'),
(2282, 64, 10, '2'),
(2283, 64, 11, '2'),
(2284, 64, 12, '2'),
(2285, 64, 13, '100.00'),
(2286, 64, 14, '9.00'),
(2287, 64, 15, '109.00'),
(2288, 64, 16, 'Yes'),
(2289, 57, 7, '829000'),
(2290, 57, 10, '2'),
(2291, 57, 11, '2'),
(2292, 57, 12, '2'),
(2293, 57, 13, '86.00'),
(2294, 57, 14, '46.00'),
(2295, 57, 15, '132.00'),
(2296, 57, 16, 'Yes'),
(2297, 114, 7, '458000'),
(2298, 114, 18, '2'),
(2299, 114, 19, 'B'),
(2300, 114, 20, '71'),
(2301, 114, 21, '11'),
(2302, 114, 22, '82'),
(2303, 117, 7, '475000'),
(2304, 117, 18, '2'),
(2305, 117, 19, 'A2'),
(2306, 117, 20, '80'),
(2307, 117, 21, '19'),
(2308, 117, 22, '99'),
(2309, 120, 7, '481000'),
(2310, 120, 18, '2'),
(2311, 120, 19, 'A'),
(2312, 120, 20, '78'),
(2313, 120, 21, '19'),
(2314, 120, 22, '97'),
(2315, 116, 7, '481000'),
(2316, 116, 18, '2'),
(2317, 116, 19, 'A2'),
(2318, 116, 20, '80'),
(2319, 116, 21, '19'),
(2320, 116, 22, '99'),
(2321, 113, 7, '479000'),
(2322, 113, 18, '2'),
(2323, 113, 19, 'B'),
(2324, 113, 20, '71'),
(2325, 113, 21, '11'),
(2326, 113, 22, '82'),
(2327, 122, 7, '487000'),
(2328, 122, 18, '2'),
(2329, 122, 19, 'A'),
(2330, 122, 20, '78'),
(2331, 122, 21, '19'),
(2332, 122, 22, '97'),
(2339, 125, 7, '481000'),
(2340, 125, 18, '2'),
(2341, 125, 19, 'A1'),
(2342, 125, 20, '80'),
(2343, 125, 21, '19'),
(2344, 125, 22, '99'),
(2345, 132, 7, '477000'),
(2346, 132, 18, '2'),
(2347, 132, 19, 'B1'),
(2348, 132, 20, '73'),
(2349, 132, 21, '11'),
(2350, 132, 22, '84'),
(2351, 115, 7, '487000'),
(2352, 115, 18, '2'),
(2353, 115, 19, 'A2'),
(2354, 115, 20, '80'),
(2355, 115, 21, '19'),
(2356, 115, 22, '99'),
(2357, 118, 7, '493000'),
(2358, 118, 18, '2'),
(2359, 118, 19, 'A'),
(2360, 118, 20, '78'),
(2361, 118, 21, '19'),
(2362, 118, 22, '97'),
(2363, 112, 7, '485000'),
(2364, 112, 18, '2'),
(2365, 112, 19, 'B'),
(2366, 112, 20, '71'),
(2367, 112, 21, '11'),
(2368, 112, 22, '82'),
(2369, 121, 7, '493000'),
(2370, 121, 18, '2'),
(2371, 121, 19, 'A'),
(2372, 121, 20, '78'),
(2373, 121, 21, '19'),
(2374, 121, 22, '97'),
(2375, 124, 7, '487000'),
(2376, 124, 18, '2'),
(2377, 124, 19, 'A1'),
(2378, 124, 20, '80'),
(2379, 124, 21, '19'),
(2380, 124, 22, '99'),
(2381, 131, 7, '483000'),
(2382, 131, 18, '2'),
(2383, 131, 19, 'B1'),
(2384, 131, 20, '73'),
(2385, 131, 21, '11'),
(2386, 131, 22, '84'),
(2387, 77, 7, '519000'),
(2388, 77, 18, '2'),
(2389, 77, 19, 'A2'),
(2390, 77, 20, '88'),
(2391, 77, 21, '19'),
(2392, 77, 22, '99'),
(2393, 78, 7, '517000'),
(2394, 78, 18, '2'),
(2395, 78, 19, 'B'),
(2396, 78, 20, '71'),
(2397, 78, 21, '11'),
(2398, 78, 22, '82'),
(2399, 79, 7, '383000'),
(2400, 79, 18, '1'),
(2401, 79, 19, 'E'),
(2402, 79, 20, '55'),
(2403, 79, 21, '11'),
(2404, 79, 22, '66'),
(2405, 130, 7, '515000'),
(2406, 130, 18, '2'),
(2407, 130, 19, 'B1'),
(2408, 130, 20, '73'),
(2409, 130, 21, '11'),
(2410, 130, 22, '84');

-- --------------------------------------------------------

--
-- Table structure for table `rss_board`
--

CREATE TABLE IF NOT EXISTS `rss_board` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `board_name` varchar(50) NOT NULL,
  `board_url` varchar(1000) NOT NULL,
  `board_html` blob NOT NULL,
  `fb_app_id` varchar(30) NOT NULL,
  `board_css` blob NOT NULL,
  `board_background` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `rss_board`
--

INSERT INTO `rss_board` (`id`, `board_name`, `board_url`, `board_html`, `fb_app_id`, `board_css`, `board_background`) VALUES
(1, 'choice_one', 'http://choiceone.com.au/job/rss.aspx?search=1', 0x3c7461626c652077696474683d2237393070782220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2235223e0a20203c74723e0a202020203c74642076616c69676e3d22746f70223e0a090a093c6469762069643d22636f6e74656e74626f78223e0a093c68313e41626f75742055733c2f68313e0a093c703e43686f6963654f6e65206973206120707269766174656c79206f776e656420616e642066756c6c7920696e646570656e64656e74205765737465726e204175737472616c69616e206f7267616e69736174696f6e2e20546865206f7267616e69736174696f6e20636f6d6d656e636564206f7065726174696f6e7320696e2031393839206173207468726565207365706172617465206469766973696f6e73206b6e6f776e2061732043686f69636520506572736f6e6e656c2c204d65646974656d7020616e64205461736b666f7263652e205468657365206469766973696f6e7320666f6375736564206f6e2061646d696e697374726174696f6e2c206d65646963616c20616e6420656e67696e656572696e6720616e6420696e647573747269616c20706572736f6e6e656c20726573706563746976656c792e204f7572206d697373696f6e2077617320746f20626520616e20696e6e6f76617469766520616e64206c656164696e67206564676520526563727569746d656e7420636f6d70616e792e20546869732077617320612074696d65207768656e205765737465726e204175737472616c69612077617320696e20726563657373696f6e2c20776f726b207761732073636172636520616e6420656d706c6f79657273207574696c6973656420746865207365727669636573206f66206120726563727569746d656e7420636f6d70616e7920696e206f7264657220746f207265647563652074686520776f726b6c6f6164732066726f6d20616e20696e666c7578206f66206170706c69636174696f6e732066726f6d2063616e646964617465732e3c2f703e0a093c703e53696e6365206f757220696e63657074696f6e2c2074686520627573696e657373206d6f64656c20686173206265656e20636f6e74696e75616c6c7920646576656c6f706564207468726f75676820746865206f7267616e69736174696f6e26727371756f3b73207265636f676e6974696f6e206f6620746865206e65656420746f2070726f76696465206f757220637573746f6d65727320776974682061206d6f7265207461696c6f7265642068756d616e207265736f757263657320617070726f6163682e204f7572206d697373696f6e20686173206265656e206368616e6765642c207265666c656374697665206f662074686520627573696e65737320737472617465677920616e64206973206e6f7720266c6471756f3b746f20626520612064796e616d6963206c65616465722c2070726f766964696e672074686520626573742070656f706c6520736f6c7574696f6e73207468726f756768207375636365737366756c206c617374696e6720706172746e6572736869707326726471756f3b2e3c2f703e0a093c703e54686573652073747261746567696320646576656c6f706d656e747320617265206d616e6966657374656420696e206368616e67657320746f206f757220736572766963652064656c697665727920746f20696e636c75646520617265617320737563682061732053656c656374696f6e20616e64205265636f6d6d656e646174696f6e20746f20746865207075626c696320736563746f722c207768696368207761732065737461626c697368656420696e203230303220616e642048756d616e205265736f757263657320436f616368696e67207768696368207761732065737461626c697368656420696e203230303420746f206d656574207468652062726f61646572206e65656473206f66206f757220637573746f6d6572732e2043686f6963654f6e652068617320616c736f20726563656e746c792065737461626c697368656420612053616665747920436f6e73756c74696e672061726d20746f2074686520627573696e6573732e204f7572206f7267616e69736174696f6e2068617320737572766976656420616e642074687269766564207468726f75676820636f6e74696e75616c206368616e67657320696e2074686520627573696e65737320616e642065636f6e6f6d696320636c696d6174652e204f76657220746865206c6173742032302079656172732077652068617665207365656e206368616e67657320746f2074686520726563727569746d656e7420696e6475737472792064726976656e20627920736b696c6c2073686f7274616765732c204952204c6177732c20746563686e6f6c6f6779206368616e6765732c20696e647573747279207265616c69676e6d656e742c2065636f6e6f6d696320626f6f6d20616e642065636f6e6f6d696320627573742c20636f6d70616e69657320696e207265636569766572736869702c2074616b656f7665727320616e64206d65726765727320616e6420736f206d756368206d6f72652e2e2e2e3c2f703e0a093c703e546f2073656520686f772043686f6963654f6e652063616e2061737369737420796f752c20706c656173652063616c6c202830382920393231352033383838206f72207669736974c383e2809ac382c2a03c6120687265663d22687474703a2f2f63686f6963656f6e652e636f6d2e61752f706167652f636f6e746163742d757322207461726765743d225f626c616e6b223e436f6e746163742055733c2f613e2e3c2f703e0a093c2f6469763e0a093c2f62723e0a090a090a093c6469762069643d22636f6e74656e74626f78223e0a093c68313e46696e642075732061726f756e6420746865207765623c2f68313e0a09576527726520657665727977686572652120436c69636b206120627574746f6e2062656c6f7720746f2066696e642043686f6963654f6e65206f6e20796f7572206661766f7269746520736f6369616c206e6574776f726b3a3c62723e0a093c6120687265663d2268747470733a2f2f747769747465722e636f6d2f43686f6963654f6e65415522207461726765743d225f626c616e6b223e3c696d67207372633d22687474703a2f2f317374736f6369616c2e636f6d2e61752f6662617070732f627574746f6e732f747769747465722e706e67223e3c2f613e3c62723e0a093c6120687265663d22687474703a2f2f7777772e6c696e6b6564696e2e636f6d2f636f6d70616e792f63686f6963656f6e652f22207461726765743d225f626c616e6b223e3c696d67207372633d22687474703a2f2f317374736f6369616c2e636f6d2e61752f6662617070732f627574746f6e732f6c696e6b6564696e2e706e67223e3c2f613e3c62723e0a093c62723e0a093c2f6469763e0a093c2f62723e0a090a090a090a093c6469762069643d22636f6e74656e74626f78223e0a090a093c68313e4469646e27742066696e6420746865206a6f6220796f752077657265206c6f6f6b696e6720666f723f3c2f68313e0a0941732070617274206f662074686520436172656572734d756c74694c697374206e6574776f726b20776520686176652061636365737320746f2068756e6465726473206f66206f7468657220636172656572732074686174206d617920696e74657265737420796f752e3c62723e203c64697620636c6173733d227375626d697443562d5355424d4954223e3c6120687265663d2268747470733a2f2f617070732e317374736f6369616c2e636f6d2e61752f696e6465782e7068702f626f6172645f636f6e74726f6c6c65722f73686f775f626f6172642f436172656572734d756c74694c697374223e436c69636b20486572653c2f613e3c2f6469763e0a093c2f6469763e0a093c2f62723e0a090a093c2f74643e0a202020203c74642076616c69676e3d22746f70222077696474683d22353230223e3c6469762069643d226a6f6273223e3c2f6469763e3c2f74643e0a20203c2f74723e0a3c2f7461626c653e, '419606398103940', 0x406368617273657420225554462d38223b0a0a23636f6e74656e74626f78207b0a70616464696e673a20313070783b200a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09666f6e742d73697a653a20313270783b0a09666f6e742d7765696768743a206e6f726d616c3b0a09636f6c6f723a20233333333b0a096c696e652d6865696768743a20312e35656d3b0a6261636b67726f756e642d636f6c6f723a2072676261283235352c3235352c3235352c302e36293b0a7d0a0a626f6479207b0a77696474683a38313070783b0a6f766572666c6f773a68696464656e3b0a6d617267696e3a313070783b2070616464696e673a303b20626f726465723a303b0a202020206261636b67726f756e642d636f6c6f723a20236332633263323b0a202020206261636b67726f756e642d696d6167653a2075726c286261636b67726f756e642e6a7067293b0a202020206261636b67726f756e642d7265706561743a207265706561742d783b0a096261636b67726f756e642d6174746163686d656e743a2066697865643b0a09666f6e742d66616d696c793a20226c7563696461206772616e6465222c207461686f6d612c2076657264616e612c20617269616c2c2073616e732d73657269663b0a0a7d0a0a6120696d67207b0a09626f726465723a6e6f6e653b0a7d0a0a613a6c696e6b207b636f6c6f723a20233342353939383b20746578742d6465636f726174696f6e3a206e6f6e653b7d0a613a76697369746564207b636f6c6f723a20233342353939383b20746578742d6465636f726174696f6e3a206e6f6e653b7d0a613a616374697665207b636f6c6f723a20233342353939383b20746578742d6465636f726174696f6e3a206e6f6e653b7d0a613a686f766572207b746578742d6465636f726174696f6e3a206e6f6e653b20636f6c6f723a20233466366161333b7d0a0a2364796e616d69632d636f6e74656e7420613a686f7665727b0a09746578742d6465636f726174696f6e3a20756e6465726c696e653b0a7d0a0a737562207b0a646973706c61793a206e6f6e653b0a7d0a0a2e72737346656564207b0a09666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09666f6e742d73697a653a20313270783b0a090a7d0a2e727373466565642061207b0a09636f6c6f723a20233342353939383b0a09666f6e742d73697a653a20313870783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a7d0a2e7273734665656420613a686f766572207b0a09636f6c6f723a20233342353939383b0a09746578742d6465636f726174696f6e3a20756e6465726c696e653b0a7d0a0a2e727373486561646572207b2070616464696e673a20302e32656d20303b207d0a0a2e727373426f6479207b20626f726465722d626f74746f6d3a2032707820736f6c696420234331433143313b0a626f726465722d746f703a2031707820736f6c696420234331433143313b207d0a2e727373426f647920756c207b206c6973742d7374796c653a206e6f6e653b207d0a2e727373426f647920756c2c202e727373526f772c202e727373526f772068342c202e727373526f772070207b0a096d617267696e3a20303b0a0970616464696e673a20303b0a7d0a0a2e727373526f77207b2070616464696e673a20302e38656d3b0a626f726465722d6c6566743a2031707820736f6c696420234331433143313b0a626f726465722d72696768743a2031707820736f6c696420234331433143313b0a626f726465722d746f703a2031707820736f6c696420234331433143313b207d0a2e727373526f77206834207b20666f6e742d73697a653a203870783b207d0a2e64617465207b0a09666f6e742d73697a653a203b0a09636f6c6f723a20233636363b0a096d617267696e3a20302e32656d203020302e34656d20303b0a7d0a0a6c693a6e74682d6368696c64286f6464297b206261636b67726f756e642d636f6c6f723a20236666666666663b207d0a6c693a6e74682d6368696c64286576656e297b206261636b67726f756e642d636f6c6f723a20234544454646343b207d0a0a23636f6e74656e746c697374206c693a6e74682d6368696c64286f6464297b206261636b67726f756e642d636f6c6f723a207472616e73706172656e743b207d0a23636f6e74656e746c697374206c693a6e74682d6368696c64286576656e297b206261636b67726f756e642d636f6c6f723a207472616e73706172656e743b207d0a0a2e727373526f773a6163746976657b0a6261636b67726f756e642d636f6c6f723a234546454645463b0a7d0a2e727373526f773a686f7665727b0a6261636b67726f756e642d636f6c6f723a234546454645463b0a7d0a0a2e77726170203a686f7665727b0a6261636b67726f756e642d636f6c6f723a234445453345433b0a7d0a0a2e727373526f77202e7273734d65646961207b0a0970616464696e673a20302e35656d3b0a09666f6e742d73697a653a2031656d3b0a7d0a0a2e7375626d69744356207b0a626f726465722d6c6566743a2031707820736f6c696420234331433143313b0a626f726465722d72696768743a2031707820736f6c696420234331433143313b0a626f726465722d746f703a2032707820736f6c696420233934413343343b0a626f726465722d626f74746f6d3a2032707820736f6c696420234331433143313b0a6d617267696e2d626f74746f6d3a20313070783b0a6261636b67726f756e642d636f6c6f723a20234544454646343b0a70616464696e673a20313070783b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09666f6e742d73697a653a20313270783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a09636f6c6f723a20233030303b0a09746578742d616c69676e3a2063656e7465723b0a207d0a200a202e64726f70646f776e207b0a626f726465722d6c6566743a2031707820736f6c696420234331433143313b0a626f726465722d72696768743a2031707820736f6c696420234331433143313b0a626f726465722d746f703a2032707820736f6c696420233934413343343b0a626f726465722d626f74746f6d3a2032707820736f6c696420234331433143313b0a6261636b67726f756e642d636f6c6f723a20234544454646343b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09666f6e742d73697a653a20313270783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a09636f6c6f723a20233030303b0a09746578742d616c69676e3a2063656e7465723b0a207d0a202e7375626d697443562d6f75746572207b0a0a09746578742d6465636f726174696f6e3a206e6f6e653b0a0a207d0a0a202e736f75726365207b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09636f6c6f723a20233342353939383b0a09666f6e742d73697a653a20313470783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a0970616464696e673a313070783b0a09666f6e742d7765696768743a626f6c6465723b0a09746578742d616c69676e3a2063656e7465723b0a7d0a200a206469762e7375626d697443563a6163746976657b0a6261636b67726f756e642d636f6c6f723a234546454645463b0a7d0a6469762e7375626d697443563a686f7665727b0a6261636b67726f756e642d636f6c6f723a234546454645463b0a7d0a0a202e7375626d697443562d5355424d4954207b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09636f6c6f723a20233342353939383b0a09666f6e742d73697a653a20323070783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a0970616464696e673a313070783b0a09666f6e742d7765696768743a626f6c6465723b0a09746578742d616c69676e3a2063656e7465723b0a0909746578742d6465636f726174696f6e3a206e6f6e653b0a7d0a0a200a2f2a0a23356337356139206261636b67726f756e6420636f6c6f720a2338613963633220746f7020626f726465720a2332393434376520626f726465720a2331613335366520626f7264657220626f74746f6d0a2334663661613320686f766572206261636b67726f756e6420636f6c6f720a2a2f0a200a2e626f74746f6d207b0a706f736974696f6e3a72656c61746976653b0a6d617267696e2d746f703a202d34, ''),
(16, '1stExec', 'http://1stexecutive.myrecruitonline.net:8080/jobs?x-name=internship', 0x3c7461626c652077696474683d2237393070782220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2235223e0a20203c74723e0a202020203c74642076616c69676e3d22746f70223e0a090a093c6469762069643d22636f6e74656e74626f78223e0a093c68313e5765277265206865726520746f2068656c702e3c2f68313e0a09317374457865637574697665206973206865726520746f2068656c7020796f7520616c6f6e6720796f75722063617265657220706174682e2042726f777365206f75722063757272656e746c7920617661696c61626c65206a6f6273206f72207375626d697420796f75722043562062656c6f772e20496620796f75206861766520616e797468696e6720796f752764206c696b6520746f206469736375737320776974682075732c206665656c206672656520746f2073656e642075732061203c6120687265663d22687474703a2f2f7777772e66616365626f6f6b2e636f6d2f6d657373616765732f317374457865637574697665223e6d6573736167653c2f613e2e0a093c2f6469763e0a093c2f62723e0a090a090a093c6469762069643d22636f6e74656e74626f78223e0a093c68313e5375626d697420796f75722043562e3c2f68313e0a0957616e7420757320746f20636f6e7461637420796f75207768656e2061206a6f622066697474696e6720796f7572207175616c696669636174696f6e7320616e6420616d626974696f6e7320697320617661696c61626c653f3c62723e203c64697620636c6173733d227375626d697443562d5355424d4954223e3c6120687265663d22687474703a2f2f3173746578656375746976652e6d79726563727569746f6e6c696e652e6e65743a383038302f666f726d732f6a6f62417070466f726d5374616765322e7365616d3f636f64653d73797374656d267372633d72737326736f757263655379733d6662223e436c69636b20486572653c2f613e3c2f6469763e0a093c2f6469763e0a093c2f62723e0a090a090a090a093c6469762069643d22636f6e74656e74626f78223e0a090a3c68313e4e65656420657870657269656e63653f3c2f68313e0a094861766520796f7520726563656e746c792067726164756174656420616e642061726520686176696e67206120686172642074696d65207374617274696e6720796f7572206361726565723f204e65656420736f6c696420657870657269656e636520696e20746865204175737472616c69616e20776f726b666f7263652072656c6174656420746f20796f7572206465677265653f3c62723e203c64697620636c6173733d227375626d697443562d5355424d4954223e3c6120687265663d22687474703a2f2f7777772e317374736f6369616c2e636f6d2e61752f6662617070732f31737465786563696e7465726e73686970732f223e436c69636b20486572653c2f613e3c2f6469763e0a093c2f6469763e0a093c2f62723e0a090a09093c6469762069643d22636f6e74656e74626f78223e0a090a3c68313e4469646e27742066696e6420746865206a6f6220796f752077657265206c6f6f6b696e6720666f723f3c2f68313e0a0941732070617274206f662074686520436172656572734d756c74694c697374206e6574776f726b20776520686176652061636365737320746f2068756e6465726473206f66206f7468657220636172656572732074686174206d617920696e74657265737420796f752e3c62723e203c64697620636c6173733d227375626d697443562d5355424d4954223e3c6120687265663d2268747470733a2f2f617070732e317374736f6369616c2e636f6d2e61752f696e6465782e7068702f626f6172645f636f6e74726f6c6c65722f73686f775f626f6172642f436172656572734d756c74694c697374223e436c69636b20486572653c2f613e3c2f6469763e0a093c2f6469763e0a093c2f62723e0a090a093c2f74643e0a202020203c74642076616c69676e3d22746f70222077696474683d22353230223e3c6469762069643d226a6f6273223e3c2f6469763e3c2f74643e0a20203c2f74723e0a3c2f7461626c653e, '230343010345368', 0x406368617273657420225554462d38223b0a0a0a626f6479207b0a77696474683a38313070783b0a6f766572666c6f773a68696464656e3b0a6d617267696e3a313070783b2070616464696e673a303b20626f726465723a303b0a202020206261636b67726f756e642d636f6c6f723a20236666666666663b0a202020206261636b67726f756e642d696d6167653a2075726c286170706261636b67726f756e642e6a7067293b0a202020206261636b67726f756e642d7265706561743a207265706561742d783b0a096261636b67726f756e642d6174746163686d656e743a2066697865643b0a09666f6e742d66616d696c793a20226c7563696461206772616e6465222c207461686f6d612c2076657264616e612c20617269616c2c2073616e732d73657269663b0a0a7d0a0a6120696d67207b0a09626f726465723a6e6f6e653b0a7d0a0a61207b0a09636f6c6f723a233539373037423b0a09746578742d6465636f726174696f6e3a6e6f6e653b0a09666f6e742d7765696768743a3730303b0a7d0a613a686f766572207b0a09746578742d6465636f726174696f6e3a6e6f6e653b0a7d0a613a6163746976652c20613a766973697465642c20613a666f6375730a7b0a096f75746c696e653a206e6f6e653b0a09626f726465723a20303b0a7d0a0a613a666f6375730a7b0a092d6d6f7a2d6f75746c696e652d7374796c653a206e6f6e653b0a096f75746c696e653a20303b0a7d0a0a613a666f6375732c202a3a666f637573207b0a202020206e6f466f6375734c696e653a2065787072657373696f6e28746869732e6f6e466f6375733d746869732e626c75722829293b0a7d0a0a2364796e616d69632d636f6e74656e7420613a686f7665727b0a09746578742d6465636f726174696f6e3a20756e6465726c696e653b0a7d0a0a737562207b0a646973706c61793a206e6f6e653b0a7d0a0a2e72737346656564207b0a09666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09666f6e742d73697a653a20313270783b0a090a7d0a2e727373466565642061207b0a09636f6c6f723a20233342353939383b0a09666f6e742d73697a653a20313870783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a7d0a2e7273734665656420613a686f766572207b0a09636f6c6f723a20233342353939383b0a09746578742d6465636f726174696f6e3a20756e6465726c696e653b0a7d0a0a2e727373486561646572207b2070616464696e673a20302e32656d20303b207d0a0a2e727373426f6479207b20626f726465722d626f74746f6d3a2032707820736f6c696420234331433143313b0a626f726465722d746f703a2031707820736f6c696420234331433143313b207d0a2e727373426f647920756c207b206c6973742d7374796c653a206e6f6e653b207d0a2e727373426f647920756c2c202e727373526f772c202e727373526f772068342c202e727373526f772070207b0a096d617267696e3a20303b0a0970616464696e673a20303b0a7d0a0a2e727373526f77207b2070616464696e673a20302e38656d3b0a626f726465722d6c6566743a2031707820736f6c696420234331433143313b0a626f726465722d72696768743a2031707820736f6c696420234331433143313b0a626f726465722d746f703a2031707820736f6c696420234331433143313b207d0a2e727373526f77206834207b20666f6e742d73697a653a203870783b207d0a2e64617465207b0a09666f6e742d73697a653a203b0a09636f6c6f723a20233636363b0a096d617267696e3a20302e32656d203020302e34656d20303b0a7d0a0a6c693a6e74682d6368696c64286f6464297b206261636b67726f756e642d636f6c6f723a20236666666666663b207d0a6c693a6e74682d6368696c64286576656e297b206261636b67726f756e642d636f6c6f723a20234544454646343b207d0a0a23636f6e74656e746c697374206c693a6e74682d6368696c64286f6464297b206261636b67726f756e642d636f6c6f723a207472616e73706172656e743b207d0a23636f6e74656e746c697374206c693a6e74682d6368696c64286576656e297b206261636b67726f756e642d636f6c6f723a207472616e73706172656e743b207d0a0a2e727373526f773a6163746976657b0a6261636b67726f756e642d636f6c6f723a234546454645463b0a7d0a2e727373526f773a686f7665727b0a6261636b67726f756e642d636f6c6f723a234546454645463b0a7d0a0a2e77726170203a686f7665727b0a6261636b67726f756e642d636f6c6f723a234445453345433b0a7d0a0a2e727373526f77202e7273734d65646961207b0a0970616464696e673a20302e35656d3b0a09666f6e742d73697a653a2031656d3b0a7d0a0a2e7375626d69744356207b0a626f726465722d6c6566743a2031707820736f6c696420234331433143313b0a626f726465722d72696768743a2031707820736f6c696420234331433143313b0a626f726465722d746f703a2032707820736f6c696420233934413343343b0a626f726465722d626f74746f6d3a2032707820736f6c696420234331433143313b0a6d617267696e2d626f74746f6d3a20313070783b0a6261636b67726f756e642d636f6c6f723a20234544454646343b0a70616464696e673a20313070783b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09666f6e742d73697a653a20313270783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a09636f6c6f723a20233030303b0a09746578742d616c69676e3a2063656e7465723b0a207d0a200a202e64726f70646f776e207b0a626f726465722d6c6566743a2031707820736f6c696420234331433143313b0a626f726465722d72696768743a2031707820736f6c696420234331433143313b0a626f726465722d746f703a2032707820736f6c696420233934413343343b0a626f726465722d626f74746f6d3a2032707820736f6c696420234331433143313b0a6261636b67726f756e642d636f6c6f723a20234544454646343b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09666f6e742d73697a653a20313270783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a09636f6c6f723a20233030303b0a09746578742d616c69676e3a2063656e7465723b0a207d0a202e7375626d697443562d6f75746572207b0a0a09746578742d6465636f726174696f6e3a206e6f6e653b0a0a207d0a0a202e736f75726365207b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09636f6c6f723a20233342353939383b0a09666f6e742d73697a653a20313470783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a0970616464696e673a313070783b0a09666f6e742d7765696768743a626f6c6465723b0a09746578742d616c69676e3a2063656e7465723b0a7d0a200a206469762e7375626d697443563a6163746976657b0a6261636b67726f756e642d636f6c6f723a234546454645463b0a7d0a6469762e7375626d697443563a686f7665727b0a6261636b67726f756e642d636f6c6f723a234546454645463b0a7d0a0a202e7375626d697443562d5355424d4954207b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09636f6c6f723a20233342353939383b0a09666f6e742d73697a653a20323070783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a0970616464696e673a313070783b0a09666f6e742d7765696768743a626f6c6465723b0a09746578742d616c69676e3a2063656e7465723b0a0909746578742d6465636f726174696f6e3a206e6f6e653b0a7d0a0a200a2f2a0a23356337356139206261636b67726f756e6420636f6c6f720a2338613963633220746f7020626f726465720a2332393434376520626f726465720a2331613335366520626f7264657220626f74746f6d0a2334663661613320686f766572206261636b67726f756e6420636f6c6f720a2a2f0a200a2e626f74746f6d207b0a706f736974696f6e3a72656c61746976653b0a6d617267696e2d746f703a202d343070783b0a626f726465723a6e6f6e653b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09666f6e742d73697a653a203870783b0a09666c6f61743a2072696768743b0a0977696474683a2031303470783b0a0a7d0a2e66616365626f6f6b207b0a0a09666f6e742d73697a653a203b0a09636f6c6f723a20233636363b0a096d617267696e3a20302e32656d203020302e34656d20303b0a090a0a7d0a0a2e7172636f6465207b0a0a666c6f61743a2072696768743b0a0a7d0a0a0a200a2e627574746f6e5f6f7574736964655f626f726465725f626c75657b0a77696474683a31303070783b0a626f726465723a736f6c69642023323934343765203170783b0a626f726465722d626f74746f6d3a736f6c69642023316133353665203170783b0a637572736f723a706f696e7465723b0a666c6f61743a2072696768743b0a7d0a200a2e627574746f6e5f696e736964655f626f726465725f626c75657b0a70616464696e673a36707820302036707820303b0a6261636b67726f756e642d636f6c6f723a233563373561393b0a626f726465722d746f703a736f6c69642023386139636332203170783b0a746578742d616c69676e3a63656e7465723b0a636f6c6f723a236666666666663b0a666f6e742d73697a653a313270783b0a666f6e742d7765696768743a626f6c6465723b0a7d0a200a6469762e627574746f6e5f696e736964655f626f726465725f626c75653a6163746976657b0a6261636b67726f756e642d636f6c6f723a233466366161333b0a7d0a6469762e627574746f6e5f696e736964655f626f726465725f626c75653a686f7665727b0a6261636b67726f756e642d636f6c6f723a233466366161333b0a7d0a0a2e6a6f627469746c65207b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09636f6c6f723a20233342353939383b0a09666f6e742d73697a653a20323070783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a09666f6e742d7765696768743a626f6c6465723b0a7d0a0a2e64657363207b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09636f6c6f723a20233030303030303b0a09666f6e742d73697a653a20313270783b0a0a7d0a0a2e6465736320613a6c696e6b207b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a0a09666f6e742d73697a653a20313270783b0a0a7d0a0a23636f6e74656e74626f78207b0a70616464696e673a20313070783b200a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09666f6e742d73697a653a20313270783b0a09666f6e742d7765696768743a206e6f726d616c3b0a09636f6c6f723a20233333333b0a096c696e652d6865696768743a20312e35656d3b0a6261636b67726f756e642d636f6c6f723a2072676261283235352c3235352c3235352c302e36293b0a7d0a0a6831207b0a20202020636c6561723a20626f74683b0a20202020666f6e742d66616d696c793a20417269616c2c48656c7665746963612c73616e732d73657269663b0a20202020666f6e742d73697a653a20323270783b0a202020206c696e652d6865696768743a20313030253b0a202020206d617267696e2d626f74746f6d3a20323570783b0a7d, ''),
(17, 'Zenith', 'http://zenmgt.turborecruit.com.au/job/jobs_to_rss.cfm?', 0x3c7461626c652077696474683d2237393070782220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2235223e0a20203c74723e0a202020203c74642076616c69676e3d22746f70223e0a090a093c6469762069643d22636f6e74656e74626f78223e0a093c68313e5765277265206865726520746f2068656c702e3c2f68313e0a5a656e697468206973204175737472616c6961e2809973206c656164696e6720656d706c6f796d656e74206167656e637920696e2074686520696e666f726d6174696f6e206d616e6167656d656e74206669656c642e204f7572207465616d206f6620657870657269656e63656420696e666f726d6174696f6e20636f6e73756c74616e7473207370656369616c69736520696e20706c6163696e67207468652072696768742063616e6469646174657320696e20746865207269676874206a6f62732e0a0a093c2f6469763e0a093c2f62723e0a090a090a093c6469762069643d22636f6e74656e74626f78223e0a093c68313e52656769737465722077697468205a656e6974682e3c2f68313e0a09496620796f7520686176656ee2809974206265656e20696e20636f6e746163742077697468207573206265666f7265206f7220617265207669736974696e6720757320666f72207468652066697273742074696d6520696e2061207768696c652c207265676973746572696e6720796f75722064657461696c73207769746820757320697320616e20657373656e7469616c2066697273742073746570e280a62e204f6e636520796f75206861766520726567697374657265642077697468205a656e6974682c20796f752063616e20616c736f207365742075702061204a6f6220416c65727420746f2072656365697665206175746f6d61746963206e6f74696669636174696f6e20656163682074696d652061206e6577206a6f622074686174206d61746368657320796f757220707265666572656e63657320697320706f737465642e3c62723e203c64697620636c6173733d227375626d697443562d5355424d4954223e3c6120687265663d22687474703a2f2f7a656e6d67742e747572626f726563727569742e636f6d2e61752f757365722f757365725f6163636f756e742e63666d3f7369676e75703d31223e436c69636b20486572653c2f613e3c2f6469763e0a093c2f6469763e0a093c2f62723e0a090a090a090a093c6469762069643d22636f6e74656e74626f78223e0a090a093c68313e4469646e27742066696e6420746865206a6f6220796f752077657265206c6f6f6b696e6720666f723f3c2f68313e0a0941732070617274206f662074686520436172656572734d756c74694c697374206e6574776f726b20776520686176652061636365737320746f2068756e6465726473206f66206f7468657220636172656572732074686174206d617920696e74657265737420796f752e3c62723e203c64697620636c6173733d227375626d697443562d5355424d4954223e3c6120687265663d2268747470733a2f2f617070732e317374736f6369616c2e636f6d2e61752f696e6465782e7068702f626f6172645f636f6e74726f6c6c65722f73686f775f626f6172642f436172656572734d756c74694c697374223e436c69636b20486572653c2f613e3c2f6469763e0a093c2f6469763e0a093c2f62723e0a090a093c2f74643e0a202020203c74642076616c69676e3d22746f70222077696474683d22353230223e3c6469762069643d226a6f6273223e3c2f6469763e3c2f74643e0a20203c2f74723e0a3c2f7461626c653e, '380458451998046', 0x406368617273657420225554462d38223b0a0a0a626f6479207b0a77696474683a38313070783b0a6f766572666c6f773a68696464656e3b0a6d617267696e3a313070783b2070616464696e673a303b20626f726465723a303b0a202020206261636b67726f756e642d636f6c6f723a20236534653465343b0a202020206261636b67726f756e642d696d6167653a2075726c286261636b67726f756e642e6a7067293b0a202020206261636b67726f756e642d7265706561743a206e6f2d7265706561743b0a096261636b67726f756e642d6174746163686d656e743a2066697865643b0a09666f6e742d66616d696c793a20226c7563696461206772616e6465222c207461686f6d612c2076657264616e612c20617269616c2c2073616e732d73657269663b0a0a7d0a0a613a6c696e6b207b636f6c6f723a20233342353939383b20746578742d6465636f726174696f6e3a206e6f6e653b7d0a613a76697369746564207b636f6c6f723a20233342353939383b20746578742d6465636f726174696f6e3a206e6f6e653b7d0a613a616374697665207b636f6c6f723a20233342353939383b20746578742d6465636f726174696f6e3a206e6f6e653b7d0a613a686f766572207b746578742d6465636f726174696f6e3a206e6f6e653b20636f6c6f723a20233466366161333b7d0a0a737562207b0a646973706c61793a206e6f6e653b0a7d0a0a2e72737346656564207b0a09666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09666f6e742d73697a653a20313270783b0a090a7d0a2e727373466565642061207b0a09636f6c6f723a20233342353939383b0a09666f6e742d73697a653a20313870783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a7d0a2e7273734665656420613a686f766572207b0a09636f6c6f723a20233342353939383b0a09746578742d6465636f726174696f6e3a20756e6465726c696e653b0a7d0a0a2e727373486561646572207b2070616464696e673a20302e32656d20303b207d0a0a2e727373426f6479207b20626f726465722d626f74746f6d3a2032707820736f6c696420234331433143313b0a626f726465722d746f703a2031707820736f6c696420234331433143313b207d0a2e727373426f647920756c207b206c6973742d7374796c653a206e6f6e653b207d0a2e727373426f647920756c2c202e727373526f772c202e727373526f772068342c202e727373526f772070207b0a096d617267696e3a20303b0a0970616464696e673a20303b0a7d0a0a2e727373526f77207b2070616464696e673a20302e38656d3b0a626f726465722d6c6566743a2031707820736f6c696420234331433143313b0a626f726465722d72696768743a2031707820736f6c696420234331433143313b0a626f726465722d746f703a2031707820736f6c696420234331433143313b207d0a2e727373526f77206834207b20666f6e742d73697a653a203870783b207d0a2e64617465207b0a09666f6e742d73697a653a203b0a09636f6c6f723a20233636363b0a096d617267696e3a20302e32656d203020302e34656d20303b0a7d0a0a6c693a6e74682d6368696c64286f6464297b206261636b67726f756e642d636f6c6f723a20236666666666663b207d0a6c693a6e74682d6368696c64286576656e297b206261636b67726f756e642d636f6c6f723a20234544454646343b207d0a0a2e727373526f773a6163746976657b0a6261636b67726f756e642d636f6c6f723a234546454645463b0a7d0a2e727373526f773a686f7665727b0a6261636b67726f756e642d636f6c6f723a234546454645463b0a7d0a0a2e77726170203a686f7665727b0a6261636b67726f756e642d636f6c6f723a234445453345433b0a7d0a0a2e727373526f77202e7273734d65646961207b0a0970616464696e673a20302e35656d3b0a09666f6e742d73697a653a2031656d3b0a7d0a0a2e7375626d69744356207b0a626f726465722d6c6566743a2031707820736f6c696420234331433143313b0a626f726465722d72696768743a2031707820736f6c696420234331433143313b0a626f726465722d746f703a2032707820736f6c696420233934413343343b0a626f726465722d626f74746f6d3a2032707820736f6c696420234331433143313b0a6d617267696e2d626f74746f6d3a20313070783b0a6261636b67726f756e642d636f6c6f723a20234544454646343b0a70616464696e673a20313070783b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09666f6e742d73697a653a20313270783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a09636f6c6f723a20233030303b0a09746578742d616c69676e3a2063656e7465723b0a207d0a200a202e64726f70646f776e207b0a626f726465722d6c6566743a2031707820736f6c696420234331433143313b0a626f726465722d72696768743a2031707820736f6c696420234331433143313b0a626f726465722d746f703a2032707820736f6c696420233934413343343b0a626f726465722d626f74746f6d3a2032707820736f6c696420234331433143313b0a6261636b67726f756e642d636f6c6f723a20234544454646343b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09666f6e742d73697a653a20313270783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a09636f6c6f723a20233030303b0a09746578742d616c69676e3a2063656e7465723b0a207d0a202e7375626d697443562d6f75746572207b0a0a09746578742d6465636f726174696f6e3a206e6f6e653b0a0a207d0a0a202e736f75726365207b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09636f6c6f723a20233342353939383b0a09666f6e742d73697a653a20313470783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a0970616464696e673a313070783b0a09666f6e742d7765696768743a626f6c6465723b0a09746578742d616c69676e3a2063656e7465723b0a7d0a200a206469762e7375626d697443563a6163746976657b0a6261636b67726f756e642d636f6c6f723a234546454645463b0a7d0a6469762e7375626d697443563a686f7665727b0a6261636b67726f756e642d636f6c6f723a234546454645463b0a7d0a0a202e7375626d697443562d5355424d4954207b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09636f6c6f723a20233342353939383b0a09666f6e742d73697a653a20323070783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a0970616464696e673a313070783b0a09666f6e742d7765696768743a626f6c6465723b0a09746578742d616c69676e3a2063656e7465723b0a0909746578742d6465636f726174696f6e3a206e6f6e653b0a7d0a0a200a2f2a0a23356337356139206261636b67726f756e6420636f6c6f720a2338613963633220746f7020626f726465720a2332393434376520626f726465720a2331613335366520626f7264657220626f74746f6d0a2334663661613320686f766572206261636b67726f756e6420636f6c6f720a2a2f0a200a2e626f74746f6d207b0a706f736974696f6e3a72656c61746976653b0a6d617267696e2d746f703a202d343070783b0a626f726465723a6e6f6e653b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09666f6e742d73697a653a203870783b0a09666c6f61743a2072696768743b0a0977696474683a2031303470783b0a0a7d0a2e66616365626f6f6b207b0a0a09666f6e742d73697a653a203b0a09636f6c6f723a20233636363b0a096d617267696e3a20302e32656d203020302e34656d20303b0a090a0a7d0a0a2e7172636f6465207b0a0a666c6f61743a2072696768743b0a0a7d0a0a0a200a2e627574746f6e5f6f7574736964655f626f726465725f626c75657b0a77696474683a31303070783b0a626f726465723a736f6c69642023323934343765203170783b0a626f726465722d626f74746f6d3a736f6c69642023316133353665203170783b0a637572736f723a706f696e7465723b0a666c6f61743a2072696768743b0a7d0a200a2e627574746f6e5f696e736964655f626f726465725f626c75657b0a70616464696e673a36707820302036707820303b0a6261636b67726f756e642d636f6c6f723a233563373561393b0a626f726465722d746f703a736f6c69642023386139636332203170783b0a746578742d616c69676e3a63656e7465723b0a636f6c6f723a236666666666663b0a666f6e742d73697a653a313270783b0a666f6e742d7765696768743a626f6c6465723b0a7d0a200a6469762e627574746f6e5f696e736964655f626f726465725f626c75653a6163746976657b0a6261636b67726f756e642d636f6c6f723a233466366161333b0a7d0a6469762e627574746f6e5f696e736964655f626f726465725f626c75653a686f7665727b0a6261636b67726f756e642d636f6c6f723a233466366161333b0a7d0a0a2e6a6f627469746c65207b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09636f6c6f723a20233342353939383b0a09666f6e742d73697a653a20323070783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a09666f6e742d7765696768743a626f6c6465723b0a7d0a0a2e64657363207b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09636f6c6f723a20233030303030303b0a09666f6e742d73697a653a20313270783b0a0a7d0a0a2e6465736320613a6c696e6b207b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a0a09666f6e742d73697a653a20313270783b0a0a7d0a0a23636f6e74656e74626f78207b0a70616464696e673a20313070783b200a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09666f6e742d73697a653a20313270783b0a09666f6e742d7765696768743a206e6f726d616c3b0a09636f6c6f723a20233333333b0a096c696e652d6865696768743a20312e35656d3b0a6261636b67726f756e642d696d6167653a2075726c282762672d7472616e732e706e6727293b0a7d, ''),
(19, 'CareersMultiList', 'http://careersmultilist.com.au/RSSFeed.aspx?search=1&CountryID=1&Page=1', 0x3c7461626c652077696474683d2237393070782220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2235223e0a20203c74723e0a202020203c74642076616c69676e3d22746f70223e0a090a093c6469762069643d22636f6e74656e74626f78223e0a093c68313e5765277265206865726520746f2068656c702e3c2f68313e0a09434d4c206973206865726520746f2068656c7020796f7520616c6f6e6720796f75722063617265657220706174682e2042726f777365206f75722063757272656e746c7920617661696c61626c65206a6f6273206f7220696620796f75206861766520616e797468696e6720796f752764206c696b6520746f206469736375737320776974682075732c206665656c206672656520746f2073656e642075732061203c6120687265663d22687474703a2f2f7777772e66616365626f6f6b2e636f6d2f6d657373616765732f436172656572734d756c74694c697374223e6d6573736167653c2f613e2e0a093c2f6469763e0a093c2f62723e0a090a090a093c2f74643e0a202020203c74642076616c69676e3d22746f70222077696474683d22353230223e3c6469762069643d226a6f6273223e3c2f6469763e3c2f74643e0a20203c2f74723e0a3c2f7461626c653e, '529754777070600', 0x406368617273657420225554462d38223b0a0a0a626f6479207b0a77696474683a38313070783b0a6f766572666c6f773a68696464656e3b0a6d617267696e3a313070783b2070616464696e673a303b20626f726465723a303b0a202020206261636b67726f756e642d636f6c6f723a20236666666666663b0a202020206261636b67726f756e642d696d6167653a2075726c286170706261636b67726f756e642e6a7067293b0a202020206261636b67726f756e642d7265706561743a207265706561742d783b0a096261636b67726f756e642d6174746163686d656e743a2066697865643b0a09666f6e742d66616d696c793a20226c7563696461206772616e6465222c207461686f6d612c2076657264616e612c20617269616c2c2073616e732d73657269663b0a0a7d0a0a6120696d67207b0a09626f726465723a6e6f6e653b0a7d0a0a61207b0a09636f6c6f723a233539373037423b0a09746578742d6465636f726174696f6e3a6e6f6e653b0a09666f6e742d7765696768743a3730303b0a7d0a613a686f766572207b0a09746578742d6465636f726174696f6e3a6e6f6e653b0a7d0a613a6163746976652c20613a766973697465642c20613a666f6375730a7b0a096f75746c696e653a206e6f6e653b0a09626f726465723a20303b0a7d0a0a613a666f6375730a7b0a092d6d6f7a2d6f75746c696e652d7374796c653a206e6f6e653b0a096f75746c696e653a20303b0a7d0a0a613a666f6375732c202a3a666f637573207b0a202020206e6f466f6375734c696e653a2065787072657373696f6e28746869732e6f6e466f6375733d746869732e626c75722829293b0a7d0a0a2364796e616d69632d636f6e74656e7420613a686f7665727b0a09746578742d6465636f726174696f6e3a20756e6465726c696e653b0a7d0a0a737562207b0a646973706c61793a206e6f6e653b0a7d0a0a2e72737346656564207b0a09666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09666f6e742d73697a653a20313270783b0a090a7d0a2e727373466565642061207b0a09636f6c6f723a20233342353939383b0a09666f6e742d73697a653a20313870783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a7d0a2e7273734665656420613a686f766572207b0a09636f6c6f723a20233342353939383b0a09746578742d6465636f726174696f6e3a20756e6465726c696e653b0a7d0a0a2e727373486561646572207b2070616464696e673a20302e32656d20303b207d0a0a2e727373426f6479207b20626f726465722d626f74746f6d3a2032707820736f6c696420234331433143313b0a626f726465722d746f703a2031707820736f6c696420234331433143313b207d0a2e727373426f647920756c207b206c6973742d7374796c653a206e6f6e653b207d0a2e727373426f647920756c2c202e727373526f772c202e727373526f772068342c202e727373526f772070207b0a096d617267696e3a20303b0a0970616464696e673a20303b0a7d0a0a2e727373526f77207b2070616464696e673a20302e38656d3b0a626f726465722d6c6566743a2031707820736f6c696420234331433143313b0a626f726465722d72696768743a2031707820736f6c696420234331433143313b0a626f726465722d746f703a2031707820736f6c696420234331433143313b207d0a2e727373526f77206834207b20666f6e742d73697a653a203870783b207d0a2e64617465207b0a09666f6e742d73697a653a203b0a09636f6c6f723a20233636363b0a096d617267696e3a20302e32656d203020302e34656d20303b0a7d0a0a6c693a6e74682d6368696c64286f6464297b206261636b67726f756e642d636f6c6f723a20236666666666663b207d0a6c693a6e74682d6368696c64286576656e297b206261636b67726f756e642d636f6c6f723a20234544454646343b207d0a0a23636f6e74656e746c697374206c693a6e74682d6368696c64286f6464297b206261636b67726f756e642d636f6c6f723a207472616e73706172656e743b207d0a23636f6e74656e746c697374206c693a6e74682d6368696c64286576656e297b206261636b67726f756e642d636f6c6f723a207472616e73706172656e743b207d0a0a2e727373526f773a6163746976657b0a6261636b67726f756e642d636f6c6f723a234546454645463b0a7d0a2e727373526f773a686f7665727b0a6261636b67726f756e642d636f6c6f723a234546454645463b0a7d0a0a2e77726170203a686f7665727b0a6261636b67726f756e642d636f6c6f723a234445453345433b0a7d0a0a2e727373526f77202e7273734d65646961207b0a0970616464696e673a20302e35656d3b0a09666f6e742d73697a653a2031656d3b0a7d0a0a2e7375626d69744356207b0a626f726465722d6c6566743a2031707820736f6c696420234331433143313b0a626f726465722d72696768743a2031707820736f6c696420234331433143313b0a626f726465722d746f703a2032707820736f6c696420233934413343343b0a626f726465722d626f74746f6d3a2032707820736f6c696420234331433143313b0a6d617267696e2d626f74746f6d3a20313070783b0a6261636b67726f756e642d636f6c6f723a20234544454646343b0a70616464696e673a20313070783b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09666f6e742d73697a653a20313270783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a09636f6c6f723a20233030303b0a09746578742d616c69676e3a2063656e7465723b0a207d0a200a202e64726f70646f776e207b0a626f726465722d6c6566743a2031707820736f6c696420234331433143313b0a626f726465722d72696768743a2031707820736f6c696420234331433143313b0a626f726465722d746f703a2032707820736f6c696420233934413343343b0a626f726465722d626f74746f6d3a2032707820736f6c696420234331433143313b0a6261636b67726f756e642d636f6c6f723a20234544454646343b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09666f6e742d73697a653a20313270783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a09636f6c6f723a20233030303b0a09746578742d616c69676e3a2063656e7465723b0a207d0a202e7375626d697443562d6f75746572207b0a0a09746578742d6465636f726174696f6e3a206e6f6e653b0a0a207d0a0a202e736f75726365207b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09636f6c6f723a20233342353939383b0a09666f6e742d73697a653a20313470783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a0970616464696e673a313070783b0a09666f6e742d7765696768743a626f6c6465723b0a09746578742d616c69676e3a2063656e7465723b0a7d0a200a206469762e7375626d697443563a6163746976657b0a6261636b67726f756e642d636f6c6f723a234546454645463b0a7d0a6469762e7375626d697443563a686f7665727b0a6261636b67726f756e642d636f6c6f723a234546454645463b0a7d0a0a202e7375626d697443562d5355424d4954207b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09636f6c6f723a20233342353939383b0a09666f6e742d73697a653a20323070783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a0970616464696e673a313070783b0a09666f6e742d7765696768743a626f6c6465723b0a09746578742d616c69676e3a2063656e7465723b0a0909746578742d6465636f726174696f6e3a206e6f6e653b0a7d0a0a200a2f2a0a23356337356139206261636b67726f756e6420636f6c6f720a2338613963633220746f7020626f726465720a2332393434376520626f726465720a2331613335366520626f7264657220626f74746f6d0a2334663661613320686f766572206261636b67726f756e6420636f6c6f720a2a2f0a200a2e626f74746f6d207b0a706f736974696f6e3a72656c61746976653b0a6d617267696e2d746f703a202d343070783b0a626f726465723a6e6f6e653b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09666f6e742d73697a653a203870783b0a09666c6f61743a2072696768743b0a0977696474683a2031303470783b0a0a7d0a2e66616365626f6f6b207b0a0a09666f6e742d73697a653a203b0a09636f6c6f723a20233636363b0a096d617267696e3a20302e32656d203020302e34656d20303b0a090a0a7d0a0a2e7172636f6465207b0a0a666c6f61743a2072696768743b0a0a7d0a0a0a200a2e627574746f6e5f6f7574736964655f626f726465725f626c75657b0a77696474683a31303070783b0a626f726465723a736f6c69642023323934343765203170783b0a626f726465722d626f74746f6d3a736f6c69642023316133353665203170783b0a637572736f723a706f696e7465723b0a666c6f61743a2072696768743b0a7d0a200a2e627574746f6e5f696e736964655f626f726465725f626c75657b0a70616464696e673a36707820302036707820303b0a6261636b67726f756e642d636f6c6f723a233563373561393b0a626f726465722d746f703a736f6c69642023386139636332203170783b0a746578742d616c69676e3a63656e7465723b0a636f6c6f723a236666666666663b0a666f6e742d73697a653a313270783b0a666f6e742d7765696768743a626f6c6465723b0a7d0a200a6469762e627574746f6e5f696e736964655f626f726465725f626c75653a6163746976657b0a6261636b67726f756e642d636f6c6f723a233466366161333b0a7d0a6469762e627574746f6e5f696e736964655f626f726465725f626c75653a686f7665727b0a6261636b67726f756e642d636f6c6f723a233466366161333b0a7d0a0a2e6a6f627469746c65207b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09636f6c6f723a20233342353939383b0a09666f6e742d73697a653a20323070783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a09666f6e742d7765696768743a626f6c6465723b0a7d0a0a2e64657363207b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09636f6c6f723a20233030303030303b0a09666f6e742d73697a653a20313270783b0a0a7d0a0a2e6465736320613a6c696e6b207b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a0a09666f6e742d73697a653a20313270783b0a0a7d0a0a23636f6e74656e74626f78207b0a70616464696e673a20313070783b200a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09666f6e742d73697a653a20313270783b0a09666f6e742d7765696768743a206e6f726d616c3b0a09636f6c6f723a20233333333b0a096c696e652d6865696768743a20312e35656d3b0a6261636b67726f756e642d636f6c6f723a2072676261283235352c3235352c3235352c302e36293b0a7d0a0a6831207b0a20202020636c6561723a20626f74683b0a20202020666f6e742d66616d696c793a20417269616c2c48656c7665746963612c73616e732d73657269663b0a20202020666f6e742d73697a653a20323270783b0a202020206c696e652d6865696768743a20313030253b0a202020206d617267696e2d626f74746f6d3a20323570783b0a7d, '');
INSERT INTO `rss_board` (`id`, `board_name`, `board_url`, `board_html`, `fb_app_id`, `board_css`, `board_background`) VALUES
(20, 'AFLRecruitment', 'http://www.aflrecruitment.com.au/jobs-listing/feed/', 0x3c7461626c652077696474683d2237393070782220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2235223e0a20203c74723e0a202020203c74642076616c69676e3d22746f70223e0a090a093c6469762069643d22636f6e74656e74626f78223e0a093c68313e5765277265206865726520746f2068656c702e3c2f68313e0a0941464c20526563727569746d656e74206973206865726520746f2068656c7020796f7520616c6f6e6720796f75722063617265657220706174682e2042726f777365206f75722063757272656e746c7920617661696c61626c65206a6f6273206f7220696620796f75206861766520616e797468696e6720796f752764206c696b6520746f206469736375737320776974682075732c206665656c206672656520746f2073656e642075732061203c6120687265663d2268747470733a2f2f7777772e66616365626f6f6b2e636f6d2f6d657373616765732f313235353835393534323638393437223e6d6573736167653c2f613e2e0a093c2f6469763e0a093c2f62723e0a090a09093c6469762069643d22636f6e74656e74626f78223e0a090a3c68313e4469646e27742066696e6420746865206a6f6220796f752077657265206c6f6f6b696e6720666f723f3c2f68313e0a0941732070617274206f662074686520436172656572734d756c74694c697374206e6574776f726b20776520686176652061636365737320746f2068756e6465726473206f66206f7468657220636172656572732074686174206d617920696e74657265737420796f752e3c62723e203c64697620636c6173733d227375626d697443562d5355424d4954223e3c6120687265663d2268747470733a2f2f617070732e317374736f6369616c2e636f6d2e61752f696e6465782e7068702f626f6172645f636f6e74726f6c6c65722f73686f775f626f6172642f436172656572734d756c74694c697374223e436c69636b20486572653c2f613e3c2f6469763e0a093c2f6469763e0a093c2f62723e0a090a093c2f74643e0a202020203c74642076616c69676e3d22746f70222077696474683d22353230223e3c6469762069643d226a6f6273223e3c2f6469763e3c2f74643e0a20203c2f74723e0a3c2f7461626c653e, '499822386752490', 0x406368617273657420225554462d38223b0a0a0a626f6479207b0a77696474683a38313070783b0a6f766572666c6f773a68696464656e3b0a6d617267696e3a313070783b2070616464696e673a303b20626f726465723a303b0a202020206261636b67726f756e642d636f6c6f723a20236666666666663b0a202020206261636b67726f756e642d696d6167653a2075726c286170706261636b67726f756e642e6a7067293b0a202020206261636b67726f756e642d7265706561743a207265706561742d783b0a096261636b67726f756e642d6174746163686d656e743a2066697865643b0a09666f6e742d66616d696c793a20226c7563696461206772616e6465222c207461686f6d612c2076657264616e612c20617269616c2c2073616e732d73657269663b0a0a7d0a0a6120696d67207b0a09626f726465723a6e6f6e653b0a7d0a0a61207b0a09636f6c6f723a233539373037423b0a09746578742d6465636f726174696f6e3a6e6f6e653b0a09666f6e742d7765696768743a3730303b0a7d0a613a686f766572207b0a09746578742d6465636f726174696f6e3a6e6f6e653b0a7d0a613a6163746976652c20613a766973697465642c20613a666f6375730a7b0a096f75746c696e653a206e6f6e653b0a09626f726465723a20303b0a7d0a0a613a666f6375730a7b0a092d6d6f7a2d6f75746c696e652d7374796c653a206e6f6e653b0a096f75746c696e653a20303b0a7d0a0a613a666f6375732c202a3a666f637573207b0a202020206e6f466f6375734c696e653a2065787072657373696f6e28746869732e6f6e466f6375733d746869732e626c75722829293b0a7d0a0a2364796e616d69632d636f6e74656e7420613a686f7665727b0a09746578742d6465636f726174696f6e3a20756e6465726c696e653b0a7d0a0a737562207b0a646973706c61793a206e6f6e653b0a7d0a0a2e72737346656564207b0a09666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09666f6e742d73697a653a20313270783b0a090a7d0a2e727373466565642061207b0a09636f6c6f723a20233342353939383b0a09666f6e742d73697a653a20313870783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a7d0a2e7273734665656420613a686f766572207b0a09636f6c6f723a20233342353939383b0a09746578742d6465636f726174696f6e3a20756e6465726c696e653b0a7d0a0a2e727373486561646572207b2070616464696e673a20302e32656d20303b207d0a0a2e727373426f6479207b20626f726465722d626f74746f6d3a2032707820736f6c696420234331433143313b0a626f726465722d746f703a2031707820736f6c696420234331433143313b207d0a2e727373426f647920756c207b206c6973742d7374796c653a206e6f6e653b207d0a2e727373426f647920756c2c202e727373526f772c202e727373526f772068342c202e727373526f772070207b0a096d617267696e3a20303b0a0970616464696e673a20303b0a7d0a0a2e727373526f77207b2070616464696e673a20302e38656d3b0a626f726465722d6c6566743a2031707820736f6c696420234331433143313b0a626f726465722d72696768743a2031707820736f6c696420234331433143313b0a626f726465722d746f703a2031707820736f6c696420234331433143313b207d0a2e727373526f77206834207b20666f6e742d73697a653a203870783b207d0a2e64617465207b0a09666f6e742d73697a653a203b0a09636f6c6f723a20233636363b0a096d617267696e3a20302e32656d203020302e34656d20303b0a7d0a0a6c693a6e74682d6368696c64286f6464297b206261636b67726f756e642d636f6c6f723a20236666666666663b207d0a6c693a6e74682d6368696c64286576656e297b206261636b67726f756e642d636f6c6f723a20234544454646343b207d0a0a23636f6e74656e746c697374206c693a6e74682d6368696c64286f6464297b206261636b67726f756e642d636f6c6f723a207472616e73706172656e743b207d0a23636f6e74656e746c697374206c693a6e74682d6368696c64286576656e297b206261636b67726f756e642d636f6c6f723a207472616e73706172656e743b207d0a0a2e727373526f773a6163746976657b0a6261636b67726f756e642d636f6c6f723a234546454645463b0a7d0a2e727373526f773a686f7665727b0a6261636b67726f756e642d636f6c6f723a234546454645463b0a7d0a0a2e77726170203a686f7665727b0a6261636b67726f756e642d636f6c6f723a234445453345433b0a7d0a0a2e727373526f77202e7273734d65646961207b0a0970616464696e673a20302e35656d3b0a09666f6e742d73697a653a2031656d3b0a7d0a0a2e7375626d69744356207b0a626f726465722d6c6566743a2031707820736f6c696420234331433143313b0a626f726465722d72696768743a2031707820736f6c696420234331433143313b0a626f726465722d746f703a2032707820736f6c696420233934413343343b0a626f726465722d626f74746f6d3a2032707820736f6c696420234331433143313b0a6d617267696e2d626f74746f6d3a20313070783b0a6261636b67726f756e642d636f6c6f723a20234544454646343b0a70616464696e673a20313070783b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09666f6e742d73697a653a20313270783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a09636f6c6f723a20233030303b0a09746578742d616c69676e3a2063656e7465723b0a207d0a200a202e64726f70646f776e207b0a626f726465722d6c6566743a2031707820736f6c696420234331433143313b0a626f726465722d72696768743a2031707820736f6c696420234331433143313b0a626f726465722d746f703a2032707820736f6c696420233934413343343b0a626f726465722d626f74746f6d3a2032707820736f6c696420234331433143313b0a6261636b67726f756e642d636f6c6f723a20234544454646343b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09666f6e742d73697a653a20313270783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a09636f6c6f723a20233030303b0a09746578742d616c69676e3a2063656e7465723b0a207d0a202e7375626d697443562d6f75746572207b0a0a09746578742d6465636f726174696f6e3a206e6f6e653b0a0a207d0a0a202e736f75726365207b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09636f6c6f723a20233342353939383b0a09666f6e742d73697a653a20313470783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a0970616464696e673a313070783b0a09666f6e742d7765696768743a626f6c6465723b0a09746578742d616c69676e3a2063656e7465723b0a7d0a200a206469762e7375626d697443563a6163746976657b0a6261636b67726f756e642d636f6c6f723a234546454645463b0a7d0a6469762e7375626d697443563a686f7665727b0a6261636b67726f756e642d636f6c6f723a234546454645463b0a7d0a0a202e7375626d697443562d5355424d4954207b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09636f6c6f723a20233342353939383b0a09666f6e742d73697a653a20323070783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a0970616464696e673a313070783b0a09666f6e742d7765696768743a626f6c6465723b0a09746578742d616c69676e3a2063656e7465723b0a0909746578742d6465636f726174696f6e3a206e6f6e653b0a7d0a0a200a2f2a0a23356337356139206261636b67726f756e6420636f6c6f720a2338613963633220746f7020626f726465720a2332393434376520626f726465720a2331613335366520626f7264657220626f74746f6d0a2334663661613320686f766572206261636b67726f756e6420636f6c6f720a2a2f0a200a2e626f74746f6d207b0a706f736974696f6e3a72656c61746976653b0a6d617267696e2d746f703a202d343070783b0a626f726465723a6e6f6e653b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09666f6e742d73697a653a203870783b0a09666c6f61743a2072696768743b0a0977696474683a2031303470783b0a0a7d0a2e66616365626f6f6b207b0a0a09666f6e742d73697a653a203b0a09636f6c6f723a20233636363b0a096d617267696e3a20302e32656d203020302e34656d20303b0a090a0a7d0a0a2e7172636f6465207b0a0a666c6f61743a2072696768743b0a0a7d0a0a0a200a2e627574746f6e5f6f7574736964655f626f726465725f626c75657b0a77696474683a31303070783b0a626f726465723a736f6c69642023323934343765203170783b0a626f726465722d626f74746f6d3a736f6c69642023316133353665203170783b0a637572736f723a706f696e7465723b0a666c6f61743a2072696768743b0a7d0a200a2e627574746f6e5f696e736964655f626f726465725f626c75657b0a70616464696e673a36707820302036707820303b0a6261636b67726f756e642d636f6c6f723a233563373561393b0a626f726465722d746f703a736f6c69642023386139636332203170783b0a746578742d616c69676e3a63656e7465723b0a636f6c6f723a236666666666663b0a666f6e742d73697a653a313270783b0a666f6e742d7765696768743a626f6c6465723b0a7d0a200a6469762e627574746f6e5f696e736964655f626f726465725f626c75653a6163746976657b0a6261636b67726f756e642d636f6c6f723a233466366161333b0a7d0a6469762e627574746f6e5f696e736964655f626f726465725f626c75653a686f7665727b0a6261636b67726f756e642d636f6c6f723a233466366161333b0a7d0a0a2e6a6f627469746c65207b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09636f6c6f723a20233342353939383b0a09666f6e742d73697a653a20323070783b0a09746578742d6465636f726174696f6e3a206e6f6e653b0a09666f6e742d7765696768743a626f6c6465723b0a7d0a0a2e64657363207b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09636f6c6f723a20233030303030303b0a09666f6e742d73697a653a20313270783b0a0a7d0a0a2e6465736320613a6c696e6b207b0a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a0a09666f6e742d73697a653a20313270783b0a0a7d0a0a23636f6e74656e74626f78207b0a70616464696e673a20313070783b200a666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b0a09666f6e742d73697a653a20313270783b0a09666f6e742d7765696768743a206e6f726d616c3b0a09636f6c6f723a20233333333b0a096c696e652d6865696768743a20312e35656d3b0a6261636b67726f756e642d636f6c6f723a2072676261283235352c3235352c3235352c302e36293b0a7d0a0a6831207b0a20202020636c6561723a20626f74683b0a20202020666f6e742d66616d696c793a20417269616c2c48656c7665746963612c73616e732d73657269663b0a20202020666f6e742d73697a653a20323270783b0a202020206c696e652d6865696768743a20313030253b0a202020206d617267696e2d626f74746f6d3a20323570783b0a7d, '');

-- --------------------------------------------------------

--
-- Table structure for table `static_page`
--

CREATE TABLE IF NOT EXISTS `static_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` int(11) NOT NULL,
  `page_html` blob NOT NULL,
  `page_css` blob NOT NULL,
  `page_background` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(2, 'Indusries'),
(3, 'Location'),
(5, 'melbourne'),
(6, 'FIFO'),
(7, 'QLD '),
(9, 'Brisbane '),
(10, 'Mining, Resources & Energy'),
(11, 'Automotive '),
(12, 'Construction'),
(13, 'HR & Recruitment'),
(14, 'Transport & Logistics '),
(15, 'Healthcare'),
(16, 'Occupations'),
(17, 'Sales & Marketing '),
(18, 'Engineering '),
(19, 'Semi-Skilled Labour '),
(20, 'Driving '),
(21, 'vehicle'),
(24, 'Vermont'),
(27, 'sidney'),
(32, 'retail'),
(35, 'xyz'),
(36, 'property'),
(37, 'Property Type'),
(38, 'Single Storey'),
(39, 'Double Storey'),
(40, 'Art'),
(41, 'Type'),
(42, 'Sculpture'),
(43, 'Aspect'),
(45, 'Bodley'),
(46, 'Tramway'),
(47, 'Rear'),
(48, 'Beach'),
(49, 'Bay Views'),
(50, 'property-regents'),
(51, 'aspect-regents'),
(52, 'North'),
(53, 'South'),
(54, 'East'),
(55, 'West'),
(57, 'job');

-- --------------------------------------------------------

--
-- Table structure for table `tag_parent`
--

CREATE TABLE IF NOT EXISTS `tag_parent` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `tag_id` int(5) NOT NULL,
  `parent_tag_id` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=87 ;

--
-- Dumping data for table `tag_parent`
--

INSERT INTO `tag_parent` (`id`, `tag_id`, `parent_tag_id`) VALUES
(4, 5, 3),
(5, 6, 3),
(6, 7, 3),
(7, 9, 3),
(8, 10, 2),
(9, 11, 2),
(10, 12, 2),
(11, 13, 2),
(12, 14, 2),
(13, 15, 2),
(15, 17, 16),
(16, 18, 16),
(17, 19, 16),
(18, 20, 16),
(21, 23, 22),
(33, 21, 0),
(39, 24, 3),
(44, 3, 21),
(46, 27, 3),
(56, 36, 0),
(60, 40, 0),
(61, 41, 40),
(62, 42, 41),
(67, 38, 37),
(68, 39, 37),
(69, 43, 36),
(71, 45, 43),
(72, 46, 43),
(73, 47, 43),
(74, 48, 43),
(75, 37, 36),
(76, 49, 43),
(77, 50, 0),
(78, 51, 50),
(79, 52, 51),
(80, 53, 51),
(81, 54, 51),
(82, 55, 51),
(85, 57, 0),
(86, 2, 57);

-- --------------------------------------------------------

--
-- Table structure for table `taxonomy`
--

CREATE TABLE IF NOT EXISTS `taxonomy` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tag_id` varchar(10) DEFAULT NULL,
  `taxonomy_id` int(10) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `value` varchar(200) NOT NULL,
  `type` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tag_id` (`tag_id`),
  KEY `pareent_taxonomy_id` (`taxonomy_id`),
  KEY `pareent_taxonomy_id_2` (`taxonomy_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `taxonomy`
--

INSERT INTO `taxonomy` (`id`, `tag_id`, `taxonomy_id`, `name`, `value`, `type`) VALUES
(2, '57', NULL, 'salary', '', 'Integer'),
(3, '57', NULL, 'link', '', 'string'),
(7, '36,50', NULL, 'price', '', 'Integer'),
(8, '36', NULL, 'Price ($)', '', 'Integer'),
(9, '40', NULL, 'New Price', '', 'Integer'),
(10, '36', NULL, 'Car Parking Spaces', '', 'Integer'),
(11, '36', NULL, 'Bedrooms', '', 'Integer'),
(12, '36', NULL, 'Bathrooms', '', 'Integer'),
(13, '36', NULL, 'Internal Size (m2)', '', 'Integer'),
(14, '36', NULL, 'External Size (m2)', '', 'Integer'),
(15, '36', NULL, 'Total Size (m2)', '', 'Integer'),
(16, '36', NULL, 'Storage', '', 'string'),
(17, '50', NULL, 'Price', '', 'Integer'),
(18, '50', NULL, 'Bedrooms', '', 'Integer'),
(19, '50', NULL, 'Type', '', 'string'),
(20, '50', NULL, 'Internal Size (m2)', '', 'Integer'),
(21, '50', NULL, 'External Size (m2)', '', 'Integer'),
(22, '50', NULL, 'Total Size (m2)', '', 'Integer');

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

CREATE TABLE IF NOT EXISTS `theme` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `theme_name` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  `theme_css` mediumtext NOT NULL,
  `theme_css_url` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`id`, `theme_name`, `status`, `theme_css`, `theme_css_url`) VALUES
(2, 'red', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `theme_value`
--

CREATE TABLE IF NOT EXISTS `theme_value` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `key` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  `theme_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=187 ;

--
-- Dumping data for table `theme_value`
--

INSERT INTO `theme_value` (`id`, `key`, `value`, `theme_id`) VALUES
(159, 'id', '2', '2'),
(160, 'css_box', '  .something {}', '2'),
(161, 'body_font_size', '13px', '2'),
(162, 'background_color', 'black', '2'),
(163, 'body_font_family', 'arial', '2'),
(164, 'body_font_color', 'white', '2'),
(165, 'head_border_color', '#9e8833', '2'),
(166, 'bg', '#9e8833', '2'),
(167, 'blog_bg_color', '#9e8833', '2'),
(168, 'blog_name_color', '#9e8833', '2'),
(169, 'menu_color', '#9e8833', '2'),
(170, 'border', '1px solid #9e8833', '2'),
(171, 'search_bg_color', 'white', '2'),
(172, 'searchbtn_color', '#9e8833', '2'),
(173, 'latestjob_text_color', 'red', '2'),
(174, 'jobdiv_top_border', '1px solid #9e8833', '2'),
(175, 'jobdiv_bottom_border', '1px solid #9e8833', '2'),
(176, 'job_bg_color', '#9e8833', '2'),
(177, 'saperator_color', '#9e8833', '2'),
(178, 'date_color', '#9e8833', '2'),
(179, 'anchor_color', '#9e8833', '2'),
(180, 'anchor_size', '13px', '2'),
(181, 'title_color', '#9e8833', '2'),
(182, 'price_range_color', '#9e8833', '2'),
(183, 'slider_color', '#9e8833', '2'),
(184, 'bottombg_color', '#9e8833', '2'),
(185, 'topborder_color', '#9e8833', '2'),
(186, 'footer_color', '#9e8833', '2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `domain_id` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(30) NOT NULL,
  `access_level` enum('admin','partner','client','user') NOT NULL,
  `parent_user_id` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `domain_id` (`domain_id`),
  KEY `user_id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `domain_id`, `username`, `password`, `type`, `access_level`, `parent_user_id`) VALUES
(1, 'admin', 0, '1stSocialDev', 'f3da537183bd618bf1334e5ca5b2ce35', '', 'admin', 0),
(2, 'DemoAccount', 1, 'DemoAccount', '02107703511892efb7b6b8202d57238e', '', 'partner', 1),
(3, 'Test_partner', 1, 'user', 'f3da537183bd618bf1334e5ca5b2ce35', '', 'user', 1),
(4, 'Rahul', 2, 'temp', 'f3da537183bd618bf1334e5ca5b2ce35', '', 'partner', 1),
(6, 'ankit', 1, 'ankit', 'f3da537183bd618bf1334e5ca5b2ce35', '', 'client', 1),
(42, 'test', 2, 'tset', '467b617fec4d9fcb63505734ee224851', '', 'client', 4),
(43, '', 0, '', 'd41d8cd98f00b204e9800998ecf8427e', '', 'partner', 1),
(44, 'Andrew Thoseby', 15, 'a_thoseby', 'f3da537183bd618bf1334e5ca5b2ce35', '', 'partner', 1),
(45, 'client_1', 15, 'client', 'f3da537183bd618bf1334e5ca5b2ce35', '', 'client', 44),
(46, '1stWorld Client', 15, 'client_user', 'f3da537183bd618bf1334e5ca5b2ce35', '', 'client', 44);

-- --------------------------------------------------------

--
-- Table structure for table `users_theme`
--

CREATE TABLE IF NOT EXISTS `users_theme` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `user_id` tinyint(4) NOT NULL,
  `theme_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `theme_id` (`theme_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
