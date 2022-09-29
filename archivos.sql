CREATE DATABASE  IF NOT EXISTS `archivos` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `archivos`;
-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: localhost    Database: archivos
-- ------------------------------------------------------
-- Server version	8.0.26

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
-- Table structure for table `archivo`
--

DROP TABLE IF EXISTS `archivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `archivo` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `USUARIO` varchar(10) NOT NULL,
  `ARCHIVO` varchar(300) DEFAULT NULL,
  `EXTENCION` varchar(100) DEFAULT NULL,
  `COMENTARIO` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_USUAIRO` (`USUARIO`),
  CONSTRAINT `FK_USUAIRO` FOREIGN KEY (`USUARIO`) REFERENCES `usuario` (`CODIGO`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `compartir`
--

DROP TABLE IF EXISTS `compartir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `compartir` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `ID_USUARIO` varchar(10) NOT NULL,
  `ID_USUARIO_COMPARTIR` varchar(10) NOT NULL,
  `ID_ARCHIVO` int NOT NULL,
  `FECHA` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_USUARIO` (`ID_USUARIO`),
  KEY `FK_USUARIO_COMPARTIR` (`ID_USUARIO_COMPARTIR`),
  KEY `FK_IDARCHIVO` (`ID_ARCHIVO`),
  CONSTRAINT `FK_IDARCHIVO` FOREIGN KEY (`ID_ARCHIVO`) REFERENCES `archivo` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_USUARIO` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`CODIGO`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_USUARIO_COMPARTIR` FOREIGN KEY (`ID_USUARIO_COMPARTIR`) REFERENCES `usuario` (`CODIGO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tipo`
--

DROP TABLE IF EXISTS `tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `TIPO` varchar(40) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `CODIGO` varchar(10) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `APELLIDO` varchar(50) NOT NULL,
  `SEXO` varchar(10) NOT NULL,
  `CORREO` varchar(200) NOT NULL,
  `ID_TIPO` int NOT NULL,
  PRIMARY KEY (`CODIGO`),
  KEY `FK_TIPO` (`ID_TIPO`),
  CONSTRAINT `FK_TIPO` FOREIGN KEY (`ID_TIPO`) REFERENCES `tipo` (`ID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-27 22:19:31
