-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 04 déc. 2025 à 01:31
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `culture`
--

-- --------------------------------------------------------

--
-- Structure de la table `achats_contenus`
--

CREATE TABLE `achats_contenus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_utilisateur` bigint(20) UNSIGNED NOT NULL,
  `id_contenu` bigint(20) UNSIGNED NOT NULL,
  `id_paiement` bigint(20) UNSIGNED NOT NULL,
  `date_achat` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id_commentaire` bigint(20) UNSIGNED NOT NULL,
  `texte` text NOT NULL,
  `date` datetime NOT NULL,
  `note` int(11) DEFAULT NULL,
  `id_utilisateur` bigint(20) UNSIGNED NOT NULL,
  `id_contenu` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id_commentaire`, `texte`, `date`, `note`, `id_utilisateur`, `id_contenu`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'J\'adore assez ce contenu, c\'est une très belle vulgarisation!', '2025-11-24 10:50:57', 6, 1, 1, NULL, NULL, NULL),
(4, 'éffectivement c\'est une intÉressante facon de voir les choses, c\'est notre culture aprèS tout!', '2025-11-24 00:00:00', 6, 1, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `contenus`
--

CREATE TABLE `contenus` (
  `id_contenu` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `id_type` bigint(20) UNSIGNED NOT NULL,
  `texte` text NOT NULL,
  `date_creation` datetime NOT NULL,
  `statut` varchar(255) NOT NULL,
  `est_premium` tinyint(1) NOT NULL DEFAULT 0,
  `prix` decimal(10,2) DEFAULT NULL,
  `id_auteur` bigint(20) UNSIGNED NOT NULL,
  `id_langue` bigint(20) UNSIGNED NOT NULL,
  `id_region` bigint(20) UNSIGNED NOT NULL,
  `parent` bigint(20) UNSIGNED DEFAULT NULL,
  `id_moderateur` bigint(20) UNSIGNED DEFAULT NULL,
  `date_validation` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contenus`
--

INSERT INTO `contenus` (`id_contenu`, `titre`, `id_type`, `texte`, `date_creation`, `statut`, `est_premium`, `prix`, `id_auteur`, `id_langue`, `id_region`, `parent`, `id_moderateur`, `date_validation`, `created_at`, `updated_at`) VALUES
(1, 'Decouverte de la fête du vodoun chaque 10 janvier au Bénin.', 1, 'c\'est l\'evenement directement attendu au commencement de chaque nouvelle annéé, excellent engouement autour depuis l\'initialisation de la fÊte de vodoun À OUIDAH!', '2025-11-24 10:44:02', 'validé', 0, NULL, 1, 5, 1, NULL, NULL, NULL, NULL, NULL),
(6, 'Festival Welove-eya édition 2025', 1, 'C\'est le rendez musicale vous de l\'année! Rendez vous entre les 27 & 28 Décembre 2025 à la place de l\'amazone pour admirer en live les meilleurs permformances de vos chanteurs internationales préférés.', '2025-11-25 23:28:39', 'validé', 0, NULL, 6, 5, 6, 1, NULL, NULL, NULL, NULL),
(7, 'Decouvrez l\'un des repas les plus historiques du Bénin.', 3, 'Un repas et un une recette qui ont traversés les années, les générations et qui continuent de nous faire saliver rien qu\'en pensant qu\'on y goutera dans la journée avec une délicieuse sauce d\'arachide.', '2025-11-25 22:58:18', 'validé', 0, NULL, 3, 9, 3, NULL, NULL, NULL, '2025-11-25 21:58:18', '2025-11-25 21:58:18'),
(8, 'La fête du vodoun', 2, 'La fête du vodoun est organisée tout le temps au Bénin en Janvier le 10 pour célébrer la tradition.', '2025-11-26 11:24:16', 'validé', 0, NULL, 2, 4, 3, 1, NULL, NULL, '2025-11-26 10:24:16', '2025-11-26 10:24:16'),
(9, 'L\'histoire derriere la maginque place de l\'étoile rouge', 2, 'La place de l\'étoile est une place significative au Bénin, logé au niveau de l\'un des carrefour les plus fréquentés du Bénin, il s\'agit d\'une place qui tient bien son nom de ce qu\'elle symbolise, le rouge du sang versé. Le sang versé de soldat qui se sont battus contre l\'invasion de missionnaire pour protégé leur héritage au péril de leur vie! Alors quoi de plus emblématique que d\'ériger une magnifique statut de ces combattants entourré par cette même occasion d\'une place comomérative tout ce qui a de plus emblematique.', '2025-11-30 16:41:55', 'validé', 0, NULL, 2, 10, 6, NULL, NULL, NULL, '2025-11-30 15:41:55', '2025-11-30 15:41:55'),
(10, 'A la decouverte groove chill fest', 1, 'Le Groove chill fest est le rassemblement festival annuel, qui suit la célébration de la fête de l\'indépendance, fête qui se tient chaque soirée de chaque 01 Août au Bénin, à Cotonou, au palais des congrès. C\'est l\'occasion de bouger, en repensant une indépendance récupérée y a plus de 65 ans donc!', '2025-11-30 16:48:54', 'validé', 1, 100.00, 2, 6, 5, NULL, NULL, NULL, '2025-11-30 15:48:54', '2025-12-03 12:43:37');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
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
-- Structure de la table `jobs`
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
-- Structure de la table `job_batches`
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
-- Structure de la table `langues`
--

CREATE TABLE `langues` (
  `id_langue` bigint(20) UNSIGNED NOT NULL,
  `nom_langue` varchar(255) NOT NULL,
  `code_langue` varchar(10) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `langues`
--

INSERT INTO `langues` (`id_langue`, `nom_langue`, `code_langue`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Fongbé', 'Fon', 'Description de la langue fon', NULL, '2025-11-23 09:46:44', '2025-11-23 09:46:44'),
(2, 'Goungbé', 'Gn', NULL, NULL, '2025-11-23 18:13:23', '2025-11-23 18:13:23'),
(3, 'Yoruba', 'Yr', NULL, NULL, NULL, NULL),
(4, 'English', 'En', 'Langue américaine', '2025-11-23 09:51:58', '2025-11-23 09:51:58', NULL),
(5, 'Français', 'Fr', 'Langue de la france', '2025-11-23 18:25:25', '2025-11-23 18:25:25', NULL),
(6, 'Minan', 'Mn', '', '2025-11-24 09:59:19', '2025-11-24 09:59:19', NULL),
(7, 'Dendi', 'De', '', '2025-11-24 09:59:19', '2025-11-24 09:59:19', NULL),
(8, 'Nago', 'Ng', '', '2025-11-24 09:59:19', '2025-11-24 09:59:19', NULL),
(9, 'Minan', 'Mn', '', '2025-11-24 10:00:25', '2025-11-24 10:00:25', NULL),
(10, 'Dendi', 'De', '', '2025-11-24 10:00:25', '2025-11-24 10:00:25', NULL),
(11, 'Nago', 'Ng', '', '2025-11-24 10:00:25', '2025-11-24 10:00:25', NULL),
(12, 'Allemand', 'Al', NULL, '2025-11-25 08:19:55', '2025-11-25 08:19:55', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `medias`
--

CREATE TABLE `medias` (
  `id_media` bigint(20) UNSIGNED NOT NULL,
  `chemin` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `id_type` bigint(20) UNSIGNED DEFAULT NULL,
  `id_contenu` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `medias`
--

INSERT INTO `medias` (`id_media`, `chemin`, `description`, `id_type`, `id_contenu`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'medias/CU6L5DJGFWcAXlHX2w4NrE1ZaaQRQfyUtM2nOQkO.jpg', NULL, NULL, 6, '2025-11-26 00:12:02', '2025-11-26 00:12:02', NULL),
(4, 'medias/cGBsAUm4Tlihwkj8Wq1WoAQZ6lup5ttDI77OE97C.jpg', NULL, NULL, 6, '2025-11-26 00:13:08', '2025-11-26 00:13:08', NULL),
(5, 'medias/uKa53Xpx4Qjgn7BLquDWJ4OiVx1ZBXmBN85WRTdX.jpg', NULL, NULL, 6, '2025-11-26 00:15:53', '2025-11-26 00:17:34', '2025-11-26 00:17:34'),
(6, 'medias/CuvjzH3WL8M3eTuGhLBvq494d7ObtZny2ZBECjc2.jpg', NULL, NULL, 6, '2025-11-26 00:18:00', '2025-11-26 00:18:00', NULL),
(7, 'medias/ngJUrWi0EmkJ22I0QnQz5sws2YEavynhHif6S9U1.jpg', NULL, NULL, 1, '2025-11-26 09:05:27', '2025-11-26 09:05:27', NULL),
(8, 'medias/XB65RwTrEw4rvbaiL3zwwVnUpf7CaIr4EKtCt0Es.jpg', NULL, NULL, 7, '2025-11-26 09:05:50', '2025-11-26 09:05:50', NULL),
(9, 'medias/BhjezREIBo2tgIXJVxH3guyrc3sZNBGuvxPhWbQT.jpg', NULL, NULL, 1, '2025-11-26 10:03:27', '2025-11-26 10:03:27', NULL),
(10, 'medias/AI8Sp2SmhRPImRxkXNKjQojPZimGWhmHFw3hqwFX.jpg', NULL, NULL, 1, '2025-11-26 10:04:30', '2025-11-26 10:04:30', NULL),
(11, 'medias/L3Kx0oh47HCAuoE4BXhcFMnotLx2EmHMC9HciAHp.jpg', NULL, NULL, 1, '2025-11-26 10:24:39', '2025-11-26 10:24:39', NULL),
(12, 'medias/IbQinqwPQX1cnRJVVGwWqFcT9IpX4IX2GdiljfHW.jpg', NULL, NULL, 8, '2025-11-26 10:31:43', '2025-11-26 10:31:43', NULL),
(13, 'medias/bCWCVr8lYQ0VIPOVbPqXujQhPQLBEWbPEDGkxMB5.jpg', NULL, NULL, 8, '2025-11-26 10:32:44', '2025-11-26 10:32:44', NULL),
(14, 'medias/JGoPJRmyoY1C8CCy9NCR8JUHBxVY2Epzs6oDCFpy.jpg', NULL, NULL, 8, '2025-11-26 10:33:05', '2025-11-26 10:33:05', NULL),
(15, 'medias/4RexH7i1L6IdAFSOCMH6FPyYpAItv8lk8tdPHgI0.jpg', NULL, NULL, 9, '2025-11-30 15:42:34', '2025-11-30 15:42:34', NULL),
(16, 'medias/maAvzo7myWZe1D7vpnuKg3u6EtfvTLMB1vAT3658.jpg', NULL, NULL, 10, '2025-11-30 15:49:30', '2025-11-30 15:49:30', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_20_231259_create_roles_table', 1),
(5, '2025_11_20_231310_create_langues_table', 1),
(6, '2025_11_20_231315_create_regions_table', 1),
(7, '2025_11_20_231320_create_type_contenus_table', 1),
(8, '2025_11_20_231330_create_utilisateurs_table', 1),
(9, '2025_11_20_231400_create_contenus_table', 1),
(10, '2025_11_20_231500_create_type_media_table', 1),
(11, '2025_11_20_231510_create_medias_table', 1),
(12, '2025_11_20_231520_create_commentaires_table', 1),
(13, '2025_11_20_231530_create_parler_table', 1),
(14, '2025_11_22_195731_add_deleted_at_to_type_media_table', 2),
(15, '2025_11_23_091338_add_deleted_at_to_commentaires_table', 3),
(16, '2025_11_23_092400_add_deleted_at_to_medias_table', 4),
(17, '2025_11_25_231332_add_email_verified_at_to_utilisateurs_table', 5),
(18, '2025_11_26_005806_make_id_type_nullable_in_medias_table', 6),
(19, '2025_12_03_063152_add_premium_fields_to_contenus_table', 7),
(20, '2025_12_03_063153_create_paiements_table', 7),
(21, '2025_12_03_063155_create_achats_contenus_table', 7);

-- --------------------------------------------------------

--
-- Structure de la table `paiements`
--

CREATE TABLE `paiements` (
  `id_paiement` bigint(20) UNSIGNED NOT NULL,
  `id_utilisateur` bigint(20) UNSIGNED NOT NULL,
  `id_contenu` bigint(20) UNSIGNED NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `devise` varchar(3) NOT NULL DEFAULT 'XOF',
  `statut` enum('en_attente','reussi','echoue','rembourse') NOT NULL DEFAULT 'en_attente',
  `methode_paiement` varchar(255) DEFAULT NULL,
  `fedapay_transaction_id` varchar(255) DEFAULT NULL,
  `fedapay_status` varchar(255) DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `date_paiement` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `parler`
--

CREATE TABLE `parler` (
  `id_region` bigint(20) UNSIGNED NOT NULL,
  `id_langue` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `regions`
--

CREATE TABLE `regions` (
  `id_region` bigint(20) UNSIGNED NOT NULL,
  `nom_region` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `population` int(11) DEFAULT NULL,
  `superficie` double DEFAULT NULL,
  `localisation` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `regions`
--

INSERT INTO `regions` (`id_region`, `nom_region`, `description`, `population`, `superficie`, `localisation`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Gbégamey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Aitchédji', 'Une ville dans Abomey-calavi', 138, NULL, NULL, NULL, '2025-11-23 18:13:09', NULL),
(3, 'Porto-novo', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Vedoko', NULL, NULL, NULL, NULL, '2025-11-24 10:00:25', '2025-11-24 10:00:25', NULL),
(5, 'Akpakpa', NULL, NULL, NULL, NULL, '2025-11-24 10:00:25', '2025-11-24 10:00:25', NULL),
(6, 'Cadjehoun', NULL, NULL, NULL, NULL, '2025-11-24 10:00:25', '2025-11-24 10:00:25', NULL),
(7, 'Menontin', NULL, NULL, NULL, NULL, '2025-11-24 10:00:25', '2025-11-24 10:00:25', NULL),
(8, 'kpota', NULL, NULL, NULL, NULL, '2025-11-24 10:00:25', '2025-11-24 10:00:25', NULL),
(9, 'Tokan', NULL, NULL, NULL, NULL, '2025-11-24 10:00:25', '2025-11-24 10:00:25', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id_role` bigint(20) UNSIGNED NOT NULL,
  `nom_role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id_role`, `nom_role`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrateur', NULL, NULL, NULL),
(2, 'modérateur', NULL, NULL, NULL),
(3, 'Manager', '2025-11-24 09:44:12', '2025-11-24 09:44:12', NULL),
(4, 'Lecteur', '2025-11-24 09:44:12', '2025-11-24 09:44:12', NULL),
(5, 'Auteur', '2025-11-24 09:44:12', '2025-11-24 09:44:12', NULL),
(6, 'Manager', '2025-11-24 10:00:25', '2025-11-24 10:00:25', NULL),
(7, 'Lecteur', '2025-11-24 10:00:25', '2025-11-24 10:00:25', NULL),
(8, 'Auteur', '2025-11-24 10:00:25', '2025-11-24 10:00:25', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('g0vnlFjIfB1lD6LMIiHoQNoOYiPZqfMPfraZNwKs', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOUdJZGtaWE15bG55YzdZbk9malZuTzRZckJESEZaOFA0Rlk2T0lFaiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1764056721),
('Oo7Rwxcku4aOgQrHtvLnZAxj8NJqblAkZIEwYIuQ', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYlRNdzFnS2Mxc2FmWHRlcUo3YnRLUmdjSldEbHU0eUlidzBuWUV1VyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1764055231),
('UjI87vOnB3Fmu5doYNfRCLVPqYl2cnCtX5guvxpM', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibm5oN0g1QWNPY3QxUDNHOEljVzZseVJESUJibUM0TFNPQ2tyT1liMCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1764056840);

-- --------------------------------------------------------

--
-- Structure de la table `type_contenus`
--

CREATE TABLE `type_contenus` (
  `id_type` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_contenus`
--

INSERT INTO `type_contenus` (`id_type`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'Articles culturels', NULL, NULL),
(2, 'Histoire', '2025-11-24 09:02:55', '2025-11-24 09:02:55'),
(3, 'Recette de cuisine', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `type_media`
--

CREATE TABLE `type_media` (
  `id_type` bigint(20) UNSIGNED NOT NULL,
  `nom_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_media`
--

INSERT INTO `type_media` (`id_type`, `nom_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'video', NULL, NULL, NULL),
(2, 'image', NULL, NULL, NULL),
(3, 'audio', NULL, NULL, NULL),
(4, 'document', '2025-11-24 10:42:54', '2025-11-24 10:42:54', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
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
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `sexe` enum('M','F','Autre') DEFAULT NULL,
  `role` bigint(20) UNSIGNED NOT NULL,
  `id_langue` bigint(20) UNSIGNED NOT NULL,
  `date_inscription` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_naissance` date DEFAULT NULL,
  `statut` enum('actif','inactif','banni') NOT NULL DEFAULT 'actif',
  `photo` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom`, `prenom`, `email`, `email_verified_at`, `mot_de_passe`, `sexe`, `role`, `id_langue`, `date_inscription`, `date_naissance`, `statut`, `photo`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Trump', 'Donald', 'donald123@gmail.com\r\n', NULL, '$2y$12$6lZ2VZ53mxg/d2UfjbzGSuOq.NScVgXEPpjUWAb0mKJAF6UuQnQ3q', 'M', 2, 3, '2025-11-23 08:24:37', '2015-11-10', 'actif', NULL, NULL, NULL, '2025-11-25 05:09:47', NULL),
(2, 'oke', 'hans', 'hansoke51@gmail.com', NULL, '$2y$12$c4kyR/je7R8R1tIPJTGFbO7VmSeRVeaxbLZ6Bpa.g93l0zRWm8jQC', 'M', 1, 5, '2025-11-25 06:08:15', '2015-11-03', 'actif', NULL, 'OnhrZK2It2iIyht3DBlW22IkmSofCVS3Tn1APqt2X17wfWbGcjaepCiTn4Wo', NULL, '2025-11-25 05:25:23', NULL),
(3, 'meryl', 'oke', 'meyloke7@gmail.com', NULL, '$2y$12$bDd0/HwAhAco3qgg8omHa.VGK5INQ/8N/YpWlqnJ4Pbz3aYUXmO3i', NULL, 1, 1, '2025-11-25 06:15:52', NULL, 'actif', NULL, NULL, '2025-11-25 05:15:52', '2025-11-25 06:19:51', NULL),
(4, '', 'oke', 'gbe@gmail.com', NULL, '$2y$12$hKCBRnUpgi1rH/k1sRPEpO/t3PRIJVlOdMxNKTzIu.gcLw1ET4Cpe', NULL, 1, 1, '2025-11-25 07:40:51', NULL, 'actif', NULL, NULL, '2025-11-25 06:40:51', '2025-11-25 06:40:51', NULL),
(5, 'COMLAN', 'Maurice', 'maurice.comlan@uac.bj', NULL, '$2y$12$cqbqZmrCmGXXMqX6NotZSeBvz67cxnAxxEnxqJ0rCMpfVjvgAuyxe', NULL, 1, 1, '2025-11-25 08:09:19', NULL, 'actif', NULL, 'UZDUkMxKwBdVcPQ82UI8hyDLuq92sniYDaN7xwCziDwrQ2L5K0vpSHwg06cc', '2025-11-25 07:09:19', '2025-11-25 07:09:19', NULL),
(6, 'rio', 'zach', 'scimentio2004@gmail.com', NULL, 'Rylo1750', NULL, 4, 6, '2025-11-25 11:35:21', '2025-11-04', 'actif', NULL, NULL, NULL, NULL, NULL),
(7, 'OKE', 'Meryl', 'hansmeryl14@gmail.com', NULL, '$2y$12$UZXbhG9DANlnfW9SX3Myc.lOoE4GuD4FnX2PJNkhbS7pJgLUOQ9rS', NULL, 4, 4, '2025-11-25 23:09:20', '2006-11-12', 'actif', NULL, NULL, '2025-11-25 22:09:20', '2025-11-25 22:09:20', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `achats_contenus`
--
ALTER TABLE `achats_contenus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `achats_contenus_id_utilisateur_id_contenu_unique` (`id_utilisateur`,`id_contenu`),
  ADD KEY `achats_contenus_id_contenu_foreign` (`id_contenu`),
  ADD KEY `achats_contenus_id_paiement_foreign` (`id_paiement`);

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id_commentaire`),
  ADD KEY `commentaires_id_utilisateur_foreign` (`id_utilisateur`),
  ADD KEY `commentaires_id_contenu_foreign` (`id_contenu`);

--
-- Index pour la table `contenus`
--
ALTER TABLE `contenus`
  ADD PRIMARY KEY (`id_contenu`),
  ADD KEY `contenus_id_type_foreign` (`id_type`),
  ADD KEY `contenus_id_auteur_foreign` (`id_auteur`),
  ADD KEY `contenus_id_langue_foreign` (`id_langue`),
  ADD KEY `contenus_id_region_foreign` (`id_region`),
  ADD KEY `contenus_parent_foreign` (`parent`),
  ADD KEY `contenus_id_moderateur_foreign` (`id_moderateur`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `langues`
--
ALTER TABLE `langues`
  ADD PRIMARY KEY (`id_langue`);

--
-- Index pour la table `medias`
--
ALTER TABLE `medias`
  ADD PRIMARY KEY (`id_media`),
  ADD KEY `medias_id_type_foreign` (`id_type`),
  ADD KEY `medias_id_contenu_foreign` (`id_contenu`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paiements`
--
ALTER TABLE `paiements`
  ADD PRIMARY KEY (`id_paiement`),
  ADD UNIQUE KEY `paiements_fedapay_transaction_id_unique` (`fedapay_transaction_id`),
  ADD KEY `paiements_id_utilisateur_foreign` (`id_utilisateur`),
  ADD KEY `paiements_id_contenu_foreign` (`id_contenu`);

--
-- Index pour la table `parler`
--
ALTER TABLE `parler`
  ADD PRIMARY KEY (`id_region`,`id_langue`),
  ADD KEY `parler_id_langue_foreign` (`id_langue`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id_region`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `type_contenus`
--
ALTER TABLE `type_contenus`
  ADD PRIMARY KEY (`id_type`);

--
-- Index pour la table `type_media`
--
ALTER TABLE `type_media`
  ADD PRIMARY KEY (`id_type`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `utilisateurs_email_unique` (`email`),
  ADD KEY `utilisateurs_role_foreign` (`role`),
  ADD KEY `utilisateurs_id_langue_foreign` (`id_langue`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `achats_contenus`
--
ALTER TABLE `achats_contenus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id_commentaire` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `contenus`
--
ALTER TABLE `contenus`
  MODIFY `id_contenu` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `langues`
--
ALTER TABLE `langues`
  MODIFY `id_langue` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `medias`
--
ALTER TABLE `medias`
  MODIFY `id_media` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `paiements`
--
ALTER TABLE `paiements`
  MODIFY `id_paiement` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `regions`
--
ALTER TABLE `regions`
  MODIFY `id_region` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `type_contenus`
--
ALTER TABLE `type_contenus`
  MODIFY `id_type` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `type_media`
--
ALTER TABLE `type_media`
  MODIFY `id_type` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `achats_contenus`
--
ALTER TABLE `achats_contenus`
  ADD CONSTRAINT `achats_contenus_id_contenu_foreign` FOREIGN KEY (`id_contenu`) REFERENCES `contenus` (`id_contenu`) ON DELETE CASCADE,
  ADD CONSTRAINT `achats_contenus_id_paiement_foreign` FOREIGN KEY (`id_paiement`) REFERENCES `paiements` (`id_paiement`) ON DELETE CASCADE,
  ADD CONSTRAINT `achats_contenus_id_utilisateur_foreign` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_id_contenu_foreign` FOREIGN KEY (`id_contenu`) REFERENCES `contenus` (`id_contenu`),
  ADD CONSTRAINT `commentaires_id_utilisateur_foreign` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`);

--
-- Contraintes pour la table `contenus`
--
ALTER TABLE `contenus`
  ADD CONSTRAINT `contenus_id_auteur_foreign` FOREIGN KEY (`id_auteur`) REFERENCES `utilisateurs` (`id_utilisateur`),
  ADD CONSTRAINT `contenus_id_langue_foreign` FOREIGN KEY (`id_langue`) REFERENCES `langues` (`id_langue`),
  ADD CONSTRAINT `contenus_id_moderateur_foreign` FOREIGN KEY (`id_moderateur`) REFERENCES `utilisateurs` (`id_utilisateur`),
  ADD CONSTRAINT `contenus_id_region_foreign` FOREIGN KEY (`id_region`) REFERENCES `regions` (`id_region`),
  ADD CONSTRAINT `contenus_id_type_foreign` FOREIGN KEY (`id_type`) REFERENCES `type_contenus` (`id_type`),
  ADD CONSTRAINT `contenus_parent_foreign` FOREIGN KEY (`parent`) REFERENCES `contenus` (`id_contenu`);

--
-- Contraintes pour la table `medias`
--
ALTER TABLE `medias`
  ADD CONSTRAINT `medias_id_contenu_foreign` FOREIGN KEY (`id_contenu`) REFERENCES `contenus` (`id_contenu`),
  ADD CONSTRAINT `medias_id_type_foreign` FOREIGN KEY (`id_type`) REFERENCES `type_media` (`id_type`);

--
-- Contraintes pour la table `paiements`
--
ALTER TABLE `paiements`
  ADD CONSTRAINT `paiements_id_contenu_foreign` FOREIGN KEY (`id_contenu`) REFERENCES `contenus` (`id_contenu`) ON DELETE CASCADE,
  ADD CONSTRAINT `paiements_id_utilisateur_foreign` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `parler`
--
ALTER TABLE `parler`
  ADD CONSTRAINT `parler_id_langue_foreign` FOREIGN KEY (`id_langue`) REFERENCES `langues` (`id_langue`),
  ADD CONSTRAINT `parler_id_region_foreign` FOREIGN KEY (`id_region`) REFERENCES `regions` (`id_region`);

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `utilisateurs_id_langue_foreign` FOREIGN KEY (`id_langue`) REFERENCES `langues` (`id_langue`),
  ADD CONSTRAINT `utilisateurs_role_foreign` FOREIGN KEY (`role`) REFERENCES `roles` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
