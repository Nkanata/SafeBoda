-- MariaDB dump 10.19  Distrib 10.5.10-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: SafeBoda
-- ------------------------------------------------------
-- Server version	10.5.10-MariaDB-2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(50) NOT NULL,
  `gps_coordinates` varchar(100) NOT NULL,
  `promo_codes` int(11) NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'Safaricom Open Day','40.71727401 -74.00898606',10,'2021-07-31 18:00:00');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_codes`
--

DROP TABLE IF EXISTS `promo_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_code` varchar(10) NOT NULL,
  `amount` int(11) NOT NULL,
  `expiry` datetime NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `radius` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `promo_codes_unique` (`promo_code`),
  KEY `event foreign key` (`event`),
  CONSTRAINT `event foreign key` FOREIGN KEY (`event`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_codes`
--

LOCK TABLES `promo_codes` WRITE;
/*!40000 ALTER TABLE `promo_codes` DISABLE KEYS */;
INSERT INTO `promo_codes` VALUES (2,'c4e519',100,'2021-07-30 23:28:34','inactive',60,1),(3,'3b4886',100,'2021-07-30 23:28:34','active',70,1),(4,'3540fb',100,'2021-07-30 23:28:34','active',70,1),(5,'74d058',100,'2021-07-30 23:28:34','active',70,1),(6,'ceefd6',100,'2021-07-30 23:28:34','active',70,1),(7,'f07e63',100,'2021-07-30 23:28:34','active',70,1),(8,'90ad90',100,'2021-07-30 23:28:34','active',70,1),(9,'8b0a6f',100,'2021-07-30 23:28:34','active',70,1),(10,'0f22d4',100,'2021-07-30 23:28:34','active',70,1),(11,'ab82e6',100,'2021-07-30 23:28:34','active',70,1);
/*!40000 ALTER TABLE `promo_codes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-07-01 22:15:08
