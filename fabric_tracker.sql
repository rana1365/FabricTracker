-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2023 at 05:22 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fabric_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `buyer`
--

CREATE TABLE `buyer` (
  `row_id` int(20) DEFAULT NULL,
  `buyer_id` int(20) NOT NULL,
  `buyer_name` varchar(100) DEFAULT NULL,
  `buyer_address` varchar(100) DEFAULT NULL,
  `country_of_origin` varchar(100) DEFAULT NULL,
  `recording_person_id` varchar(20) DEFAULT NULL,
  `recording_person_name` varchar(100) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buyer`
--

INSERT INTO `buyer` (`row_id`, `buyer_id`, `buyer_name`, `buyer_address`, `country_of_origin`, `recording_person_id`, `recording_person_name`, `recording_time`) VALUES
(3, 5, 'DBC', 'Kabul', 'Swiden', 'rana', 'rana', '2023-02-12 17:33:37'),
(4, 7, 'Radiant', 'stockholm', 'Swiden', 'rana', 'qc', '2023-02-12 15:06:58'),
(6, 10, 'IKEA', 'Nederlands', 'Swiden', 'rana', 'rana', '2023-02-11 17:24:09'),
(1, 11, 'H&M', 'Munich', 'Germany', 'rana', 'rana', '2023-02-13 09:10:20'),
(1, 12, 'FreDex', 'Madrid', 'Spain', 'rana', 'rana', '2023-02-13 09:21:37'),
(1, 13, 'Addidas', 'Malaga', 'Spain', 'rana', 'rana', '2023-02-13 09:35:32');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(25) NOT NULL,
  `name_of_country` varchar(120) DEFAULT NULL,
  `short_code` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `name_of_country`, `short_code`) VALUES
(1, 'Afghanistan', 'AFG'),
(2, 'Germany', 'GER'),
(3, 'Afghanistan', 'AFG'),
(4, 'Germany', 'GER'),
(5, 'Swiden', NULL),
(6, 'Swiden', NULL),
(7, 'Nederland', NULL),
(8, 'France', NULL),
(9, 'Belgium', NULL),
(10, 'Denmark', NULL),
(11, 'Spain', NULL),
(12, 'Croatia', NULL),
(13, 'Switzerland', NULL),
(14, 'Italy', NULL),
(15, 'Poland', NULL),
(16, 'Hungary', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `department_info`
--

CREATE TABLE `department_info` (
  `id` int(25) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `department_name` varchar(100) DEFAULT NULL,
  `section_name` varchar(100) DEFAULT NULL,
  `contact_person_name` varchar(100) DEFAULT NULL,
  `contact_no` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `recording_person_id` int(40) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department_info`
--

INSERT INTO `department_info` (`id`, `location`, `department_name`, `section_name`, `contact_person_name`, `contact_no`, `email`, `recording_person_id`, `recording_time`) VALUES
(5, 'Gate-1', 'ICT', 'Marketing', 'Habib Ahmed32', '01723545030', 'habib@gmail.com', 0, '2023-02-12 17:15:08'),
(6, 'Gate-3', 'ICT', 'Zaber Zubayer Fashion', 'Azad Hossain', '01737521158', 'azad432@gmail.com', 0, '2023-02-09 16:23:52'),
(7, 'Get-2', 'Medical', 'ZnZ Fashion', 'Md Sohel Rana', '0180589430', 'rony940@gmail.com', 0, '2023-02-07 23:53:31'),
(8, 'Gate-1', 'Networking', 'Commercial 2', 'Hriday', '03884237733', 'rana@gmail.com', 0, '2023-02-09 16:31:27'),
(9, 'Gate-2', 'Accounts', 'ZnZ Fashion', 'Rajib Saha', '546456', 'abcsdfgfdfhajkld', 0, '2023-02-10 11:09:02'),
(10, 'Head Office', 'ICT', 'Commercial', 'Hriday Ahmed', '01523370118', 'user22@gmail.com', 0, '2023-02-13 09:17:08');

-- --------------------------------------------------------

--
-- Table structure for table `designation_info`
--

CREATE TABLE `designation_info` (
  `id` int(25) NOT NULL,
  `designation_name` varchar(255) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(100) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `designation_info`
--

INSERT INTO `designation_info` (`id`, `designation_name`, `recording_person_id`, `recording_person_name`, `recording_time`) VALUES
(1, 'Application Developer22', 'rana', 'rana', '2023-02-08 12:34:21'),
(2, 'Backend Developer', 'rana', 'rana', '2023-02-08 12:42:07'),
(3, 'Network Engineer', 'rana', 'rana', '2023-02-08 12:48:10'),
(4, 'Laravel Developer2', 'rana', 'rana', '2023-02-08 15:32:49'),
(5, 'Assistant Engineer43', 'rana', 'rana', '2023-02-08 16:03:26'),
(6, 'Medical Assistant', 'rana', 'rana', '2023-02-08 17:18:31');

-- --------------------------------------------------------

--
-- Table structure for table `events_collab`
--

CREATE TABLE `events_collab` (
  `id` int(25) NOT NULL,
  `buyer_id` int(100) NOT NULL,
  `events_id` int(100) NOT NULL,
  `days` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `event_info`
--

CREATE TABLE `event_info` (
  `id` int(25) NOT NULL,
  `event_id` varchar(100) NOT NULL,
  `event_name` varchar(255) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `recording_person_id` varchar(100) DEFAULT NULL,
  `recording_person_name` varchar(100) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_info`
--

INSERT INTO `event_info` (`id`, `event_id`, `event_name`, `remarks`, `recording_person_id`, `recording_person_name`, `recording_time`) VALUES
(1, '1', 'Cotton Rolling23', NULL, 'rana', 'rana', '2023-02-08 16:33:35'),
(2, '2', 'Collecting Cotton4', NULL, 'rana', 'rana', '2023-02-09 10:02:01'),
(3, '3', 'Shamriddhi Opening', NULL, 'rana', 'rana', '2023-02-09 16:22:10'),
(4, '4', 'LC-1 Opening', NULL, 'rana', 'rana', '2023-02-11 15:51:24'),
(5, '5', 'LC-2 Opening', NULL, 'rana', 'rana', '2023-02-11 16:28:21'),
(6, '6', 'LC Closing', NULL, 'rana', 'rana', '2023-02-11 16:28:46');

-- --------------------------------------------------------

--
-- Table structure for table `event_wise_buyer`
--

CREATE TABLE `event_wise_buyer` (
  `id` int(25) NOT NULL,
  `buyer_id` varchar(100) DEFAULT NULL,
  `event_id` varchar(100) DEFAULT NULL,
  `days` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_wise_buyer`
--

INSERT INTO `event_wise_buyer` (`id`, `buyer_id`, `event_id`, `days`) VALUES
(9, '10', '6', 4),
(10, '7', '2', 105),
(11, '5', '4', 45),
(16, '10', '3', 155),
(17, '11', '6', 90),
(18, '10', '6', 44),
(19, '10', '6', 47);

-- --------------------------------------------------------

--
-- Table structure for table `event_wise_user`
--

CREATE TABLE `event_wise_user` (
  `id` int(25) NOT NULL,
  `event_id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(25) NOT NULL,
  `delivery_date` date NOT NULL,
  `delivery_slot` varchar(60) NOT NULL,
  `buyer_id` int(35) NOT NULL,
  `order_qty` int(11) NOT NULL,
  `color` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_wise_event_and_user`
--

CREATE TABLE `order_wise_event_and_user` (
  `id` int(25) NOT NULL,
  `order_id` int(50) NOT NULL,
  `events_collab_id` int(50) NOT NULL,
  `event_wise_user_id` int(100) NOT NULL,
  `approval_date` date NOT NULL,
  `plan_date` date NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(25) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `employee_name` varchar(100) DEFAULT NULL,
  `user_id` int(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `confirm_password` varchar(50) DEFAULT NULL,
  `user_type` varchar(20) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contact_no` varchar(15) DEFAULT NULL,
  `department` varchar(30) DEFAULT NULL,
  `designation` varchar(30) DEFAULT NULL,
  `profile_picture` varchar(130) DEFAULT NULL,
  `recording_person_id` varchar(30) DEFAULT NULL,
  `recording_person_name` varchar(50) DEFAULT NULL,
  `recording_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `user_name`, `employee_name`, `user_id`, `password`, `confirm_password`, `user_type`, `status`, `email`, `contact_no`, `department`, `designation`, `profile_picture`, `recording_person_id`, `recording_person_name`, `recording_time`) VALUES
(1, 'kamal', 'Md. Kamal Hossain', 0, '56789', '56789', 'User', 'Active', 'kama@gmail.com', '01923102962', 'ICT', 'Assistant Engineer43', 'user.png', 'rana', 'rana', '2023-02-08 17:05:50'),
(2, 'kamal', 'Kamal Hossen', 0, '23456', '23456', 'User', 'Active', 'kamal@gmail.com', '9876543212', 'Medical', 'Medical Assistant', 'doctor.jpg', 'rana', 'rana', '2023-02-08 17:23:19'),
(3, 'arif', 'Kamal Hossen', 0, '12345', '12345', 'User', 'Active', 'arifhossen', '03884237733', 'ICT', 'Assistant Engineer43', 'doctor.jpg', 'rana', 'rana', '2023-02-09 11:40:52'),
(4, 'sohel', 'MD SOHEL RANA', 0, '12345', '12345', 'User', 'Active', 'absgfsttehds', '017235450303', 'Medical', 'Application Developer', 'buyer12.png', 'rana', 'rana', '2023-02-09 13:01:24'),
(5, 'rana07', 'Md. Kamal Hossain', 0, '123456', '123456', 'User', 'Active', 'asdfghjkjhgfdssdfg', '01923102962', 'Medical', 'Backend Developer', 'buyer12.png', 'rana', 'rana', '2023-02-09 13:17:40'),
(6, 'qc', 'MD SOHEL RANA', 0, '76543', '7654', 'User', 'Active', 'abcderwsa', '01923102962', 'Medical', 'Application Developer', 'doctor.jpg', 'rana', 'rana', '2023-02-09 13:25:47'),
(7, 'robin', 'Shariful Islam', 0, '12345', '12345', 'User', 'Active', 'afsdghfjgkhgfjdsdgjhkj', '9876543212', 'Medical', 'Assistant Engineer43', 'buyer12.png', 'rana', 'rana', '2023-02-09 14:39:35'),
(8, 'sohag', 'MD SOHAG MIA', 0, '12345', '12345', 'User', 'Active', 'adssghhsdfgh', '03884237733', 'Networking', 'Assistant Engineer43', 'buyer12.png', 'rana', 'rana', '2023-02-09 16:49:31'),
(9, 'rakib', 'Rakib Hasan', 10820, '123456', '123456', 'User', 'Active', 'rakib@nomangroup.com', '01531421030', 'Accounts', 'Backend Developer', 'default.png', 'rana', 'rana', '2023-02-11 09:25:31'),
(10, 'sajal', 'Najmul Hasan', 10922, '12345', '12345', 'User', 'Active', 'sajal@gmail.com', '01321231039', 'ICT', 'Application Developer', 'images.png', 'rana', 'rana', '2023-02-12 17:16:38');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `user_name` varchar(30) DEFAULT NULL,
  `employee_name` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contact_no` varchar(60) DEFAULT NULL,
  `department` varchar(70) NOT NULL,
  `designation` varchar(80) DEFAULT NULL,
  `user_type` varchar(40) DEFAULT NULL,
  `status` int(35) DEFAULT NULL,
  `profile_picture` varchar(100) DEFAULT NULL,
  `recording_person_id` int(30) DEFAULT NULL,
  `recording_person_name` int(60) DEFAULT NULL,
  `recording_time` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `user_id`, `user_name`, `employee_name`, `first_name`, `last_name`, `middle_name`, `password`, `email`, `contact_no`, `department`, `designation`, `user_type`, `status`, `profile_picture`, `recording_person_id`, `recording_person_name`, `recording_time`) VALUES
(1, 'rana', 'rana', 'MD SOHEL RANA', 'MD SOHEL', 'RANA', NULL, '12345', 'testuser@nomangroup.com', '01521370115', 'ICT', 'Network Engineer', 'Admin', 0, 'user2.jpg', 0, 0, 2147483647),
(9, 'robin', 'robin', 'Shariful Islam test', NULL, NULL, NULL, '12345', 'afsdghfjgkhgfjdsdgjhkj', '9876543212', 'Medical', 'Network Engineer', 'User', 0, 'user.png', 0, 0, 2147483647),
(10, 'sohag2', 'sohag', 'MD SOHAG MIA', NULL, NULL, NULL, '12345', 'adssghhsdfgh', '03884237733', 'Networking', 'Network Engineer', 'User', 0, 'user1.jpg', 0, 0, 2147483647),
(11, '10820', 'rakib', 'Rakib Hasan', NULL, NULL, NULL, '123456', 'rakib@nomangroup.com', '01531421030', 'Accounts', 'Network Engineer', 'User', 0, 'buyer12.png', 0, 0, 2147483647),
(12, '10922', 'sajal', 'Najmul Hasan', NULL, NULL, NULL, '12345', 'sajal@gmail.com', '01321231039', 'ICT', 'Application Developer', 'User', 0, 'images.png', 0, 0, 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `short_name` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buyer`
--
ALTER TABLE `buyer`
  ADD PRIMARY KEY (`buyer_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `department_info`
--
ALTER TABLE `department_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designation_info`
--
ALTER TABLE `designation_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events_collab`
--
ALTER TABLE `events_collab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_info`
--
ALTER TABLE `event_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_wise_buyer`
--
ALTER TABLE `event_wise_buyer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_wise_user`
--
ALTER TABLE `event_wise_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_wise_event_and_user`
--
ALTER TABLE `order_wise_event_and_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buyer`
--
ALTER TABLE `buyer`
  MODIFY `buyer_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `department_info`
--
ALTER TABLE `department_info`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `designation_info`
--
ALTER TABLE `designation_info`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `events_collab`
--
ALTER TABLE `events_collab`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_info`
--
ALTER TABLE `event_info`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `event_wise_buyer`
--
ALTER TABLE `event_wise_buyer`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `event_wise_user`
--
ALTER TABLE `event_wise_user`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_wise_event_and_user`
--
ALTER TABLE `order_wise_event_and_user`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
