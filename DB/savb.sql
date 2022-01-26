-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-04-2021 a las 04:27:35
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `savb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

CREATE TABLE `chat` (
  `id_chat` int(12) UNSIGNED NOT NULL,
  `Usuario_id_usu` int(12) UNSIGNED NOT NULL,
  `fecha_chat` date DEFAULT NULL,
  `hora_chat` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario_novedad`
--

CREATE TABLE `comentario_novedad` (
  `id_com` int(12) NOT NULL,
  `contenido_com` varchar(250) NOT NULL,
  `fecha_com` date NOT NULL,
  `hora_com` time NOT NULL,
  `Usuario_id_usu` int(12) UNSIGNED NOT NULL,
  `novedad_id_nov` int(12) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha`
--

CREATE TABLE `ficha` (
  `id_fic` int(12) UNSIGNED NOT NULL,
  `numero_fic` int(12) UNSIGNED DEFAULT NULL,
  `etapaFormacion_fic` varchar(30) DEFAULT NULL,
  `jornada_fic` varchar(30) DEFAULT NULL,
  `nombrePrograma_fic` varchar(30) DEFAULT NULL,
  `trimestre_fic` int(5) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ficha`
--

INSERT INTO `ficha` (`id_fic`, `numero_fic`, `etapaFormacion_fic`, `jornada_fic`, `nombrePrograma_fic`, `trimestre_fic`) VALUES
(1, 2100914, 'Lectiva', 'MaÃ±ana', 'ADSI', 3),
(2, 2100915, 'Lectiva', 'MaÃ±ana', 'ADSI', 4),
(3, 201110, 'Lectiva', 'Nocturna', 'Tecnico Programacion Software', 3),
(4, 210077, 'Productiva', 'MaÃ±ana', 'Tecnico en Sistemas', 5),
(5, 100772, 'Lectiva', 'Noches', 'ADSI', 3),
(6, 20002, 'Lectiva', 'Nocturna', 'Industrial', 2),
(7, 906888, 'Lectiva', 'Nocturna', 'Arte', 2),
(8, 392921, 'Productiva', 'MaÃ±ana', 'Tecnico Programacion Software', 5),
(9, 210099, 'Lectiva', 'Noches', 'Artes marciales', 2),
(10, 201011212, 'Productiva', 'MaÃ±ana', 'Mecatronica', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionario`
--

CREATE TABLE `funcionario` (
  `id_fun` int(12) UNSIGNED NOT NULL,
  `Usuario_id_usu` int(12) UNSIGNED NOT NULL,
  `documento_fun` int(12) UNSIGNED DEFAULT NULL,
  `tipoDoc_fun` varchar(20) DEFAULT NULL,
  `nombre_fun` varchar(30) DEFAULT NULL,
  `apellido_fun` varchar(30) DEFAULT NULL,
  `correoSena_fun` varchar(35) DEFAULT NULL,
  `celular_fun` int(15) UNSIGNED DEFAULT NULL,
  `cargo_fun` varchar(30) DEFAULT NULL,
  `tipoSangre_fun` varchar(5) DEFAULT NULL,
  `eps_fun` varchar(20) DEFAULT NULL,
  `genero_fun` varchar(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `funcionario`
--

INSERT INTO `funcionario` (`id_fun`, `Usuario_id_usu`, `documento_fun`, `tipoDoc_fun`, `nombre_fun`, `apellido_fun`, `correoSena_fun`, `celular_fun`, `cargo_fun`, `tipoSangre_fun`, `eps_fun`, `genero_fun`, `status`) VALUES
(1, 2, 123456789, 'CC', 'Alvaro Jose', 'Cabezas Jimenez', 'hola', 3183832469, 'Admin', 'A ', 'Sanitas', 'M', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructor`
--

CREATE TABLE `instructor` (
  `id_ins` int(12) UNSIGNED NOT NULL,
  `Ficha_id_fic` int(12) UNSIGNED NOT NULL,
  `Usuario_id_usu` int(12) UNSIGNED NOT NULL,
  `documento_ins` int(12) UNSIGNED DEFAULT NULL,
  `tipoDoc_ins` varchar(20) DEFAULT NULL,
  `nombre_ins` varchar(30) DEFAULT NULL,
  `apellido_ins` varchar(30) DEFAULT NULL,
  `correoSena_ins` varchar(35) DEFAULT NULL,
  `celular_ins` int(15) UNSIGNED DEFAULT NULL,
  `titulo_ins` varchar(30) DEFAULT NULL,
  `tipoSangre_ins` varchar(5) DEFAULT NULL,
  `eps_ins` varchar(20) DEFAULT NULL,
  `genero_ins` varchar(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `instructor`
--

INSERT INTO `instructor` (`id_ins`, `Ficha_id_fic`, `Usuario_id_usu`, `documento_ins`, `tipoDoc_ins`, `nombre_ins`, `apellido_ins`, `correoSena_ins`, `celular_ins`, `titulo_ins`, `tipoSangre_ins`, `eps_ins`, `genero_ins`, `status`) VALUES
(1, 2100914, 1, 1001188577, 'CC', 'Stiven', 'Admin', 'stgj@sena.edu.co', 3182838394, 'Ingeniero S', 'B-', 'Sanitas', 'M', 0),
(2, 1, 14, 929292, 'CC', 'Carlos', 'Herrera', 'cahe@misena.edu.co', 1233213, 'Ingeniero S', 'A-', 'Sanitas', 'M', 0),
(3, 1, 15, 939393, 'CC', 'Enrique', 'Gomez', 'engo@nisena.edu.co', 12231123, 'Ingeniero S', 'A+', 'Sanitas', 'M', 0),
(4, 1, 16, 949494, 'CC', 'Juanita', 'Lopez', 'julo@misena.edu.co', 1233213, 'Ingeniero S', 'A-', 'Sanitas', 'M', 0),
(5, 1, 17, 959595, 'CC', 'Jhon', 'Lenon', 'jole@nisena.edu.co', 12231123, 'Ingeniero S', 'A+', 'Sanitas', 'M', 0),
(6, 1, 18, 969696, 'CC', 'Carla', 'Ramirez', 'cara@misena.edu.co', 12332221, 'Ingeniero S', 'A+', 'Sanitas', 'F', 0),
(8, 1, 108, 1000689227, 'c.c', 'Alvaro Jose', 'Cabezas Jimenez', 'aj.cabezas', 456, 'Aprendiz', 'o+', 'Salud total', 'M', 0),
(9, 0, 109, 0, 'c.c', 'p', 'h', 'j', 0, 'h', 'j', 'j', 'n', 1),
(10, 0, 110, 123, 'c.c', 'alvaro', 'cabezas', 'ajcabezas', 123, 'Aprendiz', 'o+', 'Salud total', 'M', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `id_men` int(12) UNSIGNED NOT NULL,
  `Chat_id_chat` int(12) UNSIGNED NOT NULL,
  `Usuario_id_usu` int(12) UNSIGNED NOT NULL,
  `mensaje` varchar(500) DEFAULT NULL,
  `hora_men` time DEFAULT NULL,
  `fecha_men` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE `noticia` (
  `id_not` int(12) UNSIGNED NOT NULL,
  `Funcionario_id_fun` int(12) UNSIGNED NOT NULL,
  `titulo_not` varchar(250) DEFAULT NULL,
  `contenido_not` varchar(600) DEFAULT NULL,
  `fecha_not` date DEFAULT NULL,
  `hora_not` time DEFAULT NULL,
  `img_not` tinyblob DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`id_not`, `Funcionario_id_fun`, `titulo_not`, `contenido_not`, `fecha_not`, `hora_not`, `img_not`, `status`) VALUES
(28, 1, 'Mesa Sectorial de Gestión de Tecnología y Talento Digital, en la dirección correcta', 'A través de la Mesa Sectorial se crea una conexión entre trabajadores y empleadores, que contribuye a impulsar el fortalecimiento del Sector para afrontar con efectividad los desafíos de la coyuntura actual.', '2021-03-23', '04:10:37', 0x6269656e65737461722e6a7067, 1),
(29, 1, 'Estudia de manera presencial en el SENA, hay 168 programas de formación disponibles', 'Los interesados pueden inscribirse hasta el 4 de abril en www.senasofiaplus.edu.co, la convocatoria incluye formaciones en diferentes niveles de formación.', '2021-03-23', '04:23:12', 0x312e6a7067, 1),
(30, 1, '“La Tartaleta”, un café servido con pasión por 3 mujeres en el balcón florido de Risaralda', 'Las tres se encargan de llevar a la mesa 80 productos diferentes de café entre espresso, americano, capuchino, frapuchino, moka, latte, granizados, postres, malteadas, coctelería y atienden de martes a domingo de 10:00 a.m. a 9: 30 p.m.', '2021-03-23', '04:29:57', 0x322e6a706567, 1),
(31, 1, 'Casi 400 personas han sido capacitadas sobre el manejo de la vacunación contra el COVID-19 en Quindío', 'Casi 400 personas han sido capacitadas sobre el manejo de la vacunación contra el COVID-19 en Quindío', '2021-03-23', '06:39:57', 0x433a66616b65706174686c6f676f622e4a5047, 0),
(39, 1, 'En Neiva, el SENA instaló sistema fotovoltaico en su sede Industria.', 'La instalación fotovoltaica, proyecto en el que participaron aprendices SENA, abastecerá cerca del 20 por ciento de la demanda energética del centro de formación', '2021-04-04', '05:34:11', 0x322e6a706567, 0),
(40, 1, 'esto es prueba', 'asa', '2021-04-04', '06:40:25', '', 0),
(41, 1, 'j', 'jk', '2021-04-04', '06:41:09', '', 0),
(42, 1, 'jkb', 'ig', '2021-04-04', '06:42:04', '', 0),
(43, 1, 'j', 'j', '2021-04-04', '06:43:08', '', 0),
(44, 1, 'esto es prueba', 'a', '2021-04-04', '06:43:44', '', 0),
(45, 1, 'Alvaro', 'cabezas jimenez', '2021-04-04', '06:44:51', '', 0),
(46, 1, 'Modifico esta noticia', 'Estamos presentando', '2021-04-06', '07:49:31', 0x433a66616b65706174686c6f676f622e4a5047, 0),
(47, 1, 'Hola a todos', 'hgjg', '2021-04-06', '09:05:02', 0x352e6a7067, 0),
(48, 1, 'esto es prueba', 'jkgkg', '2021-04-06', '09:05:24', 0x433a66616b6570617468332e6a706567, 0),
(49, 1, 'hygjh', 'jgj', '2021-04-06', '09:11:02', 0x433a66616b6570617468352e6a7067, 0),
(50, 1, 'Casi 400 personas han sido capacitadas sobre el manejo de la vacunación contra el COVID-19 en Quindío', ' Casi 400 personas han sido capacitadas sobre el manejo de la vacunación contra el COVID-19 en Quindío', '2021-04-06', '09:26:26', 0x312e6a7067, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedad`
--

CREATE TABLE `novedad` (
  `id_nov` int(12) UNSIGNED NOT NULL,
  `Usuario_id_usu` int(12) UNSIGNED NOT NULL,
  `Vocero_id_voc` int(12) UNSIGNED NOT NULL,
  `titulo_nov` varchar(250) DEFAULT NULL,
  `contenido_nov` varchar(600) DEFAULT NULL,
  `comentario_nov` varchar(400) DEFAULT NULL,
  `fecha_nov` date DEFAULT NULL,
  `hora_nov` time DEFAULT NULL,
  `estado_nov` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `novedad`
--

INSERT INTO `novedad` (`id_nov`, `Usuario_id_usu`, `Vocero_id_voc`, `titulo_nov`, `contenido_nov`, `comentario_nov`, `fecha_nov`, `hora_nov`, `estado_nov`) VALUES
(1, 4, 303030, 'Juan Golpea a Alvaro ', 'el dia de ayer en mi ficha, el compaÃ±ero Juan Herrera golpeo rotundamente a Alvaro Cabezas, tras tremenda paliza Juan Herrera Sale del aula', NULL, '2021-03-13', '19:10:13', 'Pendiente'),
(2, 2, 987654321, 'Antonio se robo un celular', 'todos sabemos que antonio le robo el celular a jazinto pero el se niega y se teme que se empeore el problema', NULL, '2021-03-15', '22:10:12', 'Pendiente'),
(3, 5, 202020, 'Los compaÃ±eros de la ficha me indican que la profesora Juana Maria no se interesa en enseÃ±ar y solo viene a poner trabajos sin sentido.', 'Los compaÃ±eros de la ficha me indican que la profesora Juana Maria no se interesa en enseÃ±ar y solo viene a poner trabajos sin sentido. esto suced todos los vienres en la ficha numero bla bla bla', NULL, '2021-03-01', '19:38:28', 'Pendiente'),
(4, 6, 666666, 'Miguel no entrega los trabajos y no quiere cambiar', 'el compaÃ±ero Michel Sanchez no quiere entregar los trabajos de su GAES', NULL, '2021-03-16', '12:35:22', 'En Proceso'),
(5, 7, 777777, 'Vanessa daÃ±o un computador de la sala', 'En la sala numero 12 la compaÃ±era Vanessa arrojo el computador al suelo intencionalmente.', NULL, '2021-03-01', '12:34:20', 'Cerrado'),
(6, 8, 888888, 'Stiven fue engaÃ±ado por un compaÃ±ero y le copio en examen POO', 'el compaÃ±ero Stiven Herrera me indica que Luis Alvarado falsifico unos mensajes y le envio las preguntas resueltas de un examen de POO.', NULL, '2021-03-03', '12:42:18', 'En Proceso'),
(7, 9, 999999, 'Sindy no viene a clases y no se comunica con nadie.', 'La preocupacion de la ficha frente a que la compaÃ±era Syndi Gonzales no responde crece, y necesitamos ayuda para ubicarla', NULL, '2021-03-14', '38:42:18', 'En Proceso'),
(8, 12, 121212, 'Luis golpeo a Maria', 'El dia de hoy Luis Aguilar golpea a la compaÃ±era Maria Inez intencionalmente, solicitamos ayuda y su apoyo.', NULL, '2021-03-09', '13:20:42', 'Cerrado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(12) UNSIGNED NOT NULL,
  `nombre_rol` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre_rol`) VALUES
(1, 'Funcionario'),
(2, 'Instructor'),
(3, 'Aprendiz');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usu` int(12) UNSIGNED NOT NULL,
  `Rol_id_rol` int(12) UNSIGNED NOT NULL,
  `Usuario` int(12) UNSIGNED DEFAULT NULL,
  `contrasena_usu` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usu`, `Rol_id_rol`, `Usuario`, `contrasena_usu`) VALUES
(1, 2, 1001188577, '1'),
(2, 1, 123456789, '1'),
(3, 3, 987654321, '1'),
(4, 3, 303030, '1'),
(5, 3, 202020, '1'),
(6, 3, 666666, '1'),
(7, 3, 777777, '1'),
(8, 3, 888888, '1'),
(9, 3, 999999, '1'),
(10, 3, 121212, '1'),
(11, 3, 232323, '1'),
(12, 3, 323232, '1'),
(13, 2, 919191, '1'),
(14, 2, 929292, '1'),
(15, 2, 939393, '1'),
(16, 2, 949494, '1'),
(17, 2, 959595, '1'),
(18, 2, 969696, '1'),
(19, 2, 979797, '1'),
(20, 2, 989898, '1'),
(21, 2, 999999, '1'),
(22, 2, 91929191, '1'),
(23, 0, 0, ''),
(24, 0, 0, ''),
(25, 0, 0, ''),
(26, 0, 0, ''),
(27, 0, 0, ''),
(28, 0, 0, ''),
(29, 0, 0, ''),
(30, 0, 0, ''),
(31, 0, 0, ''),
(32, 0, 0, ''),
(33, 0, 0, ''),
(34, 0, 0, ''),
(35, 0, 0, ''),
(36, 0, 0, ''),
(37, 0, 0, ''),
(38, 0, 0, ''),
(39, 0, 0, ''),
(40, 0, 0, ''),
(41, 0, 111, ''),
(42, 0, 111, ''),
(43, 0, 0, ''),
(44, 0, 0, ''),
(45, 0, 0, ''),
(46, 0, 0, ''),
(47, 0, 0, ''),
(48, 0, 0, ''),
(49, 0, 0, ''),
(50, 0, 0, ''),
(51, 0, 0, ''),
(52, 0, 0, ''),
(53, 2, 0, ''),
(54, 0, 0, ''),
(55, 0, 0, ''),
(56, 0, 0, ''),
(57, 0, 0, ''),
(58, 0, 0, ''),
(59, 0, 0, ''),
(60, 0, 0, ''),
(61, 0, 0, ''),
(62, 0, 0, ''),
(63, 0, 0, ''),
(64, 0, 0, ''),
(65, 0, 0, ''),
(66, 0, 0, ''),
(67, 0, 0, ''),
(68, 0, 0, ''),
(69, 0, 0, ''),
(70, 0, 0, ''),
(71, 0, 0, ''),
(72, 0, 0, ''),
(73, 0, 0, ''),
(74, 0, 0, ''),
(75, 0, 0, ''),
(76, 0, 0, ''),
(77, 0, 0, ''),
(78, 0, 0, ''),
(79, 0, 0, ''),
(80, 0, 0, ''),
(81, 0, 0, ''),
(82, 0, 0, ''),
(83, 0, 0, ''),
(84, 0, 0, ''),
(85, 0, 0, ''),
(86, 0, 0, ''),
(87, 0, 0, ''),
(88, 0, 0, ''),
(89, 0, 0, ''),
(90, 0, 0, ''),
(91, 0, 0, ''),
(92, 0, 0, ''),
(93, 0, 0, ''),
(94, 0, 0, ''),
(95, 0, 0, ''),
(96, 0, 0, ''),
(97, 0, 0, ''),
(98, 0, 0, ''),
(99, 0, 0, ''),
(100, 0, 0, ''),
(101, 0, 0, ''),
(102, 0, 0, ''),
(103, 0, 0, ''),
(104, 0, 0, ''),
(105, 0, 0, ''),
(106, 0, 0, ''),
(107, 2, 1000689227, '123'),
(108, 2, 1000689227, '123'),
(109, 2, 0, 'h'),
(110, 2, 123, '456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vocero`
--

CREATE TABLE `vocero` (
  `id_voc` int(12) UNSIGNED NOT NULL,
  `Ficha_id_fic` int(12) UNSIGNED NOT NULL,
  `Usuario_id_usu` int(12) UNSIGNED NOT NULL,
  `documento_voc` int(12) UNSIGNED DEFAULT NULL,
  `tipoDoc_voc` varchar(20) DEFAULT NULL,
  `nombre_voc` varchar(30) DEFAULT NULL,
  `apellido_voc` varchar(30) DEFAULT NULL,
  `correoPer_voc` varchar(35) DEFAULT NULL,
  `correoSena_voc` varchar(35) DEFAULT NULL,
  `telefono_voc` int(7) UNSIGNED DEFAULT NULL,
  `celular1_voc` int(15) UNSIGNED DEFAULT NULL,
  `celular2_voc` int(15) UNSIGNED DEFAULT NULL,
  `tipoSangre_voc` varchar(5) DEFAULT NULL,
  `eps_voc` varchar(20) DEFAULT NULL,
  `genero_voc` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vocero`
--

INSERT INTO `vocero` (`id_voc`, `Ficha_id_fic`, `Usuario_id_usu`, `documento_voc`, `tipoDoc_voc`, `nombre_voc`, `apellido_voc`, `correoPer_voc`, `correoSena_voc`, `telefono_voc`, `celular1_voc`, `celular2_voc`, `tipoSangre_voc`, `eps_voc`, `genero_voc`) VALUES
(1, 2100914, 3, 987654321, 'TI', 'Vocero', 'Test', 'vocero@hotmail.com', 'vocero@misena.edu.co', 8853211, 12312, 32321, 'A+', 'Sanitas', 'F'),
(2, 2100915, 4, 303030, 'CC', 'Stiven', 'Herrera', 'stiven@hotmail.com', 'stiven.herrera@misena.edu.com', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 201110, 5, 202020, 'CC', 'Vanessa', 'Cardenas', 'vane@gmail.com', 'vane@misena.edu.co', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 210077, 6, 666666, 'C.C', 'Alejandro', 'Huertas', 'alejo@gmail.com', 'alej@misena.edu.co', 8853211, 76576576, 889898, 'A+', 'CRUZ BLANCA', 'M'),
(5, 100772, 7, 777777, 'C.C', 'Luisa', 'Melgarejo', 'lume@gmail.com', 'lume@misena.edu.co', 121212, 34432, 2189332, 'A-', 'CRUZ BLANCA', 'F'),
(6, 906888, 8, 888888, 'CC', 'Antonio', 'Sanchez', 'ansa@gmail.com', 'ansa@misena.edu.co', 121229, 899873, 78788732, 'B+', 'Sanitas', 'M'),
(7, 210099, 9, 999999, 'TI', 'Carlos', 'Jimenez', 'caji@gmail.com', 'caji@misena.edu.co', 9382892, 3489438, 8954854, 'A+', 'Sanitas', 'M'),
(8, 201011212, 10, 121212, 'CC', 'Estefania', 'Vazques', 'esva@gmail.com', 'esva@misena.edu.co', 982189, 8383828, 8321212, 'B*', 'SANTI', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_chat`),
  ADD KEY `Chat_FKIndex1` (`Usuario_id_usu`);

--
-- Indices de la tabla `comentario_novedad`
--
ALTER TABLE `comentario_novedad`
  ADD PRIMARY KEY (`id_com`),
  ADD KEY `comentario_novedad_FKIndex1` (`Usuario_id_usu`),
  ADD KEY `comentario_novedad_FKIndex2` (`novedad_id_nov`);

--
-- Indices de la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD PRIMARY KEY (`id_fic`);

--
-- Indices de la tabla `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id_fun`),
  ADD KEY `Funcionario_FKIndex1` (`Usuario_id_usu`);

--
-- Indices de la tabla `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`id_ins`),
  ADD KEY `Instructor_FKIndex1` (`Usuario_id_usu`),
  ADD KEY `Instructor_FKIndex2` (`Ficha_id_fic`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id_men`),
  ADD KEY `Mensaje_FKIndex1` (`Usuario_id_usu`),
  ADD KEY `Mensaje_FKIndex2` (`Chat_id_chat`);

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id_not`),
  ADD KEY `Noticia_FKIndex1` (`Funcionario_id_fun`);

--
-- Indices de la tabla `novedad`
--
ALTER TABLE `novedad`
  ADD PRIMARY KEY (`id_nov`),
  ADD KEY `Novedad_FKIndex1` (`Vocero_id_voc`),
  ADD KEY `Novedad_FKIndex2` (`Usuario_id_usu`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usu`),
  ADD KEY `usuario_FKIndex1` (`Rol_id_rol`);

--
-- Indices de la tabla `vocero`
--
ALTER TABLE `vocero`
  ADD PRIMARY KEY (`id_voc`),
  ADD KEY `Vocero_FKIndex1` (`Usuario_id_usu`),
  ADD KEY `Vocero_FKIndex2` (`Ficha_id_fic`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `chat`
--
ALTER TABLE `chat`
  MODIFY `id_chat` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comentario_novedad`
--
ALTER TABLE `comentario_novedad`
  MODIFY `id_com` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ficha`
--
ALTER TABLE `ficha`
  MODIFY `id_fic` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id_fun` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `instructor`
--
ALTER TABLE `instructor`
  MODIFY `id_ins` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id_men` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id_not` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `novedad`
--
ALTER TABLE `novedad`
  MODIFY `id_nov` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usu` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT de la tabla `vocero`
--
ALTER TABLE `vocero`
  MODIFY `id_voc` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
