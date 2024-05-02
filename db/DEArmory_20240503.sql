-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 02, 2024 at 07:52 PM
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
  `UID` varchar(8) NOT NULL,
  `Account` varchar(25) NOT NULL,
  `RealName` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Birthday` varchar(10) NOT NULL,
  `PhoneNumber` varchar(10) NOT NULL,
  `Password` longtext NOT NULL,
  `Permission` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UID`, `Account`, `RealName`, `Email`, `Birthday`, `PhoneNumber`, `Password`, `Permission`) VALUES
('0', 'admin', 'Administrator', 'Administrator@email.com', '0000-00-00', '0912345678', '$2y$10$L84NnQ1YD95/dx20K0VEAuNGNicYHV1jhP/YszgBqqu3/YJpxj9w.', 'ADMIN'),
('5c18ac71', 'user0', 'mark', 'user0@gmail.com', '2004-01-01', '0912345678', '$2y$10$YP2cTEYGETZHJXpWOMXCNe/ceL6SeQJrWIxpjOkeeUKyEH6siB4AK', 'USER');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD UNIQUE KEY `Permission` (`Permission`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
