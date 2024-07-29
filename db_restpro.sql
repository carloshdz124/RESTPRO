-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 29-07-2024 a las 23:06:12
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_restpro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

DROP TABLE IF EXISTS `area`;
CREATE TABLE IF NOT EXISTS `area` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre de area',
  `descripcion` varchar(250) NOT NULL COMMENT 'Descripcion de area',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Salon', 'Salon principal'),
(2, 'Terraza', 'Zona de fumar, area libre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

DROP TABLE IF EXISTS `mesa`;
CREATE TABLE IF NOT EXISTS `mesa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `area` int NOT NULL,
  `n_personas` int NOT NULL,
  `estado` int NOT NULL DEFAULT '0' COMMENT '0 = disponible,\r\n1 = Ocupada,\r\n2 = Reservada',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`id`, `nombre`, `area`, `n_personas`, `estado`) VALUES
(1, '01', 1, 4, 0),
(2, '02', 1, 4, 1),
(3, '03', 1, 4, 0),
(4, '10', 1, 5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_mesa`
--

DROP TABLE IF EXISTS `registro_mesa`;
CREATE TABLE IF NOT EXISTS `registro_mesa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `n_adultos` int NOT NULL,
  `n_ninos` int NOT NULL,
  `area` varchar(50) NOT NULL,
  `hora` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `registro_mesa`
--

INSERT INTO `registro_mesa` (`id`, `nombre`, `n_adultos`, `n_ninos`, `area`, `hora`) VALUES
(1, 'juan', 2, 3, 'salon', NULL),
(2, 'Pedro', 3, 0, 'salon', NULL),
(3, 'juan', 2, 3, 'salon', NULL),
(4, 'Diego', 2, 3, 'salon', NULL),
(5, 'javier', 8, 2, 'salon', NULL),
(6, 'lopez', 2, 4, 'infantil', NULL),
(7, 'Martin', 4, 0, 'salon', NULL),
(8, 'Alfredo', 2, 1, 'salon', NULL),
(9, '', 0, 0, '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(200) NOT NULL COMMENT 'Nombre de usuario',
  `password` varchar(200) NOT NULL COMMENT 'Contraseña',
  `md5` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Contraseña mdh5',
  `tipo_usuario` int NOT NULL COMMENT '1-admin, 2-capitan, 3-usuario',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `md5`, `tipo_usuario`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'capitan', 'capitan', 'a85c04ef417c53019e3f59d459178af6', 2),
(3, 'usuario', 'usuario', 'f8032d5cae3de20fcec887f395ec9a6a', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
