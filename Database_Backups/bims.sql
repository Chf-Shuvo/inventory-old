-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2020 at 02:19 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bims`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_name` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'Electronics', '2019-12-23 08:16:33', '2019-12-23 08:16:33'),
(2, 'Furniture', '2019-12-23 08:16:41', '2019-12-23 08:16:41'),
(3, 'Material', '2019-12-23 08:16:47', '2019-12-23 08:16:47'),
(4, 'Kitchen', '2019-12-23 08:17:01', '2019-12-23 08:17:01'),
(5, 'Stationary', '2019-12-23 08:17:14', '2019-12-23 08:17:14');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_07_19_200520_create_permission_tables', 2),
(4, '2019_12_21_080020_create_vendors_table', 3),
(5, '2019_12_22_161508_create_categories_table', 4),
(7, '2019_12_23_135000_create_products_table', 5),
(8, '2020_01_03_085728_create_storages_table', 6),
(9, '2020_01_03_102405_create_stocks_table', 7),
(10, '2020_02_10_084754_create_requisitions_table', 8),
(11, '2020_02_10_085133_create_rq_products_table', 8),
(12, '2020_02_10_085408_create_requisition__temps_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 2),
(1, 'App\\User', 4),
(2, 'App\\User', 1),
(2, 'App\\User', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(2, 'add content', 'web', '2019-07-20 03:26:40', '2019-07-20 03:26:40'),
(3, 'edit', 'web', '2019-07-20 03:26:40', '2020-02-10 00:28:50'),
(4, 'moderate', 'web', '2019-07-20 03:26:40', '2020-02-10 00:29:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `brand`, `color`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Jessika Mertz', '2', 'tPeTqWO96Fk', 'GzfdQtq5EpU', '338803', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(2, 'Jeanie Wehner', '2', 'oi9mf8VVf98', 'NNfaH6N76le', '309373', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(3, 'Cruz Cummerata', '3', '3tbQk9GulyB', 'ivg3fC5blDY', '567325', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(4, 'Baron Wolf', '2', 'QJ2O2wdRUPf', 'YkhXKy829Yb', '933631', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(5, 'Mustafa Lehner DDS', '3', 'LHqQ2gbpcY6', 'vdDOfCx7Mhg', '591408', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(6, 'Miss Roxane Carroll', '1', '65uneLGQTu6', 'xBaY6uHh4h6', '609849', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(7, 'Sheldon Dooley PhD', '5', 'vsL2inhMNOe', 'jszTgMVgOAm', '307514', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(8, 'Arvel Price', '3', '6behUaIzLwr', 'wh3GByaT9N4', '746388', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(9, 'Robb Waters DDS', '5', 'q7rB8emJJux', 'gghRz6fBF2W', '192466', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(10, 'Sherman Roberts', '4', 'wjfyQaztes2', 'naaMlsq1BRn', '239015', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(11, 'Prof. Tad Bins', '2', 'drni0bi8cRg', 'OlPr7Lg3Itj', '893296', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(12, 'Miss Ayana Glover MD', '4', 'kBYtDQmNCu0', 'lZH9bnapEba', '643452', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(13, 'Jay Stracke', '5', 'wrjVTOAAvjB', 'tsJckj54dVw', '131959', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(14, 'Ms. Daisy Crist', '2', 'GWNMWh3mChd', 'xWBBtapYFQn', '268420', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(15, 'Dr. Hermann Yundt', '4', 'NvicEZab2NZ', 'Jpig17yfUcQ', '296978', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(16, 'Cecile Wisoky IV', '4', 'ARLIAI8rkhT', 'JTApz4wUHob', '626673', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(17, 'Dalton Feeney', '4', 'QUiq4d4OHio', 'lK0wFIrmh5T', '522931', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(18, 'Elisha Collier', '5', 'wgwFG88diXa', 'Axa17V87pYY', '791718', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(19, 'Ms. Ofelia Bahringer', '4', 'sRY2DdNecPF', 'kuefgNzObBC', '274440', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(20, 'Selina O\'Reilly V', '3', 'ucbaYmaJapl', 'GKvhEizamzb', '362600', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(21, 'Rowena Hansen', '4', 'ZO2rmjIcpJm', 'Jf6rUz5NsQ0', '468547', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(22, 'Dr. Audie Ziemann', '4', 'jV7wM6PaVO5', 'sMds2BlXX1t', '630748', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(23, 'Mr. Taurean Graham Sr.', '2', 'nBfP6PEIqEc', 'hHXT2UmOQ9g', '528766', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(24, 'Prof. Rickey Schaden II', '2', 'tlU7gI0mXuN', 'k0DxMV6IiRh', '835326', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(25, 'Brennan Koepp', '1', 'CiTCgQvjv1q', 'Gw1LYcrAmxs', '467597', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(26, 'Roslyn Feil', '2', '6DqZlwxlhkx', 'SEb6VPd5Nb2', '714923', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(27, 'Jessy Predovic I', '2', 'f4aUDlUP1yl', '5fXAaqrj2v1', '393888', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(28, 'Zella Roberts', '2', 'lXRoWYCOGLa', 'PCxDPliu0UE', '934225', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(29, 'Miss Carmella McGlynn', '5', 'ndmDCOcuBgE', 'g7gd52NUhpn', '367633', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(30, 'Blair Haag', '1', 'YAuaWof0lBH', 'hsMpWVnYPo0', '947401', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(31, 'Kamryn Zboncak', '1', 'vShzANgdrbA', 'P6qGR4vsiIs', '330390', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(32, 'Prof. Fern Daniel', '3', '7PcivdgqFp7', 'nQUv7oFrJYE', '865558', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(33, 'Maya Orn', '1', 'UzOPzngxy3P', 'Omexr6G6L9k', '842835', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(34, 'Rigoberto Klein', '1', 'IambvtwfaKY', 'ImoHjzYhPFK', '827745', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(35, 'Elta Miller', '4', '02rGhCeHLSw', 'cj9agttv916', '538757', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(36, 'Asia Orn', '3', 'baYNPNFBamR', 'VmGV8fpFPg9', '821717', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(37, 'Sarah O\'Conner II', '3', 'r31kcMlhygU', 'MPjPO8B3B4o', '704818', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(38, 'Caterina Jaskolski', '4', 'xSJrX8O1Rwt', 'LYHcmgtBZ7o', '407941', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(39, 'Nichole Stamm', '1', 'UYt98t31dnQ', 'lbf8XkybWxE', '803937', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(40, 'Ms. Rebekah Runte DVM', '2', 'ghQdrUqgP3D', '06zXl7PV0Un', '809485', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(41, 'Osbaldo Goldner', '2', 'G9Hyz6VbxNr', 'H5qvkn3ePdp', '856522', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(42, 'Shakira Larkin', '2', '6FSrBhCB07G', 'OpssYaSVYHX', '204682', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(43, 'Dr. Claudine Monahan IV', '1', 'jtoJIkUZoct', 'YP9O6letJGa', '254162', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(44, 'Bette Reinger', '1', 'O1L9yYw6ypo', '8D5Ei3qjOOK', '933944', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(45, 'Benton Kihn', '1', 'bgQe0JwOowv', '3mm12BRdMqN', '268374', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(46, 'Tyler Dickinson', '3', 'NIfwA5FX3jM', 'uPYAPFhoMTj', '143881', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(47, 'Corbin Haley', '2', 'Z2bD5OGE021', 'WAcvVPMp6uJ', '388827', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(48, 'Earl Kreiger', '2', 'u2LMXDaM2F0', 'UqWVh62YGoV', '287811', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(49, 'Janis Collins', '5', 'PxdPdYBCxHQ', 'Xx3vedeRkNk', '566976', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(50, 'Prof. Junior Beer MD', '3', 'SY6NLuDCUJB', 'G5KrbKvzGA2', '796252', '2020-01-03 07:52:01', '2020-01-03 07:52:01'),
(51, 'Chafiullah', '4', 'FYrxQqxEzkm', 'Black', '20000', '2020-01-15 11:11:18', '2020-01-15 11:11:18');

-- --------------------------------------------------------

--
-- Table structure for table `requisitions`
--

CREATE TABLE `requisitions` (
  `id` int(10) UNSIGNED NOT NULL,
  `department` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `submitted_By` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `approvedBy` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_status` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivered_by` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requisition__temps`
--

CREATE TABLE `requisition__temps` (
  `id` int(10) UNSIGNED NOT NULL,
  `department` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `submittedBy` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_head` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_dpr` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_r` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_status` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivered_by` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requisition__temps`
--

INSERT INTO `requisition__temps` (`id`, `department`, `submittedBy`, `app_head`, `app_dpr`, `app_r`, `delivery_status`, `delivered_by`, `receiver`, `created_at`, `updated_at`) VALUES
(1, 'Jeremie Cronin', 'Dr. Opal Koch', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 03:45:18', '2020-02-10 03:45:18'),
(2, 'Lauriane Sanford', 'Ronaldo Orn', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 03:45:18', '2020-02-10 03:45:18'),
(3, 'Blaise Johns', 'Mr. Darius Marvin', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 03:45:18', '2020-02-10 03:45:18'),
(4, 'Jon Stracke', 'Mrs. Roxane Cummerata III', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 03:45:18', '2020-02-10 03:45:18'),
(5, 'Dr. Caesar West', 'Durward Kassulke', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 03:45:18', '2020-02-10 03:45:18'),
(6, 'Jenifer Homenick', 'Nils Tillman', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 03:45:18', '2020-02-10 03:45:18'),
(7, 'Jared Hayes Jr.', 'Kurtis Kuhic', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 03:45:18', '2020-02-10 03:45:18'),
(8, 'Meaghan Littel PhD', 'Prof. Norene Thiel I', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 03:45:18', '2020-02-10 03:45:18'),
(9, 'Juston King', 'Julius Wyman', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 03:45:18', '2020-02-10 03:45:18'),
(10, 'Oswald Hickle', 'Dr. Lois Emard III', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 03:45:18', '2020-02-10 03:45:18'),
(11, 'Dr. Tristin Schultz V', 'Ulices Jakubowski', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 04:51:23', '2020-02-10 04:51:23'),
(12, 'Kathlyn Goyette', 'Rosina Steuber', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 04:51:23', '2020-02-10 04:51:23'),
(13, 'Emely Rowe', 'Boris Huel', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 04:51:23', '2020-02-10 04:51:23'),
(14, 'Bobby Streich', 'Junius Satterfield', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 04:51:23', '2020-02-10 04:51:23'),
(15, 'Zoey Howe', 'Norwood Schamberger', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 04:51:23', '2020-02-10 04:51:23'),
(16, 'Emerald Johns', 'Mrs. Billie Strosin PhD', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 04:51:23', '2020-02-10 04:51:23'),
(17, 'Bulah Rippin', 'Jaylon Labadie', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 04:51:23', '2020-02-10 04:51:23'),
(18, 'Dr. Alexandra Thiel III', 'Frederique Kihn', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 04:51:23', '2020-02-10 04:51:23'),
(19, 'Mr. Devonte Erdman III', 'Prof. Jordan Gutkowski', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 04:51:23', '2020-02-10 04:51:23'),
(20, 'Orlando Hintz', 'Waldo Berge', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 04:51:23', '2020-02-10 04:51:23'),
(21, 'Mina Murray', 'Dr. Larissa Christiansen I', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 09:56:55', '2020-02-10 09:56:55'),
(22, 'Emmett Windler', 'Abdullah Gleichner', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 09:56:55', '2020-02-10 09:56:55'),
(23, 'Maya Runolfsdottir', 'Valerie Hamill', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 09:56:55', '2020-02-10 09:56:55'),
(24, 'Fredrick Bogisich', 'Kamren Adams', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 09:56:55', '2020-02-10 09:56:55'),
(25, 'Mr. Paris Treutel', 'Dario Runolfsdottir', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 09:56:55', '2020-02-10 09:56:55'),
(26, 'Maximus Marquardt', 'Duncan Hill', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 09:56:55', '2020-02-10 09:56:55'),
(27, 'Rosetta Ondricka', 'Ms. Billie Funk', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 09:56:55', '2020-02-10 09:56:55'),
(28, 'Maryam Gleason IV', 'Prof. Fernando Nienow', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 09:56:55', '2020-02-10 09:56:55'),
(29, 'Rosella Leffler', 'Miss Eleonore Wehner', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 09:56:55', '2020-02-10 09:56:55'),
(30, 'Freeman Harvey', 'Augustine Hyatt', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10 09:56:55', '2020-02-10 09:56:55'),
(31, 'CSE', 'Chafiullah Shuvo', '0', NULL, NULL, NULL, NULL, NULL, '2020-02-10 13:04:56', '2020-02-10 13:04:56'),
(32, 'CSE', 'Chafiullah Shuvo', '0', NULL, NULL, NULL, NULL, NULL, '2020-02-10 13:09:32', '2020-02-10 13:09:32'),
(33, 'CSE', 'Chafiullah Shuvo', '0', NULL, NULL, NULL, NULL, NULL, '2020-02-10 13:09:48', '2020-02-10 13:09:48'),
(34, 'EEE', 'Chafiullah Shuvo', '1', '0', '0', '0', NULL, NULL, '2020-02-10 13:11:20', '2020-02-12 12:57:02'),
(36, 'CSE', 'Chafiullah Shuvo', '1', '0', '0', '0', NULL, NULL, '2020-02-12 13:02:51', '2020-02-12 13:03:14');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super-admin', 'web', '2019-07-20 03:26:40', '2019-07-20 03:26:40'),
(2, 'admin', 'web', '2019-07-20 03:26:40', '2019-07-20 03:26:40'),
(3, 'editor', 'web', '2019-07-20 03:26:40', '2019-07-20 03:26:40'),
(4, 'moderator', 'web', '2019-07-20 03:26:40', '2019-07-20 03:26:40');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rq_products`
--

CREATE TABLE `rq_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `requisition_id` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rq_products`
--

INSERT INTO `rq_products` (`id`, `requisition_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, '33', '51', '1', '2020-02-10 13:09:48', '2020-02-10 13:09:48'),
(2, '33', '1', '2', '2020-02-10 13:09:48', '2020-02-10 13:09:48'),
(3, '33', '2', '3', '2020-02-10 13:09:48', '2020-02-10 13:09:48'),
(4, '34', '1', '1', '2020-02-10 13:11:20', '2020-02-10 13:11:20'),
(5, '34', '2', '2', '2020-02-10 13:11:20', '2020-02-10 13:11:20'),
(10, '34', '51', '12', '2020-02-12 12:04:47', '2020-02-12 12:04:47'),
(11, '34', '14', '1', '2020-02-12 12:04:47', '2020-02-12 12:04:47'),
(15, '34', '8', '1', '2020-02-12 12:45:41', '2020-02-12 12:45:41'),
(16, '36', '50', '1', '2020-02-12 13:02:51', '2020-02-12 13:02:51'),
(17, '36', '49', '2', '2020-02-12 13:02:51', '2020-02-12 13:02:51'),
(18, '36', '48', '3', '2020-02-12 13:02:51', '2020-02-12 13:02:51');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `product` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `storage` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qrcode` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `category`, `product`, `vendor`, `quantity`, `price`, `date`, `storage`, `note`, `qrcode`, `created_at`, `updated_at`) VALUES
(1, '3', '42', '8', '58', '2', '12 Sep 2019', '9', 'wS9VXDgKO9i6VQYAzwPrW2xuFRLgPNbJqev4q9Pv1uNdoTqmGJn62Xl1w9NkUVWbGfo6odgDZ8RFt2qVrdPWNLXXQdC5Kupx526p', NULL, '2020-01-04 10:45:03', '2020-01-04 10:45:03'),
(2, '3', '16', '23', '14', '25', '12 Sep 2019', '10', '4ELZDwNq3pPvAXnDFhr1QtNFJrRwOohb7dohxzCfTgxxxRoszbEzPW3KUULffAGxKrpqMXHYFpeTXehO90Btv9yqOISe5ml8G3TQ', NULL, '2020-01-04 10:45:03', '2020-01-04 10:45:03'),
(3, '2', '46', '8', '40', '94', '12 Sep 2019', '7', 'uIiLkqA56B8CtGAgtJMhBCd6c2fnrFrKAtIYw49oPg8kuqfjZMaGuHVh29h0p2AylzkMGnrunOufrl7I34JZjake1WbSZaXC3LEb', NULL, '2020-01-04 10:45:03', '2020-01-04 10:45:03'),
(4, '2', '29', '17', '4', '38', '12 Sep 2019', '2', 'Y91fVnDshm8U5mRzRqasFnN8XoK0BWNF7tas3tjauwMgDwNNTQz4kz64q4quGZuiIb3EZzRCTCI9Dn2Yh8d5VcMSSxHm1uYn1fUh', NULL, '2020-01-04 10:45:03', '2020-01-04 10:45:03'),
(5, '1', '16', '16', '95', '37', '12 Sep 2019', '9', 'n9INht3ZhzDZuiTSaMBTgqsIaO33BYb106JawWT7m0mUWZ2p5doTpSF9z1y9z0qwjCULeVhdtxn0xUScCnubFwKRVw2yaICSeErX', NULL, '2020-01-04 10:45:03', '2020-01-04 10:45:03'),
(6, '4', '24', '45', '94', '14', '12 Sep 2019', '2', '5rP9nEvzkBaOIgnFZk6wT5OSnnP4j3chcltiCb1hXvefd7oaLsIEjZG4IcfhY2ABqF0Mgi0AwL0apHTN4o7HddExFCJY96JhK9hy', NULL, '2020-01-04 10:45:03', '2020-01-04 10:45:03'),
(7, '4', '23', '5', '94', '76', '12 Sep 2019', '9', '4Cq53Njo8BOHmqCwKf1peMJYBnH82Qbs5hWUvUwWWwlAQURXfJqy0nNdxf3yEAnMCwgzIRECMtUSaf7S3nOwV6aBMikX3ImDlI2P', NULL, '2020-01-04 10:45:03', '2020-01-04 10:45:03'),
(8, '2', '45', '3', '14', '44', '12 Sep 2019', '9', '2ZxlRs2aJML4reLs5oGzoOkuhGv8SMMWpUm9VmUicYNe8few9KOxXnHlTCmCtXLdTOwl4pg9PmKcKV57JipR286tbLeuvnN8mA3k', NULL, '2020-01-04 10:45:03', '2020-01-04 10:45:03'),
(9, '1', '25', '49', '48', '41', '12 Sep 2019', '5', 'yqTX3GWL5WMzoKIj6HHIwFRfpRkyvjttNNjOwrHfz0c6z2eBibp1zhFX9w16q05cBQjnFDOwd0qdZutpXZjJM3OxjZPqBGNOy4c5', NULL, '2020-01-04 10:45:03', '2020-01-04 10:45:03'),
(10, '3', '14', '29', '13', '83', '12 Sep 2019', '8', 'm2Hjb6uW82HDzMTIOHIckgNSiuoF5kyAoXYFK4w56cBp23AoaDjVq2v018RVlw0aI5xcd7SbRxSse8uBx0ooa6M8xVBioAxxvqed', NULL, '2020-01-04 10:45:03', '2020-01-04 10:45:03'),
(11, '1', '12', '22', '82', '37', '12 Sep 2019', '6', 'a0cCgMYDnZHtzKKTpOkP3EWvUwVKQD10XYqIQieCYeliaLjOQV2rnFHVJzun19e4aW0x2zKRkAi3GjqaWn8UDyIROl5yOfa7M3H3', NULL, '2020-01-04 10:45:03', '2020-01-04 10:45:03'),
(12, '5', '25', '21', '67', '50', '12 Sep 2019', '7', 'hkxuvVaFLxeSSDyIw9lFqJk2N0NmmFNdDiMQVVxnkgYPKHo4SQAQrfvfrzrRLO8en15UMo7ZbQT9RdEgei56UIGQ16SHw1TFPOgg', NULL, '2020-01-04 10:45:03', '2020-01-04 10:45:03'),
(13, '4', '36', '40', '5', '74', '12 Sep 2019', '4', 'F5XPyvcdTkp45PSLZNbnI8NAqdgrWnJifsg9gZ2ltHpvc8QDlWKi4u0PalyNoSkCUClYJwyvz1gOqW219X4ooE3jgJUGqg0P10XW', NULL, '2020-01-04 10:45:03', '2020-01-04 10:45:03'),
(14, '2', '27', '34', '27', '55', '12 Sep 2019', '10', 'cRMwKysAwMyosiez4Gyuu7YqVhNS4vf6qGPjV43TOvIfVoSi2O4aM5ofNrypy8HXetE0eSmvZU1eqeHLe1nNGKnG9nCCJFMFp1nW', NULL, '2020-01-04 10:45:03', '2020-01-04 10:45:03'),
(15, '1', '46', '13', '66', '39', '12 Sep 2019', '5', 'wLQ77yAXmyA7vBTUNHpDO9AVQbzpwskcVhQMYc1ayNIY4Yp9IULDoSMno2MDz6NUFK6iGZ4H1nWYTTQecLEgfbVxxgAKg4Zmt41e', NULL, '2020-01-04 10:45:03', '2020-01-04 10:45:03'),
(16, '1', '2', '23', '28', '21', '12 Sep 2019', '4', 'olh8I2U7jpjdrErNi08QspOT6l0uUt1Kl0kJVewKkwdpIkCh0wTIeNdvcjiERcBbOMe0SUqV2zjV2WjWCK137P7m69BgkXlrAYxr', NULL, '2020-01-04 10:45:03', '2020-01-04 10:45:03'),
(17, '2', '27', '27', '22', '66', '12 Sep 2019', '6', 'oKu7YLflOBUIZxg4pLbUKiAqW8XjeXfuFxhgB6b85jte61NgYMKn7fBW1L1LowZsgK0hgcqZvRYLqJXCb0b4hGXBT1Qlg4GGHpzt', NULL, '2020-01-04 10:45:03', '2020-01-04 10:45:03'),
(18, '4', '13', '43', '89', '33', '12 Sep 2019', '9', '2ceZgL1aCcGR0WptwR38Sv8wGeiLFxi5CUK4z3uCTtW2mjyZPllByqJDDdVvhAFeoXAqJjzaNmVI9YNttOb7W5CTLOhNmeMmuSOg', NULL, '2020-01-04 10:45:03', '2020-01-04 10:45:03'),
(19, '1', '36', '8', '96', '93', '12 Sep 2019', '8', 'MesUxAj5Qc4ZkfaALFfWpKHkxrDWFqFmwjV8NvD6fTUDg1pq9n03IMXr14AEE6bhpoNOrj2EJ2uHAT3UKNruXwZ6EGyScbxKjPxx', NULL, '2020-01-04 10:45:03', '2020-01-04 10:45:03'),
(20, '3', '30', '39', '15', '5', '12 Sep 2019', '5', 'hMTbIJEwhxbeZbvwec2au9FFL9814SKmNsk2C3Itor1PXEuecMSWcefydMj0FXMXsxvUhIuS0DBDXzmZ7fSNvIPWTBjQIG7QisMv', NULL, '2020-01-04 10:45:03', '2020-01-04 10:45:03'),
(21, '5', '31', '3', '55', '10', '12 Sep 2019', '10', 'WZSvWpnlgHRKlkMafPr0OauCXJOSM3lGMQcEw1Cy4r8P8SAnsrY6XynTPpaHI1Ide0HOs6IVH9WFIXKvQdcQm8cLutPok6IB4olf', NULL, '2020-01-04 10:45:03', '2020-01-04 10:45:03'),
(22, '3', '25', '21', '59', '41', '12 Sep 2019', '8', 'W6wqj78UVPbaoAL9Je783j8zRE5jOk8WyNGgpeeqEbCIr97k69K7EJwtEJO7vI47aYM9a4RAbYeXbyjRfFW07DaSbMxaxR01d2e9', NULL, '2020-01-04 10:45:03', '2020-01-04 10:45:03'),
(23, '4', '39', '24', '42', '57', '12 Sep 2019', '5', 'Nqf3nRtwLMsL4HwAICmUNbBZCja2oUdBIOD1W6mZpiaMpgDHjaNEnCnGsq2uiZVA8eANhaNxn7mIv7Jq8qc8c2oGsSLSw8C1Ole2', NULL, '2020-01-04 10:45:03', '2020-01-04 10:45:03'),
(24, '3', '48', '28', '23', '8', '12 Sep 2019', '1', '4tHF8XR5Rvm239MubfCAR81uHPvRS2c2anJZNBkGiCAPcPx6Yp0SRZPWhaOQkM2EIAQIwnDrOHhx9ydKOd05wsWb8XIk9v8dBgco', NULL, '2020-01-04 10:45:03', '2020-01-04 10:45:03'),
(25, '4', '39', '29', '6', '43', '12 Sep 2019', '9', 'IEWPqBDJl55OxIjgsdRRYdm6864w2kkfBnx7L1HgfnFxLE9RSdM9IYD8cM4f9WWnb8CZ9nM4o2PzZiNLnst8Bf53QPYNv0JPREUR', NULL, '2020-01-04 10:45:03', '2020-01-04 10:45:03'),
(26, '1', '33', '26', '36', '31', '12 Sep 2019', '8', '6cicOWTRZNtLoRyso1uhe6Pfv4P17MertvuufTEHGSCFC0xuVZIVE6qFmRji2cjtWcGGAPNo6X2zC4F5ltuYB42p48xibsZpLrMS', NULL, '2020-01-04 10:45:03', '2020-01-04 10:45:03'),
(27, '3', '44', '5', '12', '39', '12 Sep 2019', '5', 'Ir2chuqx9oqYzbBBLCiT727pAHz6v0Mn1nOn1MreVvVndsD1mYlqZSWOsLJd6Os2iRZP12RTfpbz0U235pVNgWiKt59homRswzIO', NULL, '2020-01-04 10:45:03', '2020-01-04 10:45:03'),
(28, '2', '37', '1', '81', '25', '12 Sep 2019', '6', '7sRkePEN7peJ6CZKjht23gAAasGEGhNrxW1dfZG94fTOj0qeeGK32wGKQgxU5KpaYeul2MJEKoxNZVSfTmYl5gnh3SxFDKvGW1in', NULL, '2020-01-04 10:45:03', '2020-01-04 10:45:03'),
(31, '5', '2', '13', '100', '1', '12 Sep 2019', '10', '5gf28x2H0JbQwLbrGoU7sPV96GyYG3UDjcfwzcOiNeMfRoz9lBjpeJZHzAMjmBQPsDhKDTF50omDdiUDqOl6oR0zuWRqme0boyF4', NULL, '2020-01-04 10:45:04', '2020-01-04 10:45:04'),
(32, '5', '26', '37', '55', '14', '12 Sep 2019', '5', 'oM27SduKFuemAm9iV4hSJHRJ8gbCG0d3cCOrZKDvOyDarDLFxkRPB96wi4bB13FbZPT84fqw7XNmBvIInE9xZ6yjwx1vLhXro0wN', NULL, '2020-01-04 10:45:04', '2020-01-04 10:45:04'),
(33, '3', '4', '33', '31', '49', '12 Sep 2019', '8', 'T6WsaaOPjwX2vxSdOhKv1B7NXicMgb4xgfMHgPwmxjVljMlKkMZVUrLZfNomxOpiv7EmCZQZaw4b81BcMBRhXwuutEYbLibZe2Or', NULL, '2020-01-04 10:45:04', '2020-01-04 10:45:04'),
(34, '1', '38', '7', '38', '87', '12 Sep 2019', '10', 'Z6FSIOa0z5yFbykORF6BMtZJa8gId4iPnwcnyCxge1gePVUnn3doxhTvh069nDIjoAdzBePSQ1R6h0FKFJ8xQYdkT1AxfYknkIYm', NULL, '2020-01-04 10:45:04', '2020-01-04 10:45:04'),
(35, '2', '10', '28', '36', '69', '12 Sep 2019', '8', 'MY5Vor2wpyMlI1KbDntqyppnIWvPfKxHmjtuKYpVFJZ7ToFqFojOkfrfysQ8w5mcbbc1O1HybwZLn5Yy7PRWLucL5WUB691eBjyq', NULL, '2020-01-04 10:45:04', '2020-01-04 10:45:04'),
(36, '1', '1', '43', '7', '99', '12 Sep 2019', '9', 'JWz6DRHDjk8cXYNAxqIY5DZhK66aMOoJqCSbBhpZBMoI5qrPYGHEnECQl4zUtzPQyQ6OKpovWsOjUuPcKNpMTGen1gG3j7lmD1JN', NULL, '2020-01-04 10:45:04', '2020-01-04 10:45:04'),
(37, '2', '23', '49', '93', '26', '12 Sep 2019', '6', 'BCP4twPtYFJowXa8wBEr5pw6o6iFYToS6HBJxaGgo0GMGxytj0vK14rVibp11X8YVaZBItKUPm467jvEI0eKxIXgyVd7KL59SOMJ', NULL, '2020-01-04 10:45:04', '2020-01-04 10:45:04'),
(38, '1', '46', '46', '46', '13', '12 Sep 2019', '4', 'B2pkEHuY1IL2EW0fPvlGU8wvgjj6dup9nMJQdTmN9YHRhU9Q0U33mHamAIN9RZwTpIGJJhKQvZtN4aUVIIS6kEnAVqvsPt9TACul', NULL, '2020-01-04 10:45:04', '2020-01-04 10:45:04'),
(39, '2', '8', '2', '40', '95', '12 Sep 2019', '9', 'rdV4myZjThucDWJEBGvDo0IGvXt5VRJ0V6FSLmidGfHUcfkfuRWteU0Nwv7WBrmqGkZzrlFoqBle24bkNOGFScGYmLSP625Jq1ga', NULL, '2020-01-04 10:45:04', '2020-01-04 10:45:04'),
(40, '1', '14', '13', '13', '16', '12 Sep 2019', '10', 'aj8WorMkSJBHgzjkqLHJEKOG8Y7UD28DE1ul5GBzS4dq2Tgkbpwsd0Fwz0cGrqs4Tjdz5SFjCqIqcTk2dUl4s06VdGfQSjprmaan', NULL, '2020-01-04 10:45:04', '2020-01-04 10:45:04'),
(41, '3', '24', '40', '72', '73', '12 Sep 2019', '4', 'zFRgplKBH5vcOtQbsrGbVL77Hs3LPXdADyDukzfivGwCCQqJnhf2fBufHqfrjZWpgfSizpQ2IXdKx75FciTabVBFIhnwjo4VPDu6', NULL, '2020-01-04 10:45:04', '2020-01-04 10:45:04'),
(42, '5', '24', '12', '70', '95', '12 Sep 2019', '9', 'kDT5KGncKlzsBs2CnsyY9T3eXMDMm4nymSeBPPGD0NGBBTe5VBLjQh3taIGUl9gIxqy2d56H86lwO2FEDYdZSaKtzdJLON1GefTR', NULL, '2020-01-04 10:45:04', '2020-01-04 10:45:04'),
(43, '3', '5', '38', '78', '63', '12 Sep 2019', '10', '9Ah5wPh1S6RPB1H3FuE4UDhvszVIvTUawJiKYBMS5FCrjjI20mgZLH7GT2bnZLoBwWhFFfRBfXNWEoBtiH2zHNmPrUc0Ez8uXYLY', NULL, '2020-01-04 10:45:04', '2020-01-04 10:45:04'),
(44, '5', '44', '32', '29', '45', '12 Sep 2019', '3', 'WRpwBwEhHVrZK4PXU5jK8Yx0uod2jPmx5Z0Jf0jZfMox7VswPQoHjnVKoeeltIQ4E6LfR70t0K2flldtLn7BMbhGVM0YrKOzeuEs', NULL, '2020-01-04 10:45:04', '2020-01-04 10:45:04'),
(45, '2', '10', '9', '3', '86', '12 Sep 2019', '6', 'rgo9W3ndZ1etxSFBDdQqkdHnA1yv0Yw5F394lv9DFlxqf8ocSgCawZ7hQqVRrYoRqoDC3anQc3CxgyHwRFcnzeaUhtEgGhK3D1tF', NULL, '2020-01-04 10:45:04', '2020-01-04 10:45:04'),
(46, '5', '27', '25', '54', '83', '12 Sep 2019', '8', 'p4gvTnQY9Nz13tjInPXdNpsER3oVV7uNAotQgN2x01LFcymKYI74MylnB8gi7LLBgVmY9703Rin1s4VR7b4UiOrLMsrKFGJoDSHO', NULL, '2020-01-04 10:45:04', '2020-01-04 10:45:04'),
(47, '2', '8', '23', '57', '24', '12 Sep 2019', '2', 'IhuH7smG5YWguYBolAVnusgjocOAKVsGCCNDXWvmxAdhVIhsF9eMoczoWxEZqddQrTyD3gyGvEAdyVRq05LsgB3qcnBZ7NjWNG7k', NULL, '2020-01-04 10:45:04', '2020-01-04 10:45:04'),
(48, '3', '35', '10', '90', '86', '12 Sep 2019', '9', 'rOFZ6AiOPxonGq5XdNp1sbBPWYzCP2fdmTPzzPMqVlRbpMh8jZrc2CX7UIzigOkDCF4AGl4b9mM6Og77glFyIgCYDfMzF7ScymWK', NULL, '2020-01-04 10:45:04', '2020-01-04 10:45:04'),
(49, '3', '17', '45', '4', '17', '12 Sep 2019', '5', 'KtLoVpwGFDFCEVOON1EEdoEHCUCQAfnHKNYaOKlDcIeyi3QSJda77HvRaoSGc7YpwIqahAQi4KJiqBhcHdPuqNMT4RYg1ZBqAYFt', NULL, '2020-01-04 10:45:04', '2020-01-04 10:45:04'),
(50, '1', '43', '48', '17', '43', '12 Sep 2019', '1', 'Kk6ynIcG1IUFJmXUmo1IXGtzRG66a2Ma658qwmtw3i5RH6XlFnA4WPDniKXaSKSwEerYLhQoRYWkdrAxhiNb5BzOzSks27f9m7RF', NULL, '2020-01-04 10:45:04', '2020-01-04 10:45:04'),
(54, '4', '12', '2', '100', '643452', '15 Jan 2020', '1', 'new1', 'QRcodes/img-1579108713.png', '2020-01-15 11:18:33', '2020-01-15 11:18:33'),
(55, '4', '12', '2', '10', '643452', '12 Feb 2020', '1', 'rtrt', 'QRcodes/img-1581309403.png', '2020-02-09 22:36:43', '2020-02-09 22:36:43');

-- --------------------------------------------------------

--
-- Table structure for table `storages`
--

CREATE TABLE `storages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_category` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `storages`
--

INSERT INTO `storages` (`id`, `name`, `location`, `product_category`, `created_at`, `updated_at`) VALUES
(1, 'admin1', 'admin', '4', '2020-01-03 03:07:49', '2020-01-03 03:07:49'),
(2, 'admin3', 'canteen', '5', '2020-01-03 03:07:49', '2020-01-03 03:07:49'),
(3, 'admin2', 'admin', '5', '2020-01-03 03:07:49', '2020-01-03 03:07:49'),
(4, 'admin1', 'canteen', '3', '2020-01-03 03:07:49', '2020-01-03 03:07:49'),
(5, 'admin2', 'canteen', '2', '2020-01-03 03:07:49', '2020-01-03 03:07:49'),
(6, 'admin1', 'admin', '5', '2020-01-03 03:07:49', '2020-01-03 03:07:49'),
(7, 'admin3', 'admin', '2', '2020-01-03 03:07:49', '2020-01-03 03:07:49'),
(8, 'admin3', 'admin', '3', '2020-01-03 03:07:49', '2020-01-03 03:07:49'),
(9, 'admin3', 'canteen', '4', '2020-01-03 03:07:49', '2020-01-03 03:07:49'),
(10, 'admin3', 'ict', '4', '2020-01-03 03:07:49', '2020-01-03 03:07:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_raw` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `type`, `status`, `password`, `password_raw`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Chafiullah Shuvo', 'shuvo.sam2012@gmail.com', NULL, 'super-admin', 'active', '$2y$10$ROp3jE/cDzIRvAq4CYhCtOF.5blNi2sigB0go6SmgooP1D353N.Je', 'chfshuvo', 'dAiSwvAqNwW86sSucYG3NPz06eerLYNl3b8MreKI9zzo61KQgquBdgbDcAyF', '2019-12-21 00:37:09', '2019-12-21 00:37:09'),
(5, 'Solaiman', 'solaiman@baiust.edu.bd', NULL, 'admin', 'active', '$2y$10$gjgyGeWjpFkiD7ztyyKMzOlkaV52kz1NlQ20FVlgfG1wukbJqNssK', 'solaiman123456', 'WQ8o9TC6E7rzvuOvUB8TKOGsSj2YzZ7tbLpWoyqypF0NYgbt8k873Y8Xb48q', '2019-12-22 08:35:56', '2019-12-22 08:35:56');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person_phone` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `email`, `contact_person`, `contact_person_phone`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Dr. Ubaldo Hills', 'heather.padberg@example.net', 'Darien Baumbach IV', '4Wu8FRI1zXm', 'aiRKotnSRxS', 'Yj2Ayu6eOok', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(2, 'Ida Kirlin', 'charris@example.org', 'Cesar Block', '982Bu5GuA62', 'dcXSM5dw5oD', 'axr1HxGuR0L', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(3, 'Gerardo Frami', 'howe.janiya@example.net', 'Prof. Lionel Donnelly Sr.', 'uVhJwTaOlIY', 'j9geTYTjw9t', 'rSuj3RgY7mq', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(4, 'Mose Nicolas', 'earlene31@example.org', 'Sylvester Nienow', 'ySr046JEgiM', '68Bu9zIui9L', 'AjaqFuydIhL', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(5, 'Prof. Gloria Feeney II', 'gordon56@example.net', 'Prof. Eduardo Nader MD', 'jZSccsruEGz', 'QKs6eOVxb5Z', 'qmfZtalZTPm', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(6, 'Jerrell Volkman', 'stephania.bosco@example.net', 'Corrine Greenfelder', 'BJeartU6EIq', 'vSsARih3cVU', 'tkR986u3hQP', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(7, 'Zoe Collins V', 'marielle.beier@example.com', 'Amara Schaden', 'bhIrmUaSHOL', 'lHEjqA7dJkv', '6O0eRHaljc3', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(8, 'Mrs. Gertrude Swift', 'vheaney@example.com', 'Shanie Trantow', 'h1dfOUrmNtc', '6s9ceMSutle', '1NZfNRTxzCY', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(9, 'Florine Bode', 'jena.abbott@example.com', 'Nolan Bednar', 'w3EcxtiB6Wk', 'AN7DXthKCAj', 'Mi0mEUEBEPk', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(10, 'Sam Bartoletti', 'jessyca50@example.com', 'Ms. Missouri Wolf MD', 'SVGLpZQwONm', 'WLUz0wkU5UC', 'KaFlr6qOd15', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(11, 'Spencer Robel', 'zhermann@example.net', 'Roslyn Lockman', 'IRi20wTZQnU', 'tOv4aymvvzG', 'Akzp3AytPQK', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(12, 'Dr. Margret O\'Hara', 'baby01@example.net', 'Roberto Gleason', 'A5mwgJN56x3', 'UoLCPsAyVj5', 'V6a3X89iQsO', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(13, 'Prof. Maye Ankunding', 'gillian.mayert@example.net', 'Silas Kutch', '2udTpcNaJnt', '9Q6zloOo0yo', 'KwbgvKlwJbJ', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(14, 'Ottilie Schneider', 'wehner.cheyenne@example.net', 'Anthony Metz Jr.', 'chJ9vYITqMU', 'GbeQa5KNQPn', 'nOscICRgEbC', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(15, 'Annamarie Lowe', 'jmitchell@example.com', 'Owen Ritchie', 'YPV363ncvD9', 'K55nsFiYCqd', 'Yz2X8kFWS0h', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(16, 'Brown Lind V', 'senger.gloria@example.net', 'Johnathan Kiehn', '9rATlNyymqk', 'TN47IIiVoWA', 'NmudcC1vCkI', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(17, 'Mr. Walter Kilback II', 'flo.kulas@example.net', 'Mrs. Bianka Stroman V', '4DPYKZzhBDc', '9nrzEwi8B2D', 'EHdW4KYrLJd', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(18, 'Prof. Celestino Johns III', 'hansen.soledad@example.org', 'Prof. Maudie Altenwerth DDS', 'ybJObh3ysUq', 'jhTwY0oHPrm', 'HrhbI3LbwRL', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(19, 'Zena Braun MD', 'alphonso07@example.com', 'Karianne Effertz Jr.', 'LdIZRdIRSgv', 'ix2AnSv9BGi', '5FN3NXhc2Hc', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(20, 'Prof. Cloyd Upton', 'hoyt88@example.net', 'Mr. Oral Koss', 'c8HOTfxCCLa', 'ftvYxZd8apr', 'nKo1oxlWgyB', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(21, 'Abdul Carter', 'cassie60@example.com', 'Jerad Stoltenberg', '0w4sAf0ALbj', '8H7DnrlNJ5Z', 'Tux157tP57F', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(22, 'Antonia Wisoky', 'greg.herzog@example.com', 'Edwina Mohr', '4zFggblESvV', 'uO76LQ2xkHH', 'fsRNQmP3Jz6', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(23, 'Rosalyn Greenfelder', 'zboncak.charlie@example.com', 'Dr. Vern Crooks IV', 'fgph5fXUUuD', 'VGIjTJ384hw', 'miB53IY3z8i', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(24, 'Jaquelin Bernhard', 'emmie22@example.net', 'Prof. Amparo Gleason', 'XLx3XpA033e', 'JXr8OXjmFga', 'luTnyhON84W', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(25, 'Antoinette Reilly', 'wwiegand@example.org', 'Burdette Stroman', 'Uw54RVmhFiG', '25yQ6LEnQXj', 'aVuAbbZCOOj', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(26, 'Mrs. Vivianne Doyle MD', 'wolf.francisco@example.com', 'Dale Price', 'niHsfiqHksz', 'bUB6KITKQEA', 'NrvPEX1efLs', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(27, 'Colleen Kerluke', 'lila28@example.org', 'Lottie Morar', 'z1BgCPqfVbG', 'Xmi3oPoDJyj', 'fNrM7XNvaJ8', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(28, 'Antwan Predovic', 'rico.cole@example.net', 'Macey Lehner', 'YGt4wKCXBj6', 'uqK9FVwosGU', 'IZOpLq5eD7O', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(29, 'Amelia Cruickshank', 'pierre22@example.net', 'Brandy White', '3EXQU5I1hsF', 'hZ0MnJpPLa0', 'ZQweJoEemXo', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(30, 'Name Murphy', 'yasmin88@example.org', 'Johanna Kub', 's4SJihMcHsK', 'K7wNXmpwLNS', 'an50ZtTmdgl', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(31, 'Mr. Arnoldo Sporer', 'tate.grimes@example.com', 'Elvie Strosin', 'aAjHWktFzwX', 'o8w1DWX1cxo', '61QEJKwKXSE', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(32, 'Quincy Kreiger', 'pjohnston@example.org', 'Javier Mante', '8hxtCBFcy4m', '4U6NRpglGD9', '9ZdHLRehNly', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(33, 'Dr. Juliet Breitenberg', 'amina80@example.net', 'Mr. Clifton Kuhic MD', 'qp9xQU0MfIG', 'tGcZ0AcY7wH', 'mCGD7p6WNnf', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(34, 'Emmet Luettgen', 'esther.spinka@example.net', 'Eric Botsford', 'mcj1GUW8PFt', 'HvZgg3zWXRX', 'jssReaFHgl5', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(35, 'Mazie Hamill', 'kstroman@example.com', 'Lysanne Nikolaus', 'JCeI4R2iSoF', 'vnEyv7ZoiE9', 'XvJnpTHDZj3', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(36, 'Gordon Hahn', 'logan31@example.net', 'Dr. Brayan Dickinson', '5NlwMdQzPca', 'n4fgKIXyOfX', 'MehqAv6WcGe', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(37, 'Muriel Orn', 'qrice@example.net', 'Prof. Sid Medhurst', 'ubnXJSIKv54', 'J85BDEb1FyB', 'bIMFAcNA1Jp', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(38, 'Justina Schiller', 'fdaniel@example.com', 'Annalise Cummerata', 'xlHlGzJ6vJH', 'R1MY9lCFQEM', 'Btt0WcCpq8B', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(39, 'Stanton Boyle', 'kelton26@example.com', 'Kennith Steuber', 'C5XvtSv0E14', 'vWmBHJuE0v3', '5zh7rjKdJ4b', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(40, 'Ms. Annamarie Hagenes', 'jimmie72@example.net', 'Tanya Eichmann', '4oz69QB0raX', 'nuvW31OfNpq', 'a811sVTeunP', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(41, 'Lafayette Hermann', 'dana.cronin@example.com', 'Jocelyn Heller', 'bvHOKv2R4A1', 'oypDMlc9mO7', 'cqbLICeLt7v', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(42, 'Marcelino Nicolas', 'alfonzo75@example.com', 'Nora Beahan', 'Xp4BTF2ysqT', 'pkjAWrfVg5I', 'sizrW1S3sGd', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(43, 'Kevin Carroll', 'yshields@example.net', 'Kara Kub', 'Pls217wj5WB', 'hyWt6Qa6Idc', 'BPfgvw8HRpe', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(44, 'Dr. Rolando Kemmer Sr.', 'chyna.raynor@example.com', 'Ralph Hayes', '0jc7ASy8tx5', 'ISRBkDMZKkH', 'cV4z3GMn2PI', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(45, 'Mr. Ulises Schoen', 'schamplin@example.org', 'Josianne Shanahan', '4CcmUzNv79W', 'd8GfVWgURDr', '6vz2efbkHRT', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(46, 'Dr. Furman Gutmann II', 'qbarrows@example.org', 'Jaida Reinger', 'V2snfvRNwH5', 'sIsJpiNOxZr', '3gtLRPIfcGg', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(47, 'Yvonne Blanda I', 'spinka.kira@example.net', 'Heath Lowe', 'bJbb0DFlMsq', 'Lh86Eo4KdMW', 'PjpHPJrW8qW', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(48, 'Dr. Jerod Russel', 'sipes.yesenia@example.com', 'Terrence Blick', 'f83N6ouzgST', 'PDcez9kZMUo', 'TBbMp4ntkUN', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(49, 'Connor Hermann', 'lupe.goldner@example.com', 'Bo Volkman', 'BHbVcawmPYK', 'vfXw973jcXI', 'ynQOvpgf7Nq', '2020-01-03 01:56:10', '2020-01-03 01:56:10'),
(50, 'Arnaldo Torphy', 'halvorson.bridgette@example.org', 'Maymie Kreiger', '6y7VrmtodBl', 'cN4rV1Z2hWX', 'E5Qe9Bfnju2', '2020-01-03 01:56:10', '2020-01-03 01:56:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- Indexes for table `requisitions`
--
ALTER TABLE `requisitions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requisition__temps`
--
ALTER TABLE `requisition__temps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `rq_products`
--
ALTER TABLE `rq_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storages`
--
ALTER TABLE `storages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `requisitions`
--
ALTER TABLE `requisitions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requisition__temps`
--
ALTER TABLE `requisition__temps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rq_products`
--
ALTER TABLE `rq_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `storages`
--
ALTER TABLE `storages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
