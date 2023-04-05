-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2023 at 04:18 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mediatech`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_full_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_username`, `admin_password`, `admin_email`, `admin_full_name`) VALUES
(1, 'bassamsa', '$2y$10$nG/Xq1yEFi.heZn9/vkVFOPh5lQDqZ5p44nKf38gt0J', 'salikbassam@email.com', 'bassam salik');

-- --------------------------------------------------------

--
-- Table structure for table `borrowing_op`
--

CREATE TABLE `borrowing_op` (
  `borrowing_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `borrowing_date` datetime NOT NULL,
  `borrowing_return_date` datetime NOT NULL,
  `actual_return_date` datetime DEFAULT NULL,
  `borrowing_status` enum('on','off') NOT NULL DEFAULT 'on'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowing_op`
--

INSERT INTO `borrowing_op` (`borrowing_id`, `product_id`, `member_id`, `borrowing_date`, `borrowing_return_date`, `actual_return_date`, `borrowing_status`) VALUES
(55, 118, 3, '2023-04-05 00:00:00', '2023-04-20 00:00:00', '2023-04-05 03:13:46', 'off'),
(56, 119, 2, '2023-04-05 00:00:00', '2023-04-20 00:00:00', '2023-04-05 14:37:20', 'off'),
(57, 118, 2, '2023-04-05 14:37:33', '2023-04-20 00:00:00', '2023-04-05 14:42:32', 'off'),
(58, 119, 2, '2023-04-05 14:42:47', '2023-04-05 03:11:03', '2023-04-05 15:33:46', 'off'),
(59, 118, 25, '2023-04-05 15:34:06', '2023-04-05 03:34:32', '2023-04-05 16:00:42', 'off'),
(60, 118, 25, '2023-04-05 16:09:04', '2023-04-05 04:09:06', '2023-04-05 16:09:36', 'off'),
(61, 119, 25, '2023-04-05 16:10:53', '2023-04-05 04:10:53', '2023-04-05 16:11:17', 'off');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `member_code` varchar(10) NOT NULL,
  `member_name` varchar(100) NOT NULL,
  `member_address` varchar(200) NOT NULL,
  `member_email` varchar(100) NOT NULL,
  `member_phone` varchar(20) NOT NULL,
  `member_cin` varchar(10) NOT NULL,
  `member_dob` date NOT NULL,
  `member_type` varchar(20) NOT NULL,
  `member_penalties` varchar(20) NOT NULL,
  `member_nickname` varchar(50) DEFAULT NULL,
  `member_password` varchar(100) NOT NULL,
  `member_account_date` date NOT NULL,
  `member_admin` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `member_code`, `member_name`, `member_address`, `member_email`, `member_phone`, `member_cin`, `member_dob`, `member_type`, `member_penalties`, `member_nickname`, `member_password`, `member_account_date`, `member_admin`) VALUES
