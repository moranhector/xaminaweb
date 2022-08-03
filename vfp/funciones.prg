FUNCTION importar(xCodigo,xPrecio1,xPrecio2,xPrecio3,xPrecio4,xDescrip ,xPrecio1,xPrecio2,xPrecio3,xPrecio4,xSet1,xSet2,xSet3,xSet4 )

		Local	cProveedor 
		Local	cPrecio1
		Local	cPrecio2
		Local	cPrecio3
		Local	cPrecio4						
		LOCAL   cSet1
		LOCAL   cSet2
		LOCAL   cSet3
		LOCAL   cSet4						
		Local	cRubro 
		Local	cCosto 

		cCodigo = fox2my(xcodigo)
		cProveedor = fox2my(1)
		cArtProv = Fox2my(1)
		cDescripcion = fox2my(xDescrip)
		cPrecio1 = fox2my(xPrecio1)
		cPrecio2 = fox2my(xPrecio2)
		cPrecio3 = fox2my(xPrecio3)
		cPrecio4 = fox2my(xPrecio4)
		cSet1    = fox2my(xSet1)						
		cSet2    = fox2my(xSet2)								
		cSet3    = fox2my(xSet3)								
		cSet4    = fox2my(xSet4)								
		cRubro = Fox2my(1)
		cCosto = Fox2my(0)		
		

*!*			cCadena = [Select * from articulos where idarticulo='&cCodigo' ]
*!*			oConexion.ejecutar(cCadena,'buffer')
*!*			
*!*			
*!*			
*!*			IF oConexion.CantidadRegistros = 1
*!*			
*!*					cCadena = [update articulos ]+;
*!*					[precio1 = '&cPrecio1', ]+;
*!*					[precio2 = '&cPrecio2', ]+;				
*!*					[precio3 = '&cPrecio3', ]+;
*!*					[precio4 = '&cPrecio4', ]+;
*!*					[set1 = '&cSet1', ]+;
*!*					[set2 = '&cSet2', ]+;				
*!*					[set3 = '&cSet3', ]+;
*!*					[set4 = '&cSet4', ]+;								
*!*					[prcontado=Precio1,]+;
*!*					[descripcion='&cDescripcion',dtUltCambioPrecio = current_timestamp where idarticulo='&cCodigo' ]
*!*					oConexion.ejecutar(cCadena,'nada')
*!*			ELSE

		
		    cCadena=[insert into articulos ]+;
				    [(Articulo, ]+;
					[idarticulo, ]+;				    
					[Descripcion, ]+;
					[rubro, ]+;
					[Marca, ]+;
					[Prcontado, ]+;
					[Precio2, ]+;
					[Precio3, ]+;
					[Precio4, ]+;
					[costo_ult_comp, ]+;
					[proveedor, ]+;
					[artprov, ]+;					
					[dtalta, ]+;
					[usalta) ]+;
					[values ('&cCodigo',]+;
					['&cCodigo',]+;
					['&cDescripcion',]+;					
					['&crubro',]+;
					[1,]+;   && SIN MARCA
					['&cPrecio1',]+;
					['&cPrecio2',]+;
					['&cPrecio3',]+;
					['&cPrecio4',]+;
  				    ['&ccosto',]+;
					['&cproveedor',]+;
					['&cArtprov',]+;					
					[current_timestamp,]+;
					[user())]
			oConexion.Ejecutar(cCadena,'nada')
				
			&&& Obtener ultimo numero 
			
*!*				oConexion.ejecutar("select LAST_INSERT_ID() as ultimo","ultimo")
*!*				this._articulo = ultimo.ultimo
*!*					
*!*				_carticulo = fox2My(this._articulo)
*!*				IF EMPTY(this._idarticulo)			&&creamos un codigo de barra
*!*					*czarticulo = 	zeros( str(this._articulo),13) && Relleno con ceros para obtener codigo de barra
*!*					czarticulo = _StrToEan13(Right('000000000000'+alltrim(STR(this._articulo)),12),.T.)
*!*					cCadena=[update articulos set idarticulo = '&czarticulo' where articulo='&_cArticulo']
*!*					oConexion.Ejecutar(cCadena,'pa')
*!*				ENDIF 	
		
		
		*endif				
		

RETURN 
***********
FUNCTION RecuperaConfiguracion(oForm)
LOCAL cAlias
LOCAL cNombreFormulario
LOCAL nColumna
LOCAL nAncho
LOCAL cTitulo
LOCAL cSource


***** OJO SI LA GRILLA NO SE LLAMA grid1, siamo Fuori !!!
***** se puede soluciona pasando como parámetro la grilla, y no el formulario

IF !FILE('cfg_col.dbf') && Si no encuentro el archivo de configuracion, chau
	RETURN .f.
ENDIF 
	
	cAlias=ALIAS()
	SELECT 0
	USE cfg_col
	cNombreFormulario = oform.Name 
	SELECT * FROM cfg_col WHERE formulario = cNombreFormulario INTO CURSOR cur_columnas
	USE IN cfg_col && abandono la tabla configuraciones
	SELECT cur_columnas
	IF RECCOUNT() = 0
		RETURN .f. && No hay columnas asignadas a este formulario
	ENDIF 	
	oform.grid1.ColumnCount = RECCOUNT() && la cantidad de filas encontradas son las columnas
										 && a mostrar

	GO TOP 
	DO WHILE !EOF()
		nColumna = ALLTRIM(STR(cur_columnas.columna))
		nAncho   = cur_columnas.Ancho
		cTitulo  = cur_columnas.Titulo
		cSource  = ALLTRIM(cur_columnas.Source)
		
		oForm.grid1.column&nColumna..Width= nAncho
		oform.grid1.column&nColumna..header1.caption= cTitulo
		SELECT(cAlias)
		oform.grid1.column&nColumna..controlSource=cSource
		SELECT cur_columnas 
		skip
	endd
	
	


SELECT(cAlias)

oForm.grid1.Refresh()

