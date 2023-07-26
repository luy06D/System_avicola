
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















