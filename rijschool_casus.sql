-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 07 apr 2025 om 15:15
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rijschool_casus`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `admin`
--

INSERT INTO `admin` (`id`, `email`, `wachtwoord`) VALUES
(1, 'test@test.com', '$2y$10$dd7Am5VvJiMakCcpgyQR/.eKzsAbEmAV9RekNGhzM/2gja9a6siqq');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `autos`
--

CREATE TABLE `autos` (
  `id` int(11) NOT NULL,
  `merk` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `bouwjaar` year(4) NOT NULL,
  `brandstof` enum('Benzine','Diesel','Elektrisch') NOT NULL,
  `status` enum('Beschikbaar','Niet beschikbaar','In onderhoud') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `autos`
--

INSERT INTO `autos` (`id`, `merk`, `model`, `bouwjaar`, `brandstof`, `status`) VALUES
(1, 'Mercedes', 'C300', '2021', 'Benzine', 'Beschikbaar');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `instructeurs`
--

CREATE TABLE `instructeurs` (
  `id` int(11) NOT NULL,
  `naam` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `ziek` enum('Ja','Nee') NOT NULL DEFAULT 'Nee',
  `rol` enum('Instructeur','Admin') NOT NULL DEFAULT 'Instructeur',
  `auto_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `instructeurs`
--

INSERT INTO `instructeurs` (`id`, `naam`, `email`, `wachtwoord`, `ziek`, `rol`, `auto_id`) VALUES
(1, 'John', 'john123@gmail.com', '$2y$10$grBCIwctrW13GJoXNTnT4es4o6MMjjgAt/3WA/YZSgkO16tQMIJme', 'Nee', 'Instructeur', 1),
(5, 'gure', 'gure@gmail.com', '$2y$10$iy6GlEkPptbdoNv7JaJiYedzaeaKy6bf3Q/AGGeaXNjikVN5XhlNG', 'Nee', 'Instructeur', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `leerlingen`
--

CREATE TABLE `leerlingen` (
  `id` int(11) NOT NULL,
  `naam` varchar(100) NOT NULL,
  `achternaam` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `ziek` enum('Ja','Nee') NOT NULL DEFAULT 'Nee',
  `rol` enum('Leerling','Instructeur','Admin') NOT NULL DEFAULT 'Leerling',
  `lespakket_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `leerlingen`
--

INSERT INTO `leerlingen` (`id`, `naam`, `achternaam`, `email`, `wachtwoord`, `ziek`, `rol`, `lespakket_id`) VALUES
(1, 'Sara', 'Fadili', 'sarafadili@gmail.com', '$2y$10$2pCongL.fPln9wNk8lLaW.dOoPZixdjVP6oxYxLAR8G6JlmskX5ZK', 'Nee', 'Leerling', 1),
(2, 'ahmed', 'test', 'ahmed@gmail.com', '$2y$10$H8XP0DglECotldvzMBGYP.MA1KhMUMfGfonEUto.VyqlessX2sqAu', 'Nee', 'Leerling', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `lespakketten`
--

CREATE TABLE `lespakketten` (
  `id` int(11) NOT NULL,
  `naam_pakket` varchar(100) NOT NULL,
  `aantal_lessen` int(11) NOT NULL,
  `prijs` decimal(10,2) NOT NULL,
  `inclusief_examen` enum('Ja','Nee') NOT NULL DEFAULT 'Nee'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `lespakketten`
--

INSERT INTO `lespakketten` (`id`, `naam_pakket`, `aantal_lessen`, `prijs`, `inclusief_examen`) VALUES
(1, 'Basis', 10, 600.00, 'Nee');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `lessen`
--

CREATE TABLE `lessen` (
  `id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `tijd` time NOT NULL,
  `ophaallocatie` varchar(255) NOT NULL,
  `gekoppelde_instructeur` int(11) NOT NULL,
  `gekoppelde_leerling` int(11) NOT NULL,
  `opmerkingen` text DEFAULT NULL,
  `status` enum('Geannuleerd','Gaat door') NOT NULL DEFAULT 'Gaat door'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `lessen`
--

INSERT INTO `lessen` (`id`, `datum`, `tijd`, `ophaallocatie`, `gekoppelde_instructeur`, `gekoppelde_leerling`, `opmerkingen`, `status`) VALUES
(1, '2025-04-07', '14:43:39', 'bijlmer', 5, 1, NULL, 'Gaat door');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexen voor tabel `autos`
--
ALTER TABLE `autos`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `instructeurs`
--
ALTER TABLE `instructeurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_auto` (`auto_id`);

--
-- Indexen voor tabel `leerlingen`
--
ALTER TABLE `leerlingen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_lespakket` (`lespakket_id`);

--
-- Indexen voor tabel `lespakketten`
--
ALTER TABLE `lespakketten`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `lessen`
--
ALTER TABLE `lessen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gekoppelde_instructeur` (`gekoppelde_instructeur`),
  ADD KEY `gekoppelde_leerling` (`gekoppelde_leerling`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `autos`
--
ALTER TABLE `autos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `instructeurs`
--
ALTER TABLE `instructeurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `leerlingen`
--
ALTER TABLE `leerlingen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `lespakketten`
--
ALTER TABLE `lespakketten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `lessen`
--
ALTER TABLE `lessen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `instructeurs`
--
ALTER TABLE `instructeurs`
  ADD CONSTRAINT `fk_auto` FOREIGN KEY (`auto_id`) REFERENCES `autos` (`id`);

--
-- Beperkingen voor tabel `leerlingen`
--
ALTER TABLE `leerlingen`
  ADD CONSTRAINT `fk_lespakket` FOREIGN KEY (`lespakket_id`) REFERENCES `lespakketten` (`id`);

--
-- Beperkingen voor tabel `lessen`
--
ALTER TABLE `lessen`
  ADD CONSTRAINT `lessen_ibfk_1` FOREIGN KEY (`gekoppelde_instructeur`) REFERENCES `instructeurs` (`id`),
  ADD CONSTRAINT `lessen_ibfk_2` FOREIGN KEY (`gekoppelde_leerling`) REFERENCES `leerlingen` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
