-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 04 juin 2020 à 03:07
-- Version du serveur :  10.3.16-MariaDB
-- Version de PHP :  7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `irisi-app`
--

-- --------------------------------------------------------

--
-- Structure de la table `annee_univs`
--

CREATE TABLE `annee_univs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `int_annee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `annee_univs`
--

INSERT INTO `annee_univs` (`id`, `int_annee`, `created_at`, `updated_at`) VALUES
(1, '2019/2020', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `dashboards`
--

CREATE TABLE `dashboards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `enseignes`
--

CREATE TABLE `enseignes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `professeur_id` bigint(20) UNSIGNED NOT NULL,
  `semestre_id` bigint(20) UNSIGNED NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `niveau_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `enseignes`
--

INSERT INTO `enseignes` (`id`, `professeur_id`, `semestre_id`, `module_id`, `niveau_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 1, NULL, NULL),
(2, 1, 2, 2, 1, NULL, NULL),
(3, 1, 2, 3, 1, NULL, NULL),
(4, 1, 2, 4, 1, NULL, NULL),
(5, 1, 2, 5, 1, NULL, NULL),
(6, 1, 2, 6, 1, NULL, NULL),
(7, 1, 2, 7, 1, NULL, NULL),
(8, 1, 2, 8, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

CREATE TABLE `etudiants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `cne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_apogee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etudiants`
--

INSERT INTO `etudiants` (`id`, `user_id`, `cne`, `code_apogee`, `date_naissance`, `adresse`, `created_at`, `updated_at`) VALUES
(1, 1, 'X000000510', '20160000', '1997-12-31', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `examens`
--

CREATE TABLE `examens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `liste_etudiants`
--

CREATE TABLE `liste_etudiants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `niveau_id` bigint(20) UNSIGNED NOT NULL,
  `semestre_id` bigint(20) UNSIGNED NOT NULL,
  `etudiant_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `liste_etudiants`
--

INSERT INTO `liste_etudiants` (`id`, `niveau_id`, `semestre_id`, `etudiant_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(8, '2014_10_12_000000_create_users_table', 1),
(9, '2014_10_12_100000_create_password_resets_table', 1),
(10, '2020_05_23_233458_create_dashboards_table', 1),
(11, '2020_06_01_224738_create_etudiants_table', 1),
(12, '2020_06_01_230946_create_professeurs_table', 2),
(13, '2020_06_02_172439_create_annee_univs_table', 3),
(14, '2020_06_02_172950_create_semestres_table', 3),
(15, '2020_06_02_173035_create_modules_table', 3),
(16, '2020_06_02_173053_create_niveaux_table', 3),
(17, '2020_06_02_173109_create_examens_table', 3),
(18, '2020_06_02_173123_create_notes_table', 3),
(19, '2020_06_03_221005_create_liste_etudiants_table', 4),
(20, '2020_06_03_221757_create_enseignes_table', 4),
(21, '2014_10_12_000000_create_users_table', 1),
(22, '2014_10_12_100000_create_password_resets_table', 1),
(23, '2020_05_23_233458_create_dashboards_table', 1),
(24, '2020_06_01_224738_create_etudiants_table', 1),
(25, '2020_06_01_230946_create_professeurs_table', 1),
(26, '2020_06_02_172439_create_annee_univs_table', 1),
(27, '2020_06_02_172950_create_semestres_table', 1),
(28, '2020_06_02_173035_create_modules_table', 1),
(29, '2020_06_02_173053_create_niveaux_table', 1),
(30, '2020_06_02_173109_create_examens_table', 1),
(31, '2020_06_02_173123_create_notes_table', 1),
(32, '2020_06_03_221005_create_liste_etudiants_table', 1),
(33, '2020_06_03_221757_create_enseignes_table', 1),
(34, '2014_10_12_000000_create_users_table', 1),
(35, '2014_10_12_100000_create_password_resets_table', 1),
(36, '2020_05_23_233458_create_dashboards_table', 1),
(37, '2020_06_01_224738_create_etudiants_table', 1),
(38, '2020_06_01_230946_create_professeurs_table', 1),
(39, '2020_06_02_172439_create_annee_univs_table', 1),
(40, '2020_06_02_172950_create_semestres_table', 1),
(41, '2020_06_02_173035_create_modules_table', 1),
(42, '2020_06_02_173053_create_niveaux_table', 1),
(43, '2020_06_02_173109_create_examens_table', 1),
(44, '2020_06_02_173123_create_notes_table', 1),
(45, '2020_06_03_221005_create_liste_etudiants_table', 1),
(46, '2020_06_03_221757_create_enseignes_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `modules`
--

INSERT INTO `modules` (`id`, `libelle`, `created_at`, `updated_at`) VALUES
(1, 'TCP/IP', NULL, NULL),
(2, 'Anglais', NULL, NULL),
(3, 'Techniques et expressions de communication', NULL, NULL),
(4, 'Architechture Client/Serveur', NULL, NULL),
(5, 'POO Java', NULL, NULL),
(6, 'Base de données', NULL, NULL),
(7, 'Statistiques et théorie des graphes', NULL, NULL),
(8, 'Techniques de gestion d\'entreprise', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `niveaux`
--

CREATE TABLE `niveaux` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `int_niveau` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `niveaux`
--

INSERT INTO `niveaux` (`id`, `int_niveau`, `created_at`, `updated_at`) VALUES
(1, '1', NULL, NULL),
(2, '2', NULL, NULL),
(3, '3', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `professeurs`
--

CREATE TABLE `professeurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `professeurs`
--

INSERT INTO `professeurs` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `semestres`
--

CREATE TABLE `semestres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `int_semestre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee_univ_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `semestres`
--

INSERT INTO `semestres` (`id`, `int_semestre`, `annee_univ_id`, `created_at`, `updated_at`) VALUES
(1, '1', 1, NULL, NULL),
(2, '2', 1, NULL, NULL),
(3, '3', 1, NULL, NULL),
(4, '4', 1, NULL, NULL),
(5, '5', 1, NULL, NULL),
(6, '6', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '3',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `password`, `tel`, `categorie`, `image`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Gui', 'Moise', 'f@f.f', '$2y$10$ebBki3fiBrudCfbRNv9mJeH2D0kgkLBa0F1jhZb2cS/uA7P4W0V/a', '0600000000', '3', NULL, NULL, NULL, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annee_univs`
--
ALTER TABLE `annee_univs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `annee_univs_int_annee_unique` (`int_annee`);

--
-- Index pour la table `dashboards`
--
ALTER TABLE `dashboards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dashboards_user_id_index` (`user_id`);

--
-- Index pour la table `enseignes`
--
ALTER TABLE `enseignes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enseignes_professeur_id_index` (`professeur_id`),
  ADD KEY `enseignes_semestre_id_index` (`semestre_id`),
  ADD KEY `enseignes_module_id_index` (`module_id`),
  ADD KEY `enseignes_niveau_id_index` (`niveau_id`);

--
-- Index pour la table `etudiants`
--
ALTER TABLE `etudiants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `etudiants_user_id_unique` (`user_id`),
  ADD UNIQUE KEY `etudiants_cne_unique` (`cne`),
  ADD UNIQUE KEY `etudiants_code_apogee_unique` (`code_apogee`),
  ADD KEY `etudiants_user_id_index` (`user_id`);

--
-- Index pour la table `examens`
--
ALTER TABLE `examens`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `liste_etudiants`
--
ALTER TABLE `liste_etudiants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `liste_etudiants_niveau_id_index` (`niveau_id`),
  ADD KEY `liste_etudiants_semestre_id_index` (`semestre_id`),
  ADD KEY `liste_etudiants_etudiant_id_index` (`etudiant_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `modules_libelle_unique` (`libelle`);

--
-- Index pour la table `niveaux`
--
ALTER TABLE `niveaux`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `niveaux_int_niveau_unique` (`int_niveau`);

--
-- Index pour la table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `professeurs`
--
ALTER TABLE `professeurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `professeurs_user_id_unique` (`user_id`),
  ADD KEY `professeurs_user_id_index` (`user_id`);

--
-- Index pour la table `semestres`
--
ALTER TABLE `semestres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `semestres_annee_univ_id_index` (`annee_univ_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annee_univs`
--
ALTER TABLE `annee_univs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `dashboards`
--
ALTER TABLE `dashboards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `enseignes`
--
ALTER TABLE `enseignes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `etudiants`
--
ALTER TABLE `etudiants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `examens`
--
ALTER TABLE `examens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `liste_etudiants`
--
ALTER TABLE `liste_etudiants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `niveaux`
--
ALTER TABLE `niveaux`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `professeurs`
--
ALTER TABLE `professeurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `semestres`
--
ALTER TABLE `semestres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
