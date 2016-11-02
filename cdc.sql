/*
SQLyog Community v11.51 (32 bit)
MySQL - 5.6.25 : Database - cdc
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

insert  into `companies`(`CompanyID`,`CompanyName`,`CompanyAddress`,`CompanyTelp`,`CompanyFax`,`CompanyWebsite`,`CompanyEmail`,`IndustryTypeID`,`CompanyDescription`,`RegisterDate`,`ApprovedDate`,`FileName`) values (1,'Institut Teknologi Del','Sitoluama, Laguboti','123456','123456','http://www.del.ac.id','info@del.ac.id',1,NULL,'2016-10-23 19:45:07','2016-10-23 19:45:07',''),(2,'Tao Toba Technologies','Medan','123456','123456','http://www.taotobatech.co.id','info@taotobatech.co.id',1,NULL,'2016-10-23 19:46:33','2016-10-23 19:46:33',''),(3,'Bintika Bangun Nusa','Medan','123456','123456','http://www.bbn.co.id','info@bbn.co.id',2,NULL,'2016-10-23 19:47:38','2016-10-23 19:55:29',''),(4,'BANK INDONESIA','Jakarta','123456','123456','http://www.bankindonesia.co.id','info@bankindonesia.co.id',2,NULL,'2016-10-23 19:48:29','2016-10-23 19:55:29',''),(5,'PERTAMINA','Jakarta','123456','123456','http://www.pertamina.co.id','info@pertamina.co.id',3,NULL,'2016-10-23 19:49:22','2016-10-23 19:49:22',''),(6,'DJARUM','Kudus','123456','123456','http://djarum.com','info@djarumindonesia.co.id',3,NULL,'2016-10-23 19:50:29','2016-10-23 19:50:29',''),(7,'Coffindo','Medan','123456','123456','http://www.coffindo.co.id','info@coffindo.co.id',1,NULL,'2016-10-23 19:52:21','2016-10-23 19:52:21',''),(8,'MANIK Inc.','MEDAN','123456','123456','http://horas.sumuttekno.com','rirismanik17@gmail.com',3,NULL,'2016-10-28 20:53:30','2016-10-28 20:53:30','');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `industrytypes` */

insert  into `industrytypes`(`IndustryTypeID`,`IndustryTypeName`) values (1,'Information Technology'),(2,'Finance'),(3,'Oil and Gas');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `notifications` */

