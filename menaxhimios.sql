-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2021 at 07:37 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `menaxhimios`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `emer_adm` varchar(15) NOT NULL,
  `mbiemer_adm` varchar(15) NOT NULL,
  `email_adm` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `emer_adm`, `mbiemer_adm`, `email_adm`) VALUES
(1, 'Anxhela', 'Tafani', 'Anxhela.Tafani@fti.edu.al');

-- --------------------------------------------------------

--
-- Table structure for table `dege`
--

CREATE TABLE `dege` (
  `id_dege` int(11) NOT NULL,
  `emer_dege` varchar(50) NOT NULL,
  `cikel` varchar(10) NOT NULL,
  `dep_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dege`
--

INSERT INTO `dege` (`id_dege`, `emer_dege`, `cikel`, `dep_id`) VALUES
(1, 'Inxhinieri Informatike', 'Bachelor', 1);

-- --------------------------------------------------------

--
-- Table structure for table `departament`
--

CREATE TABLE `departament` (
  `id_dep` int(11) NOT NULL,
  `emer_dep` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departament`
--

INSERT INTO `departament` (`id_dep`, `emer_dep`) VALUES
(1, 'Departamenti i Inxhinierise Informatike');

-- --------------------------------------------------------

--
-- Table structure for table `dite`
--

CREATE TABLE `dite` (
  `id_dite` int(11) NOT NULL,
  `emer_dite` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dite`
--

INSERT INTO `dite` (`id_dite`, `emer_dite`) VALUES
(1, 'E Hene'),
(2, 'E Marte'),
(3, 'E Merkure'),
(4, 'E Enjte'),
(5, 'E Premte');

-- --------------------------------------------------------

--
-- Table structure for table `grup`
--

CREATE TABLE `grup` (
  `id_grup` int(11) NOT NULL,
  `emer_grup` varchar(20) NOT NULL,
  `viti` varchar(11) NOT NULL,
  `dege_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grup`
--

INSERT INTO `grup` (`id_grup`, `emer_grup`, `viti`, `dege_id`) VALUES
(2, 'A', 'I', 1),
(3, 'B', 'II', 1),
(4, 'B', 'III', 1),
(5, 'C', 'I', 1);

-- --------------------------------------------------------

--
-- Table structure for table `laborator`
--

CREATE TABLE `laborator` (
  `id_lab` int(11) NOT NULL,
  `dita` int(11) NOT NULL,
  `ora_fillimit` int(11) NOT NULL,
  `ora_mbarimit` int(11) NOT NULL,
  `grup_id` int(11) NOT NULL,
  `lende_id` int(11) NOT NULL,
  `pedagog_id` int(11) NOT NULL,
  `salle_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `leksion`
--

CREATE TABLE `leksion` (
  `id_leksion` int(11) NOT NULL,
  `dita` int(11) NOT NULL,
  `ora_fillimit` int(11) NOT NULL,
  `ora_mbarimit` int(11) NOT NULL,
  `lende_id` int(11) NOT NULL,
  `pedagog_id` int(11) NOT NULL,
  `salle_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leksion`
--

INSERT INTO `leksion` (`id_leksion`, `dita`, `ora_fillimit`, `ora_mbarimit`, `lende_id`, `pedagog_id`, `salle_id`) VALUES
(1, 1, 8, 11, 4, 6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `lende`
--

CREATE TABLE `lende` (
  `id_lende` int(11) NOT NULL,
  `emer_l` varchar(50) NOT NULL,
  `ore_leksion` int(11) NOT NULL,
  `ore_seminar` int(11) NOT NULL,
  `ore_lab` int(11) NOT NULL,
  `viti` varchar(11) NOT NULL,
  `dege_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lende`
--

INSERT INTO `lende` (`id_lende`, `emer_l`, `ore_leksion`, `ore_seminar`, `ore_lab`, `viti`, `dege_id`) VALUES
(1, 'Gjuhe e huaj 1', 36, 28, 0, 'I', 1),
(2, 'Analize Matematike 1', 36, 42, 0, 'I', 1),
(3, 'Fizike 1', 36, 21, 10, 'I', 1),
(4, 'Elementet e Informatikes', 36, 28, 10, 'I', 1),
(5, 'Algjeber dhe Gjeometri', 36, 42, 0, 'I', 1),
(6, 'Komunikim Inxhinerik', 30, 14, 0, 'I', 1),
(7, 'Analize numerike', 21, 14, 0, 'II', 1),
(8, 'Programimi i orientuar nga objekti', 42, 21, 10, 'II', 1),
(9, 'Teoria e sinjaleve', 42, 21, 10, 'II', 1),
(10, 'Arkitekture e kompjuterave', 42, 28, 10, 'II', 1),
(11, 'Automatizim', 36, 14, 10, 'II', 1),
(12, 'Elementet dhe teknologjite elektronike', 42, 21, 10, 'II', 1),
(13, 'Algoritem e programim i avancuar', 42, 21, 10, 'III', 1),
(14, 'Programim Web', 42, 21, 10, 'III', 1),
(15, 'Inxhinieri Softi', 42, 21, 10, 'III', 1),
(16, 'Sistemet Operative', 42, 21, 10, 'III', 1),
(17, 'Bazat e te dhenave', 42, 21, 10, 'III', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orari`
--

CREATE TABLE `orari` (
  `publikuar` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orari`
--

INSERT INTO `orari` (`publikuar`) VALUES
(b'1');

-- --------------------------------------------------------

--
-- Table structure for table `pedagog`
--

CREATE TABLE `pedagog` (
  `id_pedagog` int(11) NOT NULL,
  `emer_pdg` varchar(15) NOT NULL,
  `mbiemer_pdg` varchar(15) NOT NULL,
  `email_pdg` varchar(40) NOT NULL,
  `dep_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



--
-- Table structure for table `perdorues`
--

CREATE TABLE `perdorues` (
  `id_perdorues` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `fjalekalim` varchar(30) NOT NULL,
  `roli` varchar(10) NOT NULL,
  `email_p` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



--
-- Table structure for table `salle`
--

CREATE TABLE `salle` (
  `id_salle` int(11) NOT NULL,
  `numer` int(11) NOT NULL,
  `kapacitet` int(11) NOT NULL,
  `tipologji` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salle`
--

INSERT INTO `salle` (`id_salle`, `numer`, `kapacitet`, `tipologji`) VALUES
(1, 101, 25, 'laborator'),
(2, 102, 30, 'seminar'),
(3, 103, 30, 'seminar'),
(4, 104, 30, 'seminar'),
(5, 105, 150, 'leksion'),
(6, 106, 50, 'seminar'),
(7, 107, 30, 'seminar'),
(8, 108, 25, 'laborator'),
(9, 109, 50, 'seminar'),
(10, 201, 30, 'seminar'),
(11, 202, 30, 'seminar'),
(12, 203, 30, 'seminar'),
(13, 204, 30, 'seminar'),
(14, 205, 150, 'leksion'),
(15, 206, 50, 'seminar'),
(16, 207, 30, 'seminar'),
(17, 208, 25, 'laborator'),
(18, 209, 50, 'seminar'),
(19, 301, 25, 'laborator'),
(20, 302, 30, 'seminar'),
(21, 303, 30, 'seminar'),
(22, 304, 30, 'seminar'),
(23, 305, 150, 'leksion'),
(24, 306, 30, 'seminar'),
(25, 307, 30, 'seminar');

-- --------------------------------------------------------

--
-- Table structure for table `seminar`
--

CREATE TABLE `seminar` (
  `id_seminar` int(11) NOT NULL,
  `dita` int(11) NOT NULL,
  `ora_fillimit` int(11) NOT NULL,
  `ora_mbarimit` int(11) NOT NULL,
  `grup_id` int(11) NOT NULL,
  `lende_id` int(11) NOT NULL,
  `pedagog_id` int(11) NOT NULL,
  `salle_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id_student` int(11) NOT NULL,
  `emer_std` varchar(15) NOT NULL,
  `mbiemer_std` varchar(15) NOT NULL,
  `email_std` varchar(40) NOT NULL,
  `grup_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `dege`
--
ALTER TABLE `dege`
  ADD PRIMARY KEY (`id_dege`),
  ADD KEY `dep_id` (`dep_id`);

--
-- Indexes for table `departament`
--
ALTER TABLE `departament`
  ADD PRIMARY KEY (`id_dep`);

--
-- Indexes for table `dite`
--
ALTER TABLE `dite`
  ADD PRIMARY KEY (`id_dite`);

--
-- Indexes for table `grup`
--
ALTER TABLE `grup`
  ADD PRIMARY KEY (`id_grup`),
  ADD KEY `dege_id` (`dege_id`);

--
-- Indexes for table `laborator`
--
ALTER TABLE `laborator`
  ADD PRIMARY KEY (`id_lab`),
  ADD KEY `grup_id` (`grup_id`,`lende_id`,`pedagog_id`,`salle_id`),
  ADD KEY `pedagog_id` (`pedagog_id`),
  ADD KEY `lende_id` (`lende_id`),
  ADD KEY `salle_id` (`salle_id`);

--
-- Indexes for table `leksion`
--
ALTER TABLE `leksion`
  ADD PRIMARY KEY (`id_leksion`),
  ADD KEY `lende_id` (`lende_id`,`pedagog_id`,`salle_id`),
  ADD KEY `pedagog_id` (`pedagog_id`),
  ADD KEY `salle_id` (`salle_id`);

--
-- Indexes for table `lende`
--
ALTER TABLE `lende`
  ADD PRIMARY KEY (`id_lende`),
  ADD KEY `dege_id` (`dege_id`);

--
-- Indexes for table `pedagog`
--
ALTER TABLE `pedagog`
  ADD PRIMARY KEY (`id_pedagog`),
  ADD KEY `dep_id` (`dep_id`);

--
-- Indexes for table `perdorues`
--
ALTER TABLE `perdorues`
  ADD PRIMARY KEY (`id_perdorues`);

--
-- Indexes for table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`id_salle`);

--
-- Indexes for table `seminar`
--
ALTER TABLE `seminar`
  ADD PRIMARY KEY (`id_seminar`),
  ADD KEY `grup_id` (`grup_id`,`lende_id`,`pedagog_id`,`salle_id`),
  ADD KEY `pedagog_id` (`pedagog_id`),
  ADD KEY `lende_id` (`lende_id`),
  ADD KEY `salle_id` (`salle_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id_student`),
  ADD KEY `grup_id` (`grup_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dege`
--
ALTER TABLE `dege`
  MODIFY `id_dege` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departament`
--
ALTER TABLE `departament`
  MODIFY `id_dep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dite`
--
ALTER TABLE `dite`
  MODIFY `id_dite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `grup`
--
ALTER TABLE `grup`
  MODIFY `id_grup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `laborator`
--
ALTER TABLE `laborator`
  MODIFY `id_lab` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leksion`
--
ALTER TABLE `leksion`
  MODIFY `id_leksion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lende`
--
ALTER TABLE `lende`
  MODIFY `id_lende` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pedagog`
--
ALTER TABLE `pedagog`
  MODIFY `id_pedagog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `perdorues`
--
ALTER TABLE `perdorues`
  MODIFY `id_perdorues` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `salle`
--
ALTER TABLE `salle`
  MODIFY `id_salle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `seminar`
--
ALTER TABLE `seminar`
  MODIFY `id_seminar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id_student` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dege`
--
ALTER TABLE `dege`
  ADD CONSTRAINT `dege_ibfk_1` FOREIGN KEY (`dep_id`) REFERENCES `departament` (`id_dep`) ON DELETE CASCADE;

--
-- Constraints for table `grup`
--
ALTER TABLE `grup`
  ADD CONSTRAINT `grup_ibfk_1` FOREIGN KEY (`dege_id`) REFERENCES `dege` (`id_dege`) ON DELETE CASCADE;

--
-- Constraints for table `laborator`
--
ALTER TABLE `laborator`
  ADD CONSTRAINT `laborator_ibfk_1` FOREIGN KEY (`pedagog_id`) REFERENCES `pedagog` (`id_pedagog`) ON DELETE CASCADE,
  ADD CONSTRAINT `laborator_ibfk_2` FOREIGN KEY (`grup_id`) REFERENCES `grup` (`id_grup`) ON DELETE CASCADE,
  ADD CONSTRAINT `laborator_ibfk_3` FOREIGN KEY (`lende_id`) REFERENCES `lende` (`id_lende`) ON DELETE CASCADE,
  ADD CONSTRAINT `laborator_ibfk_4` FOREIGN KEY (`salle_id`) REFERENCES `salle` (`id_salle`) ON DELETE CASCADE;

--
-- Constraints for table `leksion`
--
ALTER TABLE `leksion`
  ADD CONSTRAINT `leksion_ibfk_1` FOREIGN KEY (`pedagog_id`) REFERENCES `pedagog` (`id_pedagog`) ON DELETE CASCADE,
  ADD CONSTRAINT `leksion_ibfk_2` FOREIGN KEY (`lende_id`) REFERENCES `lende` (`id_lende`) ON DELETE CASCADE,
  ADD CONSTRAINT `leksion_ibfk_3` FOREIGN KEY (`salle_id`) REFERENCES `salle` (`id_salle`) ON DELETE CASCADE;

--
-- Constraints for table `pedagog`
--
ALTER TABLE `pedagog`
  ADD CONSTRAINT `pedagog_ibfk_1` FOREIGN KEY (`dep_id`) REFERENCES `departament` (`id_dep`) ON DELETE CASCADE;

--
-- Constraints for table `seminar`
--
ALTER TABLE `seminar`
  ADD CONSTRAINT `seminar_ibfk_1` FOREIGN KEY (`pedagog_id`) REFERENCES `pedagog` (`id_pedagog`) ON DELETE CASCADE,
  ADD CONSTRAINT `seminar_ibfk_2` FOREIGN KEY (`grup_id`) REFERENCES `grup` (`id_grup`) ON DELETE CASCADE,
  ADD CONSTRAINT `seminar_ibfk_3` FOREIGN KEY (`lende_id`) REFERENCES `lende` (`id_lende`) ON DELETE CASCADE,
  ADD CONSTRAINT `seminar_ibfk_4` FOREIGN KEY (`salle_id`) REFERENCES `salle` (`id_salle`) ON DELETE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`grup_id`) REFERENCES `grup` (`id_grup`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
