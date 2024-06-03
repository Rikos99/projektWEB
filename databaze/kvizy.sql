-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pon 03. čen 2024, 21:24
-- Verze serveru: 10.4.32-MariaDB
-- Verze PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `databaze`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `kvizy`
--

CREATE TABLE `kvizy` (
  `Id` int(11) NOT NULL,
  `Nazev` varchar(50) NOT NULL,
  `Obsah` text NOT NULL,
  `SpravneOdpovedi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`SpravneOdpovedi`)),
  `DatumNahrani` date NOT NULL DEFAULT current_timestamp(),
  `KnihaId` int(11) DEFAULT NULL,
  `ObdobiId` int(11) DEFAULT NULL,
  `AutorId` int(11) DEFAULT NULL,
  `UzivatelId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `kvizy`
--

INSERT INTO `kvizy` (`Id`, `Nazev`, `Obsah`, `SpravneOdpovedi`, `DatumNahrani`, `KnihaId`, `ObdobiId`, `AutorId`, `UzivatelId`) VALUES
(5, 'trhtr', '<form><div class=\"formOtazka\" indexing=\"1\"><h2 class=\"formOtazkaText\">1. hrtht</h2><div class=\"formOdpovedi\" id=\"formOdpovedi1\"><label class=\"formOdpovedLabel\">a) hrthrt</label><input type=\"radio\" class=\"formOdpovedInput\" name=\"otakza-1-\" indexing=\"a\"><label class=\"formOdpovedLabel\">b) htrhtr</label><input type=\"radio\" class=\"formOdpovedInput\" name=\"otakza-1-\" indexing=\"b\"></div></div><input></form>', '{\"1\":[\"a\"]}', '2024-06-03', 52, NULL, NULL, 2),
(6, 'trhtr', '<form><div class=\"formOtazka\" indexing=\"1\"><h2 class=\"formOtazkaText\">1. hrtht</h2><div class=\"formOdpovedi\" id=\"formOdpovedi1\"><label class=\"formOdpovedLabel\">a) hrthrt</label><input type=\"radio\" class=\"formOdpovedInput\" name=\"otakza-1-\" indexing=\"a\"><label class=\"formOdpovedLabel\">b) htrhtr</label><input type=\"radio\" class=\"formOdpovedInput\" name=\"otakza-1-\" indexing=\"b\"></div></div><input></form>', '{\"1\":[\"a\"]}', '2024-06-03', 52, NULL, NULL, 2),
(7, '', '<form><div class=\"formOtazka\" indexing=\"1\"><h2 class=\"formOtazkaText\">1. htr</h2><div class=\"formOdpovedi\" id=\"formOdpovedi1\"><label class=\"formOdpovedLabel\">a) reger</label><input type=\"radio\" class=\"formOdpovedInput\" name=\"otakza-1-\" indexing=\"a\"><label class=\"formOdpovedLabel\">b) gr</label><input type=\"radio\" class=\"formOdpovedInput\" name=\"otakza-1-\" indexing=\"b\"></div></div><input type=\"submit\"></form>', '{\"1\":[\"a\"]}', '2024-06-03', 52, NULL, NULL, 2);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `kvizy`
--
ALTER TABLE `kvizy`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `AutorId` (`AutorId`),
  ADD KEY `KnihaId` (`KnihaId`),
  ADD KEY `ObdobiId` (`ObdobiId`),
  ADD KEY `UzivatelId` (`UzivatelId`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `kvizy`
--
ALTER TABLE `kvizy`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `kvizy`
--
ALTER TABLE `kvizy`
  ADD CONSTRAINT `kvizy_ibfk_1` FOREIGN KEY (`AutorId`) REFERENCES `autori` (`Id`),
  ADD CONSTRAINT `kvizy_ibfk_2` FOREIGN KEY (`KnihaId`) REFERENCES `knihy` (`Id`),
  ADD CONSTRAINT `kvizy_ibfk_3` FOREIGN KEY (`ObdobiId`) REFERENCES `obdobi` (`Id`),
  ADD CONSTRAINT `kvizy_ibfk_4` FOREIGN KEY (`UzivatelId`) REFERENCES `uzivatele` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
