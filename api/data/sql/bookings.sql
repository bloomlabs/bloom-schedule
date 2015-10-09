DROP TABLE IF EXISTS `bookings`;

CREATE TABLE `bookings` (
	`booking_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`booking_title` varchar(255) NOT NULL DEFAULT '',
	`booking_room` tinyint(3) NOT NULL DEFAULT '1',
	`booking_creator` varchar(255) NOT NULL DEFAULT '',
	`booking_start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`booking_end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
	`booking_notes` text NOT NULL,
	`booking_attendees` tinyint(3) NOT NULL DEFAULT '0',
	`booking_guests` tinyint(3) NOT NULL DEFAULT '0',
	PRIMARY KEY (`booking_id`)
) DEFAULT CHARSET=utf8;
