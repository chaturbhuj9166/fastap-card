-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2025 at 06:12 PM
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
-- Database: `fastap`
--

-- --------------------------------------------------------

--
-- Table structure for table `achive`
--

CREATE TABLE `achive` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `phone`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '7300169798', 'admin@gmail.com', '2021-07-07 07:41:51', '4AvVlLh3o1V4M', NULL, '2021-07-04 07:42:04', '2021-07-20 09:58:12');

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `alternative_mobile` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `aadhar_front` varchar(255) NOT NULL,
  `aadhar_back` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `agent_code` varchar(255) NOT NULL,
  `commission` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE `blocks` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `text` longtext DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brand_logo`
--

CREATE TABLE `brand_logo` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `logo` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `logo_status` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categroy` longtext DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `childcategories`
--

CREATE TABLE `childcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `catagory_id` int(11) NOT NULL,
  `subcategroy_id` int(11) NOT NULL,
  `child_categroy` varchar(255) DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `text` longtext DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sub` varchar(255) NOT NULL,
  `msg` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `corporates`
--

CREATE TABLE `corporates` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cname` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `country_code` varchar(255) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `gstin` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `profession` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkdn` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `pinterest` varchar(255) DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `degree` varchar(255) DEFAULT NULL,
  `document` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `title1` text DEFAULT NULL,
  `title2` varchar(255) DEFAULT NULL,
  `title3` varchar(255) DEFAULT NULL,
  `title4` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `leadcount` bigint(20) DEFAULT 0,
  `google_id` varchar(250) DEFAULT NULL,
  `theme_color` int(11) DEFAULT 0,
  `banner` varchar(255) DEFAULT NULL,
  `themeprofile` int(11) DEFAULT 0,
  `permission` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1=access,0=block',
  `desig` varchar(255) DEFAULT NULL,
  `panel_status` int(11) NOT NULL DEFAULT 0 COMMENT '1=gold,0=normal',
  `animation` int(11) DEFAULT 0,
  `slug` varchar(255) DEFAULT NULL,
  `customer_url` varchar(255) DEFAULT NULL,
  UNIQUE KEY `customers_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `country_code`, `mobile`, `password`, `address`, `city`, `state`, `zip`, `company`, `gstin`, `status`, `age`, `profession`, `twitter`, `facebook`, `instagram`, `linkdn`, `youtube`, `pinterest`, `profile`, `degree`, `document`, `title1`, `title2`, `title3`, `title4`, `created_at`, `updated_at`, `leadcount`, `google_id`, `theme_color`, `banner`, `themeprofile`, `permission`, `desig`, `panel_status`, `animation`) VALUES
(2, 'Ashish', 'gts.hod@gmail.com', NULL, '8952929939', '$2y$10$odVZ2yMkhum8Rxz3fB1Gw.x.VMvlUUKYaHkeRh.PLECugrts8a3ua', NULL, 'Jaipur', 'Rajasthan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1688234823.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-02 01:02:45', '2025-09-19 16:57:41', 285, NULL, 0, NULL, 0, '1', NULL, 1, 0),
(10, 'Manu meena', 'Manu.me9731@gmail.com', NULL, '8890002345', '$2y$10$o95fcHipdUtiX1GcAmg1Iegt/35m0aX2dCfTUdLUWwcbj3e3rHK1a', NULL, 'Jaipur', 'Rajasthan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1690959062.jfif', NULL, NULL, 'Producer', NULL, NULL, NULL, '2023-08-01 19:11:57', '2025-03-11 12:56:22', 778, NULL, 1, NULL, 0, '1', NULL, 1, 0),
(12, NULL, NULL, NULL, '6376273344', '$2y$10$odVZ2yMkhum8Rxz3fB1Gw.x.VMvlUUKYaHkeRh.PLECugrts8a3ua', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-08 21:26:58', '2023-10-26 16:49:49', 0, NULL, 0, NULL, 0, '1', NULL, 2, 0),
(14, 'vikas maheshwari', 'vikashkabra1990@gmail.com', NULL, '9799338808', '$2y$10$4Dr7.HT1WVRSBWb93EuCmuXhxX/Tfb4s/YRdNDMQ.pnoOAwbJ6eoO', NULL, 'jaipur', 'rajasthan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1708913655.jpeg', NULL, '[\"uploads\\/document\\/doc1729594222480.pdf\"]', 'We\'ve Developed AI Based NFC Visiting Cards, which will show your Complete Business/Profession or Personal Details with just a Touch on your Cellphone. Revolutionize your Visiting Card with Artificial Intelligence.\r\nWe Offer a Wide Range of Digital NFC Cards for Your Resume and for your Business Details', NULL, NULL, NULL, '2023-08-12 22:13:27', '2025-10-11 05:26:37', 1356, NULL, 0, '', 1, '1', 'CEO(FASTAP)', 1, 1),
(16, 'BABLU VERMA', 'BABLU8824@GMAIL.COM', NULL, '8824340350', '$2y$10$odVZ2yMkhum8Rxz3fB1Gw.x.VMvlUUKYaHkeRh.PLECugrts8a3ua', NULL, 'jaipur', 'RAJASTHAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1692092048.jpeg', NULL, NULL, 'TEAM LEADER', NULL, NULL, NULL, '2023-08-15 15:09:34', '2025-05-03 08:23:55', 594, NULL, 0, NULL, 1, '1', NULL, 1, 0),
(17, 'KARAN SHARMA', 'karanshrm197@gmail.com', NULL, '8058834858', '$2y$10$8ZAXfnsPnQAU9/.9byCsje1Xbj8/PvC8rFM5dUSSppvf1FxQiucCa', NULL, 'JAIPUR', 'rajasthan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1692099111.jpeg', NULL, NULL, 'COMPANY OWNER privixo analaysis & soltions', NULL, NULL, NULL, '2023-08-15 16:14:09', '2025-08-11 07:14:02', 158, NULL, 0, NULL, 0, '1', NULL, 2, 0),
(19, 'SANDEEP DADHICH', 'business@fankaaronline.com', NULL, '7877376596', '$2y$10$odVZ2yMkhum8Rxz3fB1Gw.x.VMvlUUKYaHkeRh.PLECugrts8a3ua', NULL, 'jaipur', 'rajasthan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1692191521.jpg', NULL, NULL, 'MUSIC DIRECTOR', NULL, NULL, NULL, '2023-08-16 15:21:30', '2024-02-10 17:51:46', 128, NULL, 0, NULL, 0, '1', NULL, 2, 0),
(20, 'pramil medhtwal', 'parmilmedhtwal@gmail.com', NULL, '9251498140', '$2y$10$odVZ2yMkhum8Rxz3fB1Gw.x.VMvlUUKYaHkeRh.PLECugrts8a3ua', NULL, 'DEOLI', 'rajasthan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1692187810.jpeg', NULL, NULL, 'businessman', NULL, NULL, NULL, '2023-08-16 19:03:23', '2025-11-10 12:49:40', 49, NULL, 0, NULL, 0, '1', NULL, 1, 0),
(21, 'ANIL THAGRIYA', 'anilthagriya@gmail.com', NULL, '8239387774', '$2y$10$odVZ2yMkhum8Rxz3fB1Gw.x.VMvlUUKYaHkeRh.PLECugrts8a3ua', NULL, 'DEOLI', 'rajasthan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1692190177.jpeg', NULL, NULL, 'businessman', NULL, NULL, NULL, '2023-08-16 19:41:43', '2024-03-20 13:25:27', 86, NULL, 0, NULL, 0, '1', NULL, 2, 0),
(22, 'DALJINDER SANGHA', 'daljindersangha818@gmail.com', NULL, '9878230953', '$2y$10$odVZ2yMkhum8Rxz3fB1Gw.x.VMvlUUKYaHkeRh.PLECugrts8a3ua', NULL, 'CHANDIGARH', 'PUNJAB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1692270765.jpeg', NULL, NULL, 'SINGER', NULL, NULL, NULL, '2023-08-17 18:06:29', '2023-12-22 00:25:16', 18, NULL, 0, NULL, 0, '1', NULL, 2, 0),
(23, 'Test', 'test@gmail.com', NULL, '8875942974', '$2y$10$Dap4LjprTKWBnBWvUkefGeDuAj8NBHjc.G5bfaYHe.cIFRJSNx672', NULL, 'Jaipur', 'Raj', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1696511428.jpg', NULL, '[\"uploads/document/doc1695904414481.pdf\"]', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe assumenda nam, tenetur dolore suscipit, quo velit sed aliquid, inventore fugiat voluptates optio? Recusandae consequuntur dolorum veritatis quaerat tempore, possimus odit quidem, voluptate enim facilis a! Libero, provident harum quod cumque non voluptatem obcaecati qui minus? Molestiae quas consectetur, inventore sed, id itaque rem maxime distinctio velit culpa minus deserunt. Nam deserunt fugit voluptates vitae ad, itaque doloremque nemo nostrum. Voluptas, odit reiciendis ea doloribus numquam harum illo facilis, totam magnam placeat porro quia eaque, laudantium illum beatae rem consectetur consequatur quasi? Vel reiciendis quas corrupti qui ipsam quam ad laboriosam quasi optio in repellat, consequatur quidem animi. Voluptate nemo beatae soluta accusantium nesciunt, aliquam quidem architecto cum praesentium neque blanditiis nobis amet est dignissimos numquam cupiditate ut ratione magni cumque sint, harum, officiis quo? Atque nesciunt, temporibus unde veritatis voluptate iure obcaecati magni voluptates debitis sint eum quasi. Et, beatae, porro debitis alias eveniet at aperiam animi ducimus praesentium, voluptas tempore sed! Esse, tenetur! Enim mollitia nesciunt eveniet impedit iure rem obcaecati assumenda architecto neque vel minima corporis, illo facilis vitae possimus quod, culpa veniam animi est tempore velit atque odio, adipisci numquam? Minima nostrum beatae eligendi, neque amet dolorum!', NULL, NULL, NULL, '2023-08-18 14:08:51', '2024-02-25 02:28:09', 535, NULL, 0, NULL, 0, '1', NULL, 2, 0),
(24, 'CAPT. ARIHANT SINGH SHEKHAWAT', 'arihant.shekhawat02@gmail.com', NULL, '9680904243', '$2y$10$odVZ2yMkhum8Rxz3fB1Gw.x.VMvlUUKYaHkeRh.PLECugrts8a3ua', NULL, 'bundi', 'rajasthan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1692367010.jpeg', NULL, NULL, 'FOUNDER    Save Our Heritage Foundation', NULL, NULL, NULL, '2023-08-18 20:48:58', '2025-01-16 07:49:13', 203, NULL, 0, NULL, 0, '1', NULL, 1, 0),
(25, 'RAVINDRA SEVLIYA', 'RAVIRAJRPM@GMAIL.COM', NULL, '7737120360', '$2y$10$odVZ2yMkhum8Rxz3fB1Gw.x.VMvlUUKYaHkeRh.PLECugrts8a3ua', NULL, 'JAIPUR', 'rajasthan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1692434416.jpeg', NULL, NULL, 'SALSE EXECUTIVE    FASTAP (WWW.FASTAP.IN)', NULL, NULL, NULL, '2023-08-19 15:36:03', '2025-05-22 10:51:53', 73, NULL, 0, NULL, 0, '1', NULL, 2, 0),
(26, 'Deepti Vikas Maheshwari', 'diptisharma2625@gmail.com', NULL, '6378702756', '$2y$10$0JyN49s1y8MsxJlSCLXCXexH2xCuAXLamSARIRr.L9FasgAiEo6Xa', NULL, 'Deoli', 'Rajasthan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1692628021.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-21 15:30:50', '2025-11-03 11:18:46', 71, NULL, 0, NULL, 0, '1', NULL, 1, 0),
(28, 'SATPAL BOKOLIYA', 'satpalverma101@gmail.com', NULL, '8094311733', '$2y$10$bzMuMDY4BMfMKeXsE8XdDe3.zdDh6OUS.ZglWx9mwV148LCGpfTiK', NULL, 'JAIPUR', 'RAJASTHAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1692690240.jpeg', NULL, NULL, 'SALES  EXECUTIVE (FASTAP)', NULL, NULL, NULL, '2023-08-22 14:40:34', '2025-03-18 16:06:11', 80, NULL, 0, NULL, 0, '1', NULL, 2, 0),
(35, 'Om Meena', 'iamommeena@gmail.com', NULL, '9461333303', '$2y$10$s/OoU4LPJgB.SALyGGK0E.Kk9bjy5504Bz.3IVy8QG3G8qE0CWQ0C', NULL, 'Jaipur', 'Rajasthan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1692870129.png', NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-24 16:39:17', '2024-02-25 18:22:45', 21, NULL, 0, NULL, 0, '1', NULL, 2, 0),
(37, 'DHARMENDRA KUMAWAT', 'dharmesh.kumawat41@gmail.com', NULL, '9887984478', '$2y$10$z02IYkSLPkZlMB8sabgHRu4mneuiXuZs5KOUc4UVwUP.ia/6VPb12', NULL, 'JAIPUR', 'RAJASTHAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1693042594.jpg', NULL, NULL, 'Sales Executive', NULL, NULL, NULL, '2023-08-26 14:36:18', '2024-07-19 16:41:34', 40, NULL, 0, NULL, 0, '1', NULL, 2, 0),
(38, 'MUKESH LODHI RAJPUT', '17892MUKESH@GMAIL.COM', NULL, '8560904377', '$2y$10$uzHrHrR6rPSXHGnOUqd1PuLy.5PgRGhu4FJMcyg0q01t1ksOobbqK', NULL, 'Jaipur', 'Rajsthan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1693037309.jpg', NULL, NULL, 'Sales executive', NULL, NULL, NULL, '2023-08-26 15:01:08', '2024-04-02 20:58:51', 33, NULL, 0, NULL, 0, '0', NULL, 2, 0),
(39, 'Shaswat Shah', 'rmconsul97@gmail.com', NULL, '9950454439', '$2y$10$acqQUDlLkXKRfm11aXDwEuNu7NjBoDSVm2VkVNLozDtFJC9KI1vgK', NULL, 'Jaipur', 'Rajasthan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1694765808.jpeg', NULL, NULL, 'Mr', NULL, NULL, NULL, '2023-08-28 13:37:35', '2024-02-15 15:24:42', 45, NULL, 0, NULL, 0, '1', NULL, 2, 0),
(40, 'Tarun Bhati', 'tarunbhati1999@gmail.com', NULL, '9672943133', '$2y$10$TqQEx7lXJetk71G/oT6Z7uE0dPB9I7bZWPYl5KVfxG6q000b6d.6y', NULL, 'jaipur', 'RAJASTHAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1693226416.jpeg', NULL, NULL, 'TEAM LEADER (WWW.FASTAP.IN)', NULL, NULL, NULL, '2023-08-28 19:36:12', '2024-12-14 14:14:47', 29, NULL, 0, NULL, 0, '1', NULL, 2, 0),
(41, 'Naresh kumar', 'Snaresh0911@gmail.com', NULL, '9829099210', '$2y$10$I1akoCrsce9bMIIrtRpuDOdjqTcZ2vhWLOIY9ab4pcCkN.lYkdwuy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-02 11:35:58', '2023-10-26 16:49:15', 0, NULL, 0, NULL, 0, '1', NULL, 2, 0),
(42, 'Shaswat', 'Shyambabakripa@gmail.com', NULL, '9829054439', '$2y$10$JM1CM.Kg6tlkEM/pKu/Jfux/yCQfnnu/kAnH/SGutl6Hj7A1mh2PK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-02 17:49:24', '2023-12-25 15:55:14', 0, NULL, 0, NULL, 0, '0', NULL, 2, 0),
(44, 'Gopal meena', 'meenagopal8392@gmail.com', NULL, '8107687794', '$2y$10$BZPqRYLDrxk8odzNCTbs5uwgdK2C1yHqur7Vj4yBaOc18BpmOWJ8m', NULL, 'V/p. Kaseer th. Deoli district tonk', 'Rajasthan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Fastap business leader', NULL, NULL, NULL, '2023-09-05 14:26:33', '2023-10-26 16:49:12', 6, NULL, 0, NULL, 0, '1', NULL, 2, 0),
(45, 'VINOD YOGI', 'vinodlehan@gmail.com', NULL, '7850060724', '$2y$10$gXXHpsuHitd/AvMjErs8DeQd77UO3r/eLsM7mwuueJdfPwZtetexW', NULL, 'JAIPUR', 'RAJASTHAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1693901227.jpeg', NULL, NULL, 'SALES  EXECUTIVE (FASTAP)', NULL, NULL, NULL, '2023-09-05 15:04:42', '2024-11-16 00:46:37', 20, NULL, 0, NULL, 0, '0', NULL, 2, 0),
(46, 'Nikhil Nayak', 'nknnayak01@gmail.com', NULL, '9887707221', '$2y$10$GQhJPNaQ9xzPpNXEBm28Gey9RpUP2iHy.odVFisWGLcvMLPlPbtEe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-05 17:03:48', '2024-05-19 20:47:24', 14, NULL, 0, NULL, 0, '1', NULL, 1, 0),
(47, 'Nishtha sachdeva', 'nishthasachdeva1234@gmail.com', NULL, '9887563635', '$2y$10$95O/H/oDufrVHyn4GaM6iufubzE10P.85fDOLH1e0czv5ExJ27NoO', NULL, 'Jaipur', 'Rajasthan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1693986274.jpeg', NULL, NULL, 'Team leader (previxo)', NULL, NULL, NULL, '2023-09-06 14:42:52', '2023-11-03 12:58:00', 6, NULL, 0, NULL, 0, '0', NULL, 2, 0),
(48, 'Anjali Bhardwaj', 'baanjalijaipur@gmail.com', NULL, '7976286173', '$2y$10$1bJmPyV9puqX1wgp.IMz2.KBHBpEL7sWYF070iILQpVLeNo1avxT2', NULL, 'Jaipur', 'Rajasthan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1693986938.jpg', NULL, NULL, 'Team leader,(previxo)', NULL, NULL, NULL, '2023-09-06 14:51:53', '2024-06-03 11:20:50', 19, NULL, 0, NULL, 0, '0', NULL, 2, 0),
(49, 'Shivraj Singh Rajawat', 'shivaji1st@gmail.com', NULL, '6375522180', '$2y$10$l7r2AOrncrD5XMJbawiZLOB/0Jo8.6jTa06bJaIFUwAYPsCTdWJzq', NULL, 'Jaipur', 'Rajasthan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1693987341.jpg', NULL, NULL, 'Sales executive', NULL, NULL, NULL, '2023-09-06 14:58:51', '2023-10-26 16:49:04', 20, NULL, 0, NULL, 0, '1', NULL, 2, 0),
(51, 'fdsfdsfdsfds', 'xhackdroid@gmail.com', NULL, '7525944959', '$2y$10$5l8yIRM1woMacFOT8zN6gekcQuKwBKTXrwO2gYgr9TDlOoPM.hfgK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-06 16:01:14', '2023-12-25 15:54:49', 0, NULL, 0, NULL, 0, '0', NULL, 2, 0),
(52, 'Praveen kashyap', 'kashyaps.parveen@gmail.com', NULL, '8502983711', '$2y$10$XWePGCUjwNEdR6kJcpD6FutsOka8MjCqmku4Z6OQQyh9fJhK.4C7i', NULL, 'Jaipur', 'Rajasthan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1694516835.jpeg', NULL, NULL, 'CEO', NULL, NULL, NULL, '2023-09-06 18:58:11', '2023-11-01 17:30:44', 26, NULL, 0, NULL, 0, '1', NULL, 2, 0),
(53, 'Utkarsh Choudhary', 'chaudharyut.uc@gmail.com', NULL, '9001212414', '$2y$10$9oYPWhPslkiyvcGg0UQQ7.h7w1XpQPXWkJG4E9belYeznRuRhCRYe', NULL, 'Jaipur', 'Rajasthan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1694431817.jpeg', NULL, NULL, 'CO-FOUNDER', NULL, NULL, NULL, '2023-09-06 19:04:17', '2024-02-06 17:44:45', 66, NULL, 0, NULL, 0, '1', NULL, 2, 0),
(54, 'vijay kumar kumawat', 'junedmer7737@gmail.com', NULL, '7300205046', '$2y$10$9FVXOeI16pVuPD3.7y3n1uLS/FUf1RYTsmVgC0K4JjMl/ghR5XIyO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-06 19:14:07', '2023-10-26 16:48:55', 6, NULL, 0, NULL, 0, '1', NULL, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `description` longtext NOT NULL,
  `image` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `headings`
--

CREATE TABLE `headings` (
  `id` int(11) NOT NULL,
  `qual` varchar(255) DEFAULT NULL,
  `service` varchar(255) DEFAULT NULL,
  `thought` varchar(255) DEFAULT NULL,
  `personal` varchar(255) DEFAULT NULL,
  `prefessional` varchar(255) DEFAULT NULL,
  `videos` varchar(255) DEFAULT NULL,
  `prdoducts` varchar(255) DEFAULT NULL,
  `links` varchar(255) DEFAULT NULL,
  `pdf` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `blogs` varchar(255) DEFAULT NULL,
  `map` varchar(255) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `achiev` varchar(255) DEFAULT NULL,
  `client` varchar(255) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE `logo` (
  `id` int(11) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `uid` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `map`
--

CREATE TABLE `map` (
  `id` int(11) NOT NULL,
  `map` longtext DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) NOT NULL,
  `Message` longtext DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `mobile` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `myproducts`
--

CREATE TABLE `myproducts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `images` varchar(500) NOT NULL,
  `price` double NOT NULL,
  `sd` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `offer` longtext NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `order_status` text NOT NULL,
  `total_amount` varchar(255) DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `payment_status` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `merchantTransactionId` varchar(255) DEFAULT NULL,
  `transactionId` varchar(255) DEFAULT NULL,
  `coupon` varchar(250) DEFAULT NULL,
  `agent_code` varchar(255) DEFAULT NULL,
  `agent_commission` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_metas`
--

CREATE TABLE `order_metas` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `billing_first_name` varchar(255) DEFAULT NULL,
  `billing_last_name` varchar(255) DEFAULT NULL,
  `billing_company_name` varchar(255) DEFAULT NULL,
  `billing_address` varchar(255) DEFAULT NULL,
  `billing_city` varchar(255) DEFAULT NULL,
  `billing_country` varchar(255) DEFAULT NULL,
  `billing_email` varchar(255) DEFAULT NULL,
  `billing_phone` varchar(255) DEFAULT NULL,
  `shipping_first_name` varchar(255) DEFAULT NULL,
  `shipping_last_name` varchar(255) DEFAULT NULL,
  `shipping_company_name` varchar(255) DEFAULT NULL,
  `shipping_address` varchar(255) DEFAULT NULL,
  `shipping_city` varchar(255) DEFAULT NULL,
  `shipping_country` varchar(255) DEFAULT NULL,
  `shipping_email` varchar(255) DEFAULT NULL,
  `shipping_phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pincode` varchar(250) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `logo_status` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `commission` int(11) DEFAULT NULL,
  `agent_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pdf`
--

CREATE TABLE `pdf` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pdf` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE `portfolios` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `preorders`
--

