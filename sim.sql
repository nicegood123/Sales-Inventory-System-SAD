-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2020 at 08:25 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sim`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `check_number` varchar(11) DEFAULT NULL,
  `check_amount` float(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `name`, `branch`, `check_number`, `check_amount`) VALUES
(1, 'BDO', 'Buhangin', '0918238329', 3000.00),
(2, 'BPI', 'Tagum', '2118223329', 5000.00),
(3, 'BDO', 'Matina', '0918238329', 3000.00),
(4, 'BDO', 'Maa', '0918238329', 5000.00),
(5, 'BDO', 'Maa', '1231232', 3000.00),
(6, 'BPI', 'Toril', '0918238329', 5000.00),
(7, 'BDO', 'Tagum', '0918238329', 5000.00),
(8, 'BPI', 'Buhangin', '1231232', 50000.00),
(9, 'BPI', 'Buhangin', '0918238329', 50000.00),
(10, 'BDO', 'Matina', '0918238329', 3000.00),
(11, 'BPI', 'Buhangin', '0918238329', 5000.00),
(12, 'BDO', 'Maa', '1231232', 3000.00),
(13, 'BDO', 'Maa', '0918238329', 3000.00),
(14, 'BDO', 'Tagum', '1231232', 5000.00),
(15, 'BDO', 'Matina', '0918238329', 50000.00),
(16, 'BDO', 'Matina', '2118223329', 50000.00),
(17, 'BDO', 'Maa', '1231232', 5000.00);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(100) NOT NULL,
  `cart_code` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `quantity`, `cart_code`) VALUES
(339, -1, 1023, 1, 702001),
(340, -1, 1023, 1, 702002),
(341, -1, 1023, 1, 702003),
(342, -1, 1023, 1, 702004),
(343, -1, 1023, 1, 702005),
(344, -1, 1011, 1, 702006),
(345, 100012, 1010, 1, 702007),
(346, 100009, 1000, 1, 702008),
(347, -1, 1012, 1, 702009),
(349, -1, 1023, 1, 702010),
(350, -1, 1023, 1, 702011),
(351, -1, 1023, 1, 702012),
(352, -1, 1023, 1, 702013),
(355, -1, 1023, 1, 702014),
(356, -1, 1023, 1, 702014),
(357, 100013, 1023, 1, 702015),
(358, -1, 1023, 1, 702016),
(359, -1, 1023, 1, 702017),
(360, -1, 1023, 1, 702018),
(361, -1, 1023, 1, 702019),
(362, 100012, 1023, 1, 702020),
(363, -1, 1011, 1, 702021),
(364, -1, 1023, 1, 702022),
(365, -1, 1011, 1, 702023),
(367, -1, 1023, 1, 702024),
(368, 100013, 1023, 1, 702025),
(369, 100013, 1011, 1, 702025),
(370, -1, 1023, 1, 702026),
(372, -1, 1010, 1, 702027),
(375, -1, 1011, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(0, 'Unclassified item'),
(1, 'Motorcyle Parts'),
(2, 'Auto Parts');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `discount` float(10,2) DEFAULT 0.00,
  `total` float(10,2) NOT NULL,
  `payment_method` varchar(50) DEFAULT 'Cash on Delivery',
  `ordered_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `contact`, `address`, `discount`, `total`, `payment_method`, `ordered_date`) VALUES
(702002, -1, NULL, NULL, 15.05, 60.20, 'Cash Payment', '2020-12-14 05:07:28'),
(702003, -1, NULL, NULL, 0.00, 75.25, 'Cash Payment', '2020-12-14 05:07:56'),
(702025, 100013, NULL, NULL, 115.05, 529.23, 'Check Payment', '2020-12-14 06:04:19'),
(702026, -1, NULL, NULL, 0.00, 84.28, 'Cash Payment', '2020-12-14 06:05:23'),
(702027, -1, NULL, NULL, 0.00, 1450.29, 'Cash Payment', '2020-12-14 06:08:59');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(65) NOT NULL,
  `description` text NOT NULL,
  `price` float(10,2) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `QuantityInStock` int(100) NOT NULL,
  `QuantitySold` int(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `date_added` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `photo`, `QuantityInStock`, `QuantitySold`, `category_id`, `supplier_id`, `date_added`) VALUES
(1000, 'RED REV Super Limiter Cut', 'Exclusive Part for RaceExclusive Japan Spec. Vehicle*It will not work properly in case of replacing it with full scale meter.*The vehicle that powered up by mounting the RED REV is limited to NSR250R (90-93), RVF400, ZEPHYR400χ.Other vehicle is a speed limiter cut.*The graph data on the photo is RVF400.', 2499.12, 'product-1.jpg', 1, 2, 1, 100002, 'March 13, 2020, 5:31 PM'),
(1010, 'GOODS	Half Helmet FLAMES', 'Color: BlueSize: FreeA simple half-helmet.Simple half-helmet with Flames design.Ideal for painted bases.*There is some fading, discoloration, etc. for long-term storage products. Please purchase on a paint basis.*This is a decorative helmet. Please do not wear when riding a motorcycle.', 1294.90, 'product-2.jpg', 308, 33, 1, 100003, 'March 13, 2020, 5:31 PM'),
(1011, 'DRC Street Radiator Hose Set', 'Color: RedSilicon Radiator HoseIt reinforced by a multilayer structure of silicon material and high strength fiber that withstand from minus 40 to 260 degrees.It is excellent resistance to pressure and heat, minimizing the expansion of hoses even under harsh conditions.The engine performance is fully pulled out securing a stable cooling water flow.', 500.00, 'product-3.jpg', 278, 66, 0, 0, 'March 14, 2020, 3:38 AM'),
(1012, 'TANAX	Cowling Mirror 7', '[Color] Black[Material]Housing/Bracket: Aluminum Die CastingBase: Zinc Die Casting[Quantity] Mirror Body x1pc.It is a new type cowling mirror appearance.It adopted the anti-dazzling ', 2807.99, 'product-4.jpg', 27, 23, 2, 100002, 'March 14, 2020, 3:38 AM'),
(1023, 'Dogs', 'blahblah', 75.25, 'xr8dsrxa7tu21.jpg', 1083, 60, 2, 100003, '2020-12-07 07:30:07');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `address`, `contact`) VALUES
(0, 'No Supplier', '', ''),
(100002, 'Samya', 'Japan Ambots', '+639192791759'),
(100003, 'NCCC', 'Tagum', '+639192791759');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(128) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `contact` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `date_registered` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `type`, `contact`, `address`, `date_registered`) VALUES
(-1, 'Walk-in', 'Customer', 'walkin@xyt.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 5, NULL, NULL, 'December 7, 2020, 9:29 AM'),
(100009, 'Abdul', 'Salsalani', 'salsalani@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 0, '+639123789168', 'Block 12 Lot 12 Matina Aplaya, Davao City', 'December 3, 2020, 1:21 AM'),
(100010, 'Gisan Geff', 'Raniego', 'geff@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 1, NULL, NULL, 'December 3, 2020, 1:28 AM'),
(100011, 'Alaenah Mae', 'Reyes', 'alaenah@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 0, NULL, NULL, 'December 6, 2020, 2:36 PM'),
(100012, 'Dan', 'Raniego', 'dan@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 0, NULL, NULL, 'December 12, 2020, 12:30 PM'),
(100013, 'Harvey', 'Sinday', 'sinday@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 0, NULL, NULL, 'December 14, 2020, 1:20 PM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=376;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1027;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100016;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
