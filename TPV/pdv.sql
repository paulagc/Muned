-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 12, 2018 at 11:58 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdv`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `categoriaID` int(10) NOT NULL,
  `nombre` char(20) NOT NULL,
  `tipo` char(16) NOT NULL,
  `imagen` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`categoriaID`, `nombre`, `tipo`, `imagen`) VALUES
(1, 'cerveza', 'bebida', 'cervezas.png'),
(3, 'bocadillos', 'comida', 'bocadillo.jpg'),
(5, 'patatas', 'comida', 'patatas-fritas.jpg'),
(7, 'vinos', 'bebida', 'vino-tinto.jpg'),
(9, 'cafes', 'bebida', 'cafe.png'),
(10, 'infusiones', 'bebida', 'infusion.jpg'),
(11, 'refrescos', 'bebida', 'bebidas.png'),
(12, 'platos combinados', 'comida', 'plato-combi.jpg'),
(13, 'sandwiches', 'comida', 'sandwich.jpg'),
(14, 'bolleria', 'comida', 'croissant.jpg'),
(15, 'raciones', 'comida', 'calamares.jpg'),
(16, 'aperitivos', 'comida', 'aceitunas.jpg'),
(17, 'menu del dia', 'comida', 'menudia.jpg'),
(18, 'helados', 'comida', 'helado.jpg'),
(19, 'cócteles', 'bebida', 'combinado.jpeg'),
(20, 'batidos', 'bebida', 'batidos.jpg'),
(21, 'desayunos', 'comida', 'desayunos.jpg'),
(24, 'agua', 'bebida', 'agua.jpg'),
(30, 'chocolates', 'bebida', 'chocolate.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `empleados`
--

CREATE TABLE `empleados` (
  `user` char(16) NOT NULL,
  `passwd` char(40) NOT NULL,
  `rol` char(16) NOT NULL,
  `nombre` char(40) NOT NULL,
  `dni` char(12) NOT NULL,
  `telefono` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `empleados`
--

INSERT INTO `empleados` (`user`, `passwd`, `rol`, `nombre`, `dni`, `telefono`) VALUES
('admin', 'admin0000', 'gerente', 'Paula Gonzalez', '7878978893', 666666666),
('pepe', 'camarero', 'camarero', 'pepelu', '424234g', 532525);

-- --------------------------------------------------------

--
-- Table structure for table `linea_venta`
--

CREATE TABLE `linea_venta` (
  `ventaID` int(10) UNSIGNED NOT NULL,
  `productoID` int(10) UNSIGNED NOT NULL,
  `precio` float NOT NULL,
  `iva` int(3) NOT NULL,
  `cantidad` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `linea_venta`
--

INSERT INTO `linea_venta` (`ventaID`, `productoID`, `precio`, `iva`, `cantidad`) VALUES
(31, 15, 1, 21, 1),
(31, 18, 1, 21, 1),
(31, 20, 0.95, 21, 2),
(32, 20, 0.95, 21, 1),
(33, 20, 0.95, 21, 1),
(33, 21, 1.1, 21, 1),
(34, 21, 1.1, 21, 1),
(34, 33, 8.75, 10, 1),
(35, 17, 2, 21, 1),
(35, 24, 1.7, 21, 2),
(50, 13, 1, 21, 13),
(50, 19, 2.5, 21, 2),
(50, 25, 1.8, 10, 13),
(51, 19, 2.5, 21, 1),
(52, 14, 1.2, 21, 1),
(53, 14, 1.2, 21, 1),
(53, 15, 1, 21, 1),
(54, 15, 1, 21, 2),
(55, 15, 1, 21, 1),
(56, 15, 1, 21, 1),
(57, 15, 1, 21, 1),
(58, 15, 1, 21, 1),
(59, 15, 1, 21, 1),
(60, 15, 1, 21, 1),
(61, 15, 1, 21, 1),
(62, 15, 1, 21, 1),
(63, 15, 1, 21, 1),
(64, 15, 1, 21, 1),
(65, 15, 1, 21, 1),
(66, 14, 1.2, 21, 1),
(67, 14, 1.2, 21, 1),
(68, 14, 1.2, 21, 2),
(69, 14, 1.2, 21, 1),
(70, 14, 1.2, 21, 1),
(71, 14, 1.2, 21, 1),
(72, 14, 1.2, 21, 1),
(73, 15, 1, 21, 1),
(74, 15, 1, 21, 1),
(75, 15, 1, 21, 1),
(76, 15, 1, 21, 1),
(77, 15, 1, 21, 1),
(78, 15, 1, 21, 1),
(79, 15, 1, 21, 1),
(80, 15, 1, 21, 1),
(83, 14, 1.2, 21, 1),
(85, 14, 1.2, 21, 1),
(87, 14, 1.2, 21, 1),
(88, 15, 1, 21, 1),
(89, 13, 1, 21, 1),
(90, 17, 2, 21, 1),
(92, 24, 1.7, 21, 1),
(93, 24, 1.7, 21, 1),
(94, 17, 2, 21, 1),
(95, 17, 2, 21, 1),
(95, 24, 1.7, 21, 1),
(97, 24, 1.7, 21, 1),
(99, 30, 1.7, 21, 1),
(101, 30, 1.7, 21, 1),
(103, 31, 1.6, 21, 1),
(105, 30, 1.7, 21, 1),
(107, 24, 1.7, 21, 1),
(109, 30, 1.7, 21, 1),
(111, 24, 1.7, 21, 1),
(113, 24, 1.7, 21, 1),
(115, 17, 2, 21, 1),
(117, 24, 1.7, 21, 1),
(119, 24, 1.7, 21, 1),
(121, 17, 2, 21, 1),
(123, 17, 2, 21, 1),
(125, 24, 1.7, 21, 1),
(127, 17, 2, 21, 1),
(129, 30, 1.7, 21, 1),
(129, 31, 1.6, 21, 1),
(130, 31, 1.6, 21, 1),
(130, 32, 1.2576, 21, 1),
(131, 32, 1.2576, 21, 1),
(132, 32, 1.2576, 21, 1),
(133, 27, 3, 10, 1),
(133, 32, 1.2576, 21, 1),
(135, 13, 1, 21, 1),
(135, 17, 2, 21, 1),
(136, 13, 1, 21, 1),
(137, 13, 1, 21, 1),
(138, 13, 1, 21, 1),
(139, 13, 1, 21, 1),
(140, 13, 1, 21, 1),
(141, 13, 1, 21, 1),
(142, 13, 1, 21, 1),
(143, 13, 1, 21, 1),
(144, 13, 1, 21, 1),
(145, 13, 1, 21, 1),
(146, 13, 1, 21, 1),
(147, 13, 1, 21, 1),
(148, 20, 0.95, 21, 1),
(149, 20, 0.95, 21, 1),
(150, 20, 0.95, 21, 1),
(151, 20, 0.95, 21, 1),
(152, 20, 0.95, 21, 1),
(153, 20, 0.95, 21, 1),
(154, 20, 0.95, 21, 1),
(155, 20, 0.95, 21, 2),
(155, 21, 1.1, 21, 1),
(155, 23, 1.4, 21, 1),
(155, 30, 1.7, 21, 1),
(155, 31, 1.6, 21, 1),
(156, 31, 1.6, 21, 1),
(157, 31, 1.6, 21, 1),
(158, 23, 1.4, 21, 1),
(158, 31, 1.6, 21, 1),
(159, 23, 1.4, 21, 1),
(160, 23, 1.4, 21, 1),
(161, 21, 1.1, 21, 1),
(161, 25, 1.8, 10, 2),
(161, 26, 8, 21, 1),
(163, 16, 2, 21, 1),
(164, 16, 2, 21, 1),
(164, 19, 2.5, 21, 1),
(164, 20, 0.95, 21, 1),
(164, 21, 1.1, 21, 1),
(164, 23, 1.4, 21, 1),
(164, 25, 1.8, 10, 1),
(164, 26, 8, 21, 1),
(164, 27, 3, 10, 1),
(164, 28, 1, 4, 1),
(164, 30, 1.7, 21, 1),
(164, 31, 1.6, 21, 1),
(165, 23, 1.4, 21, 1),
(166, 23, 1.4, 21, 1),
(167, 23, 1.4, 21, 1),
(168, 23, 1.4, 21, 1),
(169, 23, 1.4, 21, 1),
(170, 31, 1.6, 21, 1),
(172, 31, 1.6, 21, 1),
(174, 31, 1.6, 21, 1),
(175, 16, 2, 21, 1),
(175, 19, 2.5, 21, 1),
(175, 20, 0.95, 21, 1),
(175, 21, 1.1, 21, 1),
(175, 23, 1.4, 21, 1),
(175, 25, 1.8, 10, 1),
(175, 27, 3, 10, 1),
(175, 30, 1.7, 21, 1),
(175, 31, 1.6, 21, 1),
(176, 27, 3, 10, 1),
(177, 16, 2, 21, 1),
(178, 30, 1.7, 21, 1),
(179, 25, 1.8, 10, 2),
(180, 40, 3, 21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `productoID` int(10) UNSIGNED NOT NULL,
  `categoriaID` int(10) NOT NULL,
  `nombre` char(30) NOT NULL,
  `precio` float NOT NULL,
  `iva` int(3) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `imagen` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`productoID`, `categoriaID`, `nombre`, `precio`, `iva`, `cantidad`, `imagen`) VALUES
(13, 11, 'coca cola zero', 1, 21, 8, 'coca-cola-zero.jpg'),
(14, 3, 'pincho de tortilla', 1.2, 21, 0, 'pincho-tortilla.jpg'),
(15, 3, 'pincho de pollo', 1, 21, 0, 'pollo.png'),
(16, 7, 'rioja', 2, 21, 26, 'rioja.jpg'),
(17, 1, 'mahou', 2, 21, 0, 'mahou.jpg'),
(18, 5, 'patatas jamon', 1, 21, 20, 'jamon.jpg'),
(19, 7, 'albariño', 2.5, 21, 6, 'albarino.jpg'),
(20, 9, 'cafe solo', 0.95, 21, NULL, 'cafe_solo.jpg'),
(21, 9, 'cafe con leche', 1.1, 21, NULL, 'cafe_leche.jpg'),
(23, 10, 'manzanilla', 1.4, 21, 11, 'manzanilla.jpg'),
(24, 1, 'heineken', 1.7, 21, 4, 'heineken.jpg'),
(25, 11, 'pepsi', 1.8, 10, 15, 'pepsi.jpg'),
(26, 12, 'arroz huevos', 8, 21, NULL, 'arroz_huevo.jpg'),
(27, 13, 'sandwich mixto', 3, 21, NULL, 'sandwich-mixto.jpg'),
(28, 14, 'croissant', 1, 4, 0, 'croissant.jpg'),
(30, 1, 'estrella galicia', 1.7, 21, 13, 'galicia.jpg'),
(31, 1, '1906', 1.6, 21, 12, '1906.jpg'),
(32, 5, 'patatas campesinas', 1.2576, 21, 129, 'campesinas.jpg'),
(33, 12, 'patatas huevo jamon', 8.75, 10, NULL, 'huevo_jamon.jpeg'),
(34, 1, 'corona', 1.4, 21, 23, 'corona.jpeg'),
(35, 1, 'cruzcampo', 1.3, 21, 34, 'cruzcampo.jpg'),
(36, 7, 'rosado', 2, 21, 34, 'rosado.jpeg'),
(37, 19, 'mojito', 5, 21, 24, 'mojito.jpg'),
(38, 19, 'margarita', 5, 21, 23, 'margarita.jpeg'),
(39, 19, 'gintonic', 5, 21, 23, 'gintonic.jpg'),
(40, 20, 'batido fresa', 3, 21, 34, 'fresa.jpg'),
(41, 20, 'batido chocolate', 3, 21, 34, 'batido_choco.jpeg'),
(42, 20, 'batido platano', 3, 21, 45, 'batido_platano.jpeg'),
(43, 11, 'fanta', 1.5, 21, 56, 'fanta.jpg'),
(44, 10, 'te verde', 1.2, 21, 35, 'te_verde.jpg'),
(45, 10, 'menta poleo', 1.2, 21, 36, 'menta_poleo.jpg'),
(46, 10, 'te rojo', 1.3, 21, 35, 'te_rojo.jpg'),
(47, 10, 'te chai', 2, 21, 35, 'te_chai.jpeg'),
(48, 10, 'rooibos', 1.2, 21, 36, 'rooibos.jpeg'),
(49, 10, 'tila', 1.3, 21, 34, 'tila.jpeg'),
(50, 9, 'cafe irlandes', 2, 21, NULL, 'irlandes.jpeg'),
(53, 1, 'guiness', 2, 21, 45, 'guiness.jpeg'),
(54, 24, 'agua gas', 1.5, 21, 24, 'agua_gas.png'),
(55, 24, 'agua medio litro', 1.2, 21, 25, 'agua_medio.jpeg'),
(56, 24, 'agua litro', 2, 21, 26, 'agua_litro.jpg'),
(57, 30, 'chocolate taza', 2, 21, 36, 'chocolate_taza.jpg'),
(58, 30, 'chocolate taza nata', 2.3, 21, 37, 'choco_nata.jpeg'),
(59, 30, 'chocolate blanco', 2.5, 21, 45, 'choco_blanco.jpg'),
(60, 3, 'bocadillo calamares', 3, 21, 12, 'calamares.jpeg'),
(61, 5, 'patatas artesanas', 2, 21, 25, 'artesanas.jpeg'),
(62, 12, 'lomo patatas', 7.95, 21, NULL, 'lomo_patatas.jpeg'),
(63, 13, 'sandwich vegetal', 3, 21, NULL, 'sand_vegetal.jpeg'),
(65, 13, 'sandwich atun', 3, 21, NULL, 'atun.jpeg'),
(66, 14, 'magdalena', 0.85, 21, 34, 'magdalena.jpg'),
(67, 14, 'napolitana', 1, 21, 25, 'napolitana.jpeg'),
(68, 15, 'croquetas', 6, 21, NULL, 'croquetas.jpeg'),
(69, 15, 'calamares', 7, 21, NULL, 'calamares.jpg'),
(70, 15, 'patatas bravas', 4.5, 21, NULL, 'bravas.jpeg'),
(71, 15, 'patatas alioli', 4.5, 21, NULL, 'alioli.jpg'),
(72, 15, 'pulpo', 8.5, 21, NULL, 'pulpo.jpeg'),
(73, 15, 'alitas pollo', 6, 21, NULL, 'alitas.jpeg'),
(74, 15, 'callos', 8, 21, NULL, 'callos.jpeg'),
(77, 16, 'aceitunas sin hueso', 2, 21, 12, 'aceitunas_sin.jpg'),
(78, 16, 'aceitunas rellenas', 2, 21, 45, 'rellenas.jpeg'),
(79, 16, 'cacahuetes', 1.5, 21, 23, 'cacahuetes.jpg'),
(80, 17, 'menu semanal', 9, 21, NULL, 'menu.png'),
(81, 17, 'menu finde', 12, 21, NULL, 'menu.png'),
(82, 17, 'menu infantil', 5, 21, NULL, 'menu.png'),
(83, 18, 'cono almendrado', 2.2, 21, 16, 'helado.jpg'),
(84, 18, 'bombon helado', 2.5, 21, 26, 'bombon-helado.jpg'),
(85, 18, 'copa helado', 4, 21, 26, 'copa_helado.jpeg'),
(86, 21, 'chocolate churros', 3, 21, NULL, 'churros.jpg'),
(87, 21, 'cafe bolleria', 2, 21, NULL, 'desayunos.jpg'),
(88, 21, 'crepes cafe', 2.5, 21, NULL, 'crepes.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `ventas`
--

CREATE TABLE `ventas` (
  `ventaID` int(10) UNSIGNED NOT NULL,
  `empleado` char(16) NOT NULL,
  `total` float NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ventas`
