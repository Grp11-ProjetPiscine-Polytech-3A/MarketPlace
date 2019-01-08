-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u3
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 08 Janvier 2019 à 09:02
-- Version du serveur :  5.5.62-0+deb8u1
-- Version de PHP :  7.0.33-1~dotdeb+8.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `marketplace_backup`
--
CREATE DATABASE IF NOT EXISTS `marketplace_backup` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `marketplace_backup`;

-- --------------------------------------------------------

--
-- Structure de la table `caracteristiques`
--

CREATE TABLE IF NOT EXISTS `caracteristiques` (
`idCaracteristique` int(8) unsigned NOT NULL,
  `nomCaracteristique` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `descriptionCategorie`) VALUES
(1, 'textile'),
(2, 'High-Tech'),
(3, 'Jardin'),
(4, 'Jeux vidéos'),
(5, 'Electronique');

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
  `pointsFidelitesClient` int(8) NOT NULL DEFAULT '0',
  `idUser` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`idClient`, `nomClient`, `prenomClient`, `dateNaissanceClient`, `telClient`, `mailClient`, `numAdresseClient`, `rueClient`, `codePostalClient`, `villeClient`, `complementAdresseCommerce`, `pointsFidelitesClient`, `idUser`) VALUES
(1, 'Paté', 'Jean', '1965-11-08', '0555869586', 'adressedejeanpate@mail.fr', 4, 'Rue des Rues', 99999, 'UCity', '', 0, NULL),
(4, 'Poulain', 'Arthur', '2018-11-14', '0665987545', 'lemaildearthur@mail.fr', 6, 'Rue de Arthur', 19000, 'Tulle', '', 0, NULL),
(5, 'SAIMOND', 'Etienne', '1996-12-16', '0760644462', 'etienne.saimond@etu.umontpellier.fr', 120, 'Avenue du professeur Emile Jeanbrau', 34090, 'Montpellier', '', 9999, 35),
(6, '', '', '0000-00-00', '', '', 0, '', 0, '', '', 0, 51);

-- --------------------------------------------------------

--
-- Structure de la table `client_commande_effectuer`
--

