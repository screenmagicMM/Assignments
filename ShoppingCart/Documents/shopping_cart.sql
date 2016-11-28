-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 27, 2016 at 06:10 PM
-- Server version: 5.7.16
-- PHP Version: 5.5.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping_cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `cart_entry_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `checkout_flag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `category_id`, `cart_entry_time`, `checkout_flag`) VALUES
(1, 1, 1, 1, '2016-11-27 12:19:16', 0),
(2, 1, 4, 2, '2016-11-27 12:19:23', 0),
(3, 1, 3, 1, '2016-11-27 12:19:28', 0),
(4, 1, 6, 2, '2016-11-27 12:19:33', 0),
(5, 1, 2, 1, '2016-11-27 12:19:38', 0),
(6, 1, 6, 2, '2016-11-27 12:19:44', 0),
(7, 1, 2, 1, '2016-11-27 12:19:54', 0),
(8, 1, 3, 1, '2016-11-27 12:21:54', 0),
(9, 1, 6, 2, '2016-11-27 16:19:36', 0),
(10, 1, 1, 1, '2016-11-27 17:10:48', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(10) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_desc` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_desc`) VALUES
(1, 'Books', 'Books'),
(2, 'Electronics', 'Electronics'),
(3, 'Movies', 'Movies'),
(4, 'Music', 'Music');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(10) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_desc` varchar(250) NOT NULL,
  `price` float NOT NULL,
  `tax` float NOT NULL,
  `discount` float NOT NULL,
  `category_id` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_desc`, `price`, `tax`, `discount`, `category_id`) VALUES
(1, '100 Places to Go While Still Young at Heart', '100 Places to Go While Still Young at Heart', 3360, 2, 10, 1),
(2, 'Art As Experience', 'Art As Experience', 770, 2, 10, 1),
(3, 'The Painted Word', 'The Painted Word', 420, 2, 10, 1),
(4, 'Hirschfeld on Line', 'Hirschfeld on Line', 2450, 2, 10, 1),
(5, 'Adirondack Style', 'Adirondack Style', 1890, 2, 10, 1),
(6, 'Harman Kardon Digital Surround Sound Receiver', 'Harman Kardon Digital Surround Sound Receiver', 70000, 2, 10, 2),
(7, 'Harman Kardon AM/FM Stereo Sound Receiver', 'Harman Kardon AM/FM Stereo Sound Receiver', 35000, 2, 10, 2),
(8, 'Harman Kardon Dolby Digital Receiver', 'Harman Kardon Dolby Digital Receiver', 49000, 2, 10, 2),
(9, 'GPX Portable CD Player with Bass Boost', 'GPX Portable CD Player with Bass Boost', 2100, 2, 10, 2),
(10, 'GPX Portable CD Player with Car Kit', 'GPX Portable CD Player with Car Kit', 3500, 2, 10, 2),
(11, 'Small Soldiers', 'Small Soldiers', 1400, 2, 10, 3),
(12, 'The Mask of Zorro', 'The Mask of Zorro', 910, 2, 10, 3),
(13, 'Vanishing Point', 'Vanishing Point', 630, 2, 10, 3),
(14, 'Godzilla', 'Godzilla', 770, 2, 10, 3),
(15, 'Apollo 13', 'Apollo 13', 630, 2, 10, 3),
(16, 'Sixteen Stone', 'Sixteen Stone', 980, 2, 10, 4),
(17, 'Throwing Copper', 'Throwing Copper', 980, 2, 10, 4),
(18, 'Tails', 'Tails', 1050, 2, 10, 4),
(19, 'Seal (94)', 'Seal (94)', 980, 2, 10, 4),
(20, 'The Infinite Sadness', 'The Infinite Sadness', 1330, 2, 10, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`) VALUES
(1, 'John');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_name` (`product_name`,`category_id`),
  ADD UNIQUE KEY `product_name_2` (`product_name`,`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
