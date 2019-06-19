-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-06-2019 a las 01:11:10
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
-- Base de datos: `la_comanda_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comanda`
--

CREATE TABLE `comanda` (
  `id` int(11) NOT NULL,
  `codigo` varchar(10) COLLATE utf32_spanish2_ci NOT NULL,
  `mesa_id` int(11) NOT NULL,
  `foto` text COLLATE utf32_spanish2_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_mesa`
--

CREATE TABLE `estado_mesa` (
  `id` int(11) NOT NULL,
  `estado` varchar(20) COLLATE utf32_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_pedido`
--

CREATE TABLE `estado_pedido` (
  `id` int(11) NOT NULL,
  `estado` varchar(20) COLLATE utf32_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `id` int(11) NOT NULL,
  `clave` varchar(20) COLLATE utf32_spanish2_ci NOT NULL,
  `estado_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id` int(11) NOT NULL,
  `comanda_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `tiempo_estimado` time DEFAULT NULL,
  `tiempo_inicio` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf32_spanish2_ci NOT NULL,
  `rol_encargado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf32_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE utf32_spanish2_ci NOT NULL,
  `clave` varchar(20) COLLATE utf32_spanish2_ci NOT NULL,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comanda`
--
ALTER TABLE `comanda`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_mesa`
--
ALTER TABLE `estado_mesa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_pedido`
--
ALTER TABLE `estado_pedido`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comanda`
--
ALTER TABLE `comanda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estado_mesa`
--
ALTER TABLE `estado_mesa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estado_pedido`
--
ALTER TABLE `estado_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesa`
--
ALTER TABLE `mesa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