insert  into `notifications`(`NotificationID`,`NotificationName`,`NotificationSubject`,`NotificationContent`,`NotificationSenderEmail`,`NotificationSenderName`,`NotificationToEmail`,`NotificationCCEmail`,`NotificationBCCEmail`,`IsActive`) values (1,'Perusahaan Baru','Pendaftaran Perusahaan Baru','<p>Dear admin,<br />\r\n<br />\r\nPendaftaran perusahaan baru dengan rincian sebagai berikut:<br />\r\n<br />\r\nUsername : @USERNAME@<br />\r\nEmail : @EMAIL@<br />\r\nNama Perusahaan : @COMPANYNAME@<br />\r\n<br />\r\nSilahkan mengunjungi @URL@ untuk melihat data dan konfirmasi akun.</p>\r\n\r\n<p><br />\r\n@SITENAME@</p>\r\n','noreply@sumuttekno.com','Del Career Center',NULL,NULL,NULL,1),(2,'Konfirmasi Aktivasi Akun Perusahaan','Akun Perusahaan Telah Diaktivasi','<p>Dear @COMPANYNAME@,<br />\r\n<br />\r\nSelamat bergabung di @SITENAME@!<br />\r\nAkun anda telah diaktivasi oleh administrator dengan rincian sebagai berikut:<br />\r\n<br />\r\nUsername : @USERNAME@<br />\r\nEmail : @EMAIL@<br />\r\nNama Perusahaan : @COMPANYNAME@<br />\r\n<br />\r\nAnda dapat login melalui link berikut: @URL@. Harap menjaga kerahasiaan akun anda dan menggunakannya sebaik mungkin.</p>\r\n\r\n<p><br />\r\n@SITENAME@</p>\r\n','noreply@sumuttekno.com','Del Career Center',NULL,NULL,NULL,1),(3,'Lowongan Baru Untuk Admin','Lowongan Baru dari @COMPANYNAME@','<p>Dear admin,<br />\r\n<br />\r\n@COMPANYNAME@ telah menambahkan lowongan baru pada @SITENAME@ dengan rincian sebagai berikut:<br />\r\n<br />\r\nJudul Lowongan : @VACANCYTITLE@<br />\r\nTipe : @VACANCYTYPE@<br />\r\nPosisi : @VACANCYPOSITION@<br />\r\n<br />\r\nStatus lowongan saat ini adalah @STATUS@, silahkan kunjungi @URL@ untuk melihat detil lowongan diatas.</p>\r\n\r\n<p><br />\r\n@SITENAME@</p>\r\n','noreply@sumuttekno.com','Del Career Center',NULL,NULL,NULL,1),(4,'Lowongan Baru Untuk User','Lowongan Baru dari @COMPANYNAME@','<p>Dear @NAME@,<br />\r\n<br />\r\n@COMPANYNAME@ telah menambahkan lowongan baru pada @SITENAME@ dengan rincian sebagai berikut:<br />\r\n<br />\r\nJudul Lowongan : @VACANCYTITLE@<br />\r\nTipe : @VACANCYTYPE@<br />\r\nPosisi : @VACANCYPOSITION@<br />\r\n<br />\r\nSilahkan kunjungi @URL@ untuk melihat detil lowongan diatas.</p>\r\n\r\n<p><br />\r\n@SITENAME@</p>\r\n','noreply@sumuttekno.com','Del Career Center',NULL,NULL,NULL,1),(5,'Lamaran Baru Untuk Perusahaan','Lamaran Baru dari @NAME@','<p>Dear @COMPANYNAME@,<br />\r\n<br />\r\n@NAME@ telah melihat lowongan anda (@VACANCYTITLE@) pada @SITENAME@ dan tertarik untuk\r\nmelamar pada lowongan dengan rincian: <br />\r\n<br />\r\nNama : @NAME@<br />\r\nEmail : @EMAIL@<br />\r\nAlamat : @ADDRESS@<br />\r\nPendidikan : @EDUCATIONTYPENAME@<br />\r\n<br />\r\nSilahkan kunjungi @URL@ untuk melihat detil pelamar diatas.</p>\r\n\r\n<p><br />\r\n@SITENAME@</p>\r\n','noreply@sumuttekno.com','Del Career Center',NULL,NULL,NULL,1),(6,'Lamaran Baru Untuk User','Lamaran Anda Telah Dikirim','TEST','noreply@sumuttekno.com','Del Career Center',NULL,NULL,NULL,1);

/*Table structure for table `positions` */

DROP TABLE IF EXISTS `positions`;

