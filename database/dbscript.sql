-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2020 at 12:41 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `fitninja`
--
CREATE DATABASE IF NOT EXISTS `fitninja` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fitninja`;

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext DEFAULT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` tinytext NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `email` tinytext NOT NULL,
  `password` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `user_type_id`, `email`, `password`) VALUES
(1, 'mithuldas', 2, 'mithuldas@gmail.com', '$2y$10$fLFeKWxVxrBnjo/vlpYNaOzav4ro1PgZRpgCq2sG3SmAmr1E3lUJe'),
(3, 'trainertest', 1, 'trainertest@gmail.com', '$2y$10$B6cO1n7NMC6m1beTnYxOc.6reLeMuZ.lbQ4ms5cSUJPwTaqzivhTS'),
(4, 'admin', 3, 'admin@gmail.com', '$2y$10$ex3Gnd9qfJvG9CIYQuRi8.uh8FFz/caKpUrhMhd83auRDsGZAXUa.');

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
(1, 'first_name'),
(2, 'last_name'),
(4, 'phone_number');

-- --------------------------------------------------------

--
-- Table structure for table `user_attribute_values`
--

CREATE TABLE `user_attribute_values` (
  `uid` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `attribute_value` tinytext NOT NULL
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
-- Indexes for table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `fk_users_user_types.user_type_id` (`user_type_id`);

--
-- Indexes for table `user_attribute_definitions`
--
ALTER TABLE `user_attribute_definitions`
  ADD PRIMARY KEY (`attribute_id`),
  ADD UNIQUE KEY `attribute_ame` (`attribute_name`);

--
-- Indexes for table `user_attribute_values`
--
ALTER TABLE `user_attribute_values`
  ADD PRIMARY KEY (`uid`,`attribute_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_attribute_definitions`
--
ALTER TABLE `user_attribute_definitions`
  MODIFY `attribute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_user_types.user_type_id` FOREIGN KEY (`user_type_id`) REFERENCES `user_types` (`user_type_id`);

--
-- Constraints for table `user_attribute_values`
--
ALTER TABLE `user_attribute_values`
  ADD CONSTRAINT `user_attribute_values_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `user_attribute_definitions` (`attribute_id`),
  ADD CONSTRAINT `user_attribute_values_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);
COMMIT;
