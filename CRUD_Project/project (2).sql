-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2021 at 05:37 AM
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
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(55) NOT NULL,
  `category_image` text NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `category_order` int(10) NOT NULL,
  `category_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_image`, `added_date`, `modified_date`, `category_order`, `category_status`) VALUES
(14, 'Microcomputers', '1609740154-601670232-micro_cp.jpg', '2021-01-04 06:02:34', '2021-01-04 06:02:34', 25, 'Active'),
(16, 'Minicomputers', '1609744002-211067790-mini_cp.jpeg', '2021-01-04 06:29:35', '2021-01-04 06:29:35', 25, 'Inactive'),
(17, 'car', '1609759286-398027480-car.jpeg', '2021-01-04 11:21:26', '2021-01-04 11:21:26', 29, 'Active'),
(18, 'Mobile', '1609847113-2014037093-mobile.jpg', '2021-01-05 11:45:13', '2021-01-05 11:45:13', 10, 'Inactive'),
(19, 'Book', '1609921380-1718789140-abc.jpg', '2021-01-06 08:23:01', '2021-01-06 08:23:01', 12, 'Active'),
(20, 'Stationary', '1609923700-1308244775-stationary.png', '2021-01-06 09:01:40', '2021-01-06 09:01:40', 5, 'Inactive'),
(22, 'Bike', '1610951042-113514466-bike.jpg', '2021-01-18 06:24:02', '2021-01-18 06:24:02', 10, 'Active'),
(23, 'Celebration Items', '1610960418-1008389122-b_cards.jpg', '2021-01-18 09:00:18', '2021-01-18 09:00:18', 25, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `image_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `image_marked` varchar(10) NOT NULL DEFAULT '0' COMMENT '0 =>Not Marked, 1 =>Marked	',
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`image_id`, `product_id`, `image_name`, `image_marked`, `added_date`) VALUES
(10, 4, '1609847237-466251342-mobile_1.jpg', '1', '2021-01-05 11:47:17'),
(14, 4, '1609849804-1887703287-mobile_2.jpg', '0', '2021-01-05 12:30:05'),
(20, 6, '1609922477-294131815-abc_1.jpg', '0', '2021-01-06 08:41:18'),
(21, 6, '1609922478-1545137987-abc_2.jpg', '0', '2021-01-06 08:41:18'),
(22, 6, '1609922478-526315740-abc_3.jpg', '1', '2021-01-06 08:41:18'),
(26, 8, '1609923090-519836659-sabc_1.jpg', '0', '2021-01-06 08:51:30'),
(27, 8, '1609923090-911806096-sabc_2.jpg', '1', '2021-01-06 08:51:30'),
(32, 10, '1609924444-548719888-eraser1.jpg', '0', '2021-01-06 09:14:04'),
(33, 10, '1609924444-694866946-eraser2.jpg', '0', '2021-01-06 09:14:05'),
(34, 10, '1609924445-986704212-eraser3.jpg', '1', '2021-01-06 09:14:05'),
(39, 13, '1610346845-916434616-color_1.png', '0', '2021-01-11 06:34:06'),
(40, 13, '1610346846-1383316315-color_2.png', '1', '2021-01-11 06:34:06'),
(63, 22, '1610952821-1269512117-bike_s1.jpg', '0', '2021-01-18 06:53:41'),
(64, 22, '1610952821-1867072896-bike_s2.jpg', '1', '2021-01-18 06:53:41'),
(66, 23, '1610952981-136792672-bike.jpg', '0', '2021-01-18 06:56:21'),
(67, 23, '1610952981-1454805173-bike_1.jpg', '1', '2021-01-18 06:56:21'),
(69, 24, '1610953179-282693047-abc.jpg', '0', '2021-01-18 06:59:39'),
(70, 24, '1610953179-827695360-abc_1.jpg', '0', '2021-01-18 06:59:40'),
(71, 24, '1610953180-715856307-abc_2.jpg', '1', '2021-01-18 06:59:40'),
(72, 25, '1610960542-1665687020-b_cards1.jpg', '0', '2021-01-18 09:02:22'),
(73, 25, '1610960542-487627547-b_cards2.jpg', '0', '2021-01-18 09:02:22'),
(74, 25, '1610960542-138036063-b_cards3.jpg', '1', '2021-01-18 09:02:22'),
(75, 1, '1611028698-394299207-micro_lap_4.jpg', '0', '2021-01-19 03:58:18'),
(76, 1, '1611555752-728711931-micro_cp.jpg', '0', '2021-01-25 06:22:33'),
(88, 2, '1611731802-112470474-micro_lap_1.jpg', '1', '2021-01-27 07:16:42'),
(89, 2, '1611731802-1279008665-micro_lap_2.jpg', '0', '2021-01-27 07:16:43'),
(90, 2, '1611731803-504301840-micro_lap_3.jpg', '0', '2021-01-27 07:16:43'),
(94, 36, '1611750907-1670247490-car.jpeg', '0', '2021-01-27 12:35:07'),
(95, 36, '1611750907-1289796487-car_1.jpg', '0', '2021-01-27 12:35:07'),
(96, 36, '1611750908-1359100113-car_2.jpg', '1', '2021-01-27 12:35:08'),
(97, 37, '1611751065-2127043803-pencil.png', '0', '2021-01-27 12:37:45'),
(98, 37, '1611751065-563627358-pencil_1.png', '0', '2021-01-27 12:37:46'),
(99, 37, '1611751066-1231472069-pencil_2.png', '1', '2021-01-27 12:37:46');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_code` varchar(50) CHARACTER SET utf8 NOT NULL,
  `price` float(9,2) NOT NULL,
  `sale_price` float(9,2) NOT NULL,
  `product_quantity` int(10) NOT NULL,
  `product_order` int(10) NOT NULL,
  `product_status` varchar(10) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `category_id`, `product_code`, `price`, `sale_price`, `product_quantity`, `product_order`, `product_status`, `added_date`, `modified_date`) VALUES
