DROP PROCEDURE IF EXISTS obten_puestos;
DELIMITER $
CREATE PROCEDURE obten_puestos(IN departamento_inv VARCHAR(30))
BEGIN
	SELECT pd.puesto
	FROM puesto_departamento pd
	WHERE pd.departamento = departamento_inv
	;
END $
DELIMITER ;

DROP PROCEDURE IF EXISTS obten_menus_sin_acceso;
DELIMITER $
CREATE PROCEDURE obten_menus_sin_acceso(IN departamento_invc VARCHAR(30), IN puesto_invc VARCHAR(50))
BEGIN
	SELECT *
	FROM menu m
	WHERE m.titulo NOT IN 
		(
		SELECT m.titulo
		FROM 
			puesto_accesa_menu pam,
			menu m
		WHERE pam.departamento = departamento_invc AND
			pam.puesto = puesto_invc AND
			m.titulo = pam.menu
		)
	ORDER BY m.titulo;
END $
DELIMITER ;

DROP PROCEDURE IF EXISTS obten_menus_con_acceso;	
DELIMITER $
CREATE PROCEDURE obten_menus_con_acceso(IN departamento_invc VARCHAR(30), IN puesto_invc VARCHAR(50))
BEGIN
	SELECT m.*
	FROM puesto_accesa_menu pam,
		menu m
	WHERE pam.departamento = departamento_invc AND
		pam.puesto = puesto_invc AND
		m.titulo=pam.menu
	ORDER BY m.titulo
	;
END $
DELIMITER ;

DROP PROCEDURE IF EXISTS obten_codigo_postal;
DELIMITER $
CREATE PROCEDURE obten_codigo_postal(IN codigo_postal_inc CHAR(5))
BEGIN
	SELECT codigo_postal, estado, GROUP_CONCAT(DISTINCT municipio ORDER BY municipio) AS municipios 
	FROM codigo_postal 
	WHERE codigo_postal = codigo_postal_inc;
END $
DELIMITER ; 