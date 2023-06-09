CREATE TABLE `travel-agency`.`users` (
                                         `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                                         `name` VARCHAR(250) NOT NULL,
                                         `last_name` VARCHAR(250) NOT NULL,
                                         `email` VARCHAR(250) NOT NULL,
                                         `password` VARCHAR(250) NOT NULL,
                                         `account_type` ENUM('user', 'admin') NOT NULL DEFAULT 'user',
                                         `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                         `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                                         PRIMARY KEY (`id`),
                                         UNIQUE KEY (`email`)
);
