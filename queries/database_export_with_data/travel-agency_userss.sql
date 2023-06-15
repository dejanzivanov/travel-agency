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
-- Table structure for table `userss`
--

DROP TABLE IF EXISTS `userss`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userss` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `account_type` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userss`
--

LOCK TABLES `userss` WRITE;
/*!40000 ALTER TABLE `userss` DISABLE KEYS */;
INSERT INTO `userss` VALUES (1,'John','Doe','john@example.com','password','user','2023-01-01 11:00:00','2023-01-01 11:00:00'),(2,'Jane','Smith','jane@example.com','password','admin','2023-02-02 13:30:00','2023-02-02 13:30:00'),(3,'Michael','Johnson','michael@example.com','password','user','2023-03-05 07:45:00','2023-03-05 07:45:00'),(4,'Emily','Brown','emily@example.com','password','user','2023-04-08 09:20:00','2023-04-08 09:20:00'),(5,'David','Lee','david@example.com','password','user','2023-05-10 14:30:00','2023-05-10 14:30:00'),(6,'Sarah','Wilson','sarah@example.com','password','admin','2023-06-13 17:15:00','2023-06-13 17:15:00'),(7,'James','Anderson','james@example.com','password','user','2023-07-16 20:45:00','2023-07-16 20:45:00'),(8,'Olivia','Taylor','olivia@example.com','password','user','2023-08-19 04:30:00','2023-08-19 04:30:00'),(9,'Ethan','Martinez','ethan@example.com','password','admin','2023-09-22 07:00:00','2023-09-22 07:00:00'),(10,'Ava','Thomas','ava@example.com','password','user','2023-10-25 12:20:00','2023-10-25 12:20:00'),(11,'Deki','Deki','deki@deki.com','password','admin','2023-10-25 12:20:00','2023-10-25 12:20:00');
/*!40000 ALTER TABLE `userss` ENABLE KEYS */;
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
