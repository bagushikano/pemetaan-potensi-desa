/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.11-MariaDB : Database - db_tubes_sig
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_tubes_sig` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_tubes_sig`;

/*Table structure for table `tb_admin` */

DROP TABLE IF EXISTS `tb_admin`;

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_admin` */

insert  into `tb_admin`(`id`,`nama`,`email`,`password`,`created_at`,`deleted_at`) values 
(1,'duar','agungwiryadika45@gmail.com','$2y$10$US2QSXYtzOHY5Gobvm3QMe8krVEbrhRS1HJIdtC8w07d1I.K9o1Ii','2021-05-27 16:47:44',NULL);

/*Table structure for table `tb_agama` */

DROP TABLE IF EXISTS `tb_agama`;

CREATE TABLE `tb_agama` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agama` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_agama` */

insert  into `tb_agama`(`id`,`agama`) values 
(1,'Hindu'),
(2,'Kristen'),
(3,'Budha'),
(4,'Islam');

/*Table structure for table `tb_desa` */

DROP TABLE IF EXISTS `tb_desa`;

CREATE TABLE `tb_desa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `colour` varchar(27) DEFAULT NULL,
  `area` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_desa` */

insert  into `tb_desa`(`id`,`nama`,`colour`,`area`,`created_at`,`deleted_at`,`updated_at`) values 
(22,'Peguyangan',NULL,'[[-8.634994619771751,115.21046377057473],[-8.635249193043895,115.2125243823463],[-8.634824904161547,115.21406984117502],[-8.634485472712138,115.2151001470608],[-8.634315756872931,115.2158372385921],[-8.634421829281388,115.21697486800765],[-8.635079477548217,115.21667436212431],[-8.635143120868053,115.21879936801375],[-8.631006282752285,115.21914280330903],[-8.628990883655046,115.21927169705226],[-8.628906024509645,115.21819846175455],[-8.62413266687652,115.21827734557206],[-8.623962946383424,115.21698946321483],[-8.618871296142247,115.21827734557206],[-8.615307100163749,115.21913593381022],[-8.613440126958062,115.21922179263403],[-8.610979102743979,115.21716118086243],[-8.610809376346007,115.21518642791467],[-8.609027244570857,115.21492885144326],[-8.607669424252109,115.21364096908603],[-8.607245104403535,115.21106520437154],[-8.607669424252109,115.20917631024759],[-8.609960743214124,115.20883287495234],[-8.613100676294197,115.2079742867142],[-8.614373614712916,115.20677226318077],[-8.617004340534365,115.20685812200456],[-8.618871296142247,115.20660054553315],[-8.620483659474209,115.20599953376643],[-8.622435458514712,115.20737327494749],[-8.62455696777564,115.20720155729983],[-8.62455696777564,115.2052268043521],[-8.626678465122032,115.20548438082352],[-8.628545372928912,115.20577768406007],[-8.63020012440452,115.2053054605291],[-8.630666847868333,115.20599233111963],[-8.63083656534845,115.20697970759348],[-8.631600293064718,115.20702263700541],[-8.632024585572697,115.20826758995072],[-8.633552034651823,115.20891153112935],[-8.633806608897267,115.2103282017223],[-8.63491506558897,115.21045408434483],[-8.634957494488539,115.2104272534624]]','2021-06-04 00:20:51',NULL,'2021-06-04 00:20:51');

/*Table structure for table `tb_jenis_potensi` */

DROP TABLE IF EXISTS `tb_jenis_potensi`;

CREATE TABLE `tb_jenis_potensi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(100) DEFAULT NULL,
  `icon` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_jenis_potensi` */

insert  into `tb_jenis_potensi`(`id`,`jenis`,`icon`) values 
(1,'Sekolah',NULL),
(2,'Pasar',NULL),
(3,'Tempat Ibadah',NULL);

/*Table structure for table `tb_jenjang_sekolah` */

DROP TABLE IF EXISTS `tb_jenjang_sekolah`;

CREATE TABLE `tb_jenjang_sekolah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenjang` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_jenjang_sekolah` */

insert  into `tb_jenjang_sekolah`(`id`,`jenjang`) values 
(1,'TK'),
(2,'SD'),
(3,'SMP'),
(4,'SMA');

/*Table structure for table `tb_pasar` */

DROP TABLE IF EXISTS `tb_pasar`;

