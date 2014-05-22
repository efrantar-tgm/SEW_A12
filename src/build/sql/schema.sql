
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
    `fixed` TINYINT(1),
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- dateOptions
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `dateOptions`;

CREATE TABLE `dateOptions`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `date` DATE NOT NULL,
    `fixed` TINYINT(1),
    `eventId` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `dateOptions_FI_1` (`eventId`)
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

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
