-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2020 at 12:25 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurantpos`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `Category` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Vat` int(11) NOT NULL,
  `Tax` int(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `Category`, `Vat`, `Tax`, `Date`) VALUES
(1, 'Food', 21, 22, '2020-04-02 12:30:44'),
(2, 'Drink', 10, 10, '2020-05-09 13:03:53');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `idNumber` bigint(20) NOT NULL,
  `address` text NOT NULL,
  `email` text NOT NULL,
  `mobile` text NOT NULL,
  `dob` date NOT NULL,
  `discount` int(11) NOT NULL,
  `purchases` int(11) NOT NULL,
  `lastPurchase` date NOT NULL,
  `registerDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `idNumber`, `address`, `email`, `mobile`, `dob`, `discount`, `purchases`, `lastPurchase`, `registerDate`) VALUES
(1, 'Mark Gilmore', 333, '16 W', 'm@gmail.com', '1234567890', '2020-01-01', 10, 0, '0000-00-00', '2020-03-10 02:55:32'),
(18, 'Mark Gil', 111, 'QW', 'QW@gmail.com', '0867585858', '2002-02-02', 1, 0, '0000-00-00', '2020-05-11 21:38:59'),
(19, 'Jake', 101, 'dsa', 'dsa@gmail.com', '0851528274', '1995-08-12', 1, 6, '2020-05-22', '2020-05-22 14:26:28');

-- --------------------------------------------------------

--
-- Table structure for table `open_tables`
--

CREATE TABLE `open_tables` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `idSeller` int(11) NOT NULL,
  `tableNo` int(11) NOT NULL,
  `products` text CHARACTER SET utf16 NOT NULL,
  `netPrice` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `open_tables`
--

INSERT INTO `open_tables` (`id`, `code`, `idSeller`, `tableNo`, `products`, `netPrice`, `date`) VALUES
(18, 1, 12, 666, '[{\"id\":\"36\",\"product\":\"7up\",\"quantity\":\"2\",\"stock\":\"17\",\"price\":\"2\",\"totalPrice\":\"4\"}]', 4, '2020-05-09 13:29:24');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `idCategory` int(11) NOT NULL,
  `code` text NOT NULL,
  `product` text NOT NULL,
  `stock` int(11) NOT NULL,
  `buyingPrice` float NOT NULL,
  `sellingPrice` float NOT NULL,
  `sales` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `idCategory`, `code`, `product`, `stock`, `buyingPrice`, `sellingPrice`, `sales`) VALUES
(1, 1, '101', 'Steak and Chips', 21, 14.65, 18.95, 13),
(2, 1, '102', 'Chicken and Chips', 20, 7.5, 12.95, 0),
(3, 1, '103', 'Breakfast', 20, 6.85, 8.95, 40),
(4, 1, '104', 'Veggie Breakfast', 20, 3.95, 7.95, 0),
(5, 1, '105', 'Beef Burger with Chips/wedges', 20, 5.55, 12.5, 0),
(6, 1, '106', 'Chicken Burger with chips/wedges', 20, 5.55, 12.5, 0),
(7, 1, '107', 'Vegetable Soup', 0, 1.25, 4.5, 0),
(8, 1, '108', 'B.L.T.', 0, 3.25, 6.95, 0),
(9, 1, '109', 'Buffalo Chicken Wings', 0, 4.55, 8.95, 0),
(10, 1, '110', 'Chicken Curry', 0, 6.55, 11.95, 0),
(11, 1, '111', 'BBQ Pork Ribs', -3, 4.65, 8.95, 5),
(12, 1, '112', 'Bowl of chips', 1, 1, 2.95, -1),
(13, 1, '113', 'Bowl of Wedges', 0, 1.5, 4.5, 0),
(14, 1, '114', 'Mashed Potato', 7, 1, 2.95, 25),
(15, 1, '115', 'Cellar Style Bruschetta', 1, 3.2, 5.95, -1),
(16, 1, '116', 'Irish Oak Smoked Salmon', 1, 5.45, 8.95, -1),
(17, 1, '117', 'New York Style Baked Cheesecake', 18, 2.55, 5.5, 2),
(18, 1, '118', 'The Cellar Ice Cream Sundae', 0, 2.1, 4.95, 0),
(19, 1, '119', 'Hot Sticky Toffee Pudding', 1, 2.55, 5.5, -1),
(20, 1, '120', 'Warm Chocolate Fudge Cake', 0, 2.55, 5.5, 0),
(21, 2, '201', 'Guinness', 1, 2, 4.5, -1),
(23, 2, '203', 'Rock Shore', 18, 2, 4.5, 2),
(24, 2, '204', 'Hop House 13', 20, 2, 4.5, 0),
(25, 2, '205', 'Carlsberg', 0, 2, 4.5, 0),
(26, 2, '206', 'Bulmers', 0, 2, 4.5, 1),
(27, 2, '207', 'Wicklow Wolf', 9, 2.4, 4.5, 0),
(28, 2, '208', 'Galway Hooker', 20, 2, 4.5, 0),
(29, 2, '209', 'Vodka', 18, 4, 7.5, 2),
(30, 2, '210', 'Rum', 20, 4.8, 0, 0),
(31, 2, '211', 'Jack Daniels', 20, 4.8, 7.5, 0),
(32, 2, '212', 'Red Wine', 20, 3.48, 7, 1),
(33, 2, '213', 'White Wine', 20, 2.16, 7, 0),
(34, 2, '214', 'Rose', 20, 2.52, 7, -1),
(35, 2, '215', 'Coke', 20, 1.08, 2, 2),
(36, 2, '216', '7up', 15, 1.5, 2, 8),
(37, 2, '217', 'Fanta', 20, 1.2, 2, -1),
(39, 2, '219', 'Coffee', 20, 0.9, 1.95, 0),
(80, 2, '5054267000438', 'Lucozade', 19, 12, 17.4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `idSeller` int(11) NOT NULL,
  `tableNo` int(11) NOT NULL,
  `idCustomer` int(11) NOT NULL,
  `products` text NOT NULL,
  `netPrice` float NOT NULL,
  `discount` int(11) NOT NULL,
  `totalPrice` float NOT NULL,
  `paymentMethod` text NOT NULL,
  `saledate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `code`, `idSeller`, `tableNo`, `idCustomer`, `products`, `netPrice`, `discount`, `totalPrice`, `paymentMethod`, `saledate`) VALUES
