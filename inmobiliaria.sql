-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-06-2024 a las 21:21:45
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
-- Base de datos: `inmobiliaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `casa`
--

CREATE TABLE `casa` (
  `id_casa` int(11) NOT NULL,
  `descprcion` text NOT NULL,
  `habitaciones` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `precio` double NOT NULL,
  `comunidad_autonoma` varchar(255) NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `destacado` tinyint(1) NOT NULL,
  `oculto` tinyint(1) NOT NULL,
  `banos` int(11) NOT NULL,
  `metros` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `casa`
--

INSERT INTO `casa` (`id_casa`, `descprcion`, `habitaciones`, `titulo`, `precio`, `comunidad_autonoma`, `ciudad`, `destacado`, `oculto`, `banos`, `metros`) VALUES
(1, 'La casa es una acogedora vivienda de dos pisos con una fachada en tonos cálidos y una puerta de madera tallada. Al entrar, se encuentra un recibidor con suelos de madera que conduce a una sala de estar con chimenea y a una cocina moderna con isla de mármol. En el segundo piso, hay tres dormitorios, uno de ellos con baño en suite. El jardín trasero tiene un césped bien cuidado, un patio con muebles de exterior y un cobertizo. La casa cuenta con un garaje para dos coches y está rodeada por una valla de madera que proporciona privacidad.', 5, 'Chalet', 120000, 'Comunidad Valenciana', 'Torrevieja', 1, 0, 3, 75),
(2, 'La casa es una acogedora vivienda de un solo piso, pintada en tonos cálidos de beige y blanco. La entrada principal tiene una puerta de madera maciza que abre a un vestíbulo con suelos de cerámica. A la derecha, una sala de estar luminosa con grandes ventanales y, a la izquierda, una cocina moderna con isla central y electrodomésticos de acero inoxidable. La casa cuenta con tres dormitorios, incluyendo una suite principal con baño privado. El jardín trasero tiene un patio con muebles de exterior y un pequeño jardín de flores, rodeado por una cerca de madera. Un garaje para un coche completa esta encantadora propiedad.', 2, 'Piso', 75000, 'Madrid', 'Alcorcon', 1, 0, 2, 80),
(3, 'El ático es un espacio elegante y moderno, ubicado en el último piso de un edificio céntrico. Al entrar, se encuentra una amplia sala de estar con techos altos y grandes ventanales que ofrecen vistas panorámicas de la ciudad. La decoración es minimalista, con suelos de madera clara y muebles de diseño contemporáneo. La cocina está integrada en el mismo espacio, equipada con electrodomésticos de acero inoxidable y una isla central que sirve también como barra de desayuno. El dormitorio principal es acogedor, con un gran ventanal y acceso directo a una terraza privada. El baño es espacioso, con una ducha de vidrio y acabados en mármol. La terraza, el punto focal del ático, cuenta con muebles de exterior y plantas, creando un oasis urbano ideal para el descanso y el entretenimiento.', 4, 'Apartamento', 100000, 'Comunidad Valenciana', 'Torrevieja', 1, 0, 3, 120),
(4, 'El ático es un espacio elegante y moderno, ubicado en el último piso de un edificio céntrico. Al entrar, se encuentra una amplia sala de estar con techos altos y grandes ventanales que ofrecen vistas panorámicas de la ciudad. La decoración es minimalista, con suelos de madera clara y muebles de diseño contemporáneo. La cocina está integrada en el mismo espacio, equipada con electrodomésticos de acero inoxidable y una isla central que sirve también como barra de desayuno. El dormitorio principal es acogedor, con un gran ventanal y acceso directo a una terraza privada. El baño es espacioso, con una ducha de vidrio y acabados en mármol. La terraza, el punto focal del ático, cuenta con muebles de exterior y plantas, creando un oasis urbano ideal para el descanso y el entretenimiento.', 4, 'Piso', 100000, 'Comunidad Valenciana', 'Torrevieja', 1, 0, 3, 120),
(5, 'El chalet es una encantadora residencia de estilo alpino, construida en madera y piedra, ubicada en una zona montañosa. La fachada cuenta con un amplio porche cubierto adornado con flores y muebles de exterior rústicos. Al entrar, se encuentra una acogedora sala de estar con una chimenea de piedra, techos altos con vigas de madera expuestas y grandes ventanales que ofrecen vistas impresionantes del paisaje. La cocina, moderna pero con toques rústicos, está equipada con electrodomésticos de acero inoxidable y una isla central. El chalet tiene tres dormitorios, incluyendo una suite principal con un baño privado que dispone de una bañera de hidromasaje. En el exterior, hay un jardín amplio con un área de barbacoa y una piscina climatizada, perfecto para disfrutar del entorno natural durante todo el año. Un garaje para dos coches y un camino de entrada de piedra completan esta encantadora propiedad.', 5, 'Piso', 150000, 'Comunidad Valenciana', 'Torrevieja', 1, 0, 3, 120),
(6, 'La casa es una moderna vivienda de estilo contemporáneo con una fachada de piedra y grandes ventanas. Al entrar, un vestíbulo amplio lleva a una sala de estar con suelos de madera y chimenea. La cocina abierta, equipada con electrodomésticos de alta gama, incluye una isla central. La casa tiene tres dormitorios, con una suite principal que cuenta con vestidor y baño privado. El jardín trasero tiene un patio para comidas al aire libre y una zona de césped bien cuidada. Un garaje para dos coches completa esta acogedora residencia.', 3, 'Piso', 60000, 'Comunidad Valenciana', 'Torrevieja', 1, 0, 1, 65),
(7, 'La casa es una acogedora vivienda de un solo piso con una fachada en tonos cálidos y grandes ventanales. Al entrar, hay una sala de estar luminosa con suelos de madera. La cocina moderna está equipada con electrodomésticos de alta gama y una isla central. La casa tiene tres dormitorios, incluyendo una suite principal con baño privado. El jardín trasero cuenta con un patio para comidas al aire libre y un césped bien cuidado. Un garaje para un coche completa esta encantadora residencia.', 2, 'Apartamento', 50000, 'Comunidad Valenciana', 'Torrevieja', 1, 0, 1, 50),
(8, 'El chalet es una acogedora vivienda de un solo piso, con una fachada de madera y piedra en tonos naturales. Al entrar, hay una sala de estar espaciosa con techos altos, vigas de madera expuestas y una chimenea de piedra. La cocina, moderna pero con un toque rústico, cuenta con electrodomésticos de alta gama y una isla central. El chalet tiene tres dormitorios, incluyendo una suite principal con baño privado. En el exterior, hay un amplio jardín con un patio y una zona de barbacoa, ideal para disfrutar del entorno natural. Un garaje para dos coches completa esta encantadora residencia alpina.', 3, 'Chalet', 100000, 'Comunidad Valenciana', 'Torrevieja', 1, 0, 2, 67),
(9, 'La casa es una encantadora vivienda de un solo piso con una fachada en tonos claros y grandes ventanales. Al entrar, se encuentra una sala de estar luminosa con suelos de madera y una chimenea moderna. La cocina abierta, equipada con electrodomésticos de alta gama, cuenta con una isla central. La casa tiene tres dormitorios, incluyendo una suite principal con baño privado. El jardín trasero dispone de un patio perfecto para comidas al aire libre y un césped bien cuidado. Un garaje para un coche completa esta acogedora residencia.', 6, 'Mansion', 400000, 'Comunidad Valenciana', 'Torrevieja', 0, 0, 3, 160);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id_imagen` int(11) NOT NULL,
  `imagen` longtext NOT NULL,
  `id_casa` int(11) NOT NULL,
  `ocultoImagen` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id_imagen`, `imagen`, `id_casa`, `ocultoImagen`) VALUES
(1, 'casa1-image1.jpg', 1, 0),
(2, 'casa1-image2.jpg', 1, 0),
(3, 'casa1-image3.jpg', 1, 0),
(4, 'casa1-image4.jpg', 1, 0),
(5, 'casa1-image5.jpg', 1, 0),
(6, 'casa1-image6.jpg', 1, 0),
(7, 'casa2-image1.jpg', 2, 0),
(8, 'casa2-image2.jpg', 2, 0),
(9, 'casa2-image3.jpg', 2, 0),
(10, 'casa2-image4.jpg', 2, 0),
(11, 'casa2-image5.jpg', 2, 0),
(12, 'casa3-image1.jpg', 3, 0),
(13, 'casa3-image2.jpg', 3, 0),
(14, 'casa3-image3.jpg', 3, 0),
(15, 'casa3-image4.jpg', 3, 0),
(16, 'casa3-image5.jpg', 3, 0),
(17, 'casa4-image1.jpg', 4, 0),
(18, 'casa4-image2.jpg', 4, 0),
(19, 'casa4-image3.jpg', 4, 0),
(20, 'casa4-image4.jpg', 4, 0),
(21, 'casa4-image5.jpg', 4, 0),
(22, 'casa5-image1.jpg', 5, 0),
(23, 'casa5-image2.jpg', 5, 0),
(24, 'casa5-image3.jpg', 5, 0),
(25, 'casa5-image4.jpg', 5, 0),
(26, 'casa5-image5.jpg', 5, 0),
(27, 'casa8-image1.jpg', 6, 0),
(28, 'casa8-image2.jpg', 6, 0),
(29, 'casa8-image3.jpg', 6, 0),
(30, 'casa8-image4.jpg', 6, 0),
(31, 'casa8-image5.jpg', 6, 0),
(32, 'casa9-image1.jpg', 7, 0),
(33, 'casa9-image2.jpg', 7, 0),
(34, 'casa9-image3.jpg', 7, 0),
(35, 'casa9-image4.jpg', 7, 0),
(36, 'casa9-image5.jpg', 7, 0),
(37, 'casa10-image1.jpg', 8, 0),
(38, 'casa10-image2.jpg', 8, 0),
(39, 'casa10-image3.jpg', 8, 0),
(40, 'casa10-image4.jpg', 8, 0),
(41, 'casa10-image5.jpg', 8, 0),
(42, 'casa11-image1.jpg', 9, 0),
(43, 'casa11-image2.jpg', 9, 0),
(44, 'casa11-image3.jpg', 9, 0),
(45, 'casa11-image4.jpg', 9, 0),
(46, 'casa11-image5.jpg', 9, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `megusta`
--

CREATE TABLE `megusta` (
  `id_usuario` int(11) NOT NULL,
  `id_casa` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `megusta`
--

INSERT INTO `megusta` (`id_usuario`, `id_casa`, `id`) VALUES
(1, 1, 1),
(1, 1, 2),
(2, 1, 3),
(2, 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `contrasena` longtext NOT NULL,
  `email` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `rol` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario`, `contrasena`, `email`, `nombre`, `rol`) VALUES
(1, 'jhon2', '$2y$10$DhmGP1hBtuteh0Hl3e/ul.SiB5LfEEm.KsjQ01e4bPXX03z/C6qki', 'solanomacascristofer@gmail.com', 'jhon2', 'admin'),
(2, 'user', '$2y$10$qqJ48.jNi5vBwkJnm/IL9eHztSPo6KHX/17xvJ7QuB6vC04Vuwqoi', 'solanomacascristofer@gmail.com', 'user', 'normal');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `casa`
--
ALTER TABLE `casa`
  ADD PRIMARY KEY (`id_casa`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id_imagen`),
  ADD KEY `id_casa` (`id_casa`);

--
-- Indices de la tabla `megusta`
--
ALTER TABLE `megusta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_casa` (`id_casa`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `casa`
--
ALTER TABLE `casa`
  MODIFY `id_casa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `megusta`
--
ALTER TABLE `megusta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `imagenes_ibfk_1` FOREIGN KEY (`id_casa`) REFERENCES `casa` (`id_casa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `megusta`
--
ALTER TABLE `megusta`
  ADD CONSTRAINT `megusta_ibfk_2` FOREIGN KEY (`id_casa`) REFERENCES `casa` (`id_casa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `megusta_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
