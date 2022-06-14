-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-06-2022 a las 11:19:23
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdaulaweb`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `aulasReservadas` (IN `aulaRes` VARCHAR(5), IN `fechaRes` DATE, IN `horaDesdeRes` TIME, IN `horaHastaRes` TIME)   BEGIN
SELECT COUNT(*) FROM reservas WHERE (aula = aulaRes AND fecha = fechaRes) AND ((horaDesdeRes = horaDesde AND horaHastaRes = horaHasta) OR (horaDesdeRes < horaDesde AND horaHastaRes > horaHasta) OR (horaDesdeRes > horaDesde AND horaHastaRes < horaHasta) OR ((horaDesdeRes > horaDesde AND horaDesdeRes < horaHasta) AND (horaHastaRes >= horaHasta OR horaHastaRes <= horaHasta)) OR ((horaDesdeRes <= horaDesde) AND (horaHastaRes > horaDesde AND horaHastaRes < horaHasta)) OR (horaDesdeRes < horaDesde AND horaHastaRes > horaHasta));
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `comprobarSesion` (IN `nombreUsuario` VARCHAR(14), IN `contraseñaUsuario` VARCHAR(50))   BEGIN
SELECT * FROM sesiones WHERE usuario = nombreUsuario AND contraseña = contraseñaUsuario;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aula`
--

CREATE TABLE `aula` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `abreviatura` varchar(40) DEFAULT NULL,
  `descripcion` varchar(40) DEFAULT NULL,
  `dedicada` varchar(40) DEFAULT NULL,
  `plantilla` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `aula`
--

