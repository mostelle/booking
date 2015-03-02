CREATE DATABASE `booking`;

USE `booking`;

CREATE TABLE `client` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(200) NOT NULL,
	`mail` VARCHAR(254) NOT NULL, /* max char dans un email : 254 */
	`pwd` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDb DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1;

CREATE TABLE `hostel` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(200) NOT NULL,
	`adresse` TEXT NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDb DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1;

CREATE TABLE `room` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`number` int(11) NOT NULL,
	`hotel_id` int(11) NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDb DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1;

CREATE TABLE `bookit` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`start` int(11) NOT NULL,
	`end` int(11) NOT NULL,
	`creation` DATE NOT NULL,
	`room_id` int(11) NOT NULL,
	`client_id` int(11) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDb DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1;

INSERT INTO `hostel` (`name`,`adresse`) VALUES
('Hotel de la muerte','18, place du village des Schtroumpfs 13666 Peyoland'),
('Hotel de la plage','56, avenue du Morbihan 56560 Plagek-sur-Roche'),
('Hotel de la ville','33, rue de l\'Apéro 83321 Pernod-Ricard'),
('Palace Hotel','1 rue Principal 06145 Monegasque-sur-Mer');

INSERT INTO `room` (`number`, `hotel_id`) VALUES
(1,1),
(2,1),
(3,1),
(4,1),
(5,1),
(1,2),
(2,2),
(3,2),
(4,2),
(5,2),
(1,3),
(2,3),
(3,3),
(1,4),
(2,4),
(3,4),
(4,4);

INSERT INTO `client` (`name`, `mail`, `pwd`) VALUES
('Georgio', 'georgio@memel.com', 'toto'),
('Mikael', 'mikael@memel.com', 'toto'),
('Sophie', 'sophie@memel.com', 'toto');