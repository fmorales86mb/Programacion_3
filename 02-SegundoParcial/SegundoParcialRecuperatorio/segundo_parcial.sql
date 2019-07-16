-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-07-2019 a las 01:21:59
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `segundo_parcial`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `nombre` varchar(50) COLLATE utf32_spanish2_ci NOT NULL,
  `cuatrimestre` int(11) NOT NULL,
  `cupos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`nombre`, `cuatrimestre`, `cupos`) VALUES
('Laboratorio', 1, 0),
('Programacion', 1, 2),
('Sistemas Operativos', 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia_alumno`
--

CREATE TABLE `materia_alumno` (
  `materia` varchar(50) COLLATE utf32_spanish2_ci NOT NULL,
  `alumno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

--
-- Volcado de datos para la tabla `materia_alumno`
--

INSERT INTO `materia_alumno` (`materia`, `alumno`) VALUES
('Programacion', 1),
('Programacion', 4),
('Laboratorio', 4),
('Laboratorio', 4),
('Laboratorio', 4),
('Laboratorio', 4),
('Laboratorio', 4),
('Laboratorio', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia_profesor`
--

CREATE TABLE `materia_profesor` (
  `materia` varchar(50) COLLATE utf32_spanish2_ci NOT NULL,
  `profesor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

--
-- Volcado de datos para la tabla `materia_profesor`
--

INSERT INTO `materia_profesor` (`materia`, `profesor`) VALUES
('Programacion', 3),
('Laboratorio', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `legajo` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf32_spanish2_ci NOT NULL,
  `clave` varchar(20) COLLATE utf32_spanish2_ci NOT NULL,
  `tipo` varchar(50) COLLATE utf32_spanish2_ci NOT NULL,
  `email` varchar(50) COLLATE utf32_spanish2_ci DEFAULT NULL,
  `url_imagen` varchar(150) COLLATE utf32_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`legajo`, `nombre`, `clave`, `tipo`, `email`, `url_imagen`) VALUES
(1, 'Juan', 'claveAlumno', 'alumno', 'mail2@bla.com', './05-Img/1.jpeg'),
(2, 'admin', 'claveAdmin', 'admin', NULL, NULL),
(3, 'Pepe', 'claveProfesor', 'profesor', 'mail@bla.com', NULL),
(4, 'Paula', 'claveAlumna', 'alumno', 'paula@bla.com', './05-Img/4.jpeg'),
(5, 'Luis', 'claveAlumna', 'alumno', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `materia_alumno`
--
ALTER TABLE `materia_alumno`
  ADD KEY `materia` (`materia`),
  ADD KEY `alumno` (`alumno`);

--
-- Indices de la tabla `materia_profesor`
--
ALTER TABLE `materia_profesor`
  ADD KEY `materia` (`materia`),
  ADD KEY `profesor` (`profesor`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`legajo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `legajo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `materia_alumno`
--
ALTER TABLE `materia_alumno`
  ADD CONSTRAINT `materia_alumno_ibfk_1` FOREIGN KEY (`alumno`) REFERENCES `usuario` (`legajo`),
  ADD CONSTRAINT `materia_alumno_ibfk_2` FOREIGN KEY (`materia`) REFERENCES `materia` (`nombre`);

--
-- Filtros para la tabla `materia_profesor`
--
ALTER TABLE `materia_profesor`
  ADD CONSTRAINT `materia_profesor_ibfk_1` FOREIGN KEY (`materia`) REFERENCES `materia` (`nombre`),
  ADD CONSTRAINT `materia_profesor_ibfk_2` FOREIGN KEY (`profesor`) REFERENCES `usuario` (`legajo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
