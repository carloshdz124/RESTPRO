-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 04-08-2024 a las 06:24:59
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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Salon', 'Salon principal'),
(2, 'Terraza 2', 'Zona de fumar, area abierta\r\n'),
(3, 'Mezzanin', 'Area infantil'),
(4, 'Terraza 1', 'Area de fumar');

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
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`id`, `nombre`, `area_id`, `n_personas`, `estado`) VALUES
(1, '01', 1, 4, 0),
(2, '02', 1, 4, 1),
(3, '03', 1, 4, 0),
(4, '10', 1, 4, 2),
(5, '100', 2, 4, 0),
(8, '06', 1, 4, 0),
(7, '05', 1, 4, 0),
(6, '04', 1, 4, 0),
(9, '07', 1, 4, 0),
(10, '08', 1, 4, 0),
(11, '11', 1, 4, 0),
(12, '12', 1, 4, 0),
(13, '13', 1, 8, 0),
(14, '14', 1, 5, 0),
(15, '15', 1, 4, 0),
(16, '16', 1, 4, 0),
(17, '17', 1, 4, 0),
(18, '20', 1, 4, 0),
(19, '21', 1, 5, 0),
(20, '22', 1, 8, 0),
(21, '23', 1, 8, 0),
(22, '24', 1, 5, 0),
(23, '25', 1, 8, 0),
(24, '30', 1, 8, 0),
(25, '31', 1, 8, 0),
(26, '32', 1, 4, 0),
(27, '33', 1, 5, 0),
(28, '34', 1, 8, 0),
(29, '35', 1, 4, 0),
(30, '50', 4, 6, 0),
(31, '51', 4, 4, 0),
(32, '52', 4, 4, 0),
(33, '53', 4, 4, 0),
(34, '54', 4, 4, 0),
(35, '55', 4, 5, 0),
(36, '60', 4, 6, 0),
(37, '61', 4, 4, 0),
(38, '62', 4, 6, 0),
(39, '70', 4, 4, 0),
(40, '71', 4, 4, 0),
(41, '72', 4, 5, 0),
(42, '80', 4, 4, 0),
(43, '81', 4, 4, 0),
(44, '82', 4, 6, 0),
(45, '83', 4, 6, 0),
(46, 'fish', 4, 16, 0),
(47, 'octopus', 4, 12, 0),
(48, '101', 2, 6, 0),
(49, '102', 2, 4, 0),
(50, '103', 2, 8, 0),
(51, '110', 2, 4, 0),
(52, '111', 2, 5, 0),
(53, '112', 2, 4, 0),
(54, '120', 2, 4, 0),
(55, '121', 2, 6, 0),
(56, '122', 2, 4, 0),
(57, '123', 2, 6, 0),
(58, '130', 2, 6, 0),
(59, '131', 2, 6, 0),
(60, '132', 2, 4, 0),
(61, '140', 2, 6, 0),
(62, '141', 2, 6, 0),
(63, '142', 2, 4, 0),
(64, '150', 2, 5, 0),
(65, '151', 2, 4, 0),
(66, '160', 3, 8, 0),
(67, '161', 3, 8, 0),
(68, '162', 3, 8, 0),
(69, '170', 3, 4, 0),
(70, '171', 3, 4, 0),
(71, '172', 3, 4, 0),
(72, '173', 3, 4, 0),
(73, '174', 3, 4, 0),
(74, '180', 3, 8, 0),
(75, '181', 3, 5, 0),
(76, '182', 3, 4, 0),
(77, '183', 3, 4, 0),
(78, '184', 3, 5, 0),
(79, '190', 3, 8, 0),
(80, '191', 3, 8, 0),
(81, '192', 3, 8, 0),
(82, '193', 3, 8, 0),
(83, '194', 3, 8, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa_cliente`
--

DROP TABLE IF EXISTS `mesa_cliente`;
CREATE TABLE IF NOT EXISTS `mesa_cliente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `telefono` bigint DEFAULT NULL,
  `n_adultos` int NOT NULL,
  `n_ninos` int NOT NULL,
  `hora_llegada` time DEFAULT NULL,
  `fecha` date NOT NULL,
  `estado` int NOT NULL DEFAULT '0' COMMENT '0 = Espera,\r\n1 = Reserva,\r\n2 = Sentado',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `mesa_cliente`
--

INSERT INTO `mesa_cliente` (`id`, `nombre`, `telefono`, `n_adultos`, `n_ninos`, `hora_llegada`, `fecha`, `estado`) VALUES
(1, 'juan', NULL, 2, 3, '13:30:00', '2024-07-05', 0),
(2, 'Pedro', 3322115566, 3, 0, '14:16:50', '2024-07-05', 1),
(3, 'Lopez', NULL, 2, 3, '14:25:00', '2024-07-05', 0),
(4, 'Diego', NULL, 2, 3, '15:00:00', '2024-07-05', 0),
(5, 'javier', NULL, 8, 2, '15:12:00', '2024-07-05', 0),
(6, 'lopez', NULL, 2, 4, '15:20:00', '2024-07-05', 0),
(7, 'Martin', NULL, 4, 0, '15:25:00', '2024-07-05', 0),
(8, 'Alfredo', NULL, 2, 1, '15:33:00', '2024-07-05', 0),
(9, 'Joaquin', NULL, 4, 0, '15:41:00', '2024-07-05', 0),
(10, 'Carlos', NULL, 2, 0, '20:07:46', '2024-07-30', 0),
(11, 'Fernando Reyes', 3311799528, 1, 0, '18:14:00', '2024-07-05', 1),
(12, 'Miguel', 0, 2, 2, '18:09:57', '2024-07-31', 0),
(13, 'Daniel', 0, 2, 0, '19:10:00', '2024-07-31', 0),
(14, 'xxx', 0, 1, 2, '08:16:06', '2024-08-03', 0);

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
