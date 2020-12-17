-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2020 at 11:40 PM
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
(375, -1, 1011, 1, 702031),
(383, 100013, 1011, 1, 702028),
(384, 100013, 1011, 1, 702029),
(385, 100013, 1012, 2, 702030),
(415, 100011, 1023, 12, 702032),
(420, -1, 1027, 2, 702033),
(431, -1, 1028, 2, 1);

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
(2, 'Auto Parts'),
(13, 'Gloves'),
(14, 'Helmet'),
(15, 'Tires'),
(16, 'Mirror');

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
(702027, -1, NULL, NULL, 0.00, 1450.29, 'Cash Payment', '2020-12-14 06:08:59'),
(702028, 100013, '+639123789168', 'Block 1 Lot 4 Talomo Proper, Davao City', 0.00, 560.00, 'Cash on Delivery', '2020-12-15 16:57:30'),
(702029, 100013, '+639192791759', 'Block 1 Lot 4 Talomo Proper, Davao City', 0.00, 560.00, 'Cash on Delivery', '2020-12-15 17:05:59'),
(702030, 100013, '+639192791759', 'Block 12 Lot 12 Matina Aplaya, Davao City', 0.00, 6289.90, 'Cash on Delivery', '2020-12-15 17:15:26'),
(702031, -1, NULL, NULL, 0.00, 560.00, 'Cash Payment', '2020-12-15 18:58:45'),
(702032, 100011, NULL, NULL, 0.00, 1011.36, 'Cash Payment', '2020-12-17 17:45:32'),
(702033, -1, NULL, NULL, 999.37, 4597.09, 'Cash Payment', '2020-12-08 17:51:49');

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
(1000, 'RED REV Super Limiter Cut', 'Exclusive Part for RaceExclusive Japan Spec. Vehicle*It will not work properly in case of replacing it with full scale meter.*The vehicle that powered up by mounting the RED REV is limited to NSR250R (90-93), RVF400, ZEPHYR400χ.Other vehicle is a speed limiter cut.*The graph data on the photo is RVF400.', 2499.12, 'product-1.jpg', 1, 2, 1, 100002, '2020-09-16 01:42:02'),
(1010, 'GOODS	Half Helmet FLAMES', 'Color: BlueSize: FreeA simple half-helmet.Simple half-helmet with Flames design.Ideal for painted bases.*There is some fading, discoloration, etc. for long-term storage products. Please purchase on a paint basis.*This is a decorative helmet. Please do not wear when riding a motorcycle.', 1294.90, 'product-2.jpg', 308, 33, 1, 100003, '2020-12-03 01:42:02'),
(1011, 'DRC Street Radiator Hose Set', 'Color: RedSilicon Radiator HoseIt reinforced by a multilayer structure of silicon material and high strength fiber that withstand from minus 40 to 260 degrees.It is excellent resistance to pressure and heat, minimizing the expansion of hoses even under harsh conditions.The engine performance is fully pulled out securing a stable cooling water flow.', 500.00, 'product-3.jpg', 276, 69, 0, 0, '2020-04-11 01:42:02'),
(1012, 'TANAX	Cowling Mirror 7', '[Color] Black[Material]Housing/Bracket: Aluminum Die CastingBase: Zinc Die Casting[Quantity] Mirror Body x1pc.It is a new type cowling mirror appearance.It adopted the anti-dazzling ', 2807.99, 'product-4.jpg', 26, 25, 16, 100002, '2020-02-22 01:42:02'),
(1023, 'Dogs', '                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam laborum incidunt voluptatum, reprehenderit molestiae, aspernatur eius error similique vitae temporibus laboriosam unde? Deserunt amet labore eligendi explicabo, possimus fugiat sint?', 75.25, 'xr8dsrxa7tu21.jpg', 1076, 72, 2, 100003, '2020-12-07 07:30:07'),
(1027, 'EK CHAIN	QX-ring Seal Chain', '', 2498.42, '520SRX2_BK-GP.jpg', 121, 2, 1, 0, '2020-12-16 01:21:33'),
(1028, 'BEAMSUniversal Silencer', '', 13083.84, 'u102-02-001.jpg', 2, 0, 1, 0, '2020-12-16 01:37:36'),
(1029, 'NOLAN	N405 GT', '', 12058.11, '95878.jpg', 32, 0, 14, 100004, '2020-12-16 01:39:54'),
(1030, 'GK-132 Rain Over Gloves', '', 1627.67, '06-132_01.jpg', 21, 0, 1, 100003, '2020-12-16 01:42:02'),
(1031, 'YG-084R All-Weather Glove', '', 1627.67, 'yg-084rye.jpg', 233, 0, 13, 100004, '2020-12-16 01:43:24'),
(1032, 'Half Finger Gloves', '', 2148.64, 'YG-905SRD_01.jpg', 1232, 0, 2, 0, '2020-12-16 01:44:28'),
(1033, 'Titanium Caliper Bolt', '', 10174.58, 'titan_bolt.jpg', 23, 0, 2, 100002, '2020-12-16 01:53:29'),
(1034, 'Radial Monoblock Caliper Kit', 'fajlkdjf;awefawefawefawef', 26442.52, 'image3.jpg', 4, 0, 1, 0, '2020-12-16 01:55:05'),
(1035, 'PRO Phil Air Chuck', '', 3076.76, 'default.png', 12, 0, 2, 100002, '2020-12-16 01:56:53'),
(1036, 'Rear Sets 4 Position', '', 26233.39, '51-18-01_01.jpg', 0, 0, 0, 0, '2020-12-16 01:58:10');

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
(100003, 'NCCC', 'Tagum', '+639192791759'),
(100004, 'Viva Royal Trading CO.', 'Taiwan, Province Of China', '+639192791759'),
(100005, 'Continental Engines LTD', 'Southern Asia India', '+639192791753'),
(100006, 'SANWU ELECTRIC INDUSTRY CO.', 'DISTRICT, GUANGZHOU,CHINA', '+639192791753'),
(100007, 'LUNG KU MACHINERY CO., LTD', 'ROAD TALI CITY, TAICHUNG TW', '+639123789168'),
(100008, 'Secret', 'heheh', '+639192791759');

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
  `date_registered` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `type`, `contact`, `address`, `date_registered`) VALUES
(-1, 'Walk-in', 'Customer', 'walkin@xyt.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 5, NULL, NULL, '2020-12-15 17:42:02'),
(100009, 'Abdul', 'Salsalani', 'salsalani@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 0, '+639123789168', 'Block 12 Lot 12 Matina Aplaya, Davao City', '2020-12-15 17:42:02'),
(100010, 'Gisan Geff', 'Raniego', 'geff@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 1, NULL, NULL, '2020-12-15 17:42:02'),
(100011, 'Mae Alaenah', 'Reyes', 'alaenah@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 0, '', '', '2020-12-15 17:42:02'),
(100012, 'Dan', 'Raniego', 'dan@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 1, NULL, NULL, '2020-12-15 17:42:02'),
(100013, 'Harvey', 'Sinday', 'sinday@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 0, NULL, NULL, '2020-12-15 17:42:02');

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
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=432;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1038;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100016;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
