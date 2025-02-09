-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2025 at 09:43 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(1, 'Akash Mohalkar', 'akashmohalkar46', '61a2275208c66cc4f4867f6307bc3f75'),
(2, 'Pratik Kothavale', 'pratikkothavale40', '0fa44dfd4e4e291f7108994adcdc95d2'),
(3, 'Nikhil Paudmal', 'nikhilpaudmal50', '88e68340f285424a7e038ba6e2d9a1fb'),
(4, 'Sandip Panghavane', 'sandippanghavane48', 'f38bf964eb21531b85d36e8a01b15207'),
(5, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(1, 'Starters', 'Food_Category_332.jpg', 'Yes', 'Yes'),
(2, 'Main Courses', 'Food_Category_927.jpg', 'Yes', 'Yes'),
(3, 'Rice Dishes', 'Food_Category_265.jpg', 'Yes', 'Yes'),
(4, 'Street Foods', 'Food_Category_708.jpg', 'Yes', 'Yes'),
(5, 'Snacks', 'Food_Category_305.jpg', 'Yes', 'Yes'),
(6, 'Sweets', 'Food_Category_136.jpg', 'Yes', 'Yes'),
(7, 'breakfast', 'Food_Category_666.jpg', 'Yes', 'Yes'),
(8, 'Beverages', 'Food_Category_75.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(1, 'Misal Pav', 75.00, 'Food_Name_647.jpg', 1, 'Yes', 'Yes'),
(2, 'Pav Bhaji', 85.00, 'Food_Name_768.jpg', 1, 'Yes', 'Yes'),
(3, 'Shabudana Vada', 55.00, 'Food_Name_937.jpg', 1, 'Yes', 'Yes'),
(4, 'Vada Pav', 20.00, 'Food_Name_278.jpg', 2, 'Yes', 'Yes'),
(5, 'Puranpoli', 40.00, 'Food_Name_174.jpg', 2, 'Yes', 'Yes'),
(6, 'Paneer Masala', 140.00, 'Food_Name_644.jpg', 2, 'Yes', 'Yes'),
(7, 'Masale Bhat', 120.00, 'Food_Name_554.jpg', 3, 'Yes', 'Yes'),
(8, 'Pulao', 110.00, 'Food_Name_226.jpg', 3, 'Yes', 'Yes'),
(9, 'Biryani', 160.00, 'Food_Name_403.jpg', 3, 'Yes', 'Yes'),
(10, 'Veg Biryani', 140.00, 'Food_Name_305.jpg', 3, 'Yes', 'Yes'),
(11, 'Varan Bhat', 90.00, 'Food_Name_407.jpg', 3, 'Yes', 'Yes'),
(12, 'Pani Puri', 20.00, 'Food_Name_459.jpg', 4, 'Yes', 'Yes'),
(13, 'Dahi puri', 20.00, 'Food_Name_598.jpg', 4, 'Yes', 'Yes'),
(14, 'Bhel Puri', 20.00, 'Food_Name_251.jpg', 4, 'Yes', 'Yes'),
(15, 'Chivda', 45.00, 'Food_Name_113.jpg', 5, 'Yes', 'Yes'),
(16, 'Chakli', 40.00, 'Food_Name_961.jpg', 1, 'Yes', 'Yes'),
(17, 'Dhokla', 65.00, 'Food_Name_929.jpg', 1, 'Yes', 'Yes'),
(18, 'Gulab Jam', 55.00, 'Food_Name_880.jpg', 6, 'Yes', 'Yes'),
(19, 'Pedha', 110.00, 'Food_Name_390.jpg', 6, 'Yes', 'Yes'),
(20, 'Basundi', 90.00, 'Food_Name_72.jpg', 6, 'Yes', 'Yes'),
(21, 'Jalebi', 55.00, 'Food_Name_760.jpg', 6, 'Yes', 'Yes'),
(22, 'Pohe', 20.00, 'Food_Name_116.jpg', 7, 'Yes', 'Yes'),
(23, 'Upma', 20.00, 'Food_Name_809.jpg', 7, 'Yes', 'Yes'),
(24, 'Idali', 35.00, 'Food_Name_122.jpg', 7, 'Yes', 'Yes'),
(25, 'sabudana Khichadi', 30.00, 'Food_Name_334.jpg', 7, 'Yes', 'Yes'),
(26, 'Sabudana Vada', 60.00, 'Food_Name_922.jpg', 7, 'Yes', 'Yes'),
(27, 'Chaha', 15.00, 'Food_Name_761.jpg', 8, 'Yes', 'Yes'),
(28, 'Coffee', 20.00, 'Food_Name_583.jpg', 1, 'Yes', 'Yes'),
(29, 'Lassi', 65.00, 'Food_Name_256.jpg', 8, 'Yes', 'Yes'),
(30, 'Mango Lassi', 70.00, 'Food_Name_279.jpg', 8, 'Yes', 'Yes'),
(31, 'Pizza', 130.00, 'Food_Name_892.jpg', 7, 'Yes', 'Yes'),
(32, 'Burger', 140.00, 'Food_Name_251.jpg', 7, 'Yes', 'Yes'),
(33, 'Noodles', 75.00, 'Food_Name_332.jpg', 7, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'Misal Pav', 75.00, 1, 75.00, '2024-10-14 09:04:38', 'Ordered', 'Akash', '1234543210', 'Akash@gmail.com', 'nagar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
