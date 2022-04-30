

CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `image` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `lat` float(10, 6) NOT NULL DEFAULT '-1',
  `lon` float(10, 6) NOT NULL DEFAULT '-1',
  `width` int(16) NOT NULL DEFAULT '-1',
  `height` int(16) NOT NULL DEFAULT '-1',
  `created` timestamp DEFAULT now() NOT NULL,
  `updated` timestamp DEFAULT now() ON UPDATE now() NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `types` (
  -- Holds all users that go through signup process
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `image` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `cycleTime` int(16) NOT NULL DEFAULT '-1',
  `width` int(16) NOT NULL DEFAULT '-1',
  `height` int(16) NOT NULL DEFAULT '-1',
  `created` timestamp DEFAULT now() NOT NULL,
  `updated` timestamp DEFAULT now() ON UPDATE now() NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `machines` (
  -- Holds all users that go through signup process
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `typeID` int(16) NOT NULL DEFAULT '-1',
  `roomID` int(16) NOT NULL DEFAULT '-1',
  `qr` int(16) NOT NULL DEFAULT '-1',
  `lat` float(10, 6) NOT NULL DEFAULT '-1',
  `lon` float(10, 6) NOT NULL DEFAULT '-1',
  `created` timestamp DEFAULT now() NOT NULL,
  `updated` timestamp DEFAULT now() ON UPDATE now() NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `users` (
  -- Holds all users that go through signup process
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `created` timestamp DEFAULT now() NOT NULL,
  `updated` timestamp DEFAULT now() ON UPDATE now() NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `loads` (
  -- Holds all users that go through signup process
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `userID` int(16) NOT NULL DEFAULT '-1',
  `machineID` int(16) NOT NULL DEFAULT '-1',
  `load` timestamp DEFAULT now() NOT NULL,
  `created` timestamp DEFAULT now() NOT NULL,
  `updated` timestamp DEFAULT now() ON UPDATE now() NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `issues` (
  -- Holds all users that go through signup process
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `machineID` int(16) NOT NULL DEFAULT '-1',
  `userID` int(16) NOT NULL DEFAULT '-1',
  `severity` int(16) NOT NULL DEFAULT '-1',
  `description` varchar(4096) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `created` timestamp DEFAULT now() NOT NULL,
  `updated` timestamp DEFAULT now() ON UPDATE now() NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `notification_endpoints` (
  -- Holds all push notification endpoints
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `user` int(16) NOT NULL DEFAULT '-1',
  `device` int(16) NOT NULL DEFAULT '-1',
  `endpoint` varchar(512) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `auth` varchar(512) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `p256dh` varchar(512) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `created` timestamp DEFAULT now() NOT NULL,
  `updated` timestamp DEFAULT now() ON UPDATE now() NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;
CREATE TABLE IF NOT EXISTS `notifications` (
  -- Holds all push notification endpoints
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `redirect` varchar(512) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` int(16) NOT NULL DEFAULT '-1',
  `endpoint` int(16) NOT NULL DEFAULT '-1',
  `created` timestamp DEFAULT now() NOT NULL,
  `updated` timestamp DEFAULT now() ON UPDATE now() NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;