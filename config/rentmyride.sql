-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 09 juin 2026 à 10:27
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
-- Base de données : `rentmyride`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `Id_categories` int(11) NOT NULL,
  `nom_categorie` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`Id_categories`, `nom_categorie`) VALUES
(1, 'SUV'),
(2, 'Berline'),
(3, 'Citadine'),
(4, 'Sport'),
(5, 'Utilitaire');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `Id_reservations` int(11) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `statut` varchar(30) DEFAULT NULL,
  `Id_vehicules` int(11) NOT NULL,
  `Id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`Id_reservations`, `date_debut`, `date_fin`, `statut`, `Id_vehicules`, `Id_users`) VALUES
(1, '2025-06-10', '2025-06-15', 'confirmée', 1, 1),
(2, '2025-06-12', '2025-06-18', 'en attente', 2, 2),
(3, '2025-06-15', '2025-06-20', 'confirmée', 3, 3),
(4, '2025-06-20', '2025-06-25', 'annulée', 4, 4),
(5, '2025-06-22', '2025-06-28', 'confirmée', 5, 5),
(6, '2025-06-25', '2025-06-30', 'en attente', 6, 1),
(7, '2025-07-01', '2025-07-05', 'confirmée', 7, 2),
(8, '2025-07-03', '2025-07-10', 'en attente', 8, 3),
(9, '2025-07-05', '2025-07-12', 'confirmée', 9, 4),
(10, '2025-07-08', '2025-07-15', 'confirmée', 10, 5);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `Id_users` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` char(12) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `role` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`Id_users`, `nom`, `prenom`, `email`, `telephone`, `mot_de_passe`, `role`) VALUES
(1, 'Dupont', 'Jean', 'jean.dupont@mail.com', '0612345678', 'password123', 0),
(2, 'Martin', 'Sophie', 'sophie.martin@mail.com', '0623456789', 'password123', 0),
(3, 'Bernard', 'Lucas', 'lucas.bernard@mail.com', '0634567890', 'password123', 0),
(4, 'Lefevre', 'Emma', 'emma.lefevre@mail.com', '0645678901', 'password123', 0),
(5, 'Moreau', 'Hugo', 'hugo.moreau@mail.com', '0656789012', 'password123', 0),
(6, 'Admin', 'Root', 'admin@rentmyride.com', '0600000000', 'admin123', 1);

-- --------------------------------------------------------

--
-- Structure de la table `vehicules`
--

CREATE TABLE `vehicules` (
  `Id_vehicules` int(11) NOT NULL,
  `marque` varchar(50) DEFAULT NULL,
  `model` varchar(100) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prix` decimal(5,2) DEFAULT NULL,
  `disponibilite` tinyint(1) DEFAULT NULL,
  `Id_categories` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `vehicules`
--

INSERT INTO `vehicules` (`Id_vehicules`, `marque`, `model`, `description`, `nom`, `prix`, `disponibilite`, `Id_categories`) VALUES
(1, 'BMW', 'X5', 'SUV premium puissant et confortable pour longs trajets.', 'BMW X5', 120.00, 1, 1),
(2, 'Audi', 'Q7', 'SUV spacieux avec finitions haut de gamme.', 'Audi Q7', 130.00, 1, 1),
(3, 'Mercedes', 'Classe E', 'Berline élégante et très confortable.', 'Mercedes Classe E', 95.00, 1, 2),
(4, 'Tesla', 'Model S', 'Berline électrique performante et innovante.', 'Tesla Model S', 150.00, 1, 2),
(5, 'Renault', 'Clio V', 'Citadine économique idéale pour la ville.', 'Renault Clio V', 45.00, 1, 3),
(6, 'Peugeot', '208', 'Petite voiture pratique et facile à conduire.', 'Peugeot 208', 50.00, 1, 3),
(7, 'Porsche', '911 Carrera', 'Voiture sport emblématique très performante.', 'Porsche 911', 250.00, 1, 4),
(8, 'BMW', 'M4', 'Coupé sportif puissant et précis.', 'BMW M4', 220.00, 1, 4),
(9, 'Renault', 'Kangoo', 'Utilitaire pratique pour transport et travail.', 'Renault Kangoo', 60.00, 1, 5),
(10, 'Ford', 'Transit', 'Fourgon utilitaire grand volume.', 'Ford Transit', 80.00, 1, 5);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`Id_categories`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`Id_reservations`),
  ADD KEY `Id_vehicules` (`Id_vehicules`),
  ADD KEY `Id_users` (`Id_users`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id_users`);

--
-- Index pour la table `vehicules`
--
ALTER TABLE `vehicules`
  ADD PRIMARY KEY (`Id_vehicules`),
  ADD KEY `Id_categories` (`Id_categories`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `Id_categories` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `Id_reservations` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `Id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `vehicules`
--
ALTER TABLE `vehicules`
  MODIFY `Id_vehicules` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`Id_vehicules`) REFERENCES `vehicules` (`Id_vehicules`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`Id_users`) REFERENCES `users` (`Id_users`);

--
-- Contraintes pour la table `vehicules`
--
ALTER TABLE `vehicules`
  ADD CONSTRAINT `vehicules_ibfk_1` FOREIGN KEY (`Id_categories`) REFERENCES `categories` (`Id_categories`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
