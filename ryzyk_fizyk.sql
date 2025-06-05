-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: ryzyk_fizyk
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Current Database: `ryzyk_fizyk`
--

/*!40000 DROP DATABASE IF EXISTS `ryzyk_fizyk`*/;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `ryzyk_fizyk` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `ryzyk_fizyk`;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `IdQuestion` int(11) NOT NULL AUTO_INCREMENT,
  `Content` varchar(255) DEFAULT NULL,
  `Answer` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdQuestion`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES 
(1, 'Jaka jest długość równika?', 40075),
(2, 'Ile krajów jest w Unii Europejskiej?', 27),
(3, 'Ile dni ma rok w kalendarzu gregoriańskim?', 365),
(4, 'Ile lat trwa kadencja prezydenta w Polsce?', 5),
(5, 'Ile osób jest w drużynie siatkarskiej?', 6),
(6, 'Ile lat ma przeciętny pies w ludzkich latach po 2. roku życia?', 7),
(7, 'Ile godzin trwa lot z Warszawy do Nowego Jorku?', 10),
(8, 'Ile liter ma alfabet polski?', 32),
(9, 'Ile złotych wynosi minimalne wynagrodzenie w Polsce (2025)?', 3600),
(10, 'Ile dni ma luty w roku przestępnym?', 29),
(11, 'Ile kilometrów ma długość Polski od północy do południa?', 650),
(12, 'Ile lat trwa średnia długość życia człowieka w Polsce?', 78),
(13, 'Ile miesięcy trwa sezon letni w Polsce?', 3),
(14, 'Ile górskich szczytów w Polsce ma wysokość powyżej 2000 m n.p.m.?', 3),
(15, 'Ile lat ma najstarszy uniwersytet w Polsce?', 650),
(16, 'Ile dni trwa festiwal w Opolu?', 3),
(17, 'Ile osób jest w drużynie piłkarskiej na boisku?', 11),
(18, 'Ile lat ma przeciętny kot w ludzkich latach po 2. roku życia?', 12),
(19, 'Ile kilometrów ma długość Wisły?', 1047),
(20, 'Ile lat trwa kadencja posła w Polsce?', 4);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'ryzyk_fizyk'
--

--
-- Dumping routines for database 'ryzyk_fizyk'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-05  9:58:13
