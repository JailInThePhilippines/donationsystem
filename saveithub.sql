-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2024 at 10:27 AM
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
-- Database: `saveithub`
--

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `donorName` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `donorLocation` varchar(255) NOT NULL,
  `donationType` varchar(255) NOT NULL,
  `donatedResources` varchar(255) NOT NULL,
  `cashAmount` int(255) DEFAULT NULL,
  `customAmountInput` int(255) DEFAULT NULL,
  `preferredCommunity` varchar(255) NOT NULL,
  `donationID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donation`
--

INSERT INTO `donation` (`donorName`, `date`, `donorLocation`, `donationType`, `donatedResources`, `cashAmount`, `customAmountInput`, `preferredCommunity`, `donationID`, `userID`) VALUES
('Lee Leighnard Jose', '2023-12-04', 'Fiesta Communities Castillejos', 'cash', '', 5000, 0, 'Old Cabalan, Olongapo City', 93, 10),
('Lee Leighnard Jose', '2023-01-15', 'Fiesta Communities Castillejos', 'cash', '', NULL, 2000, 'Old Cabalan, Olongapo City', 94, 10),
('Lee Leighnard Jose', '2023-03-22', 'Fiesta Communities Castillejos', 'cash', '', NULL, 5000, 'Gordon Heights, Olongapo City', 95, 10),
('Lee Leighnard Jose', '2023-07-10', 'Fiesta Communities Castillejos', 'cash', '', NULL, 3500, 'Kalaklan, Olongapo City', 96, 10),
('Lee Leighnard Jose', '2023-09-05', 'Fiesta Communities Castillejos', 'cash', '', NULL, 1500, 'Barretto, Olongapo City', 97, 10),
('Lee Leighnard Jose', '2023-02-08', 'Fiesta Communities Castillejos', 'cash', '', NULL, 4000, 'Old Cabalan, Olongapo City', 98, 10),
('Lee Leighnard Jose', '2023-04-12', 'Fiesta Communities Castillejos', 'cash', '', NULL, 6200, 'Gordon Heights, Olongapo City', 99, 10),
('Lee Leighnard Jose', '2023-06-25', 'Fiesta Communities Castillejos', 'cash', '', NULL, 7500, 'Kalaklan, Olongapo City', 100, 10),
('Lee Leighnard Jose', '2023-08-17', 'Fiesta Communities Castillejos', 'cash', '', NULL, 2700, 'Barretto, Olongapo City', 101, 10),
('Lee Leighnard Jose', '2023-10-01', 'Fiesta Communities Castillejos', 'cash', '', NULL, 9200, 'Old Cabalan, Olongapo City', 102, 10),
('Lee Leighnard Jose', '2023-11-24', 'Fiesta Communities Castillejos', 'cash', '', NULL, 5300, 'Gordon Heights, Olongapo City', 103, 10),
('Lee Leighnard Jose', '2023-01-07', 'Fiesta Communities Castillejos', 'cash', '', NULL, 1800, 'Kalaklan, Olongapo City', 104, 10),
('Lee Leighnard Jose', '2023-03-15', 'Fiesta Communities Castillejos', 'cash', '', NULL, 3200, 'Barretto, Olongapo City', 105, 10),
('Lee Leighnard Jose', '2023-05-20', 'Fiesta Communities Castillejos', 'cash', '', NULL, 5600, 'Old Cabalan, Olongapo City', 106, 10),
('Lee Leighnard Jose', '2023-07-03', 'Fiesta Communities Castillejos', 'cash', '', NULL, 4300, 'Gordon Heights, Olongapo City', 107, 10),
('Lee Leighnard Jose', '2023-09-14', 'Fiesta Communities Castillejos', 'cash', '', NULL, 6900, 'Kalaklan, Olongapo City', 108, 10),
('Lee Leighnard Jose', '2023-10-28', 'Fiesta Communities Castillejos', 'cash', '', NULL, 8700, 'Barretto, Olongapo City', 109, 10),
('Lee Leighnard Jose', '2023-12-11', 'Fiesta Communities Castillejos', 'cash', '', NULL, 2900, 'Old Cabalan, Olongapo City', 110, 10),
('Lee Leighnard Jose', '2023-02-15', 'Fiesta Communities Castillejos', 'cash', '', NULL, 5100, 'Old Cabalan, Olongapo City', 111, 10),
('Lee Leighnard Jose', '2023-04-22', 'Fiesta Communities Castillejos', 'cash', '', NULL, 6200, 'Gordon Heights, Olongapo City', 112, 10),
('Lee Leighnard Jose', '2023-06-28', 'Fiesta Communities Castillejos', 'cash', '', NULL, 8000, 'Kalaklan, Olongapo City', 113, 10),
('Lee Leighnard Jose', '2023-08-20', 'Fiesta Communities Castillejos', 'cash', '', NULL, 3000, 'Barretto, Olongapo City', 114, 10),
('Lee Leighnard Jose', '2023-10-05', 'Fiesta Communities Castillejos', 'cash', '', NULL, 9800, 'Old Cabalan, Olongapo City', 115, 10),
('Lee Leighnard Jose', '2023-11-28', 'Fiesta Communities Castillejos', 'cash', '', NULL, 6000, 'Gordon Heights, Olongapo City', 116, 10),
('Lee Leighnard Jose', '2023-01-10', 'Fiesta Communities Castillejos', 'cash', '', NULL, 2500, 'Kalaklan, Olongapo City', 117, 10),
('Lee Leighnard Jose', '2023-03-18', 'Fiesta Communities Castillejos', 'cash', '', NULL, 4300, 'Barretto, Olongapo City', 118, 10),
('Lee Leighnard Jose', '2023-05-25', 'Fiesta Communities Castillejos', 'cash', '', NULL, 6700, 'Old Cabalan, Olongapo City', 119, 10),
('Lee Leighnard Jose', '2023-07-08', 'Fiesta Communities Castillejos', 'cash', '', NULL, 5800, 'Gordon Heights, Olongapo City', 120, 10),
('Lee Leighnard Jose', '2023-09-20', 'Fiesta Communities Castillejos', 'cash', '', NULL, 7300, 'Kalaklan, Olongapo City', 121, 10),
('Lee Leighnard Jose', '2023-10-31', 'Fiesta Communities Castillejos', 'cash', '', NULL, 8900, 'Barretto, Olongapo City', 122, 10),
('Lee Leighnard Jose', '2023-12-14', 'Fiesta Communities Castillejos', 'cash', '', NULL, 3200, 'Old Cabalan, Olongapo City', 123, 10),
('Lee Leighnard Jose', '2023-02-22', 'Fiesta Communities Castillejos', 'cash', '', NULL, 5900, 'Old Cabalan, Olongapo City', 124, 10),
('Lee Leighnard Jose', '2023-04-30', 'Fiesta Communities Castillejos', 'cash', '', NULL, 7100, 'Gordon Heights, Olongapo City', 125, 10),
('Lee Leighnard Jose', '2023-07-05', 'Fiesta Communities Castillejos', 'cash', '', NULL, 8700, 'Kalaklan, Olongapo City', 126, 10),
('Lee Leighnard Jose', '2023-08-27', 'Fiesta Communities Castillejos', 'cash', '', NULL, 4200, 'Barretto, Olongapo City', 127, 10),
('Lee Leighnard Jose', '2023-10-11', 'Fiesta Communities Castillejos', 'cash', '', NULL, 5600, 'Old Cabalan, Olongapo City', 128, 10),
('Lee Leighnard Jose', '2023-11-30', 'Fiesta Communities Castillejos', 'cash', '', NULL, 6800, 'Gordon Heights, Olongapo City', 129, 10),
('Lee Leighnard Jose', '2023-01-14', 'Fiesta Communities Castillejos', 'cash', '', NULL, 3000, 'Kalaklan, Olongapo City', 130, 10),
('Lee Leighnard Jose', '2023-03-20', 'Fiesta Communities Castillejos', 'cash', '', NULL, 4900, 'Barretto, Olongapo City', 131, 10),
('Lee Leighnard Jose', '2023-05-28', 'Fiesta Communities Castillejos', 'cash', '', NULL, 6400, 'Old Cabalan, Olongapo City', 132, 10),
('Lee Leighnard Jose', '2023-07-11', 'Fiesta Communities Castillejos', 'cash', '', NULL, 5400, 'Gordon Heights, Olongapo City', 133, 10),
('Lee Leighnard Jose', '2023-09-24', 'Fiesta Communities Castillejos', 'cash', '', NULL, 7700, 'Kalaklan, Olongapo City', 134, 10),
('Lee Leighnard Jose', '2023-11-03', 'Fiesta Communities Castillejos', 'cash', '', NULL, 9200, 'Barretto, Olongapo City', 135, 10),
('Lee Leighnard Jose', '2023-12-17', 'Fiesta Communities Castillejos', 'cash', '', NULL, 3700, 'Old Cabalan, Olongapo City', 136, 10),
('Lee Leighnard Jose', '2023-11-30', 'Fiesta Communities Castillejos', 'cash', '', NULL, 7400, 'Kalaklan, Olongapo City', 142, 10),
('Lee Leighnard Jose', '2023-11-20', 'Fiesta Communities Castillejos', 'cash', '', NULL, 8000, 'Gordon Heights, Olongapo City', 143, 10),
('Lee Leighnard Jose', '2023-12-03', 'Fiesta Communities Castillejos', 'cash', '', NULL, 9200, 'Old Cabalan, Olongapo City', 144, 10),
('Lee Leighnard Jose', '2023-12-15', 'Fiesta Communities Castillejos', 'cash', '', NULL, 5800, 'Kalaklan, Olongapo City', 146, 10),
('Lee Leighnard Jose', '2023-02-28', 'Fiesta Communities Castillejos', 'cash', '', NULL, 4200, 'Old Cabalan, Olongapo City', 147, 10),
('Lee Leighnard Jose', '2023-04-05', 'Fiesta Communities Castillejos', 'cash', '', NULL, 5300, 'Gordon Heights, Olongapo City', 148, 10),
('Lee Leighnard Jose', '2023-07-18', 'Fiesta Communities Castillejos', 'cash', '', NULL, 6900, 'Kalaklan, Olongapo City', 149, 10),
('Lee Leighnard Jose', '2023-08-30', 'Fiesta Communities Castillejos', 'cash', '', NULL, 3700, 'Barretto, Olongapo City', 150, 10),
('Lee Leighnard Jose', '2023-10-14', 'Fiesta Communities Castillejos', 'cash', '', NULL, 5000, 'Old Cabalan, Olongapo City', 151, 10),
('Lee Leighnard Jose', '2023-12-01', 'Fiesta Communities Castillejos', 'cash', '', NULL, 6300, 'Gordon Heights, Olongapo City', 152, 10),
('Lee Leighnard Jose', '2023-01-18', 'Fiesta Communities Castillejos', 'cash', '', NULL, 7800, 'Kalaklan, Olongapo City', 153, 10),
('Lee Leighnard Jose', '2023-03-25', 'Fiesta Communities Castillejos', 'cash', '', NULL, 4900, 'Barretto, Olongapo City', 154, 10),
('Lee Leighnard Jose', '2023-06-01', 'Fiesta Communities Castillejos', 'cash', '', NULL, 6800, 'Old Cabalan, Olongapo City', 155, 10),
('Lee Leighnard Jose', '2023-07-14', 'Fiesta Communities Castillejos', 'cash', '', NULL, 5700, 'Gordon Heights, Olongapo City', 156, 10),
('Lee Leighnard Jose', '2023-12-05', 'Fiesta Communities Castillejos', 'cash', '', NULL, 4500, 'Barretto, Olongapo City', 158, 10),
('Lee Leighnard Jose', '2023-12-04', 'Fiesta Communities Castillejos', 'cash', '', 1000, 0, 'Gordon Heights, Olongapo City', 159, 10);

