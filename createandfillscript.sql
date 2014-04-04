CREATE DATABASE  IF NOT EXISTS `jwbroekh_db2` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `jwbroekh_db2`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: databases.aii.avans.nl    Database: jwbroekh_db2
-- ------------------------------------------------------
-- Server version	5.5.29

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
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `street` varchar(64) NOT NULL,
  `number` int(11) NOT NULL,
  `addition` varchar(1) DEFAULT NULL,
  `zipcode` varchar(45) NOT NULL,
  `country` varchar(45) NOT NULL,
  `username` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user_idx` (`username`),
  CONSTRAINT `FK_user` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
INSERT INTO `address` VALUES (17,'Henk de Vries','Ijsstraat',17,'','4398jl','Nederland','Henk'),(18,'Frank','straat',24,'','0943KM','nederland','admin');
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (3,'Weapons','Weapons are used to attack portals.'),(4,'Resonators','Resonators are used to claim portals and make them stronger.'),(5,'Mods','Mods are used to change certain properties on portals.'),(6,'Power Cubes','Power Cubes are used to gain XM.');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(64) NOT NULL,
  `addressid` int(11) NOT NULL,
  `status` enum('ordered','shipped') NOT NULL DEFAULT 'ordered',
  PRIMARY KEY (`id`),
  KEY `FK_users_idx` (`user`),
  KEY `FK_adress_idx` (`addressid`),
  CONSTRAINT `FK_adress` FOREIGN KEY (`addressid`) REFERENCES `address` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_users` FOREIGN KEY (`user`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (3,'Henk',17,'ordered'),(5,'admin',18,'ordered');
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(255) NOT NULL,
  `longdescription` text NOT NULL,
  `image` varchar(20) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `price` decimal(3,2) NOT NULL,
  `rarity` enum('very_common','common','rare','very_rare') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_categorie_idx` (`categoryid`),
  CONSTRAINT `FK_categorie` FOREIGN KEY (`categoryid`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'XMP Burster (L1)','Exotic Matter Pulse weapon which can destroy enemy Resonators and Mods and neutralize enemy Portals.','Exotic Matter Pulse weapon which can destroy enemy Resonators and Mods and neutralize enemy Portals. <br />\nRange: 42m <br />\nYou need to be at least level 1 to use this item.','L1XMP.jpg',3,0.10,'very_common'),(2,'XMP Burster (L2)','Exotic Matter Pulse weapon which can destroy enemy Resonators and Mods and neutralize enemy Portals.','Exotic Matter Pulse weapon which can destroy enemy Resonators and Mods and neutralize enemy Portals. <br />\r\nRange: 48m <br />\r\nYou need to be at least level 2 to use this item.','L2XMP.jpg',3,0.20,'very_common'),(3,'XMP Burster (L3)','Exotic Matter Pulse weapon which can destroy enemy Resonators and Mods and neutralize enemy Portals.','Exotic Matter Pulse weapon which can destroy enemy Resonators and Mods and neutralize enemy Portals. <br />\r\nRange: 58m <br />\r\nYou need to be at least level 3 to use this item.','L3XMP.jpg',3,0.30,'very_common'),(4,'XMP Burster (L4)','Exotic Matter Pulse weapon which can destroy enemy Resonators and Mods and neutralize enemy Portals.','Exotic Matter Pulse weapon which can destroy enemy Resonators and Mods and neutralize enemy Portals. <br />\r\nRange: 72m <br />\r\nYou need to be at least level 4 to use this item.','L4XMP.jpg',3,0.40,'very_common'),(5,'XMP Burster (L5)','Exotic Matter Pulse weapon which can destroy enemy Resonators and Mods and neutralize enemy Portals.','Exotic Matter Pulse weapon which can destroy enemy Resonators and Mods and neutralize enemy Portals. <br />\r\nRange: 90m <br />\r\nYou need to be at least level 5 to use this item.','L5XMP.jpg',3,0.50,'very_common'),(6,'XMP Burster (L6)','Exotic Matter Pulse weapon which can destroy enemy Resonators and Mods and neutralize enemy Portals.','Exotic Matter Pulse weapon which can destroy enemy Resonators and Mods and neutralize enemy Portals. <br />\r\nRange: 112m <br />\r\nYou need to be at least level 6 to use this item.','L6XMP.jpg',3,0.60,'very_common'),(7,'XMP Burster (L7)','Exotic Matter Pulse weapon which can destroy enemy Resonators and Mods and neutralize enemy Portals.','Exotic Matter Pulse weapon which can destroy enemy Resonators and Mods and neutralize enemy Portals. <br />\r\nRange: 138m <br />\r\nYou need to be at least level 7 to use this item.','L7XMP.jpg',3,0.70,'very_common'),(8,'XMP Burster (L8)','Exotic Matter Pulse weapon which can destroy enemy Resonators and Mods and neutralize enemy Portals.','Exotic Matter Pulse weapon which can destroy enemy Resonators and Mods and neutralize enemy Portals. <br />\r\nRange: 168m <br />\r\nYou need to be at least level 8 to use this item.','L8XMP.jpg',3,0.80,'very_common'),(9,'Resonator (L1)','XM object used to power-up a Portal and align it to a Faction.','XM object used to power-up a Portal and align it to a Faction. <br />\r\nYou need to be at least level 1 to use this item.','L1res.jpg',4,0.10,'very_common'),(10,'Resonator (L2)','XM object used to power-up a Portal and align it to a Faction.','XM object used to power-up a Portal and align it to a Faction. <br />\r\nYou need to be at least level 2 to use this item.','L2res.jpg',4,0.20,'very_common'),(11,'Resonator (L3)','XM object used to power-up a Portal and align it to a Faction.','XM object used to power-up a Portal and align it to a Faction. <br />\r\nYou need to be at least level 3 to use this item.','L3res.jpg',4,0.30,'very_common'),(12,'Resonator (L4)','XM object used to power-up a Portal and align it to a Faction.','XM object used to power-up a Portal and align it to a Faction. <br />\r\nYou need to be at least level 4 to use this item.','L4res.jpg',4,0.40,'very_common'),(13,'Resonator (L5)','XM object used to power-up a Portal and align it to a Faction.','XM object used to power-up a Portal and align it to a Faction. <br />\r\nYou need to be at least level 5 to use this item.','L5res.jpg',4,0.50,'very_common'),(14,'Resonator (L6)','XM object used to power-up a Portal and align it to a Faction.','XM object used to power-up a Portal and align it to a Faction. <br />\r\nYou need to be at least level 6 to use this item.','L6res.jpg',4,0.60,'very_common'),(15,'Resonator (L7)','XM object used to power-up a Portal and align it to a Faction.','XM object used to power-up a Portal and align it to a Faction. <br />\r\nYou need to be at least level 7 to use this item.','L7res.jpg',4,0.70,'very_common'),(16,'Resonator (L8)','XM object used to power-up a Portal and align it to a Faction.','XM object used to power-up a Portal and align it to a Faction. <br />\r\nYou need to be at least level 8 to use this item.','L8res.jpg',4,0.80,'very_common'),(17,'ADA Refactor','The ADA Refactor can be used to reverse the alignment of an Enlightened Portal.','The ADA Refactor can be used to reverse the alignment of an Enlightened Portal.','ADA.jpg',3,2.00,'very_rare'),(18,'JARVIS Virus','The JARVIS Virus can be used to reverse the alignment of a Resistance Portal','The JARVIS Virus can be used to reverse the alignment of a Resistance Portal','JARVIS.jpg',3,2.00,'very_rare'),(19,'Portal Shield (Common)','Mod which shields Portal from attacks.','Mod which shields Portal from attacks. <br />\r\n+10 mitigation','CShield.jpg',5,0.50,'common'),(20,'Portal Shield (Rare)','Mod which shields Portal from attacks.','Mod which shields Portal from attacks. <br />\r\n+20 mitigation','RShield.jpg',5,1.25,'rare'),(21,'Portal Shield (Very Rare)','Mod which shields Portal from attacks.','Mod which shields Portal from attacks. <br />\r\n+30 mitigation','VRShield.jpg',5,2.00,'very_rare'),(22,'Heat Sink (Common)','Mod that reduces cooldown time between Portal hacks.','Mod that reduces cooldown time between Portal hacks. <br />\r\n20% Portal Cooldown Decrease','CHeatSink.jpg',5,0.50,'common'),(23,'Heat Sink (Rare)','Mod that reduces cooldown time between Portal hacks.','Mod that reduces cooldown time between Portal hacks. <br />\r\n50% Portal Cooldown Decrease','RHeatSink.jpg',5,1.25,'rare'),(24,'Heat Sink (Very Rare)','Mod that reduces cooldown time between Portal hacks.','Mod that reduces cooldown time between Portal hacks. <br />\r\n70% Portal Cooldown Decrease','VRHeatSink.jpg',5,2.00,'very_rare'),(25,'Multi-hack (Common)','Mod that increases hacking capacity of a Portal.','Mod that increases hacking capacity of a Portal. <br />\r\n+4 hacks','CMultiHack.jpg',5,0.50,'common'),(26,'Multi-hack (Rare)','Mod that increases hacking capacity of a Portal.','Mod that increases hacking capacity of a Portal. <br />\r\n+8 hacks','RMultiHack.jpg',5,1.25,'rare'),(27,'Multi-hack (Very Rare)','Mod that increases hacking capacity of a Portal.','Mod that increases hacking capacity of a Portal. <br />\r\n+12 hacks','VRMultiHack.jpg',5,2.00,'very_rare'),(28,'Link Amp (Rare)','Mod that increases Portal link range.','Mod that increases Portal link range. <br />\r\n2x Link range','RLinkAmp.jpg',5,1.25,'rare'),(29,'Link Amp (Very Rare)','Mod that increases Portal link range.','Mod that increases Portal link range. <br />\r\n7x Link range','VRLinkAmp.jpg',5,2.00,'very_rare'),(30,'Turret (Rare)','Mod that increases frequency of Portal attacks against enemy agents.','Mod that increases frequency of Portal attacks against enemy agents. <br />\r\n+2x Attack Frequency  <br />\r\n+0.2 Hit Bonus','RTurret.jpg',5,1.25,'rare'),(31,'Force Amp (Rare)','Mod that increases power of Portal attacks against enemy agents.','Mod that increases power of Portal attacks against enemy agents. <br />\r\n2x Damage ','RForceAmp.jpg',5,1.25,'rare'),(32,'Power Cube (L1)','Store of XM which can be used to recharge Scanner.','Store of XM which can be used to recharge Scanner. <br />\r\n+1000 XM <br />\r\nYou need to be at least level 1 to use this item.','L1Cube.jpg',6,0.20,'very_common'),(33,'Power Cube (L2)','Store of XM which can be used to recharge Scanner.','Store of XM which can be used to recharge Scanner. <br />\r\n+2000 XM <br />\r\nYou need to be at least level 2 to use this item.','L2Cube.jpg',6,0.40,'very_common'),(34,'Power Cube (L3)','Store of XM which can be used to recharge Scanner.','Store of XM which can be used to recharge Scanner. <br />\r\n+3000 XM <br />\r\nYou need to be at least level 3 to use this item.','L3Cube.jpg',6,0.60,'very_common'),(35,'Power Cube (L4)','Store of XM which can be used to recharge Scanner.','Store of XM which can be used to recharge Scanner. <br />\r\n+4000 XM <br />\r\nYou need to be at least level 4 to use this item.','L4Cube.jpg',6,0.80,'very_common'),(36,'Power Cube (L5)','Store of XM which can be used to recharge Scanner.','Store of XM which can be used to recharge Scanner. <br />\r\n+5000 XM <br />\r\nYou need to be at least level 5 to use this item.','L5Cube.jpg',6,1.00,'very_common'),(37,'Power Cube (L6)','Store of XM which can be used to recharge Scanner.','Store of XM which can be used to recharge Scanner. <br />\r\n+6000 XM <br />\r\nYou need to be at least level 6 to use this item.','L6Cube.jpg',6,1.20,'very_common'),(38,'Power Cube (L7)','Store of XM which can be used to recharge Scanner.','Store of XM which can be used to recharge Scanner. <br />\r\n+7000 XM <br />\r\nYou need to be at least level 7 to use this item.','L7Cube.jpg',6,1.40,'very_common'),(39,'Power Cube (L8)','Store of XM which can be used to recharge Scanner.','Store of XM which can be used to recharge Scanner. <br />\r\n+8000 XM <br />\r\nYou need to be at least level 8 to use this item.','L8Cube.jpg',6,1.60,'very_common');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productorder`
--

DROP TABLE IF EXISTS `productorder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_order_idx` (`orderid`),
  KEY `FK_product_idx` (`productid`),
  CONSTRAINT `FK_order` FOREIGN KEY (`orderid`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_product1` FOREIGN KEY (`productid`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productorder`
--

LOCK TABLES `productorder` WRITE;
/*!40000 ALTER TABLE `productorder` DISABLE KEYS */;
INSERT INTO `productorder` VALUES (1,3,17,1),(2,3,18,4),(4,5,9,2),(5,5,10,5),(6,5,17,1);
/*!40000 ALTER TABLE `productorder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_product` FOREIGN KEY (`id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock`
--

LOCK TABLES `stock` WRITE;
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
/*!40000 ALTER TABLE `stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `accesslevel` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('admin','edd3239df50d5aca06447444c363db5cfeab49ab047d7205de4c3a0beb93b7d2',100),('Henk','313b1ddfed7aa2e3e1349bbf99a3841a23b6604719dfc7d86ce118d5a87728c9',4),('hoi','ff1211acd7c69e54af35f569d95f44130c04f772d639cafb4d1f5ae8ff1775eb',1),('jer','ff1211acd7c69e54af35f569d95f44130c04f772d639cafb4d1f5ae8ff1775eb',25);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-04-04 23:25:40
