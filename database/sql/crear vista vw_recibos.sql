
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `xaminaweb`.`vw_recibos` 
    AS
(SELECT r.id, r.formulario, r.fecha, r.artesano_id, a.nombre, r.total, r.cheque_id, ch.numero, r.rendido FROM recibos r
INNER JOIN artesanos  a 
ON r.artesano_id = a.id 
INNER JOIN cheques ch
ON r.cheque_id = ch.id
);
