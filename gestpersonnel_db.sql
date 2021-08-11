-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 13 mai 2019 à 13:35
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestpersonnel`
--

-- --------------------------------------------------------

--
-- Structure de la table `affectation`
--

DROP TABLE IF EXISTS `affectation`;
CREATE TABLE IF NOT EXISTS `affectation` (
  `affectation` varchar(40) NOT NULL,
  `division` varchar(40) NOT NULL,
  `idA` int(11) NOT NULL AUTO_INCREMENT,
  `posteOccupe` varchar(40) NOT NULL,
  `DatePriseServ` date NOT NULL,
  `DateCessServ` date NOT NULL,
  `observation` text NOT NULL,
  `IdEnt` int(11) NOT NULL,
  PRIMARY KEY (`idA`),
  KEY `IdEnt` (`IdEnt`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `affectation`
--

INSERT INTO `affectation` (`affectation`, `division`, `idA`, `posteOccupe`, `DatePriseServ`, `DateCessServ`, `observation`, `IdEnt`) VALUES
('Affectation 1', 'DCL', 1, 'Poste-x', '2019-04-01', '2019-04-07', 'Observation pour testet l\'ajoute de affecatton', 6),
('Affectation 2', 'DSM', 2, 'POST_J', '2019-05-15', '2019-05-15', 'Observation pour tester la recgerche sur page d\'accueil', 3);

-- --------------------------------------------------------

--
-- Structure de la table `authent`
--

DROP TABLE IF EXISTS `authent`;
CREATE TABLE IF NOT EXISTS `authent` (
  `idAuthent` int(11) NOT NULL AUTO_INCREMENT,
  `MotPass` varchar(255) NOT NULL,
  `Log` varchar(60) NOT NULL,
  `Nom` varchar(30) NOT NULL,
  `Prenom` varchar(30) NOT NULL,
  `Role` int(11) NOT NULL,
  PRIMARY KEY (`idAuthent`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `authent`
--

INSERT INTO `authent` (`idAuthent`, `MotPass`, `Log`, `Nom`, `Prenom`, `Role`) VALUES
(1, '$2y$10$vJHBG14GYPpLNobNbwtjKeTo3FG/WMyVEq2fV5gbTqvZcSwPf/zji', 'Admin_p', 'AdmNom', 'AdmPrenom', 0);

-- --------------------------------------------------------

--
-- Structure de la table `conjoint`
--

DROP TABLE IF EXISTS `conjoint`;
CREATE TABLE IF NOT EXISTS `conjoint` (
  `idC` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) NOT NULL,
  `prenom` varchar(60) NOT NULL,
  `profession` varchar(70) NOT NULL,
  `dateNaissance` date NOT NULL,
  `nomAr` varchar(60) NOT NULL,
  `prenomAr` varchar(60) NOT NULL,
  `CIN` varchar(15) NOT NULL,
  `IdEnt` int(11) NOT NULL,
  PRIMARY KEY (`idC`),
  KEY `IdEnt` (`IdEnt`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `conjoint`
--

INSERT INTO `conjoint` (`idC`, `nom`, `prenom`, `profession`, `dateNaissance`, `nomAr`, `prenomAr`, `CIN`, `IdEnt`) VALUES
(2, 'Ayoub', 'AdmPrenom', 'Profession', '1986-10-21', 'Ø§Ù„Ù„Ù‚Ø§Ø¨ÙŠ', 'Ø¹ØµØ§Ù…', 'CIN12345', 3);

-- --------------------------------------------------------

--
-- Structure de la table `coordbanc`
--

DROP TABLE IF EXISTS `coordbanc`;
CREATE TABLE IF NOT EXISTS `coordbanc` (
  `banque` varchar(40) NOT NULL,
  `agence` varchar(60) NOT NULL,
  `ville` varchar(60) NOT NULL,
  `idC` int(11) NOT NULL AUTO_INCREMENT,
  `IdEnt` int(11) NOT NULL,
  PRIMARY KEY (`idC`),
  KEY `IdEnt` (`IdEnt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `diplomes`
--

