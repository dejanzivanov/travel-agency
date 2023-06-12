CREATE TABLE `travel-agency`.`dependents` (
                                              `id` INT UNSIGNED NOT NULL,
                                              `name` VARCHAR(255) NOT NULL,
                                              `last_name` VARCHAR(255) NOT NULL,
                                              `phone_number` TEXT NOT NULL,
                                              FOREIGN KEY (`id`) REFERENCES `policy_holder`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
