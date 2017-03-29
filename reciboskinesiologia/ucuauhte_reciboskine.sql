-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 10-05-2016 a las 22:36:10
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

--
-- Base de datos: `ucuauhte_reciboskine`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `stored_getPrecio` (IN `txtPaciente` INT(6), IN `txtTerapia` INT(6))  BEGIN
		SELECT costo
		FROM tc_precio_terapiayservicio
		WHERE 	idTipoPaciente = txtPaciente AND idTerapia = txtTerapia;
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `stored_getRecibosDeDia` (IN `txtFechaRegistro` DATE)  BEGIN
		SELECT idRecibo, nombrePaciente, fecharegistro, fecha_prox_sesion,alumno,hora_prox_sesion
		FROM tr_recibos
		WHERE fecharegistro = txtFechaRegistro
		ORDER BY idRecibo DESC;
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `stored_getTiposDe` (IN `txtTablaConsuta` INT(6))  BEGIN
    	CASE txtTablaConsuta
			WHEN 1 THEN
            	SELECT idTipoPaciente AS id,tipoPaciente AS tipo FROM  tc_tipopaciente ;
            WHEN 2 THEN
            	SELECT idTerapia AS id, nombreTerapia AS tipo FROM  tc_terapiayservicios ;
       	END CASE;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `stored_insRecibo` (IN `txtNombrePaciente` VARCHAR(150), IN `txtFechaRegistro` DATE, IN `txtDomicilio` VARCHAR(150), IN `txtTelefono` VARCHAR(13), IN `txtFechaProxSesion` DATE, IN `txtHoraProxSesion` TIME, IN `txtNoVista` INT, IN `txtIdTipoPaciente` INT, IN `txtTerapias` VARCHAR(10), IN `txtCostototal` INT, IN `txtAlumno` VARCHAR(150))  BEGIN
		INSERT INTO tr_recibos
		VALUES(
			null
			,txtNombrePaciente
			,txtFechaRegistro 
			,txtDomicilio 
			,txtTelefono
			,txtFechaProxSesion 
			,txtHoraProxSesion
            ,txtAlumno
			,txtNoVista 
			,txtIdTipoPaciente 
			,txtTerapias
			,txtCostototal
		);
	END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tc_kinesiologo`
--

CREATE TABLE `tc_kinesiologo` (
  `idKinesiologo` int(11) NOT NULL,
  `matricula` varchar(12) NOT NULL,
  `nombreKinesio` varchar(60) NOT NULL,
  `apellidoKinesio` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tc_precio_terapiayservicio`
--

