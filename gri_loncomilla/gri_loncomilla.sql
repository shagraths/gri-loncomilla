-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 15, 2014 at 07:54 PM
-- Server version: 5.5.37-MariaDB
-- PHP Version: 5.5.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gri_loncomilla`
--

-- --------------------------------------------------------

--
-- Table structure for table `instalacion`
--

CREATE TABLE IF NOT EXISTS `instalacion` (
  `numero` int(11) NOT NULL AUTO_INCREMENT,
  `n_abonado` int(11) NOT NULL,
  `n_orden` int(11) NOT NULL,
  `nombre` varchar(11) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `motivo` int(2) NOT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `observacion` varchar(100) NOT NULL,
  `mat_seriado` int(10) NOT NULL,
  `tecnico` int(2) NOT NULL,
  `encuesta` varchar(20) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `encuesta_realizada` varchar(2) NOT NULL,
  PRIMARY KEY (`numero`),
  KEY `motivo` (`motivo`),
  KEY `tecnico` (`tecnico`),
  KEY `tecnico_2` (`tecnico`),
  KEY `tecnico_3` (`tecnico`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `servicio`
--

CREATE TABLE IF NOT EXISTS `servicio` (
  `id_s` int(2) NOT NULL AUTO_INCREMENT,
  `nombre_s` varchar(50) NOT NULL,
  `Tiempo` time NOT NULL,
  `estado_s` varchar(20) NOT NULL,
  PRIMARY KEY (`id_s`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `servicio`
--

INSERT INTO `servicio` (`id_s`, `nombre_s`, `Tiempo`, `estado_s`) VALUES
(1, 'internet', '01:00:00', 'ACTIVO'),
(2, 'Cable', '01:00:00', 'ACTIVO'),
(3, 'Cable + Internet', '01:20:00', 'ACTIVO'),
(4, 'cable x 2', '01:20:00', 'ACTIVO'),
(5, 'cable x 3', '01:40:00', 'ACTIVO'),
(6, 'cable x 2 + internet', '01:40:00', 'ACTIVO'),
(7, 'cable x 3 + internet', '02:00:00', 'ACTIVO');

-- --------------------------------------------------------

--
-- Table structure for table `tecnico`
--

CREATE TABLE IF NOT EXISTS `tecnico` (
  `id_t` int(2) NOT NULL AUTO_INCREMENT,
  `nombre_t` varchar(50) NOT NULL,
  `empresa_t` varchar(50) NOT NULL,
  `estado_t` varchar(20) NOT NULL,
  PRIMARY KEY (`id_t`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tecnico`
--

INSERT INTO `tecnico` (`id_t`, `nombre_t`, `empresa_t`, `estado_t`) VALUES
(1, 'cristian', 'llvcc', 'ACTIVO');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `rut` int(8) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `nivel` varchar(20) NOT NULL,
  `estado_us` varchar(20) NOT NULL,
  PRIMARY KEY (`rut`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`rut`, `nombre`, `apellido`, `pass`, `nivel`, `estado_us`) VALUES
(11111111, 'marcos', 'lopez', '21232f297a57a5a74389', 'VENDEDOR', 'ACTIVO'),
(13789307, 'felix', 'valdes', '21232f297a57a5a74389', 'CALL_CENTER', 'ACTIVO'),
(18161467, 'alejandro', 'cabezas', '21232f297a57a5a74389', 'ADMINISTRADOR', 'ACTIVO'),
(22222222, 'mauricio', 'pinillla', 'b50347c6fa8e55d5b562', 'GERENTE', 'ACTIVO');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `instalacion`
--
ALTER TABLE `instalacion`
  ADD CONSTRAINT `instalacion_ibfk_1` FOREIGN KEY (`motivo`) REFERENCES `servicio` (`id_s`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `instalacion_ibfk_2` FOREIGN KEY (`tecnico`) REFERENCES `tecnico` (`id_t`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
