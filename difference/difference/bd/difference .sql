-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 06, 2024 at 01:06 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `difference`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignation`
--

DROP TABLE IF EXISTS `assignation`;
CREATE TABLE IF NOT EXISTS `assignation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `matricule` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `heure` time(6) NOT NULL,
  `classe` varchar(200) NOT NULL,
  `enseignant` varchar(200) NOT NULL,
  `materiel` varchar(200) NOT NULL,
  `quantite` int NOT NULL,
  `etat_sorti` varchar(200) NOT NULL,
  `responsable` varchar(200) NOT NULL,
  `statut` varchar(200) NOT NULL,
  `etat_retour` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `assignation`
--

INSERT INTO `assignation` (`id`, `matricule`, `date`, `heure`, `classe`, `enseignant`, `materiel`, `quantite`, `etat_sorti`, `responsable`, `statut`, `etat_retour`) VALUES
(1, '', '2024-04-06', '02:25:00.000000', '0', 'steve', 'ardoise', 12, 'peut abimé', 'wesline', '0', 'en_prêt'),
(2, '', '2024-04-06', '03:16:00.000000', '0', 'steve', 'ardoise', 11, 'peut abimé', 'wesline', '0', 'en_prêt'),
(3, '2024-04-06', '0000-00-00', '00:00:12.000000', 'prepa1', 'paul', '0', 12, 'abimé', '0', 'remis', 'en_prêt');

-- --------------------------------------------------------

--
-- Table structure for table `categorie_materiel`
--

DROP TABLE IF EXISTS `categorie_materiel`;
CREATE TABLE IF NOT EXISTS `categorie_materiel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Nom_Categorie` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `categorie_materiel`
--

INSERT INTO `categorie_materiel` (`id`, `Nom_Categorie`) VALUES
(1, 'tableau'),
(2, 'sable'),
(4, 'poule');

-- --------------------------------------------------------

--
-- Table structure for table `classe`
--

DROP TABLE IF EXISTS `classe`;
CREATE TABLE IF NOT EXISTS `classe` (
  `ID_Classe` int NOT NULL,
  `Nom_Classe` varchar(10) NOT NULL,
  `Enseignant_Responsable` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_Classe`),
  KEY `Enseignant_Responsable` (`Enseignant_Responsable`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `enseignant`
--

DROP TABLE IF EXISTS `enseignant`;
CREATE TABLE IF NOT EXISTS `enseignant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `matieres_Enseignees` varchar(255) NOT NULL,
  `classes_Assignees` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `enseignant`
--

INSERT INTO `enseignant` (`id`, `nom`, `email`, `telephone`, `matieres_Enseignees`, `classes_Assignees`) VALUES
(2, 'paul', 'paul@gfamil.com', '658987854', '', 'cm1');

-- --------------------------------------------------------

--
-- Table structure for table `materiel_didactique`
--

DROP TABLE IF EXISTS `materiel_didactique`;
CREATE TABLE IF NOT EXISTS `materiel_didactique` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Nom_Materiel` varchar(255) NOT NULL,
  `Description` text,
  `Quantite_Disponible` int DEFAULT NULL,
  `Statut` varchar(20) DEFAULT NULL,
  `Emplacement` varchar(50) DEFAULT NULL,
  `ID_Categorie` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `materiel_didactique`
--

INSERT INTO `materiel_didactique` (`id`, `Nom_Materiel`, `Description`, `Quantite_Disponible`, `Statut`, `Emplacement`, `ID_Categorie`) VALUES
(1, 'fdfdf', 'dfdfdf', 12, 'fdfdf', 'dfdf', ''),
(2, '', 'dfd', 0, '', '', '0'),
(3, '', 'sdsds', 0, '', '', '0'),
(6, 'hibou', 'noir', 4, 'en_réparation', 'paul legoiun', '0'),
(7, 'fgf', 'fgfg', 3, 'disponible', 'fgfg', '0'),
(8, 'dfdf', 'fdfd', 3, 'en_prêt', 'dfdfdf', '0'),
(9, 'dfdfgfgfg', 'fdfdf', 6, 'en_prêt', 'dghghgh', '0'),
(10, 'ffdf', 'dfdf', 2, 'disponible', 'dfdf', '0'),
(11, 'aga', 'a', 4, 'en_prêt', 'bambou', '0'),
(12, 'bava', 'dfd', 12, 'en_réparation', 'dfdf', '0'),
(13, 'ajaj', 'sdsd', 45, 'en_prêt', 'poum', '0'),
(14, 'vbvb', 'vbv', 1, 'disponible', 'hghgh', '0'),
(15, 'vuiuiu', 'vbv', 1, 'en_prêt', 'hghgh', '0'),
(16, 'gart', 'ere', 5, 'en_prêt', '4hgh', '0'),
(17, 'popo', 'ghg', 5, 'en_prêt', 'ghg', '0'),
(18, 'ttyu', '545', 7, 'disponible', 'dfdf', '0');

-- --------------------------------------------------------

--
-- Table structure for table `responsable`
--

DROP TABLE IF EXISTS `responsable`;
CREATE TABLE IF NOT EXISTS `responsable` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `responsable`
--

INSERT INTO `responsable` (`id`, `nom`, `email`, `telephone`, `password`) VALUES
(3, 'gabug', 'bahu@gamil.com', '54566214', 'jhjhj'),
(5, 'baba', 'baba@gmail.com', '698785545', 'jin'),
(9, 'wesline', 'wesline@gmail.com', '658877445', '123');

-- --------------------------------------------------------

--
-- Table structure for table `retour`
--

DROP TABLE IF EXISTS `retour`;
CREATE TABLE IF NOT EXISTS `retour` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `materiel` varchar(20) NOT NULL,
  `quantite` int NOT NULL,
  `enseignant` varchar(20) NOT NULL,
  `etat` varchar(20) NOT NULL,
  `commentaire` text NOT NULL,
  `responsable` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `retour`
--

INSERT INTO `retour` (`id`, `date`, `materiel`, `quantite`, `enseignant`, `etat`, `commentaire`, `responsable`) VALUES
(1, '2024-04-06', '', 12, 'steve', 'peut abimé', '0', 'disponible');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
