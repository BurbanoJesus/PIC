-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-01-2021 a las 06:16:12
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_plataforma_salud`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id_actividad` varchar(30) NOT NULL,
  `id_modulo` varchar(30) NOT NULL,
  `nombre_actividad` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `tiempo` char(4) NOT NULL,
  `tipo_actividad` char(8) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id_actividad`, `id_modulo`, `nombre_actividad`, `descripcion`, `tiempo`, `tipo_actividad`, `fecha`) VALUES
('AC5f794e1e8a46e5.24977885', 'MD5f7949d6a94643.10748216', 'sd', '', '', 'general', '2020-10-03 23:22:54'),
('AC5f966009701840.86018165', 'MD5f965ca6033d06.60372998', '3', '<p>3<br></p>', '', 'general', '2020-10-26 00:35:05'),
('AC5f96618c5d5021.95642307', 'MD5f965ca6033d06.60372998', '2', '22', '22', 'examen', '2020-10-26 00:41:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id_curso` varchar(30) NOT NULL,
  `nombre_curso` varchar(200) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `dimension` varchar(60) NOT NULL,
  `img_curso` text NOT NULL,
  `nota_curso` decimal(2,1) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id_curso`, `nombre_curso`, `descripcion`, `dimension`, `img_curso`, `nota_curso`, `fecha`) VALUES
('CU5f76750a6d3180.15302091', 'hgfh hgfh hgfh hgfh ', '', 'Vida saludable y condiciones no transmisibles', 'http://localhost/plataforma/static/multimedia/cursos/CU5f76750a6d3180.15302091/100502476_135050848157521_7827829191201521664_o.jpg', '4.0', '2020-10-04 19:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos_certificados`
--

