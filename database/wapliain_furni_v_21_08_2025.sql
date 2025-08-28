-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 21, 2025 at 11:06 AM
-- Server version: 10.11.13-MariaDB
-- PHP Version: 8.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wapliain_furni`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address_line1` varchar(255) NOT NULL,
  `address_line2` varchar(255) DEFAULT NULL,
  `landmark` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL DEFAULT 'India',
  `pincode` varchar(255) NOT NULL,
  `address_type` enum('home','work','other') NOT NULL DEFAULT 'home',
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `address_line1`, `address_line2`, `landmark`, `city`, `state`, `country`, `pincode`, `address_type`, `is_default`, `created_at`, `updated_at`) VALUES
(3, 7, 'D-12', 'Sector 5, Malviya Nagar', 'Behind Fortis Hospital', 'Jaipur', 'Rajasthan', 'India', '302033', 'home', 0, '2025-08-13 15:31:22', '2025-08-20 10:41:11'),
(5, 6, 'kalwar road champapura', 'we', 'we', 'jaipur', 'rajsthan', 'India', '303706', 'home', 0, '2025-08-14 04:58:59', '2025-08-14 04:58:59'),
(6, 7, '15 Govindpuricolony', 'sikar road', 'nawal tower', 'Jaipur', 'Rajasthan', 'India', '302022', 'work', 0, '2025-08-18 04:16:14', '2025-08-18 04:16:14');

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `account_holder_name` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `ifsc_code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `user_id`, `account_holder_name`, `bank_name`, `account_number`, `ifsc_code`, `created_at`, `updated_at`) VALUES
(4, 9, 'Pawan Verma', 'KKBK', '324', '32', '2025-08-06 05:36:07', '2025-08-06 05:36:07'),
(7, 15, 'Pawan Verma', 'KKBK', '324', '32', '2025-08-11 10:56:24', '2025-08-11 10:56:24'),
(8, 6, 'Pawan Verma', 'KKBK', '324', '32', '2025-08-13 08:55:25', '2025-08-13 08:55:25'),
(9, 7, 'Pawan Verma', 'KKBK', '324', '32', '2025-08-19 08:40:54', '2025-08-19 08:40:54');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-general_settings_all', 'a:10:{s:4:\"logo\";s:62:\"/storage/settings/P1Hy1qQaFbFTVb960OyJ1YRTPhkZaukP8oKUezOi.png\";s:6:\"banner\";s:63:\"/storage/settings/cj0wl6eiiF16rq3N2KRhf7eNsKSABy7MHf6qxKlJ.webp\";s:5:\"email\";s:15:\"admin@gmail.com\";s:9:\"mobile_no\";s:11:\"95621263317\";s:9:\"mini_logo\";s:62:\"/storage/settings/Sbi6w3QxW9cmQwhCkWB2gxtsQ95SZmmSYlA4aOoV.png\";s:12:\"favicon_icon\";s:62:\"/storage/settings/XHsdplI9TgqbJJxWqpuujTaXvgjLEB7FYhM4rJyM.png\";s:4:\"coin\";s:1:\"1\";s:8:\"app_name\";s:9:\"Furniture\";s:15:\"shipping_charge\";s:1:\"0\";s:16:\"Shipping Address\";s:56:\"D-829, Sector 5, Malviya Nagar, Jaipur, Rajasthan 302017\";}', 1755777790);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(2, 'test', 'categories/giN1CNHDn2GGTrYJescUxSrivwVjktMCXMysmVeb.png', '2025-08-05 04:09:28', '2025-08-05 04:09:28'),
(4, 'demo', 'categories/PKmfgrs5kfbmc1XXMLJTMopDzYJKCChqRz5sNSpK.png', '2025-08-06 05:14:34', '2025-08-06 05:14:34'),
(6, 'furniture', 'categories/OuwD7m8CjJFLZwnqqlcpkR14rNPAxwQriC9btvhy.png', '2025-08-12 06:03:06', '2025-08-12 06:03:06'),
(7, 'test', 'categories/cIjzqGJIxpMZKYuJwPD3ne6MHXuJXnVn58wdUrxK.jpg', '2025-08-19 08:48:42', '2025-08-19 08:48:42');

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

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(1, '84a50df9-e1dc-494b-9a98-ff3f9a9631bf', 'database', 'default', '{\"uuid\":\"84a50df9-e1dc-494b-9a98-ff3f9a9631bf\",\"displayName\":\"App\\\\Jobs\\\\SendOrderStatusEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendOrderStatusEmail\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\SendOrderStatusEmail\\\":0:{}\"},\"createdAt\":1755086158,\"delay\":null}', 'ErrorException: Undefined property: App\\Jobs\\SendOrderStatusEmail::$order in /home/wapliain/public_html/furniture.waplia.in/app/Jobs/SendOrderStatusEmail.php:25\nStack trace:\n#0 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Bootstrap/HandleExceptions.php(256): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(2, \'Undefined prope...\', \'/home/wapliain/...\', 25)\n#1 /home/wapliain/public_html/furniture.waplia.in/app/Jobs/SendOrderStatusEmail.php(25): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->Illuminate\\Foundation\\Bootstrap\\{closure}(2, \'Undefined prope...\', \'/home/wapliain/...\', 25)\n#2 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendOrderStatusEmail->handle()\n#3 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#4 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#5 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#6 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Container.php(780): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#7 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Container\\Container->call(Array)\n#8 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(169): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#9 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#10 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(136): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#11 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(134): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\SendOrderStatusEmail), false)\n#12 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(169): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#13 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#14 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(127): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#15 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(68): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\SendOrderStatusEmail))\n#16 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#17 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(444): Illuminate\\Queue\\Jobs\\Job->fire()\n#18 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(394): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#19 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(180): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#20 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#21 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#22 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#23 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#24 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#25 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#26 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Container.php(780): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#27 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Console/Command.php(211): Illuminate\\Container\\Container->call(Array)\n#28 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Command/Command.php(318): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#29 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Console/Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#30 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(1092): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#31 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(341): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#32 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(192): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#33 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(197): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#34 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1234): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#35 /home/wapliain/public_html/furniture.waplia.in/artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#36 {main}', '2025-08-13 11:55:59'),
(2, '357f9289-e504-4b4e-bb60-ba89a622d1fc', 'database', 'default', '{\"uuid\":\"357f9289-e504-4b4e-bb60-ba89a622d1fc\",\"displayName\":\"App\\\\Jobs\\\\SendOrderStatusEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendOrderStatusEmail\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\SendOrderStatusEmail\\\":0:{}\"},\"createdAt\":1755086612,\"delay\":null}', 'ErrorException: Undefined property: App\\Jobs\\SendOrderStatusEmail::$order in /home/wapliain/public_html/furniture.waplia.in/app/Jobs/SendOrderStatusEmail.php:25\nStack trace:\n#0 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Bootstrap/HandleExceptions.php(256): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(2, \'Undefined prope...\', \'/home/wapliain/...\', 25)\n#1 /home/wapliain/public_html/furniture.waplia.in/app/Jobs/SendOrderStatusEmail.php(25): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->Illuminate\\Foundation\\Bootstrap\\{closure}(2, \'Undefined prope...\', \'/home/wapliain/...\', 25)\n#2 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendOrderStatusEmail->handle()\n#3 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#4 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#5 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#6 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Container.php(780): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#7 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Container\\Container->call(Array)\n#8 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(169): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#9 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#10 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(136): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#11 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(134): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\SendOrderStatusEmail), false)\n#12 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(169): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#13 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#14 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(127): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#15 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(68): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\SendOrderStatusEmail))\n#16 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#17 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(444): Illuminate\\Queue\\Jobs\\Job->fire()\n#18 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(394): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#19 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(180): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#20 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#21 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#22 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#23 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#24 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#25 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#26 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Container.php(780): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#27 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Console/Command.php(211): Illuminate\\Container\\Container->call(Array)\n#28 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Command/Command.php(318): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#29 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Console/Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#30 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(1092): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#31 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(341): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#32 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(192): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#33 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(197): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#34 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1234): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#35 /home/wapliain/public_html/furniture.waplia.in/artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#36 {main}', '2025-08-13 12:03:32'),
(3, '3063d209-4d56-4bd9-9084-b70bf18b245d', 'database', 'default', '{\"uuid\":\"3063d209-4d56-4bd9-9084-b70bf18b245d\",\"displayName\":\"App\\\\Jobs\\\\SendOrderStatusEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendOrderStatusEmail\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\SendOrderStatusEmail\\\":0:{}\"},\"createdAt\":1755086616,\"delay\":null}', 'ErrorException: Undefined property: App\\Jobs\\SendOrderStatusEmail::$order in /home/wapliain/public_html/furniture.waplia.in/app/Jobs/SendOrderStatusEmail.php:25\nStack trace:\n#0 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Bootstrap/HandleExceptions.php(256): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(2, \'Undefined prope...\', \'/home/wapliain/...\', 25)\n#1 /home/wapliain/public_html/furniture.waplia.in/app/Jobs/SendOrderStatusEmail.php(25): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->Illuminate\\Foundation\\Bootstrap\\{closure}(2, \'Undefined prope...\', \'/home/wapliain/...\', 25)\n#2 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendOrderStatusEmail->handle()\n#3 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#4 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#5 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#6 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Container.php(780): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#7 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Container\\Container->call(Array)\n#8 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(169): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#9 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#10 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(136): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#11 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(134): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\SendOrderStatusEmail), false)\n#12 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(169): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#13 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#14 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(127): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#15 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(68): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\SendOrderStatusEmail))\n#16 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#17 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(444): Illuminate\\Queue\\Jobs\\Job->fire()\n#18 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(394): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#19 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(180): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#20 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#21 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#22 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#23 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#24 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#25 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#26 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Container.php(780): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#27 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Console/Command.php(211): Illuminate\\Container\\Container->call(Array)\n#28 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Command/Command.php(318): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#29 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Console/Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#30 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(1092): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#31 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(341): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#32 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(192): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#33 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(197): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#34 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1234): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#35 /home/wapliain/public_html/furniture.waplia.in/artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#36 {main}', '2025-08-13 12:03:36'),
(4, '5298042f-115b-432f-8ba1-697e4ba6eba9', 'database', 'default', '{\"uuid\":\"5298042f-115b-432f-8ba1-697e4ba6eba9\",\"displayName\":\"App\\\\Jobs\\\\SendOrderStatusEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendOrderStatusEmail\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\SendOrderStatusEmail\\\":0:{}\"},\"createdAt\":1755086641,\"delay\":null}', 'ErrorException: Undefined property: App\\Jobs\\SendOrderStatusEmail::$order in /home/wapliain/public_html/furniture.waplia.in/app/Jobs/SendOrderStatusEmail.php:25\nStack trace:\n#0 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Bootstrap/HandleExceptions.php(256): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(2, \'Undefined prope...\', \'/home/wapliain/...\', 25)\n#1 /home/wapliain/public_html/furniture.waplia.in/app/Jobs/SendOrderStatusEmail.php(25): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->Illuminate\\Foundation\\Bootstrap\\{closure}(2, \'Undefined prope...\', \'/home/wapliain/...\', 25)\n#2 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendOrderStatusEmail->handle()\n#3 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#4 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#5 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#6 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Container.php(780): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#7 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Container\\Container->call(Array)\n#8 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(169): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#9 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#10 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(136): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#11 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(134): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\SendOrderStatusEmail), false)\n#12 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(169): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#13 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#14 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(127): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#15 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(68): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\SendOrderStatusEmail))\n#16 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#17 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(444): Illuminate\\Queue\\Jobs\\Job->fire()\n#18 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(394): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#19 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(180): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#20 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#21 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#22 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#23 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#24 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#25 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#26 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Container.php(780): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#27 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Console/Command.php(211): Illuminate\\Container\\Container->call(Array)\n#28 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Command/Command.php(318): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#29 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Console/Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#30 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(1092): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#31 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(341): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#32 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(192): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#33 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(197): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#34 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1234): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#35 /home/wapliain/public_html/furniture.waplia.in/artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#36 {main}', '2025-08-13 12:04:02'),
(5, '8c19f6aa-7e2c-422a-b430-da5ae940d294', 'database', 'default', '{\"uuid\":\"8c19f6aa-7e2c-422a-b430-da5ae940d294\",\"displayName\":\"App\\\\Jobs\\\\SendOrderStatusEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendOrderStatusEmail\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\SendOrderStatusEmail\\\":0:{}\"},\"createdAt\":1755086721,\"delay\":null}', 'ErrorException: Undefined property: App\\Jobs\\SendOrderStatusEmail::$order in /home/wapliain/public_html/furniture.waplia.in/app/Jobs/SendOrderStatusEmail.php:25\nStack trace:\n#0 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Bootstrap/HandleExceptions.php(256): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(2, \'Undefined prope...\', \'/home/wapliain/...\', 25)\n#1 /home/wapliain/public_html/furniture.waplia.in/app/Jobs/SendOrderStatusEmail.php(25): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->Illuminate\\Foundation\\Bootstrap\\{closure}(2, \'Undefined prope...\', \'/home/wapliain/...\', 25)\n#2 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendOrderStatusEmail->handle()\n#3 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#4 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#5 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#6 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Container.php(780): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#7 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Container\\Container->call(Array)\n#8 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(169): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#9 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#10 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(136): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#11 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(134): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\SendOrderStatusEmail), false)\n#12 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(169): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#13 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#14 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(127): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#15 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(68): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\SendOrderStatusEmail))\n#16 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#17 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(444): Illuminate\\Queue\\Jobs\\Job->fire()\n#18 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(394): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#19 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(180): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#20 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#21 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#22 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#23 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#24 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#25 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#26 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Container.php(780): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#27 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Console/Command.php(211): Illuminate\\Container\\Container->call(Array)\n#28 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Command/Command.php(318): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#29 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Console/Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#30 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(1092): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#31 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(341): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#32 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(192): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#33 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(197): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#34 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1234): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#35 /home/wapliain/public_html/furniture.waplia.in/artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#36 {main}', '2025-08-13 12:05:21');
INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(6, '6ca6fc9f-07e9-4319-a193-1ffa3f5972d2', 'database', 'default', '{\"uuid\":\"6ca6fc9f-07e9-4319-a193-1ffa3f5972d2\",\"displayName\":\"App\\\\Jobs\\\\SendOrderStatusEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendOrderStatusEmail\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\SendOrderStatusEmail\\\":0:{}\"},\"createdAt\":1755088782,\"delay\":null}', 'ErrorException: Undefined property: App\\Jobs\\SendOrderStatusEmail::$order in /home/wapliain/public_html/furniture.waplia.in/app/Jobs/SendOrderStatusEmail.php:25\nStack trace:\n#0 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Bootstrap/HandleExceptions.php(256): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(2, \'Undefined prope...\', \'/home/wapliain/...\', 25)\n#1 /home/wapliain/public_html/furniture.waplia.in/app/Jobs/SendOrderStatusEmail.php(25): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->Illuminate\\Foundation\\Bootstrap\\{closure}(2, \'Undefined prope...\', \'/home/wapliain/...\', 25)\n#2 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendOrderStatusEmail->handle()\n#3 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#4 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#5 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#6 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Container.php(780): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#7 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Container\\Container->call(Array)\n#8 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(169): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#9 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#10 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(136): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#11 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(134): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\SendOrderStatusEmail), false)\n#12 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(169): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#13 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#14 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(127): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#15 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(68): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\SendOrderStatusEmail))\n#16 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#17 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(444): Illuminate\\Queue\\Jobs\\Job->fire()\n#18 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(394): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#19 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(180): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#20 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#21 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#22 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#23 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#24 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#25 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#26 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Container.php(780): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#27 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Console/Command.php(211): Illuminate\\Container\\Container->call(Array)\n#28 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Command/Command.php(318): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#29 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Console/Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#30 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(1092): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#31 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(341): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#32 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(192): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#33 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(197): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#34 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1234): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#35 /home/wapliain/public_html/furniture.waplia.in/artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#36 {main}', '2025-08-13 12:39:42'),
(7, '704b1570-51fa-4487-bbf0-f51119e4ec2e', 'database', 'default', '{\"uuid\":\"704b1570-51fa-4487-bbf0-f51119e4ec2e\",\"displayName\":\"App\\\\Jobs\\\\SendOrderStatusEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendOrderStatusEmail\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\SendOrderStatusEmail\\\":1:{s:8:\\\"\\u0000*\\u0000order\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:16:\\\"App\\\\Models\\\\Order\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"},\"createdAt\":1755088945,\"delay\":null}', 'ErrorException: Undefined variable $order in /home/wapliain/public_html/furniture.waplia.in/storage/framework/views/d1488a5ecb5f2aa62f1a9957aae72a01.php:2\nStack trace:\n#0 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Bootstrap/HandleExceptions.php(256): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(2, \'Undefined varia...\', \'/home/wapliain/...\', 2)\n#1 /home/wapliain/public_html/furniture.waplia.in/storage/framework/views/d1488a5ecb5f2aa62f1a9957aae72a01.php(2): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->Illuminate\\Foundation\\Bootstrap\\{closure}(2, \'Undefined varia...\', \'/home/wapliain/...\', 2)\n#2 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Filesystem/Filesystem.php(123): require(\'/home/wapliain/...\')\n#3 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Filesystem/Filesystem.php(124): Illuminate\\Filesystem\\Filesystem::Illuminate\\Filesystem\\{closure}()\n#4 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/Engines/PhpEngine.php(57): Illuminate\\Filesystem\\Filesystem->getRequire(\'/home/wapliain/...\', Array)\n#5 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/Engines/CompilerEngine.php(76): Illuminate\\View\\Engines\\PhpEngine->evaluatePath(\'/home/wapliain/...\', Array)\n#6 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/View.php(208): Illuminate\\View\\Engines\\CompilerEngine->get(\'/home/wapliain/...\', Array)\n#7 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/View.php(191): Illuminate\\View\\View->getContents()\n#8 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/View.php(160): Illuminate\\View\\View->renderContents()\n#9 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Markdown.php(93): Illuminate\\View\\View->render()\n#10 [internal function]: Illuminate\\Mail\\Markdown->Illuminate\\Mail\\{closure}()\n#11 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/Compilers/BladeCompiler.php(1035): call_user_func(Object(Closure))\n#12 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Markdown.php(75): Illuminate\\View\\Compilers\\BladeCompiler->usingEchoFormat(\'new \\\\Illuminate...\', Object(Closure))\n#13 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(380): Illuminate\\Mail\\Markdown->render(\'emails.order-st...\', Array)\n#14 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Collections/helpers.php(236): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}(Array)\n#15 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(440): value(Object(Closure), Array)\n#16 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(419): Illuminate\\Mail\\Mailer->renderView(Object(Closure), Array)\n#17 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(312): Illuminate\\Mail\\Mailer->addContent(Object(Illuminate\\Mail\\Message), Object(Closure), Object(Closure), NULL, Array)\n#18 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(207): Illuminate\\Mail\\Mailer->send(Object(Closure), Array, Object(Closure))\n#19 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#20 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(200): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#21 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(353): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\Mailer))\n#22 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(300): Illuminate\\Mail\\Mailer->sendMailable(Object(App\\Mail\\OrderStatusUpdated))\n#23 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/PendingMail.php(123): Illuminate\\Mail\\Mailer->send(Object(App\\Mail\\OrderStatusUpdated))\n#24 /home/wapliain/public_html/furniture.waplia.in/app/Jobs/SendOrderStatusEmail.php(35): Illuminate\\Mail\\PendingMail->send(Object(App\\Mail\\OrderStatusUpdated))\n#25 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendOrderStatusEmail->handle()\n#26 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#27 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#28 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#29 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Container.php(780): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#30 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Container\\Container->call(Array)\n#31 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(169): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#32 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#33 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(136): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#34 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(134): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\SendOrderStatusEmail), false)\n#35 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(169): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#36 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#37 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(127): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#38 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(68): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\SendOrderStatusEmail))\n#39 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#40 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(444): Illuminate\\Queue\\Jobs\\Job->fire()\n#41 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(394): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#42 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(180): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#43 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#44 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#45 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#46 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#47 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#48 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#49 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Container.php(780): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#50 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Console/Command.php(211): Illuminate\\Container\\Container->call(Array)\n#51 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Command/Command.php(318): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#52 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Console/Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#53 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(1092): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#54 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(341): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#55 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(192): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#56 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(197): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#57 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1234): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#58 /home/wapliain/public_html/furniture.waplia.in/artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#59 {main}\n\nNext Illuminate\\View\\ViewException: Undefined variable $order (View: /home/wapliain/public_html/furniture.waplia.in/resources/views/emails/order-status-updated.blade.php) in /home/wapliain/public_html/furniture.waplia.in/storage/framework/views/d1488a5ecb5f2aa62f1a9957aae72a01.php:2\nStack trace:\n#0 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/Engines/PhpEngine.php(59): Illuminate\\View\\Engines\\CompilerEngine->handleViewException(Object(ErrorException), 0)\n#1 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/Engines/CompilerEngine.php(76): Illuminate\\View\\Engines\\PhpEngine->evaluatePath(\'/home/wapliain/...\', Array)\n#2 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/View.php(208): Illuminate\\View\\Engines\\CompilerEngine->get(\'/home/wapliain/...\', Array)\n#3 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/View.php(191): Illuminate\\View\\View->getContents()\n#4 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/View.php(160): Illuminate\\View\\View->renderContents()\n#5 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Markdown.php(93): Illuminate\\View\\View->render()\n#6 [internal function]: Illuminate\\Mail\\Markdown->Illuminate\\Mail\\{closure}()\n#7 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/Compilers/BladeCompiler.php(1035): call_user_func(Object(Closure))\n#8 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Markdown.php(75): Illuminate\\View\\Compilers\\BladeCompiler->usingEchoFormat(\'new \\\\Illuminate...\', Object(Closure))\n#9 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(380): Illuminate\\Mail\\Markdown->render(\'emails.order-st...\', Array)\n#10 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Collections/helpers.php(236): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}(Array)\n#11 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(440): value(Object(Closure), Array)\n#12 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(419): Illuminate\\Mail\\Mailer->renderView(Object(Closure), Array)\n#13 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(312): Illuminate\\Mail\\Mailer->addContent(Object(Illuminate\\Mail\\Message), Object(Closure), Object(Closure), NULL, Array)\n#14 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(207): Illuminate\\Mail\\Mailer->send(Object(Closure), Array, Object(Closure))\n#15 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#16 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(200): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#17 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(353): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\Mailer))\n#18 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(300): Illuminate\\Mail\\Mailer->sendMailable(Object(App\\Mail\\OrderStatusUpdated))\n#19 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/PendingMail.php(123): Illuminate\\Mail\\Mailer->send(Object(App\\Mail\\OrderStatusUpdated))\n#20 /home/wapliain/public_html/furniture.waplia.in/app/Jobs/SendOrderStatusEmail.php(35): Illuminate\\Mail\\PendingMail->send(Object(App\\Mail\\OrderStatusUpdated))\n#21 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendOrderStatusEmail->handle()\n#22 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#23 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#24 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#25 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Container.php(780): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#26 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Container\\Container->call(Array)\n#27 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(169): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#28 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#29 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(136): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#30 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(134): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\SendOrderStatusEmail), false)\n#31 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(169): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#32 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#33 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(127): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#34 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(68): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\SendOrderStatusEmail))\n#35 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#36 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(444): Illuminate\\Queue\\Jobs\\Job->fire()\n#37 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(394): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#38 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(180): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#39 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#40 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#41 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#42 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#43 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#44 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#45 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Container.php(780): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#46 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Console/Command.php(211): Illuminate\\Container\\Container->call(Array)\n#47 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Command/Command.php(318): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#48 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Console/Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#49 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(1092): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#50 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(341): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#51 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(192): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#52 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(197): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#53 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1234): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#54 /home/wapliain/public_html/furniture.waplia.in/artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#55 {main}', '2025-08-13 12:42:25');
INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(8, '3c9da587-e39e-4aa3-9300-0f324c4c775a', 'database', 'default', '{\"uuid\":\"3c9da587-e39e-4aa3-9300-0f324c4c775a\",\"displayName\":\"App\\\\Jobs\\\\SendOrderStatusEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendOrderStatusEmail\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\SendOrderStatusEmail\\\":1:{s:8:\\\"\\u0000*\\u0000order\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:16:\\\"App\\\\Models\\\\Order\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"},\"createdAt\":1755089226,\"delay\":null}', 'ErrorException: Undefined variable $order in /home/wapliain/public_html/furniture.waplia.in/storage/framework/views/d1488a5ecb5f2aa62f1a9957aae72a01.php:2\nStack trace:\n#0 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Bootstrap/HandleExceptions.php(256): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(2, \'Undefined varia...\', \'/home/wapliain/...\', 2)\n#1 /home/wapliain/public_html/furniture.waplia.in/storage/framework/views/d1488a5ecb5f2aa62f1a9957aae72a01.php(2): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->Illuminate\\Foundation\\Bootstrap\\{closure}(2, \'Undefined varia...\', \'/home/wapliain/...\', 2)\n#2 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Filesystem/Filesystem.php(123): require(\'/home/wapliain/...\')\n#3 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Filesystem/Filesystem.php(124): Illuminate\\Filesystem\\Filesystem::Illuminate\\Filesystem\\{closure}()\n#4 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/Engines/PhpEngine.php(57): Illuminate\\Filesystem\\Filesystem->getRequire(\'/home/wapliain/...\', Array)\n#5 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/Engines/CompilerEngine.php(76): Illuminate\\View\\Engines\\PhpEngine->evaluatePath(\'/home/wapliain/...\', Array)\n#6 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/View.php(208): Illuminate\\View\\Engines\\CompilerEngine->get(\'/home/wapliain/...\', Array)\n#7 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/View.php(191): Illuminate\\View\\View->getContents()\n#8 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/View.php(160): Illuminate\\View\\View->renderContents()\n#9 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Markdown.php(93): Illuminate\\View\\View->render()\n#10 [internal function]: Illuminate\\Mail\\Markdown->Illuminate\\Mail\\{closure}()\n#11 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/Compilers/BladeCompiler.php(1035): call_user_func(Object(Closure))\n#12 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Markdown.php(75): Illuminate\\View\\Compilers\\BladeCompiler->usingEchoFormat(\'new \\\\Illuminate...\', Object(Closure))\n#13 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(380): Illuminate\\Mail\\Markdown->render(\'emails.order-st...\', Array)\n#14 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Collections/helpers.php(236): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}(Array)\n#15 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(440): value(Object(Closure), Array)\n#16 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(419): Illuminate\\Mail\\Mailer->renderView(Object(Closure), Array)\n#17 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(312): Illuminate\\Mail\\Mailer->addContent(Object(Illuminate\\Mail\\Message), Object(Closure), Object(Closure), NULL, Array)\n#18 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(207): Illuminate\\Mail\\Mailer->send(Object(Closure), Array, Object(Closure))\n#19 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#20 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(200): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#21 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(353): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\Mailer))\n#22 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(300): Illuminate\\Mail\\Mailer->sendMailable(Object(App\\Mail\\OrderStatusUpdated))\n#23 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/PendingMail.php(123): Illuminate\\Mail\\Mailer->send(Object(App\\Mail\\OrderStatusUpdated))\n#24 /home/wapliain/public_html/furniture.waplia.in/app/Jobs/SendOrderStatusEmail.php(35): Illuminate\\Mail\\PendingMail->send(Object(App\\Mail\\OrderStatusUpdated))\n#25 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendOrderStatusEmail->handle()\n#26 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#27 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#28 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#29 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Container.php(780): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#30 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Container\\Container->call(Array)\n#31 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(169): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#32 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#33 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(136): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#34 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(134): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\SendOrderStatusEmail), false)\n#35 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(169): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#36 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#37 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(127): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#38 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(68): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\SendOrderStatusEmail))\n#39 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#40 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(444): Illuminate\\Queue\\Jobs\\Job->fire()\n#41 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(394): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#42 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(180): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#43 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#44 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#45 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#46 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#47 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#48 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#49 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Container.php(780): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#50 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Console/Command.php(211): Illuminate\\Container\\Container->call(Array)\n#51 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Command/Command.php(318): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#52 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Console/Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#53 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(1092): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#54 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(341): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#55 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(192): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#56 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(197): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#57 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1234): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#58 /home/wapliain/public_html/furniture.waplia.in/artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#59 {main}\n\nNext Illuminate\\View\\ViewException: Undefined variable $order (View: /home/wapliain/public_html/furniture.waplia.in/resources/views/emails/order-status-updated.blade.php) in /home/wapliain/public_html/furniture.waplia.in/storage/framework/views/d1488a5ecb5f2aa62f1a9957aae72a01.php:2\nStack trace:\n#0 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/Engines/PhpEngine.php(59): Illuminate\\View\\Engines\\CompilerEngine->handleViewException(Object(ErrorException), 0)\n#1 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/Engines/CompilerEngine.php(76): Illuminate\\View\\Engines\\PhpEngine->evaluatePath(\'/home/wapliain/...\', Array)\n#2 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/View.php(208): Illuminate\\View\\Engines\\CompilerEngine->get(\'/home/wapliain/...\', Array)\n#3 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/View.php(191): Illuminate\\View\\View->getContents()\n#4 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/View.php(160): Illuminate\\View\\View->renderContents()\n#5 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Markdown.php(93): Illuminate\\View\\View->render()\n#6 [internal function]: Illuminate\\Mail\\Markdown->Illuminate\\Mail\\{closure}()\n#7 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/Compilers/BladeCompiler.php(1035): call_user_func(Object(Closure))\n#8 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Markdown.php(75): Illuminate\\View\\Compilers\\BladeCompiler->usingEchoFormat(\'new \\\\Illuminate...\', Object(Closure))\n#9 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(380): Illuminate\\Mail\\Markdown->render(\'emails.order-st...\', Array)\n#10 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Collections/helpers.php(236): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}(Array)\n#11 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(440): value(Object(Closure), Array)\n#12 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(419): Illuminate\\Mail\\Mailer->renderView(Object(Closure), Array)\n#13 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(312): Illuminate\\Mail\\Mailer->addContent(Object(Illuminate\\Mail\\Message), Object(Closure), Object(Closure), NULL, Array)\n#14 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(207): Illuminate\\Mail\\Mailer->send(Object(Closure), Array, Object(Closure))\n#15 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#16 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(200): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#17 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(353): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\Mailer))\n#18 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(300): Illuminate\\Mail\\Mailer->sendMailable(Object(App\\Mail\\OrderStatusUpdated))\n#19 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/PendingMail.php(123): Illuminate\\Mail\\Mailer->send(Object(App\\Mail\\OrderStatusUpdated))\n#20 /home/wapliain/public_html/furniture.waplia.in/app/Jobs/SendOrderStatusEmail.php(35): Illuminate\\Mail\\PendingMail->send(Object(App\\Mail\\OrderStatusUpdated))\n#21 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendOrderStatusEmail->handle()\n#22 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#23 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#24 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#25 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Container.php(780): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#26 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Container\\Container->call(Array)\n#27 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(169): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#28 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#29 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(136): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#30 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(134): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\SendOrderStatusEmail), false)\n#31 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(169): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#32 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#33 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(127): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#34 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(68): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\SendOrderStatusEmail))\n#35 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#36 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(444): Illuminate\\Queue\\Jobs\\Job->fire()\n#37 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(394): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#38 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(180): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#39 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#40 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#41 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#42 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#43 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#44 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#45 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Container.php(780): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#46 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Console/Command.php(211): Illuminate\\Container\\Container->call(Array)\n#47 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Command/Command.php(318): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#48 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Console/Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#49 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(1092): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#50 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(341): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#51 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(192): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#52 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(197): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#53 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1234): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#54 /home/wapliain/public_html/furniture.waplia.in/artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#55 {main}', '2025-08-13 12:47:06'),
(9, '113246b1-4ed8-4811-8d63-c5b1ead5c029', 'database', 'default', '{\"uuid\":\"113246b1-4ed8-4811-8d63-c5b1ead5c029\",\"displayName\":\"App\\\\Jobs\\\\SendOrderStatusEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendOrderStatusEmail\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\SendOrderStatusEmail\\\":1:{s:8:\\\"\\u0000*\\u0000order\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:16:\\\"App\\\\Models\\\\Order\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"},\"createdAt\":1755089256,\"delay\":null}', 'ErrorException: Undefined variable $order in /home/wapliain/public_html/furniture.waplia.in/storage/framework/views/d1488a5ecb5f2aa62f1a9957aae72a01.php:2\nStack trace:\n#0 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Bootstrap/HandleExceptions.php(256): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(2, \'Undefined varia...\', \'/home/wapliain/...\', 2)\n#1 /home/wapliain/public_html/furniture.waplia.in/storage/framework/views/d1488a5ecb5f2aa62f1a9957aae72a01.php(2): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->Illuminate\\Foundation\\Bootstrap\\{closure}(2, \'Undefined varia...\', \'/home/wapliain/...\', 2)\n#2 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Filesystem/Filesystem.php(123): require(\'/home/wapliain/...\')\n#3 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Filesystem/Filesystem.php(124): Illuminate\\Filesystem\\Filesystem::Illuminate\\Filesystem\\{closure}()\n#4 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/Engines/PhpEngine.php(57): Illuminate\\Filesystem\\Filesystem->getRequire(\'/home/wapliain/...\', Array)\n#5 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/Engines/CompilerEngine.php(76): Illuminate\\View\\Engines\\PhpEngine->evaluatePath(\'/home/wapliain/...\', Array)\n#6 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/View.php(208): Illuminate\\View\\Engines\\CompilerEngine->get(\'/home/wapliain/...\', Array)\n#7 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/View.php(191): Illuminate\\View\\View->getContents()\n#8 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/View.php(160): Illuminate\\View\\View->renderContents()\n#9 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Markdown.php(93): Illuminate\\View\\View->render()\n#10 [internal function]: Illuminate\\Mail\\Markdown->Illuminate\\Mail\\{closure}()\n#11 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/Compilers/BladeCompiler.php(1035): call_user_func(Object(Closure))\n#12 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Markdown.php(75): Illuminate\\View\\Compilers\\BladeCompiler->usingEchoFormat(\'new \\\\Illuminate...\', Object(Closure))\n#13 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(380): Illuminate\\Mail\\Markdown->render(\'emails.order-st...\', Array)\n#14 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Collections/helpers.php(236): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}(Array)\n#15 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(440): value(Object(Closure), Array)\n#16 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(419): Illuminate\\Mail\\Mailer->renderView(Object(Closure), Array)\n#17 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(312): Illuminate\\Mail\\Mailer->addContent(Object(Illuminate\\Mail\\Message), Object(Closure), Object(Closure), NULL, Array)\n#18 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(207): Illuminate\\Mail\\Mailer->send(Object(Closure), Array, Object(Closure))\n#19 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#20 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(200): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#21 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(353): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\Mailer))\n#22 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(300): Illuminate\\Mail\\Mailer->sendMailable(Object(App\\Mail\\OrderStatusUpdated))\n#23 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/PendingMail.php(123): Illuminate\\Mail\\Mailer->send(Object(App\\Mail\\OrderStatusUpdated))\n#24 /home/wapliain/public_html/furniture.waplia.in/app/Jobs/SendOrderStatusEmail.php(35): Illuminate\\Mail\\PendingMail->send(Object(App\\Mail\\OrderStatusUpdated))\n#25 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendOrderStatusEmail->handle()\n#26 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#27 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#28 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#29 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Container.php(780): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#30 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Container\\Container->call(Array)\n#31 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(169): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#32 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#33 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(136): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#34 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(134): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\SendOrderStatusEmail), false)\n#35 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(169): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#36 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#37 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(127): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#38 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(68): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\SendOrderStatusEmail))\n#39 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#40 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(444): Illuminate\\Queue\\Jobs\\Job->fire()\n#41 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(394): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#42 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(180): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#43 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#44 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#45 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#46 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#47 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#48 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#49 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Container.php(780): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#50 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Console/Command.php(211): Illuminate\\Container\\Container->call(Array)\n#51 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Command/Command.php(318): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#52 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Console/Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#53 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(1092): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#54 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(341): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#55 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(192): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#56 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(197): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#57 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1234): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#58 /home/wapliain/public_html/furniture.waplia.in/artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#59 {main}\n\nNext Illuminate\\View\\ViewException: Undefined variable $order (View: /home/wapliain/public_html/furniture.waplia.in/resources/views/emails/order-status-updated.blade.php) in /home/wapliain/public_html/furniture.waplia.in/storage/framework/views/d1488a5ecb5f2aa62f1a9957aae72a01.php:2\nStack trace:\n#0 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/Engines/PhpEngine.php(59): Illuminate\\View\\Engines\\CompilerEngine->handleViewException(Object(ErrorException), 0)\n#1 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/Engines/CompilerEngine.php(76): Illuminate\\View\\Engines\\PhpEngine->evaluatePath(\'/home/wapliain/...\', Array)\n#2 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/View.php(208): Illuminate\\View\\Engines\\CompilerEngine->get(\'/home/wapliain/...\', Array)\n#3 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/View.php(191): Illuminate\\View\\View->getContents()\n#4 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/View.php(160): Illuminate\\View\\View->renderContents()\n#5 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Markdown.php(93): Illuminate\\View\\View->render()\n#6 [internal function]: Illuminate\\Mail\\Markdown->Illuminate\\Mail\\{closure}()\n#7 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/View/Compilers/BladeCompiler.php(1035): call_user_func(Object(Closure))\n#8 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Markdown.php(75): Illuminate\\View\\Compilers\\BladeCompiler->usingEchoFormat(\'new \\\\Illuminate...\', Object(Closure))\n#9 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(380): Illuminate\\Mail\\Markdown->render(\'emails.order-st...\', Array)\n#10 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Collections/helpers.php(236): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}(Array)\n#11 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(440): value(Object(Closure), Array)\n#12 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(419): Illuminate\\Mail\\Mailer->renderView(Object(Closure), Array)\n#13 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(312): Illuminate\\Mail\\Mailer->addContent(Object(Illuminate\\Mail\\Message), Object(Closure), Object(Closure), NULL, Array)\n#14 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(207): Illuminate\\Mail\\Mailer->send(Object(Closure), Array, Object(Closure))\n#15 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#16 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(200): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#17 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(353): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\Mailer))\n#18 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(300): Illuminate\\Mail\\Mailer->sendMailable(Object(App\\Mail\\OrderStatusUpdated))\n#19 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Mail/PendingMail.php(123): Illuminate\\Mail\\Mailer->send(Object(App\\Mail\\OrderStatusUpdated))\n#20 /home/wapliain/public_html/furniture.waplia.in/app/Jobs/SendOrderStatusEmail.php(35): Illuminate\\Mail\\PendingMail->send(Object(App\\Mail\\OrderStatusUpdated))\n#21 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendOrderStatusEmail->handle()\n#22 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#23 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#24 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#25 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Container.php(780): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#26 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Container\\Container->call(Array)\n#27 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(169): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#28 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#29 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(136): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#30 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(134): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\SendOrderStatusEmail), false)\n#31 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(169): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#32 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(126): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendOrderStatusEmail))\n#33 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(127): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#34 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(68): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\SendOrderStatusEmail))\n#35 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#36 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(444): Illuminate\\Queue\\Jobs\\Job->fire()\n#37 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(394): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#38 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(180): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#39 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#40 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#41 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#42 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#43 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#44 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#45 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Container/Container.php(780): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#46 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Console/Command.php(211): Illuminate\\Container\\Container->call(Array)\n#47 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Command/Command.php(318): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#48 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Console/Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#49 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(1092): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#50 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(341): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#51 /home/wapliain/public_html/furniture.waplia.in/vendor/symfony/console/Application.php(192): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#52 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(197): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#53 /home/wapliain/public_html/furniture.waplia.in/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1234): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#54 /home/wapliain/public_html/furniture.waplia.in/artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#55 {main}', '2025-08-13 12:47:36');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'text'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `key`, `value`, `created_at`, `updated_at`, `type`) VALUES
(1, 'logo', 'settings/P1Hy1qQaFbFTVb960OyJ1YRTPhkZaukP8oKUezOi.png', '2025-08-01 04:39:37', '2025-08-05 05:18:02', 'image'),
(2, 'banner', 'settings/cj0wl6eiiF16rq3N2KRhf7eNsKSABy7MHf6qxKlJ.webp', '2025-08-01 05:37:55', '2025-08-05 05:28:05', 'image'),
(3, 'email', 'admin@gmail.com', '2025-08-01 05:40:45', '2025-08-05 05:39:18', 'text'),
(4, 'mobile_no', '95621263317', '2025-08-01 05:41:05', '2025-08-01 05:41:05', 'text'),
(6, 'mini_logo', 'settings/Sbi6w3QxW9cmQwhCkWB2gxtsQ95SZmmSYlA4aOoV.png', '2025-08-01 06:23:36', '2025-08-05 05:10:12', 'image'),
(7, 'favicon_icon', 'settings/XHsdplI9TgqbJJxWqpuujTaXvgjLEB7FYhM4rJyM.png', '2025-08-01 06:24:56', '2025-08-01 06:24:56', 'image'),
(8, 'coin', '1', '2025-08-03 01:26:26', '2025-08-11 10:52:58', 'text'),
(10, 'app_name', 'Furniture', '2025-08-05 09:56:11', '2025-08-05 09:56:11', 'text'),
(11, 'shipping_charge', '0', '2025-08-19 06:54:33', '2025-08-19 06:54:33', 'text'),
(12, 'Shipping Address', 'D-829, Sector 5, Malviya Nagar, Jaipur, Rajasthan 302017', '2025-08-21 06:53:08', '2025-08-21 06:53:08', 'text');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_07_31_062304_add_wallet_and_role_to_users_table', 1),
(5, '2025_07_31_062351_create_categories_table', 1),
(6, '2025_07_31_062409_create_products_table', 1),
(7, '2025_07_31_062437_create_product_user_scans_table', 1),
(8, '2025_07_31_063515_create_product_qr_codes_table', 1),
(9, '2025_07_31_123438_create_general_settings_table', 2),
(10, '2025_08_01_060055_create_wallet_transactions_table', 3),
(11, '2025_08_01_103125_add_type_to_general_settings_table', 4),
(12, '2025_08_01_125434_create_permission_tables', 5),
(13, '2025_08_02_082118_create_permission_tables', 6),
(14, '2025_08_03_040337_create_bank_accounts_table', 7),
(18, '2025_08_05_124222_add_image_to_users_table', 9),
(24, '2025_08_05_145845_remove_image_from_users_table', 10),
(30, '2025_08_03_043803_add_status_to_wallet_transactions_table', 11),
(31, '2025_08_11_152442_add_mobile_to_users_table', 12),
(32, '2025_08_13_053459_create_product_catalog_table', 13),
(33, '2025_08_13_053700_create_addresses_table', 13),
(34, '2025_08_13_054110_create_order_items_table', 13),
(35, '2025_08_13_061711_create_product_lists_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 3),
(1, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 9),
(2, 'App\\Models\\User', 10),
(2, 'App\\Models\\User', 11),
(2, 'App\\Models\\User', 12),
(2, 'App\\Models\\User', 13),
(2, 'App\\Models\\User', 14),
(2, 'App\\Models\\User', 15),
(2, 'App\\Models\\User', 16),
(2, 'App\\Models\\User', 17),
(2, 'App\\Models\\User', 18),
(2, 'App\\Models\\User', 19),
(2, 'App\\Models\\User', 20),
(2, 'App\\Models\\User', 21),
(2, 'App\\Models\\User', 22);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address_id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `product_name` text NOT NULL,
  `product_amount` decimal(10,2) NOT NULL,
  `shipping_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` enum('cod','online','wallet') NOT NULL DEFAULT 'cod',
  `payment_status` enum('pending','paid','failed','refunded') NOT NULL DEFAULT 'pending',
  `order_status` enum('pending','processing','shipped','delivered','cancelled','returned') NOT NULL DEFAULT 'pending',
  `ordered_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `txn_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `address_id`, `address`, `order_number`, `product_name`, `product_amount`, `shipping_charge`, `total_amount`, `payment_method`, `payment_status`, `order_status`, `ordered_at`, `delivered_at`, `created_at`, `updated_at`, `txn_id`) VALUES
(2, 7, 3, 'D-12, Jaipur, Rajasthan, India, 302033', 'ORD-689DB5B23C65E', 'test product catalog2', 120.00, 50.00, 170.00, 'wallet', 'pending', 'cancelled', '2025-08-14 10:08:50', NULL, '2025-08-14 10:08:50', '2025-08-19 11:49:09', NULL),
(3, 7, 3, 'D-12, Jaipur, Rajasthan, India, 302033', 'ORD-689DB5B356C70', 'test product catalog2', 120.00, 50.00, 170.00, 'wallet', 'pending', 'cancelled', '2025-08-14 10:08:51', NULL, '2025-08-14 10:08:51', '2025-08-19 11:50:28', NULL),
(6, 7, 3, 'D-12, Jaipur, Rajasthan, India, 302033', 'ORD-689E142285D3E', 'test product catalog2', 120.00, 50.00, 170.00, 'wallet', 'pending', 'pending', '2025-08-14 16:51:46', NULL, '2025-08-14 16:51:46', '2025-08-14 16:51:46', NULL),
(7, 7, 3, 'D-12, Jaipur, Rajasthan, India, 302033', 'ORD-689E14354A554', 'test1', 3.00, 50.00, 53.00, 'wallet', 'pending', 'pending', '2025-08-14 16:52:05', NULL, '2025-08-14 16:52:05', '2025-08-14 16:52:05', NULL),
(8, 6, 5, 'kalwar road champapura, jaipur, rajsthan, India, 303706', 'ORD-689EB7236CC8B', 'test1', 3.00, 50.00, 53.00, 'wallet', 'pending', 'pending', '2025-08-15 04:27:15', NULL, '2025-08-15 04:27:15', '2025-08-15 04:27:15', NULL),
(9, 6, 5, 'kalwar road champapura, jaipur, rajsthan, India, 303706', 'ORD-689EB8B0AD570', 'test product catalog2', 120.00, 50.00, 170.00, 'wallet', 'pending', 'pending', '2025-08-15 04:33:52', NULL, '2025-08-15 04:33:52', '2025-08-15 04:33:52', NULL),
(10, 6, 5, 'kalwar road champapura, jaipur, rajsthan, India, 303706', 'ORD-689EB99AB08FD', 'test1', 3.00, 50.00, 53.00, 'wallet', 'pending', 'pending', '2025-08-15 04:37:46', NULL, '2025-08-15 04:37:46', '2025-08-15 04:37:46', NULL),
(11, 6, 5, 'kalwar road champapura, jaipur, rajsthan, India, 303706', 'ORD-689EB9FDEBA34', 'test product catalog2', 120.00, 50.00, 170.00, 'wallet', 'pending', 'pending', '2025-08-15 04:39:25', NULL, '2025-08-15 04:39:25', '2025-08-15 04:39:25', NULL),
(12, 6, 5, 'kalwar road champapura, jaipur, rajsthan, India, 303706', 'ORD-689EBB4CA06E8', 'test product catalog2', 120.00, 50.00, 170.00, 'wallet', 'pending', 'processing', '2025-08-15 04:45:00', NULL, '2025-08-15 04:45:00', '2025-08-19 06:49:50', NULL),
(13, 6, 5, 'kalwar road champapura, jaipur, rajsthan, India, 303706', 'ORD-689EBCBC2FAB2', 'test1', 3.00, 50.00, 53.00, 'wallet', 'pending', 'pending', '2025-08-15 04:51:08', NULL, '2025-08-15 04:51:08', '2025-08-15 04:51:08', NULL),
(14, 7, 6, '15 Govindpuricolony, Jaipur, Rajasthan, India, 302022', 'ORD-68A2A91D8AD9D', 'test product catalog2', 120.00, 50.00, 170.00, 'wallet', 'pending', 'processing', '2025-08-18 04:16:29', NULL, '2025-08-18 04:16:29', '2025-08-18 05:40:13', NULL),
(15, 7, 6, '15 Govindpuricolony, Jaipur, Rajasthan, India, 302022', 'ORD-68A2AE479C6BC', 'test product catalog2', 120.00, 50.00, 170.00, 'wallet', 'pending', 'cancelled', '2025-08-18 04:38:31', NULL, '2025-08-18 04:38:31', '2025-08-19 12:15:59', NULL),
(16, 7, 3, 'D-12, Jaipur, Rajasthan, India, 302033', 'ORD-68A2B6DB7CCB5', 'test product catalog2', 120.00, 50.00, 170.00, 'wallet', 'pending', 'processing', '2025-08-18 05:15:07', NULL, '2025-08-18 05:15:07', '2025-08-19 12:30:57', NULL),
(17, 7, 3, 'D-12, Jaipur, Rajasthan, India, 302033', 'ORD-68A2B6DD47267', 'test product catalog2', 120.00, 50.00, 170.00, 'wallet', 'pending', 'delivered', '2025-08-18 05:15:09', '2025-08-19 10:31:40', '2025-08-18 05:15:09', '2025-08-19 10:31:40', NULL),
(18, 7, 3, 'D-12, Jaipur, Rajasthan, India, 302033', 'ORD-68A2B6DD78185', 'test product catalog2', 120.00, 50.00, 170.00, 'wallet', 'pending', 'delivered', '2025-08-18 05:15:09', '2025-08-19 12:29:40', '2025-08-18 05:15:09', '2025-08-19 12:29:40', NULL),
(19, 7, 3, 'D-12, Jaipur, Rajasthan, India, 302033', 'ORD-68A2B6DDA37E4', 'test product catalog2', 120.00, 50.00, 170.00, 'wallet', 'pending', 'delivered', '2025-08-18 05:15:09', '2025-08-19 11:06:07', '2025-08-18 05:15:09', '2025-08-19 11:06:11', NULL),
(20, 7, 3, 'D-12, Jaipur, Rajasthan, India, 302033', 'ORD-68A425E61B6A0', 'test', 2.00, 10.00, 12.00, 'wallet', 'pending', 'returned', '2025-08-19 07:21:10', '2025-08-19 12:26:27', '2025-08-19 07:21:10', '2025-08-19 12:28:00', NULL),
(21, 7, 3, 'D-12, Jaipur, Rajasthan, India, 302033', 'ORD-68A426562F32B', 'test', 2.00, 10.00, 12.00, 'wallet', 'pending', 'delivered', '2025-08-19 07:23:02', '2025-08-19 12:20:31', '2025-08-19 07:23:02', '2025-08-19 12:20:31', NULL),
(22, 7, 3, 'D-12, Jaipur, Rajasthan, India, 302033', 'ORD-68A427CF78D98', 'test', 2.00, 0.00, 2.00, 'wallet', 'pending', 'pending', '2025-08-19 07:29:19', NULL, '2025-08-19 07:29:19', '2025-08-19 07:29:19', NULL),
(23, 7, 6, '15 Govindpuricolony, Jaipur, Rajasthan, India, 302022', 'ORD-68A438048C3C4', 'wfsdgvc', 3.00, 0.00, 3.00, 'wallet', 'pending', 'pending', '2025-08-19 08:38:28', NULL, '2025-08-19 08:38:28', '2025-08-19 08:38:28', NULL),
(24, 7, 3, 'D-12, Jaipur, Rajasthan, India, 302033', 'ORD-68A4381A9D816', 'wfsdgvc', 3.00, 0.00, 3.00, 'wallet', 'pending', 'pending', '2025-08-19 08:38:50', NULL, '2025-08-19 08:38:50', '2025-08-19 08:38:50', NULL),
(25, 7, 3, 'D-12, Jaipur, Rajasthan, India, 302033', 'ORD-68A5AC18D69F5', 'Home Interior With Vintage Furniture', 1200.00, 0.00, 1200.00, 'wallet', 'pending', 'pending', '2025-08-20 11:06:00', NULL, '2025-08-20 11:06:00', '2025-08-20 11:06:00', NULL),
(26, 7, 3, 'D-12, Jaipur, Rajasthan, India, 302033', 'ORD-68A5ACA3144F1', 'China classic furniture Special features Culture', 12000.00, 0.00, 12000.00, 'wallet', 'pending', 'pending', '2025-08-20 11:08:19', NULL, '2025-08-20 11:08:19', '2025-08-20 11:08:19', NULL),
(27, 7, 6, '15 Govindpuricolony, Jaipur, Rajasthan, India, 302022', 'ORD-68A5ACB0D21DD', 'Bad Home Furniture', 20000.00, 0.00, 20000.00, 'wallet', 'pending', 'pending', '2025-08-20 11:08:32', NULL, '2025-08-20 11:08:32', '2025-08-20 11:08:32', NULL),
(28, 7, 6, '15 Govindpuricolony, Jaipur, Rajasthan, India, 302022', 'ORD-68A5ACC57766B', 'Bad Home Furniture', 20000.00, 0.00, 20000.00, 'wallet', 'pending', 'pending', '2025-08-20 11:08:53', NULL, '2025-08-20 11:08:53', '2025-08-20 11:08:53', NULL),
(29, 7, 6, '15 Govindpuricolony, Jaipur, Rajasthan, India, 302022', 'ORD-68A5B7D3B5A1F', 'Home Interior With Vintage Furniture', 1200.00, 0.00, 1200.00, 'wallet', 'pending', 'pending', '2025-08-20 11:56:03', NULL, '2025-08-20 11:56:03', '2025-08-20 11:56:03', NULL),
(30, 7, 6, '15 Govindpuricolony, Jaipur, Rajasthan, India, 302022', 'ORD-68A5B9F5C16E7', 'Home Interior With Vintage Furniture', 1200.00, 0.00, 1200.00, 'wallet', 'pending', 'pending', '2025-08-20 12:05:09', NULL, '2025-08-20 12:05:09', '2025-08-20 12:05:09', NULL),
(31, 7, 6, '15 Govindpuricolony, Jaipur, Rajasthan, India, 302022', 'ORD-68A5BA3100A0C', 'Home Interior With Vintage Furniture', 1200.00, 0.00, 1200.00, 'wallet', 'pending', 'pending', '2025-08-20 12:06:09', NULL, '2025-08-20 12:06:09', '2025-08-20 12:06:09', NULL),
(32, 7, 3, 'D-12, Jaipur, Rajasthan, India, 302033', 'ORD-68A5BDB9C7067', 'Home Interior With Vintage Furniture', 1200.00, 0.00, 1200.00, 'wallet', 'pending', 'pending', '2025-08-20 12:21:13', NULL, '2025-08-20 12:21:13', '2025-08-20 12:21:13', NULL),
(33, 7, 3, 'D-12, Jaipur, Rajasthan, India, 302033', 'ORD-68A5C340756FC', 'Home Interior With Vintage Furniture', 1200.00, 0.00, 1200.00, 'wallet', 'pending', 'pending', '2025-08-20 12:44:48', NULL, '2025-08-20 12:44:48', '2025-08-20 12:44:48', NULL),
(34, 7, 6, '15 Govindpuricolony, Jaipur, Rajasthan, India, 302022', 'ORD-68A5EABA2FF35', 'Chair', 1234.00, 0.00, 1234.00, 'wallet', 'pending', 'pending', '2025-08-20 15:33:14', NULL, '2025-08-20 15:33:14', '2025-08-20 15:33:14', NULL),
(35, 7, 6, '15 Govindpuricolony, Jaipur, Rajasthan, India, 302022', 'ORD-68A6B352DAA0F', 'Home Interior With Vintage Furniture', 1000.00, 0.00, 1000.00, 'wallet', 'pending', 'pending', '2025-08-21 05:49:06', NULL, '2025-08-21 05:49:06', '2025-08-21 05:49:06', NULL),
(36, 7, 6, '15 Govindpuricolony, Jaipur, Rajasthan, India, 302022', 'ORD-68A6CA946148C', 'China classic furniture Special features Culture', 11800.00, 0.00, 11800.00, 'wallet', 'pending', 'cancelled', '2025-08-21 07:28:20', NULL, '2025-08-21 07:28:20', '2025-08-21 08:34:16', NULL),
(37, 7, 6, '15 Govindpuricolony, Jaipur, Rajasthan, India, 302022', 'ORD-68A6DC00EE783', 'Home Interior With Vintage Furniture', 1000.00, 0.00, 1000.00, 'wallet', 'pending', 'cancelled', '2025-08-21 08:42:40', NULL, '2025-08-21 08:42:40', '2025-08-21 09:22:48', NULL),
(38, 7, 3, 'D-12, Jaipur, Rajasthan, India, 302033', 'ORD-68A6E5BC289DE', 'Home Interior With Vintage Furniture', 1000.00, 0.00, 1000.00, 'wallet', 'pending', 'shipped', '2025-08-21 09:24:12', '2025-08-21 09:26:45', '2025-08-21 09:24:12', '2025-08-21 09:27:01', 'TXN20250821092412HQKP'),
(39, 7, 3, 'D-12, Jaipur, Rajasthan, India, 302033', 'ORD-68A6EB4054E41', 'China classic furniture Special features Culture', 11800.00, 0.00, 11800.00, 'wallet', 'pending', 'returned', '2025-08-21 09:47:44', NULL, '2025-08-21 09:47:44', '2025-08-21 10:04:38', 'TXN202508210947442LZW');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('admin@example.com', '$2y$12$./QjBu5Z9zpBmgGOu0F8leJv7HvipkXBQRXAbUr.6c/Fhf9tf5gD6', '2025-08-05 10:13:23');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `dimensions` varchar(255) DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `qr_code_path` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `gallery_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `dimensions`, `weight`, `stock_quantity`, `is_available`, `qr_code_path`, `image`, `gallery_image`, `created_at`, `updated_at`) VALUES
(9, 2, 'test product 3', 'description 1', 24.00, 'dimensions2', 3, 24, 1, NULL, 'products/main/EaqMKlxzI2n9UpebHea4UqCodZAV0FWkJGc65cDM.webp', NULL, '2025-08-05 05:37:36', '2025-08-05 05:38:03'),
(10, 4, 'chandan', 'demo demo', 200.00, '20X50X10', 500, 5, 1, NULL, 'products/main/Pu1ubkKDtMGgwl1SOEtdZIWQeXMtxj5w6IhO8hZP.jpg', NULL, '2025-08-06 05:15:56', '2025-08-06 05:15:56');

