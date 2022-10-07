*MIGRAR XAMINA

 
CLOSE ALL
 
DO proyecto 

cCadena = 'truncate table xaminaweb.artesanos'
oConexion.ejecutar(cCadena,'buffer')

cCadena = 'select * from xamina.artesanos order by artesano'
oConexion.ejecutar(cCadena,'cur_artesanos')
SELECT cur_artesanos
*BROWSE
GO top

DO WHILE !EOF()
	SELECT cur_artesanos
  artesano   = fox2my( cur_artesanos.artesano )
  Cnombre    = fox2my( cur_artesanos.nombre )
  Cdocumento = fox2my( cur_artesanos.documento )
  cDocumento = STRTRAN(cdocumento,'.','')
  Cdireccion = fox2my( cur_artesanos.direccion )
  clugar     = fox2my( cur_artesanos.lugar )
  IF EMPTY(cLugar)
  	cLugar = cDireccion
  endif
  cdepartamento = fox2my( cur_artesanos.dpto )
  cnacimiento_at = fox2my( cur_artesanos.nacimiento )
  csexo	= fox2my( cur_artesanos.sexo )
  cid = fox2my( cur_artesanos.artesano )
  
cCadena = [INSERT INTO xaminaweb.artesanos ]+;
           [ (id, ]+;
           [  nombre, ]+;
           [  documento, ]+;
           [  direccion, ]+;
           [  lugar, ]+;     
           [  departamento, ]+;                      
           [  nacimiento_at, ]+;                                 
           [  sexo, ]+;                                            
           [  created_at, ]+;
           [  updated_at, ]+;
           [  deleted_at) ]+;
[VALUES ( '&cid', ]+;
 		   ['&Cnombre', ]+;
		   ['&Cdocumento', ]+;
           ['&Cdireccion', ]+;
           ['&Clugar', ]+;   
           ['&Cdepartamento', ]+;  
           [ '&cnacimiento_at', ]+;   
           [ '&csexo', ]+;                                   
           [ CURRENT_DATE , ]+;
		   [ NULL, ]+;
           [ NULL ) ]  

oConexion.ejecutar(cCadena, 'buffer')  
  
  
  

	SELECT cur_artesanos
	skip
endd 

MESSAGEBOX('artesanos TERMINADO ')
CLOSE ALL



 

