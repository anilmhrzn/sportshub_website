-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2023 at 01:12 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sportshub_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'rootuser', '$2y$10$oxpNcYZTrshMOxHxu3b6tOXs.Qtof4GHH4noulW8tXZ5odat6AOGG'),
(2, 'testadmin', '$2y$10$S8BFybzR5WLUJUZnuyiFf.wjT7XgGPTy6hCwy8gdc6hkcUOQOieVS');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Football'),
(2, 'Cricket'),
(3, 'Basketball'),
(4, 'Table Tennis'),
(5, 'Volleyball'),
(6, 'Badminton');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` bigint(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone_number`, `address`, `username`, `password`) VALUES
(1, 'Anil Maharjan', 'anilmaharjan995@gmail.com', 9823673702, 'Manamaiju', 'mahendra12345', '$2y$10$M.gL/0s29XBQg226eGlvlunoweoefjF/6rcjw7JYiz4dzoW7TRKRi'),
(2, 'Mahendra Maharjan', 'mahendramhrz@gmail.com', 9865079074, 'manamaiju', 'mahendra123', '$2y$10$ieeB6C5K6GgnILTg90C4QeCqNVYxc1q/2gii9cLHQjglYv0iBL2T6'),
(3, 'hello', 'hellow12@gmail.com', 9860611473, 'kathmandu', 'hellow1', '$2y$10$xHtnn4dECirx0wmACogCcOK8dI.BmYHKUg6gZ6.ciuJy73QZiIFwS'),
(4, 'dipendra', 'dipenadk3@gmail.com', 9876543987, 'kathmandu', 'dipendra', '$2y$10$Rxxgfgk.z2wJQwfRAO9sX.AYPnmU6Tlo.EfbpBBzoAgYo2Xf9lnGK');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_tbl`
--

CREATE TABLE `feedback_tbl` (
  `c_id` int(11) DEFAULT NULL,
  `feedbacks` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feedback_tbl`
--

INSERT INTO `feedback_tbl` (`c_id`, `feedbacks`) VALUES
(1, 'Bad UI'),
(1, 'hellow'),
(1, 'hellow sir'),
(1, 'nice items'),
(1, 'jjjjj'),
(1, 'hellooo');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `o_id` int(11) NOT NULL,
  `paymentRequestId` varchar(255) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `total_price` bigint(20) DEFAULT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT 0,
  `delivery_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`o_id`, `paymentRequestId`, `cus_id`, `total_price`, `payment_status`, `delivery_status`) VALUES
(1, 'anil12345-89949', 1, 3998, 0, 1),
(2, 'anil12345-933122', 1, 4300, 0, 1),
(3, 'anilmaharjan995-906719', 1, 1999, 1, 0),
(4, 'mahendra123-319798', 2, 350, 0, 0),
(5, 'mahendra12345-450032', 1, 6999, 0, 1),
(6, 'mahendra12345-792286', 1, 6999, 0, 1),
(7, 'mahendra12345-767871', 1, 1999, 0, 0),
(8, 'mahendra12345-563069', 1, 1999, 0, 0),
(9, 'mahendra12345-201478', 1, 4650, 0, 0),
(10, 'hellow1-900132', 3, 1999, 0, 0),
(11, 'hellow1-603182', 3, 1999, 0, 0),
(12, 'hellow1-45521', 3, 1000, 0, 0),
(13, 'dipendra-316483', 4, 1000, 0, 0),
(14, 'mahendra12345-356837', 1, 5000, 0, 0),
(15, 'mahendra12345-374192', 1, 4050, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sub_categories_id` int(11) DEFAULT NULL,
  `price` int(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `popular` tinyint(1) DEFAULT 0,
  `image_address` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `sub_categories_id`, `price`, `description`, `popular`, `image_address`, `status`) VALUES
