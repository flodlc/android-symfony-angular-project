-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 22 jan. 2018 à 16:39
-- Version du serveur :  10.1.29-MariaDB
-- Version de PHP :  7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `cinema`
--

-- --------------------------------------------------------

--
-- Structure de la table `acteur`
--

CREATE TABLE IF NOT EXISTS `acteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `date_deces` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `acteur`
--

INSERT INTO `acteur` (`id`, `nom`, `prenom`, `date_naissance`, `date_deces`) VALUES
(1, 'Reno', 'Jean', '1948-07-30', '0000-00-00'),
(5, 'Portman', 'Natalie', '1981-06-09', '0000-00-00'),
(7, 'Dujardin', 'Jean', '1972-06-19', '0000-00-00'),
(8, 'Bourvil', '', '1917-07-27', '1970-09-23'),
(12, 'De Funes', 'Louis', '1914-07-31', '1983-01-27'),
(13, 'Anglade', 'Jean-Hugues', '1955-07-29', '0000-00-00'),
(15, 'Lambert', 'Christophe', '1957-03-29', '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_cat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle_cat`) VALUES
(1, 'Action'),
(2, 'Comédie'),
(3, 'Policier'),
(4, 'Western');

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

CREATE TABLE IF NOT EXISTS `film` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `duree` int(11) NOT NULL,
  `date` date NOT NULL,
  `budget` int(11) NOT NULL,
  `montant_recette` int(11) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `realisateur_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8244BE22BCF5E72D` (`categorie_id`),
  KEY `IDX_8244BE22F1D8422E` (`realisateur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `film`
--

INSERT INTO `film` (`id`, `title`, `duree`, `date`, `budget`, `montant_recette`, `categorie_id`, `realisateur_id`) VALUES
(1, 'Léon', 110, '1994-04-14', 17531000, 69250000, 3, 3),
(2, 'Cash', 100, '2008-04-23', 18340000, 60340000, 3, 4),
(3, 'La grande vadrouille', 132, '1966-12-01', 7227000, 51258000, 1, 2),
(4, 'Subway', 104, '1985-04-10', 10567000, 70500000, 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `film_personnage`
--

CREATE TABLE IF NOT EXISTS `film_personnage` (
  `film_id` int(11) NOT NULL,
  `personnage_id` int(11) NOT NULL,
  PRIMARY KEY (`film_id`,`personnage_id`),
  KEY `IDX_D50EE525567F5183` (`film_id`),
  KEY `IDX_D50EE5255E315342` (`personnage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `film_personnage`
--

INSERT INTO `film_personnage` (`film_id`, `personnage_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(3, 5),
(3, 6),
(4, 7),
(4, 8),
(4, 9);

-- --------------------------------------------------------

--
-- Structure de la table `personnage`
--

CREATE TABLE IF NOT EXISTS `personnage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acteur_id` int(11) NOT NULL,
  `nom_perso` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6AEA486DDA6F574A` (`acteur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `personnage`
--

INSERT INTO `personnage` (`id`, `acteur_id`, `nom_perso`) VALUES
(1, 1, 'Léon'),
(2, 5, 'Mathilda'),
(3, 1, 'Maxime Dubreuil'),
(4, 7, 'Cash'),
(5, 8, 'Augustin Bouvet'),
(6, 12, 'Stanislas Lefort'),
(7, 1, 'Le Batteur'),
(8, 13, 'Le Roller'),
(9, 15, 'Fred');

-- --------------------------------------------------------

--
-- Structure de la table `realisateur`
--

CREATE TABLE IF NOT EXISTS `realisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `realisateur`
--

INSERT INTO `realisateur` (`id`, `name`, `prenom`) VALUES
(1, 'Oury', 'Gaudard'),
(2, 'Chabrol', 'Claude'),
(3, 'Besson', 'Luc'),
(4, 'Besnard', 'Eric');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `FK_8244BE22BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`),
  ADD CONSTRAINT `FK_8244BE22F1D8422E` FOREIGN KEY (`realisateur_id`) REFERENCES `realisateur` (`id`);

--
-- Contraintes pour la table `film_personnage`
--
ALTER TABLE `film_personnage`
  ADD CONSTRAINT `FK_D50EE525567F5183` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D50EE5255E315342` FOREIGN KEY (`personnage_id`) REFERENCES `personnage` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `personnage`
--
ALTER TABLE `personnage`
  ADD CONSTRAINT `FK_6AEA486DDA6F574A` FOREIGN KEY (`acteur_id`) REFERENCES `acteur` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
