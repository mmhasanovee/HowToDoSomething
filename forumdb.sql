-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2019 at 06:03 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forumdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` smallint(6) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `position` smallint(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `position`) VALUES
(3, 'PHP', 'Questions about php codes.', 2),
(4, 'Fast foods', 'Questions about any types of fast foods.', 3),
(2, 'CSS', 'Questions about CSS codes.', 1),
(1, 'Gaming', 'Questions about any gaming, peripherals, accessories etc.', 6),
(5, 'Mobile Development', 'Questions about android mobile application development and Ios', 4),
(6, 'Mobile Phones', 'Questions about suggestions and so on buying a new phone.', 5),
(7, 'PC Building', 'Ask about processors, ram anything.', 7),
(8, 'Social medias', 'Ask anything about social medias. Facebook, Twitter, Instagram etc.', 8);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `parent` smallint(6) NOT NULL,
  `id` int(11) NOT NULL,
  `id2` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `message` longtext NOT NULL,
  `authorid` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `timestamp2` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`parent`, `id`, `id2`, `title`, `message`, `authorid`, `timestamp`, `timestamp2`) VALUES
(1, 1, 2, '', 'very much, more than u hahaha', 3, 1566727521, 1566727521),
(5, 3, 1, 'How to use Linear layout within Relative layout?', 'Obviously in the Android Studio. ', 2, 1566727311, 1566727808),
(2, 5, 1, 'How to select first child?', 'Help...', 3, 1566727510, 1566727510),
(6, 4, 1, 'Budget 20k, which phone?', 'Thinking about Redmi Note 7 pro.', 2, 1566727469, 1566748572),
(1, 1, 1, 'How much you like csgo?', 'Comment answer plz.', 2, 1566727250, 1566745917),
(4, 2, 1, 'Which Burger is the best?', 'Suggest!', 2, 1566727269, 1566727269),
(3, 6, 1, 'Why mysql doesnt work anymore?', 'I&#039;m really bothered about this issue', 3, 1566727577, 1566727834),
(5, 3, 2, '', 'inearLayout within Relative Layout XML. change RelativeLayout so that it&#039;s height is only as tall as the bar on the top (50dp) have LinearLayout begin 50dp down, so that it&#039;s top meets the bottom of the RelativeLayout.', 3, 1566727808, 1566727808),
(3, 6, 2, '', 'user mysqli maybe, it will work. And try to be more specific. thnx.', 3, 1566727834, 1566727834),
(1, 1, 3, '', 'Lol, okay then.', 2, 1566745440, 1566745440),
(1, 1, 4, '', 'Okay, u r funny.', 1, 1566745917, 1566745917),
(6, 4, 2, '', 'Go for Samsung a30, not a bad set.', 1, 1566748572, 1566748572);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` text NOT NULL,
  `signup_date` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `avatar`, `signup_date`) VALUES
(1, 'admin1', '6c7ca345f63f835cb353ff15bd6c5e052ec08e7a', 'admin@gmail.com', 'https://cdn.pixabay.com/photo/2013/07/13/10/07/man-156584_960_720.png', 1566537933),
(3, 'user02', 'a7659675668c2b34f0a456dbaa508200340dc36c', 'user02@gmail.com', '', 1566720976),
(4, 'user03', '6f092588a43665e24a7917924ba216f50fb7737d', 'user03@gmail.com', '', 1566721002),
(2, 'user01', '0497fe4d674fe37194a6fcb08913e596ef6a307f', 'user01@gmail.com', 'https://cdn.iconscout.com/icon/free/png-256/avatar-368-456320.png', 1566720937),
(5, 'user04', '11b5abfbc0914db858d26ca8aa6f2226fef36f59', 'user04@gmail.com', '', 1566721027),
(6, 'user05', '197cc002d772535e2af4ad8a1ac04969091e7ff6', 'user05@gmail.com', 'https://static.vecteezy.com/system/resources/previews/000/424/408/non_2x/avatar-icon-vector-illustration.jpg', 1566747664);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`,`id2`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
