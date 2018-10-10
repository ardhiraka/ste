-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 10, 2018 at 09:55 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_io`
--

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nohp` varchar(14) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kodeid` varchar(4) NOT NULL,
  `deposit` varchar(100) DEFAULT '0',
  `downline` varchar(10) DEFAULT '2',
  `2d_win` varchar(4) DEFAULT '0',
  `3d_win` varchar(4) DEFAULT '0',
  `4d_win` varchar(4) DEFAULT '0',
  `2d_disc` varchar(4) DEFAULT '0',
  `3d_disc` varchar(4) DEFAULT '0',
  `4d_disc` varchar(4) DEFAULT '0',
  `C_win` varchar(4) DEFAULT '0',
  `C_disc` varchar(4) DEFAULT '0',
  `Jitu_win` varchar(4) DEFAULT '0',
  `Jitu_disc` varchar(4) DEFAULT '0',
  `CM1_win` varchar(4) DEFAULT '0',
  `CM2_win` varchar(4) DEFAULT '0',
  `CM3_win` varchar(4) DEFAULT '0',
  `CM_disc` varchar(4) DEFAULT '0',
  `CN_win` varchar(4) DEFAULT '0',
  `CN_disc` varchar(4) DEFAULT '0',
  `J_win` varchar(4) DEFAULT '0',
  `J_disc` varchar(4) DEFAULT '0',
  `P_win` varchar(4) DEFAULT '0',
  `P_disc` varchar(4) DEFAULT '0',
  `T_win` varchar(4) DEFAULT '0',
  `T_disc` varchar(4) DEFAULT '0',
  `S_win` varchar(4) DEFAULT '0',
  `S_disc` varchar(4) DEFAULT '0',
  `M_win` varchar(4) DEFAULT '0',
  `M_disc` varchar(4) DEFAULT '0',
  `H_win` varchar(4) DEFAULT '0',
  `H_disc` varchar(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `nohp`, `nama`, `kodeid`, `deposit`, `downline`, `2d_win`, `3d_win`, `4d_win`, `2d_disc`, `3d_disc`, `4d_disc`, `C_win`, `C_disc`, `Jitu_win`, `Jitu_disc`, `CM1_win`, `CM2_win`, `CM3_win`, `CM_disc`, `CN_win`, `CN_disc`, `J_win`, `J_disc`, `P_win`, `P_disc`, `T_win`, `T_disc`, `S_win`, `S_disc`, `M_win`, `M_disc`, `H_win`, `H_disc`) VALUES
(2, '089668615914', 'raka', 'AR_1', '250000000', '', '70', '400', '3000', '30', '60', '60', '1.4', '14', '7', '14', '6', '9', '12', '14', '25', '14', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5'),
(3, '089647793930', 'aris', 'MA_1', '350000000', '', '50', '200', '1000', '10', '40', '40', '1', '10', '7', '14', '6', '9', '12', '14', '25', '14', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5'),
(4, '+6282245244819', 'unknown', 'UK', '350000000', '', '50', '200', '1000', '10', '40', '40', '1', '10', '7', '14', '6', '9', '12', '14', '25', '14', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5'),
(5, '+6285236237757', 'silhoute', 'SH', '250000000', '', '70', '400', '3000', '30', '60', '60', '1.4', '14', '7', '14', '6', '9', '12', '14', '25', '14', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5'),
(6, '123456789', 'Tello', 'TL', '1000000', '2', '20', '20', '20', '20', '20', '20', '20', '20', '20', '20', '20', '20', '20', '20', '20', '20', '20', '20', '20', '20', '20', '20', '20', '20', '20', '20', '20', '20');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
