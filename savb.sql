-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-10-2021 a las 06:58:18
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
-- Estructura de tabla para la tabla `comentarios_novedad`
--

CREATE TABLE `comentarios_novedad` (
  `id_com` int(10) UNSIGNED NOT NULL,
  `Usuario_id_usu` int(12) UNSIGNED NOT NULL,
  `Novedad_id_nov` int(12) UNSIGNED NOT NULL,
  `contenido_com` varchar(700) DEFAULT NULL,
  `fecha_com` datetime DEFAULT NULL
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
(1, 2100914, 'Lectiva', 'Mixta', 'ADSI', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha_has_instructor`
--

CREATE TABLE `ficha_has_instructor` (
  `Ficha_id_fic` int(12) UNSIGNED NOT NULL,
  `Instructor_id_ins` int(12) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `status` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `funcionario`
--

INSERT INTO `funcionario` (`id_fun`, `Usuario_id_usu`, `documento_fun`, `tipoDoc_fun`, `nombre_fun`, `apellido_fun`, `correoSena_fun`, `celular_fun`, `cargo_fun`, `tipoSangre_fun`, `eps_fun`, `genero_fun`, `status`) VALUES
(1, 1, 123456789, 'CC', 'Alvaro Jose', 'Cabezas', 'alvaro.cabezas@misena.edu.co', 55555, 'Ingeniero', 'A ', 'Compensar', 'M', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructor`
--

CREATE TABLE `instructor` (
  `id_ins` int(12) UNSIGNED NOT NULL,
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
  `status` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `img_not` blob DEFAULT NULL,
  `status` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`id_not`, `Funcionario_id_fun`, `titulo_not`, `contenido_not`, `fecha_not`, `hora_not`, `img_not`, `status`) VALUES
(117, 1, 'Taxistas profesionales preparados para ofrecer servicio de calidad en medio de la pandemia', 'La alianza entre el SENA, la empresa Taxis Libres y la Secretaría de Salud permitieron certificar a más de 300 conductores de la mancha ‘amarilla’ en Cali.', '2021-04-13', '11:57:31', 0x696d6167656e65732f43434c5f74617869737461735f31333034323032312e6a7067, 1),
(118, 1, 'Más de 8 mil mujeres atlanticenses se beneficiarán con formación, empleo y emprendimiento', 'Más de 8 mil mujeres atlanticenses se beneficiarán con formación, empleo y emprendimiento', '2021-04-14', '12:00:47', 0x696d6167656e65732f43616d70616e6e615f31333034323032312e6a706567, 1),
(119, 1, 'SENA y Minciencias disponen de $28 mil millones para las empresas como parte de la reactivación económica del país', 'A través de la convocatoria ‘SENA Innova: por la reactivación del país’ se busca cofinanciar el desarrollo de proyectos que, a través de la sofisticación e innovación, mejoren su oferta competitiva y se adapten a la nueva realidad.', '2021-04-14', '12:02:04', 0x696d6167656e65732f464f544f5f53454e41494e4e4f56415f31333034323032312e6a7067, 1),
(120, 1, 'El talento humano se cualifica desde la Gestión Documental', 'En articulación con el Archivo General de la Nación, y el Centro Agroforestal y Acuícola Arapaima de la Regional Putumayo, la Mesa Sectorial de Gestión Documental, se llevó a cabo el Primer Evento de Divulgación Tecnológica 2021.', '2021-04-14', '12:03:29', 0x696d6167656e65732f6172636869765f646f63756d656e74616c5f31333034323032312e6a706567, 1),
(121, 1, 'Proyecto piloto de reconocimiento de aprendizajes previos en el CAE', 'Proyecto piloto de reconocimiento de aprendizajes previos en el CAE', '2021-04-14', '12:04:32', 0x696d6167656e65732f43434c5f617669636f6c615f31333034323032312e6a7067, 1),
(122, 1, ' Primer Consejo Ejecutivo Mesa Sectorial Agroindustria de la Panela', 'Primer Consejo Ejecutivo Mesa Sectorial Agroindustria de la Panela', '2021-04-14', '12:05:08', 0x696d6167656e65732f, 1),
(123, 1, 'Primer Consejo Ejecutivo Mesa Sectorial Agroindustria de la Panela', 'Primer Consejo Ejecutivo Mesa Sectorial Agroindustria de la Panela', '2021-04-14', '12:05:28', 0x696d6167656e65732f4d6573615f31333034323032312e6a706567, 1),
(124, 1, 'Mujeres emprendedoras de la Vereda CAY visibilizan en Feria Gastronómica lo aprendido en formación impartida por el SENA', 'Mujeres emprendedoras de la Vereda CAY visibilizan en Feria Gastronómica lo aprendido en formación impartida por el SENA', '2021-04-14', '12:06:22', 0x696d6167656e65732f7665726564615f31323034323032312e6a7067, 1),
(125, 1, 'El SENA y el IPES trabajan por la formación de poblaciones vulnerables en la capital', 'El SENA y el IPES capacitarán virtualmente alrededor de 1.000 vendedores informales de las plazas de mercado, comerciantes y emprendedores en diferentes cursos a lo largo del año.', '2021-04-14', '12:07:03', 0x696d6167656e65732f494d475f323238335f31323034323032312e6a7067, 1),
(126, 1, 'Veredas de Anserma ahora cuentan con paraderos construidos en guadua por aprendices del SENA Caldas', 'La construcción la realizaron aprendices del Centro para la Formación Cafetera del SENA Caldas con apoyo de la alcaldía local.', '2021-04-14', '12:07:56', 0x696d6167656e65732f464f544f5f766572656461735f31323034323032312e6a7067, 1),
(127, 1, 'El SENA se compromete con el plan para la reactivación de la economía y la formalización laboral', 'Con estrategias conjuntas para el fortalecimiento de las islas, se busca su reactivación y el ofrecimiento de mayores oportunidades para sus habitantes.', '2021-04-14', '12:09:24', 0x696d6167656e65732f494d472d73616e5f616e647265735f31323034323032312e6a7067, 1),
(128, 1, 'Croky Empanadas la empresa que se hizo realidad en el Tolima gracias al Fondo Emprender SENA', 'Por medio de la disciplina y compromiso en la ejecución de actividades y cumplimiento de objetivos a corto y largo plazo, esta idea innovadora abrió las puertas de su negocio y recibió la condonación de su deuda.', '2021-04-14', '12:10:07', 0x696d6167656e65732f454d50414e414441535f30393034323032312e6a7067, 1),
(129, 1, 'El SENA avanza en acciones y oportunidades para San Andrés, Providencia y Santa Catalina', 'El SENA continúa firme en su propósito de llevar más oportunidades a los habitantes de San Andrés, Providencia y Santa Catalina para la reactivación, luego del paso del huracán Iota.', '2021-04-14', '12:11:33', 0x696d6167656e65732f494d472d32303231303430382d5741303035345f30393034323032312e6a7067, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedad`
--

CREATE TABLE `novedad` (
  `id_nov` int(12) UNSIGNED NOT NULL,
  `Vocero_id_voc` int(12) UNSIGNED NOT NULL,
  `titulo_nov` varchar(250) DEFAULT NULL,
  `contenido_nov` varchar(600) DEFAULT NULL,
  `fecha_nov` datetime DEFAULT NULL,
  `estado_nov` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 1, 123456789, '123456789'),
(2, 3, 123456, '123456');

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
  `genero_voc` varchar(1) DEFAULT NULL,
  `status` tinyint(1) UNSIGNED DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vocero`
--

INSERT INTO `vocero` (`id_voc`, `Ficha_id_fic`, `Usuario_id_usu`, `documento_voc`, `tipoDoc_voc`, `nombre_voc`, `apellido_voc`, `correoPer_voc`, `correoSena_voc`, `telefono_voc`, `celular1_voc`, `celular2_voc`, `tipoSangre_voc`, `eps_voc`, `genero_voc`, `status`) VALUES
(1, 1, 2, 123456, 'CC', 'Stiven', 'Herrera', 'Stiven@info.com', 'Stiven@gmail.com', 0, 111111, 22222222, 'AB+', 'Sanitas', 'M', 1);

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
-- Indices de la tabla `comentarios_novedad`
--
ALTER TABLE `comentarios_novedad`
  ADD PRIMARY KEY (`id_com`),
  ADD KEY `comentarios_novedad_FKIndex1` (`Novedad_id_nov`),
  ADD KEY `comentarios_novedad_FKIndex2` (`Usuario_id_usu`);

--
-- Indices de la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD PRIMARY KEY (`id_fic`);

--
-- Indices de la tabla `ficha_has_instructor`
--
ALTER TABLE `ficha_has_instructor`
  ADD PRIMARY KEY (`Ficha_id_fic`,`Instructor_id_ins`),
  ADD KEY `Ficha_has_Instructor_FKIndex1` (`Ficha_id_fic`),
  ADD KEY `Ficha_has_Instructor_FKIndex2` (`Instructor_id_ins`);

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
  ADD KEY `Instructor_FKIndex1` (`Usuario_id_usu`);

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
  ADD KEY `Novedad_FKIndex1` (`Vocero_id_voc`);

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
-- AUTO_INCREMENT de la tabla `comentarios_novedad`
--
ALTER TABLE `comentarios_novedad`
  MODIFY `id_com` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ficha`
--
ALTER TABLE `ficha`
  MODIFY `id_fic` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id_fun` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `instructor`
--
ALTER TABLE `instructor`
  MODIFY `id_ins` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id_men` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id_not` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT de la tabla `novedad`
--
ALTER TABLE `novedad`
  MODIFY `id_nov` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usu` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT de la tabla `vocero`
--
ALTER TABLE `vocero`
  MODIFY `id_voc` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
