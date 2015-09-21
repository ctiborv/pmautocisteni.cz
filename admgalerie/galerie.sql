-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Počítač: wm70.wedos.net:3306
-- Vygenerováno: Úte 04. srp 2015, 08:59
-- Verze serveru: 5.6.17
-- Verze PHP: 5.4.23

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `d95530_mz`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `galerie`
--

CREATE TABLE IF NOT EXISTS `galerie` (
  `id_galerie` int(11) NOT NULL AUTO_INCREMENT,
  `id_content_Menu` int(11) NOT NULL,
  `nazev` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `popis` text COLLATE utf8_czech_ci,
  `datumvlozeni` date NOT NULL,
  `priorita` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_galerie`),
  UNIQUE KEY `id_galerie` (`id_galerie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=24 ;

--
-- Vypisuji data pro tabulku `galerie`
--

INSERT INTO `galerie` (`id_galerie`, `id_content_Menu`, `nazev`, `popis`, `datumvlozeni`, `priorita`) VALUES
(17, 23, 'MONTREUX', '', '2015-03-30', 4),
(18, 22, 'ALICE', '', '2015-03-31', 1),
(19, 23, 'COLLONGES', '', '2015-03-31', 3),
(20, 21, 'DELPHINE', '', '2015-03-31', 1),
(21, 21, 'COLLONGES', '', '2015-03-31', 2),
(22, 23, 'dEcorations', '', '2015-03-31', 4),
(23, 23, 'GENEVE', '', '2015-05-07', 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
