-- MySQL dump 10.13  Distrib 8.0.19, for macos10.15 (x86_64)
--
-- Host: localhost    Database: wf3zoo
-- ------------------------------------------------------
-- Server version	5.7.26
--
-- Table structure for table `animal`
--

DROP DATABASE IF EXISTS `wf3zoo`;
CREATE DATABASE IF NOT EXISTS `wf3zoo`;
USE `wf3zoo`;
DROP TABLE IF EXISTS `animal`;

CREATE TABLE `animal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `espece` varchar(150) DEFAULT NULL,
  `nom` varchar(70) DEFAULT NULL,
  `taille` int(11) DEFAULT NULL,
  `poids` int(11) DEFAULT NULL,
  `date_de_naissance` datetime DEFAULT NULL,
  `pays_origine` varchar(50) DEFAULT NULL,
  `sexe` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `animal`
--animal

LOCK TABLES `animal` WRITE;
/*!40000 ALTER TABLE `animal` DISABLE KEYS */;
INSERT INTO `animal` VALUES (1,'lion','Nala',70,6000,'1991-05-01 00:00:00','Kenya',0),(2,'lion','Simba',82,6750,'1991-05-01 00:00:00','Kenya',1),(3,'panthère rose','La Panthère Rose',93,8560,'1994-06-04 00:00:00','France',1),(4,'panthère noire','Bagheera',103,12300,'1950-05-04 00:00:00','Inde',1);
/*!40000 ALTER TABLE `animal` ENABLE KEYS */;
UNLOCK TABLES;

