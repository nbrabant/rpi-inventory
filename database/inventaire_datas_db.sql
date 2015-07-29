-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 17 Juillet 2015 à 22:22
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `inventaire_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'Fruits', '2015-07-12 17:05:11', '2015-07-12 17:05:11'),
(2, 'Légumes', '2015-07-12 17:05:21', '2015-07-12 17:05:21'),
(3, 'Boisson soft', '2015-07-12 21:54:46', '2015-07-12 21:54:46'),
(4, 'Boissons alcoolisées', '2015-07-12 21:55:01', '2015-07-12 21:55:01'),
(5, 'Congelé', '2015-07-14 10:18:31', '2015-07-14 10:18:37'),
(6, 'Produits laitiers', '2015-07-16 17:51:51', '2015-07-16 17:51:51'),
(7, 'Produits d''entretien', '2015-07-16 18:01:58', '2015-07-16 18:02:04');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2015_07_15_213246_create_categories_table', 1),
('2015_07_15_213310_create_produits_table', 1),
('2015_07_15_213319_create_operations_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `operations`
--

CREATE TABLE IF NOT EXISTS `operations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `produit_id` int(10) unsigned NOT NULL,
  `quantite` int(10) unsigned NOT NULL,
  `operation` enum('+','-') COLLATE utf8_unicode_ci NOT NULL DEFAULT '+',
  `detail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `operations_produit_id_foreign` (`produit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Contenu de la table `operations`
--

INSERT INTO `operations` (`id`, `produit_id`, `quantite`, `operation`, `detail`, `created_at`, `updated_at`) VALUES
(1, 1, 5, '+', '', '2015-07-14 20:01:15', '2015-07-14 20:01:15'),
(2, 1, 5, '+', 'second ajout', '2015-07-15 21:59:25', '2015-07-15 21:59:25'),
(3, 3, 1, '+', 'Première entrée', '2015-07-16 17:50:13', '2015-07-16 17:50:13'),
(4, 4, 1, '+', 'Première entrée', '2015-07-16 17:53:00', '2015-07-16 17:53:00'),
(6, 6, 2, '+', 'Première entrée', '2015-07-16 18:27:52', '2015-07-16 18:27:52'),
(7, 1, 2, '-', 'test retrait', '2015-07-16 20:11:54', '2015-07-16 20:11:54'),
(8, 6, 1, '-', 'vide', '2015-07-16 20:12:55', '2015-07-16 20:12:55'),
(9, 6, 2, '+', 'courses', '2015-07-16 20:13:09', '2015-07-16 20:13:09'),
(10, 6, 1, '-', 'donné au voisin', '2015-07-16 20:13:51', '2015-07-16 20:13:51'),
(11, 6, 2, '-', 'perdus', '2015-07-16 20:14:08', '2015-07-16 20:14:08');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE IF NOT EXISTS `produits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categorie_id` int(10) unsigned NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `quantite` int(10) unsigned NOT NULL,
  `quantite_min` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `produits_categorie_id_foreign` (`categorie_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `produits`
--

INSERT INTO `produits` (`id`, `categorie_id`, `nom`, `description`, `quantite`, `quantite_min`, `created_at`, `updated_at`) VALUES
(1, 2, 'Pomme de terre', 'description', 10, 5, '2015-07-12 19:54:00', '2015-07-13 19:28:36'),
(3, 4, 'Kwak', 'bouteille de Kwak de 1,5 litre', 1, 0, '2015-07-16 17:50:13', '2015-07-16 17:50:13'),
(4, 6, 'Beurre', 'barquette de 250 grammes', 1, 1, '2015-07-16 17:53:00', '2015-07-16 17:53:00'),
(6, 7, 'Liquide vaiselle', '', 0, 1, '2015-07-16 18:27:52', '2015-07-16 20:14:08');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `operations`
--
ALTER TABLE `operations`
  ADD CONSTRAINT `operations_produit_id_foreign` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_categorie_id_foreign` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
