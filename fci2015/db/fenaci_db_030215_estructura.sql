-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 03-02-2015 a las 14:23:40
-- Versión del servidor: 5.1.73-cll
-- Versión de PHP: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `influxco_fenaci`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campos_administrables`
--

CREATE TABLE IF NOT EXISTS `campos_administrables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seccion` varchar(50) DEFAULT NULL,
  `campo` varchar(200) DEFAULT NULL,
  `valor` varchar(200) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `campos_administrables`
--

INSERT INTO `campos_administrables` (`id`, `seccion`, `campo`, `valor`, `status`, `fecha_registro`, `fecha_modificacion`) VALUES
(1, 'todas', 'estado_id', '19', 1, '2015-01-23 00:00:00', NULL),
(2, 'todas', 'anio', '2015', 1, '2015-01-23 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `estado` varchar(200) COLLATE latin1_spanish_ci DEFAULT NULL,
  `prefijo` varchar(5) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=34 ;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `estado`, `prefijo`) VALUES
(1, 'Aguascalientes', 'AGS'),
(2, 'Baja California Norte', 'BCA'),
(3, 'Baja California Sur', 'BCS'),
(4, 'Campeche', 'CAM'),
(5, 'Chiapas', 'CHI'),
(6, 'Chihuahua', 'CHH'),
(7, 'Coahuila', 'COA'),
(8, 'Colima', 'COL'),
(9, 'Distrito Federal', 'DFE'),
(10, 'Durango', 'DGO'),
(11, 'Mexico', 'MEX'),
(12, 'Guanajuato', 'GTO'),
(13, 'Guerrero', 'GRO'),
(14, 'Hidalgo', 'HGO'),
(15, 'Jalisco', 'JAL'),
(16, 'Michoac', 'MIC'),
(17, 'Morelos', 'MOR'),
(18, 'Nayarit', 'NAY'),
(19, 'Nuevo Leon', 'NLE'),
(20, 'Oaxaca', 'OAX'),
(21, 'Puebla', 'PUE'),
(22, 'Queretaro', 'QRO'),
(23, 'Quintana Roo', 'QUR'),
(24, 'San Luis Potos', 'SLP'),
(25, 'Sinaloa', 'SIN'),
(26, 'Sonora', 'SON'),
(27, 'Tabasco', 'TAB'),
(28, 'Tamaulipas', 'TAM'),
(29, 'Tlaxcala', 'TLA'),
(30, 'Veracruz', 'VER'),
(32, 'Zacatecas', 'ZAC'),
(33, 'Yucat', 'YUC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato1a`
--

CREATE TABLE IF NOT EXISTS `formato1a` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `participante_id` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `paterno` varchar(50) DEFAULT NULL,
  `materno` varchar(50) DEFAULT NULL,
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
  `archivo` varchar(150) DEFAULT NULL,
  `terminado` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato1a_individual`
--

CREATE TABLE IF NOT EXISTS `formato1a_individual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `participante_id` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `paterno` varchar(50) DEFAULT NULL,
  `materno` varchar(50) DEFAULT NULL,
  `grado` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `segundo_nombre` varchar(100) DEFAULT NULL,
  `segundo_paterno` varchar(50) DEFAULT NULL,
  `segundo_materno` varchar(50) DEFAULT NULL,
  `segundo_grado` varchar(20) DEFAULT NULL,
  `segundo_email` varchar(100) DEFAULT NULL,
  `segundo_telefono` varchar(20) DEFAULT NULL,
  `tercero_nombre` varchar(100) DEFAULT NULL,
  `tercero_paterno` varchar(50) DEFAULT NULL,
  `tercero_materno` varchar(50) DEFAULT NULL,
  `tercero_grado` varchar(50) DEFAULT NULL,
  `tercero_email` varchar(100) DEFAULT NULL,
  `tercero_telefono` varchar(20) DEFAULT NULL,
  `proyecto` varchar(200) DEFAULT NULL,
  `escuela` varchar(100) DEFAULT NULL,
  `escuela_direccion` varchar(100) DEFAULT NULL,
  `escuela_telefono` varchar(20) DEFAULT NULL,
  `mentor` varchar(100) DEFAULT NULL,
  `mentor_paterno` varchar(50) DEFAULT NULL,
  `mentor_materno` varchar(50) DEFAULT NULL,
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
  `terminado` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato1b`
--

CREATE TABLE IF NOT EXISTS `formato1b` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `participante_id` int(11) DEFAULT NULL,
  `compromiso` varchar(50) DEFAULT NULL,
  `expocientifico` varchar(100) DEFAULT NULL,
  `expocientifico_paterno` varchar(50) DEFAULT NULL,
  `expocientifico_materno` varchar(50) DEFAULT NULL,
  `fecha_expocientifico` date DEFAULT NULL,
  `padre` varchar(100) DEFAULT NULL,
  `padre_paterno` varchar(50) DEFAULT NULL,
  `padre_materno` varchar(50) DEFAULT NULL,
  `fecha_padre` date DEFAULT NULL,
  `a_titular` varchar(100) DEFAULT NULL,
  `a_fecha` date DEFAULT NULL,
  `a_feria` varchar(50) DEFAULT NULL,
  `b_titular` varchar(100) DEFAULT NULL,
  `b_fecha` date DEFAULT NULL,
  `b_feria` varchar(50) DEFAULT NULL,
  `presidente` varchar(100) DEFAULT NULL,
  `fecha_presidente` date DEFAULT NULL,
  `archivo` varchar(150) DEFAULT NULL,
  `terminado` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato1c`
