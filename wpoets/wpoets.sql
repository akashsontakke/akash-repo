-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2026 at 07:56 PM
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
-- Database: `wpoets`
--

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `slider_sub_text` varchar(255) DEFAULT NULL,
  `slider_text` text DEFAULT NULL,
  `slider_image` varchar(255) DEFAULT NULL,
  `sub_division_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `slider_sub_text`, `slider_text`, `slider_image`, `sub_division_id`) VALUES
(1, 'Digital Learning Infrastructure', 'Usability Enhancement and Traing for transaction portal for custormers', 'images/DL-Learning-1.jpg', 1),
(2, 'Technology Learning Infrastructure', 'Modern cloud based Infrastructure for Enterprise Systems', 'images/DL-Technology.jpg', 2),
(3, 'Communication Learning Infrastructure', 'Smart communication Systems for Customer Engagement', 'images/DL-Communication.jpg', 3),
(11, 'Sub text Test', 'Slider text Test', 'images/1779296432_Download_page_icon_pillars.jpg', 5),
(12, 'gbgbgb', 'ghnghn', '', 6),
(13, '', 'bnvbhjngyjng', '', 7);

-- --------------------------------------------------------

--
-- Table structure for table `sub_divisions`
--

CREATE TABLE `sub_divisions` (
  `id` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0,
  `division_name` varchar(100) DEFAULT NULL,
  `icon_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_divisions`
--

INSERT INTO `sub_divisions` (`id`, `date_created`, `date_modified`, `deleted`, `division_name`, `icon_img`) VALUES
(1, '2026-05-19 21:16:31', '2026-05-19 21:16:31', 0, 'Learning', 'images/DL-learning.svg'),
(2, '2026-05-19 21:16:31', '2026-05-19 21:16:31', 0, 'Technology', 'images/DL-technology.svg'),
(3, '2026-05-19 21:16:31', '2026-05-19 21:16:31', 0, 'Communication', 'images/DL-communication.svg'),
(5, '2026-05-20 11:41:59', '2026-05-20 11:41:59', 0, 'Division test', 'images/1779296432_images.jpeg'),
(6, '2026-05-20 13:27:35', '2026-05-20 13:27:35', 1, 'gbfgb', ''),
(7, '2026-05-20 13:45:50', '2026-05-20 13:45:50', 1, 'gnghnfvg', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_divisions`
--
ALTER TABLE `sub_divisions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sub_divisions`
--
ALTER TABLE `sub_divisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
