# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.55-0ubuntu0.14.04.1)
# Database: comics
# Generation Time: 2017-07-31 08:41:22 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table city
# ------------------------------------------------------------

DROP TABLE IF EXISTS `city`;

CREATE TABLE `city` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lat` float DEFAULT NULL,
  `lng` float DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `state` char(2) DEFAULT NULL,
  `county` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;

INSERT INTO `city` (`id`, `lat`, `lng`, `city`, `state`, `county`)
VALUES
	(37,40.7504,-73.9963,'New York','NY','New York'),
	(38,40.7188,-73.9864,'New York','NY','New York'),
	(39,40.7302,-73.9886,'New York','NY','New York'),
	(40,40.6964,-74.0253,'New York','NY','New York'),
	(41,40.7069,-74.0087,'New York','NY','New York'),
	(42,40.7088,-74.0132,'New York','NY','New York'),
	(43,40.7139,-74.0074,'New York','NY','New York'),
	(44,40.7808,-73.9772,'New York','NY','New York'),
	(45,40.7277,-73.9804,'New York','NY','New York'),
	(46,40.7504,-73.9963,'New York','NY','New York'),
	(47,40.7188,-73.9864,'New York','NY','New York'),
	(48,40.7302,-73.9886,'New York','NY','New York'),
	(49,40.6964,-74.0253,'New York','NY','New York'),
	(50,40.7069,-74.0087,'New York','NY','New York'),
	(51,40.7088,-74.0132,'New York','NY','New York'),
	(52,40.7139,-74.0074,'New York','NY','New York'),
	(53,40.7808,-73.9772,'New York','NY','New York'),
	(54,40.7277,-73.9804,'New York','NY','New York'),
	(55,40.7504,-73.9963,'New York','NY','New York'),
	(56,40.7188,-73.9864,'New York','NY','New York'),
	(57,40.7302,-73.9886,'New York','NY','New York'),
	(58,40.6964,-74.0253,'New York','NY','New York'),
	(59,40.7069,-74.0087,'New York','NY','New York'),
	(60,40.7088,-74.0132,'New York','NY','New York'),
	(61,40.7139,-74.0074,'New York','NY','New York'),
	(62,40.7808,-73.9772,'New York','NY','New York'),
	(63,40.7277,-73.9804,'New York','NY','New York'),
	(64,40.7504,-73.9963,'New York','NY','New York'),
	(65,40.7188,-73.9864,'New York','NY','New York'),
	(66,40.7302,-73.9886,'New York','NY','New York'),
	(67,40.6964,-74.0253,'New York','NY','New York'),
	(68,40.7069,-74.0087,'New York','NY','New York'),
	(69,40.7088,-74.0132,'New York','NY','New York'),
	(70,40.7139,-74.0074,'New York','NY','New York'),
	(71,40.7808,-73.9772,'New York','NY','New York'),
	(72,40.7277,-73.9804,'New York','NY','New York'),
	(73,40.7504,-73.9963,'New York','NY','New York'),
	(74,40.7188,-73.9864,'New York','NY','New York'),
	(75,40.7302,-73.9886,'New York','NY','New York'),
	(76,40.6964,-74.0253,'New York','NY','New York'),
	(77,40.7069,-74.0087,'New York','NY','New York'),
	(78,40.7088,-74.0132,'New York','NY','New York'),
	(79,40.7139,-74.0074,'New York','NY','New York'),
	(80,40.7808,-73.9772,'New York','NY','New York'),
	(81,40.7277,-73.9804,'New York','NY','New York');

/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table superheroes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `superheroes`;

CREATE TABLE `superheroes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(64) DEFAULT NULL,
  `lastname` varchar(64) DEFAULT NULL,
  `codename` varchar(64) DEFAULT NULL,
  `team` varchar(64) DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `lng` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `superheroes` WRITE;
/*!40000 ALTER TABLE `superheroes` DISABLE KEYS */;

INSERT INTO `superheroes` (`id`, `firstname`, `lastname`, `codename`, `team`, `lat`, `lng`)
VALUES
	(1,'Bruce','Banner','Hulk','Avengers',33.9739,-118.248),
	(3,'Bruce','Wayne','Batman','Justice League',33.7866,-118.299),
	(4,'Scott','Summers','Cyclops','X-Men',34.0083,-118.196),
	(5,'Clark','Kent','Superman','Justice League',90.7866,-130.299),
	(13,'Dick','Grayson','Nightwing','Teen Titans',33.9909,-118.153),
	(14,'Tony','Stark','Iron Man','Avengers',33.8966,-118.176),
	(16,'Jane','Foster','Thor','Avengers',34.0146,-118.226),
	(17,'Linda','Carter','Wonder Woman','Justice League',33.9994,-118.213);

/*!40000 ALTER TABLE `superheroes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table udoo_data
# ------------------------------------------------------------

DROP TABLE IF EXISTS `udoo_data`;

CREATE TABLE `udoo_data` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `datetime` timestamp NULL DEFAULT NULL,
  `lat` decimal(10,6) DEFAULT NULL,
  `lng` decimal(10,6) DEFAULT NULL,
  `s1` int(11) DEFAULT NULL,
  `s2` int(11) DEFAULT NULL,
  `s3` int(11) DEFAULT NULL,
  `s4` int(11) DEFAULT NULL,
  `s5` int(11) DEFAULT NULL,
  `s6` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `udoo_data` WRITE;
/*!40000 ALTER TABLE `udoo_data` DISABLE KEYS */;

INSERT INTO `udoo_data` (`id`, `datetime`, `lat`, `lng`, `s1`, `s2`, `s3`, `s4`, `s5`, `s6`)
VALUES
	(29,'2017-07-11 12:22:00',38.000000,-118.000000,2,8,8,0,202,4);

/*!40000 ALTER TABLE `udoo_data` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
