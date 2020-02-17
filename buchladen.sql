-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 17. Feb 2020 um 14:55
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
('4567894561', '4445556669990', 'Harald der einsame Affe', 'Harald McDevlem', 'harald_der_einsame_affe/', 'admin', '2020-02-17'),
('123456790', '9876543210321', 'Gustav, der arme Panda', 'Herold Stein', 'gustav_der_arme_panda/', 'admin', '2020-02-13');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kunde`
--

CREATE TABLE `kunde` (
  `BenutzerID` varchar(50) NOT NULL,
  `Passwort` varchar(256) NOT NULL,
  `Vorname` varchar(50) DEFAULT NULL,
  `Nachname` varchar(50) DEFAULT NULL,
  `Strasse` varchar(30) DEFAULT NULL,
  `Hausnr` varchar(5) DEFAULT NULL,
  `PLZ` varchar(5) DEFAULT NULL,
  `Ort` varchar(50) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `kunde`
--

INSERT INTO `kunde` (`BenutzerID`, `Passwort`, `Vorname`, `Nachname`, `Strasse`, `Hausnr`, `PLZ`, `Ort`, `EMAIL`, `isAdmin`) VALUES
('admin', 'admin', 'Admin', 'Der Admin', 'Adminstrasse', '2', '10101', 'Adminhausen', 'admin@admin.de', 1),
('kunde', 'kunde', 'kunde', 'kunde', 'kunde', '1', '00000', 'Kundestadt', 'kunde@kunde.de', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kundebuecher`
--

CREATE TABLE `kundebuecher` (
  `BenutzerID` varchar(50) NOT NULL,
  `ISBN13` varchar(13) NOT NULL,
  `Lesezeichen` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `kundebuecher`
--

INSERT INTO `kundebuecher` (`BenutzerID`, `ISBN13`, `Lesezeichen`) VALUES
('kunde', '0123456789012', 0),
('kunde', '4445556669990', 0),
('kunde', '9876543210321', 1);

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
-- Indizes für die Tabelle `kunde`
--
ALTER TABLE `kunde`
  ADD PRIMARY KEY (`BenutzerID`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`);

--
-- Indizes für die Tabelle `kundebuecher`
--
ALTER TABLE `kundebuecher`
  ADD PRIMARY KEY (`BenutzerID`,`ISBN13`),
  ADD KEY `ISBN13` (`ISBN13`);

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `buecher`
--
ALTER TABLE `buecher`
  ADD CONSTRAINT `buecher_ibfk_1` FOREIGN KEY (`zuletztBearbeitetVon`) REFERENCES `kunde` (`BenutzerID`);

--
-- Constraints der Tabelle `kundebuecher`
--
ALTER TABLE `kundebuecher`
  ADD CONSTRAINT `kundebuecher_ibfk_1` FOREIGN KEY (`BenutzerID`) REFERENCES `kunde` (`BenutzerID`),
  ADD CONSTRAINT `kundebuecher_ibfk_2` FOREIGN KEY (`ISBN13`) REFERENCES `buecher` (`ISBN13`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
