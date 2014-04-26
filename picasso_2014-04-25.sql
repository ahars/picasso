-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 25, 2014 at 01:46 PM
-- Server version: 5.5.37-0ubuntu0.13.10.1
-- PHP Version: 5.5.3-1ubuntu2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `picasso`
--

-- --------------------------------------------------------

--
-- Table structure for table `bieres`
--

CREATE TABLE IF NOT EXISTS `bieres` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `bieres`
--

INSERT INTO `bieres` (`id`, `nom`, `description`, `category`, `prix`, `degre`, `img_url`, `semaine`, `disabled`) VALUES
(1, 'Cuvée des trolls', '', 'PRESSION', 1.69, 7, NULL, '', 0),
(2, 'Barbar blonde', '', 'PRESSION', 1.6, 8, NULL, '', 0),
(3, 'Mc Chouffe', '', 'PRESSION', 1.85, 8, NULL, '', 0),
(4, 'Gauloise rouge', '', 'PRESSION', 1.7, 8.2, NULL, '', 0),
(5, 'Karmeliet', '', 'PRESSION', 1.7, 8, NULL, '', 0),
(6, 'Kwak', '', 'PRESSION', 1.6, 8.1, NULL, '', 0),
(7, 'Délirium', '', 'PRESSION', 1.7, 8.5, NULL, '', 0),
(8, 'Barbar Bok', '', 'PRESSION', 1.6, 8.5, NULL, '', 0),
(9, 'Scotch Silly', '', 'BOUTEILLE', 1.5, 8, NULL, '', 0),
(10, 'St Feuillien grand cru', '', 'BOUTEILLE', 1.9, 9.5, NULL, '', 0),
(11, 'Carolus triple', '', 'BOUTEILLE', 1.65, 9, NULL, '', 0),
(12, 'Chimay bleue', '', 'BOUTEILLE', 1.75, 9, NULL, '', 0),
(13, 'Pêche Mel Bush', '', 'BOUTEILLE', 1.6, 8.5, NULL, '', 0),
(14, 'Duvel', '', 'BOUTEILLE', 1.5, 8.5, NULL, '', 0),
(15, 'Westmalle triple', '', 'BOUTEILLE', 1.65, 9.5, NULL, '', 0),
(16, 'Rochefort 8', '', 'BOUTEILLE', 1.9, 9.2, NULL, '', 0),
(17, 'Père Canard', '', 'BOUTEILLE', 1.65, 9, NULL, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `goodies`
--

CREATE TABLE IF NOT EXISTS `goodies` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `semaine` char(8) NOT NULL,
  `numero` int(11) NOT NULL,
  `nom` varchar(80) NOT NULL DEFAULT '',
  `prenom` varchar(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=97 ;

-- --------------------------------------------------------

--
-- Table structure for table `snacks`
--

CREATE TABLE IF NOT EXISTS `snacks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL DEFAULT '',
  `description` text,
  `prix` float unsigned NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `snacks`
--

INSERT INTO `snacks` (`id`, `nom`, `description`, `prix`, `disabled`) VALUES
(1, 'Crackers Belin', '', 0.7, 0),
(2, 'Cacahuètes', '', 0.6, 0),
(3, 'Chip''s', '', 0.35, 0),
(4, 'Nouilles instantanées', '', 1.6, 0),
(5, 'Saucisson', '', 0.6, 0),
(6, 'Barre Côte d''Or-Noisette', '', 0.5, 0),
(7, 'Bounty', '', 0.5, 0),
(8, 'Carambar', '', 0.1, 0),
(9, 'Céréales', '', 0.5, 0),
(10, 'Kinder Bueno', '', 0.6, 0),
(11, 'Kinder Surprise', '', 0.8, 0),
(12, 'Kit Kat', '', 0.5, 0),
(13, 'M&M''s', '', 0.5, 0),
(14, 'Malabar', '', 0.1, 0),
(15, 'Mini BN', '', 0.4, 0),
(16, 'Pom''Pote', '', 0.4, 0),
(17, 'Sachet Haribo', '', 0.3, 0),
(18, 'Smarties', '', 0.5, 0),
(19, 'Snickers', '', 0.5, 0),
(20, 'Tête Brulée', '', 0.07, 0),
(21, 'Tic Tac Duo', '', 0.6, 0),
(22, 'Twix', '', 0.5, 0),
(23, 'Mr. Freeze Cola', '', 0.3, 0),
(24, 'Snickers glacé', '', 0.5, 0),
(25, 'Mars glacé', '', 0.5, 0),
(26, 'Twix glacé', '', 0.5, 0),
(27, 'P''tit Yop', '', 0.6, 0),
(28, 'Croissant', '', 0.55, 0),
(29, 'Pain au chocolat', '', 0.65, 0);

-- --------------------------------------------------------

--
-- Table structure for table `softs`
--

CREATE TABLE IF NOT EXISTS `softs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL DEFAULT '',
  `description` text,
  `prix` float unsigned NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `softs`
--

INSERT INTO `softs` (`id`, `nom`, `description`, `prix`, `disabled`) VALUES
(1, 'Pampryl', '', 0.8, 0),
(2, 'Burn', '', 1.1, 0),
(3, 'Coca', '', 0.7, 0),
(4, 'Coca light', '', 0.7, 0),
(5, 'Coca zero', '', 0.7, 0),
(6, 'Coca cherry', '', 0.7, 0),
(7, 'Fanta orange', '', 0.7, 0),
(8, 'Ice tea pêche', '', 0.7, 0),
(9, 'Schweppes lemon', '', 0.7, 0),
(10, 'Perrier', '', 0.7, 0),
(11, 'Sprite', '', 0.7, 0),
(12, 'Oasis tropical', '', 0.7, 0),
(13, 'Soft du mois', '', 0.7, 0),
(14, 'Café', '', 0.4, 0),
(15, 'Café double', '', 0.7, 0),
(16, 'Thé', '', 0.2, 0),
(17, 'Cécémel', '', 0.85, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `login` char(8) NOT NULL DEFAULT '',
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`login`) VALUES
('garciaxa'),
('harsanto'),
('lainevin'),
('roddehug');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
