-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 26 feb 2023 om 13:42
-- Serverversie: 10.4.11-MariaDB
-- PHP-versie: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ibizz`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `flights`
--

CREATE TABLE `flights` (
  `id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `handicap` double NOT NULL DEFAULT 0,
  `average` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` enum('man','vrouw','','') NOT NULL,
  `handicap` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `players`
--

INSERT INTO `players` (`id`, `name`, `gender`, `handicap`) VALUES
(1, 'Arno', 'man', 22.8),
(2, 'George', 'man', 25.5),
(3, 'Michiel', 'man', 24.6),
(4, 'Peter', 'man', 23.8),
(5, 'Sylvia', 'vrouw', 29.2),
(6, 'Jan', 'man', 26.5),
(7, 'Bram', 'man', 23.2),
(8, 'Ruud', 'man', 44),
(9, 'Leon', 'man', 18.4),
(10, 'Bart', 'man', 24.9),
(11, 'Ornella', 'vrouw', 39);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `flights`
--
ALTER TABLE `flights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
