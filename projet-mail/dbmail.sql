-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  lun. 25 fév. 2019 à 10:52
-- Version du serveur :  10.1.37-MariaDB-0+deb9u1
-- Version de PHP :  7.0.33-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dbmail`
--

-- --------------------------------------------------------

--
-- Structure de la table `archive`
--

CREATE TABLE `archive` (
  `mailP` varchar(64) NOT NULL,
  `mailR` varchar(64) NOT NULL,
  `destinataire` varchar(64) NOT NULL,
  `personal` varchar(32) DEFAULT NULL,
  `emetteur` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `imapurl`
--

CREATE TABLE `imapurl` (
  `domaine` varchar(32) NOT NULL,
  `url` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `imapurl`
--

INSERT INTO `imapurl` (`domaine`, `url`) VALUES
('yahoo.co.jp', 'imap.mail.yahoo.co.jp'),
('yahoo.com', 'imap.mail.yahoo.com'),
('outlook.com', 'imap-mail.outlook.com'),
('hotmail.com', 'imap-mail.outlook.com'),
('gmail.com', 'imap.gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `logmail`
--

CREATE TABLE `logmail` (
  `mailP` varchar(64) DEFAULT NULL,
  `mailR` varchar(64) DEFAULT NULL,
  `ip` varchar(16) NOT NULL,
  `os` varchar(32) NOT NULL,
  `navigateur` varchar(32) NOT NULL,
  `datelog` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `scorebot` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `verif`
--

CREATE TABLE `verif` (
  `idverif` int(11) NOT NULL,
  `emailverif` varchar(64) NOT NULL,
  `codeverif` varchar(16) NOT NULL,
  `dateverif` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `verif`
--
ALTER TABLE `verif`
  ADD PRIMARY KEY (`idverif`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `verif`
--
ALTER TABLE `verif`
  MODIFY `idverif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
