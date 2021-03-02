-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2021 at 08:44 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `laurel`
--

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` int(11) NOT NULL,
  `file` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `file`, `title`) VALUES
(1, 'content_1', 'Article 1'),
(2, 'content_2', 'Article 2'),
(3, 'content_3', 'Article 3'),
(4, 'content_4', 'Article 4'),
(5, 'content_5', 'Article 5'),
(6, 'content_6', 'Article 6'),
(7, 'content_7', 'Article 7'),
(101, 'content_8', 'Article 8');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `id_user_group` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_user_group`, `email`, `password`) VALUES
(1, 1, 'user1@email.com', '$2y$10$fTELk9kjhqQDvvqkrlVjoO45AUFks4w7utN4yUyB/XewDttdT9m0.'),
(2, 2, 'user2@email.com', '$2y$10$fTELk9kjhqQDvvqkrlVjoO45AUFks4w7utN4yUyB/XewDttdT9m0.'),
(3, 3, 'user3@email.com', '$2y$10$fTELk9kjhqQDvvqkrlVjoO45AUFks4w7utN4yUyB/XewDttdT9m0.');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `name`) VALUES
(1, 'user group 1'),
(2, 'user group 2'),
(3, 'user group 3');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups_contents`
--

CREATE TABLE `user_groups_contents` (
  `id_user_group` int(11) NOT NULL,
  `id_content` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_groups_contents`
--

INSERT INTO `user_groups_contents` (`id_user_group`, `id_content`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 4),
(2, 5),
(3, 2),
(3, 5),
(3, 6),
(3, 7),
(4, 101);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_groups_contents`
--
ALTER TABLE `user_groups_contents`
  ADD UNIQUE KEY `id_user_groups` (`id_user_group`,`id_content`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;
