CREATE DATABASE  IF NOT EXISTS `bothniabladet` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bothniabladet`;
-- MySQL dump 10.13  Distrib 8.0.24, for Win64 (x86_64)
--
-- Host: localhost    Database: bothniabladet
-- ------------------------------------------------------
-- Server version	8.0.24

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
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `image` (
  `ID_image` int NOT NULL AUTO_INCREMENT,
  `imageURL` varchar(500) NOT NULL,
  `resolution` varchar(45) DEFAULT NULL,
  `file_size` int DEFAULT NULL,
  `file_type` varchar(45) DEFAULT NULL,
  `GPS_coordinates` varchar(255) DEFAULT NULL,
  `photographer` varchar(100) DEFAULT NULL,
  `location` varchar(500) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `camera` varchar(255) DEFAULT NULL,
  `limited_usage` int NOT NULL DEFAULT '-1',
  `published` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_image`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
INSERT INTO `image` VALUES (97,'/BivFCvZ1/DSCN0042.jpg','300/1x300/1',156695,'image/jpeg','N;43/1;27/1;520380000/10000000;E;11/1;52/1;53322/1000','Lukas ','Spanien','2008-10-22 17:00:07','NIKON COOLPIX P6000',-1,1),(98,'/qn4sbBst/DSCN0040.jpg','300/1x300/1',152893,'image/jpeg','N;43/1;27/1;576419999/10000000;E;11/1;52/1;448019999/10000000','Linus','Spanien','2008-10-22 16:55:37','NIKON COOLPIX P6000',-1,1),(99,'/Fye0DFZa/DSCN0038.jpg','300/1x300/1',157569,'image/jpeg','N;43/1;28/1;211799999/100000000;E;11/1;52/1;451680000/10000000','Simon','Spanien','2008-10-22 16:52:15','NIKON COOLPIX P6000',-1,1),(100,'/sQz7gGmG/DSCN0029.jpg','300/1x300/1',150085,'image/jpeg','N;43/1;28/1;567599999/100000000;E;11/1;52/1;486179999/10000000','Christoffer','Spanien','2008-10-22 16:46:53','NIKON COOLPIX P6000',-1,1),(101,'/uvLOEyYg/DSCN0027.jpg','300/1x300/1',157723,'image/jpeg','N;43/1;28/1;639000000/100000000;E;11/1;52/1;534540000/10000000','Albin','Spanien','2008-10-22 16:44:01','NIKON COOLPIX P6000',-1,1),(102,'/j7tADcfD/DSCN0025.jpg','300/1x300/1',150301,'image/jpeg','N;43/1;28/1;611400000/100000000;E;11/1;52/1;538859999/10000000','Lukas','Spanien','2008-10-22 16:43:21','NIKON COOLPIX P6000',-1,1),(103,'/CRjlWSn9/DSCN0025.jpg','300/1x300/1',150301,'image/jpeg','N;43/1;28/1;611400000/100000000;E;11/1;52/1;538859999/10000000','Albin','Spanien','2008-10-22 16:43:21','NIKON COOLPIX P6000',-1,1),(104,'/fWlS4h9O/DSCN0021.jpg','300/1x300/1',157382,'image/jpeg','N;43/1;28/1;149399999/100000000;E;11/1;53/1;433799999/100000000','Linus','Spanien','2008-10-22 16:38:20','NIKON COOLPIX P6000',-1,1),(105,'/YCsryqor/DSCN0012.jpg','300/1x300/1',159137,'image/jpeg','N;43/1;28/1;176399999/100000000;E;11/1;53/1;742199999/100000000','Simon','Spanien','2008-10-22 16:29:49','NIKON COOLPIX P6000',-1,1),(106,'/3XvMOlWG/DSCN0010.jpg','300/1x300/1',161713,'image/jpeg','N;43/1;28/1;281400000/100000000;E;11/1;53/1;645599999/100000000','Simon','Spanien','2008-10-22 16:28:39','NIKON COOLPIX P6000',-1,1);
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoice` (
  `ID_invoice` int NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `payment_term` varchar(255) DEFAULT NULL,
  `member_ID_member` int NOT NULL,
  PRIMARY KEY (`ID_invoice`),
  KEY `fk_invoice_member1_idx` (`member_ID_member`),
  CONSTRAINT `fk_invoice_member1` FOREIGN KEY (`member_ID_member`) REFERENCES `member` (`ID_member`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
INSERT INTO `invoice` VALUES (1,'2021-05-30 00:00:00','kontant',1),(2,'2021-03-30 00:00:00','faktura',1),(3,'2021-05-30 00:00:00','utebliven',2),(4,'2021-05-30 00:00:00','inkasso',1),(5,'2021-04-30 00:00:00','postgiro',2),(6,'2021-05-30 00:00:00','gratis',3);
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_has_image`
--

