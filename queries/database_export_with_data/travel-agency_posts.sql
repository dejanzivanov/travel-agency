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
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published_at` timestamp NULL DEFAULT NULL,
  `archived_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bodyText` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('news','post') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('published','archived','in_preparation') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'John','2023-01-01 11:00:00','2023-01-02 09:00:00',NULL,'Post 1 Title','Bacon ipsum dolor amet burgdoggen pork loin pork, corned beef sirloin filet mignon shankle swine frankfurter ground round kevin jowl porchetta. Landjaeger rump cow short ribs, pastrami chuck pork chop jowl chislic pancetta salami spare ribs meatloaf alcatra. Pork tri-tip bresaola chislic t-bone, beef picanha filet mignon pork belly buffalo. Pork belly hamburger tenderloin, drumstick tri-tip ribeye cow spare ribs fatback.','Text...','/public/1.jpg','post','published'),(2,'Jane','2023-02-02 13:30:00','2023-02-03 08:45:00','2023-02-05 11:00:00','Post 2 Title','Ham hock bacon corned beef, cupim pancetta strip steak pastrami leberkas flank chislic. Chicken turducken pork doner brisket sausage, capicola flank shoulder beef. Venison pastrami jowl, shank bacon beef ribs leberkas chislic swine. Andouille meatloaf tail prosciutto biltong chuck, brisket corned beef drumstick salami tongue tri-tip landjaeger doner bresaola. Drumstick meatball flank burgdoggen. Capicola andouille buffalo pastrami, swine beef ribs meatloaf sirloin burgdoggen t-bone frankfurter pig corned beef boudin.','Text...','/public/2.jpg','post','archived'),(3,'John','2023-03-05 07:45:00',NULL,NULL,'Post 3 Title','Ham prosciutto turkey frankfurter chislic. Short ribs burgdoggen boudin leberkas pork hamburger chicken cow beef turkey drumstick. Tail shoulder prosciutto, filet mignon short loin kevin pork loin beef ribs salami tenderloin jowl tri-tip shankle chicken. Turkey spare ribs rump alcatra burgdoggen picanha shoulder. Chicken ham pork belly hamburger. Pork tri-tip fatback shoulder frankfurter meatball brisket chuck sausage shank prosciutto. Chicken tenderloin drumstick, tongue prosciutto pork belly andouille short loin turkey pastrami jerky spare ribs landjaeger buffalo.','Text...','/public/3.jpg','news','in_preparation'),(4,'Jane','2023-04-08 09:20:00','2023-04-09 12:00:00',NULL,'Post 4 Title','Meatball shank shankle ball tip, beef tongue brisket buffalo cupim pork belly ribeye chislic. Tongue burgdoggen jerky pork chop. Landjaeger tri-tip kevin, jowl meatball corned beef venison. Chicken jowl ribeye tri-tip salami hamburger. Flank chuck brisket pastrami, tail boudin pork loin shoulder bresaola spare ribs biltong andouille chislic. Kevin fatback picanha tail short loin ball tip chicken brisket landjaeger cow short ribs prosciutto.','Text...','/public/4.jpg','post','published'),(5,'John','2023-05-10 14:30:00',NULL,NULL,'Post 5 Title','Jowl ribeye jerky, brisket ball tip tail ground round shoulder chuck pig venison tongue. Biltong kielbasa leberkas, tri-tip picanha salami hamburger rump porchetta tail buffalo brisket short loin. Chuck prosciutto porchetta, ham pastrami kevin beef ribs frankfurter andouille shoulder burgdoggen pancetta short loin. Beef spare ribs picanha cupim fatback andouille chuck chicken swine pork chop buffalo ham hock, alcatra frankfurter. Short ribs cupim turkey, porchetta strip steak boudin pastrami t-bone landjaeger venison. Corned beef flank shoulder pastrami pig shankle tenderloin prosciutto kielbasa beef ribs ham hock cupim boudin.','Text...','/public/5.jpg','news','in_preparation'),(6,'Jane','2023-06-13 17:15:00','2023-06-14 06:00:00',NULL,'Post 6 Title','T-bone chislic ball tip turkey, cow shank doner ribeye chicken bacon jerky capicola. Pork beef ribs pig, boudin pork loin kevin capicola meatloaf. Jowl corned beef porchetta, short loin alcatra pancetta bacon spare ribs chuck ribeye. Porchetta prosciutto landjaeger pastrami, meatloaf pork belly chicken strip steak chuck sirloin salami brisket shank. Pork chislic beef ribs turkey, bacon tri-tip sausage flank. Kevin rump cow shank bresaola tenderloin tri-tip.','Text...','/public/6.jpg','post','published'),(7,'John','2023-07-16 20:45:00',NULL,NULL,'Post 7 Title','Beef ground round venison, bresaola t-bone brisket ham shank swine fatback tenderloin pig boudin. Prosciutto andouille turkey chislic, bacon meatloaf pig flank chuck alcatra shoulder t-bone cow pancetta landjaeger. Swine shoulder ground round brisket frankfurter biltong, shankle prosciutto kielbasa venison. Beef ribs drumstick tail pancetta chuck, pork biltong andouille cupim tri-tip porchetta ham sirloin shank pork chop. Pastrami andouille ham hock, bresaola short loin sausage cupim bacon frankfurter jerky beef ribs jowl picanha.','Text...','/public/7.jpg','news','in_preparation'),(8,'Jane','2023-08-19 04:30:00',NULL,NULL,'Post 8 Title','Salami fatback t-bone picanha doner bresaola spare ribs capicola. Kielbasa corned beef chicken ribeye landjaeger turkey. Strip steak chislic t-bone beef ribs beef porchetta pork loin spare ribs rump ribeye doner bacon biltong. Bacon pig rump tenderloin buffalo capicola shankle meatball pancetta ground round brisket. Pig leberkas ribeye ham hock turkey shankle swine shoulder tenderloin beef ribs kevin prosciutto hamburger. Alcatra chicken ribeye leberkas, cupim bacon turkey porchetta andouille pork loin sirloin ground round drumstick.','Text...','/public/8.jpeg','news','in_preparation'),(9,'John','2023-09-22 07:00:00','2023-09-23 09:30:00',NULL,'Post 9 Title','Cupim doner buffalo biltong landjaeger ball tip. Prosciutto pork cupim, sirloin beef pastrami porchetta pork chop. Filet mignon chuck ham beef brisket fatback leberkas cow ball tip. Meatball ground round venison, capicola corned beef turkey kevin pig pork loin kielbasa flank spare ribs doner short ribs. Capicola meatball porchetta picanha bresaola. Venison burgdoggen fatback spare ribs pork loin. Biltong turkey cupim, shankle landjaeger buffalo flank pastrami filet mignon tongue kielbasa.','Text...','/public/9.jpg','post','published'),(10,'Jane','2023-10-25 12:20:00',NULL,NULL,'Post 10 Title','Frankfurter pork rump jerky flank buffalo, burgdoggen andouille ribeye shankle fatback beef picanha swine. Rump bacon swine, ribeye corned beef beef doner pastrami jowl venison pork loin. Swine chicken meatloaf beef ribs ham salami. Cow capicola burgdoggen, meatball spare ribs picanha ball tip jowl porchetta pig drumstick.','Text...','/public/10.jpg','news','in_preparation');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-15  8:06:11
