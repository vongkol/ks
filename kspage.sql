-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 08, 2018 at 06:25 PM
-- Server version: 10.1.26-MariaDB-0+deb9u1
-- PHP Version: 7.2.7-1+0~20180622080745.23+stretch~1.gbpfd8e2e

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kspage`
--

-- --------------------------------------------------------

--
-- Table structure for table `business_transfers`
--

CREATE TABLE `business_transfers` (
  `id` bigint(20) NOT NULL,
  `title` varchar(250) NOT NULL,
  `category_id` int(11) NOT NULL,
  `short_description` text,
  `featured_image` varchar(220) NOT NULL DEFAULT 'default.png',
  `owner_id` int(11) NOT NULL,
  `description` longtext,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `business_transfers`
--

INSERT INTO `business_transfers` (`id`, `title`, `category_id`, `short_description`, `featured_image`, `owner_id`, `description`, `active`, `create_at`) VALUES
(1, 'Transfer Computer Shop for 2000$ only', 2, 'hello World', '1kunapheap-logo.png', 2, '<p>Some description</p>', 1, '2018-08-14 00:59:13'),
(2, 'test hello world', 2, 'sdfasdfsadfsdfsdf', 'default.png', 2, '<p>sadfasdfasdfsadf</p>', 0, '2018-08-14 02:02:39'),
(3, 'test hello world', 2, 'hello', '3header-logo.png', 1, '<p>some description</p>', 1, '2018-08-14 02:03:10'),
(4, 'test', 2, 'yes', '4requirement.png', 1, '<p>sdfasdf</p>', 1, '2018-08-14 02:29:35');

-- --------------------------------------------------------

--
-- Table structure for table `business_types`
--

CREATE TABLE `business_types` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `business_types`
--

INSERT INTO `business_types` (`id`, `name`, `active`, `create_at`) VALUES
(1, 'Small and Medium', 1, '2018-04-07 06:06:39'),
(2, 'test', 1, '2018-05-05 16:20:20'),
(3, '111test', 1, '2018-05-05 16:21:11'),
(4, '1', 0, '2018-05-05 16:21:15');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(80) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `parent_id` bigint(20) NOT NULL DEFAULT '0',
  `icon` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `business_type` int(11) DEFAULT NULL,
  `address` varchar(230) DEFAULT NULL,
  `office_phone` varchar(50) DEFAULT NULL,
  `office_email` varchar(50) DEFAULT NULL,
  `logo` varchar(200) NOT NULL DEFAULT 'default.png',
  `profile` text,
  `website` varchar(200) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `business_type`, `address`, `office_phone`, `office_email`, `logo`, `profile`, `website`, `active`, `create_at`, `category_id`) VALUES
(1, 'Vdoo Solution', 1, '281 Preah Norodom Blvd (41), Room 601, 6th Floor,Tai Ming Plaza Hotel, Phnom Penh, Cambodia\r\n', '017 83 77 54', 'sales@vdoo.biz', 'default.png', 'More About Cambodia Yellow Pages\r\n023 993 305 Yellow Pages Directory Assistant open from Monday to Friday (8:00am to 5:00pm).\r\nFind what you need more Easily, Faster and in more ways with Cambodia Yellow Pages.The Cambodia Yellow Pages 2018 is Available!\r\n\r\nFor your FREE copy please call to 023 993 305 \r\n\r\nYellow Pages on your mobile phone. \r\n\r\nPlease go to www.yp.com.kh by using your internet mobile phone\r\nNew! Pocket Master Map is Coming Soon!\r\n\r\nThe most easy way to find the location.', 'https://www.linkedin.com/feed/', 1, '2018-04-07 07:23:32', 1),
(2, 'Cambodia HR Angkor', 1, 'Borey Solary Phone Penh', '010292838', 'sorvichey@gmai.com', '2mtc-logo.jpg', '<p>test</p>', 'www.abc', 1, '2018-05-04 04:56:13', 1),
(3, 'Cambodia HR Angkor', 1, '281 Preah Norodom Blvd (41), Room 601, 6th Floor,Tai Ming Plaza Hotel, Phnom Penh, Cambodia', '010292838', 'sorvichey@gmai.com', '3logo-mtc.png', '<p>test</p>', 'www.abc', 1, '2018-05-04 04:56:14', 1),
(4, 'Vdoo', 1, 'test', 'test', 'test@gmail.com', '4mtc-logo-old.jpg', '<p>test</p>\r\n\r\n<p>&nbsp;</p>', NULL, 1, '2018-05-05 16:12:29', 1),
(5, 'test', 1, NULL, NULL, NULL, 'default.png', NULL, NULL, 0, '2018-05-05 16:13:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_categories`
--

CREATE TABLE `company_categories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(80) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `parent_id` bigint(20) NOT NULL DEFAULT '0',
  `icon` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company_categories`
--

INSERT INTO `company_categories` (`id`, `name`, `active`, `create_at`, `parent_id`, `icon`) VALUES
(1, 'IT Service', 1, '2018-04-07 05:51:56', 0, '1ico.png'),
(2, 'Construction and Engineering', 1, '2018-04-07 05:52:01', 0, NULL),
(3, 'test', 0, '2018-05-05 16:17:48', 0, NULL),
(4, '11test', 1, '2018-05-05 16:18:41', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `gender` varchar(9) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(120) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `gender`, `email`, `phone`, `username`, `password`, `create_at`) VALUES
(2, 'HENG', 'Vongkol', 'Male', 'hengvongkol@gmail.com', '345345', 'vongkol', '$2y$10$qiyti7W4tfxwu2LANS6RwOQqbZVZ9o3KaSTpVR1tPJntGG8fUV57S', '2018-09-08 07:19:52'),
(4, 'Oudom', 'PEN', 'Male', 'vongkolheng@gmail.com', '123141', 'dom', '234', '2018-09-08 08:38:38');

