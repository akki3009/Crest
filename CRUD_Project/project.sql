-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2021 at 08:10 AM
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
(14, 'Microcomputers', '1609740154-601670232-micro_cp.jpg', '2021-01-04 06:02:34', '2021-01-04 06:02:34', 15, 'Active'),
(16, 'Minicomputers', '1609744002-211067790-mini_cp.jpeg', '2021-01-04 06:29:35', '2021-01-04 06:29:35', 25, 'Inactive'),
(17, 'car', '1609759286-398027480-car.jpeg', '2021-01-04 11:21:26', '2021-01-04 11:21:26', 1, 'Active'),
(18, 'Mobile', '1609847113-2014037093-mobile.jpg', '2021-01-05 11:45:13', '2021-01-05 11:45:13', 10, 'Inactive'),
(19, 'Book', '1609921380-1718789140-abc.jpg', '2021-01-06 08:23:01', '2021-01-06 08:23:01', 12, 'Active'),
(20, 'Stationary', '1609923700-1308244775-stationary.png', '2021-01-06 09:01:40', '2021-01-06 09:01:40', 5, 'Inactive'),
(22, 'Bike', '1610951042-113514466-bike.jpg', '2021-01-18 06:24:02', '2021-01-18 06:24:02', 10, 'Active');

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
(1, 1, '1609834723-978819558-micro_lap_1.jpg', '0', '2021-01-05 08:18:43'),
(2, 1, '1609834723-24699145-micro_lap_2.jpg', '0', '2021-01-05 08:18:43'),
(3, 1, '1609834723-1200050086-micro_lap_3.jpg', '0', '2021-01-05 08:18:43'),
(4, 1, '1609834957-220261509-micro_cp.jpg', '1', '2021-01-05 08:22:37'),
(5, 2, '1609835485-608209494-mini_lap.jpg', '0', '2021-01-05 08:31:25'),
(6, 2, '1609835485-560114497-mini_lap_1.jpg', '1', '2021-01-05 08:31:25'),
(7, 3, '1609846936-584221781-car_1.jpg', '1', '2021-01-05 11:42:16'),
(8, 3, '1609846995-1320640097-car.jpeg', '0', '2021-01-05 11:43:15'),
(10, 4, '1609847237-466251342-mobile_1.jpg', '0', '2021-01-05 11:47:17'),
(12, 4, '1609847237-231105044-mobile_3.jpg', '1', '2021-01-05 11:47:17'),
(14, 4, '1609849804-1887703287-mobile_2.jpg', '0', '2021-01-05 12:30:05'),
(15, 3, '1609850078-455212887-car_2.jpg', '0', '2021-01-05 12:34:38'),
(20, 6, '1609922477-294131815-abc_1.jpg', '0', '2021-01-06 08:41:18'),
(21, 6, '1609922478-1545137987-abc_2.jpg', '0', '2021-01-06 08:41:18'),
(22, 6, '1609922478-526315740-abc_3.jpg', '1', '2021-01-06 08:41:18'),
(26, 8, '1609923090-519836659-sabc_1.jpg', '0', '2021-01-06 08:51:30'),
(27, 8, '1609923090-911806096-sabc_2.jpg', '1', '2021-01-06 08:51:30'),
(29, 9, '1609923889-605991412-pencil.png', '0', '2021-01-06 09:04:49'),
(30, 9, '1609923889-1882452177-pencil_1.png', '0', '2021-01-06 09:04:49'),
(31, 9, '1609923889-2018947130-pencil_2.png', '1', '2021-01-06 09:04:49'),
(32, 10, '1609924444-548719888-eraser1.jpg', '0', '2021-01-06 09:14:04'),
(33, 10, '1609924444-694866946-eraser2.jpg', '0', '2021-01-06 09:14:05'),
(34, 10, '1609924445-986704212-eraser3.jpg', '1', '2021-01-06 09:14:05'),
(35, 1, '1610339660-879644650-micro_lap_4.jpg', '0', '2021-01-11 04:34:21'),
(39, 13, '1610346845-916434616-color_1.png', '0', '2021-01-11 06:34:06'),
(40, 13, '1610346846-1383316315-color_2.png', '1', '2021-01-11 06:34:06'),
(63, 22, '1610952821-1269512117-bike_s1.jpg', '0', '2021-01-18 06:53:41'),
(64, 22, '1610952821-1867072896-bike_s2.jpg', '1', '2021-01-18 06:53:41'),
(66, 23, '1610952981-136792672-bike.jpg', '0', '2021-01-18 06:56:21'),
(67, 23, '1610952981-1454805173-bike_1.jpg', '1', '2021-01-18 06:56:21'),
(69, 24, '1610953179-282693047-abc.jpg', '0', '2021-01-18 06:59:39'),
(70, 24, '1610953179-827695360-abc_1.jpg', '0', '2021-01-18 06:59:40'),
(71, 24, '1610953180-715856307-abc_2.jpg', '1', '2021-01-18 06:59:40');

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
(1, 'Micro Laptop', 14, 'e65a92e43f530d451daed7bdcf1300f8', 50000.00, 54000.00, 1, 0, 'Active', '2021-01-05 08:18:42', '2021-01-05 08:18:42'),
(2, 'MiniLaptop', 16, '6560f255d7d7271311d22ae5f55b1d13', 50000.00, 52000.00, 1, 1, 'Inactive', '2021-01-05 08:31:25', '2021-01-05 08:31:25'),
(3, 'VolvoCar', 17, '47cfae2c33919f1e7724bac64cd823b6', 100000.00, 120000.00, 12, 10, 'Inactive', '2021-01-05 11:42:15', '2021-01-05 11:42:15'),
(4, 'Android', 18, 'b408d65b26138b30ffb96b0531b59763', 25000.00, 35000.00, 5, 20, 'Active', '2021-01-05 11:47:17', '2021-01-05 11:47:17'),
(6, 'Capital Letters', 19, '0e34a5b13950c01412bf5e0a78c4ccfa', 50.00, 80.00, 10, 21, 'Inactive', '2021-01-06 08:41:17', '2021-01-06 08:41:17'),
(8, 'Small Letters', 19, '898c4e4d86af13a4ae99b812d38a3a4b', 80.00, 120.00, 15, 22, 'Active', '2021-01-06 08:51:30', '2021-01-06 08:51:30'),
(9, 'Pencils', 20, '8b5a3bb8bee61eae1a53974ce5a75047', 59.00, 70.00, 25, 40, 'Active', '2021-01-06 09:04:49', '2021-01-06 09:04:49'),
(10, 'Eraser', 20, '97c5f444dc933165a82a783d8f092bb1', 5.00, 8.00, 10, 12, 'Inactive', '2021-01-06 09:14:04', '2021-01-06 09:14:04'),
(13, 'Color', 20, '1451a8f7b72d819a297a971c13ee85e7', 50.00, 80.00, 10, 10, 'Active', '2021-01-11 06:34:05', '2021-01-11 06:34:05'),
(22, 'Sports Bike', 22, 'faf3f3ee70e15f90a195f851e54c46f8', 10000.00, 20000.00, 5, 5, 'Active', '2021-01-18 06:53:40', '2021-01-18 06:53:40'),
(23, 'Bike', 22, 'ae19d49f50d207db96cff36270c7a11f', 25000.00, 27000.00, 5, 5, 'Active', '2021-01-18 06:56:21', '2021-01-18 06:56:21'),
(24, 'Stat_abc', 20, '998aec89a0c8616b4da99e72c9eafc09', 50.00, 58.00, 2, 12, 'Active', '2021-01-18 06:59:39', '2021-01-18 06:59:39');

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
(3, 'pooja@gmail.com', 'pooja12345');

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
