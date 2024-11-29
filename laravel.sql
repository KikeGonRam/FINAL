-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-11-2024 a las 17:24:15
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `laravel`
--
create database laravel;

use laravel; 
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`id`, `nombre`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'admin@darketo.com', '$2y$12$RrHZxUUEWYmQSZ2d7trVseoAiuT2UmZJTO8jd/ZDqw3IPErERPBKm', '2024-11-08 11:37:44', '2024-11-08 11:37:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barbers`
--

CREATE TABLE `barbers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `barbers`
--

INSERT INTO `barbers` (`id`, `name`, `email`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'Kike Ram', 'al2223123@gmail.com', 'barber_photos/aVNOSPBo6H7lD17lpw9t9CGe1EJnAeDpQLsLIrjE.png', '2024-11-08 21:44:18', '2024-11-13 08:30:36'),
(2, 'AXEL', 'AXEL@Barbero.com', 'barber_photos/JFg4sYGA0akhSLBdxKdkNVPGGaOu1qzGAmoVzkwd.jpg', '2024-11-11 22:37:26', '2024-11-11 23:43:31'),
(3, 'victor', 'victor@gmail.com', 'barbers_photos/x5uOoizfBnvfICbr4bjC8JzM2oYvcPCQKrn0BZlk.png', '2024-11-15 22:06:51', '2024-11-15 22:06:51'),
(4, 'Angel', 'angel@gmail.com', 'barbers_photos/MJjmzgHk59rWzoNhLcBtJ5Cg0pUlDwGbi2yDtyyx.png', '2024-11-15 22:07:32', '2024-11-15 22:07:32'),
(5, 'buy', 'hbuhb@gmail.com', 'barbers_photos/E5kO9i8SV58w7SegZwilxBxd9aEATh0kDwZ9w75Q.png', '2024-11-15 22:12:39', '2024-11-15 22:12:39'),
(6, 'gbygvgyv', 'abhbf@gmail.com', 'barbers_photos/Gj0FRx7LZ2SW1KQ2P4oR2w4xnfi8D9OlqvovLCOr.png', '2024-11-15 22:13:08', '2024-11-15 22:13:08'),
(7, 'qhubnuhyb', 'fctc@gmail.com', 'barbers_photos/n2IuypiRa7zcdoKwCiYlaYAySPx9hB4pIH7GhJ0j.png', '2024-11-15 22:13:46', '2024-11-15 22:13:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `estado` enum('pendiente','pagado','completado') NOT NULL DEFAULT 'pendiente',
  `total` decimal(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `estado`, `total`, `created_at`, `updated_at`) VALUES
(1, 6, 'pagado', 0.00, '2024-11-12 11:56:16', '2024-11-12 11:56:33'),
(2, 6, 'pagado', 1478.00, '2024-11-12 11:56:57', '2024-11-12 12:04:40'),
(3, 6, 'pagado', 2998.00, '2024-11-12 12:05:05', '2024-11-12 12:06:23'),
(4, 6, 'pagado', 6102.00, '2024-11-12 12:07:00', '2024-11-12 12:08:24'),
(5, 6, 'pagado', 19214.00, '2024-11-12 12:10:35', '2024-11-12 12:24:53'),
(6, 6, 'pagado', 1478.00, '2024-11-12 12:27:28', '2024-11-12 12:57:07'),
(7, 1, 'pagado', 5954.00, '2024-11-12 23:22:41', '2024-11-13 12:43:01'),
(8, 8, 'pendiente', 1478.00, '2024-11-14 12:04:24', '2024-11-14 12:04:24'),
(9, 1, 'pendiente', 10346.00, '2024-11-15 12:59:18', '2024-11-15 13:08:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(8,2) NOT NULL,
  `subtotal` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_product`
--

CREATE TABLE `cart_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cart_product`
--

