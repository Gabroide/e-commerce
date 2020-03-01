-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 01-03-2020 a las 18:36:42
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `tienda2020`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblusuario`
--

CREATE TABLE IF NOT EXISTS `tblusuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `strEmail` varchar(50) NOT NULL,
  `strPassword` varchar(50) NOT NULL,
  `strNombre` varchar(30) NOT NULL,
  `intNivel` int(11) NOT NULL DEFAULT '0',
  `intEstado` int(11) NOT NULL DEFAULT '1',
  `strImagen` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `strEmail` (`strEmail`),
  UNIQUE KEY `strPassword` (`strPassword`),
  KEY `strEmail_2` (`strEmail`),
  KEY `strEmail_3` (`strEmail`),
  KEY `strEmail_4` (`strEmail`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `tblusuario`
--

INSERT INTO `tblusuario` (`idUsuario`, `strEmail`, `strPassword`, `strNombre`, `intNivel`, `intEstado`, `strImagen`) VALUES
(1, 'pepe@papa.com', 'a6f99abf17bfee85d4b755a5eeb0dacf', 'Pepe', 10, 1, NULL),
(2, 'jprge@jprge.com', '73e21337a0fffbbeb9922dc45bad3d38', 'Pepito', 0, 1, NULL),
(3, 'anton@correo.com', 'b2ee0a118f1576ccfea8567ecc85d119', 'Anton', 0, 1, ''),
(4, 'pepa@gmail.com', '249b8462274a13245a81f71f689e3131', 'pepa', 1, 1, ''),
(5, 'aefaf@fevweweve-com', '3b2285b348e95774cb556cb36e583106', 'popo', 1, 1, NULL),
(8, 'eafaefaefaeaegaga@hotmail.com', 'b87169802df8a1ed48124d324b960e8e', 'fsrgsgrgs', 0, 1, NULL),
(9, 'èè@papa.com', '3039d9ce326e3c3a6b772e882f09879b', 'efefe', 0, 1, NULL),
(10, '	pepe@papa.com', 'a5ff034660bff8ce89637ece84e0cff1', 'wefwfw', 0, 1, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
