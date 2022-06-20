-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server Version:               10.4.13-MariaDB - mariadb.org binary distribution
-- Server Betriebssystem:        Win64
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Exportiere Datenbank Struktur für aufgabe_ebusiness
DROP DATABASE IF EXISTS `aufgabe_ebusiness`;
CREATE DATABASE IF NOT EXISTS `aufgabe_ebusiness` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `aufgabe_ebusiness`;

-- Exportiere Struktur von Tabelle aufgabe_ebusiness.kategorie
DROP TABLE IF EXISTS `kategorie`;
CREATE TABLE IF NOT EXISTS `kategorie` (
  `KategorieID` int(11) NOT NULL,
  `KategorieName` varchar(50) NOT NULL,
  PRIMARY KEY (`KategorieID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle aufgabe_ebusiness.kategorie: ~4 rows (ungefähr)
DELETE FROM `kategorie`;
/*!40000 ALTER TABLE `kategorie` DISABLE KEYS */;
INSERT INTO `kategorie` (`KategorieID`, `KategorieName`) VALUES
	(1, 'Haus'),
	(2, 'Garten'),
	(3, 'Hobby'),
	(4, 'Tier');
/*!40000 ALTER TABLE `kategorie` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle aufgabe_ebusiness.produkt
DROP TABLE IF EXISTS `produkt`;
CREATE TABLE IF NOT EXISTS `produkt` (
  `ProduktID` int(11) NOT NULL,
  `Produkt_Name` varchar(50) DEFAULT NULL,
  `FK_u_kate` int(11) DEFAULT NULL,
  `Preis` int(11) DEFAULT NULL,
  `Bild_Path` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ProduktID`),
  KEY `FK_produkt_u_kategorie` (`FK_u_kate`),
  CONSTRAINT `FK_produkt_u_kategorie` FOREIGN KEY (`FK_u_kate`) REFERENCES `u_kategorie` (`u_KateID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle aufgabe_ebusiness.produkt: ~9 rows (ungefähr)
DELETE FROM `produkt`;
/*!40000 ALTER TABLE `produkt` DISABLE KEYS */;
INSERT INTO `produkt` (`ProduktID`, `Produkt_Name`, `FK_u_kate`, `Preis`, `Bild_Path`) VALUES
	(1, 'Gartenschaufel', 22, 2, '../pics/Gartenschaufel.jpg'),
	(2, 'Gitarre', 32, 3, '../pics/Gitarre.jpg'),
	(3, 'Handelbank', 31, 4, '../pics/Handelbank.jpg'),
	(4, 'Kleiderschrank', 12, 98, '../pics/kleiderschrank.jpg'),
	(5, 'Rose(Weis)', 21, 65, '../pics/Rose(Weis).jpg'),
	(6, 'Rose(Rot)', 21, 23, '../pics/Rose(Rot).jpg'),
	(7, 'Mixer', 11, 65, '../pics/Mixer.jpg'),
	(8, 'Toaster', 11, 45, '../pics/Toaster.jpg'),
	(9, 'Keyboard', 32, 56, '../pics/Keyboard.jpg');
/*!40000 ALTER TABLE `produkt` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle aufgabe_ebusiness.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `User_name` varchar(50) NOT NULL,
  `Vorname` varchar(50) NOT NULL,
  `Nachname` varchar(50) NOT NULL,
  `Passwort` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle aufgabe_ebusiness.user: ~2 rows (ungefähr)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`UserID`, `User_name`, `Vorname`, `Nachname`, `Passwort`, `email`) VALUES
	(1, 'Nick', 'Nick', 'Elice', 'hallo', 'n@web.de'),
	(2, 'Lukas', 'Lukas', 'S', 'hii', 's@web.de'),
	(3, 'nelice', '', '', 'abc', 'abc@web.de'),
	(4, 'lschmidt', '', '', 'xyz', 'xyz@web.de'),
	(5, 'juju', '', '', 'juju', 'juju@web.de'),
	(6, 'juju2', '', '', 'lustig', 'www@web.de'),
	(7, 'juju2', '', '', 'lustig', 'www@web.de');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle aufgabe_ebusiness.u_kategorie
DROP TABLE IF EXISTS `u_kategorie`;
CREATE TABLE IF NOT EXISTS `u_kategorie` (
  `u_KateID` int(11) NOT NULL,
  `u_Kate_Name` varchar(50) NOT NULL,
  `FK_Kategorie` int(11) NOT NULL,
  PRIMARY KEY (`u_KateID`),
  KEY `FK_u_kategorie_kategorie` (`FK_Kategorie`),
  CONSTRAINT `FK_u_kategorie_kategorie` FOREIGN KEY (`FK_Kategorie`) REFERENCES `kategorie` (`KategorieID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle aufgabe_ebusiness.u_kategorie: ~8 rows (ungefähr)
DELETE FROM `u_kategorie`;
/*!40000 ALTER TABLE `u_kategorie` DISABLE KEYS */;
INSERT INTO `u_kategorie` (`u_KateID`, `u_Kate_Name`, `FK_Kategorie`) VALUES
	(11, 'Küche', 1),
	(12, 'Wohnen', 1),
	(21, 'Blumen', 2),
	(22, 'Gartenwerkzeug', 2),
	(31, 'Sport', 3),
	(32, 'Musik', 3),
	(41, 'Nahrung', 4),
	(42, 'Spielzeug', 4);
/*!40000 ALTER TABLE `u_kategorie` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
