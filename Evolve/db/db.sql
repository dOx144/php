-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2024 at 08:55 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evolve`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `username`, `password`) VALUES
(1, 'admin@test.com', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `order_id` int(50) NOT NULL,
  `product` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `quantity` int(50) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`order_id`, `product`, `customer`, `quantity`) VALUES
(101, 10, 4, 1),
(102, 6, 4, 1),
(103, 6, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(50) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`) VALUES
(1, 'Monitor'),
(9, 'Keyboard'),
(10, 'CPU'),
(11, 'Speaker'),
(12, 'Mouse'),
(13, 'Headphone');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `total_price` int(50) NOT NULL,
  `order_date` varchar(100) NOT NULL,
  `user_id` int(30) NOT NULL,
  `total_product` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL DEFAULT 'Processing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `name`, `email`, `phone`, `address`, `city`, `zip`, `country`, `payment_method`, `total_price`, `order_date`, `user_id`, `total_product`, `order_status`) VALUES
(39, 'hari', 'hari@test.com', '112', 'abc', 'ktm', '44600', 'Nepal', 'Cash', 44000, '2024-08-11', 6, 'Asus ROG Swift 360 Hz PG27AQN (1) , Razer Mouse (5) ', 'Delivered'),
(40, 'suman', 'sumanrai029017@gmail.com', '112', 'abc', 'ktm', '44600', 'Nepal', 'Cash', 7999, '2024-08-11', 4, 'Razer Mouse (1) , Fantech ALEGRO -RGB Gaming Speaker | GS302 (1) ', 'Delivered'),
(41, 'suman', 'sumanrai029017@gmail.com', '9812345678', 'abc', 'ktm', '44600', 'Nepal', 'Cash', 29000, '2024-09-12', 4, 'Asus ROG Swift 360 Hz PG27AQN (1) ', 'Delivered'),
(43, 'suman', 'sumanrai029017@gmail.com', '9812345678', 'abc', 'ktm', '44600', 'Nepal', 'Cash', 132000, '2024-10-02', 4, 'Mechanical Gaming Keyboard (1) , Philips Curved Monitor (1) , Kuro RTX Gaming PC RGB (1) ', 'Delivered'),
(44, 'suman', 'sumanrai029017@gmail.com', '9812345678', 'abc', 'ktm', '44600', 'Nepal', 'Cash', 36000, '2024-10-02', 4, 'Asus ROG Swift 360 Hz PG27AQN (1) , Mechanical Gaming Keyboard (1) ', 'Processing');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(50) NOT NULL,
  `product_image` mediumblob NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` int(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_image`, `product_name`, `price`, `description`, `category`) VALUES
(1, 0x642e6a7067, 'RGB Mouse', 1500, '2.4G wired mouse 6 keys; 800-1000-1600-2400DPI size: 100*60*40mm weight: 50g 4 Colors cool light: red-blue-green-purple 5 million times mouse clicks worth', 12),
(2, 0x632e6a7067, 'CPU', 30000, 'cpucpup cpucpu', 10),
(3, 0x6b6579626f6172642e6a7067, 'Mechanical Gaming Keyboard', 7000, 'MageGee 75% Mechanical Gaming Keyboard with Red Switch, LED Blue Backlit Keyboard, 87 Keys Compact TKL Wired Computer Keyboard for Windows Laptop PC Gamer - Black/Grey[Full anti-ghosting keyboard]: all 87 keys are no conflict, allow multiple keys to wor', 9),
(4, 0x637075312e6a7067, 'Gaming Lite Desktop CPU', 55000, 'Gaming Lite Desktop CPU Ryzen 5 5600G 8GB RAM 256GB SSD(CPU Only)\r\nEnter Gaming Casing With 1 Extra RGB Fan\r\nMSI/ASUS AM4 Compatible Board\r\n500GB NVME SSD(On Board SSD)\r\n500W Power Supply\r\n16GB DDR4 RAM\r\nOS Preinstalled\r\nFew Inbuilt Games\r\nNote: It only c', 10),
(5, 0x6d6f6e69746f72312e6a7067, 'Philips Curved Monitor', 25000, 'Philips 241E1SCA 23.6´´ LED FHD 3D Curved MonitorEU PLUG.The 24´´ curved E line display offers a truly immersive experience in a stylish design.Experience crisp Full HD visuals, and smooth action with AMD FreeSync technology.Simply immersive', 1),
(6, 0x6d6f6e69746f722e706e67, 'SAMSUNG M5 (27 Inches) Full HD LED Backlit Monitor', 30000, 'SAMSUNG M5 68.6cm (27 Inches) Full HD LED Backlit Monitor (Adaptive Picture Technology, Screen Mirroring + DLNA, 60 Hz, LS27AM500NWXXL, Black)68.6 cm (27', 1),
(7, 0x6d6f6e69746f722e6a7067, 'Asus ROG Swift 360 Hz PG27AQN', 29000, 'When Nvidia announced new RTX 3000-series graphics cards at CES, the company also promised 27-inch 1440p monitors that could hit 360 Hz to accommodate the new GPUs (today\'s fastest monitors can do 360 Hz but are limited to 1080p). Numerous brands announce', 1),
(8, 0x737065616b65722e6a7067, 'Fantech ALEGRO -RGB Gaming Speaker | GS302', 4999, ' \r\nFantech GS302 Alegro Features minimalistic RGB lighting, to enhance your gaming or music experience.\r\n\r\nFeatures:\r\n\r\nDriver Unit: 52mm\r\nSpeaker sensitivity : 80dB\r\nFrequency response : 100Hz-20KHz\r\nTotal harmonic distortion: 10%\r\nBluetooth Version : 5.', 11),
(9, 0x6370752e706e67, 'Kuro RTX Gaming PC RGB', 100000, 'CPU: Intel Core i5 12400F - 6 Cores & 12 Threads, Upto 4.40 GHzH610M/H670/B660M Chipset, 32GB DDR4 RAM | 500GB NVME SSD (up to 400% faster, over 3X the life expectancy and 9X the durability vs. traditional HDDs)Mid-Tower ATX Gaming Cabinet with Temper', 10),
(10, 0x6d6f7573652e706e67, 'Razer Mouse', 3000, 'Very good mouse', 12),
(11, 0x6672616d652e706e67, 'Computer', 1000, 'assa', 11);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(30) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `phone`, `address`, `city`, `password`) VALUES
(4, 'Ram', 'ram@test.com', '9841123123', 'Chabahil', 'Kathmandu', '$2y$10$JXDLMfLRQY4Uj2/vKSXL.uCxs3HLH2zENy3z7IKhxOZbwwoZiBEQa'),
(5, 'Sam', 'sam@test.com', '9811111111', 'abc', 'ktm', '$2y$10$qVz.jEKWdOPWUjqKxIuDF.hVbStp1nDjk2o0HpPMxKILLcadBVsgu'),
(6, 'hari', 'hari@test.com', '9812345678', 'abc', 'ktm', '$2y$10$Z8JwJ4uAZxPszUd2qEXs7OAKrKctxkEzHfypPPIMu9IYANjCMUXYG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_cust` (`customer`),
  ADD KEY `order_prod` (`product`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_order` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `cat_product` (`category`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `order_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `order_cust` FOREIGN KEY (`customer`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `order_prod` FOREIGN KEY (`product`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `user_order` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `cat_product` FOREIGN KEY (`category`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
