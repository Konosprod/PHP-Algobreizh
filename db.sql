-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 19 Avril 2016 à 09:15
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `algobreizh_gestion`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `idArticle` int(11) NOT NULL AUTO_INCREMENT,
  `codeArticle` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `libelleArticle` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `prix` float NOT NULL,
  `unite` float NOT NULL,
  `TVA` float NOT NULL,
  `idFamille` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idArticle`),
  KEY `idFamille` (`idFamille`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Contenu de la table `articles`
--

INSERT INTO `articles` (`idArticle`, `codeArticle`, `libelleArticle`, `prix`, `unite`, `TVA`, `idFamille`, `path`) VALUES
(6, 'AS0001', 'Dulse', 4.9, 1, 0.2, 1, '../Images/images_produits/algues_seche/dulse.jpg'),
(7, 'AS0002', 'Dulse feuille', 6.5, 1, 0.2, 1, '../Images/images_produits/algues_seche/dulse_feuille.jpg'),
(8, 'AS0003', 'Kombu royal', 5.9, 1, 0.2, 1, '../Images/images_produits/algues_seche/kombu_royal.jpg'),
(9, 'AS0004', 'Wakamé biologique', 7.25, 1, 0.2, 1, '../Images/images_produits/algues_seche/wakame_biologique_feuille.jpg'),
(10, 'AS0005', 'Wakamé biologique feuille', 11.9, 1, 0.2, 1, '../Images/images_produits/algues_seche/wakame_biologique_feuillelongue.jpg'),
(11, 'AC0001', 'Haricots de mer', 5.8, 1, 0.2, 3, '../Images/images_produits/conserve/haricots_mer.jpg'),
(12, 'AC0002', 'Salicornes naturelles', 4.9, 1, 0.2, 3, ''),
(13, 'AC0003', 'Salicornes au vinaigre', 5.5, 1, 0.2, 3, ''),
(14, 'PA0001', 'Pâtes algamar', 6.9, 1, 0.2, 7, ''),
(15, 'PA0002', 'Pâtes algues marine', 4.2, 1, 0.2, 7, ''),
(16, 'PA0003', 'Pâtes dulse', 6.2, 1, 0.2, 7, ''),
(17, 'PA0004', 'Pâtes spiruline', 7.8, 1, 0.2, 7, ''),
(18, 'PA0005', 'Pâtes wakamé', 5.5, 1, 0.2, 7, ''),
(19, 'AP0001', 'Algues marine en poudre', 7.5, 1, 0.2, 5, ''),
(20, 'AP0002', 'Dulse en poudre', 7.8, 1, 0.2, 5, ''),
(21, 'AP0003', 'Wakamé en poudre', 8.6, 1, 0.2, 5, ''),
(22, 'AP0004', 'Spiruline en poudre', 8.4, 1, 0.2, 5, '');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE IF NOT EXISTS `commandes` (
  `idCommande` int(11) NOT NULL AUTO_INCREMENT,
  `montant` float NOT NULL,
  `dateCommande` datetime NOT NULL,
  `codeClient` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `valide` tinyint(1) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idCommande`),
  KEY `codeClient` (`codeClient`),
  KEY `FK_commandes_idUtilisateur` (`idUtilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `commandes`
--

INSERT INTO `commandes` (`idCommande`, `montant`, `dateCommande`, `codeClient`, `valide`, `idUtilisateur`) VALUES
(1, 9.13, '2016-02-10 08:51:30', 'c00002', 0, 19);

-- --------------------------------------------------------

--
-- Structure de la table `details`
--

CREATE TABLE IF NOT EXISTS `details` (
  `idDetail` int(11) NOT NULL AUTO_INCREMENT,
  `codeArticle` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `qteArticle` int(11) NOT NULL,
  `montant` float NOT NULL,
  `idCommande` int(11) NOT NULL,
  `idArticle` int(11) NOT NULL,
  PRIMARY KEY (`idDetail`),
  KEY `codeArticle` (`codeArticle`,`idCommande`),
  KEY `FK_details_idCommande_commandes` (`idCommande`),
  KEY `FK_details_idArticle` (`idArticle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `familles`
--

CREATE TABLE IF NOT EXISTS `familles` (
  `idFamille` int(11) NOT NULL AUTO_INCREMENT,
  `libelleFamille` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `codeFamille` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idFamille`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `familles`
--

INSERT INTO `familles` (`idFamille`, `libelleFamille`, `codeFamille`, `path`) VALUES
(1, 'Algues séchées', 'FAR00001', '../Images/images_famille/famille_seche.png'),
(3, 'Algues en conserve', 'FAR00003', '../Images/images_famille/famille_conserve.png'),
(5, 'Algues en poudre', 'FAR00005', '../Images/images_famille/famille_poudre.png'),
(7, 'Pâtes  aux algues', 'FAR00007', '../Images/images_famille/famille_pate.png');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `codeClient` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `ville` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `codePostal` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `motDePasse` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `teleprospecteur` tinyint(1) NOT NULL,
  PRIMARY KEY (`idUtilisateur`),
  UNIQUE KEY `codeClient` (`codeClient`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`idUtilisateur`, `codeClient`, `email`, `nom`, `prenom`, `ville`, `codePostal`, `adresse`, `telephone`, `motDePasse`, `teleprospecteur`) VALUES
(1, 'C00001', 'test@test.fr', 'Test', 'Test', 'Test', '35700', 'Test rue du test', '0675757575', '8b7df143d91c716ecfa5fc1730022f6b421b05cedee8fd52b1fc65a96030ad52', 1),
(19, 'c00002', '', '', '', '', '', '', '', '4e3844f32fde99f7167bd48e245fa4e6db9ebd898760795efaf14a306027128a', 0);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `FK_commandes_idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `details`
--
ALTER TABLE `details`
  ADD CONSTRAINT `FK_details_idArticle` FOREIGN KEY (`idArticle`) REFERENCES `articles` (`idArticle`),
  ADD CONSTRAINT `FK_details_idCommande_commandes` FOREIGN KEY (`idCommande`) REFERENCES `commandes` (`idCommande`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
