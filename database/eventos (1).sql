-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25/09/2023 às 02:03
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `eventos`
--
CREATE DATABASE IF NOT EXISTS `eventos` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `eventos`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `private` tinyint(1) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `date` datetime NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `idlocal` int(11) NOT NULL,
  `idservico` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `events_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tabela truncada antes do insert `events`
--

TRUNCATE TABLE `events`;
--
-- Despejando dados para a tabela `events`
--

INSERT INTO `events` (`id`, `created_at`, `updated_at`, `title`, `description`, `city`, `private`, `image`, `items`, `date`, `user_id`, `idlocal`, `idservico`) VALUES
(2, '2023-09-19 04:29:40', '2023-09-19 04:29:40', 'calvalgada', 'to top', 'Douradina', 1, '51ffa6aa70da0356bb82d721529f30ee.jpg', NULL, '2023-09-05 00:00:00', 22, 2, '1,2,3,4');

-- --------------------------------------------------------

--
-- Estrutura para tabela `event_confirmations`
--

DROP TABLE IF EXISTS `event_confirmations`;
CREATE TABLE IF NOT EXISTS `event_confirmations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idevento` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `convidado` text DEFAULT NULL COMMENT '// 0 para cadastrado e 1 para convidado',
  `email` varchar(50) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `isqrcode` varchar(50) DEFAULT '0' COMMENT '1- comfirmado 0 - sem comfimaçao',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tabela truncada antes do insert `event_confirmations`
--

TRUNCATE TABLE `event_confirmations`;
--
-- Despejando dados para a tabela `event_confirmations`
--

INSERT INTO `event_confirmations` (`id`, `idevento`, `idusuario`, `convidado`, `email`, `nome`, `isqrcode`, `created_at`, `updated_at`) VALUES
(1, 2, 22, '0', NULL, NULL, NULL, '2023-09-18 00:23:07', '2023-09-18 00:23:07'),
(2, 2, 23, '0', NULL, NULL, NULL, '2023-09-18 00:35:14', '2023-09-18 00:35:14'),
(3, 2, 22, '0', NULL, NULL, NULL, '2023-09-19 04:29:47', '2023-09-19 04:29:47'),
(4, 2, 24, '0', NULL, NULL, NULL, '2023-09-20 00:55:49', '2023-09-20 00:55:49'),
(5, 2, 0, '1', 'jv@gmail.com', 'juca', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tabela truncada antes do insert `failed_jobs`
--

TRUNCATE TABLE `failed_jobs`;
-- --------------------------------------------------------

--
-- Estrutura para tabela `fornecedores`
--

DROP TABLE IF EXISTS `fornecedores`;
CREATE TABLE IF NOT EXISTS `fornecedores` (
  `idfornecedor` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `cnpj` varchar(255) NOT NULL,
  `celular` varchar(255) NOT NULL,
  `iduser` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idfornecedor`),
  KEY `fornecedores_iduser_foreign` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tabela truncada antes do insert `fornecedores`
--

TRUNCATE TABLE `fornecedores`;
--
-- Despejando dados para a tabela `fornecedores`
--

INSERT INTO `fornecedores` (`idfornecedor`, `nome`, `cnpj`, `celular`, `iduser`, `created_at`, `updated_at`) VALUES
(1, 'João Vitor Nascimento Da Silva', '11.269/1409-65', '(44) 9 9763-3867', 22, '2023-09-14 05:17:58', '2023-09-15 04:26:05'),
(3, 'BOLAS', '99999999999999', '(99) 9 9999-9999', 22, '2023-09-16 02:39:24', '2023-09-16 02:39:24');

-- --------------------------------------------------------

--
-- Estrutura para tabela `locais`
--

