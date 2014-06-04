
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users`
(
    `name` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`name`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- events
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `fixed` TINYINT(1) DEFAULT 0,
    `class_key` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- dateOptions
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `dateOptions`;

CREATE TABLE `dateOptions`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `date` DATETIME NOT NULL,
    `fixed` TINYINT(1) DEFAULT 0,
    `eventId` INTEGER NOT NULL,
    `class_key` VARCHAR(255),
    `choices` TEXT,
    `userName` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `dateOptions_FI_1` (`eventId`),
    INDEX `dateOptions_FI_2` (`userName`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- invitations
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `invitations`;

CREATE TABLE `invitations`
(
    `role` INTEGER NOT NULL,
    `userName` VARCHAR(255) NOT NULL,
    `eventId` INTEGER NOT NULL,
    PRIMARY KEY (`userName`,`eventId`),
    INDEX `invitations_FI_2` (`eventId`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- comments
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `content` VARCHAR(255) NOT NULL,
    `postTime` DATETIME NOT NULL,
    `username` VARCHAR(255),
    `eventid` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `comments_FI_1` (`username`),
    INDEX `comments_FI_2` (`eventid`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