-- --------------------------------------------------------

--
-- Table structure for table `customer_histories`
--

CREATE TABLE `customer_histories` (
  `id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `create_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_histories`
--

INSERT INTO `customer_histories` (`id`, `customer_id`, `product_id`, `category_id`, `create_at`) VALUES
(1, 1, 4, 4, '2018-09-04'),
(2, 1, 1, 3, '2018-09-04'),
(3, 1, 4, 4, '2018-09-04'),
(4, 1, 1, 3, '2018-09-04'),
(5, 2, 4, 4, '2018-09-08'),
(6, 2, 8, 4, '2018-09-08'),
(7, 2, 4, 4, '2018-09-08');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) NOT NULL,
  `title` text NOT NULL,
  `location` varchar(200) DEFAULT NULL,
  `event_date` varchar(200) DEFAULT NULL,
  `description` longtext,
  `event_category` int(11) DEFAULT NULL,
  `featured_image` varchar(200) DEFAULT NULL,
  `event_organizor` varchar(230) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `start_time` varchar(30) NOT NULL,
  `end_time` varchar(30) NOT NULL,
  `map` text,
  `price` varchar(50) NOT NULL DEFAULT 'Free',
  `register_link` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `location`, `event_date`, `description`, `event_category`, `featured_image`, `event_organizor`, `active`, `create_at`, `start_time`, `end_time`, `map`, `price`, `register_link`) VALUES
(1, 'JCI Cambodia Public Speaking & Debating ', 'CamEd Business School', 'May 6, 2018', '<p>Our two Cambodians have an opportunity to attend the eFounders Fellowship program, now they are happy to share what they have learned during the 11 days program to the Cambodian Startup Community in Phnom Penh. \r\n\r\nMr. Chea Langda, CEO of Bookmebus and Mr. Sim Chankiriroth, CEO of Banhji are willing to share with the Tech & Startup Community at Emerald HUB co-working space.\r\n\r\nLocation: Emerald HUB\r\n\r\nDate: May 1st, 2018 ; Tuesday \r\n\r\nTime: 5:30-pm to 7:30pm</p>', 1, NULL, 'Mr. Sor Vichey', 0, '2018-05-04 01:47:14', ' 05:30 PM', '07:30 PM', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31272.868640155637!2d104.88498529622686!3d11.544068225408784!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310951add5e2cd81%3A0x171e0b69c7c6f7ba!2sPasserelles+num%C3%A9riques+Cambodia+(PNC)!5e0!3m2!1sen!2skh!4v1525408157219', 'Free', ''),
(2, 'Open Talk: Alibaba eFounders Sharing', ' Emerald HUB', 'May 1st, 2018', 'test', 1, 'default.svg', '', 0, '2018-05-04 02:37:40', ' 5:30-pm', '8:30-pm', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31272.868640155637!2d104.88498529622686!3d11.544068225408784!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310951add5e2cd81%3A0x171e0b69c7c6f7ba!2sPasserelles+num%C3%A9riques+Cambodia+(PNC)!5e0!3m2!1sen!2skh!4v1525408157219', '$ 1.50', ''),
(3, 'Open Talk: Alibaba eFounders Sharing', 'Emerald HUB', 'May 1st, 2018', '<p>test</p>', 1, 'default.svg', 'Mr.Sam Rithy', 0, '2018-05-04 02:37:42', '5:30-pm', '8:30-pm', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31272.868640155637!2d104.88498529622686!3d11.544068225408784!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310951add5e2cd81%3A0x171e0b69c7c6f7ba!2sPasserelles+num%C3%A9riques+Cambodia+(PNC)!5e0!3m2!1sen!2skh!4v1525408157219', '$ 5.00', NULL),
(4, 'JCI Cambodia Public Speaking & Debating Championship 2018', 'Borey Pipobtmey', 'July, 9, 2010', '<p>test</p>', 4, 'event4.jpeg', 'test', 1, '2018-05-04 02:39:15', '3:30-pm', '9:30-pm', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31272.868640155637!2d104.88498529622686!3d11.544068225408784!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310951add5e2cd81%3A0x171e0b69c7c6f7ba!2sPasserelles+num%C3%A9riques+Cambodia+(PNC)!5e0!3m2!1sen!2skh!4v1525408157219', 'Free', 'https://www.vdoo.biz'),
(5, 'JCI Cambodia Public Speaking p 2018', 'Borey Pipobtmey', 'July, 9, 2010', 'test', 1, NULL, 'test', 0, '2018-05-04 02:39:20', '3:30-pm', ' 9:30-pm', NULL, 'Free', ''),
(6, 'New Innovation Idea Test', 'Phnom Penh', 'May, 9, 2019', '<p>testtest</p>', 7, 'event6.jpeg', 'Mr.Sor Vichey', 1, '2018-05-05 09:48:55', '10:00 AM', '11:00 PM', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31272.868640155637!2d104.88498529622686!3d11.544068225408784!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310951add5e2cd81%3A0x171e0b69c7c6f7ba!2sPasserelles+num%C3%A9riques+Cambodia+(PNC)!5e0!3m2!1sen!2skh!4v1525408157219', '1.00', '11'),
(7, 'New', 'Phnom Penh', 'Jul, 20, 2019', NULL, 2, NULL, 'Mr. Sor Vichey', 0, '2018-05-05 15:50:30', '1:00 PM', '11:00 AM', '123', '10', '123'),
(8, 'New', 'Phnom Penh', 'Jul, 20, 2019', '<p>test</p>', 2, NULL, 'Mr. Sor Vichey', 0, '2018-05-05 15:50:38', '1:00 PM', '11:00 AM', '1231', '10', '1231'),
(9, 'test', 'Phnom Penh', 'May, 9, 2019', NULL, 4, 'event9.jpeg', NULL, 1, '2018-07-06 08:16:33', '10:00 AM', '11:00 AM', NULL, '0', NULL),
(10, 'test', 'Phnom Penh', 'May, 9, 2019', '<p>test</p>', 2, 'event10.jpeg', NULL, 1, '2018-07-06 08:30:19', '10:00 AM', '1', NULL, '2.00', NULL),
(11, 'About Us', 'Phnom Penh', 'May, 9, 2019', '<p>test</p>', 2, NULL, 'Mr.Sor Vichey', 0, '2018-07-06 09:10:04', '10:00 AM', '11:00 AM', NULL, '1.00', NULL),
(12, 'About Us', 'Phnom Penh', 'May, 9, 2019', '<p>test</p>', 2, 'event12.jpeg', 'Mr.Sor Vichey', 1, '2018-07-06 09:10:20', '10:00 AM', '11:00 AM', NULL, '1.00', NULL),
(13, 'test', 'Phnom Penh', 'May, 9, 2019', NULL, 3, 'event13.jpeg', 'Mr.Sor Vichey', 1, '2018-07-06 09:14:07', '10:00 AM', '11:00 AM', NULL, '10.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event_categories`
--

CREATE TABLE `event_categories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(80) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `parent_id` bigint(20) NOT NULL DEFAULT '0',
  `icon` varchar(250) DEFAULT 'default.png'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event_categories`
--

INSERT INTO `event_categories` (`id`, `name`, `active`, `create_at`, `parent_id`, `icon`) VALUES
(1, 'Education', 1, '2018-05-05 16:43:57', 0, '12.png'),
(2, 'Concert', 1, '2018-05-05 16:44:16', 0, '28.png'),
(3, 'Exhibition', 1, '2018-05-05 16:54:12', 0, '310.png'),
(4, 'Workshop', 1, '2018-05-07 02:09:51', 0, 'default.png'),
(5, 'Webinar', 1, '2018-05-07 02:12:26', 0, 'default.png'),
(6, 'Business', 1, '2018-05-08 16:53:58', 0, '6vdoo.png'),
(7, 'test', 1, '2018-07-06 03:33:33', 3, 'default.png'),
(8, '1-event', 1, '2018-07-06 07:44:03', 1, 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `event_histories`
--

CREATE TABLE `event_histories` (
  `id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `event_id` bigint(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `create_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event_histories`
--

INSERT INTO `event_histories` (`id`, `customer_id`, `event_id`, `category_id`, `create_at`) VALUES
(1, 1, 12, 2, '2018-09-08'),
(2, 1, 13, 3, '2018-09-08'),
(3, 1, 10, 2, '2018-09-08'),
(4, 1, 10, 2, '2018-09-08'),
(5, 2, 10, 2, '2018-09-08'),
(6, 2, 10, 2, '2018-09-08');

-- --------------------------------------------------------

--
-- Table structure for table `menu_options`
--

CREATE TABLE `menu_options` (
  `id` int(11) NOT NULL,
  `name` varchar(220) NOT NULL,
  `member_id` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `url` varchar(200) NOT NULL DEFAULT '#',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `description`, `active`, `url`, `create_at`) VALUES
(1, 'Test', '<p>Test Page ok</p>', 1, 'admin/page/view/1', '2018-08-06 04:17:15');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(90) NOT NULL,
  `list` tinyint(4) NOT NULL DEFAULT '0',
  `insert` tinyint(4) NOT NULL DEFAULT '0',
  `update` tinyint(4) NOT NULL DEFAULT '0',
  `delete` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `list`, `insert`, `update`, `delete`) VALUES
(1, 'Branch', 0, 0, 0, 0),
(2, 'Class', 0, 0, 0, 0),
(3, 'School Year', 0, 0, 0, 0),
(4, 'Room', 0, 0, 0, 0),
(5, 'Subject', 0, 0, 0, 0),
(6, 'Student', 0, 0, 0, 0),
(7, 'Permission', 0, 0, 0, 0),
(8, 'Role', 0, 0, 0, 0),
(9, 'User', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `category_id` int(11) NOT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `sell_price` float DEFAULT NULL,
  `featured_image` varchar(200) DEFAULT 'image-default.png',
  `short_description` text,
  `description` longtext,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quantity` int(11) DEFAULT NULL,
  `type` varchar(30) DEFAULT 'General',
  `best_sell` int(11) DEFAULT NULL,
  `discount` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `shop_id`, `price`, `sell_price`, `featured_image`, `short_description`, `description`, `active`, `create_at`, `quantity`, `type`, `best_sell`, `discount`) VALUES
(1, 'OnePlus 6', 3, 1, 560, 550, 'pro1.jpg', 'OnePlus 6 is the Android phone for 2018.', '<p>Put some description of your phone here...</p>', 1, '2018-06-18 03:14:01', 20, 'General', 1, 5),
(2, 'McBook Pro 2017', 12, 1, 2900, 2500, 'pro2.jpg', 'The best laptop from Apple this year.', '<p>This is the mc book pro 2017, the best laptop from apple ever made over the past decade.</p>', 0, '2018-06-21 02:55:37', 30, 'General', NULL, 0),
(3, 'iPhone 8 Plus', 1, 1, 800, 700, 'pro3.jpg', 'some description', '<p>I phone</p>', 1, '2018-07-03 12:12:57', 1, 'General', 1, 0),
(4, 'Test Product', 4, 2, 800, 680, 'pro4.jpg', 'sdfsfsdfsd', '<p>sdfsadfsadf</p>', 1, '2018-07-03 12:21:14', 1, 'General', NULL, 9),
(5, 'OPPO F7', 1, 1, 600, 300, 'pro5.jpg', 'some description', '<p>Some description working!</p>', 1, '2018-07-03 12:23:54', 1, 'Baby', NULL, 6),
(6, 'Iphone 8', 1, 2, 200, 150, 'pro6.jpg', 'test', '<p>test</p>', 1, '2018-07-06 06:15:57', 1, 'General', 1, 0),
(7, 'Phone 6', 4, 2, 0, 0, 'pro7.jpg', '1', '<p>test</p>', 1, '2018-07-06 06:19:27', 1, 'Baby', 1, 0),
(8, 'Sample Baby Pro', 4, 1, 70, 50, 'pro8.jpg', 'This is the sample product.', '<p>This is the sample product for baby shop!</p>', 1, '2018-07-21 09:29:27', 10, 'Baby', NULL, 0),
(11, 'test', 15, 1, 10, 8, 'pro34xrwe11.png', 'test edit', '<p>test</p>', 1, '2018-08-12 11:29:08', 100, 'General', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(80) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `parent_id` bigint(20) DEFAULT '0',
  `icon` varchar(250) DEFAULT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'General'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `active`, `create_at`, `parent_id`, `icon`, `type`) VALUES
(1, 'Smart Phone', 1, '2018-04-07 02:50:56', 0, '1if_12_939749.png', 'General'),
(2, 'iPad', 1, '2018-04-07 02:51:18', 15, '2if_27_939733.png', 'General'),
(3, 'OnePlus', 1, '2018-04-07 02:51:50', 0, '3if_30_939730.png', 'General'),
(4, 'Baby Powder', 1, '2018-04-07 02:52:06', 0, '4if_14_939747.png', 'Baby'),
(5, 'Sumsung', 1, '2018-04-07 02:52:13', 0, '5if_8_939753.png', 'General'),
(6, 'Sumsung Note Series', 0, '2018-04-07 02:52:46', 5, NULL, 'General'),
(7, 'Home', 1, '2018-05-12 09:36:52', 0, '7if_shop_house-home_2222735.png', 'General'),
(8, 'Power Bank', 1, '2018-06-21 02:40:19', 0, '8if_30_939730.png', 'General'),
(9, 'Desktop', 1, '2018-06-21 02:40:41', 0, '9if_14_939747.png', 'General'),
(10, 'Laptop Lenovo', 1, '2018-06-21 02:40:59', 0, '10if_8_939753.png', 'General'),
(11, 'Dell Server', 1, '2018-06-21 02:41:37', 0, '11if_27_939733.png', 'General'),
(12, 'McBook Pro', 1, '2018-06-21 02:41:59', 15, '12if_27_939733.png', 'General'),
(13, 'Mini Mart', 1, '2018-06-21 02:42:32', 0, '13if_14_939747.png', 'General'),
(14, 'Restaurants', 1, '2018-06-21 02:42:44', 0, '14if_shop_house-home_2222735.png', 'General'),
(15, 'Apple Products', 1, '2018-07-24 08:50:01', 0, '13if_14_939747.png', 'General');

-- --------------------------------------------------------

--
-- Table structure for table `product_photos`
--

CREATE TABLE `product_photos` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `photo` varchar(250) DEFAULT NULL,
  `product_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_photos`
--

INSERT INTO `product_photos` (`id`, `title`, `photo`, `product_id`) VALUES
(1, 'OnePlus 6 256 GB Edition', 'photo1-1.jpg', 1),
(2, 'Front Photo for oneplus 6', 'photo2-1.jpeg', 1),
(3, 'Photo 1', 'photo3-2.jpg', 2),
(4, 'photo 2', 'photo4-2.jpg', 2),
(5, 'photo 3', 'photo5-2.jpg', 2),
(8, 'One Pluse 5', 'photo8-5.jpg', 5),
(9, NULL, 'photo9-4.jpg', 4),
(10, NULL, 'photo10-4.jpg', 4),
(11, NULL, 'photo11-5.jpg', 5),
(12, NULL, 'photo12-5.jpg', 5),
(13, NULL, 'photo13-5.jpg', 5),
(14, NULL, 'photo14-5.JPEG', 5),
(15, NULL, 'photo15-5.jpg', 5),
(16, NULL, 'photo16-5.jpg', 5),
(23, NULL, 'photo23-6.jpg', 6),
(24, NULL, 'photo24-3.jpg', 3),
(25, NULL, 'photo25-7.jpg', 7),
(26, NULL, 'photo26-7.jpg', 7),
(27, NULL, 'photo27-7.jpg', 7);

-- --------------------------------------------------------

--
-- Table structure for table `program_categories`
--

CREATE TABLE `program_categories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(80) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `parent_id` bigint(20) NOT NULL DEFAULT '0',
  `icon` varchar(250) DEFAULT 'default.png'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `program_categories`
--

INSERT INTO `program_categories` (`id`, `name`, `active`, `create_at`, `parent_id`, `icon`) VALUES
(1, 'IT Engineering', 1, '2018-05-12 03:09:48', 0, 'default.png'),
(2, 'Civil Engineering', 1, '2018-05-12 03:09:58', 0, 'default.png'),
(3, '3D Animation', 1, '2018-05-21 08:09:50', 0, 'default.png'),
(4, 'Civil Law', 1, '2018-05-21 08:10:02', 0, 'program_icon4.png'),
(5, 'Admin and HR', 1, '2018-05-21 08:10:59', 0, 'program_icon5.png'),
(6, 'Recruitment', 1, '2018-05-21 08:42:31', 5, 'default.png'),
(7, 'General Administration', 1, '2018-05-21 08:42:45', 5, 'program_icon7.png');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `review_by` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `description1` longtext,
  `description2` longtext,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rate` int(11) DEFAULT NULL,
  `featured_image` varchar(200) NOT NULL DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `title`, `review_by`, `category_id`, `description1`, `description2`, `active`, `create_at`, `rate`, `featured_image`) VALUES
(1, 'OnePlus 6 Full Review', 1, 6, '<p><img alt=\"\" src=\"/uploads/reviews/oneplus6-photo/RKuRpkr9C6N2a8RSohNuDM_1200_80.jpg\" style=\"width:100%\" /></p>\r\n\r\n<p>The OnePlus 6 is the most polished, premium smartphone the firm has made in its short existence.</p>\r\n\r\n<p>It boasts an all-glass design, bringing it in line with big-name flagships such as the&nbsp;<a href=\"https://www.techradar.com/reviews/samsung-galaxy-s9-review\">Samsung Galaxy S9</a>&nbsp;and&nbsp;<a href=\"https://www.techradar.com/reviews/iphone-x-review\">iPhone X</a>, a large 6.28-inch display complete with the on-trend notch, dual rear-facing cameras, both fingerprint and face unlock, and up to 256GB of storage.</p>\r\n\r\n<p>There are several core improvements over the&nbsp;<a href=\"https://www.techradar.com/reviews/oneplus-5t-review\">OnePlus 5T</a>&nbsp;(and&nbsp;<a href=\"https://www.techradar.com/reviews/oneplus-5\">OnePlus 5</a>) that it replaces, and while it may not break any new ground in terms of features, the OnePlus 6 brings an attractive package that makes it relevant in 2018.&nbsp;</p>\r\n\r\n<h2>OnePlus 6 price and availability</h2>\r\n\r\n<ul>\r\n	<li><strong>OnePlus 6 release date: May 22</strong></li>\r\n	<li><strong>Starts at $529 (&pound;469, Rs 34,999) for 6GB/64GB</strong></li>\r\n</ul>\r\n\r\n<p>The OnePlus 6 release date is May 22 in North America, Europe and India, with the handset arriving in a host of other countries soon after.&nbsp;</p>\r\n\r\n<p>In the UK the OnePlus 6 is available exclusively on contract from O2, and SIM-free from OnePlus&rsquo; own website.</p>\r\n\r\n<p>There&#39;s no word yet on when &mdash; or even if &mdash; it&#39;ll be made available in Australia.</p>\r\n\r\n<p>The OnePlus 6 price starts at $529 (&pound;469, Rs 34,999) for the 6GB of RAM and 64GB of storage configuration, which is more expensive than the OnePlus 5T, which cost $499 (&pound;449) for the same RAM and storage.</p>\r\n\r\n<p>Then you have the 8GB/128GB variant at $579 (&pound;519, Rs 39,999), which again is a $20/&pound;20 increase over the 5T.</p>\r\n\r\n<p>Finally, there&#39;s the new top-end 8GB/256GB model, which officially takes the title of the most expensive OnePlus smartphone ever. This OnePlus 6 price for this configuration is $629 (&pound;569).</p>\r\n\r\n<p>That&#39;s still cheaper than the likes of the Galaxy S9,&nbsp;<a href=\"https://www.techradar.com/reviews/iphone-8-review\">iPhone 8</a>,&nbsp;<a href=\"https://www.techradar.com/reviews/lg-g7-thinq\">LG G7 ThinQ</a>&nbsp;and&nbsp;<a href=\"https://www.techradar.com/reviews/sony-xperia-xz2-review\">Sony Xperia XZ2</a>, but if you&#39;re looking for something more affordable you may want to check out the&nbsp;<a href=\"https://www.techradar.com/reviews/honor-10-review\">Honor 10</a>.</p>\r\n\r\n<p>If you&#39;re in India or China, the 8GB/256GB configuration of the OnePlus 6 is actually a&nbsp;<a href=\"https://www.techradar.com/news/oneplus-6-avengers-infinity-wars-limited-edition\">limited-edition Marvel Avengers device</a>, available from May 29 for Rs 44,999.</p>', '<p>Description 2</p>', 1, '2018-05-12 04:41:16', NULL, 'r1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `review_categories`
--

CREATE TABLE `review_categories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(80) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `icon` varchar(250) DEFAULT 'default.png',
  `parent_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `review_categories`
--

INSERT INTO `review_categories` (`id`, `name`, `active`, `create_at`, `icon`, `parent_id`) VALUES
(1, 'test១', 0, '2018-05-08 16:54:47', NULL, 0),
(2, 'test2', 0, '2018-05-08 16:54:55', '2logo5.png', 0),
(3, 'Smart Watch', 1, '2018-05-08 16:55:03', '3logo5.png', 0),
(4, 'Smart TV', 1, '2018-05-08 16:59:49', '4tw.png', 0),
(5, 'Galaxy Note', 1, '2018-05-08 17:00:47', '5kh.png', 7),
(6, 'OnePlus', 1, '2018-05-08 17:04:16', 'default.png', 7),
(7, 'Smart Phone', 1, '2018-05-08 17:05:11', '7phone.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `create_by` bigint(20) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `create_by`, `active`, `create_at`) VALUES
(1, 'Administrator', 0, 1, '2017-10-31 04:12:44'),
(4, 'អ្នកបញ្ចូលទិន្នន័យ', 0, 0, '2017-10-31 04:12:44'),
(5, 'Manager', 0, 1, '2017-10-31 04:12:44'),
(10, 'Owner', 1, 0, '2017-10-31 04:39:46'),
(11, 'company admin', 1, 0, '2017-10-31 04:40:23'),
(12, 'root re', 1, 0, '2017-10-31 04:45:27'),
(13, 'Credit Officer', 20, 0, '2017-10-31 14:34:28'),
(14, 'Sale Manager', 1, 1, '2017-11-09 02:35:54');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `list` int(11) NOT NULL DEFAULT '0',
  `insert` int(11) NOT NULL DEFAULT '0',
  `update` int(11) NOT NULL DEFAULT '0',
  `delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `permission_id`, `list`, `insert`, `update`, `delete`) VALUES
(1, 1, 1, 1, 1, 1, 1),
(2, 1, 6, 1, 1, 1, 1),
(3, 1, 5, 1, 1, 1, 1),
(4, 1, 4, 1, 1, 1, 1),
(5, 1, 3, 1, 1, 1, 1),
(6, 1, 2, 1, 1, 1, 1),
(7, 1, 7, 1, 1, 1, 1),
(8, 1, 8, 1, 1, 1, 1),
(9, 4, 2, 1, 1, 1, 1),
(10, 4, 3, 1, 1, 1, 1),
(11, 4, 6, 1, 1, 1, 1),
(12, 4, 9, 0, 0, 0, 0),
(13, 1, 9, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `scholarships`
--

CREATE TABLE `scholarships` (
  `id` bigint(20) NOT NULL,
  `title` text NOT NULL,
  `description` longtext,
  `school_id` int(11) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `scholarship_category` int(11) DEFAULT NULL,
  `featured_image` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scholarships`
--

INSERT INTO `scholarships` (`id`, `title`, `description`, `school_id`, `active`, `create_at`, `scholarship_category`, `featured_image`) VALUES
(1, '10 FLOORS PROJECT', NULL, 1, 1, '2018-07-08 08:09:32', 3, 'scholarship1.jpg'),
(2, '10 FLOORS PROJECT', '<p>test</p>', 1, 1, '2018-07-08 08:12:20', 1, 'scholarship2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `scholarship_categories`
--

CREATE TABLE `scholarship_categories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(80) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `parent_id` bigint(20) NOT NULL DEFAULT '0',
  `icon` varchar(250) DEFAULT 'default.png'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scholarship_categories`
--

INSERT INTO `scholarship_categories` (`id`, `name`, `active`, `create_at`, `parent_id`, `icon`) VALUES
(1, 'RUPP Scholarship', 1, '2018-07-08 08:08:48', 0, 'default.png'),
(2, 'Scholarship in Cambodia', 1, '2018-07-08 08:09:01', 0, 'default.png'),
(3, 'Local Scholarship', 1, '2018-07-08 08:09:09', 2, 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` int(11) NOT NULL,
  `name_khmer` varchar(200) NOT NULL,
  `name_english` varchar(200) DEFAULT NULL,
  `address` varchar(220) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `school_category` int(11) DEFAULT NULL,
  `profile` text,
  `logo` varchar(200) DEFAULT 'default.png',
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `name_khmer`, `name_english`, `address`, `phone`, `email`, `school_category`, `profile`, `logo`, `active`, `create_at`) VALUES
(1, 'សកលវិទ្យល័យធនធានមនុស្ស', 'University of Human Resource', 'test', '010273732', 'test@gmail.com', 4, '<p>Test test</p>\r\n\r\n<p>&nbsp;</p>', '1school1.ico', 1, '2018-04-07 04:40:58'),
(2, 'សកលវិទ្យល័យអាសី អី រុប', 'University of AEU', 'Cambodia, Phnom Penh, Brey Pepotery, #1223', '010293838', 'aeu@gmail.com', 5, '<p>test</p>', '2logo.jpg', 1, '2018-05-05 17:06:00'),
(3, 'សកលវិទ្យល័យអាសី អី រុប', 'University of AEU', 'Cambodia, Phnom Penh, Brey Pepotery, #1223', '010293838', 'aeu@gmail.com', 5, '<p>test</p>', '33-ArengLogo01.ico', 1, '2018-05-05 17:06:49');

-- --------------------------------------------------------

--
-- Table structure for table `school_categories`
--

CREATE TABLE `school_categories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(80) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `parent_id` bigint(20) NOT NULL DEFAULT '0',
  `icon` varchar(250) DEFAULT 'default.png'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `school_categories`
--

INSERT INTO `school_categories` (`id`, `name`, `active`, `create_at`, `parent_id`, `icon`) VALUES
(1, 'University', 1, '2018-04-07 05:22:34', 0, 'default.png'),
(2, 'Primary School', 1, '2018-04-07 05:22:44', 0, 'default.png'),
(3, 'High School', 1, '2018-04-07 05:22:50', 0, 'default.png'),
(4, 'Institute', 1, '2018-04-07 05:23:01', 0, 'default.png'),
(5, 'Police School', 1, '2018-04-07 05:23:18', 0, '5fb.png'),
(6, 'test', 1, '2018-05-06 05:01:27', 1, 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `school_programs`
--

CREATE TABLE `school_programs` (
  `id` bigint(20) NOT NULL,
  `title` text NOT NULL,
  `description` longtext,
  `school_id` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `program_category` int(11) DEFAULT NULL,
  `featured_image` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `school_programs`
--

INSERT INTO `school_programs` (`id`, `title`, `description`, `school_id`, `active`, `create_at`, `program_category`, `featured_image`) VALUES
(1, 'Test', '<p><span style=\"color:#c0392b\">Test</span></p>', 3, 0, '2018-04-07 04:52:58', 2, ''),
(2, 'Test', '<p>test</p>', 1, 0, '2018-05-06 04:14:15', 1, ''),
(3, 'test', '<p>test</p>', 3, 0, '2018-05-06 04:14:29', 3, ''),
(4, 'test', '<p>test</p>\r\n\r\n<p>&nbsp;</p>', 2, 1, '2018-05-06 04:34:36', 1, ''),
(5, 'test', NULL, 1, 0, '2018-05-06 04:48:31', 1, ''),
(6, 'Computer Science and Engineering', '<p>Sample description here...</p>', 1, 1, '2018-05-21 08:14:01', 1, 'school_program6.jpg'),
(7, 'te', NULL, 1, 1, '2018-07-08 05:02:46', 1, 'school_program7.jpg'),
(8, 'te', NULL, 1, 1, '2018-07-08 05:04:29', 1, 'school_program8.jpeg'),
(9, '1', NULL, 1, 0, '2018-07-08 05:08:22', 1, NULL),
(10, '1', NULL, 1, 0, '2018-07-08 05:09:53', 1, 'school_program10.jpg'),
(11, '1', NULL, 1, 0, '2018-07-08 05:10:31', 1, NULL),
(12, '10 FLOORS PROJECT', NULL, 1, 1, '2018-07-08 05:10:56', 1, NULL),
(13, '10 FLOORS PROJECT', NULL, 1, 1, '2018-07-08 05:11:30', 1, NULL),
(14, '10 FLOORS PROJECT', NULL, 1, 1, '2018-07-08 05:12:53', 1, 'event14.jpg'),
(15, 'Google Translate', '<p>1</p>', 1, 1, '2018-07-08 05:13:20', 1, 'event15.jpg'),
(16, 'hello world', '<p>1</p>', 1, 1, '2018-07-08 05:14:00', 1, 'event16.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `shop_category` int(11) NOT NULL,
  `address` varchar(250) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `website` varchar(200) DEFAULT NULL,
  `logo` varchar(200) NOT NULL DEFAULT 'default.png',
  `shop_owner` int(11) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `name`, `shop_category`, `address`, `phone`, `email`, `website`, `logo`, `shop_owner`, `active`, `create_at`, `description`) VALUES
(1, 'Kohdaj Shop', 1, 'Phnom Penh, Cambodia', '086 397 627', 'info@kohdaj.com', 'www.kohdaj.com', '1logo-mtc.jpg', 1, 1, '2018-04-07 03:15:53', '<p>Test</p>'),
(2, 'Kara Online Shop', 1, NULL, NULL, NULL, NULL, '2mtc-logo.jpg', 1, 1, '2018-05-06 08:13:08', NULL),
(3, 'Online Shop Cambodia', 1, NULL, NULL, NULL, NULL, '3default.png', 1, 1, '2018-05-07 03:05:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_categories`
--

CREATE TABLE `shop_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_categories`
--

INSERT INTO `shop_categories` (`id`, `name`, `active`, `create_at`) VALUES
(1, 'Baby Shop', 1, '2018-04-07 02:23:45'),
(2, 'Moto Shop', 1, '2018-04-07 02:24:00'),
(3, 'Phamacy', 0, '2018-04-07 02:24:09'),
(4, 'Phone Shop', 1, '2018-04-07 02:24:24'),
(5, 'Electronic Shop', 1, '2018-04-07 02:24:32'),
(6, 'Electric Shop', 0, '2018-04-07 02:24:39'),
(7, 'Beauty Shop', 1, '2018-04-07 02:24:52'),
(8, 'Groccery Shop', 1, '2018-04-07 02:25:11'),
(9, 'Elitronic Shop', 1, '2018-05-06 07:18:35');

-- --------------------------------------------------------

--
-- Table structure for table `shop_owners`
--

CREATE TABLE `shop_owners` (
  `id` bigint(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `gender` varchar(9) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `photo` varchar(200) NOT NULL DEFAULT 'default.png',
  `address` text,
  `username` varchar(30) NOT NULL,
  `password` varchar(250) NOT NULL,
  `is_verified` tinyint(4) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(30) NOT NULL DEFAULT 'Shop Owner'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_owners`
--

INSERT INTO `shop_owners` (`id`, `first_name`, `last_name`, `gender`, `email`, `phone`, `photo`, `address`, `username`, `password`, `is_verified`, `active`, `create_at`, `type`) VALUES
(2, 'HENG', 'Vongkol', 'Male', 'hengvongkol@gmail.com', '234234', 'default.png', NULL, 'vongkol', '$2y$10$7Weubt2dmwGIW7GUEdhsiuLiIozlcBl7l3Aqy3CSPv3KNGLlS8Mh2', 1, 1, '2018-08-13 03:07:55', 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `photo` varchar(80) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(4) DEFAULT '1',
  `order` tinyint(4) DEFAULT '0',
  `url` varchar(200) DEFAULT NULL,
  `short_description` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `name`, `photo`, `create_at`, `active`, `order`, `url`, `short_description`) VALUES
(1, 'test', '', '2018-05-07 02:13:07', 0, NULL, NULL, NULL),
(2, 'test', '', '2018-05-07 02:15:06', 0, NULL, NULL, NULL),
(3, 'test24', '', '2018-05-07 02:15:33', 0, NULL, NULL, NULL),
(4, 'test', '251097062678359.jpg', '2018-05-07 02:19:19', 0, 1, 'test', '1'),
(5, 'Iphone 8 Plus', 'slider_3.jpg', '2018-05-07 02:20:25', 1, 1, '#', '5.5 inch Retina HD Display | 12MP wide-angle cameras'),
(6, 'test', 'WWW.YIFY-TORRENTS.COM.jpg', '2018-05-07 02:28:18', 0, 1, '11111', 'test'),
(7, 'Red Mi Y1', 'slider_2.jpg', '2018-05-07 02:31:41', 1, 2, '#', 'LED Selfie-light | Fingerprint sensor | Dedicated microSD card slot Snapdragon 435 octa-core processor');

-- --------------------------------------------------------

--
-- Table structure for table `transfers_categories`
--

CREATE TABLE `transfers_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transfers_categories`
--

INSERT INTO `transfers_categories` (`id`, `name`, `active`, `create_at`) VALUES
(1, 'Phone Shop', 1, '2018-08-14 00:58:13'),
(2, 'Computer Shop', 1, '2018-08-14 00:58:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT 'default.png',
  `role_id` int(11) NOT NULL DEFAULT '1',
  `first_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `api_token` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `photo`, `role_id`, `first_name`, `last_name`, `gender`, `phone`, `active`, `api_token`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$Z61gGzui9GoXPxkzIX03COMK9PKgfs1yVrOx2Jf76DTGg48fq8REm', 'avfYwq278e05AViRLplpioPLKDZ0VUsGklCIbGBg1ZZKG26LI0JJGMzs36i3', '2017-05-27 22:35:52', '2017-05-27 22:35:52', 'vongkol-photo.jpg', 1, 'HENG', 'Vongkol', 'Male', NULL, 1, '5j1dPP09govoEL70bI63XofRHmlxKojbdv4E+QanCjY='),
(7, 'oudom', 'oudom@gmail.com', '$2y$10$Gqs0ypKqP48Wzp/B/NvciuD/ADNdng96bizFwSZUIkRPdUXUYtzVi', 'wR1UTmXm8zrF71WVkkoa7Pkj9GPhPGVfthoBOpToCAlzUxamlAlzaUkMOMyX', NULL, NULL, 'default.png', 5, 'PEN', 'Oudom', 'Male', '123', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business_transfers`
--
ALTER TABLE `business_transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_types`
--
ALTER TABLE `business_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_categories`
--
ALTER TABLE `company_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_histories`
--
ALTER TABLE `customer_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_categories`
--
ALTER TABLE `event_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_histories`
--
ALTER TABLE `event_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_options`
--
ALTER TABLE `menu_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_photos`
--
ALTER TABLE `product_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_categories`
--
ALTER TABLE `program_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review_categories`
--
ALTER TABLE `review_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scholarships`
--
ALTER TABLE `scholarships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scholarship_categories`
--
ALTER TABLE `scholarship_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_categories`
--
ALTER TABLE `school_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_programs`
--
ALTER TABLE `school_programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_categories`
--
ALTER TABLE `shop_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_owners`
--
ALTER TABLE `shop_owners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfers_categories`
--
ALTER TABLE `transfers_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business_transfers`
--
ALTER TABLE `business_transfers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `business_types`
--
ALTER TABLE `business_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `company_categories`
--
ALTER TABLE `company_categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer_histories`
--
ALTER TABLE `customer_histories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `event_categories`
--
ALTER TABLE `event_categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `event_histories`
--
ALTER TABLE `event_histories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menu_options`
--
ALTER TABLE `menu_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `product_photos`
--
ALTER TABLE `product_photos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `program_categories`
--
ALTER TABLE `program_categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `review_categories`
--
ALTER TABLE `review_categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `scholarships`
--
ALTER TABLE `scholarships`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scholarship_categories`
--
ALTER TABLE `scholarship_categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `school_categories`
--
ALTER TABLE `school_categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `school_programs`
--
ALTER TABLE `school_programs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shop_categories`
--
ALTER TABLE `shop_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `shop_owners`
--
ALTER TABLE `shop_owners`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transfers_categories`
--
ALTER TABLE `transfers_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
