*MIGRAR XAMINA

 
CLOSE ALL
SET STEP ON 
DO proyecto 

cCadena = 'select * from xamina.artesanos order by artesano'
oConexion.ejecutar(cCadena,'cur_artesanos')
SELECT cur_artesanos
BROWSE
GO top

DO WHILE !EOF()
	SELECT cur_artesanos
  artesano   = fox2my( cur_artesanos.artesano )
  Cnombre    = fox2my( cur_artesanos.nombre )
  Cdocumento = fox2my( cur_artesanos.documento )
  Cdireccion = fox2my( cur_artesanos.direccion )
  clugar     = fox2my( cur_artesanos.lugar )
  cdepartamento = fox2my( cur_artesanos.dpto )
  cnacimiento_at = fox2my( cur_artesanos.nacimiento )
  csexo	= fox2my( cur_artesanos.sexo )
  
  
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
[VALUES ( NULL, ]+;
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

MESSAGEBOX('TERMINADO ')
CLOSE ALL



 

