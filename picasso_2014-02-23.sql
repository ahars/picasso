# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Hôte: 127.0.0.1 (MySQL 5.6.11)
# Base de données: picasso
# Temps de génération: 2014-02-23 16:20:44 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Affichage de la table bieres
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bieres`;

CREATE TABLE `bieres` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL DEFAULT '',
  `description` varchar(255) DEFAULT NULL,
  `category` enum('PRESSION','BOUTEILLE') NOT NULL DEFAULT 'PRESSION',
  `prix` float unsigned NOT NULL,
  `degre` float unsigned NOT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  `semaine` char(8) DEFAULT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `bieres` WRITE;
/*!40000 ALTER TABLE `bieres` DISABLE KEYS */;

INSERT INTO `bieres` (`id`, `nom`, `description`, `category`, `prix`, `degre`, `img_url`, `semaine`, `disabled`)
VALUES
	(68,'COUCOU','Descriptionvvervv','PRESSION',1.67,8.7,NULL,'2013-W50',0);

/*!40000 ALTER TABLE `bieres` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table goodies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `goodies`;

CREATE TABLE `goodies` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `semaine` char(8) NOT NULL,
  `numero` int(11) NOT NULL,
  `nom` varchar(80) NOT NULL DEFAULT '',
  `prenom` varchar(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `goodies` WRITE;
/*!40000 ALTER TABLE `goodies` DISABLE KEYS */;

INSERT INTO `goodies` (`id`, `semaine`, `numero`, `nom`, `prenom`)
VALUES
	(1,'2013-W49',1,'Roddeh','Hugo'),
	(79,'2013-W49',12,'ea','ffezafegggg'),
	(82,'2013-W49',24,'Pk pas','Je ne sais pas a'),
	(84,'2010-W51',33,'nkljlMaguc','Queots'),
	(85,'2013-W49',67,'Rodde','Hgzdza'),
	(86,'2013-W05',1,'Rodde','HugoHURE'),
	(90,'2013-W51',67,'ERTYU','FRGHJ'),
	(91,'2013-W48',78,'ERTY','FGHJ'),
	(92,'2013-W51',456,'FGH','TYU56789'),
	(93,'2013-W49',1,'Hugo','Rodde'),
	(94,'2013-W49',1,'Hugo','RODde'),
	(95,'2013-W51',56,'HUgààà','dzadz'),
	(96,'2013-W49',1,'ROdde','Hugo');

/*!40000 ALTER TABLE `goodies` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table snacks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `snacks`;

CREATE TABLE `snacks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL DEFAULT '',
  `description` text,
  `prix` float unsigned NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `snacks` WRITE;
/*!40000 ALTER TABLE `snacks` DISABLE KEYS */;

INSERT INTO `snacks` (`id`, `nom`, `description`, `prix`, `disabled`)
VALUES
	(1,'Snickers','Description',0.64,0),
	(48,'Arthur','Description',4.8,1);

/*!40000 ALTER TABLE `snacks` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table softs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `softs`;

CREATE TABLE `softs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL DEFAULT '',
  `description` text,
  `prix` float unsigned NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `softs` WRITE;
/*!40000 ALTER TABLE `softs` DISABLE KEYS */;

INSERT INTO `softs` (`id`, `nom`, `description`, `prix`, `disabled`)
VALUES
	(45,'Coucou','Description',2.7,1);

/*!40000 ALTER TABLE `softs` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `login` char(8) NOT NULL DEFAULT '',
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`login`)
VALUES
	('garciaxa'),
	('lainevin'),
	('roddehug');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
