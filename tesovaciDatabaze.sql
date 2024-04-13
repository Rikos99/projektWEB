-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Ned 14. dub 2024, 00:44
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
-- Struktura tabulky `knihy`
--

CREATE TABLE `knihy` (
  `id` int(11) NOT NULL,
  `nazev` varchar(50) NOT NULL,
  `autor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `knihy`
--

INSERT INTO `knihy` (`id`, `nazev`, `autor`) VALUES
(1, 'hjytjhyt', 'jjjjtyhj'),
(2, 'hrgthgrt', 'trhbedrt'),
(3, 'hdeth', 'grttt');

-- --------------------------------------------------------

--
-- Struktura tabulky `prispevky`
--

CREATE TABLE `prispevky` (
  `id` int(11) NOT NULL,
  `nazev` varchar(20) NOT NULL,
  `typ` varchar(1) NOT NULL,
  `obsah` text NOT NULL,
  `knihaID` int(11) NOT NULL,
  `autorID` int(11) NOT NULL,
  `datum` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `prispevky`
--

INSERT INTO `prispevky` (`id`, `nazev`, `typ`, `obsah`, `knihaID`, `autorID`, `datum`) VALUES
(1, 'gergre', 'Z', '<p>gregerff</p>\r\n', 1, 4, '2024-04-13'),
(2, 'gerge', 'R', '<p>e534ščěčžěžčě</p>\r\n', 1, 4, '2024-04-13'),
(3, 'FEW', 'R', '<p>+ĚŠČŘŽÝÁÍÉ==</p>\r\n', 1, 4, '2024-04-13'),
(4, 'FWE', 'R', '<p>FEW</p>\r\n', 3, 4, '2024-04-13'),
(5, 'FWE', 'R', '<p>FEW</p>\r\n', 3, 4, '2024-04-14');

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatele`
--

CREATE TABLE `uzivatele` (
  `id` int(11) NOT NULL,
  `jmeno` varchar(50) NOT NULL,
  `prijmeni` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `heslo` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `uzivatele`
--

INSERT INTO `uzivatele` (`id`, `jmeno`, `prijmeni`, `email`, `heslo`) VALUES
(1, 'stanislav', 'janca', 's.janca.st@spseiostrava.cz', '56b1db8133d9eb398aabd376f07bf8ab5fc584ea0b8bd6a1770200cb613ca005'),
(3, 'gfer', 'gerg', 's.janca.st@spseiostrava.cz', '123'),
(4, 'jy', 'yjg', 's.janca.st@spseiostrava.cz', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
(5, 'ht6r', 'hrt', 's.janca.st@spseiostrava.cz', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
(6, 'ger', 'ge', 'ova.standa.janca@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `knihy`
--
ALTER TABLE `knihy`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `prispevky`
--
ALTER TABLE `prispevky`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `knihy`
--
ALTER TABLE `knihy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pro tabulku `prispevky`
--
ALTER TABLE `prispevky`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
