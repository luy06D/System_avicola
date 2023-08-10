/*
SQLyog Community v12.5.1 (64 bit)
MySQL - 10.4.28-MariaDB : Database - avicola
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`avicola` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `avicola`;

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `detalle_ventas` */

insert  into `detalle_ventas`(`iddetalle_venta`,`idproducto`,`cantidad`) values 
(1,1,50),
(2,1,20),
(3,1,2),
(4,1,10),
(5,1,22),
(6,1,13),
(7,1,2),
(9,1,3),
(10,1,4),
(11,1,2),
(12,1,3),
(13,1,3),
(14,1,2),
(15,1,2);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `personas` */

insert  into `personas`(`idpersona`,`nombres`,`apellidos`,`dni`,`telefono`,`estado`) values 
(1,'Luis David','Cusi Gonzales','73196921','934651825','1'),
(2,'Juan Moises','Gonzales Salazar',NULL,NULL,'1'),
(3,'Lidia Leonor','Cusi Gonzales',NULL,NULL,'0'),
(4,'Ana Cecilia','Cabrera','76548762','948243565','1'),
(5,'Ana Maria','Gallardo Yañez',NULL,NULL,'1'),
(6,'Jean','Mateo',NULL,NULL,'1');

/*Table structure for table `productos` */

DROP TABLE IF EXISTS `productos`;

CREATE TABLE `productos` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `cantidad` smallint(6) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idproducto`),
  CONSTRAINT `ck_can_pro` CHECK (`cantidad` > 0)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `productos` */

insert  into `productos`(`idproducto`,`nombre`,`descripcion`,`cantidad`,`estado`) values 
(1,'Huevos','',1200,'1'),
(2,'prueba','qaweq',10,'0'),
(3,'prueba2','dsre',12,'0'),
(4,'Prueba 3|','sfdgw',12,'0'),
(5,'Huevo','',1000,'0'),
(6,'Huevos','vende tamal ',12,'0'),
(7,'Huevo','',1200,'0');

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `idpersona` int(11) NOT NULL,
  `nombreusuario` varchar(40) NOT NULL,
  `claveacceso` varchar(100) NOT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `uk_nom_usu` (`nombreusuario`),
  KEY `fk_idp_usu` (`idpersona`),
  CONSTRAINT `fk_idp_usu` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`idpersona`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `usuarios` */

insert  into `usuarios`(`idusuario`,`idpersona`,`nombreusuario`,`claveacceso`) values 
(1,1,'Luy06','$2y$10$TqZrHRzf9bIuWuhLD.2TleRPnDqBlok2gXu48legU63EnQfl6v4yq'),
(2,5,'Ana1','$2y$10$yZ9/cx9sMUGeawaC19D2k.dbqePr0.ibCTbQyeQOXaHduHyKTULuK'),
(3,6,'Jeann','$2y$10$DkmV9dF7mWSvmcf72HSv.u0BMxyzcpbFOLzcJnBPF04CMfcxgPv0S');

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
  `fechaventa` date NOT NULL DEFAULT current_timestamp(),
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idventa`),
  KEY `fk_idd_ven` (`iddetalle_venta`),
  KEY `fk_idu_ven` (`idusuario`),
  KEY `fk_idc_ven` (`idcliente`),
  CONSTRAINT `fk_idc_ven` FOREIGN KEY (`idcliente`) REFERENCES `personas` (`idpersona`),
  CONSTRAINT `fk_idd_ven` FOREIGN KEY (`iddetalle_venta`) REFERENCES `detalle_ventas` (`iddetalle_venta`),
  CONSTRAINT `fk_idu_ven` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`),
  CONSTRAINT `ck_pre_ven` CHECK (`precio` > 0),
  CONSTRAINT `ck_kil_ven` CHECK (`kilos` > 0)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `ventas` */

insert  into `ventas`(`idventa`,`iddetalle_venta`,`idusuario`,`idcliente`,`kilos`,`precio`,`flete`,`fechaventa`,`estado`) values 
(1,1,1,2,200,12.00,0.0,'2023-08-03','1'),
(2,2,1,2,120,10.00,0.0,'2023-08-03','1'),
(3,3,1,2,24,10.00,0.0,'2023-08-03','1'),
(4,4,1,2,200,12.00,0.0,'2023-08-03','1'),
(5,5,1,2,200,12.00,0.0,'2023-08-03','1'),
(6,6,1,2,123,12.00,0.2,'2023-08-03','1'),
(7,7,1,2,26,10.00,0.3,'2023-08-03','1'),
(8,9,1,2,36,10.00,0.2,'2023-08-03','1'),
(9,10,1,2,78,10.00,0.2,'2023-08-03','1'),
(10,11,1,2,46,10.00,0.2,'2023-08-03','1'),
(11,12,1,3,39,10.00,0.2,'2023-08-04','1'),
(12,13,1,3,78,10.00,0.2,'2023-08-06','1'),
(13,14,1,3,35,10.00,0.2,'2023-08-07','1'),
(14,15,1,4,14,10.00,0.2,'2023-08-10','1');

/* Procedure structure for procedure `spu_clientes_recuperar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_clientes_recuperar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_clientes_recuperar`()
BEGIN
	SELECT idpersona , concat(nombres,' ', apellidos) as clientes
	FROM  personas;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_cliente_delete` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_cliente_delete` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_cliente_delete`(
	IN _idpersona INT
)
BEGIN
	UPDATE personas SET estado = '0'
	WHERE idpersona = _idpersona;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_cliente_list` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_cliente_list` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_cliente_list`()
BEGIN
SELECT
	personas.`idpersona`,
	personas.`nombres`,
	personas.`apellidos`,
	personas.`dni`,
	personas.`telefono`

FROM personas
	WHERE personas.estado = '1'
	ORDER BY idpersona DESC;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_cliente_obtener` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_cliente_obtener` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_cliente_obtener`(
	IN _idpersona INT
)
BEGIN
	SELECT * FROM personas WHERE idpersona = _idpersona;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_cliente_register` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_cliente_register` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_cliente_register`(
	IN _nombres	VARCHAR(30),
	IN _apellidos 	VARCHAR(30),
	IN _dni	 	CHAR(8),
	IN _telefono	CHAR(9)
)
BEGIN
INSERT INTO personas (nombres, apellidos, dni, telefono) VALUES 
	(_nombres, _apellidos, _dni, _telefono);  
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_cliente_update` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_cliente_update` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_cliente_update`(
	IN _idpersona	INT,
	IN _nombres	VARCHAR(30),
	IN _apellidos 	VARCHAR(30),
	IN _dni	 	CHAR(8),
	IN _telefono	CHAR(9)
)
BEGIN	
	UPDATE personas SET
		nombres	  = _nombres,
		apellidos = _apellidos,
		dni 	  = _dni,
		telefono  = _telefono

	WHERE idpersona = _idpersona;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_filtro1_ventas` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_filtro1_ventas` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_filtro1_ventas`(IN _idcliente INT)
BEGIN

	SELECT 	CONCAT(PE.nombres,' ', PE.apellidos) AS clientes,  
		VE.kilos, VE.precio, VE.flete, VE.fechaventa,
		(VE.kilos * VE.precio)-(kilos * flete) AS totalPago
	FROM ventas VE
	INNER JOIN personas PE ON PE.idpersona = VE.idcliente
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

	SELECT 	CONCAT(PE.nombres,' ', PE.apellidos) AS clientes,  
		VE.kilos, VE.precio, VE.flete, VE.fechaventa,
		(VE.kilos * VE.precio)-(kilos * flete) AS totalPago
	FROM ventas VE
	INNER JOIN personas PE ON PE.idpersona = VE.idcliente
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

	SELECT 	CONCAT(PE.nombres,' ', PE.apellidos) AS clientes,  
		VE.kilos, VE.precio, VE.flete, VE.fechaventa,
		(VE.kilos * VE.precio)-(kilos * flete) AS totalPago
	FROM ventas VE
	INNER JOIN personas PE ON PE.idpersona = VE.idcliente
	WHERE VE.fechaventa BETWEEN _fechainicio AND _fechafin AND VE.idcliente = _idcliente;
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_productos_recuperar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_productos_recuperar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_productos_recuperar`()
BEGIN
	SELECT idproducto , nombre
	FROM  productos
	where estado = 1;
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
	productos.`descripcion`,
	productos.`cantidad`

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
	IN _descripcion VARCHAR(100),
	IN _cantidad 	SMALLINT
)
BEGIN
INSERT INTO productos (nombre, descripcion, cantidad) VALUES 
	(_producto, _descripcion, _cantidad);  
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_producto_update` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_producto_update` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_producto_update`(
	IN _idproducto		INT,
	IN _producto		VARCHAR(30),
	IN _descripcion 	VARCHAR(100),
	IN _cantidad		SMALLINT
)
BEGIN	
	UPDATE productos SET
		nombre 		= _producto,
		descripcion	= _descripcion,
		cantidad 	= _cantidad

	WHERE idproducto = _idproducto;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_resume_ventas` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_resume_ventas` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_resume_ventas`()
