/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.16-MariaDB : Database - project
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `akses` */

DROP TABLE IF EXISTS `akses`;

CREATE TABLE `akses` (
  `id_akses` int(11) NOT NULL AUTO_INCREMENT,
  `nama_akses` varchar(25) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  PRIMARY KEY (`id_akses`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `akses` */

LOCK TABLES `akses` WRITE;

insert  into `akses`(`id_akses`,`nama_akses`,`deskripsi`) values 
(1,'Atasan','Untuk memantau laporan-laporan pada sistem aplikasi'),
(2,'Finance','Sebagai pengelola operator dan cetak laporan penjualan pada aplikasi.'),
(3,'Sales','Sebagai operator penjualan pada aplikasi penjualan');

UNLOCK TABLES;

/*Table structure for table `bank` */

DROP TABLE IF EXISTS `bank`;

CREATE TABLE `bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `bank` */

LOCK TABLES `bank` WRITE;

insert  into `bank`(`id`,`nama_bank`) values 
(1,'MANDIRI'),
(2,'BNI'),
(3,'BCA'),
(4,'BRI'),
(5,'CIMB Niaga');

UNLOCK TABLES;

/*Table structure for table `detail_penjualan` */

DROP TABLE IF EXISTS `detail_penjualan`;

CREATE TABLE `detail_penjualan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_trf` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(35) NOT NULL,
  `totalpure` bigint(20) NOT NULL,
  `grand_total` bigint(20) NOT NULL,
  `diskon` int(3) NOT NULL,
  `bayar` bigint(20) NOT NULL,
  `kembalian` bigint(20) NOT NULL,
  `catatan` varchar(50) NOT NULL,
  `tgl_trf` date NOT NULL,
  `jam_trf` time NOT NULL,
  `id_pembayaran` int(2) NOT NULL,
  `no_rek` int(18) DEFAULT NULL,
  `atas_nama` varchar(35) NOT NULL,
  `id_bank` int(2) DEFAULT NULL,
  `operator` varchar(30) NOT NULL,
  `custom` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

/*Data for the table `detail_penjualan` */

LOCK TABLES `detail_penjualan` WRITE;

insert  into `detail_penjualan`(`id`,`no_trf`,`nama_pelanggan`,`totalpure`,`grand_total`,`diskon`,`bayar`,`kembalian`,`catatan`,`tgl_trf`,`jam_trf`,`id_pembayaran`,`no_rek`,`atas_nama`,`id_bank`,`operator`,`custom`) values 
(79,'T20240521192504','Elham Wicaksono',28000000,28000000,0,28000000,0,'memembuat','2024-05-21','19:25:04',2,2147483647,'Elham Wicaksono',2,'jefri','Net'),
(80,'T20240521192541','Elham Wicaksono',102000000,102000000,0,110000000,8000000,'dchs','2024-05-21','19:25:41',2,964863275,'Elham Wicaksono',1,'jefri','Net'),
(81,'T20240521192723','Elham Wicaksono',85500000,47025000,45,90000000,42975000,'Cepat','2024-05-21','19:27:23',2,2147483647,'Elham Wicaksono',4,'jefri','Net'),
(82,'T20240521192802','Elham Wicaksono',9000000,8820000,2,10000000,1180000,'Canggih','2024-05-20','19:28:02',2,2147483647,'Elham Wicaksono',5,'jefri','Net'),
(83,'T20240521192842','Elham Wicaksono',17500000,16625000,5,18000000,1375000,'keren','2024-05-20','19:28:42',2,2147483647,'Elham Wicaksono',1,'jefri','Net'),
(84,'T20240521192933','Elham Wicaksono',1000000000,500000000,50,1000000000,500000000,'banyakk','2024-05-20','19:29:33',2,2147483647,'Elham Wicaksono',3,'jefri','Net');

UNLOCK TABLES;

/*Table structure for table `detail_produk` */

DROP TABLE IF EXISTS `detail_produk`;

CREATE TABLE `detail_produk` (
  `id_detail_produk` int(11) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(50) DEFAULT NULL,
  `harga_awal` int(12) DEFAULT NULL,
  `harga_akhir` int(12) DEFAULT NULL,
  `harga_tetap` int(12) DEFAULT NULL,
  PRIMARY KEY (`id_detail_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `detail_produk` */

LOCK TABLES `detail_produk` WRITE;

insert  into `detail_produk`(`id_detail_produk`,`nama_produk`,`harga_awal`,`harga_akhir`,`harga_tetap`) values 
(1,'Jasa Pembuatan dan Pengembangan Portal Akademik ',4000000,5000000,4500000),
(2,'Jasa Pembuatan dan Pengembangan Perpustakaan Dig',3000000,4000000,3500000),
(3,'Jasa Penerbitan dan Distribusi E-Book',1000000,3000000,2000000);

UNLOCK TABLES;

/*Table structure for table `operator` */

DROP TABLE IF EXISTS `operator`;

CREATE TABLE `operator` (
  `id_operator` int(11) NOT NULL AUTO_INCREMENT,
  `nama_operator` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `id_akses` int(3) NOT NULL,
  `last_login` date NOT NULL,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`id_operator`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `operator` */

LOCK TABLES `operator` WRITE;

insert  into `operator`(`id_operator`,`nama_operator`,`username`,`password`,`id_akses`,`last_login`,`foto`) values 
(9,'Cicih Fitria Ningsih','atasan','221ef2597affd3f083ac94af9e1b1e7f',1,'2024-05-21','avatar3.png'),
(10,'jeff','jeff','166ee015c0e0934a8781e0c86a197c6e',2,'2024-05-20','13005384ce54754b3a763180f2a6c83e.png'),
(13,'jefri','jefri','c710857e9b674843afc9b54b7ae2032d',3,'2024-05-21','b0be2fdc90a3b7a0900a81ed8e466af5.jpg');

UNLOCK TABLES;

/*Table structure for table `pembayaran` */

DROP TABLE IF EXISTS `pembayaran`;

CREATE TABLE `pembayaran` (
  `id_byr` int(2) NOT NULL AUTO_INCREMENT,
  `metode` varchar(20) NOT NULL,
  PRIMARY KEY (`id_byr`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `pembayaran` */

LOCK TABLES `pembayaran` WRITE;

insert  into `pembayaran`(`id_byr`,`metode`) values 
(1,'Cash'),
(2,'Transfer');

UNLOCK TABLES;

/*Table structure for table `penjualan` */

DROP TABLE IF EXISTS `penjualan`;

CREATE TABLE `penjualan` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_produk` int(11) NOT NULL,
  `no_trf` varchar(45) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_barang` bigint(20) NOT NULL,
  `sub_total` bigint(20) NOT NULL,
  `total` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=latin1;

/*Data for the table `penjualan` */

LOCK TABLES `penjualan` WRITE;

insert  into `penjualan`(`id_transaksi`,`id_produk`,`no_trf`,`jumlah`,`harga_barang`,`sub_total`,`total`) values 
(137,2,'T20240521192504',8,3500000,28000000,NULL),
(138,3,'T20240521192541',51,2000000,102000000,NULL),
(139,1,'T20240521192723',19,4500000,85500000,NULL),
(140,1,'T20240521192802',2,4500000,9000000,NULL),
(141,2,'T20240521192842',5,3500000,17500000,NULL),
(142,3,'T20240521192933',500,2000000,1000000000,NULL);

UNLOCK TABLES;

/*Table structure for table `produk` */

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(225) NOT NULL,
  `harga` int(20) NOT NULL,
  `range_harga` varchar(125) DEFAULT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=latin1;

/*Data for the table `produk` */

LOCK TABLES `produk` WRITE;

insert  into `produk`(`id_produk`,`nama_produk`,`harga`,`range_harga`) values 
(1,'Jasa Pembuatan dan Pengembangan Portal Akademik ',4500000,'Rp.4000000 - Rp.5000000'),
(2,'Jasa Pembuatan dan Pengembangan Perpustakaan Dig',3500000,'Rp.3000000 - Rp.4000000'),
(3,'Jasa Penerbitan dan Distribusi E-Book',2000000,'Rp.1000000 - Rp.3000000');

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
