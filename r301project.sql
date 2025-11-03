-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 02, 2025 at 11:10 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `r301project`
--

-- --------------------------------------------------------

--
-- Table structure for table `mp_cours`
--

DROP TABLE IF EXISTS `mp_cours`;
CREATE TABLE IF NOT EXISTS `mp_cours` (
  `cour_id` int NOT NULL AUTO_INCREMENT,
  `dates` date NOT NULL,
  `heure_deb` time NOT NULL,
  `heure_fin` time NOT NULL,
  `promo` int NOT NULL,
  `cour_td` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cour_tp` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_enseignant` int NOT NULL,
  `fk_matiere` int NOT NULL,
  PRIMARY KEY (`cour_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mp_cours`
--

INSERT INTO `mp_cours` (`cour_id`, `dates`, `heure_deb`, `heure_fin`, `promo`, `cour_td`, `cour_tp`, `fk_enseignant`, `fk_matiere`) VALUES
(12, '2025-02-04', '15:15:00', '17:30:00', 1, '1', 'A', 4, 7),
(13, '2025-02-12', '12:00:00', '14:00:00', 2, '2', 'A', 5, 6),
(14, '2025-10-30', '18:00:00', '19:00:00', 2, '2', 'C', 4, 6),
(18, '2025-10-30', '14:00:00', '17:00:00', 1, '2', '', 5, 6),
(19, '1960-10-28', '13:00:00', '23:00:00', 3, '', '', 4, 7),
(20, '2025-11-01', '10:00:00', '11:00:00', 1, '2', '', 6, 10),
(21, '2025-10-31', '08:00:00', '09:00:00', 1, '2', '', 6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `mp_enseignants`
--

DROP TABLE IF EXISTS `mp_enseignants`;
CREATE TABLE IF NOT EXISTS `mp_enseignants` (
  `rowid` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `adress` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `town` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_user` int NOT NULL,
  PRIMARY KEY (`rowid`),
  KEY `fk_user_ens` (`fk_user`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mp_enseignants`
--

INSERT INTO `mp_enseignants` (`rowid`, `firstname`, `lastname`, `birthday`, `adress`, `zipcode`, `town`, `fk_user`) VALUES
(4, 'Francis', 'Blé', '1982-04-01', '48 des trous', '40101', 'Lens', 16),
(5, 'Ric', 'Siko', '1980-04-11', '46 rue des fermes', '00215', 'Plais', 17),
(6, 'Joseph', 'Antoine', '1994-02-10', '14 rue des beau Airs', '62400', 'Paris', 25);

-- --------------------------------------------------------

--
-- Table structure for table `mp_etudiants`
--

DROP TABLE IF EXISTS `mp_etudiants`;
CREATE TABLE IF NOT EXISTS `mp_etudiants` (
  `rowid` int NOT NULL AUTO_INCREMENT,
  `numetu` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `diploma` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int NOT NULL,
  `td` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tp` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `town` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_user` int NOT NULL,
  PRIMARY KEY (`rowid`),
  KEY `fk_user` (`fk_user`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mp_etudiants`
--

INSERT INTO `mp_etudiants` (`rowid`, `numetu`, `firstname`, `lastname`, `birthday`, `diploma`, `year`, `td`, `tp`, `adress`, `zipcode`, `town`, `fk_user`) VALUES
(5, '450080', 'Yul', 'Mal', '2003-05-22', 'but', 2, '1', 'A', '45 ruz des frlz', '54008', 'Hail', 5),
(6, '45010806', 'Tatin', 'Arisko', '2005-08-04', 'but', 2, '1', 'E', '15 rue des frzk', '78004', 'jiols', 6),
(7, '4820005', 'Loas', 'Justi', '2008-08-04', 'master', 1, '2', 'B', '78 rue des feufh', '45500', 'Lolas', 7),
(8, '45500', 'olpm', 'Ouris', '2000-08-05', 'license pro', 3, '2', 'A', '45 rues des frjhz', '80402', 'Laos', 8),
(10, '44005', 'Gilbert', 'Francky', '2006-02-22', 'master', 3, '1', 'A', '14 rue des beau Airs', '32000', 'Paris', 10),
(11, '84400', 'Jean', 'Malas', '2003-04-05', 'license pro', 2, '2', 'B', '47 rue pere', '45002', 'Loka', 11),
(12, '47800080', 'Thomas', 'Youl', '2005-04-05', 'but', 2, '1', 'A', '34 rue des d', '47008', 'Marseille', 15),
(13, '450101', 'Fabien', 'Li', '2004-02-10', 'license pro', 2, '2', 'B', '01 Allée des faubours', '45070', 'Paris', 18),
(15, '450101', 'Gesom', 'Liam', '2004-02-10', 'license pro', 2, '2', 'B', '01 Allée des faubours', '45070', 'Paris', 23),
(16, '0010012', 'Antony', 'Albert', '2005-01-12', 'master', 2, '2', 'C', 'Rue des Herbes', '40010', 'Lyon', 24),
(18, '004400', 'Piwerre', 'olive', '2001-10-10', 'but', 1, '1', '12', '14e fef e', '58000', 'lons', 28);

-- --------------------------------------------------------

--
-- Table structure for table `mp_matieres`
--

DROP TABLE IF EXISTS `mp_matieres`;
CREATE TABLE IF NOT EXISTS `mp_matieres` (
  `matid` int NOT NULL AUTO_INCREMENT,
  `matnom` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `matcoeff` int NOT NULL,
  `fk_modules` int NOT NULL,
  PRIMARY KEY (`matid`),
  KEY `fk_modules` (`fk_modules`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mp_matieres`
--

INSERT INTO `mp_matieres` (`matid`, `matnom`, `matcoeff`, `fk_modules`) VALUES
(6, 'Foot', 57, 10),
(7, 'Compréhension Ecrite', 10, 11),
(10, 'Foot01', 24, 12);

-- --------------------------------------------------------

--
-- Table structure for table `mp_modules`
--

DROP TABLE IF EXISTS `mp_modules`;
CREATE TABLE IF NOT EXISTS `mp_modules` (
  `modid` int NOT NULL AUTO_INCREMENT,
  `modnom` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modcoeff` int NOT NULL,
  PRIMARY KEY (`modid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mp_modules`
--

INSERT INTO `mp_modules` (`modid`, `modnom`, `modcoeff`) VALUES
(9, 'Sport1', 62),
(10, 'Sport', 62),
(11, 'allemand', 10),
(12, 'Langue Vivante', 8);

-- --------------------------------------------------------

--
-- Table structure for table `mp_users`
--

DROP TABLE IF EXISTS `mp_users`;
CREATE TABLE IF NOT EXISTS `mp_users` (
  `rowid` int NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rowid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mp_users`
--

INSERT INTO `mp_users` (`rowid`, `username`, `password`, `firstname`, `lastname`, `date_created`, `date_updated`, `admin`) VALUES
(1, 'thomas22', 'd8afbb626592b4425e801860ca7133ce', 'Thomas', 'Justin', '2025-09-17 17:10:51', '2025-09-17 17:14:15', 1),
(5, 'totolasticot', '$2y$10$XUK6brzOK0kWq4DA1FWLoOIJpqd2XPlsFeOD7TgHw52gyLgdQSnBe', 'Yul', 'Mal', '2025-10-16 20:08:40', '2025-10-16 20:08:40', 0),
(6, 'vamos', '$2y$10$Bk8JXq0f33YuGBLW.F/a7O4r385dOKZNVk6nkuq.8f36SCbTJR8PS', 'Tatin', 'Arisko', '2025-10-18 21:38:12', '2025-10-18 21:38:12', 0),
(7, 'laisl045', '$2y$10$ybm2tgvM7HpZk.3uRajQWeKwszyN7gZ45mDrNw7IatO44iu4HjZIG', 'Loas', 'Justi', '2025-10-18 21:39:18', '2025-10-18 21:39:18', 0),
(8, 'tieiq', '$2y$10$K9E.9fYf3lThmSKedUN2senzS0W9l/vsETqtEsr7AwS.8HaYR0KEi', 'olpm', 'Ouris', '2025-10-18 21:57:05', '2025-10-18 21:57:05', 0),
(10, 'Gilbert32', '$2y$10$H83b7Z4WUEnT70hHhaxlAeKerxqL1hFpo6.jjX8v20S61Cumlwjya', 'Gilbert', 'Francky', '2025-10-18 22:26:14', '2025-10-18 22:26:14', 0),
(11, 'Jeandu02', '$2y$10$9UBcwENCht99HFtnh5ziiO9TcaTsqAa2XO1DXMmR1I6jzmdz028UG', 'Jean', 'Malas', '2025-10-18 22:36:28', '2025-10-18 22:36:28', 0),
(15, 'thomas00', '$2y$10$bKNdb4ln/SQiBoJtE7jkHu5J8AsMrBd8AP5OO49plGphjSHSkTRFi', 'Thomas', 'Youl', '2025-10-27 21:20:13', '2025-10-27 21:20:13', 0),
(16, 'Francis', '$2y$10$f6LglKsrBx5nHES6sq.GrurYbUmnMeQYHDPEU/4iShPInc8AF9MTi', 'Francis', 'Blé', '2025-10-27 21:22:15', '2025-10-27 21:22:15', 0),
(17, 'Ric0', '$2y$10$lMoI/ixifSPK.s1xHdlB1e4/8NxBT9tcharRvkHGZRBDdwRVDxbw.', 'Ric', 'Siko', '2025-10-27 21:23:40', '2025-10-27 21:23:40', 0),
(18, 'fabien01', '$2y$10$yY/weQvtMnQut0.kEddUIecSwfQEhcHoJ.4Ufdv.6rEuEwBLeGq6m', 'Fabien', 'Li', '2025-10-31 13:21:08', '2025-10-31 13:21:08', 0),
(20, 'Gest001', '$2y$10$Kg2iSYLbrEMRFCk/NXch4ulMnvLGo2Ji8M4qEKf/plCwa8Ne54jrK', 'Gest', 'Li', '2025-10-31 13:24:27', '2025-10-31 13:24:27', 0),
(23, 'Liam.j', '$2y$10$9mO0c1mTKR44Yuzjlc.I3.u7hLslwYUzKFbpa0GV7HPhRecZyMd4i', 'Gesom', 'Liam', '2025-10-31 13:27:13', '2025-10-31 13:27:13', 0),
(24, 'Albert01', '$2y$10$Ug50y8oM/Tmx084uKv2p2OGlfVk6ZWBb3PMFxesGRwcXMBKAiCGY.', 'Pierre', 'Albert', '2025-10-31 13:32:42', '2025-10-31 13:32:42', 0),
(25, 'Joseph_prof', '$2y$10$tCy58KLT3Fsr0j4jov0r3eSd1K2nG2cb9GF1Mk3mheW1BcoRbI/4u', 'Joseph', 'Antoine', '2025-10-31 13:38:27', '2025-10-31 13:38:27', 0),
(28, 'derzef0', '$2y$10$5IfC12zJACZbdGG09sImg.sFrkzuk0eWfUa2dH.17atOh743GDhcu', 'Piwerre', 'olive', '2025-10-31 14:26:51', '2025-10-31 14:26:51', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mp_enseignants`
--
ALTER TABLE `mp_enseignants`
  ADD CONSTRAINT `fk_user_ens` FOREIGN KEY (`fk_user`) REFERENCES `mp_users` (`rowid`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `mp_etudiants`
--
ALTER TABLE `mp_etudiants`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`fk_user`) REFERENCES `mp_users` (`rowid`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `mp_matieres`
--
ALTER TABLE `mp_matieres`
  ADD CONSTRAINT `fk_module` FOREIGN KEY (`fk_modules`) REFERENCES `mp_modules` (`modid`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
