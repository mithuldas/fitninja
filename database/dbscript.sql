-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2020 at 11:14 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `FuNinja`
--
CREATE DATABASE IF NOT EXISTS `FuNinja` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `FuNinja`;

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
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `selector` text NOT NULL,
  `token` longtext NOT NULL,
  `expiry` text NOT NULL,
  `type` tinytext NOT NULL
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
  `ext_email` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `user_type_id`, `email`, `password`, `email_verified`, `reg_dt`, `source`, `ext_email`) VALUES
(119, 'mithuldas', 3, 'mithuldas@gmail.com', '$2y$10$WcGL0cTjzlRfLUtD6oj6JuHwb70r.XnZ.qW2dFVvWQ5y27T0KACLW', 'Y', '2020-10-27 03:27:35', 'Web', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_attributes`
--

CREATE TABLE `user_attributes` (
  `uid` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `attribute_value` varchar(64) NOT NULL
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
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

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
COMMIT;