(1, 'Portugal Home Jeresy', 1, 1, 1999, 'Euro 2016 Men Soccer Jersey Red ', 1, './../images/portugal_home_7_euro_2016.jpg', 1),
(2, 'Agility500 Football Boots', 1, 8, 5000, 'Mens Football Boots Agility 500 Pro FG ', 1, './../images/agility500.jpg', 1),
(3, 'Franklin Gloves', 1, 3, 1000, 'Football receiver gloves', 1, './../images/franklinGloves.jpg', 1),
(4, ' Barca Jersey ', 1, 1, 2150, 'Barca Home jersey', 0, './../images/barca_home_jersy.jpg', 1),
(5, 'Real Madrid Jersey', 1, 1, 2500, 'Real Madrid Home Jersey', 0, './../images/realMadridJersey.jpg', 1),
(6, 'adidas X Tango shoes', 1, 8, 3000, 'adidas X Tango 18.4 IN - Mens Soccer Cleats - Indoor - Yellow\r\nadidas X Tango', 0, './../images/addidasTango.jpg', 1),
(7, ' Team Chelsea FC Football ', 1, 6, 2000, '\r\nTeam Chelsea FC Strike Football ', 0, './../images/teamChelsaFootball.jpg', 1),
(8, ' Adjustable Tool Football Strap ', 1, 6, 800, '\r\nAdjustable Tool Football Strap Training Aid Practice Control Skills Elastic Returner Durable', 0, './../images/AdjustableToolFootbalStrap.jpg', 1),
(9, 'Spain Home Adidas Football Shorts ', 1, 2, 800, '\r\n2018-2019 Spain Home Adidas Football Shorts (Kids) ', 0, './../images/spainHomeShorts.jpg', 1),
(10, 'Adidas Juventus Socks ', 1, 4, 300, 'adidas Juventus 2018/19 Third Socks - Mens Replica - Socks - Carbon/Shock Yellow | Pro:Direct Soccer', 0, './../images/adidasJuventusShocks.jpg', 1),
(11, ' Adidas Chelsea FC Soccer Cap ', 1, 5, 350, '\r\nAdidas Chelsea FC Soccer Cap - Blue ', 0, './../images/Adidas-Chelsea-FC-Soccer-Cap-SDL970443802-2-a5190.jpg', 0),
(12, 'Addidas Shin Gaurd', 1, 7, 1600, '\r\nadidas Adult X Reflex Soccer Shin Guards', 0, './../images/addidasShinGaurds.jpg', 1),
(13, 'Cricket t20 Worldcup T Shirt', 2, 1, 1800, '\r\nMen Australia Cricket t20 Worldcup T Shirt 2017 Medium', 0, './../images/menAustraliaCricketT20.jpg', 1),
(14, 'Surridge Sport shorts', 2, 2, 900, '\r\nSurridge Sport - Cobo Cricket Blade Training Short', 0, './../images/surridgeSport.jpg', 1),
(15, 'Cricket Batting Gloves ', 2, 3, 1999, ' SG Cricket Litevate Cricket Batting Gloves Mens Size', 0, './../images/sgCriketGloves.jpg', 1),
(16, 'Cricket ball Seamer', 2, 6, 1500, 'Cricket ball seamer by cricket eqauipment USA', 0, './../images/cricket-ball-seamer-by-cricket-equipment-usa.jpg', 1),
(17, ' Cricket Cap Australian', 2, 5, 600, '\r\nCricket Cap Australian Cricket Cap signed by Glenn McGrath', 0, './../images/cricket-cap.jpg', 1),
(18, 'SG Leg Gaurds', 2, 7, 1400, 'SG white cricket Leg Guards', 0, './../images/SG-white-cricket-Leg-Guards.jpg', 1),
(19, 'SS Elite Shoes', 2, 8, 2100, '\r\nSS Elite Rubber Studs Cricket Shoes', 0, './../images/SS_SH_00001_large_shoes.jpg', 1),
(20, ' EUEU Basketball Jersey', 3, 1, 1999, '\r\nEUEU Custom Basketball Jersey Abbigliamento Michael Bulls NO.23 Chicago Jordan 1997-98 Hardwood', 0, './../images/BasketballJerseyEUEU.jpg', 1),
(21, 'football', 1, 6, -5000, 'football jk', 0, './../images/agility500.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products_orderd`
--

CREATE TABLE `products_orderd` (
  `o_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `Quantity` int(20) NOT NULL,
  `Price` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products_orderd`
--

INSERT INTO `products_orderd` (`o_id`, `product_id`, `Quantity`, `Price`) VALUES
(1, 1, 2, 1999),
(2, 4, 2, 2150),
(3, 1, 1, 1999),
(4, 11, 1, 350),
(5, 2, 1, 5000),
(5, 1, 1, 1999),
(6, 2, 1, 5000),
(6, 1, 1, 1999),
(7, 1, 1, 1999),
(8, 1, 1, 1999),
(9, 4, 1, 2150),
(9, 5, 1, 2500),
(10, 20, 1, 1999),
(11, 20, 1, 1999),
(12, 3, 1, 1000),
(13, 3, 1, 1000),
(14, 2, 1, 5000),
(15, 3, 1, 1000),
(15, 4, 1, 2150),
(15, 14, 1, 900);

-- --------------------------------------------------------

--
-- Table structure for table `sales_data`
--

CREATE TABLE `sales_data` (
  `id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Sales` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sales_data`
--

INSERT INTO `sales_data` (`id`, `Date`, `Sales`) VALUES
(1, '2023-09-28', '1000.00'),
(2, '2023-09-29', '1200.50'),
(3, '2023-01-03', '950.25'),
(4, '2023-01-04', '1100.75'),
(5, '2023-01-05', '1300.80'),
(6, '2023-01-06', '1150.00'),
(7, '2023-01-07', '1350.25'),
(8, '2023-01-08', '1225.50'),
(9, '2023-01-09', '1000.75'),
(10, '2023-01-10', '1125.90'),
(11, '2023-09-18', '1280.45'),
(12, '2023-09-19', '1400.75'),
(13, '2023-09-20', '1250.60'),
(14, '2023-09-21', '1325.75'),
(15, '2023-09-22', '1050.30'),
(16, '2023-09-23', '1150.20'),
(17, '2023-09-24', '1210.95'),
(18, '2023-09-25', '1275.40'),
(19, '2023-09-26', '1375.80'),
(20, '2023-09-27', '1425.10');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `product_id` int(11) DEFAULT NULL,
  `stocks_left` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`product_id`, `stocks_left`) VALUES
(1, 1),
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`) VALUES
(1, 'T-shirt'),
(2, 'Shorts'),
(3, 'Gloves'),
(4, 'Shocks'),
(5, 'Caps'),
(6, 'Tools'),
(7, 'Gaurds'),
(8, 'Shoes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
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
-- Indexes for table `feedback_tbl`
--
ALTER TABLE `feedback_tbl`
  ADD KEY `customer_feedbacks` (`c_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `ordersOfCustomers` (`cus_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_categoryNDproducts` (`category_id`);

--
-- Indexes for table `products_orderd`
--
ALTER TABLE `products_orderd`
  ADD KEY `productsOrederedInOrders` (`o_id`),
  ADD KEY `diffProductsOrderedInOrders` (`product_id`);

--
-- Indexes for table `sales_data`
--
ALTER TABLE `sales_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD KEY `FK_stocksNDproducts` (`product_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sales_data`
--
ALTER TABLE `sales_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback_tbl`
--
ALTER TABLE `feedback_tbl`
  ADD CONSTRAINT `customer_feedbacks` FOREIGN KEY (`c_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `ordersOfCustomers` FOREIGN KEY (`cus_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_categoryNDproducts` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `products_orderd`
--
ALTER TABLE `products_orderd`
  ADD CONSTRAINT `diffProductsOrderedInOrders` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `productsOrederedInOrders` FOREIGN KEY (`o_id`) REFERENCES `orders` (`o_id`);

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `FK_stocksNDproducts` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
