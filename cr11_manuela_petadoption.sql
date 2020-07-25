-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2020 at 02:25 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `animals`
--
CREATE DATABASE IF NOT EXISTS `animals` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `animals`;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `addressID` int(11) NOT NULL,
  `city` varchar(30) DEFAULT NULL,
  `zipcode` int(5) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`addressID`, `city`, `zipcode`, `street`) VALUES
(1, 'Graz', 8010, 'Elisabethstrasse 93'),
(2, 'Graz', 8010, 'Morellenfeldgasse 20'),
(3, 'Graz', 8010, 'Gartengasse 5'),
(4, 'Wien', 1030, 'Dietrichgasse 57'),
(5, 'Wien', 1030, 'Baumgasse 20'),
(6, 'Wien', 1170, 'Hernalser Hauptstrasse'),
(7, 'Wien', 1070, 'Schottenfeldgasse 62'),
(8, 'Klagenfurt', 9020, 'Ikea Platz 15'),
(9, 'Wien', 1010, 'Bognergasse 5'),
(10, 'Klagenfurt', 9020, 'Miessbergstrasse 21 ');

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `animalID` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `image` varchar(40) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `addressID` int(11) DEFAULT NULL,
  `type` enum('small','large') DEFAULT NULL,
  `hobbies` varchar(300) DEFAULT NULL,
  `age` tinyint(2) DEFAULT NULL,
  `status` enum('available','adopted') DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`animalID`, `name`, `image`, `description`, `addressID`, `type`, `hobbies`, `age`, `status`) VALUES
(1, 'blacky', 'blacky.jpg', 'He is such a smart guy: can open each bag to get to his food', 1, 'small', 'he likes tricky labyrinths ', 3, 'available'),
(2, 'frederik', 'frederik.jpg', 'a handsome peaceful companion: enjoys hanging around in the straw', 2, 'small', 'dancing to folk polka music', 4, 'adopted'),
(3, 'schnurrli', 'schnurrli.jpg', 'she is right now in the state of allowing a human to live with her', 3, 'small', 'playing with wool, Beethoven', 5, 'adopted'),
(4, 'Yvona', 'yvona.jpg', 'She will for sure colour up your life! be careful: she is repeating you!', 4, 'small', NULL, NULL, 'available'),
(5, 'Berta', 'berta.jpg', 'originally from the alps - is looking for a companion with wanderlust', 5, 'large', 'hiking and picknick', 11, 'available'),
(6, 'Roger', 'roger.jpg', 'authentic, sometimes selfish but always in mood for singing', 6, 'large', 'singing and cutting the lawn', NULL, 'available'),
(7, 'Alejandro', 'alejandro.jpg', 'He is an original - he is unbeatable at hiding in the straw ', 7, 'large', 'El camino de Santiago', 6, 'available'),
(8, 'Lars', 'lars.jpg', 'Unless the wind is disturbing his sight a very reliable companion to find your way back home!', 8, 'large', 'He enjoys having a nice rub massage and going to the hair studio.', 33, 'adopted'),
(9, 'Larissa', 'larissa.jpg', 'A soul of a dog - loves children, other animals and long walks', 9, '', 'Swimming and hiding carrots', 9, 'adopted'),
(10, 'Lucifer', 'lucifer.jpg', 'Black cat - and so much more. Be brave enough to find out', 9, '', 'decorating furniture and human beings', 13, 'available'),
(11, 'Cassiopaia', 'lucinde.jpg', 'She has taught Momo to master and appreciate time. Are you ready too?', 10, '', 'circle training with salad', 127, 'available'),
(20, 'Rocky', 'rocky.jpg', 'The dog who will make your life lot of more entertaining...', 6, 'small', 'Postmen and Hiking Shoes', 9, 'adopted'),
(21, 'Jeff', 'jeff.jpg', 'Jeff is a very sportive demanding fellow - needs lots of motion in the outside. He will keep you fit', 3, 'large', 'Running with human beings, apporting tennis balls', 7, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookingID` int(11) NOT NULL,
  `animalId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookingID`, `animalId`, `userId`) VALUES
(1, 2, 3),
(2, 9, 2),
(3, 8, 2),
(5, 20, 2),
(6, 20, 2),
(7, 20, 2),
(8, 20, 2),
(9, 20, 2),
(10, 20, 2),
(11, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `userEmail` varchar(60) NOT NULL,
  `foto` varchar(20) DEFAULT NULL,
  `userPass` varchar(255) NOT NULL,
  `status` enum('user','admin','superadmin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `foto`, `userPass`, `status`) VALUES
(1, 'waldo', 'waldo@web.de', 'monkey.jpg', 'a76546061fb1ed2a5fbc6f05df4e0ad6d5dbc2d7e52c6f1090cc709d0f55ada4', 'admin'),
(2, 'yanceen', 'yanceen@yahoo.com', 'elefant.jpg', 'a76546061fb1ed2a5fbc6f05df4e0ad6d5dbc2d7e52c6f1090cc709d0f55ada4', 'user'),
(3, 'esmeralda', 'esmeralda@web.de', 'pig.jpg', 'a76546061fb1ed2a5fbc6f05df4e0ad6d5dbc2d7e52c6f1090cc709d0f55ada4', 'user'),
(4, 'Tux', 'tux@web.de', 'penguin.jpg', 'a76546061fb1ed2a5fbc6f05df4e0ad6d5dbc2d7e52c6f1090cc709d0f55ada4', 'superadmin'),
(15, 'maslow', 'maslow@web.de', NULL, 'a76546061fb1ed2a5fbc6f05df4e0ad6d5dbc2d7e52c6f1090cc709d0f55ada4', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`addressID`);

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`animalID`),
  ADD KEY `addressID` (`addressID`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookingID`),
  ADD KEY `animalId` (`animalId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `addressID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `animalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `animals`
--
ALTER TABLE `animals`
  ADD CONSTRAINT `animals_ibfk_1` FOREIGN KEY (`addressID`) REFERENCES `address` (`addressID`);

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`animalId`) REFERENCES `animals` (`animalID`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