DROP TABLE IF EXISTS `diplomes`;
CREATE TABLE IF NOT EXISTS `diplomes` (
  `idD` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(40) NOT NULL,
  `specialite` varchar(60) NOT NULL,
  `etablissement` varchar(40) NOT NULL,
  `dateEntr` date NOT NULL,
  `lieu` varchar(60) NOT NULL,
  `pay` varchar(40) NOT NULL,
  `descp` text NOT NULL,
  `IdEnt` int(11) NOT NULL,
  PRIMARY KEY (`idD`),
  KEY `diplomes_ibfk_1` (`IdEnt`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `diplomes`
--

INSERT INTO `diplomes` (`idD`, `intitule`, `specialite`, `etablissement`, `dateEntr`, `lieu`, `pay`, `descp`, `IdEnt`) VALUES
(5, 'TSDE', 'RÃ©seaux', 'SOLOLEARN', '2019-04-01', 'Marrakech', 'Maroc', 'DEgav qsdh sdzezeopoelkzjekh', 3);

-- --------------------------------------------------------

--
-- Structure de la table `enfant`
--

DROP TABLE IF EXISTS `enfant`;
CREATE TABLE IF NOT EXISTS `enfant` (
  `idE` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(60) NOT NULL,
  `Prenom` varchar(60) NOT NULL,
  `NomAr` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PrenomAr` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `DateNa` date NOT NULL,
  `Sexe` varchar(10) NOT NULL,
  `idC` int(11) NOT NULL,
  PRIMARY KEY (`idE`),
  KEY `idC` (`idC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `etablissement_origine`
--

DROP TABLE IF EXISTS `etablissement_origine`;
CREATE TABLE IF NOT EXISTS `etablissement_origine` (
  `idEt` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `poste` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `specialite` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `lieu` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `pay` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `IdEnt` int(11) NOT NULL,
  PRIMARY KEY (`idEt`),
  KEY `IdEnt` (`IdEnt`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `etablissement_origine`
--

INSERT INTO `etablissement_origine` (`idEt`, `intitule`, `poste`, `specialite`, `dateDebut`, `dateFin`, `lieu`, `pay`, `description`, `IdEnt`) VALUES
(1, 'Intitule', 'Poste_x', 'SpÃ©cialitÃ©', '2008-06-27', '2016-07-13', 'Casablanca', 'Maroc', 'Etablissement d\'instriel de l\'embalage', 3),
(2, 'TSDE', 'PosteY', 'spÃ©cialitÃ©', '2019-05-07', '2019-05-31', 'Marrakech', 'Maroc', 'description pour tester l\'ajoute de Ã©tablissement d\'origine', 3);

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `idF` int(11) NOT NULL AUTO_INCREMENT,
  `etablissment` varchar(60) NOT NULL,
  `specialite` varchar(60) NOT NULL,
  `duree` int(11) NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `lieu` varchar(60) NOT NULL,
  `pay` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `IdEnt` int(11) NOT NULL,
  PRIMARY KEY (`idF`),
  KEY `IdEnt` (`IdEnt`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`idF`, `etablissment`, `specialite`, `duree`, `dateDebut`, `dateFin`, `lieu`, `pay`, `description`, `IdEnt`) VALUES
(1, 'ABDELAL BENSSGAROUN', 'ELE', 9, '2019-05-31', '2019-05-31', 'Larache', 'Maroc', 'Description pour supprimer deails', 5);

-- --------------------------------------------------------

--
-- Structure de la table `grade`
--

DROP TABLE IF EXISTS `grade`;
CREATE TABLE IF NOT EXISTS `grade` (
  `idG` int(11) NOT NULL AUTO_INCREMENT,
  `Echelle` int(11) NOT NULL,
  `Classe` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Echelon` int(11) NOT NULL,
  `indice` int(11) NOT NULL,
  `dateEffect` date NOT NULL,
  `IdEnt` int(11) NOT NULL,
  PRIMARY KEY (`idG`),
  KEY `IdEnt` (`IdEnt`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `grade`
--

INSERT INTO `grade` (`idG`, `Echelle`, `Classe`, `Echelon`, `indice`, `dateEffect`, `IdEnt`) VALUES
(2, 10, 'Unique', 7, 639, '2019-04-26', 6),
(3, 10, '1Ã©re', 9, 175, '2009-01-12', 3);

-- --------------------------------------------------------

--
-- Structure de la table `identite`
--

DROP TABLE IF EXISTS `identite`;
CREATE TABLE IF NOT EXISTS `identite` (
  `CIN` varchar(15) NOT NULL,
  `Nom` varchar(30) DEFAULT NULL,
  `Prenom` varchar(30) DEFAULT NULL,
  `Nom_ar` varchar(30) DEFAULT NULL,
  `Prenom_ar` varchar(30) DEFAULT NULL,
  `DateNassance` date DEFAULT NULL,
  `LieuNaissance` varchar(50) DEFAULT NULL,
  `PayNaissance` varchar(30) DEFAULT NULL,
  `Sexe` varchar(10) DEFAULT NULL,
  `EtatMatrimonial` varchar(30) DEFAULT NULL,
  `DateRecrutement` date DEFAULT NULL,
  `ImputationBudg` varchar(25) DEFAULT NULL,
  `PPR` varchar(10) DEFAULT NULL,
  `NPort` varchar(15) DEFAULT NULL,
  `NFix` varchar(15) DEFAULT NULL,
  `Email` varchar(25) DEFAULT NULL,
  `Adresse` varchar(40) DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `Observation` text,
  `IdEnt` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`IdEnt`),
  UNIQUE KEY `IdEnt` (`IdEnt`),
  UNIQUE KEY `CIN` (`CIN`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `identite`
--

INSERT INTO `identite` (`CIN`, `Nom`, `Prenom`, `Nom_ar`, `Prenom_ar`, `DateNassance`, `LieuNaissance`, `PayNaissance`, `Sexe`, `EtatMatrimonial`, `DateRecrutement`, `ImputationBudg`, `PPR`, `NPort`, `NFix`, `Email`, `Adresse`, `Photo`, `Observation`, `IdEnt`) VALUES
('cin124779', 'El Qabi', 'Issam', 'Ø§Ù„Ù„Ù‚Ø§Ø¨ÙŠ', 'Ø¹ØµØ§Ù…', '2019-04-09', 'Paris', 'France', 'Homme', 'Celibataire', '2019-04-01', 'Communale', 'QW2', '90898786785', '09786787856', 'chorrib@gmail.com', 'Lqrqch', 'uploads/10038user-02.jpg', 'observation pour tester la modification', 3),
('CIN32554929', 'bensraghin', 'charaf', 'Ø¨Ù†Ø³Ø±ØºÙŠÙ†', 'Ø²ÙˆØ¬Ø©', '2019-04-23', 'Larache', 'Maroc', 'Homme', 'Divorcee', '2019-04-17', 'Communale', 'PPR103', '05635343', '3090093890', 'hm.bensarghin@gmail.com', 'Jnane Kastiel', 'C:\\wamp2\\tmp\\phpF206.tmp', 'ljjljflfgjs', 5),
('CIN12375', 'Jaded', 'Ahmed', 'Ø§Ù„Ø³ÙŠØ³', 'Ø§Ø­Ù…Ø¯', '2019-04-03', 'Larache', 'Maroc', 'Homme', 'Veuve', '2019-04-23', 'Generale', 'PPR103', '05635343', '3090093890', 'hm.bensarghin@gmail.com', 'Jnane Kastiel', 'uploads/27529trainer1.jpg', 'Observation', 6);

-- --------------------------------------------------------

--
-- Structure de la table `langues`
--

DROP TABLE IF EXISTS `langues`;
CREATE TABLE IF NOT EXISTS `langues` (
  `langue` varchar(40) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Niveau` varchar(30) NOT NULL,
  `IdEnt` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IdEnt` (`IdEnt`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `langues`
--

INSERT INTO `langues` (`langue`, `id`, `Niveau`, `IdEnt`) VALUES
('Arabe', 3, 'Maternel', 3);

-- --------------------------------------------------------

--
-- Structure de la table `mutuelle`
--

DROP TABLE IF EXISTS `mutuelle`;
CREATE TABLE IF NOT EXISTS `mutuelle` (
  `idM` int(11) NOT NULL AUTO_INCREMENT,
  `typeMut` varchar(15) NOT NULL,
  `Matricule` varchar(20) NOT NULL,
  `NumAffiliation` int(11) NOT NULL,
  `DateAffiliation` date NOT NULL,
  `IdEnt` int(11) NOT NULL,
  PRIMARY KEY (`idM`),
  KEY `IdEnt` (`IdEnt`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `mutuelle`
--

INSERT INTO `mutuelle` (`idM`, `typeMut`, `Matricule`, `NumAffiliation`, `DateAffiliation`, `IdEnt`) VALUES
(1, 'MACRA', 'MAT1', 12929, '2017-04-12', 3);

-- --------------------------------------------------------

--
-- Structure de la table `notation`
--

DROP TABLE IF EXISTS `notation`;
CREATE TABLE IF NOT EXISTS `notation` (
  `idN` int(11) NOT NULL AUTO_INCREMENT,
  `annee` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `appre` int(11) NOT NULL,
  `IdEnt` int(11) NOT NULL,
  PRIMARY KEY (`idN`),
  KEY `IdEnt` (`IdEnt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `regimeretraite`
--

DROP TABLE IF EXISTS `regimeretraite`;
CREATE TABLE IF NOT EXISTS `regimeretraite` (
  `idR` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL,
  `numAffel` int(11) NOT NULL,
  `dateAffel` date NOT NULL,
  `IdEnt` int(11) NOT NULL,
  PRIMARY KEY (`idR`),
  KEY `IdEnt` (`IdEnt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `idS` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `IdEnt` int(11) NOT NULL,
  PRIMARY KEY (`idS`),
  KEY `IdEnt` (`IdEnt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `affectation`
--
ALTER TABLE `affectation`
  ADD CONSTRAINT `affectation_ibfk_1` FOREIGN KEY (`IdEnt`) REFERENCES `identite` (`IdEnt`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `conjoint`
--
ALTER TABLE `conjoint`
  ADD CONSTRAINT `conjoint_ibfk_1` FOREIGN KEY (`IdEnt`) REFERENCES `identite` (`IdEnt`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `coordbanc`
--
ALTER TABLE `coordbanc`
  ADD CONSTRAINT `coordbanc_ibfk_1` FOREIGN KEY (`IdEnt`) REFERENCES `identite` (`IdEnt`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `diplomes`
--
ALTER TABLE `diplomes`
  ADD CONSTRAINT `diplomes_ibfk_1` FOREIGN KEY (`IdEnt`) REFERENCES `identite` (`IdEnt`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `enfant`
--
ALTER TABLE `enfant`
  ADD CONSTRAINT `enfant_ibfk_1` FOREIGN KEY (`idC`) REFERENCES `conjoint` (`idC`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `etablissement_origine`
--
ALTER TABLE `etablissement_origine`
  ADD CONSTRAINT `etablissement_origine_ibfk_1` FOREIGN KEY (`IdEnt`) REFERENCES `identite` (`IdEnt`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `formation`
--
ALTER TABLE `formation`
  ADD CONSTRAINT `formation_ibfk_1` FOREIGN KEY (`IdEnt`) REFERENCES `identite` (`IdEnt`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `grade`
--
ALTER TABLE `grade`
  ADD CONSTRAINT `grade_ibfk_1` FOREIGN KEY (`IdEnt`) REFERENCES `identite` (`IdEnt`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `langues`
--
ALTER TABLE `langues`
  ADD CONSTRAINT `langues_ibfk_1` FOREIGN KEY (`IdEnt`) REFERENCES `identite` (`IdEnt`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `mutuelle`
--
ALTER TABLE `mutuelle`
  ADD CONSTRAINT `mutuelle_ibfk_1` FOREIGN KEY (`IdEnt`) REFERENCES `identite` (`IdEnt`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `notation`
--
ALTER TABLE `notation`
  ADD CONSTRAINT `notation_ibfk_1` FOREIGN KEY (`IdEnt`) REFERENCES `identite` (`IdEnt`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `regimeretraite`
--
ALTER TABLE `regimeretraite`
  ADD CONSTRAINT `regimeretraite_ibfk_1` FOREIGN KEY (`IdEnt`) REFERENCES `identite` (`IdEnt`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`IdEnt`) REFERENCES `identite` (`IdEnt`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
