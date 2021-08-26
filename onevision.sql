-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2020 at 04:34 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onevision`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `pass` char(40) NOT NULL,
  `registration_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `pass`, `registration_date`) VALUES
(22, 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2020-11-19 22:50:49'),
(29, 'zblai1000', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2020-11-20 21:32:38'),
(30, 'test', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2020-11-20 23:09:01');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `itemName` varchar(100) NOT NULL,
  `category` varchar(230) NOT NULL,
  `code` varchar(100) NOT NULL,
  `info` varchar(1000) NOT NULL,
  `picture` text DEFAULT NULL,
  `price` double(10,2) NOT NULL,
  `promotion` varchar(3) NOT NULL,
  `registration_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `itemName`, `category`, `code`, `info`, `picture`, `price`, `promotion`, `registration_date`) VALUES
(10, 'Acuvue Moist', 'contactLens', 'LENS1', 'This contact lens not only gives clarity to your eyes, but it also moisturizes your eyes for long period of time in order to ensure maximum moisture which allows this contact lens to be wear for a long period of time.', '../contactLens/AcuvueMoist.jpg', 100.00, 'yes', '2020-11-19 00:38:31'),
(11, 'Acuvue Oasys', 'contactLens', 'LENS2', 'This contact lens not only gives clarity to your eyes, but it also moisturizes your eyes for long period of time in order to ensure maximum moisture which allows this contact lens to be wear for a long period of time.', '../contactLens/AcuvueOasys.jpg', 150.00, 'no', '2020-11-19 00:39:06'),
(12, 'AirOptix', 'contactLens', 'LENS3', 'This contact lens not only gives clarity to your eyes, but it also moisturizes your eyes for long period of time in order to ensure maximum moisture which allows this contact lens to be wear for a long period of time.', '../contactLens/AirOptix.jpg', 80.00, 'yes', '2020-11-19 00:39:29'),
(13, 'Biotrue', 'contactLens', 'LENS4', 'This contact lens not only gives clarity to your eyes, but it also moisturizes your eyes for long period of time in order to ensure maximum moisture which allows this contact lens to be wear for a long period of time.', '../contactLens/Biotrue.jpg', 100.00, 'no', '2020-11-19 00:41:24'),
(14, 'Dailies', 'contactLens', 'LENS5', 'This contact lens not only gives clarity to your eyes, but it also moisturizes your eyes for long period of time in order to ensure maximum moisture which allows this contact lens to be wear for a long period of time.', '../contactLens/Dailies.jpg', 80.00, 'no', '2020-11-19 00:41:52'),
(15, 'Soflens', 'contactLens', 'LENS6', 'This contact lens not only gives clarity to your eyes, but it also moisturizes your eyes for long period of time in order to ensure maximum moisture which allows this contact lens to be wear for a long period of time.', '../contactLens/Soflens.jpg', 110.00, 'no', '2020-11-19 00:42:15'),
(16, 'EyeCream', 'eyecare', 'CARE1', 'Eye cream allows one to cure their panda eyes. This is ideal for people who are tired but still wants to put up a good look when they go to the office.', '../eyecare/EyeCream.jpg', 50.00, 'no', '2020-11-19 00:42:56'),
(17, 'EyeDrops', 'eyecare', 'CARE2', 'Eye drops moisturizes your eyes to keep your eyes healthy. This allows your eyes to be exposed to long screen times and not get tired easily.', '../eyecare/EyeDrops.jpg', 15.00, 'yes', '2020-11-19 00:43:16'),
(18, 'EyeSerum', 'eyecare', 'CARE3', 'Eye serum is applied to provide nourishing hydration to the delicate skin around the eyes to help reduce fine lines, wrinkles, crow\'s feet, and dark circles.', '../eyecare/EyeSerum.jpg', 60.00, 'no', '2020-11-19 00:43:49'),
(19, 'Black Vibe', 'sunglasses', 'SUN1', 'Testing description box', '../sunglasses/BlackVibe.jpg', 500.00, 'yes', '2020-11-19 00:44:44'),
(20, 'Book Smart', 'sunglasses', 'SUN2', 'Our sunglasses are designed to not only protect your eyes from the sun but look the part too. Our sunglasses implements the latest trends into the designs, as we view them not only as sunglasses, but also a part of what you wear and how it brings the best out of what you truly represents.', '../sunglasses/BookSmart.jpg', 300.00, 'yes', '2020-11-19 00:45:07'),
(21, 'Christian Dior', 'sunglasses', 'SUN3', 'Our sunglasses are designed to not only protect your eyes from the sun but look the part too. Our sunglasses implements the latest trends into the designs, as we view them not only as sunglasses, but also a part of what you wear and how it brings the best out of what you truly represents.', '../sunglasses/ChristianDior.jpg', 900.00, 'no', '2020-11-19 00:45:25'),
(22, 'Gold Sleek', 'sunglasses', 'SUN4', 'Our sunglasses are designed to not only protect your eyes from the sun but look the part too. Our sunglasses implements the latest trends into the designs, as we view them not only as sunglasses, but also a part of what you wear and how it brings the best out of what you truly represents.', '../sunglasses/GoldSleek.jpg', 1500.00, 'no', '2020-11-19 00:45:42'),
(23, 'Piano Black', 'sunglasses', 'SUN5', 'Our sunglasses are designed to not only protect your eyes from the sun but look the part too. Our sunglasses implements the latest trends into the designs, as we view them not only as sunglasses, but also a part of what you wear and how it brings the best out of what you truly represents.', '../sunglasses/PianoBlack.jpg', 400.00, 'yes', '2020-11-19 00:46:06'),
(24, 'Red Sun', 'sunglasses', 'SUN6', 'Our sunglasses are designed to not only protect your eyes from the sun but look the part too. Our sunglasses implements the latest trends into the designs, as we view them not only as sunglasses, but also a part of what you wear and how it brings the best out of what you truly represents.', '../sunglasses/RedSun.jpg', 1200.00, 'no', '2020-11-19 00:46:26'),
(25, 'Air Glass', 'eyeglasses', 'EYE1', 'This spec balances out fashion, practicality, and comfort. You will never experience anything similar to this in the market. We aim to provide you a pair of spectacles in order for you to keep yourself focus on what is important.', '../eyeglasses/AirGlass.jpg', 120.00, 'yes', '2020-11-19 00:49:08'),
(26, 'Gold Chain', 'eyeglasses', 'EYE2', 'This spec balances out fashion, practicality, and comfort. You will never experience anything similar to this in the market. We aim to provide you a pair of spectacles in order for you to keep yourself focus on what is important.', '../eyeglasses/GoldChain.jpg', 800.00, 'no', '2020-11-19 00:49:26'),
(27, 'Modern Look', 'eyeglasses', 'EYE3', 'This spec balances out fashion, practicality, and comfort. You will never experience anything similar to this in the market. We aim to provide you a pair of spectacles in order for you to keep yourself focus on what is important.', '../eyeglasses/ModernLook.jpg', 400.00, 'yes', '2020-11-19 00:49:45'),
(28, 'Perfect Clear', 'eyeglasses', 'EYE4', 'This spec balances out fashion, practicality, and comfort. You will never experience anything similar to this in the market. We aim to provide you a pair of spectacles in order for you to keep yourself focus on what is important.', '../eyeglasses/PerfectClear.jpg', 150.00, 'yes', '2020-11-19 00:50:01'),
(29, 'Simple Life', 'eyeglasses', 'EYE5', 'This spec balances out fashion, practicality, and comfort. You will never experience anything similar to this in the market. We aim to provide you a pair of spectacles in order for you to keep yourself focus on what is important.', '../eyeglasses/SimpleLife.jpg', 80.00, 'yes', '2020-11-19 00:50:14'),
(30, 'Sleek Glass', 'eyeglasses', 'EYE6', 'This spec balances out fashion, practicality, and comfort. You will never experience anything similar to this in the market. We aim to provide you a pair of spectacles in order for you to keep yourself focus on what is important.', '../eyeglasses/SleekGlass.jpg', 500.00, 'no', '2020-11-19 00:50:29');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `itemsName` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `total` double(10,2) NOT NULL,
  `address1` varchar(200) NOT NULL,
  `address2` varchar(200) NOT NULL,
  `postcode` int(11) NOT NULL,
  `city` varchar(50) NOT NULL,
  `states` varchar(50) NOT NULL,
  `order_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `username`, `itemsName`, `quantity`, `total`, `address1`, `address2`, `postcode`, `city`, `states`, `order_date`) VALUES
(220, 'zblai2000', 'Sun', '1', 500.00, 'No 18, Jalan Bukit Indah 3/21', 'Taman Bukit Indah', 68000, 'Ampang', 'Selangor', '2020-11-17 23:01:34'),
(221, 'zblai2000', 'Rainbow', '1', 800.00, 'No 18, Jalan Bukit Indah 3/21', 'Taman Bukit Indah', 68000, 'Ampang', 'Selangor', '2020-11-17 23:01:34'),
(222, 'zblai2000', 'Moon', '1', 500.00, 'No 18, Jalan Bukit Indah 3/21', 'Taman Bukit Indah', 68000, 'Ampang', 'Selangor', '2020-11-17 23:01:34'),
(223, 'zblai', 'Sun', '10', 5000.00, 'No 18, Jalan Bukit Indah 3/21', 'Taman Bukit Indah', 68000, 'Ampang', 'Selangor', '2020-11-18 20:49:02'),
(224, 'zblai', 'Book Smart', '1', 300.00, 'No 18, Jalan Bukit Indah 3/21', 'Taman Bukit Indah', 68000, 'Ampang', 'Selangor', '2020-11-19 01:02:22'),
(225, 'zblai', 'Black Vibe', '2', 1000.00, 'No 18, Jalan Bukit Indah 3/21', 'Taman Bukit Indah', 68000, 'Ampang', 'Selangor', '2020-11-19 01:02:22'),
(226, 'zblai', 'EyeDrops', '1', 15.00, 'No 18, Jalan Bukit Indah 3/21', 'Taman Bukit Indah', 68000, 'Ampang', 'Selangor', '2020-11-19 12:28:38'),
(227, 'zblai', 'EyeSerum', '1', 60.00, 'No 18, Jalan Bukit Indah 3/21', 'Taman Bukit Indah', 68000, 'Ampang', 'Selangor', '2020-11-19 12:28:38'),
(228, 'zblai', 'EyeCream', '1', 50.00, 'No 18, Jalan Bukit Indah 3/21', 'Taman Bukit Indah', 68000, 'Ampang', 'Selangor', '2020-11-19 12:28:38'),
(229, 'zblai', 'Air Glass', '12', 2400.00, 'No 18, Jalan Bukit Indah 3/21', 'Taman Bukit Indah', 68000, 'Ampang', 'Selangor', '2020-11-19 12:28:38'),
(230, 'test', 'EyeCream', '1', 50.00, 'No 18, Jalan Bukit Indah 3/21', 'Taman Bukit Indah', 68000, 'Ampang', 'Selangor', '2020-11-20 15:06:41'),
(231, 'test', 'EyeCream', '1', 50.00, 'No 18, Jalan Bukit Indah 3/21', 'Taman Bukit Indah', 68000, 'Ampang', 'Selangor', '2020-11-20 15:06:53'),
(232, 'test', 'Book Smart', '1', 300.00, 'No 18, Jalan Bukit Indah 3/21', 'Taman Bukit Indah', 68000, 'Ampang', 'Selangor', '2020-11-20 15:07:48'),
(233, 'zblai', 'Black Vibe', '1', 500.00, 'No 18, Jalan Bukit Indah 3/21', 'Taman Bukit Indah', 68000, 'Ampang', 'Selangor', '2020-11-20 22:06:14'),
(234, 'zblai', 'Piano Black', '1', 400.00, 'No 18, Jalan Bukit Indah 3/21', 'Taman Bukit Indah', 68000, 'Ampang', 'Selangor', '2020-11-20 22:06:14'),
(235, 'zblai', 'EyeCream', '1', 50.00, 'No 18, Jalan Bukit Indah 3/21', 'Taman Bukit Indah', 68000, 'Ampang', 'Selangor', '2020-11-20 22:09:04'),
(236, 'zblai', 'Dailies', '1', 80.00, 'No 18, Jalan Bukit Indah 3/21', 'Taman Bukit Indah', 68000, 'Ampang', 'Selangor', '2020-11-20 22:09:04'),
(237, 'zblai', 'Book Smart', '1', 300.00, 'No 18, Jalan Bukit Indah 3/21', 'Taman Bukit Indah', 68000, 'Ampang', 'Selangor', '2020-11-20 23:09:58'),
(238, 'zblai', 'Christian Dior', '1', 900.00, 'No 18, Jalan Bukit Indah 3/21', 'Taman Bukit Indah', 68000, 'Ampang', 'Selangor', '2020-11-20 23:09:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `dateOfBirth` varchar(30) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `pass` char(40) NOT NULL,
  `registration_date` datetime DEFAULT current_timestamp(),
  `picture` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstName`, `lastName`, `email`, `gender`, `dateOfBirth`, `mobile`, `pass`, `registration_date`, `picture`) VALUES
(10, 'zblai', 'Bryan', 'Lai', 'bryanlai@gmail.com', 'male', '2020-11-01', '0112345678', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2020-11-19 20:33:43', '../ProfilePicture/Profile Picture.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `user_contact_form`
--

CREATE TABLE `user_contact_form` (
  `id` int(6) UNSIGNED NOT NULL,
  `fullName` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `reason` varchar(300) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_contact_form`
--

INSERT INTO `user_contact_form` (`id`, `fullName`, `email`, `mobile`, `reason`, `created_at`) VALUES
(1, 'Bryan Lai', 'zblai1000@gmail.com', '0126616353', 'Testing out the contact form to see if its working or not.', '2020-11-17 16:10:05'),
(2, 'Bryan Lai', 'zblai1000@gmail.com', '0126616353', 'Testing out the contact form to see if its working or not.', '2020-11-17 16:11:52'),
(21, 'Bryan Lai', 'zblai1000@gmail.com', '0126616353', 'Hi', '2020-11-20 11:29:00'),
(22, 'Bryan Lai', 'zblai1000@gmail.com', '0126616353', 'testing ', '2020-11-20 14:49:34'),
(23, 'Bryan Lai', 'zblai1000@gmail.com', '0126616353', 'Testing the contact form in call', '2020-11-20 22:13:31'),
(24, 'Bryan Lai', 'zblai1000@gmail.com', '0126616353', 'hi', '2020-11-20 23:13:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_contact_form`
--
ALTER TABLE `user_contact_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_contact_form`
--
ALTER TABLE `user_contact_form`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