DROP TABLE IF EXISTS `locais`;
CREATE TABLE IF NOT EXISTS `locais` (
  `idlocal` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `cidade` varchar(500) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `complemento` varchar(255) NOT NULL,
  `responsavel` varchar(255) NOT NULL,
  `iduser` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idlocal`),
  KEY `locais_iduser_foreign` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tabela truncada antes do insert `locais`
--

TRUNCATE TABLE `locais`;
--
-- Despejando dados para a tabela `locais`
--

INSERT INTO `locais` (`idlocal`, `nome`, `cidade`, `endereco`, `bairro`, `complemento`, `responsavel`, `iduser`, `created_at`, `updated_at`) VALUES
(1, 'centro de eventos douradina', 'Douradina', 'rua dina moura', 'centro', 'centro', 'juca', 22, '2023-09-14 05:25:54', '2023-09-16 02:40:03'),
(2, 'VILA VEIA', 'Douradina', 'rua dina moura 109', 'centro', 'centro', 'juliana', 22, '2023-09-16 02:43:46', '2023-09-16 02:43:46');

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tabela truncada antes do insert `migrations`
--

TRUNCATE TABLE `migrations`;
--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_03_21_231739_create_events_table', 1),
(7, '2023_03_23_223931_add_image_to_events_table', 1),
(8, '2023_03_25_231234_add_items_to_events_table', 1),
(9, '2023_04_02_011324_add_date_to_events_table', 1),
(10, '2023_04_06_232413_create_sessions_table', 1),
(11, '2023_04_07_230251_add_user_id_to_events_table', 1),
(12, '2023_09_14_011258_create_fornecedors_table', 2),
(13, '2023_09_14_011304_create_servicos_table', 2),
(14, '2023_09_14_011314_create_locals_table', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tabela truncada antes do insert `password_reset_tokens`
--

TRUNCATE TABLE `password_reset_tokens`;
-- --------------------------------------------------------

--
-- Estrutura para tabela `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tabela truncada antes do insert `personal_access_tokens`
--

TRUNCATE TABLE `personal_access_tokens`;
-- --------------------------------------------------------

--
-- Estrutura para tabela `servicos`
--

DROP TABLE IF EXISTS `servicos`;
CREATE TABLE IF NOT EXISTS `servicos` (
  `idservico` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idfornecedor` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `iduser` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idservico`),
  KEY `servicos_idfornecedor_foreign` (`idfornecedor`),
  KEY `servicos_iduser_foreign` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tabela truncada antes do insert `servicos`
--

TRUNCATE TABLE `servicos`;
--
-- Despejando dados para a tabela `servicos`
--

INSERT INTO `servicos` (`idservico`, `idfornecedor`, `nome`, `descricao`, `iduser`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bife', 'bife top', 22, '2023-09-14 05:25:24', '2023-09-14 05:25:24'),
(2, 1, 'suco de maracuja', 'sadsaffgsafsafdasdsa', 22, '2023-09-16 02:29:23', '2023-09-16 02:29:23'),
(3, 3, 'alifer', 'totop', 22, '2023-09-17 23:08:01', '2023-09-17 23:08:01'),
(4, 3, 'josiane', '4534534', 23, '2023-09-18 00:34:58', '2023-09-18 00:34:58');

-- --------------------------------------------------------

--
-- Estrutura para tabela `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tabela truncada antes do insert `sessions`
--

TRUNCATE TABLE `sessions`;
--
-- Despejando dados para a tabela `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('djyUF7IlmjyAKnX9eXEoQkiXKf9JSLHeimdZHBi0', 22, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVHJzeEJwN0QwMXFmMUdTdEVhdEpYQWFLcUdINlBsMGlhTXVXR0pPNCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9yZWwtc2Vydmljb3MiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1695434441),
('MfSifEfSPIKtnZ0Nj2EeGjadsL30bqfKqcUkh9ZM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 OPR/102.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWGVSWlpiaE9XTXVFYVZleDM2cm1zbTgwR2o3RFF0NERHSjBkRTZzRiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1MDoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL3JlbC1ldmVudG9zLXVzZXJzP2V2ZW50X2lkPTIiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1695432076);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `tipo_usuario` int(11) NOT NULL DEFAULT 1 COMMENT '1-normal 2-adm',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tabela truncada antes do insert `users`
--

TRUNCATE TABLE `users`;
--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `tipo_usuario`, `created_at`, `updated_at`) VALUES
(1, 'Javonte McLaughlin', 'rigoberto84@example.net', '2023-09-14 03:04:53', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'D1OkhwEimt', NULL, NULL, 1, '2023-09-14 03:04:53', '2023-09-14 03:04:53'),
(2, 'Destini Schinner Sr.', 'zola98@example.net', '2023-09-14 03:04:53', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'o3tNGKBhEk', NULL, NULL, 1, '2023-09-14 03:04:53', '2023-09-14 03:04:53'),
(3, 'Peggie Paucek', 'romaguera.dave@example.net', '2023-09-14 03:04:53', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'BDNK1Luda9', NULL, NULL, 1, '2023-09-14 03:04:53', '2023-09-14 03:04:53'),
(4, 'Willis Haag Sr.', 'jkoss@example.com', '2023-09-14 03:04:53', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'HrkwxNUJfv', NULL, NULL, 1, '2023-09-14 03:04:53', '2023-09-14 03:04:53'),
(5, 'Donato Nikolaus', 'tdubuque@example.org', '2023-09-14 03:04:53', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, '0hdszo4tO5', NULL, NULL, 1, '2023-09-14 03:04:54', '2023-09-14 03:04:54'),
(6, 'Terrence Zemlak V', 'claude34@example.com', '2023-09-14 03:04:53', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'AM1M6ZszxI', NULL, NULL, 1, '2023-09-14 03:04:54', '2023-09-14 03:04:54'),
(7, 'Claire Heathcote', 'jessika96@example.net', '2023-09-14 03:04:53', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'kbLvI4tSuN', NULL, NULL, 1, '2023-09-14 03:04:54', '2023-09-14 03:04:54'),
(8, 'Miss Margot Hoeger', 'jeanie54@example.org', '2023-09-14 03:04:53', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'FL7zsqU6mf', NULL, NULL, 1, '2023-09-14 03:04:54', '2023-09-14 03:04:54'),
(9, 'Thelma Beatty', 'derek.powlowski@example.com', '2023-09-14 03:04:53', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'cthhSnegMP', NULL, NULL, 1, '2023-09-14 03:04:54', '2023-09-14 03:04:54'),
(10, 'Eda Conroy MD', 'kathlyn59@example.org', '2023-09-14 03:04:53', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'Xz74baIlbl', NULL, NULL, 1, '2023-09-14 03:04:54', '2023-09-14 03:04:54'),
(11, 'Test User', 'test@example.com', '2023-09-14 03:04:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'yQqem25A4K', NULL, NULL, 1, '2023-09-14 03:04:54', '2023-09-14 03:04:54'),
(12, 'Prof. Lou Hoppe', 'wade.franecki@example.com', '2023-09-14 03:07:26', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'Imf6esqddC', NULL, NULL, 1, '2023-09-14 03:07:26', '2023-09-14 03:07:26'),
(13, 'Jeffry Fay DVM', 'robb87@example.net', '2023-09-14 03:07:26', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, '2y7i0ufbtF', NULL, NULL, 1, '2023-09-14 03:07:26', '2023-09-14 03:07:26'),
(14, 'Dr. Brielle Abbott', 'viva34@example.com', '2023-09-14 03:07:26', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'TJ9x4aowFd', NULL, NULL, 1, '2023-09-14 03:07:26', '2023-09-14 03:07:26'),
(15, 'Prof. Brooks Blick', 'drake.veum@example.net', '2023-09-14 03:07:26', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'cUPFju7kHZ', NULL, NULL, 1, '2023-09-14 03:07:26', '2023-09-14 03:07:26'),
(16, 'Clemmie Wuckert', 'kamryn60@example.net', '2023-09-14 03:07:26', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'jiMo4ZVgSK', NULL, NULL, 1, '2023-09-14 03:07:26', '2023-09-14 03:07:26'),
(17, 'Creola Pfannerstill V', 'elizabeth.stokes@example.net', '2023-09-14 03:07:26', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'KTnfxm1yww', NULL, NULL, 1, '2023-09-14 03:07:27', '2023-09-14 03:07:27'),
(18, 'Sim Fay', 'peggie27@example.org', '2023-09-14 03:07:26', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'PfM4NBfIrl', NULL, NULL, 1, '2023-09-14 03:07:27', '2023-09-14 03:07:27'),
(19, 'Kendall Tillman', 'gutkowski.johan@example.com', '2023-09-14 03:07:26', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, '32pZsOmHdf', NULL, NULL, 1, '2023-09-14 03:07:27', '2023-09-14 03:07:27'),
(20, 'Vergie Carroll', 'jaskolski.madelyn@example.org', '2023-09-14 03:07:26', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'W0Nxz7T1gg', NULL, NULL, 1, '2023-09-14 03:07:27', '2023-09-14 03:07:27'),
(21, 'Thalia Hauck', 'iritchie@example.net', '2023-09-14 03:07:26', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'WplUq2FdeL', NULL, NULL, 1, '2023-09-14 03:07:27', '2023-09-14 03:07:27'),
(22, 'joaosn', 'jv.zyzz.legado@gmail.com', NULL, '$2y$10$JdbHfBJnQFBoTpa5MIEFnOGQJzHTpuFixIhU8OWjOmCkDO/E7TaYy', NULL, NULL, NULL, 'ezijhsqZUskGYkkUjQJNsOVh2wwm9pblblGEcyXA6MU6ElrtRzGuRy1h1dbG', NULL, '1695085317.jpg', 2, '2023-09-14 03:27:58', '2023-09-19 04:01:57'),
(23, 'joaosn juca', 'corujaonlinebrasil@gmail.com', NULL, '$2y$10$5wkc8qiXxi041qUE92KNCeK62hGBk5bXYpe2PrCxEsh2fvE4cuiPi', NULL, NULL, NULL, NULL, NULL, '1695085929.jpg', 1, '2023-09-18 00:29:57', '2023-09-19 04:12:09'),
(24, 'joao vitor nascimento da silva', 'jv.zyzz.legado2@gmail.com', NULL, '$2y$10$ZRkbQmFp5dNrD7v1biPXvutilaFBsqOQPVdZGWEtgFaNVH37nuqcu', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-09-20 00:55:34', '2023-09-20 00:55:34');

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Restrições para tabelas `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD CONSTRAINT `fornecedores_iduser_foreign` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`);

--
-- Restrições para tabelas `locais`
--
ALTER TABLE `locais`
  ADD CONSTRAINT `locais_iduser_foreign` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`);

--
-- Restrições para tabelas `servicos`
--
ALTER TABLE `servicos`
  ADD CONSTRAINT `servicos_idfornecedor_foreign` FOREIGN KEY (`idfornecedor`) REFERENCES `fornecedores` (`idfornecedor`),
  ADD CONSTRAINT `servicos_iduser_foreign` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
