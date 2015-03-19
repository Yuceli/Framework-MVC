-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-03-2015 a las 16:58:50
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `mvc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `data`
--

CREATE TABLE IF NOT EXISTS `data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `data`
--

INSERT INTO `data` (`id`, `text`) VALUES
(1, 'hola'),
(2, 'mundo'),
(3, 'test');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `role` enum('default','admin','owner') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'default',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `role`) VALUES
(1, 'yuceli', '29c2e0a10862c6da50c67505bec06f7c', 'owner'),
(2, 'polanco', '29c2e0a10862c6da50c67505bec06f7c', 'default');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
