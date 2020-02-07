-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2020 at 08:59 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fooddata`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `admin_id` int(30) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `fid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `fid`) VALUES
(0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `catagory`
--

CREATE TABLE `catagory` (
  `id` int(11) NOT NULL,
  `catagory` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catagory`
--

INSERT INTO `catagory` (`id`, `catagory`) VALUES
(1, 'Biryani'),
(2, 'Burger'),
(3, 'Pizza'),
(4, 'Drinks');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(11) NOT NULL,
  `food_name` varchar(1000) NOT NULL,
  `food_description` varchar(1000) NOT NULL,
  `food_price` int(11) NOT NULL,
  `food_catagory` varchar(1000) NOT NULL,
  `url` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `food_name`, `food_description`, `food_price`, `food_catagory`, `url`) VALUES
(1, 'Chicken Biriyani', 'Chicken briyani ', 200, 'Biryani', 'kacci.jpg'),
(2, 'Cheesy Chicken Burger', 'Cheesy Chicken Burger', 150, 'Burger', 'burger.jpg'),
(3, 'Cheesy Barbecue Chicken Pizza', 'Cheesy Barbecue Chicken Pizza (large)', 1000, 'Pizza', 'pizza.jpg'),
(4, 'Orange Juice', 'Fresh Orange Juice', 100, 'Drinks', 'orange juice.jpg'),
(5, 'Chicken Khichuri', 'Chicken Khichuri ', 200, 'Biryani', 'chicken kichuri.jpg'),
(6, 'Cheesy Beef Burger', 'Tasty Cheesy Beef Burger', 350, 'Burger', 'beef burger.jpg'),
(7, 'Lemonade', 'Lemonade with mint', 50, 'Drinks', 'mint lemonade.jpg'),
(8, 'Hydrabadi Biriyani', 'Tasty Mutton Hydrabadi Biriyani with Bashmati rice', 250, 'Biryani', 'Hydrabadi Biriyani.jpg'),
(9, 'Hazi Biriyani', 'Old Dhaka Special Hazi Biriyani', 200, 'Biryani', 'Hazi Biriyani.jpg'),
(10, 'Mutton Kacci Biriyani', 'Tasty Mutton Kacci Biriyani ', 220, 'Biryani', 'Mutton kacci.jpg'),
(11, 'Cheesy Beef Pizza', 'Beef, Onion, Chesse, Mushroom, Capsicum, Green Chili', 1250, 'Pizza', 'beef pizza.jpg'),
(12, 'Chessy Vegetable Pizza', 'Chessy Vegetable Pizza', 550, 'Pizza', 'Vegetable Pizza.jpg'),
(13, 'Cheesy Multi Layered Beef Burger', 'Very tasty & Cheesy Multi Layered beef Burger', 500, 'Burger', 'The Burger Lift.jpg'),
(14, 'Pepsi', 'Drinks', 100, 'Drinks', 'pepsi.jpg'),
(15, 'Coca-cola', 'Drinks', 100, 'Drinks', 'cocacola.jpg'),
(16, 'Mountain Dew', 'Drinks', 100, 'Drinks', 'Mountain Dew.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `food_order`
--

CREATE TABLE `food_order` (
  `orderid` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `fid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_order`
--

INSERT INTO `food_order` (`orderid`, `id`, `fid`) VALUES
(1, 1, 1),
(2, 1, 1),
(2, 1, 5),
(2, 1, 8),
(2, 1, 11),
(3, 1, 2),
(3, 1, 14),
(3, 1, 12),
(4, 5, 1),
(4, 5, 8),
(4, 5, 4),
(5, 5, 14);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `tag` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `tag`) VALUES
(1, 'tasy'),
(1, ' biriyani'),
(1, ' chicken'),
(2, 'burger'),
(2, ' chicken burger'),
(3, 'pizza'),
(3, ' chicken pizza'),
(3, ' barbecue chicken pizza'),
(4, 'juice'),
(4, ' orange'),
(4, ' orange juice'),
(5, 'khicuri'),
(5, ' chicken'),
(5, ' chicken khicuri'),
(6, 'beef'),
(6, ' burger'),
(6, ' cheesy burger'),
(7, 'lemonade'),
(8, 'tasty'),
(8, ' biriyani'),
(8, ' mutton'),
(8, ' hydrabadi'),
(9, 'tasty'),
(9, ' biriyani'),
(9, ' mutton'),
(9, ' hazi biriyani'),
(10, 'tasty'),
(10, ' biriyani'),
(10, ' mutton'),
(10, ' kacci'),
(11, 'Pizza '),
(11, 'Beef'),
(11, 'tasty'),
(11, 'Beef Pizza'),
(12, 'pizza '),
(12, 'vegetable'),
(12, 'tasty'),
(12, 'vegetable Pizza'),
(13, 'burger'),
(13, 'layer'),
(13, 'cheese'),
(13, 'tasty'),
(13, 'beef'),
(13, 'cheesy'),
(14, 'drinks'),
(14, ' pepsi'),
(15, 'cocacola'),
(15, 'drinks'),
(16, 'drinks'),
(16, ' dew'),
(16, ' mountain dew');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `server_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `contact_no` varchar(100) NOT NULL,
  `address` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`server_id`, `first_name`, `last_name`, `contact_no`, `address`) VALUES
(1, 'Joy', 'Dhar', '01134569875', 'Garden Road, Farngate'),
(2, 'Joy', 'Dhar', '01700542483', 'Farmgate'),
(3, 'joy', 'dharr', '01700542483', 'Farmgate'),
(4, 'Joy', 'Dhar', '01700542483', 'Farmgate'),
(5, 'Abdul', 'Mannan', '12345', '12 Kolabagan');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `server_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`server_id`, `username`, `user_password`, `email`) VALUES
(1, 'user1', '1234', 'joy@mail.com'),
(2, 'joy123', '1234', 'joy@gmail.com'),
(3, 'joy1', '1234', 'joydhar.uap@gmail.com'),
(4, 'joy2', '1234', 'jooydhar@gmail.com'),
(5, 'user5', '1234', 'm@mail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `catagory`
--
ALTER TABLE `catagory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`server_id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`server_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `admin_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `catagory`
--
ALTER TABLE `catagory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `server_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_login`
--
ALTER TABLE `user_login`
  ADD CONSTRAINT `ulfkui` FOREIGN KEY (`server_id`) REFERENCES `user_info` (`server_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
