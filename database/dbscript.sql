-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2020 at 07:45 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `funinja`
--
CREATE DATABASE IF NOT EXISTS `funinja` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `funinja`;

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

CREATE TABLE `interests` (
  `id` int(11) NOT NULL,
  `interest` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `interests`
--

INSERT INTO `interests` (`id`, `interest`) VALUES
(1, 'aerobics'),
(2, 'zumba'),
(3, 'yoga'),
(4, 'meditation'),
(5, 'reiki'),
(6, 'calisthenics'),
(7, 'toning');

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
(1, 'Trial'),
(2, 'Aerobics'),
(3, 'Zumba'),
(4, 'Calisthenics'),
(5, 'Yoga'),
(6, 'Meditation'),
(7, 'Reiki');

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
(2, 1, 'Y', '2020-11-10 00:00:00', NULL),
(3, 1, 'Y', '2020-11-10 00:00:00', NULL),
(4, 1, 'Y', '2020-11-10 00:00:00', NULL),
(5, 1, 'Y', '2020-11-10 00:00:00', NULL),
(6, 1, 'Y', '2020-11-10 00:00:00', NULL),
(7, 1, 'Y', '2020-11-10 00:00:00', NULL);

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
(1, 'available_for_trial');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `sequence` int(11) NOT NULL,
  `user_product_id` int(11) NOT NULL,
  `planned_trainers` int(11) NOT NULL,
  `planned_trainees` int(11) NOT NULL,
  `filled_trainers` int(11) NOT NULL,
  `filled_trainees` int(11) NOT NULL,
  `notes` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `session_attributes`
--

CREATE TABLE `session_attributes` (
  `session_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `attribute_value` varchar(64) NOT NULL,
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
(3, 'preferredTrialTimeSlot');

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
  `creation_dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `reg_dt` datetime NOT NULL DEFAULT current_timestamp(),
  `source` varchar(64) DEFAULT NULL,
  `ext_name` varchar(64) DEFAULT NULL
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
(2, 'last_name'),
(4, 'phone_number'),
(7, 'trainee_onboarding_completed');

-- --------------------------------------------------------

--
-- Table structure for table `user_interests`
--

CREATE TABLE `user_interests` (
  `uid` int(11) NOT NULL,
  `interest_id` int(11) NOT NULL,
  `str_dt` date NOT NULL,
  `end_dt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_products`
--

CREATE TABLE `user_products` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
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
-- Indexes for table `interests`
--
ALTER TABLE `interests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`sequence`,`user_product_id`),
  ADD KEY `user_product_id` (`user_product_id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `fk_users_user_types.user_type_id` (`user_type_id`);

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
-- Indexes for table `user_interests`
--
ALTER TABLE `user_interests`
  ADD UNIQUE KEY `uid` (`uid`,`interest_id`,`str_dt`),
  ADD KEY `interest_id` (`interest_id`);

--
-- Indexes for table `user_products`
--
ALTER TABLE `user_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`uid`,`product_id`,`valid_from`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `interests`
--
ALTER TABLE `interests`
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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD CONSTRAINT `product_attributes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_attributes_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attribute_definitions` (`id`);

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`user_product_id`) REFERENCES `user_products` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_user_types.user_type_id` FOREIGN KEY (`user_type_id`) REFERENCES `user_types` (`user_type_id`);

--
-- Constraints for table `user_attributes`
--
ALTER TABLE `user_attributes`
  ADD CONSTRAINT `user_attributes_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `user_attributes_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `user_attribute_definitions` (`attribute_id`);

--
-- Constraints for table `user_interests`
--
ALTER TABLE `user_interests`
  ADD CONSTRAINT `user_interests_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `user_interests_ibfk_2` FOREIGN KEY (`interest_id`) REFERENCES `interests` (`id`);

--
-- Constraints for table `user_products`
--
ALTER TABLE `user_products`
  ADD CONSTRAINT `user_products_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `user_products_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);
COMMIT;
