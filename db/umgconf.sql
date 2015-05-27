-- phpMyAdmin SQL Dump
-- version 4.3.3
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 26-05-2015 a las 20:01:38
-- Versión del servidor: 10.0.17-MariaDB
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `umgconf`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Alumno`
--

CREATE TABLE IF NOT EXISTS `Alumno` (
  `id` bigint(20) NOT NULL,
  `Carne` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Nombre` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Alumno`
--

INSERT INTO `Alumno` (`id`, `Carne`, `Nombre`, `Usuario_id`) VALUES
(3, '1', 'sdfa', NULL),
(4, '2', 'Iván', 5),
(5, '3', 'qwert', NULL),
(6, '4', 'poiu', NULL),
(7, '5', 'lkjh', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AlumnoEvento`
--

CREATE TABLE IF NOT EXISTS `AlumnoEvento` (
  `id` bigint(20) NOT NULL,
  `Alumno_id` bigint(20) NOT NULL,
  `Evento_id` bigint(20) NOT NULL,
  `Pagado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `AlumnoEvento`
--

INSERT INTO `AlumnoEvento` (`id`, `Alumno_id`, `Evento_id`, `Pagado`) VALUES
(2, 3, 1, NULL),
(3, 4, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AlumnoPago`
--

CREATE TABLE IF NOT EXISTS `AlumnoPago` (
  `id` bigint(20) NOT NULL,
  `Boleta` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Alumno_id` bigint(20) NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Evento_id` bigint(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `AlumnoPago`
--

INSERT INTO `AlumnoPago` (`id`, `Boleta`, `Alumno_id`, `Fecha`, `Evento_id`) VALUES
(1, '3423412341', 3, NULL, 1),
(7, '543532', 4, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AlumnoRecuerdo`
--

CREATE TABLE IF NOT EXISTS `AlumnoRecuerdo` (
  `id` bigint(20) NOT NULL,
  `FechaHora` datetime DEFAULT NULL,
  `Alumno_id` bigint(20) NOT NULL,
  `Recuerdo_id` int(11) NOT NULL,
  `Usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Conferencia`
--

CREATE TABLE IF NOT EXISTS `Conferencia` (
  `id` bigint(20) NOT NULL,
  `Conferencia` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HoraInicio` datetime DEFAULT NULL,
  `HoraFIn` datetime DEFAULT NULL,
  `Conferencista_id` bigint(20) NOT NULL,
  `Salon_id` int(11) NOT NULL,
  `Evento_id` bigint(20) NOT NULL,
  `Pagado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Conferencia`
--

INSERT INTO `Conferencia` (`id`, `Conferencia`, `HoraInicio`, `HoraFIn`, `Conferencista_id`, `Salon_id`, `Evento_id`, `Pagado`) VALUES
(1, 'Inicio', '2015-09-19 08:00:00', '2015-09-19 08:30:00', 1, 1, 1, NULL),
(2, 'Odoo', '2015-09-19 09:00:00', '2015-09-19 10:00:00', 5, 1, 1, NULL),
(3, 'NSA', '2015-09-19 09:00:00', '2015-09-19 10:00:00', 6, 2, 1, NULL),
(4, 'Redes sisco', '2015-09-19 11:00:00', '2015-09-19 12:00:00', 7, 1, 1, NULL),
(5, 'KTurtle', '2015-09-19 11:00:00', '2015-09-19 12:00:00', 3, 2, 1, NULL),
(6, 'Seguridad inalambrica', '2015-09-19 12:00:00', '2015-09-19 13:00:00', 2, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ConferenciaAlumno`
--

CREATE TABLE IF NOT EXISTS `ConferenciaAlumno` (
  `id` bigint(20) NOT NULL,
  `Alumno_id` bigint(20) NOT NULL,
  `Conferencia_id` bigint(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ConferenciaAlumno`
--

INSERT INTO `ConferenciaAlumno` (`id`, `Alumno_id`, `Conferencia_id`) VALUES
(2, 4, 1),
(3, 5, 1),
(5, 3, 1),
(6, 3, 2),
(8, 3, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Conferencista`
--

CREATE TABLE IF NOT EXISTS `Conferencista` (
  `id` bigint(20) NOT NULL,
  `Nombre` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Correo` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telefono` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Observaciones` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Conferencista`
--

INSERT INTO `Conferencista` (`id`, `Nombre`, `Correo`, `Telefono`, `Observaciones`) VALUES
(1, 'Ivan de León', 'ivandeleon@solucionestip.com', '55550643', 'blablabla'),
(2, 'Axel Ruiz', 'konelix@gmail.com', '55550643', 'gt'),
(3, 'Maria Castillo', 'marilux@gmail.com', '55550643', 'gt'),
(4, 'Pablo Castellanos', 'pablopi@gmail.com', '55550643', NULL),
(5, 'Miguel Chuga', 'cmike@gmail.com', '55550643', NULL),
(6, 'Victor Orozco', 'tuxtor@gmail.com', '55550643', NULL),
(7, 'Jose De León', 'jidc07@gmail.com', '55550643', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Evento`
--

CREATE TABLE IF NOT EXISTS `Evento` (
  `id` bigint(20) NOT NULL,
  `Nombre` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FechaInicio` date DEFAULT NULL,
  `FechaFin` date DEFAULT NULL,
  `Lugar` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Habilitado` tinyint(1) DEFAULT NULL,
  `Direccion` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Evento`
--

INSERT INTO `Evento` (`id`, `Nombre`, `FechaInicio`, `FechaFin`, `Lugar`, `Habilitado`, `Direccion`) VALUES
(1, 'Conferencias UMG XELA 2015', '2015-09-19', '2015-09-19', 'Gran karmel', 1, 'Salida Guatemala, zona 7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fos_user_user_group`
--

CREATE TABLE IF NOT EXISTS `fos_user_user_group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Grupo`
--

CREATE TABLE IF NOT EXISTS `Grupo` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Grupo`
--

INSERT INTO `Grupo` (`id`, `name`, `roles`) VALUES
(1, 'Estudiante', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pago`
--

CREATE TABLE IF NOT EXISTS `Pago` (
  `id` bigint(20) NOT NULL,
  `Documento` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Monto` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Conferencista_id` bigint(20) NOT NULL,
  `Usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Recuerdo`
--

CREATE TABLE IF NOT EXISTS `Recuerdo` (
  `id` int(11) NOT NULL,
  `Recuerdo` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Observaciones` longtext COLLATE utf8_unicode_ci,
  `Cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Salon`
--

CREATE TABLE IF NOT EXISTS `Salon` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Cupo` int(11) DEFAULT NULL,
  `Evento_id` bigint(20) NOT NULL,
  `Lleno` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Salon`
--

INSERT INTO `Salon` (`id`, `Nombre`, `Cupo`, `Evento_id`, `Lleno`) VALUES
(1, 'Principal', 200, 1, NULL),
(2, 'Secundario', 80, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE IF NOT EXISTS `Usuario` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `Nombre` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Puesto` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FechaNacimiento` date DEFAULT NULL,
  `Sexo` int(11) DEFAULT NULL,
  `EstadoCivil` int(11) DEFAULT NULL,
  `TelCasa` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TelCelular` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Direccion` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Foto` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `Nombre`, `Puesto`, `FechaNacimiento`, `Sexo`, `EstadoCivil`, `TelCasa`, `TelCelular`, `Direccion`, `Foto`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 1, 'mqnsqlwoktckok80koc0k0wkw4oo84s', 'A3Wig/Dp2zD4zByF7OZC0BjMAcp+4XmwZGC8fkMbqhTfx52q+6aaEJbjb1ZZrB+RamkPGcSUCJ/iWvynlj7Hqg==', '2015-05-26 13:48:56', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '2', '2', '2@umg.com', '2@umg.com', 1, 'nbfo13tpa2o4oscgcg48c4wggs08ckg', 'Tg4vjMmaoUAhHouLXA5Xsz+hkONG18Tg96pw4VICyVV4iOs74twMDGvLgmmMF4l4r4/ZQb38mAG3AMDKX/Uziw==', '2015-05-11 07:51:06', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Alumno`
--
ALTER TABLE `Alumno`
  ADD PRIMARY KEY (`id`), ADD KEY `IDX_1399D01B9465404E` (`Usuario_id`);

--
-- Indices de la tabla `AlumnoEvento`
--
ALTER TABLE `AlumnoEvento`
  ADD PRIMARY KEY (`id`), ADD KEY `IDX_7EE630357ED9674D` (`Alumno_id`), ADD KEY `IDX_7EE630355547AE1` (`Evento_id`);

--
-- Indices de la tabla `AlumnoPago`
--
ALTER TABLE `AlumnoPago`
  ADD PRIMARY KEY (`id`), ADD KEY `IDX_7A4165237ED9674D` (`Alumno_id`), ADD KEY `IDX_7A4165235547AE1` (`Evento_id`);

--
-- Indices de la tabla `AlumnoRecuerdo`
--
ALTER TABLE `AlumnoRecuerdo`
  ADD PRIMARY KEY (`id`), ADD KEY `IDX_4D7B75F7ED9674D` (`Alumno_id`), ADD KEY `IDX_4D7B75FF456DDDA` (`Recuerdo_id`), ADD KEY `IDX_4D7B75F9465404E` (`Usuario_id`);

--
-- Indices de la tabla `Conferencia`
--
ALTER TABLE `Conferencia`
  ADD PRIMARY KEY (`id`), ADD KEY `IDX_57B021297A0F2E6B` (`Conferencista_id`), ADD KEY `IDX_57B02129B5E7DFB2` (`Salon_id`), ADD KEY `IDX_57B021295547AE1` (`Evento_id`);

--
-- Indices de la tabla `ConferenciaAlumno`
--
ALTER TABLE `ConferenciaAlumno`
  ADD PRIMARY KEY (`id`), ADD KEY `IDX_BB1AF4FE7ED9674D` (`Alumno_id`), ADD KEY `IDX_BB1AF4FE16231E67` (`Conferencia_id`);

--
-- Indices de la tabla `Conferencista`
--
ALTER TABLE `Conferencista`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Evento`
--
ALTER TABLE `Evento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fos_user_user_group`
--
ALTER TABLE `fos_user_user_group`
  ADD PRIMARY KEY (`user_id`,`group_id`), ADD KEY `IDX_B3C77447A76ED395` (`user_id`), ADD KEY `IDX_B3C77447FE54D947` (`group_id`);

--
-- Indices de la tabla `Grupo`
--
ALTER TABLE `Grupo`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UNIQ_4DCFB4D75E237E06` (`name`);

--
-- Indices de la tabla `Pago`
--
ALTER TABLE `Pago`
  ADD PRIMARY KEY (`id`), ADD KEY `IDX_54EDF0007A0F2E6B` (`Conferencista_id`), ADD KEY `IDX_54EDF0009465404E` (`Usuario_id`);

--
-- Indices de la tabla `Recuerdo`
--
ALTER TABLE `Recuerdo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Salon`
--
ALTER TABLE `Salon`
  ADD PRIMARY KEY (`id`), ADD KEY `IDX_33A9DB135547AE1` (`Evento_id`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UNIQ_EDD889C192FC23A8` (`username_canonical`), ADD UNIQUE KEY `UNIQ_EDD889C1A0D96FBF` (`email_canonical`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Alumno`
--
ALTER TABLE `Alumno`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `AlumnoEvento`
--
ALTER TABLE `AlumnoEvento`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `AlumnoPago`
--
ALTER TABLE `AlumnoPago`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `AlumnoRecuerdo`
--
ALTER TABLE `AlumnoRecuerdo`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Conferencia`
--
ALTER TABLE `Conferencia`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `ConferenciaAlumno`
--
ALTER TABLE `ConferenciaAlumno`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `Conferencista`
--
ALTER TABLE `Conferencista`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `Evento`
--
ALTER TABLE `Evento`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `Grupo`
--
ALTER TABLE `Grupo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `Pago`
--
ALTER TABLE `Pago`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Recuerdo`
--
ALTER TABLE `Recuerdo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Salon`
--
ALTER TABLE `Salon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Alumno`
--
ALTER TABLE `Alumno`
ADD CONSTRAINT `FK_1399D01B9465404E` FOREIGN KEY (`Usuario_id`) REFERENCES `Usuario` (`id`);

--
-- Filtros para la tabla `AlumnoEvento`
--
ALTER TABLE `AlumnoEvento`
ADD CONSTRAINT `FK_7EE630355547AE1` FOREIGN KEY (`Evento_id`) REFERENCES `Evento` (`id`),
ADD CONSTRAINT `FK_7EE630357ED9674D` FOREIGN KEY (`Alumno_id`) REFERENCES `Alumno` (`id`);

--
-- Filtros para la tabla `AlumnoPago`
--
ALTER TABLE `AlumnoPago`
ADD CONSTRAINT `FK_7A4165235547AE1` FOREIGN KEY (`Evento_id`) REFERENCES `Evento` (`id`),
ADD CONSTRAINT `FK_7A4165237ED9674D` FOREIGN KEY (`Alumno_id`) REFERENCES `Alumno` (`id`);

--
-- Filtros para la tabla `AlumnoRecuerdo`
--
ALTER TABLE `AlumnoRecuerdo`
ADD CONSTRAINT `FK_4D7B75F7ED9674D` FOREIGN KEY (`Alumno_id`) REFERENCES `Alumno` (`id`),
ADD CONSTRAINT `FK_4D7B75F9465404E` FOREIGN KEY (`Usuario_id`) REFERENCES `Usuario` (`id`),
ADD CONSTRAINT `FK_4D7B75FF456DDDA` FOREIGN KEY (`Recuerdo_id`) REFERENCES `Recuerdo` (`id`);

--
-- Filtros para la tabla `Conferencia`
--
ALTER TABLE `Conferencia`
ADD CONSTRAINT `FK_57B021295547AE1` FOREIGN KEY (`Evento_id`) REFERENCES `Evento` (`id`),
ADD CONSTRAINT `FK_57B021297A0F2E6B` FOREIGN KEY (`Conferencista_id`) REFERENCES `Conferencista` (`id`),
ADD CONSTRAINT `FK_57B02129B5E7DFB2` FOREIGN KEY (`Salon_id`) REFERENCES `Salon` (`id`);

--
-- Filtros para la tabla `ConferenciaAlumno`
--
ALTER TABLE `ConferenciaAlumno`
ADD CONSTRAINT `FK_BB1AF4FE16231E67` FOREIGN KEY (`Conferencia_id`) REFERENCES `Conferencia` (`id`),
ADD CONSTRAINT `FK_BB1AF4FE7ED9674D` FOREIGN KEY (`Alumno_id`) REFERENCES `Alumno` (`id`);

--
-- Filtros para la tabla `fos_user_user_group`
--
ALTER TABLE `fos_user_user_group`
ADD CONSTRAINT `FK_B3C77447A76ED395` FOREIGN KEY (`user_id`) REFERENCES `Usuario` (`id`),
ADD CONSTRAINT `FK_B3C77447FE54D947` FOREIGN KEY (`group_id`) REFERENCES `Grupo` (`id`);

--
-- Filtros para la tabla `Pago`
--
ALTER TABLE `Pago`
ADD CONSTRAINT `FK_54EDF0007A0F2E6B` FOREIGN KEY (`Conferencista_id`) REFERENCES `Conferencista` (`id`),
ADD CONSTRAINT `FK_54EDF0009465404E` FOREIGN KEY (`Usuario_id`) REFERENCES `Usuario` (`id`);

--
-- Filtros para la tabla `Salon`
--
ALTER TABLE `Salon`
ADD CONSTRAINT `FK_33A9DB135547AE1` FOREIGN KEY (`Evento_id`) REFERENCES `Evento` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
