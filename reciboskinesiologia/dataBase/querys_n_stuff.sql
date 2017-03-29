DELIMITER //
	CREATE PROCEDURE stored_getPrecio(
						IN txtPaciente INT(6)
						,IN txtTerapia INT(6)
					)
	BEGIN
		SELECT costo
		FROM tc_precio_terapiayservicio
		WHERE 	idTipoPaciente = txtPaciente AND idTerapia = txtTerapia;
	END //
DELIMITER ;
DELIMITER //
	CREATE PROCEDURE stored_getCostoTerapia(
						IN txtPaciente INT(6)
						,IN txtTerapia INT(6)
					)
	BEGIN
		SELECT costo
		FROM tc_precio_terapiayservicio
		WHERE 	idTipoPaciente = txtPaciente AND idTerapia = txtTerapia;
	END //
DELIMITER ;
DELIMITER //
	CREATE PROCEDURE stored_insRecibo(
			IN txtNombrePaciente VARCHAR(150)
			,IN txtFechaRegistro DATE
			,IN txtDomicilio VARCHAR(150)
			,IN	txtTelefono VARCHAR(13)
			,IN txtFechaProxSesion DATE
			,IN	txtHoraProxSesion TIME
			,IN txtNoVista INT
			,IN	txtIdTipoPaciente INT
			,IN txtTerapias VARCHAR(10)
			,IN txtCostototal INT
			,IN txtAlumno VARCHAR(150)
		)
	BEGIN
		INSERT INTO tr_recibos
		VALUES(
			null
			,txtNombrePaciente
			,txtFechaRegistro 
			,txtDomicilio 
			,txtTelefono
			,txtFechaProxSesion 
			,txtHoraProxSesion
			,txtAlumno
			,txtNoVista 
			,txtIdTipoPaciente 
			,txtTerapias
			,txtCostototal
		);
	END //
DELIMITER ;
DELIMITER //
	CREATE PROCEDURE stored_getRecibosDeDia(
			IN txtFechaRegistro DATE
		)
	BEGIN
		SELECT idRecibo, nombrePaciente, fecharegistro, fecha_prox_sesion,alumno
		FROM tr_recibos
		WHERE fecharegistro = txtFechaRegistro
		ORDER BY idRecibo DESC;
	END //
DELIMITER ;