INSERT INTO `cart_product` (`id`, `cart_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 1, 1478.00, '2024-11-12 12:00:48', '2024-11-12 12:00:48'),
(2, 3, 2, 1, 1478.00, '2024-11-12 12:05:05', '2024-11-12 12:05:05'),
(3, 3, 3, 1, 1520.00, '2024-11-12 12:05:12', '2024-11-12 12:05:12'),
(4, 4, 5, 2, 1478.00, '2024-11-12 12:07:00', '2024-11-12 12:07:44'),
(5, 4, 2, 1, 1478.00, '2024-11-12 12:07:11', '2024-11-12 12:07:11'),
(6, 4, 3, 1, 1520.00, '2024-11-12 12:07:23', '2024-11-12 12:07:23'),
(7, 4, 4, 1, 148.00, '2024-11-12 12:07:36', '2024-11-12 12:07:36'),
(8, 5, 2, 24, 1478.00, '2024-11-12 12:10:36', '2024-11-12 12:22:25'),
(9, 6, 2, 8, 1478.00, '2024-11-12 12:27:29', '2024-11-12 12:27:52'),
(10, 7, 2, 3, 1478.00, '2024-11-12 23:22:41', '2024-11-12 23:22:53'),
(11, 7, 3, 4, 1520.00, '2024-11-13 12:42:39', '2024-11-13 12:42:48'),
(12, 8, 2, 1, 1478.00, '2024-11-14 12:04:24', '2024-11-14 12:04:24'),
(13, 9, 2, 125896, 1478.00, '2024-11-15 12:59:19', '2024-11-15 13:09:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'GEL', 'Gel para caballeros', '2024-11-11 11:10:06', '2024-11-11 11:10:06'),
(3, 'PRUEBA', 'ERTYUI', '2024-11-15 12:32:02', '2024-11-15 12:32:02'),
(4, 'ertyuio', 'dfghjkl', '2024-11-15 22:08:44', '2024-11-15 22:08:44'),
(5, 'dfghjk', 'ertyui', '2024-11-15 22:08:56', '2024-11-15 22:08:56'),
(6, 'tfytfyuijj', 'buybiuv', '2024-11-15 22:09:07', '2024-11-15 22:09:07'),
(7, 'xrtcfyvgubhnj', 'xcftvygbuhnijmk', '2024-11-15 22:09:17', '2024-11-15 22:09:17'),
(8, 'xdtcfygvbh', 'cfvghbjn', '2024-11-15 22:09:29', '2024-11-15 22:09:29'),
(9, 'exrctybunimo', 'crtvygbuhnijm', '2024-11-15 22:09:38', '2024-11-15 22:09:38'),
(10, 'xdrctfvgbhjn', 'cfvygbhnj', '2024-11-15 22:09:47', '2024-11-15 22:09:47'),
(11, 'rxetcyvubhinj', 'xtcfyvgubhnjmk', '2024-11-15 22:09:59', '2024-11-15 22:09:59'),
(12, 'bhv', 'fycyc', '2024-11-15 22:10:10', '2024-11-15 22:10:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cliente_id` bigint(20) UNSIGNED NOT NULL,
  `barber_id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `estado` enum('pendiente','aceptada','cancelada') NOT NULL DEFAULT 'pendiente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `cliente_id`, `barber_id`, `fecha`, `hora`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-11-01', '02:29:00', 'pendiente', '2024-11-08 22:29:12', '2024-11-10 05:10:01'),
(2, 1, 1, '2024-12-07', '03:30:00', 'cancelada', '2024-11-08 22:30:39', '2024-11-09 15:34:56'),
(3, 3, 1, '2024-12-02', '10:28:00', 'aceptada', '2024-11-09 12:28:42', '2024-11-11 14:46:55'),
(4, 3, 1, '2024-11-26', '07:01:00', 'pendiente', '2024-11-09 13:01:47', '2024-11-09 13:01:47'),
(5, 2, 1, '2024-12-01', '03:39:00', 'pendiente', '2024-11-09 23:39:21', '2024-11-09 23:39:21'),
(6, 2, 1, '2024-12-02', '17:48:00', 'pendiente', '2024-11-10 00:48:09', '2024-11-10 00:48:09'),
(7, 1, 1, '2024-11-11', '02:28:00', 'aceptada', '2024-11-11 22:28:46', '2024-11-13 08:30:55'),
(8, 2, 2, '2024-11-11', '04:38:00', 'aceptada', '2024-11-11 22:38:59', '2024-11-14 11:00:25'),
(9, 8, 2, '2024-12-01', '04:35:00', 'pendiente', '2024-11-14 12:35:39', '2024-11-14 12:35:39'),
(10, 5, 2, '2024-11-14', '03:46:00', 'pendiente', '2024-11-14 23:46:37', '2024-11-14 23:46:37'),
(11, 6, 1, '2024-11-24', '15:07:00', 'pendiente', '2024-11-15 09:07:20', '2024-11-15 09:07:20'),
(12, 7, 1, '2024-12-01', '05:45:00', 'aceptada', '2024-11-15 12:45:52', '2024-11-15 12:46:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `details`, `created_at`, `updated_at`) VALUES
(1, 'luis', 'kike@gmail.com', 'prueba', '2024-11-11 07:30:33', '2024-11-11 07:30:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
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
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_11_08_053513_create_admins_table', 1),
(6, '2014_10_12_100000_create_password_resets_table', 2),
(7, '2024_11_08_065253_add_photo_to_users_table', 3),
(12, '2024_11_08_074910_create_barbers_table', 4),
(13, '2024_11_08_132442_create_citas_table', 4),
(14, '2024_11_08_143244_create_products_table', 5),
(15, '2024_11_11_012439_create_contacts_table', 6),
(16, '2024_11_11_045904_create_categories_table', 7),
(17, '2024_11_11_064139_create_services_table', 8),
(18, '2024_11_11_081153_create_promotions_table', 9),
(19, '2024_11_12_052254_create_carts_table', 10),
(20, '2024_11_12_052255_create_cart_items_table', 10),
(21, '2024_11_12_055910_create_cart_product_table', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `created_at`, `updated_at`, `category_id`) VALUES
(2, 'ggytre', 'rrres', 1478.00, 'products_image/R8o8nhVG0p1iv13QyOkMDKJaRHcXkKcAM701r0ps.png', '2024-11-09 20:22:27', '2024-11-15 12:21:23', 1),
(3, 'hh', 'hhh', 1520.00, 'products_image/Zbet9TO4GQHFLzSMEQO6LqPRzlHsY71NP48fywqn.jpg', '2024-11-09 20:28:41', '2024-11-15 00:37:40', 1),
(4, 'Nu', 'ns', 148.00, 'products_image/X5z95TmVDoj3BxUBkdeIBrkX8uBYa2M5dFLDLfpA.jpg', '2024-11-11 14:48:24', '2024-11-11 14:48:24', 0),
(5, 'ejemplo UTVT 2', 'ejemplo UTVT', 147.00, 'products_image/qvySHXY4W9EnrxvaNQ4AlYWQiPvHxWMHe9oy9ZJl.jpg', '2024-11-11 22:40:30', '2024-11-14 11:15:17', 0),
(6, 'tr', 'ds', 145.00, 'products_image/Xql1D7rzbT5aYu4xZcXjcg89r5BNpQ7ALFw9rLTx.jpg', '2024-11-14 11:26:28', '2024-11-15 12:32:27', 3),
(7, 'ffff', 'HUCBUVBEVUHRBHUV', 1254.00, 'products_image/XXU72R9cUHewgxYFNrRbyOlxHKG1JJuN4tnZ6zFm.png', '2024-11-14 11:48:15', '2024-11-15 00:38:07', 1),
(8, 'cwc', 'vfgbhn', 147852.00, 'products_image/Sdpltxmsu6Ga876vTOKgWpreW0perZ904xl5sr1z.jpg', '2024-11-15 12:10:53', '2024-11-15 12:32:50', 3),
(9, 'excfvgbh', 'xcfvgbh', 7488.82, 'products_image/5uGu2Dt1tzjaIkb9o6cQhOHlhIqZAhKNvlMNu9EG.png', '2024-11-15 22:11:30', '2024-11-15 22:11:30', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promotions`
--

CREATE TABLE `promotions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `discount` decimal(8,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `type` enum('service','product','both') NOT NULL,
  `is_for_regular_customers` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `promotions`
--

INSERT INTO `promotions` (`id`, `name`, `description`, `discount`, `start_date`, `end_date`, `type`, `is_for_regular_customers`, `created_at`, `updated_at`) VALUES
(1, 'buen', 'fin', 50.00, '2024-11-01', '2024-11-28', 'product', 0, '2024-11-11 14:24:52', '2024-11-11 14:25:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `duration` int(11) NOT NULL,
  `special_dates` tinyint(1) NOT NULL DEFAULT 0,
  `specific_barbers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`specific_barbers`)),
  `special_packages` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `price`, `duration`, `special_dates`, `specific_barbers`, `special_packages`, `created_at`, `updated_at`) VALUES
