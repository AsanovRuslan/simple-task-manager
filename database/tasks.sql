CREATE TABLE IF NOT EXISTS `tasks`
(
    `id`              int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `email`           varchar(250)        NOT NULL,
    `username`        varchar(100)        NOT NULL,
    `text`            mediumtext,
    `done`            tinyint(1) unsigned NOT NULL DEFAULT '0',
    `edited_by_admin` tinyint(1) unsigned NOT NULL DEFAULT '0',
    `created`         TIMESTAMP           NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated`         TIMESTAMP           NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `email` (`email`),
    KEY `username` (`username`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;