DROP TABLE IF EXISTS `invoice_has_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoice_has_image` (
  `ID_invoice_has_image` int NOT NULL AUTO_INCREMENT,
  `Invoice_ID_invoice` int NOT NULL,
  `image_ID_image` int NOT NULL,
  PRIMARY KEY (`ID_invoice_has_image`),
  KEY `fk_Invoice_has_Image_Invoice_idx` (`Invoice_ID_invoice`),
  KEY `fk_invoice_has_image_image1_idx` (`image_ID_image`),
  CONSTRAINT `fk_invoice_has_image_image1` FOREIGN KEY (`image_ID_image`) REFERENCES `image` (`ID_image`),
  CONSTRAINT `fk_Invoice_has_Image_Invoice` FOREIGN KEY (`Invoice_ID_invoice`) REFERENCES `invoice` (`ID_invoice`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_has_image`
--

LOCK TABLES `invoice_has_image` WRITE;
/*!40000 ALTER TABLE `invoice_has_image` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_has_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keyword`
--

DROP TABLE IF EXISTS `keyword`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `keyword` (
  `ID_keyword` int NOT NULL AUTO_INCREMENT,
  `keyword` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_keyword`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keyword`
--

LOCK TABLES `keyword` WRITE;
/*!40000 ALTER TABLE `keyword` DISABLE KEYS */;
INSERT INTO `keyword` VALUES (1,'Prinsessan'),(27,'simon'),(33,'golv'),(34,'tavla'),(35,'kyrka'),(36,'spanien'),(37,'träd'),(38,'lukas'),(39,'linus'),(40,'christoffer'),(41,'albin'),(42,'torg');
/*!40000 ALTER TABLE `keyword` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keyword_has_image`
--

DROP TABLE IF EXISTS `keyword_has_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `keyword_has_image` (
  `ID_keyword_has_image` int NOT NULL AUTO_INCREMENT,
  `Key_word_ID_key_word` int NOT NULL,
  `Image_ID_image` int NOT NULL,
  PRIMARY KEY (`ID_keyword_has_image`),
  KEY `fk_Key_word_has_Image_Image1_idx` (`Image_ID_image`),
  KEY `fk_Key_word_has_Image_Key_word1_idx` (`Key_word_ID_key_word`),
  CONSTRAINT `fk_Key_word_has_Image_Image1` FOREIGN KEY (`Image_ID_image`) REFERENCES `image` (`ID_image`),
  CONSTRAINT `fk_Key_word_has_Image_Key_word1` FOREIGN KEY (`Key_word_ID_key_word`) REFERENCES `keyword` (`ID_keyword`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keyword_has_image`
--

LOCK TABLES `keyword_has_image` WRITE;
/*!40000 ALTER TABLE `keyword_has_image` DISABLE KEYS */;
INSERT INTO `keyword_has_image` VALUES (46,35,97),(47,36,97),(48,36,98),(49,36,99),(50,36,100),(51,36,101),(52,35,101),(53,36,102),(54,36,103),(55,36,104),(56,37,104),(57,36,105),(58,37,105),(59,36,106),(60,38,97),(61,39,98),(62,27,99),(63,40,100),(64,41,101),(65,38,102),(66,41,103),(67,39,104),(68,27,105),(69,27,106),(70,42,101),(71,42,98);
/*!40000 ALTER TABLE `keyword_has_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member` (
  `ID_member` int NOT NULL AUTO_INCREMENT,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `city` varchar(45) DEFAULT NULL,
  `postal` varchar(45) DEFAULT NULL,
  `street` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `discount_amount` int DEFAULT '0',
  `member_type` enum('m','c') NOT NULL,
  PRIMARY KEY (`ID_member`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` VALUES (1,'lukas123','Lukas','Skog','Linkoping','58233','Gullbergsgatan 10','0712312311','lukas@hotmail.com',40,'m'),(2,'simon123','Simon','Nilsson','Skellefteå','12312','Gladagatan 2','0743534543','simon@hotmail.com',0,'c'),(3,'christoffer123','Lindberg','Anka','Göteborg','42325','Argagatan 5','0723442354','christoffer@hotmail.com',0,'m'),(4,'linus123','Linus','Marjavaara Lindahl','Skellefteå','23464','Vigatan 2','0777732423','Linus@hotmail.com',0,'c'),(5,'albin123','Albin','Dahlgren','Linkoping','34535','Ombergsgatan 27','0456464543','albin@hotmail.com',0,'c'),(6,'hej','Daniel','Daggmask','Skellefteå','43534','Borsallé 75','0567456346','daniel.daggmask@hotmail.com',0,'c'),(7,'hej','Elsa','Ekorre','Göteborg','23411','Drottninggatan 23','0523423422','elsa.ekorre@hotmail.com',8,'c'),(8,'hej','Fiona','Fisk','Göteborg','42132','Storgatan 45','0564523433','fiona.fisk@hotmail.com',7,'c'),(9,'hej','Gustav','Groda','Linkoping','31232','Gatan 5','0723423423','gustav.groda@hotmail.com',30,'c'),(10,'hej','Hanna’','Haj','Göteborg','23141','Köpingsgränd 52','013-23123','hanna.haj@hotmail.com',5,'c'),(11,'hej','Ingrid','Igelkott','Göteborg','15135','Fulgatan 1','0724235512','ingrid.igelkott@hotmail.com',10,'c'),(12,'hej','Carl','Gustaf','staden','12341','Finagatan 3','013-512321','carl_cool_gustaf@yahoo.com',0,'c'),(17,'david123','David','Davidsson','staden','11111','gatan 2','010-111111','david@hotmail.com',0,'c');
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-17 17:12:46