-- --------------------------------------------------------

--
-- Table structure for table `forum_comments`
--

CREATE TABLE `forum_comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `content` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forum_comments`
--

INSERT INTO `forum_comments` (`comment_id`, `post_id`, `userID`, `content`, `timestamp`) VALUES
(4, 17, 10, 'Welcome po hahaha....', '2023-12-05 03:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `forum_posts`
--

CREATE TABLE `forum_posts` (
  `post_id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `content` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forum_posts`
--

INSERT INTO `forum_posts` (`post_id`, `userID`, `content`, `timestamp`) VALUES
(17, 12, 'Thank you so much, Lee Leighnard Jose for donating 1000000 in our Community - Old Cabalan!', '2023-12-05 03:05:16');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `upload_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `filename`, `userID`, `upload_timestamp`) VALUES
(29, 'Lee Leighnard Jose.jpg', 10, '2023-12-04 13:56:54'),
(30, '429041630_912986953801707_6471480264207428589_n.jpg', 10, '2024-02-24 13:47:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `email`, `username`, `password`) VALUES
(10, 'leelenardjose@gmail.com', 'Lee Leighnard Jose', '$2y$10$j/5LD0AMvUUU64iEqccCeukOPPvDLYNI.X7YRT8fVHl0kmoAolKcO'),
(12, 'Josherfisquez@gmail.com', 'Josher Fisquez', '$2y$10$sfaZuWQTOiBRPetVbsNfxuXVDWyzPh0m.QrTyrdX5.haHDzOVSXfq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`donationID`),
  ADD KEY `fk_donation_user` (`userID`);

--
-- Indexes for table `forum_comments`
--
ALTER TABLE `forum_comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `userID` (`userID`),
  ADD KEY `fk_post_id` (`post_id`);

--
-- Indexes for table `forum_posts`
--
ALTER TABLE `forum_posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_images_user` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donation`
--
ALTER TABLE `donation`
  MODIFY `donationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `forum_comments`
--
ALTER TABLE `forum_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `forum_posts`
--
ALTER TABLE `forum_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donation`
--
ALTER TABLE `donation`
  ADD CONSTRAINT `fk_donation_user` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `forum_comments`
--
ALTER TABLE `forum_comments`
  ADD CONSTRAINT `fk_post_id` FOREIGN KEY (`post_id`) REFERENCES `forum_posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `forum_comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `forum_posts` (`post_id`),
  ADD CONSTRAINT `forum_comments_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `forum_posts`
--
ALTER TABLE `forum_posts`
  ADD CONSTRAINT `forum_posts_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `fk_images_user` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
