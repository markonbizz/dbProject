-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 30, 2024 at 07:33 PM
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
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `Account` text NOT NULL,
  `RealName` text NOT NULL,
  `Email` text NOT NULL,
  `Birthday` text NOT NULL,
  `PhoneNumber` text NOT NULL,
  `Password` text NOT NULL,
  `Permission` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`Account`, `RealName`, `Email`, `Birthday`, `PhoneNumber`, `Password`, `Permission`) VALUES
('admin', 'Administrator', 'Administrator@email.com', '0000-00-00', '0912345678', '$2y$10$BAjqe/VnBFt0L6P/JsOLFueDf/yFA0TFRtSR2tMpuSVCFhPHxB8Y2', 'ADMIN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD UNIQUE KEY `Permission` (`Permission`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
