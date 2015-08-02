-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-08-2015 a las 11:09:04
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=109 ;

--
-- Volcado de datos para la tabla `configuracion_usuario`
--

INSERT INTO `configuracion_usuario` (`id_configuracion_usuario`, `color_principal`, `color_secundario`, `contraste`, `tam_letra`, `barrido`, `tiempo_barrido`, `reconocimiento_voz`, `retroalimentacion_vibracion`, `retroalimentacion_voz`) VALUES
(2, 'blue', 'white', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'blue', 'white', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(5, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(6, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(9, '#265a88', '#eb9316', 1, 12, NULL, 4, NULL, NULL, NULL),
(10, '#265a88', '#eb9316', 1, 12, 1, 6, NULL, NULL, NULL),
(11, '#265a88', '#eb9316', 1, 12, NULL, 4, NULL, NULL, NULL),
(12, '#265a88', '#eb9316', 1, 12, 1, 4, NULL, NULL, NULL),
(13, '#265a88', '#eb9316', 1, 12, 1, 4, NULL, NULL, NULL),
(14, '#265a88', '#eb9316', 1, 12, 1, 4, NULL, NULL, NULL),
(15, '#265a88', '#eb9316', 1, 12, 1, 4, NULL, 1, NULL),
(16, '#265a88', '#eb9316', 1, 12, 1, 4, NULL, 1, NULL),
(17, '#265a88', '#eb9316', 1, 12, NULL, 4, NULL, 1, NULL),
(18, '#265a88', '#eb9316', 1, 12, NULL, 4, NULL, 1, 1),
(19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(20, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(21, '#c12e2a', '#CC2EFA', 1, 12, 0, 4, 0, 0, 0),
(22, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(23, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(24, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(25, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(26, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(27, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(28, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(29, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(30, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(31, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(32, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(33, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(34, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(35, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(36, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(37, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(38, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(39, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(40, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(41, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(42, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(43, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(44, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(45, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(46, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(47, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(48, '#265a88', '#eb9316', 1, 99, 0, 4, 0, 0, 0),
(49, '#265a88', '#eb9316', 1, 99, 0, 4, 0, 0, 0),
(50, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(51, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(52, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(53, '#265a88', '#eb9316', 1, 99, 0, 4, 0, 0, 0),
(54, '#265a88', '#eb9316', 1, 99, 0, 4, 0, 0, 0),
(55, '#265a88', '#eb9316', 1, 99, 0, 4, 0, 0, 0),
(56, '#265a88', '#eb9316', 1, 99, 0, 4, 0, 0, 0),
(57, '#265a88', '#eb9316', 1, 99, 0, 4, 0, 0, 0),
(58, '#265a88', '#eb9316', 1, 99, 0, 4, 0, 0, 0),
(59, '#265a88', '#eb9316', 1, 99, 0, 4, 0, 0, 0),
(60, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(61, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(62, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(63, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(64, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(65, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(66, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(67, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(68, '#265a88', '#eb9316', 1, 77, 0, 4, 0, 0, 0),
(69, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(70, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(71, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(72, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(73, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(74, '#265a88', '#eb9316', 1, 56, 0, 4, 0, 0, 0),
(75, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(76, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(77, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(78, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(79, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(80, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(81, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(82, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(83, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(84, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(85, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(86, '#265a88', '#eb9316', 1, 555, 0, 4, 0, 0, 0),
(88, '#265a88', '#eb9316', 1, 553, 0, 4, 0, 0, 0),
(89, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(90, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(91, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0),
(92, '#265a88', '#eb9316', 1, 77, 0, 4, 0, 0, 0),
(93, '#265a88', '#eb9316', 1, 12, 1, 4, 0, 0, 0),
(94, '#265a88', '#eb9316', 1, 12, 1, 2, 0, 0, 0),
(96, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(97, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(98, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(99, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(100, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(101, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(102, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(103, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(104, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(105, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(106, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(107, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(108, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=27 ;

--
-- Volcado de datos para la tabla `dispositivo`
--

INSERT INTO `dispositivo` (`id_dispositivo`, `mac_dispositivo`, `uDefecto_dispositivo`) VALUES
(17, '15656', 0),
(18, '111', 59),
(19, '12', NULL),
(20, '1231', 67),
(21, 'aa-5A-B6-93-45-5D', 84),
(22, '4A-5A-B6-93-77-5D', 0),
(23, '4A-5A-B6-93-45-77', 0),
(25, '4A-5A-B6-93-55-5D', 116),
(26, '4A-5A-B6-93-45-5D', 0);

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
  `columnas_horizontal` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_dispositivo_usuario`),
  UNIQUE KEY `id_dispositivo_usuario_UNIQUE` (`id_dispositivo_usuario`),
  UNIQUE KEY `dispositivoUsuario` (`id_dispositivo`,`id_usuario`),
  KEY `usuarios_idx` (`id_usuario`),
  KEY `dispositivos_idx` (`id_dispositivo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=134 ;

--
-- Volcado de datos para la tabla `dispositivo_usuario`
--

INSERT INTO `dispositivo_usuario` (`id_dispositivo_usuario`, `id_dispositivo`, `id_usuario`, `rotacion`, `filas_vertical`, `columnas_vertical`, `filas_horizontal`, `columnas_horizontal`) VALUES
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
(62, 19, 78, NULL, NULL, NULL, NULL, NULL),
(63, 21, 84, NULL, NULL, NULL, NULL, NULL),
(64, 21, 85, NULL, NULL, NULL, NULL, NULL),
(65, 21, 86, NULL, NULL, NULL, NULL, NULL),
(66, 22, 87, NULL, NULL, NULL, NULL, NULL),
(67, 21, 87, NULL, NULL, NULL, NULL, NULL),
(68, 21, 88, NULL, NULL, NULL, NULL, NULL),
(69, 22, 88, NULL, NULL, NULL, NULL, NULL),
(70, 21, 89, NULL, NULL, NULL, NULL, NULL),
(71, 22, 89, NULL, NULL, NULL, NULL, NULL),
(72, 23, 91, NULL, NULL, NULL, NULL, NULL),
(73, 21, 91, NULL, NULL, NULL, NULL, NULL),
(74, 22, 91, NULL, NULL, NULL, NULL, NULL),
(75, 23, 92, NULL, NULL, NULL, NULL, NULL),
(76, 21, 92, NULL, NULL, NULL, NULL, NULL),
(77, 22, 92, NULL, NULL, NULL, NULL, NULL),
(78, 23, 93, NULL, NULL, NULL, NULL, NULL),
(79, 21, 93, NULL, NULL, NULL, NULL, NULL),
(80, 23, 94, NULL, NULL, NULL, NULL, NULL),
(81, 23, 95, NULL, NULL, NULL, NULL, NULL),
(82, 21, 95, NULL, NULL, NULL, NULL, NULL),
(83, 22, 95, NULL, NULL, NULL, NULL, NULL),
(84, 22, 96, NULL, NULL, NULL, NULL, NULL),
(85, 23, 96, NULL, NULL, NULL, NULL, NULL),
(86, 21, 96, NULL, NULL, NULL, NULL, NULL),
(87, 22, 97, 0, NULL, NULL, 3, 3),
(88, 23, 97, 0, NULL, NULL, 3, 3),
(89, 22, 98, NULL, NULL, NULL, NULL, NULL),
(90, 23, 98, NULL, NULL, NULL, NULL, NULL),
(91, 22, 100, 0, NULL, NULL, 3, 3),
(92, 23, 100, 0, NULL, NULL, 3, 3),
(93, 21, 100, 0, NULL, NULL, 3, 3),
(97, 22, 103, 0, NULL, NULL, 3, 3),
(98, 23, 103, 0, NULL, NULL, 3, 3),
(99, 21, 103, 0, NULL, NULL, 3, 3),
(102, 23, 108, NULL, NULL, NULL, NULL, NULL),
(103, 21, 108, NULL, NULL, NULL, NULL, NULL),
(104, 23, 104, NULL, NULL, NULL, NULL, NULL),
(105, 21, 104, NULL, NULL, NULL, NULL, NULL),
(106, 23, 107, NULL, NULL, NULL, NULL, NULL),
(107, 21, 107, NULL, NULL, NULL, NULL, NULL),
(108, 23, 109, NULL, NULL, NULL, NULL, NULL),
(109, 26, 111, 0, NULL, NULL, 3, 3),
(110, 23, 111, 0, NULL, NULL, 3, 3),
(111, 21, 112, 0, NULL, NULL, 4, 4),
(112, 25, 112, 0, NULL, NULL, 3, 3),
(113, 23, 113, 0, NULL, NULL, 6, 3),
(114, 21, 113, 0, NULL, NULL, 3, 3),
(115, 25, 113, 0, NULL, NULL, 3, 3),
(119, 25, 115, 0, NULL, NULL, 3, 3),
(120, 22, 115, 0, NULL, NULL, 3, 3),
(121, 26, 115, 0, NULL, NULL, 3, 3),
(122, 25, 116, 0, NULL, NULL, 3, 3),
(123, 22, 116, 1, 4, 2, 3, 3),
(124, 26, 117, 0, NULL, NULL, 2, 2),
(125, 26, 118, 0, NULL, NULL, 1, 1),
(126, 21, 120, 0, NULL, NULL, 4, 4),
(127, 26, 121, 0, NULL, NULL, 4, 4),
(128, 26, 123, 0, NULL, NULL, 2, 2),
(129, 26, 124, 0, NULL, NULL, 4, 4),
(133, 26, 135, 1, 2, 2, 3, 3);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=41 ;

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`id_habitacion`, `nombre_habitacion`, `id_vivienda`, `tipo_habitacion`, `id_sensores`, `id_propietario`, `id_usuarios`) VALUES
(30, 'Salón', NULL, 'Salon', NULL, 0, NULL),
(31, 'Baño 1', NULL, 'Baño', NULL, 0, NULL),
(32, 'Dormitorio 1', NULL, 'Dormitorio', NULL, 0, NULL),
(33, 'Dormitorio 2', NULL, 'Dormitorio', NULL, 0, NULL),
(34, 'Terraza', NULL, 'Patio', NULL, 0, NULL),
(35, 'Baño 2', NULL, 'Baño', NULL, 0, NULL),
(36, 'Cocina', NULL, 'Cocina', NULL, 0, NULL),
(37, 'Dormitorio Marta', NULL, 'Dormitorio', NULL, 0, NULL),
(38, 'Cochera', NULL, 'Cochera', NULL, 0, NULL),
(39, 'Patio', NULL, 'Patio', NULL, 0, NULL),
(40, 'Comedor', NULL, 'Comedor', NULL, 0, NULL);

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
  UNIQUE KEY `habitacionUsuario` (`id_habitacion`,`id_usuario`),
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
  `valor_min` int(11) NOT NULL DEFAULT '0',
  `valor_max` int(11) NOT NULL DEFAULT '1',
  `incremento` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_sen`),
  UNIQUE KEY `id_sensor_UNIQUE` (`id_sen`),
  KEY `sensorhab_idx` (`id_habitacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=39 ;

--
-- Volcado de datos para la tabla `sensoractuador`
--

INSERT INTO `sensoractuador` (`Id_Sensor`, `PIN`, `Tipo`, `TipoValor`, `Valor`, `Localizacion`, `id_sen`, `id_usuario`, `id_habitacion`, `codigo_sensor`, `nombre_sensor`, `senact_sensor`, `tipo_sensor`, `modelo_sensor`, `descripcion_sensor`, `valor_min`, `valor_max`, `incremento`) VALUES
('33', 2, 'Actuador', '0', 0, NULL, 33, NULL, 30, '_bn0', 'Bombilla1', 1, '', 'bn', '', 0, 1, 1),
('34', 12, 'Actuador', '0', 0, NULL, 34, NULL, 30, '_bn2', 'Bombilla 2', 1, '', 'bn', '', 0, 1, 1),
('35', 12, 'Actuador', '2', 0, NULL, 35, NULL, 30, '_bn2344', 'Aire acondicionado', 1, '', 'bn', '', 18, 30, 1),
('36', 12, 'Actuador', '1', 0, NULL, 36, NULL, 30, '_bn34930948', 'Luz regulable', 1, '', 'bn', '', 0, 3, 1),
('37', 24, 'Actuador', '1', 0, NULL, 37, NULL, 30, '_bn39840938403', 'luz 2', 1, '', 'bn', '', 0, 27, 1),
('38', 12, 'Sensor', '0', 0, NULL, 38, NULL, 30, '_bn_sen_38493840', 'Temperatura', 0, '', 'sen', '', 0, 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=107 ;

--
-- Volcado de datos para la tabla `sensor_usuario`
--

INSERT INTO `sensor_usuario` (`id_sensor_usuario`, `id_sensor`, `id_usuario`) VALUES
(101, 33, 135),
(102, 34, 135),
(103, 35, 135),
(104, 36, 135),
(105, 37, 135),
(106, 38, 135);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=16 ;

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
(13, 'estrella', 'Vdbm7LMUbfL6Wm1WDrTLshjJD5r50nPo/ABPfoCRBAff6IdF0TP160zGRILuVYIHXyoDyhTV/BvquNQgEY2uew==', 'ROLE_USER', '', '', ''),
(14, 'borja@mail.com', '+HTkQngWRDTrxBn3jmM7Nx1THQwcmBWLyE16YAN0HXl6nGP0WZDJNXmGRhix5owBc1/KClOSojU+0vDb5MieDA==', 'ROLE_USER', 'a', 'a', ''),
(15, 'admin@mail.com', 'Eti36Ru/pWG6WfoIPiDFUBxUuyvgMA4L8+LLuGbGyqV9ATuT9brCWPchBqX5vFTF+DgntacecW+sSGD+GZts2A==', 'ROLE_ADMIN', 'admin', 'admin', '');

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
  UNIQUE KEY `tutorDispositivo` (`id_tutor`,`id_dispositivo`),
  KEY `tutorDis_idx` (`id_tutor`),
  KEY `DispositivoTut_idx` (`id_dispositivo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `tutor_dispositivo`
--

INSERT INTO `tutor_dispositivo` (`id_tutor_dispositivo`, `id_tutor`, `id_dispositivo`, `nombre_dispositivo`) VALUES
(12, 5, 17, 'posyaves'),
(13, 4, 18, 'disp1'),
(14, 4, 19, 'disp4'),
(15, 4, 20, 'disp3'),
(16, 14, 21, 'xperia p'),
(17, 14, 22, 'samsumg s3'),
(18, 14, 23, 'lg l3'),
(20, 14, 25, 'Lumia 3300'),
(21, 14, 26, 'sony m3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutor_usuario`
--

CREATE TABLE IF NOT EXISTS `tutor_usuario` (
  `id_tutor` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tutor_usuario` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`tutor_usuario`),
  UNIQUE KEY `tutorUsuario` (`id_tutor`,`id_usuario`),
  KEY `id_usuario_idx` (`id_usuario`),
  KEY `tutoresUs` (`id_tutor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=89 ;

--
-- Volcado de datos para la tabla `tutor_usuario`
--

INSERT INTO `tutor_usuario` (`id_tutor`, `id_usuario`, `tutor_usuario`) VALUES
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
(4, 83, 41),
(5, 46, 10),
(14, 84, 42),
(14, 85, 43),
(14, 86, 44),
(14, 87, 45),
(14, 88, 46),
(14, 89, 47),
(14, 91, 48),
(14, 92, 49),
(14, 93, 50),
(14, 94, 51),
(14, 95, 52),
(14, 96, 53),
(14, 97, 54),
(14, 98, 55),
(14, 99, 56),
(14, 100, 57),
(14, 102, 59),
(14, 103, 60),
(14, 104, 61),
(14, 105, 62),
(14, 107, 63),
(14, 108, 64),
(14, 109, 65),
(14, 110, 66),
(14, 111, 67),
(14, 112, 68),
(14, 113, 69),
(14, 115, 71),
(14, 116, 72),
(14, 117, 73),
(14, 118, 74),
(14, 120, 75),
(14, 121, 76),
(14, 123, 78),
(14, 124, 79),
(14, 135, 88);

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
  `id_configuracion_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `id_usuario_UNIQUE` (`id_usuario`),
  UNIQUE KEY `nUsuario_usuario_UNIQUE` (`mail_usuario`),
  KEY `configuracionUsuario_idx` (`id_configuracion_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=136 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `mail_usuario`, `pass_usuario`, `roles`, `nombre_usuario`, `apellidos_usuario`, `foto_usuario`, `tlfn_usuario`, `fnac_usuario`, `direccion_usuario`, `id_configuracion_usuario`) VALUES
(46, 'cojjo@gmail.com', 0, 'ROLE_FO', 'required', 'cojo', NULL, '12', '2015-05-23', NULL, NULL),
(56, 'coj@gmail.com', 0, 'ROLE_USER', 'Stehen', 'Haking', NULL, '6545421', '2014-05-16', NULL, NULL),
(58, 'fdsa@fds', 0, 'ROLE_USER', '', '', NULL, '', '', NULL, NULL),
(59, '', 0, 'ROLE_USER', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 'fdsa@fds.d', 3, 'ROLE_USER', 'vcx', 'fs', NULL, '', '', NULL, NULL),
(61, 'scd@ds.s', 3, 'ROLE_USER', 'ad', 'da', NULL, '', '', NULL, NULL),
(62, 'fdsa@fds.fd', 3, 'ROLE_USER', 'fsd', 'fds', NULL, '', '1988-02-17', NULL, NULL),
(63, 'fds@fds.f', 3, 'ROLE_USER', 'ds', 'nk', NULL, '', '', NULL, NULL),
(64, 'fds@dfa.dsfds', 3, 'ROLE_USER', 'fs', 'fd', NULL, '', '2012-02-29', NULL, NULL),
(65, 'da@fds.c', 3, 'ROLE_USER', 'csd', 'fds', NULL, '', '', NULL, NULL),
(66, 'fds@da.f', 3, 'ROLE_USER', 'f', 'f', NULL, '', '', NULL, NULL),
(67, 'jose@mail.com', 0, 'ROLE_USER', 'jose', 'lozano', NULL, '654875421', '', NULL, NULL),
(68, 'minus@d.s', 3, 'ROLE_USER', 'minus', 'muuuus', NULL, '', '', NULL, NULL),
(69, 'fs@fs.s', 3, 'ROLE_USER', 'd', 'd', NULL, '', '', NULL, NULL),
(70, 'a@a.c', 3, 'ROLE_USER', 'd', 'd', NULL, '', '', NULL, NULL),
(71, 'j@d.a', 3, 'ROLE_USER', 'a', 'd', NULL, '', '', NULL, NULL),
(72, 'usuarios@gmail.com', 3, 'ROLE_USER', 'usus', 'sensus', NULL, '', '', NULL, NULL),
(73, 'qq@aa.s', 3, 'ROLE_USER', 'aass', 'qqaa', NULL, '', '', NULL, NULL),
(74, 'da@f.f', 3, 'ROLE_USER', 'f', 'f', NULL, '', '', NULL, NULL),
(75, 'g@g.s', 3, 'ROLE_USER', 's', 's', NULL, '', '', NULL, NULL),
(76, 'as@e.s', 3, 'ROLE_USER', 's', 's', NULL, '', '', NULL, NULL),
(77, 's.d@d', 3, 'ROLE_USER', 'da', 'd', NULL, '', '', NULL, NULL),
(78, 'fdsa@fds.a', 0, 'ROLE_USER', 'f', '4', NULL, '', '', NULL, NULL),
(79, 'asd@d.d', 3, 'ROLE_USER', 'd', 'da', NULL, '', '', NULL, NULL),
(80, 'das@sd.d', 3, 'ROLE_USER', 'fsd', 'a', NULL, '', '', NULL, NULL),
(81, 'dfs@g.trr', 3, 'ROLE_USER', 'l', 'l', NULL, '', '', NULL, NULL),
(82, 'fsd@gdf.f', 3, 'ROLE_USER', 'fs', 'sf', NULL, '', '', NULL, NULL),
(83, 'weq@ea.f', 3, 'ROLE_USER', 'f', 'f', NULL, '', '', NULL, NULL),
(84, 'marta@mail.com', 0, 'ROLE_USER', 'marta', 'marta', NULL, '', '', NULL, NULL),
(85, 'juani@mail.com', 0, 'ROLE_USER', 'juani', 'a', NULL, '', '', NULL, NULL),
(86, 'marta3@mail.com', 0, 'ROLE_USER', 'marta', 'a', NULL, '', '', NULL, NULL),
(87, 'roci@mail.com', 0, 'ROLE_USER', 'cio', 'ro', NULL, '', '', NULL, NULL),
(88, 'padilla@mail.com', 0, 'ROLE_USER', 'padilla', 'padilla', NULL, '', '', NULL, NULL),
(89, 'oscar@mail.com', 0, 'ROLE_USER', 'oscar', 'a', NULL, '', '', NULL, NULL),
(91, 'oscar@mail.com33', 0, 'ROLE_USER', 'oscar', 'oscar', NULL, '', '', NULL, NULL),
(92, 'german@mail.com', 0, 'ROLE_USER', 'a', 'a', NULL, '', '', NULL, NULL),
(93, 'natalia44@mail.com', 0, 'ROLE_USER', 'natalia', 'a', NULL, '', '', NULL, NULL),
(94, 'app@mail.com', 0, 'ROLE_USER', 'a', 'a', NULL, '', '', NULL, NULL),
(95, 'marta88@mail.com', 0, 'ROLE_USER', 'a', 'a', NULL, '', '', NULL, NULL),
(96, 'jade4@mail.com', 0, 'ROLE_USER', 'jade', 'jade', NULL, '', '', NULL, NULL),
(97, 'borja22@mail.com', 0, 'ROLE_USER', 'borja', 'borja', NULL, '', '', NULL, 76),
(98, 'maria999@mail.com', 0, 'ROLE_USER', 'maria', 'maria', NULL, '', '', NULL, 80),
(99, 'jade33@mail.com', 0, 'ROLE_USER', 'jade', 'jade', NULL, '', '', NULL, NULL),
(100, 'joseAntonio@mail.com', 0, 'ROLE_USER', 'jose', 'antonio', NULL, '', '', NULL, 85),
(102, 'maria4443@mail.com', 0, 'ROLE_USER', 'mariao', 'af', NULL, '', '', NULL, 90),
(103, 'maria333@mail.com', 0, 'ROLE_USER', 'a', 'a', NULL, '', '', NULL, 91),
(104, 'rocio88@mail.com', 0, 'ROLE_USER', 'Rocio', 'Rocio', NULL, '', '', NULL, NULL),
(105, 'jessica33@mail.com', 0, 'ROLE_USER', 'jessica', 'jess', NULL, '', '', NULL, NULL),
(107, 'jessica333@mail.com', 0, 'ROLE_USER', 'jessica', 'jess', NULL, '', '', NULL, NULL),
(108, 'ignacio@mail.com', 0, 'ROLE_USER', 'ignacio', 'martinez', NULL, '', '', NULL, NULL),
(109, 'jose33@mail.com', 0, 'ROLE_USER', 'jose', 'jose', NULL, '', '', NULL, NULL),
(110, 'martamarta@mail.com', 0, 'ROLE_USER', 'marta', 'marta', NULL, '', '', NULL, NULL),
(111, 'patricia33@mail.com', 0, 'ROLE_USER', 'patri', 'patri', NULL, '', '', NULL, 92),
(112, 'test4x4@mail.com', 0, 'ROLE_USER', 'test4x4', 'test', NULL, '', '', NULL, 93),
(113, 'test3x6@mail.com', 0, 'ROLE_USER', 'test3x6', 'test', NULL, '', '', NULL, 94),
(115, 'test3x3@mail.com', 0, 'ROLE_USER', 'test3x3', 'test', NULL, '', '', NULL, 97),
(116, 'mail@mail.com', 0, 'ROLE_USER', 'mail', 'mail', NULL, '', '', NULL, 98),
(117, 'maria334@mail.com', 3, 'ROLE_USER', 'maria', 'maria', NULL, '', '', NULL, 99),
(118, 'martac@mail.com', 3, 'ROLE_USER', 'marta', 'carcajona', NULL, '', '', NULL, 100),
(120, 'nacho@mail.com', NULL, 'ROLE_USER', 'nacho', 'rodriguez', NULL, '', '', NULL, 101),
(121, 'jony@mail.com', NULL, 'ROLE_USER', 'jony', 'a', NULL, '', '', NULL, 102),
(123, 'true2x2@mail.com', NULL, 'ROLE_USER', 'true2x2', 'true', NULL, '', '', NULL, 103),
(124, 'true4x4@mail.com', NULL, 'ROLE_USER', 'true4x4', 'true', NULL, '', '', NULL, 104),
(135, 'true3x3_2x2_bn@mail.com', NULL, 'ROLE_USER', 'true3x3_2x2_bn', 'true', NULL, '', '', NULL, 108);

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

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `configuracionUsuario` FOREIGN KEY (`id_configuracion_usuario`) REFERENCES `configuracion_usuario` (`id_configuracion_usuario`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
