-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 21-09-2024 a las 10:54:33
-- Versión del servidor: 8.0.39
-- Versión de PHP: 8.2.8

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
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre de area',
  `descripcion` varchar(250) NOT NULL COMMENT 'Descripcion de area'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Salon', 'Salon principal'),
(2, 'Terraza 1', 'Area de fumar'),
(3, 'Terraza 2', 'Zona de fumar, area abierta\r\n'),
(4, 'Mezzanin', 'Area infantil');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion_mesas`
--

CREATE TABLE `asignacion_mesas` (
  `id` int NOT NULL,
  `mesa_id` int DEFAULT NULL,
  `estacion_id` int DEFAULT NULL,
  `rol_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `asignacion_mesas`
--

INSERT INTO `asignacion_mesas` (`id`, `mesa_id`, `estacion_id`, `rol_id`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 4, 1, 1),
(4, 11, 1, 1),
(5, 3, 2, 1),
(6, 12, 2, 1),
(7, 13, 2, 1),
(8, 6, 2, 1),
(9, 8, 3, 1),
(10, 7, 3, 1),
(11, 14, 3, 1),
(12, 15, 3, 1),
(13, 10, 4, 1),
(14, 9, 4, 1),
(15, 16, 4, 1),
(16, 17, 4, 1),
(17, 18, 5, 1),
(18, 19, 5, 1),
(19, 24, 5, 1),
(20, 20, 6, 1),
(21, 25, 6, 1),
(22, 26, 6, 1),
(23, 21, 7, 1),
(24, 27, 7, 1),
(25, 28, 7, 1),
(26, 22, 8, 1),
(27, 23, 8, 1),
(28, 29, 8, 1),
(29, 5, 14, 1),
(30, 48, 14, 1),
(31, 51, 14, 1),
(32, 52, 14, 1),
(33, 54, 15, 1),
(34, 55, 15, 1),
(35, 56, 15, 1),
(36, 53, 15, 1),
(37, 49, 16, 1),
(38, 50, 16, 1),
(39, 57, 16, 1),
(40, 58, 17, 1),
(41, 59, 17, 1),
(42, 60, 17, 1),
(43, 63, 17, 1),
(44, 61, 18, 1),
(45, 62, 18, 1),
(46, 64, 18, 1),
(47, 65, 18, 1),
(48, 66, 19, 1),
(49, 70, 19, 1),
(50, 71, 19, 1),
(51, 67, 20, 1),
(52, 68, 20, 1),
(53, 72, 20, 1),
(54, 73, 20, 1),
(55, 69, 21, 1),
(56, 74, 21, 1),
(57, 79, 21, 1),
(58, 81, 22, 1),
(59, 80, 22, 1),
(60, 75, 22, 1),
(61, 76, 22, 1),
(62, 77, 23, 1),
(63, 78, 23, 1),
(64, 82, 23, 1),
(65, 83, 23, 1),
(66, 30, 9, 1),
(67, 31, 9, 1),
(68, 32, 9, 1),
(69, 36, 9, 1),
(70, 34, 10, 1),
(71, 35, 10, 1),
(72, 41, 10, 1),
(73, 38, 10, 1),
(74, 33, 11, 1),
(75, 37, 11, 1),
(76, 39, 11, 1),
(77, 40, 11, 1),
(78, 42, 12, 1),
(79, 45, 12, 1),
(80, 46, 12, 1),
(81, 47, 13, 1),
(82, 44, 13, 1),
(83, 43, 13, 1),
(84, 1, 1, 2),
(85, 2, 1, 2),
(86, 3, 1, 2),
(87, 4, 1, 2),
(88, 5, 2, 2),
(89, 6, 2, 2),
(90, 7, 2, 2),
(91, 8, 2, 2),
(92, 9, 3, 2),
(93, 10, 3, 2),
(94, 11, 3, 2),
(95, 12, 3, 2),
(96, 13, 4, 2),
(97, 14, 4, 2),
(98, 15, 4, 2),
(99, 16, 4, 2),
(100, 17, 5, 2),
(101, 18, 5, 2),
(102, 19, 5, 2),
(103, 20, 5, 2),
(104, 21, 6, 2),
(105, 22, 6, 2),
(106, 23, 6, 2),
(107, 24, 6, 2),
(108, 25, 7, 2),
(109, 26, 7, 2),
(110, 27, 7, 2),
(111, 28, 7, 2),
(112, 29, 8, 2),
(113, 30, 8, 2),
(114, 31, 8, 2),
(115, 32, 8, 2),
(116, 33, 9, 2),
(117, 34, 9, 2),
(118, 35, 9, 2),
(119, 36, 9, 2),
(120, 37, 10, 2),
(121, 38, 10, 2),
(122, 39, 10, 2),
(123, 40, 10, 2),
(124, 41, 11, 2),
(125, 42, 11, 2),
(126, 43, 11, 2),
(127, 44, 11, 2),
(128, 45, 12, 2),
(129, 46, 12, 2),
(130, 47, 12, 2),
(131, 48, 12, 2),
(132, 49, 13, 2),
(133, 50, 13, 2),
(134, 51, 13, 2),
(135, 52, 13, 2),
(136, 53, 14, 2),
(137, 54, 14, 2),
(138, 55, 14, 2),
(139, 56, 14, 2),
(140, 57, 15, 2),
(141, 58, 15, 2),
(142, 59, 15, 2),
(143, 60, 15, 2),
(144, 61, 16, 2),
(145, 62, 16, 2),
(146, 63, 16, 2),
(147, 64, 16, 2),
(148, 65, 17, 2),
(149, 66, 17, 2),
(150, 67, 17, 2),
(151, 68, 17, 2),
(152, 69, 18, 2),
(153, 70, 18, 2),
(154, 71, 18, 2),
(155, 72, 18, 2),
(156, 73, 19, 2),
(157, 74, 19, 2),
(158, 75, 19, 2),
(159, 76, 19, 2),
(160, 77, 20, 2),
(161, 78, 20, 2),
(162, 79, 20, 2),
(163, 80, 20, 2),
(164, 81, 21, 2),
(165, 82, 21, 2),
(166, 83, 21, 2),
(418, 1, 1, 3),
(419, 2, 1, 3),
(420, 3, 1, 3),
(421, 6, 1, 3),
(422, 7, 1, 3),
(423, 8, 1, 3),
(424, 9, 2, 3),
(425, 10, 2, 3),
(427, 4, 2, 3),
(428, 11, 2, 3),
(429, 12, 2, 3),
(430, 13, 3, 3),
(431, 14, 3, 3),
(432, 15, 3, 3),
(433, 16, 3, 3),
(434, 17, 3, 3),
(436, 18, 4, 3),
(437, 19, 4, 3),
(438, 20, 4, 3),
(439, 21, 4, 3),
(440, 22, 4, 3),
(441, 23, 4, 3),
(442, 24, 5, 3),
(443, 25, 5, 3),
(444, 26, 5, 3),
(445, 27, 5, 3),
(446, 28, 5, 3),
(447, 29, 5, 3),
(448, 30, 6, 3),
(449, 31, 6, 3),
(450, 32, 6, 3),
(451, 33, 6, 3),
(452, 34, 6, 3),
(453, 35, 7, 3),
(454, 36, 7, 3),
(455, 37, 7, 3),
(456, 38, 7, 3),
(457, 39, 7, 3),
(458, 40, 8, 3),
(459, 41, 8, 3),
(460, 42, 8, 3),
(461, 43, 8, 3),
(462, 44, 9, 3),
(463, 45, 9, 3),
(464, 46, 9, 3),
(465, 47, 9, 3),
(466, 5, 10, 3),
(467, 48, 10, 3),
(468, 49, 10, 3),
(469, 50, 10, 3),
(470, 51, 10, 3),
(471, 52, 11, 3),
(472, 53, 11, 3),
(473, 54, 11, 3),
(474, 55, 11, 3),
(475, 56, 11, 3),
(476, 57, 12, 3),
(477, 58, 12, 3),
(478, 59, 12, 3),
(479, 60, 12, 3),
(480, 61, 12, 3),
(481, 62, 13, 3),
(482, 63, 13, 3),
(483, 64, 13, 3),
(484, 65, 13, 3),
(485, 66, 14, 3),
(486, 67, 14, 3),
(487, 68, 14, 3),
(488, 69, 14, 3),
(489, 70, 14, 3),
(490, 71, 15, 3),
(491, 72, 15, 3),
(492, 73, 15, 3),
(493, 74, 15, 3),
(494, 75, 15, 3),
(495, 76, 16, 3),
(496, 77, 16, 3),
(497, 78, 16, 3),
(498, 79, 16, 3),
(499, 80, 17, 3),
(500, 81, 17, 3),
(501, 82, 17, 3),
(502, 83, 17, 3),
(503, 1, 1, 5),
(504, 2, 1, 5),
(505, 3, 1, 5),
(506, 6, 1, 5),
(507, 7, 2, 5),
(508, 8, 2, 5),
(509, 9, 2, 5),
(510, 10, 2, 5),
(511, 4, 3, 5),
(512, 11, 3, 5),
(513, 12, 3, 5),
(514, 13, 3, 5),
(515, 14, 4, 5),
(516, 15, 4, 5),
(517, 16, 4, 5),
(518, 17, 4, 5),
(519, 18, 5, 5),
(520, 19, 5, 5),
(521, 20, 5, 5),
(522, 21, 5, 5),
(523, 22, 6, 5),
(524, 23, 6, 5),
(525, 24, 6, 5),
(526, 25, 6, 5),
(527, 26, 7, 5),
(528, 27, 7, 5),
(529, 28, 7, 5),
(530, 29, 7, 5),
(531, 30, 8, 5),
(532, 31, 8, 5),
(533, 32, 8, 5),
(534, 33, 8, 5),
(535, 34, 9, 5),
(536, 35, 9, 5),
(537, 36, 9, 5),
(538, 37, 9, 5),
(539, 38, 10, 5),
(540, 39, 10, 5),
(541, 40, 10, 5),
(542, 41, 10, 5),
(543, 42, 11, 5),
(544, 43, 11, 5),
(545, 44, 11, 5),
(546, 45, 12, 5),
(547, 46, 12, 5),
(548, 47, 12, 5),
(549, 5, 13, 5),
(550, 48, 13, 5),
(551, 49, 13, 5),
(552, 50, 13, 5),
(553, 51, 14, 5),
(554, 52, 14, 5),
(555, 53, 14, 5),
(556, 54, 14, 5),
(557, 55, 15, 5),
(558, 56, 15, 5),
(559, 57, 15, 5),
(560, 58, 15, 5),
(561, 59, 16, 5),
(562, 60, 16, 5),
(563, 61, 16, 5),
(564, 62, 16, 5),
(565, 63, 17, 5),
(566, 64, 17, 5),
(567, 65, 17, 5),
(568, 66, 18, 5),
(569, 67, 18, 5),
(570, 68, 18, 5),
(571, 69, 18, 5),
(572, 70, 19, 5),
(573, 71, 19, 5),
(574, 72, 19, 5),
(575, 73, 19, 5),
(576, 74, 20, 5),
(577, 75, 20, 5),
(578, 76, 20, 5),
(579, 77, 20, 5),
(580, 78, 21, 5),
(581, 79, 21, 5),
(582, 80, 21, 5),
(583, 81, 22, 5),
(584, 82, 22, 5),
(585, 83, 22, 5),
(586, 1, 1, 6),
(587, 2, 1, 6),
(588, 3, 1, 6),
(589, 6, 1, 6),
(590, 7, 1, 6),
(591, 8, 1, 6),
(592, 9, 1, 6),
(593, 10, 2, 6),
(594, 4, 2, 6),
(595, 11, 2, 6),
(596, 12, 2, 6),
(597, 13, 2, 6),
(598, 14, 2, 6),
(599, 15, 2, 6),
(600, 16, 3, 6),
(601, 17, 3, 6),
(602, 18, 3, 6),
(603, 19, 3, 6),
(604, 20, 3, 6),
(605, 21, 3, 6),
(606, 22, 3, 6),
(607, 23, 4, 6),
(608, 24, 4, 6),
(609, 25, 4, 6),
(610, 26, 4, 6),
(611, 27, 4, 6),
(612, 28, 4, 6),
(613, 29, 4, 6),
(614, 30, 5, 6),
(615, 31, 5, 6),
(616, 32, 5, 6),
(617, 33, 5, 6),
(618, 34, 5, 6),
(619, 35, 6, 6),
(620, 36, 6, 6),
(621, 37, 6, 6),
(622, 38, 6, 6),
(623, 39, 6, 6),
(624, 40, 7, 6),
(625, 41, 7, 6),
(626, 42, 7, 6),
(627, 43, 7, 6),
(628, 44, 8, 6),
(629, 45, 8, 6),
(630, 46, 8, 6),
(631, 47, 8, 6),
(632, 5, 9, 6),
(633, 48, 9, 6),
(634, 49, 9, 6),
(635, 50, 9, 6),
(636, 51, 9, 6),
(637, 52, 10, 6),
(638, 53, 10, 6),
(639, 54, 10, 6),
(640, 55, 10, 6),
(641, 56, 10, 6),
(642, 57, 11, 6),
(643, 58, 11, 6),
(644, 59, 11, 6),
(645, 60, 11, 6),
(646, 61, 11, 6),
(647, 62, 12, 6),
(648, 63, 12, 6),
(649, 64, 12, 6),
(650, 65, 12, 6),
(651, 66, 13, 6),
(652, 67, 13, 6),
(653, 68, 13, 6),
(654, 69, 13, 6),
(655, 70, 13, 6),
(656, 71, 14, 6),
(657, 72, 14, 6),
(658, 73, 14, 6),
(659, 74, 14, 6),
(660, 75, 14, 6),
(661, 76, 15, 6),
(662, 77, 15, 6),
(663, 78, 15, 6),
(664, 79, 15, 6),
(665, 80, 16, 6),
(666, 81, 16, 6),
(667, 82, 16, 6),
(668, 83, 16, 6),
(669, 1, 1, 7),
(670, 2, 1, 7),
(671, 3, 1, 7),
(672, 6, 1, 7),
(673, 7, 1, 7),
(674, 8, 1, 7),
(675, 9, 2, 7),
(676, 10, 2, 7),
(677, 4, 2, 7),
(678, 11, 2, 7),
(679, 12, 2, 7),
(680, 13, 2, 7),
(681, 14, 3, 7),
(682, 15, 3, 7),
(683, 16, 3, 7),
(684, 17, 3, 7),
(685, 18, 3, 7),
(686, 19, 3, 7),
(687, 20, 4, 7),
(688, 21, 4, 7),
(689, 22, 4, 7),
(690, 23, 4, 7),
(691, 24, 4, 7),
(692, 25, 5, 7),
(693, 26, 5, 7),
(694, 27, 5, 7),
(695, 28, 5, 7),
(696, 29, 5, 7),
(697, 30, 6, 7),
(698, 31, 6, 7),
(699, 32, 6, 7),
(700, 33, 6, 7),
(701, 34, 6, 7),
(702, 35, 6, 7),
(703, 36, 7, 7),
(704, 37, 7, 7),
(705, 38, 7, 7),
(706, 39, 7, 7),
(707, 40, 7, 7),
(708, 41, 7, 7),
(709, 42, 8, 7),
(710, 43, 8, 7),
(711, 44, 8, 7),
(712, 45, 8, 7),
(713, 46, 8, 7),
(714, 47, 8, 7),
(715, 5, 9, 7),
(716, 48, 9, 7),
(717, 49, 9, 7),
(718, 50, 9, 7),
(719, 51, 9, 7),
(720, 52, 10, 7),
(721, 53, 10, 7),
(722, 54, 10, 7),
(723, 55, 10, 7),
(724, 56, 10, 7),
(725, 57, 11, 7),
(726, 58, 11, 7),
(727, 59, 11, 7),
(728, 60, 11, 7),
(729, 61, 11, 7),
(730, 62, 12, 7),
(731, 63, 12, 7),
(732, 64, 12, 7),
(733, 65, 12, 7),
(734, 66, 13, 7),
(735, 67, 13, 7),
(736, 68, 13, 7),
(737, 69, 13, 7),
(738, 70, 13, 7),
(739, 71, 13, 7),
(740, 72, 14, 7),
(741, 73, 14, 7),
(742, 74, 14, 7),
(743, 75, 14, 7),
(744, 76, 14, 7),
(745, 77, 14, 7),
(746, 78, 15, 7),
(747, 79, 15, 7),
(748, 80, 15, 7),
(749, 81, 15, 7),
(750, 82, 15, 7),
(751, 83, 15, 7),
(752, 1, 1, 8),
(753, 2, 1, 8),
(754, 3, 1, 8),
(755, 6, 1, 8),
(756, 7, 2, 8),
(757, 8, 2, 8),
(758, 9, 2, 8),
(759, 10, 2, 8),
(760, 4, 3, 8),
(761, 11, 3, 8),
(762, 12, 3, 8),
(763, 13, 3, 8),
(764, 14, 4, 8),
(765, 15, 4, 8),
(766, 16, 4, 8),
(767, 17, 4, 8),
(768, 18, 5, 8),
(769, 19, 5, 8),
(770, 20, 5, 8),
(771, 21, 6, 8),
(772, 22, 6, 8),
(773, 23, 6, 8),
(774, 24, 7, 8),
(775, 25, 7, 8),
(776, 26, 7, 8),
(777, 27, 8, 8),
(778, 28, 8, 8),
(779, 29, 8, 8),
(780, 30, 9, 8),
(781, 31, 9, 8),
(782, 32, 9, 8),
(783, 33, 9, 8),
(784, 34, 10, 8),
(785, 35, 10, 8),
(786, 36, 10, 8),
(787, 37, 10, 8),
(788, 38, 11, 8),
(789, 39, 11, 8),
(790, 40, 11, 8),
(791, 41, 11, 8),
(792, 42, 12, 8),
(793, 43, 12, 8),
(794, 44, 12, 8),
(795, 45, 13, 8),
(796, 46, 13, 8),
(797, 47, 13, 8),
(798, 5, 14, 8),
(799, 48, 14, 8),
(800, 49, 14, 8),
(801, 50, 14, 8),
(802, 51, 15, 8),
(803, 52, 15, 8),
(804, 53, 15, 8),
(805, 54, 16, 8),
(806, 55, 16, 8),
(807, 56, 16, 8),
(808, 57, 17, 8),
(809, 58, 17, 8),
(810, 59, 17, 8),
(811, 60, 18, 8),
(812, 61, 18, 8),
(813, 62, 18, 8),
(814, 63, 19, 8),
(815, 64, 19, 8),
(816, 65, 19, 8),
(817, 66, 20, 8),
(818, 67, 20, 8),
(819, 68, 20, 8),
(820, 69, 20, 8),
(821, 70, 21, 8),
(822, 71, 21, 8),
(823, 72, 21, 8),
(824, 73, 21, 8),
(825, 74, 22, 8),
(826, 75, 22, 8),
(827, 76, 22, 8),
(828, 77, 22, 8),
(829, 78, 23, 8),
(830, 79, 23, 8),
(831, 80, 23, 8),
(832, 81, 24, 8),
(833, 82, 24, 8),
(834, 83, 24, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion_meseros`
--

CREATE TABLE `asignacion_meseros` (
  `id` int NOT NULL,
  `mesero_id` int NOT NULL,
  `estacion_id` int NOT NULL,
  `rol_id` int NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `asignacion_meseros`
--

INSERT INTO `asignacion_meseros` (`id`, `mesero_id`, `estacion_id`, `rol_id`, `fecha`) VALUES
(49, 2, 1, 8, '2024-09-21'),
(50, 3, 2, 8, '2024-09-21'),
(51, 5, 3, 8, '2024-09-21'),
(52, 6, 4, 8, '2024-09-21'),
(53, 7, 5, 8, '2024-09-21'),
(54, 9, 6, 8, '2024-09-21'),
(55, 10, 7, 8, '2024-09-21'),
(56, 11, 8, 8, '2024-09-21'),
(57, 1, 9, 8, '2024-09-21'),
(58, 8, 10, 8, '2024-09-21'),
(59, 12, 11, 8, '2024-09-21'),
(60, 13, 12, 8, '2024-09-21'),
(61, 14, 13, 8, '2024-09-21'),
(62, 15, 14, 8, '2024-09-21'),
(63, 16, 15, 8, '2024-09-21'),
(64, 17, 16, 8, '2024-09-21'),
(65, 18, 17, 8, '2024-09-21'),
(66, 19, 18, 8, '2024-09-21'),
(67, 20, 19, 8, '2024-09-21'),
(68, 23, 20, 8, '2024-09-21'),
(69, 24, 21, 8, '2024-09-21'),
(70, 26, 22, 8, '2024-09-21'),
(71, 27, 23, 8, '2024-09-21'),
(72, 28, 24, 8, '2024-09-21'),
(73, 2, 1, 8, '2024-09-20'),
(74, 3, 2, 8, '2024-09-20'),
(75, 5, 3, 8, '2024-09-20'),
(76, 6, 4, 8, '2024-09-20'),
(77, 7, 5, 8, '2024-09-20'),
(78, 9, 6, 8, '2024-09-20'),
(79, 10, 7, 8, '2024-09-20'),
(80, 11, 8, 8, '2024-09-20'),
(81, 1, 9, 8, '2024-09-20'),
(82, 8, 10, 8, '2024-09-20'),
(83, 12, 11, 8, '2024-09-20'),
(84, 13, 12, 8, '2024-09-20'),
(85, 14, 13, 8, '2024-09-20'),
(86, 15, 14, 8, '2024-09-20'),
(87, 16, 15, 8, '2024-09-20'),
(88, 17, 16, 8, '2024-09-20'),
(89, 18, 17, 8, '2024-09-20'),
(90, 19, 18, 8, '2024-09-20'),
(91, 20, 19, 8, '2024-09-20'),
(92, 23, 20, 8, '2024-09-20'),
(93, 24, 21, 8, '2024-09-20'),
(94, 26, 22, 8, '2024-09-20'),
(95, 27, 23, 8, '2024-09-20'),
(96, 28, 24, 8, '2024-09-20'),
(97, 12, 1, 8, '2024-09-19'),
(98, 13, 2, 8, '2024-09-19'),
(99, 14, 3, 8, '2024-09-19'),
(100, 15, 4, 8, '2024-09-19'),
(101, 16, 5, 8, '2024-09-19'),
(102, 17, 6, 8, '2024-09-19'),
(103, 18, 7, 8, '2024-09-19'),
(104, 19, 8, 8, '2024-09-19'),
(105, 2, 9, 8, '2024-09-19'),
(106, 3, 10, 8, '2024-09-19'),
(107, 5, 11, 8, '2024-09-19'),
(108, 6, 12, 8, '2024-09-19'),
(109, 7, 13, 8, '2024-09-19'),
(110, 1, 14, 8, '2024-09-19'),
(111, 8, 15, 8, '2024-09-19'),
(112, 9, 16, 8, '2024-09-19'),
(113, 10, 17, 8, '2024-09-19'),
(114, 11, 18, 8, '2024-09-19'),
(115, 23, 19, 8, '2024-09-19'),
(116, 20, 20, 8, '2024-09-19'),
(117, 24, 21, 8, '2024-09-19'),
(118, 26, 22, 8, '2024-09-19'),
(119, 27, 23, 8, '2024-09-19'),
(120, 28, 24, 8, '2024-09-19'),
(121, 20, 1, 8, '2024-09-18'),
(122, 23, 2, 8, '2024-09-18'),
(123, 24, 3, 8, '2024-09-18'),
(124, 26, 4, 8, '2024-09-18'),
(125, 27, 5, 8, '2024-09-18'),
(126, 28, 6, 8, '2024-09-18'),
(127, 1, 7, 8, '2024-09-18'),
(128, 2, 8, 8, '2024-09-18'),
(129, 9, 9, 8, '2024-09-18'),
(130, 10, 10, 8, '2024-09-18'),
(131, 11, 11, 8, '2024-09-18'),
(132, 15, 12, 8, '2024-09-18'),
(133, 16, 13, 8, '2024-09-18'),
(134, 3, 14, 8, '2024-09-18'),
(135, 5, 15, 8, '2024-09-18'),
(136, 6, 16, 8, '2024-09-18'),
(137, 7, 17, 8, '2024-09-18'),
(138, 12, 18, 8, '2024-09-18'),
(139, 13, 19, 8, '2024-09-18'),
(140, 8, 20, 8, '2024-09-18'),
(141, 14, 21, 8, '2024-09-18'),
(142, 17, 22, 8, '2024-09-18'),
(143, 18, 23, 8, '2024-09-18'),
(144, 19, 24, 8, '2024-09-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctn_area_mesero`
--

CREATE TABLE `ctn_area_mesero` (
  `id` int NOT NULL,
  `mesero_id` int NOT NULL,
  `area_id` int NOT NULL,
  `contador` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ctn_area_mesero`
--

INSERT INTO `ctn_area_mesero` (`id`, `mesero_id`, `area_id`, `contador`) VALUES
(1, 24, 1, 2),
(2, 1, 1, 3),
(3, 2, 1, 3),
(4, 3, 1, 2),
(5, 5, 1, 2),
(6, 6, 1, 2),
(7, 7, 1, 2),
(8, 8, 1, 2),
(9, 9, 1, 2),
(10, 10, 1, 2),
(11, 11, 1, 2),
(12, 12, 1, 2),
(13, 13, 1, 2),
(14, 14, 1, 2),
(15, 15, 1, 2),
(16, 16, 1, 2),
(17, 17, 1, 2),
(18, 18, 1, 2),
(19, 19, 1, 2),
(20, 20, 1, 2),
(21, 23, 1, 2),
(22, 26, 1, 2),
(23, 27, 1, 2),
(24, 1, 2, 2),
(25, 2, 2, 2),
(26, 3, 2, 2),
(27, 5, 2, 2),
(28, 6, 2, 2),
(29, 7, 2, 2),
(30, 8, 2, 2),
(31, 9, 2, 2),
(32, 10, 2, 2),
(33, 11, 2, 2),
(34, 12, 2, 2),
(35, 13, 2, 2),
(36, 14, 2, 2),
(37, 15, 2, 2),
(38, 16, 2, 2),
(39, 17, 2, 1),
(40, 18, 2, 1),
(41, 19, 2, 1),
(42, 20, 2, 1),
(43, 23, 2, 1),
(44, 24, 2, 1),
(45, 26, 2, 1),
(46, 27, 2, 1),
(47, 1, 3, 2),
(48, 2, 3, 1),
(49, 3, 3, 2),
(50, 5, 3, 2),
(51, 6, 3, 2),
(52, 7, 3, 2),
(53, 8, 3, 2),
(54, 9, 3, 2),
(55, 10, 3, 2),
(56, 11, 3, 2),
(57, 12, 3, 2),
(58, 13, 3, 2),
(59, 14, 3, 1),
(60, 15, 3, 2),
(61, 16, 3, 2),
(62, 17, 3, 2),
(63, 18, 3, 2),
(64, 19, 3, 2),
(65, 20, 3, 2),
(66, 23, 3, 2),
(67, 24, 3, 1),
(68, 26, 3, 1),
(69, 27, 3, 1),
(70, 1, 4, 1),
(71, 2, 4, 1),
(72, 3, 4, 1),
(73, 5, 4, 1),
(74, 6, 4, 1),
(75, 7, 4, 1),
(76, 8, 4, 2),
(77, 9, 4, 1),
(78, 10, 4, 1),
(79, 11, 4, 1),
(80, 12, 4, 1),
(81, 13, 4, 1),
(82, 14, 4, 2),
(83, 15, 4, 1),
(84, 16, 4, 1),
(85, 17, 4, 2),
(86, 18, 4, 2),
(87, 19, 4, 2),
(88, 20, 4, 2),
(89, 23, 4, 2),
(90, 24, 4, 3),
(91, 26, 4, 3),
(92, 27, 4, 3),
(93, 28, 1, 2),
(94, 28, 2, 1),
(95, 28, 3, 1),
(96, 28, 4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estaciones`
--

CREATE TABLE `estaciones` (
  `id` int NOT NULL,
  `descripcion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `color` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `estaciones`
--

INSERT INTO `estaciones` (`id`, `descripcion`, `color`) VALUES
(1, 'E1', '#FF5733'),
(2, 'E2', '#33FF57'),
(3, 'E3', '#3357FF'),
(4, 'E4', '#FF33A1'),
(5, 'E5', '#33FFF3'),
(6, 'E6', '#FFD700'),
(7, 'E7', '#C0C0C0'),
(8, 'E8', '#FF4500'),
(9, 'E9', '#008080'),
(10, 'E10', '#800080'),
(11, 'E11', '#FF6347'),
(12, 'E12', '#4682B4'),
(13, 'E13', '#D2691E'),
(14, 'E14', '#808000'),
(15, 'E15', '#FF1493'),
(16, 'E16', '#FF7F50'),
(17, 'E17', '#6A5ACD'),
(18, 'E18', '#B22222'),
(19, 'E19', '#7FFF00'),
(20, 'E20', '#8B008B'),
(21, 'E21', '#20B2AA'),
(22, 'E22', '#F4A460'),
(23, 'E23', '#008B8B'),
(24, 'E24', '#DC143C'),
(25, 'E25', '#00CED1'),
(26, 'E26', '#FFDAB9'),
(27, 'E27', '#800000'),
(28, 'E28', '#556B2F'),
(29, 'E29', '#4B0082'),
(30, 'E30', '#FFFAF0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `area_id` int DEFAULT NULL,
  `n_personas` int NOT NULL,
  `estado` int NOT NULL DEFAULT '0' COMMENT '0 = disponible,\r\n1 = Ocupada,\r\n2 = Reservada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id`, `nombre`, `area_id`, `n_personas`, `estado`) VALUES
(1, '01', 1, 4, 0),
(2, '02', 1, 4, 0),
(3, '03', 1, 4, 0),
(4, '10', 1, 4, 0),
(5, '100', 3, 4, 0),
(6, '04', 1, 4, 0),
(7, '05', 1, 4, 0),
(8, '06', 1, 4, 0),
(9, '07', 1, 4, 1),
(10, '08', 1, 4, 0),
(11, '11', 1, 4, 0),
(12, '12', 1, 4, 0),
(13, '13', 1, 8, 0),
(14, '14', 1, 5, 0),
(15, '15', 1, 4, 0),
(16, '16', 1, 4, 0),
(17, '17', 1, 4, 0),
(18, '20', 1, 4, 0),
(19, '21', 1, 5, 1),
(20, '22', 1, 8, 0),
(21, '23', 1, 8, 0),
(22, '24', 1, 5, 0),
(23, '25', 1, 8, 0),
(24, '30', 1, 8, 0),
(25, '31', 1, 8, 1),
(26, '32', 1, 4, 0),
(27, '33', 1, 5, 0),
(28, '34', 1, 8, 0),
(29, '35', 1, 4, 0),
(30, '50', 2, 6, 1),
(31, '51', 2, 4, 0),
(32, '52', 2, 4, 0),
(33, '53', 2, 4, 1),
(34, '54', 2, 4, 0),
(35, '55', 2, 5, 0),
(36, '60', 2, 6, 0),
(37, '61', 2, 4, 0),
(38, '62', 2, 6, 0),
(39, '70', 2, 4, 0),
(40, '71', 2, 4, 0),
(41, '72', 2, 5, 0),
(42, '80', 2, 4, 0),
(43, '81', 2, 4, 0),
(44, '82', 2, 6, 0),
(45, '83', 2, 6, 0),
(46, 'fish', 2, 16, 0),
(47, 'octopus', 2, 12, 0),
(48, '101', 3, 6, 1),
(49, '102', 3, 4, 1),
(50, '103', 3, 8, 0),
(51, '110', 3, 4, 0),
(52, '111', 3, 5, 0),
(53, '112', 3, 4, 0),
(54, '120', 3, 4, 0),
(55, '121', 3, 6, 0),
(56, '122', 3, 4, 0),
(57, '123', 3, 6, 0),
(58, '130', 3, 6, 0),
(59, '131', 3, 6, 1),
(60, '132', 3, 4, 0),
(61, '140', 3, 6, 0),
(62, '141', 3, 6, 0),
(63, '142', 3, 4, 0),
(64, '150', 3, 5, 0),
(65, '151', 3, 4, 0),
(66, '160', 4, 8, 0),
(67, '161', 4, 8, 0),
(68, '162', 4, 8, 1),
(69, '170', 4, 4, 0),
(70, '171', 4, 4, 0),
(71, '172', 4, 4, 1),
(72, '173', 4, 4, 0),
(73, '174', 4, 4, 0),
(74, '180', 4, 8, 0),
(75, '181', 4, 5, 1),
(76, '182', 4, 4, 0),
(77, '183', 4, 4, 1),
(78, '184', 4, 5, 0),
(79, '190', 4, 8, 0),
(80, '191', 4, 8, 0),
(81, '192', 4, 8, 0),
(82, '193', 4, 8, 0),
(83, '194', 4, 8, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa_cliente`
--

CREATE TABLE `mesa_cliente` (
  `id` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `zonas_deseadas` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `telefono` bigint DEFAULT NULL,
  `n_adultos` int NOT NULL,
  `n_ninos` int NOT NULL,
  `hora_llegada` time DEFAULT NULL,
  `hora_salida` time DEFAULT NULL COMMENT 'Hora de salida de mesa',
  `mesa_id` int DEFAULT NULL COMMENT 'id se asigna cuando se asigna mesa',
  `fecha` date NOT NULL,
  `estado` int NOT NULL DEFAULT '0' COMMENT '0 = Espera,\r\n1 = Reserva,\r\n2 = Con mesa,\r\n3 = Atendido.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `mesa_cliente`
--

INSERT INTO `mesa_cliente` (`id`, `nombre`, `zonas_deseadas`, `telefono`, `n_adultos`, `n_ninos`, `hora_llegada`, `hora_salida`, `mesa_id`, `fecha`, `estado`) VALUES
(1, 'juan', '1,4', NULL, 2, 3, '13:30:00', '01:24:49', 27, '2024-07-05', 3),
(2, 'Pedro', '2,3', 3322115566, 3, 0, '14:16:50', NULL, 49, '2024-07-05', 2),
(3, 'Lopez', '3', NULL, 2, 3, '14:25:00', NULL, 75, '2024-07-05', 2),
(4, 'Diego', '1', NULL, 2, 3, '15:00:00', '01:24:34', 23, '2024-07-05', 3),
(5, 'javier', '2,4', NULL, 8, 2, '15:12:00', '01:40:15', 47, '2024-07-05', 3),
(6, 'lopez', '1,4', NULL, 2, 4, '15:20:00', NULL, 25, '2024-07-05', 2),
(7, 'Martin', '2,3', NULL, 4, 0, '15:25:00', NULL, 48, '2024-07-05', 2),
(8, 'Alfredo', '1', NULL, 2, 1, '15:33:00', NULL, 1, '2024-07-05', 3),
(9, 'Joaquin', '3', NULL, 4, 0, '15:41:00', '01:01:04', 69, '2024-07-05', 3),
(10, 'Carlos', '2', NULL, 2, 0, '20:07:46', '01:20:56', 5, '2024-07-30', 3),
(11, 'Fernando Reyes', '4', 3311799528, 1, 0, '18:14:00', NULL, NULL, '2024-07-05', 1),
(12, 'Miguel', '1,2,3,4', 0, 2, 2, '18:09:57', '20:34:29', 2, '2024-07-31', 3),
(13, 'Daniel', '1,3', 0, 2, 0, '19:10:00', '01:22:41', 3, '2024-07-31', 3),
(14, 'xxx', '1,2', 0, 1, 2, '08:16:06', '00:12:24', 7, '2024-08-03', 3),
(15, 'Gael', '3', 0, 2, 0, '18:26:12', '01:37:47', 71, '2024-07-05', 3),
(16, 'valentin', '4', 0, 2, 0, '18:49:39', NULL, 30, '2024-07-05', 2),
(20, 'Casemiro', '2', 0, 1, 1, '19:29:40', '01:42:37', 54, '2024-07-05', 3),
(21, 'Luis', '4', 0, 1, 1, '20:11:57', '01:25:42', 33, '2024-07-05', 3),
(22, 'Cristiano', '3', 0, 2, 6, '01:29:53', NULL, 68, '2024-07-05', 2),
(23, 'Messi', '1', 0, 3, 2, '01:30:07', NULL, 19, '2024-07-05', 2),
(24, 'Rodrygo', '2,4', 0, 6, 0, '01:30:36', NULL, 59, '2024-07-05', 2),
(25, 'Lic Mendoza', '4', 0, 3, 0, '16:04:09', NULL, 33, '2024-07-05', 2),
(26, 'mesa docker', '1,2,3,4', NULL, 1, 1, '23:35:22', NULL, 71, '2024-09-10', 2),
(27, 'mesa docker', '1,2,3,4', NULL, 1, 1, '23:35:51', NULL, 9, '2024-09-10', 2),
(40, 'Celular', '1,2,3,4', NULL, 2, 1, '21:43:46', NULL, 77, '2024-09-12', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `descanso` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `turno` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `estado` int NOT NULL DEFAULT '1' COMMENT '0: inactivo, 1: activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id`, `nombre`, `apellido`, `descanso`, `turno`, `estado`) VALUES
(1, 'Alfredo', 'Cruz', 'fines', '1', 1),
(2, 'Diego ', 'Antuna', '3', '1', 1),
(3, 'Leonardo', 'Morales', '1', '2', 1),
(4, 'Lenin', 'Contreras', '4', '2', 0),
(5, 'Bryan', 'Amezcua', '4', '1', 1),
(6, 'Jonatan', 'López', '2', '2', 1),
(7, 'Carlos', 'Hernandez', '4', '1', 1),
(8, 'Luis', 'Torres', '3', '1', 1),
(9, 'Marco', 'Hernandez', 'fines', '1', 1),
(10, 'Joahan', 'Reyes', '1', '2', 1),
(11, 'Francisco', 'Tapia', '1', '1', 1),
(12, 'Oliver', 'Perez', '1', '2', 1),
(13, 'Uriel', 'Rosales', '1', '2', 1),
(14, 'Michell', 'Reyes', '2', '1', 1),
(15, 'Jonany', 'Mejia', '2', '1', 1),
(16, 'Hector', 'Hernandez', '2', '2', 1),
(17, 'Edgar', 'Nuño', '3', '1', 1),
(18, 'Eder', 'Contreras', '3', '2', 1),
(19, 'Jose', 'Velez', '3', '2', 1),
(20, 'Heriberto', 'Valadez', '4', '1', 1),
(23, 'David', 'Hernandez', '2', '2', 1),
(24, 'Ricardo', 'Lozano', '3', '2', 1),
(25, 'Ulises', 'Rodriguez', '4', '1', 0),
(26, 'Manuel', 'Flores', '4', '1', 1),
(27, 'Hugo', ' Acuña', '2', '2', 1),
(28, 'Alexis', 'De Anda', '1', '2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_bloqueado`
--

CREATE TABLE `personal_bloqueado` (
  `id` int NOT NULL,
  `personal_id` int NOT NULL,
  `fecha_inicio` date NOT NULL COMMENT 'Fecha de inicio de bloqueo',
  `fecha_fin` date NOT NULL COMMENT 'fecha fin de bloqueo',
  `motivo` varchar(150) NOT NULL,
  `vigencia` int NOT NULL DEFAULT '0' COMMENT '0: vigente, 1: vencido'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `personal_bloqueado`
--

INSERT INTO `personal_bloqueado` (`id`, `personal_id`, `fecha_inicio`, `fecha_fin`, `motivo`, `vigencia`) VALUES
(1, 4, '2024-07-05', '2024-07-06', 'No asistio', 1),
(2, 4, '2024-07-05', '2024-07-06', 'No asistio', 1),
(3, 4, '2024-07-05', '2024-07-06', 'No asistio', 1),
(4, 5, '2024-07-05', '2024-07-06', 'No asistio', 1),
(5, 10, '2024-07-05', '2024-07-06', 'No asistio', 1),
(6, 7, '2024-07-05', '2024-07-06', 'No asistio', 1),
(7, 13, '2024-07-05', '2024-07-06', 'No asistio', 1),
(8, 4, '2024-07-05', '2024-07-06', 'No asistio', 1),
(9, 18, '2024-07-05', '2024-07-06', 'No asistio', 1),
(10, 7, '2024-07-05', '2024-07-06', 'No asistio', 1),
(11, 1, '2024-07-05', '2024-07-06', 'No asistio', 1),
(12, 1, '2024-07-05', '2024-07-06', 'No asistio', 1),
(13, 19, '2024-07-05', '2024-07-06', 'No asistio', 1),
(14, 14, '2024-07-05', '2024-07-06', 'No asistio', 1),
(15, 1, '2024-07-05', '2024-07-06', 'No asistio', 1),
(16, 10, '2024-07-05', '2024-07-06', 'No asistio', 1),
(17, 1, '2024-07-05', '2024-07-06', 'No asistio', 1),
(18, 8, '2024-07-05', '2024-07-06', 'No asistio', 1),
(19, 1, '2024-07-05', '2024-07-06', 'No asistio', 1),
(20, 7, '2024-07-05', '2024-07-06', 'No asistio', 1),
(21, 2, '2024-07-05', '2024-07-06', 'No asistio', 1),
(23, 14, '2024-08-13', '2024-08-21', 'Vacaciones', 1),
(24, 7, '2024-08-13', '2024-08-17', 'Vacaciones', 1),
(25, 20, '2024-07-05', '2024-07-06', 'No asistio', 1),
(26, 3, '2024-08-01', '2024-11-01', 'Cambio de sucursal', 1),
(27, 25, '2024-08-01', '2024-11-01', 'Cambio de sucursal', 0),
(28, 4, '2024-08-01', '2024-11-01', 'Cambio de sucursal', 0),
(29, 2, '2024-09-20', '2024-09-21', 'No asistio', 1),
(30, 18, '2024-09-19', '2024-09-20', 'No asistio', 1),
(31, 8, '2024-09-19', '2024-09-20', 'No asistio', 1),
(32, 1, '2024-09-21', '2024-09-22', 'No asistio', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `descripcion`) VALUES
(1, '23'),
(2, '21'),
(3, '17'),
(5, '22'),
(6, '16'),
(7, '15'),
(8, '24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas_preapertura`
--

CREATE TABLE `tareas_preapertura` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tareas_preapertura`
--

INSERT INTO `tareas_preapertura` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Montar Salon', 'Barrer, trapear, limpiar todo el salon.'),
(2, 'Montar Terraza 1', 'Barrer, trapear, limpiar todo la terraza.'),
(3, 'Montar Terraza 2', 'Barrer, trapear, limpiar todo la terraza.'),
(4, 'Montar Mezzanin', 'Barrer, trapear, limpiar todo la Mezzanin.'),
(5, 'Limpiar TV', 'Limpiar Televisiones.'),
(6, 'Salsas', 'Colocar salsas en stenes, limpiar ketchups y rellenar muebles pll.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea_mesero`
--

CREATE TABLE `tarea_mesero` (
  `id` int NOT NULL,
  `mesero_id` int NOT NULL,
  `tarea_pre_id` int NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `usuario` varchar(200) NOT NULL COMMENT 'Nombre de usuario',
  `password` varchar(200) NOT NULL COMMENT 'Contraseña',
  `md5` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Contraseña mdh5',
  `tipo_usuario` int NOT NULL COMMENT '1-admin, 2-capitan, 3-usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `md5`, `tipo_usuario`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'capitan', 'capitan', 'a85c04ef417c53019e3f59d459178af6', 2),
(3, 'usuario', 'usuario', 'f8032d5cae3de20fcec887f395ec9a6a', 3);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_mesas_color`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_mesas_color` (
`color` varchar(10)
,`rol` int
,`id` int
,`nombre` varchar(50)
,`area_id` int
,`n_personas` int
,`estado` int
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_mesas_estaciones`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_mesas_estaciones` (
`rol` int
,`rol_descripcion` text
,`area_id` int
,`estacion` varchar(50)
,`mesas` text
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_mesas_color`
--
DROP TABLE IF EXISTS `vista_mesas_color`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `vista_mesas_color`  AS SELECT `estaciones`.`color` AS `color`, `roles`.`id` AS `rol`, `mesas`.`id` AS `id`, `mesas`.`nombre` AS `nombre`, `mesas`.`area_id` AS `area_id`, `mesas`.`n_personas` AS `n_personas`, `mesas`.`estado` AS `estado` FROM (((`asignacion_mesas` join `mesas` on((`asignacion_mesas`.`mesa_id` = `mesas`.`id`))) join `estaciones` on((`asignacion_mesas`.`estacion_id` = `estaciones`.`id`))) join `roles` on((`asignacion_mesas`.`rol_id` = `roles`.`id`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_mesas_estaciones`
--
DROP TABLE IF EXISTS `vista_mesas_estaciones`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `vista_mesas_estaciones`  AS SELECT `roles`.`id` AS `rol`, `roles`.`descripcion` AS `rol_descripcion`, `mesas`.`area_id` AS `area_id`, `estaciones`.`descripcion` AS `estacion`, group_concat(`mesas`.`nombre` order by `mesas`.`nombre` ASC separator ', ') AS `mesas` FROM (((`asignacion_mesas` join `mesas` on((`asignacion_mesas`.`mesa_id` = `mesas`.`id`))) join `estaciones` on((`asignacion_mesas`.`estacion_id` = `estaciones`.`id`))) join `roles` on((`asignacion_mesas`.`rol_id` = `roles`.`id`))) GROUP BY `roles`.`id`, `mesas`.`area_id`, `estaciones`.`descripcion` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asignacion_mesas`
--
ALTER TABLE `asignacion_mesas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estacion_id` (`estacion_id`),
  ADD KEY `rol_id` (`rol_id`),
  ADD KEY `asignacion_mesas_ibfk_1` (`mesa_id`);

--
-- Indices de la tabla `asignacion_meseros`
--
ALTER TABLE `asignacion_meseros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mesero_id` (`mesero_id`),
  ADD KEY `estacion_id` (`estacion_id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indices de la tabla `ctn_area_mesero`
--
ALTER TABLE `ctn_area_mesero`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mesero_id` (`mesero_id`),
  ADD KEY `fk_area_id` (`area_id`);

--
-- Indices de la tabla `estaciones`
--
ALTER TABLE `estaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `area_id` (`area_id`);

--
-- Indices de la tabla `mesa_cliente`
--
ALTER TABLE `mesa_cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mesa_id` (`mesa_id`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal_bloqueado`
--
ALTER TABLE `personal_bloqueado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personal_id` (`personal_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tareas_preapertura`
--
ALTER TABLE `tareas_preapertura`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tarea_mesero`
--
ALTER TABLE `tarea_mesero`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mesero_id` (`mesero_id`),
  ADD KEY `tarea_pre_id` (`tarea_pre_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `asignacion_mesas`
--
ALTER TABLE `asignacion_mesas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=835;

--
-- AUTO_INCREMENT de la tabla `asignacion_meseros`
--
ALTER TABLE `asignacion_meseros`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT de la tabla `ctn_area_mesero`
--
ALTER TABLE `ctn_area_mesero`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de la tabla `estaciones`
--
ALTER TABLE `estaciones`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de la tabla `mesa_cliente`
--
ALTER TABLE `mesa_cliente`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `personal_bloqueado`
--
ALTER TABLE `personal_bloqueado`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tareas_preapertura`
--
ALTER TABLE `tareas_preapertura`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tarea_mesero`
--
ALTER TABLE `tarea_mesero`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignacion_mesas`
--
ALTER TABLE `asignacion_mesas`
  ADD CONSTRAINT `asignacion_mesas_ibfk_1` FOREIGN KEY (`mesa_id`) REFERENCES `mesas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asignacion_mesas_ibfk_2` FOREIGN KEY (`estacion_id`) REFERENCES `estaciones` (`id`),
  ADD CONSTRAINT `asignacion_mesas_ibfk_3` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);

--
-- Filtros para la tabla `asignacion_meseros`
--
ALTER TABLE `asignacion_meseros`
  ADD CONSTRAINT `asignacion_meseros_ibfk_1` FOREIGN KEY (`mesero_id`) REFERENCES `personal` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asignacion_meseros_ibfk_2` FOREIGN KEY (`estacion_id`) REFERENCES `estaciones` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asignacion_meseros_ibfk_3` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ctn_area_mesero`
--
ALTER TABLE `ctn_area_mesero`
  ADD CONSTRAINT `fk_area_id` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_mesero_id` FOREIGN KEY (`mesero_id`) REFERENCES `personal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD CONSTRAINT `mesas_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa_cliente`
--
ALTER TABLE `mesa_cliente`
  ADD CONSTRAINT `mesa_cliente_ibfk_1` FOREIGN KEY (`mesa_id`) REFERENCES `mesas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `personal_bloqueado`
--
ALTER TABLE `personal_bloqueado`
  ADD CONSTRAINT `personal_bloqueado_ibfk_1` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `tarea_mesero`
--
ALTER TABLE `tarea_mesero`
  ADD CONSTRAINT `tarea_mesero_ibfk_1` FOREIGN KEY (`mesero_id`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `tarea_mesero_ibfk_2` FOREIGN KEY (`tarea_pre_id`) REFERENCES `tareas_preapertura` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
