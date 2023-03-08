/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.25-MariaDB : Database - paymentreceipt_apps
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`paymentreceipt_apps` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `paymentreceipt_apps`;

/*Table structure for table `approvalpaymentreceipt` */

DROP TABLE IF EXISTS `approvalpaymentreceipt`;

CREATE TABLE `approvalpaymentreceipt` (
  `approval_id` int(3) NOT NULL AUTO_INCREMENT,
  `approveby` varchar(100) NOT NULL,
  `departments_id` int(3) DEFAULT NULL,
  PRIMARY KEY (`approval_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `approvalpaymentreceipt` */

/*Table structure for table `archieved` */

DROP TABLE IF EXISTS `archieved`;

CREATE TABLE `archieved` (
  `id_archieved` int(3) NOT NULL AUTO_INCREMENT,
  `payments_id` int(3) DEFAULT NULL,
  `keterangan` varchar(150) NOT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `hargarencana` int(10) DEFAULT NULL,
  `hargaaktual` int(10) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `quantity` int(3) DEFAULT NULL,
  `usage` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_archieved`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `archieved` */

/*Table structure for table `base` */

DROP TABLE IF EXISTS `base`;

CREATE TABLE `base` (
  `base_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `basename` varchar(20) NOT NULL,
  `keteranganbase` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`base_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

/*Data for the table `base` */

insert  into `base`(`base_id`,`basename`,`keteranganbase`) values 
(1,'Balikpapan','Sultan Aji Muhammad Sulaiman Sepinggan International Airport, Balikpapan'),
(3,'Jakarta','Bandar Udara Halim Perdanakusuma, Jakarta'),
(4,'Kupang','Bandara Internasional El Tari Kupang'),
(5,'Malinau','Bandar Udara Malinau Robert Atty Bessing, Kabupaten Malinau, Provinsi Kalimantan Utara'),
(7,'Medan','Bandar Udara Internasional Kualanamu, Medan'),
(8,'Nabire','Bandar Udara Nabire, Papua'),
(9,'Sentani','Bandar Udara Internasional Dortheys Hiyo Eluay, Sentani, Jayapura'),
(10,'Tarakan','Bandara Internasional Juwata Tarakan, Kalimantan Utara'),
(11,'Bengkulu','Bandara Fatmawati Soekarno Bengkulu'),
(12,'Wamena','Bandar Udara Wamena'),
(13,'Timika','Bandar Udara Internasional Mozes Kilangin Timika'),
(14,'Pangandaran','Bandar Udara Nusawiru Cijulang, Pangandaran, Jabar'),
(15,'Biak','Bandar Udara Internasional Frans Kaisiepo, Biak, Papua'),
(16,'Survey',NULL),
(17,'Other-Make Comment',NULL),
(18,'Ketapang','Bandara Rahadi Oesman, Ketapang, Kalimantan Barat'),
(19,'Sulawesi','Bandar Udara Internasional Sultan Hasanuddin, Makassar, Sulsel'),
(20,'Merauke','Bandar Udara Internasional Mopah, Merauke,Papua Selatan'),
(22,'Palangkaraya','Bandar Udara Tjilik Riwut, Palangkaraya, Kalimantan Tengah'),
(23,'Banda Aceh','Bandar Udara Internasional Sultan Iskandar Muda, Banda Aceh'),
(24,'Jambi','Bandara Sultan Thaha Saifuddin, Jambi'),
(25,'Padang','Bandar Udara Internasional Minangkabau, Padang, Sumatera Barat'),
(26,'Manokwari','Bandara Rendani Manokwari'),
(27,'Ternate','Bandara Sultan Babullah Ternate'),
(28,'Ambon','Bandar Udara Internasional Pattimura Ambon, Maluku'),
(29,'Samarinda','Bandar Udara Internasional Aji Pangeran Tumenggung Pranoto, Samarinda, Kalimantan Timur'),
(30,'Dabo','Bandar Udara Dabo Singkep, Kepulauan Singkep, Kabupaten Lingga, provinsi Kepulauan Riau');

/*Table structure for table `department` */

DROP TABLE IF EXISTS `department`;

CREATE TABLE `department` (
  `department_id` int(5) NOT NULL AUTO_INCREMENT,
  `nama_department` varchar(100) NOT NULL,
  `keterangandepartment` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `department` */

insert  into `department`(`department_id`,`nama_department`,`keterangandepartment`) values 
(1,'GA','General Affair'),
(2,'Safety','Safety'),
(3,'FF','Flight Following'),
(4,'IT','Information Technology'),
(5,'OCC','Operation and Call Center'),
(6,'Media','Media Room'),
(7,'ACC','Accounting'),
(8,'SIM','Simulator'),
(9,'Training','Training');

/*Table structure for table `generalaffairspayment` */

DROP TABLE IF EXISTS `generalaffairspayment`;

CREATE TABLE `generalaffairspayment` (
  `GApayment_id` int(3) NOT NULL AUTO_INCREMENT,
  `request_id` int(3) DEFAULT NULL,
  `department_id` int(3) DEFAULT NULL,
  `source_id` int(3) DEFAULT NULL,
  `tanggal_pembelian` date NOT NULL,
  `categories` varchar(100) DEFAULT NULL,
  `usagegeneralaffair` varchar(255) DEFAULT NULL,
  `deskripsi_items` varchar(255) DEFAULT NULL,
  `jumlah_items` int(5) DEFAULT NULL,
  `units_id` int(3) DEFAULT NULL,
  `hargaitems` int(20) DEFAULT NULL,
  `total_harga` int(20) DEFAULT NULL,
  `price_estimate` int(10) DEFAULT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  `inputdate` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`GApayment_id`),
  KEY `request_id` (`request_id`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `generalaffairspayment` */

/*Table structure for table `procurements` */

DROP TABLE IF EXISTS `procurements`;

CREATE TABLE `procurements` (
  `proc_id` int(3) NOT NULL AUTO_INCREMENT,
  `id_users` int(3) NOT NULL,
  `sources_id` int(3) NOT NULL,
  `departments_id` int(3) DEFAULT NULL,
  PRIMARY KEY (`proc_id`),
  KEY `id_users` (`id_users`),
  KEY `sources_id` (`sources_id`),
  KEY `departments_id` (`departments_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `procurements` */

/*Table structure for table `requestbase` */

DROP TABLE IF EXISTS `requestbase`;

CREATE TABLE `requestbase` (
  `regbase_id` int(3) NOT NULL AUTO_INCREMENT,
  `namarequestbase` varchar(150) NOT NULL,
  `jabatan` varchar(150) DEFAULT NULL,
  `kode_base` int(3) DEFAULT NULL,
  PRIMARY KEY (`regbase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `requestbase` */

/*Table structure for table `requests` */

DROP TABLE IF EXISTS `requests`;

CREATE TABLE `requests` (
  `request_id` int(5) NOT NULL AUTO_INCREMENT,
  `nama_request` varchar(200) NOT NULL,
  `department_id` int(3) DEFAULT NULL,
  PRIMARY KEY (`request_id`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `requests` */

insert  into `requests`(`request_id`,`nama_request`,`department_id`) values 
(1,'Agni Setyo',4),
(2,'Amirul Putra Justicia',4);

/*Table structure for table `satuan` */

DROP TABLE IF EXISTS `satuan`;

CREATE TABLE `satuan` (
  `unit_id` int(3) NOT NULL AUTO_INCREMENT,
  `namasatuan` varchar(20) NOT NULL,
  `keterangansatuan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `satuan` */

insert  into `satuan`(`unit_id`,`namasatuan`,`keterangansatuan`) values 
(1,'unit','Unit'),
(2,'pcs','PCS'),
(3,'lb','Lembar'),
(4,'box','Box'),
(5,'buah','Buah'),
(6,'set','Set'),
(7,'paket','Paket'),
(8,'roll','Roll'),
(9,'pack','Packs'),
(10,'rim','Rim'),
(11,'lusin','Lusin');

/*Table structure for table `sourcesproc` */

DROP TABLE IF EXISTS `sourcesproc`;

CREATE TABLE `sourcesproc` (
  `sources_id` int(3) NOT NULL AUTO_INCREMENT,
  `source` enum('Online','Offline') DEFAULT NULL,
  `sumbertoko` varchar(100) DEFAULT NULL,
  `namatoko` varchar(100) DEFAULT NULL,
  `nomortelptoko` int(15) DEFAULT NULL,
  `rekeningtoko` int(20) DEFAULT NULL,
  `namabarang` varchar(255) DEFAULT NULL,
  `linkpembelian` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`sources_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `sourcesproc` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `users_id` int(3) NOT NULL AUTO_INCREMENT,
  `departments_id` int(3) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `photo_profile` mediumtext DEFAULT NULL,
  `users_role` varchar(20) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`users_id`),
  KEY `departments_id` (`departments_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`users_id`,`departments_id`,`fullname`,`username`,`password`,`photo_profile`,`users_role`,`ip`) values 
(1,4,'Amirul Putra Justicia','amirulputra20221036','susiair312','user_1/','admin',NULL),
(2,4,'admin','admin','admin123','user_2/avatar5.png','admin',NULL),
(3,1,'Nadya Umaro','nadnad','susiair312','',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