(1, 'Micro Laptop', 14, 'e65a92e43f530d451daed7bdcf1300f8', 50000.00, 54000.00, 10, 5, 'Active', '2021-01-05 08:18:42', '2021-01-05 08:18:42'),
(2, 'MiniLaptop', 16, '6560f255d7d7271311d22ae5f55b1d13', 50000.00, 52000.00, 1, 5, 'Inactive', '2021-01-05 08:31:25', '2021-01-05 08:31:25'),
(4, 'Android', 14, 'b408d65b26138b30ffb96b0531b59763', 25000.00, 35000.00, 2, 3, 'Active', '2021-01-05 11:47:17', '2021-01-05 11:47:17'),
(6, 'Capital Letters', 19, '0e34a5b13950c01412bf5e0a78c4ccfa', 50.00, 80.00, 15, 9, 'Inactive', '2021-01-06 08:41:17', '2021-01-06 08:41:17'),
(8, 'Small Letters', 19, '898c4e4d86af13a4ae99b812d38a3a4b', 80.00, 120.00, 15, 22, 'Active', '2021-01-06 08:51:30', '2021-01-06 08:51:30'),
(10, 'Eraser', 14, '97c5f444dc933165a82a783d8f092bb1', 5.00, 8.00, 10, 7, 'Inactive', '2021-01-06 09:14:04', '2021-01-06 09:14:04'),
(13, 'Color', 20, '1451a8f7b72d819a297a971c13ee85e7', 50.00, 80.00, 10, 10, 'Active', '2021-01-11 06:34:05', '2021-01-11 06:34:05'),
(22, 'Sports Bike', 22, 'faf3f3ee70e15f90a195f851e54c46f8', 10000.00, 20000.00, 5, 5, 'Active', '2021-01-18 06:53:40', '2021-01-18 06:53:40'),
(23, 'Bike', 22, 'ae19d49f50d207db96cff36270c7a11f', 25000.00, 27000.00, 5, 5, 'Active', '2021-01-18 06:56:21', '2021-01-18 06:56:21'),
(24, 'Stat_abc', 20, '998aec89a0c8616b4da99e72c9eafc09', 50.00, 58.00, 2, 12, 'Active', '2021-01-18 06:59:39', '2021-01-18 06:59:39'),
(25, 'Birthday cards', 23, '6c82b89cc9bfc1bd6c1e3826a9d75fdf', 240.00, 350.00, 10, 12, 'Active', '2021-01-18 09:02:21', '2021-01-18 09:02:21'),
(32, 'ABCD', 23, 'f7ba06fb76eec01e0754c112544b9067', 50.00, 55.00, 2, 11, 'Active', '2021-01-27 08:06:07', '2021-01-27 08:06:07'),
(33, 'Car', 17, 'ad2c6dd025440e623b352fb8f1980717', 25000.00, 35000.00, 5, 2, 'Active', '2021-01-27 11:08:21', '2021-01-27 11:08:21'),
(35, 'Car', 17, 'c04969607fa5ae934142c2c83015f97d', 5222.00, 52222.00, 5, 5, 'Active', '2021-01-27 12:34:47', '2021-01-27 12:34:47'),
(36, 'Car', 17, '157c29e4eb899bf758e4012e7ba6fbf7', 5222.00, 52222.00, 5, 5, 'Active', '2021-01-27 12:35:07', '2021-01-27 12:35:07'),
(37, 'Pencils', 20, '39d7ec6372444e7a6a28fd0e55fa7bba', 12.00, 15.00, 2, 5, 'Active', '2021-01-27 12:37:45', '2021-01-27 12:37:45');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(25) NOT NULL,
  `user_password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_password`) VALUES
(1, 'akash', 'akash123'),
(2, 'hitesh', 'hitesh123'),
(3, 'pooja', 'pooja12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
