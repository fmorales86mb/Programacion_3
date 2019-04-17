-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2019 at 10:02 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `utn`
--

-- --------------------------------------------------------

--
-- Table structure for table `envios`
--

CREATE TABLE `envios` (
  `Numero` int(11) NOT NULL,
  `pNumero` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `envios`
--

INSERT INTO `envios` (`Numero`, `pNumero`, `Cantidad`) VALUES
(100, 1, 500),
(100, 2, 1500),
(100, 3, 100),
(101, 2, 55),
(101, 3, 225),
(102, 1, 600),
(102, 3, 300);

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `pNumero` int(11) NOT NULL,
  `pNombre` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Precio` float DEFAULT NULL,
  `Tamaño` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`pNumero`, `pNombre`, `Precio`, `Tamaño`) VALUES
(1, 'Caramelos', 1.5, 'Chico'),
(2, 'Cigarrillos', 45.89, 'Mediano'),
(3, 'Gaseosa', 15.8, 'Grande');

-- --------------------------------------------------------

--
-- Table structure for table `provedores`
--

CREATE TABLE `provedores` (
  `Numero` int(11) NOT NULL,
  `Nombre` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Domicilio` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Localidad` varchar(80) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `provedores`
--

INSERT INTO `provedores` (`Numero`, `Nombre`, `Domicilio`, `Localidad`) VALUES
(100, 'Perez', 'Perón 876', 'Quilmes'),
(101, 'Gimenez', 'Mitre 750', 'Avellaneda'),
(102, 'Aguirre', 'Boedo 634', 'Bernal');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `envios`
--
ALTER TABLE `envios`
  ADD PRIMARY KEY (`Numero`,`pNumero`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`pNumero`);

--
-- Indexes for table `provedores`
--
ALTER TABLE `provedores`
  ADD PRIMARY KEY (`Numero`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `pNumero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `provedores`
--
ALTER TABLE `provedores`
  MODIFY `Numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
