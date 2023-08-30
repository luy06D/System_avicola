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
		('Huevos Pardos',''),
		('Huevos Rosados',''),
		('Huevos Jumbo','')
		
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
deuda		DECIMAL(7,2)	NOT NULL,
fechaventa 	DATE		NOT NULL DEFAULT NOW(),
estado		CHAR(1)		NOT NULL DEFAULT '1',
paquetes 	JSON 		NOT NULL,
CONSTRAINT fk_idd_ven FOREIGN KEY (iddetalle_venta) REFERENCES detalle_ventas (iddetalle_venta),
CONSTRAINT fk_idu_ven FOREIGN KEY (idusuario) REFERENCES usuarios (idusuario),
CONSTRAINT fk_idc_ven FOREIGN KEY (idcliente) REFERENCES clientes (idcliente),
CONSTRAINT ck_pre_ven CHECK (precio > 0),
CONSTRAINT ck_kil_ven CHECK (kilos > 0)
)
ENGINE = INNODB;

CREATE TABLE pagos
(
idpago	INT AUTO_INCREMENT PRIMARY KEY,
idventa		INT NOT NULL,
fechapago	DATE NOT NULL DEFAULT NOW(),
banco		VARCHAR(30)	NOT NULL,
numoperacion	INT 		NOT NULL,
pago		DECIMAL(7,2)	NOT NULL,
estado		VARCHAR(30)	NOT NULL,
CONSTRAINT fk_idv_pa FOREIGN KEY (idventa) REFERENCES ventas (idventa),
CONSTRAINT uk_num_pa UNIQUE(numoperacion),
CONSTRAINT ck_pa_pa CHECK (pago > 0)
)
ENGINE = INNODB;



-- NUEVOS TABLAS PARA ALMACEN (ENTRADA - SALIDA)

CREATE TABLE insumos
(
idinsumo	INT AUTO_INCREMENT PRIMARY KEY,
insumo		VARCHAR(30) 	NOT NULL,
unidad		VARCHAR(20) 	NULL DEFAULT 'KG', -- TONELADA , KILOS
cantidad	INT    		NULL,
descripcion	VARCHAR(80)	NULL,
estado		CHAR(1)		NOT NULL DEFAULT '1',
CONSTRAINT uk_ins_ins UNIQUE(insumo)
)
ENGINE = INNODB;

INSERT INTO insumos (insumo, descripcion) VALUES
		('SOYA','Proteica, vegetal, versátil, nutricional'),
		('AFRECHO','Fibroso, salvado, integral, nutritivo.'),
		('MAIZ','Cereal, amarillo, versátil, nutritivo.'),
		('SAL','Mineral, condimento, saborizante, conservante'),
		('ACHOTE',''),
		('METHIONINE',''),
		('COLINA' ,''),
		('PREMEZCLA'  ,''),
		('CARBONATO POLVO',''),
		('CARBONATO GR',''),
		('FOSTHY' ,''),
		('HITEX',''),
		('ACEITE' ,''),
		('PALMISTE' ,''),
		('MAGNET',''),
		('BICARBONATO' ,''),
		('LISINA',''),
		('TREONINA',''),
		('MAYCOFIX FOCUS',''),
		('MINAZEL PLUS' ,'');


CREATE TABLE detalle_entradas
(
identrada	INT AUTO_INCREMENT PRIMARY KEY,
idinsumo	INT 		NOT NULL,
cantidadtn	SMALLINT	NOT NULL,
cantidadsaco	SMALLINT 	NULL,
precio		DECIMAL(7,2)	NULL,
fecha_entrada	DATE 		NOT NULL,
detalle 	VARCHAR(200) 	NULL,
CONSTRAINT fk_idi_ent FOREIGN KEY (idinsumo) REFERENCES insumos (idinsumo)
)
ENGINE = INNODB;


