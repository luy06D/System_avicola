/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.25-MariaDB : Database - avicola
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`avicola` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `avicola`;

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `idpersona` int(11) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idcliente`),
  UNIQUE KEY `uk_clien_cli` (`idpersona`),
  CONSTRAINT `fk_idper_cli` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`idpersona`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `clientes` */

insert  into `clientes`(`idcliente`,`idpersona`,`estado`) values 
(1,2,'1'),
(2,3,'1'),
(3,4,'1'),
(4,5,'1'),
(5,7,'1'),
(6,8,'1'),
(7,9,'1'),
(8,10,'1'),
(9,11,'0'),
(10,12,'0');

/*Table structure for table `detalle_entradas` */

DROP TABLE IF EXISTS `detalle_entradas`;

CREATE TABLE `detalle_entradas` (
  `identrada` int(11) NOT NULL AUTO_INCREMENT,
  `idinsumo` int(11) NOT NULL,
  `cantidad` smallint(6) NOT NULL,
  `precio` decimal(7,2) NOT NULL,
  `fecha_entrada` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`identrada`),
  KEY `fk_idi_ent` (`idinsumo`),
  CONSTRAINT `fk_idi_ent` FOREIGN KEY (`idinsumo`) REFERENCES `insumos` (`idinsumo`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

/*Data for the table `detalle_entradas` */

insert  into `detalle_entradas`(`identrada`,`idinsumo`,`cantidad`,`precio`,`fecha_entrada`) values 
(1,1,500,1500.00,'2023-08-28'),
(2,1,500,2000.00,'2023-08-28'),
(3,1,500,900.00,'2023-08-28'),
(4,1,900,600.00,'2023-08-28'),
(5,1,600,700.00,'2023-08-28'),
(6,1,500,600.00,'2023-08-28'),
(7,1,600,500.00,'2023-08-28'),
(8,1,900,500.00,'2023-08-28'),
(9,2,500,4800.00,'2023-08-28'),
(10,2,600,500.00,'2023-08-28'),
(11,2,700,1000.00,'2023-08-28'),
(12,4,500,120.00,'2023-08-28'),
(13,4,500,600.00,'2023-08-28'),
(14,5,1000,5000.00,'2023-08-28'),
(15,7,500,1000.00,'2023-08-28'),
(16,8,200,100.00,'2023-08-28'),
(17,9,200,100.00,'2023-08-28');

/*Table structure for table `detalle_insumos` */

DROP TABLE IF EXISTS `detalle_insumos`;

CREATE TABLE `detalle_insumos` (
  `iddetalle_insumo` int(11) NOT NULL AUTO_INCREMENT,
  `idformula` int(11) NOT NULL,
  `idinsumo` int(11) NOT NULL,
  `cantidad` smallint(6) NOT NULL,
  `unidad` varchar(20) NOT NULL,
  PRIMARY KEY (`iddetalle_insumo`),
  KEY `fk_idf_det` (`idformula`),
  KEY `fk_idi_det` (`idinsumo`),
  CONSTRAINT `fk_idf_det` FOREIGN KEY (`idformula`) REFERENCES `formulas` (`idformula`),
  CONSTRAINT `fk_idi_det` FOREIGN KEY (`idinsumo`) REFERENCES `insumos` (`idinsumo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `detalle_insumos` */

insert  into `detalle_insumos`(`iddetalle_insumo`,`idformula`,`idinsumo`,`cantidad`,`unidad`) values 
(1,2,1,100,'kg'),
(2,2,2,500,'kg'),
(3,3,2,550,'kg'),
(4,3,4,500,'kg'),
(5,3,1,1000,'kg'),
(6,4,7,200,'kg'),
(7,4,8,100,'kg'),
(8,4,9,200,'kg');

/*Table structure for table `detalle_ventas` */

DROP TABLE IF EXISTS `detalle_ventas`;

