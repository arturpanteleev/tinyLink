-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 31, 2017 at 02:49 AM
-- Server version: 5.7.19-log
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tinylink`
--

-- --------------------------------------------------------

--
-- Table structure for table `link`
--

CREATE TABLE `link` (
  `original` varchar(2048) NOT NULL,
  `tiny` varchar(15) NOT NULL,
  `expired_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `link`
--

INSERT INTO `link` (`original`, `tiny`, `expired_time`) VALUES
('https://yandex.ru/', '0JP1td', '2018-07-30 15:43:39'),
('https://ewfewf', '26W0cl', NULL),
('https://yandex.ru/', '2EzIkX', NULL),
('https://yandex.ru/', '2rEnld', NULL),
('https://yandex.ru/', '2twtFZ', NULL),
('https://yandex.ru/', '2WIHwE', NULL),
('https://yandex.ru/', '3wLSxs', NULL),
('https://yandex.ru/', '3XQvHQ', NULL),
('https://yandex.ru/', '4m8YuY', NULL),
('https://yandex.ru/', '5eCzPJ', NULL),
('https://yandex.ru/', '62chBy', NULL),
('https://yandex.ru/', '7QKw4O', NULL),
('https://www.maxmind.com/ru/open-source-data-and-api-for-ip-geolocation', '9oHRyi', NULL),
('https://yandex.ru/', 'aOUVHs', NULL),
('https://yandex.ru/', 'bgbzlF', NULL),
('https://yandex.ru/', 'bi77Zz', NULL),
('https://yandex.ru/', 'BiQAur', NULL),
('https://www.googlsdasdas.asdas', 'bR8kqj', NULL),
('https://yandex.ru/', 'BrtrJw', NULL),
('https://yandex.ru/', 'BuckD5', NULL),
('https://yandex.ru/', 'BYFTpJ', NULL),
('https://yandex.ru/', 'bytB6X', NULL),
('https://yandex.ru/', 'C863RD', NULL),
('dsfdsfdsf', 'CGeSCZ', NULL),
('https://yandex.ru/', 'cPO6QW', NULL),
('https://yandex.ru/', 'D5J8SH', NULL),
('https://yandex.ru/', 'd9cmM4', NULL),
('https://yandex.ru/', 'diSQAJ', NULL),
('https://yandex.ru/', 'e3u3dB', NULL),
('https://yandex.ru/', 'ELl1Kn', NULL),
('https://yandex.ru/', 'fV5trc', NULL),
('https://yandex.ru/', 'FX0vMY', NULL),
('https://yandex.ru/', 'I7ZbBv', NULL),
('https://yandex.ru/', 'IvChQK', NULL),
('dfdsfdsfsdf', 'KCn3qa', NULL),
('https://www.googlsdasdas.asdas', 'kJ6fyU', NULL),
('https://yandex.ru/', 'L0Hhh1', NULL),
('https://yandex.ru/', 'lELOa6', NULL),
('http://imagine-dragons.com', 'Lhui1Z', NULL),
('https://yandex.ru/', 'loMYYB', NULL),
('https://yandex.ru/', 'MFmZ28', NULL),
('https://ewfghgfhgfh', 'mkvKXE', NULL),
('https://yandex.ru/', 'NCmsZI', NULL),
('https://yandex.ru/', 'ndCYQQ', NULL),
('https://yandex.ru/', 'nwfsZG', NULL),
('https://yandex.ru/', 'OJAXDg', NULL),
('http://symfony.com/doc/current/validation.html', 'oRn0u9', NULL),
('https://yandex.ru/', 'ownf24', NULL),
('https://yandex.ru/', 'pC8UGm', NULL),
('https://yandex.ru/', 'PCpCAn', NULL),
('https://yandex.ru/', 'PSf1Yc', NULL),
('https://yandex.ru/', 'PZMhq3', NULL),
('https://yandex.ru/', 'q69fvq', NULL),
('https://www.googlsdasdas.asdas', 'QBefF1', NULL),
('dsfdsfdsf', 'Rx62OQ', NULL),
('https://yandex.ru/', 'SUYTR7', NULL),
('https://yandex.ru/', 'T3vgjy', NULL),
('https://www.google.ru/s', 'T6CKuN', NULL),
('asdasdasd ads  adsads as das das d', 'U70zDH', NULL),
('https://yandex.ru/', 'uvT8Pg', NULL),
('https://yandex.ru/', 'Wrqbsp', NULL),
('https://yandex.ru/', 'XhPPYn', NULL),
('https://www.html5rocks.com/en/tutorials/masking/adobe/#toc-the-mask-property', 'xT3hY5', NULL),
('https://yandex.ru/', 'y0FRO9', NULL),
('https://yandex.ru/', 'YI7EAV', NULL),
('https://yandex.ru/', 'ySXOlX', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

CREATE TABLE `visit` (
  `id` int(11) NOT NULL,
  `link_id` varchar(15) NOT NULL,
  `visit_time` timestamp NOT NULL,
  `geo` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `visit`
--

INSERT INTO `visit` (`id`, `link_id`, `visit_time`, `geo`, `user_agent`) VALUES
(1, 'mkvKXE', '2017-07-30 00:27:07', 'geo', 'userAgent'),
(2, '0uGGn5', '2017-07-30 00:29:36', 'geo', 'userAgent'),
(3, '0uGGn5', '2017-07-30 00:32:21', 'geo', 'userAgent'),
(4, '62chBy', '2017-07-30 11:36:15', 'geo', 'userAgent'),
(5, '0uGGn5', '2017-07-30 11:37:48', 'geo', 'userAgent'),
(6, 'Ly0Hd9', '2017-07-30 16:00:17', 'Москваээ', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36'),
(7, 'HBI9Qe', '2017-07-30 18:37:25', 'Москва', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36'),
(8, 'oRn0u9', '2017-07-30 23:04:19', ' ', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36'),
(9, 'U70zDH', '2017-07-30 23:23:16', 'Russia Moscow', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36'),
(10, 'U70zDH', '2017-07-30 23:23:32', 'Russia Moscow', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36'),
(11, '9oHRyi', '2017-07-30 23:31:04', ' ', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`tiny`);

--
-- Indexes for table `visit`
--
ALTER TABLE `visit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visit_ibfk_1` (`link_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `visit`
--
ALTER TABLE `visit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
