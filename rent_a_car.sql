-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2017 at 07:11 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rent a car`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment_table`
--

CREATE TABLE `comment_table` (
  `COMMENT_ID` int(11) NOT NULL,
  `POST_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `COMMENT` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `confirmation_table`
--

CREATE TABLE `confirmation_table` (
  `CONFIRMATION_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `VALIDATION_TEXT` varchar(50) NOT NULL,
  `STATUS` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post_image_table`
--

CREATE TABLE `post_image_table` (
  `IMAGE_ID` int(11) NOT NULL,
  `POST_ID` int(11) NOT NULL,
  `IMAGE_LINK` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_image_table`
--

INSERT INTO `post_image_table` (`IMAGE_ID`, `POST_ID`, `IMAGE_LINK`) VALUES
(22, 83, '../post_picture/02-03.jpg'),
(23, 84, '../post_picture/download2.jpg'),
(24, 85, '../post_picture/images (2).jpg'),
(25, 86, '../post_picture/images (1).jpg'),
(26, 87, '../post_picture/280px-Honda_Accord_second_gen_1982_Kleve_Kennzeichen.jpg'),
(27, 88, '../post_picture/download.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `post_table`
--

CREATE TABLE `post_table` (
  `POST_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `TITLE` varchar(50) NOT NULL,
  `DETAILS` text NOT NULL,
  `ADDRESS` text NOT NULL,
  `RENT` int(8) NOT NULL,
  `DATE_TIME` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_table`
--

INSERT INTO `post_table` (`POST_ID`, `USER_ID`, `TITLE`, `DETAILS`, `ADDRESS`, `RENT`, `DATE_TIME`) VALUES
(83, 36, 'Toyota corolla', 'Non-Aircondition', 'Tangail to Dhaka', 6000, '2017-12-15 08:02:27 am'),
(84, 28, 'Premio', 'wifi,fully aircondition', 'Dhaka to sylhet', 8000, '2017-12-20 10:14:11 am'),
(85, 27, 'Lancer', 'wifi,fully aircondition', 'Dhaka-Gopalgonj', 5000, '2017-12-18 20:17:57 pm'),
(86, 37, 'Nissan sunny', 'Fully Aircondition', 'Dhaka to Chittagong', 10, '2017-12-15 14:23:59 pm'),
(87, 26, 'Honda vigour', 'Non aircondition', 'Dhaka to Comilla', 5000, '2017-12-16 18:56:17 pm'),
(88, 40, 'Rent A Car !!!', 'Toyota Noah', 'Barishal To Dhaka', 7000, '2017-12-15 16:23:59 pm');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile_data_table`
--

CREATE TABLE `user_profile_data_table` (
  `PROFILE_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `PHONE_NO` varchar(15) DEFAULT NULL,
  `IMAGE` text,
  `ADDRESS` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_profile_data_table`
--

INSERT INTO `user_profile_data_table` (`PROFILE_ID`, `USER_ID`, `PHONE_NO`, `IMAGE`, `ADDRESS`) VALUES
(5, 24, NULL, '../profile_picture/24.jpg', NULL),
(6, 25, NULL, '../profile_picture/25.jpg', NULL),
(7, 26, NULL, '../profile_picture/26.jpg', NULL),
(8, 27, NULL, '../profile_picture/27.jpg', NULL),
(9, 28, NULL, '../profile_picture/28.jpg', NULL),
(13, 35, NULL, NULL, NULL),
(14, 36, '01828422676', '../../profile_picture/36.jpg', NULL),
(15, 37, NULL, '../profile_picture/37.jpg', NULL),
(16, 38, '01814666625', '../profile_picture/38.jpg', NULL),
(17, 39, NULL, NULL, NULL),
(18, 40, NULL, NULL, NULL),
(19, 41, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `USER_ID` int(11) NOT NULL,
  `FIRST_NAME` varchar(30) NOT NULL,
  `LAST_NAME` varchar(30) NOT NULL,
  `USER_NAME` varchar(50) NOT NULL,
  `USER_TYPE` varchar(15) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `PASSWORD` varchar(30) NOT NULL,
  `CREATION_DATE_TIME` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`USER_ID`, `FIRST_NAME`, `LAST_NAME`, `USER_NAME`, `USER_TYPE`, `EMAIL`, `PASSWORD`, `CREATION_DATE_TIME`) VALUES
(24, 'Sumaiya ', 'Zeba', 'zeba', 'AUTH_USER', 'sumaiyazeba@hotmail.com', '12345', '2017-11-11 12:11:51 pm'),
(25, 'Rawnak', 'Mim', 'mim', 'AUTH_USER', 'mim@gmail.com', '12345', '2017-11-11 12:12:41 pm'),
(26, 'Hamida', 'Shagufa', 'shagufa', 'AUTH_USER', 'shagufa@gmail.com', '12345', '2017-11-11 12:13:17 pm'),
(27, 'S', 'T', 's', 'AUTH_USER', 's@gmail.com', '12345', '2017-11-11 12:14:20 pm'),
(28, 'Z', 'A', 'z', 'AUTH_USER', 'z@gmail.com', '12345', '2017-11-11 12:15:04 pm'),
(35, 'R', 'M', 'r', 'ADMIN_USER', 'r@gmail.com', '12345', '2017-11-11 16:53:55 pm'),
(36, 'Q', 'H', 'q', 'ADMIN_USER', 'q@gmail.com', '12345', '2017-11-11 16:59:08 pm'),
(37, 'A', 'B', 'a', 'AUTH_USER', 'a@gmailcom', '12345', '2017-11-16 00:20:49 am'),
(38, 'Sumaiya Binte', 'Bashar', 'bashar', 'ADMIN_USER', 'zeba@gmail.com', '12345', '2017-11-16 23:17:50 pm'),
(39, 'Rawnak Rahman', 'Mim', 'rahman', 'ADMIN_USER', 'rahman@gmail.com', '12345', '2017-11-16 23:28:30 pm'),
(40, 'Umme Hamida', 'Hannan', 'hannan', 'ADMIN_USER', 'hannan@gmail.com', '12345', '2017-11-16 23:31:15 pm'),
(41, 'Tasfia', 'Rahman', 'Tasfia', 'AUTH_USER', 't@gmail.com', '12345', '2017-12-10 22:47:54 pm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment_table`
--
ALTER TABLE `comment_table`
  ADD PRIMARY KEY (`COMMENT_ID`),
  ADD KEY `POST_ID` (`POST_ID`),
  ADD KEY `USER_ID` (`USER_ID`);

--
-- Indexes for table `confirmation_table`
--
ALTER TABLE `confirmation_table`
  ADD PRIMARY KEY (`CONFIRMATION_ID`),
  ADD UNIQUE KEY `USER_ID` (`USER_ID`);

--
-- Indexes for table `post_image_table`
--
ALTER TABLE `post_image_table`
  ADD PRIMARY KEY (`IMAGE_ID`),
  ADD KEY `POST_ID` (`POST_ID`);

--
-- Indexes for table `post_table`
--
ALTER TABLE `post_table`
  ADD PRIMARY KEY (`POST_ID`),
  ADD KEY `USER_ID` (`USER_ID`),
  ADD KEY `USER_ID_2` (`USER_ID`),
  ADD KEY `USER_ID_3` (`USER_ID`);

--
-- Indexes for table `user_profile_data_table`
--
ALTER TABLE `user_profile_data_table`
  ADD PRIMARY KEY (`PROFILE_ID`),
  ADD UNIQUE KEY `USER_ID` (`USER_ID`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`USER_ID`),
  ADD UNIQUE KEY `ADMIN_USER_NAME` (`USER_NAME`),
  ADD UNIQUE KEY `ADMIN_EMAIL` (`EMAIL`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment_table`
--
ALTER TABLE `comment_table`
  MODIFY `COMMENT_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `confirmation_table`
--
ALTER TABLE `confirmation_table`
  MODIFY `CONFIRMATION_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post_image_table`
--
ALTER TABLE `post_image_table`
  MODIFY `IMAGE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `post_table`
--
ALTER TABLE `post_table`
  MODIFY `POST_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT for table `user_profile_data_table`
--
ALTER TABLE `user_profile_data_table`
  MODIFY `PROFILE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment_table`
--
ALTER TABLE `comment_table`
  ADD CONSTRAINT `fk_comTable_pTable` FOREIGN KEY (`POST_ID`) REFERENCES `post_table` (`POST_ID`),
  ADD CONSTRAINT `fk_comTable_uTable` FOREIGN KEY (`USER_ID`) REFERENCES `user_table` (`USER_ID`);

--
-- Constraints for table `confirmation_table`
--
ALTER TABLE `confirmation_table`
  ADD CONSTRAINT `fk_Utable_ConTable` FOREIGN KEY (`USER_ID`) REFERENCES `user_table` (`USER_ID`);

--
-- Constraints for table `post_image_table`
--
ALTER TABLE `post_image_table`
  ADD CONSTRAINT `fk_pImgTable_pTable` FOREIGN KEY (`POST_ID`) REFERENCES `post_table` (`POST_ID`);

--
-- Constraints for table `post_table`
--
ALTER TABLE `post_table`
  ADD CONSTRAINT `fk_pTable_uTable` FOREIGN KEY (`USER_ID`) REFERENCES `user_table` (`USER_ID`);

--
-- Constraints for table `user_profile_data_table`
--
ALTER TABLE `user_profile_data_table`
  ADD CONSTRAINT `fk_Utable_UProTable` FOREIGN KEY (`USER_ID`) REFERENCES `user_table` (`USER_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
