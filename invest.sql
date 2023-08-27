-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2023 at 10:41 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invest`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `name`, `image`, `type`, `address`) VALUES
(1, 'Nordstrom', 'IMG-20230811-WA0000.jpg', 'giftcard', ''),
(2, 'Paypal', 'IMG-20230811-WA0001.jpg', 'giftcard', ''),
(3, 'Razer Gold', 'IMG-20230811-WA0002.jpg', 'giftcard', ''),
(4, 'Fandango', 'IMG-20230811-WA0003.jpg', 'giftcard', ''),
(5, 'Grubhub', 'IMG-20230811-WA0004.jpg', 'giftcard', ''),
(6, 'Foot Locker', 'IMG-20230811-WA0005.jpg', 'giftcard', ''),
(7, 'Bitcoin', 'image.PNG', 'crypto', 'qwertyusmcscnmsbcnsnvnsbnsbh2t672t67');

-- --------------------------------------------------------

--
-- Table structure for table `investment`
--

CREATE TABLE `investment` (
  `id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `investment_id` varchar(222) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT 'on'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `investment`
--

INSERT INTO `investment` (`id`, `amount`, `user_id`, `investment_id`, `date`, `time`, `status`) VALUES
(1, 500, 1, '#SC82BT6R31', '2023-07-23', '04:47:21pm', 'off'),
(2, 1000, 1, '#JZAVWRC6YD', '2023-08-22', '04:52:40pm', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `user_id`, `date`, `time`) VALUES
(1, 1, 'Jul 30, 2023', '05:31:23pm'),
(2, 1, 'Jul 30, 2023', '05:31:44pm'),
(3, 1, 'Jul 30, 2023', '05:34:11pm'),
(4, 1, 'Jul 30, 2023', '05:34:29pm'),
(5, 1, 'Jul 31, 2023', '12:42:27am'),
(6, 1, 'Jul 31, 2023', '01:13:18am'),
(7, 1, 'Aug 03, 2023', '04:01:12am'),
(8, 1, 'Aug 03, 2023', '10:42:28pm'),
(9, 1, 'Aug 04, 2023', '03:20:42am'),
(10, 1, 'Aug 04, 2023', '03:24:34am'),
(11, 1, 'Aug 04, 2023', '03:27:56am'),
(12, 1, 'Aug 08, 2023', '03:57:28am'),
(13, 1, 'Aug 11, 2023', '07:28:25am'),
(14, 1, 'Aug 11, 2023', '08:35:46am'),
(15, 1, 'Aug 14, 2023', '08:19:42pm'),
(16, 2, 'Aug 15, 2023', '02:28:35pm'),
(17, 1, 'Aug 15, 2023', '02:37:57pm'),
(18, 1, 'Aug 15, 2023', '02:49:33pm'),
(19, 1, 'Aug 16, 2023', '12:49:57am'),
(20, 1, 'Aug 16, 2023', '12:50:34am'),
(21, 1, 'Aug 17, 2023', '02:59:15pm'),
(22, 2, 'Aug 17, 2023', '04:01:33pm'),
(23, 1, 'Aug 17, 2023', '04:01:59pm'),
(24, 2, 'Aug 17, 2023', '04:03:08pm'),
(25, 1, 'Aug 17, 2023', '04:04:48pm'),
(26, 1, 'Aug 17, 2023', '09:53:21pm'),
(27, 1, 'Aug 21, 2023', '04:34:21pm'),
(28, 1, 'Aug 21, 2023', '04:34:47pm'),
(29, 1, 'Aug 21, 2023', '04:44:02pm'),
(30, 1, 'Aug 21, 2023', '04:44:36pm'),
(31, 1, 'Aug 21, 2023', '04:46:08pm'),
(32, 1, 'Aug 21, 2023', '04:46:54pm'),
(33, 1, 'Aug 21, 2023', '04:47:16pm'),
(34, 1, 'Aug 21, 2023', '04:47:33pm'),
(35, 1, 'Aug 21, 2023', '04:47:50pm'),
(36, 1, 'Aug 21, 2023', '04:51:30pm'),
(37, 1, 'Aug 21, 2023', '04:51:57pm'),
(38, 1, 'Aug 21, 2023', '04:53:09pm'),
(39, 1, 'Aug 21, 2023', '04:53:50pm'),
(40, 1, 'Aug 21, 2023', '04:55:03pm'),
(41, 1, 'Aug 21, 2023', '04:56:45pm'),
(42, 1, 'Aug 21, 2023', '04:57:30pm'),
(43, 1, 'Aug 22, 2023', '01:58:15pm'),
(44, 1, 'Aug 23, 2023', '02:56:54pm'),
(45, 2, 'Aug 24, 2023', '03:44:46pm'),
(46, 1, 'Aug 24, 2023', '03:45:18pm'),
(47, 2, 'Aug 24, 2023', '03:47:29pm'),
(48, 2, 'Aug 24, 2023', '03:48:15pm'),
(49, 1, 'Aug 24, 2023', '03:48:27pm'),
(50, 1, 'Aug 24, 2023', '03:51:06pm'),
(51, 1, 'Aug 24, 2023', '03:52:32pm'),
(52, 2, 'Aug 24, 2023', '03:53:24pm'),
(53, 2, 'Aug 24, 2023', '03:55:22pm'),
(54, 1, 'Aug 24, 2023', '03:55:36pm'),
(55, 1, 'Aug 24, 2023', '03:55:48pm'),
(56, 2, 'Aug 24, 2023', '03:56:02pm'),
(57, 1, 'Aug 24, 2023', '04:28:01pm'),
(58, 3, 'Aug 24, 2023', '09:10:16pm'),
(59, 2, 'Aug 24, 2023', '09:12:18pm');

