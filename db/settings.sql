CREATE TABLE `settings` (
  `key`   VARCHAR(50) NOT NULL,
  `value` TEXT,
  PRIMARY KEY (`key`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8