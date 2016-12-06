/*
SQLyog Enterprise Trial - MySQL GUI v7.11 
MySQL - 5.5.5-10.1.9-MariaDB : Database - rest_api
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`rest_api` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `rest_api`;

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cName` varchar(255) NOT NULL,
  `cDesc` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `categories` */

insert  into `categories`(`id`,`cName`,`cDesc`) values (1,'cloth','dsd'),(2,'laptop','sasas'),(3,'mobilea','sas'),(4,'kitchen','sasa'),(5,'beauty','asas');

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pName` varchar(255) NOT NULL,
  `pDesc` varchar(1000) NOT NULL,
  `price` float NOT NULL,
  `tax` float NOT NULL,
  `discount` float NOT NULL,
  `category` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

/*Data for the table `products` */

insert  into `products`(`id`,`pName`,`pDesc`,`price`,`tax`,`discount`,`category`) values (2,'test2','asa',222,1,3,1),(4,'test3','sasasasas',3000,12,200,2),(6,'kiran','sasasasas',3000,12,200,3),(51,'test4','hgghgh',6700,66,45,2),(54,'test7','sas',323,232,3,4),(55,'test2','sasa',3300,3,23,5);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
