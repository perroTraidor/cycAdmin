-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-10-2024 a las 08:16:15
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
  `numero` int(8) NOT NULL DEFAULT 0,
  `fecha` date NOT NULL,
  `neto` decimal(12,2) NOT NULL DEFAULT 0.00,
  `iva21` decimal(12,2) NOT NULL DEFAULT 0.00,
  `exento` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total` decimal(12,2) NOT NULL DEFAULT 0.00,
  `saldo` decimal(12,2) NOT NULL,
  `obs` varchar(200) DEFAULT NULL,
  `proveedores_id_prov` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `letra`, `suc`, `numero`, `fecha`, `neto`, `iva21`, `exento`, `total`, `saldo`, `obs`, `proveedores_id_prov`) VALUES
(1, 1, 8, 1258, '2024-07-18', 150.00, 12.00, 1.00, 163.00, 0.00, 'niinguna', 1),
(2, 3, 19, 546578, '2024-05-13', 1500.00, 500.00, 0.00, 2000.00, 0.00, 'nada', 1),
(3, 8, 654, 164354, '2024-05-22', 13000.00, 7500.00, 8.00, 20508.00, 20508.00, 'nada que aportar', 4),
(4, 5, 1985, 46464, '2024-02-15', 25000.00, 12000.00, 0.00, 31000.00, 0.00, 'Si si', 5),
(5, 2, 98, 98989, '2024-08-06', 9879.00, 98799.00, 98799.00, 98798.00, 0.00, 'kjeh', 12),
(6, 1, 87, 8798, '2024-08-02', 879.00, 798.00, 987.00, 696.00, 0.00, 'kjg', 1),
(7, 3, 87987, 9879, '2024-08-01', 7987.00, 9879.00, 9879.00, 6786.00, 0.00, 'jhg', 2),
(8, 2, 7, 9879, '2024-08-07', 98.00, 987.00, 987.00, 789.00, 0.00, 'khg', 4),
(9, 1, 122, 32344, '2024-09-11', 34444300.00, 3222.00, 0.00, 323333.00, 0.00, 'qhy', 2),
(10, 0, 34, 343, '2024-09-03', 343.00, 34.00, 34.00, 343.00, 0.00, NULL, 2),
(11, 0, 5, 5555, '2024-09-05', 1.00, 1.00, 1.00, 5555.00, 0.00, NULL, 2),
(17, 2, 222, 2222, '2024-09-04', 222.00, 22.00, 222.00, 22222.00, 0.00, 'agg', 11),
(24, 3, 33, 33, '2024-09-03', 33.00, 33.00, 333.00, 33333.00, 0.00, 'lk', 2),
(25, 5, 98, 6787, '2024-08-07', 982.00, 876.00, 0.00, 5765.00, 0.00, 'isslkdjtl', 2),
(26, 2, 15, 15352, '2024-05-01', 15355.00, 553521.00, 15.00, 351354.00, 0.00, 'prueba', 2),
(27, 2, 151, 3515, '2024-08-15', 651.00, 651.00, 657.00, 65755.00, 65755.00, 'Ovs', 2),
(28, 2, 15, 15, '2023-12-15', 15588.00, 151.00, 8.00, 12545.50, 0.00, 'decimales d', 2),
(29, 5, 651, 15615, '2023-04-12', 554444.00, 65465.00, 88887.00, 8798790.00, 0.00, 'saglkn', 2),
(30, 2, 312, 152458, '2023-05-01', 615551.00, 61516.00, 8888.00, 15151.00, 0.00, 'ovs', 3),
(31, 1, 65, 64545, '2023-10-01', 155455.00, 321.28, 16.60, 12321.50, 11792.58, 'Pago a cuenta', 13),
(32, 1, 54, 15424, '2024-08-15', 15246.00, 1542.00, 72.20, 645.58, 0.00, 'Pago a cuenta', 2),
(33, 2, 22, 232, '2024-09-15', 5454.32, 1145.41, 0.00, 6599.73, 6599.73, '', 2);

--
-- Disparadores `compras`
--
DELIMITER $$
CREATE TRIGGER `saldo_nuevo` BEFORE INSERT ON `compras` FOR EACH ROW SET NEW.saldo = NEW.total
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imputaciones_compras`
--

