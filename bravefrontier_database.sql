-- MySQL dump 10.13  Distrib 5.5.44, for Linux (x86_64)
--
-- Host: localhost    Database: bravefrontier_database
-- ------------------------------------------------------
-- Server version	5.5.44

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `evolve`
--

DROP TABLE IF EXISTS `evolve`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evolve` (
  `heroid` int(5) NOT NULL,
  `parentid` int(5) DEFAULT NULL,
  `childid` int(5) DEFAULT NULL,
  `materials` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`heroid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `heros`
--

DROP TABLE IF EXISTS `heros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `heros` (
  `h_id` int(3) NOT NULL,
  `hero_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `star` int(2) NOT NULL,
  `prop` varchar(2) CHARACTER SET utf8 NOT NULL,
  `imgurl` varchar(255) CHARACTER SET utf8 NOT NULL,
  `maxlv` int(3) NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 NOT NULL,
  `cost` int(3) NOT NULL,
  `initial` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `lord` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `animal` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `breaker` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `guardian` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `oracle` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `bonus` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `leaderskill` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `leaderskill_zhtw` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `extraskill` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `extraskill_zhtw` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `bb` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `bb_zhtw` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `sbb` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `sbb_zhtw` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `ubb` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `ubb_zhtw` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `attacktimes` int(2) DEFAULT NULL,
  `bb_attacktimes` int(2) DEFAULT NULL,
  `sbb_attacktimes` int(2) DEFAULT NULL,
  PRIMARY KEY (`h_id`),
  UNIQUE KEY `h_id_2` (`h_id`),
  KEY `h_id` (`h_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-07-03  5:10:13