INSERT INTO `aula` (`id`, `nombre`, `abreviatura`, `descripcion`, `dedicada`, `plantilla`) VALUES
(1, 'A01', 'A01', 'FOL MULTIMEDIA', 'true', '\n			'),
(2, 'A02', 'A02', 'AULA ATEKA', 'true', '\n			'),
(3, 'A04', 'A04', 'FOL POLIVALENTE', 'true', '\n			'),
(4, 'A07', 'A07', 'INGLES POLIVALENTE', 'true', '\n			'),
(5, 'A08', 'A08', 'AULA KIMUA', 'false', '\n			'),
(6, 'A09', 'A09', 'OLH -2', 'false', '\n			'),
(7, 'A10', 'A10', 'AULA OFICINA (SIMULADA)', 'true', '\n			'),
(8, 'A11', 'A11', 'OLH-1', 'false', '\n			'),
(9, 'A12', 'A12', 'VDJ', 'true', '\n			'),
(10, 'A13', 'A13', 'VDJ', 'true', '\n			'),
(11, 'A14', 'A14', 'TALLER ADMINISTRATIVO DOBLE', 'true', '\n			'),
(12, 'A15', 'A15', 'TALLER ADMINISTRATIVO', 'true', '\n			'),
(13, 'A16', 'A16', 'MECANOGRAFIA', 'true', '\n			'),
(14, 'A17', 'A17', 'TALLER ADMINISTRATIVO', 'true', '\n			'),
(15, 'A18', 'A18', 'POLIVALENTE ADMINISTRATIVO', 'true', '\n			'),
(16, 'A19', 'A19', 'TALLER ADMINISTRATIVO ORD', 'true', '\n			'),
(17, 'A20', 'A20', 'POLIVALENTE ADMINISTRATIVO', 'false', '\n			'),
(18, 'A21', 'A21', 'POLIVALENTE ADMINISTRATIVO', 'true', '\n			'),
(19, 'A22', 'A22', 'POLIVALENTE ADMINISTRATIVO', 'false', '\n			'),
(20, 'B23', 'B23', 'AUTOMOCION ORDENADORES', 'true', '\n			'),
(21, 'B24', 'B24', 'LAB ENSAYOS Fï¿½SICOS-PLï¿½STICOS', 'true', '\n			'),
(22, 'B25', 'B25', 'INSTALACIONES ELECTRICAS', 'true', '\n			'),
(23, 'B26', 'B26', 'DESARROLLO DE PRODUCTOS ELECTRONICOS', 'true', '\n			'),
(24, 'B27', 'B27', 'FOOL INFORMATICA', 'true', '\n			'),
(25, 'B28', 'B28', 'QUIMICA ORDENADORES', 'true', '\n			'),
(26, 'B29', 'B29', 'QUIMICA POLIVALENTE', 'true', '\n			'),
(27, 'B30', 'B30', 'LABORATORIO QUMICA GENERAL-FARMA', 'true', '\n			'),
(28, 'B31', 'B31', 'LABORATORIO MICROBIOLOGIA', 'true', '\n			'),
(29, 'B32', 'B32', 'LABORATORIO QUIMICA INSTRUMENTAL', 'true', '\n			'),
(30, 'B33', 'B33', 'LABORATORIO QUIMICA GENERAL', 'true', '\n			'),
(31, 'B34', 'B34', 'SISTEMAS TELECOMUNICACION-TELEMï¿½TICA', 'true', '\n			'),
(32, 'B35', 'B35', 'INFORMï¿½TICA DE SISTEMAS', 'true', '\n			'),
(33, 'B36', 'B36', 'SISTEMAS DE RADIO Y TELEVISION', 'true', '\n			'),
(34, 'B37', 'B37', 'ARQUITECTURA DE ORDENADORES Y TELEFONï¿½', 'true', '\n			'),
(35, 'B38', 'B38', 'EQUIPOS ELECTRONICOS DE CONSUMO-CURSO 2ï', 'true', '\n			'),
(36, 'B39', 'B39', 'EQUIPOS ELECTRONICOS DE CONSUMO CURSO 1ï', 'true', '\n			'),
(37, 'C01', 'C01', 'AUTOMOCION-T1', 'true', '\n			'),
(38, 'C02', 'C02', 'AUTOMOCION T2-T3', 'true', '\n			'),
(39, 'C03', 'C03', 'AUTOMOCION- POLIVALENTE', 'false', '\n			'),
(40, 'C04', 'C04', 'AUTOMOCIï¿½N T4 T5', 'true', '\n			'),
(41, 'C06', 'C06', 'AUTOMOCION T6', 'true', '\n			'),
(42, 'C08', 'C08', 'AUTOMOCIï¿½N-T8', 'true', '\n			'),
(43, 'C40', 'C40', 'OPERACIONES DE PROCESO DE PLANTA QUï¿½MI', 'true', '\n			'),
(44, 'Online', 'Online', 'Aula Online', 'true', '\n			'),
(45, 'T01', 'T01', 'TALLER 1 AUTOMOCIï¿½N', 'true', '\n			'),
(46, 'T02', 'T02', 'TALLER 2 AUTOMOCIï¿½N', 'true', '\n			'),
(47, 'T03', 'T03', 'TALLER DE AUTOMOCIï¿½N', 'true', '\n			'),
(48, 'T04', 'T04', 'TALLER 4 AUTOMOCIï¿½N', 'true', '\n			'),
(49, 'T05', 'T05', 'TALLER 5 AUTOMOCIï¿½N', 'true', '\n			'),
(50, 'T06', 'T06', 'TALLER 6 AUTOMOCION', 'true', '\n			'),
(51, 'T07', 'T07', 'TALLER 7 AUTOMOCION', 'true', '\n			'),
(52, 'T08', 'T08', 'TALLER 8 AUTOMOCION', 'true', '\n			'),
(53, 'TS1', 'TS1', 'TALLER VDJ 1', 'true', '\n			'),
(54, 'TS2', 'TS2', 'TALLER VDJ 2', 'true', '\n			'),
(55, 'A01', 'A01', 'FOL MULTIMEDIA', 'true', '\n			'),
(56, 'A02', 'A02', 'AULA ATEKA', 'true', '\n			'),
(57, 'A04', 'A04', 'FOL POLIVALENTE', 'true', '\n			'),
(58, 'A07', 'A07', 'INGLES POLIVALENTE', 'true', '\n			'),
(59, 'A08', 'A08', 'AULA KIMUA', 'false', '\n			'),
(60, 'A09', 'A09', 'OLH -2', 'false', '\n			'),
(61, 'A10', 'A10', 'AULA OFICINA (SIMULADA)', 'true', '\n			'),
(62, 'A11', 'A11', 'OLH-1', 'false', '\n			'),
(63, 'A12', 'A12', 'VDJ', 'true', '\n			'),
(64, 'A13', 'A13', 'VDJ', 'true', '\n			'),
(65, 'A14', 'A14', 'TALLER ADMINISTRATIVO DOBLE', 'true', '\n			'),
(66, 'A15', 'A15', 'TALLER ADMINISTRATIVO', 'true', '\n			'),
(67, 'A16', 'A16', 'MECANOGRAFIA', 'true', '\n			'),
(68, 'A17', 'A17', 'TALLER ADMINISTRATIVO', 'true', '\n			'),
(69, 'A18', 'A18', 'POLIVALENTE ADMINISTRATIVO', 'true', '\n			'),
(70, 'A19', 'A19', 'TALLER ADMINISTRATIVO ORD', 'true', '\n			'),
(71, 'A20', 'A20', 'POLIVALENTE ADMINISTRATIVO', 'false', '\n			'),
(72, 'A21', 'A21', 'POLIVALENTE ADMINISTRATIVO', 'true', '\n			'),
(73, 'A22', 'A22', 'POLIVALENTE ADMINISTRATIVO', 'false', '\n			'),
(74, 'B23', 'B23', 'AUTOMOCION ORDENADORES', 'true', '\n			'),
(75, 'B24', 'B24', 'LAB ENSAYOS Fï¿½SICOS-PLï¿½STICOS', 'true', '\n			'),
(76, 'B25', 'B25', 'INSTALACIONES ELECTRICAS', 'true', '\n			'),
(77, 'B26', 'B26', 'DESARROLLO DE PRODUCTOS ELECTRONICOS', 'true', '\n			'),
(78, 'B27', 'B27', 'FOOL INFORMATICA', 'true', '\n			'),
(79, 'B28', 'B28', 'QUIMICA ORDENADORES', 'true', '\n			'),
(80, 'B29', 'B29', 'QUIMICA POLIVALENTE', 'true', '\n			'),
(81, 'B30', 'B30', 'LABORATORIO QUMICA GENERAL-FARMA', 'true', '\n			'),
(82, 'B31', 'B31', 'LABORATORIO MICROBIOLOGIA', 'true', '\n			'),
(83, 'B32', 'B32', 'LABORATORIO QUIMICA INSTRUMENTAL', 'true', '\n			'),
(84, 'B33', 'B33', 'LABORATORIO QUIMICA GENERAL', 'true', '\n			'),
(85, 'B34', 'B34', 'SISTEMAS TELECOMUNICACION-TELEMï¿½TICA', 'true', '\n			'),
(86, 'B35', 'B35', 'INFORMï¿½TICA DE SISTEMAS', 'true', '\n			'),
(87, 'B36', 'B36', 'SISTEMAS DE RADIO Y TELEVISION', 'true', '\n			'),
(88, 'B37', 'B37', 'ARQUITECTURA DE ORDENADORES Y TELEFONï¿½', 'true', '\n			'),
(89, 'B38', 'B38', 'EQUIPOS ELECTRONICOS DE CONSUMO-CURSO 2ï', 'true', '\n			'),
(90, 'B39', 'B39', 'EQUIPOS ELECTRONICOS DE CONSUMO CURSO 1ï', 'true', '\n			'),
(91, 'C01', 'C01', 'AUTOMOCION-T1', 'true', '\n			'),
(92, 'C02', 'C02', 'AUTOMOCION T2-T3', 'true', '\n			'),
(93, 'C03', 'C03', 'AUTOMOCION- POLIVALENTE', 'false', '\n			'),
(94, 'C04', 'C04', 'AUTOMOCIï¿½N T4 T5', 'true', '\n			'),
(95, 'C06', 'C06', 'AUTOMOCION T6', 'true', '\n			'),
(96, 'C08', 'C08', 'AUTOMOCIï¿½N-T8', 'true', '\n			'),
(97, 'C40', 'C40', 'OPERACIONES DE PROCESO DE PLANTA QUï¿½MI', 'true', '\n			'),
(98, 'Online', 'Online', 'Aula Online', 'true', '\n			'),
(99, 'T01', 'T01', 'TALLER 1 AUTOMOCIï¿½N', 'true', '\n			'),
(100, 'T02', 'T02', 'TALLER 2 AUTOMOCIï¿½N', 'true', '\n			'),
(101, 'T03', 'T03', 'TALLER DE AUTOMOCIï¿½N', 'true', '\n			'),
(102, 'T04', 'T04', 'TALLER 4 AUTOMOCIï¿½N', 'true', '\n			'),
(103, 'T05', 'T05', 'TALLER 5 AUTOMOCIï¿½N', 'true', '\n			'),
(104, 'T06', 'T06', 'TALLER 6 AUTOMOCION', 'true', '\n			'),
(105, 'T07', 'T07', 'TALLER 7 AUTOMOCION', 'true', '\n			'),
(106, 'T08', 'T08', 'TALLER 8 AUTOMOCION', 'true', '\n			'),
(107, 'TS1', 'TS1', 'TALLER VDJ 1', 'true', '\n			'),
(108, 'TS2', 'TS2', 'TALLER VDJ 2', 'true', '\n			'),
(109, 'A01', 'A01', 'FOL MULTIMEDIA', 'true', '\n			'),
(110, 'A02', 'A02', 'AULA ATEKA', 'true', '\n			'),
(111, 'A04', 'A04', 'FOL POLIVALENTE', 'true', '\n			'),
(112, 'A07', 'A07', 'INGLES POLIVALENTE', 'true', '\n			'),
(113, 'A08', 'A08', 'AULA KIMUA', 'false', '\n			'),
(114, 'A09', 'A09', 'OLH -2', 'false', '\n			'),
(115, 'A10', 'A10', 'AULA OFICINA (SIMULADA)', 'true', '\n			'),
(116, 'A11', 'A11', 'OLH-1', 'false', '\n			'),
(117, 'A12', 'A12', 'VDJ', 'true', '\n			'),
(118, 'A13', 'A13', 'VDJ', 'true', '\n			'),
(119, 'A14', 'A14', 'TALLER ADMINISTRATIVO DOBLE', 'true', '\n			'),
(120, 'A15', 'A15', 'TALLER ADMINISTRATIVO', 'true', '\n			'),
(121, 'A16', 'A16', 'MECANOGRAFIA', 'true', '\n			'),
(122, 'A17', 'A17', 'TALLER ADMINISTRATIVO', 'true', '\n			'),
(123, 'A18', 'A18', 'POLIVALENTE ADMINISTRATIVO', 'true', '\n			'),
(124, 'A19', 'A19', 'TALLER ADMINISTRATIVO ORD', 'true', '\n			'),
(125, 'A20', 'A20', 'POLIVALENTE ADMINISTRATIVO', 'false', '\n			'),
(126, 'A21', 'A21', 'POLIVALENTE ADMINISTRATIVO', 'true', '\n			'),
(127, 'A22', 'A22', 'POLIVALENTE ADMINISTRATIVO', 'false', '\n			'),
(128, 'B23', 'B23', 'AUTOMOCION ORDENADORES', 'true', '\n			'),
(129, 'B24', 'B24', 'LAB ENSAYOS Fï¿½SICOS-PLï¿½STICOS', 'true', '\n			'),
(130, 'B25', 'B25', 'INSTALACIONES ELECTRICAS', 'true', '\n			'),
(131, 'B26', 'B26', 'DESARROLLO DE PRODUCTOS ELECTRONICOS', 'true', '\n			'),
(132, 'B27', 'B27', 'FOOL INFORMATICA', 'true', '\n			'),
(133, 'B28', 'B28', 'QUIMICA ORDENADORES', 'true', '\n			'),
(134, 'B29', 'B29', 'QUIMICA POLIVALENTE', 'true', '\n			'),
(135, 'B30', 'B30', 'LABORATORIO QUMICA GENERAL-FARMA', 'true', '\n			'),
(136, 'B31', 'B31', 'LABORATORIO MICROBIOLOGIA', 'true', '\n			'),
(137, 'B32', 'B32', 'LABORATORIO QUIMICA INSTRUMENTAL', 'true', '\n			'),
(138, 'B33', 'B33', 'LABORATORIO QUIMICA GENERAL', 'true', '\n			'),
(139, 'B34', 'B34', 'SISTEMAS TELECOMUNICACION-TELEMï¿½TICA', 'true', '\n			'),
(140, 'B35', 'B35', 'INFORMï¿½TICA DE SISTEMAS', 'true', '\n			'),
(141, 'B36', 'B36', 'SISTEMAS DE RADIO Y TELEVISION', 'true', '\n			'),
(142, 'B37', 'B37', 'ARQUITECTURA DE ORDENADORES Y TELEFONï¿½', 'true', '\n			'),
(143, 'B38', 'B38', 'EQUIPOS ELECTRONICOS DE CONSUMO-CURSO 2ï', 'true', '\n			'),
(144, 'B39', 'B39', 'EQUIPOS ELECTRONICOS DE CONSUMO CURSO 1ï', 'true', '\n			'),
(145, 'C01', 'C01', 'AUTOMOCION-T1', 'true', '\n			'),
(146, 'C02', 'C02', 'AUTOMOCION T2-T3', 'true', '\n			'),
(147, 'C03', 'C03', 'AUTOMOCION- POLIVALENTE', 'false', '\n			'),
(148, 'C04', 'C04', 'AUTOMOCIï¿½N T4 T5', 'true', '\n			'),
(149, 'C06', 'C06', 'AUTOMOCION T6', 'true', '\n			'),
(150, 'C08', 'C08', 'AUTOMOCIï¿½N-T8', 'true', '\n			'),
(151, 'C40', 'C40', 'OPERACIONES DE PROCESO DE PLANTA QUï¿½MI', 'true', '\n			'),
(152, 'Online', 'Online', 'Aula Online', 'true', '\n			'),
(153, 'T01', 'T01', 'TALLER 1 AUTOMOCIï¿½N', 'true', '\n			'),
(154, 'T02', 'T02', 'TALLER 2 AUTOMOCIï¿½N', 'true', '\n			'),
(155, 'T03', 'T03', 'TALLER DE AUTOMOCIï¿½N', 'true', '\n			'),
(156, 'T04', 'T04', 'TALLER 4 AUTOMOCIï¿½N', 'true', '\n			'),
(157, 'T05', 'T05', 'TALLER 5 AUTOMOCIï¿½N', 'true', '\n			'),
(158, 'T06', 'T06', 'TALLER 6 AUTOMOCION', 'true', '\n			'),
(159, 'T07', 'T07', 'TALLER 7 AUTOMOCION', 'true', '\n			'),
(160, 'T08', 'T08', 'TALLER 8 AUTOMOCION', 'true', '\n			'),
(161, 'TS1', 'TS1', 'TALLER VDJ 1', 'true', '\n			'),
(162, 'TS2', 'TS2', 'TALLER VDJ 2', 'true', '\n			');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ocupadas`
--

CREATE TABLE `ocupadas` (
  `nombre` varchar(10) NOT NULL,
  `dia` int(1) NOT NULL,
  `indice` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ocupadas`
