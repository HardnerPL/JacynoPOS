-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2021 at 10:39 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `bundles`
--

CREATE TABLE `bundles` (
  `bundle_id` int(11) NOT NULL,
  `bundle_name` varchar(32) DEFAULT NULL,
  `bundle_type` varchar(16) DEFAULT NULL,
  `bundle_menu_id` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bundles`
--

INSERT INTO `bundles` (`bundle_id`, `bundle_name`, `bundle_type`, `bundle_menu_id`) VALUES
(1, 'Margherita', 'wynos', 1),
(2, 'Funghi', 'wynos', 1),
(3, 'Salami', 'wynos', 1),
(4, 'Capricciosa', 'wynos', 1),
(5, 'Hawaii', 'wynos', 1),
(6, '4 sery', 'wynos', 1),
(7, 'Viola', 'wynos', 1),
(8, 'Parma', 'wynos', 1),
(9, 'Firmowa', 'wynos', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bundle_items`
--

CREATE TABLE `bundle_items` (
  `bundle_item_id` int(8) NOT NULL,
  `bundle_id` int(8) NOT NULL,
  `item_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bundle_menus`
--

CREATE TABLE `bundle_menus` (
  `bundle_menu_id` int(11) NOT NULL,
  `target_bundle_menu` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bundle_menus`
--

INSERT INTO `bundle_menus` (`bundle_menu_id`, `target_bundle_menu`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bundle_menu_items`
--

CREATE TABLE `bundle_menu_items` (
  `bundle_menu_item_id` int(8) NOT NULL,
  `bundle_menu_id` int(4) NOT NULL,
  `item_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(2) NOT NULL,
  `category_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Pizza'),
(2, 'Napoje'),
(3, 'Piwo'),
(4, 'Tymbark'),
(5, 'Sok Cappy'),
(6, 'Fuze Tea'),
(7, 'Kropla Beskidu'),
(8, 'Kawa'),
(9, 'Herbata'),
(10, 'Lech'),
(11, 'Książęce'),
(12, 'Zestawy obiadowe'),
(13, 'Zupy');

-- --------------------------------------------------------

--
-- Table structure for table `category_bundles`
--

CREATE TABLE `category_bundles` (
  `id` int(8) NOT NULL,
  `cat_id` int(8) NOT NULL,
  `bundle_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category_categories`
--

CREATE TABLE `category_categories` (
  `id` int(8) NOT NULL,
  `parent_cat_id` int(8) NOT NULL,
  `child_cat_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_categories`
--

INSERT INTO `category_categories` (`id`, `parent_cat_id`, `child_cat_id`) VALUES
(1, 2, 4),
(2, 2, 5),
(3, 2, 6),
(4, 2, 7),
(5, 2, 8),
(6, 2, 9),
(7, 3, 10),
(8, 3, 11),
(9, 0, 1),
(10, 0, 2),
(11, 0, 3),
(12, 0, 12),
(13, 0, 13);

-- --------------------------------------------------------

--
-- Table structure for table `category_items`
--

CREATE TABLE `category_items` (
  `id` int(8) NOT NULL,
  `cat_id` int(8) NOT NULL,
  `item_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `category_items`
--

INSERT INTO `category_items` (`id`, `cat_id`, `item_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 8, 63),
(11, 8, 64),
(12, 8, 65),
(13, 9, 66),
(14, 9, 67),
(15, 2, 68),
(16, 2, 69),
(17, 2, 70),
(18, 2, 71),
(19, 2, 72),
(20, 2, 73),
(21, 2, 74),
(22, 3, 91),
(23, 3, 92),
(24, 3, 93),
(25, 10, 94),
(26, 3, 95),
(27, 11, 96),
(28, 11, 97),
(29, 11, 98),
(30, 11, 99),
(31, 11, 100),
(32, 11, 101),
(33, 11, 102),
(34, 10, 103),
(35, 10, 104),
(36, 10, 105),
(37, 10, 106),
(38, 0, 50),
(39, 4, 107),
(40, 4, 108),
(41, 4, 109),
(42, 4, 110),
(43, 4, 111),
(44, 4, 112),
(45, 6, 113),
(46, 6, 114),
(47, 6, 115),
(51, 5, 116),
(52, 5, 117),
(53, 5, 118),
(54, 7, 119),
(55, 7, 120),
(56, 12, 20),
(57, 12, 21),
(58, 12, 22),
(59, 12, 23),
(60, 12, 24),
(61, 12, 25),
(62, 13, 40),
(63, 13, 41),
(64, 13, 42);

-- --------------------------------------------------------

--
-- Table structure for table `category_positions`
--

CREATE TABLE `category_positions` (
  `category_position_id` int(4) NOT NULL,
  `cat_id` int(4) NOT NULL,
  `pos_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_positions`
--

INSERT INTO `category_positions` (`category_position_id`, `cat_id`, `pos_id`) VALUES
(2, 1, 3),
(3, 2, 1),
(4, 3, 1),
(5, 4, 1),
(6, 5, 1),
(7, 6, 1),
(8, 7, 1),
(9, 8, 1),
(10, 9, 1),
(11, 10, 1),
(12, 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE `codes` (
  `code_id` int(11) NOT NULL,
  `code_value` int(4) NOT NULL,
  `code_name` varchar(32) DEFAULT NULL,
  `code_price` float DEFAULT NULL,
  `code_unique` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `codes`
--

INSERT INTO `codes` (`code_id`, `code_value`, `code_name`, `code_price`, `code_unique`) VALUES
(1, 30, 'Herbata', 5, 0),
(2, 31, 'Kawa', 6, 0),
(3, 32, 'Napoje', 4, 1),
(4, 33, 'Tymbark/Woda', 3, 1),
(5, 34, 'Cappy', NULL, 1),
(6, 39, 'Karton', 1, 1),
(7, 41, 'Margherita', 18, 1),
(8, 42, 'Funghi', 20, 1),
(9, 43, 'Salami', 22, 1),
(10, 44, 'Capricciosa', 23, 1),
(11, 45, 'Hawaii', 23, 1),
(12, 46, '4 sery', 24, 1),
(13, 49, 'Viola', 26, 1),
(14, 50, 'Firmowa', 26, 1),
(15, 52, 'Parma', 32, 1),
(16, 61, 'Tyskie 300 ml', 6, 1),
(17, 62, 'Tyskie 500 ml', 8, 1),
(18, 63, 'Brok', 6, 1),
(19, 64, 'Lech', 7, 1),
(20, 65, 'Tyskie', 7, 1),
(21, 66, 'Książęce Złote Pszeniczne', 7, 1),
(22, 67, 'Książęce Ciemne Łagodne', 7, 1),
(23, 68, 'Książęce Czerwony Lager', 7, 1),
(24, 69, 'Książęce Weizen', 9, 1),
(25, 70, 'Książęce Porter', 9, 1),
(26, 71, 'Książęce IPA', 9, 1),
(27, 72, 'Książęce Irish ALE', 9, 1),
(28, 73, 'Lech Free', 5, 1),
(29, 74, 'Lech Free Smakowy', 6, 1),
(30, 30, 'Herbata', 6, 0),
(31, 31, 'Kawa', 7, 0),
(32, 21, 'Zupa', 5, 0),
(33, 21, 'Zupa', 6, 0),
(34, 21, 'Zestaw obiadowy', 5, 0),
(35, 21, 'Zestaw obiadowy', 22, 0),
(36, 21, 'Zestaw obiadowy', 24, 0),
(37, 21, 'Zestaw obiadowy', 25, 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(2) NOT NULL,
  `code_id` int(4) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(16) DEFAULT NULL,
  `item_img` varchar(64) DEFAULT NULL,
  `item_price` float NOT NULL,
  `item_to_go_id` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `code_id`, `item_name`, `item_type`, `item_img`, `item_price`, `item_to_go_id`) VALUES
(1, 7, 'Margherita', 'pizza', NULL, 18, 50),
(2, 8, 'Funghi', 'pizza', NULL, 20, 50),
(3, 9, 'Salami', 'pizza', NULL, 22, 50),
(4, 10, 'Capricciosa', 'pizza', NULL, 23, 50),
(5, 11, 'Hawaii', 'pizza', NULL, 23, 50),
(6, 12, '4 sery', 'pizza', NULL, 24, 50),
(7, 13, 'Viola', 'pizza', NULL, 26, 50),
(8, 15, 'Parma', 'pizza', NULL, 32, 50),
(9, 14, 'Firmowa', 'pizza', NULL, 26, 50),
(20, 34, 'Frytki', 'obiad', NULL, 5, 51),
(21, 35, 'Pierś panierowana', 'obiad', NULL, 22, 51),
(22, 35, 'Pierś grillowana', 'obiad', NULL, 22, 51),
(23, 35, 'Schabowy', 'obiad', NULL, 22, 51),
(24, 36, 'Karkówka grillowana', 'obiad', NULL, 24, 51),
(25, 37, 'Karkówka panierowana', 'obiad', NULL, 25, 51),
(40, 32, 'Rosół', 'zupa', NULL, 5, 51),
(41, 33, 'Pomidorowa', 'zupa', NULL, 6, 51),
(42, 33, 'Zupa dnia', 'zupa', NULL, 6, 51),
(50, 6, 'Karton', NULL, NULL, 1, NULL),
(51, 0, 'Karton obiadowy', 'opakowanie', NULL, 0, NULL),
(63, 2, 'Espresso', NULL, NULL, 6, NULL),
(64, 2, 'Kawa czarna', NULL, NULL, 6, NULL),
(65, 31, 'Kawa z mlekiem', NULL, NULL, 7, NULL),
(66, 1, 'Herbata czarna', NULL, NULL, 5, NULL),
(67, 30, 'Herbata owocowa', NULL, NULL, 6, NULL),
(68, 3, 'Coca-Cola', NULL, NULL, 4, NULL),
(69, 3, 'Fanta', NULL, NULL, 4, NULL),
(70, 3, 'Sprite', NULL, NULL, 4, NULL),
(91, 16, 'Tyskie 300 ml', NULL, NULL, 6, NULL),
(92, 17, 'Tyskie 500 ml', NULL, NULL, 8, NULL),
(93, 18, 'Brok', NULL, NULL, 6, NULL),
(94, 19, 'Lech', NULL, NULL, 7, NULL),
(95, 20, 'Tyskie', NULL, NULL, 7, NULL),
(96, 21, 'Książęce Złote Pszeniczne', NULL, NULL, 7, NULL),
(97, 22, 'Książęce Ciemne Łagodne', NULL, NULL, 7, NULL),
(98, 23, 'Książęce Czerwony Lager', NULL, NULL, 7, NULL),
(99, 24, 'Książęce Weizen', NULL, NULL, 9, NULL),
(100, 25, 'Książęce Porter', NULL, NULL, 9, NULL),
(101, 26, 'Książęce IPA', NULL, NULL, 9, NULL),
(102, 27, 'Książęce Irish ALE', NULL, NULL, 9, NULL),
(103, 28, 'Lech Free', NULL, NULL, 5, NULL),
(104, 29, 'Lech Free Limonka i Mięta', NULL, NULL, 6, NULL),
(105, 29, 'Lech Free Granat i Acai', NULL, NULL, 6, NULL),
(106, 29, 'Lech Free Pomelo i Grejpfrut', NULL, NULL, 6, NULL),
(107, 4, 'Tymbark Jabłko-mięta', NULL, NULL, 3, NULL),
(108, 4, 'Tymbark Jabłko-wiśnia', NULL, NULL, 3, NULL),
(109, 4, 'Tymbark Pomarańcza-brzoskwinia', NULL, NULL, 3, NULL),
(110, 4, 'Tymbark Jabłko-arbuz', NULL, NULL, 3, NULL),
(111, 4, 'Tymbark Jabłko-kiwi', NULL, NULL, 3, NULL),
(112, 4, 'Tymbark Jabłko-brzoskwinia', NULL, NULL, 3, NULL),
(113, 3, 'Fuze Tea Zielona herbata', NULL, NULL, 4, NULL),
(114, 3, 'Fuze Tea Cytrynowa', NULL, NULL, 4, NULL),
(115, 3, 'Fuze Tea Brzoskwinia', NULL, NULL, 4, NULL),
(116, 5, 'Cappy Pomarańcza', NULL, NULL, 4, NULL),
(117, 5, 'Cappy Czarna Porzeczka', NULL, NULL, 4, NULL),
(118, 5, 'Cappy Jabłko', NULL, NULL, 4, NULL),
(119, 4, 'Delice Gazowana', NULL, NULL, 3, NULL),
(120, 4, 'Delice Niegazowana', NULL, NULL, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_codes`
--

CREATE TABLE `item_codes` (
  `item_code_id` int(4) NOT NULL,
  `code_id` int(4) NOT NULL,
  `item_id` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_codes`
--

INSERT INTO `item_codes` (`item_code_id`, `code_id`, `item_id`) VALUES
(64, 1, NULL),
(65, 2, NULL),
(66, 3, NULL),
(67, 4, NULL),
(68, 5, NULL),
(69, 6, NULL),
(70, 7, NULL),
(71, 8, NULL),
(72, 9, NULL),
(73, 10, NULL),
(74, 11, NULL),
(75, 12, NULL),
(76, 13, NULL),
(77, 14, NULL),
(78, 15, NULL),
(79, 16, NULL),
(80, 17, NULL),
(81, 18, NULL),
(82, 19, NULL),
(83, 20, NULL),
(84, 21, NULL),
(85, 22, NULL),
(86, 23, NULL),
(87, 24, NULL),
(88, 25, NULL),
(89, 26, NULL),
(90, 27, NULL),
(91, 28, NULL),
(92, 29, NULL),
(93, 30, NULL),
(94, 31, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(8) NOT NULL,
  `order_table` varchar(16) NOT NULL,
  `order_comment` text DEFAULT NULL,
  `order_time` varchar(16) NOT NULL,
  `order_status` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_table`, `order_comment`, `order_time`, `order_status`) VALUES
(2, '0', NULL, '19:52', 'confirmed'),
(3, '11', NULL, '22:38', 'confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `order_bundles`
--

CREATE TABLE `order_bundles` (
  `id` int(8) NOT NULL,
  `order_id` int(8) NOT NULL,
  `bundle_id` int(8) NOT NULL,
  `bundle_comment` text DEFAULT NULL,
  `bundle_status` varchar(32) NOT NULL,
  `bundle_time` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(8) NOT NULL,
  `order_id` int(8) NOT NULL,
  `item_id` int(4) NOT NULL,
  `item_comment` text NOT NULL,
  `item_status` varchar(32) NOT NULL,
  `to_go_id` int(8) DEFAULT NULL,
  `item_time` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `item_id`, `item_comment`, `item_status`, `to_go_id`, `item_time`) VALUES
(4, 2, 2, 'Pół jalapeno', 'confirmed', 5, '19:54'),
(5, 2, 50, '', 'confirmed', NULL, '19:54'),
(6, 3, 51, '', 'confirmed', NULL, '22:38'),
(7, 3, 41, '', 'confirmed', 6, '22:38'),
(8, 3, 51, '', 'confirmed', NULL, '22:38'),
(9, 3, 41, '', 'confirmed', 8, '22:38');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `position_id` int(4) NOT NULL,
  `position_name` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`position_id`, `position_name`) VALUES
(1, 'waiter'),
(2, 'kitchen'),
(3, 'pizza');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(2) NOT NULL,
  `user_name` varchar(32) NOT NULL,
  `user_password` varchar(256) NOT NULL,
  `user_role` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_role`) VALUES
(1, 'ame180', '$2y$10$i5LlPVQholOXsoO6Du.dqe4h38RRDxFGDib2e0BzS99thrCmAG73e', 'admin'),
(4, 'kitchen', '$2y$10$1g9JJslttRHUKQAwNRKFfe5ThMQssK1.XrDk3hjoiB7B3MwB1KDzq', 'kitchen');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bundles`
--
ALTER TABLE `bundles`
  ADD PRIMARY KEY (`bundle_id`);

--
-- Indexes for table `bundle_items`
--
ALTER TABLE `bundle_items`
  ADD PRIMARY KEY (`bundle_item_id`);

--
-- Indexes for table `bundle_menus`
--
ALTER TABLE `bundle_menus`
  ADD PRIMARY KEY (`bundle_menu_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `category_bundles`
--
ALTER TABLE `category_bundles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_categories`
--
ALTER TABLE `category_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_items`
--
ALTER TABLE `category_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_positions`
--
ALTER TABLE `category_positions`
  ADD PRIMARY KEY (`category_position_id`);

--
-- Indexes for table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`code_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `item_codes`
--
ALTER TABLE `item_codes`
  ADD PRIMARY KEY (`item_code_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_bundles`
--
ALTER TABLE `order_bundles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bundles`
--
ALTER TABLE `bundles`
  MODIFY `bundle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bundle_items`
--
ALTER TABLE `bundle_items`
  MODIFY `bundle_item_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bundle_menus`
--
ALTER TABLE `bundle_menus`
  MODIFY `bundle_menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `category_bundles`
--
ALTER TABLE `category_bundles`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_categories`
--
ALTER TABLE `category_categories`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `category_items`
--
ALTER TABLE `category_items`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `category_positions`
--
ALTER TABLE `category_positions`
  MODIFY `category_position_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `codes`
--
ALTER TABLE `codes`
  MODIFY `code_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `item_codes`
--
ALTER TABLE `item_codes`
  MODIFY `item_code_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_bundles`
--
ALTER TABLE `order_bundles`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `position_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
