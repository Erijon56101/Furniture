-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2024 at 11:41 PM
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
-- Database: `furniture_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `furniture_form`
--

CREATE TABLE `furniture_form` (
  `id` int(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `cpassword` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `furniture_form`
--

INSERT INTO `furniture_form` (`id`, `name`, `email`, `password`, `cpassword`, `user_type`) VALUES
(1, 'Admin', 'Admin@gmail.com', '645a38461f296da46d11a6d41f9bd844', '', 'admin'),
(5, 'Ditjon', 'zeqirajditjon@gamil.com', 'c6d893837aac00ca7259427645bbf795', '', 'user'),
(6, 'Erijon', 'nezirajerijon@gamil.com', 'be687138517cf94a2db6a4c8054ab2dc', '', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `furniture_form`
--
ALTER TABLE `furniture_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `furniture_form`
--
ALTER TABLE `furniture_form`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
