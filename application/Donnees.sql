-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 18 nov. 2018 à 15:48
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

--
-- Déchargement des données de la table `commercant`
--

INSERT INTO `commercant` (`idCommercant`, `nomCommercant`, `prenomCommercant`, `dateNaissanceCommercant`, `telCommercant`, `mailCommercant`) VALUES
(1, 'Dupont', 'Paul', '2018-11-08', '000000000', 'dupont.paul@mail.fr');

--
-- Déchargement des données de la table `commerce`
--

INSERT INTO `commerce` (`siretCommerce`, `nomCommerce`, `mailCommerce`, `telCommerce`, `numAdresseComerce`, `rueCommerce`, `codePostalCommerce`, `villeCommerce`, `complementAdresseCommerce`, `tempsReservationProduitsCommerce`, `produitsLivrablesCommerce`, `idCommercant`) VALUES
(12, 'Le Pont de Dupont', 'gnagna@mail.fr', '0654545454', 12, 'Le pont du pont', 34000, 'Montpellier', '', '23:00:00', 0, 1);

--
-- Déchargement des données de la table `produit_type`
--

INSERT INTO `produit_type` (`idProduitType`, `nomProduitType`, `decriptionProduitType`, `prixProduitType`, `seuilStockProduitType`, `idCategorie`, `siretCommerce`) VALUES
(1, 'T-Shirt Coton', 'T-shirt en coton de fabrication française', 15, 0, NULL, 12),
(2, 'Pull-Over', 'C\'EST UN PULL WOW !', 35, 0, NULL, 12);

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`idUser`, `loginUser`, `passUser`, `idCommercant`) VALUES
(30, 'test', '7005263cedaa4ca4f7992922ee787ffa8c0d03ed', NULL),
(31, 'Dorian', 'b8bb1edd55b61a1ee0c3d8635b99aef41702ea80', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