--

CREATE TABLE IF NOT EXISTS `formato1c` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `participante_id` int(11) DEFAULT NULL,
  `lider` varchar(100) DEFAULT NULL,
  `lider_paterno` varchar(50) DEFAULT NULL,
  `lider_materno` varchar(50) DEFAULT NULL,
  `proyecto` varchar(200) DEFAULT NULL,
  `actividad_centro` varchar(50) DEFAULT NULL,
  `idea` text,
  `reglas` varchar(2) DEFAULT NULL,
  `grupal` varchar(2) DEFAULT NULL,
  `tipo_grupo` varchar(300) DEFAULT NULL,
  `tipo_experimento` text,
  `cientifico` varchar(100) DEFAULT NULL,
  `cientifico_paterno` varchar(50) DEFAULT NULL,
  `cientifico_materno` varchar(50) DEFAULT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `institucion` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `archivo` varchar(150) DEFAULT NULL,
  `terminado` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formatos`
--

CREATE TABLE IF NOT EXISTS `formatos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tabla` varchar(100) DEFAULT NULL,
  `campo` varchar(50) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `nombre_formato` varchar(150) DEFAULT NULL,
  `carpeta` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `formatos`
--

INSERT INTO `formatos` (`id`, `tabla`, `campo`, `url`, `nombre_formato`, `carpeta`) VALUES
(1, 'formato1a', 'archivo', 'revision-mentor-estudiante.php', 'Mentor-Seguridad', 'revision-mentor-estudiante'),
(2, 'formato1a_individual', 'archivo', 'revision-estudiante.php', 'Lista de revisión del (los) estudiante(s)', 'revision-estudiante'),
(3, 'formato1b', 'archivo', 'formato-1b.php', 'Aprobación del proyecto', 'formato-1b'),
(4, 'formato1c', 'archivo', 'formato-1c.php', 'Institución de investigación', 'formato-1c'),
(5, 'formato_5a', 'archivo', 'forma-5a.php', 'Uso de animales vertebrados 5a', 'forma-5a'),
(6, 'formato_5b', 'archivo', 'forma-5b.php', 'Uso de animales vertebrados 5b', 'forma-5b'),
(7, 'formato_agentes_biologicos', 'archivo', 'agentes-biologicos.php', 'Uso de agentes biológicos o potencialmente peligrosos', 'agentes-biologicos'),
(8, 'formato_cientifico_calificado', 'archivo', 'cientifico-calificado.php', 'Científico Calificado', 'cientifico-calificado'),
(9, 'formato_f', 'archivo', 'formato-f.php', 'Plan de Investigación (PI)', 'formato-f'),
(10, 'formato_fipi', 'archivo', 'formato-fipi.php', 'FIPI', 'formato-fipi'),
(11, 'formato_investigacion_con_humanos', 'archivo', 'investigacion-con-humanos.php', 'Investigación con humanos', 'investigacion-con-humanos'),
(12, 'formato_supervisor_asesoria', 'archivo', 'supervisor-acesoria.php', 'Asesoría para la evaluación de riesgos', 'supervisor-acesoria'),
(13, 'formato_tejidos_de_animales_vertebrados', 'archivo', 'tejidos-de-animales-vertebrados.php', 'Uso de Tejidos de Animales Vertebrados', 'tejidos-de-animales-vertebrados');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato_4a`
--

CREATE TABLE IF NOT EXISTS `formato_4a` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `participante_id` int(11) DEFAULT NULL,
  `expocientifico` varchar(100) DEFAULT NULL,
  `expocientifico_paterno` varchar(50) DEFAULT NULL,
  `expocientifico_materno` varchar(50) DEFAULT NULL,
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
  `archivo` varchar(150) DEFAULT NULL,
  `terminado` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato_5a`
--

CREATE TABLE IF NOT EXISTS `formato_5a` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `participante_id` int(11) DEFAULT NULL,
  `lider` varchar(100) DEFAULT NULL,
  `lider_paterno` varchar(50) DEFAULT NULL,
  `lider_materno` varchar(50) DEFAULT NULL,
  `proyecto` varchar(150) DEFAULT NULL,
  `alojamiento` text,
  `despues` text,
  `archivo` varchar(150) DEFAULT NULL,
  `terminado` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato_5a_especies`
--

CREATE TABLE IF NOT EXISTS `formato_5a_especies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_5a` int(11) DEFAULT NULL,
  `posicion` tinyint(4) DEFAULT NULL,
  `genero` varchar(200) DEFAULT NULL,
  `especie` varchar(200) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `numero` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato_5b`
--

CREATE TABLE IF NOT EXISTS `formato_5b` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `participante_id` int(11) DEFAULT NULL,
  `lider` varchar(100) DEFAULT NULL,
  `lider_paterno` varchar(50) DEFAULT NULL,
  `lider_materno` varchar(50) DEFAULT NULL,
  `proyecto` varchar(150) DEFAULT NULL,
  `protocolo` varchar(200) DEFAULT NULL,
  `idea` text,
  `reglas` varchar(2) DEFAULT NULL,
  `capacitacion` text,
  `especies` varchar(200) DEFAULT NULL,
  `numero_animales` varchar(20) DEFAULT NULL,
  `dolor` text,
  `rol` text,
  `archivo` varchar(150) DEFAULT NULL,
  `terminado` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato_agentes_biologicos`
