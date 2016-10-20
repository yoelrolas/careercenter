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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `companies` */

insert  into `companies`(`CompanyID`,`CompanyName`,`CompanyAddress`,`CompanyTelp`,`CompanyFax`,`CompanyWebsite`,`CompanyEmail`,`IndustryTypeID`,`CompanyDescription`,`RegisterDate`,`ApprovedDate`,`FileName`) values (1,'IT DEL','TEST','123456','654321','http://www.del.ac.id','admin@del.ac.id',1,'<p><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</em></p>\r\n','2016-10-12 11:32:17','2016-10-12 11:32:17','itdel1.jpg'),(2,'IBM','IBM','123456','654321','http://ibm.com','ibm@ibm.com',1,NULL,'2016-10-12 11:51:57','2016-10-12 11:51:57','ibm.png'),(3,'DJARUM','DJARUM','123456','123456','http://djarum.com','admin@djarum.com',3,NULL,'2016-10-12 12:09:22','2016-10-14 23:15:01','djarum2.jpg'),(4,'Sumut Tekno','Medan','123456',NULL,NULL,NULL,3,NULL,'2016-10-14 23:17:17','2016-10-14 23:17:36','sumuttekno.png'),(5,'PT Mitra Pasifik Solusindo','Medan','123456','123456','http://www.mpssoft.co.id','halo@mpssoft.co.id',2,NULL,'2016-10-16 17:06:02','2016-10-16 17:06:02','mpssoft.png');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `locations` */

insert  into `locations`(`LocationID`,`LocationName`) values (1,'Medan'),(2,'Pematang Siantar'),(4,'Laguboti');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `notifications` */