CREATE TABLE `tb_pasar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_desa` int(11) DEFAULT NULL,
  `id_jenis_potensi` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `pict` text DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_desa` (`id_desa`),
  KEY `id_jenis_potensi` (`id_jenis_potensi`),
  CONSTRAINT `tb_pasar_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `tb_desa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_pasar_ibfk_2` FOREIGN KEY (`id_jenis_potensi`) REFERENCES `tb_jenis_potensi` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_pasar` */

insert  into `tb_pasar`(`id`,`id_desa`,`id_jenis_potensi`,`nama`,`pict`,`alamat`,`lat`,`lng`,`created_at`,`deleted_at`,`updated_at`) values 
(7,22,2,'Pasar Desa Adat Peguyangan',NULL,'Jalan Astasura','-8.612506636899443','115.21325842295181','2021-06-04 00:21:40',NULL,'2021-06-04 00:35:05');

/*Table structure for table `tb_sekolah` */

DROP TABLE IF EXISTS `tb_sekolah`;

CREATE TABLE `tb_sekolah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_desa` int(11) DEFAULT NULL,
  `id_jenjang` int(11) DEFAULT NULL,
  `id_jenis_potensi` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `pict` text DEFAULT NULL,
  `jenis_sekolah` tinyint(1) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_desa` (`id_desa`),
  KEY `id_jenjang` (`id_jenjang`),
  KEY `id_jenis_potensi` (`id_jenis_potensi`),
  CONSTRAINT `tb_sekolah_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `tb_desa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_sekolah_ibfk_2` FOREIGN KEY (`id_jenjang`) REFERENCES `tb_jenjang_sekolah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_sekolah_ibfk_3` FOREIGN KEY (`id_jenis_potensi`) REFERENCES `tb_jenis_potensi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_sekolah` */

insert  into `tb_sekolah`(`id`,`id_desa`,`id_jenjang`,`id_jenis_potensi`,`nama`,`pict`,`jenis_sekolah`,`alamat`,`lat`,`lng`,`created_at`,`deleted_at`,`updated_at`) values 
(12,22,2,1,'SDN 1 Peguyangan',NULL,0,'Jalan Astasura','-8.613286313413743','115.2132480036045','2021-06-04 00:29:22',NULL,'2021-06-04 00:29:22'),
(13,22,1,1,'TK Swadharma',NULL,1,'Jalan Ahmad Yani','-8.613249185997116','115.21304996502744','2021-06-04 00:30:13',NULL,'2021-06-04 00:30:13'),
(14,22,3,1,'SMP Swadharma',NULL,1,'Jalan Ahmad Yani','-8.6132916173301','115.2130285583506','2021-06-04 00:30:42',NULL,'2021-06-04 00:30:42'),
(15,22,4,1,'SMK Dwijendra',NULL,1,'Jalan Suradipa','-8.611482977539442','115.21139757832216','2021-06-04 00:32:43',NULL,'2021-06-04 00:32:43');

/*Table structure for table `tb_tempat_ibadah` */

DROP TABLE IF EXISTS `tb_tempat_ibadah`;

CREATE TABLE `tb_tempat_ibadah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_desa` int(11) DEFAULT NULL,
  `id_jenis_potensi` int(11) DEFAULT NULL,
  `id_agama` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `pict` text DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_desa` (`id_desa`),
  KEY `id_jenis_potensi` (`id_jenis_potensi`),
  KEY `id_agama` (`id_agama`),
  CONSTRAINT `tb_tempat_ibadah_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `tb_desa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_tempat_ibadah_ibfk_2` FOREIGN KEY (`id_jenis_potensi`) REFERENCES `tb_jenis_potensi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_tempat_ibadah_ibfk_3` FOREIGN KEY (`id_agama`) REFERENCES `tb_agama` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_tempat_ibadah` */

insert  into `tb_tempat_ibadah`(`id`,`id_desa`,`id_jenis_potensi`,`id_agama`,`nama`,`pict`,`alamat`,`lat`,`lng`,`created_at`,`deleted_at`,`updated_at`) values 
(6,22,3,1,'Pura Taman',NULL,'Jalan Ahmad Yani','-8.61373184212893','115.21313599969712','2021-06-04 00:24:18',NULL,'2021-06-04 00:24:18'),
(8,22,3,1,'Pura Maspahit',NULL,'Jalan Astasura','-8.612464205478421','115.21334990292864','2021-06-04 00:25:54',NULL,'2021-06-04 00:25:54'),
(9,22,3,1,'Pura Dalem Sukun',NULL,'Jalan Astasura Gang VIII','-8.615269972945487','115.2184203066651','2021-06-04 00:27:43',NULL,'2021-06-04 00:28:17');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
