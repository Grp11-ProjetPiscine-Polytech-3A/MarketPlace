-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  lun. 07 jan. 2019 à 19:26
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `marketplace`
--

-- --------------------------------------------------------

--
-- Structure de la table `caracteristiques`
--

CREATE TABLE `caracteristiques` (
  `idCaracteristique` int(8) UNSIGNED NOT NULL,
  `nomCaracteristique` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `caracteristiques`
--

INSERT INTO `caracteristiques` (`idCaracteristique`, `nomCaracteristique`) VALUES
(1, 'Capacité'),
(2, 'Taille'),
(3, 'Couleur');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `idCategorie` int(8) UNSIGNED NOT NULL,
  `descriptionCategorie` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `descriptionCategorie`) VALUES
(1, 'textile'),
(2, 'High-Tech'),
(3, 'Jardin'),
(4, 'Alimentaire'),
(5, 'Jouets'),
(6, 'Joaillerie'),
(7, 'Bagagerie');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `idClient` int(8) UNSIGNED NOT NULL,
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
  `idUser` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`idClient`, `nomClient`, `prenomClient`, `dateNaissanceClient`, `telClient`, `mailClient`, `numAdresseClient`, `rueClient`, `codePostalClient`, `villeClient`, `complementAdresseCommerce`, `pointsFidelitesClient`, `idUser`) VALUES
(1, 'Paté', 'Jean', '1965-11-08', '0555869586', 'adressedejeanpate@mail.fr', 4, 'Rue des Rues', 99999, 'UCity', '', 0, 33),
(4, 'Poulain', 'Arthur', '2018-11-14', '0665987545', 'lemaildearthur@mail.fr', 6, 'Rue de Arthur', 19000, 'Tulle', '', 0, NULL),
(5, 'SAIMOND', 'Etienne', '1996-12-16', '0760644462', 'etienne.saimond@etu.umontpellier.fr', 120, 'Avenue du professeur Emile Jeanbrau', 34090, 'Montpellier', '', 9999, 35),
(18, 'ANDREU', 'Paola', '1997-04-29', '0956434567', 'paola.andreu@etu.umontpellier.fr', 20, 'rue des lavandes', 34570, 'Montarnaud', '', 9, 63),
(19, 'combes', 'marie', '1993-09-10', '0456765432', 'marie@gmail.com', 2, 'rue des olives', 34560, 'Montbazin', '', 16, 64),
(20, 'jean', 'jules', '2001-03-14', '0987656789', 'jules@gmail.com', 98, 'avenue charles flahaut', 34530, 'juvignac', '', 2, 65),
(21, 'dupont', 'olivia', '1998-12-12', '0654456787', 'dupont@gmail.com', 34, 'rue des oranges', 34200, 'st georges d\'orques', '', 4, 66),
(22, 'dubary', 'jean-pierre', '1978-06-06', '0654345754', 'dubary@gmail.com', 3, 'rue des lavandins', 34700, 'gignac', '', 3, 67),
(23, 'dusfour', 'julie', '1995-10-10', '0632456753', 'julie@gmail.com', 1, 'avenue des ours blancs', 34600, 'Vailhauques', 'chemin bleu', 10, 68),
(24, 'durand', 'kevin', '1990-01-01', '0754323456', 'keke@gmail.com', 11, 'chemin des bleuets', 34570, 'saint paul et valmalle', '', 7, 69),
(25, 'tuche', 'pierre', '1966-10-01', '0467545667', 'tuche@gmail.com', 345, 'avenue des moulins', 34000, 'Montpellier', '', 70, 70),
(26, 'debrume', 'paul', '1999-09-09', '0676543456', 'paul@gmail.com', 3, 'avenue de Montmorency', 34070, 'Montpellier', '', 36, 71),
(27, 'morel', 'jacques', '1945-11-12', '0654567876', 'morel@gmail.com', 9, 'rue du thym', 34410, 'sauvian', '', 54, 72),
(28, 'dujardin', 'francois', '1976-03-19', '0654456238', 'dujardin@gmail.com', 8, 'avenue maréchal ferrand', 34410, 'Serignan', '', 15, 73),
(29, 'botineli', 'safia', '1992-06-06', '0467854334', 'safia@gmail.com', 78, 'rue des églises', 34070, 'Montpellier', '', 9, 74),
(30, '', '', '0000-00-00', '', '', 0, '', 0, '', '', 0, 75),
(31, '', '', '0000-00-00', '', '', 0, '', 0, '', '', 0, 76);

