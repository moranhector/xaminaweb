#INCLUDE EMPRESA.H 
**************************************************
*-- Class:        conexion (c:\musica\conexion.vcx)
*-- ParentClass:  container
*-- BaseClass:    container
*-- Marca de hora:   10/23/06 05:20:05 PM
*
DEFINE CLASS conexion AS custom



	handle = 0
	nerror = 0
	dsname = "xaminaweb" &&NOMBRE_ODBC
	Name = "conexion"
	*Atencion, cambiar tambien en frm_login para validar que este el servicio
	usuario = .F.
	password = .F.
	CantidadRegistros = 0




	PROCEDURE ejecutar
		PARAMETERS cCadena,cCursor
		LOCAL cPrograma 
		LOCAL nRegistros


		IF USED(cCursor)
			SELECT &cCursor
			USE 
		ENDIF 
	
		nRetardo = SECONDS()
		this.nerror = SQLEXEC(this.handle,cCadena,cCursor)
		*MESSAGEBOX('registros afectados: '+STR(this.nerror) )
		nRetardo = SECONDS() - nRetardo

		IF USED(ccursor) 
			nRegistros = RECCOUNT(cCursor)
			this.CantidadRegistros = nRegistros
		ELSE 
			nregistros = 0
			this.CantidadRegistros = 0
		ENDIF 

		STORE 1 TO gnX
		DO WHILE LEN(SYS(16,gnX)) != 0
		   cPrograma=  SYS(16,gnX)
		   STORE gnX+1 TO gnX
		ENDDO
		cPrograma=  SYS(16,gnX - 2)
		cPrograma =   LEFT( STRTRAN(cPrograma,'PROCEDURE ','') + SPACE(70) , 70 )


		IF this.nError <0
			AERROR(aErrores)

			MESSAGEBOX(aerrores[1,2])
			STRTOFILE(cCadena,'log_sql.txt',.f.)
			SET STEP ON 
		endif
		SET DATE FRENCH
		SET CENTURY ON 

			STRTOFILE(CHR(13)+CHR(10)+cPrograma +LEFT(DTOC(DATE()),5)+TIME()+'['+STR(nRetardo,5,2)+'] '+'['+STR(nregistros,5,0)+'] '+cCadena ,'log_sql.txt',1)
	ENDPROC


	PROCEDURE Destroy
		SQLDISCONNECT(this.handle)
	ENDPROC
    PROCEDURE Probar
    	This.ejecutar('select * from ordenes limit 1','PRUEBA')
    	SELECT PRUEBA
    	BROWSE
    	USE IN prueba
    ENDPROC 

	PROCEDURE Init
		LOCAL cUsuario,cPassword
		SET PROCEDURE TO funciones.prg ADDITIVE 

		nUsuarios=AINSTANCE(gaMyArray, 'usuario') 
		IF nUsuarios = 0 && No se loguearon / modo de prueba
			this.Usuario='root'
			this.Password='013042'
		ELSE
			this.Usuario=oUsuario.nombre
			this.Password=oUsuario.password
		ENDIF 
		******************************* Reutilizar conexiones si existen
		*SET STEP ON 
		*IF TYPE('PUBLICHANDLE')<>'U' .and. PUBLICHANDLE<> -1

			&& ya existia una conexion abierta, usémosla

		*	this.handle = PUBLICHANDLE


		*else

			this.handle = SQLCONNECT(this.dsname,this.Usuario,this.Password)
			PUBLIC PUBLICHANDLE 
			PUBLICHANDLE = this.handle

		*ENDIF 
		IF this.Handle < 0
			AERROR(aErrores)
			MESSAGEBOX('No se pudo conectar: '+aerrores[1,2])
			QUIT
		Endif
	ENDPROC


ENDDEFINE
*
*-- EndDefine: conexion
**************************************************

****************************************************
FUNCTION AlgunaConexion
n=AINSTANCE(aConexiones,'conexion') && Carga en la matriz las conexiones
IF n=0
	IF !( "conexion" $ lower( SET( "PROCEDURE" ) ) )
		SET CLASSLIB TO conexion.prg	ADDITIVE 
		
	ENDIF 
	oAlgunaConexion=CREATEOBJECT('conexion')
ELSE
	&& ya existia una conexion abierta, usémosla
	oAlgunaconexion = &aConexiones[1]
ENDIF 
RETURN oAlgunaConexion


