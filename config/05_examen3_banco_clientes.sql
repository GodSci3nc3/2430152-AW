-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 04-12-2025 a las 15:16:28
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `banco_clientes`
--

CREATE DATABASE IF NOT EXISTS `banco_clientes` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `banco_clientes`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `rfc` varchar(13) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `clabe` varchar(18) NOT NULL,
  `id_institucion` int(11) NOT NULL,
  `saldo_bancario` decimal(15,2) DEFAULT 0.00,
  `activo` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `rfc`, `nombre`, `direccion`, `clabe`, `id_institucion`, `saldo_bancario`, `activo`) VALUES
(1, 'XAXX010101000', 'Juan Perez', 'Av. Reforma 123', '012180001234567890', 1, 50000.00, 1),
(2, 'XEXX020202000', 'Maria Lopez', 'Calle Norte 456', '002180009876543210', 2, 75000.50, 1),
(3, 'XOXX030303000', 'Carlos Martinez', 'Blvd. Sur 789', '014180001122334455', 3, 120000.75, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instituciones_bancarias`
--

CREATE TABLE `instituciones_bancarias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `activo` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `instituciones_bancarias`
--

INSERT INTO `instituciones_bancarias` (`id`, `nombre`, `activo`) VALUES
(1, 'BBVA', 1),
(2, 'Banamex', 1),
(3, 'Santander', 1),
(4, 'Banorte', 1),
(5, 'HSBC', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `instituciones_bancarias`
--
ALTER TABLE `instituciones_bancarias`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `instituciones_bancarias`
--
ALTER TABLE `instituciones_bancarias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
