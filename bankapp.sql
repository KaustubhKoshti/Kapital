-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2024 at 10:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bankapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountbalance`
--

CREATE TABLE `accountbalance` (
  `UserID` int(11) DEFAULT NULL,
  `CurrentBalance` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accountbalance`
--

INSERT INTO `accountbalance` (`UserID`, `CurrentBalance`) VALUES
(1, 0.00),
(2, 91.00),
(3, 80.00),
(4, 80.00),
(5, 90.00);

-- --------------------------------------------------------

--
-- Table structure for table `fixeddeposits`
--

CREATE TABLE `fixeddeposits` (
  `FDID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `FDAmount` decimal(10,2) NOT NULL,
  `InterestRate` decimal(5,2) NOT NULL,
  `Term` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fixeddeposits`
--

INSERT INTO `fixeddeposits` (`FDID`, `UserID`, `FDAmount`, `InterestRate`, `Term`) VALUES
(2, 4, 1000000.00, 10.00, 20);

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `LoanID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `LoanAmount` decimal(10,2) NOT NULL,
  `InterestRate` decimal(5,2) NOT NULL,
  `Term` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`LoanID`, `UserID`, `LoanAmount`, `InterestRate`, `Term`) VALUES
(3, 4, 100000.00, 10.00, 20),
(18, 5, 100000.00, 12.00, 24);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Email`, `Password`) VALUES
(1, 'Kakos', 'kaustubhkoshti50@gmail.com', '$2y$10$ZJ6lM03WNHQpoOgqGsWvHODe0q4RzHaK8oG4O5XE5SHN7hcHKRcxq'),
(2, 'siddhant', 'siddhantmanze@gmail.com', '$2y$10$nj5bc8Bv/jlf700v/dRI1uWkd/mXloPlKpKbe55bMxccdxaJO9rZ2'),
(3, 'xzvx', 'hiteshgaware9@gmail.com', '$2y$10$Z1Li8V80I4uhKUIqNVhB6u3f9vNyPZkvMiJTVXxmRy3aHh4VyYTW6'),
(4, 'kaustubh', 'kaustubhkoshti@gmail.com', '$2y$10$qukLl1nGJBPRE7EoqbPh1eR0JcZGL.sImOmM4QqMUsS7.gHNTNoM.'),
(5, 'SOUMITRA', 'soumi@gmail.com', '$2y$10$/2YlVfP0riDd3sVkxCdLP.FwYpHFO9AsTqD9lD.0Xlgb2IrGDTj.S');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountbalance`
--
ALTER TABLE `accountbalance`
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `fixeddeposits`
--
ALTER TABLE `fixeddeposits`
  ADD PRIMARY KEY (`FDID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`LoanID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fixeddeposits`
--
ALTER TABLE `fixeddeposits`
  MODIFY `FDID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `LoanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accountbalance`
--
ALTER TABLE `accountbalance`
  ADD CONSTRAINT `accountbalance_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `fixeddeposits`
--
ALTER TABLE `fixeddeposits`
  ADD CONSTRAINT `fixeddeposits_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
