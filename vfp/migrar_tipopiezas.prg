*MIGRAR XAMINA

 
CLOSE ALL
*SET STEP ON 
DO proyecto 

cCadena = 'select * from xamina.precios order by precio'
oConexion.ejecutar(cCadena,'cur')
SELECT cur
*BROWSE
GO top

DO WHILE !EOF()
	SELECT cur
	
	  cprecio   = fox2my( cur.precio )
	  cinsumo   = fox2my( cur.codigo )
	  crubro_id = fox2my( cur.rubro )  
	  cprecio   = fox2my( cur.compra )  
	  Cdescrip  = fox2my( cur.nombrepieza )
	  Ctecnica  = fox2my( cur.tecnica )  
  
  
  
cCadena = [ INSERT INTO xaminaweb.tipopiezas]+;
          [ (id,]+;
          [ descrip,]+;
          [ tecnica,]+;
          [ rubro_id,]+;
          [ precio,]+;
          [ insumo,]+;
          [ created_at )]+;
	[ VALUES ( null,]+;
    [ '&Cdescrip',]+;
    [ '&Ctecnica',]+;
    [ '&Crubro_id',]+;
    [ '&Cprecio',]+;
    [ '&Cinsumo',]+;
    [ CURRENT_DATE ) ]
  
  

oConexion.ejecutar(cCadena, 'buffer')  
  
  
  

	SELECT cur
	skip
endd 

MESSAGEBOX('tipopiezas TERMINADO ')
CLOSE ALL



 