CREATE TABLE `preorders` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `employee_code` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `card_type` varchar(255) NOT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `pro_multi_img` varchar(255) NOT NULL,
  `short_des` longtext NOT NULL,
  `long_des` longtext NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pricing__plans`
--

CREATE TABLE `pricing__plans` (
  `id` int(11) NOT NULL,
  `cname` varchar(255) DEFAULT NULL,
  `pro_single_img` longtext DEFAULT NULL,
  `pro_multi_img` longtext DEFAULT NULL,
  `Description1` longtext DEFAULT NULL,
  `Description2` longtext DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `catagory_id` int(11) DEFAULT NULL,
  `pro_name` varchar(255) NOT NULL,
  `commission` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `pro_img` longtext NOT NULL,
  `pro_multi_img` longtext NOT NULL,
  `pro_mrp` int(11) NOT NULL,
  `pro_price` int(11) NOT NULL,
  `pro_description` longtext DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_lead`
--

CREATE TABLE `product_lead` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `professional_photos`
--

CREATE TABLE `professional_photos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `professions`
--

CREATE TABLE `professions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `profession` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `iframe` longtext DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_menu`
--

CREATE TABLE `profile_menu` (
  `id` int(11) NOT NULL,
  `uid` bigint(20) DEFAULT NULL COMMENT 'Customer ID',
  `profile` int(11) DEFAULT 0,
  `quali` int(11) DEFAULT 0,
  `service` int(11) DEFAULT 0,
  `thought` int(11) DEFAULT 0,
  `personal` int(11) DEFAULT 0,
  `profess` int(11) DEFAULT 0,
  `videos` int(11) DEFAULT 0,
  `product` int(11) DEFAULT 0,
  `social_link` int(11) DEFAULT 0,
  `upload_file` int(11) DEFAULT 0,
  `client` int(11) DEFAULT 0,
  `block` int(11) DEFAULT 0,
  `google_map` int(11) DEFAULT 0,
  `download` int(11) DEFAULT 0,
  `animation` int(11) DEFAULT 0,
  `achievment` int(11) DEFAULT 0,
  `ou_client` int(11) DEFAULT 0,
  `menu_section` int(11) DEFAULT 1,
  `reservation_section` int(11) DEFAULT 1,
  `delivery_section` int(11) DEFAULT 1,
  `property_listings` int(11) DEFAULT 1,
  `showreel` int(11) DEFAULT 1,
  `team_section` int(11) DEFAULT 1,
  `pricing_section` int(11) DEFAULT 1,
  `booking_section` int(11) DEFAULT 1,
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qualifications`
--