(1, 'fsf', 'dss', 123.00, 50, 1, NULL, 'prueba 1', '2024-11-11 12:49:02', '2024-11-11 13:42:30'),
(2, 'da', 'adad', 14785.00, 200, 0, NULL, 'dww', '2024-11-11 13:58:30', '2024-11-11 13:58:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `photo`) VALUES
(1, 'luis', 'al222310365@gmail.com', NULL, '$2y$12$LWDHqMc1Ni4EzsxSxQ7GOODVENp5PEkdoxRCnEiDW3QK2NeWC6yxG', NULL, '2024-11-08 12:27:03', '2024-11-08 21:59:16', 'profile_photos/YB2f6ULws9AFSMxWpOAY7ES4JEb2OFW9PdPAUpPu.png'),
(2, 'juan', 'juan123@gmail.com', NULL, '$2y$12$DhWTK2pPL.B0V7U2geTSrOYMSn2M1lga3T4YcBVoxRLaMV3322kVK', NULL, '2024-11-08 22:33:05', '2024-11-10 10:19:21', 'profile_photos/qMDInnIeN9vG0EtIjWgr44khorAbVPdL5qEwobQA.jpg'),
(3, 'kk', 'kikeramirez160418@gmail.com', NULL, '$2y$12$qDw4TESqhyTSkIu4hZNx4uLWePDJ89sNdSwkLBdpg5tWFQAnrP6mG', NULL, '2024-11-09 11:52:34', '2024-11-11 08:52:54', 'profile_photos/1mGVkbvpspbYBoja2LguTPIolpPjqi59Yj678LPn.jpg'),
(5, 'axel pastor', 'axel@gmail.com', NULL, '$2y$12$MdPjaKaBDAQs0OI/WUc2pOSAie52mRLbzOzlp6vknUZ1/J9.4ye12', NULL, '2024-11-11 22:41:50', '2024-11-15 22:05:28', NULL),
(6, 'jesus', 'jesus@gmail.com', NULL, '$2y$12$KdE6BFOEiElZkd/5wejI5uA0Y9yyP9c51YghVKr0cF0I.p1AiUBqG', NULL, '2024-11-12 11:36:57', '2024-11-12 11:39:35', 'profile_photos/huu4RXMStkup770xYELIsGSZeNc4MiFixNmhZojp.jpg'),
(7, 'Emmanuel Sanchez', 'sanchezemmanuel123@gmail.com', NULL, '$2y$12$dOT.t1kOed9YkxTx0sB8v.JihjoezkvlLGTWUhgq.rGpGTZJKnFgm', NULL, '2024-11-12 23:18:15', '2024-11-12 23:18:15', NULL),
(8, 'enri', 'enri@gmail.com', NULL, '$2y$12$g5KkgzmU43KPeOoDRBVg2u85pxkmdBW8VX9Pn5utqc4bmn3e7W2km', NULL, '2024-11-14 11:55:56', '2024-11-14 11:55:56', NULL),
(9, 'MIGUEL', 'MIGUEL@gmail.com', NULL, 'contraseña123', NULL, NULL, NULL, NULL),
(897, 'xecrvtb', 'cvgbh@gmail.com', NULL, '$2y$12$z8tgi8FnXwUB/1xC2ca3ReI3MhH81s1pPaxH0.TT6aJn2K5Ay8fmq', NULL, '2024-11-17 03:02:58', '2024-11-17 03:02:58', NULL),
(898, 'luis', 'kikegon123@gmail.com', NULL, '$2y$12$m0HpkhgPNAn7xwtEWkL14eBdvNhHxogv6rA8SoM2vS9XLU.bB2Xay', NULL, '2024-11-18 22:17:57', '2024-11-18 22:17:57', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indices de la tabla `barbers`
--
ALTER TABLE `barbers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barbers_email_unique` (`email`);

--
-- Indices de la tabla `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`);

--
-- Indices de la tabla `cart_product`
--
ALTER TABLE `cart_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cart_product_cart_id_product_id_unique` (`cart_id`,`product_id`),
  ADD KEY `cart_product_product_id_foreign` (`product_id`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `citas_cliente_id_foreign` (`cliente_id`),
  ADD KEY `citas_barber_id_foreign` (`barber_id`);

--
-- Indices de la tabla `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `barbers`
--
ALTER TABLE `barbers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cart_product`
--
ALTER TABLE `cart_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=899;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cart_product`
--
ALTER TABLE `cart_product`
  ADD CONSTRAINT `cart_product_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_barber_id_foreign` FOREIGN KEY (`barber_id`) REFERENCES `barbers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `citas_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
