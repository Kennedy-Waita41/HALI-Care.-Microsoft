
DROP database if exists [DATABASE_NAME];

CREATE Database [DATABASE_NAME];

use [DATABASE_NAME];

CREATE TABLE `user` (
  `id` bigint unsigned not null primary key auto_increment,
  `firstname` varchar(255) ,
  `lastname` varchar(255) ,
  `email` varchar(255),
  `phone` varchar(20),
  `profile_image` varchar(255),
   `dob` date,
  `ev_code` int default 0,
  `user_password` varchar(256) not null,
  `account_status` tinyint(1) default 1,
  `email_verified` tinyint(1) default 0,
  `created_on` datetime default current_timestamp,
  `updated_on` datetime default current_timestamp on update current_timestamp   
);

CREATE TABLE `reset_password` (
  `id` bigint unsigned not null primary key auto_increment,
  `userId` bigint unsigned not null,
  `token` varchar(256) ,
  `created_on` datetime default current_timestamp,
  `updated_on` datetime default current_timestamp on update current_timestamp  ,
  FOREIGN KEY (`userId`) REFERENCES `user`(`id`) on delete cascade
);

CREATE TABLE `session` (
  `session_id` bigint unsigned not null primary key auto_increment,
  `userId` bigint unsigned not null,
  `session_token` varchar(1000) ,
  `created_on` datetime default current_timestamp,
  `updated_on` datetime default current_timestamp on update current_timestamp  ,
  FOREIGN KEY (`userId`) REFERENCES `user`(`id`) on delete cascade
);


CREATE TABLE `temporary_email` (
  `id` bigint unsigned not null primary key auto_increment,
  `userId` bigint unsigned not null,
  `email` varchar(256) ,
  `created_on` datetime default current_timestamp,
  `updated_on` datetime default current_timestamp on update current_timestamp  ,
  FOREIGN KEY (`userId`) REFERENCES `user`(`id`) on delete cascade
);

CREATE TABLE `temporary_phone_number` (
  `id` bigint unsigned not null primary key auto_increment,
  `userId` bigint unsigned not null,
  `phone` varchar(256) ,
  `pv_code` int default 0,
  `created_on` datetime default current_timestamp,
  `updated_on` datetime default current_timestamp on update current_timestamp  ,
  FOREIGN KEY (`userId`) REFERENCES `user`(`id`) on delete cascade
);

CREATE TABLE `patient`( 
  `id` bigint unsigned not null primary key auto_increment,
  `userId` bigint unsigned not null,
  FOREIGN KEY (`userId`) REFERENCES `user`(`id`) on delete cascade
);

CREATE TABLE `medical_assistant`( 
  `id` bigint unsigned not null primary key auto_increment,
  `userId` bigint unsigned not null,
  `hospital` varchar(255) not null,
  `account_status` tinyint NOT NULL default 0,
  `created_on` datetime default current_timestamp,
  `updated_on` datetime default current_timestamp on update current_timestamp ,
  FOREIGN KEY (`userId`) REFERENCES `user`(`id`) on delete cascade
);

CREATE TABLE `doctor`( 
  `id` bigint unsigned not null primary key auto_increment,
  `userId` bigint unsigned not null,
  `specialization` varchar(255),
  `hospital` varchar(255) not null,
  `account_status` tinyint NOT NULL default 0,
  `created_on` datetime default current_timestamp,
  `updated_on` datetime default current_timestamp on update current_timestamp ,
  FOREIGN KEY (`userId`) REFERENCES `user`(`id`) on delete cascade
);

CREATE TABLE `medical_admin`( 
  `id` bigint unsigned not null primary key auto_increment,
  `userId` bigint unsigned not null,
  `hospital` varchar(255) not null,
  `account_status` tinyint unsigned NOT NULL default 0,
  `created_on` datetime default current_timestamp,
  `updated_on` datetime default current_timestamp on update current_timestamp ,
  FOREIGN KEY (`userId`) REFERENCES `user`(`id`) on delete cascade
);

CREATE TABLE `consultation`(
  `id` BIGINT UNSIGNED NOT NULL PRIMARY KEY auto_increment,
  `patientId` bigint UNSIGNED not null,
  `consult_status` tinyint NOT NULL default 0,
  `date_added` datetime default current_timestamp,
  FOREIGN KEY (`patientId`) REFERENCES `patient`(`id`) on delete cascade
);

CREATE TABLE `symptoms`(
  `consultationId` BIGINT UNSIGNED NOT NULL PRIMARY KEY,
  `symptoms` VARCHAR(2000) NOT NULL,
  `created_on` datetime default current_timestamp,
  FOREIGN KEY (`consultationId`) REFERENCES `consultation`(`id`) on delete cascade
);

CREATE TABLE `vital_signs`(
  `consultationId` BIGINT UNSIGNED NOT NULL PRIMARY KEY,
  `body_temp` FLOAT,
  `pulse_rate` FLOAT,
  `respiration_rate` FLOAT,
  `blood_pressure` FLOAT,
  `created_on` datetime default current_timestamp,
  `updated_on` datetime default current_timestamp on update current_timestamp ,
  FOREIGN KEY (`consultationId`) REFERENCES `consultation`(`id`) on delete cascade
);

CREATE TABLE `doctor_consultation`(
  `consultationId` BIGINT UNSIGNED NOT NULL PRIMARY KEY,
  `doctorId` BIGINT UNSIGNED NOT NULL,
  `medAssistantId` BIGINT UNSIGNED,
  `created_on` datetime default current_timestamp,
  FOREIGN KEY (`consultationId`) REFERENCES `consultation`(`id`) on delete cascade,
  FOREIGN KEY (`medAssistantId`) REFERENCES `medical_assistant`(`id`), 
  FOREIGN KEY (`doctorId`) REFERENCES `doctor`(`id`) on delete cascade
);
