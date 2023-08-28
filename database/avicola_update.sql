
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
		('Huevos Yumbo','')


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


-- ALTER TABLE ventas
-- MODIFY COLUMN fechaventa DATEtime NOT NULL DEFAULT NOW();



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
unidad		VARCHAR(20) 	NOT NULL, -- TONELADA , KILOS
cantidad	SMALLINT 	NOT NULL,
descripcion	VARCHAR(80)	NULL,
CONSTRAINT uk_ins_ins UNIQUE(insumo)
)
ENGINE = INNODB;

INSERT INTO insumos (insumo, unidad, cantidad, descripcion) VALUES
		('SOYA','KG', 400 ,'Proteica, vegetal, versátil, nutricional'),
		('AFRECHO','KG', 700 ,'Fibroso, salvado, integral, nutritivo.'),
		('MAIZ','KG', 1000 ,'Cereal, amarillo, versátil, nutritivo.'),
		('SAL','KG', 700 ,'Mineral, condimento, saborizante, conservante');


CREATE TABLE detalle_entradas
(
identrada	INT AUTO_INCREMENT PRIMARY KEY,

idinsumo	INT NOT NULL,
cantidad	SMALLINT	NOT NULL,
precio		DECIMAL(7,2)	NOT NULL,
fecha_entrada	DATE 	NOT NULL DEFAULT NOW(),

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

-- AGREGARDO ESTADO

ALTER TABLE formulas ADD COLUMN estado CHAR(1) NOT NULL DEFAULT 1;


CREATE TABLE detalle_insumos
(
iddetalle_insumo	INT AUTO_INCREMENT PRIMARY KEY,
idformula		INT 		NOT NULL,
idinsumo		INT 		NOT NULL,
cantidad		SMALLINT	NOT NULL,
unidad			VARCHAR(20)	NOT NULL,
CONSTRAINT fk_idf_det FOREIGN KEY (idformula) REFERENCES formulas(idformula),
CONSTRAINT fk_idi_det FOREIGN KEY (idinsumo) REFERENCES insumos(idinsumo)
)
ENGINE = INNODB;

-- PROCEDIMIENTOS ALMACEN

-- LISTAR INSUMOS

DELIMITER $$

CREATE PROCEDURE spu_insumos_listar()
BEGIN 
	SELECT idinsumo, insumo, cantidad, unidad,
	descripcion
	FROM insumos
	WHERE estado = '1'
	ORDER BY idinsumo DESC;
END $$

DELIMITER ;





CALL spu_insumos_listar();

-- REGISTRAR INSUMOS

DELIMITER $$

CREATE PROCEDURE spu_insumos_register
(
IN _insumo VARCHAR(30),
IN _unidad VARCHAR(20),
IN _cantidad DECIMAL(10, 3), 
IN _descripcion VARCHAR(80)
)
BEGIN
    DECLARE existing_idinsumo INT;

    DECLARE conversion_factor DECIMAL(10, 3);

    SET conversion_factor = CASE WHEN _unidad = 'TN' THEN 1000 ELSE 1 END;

    SET _cantidad = _cantidad * conversion_factor;

    SET existing_idinsumo = (SELECT idinsumo FROM insumos WHERE insumo = _insumo);

    IF existing_idinsumo IS NOT NULL THEN
        UPDATE insumos SET cantidad = cantidad + _cantidad WHERE idinsumo = existing_idinsumo;
    ELSE
        IF _descripcion = '' THEN SET _descripcion = NULL; END IF;

        INSERT INTO insumos (insumo, unidad, cantidad, descripcion) VALUES
            (_insumo, 'kg', _cantidad, _descripcion);
    END IF;

END $$




CALL spu_insumos_register('CARBONATO GRANO','KG',500 ,'');

INSERT INTO insumos (insumo, unidad, cantidad, descripcion) VALUES
		('HINT','KG', 400 ,'Proteica, vegetal, versátil, nutricional');

SELECT * FROM insumos;

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

CALL spu_insumos_update(17,'INSUMO PRUEBA','KG', 300 ,'');

-- RECUPERAR DATOS INSUMO 

DELIMITER $$
CREATE PROCEDURE spu_get_insumo(IN _idinsumo INT)
BEGIN
	SELECT	insumo, unidad , cantidad, descripcion
	FROM insumos
	WHERE idinsumo = _idinsumo;

END $$

CALL spu_get_insumo(3);






-- REGISTRAR PROVEEDORES

DELIMITER $$
CREATE PROCEDURE spu_proveedor_register
(
IN _nombre VARCHAR(30),
IN _direccion VARCHAR(50),
IN _telefono	CHAR(9)
)
BEGIN
	IF _direccion = '' THEN SET _direccion = NULL;	
	END IF;
	
	INSERT INTO proveedores (nombre, direccion, telefono) VALUES
		(_nombre, _direccion, _telefono);

END $$

CALL spu_proveedor_register('PERUSac','Calle san marcos 23', 95675456);


-- ACTUALIZAR PROVEEDORES

DELIMITER $$
CREATE PROCEDURE spu_proveedor_update
(
IN _idproveedor INT,
IN _nombre VARCHAR(30),
IN _direccion VARCHAR(50),
IN _telefono	CHAR(9)
)
BEGIN
	IF _direccion = '' THEN SET _direccion = NULL;	
	END IF;
	
	UPDATE proveedores SET 
	nombre	= _nombre,
	direccion = _direccion,
	telefono = _telefono
	WHERE idproveedor = _idproveedor;
	
END $$


CALL spu_proveedor_update(1, 'PERUSac','Calle san marcos 25', 95675456);

-- GET PROVEEDOR

DELIMITER $$
CREATE PROCEDURE spu_get_proveedor(IN _idproveedor INT)
BEGIN
	SELECT	nombre, direccion , telefono
	FROM proveedores
	WHERE idproveedor = _idproveedor;

END $$

CALL  spu_get_proveedor(1);


-- ELIMINAR PROVEEDOR

DELIMITER $$
CREATE PROCEDURE spu_provedor_delete(IN _idproveedor INT)
BEGIN
	UPDATE proveedores SET
	estado = 0
	WHERE idproveedor = _idproveedor;

END $$

CALL spu_provedor_delete(1);


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

CALL spu_formula_registrar('ESTEROIDE')

-- GET INSUMOS


DELIMITER $$
CREATE PROCEDURE spu_getInsumo()
BEGIN 
	SELECT idinsumo, insumo
	FROM insumos
	ORDER BY idinsumo;
END $$

CALL spu_getInsumo();




-- REGISTRAR UNA DETALLE_INSUMO






DELIMITER $$

CREATE PROCEDURE spu_detalleInsumo_registrar
(
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
END $$




DELIMITER ;










DELETE FROM formulas





SELECT * FROM insumos
CALL spu_detalleInsumo_registrar( 1 , 4, 20, 'KG');

SELECT * FROM formulas
SELECT * FROM detalle_insumos
SELECT * FROM insumos


-- DETALLE DE FORMULAS POR ID
DELIMITER $$

CREATE PROCEDURE spu_listar_detalleF(IN _idformula INT)
BEGIN 
	SELECT  I.insumo, 
	DI.cantidad,
	(Di.cantidad * 0.05) AS gkgU
	FROM detalle_insumos DI
	INNER JOIN  formulas F ON F.idformula = DI.idformula
	INNER JOIN insumos I ON I.idinsumo = DI.idinsumo
	WHERE F.idformula = _idformula;
	
END $$

CALL spu_listar_detalleF(1)

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


-- GET DETALLE

DELIMITER $$
CREATE PROCEDURE spu_getdetalleI(IN _iddetalle_insumo INT)
BEGIN 
	SELECT idinsumo, unidad, cantidad
	FROM  detalle_insumos
	WHERE iddetalle_insumo = _iddetalle_insumo;
END $$

CALL spu_getdetalleI(1);

 

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

CALL spu_obtener_ultimaV();
	
			
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

CALL spu_obtener_detalleV(5);
			
			-- MOSTRAR PAQUETES

DELIMITER $$ 
CREATE PROCEDURE spu_obtener_paquetes(IN _idventa INT )
BEGIN
	SELECT paquetes FROM ventas WHERE idventa = _idventa;
END $$

CALL spu_obtener_paquetes(1);


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
 
 CALL spu_resume_ventas();
	
			/*Grafico N2*/

DELIMITER$$			
DROP PROCEDURE spu_ventas_resume()
BEGIN
SELECT LEFT(DAYNAME(fechaventa),10 ) AS Dia, COUNT(ventas.idventa)AS Ventas_Diarias, SUM(ventas.kilos) AS Kilos_Vendidos
FROM ventas
INNER JOIN detalle_ventas ON detalle_ventas.iddetalle_venta = ventas.iddetalle_venta
WHERE fechaventa >= DATE_SUB(NOW(), INTERVAL 7 DAY)
GROUP BY fechaventa
ORDER BY fechaventa;

 END $$
 
CALL spu_ventas_resume();

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


			-- REGISTRAR USUARIO (MODULO)

CALL spu_usuario_registar('Avicola','Vania','','','admin','123456');

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

CALL spu_user_list()

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

CALL spu_user_update(1,'Avic','Vani',75369596,953684771,'Admin','1234567')


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

CALL spu_user_obtener(2)
	
		
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

CALL spu_user_delete(3);



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

CALL spu_filtro2_ventas('2023-08-01','2023-08-20')
SELECT * FROM ventas
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

CALL spu_filtro3_ventas('2023-08-01','2023-09-20',2)

SELECT * FROM ventas

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

CALL spu_filtro1_ventas(4);

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

CALL spu_producto_register ('huevos doble','50g');

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

CALL spu_producto_update (3,'Huevos quiñados','60g');


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

CALL spu_cliente_register('Pocho','Mendoza','','');

		
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


CALL spu_cliente_update (1,'Nombre','Pruebas',78451239,954683218);


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

CALL spu_cliente_obtener(2);


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




CALL spu_cliente_obtener(1);

DELIMITER $$
CREATE PROCEDURE spu_pagos_listar()
BEGIN
SELECT idpago, CONCAT(personas.nombres, ' ', personas.apellidos) AS Cliente, fechapago, banco, numoperacion, ventas.deuda, pago, ventas.deuda - SUM(pago) AS saldo
FROM pagos
INNER JOIN ventas ON ventas.idventa = pagos.idventa
INNER JOIN clientes ON clientes.idcliente = ventas.idcliente
INNER JOIN personas ON personas.idpersona = clientes.idpersona;
END$$










 








			-- Filtrar-------------------

				
DELIMITER $$
CREATE PROCEDURE spu_filtro_clientePago(
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

SELECT * FROM ventas
SELECT * FROM pagos
CALL spu_filtro_clientePago(1);


INSERT INTO pagos (idventa, banco, numoperacion, pago, estado) VALUES
	(8, 'BCP', 1023400, 50, '' )
	
DELETE FROM pagos WHERE idpago = 7	
	
	SELECT * FROM personas
	



DELIMITER $$
CREATE PROCEDURE spu_filtro_ClienteFecha
(
    IN _fechainicio DATE,
    IN _fechafin DATE
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
    WHERE DATE(p.fechapago) BETWEEN _fechainicio AND _fechafin
    GROUP BY Cliente, producto
    ORDER BY idpago DESC;    
END $$

SELECT * FROM ventas
SELECT * FROM personas

CALL spu_filtro_ClienteFecha('2023-08-01','2023-08-21')

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

CALL spu_filtro_pagoclientefecha('2023-08-01','2023-08-20',1)

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

 
 CALL spu_ventas_mostrar



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

CALL spu_pagos_registrar(1, 'BCP', '00010', '330')


DELIMITER $$
CREATE PROCEDURE spu_listar_detallesclientes
(
	IN _idcliente INT
)
BEGIN
	SELECT 	
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

CALL spu_listar_detallesclientes(4);



DELIMITER $$
CREATE PROCEDURE spu_ventas_mostrar()
BEGIN
    SELECT
        v.idventa,
        CONCAT(cl.nombres, ' ', cl.apellidos) AS Cliente,
        MAX(v.fechaventa) AS fechaventa, -- Utilizamos MAX para obtener la fecha más reciente
        SUM(v.deuda) AS deuda_total,
        SUM(p.pago) AS pago_total,
        (SUM(v.deuda) - COALESCE(SUM(p.pago), 0)) AS saldo,
        CASE
            WHEN (v.deuda - COALESCE(SUM(p.pago), 0)) <= 0 THEN 'Cancelado'
            ELSE 'Pendiente'
        END AS estado
    FROM ventas v
    LEFT JOIN pagos p ON v.idventa = p.idventa
    INNER JOIN clientes c ON v.idcliente = c.idcliente
    INNER JOIN personas cl ON c.idpersona = cl.idpersona
    GROUP BY v.idventa
    ORDER BY p.fechapago DESC;

END $$
 
 SELECT * FROM pagos
 
 CALL spu_ventas_mostrar();
 
 
 DELETE FROM ventas
 
 ALTER TABLE ventas AUTO_INCREMENT = 1


 
