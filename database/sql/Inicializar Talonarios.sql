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
/*Table structure for table `talonarios` */

DROP TABLE IF EXISTS `talonarios`;

CREATE TABLE `talonarios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ptoventa` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proximodoc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechavto` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `talonarios` */

insert  into `talonarios`(`id`,`tipo`,`ptoventa`,`proximodoc`,`fechavto`,`created_at`,`updated_at`,`deleted_at`) values (1,'REC','1','1','2022-10-24','2022-10-24 10:50:03','2022-10-24 10:50:03',NULL);
insert  into `talonarios`(`id`,`tipo`,`ptoventa`,`proximodoc`,`fechavto`,`created_at`,`updated_at`,`deleted_at`) values (2,'FAC','1','1','2022-10-24','2022-10-24 10:50:53','2022-10-24 10:50:53',NULL);
insert  into `talonarios`(`id`,`tipo`,`ptoventa`,`proximodoc`,`fechavto`,`created_at`,`updated_at`,`deleted_at`) values (3,'CHEQUE','1','1','2022-10-24','2022-10-24 10:52:57','2022-10-24 10:52:57',NULL);
insert  into `talonarios`(`id`,`tipo`,`ptoventa`,`proximodoc`,`fechavto`,`created_at`,`updated_at`,`deleted_at`) values (4,'CUENTA BANCO','1','1','2022-10-24','2022-10-24 10:53:26','2022-10-24 10:53:26',NULL);
insert  into `talonarios`(`id`,`tipo`,`ptoventa`,`proximodoc`,`fechavto`,`created_at`,`updated_at`,`deleted_at`) values (5,'PIEZA','1','1','2022-10-24','2022-10-24 10:53:38','2022-10-24 10:53:38',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
