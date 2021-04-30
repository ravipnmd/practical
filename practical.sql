-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2021 at 05:01 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `practical`
--

-- --------------------------------------------------------

--
-- Table structure for table `event_dates`
--

CREATE TABLE `event_dates` (
  `event_dates_id` int(11) NOT NULL,
  `event_list_id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `event_day` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_dates`
--

INSERT INTO `event_dates` (`event_dates_id`, `event_list_id`, `event_date`, `event_day`) VALUES
(1, 1, '2021-04-01', 'Thursday'),
(2, 1, '2021-04-02', 'Friday'),
(3, 1, '2021-04-03', 'Saturday'),
(4, 1, '2021-04-04', 'Sunday'),
(5, 1, '2021-04-05', 'Monday'),
(6, 1, '2021-04-06', 'Tuesday'),
(7, 1, '2021-04-07', 'Wednesday'),
(8, 1, '2021-04-08', 'Thursday'),
(9, 1, '2021-04-09', 'Friday'),
(10, 1, '2021-04-10', 'Saturday'),
(11, 1, '2021-04-11', 'Sunday'),
(12, 1, '2021-04-12', 'Monday'),
(13, 1, '2021-04-13', 'Tuesday'),
(14, 1, '2021-04-14', 'Wednesday'),
(15, 1, '2021-04-15', 'Thursday'),
(16, 1, '2021-04-16', 'Friday'),
(17, 1, '2021-04-17', 'Saturday'),
(18, 1, '2021-04-18', 'Sunday'),
(19, 1, '2021-04-19', 'Monday'),
(20, 1, '2021-04-20', 'Tuesday'),
(21, 1, '2021-04-21', 'Wednesday'),
(22, 1, '2021-04-22', 'Thursday'),
(23, 1, '2021-04-23', 'Friday'),
(24, 1, '2021-04-24', 'Saturday'),
(25, 1, '2021-04-25', 'Sunday'),
(26, 1, '2021-04-26', 'Monday'),
(27, 1, '2021-04-27', 'Tuesday'),
(28, 1, '2021-04-28', 'Wednesday'),
(29, 1, '2021-04-29', 'Thursday'),
(30, 1, '2021-04-30', 'Friday');

-- --------------------------------------------------------

--
-- Table structure for table `event_list`
--

CREATE TABLE `event_list` (
  `event_list_id` int(11) NOT NULL,
  `event_name` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `repeat_type` varchar(20) NOT NULL,
  `repeat_by_every` varchar(20) NOT NULL,
  `repeat_by_day` varchar(20) NOT NULL,
  `repeat_by_number` varchar(20) NOT NULL,
  `repeat_by_weekdays` varchar(20) NOT NULL,
  `repeat_by_duration` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_list`
--

INSERT INTO `event_list` (`event_list_id`, `event_name`, `start_date`, `end_date`, `repeat_type`, `repeat_by_every`, `repeat_by_day`, `repeat_by_number`, `repeat_by_weekdays`, `repeat_by_duration`) VALUES
(1, 'Event 1', '2021-04-01', '2021-04-30', 'Repeat_By_Days', 'Every', 'Day', 'First', 'Sunday', 'Month');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event_dates`
--
ALTER TABLE `event_dates`
  ADD PRIMARY KEY (`event_dates_id`);

--
-- Indexes for table `event_list`
--
ALTER TABLE `event_list`
  ADD PRIMARY KEY (`event_list_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event_dates`
--
ALTER TABLE `event_dates`
  MODIFY `event_dates_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `event_list`
--
ALTER TABLE `event_list`
  MODIFY `event_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
