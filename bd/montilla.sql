-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2023 a las 22:55:27
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `montilla`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha_tecnica`
--

CREATE TABLE `ficha_tecnica` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `tipo_pc` varchar(20) DEFAULT NULL,
  `marca` varchar(30) DEFAULT NULL,
  `marca_ram` varchar(40) DEFAULT NULL,
  `cantidad_ram` varchar(40) DEFAULT NULL,
  `marca_cpu` varchar(40) DEFAULT NULL,
  `cantidad_nucleos` varchar(40) DEFAULT NULL,
  `marca_Motherboard` varchar(40) DEFAULT NULL,
  `disco_duro` varchar(40) DEFAULT NULL,
  `nombre_dueño` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ficha_tecnica`
--

INSERT INTO `ficha_tecnica` (`id`, `codigo`, `estado`, `tipo_pc`, `marca`, `marca_ram`, `cantidad_ram`, `marca_cpu`, `cantidad_nucleos`, `marca_Motherboard`, `disco_duro`, `nombre_dueño`) VALUES
(1, 65535073, NULL, 'Torre', 'HP', 'asus', '12gb', 'reddragon', 'asdd', NULL, NULL, 'Marlon Pastrana Moreno'),
(2, 46345793, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Marlon Pastrana Moreno'),
(3, 7514172, NULL, 'Desconocido', 'Pavilion', 'Kingstone', '8gb', 'Intel Core I5', '8', 'A', 'Kinstone 500gb', 'Marlon camilo'),
(4, 82766204, 'Mantenimiento', 'Laptop', 'HP', NULL, NULL, NULL, NULL, NULL, NULL, 'Camilo Gomez Morales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pendientes`
--

CREATE TABLE `pendientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `mensaje` longtext NOT NULL,
  `codigo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `pendientes`
--

INSERT INTO `pendientes` (`id`, `nombre`, `correo`, `titulo`, `mensaje`, `codigo`) VALUES
(1, 'Andy', 'y.andreslasso2904@gmail.com', 'sapo perro', 'x', NULL),
(2, 'marlon', 'mpastrana@fet.com', 'hola', 'sumama', NULL),
(3, 'montilla', 'montillaa@fet', 'portatil', 'se me daÃ±o', NULL),
(4, 'Andy', 'y.andreslasso2904@gmail.com', 'sapo perro', 'zxzzxx', NULL),
(5, 'Andy', 'y.andreslasso2904@gmail.com', 'hola1', 'ssss', NULL),
(6, 'Marlon', 'mpastranamoreno@gmail.com', 'Arreglame la PC caremonda', 'Oe weon arreglame la PC', NULL),
(7, 'Marlon Pastrana Moreno', 'Freskmann_silvama@fet.edu.co', 'Arreglame la PC caremonda', 'Joa test 123', 1),
(8, 'Marlon Pastrana Moreno', 'Freskmann_silvama@fet.edu.co', 'Arreglame la PC caremonda', 'Joa test 1234', 2),
(9, 'Marlon camilo', 'mpastranamoreno@gmail.com', 'Arreglame la PC caremonda', 'Oe weon arreglame la PC', 3),
(10, 'Camilo Gomez Morales', 'camilo_gomezmo@fet.edu.co', 'La pc SE AÑO', 'AYUAAAAAAAAAAA', 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ficha_tecnica`
--
ALTER TABLE `ficha_tecnica`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pendientes`
--
ALTER TABLE `pendientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Pendientes_fichaTecnica_idx` (`codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ficha_tecnica`
--
ALTER TABLE `ficha_tecnica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pendientes`
--
ALTER TABLE `pendientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pendientes`
--
ALTER TABLE `pendientes`
  ADD CONSTRAINT `FK_PENDIENTES_FICHA` FOREIGN KEY (`codigo`) REFERENCES `ficha_tecnica` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
