ALTER TABLE `personnel_users` ADD `is_busy` TINYINT NULL DEFAULT '0' AFTER `etat_formation_personnel`;

ALTER TABLE `mission_users` ADD `unit_ids` VARCHAR(255) NULL AFTER `mission_id`;