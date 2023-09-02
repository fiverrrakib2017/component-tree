-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2023 at 01:49 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `branch_name`, `date`) VALUES
(1, 'Gulshan-1', '2023-08-25'),
(2, 'Mohakhali DOSH', '2023-08-26'),
(3, 'Mirpur10', '2023-08-25'),
(4, 'Hatirjil', '2023-08-26');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `date`) VALUES
(1, 'Asset', 0, '2023-08-25'),
(2, 'Cash in hand', 1, '2023-08-25'),
(3, 'Cash out', 1, '2023-08-25'),
(4, 'Expense', 0, '2023-08-25'),
(5, 'Office Supplies', 4, '2023-08-25'),
(6, 'purchase book', 5, '2023-08-25'),
(10, 'database design book', 6, '0000-00-00'),
(14, 'Arif', 0, '2023-08-26'),
(15, 'office time', 14, '2023-08-26'),
(16, 'arif child', 14, '2023-08-26'),
(17, 'at 10 am', 15, '2023-08-26'),
(18, 'asdfasdf', 17, '2023-08-26'),
(19, 'another', 18, '2023-08-26'),
(20, 'another 2', 18, '2023-08-26'),
(21, 'one two three', 10, '2023-08-26');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `supplier_name` varchar(55) NOT NULL,
  `total_amount` int(55) NOT NULL,
  `paid_amount` int(55) NOT NULL,
  `due_amount` int(55) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `supplier_name`, `total_amount`, `paid_amount`, `due_amount`, `date`) VALUES
(8, 'Rakib Mahmud', 15000, 10000, 5000, '2023-08-26'),
(9, 'Rakib Mahmud', 500, 500, 0, '2023-08-26'),
(10, 'Rakib Mahmud', 500, 500, 0, '2023-08-26'),
(11, 'Rakib Mahmud', 2000, 1000, 1000, '2023-08-26');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_name` varchar(55) NOT NULL,
  `product_unit` varchar(55) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `branch_name` varchar(55) NOT NULL,
  `invoice_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invoice_id`, `product_name`, `product_unit`, `qty`, `price`, `discount`, `total_price`, `branch_name`, `invoice_file`) VALUES
(6, 8, '0', 'KG', 1, 12500, 0, 12500, 'Gulshan-1', '../image/1011165546.jpg'),
(7, 8, '0', 'KG', 1, 5000, 50, 2500, 'Mirpur10', '../image/950534906.jpg'),
(8, 9, 'Bluetooth microphone ', 'KG', 1, 500, 0, 500, 'Gulshan-1', '../image/376054835.jpg'),
(9, 10, 'Bluetooth microphone ', 'KG', 1, 500, 0, 500, 'Gulshan-1', '../image/1246775597.jpg'),
(10, 11, 'Buds Air Tws Wireless', 'KG', 2, 500, 0, 750, 'Mohakhali DOSH', '../image/163860244.jpg'),
(11, 11, 'Buds Air Tws Wireless', 'KG', 2, 100, 50, 100, 'Gulshan-1', '../image/2057213991.jpg'),
(12, 11, 'I Phone 6s ', 'KG', 4, 300, 50, 1150, 'Mirpur10', '../image/856459787.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(55) NOT NULL,
  `price` int(11) NOT NULL,
  `create_date` date NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `create_date`, `image`) VALUES
(1, 'Buds Air Tws Wireless', 500, '2023-08-19', 'https://static-01.daraz.com.bd/p/da0bb799ca7ec839f53fe6860f7c29b4.jpg_188x188.jpg_.webp'),
(2, 'Bluetooth microphone ', 990, '2023-08-19', 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHx8MA%3D%3D&w=1000&q=80'),
(3, 'I Phone 6s ', 29000, '2023-08-19', 'https://static-01.daraz.com.bd/p/da0bb799ca7ec839f53fe6860f7c29b4.jpg_188x188.jpg_.webp'),
(4, 'Redmi 9 pro max', 23000, '2023-08-19', 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHx8MA%3D%3D&w=1000&q=80');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` int(55) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `supplier_name`, `address`, `phone`, `date`) VALUES
(1, 'Rakib Mahmud', 'daudkandi,cumilla', 1757967432, '2023-08-25'),
(2, 'Shakib Khan', 'gouripur,cumilla', 1757967432, '2023-08-26');

-- --------------------------------------------------------

--
-- Table structure for table `tree`
--

CREATE TABLE `tree` (
  `id` int(11) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tree`
--
ALTER TABLE `tree`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tree`
--
ALTER TABLE `tree`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
