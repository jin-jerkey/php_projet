-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2024 at 11:58 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `campus_school`
--

-- --------------------------------------------------------

--
-- Table structure for table `appel`
--

CREATE TABLE `appel` (
  `id` int(11) NOT NULL,
  `matricul` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `heure` time(6) NOT NULL,
  `periode` int(255) NOT NULL,
  `filiere` varchar(255) NOT NULL,
  `niveau` int(255) NOT NULL,
  `matiere` varchar(255) NOT NULL,
  `professeur` varchar(255) NOT NULL,
  `m_eleve` varchar(255) NOT NULL,
  `nom_eleve` varchar(255) NOT NULL,
  `etat` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cahier_appel`
--

CREATE TABLE `cahier_appel` (
  `id` int(11) NOT NULL,
  `matricul` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `heure` time(6) NOT NULL,
  `periode` int(255) NOT NULL,
  `filiere` varchar(255) NOT NULL,
  `niveau` int(255) NOT NULL,
  `matiere` varchar(255) NOT NULL,
  `professeur` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classe`
--

CREATE TABLE `classe` (
  `id_classe` varchar(25) NOT NULL,
  `libele_classe` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cours`
--

CREATE TABLE `cours` (
  `id_cours` varchar(25) NOT NULL,
  `libele_cous` varchar(255) DEFAULT NULL,
  `dure` varchar(3) DEFAULT NULL,
  `matricule` varchar(10) DEFAULT NULL,
  `id_matiere` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enseignant`
--

CREATE TABLE `enseignant` (
  `id` int(11) NOT NULL,
  `matricul` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `date_nais` date NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `bureau` varchar(255) NOT NULL,
  `departement` varchar(255) NOT NULL,
  `discipline` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enseignant`
--

INSERT INTO `enseignant` (`id`, `matricul`, `nom`, `prenom`, `date_nais`, `telephone`, `email`, `bureau`, `departement`, `discipline`, `image`) VALUES
(1, 'UNcx5rIME', 'jin', 'nij', '2024-06-26', '670452336', 'jin@gmail.com', 'GL', '4', 'GL', 'uploads/bam.png');

-- --------------------------------------------------------

--
-- Table structure for table `etudiant`
--

CREATE TABLE `etudiant` (
  `matricule` varchar(10) NOT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `Prenom` varchar(255) DEFAULT NULL,
  `dateofbirth` date DEFAULT NULL,
  `telephone` varchar(9) DEFAULT NULL,
  `filiere` varchar(20) DEFAULT NULL,
  `niveau` varchar(1) DEFAULT NULL,
  `id_qr` varchar(255) NOT NULL,
  `profil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `etudiant`
--

INSERT INTO `etudiant` (`matricule`, `Nom`, `Prenom`, `dateofbirth`, `telephone`, `filiere`, `niveau`, `id_qr`, `profil`) VALUES
('UN0qihIME', 'steve', 'babana', '2024-06-24', '658899885', 'GL', '4', 'http://localhost/qrcodes/UN0qihIME.png', 'Screenshot 2024-06-18 151132.png'),
('UN3ubkIME', 'baba', 'bobo', '2024-06-25', '654785965', 'GL', '2', '212', NULL),
('UN4up9IME', 'mama', 'uhb', '2024-06-22', '547865644', 'GL', '3', 'http://localhost/qrcodes/UN4up9IME.png', NULL),
('UN71dxIME', 'juna', 'mike', '2024-06-25', '656588995', 'GL', '4', 'http://localhost/qrcodes/UN71dxIME.png', 'uploads/'),
('UNnzioIME', 'ghgh', 'ghgh', '2024-06-12', 'ghgh', 'GL', '3', 'hghgh', NULL),
('UNqgo2IME', 'bebvr', 'dfd', '2024-06-12', '587459', 'GL', '3', 'ghh', NULL),
('UNr6g9IME', 'sdsd', 'sdsd', '2024-06-26', '5454', 'GL', '2', 'http://localhost/qrcodes/UNr6g9IME.png', 'uploads/'),
('UNw7g9IME', 'jinna', 'boumma', '2024-06-26', '658955441', 'GL', '2', 'http://localhost/qrcodes/UNw7g9IME.png', 'uploads/IMG_19720119_152146.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `matiere`
--

CREATE TABLE `matiere` (
  `id_matiere` varchar(25) NOT NULL,
  `libele_matiere` varchar(255) DEFAULT NULL,
  `id_classe` varchar(25) DEFAULT NULL,
  `matricule_Professeur` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `professseur`
--

CREATE TABLE `professseur` (
  `matricule_Professeur` varchar(10) NOT NULL,
  `Nom_prof` varchar(255) DEFAULT NULL,
  `Prenom_prof` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` varchar(10) NOT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `Prenom` varchar(255) DEFAULT NULL,
  `dateofbirth` date DEFAULT NULL,
  `telephone` varchar(9) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mot_de_passe` varchar(1000) DEFAULT NULL,
  `acreditation` int(11) NOT NULL,
  `profil` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `Nom`, `Prenom`, `dateofbirth`, `telephone`, `email`, `mot_de_passe`, `acreditation`, `profil`) VALUES
('2', 'jin', 'jino', '2024-06-01', '654455887', 'jin@gmail.com', '$2y$10$7D0RsgxqnLYDXTg349RwVOat3lo92uHC30kT/d3zvT1VkLhpDxVRy', 123456, ''),
('ime00001', 'Talefo', 'Armand', '1990-01-13', '683655980', 'talefoarmand@imeschool.com', '$2y$10$OwvTonRnIz1AodnDh9Su/.kNBJ8aNUKJfnUr8QxMaP67d7hPxKxPC', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appel`
--
ALTER TABLE `appel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cahier_appel`
--
ALTER TABLE `cahier_appel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id_classe`);

--
-- Indexes for table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id_cours`),
  ADD KEY `matricule` (`matricule`),
  ADD KEY `id_matiere` (`id_matiere`);

--
-- Indexes for table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`matricule`);

--
-- Indexes for table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`id_matiere`),
  ADD KEY `id_classe` (`id_classe`),
  ADD KEY `matricule_Professeur` (`matricule_Professeur`),
  ADD KEY `matricule_Professeur_2` (`matricule_Professeur`);

--
-- Indexes for table `professseur`
--
ALTER TABLE `professseur`
  ADD PRIMARY KEY (`matricule_Professeur`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appel`
--
ALTER TABLE `appel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cahier_appel`
--
ALTER TABLE `cahier_appel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `cours_ibfk_1` FOREIGN KEY (`matricule`) REFERENCES `etudiant` (`matricule`),
  ADD CONSTRAINT `cours_ibfk_2` FOREIGN KEY (`id_matiere`) REFERENCES `matiere` (`id_matiere`);

--
-- Constraints for table `matiere`
--
ALTER TABLE `matiere`
  ADD CONSTRAINT `matiere_ibfk_1` FOREIGN KEY (`id_classe`) REFERENCES `classe` (`id_classe`),
  ADD CONSTRAINT `matiere_ibfk_2` FOREIGN KEY (`matricule_Professeur`) REFERENCES `professseur` (`matricule_Professeur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
