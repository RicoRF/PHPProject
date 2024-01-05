-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2023 at 11:44 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizzadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `crusttypes`
--

CREATE TABLE `crusttypes` (
  `crustTypeId` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `crusttypes`
--

INSERT INTO `crusttypes` (`crustTypeId`, `name`) VALUES
(1, 'Thin Crust'),
(2, 'Handmade Pan'),
(3, 'Original'),
(4, 'Gluten'),
(5, 'Chicago Style');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerid` int(11) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `phoneNumber` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `houseNumber` int(11) DEFAULT NULL,
  `street` varchar(45) DEFAULT NULL,
  `province` varchar(2) DEFAULT NULL,
  `postalCode` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employeeid` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employeeid`, `username`, `password`) VALUES
(1, 'admin', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `totalPrice` float NOT NULL DEFAULT 0,
  `deliveryDateTime` datetime NOT NULL DEFAULT current_timestamp(),
  `placedDateTime` datetime NOT NULL DEFAULT current_timestamp(),
  `customerId` int(11) NOT NULL,
  `orderStatus` varchar(45) NOT NULL DEFAULT 'PENDING',
  `payment_method` varchar(255) NOT NULL,
  `delivery_method` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pizza`
--

CREATE TABLE `pizza` (
  `pizzaId` int(11) NOT NULL,
  `sizeId` int(11) NOT NULL,
  `isFinished` tinyint(4) NOT NULL DEFAULT 0,
  `crustTypeId` int(11) NOT NULL,
  `toppings` varchar(255) DEFAULT NULL,
  `price` float NOT NULL,
  `orderId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pizza_toppings_map`
--

CREATE TABLE `pizza_toppings_map` (
  `toppingId` int(11) NOT NULL,
  `pizzaId` int(11) NOT NULL,
  `pizza_toppings_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `sizeid` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`sizeid`, `name`) VALUES
(1, 'Large');

-- --------------------------------------------------------

--
-- Table structure for table `toppings`
--

CREATE TABLE `toppings` (
  `toppingId` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `createdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `empAddedBy` int(11) NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `toppings`
--

INSERT INTO `toppings` (`toppingId`, `name`, `price`, `createdate`, `empAddedBy`, `isActive`) VALUES
(11, 'Cheese', 3, '2023-12-15 21:23:39', 1, 0),
(12, 'Garlic', 1, '2023-12-15 21:23:45', 1, 1),
(15, 'Bacon', 2, '2023-12-15 21:24:05', 1, 1),
(16, 'Marinara Sauce', 1, '2023-12-15 21:24:23', 1, 1),
(17, 'Mozzarella', 4, '2023-12-15 22:37:43', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crusttypes`
--
ALTER TABLE `crusttypes`
  ADD PRIMARY KEY (`crustTypeId`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerid`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employeeid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `customeridFK_idx` (`customerId`);

--
-- Indexes for table `pizza`
--
ALTER TABLE `pizza`
  ADD PRIMARY KEY (`pizzaId`),
  ADD KEY `crusttypeFK_idx` (`crustTypeId`),
  ADD KEY `sizeidFK_idx` (`sizeId`),
  ADD KEY `orderidFK_idx` (`orderId`);

--
-- Indexes for table `pizza_toppings_map`
--
ALTER TABLE `pizza_toppings_map`
  ADD PRIMARY KEY (`pizza_toppings_id`),
  ADD KEY `pizzaidFK_idx` (`pizzaId`),
  ADD KEY `toppingidFK` (`toppingId`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`sizeid`);

--
-- Indexes for table `toppings`
--
ALTER TABLE `toppings`
  ADD PRIMARY KEY (`toppingId`),
  ADD KEY `employeeidFK_idx` (`empAddedBy`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crusttypes`
--
ALTER TABLE `crusttypes`
  MODIFY `crustTypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employeeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pizza`
--
ALTER TABLE `pizza`
  MODIFY `pizzaId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pizza_toppings_map`
--
ALTER TABLE `pizza_toppings_map`
  MODIFY `pizza_toppings_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `sizeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `toppings`
--
ALTER TABLE `toppings`
  MODIFY `toppingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `customeridFK` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pizza`
--
ALTER TABLE `pizza`
  ADD CONSTRAINT `crusttypeFK` FOREIGN KEY (`crustTypeId`) REFERENCES `crusttypes` (`crustTypeId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orderidFK` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sizeidFK` FOREIGN KEY (`sizeId`) REFERENCES `sizes` (`sizeid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pizza_toppings_map`
--
ALTER TABLE `pizza_toppings_map`
  ADD CONSTRAINT `pizzaidFK` FOREIGN KEY (`pizzaId`) REFERENCES `pizza` (`pizzaId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `toppingidFK` FOREIGN KEY (`toppingId`) REFERENCES `toppings` (`toppingId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `toppings`
--
ALTER TABLE `toppings`
  ADD CONSTRAINT `employeeidFK` FOREIGN KEY (`empAddedBy`) REFERENCES `employee` (`employeeid`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
