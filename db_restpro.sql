-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 31-07-2024 a las 02:17:16
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Salon', 'Salon principal'),
(2, 'Terraza', 'Zona de fumar, area libre'),
(3, 'Mezzanin', 'Area infantil');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

DROP TABLE IF EXISTS `mesa`;
CREATE TABLE IF NOT EXISTS `mesa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `area_id` int NOT NULL,
  `n_personas` int NOT NULL,
  `estado` int NOT NULL DEFAULT '0' COMMENT '0 = disponible,\r\n1 = Ocupada,\r\n2 = Reservada',
  PRIMARY KEY (`id`),
  KEY `area_id` (`area_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`id`, `nombre`, `area_id`, `n_personas`, `estado`) VALUES
(1, '01', 1, 4, 0),
(2, '02', 1, 4, 1),
(3, '03', 1, 4, 0),
(4, '10', 1, 5, 2),
(5, '100', 2, 4, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa_cliente`
--

DROP TABLE IF EXISTS `mesa_cliente`;
CREATE TABLE IF NOT EXISTS `mesa_cliente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `telefono` int DEFAULT NULL,
  `n_adultos` int NOT NULL,
  `n_ninos` int NOT NULL,
  `hora_llegada` time DEFAULT NULL,
  `fecha` date NOT NULL,
  `estado` int NOT NULL DEFAULT '0' COMMENT '0 = Espera,\r\n1 = Reserva,\r\n2 = Sentado',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `mesa_cliente`
--

INSERT INTO `mesa_cliente` (`id`, `nombre`, `telefono`, `n_adultos`, `n_ninos`, `hora_llegada`, `fecha`, `estado`) VALUES
(1, 'juan', NULL, 2, 3, '13:30:00', '2024-07-05', 0),
(2, 'Pedro', 2147483647, 3, 0, '14:16:50', '2024-07-05', 1),
(3, 'juan', NULL, 2, 3, '14:25:00', '2024-07-05', 0),
(4, 'Diego', NULL, 2, 3, '15:00:00', '2024-07-05', 0),
(5, 'javier', NULL, 8, 2, '15:12:00', '2024-07-05', 0),
(6, 'lopez', NULL, 2, 4, '15:20:00', '2024-07-05', 0),
(7, 'Martin', NULL, 4, 0, '15:25:00', '2024-07-05', 0),
(8, 'Alfredo', NULL, 2, 1, '15:33:00', '2024-07-05', 0),
(9, 'Joaquin', NULL, 4, 0, '15:41:00', '2024-07-05', 0),
(10, 'Carlos', NULL, 2, 0, '20:07:46', '2024-07-30', 0),
(11, 'Fernando Reyes', 0, 1, 0, '18:14:00', '2024-07-05', 1);

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
