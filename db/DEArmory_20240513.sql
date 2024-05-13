-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 12, 2024 at 06:07 PM
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
-- Table structure for table `Cart`
--

CREATE TABLE `Cart` (
  `CustomerID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Categories`
--

CREATE TABLE `Categories` (
  `CategoryID` int(32) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Categories`
--

INSERT INTO `Categories` (`CategoryID`, `Name`) VALUES
(1, 'Physical Damage'),
(2, 'Magical Damage'),
(3, 'Melee'),
(4, 'No DMG'),
(5, 'Nope'),
(6, 'Healing'),
(7, 'cockroach'),
(8, 'sus');

-- --------------------------------------------------------

--
-- Table structure for table `Order_Basics`
--

CREATE TABLE `Order_Basics` (
  `OrderID` int(32) NOT NULL,
  `ProductID` int(32) NOT NULL,
  `CustomerID` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Order_Details`
--

CREATE TABLE `Order_Details` (
  `OrderID` int(8) NOT NULL,
  `Date` datetime NOT NULL,
  `DeliverAddress` varchar(50) NOT NULL,
  `PayAmount` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE `Products` (
  `ProductID` int(32) NOT NULL,
  `CategoryID` int(32) NOT NULL,
  `UploaderID` varchar(64) NOT NULL,
  `Image` longblob NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Price` int(16) NOT NULL,
  `Description` text NOT NULL DEFAULT 'This dumbass didn\'t write anything',
  `UploadDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`ProductID`, `CategoryID`, `UploaderID`, `Image`, `Name`, `Price`, `Description`, `UploadDate`) VALUES
INSERT INTO `Products` (`ProductID`, `CategoryID`, `UploaderID`, `Image`, `Name`, `Price`, `Description`, `UploadDate`) VALUES
INSERT INTO `Products` (`ProductID`, `CategoryID`, `UploaderID`, `Image`, `Name`, `Price`, `Description`, `UploadDate`) VALUES

-- --------------------------------------------------------

--
-- Table structure for table `User_Basics`
--

CREATE TABLE `User_Basics` (
  `UserID` varchar(64) NOT NULL,
  `Account` varchar(24) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `TotalBalance` int(16) NOT NULL DEFAULT 10000,
  `TotalSpent` int(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `User_Basics`
--

INSERT INTO `User_Basics` (`UserID`, `Account`, `Email`, `TotalBalance`, `TotalSpent`) VALUES
('8a87b4db-0e25-11ef-abb7-0242ac110002', 'root', 'root@localhost', 10000, 0),
('a25250ac-22bf-4ff7-8fed-09ae68abe815', 'user0', 'user0@gmail.com', 20000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `User_Privacy`
--

CREATE TABLE `User_Privacy` (
  `UserID` varchar(64) NOT NULL,
  `RealName` varchar(24) NOT NULL,
  `Birthday` date NOT NULL,
  `PhoneNumber` varchar(10) NOT NULL,
  `Address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `User_Privacy`
--

INSERT INTO `User_Privacy` (`UserID`, `RealName`, `Birthday`, `PhoneNumber`, `Address`) VALUES
('8a87b4db-0e25-11ef-abb7-0242ac110002', 'Root', '9999-01-01', '0912345678', 'localhost'),
('a25250ac-22bf-4ff7-8fed-09ae68abe815', 'user0', '2004-01-01', '0911111111', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `User_Security`
--

CREATE TABLE `User_Security` (
  `UserID` varchar(64) NOT NULL,
  `Permission` varchar(10) NOT NULL,
  `Password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `User_Security`
--

INSERT INTO `User_Security` (`UserID`, `Permission`, `Password`) VALUES
('8a87b4db-0e25-11ef-abb7-0242ac110002', 'ADMIN', '$2y$10$Z6C7AoO977AinzslvuO5e.BIYLTxMz6xuqJt4IDnW8vra.oXdNR1K'),
('a25250ac-22bf-4ff7-8fed-09ae68abe815', 'USER', '$2y$10$z4t9aRebSe/CnAzudyD3zekZLGrqNvqiRWt9JdZuci4hl2zwd.l1a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `Order_Basics`
--
ALTER TABLE `Order_Basics`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `Order_Details`
--
ALTER TABLE `Order_Details`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `User_Basics`
--
ALTER TABLE `User_Basics`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `User_Privacy`
--
ALTER TABLE `User_Privacy`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `User_Security`
--
ALTER TABLE `User_Security`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Categories`
--
ALTER TABLE `Categories`
  MODIFY `CategoryID` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Order_Basics`
--
ALTER TABLE `Order_Basics`
  MODIFY `OrderID` int(32) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Order_Details`
--
ALTER TABLE `Order_Details`
  MODIFY `OrderID` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Products`
--
ALTER TABLE `Products`
  MODIFY `ProductID` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;