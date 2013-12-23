ALTER TABLE `settings` ADD `template` VARCHAR( 100 ) NOT NULL AFTER `base_url` ;

UPDATE `slimblog`.`settings` SET `template` = 'default' WHERE `settings`.`id` =1;