RETURN .t.
*********************
FUNCTION GuardaConfiguracion(oForm)
*GUARDAR CONFIGURACION
IF !FILE('cfg_col.dbf')
	RETURN .f.
ENDIF 	

	cAlias=ALIAS()
	SELECT 0
	USE cfg_col
	cNombreFormulario=oform.Name 
	DELETE ALL FOR FORMULARIO = cNombreFormulario
	FOR i= 1 TO oform.grid1.ColumnCount
		nColumna = ALLTRIM(STR(i))
		APPEND BLANK
		Replace formulario WITH cNombreFormulario
		replace columna WITH i
		replace ancho WITH oform.grid1.column&nColumna..width 
		replace titulo WITH oform.grid1.column&nColumna..header1.caption
		replace source WITH oform.grid1.column&nColumna..controlSource		
	
	NEXT  

	USE IN cfg_col && abandono la tabla configuraciones

	SELECT(cAlias)


RETURN .t.

*****************



Function GetDate()
Local dFecha
Do form Frmdate with 'D' to dfecha

Return dFecha

**************
FUNCTION Recontar(cAlias)
LOCAL nCAntidadREgistros
LOCAL nRegistro
nRegistro = RECNO()


COUNT FOR !DELETED() TO nCantidadRegistros

IF nCantidadRegistros = 0
	GO top
else	
	GO nRegistro 
ENDIF 	



RETURN nCantidadREgistros



**************

* VALIDAR CUIT

Function ValidCuit(cCuit)
Local mResto

*cuit=Left(cuit,2)+substr(cuit,4,8)+right(cuit,1) //Le extraigo los guiones
*// Calculo del digito verificador del CUIT
If Val(cCuit) = 0
   Messagebox('El Nro.de CUIT no puede ser 0 (Cero)')
   Return(.f.)
ENDIF
If len(ALLTRIM(cCuit)) # 11
   Messagebox('El Nro. de CUIT debe tener 11 dígitos')
   Return(.f.)
ENDIF

mDigVer = 5 * Val(SubStr(cCuit,1,1)) + ;
           4 * Val(SubStr(cCuit,2,1)) + ;
           3 * Val(SubStr(cCuit,3,1)) + ;
           2 * Val(SubStr(cCuit,4,1)) + ;
           7 * Val(SubStr(cCuit,5,1)) + ;
           6 * Val(SubStr(cCuit,6,1)) + ;
           5 * Val(SubStr(cCuit,7,1)) + ;
           4 * Val(SubStr(cCuit,8,1)) + ;
           3 * Val(SubStr(cCuit,9,1)) + ;
           2 * Val(SubStr(cCuit,10,1))

mResto  = mDigVer % 11    && da el Resto de la Divisi¢n
mDigVer = 11 - mResto

if mDigVer = 11
   mDigVer = 0
endif
if mDigVer = 10
   mDigVer = 1
endif

If Val(SubStr(cCuit,11,1)) # mDigVer
   Messagebox('El Nro.de CUIT no es válido, Dígito verificador '+str(mDigver,1,0))
   Return(.f.)
EndIf
Return(.t.)

&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

*****************************************************
*FUNCIONES.PRG

*Funcion Excel , genera libros de Excel Autores : Victoria Genesy y HAM.

PROCEDURE Excel 
PARAMETERS cTitle 
	LOCAL cAlias
	LOCAL cPantalla
	SAVE screen to cPantalla 
	

	cAlias = ALIAS()
		GO TOP
		 *oConexion.ejecutar(cadenaux,'cur_excel')
		numcampos = AFIELDS(tabla)
		CLEAR
		
				
		 WAIT WINDOWS "Iniciando Excel.." NOWAIT

		 
		 tmpsheet= Getobject('','excel.sheet') 
		 xlapp=TmpSheet.application
		 xlapp.visible=.t.
		 xlapp.WorkBooks.Add()
		 xlsheet= xlapp.Activesheet		
		 
			nFila = 1

		 	xlsheet.Cells(nFila,1).Value=ctitle && titulo

	 
		nFila = nFila + 2
		FOR ncount =1 TO numcampos
		 	xlsheet.Cells(nFila,ncount).Value=tabla(ncount,1)    

		endfor


		 Do while !eof()
		 	nFila=nFila + 1	
		 	cFila=Alltrim(str(nFila))
		 	FOR ncount =1 TO numcampos
			 	campo = tabla(ncount,1)
			    xlsheet.Cells(nFila,ncount).Value= &campo  && poner campos
			endfor
		    
		    
			cLimInf=Alltrim(str(nFila))
			

		    *xlsheet.Cells(nFila,4).Formula="=Sum(B"+cLimInf+":C"+cLimInf+")"    
		 	Skip
		 Endd
		    
			    nFila=nFila + 1
			    cLimInf2=Alltrim(str(nFila))    
			    cAbece = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' && 26 columnas
			    IF numCampos <= 26
				    cLetra = SUBSTR(cAbece,NumCampos,1)    
			    ELSE
			    	nletra = INT(numcampos / 26)
			    	nSegundaLetra=  MOD(numcampos , 26)
				    cLetra = SUBSTR(cAbece,nLetra,1) + SUBSTR(cAbece,nSegundaLetra,1)    			  
			    ENDIF 
			     
			    Rango="A1:"+ cletra + cLimInf2  && cambiar la h porque es la octava letra


	    	   
				
			    Xlsheet.Range(Rango).Select
			    Xlsheet.Application.Selection.Autoformat(1)

			    
			    *if Thisform.checkAutosave.Value=1  
			    *	Xlsheet.Application.Activeworkbook.Saveas(cArchivo)
			    *Endif	

			RELEASE xlapp
			RELEASE tmpsheet
		    RELEASE xlsheet
		SELECT(cAlias)
	RESTORE SCREEN FROM cPantalla		
	ENDPROC






*
*   StrZero( <nNumber>, <nLength>, <nDecimals> ) --> cNumber
*
*   Convert a numeric to a string padded with leading zeros
*
*/
FUNCTION Zeros( n, nLen )

   LOCAL cNumber

   IF TYPE("n")='N'
   		n=ALLTRIM(STR(n))	
   ELSE
   		n=ALLTRIM(n)		
   ENDIF 	

   RETURN ( RIGHT( REPLICATE('0',nLen)+ n ,nLen ))

