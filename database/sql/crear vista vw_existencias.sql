
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `xaminaweb`.`vw_existencias` 
    AS
(SELECT e.id, e.inventario_id,i.npieza, i.namepieza,i.tipopieza_id,t.descrip, e.deposito_id , d.nombre,
e.documento, e.fecha_desde, e.documento_sal , e.fecha_hasta
FROM existencias e
INNER JOIN inventarios i
ON e.inventario_id= i.id
INNER JOIN tipopiezas t
ON i.tipopieza_id= t.id
INNER JOIN depositos d
ON e.deposito_id = d.id );
