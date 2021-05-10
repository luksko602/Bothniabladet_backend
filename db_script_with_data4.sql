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
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
INSERT INTO `image` VALUES (45,'/h83G92ok/tim-swaan-eOpewngf68w-unsplash.jpg','720p',5879551,'image/jpeg','','Simon','Norrland','2021-05-06 16:00:39','',4,1),(46,'/ATtgk6oq/simon-english-48nerZQCHgo-unsplash.jpg','480p',2542398,'image/jpeg','','Simpan','Fjället','2021-05-06 16:00:55','',0,1),(47,'/6wsfnU2X/patrick-szylar-45bM3XGqnDE-unsplash.jpg','480p',2009364,'image/jpeg','','Chrizze','Feskekörka','2021-05-06 16:01:02','',3,0),(48,'/ChQ2Jhfv/miguel-ibanez-cO7zI0lqzqI-unsplash.jpg','720p',2802263,'image/jpeg','','Lukas','Linköping','2021-05-06 16:02:13','',-1,0),(49,'/ylp0rR1z/mickey-o-neil-xL66l--msXU-unsplash.jpg','480p',874529,'image/jpeg','','Lukas','Linköping','2021-05-06 16:02:43','Canon',0,0),(50,'/1psNY2Ay/matthew-smith-rFBA42UFpLs-unsplash.jpg','1080p',3129157,'image/jpeg','','Lukas','Linköping','2021-05-06 16:04:31','Canon',0,1),(51,'/aCwhBYy1/james-wheeler-ZOA-cqKuJAA-unsplash.jpg','1080p',787775,'image/jpeg','','Lukas','Linköping','2021-05-06 16:04:58','Canon',0,0),(52,'/KhPOCd99/holly-mandarich-UVyOfX3v0Ls-unsplash.jpg','1080p',4616903,'image/jpeg','','Lukas','Linköping','2021-05-06 16:05:04','Canon',-1,1),(53,'/ogCLAtVk/cosmic-timetraveler-jQvOExlroYA-unsplash.jpg','1080p',5360786,'image/jpeg','','Lukas','Linköping','2021-05-06 16:05:10','Canon',-1,1),(54,'/99zLbRul/charles-black-F7HGqkkMYAU-unsplash.jpg','1080p',6542768,'image/jpeg','','Lukas','Linköping','2021-05-06 16:05:14','Canon',-1,0),(55,'/a7NSGJs9/aaron-burden-b9drVB7xIOI-unsplash.jpg','1080p',3317165,'image/jpeg','','Lukas','Linköping','2021-05-06 16:05:18','Canon',-1,1),(56,'/fEqcwD9d/aaron-burden-b9drVB7xIOI-unsplash.jpg','1080p',3317165,'image/jpeg','','Lukas','Linköping','2021-05-10 06:30:42','Canon',4,1),(57,'/OGRlNPNW/aaron-burden-b9drVB7xIOI-unsplash.jpg','1080p',3317165,'image/jpeg','','Lukas','Linköping','2021-05-10 06:32:41','Canon',4,1);
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
  `Member_ID_member` int NOT NULL,
  PRIMARY KEY (`ID_invoice`),
  KEY `fk_Invoice_Member1_idx` (`Member_ID_member`)
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
  `Image_ID_image` int NOT NULL,
  PRIMARY KEY (`ID_invoice_has_image`),
  KEY `fk_Invoice_has_Image_Image1_idx` (`Image_ID_image`),
  KEY `fk_Invoice_has_Image_Invoice_idx` (`Invoice_ID_invoice`),
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
-- Table structure for table `key_word`
--

DROP TABLE IF EXISTS `key_word`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `key_word` (
  `ID_key_word` int NOT NULL AUTO_INCREMENT,
  `keyword` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_key_word`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `key_word`
--

LOCK TABLES `key_word` WRITE;
/*!40000 ALTER TABLE `key_word` DISABLE KEYS */;
INSERT INTO `key_word` VALUES (1,'höst'),(2,'lampa'),(3,'vandra'),(4,'tjej'),(5,'sommar');
/*!40000 ALTER TABLE `key_word` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keyword`
--

LOCK TABLES `keyword` WRITE;
/*!40000 ALTER TABLE `keyword` DISABLE KEYS */;
INSERT INTO `keyword` VALUES (1,'Prinsessan'),(2,'Kungen'),(3,'Konungahuset'),(4,'Konungen'),(5,'Jubileum'),(6,'Bilar'),(7,'Hästar'),(8,'Drottningen'),(9,'iphone'),(10,'samsung'),(11,'z-flip'),(12,'SE'),(13,'apple'),(14,'natur'),(15,'höst'),(16,'natt'),(17,'lampa'),(18,'stig'),(19,'skog'),(20,'vandra'),(21,'sommar');
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keyword_has_image`
--

LOCK TABLES `keyword_has_image` WRITE;
/*!40000 ALTER TABLE `keyword_has_image` DISABLE KEYS */;
INSERT INTO `keyword_has_image` VALUES (20,19,52),(21,20,52),(22,21,52),(26,19,53),(27,14,53);
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

-- Dump completed on 2021-05-10  8:18:20