-- --------------------------------------------------------

--
-- Table structure for table `product_catalog`
--

CREATE TABLE `product_catalog` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount_price` decimal(10,2) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `gallery` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gallery`)),
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_catalog`
--

INSERT INTO `product_catalog` (`id`, `name`, `slug`, `description`, `price`, `discount_price`, `stock`, `image`, `gallery`, `category_id`, `status`, `created_at`, `updated_at`) VALUES
(24, 'Home Interior With Vintage Furniture', 'home-interior-with-vintage-furniture', 'Home Interior With Vintage Furniture', 1200.00, 200.00, 4, 'products/2zFSizRDuHIDekt569x4YFnCNnAS6DPty0XGHfI1.jpg', '\"[\\\"products\\\\\\/gallery\\\\\\/z35V80Z5tewo928SnutNP0IeHBxj5JD4LkrPbP8l.jpg\\\"]\"', 6, 1, '2025-08-20 10:44:23', '2025-08-21 09:24:12'),
(25, 'China classic furniture Special features Culture', 'china-classic-furniture-special-features-culture', 'China classic furniture Special features Culture', 12000.00, 200.00, 98, 'products/OklDBkRM7wIEVwWBj1UlLJ4MYzT0OuZnyj2PfpJA.jpg', '\"[\\\"products\\\\\\/gallery\\\\\\/W8kmNRQAdAF8J68TEehTeKALKD2sgi2aG6JAsYNR.jpg\\\"]\"', 6, 1, '2025-08-20 10:46:08', '2025-08-21 09:47:44'),
(26, 'Home cookery furniture. Magnificent modern furniture of a home cookery.', 'home-cookery-furniture-magnificent-modern-furniture-of-a-home-cookery', 'Home cookery furniture. Magnificent modern furniture of a home cookery.', 10000.00, 200.00, 4, 'products/h51V32TqRbMA150XHrqxxGaqUdug4dMzJBVJEY5U.jpg', '\"[\\\"products\\\\\\/gallery\\\\\\/QvaRq6SYxj67mVcVvYY5Mt0HfjS2NOhuyQmFDDVL.jpg\\\"]\"', 6, 1, '2025-08-20 10:47:34', '2025-08-20 10:47:34'),
(27, 'VICTORIOUS ONE DRAWER STUDY TABLE', 'victorious-one-drawer-study-table', 'Victorious wooden one drawer study table with elegant design made in Rajasthan, India. Discount upto 60% on eshopregal.in by natural living furniture. This wooden study table is solid and ergonomically sound. The table’s slatted design gives it a classic yet unique look. Table offers brilliant comfort to the user, and its elegant design and finish adds style to your decor.', 22180.00, 27720.00, 5, 'products/pcsRrank0WI6znKOM92efKriSQbSm1rrvLG17FN2.jpg', '\"[\\\"products\\\\\\/gallery\\\\\\/UnhMrfB9T7PFhLC4k1A2sp2qiDBiNWDNQi9U3IEC.jpg\\\"]\"', 6, 1, '2025-08-20 10:50:12', '2025-08-20 10:50:12'),
(28, 'Bad Home Furniture', 'bad-home-furniture', 'Bad Home Furniture', 20000.00, 2000.00, 5, 'products/gdSl0S1llgcUuk1OrlmPRlDuOFvTNbJ00SFcDPkr.jpg', '\"[\\\"products\\\\\\/gallery\\\\\\/FZSpWdkNLHS548THJQIeIojRMsWvid7ZQCu2O0qy.jpg\\\"]\"', 6, 1, '2025-08-20 10:51:34', '2025-08-20 10:51:34'),
(29, 'Contemporary elegant luxury living room', 'contemporary-elegant-luxury-living-room', 'Contemporary elegant luxury living room', 20000.00, 2000.00, 5, 'products/tKTyEpkwKCFiLmsrPX0LiJejAP0oZmC0n0KzYeSy.jpg', '\"[\\\"products\\\\\\/gallery\\\\\\/DVEhuWq8timgY6vHaXnrew0RU1sEyPpRTPxDSYQl.jpg\\\"]\"', 6, 1, '2025-08-20 10:52:47', '2025-08-20 10:52:47'),
(30, 'Berry Fabric 1-Seater Sofa - Brown', 'berry-fabric-1-seater-sofa-brown', 'Berry Fabric 1-Seater Sofa - Brown', 300.00, 20.00, 3, 'products/CjtOdtJQgupw3C8RohWb2YtARfmBiOUnuMp8yb6z.jpg', '\"[\\\"products\\\\\\/gallery\\\\\\/ywEqEIJXUT2z9Fpgp79WnKNKzMaK0zdtpvwbOnqp.jpg\\\"]\"', 6, 1, '2025-08-20 11:11:55', '2025-08-20 11:11:55'),
(31, 'Engineered Wood Wooden Home Furnitures', 'engineered-wood-wooden-home-furnitures', 'Engineered Wood Wooden Home Furnitures', 3424.00, 32.00, 9, 'products/p9oF1ciJzM5gCdF0TaFpzDLIAUx0rRwsIkp8wPI4.png', '\"[\\\"products\\\\\\/gallery\\\\\\/CgCrjzsNhC3wSUKzaVyjim4vPFgQ7bY2KMBuwEFa.png\\\"]\"', 6, 1, '2025-08-20 11:24:40', '2025-08-20 11:24:40'),
(32, 'Rustic furniture Table Bedroom Furniture Sets Living room, bedroom, angle, furniture,', 'rustic-furniture-table-bedroom-furniture-sets-living-room-bedroom-angle-furniture', 'Rustic furniture Table Bedroom Furniture Sets Living room, bedroom, angle, furniture,', 123456.00, 3245.00, 23, 'products/I4501SbLmoQ6REo00PAEOKGn3eBctylGM9R8vhxC.png', '\"[\\\"products\\\\\\/gallery\\\\\\/JZ5NpIdD4oSvBdfkqNy3omwuFbb2WK6GjtKRDyju.png\\\"]\"', 6, 1, '2025-08-20 11:26:00', '2025-08-20 11:26:00'),
(33, 'Chair', 'chair', 'Chair', 1234.00, 3.00, 42, 'products/o2Oc4iUvkb4Sd5s8lsqDWJaSddTLdBRHz9CwyuuY.png', '\"[\\\"products\\\\\\/gallery\\\\\\/ab8UDN57Tix7pK9Nqn3cjgGjcOMK4n5HzdOmsQzs.png\\\"]\"', 6, 1, '2025-08-20 11:27:07', '2025-08-20 15:33:14'),
(34, 'Wooden Furniture', 'wooden-furniture', 'Wooden Furniture', 543.00, 34.00, 34, 'products/8KAvSQYTCRylFJhbVbBJVVH7A2YSsZQxYZrg3fpo.png', '\"[\\\"products\\\\\\/gallery\\\\\\/GTdVdWXp0x1fcGvXZiFOiSXEi83vvQpVCpZh3Krz.png\\\"]\"', 6, 1, '2025-08-20 11:29:51', '2025-08-20 15:33:03');

-- --------------------------------------------------------

--
-- Table structure for table `product_lists`
--

CREATE TABLE `product_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_lists`
--

INSERT INTO `product_lists` (`id`, `name`, `description`, `price`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Product 1', 'fNODdJYDpoGQfIMChaKlN4B2X5IeYetKv1EZR9ci1WqgJUMXzpAozZlUrh7puRmAn2FJA5aLYDTXNW34', 55.00, NULL, '2025-08-13 06:24:07', '2025-08-13 06:24:07'),
(2, 'Product 2', '2PZqEZ55Co7XbTSr5hCBIP4k27vXwT3gvfhkBJTtZZwNsEmALgvM7erPpHulsHzHIvIlj9eKkebd6j9Z', 88.00, NULL, '2025-08-13 06:24:07', '2025-08-13 06:24:07'),
(3, 'Product 3', 'CXxVyqdqD1hEcpIh5wZRG22b5HV8hOpH0wYFyijYxX7DUGDSNKC3diUmNW0mbgQFjC771JIr482VZvTX', 34.00, NULL, '2025-08-13 06:24:07', '2025-08-13 06:24:07'),
(4, 'Product 4', 'vCgbnKAQNn3YxeWSZzW9Wvx1G2eLN0mLRCigS572DqMOyx2OMKjZjq0Qe8VBK9N2NKvEPQV81zKuLveH', 81.00, NULL, '2025-08-13 06:24:07', '2025-08-13 06:24:07'),
(5, 'Product 5', 'itEtwfQ5PBaVxOqTMc5BlMAO5Oh1ftOjExjrfKJpiEP613UnRVSSOWXNKhXK4ONlZJVdpnTeQsc8zg7d', 91.00, NULL, '2025-08-13 06:24:07', '2025-08-13 06:24:07'),
(6, 'Product 6', 'lB4I9ZUHdgBTqdAH4Nspr7jyjTL3PYJxEubIDcqH2sQmJcUtFFkba8rbxC3klUngwWJMADW8Cb4UWxyk', 10.00, NULL, '2025-08-13 06:24:07', '2025-08-13 06:24:07'),
(7, 'Product 7', 'ya7AByePAxrwS33y9CcuntUEVAbircy24d24efqeuEut0BQNlq2PJc8FeHsXNiMDdAPwkVMHGbo1FQYx', 88.00, NULL, '2025-08-13 06:24:07', '2025-08-13 06:24:07'),
(8, 'Product 8', 'WRXvZvPNY3AAqz390j7hQ96mEa0VR6yJuK9OQ7ZwxJD84hymoxOnib6fHBBku5Dttw7Aoku9jgsjxHZO', 87.00, NULL, '2025-08-13 06:24:07', '2025-08-13 06:24:07'),
(9, 'Product 9', '1Hn1hlZKmlzKsgIE90KH68ncvUPgUgNZ63ZIUG5aMo7caq6i7xrPEuKpGhoz1YN9DHEhTr4BNeQ446E8', 16.00, NULL, '2025-08-13 06:24:07', '2025-08-13 06:24:07'),
(10, 'Product 10', 'hZrgjajB0p4ZyqMCnTIRvKXg7MLSMSHIkW4aIYIVRKygitfXJ1dGmxW7gzYRzRw4Y16SLBO9XnSZH0nA', 56.00, NULL, '2025-08-13 06:24:07', '2025-08-13 06:24:07'),
(11, 'Product 1', 'AGplbGvQJHGa4MV6fOOmjrEPJ7kU9huXnLyp1uyqxtF7fbSk4m4opDlt5ajqwLI1FxyJBcZW2X7jYnvG', 37.00, 'https://picsum.photos/seed/product1/400/300', '2025-08-13 07:10:05', '2025-08-13 07:10:05'),
(12, 'Product 2', 'TdeU7hawipn3GRXz9vUmV8gcg21z9aiQEJm4JUafa2RMNOl8BZx3Tc21We3u573S0drS50zNuIG46tk9', 24.00, 'https://picsum.photos/seed/product2/400/300', '2025-08-13 07:10:05', '2025-08-13 07:10:05'),
(13, 'Product 3', 'szY0uo610VMcp5ZZZhbVS7YRNd0RqeaN6FMyLWjudP7ne7usyVtbmLZ1MZW7ujQY7wCEtQLM2BUoFcfN', 92.00, 'https://picsum.photos/seed/product3/400/300', '2025-08-13 07:10:05', '2025-08-13 07:10:05'),
(14, 'Product 4', '67SykdSVgytlc2Xi7rjnJrWdu6hFuapisYRo1v0M5qlg48RzlP8nwWiP9MgNiEuSCAuzJ0z3Qocg2bqG', 55.00, 'https://picsum.photos/seed/product4/400/300', '2025-08-13 07:10:05', '2025-08-13 07:10:05'),
(15, 'Product 5', 'vC8JRPXOmS7emd4YGf0L5TDfgSmbPqlNOGRMcVr9vq0jVc2jdIxge3r1vXdTY8yygLlgcjYvSqAbhwlM', 100.00, 'https://picsum.photos/seed/product5/400/300', '2025-08-13 07:10:05', '2025-08-13 07:10:05'),
(16, 'Product 6', '3lmVuybiDPM9DfEgZnKVBZXKF0caPIbJ0XObE8QsCX2lx9uLJRp7yXLcnNZmtxY91Ezh0N8jarQvgO9s', 66.00, 'https://picsum.photos/seed/product6/400/300', '2025-08-13 07:10:05', '2025-08-13 07:10:05'),
(17, 'Product 7', 'ozbxVxQq5ftiO4Ri6sQVQefb1Y9OhVF74L21e2ta4xU5BujqWCih4DzFwVhNNcGuZbN5keDPU2ZTHRsu', 60.00, 'https://picsum.photos/seed/product7/400/300', '2025-08-13 07:10:05', '2025-08-13 07:10:05'),
(18, 'Product 8', 'sGJUOMfFeUhss44YefUfK2rNk0fXLV1HlMcs8xwhd5zIYczVz0tuyZKoPnIRZsqvCx47hSIgR9KRp6jG', 87.00, 'https://picsum.photos/seed/product8/400/300', '2025-08-13 07:10:05', '2025-08-13 07:10:05'),
(19, 'Product 9', 'd6rFc57P81yyLl4cc1tZdQF8665gTb8FaJL7LWvajZ6QOTMl75RauwW8BRKvyZmriqETPJhMYczozDwh', 90.00, 'https://picsum.photos/seed/product9/400/300', '2025-08-13 07:10:05', '2025-08-13 07:10:05'),
(20, 'Product 10', '9TUaFyiLIPliIvSlarTDoq6LDilRlYLhlB3vuxZCl3ylMtwtIqmXKsRp51fllX4JDPi9cFyJ1Mx1boIx', 97.00, 'https://picsum.photos/seed/product10/400/300', '2025-08-13 07:10:05', '2025-08-13 07:10:05'),
(21, 'Product 1', 'lepGwp0W9DytHxZPa0MYek4OeU2xsMOqwC4t0XvQn8YBkrY0eVqVevcPKzcWofGvjEnskGXzZWx9q8yI', 26.00, 'products/product1.jpg', '2025-08-13 07:14:43', '2025-08-13 07:14:43'),
(22, 'Product 2', '8Dw3bHFsaB68YhMOgmUK4N2vovHlKUTFQMyIPSOWmf5gJEhczkj3gue3S22w6XmylaVZ0PY3z2WyDai5', 69.00, 'products/product2.jpg', '2025-08-13 07:14:50', '2025-08-13 07:14:50'),
(23, 'Product 3', '7XVe5wgWNzAWLBRV2zfC9PiyOrBQdoWBRH8UeYa5H77HPG7AqSA74GomcdKh7c4SEawIM9FlvV8axTWO', 31.00, 'products/product3.jpg', '2025-08-13 07:14:51', '2025-08-13 07:14:51'),
(24, 'Product 4', '7QlksJhCnIMN94MjVc3KucLXDPrQPvJha6DRSCCsCoBNe03ecivkRa2tWTdGoztakGQuhYpQ01sFmlqg', 73.00, 'products/product4.jpg', '2025-08-13 07:14:53', '2025-08-13 07:14:53'),
(25, 'Product 5', '2FrEhG1Nmbg1l55wP6xChaC0dzzE4G1Tg1K1fp9FrUp6Rjef29xYH3iSjmFe88DaWQ6utmKN5CmDV828', 57.00, 'products/product5.jpg', '2025-08-13 07:14:55', '2025-08-13 07:14:55'),
(26, 'Product 6', 'xQR9pZiFyE0pSHEX3Y2oLvtg0Jhw7XR66iSFJp0eMp4NRsNEitlC4MwHR3S64e1uQMeRD6anQ18tH5GE', 20.00, 'products/product6.jpg', '2025-08-13 07:14:57', '2025-08-13 07:14:57'),
(27, 'Product 7', '3sKOA9E6BMA1ua19Gn2lrSNoIDcTvk0l2iNOBoyrELJAXpuWPIiAkBp9N8kdr90coBe1riphUN9RAfwE', 91.00, 'products/product7.jpg', '2025-08-13 07:14:57', '2025-08-13 07:14:57'),
(28, 'Product 8', 'oxgN0xrsfDgC1dASnrd3ccSUeN8B24zKl21JijY8vxLPSemORaapZ10IP2Gumgtq6n4cBwraAQv4Pq6U', 97.00, 'products/product8.jpg', '2025-08-13 07:15:02', '2025-08-13 07:15:02'),
(29, 'Product 9', 'R0Iqn03PSU01MfUPPXDMVq6lBn7KEVXJqL1bQSFZsszWqZom77UFySde4RpVeRVEqFmsR9yJHbh3rAm5', 40.00, 'products/product9.jpg', '2025-08-13 07:15:04', '2025-08-13 07:15:04'),
(30, 'Product 10', 'KCUc8ITDkgepzwNcpQjqX5Npihw6KCL8p7YECELY8bXHqxGftr0AUoaoKVlFwZa5tsmPayNXa4pNS0B8', 11.00, 'products/product10.jpg', '2025-08-13 07:15:08', '2025-08-13 07:15:08'),
(31, 'Product 1', 'RYP5vCUYo87hBBwpmRtO1JDQ6TFGtRU1J2bFFtbBd9OYPQtslfl1SOvK92yvybQwuBKlHcJTWjyqGzSw', 65.00, NULL, '2025-08-13 07:17:26', '2025-08-13 07:17:26'),
(32, 'Product 2', 'lVkoLDw8PVtgc4MCc2RZRySxz81ocw9Eu8mEhBy37BWKtorkDJX8aF9Vz52y8WoBEooAQcTdWD1SAKMi', 35.00, NULL, '2025-08-13 07:17:26', '2025-08-13 07:17:26'),
(33, 'Product 3', 'DjR502e9ljrZAMWODofXp6FHZQ3CSnqyv1EBaACpQKyvCVyu4rToCqeeoCywvwh4vDUxVgd0V5t6umrW', 22.00, NULL, '2025-08-13 07:17:26', '2025-08-13 07:17:26'),
(34, 'Product 4', 'fDz3HftEu5Zx1paQssncDQKzgG703gBWqpONMNwuNYyBcEbdKgDx7M9AC4STgpwgT3jRHPs7VkvyhhJz', 45.00, NULL, '2025-08-13 07:17:26', '2025-08-13 07:17:26'),
(35, 'Product 5', 'xtzr1W3xMHOatnM0sV4n8U2mFdpHsGiB3dzmE3s4Sx235N5ArNS13i35eCozwAKHVxh3PzAE1fJxDZ8H', 96.00, NULL, '2025-08-13 07:17:26', '2025-08-13 07:17:26'),
(36, 'Product 6', 'vV36CuK8DJDWEurgvFCLZ4l8aogU6QJnHrLVzqAVHXhshkTiPvsxbQjozl4R9npTuUgAYRWM3UpFspB4', 60.00, NULL, '2025-08-13 07:17:26', '2025-08-13 07:17:26'),
(37, 'Product 7', 'MyeUPRvNF78god4WDwo760cHvHDpYLh91WHiCKHQ7nEqliFBUQcSDLgSqlAVZJa7HUmvVr3vUhbhcPyb', 32.00, NULL, '2025-08-13 07:17:26', '2025-08-13 07:17:26'),
(38, 'Product 8', 'R1qNo2jYOcwkKdXKilAtlzGi1gnzGdWbZU8kzdnaOgpRNG3ZjVUnctLrKsADLzGBuEei5z8z4vCGb2Td', 100.00, NULL, '2025-08-13 07:17:26', '2025-08-13 07:17:26'),
(39, 'Product 9', 'N7Z5AG4idECazNQffdtXyPcQeMsix76xSsZx3fWu2aZE2hDBFfq5RAqgHtA1RlRcvU2o46FSCIs98kI3', 24.00, NULL, '2025-08-13 07:17:26', '2025-08-13 07:17:26'),
(40, 'Product 10', 'Tutr69jPC3MywIei1tq8dbopAr2Y4sjKx4N1UUGV7LdhfJzrdpXrbKJoZv8h5TziG5FMFu1LUhWR0ssD', 100.00, NULL, '2025-08-13 07:17:26', '2025-08-13 07:17:26');

-- --------------------------------------------------------

--
-- Table structure for table `product_qr_codes`
--

CREATE TABLE `product_qr_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `coin_reward` varchar(255) NOT NULL DEFAULT '0',
  `is_used` tinyint(1) NOT NULL DEFAULT 0,
  `path` varchar(255) NOT NULL,
  `used_at` timestamp NULL DEFAULT NULL,
  `used_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_qr_codes`
