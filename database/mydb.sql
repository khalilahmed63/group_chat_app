/*
SQLyog Ultimate v12.5.0 (64 bit)
MySQL - 10.4.24-MariaDB : Database - group_chat_application
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`group_chat_application` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `group_chat_application`;

/*Table structure for table `chat` */

DROP TABLE IF EXISTS `chat`;

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL AUTO_INCREMENT,
  `message` longtext NOT NULL,
  `added_on` varchar(100) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`chat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

/*Data for the table `chat` */

insert  into `chat`(`chat_id`,`message`,`added_on`,`user_id`) values 
(7,'Hello','1649747033',3),
(8,'Hi All','1649748765',2),
(9,'Yes Naveed','1649748863',3),
(14,'Hi','1649749286',3),
(15,'Hi, How Are You John','1649749457',4),
(17,'hello','1649750236',1),
(18,'ggsggs','1649750243',1),
(19,'sadasd','1654225141',1),
(20,'asdfasdf','1654227070',1),
(21,'khalil ahmed','1654227093',1),
(22,'ahmed','1654227532',1),
(23,'hello','1654232238',12),
(24,'hello','1654233198',12),
(25,'hello','1655962871',13),
(26,'hi this is jawad','1655965144',12),
(27,'hello this is khalil ','1655965165',13);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_online` tinyint(1) NOT NULL DEFAULT 0,
  `image_path` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`user_id`,`first_name`,`last_name`,`email`,`password`,`is_online`,`image_path`) values 
(1,'baber','Bhatti','juveria@gmail.com','asdfasdf',0,'images/two.jpg'),
(2,'Naveed','Ahmed','naveed@gmail.com','827ccb0eea8a706c4c34a16891f84e7b',1,'images/one.jpg'),
(3,'John','Smith','john@gmail.com','827ccb0eea8a706c4c34a16891f84e7b',0,'images/three.jpg'),
(4,'Darshana','Khatri','darshana@gmail.com','827ccb0eea8a706c4c34a16891f84e7b',0,'images/four.jpg'),
(12,'jawad','ahmed','jawad@gmail.com','6a204bd89f3c8348afd5c77c717a097a',0,'images/IMG_20210810_235157.jpg'),
(13,'khalil','ahmed','khalil@gmail.com','6a204bd89f3c8348afd5c77c717a097a',1,'images/profile-img.jpg');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