CREATE TABLE IF NOT EXISTS `client_commande_effectuer` (
  `idCommande` int(8) unsigned NOT NULL,
  `idClient` int(8) unsigned NOT NULL,
  `nombrePointsUtilisés` int(8) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `client_commande_effectuer`
--

INSERT INTO `client_commande_effectuer` (`idCommande`, `idClient`, `nombrePointsUtilisés`) VALUES
(1, 5, 0),
(2, 5, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`idCommande`, `dateCommande`) VALUES
(1, '2018-12-15'),
(2, '2018-12-15');

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
  `idUser` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `commercant`
--

INSERT INTO `commercant` (`idCommercant`, `nomCommercant`, `prenomCommercant`, `dateNaissanceCommercant`, `telCommercant`, `idUser`) VALUES
(2, 'Dédé', 'Dupont', '2018-11-08', '000000000', 35),
(3, 'Saimond', 'Etienne', '1996-12-16', '0666666666', 35),
(4, 'Laurancy', 'Dorian', '2018-03-18', '000000000', 33);

-- --------------------------------------------------------

--
-- Structure de la table `commercant_commerce_gerer`
--

CREATE TABLE IF NOT EXISTS `commercant_commerce_gerer` (
  `idCommercant` int(8) unsigned NOT NULL,
  `siretCommerce` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commerce`
--

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
  `idCommercant` int(8) unsigned NOT NULL,
  `descriptionCommerce` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `commerce`
--

INSERT INTO `commerce` (`siretCommerce`, `nomCommerce`, `mailCommerce`, `telCommerce`, `numAdresseCommerce`, `rueCommerce`, `codePostalCommerce`, `villeCommerce`, `complementAdresseCommerce`, `tempsReservationProduitsCommerce`, `produitsLivrablesCommerce`, `idCommercant`, `descriptionCommerce`) VALUES
('12345678912345', 'Le commerce de Dédé', 'comdedede@mail.com', '0612345678', 12, 'Rue du pont', 34000, 'Montpellier', '', '800:00:00', 0, 2, 'Un petit commerce sympatique');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ligne_commande`
--

INSERT INTO `ligne_commande` (`idLigneCommande`, `etatReservationLigneCommande`, `quantité`, `prixAchatProduit`, `idProduitVariante`, `idCommande`) VALUES
(1, 'Reservé', 3, 36, 1, 1),
(2, 'Reservé', 5, 35, 5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `produit_type`
--

CREATE TABLE IF NOT EXISTS `produit_type` (
`idProduitType` int(8) unsigned NOT NULL,
  `nomProduitType` varchar(128) NOT NULL,
  `descriptionProduitType` text NOT NULL,
  `seuilStockProduitType` int(8) NOT NULL,
  `idCategorie` int(8) unsigned DEFAULT NULL,
  `siretCommerce` varchar(14) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `produit_type`
--

INSERT INTO `produit_type` (`idProduitType`, `nomProduitType`, `descriptionProduitType`, `seuilStockProduitType`, `idCategorie`, `siretCommerce`) VALUES
(1, 'TShirts ', 'Fabrication française', 0, 1, '12345678912345'),
(2, 'Echarpe', 'Echarpe 100% coton', 0, 1, '12345678912345'),
(3, 'iPhone 10', 'L''iphone 10 de apple', 0, 2, '12345678912345'),
(4, 'Toboggan', 'A mettre dans tous les jardins', 0, 3, '12345678912345'),
(5, 'Bonnet', 'Un bonnet', 0, 1, '12345678912345'),
(9, 'galaxy s10', 'Le dernier téléphone de Samsung', 0, 2, '12345678912345'),
(10, 'Clavier', 'Pour écrire', 0, 2, '12345678912345'),
(15, 'Arrosoir', 'Un arrosoir pour arroser', 20, 3, '12345678912345'),
(17, 'Pokemon Rouge', 'Le dernier jeu de Nintendo a la mode', 1, 4, '12345678912345'),
(18, 'Pokemon Jaune', 'Le dernier jeu de Nintendo à la mode', 2, 4, '12345678912345'),
(19, 'Pokemon Or', 'Le dernier jeu de Nintendo à la mode', 2, 4, '12345678912345'),
(20, 'Pokemon Or', 'Le dernier jeu de Nintendo à la mode', 2, 4, '12345678912345'),
(21, 'Pokemon Or', 'Le dernier jeu de Nintendo à la mode', 2, 4, '12345678912345'),
(22, 'Pokemon Or', 'Le dernier jeu de Nintendo à la mode', 2, 4, '12345678912345'),
(23, 'Pokemon Or', 'Le dernier jeu de Nintendo à la mode', 2, 4, '12345678912345'),
(24, 'Pokemon Or', 'Le dernier jeu de Nintendo à la mode', 2, 4, '12345678912345'),
(25, 'Pokemon Vert Feuille', 'Un jeu game boy Advance', 20, 4, '12345678912345'),
(26, 'Pokemon Vert Feuille', 'Un jeu game boy Advance', 20, 4, '12345678912345'),
(27, 'Pokemon Vert Feuille', 'Un jeu game boy Advance', 20, 4, '12345678912345'),
(28, 'Pokemon Vert Feuille', 'Un jeu game boy Advance', 20, 4, '12345678912345'),
(29, 'Pokemon Vert Feuille', 'Un jeu game boy Advance', 20, 4, '12345678912345'),
(30, 'Pokemon Vert Feuille', 'Un jeu game boy Advance', 20, 4, '12345678912345'),
(31, 'Pokemon Vert Feuille', 'Un jeu game boy Advance', 20, 4, '12345678912345'),
(32, 'Condensateur', 'Electronique', 100, 5, '12345678912345'),
(33, 'Condensateur', 'Electronique', 100, 5, '12345678912345'),
(34, 'Condensateur', 'Electronique', 100, 5, '12345678912345'),
(35, 'Led', 'Lumière !', 200, 5, '12345678912345'),
(36, 'Led', 'Lumière !', 200, 5, '12345678912345'),
(37, 'Led', 'Lumière !', 200, 5, '12345678912345');

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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `produit_variante`
--

INSERT INTO `produit_variante` (`idProduitVariante`, `nomProduitVariante`, `descriptionProduitVariante`, `prixProduitVariante`, `stockProduitVariante`, `idProduitType`) VALUES
(1, 'Rouge', 'Un TShirts Rouge', 30, 50, 1),
(2, 'Vert', 'Un TShirts Vert', 27, 45, 1),
(3, 'Noir', 'Un TShirts Noir', 36, 60, 1),
(4, 'Violet', 'Un TShirts Violet', 32, 42, 1),
(5, 'Bleu', 'Un TShirts Vert', 33, 54, 1),
(8, 'neutre', 'Le dernier jeu de Nintendo à la mode', 60, 4, 18),
(9, 'neutre', 'Le dernier jeu de Nintendo à la mode', 60, 4, 19),
(10, 'neutre', 'Le dernier jeu de Nintendo à la mode', 60, 4, 19),
(11, 'neutre', 'Le dernier jeu de Nintendo à la mode', 60, 4, 19),
(12, 'neutre', 'Le dernier jeu de Nintendo à la mode', 60, 4, 19),
(13, 'neutre', 'Le dernier jeu de Nintendo à la mode', 60, 4, 19),
(14, 'Pokemon Or', 'Le dernier jeu de Nintendo à la mode', 60, 4, 19),
(15, 'Pokemon Vert Feuille', 'Un jeu game boy Advance', 60, 50, 25),
(16, 'Pokemon Vert Feuille', 'Un jeu game boy Advance', 60, 50, 25),
(17, 'Pokemon Vert Feuille', 'Un jeu game boy Advance', 60, 50, 25),
(18, 'Pokemon Vert Feuille', 'Un jeu game boy Advance', 60, 50, 25),
(19, 'Pokemon Vert Feuille', 'Un jeu game boy Advance', 60, 50, 25),
(20, 'Pokemon Vert Feuille', 'Un jeu game boy Advance', 60, 50, 25),
(21, 'Pokemon Vert Feuille', 'Un jeu game boy Advance', 60, 50, 25),
(22, 'Condensateur', 'Electronique', 0, 500, 32),
(23, 'Condensateur', 'Electronique', 0, 500, 32),
(24, 'Condensateur', 'Electronique', 0, 500, 32),
(25, 'Led', 'Lumière !', 1, 500, 35),
(26, 'Led', 'Lumière !', 1, 500, 35),
(27, 'Led', 'Lumière !', 1, 500, 35);

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
  `mailUser` varchar(256) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`idUser`, `loginUser`, `passUser`, `mailUser`) VALUES
(33, 'Dorian', 'b8bb1edd55b61a1ee0c3d8635b99aef41702ea80', NULL),
(34, 'Salut', '571e19fe916eff3af57ffd51f13cd658893f2634', NULL),
(35, 'pepito', '3c8bd30b2580ca368fdae0b10d0c9bbcfba9918b', NULL),
(36, 'MoiMoi', '831af61650b512b4f9b0c8cdc0134680d27878b9', NULL),
(37, 'Bonjour', '2fd0df88b6bb3faf3c60c99b4cefa147fd84f17d', NULL),
(38, 'admin', '2ed665c31e8260f6f5beb39686c4bb576b3a3f20', NULL),
(39, 'xXx_cOmPteDu32_xXx', 'ac4a827bc5c56414c0a50faa67da1d0fa1c85110', NULL),
(40, 'Rubalise', '64e9546a75a53a259190a92f354f8582e82f8f28', NULL),
(41, 'pepito2', '1ac7f7dc7443effdaa74e77c41c7bb9b18d25c8b', NULL),
(42, 'pepito3', '1e71c7d59d219e8c81fe690a3bbf51ccade76cfb', NULL),
(43, 'pepito4', 'fe47b3b4975e33af785e9505fa80d1c3d8fa269f', NULL),
(44, 'pepito5', 'e58f2e2a8ab5908a4e37e296d567bd495010370b', NULL),
(45, 'pepito6', 'c4429b9aa3aed9b0adff35901bf084a6a89514c4', NULL),
(46, 'lel<h1>', 'c30304b101f6ecece3b8aa87038abcacc1da761c', NULL),
(47, '<h1 style="color:red"> OUI', '5e9e0b2f2635ccf1ec25394a5f470c3ecb26b724', NULL),
(48, '<h1 style="color:red;font-size', '95a37991d1a0a7106eefb02a7c35212093706d0f', NULL),
(49, '<h1 style="color:red;font-size', 'f9fd5b7c8a7a83ab5c2248ef8eaaa5e8ce318513', NULL),
(50, '<h1 style="color:red;font-size', 'f9fd5b7c8a7a83ab5c2248ef8eaaa5e8ce318513', NULL),
(51, 'adrien', 'a9c03061c4720e9d01ff41134ec69584cda3dbe0', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_admin`
--

CREATE TABLE IF NOT EXISTS `user_admin` (
`idAdmin` int(11) NOT NULL,
  `idUser` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user_admin`
--

INSERT INTO `user_admin` (`idAdmin`, `idUser`) VALUES
(1, 33),
(2, 35);

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
 ADD PRIMARY KEY (`idClient`), ADD KEY `idUser` (`idUser`) USING BTREE;

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
 ADD PRIMARY KEY (`idCommercant`), ADD KEY `fk_user_commercant` (`idUser`) USING BTREE;

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
 ADD PRIMARY KEY (`idUser`);

--
-- Index pour la table `user_admin`
--
ALTER TABLE `user_admin`
 ADD PRIMARY KEY (`idAdmin`), ADD KEY `idUser` (`idUser`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `caracteristiques`
--
ALTER TABLE `caracteristiques`
MODIFY `idCaracteristique` int(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
MODIFY `idCategorie` int(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
MODIFY `idClient` int(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `code_reduction`
--
ALTER TABLE `code_reduction`
MODIFY `idCodeReduction` int(8) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
MODIFY `idCommande` int(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `commercant`
--
ALTER TABLE `commercant`
MODIFY `idCommercant` int(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
MODIFY `idLigneCommande` int(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `produit_type`
--
ALTER TABLE `produit_type`
MODIFY `idProduitType` int(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT pour la table `produit_variante`
--
ALTER TABLE `produit_variante`
MODIFY `idProduitVariante` int(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
MODIFY `idUser` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT pour la table `user_admin`
--
ALTER TABLE `user_admin`
MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
