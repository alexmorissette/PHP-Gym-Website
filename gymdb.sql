-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 02 nov. 2021 à 18:31
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gymdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `description`, `prix`, `image`) VALUES
(8, 'Poids', 'Petits poids roses pour dÃ©butants.', '35.00', '../assets/img/catalogue/7.jpg'),
(2, 'Pure Protein', 'Fournit un isolat de proteine de lactoserum microfiltre et un concentre de proteine de lactoserum ultrafiltree.', '48.00', '/assets/img/catalogue/5.jpg'),
(3, 'Equate Whey', 'Isolate de proteines de lactosirum 99% - 18 g de proteines de haute qualite par portion de 21 g (3 cuilleres) pour soutenir le developpement musculaire et la recuperation.', '48.00', '/assets/img/catalogue/6.jpg'),
(4, 'Ensemble de resistances', 'Ensemble de resistances avec poignees pour entrainement et fitness, equipement de gym a  la maison, empilable jusqu a 45,4 kg pour homme et femme, bande elastique pour les jambes et les fessiers.', '20.00', '/assets/img/catalogue/8.jpg'),
(5, 'Halteres en neoprene', 'Ideal pour l halterophile debutant.', '70.00', '/assets/img/catalogue/12.jpg'),
(9, 'Bench', 'Petit bench pour les personnes de petites tailles.', '169.00', '/assets/img/catalogue/4.jpg'),
(6, 'Abonnement (1 an)', 'Cet abonnement vous donne acces a tous les essentiels dont vous avez besoin pour vous entrainer : acces reseau illimite, cours en groupe, conseils d entraineurs, et bien plus encore', '455.00', '/assets/img/catalogue/10.jpg'),
(7, 'Abonnement 18-25 ans (1 an)', 'Vous avez entre 18 et 25 ans? Obtenez 25$ de rabais sur l abonnement EXCLUSIF.', '410.00', '../assets/img/catalogue/13.jpg'),
(39, 'Entrainement libre', 'Obtenez un accÃ¨s Ã  tous nos Ã©quipements, 7 jours sur 7 pendant nos heures d ouverture. ', '250.00', '../assets/img/catalogue/11.jpg'),
(32, 'Ballon d excercice', 'Ballon d exercice anti-Ã©clatement et antidÃ©rapant pour yoga, fitness', '15.00', '../assets/img/catalogue/14.jpg'),
(38, 'Ensemble complet de barres', 'SystÃ¨me de poulie de cÃ¢ble de fitness pour machine de musculation Ã  domicile, Ã©quipement d haltÃ©rophilie pour tractions LAT, flexions de biceps, extensions de triceps...', '135.00', '../assets/img/catalogue/2.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `UserId` int(11) NOT NULL AUTO_INCREMENT,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Telephone` varchar(14) NOT NULL,
  `Actif` tinyint(1) NOT NULL DEFAULT '1',
  `isAdmin` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`UserId`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`UserId`, `Password`, `Email`, `Nom`, `Telephone`, `Actif`, `isAdmin`) VALUES
(1, 'admin', 'admin@getinshape.com', 'Alex Morissette', '418-561-1547', 1, 1),
(4, 'bob123', 'bob@gmail.com', 'Bob LaCuilliere', '(418) 584-1198', 1, 0),
(5, '12345678', 'robert@gmail.com', 'Robert Munsch', '(123) 456-7890', 1, 0),
(6, 'abc', 'naomie@gmail.com', 'Naomie Beaudoin', '(123) 456-7890', 1, 0),
(7, '123marie', 'marie@videotron.ca', 'Marie Haggenar', '(143) 456-7870', 1, 0),
(8, 'Pa$$w0rd', 'alexmori7@gmail.com', 'Alex Morissette', '(418) 561-1124', 1, 0),
(9, 'zoe123', 'zoe@gmail.com', 'Zoe Morissette', '(123) 456-7890', 1, 0),
(10, 'cha123', 'cha@gmail.com', 'Chacha Moulinette', '(123) 456-7890', 1, 0),
(11, '123nina', 'nina@yahoo.fr', 'Nina Boulianne', '(123) 456-7890', 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
