CREATE DATABASE  IF NOT EXISTS `subscriber-manager` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `subscriber-manager`;
-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: subscriber-manager
-- ------------------------------------------------------
-- Server version	8.0.28

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
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `region` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=233 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'Andorra','ad','europe'),(2,'United Arab Emirates','ae','asia'),(3,'Afghanistan','af','asia'),(4,'Antigua and Barbuda','ag','caribbean'),(5,'Anguilla','ai',''),(6,'Albania','al','europe'),(7,'Armenia','am','asia'),(8,'Netherlands Antilles','an',''),(9,'Angola','ao','africa'),(10,'Argentina','ar','south-america'),(11,'Austria','at','europe'),(12,'Australia','au','oceania'),(13,'Aruba','aw',''),(14,'Azerbaijan','az','asia'),(15,'Bosnia and Herzegovina','ba','europe'),(16,'Barbados','bb','caribbean'),(17,'Bangladesh','bd','asia'),(18,'Belgium','be','europe'),(19,'Burkina Faso','bf','africa'),(20,'Bulgaria','bg','europe'),(21,'Bahrain','bh','asia'),(22,'Burundi','bi','africa'),(23,'Benin','bj','africa'),(24,'Bermuda','bm','north-america'),(25,'Brunei Darussalam','bn','asia'),(26,'Bolivia','bo','south-america'),(27,'Brazil','br','south-america'),(28,'Bahamas','bs','caribbean'),(29,'Bhutan','bt','asia'),(30,'Botswana','bw','africa'),(31,'Belarus','by','europe'),(32,'Belize','bz','central-america'),(33,'Canada','ca','north-america'),(34,'Cocos (Keeling) Islands','cc','oceania'),(35,'Democratic Republic of the Congo','cd','africa'),(36,'Central African Republic','cf','africa'),(37,'Congo','cg','africa'),(38,'Switzerland','ch','europe'),(39,'Cote D\'Ivoire (Ivory Coast)','ci','africa'),(40,'Cook Islands','ck','oceania'),(41,'Chile','cl','south-america'),(42,'Cameroon','cm','africa'),(43,'China','cn','asia'),(44,'Colombia','co','south-america'),(45,'Costa Rica','cr','central-america'),(46,'Cuba','cu','caribbean'),(47,'Cape Verde','cv','africa'),(48,'Christmas Island','cx',''),(49,'Cyprus','cy','asia'),(50,'Czech Republic','cz','europe'),(51,'Germany','de','europe'),(52,'Djibouti','dj','africa'),(53,'Denmark','dk','europe'),(54,'Dominica','dm','caribbean'),(55,'Dominican Republic','do','caribbean'),(56,'Algeria','dz','africa'),(57,'Ecuador','ec','south-america'),(58,'Estonia','ee','europe'),(59,'Egypt','eg','africa'),(60,'Western Sahara','eh','africa'),(61,'Eritrea','er','africa'),(62,'Spain','es','europe'),(63,'Ethiopia','et','africa'),(64,'Finland','fi','europe'),(65,'Fiji','fj','oceania'),(66,'Falkland Islands (Malvinas)','fk','south-america'),(67,'Federated States of Micronesia','fm','oceania'),(68,'Faroe Islands','fo',''),(69,'France','fr','europe'),(70,'Gabon','ga','africa'),(71,'Great Britain (UK)','gb','europe'),(72,'Grenada','gd','caribbean'),(73,'Georgia','ge','asia'),(74,'French Guiana','gf','south-america'),(76,'Ghana','gh','africa'),(77,'Gibraltar','gi',''),(78,'Greenland','gl','north-america'),(79,'Gambia','gm','africa'),(80,'Guinea','gn','africa'),(81,'Guadeloupe','gp',''),(82,'Equatorial Guinea','gq','africa'),(83,'Greece','gr','europe'),(84,'S. Georgia and S. Sandwich Islands','gs',''),(85,'Guatemala','gt','central-america'),(86,'Guinea-Bissau','gw','africa'),(87,'Guyana','gy','south-america'),(88,'Hong Kong','hk','asia'),(89,'Honduras','hn','central-america'),(90,'Croatia (Hrvatska)','hr','europe'),(91,'Haiti','ht','caribbean'),(92,'Hungary','hu','europe'),(93,'Indonesia','id','asia'),(94,'Ireland','ie','europe'),(95,'Israel','il','asia'),(96,'India','in','asia'),(97,'Iraq','iq','asia'),(98,'Iran','ir','asia'),(99,'Iceland','is','europe'),(100,'Italy','it','europe'),(101,'Jamaica','jm','caribbean'),(102,'Jordan','jo','asia'),(103,'Japan','jp','asia'),(104,'Kenya','ke','africa'),(105,'Kyrgyzstan','kg','asia'),(106,'Cambodia','kh','asia'),(107,'Kiribati','ki','oceania'),(108,'Comoros','km','africa'),(109,'Saint Kitts and Nevis','kn','caribbean'),(110,'Korea (North)','kp','asia'),(111,'Korea (South)','kr','asia'),(112,'Kuwait','kw','asia'),(113,'Cayman Islands','ky','central-america'),(114,'Kazakhstan','kz','asia'),(115,'Laos','la','asia'),(116,'Lebanon','lb','asia'),(117,'Saint Lucia','lc','caribbean'),(118,'Liechtenstein','li','europe'),(119,'Sri Lanka','lk','asia'),(120,'Liberia','lr','africa'),(121,'Lesotho','ls','africa'),(122,'Lithuania','lt','europe'),(123,'Luxembourg','lu','europe'),(124,'Latvia','lv','europe'),(125,'Libya','ly','africa'),(126,'Morocco','ma','africa'),(127,'Monaco','mc','europe'),(128,'Moldova','md','europe'),(129,'Madagascar','mg','africa'),(130,'Marshall Islands','mh','oceania'),(131,'Macedonia','mk','europe'),(132,'Mali','ml','africa'),(133,'Myanmar','mm','asia'),(134,'Mongolia','mn','asia'),(135,'Macao','mo','asia'),(136,'Northern Mariana Islands','mp',''),(137,'Martinique','mq','caribbean'),(138,'Mauritania','mr','africa'),(139,'Montserrat','ms','caribbean'),(140,'Malta','mt','europe'),(141,'Mauritius','mu','africa'),(142,'Maldives','mv','asia'),(143,'Malawi','mw','africa'),(144,'Mexico','mx','north-america'),(145,'Malaysia','my','asia'),(146,'Mozambique','mz','africa'),(147,'Namibia','na','africa'),(148,'New Caledonia','nc','europe'),(149,'Niger','ne','africa'),(150,'Norfolk Island','nf',''),(151,'Nigeria','ng','africa'),(152,'Nicaragua','ni','central-america'),(153,'Netherlands','nl','europe'),(154,'Norway','no','europe'),(155,'Nepal','np','asia'),(156,'Nauru','nr','oceania'),(157,'Niue','nu','oceania'),(158,'New Zealand (Aotearoa)','nz','oceania'),(159,'Oman','om','asia'),(160,'Panama','pa','central-america'),(161,'Peru','pe','south-america'),(162,'French Polynesia','pf','europe'),(163,'Papua New Guinea','pg','oceania'),(164,'Philippines','ph','asia'),(165,'Pakistan','pk','asia'),(166,'Poland','pl','europe'),(167,'Saint Pierre and Miquelon','pm','north-america'),(168,'Pitcairn','pn','oceania'),(169,'Palestinian Territory','ps','asia'),(170,'Portugal','pt','europe'),(171,'Palau','pw','oceania'),(172,'Paraguay','py','south-america'),(173,'Qatar','qa','asia'),(174,'Reunion','re','europe'),(175,'Romania','ro','europe'),(176,'Russian Federation','ru','europe'),(177,'Rwanda','rw','africa'),(178,'Saudi Arabia','sa','asia'),(179,'Solomon Islands','sb','oceania'),(180,'Seychelles','sc','africa'),(181,'Sudan','sd','africa'),(182,'Sweden','se','europe'),(183,'Singapore','sg','asia'),(184,'Saint Helena','sh','africa'),(185,'Slovenia','si','europe'),(186,'Svalbard and Jan Mayen','sj',''),(187,'Slovakia','sk','europe'),(188,'Sierra Leone','sl','africa'),(189,'San Marino','sm','europe'),(190,'Senegal','sn','africa'),(191,'Somalia','so','africa'),(192,'Suriname','sr','south-america'),(193,'Sao Tome and Principe','st','africa'),(194,'El Salvador','sv','central-america'),(195,'Syria','sy','asia'),(196,'Swaziland','sz','africa'),(197,'Turks and Caicos Islands','tc',''),(198,'Chad','td','africa'),(199,'French Southern Territories','tf','europe'),(200,'Togo','tg','africa'),(201,'Thailand','th','asia'),(202,'Tajikistan','tj','asia'),(203,'Tokelau','tk','oceania'),(204,'Turkmenistan','tm','asia'),(205,'Tunisia','tn','africa'),(206,'Tonga','to','oceania'),(207,'Turkey','tr','asia'),(208,'Trinidad and Tobago','tt','caribbean'),(209,'Tuvalu','tv','oceania'),(210,'Taiwan','tw','asia'),(211,'Tanzania','tz','africa'),(212,'Ukraine','ua','europe'),(213,'Uganda','ug','africa'),(214,'Uruguay','uy','south-america'),(215,'Uzbekistan','uz','asia'),(216,'Saint Vincent and the Grenadines','vc','caribbean'),(217,'Venezuela','ve','south-america'),(218,'Virgin Islands (British)','vg',''),(219,'Virgin Islands (U.S.)','vi',''),(220,'Viet Nam','vn','asia'),(221,'Vanuatu','vu','oceania'),(222,'Wallis and Futuna','wf',''),(223,'Samoa','ws','oceania'),(224,'Yemen','ye','asia'),(225,'Mayotte','yt',''),(226,'South Africa','za','africa'),(227,'Zambia','zm','africa'),(228,'Zaire (former)','zr',''),(229,'Zimbabwe','zw','africa'),(230,'United States of America','us','north-america'),(232,'Republic of Serbia','rs','europe');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `integrations`
--

DROP TABLE IF EXISTS `integrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `integrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `platform` int NOT NULL,
  `api_token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `integrations`
--

LOCK TABLES `integrations` WRITE;
/*!40000 ALTER TABLE `integrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `integrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `runtime_logs`
--

DROP TABLE IF EXISTS `runtime_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `runtime_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trace` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `runtime_logs`
--

LOCK TABLES `runtime_logs` WRITE;
/*!40000 ALTER TABLE `runtime_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `runtime_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscribers`
--

DROP TABLE IF EXISTS `subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscribers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `subscriber_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscribers`
--

LOCK TABLES `subscribers` WRITE;
/*!40000 ALTER TABLE `subscribers` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscribers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-03-27  0:58:33
