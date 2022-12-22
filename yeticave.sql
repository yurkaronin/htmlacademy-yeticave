-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 22, 2022 at 07:50 PM
-- Server version: 8.0.29
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yeticave`
--

-- --------------------------------------------------------

--
-- Table structure for table `bets`
--

CREATE TABLE `bets` (
  `id` int NOT NULL,
  `date_bet` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `price_bet` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `lot_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `bets`
--

INSERT INTO `bets` (`id`, `date_bet`, `price_bet`, `user_id`, `lot_id`) VALUES
(1, '2022-12-22 12:32:21', 8500, 1, 4),
(2, '2022-12-22 12:32:29', 9000, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `character_code` varchar(128) DEFAULT NULL,
  `name_category` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `character_code`, `name_category`) VALUES
(1, 'boards', 'Доски и лыжи'),
(2, 'attachment', 'Крепления'),
(3, 'boots', 'Ботинки'),
(4, 'clothing', 'Одежда'),
(5, 'tools', 'Инструменты'),
(6, 'other', 'Разное');

-- --------------------------------------------------------

--
-- Table structure for table `lots`
--

CREATE TABLE `lots` (
  `id` int NOT NULL,
  `date_creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(255) DEFAULT NULL,
  `lot_description` text,
  `img` varchar(255) DEFAULT NULL,
  `start_price` int DEFAULT NULL,
  `date_finish` date DEFAULT NULL,
  `step` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `winner_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `lots`
--

INSERT INTO `lots` (`id`, `date_creation`, `title`, `lot_description`, `img`, `start_price`, `date_finish`, `step`, `user_id`, `winner_id`, `category_id`) VALUES
(1, '2022-12-22 12:32:08', '2014 Rossignol District Snowboard', 'Легкий маневренный сноуборд, готовый дать жару в любом парке', 'img/lot-1.jpg', 10999, '2021-08-10', 500, 1, NULL, 1),
(2, '2022-12-22 12:32:08', 'DC Ply Mens 2016/2017 Snowboard', 'Легкий маневренный сноуборд, готовый дать жару в любом парке', 'img/lot-2.jpg', 159999, '2021-08-11', 1000, 2, NULL, 1),
(3, '2022-12-22 12:32:08', 'Крепления Union Contact Pro 2015 года размер L/XL', 'Хорошие крепления, надежные и легкие', 'img/lot-3.jpg', 8000, '2021-08-12', 500, 2, NULL, 2),
(4, '2022-12-22 12:32:08', 'Ботинки для сноуборда DC Mutiny Charocal', 'Теплые и красивые ботинки', 'img/lot-4.jpg', 10999, '2021-08-13', 600, 1, NULL, 3),
(5, '2022-12-22 12:32:08', 'Куртка для сноуборда DC Mutiny Charocal', 'Легкая, теплая и прочная куртка', 'img/lot-5.jpg', 7500, '2021-08-14', 500, 1, NULL, 4),
(6, '2022-12-22 12:32:08', 'Маска Oakley Canopy', 'Желтые очки, все будет веселенькое', 'img/lot-6.jpg', 5400, '2021-08-15', 100, 1, NULL, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `date_registration` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(128) NOT NULL,
  `user_name` varchar(128) DEFAULT NULL,
  `user_password` char(255) DEFAULT NULL,
  `contacts` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `date_registration`, `email`, `user_name`, `user_password`, `contacts`) VALUES
(1, '2022-12-22 12:31:58', 'hero34@mail.ru', 'Ярослав', 'secretpassw1', '89191202527'),
(2, '2022-12-22 12:31:58', 'asis174@mail.ru', 'Слава', 'secretpassw2', '83512254836');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bets`
--
ALTER TABLE `bets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `lot_id` (`lot_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `character_code` (`character_code`);

--
-- Indexes for table `lots`
--
ALTER TABLE `lots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `winner_id` (`winner_id`),
  ADD KEY `category_id` (`category_id`);

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
-- AUTO_INCREMENT for table `bets`
--
ALTER TABLE `bets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lots`
--
ALTER TABLE `lots`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bets`
--
ALTER TABLE `bets`
  ADD CONSTRAINT `bets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bets_ibfk_2` FOREIGN KEY (`lot_id`) REFERENCES `lots` (`id`);

--
-- Constraints for table `lots`
--
ALTER TABLE `lots`
  ADD CONSTRAINT `lots_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `lots_ibfk_2` FOREIGN KEY (`winner_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `lots_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
