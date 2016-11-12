/*
SQLyog Community v11.24 (32 bit)
MySQL - 5.5.27 : Database - cdc
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cdc` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `cdc`;

/*Table structure for table `companies` */

DROP TABLE IF EXISTS `companies`;

CREATE TABLE `companies` (
  `CompanyID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CompanyName` varchar(50) NOT NULL,
  `CompanyAddress` text NOT NULL,
  `CompanyTelp` varchar(50) NOT NULL,
  `CompanyFax` varchar(50) DEFAULT NULL,
  `CompanyWebsite` varchar(50) DEFAULT NULL,
  `CompanyEmail` varchar(50) DEFAULT NULL,
  `IndustryTypeID` int(10) NOT NULL,
  `CompanyDescription` text,
  `RegisterDate` datetime DEFAULT NULL,
  `ApprovedDate` datetime DEFAULT NULL,
  `FileName` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`CompanyID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `companies` */

/*Table structure for table `educationtypes` */

DROP TABLE IF EXISTS `educationtypes`;

CREATE TABLE `educationtypes` (
  `EducationTypeID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `EducationTypeName` varchar(50) NOT NULL,
  PRIMARY KEY (`EducationTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `educationtypes` */

insert  into `educationtypes`(`EducationTypeID`,`EducationTypeName`) values (6,'D3'),(7,'D4'),(8,'S1'),(9,'S2'),(10,'S3');

/*Table structure for table `employees` */

DROP TABLE IF EXISTS `employees`;

CREATE TABLE `employees` (
  `EmployeeID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `EmployeeName` varchar(50) NOT NULL,
  `EmployeeAddress` text,
  `EmployeePhoneNumber` varchar(50) DEFAULT NULL,
  `UniversityName` varchar(50) NOT NULL,
  `FacultyName` varchar(50) NOT NULL,
  `MajorName` varchar(50) NOT NULL,
  `GraduatedDate` date DEFAULT NULL,
  PRIMARY KEY (`EmployeeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `employees` */

/*Table structure for table `industrytypes` */

DROP TABLE IF EXISTS `industrytypes`;

CREATE TABLE `industrytypes` (
  `IndustryTypeID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `IndustryTypeName` varchar(50) NOT NULL,
  PRIMARY KEY (`IndustryTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

/*Data for the table `industrytypes` */

insert  into `industrytypes`(`IndustryTypeID`,`IndustryTypeName`) values (1,'Elektronika / Peralatan Elektronik'),(2,'Energi / Tenaga / Air / Minyak&Gas / Limbah'),(3,'Akunting / Audit / Layanan Pajak'),(4,'Teknik - Bangunan, Sipil, Konstruksi / Survey Kuan'),(5,'Periklanan / Hubungan Masyarakat / Layanan Pemasar'),(6,'Pembudidayaan Pertaniaan / Perhutanan'),(7,'Teknik - Elektrikal / Elektronik / Meanikal'),(8,'Arsitektur / Pembangunan / Konstruksi'),(9,'Atletik / Olahraga'),(10,'Teknik - Lainnya'),(11,'Amal / Layanan Sosial / Organisasi Nirlaba'),(12,'Hiburan / Rekreasi'),(13,'Kimia / Plastik / Kertas / Petrokimia'),(14,'Layanan Keuangan '),(15,'Layanan Sipil ( Pemerintah, Angkatan Bersenjata )'),(16,'Makanan & Minuman / Katering'),(17,'Pakaian / Pakaian Jadi / Tekstil'),(18,'Penerus Muatan / Pengiriman / Pengapalan'),(19,'Pendidikan'),(20,'Layanan Bisnis Umum'),(21,'Perawatan Kesehatan & Kecantikan'),(22,'Hospitality / Katering'),(23,'Manajemen SUmber Daya Manusia (HRD) /  Konsultasi'),(24,'Industri Mesin / Peralatan Otomatisasi'),(25,'Teknologi Informatika (IT)'),(26,'Asuransi / Dana Pensiun'),(27,'Desain Interior / Desain Grafis'),(28,'Perhiasan / Batu Permata / Jam Tangan'),(29,'Laboraturium'),(30,'Hukum'),(31,'Logistik'),(32,'Konsultasi / Layanan Manajemen'),(33,'Manufakturing Umum'),(34,'Transportasi / Perhubungan'),(35,'Media / Penerbitan / Percetakan'),(36,'Kesehatan / Farmasi'),(37,'Pertambangan '),(38,'Kelompok Industri Campuran'),(39,'Kendaraan Bermotor '),(40,'Pengemasan'),(41,'Pertunjukan / Musik / Seni'),(42,'Minyak'),(43,'Pengembangan Properti'),(44,'Pengembangan / Konsultasi Properti'),(45,'Utilitas Publik'),(46,'Survey / Riset'),(47,'Keamanan'),(48,'Keamanan / Kebakaran / Kontrol Akses Elektronik'),(49,'Telekomunikasi'),(50,'Turisme / Agen Perjalanan'),(51,'Mainan'),(52,'Perdagangan Umum & Distribusi'),(53,'Grosir / Riteil'),(54,'Perbankan dan Keuangan'),(55,'Lainnya');

/*Table structure for table `locations` */

DROP TABLE IF EXISTS `locations`;

CREATE TABLE `locations` (
  `LocationID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `LocationName` varchar(50) NOT NULL,
  PRIMARY KEY (`LocationID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `locations` */

insert  into `locations`(`LocationID`,`LocationName`) values (1,'Medan'),(2,'Pematang Siantar'),(4,'Laguboti'),(5,'Jakarta'),(6,'Bandung'),(7,'Surabaya'),(8,'Palembang'),(9,'Batam');

/*Table structure for table `notifications` */

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `NotificationID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NotificationName` varchar(200) NOT NULL,
  `NotificationSubject` varchar(200) NOT NULL,
  `NotificationContent` longtext NOT NULL,
  `NotificationSenderEmail` varchar(50) DEFAULT NULL,
  `NotificationSenderName` varchar(50) DEFAULT NULL,
  `NotificationToEmail` varchar(50) DEFAULT NULL,
  `NotificationCCEmail` varchar(50) DEFAULT NULL,
  `NotificationBCCEmail` varchar(50) DEFAULT NULL,
  `IsActive` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`NotificationID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `notifications` */

insert  into `notifications`(`NotificationID`,`NotificationName`,`NotificationSubject`,`NotificationContent`,`NotificationSenderEmail`,`NotificationSenderName`,`NotificationToEmail`,`NotificationCCEmail`,`NotificationBCCEmail`,`IsActive`) values (1,'Perusahaan Baru','Pendaftaran Perusahaan Baru','<p>Dear admin,<br />\r\n<br />\r\nPendaftaran perusahaan baru dengan rincian sebagai berikut:<br />\r\n<br />\r\nUsername : @USERNAME@<br />\r\nEmail : @EMAIL@<br />\r\nNama Perusahaan : @COMPANYNAME@<br />\r\n<br />\r\nSilahkan mengunjungi @URL@ untuk melihat data dan konfirmasi akun.</p>\r\n\r\n<p><br />\r\n@SITENAME@</p>\r\n','noreply@sumuttekno.com','Del Career Center',NULL,NULL,NULL,1),(2,'Konfirmasi Aktivasi Akun Perusahaan','Akun Perusahaan Telah Diaktivasi','<p>Dear @COMPANYNAME@,<br />\r\n<br />\r\nSelamat bergabung di @SITENAME@!<br />\r\nAkun anda telah diaktivasi oleh administrator dengan rincian sebagai berikut:<br />\r\n<br />\r\nUsername : @USERNAME@<br />\r\nEmail : @EMAIL@<br />\r\nNama Perusahaan : @COMPANYNAME@<br />\r\n<br />\r\nAnda dapat login melalui link berikut: @URL@. Harap menjaga kerahasiaan akun anda dan menggunakannya sebaik mungkin.</p>\r\n\r\n<p><br />\r\n@SITENAME@</p>\r\n','noreply@sumuttekno.com','Del Career Center',NULL,NULL,NULL,1),(3,'Lowongan Baru Untuk Admin','Lowongan Baru dari @COMPANYNAME@','<p>Dear admin,<br />\r\n<br />\r\n@COMPANYNAME@ telah menambahkan lowongan baru pada @SITENAME@ dengan rincian sebagai berikut:<br />\r\n<br />\r\nJudul Lowongan : @VACANCYTITLE@<br />\r\nTipe : @VACANCYTYPE@<br />\r\nPosisi : @VACANCYPOSITION@<br />\r\n<br />\r\nStatus lowongan saat ini adalah @STATUS@, silahkan kunjungi @URL@ untuk melihat detil lowongan diatas.</p>\r\n\r\n<p><br />\r\n@SITENAME@</p>\r\n','noreply@sumuttekno.com','Del Career Center',NULL,NULL,NULL,1),(4,'Lowongan Baru Untuk User','Lowongan Baru dari @COMPANYNAME@','<p>Dear @NAME@,<br />\r\n<br />\r\n@COMPANYNAME@ telah menambahkan lowongan baru pada @SITENAME@ dengan rincian sebagai berikut:<br />\r\n<br />\r\nJudul Lowongan : @VACANCYTITLE@<br />\r\nTipe : @VACANCYTYPE@<br />\r\nPosisi : @VACANCYPOSITION@<br />\r\n<br />\r\nSilahkan kunjungi @URL@ untuk melihat detil lowongan diatas.</p>\r\n\r\n<p><br />\r\n@SITENAME@</p>\r\n','noreply@sumuttekno.com','Del Career Center',NULL,NULL,NULL,1),(5,'Lamaran Baru Untuk Perusahaan','Lamaran Baru dari @NAME@','<p>Dear @COMPANYNAME@,<br />\r\n<br />\r\n@NAME@ telah melihat lowongan anda (@VACANCYTITLE@) pada @SITENAME@ dan tertarik untuk\r\nmelamar pada lowongan dengan rincian: <br />\r\n<br />\r\nNama : @NAME@<br />\r\nEmail : @EMAIL@<br />\r\nAlamat : @ADDRESS@<br />\r\nPendidikan : @EDUCATIONTYPENAME@<br />\r\n<br />\r\nSilahkan kunjungi @URL@ untuk melihat detil pelamar diatas.</p>\r\n\r\n<p><br />\r\n@SITENAME@</p>\r\n','noreply@sumuttekno.com','Del Career Center',NULL,NULL,NULL,1),(6,'Lamaran Baru Untuk User','Lamaran Anda Telah Dikirim','TEST','noreply@sumuttekno.com','Del Career Center',NULL,NULL,NULL,1),(7,'Lamaran Direspon Untuk User','Lamaran Anda Telah @APPLYSTATUS@','<p>Dear Pelamar,<br />\r\n<br />\r\n@MESSAGECONTENT@<br />\r\n</p>\r\n\r\n<p><br />\r\n@SITENAME@</p>\r\n','noreply@sumuttekno.com','Del Carrer Center',NULL,NULL,NULL,1);

/*Table structure for table `positions` */

DROP TABLE IF EXISTS `positions`;

CREATE TABLE `positions` (
  `PositionID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PositionName` varchar(50) NOT NULL,
  PRIMARY KEY (`PositionID`)
) ENGINE=InnoDB AUTO_INCREMENT=257 DEFAULT CHARSET=latin1;

/*Data for the table `positions` */

insert  into `positions`(`PositionID`,`PositionName`) values (1,'Admin & HRD'),(2,'Akunting'),(3,'Asuransi'),(4,'Desain'),(5,'Hospitality/ Makanan & Minuman'),(6,'Ilmu Pengetahuan, Lab, R&D'),(7,'Konstruksi dan Bangunan '),(9,'Manajemen'),(10,'Manufakturing'),(11,'Media dan Periklanan'),(12,'Pelayanan Kesehatan '),(13,'Pelayanan Profesional '),(14,'Pemasaran/ Hubungan Masyarakat (HUMAS)'),(15,'Pendidikan '),(16,'Penjualan, Pelayanan Pelanggan & Pengembang Bisnis'),(17,'Perawatan Kecantikan / Kesehatan'),(18,'Perbankan / Keuangan '),(19,'Perdagangan & Pembelian'),(20,'Properti'),(21,'Teknik'),(22,'Teknologi Informatika'),(23,'Telekomunikasi'),(24,'Transportasi & Logistik'),(25,'Umum / Sipil'),(26,'Asisten Pribadi / Eksekutif'),(27,'Clerical / Staff Admin/ General Affair'),(28,'Direktur/ Manager HRD'),(29,'Kompensasi & Benefit'),(31,'Manager Administrasi dan Operasional'),(32,'Pelatihan dan Pengembangan'),(33,'Rekrutmen/ Executive Search'),(34,'Resepsionis'),(35,'Sekretaris'),(36,'Staf HRD'),(37,'Akuntan'),(38,'Analisis Keuangan '),(39,'Bendahara '),(40,'Chief Accountant'),(41,'Credit Control / Budgeting'),(42,'External / Internal Audit'),(43,'Financial Controller'),(44,'Konsulting'),(46,'Manager Keuangan / Akunting'),(47,'Pajak '),(48,'Staff Akunting/ Supervisor'),(49,'Agen Asuransi / Broker'),(50,'Aktuaria'),(52,'Penjamin'),(53,'Petugas Klaim'),(54,'Grafis'),(55,'Industri/ Produk'),(56,'Interior'),(58,'Mode'),(59,'Multi-Media'),(60,'Visual Merchandising'),(61,'Web Desain'),(62,'Hospitality/ Layanan Hotel'),(64,'Makanan & Minuman ( F & B)'),(65,'Manajemen '),(66,'Operasional'),(67,'Resort'),(68,'Turisme / Agen Perjalanan '),(69,'Bioteknologi'),(70,'Energi / Sumber Daya Alam / Minyak dan Gas'),(71,'Ilmu Lingkungan / Pengelolaan Limbah '),(72,'Ilmu Pangan '),(73,'Ilmu Pengetahuan '),(74,'Kimia'),(75,'Laboraturium'),(76,'Petrokimia'),(77,'Riset & Pengembangan'),(78,'Bangunan / Konstruksi / Kontrol Kualitas'),(79,'Jasa Arsitektur'),(80,'Sipil / Strukturual'),(81,'Ahli Geologi'),(82,'Eksekutif Muda'),(83,'Hiburan - Artis / Penyanyi'),(84,'Kontrol Keamanan / Keselamatan'),(86,'Mahasiswa / Fresh Graduate / Tak Berpengalaman'),(87,'Pekerja Ahli'),(88,'Perniagaan'),(89,'Pertambangan'),(90,'Pertanian / Kehutanan / Perikanan'),(91,'Teknisi'),(92,'Manajemen Umum'),(93,'Top Eksekutif ( CEO, CFO, CTO, GM, MD )'),(95,'Manajemen Manufakturing'),(96,'Pakaian Jadi / Tekstil'),(97,'Pencetakan / Penerbitan'),(98,'Pengembangan Produk / Manajemen'),(99,'Perencanaan Produksi / Kontrol'),(100,'QC, QA & Pengecekan / ISO'),(101,'Umum / Pekerja Produksi'),(102,'Editorial / Jurnalisme'),(103,'Fotografi / Video'),(104,'Kreatif / Desain'),(106,'Media Cetak'),(107,'Pelayanan Akun '),(108,'Pemilihan Media'),(109,'Penyiaran - TV / Radio'),(110,'Perencanaan Strategis'),(111,'Produksi'),(112,'Ahli Terapi'),(113,'Dokter /Dokter Umum / Ahli Bedah'),(114,'Dokter Hewan'),(115,'Farmasi'),(117,'Perawat'),(118,'Spesialis'),(119,'Teknisi Layanan Kesehatan'),(120,'Analisa Bisnis / Analisa Data'),(121,'Konsultasi Bisnis'),(122,'Kontrol Hama'),(123,'Legal & Compliance'),(124,'Penerjemah'),(125,'SekretarisPerusahaan '),(126,'Hubungan Masyarakat - Copy Writing'),(127,'Hubungan Masyarakat - Manajemen Event'),(128,'Hubungan Masyarakat - Umum / Pendukung'),(130,'Manajemen'),(131,'Pemasaran - Komunikasi Pemasaran'),(132,'Pemasaran - Merk / Manajemen Produk'),(133,'Pemasaran - Pemasaran Langsung'),(134,'Pemasaran - Riset Pasar'),(135,'Pemasarn - Umum / Pendukung'),(136,'Dosen / Profesor / Kepala Sekolah'),(137,'Guru'),(138,'Guru TK'),(140,'Pustakawan'),(141,'Tutor / Instruktur'),(142,'Grosir'),(143,'Kanal / Distribusi '),(145,'Pelayanan Akun'),(146,'Pelayanan Pelanggan - Manager'),(147,'Pelayanan Pelanggan - Supervisor'),(148,'Pengembangan Bisnis'),(149,'Penjual - Manajemen Penjualan'),(150,'Penjual - Real Estate'),(151,'Penjual Ritel'),(152,'Penjual Teknikal / Sales Engineer'),(153,'Pusat Panggilan '),(154,'Tele - sales (Telemarketing)'),(155,'Ahli Gizi'),(156,'Ahli Kecantikan'),(157,'Ahli Terapi - Spa'),(158,'Atletik / Fitness / Olahraga & Kesehatan'),(160,'Analis'),(161,'Analis Kredit / Persetujuan '),(162,'Bank Swasta'),(163,'Dealing & Trading'),(164,'Ekuitas dan Pasar Modal'),(165,'Hipotek'),(166,'Investasi'),(167,'Keuangan Korperasi'),(169,'Layanan Keuangan '),(170,'Manajemen Dana'),(171,'Operasional Pembayaran'),(172,'Pembiayaan Proyek '),(173,'Pengumpulan Kredit '),(174,'Perbanakan Koorperasi'),(175,'Perbankan Retail'),(176,'Pinjaman'),(177,'Treasury'),(178,'Alas Kaki'),(179,'Alat- alat Kantor'),(180,'Elektronik'),(181,'Pabrik'),(182,'Jam Tangan '),(184,'Mainan'),(185,'Pengadaan / Pembelian '),(186,'Perabotan '),(187,'Perlengkapan Rumah Tangga'),(188,'PVC'),(189,'Retail'),(190,'Sweater'),(191,'Tekstil'),(192,'Tenunan / Rajutan'),(193,'Konsultasi Properti '),(195,'Manajemen Properti'),(196,'Drafter'),(197,'Elektriks / Elektronik'),(198,'Energi / Sumber Daya Alam'),(199,'Industri'),(200,'Kelautan '),(201,'Kesehatan / Keamanan / Lingkungan'),(202,'Kimia'),(204,'Manajer Proyek Teknik'),(205,'Manufakturing & Produksi'),(206,'Mekanikal'),(207,'Perawatan / Teknisi'),(208,'Telekomunikasi / Nirkabel / Radio'),(209,'DBA'),(210,'IT - Audit'),(211,'IT - Webmaster SEO'),(212,'IT Manajemen '),(213,'IT Project Managemnt'),(214,'IT Support'),(215,'Jaringan & Sistem'),(216,'Keamanan '),(218,'Manajemen Produk / Analisis Bisnis'),(219,'Mobile / Komunikasi Nirkabel'),(220,'Pengembangn Perangkat Lunak '),(221,'Perangkat Keras'),(222,'Spesialis Aplikasi - Jaringan '),(223,'Spesialis Aplikasi - Perangkat Lunak / Pemprograma'),(224,'Technical Writing'),(225,'Tekhnikal / Konsultasi Fungsional '),(226,'Tes Uji /QA'),(227,'Administrasi Jaringan '),(228,'Administrasi Sistem'),(229,'Dukungan Teknis Telekomunikasi'),(230,'GSM Engineering '),(232,'O & M Engineering'),(233,'RF - Perencanaan - Penginstalasian - Administrasi'),(234,'Switching Engineering'),(235,'System Engineering '),(236,'Distribusi '),(237,'Ekspor Impor'),(238,'Freight Forwarding'),(239,'Inventaris / Pergudangan '),(240,'Kredit Dokumentasi / Pengelolaan Tagihan '),(242,'Maritim - Umum '),(243,'Otomotif'),(244,'Pelayanan Penerbangan '),(245,'Pengisian '),(246,'Perkapalan '),(247,'Transportasi Publik '),(248,'Transportasi Swasta'),(249,'Transportasi Udara'),(250,'Konseling'),(251,'Layanan Sipil'),(252,'Militer / Pertahanan '),(253,'Pelayanan Sosial - Komunitas / Organisasi Nirlaba'),(254,'Urusan Luar Negeri / Badan Pemerintah'),(255,'Utilitas'),(256,'Lainnya');

/*Table structure for table `postcategories` */

DROP TABLE IF EXISTS `postcategories`;

CREATE TABLE `postcategories` (
  `PostCategoryID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PostCategoryName` varchar(50) NOT NULL,
  PRIMARY KEY (`PostCategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `postcategories` */

insert  into `postcategories`(`PostCategoryID`,`PostCategoryName`) values (1,'News'),(2,'Blog'),(3,'Event'),(5,'Others');

/*Table structure for table `posts` */

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `PostID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `PostCategoryID` int(10) NOT NULL,
  `PostDate` date NOT NULL,
  `PostTitle` varchar(200) NOT NULL,
  `PostSlug` varchar(200) NOT NULL,
  `PostContent` longtext NOT NULL,
  `PostExpiredDate` date NOT NULL,
  `TotalView` int(11) NOT NULL DEFAULT '0',
  `LastViewDate` datetime DEFAULT NULL,
  `IsSuspend` tinyint(1) NOT NULL DEFAULT '1',
  `FileName` varchar(250) DEFAULT NULL,
  `CreatedBy` varchar(50) NOT NULL,
  `CreatedOn` datetime NOT NULL,
  `UpdatedBy` varchar(50) NOT NULL,
  `UpdatedOn` datetime NOT NULL,
  PRIMARY KEY (`PostID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `posts` */

insert  into `posts`(`PostID`,`PostCategoryID`,`PostDate`,`PostTitle`,`PostSlug`,`PostContent`,`PostExpiredDate`,`TotalView`,`LastViewDate`,`IsSuspend`,`FileName`,`CreatedBy`,`CreatedOn`,`UpdatedBy`,`UpdatedOn`) values (1,1,'2016-11-10','Interdum et malesuada fames ac ante ipsum elementum vel lorem eu primis in faucibus','interdum-et-malesuada-fames-ac-ante-ipsum-elementum-vel-lorem-eu-primis-in-faucibus','<ul>\r\n	<li>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</li>\r\n	<li>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</li>\r\n</ul>\r\n','2017-01-01',4,NULL,0,'55.jpg','admin','2016-10-18 19:14:58','admin','2016-11-10 02:37:38'),(2,1,'2016-11-10','Swimmer Ryan Lochte wins endorsement deal for ‘forgiving’ throat drop','swimmer-ryan-lochte-wins-endorsement-deal-for-forgiving-throat-drop','<p>Integer rhoncus vestibulum lectus ac sodales. Vestibulum dapibus, magna quis finibus scelerisque, sapien nisl rutrum mauris, eget ullamcorper est purus pharetra orci. Nam eu magna sit amet dui convallis rhoncus non vel odio. Phasellus in libero nec nunc venenatis finibus sed in neque.Nullam auctor, quam ut eleifend hendrerit, tellus mauris dignissim nibh, nec euismod felis odio ac ex. Maecenas finibus lacinia fermentum.Vestibulum hendrerit, mauris vel convallis semper, ante purus vehicula diam, non blandit leo leo ac justo. Praesent viverra, lacus et tempus tincidunt, massa eros eleifend massa, ac tempus ipsum justo vel erat.Mauris vitae magna lacinia, vehicula diam sed, rutrum tortor. Maecenas orci nibh, tincidunt quis eros ac, vehicula rhoncus lacus. Maecenas ut justo sit amet lectus consequat mollis. Phasellus vehicula consequat vehicula.<em>&quot;Fusce nulla turpis, tempor at auctor et, dignissim semper ligula. Cras eu dolor blandit, facilisis mi et, ultrices orci sapien nisl rutrum mauris, eget ullamcorper est purus pharetra orci. Nam eu magna sit amet dui convallis rhoncus non vel odio. Phasellus in libero nec nunc venenatis finibus sed in neque.</em>Vestibulum hendrerit, mauris vel convallis semper, ante purus vehicula diam, non blandit leo leo ac justo. Praesent viverra, lacus et tempus tincidunt, massa eros eleifend massa, ac tempus ipsum justo vel erat.</p>\r\n','2017-01-01',3,NULL,0,NULL,'admin','2016-10-18 20:16:10','admin','2016-11-10 02:36:42'),(3,3,'2016-11-10','U.S. Navy ship fires warning shots at Iranian vessel','u-s-navy-ship-fires-warning-shots-at-iranian-vessel','<ul>\r\n	<li>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</li>\r\n	<li>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</li>\r\n</ul>\r\n','2017-01-01',3,NULL,0,NULL,'admin','2016-10-18 20:25:16','admin','2016-11-10 02:36:31'),(4,5,'2016-10-22','Contact Us','contact-us','<p>DEL dimaknai sebagai `Pemimpin yang Selangkah Lebih Maju`.</p>\r\n\r\n<p>Yayasan Del mulai aktif di kegiatan sosial kemasyarakatan jauh sebelum didirikannya PT Toba Sejahtera, perusahaan yang kemudian menjadi Yayasan Del sebagai tonggak tanggung jawab sosial perusahaan.</p>\r\n\r\n<p>Tujuan awal Yayasan Del didirikan adalah untuk memberikan akses pendidikan berkualitas di daerah terpencil bagi siswa/i berprestasi dengan latar belakang ekonomi yang kurang menguntungkan, yaitu dengan mendirikan Politeknik Informatika Del dan SMA Unggul Del di Laguboti, Sumatera Utara serta Sekolah NOAH di Kalisari, Jakarta Timur.</p>\r\n\r\n<p>Tidak hanya berkiprah di bidang pendidikan, Yayasan Del juga aktif bekerjasama dengan pemerintah daerah dan lembaga sosial yang ada di Indonesia untuk meningkatkan pelayanan serta memperluas cakrawala bidang pelayanan strategis lainnya.</p>\r\n\r\n<p>Politeknik Informatika Del didirikan pada tahun 2001 dan bertujuan untuk menyediakan pendidikan tinggi berkualitas internasional, bagi siswa/i berpotensi, terutama dengan latar belakang ekonomi yang kurang menguntungkan, khususnya yang berasal dari Sumatera Utara.</p>\r\n\r\n<p>Disamping turut berperan sebagai inisiator penggerak pembangunan di Tapanuli, IT Del juga diharapkan dapat menginkubasi lahirnya para&nbsp;<em>technopreneur</em>&nbsp;baru di bidang teknologi informasi.</p>\r\n\r\n<p>Dengan lokasi di daerah tepian Danau Toba, berjarak sekitar 400 KM dari kota Medan, area IT Del diharapkan dapat memberikan suasana tenang dan kondusif dalam belajar, karena jauh dari kebisingan dan hiruk pikuk suasana perkotaan/perindustrian.</p>\r\n','2016-10-31',0,NULL,0,NULL,'admin','2016-10-22 20:23:03','admin','2016-10-22 20:23:03'),(5,5,'2016-10-22','FAQ','faq','<blockquote>\r\n<ol>\r\n	<li><strong>Saya mahasiswa / alumni IT DEL, apakah saya perlu mendaftar sebagai member Del Career Center?</strong></li>\r\n</ol>\r\n</blockquote>\r\n\r\n<blockquote>\r\n<ul>\r\n	<li>Setiap mahasiswa dan alumni IT DEL&nbsp;secara otomatis terdaftar sebagai member Del Career Center. Untuk informasi lebih lanjut, silahkan hubungi Administrator</li>\r\n</ul>\r\n</blockquote>\r\n','2016-10-31',4,NULL,0,NULL,'admin','2016-10-22 20:26:38','admin','2016-10-22 20:29:34');

/*Table structure for table `preferencetypes` */

DROP TABLE IF EXISTS `preferencetypes`;

CREATE TABLE `preferencetypes` (
  `PreferenceTypeID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PreferenceTypeName` varchar(50) NOT NULL,
  PRIMARY KEY (`PreferenceTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `preferencetypes` */

insert  into `preferencetypes`(`PreferenceTypeID`,`PreferenceTypeName`) values (1,'Industry Type'),(2,'Education Type'),(3,'Position'),(4,'Location'),(5,'Vacancy Type');

/*Table structure for table `religions` */

DROP TABLE IF EXISTS `religions`;

CREATE TABLE `religions` (
  `ReligionID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ReligionName` varchar(50) NOT NULL,
  PRIMARY KEY (`ReligionID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `religions` */

insert  into `religions`(`ReligionID`,`ReligionName`) values (1,'Protestan'),(2,'Katolik'),(3,'Islam'),(4,'Hindu'),(5,'Buddha'),(6,'Konghucu');

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `RoleID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `RoleName` varchar(50) NOT NULL,
  PRIMARY KEY (`RoleID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `roles` */

insert  into `roles`(`RoleID`,`RoleName`) values (1,'Administrator'),(2,'Company'),(3,'User');

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `SettingID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `SettingLabel` varchar(50) NOT NULL,
  `SettingName` varchar(50) NOT NULL,
  `SettingValue` text NOT NULL,
  PRIMARY KEY (`SettingID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `settings` */

insert  into `settings`(`SettingID`,`SettingLabel`,`SettingName`,`SettingValue`) values (1,'Webmail','Webmail','yoelrolas@gmail.com'),(2,'Email Pengirim','EmailSender','noreply@sumuttekno.com'),(3,'Nama Email Pengirim','EmailSenderName','Sumut Tekno'),(4,'Protokol Email','EmailProtocol','smtp'),(5,'SMTP Host','SMTPHost','ssl://smtp.googlemail.com'),(6,'SMTP Port','SMTPPort','465'),(7,'SMTP Password','SMTPPassword','kairos120895'),(8,'SMTP Email','SMTPEmail','yoelrolas@gmail.com');

/*Table structure for table `status` */

DROP TABLE IF EXISTS `status`;

CREATE TABLE `status` (
  `StatusID` int(10) NOT NULL,
  `StatusName` varchar(50) NOT NULL,
  PRIMARY KEY (`StatusID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `status` */

insert  into `status`(`StatusID`,`StatusName`) values (1,'Diproses'),(2,'Diterima'),(3,'Ditolak');

/*Table structure for table `userinformation` */

DROP TABLE IF EXISTS `userinformation`;

CREATE TABLE `userinformation` (
  `UserName` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `CompanyID` int(10) DEFAULT NULL,
  `Name` varchar(250) DEFAULT NULL,
  `IdentityNo` varchar(50) DEFAULT NULL,
  `BirthDate` date DEFAULT NULL,
  `ReligionID` int(10) DEFAULT NULL,
  `Gender` tinyint(1) DEFAULT NULL,
  `Address` text,
  `PhoneNumber` varchar(50) DEFAULT NULL,
  `EducationID` int(10) DEFAULT NULL,
  `UniversityName` varchar(50) DEFAULT NULL,
  `FacultyName` varchar(50) DEFAULT NULL,
  `MajorName` varchar(50) DEFAULT NULL,
  `IsGraduated` tinyint(1) NOT NULL DEFAULT '0',
  `GraduatedDate` date DEFAULT NULL,
  `YearOfExperience` int(10) DEFAULT NULL,
  `RecentPosition` varchar(250) DEFAULT NULL,
  `RecentSalary` double DEFAULT NULL,
  `ExpectedSalary` double DEFAULT NULL,
  `CVFilename` varchar(250) DEFAULT NULL,
  `ImageFilename` varchar(250) DEFAULT NULL,
  `RegisteredDate` date DEFAULT NULL,
  PRIMARY KEY (`UserName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `userinformation` */

insert  into `userinformation`(`UserName`,`Email`,`CompanyID`,`Name`,`IdentityNo`,`BirthDate`,`ReligionID`,`Gender`,`Address`,`PhoneNumber`,`EducationID`,`UniversityName`,`FacultyName`,`MajorName`,`IsGraduated`,`GraduatedDate`,`YearOfExperience`,`RecentPosition`,`RecentSalary`,`ExpectedSalary`,`CVFilename`,`ImageFilename`,`RegisteredDate`) values ('admin','webmaster@cdc.del.ac.id',NULL,'Administrator',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('operator','operator@dcc.sumutekno.com',NULL,'','','1970-01-01',0,1,'','',0,'','','',0,NULL,0,'',0,NULL,NULL,NULL,'2016-10-16');

/*Table structure for table `userpreferences` */

DROP TABLE IF EXISTS `userpreferences`;

CREATE TABLE `userpreferences` (
  `UserName` varchar(50) NOT NULL,
  `PreferenceTypeID` int(10) NOT NULL,
  `PreferenceValue` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `userpreferences` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `RoleID` int(10) unsigned NOT NULL,
  `IsSuspend` tinyint(1) unsigned NOT NULL,
  `LastLogin` datetime DEFAULT NULL,
  `LastLoginIP` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`UserName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`UserName`,`Password`,`RoleID`,`IsSuspend`,`LastLogin`,`LastLoginIP`) values ('admin','21232f297a57a5a743894a0e4a801fc3',1,0,'2016-11-12 22:27:12','::1'),('operator','bbfb3b97637d3caa18d4f73c6bf1b3b6',1,0,NULL,NULL);

/*Table structure for table `vacancies` */

DROP TABLE IF EXISTS `vacancies`;

CREATE TABLE `vacancies` (
  `VacancyID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CompanyID` int(10) unsigned NOT NULL,
  `VacancyTypeID` int(10) unsigned NOT NULL,
  `PositionID` int(10) unsigned NOT NULL,
  `VacancyTitle` varchar(50) NOT NULL,
  `EndDate` date NOT NULL,
  `VacancyEmail` varchar(50) NOT NULL,
  `VacancyDesc` text,
  `VacancyResponsibility` text,
  `VacancyRequirement` text,
  `IsAllLocation` tinyint(1) NOT NULL DEFAULT '1',
  `OtherLocations` text,
  `TotalView` bigint(11) unsigned NOT NULL DEFAULT '0',
  `CreatedBy` varchar(50) NOT NULL,
  `CreatedOn` datetime NOT NULL,
  `UpdatedBy` varchar(50) NOT NULL,
  `UpdatedOn` datetime NOT NULL,
  `IsSuspend` tinyint(1) NOT NULL DEFAULT '1',
  `AttachmentFileName` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`VacancyID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `vacancies` */

/*Table structure for table `vacancyapplies` */

DROP TABLE IF EXISTS `vacancyapplies`;

CREATE TABLE `vacancyapplies` (
  `VacancyApplyID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `VacancyID` int(10) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `ApplyDate` datetime NOT NULL,
  `StatusID` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`VacancyApplyID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `vacancyapplies` */

/*Table structure for table `vacancyeducations` */

DROP TABLE IF EXISTS `vacancyeducations`;

CREATE TABLE `vacancyeducations` (
  `VacancyID` int(10) unsigned NOT NULL,
  `EducationTypeID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`VacancyID`,`EducationTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `vacancyeducations` */

/*Table structure for table `vacancylocations` */

DROP TABLE IF EXISTS `vacancylocations`;

CREATE TABLE `vacancylocations` (
  `VacancyID` int(10) unsigned NOT NULL,
  `LocationID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`VacancyID`,`LocationID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `vacancylocations` */

/*Table structure for table `vacancytypes` */

DROP TABLE IF EXISTS `vacancytypes`;

CREATE TABLE `vacancytypes` (
  `VacancyTypeID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `VacancyTypeName` varchar(50) NOT NULL,
  PRIMARY KEY (`VacancyTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `vacancytypes` */

insert  into `vacancytypes`(`VacancyTypeID`,`VacancyTypeName`) values (1,'Kontrak'),(2,'Paruh Waktu'),(4,'Permanen'),(5,'Magang');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
