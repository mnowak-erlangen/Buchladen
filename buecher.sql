-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 13. Feb 2020 um 12:47
-- Server-Version: 10.1.21-MariaDB
-- PHP-Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `buchladen`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `buecher`
--

DROP TABLE IF EXISTS `buecher`;
CREATE TABLE `buecher` (
  `ISBN10` varchar(10) DEFAULT NULL,
  `ISBN13` varchar(13) NOT NULL,
  `Titel` varchar(50) DEFAULT NULL,
  `Autor` varchar(100) DEFAULT NULL,
  `Verzeichnispfad` varchar(200) DEFAULT NULL,
  `zuletztBearbeitetVon` varchar(50) DEFAULT NULL,
  `zuletztBearbeitetAm` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `buecher`
--

INSERT INTO `buecher` (`ISBN10`, `ISBN13`, `Titel`, `Autor`, `Verzeichnispfad`, `zuletztBearbeitetVon`, `zuletztBearbeitetAm`) VALUES
('012345679', '0123456789012', 'Mein Buch und ich', 'Karl Rudolph', 'mein_buch_und_ich/', 'admin', '2020-02-13'),
('123456790', '9876543210321', 'Gustav, der arme Panda', 'Herold Stein', 'gustav_der_arme_panda/', 'admin', '2020-02-13');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `buecher`
--
ALTER TABLE `buecher`
  ADD PRIMARY KEY (`ISBN13`),
  ADD UNIQUE KEY `ISBN10` (`ISBN10`),
  ADD KEY `zuletztBearbeitetVon` (`zuletztBearbeitetVon`);

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `buecher`
--
ALTER TABLE `buecher`
  ADD CONSTRAINT `buecher_ibfk_1` FOREIGN KEY (`zuletztBearbeitetVon`) REFERENCES `kunde` (`BenutzerID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