CREATE TABLE `cursos_certificados` (
  `id_curso_certificado` varchar(30) NOT NULL,
  `id_curso` varchar(30) NOT NULL,
  `usuario` varchar(80) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos_codigos`
--

CREATE TABLE `cursos_codigos` (
  `id_cursos_codigos` int(11) NOT NULL,
  `id_curso` varchar(30) NOT NULL,
  `codigo` varchar(30) NOT NULL,
  `usuario` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos_codigos`
--

INSERT INTO `cursos_codigos` (`id_cursos_codigos`, `id_curso`, `codigo`, `usuario`) VALUES
(5, 'CU5f76750a6d3180.15302091', 'COD_CU5f792e19e79c17.47233620', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos_comentarios`
--

CREATE TABLE `cursos_comentarios` (
  `id_comentario` int(11) NOT NULL,
  `valoracion` decimal(2,1) NOT NULL,
  `texto_comentario` text NOT NULL,
  `usuario` varchar(80) NOT NULL,
  `id_curso` varchar(30) NOT NULL,
  `fecha_comentario` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos_comentarios`
--

INSERT INTO `cursos_comentarios` (`id_comentario`, `valoracion`, `texto_comentario`, `usuario`, `id_curso`, `fecha_comentario`) VALUES
(5, '4.0', 'sofia te amo 2', 'admin', 'CU5f76750a6d3180.15302091', '2020-10-03 21:42:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos_completados`
--

CREATE TABLE `cursos_completados` (
  `id_curso_completado` int(11) NOT NULL,
  `estados_cursos` varchar(30) NOT NULL,
  `id_curso` varchar(30) NOT NULL,
  `usuario` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos_examenes`
--

CREATE TABLE `cursos_examenes` (
  `id_curso_examen` int(11) NOT NULL,
  `id_actividad` varchar(30) NOT NULL,
  `usuario` varchar(80) NOT NULL,
  `nota_examen` varchar(5) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos_examenes`
--

INSERT INTO `cursos_examenes` (`id_curso_examen`, `id_actividad`, `usuario`, `nota_examen`, `fecha`) VALUES
(15, 'AC5f96618c5d5021.95642307', 'admin', 'R', '2020-10-26 14:00:06'),
(16, 'AC5f96618c5d5021.95642307', 'admin', 'R', '2020-10-26 14:01:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos_progreso`
--

CREATE TABLE `cursos_progreso` (
  `id_progreso` int(11) NOT NULL,
  `id_curso` varchar(30) NOT NULL,
  `id_modulo` varchar(30) NOT NULL,
  `id_actividad` varchar(30) NOT NULL,
  `usuario` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos_progreso`
--

INSERT INTO `cursos_progreso` (`id_progreso`, `id_curso`, `id_modulo`, `id_actividad`, `usuario`) VALUES
(132, 'CU5f76750a6d3180.15302091', 'MD5f7949d6a94643.10748216', 'AC5f794e1e8a46e5.24977885', 'admin'),
(133, 'CU5f76750a6d3180.15302091', 'MD5f965ca6033d06.60372998', 'AC5f96618c5d5021.95642307', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos_suscripciones`
--

CREATE TABLE `cursos_suscripciones` (
  `id_curso_suscripcion` int(11) NOT NULL,
  `id_curso` varchar(30) NOT NULL,
  `usuario` varchar(80) NOT NULL,
  `codigo` varchar(30) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos_suscripciones`
--

INSERT INTO `cursos_suscripciones` (`id_curso_suscripcion`, `id_curso`, `usuario`, `codigo`, `fecha`) VALUES
(8, 'CU5f76750a6d3180.15302091', 'admin', 'COD_CU5f792e19e79c17.47233620', '2020-10-03 21:02:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `debug`
--

CREATE TABLE `debug` (
  `id_debug` int(11) NOT NULL,
  `nombre_error` varchar(500) NOT NULL,
  `tipo_error` varchar(100) NOT NULL,
  `fecha_error` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `debug`
--

INSERT INTO `debug` (`id_debug`, `nombre_error`, `tipo_error`, `fecha_error`) VALUES
(32, 'SQLSTATE[23000]: Integrity constraint violation: 1452 Cannot add or update a child row: a foreign key constraint fails (`db_plataforma_salud`.`notificaciones`, CONSTRAINT `notificaciones_ibfk_4` FOREIGN KEY (`id_curso_certificado`) REFERENCES `cursos_certificados` (`id_curso_certificado`) ON DELETE CASCADE O...) -- 23000', 'Insertar - Notificacion', '2020-10-19 03:57:52'),
(33, 'SQLSTATE[23000]: Integrity constraint violation: 1048 Column \'tecnologia\' cannot be null -- 23000', 'Insertar - Informe', '2020-10-20 03:22:40'),
(34, 'SQLSTATE[23000]: Integrity constraint violation: 1452 Cannot add or update a child row: a foreign key constraint fails (`db_plataforma_salud`.`informes`, CONSTRAINT `informes_ibfk_1` FOREIGN KEY (`municipio`) REFERENCES `municipios` (`municipio`) ON DELETE CASCADE ON UPDATE CASCADE) -- 23000', 'Insertar - Informe', '2020-10-20 03:27:29'),
(35, 'SQLSTATE[23000]: Integrity constraint violation: 1452 Cannot add or update a child row: a foreign key constraint fails (`db_plataforma_salud`.`informes`, CONSTRAINT `informes_ibfk_1` FOREIGN KEY (`municipio`) REFERENCES `municipios` (`municipio`) ON DELETE CASCADE ON UPDATE CASCADE) -- 23000', 'Insertar - Informe', '2020-10-20 03:29:49'),
(36, 'SQLSTATE[23000]: Integrity constraint violation: 1452 Cannot add or update a child row: a foreign key constraint fails (`db_plataforma_salud`.`informes`, CONSTRAINT `informes_ibfk_1` FOREIGN KEY (`municipio`) REFERENCES `municipios` (`municipio`) ON DELETE CASCADE ON UPDATE CASCADE) -- 23000', 'Insertar - Informe', '2020-10-20 03:31:51'),
(37, 'SQLSTATE[23000]: Integrity constraint violation: 1452 Cannot add or update a child row: a foreign key constraint fails (`db_plataforma_salud`.`informes`, CONSTRAINT `informes_ibfk_1` FOREIGN KEY (`municipio`) REFERENCES `municipios` (`municipio`) ON DELETE CASCADE ON UPDATE CASCADE) -- 23000', 'Insertar - Informe', '2020-10-20 03:37:15'),
(38, 'SQLSTATE[23000]: Integrity constraint violation: 1452 Cannot add or update a child row: a foreign key constraint fails (`db_plataforma_salud`.`informes`, CONSTRAINT `informes_ibfk_1` FOREIGN KEY (`municipio`) REFERENCES `municipios` (`municipio`) ON DELETE CASCADE ON UPDATE CASCADE) -- 23000', 'Insertar - Informe', '2020-10-20 03:38:45'),
(39, 'SQLSTATE[23000]: Integrity constraint violation: 1452 Cannot add or update a child row: a foreign key constraint fails (`db_plataforma_salud`.`informes`, CONSTRAINT `informes_ibfk_3` FOREIGN KEY (`municipio`) REFERENCES `municipios` (`municipio`) ON DELETE CASCADE ON UPDATE CASCADE) -- 23000', 'Insertar - Informe', '2020-10-20 03:50:19'),
(40, 'SQLSTATE[23000]: Integrity constraint violation: 1452 Cannot add or update a child row: a foreign key constraint fails (`db_plataforma_salud`.`informes`, CONSTRAINT `informes_ibfk_3` FOREIGN KEY (`municipio`) REFERENCES `municipios` (`municipio`) ON DELETE CASCADE ON UPDATE CASCADE) -- 23000', 'Insertar - Informe', '2020-10-20 03:51:29'),
(41, 'SQLSTATE[23000]: Integrity constraint violation: 1452 Cannot add or update a child row: a foreign key constraint fails (`db_plataforma_salud`.`preguntas_examenes`, CONSTRAINT `preguntas_examenes_ibfk_1` FOREIGN KEY (`id_actividad`) REFERENCES `actividades` (`id_actividad`) ON DELETE CASCADE ON UPDATE CASCADE) -- 23000', 'Insertar - Actividad preguntas examenes', '2020-10-26 00:36:00'),
(42, 'No existe carpeta', 'Eliminar', '2020-10-26 00:39:15'),
(43, 'SQLSTATE[23000]: Integrity constraint violation: 1452 Cannot add or update a child row: a foreign key constraint fails (`db_plataforma_salud`.`preguntas_examenes`, CONSTRAINT `preguntas_examenes_ibfk_1` FOREIGN KEY (`id_actividad`) REFERENCES `actividades` (`id_actividad`) ON DELETE CASCADE ON UPDATE CASCADE) -- 23000', 'Insertar - Actividad preguntas examenes', '2020-10-26 00:40:27'),
(44, 'No existe carpeta', 'Eliminar', '2020-10-26 00:41:21'),
(45, 'SQLSTATE[21S01]: Insert value list does not match column list: 1136 Column count doesn\'t match value count at row 1 -- 21S01', 'Insertar - Curso examen', '2020-10-26 00:49:09'),
(46, 'SQLSTATE[21S01]: Insert value list does not match column list: 1136 Column count doesn\'t match value count at row 1 -- 21S01', 'Insertar - Curso examen', '2020-10-26 00:49:17'),
(47, 'SQLSTATE[21S01]: Insert value list does not match column list: 1136 Column count doesn\'t match value count at row 1 -- 21S01', 'Insertar - Curso examen', '2020-10-26 00:49:22'),
(48, 'SQLSTATE[21S01]: Insert value list does not match column list: 1136 Column count doesn\'t match value count at row 1 -- 21S01', 'Insertar - Curso examen', '2020-10-26 00:49:26'),
(49, 'SQLSTATE[21S01]: Insert value list does not match column list: 1136 Column count doesn\'t match value count at row 1 -- 21S01', 'Insertar - Curso examen', '2020-10-26 00:49:48'),
(50, 'SQLSTATE[21S01]: Insert value list does not match column list: 1136 Column count doesn\'t match value count at row 1 -- 21S01', 'Insertar - Curso examen', '2020-10-26 13:55:26'),
(51, 'SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry \'AC5f96618c5d5021.95642307-admin\' for key \'id_actividad\' -- 23000', 'Actualizar - Progreso curso', '2020-10-26 13:55:26'),
(52, 'SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry \'AC5f96618c5d5021.95642307-admin\' for key \'id_actividad\' -- 23000', 'Actualizar - Progreso curso', '2020-10-26 14:00:06'),
(53, 'SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry \'AC5f96618c5d5021.95642307-admin\' for key \'id_actividad\' -- 23000', 'Actualizar - Progreso curso', '2020-10-26 14:01:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informes`
--

CREATE TABLE `informes` (
  `id_informe` varchar(30) NOT NULL,
  `url_informe` text NOT NULL,
  `tipo_informe` varchar(2) NOT NULL,
  `usuario` varchar(80) NOT NULL,
  `year` varchar(4) NOT NULL,
  `municipio` varchar(80) NOT NULL,
  `dimension` varchar(60) NOT NULL,
  `tecnologia` varchar(255) NOT NULL,
  `grupo` varchar(255) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `informes`
--

INSERT INTO `informes` (`id_informe`, `url_informe`, `tipo_informe`, `usuario`, `year`, `municipio`, `dimension`, `tecnologia`, `grupo`, `fecha`) VALUES
('PD5f93ab65e7f1b8.37465981', 'http://localhost/plataforma/static/multimedia/informes/admin/Doc1(1)_2.pdf', '00', 'admin', '2015', 'Aldana', 'Salud Ambiental', 'Caracterización social y ambiental del entorno', 'presentacion equipo pic', '2020-10-23 23:19:49'),
('PD5f965b9e637264.56984206', 'http://localhost/plataforma/static/multimedia/informes/admin/Foreign Key MYSQL.txt', '00', 'admin', '2016', 'Ancuya', 'Salud Ambiental', 'Información en salud', 'Presentación Equipo PIC', '2020-10-26 00:16:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos_ahorcado`
--

CREATE TABLE `juegos_ahorcado` (
  `id_juego` int(11) NOT NULL,
  `enunciado` varchar(500) NOT NULL,
  `respuesta` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `juegos_ahorcado`
--

INSERT INTO `juegos_ahorcado` (`id_juego`, `enunciado`, `respuesta`) VALUES
(1, 'Es un agente infeccioso microscópico acelular que solo puede reproducirse dentro de las células de otros organismos.​', 'virus'),
(2, 'Sustancia cuya molécula está compuesta por dos átomos de hidrógeno y uno de oxígeno.​', 'agua'),
(3, 'eqwe 1', 'ju gar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos_arrastrar`
--

CREATE TABLE `juegos_arrastrar` (
  `id_juego` int(11) NOT NULL,
  `enunciado` varchar(500) NOT NULL,
  `respuesta` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `juegos_arrastrar`
--

INSERT INTO `juegos_arrastrar` (`id_juego`, `enunciado`, `respuesta`) VALUES
(5, 'Sustancia cuya molécula está compuesta por dos átomos de hidrógeno y uno de oxígeno.​', 'agua'),
(10, 'Es un agente infeccioso microscópico acelular que solo puede reproducirse dentro de las células de otros organismos.​', 'virus'),
(30, 'Son microorganismos procariotas que presentan un tamaño de unos pocos micrómetros y diversas formas.​', 'bacterias'),
(43, 'Es una señal de que su cuerpo está tratando de combatir una enfermedad o infección.​​', 'fiebre'),
(44, 'ASDSD 1', 'ASDD 1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos_progreso`
--

CREATE TABLE `juegos_progreso` (
  `id_progreso` int(11) NOT NULL,
  `nombre_juego` varchar(30) NOT NULL,
  `id_juego` varchar(30) NOT NULL,
  `usuario` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `juegos_progreso`
--

INSERT INTO `juegos_progreso` (`id_progreso`, `nombre_juego`, `id_juego`, `usuario`) VALUES
(20, 'juego_ahorcado', '2', 'admin'),
(38, 'juego_ahorcado', '3', 'admin'),
(37, 'juego_vf', 'JG5ec37b75579e96.76166636', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos_vf`
--

CREATE TABLE `juegos_vf` (
  `id_juego_vf` varchar(30) NOT NULL,
  `titulo` varchar(30) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `juegos_vf`
--

INSERT INTO `juegos_vf` (`id_juego_vf`, `titulo`, `fecha`) VALUES
('JG5f7e9d875b9173.02825163', '1', '2020-10-08 00:02:00'),
('JG5f7e9ea117ffa5.48581830', '2', '2020-10-08 00:04:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugares`
--

CREATE TABLE `lugares` (
  `id_lugar` varchar(30) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `latitud` varchar(30) NOT NULL,
  `longitud` varchar(30) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lugares`
--

INSERT INTO `lugares` (`id_lugar`, `titulo`, `descripcion`, `latitud`, `longitud`, `fecha`) VALUES
('LU5f9a28e4ebfae1.64841956', '2', '2', '1.183481518497995', '-77.33503386881024', '2020-10-28 21:28:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id_modulo` varchar(30) NOT NULL,
  `id_curso` varchar(30) NOT NULL,
  `nombre_modulo` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id_modulo`, `id_curso`, `nombre_modulo`, `descripcion`, `fecha`) VALUES
('MD5f7949d6a94643.10748216', 'CU5f76750a6d3180.15302091', '', '', '2020-10-03 23:04:00'),
('MD5f965ca6033d06.60372998', 'CU5f76750a6d3180.15302091', '2', '2', '2020-10-26 00:20:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multimedia_actividades`
--

CREATE TABLE `multimedia_actividades` (
  `id_multimedia` int(11) NOT NULL,
  `id_actividad` varchar(30) NOT NULL,
  `url` text NOT NULL,
  `tipo` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `multimedia_actividades`
--

INSERT INTO `multimedia_actividades` (`id_multimedia`, `id_actividad`, `url`, `tipo`) VALUES
(56, 'AC5f794e1e8a46e5.24977885', 'http://localhost/plataforma/static/multimedia/cursos/CU5f76750a6d3180.15302091/MD5f7949d6a94643.10748216/AC5f794e1e8a46e5.24977885/100502476_135050848157521_7827829191201521664_o.jpg', 'image'),
(57, 'AC5f966009701840.86018165', 'http://localhost/plataforma/static/multimedia/cursos/CU5f76750a6d3180.15302091/MD5f965ca6033d06.60372998/AC5f966009701840.86018165/Foreign Key MYSQL.txt', 'txt');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multimedia_inicio`
--

CREATE TABLE `multimedia_inicio` (
  `id_multimedia` int(11) NOT NULL,
  `url` text NOT NULL,
  `tipo` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `multimedia_inicio`
--

INSERT INTO `multimedia_inicio` (`id_multimedia`, `url`, `tipo`) VALUES
(11, 'http://localhost/plataforma/static/multimedia/inicio/mingas_slider.png', ''),
(12, 'http://localhost/plataforma/static/multimedia/inicio/1.jpg', ''),
(19, 'http://localhost/plataforma/static/multimedia/inicio/2.jpg', ''),
(20, 'http://localhost/plataforma/static/multimedia/inicio/3.jpg', ''),
(21, 'http://localhost/plataforma/static/multimedia/inicio/4.jpg', ''),
(22, 'http://localhost/plataforma/static/multimedia/inicio/5.jpg', ''),
(23, 'http://localhost/plataforma/static/multimedia/inicio/6.jpg', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multimedia_lugares`
--

CREATE TABLE `multimedia_lugares` (
  `id_multimedia` int(11) NOT NULL,
  `id_lugar` varchar(30) NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `multimedia_lugares`
--

INSERT INTO `multimedia_lugares` (`id_multimedia`, `id_lugar`, `url`) VALUES
(10, 'LU5f9a28e4ebfae1.64841956', 'http://localhost/plataforma/static/multimedia/lugares/LU5f9a28e4ebfae1.64841956/Doc1(1).pdf'),
(11, 'LU5f9a28e4ebfae1.64841956', 'http://localhost/plataforma/static/multimedia/lugares/LU5f9a28e4ebfae1.64841956/30688757_441503232937459_4366952970810556416_n.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multimedia_productos`
--

CREATE TABLE `multimedia_productos` (
  `id_multimedia` int(11) NOT NULL,
  `id_producto` varchar(30) NOT NULL,
  `url` text NOT NULL,
  `tipo` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `multimedia_productos`
--

INSERT INTO `multimedia_productos` (`id_multimedia`, `id_producto`, `url`, `tipo`) VALUES
(9, 'PD5f0f72ddf17be7.16999227', 'http://localhost/plataforma/static/multimedia/productos/PD5f0f72ddf17be7.16999227/3 pieza educ.jpg', 'image'),
(21, 'PD5f8d2e1a958438.71362758', 'http://localhost/plataforma/static/multimedia/productos/PD5f8d2e1a958438.71362758/Doc1(1).pdf', 'pdf'),
(22, 'PD5f8d2e1a958438.71362758', 'http://localhost/plataforma/static/multimedia/productos/PD5f8d2e1a958438.71362758/tablet-314153_1280.png', 'image'),
(23, 'PD5f8d2e1a958438.71362758', 'http://localhost/plataforma/static/multimedia/productos/PD5f8d2e1a958438.71362758/mobile-devices-2017978_1280.png', 'image');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id_municpio` int(11) NOT NULL,
  `municipio` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id_municpio`, `municipio`) VALUES
(24, 'Albán'),
(11, 'Aldana'),
(50, 'Ancuya'),
(25, 'Arboleda'),
(1, 'Barbacoas'),
(26, 'Belén'),
(39, 'Buesaco'),
(40, 'Chachagüí'),
(27, 'Colón'),
(41, 'Consacá'),
(12, 'Contadero'),
(13, 'Córdoba'),
(14, 'Cuaspud'),
(15, 'Cumbal'),
(51, 'Cumbitara'),
(2, 'El Charco'),
(42, 'El Peñol'),
(28, 'El Rosario'),
(29, 'El Tablón de Gómez'),
(43, 'El Tambo'),
(3, 'Francisco Pizarro'),
(16, 'Funes'),
(17, 'Guachucal'),
(52, 'Guaitarilla'),
(18, 'Gualmatán'),
(19, 'Iles'),
(53, 'Imués'),
(20, 'Ipiales'),
(30, 'La Cruz'),
(44, 'La Florida'),
(54, 'La Llanada'),
(4, 'La Tola'),
(31, 'La Unión'),
(32, 'Leiva'),
(55, 'Linares'),
(56, 'Los Andes'),
(5, 'Magüí Payán'),
(57, 'Mallama'),
(6, 'Mosquera'),
(45, 'Nariño'),
(7, 'Olaya Herrera'),
(58, 'Ospina'),
(46, 'Pasto'),
(33, 'Policarpa'),
(21, 'Potosí'),
(59, 'Providencia'),
(22, 'Puerres'),
(23, 'Pupiales'),
(60, 'Ricaurte'),
(8, 'Roberto Payán'),
(61, 'Samaniego'),
(34, 'San Bernardo'),
(35, 'San Lorenzo'),
(36, 'San Pablo'),
(37, 'San Pedro de Cartago'),
(47, 'Sandoná'),
(9, 'Santa Bárbara'),
(62, 'Santacruz'),
(63, 'Sapuyes'),
(38, 'Taminango'),
(48, 'Tangua'),
(10, 'Tumaco'),
(64, 'Túquerres'),
(49, 'Yacuanquer');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id_notificacion` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `estado` varchar(1) NOT NULL,
  `tipo_notificacion` varchar(20) NOT NULL,
  `usuario` varchar(40) NOT NULL,
  `id_destino` varchar(40) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id_notificacion`, `descripcion`, `estado`, `tipo_notificacion`, `usuario`, `id_destino`, `fecha`) VALUES
(11, 'Se ha agregado un nuevo informe', 'D', 'informe', 'admin', 'PD5f93ab65e7f1b8.37465981', '2020-10-23 23:19:49'),
(12, 'Se ha registrado un nuevo archivo', 'D', 'informe', 'admin', 'PD5f965b9e637264.56984206', '2020-10-26 00:16:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas_examenes`
--

CREATE TABLE `preguntas_examenes` (
  `id_pregunta` int(11) NOT NULL,
  `id_actividad` varchar(30) NOT NULL,
  `pregunta` text NOT NULL,
  `respuesta` varchar(500) NOT NULL,
  `respuesta_incorrecta_a` varchar(500) NOT NULL,
  `respuesta_incorrecta_b` varchar(500) NOT NULL,
  `respuesta_incorrecta_c` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `preguntas_examenes`
--

INSERT INTO `preguntas_examenes` (`id_pregunta`, `id_actividad`, `pregunta`, `respuesta`, `respuesta_incorrecta_a`, `respuesta_incorrecta_b`, `respuesta_incorrecta_c`) VALUES
(11, 'AC5f96618c5d5021.95642307', '22', '213', '231', '223', '231');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas_juegos_vf`
--

CREATE TABLE `preguntas_juegos_vf` (
  `id_pregunta` int(11) NOT NULL,
  `id_juego_vf` varchar(30) NOT NULL,
  `pregunta` varchar(500) NOT NULL,
  `respuesta` varchar(10) NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `preguntas_juegos_vf`
--

INSERT INTO `preguntas_juegos_vf` (`id_pregunta`, `id_juego_vf`, `pregunta`, `respuesta`, `url`) VALUES
(30, 'JG5f7e9ea117ffa5.48581830', '2', 'Verdadero', 'http://localhost/plataforma/static/multimedia/juegos_vf/JG5f7e9ea117ffa5.48581830/100502476_135050848157521_7827829191201521664_o.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` varchar(30) NOT NULL,
  `categoria` varchar(60) NOT NULL,
  `tipo_producto` varchar(20) NOT NULL,
  `titulo` varchar(30) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `year` varchar(4) NOT NULL,
  `preview` text NOT NULL,
  `tipo_preview` varchar(9) NOT NULL,
  `fecha_pub` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `categoria`, `tipo_producto`, `titulo`, `descripcion`, `year`, `preview`, `tipo_preview`, `fecha_pub`) VALUES
('PD5f0f72ddf17be7.16999227', 'Salud Ambiental', 'Copla', 'Copla creada por Luis Muñoz', 'Esta es una copla creada por Luis Muñoz del Municipio de Arboleda', '2014', 'http://localhost/plataforma/static/multimedia/productos/PD5f0f72ddf17be7.16999227/3 pieza educ_preview.jpg', 'image', '2020-07-15 16:10:00'),
('PD5f8d2e1a958438.71362758', '', '', '', '', '', '', '', '2020-10-19 01:09:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `correo` varchar(60) NOT NULL,
  `nombres` varchar(80) NOT NULL,
  `tipo_id` varchar(30) NOT NULL,
  `identificacion` varchar(15) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `municipio` varchar(80) NOT NULL,
  `img_preview` text NOT NULL,
  `img_usuario` text NOT NULL,
  `usuario` varchar(40) NOT NULL,
  `password` mediumtext NOT NULL,
  `tipo_usuario` varchar(20) NOT NULL,
  `estado` varchar(1) NOT NULL,
  `codigo` varchar(30) NOT NULL,
  `fecha_codigo` datetime NOT NULL,
  `carpeta_usuario` varchar(30) NOT NULL,
  `estado_juego_vf` char(1) NOT NULL,
  `estado_juego_ahorcado` char(1) NOT NULL,
  `estado_juego_arrastrar` char(1) NOT NULL,
  `fecha_reg` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`correo`, `nombres`, `tipo_id`, `identificacion`, `telefono`, `municipio`, `img_preview`, `img_usuario`, `usuario`, `password`, `tipo_usuario`, `estado`, `codigo`, `fecha_codigo`, `carpeta_usuario`, `estado_juego_vf`, `estado_juego_ahorcado`, `estado_juego_arrastrar`, `fecha_reg`) VALUES
('admin@gmail.com', 'Jesus Alejandro', 'Cedula de ciudadania', '1086', '318', 'La Tola', 'http://localhost/plataforma/static/multimedia/usuarios/US5f14bb13498fe4.99108911/1_1.jpg', 'http://localhost/plataforma/static/multimedia/usuarios/US5f14bb13498fe4.99108911/1.jpg', 'admin', '$2y$10$oQluj/LK9.7jcdpwoFF2zuSPcUP9P.iNwPAsvpg4tRbDgVUrBs.4m', 'administrador', 'A', '', '0000-00-00 00:00:00', 'US5f14bb13498fe4.99108911', '', 'A', 'A', '2020-05-28 00:00:02'),
('generador1@gmail.com', 'Juan', '', '', '', 'Arboleda', 'http://localhost/plataforma/static/multimedia/usuarios/US5f14bb13498fe4.99108911/1_1.jpg', '', 'generador_arboleda', '$2y$10$TG4OWhpAJUWXGUgwuy7bK.u2UCW8yJRhs0xxIXqZyA4Vy0TPhxIKe', 'generador', 'A', '23qfvc1324123', '2020-06-03 17:37:23', '', '', '', '', '2020-06-03 17:37:23'),
('supervisor@gmail.com', 'Juan', '', '', '', 'arboleda', '', '', 'supervisor', '$2y$10$TG4OWhpAJUWXGUgwuy7bK.u2UCW8yJRhs0xxIXqZyA4Vy0TPhxIKe', 'supervisor', 'A', '23qfvc1324123', '2020-06-03 17:37:23', '', '', '', '', '2020-06-03 17:37:23');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id_actividad`),
  ADD KEY `id_modulo` (`id_modulo`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indices de la tabla `cursos_certificados`
--
ALTER TABLE `cursos_certificados`
  ADD PRIMARY KEY (`id_curso_certificado`),
  ADD KEY `id_curso` (`id_curso`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `cursos_codigos`
--
ALTER TABLE `cursos_codigos`
  ADD PRIMARY KEY (`id_cursos_codigos`),
  ADD KEY `id_curso` (`id_curso`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `cursos_comentarios`
--
ALTER TABLE `cursos_comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_curso` (`id_curso`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `cursos_completados`
--
ALTER TABLE `cursos_completados`
  ADD PRIMARY KEY (`id_curso_completado`),
  ADD KEY `id_curso` (`id_curso`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `cursos_examenes`
--
ALTER TABLE `cursos_examenes`
  ADD PRIMARY KEY (`id_curso_examen`),
  ADD KEY `id_actividad` (`id_actividad`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `cursos_progreso`
--
ALTER TABLE `cursos_progreso`
  ADD PRIMARY KEY (`id_progreso`),
  ADD UNIQUE KEY `id_actividad` (`id_actividad`,`usuario`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `id_curso` (`id_curso`),
  ADD KEY `id_modulo` (`id_modulo`);

--
-- Indices de la tabla `cursos_suscripciones`
--
ALTER TABLE `cursos_suscripciones`
  ADD PRIMARY KEY (`id_curso_suscripcion`),
  ADD KEY `id_curso` (`id_curso`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `debug`
--
ALTER TABLE `debug`
  ADD PRIMARY KEY (`id_debug`);

--
-- Indices de la tabla `informes`
--
ALTER TABLE `informes`
  ADD PRIMARY KEY (`id_informe`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `municipio` (`municipio`);

--
-- Indices de la tabla `juegos_ahorcado`
--
ALTER TABLE `juegos_ahorcado`
  ADD PRIMARY KEY (`id_juego`);

--
-- Indices de la tabla `juegos_arrastrar`
--
ALTER TABLE `juegos_arrastrar`
  ADD PRIMARY KEY (`id_juego`);

--
-- Indices de la tabla `juegos_progreso`
--
ALTER TABLE `juegos_progreso`
  ADD PRIMARY KEY (`id_progreso`),
  ADD UNIQUE KEY `nombre_juego` (`nombre_juego`,`id_juego`,`usuario`) USING BTREE,
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `juegos_vf`
--
ALTER TABLE `juegos_vf`
  ADD PRIMARY KEY (`id_juego_vf`);

--
-- Indices de la tabla `lugares`
--
ALTER TABLE `lugares`
  ADD PRIMARY KEY (`id_lugar`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id_modulo`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indices de la tabla `multimedia_actividades`
--
ALTER TABLE `multimedia_actividades`
  ADD PRIMARY KEY (`id_multimedia`),
  ADD KEY `id_actividad` (`id_actividad`);

--
-- Indices de la tabla `multimedia_inicio`
--
ALTER TABLE `multimedia_inicio`
  ADD PRIMARY KEY (`id_multimedia`);

--
-- Indices de la tabla `multimedia_lugares`
--
ALTER TABLE `multimedia_lugares`
  ADD PRIMARY KEY (`id_multimedia`),
  ADD KEY `id_lugar` (`id_lugar`);

--
-- Indices de la tabla `multimedia_productos`
--
ALTER TABLE `multimedia_productos`
  ADD PRIMARY KEY (`id_multimedia`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id_municpio`),
  ADD UNIQUE KEY `municipio` (`municipio`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id_notificacion`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `preguntas_examenes`
--
ALTER TABLE `preguntas_examenes`
  ADD PRIMARY KEY (`id_pregunta`),
  ADD KEY `id_actividad` (`id_actividad`);

--
-- Indices de la tabla `preguntas_juegos_vf`
--
ALTER TABLE `preguntas_juegos_vf`
  ADD PRIMARY KEY (`id_pregunta`),
  ADD KEY `id_juego_vf` (`id_juego_vf`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`correo`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos_codigos`
--
ALTER TABLE `cursos_codigos`
  MODIFY `id_cursos_codigos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cursos_comentarios`
--
ALTER TABLE `cursos_comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cursos_completados`
--
ALTER TABLE `cursos_completados`
  MODIFY `id_curso_completado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cursos_examenes`
--
ALTER TABLE `cursos_examenes`
  MODIFY `id_curso_examen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `cursos_progreso`
--
ALTER TABLE `cursos_progreso`
  MODIFY `id_progreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT de la tabla `cursos_suscripciones`
--
ALTER TABLE `cursos_suscripciones`
  MODIFY `id_curso_suscripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `debug`
--
ALTER TABLE `debug`
  MODIFY `id_debug` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `juegos_ahorcado`
--
ALTER TABLE `juegos_ahorcado`
  MODIFY `id_juego` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `juegos_arrastrar`
--
ALTER TABLE `juegos_arrastrar`
  MODIFY `id_juego` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `juegos_progreso`
--
ALTER TABLE `juegos_progreso`
  MODIFY `id_progreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `multimedia_actividades`
--
ALTER TABLE `multimedia_actividades`
  MODIFY `id_multimedia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `multimedia_inicio`
--
ALTER TABLE `multimedia_inicio`
  MODIFY `id_multimedia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `multimedia_lugares`
--
ALTER TABLE `multimedia_lugares`
  MODIFY `id_multimedia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `multimedia_productos`
--
ALTER TABLE `multimedia_productos`
  MODIFY `id_multimedia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id_municpio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `preguntas_examenes`
--
ALTER TABLE `preguntas_examenes`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `preguntas_juegos_vf`
--
ALTER TABLE `preguntas_juegos_vf`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `actividades_ibfk_1` FOREIGN KEY (`id_modulo`) REFERENCES `modulos` (`id_modulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cursos_codigos`
--
ALTER TABLE `cursos_codigos`
  ADD CONSTRAINT `cursos_codigos_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cursos_codigos_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cursos_comentarios`
--
ALTER TABLE `cursos_comentarios`
  ADD CONSTRAINT `cursos_comentarios_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cursos_comentarios_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cursos_completados`
--
ALTER TABLE `cursos_completados`
  ADD CONSTRAINT `cursos_completados_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cursos_completados_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cursos_examenes`
--
ALTER TABLE `cursos_examenes`
  ADD CONSTRAINT `cursos_examenes_ibfk_1` FOREIGN KEY (`id_actividad`) REFERENCES `actividades` (`id_actividad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cursos_examenes_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cursos_progreso`
--
ALTER TABLE `cursos_progreso`
  ADD CONSTRAINT `cursos_progreso_ibfk_1` FOREIGN KEY (`id_actividad`) REFERENCES `actividades` (`id_actividad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cursos_progreso_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cursos_progreso_ibfk_3` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cursos_progreso_ibfk_4` FOREIGN KEY (`id_modulo`) REFERENCES `modulos` (`id_modulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cursos_suscripciones`
--
ALTER TABLE `cursos_suscripciones`
  ADD CONSTRAINT `cursos_suscripciones_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cursos_suscripciones_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `informes`
--
ALTER TABLE `informes`
  ADD CONSTRAINT `informes_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `juegos_progreso`
--
ALTER TABLE `juegos_progreso`
  ADD CONSTRAINT `juegos_progreso_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD CONSTRAINT `modulos_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `multimedia_actividades`
--
ALTER TABLE `multimedia_actividades`
  ADD CONSTRAINT `multimedia_actividades_ibfk_1` FOREIGN KEY (`id_actividad`) REFERENCES `actividades` (`id_actividad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `multimedia_lugares`
--
ALTER TABLE `multimedia_lugares`
  ADD CONSTRAINT `multimedia_lugares_ibfk_1` FOREIGN KEY (`id_lugar`) REFERENCES `lugares` (`id_lugar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `multimedia_productos`
--
ALTER TABLE `multimedia_productos`
  ADD CONSTRAINT `multimedia_productos_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `preguntas_examenes`
--
ALTER TABLE `preguntas_examenes`
  ADD CONSTRAINT `preguntas_examenes_ibfk_1` FOREIGN KEY (`id_actividad`) REFERENCES `actividades` (`id_actividad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `preguntas_juegos_vf`
--
ALTER TABLE `preguntas_juegos_vf`
  ADD CONSTRAINT `preguntas_juegos_vf_ibfk_1` FOREIGN KEY (`id_juego_vf`) REFERENCES `juegos_vf` (`id_juego_vf`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
