-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 02 déc. 2018 à 13:43
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
-- Base de données :  `marketplace`
--

-- --------------------------------------------------------

--
-- Structure de la table `caracteristiques`
--

DROP TABLE IF EXISTS `caracteristiques`;
CREATE TABLE IF NOT EXISTS `caracteristiques` (
  `idCaracteristique` int(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nomCaracteristique` varchar(128) NOT NULL,
  PRIMARY KEY (`idCaracteristique`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `caracteristiques`
--

INSERT INTO `caracteristiques` (`idCaracteristique`, `nomCaracteristique`) VALUES
(1, 'blblbl'),
(2, 'majoliecar3');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `idCategorie` int(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `descriptionCategorie` text NOT NULL,
  PRIMARY KEY (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `descriptionCategorie`) VALUES
(1, 'textile'),
(2, 'High-Tech'),
(3, 'Jardin');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `idClient` int(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nomClient` varchar(64) NOT NULL,
  `prenomClient` varchar(64) NOT NULL,
  `dateNaissanceClient` date NOT NULL,
  `telClient` varchar(10) NOT NULL,
  `mailClient` varchar(64) NOT NULL,
  `numAdresseClient` int(4) NOT NULL,
  `rueClient` varchar(64) NOT NULL,
  `codePostalClient` int(10) NOT NULL,
  `villeClient` varchar(64) NOT NULL,
  `complementAdresseCommerce` varchar(128) NOT NULL,
  `pointsFidelitesClient` int(8) NOT NULL DEFAULT '0',
  `idUser` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`idClient`),
  KEY `idUser` (`idUser`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`idClient`, `nomClient`, `prenomClient`, `dateNaissanceClient`, `telClient`, `mailClient`, `numAdresseClient`, `rueClient`, `codePostalClient`, `villeClient`, `complementAdresseCommerce`, `pointsFidelitesClient`, `idUser`) VALUES
(1, 'Paté', 'Jean', '1965-11-08', '0555869586', 'adressedejeanpate@mail.fr', 4, 'Rue des Rues', 99999, 'UCity', '', 0, NULL),
(4, 'Poulain', 'Arthur', '2018-11-14', '0665987545', 'lemaildearthur@mail.fr', 6, 'Rue de Arthur', 19000, 'Tulle', '', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `client_commande_effectuer`
--

DROP TABLE IF EXISTS `client_commande_effectuer`;
CREATE TABLE IF NOT EXISTS `client_commande_effectuer` (
  `idCommande` int(8) UNSIGNED NOT NULL,
  `idClient` int(8) UNSIGNED NOT NULL,
  `nombrePointsUtilisés` int(8) NOT NULL,
  PRIMARY KEY (`idCommande`,`idClient`),
  KEY `idClient` (`idClient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `client_donner_avis`
--

DROP TABLE IF EXISTS `client_donner_avis`;
CREATE TABLE IF NOT EXISTS `client_donner_avis` (
  `idClient` int(8) UNSIGNED NOT NULL,
  `idProduitVariante` int(8) UNSIGNED NOT NULL,
  `commentaire` text NOT NULL,
  `note` int(8) NOT NULL,
  PRIMARY KEY (`idClient`,`idProduitVariante`),
  KEY `idProduitVariante` (`idProduitVariante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `code_reduction`
--

DROP TABLE IF EXISTS `code_reduction`;
CREATE TABLE IF NOT EXISTS `code_reduction` (
  `idCodeReduction` int(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dateDebutCodeReduction` date NOT NULL,
  `dateFinCodeReduction` date NOT NULL,
  PRIMARY KEY (`idCodeReduction`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `code_reduction_ligne_commande_appliquer`
--

DROP TABLE IF EXISTS `code_reduction_ligne_commande_appliquer`;
CREATE TABLE IF NOT EXISTS `code_reduction_ligne_commande_appliquer` (
  `idCodeReduction` int(8) UNSIGNED NOT NULL,
  `idLigneCommande` int(8) UNSIGNED NOT NULL,
  `reductionEffective` int(8) NOT NULL,
  PRIMARY KEY (`idCodeReduction`,`idLigneCommande`),
  KEY `idLigneCommande` (`idLigneCommande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `code_reduction_produit_variante_concerner`
--

DROP TABLE IF EXISTS `code_reduction_produit_variante_concerner`;
CREATE TABLE IF NOT EXISTS `code_reduction_produit_variante_concerner` (
  `idCodeReduction` int(8) UNSIGNED NOT NULL,
  `idProduitVariante` int(8) UNSIGNED NOT NULL,
  PRIMARY KEY (`idCodeReduction`,`idProduitVariante`),
  KEY `idProduitVariante` (`idProduitVariante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `idCommande` int(8) UNSIGNED NOT NULL,
  `dateCommande` date NOT NULL,
  PRIMARY KEY (`idCommande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commercant`
--

DROP TABLE IF EXISTS `commercant`;
CREATE TABLE IF NOT EXISTS `commercant` (
  `idCommercant` int(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nomCommercant` varchar(64) NOT NULL,
  `prenomCommercant` varchar(64) NOT NULL,
  `dateNaissanceCommercant` date NOT NULL,
  `telCommercant` varchar(10) NOT NULL,
  `idUser` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`idCommercant`),
  KEY `fk_user_commercant` (`idUser`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commercant_commerce_gerer`
--

DROP TABLE IF EXISTS `commercant_commerce_gerer`;
CREATE TABLE IF NOT EXISTS `commercant_commerce_gerer` (
  `idCommercant` int(8) UNSIGNED NOT NULL,
  `siretCommerce` varchar(14) NOT NULL,
  PRIMARY KEY (`idCommercant`,`siretCommerce`),
  KEY `fk_commerce_gerer` (`siretCommerce`),
  KEY `fk_commercant_commerce_gerer` (`idCommercant`,`siretCommerce`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commerce`
--

DROP TABLE IF EXISTS `commerce`;
CREATE TABLE IF NOT EXISTS `commerce` (
  `siretCommerce` varchar(14) NOT NULL,
  `nomCommerce` varchar(128) NOT NULL,
  `mailCommerce` varchar(64) NOT NULL,
  `telCommerce` varchar(10) NOT NULL,
  `numAdresseCommerce` int(4) NOT NULL,
  `rueCommerce` varchar(64) NOT NULL,
  `codePostalCommerce` int(10) NOT NULL,
  `villeCommerce` varchar(64) NOT NULL,
  `complementAdresseCommerce` varchar(128) NOT NULL,
  `tempsReservationProduitsCommerce` time NOT NULL,
  `produitsLivrablesCommerce` tinyint(1) NOT NULL,
  `idCommercant` int(8) UNSIGNED NOT NULL,
  `descriptionCommerce` text,
  PRIMARY KEY (`siretCommerce`),
  KEY `index_commerce_commercant` (`idCommercant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ligne_commande`
--

DROP TABLE IF EXISTS `ligne_commande`;
CREATE TABLE IF NOT EXISTS `ligne_commande` (
  `idLigneCommande` int(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `etatReservationLigneCommande` varchar(64) NOT NULL,
  `quantité` int(8) NOT NULL,
  `prixAchatProduit` int(8) NOT NULL,
  `idProduitVariante` int(8) UNSIGNED NOT NULL,
  `idCommande` int(8) UNSIGNED NOT NULL,
  PRIMARY KEY (`idLigneCommande`),
  KEY `idProduitVariante` (`idProduitVariante`,`idCommande`),
  KEY `idCommande` (`idCommande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `produit_type`
--

DROP TABLE IF EXISTS `produit_type`;
CREATE TABLE IF NOT EXISTS `produit_type` (
  `idProduitType` int(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nomProduitType` varchar(128) NOT NULL,
  `descriptionProduitType` text NOT NULL,
  `prixProduitType` float NOT NULL,
  `seuilStockProduitType` int(8) NOT NULL,
  `idCategorie` int(8) UNSIGNED DEFAULT NULL,
  `siretCommerce` varchar(14) NOT NULL,
  PRIMARY KEY (`idProduitType`),
  KEY `idCategorie` (`idCategorie`,`siretCommerce`),
  KEY `index_siretCommerce_prodType` (`siretCommerce`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `produit_type_caracteristique`
--

DROP TABLE IF EXISTS `produit_type_caracteristique`;
CREATE TABLE IF NOT EXISTS `produit_type_caracteristique` (
  `idProduitType` int(8) UNSIGNED NOT NULL,
  `idCaracteristique` int(8) UNSIGNED NOT NULL,
  `contenuCaracteristique` text NOT NULL,
  PRIMARY KEY (`idProduitType`,`idCaracteristique`),
  KEY `produit_type_caracteristique_ibfk_1` (`idCaracteristique`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `produit_variante`
--

DROP TABLE IF EXISTS `produit_variante`;
CREATE TABLE IF NOT EXISTS `produit_variante` (
  `idProduitVariante` int(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nomProduitVariante` varchar(128) NOT NULL,
  `descriptionProduitVariante` text NOT NULL,
  `prixProduitVariante` int(8) NOT NULL,
  `stockProduitVariante` int(8) NOT NULL DEFAULT '0',
  `idProduitType` int(8) UNSIGNED NOT NULL,
  PRIMARY KEY (`idProduitVariante`),
  KEY `idProduitType` (`idProduitType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `produit_variante_caracteristique`
--

DROP TABLE IF EXISTS `produit_variante_caracteristique`;
CREATE TABLE IF NOT EXISTS `produit_variante_caracteristique` (
  `idProduitVariante` int(8) UNSIGNED NOT NULL,
  `idCaracteristique` int(8) UNSIGNED NOT NULL,
  `contenuCaracteristique` text NOT NULL,
  PRIMARY KEY (`idProduitVariante`,`idCaracteristique`),
  KEY `idCaracteristique` (`idCaracteristique`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `idUser` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `loginUser` varchar(30) COLLATE utf8_bin NOT NULL,
  `passUser` varchar(128) COLLATE utf8_bin NOT NULL,
  `mailUser` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`idUser`, `loginUser`, `passUser`, `mailUser`) VALUES
(33, 'Dorian', 'b8bb1edd55b61a1ee0c3d8635b99aef41702ea80', NULL),
(34, 'Salut', '571e19fe916eff3af57ffd51f13cd658893f2634', NULL),
(35, 'pepito', '3c8bd30b2580ca368fdae0b10d0c9bbcfba9918b', NULL),
(36, 'MoiMoi', '831af61650b512b4f9b0c8cdc0134680d27878b9', NULL),
(37, 'Bonjour', '2fd0df88b6bb3faf3c60c99b4cefa147fd84f17d', NULL),
(38, 'admin', '2ed665c31e8260f6f5beb39686c4bb576b3a3f20', NULL),
(39, 'xXx_cOmPteDu32_xXx', 'ac4a827bc5c56414c0a50faa67da1d0fa1c85110', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `client_commande_effectuer`
--
ALTER TABLE `client_commande_effectuer`
  ADD CONSTRAINT `client_commande_effectuer_ibfk_1` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`idCommande`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `client_commande_effectuer_ibfk_2` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `client_donner_avis`
--
ALTER TABLE `client_donner_avis`
  ADD CONSTRAINT `client_donner_avis_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `client_donner_avis_ibfk_2` FOREIGN KEY (`idProduitVariante`) REFERENCES `produit_variante` (`idProduitVariante`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `code_reduction_ligne_commande_appliquer`
--
ALTER TABLE `code_reduction_ligne_commande_appliquer`
  ADD CONSTRAINT `code_reduction_ligne_commande_appliquer_ibfk_1` FOREIGN KEY (`idLigneCommande`) REFERENCES `ligne_commande` (`idLigneCommande`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `code_reduction_ligne_commande_appliquer_ibfk_2` FOREIGN KEY (`idCodeReduction`) REFERENCES `code_reduction` (`idCodeReduction`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `code_reduction_produit_variante_concerner`
--
ALTER TABLE `code_reduction_produit_variante_concerner`
  ADD CONSTRAINT `code_reduction_produit_variante_concerner_ibfk_1` FOREIGN KEY (`idCodeReduction`) REFERENCES `code_reduction` (`idCodeReduction`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `code_reduction_produit_variante_concerner_ibfk_2` FOREIGN KEY (`idProduitVariante`) REFERENCES `produit_variante` (`idProduitVariante`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commercant`
--
ALTER TABLE `commercant`
  ADD CONSTRAINT `commercant_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commercant_commerce_gerer`
--
ALTER TABLE `commercant_commerce_gerer`
  ADD CONSTRAINT `commercant_commerce_gerer_ibfk_1` FOREIGN KEY (`siretCommerce`) REFERENCES `commerce` (`siretCommerce`),
  ADD CONSTRAINT `fk_commercant_gerer` FOREIGN KEY (`idCommercant`) REFERENCES `commercant` (`idCommercant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commerce`
--
ALTER TABLE `commerce`
  ADD CONSTRAINT `fk_commercant_commerce` FOREIGN KEY (`idCommercant`) REFERENCES `commercant` (`idCommercant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
  ADD CONSTRAINT `ligne_commande_ibfk_1` FOREIGN KEY (`idProduitVariante`) REFERENCES `produit_variante` (`idProduitVariante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ligne_commande_ibfk_2` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`idCommande`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `produit_type`
--
ALTER TABLE `produit_type`
  ADD CONSTRAINT `fk_categ_produitType` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produit_type_ibfk_1` FOREIGN KEY (`siretCommerce`) REFERENCES `commerce` (`siretCommerce`);

--
-- Contraintes pour la table `produit_type_caracteristique`
--
ALTER TABLE `produit_type_caracteristique`
  ADD CONSTRAINT `produit_type_caracteristique_ibfk_1` FOREIGN KEY (`idCaracteristique`) REFERENCES `caracteristiques` (`idCaracteristique`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produit_type_caracteristique_ibfk_2` FOREIGN KEY (`idProduitType`) REFERENCES `produit_type` (`idProduitType`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `produit_variante`
--
ALTER TABLE `produit_variante`
  ADD CONSTRAINT `produit_variante_ibfk_1` FOREIGN KEY (`idProduitType`) REFERENCES `produit_type` (`idProduitType`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `produit_variante_caracteristique`
--
ALTER TABLE `produit_variante_caracteristique`
  ADD CONSTRAINT `produit_variante_caracteristique_ibfk_1` FOREIGN KEY (`idCaracteristique`) REFERENCES `caracteristiques` (`idCaracteristique`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produit_variante_caracteristique_ibfk_2` FOREIGN KEY (`idProduitVariante`) REFERENCES `produit_variante` (`idProduitVariante`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
