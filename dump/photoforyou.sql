-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 03 mai 2022 à 11:26
-- Version du serveur :  8.0.21
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `photoforyou`
--

DELIMITER $$
--
-- Fonctions
--
DROP FUNCTION IF EXISTS `calcul_age`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `calcul_age` (`id` INT) RETURNS INT BEGIN
DECLARE age int;
SELECT YEAR(CURRENT_DATE) - YEAR(dateNaiss) - (RIGHT(CURRENT_DATE, 5) < RIGHT(dateNaiss, 5)) INTO age FROM users WHERE idUser = id;
RETURN age;
END$$

DROP FUNCTION IF EXISTS `client_sans_credit`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `client_sans_credit` () RETURNS INT BEGIN
DECLARE sans_credit int;
SELECT DISTINCT count(*) INTO sans_credit FROM users WHERE credit = 0 AND type = 'client';
RETURN sans_credit;
END$$

DROP FUNCTION IF EXISTS `InitCap`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `InitCap` (`chaine` VARCHAR(45)) RETURNS VARCHAR(45) CHARSET utf8 BEGIN
declare machaine varchar(45);
set machaine=concat( upper(substring(chaine,1,1)),lower(substring(chaine,2)) );
RETURN machaine;
END$$

DROP FUNCTION IF EXISTS `nombre_photo`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `nombre_photo` (`id` INT) RETURNS INT BEGIN
DECLARE nbrphoto int;
SELECT count(*) INTO nbrphoto FROM photo WHERE idUser = id;
RETURN nbrphoto;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `acheter`
--

DROP TABLE IF EXISTS `acheter`;
CREATE TABLE IF NOT EXISTS `acheter` (
  `idAcheter` int NOT NULL AUTO_INCREMENT,
  `idUser` int NOT NULL,
  `idPhoto` int NOT NULL,
  PRIMARY KEY (`idAcheter`,`idUser`,`idPhoto`),
  KEY `idUser_idx` (`idUser`),
  KEY `idPhoto_idx` (`idPhoto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `idMenu` int NOT NULL,
  `nomMenu` varchar(45) DEFAULT NULL,
  `URL` varchar(100) DEFAULT NULL,
  `Habilitation` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idMenu`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `menu`
--

INSERT INTO `menu` (`idMenu`, `nomMenu`, `URL`, `Habilitation`) VALUES
(1, 'Album', NULL, 'APCV'),
(12, 'Voir Photo', 'voirPhoto.php', 'APCV'),
(2, 'Profil', NULL, 'APC'),
(21, 'Voir Profil', 'voirProfil.php', 'APC'),
(3, 'Administration', '', 'A'),
(31, 'Gerer Utilisateurs', 'gererUtilisateur.php', 'A'),
(32, 'Ajout Tag', 'ajoutTag.php', 'A'),
(33, 'Gerer Tags', 'gererTag.php', 'A'),
(4, 'Option Photographe', '', 'P'),
(41, 'Ajout Tag', 'ajoutTag.php', 'P'),
(42, 'Vendre Photo', 'vendrePhoto.php', 'P'),
(43, 'Échanger crédits', 'echangeCredit.php', 'P'),
(34, 'Gerer Photos', 'gererPhoto.php', 'A');

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `idPhoto` int NOT NULL AUTO_INCREMENT,
  `libellePhoto` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `photoLargeur` int NOT NULL,
  `photoLongueur` int NOT NULL,
  `nomImage` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `prix` int NOT NULL,
  `active` int NOT NULL DEFAULT '0',
  `datePub` datetime NOT NULL,
  `poids` float NOT NULL,
  `idUser` int NOT NULL,
  `idTags` int NOT NULL,
  PRIMARY KEY (`idPhoto`),
  KEY `idUser_idx` (`idUser`),
  KEY `idTags_idx` (`idTags`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`idPhoto`, `libellePhoto`, `photoLargeur`, `photoLongueur`, `nomImage`, `prix`, `active`, `datePub`, `poids`, `idUser`, `idTags`) VALUES
(1, 'Singe pensif', 640, 640, 'ZkCPSVn9J1QwDEwtygpH_2022_05_02_10_28_04.jpg', 500, 1, '2022-05-02 10:28:04', 91716, 2, 4),
(2, 'Pizza d\'italie', 660, 660, 'DnTkLK0tLzFJAWQQseIV_2022_05_02_10_28_23.jpg', 1500, 1, '2022-05-02 10:28:23', 202559, 2, 3),
(3, 'Ordinateur quantique', 2000, 1000, '6akHziC9VmBMshAlzPUF_2022_05_02_10_28_37.jpg', 3000, 1, '2022-05-02 10:28:37', 429568, 2, 1),
(4, 'Abeille', 1200, 800, 'ptFs6bmC2Eu6gS3J5Oye_2022_05_02_10_28_55.jpg', 2500, 1, '2022-05-02 10:28:55', 194548, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `idTags` int NOT NULL AUTO_INCREMENT,
  `libelleTags` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` int NOT NULL,
  `idUser` int NOT NULL,
  PRIMARY KEY (`idTags`),
  KEY `iduser_idx` (`idUser`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tags`
--

INSERT INTO `tags` (`idTags`, `libelleTags`, `active`, `idUser`) VALUES
(1, 'Technologie', 1, 2),
(2, 'Insecte', 1, 2),
(3, 'Nourriture', 1, 1),
(4, 'Animal', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `idUser` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `mdp` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dateNaiss` date DEFAULT NULL,
  `credit` int NOT NULL DEFAULT '0',
  `argent` decimal(10,2) NOT NULL DEFAULT '0.00',
  `active` int NOT NULL,
  `type` varchar(45) NOT NULL,
  `photoUser` varchar(100) DEFAULT NULL,
  `siteUser` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `siret` varchar(14) DEFAULT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idUser`, `nom`, `prenom`, `email`, `mdp`, `dateNaiss`, `credit`, `argent`, `active`, `type`, `photoUser`, `siteUser`, `siret`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', 'df6b9fb15cfdbb7527be5a8a6e39f39e572c8ddb943fbc79a943438e9d3d85ebfc2ccf9e0eccd9346026c0b6876e0e01556fe56f135582c05fbdbb505d46755a', NULL, 0, '0.00', 1, 'admin', 'jjKE330h0q0JhaGUMlHG_2022_03_27_21_58_42.jpg', NULL, NULL),
(2, 'Baie', 'Michel', 'michelbaie@gmail.com', 'df6b9fb15cfdbb7527be5a8a6e39f39e572c8ddb943fbc79a943438e9d3d85ebfc2ccf9e0eccd9346026c0b6876e0e01556fe56f135582c05fbdbb505d46755a', NULL, 0, '0.00', 1, 'photographe', '1hkiMiPpghRlhpjEynKQ_2022_05_02_10_23_14.jpg', 'http://michel-baie-blog.fr', '98636348300083'),
(3, 'Allen', 'Henry', 'henryallen@outlook.com', 'df6b9fb15cfdbb7527be5a8a6e39f39e572c8ddb943fbc79a943438e9d3d85ebfc2ccf9e0eccd9346026c0b6876e0e01556fe56f135582c05fbdbb505d46755a', '1963-11-07', 0, '0.00', 1, 'client', 'aNOpN5CaYIc5u8KV6Dju_2022_05_02_10_25_26.jpg', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