*****************************************************
*!*	FUNCTION SegundosHora(nSegundos)

*!*	nHoras = INT( nSegundos / 3600 )
*!*	nResto = MOD( nSegundos / 3600 )
*!*	nMinutos = INT( nResto / 60 )
*!*	nSegundos = MOD( nResto / 60 )
*!*	cHora = RIGHT('00'+ALLTRIM(STR(nhoras)),2)

*!*	RETURN

FUNCTION HoraSegundos
RETURN 

**********

*
*  Time.prg
*
*  Sample user-defined functions for manipulating time strings
*
*  Copyright (c) 1993, Computer Associates International Inc.
*  All rights reserved.
*
*  NOTE: Compile with /a /m /n /w
*




*
*  SecondsAsDays( <nSeconds> ) --> nDays
*
*  Convert numeric seconds to days
*
*  NOTE: Same as DAYS() in Examplep.prg

FUNCTION SecondsAsDays( nSeconds )
   RETURN INT(nSeconds / 86400)




*  TimeAsAMPM( <cTime> ) --> cTime
*  Convert a time string to 12-hour format
*
*  NOTE:  Same as AMPM() in Examplep.prg

FUNCTION TimeAsAMPM( cTime )

   IF VAL(cTime) < 12
      cTime = cTime +  " am"
   ELSE 
  
	   	IF VAL(cTime) = 12
	      cTime = cTime +  " pm"
	   	ELSE
	      cTime = STR(VAL(cTime) - 12, 2) + SUBSTR(cTime, 3) + " pm"
	   	ENDIF
   ENDIF 
   RETURN cTime




*  TimeAsSeconds( <cTime> ) --> nSeconds
*  Convert a time string to number of seconds from midnight
*
*  NOTE: Same as SECS() in Examplep.prg

FUNCTION TimeAsSeconds( cTime )
   RETURN VAL(cTime) * 3600 + VAL(SUBSTR(cTime, 4)) * 60 +;
          VAL(SUBSTR(cTime, 7))
          
FUNCTION H2s(cTime)
RETURN TimeAsSeconds(cTime)
          




*  TimeAsString( <nSeconds> ) --> cTime
*  Convert numeric seconds to a time string
*
*  NOTE: Same as TSTRING() in Examplep.prg

FUNCTION TimeAsString( nSeconds )
   RETURN Zeros(INT(Mod(nSeconds / 3600, 24)), 2) + ":" +;
		  Zeros(INT(Mod(nSeconds / 60, 60)), 2) + ":" +;
		  Zeros(INT(Mod(nSeconds, 60)), 2)
*******************************		  
Function S2h(nSeconds) &&& Alias de TimeAsSTring

RETURN TimeAsString(nSeconds)	

FUNCTION HoraDecimal( nSeconds ) && Sirve para ubicar gráficamente posición de horas

nHoras= INT(nSeconds / 3600 )
nMin  = ( ( nSeconds - ( nHoras * 3600 ) ) / 3600)
RETURN nHoras + nMIn
*******************************		  

	  




*  TimeDiff( <cStartTime>, <cEndTime> ) --> cDiffTime
*  Return the difference between two time strings in the form hh:mm:ss
*
*  NOTE: Same as ELAPTIME() in Examplep.prg

FUNCTION TimeDiff( cStartTime, cEndTime )
   RETURN TimeAsString(IiF(cEndTime < cStartTime, 86400 , 0) +;
          TimeAsSeconds(cEndTime) - TimeAsSeconds(cStartTime))




*  TimeIsValid( <cTime> ) --> lValid
*  Validate a time string
*

FUNCTION TimeIsValid( cTime )
   RETURN VAL(cTime) < 24 .AND. VAL(SUBSTR(cTime, 4)) < 60 .AND.;
          VAL(SUBSTR(cTime, 7)) < 60

*****************************************************

FUNCTION Dbf2Mysql(cAlias)

SELECT ( cAlias )

SET ORDER TO 
GO top




DO WHILE !EOF()

	cCadena = [insert into ] + cAlias +[ ( ]

	FOR i = 1 TO FCOUNT( )  && Cantidad de campos
		cCadena = cCadena + FIELD(i) 
		IF i < FCOUNT() && Si no es el ultimo campo
			cCadena = cCadena + [, ]
		ELSE 
			cCadena = cCadena + [) values ( ]
		ENDIF 
	NEXT

	FOR i = 1 TO FCOUNT( )  && Cantidad de campos
	    cField = FIELD(i)
		cCadena = cCadena + Fox2My( &cField ) 
		IF i < FCOUNT() && Si no es el ultimo campo
			cCadena = cCadena + [, ]
		ELSE 
			cCadena = cCadena + [)]
		ENDIF 
	NEXT

  	nError=SQLEXEC(PublicHandle,cCadena)
  	IF nError <0
		AERROR(aErrores)
		MESSAGEBOX(aerrores[1,2])
		SET STEP ON 
		IF !confirma('continua?')
			CANCEL 
		ENDIF 
	endif	
	SELECT ( cAlias )
	Skip
endd



RETURN 
*****************************************************
*****************************************************

FUNCTION str2my(cCadena)
cCadena= ( STRTRAN( ALLTRIM(cCadena),"[","-" ))
cCadena= ( STRTRAN( ALLTRIM(cCadena),"]","-" ))
RETURN ( STRTRAN( ALLTRIM(cCadena),"'","´" ))


*****************************************************

FUNCTION Confirma(cCadena)
n=MESSAGEBOX( cCadena ,4,'Confirmación')

IF n=6
	RETURN .t.
ELSE
	RETURN .f.
ENDIF 

RETURN 
*****************************************************




FUNCTION Fox2My(xVar)
LOCAL cCadena
*C Character o Memo 
*N Numeric, Integer, Float o Double 
*Y Currency 
*L Lógicas 
*O Objeto 
*G General 
*D Fecha 
*T DateTime 
*X Null 
*U Desconocido 
*V Vacío

