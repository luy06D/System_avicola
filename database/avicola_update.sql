
CREATE DATABASE avicola;

USE avicola;


CREATE TABLE personas
(
idpersona	INT AUTO_INCREMENT PRIMARY KEY,
nombres		VARCHAR(30)	NOT NULL,
apellidos	VARCHAR(30)	NOT NULL,
dni		CHAR(8)		NULL,
telefono	CHAR(9)		NULL,	
estado 		CHAR (1) 	NOT NULL DEFAULT '1',
CONSTRAINT uk_dni_per UNIQUE (dni)
)
ENGINE = INNODB;



CREATE TABLE clientes
(
idcliente	INT AUTO_INCREMENT PRIMARY KEY,
idpersona	INT NOT NULL,
estado		CHAR (1) NOT NULL DEFAULT '1',
CONSTRAINT fk_idper_cli FOREIGN KEY (idpersona) REFERENCES personas (idpersona),
CONSTRAINT uk_clien_cli UNIQUE(idpersona)
)ENGINE = INNODB;
	 

CREATE TABLE usuarios
(
idusuario	INT AUTO_INCREMENT PRIMARY KEY,
idpersona	INT	NOT NULL,
nombreusuario	VARCHAR(40)	NOT NULL,
claveacceso	VARCHAR(100)	NOT NULL,
estado 		CHAR(1) 	NOT NULL DEFAULT '1',
CONSTRAINT fk_idp_usu FOREIGN KEY (idpersona) REFERENCES personas (idpersona),
CONSTRAINT uk_nom_usu UNIQUE (nombreusuario)
)
ENGINE = INNODB;


CREATE TABLE productos
(
idproducto	INT AUTO_INCREMENT PRIMARY KEY,
nombre		VARCHAR(30)	NOT NULL,
descripcion	VARCHAR(100)	NULL,
estado		CHAR(1)		NOT NULL DEFAULT '1'
)
ENGINE = INNODB;

INSERT INTO productos (nombre,descripcion) VALUES 
		('Huevos','');


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
flete		DECIMAL(2,1) 	NULL,
fechaventa	DATE		NOT NULL DEFAULT NOW(),
estado		CHAR(1)		NOT NULL DEFAULT '1',
paquetes 	JSON 		NOT NULL,
CONSTRAINT fk_idd_ven FOREIGN KEY (iddetalle_venta) REFERENCES detalle_ventas (iddetalle_venta),
CONSTRAINT fk_idu_ven FOREIGN KEY (idusuario) REFERENCES usuarios (idusuario),
CONSTRAINT fk_idc_ven FOREIGN KEY (idcliente) REFERENCES clientes (idcliente),
CONSTRAINT ck_pre_ven CHECK (precio > 0),
CONSTRAINT ck_kil_ven CHECK (kilos > 0)
)
ENGINE = INNODB;


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
IN _flete	DECIMAL(2,1),
IN _paquetes 	JSON 
)	
BEGIN 
	DECLARE g_iddetalle INT;
	
	INSERT INTO detalle_ventas (idproducto, cantidad) VALUES
				(_idproducto, _cantidad);
	
	SELECT LAST_INSERT_ID() INTO g_iddetalle;
	
	
	INSERT INTO ventas (iddetalle_venta, idusuario, idcliente, kilos, precio, flete, paquetes)VALUES
		(g_iddetalle, _idusuario, _idcliente, _kilos , _precio , _flete, _paquetes);
END$$

CALL spu_ventas_register (1, 1, 1, 4, 123, 12, 0.2 , '{"caja1": 10,"caja2": 10,"caja3": 10,"caja4": 10}');
			
			-- MOSTRAR PAQUETES

DELIMITER $$ 
CREATE PROCEDURE spu_obtener_paquetes(IN _idventa INT )
BEGIN
	SELECT paquetes FROM ventas WHERE idventa = _idventa;
END $$

CALL spu_obtener_paquetes(26);


				-- RECUPERAR PRODUCTOS
DELIMITER $$ 
CREATE PROCEDURE spu_productos_recuperar()
BEGIN
	SELECT idproducto , nombre
	FROM  productos
	WHERE estado = 1;
END $$

CALL spu_productos_recuperar()


				-- RECUPERAR CLIENTES			
DELIMITER $$ 
CREATE PROCEDURE spu_clientes_recuperar()
BEGIN
	SELECT idcliente , CONCAT(nombres,' ', apellidos) AS clientes
	FROM  clientes
	INNER JOIN personas ON personas.`idpersona` = clientes.`idpersona`
	WHERE clientes.`estado` = 1;
END $$				

CALL spu_clientes_recuperar();



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
CREATE PROCEDURE spu_user_list()
BEGIN
	SELECT 	idusuario,
		CONCAT (PE.nombres,' ', PE.apellidos) AS usuario,
		nombreusuario,
		claveacceso
		FROM usuarios
		INNER JOIN personas PE ON PE.idpersona = usuarios.`idpersona`

		WHERE usuarios.estado = '1'
		ORDER BY idusuario DESC;
END $$

CALL spu_user_list()

