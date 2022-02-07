-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-02-2022 a las 10:53:20
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

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `aulasReservadas` (IN `aulaRes` VARCHAR(5), IN `fechaRes` DATE, IN `horaDesdeRes` TIME, IN `horaHastaRes` TIME)  BEGIN
SELECT COUNT(*) FROM reservas WHERE (aula = aulaRes) AND (fecha = fechaRes AND (horaDesde = horaDesdeRes OR horaHasta < horaHastaRes) AND (horaHasta <= horaHastaRes OR horaHasta > horaDesdeRes));
END$$

DELIMITER ;

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
  `horaHasta` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `usuario`, `aula`, `fecha`, `horaDesde`, `horaHasta`) VALUES
(1, 'mgoicoeoca', 'A02', '2022-02-04', '11:00:00', '11:55:00'),
(7, 'mgoicoeoca', 'A04', '2022-02-07', '09:00:00', '10:10:00'),
(9, 'mgoicoeoca', 'A01', '2022-02-07', '09:00:00', '10:00:00'),
(10, 'mgoicoeoca', 'A01', '2022-02-07', '09:30:00', '10:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