--

CREATE TABLE IF NOT EXISTS `formato_agentes_biologicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `participante_id` int(11) DEFAULT NULL,
  `lider` varchar(100) DEFAULT NULL,
  `lider_paterno` varchar(50) DEFAULT NULL,
  `lider_materno` varchar(50) DEFAULT NULL,
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
  `supervisor1_paterno` varchar(50) DEFAULT NULL,
  `supervisor1_materno` varchar(50) DEFAULT NULL,
  `fecha_supervisor1` date DEFAULT NULL,
  `NBS1` tinyint(1) DEFAULT NULL,
  `NBS2` tinyint(1) DEFAULT NULL,
  `supervisor2` varchar(100) DEFAULT NULL,
  `supervisor2_paterno` varchar(50) DEFAULT NULL,
  `supervisor2_materno` varchar(50) DEFAULT NULL,
  `fecha_supervisor2` date DEFAULT NULL,
  `aprovado_comite` tinyint(1) DEFAULT NULL,
  `supervisor3` varchar(100) DEFAULT NULL,
  `supervisor3_paterno` varchar(50) DEFAULT NULL,
  `supervisor3_materno` varchar(50) DEFAULT NULL,
  `fecha_supervisor3` date DEFAULT NULL,
  `archivo` varchar(150) DEFAULT NULL,
  `terminado` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato_cientifico_calificado`
--

CREATE TABLE IF NOT EXISTS `formato_cientifico_calificado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `participante_id` int(11) DEFAULT NULL,
  `lider` varchar(100) DEFAULT NULL,
  `lider_paterno` varchar(50) DEFAULT NULL,
  `lider_materno` varchar(50) DEFAULT NULL,
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
  `archivo` varchar(150) DEFAULT NULL,
  `terminado` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato_f`
--

CREATE TABLE IF NOT EXISTS `formato_f` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `participante_id` int(11) DEFAULT NULL,
  `proyecto` varchar(150) DEFAULT NULL,
  `lider` varchar(100) DEFAULT NULL,
  `lider_paterno` varchar(50) DEFAULT NULL,
  `lider_materno` varchar(50) DEFAULT NULL,
  `segundo` varchar(100) DEFAULT NULL,
  `segundo_paterno` varchar(50) DEFAULT NULL,
  `segundo_materno` varchar(50) DEFAULT NULL,
  `tercero` varchar(100) DEFAULT NULL,
  `tercero_paterno` varchar(50) DEFAULT NULL,
  `tercero_materno` varchar(50) DEFAULT NULL,
  `asesor` varchar(100) DEFAULT NULL,
  `asesor_paterno` varchar(50) DEFAULT NULL,
  `asesor_materno` varchar(50) DEFAULT NULL,
  `escuela` varchar(100) DEFAULT NULL,
  `original` varchar(2) DEFAULT NULL,
  `archivo` varchar(150) DEFAULT NULL,
  `terminado` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato_fipi`
--

CREATE TABLE IF NOT EXISTS `formato_fipi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `participante_id` int(11) DEFAULT NULL,
  `clave` varchar(20) DEFAULT NULL,
  `proyecto` varchar(150) DEFAULT NULL,
  `estudiante1` varchar(100) DEFAULT NULL,
  `estudiante1_paterno` varchar(50) DEFAULT NULL,
  `estudiante1_materno` varchar(50) DEFAULT NULL,
  `fecha_nacimiento1` date DEFAULT NULL,
  `estudiante2` varchar(100) DEFAULT NULL,
  `estudiante2_paterno` varchar(50) DEFAULT NULL,
  `estudiante2_materno` varchar(50) DEFAULT NULL,
  `fecha_nacimiento2` date DEFAULT NULL,
  `estudiante3` varchar(100) DEFAULT NULL,
  `estudiante3_paterno` varchar(50) DEFAULT NULL,
  `estudiante3_materno` varchar(50) DEFAULT NULL,
  `fecha_nacimiento3` date DEFAULT NULL,
  `institucion` varchar(150) DEFAULT NULL,
  `grado` varchar(50) DEFAULT NULL,
  `localidad` varchar(100) DEFAULT NULL,
  `estado_id` tinyint(4) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `asesor` varchar(100) DEFAULT NULL,
  `asesor_paterno` varchar(50) DEFAULT NULL,
  `asesor_materno` varchar(50) DEFAULT NULL,
  `fecha_nacimiento_asesor` date DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `resumen` text,
  `se_usara` varchar(100) DEFAULT NULL,
  `independiente` varchar(2) DEFAULT NULL,
  `pertenece_instituto` varchar(2) DEFAULT NULL,
  `continuacion` varchar(2) DEFAULT NULL,
  `fecha_lider` date DEFAULT NULL,
  `lider` varchar(100) DEFAULT NULL,
  `lider_paterno` varchar(50) DEFAULT NULL,
  `lider_materno` varchar(50) DEFAULT NULL,
  `archivo` varchar(150) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `terminado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato_investigacion_con_humanos`
--

