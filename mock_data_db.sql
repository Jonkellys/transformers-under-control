-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 31-05-2024 a las 22:03:31
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema-corpoelec`
--
CREATE DATABASE IF NOT EXISTS `sistema-corpoelec` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sistema-corpoelec`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrasenas`
--

CREATE TABLE `contrasenas` (
  `id` int(11) NOT NULL,
  `contrasenaEmail` varchar(255) NOT NULL,
  `contrasenaToken` varchar(255) NOT NULL,
  `userCodigo` varchar(255) NOT NULL,
  `userType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contrasenas`
--

INSERT INTO `contrasenas` (`id`, `contrasenaEmail`, `contrasenaToken`, `userCodigo`, `userType`) VALUES
(10, 'user@email.com', 'e8655ca539bd5454f00553d3d0cae3c8e434e119c9987a9d419de6d53ec463b3288e28eee5cfcdb0c79bad46dbbdaa338846', 'A4578498-1', 'Admin'),
(11, 'user@email.com', 'fbcd9820e812c569093528c75c072c6e772964a8536c33f8aa9d1cd5c530fb2df3a79d9a3f61855a2c8cbb77152317e84215', 'A4578498-1', 'Admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id` int(11) NOT NULL,
  `M_Codigo` varchar(255) NOT NULL,
  `M_Nombre` varchar(255) NOT NULL,
  `M_Tipo` varchar(255) NOT NULL,
  `M_Ubicacion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id`, `M_Codigo`, `M_Nombre`, `M_Tipo`, `M_Ubicacion`) VALUES
