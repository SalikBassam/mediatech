-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2023 at 05:13 AM
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
(1, 'BassamSalik2', 'pass123', 'salikbassam@email.com', 'bassam salik');

-- --------------------------------------------------------

--
-- Table structure for table `borrowing_op`
--

CREATE TABLE `borrowing_op` (
  `borrowing_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `borrowing_date` date NOT NULL,
  `borrowing_return_date` date NOT NULL,
  `borrowing_actual_return_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, '', 'Colt Zamora', 'Et dolorum ex quam e', 'kesi@mailinator.com', '+1 (241) 607-3181', 'Deleniti a', '1979-09-27', 'user', '', 'makydimano', '$2y$10$NIIABSMhrMBPflvuG56xw.3JUNVucgYIB6dULWqFfHRJwA/r0chxq', '2023-03-17', 'no'),
(2, '', 'Holmes Gillespie', 'Quos soluta consequu', 'piqypiq@mailinator.com', '5', 'Ab irure a', '2004-01-24', 'user', '', 'sozibahyte', '$2y$10$dYONlkVPWdqRKjcZsMRCx.vNUk1vqguFVSsZKCys33.MhlR00H.y2', '2023-03-17', 'no'),
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
(25, '', 'Reese Bishop', 'Unde porro amet id ', 'fanaga@mailinator.com', '75', 'Ut ea exer', '2005-11-12', 'user', '', 'giburika', '$2y$10$Y5CjxFuZ7YjC0sy4WP/bn..mOTo7QZRcu8Xsn7JBCfi7qY2X4P6wi', '2023-03-17', 'no'),
(26, '', 'Orson Moore', 'Et nostrum labore do', 'zynycuv@mailinator.com', '70', 'Neque iure', '1997-06-25', 'user', '', 'bassamadmin', '$2y$10$x8BADImKpFIofuGf1qC0furydw3rAHqdRAkp9oawJUEniF19jItZa', '2023-03-17', 'yes');

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
  `product_num_pages` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_code`, `product_title`, `product_author`, `langue`, `description`, `numPages`, `product_cover_image`, `product_condition`, `product_type`, `product_edition_date`, `product_purchase_date`, `product_num_pages`) VALUES
(1, 'ABC123', 'Sample Product', 'John Doe', 'English', 'This is a sample product description', 200, 'product-7.jpg', 'New', 'Book', '2022-03-16', '2022-03-16', 300);

-- --------------------------------------------------------

--
-- Table structure for table `reservation_op`
--

CREATE TABLE `reservation_op` (
  `reservation_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_expiry_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  ADD KEY `product_id` (`product_id`),
  ADD KEY `member_id` (`member_id`);

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
  MODIFY `borrowing_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reservation_op`
--
ALTER TABLE `reservation_op`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT;

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
