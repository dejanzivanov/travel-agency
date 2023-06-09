CREATE TABLE `travel-agency`.`policy_holder` (
                                                 `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                                                 `name` VARCHAR(255) NOT NULL,
                                                 `last_name` VARCHAR(255) NOT NULL,
                                                 `type` VARCHAR(13),
                                                 `phone_number` TEXT NOT NULL,
                                                 `journey_start` DATE NOT NULL,
                                                 `journey_end` DATE NOT NULL,
                                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
