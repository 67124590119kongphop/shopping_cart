-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2025 at 06:34 PM
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
-- Database: `shopping_cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank`
--

CREATE TABLE `tbl_bank` (
  `b_id` int(11) NOT NULL,
  `b_name` varchar(100) NOT NULL,
  `b_type` varchar(100) NOT NULL,
  `b_number` varchar(20) NOT NULL,
  `b_owner` varchar(100) NOT NULL,
  `bn_name` varchar(100) NOT NULL,
  `b_logo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_bank`
--

INSERT INTO `tbl_bank` (`b_id`, `b_name`, `b_type`, `b_number`, `b_owner`, `bn_name`, `b_logo`) VALUES
(2, 'กสิกรไทย', 'ออมทรัพย์', '1973324175', 'ก้องภพ ปานเปีย', 'กาญจนบุรี', '48756020220250913_012405.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `member_id` int(11) NOT NULL,
  `m_user` varchar(20) NOT NULL,
  `m_pass` varchar(20) NOT NULL,
  `m_level` varchar(50) NOT NULL,
  `m_name` varchar(100) NOT NULL,
  `m_email` varchar(100) NOT NULL,
  `m_tel` varchar(20) NOT NULL,
  `m_address` varchar(200) NOT NULL,
  `m_img` varchar(250) NOT NULL,
  `date_save` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`member_id`, `m_user`, `m_pass`, `m_level`, `m_name`, `m_email`, `m_tel`, `m_address`, `m_img`, `date_save`) VALUES
(4, 'admin', '123456', 'admin', 'kongphop', '67124590119@gmail.com', '0929149862', 'kanchanaburi', '170779789520250917_231412.PNG', '2021-06-01 19:09:04'),
(5, 'member', '123456', 'member', 'member', 'member@gmail.com', '123665544', 'kanchanaburi', 'm_1758466951.jpg', '2025-09-12 17:22:29'),
(6, 'solo', '123456', 'member', 'solo', 'solo@gmail.com', '0922222', '66/77', '62240408120250918_003910.png', '2025-09-17 17:26:12'),
(7, 'best', '123456', 'member', 'best1305', 'best@gmail.com', '0929149862', '66/7', '55971813820250918_003654.jpg', '2025-09-17 17:36:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `o_id` int(11) NOT NULL,
  `o_date` datetime NOT NULL,
  `member_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` enum('pending','paid','shipped','completed','cancelled') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`o_id`, `o_date`, `member_id`, `total`, `status`) VALUES
(1, '2025-09-19 20:35:24', 5, 759.00, ''),
(2, '2025-09-19 20:41:06', 5, 759.00, ''),
(3, '2025-09-19 20:42:13', 5, 879.00, ''),
(4, '2025-09-21 20:17:39', 5, 759.00, ''),
(5, '2025-09-21 20:21:28', 5, 879.00, ''),
(6, '2025-09-21 22:37:40', 4, 759.00, 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_detail`
--

CREATE TABLE `tbl_order_detail` (
  `od_id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `p_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order_detail`
--

INSERT INTO `tbl_order_detail` (`od_id`, `o_id`, `p_id`, `qty`, `p_price`) VALUES
(1, 2, 5, 1, 0),
(2, 3, 5, 1, 0),
(3, 3, 6, 1, 0),
(4, 4, 5, 1, 0),
(5, 5, 6, 1, 0),
(6, 5, 5, 1, 0),
(7, 6, 5, 1, 759);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `pay_id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `pay_amount` decimal(10,2) NOT NULL,
  `pay_date` date NOT NULL,
  `pay_time` time NOT NULL,
  `pay_slip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`pay_id`, `o_id`, `bank_id`, `pay_amount`, `pay_date`, `pay_time`, `pay_slip`) VALUES
(1, 5, 2, 879.00, '2025-09-21', '21:41:00', 'slip_1758465955.png'),
(2, 1, 2, 759.00, '2025-09-21', '21:49:00', 'slip_1758466160.png'),
(3, 6, 2, 796.00, '2025-09-21', '22:39:00', 'slip_1758469201.JPG'),
(4, 3, 2, 999.00, '2025-09-21', '22:41:00', 'slip_1758469270.jpg'),
(5, 2, 2, 999.00, '2025-09-21', '22:41:00', 'slip_1758469315.JPG'),
(6, 4, 2, 888.00, '2025-09-21', '22:42:00', 'slip_1758469340.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(200) NOT NULL,
  `type_id` int(11) NOT NULL,
  `p_detail` text NOT NULL,
  `p_img` varchar(200) NOT NULL,
  `p_price` int(11) NOT NULL,
  `p_qty` varchar(11) NOT NULL,
  `p_unit` varchar(20) NOT NULL,
  `p_view` int(10) NOT NULL DEFAULT 0,
  `datesave` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`p_id`, `p_name`, `type_id`, `p_detail`, `p_img`, `p_price`, `p_qty`, `p_unit`, `p_view`, `datesave`) VALUES
(5, 'boss', 4, 'ิbossมืด1ตัว รูบี้ 3200 ', '117037637820250917_230818.jpg', 759, '-3', 'อัน', 34, '2025-09-17 16:08:18'),
(6, 'ฟูทีมMIlano FC', 5, 'ฟูทีมmilan เมต้า 160,000M', '83375668920250917_231945.jpg', 120, '-1', 'ไอดี', 17, '2025-09-17 16:19:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_type`
--

CREATE TABLE `tbl_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_type`
--

INSERT INTO `tbl_type` (`type_id`, `type_name`) VALUES
(1, 'Roblox'),
(2, 'Free Fire'),
(3, 'Rov'),
(4, 'Line Ranger'),
(5, 'fc online');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  ADD PRIMARY KEY (`od_id`),
  ADD KEY `o_id` (`o_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `o_id` (`o_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `tbl_type`
--
ALTER TABLE `tbl_type`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  MODIFY `od_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_type`
--
ALTER TABLE `tbl_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `tbl_member` (`member_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  ADD CONSTRAINT `tbl_order_detail_ibfk_1` FOREIGN KEY (`o_id`) REFERENCES `tbl_order` (`o_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_order_detail_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `tbl_product` (`p_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD CONSTRAINT `tbl_payment_ibfk_1` FOREIGN KEY (`o_id`) REFERENCES `tbl_order` (`o_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