BEGIN
 SELECT COUNT(*) AS Ventas, MONTHNAME(fechaventa) AS MONTH, SUM(ventas.kilos) AS Kilos_Vendidos2
 FROM ventas
 WHERE fechaventa >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
 ORDER BY fechaventa;
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
in _kilos	smallint,
in _precio	decimal(4,2),
in _flete	decimal(2,1)
)
BEGIN 
	DECLARE g_iddetalle INT;
	
	INSERT INTO detalle_ventas (idproducto, cantidad) VALUES
				(_idproducto, _cantidad);
	
	SELECT LAST_INSERT_ID() INTO g_iddetalle;
	
	
	INSERT INTO ventas (iddetalle_venta, idusuario, idcliente, kilos, precio, flete)VALUES
		(g_iddetalle, _idusuario, _idcliente, _kilos , _precio , _flete);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_ventas_resume` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_ventas_resume` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_ventas_resume`()
BEGIN
SELECT LEFT(DAYNAME(fechaventa),10 ) AS Dia, COUNT(ventas.idventa)AS Ventas_Diarias, SUM(ventas.kilos) AS Kilos_Vendidos
FROM ventas
INNER JOIN detalle_ventas ON detalle_ventas.iddetalle_venta = ventas.iddetalle_venta
WHERE fechaventa >= DATE_SUB(NOW(), INTERVAL 7 DAY)
GROUP BY fechaventa
ORDER BY fechaventa;
 END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
