DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `volume` varchar(64) NOT NULL,
  `pub_date` datetime NOT NULL,
  `author` varchar(64) NOT NULL,
  `publisher` varchar(64) NOT NULL,
  `isbn` int(64) NOT NULL,
  `member_id` int(64) NOT NULL,
  `rental_flg` tinyint(4) NOT NULL,
  `delete_flg` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(64) NOT NULL,
  `member_name` varchar(64) NOT NULL,
  `access_token_key` text NOT NULL,
  `access_token_secret` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `rental_log`;
CREATE TABLE `rental_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(64) NOT NULL,
  `member_id` int(64) NOT NULL,
  `rental_flg` int(64) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

