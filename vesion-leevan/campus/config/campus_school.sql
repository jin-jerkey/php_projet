-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2024 at 08:50 PM
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

--
-- Dumping data for table `appel`
--

INSERT INTO `appel` (`id`, `matricul`, `date`, `heure`, `periode`, `filiere`, `niveau`, `matiere`, `professeur`, `m_eleve`, `nom_eleve`, `etat`) VALUES
(12, 'UN5r7fIME', '2024-07-12', '16:00:30.000000', 1, 'GL', 1, 'Mathématiques', 'John Doe', 'UN5r7fIME', 'atangana', 1),
(13, 'UN5r7fIME', '2024-07-12', '18:00:47.000000', 1, 'GL', 1, 'Mathématiques', 'John Doe', 'UN5r7fIME', 'atangana', 1),
(14, 'UN8zluIME', '2024-07-15', '17:22:21.000000', 1, 'GL', 2, 'Mathématiques', 'John Doe', 'UN8zluIME', 'youm', 1);

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

--
-- Dumping data for table `cahier_appel`
--

INSERT INTO `cahier_appel` (`id`, `matricul`, `date`, `heure`, `periode`, `filiere`, `niveau`, `matiere`, `professeur`) VALUES
(2, 'CAsnwwAPP', '2024-07-12', '15:25:00.000000', 3, 'GL', 1, 'math', 'ebenezer'),
(3, 'CAjhmlAPP', '2024-07-12', '17:26:00.000000', 1, 'GL', 2, 'math', 'massoko'),
(4, 'CAi3ctAPP', '2024-07-12', '18:26:00.000000', 2, 'GL', 3, 'math', 'oum'),
(5, 'CAdjtpAPP', '2024-07-12', '18:27:00.000000', 2, 'GL', 4, 'math', 'nana'),
(6, 'CAwqmyAPP', '2024-07-12', '17:29:00.000000', 2, 'GL', 5, 'math', 'zataho');

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
(3, 'UN3cxjIME', 'ebenezer', 'mitoumba', '2024-08-10', '65478451', 'ebenezermitoumba@gmail.com', 'GL', '1', 'GL', 'uploads/04.jpg'),
(4, 'UNw2voIME', 'massoko', 'paul', '2024-08-09', '652123547', 'massoko@gmail.com', 'GL', '2', 'GL', 'uploads/03.jpg'),
(5, 'UNsnp7IME', 'oum', 'tolo', '2024-07-31', '687954123', 'oum@gmail.com', 'GL', '4', 'GL', 'uploads/03.jpg'),
(6, 'UNwwmsIME', 'nana', 'pele', '2024-07-28', '632125478', 'nanapele@gmail.com', 'GL', '4', 'GL', 'uploads/04.jpg'),
(7, 'UN94m9IME', 'zataho', 'ota', '2024-07-30', '987456321', 'zataho@gmail.com', 'GL', '5', 'GL', 'uploads/05.jpg'),
(8, 'UNcomqIME', 'boum', 'fdf', '2024-07-15', '64564454', 'ajuiy@gmail.com', '1er', 'informatique', 'Programmation en C', 'uploads/04.jpg');

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
('UN405mIME', 'youmbi', 'anabelle', '2024-07-24', '69874521', 'GL', '5', 'qrcodes/UN405mIME.png', 'uploads/01.jpg'),
('UN40coIME', 'tasse', 'ketsia', '2024-07-19', '632145897', 'GL', '3', 'qrcodes/UN40coIME.png', 'uploads/12.jpg'),
('UN5r7fIME', 'atangana', 'jean', '2024-07-25', '654545454', 'GL', '1', 'qrcodes/UN5r7fIME.png', 'uploads/05.jpg'),
('UN6ifeIME', 'mouna', 'sandra', '2024-08-07', '658963214', 'GL', '3', 'qrcodes/UN6ifeIME.png', 'uploads/13.jpg'),
('UN7kmqIME', 'ngo', 'irene', '2024-08-10', '698745251', 'GL', '4', 'qrcodes/UN7kmqIME.png', 'uploads/19.jpg'),
('UN7mppIME', 'moutema', 'kelly', '2024-07-26', '632145895', 'GL', '4', 'qrcodes/UN7mppIME.png', 'uploads/17.jpg'),
('UN87plIME', 'owona', 'pierre', '2024-08-08', '654789541', 'GL', '5', 'qrcodes/UN87plIME.png', 'uploads/23.jpg'),
('UN8zluIME', 'youm', 'christine', '2024-08-08', '698785412', 'GL', '2', 'qrcodes/UN8zluIME.png', 'uploads/07.jpg'),
('UN932uIME', 'zeufack', 'lesticia', '2024-07-25', '623547895', 'GL', '5', 'qrcodes/UN932uIME.png', 'uploads/21.jpg'),
('UNavusIME', 'fuanou', 'raissa', '2024-07-09', '658963215', 'GL', '1', 'qrcodes/UNavusIME.png', 'uploads/03.jpg'),
('UNbd1kIME', 'asem', 'yasmine', '2024-08-11', '632322145', 'GL', '2', 'qrcodes/UNbd1kIME.png', 'uploads/10.jpg'),
('UNbrpsIME', 'rafah', 'adjo', '2024-07-24', '612457896', 'GL', '4', 'qrcodes/UNbrpsIME.png', 'uploads/16.jpg'),
('UNe3ynIME', 'ebele', 'jenner', '2024-07-24', '65478952', 'GL', '5', 'qrcodes/UNe3ynIME.png', 'uploads/25.jpg'),
('UNekcqIME', 'loguouen', 'paul', '2024-07-17', '687895414', 'GL', '1', 'qrcodes/UNekcqIME.png', 'uploads/02.jpg'),
('UNfi0qIME', 'dogmo', 'anastasi', '2024-07-12', '689541254', 'GL', '3', 'qrcodes/UNfi0qIME.png', 'uploads/11.jpg'),
('UNjvhzIME', 'tcham', 'jeny', '2024-07-02', '658789654', 'GL', '1', 'qrcodes/UNjvhzIME.png', 'uploads/01.jpg'),
('UNk4diIME', 'mbah', 'ines', '2016-06-16', '698745213', 'GL', '3', 'qrcodes/UNk4diIME.png', 'uploads/14.jpg'),
('UNkf44IME', 'nana', 'poline', '2024-07-08', '632548789', 'GL', '2', 'qrcodes/UNkf44IME.png', 'uploads/06.jpg'),
('UNkjz8IME', 'mayi', 'francoise', '2024-08-02', '632145789', 'GL', '4', 'qrcodes/UNkjz8IME.png', 'uploads/20.jpg'),
('UNlxoqIME', 'mbum', 'george', '2024-07-01', '698785441', 'GL', '1', 'qrcodes/UNlxoqIME.png', 'uploads/04.jpg'),
('UNo0rgIME', 'nala', 'syndine', '2024-08-11', '632145897', 'GL', '4', 'qrcodes/UNo0rgIME.png', 'uploads/18.jpg'),
('UNqco3IME', 'nanfack', 'carine', '2024-07-30', '652124578', 'GL', '2', 'qrcodes/UNqco3IME.png', 'uploads/09.jpg'),
('UNt7lcIME', 'hayou', 'haissatou', '2024-07-24', '32145697', 'GL', '4', 'qrcodes/UNt7lcIME.png', 'uploads/24.jpg'),
('UNujrsIME', 'oumi', 'sadey', '2024-08-08', '632547895', 'GL', '3', 'qrcodes/UNujrsIME.png', 'uploads/15.jpg'),
('UNyz7fIME', 'abena', 'berthe', '2024-07-16', '654789652', 'GL', '2', 'qrcodes/UNyz7fIME.png', 'uploads/08.jpg');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cahier_appel`
--
ALTER TABLE `cahier_appel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
