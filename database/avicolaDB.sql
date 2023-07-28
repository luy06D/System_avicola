
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

INSERT INTO personas (nombres, apellidos, dni, telefono) VALUES
('Alex Edú', 'Quiroz Ccaulla', 72680725, 959282307);

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

INSERT INTO usuarios(idpersona, nombreusuario, claveacceso)VALUES
('1', 'Eduqcc08', '123456');

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

INSERT INTO productos (nombre, cantidad, precio)VALUES
('huevos', '5000', 8.30)

CREATE TABLE detalle_ventas
(
iddetalle_venta		INT AUTO_INCREMENT PRIMARY KEY,
idproducto		INT 		NOT NULL,
cantidad		SMALLINT	NOT NULL,
CONSTRAINT fk_idp_det FOREIGN KEY (idproducto)	REFERENCES productos(idproducto),
CONSTRAINT ck_can_det CHECK (cantidad > 0 )
)
ENGINE = INNODB;

INSERT INTO detalle_ventas(idproducto, cantidad)VALUES
(1, 500)

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
	SELECT *
	FROM usuarios
	WHERE nombreusuario = _nombreusuario;
END$$

CALL spu_user_login('Eduqcc08')


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

CALL spu_ventas_register(1,1,1)


				/*LISTAR VENTAS*/
				
