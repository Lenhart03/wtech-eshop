-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: So 04.Máj 2024, 17:18
-- Verzia serveru: 10.4.32-MariaDB
-- Verzia PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `wtech_eshop`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `images`
--

CREATE TABLE `images` (
  `product_id` int(11) NOT NULL,
  `image` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time_ordered` date NOT NULL,
  `state` enum('new','prepared','sent','delivered') NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `street_name` varchar(64) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `phonenumber` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `time_ordered`, `state`, `firstname`, `lastname`, `street_name`, `zip_code`, `phonenumber`) VALUES
(1, 1, '1970-01-01', 'new', 'firstname', 'lastname', 'street_name', 0, 'phonenumber'),
(2, 1, '1970-01-01', 'prepared', 'firstname', 'lastname', 'street_name', 0, 'phonenumber'),
(3, 1, '1970-01-01', 'sent', 'firstname', 'lastname', 'street_name', 0, 'phonenumber'),
(4, 1, '1970-01-01', 'delivered', 'firstname', 'lastname', 'street_name', 0, 'phonenumber'),
(5, 2, '0000-00-00', 'delivered', '[value-5]', '[value-6]', '[value-7]', 0, '[value-9]');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `order_products`
--

CREATE TABLE `order_products` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `parameters`
--

CREATE TABLE `parameters` (
  `product_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `value` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `price` float NOT NULL,
  `count` int(8) NOT NULL,
  `category` varchar(64) NOT NULL,
  `brand` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `email` varchar(256) NOT NULL,
  `pword` varchar(256) NOT NULL,
  `user_group` enum('basic','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `pword`, `user_group`) VALUES
(1, 'Administrator', '', 'admin@pcpartshop.sk', '25d55ad283aa400af464c76d713c07ad', 'admin'),
(2, 'Jan', 'Lenhart', 'jan.lenhart2003@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'basic'),
(6, 'Jan', 'Lenhart', 'jan.lenhart2003@ba.com', '76d80224611fc919a5d54f0ff9fba446', 'basic'),
(7, 'Jan', 'Lenhart', 'jan.lenhart2003@bab.com', '76d80224611fc919a5d54f0ff9fba446', 'basic');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pre tabuľku `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
