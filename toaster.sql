-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 15, 2021 at 06:51 AM
-- Server version: 8.0.21
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dev_toaster`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `comment` text COLLATE utf8mb4_general_ci NOT NULL,
  `commentable_id` bigint UNSIGNED NOT NULL,
  `commentable_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_parent_id_foreign` (`parent_id`),
  KEY `comments_commentable_id_foreign` (`commentable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `parent_id`, `comment`, `commentable_id`, `commentable_type`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'Xin chào', 1, 'App\\Models\\Toast', '2021-04-14 23:26:35', '2021-04-14 23:26:35');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `connection` text COLLATE utf8mb4_general_ci NOT NULL,
  `queue` text COLLATE utf8mb4_general_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `toast_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `likes_user_id_foreign` (`user_id`),
  KEY `likes_toast_id_foreign` (`toast_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `toast_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2021-04-14 23:27:21', '2021-04-14 23:27:21');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_04_15_025048_create_roles_table', 1),
(2, '2014_10_12_000000_create_users_table', 2),
(3, '2014_10_12_100000_create_password_resets_table', 2),
(4, '2019_08_19_000000_create_failed_jobs_table', 2),
(5, '2021_03_11_150016_create_toasts_table', 2),
(6, '2021_03_19_053533_create_likes_table', 2),
(7, '2021_04_01_135947_create_toast_images_table', 2),
(8, '2021_04_08_114340_create_user_follows', 2),
(9, '2021_04_12_073745_create_comments_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `role_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_role_name_unique` (`role_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'user', NULL, NULL),
(2, 'sadmin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `toasts`
--

DROP TABLE IF EXISTS `toasts`;
CREATE TABLE IF NOT EXISTS `toasts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `toasts_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `toasts`
--

INSERT INTO `toasts` (`id`, `content`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Chào mừng đến với Toaster! 🥰👋', 2, '2021-04-14 23:18:44', '2021-04-14 23:18:44');

-- --------------------------------------------------------

--
-- Table structure for table `toast_images`
--

DROP TABLE IF EXISTS `toast_images`;
CREATE TABLE IF NOT EXISTS `toast_images` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `imagename` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `toast_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `toast_images_toast_id_foreign` (`toast_id`),
  KEY `toast_images_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `toast_images`
--

INSERT INTO `toast_images` (`id`, `imagename`, `toast_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'aaronv202104151318440.jpg', 1, 2, '2021-04-14 23:18:44', '2021-04-14 23:18:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `phone`, `date`, `email`, `email_verified_at`, `password`, `image`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Aaron Vong', 'aaronv', '0344813629', '1999-03-25', 'aaronvong@gmail.com', NULL, '$2y$10$DcH04hCcrc1ko9bQEbTMg.x9ufl8gb.yE1ZtZQcLtzdgayQWqQJsW', NULL, 1, NULL, '2021-04-14 21:13:54', '2021-04-14 21:13:54'),
(3, 'Vòng Quyền Minh', 'minhvong', '12345678912', '1999-03-25', 'admin@gmail.com', NULL, '$2y$10$Wax0wFdrjjsvxcp/W8ZdjuMBz7Ll6cTLYu7KeIfS35xfeiXQ7WqBO', NULL, 2, NULL, '2021-04-14 21:15:27', '2021-04-14 21:15:27'),
(6, 'Lê Văn Hiếu', 'hieucansa', '12345678910', '1999-12-14', 'hieuadmin@gmail.com', NULL, '$2y$10$vsxtKbxfB4jvoTIL28CPHOtfHX8/fHXQYrX7AIbr3EV8oaB91gnPq', NULL, 2, NULL, '2021-04-14 23:11:07', '2021-04-14 23:11:07'),
(7, 'Phạm Trung Tính', 'tinhtinhtang', '98765432112', '1999-03-22', 'tinhadmin@gmail.com', NULL, '$2y$10$L5MVNbwreiPaZ3vyuQUvbeKP0i8IXlEHojCcllrk42vp4imZhlh1e', NULL, 2, NULL, '2021-04-14 23:30:26', '2021-04-14 23:30:26'),
(8, 'Nguyên Võ Trường Giang', 'giangnan', '65498732113', '1999-06-24', 'giangadmin@gmail.com', NULL, '$2y$10$Dwarfm6pHY0DoW7SsJ70uuRyseEJRAmhFNy05MtGO7ztU3SK0V49e', NULL, 2, NULL, '2021-04-14 23:31:16', '2021-04-14 23:31:16'),
(9, 'Châu Nguyễn Quốc Anh', 'nguoichaua', '32165497752', '1999-09-16', 'anhadmin@gmail.com', NULL, '$2y$10$dfBbR/CvaoxQJojNoCnKquOxdHg0BxV4o/5iHXAKFNlasIktSqiVS', NULL, 2, NULL, '2021-04-14 23:31:57', '2021-04-14 23:31:57');

-- --------------------------------------------------------

--
-- Table structure for table `user_follows`
--

DROP TABLE IF EXISTS `user_follows`;
CREATE TABLE IF NOT EXISTS `user_follows` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `follow_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_follows_user_id_foreign` (`user_id`),
  KEY `user_follows_follow_id_foreign` (`follow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_commentable_id_foreign` FOREIGN KEY (`commentable_id`) REFERENCES `toasts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_toast_id_foreign` FOREIGN KEY (`toast_id`) REFERENCES `toasts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `toasts`
--
ALTER TABLE `toasts`
  ADD CONSTRAINT `toasts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `toast_images`
--
ALTER TABLE `toast_images`
  ADD CONSTRAINT `toast_images_toast_id_foreign` FOREIGN KEY (`toast_id`) REFERENCES `toasts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `toast_images_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `user_follows`
--
ALTER TABLE `user_follows`
  ADD CONSTRAINT `user_follows_follow_id_foreign` FOREIGN KEY (`follow_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_follows_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
