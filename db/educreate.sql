-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2019 at 04:26 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `educreate`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

CREATE TABLE `applicant` (
  `Username` varchar(45) NOT NULL,
  `IDType` varchar(45) DEFAULT NULL,
  `IDNumber` varchar(50) DEFAULT NULL,
  `MobileNo` varchar(45) DEFAULT NULL,
  `DateOfBirth` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applicant`
--

INSERT INTO `applicant` (`Username`, `IDType`, `IDNumber`, `MobileNo`, `DateOfBirth`) VALUES
('eva_00', 'MYKAD', 'EVA-00', 'aflac', ''),
('muqrizabdul', 'MYKAD', '1132239', '0176755047', '22/7/2019');

-- --------------------------------------------------------

--
-- Table structure for table `gradelist`
--

CREATE TABLE `gradelist` (
  `qualificationID` int(11) NOT NULL,
  `grade` varchar(4) NOT NULL,
  `scoreUpperLimit` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gradelist`
--

INSERT INTO `gradelist` (`qualificationID`, `grade`, `scoreUpperLimit`) VALUES
(1, 'A', 100),
(1, 'B', 90),
(1, 'C', 80),
(4, 'A', 100),
(4, 'B', 90),
(4, 'C', 80);

-- --------------------------------------------------------

--
-- Table structure for table `qualification`
--

CREATE TABLE `qualification` (
  `qualificationID` int(11) NOT NULL,
  `qualificationName` varchar(255) NOT NULL,
  `minimumScore` int(6) NOT NULL,
  `maximumScore` int(6) NOT NULL,
  `resultCalcDescription` varchar(45) NOT NULL,
  `resultCalcSubjectCount` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qualification`
--

INSERT INTO `qualification` (`qualificationID`, `qualificationName`, `minimumScore`, `maximumScore`, `resultCalcDescription`, `resultCalcSubjectCount`) VALUES
(1, 'Q1_edit', 1, 100, 'sum_highest', 3),
(2, 'Q2_edit', 5, 500, 'avg_lowest', 6),
(3, 'Q4', 0, 4, 'avg_highest', 3),
(4, 'QEdited_w_Grade', 0, 100, 'sum_highest', 5);

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE `university` (
  `UniversityID` int(11) NOT NULL,
  `UniversityName` varchar(255) DEFAULT NULL,
  `UniversityAdmin` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`UniversityID`, `UniversityName`, `UniversityAdmin`) VALUES
(1, 'Uni_One', 'chuck_testa'),
(4, 'Unicorn', 'Coach');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Username` varchar(45) NOT NULL,
  `Password` varchar(45) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Username`, `Password`, `Name`, `Email`) VALUES
('chuck_testa', '12345', 'Chuck Testa', 'chuckt@mailord.com'),
('Coach', 'cdad629083ddd1b30164fc1f8de0c340', 'Coacher', 'coach@mailord.com'),
('eva_00', 'cdad629083ddd1b30164fc1f8de0c340', 'Ayanami Rei', 'eva00@mecha.com'),
('muqrizabdul', '4297f44b13955235245b2497399d7a93', 'Muhamad Muqriz', 'muqrizx@gmail.com'),
('person_01', '46ea0d5b246d2841744c26f72a86fc29', 'Person One', 'p1@mail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicant`
--
ALTER TABLE `applicant`
  ADD PRIMARY KEY (`Username`),
  ADD KEY `Username` (`Username`);

--
-- Indexes for table `gradelist`
--
ALTER TABLE `gradelist`
  ADD PRIMARY KEY (`qualificationID`,`grade`),
  ADD KEY `qualificationID` (`qualificationID`);

--
-- Indexes for table `qualification`
--
ALTER TABLE `qualification`
  ADD PRIMARY KEY (`qualificationID`);

--
-- Indexes for table `university`
--
ALTER TABLE `university`
  ADD PRIMARY KEY (`UniversityID`),
  ADD KEY `UniversityAdmin` (`UniversityAdmin`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `qualification`
--
ALTER TABLE `qualification`
  MODIFY `qualificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `university`
--
ALTER TABLE `university`
  MODIFY `UniversityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
