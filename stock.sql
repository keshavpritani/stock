-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2021 at 09:54 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_active` int(11) NOT NULL DEFAULT 0,
  `brand_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `brand_active`, `brand_status`) VALUES
(15, 'Kelvin', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL,
  `categories_name` varchar(255) NOT NULL,
  `qty_in_stock` decimal(11,3) NOT NULL,
  `categories_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`, `qty_in_stock`, `categories_status`) VALUES
(16, 'Soda', '275.000', 1),
(17, 'Salt', '285.000', 1),
(18, 'Sodium Meta', '2.000', 1),
(19, 'Ammonia', '250.000', 1),
(20, 'Chocolate Dark essence', '170.000', 1),
(21, 'Jeera Essence', '55.000', 1),
(22, 'Capsicum essence', '15.000', 1),
(23, 'Chocolate colour', '53.000', 1),
(24, 'Orange essence', '10.000', 1),
(25, 'Pineapple essence', '5.000', 1),
(26, 'Veron Powder', '10.000', 1),
(27, 'Melanan Powder', '10.000', 1),
(28, 'Potassium Meta-Bisulphide', '20.000', 1),
(29, 'Orange colour', '25.000', 1),
(30, 'Coconut Flavour', '4.000', 1),
(31, 'Mawa Flavour', '1.000', 1),
(32, 'strawberry colour', '25.000', 1),
(33, 'Pineapple colour', '25.000', 1),
(34, 'citric acid', '10.000', 1),
(35, 'Sugar syrup', '250.000', 1),
(36, 'Kotina Ghee', '238.000', 1),
(37, 'Trim Ghee', '975.000', 1),
(38, 'Skimmed Milk Powder', '3758.000', 1),
(39, 'Lily Oil', '229.000', 1),
(40, 'Malto Dextrin', '300.000', 1),
(41, 'Coco Powder', '5407.000', 1),
(42, 'Old milk powder', '250.000', 1),
(43, 'Maida ', '311.000', 1),
(44, 'Maida lala halwa', '2000.000', 2),
(45, 'Sugar', '14244.000', 1),
(46, 'Glucose-D', '80.000', 1),
(47, 'Whey Powder', '375.000', 1),
(48, 'PGPR', '100.000', 1),
(49, 'Chokita Ghee', '260.000', 1),
(50, 'Milk essence', '50.000', 1),
(51, 'ziva essence', '2.000', 1),
(52, 'Prova essence', '5.000', 1),
(53, 'Triveni Ghee', '4680.000', 1),
(54, 'Fry oil', '360.000', 1),
(55, 'Ajwain', '80.000', 1),
(56, 'Jeera', '44.000', 1),
(57, 'Starch powder', '115.000', 1),
(58, 'lecithin', '514.000', 1),
(59, 'Improver', '300.000', 1),
(60, 'wafer Maida', '2250.000', 1),
(61, 'pink colour', '1.000', 1),
(62, 'Butterscotch flavour', '3.000', 1),
(63, 'slsl', '0.400', 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_log`
--

CREATE TABLE `order_log` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `entered_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` text NOT NULL,
  `brand_id` int(11) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_image`, `brand_id`, `rate`, `status`) VALUES
(39, 'Kaju', '../assests/images/stock/877361131607d79e77ca07.jpg', 15, '0', 1),
(40, 'Wafer stick jar', '../assests/images/stock/603006459607fc00dbd2eb.jpg', 15, '0', 1),
(41, 'Strawberry Wafer ', '../assests/images/stock/1013965389607fc5d35ccb2.jpg', 15, '0', 1),
(42, 'chocolate wafer biscuit', '../assests/images/stock/414502097607fc6e4a37e1.jpg', 15, '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_materials`
--

CREATE TABLE `product_materials` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `qty` decimal(11,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_materials`
--

INSERT INTO `product_materials` (`id`, `product_id`, `categories_id`, `qty`) VALUES
(19, 39, 45, '30.000'),
(20, 39, 43, '90.000'),
(21, 39, 54, '40.000'),
(22, 39, 56, '1.000'),
(23, 39, 55, '1.000'),
(24, 39, 19, '3.000'),
(25, 39, 17, '3.000'),
(26, 39, 16, '0.100'),
(27, 39, 21, '1.000'),
(29, 40, 43, '20.000'),
(30, 40, 45, '17.000'),
(31, 40, 38, '2.000'),
(32, 40, 57, '1.000'),
(33, 40, 39, '2.000'),
(34, 40, 37, '2.000'),
(35, 40, 41, '1.000'),
(36, 40, 17, '1.000'),
(37, 40, 20, '1.000'),
(38, 40, 58, '1.000'),
(39, 40, 62, '1.000'),
(40, 41, 60, '30.000'),
(41, 41, 57, '2.000'),
(42, 41, 18, '1.000'),
(43, 41, 17, '1.000'),
(44, 41, 16, '1.000'),
(45, 41, 59, '1.000'),
(46, 41, 39, '1.000'),
(47, 41, 58, '1.000'),
(48, 41, 45, '14.000'),
(49, 41, 36, '6.000'),
(50, 41, 24, '1.000'),
(51, 41, 29, '1.000'),
(52, 42, 60, '30.000'),
(53, 42, 57, '1.000'),
(54, 42, 18, '1.000'),
(55, 42, 17, '1.000'),
(56, 42, 16, '1.000'),
(57, 42, 59, '1.000'),
(58, 42, 58, '1.000'),
(59, 42, 39, '1.000'),
(60, 42, 45, '14.000'),
(61, 42, 36, '6.000'),
(62, 42, 41, '1.000');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`) VALUES
(1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`);

--
-- Indexes for table `order_log`
--
ALTER TABLE `order_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_materials`
--
ALTER TABLE `product_materials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`,`categories_id`),
  ADD KEY `product_materials_ibfk_2` (`categories_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `order_log`
--
ALTER TABLE `order_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `product_materials`
--
ALTER TABLE `product_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_log`
--
ALTER TABLE `order_log`
  ADD CONSTRAINT `order_log_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `product_materials`
--
ALTER TABLE `product_materials`
  ADD CONSTRAINT `product_materials_ibfk_2` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`categories_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_materials_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
