CREATE DATABASE  IF NOT EXISTS `konnect` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `konnect`;

INSERT INTO `user` (`name`, `email`, `username`, `dob`) VALUES
('Shubh Gupta', 'sg@gmail.com', 'shubh123', '2018-05-01');


DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `organiser`;

CREATE TABLE `organiser` (
  `org_id` varchar(20) NOT NULL,
  `location` varchar(50) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`org_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `event`;

CREATE TABLE `event` (
  `event_id` varchar(10) NOT NULL,
  `e_name` varchar(20) DEFAULT NULL,
  `e_date` date DEFAULT NULL,
  `e_time` time DEFAULT NULL,
  `venue` varchar(50) DEFAULT NULL,
  `e_type` varchar(20) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `e_website` varchar(50) DEFAULT NULL,
  `org_id` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`event_id`),
  KEY `org_id` (`org_id`),
  CONSTRAINT `event_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `organiser` (`org_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `competitive`;

CREATE TABLE `competitive` (
  `team_size` int DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `prize_money` int DEFAULT NULL,
  `event_id` varchar(10) DEFAULT NULL,
  KEY `event_id` (`event_id`),
  CONSTRAINT `competitive_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `non_competitive`;

CREATE TABLE `non_competitive` (
  `speaker` varchar(50) DEFAULT NULL,
  `seats` int DEFAULT NULL,
  `event_id` varchar(10) DEFAULT NULL,
  KEY `event_id` (`event_id`),
  CONSTRAINT `non_competitive_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `participation`;

CREATE TABLE `participation` (
  `enroll_date` date DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `event_id` varchar(10) DEFAULT NULL,
  KEY `username` (`username`),
  KEY `event_id` (`event_id`),
  CONSTRAINT `participation_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`),
  CONSTRAINT `participation_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `user_contact`;

CREATE TABLE `user_contact` (
  `username` varchar(20) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  KEY `username` (`username`),
  CONSTRAINT `user_contact_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `account`;

CREATE TABLE `account` (
  `password` varchar(30) NOT NULL,
  `date_of_creation` date DEFAULT NULL,
  `verification` int DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `org_id` varchar(20) DEFAULT NULL,
  KEY `username` (`username`),
  KEY `org_id` (`org_id`),
  CONSTRAINT `account_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`),
  CONSTRAINT `account_ibfk_2` FOREIGN KEY (`org_id`) REFERENCES `organiser` (`org_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;