SELECT * FROM clientes

			-- FILTRO FECHAS

DELIMITER $$
CREATE PROCEDURE spu_filtro2_ventas
(
IN _fechainicio DATE,
IN _fechafin	DATE
)
BEGIN

	SELECT 	VE.idventa,
		CONCAT(CL.nombres,' ',CL.apellidos) AS clientes,
		VE.kilos, DV.cantidad, VE.paquetes, VE.precio, VE.flete, VE.fechaventa,
		(VE.kilos * VE.precio)-(kilos * flete) AS totalPago
	FROM ventas VE
	INNER JOIN clientes ON clientes.`idcliente` = VE.`idcliente`
	LEFT JOIN personas CL ON CL.idpersona = clientes.`idpersona`
	INNER JOIN detalle_ventas DV ON DV.iddetalle_venta = VE.iddetalle_venta
	WHERE VE.fechaventa BETWEEN _fechainicio AND _fechafin;
	
END $$

CALL spu_filtro2_ventas('2023-08-01','2023-08-14')

			-- FILTRO FECHAS Y CLIENTE

DELIMITER $$
CREATE PROCEDURE spu_filtro3_ventas
(
IN _fechainicio DATE,
IN _fechafin	DATE,
IN _idcliente	INT
)
BEGIN

	SELECT 	VE.idventa, CONCAT(cl.nombres,' ', cl.apellidos) AS clientes,  
		VE.kilos, DV.cantidad, VE.paquetes, VE.precio, VE.flete, VE.fechaventa,
		(VE.kilos * VE.precio)-(kilos * flete) AS totalPago
	FROM ventas VE
	INNER JOIN clientes ON clientes.`idcliente` = VE.`idcliente`
	INNER JOIN personas cl ON cl.idpersona = clientes.`idpersona`
	INNER JOIN detalle_ventas DV ON DV.iddetalle_venta = VE.iddetalle_venta
	WHERE VE.fechaventa BETWEEN _fechainicio AND _fechafin AND VE.idcliente = _idcliente;
	
END $$

CALL spu_filtro3_ventas('2023-08-01','2023-08-14',4)



			-- FILTRO CLIENTE

DELIMITER $$
CREATE PROCEDURE spu_filtro1_ventas(IN _idcliente INT)
BEGIN

	SELECT 	VE.idventa, CONCAT(cl.nombres,' ', cl.apellidos) AS clientes,  
		VE.kilos, DV.cantidad, VE.paquetes, VE.precio, VE.flete, VE.fechaventa,
		(VE.kilos * VE.precio)-(kilos * flete) AS totalPago
	FROM ventas VE
	INNER JOIN clientes  ON clientes.`idcliente` = VE.idcliente
	INNER JOIN personas cl ON cl.idpersona = clientes.`idpersona`
	INNER JOIN detalle_ventas DV ON DV.iddetalle_venta = VE.iddetalle_venta
	WHERE VE.idcliente = _idcliente;
	
END $$

CALL spu_filtro1_ventas(1);

SELECT * FROM ventas

				-- SPU PRODUCTO	


DELIMITER $$ 
CREATE PROCEDURE spu_producto_list()
BEGIN
SELECT
	productos.`idproducto`,
	productos.`nombre`,
	productos.`descripcion`

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
	IN _descripcion VARCHAR(100)
)	
	
BEGIN
INSERT INTO productos (nombre, descripcion) VALUES 
	(_producto, _descripcion);  
END $$

CALL spu_producto_register ('huevos doble','50g');


DELIMITER $$
CREATE PROCEDURE spu_producto_update
(
	IN _idproducto		INT,
	IN _producto		VARCHAR(30),
	IN _descripcion 	VARCHAR(100)
)
BEGIN	
	UPDATE productos SET
		nombre 		= _producto,
		descripcion	= _descripcion

	WHERE idproducto = _idproducto;
END $$

CALL spu_producto_update (3,'Huevos quiñados','60g');

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
	clientes.`idcliente`,
	personas.`nombres`,
	personas.`apellidos`,
	personas.`dni`,
	personas.`telefono`

FROM clientes
	INNER JOIN personas ON personas.`idpersona` = clientes.`idpersona`
	WHERE clientes.`estado`= '1'
	ORDER BY idcliente DESC;
END $$

CALL spu_cliente_list();
SELECT * FROM clientes

DELIMITER $$
CREATE PROCEDURE spu_cliente_register 
(

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

END$$

CALL spu_cliente_register('Pocho','Mendoza','','');


DELIMITER $$
CREATE PROCEDURE spu_cliente_update
(
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
END $$


CALL spu_cliente_update (1,'Nombre','Pruebas',78451239,954683218);

DELIMITER $$
CREATE PROCEDURE spu_cliente_obtener
(
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
	
END $$

CALL spu_cliente_obtener(1);

DELIMITER $$
CREATE PROCEDURE spu_cliente_delete
(
	IN _idcliente INT
)
BEGIN
	UPDATE clientes SET estado = '0'
	WHERE idcliente = _idcliente;
END $$



CALL spu_cliente_obtener(1);
