-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 16, 2020 at 12:14 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinelibrary`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullName` varchar(100) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fullName`, `email`, `username`, `password`, `updationDate`) VALUES
(1, 'admin admin', 'admin@admin.com', 'hanafa01', '0000', '2020-06-09 21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
CREATE TABLE IF NOT EXISTS `author` (
  `authorId` int(11) NOT NULL AUTO_INCREMENT,
  `authorName` varchar(120) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`authorId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`authorId`, `authorName`, `creationDate`, `updationDate`) VALUES
(1, 'Victor Hugo', '2020-06-10 16:22:40', '2020-06-10 16:22:40'),
(2, 'Robert Ervin Howard', '2020-06-10 16:22:51', '2020-06-10 16:22:51'),
(3, 'Sharad Kumar Verma', '2020-06-10 16:23:01', '2020-06-10 16:23:01'),
(4, 'Jane Austen', '2020-06-10 16:27:05', '2020-06-10 16:27:05'),
(5, 'Saurabh Singhal', '2020-06-10 21:38:19', '2020-06-10 21:38:19');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `bookId` int(11) NOT NULL AUTO_INCREMENT,
  `bookName` varchar(120) DEFAULT NULL,
  `categoryId` int(11) DEFAULT NULL,
  `authorId` int(11) DEFAULT NULL,
  `ISBN` int(11) NOT NULL,
  `publisherName` varchar(120) DEFAULT NULL,
  `publicationYear` char(4) DEFAULT NULL,
  `bookPrice` decimal(10,0) DEFAULT NULL,
  `registrationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nbOfBook` int(11) DEFAULT '1',
  PRIMARY KEY (`bookId`),
  KEY `categoryId` (`categoryId`,`authorId`),
  KEY `authorId` (`authorId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`bookId`, `bookName`, `categoryId`, `authorId`, `ISBN`, `publisherName`, `publicationYear`, `bookPrice`, `registrationDate`, `updationDate`, `nbOfBook`) VALUES
(5, 'Data Structure Using C', 2, 3, 1234, 'Thakur Publications Lucknow', '2015', '20', '2020-06-10 16:25:23', '2020-06-13 14:11:08', 0),
(6, 'Pride and Prejudice', 3, 4, 1432, 'Whitehall Egerton ', '1990', '7', '2020-06-10 16:30:38', '2020-06-13 14:18:16', 2),
(7, 'Computer Networks', 2, 5, 1122, 'Thakur Publications', '2016', '10', '2020-06-10 21:41:09', '2020-06-14 11:56:49', 14),
(8, 'Les Miserables', 5, 1, 1124, 'Albert Lacroix', '1862', '8', '2020-06-10 21:48:15', '2020-06-10 22:16:10', 9),
(9, 'Client Server Computing', 2, 3, 3324, ' Sun India Publications', '2012', '5', '2020-06-10 22:18:59', '2020-06-14 12:02:01', 0),
(10, 'NET Framework & C#', 2, 5, 5521, 'Sun India Publication', '2009', '6', '2020-06-14 12:00:19', '2020-06-14 12:01:35', 2);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `categoryId` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(150) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`categoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `categoryName`, `creationDate`, `updationDate`) VALUES
(2, 'Computer Science', '2020-06-10 16:22:11', '2020-06-10 16:22:11'),
(3, 'Romance', '2020-06-10 16:22:29', '2020-06-10 16:22:29'),
(4, 'Food', '2020-06-10 21:39:43', '2020-06-10 21:39:43'),
(5, 'Art', '2020-06-10 21:43:43', '2020-06-10 21:43:43');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `reservationId` int(11) NOT NULL AUTO_INCREMENT,
  `bookId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `pickDate` date NOT NULL,
  `mustBeforeDate` date NOT NULL,
  `returnDate` date DEFAULT NULL,
  `returnStatus` int(1) DEFAULT '0',
  `pricePaid` decimal(10,0) NOT NULL DEFAULT '0',
  `remaining` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`reservationId`),
  KEY `bookId` (`bookId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservationId`, `bookId`, `userId`, `pickDate`, `mustBeforeDate`, `returnDate`, `returnStatus`, `pricePaid`, `remaining`) VALUES
(1, 6, 202000000, '2020-06-10', '2020-06-24', '2020-06-13', 1, '7', '11'),
(2, 5, 202000000, '2020-06-11', '2020-06-25', NULL, 0, '10', NULL),
(3, 5, 202000001, '2020-06-25', '2020-07-09', NULL, 0, '5', NULL),
(4, 5, 202000000, '2020-06-14', '2020-06-28', NULL, 0, '0', NULL),
(8, 9, 202000000, '2020-06-13', '2020-06-27', NULL, 0, '0', NULL),
(9, 9, 202000002, '2020-06-17', '2020-07-01', NULL, 0, '0', NULL),
(10, 9, 202000003, '2020-06-20', '2020-07-04', NULL, 0, '0', NULL),
(11, 7, 202000003, '2020-06-20', '2020-07-04', NULL, 0, '0', NULL),
(12, 10, 202000001, '2020-07-09', '2020-07-23', NULL, 0, '0', NULL),
(13, 9, 202000001, '2020-06-22', '2020-07-06', NULL, 0, '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(120) NOT NULL,
  `lastName` varchar(120) NOT NULL,
  `mobileNumber` char(11) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `registrationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=202000004 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `firstName`, `lastName`, `mobileNumber`, `email`, `password`, `status`, `registrationDate`, `updationDate`) VALUES
(202000000, 'Ibrahim', 'Fakhouri', '70000000', 'ibrahim@hotmail.com', '$2y$10$qRoY00V65/lFQqtGosbZoO2RJy4CGOiKoDSHcOKvHJNcqu6kz4e/y', 1, '2020-06-10 16:20:12', '2020-06-16 12:13:53'),
(202000001, 'Walid', 'Fakhouri', '81111111', 'walid@hotmail.com', '$2y$10$w0/9y4A1gZBGN.xdO87ym.DhJr4q8e616oL8yHzqIHLORPRomhR7u', 1, '2020-06-10 16:21:03', '2020-06-16 12:13:59'),
(202000002, 'user', 'user', '20000001', 'user@user.com', '$2y$10$mj/3qNMPQhlM/FoqGuOHt.8WyIyMQi2xn8Zl7Dj8PH4l194RN8V02', 0, '2020-06-14 11:51:46', '2020-06-14 12:26:09'),
(202000003, 'user2', 'user2', '25021500', 'user2@user2.com', '$2y$10$bBy0IInNmg2KPbWYInrkTOWnR3LvfjNarxK7PRn5fUW2FYvjPQx9O', 1, '2020-06-14 11:55:18', '2020-06-14 11:55:18');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`authorId`) REFERENCES `author` (`authorId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
