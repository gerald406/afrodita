-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-04-2026 a las 05:04:42
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
-- Base de datos: `laravel_lms`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(191) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1776117900),
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1776117900;', 1776117900),
('laravel-cache-4f8156a65d6f173dda44b63c2754cc56', 'i:1;', 1776117614),
('laravel-cache-4f8156a65d6f173dda44b63c2754cc56:timer', 'i:1776117614;', 1776117614),
('laravel-cache-66a284e11965311c401594642b9cfac5', 'i:1;', 1776116216),
('laravel-cache-66a284e11965311c401594642b9cfac5:timer', 'i:1776116216;', 1776116216),
('laravel-cache-887309d048beef83ad3eabf2a79a64a389ab1c9f', 'i:1;', 1766768688),
('laravel-cache-887309d048beef83ad3eabf2a79a64a389ab1c9f:timer', 'i:1766768688;', 1766768688),
('laravel-cache-celia@admin.com|127.0.0.1', 'i:1;', 1766768636),
('laravel-cache-celia@admin.com|127.0.0.1:timer', 'i:1766768636;', 1766768636),
('laravel-cache-d9668a26c0eef2c1f5c9ab3f5bad64b3', 'i:1;', 1766768636),
('laravel-cache-d9668a26c0eef2c1f5c9ab3f5bad64b3:timer', 'i:1766768636;', 1766768636),
('laravel-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0', 'i:1;', 1766767283),
('laravel-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0:timer', 'i:1766767283;', 1766767283),
('laravel-cache-global_categories', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:5:{i:0;O:19:\"App\\Models\\Category\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:6:{s:2:\"id\";i:1;s:4:\"name\";s:12:\"Nombramiento\";s:4:\"slug\";s:12:\"nombramiento\";s:5:\"color\";s:6:\"yellow\";s:10:\"created_at\";s:19:\"2025-12-18 16:57:27\";s:10:\"updated_at\";s:19:\"2025-12-18 16:59:10\";}s:11:\"\0*\0original\";a:6:{s:2:\"id\";i:1;s:4:\"name\";s:12:\"Nombramiento\";s:4:\"slug\";s:12:\"nombramiento\";s:5:\"color\";s:6:\"yellow\";s:10:\"created_at\";s:19:\"2025-12-18 16:57:27\";s:10:\"updated_at\";s:19:\"2025-12-18 16:59:10\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:3:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:5:\"color\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:19:\"App\\Models\\Category\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:6:{s:2:\"id\";i:2;s:4:\"name\";s:8:\"Ascenso \";s:4:\"slug\";s:7:\"ascenso\";s:5:\"color\";s:3:\"red\";s:10:\"created_at\";s:19:\"2025-12-18 16:57:46\";s:10:\"updated_at\";s:19:\"2025-12-18 16:57:46\";}s:11:\"\0*\0original\";a:6:{s:2:\"id\";i:2;s:4:\"name\";s:8:\"Ascenso \";s:4:\"slug\";s:7:\"ascenso\";s:5:\"color\";s:3:\"red\";s:10:\"created_at\";s:19:\"2025-12-18 16:57:46\";s:10:\"updated_at\";s:19:\"2025-12-18 16:57:46\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:3:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:5:\"color\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:19:\"App\\Models\\Category\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:6:{s:2:\"id\";i:3;s:4:\"name\";s:5:\"Cepre\";s:4:\"slug\";s:5:\"cepre\";s:5:\"color\";s:5:\"green\";s:10:\"created_at\";s:19:\"2025-12-18 16:58:34\";s:10:\"updated_at\";s:19:\"2025-12-18 16:58:34\";}s:11:\"\0*\0original\";a:6:{s:2:\"id\";i:3;s:4:\"name\";s:5:\"Cepre\";s:4:\"slug\";s:5:\"cepre\";s:5:\"color\";s:5:\"green\";s:10:\"created_at\";s:19:\"2025-12-18 16:58:34\";s:10:\"updated_at\";s:19:\"2025-12-18 16:58:34\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:3:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:5:\"color\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:3;O:19:\"App\\Models\\Category\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:6:{s:2:\"id\";i:4;s:4:\"name\";s:12:\"Matemáticas\";s:4:\"slug\";s:11:\"matematicas\";s:5:\"color\";s:6:\"indigo\";s:10:\"created_at\";s:19:\"2025-12-18 16:59:01\";s:10:\"updated_at\";s:19:\"2025-12-18 16:59:01\";}s:11:\"\0*\0original\";a:6:{s:2:\"id\";i:4;s:4:\"name\";s:12:\"Matemáticas\";s:4:\"slug\";s:11:\"matematicas\";s:5:\"color\";s:6:\"indigo\";s:10:\"created_at\";s:19:\"2025-12-18 16:59:01\";s:10:\"updated_at\";s:19:\"2025-12-18 16:59:01\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:3:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:5:\"color\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:4;O:19:\"App\\Models\\Category\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:6:{s:2:\"id\";i:5;s:4:\"name\";s:5:\"Chino\";s:4:\"slug\";s:5:\"chino\";s:5:\"color\";s:4:\"pink\";s:10:\"created_at\";s:19:\"2025-12-26 11:37:25\";s:10:\"updated_at\";s:19:\"2025-12-26 11:37:25\";}s:11:\"\0*\0original\";a:6:{s:2:\"id\";i:5;s:4:\"name\";s:5:\"Chino\";s:4:\"slug\";s:5:\"chino\";s:5:\"color\";s:4:\"pink\";s:10:\"created_at\";s:19:\"2025-12-26 11:37:25\";s:10:\"updated_at\";s:19:\"2025-12-26 11:37:25\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:3:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:5:\"color\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1777603937),
('laravel-cache-web_settings', 'O:25:\"App\\Models\\GeneralSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:16:\"general_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:15:{s:2:\"id\";i:1;s:9:\"site_name\";s:14:\"YACHAY VIRTUAL\";s:15:\"whatsapp_number\";s:11:\"51962351552\";s:16:\"whatsapp_message\";s:77:\"Hola, estimados de YachayVirtual. Quisiera solicitar información, por favor.\";s:9:\"site_logo\";s:62:\"/storage/settings/b0PQNwpswfCceARAuNtezaQYbCaWOXaQmHZUhwg0.png\";s:12:\"site_favicon\";N;s:12:\"popup_active\";i:0;s:11:\"popup_image\";N;s:10:\"popup_link\";N;s:10:\"created_at\";s:19:\"2025-12-18 09:28:24\";s:10:\"updated_at\";s:19:\"2025-12-20 17:28:54\";s:16:\"free_mode_active\";i:0;s:15:\"free_mode_start\";N;s:13:\"free_mode_end\";N;s:17:\"free_mode_message\";N;}s:11:\"\0*\0original\";a:15:{s:2:\"id\";i:1;s:9:\"site_name\";s:14:\"YACHAY VIRTUAL\";s:15:\"whatsapp_number\";s:11:\"51962351552\";s:16:\"whatsapp_message\";s:77:\"Hola, estimados de YachayVirtual. Quisiera solicitar información, por favor.\";s:9:\"site_logo\";s:62:\"/storage/settings/b0PQNwpswfCceARAuNtezaQYbCaWOXaQmHZUhwg0.png\";s:12:\"site_favicon\";N;s:12:\"popup_active\";i:0;s:11:\"popup_image\";N;s:10:\"popup_link\";N;s:10:\"created_at\";s:19:\"2025-12-18 09:28:24\";s:10:\"updated_at\";s:19:\"2025-12-20 17:28:54\";s:16:\"free_mode_active\";i:0;s:15:\"free_mode_start\";N;s:13:\"free_mode_end\";N;s:17:\"free_mode_message\";N;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:3:{s:16:\"free_mode_active\";s:7:\"boolean\";s:15:\"free_mode_start\";s:8:\"datetime\";s:13:\"free_mode_end\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:8:{i:0;s:9:\"site_name\";i:1;s:9:\"site_logo\";i:2;s:16:\"free_mode_active\";i:3;s:15:\"free_mode_start\";i:4;s:13:\"free_mode_end\";i:5;s:17:\"free_mode_message\";i:6;s:15:\"whatsapp_number\";i:7;s:16:\"whatsapp_message\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1777603937);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(191) NOT NULL,
  `owner` varchar(191) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `color` varchar(191) NOT NULL DEFAULT 'indigo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `color`, `created_at`, `updated_at`) VALUES
(1, 'Nombramiento', 'nombramiento', 'yellow', '2025-12-18 21:57:27', '2025-12-18 21:59:10'),
(2, 'Ascenso ', 'ascenso', 'red', '2025-12-18 21:57:46', '2025-12-18 21:57:46'),
(3, 'Cepre', 'cepre', 'green', '2025-12-18 21:58:34', '2025-12-18 21:58:34'),
(4, 'Matemáticas', 'matematicas', 'indigo', '2025-12-18 21:59:01', '2025-12-18 21:59:01'),
(5, 'Chino', 'chino', 'pink', '2025-12-26 16:37:25', '2025-12-26 16:37:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `body` text NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 1,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `lesson_id`, `body`, `is_approved`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 16, 1, 'Consequatur et excepturi natus at. Soluta ipsam ut alias enim. Alias delectus neque quia est. Eos dolorum cum soluta nihil aliquam voluptates sunt. Voluptas facilis eos praesentium temporibus incidunt sit.', 1, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(2, 16, 1, 'Ut et illum consequatur eius. Molestiae qui magni reiciendis eos. Et sed et blanditiis quia. Ut cumque occaecati delectus non.', 1, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(3, 22, 2, 'Et ea numquam rerum deleniti vel aperiam. Debitis asperiores consequatur mollitia neque. Quisquam excepturi voluptas perspiciatis ut recusandae. Voluptas facilis tenetur quas autem et qui error.', 1, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(4, 22, 2, 'Veniam eos beatae atque est error asperiores rerum. Velit recusandae ipsam et eum. Voluptatem magnam libero maiores enim quae earum aut. Eum amet debitis eum voluptates omnis.', 1, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(5, 14, 3, 'Voluptatem ea dolores nemo molestiae eum. Aliquam adipisci dolor sed tenetur blanditiis.', 1, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(6, 14, 3, 'Repellat dolor et ut harum et iusto. Beatae voluptatibus vel maiores et tempora. Blanditiis corporis hic unde sint aut corporis.', 1, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(7, 19, 4, 'Excepturi ut voluptatem est laboriosam ducimus. Ea ut molestiae debitis quia nobis. Iure omnis saepe consequatur tempora. Totam sed voluptatem hic est cupiditate autem rerum.', 1, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(8, 19, 4, 'Unde eius rerum aliquam. Dolorum cumque eum quas magni eligendi. Dolores rerum in totam vel itaque. Eveniet quia nihil consequuntur tempore ut qui.', 1, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(9, 23, 5, 'Quam maxime possimus voluptatem enim ut sit. Nemo rerum beatae autem eaque porro. Possimus facilis a ipsum error.', 1, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(10, 23, 5, 'Impedit voluptatem expedita iste praesentium aperiam sed soluta. Amet quod rerum vel asperiores ipsam iure quibusdam aliquid. Voluptatem enim molestiae officia consequatur recusandae porro est. Deleniti at praesentium harum et ut.', 1, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(11, 18, 6, 'Rerum ab quia ratione at consectetur voluptatum officiis. Quis libero et dolorem voluptatibus ab non. Veniam voluptatem consequatur cupiditate. Consequuntur quam hic amet hic.', 1, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(12, 18, 6, 'Non a est maxime. Dolore blanditiis maiores ipsam corrupti a aut.', 1, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(13, 6, 7, 'Est est fugit sint deserunt. Ut veritatis cupiditate debitis repellendus. Aut cum necessitatibus distinctio earum quo aut.', 1, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(14, 6, 7, 'Similique ea veniam dolores harum iusto quis omnis. Nesciunt aperiam assumenda temporibus non facere quas qui. Consequatur dolorem voluptas et excepturi neque. Aliquam vero eveniet aut quasi.', 1, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(15, 12, 8, 'Rerum odio quisquam quibusdam incidunt provident eum accusamus. Esse qui magnam dolore voluptas totam occaecati a. Optio magni quo sint et repudiandae. Rerum quasi accusantium sed qui eligendi.', 1, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(16, 12, 8, 'Alias veniam odit dolores sapiente. Dolor dolor repudiandae aperiam aut dolorem ratione omnis.', 1, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(17, 10, 9, 'Quaerat qui ipsa odit laborum ea qui sit. Rerum nostrum molestiae eveniet harum aut cupiditate doloremque. Minima repellendus nihil aperiam eveniet magni est. Est exercitationem sequi eum velit.', 1, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(18, 10, 9, 'Architecto adipisci et cupiditate ullam recusandae. Aspernatur in minus iste alias quasi unde. Dolore vero quis hic. Et libero harum atque beatae impedit.', 1, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(19, 17, 10, 'Ut est consequatur velit tempore velit eos. Beatae animi voluptas corporis aut ut enim est. Sint dolores amet dolore beatae nihil. Eaque maiores repudiandae ab nam impedit.', 1, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(20, 17, 10, 'Pariatur perspiciatis saepe sit molestias eaque. Molestiae nihil reiciendis delectus facere omnis quasi ad. Ab placeat quos aut est iste incidunt. Excepturi sunt et asperiores debitis reiciendis laudantium sint.', 1, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(21, 24, 11, 'Quia quasi a doloribus tenetur. Modi doloremque dolorem odio architecto non.', 1, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(22, 24, 11, 'Sapiente porro quam laboriosam est at. Ad consequatur sunt nemo voluptatem. Facere molestiae sapiente dolorem assumenda. In nisi id harum porro.', 1, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(23, 8, 12, 'Harum reiciendis repudiandae aut sint voluptatem vel. Officiis quia accusantium ex fuga qui vel. Accusantium autem sunt maxime ut. Velit magni aut sunt et consectetur minus ea.', 1, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(24, 8, 12, 'Quia illum dicta unde maiores quis in. Accusantium magni laborum commodi vitae illo necessitatibus cum ullam. Dolores occaecati blanditiis mollitia blanditiis ullam dolorem eligendi.', 1, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(25, 1, 14, 'test', 1, NULL, '2026-04-13 22:00:27', '2026-04-13 22:00:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(191) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `compare_price` decimal(10,2) DEFAULT NULL,
  `status` enum('draft','published','archived') NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `courses`
--

INSERT INTO `courses` (`id`, `user_id`, `title`, `slug`, `description`, `image_path`, `price`, `compare_price`, `status`, `created_at`, `updated_at`, `category_id`) VALUES
(1, 2, 'Master en Laravel 12 desde Cero', 'master-laravel-12', 'Aprende a crear aplicaciones modernas con la última versión de Laravel.', '/storage/courses/P3yNaoR5kNcAfhiPhYh2mjfT5aMX0yygsGkG0gV3.png', 49.99, NULL, 'published', '2025-12-18 14:27:16', '2025-12-19 02:24:58', 2),
(2, 3, 'Inventore deleniti soluta aut et aut.', 'inventore-deleniti-soluta-aut-et-aut-582', 'Perferendis commodi dolorem ipsam ad. Quia laborum beatae iure voluptatibus molestiae vel. Consectetur voluptates maxime eos eligendi.\n\nQuis consequatur illo voluptatum in cum non voluptas. Aliquid pariatur temporibus ipsum. Temporibus sit ut tempore et voluptas tempore.\n\nEaque ut autem magnam ipsa quia quasi. Rerum facere animi sunt qui dolor neque vel. Reiciendis corrupti asperiores occaecati porro.', '/storage/courses/AQc5nY2Ntf2KDQqypoajhAWVBHLCAWMH2w6a9bBz.jpg', 0.00, 120.00, 'published', '2025-12-18 14:27:17', '2025-12-19 02:19:59', 1),
(3, 3, 'Voluptatem deserunt consequuntur cumque.', 'voluptatem-deserunt-consequuntur-cumque-904', 'Velit architecto non qui placeat nobis. Neque debitis consequatur sed quia qui. Dolorem quae quae a.\n\nMagnam consequatur voluptas nesciunt pariatur perspiciatis. Cum perferendis impedit in necessitatibus. Magni repellat fuga atque eos rerum.\n\nVitae aspernatur magnam cupiditate et velit dolorem voluptatibus. Eligendi voluptatem qui occaecati provident temporibus cumque error sapiente. Libero voluptas repellat voluptatem et et.', '/storage/courses/QHEIFoGUiQ42EMX9hw0YenWdvmGs4QmvWBUY3IQh.jpg', 99.00, 150.00, 'published', '2025-12-18 14:27:17', '2025-12-19 02:22:47', 2),
(4, 3, 'Voluptatum temporibus voluptas et quibusdam.', 'voluptatum-temporibus-voluptas-et-quibusdam-694', 'Quod ab molestiae odit eos iure qui sint. Molestiae corrupti libero distinctio adipisci. Autem culpa rerum sit ducimus.\n\nTotam non similique consequatur repudiandae aut rerum. Tempora nihil autem ut voluptatem.\n\nDolore eum hic rem aut facere et maiores sequi. Magni dolor repellendus expedita eaque.', '/storage/courses/kjeJ9DKw8ALzterRotwQvx8x9ofpqLDf4fjQ5MP5.jpg', 19.99, 120.00, 'published', '2025-12-18 14:27:17', '2025-12-19 02:23:17', 3),
(5, 2, 'Explicabo et quasi voluptas.', 'explicabo-et-quasi-voluptas-841', 'Culpa fuga ut incidunt repudiandae. Itaque cum eos consectetur ab ut ut. Ut hic consequuntur ducimus et.\n\nIpsa eligendi consequatur necessitatibus. Sit et natus debitis non rerum dicta nisi. Ea blanditiis illum consequuntur vitae possimus sint unde. Deserunt veniam ut ut ullam consectetur.\n\nQuibusdam dolorum cumque sit nihil suscipit eos. Corrupti placeat dolores alias laboriosam repudiandae accusamus. Illum suscipit repellat dolores error recusandae sint ea.', '/storage/courses/cK6XERyngiggjRplD20ulWs3Pc1g3YnBCh3C9vyy.jpg', 49.99, NULL, 'published', '2025-12-18 14:27:17', '2025-12-19 02:24:12', 4),
(6, 3, 'Dolores ab necessitatibus quod dicta temporibus.', 'dolores-ab-necessitatibus-quod-dicta-temporibus-933', 'Nulla quia perspiciatis voluptas neque qui assumenda placeat quo. Voluptas molestias omnis mollitia eum sint et ullam.\n\nNobis est magnam ullam. Officia molestiae dolor cum quis vitae.\n\nAut non rerum adipisci quos. Ipsum doloribus nulla saepe sit nihil porro eum. Aut vel quisquam aut.', '/storage/courses/33fDbsnaACqtvFELsQT3gllA3vQlKFntdCgyKOfT.jpg', 19.99, NULL, 'published', '2025-12-18 14:27:17', '2025-12-19 02:24:37', 1),
(7, 25, 'Curso de Css3', 'curso-de-css3', 'En el presente curso aprenderás desde la base el uso correcto de Css3 con ello podrás darle estilos a tus sitios web ', '/storage/courses/u7PIy0KqrAwUkFzzEa2JTt5bJIW9O7JbYd7aTaiD.jpg', 10.00, 15.00, 'published', '2025-12-26 16:41:25', '2025-12-26 16:52:05', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `course_sections`
--

CREATE TABLE `course_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `course_sections`
--

INSERT INTO `course_sections` (`id`, `course_id`, `title`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Introducción y Configuración', 1, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(2, 1, 'Base de Datos y Eloquent', 2, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(3, 1, 'Vistas Avanzadas con Blade', 3, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(4, 7, 'Unidad 1: Fundamentos', 1, '2025-12-26 16:42:30', '2025-12-26 16:42:30'),
(5, 7, 'Unidad 2: Sintaxis', 2, '2025-12-26 16:47:34', '2025-12-26 16:47:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enrollments`
--

CREATE TABLE `enrollments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `enrolled_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `price_paid` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('active','pending','completed','cancelled') NOT NULL DEFAULT 'pending',
  `progress_percent` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `enrollments`
--

INSERT INTO `enrollments` (`id`, `user_id`, `course_id`, `enrolled_at`, `price_paid`, `status`, `progress_percent`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-12-18 14:27:16', 49.99, 'active', 0, NULL, NULL),
(2, 4, 1, '2025-12-18 14:27:16', 49.99, 'active', 0, NULL, NULL),
(3, 5, 1, '2025-12-18 14:27:16', 49.99, 'active', 0, NULL, NULL),
(4, 6, 1, '2025-12-18 14:27:16', 49.99, 'active', 0, NULL, NULL),
(5, 7, 1, '2025-12-18 14:27:16', 49.99, 'active', 0, NULL, NULL),
(6, 8, 1, '2025-12-18 14:27:16', 49.99, 'active', 0, NULL, NULL),
(7, 9, 1, '2025-12-18 14:27:17', 49.99, 'active', 0, NULL, NULL),
(8, 10, 1, '2025-12-18 14:27:17', 49.99, 'active', 0, NULL, NULL),
(9, 11, 1, '2025-12-18 14:27:17', 49.99, 'active', 0, NULL, NULL),
(10, 12, 1, '2025-12-18 14:27:17', 49.99, 'active', 0, NULL, NULL),
(11, 12, 3, '2025-12-18 05:00:00', 0.00, 'active', 0, '2025-12-19 02:58:34', '2025-12-19 03:00:44'),
(12, 12, 2, '2025-12-19 03:02:39', 0.00, 'active', 0, '2025-12-19 03:02:39', '2025-12-19 03:02:39'),
(13, 12, 6, '2025-12-18 05:00:00', 50.00, 'active', 0, '2025-12-19 03:03:09', '2025-12-19 03:51:08'),
(14, 26, 7, '2025-12-26 05:00:00', 10.00, 'active', 0, '2025-12-26 17:03:48', '2025-12-26 17:05:46'),
(15, 1, 7, '2026-04-13 21:56:28', 0.00, 'active', 0, '2026-04-13 21:56:28', '2026-04-13 21:56:28'),
(16, 1, 3, '2026-04-13 22:04:00', 99.00, 'pending', 0, '2026-04-13 22:04:00', '2026-04-13 22:04:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(191) NOT NULL DEFAULT 'Mi LMS',
  `whatsapp_number` varchar(191) DEFAULT NULL,
  `whatsapp_message` text DEFAULT NULL,
  `site_logo` varchar(191) DEFAULT NULL,
  `site_favicon` varchar(191) DEFAULT NULL,
  `popup_active` tinyint(1) NOT NULL DEFAULT 0,
  `popup_image` varchar(191) DEFAULT NULL,
  `popup_link` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `free_mode_active` tinyint(1) NOT NULL DEFAULT 0,
  `free_mode_start` timestamp NULL DEFAULT NULL,
  `free_mode_end` timestamp NULL DEFAULT NULL,
  `free_mode_message` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_name`, `whatsapp_number`, `whatsapp_message`, `site_logo`, `site_favicon`, `popup_active`, `popup_image`, `popup_link`, `created_at`, `updated_at`, `free_mode_active`, `free_mode_start`, `free_mode_end`, `free_mode_message`) VALUES
(1, 'YACHAY VIRTUAL', '51962351552', 'Hola, estimados de YachayVirtual. Quisiera solicitar información, por favor.', '/storage/settings/b0PQNwpswfCceARAuNtezaQYbCaWOXaQmHZUhwg0.png', NULL, 0, NULL, NULL, '2025-12-18 14:28:24', '2025-12-20 22:28:54', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lessons`
--

CREATE TABLE `lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_section_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `video_url` text DEFAULT NULL,
  `video_iframe` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `duration_minutes` int(11) NOT NULL DEFAULT 0,
  `is_free` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lessons`
--

INSERT INTO `lessons` (`id`, `course_section_id`, `title`, `slug`, `video_url`, `video_iframe`, `content`, `duration_minutes`, `is_free`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Qui enim eveniet nihil et.', 'qui-enim-eveniet-nihil-et', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, 'Magnam veniam vitae et sit dolorem. Iure vel laboriosam ad tenetur et. Et reprehenderit corporis quod magni dicta. Tenetur possimus accusamus cumque qui iusto et quidem. Nam porro repudiandae ea aut. Qui est possimus voluptas unde distinctio. Facere quam iure saepe ipsa. Eligendi qui rerum eaque recusandae. In deserunt fugit libero. Explicabo sit voluptatem beatae sed. Deserunt sed laboriosam perspiciatis iste minus et et odit. Quidem quisquam molestiae aut reprehenderit amet laboriosam.', 13, 0, 0, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(2, 1, 'Enim veniam libero ut illum qui id.', 'enim-veniam-libero-ut-illum-qui-id', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, 'Nemo soluta veniam error sequi. Unde eos doloribus occaecati nulla error. Maxime optio optio neque pariatur qui. Maiores ut error ut quaerat. Dolorum eligendi labore omnis quia cumque amet. Corrupti neque veritatis officia distinctio assumenda. Corrupti asperiores asperiores eligendi. Nesciunt inventore soluta quo voluptatem voluptas eligendi ex. Ullam eveniet nihil voluptas consectetur quidem sit asperiores.', 8, 0, 0, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(3, 1, 'Accusantium officia numquam facilis quo repellat vel.', 'accusantium-officia-numquam-facilis-quo-repellat-vel', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, 'Accusantium odio voluptas aut et cum. Quis voluptatem facilis quas natus rem et. Delectus quidem repudiandae rerum et officia rerum numquam. Vel aut non dolores accusantium aliquam aut asperiores voluptas. Itaque expedita blanditiis aliquam quia omnis. Quia omnis velit porro laboriosam. Minus consequatur sapiente excepturi ratione. Vel et mollitia molestiae autem nostrum veritatis ea.', 7, 0, 0, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(4, 1, 'Quaerat fugit vel accusamus et recusandae.', 'quaerat-fugit-vel-accusamus-et-recusandae', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, 'Aliquid dolor repellendus dolorem adipisci id voluptatem. Natus aliquid ipsa veniam ipsam qui. Quis sint excepturi pariatur laboriosam quo voluptas ratione. Ab qui aut officia aut. Quaerat voluptate fugit quaerat quis perspiciatis nesciunt expedita placeat. Eum et est vitae inventore quidem. Alias nostrum voluptas in iusto numquam est rem. Exercitationem earum deserunt totam aut rerum. Nesciunt ducimus nisi et laborum et ad.', 43, 0, 0, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(5, 2, 'Est molestias illum ratione et fuga.', 'est-molestias-illum-ratione-et-fuga', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, 'Labore soluta facere repellat non incidunt consequatur delectus voluptatem. Qui cumque deleniti et consequatur. Nostrum consequatur harum accusamus quae vero assumenda corrupti. Sunt est et voluptate quia excepturi asperiores mollitia. Eos aperiam libero architecto a. Deleniti est quam neque non dolore aut ducimus cum. Dolor occaecati animi inventore minus et. Omnis aperiam placeat beatae consequatur a est sed.', 39, 0, 0, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(6, 2, 'Debitis quibusdam quasi tenetur fugiat officia sint.', 'debitis-quibusdam-quasi-tenetur-fugiat-officia-sint', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, 'Voluptatibus sequi soluta in voluptatibus error. Quidem molestias minus et reiciendis omnis. Reiciendis porro ratione quaerat autem fuga atque vel. Voluptatibus adipisci provident quasi consequatur dolorem nemo aut. Error sit rem temporibus non occaecati perferendis corrupti assumenda. Quae sit est doloribus.', 21, 0, 0, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(7, 2, 'Sed voluptas quis esse dolorem dolor.', 'sed-voluptas-quis-esse-dolorem-dolor', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, 'Et nemo dolore est est incidunt id. Dignissimos aspernatur est quasi quod distinctio. Totam enim omnis deserunt nemo. Facere sed beatae commodi repellendus magnam molestias facilis. Tempore rerum saepe ipsa perspiciatis maiores aut et quidem. Earum quis deleniti placeat eum est cum. Rerum qui voluptate quisquam perferendis fuga. Hic eum dolorum quae autem nemo omnis.', 48, 0, 0, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(8, 2, 'Et et necessitatibus sed.', 'et-et-necessitatibus-sed', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, 'Voluptates aut quo enim voluptatem suscipit explicabo enim. Aspernatur blanditiis molestias aliquid quaerat et est. Rerum quis aut et consequuntur inventore est corrupti. Libero eveniet velit perspiciatis sapiente eum non ratione. Veritatis quia facilis sunt quos porro quidem et voluptas. Error et possimus saepe nobis temporibus adipisci est. Sequi atque voluptate qui sunt ad blanditiis.', 30, 0, 0, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(9, 3, 'Animi molestiae illo pariatur consectetur possimus.', 'animi-molestiae-illo-pariatur-consectetur-possimus', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, 'Ducimus aut qui nobis accusantium aut enim. Eos placeat quia doloremque sit omnis. Dolores eum placeat molestiae vel necessitatibus id eveniet labore. Harum earum magni laudantium voluptates molestiae tempore. Accusamus sint quia sit fugiat voluptatem. Architecto labore aperiam necessitatibus perferendis rem quis. Iusto quia impedit omnis ut qui at.', 27, 0, 0, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(10, 3, 'Et autem omnis est et officia consequatur.', 'et-autem-omnis-est-et-officia-consequatur', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, 'Quos sit possimus velit autem vel ratione. Dolorum est impedit error est nobis explicabo a. Quo illo deserunt qui voluptatem. Dolores odit neque nihil ut et iure distinctio. Assumenda accusamus nobis quibusdam voluptas recusandae libero sapiente illum. Dolorem aut enim perspiciatis sunt ut ut velit maiores. Inventore nemo quaerat dolorem possimus magnam. Dolorum quibusdam voluptas qui iusto dolor repudiandae.', 43, 0, 0, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(11, 3, 'Incidunt eos repudiandae necessitatibus.', 'incidunt-eos-repudiandae-necessitatibus', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, 'Velit nulla corrupti a voluptatem facere id totam. Et sint non aut aut et. Iure praesentium pariatur est temporibus. Architecto incidunt sapiente quos ut dolores vero fugiat. Soluta cupiditate provident error et eum ipsam qui. Quidem nulla sed quam. Eius odit inventore aut et et velit voluptas. Molestiae sit qui voluptas et. Sint et consequuntur amet hic et explicabo ipsum. Laudantium magni cum blanditiis quis. Inventore non adipisci sit. Eos earum qui voluptatibus consectetur earum enim.', 47, 1, 0, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(12, 3, 'Et velit et voluptatem doloribus.', 'et-velit-et-voluptatem-doloribus', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, 'Eum voluptatem qui non voluptate non cumque. Ut enim dolorum natus error. Enim molestiae doloribus autem doloribus sit est. Aliquam fugit veniam ex vero consequuntur. Vitae ullam quia ipsum est modi. Aliquam ab nostrum amet quia quo aut tempora. Culpa rem repellendus omnis sunt ut sed aut. Non aperiam quae minus. Quia labore consequatur nihil eum.', 40, 1, 0, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(13, 1, 'Examen Final de Prueba', 'examen-final-prueba-1766153130', NULL, NULL, NULL, 0, 0, 10, '2025-12-19 14:05:30', '2025-12-19 14:05:30'),
(14, 4, '¿Que es y para que SIRVE un ARCHIVO CSS?', 'que-es-y-para-que-sirve-un-archivo-css', NULL, '<iframe src=\"https://www.youtube.com/embed/-xtS1QwxfOo?si=j1RlBjf-5ozgIuqR\" frameborder=\"0\" allowfullscreen></iframe>', NULL, 6, 0, 1, '2025-12-26 16:43:53', '2025-12-26 16:43:53'),
(15, 4, 'EDITOR de CODIGO y ENTORNO de DESARROLLO para CSS', 'editor-de-codigo-y-entorno-de-desarrollo-para-css', NULL, '<iframe src=\"https://www.youtube.com/embed/3D9WyBgx0Ug?si=vdaht3yNCpcpuOTp\" frameborder=\"0\" allowfullscreen></iframe>', NULL, 8, 0, 2, '2025-12-26 16:44:58', '2025-12-26 16:44:58'),
(16, 4, '¿Como se ENLAZA CSS a HTML & Como se APLICAN los estilos CSS?', 'como-se-enlaza-css-a-html-como-se-aplican-los-estilos-css', NULL, '<iframe src=\"https://www.youtube.com/embed/aM9JfdZmbBo?si=ecTJbjCo_cW99zsR\" frameborder=\"0\" allowfullscreen></iframe>', NULL, 10, 0, 3, '2025-12-26 16:46:18', '2025-12-26 16:46:18'),
(17, 4, 'Como IMPORTAR una HOJA de ESTILOS CSS en OTRA con @import', 'como-importar-una-hoja-de-estilos-css-en-otra-con-at-import', NULL, '<iframe src=\"https://www.youtube.com/embed/HxtcAGliuI0?si=G62M7Qtwd3XU2SA6\" frameborder=\"0\" allowfullscreen></iframe>', NULL, 6, 0, 4, '2025-12-26 16:47:16', '2025-12-26 16:47:16'),
(18, 5, '¿Cual es la ESTRUCTURA y SINTAXIS de CSS?', 'cual-es-la-estructura-y-sintaxis-de-css', NULL, '<iframe src=\"https://www.youtube.com/embed/pxR2UCqTl48?si=_IYdQi4bx5hZvMTR\" frameborder=\"0\" allowfullscreen></iframe>', NULL, 5, 0, 1, '2025-12-26 16:48:32', '2025-12-26 16:48:32'),
(19, 5, '¿Como se COLOCA un COMENTARIO en CSS?', 'como-se-coloca-un-comentario-en-css', 'https://www.youtube.com/watch?v=_A72VOepsko', NULL, NULL, 4, 0, 2, '2025-12-26 16:49:25', '2025-12-26 16:49:25'),
(20, 5, '¿Que es la CASCADA en CSS y como FUNCIONA?', 'que-es-la-cascada-en-css-y-como-funciona', 'https://www.youtube.com/watch?v=TWZNGHM242s', NULL, NULL, 4, 0, 3, '2025-12-26 16:50:31', '2025-12-26 16:50:31'),
(21, 5, '¿Que es un SELECTOR de TIPO o ETIQUETA en CSS?', 'que-es-un-selector-de-tipo-o-etiqueta-en-css', 'https://www.youtube.com/watch?v=Hjs6cWAqzJg', NULL, NULL, 4, 0, 4, '2025-12-26 16:51:15', '2025-12-26 16:51:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lesson_resources`
--

CREATE TABLE `lesson_resources` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `type` enum('pdf','link','zip','image') NOT NULL DEFAULT 'pdf',
  `path_or_url` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lesson_resources`
--

INSERT INTO `lesson_resources` (`id`, `lesson_id`, `title`, `type`, `path_or_url`, `created_at`, `updated_at`) VALUES
(1, 1, 'Diapositivas de clase', 'pdf', 'http://heathcote.org/', '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(2, 2, 'Diapositivas de clase', 'pdf', 'http://www.hermiston.net/aliquam-neque-et-vel-recusandae-atque', '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(3, 3, 'Diapositivas de clase', 'pdf', 'http://www.monahan.com/', '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(4, 4, 'Diapositivas de clase', 'pdf', 'http://kautzer.biz/quis-quia-iusto-sequi-eos-consequuntur', '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(5, 5, 'Diapositivas de clase', 'pdf', 'https://dooley.com/velit-sed-dolorem-doloribus-ducimus-beatae-ipsam.html', '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(6, 6, 'Diapositivas de clase', 'pdf', 'http://schmeler.net/culpa-modi-laborum-aliquid-quasi-distinctio-sint-similique-provident', '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(7, 7, 'Diapositivas de clase', 'pdf', 'http://corwin.com/repellat-sit-pariatur-non-eos-quis-ut-ratione', '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(8, 8, 'Diapositivas de clase', 'pdf', 'http://www.williamson.com/', '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(9, 9, 'Diapositivas de clase', 'pdf', 'http://www.schiller.com/rerum-corrupti-consectetur-quia-ex-deleniti.html', '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(10, 10, 'Diapositivas de clase', 'pdf', 'http://pouros.com/', '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(11, 11, 'Diapositivas de clase', 'pdf', 'http://www.purdy.com/aut-voluptatum-unde-nihil-unde-omnis-itaque-quae-voluptatem', '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(12, 12, 'Diapositivas de clase', 'pdf', 'http://www.denesik.biz/aut-nesciunt-id-dolorem-perferendis-voluptatem', '2025-12-18 14:27:16', '2025-12-18 14:27:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lesson_user`
--

CREATE TABLE `lesson_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `completed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lesson_user`
--

INSERT INTO `lesson_user` (`user_id`, `lesson_id`, `completed_at`) VALUES
(1, 14, '2026-04-13 22:02:11'),
(12, 1, '2025-12-19 22:28:27'),
(12, 2, '2025-12-19 22:28:45'),
(26, 14, '2025-12-26 17:09:01'),
(26, 15, '2025-12-26 17:08:11'),
(26, 16, '2025-12-26 17:43:56'),
(26, 17, '2025-12-26 17:44:36'),
(26, 18, '2025-12-26 17:45:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_activities`
--

CREATE TABLE `login_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `login_activities`
--

INSERT INTO `login_activities` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, '2025-12-18 14:28:10', '2025-12-18 14:28:10'),
(2, 2, '2025-12-18 14:28:10', '2025-12-18 14:28:10'),
(3, 7, '2025-12-18 15:08:57', '2025-12-18 15:08:57'),
(4, 7, '2025-12-18 15:08:57', '2025-12-18 15:08:57'),
(5, 2, '2025-12-18 21:56:42', '2025-12-18 21:56:42'),
(6, 2, '2025-12-18 21:56:42', '2025-12-18 21:56:42'),
(7, 2, '2025-12-19 01:39:23', '2025-12-19 01:39:23'),
(8, 2, '2025-12-19 01:39:23', '2025-12-19 01:39:23'),
(9, 12, '2025-12-19 02:58:18', '2025-12-19 02:58:18'),
(10, 12, '2025-12-19 02:58:18', '2025-12-19 02:58:18'),
(11, 12, '2025-12-19 03:51:24', '2025-12-19 03:51:24'),
(12, 12, '2025-12-19 03:51:24', '2025-12-19 03:51:24'),
(13, 2, '2025-12-19 13:24:40', '2025-12-19 13:24:40'),
(14, 2, '2025-12-19 13:24:40', '2025-12-19 13:24:40'),
(15, 2, '2025-12-19 22:26:41', '2025-12-19 22:26:41'),
(16, 2, '2025-12-19 22:26:41', '2025-12-19 22:26:41'),
(17, 12, '2025-12-19 22:27:53', '2025-12-19 22:27:53'),
(18, 12, '2025-12-19 22:27:53', '2025-12-19 22:27:53'),
(19, 2, '2025-12-20 21:05:46', '2025-12-20 21:05:46'),
(20, 2, '2025-12-20 21:05:46', '2025-12-20 21:05:46'),
(21, 2, '2025-12-20 22:27:50', '2025-12-20 22:27:50'),
(22, 2, '2025-12-20 22:27:50', '2025-12-20 22:27:50'),
(23, 2, '2025-12-26 16:36:46', '2025-12-26 16:36:46'),
(24, 2, '2025-12-26 16:36:46', '2025-12-26 16:36:46'),
(25, 26, '2025-12-26 17:03:27', '2025-12-26 17:03:27'),
(26, 26, '2025-12-26 17:03:27', '2025-12-26 17:03:27'),
(27, 2, '2026-04-13 21:35:57', '2026-04-13 21:35:57'),
(28, 2, '2026-04-13 21:35:57', '2026-04-13 21:35:57'),
(29, 1, '2026-04-13 21:59:16', '2026-04-13 21:59:16'),
(30, 1, '2026-04-13 21:59:16', '2026-04-13 21:59:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_12_152811_create_courses_table', 1),
(5, '2025_12_12_153031_create_course_sections_table', 1),
(6, '2025_12_12_153137_create_lessons_table', 1),
(7, '2025_12_12_153301_create_lesson_resources_table', 1),
(8, '2025_12_12_153400_create_reviews_table', 1),
(9, '2025_12_12_153520_create_comments_table', 1),
(10, '2025_12_12_153617_create_enrollments_table', 1),
(11, '2025_12_12_154410_create_settings_table', 1),
(12, '2025_12_12_200423_add_two_factor_columns_to_users_table', 1),
(13, '2025_12_12_200633_create_personal_access_tokens_table', 1),
(14, '2025_12_15_100540_create_web_settings_tables', 1),
(15, '2025_12_15_165018_create_lesson_user_table', 1),
(16, '2025_12_15_215112_add_gamification_and_free_mode_fields', 1),
(17, '2025_12_16_001935_create_categories_table', 1),
(18, '2025_12_18_091117_create_login_activities_table', 1),
(19, '2025_12_18_233119_create_quizzes_table', 2),
(20, '2025_12_18_233242_create_questions_table', 2),
(21, '2025_12_18_233337_create_question_answers_table', 2),
(22, '2025_12_18_233418_create_quiz_attempts_table', 2),
(23, '2025_12_18_233543_create_quiz_attempt_answers_table', 2),
(25, '2025_12_20_171305_add_whatsapp_fields_to_general_settings', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `content` longtext NOT NULL,
  `type` enum('multiple_choice','true_false','single_choice') NOT NULL DEFAULT 'single_choice',
  `points` int(11) NOT NULL DEFAULT 1,
  `feedback` text DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `content`, `type`, `points`, `feedback`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'ques A', 'single_choice', 1, NULL, 0, '2025-12-19 04:53:50', '2025-12-19 04:53:50'),
(2, 1, '<p>pregunat 2</p>', 'single_choice', 1, NULL, 0, '2025-12-19 05:08:30', '2025-12-19 05:08:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `question_answers`
--

CREATE TABLE `question_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `answer_text` varchar(191) NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `question_answers`
--

INSERT INTO `question_answers` (`id`, `question_id`, `answer_text`, `is_correct`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'ab', 0, 0, '2025-12-19 04:53:51', '2025-12-19 04:53:51'),
(2, 1, 'a', 1, 0, '2025-12-19 04:53:51', '2025-12-19 04:53:51'),
(3, 1, 'c', 0, 0, '2025-12-19 04:53:51', '2025-12-19 04:53:51'),
(4, 1, 'd', 0, 0, '2025-12-19 04:53:51', '2025-12-19 04:53:51'),
(5, 2, '1', 0, 0, '2025-12-19 05:08:30', '2025-12-19 05:08:30'),
(6, 2, '2', 1, 0, '2025-12-19 05:08:30', '2025-12-19 05:08:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quizzes`
--

CREATE TABLE `quizzes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `duration_minutes` int(11) NOT NULL DEFAULT 60,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `passing_score` int(11) NOT NULL DEFAULT 70,
  `max_attempts` int(11) NOT NULL DEFAULT 3,
  `is_randomized` tinyint(1) NOT NULL DEFAULT 1,
  `questions_to_show` int(11) NOT NULL DEFAULT 10,
  `status` enum('draft','published','archived') NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `quizzes`
--

INSERT INTO `quizzes` (`id`, `course_id`, `lesson_id`, `title`, `slug`, `description`, `duration_minutes`, `start_time`, `end_time`, `passing_score`, `max_attempts`, `is_randomized`, `questions_to_show`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, 'Examen de preuba2', 'examen-de-preuba2', 'esto es prueba', 60, NULL, NULL, 70, 3, 1, 10, 'published', '2025-12-19 04:53:00', '2025-12-19 22:31:12', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quiz_attempts`
--

CREATE TABLE `quiz_attempts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `started_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `completed_at` timestamp NULL DEFAULT NULL,
  `score_obtained` decimal(8,2) DEFAULT NULL,
  `is_passed` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('in_progress','completed','timeout','abandoned') NOT NULL DEFAULT 'in_progress',
  `current_question_index` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `quiz_attempts`
--

INSERT INTO `quiz_attempts` (`id`, `user_id`, `quiz_id`, `started_at`, `completed_at`, `score_obtained`, `is_passed`, `status`, `current_question_index`, `created_at`, `updated_at`) VALUES
(1, 12, 1, '2025-12-19 23:21:39', '2025-12-19 23:21:39', 100.00, 1, 'completed', 0, '2025-12-19 23:21:16', '2025-12-19 23:21:39'),
(2, 12, 1, '2025-12-19 23:22:03', '2025-12-19 23:22:03', 50.00, 0, 'completed', 0, '2025-12-19 23:21:49', '2025-12-19 23:22:03'),
(3, 12, 1, '2025-12-19 23:22:25', '2025-12-19 23:22:25', 0.00, 0, 'completed', 0, '2025-12-19 23:22:13', '2025-12-19 23:22:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quiz_attempt_answers`
--

CREATE TABLE `quiz_attempt_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quiz_attempt_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `question_answer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `quiz_attempt_answers`
--

INSERT INTO `quiz_attempt_answers` (`id`, `quiz_attempt_id`, `question_id`, `question_answer_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, '2025-12-19 23:21:26', '2025-12-19 23:21:26'),
(2, 1, 2, 6, '2025-12-19 23:21:32', '2025-12-19 23:21:34'),
(3, 2, 1, 1, '2025-12-19 23:21:52', '2025-12-19 23:21:52'),
(4, 2, 2, 6, '2025-12-19 23:21:58', '2025-12-19 23:21:58'),
(5, 3, 1, 3, '2025-12-19 23:22:17', '2025-12-19 23:22:17'),
(6, 3, 2, 5, '2025-12-19 23:22:23', '2025-12-19 23:22:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 1,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `course_id`, `rating`, `is_approved`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 5, 1, 'Excelente curso, muy recomendado.', '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(2, 4, 1, 5, 1, 'Excelente curso, muy recomendado.', '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(3, 5, 1, 5, 1, 'Excelente curso, muy recomendado.', '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(4, 6, 1, 5, 1, 'Excelente curso, muy recomendado.', '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(5, 7, 1, 5, 1, 'Excelente curso, muy recomendado.', '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(6, 8, 1, 4, 1, 'Excelente curso, muy recomendado.', '2025-12-18 14:27:17', '2025-12-18 14:27:17'),
(7, 9, 1, 5, 1, 'Excelente curso, muy recomendado.', '2025-12-18 14:27:17', '2025-12-18 14:27:17'),
(8, 10, 1, 5, 1, 'Excelente curso, muy recomendado.', '2025-12-18 14:27:17', '2025-12-18 14:27:17'),
(9, 11, 1, 4, 1, 'Excelente curso, muy recomendado.', '2025-12-18 14:27:17', '2025-12-18 14:27:17'),
(10, 12, 1, 4, 1, 'Excelente curso, muy recomendado.', '2025-12-18 14:27:17', '2025-12-18 14:27:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('d6YREeJg7ar4beieKk9YQlfanEBFCOx6pesnClwm', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ2syOUFvNkE0RlhRR0JwTmhDQ0lYUGlDTzR4QU9KTjdDeHpJZ0NiOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1777517603);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) NOT NULL,
  `value` text DEFAULT NULL,
  `description` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `description`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'LMS Laravel 12', 'Nombre de la plataforma', '2025-12-18 14:27:14', '2025-12-18 14:27:14'),
(2, 'free_course_access_date', NULL, 'Fecha de puertas abiertas (YYYY-MM-DD)', '2025-12-18 14:27:14', '2025-12-18 14:27:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(191) NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `subtitle` varchar(191) DEFAULT NULL,
  `link_url` varchar(191) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sliders`
--

INSERT INTO `sliders` (`id`, `image_path`, `title`, `subtitle`, `link_url`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '/storage/sliders/135bbQLSCd5c0pxAMNabCODx6LMrjy9Y9QALT4Dc.png', 'ChinitoRM', NULL, NULL, 1, 1, '2025-12-18 14:31:01', '2025-12-18 14:31:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `role` varchar(191) NOT NULL DEFAULT 'student',
  `total_points` int(11) NOT NULL DEFAULT 0,
  `dni` varchar(8) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `avatar` varchar(191) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `legacy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `role`, `total_points`, `dni`, `phone`, `avatar`, `bio`, `legacy_id`, `remember_token`, `current_team_id`, `profile_photo_path`, `last_login_at`, `created_at`, `updated_at`) VALUES
(1, 'Gerardino Cauna', 'gcauna@admin.com', '2025-12-18 14:27:13', '$2y$12$g.Q5QBjzq/hoIJYBhfp0iea2ojce3w97.X2gJKfeUwYNJpGFyGoO2', NULL, NULL, NULL, 'student', 100, '45454545', '999999999', NULL, NULL, NULL, 'Xu7ZYD0scr', NULL, NULL, '2026-04-13 21:59:16', '2025-12-18 14:27:14', '2026-04-13 22:02:11'),
(2, 'Admin Principal', 'admin@lms.com', NULL, '$2y$12$tXLFJCq6IXxxUjZ6.OIJOeGZeQI3Lx658mFQJzd7.VcUA.73XC2qS', NULL, NULL, NULL, 'admin', 0, '00000001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-13 21:35:57', '2025-12-18 14:27:15', '2026-04-13 21:35:57'),
(3, 'Profesor Demo', 'profe@lms.com', NULL, '$2y$12$xdzO0VGOYL2LmirzbLTv6.crAvoAE3z9l9LNTBPQK2jedaVgDn0lC', NULL, NULL, NULL, 'instructor', 0, '00000002', NULL, NULL, 'Ingeniero de Software Senior experto en Laravel.', NULL, NULL, NULL, NULL, NULL, '2025-12-18 14:27:15', '2025-12-18 14:27:15'),
(4, 'Estudiante Demo', 'alumno@lms.com', NULL, '$2y$12$1N5oIIJeXqcV.3rbfR7bpuRwJYYoxXd090EKUK453qepkxOqEY5b6', NULL, NULL, NULL, 'student', 0, '00000003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-18 14:27:15', '2025-12-18 14:27:15'),
(5, 'Vinnie Schinner', 'naomi35@example.net', '2025-12-18 14:27:15', '$2y$12$BxhmfLSaRVMmaT/HDyCnwu//ajVL/4jfUmZw5L3Ea1xRB4LA/nV4S', NULL, NULL, NULL, 'student', 0, NULL, NULL, NULL, NULL, NULL, 'Q3y3FiEXSS', NULL, NULL, NULL, '2025-12-18 14:27:15', '2025-12-18 14:27:15'),
(6, 'Orrin Bechtelar', 'mcglynn.bridie@example.com', '2025-12-18 14:27:15', '$2y$12$BxhmfLSaRVMmaT/HDyCnwu//ajVL/4jfUmZw5L3Ea1xRB4LA/nV4S', NULL, NULL, NULL, 'student', 0, NULL, NULL, NULL, NULL, NULL, 'i7fVntbHFP', NULL, NULL, NULL, '2025-12-18 14:27:15', '2025-12-18 14:27:15'),
(7, 'Prof. Onie Wuckert I', 'ycruickshank@example.net', '2025-12-18 14:27:15', '$2y$12$BxhmfLSaRVMmaT/HDyCnwu//ajVL/4jfUmZw5L3Ea1xRB4LA/nV4S', NULL, NULL, NULL, 'student', 0, NULL, NULL, NULL, NULL, NULL, 'oAKSQ85BLr', NULL, NULL, '2025-12-18 15:08:57', '2025-12-18 14:27:16', '2025-12-18 15:08:57'),
(8, 'Dr. Jacinto Hodkiewicz DDS', 'rosenbaum.santino@example.org', '2025-12-18 14:27:15', '$2y$12$BxhmfLSaRVMmaT/HDyCnwu//ajVL/4jfUmZw5L3Ea1xRB4LA/nV4S', NULL, NULL, NULL, 'student', 0, NULL, NULL, NULL, NULL, NULL, '8FrhToFGrD', NULL, NULL, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(9, 'Enola Schoen MD', 'bstanton@example.com', '2025-12-18 14:27:15', '$2y$12$BxhmfLSaRVMmaT/HDyCnwu//ajVL/4jfUmZw5L3Ea1xRB4LA/nV4S', NULL, NULL, NULL, 'student', 0, NULL, NULL, NULL, NULL, NULL, '8zF40umW3U', NULL, NULL, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(10, 'Cathryn Boyle MD', 'kerluke.remington@example.net', '2025-12-18 14:27:15', '$2y$12$BxhmfLSaRVMmaT/HDyCnwu//ajVL/4jfUmZw5L3Ea1xRB4LA/nV4S', NULL, NULL, NULL, 'student', 0, NULL, NULL, NULL, NULL, NULL, 'Z5bvXDWAxP', NULL, NULL, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(11, 'Prof. Ciara Larson', 'collin04@example.com', '2025-12-18 14:27:15', '$2y$12$BxhmfLSaRVMmaT/HDyCnwu//ajVL/4jfUmZw5L3Ea1xRB4LA/nV4S', NULL, NULL, NULL, 'student', 0, NULL, NULL, NULL, NULL, NULL, 'x79mEtCUff', NULL, NULL, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(12, 'Lilla Lowe', 'kiana.kuhic@example.net', '2025-12-18 14:27:15', '$2y$12$BxhmfLSaRVMmaT/HDyCnwu//ajVL/4jfUmZw5L3Ea1xRB4LA/nV4S', NULL, NULL, NULL, 'student', 200, NULL, NULL, NULL, NULL, NULL, 'rLUMy5jvtFiaDPiEGZuqlAFjnf8AkZF57GihIcYDRlGQVqDfV8bYj4IBxHdQ', NULL, NULL, '2025-12-19 22:27:53', '2025-12-18 14:27:16', '2025-12-19 22:28:45'),
(13, 'Ms. Lelah Jacobs', 'carmella66@example.net', '2025-12-18 14:27:15', '$2y$12$BxhmfLSaRVMmaT/HDyCnwu//ajVL/4jfUmZw5L3Ea1xRB4LA/nV4S', NULL, NULL, NULL, 'student', 0, NULL, NULL, NULL, NULL, NULL, 'vCibCU7geb', NULL, NULL, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(14, 'Emile Waters III', 'ystark@example.com', '2025-12-18 14:27:15', '$2y$12$BxhmfLSaRVMmaT/HDyCnwu//ajVL/4jfUmZw5L3Ea1xRB4LA/nV4S', NULL, NULL, NULL, 'student', 0, NULL, NULL, NULL, NULL, NULL, 'rXtCVUiIGe', NULL, NULL, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(15, 'Jovan Lehner', 'imann@example.org', '2025-12-18 14:27:15', '$2y$12$BxhmfLSaRVMmaT/HDyCnwu//ajVL/4jfUmZw5L3Ea1xRB4LA/nV4S', NULL, NULL, NULL, 'student', 0, NULL, NULL, NULL, NULL, NULL, '1lvJ0LHEnN', NULL, NULL, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(16, 'Quinten Harris', 'cloyd90@example.org', '2025-12-18 14:27:15', '$2y$12$BxhmfLSaRVMmaT/HDyCnwu//ajVL/4jfUmZw5L3Ea1xRB4LA/nV4S', NULL, NULL, NULL, 'student', 0, NULL, NULL, NULL, NULL, NULL, 'GtGtGp8Ll8', NULL, NULL, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(17, 'Prof. Damian Spencer MD', 'shettinger@example.net', '2025-12-18 14:27:15', '$2y$12$BxhmfLSaRVMmaT/HDyCnwu//ajVL/4jfUmZw5L3Ea1xRB4LA/nV4S', NULL, NULL, NULL, 'student', 0, NULL, NULL, NULL, NULL, NULL, 'nlRstGV2hL', NULL, NULL, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(18, 'Joel Gulgowski', 'zion.berge@example.org', '2025-12-18 14:27:15', '$2y$12$BxhmfLSaRVMmaT/HDyCnwu//ajVL/4jfUmZw5L3Ea1xRB4LA/nV4S', NULL, NULL, NULL, 'student', 0, NULL, NULL, NULL, NULL, NULL, '44JlwE8YMG', NULL, NULL, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(19, 'Lamont Quigley', 'rohan.marjorie@example.org', '2025-12-18 14:27:15', '$2y$12$BxhmfLSaRVMmaT/HDyCnwu//ajVL/4jfUmZw5L3Ea1xRB4LA/nV4S', NULL, NULL, NULL, 'student', 0, NULL, NULL, NULL, NULL, NULL, 'apvD5kuXLV', NULL, NULL, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(20, 'Marcia VonRueden II', 'jerry.mosciski@example.org', '2025-12-18 14:27:15', '$2y$12$BxhmfLSaRVMmaT/HDyCnwu//ajVL/4jfUmZw5L3Ea1xRB4LA/nV4S', NULL, NULL, NULL, 'student', 0, NULL, NULL, NULL, NULL, NULL, '1OKgNmUocf', NULL, NULL, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(21, 'Briana Zieme', 'quinn.dare@example.net', '2025-12-18 14:27:15', '$2y$12$BxhmfLSaRVMmaT/HDyCnwu//ajVL/4jfUmZw5L3Ea1xRB4LA/nV4S', NULL, NULL, NULL, 'student', 0, NULL, NULL, NULL, NULL, NULL, 'xY8tv7sDNZ', NULL, NULL, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(22, 'Shyanne Beer', 'zemard@example.org', '2025-12-18 14:27:15', '$2y$12$BxhmfLSaRVMmaT/HDyCnwu//ajVL/4jfUmZw5L3Ea1xRB4LA/nV4S', NULL, NULL, NULL, 'student', 0, NULL, NULL, NULL, NULL, NULL, 'SHnWYYXGVl', NULL, NULL, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(23, 'Luella Gerlach', 'jasmin.armstrong@example.com', '2025-12-18 14:27:15', '$2y$12$BxhmfLSaRVMmaT/HDyCnwu//ajVL/4jfUmZw5L3Ea1xRB4LA/nV4S', NULL, NULL, NULL, 'student', 0, NULL, NULL, NULL, NULL, NULL, 'Tnb5KMQ167', NULL, NULL, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(24, 'Mrs. Winifred Heaney', 'roob.melba@example.org', '2025-12-18 14:27:15', '$2y$12$BxhmfLSaRVMmaT/HDyCnwu//ajVL/4jfUmZw5L3Ea1xRB4LA/nV4S', NULL, NULL, NULL, 'student', 0, NULL, NULL, NULL, NULL, NULL, 'rGOrSJn62F', NULL, NULL, NULL, '2025-12-18 14:27:16', '2025-12-18 14:27:16'),
(25, 'Gerardino Cauna', 'gcauna@unap.edu.pe', NULL, '$2y$12$GI6G3uskXpmet5Cfk71gnuLs1wtQSWPbSRXu5Rc6ITh1s6UTMluwG', NULL, NULL, NULL, 'instructor', 0, '45537302', '987654321', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-26 16:39:13', '2025-12-26 16:39:13'),
(26, 'Celia Cari', 'celia@admin.com', NULL, '$2y$12$aMI3VSn5Y.8FXGZjlp5aqu.J8081O7kmfY0UuI232PxgOWntGqN6u', NULL, NULL, NULL, 'student', 500, '43854482', '987654321', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-26 17:03:27', '2025-12-26 17:03:27', '2025-12-26 17:45:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_point_logs`
--

CREATE TABLE `user_point_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `points` int(11) NOT NULL,
  `event_type` varchar(191) NOT NULL,
  `reference_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user_point_logs`
--

INSERT INTO `user_point_logs` (`id`, `user_id`, `points`, `event_type`, `reference_id`, `created_at`, `updated_at`) VALUES
(1, 12, 100, 'lesson_completed', 1, '2025-12-19 22:28:27', '2025-12-19 22:28:27'),
(2, 12, 100, 'lesson_completed', 2, '2025-12-19 22:28:45', '2025-12-19 22:28:45'),
(3, 26, 100, 'lesson_completed', 15, '2025-12-26 17:08:11', '2025-12-26 17:08:11'),
(4, 26, 100, 'lesson_completed', 14, '2025-12-26 17:09:01', '2025-12-26 17:09:01'),
(5, 26, 100, 'lesson_completed', 16, '2025-12-26 17:43:56', '2025-12-26 17:43:56'),
(6, 26, 100, 'lesson_completed', 17, '2025-12-26 17:44:36', '2025-12-26 17:44:36'),
(7, 26, 100, 'lesson_completed', 18, '2025-12-26 17:45:55', '2025-12-26 17:45:55'),
(8, 1, 100, 'lesson_completed', 14, '2026-04-13 22:02:11', '2026-04-13 22:02:11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_lesson_id_foreign` (`lesson_id`),
  ADD KEY `comments_parent_id_foreign` (`parent_id`);

--
-- Indices de la tabla `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courses_slug_unique` (`slug`),
  ADD KEY `courses_user_id_foreign` (`user_id`),
  ADD KEY `courses_category_id_foreign` (`category_id`);

--
-- Indices de la tabla `course_sections`
--
ALTER TABLE `course_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_sections_course_id_foreign` (`course_id`);

--
-- Indices de la tabla `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `enrollments_user_id_course_id_unique` (`user_id`,`course_id`),
  ADD KEY `enrollments_course_id_foreign` (`course_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lessons_course_section_id_foreign` (`course_section_id`);

--
-- Indices de la tabla `lesson_resources`
--
ALTER TABLE `lesson_resources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_resources_lesson_id_foreign` (`lesson_id`);

--
-- Indices de la tabla `lesson_user`
--
ALTER TABLE `lesson_user`
  ADD PRIMARY KEY (`user_id`,`lesson_id`),
  ADD KEY `lesson_user_lesson_id_foreign` (`lesson_id`);

--
-- Indices de la tabla `login_activities`
--
ALTER TABLE `login_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_activities_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indices de la tabla `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_quiz_id_foreign` (`quiz_id`);

--
-- Indices de la tabla `question_answers`
--
ALTER TABLE `question_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_answers_question_id_foreign` (`question_id`);

--
-- Indices de la tabla `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `quizzes_slug_unique` (`slug`),
  ADD KEY `quizzes_course_id_foreign` (`course_id`),
  ADD KEY `quizzes_lesson_id_foreign` (`lesson_id`);

--
-- Indices de la tabla `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_attempts_user_id_foreign` (`user_id`),
  ADD KEY `quiz_attempts_quiz_id_foreign` (`quiz_id`);

--
-- Indices de la tabla `quiz_attempt_answers`
--
ALTER TABLE `quiz_attempt_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_attempt_answers_quiz_attempt_id_foreign` (`quiz_attempt_id`),
  ADD KEY `quiz_attempt_answers_question_id_foreign` (`question_id`),
  ADD KEY `quiz_attempt_answers_question_answer_id_foreign` (`question_answer_id`);

--
-- Indices de la tabla `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reviews_user_id_course_id_unique` (`user_id`,`course_id`),
  ADD KEY `reviews_course_id_foreign` (`course_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indices de la tabla `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_dni_unique` (`dni`),
  ADD KEY `users_legacy_id_index` (`legacy_id`);

--
-- Indices de la tabla `user_point_logs`
--
ALTER TABLE `user_point_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_point_logs_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `course_sections`
--
ALTER TABLE `course_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `lesson_resources`
--
ALTER TABLE `lesson_resources`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `login_activities`
--
ALTER TABLE `login_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `question_answers`
--
ALTER TABLE `question_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `quiz_attempt_answers`
--
ALTER TABLE `quiz_attempt_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `user_point_logs`
--
ALTER TABLE `user_point_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `courses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `course_sections`
--
ALTER TABLE `course_sections`
  ADD CONSTRAINT `course_sections_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrollments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_course_section_id_foreign` FOREIGN KEY (`course_section_id`) REFERENCES `course_sections` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `lesson_resources`
--
ALTER TABLE `lesson_resources`
  ADD CONSTRAINT `lesson_resources_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `lesson_user`
--
ALTER TABLE `lesson_user`
  ADD CONSTRAINT `lesson_user_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lesson_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `login_activities`
--
ALTER TABLE `login_activities`
  ADD CONSTRAINT `login_activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `question_answers`
--
ALTER TABLE `question_answers`
  ADD CONSTRAINT `question_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `quizzes_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quizzes_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  ADD CONSTRAINT `quiz_attempts_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_attempts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `quiz_attempt_answers`
--
ALTER TABLE `quiz_attempt_answers`
  ADD CONSTRAINT `quiz_attempt_answers_question_answer_id_foreign` FOREIGN KEY (`question_answer_id`) REFERENCES `question_answers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_attempt_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_attempt_answers_quiz_attempt_id_foreign` FOREIGN KEY (`quiz_attempt_id`) REFERENCES `quiz_attempts` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `user_point_logs`
--
ALTER TABLE `user_point_logs`
  ADD CONSTRAINT `user_point_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
