
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

-- Actualizando restriccion not null (dni)
ALTER TABLE personas MODIFY COLUMN dni CHAR(8) NULL;


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


-- Encriptamos la contraseña
UPDATE usuarios SET claveacceso = '$2y$10$G/Rcks0WXGZslmcfaOXxGODGrK2IaseWCjcA028UrTHyO2n7ptFYq'
WHERE idusuario = 1;


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

-- Npaquetes 
-- Nkilos

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
	SELECT 	usuarios.idusuario, 
		personas.apellidos, personas.nombres,
		usuarios.nombreusuario, usuarios.claveacceso
	FROM usuarios
	INNER JOIN personas ON personas.idpersona = usuarios.idpersona
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


UPDATE usuarios SET claveacceso = '$2y$10$XmYFrIUyGm2mxxkdSaB6A.QHUNp9qB9cLUACpJroNOBhDDasiDU2S'
WHERE idusuario = 2
























		
				
				
				
				
				
				
				
				
				
				
				
				
