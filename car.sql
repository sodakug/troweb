-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 29, 2013 at 04:31 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `car`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `idcus` int(4) NOT NULL,
  `fname` varchar(40) NOT NULL,
  `lname` varchar(40) NOT NULL,
  `numcard` int(4) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `add` varchar(70) NOT NULL,
  PRIMARY KEY (`idcus`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`idcus`, `fname`, `lname`, `numcard`, `tel`, `email`, `add`) VALUES
(1001, 'Criteano', 'Ronaldo', 1001, '091717223', 'porpor_guitar@hotmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `datacar`
--

CREATE TABLE IF NOT EXISTS `datacar` (
  `idcar` int(11) NOT NULL,
  `idcus` int(4) NOT NULL,
  `numcar` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cag` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `brand` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nummec` int(11) NOT NULL,
  `numgas` int(11) NOT NULL,
  PRIMARY KEY (`idcar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `datacar`
--

INSERT INTO `datacar` (`idcar`, `idcus`, `numcar`, `cag`, `brand`, `color`, `nummec`, `numgas`) VALUES
(1111, 1111, 'ถต 5658', 'ที่นั่งส่วน', 'toyota', 'ดำ', 6867, 879);
