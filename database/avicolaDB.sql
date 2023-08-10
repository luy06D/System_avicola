
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

INSERT INTO personas (nombres, apellidos) VALUES
		('Juan Moises','Gonzales Salazar');
INSERT INTO personas (nombres, apellidos) VALUES
		('Lidia Leonor','Cusi Gonzales');

-- Actualizando restriccion not null (dni)
ALTER TABLE personas MODIFY COLUMN dni CHAR(8) NULL;
ALTER TABLE personas ADD estado CHAR (1) NOT NULL DEFAULT '1';

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
estado		CHAR(1)		NOT NULL DEFAULT '1',
CONSTRAINT ck_can_pro CHECK (cantidad > 0 )
)
ENGINE = INNODB;

INSERT INTO productos (nombre, cantidad) VALUES 
		('Huevos', '1000');


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
iddetalle_venta	INT 		NOT NULL,
idusuario	INT 		NOT NULL,
idcliente	INT 		NOT NULL,
kilos		SMALLINT 	NOT NULL,
precio		DECIMAL(4,2) 	NOT NULL,
flete		TINYINT		NULL,
fechaventa	DATE		NOT NULL DEFAULT NOW(),
estado		CHAR(1)		NOT NULL DEFAULT '1',
CONSTRAINT fk_idd_ven FOREIGN KEY (iddetalle_venta) REFERENCES detalle_ventas (iddetalle_venta),
CONSTRAINT fk_idu_ven FOREIGN KEY (idusuario) REFERENCES usuarios (idusuario),
CONSTRAINT fk_idc_ven FOREIGN KEY (idcliente) REFERENCES personas (idpersona),
CONSTRAINT ck_pre_ven CHECK (precio > 0),
CONSTRAINT ck_kil_ven CHECK (kilos > 0)
)
ENGINE = INNODB;

-- Actualizando el tipo de dato (tinyint)
ALTER TABLE ventas MODIFY COLUMN flete DECIMAL(2,1) NULL;




			   /*Procedimientos*/

				/*LOGIN*/
				
		
DELIMITER$$ 
CREATE PROCEDURE spu_user_login(IN _nombreusuario VARCHAR(40))
BEGIN 

	SELECT 	usuarios.idusuario, 
		personas.apellidos, personas.nombres,
		usuarios.nombreusuario, usuarios.claveacceso

	FROM usuarios
	INNER JOIN personas ON personas.idpersona = usuarios.idpersona
	WHERE nombreusuario = _nombreusuario;
END$$




				/* REGISTRAR VENTA*/
		
DELIMITER $$
CREATE PROCEDURE spu_ventas_register
(
IN _idproducto	INT,
IN _cantidad 	SMALLINT,

IN _idusuario 	INT,
IN _idcliente 	INT,
IN _kilos	SMALLINT,
IN _precio	DECIMAL(4,2),
IN _flete	DECIMAL(2,1)
)	
BEGIN 
	DECLARE g_iddetalle INT;
	
	INSERT INTO detalle_ventas (idproducto, cantidad) VALUES
				(_idproducto, _cantidad);
	
	SELECT LAST_INSERT_ID() INTO g_iddetalle;
	
	
	INSERT INTO ventas (iddetalle_venta, idusuario, idcliente, kilos, precio, flete)VALUES
		(g_iddetalle, _idusuario, _idcliente, _kilos , _precio , _flete);
END$$

CALL spu_ventas_register (1, 13, 1, 2, 123, 12, 0.2 );

SELECT * FROM detalle_ventas;
SELECT * FROM ventas;

				-- RECUPERAR PRODUCTOS
DELIMITER $$ 
CREATE PROCEDURE spu_productos_recuperar()
BEGIN
	SELECT idproducto , nombre
	FROM  productos;
END $$

CALL spu_productos_recuperar()

				-- RECUPERAR CLIENTES			
DELIMITER $$ 
CREATE PROCEDURE spu_clientes_recuperar()
BEGIN
	SELECT idpersona , CONCAT(nombres,' ', apellidos) AS clientes
	FROM  personas;
END $$				

CALL spu_clientes_recuperar;



				/*LISTAR VENTAS*/

	

 
DELIMITER $$
 
 CREATE PROCEDURE spu_resume_ventas()
 BEGIN
 SELECT COUNT(*) AS Ventas, MONTHNAME(fechaventa) AS MONTH, SUM(ventas.kilos) AS Kilos_Vendidos2
 FROM ventas
 WHERE fechaventa >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
 ORDER BY fechaventa;
 END$$
 
 CALL spu_resume_ventas
	
			/*Grafico N2*/

