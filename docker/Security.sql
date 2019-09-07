# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.1.14-MariaDB)
# Database: ssaportal
# Generation Time: 2016-07-05 05:24:44 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table Security_m_Attendance
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Security_m_Attendance`;

CREATE TABLE `Security_m_Attendance` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniquecode` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `resourcedate` date NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shifttype` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Evening',
  `memberid` int(11) NOT NULL DEFAULT '0',
  `personid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login` datetime DEFAULT NULL,
  `logout` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_m_event_eventdate_index` (`resourcedate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `Security_m_Attendance` WRITE;
/*!40000 ALTER TABLE `Security_m_Attendance` DISABLE KEYS */;

INSERT INTO `Security_m_Attendance` (`id`, `uniquecode`, `resourcedate`, `location`, `shifttype`, `memberid`, `personid`, `name`, `login`, `logout`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'20160602232208','2016-06-02','SSA HQ','Evening',26334,20874,'Chan Kuan Leang','2016-06-02 23:22:08',NULL,'2016-06-02 23:22:08','2016-06-06 15:01:00','2016-06-06 15:01:00'),
	(2,'20160602232228','2016-06-02','SSA HQ','Afternoon',26334,20874,'Chan Kuan Leang','2016-06-02 23:22:28','2016-06-10 15:27:06','2016-06-02 23:22:28','2016-06-10 15:27:06',NULL),
	(3,'20160603170532','2016-06-03','SSA HQ','Evening',26334,20874,'Chan Kuan Leang','2016-06-03 17:05:32','2016-06-10 17:10:41','2016-06-03 17:05:32','2016-06-10 17:10:41',NULL),
	(4,'20160603170553','2016-06-03','SSA HQ','Afternoon',26334,20874,'Chan Kuan Leang','2016-06-03 17:05:53','2016-06-06 16:57:37','2016-06-03 17:05:53','2016-06-10 14:46:39','2016-06-10 14:46:39'),
	(5,'20160610212207','2016-06-10','SSA HQ','Evening',26334,20874,'Chan Kuan Leang','2016-06-10 21:22:07',NULL,'2016-06-10 21:22:07','2016-06-10 21:22:07',NULL);

/*!40000 ALTER TABLE `Security_m_Attendance` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Security_m_Occurance
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Security_m_Occurance`;

CREATE TABLE `Security_m_Occurance` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniquecode` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `resourcedate` date NOT NULL,
  `occurancetype` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `memberid` int(11) NOT NULL DEFAULT '0',
  `personid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `staffresponse` text COLLATE utf8_unicode_ci,
  `status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_m_event_eventdate_index` (`resourcedate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table Security_z_OccuranceStatus
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Security_z_OccuranceStatus`;

CREATE TABLE `Security_z_OccuranceStatus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `Security_z_OccuranceStatus` WRITE;
/*!40000 ALTER TABLE `Security_z_OccuranceStatus` DISABLE KEYS */;

INSERT INTO `Security_z_OccuranceStatus` (`id`, `value`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'Active','2014-08-19 23:39:46','2014-08-19 23:39:46',NULL),
	(2,'Closed','2014-08-19 23:39:46','2014-08-19 23:39:46',NULL),
	(3,'Void','2014-08-19 23:39:46','2014-08-19 23:39:46',NULL);

/*!40000 ALTER TABLE `Security_z_OccuranceStatus` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Security_z_OccuranceType
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Security_z_OccuranceType`;

CREATE TABLE `Security_z_OccuranceType` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(25) DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `Security_z_OccuranceType` WRITE;
/*!40000 ALTER TABLE `Security_z_OccuranceType` DISABLE KEYS */;

INSERT INTO `Security_z_OccuranceType` (`id`, `value`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'Occurance','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(2,'Maintenance','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(3,'Confirmation of Duty','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL);

/*!40000 ALTER TABLE `Security_z_OccuranceType` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Security_z_Shift
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Security_z_Shift`;

CREATE TABLE `Security_z_Shift` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `Security_z_Shift` WRITE;
/*!40000 ALTER TABLE `Security_z_Shift` DISABLE KEYS */;

INSERT INTO `Security_z_Shift` (`id`, `value`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'Morning','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(2,'Afternoon','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(3,'Evening','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(4,'Overnight','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL);

/*!40000 ALTER TABLE `Security_z_Shift` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