CREATE TABLE `positions` (
  `PositionID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PositionName` varchar(50) NOT NULL,
  PRIMARY KEY (`PositionID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `positions` */

insert  into `positions`(`PositionID`,`PositionName`) values (2,'Staff IT'),(3,'Admin'),(4,'Akunting'),(5,'Mekanik'),(6,'Dokter'),(7,'Personalia');

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

insert  into `posts`(`PostID`,`PostCategoryID`,`PostDate`,`PostTitle`,`PostSlug`,`PostContent`,`PostExpiredDate`,`TotalView`,`LastViewDate`,`IsSuspend`,`FileName`,`CreatedBy`,`CreatedOn`,`UpdatedBy`,`UpdatedOn`) values (1,1,'2016-10-18','Interdum et malesuada fames ac ante ipsum elementum vel lorem eu primis in faucibus','interdum-et-malesuada-fames-ac-ante-ipsum-elementum-vel-lorem-eu-primis-in-faucibus','<ul>\r\n	<li>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</li>\r\n	<li>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</li>\r\n</ul>\r\n','2016-10-31',4,NULL,0,'55.jpg','admin','2016-10-18 19:14:58','admin','2016-10-18 20:14:43'),(2,1,'2016-10-18','Swimmer Ryan Lochte wins endorsement deal for ‘forgiving’ throat drop','swimmer-ryan-lochte-wins-endorsement-deal-for-forgiving-throat-drop','<p>Integer rhoncus vestibulum lectus ac sodales. Vestibulum dapibus, magna quis finibus scelerisque, sapien nisl rutrum mauris, eget ullamcorper est purus pharetra orci. Nam eu magna sit amet dui convallis rhoncus non vel odio. Phasellus in libero nec nunc venenatis finibus sed in neque.Nullam auctor, quam ut eleifend hendrerit, tellus mauris dignissim nibh, nec euismod felis odio ac ex. Maecenas finibus lacinia fermentum.Vestibulum hendrerit, mauris vel convallis semper, ante purus vehicula diam, non blandit leo leo ac justo. Praesent viverra, lacus et tempus tincidunt, massa eros eleifend massa, ac tempus ipsum justo vel erat.Mauris vitae magna lacinia, vehicula diam sed, rutrum tortor. Maecenas orci nibh, tincidunt quis eros ac, vehicula rhoncus lacus. Maecenas ut justo sit amet lectus consequat mollis. Phasellus vehicula consequat vehicula.<em>&quot;Fusce nulla turpis, tempor at auctor et, dignissim semper ligula. Cras eu dolor blandit, facilisis mi et, ultrices orci sapien nisl rutrum mauris, eget ullamcorper est purus pharetra orci. Nam eu magna sit amet dui convallis rhoncus non vel odio. Phasellus in libero nec nunc venenatis finibus sed in neque.</em>Vestibulum hendrerit, mauris vel convallis semper, ante purus vehicula diam, non blandit leo leo ac justo. Praesent viverra, lacus et tempus tincidunt, massa eros eleifend massa, ac tempus ipsum justo vel erat.</p>\r\n','2016-11-05',3,NULL,0,NULL,'admin','2016-10-18 20:16:10','admin','2016-10-18 20:16:10'),(3,3,'2016-10-18','U.S. Navy ship fires warning shots at Iranian vessel','u-s-navy-ship-fires-warning-shots-at-iranian-vessel','<ul>\r\n	<li>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</li>\r\n	<li>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</li>\r\n</ul>\r\n','2016-11-05',3,NULL,0,NULL,'admin','2016-10-18 20:25:16','admin','2016-10-18 20:25:16'),(4,5,'2016-10-22','Contact Us','contact-us','<p>DEL dimaknai sebagai `Pemimpin yang Selangkah Lebih Maju`.</p>\r\n\r\n<p>Yayasan Del mulai aktif di kegiatan sosial kemasyarakatan jauh sebelum didirikannya PT Toba Sejahtera, perusahaan yang kemudian menjadi Yayasan Del sebagai tonggak tanggung jawab sosial perusahaan.</p>\r\n\r\n<p>Tujuan awal Yayasan Del didirikan adalah untuk memberikan akses pendidikan berkualitas di daerah terpencil bagi siswa/i berprestasi dengan latar belakang ekonomi yang kurang menguntungkan, yaitu dengan mendirikan Politeknik Informatika Del dan SMA Unggul Del di Laguboti, Sumatera Utara serta Sekolah NOAH di Kalisari, Jakarta Timur.</p>\r\n\r\n<p>Tidak hanya berkiprah di bidang pendidikan, Yayasan Del juga aktif bekerjasama dengan pemerintah daerah dan lembaga sosial yang ada di Indonesia untuk meningkatkan pelayanan serta memperluas cakrawala bidang pelayanan strategis lainnya.</p>\r\n\r\n<p>Politeknik Informatika Del didirikan pada tahun 2001 dan bertujuan untuk menyediakan pendidikan tinggi berkualitas internasional, bagi siswa/i berpotensi, terutama dengan latar belakang ekonomi yang kurang menguntungkan, khususnya yang berasal dari Sumatera Utara.</p>\r\n\r\n<p>Disamping turut berperan sebagai inisiator penggerak pembangunan di Tapanuli, IT Del juga diharapkan dapat menginkubasi lahirnya para&nbsp;<em>technopreneur</em>&nbsp;baru di bidang teknologi informasi.</p>\r\n\r\n<p>Dengan lokasi di daerah tepian Danau Toba, berjarak sekitar 400 KM dari kota Medan, area IT Del diharapkan dapat memberikan suasana tenang dan kondusif dalam belajar, karena jauh dari kebisingan dan hiruk pikuk suasana perkotaan/perindustrian.</p>\r\n','2016-10-31',0,NULL,0,NULL,'admin','2016-10-22 20:23:03','admin','2016-10-22 20:23:03'),(5,5,'2016-10-22','FAQ','faq','<blockquote>\r\n<ol>\r\n	<li><strong>Saya mahasiswa / alumni IT DEL, apakah saya perlu mendaftar sebagai member Del Career Center?</strong></li>\r\n</ol>\r\n</blockquote>\r\n\r\n<blockquote>\r\n<ul>\r\n	<li>Setiap mahasiswa dan alumni IT DEL&nbsp;secara otomatis terdaftar sebagai member Del Career Center. Untuk informasi lebih lanjut, silahkan hubungi Administrator</li>\r\n</ul>\r\n</blockquote>\r\n','2016-10-31',3,NULL,0,NULL,'admin','2016-10-22 20:26:38','admin','2016-10-22 20:29:34');

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

insert  into `userinformation`(`UserName`,`Email`,`CompanyID`,`Name`,`IdentityNo`,`BirthDate`,`ReligionID`,`Gender`,`Address`,`PhoneNumber`,`EducationID`,`UniversityName`,`FacultyName`,`MajorName`,`IsGraduated`,`GraduatedDate`,`YearOfExperience`,`RecentPosition`,`RecentSalary`,`ExpectedSalary`,`CVFilename`,`ImageFilename`,`RegisteredDate`) values ('admin','webmaster@cdc.del.ac.id',NULL,'Administrator',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('adminbank','info@bankindonesia.co.id',4,'','','1970-01-01',0,1,'','',0,'','','',0,NULL,0,'',0,NULL,NULL,NULL,'2016-10-23'),('adminbbn','info@bbn.co.id',3,'','','1970-01-01',0,1,'','',0,'','','',0,NULL,0,'',0,NULL,NULL,NULL,'2016-10-23'),('admincoffindo','info@coffindo.co.id',7,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('admindel','info@del.ac.id',1,'','','1970-01-01',0,1,'','',0,'','','',0,NULL,0,'',0,NULL,NULL,NULL,'2016-10-23'),('admindjarum','info@djarumindonesia.co.id',6,'','','1970-01-01',0,1,'','',0,'','','',0,NULL,0,'',0,NULL,NULL,NULL,'2016-10-23'),('adminpertamina','info@pertamina.co.id',5,'','','1970-01-01',0,1,'','',0,'','','',0,NULL,0,'',0,NULL,NULL,NULL,'2016-10-23'),('operator','operator@dcc.sumutekno.com',NULL,'','','1970-01-01',0,1,'','',0,'','','',0,NULL,0,'',0,NULL,NULL,NULL,'2016-10-16'),('rirismanik','rirismanik17@gmail.com',8,'','','1970-01-01',0,1,'','',0,'','','',0,NULL,0,'',0,NULL,NULL,NULL,'2016-10-28'),('taotobatech','info@taotobatech.co.id',2,'','','1970-01-01',0,1,'','',0,'','','',0,NULL,0,'',0,NULL,NULL,NULL,'2016-10-23'),('yoelrolas','yoelrolas@gmail.com',NULL,'Yoel Rolas Simanjuntak','123456','1995-08-12',1,1,'Jln. Karya Gang Adil No.16 Kel. Sei Agul, Medan','089669100393',6,'Institut Teknologi Del','Teknik Elektro dan Informatika','Teknik Komputer',1,'2015-09-05',1,'Web Programmer',4000000,NULL,NULL,NULL,'2016-10-24');

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

insert  into `users`(`UserName`,`Password`,`RoleID`,`IsSuspend`,`LastLogin`,`LastLoginIP`) values ('admin','21232f297a57a5a743894a0e4a801fc3',1,0,'2016-10-28 21:52:40','::1'),('adminbank','e10adc3949ba59abbe56e057f20f883e',2,0,NULL,NULL),('adminbbn','e10adc3949ba59abbe56e057f20f883e',2,0,NULL,NULL),('admincoffindo','e10adc3949ba59abbe56e057f20f883e',2,0,NULL,NULL),('admindel','e10adc3949ba59abbe56e057f20f883e',2,0,'2016-10-31 15:45:37','::1'),('admindjarum','e10adc3949ba59abbe56e057f20f883e',2,0,NULL,NULL),('adminpertamina','e10adc3949ba59abbe56e057f20f883e',2,0,'2016-10-24 20:36:27','::1'),('operator','bbfb3b97637d3caa18d4f73c6bf1b3b6',1,0,NULL,NULL),('rirismanik','e10adc3949ba59abbe56e057f20f883e',2,1,'2016-10-28 20:54:03','::1'),('taotobatech','e10adc3949ba59abbe56e057f20f883e',2,0,NULL,NULL),('yoelrolas','e10adc3949ba59abbe56e057f20f883e',3,0,'2016-10-28 22:04:28','::1');

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

insert  into `vacancies`(`VacancyID`,`CompanyID`,`VacancyTypeID`,`PositionID`,`VacancyTitle`,`EndDate`,`VacancyEmail`,`VacancyDesc`,`VacancyResponsibility`,`VacancyRequirement`,`IsAllLocation`,`TotalView`,`CreatedBy`,`CreatedOn`,`UpdatedBy`,`UpdatedOn`,`IsSuspend`,`AttachmentFileName`) values (1,1,1,2,'Full Stack Web Developer','2016-10-31','info@del.ac.id','<p>TEST</p>\r\n','<p>TEST</p>\r\n','<p>TEST</p>\r\n',0,3,'admin','2016-10-23 19:57:28','admindel','2016-10-31 16:14:12',0,'DCC_Vacancies2.pdf'),(2,5,4,7,'Human Resource Manager','2016-11-05','info@pertamina.co.id','<p>TEST</p>\r\n','<p>TEST</p>\r\n','<p>TEST</p>\r\n',1,0,'admin','2016-10-23 19:57:28','admin','2016-10-23 19:58:24',0,NULL),(3,3,4,4,'Accounting Manager','2016-11-05','info@bbn.co.id','<p>TEST</p>\r\n','<p>TEST</p>\r\n','<p>TEST</p>\r\n',0,6,'admin','2016-10-23 19:57:28','admin','2016-10-23 20:01:51',0,NULL),(4,2,4,2,'Programmer','2016-11-03','info@taotobatech.co.id','<p>TEST</p>\r\n','<p>TEST</p>\r\n','<p>TEST</p>\r\n',0,0,'admin','2016-10-23 19:57:28','admin','2016-10-23 20:02:50',0,NULL),(5,4,4,3,'Branch Manager','2016-11-05','info@bankindonesia.co.id','<p>TEST</p>\r\n','<p>TEST</p>\r\n','<p>TEST</p>\r\n',1,0,'admin','2016-10-23 19:57:28','admin','2016-10-23 20:03:37',0,NULL),(6,5,4,2,'Programmer','2016-11-05','info@pertamina.co.id','<p>TEST</p>\r\n','<p>TEST</p>\r\n','<p>TEST</p>\r\n',0,2,'admin','2016-10-23 20:05:09','admin','2016-10-23 20:05:09',0,NULL),(7,5,4,6,'Medical Clinic Assistant','2016-10-31','info@pertamina.co.id','<p>TEST</p>\r\n','<p>TEST</p>\r\n','<p>TEST</p>\r\n',1,3,'admin','2016-10-23 20:06:03','admin','2016-10-23 20:06:03',0,NULL),(8,8,4,2,'Programmer','2016-11-05','rirismanik17@gmail.com','<p>TEST</p>\r\n','<p>TEST</p>\r\n','<p>TEST</p>\r\n',1,16,'rirismanik','2016-10-28 21:25:43','rirismanik','2016-10-28 21:25:43',0,NULL);

/*Table structure for table `vacancyapplies` */

DROP TABLE IF EXISTS `vacancyapplies`;

CREATE TABLE `vacancyapplies` (
  `VacancyID` int(10) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `ApplyDate` date NOT NULL,
  `StatusID` int(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `vacancyapplies` */

/*Table structure for table `vacancyeducations` */

DROP TABLE IF EXISTS `vacancyeducations`;

CREATE TABLE `vacancyeducations` (
  `VacancyID` int(10) unsigned NOT NULL,
  `EducationTypeID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`VacancyID`,`EducationTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `vacancyeducations` */

insert  into `vacancyeducations`(`VacancyID`,`EducationTypeID`) values (1,6),(1,7),(1,8),(2,8),(3,8),(3,9),(4,6),(4,7),(4,8),(5,9),(5,10),(6,8),(7,8),(8,6);

/*Table structure for table `vacancylocations` */

DROP TABLE IF EXISTS `vacancylocations`;

CREATE TABLE `vacancylocations` (
  `VacancyID` int(10) unsigned NOT NULL,
  `LocationID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`VacancyID`,`LocationID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `vacancylocations` */

insert  into `vacancylocations`(`VacancyID`,`LocationID`) values (1,4),(3,1),(3,5),(3,6),(4,1),(4,2),(4,4),(6,5);

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
