-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 15 Juillet 2015 à 23:50
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'Fruits', '2015-07-12 19:05:11', '2015-07-12 19:05:11'),
(2, 'Légumes', '2015-07-12 19:05:21', '2015-07-12 19:05:21'),
(3, 'Boisson soft', '2015-07-12 23:54:46', '2015-07-12 23:54:46'),
(4, 'Boissons alcoolisées', '2015-07-12 23:55:01', '2015-07-12 23:55:01'),
(5, 'Congelé', '2015-07-14 12:18:31', '2015-07-14 12:18:37');

-- --------------------------------------------------------

--
-- Structure de la table `operations`
--

CREATE TABLE IF NOT EXISTS `operations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `operation` enum('+','-') NOT NULL DEFAULT '+',
  `detail` varchar(128) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `operations`
--

INSERT INTO `operations` (`id`, `produit_id`, `quantite`, `operation`, `detail`, `created_at`, `updated_at`) VALUES
(1, 1, 5, '+', '', '2015-07-14 22:01:15', '2015-07-14 22:01:15');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE IF NOT EXISTS `produits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text,
  `quantite` int(10) unsigned NOT NULL,
  `quantite_min` int(11) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `produits`
--

INSERT INTO `produits` (`id`, `categorie_id`, `nom`, `description`, `quantite`, `quantite_min`, `created_at`, `updated_at`) VALUES
(1, 2, 'Pomme de terre', 'description', 10, 5, '2015-07-12 21:54:00', '2015-07-13 21:28:36');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
