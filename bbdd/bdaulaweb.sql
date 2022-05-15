-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-03-2022 a las 11:21:32
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 8.0.11

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

CREATE DATABASE IF NOT EXISTS `bdaulaweb`;
USE `bdaulaweb`;

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `aulasReservadas` (IN `aulaRes` VARCHAR(5), IN `fechaRes` DATE, IN `horaDesdeRes` TIME, IN `horaHastaRes` TIME)  BEGIN
SELECT COUNT(*) FROM reservas WHERE (aula = aulaRes AND fecha = fechaRes) AND ((horaDesdeRes = horaDesde AND horaHastaRes = horaHasta) OR (horaDesdeRes < horaDesde AND horaHastaRes > horaHasta) OR (horaDesdeRes > horaDesde AND horaHastaRes < horaHasta) OR ((horaDesdeRes > horaDesde AND horaDesdeRes < horaHasta) AND (horaHastaRes >= horaHasta OR horaHastaRes <= horaHasta)) OR ((horaDesdeRes <= horaDesde) AND (horaHastaRes > horaDesde AND horaHastaRes < horaHasta)) OR (horaDesdeRes < horaDesde AND horaHastaRes > horaHasta));
END$$

DELIMITER ;

-- --------------------------------------------------------

CREATE TABLE `sesiones` (
  `usuario` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `contraseña` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `sesiones`
--

INSERT INTO `sesiones` (`usuario`, `contraseña`) VALUES
('agonzalgam1', 'prueba'),
('jefeestudios', 'jefeestudios'),
('carocena23', 'carocena23');

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
-- Indices de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD PRIMARY KEY (`usuario`);


--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
