-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-08-2015 a las 22:26:16
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
  PRIMARY KEY (`id_configuracion_usuario`),
  UNIQUE KEY `id_configuracion_usuario_UNIQUE` (`id_configuracion_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=159 ;

--
-- Volcado de datos para la tabla `configuracion_usuario`
--

INSERT INTO `configuracion_usuario` (`id_configuracion_usuario`, `color_principal`, `color_secundario`, `contraste`, `tam_letra`, `barrido`, `tiempo_barrido`, `reconocimiento_voz`, `retroalimentacion_vibracion`, `retroalimentacion_voz`, `css`) VALUES
(2, 'blue', 'white', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(3, 'blue', 'white', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(4, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'homeController.css'),
(5, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'homeController.css'),
(6, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'homeController.css'),
(9, '#265a88', '#eb9316', 1, 12, NULL, 4, NULL, NULL, NULL, 'homeController.css'),
(10, '#265a88', '#eb9316', 1, 12, 1, 6, NULL, NULL, NULL, 'homeController.css'),
(11, '#265a88', '#eb9316', 1, 12, NULL, 4, NULL, NULL, NULL, 'homeController.css'),
(12, '#265a88', '#eb9316', 1, 12, 1, 4, NULL, NULL, NULL, 'homeController.css'),
(13, '#265a88', '#eb9316', 1, 12, 1, 4, NULL, NULL, NULL, 'homeController.css'),
(14, '#265a88', '#eb9316', 1, 12, 1, 4, NULL, NULL, NULL, 'homeController.css'),
(15, '#265a88', '#eb9316', 1, 12, 1, 4, NULL, 1, NULL, 'homeController.css'),
(16, '#265a88', '#eb9316', 1, 12, 1, 4, NULL, 1, NULL, 'homeController.css'),
(17, '#265a88', '#eb9316', 1, 12, NULL, 4, NULL, 1, NULL, 'homeController.css'),
(18, '#265a88', '#eb9316', 1, 12, NULL, 4, NULL, 1, 1, 'homeController.css'),
(19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 'homeController.css'),
(20, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(21, '#c12e2a', '#CC2EFA', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(22, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(23, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(24, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(25, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(26, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(27, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(28, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(29, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(30, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(31, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(32, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(33, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(34, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(35, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(36, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(37, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(38, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(39, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(40, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(41, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(42, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(43, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(44, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(45, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(46, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(47, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(48, '#265a88', '#eb9316', 1, 99, 0, 4, 0, 0, 0, 'homeController.css'),
(49, '#265a88', '#eb9316', 1, 99, 0, 4, 0, 0, 0, 'homeController.css'),
(50, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(51, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(52, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(53, '#265a88', '#eb9316', 1, 99, 0, 4, 0, 0, 0, 'homeController.css'),
(54, '#265a88', '#eb9316', 1, 99, 0, 4, 0, 0, 0, 'homeController.css'),
(55, '#265a88', '#eb9316', 1, 99, 0, 4, 0, 0, 0, 'homeController.css'),
(56, '#265a88', '#eb9316', 1, 99, 0, 4, 0, 0, 0, 'homeController.css'),
(57, '#265a88', '#eb9316', 1, 99, 0, 4, 0, 0, 0, 'homeController.css'),
(58, '#265a88', '#eb9316', 1, 99, 0, 4, 0, 0, 0, 'homeController.css'),
(59, '#265a88', '#eb9316', 1, 99, 0, 4, 0, 0, 0, 'homeController.css'),
(60, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(61, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(62, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(63, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(64, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(65, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(66, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(67, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(68, '#265a88', '#eb9316', 1, 77, 0, 4, 0, 0, 0, 'homeController.css'),
(69, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(70, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(71, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(72, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(73, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(74, '#265a88', '#eb9316', 1, 56, 0, 4, 0, 0, 0, 'homeController.css'),
(75, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(76, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(77, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(78, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(79, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(80, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(81, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(82, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(83, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(84, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(85, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(86, '#265a88', '#eb9316', 1, 555, 0, 4, 0, 0, 0, 'homeController.css'),
(88, '#265a88', '#eb9316', 1, 553, 0, 4, 0, 0, 0, 'homeController.css'),
(89, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(90, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(91, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(92, '#265a88', '#eb9316', 1, 77, 0, 4, 0, 0, 0, 'homeController.css'),
(93, '#265a88', '#eb9316', 1, 12, 1, 4, 0, 0, 0, 'homeController.css'),
(94, '#265a88', '#eb9316', 1, 12, 1, 2, 0, 0, 0, 'homeController.css'),
(96, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(97, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(98, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(99, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(100, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(101, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(102, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(103, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(104, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(105, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(106, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(107, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(108, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(109, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(110, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(112, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(114, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(115, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(117, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(118, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(119, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(120, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(121, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(122, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(123, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(124, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(125, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(126, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(127, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(128, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(130, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(132, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(133, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(134, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(135, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(136, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(137, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(139, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(140, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(141, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(142, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(143, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(144, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(145, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'homeController.css'),
(147, '#265a88', '#eb9316', 1, 355, 0, 4, 0, 0, 0, 'homeController.css'),
(148, '#265a88', '#eb9316', 1, 12, 1, 4, 0, 0, 0, 'homeController.css'),
(149, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(150, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(151, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(152, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(154, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(155, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(156, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(157, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css'),
(158, '#265a88', '#eb9316', 1, 12, 0, 4, 0, 0, 0, 'homeController.css');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=163 ;

--
-- Volcado de datos para la tabla `dispositivo_usuario`
--

INSERT INTO `dispositivo_usuario` (`id_dispositivo_usuario`, `id_dispositivo`, `id_usuario`, `rotacion`, `filas_vertical`, `columnas_vertical`, `filas_horizontal`, `columnas_horizontal`) VALUES
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
(135, 26, 139, 1, 2, 2, 3, 3),
(136, 26, 140, 1, 2, 2, 3, 3),
(140, 26, 144, 0, NULL, NULL, 3, 3),
(141, 26, 145, 0, NULL, NULL, 3, 3),
(142, 26, 146, 0, NULL, NULL, 3, 3),
(145, 26, 149, 0, NULL, NULL, 3, 3),
(146, 26, 150, 0, NULL, NULL, 3, 3),
(147, 26, 153, NULL, NULL, NULL, NULL, NULL),
(148, 26, 154, NULL, NULL, NULL, NULL, NULL),
(149, 26, 155, 0, NULL, NULL, 3, 3),
(150, 26, 156, 0, NULL, NULL, 3, 3),
(151, 26, 157, NULL, NULL, NULL, NULL, NULL),
(152, 26, 158, NULL, NULL, NULL, NULL, NULL),
(153, 26, 159, 0, NULL, NULL, 3, 3),
(156, 26, 162, 1, 4, 2, 3, 3),
(157, 26, 163, 1, 3, 1, 4, 4),
(158, 26, 164, 1, 2, 1, 3, 3),
(159, 26, 165, 0, NULL, NULL, 3, 3),
(160, 26, 166, 0, NULL, NULL, 3, 3),
(162, 26, 168, 0, NULL, NULL, 3, 3);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=49 ;

--
-- Volcado de datos para la tabla `sensoractuador`
--

INSERT INTO `sensoractuador` (`Id_Sensor`, `PIN`, `Tipo`, `TipoValor`, `Valor`, `Localizacion`, `id_sen`, `id_usuario`, `id_habitacion`, `codigo_sensor`, `nombre_sensor`, `senact_sensor`, `tipo_sensor`, `modelo_sensor`, `descripcion_sensor`, `valor_min`, `valor_max`, `incremento`) VALUES
('33', 2, 'Actuador', '0', 1, NULL, 33, NULL, 30, '_bn0', 'Bombilla1', 1, '', 'bn', '', 0, 1, 1),
('34', 12, 'Actuador', '0', 0, NULL, 34, NULL, 30, '_bn2', 'Bombilla 2', 1, '', 'bn', '', 0, 1, 1),
('35', 12, 'Actuador', '2', 0, NULL, 35, NULL, 30, '_bn2344', 'Aire acondicionado', 1, '', 'bn', '', 18, 30, 1),
('36', 12, 'Actuador', '1', 2, NULL, 36, NULL, 30, '_bn34930948', 'Luz regulable', 1, '', 'bn', '', 0, 3, 1),
('37', 24, 'Actuador', '1', 5, NULL, 37, NULL, 30, '_bn39840938403', 'luz 2', 1, '', 'bn', '', 0, 27, 1),
('39', 12, 'Sensor', '-1', 0, NULL, 39, NULL, 31, '_bn_sen_3849348903', 'Temperatura', 0, '', 'bn', '', 0, 1, 1),
('40', 33, 'Sensor', '-1', 0, NULL, 40, NULL, 31, '_bn_sen_3984380', 'Humedad', 0, '', 'bn', '', 0, 1, 1),
('41', 55, 'Actuador', '2', 0, NULL, 41, NULL, 30, 'bn_3ui43o4u', 'Actuador salon', 1, '', 'bn', '', 0, 1, 1),
('42', 444, 'Sensor', '-1', 12, NULL, 42, NULL, 31, '_bn_sen_894934', 'Luminosidad', 0, '', 'sen', '', 0, 1, 1),
('43', 343543453, 'Sensor', '-1', 0, NULL, 43, NULL, 31, '_bn_sen_39483094', 'Pecera', 0, '', 'bn', '', 0, 1, 1),
('44', 23535, 'Sensor', '-1', 0, NULL, 44, NULL, 31, '_bn_sen_394830934', 'Temperatura 2', 0, '', 'bn', '', 0, 1, 1),
('45', 234323, 'Sensor', '-1', 11, NULL, 45, NULL, 30, '_bn_sen_3849334', 'Temperatura3', 0, '', 'bn', '', 0, 1, 1),
('46', 345, 'Sensor', '-1', 0, NULL, 46, NULL, 31, '_bn_sen_98', 'temperatura 4', 0, '', 'bn', '', 0, 1, 1),
('47', 345, 'Sensor', '-1', 33, NULL, 47, NULL, 31, '_bn_sen_384943804', 'temperatura 5', 0, '', 'bn', '', 0, 1, 1),
('48', 235, 'Sensor', '-1', 0, NULL, 48, NULL, 31, '_bn_sen_3948334', 'temperatura 6', 0, '', 'bn', '', 0, 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=341 ;

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
(288, 33, 157),
(293, 33, 164),
(308, 33, 165),
(323, 33, 166),
(339, 33, 169),
(108, 34, 139),
(120, 34, 140),
(180, 34, 144),
(195, 34, 145),
(211, 34, 146),
(256, 34, 149),
(271, 34, 150),
(294, 34, 164),
(309, 34, 165),
(324, 34, 166),
(109, 35, 139),
(121, 35, 140),
(181, 35, 144),
(196, 35, 145),
(212, 35, 146),
(257, 35, 149),
(272, 35, 150),
(289, 35, 157),
(295, 35, 164),
(310, 35, 165),
(325, 35, 166),
(110, 36, 139),
(122, 36, 140),
(182, 36, 144),
(197, 36, 145),
(213, 36, 146),
(258, 36, 149),
(273, 36, 150),
(290, 36, 157),
(296, 36, 164),
(311, 36, 165),
(326, 36, 166),
(111, 37, 139),
(123, 37, 140),
(183, 37, 144),
(198, 37, 145),
(214, 37, 146),
(259, 37, 149),
(274, 37, 150),
(297, 37, 164),
(312, 37, 165),
(327, 37, 166),
(112, 39, 139),
(124, 39, 140),
(184, 39, 144),
(199, 39, 145),
(215, 39, 146),
(260, 39, 149),
(275, 39, 150),
(298, 39, 164),
(313, 39, 165),
(328, 39, 166),
(113, 40, 139),
(125, 40, 140),
(185, 40, 144),
(200, 40, 145),
(216, 40, 146),
(261, 40, 149),
(276, 40, 150),
(299, 40, 164),
(314, 40, 165),
(329, 40, 166),
(114, 41, 139),
(126, 41, 140),
(186, 41, 144),
(201, 41, 145),
(217, 41, 146),
(262, 41, 149),
(277, 41, 150),
(286, 41, 155),
(287, 41, 156),
(291, 41, 157),
(300, 41, 164),
(315, 41, 165),
(330, 41, 166),
(338, 41, 168),
(340, 41, 169),
(115, 42, 139),
(127, 42, 140),
(187, 42, 144),
(202, 42, 145),
(218, 42, 146),
(263, 42, 149),
(278, 42, 150),
(301, 42, 164),
(316, 42, 165),
(331, 42, 166),
(116, 43, 139),
(128, 43, 140),
(188, 43, 144),
(203, 43, 145),
(219, 43, 146),
(264, 43, 149),
(279, 43, 150),
(302, 43, 164),
(317, 43, 165),
(332, 43, 166),
(117, 44, 139),
(129, 44, 140),
(189, 44, 144),
(204, 44, 145),
(220, 44, 146),
(265, 44, 149),
(280, 44, 150),
(303, 44, 164),
(318, 44, 165),
(333, 44, 166),
(118, 45, 139),
(130, 45, 140),
(190, 45, 144),
(205, 45, 145),
(221, 45, 146),
(266, 45, 149),
(281, 45, 150),
(304, 45, 164),
(319, 45, 165),
(334, 45, 166),
(131, 46, 140),
(191, 46, 144),
(206, 46, 145),
(222, 46, 146),
(267, 46, 149),
(282, 46, 150),
(305, 46, 164),
(320, 46, 165),
(335, 46, 166),
(132, 47, 140),
(192, 47, 144),
(207, 47, 145),
(223, 47, 146),
(268, 47, 149),
(283, 47, 150),
(306, 47, 164),
(321, 47, 165),
(336, 47, 166),
(133, 48, 140),
(193, 48, 144),
(208, 48, 145),
(224, 48, 146),
(269, 48, 149),
(284, 48, 150),
(307, 48, 164),
(322, 48, 165),
(337, 48, 166);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=122 ;

--
-- Volcado de datos para la tabla `tutor_usuario`
--

INSERT INTO `tutor_usuario` (`id_tutor`, `id_usuario`, `tutor_usuario`) VALUES
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
(14, 156, 108),
(14, 157, 109),
(14, 158, 110),
(14, 159, 111),
(14, 162, 114),
(14, 163, 115),
(14, 164, 116),
(14, 165, 117),
(14, 166, 118),
(14, 168, 120),
(14, 169, 121);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=170 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `mail_usuario`, `pass_usuario`, `roles`, `nombre_usuario`, `apellidos_usuario`, `foto_usuario`, `tlfn_usuario`, `fnac_usuario`, `direccion_usuario`, `id_configuracion_usuario`) VALUES
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
(156, 'nata33@mail.com', NULL, 'ROLE_USER', 'nata', 'nata', NULL, '', '', NULL, 136),
(157, 'pomelo@mail.com', NULL, 'ROLE_USER', 'pomelo', 'a', NULL, '', '', NULL, NULL),
(158, 'narco@mail.com', NULL, 'ROLE_USER', 'narco', 'a', NULL, '', '', NULL, NULL),
(159, 'kaseo@mail.com', NULL, 'ROLE_USER', 'kase', 'kase', NULL, '', '', NULL, 137),
(162, 'mala@mail.com', NULL, 'ROLE_USER', 'mala', 'rod', NULL, '', '', NULL, 148),
(163, 'dove@mail.com', NULL, 'ROLE_USER', 'dover', 'dov', NULL, '', '', NULL, 149),
(164, 'relief@mail.com', NULL, 'ROLE_USER', 'relief', 'rel', NULL, '', '', NULL, 150),
(165, 'mairo@mail.com', NULL, 'ROLE_USER', 'mairo', 'tross', NULL, '', '', NULL, 151),
(166, 'rocionata@mail.com', NULL, 'ROLE_USER', 'rocio', 'nata', NULL, '', '', NULL, 152),
(168, 'sony@mail.com', NULL, 'ROLE_USER', 'sony', 'sony', NULL, '', '', NULL, 157),
(169, 'naz3a@mail.com', NULL, 'ROLE_USER', 'naza', 'naza', NULL, '', '', NULL, 158);

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
