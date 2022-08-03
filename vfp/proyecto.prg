** Funciones de Configuración
** Dependen del Proyecto
*PROCEDURE Setear
	*SET STEP ON 
cPath = SYS(2003)                                               

	CLOSE DATABASES all
	CLEAR MEMORY
 
	SET PROCEDURE TO conexion addi
	SET PROCEDURE TO funciones ADDITIVE  
	DO CargarObjetos 
*RETURN 	
*ENDPROC 

PROCEDURE Limpiar
	CLOSE DATABASES all
	CLEAR MEMORY 
ENDPROC 

PROCEDURE SetearModoDesarrollo
	SET DATE FRENCH
	SET CENTURY on
	SET DELETED ON
	*SET PATH TO \ConcordeSTD
	SET PATH TO &cPath 
	SET EXCLUSIVE OFF
	SET SAFETY OFF
ENDPROC 
**


**
PROCEDURE CargarObjetos
	*PUBLIC oApp
	PUBLIC oConexion
 

*!*	 
		*oApp=CREATEOBJECT('Sistema')
		oConexion=CREATEOBJECT('Conexion')
		

	
ENDPROC 

