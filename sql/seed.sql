drop database if exists apnaimages_local;

create database apnaimages_local;
use apnaimages_local;

source sql/schema.sql;

INSERT INTO `users` (`id`,`first_name`,`last_name`,`email`,`password`,`deleted_at`,`updated_at`,`created_at`) VALUES
(1,'Sharan','Khan','sharan.gohar@gmail.com','sharan123',NULL,'2017-04-03 12:47:14', '2017-04-03 12:47:14')