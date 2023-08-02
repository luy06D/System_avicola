
CREATE DATABASE avicola;

USE avicola;


CREATE TABLE personas
(
idpersona	INT AUTO_INCREMENT PRIMARY KEY,
nombres		VARCHAR(30)	NOT NULL,
apellidos	VARCHAR(30)	NOT NULL,
dni		CHAR(8)		NOT NULL,
telefono	CHAR(9)		NULL,
CONSTRAINT uk_dni_per UNIQUE (dni)
)
ENGINE = INNODB;



CREATE TABLE usuarios
(
idusuario	INT AUTO_INCREMENT PRIMARY KEY,
idpersona	INT	NOT NULL,
nombreusuario	VARCHAR(40)	NOT NULL,
claveacceso	VARCHAR(100)	NOT NULL,
CONSTRAINT fk_idp_usu FOREIGN KEY (idpersona) REFERENCES personas (idpersona),
CONSTRAINT uk_nom_usu UNIQUE (nombreusuario)
)
ENGINE = INNODB;




CREATE TABLE productos
(
idproducto	INT AUTO_INCREMENT PRIMARY KEY,
nombre		VARCHAR(30)	NOT NULL,
descripcion	VARCHAR(100)	NULL,
cantidad	SMALLINT	NOT NULL,
precio		DECIMAL(5,2)	NOT NULL,
CONSTRAINT ck_can_pro CHECK (cantidad > 0 ),
CONSTRAINT ck_pre_pro CHECK (precio > 0)
)
ENGINE = INNODB;



CREATE TABLE detalle_ventas
(
iddetalle_venta		INT AUTO_INCREMENT PRIMARY KEY,
idproducto		INT 		NOT NULL,
cantidad		SMALLINT	NOT NULL,
CONSTRAINT fk_idp_det FOREIGN KEY (idproducto)	REFERENCES productos(idproducto),
CONSTRAINT ck_can_det CHECK (cantidad > 0 )
)
ENGINE = INNODB;




CREATE TABLE ventas
(
idventa		INT AUTO_INCREMENT PRIMARY KEY,
iddetalle_venta	INT NOT NULL,
idusuario	INT NOT NULL,
idcliente	INT NOT NULL,
fechaventa	DATE	NOT NULL DEFAULT NOW(),
estado		CHAR(1)		NOT NULL DEFAULT '1',
CONSTRAINT fk_idd_ven FOREIGN KEY (iddetalle_venta) REFERENCES detalle_ventas (iddetalle_venta),
CONSTRAINT fk_idu_ven FOREIGN KEY (idusuario) REFERENCES usuarios (idusuario),
CONSTRAINT fk_idc_ven FOREIGN KEY (idcliente) REFERENCES personas (idpersona)
)
ENGINE = INNODB;



			   /*Procedimientos*/

				/*LOGIN*/
DELIMITER$$ 
CREATE PROCEDURE spu_user_login(IN _nombreusuario VARCHAR(40))
BEGIN 
	SELECT personas.nombres, personas.apellidos, usuarios.nombreusuario, usuarios.claveacceso
	FROM usuarios
	INNER JOIN personas ON personas.idpersona = usuarios.idpersona
	WHERE nombreusuario = _nombreusuario;
END$$




				/* REGISTRAR VENTA*/
				
DELIMITER $$
CREATE PROCEDURE spu_ventas_register(
IN _iddetalle_venta INT ,
IN _idusuario INT,
IN _idcliente INT )	
BEGIN 
	INSERT INTO ventas (iddetalle_venta, idusuario, idcliente)VALUES
	(_iddetalle_venta, _idusuario, _idcliente);
END$$




				/*LISTAR VENTAS*/
	
DELIMITER$$			

CREATE PROCEDURE spu_ventas_resume()
SELECT LEFT (DAYNAME(fechaventa),1 ) AS Dia, SUM(detalle_ventas.cantidad)AS total
FROM ventas
INNER JOIN detalle_ventas ON detalle_ventas.iddetalle_venta = ventas.iddetalle_venta
WHERE fechaventa >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
GROUP BY fechaventa
ORDER BY fechaventa;
 END $$
 

 
 
 
 CREATE PROCEDURE spu_ventas_listar()
 SELECT idventa, CONCAT(personas.nombres, ' ',  personas.apellidos)AS Cliente, productos.nombre AS producto, detalle_ventas.cantidad, productos.precio * productos.cantidad AS total, ventas.fechaventa
 FROM ventas
 INNER JOIN personas ON personas.idpersona = ventas.idcliente
 INNER JOIN detalle_ventas ON detalle_ventas.iddetalle_venta = ventas.iddetalle_venta
 INNER JOIN productos ON detalle_ventas.idproducto = productos.idproducto;
 
