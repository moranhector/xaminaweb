/*
SQLyog Ultimate v9.02 
MySQL - 5.5.5-10.4.24-MariaDB : Database - xaminaweb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `rubros` */

DROP TABLE IF EXISTS `rubros`;

CREATE TABLE `rubros` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `descrip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `rubros` */

insert  into `rubros`(`id`,`descrip`,`created_at`,`updated_at`,`deleted_at`) values (1,'CUERO','2022-10-24 18:48:45','2022-10-24 18:48:45',NULL);
insert  into `rubros`(`id`,`descrip`,`created_at`,`updated_at`,`deleted_at`) values (2,'TEJIDO','2022-10-24 18:48:55','2022-10-24 18:48:55',NULL);
insert  into `rubros`(`id`,`descrip`,`created_at`,`updated_at`,`deleted_at`) values (3,'CESTERIA','2022-10-24 18:49:09','2022-10-24 18:49:09',NULL);
insert  into `rubros`(`id`,`descrip`,`created_at`,`updated_at`,`deleted_at`) values (4,'OTROS MATERIALES','2022-10-24 18:49:20','2022-10-24 18:49:20',NULL);
insert  into `rubros`(`id`,`descrip`,`created_at`,`updated_at`,`deleted_at`) values (5,'CERAMICA','2022-10-24 18:49:32','2022-10-24 18:49:32',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
