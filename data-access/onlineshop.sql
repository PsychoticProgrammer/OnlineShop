-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-01-2024 a las 19:17:40
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `onlineshop`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `IdProducto` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE `detallepedido` (
  `IdPedido` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `IdProducto` int(11) NOT NULL,
  `Usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `Id` int(11) NOT NULL,
  `Provincia` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Ciudad` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Direccion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Cantidad` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Precio` decimal(7,2) NOT NULL,
  `UnidadesDisponibles` int(11) NOT NULL,
  `Imagen` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `Marca` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Descripcion` varchar(120) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`Id`, `Nombre`, `Cantidad`, `Precio`, `UnidadesDisponibles`, `Imagen`, `Marca`, `Descripcion`) VALUES
(61, 'Aceite La Favorita', '500 ml', '3.50', 1500, '/OnlineShop/products-images/aceite_la_favorita.jpg', 'La Favorita', 'Aceite de cocina hecho a base de Palma'),
(62, 'Aceite Alesol', '350 ml', '2.00', 2000, '/OnlineShop/products-images/aceite-alesol.jpg', 'Alesol', 'Aceite de cocina extraído de la Palma Ecuatoriana'),
(63, 'Aceite Oli', '750 ml', '5.50', 499, '/OnlineShop/products-images/aceite-oli.jpg', 'Oli', 'Aceite de cocina hecho a base de oliva'),
(64, 'Ají de Maracuyá Olé', '155 gr', '2.50', 1500, '/OnlineShop/products-images/aji-maracuya.jpg', 'Olé', 'Ají sazonado con maracuyá para un toque agriducle'),
(65, 'Atún Isabel', '350 gr', '1.60', 2000, '/OnlineShop/products-images/atun-isabel.jpg', 'Isabel', 'Atún rebanado bañado en aceite de girasol'),
(66, 'Atún Mr. Fish', '175 gr', '1.50', 2000, '/OnlineShop/products-images/atun-mr-fish.jpg', 'Mr. Fish', 'Atún rebanado bañado en aceite de girasol'),
(67, 'Atún Real', '180 gr', '1.20', 2000, '/OnlineShop/products-images/atun-real.webp', 'Real', 'Atún rabanado bañado en aceite de girasol'),
(68, 'Azúcar Morena San Carlos', '2 kg', '3.50', 1000, '/OnlineShop/products-images/azucar-morena-san-carlos.jpg', 'San Carlos', 'Azúcar de caña poco refinada ideal para endulzar tus comidas'),
(69, 'Azúcar Morena Valdez', '5 kg', '7.00', 500, '/OnlineShop/products-images/azucar-san-carlos.jpg', 'Valdez', 'Azúcar de caña poco refinada ideal para endulzar tus comidas'),
(70, 'Azúcar San Carlos', '500 gr', '1.00', 2500, '/OnlineShop/products-images/azucar-morena-san-carlos.jpg', 'San Carlos', 'Azúcar de caña refinada ideal para endulzar tus comidas'),
(71, 'Azúcar Valdez', '1 kg', '2.50', 1500, '/OnlineShop/products-images/azucar-valdez.jpg', 'Valdez', 'Azúcar de caña refinada ideal para endulzar tus comidas'),
(72, 'Salsa China de Soya', '300 gr', '3.50', 2500, '/OnlineShop/products-images/china-oriental.webp', 'Oriental', 'Salsa china de Soya extraida de los cultivos mas productivos en China'),
(73, 'Detergente Ciclón Líquido con Suavizante', '2000 ml', '7.20', 500, '/OnlineShop/products-images/ciclon-suavizante.webp', 'Ciclón', 'Detergente líquido para todo tipo de ropa, con un toque de suavizante'),
(74, 'Detergente Ciclón en Polvo con Suavizante', '320 gr', '0.75', 2350, '/OnlineShop/products-images/ciclon-suavizante-polvo.jpg', 'Ciclón', 'Detergente en polvo para todo tipo de ropa, con un toque de suavizante'),
(75, 'Colgate Luminous White', '170 gr', '3.50', 1500, '/OnlineShop/products-images/colgate-luminous-white.jpg', 'Colgate', 'Pasta de Dientes con especial acción blanqueadora'),
(76, 'Colgate Triple Acción', '125 ml', '1.75', 2500, '/OnlineShop/products-images/colgate-triple-accion.jpg', 'Colgate', 'Pasta de dientes con especial acción de limpieza'),
(77, 'Colgate Original', '150 ml', '1.50', 1750, '/OnlineShop/products-images/colgate.webp', 'Colgate', 'Pasta de dientes con sabor neutro e ideal para cualquiera'),
(78, 'Detergente Deja en Polvo Limón', '5 kg', '10.50', 750, '/OnlineShop/products-images/deja-limon.webp', 'Deja', 'Detergente en polvo con aroma a Limón'),
(79, 'Detergente Deja en Polvo Suavizante', '5 kg', '10.50', 500, '/OnlineShop/products-images/deja-suavizante.jpg', 'Deja', 'Detergente en polvo con un toque de suavizante'),
(80, 'Enjuague Bucal Gingivit', '500 ml', '2.75', 2500, '/OnlineShop/products-images/enjuage-bucal-gingivit.jpg', 'Gingivit', 'Enjuague bucal con doble acción de limpieza'),
(81, 'Queso Mascarpone Floralp', '200 gr', '2.50', 700, '/OnlineShop/products-images/floralp-mascarpone.jpg', 'Floralp', 'Queso listo para recetas de postres'),
(82, 'Fréjol Canario Facundo', '425 gr', '1.50', 1750, '/OnlineShop/products-images/frejol-facundo.png', 'Facundo', 'Fréjol en lata para menestra listo para preparar'),
(83, 'Menestra de Frejol Facundo', '425 gr', '2.25', 1560, '/OnlineShop/products-images/frejol-rojo-facundo.jpg', 'Facundo', 'Menestra de Fréjol lista para servir'),
(84, 'Harina Santa Lucía', '50 kg', '30.20', 100, '/OnlineShop/products-images/harina-santalucia.png', 'Santa Lucía', 'Harina de Trigo para todo tipo de preparación'),
(85, 'Harina YA', '5 kg', '2.65', 1500, '/OnlineShop/products-images/harina-ya.jpg', 'YA', 'Harina de Trigo lista para todo tipo de preparación'),
(86, 'Head & Shoulders Dermo Sensitive', '375 ml', '7.25', 750, '/OnlineShop/products-images/h-s-dermo.jpg', 'head & shoulders', 'Shampoo para cabello con ph balanceado'),
(87, 'Head & Shoulders Suave y Manejable', '375 ml', '7.25', 750, '/OnlineShop/products-images/h-s-suave.webp', 'head & shoulders', 'Shampoo para cabello con suavizante'),
(88, 'Salsa Inglesa McCormick', '175 ml', '2.75', 2500, '/OnlineShop/products-images/inglesa-mc-cormic.jpg', 'McCormick', 'Salsa inglesa para aderezo de todo plato'),
(89, 'Dove Delicious Care x4 Pack', '400 gr', '4.25', 700, '/OnlineShop/products-images/jabon-dove-coco.jpg', 'Dove', 'Pack de 4 jabones de 100gr aroma de leche de Coco'),
(90, 'Dove Revigorizante x4 Pack', '360 gr', '3.75', 1500, '/OnlineShop/products-images/jabon-dove-revigor.webp', 'Dove', 'Pack de 4 jabones de 90gr aroma revitalizante'),
(91, 'Dove Original', '90 gr', '1.05', 2500, '/OnlineShop/products-images/jabon-dove.avif', 'Dove', 'Dove con aroma original para limpieza del cuerpo'),
(92, 'Jolly Clásico', '100 ml', '1.50', 1500, '/OnlineShop/products-images/jabon-jolly.png', 'Jolly', 'Jabón de manos con aroma purificante'),
(93, 'Jolly Manzanilla', '100 ml', '1.50', 1500, '/OnlineShop/products-images/jabon-jolly-manzanilla.png', 'Jolly', 'Jabón de manos con aroma a manzanilla'),
(94, 'TRÜ Leche Entera', '1 lt', '1.12', 1500, '/OnlineShop/products-images/leche-tru.jpg', 'TRÜ', 'Leche envasada en tetrapack 100% ecoamigable'),
(95, 'Vita Leche Entera', '500 ml', '0.75', 2500, '/OnlineShop/products-images/leche-vita.jpg', 'Vita', 'Leche envasada en funda plástica'),
(96, 'Nutri Leche Entera', '1 lt', '1.16', 2600, '/OnlineShop/products-images/leche-nutri-tetra.webp', 'Nutri', 'Leche envasada en tetrapack'),
(97, 'Listerine Cuidado Total', '500 ml', '4.75', 1750, '/OnlineShop/products-images/listerine-cuidado-total.png', 'Listerine', 'Enjuague bucal con acción refrescante'),
(98, 'Facundo Maíz Dulce', '425 gr', '2.25', 750, '/OnlineShop/products-images/maiz-facundo.png', 'Facundo', 'Maíz dulce enlatado listo para servir'),
(99, 'Alacena Mayonesa', '400 gr', '4.50', 1000, '/OnlineShop/products-images/mayonesa-alacena.png', 'Alacena', 'Mayonesa natural preparada como hecha en casa'),
(100, 'Gustadina Mayonesa', '200 gr', '2.25', 1250, '/OnlineShop/products-images/mayonesa-gustadina.webp', 'Gustadina', 'Mayonesa lista para acompañar cualquier preparación'),
(101, 'Los Andes Mayonesa', '200 ml', '2.10', 1370, '/OnlineShop/products-images/mayonesa-los-andes.webp', 'Los Andes', 'Mayonesa natural preparada como hecha en casa'),
(102, 'Kiosko Queso Mozzarella', '500 gr', '3.50', 750, '/OnlineShop/products-images/mozarella-kiosko.jpg', 'Kiosko', 'Queso Mozzarella ideal para fundir'),
(103, 'Familia Papel Higiénico Megarollo', '4 Rollos', '4.50', 1000, '/OnlineShop/products-images/papel-higienico-familia.jpg', 'Familia', 'Papel Higiénico Megarollo acolchaMAX'),
(104, 'Hada Papel Higiénico Económico', '6 Rollos', '4.50', 2500, '/OnlineShop/products-images/papel-higienico-hada.jpg', 'Hada', 'Papel Higiénico económico doble hoja y extra perfume'),
(105, 'Scott Papel Higiénico Cuidado Completo', '4 Rollos', '3.75', 1500, '/OnlineShop/products-images/papel-higienico-scott.jpg', 'Scott', 'Papel Higiénico cuidado completo corta fácil'),
(106, 'Condimensa Paprika', '100 gr', '2.50', 2600, '/OnlineShop/products-images/paprika.jpg', 'Condimensa', 'Paprika ideal para carnes, mariscos y sopas'),
(107, 'Toni Queso Crema', '600 gr', '3.50', 2000, '/OnlineShop/products-images/queso-toni.jpg', 'Toni', 'Queso crema listo para untar'),
(108, 'Cris-Sal Sal de Mesa', '500 gr', '2.25', 1750, '/OnlineShop/products-images/sal-cris-sal.png', 'Cris-Sal', 'Sal yodada y fluorurada'),
(109, 'Condimensa Sal del Himalaya Molida', '900 gr', '3.50', 1000, '/OnlineShop/products-images/sal-himalaya.jpg', 'Condimensa', 'Sal del Himalaya Molida con oligoelementos'),
(110, 'Gustadina', '350 gr', '2.50', 2500, '/OnlineShop/products-images/salsa-bbq.jpg', 'Gustadina', 'Salsa BBQ ideal para ahumados y asados'),
(111, 'Gustadina Salsa Golf', '200 gr', '1.80', 2600, '/OnlineShop/products-images/salsa-golf.webp', 'Gustadina', 'Salsa rosa para acompañar cocteles'),
(112, 'Alacena Salsa de Tomate', '200 ml', '2.50', 1000, '/OnlineShop/products-images/salsa-tomate-alacena.webp', 'Alacena', 'Salsa de tomate con preparación casera'),
(113, 'Gustadina Salsa de Tomate', '200 ml', '3.25', 2500, '/OnlineShop/products-images/salsa-tomate-gustadina.webp', 'Gustadina', 'Salsa de tomate rica en elicopeno'),
(114, 'Los Andes Salsa de Tomate', '200 ml', '2.75', 2500, '/OnlineShop/products-images/salsa-tomate-los-andes.webp', 'Los Andes', 'Salsa de tomate sin preservantes ni colorantes'),
(115, 'Familia Servilletas Acolchamax', '250 hojas', '3.50', 1500, '/OnlineShop/products-images/servilleta-familia.png', 'Familia', 'Servilleta mediana acolchamax para uso en cocina'),
(116, 'Weir Cool Mint Enjuague Bucal', '250 ml', '4.50', 1000, '/OnlineShop/products-images/weir-cool-mint.jpg', 'Weir', 'Enjuague bucal de limpieza dental profunda'),
(117, 'Chivería Yogurt Natural', '1600 gr', '4.50', 2000, '/OnlineShop/products-images/yogurt-chiveria-clasico.jpg', 'Chivería', 'Yogurt natural libre de conservantes y colorantes artificiales'),
(118, 'Chivería Yogurt Durazno', '900 gr', '3.25', 2000, '/OnlineShop/products-images/yogurt-chiveria-durazno.jpg', 'Chivería', 'Yogurt de durazno libre de conservantes y colorantes artificiales'),
(119, 'Toni Yogurt Frutilla', '900 gr', '4.25', 2600, '/OnlineShop/products-images/yogurt-toni-fresa.jpg', 'Toni', 'Yogurt de frutilla libre de conservantes y colorantes artificiales'),
(120, 'Toni Yogurt Mora', '900 gr', '4.25', 2600, '/OnlineShop/products-images/yogurt-toni-mora.jpg', 'Toni', 'Yogurt de mora libre de conservantes y colorantes artificiales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Cedula` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Apellido` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `CorreoElectronico` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `TarjetaCredito` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `Contrasenia` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Cedula`, `Nombre`, `Apellido`, `CorreoElectronico`, `TarjetaCredito`, `Contrasenia`) VALUES
('1850062876', 'Juan', 'Espín', 'admin@admin.com', '000000000000000000', '$2y$10$9R76OV1aItHjJf222DfGVe8.tNRM9RTCjoFCIKRXeTAva8r8YYA12');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`CorreoElectronico`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
