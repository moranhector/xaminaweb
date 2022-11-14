SELECT r.id, r.formulario, r.fecha, r.total, r.rendido, r.created_at, r.user_name, r.artesano_id, r.cheque_id, ch.numero,
a.nombre,
l.tipopieza_id, l.cantidad, l.preciounit, t.descrip  FROM recibos r
INNER JOIN artesanos a 
ON r.artesano_id = a.id
INNER JOIN recibos_lineas l
ON r.id = l.recibo_id
INNER JOIN tipopiezas t
ON l.tipopieza_id = t.id
INNER JOIN cheques ch
ON r.cheque_id = ch.id 