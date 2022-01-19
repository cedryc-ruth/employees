-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 19 jan. 2022 à 22:12
-- Version du serveur : 10.4.19-MariaDB
-- Version de PHP : 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `employees_exam`
--

-- --------------------------------------------------------

--
-- Structure de la table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `registration_number` varchar(9) NOT NULL,
  `model` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cars`
--

INSERT INTO `cars` (`id`, `registration_number`, `model`) VALUES
(1, '1-ABC-123', 'Opel'),
(2, '1-DEF-456', 'Toyota'),
(5, '1-XYZ-789', 'Citroën');

-- --------------------------------------------------------

--
-- Structure de la table `car_emp`
--

CREATE TABLE `car_emp` (
  `id` int(11) NOT NULL,
  `emp_no` int(11) DEFAULT NULL,
  `car_id` int(11) NOT NULL,
  `receipt_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `car_emp`
--

INSERT INTO `car_emp` (`id`, `emp_no`, `car_id`, `receipt_date`) VALUES
(1, 10001, 1, '2020-10-26'),
(2, 10003, 5, '2021-02-28'),
(5, 110039, 2, '2021-03-13');

-- --------------------------------------------------------

--
-- Structure de la table `employees`
--

ALTER TABLE `employees` ADD `email` varchar(255) DEFAULT NULL AFTER `last_name`;
ALTER TABLE `employees` ADD `password` varchar(255) DEFAULT NULL AFTER `email`;

--
-- Déchargement des données de la table `employees`
--
UPDATE `employees` SET `email` = 'georgi@sull.com' WHERE `employees`.`emp_no` = 10001;
UPDATE `employees` SET `password` = '$2y$10$hctFwMrx5G3gDrWevcwaxeRZEBBSoLgPPt.E/3KKxl9fAWORpsU.W' WHERE `employees`.`emp_no` = 10001;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `car_emp`
--
ALTER TABLE `car_emp`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `car_id_2` (`car_id`),
  ADD UNIQUE KEY `emp_no_2` (`emp_no`),
  ADD KEY `emp_no` (`emp_no`),
  ADD KEY `car_id` (`car_id`);

--
-- Index pour la table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`emp_no`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `car_emp`
--
ALTER TABLE `car_emp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `car_emp`
--
ALTER TABLE `car_emp`
  ADD CONSTRAINT `car_emp_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `car_emp_ibfk_2` FOREIGN KEY (`emp_no`) REFERENCES `employees` (`emp_no`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
