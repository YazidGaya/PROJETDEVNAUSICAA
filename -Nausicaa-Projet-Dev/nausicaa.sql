-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 14 juin 2024 à 17:29
-- Version du serveur : 5.7.24
-- Version de PHP : 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `nausicaa`
--

-- --------------------------------------------------------

--
-- Structure de la table `leaderboard`
--

CREATE TABLE `leaderboard` (
  `Difficulty` int(11) NOT NULL,
  `Time1` int(11) NOT NULL,
  `Time1Player` char(255) NOT NULL,
  `Time2` int(11) NOT NULL,
  `Time2Player` char(255) NOT NULL,
  `Time3` int(11) NOT NULL,
  `Time3Player` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `leaderboard`
--

INSERT INTO `leaderboard` (`Difficulty`, `Time1`, `Time1Player`, `Time2`, `Time2Player`, `Time3`, `Time3Player`) VALUES
(2, 57, 'Paul', 79, 'Simon', 84, 'Erwann'),
(1, 27, 'Faustine', 32, 'Esther', 39, 'Yazid'),
(3, 192, 'Erwann', 227, 'Paul', 254, 'Esther');

-- --------------------------------------------------------

--
-- Structure de la table `maps`
--

CREATE TABLE `maps` (
  `Id` int(11) NOT NULL,
  `Difficulty` int(11) NOT NULL,
  `Size` int(11) NOT NULL,
  `HorizontalValues` char(255) NOT NULL,
  `VerticalValues` char(255) NOT NULL,
  `Field` text NOT NULL,
  `Author` char(255) NOT NULL,
  `BestTime` int(11) NOT NULL,
  `BestTimeAuthor` char(255) NOT NULL,
  `PlayedTime` int(11) NOT NULL DEFAULT '0',
  `NBoat1` int(11) NOT NULL,
  `NBoat2` int(11) NOT NULL,
  `NBoat3` int(11) NOT NULL,
  `NBoat4` int(11) NOT NULL,
  `NBoat5` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `maps`
--

INSERT INTO `maps` (`Id`, `Difficulty`, `Size`, `HorizontalValues`, `VerticalValues`, `Field`, `Author`, `BestTime`, `BestTimeAuthor`, `PlayedTime`, `NBoat1`, `NBoat2`, `NBoat3`, `NBoat4`, `NBoat5`) VALUES
(66, 1, 6, '2/2/2/1/1/2', '1/3/0/4/0/2', '0/2/0/0/0/5!0/0/0/5/0/0!0/0/0/0/0/0!0/0/0/4/0/0!0/0/0/0/0/0!0/4/0/0/0/0', 'Auto', 0, 'Null', 0, 3, 2, 1, 0, 0),
(67, 1, 6, '2/2/2/1/0/3', '0/4/0/1/1/4', '0/0/0/0/0/5!0/0/0/0/0/4!0/0/0/0/0/0!0/0/0/0/0/0!0/0/0/0/0/0!0/0/0/0/6/7', 'Auto', 0, 'Null', 0, 3, 2, 1, 0, 0),
(69, 1, 6, '2/0/3/1/2/2', '1/2/3/0/4/0', '0/0/0/0/2/0!0/0/0/0/0/0!0/6/0/0/5/0!0/0/0/0/0/0!0/0/5/0/0/0!2/0/0/0/0/0', 'Auto', 0, 'Null', 0, 3, 2, 1, 0, 0),
(70, 2, 6, '2/0/3/1/2/2', '3/0/2/1/2/2', '0/0/0/0/6/7!0/0/0/0/0/0!0/0/0/0/0/0!3/0/0/0/0/0!0/0/0/0/0/0!0/0/0/0/0/0', 'Auto', 0, 'Null', 0, 3, 2, 1, 0, 0),
(71, 2, 6, '1/2/0/3/1/3', '0/2/2/3/0/3', '0/0/0/0/0/0!0/0/6/7/0/0!0/0/0/0/0/0!0/6/0/7/0/0!0/0/0/0/0/0!0/0/0/0/0/0', 'Auto', 0, 'Null', 0, 3, 2, 1, 0, 0),
(72, 2, 6, '1/2/0/4/1/2', '2/2/2/1/0/3', '0/0/0/0/0/0!0/0/7/0/0/0!0/0/0/0/0/0!0/0/0/0/0/5!0/0/0/0/0/0!2/0/0/0/0/0', 'Auto', 0, 'Null', 0, 3, 2, 1, 0, 0),
(73, 3, 6, '1/2/4/1/1/1', '1/3/0/4/0/2', '0/0/0/0/0/0!0/0/0/0/0/0!0/0/0/3/0/0!0/0/0/0/0/0!0/0/0/0/0/0!0/0/0/0/0/0', 'Auto', 0, 'Null', 0, 3, 2, 1, 0, 0),
(74, 3, 6, '1/0/3/1/1/4', '3/1/2/0/2/2', '0/0/0/0/0/0!0/0/0/0/0/0!0/0/0/0/0/7!0/0/0/0/0/0!0/0/0/0/0/0!0/0/0/0/0/7', 'Auto', 0, 'Null', 0, 3, 2, 1, 0, 0),
(75, 3, 6, '3/1/3/2/0/1', '3/0/2/2/0/3', '0/0/0/0/0/0!0/0/0/0/0/0!5/0/0/0/0/0!0/0/0/0/0/0!0/0/0/0/0/0!0/0/0/2/0/0', 'Auto', 0, 'Null', 0, 3, 2, 1, 0, 0),
(76, 1, 8, '2/2/1/3/2/2/4/3', '1/4/0/5/0/3/3/3', '0/0/0/0/0/0/5/0!0/0/0/0/0/0/4/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/7!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/5/0/0!0/0/0/0/0/0/0/4', 'Auto', 0, 'Null', 0, 3, 3, 2, 1, 0),
(77, 1, 8, '1/5/0/3/4/3/2/1', '5/0/2/3/1/3/1/4', '0/0/0/0/0/0/0/0!0/0/0/0/0/0/6/0!0/0/0/0/0/0/0/0!0/0/0/0/0/5/0/0!3/0/0/0/0/0/0/0!3/0/0/0/0/4/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0', 'Auto', 0, 'Null', 0, 3, 3, 2, 1, 0),
(78, 1, 8, '5/0/3/2/1/4/2/2', '3/1/4/2/0/4/1/4', '0/0/0/0/0/0/0/7!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/2!0/0/0/0/0/0/0/0!5/0/0/0/0/4/0/5!0/0/0/0/0/0/0/0!4/0/0/0/0/0/0/0', 'Auto', 0, 'Null', 0, 3, 3, 2, 1, 0),
(79, 2, 8, '5/0/5/1/3/2/2/1', '5/1/3/1/4/0/3/2', '0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/3/0/0/0/0/6/0!0/0/0/0/5/0/0/0!0/0/2/0/3/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0', 'Auto', 0, 'Null', 0, 3, 3, 2, 1, 0),
(80, 2, 8, '2/3/2/2/3/0/2/5', '1/3/1/4/2/2/1/5', '0/2/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/2/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/5/0/0/0!6/3/0/0/0/0/0/0', 'Auto', 0, 'Null', 0, 3, 3, 2, 1, 0),
(82, 2, 8, '4/1/2/1/5/1/4/1', '3/4/2/2/1/3/2/2', '0/7/0/0/0/0/0/0!0/0/0/0/0/0/4/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!6/3/0/7/0/0/0/0!0/0/0/0/0/0/0/0', 'Auto', 0, 'Null', 0, 3, 3, 2, 1, 0),
(84, 3, 8, '5/0/1/2/5/0/2/4', '5/1/1/2/3/3/2/2', '0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/6/3/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/3/7', 'Auto', 0, 'Null', 0, 3, 3, 2, 1, 0),
(85, 3, 8, '1/4/1/2/2/3/3/3', '6/0/0/4/0/5/1/3', '0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/7!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/5!0/0/0/0/0/0/0/0!0/0/0/4/0/0/0/0', 'Auto', 0, 'Null', 0, 3, 3, 2, 1, 0),
(87, 3, 8, '1/4/1/3/1/4/0/5', '4/2/2/1/3/1/1/5', '0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/3/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/6/0/0/0/6/0/7', 'Auto', 0, 'Null', 0, 3, 3, 2, 1, 0),
(96, 3, 10, '1/1/2/4/0/4/1/4/2/1', '1/1/4/1/3/2/2/3/3/0', '0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/6/0/7/0!0/0/0/0/0/0/0/0/0/0!0/0/3/0/0/0/0/7/0/0!0/0/4/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0', 'Auto', 0, 'Null', 0, 4, 3, 2, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `mapsplayed`
--

CREATE TABLE `mapsplayed` (
  `MapId` int(11) NOT NULL,
  `PlayerId` int(11) NOT NULL,
  `BestTime` int(11) NOT NULL,
  `PlayedTimes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `mapsplayed`
--

INSERT INTO `mapsplayed` (`MapId`, `PlayerId`, `BestTime`, `PlayedTimes`) VALUES
(66, 7, 27, 2),
(75, 7, 317, 3),
(79, 5, 84, 2),
(75, 5, 192, 2),
(78, 5, 46, 1),
(70, 6, 32, 3),
(87, 6, 254, 3),
(80, 8, 79, 3),
(78, 8, 61, 2),
(74, 8, 317, 2),
(76, 9, 39, 5),
(82, 10, 57, 3),
(74, 10, 227, 2),
(73, 2, 485, 1),
(87, 2, 518, 1),
(84, 2, 432, 1),
(80, 2, 226, 1),
(72, 2, 256, 1);

-- --------------------------------------------------------

--
-- Structure de la table `statistics`
--

CREATE TABLE `statistics` (
  `NumberOfMaps` int(11) NOT NULL,
  `NumberOfPlayers` int(11) NOT NULL,
  `NumberOfPlayedGames` int(11) NOT NULL,
  `TotalTimePlayed` int(11) NOT NULL,
  `NumberGamesWon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `statistics`
--

INSERT INTO `statistics` (`NumberOfMaps`, `NumberOfPlayers`, `NumberOfPlayedGames`, `TotalTimePlayed`, `NumberGamesWon`) VALUES
(19, 7, 52, 5417, 36),
(19, 7, 52, 5417, 36);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Username` char(64) NOT NULL,
  `Email` char(64) NOT NULL,
  `Password` char(64) NOT NULL,
  `GamesWon` int(11) DEFAULT '0',
  `Admin` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`Id`, `Username`, `Email`, `Password`, `GamesWon`, `Admin`) VALUES
(2, 'admin', 'admin@admin.com', 'admin', 5, 1),
(5, 'Erwann', 'erwann@mail.com', 'Erwann', 5, 0),
(6, 'Esther', 'Esther@mail.com', 'Esther', 6, 0),
(7, 'Faustine', 'Faustine@mail.com', 'Faustine', 3, 0),
(8, 'Simon', 'simon@mail.com', 'Simon', 7, 0),
(9, 'Yazid', 'yazid@mail.com', 'Yazid', 5, 0),
(10, 'Paul', 'paul@mail.com', 'Paul', 5, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `maps`
--
ALTER TABLE `maps`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `maps`
--
ALTER TABLE `maps`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