--

INSERT INTO `product_qr_codes` (`id`, `product_id`, `code`, `coin_reward`, `is_used`, `path`, `used_at`, `used_by`, `created_at`, `updated_at`) VALUES
(2, 9, 'cbe1bef3-bde0-46c5-8808-937edc29736f', '10', 0, 'qr_codes/cbe1bef3-bde0-46c5-8808-937edc29736f.png', NULL, NULL, '2025-08-05 05:38:27', '2025-08-05 05:38:27'),
(3, 9, 'dd221b75-d646-4430-b5b5-b31a3624dde3', '20', 0, 'qr_codes/dd221b75-d646-4430-b5b5-b31a3624dde3.png', NULL, NULL, '2025-08-05 05:38:27', '2025-08-05 05:38:27'),
(4, 9, '6a75833f-1c0c-48d4-8d49-2f4ea3d0a330', '30', 0, 'qr_codes/6a75833f-1c0c-48d4-8d49-2f4ea3d0a330.png', NULL, NULL, '2025-08-05 05:38:27', '2025-08-05 05:38:27'),
(5, 9, 'e611d3fb-05d4-43f6-81e3-788062163f2a', '40', 0, 'qr_codes/e611d3fb-05d4-43f6-81e3-788062163f2a.png', NULL, NULL, '2025-08-05 05:38:27', '2025-08-05 05:38:27'),
(6, 9, 'b1fb4036-20ae-4048-9509-587e9e511743', '50', 1, 'qr_codes/b1fb4036-20ae-4048-9509-587e9e511743.png', '2025-08-06 05:31:38', 7, '2025-08-05 05:38:28', '2025-08-06 05:31:38'),
(8, 10, '338200e9-d429-41df-a708-e5bdc064ee9c', '10', 1, 'qr_codes/338200e9-d429-41df-a708-e5bdc064ee9c.png', '2025-08-06 05:18:30', 7, '2025-08-06 05:16:49', '2025-08-06 05:18:30'),
(44, 10, '2e8fbb29-daff-49a0-beef-5be5ed9e59fc', '14', 0, 'qr_codes/2e8fbb29-daff-49a0-beef-5be5ed9e59fc.png', NULL, NULL, '2025-08-19 12:09:22', '2025-08-19 12:09:22'),
(45, 10, '4e6002eb-a9d8-4940-8e64-f19badd625f6', '99', 0, 'qr_codes/4e6002eb-a9d8-4940-8e64-f19badd625f6.png', NULL, NULL, '2025-08-19 12:09:22', '2025-08-19 12:09:22'),
(46, 10, 'ec316667-638f-442d-b390-a6eb721318ca', '91', 0, 'qr_codes/ec316667-638f-442d-b390-a6eb721318ca.png', NULL, NULL, '2025-08-19 12:09:22', '2025-08-19 12:09:22'),
(47, 10, '9a3f9ea4-044c-460f-9576-21a89170e693', '23', 0, 'qr_codes/9a3f9ea4-044c-460f-9576-21a89170e693.png', NULL, NULL, '2025-08-19 12:09:22', '2025-08-19 12:09:22'),
(48, 10, 'ff0bbc00-743b-4994-bc15-df2df566c23d', '73', 0, 'qr_codes/ff0bbc00-743b-4994-bc15-df2df566c23d.png', NULL, NULL, '2025-08-19 12:09:22', '2025-08-19 12:09:22'),
(49, 10, '15f06660-e208-48e7-a5f9-c08e264aadd4', '74', 0, 'qr_codes/15f06660-e208-48e7-a5f9-c08e264aadd4.png', NULL, NULL, '2025-08-19 12:09:23', '2025-08-19 12:09:23'),
(50, 10, '0bd87026-350b-4794-92b5-b7fc9719b726', '91', 0, 'qr_codes/0bd87026-350b-4794-92b5-b7fc9719b726.png', NULL, NULL, '2025-08-19 12:09:23', '2025-08-19 12:09:23'),
(51, 10, '310cfabd-498d-4b0e-a4e4-a84c261a8f53', '23', 0, 'qr_codes/310cfabd-498d-4b0e-a4e4-a84c261a8f53.png', NULL, NULL, '2025-08-19 12:09:23', '2025-08-19 12:09:23'),
(52, 10, 'd40dcbce-5d67-4f41-a8d5-94fd632842c3', '11', 0, 'qr_codes/d40dcbce-5d67-4f41-a8d5-94fd632842c3.png', NULL, NULL, '2025-08-19 12:09:23', '2025-08-19 12:09:23'),
(53, 10, '0f61be6e-9fc9-4b41-8b72-4fd6927290fb', '79', 0, 'qr_codes/0f61be6e-9fc9-4b41-8b72-4fd6927290fb.png', NULL, NULL, '2025-08-19 12:09:23', '2025-08-19 12:09:23');