(242, 2, 36, 33, 0, '[{\"id\":\"11\",\"product\":\"BBQ Pork Ribs\",\"category\":\"1\",\"quantity\":\"1\",\"stock\":\"-2\",\"price\":\"8.95\",\"totalPrice\":\"8.95\"},{\"id\":\"36\",\"product\":\"7up\",\"category\":\"2\",\"quantity\":\"1\",\"stock\":\"16\",\"price\":\"2\",\"totalPrice\":\"2\"},{\"id\":\"36\",\"product\":\"7up\",\"category\":\"2\",\"quantity\":\"1\",\"stock\":\"16\",\"price\":\"2\",\"totalPrice\":\"2\"}]', 0, 0, 12.95, 'Cash', '2020-05-22 14:44:49'),
(243, 3, 36, 11, 101, '[{\"id\":\"36\",\"product\":\"7up\",\"category\":\"2\",\"quantity\":\"1\",\"stock\":\"15\",\"price\":\"2\",\"totalPrice\":\"2\"},{\"id\":\"11\",\"product\":\"BBQ Pork Ribs\",\"category\":\"1\",\"quantity\":\"1\",\"stock\":\"-3\",\"price\":\"8.95\",\"totalPrice\":\"8.95\"},{\"id\":\"11\",\"product\":\"BBQ Pork Ribs\",\"category\":\"1\",\"quantity\":\"1\",\"stock\":\"-3\",\"price\":\"8.95\",\"totalPrice\":\"8.95\"}]', 19.9, 1, 19.7, 'Cash', '2020-05-22 14:47:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `user` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `profile` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `status` int(1) NOT NULL,
  `lastLogin` datetime NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user`, `password`, `profile`, `status`, `lastLogin`, `date`) VALUES
(12, 'Mark Gilmore', 'admin', '$2a$07$asxx54ahjppf45sd87a5auRajNP0zeqOkB9Qda.dSiTb2/n.wAC/2', 'administrator', 1, '2020-05-22 14:48:17', '2020-05-22 13:48:17'),
(36, 'JosephGriffith', 'adminn', '$2a$07$asxx54ahjppf45sd87a5auYHL6stc5JEtuEOZ0v4pW5h/w2KeE6rW', 'administrator', 1, '2020-05-22 15:53:06', '2020-05-22 14:53:06'),
(41, 'staff1', 'staff', '$2a$07$asxx54ahjppf45sd87a5auy11QLpa3taRSiUSCzqaWHxjhmUKKSk6', 'staff', 1, '2020-05-22 15:52:36', '2020-05-22 14:52:36'),
(42, 'manager1', 'manager', '$2a$07$asxx54ahjppf45sd87a5auwsi2br/08hc1xNsiOS4IsP9cvjEnECi', 'manager', 1, '2020-05-22 15:53:32', '2020-05-22 14:53:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `open_tables`
--
ALTER TABLE `open_tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `open_tables`
--
ALTER TABLE `open_tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
