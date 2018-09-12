-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 01, 2016 at 12:44 AM
-- Server version: 5.7.13-0ubuntu0.16.04.2
-- PHP Version: 7.0.8-0ubuntu0.16.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `larngearregister`
--

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE `counter` (
  `id` int(11) NOT NULL,
  `type` char(1) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL DEFAULT 'XXX',
  `prefix` enum('master','miss','mr','mrs') NOT NULL,
  `name` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `nickname` varchar(30) NOT NULL,
  `personalID` char(13) NOT NULL,
  `address` varchar(200) NOT NULL,
  `postcode` char(5) NOT NULL,
  `province` varchar(30) NOT NULL,
  `phone` char(10) NOT NULL,
  `blood` enum('A','B','O','AB','N') NOT NULL,
  `schoolYear` enum('4','5') NOT NULL,
  `school` varchar(50) NOT NULL,
  `schoolProvince` varchar(30) NOT NULL,
  `facebook` varchar(40) DEFAULT NULL,
  `line` varchar(40) DEFAULT NULL,
  `parentName` varchar(50) NOT NULL,
  `parentPhone` char(10) NOT NULL,
  `parentRelation` varchar(20) NOT NULL,
  `knowFrom` varchar(10) NOT NULL DEFAULT '-',
  `allergic` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `counter`
--
ALTER TABLE `counter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `counter`
--
ALTER TABLE `counter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

INSERT INTO `counter` VALUES (1, 'A', 0);
INSERT INTO `counter` VALUES (2, 'B', 0);
INSERT INTO `counter` VALUES (3, 'C', 0);
INSERT INTO `counter` VALUES (4, 'D', 0);