--

INSERT INTO `ventas` (`ventaID`, `empleado`, `total`, `fecha`) VALUES
(31, 'admin', 3.9, '2018-09-28 11:55:27'),
(32, 'admin', 0.95, '2018-09-28 12:24:30'),
(33, 'admin', 2.05, '2018-09-28 12:25:08'),
(34, 'admin', 9.85, '2018-09-28 12:27:37'),
(35, 'admin', 5.4, '2018-09-28 12:44:30'),
(36, 'admin', 2018, '2018-09-28 12:52:23'),
(37, 'admin', 0, '2018-09-28 12:53:51'),
(38, 'admin', 0, '2018-09-28 12:57:37'),
(39, 'admin', 0, '2018-09-28 15:43:25'),
(40, 'admin', 0, '2018-09-28 15:43:40'),
(41, 'admin', 0, '2018-09-29 10:45:48'),
(42, 'admin', 0, '2018-09-29 10:47:14'),
(43, 'admin', 0, '2018-09-29 10:51:19'),
(44, 'admin', 0, '2018-09-29 10:51:45'),
(45, 'admin', 0, '2018-09-29 10:52:48'),
(46, 'admin', 0, '2018-09-29 10:54:51'),
(47, 'admin', 0, '2018-09-29 10:55:33'),
(48, 'admin', 0, '2018-09-29 10:56:53'),
(49, 'admin', 0, '2018-09-29 10:58:37'),
(50, 'admin', 41.4, '2018-09-29 10:59:58'),
(51, 'admin', 2.5, '2018-09-29 11:00:31'),
(52, 'admin', 1.2, '2018-09-29 11:01:58'),
(53, 'admin', 2.2, '2018-09-29 11:11:46'),
(54, 'admin', 2, '2018-09-29 11:13:11'),
(55, 'admin', 1, '2018-09-29 11:15:06'),
(56, 'admin', 1, '2018-09-29 11:16:20'),
(57, 'admin', 1, '2018-09-29 11:17:00'),
(58, 'admin', 1, '2018-09-29 11:20:32'),
(59, 'admin', 1, '2018-09-29 11:20:57'),
(60, 'admin', 1, '2018-09-29 11:21:28'),
(61, 'admin', 1, '2018-09-29 11:21:39'),
(62, 'admin', 1, '2018-09-29 11:21:48'),
(63, 'admin', 1, '2018-09-29 11:23:11'),
(64, 'admin', 1, '2018-09-29 12:15:58'),
(65, 'admin', 1, '2018-09-29 12:16:37'),
(66, 'admin', 1.2, '2018-09-29 12:21:40'),
(67, 'admin', 1.2, '2018-09-29 12:23:53'),
(68, 'admin', 2.4, '2018-09-29 12:25:16'),
(69, 'admin', 1.2, '2018-09-29 12:26:17'),
(70, 'admin', 1.2, '2018-09-29 12:27:49'),
(71, 'admin', 1.2, '2018-09-29 12:28:12'),
(72, 'admin', 1.2, '2018-09-29 12:28:41'),
(73, 'admin', 1, '2018-09-29 12:29:07'),
(74, 'admin', 1, '2018-09-29 12:31:27'),
(75, 'admin', 1, '2018-09-29 12:35:13'),
(76, 'admin', 1, '2018-09-29 12:37:28'),
(77, 'admin', 1, '2018-09-29 12:37:55'),
(78, 'admin', 1, '2018-09-29 12:38:20'),
(79, 'admin', 1, '2018-09-29 14:37:34'),
(80, 'admin', 1, '2018-09-29 14:38:02'),
(81, 'admin', 0, '2018-09-29 14:38:41'),
(82, 'admin', 0, '2018-09-29 14:38:46'),
(83, 'admin', 1.2, '2018-09-29 14:38:54'),
(84, 'admin', 0, '2018-09-29 14:41:01'),
(85, 'admin', 1.2, '2018-09-29 14:41:06'),
(86, 'admin', 0, '2018-09-29 14:48:27'),
(87, 'admin', 1.2, '2018-09-29 14:48:31'),
(88, 'admin', 1, '2018-09-29 14:50:32'),
(89, 'admin', 1, '2018-09-29 15:03:47'),
(90, 'admin', 2, '2018-09-29 15:31:15'),
(91, 'admin', 0, '2018-09-29 15:32:30'),
(92, 'admin', 1.7, '2018-09-29 15:34:42'),
(93, 'admin', 1.7, '2018-09-29 15:34:57'),
(94, 'admin', 2, '2018-09-29 18:20:11'),
(95, 'admin', 3.7, '2018-09-29 18:22:42'),
(96, 'admin', 0, '2018-09-29 18:24:08'),
(97, 'admin', 1.7, '2018-09-29 18:24:57'),
(98, 'admin', 0, '2018-09-29 18:28:21'),
(99, 'admin', 1.7, '2018-09-29 18:28:27'),
(100, 'admin', 0, '2018-09-29 18:30:15'),
(101, 'admin', 1.7, '2018-09-29 18:30:20'),
(102, 'admin', 0, '2018-09-29 18:30:22'),
(103, 'admin', 1.6, '2018-09-29 18:31:44'),
(104, 'admin', 0, '2018-09-29 18:32:34'),
(105, 'admin', 1.7, '2018-09-29 18:32:39'),
(106, 'admin', 0, '2018-09-29 18:32:41'),
(107, 'admin', 1.7, '2018-09-29 18:34:02'),
(108, 'admin', 0, '2018-09-29 18:34:04'),
(109, 'admin', 1.7, '2018-09-29 18:34:17'),
(110, 'admin', 0, '2018-09-29 18:34:19'),
(111, 'admin', 1.7, '2018-09-29 18:34:35'),
(112, 'admin', 0, '2018-09-29 18:37:46'),
(113, 'admin', 1.7, '2018-09-29 18:37:49'),
(114, 'admin', 0, '2018-09-29 18:42:52'),
(115, 'admin', 2, '2018-09-30 09:22:21'),
(116, 'admin', 0, '2018-09-30 09:25:38'),
(117, 'admin', 1.7, '2018-09-30 09:25:42'),
(118, 'admin', 0, '2018-09-30 09:30:45'),
(119, 'admin', 1.7, '2018-09-30 09:30:49'),
(120, 'admin', 0, '2018-09-30 09:32:24'),
(121, 'admin', 2, '2018-09-30 09:32:29'),
(122, 'admin', 0, '2018-09-30 09:33:01'),
(123, 'admin', 2, '2018-09-30 09:33:06'),
(124, 'admin', 0, '2018-09-30 09:34:24'),
(125, 'admin', 1.7, '2018-09-30 09:34:28'),
(126, 'admin', 0, '2018-09-30 09:35:56'),
(127, 'admin', 2, '2018-09-30 09:36:00'),
(128, 'admin', 0, '2018-09-30 09:36:37'),
(129, 'admin', 3.3, '2018-10-06 11:01:47'),
(130, 'admin', 2.86, '2018-10-06 11:10:23'),
(131, 'admin', 1.26, '2018-10-06 11:16:29'),
(132, 'admin', 1.26, '2018-10-06 11:17:21'),
(133, 'admin', 4.26, '2018-10-06 11:36:21'),
(134, 'admin', 0, '2018-10-06 11:40:23'),
(135, 'admin', 3, '2018-10-06 11:40:36'),
(136, 'admin', 1, '2018-10-06 11:41:48'),
(137, 'admin', 1, '2018-10-06 11:42:30'),
(138, 'admin', 1, '2018-10-06 11:46:23'),
(139, 'admin', 1, '2018-10-06 11:47:59'),
(140, 'admin', 1, '2018-10-06 11:55:27'),
(141, 'admin', 1, '2018-10-06 11:57:22'),
(142, 'admin', 1, '2018-10-06 11:58:18'),
(143, 'admin', 1, '2018-10-06 11:59:54'),
(144, 'admin', 1, '2018-10-06 12:00:32'),
(145, 'admin', 1, '2018-10-06 12:02:14'),
(146, 'admin', 1, '2018-10-06 12:11:19'),
(147, 'admin', 1, '2018-10-06 12:11:55'),
(148, 'admin', 0.95, '2018-10-06 12:13:59'),
(149, 'admin', 0.95, '2018-10-06 12:19:58'),
(150, 'admin', 0.95, '2018-10-06 12:20:25'),
(151, 'admin', 0.95, '2018-10-06 12:24:03'),
(152, 'admin', 0.95, '2018-10-06 12:24:38'),
(153, 'admin', 0.95, '2018-10-06 12:30:13'),
(154, 'admin', 0.95, '2018-10-06 12:31:27'),
(155, 'admin', 7.7, '2018-10-06 15:20:27'),
(156, 'admin', 1.6, '2018-10-06 15:22:27'),
(157, 'admin', 1.6, '2018-10-06 15:24:30'),
(158, 'admin', 3, '2018-10-06 15:24:57'),
(159, 'admin', 1.4, '2018-10-06 15:26:05'),
(160, 'admin', 1.4, '2018-10-06 15:27:48'),
(161, 'admin', 12.7, '2018-10-06 15:30:56'),
(162, 'admin', 0, '2018-10-06 15:31:43'),
(163, 'admin', 2, '2018-10-06 15:31:53'),
(164, 'admin', 25.05, '2018-10-06 15:32:59'),
(165, 'admin', 1.4, '2018-10-06 15:40:11'),
(166, 'admin', 1.4, '2018-10-06 15:40:28'),
(167, 'admin', 1.4, '2018-10-06 15:41:15'),
(168, 'admin', 1.4, '2018-10-06 15:41:20'),
(169, 'admin', 1.4, '2018-10-06 15:41:51'),
(170, 'admin', 1.6, '2018-10-06 15:42:24'),
(171, 'admin', 0, '2018-10-06 15:43:11'),
(172, 'admin', 1.6, '2018-10-06 15:43:16'),
(173, 'admin', 0, '2018-10-06 15:44:00'),
(174, 'admin', 1.6, '2018-10-06 15:44:04'),
(175, 'admin', 16.05, '2018-10-06 15:44:37'),
(176, 'admin', 3, '2018-10-06 15:45:32'),
(177, 'admin', 2, '2018-10-06 15:47:57'),
(178, 'admin', 1.7, '2018-10-06 18:19:55'),
(179, 'admin', 3.6, '2018-12-05 11:26:43'),
(180, 'admin', 3, '2018-12-11 12:43:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoriaID`);

--
-- Indexes for table `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `linea_venta`
--
ALTER TABLE `linea_venta`
  ADD PRIMARY KEY (`ventaID`,`productoID`),
  ADD KEY `ventaID` (`ventaID`) USING BTREE,
  ADD KEY `productoID` (`productoID`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`productoID`),
  ADD KEY `cantidadID` (`categoriaID`);

--
-- Indexes for table `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`ventaID`),
  ADD KEY `empleado` (`empleado`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categoriaID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `productoID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `ventas`
--
ALTER TABLE `ventas`
  MODIFY `ventaID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `linea_venta`
--
ALTER TABLE `linea_venta`
  ADD CONSTRAINT `linea_venta_ibfk_1` FOREIGN KEY (`ventaID`) REFERENCES `ventas` (`ventaID`),
  ADD CONSTRAINT `linea_venta_ibfk_2` FOREIGN KEY (`productoID`) REFERENCES `productos` (`productoID`);

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoriaID`) REFERENCES `categorias` (`categoriaID`);

--
-- Constraints for table `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`empleado`) REFERENCES `empleados` (`user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
