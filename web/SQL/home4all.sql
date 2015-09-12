-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-09-2015 a las 11:09:01
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
  `css` varchar(100) NOT NULL DEFAULT 'homeController.css',
  `ayudaCromatica` int(1) NOT NULL DEFAULT '0',
  `barraBarrido` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_configuracion_usuario`),
  UNIQUE KEY `id_configuracion_usuario_UNIQUE` (`id_configuracion_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=216 ;

--
-- Volcado de datos para la tabla `configuracion_usuario`
--

INSERT INTO `configuracion_usuario` (`id_configuracion_usuario`, `color_principal`, `color_secundario`, `contraste`, `tam_letra`, `barrido`, `tiempo_barrido`, `reconocimiento_voz`, `retroalimentacion_vibracion`, `retroalimentacion_voz`, `css`, `ayudaCromatica`, `barraBarrido`) VALUES
(147, '#265a88', '#eb9316', 1, 355, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(148, '#265a88', '#eb9316', 1, 12, 1, 4, 0, 0, 0, 'homeController.css', 0, 0),
(149, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(150, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(151, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(152, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(154, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(155, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(156, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(157, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(158, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(159, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(160, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(161, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(162, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(163, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(165, '#265a88', '#eb9316', 1, 108, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(166, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(167, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(168, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(169, '#265a88', '#eb9316', 1, 366, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(170, '#265a88', '#eb9316', 1, 466, 0, 4, 0, 0, 0, 'homeController.css', 1, 0),
(171, '', '', 1, 466, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(172, '#c12e2a', '#cc2efa', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 1, 0),
(174, '#265a88', '#eb9316', 1, 12, 0, 1, 0, 0, 0, 'homeController.css', 0, 0),
(175, '#265a88', '#eb9316', 1, 12, 0, 1, 0, 0, 0, 'homeController.css', 0, 0),
(177, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(178, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(179, '#c12e2a', '#cc2efa', 1, 12, 0, 4, 0, 0, 0, 'crom_full.css', 1, 0),
(180, '#eb9316', '#cc2efa', 1, 12, 1, 2, 0, 0, 0, 'crom_full.css', 1, 0),
(197, '#265a88', '#eb9316', 1, 12, 1, 2, 0, 0, 0, 'crom_full.css', 1, 0),
(198, '#265a88', '#eb9316', 1, 12, 1, 2, 0, 0, 0, 'darkTheme.css', 0, 0),
(199, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'lightTheme.css', 0, 0),
(200, '#265a88', '#eb9316', 1, 12, 1, 3, 0, 0, 0, 'homeController.css', 0, 0),
(201, '#265a88', '#eb9316', 1, 12, 1, 3, 0, 1, 1, 'homeController.css', 0, 0),
(202, '#265a88', '#eb9316', 1, 12, 1, 3, 0, 1, 1, 'homeController.css', 0, 0),
(203, '#265a88', '#eb9316', 1, 12, 1, 3, 0, 1, 1, 'homeController.css', 0, 0),
(204, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 1, 1, 'homeController.css', 0, 0),
(205, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(206, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(207, '#265a88', '#eb9316', 1, 12, 1, 5, 0, 1, 1, 'crom_full.css', 1, 0),
(208, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(209, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(210, '#265a88', '#eb9316', 1, 12, 1, 3, 0, 1, 1, 'homeController.css', 0, 1),
(211, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(212, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(213, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(214, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0, 0),
(215, '#265a88', '#eb9316', 1, 12, 1, 4, 0, 0, 0, 'homeController.css', 0, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=29 ;

--
-- Volcado de datos para la tabla `dispositivo`
--

INSERT INTO `dispositivo` (`id_dispositivo`, `mac_dispositivo`, `uDefecto_dispositivo`) VALUES
(17, '15656', 0),
(18, '111', 59),
(19, '12', NULL),
(20, '1231', 67),
(21, 'aa-5A-B6-93-45-5D', 0),
(22, '4A-5A-B6-93-77-5D', 0),
(23, '4A-5A-B6-93-45-77', 0),
(25, '4A-5A-B6-93-55-5D', 116),
(27, 'c4-3a-be-5b-45-2a', 0),
(28, '4a-5a-b6-93-45-5d', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=230 ;

--
-- Volcado de datos para la tabla `dispositivo_usuario`
--

INSERT INTO `dispositivo_usuario` (`id_dispositivo_usuario`, `id_dispositivo`, `id_usuario`, `rotacion`, `filas_vertical`, `columnas_vertical`, `filas_horizontal`, `columnas_horizontal`) VALUES
(165, 28, 177, 1, 3, -1, 4, 3),
(166, 28, 178, 1, 2, 2, 3, 4),
(167, 27, 179, 1, 3, 1, 3, 3),
(173, 28, 185, 1, 2, 1, 2, 2),
(174, 28, 186, 1, 2, 1, 2, 2),
(175, 28, 187, 1, 2, 1, 2, 2),
(180, 28, 194, 1, 2, 1, 2, 2),
(181, 28, 195, 1, 2, 1, 2, 2),
(182, 28, 196, 1, 2, 1, 2, 2),
(183, 27, 196, 1, 2, 1, 2, 2),
(184, 28, 197, 1, 3, 1, 2, 2),
(185, 28, 198, 1, 3, 1, 3, 3),
(189, 28, 200, 1, 2, 1, 2, 2),
(190, 27, 200, 1, 2, 1, 2, 2),
(191, 27, 204, 1, 3, 1, 2, 2),
(192, 28, 204, 1, 3, 1, 2, 2),
(195, 28, 206, 1, 3, 1, 3, 3),
(196, 27, 206, 1, 3, 1, 3, 3),
(197, 21, 198, NULL, NULL, NULL, NULL, NULL),
(207, 23, 229, 0, NULL, NULL, 3, 3),
(208, 28, 232, 1, 3, 1, 3, 3),
(209, 27, 232, 1, 3, 1, 3, 3),
(210, 23, 238, 1, 3, 1, 3, 3),
(211, 28, 238, 1, 3, 1, 3, 3),
(212, 27, 238, 1, 3, 1, 3, 3),
(218, 27, 241, 1, 3, 1, 3, 3),
(219, 28, 241, 1, 3, 1, 3, 3),
(220, 27, 243, 1, 3, 1, 3, 3),
(221, 28, 243, 1, 3, 1, 3, 3),
(222, 28, 244, 1, 3, 1, 2, 2),
(223, 27, 244, 1, 3, 1, 2, 2),
(228, 27, 247, 1, 3, 1, 3, 3),
(229, 28, 247, 1, 3, 1, 3, 3);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=43 ;

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
(40, 'Comedor', NULL, 'Comedor', NULL, 0, NULL),
(41, 'Dormitorio de Pepe', NULL, 'Dormitorio', NULL, 0, NULL),
(42, 'Patio Grande', NULL, 'Patio', NULL, 0, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=57 ;

--
-- Volcado de datos para la tabla `sensoractuador`
--

INSERT INTO `sensoractuador` (`Id_Sensor`, `PIN`, `Tipo`, `TipoValor`, `Valor`, `Localizacion`, `id_sen`, `id_usuario`, `id_habitacion`, `codigo_sensor`, `nombre_sensor`, `senact_sensor`, `tipo_sensor`, `modelo_sensor`, `descripcion_sensor`, `valor_min`, `valor_max`, `incremento`) VALUES
('33', 2, 'Actuador', '0', 0, NULL, 33, NULL, 30, '_bn0', 'Bombilla1', 1, '', 'bn', '', 0, 1, 1),
('34', 12, 'Actuador', '0', 0, NULL, 34, NULL, 30, '_bn2', 'Bombilla 2', 1, '', 'bn', '', 0, 1, 1),
('35', 12, 'Actuador', '2', 27, NULL, 35, NULL, 30, '_bn2344', 'Aire acondicionado', 1, '', 'bn', '', 18, 30, 1),
('36', 12, 'Actuador', '1', 1, NULL, 36, NULL, 30, '_bn34930948', 'Luz regulable', 1, '', 'bn', '', 0, 3, 1),
('37', 24, 'Actuador', '1', 10, NULL, 37, NULL, 30, '_bn39840938403', 'luz 2', 1, '', 'bn', '', 0, 27, 1),
('39', 12, 'Sensor', '-1', 0, NULL, 39, NULL, 31, '_bn_sen_3849348903', 'Temperatura', 0, '', 'bn', '', 0, 1, 1),
('40', 33, 'Sensor', '-1', 0, NULL, 40, NULL, 31, '_bn_sen_3984380', 'Humedad', 0, '', 'bn', '', 0, 1, 1),
('41', 55, 'Actuador', '2', 8, NULL, 41, NULL, 30, 'bn_3ui43o4u', 'Actuador salon', 1, '', 'bn', '', 0, 10, 1),
('42', 444, 'Sensor', '-1', 12, NULL, 42, NULL, 31, '_bn_sen_894934', 'Luminosidad', 0, '', 'sen', '', 0, 1, 1),
('43', 343543453, 'Sensor', '-1', 0, NULL, 43, NULL, 31, '_bn_sen_39483094', 'Pecera', 0, '', 'bn', '', 0, 1, 1),
('44', 23535, 'Sensor', '-1', 0, NULL, 44, NULL, 31, '_bn_sen_394830934', 'Temperatura 2', 0, '', 'bn', '', 0, 1, 1),
('45', 234323, 'Sensor', '-1', 11, NULL, 45, NULL, 30, '_bn_sen_3849334', 'Temperatura3', 0, '', 'bn', '', 0, 1, 1),
('46', 345, 'Sensor', '-1', 0, NULL, 46, NULL, 31, '_bn_sen_98', 'temperatura 4', 0, '', 'bn', '', 0, 1, 1),
('47', 345, 'Sensor', '-1', 33, NULL, 47, NULL, 31, '_bn_sen_384943804', 'temperatura 5', 0, '', 'bn', '', 0, 1, 1),
('48', 235, 'Sensor', '-1', 0, NULL, 48, NULL, 31, '_bn_sen_3948334', 'temperatura 6', 0, '', 'bn', '', 0, 1, 1),
('49', 55, 'Actuador', '0', 1, NULL, 49, NULL, 30, '_bn_46546854', 'Bombilla3', 1, '', 'bn', '', 0, 1, 1),
('50', 1458, 'Actuador', '0', 0, NULL, 50, NULL, 41, 'bn', 'Luz principal', 1, '', 'Lumínico', '', 0, 1, 1),
('51', 78, 'Actuador', '2', 0, NULL, 51, NULL, 41, 'bn349834', 'Aire acondicionado 2', 1, '', 'calefaccion', '', 0, 1, 1),
('52', 8997, 'Actuador', '1', 0, NULL, 52, NULL, 41, 'bn_984398', 'Luz de colores', 1, 'Lumínico', 'a', '', 0, 1, 1),
('53', 456, 'Actuador', '0', 0, NULL, 53, NULL, 42, 'bm_34232321', 'Luz patio', 1, '', 'bn', '', 0, 1, 1),
('54', 17121, 'Actuador', '2', 0, NULL, 54, NULL, 42, 'bn-8797454', 'Aire acon.', 1, '', 'bn', '', 0, 1, 1),
('55', 89787, 'Actuador', '1', 0, NULL, 55, NULL, 42, 'bn-adfkajdsfklaj', 'Luz Colores', 1, '', 'bn', '', 0, 2, 1),
('56', 87, 'Actuador', '1', 1, NULL, 56, NULL, 42, 'bn_9e84039', 'Riego', 1, '', 'bn', '', 0, 3, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=990 ;

--
-- Volcado de datos para la tabla `sensor_usuario`
--

INSERT INTO `sensor_usuario` (`id_sensor_usuario`, `id_sensor`, `id_usuario`) VALUES
(386, 33, 176),
(401, 33, 177),
(417, 33, 178),
(433, 33, 179),
(513, 33, 185),
(529, 33, 186),
(545, 33, 187),
(577, 33, 194),
(593, 33, 195),
(609, 33, 196),
(625, 33, 197),
(641, 33, 198),
(673, 33, 200),
(689, 33, 204),
(721, 33, 206),
(836, 33, 229),
(855, 33, 238),
(893, 33, 241),
(967, 33, 247),
(387, 34, 176),
(402, 34, 177),
(418, 34, 178),
(434, 34, 179),
(514, 34, 185),
(530, 34, 186),
(546, 34, 187),
(578, 34, 194),
(594, 34, 195),
(610, 34, 196),
(626, 34, 197),
(642, 34, 198),
(674, 34, 200),
(690, 34, 204),
(722, 34, 206),
(837, 34, 229),
(856, 34, 238),
(894, 34, 241),
(968, 34, 247),
(388, 35, 176),
(403, 35, 177),
(419, 35, 178),
(435, 35, 179),
(515, 35, 185),
(531, 35, 186),
(547, 35, 187),
(579, 35, 194),
(595, 35, 195),
(611, 35, 196),
(627, 35, 197),
(643, 35, 198),
(675, 35, 200),
(691, 35, 204),
(723, 35, 206),
(838, 35, 229),
(857, 35, 238),
(895, 35, 241),
(969, 35, 247),
(389, 36, 176),
(404, 36, 177),
(420, 36, 178),
(436, 36, 179),
(516, 36, 185),
(532, 36, 186),
(548, 36, 187),
(580, 36, 194),
(596, 36, 195),
(612, 36, 196),
(628, 36, 197),
(644, 36, 198),
(676, 36, 200),
(692, 36, 204),
(724, 36, 206),
(839, 36, 229),
(858, 36, 238),
(896, 36, 241),
(970, 36, 247),
(390, 37, 176),
(405, 37, 177),
(421, 37, 178),
(437, 37, 179),
(517, 37, 185),
(533, 37, 186),
(549, 37, 187),
(581, 37, 194),
(597, 37, 195),
(613, 37, 196),
(629, 37, 197),
(645, 37, 198),
(677, 37, 200),
(693, 37, 204),
(725, 37, 206),
(840, 37, 229),
(859, 37, 238),
(897, 37, 241),
(971, 37, 247),
(391, 39, 176),
(406, 39, 177),
(422, 39, 178),
(438, 39, 179),
(518, 39, 185),
(534, 39, 186),
(550, 39, 187),
(582, 39, 194),
(598, 39, 195),
(614, 39, 196),
(630, 39, 197),
(646, 39, 198),
(678, 39, 200),
(694, 39, 204),
(726, 39, 206),
(841, 39, 229),
(860, 39, 238),
(898, 39, 241),
(972, 39, 247),
(392, 40, 176),
(407, 40, 177),
(423, 40, 178),
(439, 40, 179),
(519, 40, 185),
(535, 40, 186),
(551, 40, 187),
(583, 40, 194),
(599, 40, 195),
(615, 40, 196),
(631, 40, 197),
(647, 40, 198),
(679, 40, 200),
(695, 40, 204),
(727, 40, 206),
(842, 40, 229),
(861, 40, 238),
(899, 40, 241),
(973, 40, 247),
(393, 41, 176),
(408, 41, 177),
(424, 41, 178),
(440, 41, 179),
(520, 41, 185),
(536, 41, 186),
(552, 41, 187),
(584, 41, 194),
(600, 41, 195),
(616, 41, 196),
(632, 41, 197),
(648, 41, 198),
(680, 41, 200),
(696, 41, 204),
(728, 41, 206),
(843, 41, 229),
(862, 41, 238),
(900, 41, 241),
(974, 41, 247),
(394, 42, 176),
(409, 42, 177),
(425, 42, 178),
(441, 42, 179),
(521, 42, 185),
(537, 42, 186),
(553, 42, 187),
(585, 42, 194),
(601, 42, 195),
(617, 42, 196),
(633, 42, 197),
(649, 42, 198),
(681, 42, 200),
(697, 42, 204),
(729, 42, 206),
(844, 42, 229),
(863, 42, 238),
(901, 42, 241),
(975, 42, 247),
(395, 43, 176),
(410, 43, 177),
(426, 43, 178),
(442, 43, 179),
(522, 43, 185),
(538, 43, 186),
(554, 43, 187),
(586, 43, 194),
(602, 43, 195),
(618, 43, 196),
(634, 43, 197),
(650, 43, 198),
(682, 43, 200),
(698, 43, 204),
(730, 43, 206),
(845, 43, 229),
(864, 43, 238),
(902, 43, 241),
(976, 43, 247),
(396, 44, 176),
(411, 44, 177),
(427, 44, 178),
(443, 44, 179),
(523, 44, 185),
(539, 44, 186),
(555, 44, 187),
(587, 44, 194),
(603, 44, 195),
(619, 44, 196),
(635, 44, 197),
(651, 44, 198),
(683, 44, 200),
(699, 44, 204),
(731, 44, 206),
(846, 44, 229),
(865, 44, 238),
(903, 44, 241),
(977, 44, 247),
(397, 45, 176),
(412, 45, 177),
(428, 45, 178),
(444, 45, 179),
(524, 45, 185),
(540, 45, 186),
(556, 45, 187),
(588, 45, 194),
(604, 45, 195),
(620, 45, 196),
(636, 45, 197),
(652, 45, 198),
(684, 45, 200),
(700, 45, 204),
(732, 45, 206),
(847, 45, 229),
(866, 45, 238),
(904, 45, 241),
(978, 45, 247),
(398, 46, 176),
(413, 46, 177),
(429, 46, 178),
(445, 46, 179),
(525, 46, 185),
(541, 46, 186),
(557, 46, 187),
(589, 46, 194),
(605, 46, 195),
(621, 46, 196),
(637, 46, 197),
(653, 46, 198),
(685, 46, 200),
(701, 46, 204),
(733, 46, 206),
(848, 46, 229),
(867, 46, 238),
(905, 46, 241),
(979, 46, 247),
(399, 47, 176),
(414, 47, 177),
(430, 47, 178),
(446, 47, 179),
(526, 47, 185),
(542, 47, 186),
(558, 47, 187),
(590, 47, 194),
(606, 47, 195),
(622, 47, 196),
(638, 47, 197),
(654, 47, 198),
(686, 47, 200),
(702, 47, 204),
(734, 47, 206),
(849, 47, 229),
(868, 47, 238),
(906, 47, 241),
(980, 47, 247),
(400, 48, 176),
(415, 48, 177),
(431, 48, 178),
(447, 48, 179),
(527, 48, 185),
(543, 48, 186),
(559, 48, 187),
(591, 48, 194),
(607, 48, 195),
(623, 48, 196),
(639, 48, 197),
(655, 48, 198),
(687, 48, 200),
(703, 48, 204),
(735, 48, 206),
(850, 48, 229),
(869, 48, 238),
(907, 48, 241),
(981, 48, 247),
(416, 49, 177),
(432, 49, 178),
(448, 49, 179),
(528, 49, 185),
(544, 49, 186),
(560, 49, 187),
(592, 49, 194),
(608, 49, 195),
(624, 49, 196),
(640, 49, 197),
(656, 49, 198),
(688, 49, 200),
(704, 49, 204),
(736, 49, 206),
(851, 49, 229),
(870, 49, 238),
(908, 49, 241),
(982, 49, 247),
(852, 50, 232),
(871, 50, 238),
(909, 50, 241),
(983, 50, 247),
(853, 51, 232),
(872, 51, 238),
(910, 51, 241),
(984, 51, 247),
(854, 52, 232),
(873, 52, 238),
(911, 52, 241),
(985, 52, 247),
(912, 53, 243),
(916, 53, 244),
(986, 53, 247),
(913, 54, 243),
(917, 54, 244),
(987, 54, 247),
(914, 55, 243),
(918, 55, 244),
(988, 55, 247),
(915, 56, 243),
(919, 56, 244),
(989, 56, 247);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `tutor_dispositivo`
--

INSERT INTO `tutor_dispositivo` (`id_tutor_dispositivo`, `id_tutor`, `id_dispositivo`, `nombre_dispositivo`) VALUES
(12, 5, 17, 'posyaves'),
(13, 4, 18, 'disp1'),
(14, 4, 19, 'disp4'),
(15, 4, 20, 'disp3'),
(16, 14, 21, 'xperia 3'),
(17, 14, 22, 'samsumg s3'),
(18, 14, 23, 'lg l3'),
(20, 14, 25, 'Lumia 3300'),
(22, 14, 27, 'Sony e4'),
(23, 14, 28, 'lenovo-pc');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=188 ;

--
-- Volcado de datos para la tabla `tutor_usuario`
--

INSERT INTO `tutor_usuario` (`id_tutor`, `id_usuario`, `tutor_usuario`) VALUES
(14, 176, 128),
(14, 177, 129),
(14, 178, 130),
(14, 179, 131),
(14, 185, 137),
(14, 186, 138),
(14, 187, 139),
(14, 194, 145),
(14, 195, 146),
(14, 196, 147),
(14, 197, 148),
(14, 198, 149),
(14, 200, 151),
(14, 204, 152),
(14, 206, 154),
(14, 229, 174),
(14, 232, 177),
(14, 238, 178),
(14, 241, 181),
(14, 243, 183),
(14, 244, 184),
(14, 247, 187);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=248 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `mail_usuario`, `pass_usuario`, `roles`, `nombre_usuario`, `apellidos_usuario`, `foto_usuario`, `tlfn_usuario`, `fnac_usuario`, `direccion_usuario`, `id_configuracion_usuario`) VALUES
(176, 'lr_22_21@mail.com', NULL, 'ROLE_USER', 'lr_22_21', 'lr_22_21', NULL, '', '', NULL, 160),
(177, 'lr_34_21@mail.com', NULL, 'ROLE_USER', 'lr_34_21', 'lr', NULL, '', '', NULL, 161),
(178, 'lr_34_22@mail.com', NULL, 'ROLE_USER', 'lr_34_22', 'lt', NULL, '', '', NULL, 162),
(179, 'mlr_33_31@mail.com', NULL, 'ROLE_USER', 'mlr_33_31', 'A', NULL, '', '', NULL, 163),
(185, 'lr.22.21@mail.com', NULL, 'ROLE_USER', 'lr.22.21', 'lr', NULL, '', '', NULL, 178),
(186, 'lr.22.21.cro@mail.com', NULL, 'ROLE_USER', 'lr.22.21.cro', 'lr', NULL, '', '', NULL, 179),
(187, 'lr.22.21.bar2@mail.com', NULL, 'ROLE_USER', 'lr.22.21.bar2', 'lr', NULL, '', '', NULL, 180),
(194, 'll.22.21.cro.bar2@mail.com', NULL, 'ROLE_USER', 'll.22.21.cro.bar2', 'bn', NULL, '', '', NULL, 197),
(195, 'll.22.21.dark.bar2@mail.com', NULL, 'ROLE_USER', 'll.22.21.dark.bar2', 'bn', NULL, '', '', NULL, 198),
(196, 'lt.22.21.light@mail.com', NULL, 'ROLE_USER', 'lt.22.21.light', 'bn', NULL, '', '', NULL, 199),
(197, 'll.22.31.bar3@mail.com', NULL, 'ROLE_USER', 'll.22.31.bar3', 'bn', NULL, '', '', NULL, 200),
(198, 'll.33.31@mail.com', NULL, 'ROLE_USER', 'll.33.31', 'bn', NULL, '', '', NULL, 201),
(200, 'tl.22.21.bar3.vib@mail.com', NULL, 'ROLE_USER', 'tl.22.21.bar3.vib', 'bn', NULL, '', '', NULL, 203),
(204, 'tl.22.31.voi.vib.pass@mail.com', NULL, 'ROLE_USER', 'tl.22.31.voi.vib.pass', 'bn', NULL, '', '', NULL, 204),
(206, 'tl.33.31.pass@mail.com', 1234, 'ROLE_USER', 'Juan', 'bn', NULL, '', '', NULL, 205),
(229, 'adfajsdf@dkajf.com', 0, 'ROLE_USER', 'Miguel', 'Silvente', NULL, '', '', NULL, 208),
(232, 'pepe@mail.com', 0, 'ROLE_USER', 'Pepe', 'molina', NULL, '', '', NULL, 209),
(238, 'borja34@mail.com', 0, 'ROLE_USER', 'Borja', 'Molina', NULL, '', '', NULL, 210),
(241, 'marta@mail.com', 0, 'ROLE_USER', 'Marta', 'Carcajona', NULL, '', '', NULL, 212),
(243, 'Mario@tt.com', 0, 'ROLE_USER', 'Mario', 'Delg', NULL, '', '', NULL, 213),
(244, 'Rocio@mail.com', 0, 'ROLE_USER', 'Rocio', 'De la Torre', NULL, '', '', NULL, 214),
(247, 'rafael@mail.com', 0, 'ROLE_USER', 'Rafa', 'Molina', NULL, '', '', NULL, 215);

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
