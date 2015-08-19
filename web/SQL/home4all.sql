-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-08-2015 a las 14:17:16
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
  PRIMARY KEY (`id_configuracion_usuario`),
  UNIQUE KEY `id_configuracion_usuario_UNIQUE` (`id_configuracion_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=182 ;

--
-- Volcado de datos para la tabla `configuracion_usuario`
--

INSERT INTO `configuracion_usuario` (`id_configuracion_usuario`, `color_principal`, `color_secundario`, `contraste`, `tam_letra`, `barrido`, `tiempo_barrido`, `reconocimiento_voz`, `retroalimentacion_vibracion`, `retroalimentacion_voz`, `css`, `ayudaCromatica`) VALUES
(2, 'blue', 'white', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(3, 'blue', 'white', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(4, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(5, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(6, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(9, '#265a88', '#eb9316', 1, 12, NULL, 4, NULL, NULL, NULL, 'homeController.css', 0),
(10, '#265a88', '#eb9316', 1, 12, 1, 6, NULL, NULL, NULL, 'homeController.css', 0),
(11, '#265a88', '#eb9316', 1, 12, NULL, 4, NULL, NULL, NULL, 'homeController.css', 0),
(12, '#265a88', '#eb9316', 1, 12, 1, 4, NULL, NULL, NULL, 'homeController.css', 0),
(13, '#265a88', '#eb9316', 1, 12, 1, 4, NULL, NULL, NULL, 'homeController.css', 0),
(14, '#265a88', '#eb9316', 1, 12, 1, 4, NULL, NULL, NULL, 'homeController.css', 0),
(15, '#265a88', '#eb9316', 1, 12, 1, 4, NULL, 1, NULL, 'homeController.css', 0),
(16, '#265a88', '#eb9316', 1, 12, 1, 4, NULL, 1, NULL, 'homeController.css', 0),
(17, '#265a88', '#eb9316', 1, 12, NULL, 4, NULL, 1, NULL, 'homeController.css', 0),
(18, '#265a88', '#eb9316', 1, 12, NULL, 4, NULL, 1, 1, 'homeController.css', 0),
(19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 'homeController.css', 0),
(20, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(21, '#c12e2a', '#CC2EFA', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(22, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(23, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(24, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(25, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(26, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(27, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(28, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(29, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(30, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(31, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(32, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(33, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(34, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(35, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(36, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(37, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(38, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(39, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(40, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(41, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(42, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(43, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(44, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(45, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(46, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(47, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(48, '#265a88', '#eb9316', 1, 99, 0, 4, 0, 0, 0, 'homeController.css', 0),
(49, '#265a88', '#eb9316', 1, 99, 0, 4, 0, 0, 0, 'homeController.css', 0),
(50, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(51, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(52, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(53, '#265a88', '#eb9316', 1, 99, 0, 4, 0, 0, 0, 'homeController.css', 0),
(54, '#265a88', '#eb9316', 1, 99, 0, 4, 0, 0, 0, 'homeController.css', 0),
(55, '#265a88', '#eb9316', 1, 99, 0, 4, 0, 0, 0, 'homeController.css', 0),
(56, '#265a88', '#eb9316', 1, 99, 0, 4, 0, 0, 0, 'homeController.css', 0),
(57, '#265a88', '#eb9316', 1, 99, 0, 4, 0, 0, 0, 'homeController.css', 0),
(58, '#265a88', '#eb9316', 1, 99, 0, 4, 0, 0, 0, 'homeController.css', 0),
(59, '#265a88', '#eb9316', 1, 99, 0, 4, 0, 0, 0, 'homeController.css', 0),
(60, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(61, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(62, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(63, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(64, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(65, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(66, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(67, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(68, '#265a88', '#eb9316', 1, 77, 0, 4, 0, 0, 0, 'homeController.css', 0),
(69, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(70, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(71, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(72, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(73, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(74, '#265a88', '#eb9316', 1, 56, 0, 4, 0, 0, 0, 'homeController.css', 0),
(75, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(76, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(77, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(78, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(79, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(80, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(81, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(82, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(83, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(84, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(85, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(86, '#265a88', '#eb9316', 1, 555, 0, 4, 0, 0, 0, 'homeController.css', 0),
(88, '#265a88', '#eb9316', 1, 553, 0, 4, 0, 0, 0, 'homeController.css', 0),
(89, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(90, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(91, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(92, '#265a88', '#eb9316', 1, 77, 0, 4, 0, 0, 0, 'homeController.css', 0),
(93, '#265a88', '#eb9316', 1, 12, 1, 4, 0, 0, 0, 'homeController.css', 0),
(94, '#265a88', '#eb9316', 1, 12, 1, 2, 0, 0, 0, 'homeController.css', 0),
(96, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(97, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(98, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(99, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(100, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(101, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(102, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(103, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(104, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(105, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(106, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(107, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(108, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(109, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(110, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(112, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(114, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(115, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(117, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(118, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(119, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(120, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(121, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(122, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(123, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(124, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(125, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(126, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(127, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(128, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(130, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(132, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(133, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(134, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(135, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(136, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(137, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(139, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(140, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(141, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(142, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(143, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(144, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(145, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css', 0),
(147, '#265a88', '#eb9316', 1, 355, 0, 4, 0, 0, 0, 'homeController.css', 0),
(148, '#265a88', '#eb9316', 1, 12, 1, 4, 0, 0, 0, 'homeController.css', 0),
(149, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(150, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(151, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(152, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(154, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(155, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(156, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(157, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(158, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(159, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(160, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(161, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(162, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(163, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(165, '#265a88', '#eb9316', 1, 108, 0, 4, 0, 0, 0, 'homeController.css', 0),
(166, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(167, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(168, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(169, '#265a88', '#eb9316', 1, 366, 0, 4, 0, 0, 0, 'homeController.css', 0),
(170, '#265a88', '#eb9316', 1, 466, 0, 4, 0, 0, 0, 'homeController.css', 1),
(171, '', '', 1, 466, 0, 4, 0, 0, 0, 'homeController.css', 0),
(172, '#c12e2a', '#cc2efa', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 1),
(174, '#265a88', '#eb9316', 1, 12, 0, 1, 0, 0, 0, 'homeController.css', 0),
(175, '#265a88', '#eb9316', 1, 12, 0, 1, 0, 0, 0, 'homeController.css', 0),
(177, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(178, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 0),
(179, '#c12e2a', '#cc2efa', 1, 12, 0, 4, 0, 0, 0, 'homeController.css', 1),
(180, '#eb9316', '#cc2efa', 1, 12, 1, 2, 0, 0, 0, 'homeController.css', 1),
(181, '#265a88', '#eb9316', 1, 12, 1, 1, 0, 0, 0, 'homeController.css', 0);

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
(21, 'aa-5A-B6-93-45-5D', 84),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=177 ;

--
-- Volcado de datos para la tabla `dispositivo_usuario`
--

INSERT INTO `dispositivo_usuario` (`id_dispositivo_usuario`, `id_dispositivo`, `id_usuario`, `rotacion`, `filas_vertical`, `columnas_vertical`, `filas_horizontal`, `columnas_horizontal`) VALUES
(122, 25, 116, 0, NULL, NULL, 3, 3),
(123, 22, 116, 1, 4, 2, 3, 3),
(126, 21, 120, 0, NULL, NULL, 4, 4),
(163, 27, 175, 1, 1, 2, 3, 3),
(165, 28, 177, 1, 3, -1, 4, 3),
(166, 28, 178, 1, 2, 2, 3, 4),
(167, 27, 179, 1, 3, 1, 3, 3),
(169, 28, 181, NULL, NULL, NULL, NULL, NULL),
(173, 28, 185, 1, 2, 1, 2, 2),
(174, 28, 186, 1, 2, 1, 2, 2),
(175, 28, 187, 1, 2, 1, 2, 2),
(176, 28, 188, 1, 2, 1, 2, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=50 ;

--
-- Volcado de datos para la tabla `sensoractuador`
--

INSERT INTO `sensoractuador` (`Id_Sensor`, `PIN`, `Tipo`, `TipoValor`, `Valor`, `Localizacion`, `id_sen`, `id_usuario`, `id_habitacion`, `codigo_sensor`, `nombre_sensor`, `senact_sensor`, `tipo_sensor`, `modelo_sensor`, `descripcion_sensor`, `valor_min`, `valor_max`, `incremento`) VALUES
('33', 2, 'Actuador', '0', 1, NULL, 33, NULL, 30, '_bn0', 'Bombilla1', 1, '', 'bn', '', 0, 1, 1),
('34', 12, 'Actuador', '0', 0, NULL, 34, NULL, 30, '_bn2', 'Bombilla 2', 1, '', 'bn', '', 0, 1, 1),
('35', 12, 'Actuador', '2', 28, NULL, 35, NULL, 30, '_bn2344', 'Aire acondicionado', 1, '', 'bn', '', 18, 30, 1),
('36', 12, 'Actuador', '1', 0, NULL, 36, NULL, 30, '_bn34930948', 'Luz regulable', 1, '', 'bn', '', 0, 3, 1),
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
('49', 55, 'Actuador', '0', 1, NULL, 49, NULL, 30, '_bn_46546854', 'Bombilla3', 1, '', 'bn', '', 0, 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=577 ;

--
-- Volcado de datos para la tabla `sensor_usuario`
--

INSERT INTO `sensor_usuario` (`id_sensor_usuario`, `id_sensor`, `id_usuario`) VALUES
(107, 33, 139),
(119, 33, 140),
(179, 33, 144),
(194, 33, 145),
(210, 33, 146),
(255, 33, 149),
(270, 33, 150),
(285, 33, 155),
(371, 33, 175),
(386, 33, 176),
(401, 33, 177),
(417, 33, 178),
(433, 33, 179),
(513, 33, 185),
(529, 33, 186),
(545, 33, 187),
(561, 33, 188),
(108, 34, 139),
(120, 34, 140),
(180, 34, 144),
(195, 34, 145),
(211, 34, 146),
(256, 34, 149),
(271, 34, 150),
(372, 34, 175),
(387, 34, 176),
(402, 34, 177),
(418, 34, 178),
(434, 34, 179),
(514, 34, 185),
(530, 34, 186),
(546, 34, 187),
(562, 34, 188),
(109, 35, 139),
(121, 35, 140),
(181, 35, 144),
(196, 35, 145),
(212, 35, 146),
(257, 35, 149),
(272, 35, 150),
(373, 35, 175),
(388, 35, 176),
(403, 35, 177),
(419, 35, 178),
(435, 35, 179),
(515, 35, 185),
(531, 35, 186),
(547, 35, 187),
(563, 35, 188),
(110, 36, 139),
(122, 36, 140),
(182, 36, 144),
(197, 36, 145),
(213, 36, 146),
(258, 36, 149),
(273, 36, 150),
(374, 36, 175),
(389, 36, 176),
(404, 36, 177),
(420, 36, 178),
(436, 36, 179),
(516, 36, 185),
(532, 36, 186),
(548, 36, 187),
(564, 36, 188),
(111, 37, 139),
(123, 37, 140),
(183, 37, 144),
(198, 37, 145),
(214, 37, 146),
(259, 37, 149),
(274, 37, 150),
(375, 37, 175),
(390, 37, 176),
(405, 37, 177),
(421, 37, 178),
(437, 37, 179),
(517, 37, 185),
(533, 37, 186),
(549, 37, 187),
(565, 37, 188),
(112, 39, 139),
(124, 39, 140),
(184, 39, 144),
(199, 39, 145),
(215, 39, 146),
(260, 39, 149),
(275, 39, 150),
(376, 39, 175),
(391, 39, 176),
(406, 39, 177),
(422, 39, 178),
(438, 39, 179),
(518, 39, 185),
(534, 39, 186),
(550, 39, 187),
(566, 39, 188),
(113, 40, 139),
(125, 40, 140),
(185, 40, 144),
(200, 40, 145),
(216, 40, 146),
(261, 40, 149),
(276, 40, 150),
(377, 40, 175),
(392, 40, 176),
(407, 40, 177),
(423, 40, 178),
(439, 40, 179),
(519, 40, 185),
(535, 40, 186),
(551, 40, 187),
(567, 40, 188),
(114, 41, 139),
(126, 41, 140),
(186, 41, 144),
(201, 41, 145),
(217, 41, 146),
(262, 41, 149),
(277, 41, 150),
(286, 41, 155),
(378, 41, 175),
(393, 41, 176),
(408, 41, 177),
(424, 41, 178),
(440, 41, 179),
(520, 41, 185),
(536, 41, 186),
(552, 41, 187),
(568, 41, 188),
(115, 42, 139),
(127, 42, 140),
(187, 42, 144),
(202, 42, 145),
(218, 42, 146),
(263, 42, 149),
(278, 42, 150),
(379, 42, 175),
(394, 42, 176),
(409, 42, 177),
(425, 42, 178),
(441, 42, 179),
(521, 42, 185),
(537, 42, 186),
(553, 42, 187),
(569, 42, 188),
(116, 43, 139),
(128, 43, 140),
(188, 43, 144),
(203, 43, 145),
(219, 43, 146),
(264, 43, 149),
(279, 43, 150),
(380, 43, 175),
(395, 43, 176),
(410, 43, 177),
(426, 43, 178),
(442, 43, 179),
(522, 43, 185),
(538, 43, 186),
(554, 43, 187),
(570, 43, 188),
(117, 44, 139),
(129, 44, 140),
(189, 44, 144),
(204, 44, 145),
(220, 44, 146),
(265, 44, 149),
(280, 44, 150),
(381, 44, 175),
(396, 44, 176),
(411, 44, 177),
(427, 44, 178),
(443, 44, 179),
(523, 44, 185),
(539, 44, 186),
(555, 44, 187),
(571, 44, 188),
(118, 45, 139),
(130, 45, 140),
(190, 45, 144),
(205, 45, 145),
(221, 45, 146),
(266, 45, 149),
(281, 45, 150),
(382, 45, 175),
(397, 45, 176),
(412, 45, 177),
(428, 45, 178),
(444, 45, 179),
(524, 45, 185),
(540, 45, 186),
(556, 45, 187),
(572, 45, 188),
(131, 46, 140),
(191, 46, 144),
(206, 46, 145),
(222, 46, 146),
(267, 46, 149),
(282, 46, 150),
(383, 46, 175),
(398, 46, 176),
(413, 46, 177),
(429, 46, 178),
(445, 46, 179),
(525, 46, 185),
(541, 46, 186),
(557, 46, 187),
(573, 46, 188),
(132, 47, 140),
(192, 47, 144),
(207, 47, 145),
(223, 47, 146),
(268, 47, 149),
(283, 47, 150),
(384, 47, 175),
(399, 47, 176),
(414, 47, 177),
(430, 47, 178),
(446, 47, 179),
(526, 47, 185),
(542, 47, 186),
(558, 47, 187),
(574, 47, 188),
(133, 48, 140),
(193, 48, 144),
(208, 48, 145),
(224, 48, 146),
(269, 48, 149),
(284, 48, 150),
(385, 48, 175),
(400, 48, 176),
(415, 48, 177),
(431, 48, 178),
(447, 48, 179),
(527, 48, 185),
(543, 48, 186),
(559, 48, 187),
(575, 48, 188),
(416, 49, 177),
(432, 49, 178),
(448, 49, 179),
(528, 49, 185),
(544, 49, 186),
(560, 49, 187),
(576, 49, 188);

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
(16, 14, 21, 'xperia p'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=141 ;

--
-- Volcado de datos para la tabla `tutor_usuario`
--

INSERT INTO `tutor_usuario` (`id_tutor`, `id_usuario`, `tutor_usuario`) VALUES
(14, 116, 72),
(14, 117, 73),
(14, 118, 74),
(14, 120, 75),
(14, 121, 76),
(14, 123, 78),
(14, 124, 79),
(14, 139, 92),
(14, 140, 93),
(14, 144, 97),
(14, 145, 98),
(14, 146, 99),
(14, 149, 102),
(14, 150, 103),
(14, 151, 104),
(14, 153, 105),
(14, 154, 106),
(14, 155, 107),
(14, 175, 127),
(14, 176, 128),
(14, 177, 129),
(14, 178, 130),
(14, 179, 131),
(14, 181, 133),
(14, 185, 137),
(14, 186, 138),
(14, 187, 139),
(14, 188, 140);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=189 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `mail_usuario`, `pass_usuario`, `roles`, `nombre_usuario`, `apellidos_usuario`, `foto_usuario`, `tlfn_usuario`, `fnac_usuario`, `direccion_usuario`, `id_configuracion_usuario`) VALUES
(116, 'mail@mail.com', 0, 'ROLE_USER', 'mail', 'mail', NULL, '', '', NULL, 98),
(117, 'maria334@mail.com', 3, 'ROLE_USER', 'maria', 'maria', NULL, '', '', NULL, 99),
(118, 'martac@mail.com', 3, 'ROLE_USER', 'marta', 'carcajona', NULL, '', '', NULL, 100),
(120, 'nacho@mail.com', NULL, 'ROLE_USER', 'nacho', 'rodriguez', NULL, '', '', NULL, 101),
(121, 'jony@mail.com', NULL, 'ROLE_USER', 'jony', 'a', NULL, '', '', NULL, 102),
(123, 'true2x2@mail.com', NULL, 'ROLE_USER', 'true2x2', 'true', NULL, '', '', NULL, 103),
(124, 'true4x4@mail.com', NULL, 'ROLE_USER', 'true4x4', 'true', NULL, '', '', NULL, 104),
(139, 'true3x3_2x2_bn@mail.com', NULL, 'ROLE_USER', 'true3x3_2x2_bn', 'bn', NULL, '', '', NULL, 109),
(140, 'tr22x33@mail.com', NULL, 'ROLE_USER', 'tr22x33', 'molina', NULL, '', '', NULL, 110),
(144, 'rocio77@mail.com', 0, 'ROLE_USER', 'rocio', 'carcajona', NULL, '', '', NULL, 126),
(145, 'borja343@mail.com', NULL, 'ROLE_USER', 'borja', 'molina', NULL, '', '', NULL, 127),
(146, 'borja44@mail.com', NULL, 'ROLE_USER', 'borja', 'molina', NULL, '', '', NULL, 128),
(149, 'borjita@mail.com', NULL, 'ROLE_USER', 'borji', 'a', NULL, '', '', NULL, 133),
(150, 'martita22@mail.com', NULL, 'ROLE_USER', 'martita', 'martita', NULL, '', '', NULL, 134),
(151, 'josesito@mail.com', NULL, 'ROLE_USER', 'josesito', 'jos', NULL, '', '', NULL, NULL),
(153, 'jose333@mail.com', NULL, 'ROLE_USER', 'jose', 'jose', NULL, '', '', NULL, NULL),
(154, 'ertotes@mail.com', NULL, 'ROLE_USER', 'ertotes', 'd', NULL, '', '', NULL, NULL),
(155, 'ertotes2@mail.com', NULL, 'ROLE_USER', 'a', 'a', NULL, '', '', NULL, 135),
(175, 'mariamd@mail.com', NULL, 'ROLE_USER', 'Mariamd', 'Mar', NULL, '', '', NULL, 159),
(176, 'lr_22_21@mail.com', NULL, 'ROLE_USER', 'lr_22_21', 'lr_22_21', NULL, '', '', NULL, 160),
(177, 'lr_34_21@mail.com', NULL, 'ROLE_USER', 'lr_34_21', 'lr', NULL, '', '', NULL, 161),
(178, 'lr_34_22@mail.com', NULL, 'ROLE_USER', 'lr_34_22', 'lt', NULL, '', '', NULL, 162),
(179, 'mlr_33_31@mail.com', NULL, 'ROLE_USER', 'mlr_33_31', 'A', NULL, '', '', NULL, 163),
(181, 'pr_4304@mail.com', NULL, 'ROLE_USER', 'pr_4304', 'pr_4304', NULL, '', '', NULL, NULL),
(185, 'lr.22.21@mail.com', NULL, 'ROLE_USER', 'lr.22.21', 'lr', NULL, '', '', NULL, 178),
(186, 'lr.22.21.cro@mail.com', NULL, 'ROLE_USER', 'lr.22.21.cro', 'lr', NULL, '', '', NULL, 179),
(187, 'lr.22.21.bar2@mail.com', NULL, 'ROLE_USER', 'lr.22.21.bar2', 'lr', NULL, '', '', NULL, 180),
(188, 'lr.22.21.bar1@mail.com', NULL, 'ROLE_USER', 'lr.22.21.bar1', 'lr', NULL, '', '', NULL, 181);

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
