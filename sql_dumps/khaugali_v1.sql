-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 05, 2013 at 11:19 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `khaugali_v1`
--

-- --------------------------------------------------------

--
-- Table structure for table `been_to`
--

CREATE TABLE IF NOT EXISTS `been_to` (
  `username` varchar(50) NOT NULL,
  `rest_id` int(11) NOT NULL,
  PRIMARY KEY (`username`,`rest_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `been_to`
--

INSERT INTO `been_to` (`username`, `rest_id`) VALUES
('A', 4),
('D', 4),
('D', 6),
('M', 1),
('M', 3);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(50) NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`) VALUES
(1, 'Surat'),
(2, 'Ahmedabad'),
(3, 'Gandhinagar');

-- --------------------------------------------------------

--
-- Table structure for table `cuisines`
--

CREATE TABLE IF NOT EXISTS `cuisines` (
  `cuisine_id` int(11) NOT NULL AUTO_INCREMENT,
  `cuisine_name` varchar(50) NOT NULL,
  PRIMARY KEY (`cuisine_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `cuisines`
--

INSERT INTO `cuisines` (`cuisine_id`, `cuisine_name`) VALUES
(1, 'Gujarati'),
(2, 'Punjabi'),
(3, 'Rajasthani'),
(4, 'Continental'),
(5, 'Chinese'),
(6, 'Mexican'),
(9, 'South Indian');

-- --------------------------------------------------------

--
-- Table structure for table `favourite`
--

CREATE TABLE IF NOT EXISTS `favourite` (
  `username` varchar(50) NOT NULL,
  `rest_id` int(11) NOT NULL,
  PRIMARY KEY (`username`,`rest_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favourite`
--

INSERT INTO `favourite` (`username`, `rest_id`) VALUES
('A', 4),
('D', 4),
('D', 6),
('M', 3);

-- --------------------------------------------------------

--
-- Table structure for table `lives_in`
--

CREATE TABLE IF NOT EXISTS `lives_in` (
  `username` varchar(50) NOT NULL,
  `city_id` int(11) NOT NULL,
  `locality_name` varchar(50) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lives_in`
--

INSERT INTO `lives_in` (`username`, `city_id`, `locality_name`) VALUES
('A', 3, 'Infocity'),
('D', 2, 'Dharnidhar cross roads'),
('M', 1, 'Adajan');

-- --------------------------------------------------------

--
-- Table structure for table `locality`
--

CREATE TABLE IF NOT EXISTS `locality` (
  `city_id` int(11) NOT NULL,
  `locality_name` varchar(50) NOT NULL,
  PRIMARY KEY (`city_id`,`locality_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locality`
--

INSERT INTO `locality` (`city_id`, `locality_name`) VALUES
(1, 'Adajan'),
(1, 'Parle Point'),
(1, 'Piplod'),
(2, 'Dharnidhar cross roads'),
(2, 'Drive In'),
(2, 'Law Garder'),
(3, 'Infocity'),
(3, 'Sector 11');

-- --------------------------------------------------------

--
-- Table structure for table `located_in`
--

CREATE TABLE IF NOT EXISTS `located_in` (
  `rest_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `locality_name` varchar(50) NOT NULL,
  PRIMARY KEY (`rest_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `located_in`
--

INSERT INTO `located_in` (`rest_id`, `city_id`, `locality_name`) VALUES
(1, 3, 'Infocity'),
(2, 1, 'Parle Point'),
(3, 1, 'Piplod'),
(4, 2, 'Dharanidhar cross road'),
(5, 2, 'Drive In'),
(6, 3, 'Sector 11');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `username` varchar(50) NOT NULL,
  `rest_id` int(11) NOT NULL,
  `taste` tinyint(4) DEFAULT NULL,
  `ambience` tinyint(4) DEFAULT NULL,
  `value_for_money` tinyint(4) DEFAULT NULL,
  `service` tinyint(4) DEFAULT NULL,
  `hygiene` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`username`,`rest_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`username`, `rest_id`, `taste`, `ambience`, `value_for_money`, `service`, `hygiene`) VALUES
('A', 4, 5, 5, 3, 4, 4),
('D', 4, 4, 4, 3, 4, 3),
('D', 6, 5, 5, 5, 5, 5),
('M', 1, 4, 3, 4, 3, 3),
('M', 2, 3, 4, 2, 3, 4),
('M', 3, 5, 5, 3, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE IF NOT EXISTS `restaurant` (
  `res_id` int(11) NOT NULL AUTO_INCREMENT,
  `restaurant_name` varchar(100) NOT NULL,
  `phone_number` decimal(10,0) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` text NOT NULL,
  `veg_non_veg` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 is veg| 1 is non veg | 2 is egg',
  `home_delivery` tinyint(1) NOT NULL COMMENT '0 is NO | 1 is YES',
  `dinein_take_away` tinyint(4) NOT NULL DEFAULT '2' COMMENT '0 is dine in | 1 is take away | 2 is both',
  `cost_for_two` decimal(4,0) NOT NULL,
  `timing` varchar(15) NOT NULL,
  `buffet_availability` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 is NO | 1 is YES',
  `menu_card` varchar(100) NOT NULL,
  `payment_options` tinyint(4) NOT NULL DEFAULT '2' COMMENT '0 is dine in | 1 is take away | 2 is both',
  PRIMARY KEY (`res_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`res_id`, `restaurant_name`, `phone_number`, `email`, `address`, `veg_non_veg`, `home_delivery`, `dinein_take_away`, `cost_for_two`, `timing`, `buffet_availability`, `menu_card`, `payment_options`) VALUES
(1, 'Matarani Dhaba', '1111111', NULL, 'Infocity Mall, Near Gh 0, Gandhinagar', 0, 0, 2, '150', '08:00-22:00', 0, 'matarani_menu', 1),
(2, 'Pizza Hut', '2222222222', 'help@pizzahut.com', 'Swagat Complex, Parle Point', 2, 1, 2, '500', '08:00-22:00', 0, 'pizzahut_menu', 2),
(3, 'Saffron', '3333333333', NULL, 'City Plus Multiplex, Near ONGC colony, Piplod', 0, 0, 1, '350', '10:00-22:00', 1, 'saffron_menu', 2),
(4, 'Sankalp', '4444444444', NULL, 'Anubhuti Complex, Dharnidhar Cross Roads', 0, 0, 1, '300', '10:00-22:00', 0, 'sankalp_menu', 2),
(5, 'Pakvan', '5555555555', 'contactus@mcd.com', 'Drive In cross road, Drive In', 0, 0, 2, '500', '10:00-21:00', 1, 'pakvan_menu', 1),
(6, 'Domino''s', '6666666666', 'talktous@dominos.com', 'Meghmalhar Complex, Near Fortune Inn Haveli, Sector 11', 2, 1, 2, '400', '10:00-23:00', 0, 'dominos_menu', 2);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_photos`
--

CREATE TABLE IF NOT EXISTS `restaurant_photos` (
  `rest_id` int(11) NOT NULL,
  `photo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurant_photos`
--

INSERT INTO `restaurant_photos` (`rest_id`, `photo`) VALUES
(1, 'matarani_pic1'),
(1, 'matarani_pic2'),
(2, 'pizahut_pic'),
(3, 'saffron_pic'),
(4, 'sankalp_pic1'),
(4, 'sankalp_pic2'),
(6, 'Dominos_pic');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `username` varchar(30) NOT NULL,
  `rest_id` int(11) NOT NULL,
  `review` text NOT NULL,
  PRIMARY KEY (`username`,`rest_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`username`, `rest_id`, `review`) VALUES
('D', 4, 'Good food. I like it. '),
('m', 1, 'Good place for those who are compelled to eat out. Good taste. But, I think it is a little too oily at times.'),
('M', 3, 'Good Food. '),
('M', 6, 'Best Place Ever! :D');

-- --------------------------------------------------------

--
-- Table structure for table `serves`
--

CREATE TABLE IF NOT EXISTS `serves` (
  `cuisine_id` int(11) NOT NULL,
  `rest_id` int(11) NOT NULL,
  PRIMARY KEY (`cuisine_id`,`rest_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `serves`
--

INSERT INTO `serves` (`cuisine_id`, `rest_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 4),
(2, 6),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(4, 1),
(4, 9),
(5, 1),
(5, 3),
(6, 4),
(6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `suggested_located_in`
--

CREATE TABLE IF NOT EXISTS `suggested_located_in` (
  `sres_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `locality_name` varchar(50) NOT NULL,
  PRIMARY KEY (`sres_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suggested_located_in`
--

INSERT INTO `suggested_located_in` (`sres_id`, `city_id`, `locality_name`) VALUES
(1, 3, 'Infocity'),
(2, 1, 'Parle Point'),
(3, 2, 'Law Gardern'),
(4, 1, 'Adajan');

-- --------------------------------------------------------

--
-- Table structure for table `suggested_restaurants`
--

CREATE TABLE IF NOT EXISTS `suggested_restaurants` (
  `sres_id` int(11) NOT NULL AUTO_INCREMENT,
  `sres_name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `phone_number` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`sres_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `suggested_restaurants`
--

INSERT INTO `suggested_restaurants` (`sres_id`, `sres_name`, `address`, `phone_number`, `status`) VALUES
(1, 'Barley Water', 'Infocity mall, near Gh 0', NULL, 2),
(2, 'Gateway Taj', 'Sargam Shopping complex, Parle Point', 2147483647, 1),
(3, 'Swati Snacks', 'Law Garder cross Roads ', NULL, 1),
(4, 'Walk on Fire', 'Opposite Rajhans Multiplex, Hazira Road, Adajan', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `profile_picture` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` decimal(10,0) DEFAULT NULL,
  `hashed_password` varchar(20) NOT NULL,
  `joined` date NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `name`, `profile_picture`, `email`, `phone_number`, `hashed_password`, `joined`) VALUES
('A', 'Ayudh Das', 'ayd_pic', 'ayudh.d@gmail.com', '9999999999', 'xyz123', '2013-04-05'),
('D', 'Devanshi Mehta', 'dev_pic', 'devanshimehta12@gmail.com', '8888888888', 'xyz123', '2013-04-05'),
('M', 'Mruga Shastri', 'mrg_pic', 'mruga92@gmail,com', NULL, 'xyz123', '2013-04-04');

-- --------------------------------------------------------

--
-- Table structure for table `wishes_to_go_to`
--

CREATE TABLE IF NOT EXISTS `wishes_to_go_to` (
  `username` varchar(30) NOT NULL,
  `rest_id` int(11) NOT NULL,
  PRIMARY KEY (`username`,`rest_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishes_to_go_to`
--

INSERT INTO `wishes_to_go_to` (`username`, `rest_id`) VALUES
('A', 3),
('A', 5),
('D', 2),
('M', 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
