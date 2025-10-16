-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-09-2024 a las 08:10:33
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
-- Base de datos: `compras_ventas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `domicilio` varchar(200) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `cuit` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `domicilio`, `telefono`, `cuit`) VALUES
(1, 'Marcelo Iripino', 'Las Toscas 5676', '342 45654544', '20202055045'),
(2, 'Ricardo Iorio', 'Mamerto 5245', '342 44556578', '32545657864'),
(3, 'Tererife Antonini', 'Los Lirios 555', '341 65467485', '32469857574'),
(4, 'Raul Canchero', 'Sinestesia Roman 888', '341 65465755', '35275698756');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `letra` int(1) NOT NULL DEFAULT 1,
  `suc` int(4) NOT NULL DEFAULT 1,
  `numero` int(8) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `neto` float NOT NULL DEFAULT 0,
  `iva21` float NOT NULL DEFAULT 0,
  `exento` float NOT NULL DEFAULT 0,
  `total` float NOT NULL DEFAULT 0,
  `obs` varchar(200) DEFAULT NULL,
  `proveedores_id_prov` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `letra`, `suc`, `numero`, `fecha`, `neto`, `iva21`, `exento`, `total`, `obs`, `proveedores_id_prov`) VALUES
(1, 1, 8, 1258, '2024-07-18', 150, 12, 1, 163, 'niinguna', 1),
(2, 3, 19, 546578, '2024-05-13', 1500, 500, 0, 2000, 'nada', 1),
(3, 8, 654, 164354, '2024-05-22', 13000, 7500, 8, 20508, 'nada que aportar', 4),
(4, 5, 1985, 46464, '2024-02-15', 25000, 12000, 0, 31000, 'Si si', 5),
(5, 2, 98, 98989, '2024-08-06', 9879, 98799, 98799, 98798, 'kjeh', 12),
(6, 1, 87, 8798, '2024-08-02', 879, 798, 987, 696, 'kjg', 1),
(7, 3, 87987, 9879, '2024-08-01', 7987, 9879, 9879, 6786, 'jhg', 2),
(8, 2, 7, 9879, '2024-08-07', 98, 987, 987, 789, 'khg', 4),
(9, 1, 122, 32344, '2024-09-11', 34444300, 3222, 0, 323333, 'qhy', 2),
(10, 0, 34, 343, '2024-09-03', 343, 34, 34, 343, NULL, 2),
(11, 0, 5, 5555, '2024-09-05', 1, 1, 1, 5555, NULL, 2),
(17, 2, 222, 2222, '2024-09-04', 222, 22, 222, 22222, 'agg', 11),
(24, 3, 33, 33, '2024-09-03', 33, 33, 333, 33333, 'lk', 2),
(25, 5, 98, 6787, '2024-08-07', 982, 876, 0, 5765, 'isslkdjtl', 2),
(26, 2, 15, 15352, '2024-05-01', 15355, 553521, 15, 351354, 'prueba', 2),
(27, 2, 151, 3515, '0000-00-00', 651, 651, 657, 65755, 'Ovs', 2),
(28, 2, 15, 15, '2023-12-15', 15588, 151, 8, 12545.5, 'decimales d', 2),
(29, 5, 651, 15615, '2023-04-12', 554444, 65465, 88887, 8798790, 'saglkn', 2),
(30, 2, 312, 152458, '2023-05-01', 615551, 61516, 8888, 15151, 'ovs', 3),
(31, 1, 65, 64545, '2023-10-01', 155455, 321.28, 16.6, 12321.5, 'Pago a cuenta', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `numeracion`
--

CREATE TABLE `numeracion` (
  `id` int(11) NOT NULL,
  `tipo` enum('venta','recibo','pago','remito') NOT NULL,
  `letra` int(11) NOT NULL DEFAULT 0,
  `suc` int(11) NOT NULL,
  `ultimo_numero` int(11) NOT NULL,
  `actualizado` datetime NOT NULL DEFAULT current_timestamp(),
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `numeracion`
--

INSERT INTO `numeracion` (`id`, `tipo`, `letra`, `suc`, `ultimo_numero`, `actualizado`, `descripcion`) VALUES
(1, 'pago', 0, 1, 8, '2024-09-16 03:08:00', 'op principal'),
(2, 'venta', 1, 1, 1, '2024-09-16 01:05:42', 'factura principal'),
(3, 'recibo', 0, 1, 1, '2024-09-16 01:05:42', 'recibo principal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `op`
--

CREATE TABLE `op` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL DEFAULT 0,
  `fechaop` date NOT NULL DEFAULT current_timestamp(),
  `forma` varchar(45) NOT NULL,
  `importe` float NOT NULL,
  `proveedores_id_prov` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `op`
--

INSERT INTO `op` (`id`, `numero`, `fechaop`, `forma`, `importe`, `proveedores_id_prov`) VALUES
(1, 1, '2024-09-03', 'efctivo', 508, 2),
(2, 2, '2024-09-03', 'tarjeta', 500, 1),
(3, 3, '2024-09-03', 'transferencia', 1200, 4),
(4, 4, '2024-09-03', 'efectivo', 420, 4),
(5, 5, '2024-08-13', 'ef', 3463, 2),
(6, 6, '2024-06-12', 'ef', 3455, 2),
(7, 7, '2024-05-23', 'ef', 3333, 2),
(8, 8, '2024-09-04', 'ef', 87667, 2),
(14, 14, '2024-06-01', 'efe', 565.54, 13),
(15, 15, '2024-04-15', 'che', 58012.3, 1),
(16, 0, '2024-09-16', 'efe', 154.28, 2),
(17, 0, '2024-09-16', 'ech', 8885.87, 2),
(18, 0, '2024-08-15', 'che', 12528.8, 13),
(19, 0, '2024-08-15', 'che', 12426.8, 5),
(20, 0, '2024-09-05', 'che', 1525.12, 5),
(21, 0, '2024-09-15', 'efe', 15258.2, 5),
(22, 7, '2024-09-16', 'efe', 852.37, 2);

--
-- Disparadores `op`
--
DELIMITER $$
CREATE TRIGGER `op_principal` AFTER INSERT ON `op` FOR EACH ROW UPDATE numeracion
SET ultimo_numero = ultimo_numero + 1,
    actualizado = NOW()
WHERE tipo = 'pago' AND suc = '1'
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID_producto` int(10) UNSIGNED NOT NULL,
  `prod_nombre` varchar(200) NOT NULL,
  `prod_detalle` mediumtext NOT NULL,
  `prod_alta` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `prod_precio` float UNSIGNED NOT NULL,
  `prod_estado` enum('activo','inactivo') NOT NULL DEFAULT 'activo',
  `productoscol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `domicilio` varchar(200) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `cuit` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `domicilio`, `telefono`, `cuit`, `email`) VALUES
(1, 'Mamerto SA', 'juan larrechea 1520', '362 54545454', '30709129321', 'kñlndsgns sljkhy'),
(2, 'Saveiro SRL', 'Mamerto Essquiy 555', '342 55555444', '', 'assasadsf@assa.com'),
(3, 'Niquelodion SAS', 'Rodrigo Casamberry 1212', '342 55654656354', '33333111121', 'fgjh'),
(4, 'Raspberry SRL', 'Californian dock2456', '+54 9 342 55 54654', '32165435432', ''),
(5, 'Nicanorche SA', 'Simplescu Mz8', '342 4722225', '28000035546', 'asfdgh'),
(10, 'Este es un nuevo proveedor', 'Las casa de pepe', '342 5065198651', '3210065456', ''),
(11, 'Seguros Metal Press', 'Cangallo 1212', '342 154754654', '1254564312', ''),
(12, 'Zapatos', 'La cuna del mono', '209756098 35097', '0970987097', 'lksjt kgf'),
(13, 'Lara Inc', 'Matanga 288', '09840984098', '0984098', 'lara@lkjs.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('Administrador','Cliente','Proveedor','Inactivo') NOT NULL DEFAULT 'Cliente',
  `alta` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `email`, `password`, `rol`, `alta`) VALUES
(1, 'german', 'germalksngQ@lskd.com', '$2y$10$cm1QL55Q7mSrY7xMlKpCb.VkVJVgo9TVYJSlUU1ItIkosS01KqypK', 'Administrador', '2024-09-04 02:31:45'),
(2, 'flavio', 'flavio@ekng.com', '$2y$10$DB422GWDIbTCNv/KRY1LkuzjY/1HGmDS/LFZSl7/bP.9esyebhuH6', 'Cliente', '2024-09-04 02:32:14'),
(3, 'palmira', 'palmira@lklk.com', '$2y$10$zsC.FKU.6QQl.USc51cLgORdoXJp5Pi4mRmj1E/FvkcF7bGsmKQCe', 'Proveedor', '2024-09-04 04:40:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `neto` float NOT NULL DEFAULT 0,
  `iva21` float NOT NULL DEFAULT 0,
  `total` float NOT NULL DEFAULT 0,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `obs` varchar(200) DEFAULT NULL,
  `letra` int(1) NOT NULL,
  `suc` int(4) NOT NULL,
  `numero` int(8) NOT NULL,
  `documentos_ventascol` varchar(45) DEFAULT NULL,
  `fk_id_cte` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_prod`
