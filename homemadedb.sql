-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2024 at 03:03 PM
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
-- Database: `homemadedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `m_id` int(11) NOT NULL,
  `r_id` int(11) NOT NULL,
  `m_name` varchar(255) NOT NULL,
  `m_price` int(11) NOT NULL,
  `m_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`m_id`, `r_id`, `m_name`, `m_price`, `m_type`) VALUES
(1, 2, 'Grilled Halloumi & Quinoa Salad', 160, 'Veg'),
(2, 2, 'Korean BBQ Chicken Tacos', 240, 'Non-Veg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `sl_no` int(11) NOT NULL,
  `r_id` int(100) NOT NULL,
  `order_id` int(10) NOT NULL,
  `dt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `name` varchar(20) NOT NULL,
  `user_id` int(100) NOT NULL,
  `order` varchar(2250) NOT NULL,
  `amount` int(5) NOT NULL,
  `address` varchar(625) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `payment` varchar(7) NOT NULL,
  `order_status` varchar(20) NOT NULL,
  `rating` decimal(10,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `r_id` int(11) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_email` varchar(255) NOT NULL,
  `p_about` varchar(2555) NOT NULL,
  `p_password` varchar(255) NOT NULL,
  `r_bg` varchar(9999) NOT NULL,
  `p_phone` varchar(255) NOT NULL,
  `p_image` varchar(999) NOT NULL,
  `r_name` varchar(255) NOT NULL,
  `r_rating` varchar(3) NOT NULL,
  `r_cuisine` varchar(255) NOT NULL,
  `r_pincode` varchar(6) NOT NULL,
  `reset_code` varchar(625) NOT NULL,
  `account_status` varchar(625) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`r_id`, `p_name`, `p_email`, `p_about`, `p_password`, `r_bg`, `p_phone`, `p_image`, `r_name`, `r_rating`, `r_cuisine`, `r_pincode`, `reset_code`, `account_status`) VALUES
(2, 'Vendor Name', 'aftereditofficial@gmail.com', 'Eclipse Global Kitchen brings the world to your plate, blending the vibrant flavors of different cultures into one unforgettable dining experience. Our chefs expertly fuse elements from Asian, European, Latin American, and African cuisines, creating innovative dishes that celebrate global diversity. Whether you\'re craving a spicy street food-inspired dish or a sophisticated fusion of French and Japanese techniques, Eclipse offers a dynamic menu that evolves with the seasons and trends. Join us for a culinary journey around the globe, where every meal is an adventure.', '$2y$10$LQHI87mxEOgERMNJjR9zvuJuUcHbQjQ93qIpQmxhL0LwmXGazEkFu', 'restaurant/cover/img1.jpg', '8899889988', 'restaurant/img2.jpg', 'Eclipse Global Kitchen', '', 'Global Fusion Cuisine', '560016', '0', 'Verified');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(625) NOT NULL,
  `phone` int(15) NOT NULL,
  `resetcode` varchar(695) NOT NULL,
  `account_status` varchar(15) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
