-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 03 fév. 2025 à 00:15
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
  `DateOpen` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `problems`
--

INSERT INTO `problems` (`id`, `name`, `photo`, `points`, `IsCompleted`, `IsOpen`, `Duration`, `DateOpen`) VALUES
(6, 'test1', 'b23cc50b0dc5644c44b59caf2b93de4e.jpg', 10, 0, 0, 10, '2025-02-02 22:19:00'),
(7, 'test2', '8a56dda450bd37f9c39671b444749294.jpg', 30, 0, 0, 2, '2025-02-02 18:18:23'),
(8, 'test3', '8d3cc1b0798e20cdc90d8b6c5e2b1b77.png', 45, 0, 1, 50, '2025-02-02 22:19:00');

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
  `pathFile` varchar(255) NOT NULL,
  `date_submission` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `team_problems`
--

INSERT INTO `team_problems` (`id`, `idProblems`, `IdTeam`, `Score`, `pathFile`, `date_submission`) VALUES
(5, 6, 1, 9, 'index.html', '2025-02-02 18:19:10'),
(6, 6, 2, 11, 'index.html', '2025-02-02 18:19:29'),
(7, 6, 5, 0, 'index.html', '2025-02-02 18:19:47'),
(8, 7, 5, 0, 'index.html', '2025-02-02 18:20:02'),
(9, 8, 5, 0, 'index.html', '2025-02-02 18:20:16'),
(10, 7, 2, 0, 'index.html', '2025-02-02 18:20:31');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `team_problems`
--
ALTER TABLE `team_problems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