CREATE TABLE formulas
(
idformula 	INT AUTO_INCREMENT PRIMARY KEY,
nombreformula	VARCHAR(40)	NOT NULL,
CONSTRAINT uk_nom_for UNIQUE(nombreformula)
)
ENGINE = INNODB;

ALTER TABLE formulas ADD estado CHAR(1)NOT NULL DEFAULT '1';

CREATE TABLE detalle_insumos
(
iddetalle_insumo	INT AUTO_INCREMENT PRIMARY KEY,
idformula		INT 		NOT NULL,
idinsumo		INT 		NOT NULL,
cantidad		DECIMAL(10,2) 	NOT NULL,  -- porque al registrar detalle necesita la cantidad inicial
cantidadtn		DECIMAL(7,2)	NULL,
cantidadsacos		DECIMAL(7,2)	NULL,
fecha_salida		DATE 		NOT NULL DEFAULT NOW(),
CONSTRAINT fk_idf_det FOREIGN KEY (idformula) REFERENCES formulas(idformula),
CONSTRAINT fk_idi_det FOREIGN KEY (idinsumo) REFERENCES insumos(idinsumo)
)
ENGINE = INNODB;


-- PROCEDIMIENTOS ALMACEN


-- REGISTRAR INSUMOS

DELIMITER $$
CREATE PROCEDURE spu_insumos_register
(
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

END $$



-- ACTUALIZAR INSUMOS

DELIMITER $$
CREATE PROCEDURE spu_insumos_update
(
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

END $$


-- RECUPERAR DATOS INSUMO 

DELIMITER $$
CREATE PROCEDURE spu_get_insumo(IN _idinsumo INT)
BEGIN
	SELECT	insumo, unidad , cantidad, descripcion
	FROM insumos
	WHERE estado = '1' AND
	idinsumo = _idinsumo;
	

END $$

DELIMITER $$
CREATE PROCEDURE spu_delete_insumo
(
	IN _idinsumo INT
)
BEGIN
	UPDATE insumos SET estado = '0'
	WHERE idinsumo = _idinsumo;
	
END $$

DELIMITER $$
CREATE PROCEDURE spu_mostrar_insumos()
BEGIN
	SELECT idinsumo,
		insumo,
		cantidad,
		descripcion
	FROM insumos
	WHERE estado = '1'
	GROUP BY idinsumo 
	ORDER BY insumo ASC ;
END $$

CALL spu_mostrar_insumos;

CALL spu_insumos_listar;

SELECT * FROM insumos


-- Registrar entrdas de insumos 

DELIMITER $$
CREATE PROCEDURE sp_registrar_entrada(
    IN _idinsumo INT,
    IN _cantidadtn SMALLINT,
    IN _cantidadsacos SMALLINT,
    IN _precio DECIMAL(7,2),
    IN _fecha_entrada DATE,
    IN _detalle VARCHAR(200)
)
BEGIN
  -- Validar que las cantidades no sean negativas
  IF _cantidadtn < 0 OR _cantidadsacos < 0 THEN
    SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'Las cantidades no pueden ser negativas';
  ELSE
    -- Calcular la cantidad total en kilos sumando cantidadtn y cantidadsacos
    SET @cantidad_total_kilos = (_cantidadtn * 1000) + (_cantidadsacos * 50);

    -- Iniciar la transacción
    START TRANSACTION;


    -- Actualizar la cantidad en insumos sumando la cantidad total en kilos
    UPDATE insumos 
    SET cantidad = IFNULL(cantidad, 0) + @cantidad_total_kilos
    WHERE idinsumo = _idinsumo;


    -- Registrar la entrada en una tabla de registros (ejemplo)
    INSERT INTO detalle_entradas (idinsumo, cantidadtn, cantidadsaco, precio, fecha_entrada, detalle)
    VALUES (_idinsumo, _cantidadtn, _cantidadsacos, _precio, _fecha_entrada, _detalle);
    -- Confirmar la transacción
    COMMIT;

    -- Manejo de errores
    BEGIN
      DECLARE EXIT HANDLER FOR SQLEXCEPTION
      BEGIN
        ROLLBACK;
        RESIGNAL;
      END;
    END;
  END IF;
END $$


CALL sp_registrar_entrada(1,1,2,2500,'2023-08-26','Entrada prueba');

SELECT * FROM detalle_entradas;

SELECT * FROM insumos;


-- DESCONTAR CANTIDAD INSUMOS
DELIMITER $$
CREATE PROCEDURE spu_descontar_insumo
(
IN _idformula INT,
IN _idinsumo INT,
IN _cantidadtn DECIMAL(7,2),
IN _cantidadsacos DECIMAL(7,2)
)
BEGIN
  DECLARE insumo_cantidad DECIMAL(10, 3);
  SET @conversion_factor = 1;

  START TRANSACTION;

  SELECT cantidad INTO insumo_cantidad FROM insumos WHERE idinsumo = _idinsumo;

  SET @cantidad_total = _cantidadtn + (_cantidadsacos / @conversion_factor);

  IF insumo_cantidad >= @cantidad_total THEN
    SET insumo_cantidad = insumo_cantidad - @cantidad_total;
    UPDATE insumos SET cantidad = insumo_cantidad WHERE idinsumo = _idinsumo;
  ELSE
    ROLLBACK;
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No hay suficiente cantidad de este insumo para la fórmula.';
  END IF;

  COMMIT;
END $$
DELIMITER ;


CALL spu_descontar_insumo(3, 19, 100 , 50);

SELECT * FROM detalle_insumos;




DELIMITER $$
CREATE PROCEDURE spu_detalleinsumo_registrar(
IN _idformula INT,
IN _idinsumo INT,
IN _cantidad DECIMAL(10, 2)
)
BEGIN
  -- Variable para almacenar la cantidad actual
  DECLARE cantidad_actual DECIMAL(10, 2);
  
  -- Obtener la cantidad actual en detalle_insumos si existe un registro con los mismos valores de idformula e idinsumo
  SELECT cantidad INTO cantidad_actual
  FROM detalle_insumos
  WHERE idformula = _idformula AND idinsumo = _idinsumo;
  
  -- Verificar si se encontró un registro en detalle_insumos
  IF cantidad_actual IS NOT NULL THEN
    -- Si existe un registro, actualizar la cantidad sumando _cantidad
    UPDATE detalle_insumos
    SET cantidad = cantidad_actual + _cantidad
    WHERE idformula = _idformula AND idinsumo = _idinsumo;
  ELSE
    -- Si no existe un registro, insertar un nuevo registro en detalle_insumos
    INSERT INTO detalle_insumos(idformula, idinsumo, cantidad)
    VALUES (_idformula, _idinsumo, _cantidad);
  END IF;
  
END$$

CALL spu_detalleinsumo_registrar (3, 6, 700);

SELECT *FROM formulas
SELECT * FROM detalle_insumos



-- FILTRO DE INSUMOS ENTRADAS

DELIMITER $$
CREATE PROCEDURE sp_filtro_fech(
    IN p_fecha_inicio DATE,
    IN p_fecha_fin DATE
)
BEGIN
    SELECT
	de.fecha_entrada,
	de.detalle,
	i.insumo,
	de.unidad,
        de.cantidad AS cantidad_entrada,
        de.precio,
        i.cantidad AS stock,
        
    FROM insumos i
    LEFT JOIN detalle_entradas de ON i.idinsumo = de.idinsumo
    WHERE de.fecha_entrada BETWEEN p_fecha_inicio AND p_fecha_fin
    ORDER BY de.fecha_entrada;
END $$
CALL sp_filtro_fech('2023-08-01','2023-08-28')



-- DETALLE DE FORMULAS POR ID


DELIMITER $$
CREATE PROCEDURE spu_listar_detalleF
(
IN _idformula INT,
IN _cantidadtn DECIMAL(7,2),
IN _cantidadsacos DECIMAL(7,2)
)
BEGIN 
    SET _cantidadsacos = _cantidadsacos * 50;

    SELECT DI.iddetalle_insumo, I.idinsumo, I.insumo, 
    DI.cantidad,
    TRUNCATE(DI.cantidad * _cantidadtn, 2) AS proporcion,
    TRUNCATE(_cantidadsacos, 2) AS sacos
    FROM detalle_insumos DI
    INNER JOIN  formulas F ON F.idformula = DI.idformula
    INNER JOIN insumos I ON I.idinsumo = DI.idinsumo
    WHERE F.idformula = _idformula;
    
END $$


CALL spu_listar_detalleF(1, 2, 3);

SELECT * FROM detalle_insumos

INSERT INTO detalle_insumos (idformula, idinsumo, cantidad) VALUES
	(1, 1, 200)

-- REGISTRAR FORMULA

DELIMITER $$
CREATE PROCEDURE spu_formula_registrar
(
IN _nombreformula VARCHAR(40)
)
BEGIN
    INSERT INTO formulas (nombreformula) VALUES
            (_nombreformula);
END $$



-- MOSTRAR FORMULA 

DELIMITER $$
CREATE PROCEDURE spu_getFormula()
BEGIN 
	SELECT idformula, nombreformula
	FROM formulas
	WHERE estado = 1;
END $$

CALL spu_getFormula();

-- ELIMINAR FORMULA 
DELIMITER $$
CREATE PROCEDURE spu_formulaDelete(IN _idformula INT)
BEGIN 
	UPDATE formulas SET 
	estado = 0
	WHERE idformula = _idformula;
	
END $$

CALL spu_formulaDelete (10)



-- ACTUALIZAR UNA FORMULA
DELIMITER $$
CREATE PROCEDURE spu_detalleInsumo_update
(
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
END $$

CALL spu_detalleInsumo_update(14, 3 , 31, 'KG');


-- REGISTRAR DETALLE INSUMO

DELIMITER $$
CREATE  PROCEDURE spu_detalleinsumo_registrar(
IN _idformula INT,
IN _idinsumo INT,
IN _cantidad DECIMAL(10,3)
)
BEGIN
  -- Variable para almacenar la cantidad actual
  DECLARE cantidad_actual DECIMAL(10, 3);

  -- Obtener la cantidad actual en detalle_insumos si existe un registro con los mismos valores de idformula e idinsumo
  SELECT cantidad INTO cantidad_actual
  FROM detalle_insumos
  WHERE idformula = _idformula AND idinsumo = _idinsumo;

  -- Verificar si se encontró un registro en detalle_insumos
  IF cantidad_actual IS NOT NULL THEN
    -- Si existe un registro, actualizar la cantidad sumando _cantidad
    UPDATE detalle_insumos
    SET cantidad = cantidad_actual + _cantidad
    WHERE idformula = _idformula AND idinsumo = _idinsumo;
  ELSE
    -- Si no existe un registro, insertar un nuevo registro en detalle_insumos
    INSERT INTO detalle_insumos(idformula, idinsumo, cantidad)
    VALUES (_idformula, _idinsumo, _cantidad);
  END IF;

END$$

SELECT * FROM detalle_insumos

-- GET INSUMOS PARA DETALLE
DELIMITER $$
CREATE PROCEDURE spu_getInsumo()
BEGIN 
	SELECT idinsumo, insumo
	FROM insumos;
END $$

-- GET DETALLE

DELIMITER $$
CREATE PROCEDURE spu_getdetalleI(IN _iddetalle_insumo INT)
BEGIN 
	SELECT idinsumo, unidad, cantidad
	FROM  detalle_insumos
	WHERE iddetalle_insumo = _iddetalle_insumo;
END $$

CALL spu_getdetalleI(1);

 




DELIMITER $$
CREATE PROCEDURE sp_filtro_insumofechid(
    IN p_idinsumo INT,
    IN p_fecha_inicio DATE,
    IN p_fecha_fin DATE
)
BEGIN
    SELECT 
        de.fecha_entrada,
	de.detalle,
	i.insumo,
	de.unidad,
        de.cantidad AS cantidad_entrada,
        de.precio,
        i.cantidad AS stock,
    FROM insumos i
    LEFT JOIN detalle_entradas de ON i.idinsumo = de.idinsumo
    WHERE i.idinsumo = p_idinsumo AND de.fecha_entrada BETWEEN p_fecha_inicio AND p_fecha_fin
    ORDER BY de.fecha_entrada;
END $$
CALL sp_filtro_insumofechid(1,'2023-08-01','2023-08-28')


DELIMITER $$
CREATE PROCEDURE sp_filtro_insumo(
    IN p_idinsumo INT
)
BEGIN
    SELECT
        de.fecha_entrada,
	de.detalle,
	i.insumo,
	de.unidad,
        de.cantidad AS cantidad_entrada,
        de.precio,
        i.cantidad AS stock,
    FROM detalle_entradas de
    INNER JOIN insumos i ON de.idinsumo = i.idinsumo
    WHERE i.idinsumo = p_idinsumo
    ORDER BY de.fecha_entrada;
END $$

CALL sp_filtro_insumo(1)



-- FILTRO DE INSUMOS SALIDAS

DELIMITER $$
CREATE PROCEDURE sp_filtro_salidafecha(
    IN _fecha_inicio DATE,
    IN _fecha_fin DATE
)
BEGIN
    SELECT
	d.fecha_salida
        i.insumo,
        d.unidad,
        d.cantidad,
        i.cantidad AS stock,
        
    FROM detalle_insumos d
    INNER JOIN insumos i ON d.idinsumo = i.idinsumo
    WHERE d.fecha_entrada BETWEEN _fecha_inicio AND _fecha_fin
    ORDER BY d.fecha_entrada;
END $$
DELIMITER $$

CALL sp_filtro_salidafecha('2023-08-01','2023-08-28')

DELIMITER $$
CREATE PROCEDURE sp_filtro_salidafechid(
    IN _idinsumo INT,
    IN _fecha_inicio DATE,
    IN _fecha_fin DATE
)
BEGIN
    SELECT
       d.fecha_salida
        i.insumo,
        d.unidad,
        d.cantidad,
        i.cantidad AS stock,
    FROM detalle_insumos d
    INNER JOIN insumos i ON d.idinsumo = i.idinsumo
    WHERE d.idinsumo = _idinsumo
    AND d.fecha_entrada BETWEEN _fecha_inicio AND _fecha_fin
    ORDER BY d.fecha_entrada;
END $$

CALL sp_filtro_salidafechid(,'2023-08-01','2023-08-28')

DELIMITER $$
CREATE PROCEDURE sp_filtro_salidaidinsumo(
    IN _idinsumo INT
)
BEGIN
    SELECT
	d.fecha_salida
        i.insumo,
        d.unidad,
        d.cantidad,
        i.cantidad AS stock,
    FROM detalle_insumos d
    INNER JOIN insumos i ON d.idinsumo = i.idinsumo
    WHERE d.idinsumo = _idinsumo
    ORDER BY d.fecha_entrada;
END $$

-- FIN PROCEDIMIENTOS ALMACEN

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
END$$

			-- MOSTRAR ULTIMA VENTA REGISTRADA
DELIMITER $$
CREATE PROCEDURE spu_obtener_ultimaV()
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
END $$

-- MOSTRAR DETALLE DE VENTA POR ID VENTA

DELIMITER $$ 
CREATE PROCEDURE spu_obtener_detalleV(IN _idventa INT)
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

END $$

-- MOSTRAR PAQUETES

DELIMITER $$ 
CREATE PROCEDURE spu_obtener_paquetes(IN _idventa INT )
BEGIN
	SELECT paquetes FROM ventas WHERE idventa = _idventa;
END $$


				-- RECUPERAR PRODUCTOS
DELIMITER $$ 
CREATE PROCEDURE spu_productos_recuperar()
BEGIN
	SELECT idproducto , nombre
	FROM  productos
	WHERE estado = 1;
END $$

-- RECUPERAR CLIENTES			
DELIMITER $$ 
CREATE PROCEDURE spu_clientes_recuperar()
BEGIN
	SELECT idcliente , CONCAT(nombres,' ', apellidos) AS clientes
	FROM  clientes
	INNER JOIN personas ON personas.`idpersona` = clientes.`idpersona`
	WHERE clientes.`estado` = 1;
END $$				





				/*LISTAR VENTAS*/

	

 
DELIMITER $$
 CREATE PROCEDURE spu_resume_ventas()
 BEGIN
 SELECT COUNT(*) AS Ventas, MONTHNAME(fechaventa) AS MONTH, SUM(ventas.kilos) AS Kilos_Vendidos2
 FROM ventas
 WHERE fechaventa >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
 ORDER BY fechaventa;
 END$$
 

	
			/*Grafico N2*/


-- GRAFICO N2 EN ESPAÑOL
DELIMITER $$			
CREATE PROCEDURE spu_ventas_resume()
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
END $$

		
			-- USUARIO (MODULO)

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



		-- LISTAR USUARIOS --
DELIMITER $$ 
CREATE PROCEDURE spu_user_list()
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
END $$



		-- ACTUALIZAR USUARIOS
DELIMITER $$
CREATE PROCEDURE spu_user_update
(
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
END $$



		-- OBTENER USUARIOS
DELIMITER $$
CREATE PROCEDURE spu_user_obtener
(
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
	
END $$

	
		
		-- ELIMINAR USUARIOS --
DELIMITER $$
CREATE PROCEDURE spu_user_delete
(
	IN _idusuario INT
)
BEGIN
	UPDATE usuarios SET estado = '0'
	WHERE idusuario = _idusuario;
END $$




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
		VE.kilos, DV.cantidad, VE.precio, VE.fechaventa,
		(VE.kilos * VE.precio)-(DV.cantidad * flete) AS totalPago
	FROM ventas VE
	INNER JOIN clientes ON clientes.`idcliente` = VE.`idcliente`
	LEFT JOIN personas CL ON CL.idpersona = clientes.`idpersona`
	INNER JOIN detalle_ventas DV ON DV.iddetalle_venta = VE.iddetalle_venta
	WHERE VE.fechaventa BETWEEN _fechainicio AND _fechafin;
	
END $$


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
		VE.kilos, DV.cantidad, VE.precio, VE.fechaventa,
		(VE.kilos * VE.precio)-(DV.cantidad * flete) AS totalPago
	FROM ventas VE
	INNER JOIN clientes ON clientes.`idcliente` = VE.`idcliente`
	INNER JOIN personas cl ON cl.idpersona = clientes.`idpersona`
	INNER JOIN detalle_ventas DV ON DV.iddetalle_venta = VE.iddetalle_venta
	WHERE VE.fechaventa BETWEEN _fechainicio AND _fechafin AND VE.idcliente = _idcliente;
	
END $$


			-- FILTRO CLIENTE

DELIMITER $$
CREATE PROCEDURE spu_filtro1_ventas(IN _idcliente INT)
BEGIN

	SELECT 	VE.idventa, CONCAT(cl.nombres,' ', cl.apellidos) AS clientes,  
		VE.kilos, DV.cantidad, VE.precio, VE.fechaventa,
		(VE.kilos * VE.precio)-(DV.cantidad * flete) AS totalPago
	FROM ventas VE
	INNER JOIN clientes  ON clientes.`idcliente` = VE.idcliente
	INNER JOIN personas cl ON cl.idpersona = clientes.`idpersona`
	INNER JOIN detalle_ventas DV ON DV.iddetalle_venta = VE.iddetalle_venta
	WHERE VE.idcliente = _idcliente;
	
END $$


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


		-- REGISTRAR PRODUCTO

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


		-- ACTUALIZAR PRODUCTO
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



		-- OBTENER PRODUCTO --
DELIMITER $$
CREATE PROCEDURE spu_producto_obtener
(
	IN _idproducto INT
)
BEGIN
	SELECT * FROM productos WHERE idproducto = _idproducto;
END $$


		-- ELIMINAR PRODUCTO
DELIMITER $$
CREATE PROCEDURE spu_producto_delete
(
	IN _idproducto INT
)
BEGIN
	UPDATE productos SET estado = '0'
	WHERE idproducto = _idproducto;
END $$



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



		-- REGISTRAR CLIENTES
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


		
		-- ACTUALIZAR CLIENTES
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



		-- OBTENER CLIENTES
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



		-- ELIMINAR CLIENTES
DELIMITER $$
CREATE PROCEDURE spu_cliente_delete
(
	IN _idcliente INT
)
BEGIN
	UPDATE clientes SET estado = '0'
	WHERE idcliente = _idcliente;
END $$



	-- LISTAR PAGOS

DELIMITER $$
CREATE PROCEDURE spu_pagos_listar()
BEGIN
SELECT idpago, CONCAT(personas.nombres, ' ', personas.apellidos) AS Cliente, fechapago, banco, numoperacion, ventas.deuda, pago, ventas.deuda - SUM(pago) AS saldo
FROM pagos
INNER JOIN ventas ON ventas.idventa = pagos.idventa
INNER JOIN clientes ON clientes.idcliente = ventas.idcliente
INNER JOIN personas ON personas.idpersona = clientes.idpersona;
END$$


			-- Filtrar---

				
DELIMITER $$
CREATE PROCEDURE spu_filtro_clientePago
(
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
END$$



DELIMITER $$
CREATE PROCEDURE spu_filtro_ClienteFecha
(
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
END $$



DELIMITER $$
CREATE PROCEDURE spu_filtro_pagoclientefecha 
(
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
END $$


			-- Listar
DELIMITER $$
CREATE PROCEDURE spu_listar_pago()
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
END $$

 


DELIMITER $$
CREATE PROCEDURE spu_pagos_registrar
(
IN _idventa INT ,
IN _banco VARCHAR(30),
IN _numoperacion INT,
IN _pago DECIMAL(7,2)
)
BEGIN
	
	INSERT INTO pagos (idventa, banco, numoperacion, pago)VALUES
	(_idventa, _banco, _numoperacion, _pago);
	
END$$



DELIMITER $$
CREATE PROCEDURE spu_listar_detallesclientes
(
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
END $$




DELIMITER $$
CREATE PROCEDURE spu_ventas_mostrar()
BEGIN
    SELECT
        v.idventa,
        CONCAT(cl.nombres, ' ', cl.apellidos) AS Cliente,
        MAX(v.fechaventa) AS fechaventa,
        MAX(pr.nombre) AS nombre,
        SUM(v.deuda) AS deuda_total,
        COALESCE(SUM(p.pago), 0) AS pago_total,
        (SUM(v.deuda) - COALESCE(SUM(p.pago), 0)) AS saldo,
        CASE
            WHEN (SUM(v.deuda) - COALESCE(SUM(p.pago), 0)) <= 0 THEN 'Cancelado'
            ELSE 'Pendiente'
        END AS estado
    FROM ventas v
    LEFT JOIN (
        SELECT idventa, SUM(pago) AS pago
        FROM pagos
        GROUP BY idventa
    ) p ON v.idventa = p.idventa
    INNER JOIN clientes c ON v.idcliente = c.idcliente
    INNER JOIN personas cl ON c.idpersona = cl.idpersona
    INNER JOIN detalle_ventas dv ON v.iddetalle_venta = dv.iddetalle_venta
    INNER JOIN productos pr ON dv.idproducto = pr.idproducto
    GROUP BY c.idcliente
    ORDER BY c.idcliente;
END $$