-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-06-2015 a las 18:54:06
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
-- Estructura de tabla para la tabla `configuracion_usuario`
--

CREATE TABLE IF NOT EXISTS `configuracion_usuario` (
  `id_configuracion_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `color_principal` varchar(10) DEFAULT NULL,
  `color_secundario` varchar(10) DEFAULT NULL,
  `contraste` int(1) unsigned DEFAULT NULL,
  `tam_letra` int(11) DEFAULT NULL,
  `barrido` int(1) unsigned DEFAULT NULL,
  `tiempo_barrido` int(11) DEFAULT NULL,
  `reconocimiento_voz` int(1) unsigned DEFAULT NULL,
  `retroalimentacion_vibracion` int(1) unsigned DEFAULT NULL,
  `retroalimentacion_voz` int(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_configuracion_usuario`),
  UNIQUE KEY `id_configuracion_usuario_UNIQUE` (`id_configuracion_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 AUTO_INCREMENT=1 ;

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
(17, '15656', 0),
(18, '111', 59),
(19, '12', NULL),
(20, '1231', 67);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dispositivo_usuario`
--

CREATE TABLE IF NOT EXISTS `dispositivo_usuario` (
  `id_dispositivo_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_dispositivo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `rotacion` int(1) unsigned DEFAULT NULL,
  `filas_vertical` int(11) DEFAULT NULL,
  `columnas_vertical` int(11) DEFAULT NULL,
  `filas_horizontal` int(11) DEFAULT NULL,
  `columnas_horizantal` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_dispositivo_usuario`),
  UNIQUE KEY `id_dispositivo_usuario_UNIQUE` (`id_dispositivo_usuario`),
  UNIQUE KEY `dispositivoUsuario` (`id_dispositivo`,`id_usuario`),
  KEY `usuarios_idx` (`id_usuario`),
  KEY `dispositivos_idx` (`id_dispositivo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=63 ;

--
-- Volcado de datos para la tabla `dispositivo_usuario`
--

INSERT INTO `dispositivo_usuario` (`id_dispositivo_usuario`, `id_dispositivo`, `id_usuario`, `rotacion`, `filas_vertical`, `columnas_vertical`, `filas_horizontal`, `columnas_horizantal`) VALUES
(23, 18, 59, NULL, NULL, NULL, NULL, NULL),
(24, 18, 58, NULL, NULL, NULL, NULL, NULL),
(29, 18, 66, NULL, NULL, NULL, NULL, NULL),
(31, 18, 67, NULL, NULL, NULL, NULL, NULL),
(32, 20, 67, NULL, NULL, NULL, NULL, NULL),
(34, 20, 68, NULL, NULL, NULL, NULL, NULL),
(36, 18, 69, NULL, NULL, NULL, NULL, NULL),
(37, 20, 70, NULL, NULL, NULL, NULL, NULL),
(43, 20, 75, NULL, NULL, NULL, NULL, NULL),
(44, 20, 76, NULL, NULL, NULL, NULL, NULL),
(45, 18, 76, NULL, NULL, NULL, NULL, NULL),
(46, 20, 77, NULL, NULL, NULL, NULL, NULL),
(49, 20, 78, NULL, NULL, NULL, NULL, NULL),
(50, 20, 79, NULL, NULL, NULL, NULL, NULL),
(51, 18, 79, NULL, NULL, NULL, NULL, NULL),
(52, 19, 65, NULL, NULL, NULL, NULL, NULL),
(53, 19, 67, NULL, NULL, NULL, NULL, NULL),
(54, 19, 68, NULL, NULL, NULL, NULL, NULL),
(55, 19, 69, NULL, NULL, NULL, NULL, NULL),
(56, 19, 70, NULL, NULL, NULL, NULL, NULL),
(57, 19, 71, NULL, NULL, NULL, NULL, NULL),
(58, 19, 72, NULL, NULL, NULL, NULL, NULL),
(59, 19, 73, NULL, NULL, NULL, NULL, NULL),
(60, 19, 74, NULL, NULL, NULL, NULL, NULL),
(61, 19, 77, NULL, NULL, NULL, NULL, NULL),
(62, 19, 78, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE IF NOT EXISTS `habitacion` (
  `id_habitacion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_habitacion` varchar(50) NOT NULL,
  `id_vivienda` int(11) DEFAULT NULL,
  `tipo_habitacion` varchar(45) DEFAULT NULL,
  `id_sensores` int(11) DEFAULT NULL,
  `id_propietario` int(11) DEFAULT NULL,
  `id_usuarios` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_habitacion`),
  UNIQUE KEY `id_habitacion_UNIQUE` (`id_habitacion`),
  KEY `habitacion_propietario_idx` (`id_propietario`),
  KEY `habitacion_vivienda_idx` (`id_vivienda`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`id_habitacion`, `nombre_habitacion`, `id_vivienda`, `tipo_habitacion`, `id_sensores`, `id_propietario`, `id_usuarios`) VALUES
(15, 'hab2', NULL, 'Dormitorio', NULL, 0, NULL),
(16, 'hab3', NULL, 'Dormitorio', NULL, 0, NULL),
(17, 'hab4', NULL, 'Otros', NULL, 0, NULL),
(18, 'hab5', NULL, 'Dormitorio', NULL, 0, NULL),
(19, 'hab9', NULL, 'Dormitorio', NULL, 0, NULL),
(21, 'hab77', NULL, 'Dormitorio', NULL, 0, NULL),
(22, 'habprueba', NULL, 'Dormitorio', NULL, 0, NULL),
(23, 'pru2', NULL, 'Dormitorio', NULL, 0, NULL),
(24, 're', NULL, 'Dormitorio', NULL, 0, NULL),
(25, 'fsd', NULL, 'Dormitorio', NULL, 0, NULL),
(26, 'gfd', NULL, 'Dormitorio', NULL, 0, NULL),
(27, 'ds', NULL, 'Dormitorio', NULL, 72, NULL);

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
-- Estructura de tabla para la tabla `sensoractuador`
--

CREATE TABLE IF NOT EXISTS `sensoractuador` (
  `Id_Sensor` varchar(20) NOT NULL,
  `PIN` int(11) NOT NULL,
  `Tipo` varchar(20) NOT NULL,
  `TipoValor` varchar(20) DEFAULT NULL,
  `Valor` int(11) DEFAULT NULL,
  `Localizacion` varchar(20) DEFAULT NULL,
  `id_sen` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_habitacion` int(11) DEFAULT NULL,
  `codigo_sensor` varchar(100) DEFAULT NULL,
  `nombre_sensor` varchar(45) DEFAULT NULL,
  `senact_sensor` int(11) DEFAULT NULL,
  `tipo_sensor` varchar(45) DEFAULT NULL,
  `modelo_sensor` varchar(70) DEFAULT NULL,
  `descripcion_sensor` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_sen`),
  UNIQUE KEY `id_sensor_UNIQUE` (`id_sen`),
  KEY `sensorhab_idx` (`id_habitacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `sensoractuador`
--

INSERT INTO `sensoractuador` (`Id_Sensor`, `PIN`, `Tipo`, `TipoValor`, `Valor`, `Localizacion`, `id_sen`, `id_usuario`, `id_habitacion`, `codigo_sensor`, `nombre_sensor`, `senact_sensor`, `tipo_sensor`, `modelo_sensor`, `descripcion_sensor`) VALUES
('3', 1, '', 'Analógico', 0, NULL, 3, NULL, 15, 'Jb5621', 'act1', 1, 'Actuador', 'Motor DC v48', 'motor de persiana para arduino'),
('4', 0, '', NULL, NULL, NULL, 4, 0, 27, '234', 'sensor voz', 1, 'voz', 'v65453', 'sensor de voz para escuchar'),
('5', 1, '', 'Sensor', 0, NULL, 5, 0, 27, 'ab12', 'sensor10', NULL, NULL, 'dsadsr455', 'sensor de luz'),
('7', 1, '', 'Sensor', 0, NULL, 7, 0, NULL, 'dsa', 'sensor 4', NULL, NULL, 'fa', 'sensor cuatro'),
('8', 1, '', 'Sensor', 0, NULL, 8, 0, NULL, 'sda', 'sensor 3', NULL, NULL, 'nja', 'sensor tres'),
('15', 1, '', 'Sensor', 0, NULL, 15, NULL, NULL, 'fs', 'ddsa', NULL, NULL, 'gfs', 'hu'),
('16', 1, '', 'Sensor', 0, NULL, 16, NULL, NULL, 'ds', 'sen22', NULL, NULL, 'j', 'j'),
('17', 13, 'sensor de luz', 'Sensor', 0, NULL, 17, NULL, NULL, '124541', 'sensor 18', 0, NULL, 'modelo2', 'es un sensor de luz'),
('18', 12, 'Actuador', 'Analógico', 0, NULL, 18, NULL, NULL, '1234cod', 'sensor 55', 1, 'es de tipo luminoso', 'mod1234', 'Sensor de alta preision');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sensor_usuario`
--

CREATE TABLE IF NOT EXISTS `sensor_usuario` (
  `id_sensor_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_sensor` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_sensor_usuario`),
  UNIQUE KEY `sensorUsuario` (`id_sensor`,`id_usuario`),
  KEY `sensorUs_idx` (`id_sensor`),
  KEY `usuarioSen_idx` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=337 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `tutor`
--

INSERT INTO `tutor` (`id_tutor`, `mail_tutor`, `pass_tutor`, `roles`, `nombre_tutor`, `apellidos_tutor`, `tlfn_tutor`) VALUES
(4, 'jose@gmail.com', 'Eti36Ru/pWG6WfoIPiDFUBxUuyvgMA4L8+LLuGbGyqV9ATuT9brCWPchBqX5vFTF+DgntacecW+sSGD+GZts2A==', 'ROLE_USER', 'Jose', 'jose@gmail.com', '958454545'),
(5, 'pepe@gmail.com', 'Eti36Ru/pWG6WfoIPiDFUBxUuyvgMA4L8+LLuGbGyqV9ATuT9brCWPchBqX5vFTF+DgntacecW+sSGD+GZts2A==', 'ROLE_ADMIN', NULL, NULL, NULL),
(6, 'fds@fds.c', 'iOgyhdY1gJJPj7y7mMN8obgqMQZH2fLDuQuXfqZesC1Iqxo6iHxRuAA9m8E1ZUz76OIiPGTann7uJ3BNhPDoEA==', 'ROLE_USER', 'daf', 'dsa', '45646'),
(7, 'df@fd.s', 'HikvAWvqSSMcKhpEXpd8s2NQetFeD7SSmLiLcqjzQWLPohKfq9jcv7AbtdiCzRM8J16wV3kTUK97oWBhQRCGKg==', 'ROLE_USER', 'fd', 'dsa', '45646'),
(8, 'dsa@da.c', 'Vdbm7LMUbfL6Wm1WDrTLshjJD5r50nPo/ABPfoCRBAff6IdF0TP160zGRILuVYIHXyoDyhTV/BvquNQgEY2uew==', 'ROLE_USER', 'da', 'dfs', '456'),
(9, 'fds@ds.c', 'Vdbm7LMUbfL6Wm1WDrTLshjJD5r50nPo/ABPfoCRBAff6IdF0TP160zGRILuVYIHXyoDyhTV/BvquNQgEY2uew==', 'ROLE_USER', 'ds', 'a', '2'),
(10, 'fds@gj7.b', 'Vdbm7LMUbfL6Wm1WDrTLshjJD5r50nPo/ABPfoCRBAff6IdF0TP160zGRILuVYIHXyoDyhTV/BvquNQgEY2uew==', 'ROLE_USER', 'fs', 'a', '2'),
(11, 'aaa@aa.a', 'Eti36Ru/pWG6WfoIPiDFUBxUuyvgMA4L8+LLuGbGyqV9ATuT9brCWPchBqX5vFTF+DgntacecW+sSGD+GZts2A==', 'ROLE_USER', 'dsa', '', ''),
(12, 'sss@ss.s', '/59K6CZnuw4UT4J6Z/sLs5Gqnd5//B3inUalJvA8KMWpfo2FfA4e7DGph1G0IfxXQShWACFnqHPpTKz7yKXlsw==', 'ROLE_USER', 'ds', '', ''),
(13, 'estrella', 'Vdbm7LMUbfL6Wm1WDrTLshjJD5r50nPo/ABPfoCRBAff6IdF0TP160zGRILuVYIHXyoDyhTV/BvquNQgEY2uew==', 'ROLE_USER', '', '', '');

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
(12, 5, 17, 'posyaves'),
(13, 4, 18, 'disp1'),
(14, 4, 19, 'disp4'),
(15, 4, 20, 'disp3');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=42 ;

--
-- Volcado de datos para la tabla `tutor_usuario`
--

INSERT INTO `tutor_usuario` (`id_tutor`, `id_usuario`, `tutor_usuario`) VALUES
(5, 46, 10),
(4, 58, 16),
(4, 59, 17),
(4, 60, 18),
(4, 61, 19),
(4, 62, 20),
(4, 63, 21),
(4, 64, 22),
(4, 65, 23),
(4, 66, 24),
(4, 67, 25),
(4, 68, 26),
(4, 69, 27),
(4, 70, 28),
(4, 71, 29),
(4, 72, 30),
(4, 73, 31),
(4, 74, 32),
(4, 75, 33),
(4, 76, 34),
(4, 77, 35),
(4, 78, 36),
(4, 79, 37),
(4, 80, 38),
(4, 81, 39),
(4, 82, 40),
(4, 83, 41);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `mail_usuario` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  `pass_usuario` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=84 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `mail_usuario`, `pass_usuario`, `roles`, `nombre_usuario`, `apellidos_usuario`, `foto_usuario`, `tlfn_usuario`, `fnac_usuario`, `direccion_usuario`) VALUES
(46, 'cojjo@gmail.com', 0, 'ROLE_FO', 'required', 'cojo', NULL, '12', '2015-05-23', NULL),
(56, 'coj@gmail.com', 0, 'ROLE_USER', 'Stehen', 'Haking', NULL, '6545421', '2014-05-16', NULL),
(58, 'fdsa@fds', 0, 'ROLE_USER', '', '', NULL, '', '', NULL),
(59, '', 0, 'ROLE_USER', NULL, NULL, NULL, NULL, NULL, NULL),
(60, 'fdsa@fds.d', 3, 'ROLE_USER', 'vcx', 'fs', NULL, '', '', NULL),
(61, 'scd@ds.s', 3, 'ROLE_USER', 'ad', 'da', NULL, '', '', NULL),
(62, 'fdsa@fds.fd', 3, 'ROLE_USER', 'fsd', 'fds', NULL, '', '1988-02-17', NULL),
(63, 'fds@fds.f', 3, 'ROLE_USER', 'ds', 'nk', NULL, '', '', NULL),
(64, 'fds@dfa.dsfds', 3, 'ROLE_USER', 'fs', 'fd', NULL, '', '2012-02-29', NULL),
(65, 'da@fds.c', 3, 'ROLE_USER', 'csd', 'fds', NULL, '', '', NULL),
(66, 'fds@da.f', 3, 'ROLE_USER', 'f', 'f', NULL, '', '', NULL),
(67, 'jose@mail.com', 0, 'ROLE_USER', 'jose', 'lozano', NULL, '654875421', '', NULL),
(68, 'minus@d.s', 3, 'ROLE_USER', 'minus', 'muuuus', NULL, '', '', NULL),
(69, 'fs@fs.s', 3, 'ROLE_USER', 'd', 'd', NULL, '', '', NULL),
(70, 'a@a.c', 3, 'ROLE_USER', 'd', 'd', NULL, '', '', NULL),
(71, 'j@d.a', 3, 'ROLE_USER', 'a', 'd', NULL, '', '', NULL),
(72, 'usuarios@gmail.com', 3, 'ROLE_USER', 'usus', 'sensus', NULL, '', '', NULL),
(73, 'qq@aa.s', 3, 'ROLE_USER', 'aass', 'qqaa', NULL, '', '', NULL),
(74, 'da@f.f', 3, 'ROLE_USER', 'f', 'f', NULL, '', '', NULL),
(75, 'g@g.s', 3, 'ROLE_USER', 's', 's', NULL, '', '', NULL),
(76, 'as@e.s', 3, 'ROLE_USER', 's', 's', NULL, '', '', NULL),
(77, 's.d@d', 3, 'ROLE_USER', 'da', 'd', NULL, '', '', NULL),
(78, 'fdsa@fds.a', 0, 'ROLE_USER', 'f', '4', NULL, '', '', NULL),
(79, 'asd@d.d', 3, 'ROLE_USER', 'd', 'da', NULL, '', '', NULL),
(80, 'das@sd.d', 3, 'ROLE_USER', 'fsd', 'a', NULL, '', '', NULL),
(81, 'dfs@g.trr', 3, 'ROLE_USER', 'l', 'l', NULL, '', '', NULL),
(82, 'fsd@gdf.f', 3, 'ROLE_USER', 'fs', 'sf', NULL, '', '', NULL),
(83, 'weq@ea.f', 3, 'ROLE_USER', 'f', 'f', NULL, '', '', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `vivienda`
--

INSERT INTO `vivienda` (`id_vivienda`, `direccion_vivienda`, `localidad_vivienda`, `provincia_vivienda`, `cp_vivienda`, `habitaciones_vivienda`, `uso_vivienda`) VALUES
(1, 'Estrella', 'Peligros', 'Granadaa', '', NULL, NULL);

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
  ADD CONSTRAINT `habitacion_vivienda` FOREIGN KEY (`id_vivienda`) REFERENCES `vivienda` (`id_vivienda`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `habitacion_usuario`
--
ALTER TABLE `habitacion_usuario`
  ADD CONSTRAINT `habitacionUs` FOREIGN KEY (`id_habitacion`) REFERENCES `habitacion` (`id_habitacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarioHab` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sensoractuador`
--
ALTER TABLE `sensoractuador`
  ADD CONSTRAINT `sensorHabitacion` FOREIGN KEY (`id_habitacion`) REFERENCES `habitacion` (`id_habitacion`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `sensor_usuario`
--
ALTER TABLE `sensor_usuario`
  ADD CONSTRAINT `sensorUs` FOREIGN KEY (`id_sensor`) REFERENCES `sensoractuador` (`id_sen`) ON DELETE CASCADE ON UPDATE CASCADE,
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
