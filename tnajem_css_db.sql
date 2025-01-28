-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 28 jan. 2025 à 21:22
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tnajem_css_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `problems`
--

CREATE TABLE `problems` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `IsCompleted` tinyint(4) NOT NULL,
  `IsOpen` tinyint(4) NOT NULL,
  `Duration` int(11) NOT NULL,
  `DateOpen` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `IsAdmin` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `teams`
--

INSERT INTO `teams` (`id`, `nom`, `password`, `IsAdmin`) VALUES
(1, 'qsdqsd', '$2y$10$2XulXBPFBlOSXFsd2jGi9Orm7kXaq.9w/r7IcVZ9mnP7DrfpqExFq', 0),
(2, 'qsdqsd', '$2y$10$VDNMZQSBkzBTzEGTUP1aOOeDSp/zTg8Z0d6b8IbB8vqkbuuWQUg36', 0),
(3, 'qsdqsd', '$2y$10$SLwGd.M2p07abDM54knuIectDpvxnOex13st9hzJ9mQxGa141gX/u', 0),
(4, 'nader', '$2y$10$KGtDTs65aT6RXrH.EVDaR.pZj9bqBULCzpqRBezz6SApbf9rYLAiO', 1),
(5, 'talel', '$2y$10$CV7nOLJinSwoxuTUwC4T8uO95dYk7vErTF411ec9G/eTGANYya2Na', 0);

-- --------------------------------------------------------

--
-- Structure de la table `team_problems`
--

CREATE TABLE `team_problems` (
  `id` int(11) NOT NULL,
  `idProblems` int(11) NOT NULL,
  `IdTeam` int(11) NOT NULL,
  `Score` int(11) NOT NULL,
  `pathFile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `team_problems`
--
ALTER TABLE `team_problems`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `team` (`IdTeam`),
  ADD KEY `problem` (`idProblems`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `problems`
--
ALTER TABLE `problems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `team_problems`
--
ALTER TABLE `team_problems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `team_problems`
--
ALTER TABLE `team_problems`
  ADD CONSTRAINT `problem` FOREIGN KEY (`idProblems`) REFERENCES `problems` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `team` FOREIGN KEY (`IdTeam`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
