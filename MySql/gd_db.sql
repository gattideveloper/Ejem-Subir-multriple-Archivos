--
-- Base de datos: `gd_db`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `SP_Delete_documento`$$
CREATE PROCEDURE `SP_Delete_documento` (`data1` INT)   DELETE FROM `documento` WHERE `id_studies` = data1$$

DROP PROCEDURE IF EXISTS `SP_Delete_studies`$$
CREATE PROCEDURE `SP_Delete_studies` (`data1` INT)   DELETE FROM `studies` WHERE `id` = data1$$

DROP PROCEDURE IF EXISTS `SP_Get_destiny`$$
CREATE PROCEDURE `SP_Get_destiny` (`data1` INT)   SELECT * FROM `destiny` WHERE `id` = data1$$

DROP PROCEDURE IF EXISTS `SP_Get_documentoIdStu`$$
CREATE PROCEDURE `SP_Get_documentoIdStu` (`data1` INT)   SELECT * FROM `documento` WHERE `id_studies` = data1$$

DROP PROCEDURE IF EXISTS `SP_Get_patient`$$
CREATE PROCEDURE `SP_Get_patient` (`data1` INT)   SELECT * FROM `patient` WHERE `id` = data1$$

DROP PROCEDURE IF EXISTS `SP_Get_studieData`$$
CREATE PROCEDURE `SP_Get_studieData` (`data1` INT, `data2` INT, `data3` INT)   SELECT * FROM `studies` WHERE `id` = data3 AND `id_patient` = data1 AND `id_destiny` = data2$$

DROP PROCEDURE IF EXISTS `SP_Get_studieDestino`$$
CREATE PROCEDURE `SP_Get_studieDestino` (`data1` INT)   SELECT * FROM `studies` WHERE `id_destiny` = data1$$

DROP PROCEDURE IF EXISTS `SP_Get_studies`$$
CREATE PROCEDURE `SP_Get_studies` (`data1` INT, `data2` DATE, `data3` INT)   SELECT * FROM `studies` WHERE `id_patient` = data1 AND `date` = data2 AND `id_destiny` = data3$$

DROP PROCEDURE IF EXISTS `SP_Get_studiesId_Paci`$$
CREATE PROCEDURE `SP_Get_studiesId_Paci` (`data1` INT)   SELECT DISTINCT `id_destiny` FROM `studies` WHERE `id_patient` = data1$$

DROP PROCEDURE IF EXISTS `SP_Put_documento`$$
CREATE PROCEDURE `SP_Put_documento` (`data1` INT, `data2` VARCHAR(250))   INSERT INTO `documento`(`id`, `id_studies`, `archivo`) VALUES (null, data1, data2)$$

DROP PROCEDURE IF EXISTS `SP_Put_studies`$$
CREATE PROCEDURE `SP_Put_studies` (`data1` INT, `data2` DATE, `data3` INT)   INSERT INTO `studies`(`id`, `id_patient`, `date`, `id_destiny`) VALUES (null, data1, data2, data3)$$

DROP PROCEDURE IF EXISTS `SP_Run_Destiny`$$
CREATE PROCEDURE `SP_Run_Destiny` ()   SELECT * FROM `destiny`$$

DROP PROCEDURE IF EXISTS `SP_Run_Paciente`$$
CREATE PROCEDURE `SP_Run_Paciente` ()   SELECT * FROM `patient`$$

DROP PROCEDURE IF EXISTS `SP_Run_Simplistudies`$$
CREATE PROCEDURE `SP_Run_Simplistudies` ()   SELECT DISTINCT `id_patient` FROM `studies`$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destiny`
--

DROP TABLE IF EXISTS `destiny`;
CREATE TABLE IF NOT EXISTS `destiny` (
  `id` int NOT NULL AUTO_INCREMENT,
  `destiny` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_destiny` (`destiny`)
) ENGINE=InnoDB;

--
-- Volcado de datos para la tabla `destiny`
--

INSERT INTO `destiny` (`id`, `destiny`) VALUES
(2, 'Casa'),
(3, 'Departamento'),
(1, 'Local');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

DROP TABLE IF EXISTS `documento`;
CREATE TABLE IF NOT EXISTS `documento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_studies` int NOT NULL,
  `archivo` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `dni` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_dni` (`dni`)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `studies`
--

DROP TABLE IF EXISTS `studies`;
CREATE TABLE IF NOT EXISTS `studies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_patient` int NOT NULL,
  `date` date NOT NULL,
  `id_destiny` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_studies_patient` (`id_patient`),
  KEY `fk_studies_destiny` (`id_destiny`)
) ENGINE=InnoDB;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `studies`
--
ALTER TABLE `studies`
  ADD CONSTRAINT `fk_studies_destiny` FOREIGN KEY (`id_destiny`) REFERENCES `destiny` (`id`),
  ADD CONSTRAINT `fk_studies_patient` FOREIGN KEY (`id_patient`) REFERENCES `patient` (`id`);
COMMIT;