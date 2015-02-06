-- phpMyAdmin SQL Dump
-- version 4.2.9.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 19-01-2015 a las 12:36:51
-- Versión del servidor: 5.6.21-log
-- Versión de PHP: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `fenaci`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato1a`
--

CREATE TABLE IF NOT EXISTS `formato1a` (
`id` int(11) NOT NULL,
  `lider` varchar(100) DEFAULT NULL,
  `titulo` varchar(200) DEFAULT NULL,
  `reglas_protocolo` tinyint(1) DEFAULT NULL,
  `lista_revision` tinyint(1) DEFAULT NULL,
  `riesgos` tinyint(1) DEFAULT NULL,
  `areas_humanos` tinyint(1) DEFAULT NULL,
  `areas_biologicos` varchar(50) DEFAULT NULL,
  `formatos_todos` varchar(50) DEFAULT NULL,
  `adicionles_humanos` varchar(5) DEFAULT NULL,
  `adicionles_vertebrados` varchar(15) DEFAULT NULL,
  `adicionles_biologicos` varchar(15) DEFAULT NULL,
  `adicionles_quimicos` varchar(15) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato1a_individual`
--

CREATE TABLE IF NOT EXISTS `formato1a_individual` (
`id` int(11) NOT NULL,
  `lider` varchar(100) DEFAULT NULL,
  `grado` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `segundo_nombre` varchar(100) DEFAULT NULL,
  `segundo_grado` varchar(20) DEFAULT NULL,
  `segundo_email` varchar(100) DEFAULT NULL,
  `segundo_telefono` varchar(20) DEFAULT NULL,
  `tercero_nombre` varchar(100) DEFAULT NULL,
  `tercero_grado` varchar(50) DEFAULT NULL,
  `tercero_email` varchar(100) DEFAULT NULL,
  `tercero_telefono` varchar(20) DEFAULT NULL,
  `proyecto` varchar(200) DEFAULT NULL,
  `escuela` varchar(100) DEFAULT NULL,
  `escuela_direccion` varchar(100) DEFAULT NULL,
  `escuela_telefono` varchar(20) DEFAULT NULL,
  `mentor` varchar(100) DEFAULT NULL,
  `mentor_email` varchar(100) DEFAULT NULL,
  `continuacion` varchar(20) DEFAULT NULL,
  `continuacion_si` varchar(100) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `lugar` varchar(100) DEFAULT NULL,
  `lugar_otro` varchar(150) DEFAULT NULL,
  `anterior_nombre` varchar(100) DEFAULT NULL,
  `anterior_direccion` varchar(100) DEFAULT NULL,
  `anterior_telefono` varchar(20) DEFAULT NULL,
  `archivo` varchar(150) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato1b`
--

CREATE TABLE IF NOT EXISTS `formato1b` (
`id` int(11) NOT NULL,
  `compromiso` varchar(50) DEFAULT NULL,
  `expocientifico` varchar(100) DEFAULT NULL,
  `fecha_expocientifico` date DEFAULT NULL,
  `padre` varchar(100) DEFAULT NULL,
  `fecha_padre` date DEFAULT NULL,
  `a_titular` varchar(100) DEFAULT NULL,
  `a_fecha` date DEFAULT NULL,
  `a_feria` varchar(50) DEFAULT NULL,
  `b_titular` varchar(100) DEFAULT NULL,
  `b_fecha` date DEFAULT NULL,
  `b_feria` varchar(50) DEFAULT NULL,
  `presidente` varchar(100) DEFAULT NULL,
  `fecha_presidente` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato1c`
--

CREATE TABLE IF NOT EXISTS `formato1c` (
`id` int(11) NOT NULL,
  `lider` varchar(100) DEFAULT NULL,
  `proyecto` varchar(200) DEFAULT NULL,
  `actividad_centro` varchar(50) DEFAULT NULL,
  `idea` text,
  `reglas` varchar(2) DEFAULT NULL,
  `grupal` varchar(2) DEFAULT NULL,
  `tipo_grupo` varchar(300) DEFAULT NULL,
  `tipo_experimento` text,
  `cientifico` varchar(100) DEFAULT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `institucion` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato_4a`
--

CREATE TABLE IF NOT EXISTS `formato_4a` (
`id` int(11) NOT NULL,
  `expocientifico` varchar(100) DEFAULT NULL,
  `proyecto` varchar(150) DEFAULT NULL,
  `mentor` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `proposito` text,
  `participas` text,
  `tiempo` text,
  `riesgos` text,
  `beneficios` text,
  `confidencialidad` text,
  `dudas_mentor` varchar(100) DEFAULT NULL,
  `dudas_telefono` varchar(20) DEFAULT NULL,
  `dudas_email` varchar(100) DEFAULT NULL,
  `dudas_padre` varchar(100) DEFAULT NULL,
  `permiso` varchar(150) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato_5a`
--

CREATE TABLE IF NOT EXISTS `formato_5a` (
`id` int(11) NOT NULL,
  `lider` varchar(100) DEFAULT NULL,
  `proyecto` varchar(150) DEFAULT NULL,
  `alojamiento` text,
  `despues` text,
  `permiso` varchar(150) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato_5a_especies`
--

CREATE TABLE IF NOT EXISTS `formato_5a_especies` (
`id` int(11) NOT NULL,
  `id_5a` int(11) DEFAULT NULL,
  `posicion` tinyint(4) DEFAULT NULL,
  `genero` varchar(200) DEFAULT NULL,
  `especie` varchar(200) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `numero` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato_5b`
--

CREATE TABLE IF NOT EXISTS `formato_5b` (
`id` int(11) NOT NULL,
  `lider` varchar(100) DEFAULT NULL,
  `proyecto` varchar(150) DEFAULT NULL,
  `protocolo` varchar(200) DEFAULT NULL,
  `idea` text,
  `reglas` varchar(2) DEFAULT NULL,
  `capacitacion` text,
  `especies` varchar(200) DEFAULT NULL,
  `numero_animales` varchar(20) DEFAULT NULL,
  `dolor` text,
  `rol` text,
  `aprobacion` varchar(150) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato_agentes_biologicos`
--

CREATE TABLE IF NOT EXISTS `formato_agentes_biologicos` (
`id` int(11) NOT NULL,
  `lider` varchar(100) DEFAULT NULL,
  `proyecto` varchar(150) DEFAULT NULL,
  `biologicos` text,
  `lugar` text,
  `metodo_desecho` text,
  `procedimiento_riesgos` text,
  `seguridad` text,
  `entrenamiento` text,
  `acuerdo_recomendaciones` varchar(2) DEFAULT NULL,
  `acuerdo_recomendaciones_exp` text,
  `supervisor1` varchar(100) DEFAULT NULL,
  `fecha_supervisor1` date DEFAULT NULL,
  `NBS1` tinyint(1) DEFAULT NULL,
  `NBS2` tinyint(1) DEFAULT NULL,
  `supervisor2` varchar(100) DEFAULT NULL,
  `fecha_supervisor2` date DEFAULT NULL,
  `aprovado_comite` tinyint(1) DEFAULT NULL,
  `supervisor3` varchar(100) DEFAULT NULL,
  `fecha_supervisor3` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato_cientifico_calificado`
--

CREATE TABLE IF NOT EXISTS `formato_cientifico_calificado` (
`id` int(11) NOT NULL,
  `lider` varchar(100) DEFAULT NULL,
  `proyecto` varchar(200) DEFAULT NULL,
  `maestrias` varchar(200) DEFAULT NULL,
  `doctorado` varchar(200) DEFAULT NULL,
  `puesto` varchar(100) DEFAULT NULL,
  `institucion` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `enterado` varchar(2) DEFAULT NULL,
  `humanos` varchar(2) DEFAULT NULL,
  `vertebrados` varchar(2) DEFAULT NULL,
  `biologicos` varchar(2) DEFAULT NULL,
  `sustancias` varchar(2) DEFAULT NULL,
  `supervisar` varchar(2) DEFAULT NULL,
  `designado` varchar(100) DEFAULT NULL,
  `designado_experiencia` varchar(300) DEFAULT NULL,
  `precauciones` text,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato_investigacion_con_humanos`
--

CREATE TABLE IF NOT EXISTS `formato_investigacion_con_humanos` (
`id` int(11) NOT NULL,
  `lider` varchar(100) DEFAULT NULL,
  `proyecto` varchar(150) DEFAULT NULL,
  `proposito` text,
  `riesgos` text,
  `procedimientos` text,
  `contacto_estudiante` varchar(100) DEFAULT NULL,
  `contacto_mentor` varchar(100) DEFAULT NULL,
  `nivel_riesgo` varchar(50) DEFAULT NULL,
  `medico` varchar(100) DEFAULT NULL,
  `fecha_medico` date DEFAULT NULL,
  `profesor` varchar(100) DEFAULT NULL,
  `fecha_profesor` date DEFAULT NULL,
  `administrador` varchar(100) DEFAULT NULL,
  `fecha_administrador` date DEFAULT NULL,
  `condiciones_humano` tinyint(1) DEFAULT NULL,
  `libre_humano` tinyint(1) DEFAULT NULL,
  `imagenes_humano` tinyint(1) DEFAULT NULL,
  `nombre_humano` varchar(100) DEFAULT NULL,
  `fecha_humano` date DEFAULT NULL,
  `condiciones_padre` tinyint(1) DEFAULT NULL,
  `cuestionarios_padre` tinyint(1) DEFAULT NULL,
  `imagenes_padre` tinyint(1) DEFAULT NULL,
  `nombre_padre` varchar(100) DEFAULT NULL,
  `fecha_padre` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato_proyecto_en_continuidad`
--

CREATE TABLE IF NOT EXISTS `formato_proyecto_en_continuidad` (
`id` int(11) NOT NULL,
  `lider` varchar(100) DEFAULT NULL,
  `proyecto` varchar(150) DEFAULT NULL,
  `titulo_actual` varchar(150) DEFAULT NULL,
  `titulo_anterior` varchar(150) DEFAULT NULL,
  `titulo_anterior2` varchar(150) DEFAULT NULL,
  `objetivos_actual` varchar(200) DEFAULT NULL,
  `objetivos_anterior` varchar(200) DEFAULT NULL,
  `objetivos_anterior2` varchar(200) DEFAULT NULL,
  `variables_actual` varchar(200) DEFAULT NULL,
  `variables_anterior` varchar(200) DEFAULT NULL,
  `variables_anterior2` varchar(200) DEFAULT NULL,
  `investigacion_actual` varchar(200) DEFAULT NULL,
  `investigacion_anterior` varchar(200) DEFAULT NULL,
  `investigacion_anterior2` varchar(200) DEFAULT NULL,
  `cambios_actual` varchar(500) DEFAULT NULL,
  `cambios_anterior` varchar(500) DEFAULT NULL,
  `cambios_anterior2` varchar(500) DEFAULT NULL,
  `lider_informacion` varchar(100) DEFAULT NULL,
  `fecha_informacion` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato_supervisor_asesoria`
--

CREATE TABLE IF NOT EXISTS `formato_supervisor_asesoria` (
`id` int(11) NOT NULL,
  `expocientifico` varchar(100) DEFAULT NULL,
  `proyecto` varchar(150) DEFAULT NULL,
  `quimicos` text,
  `riesgos` text,
  `seguridad` text,
  `procedimientos` text,
  `fuentes` varchar(500) DEFAULT NULL,
  `supervisor` varchar(100) DEFAULT NULL,
  `puesto` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fecha_compromiso` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato_tejidos_de_animales_vertebrados`
--

CREATE TABLE IF NOT EXISTS `formato_tejidos_de_animales_vertebrados` (
`id` int(11) NOT NULL,
  `lider` varchar(100) DEFAULT NULL,
  `proyecto` varchar(150) DEFAULT NULL,
  `tejido_tipo` text,
  `tejido_de` text,
  `tejido_institucion` text,
  `supervisor_verifico` tinyint(1) DEFAULT NULL,
  `supervisor_certifico` tinyint(1) DEFAULT NULL,
  `supervisor` varchar(100) DEFAULT NULL,
  `fecha_supervisor` date DEFAULT NULL,
  `titulo_supervisor` varchar(100) DEFAULT NULL,
  `Institucion_supervisor` varchar(100) DEFAULT NULL,
  `telefono_supervisor` varchar(20) DEFAULT NULL,
  `email_supervisor` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logo_banner`
--

CREATE TABLE IF NOT EXISTS `logo_banner` (
`id_banner` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `tipo` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `registro` datetime DEFAULT NULL,
  `modificacion` datetime DEFAULT NULL,
  `id_promocion` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `logo_banner`
--

INSERT INTO `logo_banner` (`id_banner`, `nombre`, `tipo`, `status`, `imagen`, `registro`, `modificacion`, `id_promocion`) VALUES
(1, 'footer1', 1, 0, 'xdVuUwHL56g1.jpeg', '2014-09-04 15:51:10', '2015-01-19 12:34:31', NULL),
(2, 'footer2', 2, 0, 'alPqvCRtzlC0.jpeg', '2014-09-04 15:53:04', '2015-01-17 20:10:32', NULL),
(3, 'footer2', 3, 0, 'YGP5MAaopfKo.jpeg', '2014-09-04 15:53:04', '2015-01-19 11:03:03', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id_usuario` int(11) NOT NULL,
  `usuario` varchar(250) NOT NULL,
  `clave` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `nombres` varchar(250) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `fecha_acceso` datetime NOT NULL,
  `ip_acceso` varchar(15) NOT NULL,
  `id_sucursal` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `clave`, `email`, `nombres`, `fecha_registro`, `fecha_acceso`, `ip_acceso`, `id_sucursal`) VALUES
(1, 'admin', 'sa', 'carlos@influx.com.mx', 'administrador', '2011-03-15 10:25:01', '2014-07-09 10:18:16', '192.168.0.16', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `formato1a`
--
ALTER TABLE `formato1a`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formato1a_individual`
--
ALTER TABLE `formato1a_individual`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formato1b`
--
ALTER TABLE `formato1b`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formato1c`
--
ALTER TABLE `formato1c`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formato_4a`
--
ALTER TABLE `formato_4a`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formato_5a`
--
ALTER TABLE `formato_5a`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formato_5a_especies`
--
ALTER TABLE `formato_5a_especies`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formato_5b`
--
ALTER TABLE `formato_5b`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formato_agentes_biologicos`
--
ALTER TABLE `formato_agentes_biologicos`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formato_cientifico_calificado`
--
ALTER TABLE `formato_cientifico_calificado`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formato_investigacion_con_humanos`
--
ALTER TABLE `formato_investigacion_con_humanos`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formato_proyecto_en_continuidad`
--
ALTER TABLE `formato_proyecto_en_continuidad`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formato_supervisor_asesoria`
--
ALTER TABLE `formato_supervisor_asesoria`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formato_tejidos_de_animales_vertebrados`
--
ALTER TABLE `formato_tejidos_de_animales_vertebrados`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `logo_banner`
--
ALTER TABLE `logo_banner`
 ADD PRIMARY KEY (`id_banner`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `formato1a`
--
ALTER TABLE `formato1a`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `formato1a_individual`
--
ALTER TABLE `formato1a_individual`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `formato1b`
--
ALTER TABLE `formato1b`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `formato1c`
--
ALTER TABLE `formato1c`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `formato_4a`
--
ALTER TABLE `formato_4a`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `formato_5a`
--
ALTER TABLE `formato_5a`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `formato_5a_especies`
--
ALTER TABLE `formato_5a_especies`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `formato_5b`
--
ALTER TABLE `formato_5b`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `formato_agentes_biologicos`
--
ALTER TABLE `formato_agentes_biologicos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `formato_cientifico_calificado`
--
ALTER TABLE `formato_cientifico_calificado`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `formato_investigacion_con_humanos`
--
ALTER TABLE `formato_investigacion_con_humanos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `formato_proyecto_en_continuidad`
--
ALTER TABLE `formato_proyecto_en_continuidad`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `formato_supervisor_asesoria`
--
ALTER TABLE `formato_supervisor_asesoria`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `formato_tejidos_de_animales_vertebrados`
--
ALTER TABLE `formato_tejidos_de_animales_vertebrados`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `logo_banner`
--
ALTER TABLE `logo_banner`
MODIFY `id_banner` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
