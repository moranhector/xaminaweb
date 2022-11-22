SELECT i.id,i.codigo12,i.npieza, i.namepieza,i.tipopieza_id,t.descrip,i.precio,i.costo, i.comprado_at, d.nombre AS deposito, i.vendido_at  FROM inventarios i     
        INNER JOIN tipopiezas t
        ON i.tipopieza_id = t.id 
        INNER JOIN existencias e
        ON e.inventario_id = i.id
        INNER JOIN depositos d
        ON e.deposito_id = d.id
        WHERE        
        comprado_at <= '2022-11-22'
        AND ( vendido_at IS NULL OR vendido_at > '2022-11-22' ) AND  ( e.fecha_hasta < '2022-11-22'   OR e.fecha_hasta IS NULL )  ;

-- INVENTARIO ACTUAL        
SELECT i.id,i.codigo12,i.npieza, i.namepieza,i.tipopieza_id,t.descrip,i.precio,i.costo, i.comprado_at, d.nombre AS deposito, i.vendido_at, e.fecha_desde,e.	  	fecha_hasta FROM inventarios i     
        INNER JOIN tipopiezas t
        ON i.tipopieza_id = t.id 
        INNER JOIN existencias e
        ON e.inventario_id = i.id
        INNER JOIN depositos d
        ON e.deposito_id = d.id
        WHERE        
  ( e.fecha_hasta IS NULL ) ;
  
SELECT * FROM INVENTARIOS WHERE VENDIDO_AT IS NULL ;
  
  
-- INVENTARIO A FECHA : 2022-11-21


SELECT i.id,i.codigo12,i.npieza, i.namepieza,i.tipopieza_id,t.descrip,i.precio,i.costo, i.comprado_at, d.nombre AS deposito, i.vendido_at ,
e.fecha_desde,e.fecha_hasta
  FROM inventarios i     
        INNER JOIN tipopiezas t
        ON i.tipopieza_id = t.id 
        INNER JOIN existencias e
        ON e.inventario_id = i.id
        INNER JOIN depositos d
        ON e.deposito_id = d.id
        WHERE        
        comprado_at <= '2022-11-21'
        AND ( vendido_at IS NULL OR vendido_at > '2022-11-22' ) AND  ( e.fecha_hasta <= '2022-11-22'   XOR e.fecha_hasta IS NULL )  ;

  
-- Primero quiero saber si está inventario a esa fecha, sin pregunar por depósito.

SET @fecha = '2022-11-22' ;

SELECT i.id,i.codigo12,i.npieza, i.namepieza,i.tipopieza_id,t.descrip,i.precio,i.costo, i.comprado_at,  i.vendido_at ,
d.nombre AS deposito, e.fecha_desde,e.fecha_hasta  
  FROM inventarios i     
        INNER JOIN tipopiezas t
        ON i.tipopieza_id = t.id 
       INNER JOIN existencias e
        ON e.inventario_id = i.id
        INNER JOIN depositos d
        ON e.deposito_id = d.id        
        WHERE        
        comprado_at <= @fecha
        AND ( vendido_at IS NULL OR vendido_at > @fecha ) 
	 AND  ( e.fecha_desde<= @fecha AND e.fecha_hasta IS NULL  )  
	 ;
        
        
        
        
        

