-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 07, 2020 at 06:48 PM
-- Server version: 5.7.26
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flight_booking_system`
--
CREATE DATABASE IF NOT EXISTS `flight_booking_system` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `flight_booking_system`;

-- --------------------------------------------------------

--
-- Table structure for table `flight_ticket`
--

DROP TABLE IF EXISTS `flight_ticket`;
CREATE TABLE IF NOT EXISTS `flight_ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `airline` varchar(50) NOT NULL,
  `departure` varchar(50) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `departure_date` varchar(50) NOT NULL,
  `departure_time` varchar(50) NOT NULL,
  `is_direct` varchar(50) NOT NULL,
  `total_price` varchar(50) NOT NULL,
  `total_passengers` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `flight_ticket`
--

INSERT INTO `flight_ticket` (`id`, `user_id`, `airline`, `departure`, `destination`, `departure_date`, `departure_time`, `is_direct`, `total_price`, `total_passengers`) VALUES
(1, 1, 'Airblue', 'Islamabad, Pakistan', 'Karachi, Pakistan', '20-08-2020', '12:45', 'Yes', 'Rs 13406', 1),
(2, 1, 'Airblue', 'Islamabad, Pakistan', 'Karachi, Pakistan', '15-08-2020', '12:45', 'Yes', 'Rs 13406', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`) VALUES
(1, 'talha', '5f4dcc3b5aa765d61d8327deb882cf99');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

DROP TABLE IF EXISTS `user_profile`;
CREATE TABLE IF NOT EXISTS `user_profile` (
  `profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`profile_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`profile_id`, `user_id`, `first_name`, `last_name`, `email`, `phone_number`) VALUES
(1, 1, 'Talha', 'Tariq', 'talha@none.com', '0399-9388229');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
