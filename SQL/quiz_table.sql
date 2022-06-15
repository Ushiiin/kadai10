-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 15, 2022 at 02:23 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gs_quiz_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `quiz_table`
--

CREATE TABLE `quiz_table` (
  `id` int(12) NOT NULL,
  `quiz_name` varchar(100) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `description` varchar(140) DEFAULT NULL,
  `answer` varchar(255) NOT NULL,
  `creater` varchar(100) NOT NULL,
  `insert_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quiz_table`
--

INSERT INTO `quiz_table` (`id`, `quiz_name`, `file_path`, `description`, `answer`, `creater`, `insert_time`, `update_time`) VALUES
(3, '夜景', 'images/hakodate.jpg', '函館山', '北海道', '1', '2022-06-15 21:34:51', '2022-06-15 21:34:51'),
(4, '噴火', 'images/sakurajima.jpg', '桜島', '鹿児島', '2', '2022-06-15 21:55:56', '2022-06-15 21:55:56'),
(5, '中華街', 'images/tyukagai.PNG', '横浜中華街', '神奈川', '2', '2022-06-15 22:30:01', '2022-06-15 22:30:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `quiz_table`
--
ALTER TABLE `quiz_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `quiz_table`
--
ALTER TABLE `quiz_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
