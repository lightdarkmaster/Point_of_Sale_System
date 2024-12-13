-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2024 at 05:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_system_database_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `is_ban` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=not_ban,1=ban',
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `phone`, `is_ban`, `created_at`) VALUES
(1, 'christian', 'chan@gmail.com', '$2y$10$n8YbcWRQp1.g7Zi9sFbws.IsMIDfcyvu04Vvh/gxxsSupmOw75wk.', '09464540398', 0, '2024-12-10'),
(2, 'admin', 'admin@gmail.com', '$2y$10$gOmXK35QKI5jMMWDp9lGrumQMtpsQTOTSuKICTzb5yHrfDw8jc4yG', '0912345678', 0, '2024-12-10');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(20) NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=visible,1=hidden'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `status`) VALUES
(1, 'Electronics', 'Electronics Division', 0),
(2, 'Smartphones', 'Samsung S23 Ultra', 1),
(4, 'Clothing', 'Clothing division', 0),
(5, 'Laptops', 'Portable Personal Computers.', 0),
(6, 'Watch', 'Luxury watch', 0),
(8, 'Appliances', 'Electronic Appliances', 0),
(9, 'Motorcycles', 'Motor transports vechicles.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=visible,1=hidden',
  `create_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `status`, `create_at`) VALUES
(1, 'Policarpio Macalacala', 'policarpio.pogi@gmail.com', '09123466677', 0, '2024-12-12'),
(2, 'Bernardo Makabuksit', 'bernardo@gmail.com', '09123987654', 0, '2024-12-12'),
(4, 'Simoy Macapugas', 'simoy.gwapo@gmail.com', '09978978978', 0, '2024-12-12'),
(9, 'Sebastian Pakla', 'sebseb@gmail.com', '09202020201119', 0, '2024-12-13');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `tracking_no` varchar(100) NOT NULL,
  `invoice_no` varchar(100) NOT NULL,
  `total_amount` varchar(100) NOT NULL,
  `order_date` date NOT NULL,
  `order_status` varchar(100) DEFAULT NULL,
  `payment_mode` varchar(100) NOT NULL COMMENT 'cash, online',
  `order_placed_by_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `tracking_no`, `invoice_no`, `total_amount`, `order_date`, `order_status`, `payment_mode`, `order_placed_by_id`) VALUES
(1, 4, '967312', 'INV-722772', '1055388', '2024-12-13', 'booked', 'Cash Payment', 1),
(2, 4, '840048', 'INV-266732', '183964', '2024-12-13', 'booked', 'Online Payment', 1),
(3, 4, '585819', 'INV-792165', '185265', '2024-12-13', 'booked', 'Online Payment', 1),
(5, 1, '814477', 'INV-252464', '901277', '2024-12-13', 'booked', 'Cash Payment', 1),
(6, 9, '982783', 'INV-717115', '95677', '2024-12-13', 'booked', 'Cash Payment', 1),
(7, 4, '124032', 'INV-237446', '95677', '2024-12-13', 'booked', 'Cash Payment', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `price`, `quantity`) VALUES
(1, 1, 11, '899589', '1'),
(2, 1, 10, '155799', '1'),
(3, 2, 1, '89588', '2'),
(4, 2, 4, '4788', '1'),
(5, 3, 2, '95677', '1'),
(6, 3, 1, '89588', '1'),
(7, 4, 8, '56899', '1'),
(8, 4, 1, '89588', '1'),
(9, 5, 7, '896489', '1'),
(10, 5, 4, '4788', '1'),
(11, 6, 2, '95677', '1'),
(12, 7, 2, '95677', '1');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=visible,1=hidden',
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `quantity`, `image`, `status`, `created_at`) VALUES
(1, 2, 'Samsung S24 Ultra', '200mp camera', 89588, 6, 'assets/uploads/products/1733945751.png', 0, '2024-12-11'),
(2, 2, 'Iphone 16 Pro max', '48mp Camera, 8k 60fps recording.', 95677, 2, 'assets/uploads/products/1733945770.png', 0, '2024-12-11'),
(3, 2, 'Huawei Pura 70', 'Huawei Pura 70 Best Camera of 2024', 67899, 12, 'assets/uploads/products/1733902741.png', 1, '2024-12-11'),
(4, 4, 'Levis Pants', 'Pants xl, small, medium', 4788, 8, 'assets/uploads/products/1733909667.png', 0, '2024-12-11'),
(6, 5, 'ACER Predator', 'Predator · Intel® Core™ i9-14900HX processor', 99749, 7, 'assets/uploads/products/1733950667.png', 0, '2024-12-12'),
(7, 6, 'Rolex t 41', '41 mm,Datejust M126334-0006', 896489, 3, 'assets/uploads/products/1733951413.png', 0, '2024-12-12'),
(8, 1, 'Canon Camera', 'Camera 8k resolution recording.', 56899, 1, 'assets/uploads/products/1733999416.png', 0, '2024-12-12'),
(9, 8, 'LG Refrigerator', '24.2 Cu. Ft. Objet Collection French Door InstaView', 151495, 5, 'assets/uploads/products/1734000843.png', 0, '2024-12-12'),
(10, 9, 'Sniper 155r', '4 cyclinder SOCH', 155799, 18, 'assets/uploads/products/1734064882.png', 0, '2024-12-13'),
(11, 9, 'Ninja 400', '400cc', 899589, 9, 'assets/uploads/products/1734064922.png', 0, '2024-12-13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
