-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2021 at 08:41 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentcar_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `staffid` varchar(15) NOT NULL,
  `staffname` varchar(30) NOT NULL,
  `staffusername` varchar(30) NOT NULL,
  `staffemail` varchar(30) NOT NULL,
  `staffpassword` varchar(50) NOT NULL,
  `staffrole` varchar(30) NOT NULL,
  `staffphoto` varchar(30) NOT NULL,
  `officeid` varchar(30) DEFAULT NULL,
  `staffgender` varchar(30) NOT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`staffid`, `staffname`, `staffusername`, `staffemail`, `staffpassword`, `staffrole`, `staffphoto`, `officeid`, `staffgender`, `lastlogin`, `active`) VALUES
('staff1', 'Admin', 'admin', 'farhan.aslam330@gmail.com', '0192023a7bbd73250516f069df18b500', 'branchmanager', 'staff1.png', 'office1', 'male', '2021-05-04 19:32:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `bookingid` varchar(15) NOT NULL,
  `customerid` varchar(15) NOT NULL,
  `officeid` varchar(15) NOT NULL,
  `pickuptime` datetime NOT NULL,
  `returntime` datetime NOT NULL,
  `pickuplocation` varchar(30) NOT NULL,
  `returnlocation` varchar(30) NOT NULL,
  `durationinhours` int(11) NOT NULL,
  `carid` varchar(15) NOT NULL,
  `carcost` double NOT NULL,
  `driverid` varchar(15) DEFAULT NULL,
  `drivercost` double NOT NULL,
  `totalcost` double NOT NULL,
  `paymentmethod` varchar(30) NOT NULL,
  `confirmstatus` varchar(30) NOT NULL DEFAULT 'pending',
  `staffid` varchar(15) DEFAULT NULL,
  `bookingtime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`bookingid`, `customerid`, `officeid`, `pickuptime`, `returntime`, `pickuplocation`, `returnlocation`, `durationinhours`, `carid`, `carcost`, `driverid`, `drivercost`, `totalcost`, `paymentmethod`, `confirmstatus`, `staffid`, `bookingtime`) VALUES
('booking10', 'cus10', 'office1', '2021-07-06 07:30:00', '2021-08-06 07:30:00', 'manchester', 'manchester', 744, 'carid1', 55800, 'nodriver', 0, 55800, 'Pay at Arrival', 'declined', 'staff1', '2021-04-30 18:43:16');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `carno` varchar(15) NOT NULL,
  `carname` varchar(30) NOT NULL,
  `carclass` varchar(30) NOT NULL,
  `cartransmission` varchar(30) NOT NULL,
  `carcost` double NOT NULL,
  `cartype` varchar(30) NOT NULL,
  `carcapacity` int(11) NOT NULL,
  `carairbag` int(11) NOT NULL,
  `carotherdescription` varchar(50) NOT NULL,
  `carrating` int(11) DEFAULT NULL,
  `carphoto` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`carno`, `carname`, `carclass`, `cartransmission`, `carcost`, `cartype`, `carcapacity`, `carairbag`, `carotherdescription`, `carrating`, `carphoto`) VALUES
('car1', 'Rolls Royce', 'Saloon', 'Semi Automatic', 450, 'Luxury', 5, 4, 'Luxury car, specially designed for weddings', 4, 'rollsroyce.png'),
('car10', 'BMW M3 2021', 'Saloon', 'Auto', 450, 'Economy', 5, 2, '2021 version of the bmw m3', 5, 'bmwm3.png'),
('car11', 'Lambhorgini Urus', 'SUV', 'Auto', 450, 'Premium', 5, 4, 'Lambhorgini`s SUV, tremendous shape', NULL, 'urus.png'),
('car12', 'Range Rover', 'SUV', 'Auto', 6000, 'Economy', 2, 2, 'SUV in great shape', 5, 'rangerover.png'),
('car2', 'Tesla Model S', 'Saloon', 'Auto', 500, 'Premium', 5, 4, 'Electric Car by Elon Musk.', 5, 'tesla.png'),
('car3', 'Marcedez G wagon ', 'Truck', 'Auto', 500, 'Premium', 5, 5, 'marcedez`s g wagon premium car.', 5, 'gwagon.png'),
('car4', 'Limousine', 'Wedding Special', 'Auto', 500, 'Premium', 5, 2, 'Wedding Special car.', 3, 'limousine.png'),
('car5', 'Lambhorgini Avantador', 'Supercar', 'Auto', 500, 'Luxury', 2, 5, 'Supercar available for hire.', 5, 'avantador.png'),
('car6', 'BMW I8', 'Supercar', 'Auto', 700, 'Luxury', 4, 4, 'Others', 5, 'BMWI8.png'),
('car7', 'Jaguar XF 2', 'Saloon', 'Auto', 700, 'Premium', 5, 5, 'Like the jaguar animal the car is speedy.', 5, 'jaguar.png'),
('car8', 'Vintage Marcedez', 'Vintage hatchback', 'Manual', 700, 'Luxury', 5, 0, 'Others', 2, 'vintage.png');

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `feedbackid` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `feedback` varchar(150) DEFAULT NULL,
  `sendtime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`feedbackid`, `name`, `email`, `feedback`, `sendtime`) VALUES
(7, 'farhan', 'muhammad@gmail.com', 'how do you make a booking?', '2021-04-06 14:48:22'),
(9, 'farhan muhammad', 'test@gmail.com', 'just wanted to ask what time you open your office.', '2021-04-18 20:03:36');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `driverid` varchar(15) NOT NULL,
  `drivername` varchar(30) NOT NULL,
  `driverusername` varchar(15) NOT NULL,
  `driverpassword` varchar(50) NOT NULL,
  `driverage` int(11) NOT NULL,
  `driverrating` int(11) NOT NULL,
  `officeid` varchar(30) NOT NULL,
  `drivercost` double NOT NULL,
  `drivergender` varchar(30) NOT NULL,
  `driverphoto` varchar(30) NOT NULL,
  `driveremail` varchar(30) NOT NULL,
  `licensephoto` varchar(30) DEFAULT NULL,
  `driverexperience` varchar(30) NOT NULL,
  `driversignuptime` datetime NOT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`driverid`, `drivername`, `driverusername`, `driverpassword`, `driverage`, `driverrating`, `officeid`, `drivercost`, `drivergender`, `driverphoto`, `driveremail`, `licensephoto`, `driverexperience`, `driversignuptime`, `lastlogin`, `Active`) VALUES
('driver1', 'Connor', 'driver', 'c974f63abee678d0e103167ad9c813a5', 21, 0, 'office1', 1200, 'male', 'chaffeur.png', 'driver@gmail.com', 'license.png', '9', '2021-04-08 09:00:00', '2021-05-04 19:33:13', 1),
('driver18', 'griffin', 'Griffin', 'c974f63abee678d0e103167ad9c813a5', 28, 0, 'office1', 1000, 'female', 'chaffeur.png', 'example@example.com', 'license.png', '7', '2021-04-08 09:00:00', '2021-04-23 14:50:14', 1),
('driver2', 'simon John', 'Simon', 'c974f63abee678d0e103167ad9c813a5', 20, 0, 'office1', 1200, 'male', 'chaffeur.png', 'simon@gmail.com', 'license.png', '4', '2021-04-08 09:00:00', NULL, 1),
('driver24', 'Wallace', 'Gallegos', 'c974f63abee678d0e103167ad9c813a5', 27, 0, 'office1', 1400, 'male', 'chaffeur.png', 'number4@yahoo.com', 'license.png', '6', '2021-04-08 09:00:00', NULL, 1),
('driver3', 'cashy', 'Cash', 'c974f63abee678d0e103167ad9c813a5', 47, 0, 'office1', 1200, 'male', 'chaffeur.png', 'exampleagain@etc.com', 'license.png', '10', '2021-04-08 09:00:00', NULL, 1),
('driver34', 'Berry', 'Dustin', 'c974f63abee678d0e103167ad9c813a5', 25, 4, 'office1', 1200, 'female', 'chaffeur.png', 'dustin@okay.com', 'license.png', '9', '2021-04-08 09:00:00', NULL, 1),
('nodriver', 'no driver!!', 'nodriver', 'nodriver', 0, 1, 'office1', 0, 'nodriver', 'nodriver', 'nodriver', 'nodriver', 'nodriver', '0000-00-00 00:00:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE `office` (
  `officeid` varchar(15) NOT NULL,
  `officename` varchar(30) NOT NULL,
  `officeaddress` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`officeid`, `officename`, `officeaddress`) VALUES
('office1', 'Manchester', 'Car Rental, Picadilly Gardens, Manchester');

-- --------------------------------------------------------

--
-- Table structure for table `officecars`
--

CREATE TABLE `officecars` (
  `officeid` varchar(15) DEFAULT NULL,
  `carno` varchar(15) DEFAULT NULL,
  `carid` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `officecars`
--

INSERT INTO `officecars` (`officeid`, `carno`, `carid`) VALUES
('office1', 'car1', 'carid1'),
('office1', 'car8', 'carid10'),
('office1', 'car1', 'carid12'),
('office1', 'car12', 'carid13'),
('office1', 'car5', 'carid14'),
('office1', 'car6', 'carid6'),
('office1', 'car7', 'carid7');

-- --------------------------------------------------------

--
-- Table structure for table `officephone`
--

CREATE TABLE `officephone` (
  `officephoneid` int(11) NOT NULL,
  `officeid` varchar(30) NOT NULL,
  `officephoneprefix` varchar(11) NOT NULL,
  `officephoneno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `officephone`
--

INSERT INTO `officephone` (`officephoneid`, `officeid`, `officephoneprefix`, `officephoneno`) VALUES
(1, 'office1', '07', 438345320),
(2, 'office1', '+44', 2147483647),
(3, 'office1', '07', 438345320);

-- --------------------------------------------------------

--
-- Table structure for table `ratingscar`
--

CREATE TABLE `ratingscar` (
  `carno` varchar(15) NOT NULL,
  `customerid` varchar(15) NOT NULL,
  `carrating` int(11) DEFAULT NULL,
  `carreview` varchar(100) DEFAULT NULL,
  `ratingtime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratingscar`
--

INSERT INTO `ratingscar` (`carno`, `customerid`, `carrating`, `carreview`, `ratingtime`) VALUES
('car1', 'cus1', 3, 'Hello!', '2021-04-24 23:05:55'),
('car1', 'cus2', 4, 'This car is great! I like it! The price is affordable.', '2021-04-20 23:05:55'),
('car3', 'cus8', 5, 'Good!', '2021-05-01 16:12:46'),
('car4', 'cus10', 3, 'nice, everyone loved it at the wedding.', '2021-05-01 21:22:00'),
('car8', 'cus10', 0, 'nice car', '2021-05-02 18:25:03'),
('car8', 'cus4', 3, 'I think it is a bit expensive! ', '2021-05-01 23:05:55'),
('car8', 'cus5', 4, 'Great Car! I just love it!', '2021-05-01 23:05:55');

-- --------------------------------------------------------

--
-- Table structure for table `ratingsdriver`
--

CREATE TABLE `ratingsdriver` (
  `driverid` varchar(15) NOT NULL,
  `customerid` varchar(15) NOT NULL,
  `driverrating` int(11) NOT NULL,
  `driverreview` varchar(50) NOT NULL,
  `ratingtime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratingsdriver`
--

INSERT INTO `ratingsdriver` (`driverid`, `customerid`, `driverrating`, `driverreview`, `ratingtime`) VALUES
('driver34', 'cus1', 3, 'Very Friendly Driver', '2021-04-24 02:46:06'),
('driver34', 'cus2', 5, 'Great!', '2021-04-21 02:00:06'),
('driver34', 'cus3', 5, 'Friendly!', '2021-04-24 02:46:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `customerid` varchar(15) NOT NULL,
  `customername` varchar(30) NOT NULL,
  `customeremail` varchar(30) NOT NULL,
  `customerusername` varchar(30) NOT NULL,
  `customerpassword` varchar(50) NOT NULL,
  `customergender` varchar(15) NOT NULL,
  `customerdob` date NOT NULL,
  `customerphoto` varchar(30) DEFAULT NULL,
  `signuptime` datetime NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`customerid`, `customername`, `customeremail`, `customerusername`, `customerpassword`, `customergender`, `customerdob`, `customerphoto`, `signuptime`, `active`) VALUES
('cus1', 'Joseph', 'joseph@gmail.com', 'joseph123', 'bd9fa9edbeff8f0b88a6f26ce7665953', 'male', '1999-05-04', 'customer.png', '2021-05-01 00:13:08', 1),
('cus10', 'farhan muhammad', 'farhan@gmail.com', 'farhan123', '1ac5012170b65fb99f171ad799d045ac', 'male', '2000-01-02', 'picture.jpg', '2021-04-06 00:38:23', 1),
('cus2', 'phanter', 'phanter@gmail.com', 'phanter123', '272fb605f8fb4785c9b09f3c1d3b6527', 'male', '1998-07-11', 'customer.png', '2021-04-24 06:21:52', 1),
('cus3', 'user brother', 'user@gmail.com', 'user123', '455de69d127b972baa8e324642694026', 'female', '1998-05-18', 'customer.png', '2021-04-23 06:21:52', 1),
('cus4', 'abraham', 'abraham@gmail.com', 'abraham123', '1d8167d3261024a2af24ab5006f761bd', 'male', '1998-07-01', 'customer.png', '2021-04-20 06:21:52', 1),
('cus5', 'jhonny', 'jhonny@gmail.com', 'jhonny123', '91898be9b64eb350a181e181b338027c', 'male', '1999-05-15', 'customer.png', '2021-04-23 06:21:52', 1),
('cus8', 'Customer', 'customer@gmail.com', 'customer123', 'f4ad231214cb99a985dff0f056a36242', 'female', '1996-10-22', 'customer.png', '2021-04-24 15:57:05', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`staffid`),
  ADD KEY `officeid` (`officeid`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`bookingid`),
  ADD KEY `officeid` (`officeid`),
  ADD KEY `customerid` (`customerid`),
  ADD KEY `carid` (`carid`),
  ADD KEY `driverid` (`driverid`),
  ADD KEY `staffid` (`staffid`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`carno`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`feedbackid`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`driverid`),
  ADD KEY `officeid` (`officeid`);

--
-- Indexes for table `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`officeid`);

--
-- Indexes for table `officecars`
--
ALTER TABLE `officecars`
  ADD PRIMARY KEY (`carid`),
  ADD KEY `carno` (`carno`),
  ADD KEY `officeid` (`officeid`);

--
-- Indexes for table `officephone`
--
ALTER TABLE `officephone`
  ADD PRIMARY KEY (`officephoneid`),
  ADD KEY `officeid` (`officeid`);

--
-- Indexes for table `ratingscar`
--
ALTER TABLE `ratingscar`
  ADD PRIMARY KEY (`carno`,`customerid`),
  ADD KEY `customerid` (`customerid`);

--
-- Indexes for table `ratingsdriver`
--
ALTER TABLE `ratingsdriver`
  ADD PRIMARY KEY (`driverid`,`customerid`),
  ADD KEY `customerid` (`customerid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`customerid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `feedbackid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `officephone`
--
ALTER TABLE `officephone`
  MODIFY `officephoneid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrator`
--
ALTER TABLE `administrator`
  ADD CONSTRAINT `administrator_ibfk_1` FOREIGN KEY (`officeid`) REFERENCES `office` (`officeid`);

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`officeid`) REFERENCES `office` (`officeid`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`customerid`) REFERENCES `users` (`customerid`),
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`carid`) REFERENCES `officecars` (`carid`),
  ADD CONSTRAINT `bookings_ibfk_4` FOREIGN KEY (`driverid`) REFERENCES `drivers` (`driverid`),
  ADD CONSTRAINT `bookings_ibfk_5` FOREIGN KEY (`staffid`) REFERENCES `administrator` (`staffid`);

--
-- Constraints for table `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `drivers_ibfk_1` FOREIGN KEY (`officeid`) REFERENCES `office` (`officeid`);

--
-- Constraints for table `officecars`
--
ALTER TABLE `officecars`
  ADD CONSTRAINT `officecars_ibfk_1` FOREIGN KEY (`carno`) REFERENCES `cars` (`carno`),
  ADD CONSTRAINT `officecars_ibfk_2` FOREIGN KEY (`officeid`) REFERENCES `office` (`officeid`);

--
-- Constraints for table `officephone`
--
ALTER TABLE `officephone`
  ADD CONSTRAINT `officephone_ibfk_1` FOREIGN KEY (`officeid`) REFERENCES `office` (`officeid`);

--
-- Constraints for table `ratingscar`
--
ALTER TABLE `ratingscar`
  ADD CONSTRAINT `ratingscar_ibfk_1` FOREIGN KEY (`carno`) REFERENCES `cars` (`carno`),
  ADD CONSTRAINT `ratingscar_ibfk_2` FOREIGN KEY (`customerid`) REFERENCES `users` (`customerid`);

--
-- Constraints for table `ratingsdriver`
--
ALTER TABLE `ratingsdriver`
  ADD CONSTRAINT `ratingsdriver_ibfk_1` FOREIGN KEY (`driverid`) REFERENCES `drivers` (`driverid`),
  ADD CONSTRAINT `ratingsdriver_ibfk_2` FOREIGN KEY (`customerid`) REFERENCES `users` (`customerid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
