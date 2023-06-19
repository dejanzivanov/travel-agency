-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: localhost    Database: travel-agency
-- ------------------------------------------------------
-- Server version	8.0.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `policy_holder`
--

DROP TABLE IF EXISTS `policy_holder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `policy_holder` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `journey_start` date NOT NULL,
  `journey_end` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `policy_holder`
--

LOCK TABLES `policy_holder` WRITE;
/*!40000 ALTER TABLE `policy_holder` DISABLE KEYS */;
INSERT INTO `policy_holder` VALUES (1,'John','Doe','group','1234567890','2023-01-01','2023-01-10'),(2,'Jane','Smith','group','9876543210','2023-02-05','2023-02-12'),(3,'Michael','Johnson','group','5555555555','2023-03-10','2023-03-20'),(4,'Emily','Brown','individual','9999999999','2023-04-15','2023-04-25'),(5,'David','Lee','individual','1111111111','2023-05-20','2023-05-30'),(6,'Sarah','Wilson','individual','2222222222','2023-06-25','2023-07-05'),(7,'James','Anderson','individual','3333333333','2023-07-30','2023-08-08'),(8,'Olivia','Taylor','individual','4444444444','2023-08-15','2023-08-25'),(9,'Ethan','Martinez','individual','5555555555','2023-09-20','2023-09-30'),(10,'Ava','Thomas','individual','6666666666','2023-10-25','2023-11-04');
/*!40000 ALTER TABLE `policy_holder` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-15  8:06:12
