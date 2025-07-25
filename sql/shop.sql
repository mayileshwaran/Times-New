-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2025 at 05:34 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `payment_method` varchar(50) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `quantity`, `price`, `created_at`, `payment_method`, `fullname`, `address`, `city`, `pincode`, `phone`, `user_id`) VALUES
(1, 3, 3, 5439.00, '2025-07-09 11:27:28', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(2, 3, 5, 5000.00, '2025-07-10 11:32:01', NULL, NULL, NULL, NULL, NULL, NULL, 2),
(3, 4, 1, 3209.28, '2025-07-11 11:32:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 3, 1, 5439.00, '2025-07-12 11:36:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 15, 7, 1000.00, '2025-07-13 12:27:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 15, 1, 5390.00, '2025-07-14 12:30:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 15, 2, 10780.00, '2025-07-14 12:44:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 1, 1, 5225.00, '2025-07-16 10:19:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 1, 1, 5225.00, '2025-07-16 15:40:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 1, 1, 5225.00, '2025-07-16 16:33:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 1, 1, 5225.00, '2025-07-16 16:38:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 0, 1, 5280.00, '2025-07-17 10:34:33', 'upi', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '09677929212', NULL),
(13, 0, 1, 5280.00, '2025-07-17 10:35:05', 'Cash on Delivery', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', 'lfjkdkfnkdjf', NULL),
(14, 0, 1, 5280.00, '2025-07-17 10:44:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 0, 1, 5280.00, '2025-07-17 10:52:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 0, 1, 5280.00, '2025-07-17 10:54:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 0, 1, 5280.00, '2025-07-17 11:02:22', 'Cash on Delivery', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '9677929212', NULL),
(18, NULL, 1, NULL, '2025-07-17 11:03:53', 'Cash on Delivery', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '9677929212', NULL),
(19, NULL, 1, NULL, '2025-07-17 11:04:23', 'upi', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '9677929212', NULL),
(20, NULL, 1, NULL, '2025-07-17 14:27:26', 'upi', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '9677929212', NULL),
(21, NULL, 1, NULL, '2025-07-17 14:27:47', 'card', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '9677929212', NULL),
(22, NULL, 1, NULL, '2025-07-17 14:30:36', 'upi', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '9677929212', NULL),
(23, NULL, 1, NULL, '2025-07-17 14:34:03', 'upi', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '9677929212', NULL),
(24, NULL, 1, NULL, '2025-07-17 14:37:33', 'upi', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '9677929212', NULL),
(25, NULL, 1, NULL, '2025-07-18 14:55:36', 'Cash on Delivery', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '9677929212', 2),
(26, NULL, 1, NULL, '2025-07-18 16:03:11', 'Cash on Delivery', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '9677929212', NULL),
(27, NULL, 1, NULL, '2025-07-18 18:56:07', 'Cash on Delivery', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '9677929212', NULL),
(28, NULL, 1, NULL, '2025-07-18 19:45:41', 'Cash on Delivery', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '9677929212', NULL),
(29, NULL, 1, NULL, '2025-07-18 19:52:11', 'Cash on Delivery', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '9677929212', 2),
(30, NULL, 1, NULL, '2025-07-18 19:53:04', 'Cash on Delivery', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '9677929212', 2),
(31, NULL, 1, NULL, '2025-07-18 19:54:52', 'Cash on Delivery', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '9677929212', 2),
(32, NULL, 1, NULL, '2025-07-18 20:10:18', 'upi', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '9677929212', 2),
(33, 0, 1, 5280.00, '2025-07-18 20:21:25', 'Cash on Delivery', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '9677929212', 2),
(34, 0, 2, 5280.00, '2025-07-23 10:58:17', 'Cash on Delivery', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '9677929212', 1),
(35, 25, 1, 4500.00, '2025-07-24 14:53:19', 'Cash on Delivery', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '9677929212', 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount_percent` int(11) DEFAULT 0,
  `type` varchar(100) DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `discount_percent`, `type`, `brand`, `image_path`, `quantity`, `status`) VALUES
(0, 'kid roman watch', 5500.00, 4, 'kids', 'omega', '6874b8ce3f636.jpg', 39, 'active'),
(1, 'Mens royal watch', 5500.00, 5, 'mens', 'rolex', '6874aef3e89d6.png', 43, 'active'),
(17, 'brishless watch', 777.00, 1, 'womens', 'rolex', NULL, 43, 'active'),
(18, 'Kids stylish watch ', 7000.00, 0, 'kids', 'rolex', '687a10065da5a.png', 54, 'active'),
(19, 'Seamaster Diver 300M', 637200.00, 20, 'boys', 'omega', '688097d213a2e.avif', 10, 'active'),
(20, 'Rolex Trending Smart Watch', 7500.00, 35, 'smart', 'rolex', '6881cf64b3a62.webp', 55, 'active'),
(21, 'Golden Stainless Steel  Couple Watch', 2000.00, 10, 'couple', 'rolex', '6881d051536d9.webp', 100, 'active'),
(22, ' Round Dial Wrist Watch', 1500.00, 10, 'boys', 'rolex', '6881d0d89edca.webp', 55, 'inactive'),
(23, ' Constellation Men\'s Watch', 20000.00, 45, 'mens', 'omega', '6881d1c0eddaf.jpeg', 68, 'active'),
(24, 'Rose Gold Party Wear Watch', 12000.00, 10, 'womens', 'omega', '6881d25dc72dd.png', 88, 'active'),
(25, ' AeoFit , Fitness & Sports watch', 4500.00, 0, 'smart', 'omega', '6881d2c2ce5ba.jpg', 52, 'active'),
(26, 'Round Luxury(Premium)', 6000.00, 20, 'boys', 'omega', '6881d40a99a24.jpeg', 75, 'active'),
(27, 'STAINLESS STEEL BRACELET WATCH', 20000.00, 1, 'mens', 'citizen', '6881d4b5d9835.webp', 100, 'active'),
(28, 'CITIZEN QUARTZ  WHITE DIAL', 12900.00, 20, 'womens', 'citizen', '6881d564ad847.png', 50, 'active'),
(29, 'Citizen Smart AXIOM', 23000.00, 0, 'smart', 'citizen', '6881d5cdb0d23.jpg', 65, 'active'),
(30, 'Citizen AO3010-05E Watch', 8000.00, 15, 'boys', 'citizen', '6881d63c2dea6.jpg', 90, 'active'),
(31, 'Gold Black Down Date  Couple Watch', 20000.00, 35, 'couple', 'citizen', '6881d7020a7c8.webp', 150, 'active'),
(32, 'Golden Cartier Automatic Watch', 5000.00, 20, 'mens', 'cartier', '6881d75c885ee.jpeg', 89, 'active'),
(33, 'Panthere de Cartier watch', 315000.00, 0, 'womens', 'cartier', '6881d7de3ce5b.webp', 53, 'active'),
(34, 'Cartier wrist couple watch rosegold', 10000.00, 30, 'couple', 'cartier', '6881d824aa146.webp', 24, 'active'),
(35, ' Steel Strip  Waterproof  Watch', 3873.00, 0, 'smart', 'cartier', '6881d9068a9e7.webp', 54, 'active'),
(36, 'Astro Kids Blue Digital  Strap', 3630.00, 50, 'kids', 'cartier', '6881d9bb2ba4a.webp', 43, 'active'),
(37, 'BALLON BLEU DE , LEATHER', 100000.00, 30, 'boys', 'cartier', '6881da287b975.webp', 44, 'active'),
(38, 'Omega  Couple Watch', 15000.00, 20, 'couple', 'omega', '6881db90f197e.jpg', 55, 'active'),
(39, 'Night Kids Toy Watch', 4318.00, 0, 'kids', 'citizen', '6881dc0d7228a.avif', 150, 'active'),
(40, 'My watch', 150000.00, 10, 'mens', 'rolex', '6883653bcf6a9.webp', 10, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `query`
--

CREATE TABLE `query` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `query`
--

INSERT INTO `query` (`id`, `name`, `email`, `phone`, `message`, `created_at`) VALUES
(1, 'Mayileshwaran', 'mayileshwaran2005@gmail.com', '9677929212', 'The timesnew gives best experience', '2025-07-24 05:41:51'),
(2, 'Mayileshwaran', 'mayileshwaran2005@gmail.com', '9677929212', 'The timesnew gives best experience', '2025-07-24 05:42:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('superadmin','admin','user') NOT NULL DEFAULT 'user',
  `status` varchar(10) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `status`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin123', 'superadmin', 'active'),
(2, 'mayileshwaran', 'mayileshwaran2005@gmail.com', 'mayilesh03', 'user', 'active'),
(3, 'Test', 'test@gmail.com', 'test123', 'user', 'active'),
(6, 'test', 'tester@gmail.com', 'test123', 'user', 'active'),
(7, 'mayil', 'mayil@gmail.com', '123456', 'user', 'active'),
(8, 'Sakthi', 'sakthi@gmail.com', '123456', 'user', 'active'),
(9, 'arjun', 'arjun@gmail.com', 'arjun123', 'admin', 'active'),
(12, 'vijay', 'vijay@gmail.com', 'vijay123', 'admin', 'active'),
(13, 'ajith', 'ajith@gmail.com', '123456', 'user', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `query`
--
ALTER TABLE `query`
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
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `query`
--
ALTER TABLE `query`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
