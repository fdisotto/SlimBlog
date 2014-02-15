ALTER TABLE `settings` ADD `language` VARCHAR( 5 ) NOT NULL ;
UPDATE `settings` SET `language` = 'en-US' WHERE `settings`.`id` =1;