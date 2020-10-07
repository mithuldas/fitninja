
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;

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
  `user_type` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `password` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `user_type`, `email`, `password`) VALUES
(1, 'mithuldas', 'C', 'mithuldas@gmail.com', '$2y$10$8zvs2dxsfiMCH6DqxF.jwee27r0Mqubs6jE4tXiwuYXySvqN8GxS.'),
(4, '122', 'C', '122@gmail.com', '$2y$10$eRglmSLZVH1QWcn699vscuCR60GSvZ1m5ZZtxJUHfjb1e6iFh3.T2'),
(5, '1234', 'C', '1234@hi.com', '$2y$10$zaeK.5YZX33/nMVsa4Nff.2S4unN2GIEtDfRz.cLmcom./tNg5Tg2'),
(6, 'megha', 'C', 'meghagupta11@gmail.com', '$2y$10$GTH5W/sCPEdVMbYgibbIUe8CaJURI7H5n2B3l3W37A6w57XNwkFTO');

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
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;
