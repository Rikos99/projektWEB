-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 10:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `knihovnickamaturitkadatabaze`
--

-- --------------------------------------------------------

--
-- Table structure for table `autori`
--

CREATE TABLE `autori` (
  `Id` int(11) NOT NULL,
  `Jmeno` varchar(30) NOT NULL,
  `Prijmeni` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `autori`
--

INSERT INTO `autori` (`Id`, `Jmeno`, `Prijmeni`) VALUES
(1, 'Ovidius', ''),
(2, 'Sofokles', ''),
(3, 'W.', 'Shakespeare'),
(4, 'Moliére', ''),
(5, 'J. W.', 'Goethe'),
(6, 'Daniel', 'Defoe'),
(7, 'A. S.', 'Puškin'),
(8, 'Victor', 'Hugo'),
(9, 'H. de', 'Balzac'),
(10, 'E.', 'Zola'),
(11, 'N. V.', 'Gogol'),
(12, 'A. E.', 'Poe'),
(13, 'G. de', 'Maupassant'),
(14, 'K.H.', 'Mácha'),
(15, 'K.', 'Havlíček Borovský'),
(16, 'Božena', 'Němcová'),
(17, 'J.', 'Vrchlický'),
(18, 'K.J.', 'Erben'),
(19, 'F. L.', 'Čelakovský'),
(20, 'J.', 'Neruda'),
(21, 'J.', 'Arbes'),
(22, 'S.', 'Čech'),
(23, 'A.', 'Jirásek'),
(24, 'G.', 'Apollinaire'),
(25, 'E.', 'Hemingway'),
(26, 'J.', 'Steinbeck'),
(27, 'A. de', 'Saint-Exupéry'),
(28, 'W.', 'Styron'),
(29, 'J.', 'Clavell'),
(30, 'U.', 'Eco'),
(31, 'J.', 'Heller'),
(32, 'E. M.', 'Remarque'),
(33, 'S.', 'Beckett'),
(34, 'R.', 'Rolland'),
(35, 'F. S.', 'Fitzgerald'),
(36, 'G.', 'Orwell'),
(37, 'Christiane', 'F.'),
(38, 'V.', 'Dyk'),
(39, 'J.', 'Wolker'),
(40, 'Petr', 'Bezruč'),
(41, 'V.', 'Nezval'),
(42, 'L.', 'Fuks'),
(43, 'M.', 'Kundera'),
(44, 'B.', 'Hrabal'),
(45, 'V.', 'Hrabě'),
(46, 'O.', 'Pavel'),
(47, 'K.', 'Čapek'),
(48, 'K.', 'Poláček'),
(49, 'J.', 'Otčenášek'),
(50, 'F.', 'Kafka'),
(51, 'J.', 'Hašek'),
(52, 'V.', 'Vančura'),
(53, 'I.', 'Olbracht'),
(54, 'M.', 'Viewegh'),
(55, 'Radek', 'John'),
(56, 'Václav', 'Havel');

-- --------------------------------------------------------

--
-- Table structure for table `knihauzivatel`
--

CREATE TABLE `knihauzivatel` (
  `knihaId` int(11) NOT NULL,
  `uzivatelId` int(11) NOT NULL,
  `oblibena` bit(1) NOT NULL,
  `povinna` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `knihy`
--

CREATE TABLE `knihy` (
  `Id` int(11) NOT NULL,
  `Nazev` varchar(100) NOT NULL,
  `Obdobi` int(11) NOT NULL,
  `Autor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `knihy`
--

INSERT INTO `knihy` (`Id`, `Nazev`, `Obdobi`, `Autor`) VALUES
(52, 'Proměny', 2, 1),
(53, 'Antigona', 2, 2),
(54, 'Hamlet', 2, 3),
(55, 'Romeo a Julie', 2, 3),
(56, 'Lakomec', 2, 4),
(57, 'Utrpení mladého Werthera', 2, 5),
(58, 'Robinson Crusoe', 2, 6),
(59, 'Evžen Oněgin', 1, 7),
(60, 'Chrám Matky Boží v Paříži', 1, 8),
(61, 'Otec Goriot', 1, 9),
(62, 'Zabiják', 1, 10),
(63, 'Revizor', 1, 11),
(64, 'Jáma a kyvadlo', 1, 12),
(65, 'Kulička', 1, 13),
(66, 'Máj', 1, 14),
(67, 'Tyrolské elegie', 1, 15),
(68, 'Král Lávra', 1, 15),
(69, 'Divá Bára', 1, 16),
(70, 'Noc na Karlštejně', 1, 17),
(71, 'Kytice', 1, 18),
(72, 'Toman a lesní panna', 1, 19),
(73, 'Malostranské povídky', 1, 20),
(74, 'Newtonův mozek', 1, 21),
(75, 'Svatý Xaverius', 1, 21),
(76, 'Nový epochální výlet pana Broučka, tentokráte do XV.století', 1, 22),
(77, 'Pásmo', 3, 23),
(78, 'Stařec a moře', 3, 24),
(79, 'O myších a lidech', 3, 25),
(80, 'Malý princ', 3, 27),
(81, 'Sophiina volba', 3, 28),
(82, 'Král krysa', 3, 29),
(83, 'Jméno růže', 3, 30),
(84, 'Hlava XXII.', 3, 31),
(85, 'Na západní frontě klid', 3, 32),
(86, 'Nebe nezná vyvolených', 3, 32),
(87, 'Čekání na Godota', 3, 33),
(88, 'Petr a Lucie', 3, 34),
(89, 'Velký Gatsby', 3, 35),
(90, 'Farma zvířat', 3, 36),
(91, '1984', 3, 36),
(92, 'My děti ze stanice ZOO', 3, 37),
(93, 'Krysař', 4, 38),
(94, 'Balada o námořníkovi', 4, 39),
(95, 'Slezské písně', 4, 40),
(96, 'Abeceda', 4, 41),
(97, 'Manon Lescaut', 4, 41),
(98, 'Spalovač mrtvol', 4, 42),
(99, 'Falešný autostop', 4, 43),
(100, 'Ostře sledované vlaky', 4, 44),
(101, 'Postřižiny', 4, 44),
(102, 'Blues pro bláznivou holku', 4, 45),
(103, 'Smrt krásných srnců', 4, 46),
(104, 'R.U.R', 4, 47),
(105, 'Bílá nemoc', 4, 47),
(106, 'Válka s mloky', 4, 47),
(107, 'Krakatit', 4, 47),
(108, 'Matka', 4, 47),
(109, 'Bylo nás pět', 4, 48),
(110, 'Romeo, Julie a tma', 4, 49),
(111, 'Proměna', 4, 50),
(112, 'Osudy dobrého vojáka Švejka za světové války', 4, 51),
(113, 'Rozmarné léto', 4, 52),
(114, 'Nikola Šuhaj loupežník', 4, 53),
(115, 'Báječná léta pod psa', 4, 54),
(116, 'Memento', 4, 55),
(117, 'Audience', 4, 56);

-- --------------------------------------------------------

--
-- Table structure for table `komentare`
--

CREATE TABLE `komentare` (
  `Id` int(11) NOT NULL,
  `Obsah` varchar(100) NOT NULL,
  `PrispevekId` int(11) NOT NULL,
  `UzivatelId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nahlaseni`
--

CREATE TABLE `nahlaseni` (
  `Id` int(11) NOT NULL,
  `PrispevekId` int(11) NOT NULL,
  `Duvod` varchar(100) NOT NULL,
  `NahlasenoUzivatelemId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `obdobi`
--

CREATE TABLE `obdobi` (
  `Id` int(11) NOT NULL,
  `Nazev` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `obdobi`
--

INSERT INTO `obdobi` (`Id`, `Nazev`) VALUES
(1, 'SVĚTOVÁ A ČESKÁ LITERATURA 19. STOLETÍ'),
(2, 'SVĚTOVÁ A ČESKÁ LITERATURA DO KONCE 18. STOL.'),
(3, 'SVĚTOVÁ A ČESKÁ LITERATURA 20. A 21. STOLETÍ'),
(4, 'ČESKÁ LITERATURA 20. A 21. STOLETÍ');

-- --------------------------------------------------------

--
-- Table structure for table `prispevky`
--

CREATE TABLE `prispevky` (
  `Id` int(11) NOT NULL,
  `Nazev` varchar(100) NOT NULL,
  `Obsah` text NOT NULL,
  `DatumNahrani` date NOT NULL DEFAULT current_timestamp(),
  `Typ` int(11) NOT NULL,
  `KnihaId` int(11) DEFAULT NULL,
  `ObdobiId` int(11) DEFAULT NULL,
  `AutorId` int(11) DEFAULT NULL,
  `UzivatelId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prispevky`
--

INSERT INTO `prispevky` (`Id`, `Nazev`, `Obsah`, `DatumNahrani`, `Typ`, `KnihaId`, `ObdobiId`, `AutorId`, `UzivatelId`) VALUES
(9, 'nenavidim tuhle knihu', '<div class=\"messageGroupWrapper__1fce2\" style=\"-webkit-text-stroke-width:0px; background:var(--background-primary); border-radius:4px; border:1px solid var(--background-tertiary); color:#000000; font-family:\"gg sans\",\"Noto Sans\",\"Helvetica Neue\",Helvetica,Arial,sans-serif; font-size:16px; font-style:normal; font-variant-caps:normal; font-variant-ligatures:normal; font-weight:400; letter-spacing:normal; margin-bottom:6px; margin-left:0; margin-right:0; margin-top:0; orphans:2; outline:0px; overflow:hidden; padding:0px; position:relative; text-align:start; text-decoration-color:initial; text-decoration-style:initial; text-decoration-thickness:initial; text-indent:0px; text-transform:none; user-select:none; vertical-align:baseline; white-space:normal; widows:2; word-spacing:0px\">\r\n<div class=', '2024-04-24', 3, 66, NULL, NULL, 3),
(10, 'miluju tuhle knihu', '<p>vskutku miluju tuhle knihu</p>\r\n', '2024-04-24', 1, 71, NULL, NULL, 3),
(11, 'MRDKA', '<p>NENÁVIDÍM TUHLE KNIHU</p>\r\n\r\n<ol style=\"margin-left:0; margin-right:0\">\r\n</ol>\r\n', '2024-04-24', 1, 59, NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skoly`
--

CREATE TABLE `skoly` (
  `Id` int(11) NOT NULL,
  `Nazev` varchar(100) NOT NULL,
  `Zkratka` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tridy`
--

CREATE TABLE `tridy` (
  `Id` int(11) NOT NULL,
  `Skola` int(11) NOT NULL,
  `Nazev` varchar(100) NOT NULL,
  `Zkratka` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `typyprispevku`
--

CREATE TABLE `typyprispevku` (
  `Id` int(11) NOT NULL,
  `typ` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `typyprispevku`
--

INSERT INTO `typyprispevku` (`Id`, `typ`) VALUES
(1, 'Ctenarsky denik'),
(2, 'Rozbor'),
(3, 'Zapisky');

-- --------------------------------------------------------

--
-- Table structure for table `uzivatele`
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
-- Dumping data for table `uzivatele`
--

INSERT INTO `uzivatele` (`Id`, `jmeno`, `prijmeni`, `prezdivka`, `email`, `heslo`, `ikona`, `role`, `trida`) VALUES
(1, 'Pepik', 'Vrch', NULL, 'pepik@rfger.gr', '56b1db8133d9eb398aabd376f07bf8ab5fc584ea0b8bd6a1770200cb613ca005', NULL, NULL, NULL),
(2, 'Stanislav', 'Janča', NULL, 's.janca.st@spseiostrava.cz', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL, NULL, NULL),
(3, 'Richard', 'Dluhoš', NULL, 'r.dluhos.st@spseiostrava.cz', '56b1db8133d9eb398aabd376f07bf8ab5fc584ea0b8bd6a1770200cb613ca005', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autori`
--
ALTER TABLE `autori`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `knihauzivatel`
--
ALTER TABLE `knihauzivatel`
  ADD PRIMARY KEY (`knihaId`,`uzivatelId`),
  ADD KEY `uzivatelId` (`uzivatelId`);

--
-- Indexes for table `knihy`
--
ALTER TABLE `knihy`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Obdobi` (`Obdobi`),
  ADD KEY `Autor` (`Autor`);

--
-- Indexes for table `komentare`
--
ALTER TABLE `komentare`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `PrispevekId` (`PrispevekId`),
  ADD KEY `UzivatelId` (`UzivatelId`);

--
-- Indexes for table `nahlaseni`
--
ALTER TABLE `nahlaseni`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `PrispevekId` (`PrispevekId`),
  ADD KEY `NahlasenoUzivatelemId` (`NahlasenoUzivatelemId`);

--
-- Indexes for table `obdobi`
--
ALTER TABLE `obdobi`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `prispevky`
--
ALTER TABLE `prispevky`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `KnihaId` (`KnihaId`),
  ADD KEY `ObdobiId` (`ObdobiId`),
  ADD KEY `AutorId` (`AutorId`),
  ADD KEY `UzivatelId` (`UzivatelId`),
  ADD KEY `prispevky_ibfk_1` (`Typ`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role`);

--
-- Indexes for table `skoly`
--
ALTER TABLE `skoly`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tridy`
--
ALTER TABLE `tridy`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Skola` (`Skola`);

--
-- Indexes for table `typyprispevku`
--
ALTER TABLE `typyprispevku`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `uzivatele`
--
ALTER TABLE `uzivatele`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Role` (`role`),
  ADD KEY `Trida` (`trida`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `autori`
--
ALTER TABLE `autori`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=804;

--
-- AUTO_INCREMENT for table `knihy`
--
ALTER TABLE `knihy`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `komentare`
--
ALTER TABLE `komentare`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nahlaseni`
--
ALTER TABLE `nahlaseni`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `obdobi`
--
ALTER TABLE `obdobi`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `prispevky`
--
ALTER TABLE `prispevky`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `skoly`
--
ALTER TABLE `skoly`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tridy`
--
ALTER TABLE `tridy`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `typyprispevku`
--
ALTER TABLE `typyprispevku`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `uzivatele`
--
ALTER TABLE `uzivatele`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `knihauzivatel`
--
ALTER TABLE `knihauzivatel`
  ADD CONSTRAINT `knihauzivatel_ibfk_1` FOREIGN KEY (`knihaId`) REFERENCES `knihy` (`Id`),
  ADD CONSTRAINT `knihauzivatel_ibfk_2` FOREIGN KEY (`uzivatelId`) REFERENCES `uzivatele` (`Id`);

--
-- Constraints for table `knihy`
--
ALTER TABLE `knihy`
  ADD CONSTRAINT `knihy_ibfk_1` FOREIGN KEY (`Obdobi`) REFERENCES `obdobi` (`Id`),
  ADD CONSTRAINT `knihy_ibfk_2` FOREIGN KEY (`Autor`) REFERENCES `autori` (`Id`);

--
-- Constraints for table `komentare`
--
ALTER TABLE `komentare`
  ADD CONSTRAINT `komentare_ibfk_1` FOREIGN KEY (`PrispevekId`) REFERENCES `prispevky` (`Id`),
  ADD CONSTRAINT `komentare_ibfk_2` FOREIGN KEY (`UzivatelId`) REFERENCES `uzivatele` (`Id`);

--
-- Constraints for table `nahlaseni`
--
ALTER TABLE `nahlaseni`
  ADD CONSTRAINT `nahlaseni_ibfk_1` FOREIGN KEY (`PrispevekId`) REFERENCES `prispevky` (`Id`),
  ADD CONSTRAINT `nahlaseni_ibfk_2` FOREIGN KEY (`NahlasenoUzivatelemId`) REFERENCES `uzivatele` (`Id`);

--
-- Constraints for table `prispevky`
--
ALTER TABLE `prispevky`
  ADD CONSTRAINT `prispevky_ibfk_1` FOREIGN KEY (`Typ`) REFERENCES `typyprispevku` (`Id`),
  ADD CONSTRAINT `prispevky_ibfk_2` FOREIGN KEY (`KnihaId`) REFERENCES `knihy` (`Id`),
  ADD CONSTRAINT `prispevky_ibfk_3` FOREIGN KEY (`ObdobiId`) REFERENCES `obdobi` (`Id`),
  ADD CONSTRAINT `prispevky_ibfk_4` FOREIGN KEY (`AutorId`) REFERENCES `autori` (`Id`),
  ADD CONSTRAINT `prispevky_ibfk_5` FOREIGN KEY (`UzivatelId`) REFERENCES `uzivatele` (`Id`);

--
-- Constraints for table `tridy`
--
ALTER TABLE `tridy`
  ADD CONSTRAINT `tridy_ibfk_1` FOREIGN KEY (`Skola`) REFERENCES `skoly` (`Id`);

--
-- Constraints for table `uzivatele`
--
ALTER TABLE `uzivatele`
  ADD CONSTRAINT `uzivatele_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`role`),
  ADD CONSTRAINT `uzivatele_ibfk_2` FOREIGN KEY (`trida`) REFERENCES `tridy` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