cTipo=vartype(xVar)
DO case
	CASE cTipo='C'
		*cCadena = [']+Str2My(xVar)+[']
		cCadena = Str2My(xVar)				
	CASE cTipo='N' 

		IF ABS(xVar - INT(xVar)) > 0
		    * decimales
			cCadena = ALLTRIM(STR(xVar,15,2))
		ELSE
			* entero
			cCadena = ALLTRIM(STR(xVar,15,0))		
		ENDIF 
	CASE cTipo='L'
		cCadena = IIF(xVar,'1','0') && IIF(xVar,'TRUE','FALSE')
	CASE cTipo='D'
		*cCadena = ['] +ALLTRIM(STR(YEAR(xVar)))+'-'+ALLTRIM(STR(MONTH(xVar)))+'-'+ALLTRIM(STR(DAY(xVar))) + [']	
		cCadena =  ALLTRIM(STR(YEAR(xVar)))+'-'+ RIGHT('00'+ALLTRIM(STR(MONTH(xVar))),2) +'-'+   RIGHT('00'+ALLTRIM(STR(DAY(xVar))),2)
	CASE ISNULL(xVar)	
		cCadena='' &&NULL 
	CASE EMPTY(xVar)&& cdo traigo una cadena vacía
		cCadena= ''
	OTHERWISE
		cCadena= ''   
		*cCadena=[ERROR]
		
	
ENDCASE 

RETURN cCadena

*________________________________________
FUNCTION Encriptar(cCadena)
LOCAL cCadenaEncriptada
cCadenaEncriptada=''
cCadena=ALLTRIM(cCadena)
FOR i=1 TO LEN(cCadena)
	IF MOD(i,2)=0
	cCadenaencriptada = cCadenaencriptada + CHR(ASC(SUBSTR(cCadena,i,1))+3)
	ELSE
	cCadenaencriptada = cCadenaencriptada + CHR(ASC(SUBSTR(cCadena,i,1))-2)	
	ENDIF 
NEXT 
RETURN cCadenaEncriptada
*________________________________________
FUNCTION DesEncriptar(cCadena)
cCadena= ALLTRIM(cCadena)
LOCAL cCad
cCad=''
FOR i=1 TO LEN(cCadena)
	IF MOD(i,2)=0
	cCad = cCad + CHR(ASC(SUBSTR(cCadena,i,1))-3)
	ELSE
	cCad = cCad + CHR(ASC(SUBSTR(cCadena,i,1))+2)	
	ENDIF 
NEXT 
RETURN cCad
*________________________________________
FUNCTION EscribirCreateTable()
nLong=AFIELDS(aEstru)
cCreacion='create table '+LOWER(ALIAS())
cCreacion = cCreacion + '('
FOR i=1 TO nLong
	cCampo = LOWER(aEstru(i,1))
	cCreacion =  cCreacion + cCampo
	ctipo  = sqltype( aEstru(i,2),aEstru(i,3),aestru(i,4))
	cCreacion = cCreacion + ' '+cTipo+IIF(i<nlong,',','')	
	
NEXT 
cCreacion = cCreacion + ' )'
RETURN cCreacion
*_________________________________________

FUNCTION sqltype( cTipo,nLong,nDec)
 DO case
 	CASE cTipo='C'
 		cSql = 'char('+ALLTRIM(STR(nLong))+')'
 	CASE cTipo='D'
 		cSql = 'date'
 	CASE cTipo='L'
 		cSql = 'int(1)'
 	CASE cTipo='N'
 		IF nDec=0
 				cSql = 'int('+ALLTRIM(STR(nlong))+')'
 		ELSE
 				cSql = 'float('+ALLTRIM(STR(nlong))+','+ALLTRIM(STR(nlong))+')' 		
 		endif		
 	CASE cTipo='M'
 		cSql ='blob'	
		
 		
 ENDCASE 
 
 
 
 
 RETURN cSql
**************************************************** 
FUNCTION mapear 
oNet = CREATEOBJECT('wscript.network')
oNet.MapNetworkDrive('Y:','\\OVA-1\public')
RETURN 
****************************************************
FUNCTION AlgunaConexion
n=AINSTANCE(aConexiones,'conexion') && Carga en la matriz las conexiones
IF n=0
	IF !( "conexion.vcx" $ lower( SET( "CLASSLIB" ) ) )
		SET CLASSLIB TO \clases\conexion.vcx	ADDITIVE 
		
	ENDIF 
	oAlgunaConexion=CREATEOBJECT('conexion')
ELSE
	&& ya existia una conexion abierta, usémosla
	oAlgunaconexion = &aConexiones[1]
ENDIF 
RETURN oAlgunaConexion



&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
DEFINE CLASS EasySearch AS modalform

tablename = ([])  && Table name to search
colwidths = ([])  && Comma-delimited list of the relative widths
colnames = ([])  && Comma-delimited list of field names
orderby  = ([])  && "Order by" column name
colheadings = ([]) && Comma-delimited list if you don't want to use 
*           field names as headings
keyfield = ([])  && Name of key field value to return

PROCEDURE Init
WITH THISFORM
.Caption = [Search form - ] + .Name + [ (Main Table: ] ;
     + TRIM(.TableName)+[) Data access: ] + .Access
NumWords = GETWORDCOUNT(.ColNames,[,])
IF NumWords > 4
  MESSAGEBOX( [This class only supports a maximum of 4 fields, sorry], ;
        16, _VFP.Caption )
  RETURN .F.
ENDIF
FOR I = 1 TO NumWords
  .Field(I)  = GETWORDNUM(.ColNames,  I,[,])
  .Heading(I) = GETWORDNUM(.ColHeadings,I,[,])
  .ColWidth(I)= GETWORDNUM(.ColWidths, I,[,])