CREATE TABLE IF NOT EXISTS `formato_investigacion_con_humanos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `participante_id` int(11) DEFAULT NULL,
  `lider` varchar(100) DEFAULT NULL,
  `lider_paterno` varchar(50) DEFAULT NULL,
  `lider_materno` varchar(50) DEFAULT NULL,
  `proyecto` varchar(150) DEFAULT NULL,
  `proposito` text,
  `riesgos` text,
  `procedimientos` text,
  `contacto_estudiante` varchar(100) DEFAULT NULL,
  `contacto_estudiante_paterno` varchar(50) DEFAULT NULL,
  `contacto_estudiante_materno` varchar(50) DEFAULT NULL,
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
  `nombre_humano_paterno` varchar(50) DEFAULT NULL,
  `nombre_humano_materno` varchar(50) DEFAULT NULL,
  `fecha_humano` date DEFAULT NULL,
  `condiciones_padre` tinyint(1) DEFAULT NULL,
  `cuestionarios_padre` tinyint(1) DEFAULT NULL,
  `imagenes_padre` tinyint(1) DEFAULT NULL,
  `nombre_padre` varchar(100) DEFAULT NULL,
  `nombre_padre_paterno` varchar(50) DEFAULT NULL,
  `nombre_padre_materno` varchar(50) DEFAULT NULL,
  `fecha_padre` date DEFAULT NULL,
  `archivo` varchar(150) DEFAULT NULL,
  `terminado` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato_proyecto_en_continuidad`
--

CREATE TABLE IF NOT EXISTS `formato_proyecto_en_continuidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `participante_id` int(11) DEFAULT NULL,
  `lider` varchar(100) DEFAULT NULL,
  `lider_paterno` varchar(50) DEFAULT NULL,
  `lider_materno` varchar(50) DEFAULT NULL,
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
  `archivo` varchar(150) DEFAULT NULL,
  `terminado` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato_supervisor_asesoria`
--

CREATE TABLE IF NOT EXISTS `formato_supervisor_asesoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `participante_id` int(11) DEFAULT NULL,
  `expocientifico` varchar(100) DEFAULT NULL,
  `expocientifico_paterno` varchar(50) DEFAULT NULL,
  `expocientifico_materno` varchar(50) DEFAULT NULL,
  `proyecto` varchar(150) DEFAULT NULL,
  `quimicos` text,
  `riesgos` text,
  `seguridad` text,
  `procedimientos` text,
  `fuentes` varchar(500) DEFAULT NULL,
  `supervisor` varchar(100) DEFAULT NULL,
  `supervisor_paterno` varchar(50) DEFAULT NULL,
  `supervisor_materno` varchar(50) DEFAULT NULL,
  `puesto` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fecha_compromiso` date DEFAULT NULL,
  `archivo` varchar(150) DEFAULT NULL,
  `terminado` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato_tejidos_de_animales_vertebrados`
--

CREATE TABLE IF NOT EXISTS `formato_tejidos_de_animales_vertebrados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `participante_id` int(11) DEFAULT NULL,
  `lider` varchar(100) DEFAULT NULL,
  `lider_paterno` varchar(50) DEFAULT NULL,
  `lider_materno` varchar(50) DEFAULT NULL,
  `proyecto` varchar(150) DEFAULT NULL,
  `tejido_tipo` text,
  `tejido_de` text,
  `tejido_institucion` text,
  `supervisor_verifico` tinyint(1) DEFAULT NULL,
  `supervisor_certifico` tinyint(1) DEFAULT NULL,
  `supervisor` varchar(100) DEFAULT NULL,
  `supervisor_paterno` varchar(50) DEFAULT NULL,
  `supervisor_materno` varchar(50) DEFAULT NULL,
  `fecha_supervisor` date DEFAULT NULL,
  `titulo_supervisor` varchar(100) DEFAULT NULL,
  `institucion_supervisor` varchar(100) DEFAULT NULL,
  `telefono_supervisor` varchar(20) DEFAULT NULL,
  `email_supervisor` varchar(100) DEFAULT NULL,
  `archivo` varchar(150) DEFAULT NULL,
  `terminado` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logo_banner`
--

CREATE TABLE IF NOT EXISTS `logo_banner` (
  `id_banner` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `tipo` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `registro` datetime DEFAULT NULL,
  `modificacion` datetime DEFAULT NULL,
  `id_promocion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_banner`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `logo_banner`
--

INSERT INTO `logo_banner` (`id_banner`, `nombre`, `tipo`, `status`, `imagen`, `registro`, `modificacion`, `id_promocion`) VALUES
(1, 'footer1', 1, 0, 'WsId57EbSGk.jpeg', '2014-09-04 15:51:10', '2015-01-20 13:01:21', NULL),
(2, 'footer2', 2, 0, 'alPqvCRtzlC0.jpeg', '2014-09-04 15:53:04', '2015-01-17 20:10:32', NULL),
(3, 'footer2', 3, 0, 'YGP5MAaopfKo.jpeg', '2014-09-04 15:53:04', '2015-01-19 11:03:03', NULL),
(4, 'feria', 4, 0, 'w1R4auWNyE8t.jpeg', '2014-09-04 15:53:04', '2015-01-27 09:40:32', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participantes`
--