CREATE TABLE `imputaciones_compras` (
  `id` int(11) NOT NULL,
  `nro_op` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `factura_id` int(11) NOT NULL,
  `importe_imp` decimal(12,2) NOT NULL,
  `fecha_imp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `imputaciones_compras`
--

INSERT INTO `imputaciones_compras` (`id`, `nro_op`, `proveedor_id`, `factura_id`, `importe_imp`, `fecha_imp`) VALUES
(1, 52, 2, 27, 1000.00, '2024-10-03 03:00:00'),
(2, 52, 2, 33, 87.78, '2024-10-03 03:00:00'),
(3, 53, 13, 31, 528.92, '2024-10-03 03:00:00');

--
-- Disparadores `imputaciones_compras`
--
DELIMITER $$
CREATE TRIGGER `restar_saldo_factura` AFTER INSERT ON `imputaciones_compras` FOR EACH ROW UPDATE compras
    SET saldo = saldo - NEW.importe_imp
    WHERE id = NEW.factura_id
$$
DELIMITER ;

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
(1, 'pago', 0, 1, 54, '2024-10-03 03:09:23', 'op principal'),
(2, 'venta', 1, 1, 1, '2024-09-16 01:05:42', 'factura principal'),
(3, 'recibo', 0, 1, 1, '2024-09-16 01:05:42', 'recibo principal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `op`
--

CREATE TABLE `op` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL DEFAULT 0,
  `fechaop` date NOT NULL,
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
(22, 7, '2024-09-16', 'efe', 852.37, 2),
(25, 8, '2024-08-15', 'efe', 158124, 2),
(26, 9, '2024-08-15', 'ech', 500.58, 2),
(27, 10, '2024-09-11', '', 6486630, 2),
(28, 11, '2024-09-21', '', 206566, 2),
(29, 12, '2024-09-21', '', 95512.1, 2),
(30, 13, '2024-09-21', '', 111641, 2),
(31, 14, '2024-09-21', '', 4221.99, 2),
(32, 15, '2024-09-23', '', 0, 2),
(33, 15, '2024-09-23', '', 0, 2),
(34, 15, '2024-09-23', '', 0, 2),
(35, 15, '2024-09-23', '', 0, 2),
(36, 15, '2024-09-23', '', 0, 2),
(37, 20, '2024-09-24', '', 0, 2),
(38, 20, '2024-09-24', '', 0, 2),
(39, 20, '2024-09-24', '', 0, 2),
(40, 20, '2024-09-24', '', 0, 2),
(41, 20, '2024-09-24', '', 0, 2),
(42, 25, '2024-09-24', '', 0, 2),
(43, 25, '2024-09-24', '', 0, 2),
(44, 25, '2024-09-24', '', 0, 2),
(45, 28, '2024-09-27', '', 6743, 1),
(46, 28, '2024-09-27', '', 6743, 1),
(47, 28, '2024-09-27', '', 6743, 1),
(48, 28, '2024-09-27', '', 6743, 1),
(49, 32, '2024-09-27', '', 77134.3, 2),
(50, 32, '2024-09-27', '', 77134.3, 2),
(51, 32, '2024-09-27', '', 77134.3, 2),
(52, 32, '2024-09-27', '', 77134.3, 2),
(53, 32, '2024-09-27', '', 77134.3, 2),
(54, 32, '2024-09-27', '', 77134.3, 2),
(55, 38, '2024-09-27', '', 752274, 2),
(56, 39, '2024-09-27', '', 86326.2, 3),
(57, 40, '2024-09-27', 'efe', 1153.2, 1),
(58, 40, '2024-09-27', 'tra', 1544.45, 1),
(59, 40, '2024-09-27', 'che', 12612.6, 1),
(60, 40, '2024-09-27', '', 0, 1),
(61, 44, '2024-09-27', 'efe', 150.15, 1),
(62, 44, '2024-09-27', 'tra', 250.15, 1),
(63, 44, '2024-09-27', '', 0, 1),
(64, 47, '2024-09-27', 'efe', 158.75, 2),
(65, 47, '2024-09-27', 'tra', 135.53, 2),
(66, 47, '2024-09-27', 'che', 1212.01, 2),
(67, 50, '2024-09-27', 'efe', 152.57, 1),
(68, 50, '2024-09-27', 'tra', 5675.75, 1),
(69, 50, '2024-09-27', 'che', 65747.5, 1),
(70, 50, '2024-09-27', 'efe', 152.57, 1),
(71, 50, '2024-09-27', 'tra', 5675.75, 1),
(72, 50, '2024-09-27', 'che', 65747.5, 1),
(73, 51, '2024-09-27', 'efe', 6547.12, 2),
(74, 51, '2024-09-27', 'tra', 657.57, 2),
(75, 51, '2024-09-27', 'che', 6327.27, 2),
(76, 52, '2024-10-03', 'efe', 150.2, 2),
(77, 52, '2024-10-03', 'tra', 170.4, 2),
(78, 52, '2024-10-03', 'che', 767.18, 2),
(79, 53, '2024-10-03', 'efe', 150, 13),
(80, 53, '2024-10-03', 'tra', 150, 13),
(81, 53, '2024-10-03', 'che', 228.92, 13);

--
-- Disparadores `op`
--
DELIMITER $$
CREATE TRIGGER `op_principal` AFTER INSERT ON `op` FOR EACH ROW UPDATE numeracion
    SET ultimo_numero = NEW.numero + 1,
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
  `prod_precio` decimal(12,2) NOT NULL,
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
(2, 'Saveiro SRL', 'Mamerto Essquiy 555', '342 55555444', '3050555555', 'assasadsf@assa.com.ar'),
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
  `alta` timestamp NULL DEFAULT current_timestamp(),
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `email`, `password`, `rol`, `alta`, `avatar`) VALUES
(1, 'german', 'germalksngQ@lskd.com', '$2y$10$cm1QL55Q7mSrY7xMlKpCb.VkVJVgo9TVYJSlUU1ItIkosS01KqypK', 'Administrador', '2024-09-04 02:31:45', ''),
(2, 'flavio', 'flavio@ekng.com', '$2y$10$DB422GWDIbTCNv/KRY1LkuzjY/1HGmDS/LFZSl7/bP.9esyebhuH6', 'Cliente', '2024-09-04 02:32:14', ''),
(3, 'palmira', 'palmira@lklk.com', '$2y$10$zsC.FKU.6QQl.USc51cLgORdoXJp5Pi4mRmj1E/FvkcF7bGsmKQCe', 'Proveedor', '2024-09-04 04:40:09', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valores_propios`
--

CREATE TABLE `valores_propios` (
  `id` int(11) NOT NULL,
  `banco` varchar(100) NOT NULL,
  `numero` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_op` int(11) NOT NULL,
  `fecha_p` date NOT NULL,
  `importe` decimal(12,2) NOT NULL,
  `estado` enum('Emitido','Pagado','Rechazado','') NOT NULL DEFAULT 'Emitido'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `valores_propios`
--

INSERT INTO `valores_propios` (`id`, `banco`, `numero`, `id_proveedor`, `id_op`, `fecha_p`, `importe`, `estado`) VALUES
(1, 'Santander', 545, 2, 54, '2024-09-24', 5575.54, 'Emitido'),
(2, 'HSBC', 654, 2, 54, '2024-09-23', 657.77, 'Emitido'),
(3, 'Santander', 44, 2, 55, '2024-10-08', 58875.98, 'Emitido'),
(4, 'HSBC', 547, 2, 55, '2024-09-24', 654869.13, 'Emitido'),
(5, 'Nacion', 4, 2, 55, '2024-10-23', 33754.55, 'Emitido'),
(6, 'Macro', 6547, 3, 56, '2024-09-09', 6575.57, 'Emitido'),
(7, 'asdf', 6547, 3, 56, '2024-09-09', 66657.77, 'Emitido'),
(8, 'Santander', 54, 1, 59, '2024-10-01', 4754.75, 'Pagado'),
(9, 'Nacion', 57, 1, 59, '2024-09-09', 7857.85, 'Pagado'),
(10, 'Santander', 57, 2, 66, '2024-09-02', 666.44, 'Emitido'),
(11, 'Nacion', 7, 2, 66, '2024-10-31', 545.57, 'Pagado'),
(12, 'Santander', 66, 1, 69, '2024-09-09', 65747.47, 'Pagado'),
(13, 'Santander', 66, 1, 72, '2024-09-09', 65747.47, 'Emitido'),
(14, 'HSBC', 657, 2, 75, '2024-09-30', 6327.27, 'Pagado'),
(15, 'Santander', 15, 2, 78, '2024-10-07', 177.85, 'Pagado'),
(16, 'HSBC', 12, 2, 78, '2024-10-15', 589.33, 'Emitido'),
(17, 'Santander', 8, 13, 81, '2024-10-16', 120.15, 'Emitido'),
(18, 'Nacion', 10, 13, 81, '2024-10-24', 108.77, 'Emitido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `neto` decimal(12,2) NOT NULL DEFAULT 0.00,
  `iva21` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total` decimal(12,2) NOT NULL DEFAULT 0.00,
  `fecha` date NOT NULL,
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
  `precio` decimal(12,2) DEFAULT NULL
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
-- Indices de la tabla `imputaciones_compras`
--
ALTER TABLE `imputaciones_compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_op` (`nro_op`),
  ADD KEY `fk_facturaid` (`factura_id`);

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
-- Indices de la tabla `valores_propios`
--
ALTER TABLE `valores_propios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_proveedor` (`id_proveedor`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `imputaciones_compras`
--
ALTER TABLE `imputaciones_compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `numeracion`
--
ALTER TABLE `numeracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `op`
--
ALTER TABLE `op`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

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
-- AUTO_INCREMENT de la tabla `valores_propios`
--
ALTER TABLE `valores_propios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
-- Filtros para la tabla `imputaciones_compras`
--
ALTER TABLE `imputaciones_compras`
  ADD CONSTRAINT `fk_facturaid` FOREIGN KEY (`factura_id`) REFERENCES `compras` (`id`);

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
