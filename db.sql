
DROP TABLE IF EXISTS `luan_user`;
CREATE TABLE `luan_user` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_nicename` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT 0,
  `display_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`),
  KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `luan_ban`;
Create table luan_ban (
ID bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
`name` VARCHAR(255) NOT NULL,
status int(11) DEFAULT 0,
create_time DATETIME DEFAULT CURRENT_TIMESTAMP,
update_time  DATETIME ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
DROP TABLE IF EXISTS `luan_sanpham`;
Create table luan_sanpham (
ID bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
`name` VARCHAR(255),
`descr` text,
`category_id` bigint(20) DEFAULT 1,
`img_url` text,
`price` bigint(20) DEFAULT 0,
count bigint(20) DEFAULT 0,
status int(11) DEFAULT 0,
create_time DATETIME DEFAULT CURRENT_TIMESTAMP,
update_time  DATETIME ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `luan_category`;
Create table luan_category (
ID bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
`name` VARCHAR(255),
`descr` text,
`img_url` text,
count bigint(20) DEFAULT 0,
parent_id bigint(20) DEFAULT 0,
status int(11) DEFAULT 0,
create_time DATETIME DEFAULT CURRENT_TIMESTAMP,
update_time  DATETIME ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `luan_order`;
Create table luan_order (
ID bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
ban_id bigint(20) DEFAULT 0,
`token` VARCHAR(32),
status int(11) DEFAULT 0,
create_time DATETIME DEFAULT CURRENT_TIMESTAMP,
update_time  DATETIME ON UPDATE CURRENT_TIMESTAMP,
KEY `token_key` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `luan_order_deltail`;
Create table luan_order_deltail (
ID int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
order_id int(11) DEFAULT 0,
ban_id int(11) DEFAULT 0,
sanpham_id int(11) DEFAULT 0,
amount int(11) DEFAULT 0,
status int(11) DEFAULT 0,
create_time DATETIME DEFAULT CURRENT_TIMESTAMP,
update_time  DATETIME ON UPDATE CURRENT_TIMESTAMP,
INDEX `order_id` (`order_id`),
INDEX `order_id_status` (`order_id`,`status`),
INDEX `status` (`status`),
INDEX `ban_id` (`ban_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;