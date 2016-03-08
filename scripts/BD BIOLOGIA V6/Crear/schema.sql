-- MySQL dump 10.16  Distrib 10.1.10-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: LabBiologia
-- ------------------------------------------------------
-- Server version	10.1.10-MariaDB-1~trusty-log

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
-- Table structure for table `Asignatura`
--

DROP TABLE IF EXISTS `Asignatura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Asignatura` (
  `Id` int(11) NOT NULL,
  `NombreAsignatura` varchar(50) DEFAULT NULL,
  `RutProfesorACargo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_Asignatura_1_idx` (`RutProfesorACargo`),
  CONSTRAINT `fk_Asignatura_1` FOREIGN KEY (`RutProfesorACargo`) REFERENCES `Usuario` (`Rut`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Contenido`
--

DROP TABLE IF EXISTS `Contenido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Contenido` (
  `IdGuia` int(11) DEFAULT NULL,
  `IdPregunta` int(11) DEFAULT NULL,
  `Respuesta` varchar(500) DEFAULT NULL,
  KEY `fk_Contenido_1_idx` (`IdGuia`),
  KEY `fk_Contenido_2_idx` (`IdPregunta`),
  CONSTRAINT `fk_Contenido_1` FOREIGN KEY (`IdGuia`) REFERENCES `Guia` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Contenido_2` FOREIGN KEY (`IdPregunta`) REFERENCES `Pregunta` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Guia`
--

DROP TABLE IF EXISTS `Guia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Guia` (
  `Id` int(11) NOT NULL,
  `Titulo` varchar(50) DEFAULT NULL,
  `Descripcion` varchar(500) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `IdAsignatura` int(11) DEFAULT NULL,
  `Estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_Guia_1_idx` (`IdAsignatura`),
  CONSTRAINT `fk_Guia_1` FOREIGN KEY (`IdAsignatura`) REFERENCES `Asignatura` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Pregunta`
--

DROP TABLE IF EXISTS `Pregunta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Pregunta` (
  `Id` int(11) NOT NULL,
  `IdGuia` int(11) NOT NULL,
  `Enunciado` varchar(100) DEFAULT NULL,
  `TipoRespuesta` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id`)
  KEY `fk_Pregunta_1_idx` (`IdGuia`),
  CONSTRAINT `fk_Guia_1` FOREIGN KEY (`IdGuia`) REFERENCES `Guia` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Repositorio`
--

DROP TABLE IF EXISTS `Repositorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Repositorio` (
  `Id` MEDIUMINT NOT NULL AUTO_INCREMENT,
  `Ruta` varchar(200) NOT NULL,
  `RutAlumno` varchar(20) DEFAULT NULL,
  `DescripcionBreve` varchar(600) DEFAULT NULL,
  `TipoTenido` varchar(20) DEFAULT NULL,
  `Preparacion` varchar(20) DEFAULT NULL,
  `Diametro` int(11) DEFAULT NULL,
  `Aumento` int(11) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `RutaDibujo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_Repositorio_1_idx` (`RutAlumno`),
  CONSTRAINT `fk_Repositorio_1` FOREIGN KEY (`RutAlumno`) REFERENCES `Usuario` (`Rut`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Respuesta`
--

DROP TABLE IF EXISTS `Respuesta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Respuesta` (
  `IdPregunta` int(11) DEFAULT NULL,
  `IdGuia` int(11) DEFAULT NULL,
  `Respuesta` varchar(500) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `RutUsuario` varchar(20) DEFAULT NULL,
  KEY `fk_Respuesta_1_idx` (`IdGuia`),
  KEY `fk_Respuesta_2_idx` (`IdPregunta`),
  KEY `fk_Respuesta_3_idx` (`RutUsuario`),
  CONSTRAINT `fk_Respuesta_1` FOREIGN KEY (`IdGuia`) REFERENCES `Guia` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Respuesta_2` FOREIGN KEY (`IdPregunta`) REFERENCES `Pregunta` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Respuesta_3` FOREIGN KEY (`RutUsuario`) REFERENCES `Usuario` (`Rut`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `SeleccionMultiple`
--

DROP TABLE IF EXISTS `SeleccionMultiple`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SeleccionMultiple` (
  `IdPregunta` int(11) DEFAULT NULL,
  `ValorAlternativa` varchar(50) DEFAULT NULL,
  `Tipo` varchar(10) DEFAULT NULL,
  KEY `fk_SeleccionMultiple_1_idx` (`IdPregunta`),
  CONSTRAINT `fk_SeleccionMultiple_1` FOREIGN KEY (`IdPregunta`) REFERENCES `Pregunta` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Usuario`
--

DROP TABLE IF EXISTS `Usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Usuario` (
  `Nombre` varchar(50) DEFAULT NULL,
  `ApellidoP` varchar(50) DEFAULT NULL,
  `ApellidoM` varchar(50) DEFAULT NULL,
  `Rut` varchar(20) NOT NULL,
  `IdAsignatura` int(11) DEFAULT NULL,
  `Correo` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `TipoUsuario` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Rut`),
  KEY `fk_Usuario_1_idx` (`IdAsignatura`),
  CONSTRAINT `fk_Usuario_1` FOREIGN KEY (`IdAsignatura`) REFERENCES `Asignatura` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

DROP TABLE IF EXISTS `UsuarioAsignatura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8*/;
CREATE TABLE `UsuarioAsignatura` (
  `RutUsuario` varchar(20) NOT NULL,
  `IdAsignatura` int(11) NOT NULL,
  KEY `fk_UsuarioAsignatura_1_idx` (`RutUsuario`),
  KEY `fk_UsuarioAsignatura_2_idx` (`IdAsignatura`),
  CONSTRAINT `fk_UsuarioAsignatura_1` FOREIGN KEY (`RutUsuario`) REFERENCES `Usuario` (`Rut`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_UsuarioAsignatura_2` FOREIGN KEY (`IdAsignatura`) REFERENCES `Asignatura` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-02-10  7:18:10
