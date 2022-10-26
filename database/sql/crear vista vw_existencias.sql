DELIMITER $$

USE `xaminaweb`$$

DROP VIEW IF EXISTS `vw_existencias`$$

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_existencias` AS (
SELECT
  `e`.`id`            AS `id`,
  `e`.`inventario_id` AS `inventario_id`,
  `i`.`npieza`        AS `npieza`,
  `i`.`codigo12`      AS `codigo12`,  
  `i`.`namepieza`     AS `namepieza`,
  `i`.`tipopieza_id`  AS `tipopieza_id`,
  `t`.`descrip`       AS `descrip`,
  `e`.`deposito_id`   AS `deposito_id`,
  `d`.`nombre`        AS `nombre`,
  `e`.`documento`     AS `documento`,
  `e`.`fecha_desde`   AS `fecha_desde`,
  `e`.`documento_sal` AS `documento_sal`,
  `e`.`fecha_hasta`   AS `fecha_hasta`
FROM (((`existencias` `e`
     JOIN `inventarios` `i`
       ON (`e`.`inventario_id` = `i`.`id`))
    JOIN `tipopiezas` `t`
      ON (`i`.`tipopieza_id` = `t`.`id`))
   JOIN `depositos` `d`
     ON (`e`.`deposito_id` = `d`.`id`)))$$

DELIMITER ;