insert  into `notifications`(`NotificationID`,`NotificationName`,`NotificationSubject`,`NotificationContent`,`NotificationSenderEmail`,`NotificationSenderName`,`NotificationToEmail`,`NotificationCCEmail`,`NotificationBCCEmail`,`IsActive`) values (1,'Perusahaan Baru','Pendaftaran Perusahaan Baru','<p>Dear admin,<br />\r\n<br />\r\nPendaftaran perusahaan baru dengan rincian sebagai berikut:<br />\r\n<br />\r\nUsername : @USERNAME@<br />\r\nEmail : @EMAIL@<br />\r\nNama Perusahaan : @COMPANYNAME@<br />\r\n<br />\r\nSilahkan mengunjungi @URL@ untuk melihat data dan konfirmasi akun.</p>\r\n\r\n<p><br />\r\n@SITENAME@</p>\r\n','noreply@sumuttekno.com','Del Career Center',NULL,NULL,NULL,1),(2,'Konfirmasi Aktivasi Akun Perusahaan','Akun Perusahaan Telah Diaktivasi','<p>Dear @COMPANYNAME@,<br />\r\n<br />\r\nSelamat bergabung di @SITENAME@!<br />\r\nAkun anda telah diaktivasi oleh administrator dengan rincian sebagai berikut:<br />\r\n<br />\r\nUsername : @USERNAME@<br />\r\nEmail : @EMAIL@<br />\r\nNama Perusahaan : @COMPANYNAME@<br />\r\n<br />\r\nAnda dapat login melalui link berikut: @URL@. Harap menjaga kerahasiaan akun anda dan menggunakannya sebaik mungkin.</p>\r\n\r\n<p><br />\r\n@SITENAME@</p>\r\n','noreply@sumuttekno.com','Del Career Center',NULL,NULL,NULL,1),(3,'Lowongan Baru Untuk Admin','Lowongan Baru dari @COMPANYNAME@','<p>Dear admin,<br />\r\n<br />\r\n@COMPANYNAME@ telah menambahkan lowongan baru pada @SITENAME@ dengan rincian sebagai berikut:<br />\r\n<br />\r\nJudul Lowongan : @VACANCYTITLE@<br />\r\nTipe : @VACANCYTYPE@<br />\r\nPosisi : @VACANCYPOSITION@<br />\r\n<br />\r\nStatus lowongan saat ini adalah @STATUS@, silahkan kunjungi @URL@ untuk melihat detil lowongan diatas.</p>\r\n\r\n<p><br />\r\n@SITENAME@</p>\r\n','noreply@sumuttekno.com','Del Career Center',NULL,NULL,NULL,1),(4,'Lowongan Baru Untuk User','Lowongan Baru dari @COMPANYNAME@','<p>Dear @NAME@,<br />\r\n<br />\r\n@COMPANYNAME@ telah menambahkan lowongan baru pada @SITENAME@ dengan rincian sebagai berikut:<br />\r\n<br />\r\nJudul Lowongan : @VACANCYTITLE@<br />\r\nTipe : @VACANCYTYPE@<br />\r\nPosisi : @VACANCYPOSITION@<br />\r\n<br />\r\nSilahkan kunjungi @URL@ untuk melihat detil lowongan diatas.</p>\r\n\r\n<p><br />\r\n@SITENAME@</p>\r\n','noreply@sumuttekno.com','Del Career Center',NULL,NULL,NULL,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `postcategories` */

insert  into `postcategories`(`PostCategoryID`,`PostCategoryName`) values (1,'News'),(2,'Blog'),(3,'Event');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `posts` */

insert  into `posts`(`PostID`,`PostCategoryID`,`PostDate`,`PostTitle`,`PostSlug`,`PostContent`,`PostExpiredDate`,`TotalView`,`LastViewDate`,`IsSuspend`,`FileName`,`CreatedBy`,`CreatedOn`,`UpdatedBy`,`UpdatedOn`) values (1,1,'2016-10-18','Interdum et malesuada fames ac ante ipsum elementum vel lorem eu primis in faucibus','interdum-et-malesuada-fames-ac-ante-ipsum-elementum-vel-lorem-eu-primis-in-faucibus','<ul>\r\n	<li>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</li>\r\n	<li>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</li>\r\n</ul>\r\n','2016-10-31',4,NULL,0,'55.jpg','admin','2016-10-18 19:14:58','admin','2016-10-18 20:14:43'),(2,1,'2016-10-18','Swimmer Ryan Lochte wins endorsement deal for ‘forgiving’ throat drop','swimmer-ryan-lochte-wins-endorsement-deal-for-forgiving-throat-drop','<p>Integer rhoncus vestibulum lectus ac sodales. Vestibulum dapibus, magna quis finibus scelerisque, sapien nisl rutrum mauris, eget ullamcorper est purus pharetra orci. Nam eu magna sit amet dui convallis rhoncus non vel odio. Phasellus in libero nec nunc venenatis finibus sed in neque.Nullam auctor, quam ut eleifend hendrerit, tellus mauris dignissim nibh, nec euismod felis odio ac ex. Maecenas finibus lacinia fermentum.Vestibulum hendrerit, mauris vel convallis semper, ante purus vehicula diam, non blandit leo leo ac justo. Praesent viverra, lacus et tempus tincidunt, massa eros eleifend massa, ac tempus ipsum justo vel erat.Mauris vitae magna lacinia, vehicula diam sed, rutrum tortor. Maecenas orci nibh, tincidunt quis eros ac, vehicula rhoncus lacus. Maecenas ut justo sit amet lectus consequat mollis. Phasellus vehicula consequat vehicula.<em>&quot;Fusce nulla turpis, tempor at auctor et, dignissim semper ligula. Cras eu dolor blandit, facilisis mi et, ultrices orci sapien nisl rutrum mauris, eget ullamcorper est purus pharetra orci. Nam eu magna sit amet dui convallis rhoncus non vel odio. Phasellus in libero nec nunc venenatis finibus sed in neque.</em>Vestibulum hendrerit, mauris vel convallis semper, ante purus vehicula diam, non blandit leo leo ac justo. Praesent viverra, lacus et tempus tincidunt, massa eros eleifend massa, ac tempus ipsum justo vel erat.</p>\r\n','2016-11-05',3,NULL,0,NULL,'admin','2016-10-18 20:16:10','admin','2016-10-18 20:16:10'),(3,3,'2016-10-18','U.S. Navy ship fires warning shots at Iranian vessel','u-s-navy-ship-fires-warning-shots-at-iranian-vessel','<ul>\r\n	<li>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</li>\r\n	<li>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</li>\r\n</ul>\r\n','2016-11-05',2,NULL,0,NULL,'admin','2016-10-18 20:25:16','admin','2016-10-18 20:25:16');

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

insert  into `userinformation`(`UserName`,`Email`,`CompanyID`,`Name`,`IdentityNo`,`BirthDate`,`ReligionID`,`Gender`,`Address`,`PhoneNumber`,`EducationID`,`UniversityName`,`FacultyName`,`MajorName`,`IsGraduated`,`GraduatedDate`,`YearOfExperience`,`RecentPosition`,`RecentSalary`,`ExpectedSalary`,`CVFilename`,`ImageFilename`,`RegisteredDate`) values ('admin','webmaster@cdc.del.ac.id',NULL,'Administrator',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('admindel','admin@del.ac.id',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('admindjarum','djarum@djarum.com',3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('adminibm','ibm@ibm.com',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('maureen','rolassimanjuntak@gmail.com',NULL,'Maureen Simanjuntak','123456','2016-10-12',1,2,'Medan','123456',6,'Institut Teknologi Del','Teknik Elektro dan Informatika','',0,NULL,0,'',0,NULL,NULL,NULL,'2016-10-16'),('mpssoft','halo@mpssoft.co.id',5,'','','1970-01-01',0,1,'','',0,'','','',0,NULL,0,'',0,NULL,NULL,NULL,'2016-10-16'),('operator','operator@dcc.sumutekno.com',NULL,'','','1970-01-01',0,1,'','',0,'','','',0,NULL,0,'',0,NULL,NULL,NULL,'2016-10-16'),('sumuttekno','admin@sumuttekno.com',4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('yoelrolas','yoelrolas@gmail.com',NULL,'Yoel Rolas Simanjuntak','123456','1995-08-12',1,1,'Medan','123456',6,'Institut Teknologi Del','Teknik Elektro dan Informatika','05 Sep 2015',1,NULL,1,'Manager',12000000,NULL,NULL,NULL,'2016-10-16');

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

insert  into `users`(`UserName`,`Password`,`RoleID`,`IsSuspend`,`LastLogin`,`LastLoginIP`) values ('admin','21232f297a57a5a743894a0e4a801fc3',1,0,'2016-10-18 22:16:16','::1'),('admindel','bbfb3b97637d3caa18d4f73c6bf1b3b6',2,0,'2016-10-12 19:34:06','::1'),('admindjarum','bbfb3b97637d3caa18d4f73c6bf1b3b6',2,0,'2016-10-12 12:10:25','::1'),('adminibm','bbfb3b97637d3caa18d4f73c6bf1b3b6',2,0,NULL,NULL),('maureen','bbfb3b97637d3caa18d4f73c6bf1b3b6',3,0,NULL,NULL),('mpssoft','bbfb3b97637d3caa18d4f73c6bf1b3b6',2,0,NULL,NULL),('operator','bbfb3b97637d3caa18d4f73c6bf1b3b6',1,0,NULL,NULL),('sumuttekno','bbfb3b97637d3caa18d4f73c6bf1b3b6',2,0,'2016-10-15 23:52:15','::1'),('yoelrolas','bbfb3b97637d3caa18d4f73c6bf1b3b6',3,0,NULL,NULL);

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
  PRIMARY KEY (`VacancyID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `vacancies` */

insert  into `vacancies`(`VacancyID`,`CompanyID`,`VacancyTypeID`,`PositionID`,`VacancyTitle`,`EndDate`,`VacancyEmail`,`VacancyDesc`,`VacancyResponsibility`,`VacancyRequirement`,`IsAllLocation`,`TotalView`,`CreatedBy`,`CreatedOn`,`UpdatedBy`,`UpdatedOn`,`IsSuspend`) values (1,3,4,7,'Manager','2016-10-31','hrd@djarum.com','<p><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</em></p>\r\n','<p><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</em></p>\r\n','<ul>\r\n	<li><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</em></li>\r\n	<li><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</em></li>\r\n	<li><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</em></li>\r\n</ul>\r\n',0,11,'admindjarum','2016-10-12 12:15:25','admindjarum','2016-10-12 12:15:25',0),(2,1,1,2,'Project Manager','2016-11-01','hrd@del.ac.id','<p><span class=\"marker\"><s>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</s></span></p>\r\n','<blockquote>\r\n<p><big>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</big></p>\r\n</blockquote>\r\n','<ul>\r\n	<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>\r\n	<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>\r\n</ul>\r\n',1,5,'admindel','2016-10-12 19:36:40','admindel','2016-10-12 19:36:40',0),(3,4,1,7,'Public Relation Manager','2016-10-31','hrd@sumuttekno.com','<blockquote>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n</blockquote>\r\n','<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</div>\r\n','<ul>\r\n	<li>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</li>\r\n	<li>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</li>\r\n</ul>\r\n',0,2,'sumuttekno','2016-10-16 00:00:33','sumuttekno','2016-10-16 00:00:33',0),(4,5,5,2,'PHP Programmer','2016-11-05','hrd@sumuttekno.com','<p>TEST</p>\r\n','<p>TEST</p>\r\n','<p>TEST</p>\r\n',1,3,'admin','2016-10-16 19:52:35','admin','2016-10-16 19:52:35',0);

/*Table structure for table `vacancyeducations` */

DROP TABLE IF EXISTS `vacancyeducations`;

CREATE TABLE `vacancyeducations` (
  `VacancyID` int(10) unsigned NOT NULL,
  `EducationTypeID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`VacancyID`,`EducationTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `vacancyeducations` */

insert  into `vacancyeducations`(`VacancyID`,`EducationTypeID`) values (1,8),(1,9),(2,6),(2,7),(2,8),(3,8),(3,9),(4,6),(4,7),(4,8);

/*Table structure for table `vacancylocations` */

DROP TABLE IF EXISTS `vacancylocations`;

CREATE TABLE `vacancylocations` (
  `VacancyID` int(10) unsigned NOT NULL,
  `LocationID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`VacancyID`,`LocationID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `vacancylocations` */

insert  into `vacancylocations`(`VacancyID`,`LocationID`) values (1,1),(1,2),(3,1),(3,4);

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
