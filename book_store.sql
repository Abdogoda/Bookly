-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2022 at 08:40 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `image`, `price`, `category`, `description`) VALUES
(1, 'book-1', 'book-1.png', '10', 'Science', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,'),
(2, 'book-2', 'book-2.png', '15', 'History', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,'),
(3, 'book-3', 'book-3.png', '20', 'Sports?', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,'),
(4, 'book-4', 'book-4.png', '25', 'Travel', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,'),
(5, 'book-5', 'book-5.png', '30', 'crime', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,'),
(6, 'book-6', 'book-6.png', '35', 'Math', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,'),
(7, 'book-7', 'book-7.png', '40', 'Health', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,'),
(8, 'book-8', 'book-8.png', '45', 'History', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,'),
(9, 'book-9', 'book-9.png', '50', 'Art', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,'),
(10, 'book-10', 'book-10.png', '55', 'Diary', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,'),
(11, 'book-11', 'book-11.png', '60', 'Dictionary', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,'),
(12, 'book-12', 'book-12.png', '65', 'Philosophy', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,'),
(13, 'book-13', 'book-13.png', '70', 'Encyclopedia', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,'),
(14, 'book-14', 'book-14.png', '75', 'Cookbook', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,'),
(15, 'book-15', 'book-15.png', '80', 'Travel', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,'),
(16, 'book-16', 'book-16.png', '85', 'Business', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,'),
(17, 'book-17', 'book-17.png', '90', 'Travel', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,'),
(18, 'book-18', 'book-18.png', '95', 'Sports?', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,'),
(19, 'book-19', 'book-19.png', '5', 'Health', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,'),
(20, 'book-20', 'book-20.png', '10', 'Art', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,'),
(21, 'book-21', 'book-21.png', '15', 'Business', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,'),
(22, 'book-22', 'book-22.png', '20', 'Philosophy', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,'),
(23, 'book-23', 'book-23.png', '25', 'Encyclopedia', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,'),
(24, 'book-24', 'book-24.png', '30', 'Cookbook', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,'),
(25, 'book-25', 'book-25.png', '35', 'Guide', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,'),
(26, 'book-26', 'book-26.png', '40', 'Science', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,'),
(27, 'book-27', 'book-27.png', '45', 'Math', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,'),
(28, 'book-28', 'book-28.png', '50', 'Dictionary', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `name`, `image`, `price`, `quantity`, `total`, `category`, `description`, `user_id`) VALUES
(22, 'book-3', 'book-3.png', '20', 1, '20', 'Sports?', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at ', 1),
(23, 'book-19', 'book-19.png', '5', 6, '30', 'Health', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at ', 1),
(24, 'book-17', 'book-17.png', '90', 1, '90', 'Travel', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at ', 1),
(25, 'book-27', 'book-27.png', '45', 4, '180', 'Math', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at ', 1),
(29, 'book-5', 'book-5.png', '30', 5, '30', 'crime', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at ', 4),
(30, 'book-4', 'book-4.png', '25', 6, '50', 'Travel', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at ', 4),
(32, 'book-16', 'book-16.png', '85', 1, '85', 'Business', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at ', 4),
(33, 'book-22', 'book-22.png', '20', 1, '20', 'Philosophy', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at ', 4),
(34, 'book-6', 'book-6.png', '35', 7, '245', 'Math', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at ', 4),
(35, 'book-20', 'book-20.png', '10', 3, '30', 'Art', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at ', 4),
(36, 'book-9', 'book-9.png', '50', 2, '100', 'Art', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at ', 4),
(37, 'book-25', 'book-25.png', '35', 1, '35', 'Guide', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at ', 4),
(38, 'book-26', 'book-26.png', '40', 2, '80', 'Science', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at ', 4),
(39, 'book-2', 'book-2.png', '15', 1, '15', 'History', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at ', 4),
(40, 'book-3', 'book-3.png', '20', 1, '20', 'Sports?', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at ', 4),
(41, 'book-1', 'book-1.png', '10', 1, '10', 'Science', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at ', 4),
(42, 'book-13', 'book-13.png', '70', 1, '70', 'Encyclopedia', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at ', 4),
(44, 'book-14', 'book-14.png', '75', 1, '75', 'Cookbook', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at ', 4),
(45, 'book-27', 'book-27.png', '45', 1, '45', 'Math', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at ', 4);

-- --------------------------------------------------------

--
-- Table structure for table `liked`
--

CREATE TABLE `liked` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `liked`
--

INSERT INTO `liked` (`id`, `user_id`, `name`, `category`, `image`, `price`) VALUES
(1, 1, 'book-19', 'Health', 'book-19.png', ''),
(4, 1, 'book-1', 'Science', 'book-1.png', ''),
(5, 1, 'book-4', 'Travel', 'book-4.png', ''),
(7, 1, 'book-22', 'Philosophy', 'book-22.png', ''),
(8, 1, 'book-18', 'Sports?', 'book-18.png', ''),
(9, 1, 'book-23', 'Encyclopedia', 'book-23.png', ''),
(10, 1, 'book-20', 'Art', 'book-20.png', ''),
(11, 1, 'book-27', 'Math', 'book-27.png', ''),
(12, 1, 'book-7', 'Health', 'book-7.png', ''),
(14, 4, 'book-1', 'Science', 'book-1.png', ''),
(15, 4, 'book-2', 'History', 'book-2.png', ''),
(16, 4, 'book-3', 'Sports?', 'book-3.png', ''),
(17, 4, 'book-4', 'Travel', 'book-4.png', ''),
(18, 4, 'book-8', 'History', 'book-8.png', ''),
(20, 4, 'book-27', 'Math', 'book-27.png', ''),
(21, 4, 'book-6', 'Math', 'book-6.png', ''),
(22, 4, 'book-9', 'Art', 'book-9.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `phone`, `address`, `password`, `image`) VALUES
(1, 'user2', 'use2@gamil.com', '0222222222222', 'user2 address', '24c9e15e52afc47c225b757e7bee1f9d', '4.png'),
(2, 'user1', 'user1@gmail.com', '0111111111111111111', 'user1 address', '24c9e15e52afc47c225b757e7bee1f9d', 'AdobeStock_204239369-6445.jpg'),
(3, 'user3', 'user3@gamil.com', '03333333333333333', 'user3 address', 'user3', 'c2.jpg'),
(4, 'user4', 'user4@gmail.com', '04444444444', 'user4 address', '3f02ebe3d7929b091e3d8ccfde2f3bc6', 'testimonial3.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `liked`
--
ALTER TABLE `liked`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `liked`
--
ALTER TABLE `liked`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
