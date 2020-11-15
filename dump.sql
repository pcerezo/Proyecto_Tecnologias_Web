-- MySQL dump 10.13  Distrib 5.7.26, for Linux (x86_64)
--
-- Host: localhost    Database: Proyecto
-- ------------------------------------------------------
-- Server version	5.7.26-0ubuntu0.18.04.1

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
-- Table structure for table `Comentario`
--

DROP TABLE IF EXISTS `Comentario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Comentario` (
  `id_com` int(11) NOT NULL AUTO_INCREMENT,
  `contenido` varchar(500) DEFAULT NULL,
  `id_inc` int(11) DEFAULT NULL,
  `id_autor` varchar(60) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id_com`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Comentario`
--

LOCK TABLES `Comentario` WRITE;
/*!40000 ALTER TABLE `Comentario` DISABLE KEYS */;
INSERT INTO `Comentario` VALUES (1,'He sido yo, jeje.',1,'paco@gmail.com','2019-05-29'),(11,'Probando comentario',1,'paco@gmail.com','2019-05-29'),(12,'Soy anónimo',1,'Anónimo','2019-05-29'),(13,'A ver si terminas ya las pruebas, joder, jajajajaja',9,'paco@gmail.com','2019-06-02');
/*!40000 ALTER TABLE `Comentario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Imagen`
--

DROP TABLE IF EXISTS `Imagen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Imagen` (
  `id_img` int(11) NOT NULL AUTO_INCREMENT,
  `id_inc` int(11) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_img`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Imagen`
--

LOCK TABLES `Imagen` WRITE;
/*!40000 ALTER TABLE `Imagen` DISABLE KEYS */;
INSERT INTO `Imagen` VALUES (1,4,'fuerzas especiales.jpg'),(2,9,'');
/*!40000 ALTER TABLE `Imagen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Incidencia`
--

DROP TABLE IF EXISTS `Incidencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Incidencia` (
  `id_inc` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(70) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `lugar` varchar(50) DEFAULT NULL,
  `etiqueta` varchar(70) DEFAULT NULL,
  `estado` varchar(25) DEFAULT NULL,
  `autor` varchar(70) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id_inc`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Incidencia`
--

LOCK TABLES `Incidencia` WRITE;
/*!40000 ALTER TABLE `Incidencia` DISABLE KEYS */;
INSERT INTO `Incidencia` VALUES (1,'Prueba tercera y última espero','Probando, probando3','Por allí','','Pendiente','paco@gmail.com','2019-05-29'),(2,'Hola','A ver si se apunta esta incidencia en el Log','En esta página','prueba, log','Pendiente','admin@gmail.com','2019-06-01'),(6,'Hola2','¿Qué tal?','Aquí','rgrb','Pendiente','admin@gmail.com','2019-06-01'),(8,'Otra Prueba','Contenido Original','Aquí','rgrb','Pendiente','admin@gmail.com','2019-06-01'),(9,'Prueba tropecientas y una','Contenido Modificado otra vez','Allí otra vez','prueba','Pendiente','admin@gmail.com','2019-06-01');
/*!40000 ALTER TABLE `Incidencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Log`
--

DROP TABLE IF EXISTS `Log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Log` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `evento` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Log`
--

LOCK TABLES `Log` WRITE;
/*!40000 ALTER TABLE `Log` DISABLE KEYS */;
INSERT INTO `Log` VALUES (2,'2019-06-01','El usuario admin@gmail.com ha iniciado sesión.'),(3,'2019-06-01','El usuario  sale de la sesión.'),(4,'2019-06-01','El usuario admin@gmail.com ha iniciado sesión.'),(5,'2019-06-01','El usuario admin@gmail.com ha iniciado sesión.'),(6,'2019-06-01','El usuario  sale de la sesión.'),(7,'2019-06-01','El usuario paco@gmail.com ha iniciado sesión.'),(8,'2019-06-01','El usuario  sale de la sesión.'),(9,'2019-06-01','El usuario paco@gmail.com ha iniciado sesión.'),(10,'2019-06-01','El usuario  sale de la sesión.'),(11,'2019-06-01','El usuario paco@gmail.com ha iniciado sesión.'),(12,'2019-06-01','El usuario paco@gmail.com sale de la sesión.'),(13,'2019-06-01','El usuario admin@gmail.com ha iniciado sesión.'),(14,'2019-06-02','El usuario admin@gmail.com ha iniciado sesión.'),(15,'2019-06-02','El usuario admin@gmail.com ha iniciado sesión.'),(16,'2019-06-02','El usuario admin@gmail.com ha iniciado sesión.'),(17,'2019-06-02','El usuario admin@gmail.com sale de la sesión.'),(18,'2019-06-02','El usuario paco@gmail.com ha iniciado sesión.'),(19,'2019-06-02','El usuario paco@gmail.com ha hecho un comentario de la incidencia 9.'),(20,'2019-06-02','El usuario paco@gmail.com sale de la sesión.'),(21,'2019-06-02','El usuario admin@gmail.com ha iniciado sesión.');
/*!40000 ALTER TABLE `Log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Usuario`
--

DROP TABLE IF EXISTS `Usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `apellidos` varchar(40) DEFAULT NULL,
  `clave` varchar(72) DEFAULT NULL,
  `direccion` varchar(30) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `rol` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`,`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuario`
--

LOCK TABLES `Usuario` WRITE;
/*!40000 ALTER TABLE `Usuario` DISABLE KEYS */;
INSERT INTO `Usuario` VALUES (1,'paco@gmail.com','Paco','Opaco2','paco','calle Paco',51684965,'colaborador'),(2,'admin@gmail.com','Admin','Istrador','admin','Calle del admin',777777777,'Administrador'),(4,'pepe@gmail.com','pepe','Pepe','','Calle Pepe',888888888,'Colaborador'),(5,'pepe2@gmail.com','pepe2','Pepe2','pepe2','Calle Pepe',888888889,'Colaborador'),(6,'pepe3@gmail.com','pepe3','pepe3','pepe3','Calle Pepe3',89999999,'Administrador');
/*!40000 ALTER TABLE `Usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-06-02 13:45:26