CREATE TABLE `tc_precio_terapiayservicio` (
  `idprecio_terapiayservicio` int(11) NOT NULL,
  `idTipoPaciente` int(11) NOT NULL,
  `idTerapia` int(11) NOT NULL,
  `costo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tc_precio_terapiayservicio`
--

INSERT INTO `tc_precio_terapiayservicio` (`idprecio_terapiayservicio`, `idTipoPaciente`, `idTerapia`, `costo`) VALUES
(1, 1, 5, 120),
(2, 2, 5, 95),
(3, 4, 5, 70),
(4, 3, 5, 40),
(5, 1, 6, 100),
(6, 2, 6, 80),
(7, 4, 6, 60),
(8, 3, 6, 40),
(9, 1, 3, 90),
(10, 2, 3, 90),
(11, 3, 3, 90),
(12, 4, 3, 90),
(13, 1, 2, 90),
(14, 2, 2, 90),
(15, 3, 2, 90),
(16, 4, 2, 90),
(17, 1, 1, 100),
(18, 2, 1, 100),
(19, 3, 1, 100),
(20, 4, 1, 100),
(21, 1, 4, 50),
(22, 2, 4, 50),
(23, 3, 4, 50),
(24, 4, 4, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tc_terapiayservicios`
--

CREATE TABLE `tc_terapiayservicios` (
  `idTerapia` int(11) NOT NULL,
  `nombreTerapia` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tc_terapiayservicios`
--

INSERT INTO `tc_terapiayservicios` (`idTerapia`, `nombreTerapia`) VALUES
(1, 'Baropodometria'),
(2, 'Puncion Seca'),
(3, 'MEP'),
(4, 'Nutrici&oacute;n'),
(5, 'Valoracion'),
(6, 'Terapia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tc_tipopaciente`
--

CREATE TABLE `tc_tipopaciente` (
  `idTipoPaciente` int(11) NOT NULL,
  `tipoPaciente` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tc_tipopaciente`
--

INSERT INTO `tc_tipopaciente` (`idTipoPaciente`, `tipoPaciente`) VALUES
(1, 'General'),
(2, 'Catedratico/Alumno'),
(3, 'Deportista'),
(4, 'Administrativo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tc_usuarios`
--

CREATE TABLE `tc_usuarios` (
  `idUsuario` int(11) NOT NULL,
  `userName` varchar(60) NOT NULL,
  `nombreCompleto` varchar(60) NOT NULL,
  `pass` varchar(1000) NOT NULL,
  `rol` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tr_recibos`
--

CREATE TABLE `tr_recibos` (
  `idRecibo` int(11) NOT NULL,
  `nombrePaciente` varchar(150) NOT NULL,
  `fecharegistro` date NOT NULL,
  `domicilio` varchar(150) NOT NULL,
  `telefono` varchar(13) NOT NULL,
  `fecha_prox_sesion` date NOT NULL,
  `hora_prox_sesion` time NOT NULL,
  `alumno` varchar(150) NOT NULL,
  `no_visita` int(11) NOT NULL,
  `idTipoPaciente` int(11) NOT NULL,
  `terapias` varchar(10) NOT NULL,
  `costototal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tr_recibos`
--

INSERT INTO `tr_recibos` (`idRecibo`, `nombrePaciente`, `fecharegistro`, `domicilio`, `telefono`, `fecha_prox_sesion`, `hora_prox_sesion`, `alumno`, `no_visita`, `idTipoPaciente`, `terapias`, `costototal`) VALUES
(1, 'Sarai Teresa Guadarrama VillicaÃ±a', '2016-05-10', 'Antonio Nava #111', '4492048354', '2016-05-24', '17:48:00', 'Juvath', 4, 1, '3|6', 190),
(2, 'Eduardo Garcia', '2016-05-10', 'Antonio Nava #111', '4492048354', '2016-05-30', '19:48:00', 'Gustavo Witte', 4, 1, '3|6', 190),
(3, 'Natalia Garza Contreras', '2016-05-10', 'Su casa #154', '4491897765', '2016-05-24', '09:45:00', 'Nathaly Escobar', 4, 4, '1|6', 160),
(4, 'Gabriela DurÃ¡n', '2016-05-10', 'Teocaltiche #96 Canteras de San JosÃ©', '1464354', '2016-05-27', '17:35:00', 'Juvath', 1, 1, '5|6', 220);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tc_kinesiologo`
--
ALTER TABLE `tc_kinesiologo`
  ADD PRIMARY KEY (`idKinesiologo`);

--
-- Indices de la tabla `tc_precio_terapiayservicio`
--
ALTER TABLE `tc_precio_terapiayservicio`
  ADD PRIMARY KEY (`idprecio_terapiayservicio`);

--
-- Indices de la tabla `tc_terapiayservicios`
--
ALTER TABLE `tc_terapiayservicios`
  ADD PRIMARY KEY (`idTerapia`);

--
-- Indices de la tabla `tc_tipopaciente`
--
ALTER TABLE `tc_tipopaciente`
  ADD PRIMARY KEY (`idTipoPaciente`);

--
-- Indices de la tabla `tc_usuarios`
--
ALTER TABLE `tc_usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `tr_recibos`
--
ALTER TABLE `tr_recibos`
  ADD PRIMARY KEY (`idRecibo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tc_kinesiologo`
--
ALTER TABLE `tc_kinesiologo`
  MODIFY `idKinesiologo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tc_precio_terapiayservicio`
--
ALTER TABLE `tc_precio_terapiayservicio`
  MODIFY `idprecio_terapiayservicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `tc_terapiayservicios`
--
ALTER TABLE `tc_terapiayservicios`
  MODIFY `idTerapia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `tc_tipopaciente`
--
ALTER TABLE `tc_tipopaciente`
  MODIFY `idTipoPaciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `tc_usuarios`
--
ALTER TABLE `tc_usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tr_recibos`
--
ALTER TABLE `tr_recibos`
  MODIFY `idRecibo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
