*MIGRAR INVENTARIO PIEZAS

 
CLOSE ALL
SET STEP ON 
DO proyecto 

cCadena = 'truncate table xaminaweb.inventarios'
oConexion.ejecutar(cCadena,'buffer')

cCadena = 'truncate table xaminaweb.existencias'
oConexion.ejecutar(cCadena,'buffer')


cCadena = 'select * from xamina.inventario order by precio'
oConexion.ejecutar(cCadena,'cur')


SELECT cur

 
*BROWSE
GO top

DO WHILE !EOF()
	SELECT cur
	
 
	  
	    cid = fox2my( cur.npieza )
	    

        ccodigo12 = fox2my(   cur.codigo12 )
        ctipopieza_id = fox2my( cur.codprecio   )
        
        cnpieza = fox2my( cur.npieza   )
        cnamepieza = fox2my( cur.namepieza   )
        ccomprob = fox2my( cur.comprob    )
        crecibo_id = fox2my( 1 )
        cfactura = fox2my( cur.factura   )
        cfactura_id = fox2my( 1   )
        ccosto = fox2my( cur.costo   )
        crecargo = fox2my( cur.recargo )
        cartesano_id = fox2my( cur.nartesano   )
        ccomprado_at = fox2my( cur.fechadesde   )
        
        cvendido_at = fox2my( cur.fechahasta   )
        
        *2604-12-03 000500000063 2019-08-03
        * REEMPLAZO DE FECHAS INCORRECTAS
        IF cvendido_at='9202-08-25' 
        	cVendido_at = '2022-08-25' 
        ENDIF
        IF cvendido_at='2604-12-03' 
        	cVendido_at = '2019-08-03' 
        endif
        
        
               *CFECHA_HASTA 
       CFECHA_HASTA = iif( ISNULL( cur.fechahasta) , " NULL , " , "'&cvendido_at', " )
               
        cprecio = fox2my( cur.precio )
        cprecio_at = fox2my(  cur.fechadesde  )
 
   
    IF   cur.fechahasta <= CTOD('31/12/2012')   && para piezas vendidas hace mas de 10 a�os las salteo
    
    	SELECT cur
    	SKIP
    	loop
    endif
	  
	  
	  
	  
	  
cCadena = [ INSERT INTO xaminaweb.inventarios ]+;
          [  (id, ]+;
          [   codigo12, ]+;
          [ tipopieza_id, ]+; 
          [ npieza,       ]+;
          [ namepieza,]+;
          [ comprob,]+;
          [ recibo_id,]+;
          [ factura,]+;
          [ factura_id,]+;
          [ costo,]+;
          [ recargo,]+;
          [ artesano_id,]+;
          [ comprado_at,]+;
          [ vendido_at,]+;
          [ precio,]+;
          [ precio_at,]+;
          [ created_at )]+;
       [ VALUES ('&cid',     ]+;
       ['&ccodigo12',]+;
       ['&ctipopieza_id', ]+;
       ['&cnpieza', ]+;
       ['&cnamepieza', ]+;
       ['&ccomprob', ]+;
       ['&crecibo_id', ]+;
       ['&cfactura', ]+;
       ['&cfactura_id', ]+;
       ['&ccosto', ]+;
       ['&crecargo', ]+;
       ['&cartesano_id', ]+;
       ['&ccomprado_at', ]+;
       CFECHA_HASTA +;
       ['&cprecio', ]+;
       ['&cprecio_at', CURRENT_DATE ) ]
       
       
       

 
			oConexion.ejecutar(cCadena, 'buffer')  
*!*			
*!*			
*!*					&&& Obtener ultimo numero 
*!*					oConexion.ejecutar("select LAST_INSERT_ID() as ultimo","ultimo")
*!*					cInventario_id = ultimo.ultimo
				

			

 IF ISNULL(cur.fechahasta ) OR cur.fechahasta > CTOD('31/12/2012') && si es una pieza en existencia, le creo deposito		
 
 

             cinventario_id= cid
             ctipodoc = 'RECIBO'
             cdocumento = Ccomprob
             cdeposito_id = fox2my( 1 )
             cfecha_desde = ccomprado_at
             IF EMPTY( cur.factura )   && SI NO ESTA VENDIDA NO GRABO LOS CAMPOS DE FACTURA, FECHA DE SALIDA, ETC.
             
	             ctiposalida  = fox2my( null )
	             cdocumento_sal	   = fox2my( null )
	             cfecha_hasta	 = fox2my( null )
	             
				cCadena = [ INSERT INTO xaminaweb.existencias ]+;
				          [  (id, ]+;
				          [   Inventario_id, ]+;
				          [ tipodoc, ]+; 
				          [ documento, ]+; 
				          [ deposito_id, ]+; 			          
				          [ fecha_desde,       ]+;
				          [ created_at )]+;
					      [ VALUES ('&cid', ]+;
					      [ '&cInventario_id',]+;
	     				  [ '&ctipodoc', ]+; 
				          [ '&cdocumento', ]+; 
				          [ '&cdeposito_id', ]+; 			          
				          [ '&cfecha_desde', ]+;
				          [ CURRENT_DATE )]			             
	             
	             
	         else    
	             ctiposalida  = 'FAC'	             
    	         cdocumento_sal	= cur.factura	                          
             	cfecha_hasta   = cvendido_at 	         
             	

				cCadena = [ INSERT INTO xaminaweb.existencias ]+;
				          [  (id, ]+;
				          [   Inventario_id, ]+;
				          [ tipodoc, ]+; 
				          [ documento, ]+; 
				          [ deposito_id, ]+; 			          
				          [ fecha_desde,       ]+;
				          [ tiposalida,]+;
				          [ documento_sal,]+;
				          [ fecha_hasta,]+;
				          [ created_at )]+;
					      [ VALUES ('&cid', ]+;
					      [ '&cInventario_id',]+;
	     				  [ '&ctipodoc', ]+; 
				          [ '&cdocumento', ]+; 
				          [ '&cdeposito_id', ]+; 			          
				          [ '&cfecha_desde', ]+;
				          [ '&ctiposalida',]+;
				          [ '&cdocumento_sal',]+;
				          [ '&cfecha_hasta',]+;
				          [ CURRENT_DATE )]		              	
             	
	         endif    


             cusuario_name = 'migracion'


	       
		  

			oConexion.ejecutar(cCadena, 'buffer')  
			
  endif

  
  
  

	SELECT cur
	skip
endd 

MESSAGEBOX('migracion inventario  TERMINADA ')
CLOSE ALL



 