DELIMITER$$			
CREATE PROCEDURE spu_ventas_resume()
BEGIN
SELECT LEFT(DAYNAME(fechaventa),10 ) AS Dia, COUNT(ventas.idventa)AS Ventas_Diarias, SUM(ventas.kilos) AS Kilos_Vendidos
FROM ventas
INNER JOIN detalle_ventas ON detalle_ventas.iddetalle_venta = ventas.iddetalle_venta
WHERE fechaventa >= DATE_SUB(NOW(), INTERVAL 7 DAY)
GROUP BY fechaventa
ORDER BY fechaventa;
 END $$
 
 
		
 
 DELIMITER $$
 CREATE PROCEDURE spu_ventas_listar()
 BEGIN
 SELECT idventa, CONCAT(personas.nombres, ' ',  personas.apellidos)AS Cliente, productos.nombre AS producto, detalle_ventas.cantidad, productos.precio * productos.cantidad AS total, ventas.fechaventa
 FROM ventas
 INNER JOIN personas ON personas.idpersona = ventas.idcliente
 INNER JOIN detalle_ventas ON detalle_ventas.iddetalle_venta = ventas.iddetalle_venta
 INNER JOIN productos ON detalle_ventas.idproducto = productos.idproducto;
 END $$
 
 

				
				
				
										
				
				-- REGISTRAR USUARIO 			
			
DELIMITER $$
CREATE PROCEDURE spu_usuario_registar 
(

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

END$$


CALL spu_usuario_registar('Luis David','Cusi Gonzales','','','Luy06','12345');


DELIMITER $$
CREATE PROCEDURE spu_filtro_ventas
(
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
	
END $$

CALL spu_filtro_ventas('2023-08-04','2023-08-06')





				-- SPU PRODUCTO	


DELIMITER $$ 
CREATE PROCEDURE spu_producto_list()
BEGIN
SELECT
	productos.`idproducto`,
	productos.`nombre`,
	productos.`descripcion`,
	productos.`cantidad`

FROM productos
	WHERE productos.estado = '1'
	ORDER BY idproducto DESC;
END $$

CALL spu_producto_list();
SELECT * FROM productos


DELIMITER $$
CREATE PROCEDURE spu_producto_register
(
	IN _producto	VARCHAR(30),
	IN _descripcion VARCHAR(100),
	IN _cantidad 	SMALLINT
)	
	
BEGIN
INSERT INTO productos (nombre, descripcion, cantidad) VALUES 
	(_producto, _descripcion, _cantidad);  
END $$

CALL spu_producto_register ('huevos doble','50g',70);


DELIMITER $$
CREATE PROCEDURE spu_producto_update
(
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
END $$

CALL spu_producto_update (3,'Huevos quiñados','60g',150);

DELIMITER $$
CREATE PROCEDURE spu_producto_obtener
(
	IN _idproducto INT
)
BEGIN
	SELECT * FROM productos WHERE idproducto = _idproducto;
END $$

DELIMITER $$
CREATE PROCEDURE spu_producto_delete
(
	IN _idproducto INT
)
BEGIN
	UPDATE productos SET estado = '0'
	WHERE idproducto = _idproducto;
END $$

CALL spu_producto_obtener(1);


					-- SPU CLIENTES


DELIMITER $$ 
CREATE PROCEDURE spu_cliente_list()
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
END $$

CALL spu_cliente_list();
SELECT * FROM personas

DELIMITER $$
CREATE PROCEDURE spu_cliente_register
(
	IN _nombres	VARCHAR(30),
	IN _apellidos 	VARCHAR(30),
	IN _dni	 	CHAR(8),
	IN _telefono	CHAR(9)
)	
	
BEGIN
INSERT INTO personas (nombres, apellidos, dni, telefono) VALUES 
	(_nombres, _apellidos, _dni, _telefono);  
END $$

CALL spu_cliente_register ('Nombre','Prueba',79461369,956847123);


DELIMITER $$
CREATE PROCEDURE spu_cliente_update
(
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
END $$


CALL spu_cliente_update (3,'Nombre','Pruebas',78451239,954683219);

DELIMITER $$
CREATE PROCEDURE spu_cliente_obtener
(
	IN _idpersona INT
)
BEGIN
	SELECT * FROM personas WHERE idpersona = _idpersona;
END $$

DELIMITER $$
CREATE PROCEDURE spu_cliente_delete
(
	IN _idpersona INT
)
BEGIN
	UPDATE personas SET estado = '0'
	WHERE idpersona = _idpersona;
END $$

CALL spu_cliente_obtener(1);

