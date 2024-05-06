-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 06, 2024 at 07:20 PM
-- Server version: 10.11.7-MariaDB-2ubuntu2
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `DEArmory`
--

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `Permission` varchar(16) NOT NULL,
  `UID` varchar(8) NOT NULL,
  `Account` varchar(25) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` longtext NOT NULL,
  `RealName` varchar(50) NOT NULL,
  `Birthday` varchar(10) NOT NULL,
  `PhoneNumber` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`Permission`, `UID`, `Account`, `Email`, `Password`, `RealName`, `Birthday`, `PhoneNumber`) VALUES
('ADMIN', '0', 'Admin', 'Administrator@email.com', '$2y$10$QNc562a.n0ygNewThWsacOQO9PNqtIwFtCfoyst8MirYYcfNkh7m6', 'Administrator', '0000-00-00', '0912345678'),
('USER', '5c18ac71', 'user0', 'user0@gmail.com', '$2y$10$hbtNkre6sINL2lTXZ86G8eADO2jkbB1x.jo1VHWOsT.rO52rAkIyG', 'user0', '2004-01-01', '0912345678'),
('USER', 'a51de8b3', 'markonbizz', 'markonbizz@gmail.com', '$2y$10$rk5NMOqjX59Q7.OCQAr1R.n2DdCkllQYt9/2YpLa99C9NNFmPTcwW', 'Marcus Heish', '2004-01-30', '0911069051');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UID`),
  ADD UNIQUE KEY `UID` (`UID`),
  ADD UNIQUE KEY `Password` (`Password`) USING HASH;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
