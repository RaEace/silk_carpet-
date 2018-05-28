-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 28 mai 2018 à 21:40
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `test_projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `membres1`
--

DROP TABLE IF EXISTS `membres1`;
CREATE TABLE IF NOT EXISTS `membres1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(60) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `tel` char(14) NOT NULL,
  `adresse` text NOT NULL,
  `postal` int(5) NOT NULL,
  `classe` varchar(200) NOT NULL,
  `matiere` varchar(200) DEFAULT NULL,
  `points` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `membres1`
--

INSERT INTO `membres1` (`id`, `pseudo`, `email`, `pass`, `lname`, `fname`, `tel`, `adresse`, `postal`, `classe`, `matiere`, `points`) VALUES
(4, 'jules', 'jules.lagny@efrei.net', '$2y$10$bdou90ebXPp/U/ouVoqBN.Aja9TpwtWc8hsSXWg3hHk8UFYgyV9cm', 'Jules', 'Lagny', '0624536735', '35 rue du Puits', 75013, 'L2 classique', 'Physique', 100),
(2, 'stefi', 'stefania.kukovski@efrei.net', '$2y$10$/Kgkqd6NfmrQ.sRCBdfTyuTwGHpxmyZgqWHikoHxryT0wWdfH.aU2', 'Kukovski', 'Stéfania', '0628563089', '48 rue des Guipons', 94800, 'L2 int', 'Mathematiques,Physique', 100),
(6, 'lilia', 'lilia.cherif@efrei.net', '$2y$10$Fx787pd8sYXldoMExYxKpu0tQ8bVB/apN6cWsBHmouZ8pu2VvGNLq', 'Cherif', 'Lilia', '0635637222', '12 rue de Rungis', 75013, 'L2 int', 'Mathematiques', 100),
(5, 'amandine', 'amandine.minier@efrei.net', '$2y$10$XMlTCbuqpbcm/Cxrq9SxyesMC8DvKVSVacGFfSOBwl30Q7NmOD21.', 'Minier', 'Amandine', '0634524263', '33 rue des ouvriers', 94800, 'PL2', 'Mathematiques,Physique,Formation Generale', 100),
(7, 'mathis', 'mathis.powell@efrei.net', '$2y$10$YC24yXIr4d.Mx8F.xHTSYOjFek6IuRlH06rXipPIilgd47QWdzRG.', 'Powell', 'Mathis', '0634223456', '56 rue de la Gare', 75015, 'L2 classique', NULL, 100),
(8, 'Elisette', 'elise.auffrey@esigetel.fr', '$2y$10$qfWOnd7wa0BhPKN.PMLQ5ObLxiDDm.JLw63DygDknI6Mt2N3F5yKm', 'Auffrey', 'Elise', '0654343232', '67 rue des Fèves', 78654, 'L3 new', 'Physique,Formation Generale', 100);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
