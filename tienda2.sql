-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-05-2020 a las 04:14:34
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admins`
--

CREATE TABLE `admins` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `pasadmin` varchar(55) NOT NULL,
  `name` varchar(55) NOT NULL,
  `rol` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`id_admin`, `username`, `email`, `pasadmin`, `name`, `rol`) VALUES
(1, 'admin', 'admin@gmail.com', '123', 'GarciaDuranYordi', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carro`
--

CREATE TABLE `carro` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `nombre` varchar(55) NOT NULL,
  `rol` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `username`, `email`, `password`, `nombre`, `rol`) VALUES
(1, 'Cliente', 'cliente@gmail.com', '123', 'Probando1', 2),
(5, 'Cliente', 'yordi_gd_99@hotmail.com', 'haker123456jp', 'Yordi Garcia Duran', 2),
(6, 'Cliente', 'usuario@gmail', '123', '', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `monto` float NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id`, `id_cliente`, `fecha`, `monto`, `estado`) VALUES
(19, 5, '2020-05-23 03:48:06', 0, 0),
(20, 1, '2020-05-23 17:38:39', 300, 0),
(21, 1, '2020-05-23 21:13:57', 770.25, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `comprobante` varchar(255) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `id_cliente`, `id_compra`, `comprobante`, `nombre`, `fecha`, `estado`) VALUES
(4, 1, 8, '01055363.png', 'Anyelber Boscan', '2019-05-22 18:05:53', 1),
(5, 5, 18, '091242332.png', '', '2020-05-23 02:12:42', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `price` float NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `oferta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `price`, `imagen`, `name`, `oferta`) VALUES
(14, 333, 'Vitrina624.png', 'Vitrina prueba', 0),
(15, 123, 'Vitrina427.png', 'Vitrina', 0),
(16, 300, 'Estantería705.png', 'Estantería', 0),
(17, 300, 'Estantería238.png', 'Estantería', 0),
(20, 495, 'Anaquel Estanda429.png', 'Anaquel Estanda', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_compra`
--

CREATE TABLE `productos_compra` (
  `id` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `monto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos_compra`
--

INSERT INTO `productos_compra` (`id`, `id_compra`, `id_producto`, `cantidad`, `monto`) VALUES
(29, 18, 15, 1, 123),
(30, 20, 16, 1, 300),
(31, 21, 20, 1, 495),
(32, 21, 17, 1, 300);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indices de la tabla `carro`
--
ALTER TABLE `carro`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_compra`
--
ALTER TABLE `productos_compra`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `carro`
--
ALTER TABLE `carro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `productos_compra`
--
ALTER TABLE `productos_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
