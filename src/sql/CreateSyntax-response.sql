-- Create syntax for 'response'

CREATE TABLE `response` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `thread_id` int(4) unsigned NOT NULL COMMENT '書き込み先スレッドID',
  `comment_number` int(4) unsigned NOT NULL COMMENT 'レス番号',
  `comment` text NOT NULL COMMENT '本文',
  `name` varchar(255) DEFAULT NULL COMMENT 'ハンドルネーム',
  `mail_address` varchar(255) DEFAULT NULL,
  `write_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '書き込み日時',
  PRIMARY KEY (`id`),
  KEY `thread_id` (`thread_id`),
  CONSTRAINT `response_ibfk_1` FOREIGN KEY (`thread_id`) REFERENCES `thread` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