-- --------------------------------------------------------

--
-- Structure de la table `client_commande_effectuer`
--

CREATE TABLE `client_commande_effectuer` (
  `idCommande` int(8) UNSIGNED NOT NULL,
  `idClient` int(8) UNSIGNED NOT NULL,
  `nombrePointsUtilisés` int(8) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client_commande_effectuer`
--

INSERT INTO `client_commande_effectuer` (`idCommande`, `idClient`, `nombrePointsUtilisés`) VALUES
(12, 5, 0),
(13, 18, 0),
(14, 18, 0),
(15, 31, 0),
(16, 31, 0),
(17, 25, 0),
(18, 29, 0),
(19, 22, 0),
(20, 19, 0),
(21, 26, 0),
(22, 26, 0),
(23, 19, 0),
(24, 24, 0);

-- --------------------------------------------------------

--
-- Structure de la table `client_donner_avis`
--

CREATE TABLE `client_donner_avis` (
  `idClient` int(8) UNSIGNED NOT NULL,
  `idProduitVariante` int(8) UNSIGNED NOT NULL,
  `commentaire` text NOT NULL,
  `note` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client_donner_avis`
--

INSERT INTO `client_donner_avis` (`idClient`, `idProduitVariante`, `commentaire`, `note`) VALUES
(18, 36, 'ils tiennent bien chaud \r\nla laine est de bonne qualité', 3),
(18, 61, 'Ce pull est bien taillé \r\nle tissu gratte un peu ... dommage', 3),
(19, 39, 'elles sont délicieuses et pas trop sèches !! \r\n', 3),
(19, 49, 'les touches se sont détachées au bout de 6 mois ... mais le prix reste abordable', 2),
(19, 62, 'Le cuir est magnifique ! la qualité est dingue  ', 5),
(22, 43, 'le manche s\'est cassé dès la deuxième utilisation ', 1),
(22, 46, 'Bonne qualité, les embouts s\'adaptent à tout type de dimensions\r\n', 4),
(22, 47, 'super taille haie ! le rapport qualité - prix est très bien ', 5),
(24, 48, 'pioche de qualité, pas trop lourde, bonne prise en main ', 3),
(24, 57, 'la chaine est trop belle !! j\'ai pu écrire mon nom sur la plaque', 4),
(26, 32, 'Ce bonnet est très doux !!', 5),
(26, 38, 'Ces truffes sont délicieuses ! Je les recommande :)', 4),
(26, 45, 'brouette très pratique et légère \r\npetit bémol sur les points de rouille ...', 3);

-- --------------------------------------------------------

--
-- Structure de la table `code_reduction`
--

CREATE TABLE `code_reduction` (
  `idCodeReduction` int(8) UNSIGNED NOT NULL,
  `dateDebutCodeReduction` date NOT NULL,
  `dateFinCodeReduction` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `code_reduction_ligne_commande_appliquer`
--

CREATE TABLE `code_reduction_ligne_commande_appliquer` (
  `idCodeReduction` int(8) UNSIGNED NOT NULL,
  `idLigneCommande` int(8) UNSIGNED NOT NULL,
  `reductionEffective` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `code_reduction_produit_variante_concerner`
--

CREATE TABLE `code_reduction_produit_variante_concerner` (
  `idCodeReduction` int(8) UNSIGNED NOT NULL,
  `idProduitVariante` int(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `idCommande` int(8) UNSIGNED NOT NULL,
  `dateCommande` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`idCommande`, `dateCommande`) VALUES
(12, '2019-01-03'),
(13, '2019-01-06'),
(14, '2019-01-07'),
(15, '2019-01-07'),
(16, '2019-01-07'),
(17, '2019-01-07'),
(18, '2019-01-07'),
(19, '2019-01-07'),
(20, '2019-01-07'),
(21, '2019-01-07'),
(22, '2019-01-07'),
(23, '2019-01-07'),
(24, '2019-01-07');

-- --------------------------------------------------------

--
-- Structure de la table `commercant`
--

CREATE TABLE `commercant` (
  `idCommercant` int(8) UNSIGNED NOT NULL,
  `nomCommercant` varchar(64) NOT NULL,
  `prenomCommercant` varchar(64) NOT NULL,
  `dateNaissanceCommercant` date NOT NULL,
  `telCommercant` varchar(10) NOT NULL,
  `idUser` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commercant`
--

INSERT INTO `commercant` (`idCommercant`, `nomCommercant`, `prenomCommercant`, `dateNaissanceCommercant`, `telCommercant`, `idUser`) VALUES
(2, 'Dédé', 'Dupont', '2018-11-08', '000000000', 35),
(3, 'Saimond', 'Etienne', '1996-12-16', '0666666666', 35),
(4, 'Laurancy', 'Dorian', '2018-03-18', '000000000', 33),
(5, 'ANDREU', 'Paola', '1997-04-29', '0654453432', 63),
(6, 'jean', 'jules', '2001-03-14', '0987656789', 65),
(7, 'dujardin', 'francois', '1976-03-19', '0654456238', 73),
(8, 'morel', 'jacques', '1945-11-12', '0654567876', 72),
(9, 'dupont', 'olivia', '1998-12-12', '0654456787', 66),
(10, 'dusfour', 'julie', '1995-10-10', '0632456753', 68),
(11, 'nomCommercant', 'prenomCommercant', '1999-10-10', '0123456789', 75);

-- --------------------------------------------------------

--
-- Structure de la table `commercant_commerce_gerer`
--

CREATE TABLE `commercant_commerce_gerer` (
  `idCommercant` int(8) UNSIGNED NOT NULL,
  `siretCommerce` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commercant_commerce_gerer`
--

INSERT INTO `commercant_commerce_gerer` (`idCommercant`, `siretCommerce`) VALUES
(4, '12345678912345');

-- --------------------------------------------------------

--
-- Structure de la table `commerce`
--

CREATE TABLE `commerce` (
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
  `descriptionCommerce` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commerce`
--

INSERT INTO `commerce` (`siretCommerce`, `nomCommerce`, `mailCommerce`, `telCommerce`, `numAdresseCommerce`, `rueCommerce`, `codePostalCommerce`, `villeCommerce`, `complementAdresseCommerce`, `tempsReservationProduitsCommerce`, `produitsLivrablesCommerce`, `idCommercant`, `descriptionCommerce`) VALUES
('0123456', 'MonCommerce', 'moncommerce@gmail.com', '0123456789', 1, 'rue du commerce', 34000, 'ma ville', 'etage du commerce', '00:00:00', 1, 11, 'La description de mon beau commerce'),
('12345678912345', 'Le commerce de Dédé', 'comdedede@mail.com', '0612345678', 12, 'Rue du pont', 34000, 'Montpellier', '', '800:00:00', 0, 2, 'Un petit commerce sympatique'),
('3456543', 'jules n co', 'julesnco@gmail.com', '0467543456', 4, 'rue des gourmets', 34000, 'Montpellier', 'boite 45', '838:59:59', 0, 6, 'mode homme'),
('34567654', 'La cabane magique', 'lacabanemagique@gmail.com', '0654234567', 3, 'rue des lilas', 34000, 'Montpellier', 'boite 45', '838:59:59', 1, 5, 'magasin de jouets enfant'),
('3566435', 'Julietta', 'julietta@gmail.com', '0467565432', 380, 'avenue des pouses', 34080, 'Montpellier', 'Boite 6', '838:59:59', 0, 6, 'magasin de mode femme'),
('544567543', 'oli\'tech', 'olitech@gmail.com', '0654345896', 40, 'boulevard des arts', 34010, 'Montpellier', 'Boite 32', '838:59:59', 0, 9, 'Magnifique magasin situé dans l\'écusson \r\nVente de matériel informatique'),
('765675490', 'la chocolaterie', 'lachocolaterie@gmail.com', '0467898765', 5, 'rue de la république', 34000, 'Montpellier', 'bat 11', '00:00:00', 1, 7, 'chocolaterie plein centre de Montpellier \r\nfabrication maison'),
('9865345673', 'les jardins de jacques', 'lesjardinsdejacques@gmail.com', '0654567898', 6, 'avenue des toupets', 34070, 'Montpellier', 'Boite 45', '838:59:59', 0, 8, 'tout pour le jardinage'),
('998574983', 'Les bijoux de julie', 'lesbijouxdejulie@gmail.com', '0467545678', 30, 'avenue du pere soulas', 34000, 'Montpellier', 'res 45', '00:00:00', 1, 10, 'bijouterie fait main');

-- --------------------------------------------------------

--
-- Structure de la table `ligne_commande`
--

CREATE TABLE `ligne_commande` (
  `idLigneCommande` int(8) UNSIGNED NOT NULL,
  `etatReservationLigneCommande` varchar(64) NOT NULL,
  `quantité` int(8) NOT NULL,
  `prixAchatProduit` float(16) NOT NULL,
  `idProduitVariante` int(8) UNSIGNED NOT NULL,
  `idCommande` int(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ligne_commande`
--

INSERT INTO `ligne_commande` (`idLigneCommande`, `etatReservationLigneCommande`, `quantité`, `prixAchatProduit`, `idProduitVariante`, `idCommande`) VALUES
(5, 'Commande passée non validée', 1, 40, 61, 13),
(6, 'Commande passée non validée', 1, 7, 36, 14),
(7, 'Commande passée non validée', 1, 10, 37, 15),
(8, 'Commande passée non validée', 1, 30, 45, 15),
(9, 'Commande passée non validée', 1, 20, 51, 15),
(10, 'Commande passée non validée', 1, 10, 58, 15),
(11, 'Commande passée non validée', 1, 10, 40, 16),
(12, 'Commande passée non validée', 1, 10, 40, 17),
(13, 'Commande passée non validée', 1, 12, 32, 17),
(14, 'Commande passée non validée', 3, 300, 54, 18),
(15, 'Commande passée non validée', 1, 30, 57, 18),
(16, 'Commande passée non validée', 2, 30, 46, 19),
(17, 'Commande passée non validée', 1, 40, 43, 19),
(18, 'Commande passée non validée', 1, 100, 47, 19),
(19, 'Commande passée non validée', 1, 10, 49, 20),
(20, 'Commande passée non validée', 1, 12, 32, 21),
(21, 'Commande passée non validée', 1, 15, 38, 21),
(22, 'Commande passée non validée', 1, 30, 45, 22),
(23, 'Commande passée non validée', 1, 20, 39, 23),
(24, 'Commande passée non validée', 1, 300, 62, 23),
(25, 'Commande passée non validée', 1, 30, 57, 24),
(26, 'Commande passée non validée', 1, 10, 48, 24);

-- --------------------------------------------------------

--
-- Structure de la table `produit_type`
--

CREATE TABLE `produit_type` (
  `idProduitType` int(8) UNSIGNED NOT NULL,
  `nomProduitType` varchar(128) NOT NULL,
  `descriptionProduitType` text NOT NULL,
  `prixProduitType` float NOT NULL,
  `seuilStockProduitType` int(8) NOT NULL,
  `idCategorie` int(8) UNSIGNED DEFAULT NULL,
  `siretCommerce` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit_type`
--

INSERT INTO `produit_type` (`idProduitType`, `nomProduitType`, `descriptionProduitType`, `prixProduitType`, `seuilStockProduitType`, `idCategorie`, `siretCommerce`) VALUES
(40, 'bonnet', 'bonnet homme dernière nouveauté', 0, 10, 1, '3456543'),
(41, 'echarpe', 'echarpe douce homme', 0, 5, 1, '3456543'),
(42, 'manteau', 'manteau homme', 0, 4, 1, '3456543'),
(43, 'gants', 'gants homme laine', 0, 3, 1, '3456543'),
(44, 'tablette', 'tablette chocolat noir', 0, 5, 4, '765675490'),
(45, 'truffe', 'truffes chocolat noir', 0, 10, 4, '765675490'),
(46, 'orangettes', 'orangettes chocolat noir et orange de corse', 0, 2, 4, '765675490'),
(47, 'bonbons', 'bonbons chocolat', 0, 5, 4, '765675490'),
(48, 'bêche', 'bêche avec manche en bois', 0, 4, 3, '9865345673'),
(49, 'pelle', 'pelle avec manche en bois', 0, 10, 3, '9865345673'),
(50, 'brouette', 'brouette en fer \r\ndiametre roue : 50 cm', 0, 2, 3, '9865345673'),
(51, 'tuyau arrosage', 'tuyau arrosage vert embout en laiton', 0, 6, 3, '9865345673'),
(52, 'taille haie', 'taille haie à essence', 0, 5, 3, '9865345673'),
(53, 'pioche', 'pioche avec manche en bois', 0, 4, 3, '9865345673'),
(54, 'clavier', 'clavier\r\nport usb', 0, 5, 2, '544567543'),
(55, 'ordinateur', 'ordinateur portable\r\nvendu avec chargeur', 0, 3, 2, '544567543'),
(56, 'souris', 'souris d\'ordinateur', 0, 3, 2, '544567543'),
(57, 'bague', 'bague en argent\r\n\r\nplaqué or blanc', 0, 4, 6, '998574983'),
(58, 'collier', 'collier en or diamant brut', 0, 2, 6, '998574983'),
(59, 'boucles oreilles', 'boucles d\'oreille en argent massif \r\ncréateur parisien', 0, 3, 6, '998574983'),
(60, 'bracelet', 'bracelet chaine prénom sur commande\r\nargent massif', 0, 40, 6, '998574983'),
(61, 'chaussettes', 'chaussettes femme dessin rose', 0, 3, 1, '3566435'),
(62, 'manteau', 'manteau femme laine', 0, 2, 1, '3566435'),
(63, 'débardeur', 'débardeur femme synthétique', 0, 10, 1, '3566435'),
(64, 'pull', 'pull femme', 0, 10, 1, '3566435'),
(65, 'sac', 'sac à main femme cuir', 0, 4, 7, '3566435');

-- --------------------------------------------------------

--
-- Structure de la table `produit_type_caracteristique`
--

CREATE TABLE `produit_type_caracteristique` (
  `idProduitType` int(8) UNSIGNED NOT NULL,
  `idCaracteristique` int(8) UNSIGNED NOT NULL,
  `contenuCaracteristique` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit_type_caracteristique`
--

INSERT INTO `produit_type_caracteristique` (`idProduitType`, `idCaracteristique`, `contenuCaracteristique`) VALUES
(40, 2, 'unique'),
(40, 3, 'bleu'),
(41, 3, 'kaki'),
(42, 3, 'camel'),
(43, 2, 'unique'),
(43, 3, 'gris'),
(44, 1, '100 gr'),
(45, 1, '200 gr'),
(46, 1, '50 gr'),
(48, 2, '1 m'),
(49, 2, '1,15 m'),
(51, 2, '5 m'),
(53, 2, '1 m'),
(54, 2, '30 cm'),
(54, 3, 'noir'),
(55, 3, 'noir'),
(56, 3, 'bleu'),
(57, 2, '60'),
(58, 2, '30 cm'),
(60, 2, '18 cm'),
(61, 2, '36-38'),
(62, 2, 'M'),
(62, 3, 'gris'),
(63, 2, 'S'),
(63, 3, 'noir'),
(64, 2, 'M'),
(64, 3, 'noir'),
(65, 1, '20 L'),
(65, 3, 'marron\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `produit_variante`
--

CREATE TABLE `produit_variante` (
  `idProduitVariante` int(8) UNSIGNED NOT NULL,
  `nomProduitVariante` varchar(128) NOT NULL,
  `descriptionProduitVariante` text NOT NULL,
  `prixProduitVariante` int(8) NOT NULL,
  `stockProduitVariante` int(8) NOT NULL DEFAULT '0',
  `idProduitType` int(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit_variante`
--

INSERT INTO `produit_variante` (`idProduitVariante`, `nomProduitVariante`, `descriptionProduitVariante`, `prixProduitVariante`, `stockProduitVariante`, `idProduitType`) VALUES
(32, 'bonnet', 'bonnet homme dernière nouveauté', 12, 100, 40),
(33, 'echarpe', 'echarpe douce homme', 30, 50, 41),
(34, 'echarpe', 'echarpe douce homme', 30, 50, 41),
(35, 'manteau', 'manteau homme', 100, 76, 42),
(36, 'gants', 'gants homme laine', 7, 50, 43),
(37, 'tablette', 'tablette chocolat noir', 10, 100, 44),
(38, 'truffe', 'truffes chocolat noir', 15, 50, 45),
(39, 'orangettes', 'orangettes chocolat noir et orange de corse', 20, 30, 46),
(40, 'bonbons', 'bonbons chocolat', 10, 100, 47),
(41, 'tablette', 'tablette chocolat lait', 10, 100, 44),
(42, 'tablette', 'tablette chocolat blanc', 10, 100, 44),
(43, 'bêche', 'bêche avec manche en bois', 40, 30, 48),
(44, 'pelle', 'pelle avec manche en bois', 20, 20, 49),
(45, 'brouette', 'brouette en fer \r\ndiametre roue : 50 cm', 30, 30, 50),
(46, 'tuyau arrosage', 'tuyau arrosage vert embout en laiton', 30, 50, 51),
(47, 'taille haie', 'taille haie à essence', 100, 40, 52),
(48, 'pioche', 'pioche avec manche en bois', 10, 100, 53),
(49, 'clavier', 'clavier\r\nport usb', 10, 100, 54),
(50, 'ordinateur', 'ordinateur portable\r\nvendu avec chargeur', 400, 30, 55),
(51, 'souris', 'souris d\'ordinateur', 20, 100, 56),
(52, 'souris sans fil', 'souris d\'ordinateur sans fil', 20, 100, 56),
(53, 'souris', 'souris d\'ordinateur', 20, 300, 56),
(54, 'bague', 'bague en argent\r\n\r\nplaqué or blanc', 300, 40, 57),
(55, 'collier', 'collier en or diamant brut', 400, 20, 58),
(56, 'boucles oreilles', 'boucles d\'oreille en argent massif \r\ncréateur parisien', 250, 30, 59),
(57, 'bracelet', 'bracelet chaine prénom sur commande\r\nargent massif', 30, 200, 60),
(58, 'chaussettes', 'chaussettes femme dessin rose', 10, 100, 61),
(59, 'manteau', 'manteau femme laine', 150, 30, 62),
(60, 'débardeur', 'débardeur femme synthétique', 30, 40, 63),
(61, 'pull', 'pull femme', 40, 30, 64),
(62, 'sac', 'sac à main femme cuir', 300, 34, 65);

-- --------------------------------------------------------

--
-- Structure de la table `produit_variante_caracteristique`
--

CREATE TABLE `produit_variante_caracteristique` (
  `idProduitVariante` int(8) UNSIGNED NOT NULL,
  `idCaracteristique` int(8) UNSIGNED NOT NULL,
  `contenuCaracteristique` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit_variante_caracteristique`
--

INSERT INTO `produit_variante_caracteristique` (`idProduitVariante`, `idCaracteristique`, `contenuCaracteristique`) VALUES
(34, 3, 'beige'),
(41, 1, '100 gr'),
(42, 1, '100 gr'),
(52, 3, 'rouge'),
(53, 3, 'noir');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `idUser` int(10) UNSIGNED NOT NULL,
  `loginUser` varchar(30) COLLATE utf8_bin NOT NULL,
  `passUser` varchar(128) COLLATE utf8_bin NOT NULL,
  `mailUser` varchar(256) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`idUser`, `loginUser`, `passUser`, `mailUser`) VALUES
(33, 'Dorian', 'b8bb1edd55b61a1ee0c3d8635b99aef41702ea80', NULL),
(35, 'pepito', '3c8bd30b2580ca368fdae0b10d0c9bbcfba9918b', NULL),
(36, 'MoiMoi', '831af61650b512b4f9b0c8cdc0134680d27878b9', NULL),
(38, 'admin', '2ed665c31e8260f6f5beb39686c4bb576b3a3f20', NULL),
(40, 'Rubalise', '64e9546a75a53a259190a92f354f8582e82f8f28', NULL),
(41, 'pepito2', '1ac7f7dc7443effdaa74e77c41c7bb9b18d25c8b', NULL),
(42, 'pepito3', '1e71c7d59d219e8c81fe690a3bbf51ccade76cfb', NULL),
(43, 'pepito4', 'fe47b3b4975e33af785e9505fa80d1c3d8fa269f', NULL),
(44, 'pepito5', 'e58f2e2a8ab5908a4e37e296d567bd495010370b', NULL),
(45, 'pepito6', 'c4429b9aa3aed9b0adff35901bf084a6a89514c4', NULL),
(63, 'paola', '3a6a6fa9c95473f86c53a9215b3a324f4c1317c3', NULL),
(64, 'marie', '4134c8419d54c5e7823ade8a9478dab9b55d7e78', NULL),
(65, 'jules', '1f5f13b49ccc9028c5412077ebd7a1416cf872b1', NULL),
(66, 'olivia', 'b25faf1c4b737c685861136de680d7dc1548f2cd', NULL),
(67, 'jean-pierre', '0c94a4fe137f951c1d254c22f7ad584b54b20b4f', NULL),
(68, 'julie', '2f8ae3a6156d806a2bf565bcc402fb8284853350', NULL),
(69, 'kevin34', 'db3c9bef4cc7386cd177866b804ce1409556db1a', NULL),
(70, 'pierre', '050ebcff34ea19ef7691bbf491a4b8d4f5766e46', NULL),
(71, 'paul34', '00d3c21045085c857e17202de17b4846122f3206', NULL),
(72, 'jacques', '4091ccaccf8ebe7c43f51eb3e775d10b44886cb9', NULL),
(73, 'francois', 'c3102fd54b3087fe77918f351a77ad47fb0fa6ce', NULL),
(74, 'safia', '526995a5c981749fa8281b9755bca4489de3080c', NULL),
(75, 'Commercant', '6ff315ae60416c45d2a4c92a46dc87f61c859d3e', NULL),
(76, 'Client', '2563cadee7bb0b478318829b66e3dcbe523d6aad', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_admin`
--

CREATE TABLE `user_admin` (
  `idAdmin` int(11) NOT NULL,
  `idUser` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user_admin`
--

INSERT INTO `user_admin` (`idAdmin`, `idUser`) VALUES
(1, 33),
(2, 35);

--
-- Index pour les tables déchargées
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
  ADD PRIMARY KEY (`idClient`),
  ADD KEY `idUser` (`idUser`) USING BTREE;

--
-- Index pour la table `client_commande_effectuer`
--
ALTER TABLE `client_commande_effectuer`
  ADD PRIMARY KEY (`idCommande`,`idClient`),
  ADD KEY `idClient` (`idClient`);

--
-- Index pour la table `client_donner_avis`
--
ALTER TABLE `client_donner_avis`
  ADD PRIMARY KEY (`idClient`,`idProduitVariante`),
  ADD KEY `idProduitVariante` (`idProduitVariante`);

--
-- Index pour la table `code_reduction`
--
ALTER TABLE `code_reduction`
  ADD PRIMARY KEY (`idCodeReduction`);

--
-- Index pour la table `code_reduction_ligne_commande_appliquer`
--
ALTER TABLE `code_reduction_ligne_commande_appliquer`
  ADD PRIMARY KEY (`idCodeReduction`,`idLigneCommande`),
  ADD KEY `idLigneCommande` (`idLigneCommande`);

--
-- Index pour la table `code_reduction_produit_variante_concerner`
--
ALTER TABLE `code_reduction_produit_variante_concerner`
  ADD PRIMARY KEY (`idCodeReduction`,`idProduitVariante`),
  ADD KEY `idProduitVariante` (`idProduitVariante`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`idCommande`);

--
-- Index pour la table `commercant`
--
ALTER TABLE `commercant`
  ADD PRIMARY KEY (`idCommercant`),
  ADD KEY `fk_user_commercant` (`idUser`) USING BTREE;

--
-- Index pour la table `commercant_commerce_gerer`
--
ALTER TABLE `commercant_commerce_gerer`
  ADD PRIMARY KEY (`idCommercant`,`siretCommerce`),
  ADD KEY `fk_commerce_gerer` (`siretCommerce`),
  ADD KEY `fk_commercant_commerce_gerer` (`idCommercant`,`siretCommerce`);

--
-- Index pour la table `commerce`
--
ALTER TABLE `commerce`
  ADD PRIMARY KEY (`siretCommerce`),
  ADD KEY `index_commerce_commercant` (`idCommercant`);

--
-- Index pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
  ADD PRIMARY KEY (`idLigneCommande`),
  ADD KEY `idProduitVariante` (`idProduitVariante`,`idCommande`),
  ADD KEY `idCommande` (`idCommande`);

--
-- Index pour la table `produit_type`
--
ALTER TABLE `produit_type`
  ADD PRIMARY KEY (`idProduitType`),
  ADD KEY `idCategorie` (`idCategorie`,`siretCommerce`),
  ADD KEY `index_siretCommerce_prodType` (`siretCommerce`);

--
-- Index pour la table `produit_type_caracteristique`
--
ALTER TABLE `produit_type_caracteristique`
  ADD PRIMARY KEY (`idProduitType`,`idCaracteristique`),
  ADD KEY `produit_type_caracteristique_ibfk_1` (`idCaracteristique`);

--
-- Index pour la table `produit_variante`
--
ALTER TABLE `produit_variante`
  ADD PRIMARY KEY (`idProduitVariante`),
  ADD KEY `idProduitType` (`idProduitType`);

--
-- Index pour la table `produit_variante_caracteristique`
--
ALTER TABLE `produit_variante_caracteristique`
  ADD PRIMARY KEY (`idProduitVariante`,`idCaracteristique`),
  ADD KEY `idCaracteristique` (`idCaracteristique`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- Index pour la table `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`idAdmin`),
  ADD KEY `idUser` (`idUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `caracteristiques`
--
ALTER TABLE `caracteristiques`
  MODIFY `idCaracteristique` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idCategorie` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `idClient` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT pour la table `code_reduction`
--
ALTER TABLE `code_reduction`
  MODIFY `idCodeReduction` int(8) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `idCommande` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `commercant`
--
ALTER TABLE `commercant`
  MODIFY `idCommercant` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
  MODIFY `idLigneCommande` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT pour la table `produit_type`
--
ALTER TABLE `produit_type`
  MODIFY `idProduitType` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT pour la table `produit_variante`
--
ALTER TABLE `produit_variante`
  MODIFY `idProduitVariante` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT pour la table `user_admin`
--
ALTER TABLE `user_admin`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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

--
-- Contraintes pour la table `user_admin`
--
ALTER TABLE `user_admin`
  ADD CONSTRAINT `user_admin_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`);
