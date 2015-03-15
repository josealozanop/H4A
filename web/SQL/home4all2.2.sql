-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-03-2015 a las 17:53:44
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `home4all`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dispositivo`
--

CREATE TABLE IF NOT EXISTS `dispositivo` (
  `id_dispositivo` int(11) NOT NULL AUTO_INCREMENT,
  `mac_dispositivo` varchar(45) NOT NULL,
  `uDefecto_dispositivo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_dispositivo`),
  UNIQUE KEY `mac_dispositivo_UNIQUE` (`mac_dispositivo`),
  UNIQUE KEY `id_dispositivo_UNIQUE` (`id_dispositivo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `dispositivo`
--

INSERT INTO `dispositivo` (`id_dispositivo`, `mac_dispositivo`, `uDefecto_dispositivo`) VALUES
(15, '10', 50),
(16, '12', 0),
(17, '15656', 0),
(18, '111', 50),
(19, '', 0),
(20, 'fds', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dispositivo_usuario`
--

CREATE TABLE IF NOT EXISTS `dispositivo_usuario` (
  `id_dispositivo_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_dispositivo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_dispositivo_usuario`),
  UNIQUE KEY `id_dispositivo_usuario_UNIQUE` (`id_dispositivo_usuario`),
  KEY `usuarios_idx` (`id_usuario`),
  KEY `dispositivos_idx` (`id_dispositivo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `dispositivo_usuario`
--

INSERT INTO `dispositivo_usuario` (`id_dispositivo_usuario`, `id_dispositivo`, `id_usuario`) VALUES
(11, 15, 50),
(12, 15, 59),
(13, 16, 58),
(14, 16, 46),
(15, 18, 50),
(16, 19, 59);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE IF NOT EXISTS `habitacion` (
  `id_habitacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_vivienda` int(11) DEFAULT NULL,
  `tipo_habitacion` varchar(45) DEFAULT NULL,
  `id_sensores` int(11) DEFAULT NULL,
  `id_propietario` int(11) DEFAULT NULL,
  `id_usuarios` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_habitacion`),
  UNIQUE KEY `id_habitacion_UNIQUE` (`id_habitacion`),
  KEY `habitacion_propietario_idx` (`id_propietario`),
  KEY `habitacion_vivienda_idx` (`id_vivienda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion_usuario`
--

CREATE TABLE IF NOT EXISTS `habitacion_usuario` (
  `id_habitacion_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_habitacion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_habitacion_usuario`),
  UNIQUE KEY `id_habitacion_usuario_UNIQUE` (`id_habitacion_usuario`),
  KEY `habitacionUs_idx` (`id_habitacion`),
  KEY `usuarioHab_idx` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sensor`
--

CREATE TABLE IF NOT EXISTS `sensor` (
  `id_sensor` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_habitacion` int(11) DEFAULT NULL,
  `codigo_sensor` varchar(100) DEFAULT NULL,
  `nombre_sensor` varchar(45) DEFAULT NULL,
  `senact_sensor` int(11) DEFAULT NULL,
  `tipo_sensor` varchar(45) DEFAULT NULL,
  `modelo_sensor` varchar(70) DEFAULT NULL,
  `descripcion_sensor` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_sensor`),
  UNIQUE KEY `id_sensor_UNIQUE` (`id_sensor`),
  KEY `sensorhab_idx` (`id_habitacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sensor_usuario`
--

CREATE TABLE IF NOT EXISTS `sensor_usuario` (
  `id_sensor_usuario` int(11) NOT NULL,
  `id_sensor` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_sensor_usuario`),
  KEY `sensorUs_idx` (`id_sensor`),
  KEY `usuarioSen_idx` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutor`
--

CREATE TABLE IF NOT EXISTS `tutor` (
  `id_tutor` int(11) NOT NULL AUTO_INCREMENT,
  `mail_tutor` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  `pass_tutor` varchar(300) CHARACTER SET utf8mb4 NOT NULL,
  `roles` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  `nombre_tutor` varchar(45) DEFAULT NULL,
  `apellidos_tutor` varchar(45) DEFAULT NULL,
  `tlfn_tutor` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_tutor`),
  UNIQUE KEY `id_tutor_UNIQUE` (`id_tutor`),
  UNIQUE KEY `nUsuario_tutor_UNIQUE` (`mail_tutor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `tutor`
--

INSERT INTO `tutor` (`id_tutor`, `mail_tutor`, `pass_tutor`, `roles`, `nombre_tutor`, `apellidos_tutor`, `tlfn_tutor`) VALUES
(4, 'jose@gmail.com', 'Eti36Ru/pWG6WfoIPiDFUBxUuyvgMA4L8+LLuGbGyqV9ATuT9brCWPchBqX5vFTF+DgntacecW+sSGD+GZts2A==', 'ROLE_USER', 'Jose', 'jose@gmail.com', '958454545'),
(5, 'pepe@gmail.com', 'Eti36Ru/pWG6WfoIPiDFUBxUuyvgMA4L8+LLuGbGyqV9ATuT9brCWPchBqX5vFTF+DgntacecW+sSGD+GZts2A==', 'ROLE_USER', NULL, NULL, NULL),
(6, 'fds@fds.c', 'iOgyhdY1gJJPj7y7mMN8obgqMQZH2fLDuQuXfqZesC1Iqxo6iHxRuAA9m8E1ZUz76OIiPGTann7uJ3BNhPDoEA==', 'ROLE_USER', 'daf', 'dsa', '45646'),
(7, 'df@fd.s', 'HikvAWvqSSMcKhpEXpd8s2NQetFeD7SSmLiLcqjzQWLPohKfq9jcv7AbtdiCzRM8J16wV3kTUK97oWBhQRCGKg==', 'ROLE_USER', 'fd', 'dsa', '45646'),
(8, 'dsa@da.c', 'Vdbm7LMUbfL6Wm1WDrTLshjJD5r50nPo/ABPfoCRBAff6IdF0TP160zGRILuVYIHXyoDyhTV/BvquNQgEY2uew==', 'ROLE_USER', 'da', 'dfs', '456'),
(9, 'fds@ds.c', 'Vdbm7LMUbfL6Wm1WDrTLshjJD5r50nPo/ABPfoCRBAff6IdF0TP160zGRILuVYIHXyoDyhTV/BvquNQgEY2uew==', 'ROLE_USER', 'ds', 'a', '2'),
(10, 'fds@gj7.b', 'Vdbm7LMUbfL6Wm1WDrTLshjJD5r50nPo/ABPfoCRBAff6IdF0TP160zGRILuVYIHXyoDyhTV/BvquNQgEY2uew==', 'ROLE_USER', 'fs', 'a', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutor_dispositivo`
--

CREATE TABLE IF NOT EXISTS `tutor_dispositivo` (
  `id_tutor_dispositivo` int(11) NOT NULL AUTO_INCREMENT,
  `id_tutor` int(11) NOT NULL,
  `id_dispositivo` int(11) NOT NULL,
  `nombre_dispositivo` varchar(45) NOT NULL,
  PRIMARY KEY (`id_tutor_dispositivo`),
  KEY `tutorDis_idx` (`id_tutor`),
  KEY `DispositivoTut_idx` (`id_dispositivo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `tutor_dispositivo`
--

INSERT INTO `tutor_dispositivo` (`id_tutor_dispositivo`, `id_tutor`, `id_dispositivo`, `nombre_dispositivo`) VALUES
(9, 4, 15, 'dispo2'),
(10, 4, 16, 'disdsa'),
(11, 5, 16, 'posyaves'),
(12, 5, 17, 'posyaves'),
(13, 4, 18, 'fdsfdsafs'),
(14, 4, 19, 'fsd'),
(15, 4, 20, 'fsdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutor_usuario`
--

CREATE TABLE IF NOT EXISTS `tutor_usuario` (
  `id_tutor` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tutor_usuario` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`tutor_usuario`),
  KEY `id_usuario_idx` (`id_usuario`),
  KEY `tutoresUs` (`id_tutor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `tutor_usuario`
--

INSERT INTO `tutor_usuario` (`id_tutor`, `id_usuario`, `tutor_usuario`) VALUES
(5, 46, 10),
(4, 50, 14),
(4, 58, 16),
(4, 59, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `mail_usuario` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  `pass_usuario` varchar(300) CHARACTER SET utf8mb4 NOT NULL,
  `roles` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  `nombre_usuario` varchar(45) DEFAULT NULL,
  `apellidos_usuario` varchar(45) DEFAULT NULL,
  `foto_usuario` varchar(300) DEFAULT NULL,
  `tlfn_usuario` varchar(45) DEFAULT NULL,
  `fnac_usuario` varchar(45) DEFAULT NULL,
  `direccion_usuario` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `id_usuario_UNIQUE` (`id_usuario`),
  UNIQUE KEY `nUsuario_usuario_UNIQUE` (`mail_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=60 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `mail_usuario`, `pass_usuario`, `roles`, `nombre_usuario`, `apellidos_usuario`, `foto_usuario`, `tlfn_usuario`, `fnac_usuario`, `direccion_usuario`) VALUES
(46, 'cojjo@gmail.com', 'Eti36Ru/pWG6WfoIPiDFUBxUuyvgMA4L8+LLuGbGyqV9ATuT9brCWPchBqX5vFTF+DgntacecW+sSGD+GZts2A==', 'ROLE_USER', '', 'cojooo', NULL, NULL, NULL, NULL),
(50, 'langui@gmail.com', '1234', 'ROLE_USER', 'languini', 'cojo', NULL, '5659582', '2015-03-02', NULL),
(56, 'Stepen@gmai.com', 'Eti36Ru/pWG6WfoIPiDFUBxUuyvgMA4L8+LLuGbGyqV9ATuT9brCWPchBqX5vFTF+DgntacecW+sSGD+GZts2A==', 'ROLE_USER', 'Stehen', 'Haking', NULL, '6545421', '2014-05-16', NULL),
(58, 'fdsa@fds', '+HTkQngWRDTrxBn3jmM7Nx1THQwcmBWLyE16YAN0HXl6nGP0WZDJNXmGRhix5owBc1/KClOSojU+0vDb5MieDA==', 'ROLE_USER', '', '', NULL, '', '', NULL),
(59, 'fdsfd@fds.d', '+HTkQngWRDTrxBn3jmM7Nx1THQwcmBWLyE16YAN0HXl6nGP0WZDJNXmGRhix5owBc1/KClOSojU+0vDb5MieDA==', 'ROLE_USER', 'dsa', 'k', NULL, '', '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vivienda`
--

CREATE TABLE IF NOT EXISTS `vivienda` (
  `id_vivienda` int(11) NOT NULL AUTO_INCREMENT,
  `direccion_vivienda` varchar(45) DEFAULT NULL,
  `localidad_vivienda` varchar(45) DEFAULT NULL,
  `provincia_vivienda` varchar(45) DEFAULT NULL,
  `cp_vivienda` varchar(45) DEFAULT NULL,
  `habitaciones_vivienda` int(11) DEFAULT NULL,
  `uso_vivienda` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_vivienda`),
  UNIQUE KEY `id_vivienda_UNIQUE` (`id_vivienda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dispositivo_usuario`
--
ALTER TABLE `dispositivo_usuario`
  ADD CONSTRAINT `dispositivosUs` FOREIGN KEY (`id_dispositivo`) REFERENCES `dispositivo` (`id_dispositivo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuariosDis` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD CONSTRAINT `habitacion_propietario` FOREIGN KEY (`id_propietario`) REFERENCES `usuario` (`id_usuario`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `habitacion_vivienda` FOREIGN KEY (`id_vivienda`) REFERENCES `vivienda` (`id_vivienda`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `habitacion_usuario`
--
ALTER TABLE `habitacion_usuario`
  ADD CONSTRAINT `habitacionUs` FOREIGN KEY (`id_habitacion`) REFERENCES `habitacion` (`id_habitacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarioHab` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sensor`
--
ALTER TABLE `sensor`
  ADD CONSTRAINT `sensorhab` FOREIGN KEY (`id_habitacion`) REFERENCES `habitacion` (`id_habitacion`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `sensor_usuario`
--
ALTER TABLE `sensor_usuario`
  ADD CONSTRAINT `sensorUs` FOREIGN KEY (`id_sensor`) REFERENCES `sensor` (`id_sensor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarioSen` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tutor_dispositivo`
--
ALTER TABLE `tutor_dispositivo`
  ADD CONSTRAINT `DispositivoTut` FOREIGN KEY (`id_dispositivo`) REFERENCES `dispositivo` (`id_dispositivo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tutorDis` FOREIGN KEY (`id_tutor`) REFERENCES `tutor` (`id_tutor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tutor_usuario`
--
ALTER TABLE `tutor_usuario`
  ADD CONSTRAINT `tutoresUs` FOREIGN KEY (`id_tutor`) REFERENCES `tutor` (`id_tutor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuariosTut` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
