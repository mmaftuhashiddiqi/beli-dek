-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2023 at 08:44 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(10) NOT NULL,
  `admin_fullname` varchar(100) DEFAULT NULL,
  `admin_username` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_fullname`, `admin_username`, `admin_password`) VALUES
(1, 'Admin A', 'admina', '$2y$10$ZXBJqmvS7bSdD1M6bI2z5uk.SJirEPd84FP8fn77N9xfVFDaY42si'),
(2, 'Admin B', 'adminb', '$2y$10$sD2pubs3hb3SewjdmankQ.A4Hto3F2iplvY5Z8FMd9PLX25TzMPq2'),
(3, 'Admin C', 'adminc', '$2y$10$JSWZVURbg.mx44wMIgPiY.utqcxeGjAR/Nk9mYI00qvv.YA30nVTu');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `product_count` int(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) NOT NULL,
  `order_date` datetime NOT NULL,
  `user_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `product_count` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) NOT NULL,
  `product_brand` varchar(50) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_stock` int(10) NOT NULL,
  `product_price` int(20) NOT NULL,
  `product_image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_brand`, `product_name`, `product_stock`, `product_price`, `product_image`) VALUES
(1, 'Acer', 'Acer Swift X 16', 20, 18554875, 'laptop-template.png'),
(2, 'Acer', 'Acer Swift 14', 20, 18499000, 'laptop-template.png'),
(3, 'Acer', 'Acer Swift X 14', 20, 14749000, 'laptop-template.png'),
(4, 'Acer', 'Acer Swift Go', 20, 11020000, 'laptop-template.png'),
(5, 'Acer', 'Acer Swift Go 14 AMD', 20, 11444646, 'laptop-template.png'),
(6, 'Acer', 'Acer Aspire 3 Intel', 20, 3899000, 'laptop-template.png'),
(7, 'Acer', 'Acer Aspire 3 AMD', 20, 4799000, 'laptop-template.png'),
(8, 'Acer', 'Acer Aspire 5 Intel', 20, 8199000, 'laptop-template.png'),
(9, 'Acer', 'Acer Aspire 5 AMD', 20, 8999000, 'laptop-template.png'),
(10, 'Acer', 'Acer Aspire 3 Spin 14', 20, 5699000, 'laptop-template.png'),
(11, 'Asus', 'Asus Vivobook Ultra 14 K413', 10, 13499000, 'laptop-template.png'),
(12, 'Asus', 'Asus Vivobook 14X OLED', 10, 12799000, 'laptop-template.png'),
(13, 'Asus', 'Asus Vivobook 13 Slate OLED', 10, 11499000, 'laptop-template.png'),
(14, 'Asus', 'Asus Vivobook 14', 10, 10999000, 'laptop-template.png'),
(15, 'Asus', 'Asus Vivobook 15 OLED', 10, 10999000, 'laptop-template.png'),
(16, 'Asus', 'Asus Zenbook 14X OLED Space Edition', 15, 25999000, 'laptop-template.png'),
(17, 'Asus', 'Asus Zenbook 14 Ultralight', 15, 20999000, 'laptop-template.png'),
(18, 'Asus', 'Asus Zenbook 14X OLED', 15, 18499000, 'laptop-template.png'),
(19, 'Asus', 'Asus Zenbook 14 OLED', 15, 17499000, 'laptop-template.png'),
(20, 'Asus', 'Asus Zenbook 13 OLED', 15, 13621719, 'laptop-template.png'),
(21, 'Apple', 'MacBook Air M1', 10, 14696438, 'laptop-template.png'),
(22, 'Apple', 'MacBook Air M2', 10, 17638668, 'laptop-template.png'),
(23, 'Apple', 'MacBook Pro 13 M2', 10, 19109783, 'laptop-template.png'),
(24, 'Apple', 'MacBook Pro 14 M2', 10, 29407588, 'laptop-template.png'),
(25, 'Apple', 'MacBook Pro 16 M2', 10, 36763163, 'laptop-template.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `user_fullname` varchar(100) DEFAULT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_phone` varchar(15) DEFAULT NULL,
  `user_address` varchar(200) DEFAULT NULL,
  `user_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_fullname`, `user_username`, `user_phone`, `user_address`, `user_password`) VALUES
(1, 'User A', 'usera', '087654321', 'Jl. Colombo Yogyakarta No.1', '$2y$10$0W3TQolgR2PbiGA/kXgvoedt0lJiFskfbmje.qrN3pOA4U3a64T6a'),
(2, 'User B', 'userb', '087654321', 'Jl. Colombo Yogyakarta No.2', '$2y$10$i8BHjjex7jRMZdHq1su/6eYloCulHj0I1S56e5sRDdeUXynSd28oO'),
(3, 'User C', 'userc', '087654321', 'Jl. Colombo Yogyakarta No.3', '$2y$10$38cyD00LRQNfkQOaVvn0xuYeKpsVtH4uDnwUCZtc63mnn4NgDXr72');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `wishlist_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `product_count` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `wishlist_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `wishlists_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
