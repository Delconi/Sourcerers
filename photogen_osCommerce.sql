-- phpMyAdmin SQL Dump
-- version 3.4.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 31, 2013 at 07:53 PM
-- Server version: 5.5.23
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `photogen_osCommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `ProductInfo`
--

CREATE TABLE IF NOT EXISTS `ProductInfo` (
  `pNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Product Serial No',
  `pUserNo` int(11) DEFAULT NULL,
  `pName` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Product Name',
  `pDesc` text COLLATE utf8_unicode_ci COMMENT 'Product Descrpition',
  `pUrl` text COLLATE utf8_unicode_ci COMMENT 'Product Website',
  `pStock` int(11) NOT NULL COMMENT 'Product Quantity',
  PRIMARY KEY (`pNo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `ProductInfo`
--

INSERT INTO `ProductInfo` (`pNo`, `pUserNo`, `pName`, `pDesc`, `pUrl`, `pStock`) VALUES
(1, NULL, 'Portable Charger 2600ma', 'Just a random portable charger', 'Nil', 0),
(2, NULL, 'PS3 Controller', 'Just a controller', 'www.sony.com', 20),
(3, NULL, 'Screwdriver', 'Just some screw', 'screw.com', 35),
(4, NULL, 'TestingQuantity Check', 'Testing if it''s updating Quantity', '', 7),
(5, 12, 'Controller 1', 'PS3 Controller', 'www.sony.com', 8),
(6, 12, 'TestSame', 'Test Same Function', 'Wooohooo', 99),
(8, 17, 'PS3', 'Console', 'www.sony.com', 9),
(9, 19, 'test', 'test1', '', 15),
(18, 19, 'donkey kong', 'game', '', 23),
(17, 33, 'Delconi', 'Testing', '', -10),
(13, 20, 'Test', 'TestNil', 'www', 4);

-- --------------------------------------------------------

--
-- Table structure for table `ProductOrder`
--

CREATE TABLE IF NOT EXISTS `ProductOrder` (
  `oNo` int(11) NOT NULL AUTO_INCREMENT,
  `pUserNo` int(11) DEFAULT NULL,
  `oDateInput` date NOT NULL,
  `oDate` date NOT NULL,
  `oName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oCostumer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oPrice` int(11) NOT NULL,
  `oQuantity` int(11) NOT NULL,
  `oMiscCost` int(11) NOT NULL,
  `oTotalCost` int(11) NOT NULL,
  `oRemarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`oNo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `ProductOrder`
--

INSERT INTO `ProductOrder` (`oNo`, `pUserNo`, `oDateInput`, `oDate`, `oName`, `oCostumer`, `oPrice`, `oQuantity`, `oMiscCost`, `oTotalCost`, `oRemarks`) VALUES
(1, NULL, '2013-05-29', '2007-08-12', '3', 'TestEdit2', 10, 10, 0, 100, 'Testing'),
(3, NULL, '2013-05-29', '2007-08-12', '2', 'TestEdit2', 10, 10, 0, 100, 'Testing'),
(7, NULL, '2013-05-29', '2007-08-12', '4', 'TestEdit2', 10, 10, 0, 100, 'Testing'),
(8, 12, '2013-05-29', '2007-08-12', '5', 'TestEdit2', 10, 10, 0, 100, 'Testing'),
(9, 17, '2013-05-29', '2007-08-12', '8', 'TestEdit2', 10, 10, 0, 100, 'Testing'),
(24, 33, '2013-05-31', '2013-01-01', '17', 'Delconi Again', 10, 10, 2, 102, ''),
(23, 20, '2013-05-30', '2013-01-01', '13', 'Jordon', 5, 2, 2, 12, '');

-- --------------------------------------------------------

--
-- Table structure for table `ProductPurchase`
--

CREATE TABLE IF NOT EXISTS `ProductPurchase` (
  `pPno` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Product Purchase Serial Number',
  `pPUserNo` int(11) DEFAULT NULL,
  `pNameNo` int(11) NOT NULL COMMENT 'Product Name (Link to ProductInfo)',
  `pManufacturer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pDateInput` date NOT NULL COMMENT 'Data Date Input',
  `pPurchaseDate` date NOT NULL COMMENT 'Date transition Occur',
  `pQuantity` int(11) NOT NULL,
  `pPrice` int(11) NOT NULL,
  `pShipping` int(11) NOT NULL,
  `pTotalPurchase` int(11) NOT NULL,
  `pSalesPrice` int(11) NOT NULL,
  `pRemarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pTax` int(11) DEFAULT NULL,
  PRIMARY KEY (`pPno`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `ProductPurchase`
--

INSERT INTO `ProductPurchase` (`pPno`, `pPUserNo`, `pNameNo`, `pManufacturer`, `pDateInput`, `pPurchaseDate`, `pQuantity`, `pPrice`, `pShipping`, `pTotalPurchase`, `pSalesPrice`, `pRemarks`, `pTax`) VALUES
(1, NULL, 2, '', '2013-05-21', '2013-05-14', 10, 39, 0, 390, 44, 'Not bad', NULL),
(3, NULL, 1, '', '2013-05-21', '1980-01-01', 13, 3, 2, 41, 15, 'Testing', 0),
(4, NULL, 3, 'Delconi 23', '2013-05-21', '2013-05-21', 5, 3, 0, 15, 15, 'Replenish', 0),
(5, NULL, 4, 'Lets See', '2013-05-21', '1980-01-01', 10, 99, 5, 1025, 999, 'Check', 3),
(6, NULL, 2, 'Sony', '2013-05-21', '2007-07-08', 12, 13, 5, 166, 55, 'I love controllers', 3),
(7, 12, 5, 'Delconi', '2013-05-23', '2013-05-18', 10, 29, 4, 294, 50, 'Selling as Standard Price', 0),
(8, 17, 8, 'Sony', '2013-05-26', '2013-05-26', 10, 150, 20, 1535, 250, '', 1),
(9, 19, 9, '', '2013-05-27', '2013-01-01', 5, 10, 1, 55, 15, '', 7),
(10, 20, 13, 'Tester', '2013-05-28', '2013-01-01', 4, 2, 3, 11, 10, 'TestNiller', 0),
(11, 20, 13, 'Tester', '2013-05-28', '2013-01-01', 2, 2, 3, 7, 10, 'TestNiller', 0),
(18, 19, 18, 'manulife', '2013-05-31', '2013-01-01', 23, 1, 13, 37, 30, 'it works well.', 7);

-- --------------------------------------------------------

--
-- Table structure for table `UserInfo`
--

CREATE TABLE IF NOT EXISTS `UserInfo` (
  `uNo` int(11) NOT NULL AUTO_INCREMENT,
  `uName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uPass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`uNo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Dumping data for table `UserInfo`
--

INSERT INTO `UserInfo` (`uNo`, `uName`, `uPass`) VALUES
(18, 'Habbo', 'e10adc3949ba59abbe56e057f20f883e'),
(6, 'guest2', '0ed6890e4012b1e9ea5485a6c891cf1f'),
(17, 'delconi', 'e10adc3949ba59abbe56e057f20f883e'),
(13, 'teosy', '2d0ee1e3876fd649932e21f6f27f0c6e'),
(12, 'test', '098f6bcd4621d373cade4e832627b4f6'),
(19, 'testing123', '7f2ababa423061c509f4923dd04b6cf1'),
(20, 'jordon', '5f4dcc3b5aa765d61d8327deb882cf99'),
(33, 'Spectralizer', '12d6743e52209f3c7e3fd422d76b71cb'),
(34, 'Testing1234', '25d55ad283aa400af464c76d713c07ad');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