(1, 'M7166930-1', 'Andrés Mata', 'Municipio', 'Estado Sucre'),
(2, 'M1319918-2', 'Arismendi', 'Municipio', 'Estado Sucre'),
(3, 'M0571799-3', 'Benítez', 'Municipio', 'Estado Sucre'),
(4, 'M9423560-4', 'Bermúdez', 'Municipio', 'Estado Sucre'),
(5, 'M5678428-5', 'Cajigal', 'Municipio', 'Estado Sucre'),
(6, 'M4021865-6', 'Libertador', 'Municipio', 'Estado Sucre'),
(7, 'M1319918-7', 'Mariño', 'Municipio', 'Estado Sucre'),
(8, 'M0571799-8', 'Valdez', 'Municipio', 'Estado Sucre'),
(9, 'M7166930-9', 'Service Central', 'Municipio', 'Estado Sucre'),
(10, 'P4481557-1', 'San José de Areocuar', 'Parroquia', 'Andrés Mata'),
(11, 'P6424132-3', 'Río Caribe', 'Parroquia', 'Arismendi'),
(12, 'P8434924-4', 'Antonio José de Sucre', 'Parroquia', 'Arismendi'),
(13, 'P5075923-5', 'El Morro de Puerto Santo', 'Parroquia', 'Arismendi'),
(14, 'P3410699-6', 'Puerto Santo', 'Parroquia', 'Arismendi'),
(15, 'P2087047-7', 'San Juan de las Galdonas', 'Parroquia', 'Arismendi'),
(16, 'P9108573-8', 'El Pilar', 'Parroquia', 'Bení­tez'),
(17, 'P0511347-9', 'El Rincón', 'Parroquia', 'Bení­tez'),
(18, 'P2759760-10', 'General Francisco Antonio Vázquez', 'Parroquia', 'Bení­tez'),
(19, 'P3903126-11', 'Guaraúnos', 'Parroquia', 'Benítez'),
(20, 'P6761929-12', 'Tunapuicito', 'Parroquia', 'Bení­tez'),
(21, 'P3276781-13', 'Unión', 'Parroquia', 'Benítez'),
(22, 'P3090653-14', 'Santa Catalina', 'Parroquia', 'Bermúdez'),
(23, 'P9867438-15', 'Santa Rosa', 'Parroquia', 'Bermúdez'),
(24, 'P9448566-16', 'Santa Teresa', 'Parroquia', 'Bermúdez'),
(25, 'P6714059-17', 'Bolívar', 'Parroquia', 'Bermúdez'),
(26, 'P2159026-18', 'Maracapana', 'Parroquia', 'Bermúdez'),
(27, 'P6161600-19', 'Divina Misericordia', 'Parroquia', 'Bermúdez'),
(28, 'P5473715-20', 'Nuestra Señora De Lourdes', 'Parroquia', 'Bermúdez'),
(29, 'P6465653-21', 'Libertad', 'Parroquia', 'Cajigal'),
(30, 'P9625425-22', 'El Paujil', 'Parroquia', 'Cajigal'),
(31, 'P4312707-23', 'Yaguaraparo', 'Parroquia', 'Cajigal'),
(32, 'P3249079-24', 'Tunapuy', 'Parroquia', 'Libertador'),
(33, 'P2113005-25', 'Campo Elías', 'Parroquia', 'Libertador'),
(34, 'P3256357-26', 'Irapa', 'Parroquia', 'Mariño'),
(35, 'P6292230-27', 'Campo Claro', 'Parroquia', 'Mariño'),
(36, 'P5500425-28', 'Marabal', 'Parroquia', 'Mariño'),
(37, 'P0520947-29', 'San Antonio de Irapa', 'Parroquia', 'Mariño'),
(38, 'P9363180-30', 'Soro', 'Parroquia', 'Mariño'),
(39, 'P8617406-31', 'Cristóbal Colón', 'Parroquia', 'Valdez'),
(40, 'P3979971-32', 'Bideau', 'Parroquia', 'Valdez'),
(41, 'P2168546-33', 'Punta de Piedras', 'Parroquia', 'Valdez'),
(42, 'P8747509-34', 'Güiria', 'Parroquia', 'Valdez'),
(46, 'L7926420-46', 'Buena Vista', 'Localidad', 'San José de Areocuar'),
(47, 'L1210215-47', 'Cacahual', 'Localidad', 'San José de Areocuar'),
(48, 'L5271348-48', 'Camino de Güiria ', 'Localidad', 'San José de Areocuar'),
(49, 'L1114280-49', 'Camino de Cariaco ', 'Localidad', 'San José de Areocuar'),
(50, 'L8358478-50', 'Cariaquito', 'Localidad', 'San José de Areocuar'),
(51, 'L0567767-51', 'Cruz Blanca', 'Localidad', 'San José de Areocuar'),
(52, 'L6706742-52', 'El Tigre', 'Localidad', 'San José de Areocuar'),
(53, 'L3748265-53', 'Guanoquito', 'Localidad', 'San José de Areocuar'),
(54, 'L7877383-54', 'La Alianza', 'Localidad', 'San José de Areocuar'),
(55, 'L4521193-55', 'La Esperanza', 'Localidad', 'San José de Areocuar'),
(56, 'L2408690-56', 'La Llanada de Güiria', 'Localidad', 'San José de Areocuar'),
(57, 'L7713140-57', 'La Parima', 'Localidad', 'San José de Areocuar'),
(58, 'L0639327-58', 'Lechozal', 'Localidad', 'San José de Areocuar'),
(59, 'L5184877-59', 'Loma de Chuparipal', 'Localidad', 'San José de Areocuar'),
(60, 'L6730653-60', 'Loma de Gran Pobre', 'Localidad', 'San José de Areocuar'),
(61, 'L0830012-61', 'Manicuare', 'Localidad', 'San José de Areocuar'),
(62, 'L8780502-62', 'Pica Verde', 'Localidad', 'San José de Areocuar'),
(63, 'L6209880-63', 'Queremene', 'Localidad', 'San José de Areocuar'),
(64, 'L1983706-64', 'Sanguijuelas', 'Localidad', 'San José de Areocuar'),
(65, 'L6721108-65', 'Cangua', 'Localidad', 'San Juan de las Galdonas'),
(66, 'L8407862-66', 'Tucuchire', 'Localidad', 'San Juan de las Galdonas'),
(67, 'L6744807-67', 'Catuchal', 'Localidad', 'San Juan de las Galdonas'),
(68, 'L4344534-68', 'San Juan de las Galdonas', 'Localidad', 'San Juan de las Galdonas'),
(69, 'L0107647-69', 'Querepare', 'Localidad', 'San Juan de las Galdonas'),
(70, 'L6758881-70', 'El Saco', 'Localidad', 'San Juan de las Galdonas'),
(71, 'L1095907-71', 'El Bajo', 'Localidad', 'San Juan de las Galdonas'),
(72, 'L1849820-72', 'Cariaquito', 'Localidad', 'Antonio José de Sucre'),
(73, 'L0187606-73', 'Chaguaramal', 'Localidad', 'Antonio José de Sucre'),
(74, 'L8697338-74', 'Chuao', 'Localidad', 'Antonio José de Sucre'),
(75, 'L4235075-75', 'Cipara', 'Localidad', 'Antonio José de Sucre'),
(76, 'L0774994-76', 'Copey', 'Localidad', 'Antonio José de Sucre'),
(77, 'L8575345-77', 'Cumbre de Caballo', 'Localidad', 'Antonio José de Sucre'),
(78, 'L0602187-78', 'Cumbre de las Flores', 'Localidad', 'Antonio José de Sucre'),
(79, 'L1076483-79', 'Paraíso', 'Localidad', 'Antonio José de Sucre'),
(80, 'L6225682-80', 'Pargo', 'Localidad', 'Antonio José de Sucre'),
(81, 'L5740638-81', 'Puerto Escondido', 'Localidad', 'Antonio José de Sucre'),
(82, 'L5880416-82', 'Puerto La Cruz', 'Localidad', 'Antonio José de Sucre'),
(83, 'L1399467-83', 'Puerto Nuevo', 'Localidad', 'Antonio José de Sucre'),
(84, 'L8850482-84', 'San Juan de Unare', 'Localidad', 'Antonio José de Sucre'),
(85, 'L6907272-85', 'Unare', 'Localidad', 'Antonio José de Sucre'),
(86, 'L8185707-86', 'Tacarigua', 'Localidad', 'Antonio José de Sucre'),
(87, 'L0041603-87', 'El Guarico', 'Localidad', 'Puerto Santo'),
(88, 'L8023481-88', 'El Molino', 'Localidad', 'Puerto Santo'),
(89, 'L8590279-89', 'Mapire', 'Localidad', 'Puerto Santo'),
(90, 'L6053181-90', 'La Playa', 'Localidad', 'Puerto Santo'),
(91, 'L5784126-91', 'Puerto Santo', 'Localidad', 'Puerto Santo'),
(92, 'L7167338-92', 'Lucía', 'Localidad', 'Río Caribe'),
(93, 'L1847356-93', 'Caraquita', 'Localidad', 'Río Caribe'),
(94, 'L0424098-94', 'Nivaldo', 'Localidad', 'Río Caribe'),
(95, 'L1154649-95', 'Palenque', 'Localidad', 'Río Caribe'),
(96, 'L3390800-96', 'Guayabero', 'Localidad', 'Río Caribe'),
(97, 'L7300736-97', 'Quebrada Seca', 'Localidad', 'Río Caribe'),
(98, 'L4306444-98', 'Río Salado', 'Localidad', 'Río Caribe'),
(99, 'L0289415-99', 'Río Caribe', 'Localidad', 'Río Caribe'),
(100, 'L0905879-100', 'Santa Isabel', 'Localidad', 'Río Caribe'),
(101, 'L4348272-101', 'Tocuyito', 'Localidad', 'Río Caribe'),
(102, 'L3863506-102', 'Vuelta Larga', 'Localidad', 'Río Caribe'),
(103, 'L3186467-103', 'El Morro de Puerto Santo', 'Localidad', 'El Morro de Puerto Santo'),
(104, 'L8960035-104', 'La Restinga', 'Localidad', 'El Morro de Puerto Santo'),
(105, 'L1436120-105', 'Agua Fría', 'Localidad', 'El Pilar'),
(106, 'L6649072-106', 'Agua Fría Arriba', 'Localidad', 'El Pilar'),
(107, 'L9464037-107', 'Ajpies', 'Localidad', 'El Pilar'),
(108, 'L3748698-108', 'Buena Vista', 'Localidad', 'El Pilar'),
(109, 'L0130626-109', 'Cartagena', 'Localidad', 'El Pilar'),
(110, 'L2992353-110', 'Cerro Negro', 'Localidad', 'El Pilar'),
(111, 'L4806940-111', 'El Algarrobo', 'Localidad', 'El Pilar'),
(112, 'L3100804-112', 'El Cocuyo', 'Localidad', 'El Pilar'),
(113, 'L0191638-113', 'El Escondid Arriba', 'Localidad', 'El Pilar'),
(114, 'L6363283-114', 'Guaruchal', 'Localidad', 'El Pilar'),
(115, 'L2972480-115', 'Guatamare', 'Localidad', 'El Pilar'),
(116, 'L9106145-116', 'Guayabal', 'Localidad', 'El Pilar'),
(117, 'L4285931-117', 'La Cantina', 'Localidad', 'El Pilar'),
(118, 'L3318262-118', 'La Guarumera', 'Localidad', 'El Pilar'),
(119, 'L4430822-119', 'La Laguna', 'Localidad', 'El Pilar'),
(120, 'L4483486-120', 'Las Minas', 'Localidad', 'El Pilar'),
(121, 'L3115564-121', 'Las Piñas', 'Localidad', 'El Pilar'),
(122, 'L5170085-122', 'Los Andes', 'Localidad', 'El Pilar'),
(123, 'L4267188-123', 'Maremare', 'Localidad', 'El Pilar'),
(124, 'L2955855-124', 'Paradero', 'Localidad', 'El Pilar'),
(125, 'L2187154-125', 'Puerto de Characual', 'Localidad', 'El Pilar'),
(126, 'L1193066-126', 'Punta Brava', 'Localidad', 'El Pilar'),
(127, 'L3626794-127', 'Quebrada Seca', 'Localidad', 'El Pilar'),
(128, 'L9482268-128', 'Río Colorado', 'Localidad', 'El Pilar'),
(129, 'L4918687-129', 'Río Grande', 'Localidad', 'El Pilar'),
(130, 'L8381918-130', 'El Calvario', 'Localidad', 'El Rincón'),
(131, 'L6236312-131', 'El Rincón', 'Localidad', 'El Rincón'),
(132, 'L1750270-132', 'Guasimal', 'Localidad', 'El Rincón'),
(133, 'L9951022-133', 'Tunapuicito', 'Localidad', 'Tunapuicito'),
(134, 'L7675699-134', 'Cachicamo', 'Localidad', 'Tunapuicito'),
(135, 'L1578086-135', 'Guanoco', 'Localidad', 'Unión'),
(136, 'L9383413-136', 'Mucubina', 'Localidad', 'Unión'),
(137, 'L5340011-137', 'Guaraúnos', 'Localidad', 'Guaraúnos'),
(138, 'L2026209-138', 'Boca de Río', 'Localidad', 'Maracapana'),
(139, 'L1018720-139', 'Canaima', 'Localidad', 'Maracapana'),
(140, 'L3059876-140', 'Carúpano Arriba', 'Localidad', 'Maracapana'),
(141, 'L4147650-141', 'La Hoyada', 'Localidad', 'Maracapana'),
(142, 'L1905202-142', 'La Sierra', 'Localidad', 'Maracapana'),
(143, 'L1518698-143', 'Sabaneta', 'Localidad', 'Maracapana'),
(144, 'L8032265-144', 'Macarapana', 'Localidad', 'Maracapana'),
(145, 'L9905231-145', 'Maturincito', 'Localidad', 'Maracapana'),
(146, 'L3614551-146', 'Playa Grande', 'Localidad', 'Bolívar'),
(147, 'L4621895-147', 'El Copey', 'Localidad', 'Bolívar'),
(148, 'L7245250-148', 'Londres', 'Localidad', 'Bolívar'),
(149, 'L7578690-149', 'Londres Arriba', 'Localidad', 'Bolívar'),
(150, 'L2607334-150', 'Guaca', 'Localidad', 'Bolívar'),
(151, 'L0282639-151', 'Guayacán', 'Localidad', 'Bolívar'),
(152, 'L4601989-152', 'La Recta', 'Localidad', 'Bolívar'),
(153, 'L5959528-153', 'Güiria', 'Localidad', 'Bolívar'),
(154, 'L6323658-154', 'Playa Grande Arriba', 'Localidad', 'Bolívar'),
(155, 'L0402476-155', 'Caratalito', 'Localidad', 'Santa Rosa'),
(156, 'L5627204-156', 'Chipichipe', 'Localidad', 'Santa Rosa'),
(157, 'L4186777-157', 'Cusma', 'Localidad', 'Santa Rosa'),
(158, 'L1000618-158', 'El Charcal', 'Localidad', 'Santa Catalina'),
(159, 'L5750163-159', 'Carate', 'Localidad', 'Santa Catalina'),
(160, 'L9506388-160', 'Sanguijuela', 'Localidad', 'Santa Catalina'),
(161, 'L8202242-161', 'Charallave', 'Localidad', 'Santa Catalina'),
(162, 'L8603448-162', 'El Muco', 'Localidad', 'Santa Catalina'),
(163, 'L5748365-163', 'Guayacán de las Flores', 'Localidad', 'Santa Catalina'),
(164, 'L7097305-164', 'El Rincón', 'Localidad', 'Santa Catalina'),
(165, 'L3175298-165', 'Vuelta de la Burra', 'Localidad', 'Santa Catalina'),
(166, 'L0270967-166', 'La Soledad', 'Localidad', 'Santa Catalina'),
(167, 'L6673587-167', 'Periquito', 'Localidad', 'Santa Catalina'),
(168, 'L5327363-168', 'La Cumbre', 'Localidad', 'Santa Catalina'),
(169, 'L2250746-169', 'Canchunchu', 'Localidad', 'Santa Catalina'),
(170, 'L1211810-170', 'Chuparipal', 'Localidad', 'Santa Catalina'),
(171, 'L6838485-171', 'Canchunchu Viejo', 'Localidad', 'Santa Catalina'),
(172, 'L2833182-172', 'Caratal', 'Localidad', 'Santa Catalina'),
(173, 'L0435007-173', 'Agua Fría', 'Localidad', 'Yaguaraparo'),
(174, 'L9611144-174', 'Buenos Aires', 'Localidad', 'Yaguaraparo'),
(175, 'L3703192-175', 'Chorochoro', 'Localidad', 'Yaguaraparo'),
(176, 'L7565098-176', 'El Cantón', 'Localidad', 'Yaguaraparo'),
(177, 'L5201175-177', 'La Catana', 'Localidad', 'Yaguaraparo'),
(178, 'L2565112-178', 'La Chivera', 'Localidad', 'Yaguaraparo'),
(179, 'L2872584-179', 'La Florida', 'Localidad', 'Yaguaraparo'),
(180, 'L5003609-180', 'La Horqueta', 'Localidad', 'Yaguaraparo'),
(181, 'L2775580-181', 'La Montaña', 'Localidad', 'Yaguaraparo'),
(182, 'L9239175-182', 'Los Marin', 'Localidad', 'Yaguaraparo'),
(183, 'L4324224-183', 'Los Mirtos', 'Localidad', 'Yaguaraparo'),
(184, 'L6874411-184', 'Los Palmares', 'Localidad', 'Yaguaraparo'),
(185, 'L3101639-185', 'Pitotan', 'Localidad', 'Yaguaraparo'),
(186, 'L8339897-186', 'Quebrada de la Niña', 'Localidad', 'Yaguaraparo'),
(187, 'L9453025-187', 'Ña Bartola', 'Localidad', 'Yaguaraparo'),
(188, 'L6875207-188', 'El Algarrobo', 'Localidad', 'Libertad'),
(189, 'L4953978-189', 'El Alto de San Pedro', 'Localidad', 'Libertad'),
(190, 'L1235687-190', 'Betania', 'Localidad', 'Libertad'),
(191, 'L4832325-191', 'La Palmera', 'Localidad', 'Libertad'),
(192, 'L8691022-192', 'La Pereza', 'Localidad', 'Libertad'),
(193, 'L5539538-193', 'Bohordal', 'Localidad', 'Libertad'),
(194, 'L6141312-194', 'Riito Arriba', 'Localidad', 'Libertad'),
(195, 'L9878905-195', 'Río Seco', 'Localidad', 'Libertad'),
(196, 'L5573684-196', 'Santa Cruz', 'Localidad', 'Libertad'),
(197, 'L4753873-197', 'Santa Elena', 'Localidad', 'Libertad'),
(198, 'L6154969-198', 'Santa Elena Abajo', 'Localidad', 'Libertad'),
(199, 'L8142692-199', 'Valle Solo', 'Localidad', 'Libertad'),
(200, 'L2974287-200', 'El Islote', 'Localidad', 'Libertad'),
(201, 'L5206963-201', 'El Limón', 'Localidad', 'Libertad'),
(202, 'L9416555-202', 'Buena Vista', 'Localidad', 'Libertad'),
(203, 'L0319508-203', 'Paraíso', 'Localidad', 'El Paujil'),
(204, 'L1412435-204', 'Pargo', 'Localidad', 'El Paujil'),
(205, 'L8422436-205', 'Puerto Escondido', 'Localidad', 'El Paujil'),
(206, 'L5993272-206', 'Puerto La Cruz', 'Localidad', 'El Paujil'),
(207, 'L5041013-207', 'Puerto Nuevo', 'Localidad', 'El Paujil'),
(208, 'L1077990-208', 'San Juan de Unare', 'Localidad', 'El Paujil'),
(209, 'L9243639-209', 'Unare', 'Localidad', 'El Paujil'),
(210, 'L8890055-210', 'Chacaracual', 'Localidad', 'Tunapuy'),
(211, 'L8879392-211', 'Cumbre de Manacal', 'Localidad', 'Tunapuy'),
(212, 'L4338257-212', 'Curiepe', 'Localidad', 'Tunapuy'),
(213, 'L4287910-213', 'El Papelón', 'Localidad', 'Tunapuy'),
(214, 'L4202107-214', 'Jabillal', 'Localidad', 'Tunapuy'),
(215, 'L5427557-215', 'La Cumbre de San Antonio', 'Localidad', 'Tunapuy'),
(216, 'L5197428-216', 'La Cumbre Mariano León', 'Localidad', 'Tunapuy'),
(217, 'L0916116-217', 'Platanito Arriba', 'Localidad', 'Tunapuy'),
(218, 'L2490299-218', 'Quebrada de los Rojos', 'Localidad', 'Tunapuy'),
(219, 'L8312264-219', 'Quebrada de Mono', 'Localidad', 'Tunapuy'),
(220, 'L0168700-220', 'Río Arriba', 'Localidad', 'Tunapuy'),
(221, 'L1473602-221', 'Tunapuy', 'Localidad', 'Tunapuy'),
(222, 'L3938575-222', 'Catuaro Abajo', 'Localidad', 'Tunapuy'),
(223, 'L9562278-223', 'Catuaro Arriba', 'Localidad', 'Tunapuy'),
(224, 'L3126019-224', 'Catuchal', 'Localidad', 'Tunapuy'),
(225, 'L8235876-225', 'Bajos de Guaraúnos', 'Localidad', 'Tunapuy'),
(226, 'L0683825-226', 'Buena Vista', 'Localidad', 'Tunapuy'),
(227, 'L3980513-227', 'Guayana', 'Localidad', 'Campo Elías'),
(228, 'L9933110-228', 'Cangrejal', 'Localidad', 'Campo Elías'),
(229, 'L8208940-229', 'Río de Agua', 'Localidad', 'Campo Elías'),
(230, 'L9364458-230', 'Altagracia', 'Localidad', 'Irapa'),
(231, 'L6314375-231', 'Berlín', 'Localidad', 'Irapa'),
(232, 'L9311320-232', 'El Llano', 'Localidad', 'Irapa'),
(233, 'L5571248-233', 'Las Melenas', 'Localidad', 'Irapa'),
(234, 'L0467227-234', 'Irapa', 'Localidad', 'Irapa'),
(235, 'L5661117-235', 'Mijagual', 'Localidad', 'Irapa'),
(236, 'L9817436-236', 'Mundo Nuevo', 'Localidad', 'Irapa'),
(237, 'L3828705-237', 'Pueblo Nuevo', 'Localidad', 'Irapa'),
(238, 'L5910208-238', 'Pueblo Viejo', 'Localidad', 'Irapa'),
(239, 'L3994905-239', 'Río Chiquito', 'Localidad', 'Irapa'),
(240, 'L8178091-240', 'Río Chiquito Arriba', 'Localidad', 'Irapa'),
(241, 'L2547651-241', 'Santa María', 'Localidad', 'Irapa'),
(242, 'L3415177-242', 'Río Grande Abajo', 'Localidad', 'Irapa'),
(243, 'L3414347-243', 'Río Seco', 'Localidad', 'Irapa'),
(244, 'L7881922-244', 'Roma', 'Localidad', 'Irapa'),
(245, 'L7420957-245', 'San Agustín', 'Localidad', 'Irapa'),
(246, 'L0384514-246', 'Alto Amara', 'Localidad', 'Campo Claro'),
(247, 'L8885995-247', 'Buenos Aires', 'Localidad', 'Campo Claro'),
(248, 'L1978176-248', 'Campo Claro', 'Localidad', 'Campo Claro'),
(249, 'L0140761-249', 'Santo Domingo', 'Localidad', 'Campo Claro'),
(250, 'L4423441-250', 'Concepción', 'Localidad', 'Campo Claro'),
(251, 'L9336856-251', 'La Sabana', 'Localidad', 'Campo Claro'),
(252, 'L8605702-252', 'Naranjal', 'Localidad', 'Campo Claro'),
(253, 'L8258371-253', 'El Curi', 'Localidad', 'Campo Claro'),
(254, 'L0503163-254', 'Corozal', 'Localidad', 'Marabal'),
(255, 'L2626873-255', 'Las Vegas', 'Localidad', 'Marabal'),
(256, 'L4482230-256', 'Valencia', 'Localidad', 'Marabal'),
(257, 'L8209846-257', 'Marabal', 'Localidad', 'Marabal'),
(258, 'L4264703-258', 'Juan Pedro', 'Localidad', 'Soro'),
(259, 'L1057909-259', 'La Canela', 'Localidad', 'Soro'),
(260, 'L5588389-260', 'Soro', 'Localidad', 'Soro'),
(261, 'L6625852-261', 'Toribia', 'Localidad', 'Soro'),
(262, 'L3590169-262', 'Las Peñas', 'Localidad', 'Soro'),
(263, 'L8806528-263', 'La Cuchilla', 'Localidad', 'San Antonio de Irapa'),
(264, 'L3747536-264', 'La Meseta', 'Localidad', 'San Antonio de Irapa'),
(265, 'L4155922-265', 'Manacal', 'Localidad', 'San Antonio de Irapa'),
(266, 'L6010973-266', 'San Antonio', 'Localidad', 'San Antonio de Irapa'),
(267, 'L4369091-267', 'Agua Caliente', 'Localidad', 'Punta de Piedras'),
(268, 'L7402167-268', 'Calle El Medio', 'Localidad', 'Punta de Piedras'),
(269, 'L8226046-269', 'La Paloma', 'Localidad', 'Punta de Piedras'),
(270, 'L4385124-270', 'Las Piedras', 'Localidad', 'Punta de Piedras'),
(271, 'L3684083-271', 'La Felicidad', 'Localidad', 'Punta de Piedras'),
(272, 'L5517375-272', 'La Filipina', 'Localidad', 'Punta de Piedras'),
(273, 'L4657206-273', 'Saca Manteca', 'Localidad', 'Punta de Piedras'),
(274, 'L7163467-274', 'Río Bautista', 'Localidad', 'Punta de Piedras'),
(275, 'L7864604-275', 'La Horqueta', 'Localidad', 'Punta de Piedras'),
(276, 'L8976649-276', 'El Guamal', 'Localidad', 'Punta de Piedras'),
(277, 'L5556047-277', 'Yoco', 'Localidad', 'Punta de Piedras'),
(278, 'L4968574-278', 'Cariaquito', 'Localidad', 'Cristóbal Colón'),
(279, 'L4306312-279', 'La Iglesia', 'Localidad', 'Cristóbal Colón'),
(280, 'L1907204-280', 'Puerto de Hierro', 'Localidad', 'Cristóbal Colón'),
(281, 'L7423008-281', 'Cumaca', 'Localidad', 'Cristóbal Colón'),
(282, 'L6932331-282', 'Yacua', 'Localidad', 'Cristóbal Colón'),
(283, 'L1838081-283', 'Macurito', 'Localidad', 'Cristóbal Colón'),
(284, 'L4051492-284', 'Macuro', 'Localidad', 'Cristóbal Colón'),
(285, 'L7321678-285', 'Alto Parasol', 'Localidad', 'Bideau'),
(286, 'L3956971-286', 'Carmona', 'Localidad', 'Bideau'),
(287, 'L1686868-287', 'San Francisco', 'Localidad', 'Bideau'),
(288, 'L9395289-288', 'Catalana', 'Localidad', 'Bideau'),
(289, 'L7955704-289', 'Miraflores', 'Localidad', 'Bideau'),
(290, 'L9103159-290', 'Cerro Seco', 'Localidad', 'Bideau'),
(291, 'L1895195-291', 'Cumaquita', 'Localidad', 'Bideau'),
(292, 'L5308044-292', 'El Jobal', 'Localidad', 'Bideau'),
(293, 'L4598952-293', 'La Ceiba', 'Localidad', 'Bideau'),
(294, 'L1508056-294', 'El Tamarindo', 'Localidad', 'Bideau'),
(295, 'L7457937-295', 'El Hoyo', 'Localidad', 'Güiria'),
(296, 'L6859041-296', 'Guaraguara', 'Localidad', 'Güiria'),
(297, 'L9245616-297', 'Guarama Abajo', 'Localidad', 'Güiria'),
(298, 'L4796628-298', 'Güiria', 'Localidad', 'Güiria'),
(299, 'L9263431-299', 'Kennedy', 'Localidad', 'Güiria'),
(300, 'L1174217-300', 'La Sabana', 'Localidad', 'Güiria'),
(301, 'L3396401-301', 'La Salina', 'Localidad', 'Güiria'),
(302, 'L7171912-302', 'La Toma', 'Localidad', 'Güiria'),
(303, 'L8615164-303', 'Ño Gabriel', 'Localidad', 'Güiria'),
(304, 'L7196959-304', 'Pica Pica', 'Localidad', 'Güiria'),
(305, 'L7713050-305', 'Quebrada de Agua', 'Localidad', 'Güiria'),
(306, 'L9894453-306', 'Río Arriba', 'Localidad', 'Güiria'),
(307, 'L6297621-307', 'Río de Güiria', 'Localidad', 'Güiria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operaciones`
--

CREATE TABLE `operaciones` (
  `id` int(11) NOT NULL,
  `O_Codigo` varchar(255) NOT NULL,
  `O_Procedimiento` varchar(255) NOT NULL,
  `O_Fecha` date NOT NULL,
  `O_Equipo` varchar(255) NOT NULL,
  `O_Municipio` varchar(255) NOT NULL,
  `O_EstadoActual` varchar(255) NOT NULL,
  `O_Parroquia` varchar(255) NOT NULL,
  `O_Localidad` varchar(255) NOT NULL,
  `O_Direccion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `operaciones`
--

INSERT INTO `operaciones` (`id`, `O_Codigo`, `O_Procedimiento`, `O_Fecha`, `O_Equipo`, `O_Municipio`, `O_EstadoActual`, `O_Parroquia`, `O_Localidad`, `O_Direccion`) VALUES
(28, 'H2237272-1', 'Removal', '2024-05-10', 'XRLECSJ04', 'Service Central', 'Damaged', 'Santa Catalina', 'Sector El Valle', 'Calle La Planta'),
(33, 'H2921033-2', 'Removal', '2024-01-15', 'V4J4W51S', 'Service Central', 'Damaged', 'Santa Catalina', 'Sector El Valle', 'Calle La Planta'),
(34, 'H6303499-3', 'Repair', '2023-12-01', 'GHPC1SN', 'Service Central', 'Stock', 'Santa Catalina', 'Sector El Valle', 'Calle La Planta'),
(35, 'H8186492-4', 'Repair', '2023-10-15', 'MVP2239', 'Service Central', 'Stock', 'Santa Catalina', 'Sector El Valle', 'Calle La Planta'),
(36, 'H4077430-5', 'Installation', '2024-04-19', 'EREIRVZ', 'Bermúdez', 'Installed', 'Santa Rosa', 'Caratalito', '602 3rd Street West');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transformadores`
--

CREATE TABLE `transformadores` (
  `id` int(11) NOT NULL,
  `T_Codigo` varchar(255) NOT NULL,
  `T_Estado` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `T_Capacidad` varchar(255) NOT NULL,
  `T_Municipio` varchar(255) NOT NULL,
  `T_Direccion` varchar(255) NOT NULL,
  `T_Tipo` varchar(255) NOT NULL,
  `T_Banco` varchar(255) NOT NULL,
  `T_Parroquia` varchar(255) NOT NULL,
  `T_Localidad` varchar(255) NOT NULL,
  `T_Marca` varchar(255) NOT NULL,
  `T_Modelo` varchar(255) NOT NULL,
  `T_Garantia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `transformadores`
--

INSERT INTO `transformadores` (`id`, `T_Codigo`, `T_Estado`, `T_Capacidad`, `T_Municipio`, `T_Direccion`, `T_Tipo`, `T_Banco`, `T_Parroquia`, `T_Localidad`, `T_Marca`, `T_Modelo`, `T_Garantia`) VALUES
(1, '1UKYYXHP', 'Damaged', '25', 'Valdez', '7138 Mill Street', 'Triphase', 'Commercial', 'Güiria', 'Kennedy', 'Selvitrav', 'Pine25', '5'),
(2, '68LL5KY4', 'Installed', '10', 'Libertador', '926 5th Avenue', 'Triphase', 'Industrial', 'Campo Elías', 'Cangrejal', 'Cacei', 'Cam24', '4'),
(3, 'WCM5Z8L', 'Installed', '15', 'Libertador', '926 5th Avenue', 'Triphase', 'Industrial', 'Campo Elías', 'Cangrejal', 'Cacei', 'Cam24', '9'),
(4, '38D74YC', 'Installed', '75', 'Libertador', '926 5th Avenue', 'Triphase', 'Industrial', 'Campo Elías', 'Cangrejal', 'Cadiem', '91816MA', '7'),
(5, 'AR5YRG', 'Installed', '165', 'Cajigal', '96839 Highland Drive', 'Monophase', 'Industrial', 'Libertad', 'Valle Solo', 'Transforvenca', 'ww459', '12'),
(6, 'LXLLHTT5T', 'Installed', '5', 'Arismendi', '199 Railroad Avenue', 'Triphase', 'Residential', 'Río Caribe', 'Río Salado', 'Cadiem', '15fs', '7'),
(7, 'H3NPZJFS', 'Installed', '100', 'Arismendi', '199 Railroad Avenue', 'Triphase', 'Residential', 'Río Caribe', 'Río Salado', 'Cacei', 'Main34', '10'),
(8, 'NMEAFGH', 'Installed', '10', 'Arismendi', '199 Railroad Avenue', 'Triphase', 'Residential', 'Río Caribe', 'Río Salado', 'Mevar', 'R-514', '7'),
(9, 'XRLECSJ04', 'Damaged', '10', 'Service Central', 'Calle La Planta', 'Monophase', 'Industrial', 'Santa Catalina', 'Sector El Valle', 'Selvitrav', 'Hm25t', '8'),
(10, 'ERHKVC9', 'Installed', '5', 'Cajigal', '50972 South Street', 'Monophase', 'Industrial', 'Libertad', 'El Algarrobo', 'Mevar', 'R-705', '9'),
(11, 'E46XN1R0', 'Installed', '25', 'Valdez', '27 Route 30', 'Monophase', 'Residential', 'Cristóbal Colón', 'Macurito', 'Cadiem', '15fs', '4'),
(12, '04LB258D', 'Damaged', '37.5', 'Benítez', '18 Elm Street', 'Triphase', 'Commercial', 'El Pilar', 'Quebrada Seca', 'Cacei', 'Pine25', '9'),
(13, '1WW1K3SL', 'Installed', '37.5', 'Benítez', '18 Elm Street', 'Triphase', 'Commercial', 'El Pilar', 'Quebrada Seca', 'Mevar', 'R-705', '6'),
(14, '7J6CW1L', 'Installed', '75', 'Benítez', '18 Elm Street', 'Triphase', 'Commercial', 'El Pilar', 'Quebrada Seca', 'Cadiem', '91816MA', '11'),
(15, '8RC53B', 'Stock', '15', 'Service Central', 'Calle La Planta', 'Triphase', 'Industrial', 'Santa Catalina', 'Sector El Valle', 'Transforvenca', 'ws394', '9'),
(16, 'USL3LKT', 'Damaged', '37.5', 'Arismendi', '18 Elm Street', 'Monophase', 'Commercial', 'El Morro de Puerto Santo', 'La Restinga', 'Cacei', 'Pine25', '6'),
(17, '39VV096X', 'Stock', '75', 'Service Central', 'Calle La Planta', 'Monophase', 'Commercial', 'Santa Catalina', 'Sector El Valle', 'Selvitrav', 'Hm25t', '1'),
(18, 'FJRS5U3', 'Damaged', '100', 'Mariño', '996 3rd Street West', 'Monophase', 'Residential', 'Soro', 'La Canela', 'Selvitrav', 'P58p', '7'),
(19, '8V0VCXCH', 'Damaged', '10', 'Benítez', '1 Elm Avenue', 'Monophase', 'Industrial', 'El Rincón', 'El Rincón', 'Cadiem', '1302r', '2'),
(20, '1FPRFJBN', 'Installed', '10', 'Cajigal', '611 Main Street', 'Triphase', 'Industrial', 'Yaguaraparo', 'Chorochoro', 'Caivet', 'Hid49', '6'),
(21, 'ZX6VJGV', 'Installed', '37.5', 'Cajigal', '611 Main Street', 'Triphase', 'Industrial', 'Yaguaraparo', 'Chorochoro', 'Selvitrav', 'r82T', '0'),
(22, 'HJVJCQR', 'Installed', '10', 'Cajigal', '611 Main Street', 'Triphase', 'Industrial', 'Yaguaraparo', 'Chorochoro', 'Mevar', 'R-705', '6'),
(23, 'S5VN28T', 'Stock', '15', 'Service Central', 'Calle La Planta', 'Triphase', 'Residential', 'Santa Catalina', 'Sector El Valle', 'Selvitrav', 'Hm25t', '7'),
(24, 'NYV9FK6H', 'Damaged', '5', 'Bermúdez', '542 South Street', 'Monophase', 'Industrial', 'Bolívar', 'Playa Grande Arriba', 'Cacei', '80Wal', '7'),
(25, 'NVTFWKR', 'Installed', '37.5', 'Bermúdez', '16 Franklin Street', 'Monophase', 'Residential', 'Santa Catalina', 'Sanguijuela', 'Cadiem', '91816MA', '12'),
(26, 'F7JNVA1', 'Damaged', '50', 'Andrés Mata', '7491 Myrtle Avenue', 'Triphase', 'Industrial', 'San José de Areocuar', 'Lechozal', 'Mevar', 'R-514', '5'),
(27, 'G0ZG25', 'Installed', '100', 'Andrés Mata', '554 Laurel Lane', 'Monophase', 'Industrial', 'San José de Areocuar', 'Loma de Gran Pobre', 'Mevar', 'R-183', '12'),
(28, '2VLV841', 'Installed', '75', 'Andrés Mata', '654 Belmont Avenue', 'Monophase', 'Residential', 'San José de Areocuar', 'Queremene', 'Selvitrav', 'r82T', '4'),
(29, 'M0ES873', 'Installed', '37.5', 'Andrés Mata', '4025 Cambridge Drive', 'Monophase', 'Commercial', 'San José de Areocuar', 'Camino de Cariaco', 'Cadiem', '1302r', '7'),
(30, '98XAM71', 'Damaged', '50', 'Andrés Mata', '19622 Main Street South', 'Monophase', 'Residential', 'San José de Areocuar', 'La Esperanza', 'Caivet', 'Dur51', '10'),
(31, 'XA398Y', 'Installed', '75', 'Andrés Mata', '8639 River Road', 'Triphase', 'Industrial', 'San José de Areocuar', 'Lechozal', 'Transforvenca', 'ww459', '6'),
(32, '0L1JD9E', 'Installed', '37.5', 'Andrés Mata', '8639 River Road', 'Triphase', 'Industrial', 'San José de Areocuar', 'Lechozal', 'Cadiem', '7169n', '7'),
(33, '3P71D7V', 'Installed', '75', 'Andrés Mata', '8639 River Road', 'Triphase', 'Industrial', 'San José de Areocuar', 'Lechozal', 'Selvitrav', 'P58p', '8'),
(34, 'MA0V5W9', 'Installed', '50', 'Andrés Mata', '63 3rd Street', 'Monophase', 'Industrial', 'San José de Areocuar', 'La Esperanza', 'Transforvenca', 'es54', '11'),
(35, 'GFRY2110', 'Installed', '15', 'Andrés Mata', '9065 Harrison Street', 'Triphase', 'Commercial', 'San José de Areocuar', 'Camino de Güiria', 'Transforvenca', 'ww459', '8'),
(36, 'KB6214G', 'Installed', '10', 'Andrés Mata', '24 Pleasant Street', 'Monophase', 'Commercial', 'San José de Areocuar', 'Kennedy', 'Selvitrav', 'Pine25', '10'),
(37, 'MVP2239', 'Stock', '25', 'Service Central', 'Calle La Planta', 'Monophase', 'Residential', 'Santa Catalina', 'Sector El Valle', 'Selvitrav', 'r82T', '08'),
(38, 'A5V634G', 'Damaged', '5', 'Arismendi', '167 5th Street', 'Triphase', 'Residential', 'Antonio José de Sucre', 'Cumbre de las Flores', 'Cacei', 'Main34', '4'),
(39, 'V6TTRT0', 'Installed', '15', 'Arismendi', '6 River Street', 'Monophase', 'Residential', 'Puerto Santo', 'Puerto Santo', 'Cacei', '18div43', '7'),
(40, '82MXWX', 'Installed', '75', 'Arismendi', '558 Main Street West', 'Triphase', 'Industrial', 'San Juan de las Galdonas', 'Cangua', 'Caivet', 'GrV501', '3'),
(41, '1N6RAJT', 'Installed', '15', 'Arismendi', '558 Main Street West', 'Triphase', 'Industrial', 'San Juan de las Galdonas', 'Cangua', 'Mevar', 'R-830', '5'),
(42, 'AJ1VZG4', 'Installed', '50', 'Arismendi', '558 Main Street West', 'Triphase', 'Industrial', 'San Juan de las Galdonas', 'Cangua', 'Selvitrav', 'Hm25t', '8'),
(43, 'SHUUFC', 'Installed', '50', 'Arismendi', '29 King Street', 'Monophase', 'Residential', 'Antonio José de Sucre', 'Chuao', 'Selvitrav', 'P58p', '4'),
(44, '6MUP4P', 'Damaged', '10', 'Arismendi', '7391 9th Street', 'Triphase', 'Residential', 'San Juan de las Galdonas', 'Catuchal', 'Transforvenca', 'es54', '8'),
(45, '6KJERCJ', 'Installed', '25', 'Arismendi', '6159 Hamilton Street', 'Monophase', 'Commercial', 'Río Caribe', 'Santa Isabel', 'Caivet', 'Hld49', '10'),
(46, 'BVVTP1W', 'Damaged', '37.5', 'Arismendi', '3752 6th Street', 'Triphase', 'Industrial', 'Río Caribe', 'Quebrada Seca', 'Selvitrav', 'Hm25t', '12'),
(47, '4JVRXRN', 'Damaged', '75', 'Arismendi', '930 James Street', 'Monophase', 'Industrial', 'El Morro de Puerto Santo', 'La Restinga', 'Cadiem', '7169n', '8'),
(48, 'XA0252', 'Installed', '10', 'Arismendi', '46 Liberty Street', 'Monophase', 'Industrial', 'Río Caribe', 'Río Salado', 'Caivet', 'GrV501', '8'),
(49, 'GUESFJH', 'Installed', '15', 'Arismendi', '4842 Wood Street', 'Monophase', 'Residential', 'El Morro de Puerto Santo', 'El Morro de Puerto Santo', 'Cacei', '18div43', '10'),
(50, 'TC1ATK', 'Installed', '165', 'Benítez', '75 Route 30', 'Monophase', 'Industrial', 'El Pilar', 'Cerro Negro', 'Selvitrav', 'P58p', '10'),
(51, 'MUDA879', 'Damaged', '165', 'Benítez', '55 Railroad Street', 'Triphase', 'Commercial', 'El Rincón', 'Guasimal', 'Selvitrav', 'Hm25t', '2'),
(52, '61MP4NV', 'Installed', '50', 'Benítez', '61163 Magnolia Drive', 'Triphase', 'Residential', 'Unión', 'Guanoco', 'Cacei', 'Pine25', '4'),
(53, '4CC9EPV', 'Installed', '50', 'Benítez', '61163 Magnolia Drive', 'Triphase', 'Residential', 'Unión', 'Guanoco', 'Selvitrav', 'Hm25t', '2'),
(54, '66TBLYZ', 'Installed', '5', 'Benítez', '61163 Magnolia Drive', 'Triphase', 'Residential', 'Unión', 'Guanoco', 'Cadiem', '1302r', '1'),
(55, 'PH6E1999', 'Installed', '75', 'Benítez', '4351 Vine Street', 'Monophase', 'Industrial', 'El Rincón', 'El Calvaria', 'Transforvenca', 'ws394', '3'),
(56, 'ABAPPA', 'Damaged', '100', 'Benítez', '331 Madison Street', 'Monophase', 'Industrial', 'Unión', 'Mucubina', 'Mevar', 'R-183', '9'),
(57, 'JR1UDD2', 'Damaged', '10', 'Benítez', '380 Hillcrest Drive', 'Triphase', 'Industrial', 'El Pilar', 'Puerto de Characual', 'Transforvenca', 'es54', '2'),
(58, 'T4N3K86', 'Installed', '100', 'Benítez', '355 Lincoln Avenue', 'Triphase', 'Industrial', 'Tunapuicito', 'Cachicamo', 'Mevar', 'R-705', '3'),
(59, 'VFITH25', 'Installed', '15', 'Benítez', '355 Lincoln Avenue', 'Triphase', 'Industrial', 'Tunapuicito', 'Cachicamo', 'Cadiem', '1302r', '9'),
(60, 'JEMV1A0', 'Installed', '25', 'Benítez', '355 Lincoln Avenue', 'Triphase', 'Industrial', 'Tunapuicito', 'Cachicamo', 'Cadiem', '91816MA', '5'),
(61, 'D6LPCN', 'Installed', '15', 'Benítez', '70857 3rd Street', 'Triphase', 'Industrial', 'El Pilar', 'Río Grande', 'Selvitrav', 'Hm25t', '6'),
(62, 'DS89WDK', 'Installed', '37.5', 'Benítez', '70857 3rd Street', 'Triphase', 'Industrial', 'El Pilar', 'Río Grande', 'Cacei', 'Cam24', '5'),
(63, 'RJX1QPF', 'Installed', '165', 'Benítez', '70857 3rd Street', 'Triphase', 'Industrial', 'El Pilar', 'Río Grande', 'Cacei', '18div43', '1'),
(64, 'R89EFRM', 'Damaged', '25', 'Benítez', '30 3rd Street West', 'Triphase', 'Industrial', 'El Rincón', 'El Rincón', 'Transforvenca', 'ww459', '9'),
(65, 'NVNNUN', 'Installed', '5', 'Benítez', '93 Lakeview Drive', 'Triphase', 'Industrial', 'Guaraúnos', 'Guaraúnos', 'Cacei', '80Wal', '4'),
(66, '9JKTEXN', 'Installed', '10', 'Benítez', '93 Lakeview Drive', 'Triphase', 'Industrial', 'Guaraúnos', 'Guaraúnos', 'Cadiem', '1302r', '7'),
(67, 'WJRJKDD', 'Installed', '37.5', 'Benítez', '93 Lakeview Drive', 'Triphase', 'Industrial', 'Guaraúnos', 'Guaraúnos', 'Mevar', 'R-705', '10'),
(68, 'RY6P2F', 'Damaged', '75', 'Bermúdez', '5689 Walnut Avenue', 'Triphase', 'Residential', 'Bolívar', 'Güiria', 'Caivet', 'Dur51', '9'),
(69, 'EHSLSD', 'Installed', '165', 'Bermúdez', '390 Front Street North', 'Triphase', 'Commercial', 'Santa Rosa', 'Caratalito', 'Selvitrav', 'P58p', '11'),
(70, 'RD91Z2Z', 'Installed', '37.5', 'Bermúdez', '390 Front Street North', 'Triphase', 'Commercial', 'Santa Rosa', 'Caratalito', 'Cadiem', '91816MA', '1'),
(71, 'WH4SVZM', 'Installed', '100', 'Bermúdez', '390 Front Street North', 'Triphase', 'Commercial', 'Santa Rosa', 'Caratalito', 'Mevar', 'R-183', '2'),
(72, 'YHDDJX', 'Installed', '50', 'Bermúdez', '7812 Monroe Street', 'Monophase', 'Industrial', 'Santa Rosa', 'Chipichipe', 'Mevar', 'R-830', '8'),
(73, '8WX04Z', 'Installed', '75', 'Bermúdez', '7480 9th Street', 'Monophase', 'Industrial', 'Santa Rosa', 'Cusma', 'Selvitrav', 'r82T', '6'),
(74, 'K6670FZL', 'Damaged', '100', 'Bermúdez', '65 Cherry Lane', 'Monophase', 'Commercial', 'Santa Catalina', 'Guayacán de las Flores', 'Mevar', 'R-104', '5'),
(75, 'C5WG3YZ', 'Damaged', '15', 'Bermúdez', '241 3rd Street West', 'Monophase', 'Industrial', 'Santa Rosa', 'Chipichipe', 'Transforvenca', 'sn53', '8'),
(76, 'LHAAHAE', 'Damaged', '37.5', 'Bermúdez', '5647 Pine Street', 'Triphase', 'Commercial', 'Bolívar', 'Londres', 'Mevar', 'R-183', '10'),
(77, 'V4J4W51S', 'Damaged', '10', 'Service Central', 'Calle La Planta', 'Monophase', 'Residential', 'Santa Catalina', 'Sector El Valle', 'Transforvenca', 'ws394', '7'),
(78, '86FAHUKA', 'Installed', '165', 'Bermúdez', '4584 5th Street', 'Monophase', 'Commercial', 'Santa Catalina', 'El Charcal', 'Transforvenca', 'ws394', '11'),
(79, 'XPM6T6YZ', 'Installed', '37.5', 'Bermúdez', '11956 Fairview Avenue', 'Triphase', 'Residential', 'Santa Rosa', 'Cusma', 'Cacei', 'Pine25', '1'),
(80, 'NLZ2NUW', 'Installed', '15', 'Bermúdez', '11956 Fairview Avenue', 'Triphase', 'Residential', 'Santa Rosa', 'Cusma', 'Selvitrav', 'r82T', '9'),
(81, 'OM2RHSK', 'Installed', '50', 'Bermúdez', '11956 Fairview Avenue', 'Triphase', 'Residential', 'Santa Rosa', 'Cusma', 'Caivet', 'Cst26', '12'),
(82, 'Z55B32', 'Installed', '37.5', 'Cajigal', '8001 Fairway Drive', 'Triphase', 'Residential', 'Yaguaraparo', 'Buenos Aires', 'Transforvenca', 'ww459', '11'),
(83, 'RMIDXR9', 'Installed', '25', 'Cajigal', '8001 Fairway Drive', 'Triphase', 'Residential', 'Yaguaraparo', 'Buenos Aires', 'Caivet', 'Hld49', '10'),
(84, 'IJ3JB9E', 'Installed', '75', 'Cajigal', '8001 Fairway Drive', 'Triphase', 'Residential', 'Yaguaraparo', 'Buenos Aires', 'Cadiem', '15fS', '9'),
(85, '9A2AW6', 'Installed', '165', 'Cajigal', '22835 Hickory Lane', 'Monophase', 'Industrial', 'Libertad', 'El Islote', 'Cacei', 'Cam24', '5'),
(86, '30XS2M', 'Damaged', '100', 'Cajigal', '40 Circle Drive', 'Monophase', 'Residential', 'Yaguaraparo', 'La Chivera', 'Caivet', 'GrV501', '2'),
(87, 'M065V0', 'Damaged', '25', 'Cajigal', 'Barrio Catia Arriba, Esquina 4', 'Triphase', 'Industrial', 'Yaguaraparo', 'La Horqueta', 'Cacei', 'Main34', '11'),
(88, 'GW47YW', 'Installed', '25', 'Cajigal', 'Urbanización Las Colombias', 'Monophase', 'Residential', 'Libertad', 'Valle Solo', 'Selvitrav', 'r82T', '7'),
(89, 'EBE2K1G', 'Installed', '50', 'Cajigal', 'Calle San Martin', 'Monophase', 'Industrial', 'Yaguaraparo', 'El Cantón', 'Selvitrav', 'P58p', '7'),
(90, 'FZCDGH2', 'Damaged', '37.5', 'Cajigal', 'Sector Santa Rosa', 'Monophase', 'Commercial', 'Yaguaraparo', 'La Montaña', 'Cacei', 'Main34', '4'),
(91, 'LN89F3J', 'Installed', '50', 'Cajigal', 'Av. Carabobo', 'Triphase', 'Industrial', 'El Paujil', 'El Cobre', 'Selvitrav', 'P58p', '8'),
(92, '8Q44ESV', 'Installed', '37.5', 'Cajigal', 'Av. Carabobo', 'Triphase', 'Industrial', 'El Paujil', 'El Cobre', 'Selvitrav', 'r82T', '10'),
(93, 'VXZL1TV', 'Installed', '5', 'Cajigal', 'Av. Carabobo', 'Triphase', 'Industrial', 'El Paujil', 'El Cobre', 'Cacei', 'Pine25', '1'),
(94, 'V33U97A', 'Installed', '10', 'Cajigal', 'Urbanización Sucre Calle Guarenas', 'Monophase', 'Commercial', 'Libertad', 'Betania', 'Cacei', '392nd', '3'),
(95, '4HNB3E', 'Installed', '15', 'Cajigal', 'Barrio José María Carreño', 'Monophase', 'Industrial', 'Libertad', 'Riito Arriba', 'Cacei', 'Cam24', '12'),
(96, 'M9MKC', 'Damaged', '50', 'Libertador', 'Calle La Esmeralda', 'Monophase', 'Residential', 'Tunapuy', 'Catuaro Abajo', 'Mevar', 'R-830', '12'),
(97, '4Z7ECZ', 'Installed', '10', 'Libertador', 'Av. Tamanaco', 'Monophase', 'Industrial', 'Tunapuy', 'Jabillal', 'Cadiem', '15fs', '7'),
(98, 'UKAC5', 'Installed', '5', 'Libertador', 'Sector Quinta Crespo', 'Triphase', 'Commercial', 'Campo Elías', 'Guayana', 'Caivet', 'Cst26', '12'),
(99, '81WBRK7', 'Installed', '165', 'Libertador', 'Sector Quinta Crespo', 'Triphase', 'Commercial', 'Campo Elías', 'Guayana', 'Cadiem', '15fS', '9'),
(100, 'LCRRPK3', 'Installed', '15', 'Libertador', 'Sector Quinta Crespo', 'Triphase', 'Commercial', 'Campo Elías', 'Guayana', 'Cacei', 'Pine25', '7'),
(101, 'PPAUBD', 'Damaged', '15', 'Libertador', 'Barrio La Castellana, Esquina 4', 'Monophase', 'Commercial', 'Campo Elías', 'Cangrejal', 'Selvitrav', 'r82T', '5'),
(102, '3BCJ69J', 'Installed', '10', 'Libertador', 'Urbanización Vicente Amengual', 'Monophase', 'Residential', 'Tunapuy', 'Catuaro Arriba', 'Caivet', 'Dur51', '9'),
(103, 'K8G9MH', 'Damaged', '165', 'Libertador', 'Calle Coche Aragua', 'Monophase', 'Industrial', 'Tunapuy', 'Platanito Arriba', 'Cadiem', '1302r', '11'),
(104, 'B15B2X4', 'Installed', '15', 'Libertador', 'Sector Calicanto', 'Triphase', 'Industrial', 'Campo Elías', 'Cangrejal', 'Cadiem', '91816MA', '4'),
(105, 'RK6R8QE', 'Installed', '05', 'Libertador', 'Sector Calicanto', 'Triphase', 'Industrial', 'Campo Elías', 'Cangrejal', 'Mevar', 'R_14', '10'),
(106, 'KB71U0L', 'Installed', '50', 'Libertador', 'Sector Calicanto', 'Triphase', 'Industrial', 'Campo Elías', 'Cangrejal', 'Transforvenca', 'ws394', '7'),
(107, 'WX1U7J8', 'Damaged', '25', 'Libertador', 'Av. La Providencia', 'Triphase', 'Commercial', 'Campo Elías', 'Río de Agua', 'Selvitrav', 'r82T', '5'),
(108, 'ULNKGR', 'Installed', '10', 'Libertador', 'Urbanización La Hormiguita', 'Monophase', 'Residential', 'Campo Elías', 'Guayana', 'Cacei', 'Pine25', '3'),
(109, 'L6XW41C', 'Damaged', '50', 'Libertador', 'Barrio José Degredo', 'Monophase', 'Residential', 'Campo Elías', 'Cangrejal', 'Cacei', '80Wal', '1'),
(110, 'TUDA6F2', 'Installed', '10', 'Mariño', 'Calle Boleita Norte', 'Triphase', 'Commercial', 'Soro', 'Las Peñas', 'Selvitrav', 'Hm25t', '2'),
(111, 'C1Q2EYH', 'Installed', '165', 'Mariño', 'Calle Boleita Norte', 'Triphase', 'Commercial', 'Soro', 'Las Peñas', 'Transforvenca', 'es54', '6'),
(112, 'BK8FYC3', 'Installed', '37.5', 'Mariño', 'Calle Boleita Norte', 'Triphase', 'Commercial', 'Soro', 'Las Peñas', 'Caivet', 'cst', '1'),
(113, '12CVR4', 'Damaged', '37.5', 'Mariño', 'Av. El Cementerio', 'Triphase', 'Commercial', 'Marabal', 'Valencia', 'Caivet', 'GrV501', '5'),
(114, 'RJX289Z', 'Installed', '165', 'Mariño', 'Sector Los Palos Grandes', 'Monophase', 'Industrial', 'Campo Claro', 'El Curi', 'Selvitrav', 'Hm25t', '11'),
(115, 'JUDGXH', 'Installed', '37.5', 'Mariño', 'Barrio El Morao, Esquina 4', 'Monophase', 'Industrial', 'Irapa', 'Altagracia', 'Cacei', '18div43', '3'),
(116, '20TPDP', 'Damaged', '100', 'Mariño', 'Urbanización Valle Arriba', 'Monophase', 'Industrial', 'Marabal', 'Marabal', 'Selvitrav', 'P58p', '10'),
(117, '0ZG6JYE', 'Installed', '15', 'Mariño', 'Calle Libertador', 'Triphase', 'Commercial', 'Campo Claro', 'Buenos Aires', 'Selvitrav', 'P58p', '3'),
(118, 'OFCV7XQ', 'Installed', '15', 'Mariño', 'Calle Libertador', 'Triphase', 'Commercial', 'Campo Claro', 'Buenos Aires', 'Cadiem', '91816MA', '1'),
(119, 'B1R69ZL', 'Installed', '10', 'Mariño', 'Calle Libertador', 'Triphase', 'Commercial', 'Campo Claro', 'Buenos Aires', 'Cacei', 'Cam24', '9'),
(120, '239ZER', 'Damaged', '25', 'Mariño', 'Sector El Cafetal', 'Triphase', 'Industrial', 'Soro', 'Juan Pedro', 'Cadiem', '7169n', '8'),
(121, 'BVKSFW', 'Installed', '10', 'Mariño', 'Av. La Parcela', 'Triphase', 'Residential', 'Campo Claro', 'El Curi', 'Mevar', 'R-514', '11'),
(122, 'PSTXPBE', 'Installed', '50', 'Mariño', 'Av. La Parcela', 'Triphase', 'Residential', 'Campo Claro', 'El Curi', 'Caivet', 'Cst26', '7'),
(123, 'XPBELNU', 'Installed', '75', 'Mariño', 'Av. La Parcela', 'Triphase', 'Residential', 'Campo Claro', 'El Curi', 'Caivet', 'Dur51', '3'),
(124, 'LEN89Z', 'Installed', '75', 'Mariño', 'Urbanización El Marqués', 'Monophase', 'Industrial', 'Irapa', 'Las Melenas', 'Selvitrav', 'P58p', '11'),
(125, 'A88669', 'Damaged', '5', 'Mariño', 'Barrio Ejido Norte', 'Monophase', 'Residential', 'Marabal', 'Corozal', 'Mevar', 'R-514', '8'),
(126, 'XUZJ1MT', 'Installed', '10', 'Valdez', 'Urbanización La Romana', 'Monophase', 'Commercial', 'Bideau', 'Cumaquita', 'Caivet', 'Cst26', '5'),
(127, 'E6DBWAN', 'Installed', '37.5', 'Valdez', 'Calle Narvaez n7 con 2', 'Monophase', 'Commercial', 'Bideau', 'El Jobal', 'Transforvenca', 'ww459', '6'),
(128, 'ADBDKBW', 'Damaged', '5', 'Valdez', 'Avenida La Concordia', 'Triphase', 'Commercial', 'Cristóbal Colón', 'Macurito', 'Selvitrav', 'r82T', '11'),
(129, 'GHRN5OR', 'Installed', '50', 'Valdez', 'Barrio Bella Vista', 'Triphase', 'Residential', 'Punta de Piedras', 'La Paloma', 'Mevar', 'R-104', '10'),
(130, 'SO1YS39', 'Installed', '10', 'Valdez', 'Barrio Bella Vista', 'Triphase', 'Residential', 'Punta de Piedras', 'La Paloma', 'Caivet', 'Dur51', '9'),
(131, 'SVMRGIK', 'Installed', '50', 'Valdez', 'Barrio Bella Vista', 'Triphase', 'Residential', 'Punta de Piedras', 'La Paloma', 'Caivet', 'GrV501', '4'),
(132, 'D42B8LN', 'Damaged', '15', 'Valdez', 'Parcela Los Mangos', 'Triphase', 'Industrial', 'Bideau', 'Cumaquita', 'Transforvenca', 'es54', '5'),
(133, 'S3S4R03', 'Installed', '37.5', 'Valdez', 'Intersección La Florida y Tinaquillo', 'Monophase', 'Residential', 'Punta de Piedras', 'Las Piedras', 'Cadiem', '15fS', '9'),
(134, 'PZA20I9', 'Damaged', '15', 'Valdez', 'Av. Los Mangos', 'Monophase', 'Industrial', 'Güiria', 'Río de Güiria', 'Selvitrav', 'r82T', '2'),
(135, '34RHA6F', 'Installed', '50', 'Valdez', 'Calle San Carlos de Zulia', 'Triphase', 'Industrial', 'Bideau', 'Cerro Seco', 'Cadiem', '1302r', '10'),
(136, 'CSPPQT8', 'Installed', '100', 'Valdez', 'Calle San Carlos de Zulia', 'Triphase', 'Industrial', 'Bideau', 'Cerro Seco', 'Mevar', 'R-830', '11'),
(137, 'DBC50V8', 'Installed', '15', 'Valdez', 'Calle San Carlos de Zulia', 'Triphase', 'Industrial', 'Bideau', 'Cerro Seco', 'Transforvenca', 'ww459', '8'),
(138, 'PR11BDE', 'Installed', '5', 'Valdez', 'Esquina Sur Plaza Bolívar', 'Monophase', 'Commercial', 'Bideau', 'El Tamarindo', 'Selvitrav', 'r82T', '4'),
(139, 'JXS64CB', 'Installed', '100', 'Valdez', 'Urbanización Filas de Mariche', 'Triphase', 'Commercial', 'Cristóbal Colón', 'Macurito', 'Selvitrav', 'r82T', '4'),
(140, 'W3960J6', 'Installed', '25', 'Valdez', 'Urbanización Filas de Mariche', 'Triphase', 'Commercial', 'Cristóbal Colón', 'Macurito', 'Caivet', 'GrV501', '8'),
(141, 'QATI6CS', 'Installed', '100', 'Valdez', 'Urbanización Filas de Mariche', 'Triphase', 'Commercial', 'Cristóbal Colón', 'Macurito', 'Selvitrav', 'P58p', '5'),
(142, 'PYILFZ0', 'Stock', '10', 'Service Central', 'Calle La Planta', 'Triphase', 'Residential', 'Santa Catalina', 'Sector El Valle', 'Selvitrav', 'Hm25t', '9'),
(143, 'VPNJ31X', 'Stock', '15', 'Service Central', 'Calle La Planta', 'Monophase', 'Residential', 'Santa Catalina', 'Sector El Valle', 'Caivet', 'Hld49', '7'),
(144, 'NADPUZH', 'Damaged', '165', 'Service Central', 'Calle La Planta', 'Monophase', 'Residential', 'Santa Catalina', 'Sector El Valle', 'Mevar', 'R-514', '9'),
(145, 'QCV491G', 'Stock', '75', 'Service Central', 'Calle La Planta', 'Triphase', 'Commercial', 'Santa Catalina', 'Sector El Valle', 'Mevar', 'R- 705', '7'),
(146, '8TBCPNP', 'Damaged', '100', 'Service Central', 'Calle La Planta', 'Monophase', 'Residential', 'Santa Catalina', 'Sector El Valle', 'Caivet', 'Dur51', '8'),
(147, '0520QAC', 'Stock', '165', 'Service Central', 'Calle La Planta', 'Triphase', 'Residential', 'Santa Catalina', 'Sector El Valle', 'Caivet', 'Cst26', '7'),
(148, 'WKD7TTJ', 'Damaged', '100', 'Service Central', 'Calle La Planta', 'Triphase', 'Industrial', 'Santa Catalina', 'Sector El Valle', 'Selvitrav', 'Hm25t', '6'),
(149, 'W5IQ4KU', 'Stock', '165', 'Service Central', 'Calle La Planta', 'Triphase', 'Industrial', 'Santa Catalina', 'Sector El Valle', 'Mevar', 'R-183', '12'),
(150, 'W8FJLCY', 'Stock', '75', 'Service Central', 'Calle La Planta', 'Triphase', 'Commercial', 'Santa Catalina', 'Sector El Valle', 'Transforvenca', 'ws394', '1'),
(151, 'WOKMVK0', 'Stock', '165', 'Service Central', 'Calle La Planta', 'Monophase', 'Residential', 'Santa Catalina', 'Sector El Valle', 'Selvitrav', 'r82T', '1'),
(152, 'JA8R7YZ', 'Damaged', '75', 'Andrés Mata', 'Avenida El Vigía Sector Panamericana', 'Triphase', 'Commercial', 'San José de Areocuar', 'Loma de Chuparipal', 'Cacei', '80Wal', '8'),
(153, 'TQQHDM7', 'Damaged', '37.5', 'Andrés Mata', 'Sector Chacao Barrio San Cristóbal ', 'Monophase', 'Industrial', 'San José de Areocuar', 'Camino de Cariaco', 'Selvitrav', 'r82T', '3'),
(154, '7PO5VHK', 'Installed', '100', 'Andrés Mata', 'Avenida Alianza Calle San Cristóbal', 'Monophase', 'Industrial', 'San José de Areocuar', 'La Alianza', 'Selvitrav', 'r82T', '4'),
(155, 'SKWZNDS', 'Damaged', '37.5', 'Andrés Mata', 'Barrio Chacao Calle El Recreo', 'Monophase', 'Residential', 'San José de Areocuar', 'La Esperanza', 'Transforvenca', 'ww459', '9'),
(156, 'N2B1TNA', 'Installed', '165', 'Andrés Mata', 'Urbanización Colombia Calle El Cementerio', 'Monophase', 'Residential', 'San José de Areocuar', 'La Parima', 'Caivet', 'Hld49', '7'),
(157, '27K3Q0T', 'Damaged', '10', 'Arismendi', 'Urbanización Vicente Amengual Calle El Rosal ', 'Monophase', 'Residential', 'Puerto Santo', 'Mapire', 'Caivet', 'Cst26', '12'),
(158, 'K0YD374', 'Installed', '10', 'Arismendi', 'Sector Colón Urbanización Colombia', 'Monophase', 'Commercial', 'San Juan de las Galdonas', 'Tucuchire', 'Mevar', 'R- 705', '8'),
(159, 'M4GD7YJ', 'Installed', '15', 'Arismendi', 'Barrio Santa Mónica Calle El Hatillo', 'Triphase', 'Industrial', 'San Juan de las Galdonas', 'Cangua', 'Selvitrav', 'Hm25t', '11'),
(160, 'XPCMUC5', 'Installed', '37.5', 'Arismendi', 'Barrio Santa Mónica Calle El Hatillo', 'Triphase', 'Industrial', 'San Juan de las Galdonas', 'Cangua', 'Selvitrav', 'r82T', '4'),
(161, 'WMSAWU3', 'Installed', '25', 'Arismendi', 'Barrio Santa Mónica Calle El Hatillo', 'Triphase', 'Industrial', 'San Juan de las Galdonas', 'Cangua', 'Transforvenca', 'es54', '12'),
(162, '2MVYCTS', 'Damaged', '75', 'Arismendi', 'Sector Las Delicias Avenida Tinaquillo', 'Monophase', 'Industrial', 'El Morro de Puerto Santo', 'El Morro de Puerto Santo', 'Caivet', 'Hld49', '2'),
(163, 'GHPC1SN', 'Stock', '25', 'Service Central', 'Calle La Planta', 'Triphase', 'Industrial', 'Santa Catalina', 'Sector El Valle', 'Mevar', 'R- 705', '8'),
(164, 'PRW7TAW', 'Damaged', '165', 'Benítez', 'Sector El Rosal Barrio El Vigía', 'Monophase', 'Commercial', 'Guaraúnos', 'Guaraúnos', 'Transforvenca', 'ws394', '2'),
(165, '81VONAE', 'Installed', '5', 'Benítez', 'Sector Baruta Barrio Coche Aragua', 'Triphase', 'Residential', 'El Pilar', 'Río Grande', 'Selvitrav', 'P58p', '5'),
(166, '44VA2L0', 'Installed', '50', 'Benítez', 'Sector Baruta Barrio Coche Aragua', 'Triphase', 'Residential', 'El Pilar', 'Río Grande', 'Transforvenca', 'ww459', '6'),
(167, 'BYRZ4BG', 'Installed', '165', 'Benítez', 'Sector Baruta Barrio Coche Aragua', 'Triphase', 'Residential', 'El Pilar', 'Río Grande', 'Cacei', 'Main34', '2'),
(168, 'S0UOMEN', 'Installed', '5', 'Benítez', 'Sector Esmeralda Barrio Boleita Norte', 'Monophase', 'Residential', 'El Rincón', 'Guasimal', 'Caivet', 'GrV501', '4'),
(169, 'F958Z0S', 'Damaged', '100', 'Benítez', 'Sector San Cristóbal Calle Los Castaños', 'Triphase', 'Industrial', 'Guaraúnos', 'Guaraúnos', 'Mevar', 'R-104', '2'),
(170, 'KKFYZ70', 'Damaged', '25', 'Benítez', 'Sector Alondra Calle Montalbán', 'Monophase', 'Industrial', 'El Rincón', 'Guasimal', 'Mevar', 'R-830', '7'),
(171, '9ZZUKCX', 'Installed', '75', 'Bermúdez', 'Barrio Colombia Calle Panamericana', 'Monophase', 'Industrial', 'Santa Rosa', 'Chipichipe', 'Selvitrav', 'r82T', '11'),
(172, '18G7KVP', 'Installed', '165', 'Bermúdez', 'Urbanización La Parcela Barrio Montalbán', 'Triphase', 'Industrial', 'Macarapana', 'La Sierra', 'Transforvenca', 'ws394', '6'),
(173, 'YCINOBA', 'Installed', '75', 'Bermúdez', 'Urbanización La Parcela Barrio Montalbán', 'Triphase', 'Industrial', 'Macarapana', 'La Sierra', 'Caivet', 'Dur51', '7'),
(174, 'P0BY3DM', 'Installed', '25', 'Bermúdez', 'Urbanización La Parcela Barrio Montalbán', 'Triphase', 'Industrial', 'Macarapana', 'La Sierra', 'Selvitrav', 'r82T', '11'),
(175, 'XK916NZ', 'Damaged', '50', 'Bermúdez', 'Avenida La Florida Sector Carora', 'Triphase', 'Industrial', 'Santa Rosa', 'Cusma', 'Selvitrav', 'Hm25t', '3'),
(176, '276D1UK', 'Installed', '25', 'Bermúdez', 'Avenida Catia Urbanización Quinta Crespo', 'Monophase', 'Industrial', 'Bolívar', 'Playa Grande Arriba', 'Mevar', 'R-183', '10'),
(177, 'TDOQ8PV', 'Installed', '50', 'Bermúdez', 'Sector Plaza Bolívar Calle Quinta Crespo', 'Triphase', 'Commercial', 'Macarapana', 'Canaima', 'Selvitrav', 'r82T', '1'),
(178, 'JO5K5IQ', 'Installed', '100', 'Bermúdez', 'Sector Plaza Bolívar Calle Quinta Crespo', 'Triphase', 'Commercial', 'Macarapana', 'Canaima', 'Mevar', 'R-183', '8'),
(179, '45KKQMD', 'Installed', '10', 'Bermúdez', 'Sector Plaza Bolívar Calle Quinta Crespo', 'Triphase', 'Commercial', 'Macarapana', 'Canaima', 'Cacei', 'Pine25', '12'),
(180, 'RCFKQT3', 'Installed', '5', 'Cajigal', 'Avenida Rivera Brava Barrio Las Mercedes', 'Triphase', 'Residential', 'Yaguaraparo', 'El Cantón', 'Selvitrav', 'P58p', '3'),
(181, 'CN9ZQ2G', 'Installed', '165', 'Cajigal', 'Avenida Rivera Brava Barrio Las Mercedes', 'Triphase', 'Residential', 'Yaguaraparo', 'El Cantón', 'Mevar', 'R-183', '8'),
(182, '15CGC9L', 'Installed', '50', 'Cajigal', 'Avenida Rivera Brava Barrio Las Mercedes', 'Triphase', 'Residential', 'Yaguaraparo', 'El Cantón', 'Mevar', 'R-183', '10'),
(183, 'MGHSY1O', 'Damaged', '10', 'Cajigal', 'Sector Libertador Urbanización La Hormiguita', 'Monophase', 'Industrial', 'El Paujil', 'Cachipal', 'Caivet', 'GrV501', '9'),
(184, 'FCVG0GD', 'Installed', '15', 'Cajigal', 'Avenida Filas de Mariche cruce con Avenida Guayabal', 'Triphase', 'Industrial', 'Yaguaraparo', 'La Montaña', 'Mevar', 'R-183', '3'),
(185, 'O72N2J3', 'Installed', '15', 'Cajigal', 'Avenida Filas de Mariche cruce con Avenida Guayabal', 'Triphase', 'Industrial', 'Yaguaraparo', 'La Montaña', 'Cadiem', '7169n', '10'),
(186, 'SU2ZQO9', 'Installed', '5', 'Cajigal', 'Avenida Filas de Mariche cruce con Avenida Guayabal', 'Triphase', 'Industrial', 'Yaguaraparo', 'La Montaña', 'Cacei', 'Main34', '8'),
(187, 'LN24Q48', 'Installed', '5', 'Cajigal', 'Avenida Panamericana Urbanización La Providencia', 'Monophase', 'Industrial', 'El Paujil', 'Cachipal', 'Cadiem', '7169n', '10'),
(188, 'LTL3SJC', 'Installed', '75', 'Cajigal', 'Avenida Colombia Calle Colón', 'Triphase', 'Industrial', 'El Paujil', 'El Brasil', 'Caivet', 'Cst26', '2'),
(189, 'HH5AF7I', 'Installed', '75', 'Cajigal', 'Avenida Colombia Calle Colón', 'Triphase', 'Industrial', 'El Paujil', 'El Brasil', 'Cacei', '80Wal', '11'),
(190, 'BMXVV8C', 'Installed', '25', 'Cajigal', 'Avenida Colombia Calle Colón', 'Triphase', 'Industrial', 'El Paujil', 'El Brasil', 'Cacei', 'Main34', '2'),
(191, '3U97ZVE', 'Damaged', '100', 'Libertador', 'Sector El Marqués Calle San Cristóbal', 'Monophase', 'Commercial', 'Campo Elías', 'Río de Agua', 'Selvitrav', 'r82T', '7'),
(192, 'I1AN01I', 'Damaged', '25', 'Libertador', 'Sector Guarenas Calle Boleita Norte', 'Monophase', 'Residential', 'Campo Elías', 'Río de Agua', 'Cacei', 'Main34', '12'),
(193, '034SMTW', 'Installed', '165', 'Libertador', 'Avenida La Castellana Barrio Talleres Crespo', 'Monophase', 'Industrial', 'Campo Elías', 'Cangrejal', 'Cacei', 'Pine25', '6'),
(194, 'T0L51PU', 'Damaged', '75', 'Libertador', 'Avenida Sucre Barrio Esmeralda', 'Monophase', 'Residential', 'Tunapuy', 'Jabillal', 'Cadiem', '1302r', '7'),
(195, 'WFLQBCO', 'Damaged', '5', 'Libertador', 'Sector Colón Calle Las Flores', 'Monophase', 'Commercial', 'Tunapuy', 'La Cumbre de San Antonio', 'Transforvenca', 'es54', '11'),
(196, 'P63GWE2', 'Installed', '100', 'Mariño', 'Sector Rosalíta Calle La Providencia', 'Monophase', 'Industrial', 'San Antonio de Irapa', 'San Antonio', 'Caivet', 'Hld49', '6'),
(197, '5SI3F6R', 'Damaged', '10', 'Mariño', 'Sector Urdaneta Urbanización Tierra Negra', 'Triphase', 'Commercial', 'Irapa', 'Santa María', 'Mevar', 'R-514', '2'),
(198, 'MGSU6AC', 'Installed', '75', 'Mariño', 'Urbanización José María Carreño Sector Guarenas', 'Triphase', 'Residential', 'Campo Claro', 'Concepción', 'Cacei', 'Pine25', '7'),
(199, 'HKVHFJC', 'Installed', '15', 'Mariño', 'Urbanización José María Carreño Sector Guarenas', 'Triphase', 'Residential', 'Campo Claro', 'Concepción', 'Cacei', 'Main34', '1'),
(200, '1QTI1PT', 'Installed', '5', 'Mariño', 'Urbanización José María Carreño Sector Guarenas', 'Triphase', 'Residential', 'Campo Claro', 'Concepción', 'Selvitrav', 'r82T', '5'),
(201, 'C2RI4A1', 'Damaged', '100', 'Mariño', 'Sector Baruta Barrio Maracay', 'Monophase', 'Residential', 'San Antonio de Irapa', 'San Antonio', 'Cadiem', '7169n', '3'),
(202, 'I9MPMZ6', 'Installed', '15', 'Mariño', 'Sector Catia Urbanización Dos Ríos', 'Triphase', 'Industrial', 'Irapa', 'Río Chiquito Arriba', 'Cadiem', '91816MA', '11'),
(203, 'V60TYJQ', 'Installed', '75', 'Mariño', 'Sector Catia Urbanización Dos Ríos', 'Triphase', 'Industrial', 'Irapa', 'Río Chiquito Arriba', 'Caivet', 'Hld49', '6'),
(204, '8NK0PEB', 'Installed', '100', 'Mariño', 'Sector Catia Urbanización Dos Ríos', 'Triphase', 'Industrial', 'Irapa', 'Río Chiquito Arriba', 'Transforvenca', 'ws394', '9'),
(205, 'O1B6EBA', 'Damaged', '37.5', 'Valdez', 'Barrio Los Mangos Urbanización Montalbán ', 'Monophase', 'Residential', 'Cristóbal Colón', 'Puerto de Hierro', 'Mevar', 'R-514', '2'),
(206, 'SP3KHRR', 'Installed', '165', 'Valdez', 'Urbanización El Lago Barrio Los Castaños', 'Triphase', 'Residential', 'Punta de Piedras', 'Calle El Medio', 'Caivet', 'Hld49', '10'),
(207, 'IIB1P6R', 'Installed', '25', 'Valdez', 'Urbanización El Lago Barrio Los Castaños', 'Triphase', 'Residential', 'Punta de Piedras', 'Calle El Medio', 'Cadiem', '1302r', '56'),
(208, 'HNRFOP6', 'Installed', '75', 'Valdez', 'Urbanización El Lago Barrio Los Castaños', 'Triphase', 'Residential', 'Punta de Piedras', 'Calle El Medio', 'Cacei', '80Wal', '8'),
(209, 'R8D2XYD', 'Damaged', '50', 'Valdez', 'Urbanización Baruta Sector San Martin', 'Triphase', 'Industrial', 'Punta de Piedras', 'El Guamal', 'Cacei', '18div43', '4'),
(210, 'Z5N1F14', 'Installed', '37.5', 'Valdez', 'Urbanización La Providencia Calle Montalbán', 'Monophase', 'Residential', 'Cristóbal Colón', 'Cariaquito', 'Transforvenca', 'sn53', '12'),
(211, 'KKMIL35', 'Damaged', '50', 'Valdez', 'Urbanización La Parcela Barrio Avila', 'Triphase', 'Commercial', 'Cristóbal Colón', 'La Iglesia', 'Cadiem', '91816MA', '7'),
(212, 'KWNGAYT', 'Damaged', '100', 'Service Central', 'Calle La Planta', 'Monophase', 'Commercial', 'Santa Catalina', 'Sector El Valle', 'Transforvenca', 'es54', '10'),
(213, 'HXWIO4N', 'Stock', '100', 'Service Central', 'Calle La Planta', 'Monophase', 'Industrial', 'Santa Catalina', 'Sector El Valle', 'Mevar', 'R-514', '10'),
(214, '9TC6LBP', 'Damaged', '25', 'Service Central', 'Calle La Planta', 'Triphase', 'Industrial', 'Santa Catalina', 'Sector El Valle', 'Transforvenca', 'es54', '8'),
(215, 'B8L6RT2', 'Damaged', '25', 'Service Central', 'Calle La Planta', 'Monophase', 'Industrial', 'Santa Catalina', 'Sector El Valle', 'Transforvenca', 'ws394', '7'),
(216, 'EREIRVZ', 'Installed', '75', 'Bermúdez', '602 3rd Street West', 'Triphase', 'Commercial', 'Santa Rosa', 'Caratalito', 'Mevar', 'R- 705', '8'),
(244, 'SR15QIY', 'Damaged', '165', 'Bermúdez', 'Sector El Recreo Calle Alianza', 'Triphase', 'Commercial', 'Santa Catalina', 'Sanguijuela', 'Caivet', 'Hld49', '12'),
(290, 'B28PLZ3', 'Damaged', '37.5', 'Cajigal', 'Sector Maracay Avenida San Cristóbal', 'Monophase', 'Industrial', 'El Paujil', 'El Brasil', 'Selvitrav', 'P58p', '3'),
(291, '5LIRZ9Q', 'Installed', '100', 'Cajigal', 'Avenida El Cafetal Calle Quinta Crespo', 'Monophase', 'Industrial', 'El Paujil', 'El Paujil', 'Selvitrav', 'Hm25t', '5'),
(292, 'ANSSDWZ', 'Installed', '25', 'Libertador', 'Barrio Catia Calle Talleres Crespo', 'Monophase', 'Commercial', 'Tunapuy', 'Cumbre de Manacal', 'Caivet', 'Hld49', '4'),
(293, 'CH0MG5K', 'Installed', '25', 'Libertador', 'Sector El Hatillo Urbanización Mario Briceño Iragorry', 'Triphase', 'Industrial', 'Tunapuy', 'Catuchal', 'Selvitrav', 'Hm25t', '11'),
(294, '8XH9DJR', 'Damaged', '50', 'Mariño', 'Avenida Sucre Sector Las Flores', 'Monophase', 'Commercial', 'Marabal', 'Corozal', 'Selvitrav', 'P58p', '11'),
(295, 'D588L2C', 'Installed', '10', 'Mariño', 'Calle Boleita Norte Avenida Sucre', 'Monophase', 'Industrial', 'Campo Claro', 'Naranjal', 'Selvitrav', 'Hm25t', '9'),
(296, 'JMCXSSR', 'Damaged', '25', 'Valdez', '19622 Main Street South', 'Triphase', 'Residential', 'Cristóbal Colón', 'Macurito', 'Mevar', 'R-183', '12'),
(297, 'DK7ISR6', 'Damaged', '5', 'Valdez', 'Calle El Paraíso Barrio Provincial', 'Monophase', 'Commercial', 'Punta de Piedras', 'El Guamal', 'Caivet', 'Cst26', '9'),
(298, 'MQAR0GU', 'Installed', '100', 'Valdez', 'Barrio Los Mangos Calle Quinta Crespo', 'Triphase', 'Commercial', 'Güiria', 'Güiria', 'Cadiem', '7169n', '3'),
(299, 'X4ZY0NY', 'Damaged', '25', 'Service Central', 'Calle La Planta', 'Triphase', 'Commercial', 'Santa Catalina', 'Sector El Valle', 'Mevar', 'R-104', '5'),
(300, 'OB5Q7LM', 'Damaged', '100', 'Service Central', 'Calle La Planta', 'Triphase', 'Residential', 'Santa Catalina', 'Sector El Valle', 'Transforvenca', 'ws394', '12'),
(303, 'TE7X7RH', 'Installed', '75', 'Libertador', 'Sector El Hatillo Urbanización Mario Briceño Iragorry', 'Triphase', 'Industrial', 'Tunapuy', 'Catuchal', 'Cacei', '18div43', '11'),
(304, '33UO2KG', 'Installed', '165', 'Libertador', 'Sector El Hatillo Urbanización Mario Briceño Iragorry', 'Triphase', 'Industrial', 'Tunapuy', 'Catuchal', 'Caivet', 'GrV501', '9'),
(305, 'W94X57P', 'Installed', '37.5', 'Valdez', 'Barrio Los Mangos Calle Quinta Crespo', 'Triphase', 'Commercial', 'Güiria', 'Güiria', 'Cacei', '18div43', '1'),
(306, 'VU4MX7H', 'Installed', '15', 'Valdez', 'Barrio Los Mangos Calle Quinta Crespo', 'Triphase', 'Commercial', 'Güiria', 'Güiria', 'Transforvenca', 'ww459', '7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(255) NOT NULL,
  `userCodigo` varchar(255) NOT NULL,
  `userUsername` varchar(255) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `userType` varchar(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `userLastname` varchar(255) NOT NULL,
  `userCargo` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `userCodigo`, `userUsername`, `userPassword`, `userType`, `userName`, `userLastname`, `userCargo`, `userEmail`) VALUES
(22, 'A4578498-1', 'quietimpulse', '$2y$10$uY.7WtAgqXD0E2gTceuVrO2Fj2Y2FzQupwc7TIZKUfZU1GVXNvj9.', 'Admin', 'Elizabeth', 'Anderson', 'Senior Manager', 'eianderson@live.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contrasenas`
--
ALTER TABLE `contrasenas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userCodigo` (`userCodigo`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `M_Nombre` (`M_Nombre`);

--
-- Indices de la tabla `operaciones`
--
ALTER TABLE `operaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `O-Equipo` (`O_Equipo`),
  ADD KEY `O-Codigo` (`O_Codigo`);

--
-- Indices de la tabla `transformadores`
--
ALTER TABLE `transformadores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `T-Codigo` (`T_Codigo`),
  ADD KEY `T-Municipio` (`T_Municipio`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userCodigo` (`userCodigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contrasenas`
--
ALTER TABLE `contrasenas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=312;

--
-- AUTO_INCREMENT de la tabla `operaciones`
--
ALTER TABLE `operaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `transformadores`
--
ALTER TABLE `transformadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=487;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contrasenas`
--
ALTER TABLE `contrasenas`
  ADD CONSTRAINT `contrasenas_ibfk_1` FOREIGN KEY (`userCodigo`) REFERENCES `usuarios` (`userCodigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `operaciones`
--
ALTER TABLE `operaciones`
  ADD CONSTRAINT `operaciones_ibfk_1` FOREIGN KEY (`O_Equipo`) REFERENCES `transformadores` (`T_Codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `transformadores`
--
ALTER TABLE `transformadores`
  ADD CONSTRAINT `transformadores_ibfk_1` FOREIGN KEY (`T_Municipio`) REFERENCES `municipios` (`M_Nombre`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
