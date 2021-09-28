-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2021 at 10:32 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adhika_yukpilih`
--

-- --------------------------------------------------------

--
-- Table structure for table `choices`
--

CREATE TABLE `choices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `choice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poll_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `choices`
--

INSERT INTO `choices` (`id`, `choice`, `poll_id`, `created_at`, `updated_at`) VALUES
(3, 'haha', 2, '2021-08-31 20:46:26', '2021-08-31 20:46:26'),
(4, 'aw', 2, '2021-08-31 20:46:26', '2021-08-31 20:46:26'),
(5, 'aaaaa', 3, '2021-09-26 23:47:57', '2021-09-26 23:47:57'),
(6, 'aaaa', 3, '2021-09-26 23:47:57', '2021-09-26 23:47:57'),
(7, 'aaaaa', 14, '2021-09-27 00:16:04', '2021-09-27 00:16:04'),
(8, 'aaaa', 14, '2021-09-27 00:16:04', '2021-09-27 00:16:04'),
(9, 'aaaaa', 15, '2021-09-27 00:16:20', '2021-09-27 00:16:20'),
(10, 'aaaa', 15, '2021-09-27 00:16:20', '2021-09-27 00:16:20'),
(11, 'sd', 16, '2021-09-27 00:18:14', '2021-09-27 00:18:14'),
(12, 'aaaa', 16, '2021-09-27 00:18:14', '2021-09-27 00:18:14'),
(13, 'avv', 16, '2021-09-27 00:18:14', '2021-09-27 00:18:14'),
(14, 'sd', 17, '2021-09-27 00:57:18', '2021-09-27 00:57:18'),
(15, 'aaaa', 17, '2021-09-27 00:57:18', '2021-09-27 00:57:18'),
(16, 'avv', 17, '2021-09-27 00:57:18', '2021-09-27 00:57:18'),
(17, 'sd', 18, '2021-09-27 01:02:35', '2021-09-27 01:02:35'),
(18, 'aaaa', 18, '2021-09-27 01:02:35', '2021-09-27 01:02:35'),
(19, 'avv', 18, '2021-09-27 01:02:35', '2021-09-27 01:02:35'),
(20, 'WFO', 20, '2021-09-28 06:57:53', '2021-09-28 06:57:53'),
(21, 'WFH', 20, '2021-09-28 06:57:53', '2021-09-28 06:57:53');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'IT', '2021-08-31 18:30:23', '2021-08-31 18:30:23'),
(2, 'Financial', '2021-08-31 18:30:23', '2021-08-31 18:30:23'),
(3, 'Payment', '2021-08-31 18:30:23', '2021-08-31 18:30:23'),
(4, 'Procurement', '2021-08-31 18:30:24', '2021-08-31 18:30:24');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_08_27_034515_create_divisions_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2021_08_25_053548_create_polls_table', 1),
(7, '2021_08_26_043651_create_choices_table', 1),
(8, '2021_08_27_034706_create_votes_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadline` datetime NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`id`, `title`, `description`, `deadline`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'new poll', 'yes', '2021-09-01 23:59:59', 1, '2021-08-31 20:46:26', '2021-08-31 20:46:26', NULL),
(3, 'hmsssss', 'asaaa', '2021-08-28 12:00:00', 1, '2021-09-26 23:47:57', '2021-09-26 23:47:57', NULL),
(14, 'hmssffasss', 'asaaffadfg', '2021-08-28 12:00:00', 1, '2021-09-27 00:16:03', '2021-09-27 00:16:03', NULL),
(15, 'hmffssffasss', 'asaaffadfg', '2021-08-28 12:00:00', 1, '2021-09-27 00:16:20', '2021-09-27 00:16:20', NULL),
(16, 'hmffssffasss', 'asaaffadfg', '2021-08-28 12:00:00', 1, '2021-09-27 00:18:14', '2021-09-27 00:18:14', NULL),
(17, 'DEADLINETEST', 'asaaffadfg', '2021-12-12 12:00:00', 1, '2021-09-27 00:57:18', '2021-09-27 00:57:18', NULL),
(18, 'OKE', 'asaaffadfg', '2021-12-12 12:00:00', 1, '2021-09-27 01:02:35', '2021-09-27 01:02:35', NULL),
(20, 'WFH / WFO', 'wfh / wfo', '2021-09-30 13:55:53', 1, '2021-09-28 06:56:23', '2021-09-28 06:56:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `division_id`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$VfOf01xXKPoZ1.zwjUF9puQbJbQe1VsKO1BZUbkg.gzHA/Kg2koxi', 'admin', 1, '2021-08-31 18:30:25', '2021-08-31 20:44:07'),
(2, 'procurement1', '$2y$10$p/12HBd0Fhn2kIHTguqvJu2xGLQRXE.y8zojQOUEgfrlYDsKaGNGK', 'user', 4, '2021-08-31 18:30:25', '2021-08-31 18:30:25'),
(3, 'procurement2', '$2y$10$Zo/Sm3QkS32DohEjSBjMNezCmdN5qIIo02qUTg7Rbz6188tp5Flpy', 'user', 4, '2021-08-31 18:30:25', '2021-08-31 18:30:25'),
(4, 'procurement3', '$2y$10$xjZIwXpYwT9/8B/XlphIaeo8PbwSlhzu0J4wGTLGXpMomDBwx95sO', 'user', 4, '2021-08-31 18:30:26', '2021-08-31 18:30:26'),
(5, 'it1', '$2y$10$SZv.KKXeTPohFAwjQnXv/eUGLV1kxVVkzXSAdyfPSWvh.docfW9na', 'user', 1, '2021-08-31 18:30:26', '2021-09-22 01:04:58'),
(6, 'it2', '$2y$10$KyhOchNAG19OzSB6be.kT.0yqzGDPfcWygSH7UrQkzTQz6ZCYfPb6', 'user', 1, '2021-08-31 18:30:26', '2021-08-31 18:30:26'),
(7, 'it3', '$2y$10$MeYiAETYho5YglCbXQbOLuhSqLsjchnaavkVt1oZ1fYH4Fst2RGmG', 'user', 1, '2021-08-31 18:30:26', '2021-08-31 18:30:26'),
(8, 'it4', '$2y$10$pEU7PVAPWVWWd68btc7Tde.QuUUoNKZl3t4PoufODVsEw1QIevo4i', 'user', 1, '2021-08-31 18:30:26', '2021-08-31 18:30:26'),
(9, 'it5', '$2y$10$lPBUNv08wRXq8YfLPIOENOBAgTCWIHcIE9fYpk.CjDjmfNq3jyaiu', 'user', 1, '2021-08-31 18:30:26', '2021-08-31 18:30:26'),
(10, 'finance1', '$2y$10$ULhXuyEfYk35KZtE8sYiNuxJvYvY9SX1VrYgxl5D.RPwM.IODY5lq', 'user', 2, '2021-08-31 18:30:26', '2021-08-31 18:30:26'),
(11, 'finance2', '$2y$10$dgdUZSxLxqDPcYVoStBvj.sKW6kvDD4soc/DLm83cHy2oHg0/bcJW', 'user', 2, '2021-08-31 18:30:26', '2021-08-31 18:30:26'),
(12, 'payment1', '$2y$10$Qmh3BVJof6b34Nn7qkkOm.tIOk8PHsuOyhuUnB0yS2l3ehUsupla6', 'user', 3, '2021-08-31 18:30:26', '2021-08-31 18:30:26'),
(13, 'payment2', '$2y$10$DoITBM7kkrNfIBKzMweeNedL4MAkNSVfAdlaYsVVjvmZxMpONp7ge', 'user', 3, '2021-08-31 18:30:27', '2021-08-31 18:30:27');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `choice_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `poll_id` bigint(20) UNSIGNED NOT NULL,
  `division_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `choice_id`, `user_id`, `poll_id`, `division_id`, `created_at`, `updated_at`) VALUES
