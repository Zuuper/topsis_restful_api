/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.14-MariaDB : Database - db_lpd
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_lpd` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `db_lpd`;

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(15,'2021_02_22_122145_create_tb_fintech',1),
(16,'2021_02_22_122546_create_tb_membership',1),
(17,'2021_02_22_123447_create_tb_admin',1),
(18,'2021_02_22_123604_create_tb_nasabah',1),
(19,'2021_02_22_124331_create_tb_topup',1),
(20,'2021_02_22_124525_create_tb_ditail_topup',1),
(21,'2021_02_22_124824_create_tb_dompet',1),
(22,'2021_02_22_124929_create_tb_transaksi',1),
(23,'2021_02_22_125114_create_tb_ditail_transaksi',1),
(24,'2021_02_22_125258_create_tb_warung',1),
(25,'2021_02_22_125852_create_tb_promo',1),
(26,'2021_02_22_130133_create_tb_produk',1);

/*Table structure for table `tb_admin` */

DROP TABLE IF EXISTS `tb_admin`;

CREATE TABLE `tb_admin` (
  `id_admin` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_fintech` int(10) unsigned NOT NULL,
  `nama` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik_admin` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_admin` enum('superadmin','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_admin`),
  KEY `id_fintech` (`id_fintech`),
  CONSTRAINT `tb_admin_ibfk_1` FOREIGN KEY (`id_fintech`) REFERENCES `tb_fintech` (`id_fintech`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_admin` */

/*Table structure for table `tb_ditail_topup` */

DROP TABLE IF EXISTS `tb_ditail_topup`;

CREATE TABLE `tb_ditail_topup` (
  `id_ditail_topup` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_topup` int(10) unsigned NOT NULL,
  `id_dompet` int(10) unsigned NOT NULL,
  `jumlah_transaksi` int(11) NOT NULL,
  `no_rekening` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_ditail_topup`),
  KEY `id_dompet` (`id_dompet`),
  KEY `id_topup` (`id_topup`),
  CONSTRAINT `tb_ditail_topup_ibfk_1` FOREIGN KEY (`id_dompet`) REFERENCES `tb_dompet` (`id_dompet`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_ditail_topup_ibfk_2` FOREIGN KEY (`id_topup`) REFERENCES `tb_topup` (`id_topup`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_ditail_topup` */

/*Table structure for table `tb_ditail_transaksi` */

DROP TABLE IF EXISTS `tb_ditail_transaksi`;

CREATE TABLE `tb_ditail_transaksi` (
  `id_ditail_transaksi` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(10) unsigned NOT NULL,
  `jumlah_transaksi` int(11) NOT NULL,
  `catatan` int(11) NOT NULL,
  PRIMARY KEY (`id_ditail_transaksi`),
  KEY `tb_ditail_transaksi_ibfk_1` (`id_transaksi`),
  CONSTRAINT `tb_ditail_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `tb_transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_ditail_transaksi` */

/*Table structure for table `tb_dompet` */

DROP TABLE IF EXISTS `tb_dompet`;

CREATE TABLE `tb_dompet` (
  `id_dompet` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_nasabah` int(10) unsigned NOT NULL,
  `saldo` int(11) NOT NULL,
  PRIMARY KEY (`id_dompet`),
  KEY `id_nasabah` (`id_nasabah`),
  CONSTRAINT `tb_dompet_ibfk_1` FOREIGN KEY (`id_nasabah`) REFERENCES `tb_nasabah` (`id_nasabah`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_dompet` */

/*Table structure for table `tb_fintech` */

DROP TABLE IF EXISTS `tb_fintech`;

CREATE TABLE `tb_fintech` (
  `id_fintech` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telpon` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_fintech`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_fintech` */

/*Table structure for table `tb_membership` */

DROP TABLE IF EXISTS `tb_membership`;

CREATE TABLE `tb_membership` (
  `id_membership` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_fintech` int(10) unsigned NOT NULL,
  `kategori` enum('gold','silver','bronze') COLLATE utf8mb4_unicode_ci NOT NULL,
  `limit` int(11) NOT NULL,
  PRIMARY KEY (`id_membership`),
  KEY `id_fintech` (`id_fintech`),
  CONSTRAINT `tb_membership_ibfk_1` FOREIGN KEY (`id_fintech`) REFERENCES `tb_fintech` (`id_fintech`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_membership` */

/*Table structure for table `tb_nasabah` */

DROP TABLE IF EXISTS `tb_nasabah`;

CREATE TABLE `tb_nasabah` (
  `id_nasabah` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_fintech` int(10) unsigned NOT NULL,
  `id_membership` int(10) unsigned NOT NULL,
  `nama_nasabah` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik_nasabah` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_nasabah` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pin_transaksi` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rekening` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telpon` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('aktif','non-aktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tangal_aktif` datetime NOT NULL,
  PRIMARY KEY (`id_nasabah`),
  KEY `id_fintech` (`id_fintech`),
  KEY `id_membership` (`id_membership`),
  CONSTRAINT `tb_nasabah_ibfk_1` FOREIGN KEY (`id_fintech`) REFERENCES `tb_fintech` (`id_fintech`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_nasabah_ibfk_2` FOREIGN KEY (`id_membership`) REFERENCES `tb_membership` (`id_membership`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_nasabah` */

/*Table structure for table `tb_produk` */

DROP TABLE IF EXISTS `tb_produk`;

CREATE TABLE `tb_produk` (
  `id_produk` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_warung` int(10) unsigned NOT NULL,
  `nama_produk` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  PRIMARY KEY (`id_produk`),
  KEY `id_warung` (`id_warung`),
  CONSTRAINT `tb_produk_ibfk_1` FOREIGN KEY (`id_warung`) REFERENCES `tb_warung` (`id_warung`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_produk` */

/*Table structure for table `tb_promo` */

DROP TABLE IF EXISTS `tb_promo`;

CREATE TABLE `tb_promo` (
  `id_promo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_warung` int(10) unsigned NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_promo`),
  KEY `id_warung` (`id_warung`),
  CONSTRAINT `tb_promo_ibfk_1` FOREIGN KEY (`id_warung`) REFERENCES `tb_warung` (`id_warung`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_promo` */

/*Table structure for table `tb_topup` */

DROP TABLE IF EXISTS `tb_topup`;

CREATE TABLE `tb_topup` (
  `id_topup` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_nasabah` int(10) unsigned NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  PRIMARY KEY (`id_topup`),
  KEY `id_nasabah` (`id_nasabah`),
  CONSTRAINT `tb_topup_ibfk_1` FOREIGN KEY (`id_nasabah`) REFERENCES `tb_nasabah` (`id_nasabah`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_topup` */

/*Table structure for table `tb_transaksi` */

DROP TABLE IF EXISTS `tb_transaksi`;

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_nasabah` int(10) unsigned NOT NULL,
  `id_warung` int(10) unsigned NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `id_nasabah` (`id_nasabah`),
  KEY `id_warung` (`id_warung`),
  CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`id_nasabah`) REFERENCES `tb_nasabah` (`id_nasabah`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_transaksi_ibfk_2` FOREIGN KEY (`id_warung`) REFERENCES `tb_warung` (`id_warung`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_transaksi` */

/*Table structure for table `tb_warung` */

DROP TABLE IF EXISTS `tb_warung`;

CREATE TABLE `tb_warung` (
  `id_warung` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_fintech` int(10) unsigned NOT NULL,
  `nama_pemilik` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik_pemilik` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_warung` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_warung` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rekening` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telpon` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('aktif','non-aktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_aktif` datetime NOT NULL,
  PRIMARY KEY (`id_warung`),
  KEY `id_fintech` (`id_fintech`),
  CONSTRAINT `tb_warung_ibfk_1` FOREIGN KEY (`id_fintech`) REFERENCES `tb_fintech` (`id_fintech`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_warung` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