CREATE TABLE IF NOT EXISTS `participantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `identificacion` varchar(100) DEFAULT NULL,
  `curp` varchar(100) DEFAULT NULL,
  `folio` varchar(10) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `fecha_acceso` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `participantes`
--

INSERT INTO `participantes` (`id`, `nombre`, `email`, `password`, `tipo`, `identificacion`, `curp`, `folio`, `status`, `fecha_registro`, `fecha_acceso`) VALUES
(1, 'Jair PÃ©rez', 'jair@influx.com.mx', 'jair18', 'Estudiante', NULL, NULL, 'NLE100', 1, '2015-01-29 18:00:01', '2015-01-29 18:00:01'),
(2, 'sergio rocha', 'sergio@influx.com.mx', 'rayados', 'Estudiante', 'J8D6yWirhmdf.jpeg', NULL, 'NLE101', 1, '2015-01-29 18:00:43', '2015-01-29 18:00:43'),
(3, 'participante1', 'email@email.com', '123', 'Estudiante', 'IJP6A0MjQJZO.pdf', NULL, 'NLE102', 1, '2015-01-29 18:01:39', '2015-01-29 18:01:39'),
(4, 'Alexandra', 'alexandra@influx.com', 'qwerty', 'Estudiante', 'eKkJgqYtKr2m.jpeg', NULL, 'NLE103', 1, '2015-01-29 18:05:13', '2015-01-29 18:05:13'),
(5, 'demo influx', 'soporte@influx.com.mx', '123', 'Estudiante', 'V4GFU6Hs4c0K.jpeg', NULL, 'NLE104', 1, '2015-01-29 18:24:09', '2015-01-29 18:24:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones_administrables`
--

CREATE TABLE IF NOT EXISTS `secciones_administrables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seccion` varchar(50) DEFAULT NULL,
  `contenido` text,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `secciones_administrables`
--

