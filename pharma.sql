CREATE DATABASE IF NOT EXISTS pharma;
USE pharma;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Structure de la table `pharmacie`
--

CREATE TABLE `pharmacie` (
 `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
 `nom` varchar(255) NOT NULL,
 `email` varchar(255) NOT NULL,
 `pass` varchar(255) NOT NULL,
 `departement` int NOT NULL,
 `adresse` tinyint(1) NOT NULL
);

--
-- Structure de la table `questionnaire`
--
CREATE TABLE `questionnaire` (
 `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
 `id_pharma` int NOT NULL,
 `date` date NOT NULL,
 `age` int(3) NOT NULL,
 `sexe` tinyint(1) NOT NULL,
 `reponse_Q1` tinyint(1) NOT NULL,
 `reponse_Q2` tinyint(1) NOT NULL,
 `reponse_Q3` tinyint(1) NOT NULL,
 `reponse_Q4` tinyint(1) NOT NULL
);

-- --------------------------------------------------------
--
-- Index pour la table `questionnaire`
--
ALTER TABLE `questionnaire`
  ADD KEY `FK_id_pharma` (`id_pharma`);


-- --------------------------------------------------------
--
-- Contraintes pour la table `like`
--
ALTER TABLE `questionnaire`
  ADD CONSTRAINT `FK_id_pharma` FOREIGN KEY (`id_pharma`) REFERENCES `pharmacie` (`id`) ON DELETE CASCADE;