CREATE TABLE `detalle_ventas` (
  `iddetalle_venta` int(11) NOT NULL AUTO_INCREMENT,
  `idproducto` int(11) NOT NULL,
  `cantidad` smallint(6) NOT NULL,
  PRIMARY KEY (`iddetalle_venta`),
  KEY `fk_idp_det` (`idproducto`),
  CONSTRAINT `fk_idp_det` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`),
  CONSTRAINT `ck_can_det` CHECK (`cantidad` > 0)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

/*Data for the table `detalle_ventas` */

insert  into `detalle_ventas`(`iddetalle_venta`,`idproducto`,`cantidad`) values 
(1,1,5),
(2,2,6),
(3,3,10),
(4,1,3),
(5,1,2),
(6,3,5),
(7,1,5),
(8,3,7),
(9,3,2),
(10,2,5),
(11,2,10),
(12,2,10),
(13,3,10),
(14,2,5),
(15,1,10),
(16,2,5),
(17,3,10),
(18,1,10),
(19,1,5),
(20,1,10),
(21,3,15),
(22,2,10),
(23,2,86),
(24,2,10),
(25,1,5),
(26,3,3),
(27,1,5),
(28,3,6),
(29,1,6);

/*Table structure for table `formulas` */

DROP TABLE IF EXISTS `formulas`;

CREATE TABLE `formulas` (
  `idformula` int(11) NOT NULL AUTO_INCREMENT,
  `nombreformula` varchar(40) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idformula`),
  UNIQUE KEY `uk_nom_for` (`nombreformula`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `formulas` */

insert  into `formulas`(`idformula`,`nombreformula`,`estado`) values 
(1,'formula','1'),
(2,'ENGORDE','0'),
(3,'formula1','0'),
(4,'tr','1');

/*Table structure for table `insumos` */

DROP TABLE IF EXISTS `insumos`;

CREATE TABLE `insumos` (
  `idinsumo` int(11) NOT NULL AUTO_INCREMENT,
  `insumo` varchar(30) NOT NULL,
  `unidad` varchar(20) DEFAULT NULL,
  `cantidad` smallint(6) DEFAULT NULL,
  `descripcion` varchar(80) DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idinsumo`),
  UNIQUE KEY `uk_ins_ins` (`insumo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `insumos` */

insert  into `insumos`(`idinsumo`,`insumo`,`unidad`,`cantidad`,`descripcion`,`estado`) values 
(1,'SOYA','Seleccione',3900,'de calidad','0'),
(2,'Maiz Nacional','Seleccione',750,'calidad','0'),
(4,'Maiz','Seleccione',500,'asdd','0'),
(5,'insumoa','Seleccione',1000,'123','0'),
(7,'TRIGO','Seleccione',300,'Nacional','1'),
(8,'re','Seleccione',100,'cs','0'),
(9,'peru','Seleccione',0,'asdf','0');

/*Table structure for table `pagos` */

DROP TABLE IF EXISTS `pagos`;

CREATE TABLE `pagos` (
  `idpago` int(11) NOT NULL AUTO_INCREMENT,
  `idventa` int(11) NOT NULL,
  `fechapago` date NOT NULL DEFAULT current_timestamp(),
  `banco` varchar(30) NOT NULL,
  `numoperacion` int(11) NOT NULL,
  `pago` decimal(7,2) NOT NULL,
  `estado` varchar(30) NOT NULL,
  PRIMARY KEY (`idpago`),
  UNIQUE KEY `uk_num_pa` (`numoperacion`),
  KEY `fk_idv_pa` (`idventa`),
  CONSTRAINT `fk_idv_pa` FOREIGN KEY (`idventa`) REFERENCES `ventas` (`idventa`),
  CONSTRAINT `ck_pa_pa` CHECK (`pago` > 0)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pagos` */

insert  into `pagos`(`idpago`,`idventa`,`fechapago`,`banco`,`numoperacion`,`pago`,`estado`) values 
(1,1,'2023-08-28','BCP',556677,1000.00,''),
(2,1,'2023-08-28','BCP',12345678,300.00,''),
(4,3,'2023-08-28','SCOTIABANK',53365225,664.50,''),
(5,1,'2023-08-28','BCP',78523694,96.50,'');

/*Table structure for table `personas` */

DROP TABLE IF EXISTS `personas`;

CREATE TABLE `personas` (
  `idpersona` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `dni` char(8) DEFAULT NULL,
  `telefono` char(9) DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idpersona`),
  UNIQUE KEY `uk_dni_per` (`dni`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

/*Data for the table `personas` */

insert  into `personas`(`idpersona`,`nombres`,`apellidos`,`dni`,`telefono`,`estado`) values 
(1,'Jean','Mateo',NULL,NULL,'1'),
(2,'Luis','Ramirez','78451296','963258741','1'),
(3,'Fermando','Porres','21546985','953687422','1'),
(4,'Rocio','Feijo','21596387','965478122','1'),
(5,'Renato','Fuentes','21896355','953684266','1'),
(7,'Roberto ','Ramirez','24569871','936544855','1'),
(8,'Hugo','Magallanes','25369874','956847213','1'),
(9,'Nora','Napa','54966338','963235523','1'),
(10,'Keyla','Yauca','21639696','963255456','1'),
(11,'Clientes','Nuevos','78562316','953623366','1'),
(12,'Pier','Quispe','21569837','953684217','1');

/*Table structure for table `productos` */

DROP TABLE IF EXISTS `productos`;

CREATE TABLE `productos` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idproducto`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `productos` */

insert  into `productos`(`idproducto`,`nombre`,`descripcion`,`estado`) values 
(1,'Huevos Pardos','','1'),
(2,'Huevos Rosados','','1'),
(3,'Huevos Yumbo','','1');

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `idpersona` int(11) NOT NULL,
  `nombreusuario` varchar(40) NOT NULL,
  `claveacceso` varchar(100) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `uk_nom_usu` (`nombreusuario`),
  KEY `fk_idp_usu` (`idpersona`),
  CONSTRAINT `fk_idp_usu` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`idpersona`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `usuarios` */

insert  into `usuarios`(`idusuario`,`idpersona`,`nombreusuario`,`claveacceso`,`estado`) values 
(1,1,'jean','$2y$10$nPtSi9cUGXfJ6MdDGhGJresLGzZNo4nHXcmDepRZeQ5R/BDHNjMiK','1');

/*Table structure for table `ventas` */

DROP TABLE IF EXISTS `ventas`;

CREATE TABLE `ventas` (
  `idventa` int(11) NOT NULL AUTO_INCREMENT,
  `iddetalle_venta` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `kilos` smallint(6) NOT NULL,
  `precio` decimal(4,2) NOT NULL,
  `flete` decimal(2,1) DEFAULT NULL,
  `deuda` decimal(7,2) NOT NULL,
  `fechaventa` date NOT NULL DEFAULT current_timestamp(),
  `estado` char(1) NOT NULL DEFAULT '1',
  `paquetes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`paquetes`)),
  PRIMARY KEY (`idventa`),
  KEY `fk_idd_ven` (`iddetalle_venta`),
  KEY `fk_idu_ven` (`idusuario`),
  KEY `fk_idc_ven` (`idcliente`),
  CONSTRAINT `fk_idc_ven` FOREIGN KEY (`idcliente`) REFERENCES `clientes` (`idcliente`),
  CONSTRAINT `fk_idd_ven` FOREIGN KEY (`iddetalle_venta`) REFERENCES `detalle_ventas` (`iddetalle_venta`),
  CONSTRAINT `fk_idu_ven` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`),
  CONSTRAINT `ck_pre_ven` CHECK (`precio` > 0),
  CONSTRAINT `ck_kil_ven` CHECK (`kilos` > 0)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `ventas` */

insert  into `ventas`(`idventa`,`iddetalle_venta`,`idusuario`,`idcliente`,`kilos`,`precio`,`flete`,`deuda`,`fechaventa`,`estado`,`paquetes`) values 
(1,27,1,1,75,9.30,1.3,691.00,'2023-08-28','1','{\"Paquete 1\":\"15\",\"Paquete 2\":\"15\",\"Paquete 3\":\"15\",\"Paquete 4\":\"15\",\"Paquete 5\":\"15\"}'),
(2,28,1,1,85,8.30,0.0,705.50,'2023-08-28','1','{\"Paquete 1\":\"14\",\"Paquete 2\":\"14\",\"Paquete 3\":\"14\",\"Paquete 4\":\"14\",\"Paquete 5\":\"14\",\"Paquete 6\":\"15\"}'),
(3,29,1,2,81,8.30,1.3,664.50,'2023-08-28','1','{\"Paquete 1\":\"15\",\"Paquete 2\":\"15\",\"Paquete 3\":\"12\",\"Paquete 4\":\"13\",\"Paquete 5\":\"12\",\"Paquete 6\":\"14\"}');

/* Procedure structure for procedure `spu_clientes_recuperar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_clientes_recuperar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_clientes_recuperar`()
BEGIN
	SELECT idcliente , CONCAT(nombres,' ', apellidos) AS clientes
	FROM  clientes
	INNER JOIN personas ON personas.`idpersona` = clientes.`idpersona`
	WHERE clientes.`estado` = 1;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_cliente_delete` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_cliente_delete` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_cliente_delete`(
	IN _idcliente INT
)
BEGIN
	UPDATE clientes SET estado = '0'
	WHERE idcliente = _idcliente;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_cliente_list` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_cliente_list` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_cliente_list`()
BEGIN
SELECT
	clientes.`idcliente`,
	personas.`nombres`,
	personas.`apellidos`,
	personas.`dni`,
	personas.`telefono`

FROM clientes
	INNER JOIN personas ON personas.`idpersona` = clientes.`idpersona`
	WHERE clientes.`estado`= '1'
	ORDER BY idcliente DESC;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_cliente_obtener` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_cliente_obtener` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_cliente_obtener`(
	IN _idcliente INT
)
BEGIN
	SELECT personas.`idpersona`,
		personas.`nombres`,
		personas.`apellidos`,
		personas.`dni`,
		personas.`telefono`
	FROM clientes 
		INNER JOIN personas ON personas.`idpersona` = clientes.`idpersona`
	WHERE idcliente = _idcliente AND
		clientes.`estado`= '1';
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_cliente_register` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_cliente_register` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_cliente_register`(

IN _nombres 	VARCHAR(30),
IN _apellidos 	VARCHAR(30),
IN _dni		CHAR(8),
IN _telefono 	CHAR(9)
)
BEGIN 
	DECLARE g_idcliente INT;
	
	
	IF _telefono = '' THEN SET _telefono = NULL;	
	END IF;
	
	IF _dni = '' THEN SET _dni = NULL;
	END IF;
		
	
	INSERT INTO personas (nombres, apellidos, dni, telefono) VALUES 
			(_nombres, _apellidos, _dni, _telefono);
	
	SELECT LAST_INSERT_ID() INTO g_idcliente;
	
	INSERT INTO clientes (idpersona) VALUES
			(g_idcliente);	

END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_cliente_update` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_cliente_update` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_cliente_update`(
	IN _idcliente	INT,
	IN _nombres	VARCHAR(30),
	IN _apellidos 	VARCHAR(30),
	IN _dni	 	CHAR(8),
	IN _telefono	CHAR(9)
)
BEGIN	
	UPDATE clientes 
		JOIN personas ON clientes.`idpersona` = personas.`idpersona`
		SET
			nombres	  = _nombres,
			apellidos = _apellidos,
			dni 	  = _dni,
			telefono  = _telefono

	WHERE idcliente = _idcliente;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_delete_insumo` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_delete_insumo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_delete_insumo`(
	IN _idinsumo INT
)
BEGIN
	UPDATE insumos SET estado = '0'
	WHERE idinsumo = _idinsumo;
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_detalleInsumo_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_detalleInsumo_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_detalleInsumo_registrar`(
IN _idformula INT,
IN _idinsumo INT,
IN _cantidad DECIMAL(10, 3),
IN _unidad VARCHAR(20)
)
BEGIN
  DECLARE insumo_cantidad DECIMAL(10, 3);
  SET @conversion_factor = 1;
  
  IF _unidad = 'TN' THEN
    SET @conversion_factor = 1000;
  END IF;

  -- Iniciar la transacción
  START TRANSACTION;

  -- Obtener la cantidad actual del insumo
  SELECT cantidad INTO insumo_cantidad FROM insumos WHERE idinsumo = _idinsumo;

  -- Verificar si hay suficiente cantidad disponible en insumos
  IF insumo_cantidad >= (_cantidad * @conversion_factor) THEN
    -- Si hay suficiente cantidad disponible, actualizar la cantidad en insumos
    SET insumo_cantidad = insumo_cantidad - (_cantidad * @conversion_factor);
    UPDATE insumos SET cantidad = insumo_cantidad WHERE idinsumo = _idinsumo;
    
    -- Intentar actualizar la cantidad en detalle_insumos
    UPDATE detalle_insumos
    SET cantidad = cantidad + (_cantidad * @conversion_factor)
    WHERE idinsumo = _idinsumo AND idformula = _idformula;

    -- Verificar si se actualizó alguna fila en detalle_insumos
    IF ROW_COUNT() = 0 THEN
      -- No se actualizó ninguna fila en detalle_insumos, agregar un nuevo registro
      INSERT INTO detalle_insumos (idformula, idinsumo, cantidad, unidad) VALUES (_idformula, _idinsumo, (_cantidad * @conversion_factor), 'kg');
    END IF;
  ELSE
    -- No hay suficiente cantidad disponible en insumos, hacer rollback y generar una señal de error
    ROLLBACK;
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No hay suficiente cantidad de este insumo para la fórmula.';
  END IF;

  -- Confirmar la transacción
  COMMIT;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_detalleInsumo_update` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_detalleInsumo_update` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_detalleInsumo_update`(
IN _iddetalle_insumo	INT,
IN _idinsumo 	INT,
IN _cantidad	SMALLINT,
IN _unidad	VARCHAR(20)
)
BEGIN 
	UPDATE detalle_insumos SET
	idinsumo = _idinsumo,
	cantidad = _cantidad,
	unidad = _unidad
	WHERE iddetalle_insumo = _iddetalle_insumo; 
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_filtro1_ventas` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_filtro1_ventas` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_filtro1_ventas`(IN _idcliente INT)
BEGIN

	SELECT 	VE.idventa, CONCAT(cl.nombres,' ', cl.apellidos) AS clientes,  
		VE.kilos, DV.cantidad, VE.paquetes, VE.precio, VE.flete, VE.fechaventa,
		(VE.kilos * VE.precio)-(DV.cantidad * flete) AS totalPago
	FROM ventas VE
	INNER JOIN clientes  ON clientes.`idcliente` = VE.idcliente
	INNER JOIN personas cl ON cl.idpersona = clientes.`idpersona`
	INNER JOIN detalle_ventas DV ON DV.iddetalle_venta = VE.iddetalle_venta
	WHERE VE.idcliente = _idcliente;
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_filtro2_ventas` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_filtro2_ventas` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_filtro2_ventas`(
IN _fechainicio DATE,
IN _fechafin	DATE
)
BEGIN

	SELECT 	VE.idventa,
		CONCAT(CL.nombres,' ',CL.apellidos) AS clientes,
		VE.kilos, DV.cantidad, VE.paquetes, VE.precio, VE.flete, VE.fechaventa,
		(VE.kilos * VE.precio)-(DV.cantidad * flete) AS totalPago
	FROM ventas VE
	INNER JOIN clientes ON clientes.`idcliente` = VE.`idcliente`
	LEFT JOIN personas CL ON CL.idpersona = clientes.`idpersona`
	INNER JOIN detalle_ventas DV ON DV.iddetalle_venta = VE.iddetalle_venta
	WHERE VE.fechaventa BETWEEN _fechainicio AND _fechafin;
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_filtro3_ventas` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_filtro3_ventas` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_filtro3_ventas`(
IN _fechainicio DATE,
IN _fechafin	DATE,
IN _idcliente	INT
)
BEGIN

	SELECT 	VE.idventa, CONCAT(cl.nombres,' ', cl.apellidos) AS clientes,  
		VE.kilos, DV.cantidad, VE.paquetes, VE.precio, VE.flete, VE.fechaventa,
		(VE.kilos * VE.precio)-(DV.cantidad * flete) AS totalPago
	FROM ventas VE
	INNER JOIN clientes ON clientes.`idcliente` = VE.`idcliente`
	INNER JOIN personas cl ON cl.idpersona = clientes.`idpersona`
	INNER JOIN detalle_ventas DV ON DV.iddetalle_venta = VE.iddetalle_venta
	WHERE VE.fechaventa BETWEEN _fechainicio AND _fechafin AND VE.idcliente = _idcliente;
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_filtro_ClienteFecha` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_filtro_ClienteFecha` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_filtro_ClienteFecha`(
    IN _fechainicio DATE,
    IN _fechafin DATE
)
BEGIN
    SELECT 
        c.idcliente,
        p.fechapago,
        CONCAT(cl.nombres, ' ', cl.apellidos) AS cliente,
        (SELECT SUM(v.deuda) FROM ventas v WHERE v.idcliente = c.idcliente) AS deuda_total,
        SUM(p.pago) AS pago_total,
        ((SELECT SUM(v.deuda) FROM ventas v WHERE v.idcliente = c.idcliente) - SUM(p.pago)) AS saldo,
        CASE 
            WHEN ((SELECT SUM(v.deuda) FROM ventas v WHERE v.idcliente = c.idcliente) - SUM(p.pago)) = 0 THEN 'Cancelado'
            ELSE 'Pendiente'
        END AS estado
    FROM pagos p
    INNER JOIN ventas v ON v.idventa = p.idventa
    INNER JOIN clientes c ON v.idcliente = c.idcliente
    INNER JOIN personas cl ON c.idpersona = cl.idpersona
    WHERE DATE(p.fechapago) BETWEEN _fechainicio AND _fechafin
    GROUP BY c.idcliente, cl.nombres, cl.apellidos
    ORDER BY c.idcliente, p.fechapago DESC;    
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_filtro_clientePago` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_filtro_clientePago` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_filtro_clientePago`(
    IN _idcliente INT
)
BEGIN
    SELECT p.idpago,
	   c.idcliente,
	   CONCAT(cl.nombres, ' ', cl.apellidos) AS cliente,
           p.fechapago,
           pr.nombre AS producto,
           (SELECT SUM(v.deuda) FROM ventas v WHERE v.idcliente = c.idcliente) AS deuda_total,
           SUM(p.pago) AS pago_total, ((SELECT SUM(v.deuda) FROM ventas v WHERE v.idcliente = c.idcliente) - SUM(p.pago)) AS saldo,
           CASE 
               WHEN ((SELECT SUM(v.deuda) FROM ventas v WHERE v.idcliente = c.idcliente) - SUM(p.pago)) = 0 THEN 'Cancelado'
               ELSE 'Pendiente'
           END AS estado
    FROM pagos p
    INNER JOIN ventas v ON v.idventa = p.idventa
    INNER JOIN detalle_ventas dv ON v.iddetalle_venta = dv.iddetalle_venta
    INNER JOIN productos pr ON dv.idproducto = pr.idproducto
    INNER JOIN clientes c ON v.idcliente = c.idcliente
    INNER JOIN personas cl ON c.idpersona = cl.idpersona
    WHERE c.idcliente = _idcliente
    ORDER BY p.fechapago DESC;	
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_filtro_pagoclientefecha` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_filtro_pagoclientefecha` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_filtro_pagoclientefecha`(
    IN _fechainicio DATE,
    IN _fechafin DATE,
    IN _idcliente INT
)
BEGIN
    SELECT 
        idpago,
        c.idcliente,
        CONCAT(cl.nombres, ' ', cl.apellidos) AS cliente,
        p.fechapago,
        pr.nombre AS producto,
        (SELECT SUM(v.deuda) FROM ventas v WHERE v.idcliente = c.idcliente) AS deuda_total,
        SUM(p.pago) AS pago_total,
        ((SELECT SUM(v.deuda) FROM ventas v WHERE v.idcliente = c.idcliente) - SUM(p.pago)) AS saldo,
        CASE 
            WHEN ((SELECT SUM(v.deuda) FROM ventas v WHERE v.idcliente = c.idcliente) - SUM(p.pago)) = 0 THEN 'Cancelado'
            ELSE 'Pendiente'
        END AS estado
    FROM pagos p
    INNER JOIN ventas v ON v.idventa = p.idventa
    INNER JOIN detalle_ventas dv ON v.iddetalle_venta = dv.iddetalle_venta
    INNER JOIN productos pr ON dv.idproducto = pr.idproducto
    INNER JOIN clientes c ON v.idcliente = c.idcliente
    INNER JOIN personas cl ON c.idpersona = cl.idpersona
    WHERE DATE(p.fechapago) BETWEEN _fechainicio AND _fechafin AND c.idcliente = _idcliente
    GROUP BY Cliente, producto
    ORDER BY idpago DESC;    
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_formulaDelete` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_formulaDelete` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_formulaDelete`(IN _idformula INT)
BEGIN 
	UPDATE formulas SET 
	estado = 0
	WHERE idformula = _idformula;
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_formula_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_formula_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_formula_registrar`(
IN _nombreformula VARCHAR(40)
)
BEGIN 

	INSERT INTO formulas (nombreformula) VALUES
			(_nombreformula);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_getdetalleI` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_getdetalleI` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_getdetalleI`(IN _iddetalle_insumo INT)
BEGIN 
	SELECT idinsumo, unidad, cantidad
	FROM  detalle_insumos
	WHERE iddetalle_insumo = _iddetalle_insumo;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_getFormula` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_getFormula` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_getFormula`()
BEGIN 
	SELECT idformula, nombreformula
	FROM formulas
	WHERE estado = 1;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_getInsumo` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_getInsumo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_getInsumo`()
BEGIN 
	SELECT idinsumo, insumo
	FROM insumos
	ORDER BY idinsumo;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_get_insumo` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_get_insumo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_get_insumo`(IN _idinsumo INT)
BEGIN
	SELECT	insumo, unidad , cantidad, descripcion
	FROM insumos
	WHERE idinsumo = _idinsumo;

END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_insumos_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_insumos_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_insumos_listar`()
BEGIN 
    SELECT
        idinsumo,
        insumo,
        CASE
            WHEN cantidad >= 1000 THEN FORMAT(cantidad / 1000, 2) 
            ELSE FORMAT(cantidad, 2) 
        END AS cantidad,
        CASE
            WHEN cantidad >= 1000 THEN 'TN' 
            ELSE 'KG' 
        END AS unidad,
        descripcion
    FROM insumos
    WHERE estado = '1'
    ORDER BY idinsumo DESC;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_insumos_register` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_insumos_register` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_insumos_register`(
IN _insumo VARCHAR(30),
IN _unidad VARCHAR(20),
IN _cantidad	SMALLINT,
IN _descripcion	VARCHAR(80)
)
BEGIN
	IF _descripcion = '' THEN SET _descripcion = NULL;	
	END IF;
	
	INSERT INTO insumos (insumo, unidad, cantidad, descripcion) VALUES
		(_insumo, _unidad, _cantidad, _descripcion);

END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_insumos_update` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_insumos_update` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_insumos_update`(
IN _idinsumo INT,
IN _insumo VARCHAR(30),
IN _unidad VARCHAR(20),
IN _cantidad	SMALLINT,
IN _descripcion	VARCHAR(80)
)
BEGIN
	IF _descripcion = '' THEN SET _descripcion = NULL;	
	END IF;
	
	UPDATE insumos SET 
	insumo	= _insumo,
	unidad = _unidad,
	cantidad = _cantidad,
	descripcion = _descripcion
	WHERE idinsumo = _idinsumo;

END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_listar_detalleF` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_listar_detalleF` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_listar_detalleF`(IN _idformula INT)
BEGIN 
	SELECT  iddetalle_insumo,
	I.insumo, 
	DI.cantidad,
	(Di.cantidad * 0.05) AS gkgU
	FROM detalle_insumos DI
	INNER JOIN  formulas F ON F.idformula = DI.idformula
	INNER JOIN insumos I ON I.idinsumo = DI.idinsumo
	WHERE F.idformula = _idformula;
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_listar_detallesclientes` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_listar_detallesclientes` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_listar_detallesclientes`(
	IN _idcliente INT
)
BEGIN
	SELECT 	c.idcliente,CONCAT(cl.nombres, ' ', cl.apellidos) AS Cliente,
		pa.fechapago,
		pr.nombre,
		pa.banco,
		pa.numoperacion,
		pa.pago
	FROM pagos pa
	    INNER JOIN ventas v ON v.idventa = pa.idventa
	    INNER JOIN detalle_ventas dv ON v.iddetalle_venta = dv.iddetalle_venta
	    INNER JOIN productos pr ON dv.idproducto = pr.idproducto
	    INNER JOIN clientes c ON v.idcliente = c.idcliente
	    INNER JOIN personas cl ON c.idpersona = cl.idpersona
	    WHERE c.idcliente = _idcliente;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_listar_pago` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_listar_pago` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_listar_pago`()
BEGIN	
    SELECT v.idventa,CONCAT(cl.nombres, ' ', cl.apellidos) AS Cliente,
           p.fechapago,
           pr.nombre,
           (SELECT SUM(v.deuda) FROM ventas v WHERE v.idcliente = c.idcliente) AS deuda_total,
           SUM(p.pago) AS pago_total, ((SELECT SUM(v.deuda) FROM ventas v WHERE v.idcliente = c.idcliente) - SUM(p.pago)) AS saldo,
           CASE 
    WHEN ((SELECT SUM(v.deuda) FROM ventas v WHERE v.idcliente = c.idcliente) - COALESCE(SUM(p.pago), 0)) <= 0 THEN 'Cancelado'
    ELSE 'Pendiente'
END AS estado
    FROM pagos p
    INNER JOIN ventas v ON v.idventa = p.idventa
    INNER JOIN detalle_ventas dv ON v.iddetalle_venta = dv.iddetalle_venta
    INNER JOIN productos pr ON dv.idproducto = pr.idproducto
    INNER JOIN clientes c ON v.idcliente = c.idcliente
    INNER JOIN personas cl ON c.idpersona = cl.idpersona
    ORDER BY p.fechapago DESC;	
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_mostrar_insumos` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_mostrar_insumos` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_mostrar_insumos`()
begin
	select idinsumo,
		insumo,
		unidad,
		cantidad
	from insumos
	WHERE estado = '1'
	ORDER BY idinsumo DESC;
end */$$
DELIMITER ;

/* Procedure structure for procedure `spu_obtener_detalleV` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_obtener_detalleV` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_obtener_detalleV`(IN _idventa INT)
BEGIN 

    SELECT CONCAT(PE.nombres,' ',PE.apellidos) AS clientes,
        PRO.nombre, DV.cantidad, VE.paquetes, VE.kilos,
        VE.precio, VE.flete,(VE.kilos * VE.precio) AS monto,
        (VE.kilos * VE.precio)-(DV.cantidad * VE.flete) AS totalPago,
        VE.fechaventa
    FROM ventas VE
    INNER JOIN clientes CLI ON CLI.idcliente = VE.idcliente
    INNER JOIN personas PE ON PE.idpersona = CLI.idpersona
    INNER JOIN detalle_ventas DV ON DV.iddetalle_venta = VE.iddetalle_venta
    INNER JOIN productos PRO ON PRO.idproducto = DV.idproducto
    WHERE VE.idventa = _idventa;

END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_obtener_paquetes` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_obtener_paquetes` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_obtener_paquetes`(IN _idventa INT )
BEGIN
	SELECT paquetes FROM ventas WHERE idventa = _idventa;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_obtener_ultimaV` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_obtener_ultimaV` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_obtener_ultimaV`()
BEGIN
	    DECLARE last_sale_id INT;

    SELECT MAX(idventa) INTO last_sale_id FROM ventas;

    SELECT CONCAT(PE.nombres,' ',PE.apellidos) AS clientes,
        PRO.nombre, DV.cantidad, VE.paquetes, VE.kilos,
        VE.precio, VE.flete,(VE.kilos * VE.precio) AS monto,
        (VE.kilos * VE.precio)-(DV.cantidad * VE.flete) AS totalPago,
        VE.fechaventa
    FROM ventas VE
    INNER JOIN clientes CLI ON CLI.idcliente = VE.idcliente
    INNER JOIN personas PE ON PE.idpersona = CLI.idpersona
    INNER JOIN detalle_ventas DV ON DV.iddetalle_venta = VE.iddetalle_venta
    INNER JOIN productos PRO ON PRO.idproducto = DV.idproducto
    WHERE VE.idventa = last_sale_id;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_pagos_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_pagos_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_pagos_listar`()
BEGIN
SELECT idpago, CONCAT(personas.nombres, ' ', personas.apellidos) AS Cliente, fechapago, banco, numoperacion, ventas.deuda, pago, ventas.deuda - SUM(pago) AS saldo
FROM pagos
INNER JOIN ventas ON ventas.idventa = pagos.idventa
INNER JOIN clientes ON clientes.idcliente = ventas.idcliente
INNER JOIN personas ON personas.idpersona = clientes.idpersona;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_pagos_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_pagos_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_pagos_registrar`(
IN _idventa INT ,
IN _banco VARCHAR(30),
IN _numoperacion INT,
IN _pago DECIMAL(7,2)
)
BEGIN
	
	INSERT INTO pagos (idventa, banco, numoperacion, pago)VALUES
	(_idventa, _banco, _numoperacion, _pago);
	
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_productos_recuperar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_productos_recuperar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_productos_recuperar`()
BEGIN
	SELECT idproducto , nombre
	FROM  productos
	WHERE estado = 1;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_producto_delete` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_producto_delete` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_producto_delete`(
	IN _idproducto INT
)
BEGIN
	UPDATE productos SET estado = '0'
	WHERE idproducto = _idproducto;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_producto_list` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_producto_list` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_producto_list`()
BEGIN
SELECT
	productos.`idproducto`,
	productos.`nombre`,
	productos.`descripcion`

FROM productos
	WHERE productos.estado = '1'
	ORDER BY idproducto DESC;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_producto_obtener` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_producto_obtener` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_producto_obtener`(
	IN _idproducto INT
)
BEGIN
	SELECT * FROM productos WHERE idproducto = _idproducto;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_producto_register` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_producto_register` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_producto_register`(
	IN _producto	VARCHAR(30),
	IN _descripcion VARCHAR(100)
)
BEGIN
INSERT INTO productos (nombre, descripcion) VALUES 
	(_producto, _descripcion);  
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_producto_update` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_producto_update` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_producto_update`(
	IN _idproducto		INT,
	IN _producto		VARCHAR(30),
	IN _descripcion 	VARCHAR(100)
)
BEGIN	
	UPDATE productos SET
		nombre 		= _producto,
		descripcion	= _descripcion

	WHERE idproducto = _idproducto;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_resume_ventas` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_resume_ventas` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_resume_ventas`()
BEGIN
 SELECT 
 COUNT(*) AS Ventas, MONTHNAME(fechaventa) AS MONTH, SUM(ventas.kilos) AS Kilos_Vendidos2
 FROM ventas
 WHERE fechaventa >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
 ORDER BY fechaventa;
 END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_user_delete` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_user_delete` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_user_delete`(
	IN _idusuario INT
)
BEGIN
	UPDATE usuarios SET estado = '0'
	WHERE idusuario = _idusuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_user_list` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_user_list` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_user_list`()
BEGIN
	SELECT 	idusuario,
		PE.nombres,
		PE.apellidos,
		PE.dni,
		PE.telefono,
		nombreusuario,
		claveacceso
		FROM usuarios
		INNER JOIN personas PE ON PE.idpersona = usuarios.`idpersona`

		WHERE usuarios.estado = '1'
		ORDER BY idusuario DESC;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_user_login` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_user_login` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_user_login`(IN _nombreusuario VARCHAR(40))
BEGIN 

	SELECT 	usuarios.idusuario, 
		personas.apellidos, personas.nombres,
		usuarios.nombreusuario, usuarios.claveacceso

	FROM usuarios
	INNER JOIN personas ON personas.idpersona = usuarios.idpersona
	WHERE nombreusuario = _nombreusuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_user_obtener` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_user_obtener` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_user_obtener`(
	IN _idusuario INT
)
BEGIN
	SELECT personas.`idpersona`,
		personas.`nombres`,
		personas.`apellidos`,
		personas.`dni`,
		personas.`telefono`,
		usuarios.`nombreusuario`,
		usuarios.`claveacceso`
	FROM usuarios 
		INNER JOIN personas ON personas.`idpersona` = usuarios.`idpersona`
	WHERE idusuario = _idusuario AND
		usuarios.`estado`= '1';
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_user_update` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_user_update` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_user_update`(
	IN _idusuario	INT,
	IN _nombres	VARCHAR(30),
	IN _apellidos 	VARCHAR(30),
	IN _dni	 	CHAR(8),
	IN _telefono	CHAR(9),
	IN _nombreusuario VARCHAR(40),
	IN _claveacceso	  VARCHAR(100)
)
BEGIN	
	UPDATE usuarios 
		JOIN personas ON usuarios.`idpersona` = personas.`idpersona`
		SET
			nombres	  = _nombres,
			apellidos = _apellidos,
			dni 	  = _dni,
			telefono  = _telefono,
			nombreusuario = _nombreusuario,
			claveacceso = _claveacceso

	WHERE idusuario = _idusuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_usuario_registar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_usuario_registar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuario_registar`(

IN _nombres 	VARCHAR(30),
IN _apellidos 	VARCHAR(30),
IN _dni		CHAR(8),
IN _telefono 	CHAR(9),
IN _nombreusuario VARCHAR(40),
IN _claveacceso	  VARCHAR(100)

)
BEGIN 
	DECLARE g_idpersona INT;
	
	
	IF _telefono = '' THEN SET _telefono = NULL;	
	END IF;
	
	IF _dni = '' THEN SET _dni = NULL;
	END IF;
		
	
	INSERT INTO personas (nombres, apellidos, dni, telefono) VALUES 
			(_nombres, _apellidos, _dni, _telefono);
	
	SELECT LAST_INSERT_ID() INTO g_idpersona;
	
	INSERT INTO usuarios (idpersona , nombreusuario, claveacceso) VALUES
			(g_idpersona, _nombreusuario, _claveacceso);	

END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_ventas_register` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_ventas_register` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_ventas_register`(
IN _idproducto	INT,
IN _cantidad 	SMALLINT,
IN _idusuario 	INT,
IN _idcliente 	INT,
IN _kilos	SMALLINT,
IN _precio	DECIMAL(4,2),
IN _flete	DECIMAL(2,1),
IN _deuda	DECIMAL(7,2),
IN _paquetes 	JSON 
)
BEGIN 
	DECLARE g_iddetalle INT;
	
	INSERT INTO detalle_ventas (idproducto, cantidad) VALUES
				(_idproducto, _cantidad);
	
	SELECT LAST_INSERT_ID() INTO g_iddetalle;
	
	
	INSERT INTO ventas (iddetalle_venta, idusuario, idcliente, kilos, precio, flete, deuda,  paquetes)VALUES
		(g_iddetalle, _idusuario, _idcliente, _kilos , _precio , _flete, _deuda, _paquetes);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_ventas_resume` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_ventas_resume` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_ventas_resume`()
BEGIN
    SELECT 
        CASE 
            WHEN DAYNAME(fechaventa) = 'Monday' THEN 'Lunes'
            WHEN DAYNAME(fechaventa) = 'Tuesday' THEN 'Martes'
            WHEN DAYNAME(fechaventa) = 'Wednesday' THEN 'Miércoles'
            WHEN DAYNAME(fechaventa) = 'Thursday' THEN 'Jueves'
            WHEN DAYNAME(fechaventa) = 'Friday' THEN 'Viernes'
            WHEN DAYNAME(fechaventa) = 'Saturday' THEN 'Sábado'
            WHEN DAYNAME(fechaventa) = 'Sunday' THEN 'Domingo'
        END AS Dia,
        COUNT(ventas.idventa) AS Ventas_Diarias,
        SUM(ventas.kilos) AS Kilos_Vendidos
    FROM ventas
    INNER JOIN detalle_ventas ON detalle_ventas.iddetalle_venta = ventas.iddetalle_venta
    WHERE fechaventa >= DATE_SUB(NOW(), INTERVAL 7 DAY)
    GROUP BY fechaventa
    ORDER BY fechaventa;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_registrar_entrada` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_registrar_entrada` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_registrar_entrada`(
    IN p_idinsumo INT,
    IN p_cantidad SMALLINT,
    IN _precio DECIMAL(7,2)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Error durante la operación.';
    END;

    START TRANSACTION;

    -- Registrar el detalle de entrada
    INSERT INTO detalle_entradas (idinsumo, cantidad, precio)
    VALUES (p_idinsumo, p_cantidad, _precio);

    -- Actualizar la cantidad en la tabla de insumos
    UPDATE insumos
    SET cantidad = cantidad + p_cantidad,
        unidad = CASE WHEN (cantidad + p_cantidad) > 1000 AND unidad = 'KG' THEN 'TN' ELSE unidad END
    WHERE idinsumo = p_idinsumo;

    COMMIT;

    SELECT 'Entrada registrada y stock actualizado correctamente' AS mensaje;
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
