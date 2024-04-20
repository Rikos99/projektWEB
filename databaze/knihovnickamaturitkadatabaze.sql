-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Sob 20. dub 2024, 18:18
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
-- Databáze: `knihovnickamaturitkadatabaze`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `autori`
--

CREATE TABLE `autori` (
  `Id` int(11) NOT NULL,
  `Jmeno` varchar(30) NOT NULL,
  `Prijmeni` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `autori`
--

INSERT INTO `autori` (`Id`, `Jmeno`, `Prijmeni`) VALUES
(1, 'Bozena', 'Nemcova'),
(3, 'Jane', 'Austenová'),
(4, 'Emily', 'Brontëová');

-- --------------------------------------------------------

--
-- Struktura tabulky `knihauzivatel`
--

CREATE TABLE `knihauzivatel` (
  `knihaId` int(11) NOT NULL,
  `uzivatelId` int(11) NOT NULL,
  `oblibena` bit(1) NOT NULL,
  `povinna` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `knihauzivatel`
--

INSERT INTO `knihauzivatel` (`knihaId`, `uzivatelId`, `oblibena`, `povinna`) VALUES
(1, 1, b'0', b'1');

-- --------------------------------------------------------

--
-- Struktura tabulky `knihy`
--

CREATE TABLE `knihy` (
  `Id` int(11) NOT NULL,
  `Nazev` varchar(100) NOT NULL,
  `Obdobi` int(11) NOT NULL,
  `Autor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `knihy`
--

INSERT INTO `knihy` (`Id`, `Nazev`, `Obdobi`, `Autor`) VALUES
(1, 'Pýcha a předsudek', 1, 3),
(2, 'Na Větrné hůrce', 1, 4);

-- --------------------------------------------------------

--
-- Struktura tabulky `komentare`
--

CREATE TABLE `komentare` (
  `Id` int(11) NOT NULL,
  `Obsah` varchar(100) NOT NULL,
  `PrispevekId` int(11) NOT NULL,
  `UzivatelId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `nahlaseni`
--

CREATE TABLE `nahlaseni` (
  `Id` int(11) NOT NULL,
  `PrispevekId` int(11) NOT NULL,
  `Duvod` varchar(100) NOT NULL,
  `NahlasenoUzivatelemId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `obdobi`
--

CREATE TABLE `obdobi` (
  `Id` int(11) NOT NULL,
  `Nazev` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `obdobi`
--

INSERT INTO `obdobi` (`Id`, `Nazev`) VALUES
(1, 'SVĚTOVÁ A ČESKÁ LITERATURA 19. STOLETÍ');

-- --------------------------------------------------------

--
-- Struktura tabulky `prispevky`
--

CREATE TABLE `prispevky` (
  `Id` int(11) NOT NULL,
  `Nazev` varchar(100) NOT NULL,
  `Obsah` varchar(800) NOT NULL,
  `DatumNahrani` date NOT NULL DEFAULT current_timestamp(),
  `Typ` int(11) NOT NULL,
  `KnihaId` int(11) DEFAULT NULL,
  `ObdobiId` int(11) DEFAULT NULL,
  `AutorId` int(11) DEFAULT NULL,
  `UzivatelId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `prispevky`
--

INSERT INTO `prispevky` (`Id`, `Nazev`, `Obsah`, `DatumNahrani`, `Typ`, `KnihaId`, `ObdobiId`, `AutorId`, `UzivatelId`) VALUES
(1, 'Krasna kniha', 'Nejkrasnejsi kniha co jsem kdy cetl', '2024-04-20', 1, 1, NULL, NULL, 1),
(6, 'gredg', '<p>rherg</p>\r\n', '2024-04-20', 1, 2, NULL, NULL, 2),
(7, 'gredg', '<p>rherg</p>\r\n', '2024-04-20', 1, 2, NULL, NULL, 2),
(8, 'gredg', '<p>rherg</p>\r\n', '2024-04-20', 1, 2, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Struktura tabulky `role`
--

CREATE TABLE `role` (
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `skoly`
--

CREATE TABLE `skoly` (
  `Id` int(11) NOT NULL,
  `Nazev` varchar(100) NOT NULL,
  `Zkratka` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `tridy`
--

CREATE TABLE `tridy` (
  `Id` int(11) NOT NULL,
  `Skola` int(11) NOT NULL,
  `Nazev` varchar(100) NOT NULL,
  `Zkratka` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `typyprispevku`
--

CREATE TABLE `typyprispevku` (
  `Id` int(11) NOT NULL,
  `typ` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `typyprispevku`
--

INSERT INTO `typyprispevku` (`Id`, `typ`) VALUES
(1, 'Ctenarsky denik'),
(2, 'Rozbor'),
(3, 'Zapisky');

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatele`
--

CREATE TABLE `uzivatele` (
  `Id` int(11) NOT NULL,
  `jmeno` varchar(30) NOT NULL,
  `prijmeni` varchar(30) NOT NULL,
  `prezdivka` varchar(30) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `heslo` varchar(64) NOT NULL,
  `ikona` varchar(100) DEFAULT NULL,
  `role` varchar(30) DEFAULT NULL,
  `trida` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `uzivatele`
--

INSERT INTO `uzivatele` (`Id`, `jmeno`, `prijmeni`, `prezdivka`, `email`, `heslo`, `ikona`, `role`, `trida`) VALUES
(1, 'Pepik', 'Vrch', NULL, 'pepik@rfger.gr', '56b1db8133d9eb398aabd376f07bf8ab5fc584ea0b8bd6a1770200cb613ca005', NULL, NULL, NULL),
(2, 'Stanislav', 'Janča', NULL, 's.janca.st@spseiostrava.cz', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL, NULL, NULL);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `autori`
--
ALTER TABLE `autori`
  ADD PRIMARY KEY (`Id`);

--
-- Indexy pro tabulku `knihauzivatel`
--
ALTER TABLE `knihauzivatel`
  ADD PRIMARY KEY (`knihaId`,`uzivatelId`),
  ADD KEY `uzivatelId` (`uzivatelId`);

--
-- Indexy pro tabulku `knihy`
--
ALTER TABLE `knihy`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Obdobi` (`Obdobi`),
  ADD KEY `Autor` (`Autor`);

--
-- Indexy pro tabulku `komentare`
--
ALTER TABLE `komentare`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `PrispevekId` (`PrispevekId`),
  ADD KEY `UzivatelId` (`UzivatelId`);

--
-- Indexy pro tabulku `nahlaseni`
--
ALTER TABLE `nahlaseni`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `PrispevekId` (`PrispevekId`),
  ADD KEY `NahlasenoUzivatelemId` (`NahlasenoUzivatelemId`);

--
-- Indexy pro tabulku `obdobi`
--
ALTER TABLE `obdobi`
  ADD PRIMARY KEY (`Id`);

--
-- Indexy pro tabulku `prispevky`
--
ALTER TABLE `prispevky`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `KnihaId` (`KnihaId`),
  ADD KEY `ObdobiId` (`ObdobiId`),
  ADD KEY `AutorId` (`AutorId`),
  ADD KEY `UzivatelId` (`UzivatelId`),
  ADD KEY `prispevky_ibfk_1` (`Typ`);

--
-- Indexy pro tabulku `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role`);

--
-- Indexy pro tabulku `skoly`
--
ALTER TABLE `skoly`
  ADD PRIMARY KEY (`Id`);

--
-- Indexy pro tabulku `tridy`
--
ALTER TABLE `tridy`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Skola` (`Skola`);

--
-- Indexy pro tabulku `typyprispevku`
--
ALTER TABLE `typyprispevku`
  ADD PRIMARY KEY (`Id`);

--
-- Indexy pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Role` (`role`),
  ADD KEY `Trida` (`trida`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `autori`
--
ALTER TABLE `autori`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pro tabulku `knihy`
--
ALTER TABLE `knihy`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pro tabulku `komentare`
--
ALTER TABLE `komentare`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `nahlaseni`
--
ALTER TABLE `nahlaseni`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `obdobi`
--
ALTER TABLE `obdobi`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pro tabulku `prispevky`
--
ALTER TABLE `prispevky`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pro tabulku `skoly`
--
ALTER TABLE `skoly`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `tridy`
--
ALTER TABLE `tridy`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `typyprispevku`
--
ALTER TABLE `typyprispevku`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `knihauzivatel`
--
ALTER TABLE `knihauzivatel`
  ADD CONSTRAINT `knihauzivatel_ibfk_1` FOREIGN KEY (`knihaId`) REFERENCES `knihy` (`Id`),
  ADD CONSTRAINT `knihauzivatel_ibfk_2` FOREIGN KEY (`uzivatelId`) REFERENCES `uzivatele` (`Id`);

--
-- Omezení pro tabulku `knihy`
--
ALTER TABLE `knihy`
  ADD CONSTRAINT `knihy_ibfk_1` FOREIGN KEY (`Obdobi`) REFERENCES `obdobi` (`Id`),
  ADD CONSTRAINT `knihy_ibfk_2` FOREIGN KEY (`Autor`) REFERENCES `autori` (`Id`);

--
-- Omezení pro tabulku `komentare`
--
ALTER TABLE `komentare`
  ADD CONSTRAINT `komentare_ibfk_1` FOREIGN KEY (`PrispevekId`) REFERENCES `prispevky` (`Id`),
  ADD CONSTRAINT `komentare_ibfk_2` FOREIGN KEY (`UzivatelId`) REFERENCES `uzivatele` (`Id`);

--
-- Omezení pro tabulku `nahlaseni`
--
ALTER TABLE `nahlaseni`
  ADD CONSTRAINT `nahlaseni_ibfk_1` FOREIGN KEY (`PrispevekId`) REFERENCES `prispevky` (`Id`),
  ADD CONSTRAINT `nahlaseni_ibfk_2` FOREIGN KEY (`NahlasenoUzivatelemId`) REFERENCES `uzivatele` (`Id`);

--
-- Omezení pro tabulku `prispevky`
--
ALTER TABLE `prispevky`
  ADD CONSTRAINT `prispevky_ibfk_1` FOREIGN KEY (`Typ`) REFERENCES `typyprispevku` (`Id`),
  ADD CONSTRAINT `prispevky_ibfk_2` FOREIGN KEY (`KnihaId`) REFERENCES `knihy` (`Id`),
  ADD CONSTRAINT `prispevky_ibfk_3` FOREIGN KEY (`ObdobiId`) REFERENCES `obdobi` (`Id`),
  ADD CONSTRAINT `prispevky_ibfk_4` FOREIGN KEY (`AutorId`) REFERENCES `autori` (`Id`),
  ADD CONSTRAINT `prispevky_ibfk_5` FOREIGN KEY (`UzivatelId`) REFERENCES `uzivatele` (`Id`);

--
-- Omezení pro tabulku `tridy`
--
ALTER TABLE `tridy`
  ADD CONSTRAINT `tridy_ibfk_1` FOREIGN KEY (`Skola`) REFERENCES `skoly` (`Id`);

--
-- Omezení pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  ADD CONSTRAINT `uzivatele_ibfk_1` FOREIGN KEY (`Role`) REFERENCES `role` (`role`),
  ADD CONSTRAINT `uzivatele_ibfk_2` FOREIGN KEY (`Trida`) REFERENCES `tridy` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
