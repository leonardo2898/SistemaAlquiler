-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-02-2021 a las 05:35:46
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `carrito`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` double NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(400) NOT NULL,
  `imagen` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `imagen`) VALUES
(1, 'Lacteos', 'Los productos lácteos son ricos elementos nutritivos, especialmente conveniente para los niños', 'lacteos.jpg'),
(2, 'Derivados lacteos', 'Se incluyen aquellos alimentos que se elaboran a partir de la leche: yogur, quesos, dulce de leche, helados.', 'derivadoslacteos.jpg'),
(3, 'Bebidas', 'Gloria con un Plan para Democratizar las Proteínas en el Perú.', 'bebidas.jpg'),
(4, 'Alimentos', 'Lo mejor ahora acompaña en la mesa', 'alimentos.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `asunto` varchar(300) COLLATE utf8_spanish2_ci NOT NULL,
  `mensaje` varchar(1000) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id`, `nombre`, `apellido`, `email`, `asunto`, `mensaje`) VALUES
(2, 'fernando', 'ruiz', 'fernando@gmail.com', 'productos', 'el producto llego en mal estado '),
(3, 'fernando', 'ruiz', 'fernando@gmail.com', 'productos', 'en mal estado del producto chancado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cupones`
--

CREATE TABLE `cupones` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `status` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `valor` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_vencimiento` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cupones`
--

INSERT INTO `cupones` (`id`, `codigo`, `status`, `tipo`, `valor`, `fecha_vencimiento`) VALUES
(2, '15107', 'utilizado', 'porcentaje', '8', '2021-01-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envios`
--

CREATE TABLE `envios` (
  `id_envio` int(11) NOT NULL,
  `pais` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `company` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `cp` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `id_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `envios`
--

INSERT INTO `envios` (`id_envio`, `pais`, `company`, `direccion`, `estado`, `cp`, `id_venta`) VALUES
(3, '15', 'embutidos fernando', 'av.los sauces mzlote 17a', 'ate', '+51', 2),
(4, '15', 'Marisol SAC', 'Los sauces', 'Lima/Santa Anita', '+51', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `metodo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `id_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `metodo`, `id_venta`) VALUES
(2, 'paypal', 2),
(3, 'paypal', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `precio` double(10,0) NOT NULL,
  `imagen` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `inventario` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `imagen`, `inventario`, `id_categoria`) VALUES
(1, 'Leche Evaporada Entera Gloria Pack de 6 unid Lata 400 gr', 'Enriquecida con vitaminas A y D  - Sin preservantes', 19, '1609712727.jpg', 100, 1),
(2, 'Mantequilla Laive Con Sal Barra 200 g', 'Mantequilla Laive Con Sal Barra 200 g', 8, '1609712912.jpg', 100, 2),
(3, 'Yogurt Acti Bio Gloria Fresa Botella 1 Kg', '0% grasa y endulzado parcialmente con stevia. Ideal para regular el transito intestinal.', 6, '1609713091.jpg', 100, 2),
(4, 'Yogurt Acti Bio Gloria Vainilla Botella 1 L', '0% grasa y endulzado parcialmente con stevia. Ideal para regular el transito intestinal.', 6, '1609713150.jpg', 100, 2),
(5, 'Yogurt Parcialmente Descremado Sin Lactosa Fresa Gloria Botella 1 kg', 'deslactosado  - Sabor: Fresa  - Con probiÃ³ticos', 6, '1609713208.jpg', 100, 2),
(6, 'Yogurt Griego Gloria con Miel y Granola Vaso 115 g', 'Yogurt Griego Gloria con Miel y Granola Vaso 115 g', 4, '1609713321.jpg', 100, 2),
(7, 'Yogurt Descremado Edulcorado Fresa Slim Gloria Botella 1 kg', 'Sabor: Fresa  - 0% grasas trans  - Sin azÃºcares aÃ±adidos  Con vitaminas D y E', 5, '1609713378.jpg', 100, 2),
(8, 'Queso Fresco Gloria x kg', 'Queso Fresco Gloria x kg', 31, '1609713484.jpg', 100, 2),
(9, 'Leche Evaporada Sin Lactosa Laive Six Pack de 350 g c/u', 'Leche Evaporada Sin Lactosa Laive Six Pack de 350 g c/u', 19, '1609713602.jpg', 100, 1),
(10, 'Leche UHT Gloria Light Caja 1 L', 'Leche UHT Gloria Light Caja 1 L', 5, '1609713678.jpg', 100, 1),
(11, 'Leche Semidescremada Laive Sin Lactosa Pack 4 Unid x 1 L', 'Leche Semidescremada Laive Sin Lactosa Pack 4 Unid x 1 L', 17, '1609713724.jpg', 100, 1),
(12, 'Leche Semidescremada UHT Gloria Sin Lactosa Caja 1 L', 'Leche Semidescremada UHT Gloria Sin Lactosa Caja 1 L', 5, '1609713768.jpg', 100, 1),
(13, 'Leche Evaporada Semidescremada Light Gloria Pack de 6 unid Lata 400 gr', 'Light: Reducida en grasa  - con vitaminas A y D', 21, '1609713813.jpg', 100, 1),
(14, 'Leche Evaporada Entera Gloria Lata 400 gr', '- Contenido de 400 gramos  - Leche evaporada entera  - Enriquecida con vitaminas A y D  - Sin preservantes', 3, '1609713870.jpg', 100, 1),
(15, 'Leche Concentrada Sin Lactosa Gloria Pack de 6 unid Lata 400 gr', 'Leche concentrada 66% sin lactosa  - Enriquecida con vitaminas A y D', 21, '1609713923.jpg', 100, 1),
(16, 'Leche Chocolatada Sin Lactosa Laive UHT Caja 1 Litro', 'Leche Chocolatada Sin Lactosa Laive UHT Caja 1 Litro', 5, '1609713977.jpg', 100, 1),
(17, 'Leche Evaporada Semidescremada Light Gloria Lata 400 gr', 'Light: Reducida en grasa  - Enriquecida con vitaminas A y D  - Sin preservantes', 4, '1609714023.jpg', 100, 1),
(18, 'Leche Evaporada Light Cuisine & Co Lata 410 gr', '- Contenido de 410 mililitros - Origen: Alemania', 3, '1609714125.jpg', 100, 1),
(19, 'Bebida Rehidratante Gatorade Pack 6 Unid x 500 ml', 'Bebida Rehidratante Gatorade Pack 6 Unid x 500 ml', 12, '1609714469.jpg', 5000, 3),
(20, 'Bebida Rehidratante Sporade Tropical Botella 500 ml', 'Bebida Rehidratante Sporade Tropical Botella 500 ml', 2, '1609714521.jpg', 1000, 3),
(21, 'Agua Sin Gas Cielo Botella Deportiva 1 L', 'Agua Sin Gas Cielo Botella Deportiva 1 L', 2, '1609714578.jpg', 1000, 3),
(22, 'Mix de Gaseosas: Coca Cola + Inca Kola Botella 3 Lt', 'Bebida gasificada  - TamaÃ±o familiar - Contiene cafeÃ­na', 19, '1609714629.jpg', 1000, 3),
(23, 'Bebida de Durazno Frugos del Valle Cj 1.5 Lt', 'Con vitaminas A, C y D - Sabor: Durazno  - 40% reducida en azÃºcar', 6, '1609714736.jpg', 1000, 3),
(24, 'Gaseosa Coca Cola Botella 3 Lt Pack de 2 unid', 'Bebida gasificada  - TamaÃ±o familiar - Contiene cafeÃ­na', 19, '1609714780.jpg', 1000, 3),
(25, 'Gaseosa Sprite Botella 500 ml', 'Gaseosa Sprite Botella 500 ml', 2, '1609714840.jpg', 1000, 3),
(26, 'Gaseosa Fanta Botella 500 ml', 'Gaseosa Fanta Botella 500 ml', 2, '1609714893.jpg', 1000, 3),
(27, 'Agua Sin Gas San Luis Botella 1 Litro', 'Agua Sin Gas San Luis Botella 1 Litro', 2, '1609714988.jpg', 1000, 3),
(28, 'Jugo de Naranja Con Calcio Florida Natural Caja 1.5 lt', 'Jugo de Naranja Con Calcio Florida Natural Caja 1.5 lt', 18, '1609715302.jpg', 994, 3),
(29, 'Bebida Rehidratante Gatorade Tropical Pack 4 Botellas de 750 ml c/u', 'Bebida Rehidratante Gatorade Tropical Pack 4 Botellas de 750 ml c/u', 13, '1609715392.jpg', 1000, 3),
(30, 'Gaseosa Sabor PiÃ±a Concordia Pack 6 Botellas de 500 ml c/u', 'Gaseosa Sabor PiÃ±a Concordia Pack 6 Botellas de 500 ml c/u', 9, '1609715437.jpg', 994, 3),
(31, 'Sal de Mesa Marina Emsal Bolsa 1 kg', 'Sal de Mesa Marina Emsal Bolsa 1 kg', 2, '1609715589.jpg', 1000, 4),
(32, 'Galletas Vainilla Field Pack 6 Unid x 37 g', 'Galletas Vainilla Field Pack 6 Unid x 37 g', 3, '1609715665.jpg', 1000, 4),
(33, 'Galletas San Jorge Soda Pack 7 Unidades', 'Galletas San Jorge Soda Pack 7 Unidades', 2, '1609715711.jpg', 1000, 4),
(34, 'Galletas Soda Field Pack 6 Unid x 34 g', 'Galletas Soda Field Pack 6 Unid x 34 g', 2, '1609715752.jpg', 1000, 4),
(35, 'Spaguetti Don Vittorio Paquete 1 Kg', 'Spaguetti Don Vittorio Paquete 1 Kg', 5, '1609715857.jpg', 1000, 4),
(36, 'Cabello de Ãngel Don Vittorio Bolsa 250 g', 'Cabello de Ãngel Don Vittorio Bolsa 250 g', 2, '1609715906.jpg', 1000, 4),
(37, 'Lenteja CosteÃ±o Bolsa 500 g', 'Lenteja CosteÃ±o Bolsa 500 g', 5, '1609715984.jpg', 1000, 4),
(38, 'Arroz Extra CosteÃ±o Bolsa 5 Kg', 'Arroz Extra CosteÃ±o Bolsa 5 Kg', 19, '1609716092.jpg', 1000, 4),
(39, 'Harina Blanca Flor Sin Preparar Bolsa 1 kg', 'Harina Blanca Flor Sin Preparar Bolsa 1 kg', 6, '1609716164.jpg', 1000, 4),
(40, 'Trozos de AtÃºn Primor Lata 170 g', 'Alto contenido de proteÃ­na- Baja en grasa- Aceite puro y natural- PresentaciÃ³n en lata', 4, '1609716235.jpg', 999, 4),
(41, 'Leche Condensada NestlÃ© Lata 393 g', 'Parcialmente descremada- Producto lÃ¡cteo- Ideal en la preparaciÃ³n de postres', 5, '1609716313.jpg', 1000, 4),
(42, 'Mayonesa A La Cena Doy Pack C/Tapa 475 g', 'Mayonesa A La Cena Doy Pack C/Tapa 475 g', 7, '1609716593.jpg', 1000, 4),
(43, 'Yogurt Parcialmente Descremado Fresa Gloria Galonera 1.9 kg', 'Con zinc y vitaminas A y D', 9, '1609716779.jpg', 1000, 2),
(44, 'Yogurt Bio Laive Natural Botella 1 Kg', 'con cultivos probiÃ³ticos.', 5, '1609716872.jpg', 985, 2),
(45, 'Yogurt Frutado Danlac Fresa Botella 900 g', 'Trozos de fresa- No contiene grasas vegetales- Mantener refrigerado\r\n', 9, '1609716939.jpg', 1000, 2),
(46, ' Yogurt Griego Laive con trozos de Blueberry Vaso 120 g', ' Yogurt Griego Laive con trozos de Blueberry Vaso 120 g', 2, '1609717007.jpg', 990, 2),
(47, 'Yogurt Griego Vakimu Frutos del Bosque 1 Kg', 'Yogurt Griego Vakimu Frutos del Bosque 1 Kg', 15, '1609717158.jpg', 998, 2),
(48, 'Leche Entera UHT Gloria Caja 1 L', 'Leche Entera UHT Gloria Caja 1 L', 4, '1609717360.jpg', 957, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_venta`
--

CREATE TABLE `productos_venta` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` double NOT NULL,
  `precio` double NOT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos_venta`
--

INSERT INTO `productos_venta` (`id`, `id_venta`, `id_producto`, `cantidad`, `precio`, `subtotal`) VALUES
(4, 2, 48, 4, 4, 16),
(5, 2, 28, 4, 18, 72),
(6, 3, 48, 4, 4, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `telefono` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `img_perfil` varchar(300) NOT NULL,
  `nivel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `telefono`, `email`, `password`, `img_perfil`, `nivel`) VALUES
(1, 'Danilo Porras', '987654321', 'danilo@gmail.com', 'a95413d225237417f132200c9772bd22583ab838', 'default.jpg', 'admin'),
(2, 'Anibal Fernandez', '987654321', 'anibal@gmail.com', 'bc49b7a53d0ee3b3223b8bde7f4facb58529ad08', 'default.jpg', 'admin'),
(5, 'Marisol Fernandez', '987654312', 'marisolfernandez95@gmail.com', '504fccf51fac59b9bd0d77234074906bed893a2a', 'default.jpg', 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `total` double NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) NOT NULL,
  `id_pago` int(11) NOT NULL,
  `id_cupon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `id_usuario`, `total`, `fecha`, `status`, `id_pago`, `id_cupon`) VALUES
(2, 4, 88, '2021-01-08 15:01:10', 'PreparaciÃ³n', 0, 2),
(3, 5, 16, '2021-02-13 08:02:42', 'PreparaciÃ³n', 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cupones`
--
ALTER TABLE `cupones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `envios`
--
ALTER TABLE `envios`
  ADD PRIMARY KEY (`id_envio`);

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
-- Indices de la tabla `productos_venta`
--
ALTER TABLE `productos_venta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cupones`
--
ALTER TABLE `cupones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `envios`
--
ALTER TABLE `envios`
  MODIFY `id_envio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `productos_venta`
--
ALTER TABLE `productos_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
