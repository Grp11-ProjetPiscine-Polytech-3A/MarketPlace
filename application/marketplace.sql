-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u3
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 18 Novembre 2018 à 21:52
-- Version du serveur :  5.5.60-0+deb8u1
-- Version de PHP :  7.0.32-1~dotdeb+8.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `marketplace`
--

-- --------------------------------------------------------

--
-- Structure de la table `caracteristiques`
--

CREATE TABLE IF NOT EXISTS `caracteristiques` (
`idCaracteristique` int(8) unsigned NOT NULL,
  `nomCaracteristique` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `caracteristiques`
--

INSERT INTO `caracteristiques` (`idCaracteristique`, `nomCaracteristique`) VALUES
(1, 'blblbl'),
(2, 'majoliecar3');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
`idCategorie` int(8) unsigned NOT NULL,
  `descriptionCategorie` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
`idClient` int(8) unsigned NOT NULL,
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
  `pointsFidelitesClient` int(8) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`idClient`, `nomClient`, `prenomClient`, `dateNaissanceClient`, `telClient`, `mailClient`, `numAdresseClient`, `rueClient`, `codePostalClient`, `villeClient`, `complementAdresseCommerce`, `pointsFidelitesClient`) VALUES
(1, 'Paté', 'Jean', '1965-11-08', '0555869586', 'adressedejeanpate@mail.fr', 4, 'Rue des Rues', 99999, 'UCity', '', 0),
(4, 'Poulain', 'Arthur', '2018-11-14', '0665987545', 'lemaildearthur@mail.fr', 6, 'Rue de Arthur', 19000, 'Tulle', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `client_commande_effectuer`
--

CREATE TABLE IF NOT EXISTS `client_commande_effectuer` (
  `idCommande` int(8) unsigned NOT NULL,
  `idClient` int(8) unsigned NOT NULL,
  `nombrePointsUtilisés` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `client_donner_avis`
--

CREATE TABLE IF NOT EXISTS `client_donner_avis` (
  `idClient` int(8) unsigned NOT NULL,
  `idProduitVariante` int(8) unsigned NOT NULL,
  `commentaire` text NOT NULL,
  `note` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `code_reduction`
--

CREATE TABLE IF NOT EXISTS `code_reduction` (
`idCodeReduction` int(8) unsigned NOT NULL,
  `dateDebutCodeReduction` date NOT NULL,
  `dateFinCodeReduction` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `code_reduction_ligne_commande_appliquer`
--

CREATE TABLE IF NOT EXISTS `code_reduction_ligne_commande_appliquer` (
  `idCodeReduction` int(8) unsigned NOT NULL,
  `idLigneCommande` int(8) unsigned NOT NULL,
  `reductionEffective` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `code_reduction_produit_variante_concerner`
--

CREATE TABLE IF NOT EXISTS `code_reduction_produit_variante_concerner` (
  `idCodeReduction` int(8) unsigned NOT NULL,
  `idProduitVariante` int(8) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `idCommande` int(8) unsigned NOT NULL,
  `dateCommande` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commercant`
--

CREATE TABLE IF NOT EXISTS `commercant` (
`idCommercant` int(8) unsigned NOT NULL,
  `nomCommercant` varchar(64) NOT NULL,
  `prenomCommercant` varchar(64) NOT NULL,
  `dateNaissanceCommercant` date NOT NULL,
  `telCommercant` varchar(10) NOT NULL,
  `mailCommercant` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `commercant`
--

INSERT INTO `commercant` (`idCommercant`, `nomCommercant`, `prenomCommercant`, `dateNaissanceCommercant`, `telCommercant`, `mailCommercant`) VALUES
(1, 'Dupont', 'Paul', '2018-11-08', '000000000', 'dupont.paul@mail.fr');

-- --------------------------------------------------------

--
-- Structure de la table `commercant_commerce_gerer`
--

CREATE TABLE IF NOT EXISTS `commercant_commerce_gerer` (
  `idCommercant` int(8) unsigned NOT NULL,
  `siretCommerce` int(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commerce`
--

CREATE TABLE IF NOT EXISTS `commerce` (
  `siretCommerce` int(14) NOT NULL,
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
  `idCommercant` int(8) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `commerce`
--

INSERT INTO `commerce` (`siretCommerce`, `nomCommerce`, `mailCommerce`, `telCommerce`, `numAdresseCommerce`, `rueCommerce`, `codePostalCommerce`, `villeCommerce`, `complementAdresseCommerce`, `tempsReservationProduitsCommerce`, `produitsLivrablesCommerce`, `idCommercant`) VALUES
(12, 'Le Pont de Dupont', 'gnagna@mail.fr', '0654545454', 12, 'Le pont du pont', 34000, 'Montpellier', '', '23:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ligne_commande`
--

CREATE TABLE IF NOT EXISTS `ligne_commande` (
`idLigneCommande` int(8) unsigned NOT NULL,
  `etatReservationLigneCommande` varchar(64) NOT NULL,
  `quantité` int(8) NOT NULL,
  `prixAchatProduit` int(8) NOT NULL,
  `idProduitVariante` int(8) unsigned NOT NULL,
  `idCommande` int(8) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `produit_type`
--

CREATE TABLE IF NOT EXISTS `produit_type` (
`idProduitType` int(8) unsigned NOT NULL,
  `nomProduitType` varchar(128) NOT NULL,
  `descriptionProduitType` text NOT NULL,
  `prixProduitType` int(8) NOT NULL,
  `seuilStockProduitType` int(8) NOT NULL,
  `idCategorie` int(8) unsigned DEFAULT NULL,
  `siretCommerce` int(14) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `produit_type`
--

INSERT INTO `produit_type` (`idProduitType`, `nomProduitType`, `descriptionProduitType`, `prixProduitType`, `seuilStockProduitType`, `idCategorie`, `siretCommerce`) VALUES
(1, 'T-Shirt Coton', 'T-shirt en coton de fabrication française', 15, 0, NULL, 12),
(2, 'Pull-Over', 'C''EST UN PULL WOW !', 35, 0, NULL, 12);

-- --------------------------------------------------------

--
-- Structure de la table `produit_type_caracteristique`
--

CREATE TABLE IF NOT EXISTS `produit_type_caracteristique` (
  `idProduitType` int(8) unsigned NOT NULL,
  `idCaracteristique` int(8) unsigned NOT NULL,
  `contenuCaracteristique` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `produit_variante`
--

CREATE TABLE IF NOT EXISTS `produit_variante` (
`idProduitVariante` int(8) unsigned NOT NULL,
  `nomProduitVariante` varchar(128) NOT NULL,
  `descriptionProduitVariante` text NOT NULL,
  `prixProduitVariante` int(8) NOT NULL,
  `stockProduitVariante` int(8) NOT NULL DEFAULT '0',
  `idProduitType` int(8) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `produit_variante_caracteristique`
--

CREATE TABLE IF NOT EXISTS `produit_variante_caracteristique` (
  `idProduitVariante` int(8) unsigned NOT NULL,
  `idCaracteristique` int(8) unsigned NOT NULL,
  `contenuCaracteristique` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`idUser` int(10) unsigned NOT NULL,
  `loginUser` varchar(30) COLLATE utf8_bin NOT NULL,
  `passUser` varchar(128) COLLATE utf8_bin NOT NULL,
  `idCommercant` int(8) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`idUser`, `loginUser`, `passUser`, `idCommercant`) VALUES
(33, 'Dorian', 'b8bb1edd55b61a1ee0c3d8635b99aef41702ea80', NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `caracteristiques`
--
ALTER TABLE `caracteristiques`
 ADD PRIMARY KEY (`idCaracteristique`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
 ADD PRIMARY KEY (`idCategorie`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
 ADD PRIMARY KEY (`idClient`);

--
-- Index pour la table `client_commande_effectuer`
--
ALTER TABLE `client_commande_effectuer`
 ADD PRIMARY KEY (`idCommande`,`idClient`), ADD KEY `idClient` (`idClient`);

--
-- Index pour la table `client_donner_avis`
--
ALTER TABLE `client_donner_avis`
 ADD PRIMARY KEY (`idClient`,`idProduitVariante`), ADD KEY `idProduitVariante` (`idProduitVariante`);

--
-- Index pour la table `code_reduction`
--
ALTER TABLE `code_reduction`
 ADD PRIMARY KEY (`idCodeReduction`);

--
-- Index pour la table `code_reduction_ligne_commande_appliquer`
--
ALTER TABLE `code_reduction_ligne_commande_appliquer`
 ADD PRIMARY KEY (`idCodeReduction`,`idLigneCommande`), ADD KEY `idLigneCommande` (`idLigneCommande`);

--
-- Index pour la table `code_reduction_produit_variante_concerner`
--
ALTER TABLE `code_reduction_produit_variante_concerner`
 ADD PRIMARY KEY (`idCodeReduction`,`idProduitVariante`), ADD KEY `idProduitVariante` (`idProduitVariante`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
 ADD PRIMARY KEY (`idCommande`);

--
-- Index pour la table `commercant`
--
ALTER TABLE `commercant`
 ADD PRIMARY KEY (`idCommercant`);

--
-- Index pour la table `commercant_commerce_gerer`
--
ALTER TABLE `commercant_commerce_gerer`
 ADD PRIMARY KEY (`idCommercant`,`siretCommerce`), ADD KEY `fk_commerce_gerer` (`siretCommerce`), ADD KEY `fk_commercant_commerce_gerer` (`idCommercant`,`siretCommerce`);

--
-- Index pour la table `commerce`
--
ALTER TABLE `commerce`
 ADD PRIMARY KEY (`siretCommerce`), ADD KEY `index_commerce_commercant` (`idCommercant`);

--
-- Index pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
 ADD PRIMARY KEY (`idLigneCommande`), ADD KEY `idProduitVariante` (`idProduitVariante`,`idCommande`), ADD KEY `idCommande` (`idCommande`);

--
-- Index pour la table `produit_type`
--
ALTER TABLE `produit_type`
 ADD PRIMARY KEY (`idProduitType`), ADD KEY `idCategorie` (`idCategorie`,`siretCommerce`), ADD KEY `index_siretCommerce_prodType` (`siretCommerce`);

--
-- Index pour la table `produit_type_caracteristique`
--
ALTER TABLE `produit_type_caracteristique`
 ADD PRIMARY KEY (`idProduitType`,`idCaracteristique`), ADD KEY `produit_type_caracteristique_ibfk_1` (`idCaracteristique`);

--
-- Index pour la table `produit_variante`
--
ALTER TABLE `produit_variante`
 ADD PRIMARY KEY (`idProduitVariante`), ADD KEY `idProduitType` (`idProduitType`);

--
-- Index pour la table `produit_variante_caracteristique`
--
ALTER TABLE `produit_variante_caracteristique`
 ADD PRIMARY KEY (`idProduitVariante`,`idCaracteristique`), ADD KEY `idCaracteristique` (`idCaracteristique`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`idUser`), ADD KEY `idCommercant_idx` (`idCommercant`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `caracteristiques`
--
ALTER TABLE `caracteristiques`
MODIFY `idCaracteristique` int(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
MODIFY `idCategorie` int(8) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
MODIFY `idClient` int(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `code_reduction`
--
ALTER TABLE `code_reduction`
MODIFY `idCodeReduction` int(8) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `commercant`
--
ALTER TABLE `commercant`
MODIFY `idCommercant` int(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
MODIFY `idLigneCommande` int(8) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `produit_type`
--
ALTER TABLE `produit_type`
MODIFY `idProduitType` int(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `produit_variante`
--
ALTER TABLE `produit_variante`
MODIFY `idProduitVariante` int(8) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
MODIFY `idUser` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- Contraintes pour les tables exportées
--

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
-- Contraintes pour la table `commercant_commerce_gerer`
--
ALTER TABLE `commercant_commerce_gerer`
ADD CONSTRAINT `fk_commercant_gerer` FOREIGN KEY (`idCommercant`) REFERENCES `commercant` (`idCommercant`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_commerce_gerer` FOREIGN KEY (`siretCommerce`) REFERENCES `commerce` (`siretCommerce`) ON DELETE CASCADE ON UPDATE CASCADE;

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
ADD CONSTRAINT `fk_commerce_prodType` FOREIGN KEY (`siretCommerce`) REFERENCES `commerce` (`siretCommerce`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `idCommercant` FOREIGN KEY (`idCommercant`) REFERENCES `commercant` (`idCommercant`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
