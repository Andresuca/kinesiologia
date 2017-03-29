DELIMITER //
	CREATE PROCEDURE stored_listadoKinesiologos(
						IN txtCuales VARCHAR(10) 
						,IN txtPeriodo VARCHAR(8)
						,IN txtAccion VARCHAR(10)
					)
	BEGIN
		CASE txtAccion
			WHEN "actuales" THEN
				SELECT idKinesiologo
					,matricula
					,nombreKinesio
					,apellidoKinesio
				FROM tc_kinesiologo
				WHERE periodo = (SELECT periodo FROM tc_periodos ORDER BY idPeriodo desc LIMIT 0,1)
					AND activo = 1;
			WHEN "especifico" THEN
				SELECT idKinesiologo
					,matricula
					,nombreKinesio
					,apellidoKinesio
					,turno
				FROM tc_kinesiologo
				WHERE idKinesiologo = txtCuales;
		END CASE;
	END //
DELIMITER ;

/* ************************ */
/*
	REGISTRO DE KINESIOLOGOS POR PERIODO 
*/
/* ************************ */

DELIMITER //
	CREATE PROCEDURE stored_accionesKiensiologos(
						IN txtidkinesiologo 	INT(6) 
						,IN txtmatricula 		VARCHAR(12)
						,IN txtnombreKinesio 	VARCHAR(60)
						,IN txtapellidoKinesio	VARCHAR(60)
						,IN txtperiodo 			VARCHAR(6)
						,IN txtactivo			INT(1)
						,IN txtturno			INT(2)
						,IN txtaccion 			VARCHAR(10)
					)
	BEGIN
		CASE txtAccion
			/**  AGREGAMOS UN KINE **/
			WHEN "ingresar" THEN
				INSERT INTO tc_kinesiologo
				VALUES(
					null
					,txtmatricula
					,txtnombreKinesio
					,txtapellidoKinesio
					,txtperiodo
					,1
					,txtturno
				);
				
			/**  EDITAMOS UN KINE **/
			WHEN "actualizar" THEN
				UPDATE tc_kinesiologo
				SET
					matricula = txtmatricula
					,nombreKinesio = txtnombreKinesio
					,apellidoKinesio =txtapellidoKinesio
					,periodo = txtperiodo
					,turno = txtturno
				WHERE idKinesiologo = txtidkinesiologo;

			/**  DAMOS DE BAJA UN KINE **/
			WHEN "baja" THEN
				UPDATE tc_kinesiologo
				SET activo = 0
				WHERE idKinesiologo = txtidkinesiologo;
		END CASE;
	END //
DELIMITER ;
/* ***************************************** */
/*
	desplegado de info de usuarios... 
	totales y específicos ;)
*/
/* ***************************************** */
DELIMITER //
	CREATE PROCEDURE stored_listadoUsuarios(
						IN txtCual INT(6) 
						,IN txtAccion VARCHAR(11)
					)
	BEGIN
		CASE txtAccion
			WHEN "actuales" THEN
				SELECT idUsuario
					,username
					,nombrecompleto
					,rol
				FROM tc_usuarios
				WHERE activo = 1;
			WHEN "especifico" THEN
				SELECT idUsuario
					,username
					,nombrecompleto
					,rol
				FROM tc_usuarios
				WHERE idUsuario = txtCual;
		END CASE;
	END //
DELIMITER ;

/* ************************************** */
/*
	REGISTRO DE USUARIOS PARA EL SISTEMA
*/
/* ************************************** */

DELIMITER //
	CREATE PROCEDURE stored_accionesUsuarios(
						IN txtidusuario 		INT(6) 
						,IN txtusername 		VARCHAR(60)
						,IN txtnombrecompleto 	VARCHAR(60)
						,IN txtpass				VARCHAR(1000)
						,IN txtrol				INT(2)
						,IN txtAccion 			VARCHAR(12)
					)
	BEGIN
		CASE txtAccion
			/**  AGREGAMOS UN usuario nuevo **/
			WHEN "registrar" THEN
				INSERT INTO tc_usuarios
				VALUES(
					null
					,txtusername
					,txtnombrecompleto
					,AES_ENCRYPT(txtpass,'UCUAUHTE-2017')
					,txtrol
					,1
				);
				
			/**  EDITAMOS UN USUARIO **/
			WHEN "actualizar" THEN
				UPDATE tc_usuarios
				SET
					username = txtusername
					,nombrecompleto = txtnombrecompleto
					,pass = AES_ENCRYPT(txtpass,'UCUAUHTE-2017')
					,rol = txtrol
				WHERE idUsuario = txtidusuario;

			/**  DAMOS DE BAJA UN USUARIO **/
			WHEN "baja" THEN
				UPDATE tc_usuarios
				SET activo = 0
				WHERE idUsuario = txtidusuario;

			WHEN "login" THEN
				SELECT idUsuario
					,nombrecompleto
					,rol
				FROM tc_usuarios
				WHERE username = txtusername
					AND pass = AES_ENCRYPT(txtpass,'UCUAUHTE-2017')
					AND activo =  1;
		END CASE;
	END //
DELIMITER ;