(1, '', 'Colt Zamora', 'Et dolorum ex quam e', 'kesi@mailinator.com', '+1 (241) 607-3181', 'Deleniti a', '1979-09-27', 'user', '', 'makydimano', '$2y$10$NIIABSMhrMBPflvuG56xw.3JUNVucgYIB6dULWqFfHRJwA/r0chxq', '2023-03-17', 'yes'),
(2, '', 'Holmes Gillespie', 'Quos soluta consequu', 'piqypiq@mailinator.com', '5', 'Ab irure a', '2004-01-24', 'user', '1', 'sozibahyte', '$2y$10$dYONlkVPWdqRKjcZsMRCx.vNUk1vqguFVSsZKCys33.MhlR00H.y2', '2023-03-17', 'no'),
(3, '', 'Octavius Cochran', 'Exercitation iusto r', 'xoxeruxi@mailinator.com', '48', 'Voluptatem', '2008-12-05', 'user', '', 'xofux', '$2y$10$tRaDIl/VrJfT7MV4UlJnbeBa4rrGC2DD.rCCmvLLQAGHW8ZRW1M2K', '2023-03-17', 'no'),
(4, '', 'Rae Huffman', 'Ut omnis inventore a', 'gitit@mailinator.com', '35', 'Lorem iste', '2020-02-03', 'user', '', 'gejudi', '$2y$10$QHk1gJeJ560GvdVvsEk21.PzXzJNludRHAAPeuEO5npLRFFn3GMke', '2023-03-17', 'no'),
(5, '', 'Joelle Mathis', 'Perferendis ut delec', 'nuwycog@mailinator.com', '79', 'Duis aliqu', '2017-05-12', 'user', '', 'zehimopap', '$2y$10$B.tHU/DtBNwPASvRR8HeNOs8uFy5W7JueEp2nPuGVNhNflfKY6YCy', '2023-03-17', 'no'),
(6, '', 'dfddf', '', '', '', '', '0000-00-00', 'user', '', 'bassamsalik', '$2y$10$QMcmjYWP8BXlv2jcDyacCO9VEQacfPxc.lLfas2SGXlyjK1SEi9F.', '2023-03-17', 'no'),
(7, '', 'Erica Fuentes', 'Vel proident conseq', 'karydot@mailinator.com', '85', 'Aut rerum ', '1981-08-05', 'user', '', 'bassambassam', '$2y$10$nG/Xq1yEFi.heZn9/vkVFOPh5lQDqZ5p44nKf38gt0Jh5qd21RuZq', '2023-03-17', 'no'),
(8, '', 'Alfreda Golden', 'Deserunt duis conseq', 'sedovegy@mailinator.com', '0772125151', 'Non fugiat', '2005-05-21', 'user', '', 'sapafiteva', '$2y$10$VbG.8eEgXthJ7GcKW3FV9Os5OHgHV4mJycR9LHjtPayeYHDO5kuIa', '2023-03-17', 'no'),
(9, '', 'Nicholas Hutchinson', 'Provident consequat', 'lafyx@mailinator.com', '0454554545', 'Est labori', '1984-12-14', 'user', '', 'malakNori', '$2y$10$eHgbt7uEocvjj5fHzvwtN.DouyDFY9EFxSM5Y/qrr3isl9nI3gc86', '2023-03-17', 'no'),
(10, '', 'Nicholas Hutchinson', 'Provident consequat', 'ssfyx@mailinator.com', '0454554457', 'Est labori', '1984-12-14', 'user', '', 'malaknorii', '$2y$10$ggRRwY/7hwzo1H4hF.GFv.kKFno9nGyWAcvI4UcRp4tgHf66xurh6', '2023-03-17', 'no'),
(11, '', 'Aretha Dawson', 'Veniam quod rem cul', 'koxovy@mailinator.com', '11', 'Quod sapie', '1999-12-10', 'user', '', 'jugotanaz', '$2y$10$BognTw4mrj518RAU76/nCurhOJiL8yK0MvfxaHqK7WIvh3xFAXAye', '2023-03-17', 'no'),
(12, '', 'Cedric Conley', 'Explicabo Sed aut l', 'bunu@mailinator.com', '55', 'Sed volupt', '1994-11-16', 'user', '', 'keraxeg', '$2y$10$rZk.Dh9oej0NMCrXkBxqQ.PizEVlkcFBJ.UmUZphZr16CQTt85YCq', '2023-03-17', 'no'),
(13, '', 'Felicia Howe', 'Pariatur Aut labore', 'vone@mailinator.com', '54', 'Rerum et n', '1998-11-17', 'user', '', 'xyqixevej', '$2y$10$nyt0vVJwq9hz7gvKmYEkuucQx5GmfoLfp1Uez5g7ex9xhF5dUVbDO', '2023-03-17', 'no'),
(14, '', 'Odessa Wilcox', 'Hic ut itaque id ip', 'vuxu@mailinator.com', '70', 'Voluptate ', '1977-10-17', 'user', '', 'loxyc', '$2y$10$oCYX4dBt6YAXYv0ZLC7LHuvsYeSRrUV0A3UXl8oi73z/4BQEzARG.', '2023-03-17', 'no'),
(15, '', 'MacKenzie Joyce', 'Consectetur nostrum ', 'deki@mailinator.com', '14', 'Veritatis ', '2001-11-19', 'user', '', 'zyxanon', '$2y$10$hn3HddQMo5GSc93S8LV0uuN4FP8Ph3jM8VKxOPZxyZSpWSQsBO7VS', '2023-03-17', 'no'),
(16, '', 'Felicia England', 'Et mollit ducimus v', 'nymiw@mailinator.com', '21', 'Est sit ve', '1983-08-21', 'user', '', 'mineduh', '$2y$10$M/skekXur1D2L1jjsh/4L..DyQZ/po24cKI5lhlmpWhY4dvDJnhPu', '2023-03-17', 'no'),
(17, '', 'Haley Vega', 'Quisquam rem at hic ', 'pywityv@mailinator.com', '24', 'Sequi mini', '1986-04-09', 'user', '', 'faxotimiwe', '$2y$10$m1/r12JmnLEVmsXQQi8IoODPXIIckXQGRl79JRHKHz16RoN.R4/Ly', '2023-03-17', 'no'),
(18, '', 'Malachi Rosario', 'Ullamco excepturi ir', 'zohexy@mailinator.com', '87', 'Minus dolo', '2012-09-12', 'user', '', 'cetixaaa', '$2y$10$UlANV/KpRZ77w8TCZ.MTbuWy1dLqrp2ZJ83d4XYvfzP70koKjdlIe', '2023-03-17', 'no'),
(19, '', 'Roth Deleon', 'Vero porro ipsa min', 'zigaru@mailinator.com', '49', 'Rerum quos', '1981-07-02', 'user', '', 'vipuwud', '$2y$10$xX6RWpbvU/xzQOZuTSAbTexgp30eEmJhrPQJuYX9W.SMLB2Gq2LKO', '2023-03-17', 'no'),
(20, '', 'Destiny Rush', 'Eos eos aut dolorem', 'vezyhe@mailinator.com', '31', 'Corrupti e', '2023-03-05', 'user', '', 'kuxyji', '$2y$10$Xbn9LNh8RExF1BfdTptQsecsdOP132PxWQ9rN/xHCtWmn8qaD8WR2', '2023-03-17', 'no'),
(21, '', 'Jillian Henderson', 'Facere consequatur o', 'xyhu@mailinator.com', '50', 'Nulla nihi', '1971-09-27', 'user', '', 'wynabolin', '$2y$10$b5lc1PsYjXR8jGAf4a51O.0fOgRxQJTLQpddTqzlvy1nVGV04fbq6', '2023-03-17', 'no'),
(22, '', 'Lacey Saunders', 'Quasi repudiandae et', 'vekogyje@mailinator.com', '95', 'Unde aute ', '1971-03-01', 'user', '', 'halibozuz', '$2y$10$T8Np5UY/X181KdvI519Wmu6RJ6B/2s6Txxme39SlhHSWdggzouBaK', '2023-03-17', 'no'),
(23, '', 'David Daugherty', 'Ex qui facere except', 'bora@mailinator.com', '58', 'Voluptate ', '1985-02-02', 'user', '', 'goxudilo', '$2y$10$MYtmfoBbTfq8tl5sZNBng.A4JVAh2W7xDqgGMaZNylzEIgjkBZW8u', '2023-03-17', 'no'),
(24, '', 'Norman Hayes', 'Voluptatum in volupt', 'gefahoseso@mailinator.com', '76', 'Ipsa conse', '2018-10-25', 'user', '', 'testestestes', '$2y$10$jEgORZLx6qD007czwJna.u7euGdnaXSvEhZh9KTOn1NAhSYD/fP1q', '2023-03-17', 'no'),
(25, '', 'Reese Bishop', 'Unde porro amet id ', 'fanaga@mailinator.com', '75', 'Ut ea exer', '2005-11-12', 'user', '1', 'giburika', '$2y$10$Y5CjxFuZ7YjC0sy4WP/bn..mOTo7QZRcu8Xsn7JBCfi7qY2X4P6wi', '2023-03-17', 'no'),
(26, '', 'Orson Moore', 'Et nostrum labore do', 'zynycuv@mailinator.com', '70', 'Neque iure', '1997-06-25', 'user', '', 'bassamadmin', '$2y$10$x8BADImKpFIofuGf1qC0furydw3rAHqdRAkp9oawJUEniF19jItZa', '2023-03-17', 'yes'),
(27, '', 'Honorato Woods', 'Lorem sed quae amet', 'jyhop@mailinator.com', '45', 'Molestias ', '1993-06-01', 'user', '', 'test11', '$2y$10$69rxwPQ0chII.a0MQrFYQOYCMH3jEn2GOG7McGXKIjrDnKTlEhBkK', '2023-03-20', 'no'),
(28, '', 'amoura slik', '', 'amouraslik22@gmail.com', '0612786528', 'K588090', '2000-02-02', 'user', '', 'amoura', '$2y$10$tdTCcrqAXQ5oGxKB7Fh8nOg1HlolNRHXvqPI2J8tfrfguG.ZVEaRS', '2023-03-25', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_code` varchar(10) NOT NULL,
  `product_title` varchar(200) NOT NULL,
  `product_author` varchar(100) NOT NULL,
  `langue` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  `numPages` int(11) NOT NULL,
  `product_cover_image` varchar(200) DEFAULT NULL,
  `product_condition` varchar(50) NOT NULL,
  `product_type` varchar(50) NOT NULL,
  `product_edition_date` date NOT NULL,
  `product_purchase_date` date NOT NULL,
  `product_status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_code`, `product_title`, `product_author`, `langue`, `description`, `numPages`, `product_cover_image`, `product_condition`, `product_type`, `product_edition_date`, `product_purchase_date`, `product_status`) VALUES
(118, '', 'Et est corporis mol', '23', 'Repudiandae ab adipi', 'Ipsa alias minim en', 79, './images/product-7.jpg', 'Vente', 'books', '0000-00-00', '0000-00-00', 'none'),
(119, '', 'Occaecat culpa repr', '53', 'Nam sint in accusan', 'Natus omnis sint par', 73, './images/41ReCMMmEqL.jpg', 'Location', 'books', '0000-00-00', '0000-00-00', 'none'),
(189, '', 'Qui in facere do nos', '99', 'Quo suscipit nulla a', 'Aperiam est et aspe', 32, './images/51ywBtVT2eL.jpg', 'Location', 'books', '0000-00-00', '0000-00-00', 'none'),
(193, '', 'Repellendus Modi qu', 'Jasper Valenzuela', 'Debitis non praesent', 'Beatae enim tenetur Beatae enim tenetur Beatae enim tenetur Beatae enim tenetur ', 30, './images/51DpJELacoL._SY346_.jpg', 'Vente', 'novels', '2023-03-24', '0000-00-00', 'none'),
(194, '', 'Payback in Death: An Eve Dallas Novel', 'J.D. Robb', 'English', '\r\nLt. Eve Dallas is just home from a long overdue vacation when she responds to a call of an unattended death. The victim is Martin Greenleaf, retired Internal Affairs Captain. At first glance, the sc', 368, './images/51Y7iA+8bML._SY346_.jpg', 'Location', 'magazines', '2023-03-24', '0000-00-00', 'none'),
(195, '', 'Blessing of the Lost Girls: A Brady and Walker', 'J. A. Jance’s ', 'English', 'From J. A. Jance’s New York Times bestselling Brady and Walker novels, federal investigator Dan Pardee, Brandon Walker’s son-in-law, crosses paths with Sheriff Joanna Brady as he traces the bloody pat', 0, './images/51uSv7vhzPL.jpg', 'Good', 'Novels', '2023-03-24', '0000-00-00', 'none'),
(197, '', 'Don\'t Know Jack: Hunting Lee Child\'s Jack Reacher', 'Diane Capri ', 'English', '\"Make some coffee. You\'ll read all night.\" Lee Child, #1 New York Times Bestselling Author of Jack Reacher Thrillers gives Diane Capri and her NEW Hunt for Jack Reacher Series Two Thumbs Up!\r\nUSA Toda', 155, './images/51M2b4r+Q8L._SY346_.jpg', 'New', 'Novels', '2023-03-24', '0000-00-00', 'none'),
(199, '', 'Dead to Rights ', 'J. A. Jance ', 'English', 'A woman is cruelly cut down in a remote corner of Arizona, killed on her nineteenth wedding anniversary by a drunk motorist.? A year later, the driver himself dies badly, and all suspicions point to t', 501, './images/51wx42mhcNL._SY346_.jpg', 'Acceptable', 'Novels', '2023-03-24', '0000-00-00', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `reservation_op`
--

CREATE TABLE `reservation_op` (
  `reservation_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `reservation_date` datetime NOT NULL,
  `reservation_expiry_date` datetime NOT NULL,
  `reservation_status` enum('on','off') NOT NULL DEFAULT 'on'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation_op`
--

INSERT INTO `reservation_op` (`reservation_id`, `product_id`, `member_id`, `reservation_date`, `reservation_expiry_date`, `reservation_status`) VALUES
(94, 118, 2, '2023-04-05 14:29:41', '2023-04-05 02:29:43', 'off'),
(95, 119, 2, '2023-04-05 14:32:50', '2023-04-06 14:32:50', 'off'),
(96, 118, 2, '2023-04-05 14:37:28', '2023-04-06 14:37:28', 'off'),
(97, 119, 2, '2023-04-05 14:42:40', '2023-04-06 14:42:40', 'off'),
(98, 118, 25, '2023-04-05 15:34:00', '2023-04-06 15:34:00', 'off'),
(99, 118, 25, '2023-04-05 16:04:14', '2023-04-06 16:04:14', 'off'),
(100, 119, 25, '2023-04-05 16:10:46', '2023-04-06 16:10:46', 'off');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `borrowing_op`
--
ALTER TABLE `borrowing_op`
  ADD PRIMARY KEY (`borrowing_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `reservation_op`
--
ALTER TABLE `reservation_op`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `reservation_op_ibfk_1` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `borrowing_op`
--
ALTER TABLE `borrowing_op`
  MODIFY `borrowing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `reservation_op`
--
ALTER TABLE `reservation_op`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowing_op`
--
ALTER TABLE `borrowing_op`
  ADD CONSTRAINT `borrowing_op_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `borrowing_op_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`);

--
-- Constraints for table `reservation_op`
--
ALTER TABLE `reservation_op`
  ADD CONSTRAINT `reservation_op_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `reservation_op_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
