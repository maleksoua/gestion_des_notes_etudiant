-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 19, 2023 at 04:59 PM
-- Server version: 8.0.33-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `miniprojet`
--

-- --------------------------------------------------------

--
-- Table structure for table `assister`
--

CREATE TABLE `assister` (
  `id_etudiant` int NOT NULL,
  `id_cours` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `assister`
--

INSERT INTO `assister` (`id_etudiant`, `id_cours`) VALUES
(9, 4),
(9, 5),
(9, 7),
(9, 15),
(9, 16),
(11, 4),
(25, 19),
(25, 20);

-- --------------------------------------------------------

--
-- Table structure for table `cours`
--

CREATE TABLE `cours` (
  `id_cours` int NOT NULL,
  `nom_cours` varchar(100) DEFAULT NULL,
  `id_utilisateur` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cours`
--

INSERT INTO `cours` (`id_cours`, `nom_cours`, `id_utilisateur`) VALUES
(4, 'JAVA', 5),
(5, 'PHP', 5),
(7, 'IoT', 10),
(15, 'PYTHON', 5),
(16, 'Intelligence Artificielle', 16),
(18, 'Maths', 12),
(19, 'php3', 24),
(20, 'php2', 24);

-- --------------------------------------------------------

--
-- Table structure for table `examen`
--

CREATE TABLE `examen` (
  `id_etudiant` int NOT NULL,
  `id_cours` int NOT NULL,
  `note` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `examen`
--

INSERT INTO `examen` (`id_etudiant`, `id_cours`, `note`) VALUES
(9, 4, 18),
(11, 4, 13),
(9, 15, 19),
(9, 16, 10),
(25, 19, 12);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mot_de_passe` varchar(100) DEFAULT NULL,
  `Role` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom`, `prenom`, `email`, `mot_de_passe`, `Role`) VALUES
(5, 'enseig1', 'ens1', 'ens1@gmail.com', 'ens1', 1),
(9, 'soua', 'Malek', 'malek@gmail.com', '0000', 2),
(10, 'enseig2', 'enseignant2', 'ens2@gmail.com', 'ens2', 1),
(11, 'etudiant1', 'etud1', 'etud1@gmail.com', 'etud1', 2),
(12, 'oussama', 'zorrig', 'oussamazorrig@yahoo.com', 'oussama', 0),
(15, 'admin1', 'adm1', 'adm1@gmail.com', 'adm1', 0),
(16, 'enseig3', 'ens3', 'ens3@gmail.com', 'ens3', 1),
(24, 'testens1', 'testens1', 'testens1@gmail.com', 'testens1', 1),
(25, 'testetud1', 'testetud1', 'testetud1@gmail.com', 'testetud1', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assister`
--
ALTER TABLE `assister`
  ADD PRIMARY KEY (`id_cours`,`id_etudiant`),
  ADD KEY `fk_user` (`id_etudiant`);

--
-- Indexes for table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id_cours`),
  ADD KEY `fk_Enseignant` (`id_utilisateur`);

--
-- Indexes for table `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`id_cours`,`id_etudiant`),
  ADD KEY `fk_utilsateur` (`id_etudiant`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cours`
--
ALTER TABLE `cours`
  MODIFY `id_cours` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assister`
--
ALTER TABLE `assister`
  ADD CONSTRAINT `fk_cours` FOREIGN KEY (`id_cours`) REFERENCES `cours` (`id_cours`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`id_etudiant`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE;

--
-- Constraints for table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `fk_Enseignant` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE;

--
-- Constraints for table `examen`
--
ALTER TABLE `examen`
  ADD CONSTRAINT `fk_Course` FOREIGN KEY (`id_cours`) REFERENCES `cours` (`id_cours`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_utilsateur` FOREIGN KEY (`id_etudiant`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