INSERT INTO `secciones_administrables` (`id`, `seccion`, `contenido`, `status`, `fecha_registro`, `fecha_modificacion`) VALUES
(1, 'proceso-fases', '<h1>Proceso General</h1>\r\n<p><img src="../../../images/g-proceso2.jpg" alt="" width="808" height="180" /></p>\r\n<h1>Rol de los Participantes</h1>\r\n<p><img src="../../../images/g-roles.jpg" alt="" width="908" height="242" /></p>\r\n<h1>Actividades previas</h1>\r\n<h2>El l&iacute;der de proyecto debe:</h2>\r\n<ul>\r\n<li>Descargar y preparar la documentaci&oacute;n del proyecto en formato PDF          \r\n<ul style="list-style-type: square;">\r\n<li> Carta de postulaci&oacute;n por parte de la instituci&oacute;n educativa. Formato A </li>\r\n<li> Protocolo de investigaci&oacute;n de acuerdo al formato publicado. Formato B </li>\r\n<li>Formato de Inscripci&oacute;n del Proyecto de Investigaci&oacute;n (FIPI). Formato C</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<ul>\r\n<li> Documentaci&oacute;n personal de cada integrante y del asesor      \r\n<ul style="list-style-type: square;">\r\n<li> Identificaci&oacute;n oficial (Credencial de elector o credencial escolar, Pasaporte) </li>\r\n<li> CURP </li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p><span style="font-size: small;"><strong>*El l&iacute;der de proyecto es quien realiza el registro y es el contacto &uacute;nico y directo con el responsable de proceso</strong></span></p>\r\n<h1>Registro de proyectos</h1>\r\n<ul>\r\n<li> Llenar y enviar los formatos correspondientes de registro de proyectos </li>\r\n<li> Revisar constantemente el correo electr&oacute;nico para cualquier aclaraci&oacute;n </li>\r\n</ul>\r\n<h1>Fases de evaluaci&oacute;n</h1>\r\n<p>La evaluaci&oacute;n se har&aacute; conforme al nivel educativo de los estudiantes y se clasificar&aacute;n en dos grupos:          <br />a) B&aacute;sica y          <br />b) Media Superior.</p>\r\n<p style="font-size: small;">El proceso de evaluaci&oacute;n considera 3 fases y ser&aacute; coordinado por el <span class="red">_(nombre del departamento o direcci&oacute;n que estar&aacute; a cargo de la convocatoria)_ (Siglas del consejo)</span>.</p>\r\n<p>La primera y segunda evaluaci&oacute;n la realizar&aacute; un comit&eacute; de expertos en el &aacute;rea de conocimiento de cada proyecto y ser&aacute; a trav&eacute;s de un sistema en l&iacute;nea. La tercera evaluaci&oacute;n o final se llevar&aacute; a cabo de forma presencial, durante la realizaci&oacute;n de la Feria; para ello se conformar&aacute; un grupo de especialistas, seg&uacute;n el n&uacute;mero de proyectos finalistas.</p>\r\n<p>Las fases de evaluaci&oacute;n son las siguientes:</p>\r\n<h2>Primera fase:</h2>\r\n<p>a) Se realizar&aacute; una <em>primera evaluaci&oacute;n</em> en l&iacute;nea de los proyectos registrados. Los resultados se publicar&aacute;n en la p&aacute;gina web <span class="red">http://direcci&oacute;n del consejo</span> a partir del 7 de mayo de 2015.</p>\r\n<p>b) Los proyectos aprobados en esta fase, podr&aacute;n participar en la segunda fase.</p>\r\n<h2>Segunda fase:</h2>\r\n<p>a) A los proyectos que clasifiquen a esta fase se les <em>recomienda</em> contar con un asesor externo quien deber&aacute; ser un profesor o investigador de una universidad o centro de investigaci&oacute;n especialista en el tema del proyecto.</p>\r\n<p>b) Ingresar al sistema web y adjuntar lo siguiente:</p>\r\n<ul class="ul">\r\n<li>Avances del proyecto conforme al <span class="red">Formato 5</span>.</li>\r\n<li>Los formatos correspondientes a cada proyecto, los cuales ser&aacute;n publicados con oportunidad en la p&aacute;gina web <span class="red">http:// direcci&oacute;n del consejo</span>. </li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>La documentaci&oacute;n deber&aacute; ingresarse al sistema en l&iacute;nea del 23 al 30 de junio del 2015, a fin de llevar a cabo la <em>segunda evaluaci&oacute;n</em> en l&iacute;nea.</p>\r\n<p>c) Los resultados de la segunda evaluaci&oacute;n ser&aacute;n publicados en la p&aacute;gina <span class="red">http:// direcci&oacute;n del consejo</span> a partir del 17 de agosto de 2015 y los proyectos aprobados podr&aacute;n ser considerados para la tercera fase.</p>\r\n<h2>Tercera fase:</h2>\r\n<p>a) Los proyectos aprobados para esta fase ser&aacute;n <em>proyectos finalistas</em> que deber&aacute;n presentarse en la Feria para la &uacute;ltima evaluaci&oacute;n.</p>\r\n<p>b) Al momento de presentarse en la Feria, el estudiante o l&iacute;der del proyecto deber&aacute; entregar el <em>reporte de investigaci&oacute;n del proyecto</em> <span class="red">(Formato 6)</span> impreso, engargolado y por triplicado, a fin de asegurar su participaci&oacute;n.</p>\r\n<p>c) La evaluaci&oacute;n final de los proyectos se llevar&aacute; a cabo durante la realizaci&oacute;n de la Feria y cada proyecto ser&aacute; revisado por al menos tres especialistas en el &aacute;rea del conocimiento y de investigaci&oacute;n correspondiente, quienes fungir&aacute;n como <em>jueces</em>.</p>', 1, '2015-01-23 00:00:00', '2015-01-29 18:04:09'),
(2, 'feria', '<h1>La Feria</h1>\r\n<h2>&iquest;Qu&eacute; es?</h2>\r\n<p>Concurso de proyectos de car&aacute;cter cient&iacute;fico y/o tecnol&oacute;gico que tiene la finalidad de premiar la creatividad, originalidad y m&eacute;rito cient&iacute;fico de estudiantes de nivel b&aacute;sico, medio superior y superior (de los 14 a los 20 a&ntilde;os) inscritos en instituciones educativas p&uacute;blicas o privadas asentadas en el Estado de M&eacute;xico.</p>\r\n<h2>Objetivos</h2>\r\n<ul class="ul">\r\n<li>Fomentar las vocaciones cient&iacute;ficas y tecnol&oacute;gicas entre estudiantes de diferentes niveles educativos, apoyando las iniciativas de desarrollo de proyectos cient&iacute;ficos.</li>\r\n<li>Promover e impulsar la ciencia y la tecnolog&iacute;a entre la comunidad estudiantil de la entidad.</li>\r\n<li>Estimular las habilidades cient&iacute;ficas y tecnol&oacute;gicas de los j&oacute;venes.</li>\r\n<li>Apoyar y fomentar nuevas generaciones de j&oacute;venes talentosos en &aacute;reas de ciencia y tecnolog&iacute;a.</li>\r\n</ul>\r\n<!--\r\n<p>Es el evento que re&uacute;ne a los participantes de proyectos finalistas para que expongan los resultados del proyecto de investigaci&oacute;n en un cartel para ser evaluados por al menos tres jueces.</p>\r\n-->\r\n<p>La organizaci&oacute;n de la feria estar&aacute; a cargo del _(nombre del departamento o direcci&oacute;n que estar&aacute; a cargo de la convocatoria)_ (Siglas del consejo), quien ser&aacute; el responsable de informar con antelaci&oacute;n sobre la realizaci&oacute;n de la misma, la documentaci&oacute;n requerida y dem&aacute;s informaci&oacute;n relevante, as&iacute; como las <em>Reglas de participaci&oacute;n</em> que deber&aacute;n respetar todos los participantes.</p>\r\n<p>Se llevar&aacute; a cabo del 23 al 26 de septiembre de 2015; el lugar ser&aacute; comunicado con la debida antelaci&oacute;n, en la p&aacute;gina web http:// direcci&oacute;n del consejo</p>\r\n<p>Los <em>proyectos finalistas</em> deber&aacute;n cumplir con lo mencionado y apegarse a las Reglas de participaci&oacute;n.</p>', 1, '2015-01-23 00:00:00', '2015-01-30 16:41:25'),
(3, 'informes', '<h1>Informes</h1>\r\n<p>Toda la informaci&oacute;n relacionada con la Feria se publicar&aacute; en la p&aacute;gina web http:// direcci&oacute;n del consejo</p>\r\n<p>Para dudas o comentarios sobre esta convocatoria, puede comunicarse al correo electr&oacute;nico  _______  o a los tel&eacute;fonos ________________.</p>', 1, '2015-01-23 00:00:00', '2015-01-29 17:59:29'),
(4, 'index', '<p>El Consejo Nacional de Ciencia y Tecnolog&iacute;a (CONACYT) y la&nbsp;<span>Feria Nacional de Ciencias e Ingenier&iacute;a</span>&nbsp;con fundamento en el Programa Especial de Ciencia, Tecnolog&iacute;a e Innovaci&oacute;n (PECITI) 2014-2018 y <span class="red">en ____ del Estado de [estado] y ___ del _____________________ </span>con el objeto de impulsar la investigaci&oacute;n cient&iacute;fica y tecnol&oacute;gica entre los j&oacute;venes en los diferentes sistemas educativos de la entidad, as&iacute; como fomentar las vocaciones cient&iacute;ficas,</p>\r\n<h1>C O N V O C A N</h1>\r\n<p>A estudiantes n<span>uevoleoneses</span>&nbsp;interesados en el desarrollo de proyectos cient&iacute;ficos o tecnol&oacute;gicos a participar en la</p>\r\n<h1>FERIA DE CIENCIAS E INGENIER&Iacute;AS           <br /><span class="red">ESTADO DE [estado] 2015</span></h1>\r\n<p>bajo las siguientes:         <br /><br /> <!--<a href="docs/convocatoria-feria-estatal-de-ciencias-e-ingenierias.pdf" _mce_href="docs/convocatoria-feria-estatal-de-ciencias-e-ingenierias.pdf" target="_blank"><button class="btn btn-5 btn-5a icon-edit-alt"><span>BASES</span></button></a>-->       	<a href="docs/bases.pdf" target="_blank"><button class="btn btn-5 btn-5a icon-edit-alt"><span>BASES</span></button></a></p>', 1, '2015-01-23 00:00:00', '2015-01-23 17:54:11'),
(5, 'participantes', '<h1>Participantes</h1>\r\n<ul style="list-style-type: disc;">\r\n<li>Estudiantes que se encuentren inscritos en instituciones educativas p&uacute;blicas o privadas asentadas en el <span class="red">Estado de _______,</span> de los siguientes niveles educativos:&nbsp;\r\n<ul>\r\n<li>b&aacute;sico (secundaria)&nbsp;</li>\r\n<li>media superior</li>\r\n</ul>\r\n</li>\r\n<li>La edad de los estudiantes deber&aacute; ser entre los 14 a&ntilde;os y hasta aquellos que hayan cumplido los 20 a&ntilde;os al 25 de julio de 2016.</li>\r\n<li>El proyecto a registrar deber&aacute; ser de investigaci&oacute;n cient&iacute;fica o de desarrollo tecnol&oacute;gico.</li>\r\n<li>El proyecto podr&aacute; ser desarrollado de manera individual o en equipo de 3 estudiantes como m&aacute;ximo, los cuales deber&aacute;n ser irremplazables.</li>\r\n<li>Los estudiantes deber&aacute;n estar registrados en un solo proyecto.</li>\r\n<li>En caso de que el proyecto se presente en equipo, los estudiantes deber&aacute;n elegir a un <em>l&iacute;der del proyecto</em>, quien se encargar&aacute; de llevar a cabo el registro del mismo y ser&aacute; el contacto y enlace con el <span class="red">_(nombre del departamento o direcci&oacute;n que estar&aacute; a cargo de la convocatoria)_ (Siglas del consejo)</span>.</li>\r\n<li>Deber&aacute;n contar con un <em>asesor</em>, quien ser&aacute; un docente adscrito a la instituci&oacute;n educativa a la que pertenecen y que cuente con la formaci&oacute;n acad&eacute;mica congruente con el &aacute;rea de conocimiento del proyecto.</li>\r\n</ul>\r\n<ol> </ol>', 1, '2015-01-23 00:00:00', '2015-01-30 19:31:56'),
(6, 'areas-de-conocimiento', '<h1>&Aacute;reas de conocimiento</h1>\r\n<p>Los proyectos deber&aacute;n ser originales y congruentes con alguna de las siguientes &aacute;reas:</p>\r\n<ul class="ul">\r\n<li><span class="blue bold">Ciencias Animales y de las Plantas</span> (Ecolog&iacute;a, patolog&iacute;a, fisiolog&iacute;a, gen&eacute;tica, evoluci&oacute;n).</li>\r\n<li><span class="blue bold">Ciencias Sociales y del Comportamiento</span> (Psicolog&iacute;a, sociolog&iacute;a, antropolog&iacute;a, arqueolog&iacute;a, etnolog&iacute;a, aprendizaje, pruebas educacionales, pedagog&iacute;a).</li>\r\n<li><span class="blue bold">Bioqu&iacute;mica y Biolog&iacute;a Celular y Molecular</span> (Bioqu&iacute;mica general, metabolismo, bioqu&iacute;mica estructural, biolog&iacute;a celular, gen&eacute;tica celular y molecular, inmunolog&iacute;a, biolog&iacute;a molecular).</li>\r\n<li><span class="blue bold">Qu&iacute;mica</span> (Fisicoqu&iacute;mica, qu&iacute;mica org&aacute;nica, qu&iacute;mica inorg&aacute;nica, qu&iacute;mica anal&iacute;tica, qu&iacute;mica general, ciencia y tecnolog&iacute;a de los alimentos).</li>\r\n<li><span class="blue bold">Ciencias de la Computaci&oacute;n </span> (Algoritmos, bases de datos, inteligencia artificial, redes y comunicaciones, gr&aacute;ficos, ingenier&iacute;a de software, lenguajes de programaci&oacute;n, sistemas de c&oacute;mputo, sistemas operativos).</li>\r\n<li><span class="blue bold">Ciencias de la Tierra y de los Planetas </span> (Geolog&iacute;a, mineralog&iacute;a, fisiograf&iacute;a, oceanograf&iacute;a, meteorolog&iacute;a, climatolog&iacute;a, sismograf&iacute;a, geof&iacute;sica).</li>\r\n<li><span class="blue bold">Ingenier&iacute;a de Materiales y Bioingenier&iacute;a </span> (Civil, qu&iacute;mica, sonido, industrial, procesos, ciencias de materiales).</li>\r\n<li><span class="blue bold">Ingenier&iacute;a El&eacute;ctrica y Mec&aacute;nica </span> (Ingenier&iacute;a el&eacute;ctrica, mec&aacute;nica, electr&oacute;nica, controles, termodin&aacute;mica, solar, rob&oacute;tica, mecatr&oacute;nica).</li>\r\n<li><span class="blue bold">Energ&iacute;a y Transporte</span> (Ingenier&iacute;a del espacio y aeron&aacute;utica, aerodin&aacute;mica, combustibles alternativos, energ&iacute;a de combustibles f&oacute;siles, desarrollo de veh&iacute;culos, energ&iacute;as renovables).</li>\r\n<li><span class="blue bold">Manejo Ambiental y An&aacute;lisis Ambiental</span> (Biorremediaci&oacute;n, manejos de ecosistemas, ingenier&iacute;a ambiental, manejo de recursos de la tierra, reciclaje forestal, manejo de desechos, contaminaci&oacute;n y calidad del agua, suelo y aire).</li>\r\n<li><span class="blue bold">Medicina y Salud</span> (Diagn&oacute;stico y tratamiento de enfermedades, epidemiolog&iacute;a, gen&eacute;tica, biolog&iacute;a molecular de enfermedades, fisiolog&iacute;a y fisiopatolog&iacute;a). Estos proyectos deber&aacute;n de cumplir con un protocolo m&eacute;dico.</li>\r\n<li><span class="blue bold">Microbiolog&iacute;a</span> (Antibi&oacute;ticos, antimicrobianos, bacteriolog&iacute;a, gen&eacute;tica microbiana, virolog&iacute;a).</li>\r\n<li><span class="blue bold">F&iacute;sica y Astronom&iacute;a.</span></li>\r\n<li><span class="blue bold">Ciencias Matem&aacute;ticas.</span></li>\r\n</ul>', 1, '2015-01-23 00:00:00', '2015-01-26 15:20:34'),
(7, 'reconocimientos', '<h1>Reconocimientos</h1>\r\n<p>Se entregar&aacute;n constancias por nivel educativo en las diferentes &aacute;reas y a los que obtengan los mayores puntajes.</p>\r\n<p>Reconocimiento (constancia) por proyecto al primer, segundo y tercer lugar de nivel b&aacute;sico de las siguientes &aacute;reas:</p>\r\n<ul>\r\n<li>Ciencias Sociales</li>\r\n<li>Ciencias Exactas</li>\r\n<li>Ingenier&iacute;a y Computaci&oacute;n</li>\r\n<li>Medicina y Salud</li>\r\n<li>Ciencias Naturales y Ambiental</li>\r\n</ul>\r\n<p>Reconocimiento (constancia) por proyecto al primer, segundo y tercer lugar de nivel medio superior de las siguientes &aacute;reas:</p>\r\n<ul>\r\n<li>Ciencias Sociales</li>\r\n<li>Ciencias Exactas</li>\r\n<li>Ingenier&iacute;a y Computaci&oacute;n</li>\r\n<li>Medicina y Salud</li>\r\n<li>Ciencias Naturales y Ambientales</li>\r\n</ul>\r\n<p>Reconocimiento (constancia) a los estudiantes y asesor de proyectos que obtengan los mayores puntajes. Dichos proyectos se presentar&aacute;n en la Feria Regional correspondiente. Los gastos para participar en la Feria Regional ser&aacute;n cubiertos por los organizadores de la misma.</p>\r\n<p>Cualquier situaci&oacute;n no prevista en la presente Convocatoria, se resolver&aacute; oportunamente por la _(nombre de la direcci&oacute;n que estar&aacute; a cargo de la convocatoria)_ (Siglas del consejo).</p>', 1, '2015-01-23 00:00:00', '2015-01-29 18:02:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(250) NOT NULL,
  `clave` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `nombres` varchar(250) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `fecha_acceso` datetime NOT NULL,
  `ip_acceso` varchar(15) NOT NULL,
  `id_sucursal` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `clave`, `email`, `nombres`, `fecha_registro`, `fecha_acceso`, `ip_acceso`, `id_sucursal`) VALUES
(1, 'admin', 'sa', 'carlos@influx.com.mx', 'administrador', '2011-03-15 10:25:01', '2015-01-29 16:19:44', '192.168.0.128', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
