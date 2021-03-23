-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 23, 2021 at 12:18 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stofac`
--
CREATE DATABASE IF NOT EXISTS `stofac` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `stofac`;

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id_art` int(11) NOT NULL AUTO_INCREMENT,
  `code_art` varchar(20) DEFAULT NULL,
  `libcourt_art` varchar(100) NOT NULL,
  `liblong_art` text,
  `id_categorie` int(11) DEFAULT NULL,
  `id_unite_mesure` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_art`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id_art`, `code_art`, `libcourt_art`, `liblong_art`, `id_categorie`, `id_unite_mesure`) VALUES
(5, 'PI5', 'Dur Externe 1To', 'Disque Dur Externe 1To', 24, 3),
(6, 'PI6', 'Imprimante', 'Imprimante Canon à 6 Couleurs', 25, 3),
(7, 'SA7', 'Ciment Halcims', 'Sac De Ciment Halcim', 1, 15),
(9, 'KM9', 'Fil De Fer', 'Fil De Fer Pour Clôture', 1, 2),
(10, 'PI10', 'Ordinateur', 'Ordinateur De Bureau', 24, 3);

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(50) NOT NULL,
  `description_categorie` text,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `nom_categorie`, `description_categorie`) VALUES
(1, 'Matériel De Construction', ''),
(24, 'Appareil Informatique', 'materiel des bureau comme ordinateur, clé usb ...'),
(25, 'Fourniture De Bureau', 'Materièl Consomable Utilisé Des Les Bureau'),
(27, 'Matériel De Cuisine', 'Materiaux Qu''on Utilise Dans La Cuisine'),
(28, 'Vêtements', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE IF NOT EXISTS `district` (
  `id_district` int(11) NOT NULL AUTO_INCREMENT,
  `nom_district` varchar(70) NOT NULL,
  `id_region` int(11) NOT NULL,
  PRIMARY KEY (`id_district`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id_district`, `nom_district`, `id_region`) VALUES
(2, 'Mananara', 1),
(3, 'Maroantsetra', 1),
(5, 'Brickaville', 2),
(6, 'Mahanoro', 2),
(7, 'Ambatondrazaka', 6),
(8, 'Marolambo', 2),
(10, 'Antalaha', 1),
(12, 'Sambava', 8),
(13, 'Vohemara', 8),
(14, 'Andapa', 8),
(15, 'Toamasina', 2),
(16, 'Nosy Be', 7),
(17, 'Vatomandry', 2);

-- --------------------------------------------------------

--
-- Table structure for table `entrepot`
--

CREATE TABLE IF NOT EXISTS `entrepot` (
  `id_entrepot` int(11) NOT NULL AUTO_INCREMENT,
  `nom_entrepot` varchar(70) NOT NULL,
  `adresse_1` varchar(100) NOT NULL,
  `adresse_2` varchar(100) DEFAULT NULL,
  `id_mail1` int(11) DEFAULT NULL,
  `id_mail2` int(11) DEFAULT NULL,
  `id_telephone` int(11) DEFAULT NULL,
  `id_district` int(11) NOT NULL,
  PRIMARY KEY (`id_entrepot`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `entrepot`
--

INSERT INTO `entrepot` (`id_entrepot`, `nom_entrepot`, `adresse_1`, `adresse_2`, `id_mail1`, `id_mail2`, `id_telephone`, `id_district`) VALUES
(0, 'Depôt Vatomandry', 'Depôt Analakininina', 'Canadà', 7, NULL, 12, 17),
(1, 'Entrepôt Central Toamasina', 'Lot 271 Depôt Analankininina', '', 1, NULL, 7, 15),
(2, 'Entrepôt Mangarivotra Toamasina', 'Lot 207 ple 23/53 Mangarivotra sud', NULL, 2, NULL, 8, 15),
(4, 'Entrepot - Antanambao', 'Lot T3 122 Tanambao', '', 5, 6, 11, 3),
(6, 'Entrepot Vatomandry', 'Lot V508', '', 9, NULL, 16, 8),
(7, 'Entrepôt Goulamo', 'Lot 206 Andraokaraoka', '', 13, NULL, 28, 3),
(8, 'Entrepot Chinois', 'Lot Canton', '', 14, NULL, 29, 16),
(9, 'Entrepot Tamatave', 'Ambalamanasy', '', 15, NULL, 30, 15),
(10, 'Entrepot Tanà', 'Behoririka', '', 16, 17, 31, 2),
(11, 'Entrepôt Papango Be', 'Papango Be', 'Mananara Centre', 18, NULL, 32, 2),
(12, 'Eeieiieieieieieie', 'Lot Eieijijee', '', 19, NULL, 33, 2),
(13, 'Rrrrrrrrrrrrrrrrrrr', 'Rrrrrrrrrrrrrrrrrrrrrrrrr', '', 20, NULL, 34, 3),
(14, 'Bbbbbbbbbbbb', 'Bbbbbbbbbbbbbbbb', '', 21, NULL, 35, 2),
(15, 'Entrepot Ambanivolo', 'Lot Sandrakatsy', '', 22, NULL, 36, 2),
(16, 'Vvvvvv', 'Zzzzzzzzzz', '', 23, NULL, 37, 3),
(17, 'Gggggggggghhhhhhhhhhhttttt', 'Ggggggggggggggggg', '', 25, NULL, 38, 3),
(18, 'Xxxxxxxxxxxxxx', 'Xxxxxxxxxxx', '', 27, NULL, 39, 2);

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE IF NOT EXISTS `mail` (
  `id_mail` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_mail` varchar(100) NOT NULL,
  `type_mail` varchar(50) NOT NULL DEFAULT 'Professionnel',
  PRIMARY KEY (`id_mail`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `mail`
--

INSERT INTO `mail` (`id_mail`, `libelle_mail`, `type_mail`) VALUES
(1, 'entrepotcentral@gmail.com', 'Professionnel'),
(2, 'entrepotmangarivotra501@gmail.com', 'Professionnel'),
(3, 'alexdjeditho@gmail.com', 'Professionnel'),
(4, 'alexdjeditho@yahoo.fr', 'Professionnel'),
(5, 'mamaisoa@gmail.com', 'Professionnel'),
(6, 'mauricerandr@gmail.com', 'Professionnel'),
(7, 'jhoanita@gmail.com', 'Professionnel'),
(8, 'testentrepot@yahoo.fr', 'Professionnel'),
(9, 'vatomandry@yahoo.fr', 'Professionnel'),
(10, 'ererererere@gmail.com', 'Professionnel'),
(11, 'rrrrrrrrrr@gmail.com', 'Professionnel'),
(12, 'editho.alex@gmail.com', 'Professionnel'),
(13, 'goulamo@gmail.com', 'Professionnel'),
(14, 'chine@gmail.com', 'Professionnel'),
(15, 'tamataveent@gmail.com', 'Professionnel'),
(16, 'tananarive@gmail.com', 'Professionnel'),
(17, 'antananarivo@gmail.com', 'Professionnel'),
(18, 'mananara@gmail.com', 'Professionnel'),
(19, 'eieieeieieiei@gmail.com', 'Professionnel'),
(20, 'rrrrrrrrrrrrrrrrrrrrrr@gmail.com', 'Professionnel'),
(21, 'bbbbbbbbbbbbbb@gmail.com', 'Professionnel'),
(22, 'ambanivolo@gmail.com', 'Professionnel'),
(23, 'vvvvvvv@gmail.com', 'Professionnel'),
(24, 'gggggggggg@gmail.com', 'Professionnel'),
(25, 'gggggggggghhhhhhtttttt@gmail.com', 'Professionnel'),
(26, 'mamaisoa@gmail.com', 'Professionnel'),
(27, 'xxxxxxxxxxxxxxxzzzzzzzzzzzzzzzzzzz@gmail.com', 'Professionnel'),
(28, 'xxxxxxxxxxxxxxxzzzzzzzzzzzzzzzzzzz@gmail.com', 'Professionnel');

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE IF NOT EXISTS `province` (
  `id_province` int(11) NOT NULL AUTO_INCREMENT,
  `nom_province` varchar(75) NOT NULL,
  `id_pays` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_province`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`id_province`, `nom_province`, `id_pays`) VALUES
(1, 'Toamasina', NULL),
(3, 'Tuléar', NULL),
(4, 'Fianarantsoa', NULL),
(5, 'Mahajanga', NULL),
(6, 'Lyon', NULL),
(7, 'Marseil', 0),
(9, 'Virginie', 0),
(11, 'Portland', 0),
(12, 'Washington', 0),
(13, 'Nord Este', 0),
(14, 'Nord Este', 0),
(15, 'Fianarantsoa', 0),
(16, 'Antananarivo', 0),
(17, 'Antsiranana', 0),
(18, 'Gouadeloupe', 0),
(19, 'île Martinique', 0);

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `id_region` int(11) NOT NULL AUTO_INCREMENT,
  `nom_region` varchar(70) NOT NULL,
  `id_province` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_region`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id_region`, `nom_region`, `id_province`) VALUES
(1, 'Analanjirofo', 1),
(2, 'Atsinanana', 1),
(6, 'Alaotra-Mangoro', 1),
(7, 'Boeny', 5),
(8, 'SAVA', 17);

-- --------------------------------------------------------

--
-- Table structure for table `telephone`
--

CREATE TABLE IF NOT EXISTS `telephone` (
  `id_telephone` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_telephone` varchar(30) NOT NULL,
  `type_telephone` varchar(50) NOT NULL DEFAULT 'Professionnel',
  PRIMARY KEY (`id_telephone`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `telephone`
--

INSERT INTO `telephone` (`id_telephone`, `libelle_telephone`, `type_telephone`) VALUES
(7, '032533454546', 'Professionnel'),
(8, '0325334549897', 'Professionnel'),
(9, '0325334549898', 'Professionnel'),
(10, '113', 'Professionnel'),
(11, '0327956578', 'Professionnel'),
(12, '501', 'Professionnel'),
(13, '0322414246', 'Professionnel'),
(14, '234566', 'Professionnel'),
(15, '43434545', 'Professionnel'),
(16, '98648894', 'Professionnel'),
(17, 'ererererere', 'Professionnel'),
(18, 'rerererere', 'Professionnel'),
(19, 'rtrtrtrtrtrt', 'Professionnel'),
(20, 'vbvbvbvb', 'Professionnel'),
(21, 'fgfgfg', 'Professionnel'),
(22, 'jjkjkjkjk', 'Professionnel'),
(23, 'erererer', 'Professionnel'),
(24, 'nbnbnbnb', 'Professionnel'),
(25, 'ererererer', 'Professionnel'),
(26, 'rrrrrrrrrrrrr', 'Professionnel'),
(27, 'rtrtrtrtrt', 'Professionnel'),
(28, '4567', 'Professionnel'),
(29, '987666', 'Professionnel'),
(30, '098877', 'Professionnel'),
(31, '101223', 'Professionnel'),
(32, '51111', 'Professionnel'),
(33, '65654433212', 'Professionnel'),
(34, '989877', 'Professionnel'),
(35, 'bbbbbbbbbbbbb', 'Professionnel'),
(36, '00000000', 'Professionnel'),
(37, 'vvvvvvvv', 'Professionnel'),
(38, 'gggggggggggg', 'Professionnel'),
(39, 'xxxxxxxxxxxxxxxxxxx', 'Professionnel');

-- --------------------------------------------------------

--
-- Table structure for table `unite_mesure`
--

CREATE TABLE IF NOT EXISTS `unite_mesure` (
  `id_unite_mesure` int(11) NOT NULL AUTO_INCREMENT,
  `nom_unite_mesure` varchar(11) NOT NULL,
  `description_unite_mesure` text NOT NULL,
  PRIMARY KEY (`id_unite_mesure`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `unite_mesure`
--

INSERT INTO `unite_mesure` (`id_unite_mesure`, `nom_unite_mesure`, `description_unite_mesure`) VALUES
(1, 'm', 'métre'),
(2, 'Km', 'kilo-métre'),
(3, 'Piece', 'Piece'),
(6, 'Kp', 'Kapoaka'),
(15, 'Sac', 'Sac'),
(16, 'Celsus', 'Celsus'),
(17, 'Mm', 'Millimétre');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(50) NOT NULL,
  `mdp_utilisateur` text NOT NULL,
  `photo_utilisateur` int(11) DEFAULT NULL,
  `grade` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom_utilisateur`, `mdp_utilisateur`, `photo_utilisateur`, `grade`) VALUES
(1, 'editho alex', '4fcf6025879c6435bd859e66c2e05b7f8c69f401e5b8ec6f00a98eb7c30cb989ed4cefa0703945cbcbb2358325d9c181090c385b1843ddd2800d9cf4888ae173MKvh2sytTn2ZmzVdVZdBfbSO3isUTxqd2LOvb6IwQCY=', NULL, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
