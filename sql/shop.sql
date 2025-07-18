-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2025 at 07:41 AM
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
  `phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `quantity`, `price`, `created_at`, `payment_method`, `fullname`, `address`, `city`, `pincode`, `phone`) VALUES
(1, 3, 3, 5439.00, '2025-07-09 11:27:28', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 3, 5, 27195.00, '2025-07-10 11:32:01', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 4, 1, 3209.28, '2025-07-11 11:32:10', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 3, 1, 5439.00, '2025-07-12 11:36:45', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 15, 7, 37730.00, '2025-07-13 12:27:55', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 15, 1, 5390.00, '2025-07-14 12:30:39', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 15, 2, 10780.00, '2025-07-14 12:44:55', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 1, 1, 5225.00, '2025-07-16 10:19:39', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 1, 1, 5225.00, '2025-07-16 15:40:42', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 1, 1, 5225.00, '2025-07-16 16:33:53', NULL, NULL, NULL, NULL, NULL, NULL),
(11, 1, 1, 5225.00, '2025-07-16 16:38:17', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 0, 1, 5280.00, '2025-07-17 10:34:33', 'upi', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '09677929212'),
(13, 0, 1, 5280.00, '2025-07-17 10:35:05', 'Cash on Delivery', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', 'lfjkdkfnkdjf'),
(14, 0, 1, 5280.00, '2025-07-17 10:44:17', NULL, NULL, NULL, NULL, NULL, NULL),
(15, 0, 1, 5280.00, '2025-07-17 10:52:23', NULL, NULL, NULL, NULL, NULL, NULL),
(16, 0, 1, 5280.00, '2025-07-17 10:54:09', NULL, NULL, NULL, NULL, NULL, NULL),
(17, 0, 1, 5280.00, '2025-07-17 11:02:22', 'Cash on Delivery', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '9677929212'),
(18, NULL, 1, NULL, '2025-07-17 11:03:53', 'Cash on Delivery', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '9677929212'),
(19, NULL, 1, NULL, '2025-07-17 11:04:23', 'upi', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '9677929212'),
(20, NULL, 1, NULL, '2025-07-17 14:27:26', 'upi', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '9677929212'),
(21, NULL, 1, NULL, '2025-07-17 14:27:47', 'card', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '9677929212'),
(22, NULL, 1, NULL, '2025-07-17 14:30:36', 'upi', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '9677929212'),
(23, NULL, 1, NULL, '2025-07-17 14:34:03', 'upi', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '9677929212'),
(24, NULL, 1, NULL, '2025-07-17 14:37:33', 'upi', 'Mayileshwaran', '1-8-17/13, West kottai cross Street, Paravai', 'Madurai', '625402', '9677929212');

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
  `quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `discount_percent`, `type`, `brand`, `image_path`, `quantity`) VALUES
(0, 'Test', 5500.00, 4, 'kids', 'omega', '6874b8ce3f636.jpg', 43),
(1, 'Test', 5500.00, 5, 'mens', 'rolex', '6874aef3e89d6.png', 49),
(17, 'brishless watch', 777.00, 1, 'womens', 'rolex', NULL, 43);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin123', 'admin'),
(2, 'mayileshwaran', 'mayileshwaran2005@gmail.com', 'mayilesh03', 'user'),
(3, 'Test', 'test@gmail.com', 'test123', 'user'),
(6, 'test', 'tester@gmail.com', 'test123', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