-- --------------------------------------------------------

--
-- Table structure for table `product_user_scans`
--

CREATE TABLE `product_user_scans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-08-02 02:56:11', '2025-08-02 02:56:11'),
(2, 'user', 'web', '2025-08-02 02:56:11', '2025-08-02 02:56:11');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `wallet` decimal(10,2) NOT NULL DEFAULT 0.00,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `wallet`, `profile_image`) VALUES
(5, 'Admin User', 'admin@gmail.com', '6375064195', '$2y$12$d72LaHv/5v3elvzKwZvBB.R7JclCyfT9FjdQkAwg4JuJ7n1njFsvC', NULL, '2025-08-02 04:01:17', '2025-08-21 09:48:38', 'admin', 12800.00, NULL),
(6, 'Normal User', 'user@example.com', NULL, '$2y$12$D.SWsAV8JYFRQEjDPWiUzOioBYpbceJx0rdZvBV2RYtiCXrEk/cqC', NULL, '2025-08-02 04:01:17', '2025-08-12 04:46:59', 'user', 0.00, NULL),
(7, 'chandan', 'chandan@gmail.com', '6377562310', '$2y$12$ph6ZQ4I/rnd5ppul1O00GOh/fhXkyoQoI5cFaSmi2Hex0Q8pmUU2e', NULL, '2025-08-04 16:25:50', '2025-08-21 10:04:38', 'user', 125766.00, 'profile_images/lVj034D8PMFq1qai5N8smbHrUl9mGwrQQfrUFHTl.jpg'),
(9, 'Pawan Verma1', 'pawanwaplia1@gmail.com\n', NULL, '$2y$12$5iNqfDH5Njr4u.AWBAzFC.0iWdJpdYEXJtwlytfTGRYOK4AdURi8.', NULL, '2025-08-05 10:14:29', '2025-08-06 05:36:44', 'user', 8.00, 'profile_images/lZN8ySM1S5DUcOB61v0WgjIoJahUKcCcIFYsi1ms.png'),
(10, 'rahul', 'rahul@gmail.com', NULL, '$2y$12$IjjJE9YZkR0iXOwDxZIVv.W0QF3UNjGR3W0Za9LcODVf869MnhtHK', NULL, '2025-08-05 12:46:34', '2025-08-05 12:46:34', 'user', 0.00, NULL),
(11, 'kailash', 'kailash@gmail.com', NULL, '$2y$12$2BYRX25PIGsIZgROPxTxvebgKGerIprB8aE0HbQpZMdXs.lWFtsQm', NULL, '2025-08-05 15:34:18', '2025-08-05 15:38:13', 'user', 0.00, 'profile_images/L7L3boPfqsck9MXil1YjvsG8g4hsRcdWaXCVNkTC.jpg'),
(12, 'rohit', 'rohit@gmail.com', NULL, '$2y$12$kpcnNyH5C2TR1oSfbv7a8OUqMfWae96G3.fJMCsoue5sSP6TbBwka', NULL, '2025-08-05 15:43:47', '2025-08-05 15:43:47', 'user', 0.00, NULL),
(13, 'Waplia', 'waplia@gmail.com', NULL, '$2y$12$BnTbBk0adlGn4lN4NJl/rujlnMnNMM9oEZhz/4nxSyYLQKynz1kEm', NULL, '2025-08-06 04:31:46', '2025-08-06 04:31:46', 'user', 0.00, 'profile_images/8W7T0Wefrpu8MF9sdktU01isav8nzqxsiKN0X6WR.jpg'),
(14, 'rohan1', 'rohan@gmail.com', NULL, '$2y$12$oZl7uTpFIJANRFoWp14iBe93bbNszGzOuF9bU1PmXC9/q94iWJYLS', NULL, '2025-08-06 04:38:52', '2025-08-06 04:59:59', 'user', 0.00, 'profile_images/uzXG5lbYV1W78ZumN44NPQ6g2Xc82zE0sy2Sroj1.png'),
(15, 'Demo User1', 'demo@12345', NULL, '$2y$12$nZjf9fu3sxizjMUxDARY0e2dgbIJpi8kA6td62exY9kgWaDbr86jO', NULL, '2025-08-11 06:10:30', '2025-08-11 06:29:50', 'user', 0.00, 'profile_images/f4iIqRq9rGUj09nuNdAHqAuNoxX5c3oJjSHolwBf.jpg'),
(16, 'Chandan', 'chandanmajhi@waplia.in', NULL, '$2y$12$vgamzAnJAzZ1ZsUjcM8IFO1ZyVuRaTbNVWsDZs9Mz4sQmX/h8c0.6', NULL, '2025-08-11 10:31:42', '2025-08-11 10:31:42', 'user', 0.00, NULL),
(17, 'rohan', 'rohan@gamil.com', NULL, '$2y$12$A.gQPkcspoRQdFVwRsyP4uFDr4XS14wZvUyZdlBIxi7SC016FMqCy', NULL, '2025-08-11 11:53:34', '2025-08-11 11:53:34', 'user', 0.00, NULL),
(18, 'abhi', 'abhi@gmail.com', NULL, '$2y$12$AVdsjd0sojLW1jSOo4ixjO1B33vSGZabijmK09nLuVceQGiX7iTMC', NULL, '2025-08-11 11:55:38', '2025-08-11 11:55:38', 'user', 0.00, NULL),
(19, 'mukesh', 'mukesh@gmail.com', NULL, '$2y$12$AhzGr.9QPlD8EaSJ8ct5A.GLFJd0gVFfa7c/mGArzQQo6TVSwCKxK', NULL, '2025-08-11 12:25:08', '2025-08-11 12:25:08', 'user', 0.00, NULL),
(20, 'mahendra', 'mahendra@gmail.com', '9772200363', '$2y$12$2CyGA1pqbPFOQjFjgxkNgObNrr8yxNcca1d6bXCbAHUDKnDLnTHY6', NULL, '2025-08-12 04:18:11', '2025-08-12 04:18:11', 'user', 0.00, NULL),
(21, 'ajay', 'ajay@gmail.com', '9772233665', '$2y$12$Hkj54uDB7P/FuFgevyls3efGLKQ1eKx4HIBKzxo6xHkzv2W/txpTq', NULL, '2025-08-12 04:21:23', '2025-08-12 04:21:23', 'user', 0.00, 'profile_images/9a2RtsPjV05lR3vsI5lwAGhjbCRXdHWBZgIyzZXs.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

CREATE TABLE `wallet_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('credit','debit') NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `utr` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `balance_before` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `bank_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`bank_details`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallet_transactions`
--

