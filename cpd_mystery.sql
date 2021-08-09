-- MariaDB dump 10.19  Distrib 10.4.20-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: mystery
-- ------------------------------------------------------
-- Server version	10.4.20-MariaDB-1:10.4.20+maria~bionic-log

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
-- Table structure for table `congrats_data`
--

DROP TABLE IF EXISTS `congrats_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `congrats_data` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `image` varchar(200) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `congrats_data`
--

LOCK TABLES `congrats_data` WRITE;
/*!40000 ALTER TABLE `congrats_data` DISABLE KEYS */;
INSERT INTO `congrats_data` VALUES (1,'Congratulations! You have completed the 2021 Mystery Night Out!','./asset/active.png','Return to the Stubbs Park Amphitheater to Find the Fit Ewe. Be sure to check the raffle prize boards to see if you’ve won!');
/*!40000 ALTER TABLE `congrats_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `homepage_data`
--

DROP TABLE IF EXISTS `homepage_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `homepage_data` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `image` varchar(200) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `homepage_data`
--

LOCK TABLES `homepage_data` WRITE;
/*!40000 ALTER TABLE `homepage_data` DISABLE KEYS */;
INSERT INTO `homepage_data` VALUES (1,'Welcome to the 2021 Centerville Mystery Night Out!','./asset/active.png','Welcome sleuths! In the spirit of re-discovering fitness after a year of pandemic restrictions&comma; your mission is to solve six (6) clues to Find the Fit Ewe. After solving each clue&comma; you will travel to that destination to unlock the next clue.');
/*!40000 ALTER TABLE `homepage_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location_data`
--

DROP TABLE IF EXISTS `location_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `location_data` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `clueimage` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `text` text NOT NULL,
  `clue` varchar(350) NOT NULL,
  `code` varchar(30) NOT NULL,
  `next` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location_data`
--

LOCK TABLES `location_data` WRITE;
/*!40000 ALTER TABLE `location_data` DISABLE KEYS */;
INSERT INTO `location_data` VALUES (1,'Washington Township RecPlex','./asset/clue1.png','./asset/location1.png','Get active! Washington Township RecPlex offers a variety of recreation services including aquatics, fitness, youth care and programming for active older adults. Residents and non-residents are welcome. This location\'s code is: 536','The code will be at the location of the puzzle\'s answer.','7',1),(2,'Play It Again Sports','./asset/clue2.png','./asset/location2.png','Get your gear! Play It Again Sports buys, sells, and trades new and used sports equipment and fitness gear. This location\'s code is: 5','The code will be at the location of the puzzle\'s answer.','5',2),(3,'Dayton Quest Center','./asset/clue3.png','./asset/location3.png','Unleash your potential! Find mental toughness and a winning edge in life through To-Shin Do martial arts at Dayton Quest Center. This location\'s code is: 8','The code will be at the location of the puzzle\'s answer.','8',3),(4,'Core Life Eatery','./asset/clue4.png','./asset/location4.png','Eat right! Core Life Eatery brings clean, healthy and great tasting foods to everyone every day. This location\'s code is: 12','The code will be at the location of the puzzle\'s answer.','12',4),(5,'Forest Field Park','./asset/clue5.png','./asset/location5.png','Get some fresh air! Forest Field Park is an arboretum as well as a community park. The Park District has planted 14 varieties of evergreens and 41 species of deciduous trees around the park. This location\'s code is: 9','The code will be at the location of the puzzle\'s answer.','9',0),(6,'Soyo Yogurt and StretchLab','./asset/clue6.png','./asset/location6.png','Improve your performance! Give in to NO guilt with healthy frozen treats at Soyo Yogurt. Then improve your flexibility, muscle/joint pain and performance with professional assisted stretching routines at StretchLab.','Return to the Stubbs Park Amphitheater to Find the Fit Ewe. Be sure to check the raffle prize boards to see if you’ve won!','41',0);
/*!40000 ALTER TABLE `location_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mysterypage_data`
--

DROP TABLE IF EXISTS `mysterypage_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mysterypage_data` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mysterypage_data`
--

LOCK TABLES `mysterypage_data` WRITE;
/*!40000 ALTER TABLE `mysterypage_data` DISABLE KEYS */;
INSERT INTO `mysterypage_data` VALUES (1,'Good luck and have fun!','As you log on to the web page&comma; you will be assigned a clue. Once you have solved that clue and reach the clue location&comma; there will be signs posted where you must count the sheep. REMEMBER THESE NUMBERS! This process will be repeated until you have gathered all five clue codes. At the last clue location, each team will receive a completion certificate. You will then enter the total of all sheep counted to reveal the location of the Fit Ewe. Raffle prize winners will be posted on our prize boards at the final location after you have completed the challenge. If you&apos;re stuck and need a little help&comma; click on the blue hint button at the bottom right of your screen. Along with a hint&comma; you will also be given a phone number to one of our help lines if you need additional help.');
/*!40000 ALTER TABLE `mysterypage_data` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-08-09 12:17:46
