-- phpMyAdmin SQL Dump
-- version 5.1.4
-- https://www.phpmyadmin.net/
--
-- Хост: sofard.mysql.ukraine.com.ua
-- Время создания: Июн 01 2022 г., 21:55
-- Версия сервера: 5.7.33-36-log
-- Версия PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `sofard_mil`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin_user`
--

CREATE TABLE `admin_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `admin_user`
--

INSERT INTO `admin_user` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@million.com', NULL, '$2y$10$l5TzL8wBXIjjcOlUvg7jTef94vocGF/AD0xycceypVIjFpTvIHuA2', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2014_10_12_100000_create_password_resets_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(12, '2022_04_26_200020_order_pixel', 2),
(13, '2022_04_28_091428_admin_user', 3),
(14, '2022_04_28_203439_pixels_left', 3),
(15, '2022_05_13_195426_payment', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `order_pixel`
--

CREATE TABLE `order_pixel` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_gif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `X` int(11) NOT NULL,
  `Y` int(11) NOT NULL,
  `X2` int(11) NOT NULL,
  `Y2` int(11) NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `payment`
--

CREATE TABLE `payment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `UUID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `pixels_left`
--

CREATE TABLE `pixels_left` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `available` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sold` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `pixels_left`
--

INSERT INTO `pixels_left` (`id`, `available`, `sold`, `created_at`, `updated_at`) VALUES
(1, '1000000', '0', NULL, '2022-06-01 18:52:28');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `phone`, `password`, `name`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(17, 'sofarddeath@gmail.com', '+380990000000', '$2y$10$f/n7kixrEvFjfI1FnF6B1ev9U24h.nxN5SW9bKUWiO4zCB6TzIXjW', 'Daneil Boardsd', '2022-05-13 19:05:41', NULL, '2022-05-13 19:05:29', '2022-05-13 19:05:41'),
(18, 'Merganmergan7272@gmail.com', '+998990080816', '$2y$10$rxatV3d.xnHpdTbvSw65UugONY2cebnTD1/pA11aLdl.CIpxgzdhy', 'Mergan', NULL, NULL, '2022-05-14 09:34:50', '2022-05-14 09:34:50'),
(19, 'vincentrich77@gmail.com', '998998023532', '$2y$10$w4tZoHkOj45Un.FhYQLvTO0p2JLDRO5GbeGCGlQX/fUC0ek8HiLFS', 'Azik', '2022-05-14 09:36:03', NULL, '2022-05-14 09:35:39', '2022-05-14 09:36:03'),
(20, 'aliqulovjonibek01100@gmail.com', '+998990080816', '$2y$10$z4tWesZ8/qzfIBOi/0zhmepXQ2axC5.1/vtMTndee0s5kFX0RjpGG', 'Mergan', '2022-05-14 09:37:36', NULL, '2022-05-14 09:36:48', '2022-05-14 09:37:36'),
(21, 'kelyanmedia@gmail.com', '+998 (99) 999 99 99', '$2y$10$JLvinr7/qob0kjwuCQmiDePc3jRQQucG68DNCgo7N.rRgXIhEvaUq', 'Andrew', '2022-05-15 06:01:51', NULL, '2022-05-15 05:58:32', '2022-05-15 06:01:51'),
(22, 'daniel.boardsd@gmail.com', '+380990000000', '$2y$10$G26.W5HO5/Y9ME5WYN7D2eTVINoeyV3Jbp8Q2l/KPzNZTFFzDDSGK', 'Daneil Boardsd', '2022-05-15 07:19:36', NULL, '2022-05-15 07:17:28', '2022-05-15 07:19:36'),
(23, 'danie11l.boardsd@gmail.com', '+380990000000', '$2y$10$rJHYmykWWl15PPFWECB4mep1pHiyIURldbS31C45k1ffQ.oG.YWnm', 'Daneil Boardsd', NULL, NULL, '2022-05-15 07:46:35', '2022-05-15 07:46:35'),
(24, 'akmalkarimov94@gmail.com', '+99899999999', '$2y$10$Np3qCsduTR2TdzgrhyvjZOroQWVMPgVEVTOXDayhDxlvunapS1ROW', 'Akmal', '2022-05-19 15:43:06', NULL, '2022-05-19 15:42:46', '2022-05-19 15:43:06'),
(25, 'igranomer1@gmail.com', '+99999999999', '$2y$10$yIgkZS4EvV5j3TA14cWdBu9P2H0tnZL62FW0jP22Pv/l1IzH24FMC', 'Jamshid', '2022-05-20 16:12:47', NULL, '2022-05-20 16:12:11', '2022-05-20 16:12:47'),
(26, 'vyqdqlacvcgfpzcycs@kvhrr.com', '99899999999999', '$2y$10$XGpgNBq1r4gT.flu8AzJ4OblsM1y8Hj0xm10o1Ne5Ex4p.LCWBWf.', 'Asssa', NULL, NULL, '2022-05-21 09:54:36', '2022-05-21 09:54:36'),
(27, 'axs58516@xcoxc.com', '+998997770707', '$2y$10$KwPSYUI/uXoY6RCJZvfRFO90GHmUimvS5vcr.SQqYqRW6xvcKKDYC', 'ПАПА РИМСКИЙ', '2022-05-21 10:02:54', NULL, '2022-05-21 10:01:20', '2022-05-21 10:02:54'),
(28, 'odilorg@gmail.com', '+998915550808', '$2y$10$Iwlg7ngbIdSpksssoXtiLe.nompaGft30Gjn.HEKfVLjHfPyxgTgy', 'odil', '2022-05-30 10:16:27', NULL, '2022-05-30 10:16:15', '2022-05-30 10:16:27');

-- --------------------------------------------------------

--
-- Структура таблицы `views`
--

CREATE TABLE `views` (
  `banner_id` int(11) NOT NULL,
  `block_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT '1970-01-01',
  `views` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_user_email_unique` (`email`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_pixel`
--
ALTER TABLE `order_pixel`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `pixels_left`
--
ALTER TABLE `pixels_left`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`banner_id`,`block_id`,`date`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `order_pixel`
--
ALTER TABLE `order_pixel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT для таблицы `payment`
--
ALTER TABLE `payment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `pixels_left`
--
ALTER TABLE `pixels_left`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
