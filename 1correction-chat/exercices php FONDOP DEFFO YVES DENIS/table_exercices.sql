-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2016 at 10:47 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_exercices`
--

CREATE TABLE `table_exercices` (
  `id` int(11) NOT NULL,
  `Auteur` varchar(255) NOT NULL,
  `commentaire` varchar(255) NOT NULL,
  `date_commentaire` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_exercices`
--

INSERT INTO `table_exercices` (`id`, `Auteur`, `commentaire`, `date_commentaire`) VALUES
(1, 'efef', 'ewfwe', '2016-09-18 22:07:05'),
(2, 'efef', 'ewfwe', '2016-09-18 22:07:05'),
(3, 'dwqd', 'qdq', '2016-09-18 22:09:00'),
(4, 'fiwoefhoiwehfw', 'wfpefhifhephfpàwef', '2016-09-18 22:09:08'),
(5, '3f3f34f', 'rff44v45v', '2016-09-18 22:10:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_exercices`
--
ALTER TABLE `table_exercices`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_exercices`
--
ALTER TABLE `table_exercices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