INSERT INTO `wallet_transactions` (`id`, `user_id`, `type`, `amount`, `message`, `utr`, `transaction_id`, `balance_before`, `created_at`, `updated_at`, `status`, `bank_details`) VALUES
(1, 6, 'credit', 1.00, 'Cashback via QR scan for: test', NULL, 'TXN20250803080230XDJV', 3.00, '2025-08-03 02:32:30', '2025-08-03 02:32:30', 'pending', '{\"account_holder_name\":\"Pawan Verma\",\"bank_name\":\"KKBK\",\"account_number\":\"324\",\"ifsc_code\":\"32\"}'),
(2, 6, 'debit', 1.00, 'sd', NULL, 'TXN20250803084907CQSV', 3.00, '2025-08-03 03:19:07', '2025-08-12 04:42:03', 'completed', '{\"account_holder_name\":\"Pawan Verma\",\"bank_name\":\"KKBK\",\"account_number\":\"324\",\"ifsc_code\":\"32\"}'),
(3, 6, 'debit', 2.00, NULL, NULL, 'TXN20250803091627MSHW', 2.00, '2025-08-03 03:46:27', '2025-08-12 04:42:00', 'completed', '{\"account_holder_name\":\"Pawan Verma\",\"bank_name\":\"KKBK\",\"account_number\":\"324\",\"ifsc_code\":\"32\"}'),
(4, 6, 'credit', 2.00, 'Cashback via QR scan for: test', NULL, 'TXN20250805043818IDWX', 0.00, '2025-08-05 04:38:18', '2025-08-05 04:38:18', 'pending', '{\"account_holder_name\":\"Pawan Verma\",\"bank_name\":\"KKBK\",\"account_number\":\"324\",\"ifsc_code\":\"32\"}'),
(5, 6, 'debit', 1.00, NULL, NULL, 'TXN202508050540367EU6', 2.00, '2025-08-05 05:40:36', '2025-08-12 05:12:02', 'completed', '{\"account_holder_name\":\"Pawan Verma\",\"bank_name\":\"KKBK\",\"account_number\":\"324\",\"ifsc_code\":\"32\"}'),
(6, 9, 'credit', 10.00, 'Cashback via QR scan for: test2', NULL, 'TXN20250806050622RIQK', 0.00, '2025-08-06 05:06:22', '2025-08-06 05:06:22', 'pending', '{\"account_holder_name\":\"Pawan Verma\",\"bank_name\":\"KKBK\",\"account_number\":\"324\",\"ifsc_code\":\"32\"}'),
(7, 7, 'credit', 10.00, 'Cashback via QR scan for: chandan', NULL, 'TXN20250806051830XJAN', 0.00, '2025-08-06 05:18:30', '2025-08-06 05:18:30', 'pending', '{\"account_holder_name\":\"Pawan Verma\",\"bank_name\":\"KKBK\",\"account_number\":\"324\",\"ifsc_code\":\"32\"}'),
(8, 7, 'credit', 50.00, 'Cashback via QR scan for: test product 3', NULL, 'TXN202508060531385POO', 10.00, '2025-08-06 05:31:38', '2025-08-06 05:31:38', 'pending', '{\"account_holder_name\":\"Pawan Verma\",\"bank_name\":\"KKBK\",\"account_number\":\"324\",\"ifsc_code\":\"32\"}'),
(9, 9, 'debit', 2.00, NULL, NULL, 'TXN20250806053644DQL4', 10.00, '2025-08-06 05:36:44', '2025-08-12 12:17:40', 'completed', '{\"account_holder_name\":\"Pawan Verma\",\"bank_name\":\"KKBK\",\"account_number\":\"324\",\"ifsc_code\":\"32\"}'),
(10, 7, 'debit', 20.00, NULL, NULL, 'TXN20250806055057J8VM', 60.00, '2025-08-06 05:50:57', '2025-08-12 06:13:55', 'completed', '{\"account_holder_name\":\"Pawan Verma\",\"bank_name\":\"KKBK\",\"account_number\":\"324\",\"ifsc_code\":\"32\"}'),
(11, 15, 'credit', 1.00, 'Cashback via QR scan for: test', NULL, 'TXN20250811062922A8EJ', 0.00, '2025-08-11 06:29:22', '2025-08-11 06:29:22', 'pending', '{\"account_holder_name\":\"Pawan Verma\",\"bank_name\":\"KKBK\",\"account_number\":\"324\",\"ifsc_code\":\"32\"}'),
(12, 15, 'debit', 1.00, NULL, NULL, 'TXN20250811062950A42J', 1.00, '2025-08-11 06:29:50', '2025-08-11 06:29:50', 'pending', '{\"account_holder_name\":\"Pawan Verma\",\"bank_name\":\"KKBK\",\"account_number\":\"324\",\"ifsc_code\":\"32\"}'),
(13, 6, 'debit', 1.00, NULL, NULL, 'TXN20250812044659GLUH', 1.00, '2025-08-12 04:46:59', '2025-08-12 04:46:59', 'pending', '{\"account_holder_name\":\"Pawan Verma\",\"bank_name\":\"KKBK\",\"account_number\":\"324\",\"ifsc_code\":\"32\"}'),
(14, 7, 'debit', 1.00, NULL, NULL, 'TXN20250812061419F6AH', 40.00, '2025-08-12 06:14:19', '2025-08-12 06:15:05', 'failed', '{\"account_holder_name\":\"chandan\",\"bank_name\":\"SBI\",\"account_number\":\"6375563245\",\"ifsc_code\":\"SBI0685\"}'),
(15, 7, 'debit', 1.00, NULL, NULL, 'TXN20250812061531JQ8V', 39.00, '2025-08-12 06:15:31', '2025-08-12 06:49:04', 'completed', '{\"account_holder_name\":\"chandan\",\"bank_name\":\"SBI\",\"account_number\":\"6375563245\",\"ifsc_code\":\"SBI0685\"}'),
(16, 7, 'debit', 3.00, 'Withdrawal failed and amount refunded.', NULL, 'TXN202508120649122LMU', 38.00, '2025-08-12 06:49:12', '2025-08-12 06:52:03', 'failed', '{\"account_holder_name\":\"chandan\",\"bank_name\":\"SBI\",\"account_number\":\"6375563245\",\"ifsc_code\":\"SBI0685\"}'),
(17, 7, 'debit', 4.00, 'Withdrawal failed and amount refunded.', NULL, 'TXN20250812065212LLGX', 38.00, '2025-08-12 06:52:12', '2025-08-12 06:53:53', 'failed', '{\"account_holder_name\":\"chandan\",\"bank_name\":\"SBI\",\"account_number\":\"6375563245\",\"ifsc_code\":\"SBI0685\"}'),
(18, 7, 'debit', 2.00, 'Withdrawal failed and amount refunded.', NULL, 'TXN20250812065404P5HY', 38.00, '2025-08-12 06:54:04', '2025-08-12 06:54:50', 'failed', '{\"account_holder_name\":\"chandan\",\"bank_name\":\"SBI\",\"account_number\":\"6375563245\",\"ifsc_code\":\"SBI0685\"}'),
(19, 7, 'debit', 5.00, NULL, NULL, 'TXN202508120655019LKN', 38.00, '2025-08-12 06:55:01', '2025-08-12 09:22:13', 'failed', '{\"account_holder_name\":\"chandan\",\"bank_name\":\"SBI\",\"account_number\":\"6375563245\",\"ifsc_code\":\"SBI0685\"}'),
(20, 7, 'credit', 2.00, 'Cashback via QR scan for: test', NULL, 'TXN20250812081555QUDK', 33.00, '2025-08-12 08:15:55', '2025-08-12 08:15:55', 'pending', NULL),
(21, 7, 'debit', 1.00, NULL, NULL, 'TXN20250812084847B1OH', 35.00, '2025-08-12 08:48:47', '2025-08-12 09:20:42', 'failed', '{\"account_holder_name\":\"chandan\",\"bank_name\":\"SBI\",\"account_number\":\"6375563245\",\"ifsc_code\":\"SBI0685\"}'),
(22, 5, 'credit', 1.00, 'Your withdrawal request failed. Transaction ID: 21. Amount refunded.', NULL, 'TXN20250812091841W1QT', 0.00, '2025-08-12 09:18:41', '2025-08-12 09:18:41', 'pending', '{\"account_holder_name\":\"chandan\",\"bank_name\":\"SBI\",\"account_number\":\"6375563245\",\"ifsc_code\":\"SBI0685\"}'),
(23, 5, 'credit', 1.00, 'Your withdrawal request failed. Transaction ID: 21. Amount refunded.', NULL, 'TXN20250812091851FVA2', 0.00, '2025-08-12 09:18:51', '2025-08-12 09:18:51', 'pending', '{\"account_holder_name\":\"chandan\",\"bank_name\":\"SBI\",\"account_number\":\"6375563245\",\"ifsc_code\":\"SBI0685\"}'),
(24, 5, 'credit', 1.00, 'Your withdrawal request failed. Transaction ID: 21. Amount refunded.', NULL, 'TXN20250812092042CGA3', 0.00, '2025-08-12 09:20:42', '2025-08-12 09:20:42', 'pending', '{\"account_holder_name\":\"chandan\",\"bank_name\":\"SBI\",\"account_number\":\"6375563245\",\"ifsc_code\":\"SBI0685\"}'),
(25, 5, 'credit', 5.00, 'Your withdrawal request failed. Transaction ID: 19. Amount refunded.', NULL, 'TXN20250812092213NWM3', 0.00, '2025-08-12 09:22:13', '2025-08-12 09:22:13', 'pending', '{\"account_holder_name\":\"chandan\",\"bank_name\":\"SBI\",\"account_number\":\"6375563245\",\"ifsc_code\":\"SBI0685\"}'),
(26, 7, 'debit', 1.00, NULL, NULL, 'TXN20250812092538ISCI', 34.00, '2025-08-12 09:25:38', '2025-08-12 09:30:23', 'failed', '{\"account_holder_name\":\"chandan\",\"bank_name\":\"SBI\",\"account_number\":\"6375563245\",\"ifsc_code\":\"SBI0685\"}'),
(27, 5, 'credit', 1.00, 'Your withdrawal request failed. Transaction ID: 26. Amount refunded.', NULL, 'TXN20250812092613ZEGE', 0.00, '2025-08-12 09:26:13', '2025-08-12 09:26:13', 'pending', '{\"account_holder_name\":\"chandan\",\"bank_name\":\"SBI\",\"account_number\":\"6375563245\",\"ifsc_code\":\"SBI0685\"}'),
(28, 5, 'credit', 1.00, 'Your withdrawal request failed. Transaction ID: 26. Amount refunded.', NULL, 'TXN202508120930231UN9', 0.00, '2025-08-12 09:30:23', '2025-08-12 09:30:23', 'pending', '{\"account_holder_name\":\"chandan\",\"bank_name\":\"SBI\",\"account_number\":\"6375563245\",\"ifsc_code\":\"SBI0685\"}'),
(29, 7, 'debit', 1.00, NULL, NULL, 'TXN20250812115529RJFP', 34.00, '2025-08-12 11:55:29', '2025-08-12 11:55:47', 'failed', '{\"account_holder_name\":\"chandan\",\"bank_name\":\"SBI\",\"account_number\":\"6375563245\",\"ifsc_code\":\"SBI0685\"}'),
(30, 5, 'credit', 1.00, 'Your withdrawal request failed. Transaction ID: 29. Amount refunded.', NULL, 'TXN20250812115547EXHJ', 0.00, '2025-08-12 11:55:47', '2025-08-12 11:55:47', 'pending', '{\"account_holder_name\":\"chandan\",\"bank_name\":\"SBI\",\"account_number\":\"6375563245\",\"ifsc_code\":\"SBI0685\"}'),
(31, 7, 'debit', 1.00, NULL, NULL, 'TXN20250812115748CCV7', 34.00, '2025-08-12 11:57:48', '2025-08-12 11:58:08', 'failed', '{\"account_holder_name\":\"chandan\",\"bank_name\":\"SBI\",\"account_number\":\"6375563245\",\"ifsc_code\":\"SBI0685\"}'),
(32, 7, 'credit', 1.00, 'Your withdrawal request failed. Transaction ID: 31. Amount refunded.', NULL, 'TXN20250812115808IRTC', 34.00, '2025-08-12 11:58:08', '2025-08-12 11:58:08', 'pending', '{\"account_holder_name\":\"chandan\",\"bank_name\":\"SBI\",\"account_number\":\"6375563245\",\"ifsc_code\":\"SBI0685\"}'),
(33, 7, 'debit', 4.00, NULL, NULL, 'TXN20250812115930GWLG', 34.00, '2025-08-12 11:59:30', '2025-08-12 12:01:46', 'failed', '{\"account_holder_name\":\"chandan\",\"bank_name\":\"SBI\",\"account_number\":\"6375563245\",\"ifsc_code\":\"SBI0685\"}'),
(34, 7, 'credit', 4.00, 'Your withdrawal request failed. Transaction ID: TXN20250812115930GWLG. Amount refunded.', NULL, 'TXN20250812120146ZUA7', 34.00, '2025-08-12 12:01:46', '2025-08-12 12:01:46', 'pending', '{\"account_holder_name\":\"chandan\",\"bank_name\":\"SBI\",\"account_number\":\"6375563245\",\"ifsc_code\":\"SBI0685\"}'),
(35, 7, 'debit', 4.00, NULL, NULL, 'TXN20250812120156KNJH', 38.00, '2025-08-12 12:01:56', '2025-08-12 12:02:10', 'completed', '{\"account_holder_name\":\"chandan\",\"bank_name\":\"SBI\",\"account_number\":\"6375563245\",\"ifsc_code\":\"SBI0685\"}'),
(36, 7, 'debit', 1.00, NULL, NULL, 'TXN20250819123221MREN', 2.00, '2025-08-19 12:32:21', '2025-08-19 12:32:45', 'failed', '{\"account_holder_name\":\"Pawan Verma\",\"bank_name\":\"KKBK\",\"account_number\":\"324\",\"ifsc_code\":\"32\"}'),
(37, 7, 'credit', 1.00, 'Your withdrawal request failed. Transaction ID: TXN20250819123221MREN. Amount refunded.', NULL, 'TXN20250819123245NUYX', 1.00, '2025-08-19 12:32:45', '2025-08-19 12:32:45', 'pending', '{\"account_holder_name\":\"Pawan Verma\",\"bank_name\":\"KKBK\",\"account_number\":\"324\",\"ifsc_code\":\"32\"}'),
(38, 7, 'credit', 1000.00, 'Your Order cancelled. Transaction ID: . Amount refunded.', NULL, 'TXN20250821092248IKJZ', 125766.00, '2025-08-21 09:22:48', '2025-08-21 09:22:48', 'pending', '\"wallet\"'),
(39, 7, 'debit', 1000.00, 'Your Order has been placed. Transaction ID: TXN20250821092412HQKP.', NULL, 'TXN20250821092412HQKP', 126766.00, '2025-08-21 09:24:12', '2025-08-21 09:24:12', 'pending', '\"wallet\"'),
(41, 7, 'debit', 11800.00, 'Your Order has been placed.', NULL, 'TXN202508210947442LZW', 125766.00, '2025-08-21 09:47:44', '2025-08-21 09:47:44', 'pending', '\"wallet\"'),
(43, 7, 'credit', 11800.00, 'Your Order has been returned. Transaction ID: TXN202508210947442LZW. Amount refunded.', NULL, 'TXN20250821100438GKNE', 113966.00, '2025-08-21 10:04:38', '2025-08-21 10:04:38', 'completed', '\"wallet\"');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_accounts_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `general_settings_key_unique` (`key`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `fk_orders_address_id` (`address_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_catalog`
--
ALTER TABLE `product_catalog`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_catalog_slug_unique` (`slug`),
  ADD KEY `product_catalog_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_lists`
--
ALTER TABLE `product_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_qr_codes`
--
ALTER TABLE `product_qr_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_qr_codes_code_unique` (`code`),
  ADD KEY `product_qr_codes_product_id_foreign` (`product_id`),
  ADD KEY `product_qr_codes_used_by_foreign` (`used_by`);

--
-- Indexes for table `product_user_scans`
--
ALTER TABLE `product_user_scans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_user_scans_product_id_foreign` (`product_id`),
  ADD KEY `product_user_scans_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- Indexes for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wallet_transactions_transaction_id_unique` (`transaction_id`),
  ADD KEY `wallet_transactions_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_catalog`
--
ALTER TABLE `product_catalog`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `product_lists`
--
ALTER TABLE `product_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `product_qr_codes`
--
ALTER TABLE `product_qr_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `product_user_scans`
--
ALTER TABLE `product_user_scans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD CONSTRAINT `bank_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_address_id` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_catalog`
--
ALTER TABLE `product_catalog`
  ADD CONSTRAINT `product_catalog_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_qr_codes`
--
ALTER TABLE `product_qr_codes`
  ADD CONSTRAINT `product_qr_codes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_qr_codes_used_by_foreign` FOREIGN KEY (`used_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_user_scans`
--
ALTER TABLE `product_user_scans`
  ADD CONSTRAINT `product_user_scans_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_user_scans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD CONSTRAINT `wallet_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
