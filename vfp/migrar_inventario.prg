*MIGRAR INVENTARIO PIEZAS

 
CLOSE ALL
*SET STEP ON 
DO proyecto 

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

 
  
  

oConexion.ejecutar(cCadena, 'buffer')  
  
  
  

	SELECT cur
	skip
endd 

MESSAGEBOX('tipopiezas TERMINADO ')
CLOSE ALL



 