-- --------------------------------------------------------

--
-- Table structure for table `payout_method`
--

CREATE TABLE `payout_method` (
  `id` int(22) NOT NULL,
  `user_id` int(11) NOT NULL,
  `number` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `wallet` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payout_method`
--

INSERT INTO `payout_method` (`id`, `user_id`, `number`, `bank`, `name`, `type`, `date`, `time`, `wallet`, `address`) VALUES
(1, 1, '1233334445555', 'First Bank', 'University of ibadan', 'bank', '13/Aug/2023', '02:12:23pm', '', ''),
(3, 1, '', '', '', 'crypto', '14/Aug/2023', '12:04:25am', 'Bitcoin - BTC', 'qwertyusmcscnmsbcnsnvnsbnsbh2t672t67'),
(4, 1, '', '', '', 'crypto', '14/Aug/2023', '01:36:02am', 'USDT', 'qwertyusmcscnmsbcnsnvnsbnsbh2t672t67');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(100) NOT NULL,
  `card_id` int(100) NOT NULL,
  `subcategory` varchar(255) NOT NULL,
  `buy` float(20,2) NOT NULL,
  `minimum` float(20,2) NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `trans_id` varchar(100) NOT NULL,
  `amount` float(20,5) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `status` varchar(22) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `trans_id`, `amount`, `image`, `date`, `time`, `status`) VALUES
(8, 1, '#YXkSrn1q2WVj9uaKPNUJ', 3000.00000, '21-08-23 1__11__copy-removebg-preview.png', '21/Aug/2023', '11:00:13pm', 'approved'),
(11, 1, '#DjXW3INavpHklT9V2hY7', 2330.00000, '24-08-23 IMG-20230811-WA0003.jpg', '24/Aug/2023', '05:30:26pm', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `token`, `phone`, `date`, `level`) VALUES
(1, 'world@gmail.com', '1234', '871c4c18e1a9649fa3cb2a2b52fdc8c25468', '+2362228227', '21/Aug/2023', 'user'),
(2, 'admin@gmail.com', '9000', '0d7f82db16c4ceba3e383f8fabf2009a7458', '1234455', '24/Aug/2023', 'admin'),
(3, 'user@gmail.com', '1234', 'cba1f2d695a5ca39ee6f343297a761a42724', '0455552133421', '24/Aug/2023', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `user_id`, `balance`) VALUES
(1, 1, 9358),
(2, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal`
--

CREATE TABLE `withdrawal` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `amount` float(20,2) NOT NULL,
  `account` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'pending',
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `withdrawal`
--

INSERT INTO `withdrawal` (`id`, `user_id`, `amount`, `account`, `status`, `date`, `time`) VALUES
(1, 1, 1111.00, 'aaaaadsmaskdmijd', 'approve', '22/Aug/2023', '03:44:04pm'),
(2, 1, 1111.00, 'aaaaadsmaskdmijd', 'approve', '22/Aug/2023', '03:44:44pm'),
(3, 1, 1111.00, 'aaaaadsmaskdmijd', 'approve', '22/Aug/2023', '03:45:22pm'),
(4, 1, 1111.00, 'aaaaadsmaskdmijd', 'pending', '22/Aug/2023', '03:45:51pm'),
(5, 1, 445.00, 'hasuqysqsqhuys7ys7y27sjdi9uw9ud8w', 'pending', '22/Aug/2023', '03:46:59pm'),
(6, 1, 500.00, '', 'pending', '22/Aug/2023', '04:16:10pm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investment`
--
ALTER TABLE `investment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payout_method`
--
ALTER TABLE `payout_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trans_id` (`trans_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawal`
--
ALTER TABLE `withdrawal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `investment`
--
ALTER TABLE `investment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `payout_method`
--
ALTER TABLE `payout_method`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `withdrawal`
--
ALTER TABLE `withdrawal`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