CREATE TABLE `qualifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `qualifiaction` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `pinterest` varchar(255) DEFAULT NULL,
  `snapchat` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `skype` varchar(255) DEFAULT NULL,
  `google_review` varchar(255) DEFAULT NULL,
  `linkdin` varchar(255) DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `catagory_id` varchar(255) NOT NULL,
  `sub_categroy` longtext DEFAULT NULL,
  `image` longtext NOT NULL,
  `description` longtext DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscibe_channels`
--

CREATE TABLE `subscibe_channels` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thoughts`
--

CREATE TABLE `thoughts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `thought` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trackoreders`
--

CREATE TABLE `trackoreders` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `current_location` varchar(255) NOT NULL,
  `last_location` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `video_link` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `websettings`
--

CREATE TABLE `websettings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `companynames` varchar(255) NOT NULL,
  `home_banner_heading_1` varchar(255) DEFAULT NULL,
  `home_banner_heading_2` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `tagline` longtext NOT NULL,
  `logo` longtext NOT NULL,
  `favicon` longtext NOT NULL,
  `footerlogo` longtext NOT NULL,
  `address` longtext NOT NULL,
  `abouttitle` longtext NOT NULL,
  `Aboutimg` longtext NOT NULL,
  `veriety_of_pro` longtext NOT NULL,
  `testimonial_title` text NOT NULL,
  `Description` longtext NOT NULL,
  `facebook` longtext NOT NULL,
  `instagram` longtext NOT NULL,
  `twitter` longtext NOT NULL,
  `linkdin` longtext NOT NULL,
  `youtube` longtext NOT NULL,
  `pinterest` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `websettings`
