-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 31-05-2024 a las 22:09:05
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
