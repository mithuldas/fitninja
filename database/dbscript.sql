-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 15, 2020 at 01:36 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `funinja`
--
CREATE DATABASE IF NOT EXISTS `funinja` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `funinja`;

-- --------------------------------------------------------

--
-- Table structure for table `activity_types`
--

CREATE TABLE `activity_types` (
  `id` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `description` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_types`
--

INSERT INTO `activity_types` (`id`, `name`, `description`) VALUES
(1, 'Aerobics', NULL),
(2, 'Zumba', NULL),
(3, 'Yoga', NULL),
(4, 'Slimnastics', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `product_price_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `comments` varchar(512) DEFAULT NULL,
  `external_id` varchar(512) NOT NULL COMMENT 'id returned by payment gateway vendor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`) VALUES
(4, 'All Access'),
(2, 'Basic'),
(5, 'Couple'),
(3, 'Standard'),
(1, 'Trial');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `product_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `attribute_value` varchar(64) NOT NULL,
  `valid_from` datetime NOT NULL,
  `valid_to` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`product_id`, `attribute_id`, `attribute_value`, `valid_from`, `valid_to`) VALUES
(1, 2, '1', '2020-11-24 00:00:00', NULL),
(1, 4, '60', '2020-11-24 00:00:00', NULL),
(2, 2, '10', '2020-11-24 00:00:00', NULL),
(2, 4, '60', '2020-11-24 00:00:00', NULL),
(3, 2, '20', '2020-11-24 00:00:00', NULL),
(3, 4, '60', '2020-11-24 00:00:00', NULL),
(4, 2, '20', '2020-11-24 00:00:00', NULL),
(4, 4, '60', '2020-11-24 00:00:00', NULL),
(5, 2, '20', '2020-11-24 00:00:00', NULL),
(5, 4, '60', '2020-11-24 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute_definitions`
--

CREATE TABLE `product_attribute_definitions` (
  `id` int(11) NOT NULL,
  `attribute_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_attribute_definitions`
--

INSERT INTO `product_attribute_definitions` (`id`, `attribute_name`) VALUES
(1, 'valid for trial'),
(2, 'number of sessions'),
(3, 'valid days'),
(4, 'default session duration');

-- --------------------------------------------------------

--
-- Table structure for table `product_prices`
--

CREATE TABLE `product_prices` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `valid_from` datetime NOT NULL,
  `valid_to` datetime DEFAULT NULL,
  `currency` varchar(10) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_prices`
--

INSERT INTO `product_prices` (`id`, `product_id`, `valid_from`, `valid_to`, `currency`, `amount`) VALUES
(1, 2, '2020-11-21 10:11:31', NULL, 'INR', 1),
(2, 3, '2020-11-21 10:11:56', NULL, 'INR', 2),
(3, 4, '2020-11-21 10:12:09', NULL, 'INR', 3),
(4, 5, '2020-11-21 10:12:25', NULL, 'INR', 4);

-- --------------------------------------------------------

--
-- Table structure for table `qualifications`
--

CREATE TABLE `qualifications` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `activity_type_id` int(11) NOT NULL,
  `valid_from` datetime NOT NULL,
  `valid_to` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `qualifications`
--

INSERT INTO `qualifications` (`id`, `uid`, `activity_type_id`, `valid_from`, `valid_to`) VALUES
(1, 2, 1, '2020-12-06 00:00:00', NULL),
(2, 2, 2, '2020-12-06 00:00:00', NULL),
(4, 2, 4, '2020-12-06 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `sequence` int(11) NOT NULL,
  `user_product_id` int(11) NOT NULL,
  `sch_dt_tm` datetime DEFAULT NULL,
  `duration` int(11) NOT NULL,
  `activity_type_id` int(11) DEFAULT NULL,
  `planned_trainers` int(11) NOT NULL,
  `planned_trainees` int(11) NOT NULL,
  `filled_trainers` int(11) NOT NULL,
  `filled_trainees` int(11) NOT NULL,
  `notes` varchar(512) DEFAULT NULL,
  `creation_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `completed` varchar(1) DEFAULT NULL COMMENT 'Y if completed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `session_attributes`
--

CREATE TABLE `session_attributes` (
  `session_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `attribute_value` varchar(1024) NOT NULL,
  `valid_from` datetime NOT NULL,
  `valid_to` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `session_attribute_definitions`
--

CREATE TABLE `session_attribute_definitions` (
  `attribute_id` int(11) NOT NULL,
  `attribute_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `session_attribute_definitions`
--

INSERT INTO `session_attribute_definitions` (`attribute_id`, `attribute_name`) VALUES
(1, 'preferredTrialType'),
(2, 'preferredTrialDate'),
(3, 'preferredTrialTimeSlot'),
(4, 'Zoom Join URL'),
(5, 'Zoom Start URL'),
(6, 'duration'),
(7, 'trialRequestComments');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `selector` text NOT NULL,
  `token` longtext NOT NULL,
  `expiry` text NOT NULL,
  `type` tinytext NOT NULL,
  `creation_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `external_id` varchar(512) NOT NULL,
  `method` varchar(64) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comments` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_types`
--

CREATE TABLE `transaction_types` (
  `id` int(11) NOT NULL,
  `type` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_types`
--

INSERT INTO `transaction_types` (`id`, `type`) VALUES
(1, 'payment'),
(2, 'refund');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` longtext NOT NULL,
  `email_verified` tinytext NOT NULL,
  `reg_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `source` varchar(64) DEFAULT NULL,
  `ext_name` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `user_type_id`, `email`, `password`, `email_verified`, `reg_dt`, `source`, `ext_name`) VALUES
(1, 'admin', 3, 'admin@admin.com', '$2y$10$S3qhUssWxwrgUBCl0tIW2OHvyZ1z.U0QGXVbmhDrp3FnFT5sEEo/W', 'Y', '2020-11-28 19:42:41', 'Web', NULL),
(2, 'trainer', 1, 'funinja.in@gmail.com', '$2y$10$rvX2xCfWdF9EcXQl0eqCIuMlXTQc/B3yLqCKBEW0ipkeFppWnNxoy', 'Y', '2020-11-28 20:00:16', 'Web', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_assignments`
--

CREATE TABLE `user_assignments` (
  `id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `delete_ind` varchar(2) NOT NULL,
  `notified` varchar(1) NOT NULL COMMENT 'Y if link / SMS is sent to the user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_attributes`
--

CREATE TABLE `user_attributes` (
  `uid` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `attribute_value` varchar(64) NOT NULL,
  `valid_from` datetime NOT NULL,
  `valid_to` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_attributes`
--

INSERT INTO `user_attributes` (`uid`, `attribute_id`, `attribute_value`, `valid_from`, `valid_to`) VALUES
(2, 1, 'Harish', '2020-11-28 00:00:00', NULL),
(2, 2, 'Kumar', '2020-11-28 00:00:00', NULL),
(2, 3, 'Mumbai', '2020-11-28 00:00:00', NULL),
(2, 4, '987654321', '2020-11-28 00:00:00', NULL),
(2, 5, '1-Jan-1980', '2020-11-28 00:00:00', NULL),
(2, 6, 'Male', '2020-11-28 00:00:00', NULL),
(2, 8, 'funinja.in@gmail.com', '2020-11-28 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_attribute_definitions`
--

CREATE TABLE `user_attribute_definitions` (
  `attribute_id` int(11) NOT NULL,
  `attribute_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_attribute_definitions`
--

INSERT INTO `user_attribute_definitions` (`attribute_id`, `attribute_name`) VALUES
(3, 'city'),
(5, 'date_of_birth'),
(1, 'first_name'),
(6, 'gender'),
(9, 'interested activities'),
(2, 'last_name'),
(4, 'phone_number'),
(7, 'trainee_onboarding_completed'),
(8, 'Zoom ID');

-- --------------------------------------------------------

--
-- Table structure for table `user_products`
--

CREATE TABLE `user_products` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `valid_from` datetime NOT NULL,
  `valid_to` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `user_type_id` int(11) NOT NULL,
  `user_type_desc` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`user_type_id`, `user_type_desc`) VALUES
(1, 'Trainer'),
(2, 'Trainee'),
(3, 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_types`
--
ALTER TABLE `activity_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `product_price_id` (`product_price_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`product_id`,`attribute_id`,`valid_from`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `product_attribute_definitions`
--
ALTER TABLE `product_attribute_definitions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_prices`
--
ALTER TABLE `product_prices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`,`valid_from`,`currency`);

--
-- Indexes for table `qualifications`
--
ALTER TABLE `qualifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_type_id` (`activity_type_id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sequence` (`sequence`,`user_product_id`),
  ADD KEY `user_product_id` (`user_product_id`),
  ADD KEY `activity_type_id` (`activity_type_id`);

--
-- Indexes for table `session_attributes`
--
ALTER TABLE `session_attributes`
  ADD PRIMARY KEY (`session_id`,`attribute_id`,`valid_from`),
  ADD UNIQUE KEY `session_id` (`session_id`,`attribute_id`,`valid_from`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `session_attribute_definitions`
--
ALTER TABLE `session_attribute_definitions`
  ADD PRIMARY KEY (`attribute_id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `transaction_types`
--
ALTER TABLE `transaction_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type` (`type`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `fk_users_user_types.user_type_id` (`user_type_id`);

--
-- Indexes for table `user_assignments`
--
ALTER TABLE `user_assignments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `session_id` (`session_id`,`uid`,`delete_ind`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `user_attributes`
--
ALTER TABLE `user_attributes`
  ADD PRIMARY KEY (`uid`,`attribute_id`,`valid_from`),
  ADD KEY `uid` (`uid`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `user_attribute_definitions`
--
ALTER TABLE `user_attribute_definitions`
  ADD PRIMARY KEY (`attribute_id`),
  ADD UNIQUE KEY `attribute_ame` (`attribute_name`);

--
-- Indexes for table `user_products`
--
ALTER TABLE `user_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`uid`,`product_id`,`valid_from`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_types`
--
ALTER TABLE `activity_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_attribute_definitions`
--
ALTER TABLE `product_attribute_definitions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_prices`
--
ALTER TABLE `product_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qualifications`
--
ALTER TABLE `qualifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `session_attribute_definitions`
--
ALTER TABLE `session_attribute_definitions`
  MODIFY `attribute_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_types`
--
ALTER TABLE `transaction_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_assignments`
--
ALTER TABLE `user_assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_attribute_definitions`
--
ALTER TABLE `user_attribute_definitions`
  MODIFY `attribute_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_products`
--
ALTER TABLE `user_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_price_id`) REFERENCES `product_prices` (`id`);

--
-- Constraints for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD CONSTRAINT `product_attributes_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attribute_definitions` (`id`),
  ADD CONSTRAINT `product_attributes_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_prices`
--
ALTER TABLE `product_prices`
  ADD CONSTRAINT `product_prices_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `qualifications`
--
ALTER TABLE `qualifications`
  ADD CONSTRAINT `qualifications_ibfk_1` FOREIGN KEY (`activity_type_id`) REFERENCES `activity_types` (`id`),
  ADD CONSTRAINT `qualifications_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`user_product_id`) REFERENCES `user_products` (`id`),
  ADD CONSTRAINT `sessions_ibfk_2` FOREIGN KEY (`activity_type_id`) REFERENCES `activity_types` (`id`);

--
-- Constraints for table `session_attributes`
--
ALTER TABLE `session_attributes`
  ADD CONSTRAINT `session_attributes_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`),
  ADD CONSTRAINT `session_attributes_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `session_attribute_definitions` (`attribute_id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `transaction_types` (`id`),
  ADD CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_user_types.user_type_id` FOREIGN KEY (`user_type_id`) REFERENCES `user_types` (`user_type_id`);

--
-- Constraints for table `user_assignments`
--
ALTER TABLE `user_assignments`
  ADD CONSTRAINT `user_assignments_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`),
  ADD CONSTRAINT `user_assignments_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);

--
-- Constraints for table `user_attributes`
--
ALTER TABLE `user_attributes`
  ADD CONSTRAINT `user_attributes_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `user_attributes_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `user_attribute_definitions` (`attribute_id`);

--
-- Constraints for table `user_products`
--
ALTER TABLE `user_products`
  ADD CONSTRAINT `user_products_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `user_products_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `user_products_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);