--

CREATE TABLE `ventas_prod` (
  `fk_id_venta` int(11) NOT NULL,
  `fk_id_producto` int(10) UNSIGNED NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cte_cuit_UNIQUE` (`cuit`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_documentos_compra_proveedores_idx` (`proveedores_id_prov`);

--
-- Indices de la tabla `numeracion`
--
ALTER TABLE `numeracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `op`
--
ALTER TABLE `op`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_op_proveedores1_idx` (`proveedores_id_prov`),
  ADD KEY `numero` (`numero`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID_producto`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cte_cuit_UNIQUE` (`cuit`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ventas_clientes1_idx` (`fk_id_cte`);

--
-- Indices de la tabla `ventas_prod`
--
ALTER TABLE `ventas_prod`
  ADD PRIMARY KEY (`fk_id_venta`,`fk_id_producto`),
  ADD KEY `fk_ventas_has_productos_productos1_idx` (`fk_id_producto`),
  ADD KEY `fk_ventas_has_productos_ventas1_idx` (`fk_id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `numeracion`
--
ALTER TABLE `numeracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `op`
--
ALTER TABLE `op`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID_producto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `fk_documentos_compra_proveedores` FOREIGN KEY (`proveedores_id_prov`) REFERENCES `proveedores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `op`
--
ALTER TABLE `op`
  ADD CONSTRAINT `fk_op_proveedores1` FOREIGN KEY (`proveedores_id_prov`) REFERENCES `proveedores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_ventas_clientes1` FOREIGN KEY (`fk_id_cte`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ventas_prod`
--
ALTER TABLE `ventas_prod`
  ADD CONSTRAINT `fk_ventas_has_productos_productos1` FOREIGN KEY (`fk_id_producto`) REFERENCES `productos` (`ID_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ventas_has_productos_ventas1` FOREIGN KEY (`fk_id_venta`) REFERENCES `ventas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