(3, 3, 5, 2, 1, '2021-08-31 20:46:39', '2021-08-31 20:46:39'),
(4, 20, 12, 20, 3, '2021-09-28 07:00:30', '2021-09-28 07:00:30'),
(5, 20, 2, 20, 4, '2021-09-28 07:01:06', '2021-09-28 07:01:06'),
(6, 21, 5, 20, 1, '2021-09-28 07:02:09', '2021-09-28 07:02:09'),
(7, 21, 10, 20, 2, '2021-09-28 07:02:09', '2021-09-28 07:02:09'),
(8, 21, 6, 20, 1, '2021-09-28 07:25:31', '2021-09-28 07:25:31'),
(9, 20, 7, 20, 1, '2021-09-28 07:25:31', '2021-09-28 07:25:31'),
(10, 3, 9, 2, 1, '2021-09-28 00:44:19', '2021-09-28 00:44:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `choices`
--
ALTER TABLE `choices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `choices_poll_id_foreign` (`poll_id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `polls_created_by_foreign` (`created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_division_id_foreign` (`division_id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `votes_choice_id_foreign` (`choice_id`),
  ADD KEY `votes_user_id_foreign` (`user_id`),
  ADD KEY `votes_poll_id_foreign` (`poll_id`),
  ADD KEY `votes_division_id_foreign` (`division_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `choices`
--
ALTER TABLE `choices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `choices`
--
ALTER TABLE `choices`
  ADD CONSTRAINT `choices_poll_id_foreign` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `polls`
--
ALTER TABLE `polls`
  ADD CONSTRAINT `polls_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_choice_id_foreign` FOREIGN KEY (`choice_id`) REFERENCES `choices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_poll_id_foreign` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