ENDFOR
WITH .Grid1
.ColumnCount    = NumWords
.RecordSource    = THISFORM.ViewName
.RecordSourceType  = 1
GridWidth = 0
FOR I = 1 TO NumWords
  .Columns(I).Header1.Caption  =    THISFORM.Heading (I)
   GridWidth = GridWidth     + VAL( THISFORM.ColWidth(I) )
   FldName  = THISFORM.ViewName + [.] + THISFORM.Field  (I)
  .Columns(I).ControlSource   = FldName
ENDFOR
Multiplier = ( THIS.Width / GridWidth ) * .90   && "Fudge" factor
FOR I = 1 TO NumWords
  .Columns(I).Width = VAL( THISFORM.ColWidth(I) ) * Multiplier
ENDFOR
.Refresh
ENDWITH
* Look for any controls named SEARCHn (n = 1, 2, ... )
FOR I = 1 TO .ControlCount
  Ctrl = .Controls(I)
  IF UPPER(Ctrl.Name) = [MYLABEL] && That is, if it starts with "MyLabel"
    Sub = RIGHT(Ctrl.Name,1)      && Determine the index
    IF TYPE([THISFORM.Search]+Sub)=[O] && A search field #"Sub" exists
      Ctrl.Visible = .T.
      Ctrl.Enabled = .T.
      Ctrl.Caption = .Heading(VAL(Sub))
      .SearchFieldCount = MAX ( VAL(Sub), .SearchFieldCount )
    ENDIF
  ENDIF
ENDFOR
.SetAll ( "Enabled", .T. )
ENDWITH
ENDPROC

PROCEDURE Load
WITH THISFORM
IF EMPTY ( .TableName )
  MESSAGEBOX( [Table name not entered], 16, _VFP.Caption )
  RETURN .F.
ENDIF
IF EMPTY ( .ColNames )
  Msg = [ColNames property not filled in.]
  MESSAGEBOX( Msg, 16, _VFP.Caption )
  RETURN .F.
ENDIF
IF EMPTY ( .ColWidths )
  .ColWidths = [1,1,1,1,1]
ENDIF
IF EMPTY ( .ColHeadings )
  .ColHeadings = .ColNames
ENDIF
.Access = oDataTier.AccessMethod
.ViewName = [View] + .TableName
oDataTier.CreateView ( .TableName )
ENDWITH
ENDPROC

PROCEDURE Unload
WITH THISFORM
IF USED  ( .ViewName )
  USE IN ( .ViewName )
ENDIF
RETURN .ReturnValue
ENDWITH
ENDPROC