--

INSERT INTO `ocupadas` (`nombre`, `dia`, `indice`) VALUES
('B25', 0, 4),
('B25', 4, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `usuario` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `aula` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `horaDesde` time NOT NULL,
  `horaHasta` time NOT NULL,
  `motivo` varchar(90) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `usuario`, `aula`, `fecha`, `horaDesde`, `horaHasta`, `motivo`) VALUES
(90, 'jefeestudios', 'A02', '2022-06-07', '08:10:00', '10:00:00', 'Online'),
(91, 'jefeestudios', 'A04', '2022-06-09', '08:10:00', '10:00:00', 'online');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones`
--

CREATE TABLE `sesiones` (
  `usuario` varchar(13) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `contraseña` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sesiones`
--

INSERT INTO `sesiones` (`usuario`, `contraseña`) VALUES
('agonzalgam1', 'prueba'),
('carocena23', 'carocena23'),
('conserjeria', 'conserjeria'),
('jefeestudios', 'jefeestudios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tramo`
--

CREATE TABLE `tramo` (
  `id` int(11) NOT NULL,
  `submarco` varchar(40) DEFAULT NULL,
  `dia` varchar(40) DEFAULT NULL,
  `indice` varchar(40) DEFAULT NULL,
  `horaEntrada` varchar(40) DEFAULT NULL,
  `horaSalida` varchar(40) DEFAULT NULL,
  `Tipo` varchar(40) DEFAULT NULL,
  `clavX` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tramo`
--

INSERT INTO `tramo` (`id`, `submarco`, `dia`, `indice`, `horaEntrada`, `horaSalida`, `Tipo`, `clavX`) VALUES
(1, 'A', '0', '0', '08:10:00', '09:05:00', 'lectivo', '1'),
(2, 'A', '0', '1', '09:05:00', '10:00:00', 'lectivo', '2'),
(3, 'A', '0', '2', '10:00:00', '10:55:00', 'lectivo', '3'),
(4, 'A', '0', '3', '10:55:00', '11:20:00', 'recreo', 'R1'),
(5, 'A', '0', '4', '11:20:00', '12:15:00', 'lectivo', '4'),
(6, 'A', '0', '5', '12:15:00', '13:10:00', 'lectivo', '5'),
(7, 'A', '0', '6', '13:10:00', '14:05:00', 'lectivo', '6'),
(8, 'A', '0', '8', '14:50:00', '14:55:00', 'mediodia', 'M'),
(9, 'A', '0', '9', '14:55:00', '15:50:00', 'lectivo', '8'),
(10, 'A', '0', '10', '15:50:00', '16:45:00', 'lectivo', '9'),
(11, 'A', '0', '11', '16:45:00', '17:40:00', 'lectivo', '10'),
(12, 'A', '0', '12', '17:40:00', '18:00:00', 'recreo', 'R2'),
(13, 'A', '0', '13', '18:00:00', '18:50:00', 'lectivo', '11'),
(14, 'A', '0', '14', '18:50:00', '19:40:00', 'lectivo', '12'),
(15, 'A', '0', '15', '19:40:00', '20:30:00', 'lectivo', '13'),
(16, 'A', '1', '0', '08:10:00', '09:05:00', 'lectivo', '1'),
(17, 'A', '1', '1', '09:05:00', '10:00:00', 'lectivo', '2'),
(18, 'A', '1', '2', '10:00:00', '10:55:00', 'lectivo', '3'),
(19, 'A', '1', '3', '10:55:00', '11:20:00', 'recreo', 'R1'),
(20, 'A', '1', '4', '11:20:00', '12:15:00', 'lectivo', '4'),
(21, 'A', '1', '5', '12:15:00', '13:10:00', 'lectivo', '5'),
(22, 'A', '1', '6', '13:10:00', '14:05:00', 'lectivo', '6'),
(23, 'A', '1', '7', '14:05:00', '14:50:00', 'lectivo', '7'),
(24, 'A', '1', '8', '14:50:00', '14:55:00', 'mediodia', 'M'),
(25, 'A', '1', '9', '14:55:00', '15:50:00', 'lectivo', '8'),
(26, 'A', '1', '10', '15:50:00', '16:45:00', 'lectivo', '9'),
(27, 'A', '1', '11', '16:45:00', '17:40:00', 'lectivo', '10'),
(28, 'A', '1', '12', '17:40:00', '18:00:00', 'recreo', 'R2'),
(29, 'A', '1', '13', '18:00:00', '18:50:00', 'lectivo', '11'),
(30, 'A', '1', '14', '18:50:00', '19:40:00', 'lectivo', '12'),
(31, 'A', '1', '15', '19:40:00', '20:30:00', 'lectivo', '13'),
(32, 'A', '2', '0', '08:10:00', '09:05:00', 'lectivo', '1'),
(33, 'A', '2', '1', '09:05:00', '10:00:00', 'lectivo', '2'),
(34, 'A', '2', '2', '10:00:00', '10:55:00', 'lectivo', '3'),
(35, 'A', '2', '3', '10:55:00', '11:20:00', 'recreo', 'R1'),
(36, 'A', '2', '4', '11:20:00', '12:15:00', 'lectivo', '4'),
(37, 'A', '2', '5', '12:15:00', '13:10:00', 'lectivo', '5'),
(38, 'A', '2', '6', '13:10:00', '14:05:00', 'lectivo', '6'),
(39, 'A', '2', '7', '14:05:00', '14:50:00', 'lectivo', '7'),
(40, 'A', '2', '8', '14:50:00', '14:55:00', 'mediodia', 'M'),
(41, 'A', '2', '9', '14:55:00', '15:50:00', 'lectivo', '8'),
(42, 'A', '2', '10', '15:50:00', '16:45:00', 'lectivo', '9'),
(43, 'A', '2', '11', '16:45:00', '17:40:00', 'lectivo', '10'),
(44, 'A', '2', '12', '17:40:00', '18:00:00', 'recreo', 'R2'),
(45, 'A', '2', '13', '18:00:00', '18:50:00', 'lectivo', '11'),
(46, 'A', '2', '14', '18:50:00', '19:40:00', 'lectivo', '12'),
(47, 'A', '2', '15', '19:40:00', '20:30:00', 'lectivo', '13'),
(48, 'A', '3', '0', '08:10:00', '09:05:00', 'lectivo', '1'),
(49, 'A', '3', '1', '09:05:00', '10:00:00', 'lectivo', '2'),
(50, 'A', '3', '2', '10:00:00', '10:55:00', 'lectivo', '3'),
(51, 'A', '3', '3', '10:55:00', '11:20:00', 'recreo', 'R1'),
(52, 'A', '3', '4', '11:20:00', '12:15:00', 'lectivo', '4'),
(53, 'A', '3', '5', '12:15:00', '13:10:00', 'lectivo', '5'),
(54, 'A', '3', '6', '13:10:00', '14:05:00', 'lectivo', '6'),
(55, 'A', '3', '8', '14:50:00', '14:55:00', 'mediodia', 'M'),
(56, 'A', '3', '9', '14:55:00', '15:50:00', 'lectivo', '8'),
(57, 'A', '3', '10', '15:50:00', '16:45:00', 'lectivo', '9'),
(58, 'A', '3', '11', '16:45:00', '17:40:00', 'lectivo', '10'),
(59, 'A', '3', '12', '17:40:00', '18:00:00', 'recreo', 'R2'),
(60, 'A', '3', '13', '18:00:00', '18:50:00', 'lectivo', '11'),
(61, 'A', '3', '14', '18:50:00', '19:40:00', 'lectivo', '12'),
(62, 'A', '3', '15', '19:40:00', '20:30:00', 'lectivo', '13'),
(63, 'A', '4', '0', '08:10:00', '09:05:00', 'lectivo', '1'),
(64, 'A', '4', '1', '09:05:00', '10:00:00', 'lectivo', '2'),
(65, 'A', '4', '2', '10:00:00', '10:55:00', 'lectivo', '3'),
(66, 'A', '4', '3', '10:55:00', '11:20:00', 'recreo', 'R1'),
(67, 'A', '4', '4', '11:20:00', '12:15:00', 'lectivo', '4'),
(68, 'A', '4', '5', '12:15:00', '13:10:00', 'lectivo', '5'),
(69, 'A', '4', '6', '13:10:00', '14:05:00', 'lectivo', '6'),
(70, 'A', '4', '8', '14:50:00', '14:55:00', 'mediodia', 'M'),
(71, 'A', '4', '9', '14:55:00', '15:50:00', 'lectivo', '8'),
(72, 'A', '4', '10', '15:50:00', '16:45:00', 'lectivo', '9'),
(73, 'A', '4', '11', '16:45:00', '17:40:00', 'lectivo', '10'),
(74, 'A', '4', '12', '17:40:00', '18:00:00', 'recreo', 'R2'),
(75, 'A', '4', '13', '18:00:00', '18:50:00', 'lectivo', '11'),
(76, 'A', '4', '14', '18:50:00', '19:40:00', 'lectivo', '12'),
(77, 'A', '4', '15', '19:40:00', '20:30:00', 'lectivo', '13'),
(78, 'A', '0', '0', '08:10:00', '09:05:00', 'lectivo', '1'),
(79, 'A', '0', '1', '09:05:00', '10:00:00', 'lectivo', '2'),
(80, 'A', '0', '2', '10:00:00', '10:55:00', 'lectivo', '3'),
(81, 'A', '0', '3', '10:55:00', '11:20:00', 'recreo', 'R1'),
(82, 'A', '0', '4', '11:20:00', '12:15:00', 'lectivo', '4'),
(83, 'A', '0', '5', '12:15:00', '13:10:00', 'lectivo', '5'),
(84, 'A', '0', '6', '13:10:00', '14:05:00', 'lectivo', '6'),
(85, 'A', '0', '8', '14:50:00', '14:55:00', 'mediodia', 'M'),
(86, 'A', '0', '9', '14:55:00', '15:50:00', 'lectivo', '8'),
(87, 'A', '0', '10', '15:50:00', '16:45:00', 'lectivo', '9'),
(88, 'A', '0', '11', '16:45:00', '17:40:00', 'lectivo', '10'),
(89, 'A', '0', '12', '17:40:00', '18:00:00', 'recreo', 'R2'),
(90, 'A', '0', '13', '18:00:00', '18:50:00', 'lectivo', '11'),
(91, 'A', '0', '14', '18:50:00', '19:40:00', 'lectivo', '12'),
(92, 'A', '0', '15', '19:40:00', '20:30:00', 'lectivo', '13'),
(93, 'A', '1', '0', '08:10:00', '09:05:00', 'lectivo', '1'),
(94, 'A', '1', '1', '09:05:00', '10:00:00', 'lectivo', '2'),
(95, 'A', '1', '2', '10:00:00', '10:55:00', 'lectivo', '3'),
(96, 'A', '1', '3', '10:55:00', '11:20:00', 'recreo', 'R1'),
(97, 'A', '1', '4', '11:20:00', '12:15:00', 'lectivo', '4'),
(98, 'A', '1', '5', '12:15:00', '13:10:00', 'lectivo', '5'),
(99, 'A', '1', '6', '13:10:00', '14:05:00', 'lectivo', '6'),
(100, 'A', '1', '7', '14:05:00', '14:50:00', 'lectivo', '7'),
(101, 'A', '1', '8', '14:50:00', '14:55:00', 'mediodia', 'M'),
(102, 'A', '1', '9', '14:55:00', '15:50:00', 'lectivo', '8'),
(103, 'A', '1', '10', '15:50:00', '16:45:00', 'lectivo', '9'),
(104, 'A', '1', '11', '16:45:00', '17:40:00', 'lectivo', '10'),
(105, 'A', '1', '12', '17:40:00', '18:00:00', 'recreo', 'R2'),
(106, 'A', '1', '13', '18:00:00', '18:50:00', 'lectivo', '11'),
(107, 'A', '1', '14', '18:50:00', '19:40:00', 'lectivo', '12'),
(108, 'A', '1', '15', '19:40:00', '20:30:00', 'lectivo', '13'),
(109, 'A', '2', '0', '08:10:00', '09:05:00', 'lectivo', '1'),
(110, 'A', '2', '1', '09:05:00', '10:00:00', 'lectivo', '2'),
(111, 'A', '2', '2', '10:00:00', '10:55:00', 'lectivo', '3'),
(112, 'A', '2', '3', '10:55:00', '11:20:00', 'recreo', 'R1'),
(113, 'A', '2', '4', '11:20:00', '12:15:00', 'lectivo', '4'),
(114, 'A', '2', '5', '12:15:00', '13:10:00', 'lectivo', '5'),
(115, 'A', '2', '6', '13:10:00', '14:05:00', 'lectivo', '6'),
(116, 'A', '2', '7', '14:05:00', '14:50:00', 'lectivo', '7'),
(117, 'A', '2', '8', '14:50:00', '14:55:00', 'mediodia', 'M'),
(118, 'A', '2', '9', '14:55:00', '15:50:00', 'lectivo', '8'),
(119, 'A', '2', '10', '15:50:00', '16:45:00', 'lectivo', '9'),
(120, 'A', '2', '11', '16:45:00', '17:40:00', 'lectivo', '10'),
(121, 'A', '2', '12', '17:40:00', '18:00:00', 'recreo', 'R2'),
(122, 'A', '2', '13', '18:00:00', '18:50:00', 'lectivo', '11'),
(123, 'A', '2', '14', '18:50:00', '19:40:00', 'lectivo', '12'),
(124, 'A', '2', '15', '19:40:00', '20:30:00', 'lectivo', '13'),
(125, 'A', '3', '0', '08:10:00', '09:05:00', 'lectivo', '1'),
(126, 'A', '3', '1', '09:05:00', '10:00:00', 'lectivo', '2'),
(127, 'A', '3', '2', '10:00:00', '10:55:00', 'lectivo', '3'),
(128, 'A', '3', '3', '10:55:00', '11:20:00', 'recreo', 'R1'),
(129, 'A', '3', '4', '11:20:00', '12:15:00', 'lectivo', '4'),
(130, 'A', '3', '5', '12:15:00', '13:10:00', 'lectivo', '5'),
(131, 'A', '3', '6', '13:10:00', '14:05:00', 'lectivo', '6'),
(132, 'A', '3', '8', '14:50:00', '14:55:00', 'mediodia', 'M'),
(133, 'A', '3', '9', '14:55:00', '15:50:00', 'lectivo', '8'),
(134, 'A', '3', '10', '15:50:00', '16:45:00', 'lectivo', '9'),
(135, 'A', '3', '11', '16:45:00', '17:40:00', 'lectivo', '10'),
(136, 'A', '3', '12', '17:40:00', '18:00:00', 'recreo', 'R2'),
(137, 'A', '3', '13', '18:00:00', '18:50:00', 'lectivo', '11'),
(138, 'A', '3', '14', '18:50:00', '19:40:00', 'lectivo', '12'),
(139, 'A', '3', '15', '19:40:00', '20:30:00', 'lectivo', '13'),
(140, 'A', '4', '0', '08:10:00', '09:05:00', 'lectivo', '1'),
(141, 'A', '4', '1', '09:05:00', '10:00:00', 'lectivo', '2'),
(142, 'A', '4', '2', '10:00:00', '10:55:00', 'lectivo', '3'),
(143, 'A', '4', '3', '10:55:00', '11:20:00', 'recreo', 'R1'),
(144, 'A', '4', '4', '11:20:00', '12:15:00', 'lectivo', '4'),
(145, 'A', '4', '5', '12:15:00', '13:10:00', 'lectivo', '5'),
(146, 'A', '4', '6', '13:10:00', '14:05:00', 'lectivo', '6'),
(147, 'A', '4', '8', '14:50:00', '14:55:00', 'mediodia', 'M'),
(148, 'A', '4', '9', '14:55:00', '15:50:00', 'lectivo', '8'),
(149, 'A', '4', '10', '15:50:00', '16:45:00', 'lectivo', '9'),
(150, 'A', '4', '11', '16:45:00', '17:40:00', 'lectivo', '10'),
(151, 'A', '4', '12', '17:40:00', '18:00:00', 'recreo', 'R2'),
(152, 'A', '4', '13', '18:00:00', '18:50:00', 'lectivo', '11'),
(153, 'A', '4', '14', '18:50:00', '19:40:00', 'lectivo', '12'),
(154, 'A', '4', '15', '19:40:00', '20:30:00', 'lectivo', '13'),
(155, 'A', '0', '0', '08:10:00', '09:05:00', 'lectivo', '1'),
(156, 'A', '0', '1', '09:05:00', '10:00:00', 'lectivo', '2'),
(157, 'A', '0', '2', '10:00:00', '10:55:00', 'lectivo', '3'),
(158, 'A', '0', '3', '10:55:00', '11:20:00', 'recreo', 'R1'),
(159, 'A', '0', '4', '11:20:00', '12:15:00', 'lectivo', '4'),
(160, 'A', '0', '5', '12:15:00', '13:10:00', 'lectivo', '5'),
(161, 'A', '0', '6', '13:10:00', '14:05:00', 'lectivo', '6'),
(162, 'A', '0', '8', '14:50:00', '14:55:00', 'mediodia', 'M'),
(163, 'A', '0', '9', '14:55:00', '15:50:00', 'lectivo', '8'),
(164, 'A', '0', '10', '15:50:00', '16:45:00', 'lectivo', '9'),
(165, 'A', '0', '11', '16:45:00', '17:40:00', 'lectivo', '10'),
(166, 'A', '0', '12', '17:40:00', '18:00:00', 'recreo', 'R2'),
(167, 'A', '0', '13', '18:00:00', '18:50:00', 'lectivo', '11'),
(168, 'A', '0', '14', '18:50:00', '19:40:00', 'lectivo', '12'),
(169, 'A', '0', '15', '19:40:00', '20:30:00', 'lectivo', '13'),
(170, 'A', '1', '0', '08:10:00', '09:05:00', 'lectivo', '1'),
(171, 'A', '1', '1', '09:05:00', '10:00:00', 'lectivo', '2'),
(172, 'A', '1', '2', '10:00:00', '10:55:00', 'lectivo', '3'),
(173, 'A', '1', '3', '10:55:00', '11:20:00', 'recreo', 'R1'),
(174, 'A', '1', '4', '11:20:00', '12:15:00', 'lectivo', '4'),
(175, 'A', '1', '5', '12:15:00', '13:10:00', 'lectivo', '5'),
(176, 'A', '1', '6', '13:10:00', '14:05:00', 'lectivo', '6'),
(177, 'A', '1', '7', '14:05:00', '14:50:00', 'lectivo', '7'),
(178, 'A', '1', '8', '14:50:00', '14:55:00', 'mediodia', 'M'),
(179, 'A', '1', '9', '14:55:00', '15:50:00', 'lectivo', '8'),
(180, 'A', '1', '10', '15:50:00', '16:45:00', 'lectivo', '9'),
(181, 'A', '1', '11', '16:45:00', '17:40:00', 'lectivo', '10'),
(182, 'A', '1', '12', '17:40:00', '18:00:00', 'recreo', 'R2'),
(183, 'A', '1', '13', '18:00:00', '18:50:00', 'lectivo', '11'),
(184, 'A', '1', '14', '18:50:00', '19:40:00', 'lectivo', '12'),
(185, 'A', '1', '15', '19:40:00', '20:30:00', 'lectivo', '13'),
(186, 'A', '2', '0', '08:10:00', '09:05:00', 'lectivo', '1'),
(187, 'A', '2', '1', '09:05:00', '10:00:00', 'lectivo', '2'),
(188, 'A', '2', '2', '10:00:00', '10:55:00', 'lectivo', '3'),
(189, 'A', '2', '3', '10:55:00', '11:20:00', 'recreo', 'R1'),
(190, 'A', '2', '4', '11:20:00', '12:15:00', 'lectivo', '4'),
(191, 'A', '2', '5', '12:15:00', '13:10:00', 'lectivo', '5'),
(192, 'A', '2', '6', '13:10:00', '14:05:00', 'lectivo', '6'),
(193, 'A', '2', '7', '14:05:00', '14:50:00', 'lectivo', '7'),
(194, 'A', '2', '8', '14:50:00', '14:55:00', 'mediodia', 'M'),
(195, 'A', '2', '9', '14:55:00', '15:50:00', 'lectivo', '8'),
(196, 'A', '2', '10', '15:50:00', '16:45:00', 'lectivo', '9'),
(197, 'A', '2', '11', '16:45:00', '17:40:00', 'lectivo', '10'),
(198, 'A', '2', '12', '17:40:00', '18:00:00', 'recreo', 'R2'),
(199, 'A', '2', '13', '18:00:00', '18:50:00', 'lectivo', '11'),
(200, 'A', '2', '14', '18:50:00', '19:40:00', 'lectivo', '12'),
(201, 'A', '2', '15', '19:40:00', '20:30:00', 'lectivo', '13'),
(202, 'A', '3', '0', '08:10:00', '09:05:00', 'lectivo', '1'),
(203, 'A', '3', '1', '09:05:00', '10:00:00', 'lectivo', '2'),
(204, 'A', '3', '2', '10:00:00', '10:55:00', 'lectivo', '3'),
(205, 'A', '3', '3', '10:55:00', '11:20:00', 'recreo', 'R1'),
(206, 'A', '3', '4', '11:20:00', '12:15:00', 'lectivo', '4'),
(207, 'A', '3', '5', '12:15:00', '13:10:00', 'lectivo', '5'),
(208, 'A', '3', '6', '13:10:00', '14:05:00', 'lectivo', '6'),
(209, 'A', '3', '8', '14:50:00', '14:55:00', 'mediodia', 'M'),
(210, 'A', '3', '9', '14:55:00', '15:50:00', 'lectivo', '8'),
(211, 'A', '3', '10', '15:50:00', '16:45:00', 'lectivo', '9'),
(212, 'A', '3', '11', '16:45:00', '17:40:00', 'lectivo', '10'),
(213, 'A', '3', '12', '17:40:00', '18:00:00', 'recreo', 'R2'),
(214, 'A', '3', '13', '18:00:00', '18:50:00', 'lectivo', '11'),
(215, 'A', '3', '14', '18:50:00', '19:40:00', 'lectivo', '12'),
(216, 'A', '3', '15', '19:40:00', '20:30:00', 'lectivo', '13'),
(217, 'A', '4', '0', '08:10:00', '09:05:00', 'lectivo', '1'),
(218, 'A', '4', '1', '09:05:00', '10:00:00', 'lectivo', '2'),
(219, 'A', '4', '2', '10:00:00', '10:55:00', 'lectivo', '3'),
(220, 'A', '4', '3', '10:55:00', '11:20:00', 'recreo', 'R1'),
(221, 'A', '4', '4', '11:20:00', '12:15:00', 'lectivo', '4'),
(222, 'A', '4', '5', '12:15:00', '13:10:00', 'lectivo', '5'),
(223, 'A', '4', '6', '13:10:00', '14:05:00', 'lectivo', '6'),
(224, 'A', '4', '8', '14:50:00', '14:55:00', 'mediodia', 'M'),
(225, 'A', '4', '9', '14:55:00', '15:50:00', 'lectivo', '8'),
(226, 'A', '4', '10', '15:50:00', '16:45:00', 'lectivo', '9'),
(227, 'A', '4', '11', '16:45:00', '17:40:00', 'lectivo', '10'),
(228, 'A', '4', '12', '17:40:00', '18:00:00', 'recreo', 'R2'),
(229, 'A', '4', '13', '18:00:00', '18:50:00', 'lectivo', '11'),
(230, 'A', '4', '14', '18:50:00', '19:40:00', 'lectivo', '12'),
(231, 'A', '4', '15', '19:40:00', '20:30:00', 'lectivo', '13');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aula`
--
ALTER TABLE `aula`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD PRIMARY KEY (`usuario`);

--
-- Indices de la tabla `tramo`
--
ALTER TABLE `tramo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aula`
--
ALTER TABLE `aula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de la tabla `tramo`
--
ALTER TABLE `tramo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
