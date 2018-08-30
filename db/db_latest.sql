-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 30, 2018 at 05:34 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `io_ste`
--

-- --------------------------------------------------------

--
-- Table structure for table `angkakeluar`
--

DROP TABLE IF EXISTS `angkakeluar`;
CREATE TABLE IF NOT EXISTS `angkakeluar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `angka` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `angkakeluar`
--

INSERT INTO `angkakeluar` (`id`, `angka`, `tanggal`) VALUES
(1, '4582', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `daemons`
--

DROP TABLE IF EXISTS `daemons`;
CREATE TABLE IF NOT EXISTS `daemons` (
  `Start` text NOT NULL,
  `Info` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gammu`
--

DROP TABLE IF EXISTS `gammu`;
CREATE TABLE IF NOT EXISTS `gammu` (
  `Version` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gammu`
--

INSERT INTO `gammu` (`Version`) VALUES
(13);

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

DROP TABLE IF EXISTS `inbox`;
CREATE TABLE IF NOT EXISTS `inbox` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ReceivingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Text` text NOT NULL,
  `SenderNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL DEFAULT '',
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `RecipientID` text NOT NULL,
  `Processed` enum('false','true') NOT NULL DEFAULT 'false',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`UpdatedInDB`, `ReceivingDateTime`, `Text`, `SenderNumber`, `Coding`, `UDH`, `SMSCNumber`, `Class`, `TextDecoded`, `ID`, `RecipientID`, `Processed`) VALUES
('2018-08-30 07:56:48', '2018-08-30 14:56:48', '', '089668615914', 'Default_No_Compression', 'raka', '', -1, 'M.TSST@100', 28, '', 'false'),
('2018-08-28 07:40:55', '2018-08-28 14:40:55', '', '089668615914', 'Default_No_Compression', 'raka', '', -1, '45@10', 27, '', 'false'),
('2018-08-27 13:29:46', '2018-08-27 20:25:43', '', '089668615914', 'Default_No_Compression', 'raka', '', -1, '12.23.345.234.4567.45.458@100', 26, '', 'false'),
('2018-08-26 11:12:29', '2018-08-26 18:12:29', '', '089647793930', 'Default_No_Compression', 'aris', '', -1, 'J@100', 25, '', 'false'),
('2018-08-25 10:15:32', '2018-08-25 17:15:32', '', '089668615914', 'Default_No_Compression', 'raka', '', -1, 'C;8.9.0@100 T@100 J@100 CM;45.43.84.81@100 CN;458.451.452@100 C.AS;5.4.3@100 C.KP;5.4.3@100', 22, '', 'false'),
('2018-08-25 10:23:24', '2018-08-25 17:23:24', '', '089647793930', 'Default_No_Compression', 'Aris', '', -1, 'C;8.9.0@100', 23, '', 'false'),
('2018-08-26 06:35:55', '2018-08-26 13:35:55', '', '089647793930', 'Default_No_Compression', 'aris', '', -1, 'T@100', 24, '', 'false');

--
-- Triggers `inbox`
--
DROP TRIGGER IF EXISTS `inbox_timestamp`;
DELIMITER $$
CREATE TRIGGER `inbox_timestamp` BEFORE INSERT ON `inbox` FOR EACH ROW BEGIN
    IF NEW.ReceivingDateTime = '0000-00-00 00:00:00' THEN
        SET NEW.ReceivingDateTime = CURRENT_TIMESTAMP();
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nohp` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kodeid` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `deposit` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `downline` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `2d_win` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `3d_win` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `4d_win` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `2d_disc` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `3d_disc` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `4d_disc` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `C_win` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `C_disc` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `Jitu_win` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `Jitu_disc` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `CM1_win` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `CM2_win` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `CM3_win` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `CM_disc` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `CN_win` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `CN_disc` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `J_win` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `J_disc` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `P_win` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `P_disc` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `T_win` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `T_disc` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `S_win` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `S_disc` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `M_win` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `M_disc` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `H_win` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `H_disc` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `nohp`, `nama`, `kodeid`, `deposit`, `downline`, `2d_win`, `3d_win`, `4d_win`, `2d_disc`, `3d_disc`, `4d_disc`, `C_win`, `C_disc`, `Jitu_win`, `Jitu_disc`, `CM1_win`, `CM2_win`, `CM3_win`, `CM_disc`, `CN_win`, `CN_disc`, `J_win`, `J_disc`, `P_win`, `P_disc`, `T_win`, `T_disc`, `S_win`, `S_disc`, `M_win`, `M_disc`, `H_win`, `H_disc`) VALUES
(2, '089668615914', 'raka', 'AR_1', '250000000', '', '70', '400', '3000', '30', '60', '60', '1.4', '14', '7', '14', '6', '9', '12', '14', '25', '14', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5'),
(3, '089647793930', 'aris', 'MA_1', '350000000', '', '50', '200', '1000', '10', '40', '40', '1', '10', '7', '14', '6', '9', '12', '14', '25', '14', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5');

-- --------------------------------------------------------

--
-- Table structure for table `outbox`
--

DROP TABLE IF EXISTS `outbox`;
CREATE TABLE IF NOT EXISTS `outbox` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendBefore` time NOT NULL DEFAULT '23:59:59',
  `SendAfter` time NOT NULL DEFAULT '00:00:00',
  `Text` text,
  `DestinationNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text,
  `Class` int(11) DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `MultiPart` enum('false','true') DEFAULT 'false',
  `RelativeValidity` int(11) DEFAULT '-1',
  `SenderID` varchar(255) DEFAULT NULL,
  `SendingTimeOut` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `DeliveryReport` enum('default','yes','no') DEFAULT 'default',
  `CreatorID` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `outbox_date` (`SendingDateTime`,`SendingTimeOut`),
  KEY `outbox_sender` (`SenderID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Triggers `outbox`
--
DROP TRIGGER IF EXISTS `outbox_timestamp`;
DELIMITER $$
CREATE TRIGGER `outbox_timestamp` BEFORE INSERT ON `outbox` FOR EACH ROW BEGIN
    IF NEW.InsertIntoDB = '0000-00-00 00:00:00' THEN
        SET NEW.InsertIntoDB = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.SendingDateTime = '0000-00-00 00:00:00' THEN
        SET NEW.SendingDateTime = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.SendingTimeOut = '0000-00-00 00:00:00' THEN
        SET NEW.SendingTimeOut = CURRENT_TIMESTAMP();
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `outbox_multipart`
--

DROP TABLE IF EXISTS `outbox_multipart`;
CREATE TABLE IF NOT EXISTS `outbox_multipart` (
  `Text` text,
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text,
  `Class` int(11) DEFAULT '-1',
  `TextDecoded` text,
  `ID` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `SequencePosition` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`,`SequencePosition`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pbk`
--

DROP TABLE IF EXISTS `pbk`;
CREATE TABLE IF NOT EXISTS `pbk` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `GroupID` int(11) NOT NULL DEFAULT '-1',
  `Name` text NOT NULL,
  `Number` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pbk_groups`
--

DROP TABLE IF EXISTS `pbk_groups`;
CREATE TABLE IF NOT EXISTS `pbk_groups` (
  `Name` text NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `phones`
--

DROP TABLE IF EXISTS `phones`;
CREATE TABLE IF NOT EXISTS `phones` (
  `ID` text NOT NULL,
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TimeOut` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Send` enum('yes','no') NOT NULL DEFAULT 'no',
  `Receive` enum('yes','no') NOT NULL DEFAULT 'no',
  `IMEI` varchar(35) NOT NULL,
  `Client` text NOT NULL,
  `Battery` int(11) NOT NULL DEFAULT '-1',
  `Signal` int(11) NOT NULL DEFAULT '-1',
  `Sent` int(11) NOT NULL DEFAULT '0',
  `Received` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IMEI`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Triggers `phones`
--
DROP TRIGGER IF EXISTS `phones_timestamp`;
DELIMITER $$
CREATE TRIGGER `phones_timestamp` BEFORE INSERT ON `phones` FOR EACH ROW BEGIN
    IF NEW.InsertIntoDB = '0000-00-00 00:00:00' THEN
        SET NEW.InsertIntoDB = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.TimeOut = '0000-00-00 00:00:00' THEN
        SET NEW.TimeOut = CURRENT_TIMESTAMP();
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sentitems`
--

DROP TABLE IF EXISTS `sentitems`;
CREATE TABLE IF NOT EXISTS `sentitems` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DeliveryDateTime` timestamp NULL DEFAULT NULL,
  `Text` text NOT NULL,
  `DestinationNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL DEFAULT '',
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `SenderID` varchar(255) NOT NULL,
  `SequencePosition` int(11) NOT NULL DEFAULT '1',
  `Status` enum('SendingOK','SendingOKNoReport','SendingError','DeliveryOK','DeliveryFailed','DeliveryPending','DeliveryUnknown','Error') NOT NULL DEFAULT 'SendingOK',
  `StatusError` int(11) NOT NULL DEFAULT '-1',
  `TPMR` int(11) NOT NULL DEFAULT '-1',
  `RelativeValidity` int(11) NOT NULL DEFAULT '-1',
  `CreatorID` text NOT NULL,
  PRIMARY KEY (`ID`,`SequencePosition`),
  KEY `sentitems_date` (`DeliveryDateTime`),
  KEY `sentitems_tpmr` (`TPMR`),
  KEY `sentitems_dest` (`DestinationNumber`),
  KEY `sentitems_sender` (`SenderID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Triggers `sentitems`
--
DROP TRIGGER IF EXISTS `sentitems_timestamp`;
DELIMITER $$
CREATE TRIGGER `sentitems_timestamp` BEFORE INSERT ON `sentitems` FOR EACH ROW BEGIN
    IF NEW.InsertIntoDB = '0000-00-00 00:00:00' THEN
        SET NEW.InsertIntoDB = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.SendingDateTime = '0000-00-00 00:00:00' THEN
        SET NEW.SendingDateTime = CURRENT_TIMESTAMP();
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `split`
--

DROP TABLE IF EXISTS `split`;
CREATE TABLE IF NOT EXISTS `split` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `kode` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `angka` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `nominal` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `inbox_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
