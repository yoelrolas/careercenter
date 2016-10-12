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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `companies` */

insert  into `companies`(`CompanyID`,`CompanyName`,`CompanyAddress`,`CompanyTelp`,`CompanyFax`,`CompanyWebsite`,`CompanyEmail`,`IndustryTypeID`,`CompanyDescription`,`RegisterDate`,`ApprovedDate`,`FileName`) values (1,'IT DEL','TEST','123456','654321','http://www.del.ac.id','admin@del.ac.id',1,'<p><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</em></p>\r\n','2016-10-12 11:32:17','2016-10-12 11:32:17','itdel1.jpg'),(2,'IBM','IBM','123456','654321','http://ibm.com','ibm@ibm.com',1,NULL,'2016-10-12 11:51:57','2016-10-12 11:51:57','ibm.png'),(3,'DJARUM','DJARUM','123456','123456','http://djarum.com','admin@djarum.com',3,NULL,'2016-10-12 12:09:22','2016-10-12 12:10:05','djarum2.jpg');

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

/*Table structure for table `positions` */

DROP TABLE IF EXISTS `positions`;

CREATE TABLE `positions` (
  `PositionID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PositionName` varchar(50) NOT NULL,
  PRIMARY KEY (`PositionID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `positions` */

insert  into `positions`(`PositionID`,`PositionName`) values (2,'Staff IT'),(3,'Admin'),(4,'Akunting'),(5,'Mekanik'),(6,'Dokter'),(7,'Personalia');

/*Table structure for table `userinformation` */

DROP TABLE IF EXISTS `userinformation`;

CREATE TABLE `userinformation` (
  `UserName` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `CompanyID` int(10) DEFAULT NULL,
  `EmployeeID` int(10) DEFAULT NULL,
  PRIMARY KEY (`UserName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `userinformation` */

insert  into `userinformation`(`UserName`,`Email`,`CompanyID`,`EmployeeID`) values ('admin','webmaster@cdc.del.ac.id',NULL,NULL),('admindel','admin@del.ac.id',1,NULL),('admindjarum','djarum@djarum.com',3,NULL),('adminibm','ibm@ibm.com',2,NULL);

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

insert  into `users`(`UserName`,`Password`,`RoleID`,`IsSuspend`,`LastLogin`,`LastLoginIP`) values ('admin','21232f297a57a5a743894a0e4a801fc3',1,0,'2016-10-12 19:37:03','::1'),('admindel','bbfb3b97637d3caa18d4f73c6bf1b3b6',2,0,'2016-10-12 19:34:06','::1'),('admindjarum','bbfb3b97637d3caa18d4f73c6bf1b3b6',2,0,'2016-10-12 12:10:25','::1'),('adminibm','bbfb3b97637d3caa18d4f73c6bf1b3b6',2,0,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `vacancies` */

insert  into `vacancies`(`VacancyID`,`CompanyID`,`VacancyTypeID`,`PositionID`,`VacancyTitle`,`EndDate`,`VacancyEmail`,`VacancyDesc`,`VacancyResponsibility`,`VacancyRequirement`,`IsAllLocation`,`TotalView`,`CreatedBy`,`CreatedOn`,`UpdatedBy`,`UpdatedOn`,`IsSuspend`) values (1,3,4,7,'Manager','2016-10-31','hrd@djarum.com','<p><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</em></p>\r\n','<p><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</em></p>\r\n','<ul>\r\n	<li><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</em></li>\r\n	<li><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</em></li>\r\n	<li><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</em></li>\r\n</ul>\r\n',0,11,'admindjarum','2016-10-12 12:15:25','admindjarum','2016-10-12 12:15:25',0),(2,1,1,2,'Project Manager','2016-11-01','hrd@del.ac.id','<p><span class=\"marker\"><s>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</s></span></p>\r\n','<blockquote>\r\n<p><big>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</big></p>\r\n</blockquote>\r\n','<ul>\r\n	<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>\r\n	<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>\r\n</ul>\r\n',1,4,'admindel','2016-10-12 19:36:40','admindel','2016-10-12 19:36:40',0);

/*Table structure for table `vacancyeducations` */

DROP TABLE IF EXISTS `vacancyeducations`;

CREATE TABLE `vacancyeducations` (
  `VacancyID` int(10) unsigned NOT NULL,
  `EducationTypeID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`VacancyID`,`EducationTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `vacancyeducations` */

insert  into `vacancyeducations`(`VacancyID`,`EducationTypeID`) values (1,8),(1,9),(2,6),(2,7),(2,8);

/*Table structure for table `vacancylocations` */

DROP TABLE IF EXISTS `vacancylocations`;

CREATE TABLE `vacancylocations` (
  `VacancyID` int(10) unsigned NOT NULL,
  `LocationID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`VacancyID`,`LocationID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `vacancylocations` */

insert  into `vacancylocations`(`VacancyID`,`LocationID`) values (1,1),(1,2);

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