--

INSERT INTO `websettings` (`id`, `companynames`, `home_banner_heading_1`, `home_banner_heading_2`, `email`, `mobile`, `tagline`, `logo`, `favicon`, `footerlogo`, `address`, `abouttitle`, `Aboutimg`, `veriety_of_pro`, `testimonial_title`, `Description`, `facebook`, `instagram`, `twitter`, `linkdin`, `youtube`, `pinterest`, `created_at`, `updated_at`) VALUES
(4, 'Fastap', 'Discover What’s Possible', 'NFC Integrated Cards & Gadgets', 'Support@fastap.in', '+919461644444', 'Nulla lacinia, eros vel fermentum consectetur, risus purus tempc, et iaculis odio dolor in ex.', '1688188312logo.png', '1688241876favicon.png', '1688188312footerlogo.png', 'Fastap Office, 508,5th floor the been,okay plus near Vivek Vihar metro station,new Sanganer road,sodala Jaipur 302019, Rajasthan.', 'LDWW exists at the intersection of creating and connecting. We understand an organization’s voice is key in building influence and boosting impact. It’s why we’re committed to crafting, amplifying and advocating the world’s strongest voices through targeted advertising, dynamic content, award-winning creative and strategic communications.', '[\"649fb5faeaf0b_1688188410.png\"]', 'As we are Leading NFC Technology in India, We have Variety of Products. These are Just Starting, Soon We are Going to Launch more than 100 Products.', 'See What People are Saying and Feeling About our Company, Products and Services. Get Ready for the Goosebumps Experience.', '<p>profilemeet.com is a Professional Business Card Ecommerce Platform. Here we will provide you a Great Innovation and Revolution for Visiting Cards, you will gonna Love it. We&#39;re dedicated to providing you the best of Business Cards for Individuals as well as for the Teams of the Companies, with a focus on dependability and Revolutionary Future. We&#39;re working to turn our passion for Business Card Ecommerce into a booming online website. We hope you enjoy our Business Card Ecommerce as much as we enjoy offering them to you.</p>\r\n\r\n<p>We honestly think making and it is so significant in this world to keep connections. There&#39;s nothing more regrettable than meeting a business association or new companion, neglecting to interface with them, and at no point ever hearing from them in the future.</p>\r\n\r\n<p>We see a future where everybody is associated, and Profile Meet is overcoming any barrier between in-person connections and online associations.</p>\r\n\r\n<p><br />\r\nA tremendous piece of our way of life is building feasible arrangements that help the climate. Profile Meet utilizes innovation rather than paper to associate experts, saving woods all over the planet So from now onwards, No more paper business cards, Just Profile Meet Smart Cards.</p>', 'Facebook#', 'Instagram#', 'Twitter#', 'Linkdin#', 'Youtube#', 'Pinterest#', '2021-07-25 03:52:19', '2023-08-31 12:21:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achive`
--
ALTER TABLE `achive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_logo`
--
ALTER TABLE `brand_logo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `childcategories`
--
ALTER TABLE `childcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `corporates`
--
ALTER TABLE `corporates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `headings`
--
ALTER TABLE `headings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `map`
--
ALTER TABLE `map`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `myproducts`
--
ALTER TABLE `myproducts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_metas`
--
ALTER TABLE `order_metas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pdf`
--
ALTER TABLE `pdf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preorders`
--
ALTER TABLE `preorders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pricing__plans`
--
ALTER TABLE `pricing__plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_lead`
--
ALTER TABLE `product_lead`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professional_photos`
--
ALTER TABLE `professional_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professions`
--
ALTER TABLE `professions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_menu`
--
ALTER TABLE `profile_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qualifications`
--
ALTER TABLE `qualifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscibe_channels`
--
ALTER TABLE `subscibe_channels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thoughts`
--
ALTER TABLE `thoughts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trackoreders`
--
ALTER TABLE `trackoreders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `websettings`
--
ALTER TABLE `websettings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achive`
--
ALTER TABLE `achive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blocks`
--
ALTER TABLE `blocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brand_logo`
--
ALTER TABLE `brand_logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `childcategories`
--
ALTER TABLE `childcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `corporates`
--
ALTER TABLE `corporates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1456;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `headings`
--
ALTER TABLE `headings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logo`
--
ALTER TABLE `logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `map`
--
ALTER TABLE `map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `myproducts`
--
ALTER TABLE `myproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_metas`
--
ALTER TABLE `order_metas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pdf`
--
ALTER TABLE `pdf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `preorders`
--
ALTER TABLE `preorders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pricing__plans`
--
ALTER TABLE `pricing__plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_lead`
--
ALTER TABLE `product_lead`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `professional_photos`
--
ALTER TABLE `professional_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `professions`
--
ALTER TABLE `professions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile_menu`
--
ALTER TABLE `profile_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qualifications`
--
ALTER TABLE `qualifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscibe_channels`
--
ALTER TABLE `subscibe_channels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thoughts`
--
ALTER TABLE `thoughts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trackoreders`
--
ALTER TABLE `trackoreders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `websettings`
--
ALTER TABLE `websettings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