PROCEDURE cmdShowMatches.Click
WITH THISFORM
Fuzzy = IIF ( THISFORM.Fuzzy.Value = .T., [%], [] )
STORE [] TO Expr1,Expr2,Expr3,Expr4
FOR I = 1 TO .SearchFieldCount
  Fld = [THISFORM.Search] + TRANSFORM(I) + [.Value]
  IF NOT EMPTY ( &Fld )
    LDD = IIF ( VARTYPE( &Fld) = [D],    ;
       IIF ( .Access = [DBF],[{],['] ), ;
       IIF(VARTYPE( &Fld) = [C], ['],[]) )
    RDD = IIF ( VARTYPE( &Fld) = [D],    ;
       IIF ( .Access = [DBF],[}],['] ), ;
       IIF(VARTYPE( &Fld) = [C], ['],[]) )
    Cmp = IIF ( VARTYPE( &Fld) = [C], [ LIKE ],[ = ] )
    Pfx = IIF ( VARTYPE( &Fld) = [C], Fuzzy,  []  )
    Sfx = IIF ( VARTYPE( &Fld) = [C], [%],   []  )
    Exp = [Expr] + TRANSFORM(I)
    &Exp = [ AND UPPER(] + .Field(I) + [)] + Cmp ;
      + LDD + Pfx + UPPER(ALLTRIM(TRANSFORM(EVALUATE(Fld)))) + Sfx + RDD
  ENDIF
ENDFOR
lcExpr = Expr1 + Expr2 + Expr3 + Expr4
IF NOT EMPTY ( lcExpr )
  lcExpr = [ WHERE ] + SUBSTR ( lcExpr, 6 )
ENDIF
lcOrder = IIF(EMPTY(.OrderBy),[],[ ORDER BY ] ;
    + ALLTRIM(STRTRAN(.OrderBy,[ORDER BY],[])))
Cmd   = [SELECT * FROM ] + .TableName + lcExpr + lcOrder
oDataTier.SelectCmdToSQLResult ( Cmd )
SELECT ( .ViewName )
ZAP
APPEND FROM DBF([SQLResult])
GO TOP
.Grid1.Refresh
IF RECCOUNT() > 0
  .cmdSelect.Enabled = .T.
  .Grid1.Visible   = .T.
  .Grid1.Column1.Alignment = 0
  .Caption = [Search Form - ] + PROPER(.Name)  ;
      + [ (] + TRANSFORM(RECCOUNT()) + [ matches)]
 ELSE
  .Caption = [Search Form - ] + PROPER(.Name)
  MESSAGEBOX( "No records matched" )
  .cmdSelect.Enabled = .F.
ENDIF
KEYBOARD [{BackTab}{BackTab}{BackTab}{BackTab}{BackTab}]
ENDWITH
ENDPROC

PROCEDURE cmdClear.Click
WITH THISFORM
FOR I = 1 TO .SearchFieldCount
  Fld = [THISFORM.Search] + TRANSFORM(I) + [.Value]
  IF VARTYPE ( &Fld ) <> [U]
    lVal = IIF ( VARTYPE( &Fld) = [C], [],  ;
        IIF ( VARTYPE( &Fld) = [D], {//}, ;
        IIF ( VARTYPE( &Fld) = [L], .F., ;
        IIF ( VARTYPE( &Fld) $ [IN], 0, [?]))))
    &Fld = lVal
  ENDIF
ENDFOR
ENDWITH
ENDPROC

PROCEDURE cmdSelect.Click
WITH THISFORM
lcStrValue = TRANSFORM(EVALUATE(.KeyField))
.ReturnValue = lcStrValue
.Release
ENDWITH
ENDPROC

PROCEDURE cmdCancel.Click
WITH THISFORM
.ReturnValue = []
.Release
ENDWITH
ENDPROC

ENDDEFINE

	
PROCEDURE SQLToDBF
PARAMETERS TableName

*ConnStr = [dsn=MyCimesa;Server=(192.168.1.217);UID=root;PWD=deve.rene;]
*Handle = SQLSTRINGCONNECT( connstr )
handle = SQLCONNECT('MyCimesa','hector','nichols')
SQLExec ( Handle, [SELECT * FROM ] + TableName )
COPY TO ( TableName )
MessageBox ( [Done], 64, [Table ] + TableName + [ copied from SQL to DBF], 1000 )
ENDPROC

*___________________________________________________________
	
FUNCTION CerrarConexiones()
SQLDISCONNECT(0)
RETURN 




********************
FUNCTION VERSION
PUBLIC mv_vers[32]
*AGETFILEVERSION(mv_vers,SYS(16,0))
AGETFILEVERSION(mv_vers,SYS(16,0))
RETURN mv_vers[11]

******************
FUNCTION contador (ES)
		
		LOCAL cant
		*cant= 0
			cCadena =[select * from movimientos where entsal = '&ES']
			oConexion.Ejecutar(cCadena,'buffer')
			
			*cant=  RECCOUNT('buffer')+1
			
RETURN RECCOUNT('buffer')+1

Function NumaLet
	* Funcion de Numeros a Letras - Parte 1
parameter num, car, cvo 
private sret, scvo, new, temp

if num < 0 .or. num >= 10000000000
	return(alltrim(str(num,20,2)))
endif

car  = iif( pcount() < 2, "", car)
car  = iif( car # "" .and. left(car,1) # " ", " "+car, car)
cvo  = iif( pcount() < 3, .T., cvo)
sret = ""
scvo = substr(str(num,15,2),14,2)
new  = int(num)
temp = int(new/1000000000)				&& Billones
if temp > 0
	sret = sret + Numalet_2(temp)
	sret = sret + "billon" + iif( right(rtrim(sret),3) # "uno", "es ", " ")
	new  = new - (temp * 1000000000)
endif

temp = int(new/1000000)					&& Millones
if temp > 0
	sret = sret + Numalet_2(temp)
	sret = sret + "millon" + iif( right(rtrim(sret),3) # "uno", "es ", " ")
	new  = new - (temp * 1000000)
endif

temp = int(new/1000)					&& Miles
if temp > 0
	sret = sret + iif( temp # 1, Numalet_2(temp), "") + "mil "
	new  = new - (temp * 1000)
endif
sret = sret + Numalet_2(new)				&& Unidades

*		 Chequeos Finales
sret = strtran(sret, "ciento mil", "cien mil",  1, 99)
sret = strtran(sret, "veinte y ",  "veinti",    1, 99)
sret = strtran(sret, "uno billon", "un billon", 1, 99)
sret = strtran(sret, "uno millon", "un millon", 1, 99)
sret = strtran(sret, "uno mil",    "un mil",    1, 99)
sret = iif( empty(sret), "Cero ", sret)
sret = iif( lower(right(sret,4)) = "uno " .and. !empty(car), 		;
	left(sret,len(sret)-2)+" ", sret)
sret = rtrim(sret) + car + iif( cvo, " con " + scvo + "/100", "")
sret = Upper(left(sret,1)) + substr(sret,2)
return(sret)

*	------------------------------------------------------------------

Function Numalet_2
	* Funcion de Numeros a Letras - Parte 2
parameter Xval
private uni, dec, cen, Xstr, new1

uni =       "uno       dos       tres      cuatro    cinco     "
uni = uni + "seis      siete     ocho      nueve     diez      "
uni = uni + "once      doce      trece     catorce   quince    "
uni = uni + "dieciseis diecisietedieciocho diecinueve"
dec =       "veinte    treinta   cuarenta  cincuenta sesenta   "
dec = dec + "setenta   ochenta   noventa   "
cen =       "ciento       doscientos   trescientos  cuatrocientosquinientos   "
cen = cen + "seiscientos  setecientos  ochocientos  novecientos  "
Xstr  = ""

if Xval <= 0
	return("")
endif

if Xval > 99
	new1 = int( Xval / 100 )
	Xstr = Xstr + trim(substr(cen, (new1*13-12),13)) + " "
	Xstr = iif( Xval = 100, "cien ", Xstr)
	Xval = Xval - (new1 * 100)
endif

if Xval > 19
	new1 = int( Xval / 10 ) - 1
	Xstr = Xstr + trim(substr(dec, (new1*10-9),10)) + " "
	new1 = int( Xval / 10 ) * 10
	Xval = Xval - new1
	Xstr = Xstr + iif( Xval > 0, "y ", "")
endif

if Xval > 0
	Xstr = Xstr + trim(substr(uni, (Xval*10-9),10)) + " "
endif

return(Xstr)
 	
FUNCTION NombreMes(nMes)
DO case
	CASE nMes = 1
		cNombreMes = 'Enero'
		
	CASE nMes = 2
		cNombreMes = 'Febrero'
		
	CASE nMes = 3
		cNombreMes = 'Marzo'

	CASE nMes = 4
		cNombreMes = 'Abril'

	CASE nMes = 5
		cNombreMes = 'Mayo'
		
	CASE nMes = 6
		cNombreMes = 'Junio'
		
	CASE nMes = 7
		cNombreMes = 'Julio'
		
	CASE nMes = 8
		cNombreMes = 'Agosto'

	CASE nMes = 9
		cNombreMes = 'Septiembre'

	CASE nMes = 10
		cNombreMes = 'Octubre'

	CASE nMes = 11
		cNombreMes = 'Noviembre'

	CASE nMes = 12
		cNombreMes = 'Diciembre'
		
	OTHERWISE 
		cNombreMes = 'Sin Definir'
		
endcase


RETURN cNombreMes


*****  CODIGOS DE BARRAS
*--------------------------------------------------------------------------
* FUNCTION _StrTo39(tcString)
*--------------------------------------------------------------------------
* Convierte un string para ser impreso con
* fuente True Type Barcode 3 of 9
* USO: _StrTo39("Codigo 39")
* RETORNA: Caracter
* AUTOR: Luis María Guayán
*--------------------------------------------------------------------------
FUNCTION _StrTo39(tcString)
   lcRet = "*"+tcString+"*"
   RETURN lcRet
ENDFUNC

*--------------------------------------------------------------------------
* FUNCTION _StrTo128A(tcString)
*--------------------------------------------------------------------------
* Convierte un string para ser impreso con
* fuente True Type Barcode 128 A
* Caracteres numéricos y alfabéticos (solo mayúsculas)
* Si un caracter es no válido lo reemplaza por espacio
* USO: _StrTo128A("CODIGO 128")
* RETORNA: Caracter
* AUTOR: Luis María Guayán
*--------------------------------------------------------------------------
FUNCTION _StrTo128A(tcString)

   LOCAL lcStart, lcStop, lcRet, lcCheck, ;
      lnLong, lnI, lnCheckSum, lnAsc

   lcStart = CHR(103 + 32)
   lcStop = CHR(106 + 32)
   lnCheckSum = ASC(lcStart) - 32

   lcRet = tcString
   lnLong = LEN(lcRet)
   FOR lnI = 1 TO lnLong
      lnAsc = ASC(SUBS(lcRet,lnI,1)) - 32
      IF NOT BETWEEN(lnAsc, 0, 64)
         lcRet = STUFF(lcRet,lnI,1,CHR(32))
         lnAsc = ASC(SUBS(lcRet,lnI,1)) - 32
      ENDIF
      lnCheckSum = lnCheckSum + (lnAsc * lnI)
   ENDFOR
   lcCheck = CHR(MOD(lnCheckSum,103) + 32)
   lcRet = lcStart + lcRet + lcCheck + lcStop
   *--- Esto es para cambiar los espacios y caracteres invalidos
   lcRet = STRTRAN(lcRet, CHR(32), CHR(232))
   lcRet = STRTRAN(lcRet, CHR(127), CHR(192))
   *---
   RETURN lcRet
ENDFUNC

*--------------------------------------------------------------------------
* FUNCTION _StrTo128B(tcString)
*--------------------------------------------------------------------------
* Convierte un string para ser impreso con
* fuente True Type Barcode 128 B
* Caracteres numéricos y alfabéticos (mayúsculas y minúsculas)
* Si un caracter es no válido lo reemplaza por espacio
* USO: _StrTo128B("Codigo 128")
* RETORNA: Caracter
* AUTOR: Luis María Guayán
*--------------------------------------------------------------------------
FUNCTION _StrTo128B(tcString)

   LOCAL lcStart, lcStop, lcRet, lcCheck, ;
      lnLong, lnI, lnCheckSum, lnAsc

   lcStart = CHR(104 + 32)
   lcStop = CHR(106 + 32)
   lnCheckSum = ASC(lcStart) - 32

   lcRet = tcString
   lnLong = LEN(lcRet)
   FOR lnI = 1 TO lnLong
      lnAsc = ASC(SUBS(lcRet,lnI,1)) - 32
      IF NOT BETWEEN(lnAsc, 0, 99)
         lcRet = STUFF(lcRet,lnI,1,CHR(32))
         lnAsc = ASC(SUBS(lcRet,lnI,1)) - 32
      ENDIF
      lnCheckSum = lnCheckSum + (lnAsc * lnI)
   ENDFOR
   lcCheck = CHR(MOD(lnCheckSum,103) + 32)
   lcRet = lcStart + lcRet + lcCheck + lcStop
   *--- Esto es para cambiar los espacios y caracteres invalidos
   lcRet = STRTRAN(lcRet, CHR(32), CHR(232))
   lcRet = STRTRAN(lcRet, CHR(127), CHR(192))
   *---
   RETURN lcRet
ENDFUNC

*--------------------------------------------------------------------------
* FUNCTION _StrTo128C(tcString)
*--------------------------------------------------------------------------
* Convierte un string para ser impreso con
* fuente True Type Barcode 128 C
* Solo caracteres numéricos
* USO: _StrTo128C("01234567")
* RETORNA: Caracter
* AUTOR: Luis María Guayán
*--------------------------------------------------------------------------
FUNCTION _StrTo128C(tcString)

   LOCAL lcStart, lcStop, lcRet, lcCheck, lcCar,;
      lnLong, lnI, lnCheckSum, lnAsc

   lcStart = CHR(105 + 32)
   lcStop = CHR(106 + 32)
   lnCheckSum = ASC(lcStart) - 32

   lcRet = ALLTRIM(tcString)
   lnLong = LEN(lcRet)
   *--- La longitud debe ser par
   IF MOD(lnLong,2) # 0
      lcRet = "0" + lcRet
      lnLong = LEN(lcRet)
   ENDIF

   *--- Convierto los pares a caracteres
   lcCar = ""
   FOR lnI = 1 TO lnLong STEP 2
      lcCar = lcCar + CHR(VAL(SUBS(lcRet,lnI,2)) + 32)
   ENDFOR
   lcRet = lcCar
   lnLong = LEN(lcRet)

   FOR lnI = 1 TO lnLong
      lnAsc = ASC(SUBS(lcRet,lnI,1)) - 32
      lnCheckSum = lnCheckSum + (lnAsc * lnI)
   ENDFOR
   lcCheck = CHR(MOD(lnCheckSum,103) + 32)
   lcRet = lcStart + lcRet + lcCheck + lcStop
   *--- Esto es para cambiar los espacios y caracteres invalidos
   lcRet = STRTRAN(lcRet, CHR(32), CHR(232))
   lcRet = STRTRAN(lcRet, CHR(127), CHR(192))
   *---
   RETURN lcRet
ENDFUNC

*--------------------------------------------------------------------------
* FUNCTION _StrToEan13(tcString, .T.)
*--------------------------------------------------------------------------
* Convierte un string para ser impreso con
* fuente True Type EAN-13
* PARAMETROS:
*   tcString: Caracter de 12 dígitos (0..9)
*   tlCheckD: .T. Solo genera el dígito de control
*             .F. Genera dígito y caracteres a imprimir
* USO: _StrToEan13("123456789012")
* RETORNA: Caracter
* AUTOR: Luis María Guayán
*--------------------------------------------------------------------------
FUNCTION _StrToEan13(tcString, tlCheckD)

   LOCAL lcLat, lcMed, lcRet, lcJuego, ;
      lcIni, lcResto, lcCod, ;
      lnI, lnCheckSum, lnAux, laJuego(10), lnPri

   lcRet=ALLTRIM(tcString)

   IF LEN(lcRet) # 12
      *--- Error en parámetro
      *--- debe tener un len = 12
      RETURN ""
   ENDIF

   *--- Genero dígito de control
   lnCheckSum=0
   FOR lnI = 1 TO 12
      IF MOD(lnI,2) = 0
         lnCheckSum = lnCheckSum + VAL(SUBS(lcRet,lnI,1)) * 3
      ELSE
         lnCheckSum = lnCheckSum + VAL(SUBS(lcRet,lnI,1)) * 1
      ENDIF
   ENDFOR
   lnAux = MOD(lnCheckSum,10)
   lcRet = lcRet + ALLTRIM(STR(IIF(lnAux = 0, 0, 10-lnAux)))

   IF tlCheckD
      *--- Si solo genero dígito de control
      RETURN lcRet
   ENDIF

   *--- Para imprimir con fuente True Type EAN13
   *--- 1er. dígito (lnPri)
   lnPri = VAL(LEFT(lcRet, 1))
   *--- Tabla de Juegos de Caracteres
   *--- según "lnPri" (¡NO CAMBIAR!)
   laJuego(1) = "AAAAAACCCCCC"   && 0
   laJuego(2) = "AABABBCCCCCC"   && 1
   laJuego(3) = "AABBABCCCCCC"   && 2
   laJuego(4) = "AABBBACCCCCC"   && 3
   laJuego(5) = "ABAABBCCCCCC"   && 4
   laJuego(6) = "ABBAABCCCCCC"   && 5
   laJuego(7) = "ABBBAACCCCCC"   && 6
   laJuego(8) = "ABABABCCCCCC"   && 7
   laJuego(9) = "ABABBACCCCCC"   && 8
   laJuego(10) = "ABBABACCCCCC"   && 9

   *--- Caracter inicial (fuera del código)
   lcIni = CHR(lnPri + 35)
   *--- Caracteres lateral y central
   lcLat = CHR(33)
   lcMed = CHR(45)

   *--- Resto de los caracteres
   lcResto = SUBS(lcRet, 2, 12)
   FOR lnI = 1 TO 12
      lcJuego = SUBS(laJuego(lnPri + 1), lnI, 1)
      DO CASE
         CASE lcJuego = "A"
            lcResto = STUFF(lcResto, lnI, 1, CHR(VAL(SUBS(lcResto, lnI, 1))+48))
         CASE lcJuego = "B"
            lcResto = STUFF(lcResto, lnI, 1, CHR(VAL(SUBS(lcResto, lnI, 1))+65))
         CASE lcJuego = "C"
            lcResto = STUFF(lcResto, lnI, 1, CHR(VAL(SUBS(lcResto, lnI, 1))+97))
      ENDCASE
   ENDFOR

   *--- Armo código
   lcCod = lcIni + lcLat + SUBS(lcResto,1,6) + lcMed + SUBS(lcResto,7,6) + lcLat
   RETURN lcCod
ENDFUNC


*--------------------------------------------------------------------------
* FUNCTION _StrToEan8(tcString, .T.)
*--------------------------------------------------------------------------
* Convierte un string para ser impreso con
* fuente True Type EAN-8
* PARAMETROS:
*   tcString: Caracter de 7 dígitos (0..9)
*   tlCheckD: .T. Solo genera el dígito de control
*             .F. Genera dígito y caracteres a imprimir
* USO: _StrToEan8("1234567")
* RETORNA: Caracter
* AUTOR: Luis María Guayán
*--------------------------------------------------------------------------
FUNCTION _StrToEan8(tcString, tlCheckD)

   LOCAL lcLat, lcMed, lcRet, ;
      lcIni, lcCod, ;
      lnI, lnCheckSum, lnAux

   lcRet=ALLTRIM(tcString)

   IF LEN(lcRet) # 7
      *--- Error en parámetro
      *--- debe tener un len = 7
      RETURN ""
   ENDIF

   *--- Genero dígito de control
   lnCheckSum=0
   FOR lnI = 1 TO 7
      IF MOD(lnI,2) = 0
         lnCheckSum = lnCheckSum + VAL(SUBS(lcRet,lnI,1)) * 1
      ELSE
         lnCheckSum = lnCheckSum + VAL(SUBS(lcRet,lnI,1)) * 3
      ENDIF
   ENDFOR
   lnAux = MOD(lnCheckSum,10)
   lcRet = lcRet + ALLTRIM(STR(IIF(lnAux = 0, 0, 10-lnAux)))

   IF tlCheckD
      *--- Si solo genero dígito de control
      RETURN lcRet
   ENDIF

   *--- Para imprimir con fuente True Type EAN8
   *--- Caracteres lateral y central
   lcLat = CHR(33)
   lcMed = CHR(45)

   *--- Caracteres
   FOR lnI = 1 TO 8
      IF lnI <= 4
         lcRet = STUFF(lcRet, lnI, 1, CHR(VAL(SUBS(lcRet, lnI, 1))+48))
      ELSE
         lcRet = STUFF(lcRet, lnI, 1, CHR(VAL(SUBS(lcRet, lnI, 1))+97))
      ENDIF
   ENDFOR

   *--- Armo código
   lcCod = lcLat + SUBS(lcRet,1,4) + lcMed + SUBS(lcRet,5,4) + lcLat
   RETURN lcCod
ENDFUNC



