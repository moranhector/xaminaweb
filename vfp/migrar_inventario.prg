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
	

	
	
	

	  
	      cid = fox2my( cur.inventario )
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
        cprecio = fox2my( cur.precio )
        cprecio_at = fox2my(  cur.fechadesde  )
 
   
    IF   cur.fechahasta <= CTOD('31/12/2012')   && para piezas vendias hace mas de 10 años las salteo
    
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
       ['&cvendido_at', ]+;
       ['&cprecio', ]+;
       ['&cprecio_at', CURRENT_DATE ) ]
       
       
       

 
*!*			oConexion.ejecutar(cCadena, 'buffer')  
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
             IF EMPTY( cur.factura )
	             ctiposalida  = fox2my( null )
	             cdocumento_sal	   = fox2my( null )
	             cfecha_hasta	 = fox2my( null )
	         else    
	             ctiposalida  = 'FAC'	             
    	         cdocumento_sal	= cur.factura	                          
             	cfecha_hasta   = cvendido_at 	         
	         endif    


             cusuario_name = 'migracion'


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
		  

			oConexion.ejecutar(cCadena, 'buffer')  
			
  endif

  
  
  

	SELECT cur
	skip
endd 

MESSAGEBOX('migracion inventario  TERMINADA ')
CLOSE ALL



 

